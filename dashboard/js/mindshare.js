//=============
// JS mindshare
// @cendekiApp
//=============


//==JS Trigger, HighChart, Wordcloud - not a function==//
var lineChartList;
var stackAreaChartList;
var stackColumnChartList;
var pieChartList;
$(document).ready(function() {
	//DropDown
	$(".dropdown").click(function(){
		var no = $(this).attr('no');
		effect(no);
	});
	
	//WordCloud
	if(!$('#myCanvas').tagcanvas({
		interval : 20,
		textColour : null,
		textHeight : 25,
		outlineColour : '#ccc',
		outlineThickness : 5,
		maxSpeed : 0.04,
		minBrightness : 0.1,
		depth : 0.92,
		pulsateTo : 0.2,
		pulsateTime : 0.75,
		initial : [0.1,-0.1],
		decel : 0.98,
		reverse : true,
		hideTags : true,
		shadow : '#ccf',
		shadowBlur : 3,
		weight : true,
		weightFrom : 'data-weight' 
	},'tags')) {
	  // something went wrong, hide the canvas container
	  $('#myCanvas, #tags').hide();
	}
	
});


//==JS Function==//

//PIE CHART
function pieChart(divID, category, data){
	var chart;
	var _color = ['#008000','#FF0000','#808080'];
	chart = new Highcharts.Chart({
		chart: {
			renderTo: divID,
			plotBackgroundColor: null,
			plotBorderWidth: null,
			plotShadow: false
		},
		title: false,
		tooltip: {
			formatter: function() {
				return '<b>'+ this.point.name +'</b>: '+ this.y;
			}
		},
		credits: false,
		plotOptions: {
			pie: {
				allowPointSelect: true,
				cursor: 'pointer',
				showInLegend: true,
				size: 180,
				dataLabels: {
					enabled: true,
					color: (Highcharts.theme && Highcharts.theme.textColor),
					connectorColor: (Highcharts.theme && Highcharts.theme.textColor),
					formatter: function() {
						return Highcharts.numberFormat(this.percentage,2) +' %';
					}
				}
			}
		},
		series: [{
			type: 'pie',
			name: 'pie chart',
			data: data
		}]
	});
}

//STACKED COLUMN
function stackColumnChart(divID, category, data){
	var chart;
	chart = new Highcharts.Chart({
		chart: {
			renderTo: divID,
			type: 'column',
			zoomType: 'y',
			marginTop: 50,
			marginBottom: 25
		},
		title: false,
		xAxis: {
			categories: category
		},
		yAxis: {
			min: 0,
			title: false,
			stackLabels: {
				enabled: true,
				style: {
					fontWeight: 'bold',
					color: (Highcharts.theme && Highcharts.theme.textColor) || 'gray'
				}
			}
		},
		credits: false,
		legend: {
			align: 'right',
			verticalAlign: 'top',
			floating: true,
			x: -10,
			y: 0,
			borderWidth: 0,
			labelFormatter: function() {
				return '<span style="color: '+this.color+';">'+ this.name + '</span>';
			}
		},
		tooltip: {
			formatter: function() {
				return '<b>'+ this.x +'</b><br/>'+
					this.series.name +': '+ this.y +'<br/>'+
					'Total: '+ this.point.stackTotal;
			}
		},
		plotOptions: {
			column: {
				stacking: 'normal',
				dataLabels: {
					enabled: true,
					color: (Highcharts.theme && Highcharts.theme.dataLabelsColor) || 'white'
				}
			}
		},
		series: data
	});
}

//STACKED AREA CHART
function stackAreaChart(divID, category, data){
		var chart;
		//var _color = ['#008000','#FF0000','#808080'];
		chart = new Highcharts.Chart({
			chart: {
				renderTo: divID,
				type: 'area',
				zoomType: 'x',
				marginTop: 50,
				marginBottom: 25
			},
			title: false,
			subtitle: false,
			xAxis: {
				categories: category,
				tickmarkPlacement: 'on',
				title: {
					enabled: false
				}
			},
			yAxis: {
				title: false,
				labels: {
					formatter: function() {
						return this.value;
					}
				}
			},
			tooltip: {
				formatter: function() {
					return ''+
						this.x +': '+ Highcharts.numberFormat(this.y, 0, ',');
				}
			},
			plotOptions: {
				area: {
					stacking: 'normal',
					lineColor: '#666666',
					lineWidth: 1,
					marker: {
						lineWidth: 1,
						lineColor: '#666666'
					}
				}
			},
			credits: false,
			legend: {
				align: 'right',
				verticalAlign: 'top',
				floating: true,
				x: -10,
				y: 0,
				borderWidth: 0,
				labelFormatter: function() {
					return '<span style="color: '+this.color+';">'+ this.name + '</span>';
				}
			},
			series: data
		});
}	
function lineChart(divID, category, data){
	var chart;	
	chart = new Highcharts.Chart({
		chart: {
			renderTo: divID,
			type: 'line',
			marginTop: 50,
			marginBottom: 25
		},
		title: false,
		subtitle: false,
		xAxis: {
			categories: category
		},
		yAxis: {
			title: false,
			plotLines: [{
				value: 0,
				width: 1,
				color: '#808080'
			}]
		},
		tooltip: {
			formatter: function() {
					return '<b>'+ this.series.name +'</b><br/>'+
					this.x +': '+ this.y;
			}
		},
		credits: false,
		legend: {
			align: 'right',
			verticalAlign: 'top',
			floating: true,
			x: -10,
			y: 0,
			borderWidth: 0,
			labelFormatter: function() {
				return '<span style="color: '+this.color+';">'+ this.name + '</span>';
			}
		},
		series: data
	});
}	
// Highchart THEME - White
Highcharts.theme = {
	   colors: ['#006699', '#336699', '#3399cc', '#66cccc'],
	   chart: {
		  backgroundColor: {
			 linearGradient: [0, 0, 0, 500],
			 stops: [
				[0, 'rgb(255, 255, 255)'],
				[1, 'rgb(204, 204, 204)']
			 ]
		  },
		  borderColor: '#999999',
		  borderWidth: 1,
		  plotShadow: true
	   },
		title: {
			x: -230,
			style: {
                color: '#666666',
				fontSize: 14
            }
		},
	   legend: {
		  itemStyle: {
			 font: '9pt Arial',
			 color: 'black'

		  },
		  itemHoverStyle: {
			 color: '#039'
		  },
		  itemHiddenStyle: {
			 color: 'gray'
		  }
	   },
	   labels: {
		  style: {
			 color: '#99b'
		  }
	   }
	};
	
	var highchartsOptions = Highcharts.setOptions(Highcharts.theme);


