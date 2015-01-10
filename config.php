<?php include("template/_header.php"); ?>
	<section class="mainbox geral-container" style="overflow: hidden;">
		<div class="container-mainbox left w100">
			<header>
				<h3>Configurações</h3>
			</header>
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
			</article>
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
	<script src="js/config.js"></script>
</body>
</html>