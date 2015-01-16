<?php include("template/_header.php"); ?>
	<section class="mainbox geral-container">
	<div class="container">
	 <div class="row">
		<div class="container-mainbox ">
			<div class="header">
			<header>
				<h3>Configurações</h3>
			</header>
			</div>
			
			<div class="form_config">
			<form class="" action="javascript:void(0);">
				
				  <div class="form-group col-sm-5">
				  <h4>Perfil</h4>
				    <label for="nome" class=" ontrol-label">Nome</label>
				    <div class="">
				      <input type="text" class="form-control" id="nome" placeholder="nome">
				    </div>
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
				    <label for="email" class="control-label">Email</label>
				    <div class="">
				      <input type="email" class="form-control" id="email" placeholder="Email">
				    </div>
				  </div> 
				  <div class="form-group col-sm-5" style="float:none">
				    <label for="nova-senha" class="control-label">Nova senha</label>
				    <div class="">
				      <input type="password" class="form-control" id="nova-senha" placeholder="****">
				    </div>
				  </div>
				  <div class="form-group col-sm-5">
				    <label for="confirm-nova-senha" class="control-label">Confirma Nova Senha</label>
				    <div class="">
				      <input type="password" class="form-control" id="confirm-nova-senha" placeholder="****">
				    </div>
				  </div>
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


			<!-- 
			<article>
				<form action="javascript:void(0);" class="form form-aligned config">
					<h3>Perfil</h3>
					<div class="control-group">
        				<label for="nome" class="left">Nome</label>
        				<input type="text" class="w50" name="nome" id="nome">
    				</div>

    				<div class="control-group">
        				<label for="localizacao" class="left">Localização</label>
        				<input type="text" class="w50" name="localizacao" id="localizacao">
    				</div>

    				<div class="control-group">
        				<label for="aniversario" class="left">Aniversário</label>
        				<input type="date" class="w30" name="aniversario" id="aniversario">
    				</div>

    				<h3>Acesso</h3>
    				<div class="control-group">
        				<label for="email" class="left">E-mail</label>
        				<input type="email" class="w60" name="email" id="email">
    				</div>

    				<div class="control-group">
        				<label for="nova-senha" class="left">Nova Senha</label>
        				<input type="password" name="nova-senha" id="nova-senha">
    				</div>

    				<div class="control-group">
        				<label for="confirm-nova-senha" class="left">Confirma Nova Senha</label>
        				<input type="password" name="confirm-nova-senha" id="confirm-nova-senha">
    				</div>

    				<h3>Notificações</h3>
    				<input type="checkbox" name="notificacoes" id="notificacoes"> Enviar por e-mail diariamente um lembre para eu praticar.
    				<br />
    				<button class="btn btn-info mt40 mb10" id="atualizar">Atualizar</button>
				</form>
			</article> -->


		</div><!-- /container-mainbox -->
		</div><!-- /row -->
	</div><!-- /continer -->
	</section>
	<div class="box-overlay"></div>
	<footer class="geral-container">
	<div class="container">
		<div class="row">
			&copy; 2013-2014 - Todos os direitos reservados.
		</div>
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
	 <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
	<script src="js/boots.js"></script>
	<script src="js/flat-ui-pro.min.js"></script>
	<script src="js/respond.min.js"></script>
	<script src="js/jquery.cookie.js"></script>
	<script src="js/min/app.js"></script>
	<script src="js/min/usuario.js"></script>
	<script src="js/min/config.js"></script>
</body>
</html>