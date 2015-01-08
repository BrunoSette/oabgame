<!doctype html>
<html lang="pt">
<head>
	<meta charset="UTF-8">
	<title>Provas da OAB Game</title>
	<link rel="stylesheet" href="../css/reset.css" />
	<link rel="stylesheet" href="../css/web-font.css" />
	<link rel="stylesheet" href="../css/all.css" />
	<script>
	  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
	  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
	  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
	  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

	  ga('create', 'UA-39597628-1', 'auto');
	  ga('send', 'pageview');
	</script>
</head>
<body> 
    
	<header class="topo">
		<div class="geral-container">
			<a href="../index.php"><img src="../img/logo.png" style="width: 15%; margin-top: 5px;" alt=""></a>

			<button class="btn right mt20 btn-login" id="entrar">Entrar</button>

			<div class= "tooltip" style="display: none">
				<div style="position: fixed; color: #fff; top: 60px; right: 6.5%;"><span class="fui-triangle-up"></span></div>
				<a href="../fbconfig.php" >
            		<button class="btn btn-social-facebook mt10 w100" style="padding: 5px; font-size: 0.9em;">
						<i class="fui-facebook"></i>
            			Usando Facebook
					</button>
        		</a>
				
				<p class="mt5 mb5 txt-center">ou</p>

				<form action="javascript:void(0)">
					<input type="text" placeholder="E-mail" id="emailLogin" class="w100 mb10">
					<input type="password" placeholder="Senha" id="senhaLogin" class="w100 mb10">
					<div id="message" class="mb5 txt-center"></div>
					<button class="btn btn-primary w100 mb5" id="login" style="padding: 4px; font-size: 0.9em;">Entrar</button>
				</form>
				<p class="txt-center mb10"><a href="" style="color: #7F8C8D; text-decoration: none;">Esqueci minha senha</a></p>       
			</div>             
		</div>
	</header>

	<section class="geral-container">
		
	</section>
	
	<footer class="geral-container">
		<p class="left">&copy; 2013-2014 - Todos os direitos reservados.</p>
		<ul class="right">
			<li><a href="https://www.facebook.com/ProvasDaOAB"><i class="fui-facebook"></i></a></li>
			<li><a href="https://plus.google.com/+ProvasdaoabBr/" ><i class="fui-googleplus"></i></a></li>
		</ul>
		<br />
		<ul class="nav-footer">
			<li><a href="#">Sobre</a></li>
			<li><a href="#">Normas</a></li>
			<li><a href="#">Privacidade</a></li>
		</ul>
	</footer>
	<script src="../js/jquery.min.js"></script>
	<script src="../js/jquery.cookie.js"></script>
	<script src="../js/app.js"></script>
	<script src="../js/login.js"></script>
</body>
</html>