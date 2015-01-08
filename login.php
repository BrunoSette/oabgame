<!doctype html>
<html lang="pt">
<head>
	<meta charset="UTF-8">
	<title>Provas da OAB Game</title>
	<link rel="stylesheet" href="css/reset.css" />
	<link rel="stylesheet" href="css/web-font.css" />
	<link rel="stylesheet" href="css/all.css" />
	<script>
	  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
	  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
	  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
	  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

	  ga('create', 'UA-39597628-1', 'auto');
	  ga('send', 'pageview');
	</script>

	<!-- Start Visual Website Optimizer Asynchronous Code -->
	<script type='text/javascript'>
	var _vwo_code=(function(){
	var account_id=28713,
	settings_tolerance=2000,
	library_tolerance=2500,
	use_existing_jquery=false,
	// DO NOT EDIT BELOW THIS LINE
	f=false,d=document;return{use_existing_jquery:function(){return use_existing_jquery;},library_tolerance:function(){return library_tolerance;},finish:function(){if(!f){f=true;var a=d.getElementById('_vis_opt_path_hides');if(a)a.parentNode.removeChild(a);}},finished:function(){return f;},load:function(a){var b=d.createElement('script');b.src=a;b.type='text/javascript';b.innerText;b.onerror=function(){_vwo_code.finish();};d.getElementsByTagName('head')[0].appendChild(b);},init:function(){settings_timer=setTimeout('_vwo_code.finish()',settings_tolerance);this.load('//dev.visualwebsiteoptimizer.com/j.php?a='+account_id+'&u='+encodeURIComponent(d.URL)+'&r='+Math.random());var a=d.createElement('style'),b='body{opacity:0 !important;filter:alpha(opacity=0) !important;background:none !important;}',h=d.getElementsByTagName('head')[0];a.setAttribute('id','_vis_opt_path_hides');a.setAttribute('type','text/css');if(a.styleSheet)a.styleSheet.cssText=b;else a.appendChild(d.createTextNode(b));h.appendChild(a);return settings_timer;}};}());_vwo_settings_timer=_vwo_code.init();
	</script>
	<!-- End Visual Website Optimizer Asynchronous Code -->

</head>
<body> 
    
	<header class="topo">
		<div class="geral-container">
			<img src="img/logo.png" style="width: 180px; margin-top: 5px;" alt="">

			<button class="btn right mt20 btn-login" id="entrar">Entrar</button>

			<div class= "tooltip" style="display: none">
				<div style="position: fixed; color: #fff; top: 60px; right: 6.5%;"><span class="fui-triangle-up"></span></div>
				<a href="fbconfig.php" >
            		<button class="btn btn-social-facebook mt10 w100 fb-link" style="padding: 5px; font-size: 0.9em;">
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
				<p class="txt-center mb10"><a href="./esqueci-senha" style="color: #7F8C8D; text-decoration: none;">Esqueci minha senha</a></p>       
			</div>             
		</div>
	</header>
	<div class="box-modal">
		<div class="box-content">
			
			<a href="#" id="close">
				<i class="fui-cross close"></i>
			</a>

			<h3>Efetue seu cadastro</h3>
			<div>
				<p>
					<a href="fbconfig.php"><img src="img/facebook-cadastro.png" alt="" style="margin-left: 22%;"></a>
					<form action="javascript:void(0);" class="form form-aligned">
						<div class="control-group">
            				<label for="nome" class="left">Nome</label>
            				<input type="text" class="w60" name="nome" id="nome">
        				</div>
        				<div class="cadastro-error" id="error-nome" style="display: none; top: 60px; right: -70px;"></div>
        				<div class="control-group">
            				<label for="email" class="left">E-mail</label>
            				<input type="email" class="w60" name="email" id="email">
        				</div>
        				<div class="cadastro-error" id="error-email" style="display: none; top: 105px; right: -55px;"></div>
        				<div class="control-group">
            				<label for="senha" class="left">Senha</label>
            				<input type="password" name="senha" id="senha">
        				</div>
        				<div class="cadastro-error" id="error-senha" style="display: none; top: 148px; right: 215px;"></div>
					</form>
				</p>
				<!-- <p class="txt-center">Ou entre utilizando o <a href="fbconfig.php" style="color: inherit;" class="fb-link">Facebook</a></p> -->
			</div>
			<p>
				<button class="btn btn-info" id="join">Cadastrar-se</button>
			</p>
		</div>
	</div>

	<section class="headbox">
		<!-- <h1>Sistema Indisponível no momento</h1>
		<h3 class="mt20 mb40">
			Estamos passando por uma rápida manutenção, mas em breve estaremos de volta! :)
		</h3> -->
		<h1>Estude de Forma Divertida para a OAB</h1>
		<h3 class="mt20 mb40">
			Nunca foi tão divertido aprender! Aproveite os momentos de lazer e teste seus conhecimentos em Direito, através deste Jogo Online.
		</h3>
		<br />
		<button class="btn btn-danger mt10 w30" id="start">Começar agora</button>
	</section>
	<section class="geral-container icons">
		<ul>
			<li>
				<embed src="img/play2.svg" type="image/svg+xml" />
				<h3>Desafie seus amigos</h3><br /><br />
				<p>Encontre amigos que também estejam estudando para a OAB e os desafie. Você e eles ainda poderão opinar e discutir sobre os conteúdos das questões!</p>
			</li>
			<li>
				<embed src="img/cap.svg" type="image/svg+xml" />
				<h3>Acumule pontos e torne-se um expert</h3>
				<p>Neste jogo, quanto mais questões você acertar, mais pontos acumulados você terá. Então, pratique sempre e aumente sua pontuação no ranking geral.</p>
			</li>
			<li>
				<embed src="img/graphic.svg" type="image/svg+xml" />
				<h3>Acompanhe seu desenvolvimento</h3>
				<p>Analise seu desempenho e dos seus oponentes através de gráficos interativos e reforce os estudos onde estiver com mais deficiências.</p>
			</li>
		</ul>
	</section>

	<div class="box-overlay"></div>

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
			<li><a href="politica.php">Privacidade</a></li>
		</ul>
		<br />
		<p><div class="left mr10"><i class="fui-mail"></i></div> questoes@provasdaoab.com.br</p>  
	</footer>
	<script src="js/jquery.min.js"></script>
	<script src="js/jquery.cookie.js"></script>
	<script src="js/app.js"></script>
	<script src="js/login.js"></script>
</body>
</html>