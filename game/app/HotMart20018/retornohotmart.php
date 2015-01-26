<?php
	require '../config.php';
	require '../DB.php';
	require '../includes/utilities.php';
	require '../classes/Swift/lib/swift_required.php';

	header('Content-Type: text/html; charset=utf-8');

	$arquivo = fopen("log.txt", "a");

	$Version = 1;
	$UA = 'UA-58671300-1';
	$ClientId = $_POST["transaction"];
	$TransactionType = 'transaction';
	$TransactionItem = 'item';
	$TransactionId = $_POST["transaction"];			//$_POST["TransacaoID"]; 
	$Affiliate = $_POST["aff_name"];           //Utilizar esses dados para calcular o faturamento mais corretamente
	$Revenue = $_POST["cms_vendor"];
	$Shipping = 0;
	$ItemName = $_POST["prod_name"];
	$ItemCode = $_POST["prod"];
	$Price = $_POST["price"];
	$Tax = $_POST["cms_aff"];
	$Quantity = 1;
	$Category = 'Software';
	$Status = $_POST["status"];


	$TransacaoID 		= $_POST['transaction'];
	$TipoPagamento 		= $_POST['payment_type'];

	$StatusTransacao 	= $_POST['status']; 
	//started, approved, canceled, pending_analysis, billet_printed, refunded, completed, blocked

	$CliNome 			= $_POST['name'];
	$CliEmail 			= $_POST['email'];
	$doc 				= $_POST['doc']; //CPF
	$CliEndereco 		= $_POST['address']. " numero: ".$_POST['address_number'];
	$CliNumero 			= $_POST['address_number'];
	$CliComplemento 	= $_POST['address_comp'];
	$CliTelefone 		= $_POST['phone_local_code']." ".$_POST['phone_number'];
	$CliBairro 			= $_POST['address_district'];
	$CliCidade 			= $_POST['address_city'];
	$CliEstado 			= $_POST['address_state'];
	$CliCEP 			= $_POST['address_zip_code'];
	$afiliado 			= $_POST['aff'];

	$ProdDescricao 		= $_POST['prod_name'];
	$ProdValor 			= $_POST['price'];
	$ProdID 			= $_POST['prod'];
	$ProdQuantidade 	= 1;	
	
	$xcod 				= $_POST['xcod'];

	$text = "";
	foreach ($_POST as $key => $value) $text .= $key . " - " . $value . " ";
	$text .= "\n";

	fwrite($arquivo, $text);
	fclose($arquivo);

	if($StatusTransacao == "approved" && $ItemCode == 50558)
	{
		$sql = "SELECT email FROM tb_usuario WHERE (email=:user_email)";
        $stmt = DB::prepare($sql);

        $stmt->bindParam("user_email", $CliEmail);
        $stmt->execute();

        $user = $stmt->fetch();

        if ($user)
        {
            $sql = "UPDATE tb_usuario SET status_pagamento = 1, convite = 1, data_cadastro = '$newToday' WHERE email = '" . $CliEmail . "'";
        	$stmtUsuario = DB::query($sql);

        	$Mensagem = '
							<br/>
							Estamos escrevendo este email para te agradecer e informar que seu pedido foi concluido com sucesso! <br />
							<br />
							<strong>Você já encontra-se cadastrado em nossa plataforma com o seguinte e-mail de acesso: '.$CliEmail.'</strong>.  <br>
	
							<br />
							<br />
							<div>
							Acesse agora a nossa plataforma e bons estudos!
							</div>
							<div>

							<a href="www.aprovagame.com.br/game" style="text-decoration:underline;font-weight:normal;color:#fff" target="_blank">
							Clique aqui para acessar.</a> 
							<br>																		 
							<br/>
				
						';
        }
        else
        {
        	$senha = randomPassword();

        	$sql = "INSERT INTO tb_usuario (face_id, nome, email, senha, pontuacao, pontuacao_geral, foto_profile, localizacao, aniversario, genero, qtd_acessos, ultimo_acesso, data_cadastro, via_fb, via_email, nivel, status_pagamento, convite) 
                    VALUES 
                    (
                       0,
                        '$CliNome', 
                        '$CliEmail', 
                        '" . md5($senha) . "', 
                        100,
                        1500,
                        '',
                        '$CliEstado',
                        '',
                        '',
                        0,
                        '$newToday',
                        '$newToday',
                        0,
                        1,
                        1,
                        1,
                        1
                    ) ";

           $stmtUsuario = DB::query($sql);

           $Mensagem = '
							<br/>
							Estamos escrevendo este email para te agradecer e informar que seu pedido foi concluido com sucesso! <br />
							<br />
							<strong>Você foi automaticamente cadastrado em nossa plataforma. Segue abaixo seus dados para acesso:</strong>.  <br>
							<br>
							<br>
							<div>
							E-mail: '.$CliEmail.' <br />
							Senha: '.$senha.' <br />  
							</div>
							<br />
							<br />
							<div>
							Acesse agora a nossa plataforma e bons estudos!
							</div>
							<div>

							<a href="www.aprovagame.com.br/game" style="text-decoration:underline;font-weight:normal; color:#fff;" target="_blank">
							Clique aqui para acessar.</a> 
							<br>																		 
							<br/>
				
						';
        }


		$transport = Swift_SmtpTransport::newInstance('smtp.mandrillapp.com', 587);
		$transport->setUsername('BrunoSette');
		$transport->setPassword('_J7RRVN_BJqYWq1rxuaa7g');
		$swift     = Swift_Mailer::newInstance($transport);

		// Cabeçalho
		$subject   = "AprovaGame";
		$from      = array('questoes@provasdaoab.com.br'  => 'Bruno Sette' );
		$to        = array( $CliEmail => $CliNome); 

		$html = CorpoEmail("AprovaGame", $CliNome, $Mensagem);

		$message = Swift_Message::newInstance();
		$headers = $message->getHeaders();
		$headers->addTextHeader('Subject', 'Provas da OAB');
		$headers->addTextHeader('X-MC-Track', 'opens, clicks_htmlonly');
		$headers->addTextHeader('X-MC-GoogleAnalytics', 'provasdaoab.com.br');

		$message->setFrom($from);
		$message->setBody($html, 'text/html');
		$message->setTo($to);
		$recipients = $swift->send($message, $failures);
	} 

?>