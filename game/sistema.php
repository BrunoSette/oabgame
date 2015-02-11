<?php include("template/_header.php"); ?>
	<section class="mainbox geral-container">
		<div class="container">
			
			<div class="row">
		
		<div class="container-mainbox col-md-8 mb20" style="">
			<header>
				<div class="header">
					<div class="row">
						<div class="subject col-md-6">
						<div style="background-color: #16A085;">						
						</div>
						</div>
						<div class="col-md-5">
							<div class="pontos right">
								<div class="question-value left">
								Acertar: 100
								<div class="small" style="display: inline-block">pontos</div>
								&nbsp; $5
								</div>
								<!-- <div class="question-value left">
									 
								</div> -->
								<!-- <i att="fui-chat" class="fui-chat" id="notifica-erro" style="margin:10px;"></i> -->
							</div>
						</div>

					</div>
				</div>
			</header>
			<article>
				<p class="question"> </p>
				
				<form action="javascript:void(0);">
				
					<ul id="alternativas"> </ul>
				
					<div class="row">
						<div class="options-help col-md-offset-3">
							
							<div id="eliminar-resposta" class="btn btn-lg btn-primary col-xs-5 col-sm-4">
								<i class="fa fa-bomb"></i>Excluir 1 Alternativa
								<p class="valor">
									-$10
								</p>
							</div>
							<div id="pular-pergunta" class="btn btn-lg btn-primary col-xs-5 col-sm-4">
								<i class="fa fa-history"></i>Pular Questão
								<p class="valor">
									-$10
								</p>
							</div>
						</div>
					</div><!-- /options-help -->
					<div class="row">
						<div class="col-md-4 col-md-offset-8">		
							<button class="right btn btn-danger" id="enviarResposta"><i class="fui-check"></i> Responder</button>
						</div>
					</div>
				</form>
			</article>
		</div>
		<!-- raking -->
		<div class="ranking-box col-md-4" style="">
			<header>
				<h3><i class="fa fa-trophy"></i> Ranking</h3>
			</header>
			<article>
			</article>
			<br />
			<button id="fb-invite" class="btn-block btn-social btn-lg btn-facebook btn-invite"><i class="fa fa-facebook"></i> Convidar Amigos</button><br />
			
			<div class="fb-like-box" data-href="https://www.facebook.com/aprovagame" data-colorscheme="light" data-show-faces="true" data-header="true" data-stream="false" data-show-border="false"></div><br />
			
			<!-- Lateral Aprova Game -->
			<?php if(!$_SESSION["PREMIUM"]) include("template/_ads.php"); ?>
		</div>
		</div><!-- end/row -->
		</div><!-- end/container -->
	
	</section>
<script>
</script>
<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
<?php include("template/_footer.php"); ?>