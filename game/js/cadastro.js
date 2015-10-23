    /** This section is only needed once per page if manually copying **/
if (typeof MauticSDKLoaded == 'undefined') {
    var MauticSDKLoaded = true;
    var head            = document.getElementsByTagName('head')[0];
    var script          = document.createElement('script');
    script.type         = 'text/javascript';
    script.src          = 'https://provasdaoab.mautic.com/mautic/media/js/mautic-form.js';
    script.onload       = function() {
        MauticSDK.onLoad();
    };
    head.appendChild(script);
    var MauticDomain = 'https://provasdaoab.mautic.com';
    var MauticLang   = {
        'submittingMessage': "Please wait..."
    }
    var MauticFormValidations  = {};
}
​
/** This is needed for each form **/
MauticFormValidations['aprovagame'] = {
};

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
    $("#message").text("Cadastro efetuado com sucesso! Em 5 segundos você será direcionado para a página de login.").css('display', 'block').addClass('alert alert-success');
    
    setTimeout(function () {
           window.location.href = "/game"; //will redirect to your blog page (an ex: blog.html)
      }, 5000);
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

$("#facebook-login").bind("click", function(){
  ga('send', 'event', 'Cadastro', 'Facebook');
});

$("#join").bind("click", function(){
  var nome, email, senha;

  nome = $("form #nome").val();
  email = $("form #email").val();
  senha = $("form #senha").val();
  senha_confirm = $("form #senha_confirm").val();


  console.info("aqui");

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
      dataMautic = JSON.stringify
                  ({
                    "mauticform[email]" : email,
                    "mauticform[nome]" : nome,
                    "mauticform[formId]" : "5",
                    "mauticform[return]" : "",
                    "mauticform[formName]" : "aprovagame"
                   });

      ga('send', 'event', 'Cadastro', 'Sem Facebook');

      $.ajax({
          type: "post",
          url: "https://provasdaoab.mautic.com/form/submit?formId=5",
          dataType: "json",
          data: dataMautic
      });

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