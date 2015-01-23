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
									+100 
									<div class="small" style="display: inline-block">pontos</div>
								</div>
								<div class="question-value left">
									E$ 20
								</div>
								<i att="fui-chat" class="fui-chat" id="notifica-erro" style="margin:10px;"></i>
							</div>
						</div>

					</div>
				</div>
			</header>
			<article>
				<p class="question"> </p>
				
				<form action="javascript:void(0);">
				
					<ul>
						<li>
							<input type="radio" name="option" value="A" id="A" />
							<div>
								<label for="A" class="w100">
									<p class='option left'>A</p>
									<p class="teste" data-option="A"></p>
								</label>
							</div>
						</li>
						<li>
							<input type="radio" name="option" value="B" id="B" />
							<div>
								<label for="B" class="w100">
									<p class='option left'>B</p>
									<p class="teste" data-option="B"></p>	
								</label>
							</div>
						</li>
						<li>
							<input type="radio" name="option" value="C" id="C"/>
							<div>
								<label for="C" class="w100">
									<p class='option left'>C</p>
									<p class="teste"  data-option="C"></p>
								</label>
							</div>
						</li>
						<li>
							<input type="radio" name="option" value="D" id="D"/>
							<div>
								<label for="D" class="w100">
									<p class='option left'>D</p>
									<p class="teste" data-option="D"></p>
								</label>
							</div>
						</li>
					</ul>
				
					<div class="row">
						<div class="options-help col-md-offset-3">
							
							<div id="eliminar-resposta" class="btn btn-lg btn-primary col-xs-5 col-sm-4">
								<i class="fa fa-bomb"></i>Excluir
								<p class="valor">
									-E$ 5
								</p>
							</div>
							<div id="pular-pergunta" class="btn btn-lg btn-primary col-xs-5 col-sm-4">
								<i class="fa fa-history"></i>Pular
								<p class="valor">
									-E$ 5
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
				<h3><i class="fa fa-trophy"></i> Ranking Geral</h3>
			</header>
			<article>
			</article>
		</div>
		</div><!-- end/row -->
		</div><!-- end/container -->
	</section>
<?php include("template/_footer.php"); ?>