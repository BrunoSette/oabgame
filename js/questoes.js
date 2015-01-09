function closeModal(selected)
{   
    $(selected).remove();

    if (modaisAbertos - 1 == 0)
        $(".box-overlay").css("opacity", '0').css('visibility', 'hidden');

    modaisAbertos--; openedModal = false;
}

function getMoedas()
{
    return parseInt($("#userCash").html());
}

function getPontuacao()
{
    return parseInt($("#userScore").html());
}

function updateMoedas(value)
{
    var score = $("#userCash").html();
    score = parseInt(score) + value; 
    $("#userCash").html(score);
}

function updatePontuacao(value)
{
    var score = $("#userScore").html();
    score = parseInt(score) + value; 
    $("#userScore").html(score);
}

function bloqueaShowDoMilhao()
{
    var myModal = new Modal();
        myModal.setCor("#E74C3C");
        myModal.setTitulo("Saldo insuficiente");
        myModal.setTexto("Você não possui saldo suficiente para utilizar esta funcionalidade. Continue jogando e acumulando pontos!<br /><br />");
        myModal.showModal('F');
}

function notificaErro()
{
    var html = "<form action='javascript:void(0)' id='formEnviaErro' class='form form-aligned'>";
        html += "<div class='control-group'>";
        html += "<label for=''>Qual o erro desta pergunta: </label><br />";
        html += "<input type='radio' name='error' value='1'> A pergunta contém erro de ortografia.<br />"
        html += "<input type='radio' name='error' value='2'> A pergunta não possui resposta correta.<br />"
        html += "<input type='radio' name='error' value='3'> A pergunta possui caracteres especiais.<br />"
        html += "<br />"
        html += "<label for=''>Comentário Opcional</label><br />";
        html += "<textarea class='mt10' name='comment'></textarea>"
        html += "</div>";
        html += "</form>"

    var footer = "<p class='right'>";
        footer += "<button class='btn btn-cancel' id='modal-action' data-tipo='fechar'>Cancelar</button>";
        footer += "<button class='btn btn-info ml5' id='sendNotification'>Enviar</button>";
        footer += "</p>";

    $(".box-overlay").css("opacity", '1').css('visibility', 'visible');
    $(".box-modal > .box-content").css('visibility', 'visible');
    $(".box-modal h3").css("background-color", "#3498db").text("Reportar pergunta");
    $(".box-modal > .box-content > div > p").html(html);
    $("#modal-action").attr("data-tipo", "enviarErro");
    $(".box-modal > .box-content > p").css('overflow', 'hidden');
    $(".box-modal > .box-content > p").html(footer);
}

function isCorrect(resposta)
{
    if(isUndefined(resposta)) // usuario nao respondeu a questao
    {
        var myModal = new Modal();
            myModal.setTitulo("Resposta em branco");
            myModal.setTexto("Você não selecionou nenhuma resposta. Para prosseguir selecione a respota correta.");
            myModal.showModal('F');
    }
    else
    {
        var acertou = false; 
        var valueScore;

        if(gabarito == resposta)
        {
            var myModal = new Modal();
                myModal.setCor("#1ABC9C")
                myModal.setTitulo("Parabéns ! Você acertou");
                myModal.setTexto("Parabéns, sua resposta está correta. Continue jogando e aprendendo.<br /><br />Comentário: " + comentario);
                myModal.showModal('P');

            $.ajax({ // atualiza pontuação geral do usuario
                type: "post",
                url: rootUrl + "/Usuario/pontuation_geral",
                dataType: "json",
                success: function(e)
                {
                    updatePontuacao(100);
                    if (verificaPontuacao()) atualizaPerfil();
                }, 
                error: function(e) { console.info(e); }
            });
            
            data = {"pontuation" : RESPOSTA_CORRETA}; valueScore = RESPOSTA_CORRETA;

            acertou = true;
            acertosSeguidos++;

            badge_acertos_seguidos();
            badge_acertos();
        }
        else
        {
            var respostaCompleta = $('.teste[data-option="'+ gabarito +'"]').html();

            var myModal = new Modal();
                myModal.setCor("#E74C3C")
                myModal.setTitulo("Resposta errada");
                myModal.setTexto("Que pena, você errou a questão. <br /><br />Resposta certa: " + respostaCompleta + "(Letra " + gabarito +")<br /><br />Comentário: " + comentario);
                myModal.showModal('P');            

            data = {"pontuation" : RESPOSTA_ERRADA};
            valueScore = RESPOSTA_ERRADA;

            acertosSeguidos = 0;
        }

        if (getMoedas() + valueScore >= 0)
        {
            $.ajax({
                type: "post",
                url: rootUrl + "/Usuario/pontuation",
                data: JSON.stringify(data),
                dataType: "json",
                success: function(e) {updateMoedas(valueScore)}, 
                error: function(e) { console.info(e); }
            });
        }

        // armazena a questao feita pelo usuario
        data = JSON.stringify({"questao" : idQuestao, "user_acertou" : acertou, "user_resposta" : resposta});
        $.ajax({
            type: "post",
            url: rootUrl + "/Usuario/do_question",
            data: data,
            dataType: "json",
            error: function(e) { console.info(e); }
        });
    }

    $('html, body').animate({scrollTop: 0}, 1000); 
}

