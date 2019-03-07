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

  console.info(data);
  if (data.result)
  {
    $.cookie.json = true;
    $.cookie('usuario', data.result, {expires: 1});

    goPage("sistema");
  }
  else
  {
    $("#message").addClass("login-error").text("Usuário e/ou senha incorretos").css('display', 'block');;
  }
}

function onErrorLogin(error)
{
    console.info(error);
}
var rootUrl = "https://www.provasdaoab.com.br/aprovagame/game/app";
var clienteUrl = "https://www.provasdaoab.com.br/aprovagame/game";

$(".fb-link").bind("click", function() { ga('send', 'event', 'Cadastro', 'Facebook'); });

$("form").on("submit", function(){

  var email, senha;

  email = $("form #email").val();
  senha = $("form #senha").val();

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
