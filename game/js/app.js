// variaveis globais
var rootUrl = "https://www.oabgame.com.br/game/app";
var clienteUrl = "https://www.oabgame.com.br/game";

const RESPOSTA_CORRETA = 5;
const PULAR_PERGUNTA = -10;
const ELIMINAR_RESPOSTA = -10;
const RESPOSTA_ERRADA = -15;
const RESPONDEU_ENQUETE = 15;
const PRIMEIRO_ACESSO = 10;

badgesEnum = {
    TRES_ACERTOS_SEGUIDOS : 1,
    SETE_ACERTOS_SEGUIDOS : 2,
    DEZ_ACERTOS_SEGUIDOS  : 3,
    QUINZE_ACERTOS_SEGUIDOS : 4,
    DEZ_RESPOSTAS_CORRETAS : 5,
    VINTE_RESPOSTAS_CORRETAS : 6,
    CINQUENTA_RESPOSTAS_CORRETAS : 7,
    CEM_RESPOSTAS_CORRETAS : 8,
    DUZENTAS_RESPOSTAS_CORRETAS : 9,
    JOGOU_2X : 10,
    JOGOU_5X : 11,
    JOGOU_10X : 12,
    JOGOU_15X : 13
};

var openedModal = false;
var modaisAbertos = 0;

function isUndefined(e) { return e == undefined ? true : false; }
function goPage(page) { location.href = clienteUrl + "/" + page; }

var Modal = function() {
    var cor;
    var titulo;
    var texto;

    this.setCor = function(vCor) { this.cor = vCor; }
    this.setTitulo = function(vTitulo) { this.titulo = vTitulo; }
    this.setTexto = function(vTexto) { this.texto = vTexto; }

    this.showModal = function(vTipo) {
        openedModal = true; modaisAbertos++;

        var myHtml = "<div class='box-modal' data-attr='" + modaisAbertos + "'><div class='box-content'><h3></h3><div><p></p></div><p><button class='btn btn-info modal-action' data-tipo='fechar'></button></p></div></div>";
        $(".topo").after(myHtml);

        $(".box-overlay").css("opacity", '1').css('visibility', 'visible');
        $(".box-modal > .box-content").css('visibility', 'visible');

        var ret = $( ".box-modal[data-attr='"+ modaisAbertos +"']" );

        if (this.cor != null)
            $(ret).children('.box-content').children('h3').css("background-color", this.cor).text(this.titulo);
        else 
            $(ret).children('.box-content').children('h3').text(this.titulo);

        $(ret).children('.box-content').children('div').children('p').html(this.texto);

        if (vTipo == 'F' || vTipo == 'f') {
            $(ret).children('.box-content').children('p').children('.modal-action').attr("data-tipo", "fechar");
            $(ret).children('.box-content').children('p').children('.modal-action').text("Fechar");
        }
        else if(vTipo == 'P' || vTipo == 'p') {
            $(ret).children('.box-content').children('p').children('.modal-action').attr("data-tipo", "prox");
            $(ret).children('.box-content').children('p').children('.modal-action').text("Próxima pergunta");
        }
        else if(vTipo == 'C' || vTipo == 'c') {
            $(".box-overlay").css("background", 'rgba(0,0,0,0.96)');
            $(ret).children('.box-content').children('p').html("<a href='https://www.provasdaoab.com.br/aprovagame/game/comprar'><button class='btn btn-info modal-action'>Saiba mais</button></a>");
        }
    }
}

function verificarPrimeiroAcesso() {
	$.ajax({
        type: "get",
        url: rootUrl + "/Anuncios/dia_acesso",
        dataType: "json",
        success: function(result) { 
        	if (result.result) {        		
                var snd = new Audio("sounds/news.mp3"); // buffers automatically when created
                snd.play();

                var html = "<img src='img/big-coin.png' alt='' style='display: block; margin-left: auto; margin-right: auto;' />";
                html += "<br />";
                html += "<p class='txt-center'>Ficamos feliz porque você voltou! Volte mais vezes e ganhe mais benefícios. :)</p>";

                var myModal = new Modal();
                myModal.setCor("#f5d313");
                myModal.setTitulo("Você recebeu E$ 10!");
                myModal.setTexto(html);
                myModal.showModal('F');

                updateMoedas(PRIMEIRO_ACESSO);
            }
        }, error: function(result){ console.info(result); }
    });
}

function closeModal(selected) {   
    $(selected).remove();

    if (modaisAbertos - 1 == 0)
        $(".box-overlay").css("opacity", '0').css('visibility', 'hidden');

    modaisAbertos--;

    if (modaisAbertos == 0) openedModal = false;
}

