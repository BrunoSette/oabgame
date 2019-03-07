function getMoedas()
{
    return parseInt($("#userCash").html());
}

function getPontuacao()
{
    return parseInt($("#userScore").html());
}

function getVidas()
{
    return parseInt($("#userLifes").html());
}

function setVidas(value)
{
    var premium;

    $.ajax({
        type: "get",
        async: false,
        url: rootUrl + "/Usuario/premium",
        success: function(e) { premium = e.result; }
    });


    if (premium == "1")
    {
        $("#lifes").css('display', 'none');
        $("#userLifes").html(5000);
    }
    else
    {
        $("#lifes").css('display', 'block');
        $("#userLifes").html(value);
    }
}

function perdeuVida()
{
    $.ajax({
        type: "post",
        url: rootUrl + "/Usuario/perdeu_vida",
        dataType: "json",
        success: function(e) { console.info(e); }, 
        error: function(e) { console.info(e); }
    });
}

function hideUI()
{
    $("#show-milhao").css('display', 'none');
    $("#pontuacao").css('display', 'none');
}

function showUI()
{
    $("#show-milhao").css('display', 'block');
    $("#pontuacao").css('display', 'block');
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

function isCorrect(resposta)
{
    var acertou = false; 
    var valueScore;

    if(gabarito == resposta)
    {
        var html = "Parabéns, sua resposta está correta. Continue jogando e aprendendo.<br /><br />Comentário: " + comentario;
        if (video) 
            html += "<br /><div class='video-wrapper'><iframe id='ytplayer' width='480' height='360' src='" + video +"' frameborder='0' allowfullscreen></iframe></div>";

        html += "<br /><div class='fb-comments ml30 mt10' data-href='https://www.provasdaoab.com.br/aprovagame/game/"+idQuestao+"' data-numposts='10' data-colorscheme='light'></div>";

        var snd = new Audio("sounds/correct.mp3");
        snd.play();

        var myModal = new Modal();
            myModal.setCor("#1ABC9C")
            myModal.setTitulo("Parabéns ! Você acertou");
            myModal.setTexto(html);
            myModal.showModal('P');

        FB.XFBML.parse();

        $.ajax({
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

        html += "<br /><div class='fb-comments ml30 mt10' data-href='https://www.provasdaoab.com.br/aprovagame/game/"+idQuestao+"' data-numposts='10' data-colorscheme='light'></div>";

        var myModal = new Modal();
            myModal.setCor("#E74C3C")
            myModal.setTitulo("Resposta errada");
            myModal.setTexto(html);
            myModal.showModal('P');            

        FB.XFBML.parse();

        data = {"pontuation" : RESPOSTA_ERRADA};
        valueScore = RESPOSTA_ERRADA;

        setVidas(getVidas() - 1);
        perdeuVida();

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

    $('html, body').animate({scrollTop: 0}, 1000); 
}

function findQuestion(differentQuestion)
{
    if(getVidas() > 0)
    {
        var naoEncontrou = false;

        showUI();

        if (isUndefined(differentQuestion)) { differentQuestion = -1 };
        if (qtd_vouf < 4) // pega questão de v ou f
        {
            $.ajax({
                type: "get",
                url: rootUrl + "/Questoes/questao",
                dataType: "json",
                async: false,
                data : "id="+differentQuestion+"&tipo=1",
                success: function(result) 
                {
                    if(result.result.data.enunciado)
                    {
                        $(".question").text(result.result.data.enunciado);

                        var html = "<li id='respV'>";
                            html += "<input type='radio' name='option' value='V' id='V'/>";
                            html += "<div>";
                            html += "<label for='V' class='w100'>";
                            html += "<p class='option left'>V</p>";
                            html += "<p class='teste' data-option='V'>Verdadeiro</p>";
                            html += "</label>";
                            html += "</div>";
                            html += "</li>";

                            html += "<li id='respF'>";
                            html += "<input type='radio' name='option' value='F' id='F'/>";
                            html += "<div>";
                            html += "<label for='F' class='w100'>";
                            html += "<p class='option left'>F</p>";
                            html += "<p class='teste' data-option='F'>Falso</p>";
                            html += "</label>";
                            html += "</div>";
                            html += "</li>";

                        $("#alternativas").html(html);

                        if (!isUndefined(result.result.data.titulo)) $(".subject").text(result.result.data.titulo); 
                        else $(".subject").css('background-color', '#1ABC9C');

                        gabarito = result.result.data.gabarito;
                        comentario = result.result.data.comentario;
                        idQuestao = result.result.data.id;
                        video = result.result.data.video_embed;
                        multipla_escolha = result.result.data.multipla_escolha;
                        intervalos_video = result.result.intervalo;

                        qtd_vouf++;

                        if (qtd_vouf == 4) {qtd_multipla = 0;};

                        if (intervalos_video != null) {intervalos_video.splice(0,1);}
                    }
                    else
                        naoEncontrou = true;
                },
                error: function(result){ console.info(result); }
            });
        }

        if(qtd_vouf >= 4 || naoEncontrou)
        {
            $.ajax({
                type: "get",
                url: rootUrl + "/Questoes/questao",
                dataType: "json",
                data : "id="+differentQuestion+"&tipo=2",
                success: function(result) 
                {
                    $(".question").text('(' + result.result.data.organizadora + ' - ' + result.result.data.concurso + '/' + result.result.data.ano + ') ' + result.result.data.enunciado);

                    var html = "<li id='respA'>";
                        html += "<input type='radio' name='option' value='A' id='A'/>";
                        html += "<div>";
                        html += "<label for='A' class='w100'>";
                        html += "<p class='option left'>A</p>";
                        html += "<p class='teste' data-option='A'>"+result.result.data.alternativa_a+"</p>";
                        html += "</label>";
                        html += "</div>";
                        html += "</li>";

                        html += "<li id='respB'>";
                        html += "<input type='radio' name='option' value='B' id='B'/>";
                        html += "<div>";
                        html += "<label for='B' class='w100'>";
                        html += "<p class='option left'>B</p>";
                        html += "<p class='teste' data-option='B'>"+result.result.data.alternativa_b+"</p>";
                        html += "</label>";
                        html += "</div>";
                        html += "</li>";

                        html += "<li id='respC'>";
                        html += "<input type='radio' name='option' value='C' id='C'/>";
                        html += "<div>";
                        html += "<label for='C' class='w100'>";
                        html += "<p class='option left'>C</p>";
                        html += "<p class='teste' data-option='C'>"+result.result.data.alternativa_c+"</p>";
                        html += "</label>";
                        html += "</div>";
                        html += "</li>";

                        html += "<li id='respD'>";
                        html += "<input type='radio' name='option' value='D' id='D'/>";
                        html += "<div>";
                        html += "<label for='D' class='w100'>";
                        html += "<p class='option left'>D</p>";
                        html += "<p class='teste' data-option='D'>"+result.result.data.alternativa_d+"</p>";
                        html += "</label>";
                        html += "</div>";
                        html += "</li>";

                    $("#alternativas").html(html);
                    
                    if (!isUndefined(result.result.data.titulo)) $(".subject").text(result.result.data.titulo); 
                    else $(".subject").css('background-color', '#1ABC9C');

                    gabarito = result.result.data.gabarito;
                    comentario = result.result.data.comentario;
                    idQuestao = result.result.data.id;
                    video = result.result.data.video_embed;
                    multipla_escolha = result.result.data.multipla_escolha;
                    intervalos_video = result.result.intervalo;

                    qtd_multipla++;

                    if (qtd_multipla == 3) qtd_vouf = 0;

                    if (intervalos_video != null) {intervalos_video.splice(0,1);};
                },
                error: function(result){ console.info(result); }
            });
        }
    }
    else
    {
        hideUI();
        var html = "Você não possui vidas suficientes para jogar, em instantes você poderá jogar novamente!";
        $("#alternativas").html(html);
        $(".subject > div").text("Suas vidas acabaram :(");
    }
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
    ga('send', 'event', 'Respostas', 'PularPergunta');

    $.ajax({
        type: "post",
        url: rootUrl + "/Usuario/pontuation",
        data: JSON.stringify({"pontuation" : PULAR_PERGUNTA}),
        dataType: "json",
        success: function(e) {updateMoedas(PULAR_PERGUNTA)},
        error: function(e) { console.info(e); }
    });

    $('html, body').animate({scrollTop: 0}, 1000); 

    findQuestion(idQuestao);
}

$("body").delegate("#respA", "click", function(){ if (!openedModal) isCorrect("A"); });
$("body").delegate("#respB", "click", function(){ if (!openedModal) isCorrect("B"); });
$("body").delegate("#respC", "click", function(){ if (!openedModal) isCorrect("C"); });
$("body").delegate("#respD", "click", function(){ if (!openedModal) isCorrect("D"); });

$("body").delegate("#respV", "click", function(){ if (!openedModal) isCorrect("V"); });
$("body").delegate("#respF", "click", function(){ if (!openedModal) isCorrect("F"); });

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
                bloqueaShowDoMilhao();
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
    
    setVidas(getUserLifes());

    verificarPrimeiroAcesso();
    rankingAmigos();

	findQuestion();
});