//number format
function addCommas(str) {
    var amount = new String(str);
    amount = amount.split("").reverse();

    var output = "";
    for ( var i = 0; i <= amount.length-1; i++ ){
        output = amount[i] + output;
        if ((i+1) % 3 == 0 && (amount.length-1) !== i)output = ',' + output;
    }
    return output;
}

function smac_number(str){
	var n = parseFloat(str);
	var s = "";
	if(n>1000000){
		s = Math.round(n/1000000)+"M";
	}else if(n>1000){
		s = Math.round(n/1000)+"K";
	}else{
		s = n;
	}
	return s;
}

function roundNumber(num, dec) {
	var result = Math.round(num*Math.pow(10,dec))/Math.pow(10,dec);
	return result;
}

// date format
function two(x) {return ((x>9)?"":"0")+x;}
function three(x) {return ((x>99)?"":"0")+((x>9)?"":"0")+x;}

function time(ms) {
	var sec = Math.floor(ms/1000);
	ms = ms % 1000;
	t = three(ms);
	
	var min = Math.floor(sec/60);
	sec = sec % 60;
	//t = two(sec) + ":" + t;
	//without ms
	t = two(sec);
	
	var hr = Math.floor(min/60);
	min = min % 60;
	t = two(min) + ":" + t;
	
	var day = Math.floor(hr/60);
	hr = hr % 60;
	t = two(hr) + ":" + t;
	if (day > 0){
		if (day == 1){
			t = day + " day - " + t;
		}else{
			t = day + " days - " + t;
		}
	}
	
	return t;
}
function timeSecond(sec) {
	//var sec = Math.floor(ms/1000);
	//ms = ms % 1000;
	//t = three(ms);
	
	var min = Math.floor(sec/60);
	sec = sec % 60;
	//t = two(sec) + ":" + t;
	//without ms
	t = two(sec);
	
	var hr = Math.floor(min/60);
	min = min % 60;
	t = two(min) + ":" + t;
	
	var day = Math.floor(hr/60);
	hr = hr % 60;
	t = two(hr) + ":" + t;
	if (day > 0){
		if (day == 1){
			t = day + " day - " + t;
		}else{
			t = day + " days - " + t;
		}
	}
	
	return t;
}

//Drop down js
function effect(no){
	$(".droplist"+no).toggle("blind",300);
}

//Popup profile function
var cID;
var twitID;
function popupProfile(cID, twitID){
	$('#fade').fadeIn();
	$('#profile').fadeIn();
	$.ajax({
	  url: "index.php?s=social&id=9&twitID="+twitID+"",
	  dataType: 'json',
	  beforeSend:function(){
		$("#profile #popupbody").hide();
		$("#profile #twitID").hide();
		$("#profile #popupload").show();
		},
	  success: function( data ) {
		if(data){
			$("#profile #popupload").hide();
			$("#profile #twitID").fadeIn();
			$("#profile #popupbody").fadeIn();
			
			$("#profile .headpopup h1").text("@"+data.author_id+" - "+data.author_name);
			$("#profile .content-popup .smallthumb img").attr('src', data.author_avatar);
			$("#profile .content-popup .statistik-profile .icon1").html(addCommas(data.followers));
			$("#profile .content-popup .statistik-profile .icon2").html(addCommas(data.total_mentions));
			$("#profile .content-popup .statistik-profile .icon3").html(addCommas(data.impression));
			$("#profile .content-popup .statistik-profile .icon4").html(addCommas(data.rt_mention));
			$("#profile .content-popup .statistik-profile .icon5").html(addCommas(data.rt_impression));
			$("#profile .content-popup .statistik-profile .icon6").html(data.percentage+'%');
			$("#profile .content-popup .impact-score h1").text(data.rank);
			$("#authorlocation").html(data.location);
			$("#authorabout").html(data.details);
		}else{
			
		}
	  }
	});
}
function closePopup(){
	$('#fade').fadeOut();
	$('#profile').fadeOut();
}