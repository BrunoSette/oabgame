<?php include("template/_header.php"); ?>
	<section class="mainbox geral-container" style="overflow: hidden;">
		<div style="overflow: hidden; margin-bottom: 10px;">
			<div class="container-mainbox w100 mb20">
				<header>
					<h3>Desempenho por matéria (%)</h3>
				</header>
				<article>
					<div style="width:100%">
						<p class="small">Percentual de Acerto das Questões por Matéria</p>
						<div>
							<canvas id="canvas" height="450" width="600"></canvas>
						</div>
					</div>
				</article>
			</div>
			<div class="container-mainbox left" style="width: 49%; margin-right: 2%; margin-bottom: 20px;">
				<header>
					<h3>Taxa de Acertos no mes</h3>
				</header>
				<article>
					<div>
						<canvas id="canvas_taxa_mes" height="450" width="600"></canvas>
					</div>
				</article>
			</div>
			
			<div class="container-mainbox left" style="width: 49%; margin-bottom: 20px">
				<header>
					<h3>Questões respondidas</h3>
				</header>
				<article>
					<div>
						<canvas id="canvas_questoes" height="450" width="600"></canvas>
					</div>
				</article>
			</div>
	
			<div class="container-mainbox left" style="width: 49%; margin-right: 2%;">
				<header>
					<h3>Percentual de Acerto Total</h3>
				</header>
				<article>
					<div>
						<canvas id="canvas_questoes" height="450" width="600"></canvas>
					</div>
				</article>
			</div>

		</div>
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
	<script src="js/usuario.js"></script>
	<script src="js/graficos.js"></script>
	<script src="js/script.js"></script>
	<script src="js/Chart.min.js"></script>
	<script src="http://code.highcharts.com/highcharts.js"></script>
	<script src="http://code.highcharts.com/highcharts-more.js"></script>
	<script src="http://code.highcharts.com/modules/solid-gauge.js"></script>
</body>
</html>