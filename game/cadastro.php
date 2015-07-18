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
	<title>AprovaGame</title>
	<link rel="stylesheet" href="css/all.css" />
	<link rel="stylesheet" href="http://cdn.aprovagame.com.br/css/glycon_boots.css" />
	<link rel="stylesheet" href="http://cdn.aprovagame.com.br/css/bootstrap.min.css" />
	<link rel="stylesheet" href="css/font-awesome.min.css" />
	<link rel="stylesheet" href="css/web-font.css" />



	<script>
	(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
	(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
	m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
	})(window,document,'script','//www.google-analytics.com/analytics.js','ga');

	ga('create', 'UA-58671300-1', 'auto');
	ga('send', 'pageview');

	// New Google Analytics code to set User ID.

	<?php
	 //New Google Analytics code to set User ID.
	 //$userId is a unique, persistent, and non-personally identifiable string ID.

	if (isset($_SESSION["FBID"]))
	{
	  	$gacode = "ga('create', 'UA-58671300-1', { 'userId': '%s' });";
		echo sprintf($gacode,$_SESSION["FBID"]);
	}
	?>

	ga('require', 'displayfeatures');
	ga('send', 'pageview');

	</script>

</head>
<body class="land">
	<header class="topo" style="border-bottom: 0px">	
		<nav class="navbar navbar-inverse">
	      	<div class="container">
		        <div class="navbar-header">
		        	<a class="navbar-brand" href="http://www.aprovagame.com.br/"><img src="img/logo.png" class="logo" alt="logomarca"></a>
		        </div>    
	       	</div>
	      	</div>
	    </nav> 
	</header>
	<section style="padding: 50px 0px;">
		<div class="container">
			<div class="row">
				<div class="box-login">
					<h2 class="ml20">Cadastro</h2>	
					<div class="col-md-5">
						<p>
							Para melhor jogabilidade recomendamos que utilize o cadastro com o Facebook abaixo:
						</p> <br />
						<div class="mb5">
							<a href="fbconfig" class="btn btn-block btn-social btn-lg btn-facebook" title="Logue com o facebook" id="facebook-login" style="font-size:13px;"><i class="fa fa-facebook"></i>Cadastre-se com Facebook</a>
						</div>
						<p class="txt-center">Nada será publicado em sua Timeline!</p>
						<br />
					</div>
					<div class="col-md-7">			
						<form action="javascript:void(0)">
							<div id="message"></div>
							<div class="form-group">
							  	<label for="nome">Nome</label>
							    <input type="text" class="form-control" id="nome" required/>
							</div>
							<div class="form-group">
							  	<label for="email">E-mail</label>
							    <input type="email" class="form-control" id="email" />
							</div>
							<div class="form-group">
							  	<label for="senha">Senha</label>
							    <input type="password" class="form-control w50" id="senha" />
							</div>
							<div class="form-group">
							  	<label for="senha">Confirme sua senha</label>
							    <input type="password" class="form-control w50" id="senha_confirm" />
							</div>

							<button type="submit" class="btn btn-inverse btn-lg btn-block w50" id="join">Cadastre-se</button>
						</form>
					</div>
				</div>
			</div>
		</div>
	</section>
	<footer class="geral-container">
		<div class="container">
			<div class="row">
				<div class="icon"><div class="left mr10"><i class="fui-location"></i></div> CS Tecnologia - Rua José Bonifácio, 205 sala 108 – Recife/PE</div>
				<div class="icon"><div class="left mr10"><i class="fui-mail"></i></div> questoes@aprovagame.com.br</div>
			</div>
		</div>
	</footer>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
	<script src="js/boots.js"></script>
	<script src="js/respond.min.js"></script>
	<script src="js/jquery.cookie.js"></script>
	<script src="js/min/app.js"></script>
	<script src="js/cadastro.js"></script>


</body>
</html>