var resposta;

function calcularCodigo()
{
	var first_number = Math.floor((Math.random() * 10) + 1);
	var second_number = Math.floor((Math.random() * 10) + 1);

	resposta = first_number + second_number;

	$("label#soma").text(first_number + " + " + second_number + "?");
}

function validarEmail(email)
{
  var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
  return re.test(email);
}

function onSuccessRecupera(e)
{
	if (e.result.code == 202)
	{
		$("#message").text(e.result.message).css('display', 'block').addClass('alert alert-success');
	}
	else
	{
		$("#message").text(e.result.message).css('display', 'block').addClass('alert alert-warning');
	}
}

$("#message").bind("click", function(){
  $(this).css('display', 'none');
});

$("#recuperar_fim").bind("click", function()
{
	var senha, confirma, api_key;

	senha = $("#senha").val();
	confirma = $("#confirma_senha").val();
	api_key = $("#api_key").val();

	if((senha == confirma) && (senha != ""))
	{
		data = JSON.stringify({"senha": senha, "api" : api_key});

	    $.ajax({
	        type: "post",
	        url: rootUrl + "/Usuario/recupera",
	        dataType: "json",
	        data: data,
	        success: onSuccessRecupera
	    });
	}
	else
	{
		$("#message").text("As senhas não conferem").css('display', 'block').addClass('alert alert-warning');
	}

});

$("#recuperar").bind('click', function(){
	var email, soma;

	email = $("#email").val();
	soma = $("#resultado-soma").val();

	if (email != "" && soma != "")
	{
		if (validarEmail(email))
		{
			if (soma == resposta)
			{
				data = JSON.stringify({"email": email});

			    $.ajax({
			        type: "post",
			        url: rootUrl + "/Usuario/esqueci",
			        dataType: "json",
			        data: data,
			        success: onSuccessRecupera
			    });
			}
			else
			{
				$("#message").text("Soma incorreta, tente novamente.").css('display', 'block').addClass('alert alert-warning');
				$("#resultado-soma").val(' ')
				calcularCodigo();
			}
		}
		else
			$("#message").text("Formato de e-mail inválido").css('display', 'block').addClass('alert alert-warning');
	}
});

$(document).ready(function() {
	calcularCodigo();
});