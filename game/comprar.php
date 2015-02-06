<?php include("template/_header.php"); ?>
	<section class="mainbox geral-container" style="overflow: hidden;">
		<div class="mb10" style="overflow: hidden;">
			<div class="container">

				<div class="row">
					<div class="col-md-12">
						<div class="container-mainbox">
							<header>
								<div class="header ml15 mr15">
									<h3>Loja</h3>
								</div>
							</header>
							<article>
								<div class="shop-firt-ad">
									<div class="col-md-6">
										<div class="w30 mr15 left"><img src="http://aws.provasdaoab.com.br/imagens/vantagem-300-questoes.png" alt="Aumente seu nível"></div>
										<div>
											<h3>300 questões extras</h3>
											<article>Aumente o número de questões disponíveis, para reforçar ainda mais seus estudos. São 300 perguntas extras! O que aumenta ainda mais suas chances de cumprir os desafios, aumentar seu nível e posição no ranking. </article>
										</div>
									</div>
									<div class="col-md-6">
										<div class="w30 mr15 left"><img src="http://aws.provasdaoab.com.br/imagens/vantagem-moedas.png" alt="Vencer os desafios"></div>
										<div>
											<h3>500 moedas</h3>
											<article>
												Acumule cinco mil moedas na sua conta, para pode comprar acesso e funcionalidades dentro do jogo. Quanto mais moedas você tiver, mais você poderá avançar no jogo, adquirindo funções como "pular uma questão" para responder depois e muito mais!
											</article>
										</div>
									</div>
								</div>

								<div class="shop-second-ad">
									<div class="col-md-6">
										<div class="left mr15 w30"><img src="http://cdn.aprovagame.com.br/img/vantagem-grafico.png" alt="Conferir seu desempenho"></div>
										<div>
											<h3>Conferir desempenho</h3>
											<article>Tenha ainda a sua disposição vários gráficos atualizados para acompanhar seu desempenho. Você vai poder identificar em quais matérias está melhor ou pior e ainda qual seu percentual de acerto das questões.</article>
										</div>
									</div>
									<div class="col-md-6">
										<div class="left mr15 w30"><img src="http://aws.provasdaoab.com.br/imagens/vantagem-sem-anuncios.png" alt="Vencer os desafios"></div>
										<div>
											<h3>Retire os anúncios</h3>
											<article>
												Ao adquirir a Versão Premium, você tem acesso a um layout mais limpo, sem as propagandas e anúncios que acabam atrapalhando sua concentração.
											</article>
										</div>
									</div>
								</div>
								
								<div class="text-center shop-plus">
									<h1>E para tornar seu jogo ainda mais legal, você ainda ganha 01 Bônus incrível!</h1>
								</div>

								<div class="shop-friend-invite">
									<div class="col-md-6">
										<div style="width: 80%"><img src="http://cdn.aprovagame.com.br/img/bonus.png" alt=""></div>
									</div>
									<div style="col-md-6">
										<h1 class="color-green">COMPRE 01, LEVE 02!</h1>
										<h2>Na compra de 01 assinatura semestral no Aprova Game, <strong>leve outra inteiramente GRÁTIS!</strong></h2>
										<p>Isso mesmo!</p>
										<p><strong>Você compra uma assinatura e leva duas!</strong> Uma para você e outra para dar a algum amigo ou parente que também esteja se preparando para a OAB!</p>
										<p>Vocês poderão jogar juntos e ainda acompanhar o desempenho um do outro através do ranking.</p>
									</div>
								</div>

								<div class="mt25 shop-buy">
									<p class="txt-center">
										De <del><span style="color: #ff0000;">R$ 97,00</span></del> por apenas R$ 57<br>
										ou em até 06 x R$ 10,17
									</p>
									<div>
										<a onclick="return false;" href="https://www.hotmart.net.br/checkout.html?order=B2495144B&off=s1sss3r0&checkoutMode=2" class="hotmart-fb mt10" class=""><img src="http://cdn.aprovagame.com.br/img/comprar.png" id="comprar-logado" alt="" width="370" height="162"></a>
									</div>									
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
		&copy; 2013-2014 - Todos os direitos reservados.
		</div>
	</footer>
	<script type="text/javascript">
	   var _mfq = _mfq || [];
	   (function() {
	       var mf = document.createElement("script"); mf.type = "text/javascript"; mf.async = true;
	       mf.src = "//cdn.mouseflow.com/projects/2160b7a6-3750-4b2c-9c9f-6e6dac83da6a.js";
	       document.getElementsByTagName("head")[0].appendChild(mf);
	   })();
	</script>
	<script type="text/javascript">
        function importHotmart(){ 
                var imported = document.createElement('script'); 
                imported.src = 'http://static.hotmart.net.br/checkout/widget.min.js'; 
                document.head.appendChild(imported); 
        } 
        importHotmart(); 
 </script> 

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
	<script src="js/boots.js"></script>
	<script src="js/flat-ui-pro.min.js"></script>
	<script src="js/respond.min.js"></script>
	<script src="js/jquery.cookie.js"></script>
	<script src="js/min/app.js"></script>
	<script src="js/min/usuario.js"></script>
	<script>
		$("#comprar-logado").bind('click', function(){
			ga('send', 'event', 'botao', 'Comprar Logado');
		});
	</script>
</body>
</html>