<?php
	
	class Questoes
	{
		public function get_questao()
		{
			$sql = "SELECT * FROM `tb_questoes_multiplaescolha` WHERE `id` NOT IN 
				(SELECT questao FROM tb_questao_usuario WHERE acertou = 1 AND usuario = {$_SESSION["FBID"]}) 
				ORDER BY acertos/(acertos + erros) DESC, acertos DESC LIMIT 1";

	        //$sql = "SELECT * FROM `tb_questoes_multiplaescolha` WHERE id = 169";

	        $stmt = DB::prepare($sql);
	        $stmt->execute();
	        $result = $stmt->fetch();

	        if($result->video)
	        {
	        	$arrayLink = explode("/", $result->video);
	        	$link = "//www.youtube.com/embed/" . $arrayLink[3] . "?start=" . $result->start_video . "&end=" . $result->end_video . "&controls=0&rel=0&showinfo=0&enablejsapi=1";
	        	$result->video_embed = $link;
	        }
	        else
	        	$result->video_embed = "";

	        return $result;
	    }

	    public function post_error_notification($params)
	    {
	    	var_dump($params);
	    	var_dump($_SESSION);
	    }
	}
?>