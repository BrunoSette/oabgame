$(function(){var e={chart:{type:"solidgauge"},title:null,pane:{center:["50%","70%"],size:"100%",startAngle:-90,endAngle:90,background:{backgroundColor:Highcharts.theme&&Highcharts.theme.background2||"#EEE",innerRadius:"60%",outerRadius:"100%",shape:"arc"}},tooltip:{enabled:false},yAxis:{stops:[[.1,"#DF5353"],[.5,"#DDDF0D"],[.9,"#55BF3B"]],lineWidth:0,minorTickInterval:null,tickPixelInterval:400,tickWidth:0,title:{y:20},labels:{y:16}},plotOptions:{solidgauge:{dataLabels:{y:5,borderWidth:0,useHTML:true}}}};$("#container-speed").highcharts(Highcharts.merge(e,{yAxis:{min:0,max:100,title:{text:"Percentual de Acerto"}},credits:{enabled:false},series:[{name:"Percentual de Acerto",data:[80],dataLabels:{format:'<div style="text-align:center"><span style="font-size:25px;color:'+(Highcharts.theme&&Highcharts.theme.contrastTextColor||"black")+'">{y}</span><br/>'+'<span style="font-size:12px;color:silver">%</span></div>'},tooltip:{valueSuffix:" %"}}]}))})