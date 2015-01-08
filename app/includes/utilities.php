<?php
	function retirar_acentos($texto)
	{
		return preg_replace("/&([a-z])[a-z]+;/i", "$1", htmlentities($texto));
	}

	function remove_pontucao($str)
	{
		$pontos = array(",", ".", ";", ":");
		$result = str_replace($pontos, "", $str);

		return $result;
	}

	function cadastrarInFusion($params)
	{
		$app = new iSDK();
		$app->cfgCon("ji171","7e66653a71a49bc5fa326a98671a9f1b","off");

		$nome = explode(" ", ucwords(strtolower(retirar_acentos($params['nome']))));
		
		if($nome[1] == NULL) $nome[1] = "";

		if($params['localizacao'] != NULL)
		{
			$localizacao = explode(" ", $params['localizacao']);

			$localizacao[0] =  retirar_acentos(remove_pontucao($localizacao[0]));
			$localizacao[1] =  retirar_acentos(remove_pontucao($localizacao[1]));
		}
		else
		{
			$localizacao[0] = "Unknown";
			$localizacao[1] = "Unknown";
		}

		$currentDate = date("d-m-Y");
		$oDate = $app->infuDate($currentDate);

		$conDat = array(
						"FirstName" 		=> $nome[0],
		                "LastName" 			=> $nome[1],
		                "Email"			    => $params["email"],
						"City"		 		=> $localizacao[0],
						"Country"		 	=> "Brazil",
						"State"		 		=> $localizacao[1]
					);

		$CliEmail = $params["email"];
		$returnFields = array('Id', 'FirstName', 'LastName', 'Email', 'StreetAddress1', 'City', 'State', 'PostalCode', 'Phone1');// Dados que serão retornado ao buscar o contato.
		$data = $app->findByEmail($CliEmail, $returnFields); // Verifica se o contato já existe

		if(count($data) > 0)
		{ // Se já existe usuário atualiza.
			$conID = $app->updateCon(intval($data[0]["Id"]), $conDat);
		}
		else
		{ // Se não existe usuário, cria.
			$conID = $app->addCon($conDat);
		}

		$result = $app->campAssign($conID, 860); // adicionando usuario a campanha

		$result = $app->grpAssign($conID, 652); // adicionando usuario a uma tag
	}
?>