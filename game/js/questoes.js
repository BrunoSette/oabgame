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
            var html = "Parabéns, sua resposta está correta. Continue jogando e aprendendo.<br /><br />Comentário: " + comentario;
            if (video) 
                html += "<br /><div class='video-wrapper'><iframe id='ytplayer' width='480' height='360' src='" + video +"' frameborder='0' allowfullscreen></iframe></div>";

            html += "<br /><div class='fb-comments ml30 mt10' data-href='http://www.aprovagame.com.br/game/"+idQuestao+"' data-numposts='10' data-colorscheme='light'></div>";

            var snd = new Audio("sounds/correct.mp3"); // buffers automatically when created
            snd.play();

            var myModal = new Modal();
                myModal.setCor("#1ABC9C")
                myModal.setTitulo("Parabéns ! Você acertou");
                myModal.setTexto(html);
                myModal.showModal('P');

            FB.XFBML.parse();

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

            var html = "Que pena, você errou a questão. <br />Resposta certa: " + respostaCompleta + "(Letra " + gabarito +")<br /><br />Comentário: " + comentario;
            if (video) html += "<br /><div class='video-wrapper'><iframe width='480' height='360' src='" + video +"' frameborder='0' allowfullscreen></iframe> </div>";

            html += "<br /><div class='fb-comments ml30 mt10' data-href='http://www.aprovagame.com.br/game/"+idQuestao+"' data-numposts='10' data-colorscheme='light'></div>";

            var myModal = new Modal();
                myModal.setCor("#E74C3C")
                myModal.setTitulo("Resposta errada");
                myModal.setTexto(html);
                myModal.showModal('P');            

            FB.XFBML.parse();

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

function findQuestion(differentQuestion)
{
    if (isUndefined(differentQuestion)) {differentQuestion = -1};

	$.ajax({
        type: "get",
        url: rootUrl + "/Questoes/questao",
        dataType: "json",
        data : "id="+differentQuestion,
        success: function(result) 
        {
        	$(".question").text('(' + result.result.data.organizadora + ' - ' + result.result.data.concurso + '/' + result.result.data.ano + ') ' + result.result.data.enunciado);
        	$("header span").text(result.result.data.id);

            if (result.result.data.multipla_escolha == 1)
            {
                var html = "<li>";
                    html += "<input type='radio' name='option' value='A' id='A'/>";
                    html += "<div>";
                    html += "<label for='A' class='w100'>";
                    html += "<p class='option left'>A</p>";
                    html += "<p class='teste' data-option='A'>"+result.result.data.alternativa_a+"</p>";
                    html += "</label>";
                    html += "</div>";
                    html += "</li>";

                    html += "<li>";
                    html += "<input type='radio' name='option' value='B' id='B'/>";
                    html += "<div>";
                    html += "<label for='B' class='w100'>";
                    html += "<p class='option left'>B</p>";
                    html += "<p class='teste' data-option='B'>"+result.result.data.alternativa_b+"</p>";
                    html += "</label>";
                    html += "</div>";
                    html += "</li>";

                    html += "<li>";
                    html += "<input type='radio' name='option' value='C' id='C'/>";
                    html += "<div>";
                    html += "<label for='C' class='w100'>";
                    html += "<p class='option left'>C</p>";
                    html += "<p class='teste' data-option='C'>"+result.result.data.alternativa_c+"</p>";
                    html += "</label>";
                    html += "</div>";
                    html += "</li>";

                    html += "<li>";
                    html += "<input type='radio' name='option' value='D' id='D'/>";
                    html += "<div>";
                    html += "<label for='D' class='w100'>";
                    html += "<p class='option left'>D</p>";
                    html += "<p class='teste' data-option='D'>"+result.result.data.alternativa_d+"</p>";
                    html += "</label>";
                    html += "</div>";
                    html += "</li>";
            }
            else
            {
                var html = "<li>";
                    html += "<input type='radio' name='option' value='V' id='V'/>";
                    html += "<div>";
                    html += "<label for='V' class='w100'>";
                    html += "<p class='option left'>V</p>";
                    html += "<p class='teste' data-option='V'>Verdadeiro</p>";
                    html += "</label>";
                    html += "</div>";
                    html += "</li>";

                    html += "<li>";
                    html += "<input type='radio' name='option' value='F' id='F'/>";
                    html += "<div>";
                    html += "<label for='F' class='w100'>";
                    html += "<p class='option left'>F</p>";
                    html += "<p class='teste' data-option='F'>Falso</p>";
                    html += "</label>";
                    html += "</div>";
                    html += "</li>";
            }
        	$("#alternativas").html(html);
            $(".subject").text(result.result.data.titulo);

            gabarito = result.result.data.gabarito;
            comentario = result.result.data.comentario;
            idQuestao = result.result.data.id;
            video = result.result.data.video_embed;
            multipla_escolha = result.result.data.multipla_escolha;
            intervalos_video = result.result.intervalo;

            if (intervalos_video != null) {intervalos_video.splice(0,1);};
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

    findQuestion(idQuestao);
}

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

//$("#notifica-erro").bind("click", function(){ notificaErro(); });

$("#enviarResposta").on("click", function(){
    ga('send', 'event', 'Respostas', 'Responder');
    var resposta = $("input[name='option']:checked").val();
    isCorrect(resposta);
});

$(document).ready(function() {

    var eliminouResposta = false;
    var sair = false;

    var score = getMoedas();

    $("#eliminar-resposta").bind("click", function() {

        if (score > 5 && multipla_escolha == 1)
        {
            if (!eliminouResposta)
            {
                eliminarResposta();
                eliminouResposta = true;
            }
        }
        else
        {
            if (multipla_escolha == 0)
            {
                var myModal = new Modal();
                    myModal.setCor("#E74C3C");
                    myModal.setTitulo("Operação inválida");
                    myModal.setTexto("Você não pode eliminar uma resposta de uma questão verdadeiro e falso.<br /><br />");
                    myModal.showModal('F');
            }
            else
            {
                bloqueaShowDoMilhao();
            }
        }
    });
    
    $("#pular-pergunta").bind("click", function() {
        var snd = new Audio("sounds/pular.mp3"); // buffers automatically when created
        snd.play();

        if (score > 5) 
            pularPergunta(); 
        else
            bloqueaShowDoMilhao();
    });
    
    verificarPrimeiroAcesso();
    rankingAmigos();

	findQuestion();
});
