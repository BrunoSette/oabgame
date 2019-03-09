function userProfile(profile) {

    if(profile) goPage("login");

    console.dir(profile);

    // Seleciona os badges que serão exibidos.
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

    for (i in profile.badges) 
        pins[parseInt(profile.badges[i].badge)].exibe = true;

    // Preenche nivel do usuário.
    var genero = (profile.genero == "female") ? "female" : "male";
    var img_url = GeneroNivelImageURL[genero][profile.nivel-1];
    var userImage = profile.larger_foto_profile ? profile.larger_foto_profile : img_url;

    var html = "<div class='mb10' style='overflow: hidden'>";
        html +=     "<img class='left mr10' src='"+userImage+"' alt='' />";
        html +=     "<p class='large'>" + profile.nome + "</p>";
        html +=     "<p>Localização: " + profile.localizacao + "</p>";
        html +=     "<p>E-mail: " + profile.email + "</p>";
        html +=     "<p>Data de Cadastro: " + profile.data_cadastro + "</p>";
        html += "</div>";
        html += "<div class='mt10 mb10'>";
        html += "<h4 class='mb10'><i class='fa fa-star'></i> Suas Conquistas</h4>";

        html += "<ul>";
        for (i in pins) {
            if (pins[i].exibe)
                html += "<li style='padding: 5px 15px;' class='mr10'><img class='left' src='" + pins[i].src + "' alt='' /><p>Test</p></li>";
            else
                html += "<li style='padding: 5px 15px;' class='mr10'><img class='left' src='" + pins[i].src + "' style='opacity: 0.35' alt='' /><p>Test</p></li>";
        }
        html += "</ul>";

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