function rankingAmigos() {
    $.ajax({
        type: "get",
        url: rootUrl + "/Usuario/ranking",
        dataType: "json",
        success: function(result) {
            var html = "<ul>";
            for(var i = 0; i < 5; i++) {
                if (result.result[i] != null) {
                    html += "<li>";
                    if (result.result[i].foto_profile == "")
                        html += "<img src='img/sem-foto.png' class='left mr5' alt=''>";
                    else
                        html += "<img src='" + result.result[i].foto_profile.replace('http','https') + "' class='left mr5' alt=''>";
                    
                    html += "<h4>" + result.result[i].posicao + "&ordm; " + result.result[i].nome + "</h4>";
                    html += "<p> " + result.result[i].pontuacao + "<i class='small'> pontos</i></p>";
                    html += "</li>";
                }
            }
            html += "</ul>";
            $(".ranking-box > article").html(html);
        },
        error: function(e) { console.log(e); }
    });

    setTimeout(rankingAmigos, 10000);
}

function verificaPontuacao() {
    var score = getPontuacao();
    var novoNivel = 1;
    var html;

    if(score >= 2000 && score < 3000) {
        novoNivel = 2;
        html = "<img src='img/aviso_nivel/nivel-2.png' alt='' style='margin-left: 16%' />";
    }
    else if(score >= 3000 && score < 4500) {
        novoNivel = 3;
        html = "<img src='img/aviso_nivel/nivel-3.png' alt='' style='margin-left: 16%' />";
    }
    else if(score >= 4500 && score < 8000) {
        novoNivel = 4;
        html = "<img src='img/aviso_nivel/nivel-4.png' alt='' style='margin-left: 16%' />";
    }
    else if(score >= 8000 && score < 12000) {
        novoNivel = 5;
        html = "<img src='img/aviso_nivel/nivel-5.png' alt='' style='margin-left: 16%' />";
    }
    else if(score >= 12000 && score < 17000) {
        novoNivel = 6;
        html = "<img src='img/aviso_nivel/nivel-6.png' alt='' style='margin-left: 16%' />";
    }
    else if(score >= 17000 && score < 25000) {
        novoNivel = 7;
        html = "<img src='img/aviso_nivel/nivel-7.png' alt='' style='margin-left: 16%' />";
    }
    else if(score >= 25000) {
        novoNivel = 8;
        html = "<img src='img/aviso_nivel/nivel-8.png' alt='' style='margin-left: 16%' />";
    }

    if (novoNivel != 1) {   
        var nivelAntigo;
        $.ajax({
            type: "get",
            url: rootUrl + "/Usuario/nivel",
            dataType: "json",
            async: false,
            success: function(e) { nivelAntigo = parseInt(e.result); },
            error: function(result){ console.info(result); }
        });

        // Atualiza nivel do usuário.
        if (nivelAntigo < novoNivel) {
            $.ajax({ 
                type: "post",
                url: rootUrl + "/Usuario/update_nivel",
                data: JSON.stringify({"novo" : novoNivel}),
                dataType: "json",
                error: function(e) {console.info(e);}
            });

            var snd = new Audio("sounds/news.mp3"); 
            snd.play();

            var myModal = new Modal();
            myModal.setTitulo("Parabéns, você mudou o seu nível!");
            myModal.setTexto(html);
            myModal.showModal('F');
            
            return true;
        }
    }

    return false;
}

function getUserLifes() {
    var lifes;

    $.ajax({
        type: "get",
        async: false,
        url: rootUrl + "/Usuario/lifes",
        success: function(data) {
            if(!data.result)
                goPage("login")
            
            lifes = data.result.qtd_vidas;
        }
    });

    return lifes;
}

$(document).ready(function() {
    $("#user-box").bind('click', function() {
        var status = $(".tooltip-sys").css('display');

        if (status == "none")
            $(".tooltip-sys").css('display', 'block');
        else
            $(".tooltip-sys").css('display', 'none');
    });

    $("#linkSair").bind("click", function() {
        $.ajax({
            type: "get",
            url: rootUrl + "/Usuario/logout",
            success: function() { goPage("logout"); }
        });
    });

    var lastScrollTop = 0;
    $(window).scroll(function(event) {
         var st = $(this).scrollTop();
         if (st > lastScrollTop + 40)
         {
             var status = $(".tooltip").css('display');

             if (status == "block")
                $(".tooltip").css('display', 'none');
        } 
        lastScrollTop = st;
    });

    $("body").on('click', ".modal-action", function() {
        var tipo = $(this).attr("data-tipo");
        var selected = $(this).parent("p").parent(".box-content").parent(".box-modal");

        if(tipo == "prox"){
            $("input[name='option']").attr('checked', false);
            findQuestion();
        }

        closeModal(selected);
    });
});
