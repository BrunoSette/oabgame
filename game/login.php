<?php include("template/_header.php"); ?>

	<section class="land-login">
		<div class="container">
			<div class="row">
			<div class="col-md-4 col-md-offset col-xs-offset-1 col-sm-offset-1">
				<figure> <img src="img/logo.png" alt="Logomarca OABgame" /> </figure>
			</div>
			<div class="col-md-5 col-sm-offset">
			<div class="box-login">
				<!-- <div class="alert alert-warning">Estamos realizando uma manutenção crítica, em 2h o sistema estará disponível para acesso</div> -->
				<form action="javascript:void(0)" novalidate>
					<div class="bt-login">
						<a href="fbconfig" class="btn btn-block btn-social btn-lg btn-facebook" title="Logue com o facebook" style="font-size:13px;"><i class="fa fa-facebook"></i>Login com Facebook</a>
					</div>
					  <p class="mb10 txt-center">ou</p>
					  <div class="form-group icon-name">
					    <input type="email" class="form-control" id="email" placeholder="E-mail"/>
					    <i class="fa fa-users"></i>
					  </div>
					  <div class="form-group icon-name">
					    <input type="password" class="form-control" id="senha" placeholder="Senha"/>
					    <i class="fa fa-lock"></i>
					  </div>
					  <div id="message" class="txt-center mb10" ></div>
					  <button type="submit" class="btn btn-inverse btn-lg btn-block" id="join">Entrar</button>
					  	<div class="forget">
					  		<a href="cadastro">Cadastre-se</a><br />
					  		<a href="esqueciminhasenha">Esqueceu sua senha?</a> <br />
					  	</div>
					</form>
				</div>
				</div>
			</div>
		</div>
	</section>
	</script>

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
	<script src="js/boots.js"></script>
	<script src="js/app.js"></script>
	<script src="js/login.js"></script>
</body>
</html>