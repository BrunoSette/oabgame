<?php session_start(); ?>

<!doctype html>
<html lang="pt">
<head>
  	<meta property="og:site_name" content="OABGame"/>

	<link rel="apple-touch-icon" sizes="57x57" href="/favicons/apple-touch-icon-57x57.png">
	<link rel="apple-touch-icon" sizes="114x114" href="/favicons/apple-touch-icon-114x114.png">
	<link rel="apple-touch-icon" sizes="72x72" href="/favicons/apple-touch-icon-72x72.png">
	<link rel="apple-touch-icon" sizes="144x144" href="/favicons/apple-touch-icon-144x144.png">
	<link rel="apple-touch-icon" sizes="60x60" href="/favicons/apple-touch-icon-60x60.png">
	<link rel="apple-touch-icon" sizes="120x120" href="/favicons/apple-touch-icon-120x120.png">
	<link rel="apple-touch-icon" sizes="76x76" href="/favicons/apple-touch-icon-76x76.png">
	<link rel="apple-touch-icon" sizes="152x152" href="/favicons/apple-touch-icon-152x152.png">
	<link rel="apple-touch-icon" sizes="180x180" href="/favicons/apple-touch-icon-180x180.png">
	<link rel="icon" type="image/png" href="/favicons/favicon-192x192.png" sizes="192x192">
	<link rel="icon" type="image/png" href="/favicons/favicon-160x160.png" sizes="160x160">
	<link rel="icon" type="image/png" href="/favicons/favicon-96x96.png" sizes="96x96">
	<link rel="icon" type="image/png" href="/favicons/favicon-16x16.png" sizes="16x16">
	<link rel="icon" type="image/png" href="/favicons/favicon-32x32.png" sizes="32x32">
	<meta name="msapplication-TileColor" content="#00aba9">
	<meta name="msapplication-TileImage" content="/favicons/mstile-144x144.png">
	<meta http-equiv="content-language" content="pt-br" />

	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=2.0" />

	<title>OABGame</title>
	<link rel="stylesheet" href="css/all.css" />
	<link rel="stylesheet" href="css/glycon_boots.css" />
	<link rel="stylesheet" href="css/web-font.css" />
	<link rel="stylesheet" href="css/font-awesome.min.css" />
</head>
<body>	
<header class="topo">	
	<nav class="navbar navbar-inverse">
      <div class="container">
        <div class="navbar-header">
			<a class="navbar-brand" href="index"><img src="img/logo.png" class="logo" alt="logomarca" /></a>
        </div>
      </div>
    </nav> 
</header>	

<section class="land-login">
	<div class="container">
		<div class="row">
		<div class="col-md-4 col-md-offset col-xs-offset-1 col-sm-offset-1">
			<figure> <img src="img/logo.png" alt="Logomarca OABgame" /> </figure>
		</div>
		<div class="col-md-5 col-sm-offset">
		<div class="box-login">
			<!-- <div class="alert alert-warning">Estamos realizando uma manutenção crítica, em 2h o sistema estará disponível para acesso</div> -->
			<form action="javascript:void(0)" novalidate>
				<div class="bt-login">
					<a href="fbconfig" class="btn btn-block btn-social btn-lg btn-facebook" title="Logue com o facebook" style="font-size:13px;"><i class="fa fa-facebook"></i>Login com Facebook</a>
				</div>
				  <p class="mb10 txt-center">ou</p>
				  <div class="form-group icon-name">
				    <input type="email" class="form-control" id="email" placeholder="E-mail"/>
				    <i class="fa fa-users"></i>
				  </div>
				  <div class="form-group icon-name">
				    <input type="password" class="form-control" id="senha" placeholder="Senha"/>
				    <i class="fa fa-lock"></i>
				  </div>
				  <div id="message" class="txt-center mb10" ></div>
				  <button type="submit" class="btn btn-inverse btn-lg btn-block" id="join">Entrar</button>
				  	<div class="forget">
				  		<a href="cadastro">Cadastre-se</a><br />
				  		<a href="esqueciminhasenha">Esqueceu sua senha?</a> <br />
				  	</div>
				</form>
			</div>
			</div>
		</div>
	</div>
</section>

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
	<script src="js/boots.js"></script>
	<script src="js/app.js"></script>
	<script src="js/login.js"></script>
</body>
</html>