function findQuestion()
{
	$.ajax({
        type: "get",
        url: rootUrl + "/Questoes/questao",
        dataType: "json",
        success: function(result) 
        {
            for (var i = 0; i < 4; i++)
            {
                chr = String.fromCharCode(65 + i);

                if ($('.teste[data-option="'+ chr +'"]').css('text-decoration') == 'line-through')
                    $('.teste[data-option="'+ chr +'"]').css('text-decoration', 'initial');
            }

        	$(".question").text('(' + result.result.organizadora + ' - ' + result.result.concurso + '/' + result.result.ano + ') ' + result.result.enunciado);
        	$("header span").text(result.result.id);
        	$("label[for='A'] > p:last-child").text(result.result.alternativa_a);
        	$("label[for='B'] > p:last-child").text(result.result.alternativa_b);
        	$("label[for='C'] > p:last-child").text(result.result.alternativa_c);
        	$("label[for='D'] > p:last-child").text(result.result.alternativa_d);
        	$(".subject").text(result.result.titulo);
            gabarito = result.result.gabarito;
            comentario = result.result.comentario;
            idQuestao = result.result.id;
        },
        error: function(result){ console.info(result); }
    });
}

function eliminarResposta()
{
    var chr;

    ga('send', 'event', 'Respostas', 'EliminarResposta');

    do
    {
        chr = String.fromCharCode(65 + ((Math.floor((Math.random() * 10) + 1)) % 3));
    }
    while(chr == gabarito);

    data = JSON.stringify({"pontuation" : ELIMINAR_RESPOSTA});
    $.ajax({
        type: "post",
        url: rootUrl + "/Usuario/pontuation",
        data: data,
        dataType: "json",
        success: function(e) {updateMoedas(ELIMINAR_RESPOSTA)}, 
        error: function(e) { console.info(e); }
    });

    $('.teste[data-option="'+ chr +'"]').css('text-decoration', 'line-through');

    $('html, body').animate({scrollTop: 0}, 1000); 
}

function pularPergunta()
{
    data = JSON.stringify({"pontuation" : PULAR_PERGUNTA});

    ga('send', 'event', 'Respostas', 'PularPergunta');

    $.ajax({
        type: "post",
        url: rootUrl + "/Usuario/pontuation",
        data: data,
        dataType: "json",
        success: function(e) {updateMoedas(PULAR_PERGUNTA)},
        error: function(e) { console.info(e); }
    });

    $('html, body').animate({scrollTop: 0}, 1000); 

    findQuestion();
}

// $("#modal-action").on('click', function() 
// {  
//     //closeModal();
//     console.info("teste"); 
// });

$(".box-modal").delegate('#sendNotification', 'click', function() {
    var comment = $(".box-modal textarea").val();
    var error = $(".box-modal input[name=ans]:checked").val();
    var type = $(".box-modal input[name=ans]").val();

    if (type == 1)
    {
        url = rootUrl + "/Anuncios/register";

        // condece pontuação ao usuário.
        data = JSON.stringify({"pontuation" : RESPONDEU_ENQUETE});
        $.ajax({
            type: "post",
            url: rootUrl + "/Usuario/pontuation",
            data: data,
            dataType: "json",
            success: function(e) {updateMoedas(RESPONDEU_ENQUETE)},
            error: function(e) { console.info(e); }
        });
    }
    else
        url = rootUrl + "/Questoes/error_notification";

    data = JSON.stringify({"comment": comment, "ans": error});
    
    $.ajax({
        type: "post",
        url: url,
        dataType: "json",
        data: data,
        success: function(e){ console.info(e.result); },
        error: function(e) { console.info(e.result); }
    });

    closeModal();
});

$("#notifica-erro").bind("click", function(){ notificaErro(); });

$("form > .btn-danger").bind("click", function(){
    ga('send', 'event', 'Respostas', 'Responder');
    var resposta = $("input[name='option']:checked").val();
    isCorrect(resposta);
});

// $(".box-modal").delegate('#modal-action', 'click', function() { 
//     var tipo = $(this).attr("data-tipo");

//     if(tipo == "prox")
//     {
//         $("input[name='option']").attr('checked', false);
//         findQuestion();
//     }
//     console.info("aqui");
// });


$(document).ready(function() {

    var eliminouResposta = false;
    var sair = false;

    var score = getMoedas();

    $("body").on('click', ".modal-action", function(){
        var tipo = $(this).attr("data-tipo");
        var selected = $(this).parent("p").parent(".box-content").parent(".box-modal");

        if(tipo == "prox")
        {
            $("input[name='option']").attr('checked', false);
            findQuestion();
        }

        closeModal(selected);
    });

    $("#eliminar-resposta").bind("click", function() {
        if (score > 5)
        {
            if (!eliminouResposta)
            {
                eliminarResposta();
                eliminouResposta = true;
            }
        }
        else
            bloqueaShowDoMilhao();
    });
    
    window.onbeforeunload = function(e)
    {
        if (!sair)
        {
            if (score > 5)
            {
                data = JSON.stringify({"pontuation" : PULAR_PERGUNTA});

                $.ajax({
                    type: "post",
                    url: rootUrl + "/Usuario/pontuation",
                    data: data,
                    dataType: "json",
                    success: function(e) {updateMoedas(PULAR_PERGUNTA)},
                    error: function(e) { console.info(e); }
                });
            }
        }
    };

    $("#pular-pergunta").bind("click", function() {
        if (score > 5) 
            pularPergunta(); 
        else
            bloqueaShowDoMilhao();
    });
    
    $("#close").bind("click", function(){ 
        closeModal(); 
    });

    if (!openedModal) verificarPrimeiroAcesso();
    if (!openedModal) verificarAnuncios();

    obtemRanking();

    $("#linkSair").bind("click", function() {

        sair = true;
        $.ajax({
            type: "get",
            url: rootUrl + "Usuario/logout",
            success: function()
            {
                $.removeCookie('usuario');
                goPage("logout.php");
            }
        });
    });

	findQuestion();
});
