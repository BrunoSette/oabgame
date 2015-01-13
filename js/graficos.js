function grafico_desempenho_materias()
{
	var barChartData = {
		labels : [],
		datasets : [
			{
				fillColor : "rgba(151,187,205,0.5)",
				strokeColor : "rgba(220,220,220,0.8)",
				highlightFill: "rgba(220,220,220,0.75)",
				highlightStroke: "rgba(220,220,220,1)",
				data : []
			}
		]
	}

	$.ajax({
        type: "get",
        url: rootUrl + "/Usuario/materia_grafico",
        dataType: "json",
        success: function(e) 
        {
        	for(i in e.result)
        	{
        		if (parseInt(e.result[i].respostas) != 0 && e.result[i].acertos != 0)
        		{
        			barChartData.labels.push(e.result[i].titulo);
        			barChartData.datasets[0].data.push(Math.ceil(100 * parseInt(e.result[i].acertos)/parseInt(e.result[i].respostas)));
        		}
        	}

        	var ctx = document.getElementById("canvas").getContext("2d");
			window.myLine = new Chart(ctx).Bar(barChartData, {
				responsive: true,
				scaleLabel: "<%=value%>",
			});
        },
        error: function(result){ console.info(result); }
    });
}

function grafico_questoes()
{
	var lineChartData = {
			labels : [],
			datasets : [
				{
					label: "My First dataset",
					fillColor : "rgba(220,220,220,0.2)",
					strokeColor : "rgba(220,220,220,1)",
					pointColor : "rgba(220,220,220,1)",
					pointStrokeColor : "#fff",
					pointHighlightFill : "#fff",
					pointHighlightStroke : "rgba(220,220,220,1)",
					data : []
				}
			]
		}

	$.ajax({
        type: "get",
        url: rootUrl + "/Usuario/questoes_grafico",
        dataType: "json",
        success: function(e) 
        {
        	var d = new Date();
			var n = d.getMonth();

			n = parseInt(n) + 1;

        	for(i in e.result)
        	{
        		if (i != 0)
        		{
    				lineChartData.labels.push(i + "/" + n);
    				lineChartData.datasets[0].data.push(e.result[i]);
    			}
        	}

        	var ctx = document.getElementById("canvas_questoes").getContext("2d");
			window.myLine = new Chart(ctx).Line(lineChartData, {
				responsive: true,
			});
        },
        error: function(result){ console.info(result); }
    });
}

function grafico_taxa_acerto_mes()
{
	var lineChartData = {
			labels : [],
			datasets : [
				{
					label: "My First dataset",
					fillColor : "rgba(151,187,205,0.2)",
					strokeColor : "rgba(151,187,205,1)",
					pointColor : "rgba(151,187,205,1)",
					pointStrokeColor : "#fff",
					pointHighlightFill : "#fff",
					pointHighlightStroke : "rgba(151,187,205,1)",
					data : []
				}
			]
		}

	$.ajax({
        type: "get",
        url: rootUrl + "/Usuario/taxa_acertos_mes",
        dataType: "json",
        success: function(e) 
        {
        	var d = new Date();
			var n = d.getMonth();

			n = parseInt(n) + 1;

        	for(i in e.result)
        	{
        		if (i != 0)
        		{
    				lineChartData.labels.push(i + "/" + n);
    				lineChartData.datasets[0].data.push(e.result[i]);
    			}
        	}

        	var ctx = document.getElementById("canvas_taxa_mes").getContext("2d");
			window.myLine = new Chart(ctx).Line(lineChartData, {
				responsive: true,
			});
        },
        error: function(result){ console.info(result); }
    });
}

$(document).ready(function()
{	
	grafico_desempenho_materias();
	grafico_questoes();
	grafico_taxa_acerto_mes();
});