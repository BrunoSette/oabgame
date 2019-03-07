function onSuccessLogin(data)
{
  console.info(data);
  if (data.result) {
    $.cookie.json = true;
    $.cookie('usuario', data.result, {expires: 1});

    goPage("sistema");
  }
  else {
    $("#message").addClass("login-error").text("Usuário e/ou senha incorretos").css('display', 'block');;
  }
}

function onErrorLogin(error) { console.info(error); }

$("form").on("submit", function() {
  var email = $("form #email").val();
  var senha = $("form #senha").val();

  if(email != "" && senha != "") {
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