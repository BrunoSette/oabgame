function badgesUser(badges)
{

}

function userProfile()
{

}

$(document).ready(function()
{
	$.ajax({
        type: "get",
        url: rootUrl + "/Usuario/questao",
        dataType: "json",
        success: function(result) 
        {
         	badgesUser(result.result);
        },
        error: function(result){console.info(result);}
    });
});