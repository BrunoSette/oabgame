	<div class="box-overlay" id="teste"></div>

	<footer class="geral-container game">
	<div class="container">
	<div class="row">
		&copy; 2016 - Todos os direitos reservados.
		</div>
	</div>
	</footer>
	<script>
		var tag = document.createElement('script');
		tag.src = 'https://www.youtube.com/iframe_api';

		var firstScriptTag = document.getElementsByTagName('script')[0];

		firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);

		function onYouTubeIframeAPIReady()
		{
			
		}

	</script>

	<script type="text/javascript">
	   var _mfq = _mfq || [];
	   (function() {
	       var mf = document.createElement("script"); mf.type = "text/javascript"; mf.async = true;
	       mf.src = "//cdn.mouseflow.com/projects/2160b7a6-3750-4b2c-9c9f-6e6dac83da6a.js";
	       document.getElementsByTagName("head")[0].appendChild(mf);
	   })();
	</script>
	<div id="fb-root"></div>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
	<script src="js/boots.js"></script>
	<script src="js/respond.min.js"></script>
	<script src="js/jquery.cookie.js"></script>
	<script src="js/app.js"></script>
	<script src="js/questoes.js"></script>
	<script src="js/usuario.js"></script>
	<script src="js/app.js"></script>
	<script src="js/usuario.js"></script>
	<script src="js/min/script.js"></script>
	<script src="https://code.highcharts.com/highcharts.js"></script>
	<script src="https://code.highcharts.com/highcharts-more.js"></script>
	<script src="https://code.highcharts.com/modules/solid-gauge.js"></script>
	<script>
		// FB.Event.subscribe('message.send', function(){
		// 	console.info("aqui");
		// });

		$("#fb-invite").bind('click', function(){
			ga('send', 'event', 'botao', 'Convidar Amigos');
			
			FB.ui({
	  			method: 'send',
	  			link: 'https://www.aprovagame.com.br',
			});
		});
	</script>

</body>
</html>