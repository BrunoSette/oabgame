function userProfile(profile)
{
    var badges = [];
    badges[badgesEnum.TRES_ACERTOS_SEGUIDOS] = {"src" : "https://cdn.provasdaoab.com.br/aprovagame/img/badges/seguidos3-180.png", "exibe" : false};
    badges[badgesEnum.SETE_ACERTOS_SEGUIDOS] = {"src" : "https://cdn.provasdaoab.com.br/aprovagame/img/badges/seguidos7-180.png", "exibe" : false};
    badges[badgesEnum.DEZ_ACERTOS_SEGUIDOS] = {"src" : "https://cdn.provasdaoab.com.br/aprovagame/img/badges/seguidos10-180.png", "exibe" : false};
    badges[badgesEnum.QUINZE_ACERTOS_SEGUIDOS] = {"src" : "https://cdn.provasdaoab.com.br/aprovagame/img/badges/seguidos15-180.png", "exibe" : false};
    badges[badgesEnum.DEZ_RESPOSTAS_CORRETAS] = {"src" : "https://cdn.provasdaoab.com.br/aprovagame/img/badges/acertou10-180.png", "exibe" : false};
    badges[badgesEnum.VINTE_RESPOSTAS_CORRETAS] = {"src" : "https://cdn.provasdaoab.com.br/aprovagame/img/badges/acertou20-180.png", "exibe" : false};
    badges[badgesEnum.CINQUENTA_RESPOSTAS_CORRETAS] = {"src" : "https://cdn.provasdaoab.com.br/aprovagame/img/badges/acertou50-180.png", "exibe" : false};
    badges[badgesEnum.CEM_RESPOSTAS_CORRETAS] = {"src" : "https://cdn.provasdaoab.com.br/aprovagame/img/badges/acertou100-180.png", "exibe" : false};
    badges[badgesEnum.DUZENTAS_RESPOSTAS_CORRETAS] = {"src" : "https://cdn.provasdaoab.com.br/aprovagame/img/badges/acertou200-180.png", "exibe" : false};
    badges[badgesEnum.JOGOU_2X] = {"src" : "https://cdn.provasdaoab.com.br/aprovagame/img/badges/jogou2x-180.png", "exibe" : false};
    badges[badgesEnum.JOGOU_5X] = {"src" : "https://cdn.provasdaoab.com.br/aprovagame/img/badges/jogou5x-180.png", "exibe" : false};
    badges[badgesEnum.JOGOU_10X] = {"src" : "https://cdn.provasdaoab.com.br/aprovagame/img/badges/jogou10x-180.png", "exibe" : false};
    badges[badgesEnum.JOGOU_15X] = {"src" : "https://cdn.provasdaoab.com.br/aprovagame/img/badges/jogou15x-180.png", "exibe" : false};

    for (i in profile.badges) 
        badges[parseInt(profile.badges[i].badge)].exibe = true;

    var html = "<div class='mb10' style='overflow: hidden'>";
            if (profile.larger_foto_profile)
                html += "<img class='left mr10' src='"+profile.larger_foto_profile+"' alt='' />";
            else 
                html += "<img class='left mr10' src='img/sem-foto-200.png' alt='' />";
            html += "<p class='large'>" + profile.nome + "</p>";
            html += "<p>Localização: " + profile.localizacao + "</p>";
            html += "<p>E-mail: " + profile.email + "</p>";
            html += "<p>Data de Cadastro: " + profile.data_cadastro + "</p>";
        html += "</div>";

        html += "<div class='mt10 mb10'>";
        html += "<h4 class='mb10'>Conquistas</h4>";

        for (i in badges)
        {
            if (badges[i].exibe)
                html += "<div style='padding: 5px 15px;' class='left mr10'><img src='" + badges[i].src + "' alt='' /></div>";
            else
                html += "<div style='padding: 5px 15px;' class='left mr10'><img src='" + badges[i].src + "' style='opacity: 0.35' alt='' /></div>";
        }
        html += "</div>";

    $(".container-mainbox article").html(html);
}

$(document).ready(function()
{
	$.ajax({
        type: "get",
        url: rootUrl + "/Usuario/profile",
        dataType: "json",
        success: function(result) 
        {
         	userProfile(result.result);
        },
        error: function(result){console.info(result);}
    });
});