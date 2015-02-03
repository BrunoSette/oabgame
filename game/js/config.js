function setConfig(profile)
{
	$("#nome").val(profile.nome);
	$("#localizacao").val(profile.localizacao);
	$("#aniversario").val(profile.aniversario);
	$("#email").val(profile.email);

	if (parseInt(profile.lembretes))
		$("#notificacoes").prop( "checked", true );
	else
		$("#notificacoes").prop( "checked", false );

	if (profile.convite != "0")
	{
		if (profile.convidado == "")
		{
			html = "<br class='clear' />";
			html += "<div class='form-group col-sm-5'>";
			html += "<h4>Convidado Especial</h4>";
			html += "<label for='email_convidado' class='control-label'>Email</label>";
			html += "<div class=''>";
			html += "<input type='email' class='form-control' id='email_convidado' />";
			html += "</div>";
			html += "</div> <br class='clear' />";
		}
		else
		{
			html = "<br class='clear' />";
			html += "<div class='form-group col-sm-5'>";
			html += "<h4>Convidado Especial</h4>";
			html += "<label for='email_convidado' class='control-label'>Email</label>";
			html += "<div class=''>";
			html += "<input type='email' class='form-control' id='email_convidado' value='" + profile.convidado + "' disabled />";
			html += "</div>";
			html += "</div><br class='clear' />";
		}

		$("#confirma-senha").after(html);
	}
}

function doUpdate()
{
	var erro = false;

	var nome = $("#nome");
	if (nome.val() == "")
	{
		nome.addClass('erro');
		erro = true;
	}

	var email = $("#email");
	if (email.val() == "")
	{
		email.addClass('erro');
		erro = true;
	}

	var senha = $("#nova-senha");
	var senha_confirma = $("#confirm-nova-senha");
	if (senha.val() != senha_confirma.val())
	{
		if (senha.val() != senha_confirma.val())
		{	
			senha.addClass('erro');
			senha_confirma.addClass('erro');
			$(".control-group").last().append('<span style="color: #e74c3c;"> As senhas não conferem</span>');
		}

		erro = true;
	}

	if (!erro)
	{
		// envia formulario via POST
		var data = {
			"nome" : nome.val(), 
			"localizacao" : $("#localizacao").val(), 
			"aniversario" : $("#aniversario").val(),
			"email" : email.val(),
			"nova_senha" : senha.val(),
			"notificacoes" : $("#notificacoes").is(':checked'),
			"convidado" : $("#email_convidado").val()
		};

		$.ajax({ 
            type: "post",
            url: rootUrl + "/Usuario/update",
            data: JSON.stringify(data),
            dataType: "json",
            success: function(e) {
            	console.info(e);
            },
            error: function(e) {console.info(e);}
        });
	}
	
	$('html, body').animate({scrollTop: 0}, 1000); 
}

$(document).ready(function()
{
	$.ajax({
        type: "get",
        url: rootUrl + "/Usuario/profile",
        dataType: "json",
        success: function(result){ setConfig(result.result); },
        error: function(result){console.info(result);}
    });

    $("#atualizar").bind('click', function(){
    	doUpdate();
    });
});