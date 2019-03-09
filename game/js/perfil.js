function getBadges() {
    var pins = [];
    pins[badgesEnum.TRES_ACERTOS_SEGUIDOS] =    {   "src" : clienteUrl + "/img/badges/seguidos3-180.png", 
                                                    "exibe" : false,
                                                    "title" : "Três acertos seguidos",
                                                    "desc" : "Acerte três questões seguidas e ganhe."
                                                };

    pins[badgesEnum.SETE_ACERTOS_SEGUIDOS] =    {  "src" : clienteUrl + "/img/badges/seguidos7-180.png", 
                                                    "exibe" : false,
                                                    "title" : "Sete acertos seguidos",
                                                    "desc" : "Acerte sete questões seguidas e ganhe."
                                                };
    
    pins[badgesEnum.DEZ_ACERTOS_SEGUIDOS] =     {   "src" : clienteUrl + "/img/badges/seguidos10-180.png", 
                                                    "exibe" : false,
                                                    "title" : "Dez acertos seguidos",
                                                    "desc" : "Acerte dez questões seguidas e ganhe."
                                                };
    
    pins[badgesEnum.QUINZE_ACERTOS_SEGUIDOS] =  {
                                                    "src" : clienteUrl + "/img/badges/seguidos15-180.png", 
                                                    "exibe" : false,
                                                    "title" : "Quinze acertos seguidos",
                                                    "desc" : "Acerte quinze questões seguidas e ganhe."
                                                };
    
    pins[badgesEnum.DEZ_RESPOSTAS_CORRETAS] =   {
                                                    "src" : clienteUrl + "/img/badges/acertou10-180.png", 
                                                    "exibe" : false,
                                                    "title" : "Dez respostas certas",
                                                    "desc" : "Acerte dez questões e ganhe."
                                                };
    
    
    pins[badgesEnum.VINTE_RESPOSTAS_CORRETAS] = {
                                                    "src" : clienteUrl + "/img/badges/acertou20-180.png", 
                                                    "exibe" : false,
                                                    "title" : "Vinte respostas certas",
                                                    "desc" : "Acerte vinte questões e ganhe."
                                                };
    
    
    pins[badgesEnum.CINQUENTA_RESPOSTAS_CORRETAS] = {
                                                        "src" : clienteUrl + "/img/badges/acertou50-180.png", 
                                                        "exibe" : false,
                                                        "title" : "Cinquenta respostas certas",
                                                        "desc" : "Acerte cinquenta questões e ganhe."
                                                    };
    

    pins[badgesEnum.CEM_RESPOSTAS_CORRETAS] =       {
                                                        "src" : clienteUrl + "/img/badges/acertou100-180.png", 
                                                        "exibe" : false,
                                                        "title" : "Cem respostas certas",
                                                        "desc" : "Acerte cem questões e ganhe."
                                                    };
    

    pins[badgesEnum.DUZENTAS_RESPOSTAS_CORRETAS] =  {
                                                        "src" : clienteUrl + "/img/badges/acertou200-180.png", 
                                                        "exibe" : false,
                                                        "title" : "Duzentas respostas certas",
                                                        "desc" : "Acerte duzentas questões e ganhe."
                                                    };
    
    pins[badgesEnum.JOGOU_2X] =                     {
                                                        "src" : clienteUrl + "/img/badges/jogou2x-180.png", 
                                                        "exibe" : false,
                                                        "title" : "Jogou duas vezes",
                                                        "desc" : "Jogue duas vezes e ganhe."
                                                    }; 
    
    pins[badgesEnum.JOGOU_5X] =                     {
                                                        "src" : clienteUrl + "/img/badges/jogou5x-180.png", 
                                                        "exibe" : false,
                                                        "title" : "Jogou cinco vezes",
                                                        "desc" : "Jogue cinco vezes e ganhe."
                                                    };
    
    pins[badgesEnum.JOGOU_10X] =                    {
                                                        "src" : clienteUrl + "/img/badges/jogou10x-180.png", 
                                                        "exibe" : false,
                                                        "title" : "Jogou dez vezes",
                                                        "desc" : "Jogue dez vezes e ganhe."
                                                    };
    
    pins[badgesEnum.JOGOU_15X] =                    {
                                                        "src" : clienteUrl + "/img/badges/jogou15x-180.png", 
                                                        "exibe" : false,
                                                        "title" : "Jogou quinze vezes",
                                                        "desc" : "Jogue quinze vezes e ganhe."
                                                    };

    return pins;
}

function userProfile(profile) {

    if(!profile) goPage("login");

    console.dir(profile);

    // Seleciona os badges que serão exibidos.
    var pins = getBadges();

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
                html += "<li style='padding: 5px 15px;' class='mr10'><img class='left' src='"+pins[i].src+"' style='width:10%;'/>";
            else
                html += "<li style='padding: 5px 15px;' class='mr10'><img class='left' src='" + pins[i].src + "' style='width:10%; opacity: 0.35'/>";

            html +=     "<span style='line-height: 120px>"+"<b>"+pins[i].title+"</b>"+" - "+pins[i].desc+"</span>";
            html += "</li>";
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