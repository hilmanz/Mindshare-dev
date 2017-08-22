<?php /* Smarty version 2.6.13, created on 2012-07-27 15:47:16
         compiled from dashboard/seo.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'number_format', 'dashboard/seo.html', 567, false),)), $this); ?>
<script type="text/javascript">
	var page = "project";
	var page_detail = "seo";
	var kpi = <?php echo $this->_tpl_vars['kpi']; ?>
;
	var kpiPerHari = <?php echo $this->_tpl_vars['kpiHari']; ?>
;
	var views = <?php echo $this->_tpl_vars['view']; ?>
;
	var so = <?php echo $this->_tpl_vars['so']; ?>
;
	var channelChart = <?php echo $this->_tpl_vars['channelChart']; ?>
;
	var countries = <?php echo $this->_tpl_vars['countries']; ?>
;
	var gender = <?php echo $this->_tpl_vars['getTopGender']; ?>
;
	var age = <?php echo $this->_tpl_vars['getTopAge']; ?>
;
	<?php echo '
		function subscriberChart(filter){
			_category = [];
			_subscribe = [];
			if (so != null){
				if(filter == \'week\'){
					var weeks = 0;var valWeeks = 0;var mod = 0;var init = 0;
					if (so.length > 6){
						mod = so.length%7;
						if (mod != 0){
							for (var i=init;i<mod;i++){
								var year = (so[i].date).substr(0,4);
								var month = (so[i].date).substr(5,2);
								var tgl = (so[i].date).substr(8,2);
								_category.push(tgl+"/"+month+"/"+year);
								_subscribe.push(parseInt(so[i].subscribe));
								init++;
							}
						}
						for (var i=init;i<so.length;i++){
							valWeeks += parseInt(so[i].subscribe);
							weeks++;
							if (weeks == 7){
								var year = (so[i].date).substr(0,4);
								var month = (so[i].date).substr(5,2);
								var tgl = (so[i].date).substr(8,2);
								_category.push(tgl+"/"+month+"/"+year);
								_subscribe.push(parseInt(so[i].subscribe));
								weeks = 0;
								valWeeks = 0;
							}		
						}
						
					}else{
						for (var i=0;i<so.length;i++){
							var year = (so[i].date).substr(0,4);
							var month = (so[i].date).substr(5,2);
							var tgl = (so[i].date).substr(8,2);
							_category.push(tgl+"/"+month+"/"+year);
							_subscribe.push(parseInt(so[i].subscribe));
						}
					}
				}else if(filter == \'month\'){
					var moonVal = 0;
					var batas = so.length - 1;
					var dataL = so.length;
					var	moon = Math.abs((so[0].date).substr(5,2));
					for (var i=0;i<dataL;i++){
						var monthz = (so[i].date).substr(5,2);					
						if (Math.abs(monthz) != moon){
							if (Math.abs(monthz) < moon){
								_category.push(tgl+"/"+month+"/"+year);
								_subscribe.push(moonVal);
								moonVal = 0;
								moon = 1;
							}else{
								_category.push(tgl+"/"+month+"/"+year);
								_subscribe.push(moonVal);
								moonVal = 0;
								moon += 1;
							}
						}
						var year = (so[i].date).substr(0,4);
						var month = (so[i].date).substr(5,2);
						var tgl = (so[i].date).substr(8,2);
						moonVal +=  parseInt(so[i].subscribe);
						if(batas == i){
							_category.push(tgl+"/"+month+"/"+year);
							_subscribe.push(moonVal);
							moonVal = 0;
						}
					}
				}else{
					for (var i=0;i<so.length;i++){
						var year = (so[i].date).substr(0,4);
						var month = (so[i].date).substr(5,2);
						var tgl = (so[i].date).substr(8,2);
						_category.push(tgl+"/"+month+"/"+year);
						_subscribe.push(parseInt(so[i].subscribe));
					}
				}
			}
			chart = new Highcharts.Chart({
				chart: {
					renderTo: \'subscribe\',
					type: \'line\',
					marginTop: 30,
					marginLeft: 55,
					marginBottom: 40,
					marginRight: 25
				},
				title: false,
				subtitle: false,
				xAxis: {
					categories: _category,
					labels: {
					formatter: function() {
						return (so.length > 12 ? \'\' : this.value);
					}
				}
				},
				yAxis: {
					title:false,
					plotLines: [{
						value: 0,
						width: 1,
						color: \'#808080\'
					}]
				},
				tooltip: {
					formatter: function() {
							return \'<b>\'+ this.series.name +\'</b><br/>\'+
							this.x +\': \'+ Highcharts.numberFormat(this.y,0);
					}
				},
				legend: false,
				credits: false,
				series: [{
					name: \'YouTube\',
					color: \'#a864a8\',
					data: _subscribe
				}]
			});
		}
		function viewsChart(filter){
			_category = [];
			_views = [];
			_kpi= [];
			
			if (views != null){
				if(filter == \'week\'){
					var weeks = 0;var valWeeks = 0;var mod = 0;var init = 0;
					if (views.length > 6){
						mod = views.length%7;
						if (mod != 0){
							for (var i=init;i<mod;i++){
								var year = (views[i].date).substr(0,4);
								var month = (views[i].date).substr(5,2);
								var tgl = (views[i].date).substr(8,2);
								_category.push(tgl+"/"+month+"/"+year);
								_views.push(parseInt(views[i].views));
								_kpi.push(0);
								init++;
							}
						}
						for (var i=init;i<views.length;i++){
							valWeeks += parseInt(views[i].views);
							weeks++;
							if (weeks == 7){
								var year = (views[i].date).substr(0,4);
								var month = (views[i].date).substr(5,2);
								var tgl = (views[i].date).substr(8,2);
								_category.push(tgl+"/"+month+"/"+year);
								_views.push(valWeeks);
								_kpi.push(kpiPerHari*7);
								weeks = 0;
								valWeeks = 0;
							}		
						}
						
					}else{
						for (var i=0;i<views.length;i++){
							var year = (views[i].date).substr(0,4);
							var month = (views[i].date).substr(5,2);
							var tgl = (views[i].date).substr(8,2);
							_category.push(tgl+"/"+month+"/"+year);
							_views.push(parseInt(views[i].views));
							_kpi.push(kpiPerHari);
						}
					}
				}else if(filter == \'month\'){
					var moonVal = 0;
					var batas = views.length - 1;
					var dataL = views.length;
					var	moon = Math.abs((views[0].date).substr(5,2));
					for (var i=0;i<dataL;i++){
						var monthz = (views[i].date).substr(5,2);					
						if (Math.abs(monthz) != moon){
							if (Math.abs(monthz) < moon){
								_category.push(tgl+"/"+month+"/"+year);
								_views.push(parseInt(moonVal));
								_kpi.push(kpiPerHari*30);
								moonVal = 0;
								moon = 1;
							}else{
								_category.push(tgl+"/"+month+"/"+year);
								_views.push(parseInt(moonVal));
								_kpi.push(kpiPerHari*30);
								moonVal = 0;
								moon += 1;
							}
							
						}
						var year = (views[i].date).substr(0,4);
						var month = (views[i].date).substr(5,2);
						var tgl = (views[i].date).substr(8,2);
						moonVal +=  parseInt(views[i].views);
						if(batas == i){
							_category.push(tgl+"/"+month+"/"+year);
							_views.push(parseInt(moonVal));
							_kpi.push(kpiPerHari*30);
							moonVal = 0;
						}
					}
				}else{
					for (var i=0;i<views.length;i++){
							var year = (views[i].date).substr(0,4);
							var month = (views[i].date).substr(5,2);
							var tgl = (views[i].date).substr(8,2);
							_category.push(tgl+"/"+month+"/"+year);
							_views.push(parseInt(views[i].views));
							_kpi.push(kpiPerHari);
						}
				}
				
			}
			
			chart = new Highcharts.Chart({
				chart: {
					renderTo: \'views\',
					zoomType: \'xy\',
					marginTop: 30,
					marginLeft: 55,
					marginBottom: 40,
					marginRight: 25
				},
				title: false,
				subtitle: false,
				xAxis: {
					categories: _category,
					labels: {
					formatter: function() {
						return (views.length > 12 ? \'\' : this.value);
					}
				}
				},
				yAxis: {
					title:false,
					plotLines: [{
						value: 0,
						width: 1,
						color: \'#808080\'
					}]
				},
				tooltip: {
					formatter: function() {
							return \'<b>\'+ this.series.name +\'</b><br/>\'+
							this.x +\': \'+ this.y;
					}
				},
				legend: false,
				credits: false,
				series: [{
					type: \'column\',
					name: \'KPI\',
					color: \'#f26522\',
					data: _kpi
				}, {
					type: \'spline\',
					name: \'Views\',
					color: \'#75f222\',
					data: _views
				}]
			});
		}
	
		var chart;
		$(document).ready(function() {
			
			// VIEWS CHART
			filter = \'day\';
			viewsChart(filter);
			$(".vday").addClass("vactive");
			$(".vmonth").click(function(){
				filter = \'month\';
				viewsChart(filter);
				$("a.vweek,a.vday").removeClass("vactive");
				$(this).addClass("vactive");
			});
			$(".vweek").click(function(){
				filter = \'week\';
				viewsChart(filter);
				$("a.vday,a.vmonth").removeClass("vactive");
				$(this).addClass("vactive");
			});
			$(".vday").click(function(){
				filter = \'day\';
				viewsChart(filter);
				$("a.vweek, a.vmonth").removeClass("vactive");
				$(this).addClass("vactive");
			});
			
			//TOP COUNTRIES
			_countries = [];
			if (countries != null){
				for (var i=0;i<countries.length;i++){
					_countries.push(countries[i]);
				}
			}
			chart = new Highcharts.Chart({
				chart: {
					renderTo: \'topCountries\',
					zoomType: \'xy\',
					marginTop: 30,
					marginLeft: 55,
					marginBottom: 40,
					marginRight: 25
				},
				title: false,
				tooltip: {
					formatter: function() {
						return \'<b>\'+ this.point.name +\'</b>: \'+ this.y +\' views\';
					}
				},
				plotOptions: {
					pie: {
						allowPointSelect: true,
						cursor: \'pointer\',
						dataLabels: {
							enabled: true,
							color: \'#333333\',
							connectorColor: \'#666666\',
							formatter: function() {
								return \'<b>\'+ this.point.name +\'</b>:<br> \'+ Highcharts.numberFormat(this.percentage,2) +\' %\';
							}
						}
					}
				},
				credits: false,
				series: [{
					type: \'pie\',
					name: \'Top Countries\',
					data: _countries
				}]
			});
			
			//Channel Chart
			_channelChart = [];
			if (channelChart != null){
				for (var i=0;i<channelChart.length;i++){
					_channelChart.push(channelChart[i]);
				}
			}
			chart = new Highcharts.Chart({
				chart: {
					renderTo: \'channelChart\',
					zoomType: \'xy\',
					marginTop: 30,
					marginLeft: 55,
					marginBottom: 40,
					marginRight: 25
				},
				title: false,
				tooltip: {
					formatter: function() {
						return \'<b>\'+ this.point.name +\'</b>: \'+ this.y +\' views\';
					}
				},
				plotOptions: {
					pie: {
						allowPointSelect: true,
						cursor: \'pointer\',
						dataLabels: {
							enabled: true,
							color: \'#333333\',
							connectorColor: \'#666666\',
							formatter: function() {
								return \'<b>\'+ this.point.name +\'</b>:<br> \'+ Highcharts.numberFormat(this.percentage,2) +\' %\';
							}
						}
					}
				},
				credits: false,
				series: [{
					type: \'pie\',
					name: \'Top Countries\',
					data: _channelChart
				}]
			});
			
			//Gender
			_genderChart = [];
			if (gender != null){
				for (var i=0;i<gender.length;i++){
					_genderChart.push(gender[i]);
				}
			}
			chart = new Highcharts.Chart({
				chart: {
					renderTo: \'gender\',
					zoomType: \'xy\',
					marginTop: 30,
					marginLeft: 55,
					marginBottom: 40,
					marginRight: 25
				},
				title: false,
				tooltip: {
					formatter: function() {
						return \'<b>\'+ this.point.name +\'</b>: \'+ Highcharts.numberFormat(this.percentage,2) +\' %\';
					}
				},
				plotOptions: {
					pie: {
						allowPointSelect: true,
						cursor: \'pointer\',
						dataLabels: {
							enabled: true,
							color: \'#333333\',
							connectorColor: \'#666666\',
							formatter: function() {
								return \'<b>\'+ this.point.name +\'</b>:<br> \'+ Highcharts.numberFormat(this.percentage,2) +\' %\';
							}
						}
					}
				},
				credits: false,
				series: [{
					type: \'pie\',
					name: \'Top Countries\',
					data: _genderChart
				}]
			});
			
			//Age
			_ageChart = [];
			if (age != null){
				for (var i=0;i<age.length;i++){
					_ageChart.push(age[i]);
				}
			}
			chart = new Highcharts.Chart({
				chart: {
					renderTo: \'age\',
					zoomType: \'xy\',
					marginTop: 30,
					marginLeft: 55,
					marginBottom: 40,
					marginRight: 25
				},
				title: false,
				tooltip: {
					formatter: function() {
						return \'<b>Age \'+ this.point.name +\'</b>: \'+ Highcharts.numberFormat(this.percentage,2) +\' %\';
					}
				},
				plotOptions: {
					pie: {
						allowPointSelect: true,
						cursor: \'pointer\',
						dataLabels: {
							enabled: true,
							color: \'#333333\',
							connectorColor: \'#666666\',
							formatter: function() {
								return \'<b>Age \'+ this.point.name +\'</b>:<br> \'+ Highcharts.numberFormat(this.percentage,2) +\' %\';
							}
						}
					}
				},
				credits: false,
				series: [{
					type: \'pie\',
					name: \'Top Age\',
					data: _ageChart
				}]
			});
			
			//SUBSCRIBE OVERTIME
			filter2 = \'day\'
			subscriberChart(filter2);
			$(".sday").addClass("sactive");
			$(".smonth").click(function(){
				filter2 = \'month\';
				subscriberChart(filter2);
				$("a.sweek,a.sday").removeClass("sactive");
				$(this).addClass("sactive");
			});
			$(".sweek").click(function(){
				filter2 = \'week\';
				subscriberChart(filter2);
				$("a.sday,a.smonth").removeClass("sactive");
				$(this).addClass("sactive");
			});
			$(".sday").click(function(){
				filter2 = \'day\';
				subscriberChart(filter2);
				$("a.sweek,a.smonth").removeClass("sactive");
				$(this).addClass("sactive");
			});
			
			'; ?>

				//initial Date
				var startD = "<?php echo $this->_tpl_vars['startD']; ?>
";
				var endD = "<?php echo $this->_tpl_vars['endD']; ?>
";
				var min7 = new Date("<?php echo $this->_tpl_vars['min7']; ?>
");
				var startDate = new Date("<?php echo $this->_tpl_vars['startDate']; ?>
");
				var currDate = new Date("<?php echo $this->_tpl_vars['currDate']; ?>
");
			<?php echo '
				function mdy(x){
					return (x.getMonth()+1)+"/"+x.getDate()+"/"+x.getFullYear();
				}
				if( startD == "//" && endD == "//"){
					$("#from").val(mdy(min7));
					$("#to").val(mdy(currDate));
				}else if(startD == "//" && endD != "//"){
					$("#from").val(mdy(startDate));
					$("#to").val(endD);
				}else if(startD != "//" && endD == "//"){
					$("#from").val(startD);
					$("#to").val(mdy(currDate));
				}else{
					$("#from").val(startD);
					$("#to").val(endD);
				}
				$("#from, #to").datepicker();
				$("#from, #to").datepicker("option", "dateFormat", "dd/mm/yy" );
		});
	'; ?>

</script>
<div id="body-tab">
	<?php if ($this->_tpl_vars['tabSEO'] == 1): ?><a href="#" class="body-tab inblock bTabActive">SEO</a><?php endif; ?>
	<?php if ($this->_tpl_vars['tabSEM'] == 1): ?><a href="#" class="body-tab inblock bTabActive">SEM</a><?php endif; ?>
	<?php if ($this->_tpl_vars['tabSOCIAL'] == 1): ?><a href="#" class="body-tab inblock bTabActive">SOCIAL</a><?php endif; ?>
</div>
<div class="body-content">
	<div class="body-content-head relative">
		<img src="images/castrol-logo.png" class="absolute" width="152" style="border:none;top:-15px;left:0;" />
		<div class="absolute" style="right: 235px; top: 0px;">
				<div id="seoDate" class="dropdown2 flRight fgrey arial relative">		
					<form action="index.php?s=seo&id=<?php echo $this->_tpl_vars['id']; ?>
" method="post">
						<span class="absolute" style="left: -60px;top: 10px;">Duration:</span>
						<input type="text" id="from" name="from" class="absolute">		
						<input type="text" id="to" name="to" class="absolute" style="left:111px">
						<input type="hidden" id="rangeDate" name="rangeDate" class="fLeft" value="1">
						<input id="semDuration" type="submit" class="absolute" value="">
					</form>
				</div>
			</div>
		<div id="seoDropdown" class="dropdown flRight fgrey2 arial relative" no="1">
			<span>SUMMARY REPORT</span>
			<div id="seoList" class="droplist1 dropdown-bg absolute transparent hide" style="top:6px;left:5px;">
				<a class="dropdown-item" href="index.php?s=seo&id=<?php echo $this->_tpl_vars['projectID']; ?>
">SUMMARY REPORT</a>
				<hr>
				<a class="dropdown-item" href="index.php?s=seo&id=<?php echo $this->_tpl_vars['projectID']; ?>
&act=detail">DETAIL REPORT</a>
			</div>
		</div>
	</div>
	<div class="body-box-summary">
		<div class="summary-box-med marginR flLeft" style="margin-top:0;">
			<span class="arial" style="font-size:12px">Total KPI Achievement</span><br>
			<span  style="font-size:28px"><?php echo $this->_tpl_vars['kpiTotal']; ?>
%</span>
		</div>
		<div class="summary-box-med flLeft" style="margin-top:0;">
			<span class="arial" style="font-size:12px">Hits From Organic Search</span><br>
			<span  style="font-size:28px"><?php echo ((is_array($_tmp=$this->_tpl_vars['totalHits']['totalHits'])) ? $this->_run_mod_handler('number_format', true, $_tmp) : number_format($_tmp)); ?>
</span>
		</div>
		<div class="summary-box-med marginR flLeft">
			<span class="arial" style="font-size:12px">Top Channel</span><br>
			<span  style="font-size:28px"></span>
			<span  style="font-size:20px"><?php echo $this->_tpl_vars['top_channel']['playback_location']; ?>
 (<?php echo $this->_tpl_vars['top_channel']['persen']; ?>
%)</span>
		</div>
		<div class="summary-box-med flLeft">
			<span class="arial" style="font-size:12px">Top Country</span><br>
			<span  style="font-size:28px"><?php echo $this->_tpl_vars['topCountry']['country']; ?>
 </span>
			<span class="fgrey2" style="font-size:28px">: <?php echo ((is_array($_tmp=$this->_tpl_vars['topCountry']['views'])) ? $this->_run_mod_handler('number_format', true, $_tmp) : number_format($_tmp)); ?>
</span>
		</div>
	</div>
	<span class="relative" style="font-size:14px;margin-left:2px;width: 300px;display: block;">
		VIEWS
		<div class="absolute" style="top:0;right: -659px;">
			<span class="legend-green arial">Actual</span>
			<span class="legend-orange arial">KPI</span>
		</div>
		<div class="absolute" style="top:0;right: -500px;">
			<a class="vday arial">Day</a>
			<a class="vweek arial">Week</a>
			<a class="vmonth arial">Month</a>	
		</div>
	</span>
	<div id="views" style="height: 292px;margin: 15px 0;"></div>
	<div style="height: 400px;">
		<span class="relative" style="font-size:14px;margin-left:2px;width: 300px;display: block;margin-bottom:15px;">
			TOP COUNTRIES
		</span>
		<div id="topCountries" class="flLeft" style="width: 470px; height: 370px;margin: 0 0 20px 0;"></div>
		<span class="relative flRight" style="font-size:14px;margin-left:2px;margin-top: -33px;width: 468px;display: block;margin-bottom:15px;">
			TOP CHANNEL
		</span>
		<div id="channelChart" class="flRight" style="width: 470px; height: 370px;margin: 0 0 20px 0;"></div>
	</div>
	<div style="height: 430px;">
		<span class="relative" style="font-size:14px;margin-left:2px;width: 300px;display: block;margin-bottom:15px;">
			GENDER
		</span>
		<div id="gender" class="flLeft" style="width: 470px; height: 370px;margin: 0 0 20px 0;"></div>		
		<span class="relative flRight" style="font-size:14px;margin-left:2px;margin-top: -33px;width: 468px;display: block;margin-bottom:15px;">
			AGE
		</span>
		<div id="age" class="flRight" style="width: 470px; height: 370px;margin: 0 0 20px 0;"></div>
	</div>
	<span class="relative" style="font-size:14px;margin-left:2px;width: 300px;display: block;">
		SUBSCRIBERS OVERTIME
		<div class="absolute" style="top:20px;right: -659px;">
			<span class="legend-ungu arial">YouTube</span>
		</div>
		<div class="absolute" style="right: -530px;top: 15px;">
			<a class="sday arial">Day</a>
			<a class="sweek arial">Week</a>
			<a class="smonth arial">Month</a>	
		</div>
	</span>
	<div id="subscribe" style="height: 292px;margin: 15px 0 0 0;"></div>
</div>