<?php include("template/_header.php"); ?>
	<section class="mainbox geral-container">
		<div class="mb10">
			<div class="container">
				<div class="row">
					<div class="col-md-12">
						<div class="container-mainbox">
							<header>
								<div class="header ml15 mr15">
									<h3>Desempenho por matéria</h3>
								</div>
							</header>
							<article>
								<p class="small">Percentual de Acerto das Questões por Matéria</p>
								<div>
									<canvas id="canvas" height="450" width="600"></canvas>
								</div>
							</article>
						</div>
					</div>
				</div>
			
				<div class="row">
					<div class="col-md-6">
						<div class="container-mainbox">
							<header>
							<div class="header ml15 mr15">
								<h3>Taxa de acerto no mês</h3>
							</div>
							</header>
							<article>
								<div>
									<canvas id="canvas_taxa_mes" height="450" width="600"></canvas>
								</div>
							</article>
						</div>
					</div>
					<div class="col-md-6">
						<div class="container-mainbox">
							<header>
							<div class="header ml15 mr15">
								<h3>Questões respondidas</h3>
							</div>
							</header>
							<article>
								<div>
									<canvas id="canvas_questoes" height="450" width="600"></canvas>
								</div>
							</article>
						</div>
					</div>
				</div><!-- /row -->
				
				<div class="row">
					<div class="col-md-6">
						<div class="container-mainbox">
							<header>
							<div class="header ml15 mr15">
								<h3>Percentual de Acerto Total</h3>
							</div>
							</header>
							<article>
								<div>
									<div id="container-speed" style="width: 550; height: 450px;"></div>
								</div>
							</article>
						</div>
					</div>
				</div>


			</div><!-- /container -->
		</div>
	</section>
	<div class="box-overlay"></div>
	<footer class="geral-container game">
		<div class="container">
		&copy; 2016 - Todos os direitos reservados.
		</div>
	</footer>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
	<script src="js/boots.js"></script>
	<script src="js/flat-ui-pro.min.js"></script>
	<script src="js/respond.min.js"></script>
	<script src="js/jquery.cookie.js"></script>
	<script src="js/app.js"></script>
	<script src="js/min/usuario.js"></script>
	<script src="js/graficos.js"></script>
	<script src="js/Chart.min.js"></script>
	<script src="js/min/script.js"></script>
	<script src="https://code.highcharts.com/highcharts.js"></script>
	<script src="https://code.highcharts.com/highcharts-more.js"></script>
	<script src="https://code.highcharts.com/modules/solid-gauge.js"></script>
</body>
</html>