<?php 
session_start(); 
 
if(!isset($_SESSION["FBID"]))
{
	header("Location: ../game/");
}

?>

<!doctype html>
<html lang="pt">
<head>
	<meta charset="UTF-8">
	<title>Provas da OAB Game</title>
	<link rel="stylesheet" href="css/reset.css" />
	<link rel="stylesheet" href="css/web-font.css" />
	<link rel="stylesheet" href="css/all.css" />
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
		<div class="geral-container">
			<img src="img/logo.png" class="logo" alt="">
			<div class="right" id="user-box" style="color: #fff; margin-top: 10px; background-color: #3A546E; padding: 5px; cursor: pointer">
				<?php if (isset($_SESSION["PICTURE"])) { ?>
                    <img src="<?php echo $_SESSION["PICTURE"]; ?> " alt="" style="vertical-align: middle">
            	<?php } else { ?>
            		<img src="img/sem-foto.png" alt="" style="vertical-align: middle">
				<?php } ?>
				<div style="display: inline-block;">
					<?php echo $nome; ?> <i class="fui-triangle-down small" id="btn_abrir_tool"></i>
				</div>
			</div>
			
			<div class= "tooltip" style="display: none; top: 70px; background-color:#ECF0F1">
				<div style="position: fixed; color: #ECF0F1; top: 55px; right: 6.5%;"><i class="fui-triangle-up"></i></div>
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
			</div>  

            <div class="iconbar iconbar-horizontal">
			  <ul>
			  	<li><a href="index.php" class="fui-home"></a></li>
			    <li><a href="perfil.php" class="fui-user"></a></li>
			    <li><a href="#" class="fa fa-area-chart"></a></li>
			    <li><a href="config.php" class="fui-gear"></a></li>
			  </ul>
			</div>
		</div>
	</header>