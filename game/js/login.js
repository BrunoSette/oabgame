function onSuccessLogin(data) {
  if (data.result) {
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
    $.ajax({
        type: "post",
        url: rootUrl + "/Usuario/login",
        dataType: "json",
        data: JSON.stringify({"email": email, "senha": senha}),
        success: onSuccessLogin,
        error: onErrorLogin
    });
  }
});