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
	<div id="fb-root"></div>
	
	<header class="topo">	
	<nav class="navbar navbar-inverse">
      <div class="container">
        <div class="navbar-header">
			<a class="navbar-brand" href="#"><img src="img/logo.png" class="logo" alt="logomarca" /></a>

          	<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            	<span class="sr-only">Toggle navigation</span>
            	<span class="icon-bar"></span>
            	<span class="icon-bar"></span>
            	<span class="icon-bar"></span>
          	</button>
          
        </div>
		
        <!-- foto do aluno -->
		<div class="navbar-right" id="user-box" style="color: #fff; margin-top: 10px; background-color: #3A546E; padding: 5px; cursor: pointer;">
        	<img src="" alt="" id="userImage" style="vertical-align: middle; height: auto; width: auto; max-height: 55px; max-width: 250px;" />
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