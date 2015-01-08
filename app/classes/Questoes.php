<?php
	
	class Questoes
	{
		public function get_questao()
		{
			$sql = "SELECT * FROM `tb_questoes_multiplaescolha` WHERE `id` NOT IN 
				(SELECT questao FROM tb_questao_usuario WHERE acertou = 1 AND usuario = {$_SESSION["FBID"]}) 
				ORDER BY `acertos`/(`acertos` + `erros`) DESC, `acertos` DESC LIMIT 1";

	        //$sql = "SELECT * FROM `tb_questoes_multiplaescolha` ORDER BY RAND() LIMIT 1";

	        $stmt = DB::prepare($sql);
	        $stmt->execute();
	        $result = $stmt->fetch();

	        return $result;
	    }

	    public function post_error_notification($params)
	    {
	    	var_dump($params);
	    	var_dump($_SESSION);
	    }
	}
?>