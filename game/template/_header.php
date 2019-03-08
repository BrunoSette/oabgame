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

	<!-- Google Analytics --> 
	<script>

	(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
	(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
	m=s.getElementsByTagName(o)[0];
	a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
	})(window,document,'script','//www.google-analytics.com/analytics.js','ga');

	<?php
	 //New Google Analytics code to set User ID.
	if (isset($_SESSION["FBID"]))
	{
	  	$gacode = "ga('create', 'UA-58671300-1', { 'userId': '%s' });";
		echo sprintf($gacode,$_SESSION["FBID"]);
	}

	?>

	</script>
	<script src="https://www.youtube.com/player_api" type="text/javascript"></script>
	

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
							<img src="img/coin.png" class="left mr5" alt=" "> <u id="userCash"></u>
						</div>
						<div class="left mr25">
							<u id="userScore"></u>
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
			    <li><a href="config" title="configuração"><i class="fui-gear"></i><div class="menu-mobile mll2">ajustes</div></a></li>
	          </ul>
        </div><!--/.nav-collapse -->

    

       	</div>
      </div><!-- container -->
    </nav> 
		
	</header>


	