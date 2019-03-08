function userProfile(profile) {
    var pins = [];
    pins[badgesEnum.TRES_ACERTOS_SEGUIDOS] =        {"src" : clienteUrl + "/img/badges/seguidos3-180.png", "exibe" : false};
    pins[badgesEnum.SETE_ACERTOS_SEGUIDOS] =        {"src" : clienteUrl + "/img/badges/seguidos7-180.png", "exibe" : false};
    pins[badgesEnum.DEZ_ACERTOS_SEGUIDOS] =         {"src" : clienteUrl + "/img/badges/seguidos10-180.png", "exibe" : false};
    pins[badgesEnum.QUINZE_ACERTOS_SEGUIDOS] =      {"src" : clienteUrl + "/img/badges/seguidos15-180.png", "exibe" : false};
    pins[badgesEnum.DEZ_RESPOSTAS_CORRETAS] =       {"src" : clienteUrl + "/img/badges/acertou10-180.png", "exibe" : false};
    pins[badgesEnum.VINTE_RESPOSTAS_CORRETAS] =     {"src" : clienteUrl + "/img/badges/acertou20-180.png", "exibe" : false};
    pins[badgesEnum.CINQUENTA_RESPOSTAS_CORRETAS] = {"src" : clienteUrl + "/img/badges/acertou50-180.png", "exibe" : false};
    pins[badgesEnum.CEM_RESPOSTAS_CORRETAS] =       {"src" : clienteUrl + "/img/badges/acertou100-180.png", "exibe" : false};
    pins[badgesEnum.DUZENTAS_RESPOSTAS_CORRETAS] =  {"src" : clienteUrl + "/img/badges/acertou200-180.png", "exibe" : false};
    pins[badgesEnum.JOGOU_2X] =                     {"src" : clienteUrl + "/img/badges/jogou2x-180.png", "exibe" : false};
    pins[badgesEnum.JOGOU_5X] =                     {"src" : clienteUrl + "/img/badges/jogou5x-180.png", "exibe" : false};
    pins[badgesEnum.JOGOU_10X] =                    {"src" : clienteUrl + "/img/badges/jogou10x-180.png", "exibe" : false};
    pins[badgesEnum.JOGOU_15X] =                    {"src" : clienteUrl + "/img/badges/jogou15x-180.png", "exibe" : false};

    for (i in profile.pins) 
        pins[parseInt(profile.pins[i].badge)].exibe = true;

    var userImage = profile.larger_foto_profile ? profile.larger_foto_profile : 'img/sem-foto-200.png';
    var html = "<div class='mb10' style='overflow: hidden'>";
        html +=     "<img class='left mr10' src='"+userImage+"' alt='' />";
        html +=     "<p class='large'>" + profile.nome + "</p>";
        html +=     "<p>Localização: " + profile.localizacao + "</p>";
        html +=     "<p>E-mail: " + profile.email + "</p>";
        html +=     "<p>Data de Cadastro: " + profile.data_cadastro + "</p>";
        html += "</div>";
        html += "<div class='mt10 mb10'>";
        html += "<h4 class='mb10'>Suas Conquistas</h4>";

        for (i in pins) {
            if (pins[i].exibe)
                html += "<div style='padding: 5px 15px;' class='left mr10'><img src='" + pins[i].src + "' alt='' /></div>";
            else
                html += "<div style='padding: 5px 15px;' class='left mr10'><img src='" + pins[i].src + "' style='opacity: 0.35' alt='' /></div>";
        }

    $(".container-mainbox article").html(html);
}

$(document).ready(function() {
	$.ajax({
        type: "get",
        url: rootUrl + "/Usuario/profile",
        dataType: "json",
        success: function(result) { userProfile(result.result); },
        error: function(result){ console.info(result); }
    });
});