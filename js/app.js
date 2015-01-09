// variaveis globais

var rootUrl = "http://www.estudandoonline.com.br/game/app";
var clienteUrl = "http://www.estudandoonline.com.br/game";

const RESPOSTA_CORRETA = 20;
const PULAR_PERGUNTA = -5;
const ELIMINAR_RESPOSTA = -5;
const RESPOSTA_ERRADA = -10;
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

var gabarito;
var comentario;
var idQuestao;
var openedModal = false;
var acertosSeguidos = 0;
var modaisAbertos = 0;

function isUndefined(e)
{
	if(e == undefined)
	{
		return true;
	}
	else
	{
		return false;
	}
}

function goPage(page)
{
    location.href = clienteUrl + "/" + page;
}

var Modal = function()
{
    var cor;
    var titulo;
    var texto;

    this.setCor = function(vCor)
    {
        this.cor = vCor;
    }

    this.setTitulo = function(vTitulo)
    {
        this.titulo = vTitulo;
    }

    this.setTexto = function(vTexto)
    {
        this.texto = vTexto;
    }

    this.showModal = function(vTipo)
    {
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

        if (vTipo == 'F' || vTipo == 'f')
        {
            $(ret).children('.box-content').children('p').children('.modal-action').attr("data-tipo", "fechar");
            $(ret).children('.box-content').children('p').children('.modal-action').text("Fechar");
        }
        else if(vTipo == 'P' || vTipo == 'p')
        {
            $(ret).children('.box-content').children('p').children('.modal-action').attr("data-tipo", "prox");
            $(ret).children('.box-content').children('p').children('.modal-action').text("Proxima pergunta");
        }
    }
}

// inicialmente vamos verificar apenas um anuncio padrão (enquete)
function verificarAnuncios()
{
	$.ajax({
        type: "get",
        url: rootUrl + "/Anuncios/user_anuncio",
        dataType: "json",
        success: function(result)
        { 
        	if (!result.result) // exibir anuncio
        	{
        		openedModal = true;

        		var html = "<p>Responda o formulário abaixo e <b>ganhe E$15</b>.</p>";
        			html += "<form action='javascript:void(0)' id='formOpiniao' class='form form-aligned'>";
			        html += "<div class='control-group'>";
			        html += "<label for=''>O que está achando do jogo? </label><br />";
			        html += "<input type='radio' name='ans' value='1'> Bom<br />"
			        html += "<input type='radio' name='ans' value='2'> Regular<br />"
			        html += "<input type='radio' name='ans' value='3'> Ruim<br />"
			        html += "<br />"
			        html += "<label for=''>No que podemos melhorar? (Opcional)</label><br />";
			        html += "<textarea class='mt10' name='comment'></textarea>"
			        html += "<input type='hidden' name='type' value='1'>"
			        html += "</div>";
			        html += "</form>"

			    var footer = "<p class='right'>";
			        footer += "<button class='btn btn-cancel' id='modal-action' data-tipo='fechar'>Não responder</button>";
			        footer += "<button class='btn btn-info ml5' id='sendNotification'>Enviar</button>";
			        footer += "</p>";

    			$(".box-overlay").css("opacity", '1').css('visibility', 'visible');
    			$(".box-modal > .box-content").css('visibility', 'visible');
    			$(".box-modal h3").css("background-color", "#3498db").text("Pesquisa de opinião");
    			$(".box-modal > .box-content > div > p").html(html);
    			$("#modal-action").attr("data-tipo", "enviarErro");
    			$(".box-modal > .box-content > p").css('overflow', 'hidden');
    			$(".box-modal > .box-content > p").html(footer);
        	}
        },
        error: function(result){ console.info(result); }
    });
}

function verificarPrimeiroAcesso()
{
	$.ajax({
        type: "get",
        url: rootUrl + "/Anuncios/dia_acesso",
        dataType: "json",
        success: function(result)
        { 
        	if (result.result)
        	{
        		openedModal = true;
        		
       			var html = "<img src='img/big-coin.png' alt='' style='display: block; margin-left: auto; margin-right: auto;' />";
        			html += "<br />";
			        html += "<p class='txt-center'>Ficamos feliz porque você voltou! Volte mais vezes e ganhe mais benefícios. :)</p>";

			    var footer = "<p class='right'>";
			        footer += "<button class='btn btn-cancel' id='modal-action' data-tipo='fechar'>Fechar</button>";
			        footer += "</p>";

			    $(".box-overlay").css("opacity", '1').css('visibility', 'visible');
    			$(".box-modal > .box-content").css('visibility', 'visible');
    			$(".box-modal h3").css("background-color", "#f5d313").text("Você recebeu E$ 10!");
    			$(".box-modal > .box-content > div > p").html(html);
    			$(".box-modal > .box-content > p").css('overflow', 'hidden');
    			$(".box-modal > .box-content > p").html(footer);

        		updateMoedas(PRIMEIRO_ACESSO);
        	}
        },
        error: function(result){ console.info(result); }
    });
}

