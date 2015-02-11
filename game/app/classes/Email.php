<?php
	class Email
	{
		private $from = array('questoes@provasdaoab.com.br' => 'AprovaGame');
		private $user = 'BrunoSette';
		private $password = '_J7RRVN_BJqYWq1rxuaa7g';

		private function CorpoEmail($Title, $Aluno, $Mensagem)
 		{
			return '  
				<!DOCTYPE html>
				<html>
					<head>
						<meta charset="UTF-8">
						<title>'.$Title.'</title>
						<link href="http://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet" type="text/css">
						<style>
							body {font-family: "Open Sans", sans-serif;}
							a {color: #fff;}
						</style>
					</head>
					<body>
						<div marginwidth="0" marginheight="0" style="background-color:#fff;">
							<div style="background-color:#fff">
								<div style="padding:10px;background-color:#34495e;color:#fff">
									<div style="text-align:left;font-size:14px;line-height:150%;font-weight:normal">
										Olá, '.$Aluno.'<br>
										<br>
											 '.$Mensagem.'
										<br>
										Atenciosamente, <br>
										<br>
										Equipe AprovaGame<br> 
										<img style="width: 200px;" src="http://www.aprovagame.com.br/game/img/logo.png" /><br />
										<a href="http://www.aprovagame.com.br/" style="color:#fff;">www.aprovagame.com.br</a> <br>
									</div>
								</div>
								<span style="padding:0px"></span>
							</div>
						</div>
					</body>
				</html>';
		}

		public function post_acessos_antigos($user)
		{	
			$Mensagem = '
                            Estamos sentido sua falta.<br />
                            Já faz mais de três dias que você não estuda. Lembre-se que<strong> a primeira fase da OAB está chegando!</strong><br />
                            <br />
							
							<div>
                            	Queremos muito a sua aprovação e por isso realizamos atualizações <strong>diárias</strong> em nosso sistema para forncer a você o melhor conteúdo! Confira agora mesmo.
                            </div>
							<br /><br />
                            <div>
                            	Jogue COMO e ONDE quiser, acesse agora a nossa plataforma e bons estudos!
                            </div>

                            <a href="www.aprovagame.com.br/game" style="text-decoration:underline;font-weight:normal; color:#fff;" target="_blank">
                            Clique aqui para acessar.</a><br /><br/>
                        ';

            $transport = Swift_SmtpTransport::newInstance('smtp.mandrillapp.com', 587);
            $transport->setUsername($this->user);
            $transport->setPassword($this->pass);
            $swift     = Swift_Mailer::newInstance($transport);
            
            $subject   = "AprovaGame";

			if ($user)
			{
				$to[] = array($user->email => $user->nome);
				$html[] = $this->CorpoEmail("AprovaGame", $user->nome, $Mensagem); 
			}
			else
			{
				$query = "SELECT * FROM `tb_usuario` WHERE `ultimo_acesso` < '2015-02-05' ";
				$stmt = DB::prepare($query);
            	$stmt->execute();

            	while ($res = $stmt->fetch())
            	{
            		$to[] = array($res->email => $res->nome);  
            		$html[] = $this->CorpoEmail("AprovaGame", $res->nome, $Mensagem);
            	}
			}

			$message = Swift_Message::newInstance();
            $headers = $message->getHeaders();
            $headers->addTextHeader('Subject', 'Estamos sentinda sua falta!');
            $headers->addTextHeader('X-MC-Track', 'opens, clicks_htmlonly');
            $headers->addTextHeader('X-MC-GoogleAnalytics', 'provasdaoab.com.br');

            $lim = count($html);

            for ($i= 0; $i < $lim; $i++)
            { 
            	$message->setFrom($this->from);
	            $message->setBody($html[$i], 'text/html');
	            $message->setTo($to[$i]);
	            $recipients = $swift->send($message, $failures);
            }

            return $recipients;
		}
	}
?>