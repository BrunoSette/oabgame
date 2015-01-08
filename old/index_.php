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
		<div class="geral-container">
			<h2 class="left">Título do Jogo</h2>
			<div class="right mt10">
				<form action="javascript:void(0)">
					<input type="text" placeholder="E-mail" id="emailLogin">
					<input type="password" placeholder="Senha" id="senhaLogin">
					<button class="btn btn-primary btn-xs" id="login">Entrar</button>
				</form>
			</div>
		</div>
	</header>
	
	<div class="box-modal">
		<div class="box-content">
			
			<a href="#" id="close">
				<i class="fui-cross close"></i>
			</a>

			<h3>Efetue seu cadastro</h3>
			<div>
				<p>
					<form action="javascript:void(0);" class="form form-aligned">
						<div class="control-group">
            				<label for="nome">Nome</label>
            				<input type="text" class="w60" name="nome" id="nome">
        				</div>
        				<div class="control-group">
            				<label for="email">E-mail</label>
            				<input type="email" class="w60" name="email" id="email">
        				</div>
        				<div class="control-group">
            				<label for="senha">Senha</label>
            				<input type="password" name="senha" id="senha">
        				</div>
					</form>
				</p>
			</div>
			<p>
				<button class="btn btn-info" id="join">Cadastrar-se</button>
			</p>
		</div>
	</div>

	<section class="headbox">
		<h1>Estude de Forma Divertida para a OAB</h1>
		<h3 class="mt20 mb40">
			Nunca foi tão divertido aprender! Aproveite os momentos de lazer e teste seus conhecimentos em Direito, através deste Jogo Online.
		</h3>
		<button class="btn btn-danger" id="start">Comece Agora</button>
	</section>
	<section class="geral-container icons">
		<ul>
			<li>
				<embed src="img/play2.svg" type="image/svg+xml" />
				<h3>Desafie seus amigos</h3><br /><br />
				<p>Encontre amigos que também estejam estudando para a OAB e os desafie. Você e eles ainda poderão opinar e discutir sobre os conteúdos das questões!</p>
			</li>
			<li>
				<embed src="img/cap.svg" type="image/svg+xml" />
				<h3>Acumule pontos e torne-se um expert</h3>
				<p>Neste jogo, quanto mais questões você acertar, mais pontos acumulados você terá. Então, pratique sempre e aumente sua pontuação no ranking geral.</p>
			</li>
			<li>
				<embed src="img/graphic.svg" type="image/svg+xml" />
				<h3>Acompanhe seu desenvolvimento</h3>
				<p>Analise seu desempenho e dos seus oponentes através de um gráfico interativo e reforce os estudos onde estiver com mais deficiências.</p>
			</li>
		</ul>
	</section>

	<div class="box-overlay"></div>

	<footer class="geral-container">&copy; 2013-2014 - Todos os direitos reservados. </footer>
	<script src="js/jquery.min.js"></script>
	<script src="js/jquery.cookie.js"></script>
	<script src="js/app.js"></script>
	<script src="js/login.js"></script>
</body>
</html>