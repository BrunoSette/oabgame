<?php 
session_start(); 

if(!isset($_SESSION["id"]))
{
	header("Location: ../game");
}

?>

<!doctype html>
<html lang="pt">
<head>
	<meta charset="UTF-8">
	<title>Approva Game</title>
	<link rel="stylesheet" href="css/reset.css" />
	<link rel="stylesheet" href="css/web-font.css" />
	<link rel="stylesheet" href="css/all.css" />
</head>
<body>
	<header>
		<?php $nome = explode(" ", $_SESSION["nome"]); ?>
		<div class="geral-container">
			<h2 class="left">Título do Jogo</h2>
			<p class="right" style="color: #fff; margin-top: 20px; margin-left: 10px"><?php echo $nome[0] ?>  <a href="#" id="linkSair" style="color: #fff">(Sair)</a></p>
			<!-- <img src="img/eu.png" alt="" class="right" style="margin-top: 10px;"> -->
			<div class="iconbar iconbar-horizontal">
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
			<h3></h3>
			<div>
				<p></p>
			</div>
			<p>
				<button class="btn btn-info" id="modal-action" data-tipo="fechar"></button>
			</p>
		</div>
	</div>

	<section class="mainbox">
		<div class="w90 container-mainbox">
			<header>
				<h3 class="left"> Questão <span></span></h3>
				
				<i att="fui-chat" class="fui-chat right mt10"></i>
				<div class="right question-value">
					E$ 20
				</div>
				<div class="right subject">
					
				</div>
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
									<p class="teste" style="box-sizing: border-box; padding-top: 5px;" data-option="A">
										
									</p>
								</label>
							</div>
						</li>
						<li>
							<input type="radio" name="option" value="B" id="B" />
							<div>
								<label for="B">
									<p class='option left'>B</p>
									<p class="teste" style="box-sizing: border-box; padding-top: 5px;" data-option="B">
										
									</p>	
								</label>
							</div>
						</li>
						<li>
							<input type="radio" name="option" value="C" id="C"/>
							<div>
								<label for="C">
									<p class='option left'>C</p>
									<p class="teste" style="box-sizing: border-box; padding-top: 5px;" data-option="C">
										
									</p>
								</label>
							</div>
						</li>
						<li>
							<input type="radio" name="option" value="D" id="D"/>
							<div>
								<label for="D">
									<p class='option left'>D</p>
									<p class="teste" style="box-sizing: border-box; padding-top: 5px;" data-option="D">
										
									</p>
								</label>
							</div>
						</li>
					</ul>

					<div class="options-help" style="display: none;">
						<div>
							Eliminar Resposta
							<p>
								-E$ 5
							</p>
						</div>
						<div>
							Pular Esta Pergunta
							<p>
								-E$ 10
							</p>
						</div>
						<div>
							Exibir Sugestão
							<p>
								-E$ 15
							</p>
						</div>
						<div class="wrong">
							Errar
							<p>
								-E$ 10
							</p>
						</div>
					</div>
					<button class="right mt40 mb20 btn btn-danger"><i class="fui-check"></i> Responder</button>
				</form>
			</article>
		</div>
	</section>
	<div class="box-overlay"></div>
	<footer class="geral-container">
		&copy; 2013-2014 - Todos os direitos reservados.
	</footer>
	<script src="js/jquery.min.js"></script>
	<script src="js/jquery.cookie.js"></script>
	<script src="js/app.js"></script>
	<script src="js/questoes.js"></script>
</body>
</html>