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

function onSuccessCadastro(data)
{
  if (data.result)
  {
    $.cookie.json = true;
    $.cookie('usuario', data.result, {expires: 1});
    $("#message").text("Cadastro efetuado com sucesso, em breve enviaremos um e-mail informando o status do seu pedido").css('display', 'block').addClass('alert alert-success');
  }
  else
  {
    $("#message").text("E-mail informado já foi cadastro").css('display', 'block').addClass('alert alert-warning');
  }
}

function onErrorCadastro(error)
{
    console.info(error);
}

$("#message").bind("click", function(){
  $(this).css('display', 'none');
});

$("#join").bind("click", function(){
  var nome, email, senha;

  nome = $("form #nome").val();
  email = $("form #email").val();
  senha = $("form #senha").val();
  senha_confirm = $("form #senha_confirm").val();


  if(nome != "" && email != "" && senha != "" && senha_confirm != "")
  {
    var erro = false;

    if (!validarNome(nome))
    {
      $("#message").text("Nome pode conter apenas letras").css('display', 'block').addClass('alert alert-warning');
      erro = true;
    }

    if (!validarEmail(email))
    {
      $("#message").text("O endereço de email é inválido").css('display', 'block').addClass('alert alert-warning');
      erro = true;
    }

    if (senha.length < 6)
    {
      $("#message").text("Senha muito curta").css('display', 'block').addClass('alert alert-warning');
      erro = true;
    }

    if (senha != senha_confirm)
    {
      $("#message").text("Senhas informadas não conferem").css('display', 'block').addClass('alert alert-warning');
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