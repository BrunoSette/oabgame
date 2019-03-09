function getBadges() {
    var pins = [];
    pins[badgesEnum.TRES_ACERTOS_SEGUIDOS] =    {   "src" : clienteUrl + "/img/badges/seguidos3-180.png", 
                                                    "exibe" : false,
                                                    "ganhar" : "Acerte três questões seguidas e ganhe.",
                                                    "ganhou" : "Você acertou três questões seguidas."
                                                };

    pins[badgesEnum.SETE_ACERTOS_SEGUIDOS] =    {  "src" : clienteUrl + "/img/badges/seguidos7-180.png", 
                                                    "exibe" : false,
                                                    "ganhar" : "Acerte sete questões seguidas e ganhe.",
                                                    "ganhou" : "Você acertou sete questões seguidas."
                                                };
    
    pins[badgesEnum.DEZ_ACERTOS_SEGUIDOS] =     {   "src" : clienteUrl + "/img/badges/seguidos10-180.png", 
                                                    "exibe" : false,
                                                    "ganhar" : "Acerte dez questões seguidas e ganhe.",
                                                    "ganhou" : "Você acertou dez questões seguidas."
                                                };
    
    pins[badgesEnum.QUINZE_ACERTOS_SEGUIDOS] =  {
                                                    "src" : clienteUrl + "/img/badges/seguidos15-180.png", 
                                                    "exibe" : false,
                                                    "ganhar" : "Acerte quinze questões seguidas e ganhe.",
                                                    "ganhou" : "Você acertou quinze questões seguidas."
                                                };
    
    pins[badgesEnum.DEZ_RESPOSTAS_CORRETAS] =   {
                                                    "src" : clienteUrl + "/img/badges/acertou10-180.png", 
                                                    "exibe" : false,
                                                    "ganhar" : "Acerte dez questões e ganhe.",
                                                    "ganhou" : "Você acertou dez questões.",
                                                };
    
    
    pins[badgesEnum.VINTE_RESPOSTAS_CORRETAS] = {
                                                    "src" : clienteUrl + "/img/badges/acertou20-180.png", 
                                                    "exibe" : false,
                                                    "ganhar" : "Acerte vinte questões e ganhe.",
                                                    "ganhou" : "Você acertou vinte questões.",
                                                };
    
    
    pins[badgesEnum.CINQUENTA_RESPOSTAS_CORRETAS] = {
                                                        "src" : clienteUrl + "/img/badges/acertou50-180.png", 
                                                        "exibe" : false,
                                                        "ganhar" : "Acerte cinquenta questões e ganhe.",
                                                        "ganhou" : "Você acertou cinquenta questões."
                                                    };
    

    pins[badgesEnum.CEM_RESPOSTAS_CORRETAS] =       {
                                                        "src" : clienteUrl + "/img/badges/acertou100-180.png", 
                                                        "exibe" : false,
                                                        "ganhar" : "Acerte cem questões e ganhe.",
                                                        "ganhou" : "Você acertou cem questões."
                                                    };
    

    pins[badgesEnum.DUZENTAS_RESPOSTAS_CORRETAS] =  {
                                                        "src" : clienteUrl + "/img/badges/acertou200-180.png", 
                                                        "exibe" : false,
                                                        "ganhar" : "Acerte duzentas questões e ganhe.",
                                                        "ganhou" : "Você acertou duzentas questões."
                                                    };
    
    pins[badgesEnum.JOGOU_2X] =                     {
                                                        "src" : clienteUrl + "/img/badges/jogou2x-180.png", 
                                                        "exibe" : false,
                                                        "ganhar" : "Jogue duas vezes e ganhe.",
                                                        "ganhou" : "Você jogou duas vezes."
                                                    }; 
    
    pins[badgesEnum.JOGOU_5X] =                     {
                                                        "src" : clienteUrl + "/img/badges/jogou5x-180.png", 
                                                        "exibe" : false,
                                                        "ganhar" : "Jogue cinco vezes e ganhe.",
                                                        "ganhou" : "Você jogou cinco vezes."
                                                    };
    
    pins[badgesEnum.JOGOU_10X] =                    {
                                                        "src" : clienteUrl + "/img/badges/jogou10x-180.png", 
                                                        "exibe" : false,
                                                        "ganhar" : "Jogue dez vezes e ganhe.",
                                                        "ganhou" : "Você jogou dez vezes."
                                                    };
    
    pins[badgesEnum.JOGOU_15X] =                    {
                                                        "src" : clienteUrl + "/img/badges/jogou15x-180.png", 
                                                        "exibe" : false,
                                                        "ganhar" : "Jogue quinze vezes e ganhe.",
                                                        "ganhou" : "Você jogou quinze vezes."
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

    // Cria HTML do perfil.
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
            if (pins[i].exibe) {
                html += "<li style='padding: 5px 15px;' class='mr10'><img class='left' src='"+pins[i].src+"' style='width:10%;'/>";
                html +=     "<span style='line-height: 85px; margin-left: 20px'>"+pins[i].ganhou+"</span>";                
            }
            else {
                html += "<li style='padding: 5px 15px;' class='mr10'><img class='left' src='" + pins[i].src + "' style='width:10%; opacity: 0.35'/>";
                html +=     "<span style='line-height: 85px; margin-left: 20px'>"+pins[i].ganhar+"</span>";
            }

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