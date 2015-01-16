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

$(".fb-link").bind("click", function() { ga('send', 'event', 'Cadastro', 'Facebook'); });

$("form").on("submit", function(){

  var email, senha;

  email = $("form #email").val();
  senha = $("form #senha").val();

  console.info(email, senha);

  if(email != "" && senha != "")
  {
    data = JSON.stringify({"email": email, "senha": senha});

    console.info(data);

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
