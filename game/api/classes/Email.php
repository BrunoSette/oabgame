<?php
	class Email
	{
		private $from = array('questoes@provasdaoab.com.br' => 'AprovaGame');
		private $to;
		private $message;
		private $subject;

		private function CorpoEmail($Title, $Aluno, $Mensagem)
 		{
			return '  
				<!DOCTYPE html>
				<html>
					<head>
						<meta charset="UTF-8">
						<title>'.$Title.'</title>
						<link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet" type="text/css">
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
										<img style="width: 200px;" src="https://www.aprovagame.com.br/game/img/logo.png" /><br />
										<a href="https://www.aprovagame.com.br/" style="color:#fff;">www.aprovagame.com.br</a> <br>
									</div>
								</div>
								<span style="padding:0px"></span>
							</div>
						</div>
					</body>
				</html>';
		}

		public function send_email()
		{	
            $transport = Swift_SmtpTransport::newInstance('smtp.mandrillapp.com', 587);
            $transport->setUsername("BrunoSette");
            $transport->setPassword("_J7RRVN_BJqYWq1rxuaa7g");
            $swift     = Swift_Mailer::newInstance($transport);

			$message = Swift_Message::newInstance();
            $headers = $message->getHeaders();
            $headers->addTextHeader('Subject', $this->subject);
            $headers->addTextHeader('X-MC-Track', 'opens, clicks_htmlonly');
            $headers->addTextHeader('X-MC-GoogleAnalytics', 'provasdaoab.com.br');

            $lim = count($this->to);
            for($i = 0; $i < $lim; $i++)
            { 
            	$message->setFrom($this->from);
	            $message->setBody($this->CorpoEmail("AprovaGame", $this->to[$i]["nome"], $this->message), 'text/html');
	            $message->setTo($this->to[$i]["email"]);
	            $recipients = $swift->send($message, $failures);
            }

            return $recipients;
		}

		public function set_subject($subject)
		{
			$this->subject = $subject;
		}

		public function set_message($message)
		{
			$this->message = $message;
		}

		public function set_to(array $to)
		{
			$this->to = $to;
		}
	}
?>