$("#start").bind("click", function()
{
	$(".box-overlay").css("opacity", '1').css('visibility', 'visible');
  $(".box-modal > .box-content").css('visibility', 'visible');
});

$("#close").bind("click", function()
{
	$(".box-overlay").css("opacity", '0').css('visibility', 'hidden');
  $(".box-modal > .box-content").css('visibility', 'hidden');
});

$(document).keyup(function(e)
{
  if (e.keyCode == 27) 
  { 
  	$(".box-overlay").css("opacity", '0').css('visibility', 'hidden');
    $(".box-modal > .box-content").css('visibility', 'hidden');
  }  
});

function validarEmail(email)
{
  var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
  return re.test(email);
}

function validarNome(nome)
{
  var re = /^[a-zA-Z\s]*$/; 
  return re.test(nome);
}

function onSuccessLogin(data)
{
  if (data.result)
  {
    $.cookie.json = true;
    $.cookie('usuario', data.result, {expires: 1});

    goPage("sistema.php");
  }
  else
  {
    $("#message").addClass("login-error");
    $("#message").text("Usuário e/ou senha incorretos");
  }
}

function onErrorLogin(error)
{
    console.info(error);
}

function onSuccessCadastro(data)
{
  if (data.result)
  {
    $.cookie.json = true;
    $.cookie('usuario', data.result, {expires: 1});

    goPage("sistema.php");
  }
  else
  {
    $("#error-email").text("E-mail informado já foi cadastro");
    $("#error-email").css('display', 'block');
  }
}

function onErrorCadastro(error)
{
    console.info(error);
}

$(".fb-link").bind("click", function() { ga('send', 'event', 'Cadastro', 'Facebook'); });

$("#join").bind("click", function(){
	var nome, email, senha;

	nome = $("form #nome").val();
	email = $("form #email").val();
	senha = $("form #senha").val();

	if(nome != "" && email != "" && senha != "")
	{
    var erro = false;

    ga('send', 'event', 'Cadastro', 'SemFacebook');

    if (!validarNome(nome))
    {
      $("#error-nome").text("Nome pode conter apenas letras");
      $("#error-nome").css('display', 'block');
      erro = true;
    }

    if (!validarEmail(email))
    {
      $("#error-email").text("O endereço de email é inválido");
      $("#error-email").css('display', 'block');
      erro = true;
    }

    if (senha.length < 6)
    {
      $("#error-senha").text("Senha muito curta");
      $("#error-senha").css('display', 'block');
      erro = true;
    }

    if (!erro)
    {
		  data = JSON.stringify({"nome": nome, "email": email, "senha": senha});

      $.ajax({
          type: "post",
          url: rootUrl + "/Usuario/register",
          dataType: "json",
          data: data,
          success: onSuccessCadastro,
          error: onErrorCadastro
      });
    }
	}
});

$("#login").bind("click", function(){
  var email, senha;

  email = $("form #emailLogin").val();
  senha = $("form #senhaLogin").val();

  if(email != "" && senha != "")
  {
    data = JSON.stringify({"email": email, "senha": senha});

    $.ajax({
        type: "post",
        url: rootUrl + "/Usuario/login",
        dataType: "json",
        data: data,
        success: onSuccessLogin,
        error: onErrorLogin
    });
  }
});

$("#entrar").bind('click', function() {
  var status = $(".tooltip").css('display');

  if (status == "none")
    $(".tooltip").css('display', 'block');
  else
    $(".tooltip").css('display', 'none');
});
