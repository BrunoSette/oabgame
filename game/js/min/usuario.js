function badges_vezes_jogadas(){$.ajax({type:"get",url:rootUrl+"/Usuario/profile",dataType:"json",success:function(e){var t,n;var r=false;if(e.result.qtd_acessos==2){t="<img src='img/badges/jogou2x.png' alt='' style='display: block; margin: 0 auto;' />";n={badge:badgesEnum.JOGOU_2X};$.ajax({type:"post",url:rootUrl+"/Badges/badge",data:JSON.stringify({badge:badgesEnum.JOGOU_2X}),dataType:"json",async:false,success:function(e){r=e.result},error:function(e){console.info(e)}})}else if(e.result.qtd_acessos==5){t="<img src='img/badges/jogou5x.png' alt='' style='display: block; margin: 0 auto;' />";n={badge:badgesEnum.JOGOU_5X};$.ajax({type:"post",url:rootUrl+"/Badges/badge",data:JSON.stringify({badge:badgesEnum.JOGOU_5X}),dataType:"json",async:false,success:function(e){r=e.result},error:function(e){console.info(e)}})}else if(e.result.qtd_acessos==10){t="<img src='img/badges/jogou10x.png' alt='' style='display: block; margin: 0 auto;' />";n={badge:badgesEnum.JOGOU_10X};$.ajax({type:"post",url:rootUrl+"/Badges/badge",data:JSON.stringify({badge:badgesEnum.JOGOU_10X}),dataType:"json",async:false,success:function(e){r=e.result},error:function(e){console.info(e)}})}else if(e.result.qtd_acessos==15){t="<img src='img/badges/jogou15x.png' alt='' style='display: block; margin: 0 auto;' />";n={badge:badgesEnum.JOGOU_15X};$.ajax({type:"post",url:rootUrl+"/Badges/badge",data:JSON.stringify({badge:badgesEnum.JOGOU_15X}),dataType:"json",async:false,success:function(e){r=e.result},error:function(e){console.info(e)}})}console.info();if(r){var i=new Modal;i.setTitulo("Parabéns, você recebeu um badge!");i.setTexto(t);i.showModal("F");$.ajax({type:"post",url:rootUrl+"/Badges/concede_badge",data:JSON.stringify(n),dataType:"json",success:function(e){console.info(e)},error:function(e){console.info(e)}});return true}},error:function(e){console.info(e)}});return false}function badge_acertos_seguidos(){var e,t;var n=false;if(acertosSeguidos==3){e="<img src='img/badges/seguidos3.png' alt='' style='display: block; margin: 0 auto;' />";t={badge:badgesEnum.TRES_ACERTOS_SEGUIDOS};n=true}else if(acertosSeguidos==7){e="<img src='img/badges/seguidos7.png' alt='' style='display: block; margin: 0 auto;' />";t={badge:badgesEnum.SETE_ACERTOS_SEGUIDOS};n=true}else if(acertosSeguidos==10){e="<img src='img/badges/seguidos10.png' alt='' style='display: block; margin: 0 auto;' />";t={badge:badgesEnum.DEZ_ACERTOS_SEGUIDOS};n=true}else if(acertosSeguidos==15){e="<img src='img/badges/seguidos15.png' alt='' style='display: block; margin: 0 auto;' />";t={badge:badgesEnum.QUINZE_ACERTOS_SEGUIDOS};n=true}if(n){$.ajax({type:"post",url:rootUrl+"/Badges/concede_badge",data:JSON.stringify(t),dataType:"json",success:function(t){if(t.result==true){var n=new Modal;n.setTitulo("Parabéns, você recebeu um badge!");n.setTexto(e);n.showModal("F")}},error:function(e){console.info(e)}});return true}return false}function badge_acertos(){$.ajax({type:"get",url:rootUrl+"/Usuario/profile",dataType:"json",success:function(e){var t,n;var r=false;if(e.result.qtd_acessos==10){t="<img src='img/badges/acertou10.png' alt='' style='display: block; margin: 0 auto;' />";n={badge:badgesEnum.DEZ_RESPOSTAS_CORRETAS};r=true}else if(e.result.qtd_acessos==20){t="<img src='img/badges/acertou20.png' alt='' style='display: block; margin: 0 auto;' />";n={badge:badgesEnum.VINTE_RESPOSTAS_CORRETAS};r=true}else if(e.result.qtd_acessos==50){t="<img src='img/badges/acertou50.png' alt='' style='display: block; margin: 0 auto;' />";n={badge:badgesEnum.CINQUENTA_RESPOSTAS_CORRETAS};r=true}else if(e.result.qtd_acessos==100){t="<img src='img/badges/acertou100.png' alt='' style='display: block; margin: 0 auto;' />";n={badge:badgesEnum.CEM_RESPOSTAS_CORRETAS};r=true}else if(e.result.qtd_acessos==200){t="<img src='img/badges/acertou200.png' alt='' style='display: block; margin: 0 auto;' />";n={badge:badgesEnum.DUZENTAS_RESPOSTAS_CORRETAS};r=true}if(r){var i=new Modal;i.setTitulo("Parabéns, você recebeu um badge!");i.setTexto(t);i.showModal("F");$.ajax({type:"post",url:rootUrl+"/Badges/concede_badge",data:JSON.stringify(n),dataType:"json",success:function(e){console.info(e)},error:function(e){console.info(e)}});return true}},error:function(e){console.info(e)}})}function atualizaPerfil(){$.ajax({type:"get",url:rootUrl+"/Usuario/profile",dataType:"json",success:function(e){var t;$(".tooltip-sys .txt-profile .nivel").text("Nível "+e.result.nivel);if(e.result.genero=="female"){if(e.result.nivel==1)t="<img src='img/profile_nivel/mulher/nivel-1.png' alt=''/>";else if(e.result.nivel==2)t="<img src='img/profile_nivel/mulher/nivel-2.png' alt=''/>";else if(e.result.nivel==3)t="<img src='img/profile_nivel/mulher/nivel-3.png' alt=''/>";else if(e.result.nivel==4)t="<img src='img/profile_nivel/mulher/nivel-4.png' alt=''/>";else if(e.result.nivel==5)t="<img src='img/profile_nivel/mulher/nivel-5.png' alt=''/>";else if(e.result.nivel==6)t="<img src='img/profile_nivel/mulher/nivel-6.png' alt=''/>";else if(e.result.nivel==7)t="<img src='img/profile_nivel/mulher/nivel-7.png' alt=''/>";else if(e.result.nivel==8)t="<img src='img/profile_nivel/mulher/nivel-8.png' alt=''/>"}else{if(e.result.nivel==1)t="<img src='img/profile_nivel/homem/nivel-1.png' alt=''/>";else if(e.result.nivel==2)t="<img src='img/profile_nivel/homem/nivel-2.png' alt=''/>";else if(e.result.nivel==3)t="<img src='img/profile_nivel/homem/nivel-3.png' alt=''/>";else if(e.result.nivel==4)t="<img src='img/profile_nivel/homem/nivel-4.png' alt=''/>";else if(e.result.nivel==5)t="<img src='img/profile_nivel/homem/nivel-5.png' alt=''/>";else if(e.result.nivel==6)t="<img src='img/profile_nivel/homem/nivel-6.png' alt=''/>";else if(e.result.nivel==7)t="<img src='img/profile_nivel/homem/nivel-7.png' alt=''/>";else if(e.result.nivel==8)t="<img src='img/profile_nivel/homem/nivel-8.png' alt=''/>"}$(".tooltip-sys  .image-profile").html(t)},error:function(e){console.info(e)}})}function rankingAmigos(){$.ajax({type:"get",url:rootUrl+"/Usuario/ranking_friends",dataType:"json",success:function(e){var t="<ul>";for(i in e.result){if(e.result[i]!=null){t+="<li>";t+="<img src='"+e.result[i].foto+"' class='left mr5' alt=''>";t+="<h4>"+(parseInt(i)+1)+"&ordm; "+e.result[i].nome+"</h4>";t+="<p>"+e.result[i].pontuacao+"<i class='small'> pontos</i></p>";t+="</li>"}}t+="</ul>";$(".friends-box > article").html(t)},error:function(e){console.log(e)}})}$(document).ready(function(){badges_vezes_jogadas();atualizaPerfil();rankingAmigos()})