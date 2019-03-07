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

function randomPassword()
{
	$alphabet = "abcdefghijklmnopqrstuwxyzABCDEFGHIJKLMNOPQRSTUWXYZ0123456789";
	    $pass = array(); //remember to declare $pass as an array
	    $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
	    for ($i = 0; $i < 8; $i++) {
	    	$n = rand(0, $alphaLength);
	    	$pass[] = $alphabet[$n];
	    }
    	return implode($pass); //turn the array into a string
    }

    function CorpoEmail ($Title, $Aluno, $Mensagem)
    {
    	return '  
    	<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
    	<html>
    	<head>
    	<META http-equiv="Content-Type" content="text/html; charset=utf-8">
    	<title>'.$Title.'</title>
    	<link href="http://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet" type="text/css">
    	<style>
    	body {font-family: "Open Sans", sans-serif;}
    	a {color: #fff;}
    	</style>
    	</head>
    	<body>
    	<div marginwidth="0" marginheight="0" style="background-color:#fff;">
    	<div style="background-color:#ffffff">
    	<div style="padding:10px;background-color:#ffffff">
    	<div style="font-size:12px;font-weight:normal;text-align:left">
    	</div>
    	</div>
    	<div>
    	<img src="http://gallery.mailchimp.com/653153ae841fd11de66ad181a/images/transparent.gif" alt="" border="0" style="margin:0;padding:0">
    	</div>
    	<div style="padding:10px;background-color:#34495e;color:#fff">
    	<div style="text-align:left;font-size:14px;line-height:150%;font-weight:normal">
    	Olá, '.$Aluno.'<br>
    	<br>
    	'.$Mensagem.'
    	<br>
    	Atenciosamente, <br>
    	<br>
    	Equipe AprovaGame<br> 
    	<img style="width: 200px;" src="http://www.provasdaoab.com.br/aprovagame/game/img/logo.png" /><br />
    	<a href="http://http://www.provasdaoab.com.br/aprovagame/" style="color:#fff;">http://www.provasdaoab.com.br/aprovagame</a> <br>
    	</div>
    	</div>
    	<span style="padding:0px"></span>
    	</div>
    	</div>
    	</body>
    	</html>';
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

	function subscribeMailChimp($email, $nome)
	{

		$nome = explode(" ", ucwords(strtolower(retirar_acentos($nome))));

		if(is_null($nome[1])){
			$nome[1] = "";	
		}

		$data = [
			'email'     => $email,
			'status'    => 'subscribed',
			'firstname' => $nome[0],
			'lastname'  => $nome[1]
		];
		$apiKey = '6b962dbcd6c1148a59dbc69fe61d7e2d-us11';
		$listId = '97a9e13879';

		$memberId = md5(strtolower($data['email']));
		$dataCenter = substr($apiKey,strpos($apiKey,'-')+1);
		$url = 'https://' . $dataCenter . '.api.mailchimp.com/3.0/lists/' . $listId . '/members/' . $memberId;

		$json = json_encode([
			'email_address' => $data['email'],
        		'status'        => $data['status'], // "subscribed","unsubscribed","cleaned","pending"
		        'merge_fields'  => [
		        'FNAME'     => $data['firstname'],
		        'LNAME'     => $data['lastname']
		        ]
        	]);

		$ch = curl_init($url);

		curl_setopt($ch, CURLOPT_USERPWD, 'user:' . $apiKey);
		curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_TIMEOUT, 10);
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'PUT');
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $json);                                                                                                                 

		$result = curl_exec($ch);
		$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
		curl_close($ch);

	}
	?>