function obtemRanking()
{
    $.ajax({
        type: "get",
        url: rootUrl + "/Usuario/ranking",
        dataType: "json",
        success: function(result)
        { 
            var html = "<ul>";

            for(var i = 0; i < 5; i++)
            {
                if (result.result[i] != null)
                {
                    html += "<li>";
                    if (result.result[i].foto_profile == "")
                        html += "<img src='img/sem-foto.png' class='left mr5' alt=''>";
                    else
                        html += "<img src='" + result.result[i].foto_profile + "' class='left mr5' alt=''>";
                    
                    html += "<h4>" + result.result[i].posicao + "&ordm; " + result.result[i].nome + "</h4>";
                    html += "<p>E$ " + result.result[i].pontuacao + "</p>";
                    html += "</li>";
                }
            }

            html += "</ul>";

            $(".ranking-box > article").html(html);
        },
        error: function(result){ console.info(result); }
    });
    
    setTimeout(obtemRanking, 10000);
}

function verificaPontuacao()
{
    var score = getPontuacao();
    var novoNivel = 1;
    var html, nivelAntigo;

    if(score >= 2000 && score < 3000)
    {
        novoNivel = 2;
        html = "<img src='img/aviso_nivel/nivel-2.png' alt='' style='margin-left: 16%' />";
    }
    else if(score >= 3000 && score < 4500)
    {
        novoNivel = 3;
        html = "<img src='img/aviso_nivel/nivel-3.png' alt='' style='margin-left: 16%' />";
    }
    else if(score >= 4500 && score < 8000)
    {
        novoNivel = 4;
        html = "<img src='img/aviso_nivel/nivel-4.png' alt='' style='margin-left: 16%' />";
    }
    else if(score >= 8000 && score < 12000)
    {
        novoNivel = 5;
        html = "<img src='img/aviso_nivel/nivel-5.png' alt='' style='margin-left: 16%' />";
    }
    else if(score >= 12000 && score < 17000)
    {
        novoNivel = 6;
        html = "<img src='img/aviso_nivel/nivel-6.png' alt='' style='margin-left: 16%' />";
    }
    else if(score >= 17000 && score < 25000)
    {
        novoNivel = 7;
        html = "<img src='img/aviso_nivel/nivel-7.png' alt='' style='margin-left: 16%' />";
    }
    else if(score >= 25000)
    {
        novoNivel = 8;
        html = "<img src='img/aviso_nivel/nivel-8.png' alt='' style='margin-left: 16%' />";
    }

    if (novoNivel != 1)
    {   
        $.ajax({
            type: "get",
            url: rootUrl + "/Usuario/nivel",
            dataType: "json",
            async: false,
            success: function(e) { nivelAntigo = parseInt(e.result); },
            error: function(result){ console.info(result); }
         });
    }

    if (nivelAntigo < novoNivel)
    {
        $.ajax({ // atualiza nivel do usuário
            type: "post",
            url: rootUrl + "/Usuario/update_nivel",
            data: JSON.stringify({"novo" : novoNivel}),
            dataType: "json",
            error: function(e) {console.info(e);}
        });

        var myModal = new Modal();
            myModal.setTitulo("Parabéns, você mudou o seu nível!");
            myModal.setTexto(html);
            myModal.showModal('F');
        
        return true;
    }
    
    return false;
}

$(document).ready(function()
{
    $("#user-box").bind('click', function()
    {
        var status = $(".tooltip").css('display');

        if (status == "none")
            $(".tooltip").css('display', 'block');
        else
            $(".tooltip").css('display', 'none');
    });

    var lastScrollTop = 0;
    $(window).scroll(function(event){
       var st = $(this).scrollTop();
       if (st > lastScrollTop + 40)
       {
           var status = $(".tooltip").css('display');

            if (status == "block")
                $(".tooltip").css('display', 'none');
       } 
       lastScrollTop = st;
    });
});

