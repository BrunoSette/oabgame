function atualizaPerfil()
{
	$.ajax({
            type: "get",
            url: rootUrl + "/Usuario/profile",
            dataType: "json",
            success: function(e)
            {	
            	var imgHtml;

                $(".tooltip  .txt-profile .nivel").text("Nível " + e.result.nivel);
               
                if (e.result.genero == "female")
                {
                	if(e.result.nivel == 1)
				        imgHtml = "<img src='img/profile_nivel/mulher/nivel-1.png' alt=''/>";
                	else if(e.result.nivel == 2)
				        imgHtml = "<img src='img/profile_nivel/mulher/nivel-2.png' alt=''/>";
				    else if(e.result.nivel == 3)
				        imgHtml = "<img src='img/profile_nivel/mulher/nivel-3.png' alt=''/>";
				    else if(e.result.nivel == 4)
				        imgHtml = "<img src='img/profile_nivel/mulher/nivel-4.png' alt=''/>";
				    else if(e.result.nivel == 5)
				        imgHtml = "<img src='img/profile_nivel/mulher/nivel-5.png' alt=''/";
				    else if(e.result.nivel == 6)
				        imgHtml = "<img src='img/profile_nivel/mulher/nivel-6.png' alt=''/>";
				    else if(e.result.nivel == 7)
				        imgHtml = "<img src='img/profile_nivel/mulher/nivel-7.png' alt=''/>";
				    else if(e.result.nivel == 8)
				        imgHtml = "<img src='img/profile_nivel/mulher/nivel-8.png' alt=''/>";
                }
                else
                {
                	if(e.result.nivel == 1)
				        imgHtml = "<img src='img/profile_nivel/homem/nivel-1.png' alt=''/>";
                	else if(e.result.nivel == 2)
				        imgHtml = "<img src='img/profile_nivel/homem/nivel-2.png' alt=''/>";
				    else if(e.result.nivel == 3)
				        imgHtml = "<img src='img/profile_nivel/homem/nivel-3.png' alt=''/>";
				    else if(e.result.nivel == 4)
				        imgHtml = "<img src='img/profile_nivel/homem/nivel-4.png' alt=''/>";
				    else if(e.result.nivel == 5)
				        imgHtml = "<img src='img/profile_nivel/homem/nivel-5.png' alt=''/";
				    else if(e.result.nivel == 6)
				        imgHtml = "<img src='img/profile_nivel/homem/nivel-6.png' alt=''/>";
				    else if(e.result.nivel == 7)
				        imgHtml = "<img src='img/profile_nivel/homem/nivel-7.png' alt=''/>";
				    else if(e.result.nivel == 8)
				        imgHtml = "<img src='img/profile_nivel/homem/nivel-8.png' alt=''/>";
                }

                $(".tooltip  .image-profile").html(imgHtml);
            },
            error: function(result){ console.info(result); }
         });
}

$(document).ready(function()
{
	verificaPontuacao();

	atualizaPerfil();
});