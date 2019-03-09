var gabarito;
var comentario;
var idQuestao;
var multipla_escolha;
var qtd_multipla = 0, qtd_vouf = 0;
var acertosSeguidos = 0;

function getMoedas() { return parseInt($("#userCash").html()); }
function getPontuacao() { return parseInt($("#userScore").html()); }
function getVidas() { return parseInt($("#userLifes").html()); }

function setVidas(value) {
    $("#lifes").css('display', 'block');
    $("#userLifes").html(value);
}

function perdeuVida() {
    setVidas(getVidas() - 1);

    $.ajax({
        type: "post",
        url: rootUrl + "/Usuario/perdeu_vida",
        dataType: "json",
        success: function(e) { console.info(e); }, 
        error: function(e) { console.info(e); }
    });
}

function updateMoedas(value) {
    var score = $("#userCash").html();
    score = parseInt(score) + value; 
    $("#userCash").html(score);
}

function updatePontuacao(value) {
    var score = $("#userScore").html();
    score = parseInt(score) + value; 
    $("#userScore").html(score);
}

function bloqueaShowDoMilhao() {
    var myModal = new Modal();
        myModal.setCor("#E74C3C");
        myModal.setTitulo("Saldo insuficiente");
        myModal.setTexto("Você não possui saldo suficiente para utilizar esta funcionalidade. Continue jogando e acumulando pontos!<br /><br />");
        myModal.showModal('F');
}

function isCorrect(resposta) {
    var acertou = false; 
    var score;

    if(gabarito == resposta) {
        var html = "Parabéns, sua resposta está correta. Continue jogando e aprendendo.<br /><br />Comentário: " + comentario;
        var snd = new Audio("sounds/correct.mp3");
        snd.play();

        var myModal = new Modal();
            myModal.setCor("#1ABC9C")
            myModal.setTitulo("Parabéns ! Você acertou");
            myModal.setTexto(html);
            myModal.showModal('P');

        $.ajax({
            type: "post",
            url: rootUrl + "/Usuario/pontuation_geral",
            dataType: "json",
            success: function(e) {
                updatePontuacao(100);
                if (verificaPontuacao()) atualizaPerfil();
            }, 
            error: function(e) { console.info(e); }
        });
        
        valueScore = RESPOSTA_CORRETA;

        acertou = true;
        acertosSeguidos++;

        badge_acertos_seguidos();
        badge_acertos();
    }
    else {
        var respostaCompleta = $('.teste[data-option="'+ gabarito +'"]').html();
        var html = "Que pena, você errou a questão. <br />Resposta certa: " + respostaCompleta + "(Letra " + gabarito +")<br /><br />Comentário: " + comentario;

        var myModal = new Modal();
            myModal.setCor("#E74C3C")
            myModal.setTitulo("Resposta errada");
            myModal.setTexto(html);
            myModal.showModal('P');            

        score = RESPOSTA_ERRADA;

        perdeuVida();

        acertosSeguidos = 0;
    }

    if (getMoedas() + score >= 0) {
        $.ajax({
            type: "post",
            url: rootUrl + "/Usuario/pontuation",
            data: JSON.stringify({"pontuation" : score}),
            dataType: "json",
            success: function(e) { updateMoedas(score); }, 
            error: function(e) { console.info(e); }
        });
    }

    // Armazena a questao feita pelo usuario.
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
    var naoEncontrou = false;

    if (isUndefined(differentQuestion)) { differentQuestion = -1 };

    if (qtd_vouf < 4) { // pega questão de v ou f
        $.ajax({
            type: "get",
            url: rootUrl + "/Questoes/questao",
            dataType: "json",
            async: false,
            data : "id="+differentQuestion+"&tipo=1",
            success: function(result)  {
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
                    multipla_escolha = result.result.data.multipla_escolha;

                    qtd_vouf++;

                    if (qtd_vouf == 4) {qtd_multipla = 0;};
                }
                else
                    naoEncontrou = true;
            },
            error: function(result){ console.info(result); }
        });
    }

    if(qtd_vouf >= 4 || naoEncontrou) {
        $.ajax({
            type: "get",
            url: rootUrl + "/Questoes/questao",
            dataType: "json",
            data : "id="+differentQuestion+"&tipo=2",
            success: function(result)  {
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
                multipla_escolha = result.result.data.multipla_escolha;

                qtd_multipla++;

                if (qtd_multipla == 3) qtd_vouf = 0;
            },
            error: function(result){ console.info(result); }
        });
    }
}

function eliminarResposta() {
    // Remove uma alternativa aleatoriamente.
    var chr;
    do {
        chr = String.fromCharCode(65 + ((Math.floor((Math.random() * 10) + 1)) % 3));
    }
    while(chr == gabarito);

    $.ajax({
        type: "post",
        url: rootUrl + "/Usuario/pontuation",
        data: JSON.stringify({"pontuation" : ELIMINAR_RESPOSTA}),
        dataType: "json",
        success: function(e) {updateMoedas(ELIMINAR_RESPOSTA)}, 
        error: function(e) { console.info(e); }
    });

    $('.teste[data-option="'+ chr +'"]').css('text-decoration', 'line-through');

    $('html, body').animate({scrollTop: 0}, 1000); 
}

function pularPergunta() {
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
    var score = getMoedas();

    $("#eliminar-resposta").bind("click", function() {
        if (score >= 5 && multipla_escolha == 1 && !eliminouResposta) {
            eliminarResposta();
            eliminouResposta = true;
        }
        else if (multipla_escolha == 0) {
            var myModal = new Modal();
                myModal.setCor("#E74C3C");
                myModal.setTitulo("Operação inválida");
                myModal.setTexto("Você não pode eliminar uma resposta de uma questão verdadeiro e falso.<br /><br />");
                myModal.showModal('F');  
        } else if(score < 5) {
            bloqueaShowDoMilhao();
        }
    });
    
    $("#pular-pergunta").bind("click", function() {
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
