<?php include("template/_header.php"); ?>
	<section style="padding: 50px 0px;">
		<div class="container">
			<div class="row">
				<div class="box-login">
					<h2 class="ml20">Recuperação de senha</h2>
					<p class="ml20">Esqueceu sua senha?</p>
					<p class="ml20">Redefina sua senha abaixo:</p><br />
					<div id="message"></div>
					<div class="col-md-7">			
						<form action="javascript:void(0)">
							<div id="message"></div>
							<div class="form-group">
							  	<label for="senha">Senha</label>
							    <input type="password" class="form-control w50" id="senha" />
							</div>
							<div class="form-group">
							  	<label for="confirma_senha">Confirme sua senha</label>
							    <input type="password" class="form-control w50" id="confirma_senha" />
							</div>
							<input type="hidden" id="api_key" value="<?php echo $_GET['api_key'] ?>"/>
							<button type="submit" class="btn btn-inverse btn-lg btn-block w30" id="recuperar_fim">Continuar</button>
						</form>
					</div>
				</div>
			</div>
		</div>
	</section>
	<footer class="geral-container">
		<div class="container">
			<div class="row">
				<!-- <div class="icon"><div class="left mr10"><i class="fui-location"></i></div> CS Tecnologia - Rua José Bonifácio, 205 sala 108 – Recife/PE</div>
				<div class="icon"><div class="left mr10"><i class="fui-mail"></i></div> questoes@provasdaoab.com.br</div> -->
			</div>
		</div>
	</footer>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
	<script src="js/boots.js"></script>
	<script src="js/respond.min.js"></script>
	<script src="js/jquery.cookie.js"></script>
	<script src="js/min/app.js"></script>
	<script src="js/esquecisenha.js"></script>
</body>
</html>