<!doctype html>
<html lang="pt">
<head>
	<link rel="apple-touch-icon" sizes="57x57" href="../favicons/apple-touch-icon-57x57.png">
	<link rel="apple-touch-icon" sizes="114x114" href="../favicons/apple-touch-icon-114x114.png">
	<link rel="apple-touch-icon" sizes="72x72" href="../favicons/apple-touch-icon-72x72.png">
	<link rel="apple-touch-icon" sizes="144x144" href="../favicons/apple-touch-icon-144x144.png">
	<link rel="apple-touch-icon" sizes="60x60" href="../favicons/apple-touch-icon-60x60.png">
	<link rel="apple-touch-icon" sizes="120x120" href="../favicons/apple-touch-icon-120x120.png">
	<link rel="apple-touch-icon" sizes="76x76" href="../favicons/apple-touch-icon-76x76.png">
	<link rel="apple-touch-icon" sizes="152x152" href="/favicons/apple-touch-icon-152x152.png">
	<link rel="apple-touch-icon" sizes="180x180" href="../favicons/apple-touch-icon-180x180.png">
	<link rel="icon" type="image/png" href="../favicons/favicon-192x192.png" sizes="192x192">
	<link rel="icon" type="image/png" href="../favicons/favicon-160x160.png" sizes="160x160">
	<link rel="icon" type="image/png" href="../favicons/favicon-96x96.png" sizes="96x96">
	<link rel="icon" type="image/png" href="../favicons/favicon-16x16.png" sizes="16x16">
	<link rel="icon" type="image/png" href="../favicons/favicon-32x32.png" sizes="32x32">
	<meta name="msapplication-TileColor" content="#00aba9">
	<meta name="msapplication-TileImage" content="../favicons/mstile-144x144.png">

	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=2.0" />
	<title>OABGame</title>
	<link rel="stylesheet" href="css/all.css" />
	<link rel="stylesheet" href="https://www.oabgame.com.br/game/css/glycon_boots.css" />
	<link rel="stylesheet" href="https://www.oabgame.com.br/game/css/bootstrap.min.css" />
	<link rel="stylesheet" href="css/font-awesome.min.css" />
	<link rel="stylesheet" href="css/web-font.css" />


</head>
<body class="land">
<header class="topo">	
	<nav class="navbar navbar-inverse">
      <div class="container">
        <div class="navbar-header">
			<a class="navbar-brand" href="index"><img src="img/logo.png" class="logo" alt="logomarca" /></a>
        </div>
      </div>
    </nav> 
</header>	
	<section style="padding: 0px 0px;">
		<div class="container">
			<div class="row">
				<div class="box-login">
					<h2 class="ml20">Esqueci minha senha</h2>
					<p class="ml20">Esqueceu sua senha?</p>
					<p class="ml20">Não se preocupe, nós te ajudaremos a recuperá-la. Basta informar seu e-mail abaixo:</p><br />
					<div id="message"></div>
					<div class="col-md-7">			
						<form action="javascript:void(0)">
							<div id="message"></div>
							<div class="form-group">
							  	<label for="email">E-mail</label>
							    <input type="email" class="form-control" id="email" />
							</div>
							<div class="form-group">
							  	<label for="resultado-soma" id="soma"></label>
							    <input type="text" class="form-control w50" id="resultado-soma" />
							</div>
							<button type="submit" class="btn btn-inverse btn-lg btn-block w30" id="recuperar">Continuar</button>
						</form>
					</div>
				</div>
			</div>
		</div>
	</section>
	<footer class="geral-container">
		<div class="container">
			<!-- <div class="row">
				<div class="icon"><div class="left mr10"><i class="fui-location"></i></div> CS Tecnologia - Rua José Bonifácio, 205 sala 108 – Recife/PE</div>
				<div class="icon"><div class="left mr10"><i class="fui-mail"></i></div> questoes@provasdaoab.com.br</div>
			</div> -->
		</div>
	</footer>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
	<script src="js/boots.js"></script>
	<script src="js/min/app.js"></script>
	<script src="js/esquecisenha.js"></script>
</body>
</html>