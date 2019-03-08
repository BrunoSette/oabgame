var GeneroNivelImageURL = {
    "female" : [clienteUrl + "/img/profile_nivel/mulher/nivel-1.png",
                clienteUrl + "/img/profile_nivel/mulher/nivel-2.png",
                clienteUrl + "/img/profile_nivel/mulher/nivel-3.png",
                clienteUrl + "/img/profile_nivel/mulher/nivel-4.png",
                clienteUrl + "/img/profile_nivel/mulher/nivel-5.png",
                clienteUrl + "/img/profile_nivel/mulher/nivel-6.png",
                clienteUrl + "/img/profile_nivel/mulher/nivel-7.png",
                clienteUrl + "/img/profile_nivel/mulher/nivel-8.png"],

    "male" :    [clienteUrl + "/img/profile_nivel/homem/nivel-1.png",
                clienteUrl + "/img/profile_nivel/homem/nivel-2.png",
                clienteUrl + "/img/profile_nivel/homem/nivel-3.png",
                clienteUrl + "/img/profile_nivel/homem/nivel-4.png",
                clienteUrl + "/img/profile_nivel/homem/nivel-5.png",
                clienteUrl + "/img/profile_nivel/homem/nivel-6.png",
                clienteUrl + "/img/profile_nivel/homem/nivel-7.png",
                clienteUrl + "/img/profile_nivel/homem/nivel-8.png",]
};

function badges_vezes_jogadas() {
	$.ajax({
        type: "get",
        url: rootUrl + "/Usuario/profile",
        dataType: "json",
        success: function(e) {	
        	var img, data;
        	var concedeBadge = false;

        	if(e.result.qtd_acessos == 2) {
        		img = "<img src='https://www.oabgame.com.br/game/img/badges/jogou2x.png' alt='' style='display: block; margin: 0 auto;' />";
        		data = {"badge" : badgesEnum.JOGOU_2X};

                $.ajax({
                    type: "post", 
                    url: rootUrl + "/Badges/badge", 
                    data: JSON.stringify({"badge" : badgesEnum.JOGOU_2X}), 
                    dataType: "json",
                    async: false,
                    success: function(e) {   concedeBadge = e.result; },
                    error: function(result){ console.info(result); } 
                });
        	}
        	else if(e.result.qtd_acessos == 5) {
        		img = "<img src='https://www.oabgame.com.br/game/img/badges/jogou5x.png' alt='' style='display: block; margin: 0 auto;' />";
        		data = {"badge" : badgesEnum.JOGOU_5X}
        		
                $.ajax({
                    type: "post", 
                    url: rootUrl + "/Badges/badge", 
                    data: JSON.stringify({"badge" : badgesEnum.JOGOU_5X}), 
                    dataType: "json",
                    async: false,
                    success: function(e) {   concedeBadge = e.result;},
                    error: function(result){ console.info(result); } 
                });
        	}
        	else if(e.result.qtd_acessos == 10) {
        		img = "<img src='https://www.oabgame.com.br/game/img/badges/jogou10x.png' alt='' style='display: block; margin: 0 auto;' />";
        		data = {"badge" : badgesEnum.JOGOU_10X}
        		
                $.ajax({
                    type: "post", 
                    url: rootUrl + "/Badges/badge", 
                    data: JSON.stringify({"badge" : badgesEnum.JOGOU_10X}), 
                    dataType: "json",
                    async: false,
                    success: function(e) {   concedeBadge = e.result;},
                    error: function(result){ console.info(result); } 
                });
        	}
        	else if(e.result.qtd_acessos == 15) {
        		img = "<img src='https://www.oabgame.com.br/game/img/badges/jogou15x.png' alt='' style='display: block; margin: 0 auto;' />";
        		data = {"badge" : badgesEnum.JOGOU_15X}
        		
                $.ajax({
                    type: "post", 
                    url: rootUrl + "/Badges/badge", 
                    data: JSON.stringify({"badge" : badgesEnum.JOGOU_15X}), 
                    dataType: "json",
                    async: false,
                    success: function(e) {   concedeBadge = e.result;},
                    error: function(result){ console.info(result); } 
                });
        	}

        	if (concedeBadge) {
        		var myModal = new Modal();
                        myModal.setTitulo("Parabéns, você recebeu um badge!");
                        myModal.setTexto(img);
                        myModal.showModal('F');

                $.ajax({
	                type: "post",
	                url: rootUrl + "/Badges/concede_badge",
	                data: JSON.stringify(data),
	                dataType: "json",
	                success: function(e) {console.info(e);}, 
	                error: function(e) {console.info(e);}
            	});

            	return true;
        	}
        },
        error: function(result){ console.info(result); }
     });

	return false;
}

