<?php
	
	class Questoes
	{
		public function get_questao($data = null)
		{
			$intervalo = null;
			if ($data["tipo"] == "1") // questao de verdadeiro ou falso
			{
				if(isset($_SESSION['disciplinas'])){
					$sql = "SELECT * FROM `tb_questoes_multiplaescolha` LEFT JOIN tb_disciplinas ON tb_questoes_multiplaescolha.materia = tb_disciplinas.titulo WHERE multipla_escolha = 0 AND tb_questoes_multiplaescolha.`id` NOT IN 
					(SELECT questao FROM tb_questao_usuario WHERE acertou = 1 AND usuario = {$_SESSION["FBID"]}) AND tb_disciplinas.id IN (".$_SESSION['disciplinas'].") ORDER BY RAND() LIMIT 1";
				} else {
					$sql = "SELECT * FROM `tb_questoes_multiplaescolha` WHERE multipla_escolha = 0 AND tb_questoes_multiplaescolha.`id` NOT IN 
					(SELECT questao FROM tb_questao_usuario WHERE acertou = 1 AND usuario = {$_SESSION["FBID"]}) ORDER BY RAND() LIMIT 1";
				}
				

				if ($data["id"] != -1) // pular
				{
					$id = $data["id"];

					$sql = "SELECT * FROM  `tb_questoes_multiplaescolha` WHERE multipla_escolha = 0 and id != $id ORDER BY RAND() LIMIT 1";
				}

		        $stmt = DB::prepare($sql);
		        $stmt->execute();
		        $result = $stmt->fetch();

		        if (!$result)
		        {
		        	if(isset($_SESSION['disciplinas'])){
		        		$sql = "SELECT * FROM  `tb_questoes_multiplaescolha` LEFT JOIN tb_disciplinas ON tb_questoes_multiplaescolha.materia = tb_disciplinas.titulo  WHERE multipla_escolha = 0 AND tb_disciplinas.id IN (".$_SESSION['disciplinas'].") ORDER BY RAND() LIMIT 1";
		        	} else {
		        		$sql = "SELECT * FROM  `tb_questoes_multiplaescolha` WHERE multipla_escolha = 0 ORDER BY RAND() LIMIT 1";
		        	}
		        	$stmt = DB::prepare($sql);
		        	$stmt->execute();
		        	$result = $stmt->fetch();
		        }
			}
			
			if($data["tipo"] == "2") // questao multiplaescolha
			{	
				if(isset($_SESSION['disciplinas'])){
					$sql = "SELECT * FROM `tb_questoes_multiplaescolha` LEFT JOIN tb_disciplinas ON tb_questoes_multiplaescolha.materia = tb_disciplinas.titulo  WHERE multipla_escolha = 1 AND tb_questoes_multiplaescolha.`id` NOT IN 
					(SELECT questao FROM tb_questao_usuario WHERE acertou = 1 AND usuario = {$_SESSION["FBID"]}) 
					AND tb_disciplinas.id IN (".$_SESSION['disciplinas'].")
					ORDER BY acertos/(acertos + erros) DESC, acertos DESC LIMIT 1";
				} else {
					$sql = "SELECT * FROM `tb_questoes_multiplaescolha` WHERE multipla_escolha = 1 AND `id` NOT IN 
					(SELECT questao FROM tb_questao_usuario WHERE acertou = 1 AND usuario = {$_SESSION["FBID"]}) 
					ORDER BY acertos/(acertos + erros) DESC, acertos DESC LIMIT 1";
				}

				if ($data["id"] != -1) // pular
				{
					$id = $data["id"];
					$sql = "SELECT * FROM  `tb_questoes_multiplaescolha` WHERE multipla_escolha = 1 AND id != $id ORDER BY RAND() LIMIT 1";
				}

		        //$sql = "SELECT * FROM `tb_questoes_multiplaescolha` WHERE id = 169";
		        //$sql = "SELECT * FROM `tb_questoes_multiplaescolha` WHERE id = 637";

		        $stmt = DB::prepare($sql);
		        $stmt->execute();
		        $result = $stmt->fetch();

		        if($result->video)
		        {
		        	$sql2 = "SELECT * FROM `tb_questao_video` WHERE questao_id = {$result->id}";
			        $stmt2 = DB::prepare($sql2);
			        $stmt2->execute();
			        $intervalo = $stmt2->fetchAll();
		        	$arrayLink = explode("/", $result->video);
		        	$link = "//www.youtube.com/embed/" . $arrayLink[3] . "?start=" .$intervalo[0]->start_video . "&end=" . $intervalo[0]->end_video. "&rel=0&enablejsapi=1";
		        	$result->video_embed = $link;
			    }   
		        else
		        	$result->video_embed = "";
	        }

	        return array('data' => $result, 'intervalo' => $intervalo);
	    }

	    public function post_error_notification($params)
	    {
	    	var_dump($params);
	    	var_dump($_SESSION);
	    }
	}
?>