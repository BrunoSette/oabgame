<?php include("template/_header.php"); ?>
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
<?php include("template/_footer.php"); ?>