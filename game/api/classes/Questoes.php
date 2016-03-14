<?php
	
	class Questoes
	{
	    /*
		 * getQuestions cria uma lista com cinco questões
		 * @return array (Array contendo cinco questões referentes a rodada)  
	     */
	    private static function getQuestions($usuario)
	    {
	    	if ($usuario == NULL) return false;

	    	$sql = "(SELECT * FROM tb_questoes_multiplaescolha WHERE ativa = 1 AND multipla_escolha = 1 AND id NOT IN 
	    		(SELECT questao FROM tb_questao_usuario WHERE acertou = 1 AND usuario = $usuario)
	    		ORDER BY acertos/(acertos + erros) DESC, acertos DESC LIMIT 4) UNION
				(SELECT * FROM tb_questoes_multiplaescolha WHERE ativa = 1 AND multipla_escolha = 0 ORDER BY RAND() LIMIT 1 )";
	    	
			$stmt = DB::prepare($sql);
			$stmt->execute();

			$result = array(); // verificar caso em que usuário já respondeu todas as questões

			while($res = $stmt->fetch())
			{
				unset($res->ativa); // remove atributo desnecessário para o cliente

				if($res->video)
				{
					$sql2 = "SELECT * FROM `tb_questao_video` WHERE questao_id = {$res->id}";
			        $stmt2 = DB::prepare($sql2);
			        $stmt2->execute();
			        $res->intervalo = $stmt2->fetchAll();

		        	$arrayLink = explode("/", $result->video);
		        	$link = "https://www.youtube.com/embed/" . $arrayLink[3] . "?start=" .$intervalo[0]->start_video . "&end=" . $intervalo[0]->end_video. "&rel=0&enablejsapi=1";
		        	$res->video_embed = $link;
				}
				else
				{
					$res->video_embed = "";
					$res->intervalo = array();
				}

				unset($res->video);
				$result[] = $res;
			}

			srand((float)microtime() * 1000000);
			shuffle($result);

			return $result;
	    }

	    /*
		 * newRound cria uma nova rodada
		 * status da rodada: CONVITE_ABERTO, CRIADA, CONVITE_ACEITO, INICIADA, ENCERRADA
		 * @return array (Array contendo cinco questões referentes a rodada e contendo o id do round)  
	     */
		public static function newRound($desafiante, $desafiado, $concurso)
		{
			$ret = array();

			if(Usuario::getVidas($desafiante) > 0)
			{
				Usuario::perdeuVida($desafiante);

				if($desafiado == NULL) $status = INICIADA;
				else $status = CONVITE_ABERTO;

				$today = DB::dateToMySql(date("Y/m/d"));

				$stmt = DB::prepare("INSERT INTO tb_rodada (concurso, usuario_1, usuario_2, status, data_criacao) VALUES (?, ?, ?, ?, ?)");
				$stmt->execute(array($concurso, $desafiante, $desafiado, $status, $today));

				$rodada = $ret["cod_rodada"] = DB::lastInsertId();
				$questoes = $ret["questoes"] = self::getQuestions($desafiante);

				$sql = "INSERT INTO tb_rodada_questao (rodada, questao) VALUES ";

				for($i = 0; $i < count($questoes); $i++)
				{
					if($i != (count($questoes) - 1)) $sql .= "(".$rodada .",". $questoes[$i]->id ."),";
					
					else $sql .= "(".$rodada .",". $questoes[$i]->id .")";
				}

				$stmt = DB::query($sql);

				return $ret;
			}
			else return false;
		}

		/*
		 * doQuestions cadastra no banco de dados uma nova questão efetuada.
		 * @params (int, array, int) ID da rodada, informações sobre as questoes da rodada, ID do usuario
		 * @return (array) Pontuação e moedas adiquiridas por usuário  
	     */
		public static function doQuestions($rodada, $questoes, $usuario)
		{
			$tipoUser = 0;
			$pontuacaoConquistada = 0;
			$moedasConquistadas = 0;
			$today = DB::dateToMySql(date("Y/m/d"));

			$stmtRodadaUsr = DB::prepare("SELECT usuario_1, usuario_2 FROM tb_rodada WHERE id = :rodada");
			$stmtRodadaUsr->execute(array("rodada" => $rodada));
			$usuarios = $stmtRodadaUsr->fetch();

			if($usuario == $usuarios->usuario_1) $tipoUser = 1;
			else if($usuario == $usuarios->usuario_2) $tipoUser = 2;

			// atualiza status da rodada para finalizada.
			$stmtUpdateRodada = DB::prepare("UPDATE tb_rodada SET status = :new_status, data_finalizacao = :end_date WHERE id = :id");
			$stmtUpdateRodada->execute(array(
				":new_status" => ENCERRADA,
				":end_date" => $today,
				":id" => $rodada 
			));

			// insere questões executadas pelo usuario
			$sqlUser = "INSERT INTO tb_questao_usuario (usuario, questao, acertou, marcou, data)  VALUES ";
			for($i = 0; $i < count($questoes); $i++)
			{
				if($i != (count($questoes) - 1))
					$sqlUser .= "(" . $usuario . "," . $questoes[$i]->id . ",'" . $questoes[$i]->acertou . "','" . $questoes[$i]->marcou . "','" . $today . "'),";
				else
					$sqlUser .= "(" . $usuario . "," . $questoes[$i]->id . ",'" . $questoes[$i]->acertou . "','" . $questoes[$i]->marcou . "','" . $today . "')";

				if($questoes[$i]->acertou)
				{
					$pontuacaoConquistada += 10;
					$moedasConquistadas += 1;
				}

				if($tipoUser == 1)
					DB::query("UPDATE tb_rodada_questao SET usuario_1 = '".$questoes[$i]->marcou."' WHERE rodada = $rodada AND questao = " . $questoes[$i]->id);
				else if($tipoUser == 2)
					DB::query("UPDATE tb_rodada_questao SET usuario_2 = '".$questoes[$i]->marcou."' WHERE rodada = $rodada AND questao = " . $questoes[$i]->id);
			}
			DB::query($sqlUser);

			// atualiza pontuação do usuario
			Usuario::updateCash($usuario, $moedasConquistadas);
			Usuario::updatePontuation($usuario, $pontuacaoConquistada);

			return array("moedas" => $moedasConquistadas, "pontucao" => $pontuacaoConquistada);
		} 

		/*
		 * getConcursos retorna os concursos disponíveis para o usuário.
		 * @params (int) Id do usuario
		 * @author Marcel Santana
		 * @return (array) Concursos disponíveis para o usuario e suas respectivas informações  
	     */
		public static function getConcursos()
		{
			$stmtConcursos = DB::prepare("SELECT id, titulo, imagem FROM tb_concursos LIMIT 12");
			$stmtConcursos->execute();

			$ret = array();

			while($res = $stmtConcursos->fetch())
			{
<<<<<<< HEAD
				$res->imagem = "https://www.aprovagame.com.br/game/img/concursos/" . $res->imagem;
=======
				$res->imagem = "http://www.aprovagame.com.br/game/img/concursos/" . $res->imagem;
>>>>>>> Correções nos gráficos e adicionar usuario ao mailchimp
				$ret[] = $res;
			}

			return $ret;		
		}

		public static function insereComentario($data)
		{
			$stmt = DB::prepare("INSERT INTO tb_comentarios_questao (usuario, questao, comentario, likes, data) VALUES (?, ?, ?, ?, ?)");
			$stmt->execute(array($data->usuario, $data->questao, $data->comentario, 0, DB::dateToMySql(date("Y/m/d"))));

			return true;
		}

		public static function likeComentario($comentario)
		{
			DB::query("UPDATE tb_comentarios_questao SET likes = likes + 1 WHERE id = $comentario");

			return true;
		}

		public static function questaoComentarios($questao, $pagina)
		{
			$pagina = $pagina - 1;
			$stmtComentario = DB::prepare("SELECT * FROM tb_comentarios_questao WHERE questao = $questao ORDER BY data LIMIT $pagina,10");
			$stmtComentario->execute();

			return $stmtComentario->fetchAll();		
		}

		public static function getLifeTime()
		{
			$stmt = DB::prepare("SELECT hora FROM tb_vidas_cron ORDER BY id DESC LIMIT 1");
			$stmt->execute();

			return $stmt->fetch()->hora;
		}

		public static function getRodadas($usuario)
		{
			$stmt = DB::prepare("SELECT concurso, data_finalizacao, status FROM tb_rodada ORDER BY data_finalizacao DESC LIMIT 3");
			$stmt->execute();

			return $stmt->fetchAll();
		}
	}
?>