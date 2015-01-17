<?php 
session_start(); 
if(!isset($_SESSION["FBID"])) header("Location: ../");
?>

<!doctype html>
<html lang="pt">
<head>

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

	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=2.0" />

	<title>AprovaGame</title>
	<link rel="stylesheet" href="css/all.css" />
	<link rel="stylesheet" href="http://cdn.aprovagame.com.br/css/glycon_boots.css" />
	<link rel="stylesheet" href="css/web-font.css" />
	<link rel="stylesheet" href="css/font-awesome.min.css" />
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
		<?php  
			$fullName = explode(" ", $_SESSION["FULLNAME"]);
			$nome = $fullName[0];
		?>
		
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
			<?php if (isset($_SESSION["PICTURE"])) { ?>
                <img src="<?php echo $_SESSION["PICTURE"]; ?> " alt="" style="vertical-align: middle">
        	<?php } else { ?>
        		<img src="img/sem-foto.png" alt="" style="vertical-align: middle" />
			<?php } ?>
			<div style="display: inline-block;">
				<?php echo $nome; ?> <i class="fui-triangle-down small" id="btn_abrir_tool"></i>
			</div>
		</div><!-- /foto do aluno -->
		
			<div class= "tooltip-sys" style="display: none; top: 70px; background-color:#ECF0F1">
				<div class="icon-set"><i class="fui-triangle-up"></i></div>
				<div class="mb5 mt5 image-profile">
				</div>
				<div class="txt-profile">
					<div>
						<div class="left mr25">
							<img src="img/coin.png" class="left mr5" alt=" "> <i id="userCash"><?php echo $_SESSION["MOEDAS"]; ?></i>
						</div>
						<div class="left mr25">
							<i id="userScore"><?php echo $_SESSION["PONTUACAO"]; ?></i>
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
			  	<li><a href="index.php" title="game"><i class="fa fa-gamepad"></i><div class="menu-mobile">game</div></a></li>
		    	<li><a href="perfil.php" title="perfil"><i class="fui-user"></i><div class="menu-mobile">perfil</div></a></li>
		    	<li><a href="graficos.php" title="estatistica"><i class="fa fa-area-chart"></i><div class="menu-mobile">estatística</div></a></li>
			    <li><a href="config.php" title="configuração"><i class="fui-gear"></i><div class="menu-mobile">configuração</div></a></li>
	          </ul>
        </div><!--/.nav-collapse -->

    

       	</div>
      </div><!-- container -->
    </nav> 
		
	</header>


	