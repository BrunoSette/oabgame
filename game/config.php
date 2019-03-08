<?php include("template/_header.php"); ?>
	<section class="mainbox geral-container">
	<div class="container">
	 <div class="row">
		<div class="container-mainbox ">
			<div class="header ml15 mr15">
			<header>
				<h3>Configurações</h3>
			</header>
			</div>
			
			<div class="form_config">
			<form class="" action="javascript:void(0);">
				<div class="form-group col-sm-5">
				  	<h4>Perfil</h4>
				    <label for="nome" class="control-label">Nome</label>
				    <input type="text" value="" class="form-control" id="nome" >
				</div>
				   <div class="form-group col-sm-5" style="float:none">
				    <label for="localizacao" class="control-label">Localização</label>
				    <div class="">
				      <input type="text" class="form-control" id="localizacao" placeholder="localização">
				    </div>
				  </div>
				    <div class="form-group col-sm-5">
				    <label for="aniversario" class="control-label">Aniversário</label>
				    <div class="">
				      <input type="date" class="form-control" id="aniversario" placeholder="aniversario">
				    </div>
				  </div>
				<br class="clear" />
				
				<div class="form-group col-sm-5">
				<h4>Acesso</h4>
<!-- 				    <label for="email" class="control-label">Email</label>
				    <div class="">
				      <input type="email" class="form-control" id="email" placeholder="Email">
				    </div> -->
				  </div> 
				  <div class="form-group col-sm-5" style="float:none">
				    <label for="nova-senha" class="control-label">Nova senha</label>
				    <div class="">
				      <input type="password" class="form-control" id="nova-senha" placeholder="****">
				    </div>
				  </div>
				  <div class="form-group col-sm-5" id="confirma-senha">
				    <label for="confirm-nova-senha" class="control-label">Confirma Nova Senha</label>
				    <div class="">
				      <input type="password" class="form-control" id="confirm-nova-senha" placeholder="****">
				    </div>
				  </div>
				<br class="clear" />
				 
				  <br class="clear" />
				  <div class="form-group col-sm-5">
				   <h4>Notificações</h4>
				    <div class="">
				      <div class="">
				        <label>
				          <input type="checkbox" name="notificacoes" id="notificacoes" /> Enviar por e-mail diariamente um lembrete para eu praticar. 
				        </label>
				      </div>
				    </div>
				  </div>
				  <div class="form-group">
				    <div class="col-sm-10">
				      <button type="submit" class="btn btn-primary" id="atualizar">Atualizar</button>
				    </div>
				  </div>
				 </div>
				</form>

		</div><!-- /container-mainbox -->
		</div><!-- /row -->
	</div><!-- /continer -->
	</section>
	<div class="box-overlay"></div>
	<footer class="geral-container game">
	<div class="container">
		<!-- <div class="row">
			&copy; 2014-2015 - Todos os direitos reservados.
		</div> -->
	</div>
	</footer>

	 <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
	<script src="js/boots.js"></script>
	<script src="js/flat-ui-pro.min.js"></script>
	<script src="js/respond.min.js"></script>
	<script src="js/jquery.cookie.js"></script>
	<script src="js/app.js"></script>
	<script src="js/questoes.js"></script>
	<script src="js/usuario.js"></script>
	<script src="js/config.js"></script>
</body>
</html>