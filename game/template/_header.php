<?php 
session_start(); 
//if(!isset($_SESSION["FBID"])) header("Location: ./");
?>

<!doctype html>
<html lang="pt">
<head>
	<meta property="og:url" content="https://www.aprovagame.com.br" />
  	<meta property="og:site_name" content="Aprova Game"/>
  	<meta property="og:title" content="Aprender nunca foi tão divertido" />
  	<meta property="og:image" content="https://www.provasdaoab.com.br/aprovagame/game/img/logo.png" />

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

	<title>AprovaGame</title>
	<link rel="stylesheet" href="css/all.css" />
	<link rel="stylesheet" href="css/glycon_boots.css" />
	<link rel="stylesheet" href="css/web-font.css" />
	<link rel="stylesheet" href="css/font-awesome.min.css" />

	<!-- Google Analytics --> 
	<script>

	(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
	(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
	m=s.getElementsByTagName(o)[0];
	a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
	})(window,document,'script','//www.google-analytics.com/analytics.js','ga');

	// New Google Analytics code to set User ID.

	<?php
	 //New Google Analytics code to set User ID.
	if (isset($_SESSION["FBID"]))
	{
	  	$gacode = "ga('create', 'UA-58671300-1', { 'userId': '%s' });";
		echo sprintf($gacode,$_SESSION["FBID"]);
	}

	?>

	ga('require', 'displayfeatures');
	ga('send', 'pageview');

	</script>
	<script src="https://www.youtube.com/player_api" type="text/javascript"></script>
	<script>
		// Include the UserVoice JavaScript SDK (only needed once on a page)
		UserVoice=window.UserVoice||[];(function(){var uv=document.createElement('script');uv.type='text/javascript';uv.async=true;uv.src='//widget.uservoice.com/Z9b5Wod1CzErI3dGsjo1iA.js';var s=document.getElementsByTagName('script')[0];s.parentNode.insertBefore(uv,s)})();

		// Set colors
		UserVoice.push(['set', {
		  accent_color: '#6aba2e',
		  trigger_color: 'white',
		  trigger_background_color: '#e23a39'
		}]);

		// Identify the user and pass traits
		// To enable, replace sample data with actual user traits and uncomment the line
		var userEmail = <?php echo json_encode($_SESSION['EMAIL']); ?>;
		var userName = <?php echo json_encode($_SESSION['FULLNAME']); ?>;

		UserVoice.push(['identify', {
		  email:      userEmail,
		  name:       userName

		}]);

		// Add default trigger to the bottom-right corner of the window:
		UserVoice.push(['addTrigger', { mode: 'satisfaction', trigger_position: 'bottom-right' }]);

		// Or, use your own custom trigger:
		//UserVoice.push(['addTrigger', '#id', { mode: 'satisfaction' }]);

		// Autoprompt for Satisfaction and SmartVote (only displayed under certain conditions)
		UserVoice.push(['autoprompt', {}]);
	</script>

	<!-- End Google Analytics -->


</head>
<body>
	<div id="fb-root"></div>
	<script>
		(function(d, s, id) {
		  var js, fjs = d.getElementsByTagName(s)[0];
		  if (d.getElementById(id)) return;
		  js = d.createElement(s); js.id = id;
		  js.src = "//connect.facebook.net/pt_BR/sdk.js#xfbml=1&appId=604815266237503&version=v2.0";
		  fjs.parentNode.insertBefore(js, fjs);
		}(document, 'script', 'facebook-jssdk'));
	</script>
	
	<header class="topo">
	<?php  $fullName = explode(" ", $_SESSION["FULLNAME"]); $nome = $fullName[0];?>
		
	<nav class="navbar navbar-inverse">
      <div class="container">
        <div class="navbar-header">
			<a class="navbar-brand" href="index"><img src="img/logo.png" class="logo" alt="logomarca" /></a>

          	<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            	<span class="sr-only">Toggle navigation</span>
            	<span class="icon-bar"></span>
            	<span class="icon-bar"></span>
            	<span class="icon-bar"></span>
          	</button>
          
        </div>
		
        	<!-- foto do aluno -->
		<div class="navbar-right" id="user-box" style="color: #fff; margin-top: 10px; background-color: #3A546E; padding: 5px; cursor: pointer;">
			<?php if (isset($_SESSION["PICTURE"]) && $_SESSION["PICTURE"]) { ?>
                <img src="<?php echo $_SESSION["PICTURE"]; ?> " alt="" style="vertical-align: middle">
        	<?php } else { ?>
        		<img src="img/sem-foto.png" alt="" style="vertical-align: middle" />
			<?php } ?>
			<div style="display: inline-block;">
				Eu <i class="fui-triangle-down small" id="btn_abrir_tool"></i>
			</div>
			<?php if($_SESSION["PREMIUM"]) { ?>
	        	<img src='img/usuario_premium.png' alt='' class='left mr10' style='width: 50px' />
        	<?php } ?>
		</div><!-- /foto do aluno -->
		
			<div class= "tooltip-sys" style="top: 70px;">
				<div class="icon-set"><i class="fui-triangle-up"></i></div>
				<div class="mb5 mt5 image-profile">
				</div>
				<div class="mb10 txt-center">
					<?php echo $_SESSION["FULLNAME"]; ?>
				</div>
				<div class="txt-profile">
					<div>
						<div class="left mr25">
							<img src="img/coin.png" class="left mr5" alt=" "> <u id="userCash"><?php echo $_SESSION["MOEDAS"]; ?></u>
						</div>
						<div class="left mr25">
							<u id="userScore"><?php echo $_SESSION["PONTUACAO"]; ?></u>
							<p class="small">pontos</p>
						</div>
						<p class="txt-center nivel"></p>
					</div>
				</div> 
				<button class="btn btn-info w100 mt5 mb5" id="linkSair"><i class="fui-exit"></i> Sair do Jogo</button>
			</div> <!--/display-none -->
        <div class="order-menu">
          <div id="navbar" class="collapse navbar-collapse iconbar iconbar-horizontal order-1">
	         <ul class="nav navbar-nav">
			  	<li><a href="index" title="game"><i class="fa fa-gamepad"></i><div class="menu-mobile ">game</div></a></li>
		    	<li><a href="perfil" title="perfil"><i class="fui-user"></i><div class="menu-mobile ">perfil</div></a></li>
		    	<li><a href="graficos" title="estatistica"><i class="fa fa-area-chart"></i><div class="menu-mobile mll5">gráficos</div></a></li>
		    	<?php if(!$_SESSION["PREMIUM"]) echo "<li><a href='comprar' id='comprar' title='comprar'><i class='fa fa-shopping-cart'></i><div class='menu-mobile mll5'>comprar</div></a></li>"; ?>
			    <li><a href="config" title="configuração"><i class="fui-gear"></i><div class="menu-mobile mll2">ajustes</div></a></li>
	          </ul>
        </div><!--/.nav-collapse -->

    

       	</div>
      </div><!-- container -->
    </nav> 
		
	</header>


	