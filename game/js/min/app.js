function isUndefined(e){if(e==undefined){return true}else{return false}}function goPage(e){location.href=clienteUrl+"/"+e}function verificarPrimeiroAcesso(){$.ajax({type:"get",url:rootUrl+"/Anuncios/dia_acesso",dataType:"json",success:function(e){if(e.result){openedModal=true;var t="<img src='img/big-coin.png' alt='' style='display: block; margin-left: auto; margin-right: auto;' />";t+="<br />";t+="<p class='txt-center'>Ficamos feliz porque você voltou! Volte mais vezes e ganhe mais benefícios. :)</p>";var n=new Modal;n.setCor("#f5d313");n.setTitulo("Você recebeu E$ 10!");n.setTexto(t);n.showModal("F");updateMoedas(PRIMEIRO_ACESSO)}},error:function(e){console.info(e)}})}function closeModal(e){$(e).remove();if(modaisAbertos-1==0)$(".box-overlay").css("opacity","0").css("visibility","hidden");modaisAbertos--;openedModal=false}function obtemRanking(){$.ajax({type:"get",url:rootUrl+"/Usuario/ranking",dataType:"json",success:function(e){var t="<ul>";for(var n=0;n<5;n++){if(e.result[n]!=null){t+="<li>";if(e.result[n].foto_profile=="")t+="<img src='img/sem-foto.png' class='left mr5' alt=''>";else t+="<img src='"+e.result[n].foto_profile+"' class='left mr5' alt=''>";t+="<h4>"+e.result[n].posicao+"&ordm; "+e.result[n].nome+"</h4>";t+="<p> "+e.result[n].pontuacao+"<i class='small'> pontos</i></p>";t+="</li>"}}t+="</ul>";$(".ranking-box > article").html(t)},error:function(e){console.info(e)}});setTimeout(obtemRanking,1e4)}function verificaPontuacao(){var e=getPontuacao();var t=1;var n,r;if(e>=2e3&&e<3e3){t=2;n="<img src='img/aviso_nivel/nivel-2.png' alt='' style='margin-left: 16%' />"}else if(e>=3e3&&e<4500){t=3;n="<img src='img/aviso_nivel/nivel-3.png' alt='' style='margin-left: 16%' />"}else if(e>=4500&&e<8e3){t=4;n="<img src='img/aviso_nivel/nivel-4.png' alt='' style='margin-left: 16%' />"}else if(e>=8e3&&e<12e3){t=5;n="<img src='img/aviso_nivel/nivel-5.png' alt='' style='margin-left: 16%' />"}else if(e>=12e3&&e<17e3){t=6;n="<img src='img/aviso_nivel/nivel-6.png' alt='' style='margin-left: 16%' />"}else if(e>=17e3&&e<25e3){t=7;n="<img src='img/aviso_nivel/nivel-7.png' alt='' style='margin-left: 16%' />"}else if(e>=25e3){t=8;n="<img src='img/aviso_nivel/nivel-8.png' alt='' style='margin-left: 16%' />"}if(t!=1){$.ajax({type:"get",url:rootUrl+"/Usuario/nivel",dataType:"json",async:false,success:function(e){r=parseInt(e.result)},error:function(e){console.info(e)}})}if(r<t){$.ajax({type:"post",url:rootUrl+"/Usuario/update_nivel",data:JSON.stringify({novo:t}),dataType:"json",error:function(e){console.info(e)}});var i=new Modal;i.setTitulo("Parabéns, você mudou o seu nível!");i.setTexto(n);i.showModal("F");return true}return false}var rootUrl="http://www.aprovagame.com.br/game/app";var clienteUrl="http://www.aprovagame.com.br/game";const RESPOSTA_CORRETA=20;const PULAR_PERGUNTA=-5;const ELIMINAR_RESPOSTA=-5;const RESPOSTA_ERRADA=-10;const RESPONDEU_ENQUETE=15;const PRIMEIRO_ACESSO=10;badgesEnum={TRES_ACERTOS_SEGUIDOS:1,SETE_ACERTOS_SEGUIDOS:2,DEZ_ACERTOS_SEGUIDOS:3,QUINZE_ACERTOS_SEGUIDOS:4,DEZ_RESPOSTAS_CORRETAS:5,VINTE_RESPOSTAS_CORRETAS:6,CINQUENTA_RESPOSTAS_CORRETAS:7,CEM_RESPOSTAS_CORRETAS:8,DUZENTAS_RESPOSTAS_CORRETAS:9,JOGOU_2X:10,JOGOU_5X:11,JOGOU_10X:12,JOGOU_15X:13};var gabarito;var comentario;var idQuestao;var openedModal=false;var acertosSeguidos=0;var modaisAbertos=0;var Modal=function(){var e;var t;var n;this.setCor=function(e){this.cor=e};this.setTitulo=function(e){this.titulo=e};this.setTexto=function(e){this.texto=e};this.showModal=function(e){openedModal=true;modaisAbertos++;var t="<div class='box-modal' data-attr='"+modaisAbertos+"'><div class='box-content'><h3></h3><div><p></p></div><p><button class='btn btn-info modal-action' data-tipo='fechar'></button></p></div></div>";$(".topo").after(t);$(".box-overlay").css("opacity","1").css("visibility","visible");$(".box-modal > .box-content").css("visibility","visible");var n=$(".box-modal[data-attr='"+modaisAbertos+"']");if(this.cor!=null)$(n).children(".box-content").children("h3").css("background-color",this.cor).text(this.titulo);else $(n).children(".box-content").children("h3").text(this.titulo);$(n).children(".box-content").children("div").children("p").html(this.texto);if(e=="F"||e=="f"){$(n).children(".box-content").children("p").children(".modal-action").attr("data-tipo","fechar");$(n).children(".box-content").children("p").children(".modal-action").text("Fechar")}else if(e=="P"||e=="p"){$(n).children(".box-content").children("p").children(".modal-action").attr("data-tipo","prox");$(n).children(".box-content").children("p").children(".modal-action").text("Proxima pergunta")}}};$(document).ready(function(){$("#user-box").bind("click",function(){var e=$(".tooltip-sys").css("display");if(e=="none")$(".tooltip-sys").css("display","block");else $(".tooltip-sys").css("display","none")});$("#linkSair").bind("click",function(){sair=true;$.ajax({type:"get",url:rootUrl+"/Usuario/logout",success:function(){$.removeCookie("usuario");goPage("logout")}})});var e=0;$(window).scroll(function(t){var n=$(this).scrollTop();if(n>e+40){var r=$(".tooltip").css("display");if(r=="block")$(".tooltip").css("display","none")}e=n});$("body").on("click",".modal-action",function(){var e=$(this).attr("data-tipo");var t=$(this).parent("p").parent(".box-content").parent(".box-modal");if(e=="prox"){$("input[name='option']").attr("checked",false);findQuestion()}closeModal(t)})})