function badge_acertos_seguidos() {
	var img;
    var data;
	var concedeBadge = false;

	if (acertosSeguidos == 3) {
		img = "<img src='https://www.oabgame.com.br/game/img/badges/seguidos3.png' alt='' style='display: block; margin: 0 auto;' />";
        data = {"badge" : badgesEnum.TRES_ACERTOS_SEGUIDOS}
        concedeBadge = true;
	}
	else if(acertosSeguidos == 7) {
		img = "<img src='https://www.oabgame.com.br/game/img/badges/seguidos7.png' alt='' style='display: block; margin: 0 auto;' />";
        data = {"badge" : badgesEnum.SETE_ACERTOS_SEGUIDOS}
        concedeBadge = true;
	}
	else if(acertosSeguidos == 10) {
		img = "<img src='https://www.oabgame.com.br/game/img/badges/seguidos10.png' alt='' style='display: block; margin: 0 auto;' />";
        data = {"badge" : badgesEnum.DEZ_ACERTOS_SEGUIDOS}
        concedeBadge = true;
	}
	else if(acertosSeguidos == 15) {
		img = "<img src='https://www.oabgame.com.br/game/img/badges/seguidos15.png' alt='' style='display: block; margin: 0 auto;' />";
        data = {"badge" : badgesEnum.QUINZE_ACERTOS_SEGUIDOS}
        concedeBadge = true;
	}

    if (!concedeBadge)
        return false;

    $.ajax({
        type: "post",
        url: rootUrl + "/Badges/concede_badge",
        data: JSON.stringify(data),
        dataType: "json",
        success: function(e) {
        	if(e.result == true) {
        		var myModal = new Modal();
                    myModal.setTitulo("Parabéns, você recebeu um badge!");
                    myModal.setTexto(img);
                    myModal.showModal('F');
        	}
        }, 
        error: function(e) { console.info(e); }
	});

	return true;
}

function badge_acertos() {
	$.ajax({
        type: "get",
        url: rootUrl + "/Usuario/profile",
        dataType: "json",
        success: function(e) {	
        	var img, data;
        	var concedeBadge = false;

        	if(e.result.qtd_acessos == 10) {
        		img = "<img src='https://www.oabgame.com.br/game/img/badges/acertou10.png' alt='' style='display: block; margin: 0 auto;' />";
        		data = {"badge" : badgesEnum.DEZ_RESPOSTAS_CORRETAS}
        		concedeBadge = true;
        	}
        	else if(e.result.qtd_acessos == 20) {
        		img = "<img src='https://www.oabgame.com.br/game/img/badges/acertou20.png' alt='' style='display: block; margin: 0 auto;' />";
        		data = {"badge" : badgesEnum.VINTE_RESPOSTAS_CORRETAS}
        		concedeBadge = true;
        	}
        	else if(e.result.qtd_acessos == 50) {
        		img = "<img src='https://www.oabgame.com.br/game/img/badges/acertou50.png' alt='' style='display: block; margin: 0 auto;' />";
        		data = {"badge" : badgesEnum.CINQUENTA_RESPOSTAS_CORRETAS}
        		concedeBadge = true;
        	}
        	else if(e.result.qtd_acessos == 100) {
        		img = "<img src='https://www.oabgame.com.br/game/img/badges/acertou100.png' alt='' style='display: block; margin: 0 auto;' />";
        		data = {"badge" : badgesEnum.CEM_RESPOSTAS_CORRETAS}
        		concedeBadge = true;
        	}
        	else if(e.result.qtd_acessos == 200) {
        		img = "<img src='https://www.oabgame.com.br/game/img/badges/acertou200.png' alt='' style='display: block; margin: 0 auto;' />";
        		data = {"badge" : badgesEnum.DUZENTAS_RESPOSTAS_CORRETAS}
        		concedeBadge = true;
        	}

        	if (concedeBadge) {
        		var myModal = new Modal();
                        myModal.setTitulo("Parabéns, você recebeu um badge!");
                        myModal.setTexto(img);
                        myModal.showModal('F');

                $.ajax({
	                type: "post",
	                url: rootUrl + "/Badges/concede_badge",
	                data: JSON.stringify(data),
	                dataType: "json",
	                success: function(e) {console.info(e);}, 
	                error: function(e) {console.info(e);}
            	});

            	return true;
        	}
        },
        error: function(result){ console.info(result); }
     });
}

function atualizaPerfil() {
    // Função a ser chamada, caso a requisição seja executada com sucesso.
    var successGetUsuario = function(e) {
        console.dir(e.result);

        // Preenche moedas do usuário.
        $("#userCash").text(e.result.pontuacao);

        // Preenche o score do usuário.
        $("#userScore").text(e.result.pontuacao_geral);

        // Preenche o nível do usuário.
        $(".tooltip-sys .txt-profile .nivel").text("Nível " + e.result.nivel);
        var genero = (e.result.genero == "female") ? "female" : "male";
        var img_url = GeneroNivelImageURL[genero][e.result.nivel - 1];
        $(".tooltip-sys  .image-profile").html("<img src='" + img_url + "' alt=''/>";);

        // Preenche imagem do usuário.
        var user_image = e.result.foto_profile ? e.result.foto_profile : img_url;
        $("#userImage").attr("src", user_image);
    }

	$.ajax({
        type: "get",
        url: rootUrl + "/Usuario/profile",
        dataType: "json",
        success: successGetUsuario,
        error: function(result){ console.info(result); }
     });
}

function obtemRanking() {
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

            $(".friends-box > article").html(html);
        },
        error: function(result){ console.info(result); }
    });
}

$(document).ready(function() {
	badges_vezes_jogadas();
	atualizaPerfil();
    obtemRanking();
});