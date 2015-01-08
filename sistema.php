<?php 
session_start(); 

//if(!isset($_SESSION['id']) && !isset($_SESSION['FBID']) 
//        ||
//   !isset($_SESSION['FBID']) && !isset($_SESSION['id']) ){
//    header("Location: ../game_face/");
//}
 
if(!isset($_SESSION["FBID"]))
{
	header("Location: ../game_face/");
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
					<!-- <img src="img/profile_nivel/homem/nivel-1.png" alt="" /> -->
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

            <div class="iconbar iconbar-horizontal" style="display: none">
			  <ul>
			    <li><a href="#" class="fui-user"></a></li>
			    <li><a href="#" class="fui-gear"></a></li>
			    <li><a href="#" class="fui-info"></a></li>
			  </ul>
			</div>
		</div>
	</header>
	
	<div class="box-modal">
		<div class="box-content">
			<!-- <a href="#" id="close">
				<i class="fui-cross close"></i>
			</a> -->
			<h3></h3>
			<div>
				<p></p>
			</div>
			<p>
				<button class="btn btn-info" id="modal-action" data-tipo="fechar"></button>
			</p>
		</div>
	</div> <!-- Modal de comentário e resposta da questão-->

	<section class="mainbox geral-container" style="overflow: hidden;">
		<div class="container-mainbox left">
			<header>
				<!-- <h3 class="left"> --/-- </h3> -->
				<i att="fui-chat" class="fui-chat right mt10" id="notifica-erro"></i>
				<div class="right question-value mr25">
					E$ 20
				</div>
				<div class="right question-value mr10">
					+100 <div class="small" style="display: inline-block">pontos</div>
				</div>
				<div class="left subject"></div>
			</header>
			<article>
				<p class="question"> </p>
				
				<form action="javascript:void(0);">
					<ul>
						<li>
							<input type="radio" name="option" value="A" id="A" />
							<div>
								<label for="A">
									<p class='option left'>A</p>
									<p class="teste" style="box-sizing: border-box; padding-top: 5px; display: flex;" data-option="A">
										
									</p>
								</label>
							</div>
						</li>
						<li>
							<input type="radio" name="option" value="B" id="B" />
							<div>
								<label for="B">
									<p class='option left'>B</p>
									<p class="teste" style="box-sizing: border-box; padding-top: 5px; display: flex;" data-option="B">
										
									</p>	
								</label>
							</div>
						</li>
						<li>
							<input type="radio" name="option" value="C" id="C"/>
							<div>
								<label for="C">
									<p class='option left'>C</p>
									<p class="teste" style="box-sizing: border-box; padding-top: 5px; display: flex;" data-option="C">
										
									</p>
								</label>
							</div>
						</li>
						<li>
							<input type="radio" name="option" value="D" id="D"/>
							<div>
								<label for="D">
									<p class='option left'>D</p>
									<p class="teste" style="box-sizing: border-box; padding-top: 5px; display: flex;" data-option="D">
										
									</p>
								</label>
							</div>
						</li>
					</ul>
					<div class="options-help">
						<div id="eliminar-resposta">
							Eliminar Resposta
							<p>
								-E$ 5
							</p>
						</div>
						<div id="pular-pergunta">
							Pular Esta Pergunta
							<p>
								-E$ 5
							</p>
						</div>
						<div class="wrong">
							Errar
							<p>
								-E$ 10
							</p>
						</div>
					</div>
					<br />
					<button class="right mt25 mb20 btn btn-danger"><i class="fui-check"></i> Responder</button>
				</form>
			</article>
		</div>
		<div class="ranking-box">
			<header>
				<h3><i class="fa fa-trophy"></i> Ranking Geral</h3>
			</header>
			<article>
			</article>
		</div>
		<!-- <div class="hit-average mt10">
			<div id="container-speed" style="height: 200px;"></div>
		</div> -->
	</section>
	<div class="box-overlay"></div>
	<footer class="geral-container">
		&copy; 2013-2014 - Todos os direitos reservados.
	</footer>
	<script type="text/javascript">
	   var _mfq = _mfq || [];
	   (function() {
	       var mf = document.createElement("script"); mf.type = "text/javascript"; mf.async = true;
	       mf.src = "//cdn.mouseflow.com/projects/2160b7a6-3750-4b2c-9c9f-6e6dac83da6a.js";
	       document.getElementsByTagName("head")[0].appendChild(mf);
	   })();
	</script>
	<script src="js/jquery.min.js"></script>
	<script src="js/jquery.cookie.js"></script>
	<script src="js/app.js"></script>
	<script src="js/questoes.js"></script>
	<script src="js/usuario.js"></script>
	<script src="js/script.js"></script>
	<script src="http://code.highcharts.com/highcharts.js"></script>
	<script src="http://code.highcharts.com/highcharts-more.js"></script>
	<script src="http://code.highcharts.com/modules/solid-gauge.js"></script>
</body>
</html>