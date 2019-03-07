<?php include("template/_header.php"); ?>

	<section style="padding: 50px 0px;">
		<div class="container">
			<div class="row">
				<div class="box-login">
					<h2 class="ml20">Cadastro</h2>	
					<div class="col-md-5">
						<p>
							Para melhor jogabilidade recomendamos que utilize o cadastro com o Facebook abaixo:
						</p> <br />
						<div class="mb5">
							<a href="fbconfig" class="btn btn-block btn-social btn-lg btn-facebook" title="Logue com o facebook" id="facebook-login" style="font-size:13px;"><i class="fa fa-facebook"></i>Cadastre-se com Facebook</a>
						</div>
						<p class="txt-center">Nada será publicado em sua Timeline!</p>
						<br />
					</div>
					<div class="col-md-7">			
						<form action="javascript:void(0)">
							<div id="message"></div>
							<div class="form-group">
							  	<label for="nome">Nome</label>
							    <input type="text" class="form-control" id="nome" required/>
							</div>
							<div class="form-group">
							  	<label for="email">E-mail</label>
							    <input type="email" class="form-control" id="email" />
							</div>
							<div class="form-group">
							  	<label for="senha">Senha</label>
							    <input type="password" class="form-control w50" id="senha" />
							</div>
							<div class="form-group">
							  	<label for="senha">Confirme sua senha</label>
							    <input type="password" class="form-control w50" id="senha_confirm" />
							</div>

							<button type="submit" class="btn btn-inverse btn-lg btn-block w50" id="join">Cadastre-se</button>
						</form>
					</div>
				</div>
			</div>
		</div>
	</section>
	<footer class="geral-container">
		<div class="container">
			<div class="row">
				<div class="icon"><div class="left mr10"><i class="fui-location"></i></div> CS Tecnologia - Rua José Bonifácio, 205 sala 108 – Recife/PE</div>
				<div class="icon"><div class="left mr10"><i class="fui-mail"></i></div> questoes@aprovagame.com.br</div>
			</div>
		</div>
	</footer>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
	<script src="js/boots.js"></script>
	<script src="js/app.js"></script>
	<script src="js/cadastro.js"></script>
</body>
</html>
