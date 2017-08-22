<?php
/** MODEL DATA 
 ** @Babar
 ** @cendekiApp
 **/
class SEOModel extends SQLData{
	function __construct($req){
		parent::SQLData();
		$this->Request = $req;
		$this->View = new BasicView();
		$this->User = new UserManager();
	}
	
	function getKPI($id){
		$this->open(0);
		$q=	"SELECT * FROM tbl_project 
			WHERE id='".$id."'";
		$r = $this->fetch($q);
		$this->close();
		//$data = json_encode($r);
		return $r;
	}
	
	function getLastUpdate($id){
		$this->open(0);
		$q=	"SELECT DATE_FORMAT(c.date,'%d %M %Y') AS lastUpdate, c.date AS end_date
			FROM channel_views c 
			LEFT JOIN tbl_project k
			ON c.channel_name = k.channel_id
			WHERE k.id = '".$id."'
			ORDER BY c.date 
			DESC LIMIT 1	
			";
		$r = $this->fetch($q);
		$s=	"SELECT DATE_FORMAT(c.date,'%d %M %Y') AS seven_date
			FROM channel_views c 
			LEFT JOIN tbl_project k
			ON c.channel_name = k.channel_id
			WHERE k.id = '".$id."'
			AND c.date = DATE_SUB('".$r['end_date']."', INTERVAL 6 DAY)
			ORDER BY c.date 
			DESC LIMIT 1	
			";
		$this->close;
		$t = $this->fetch($s);
		$r["min7"] = $t["seven_date"];
		// var_dump($r);exit;
		return $r;
	}
	
	function getTotalKPI($id, $start, $end, $last){
		//Check Date Range
		if($start != '--' && $end == '--'){
			$end = $last;
		}
		if ($start == '--' && $end == '--'){
			$q= "SELECT SUM(c.views) tot_view 
				FROM channel_views c
				LEFT JOIN tbl_project k
				ON c.channel_name = k.channel_id
				WHERE k.id = '".$id."'
				AND c.date >= DATE_SUB('".$last."', INTERVAL 6 DAY)
				AND c.date <='".$last."'
				ORDER BY c.date 
				DESC LIMIT 1";
		}else{
			$q= "SELECT SUM(c.views) tot_view 
				FROM channel_views c
				LEFT JOIN tbl_project k
				ON c.channel_name = k.channel_id
				WHERE k.id = '".$id."'
				AND c.date >= '".$start."'
				AND c.date <= '".$end."'
				ORDER BY c.date 
				DESC LIMIT 1";
		}
		$kpi = $this->getKPI($id);
		$this->open(0);
		$totalview = $this->fetch($q);
		$this->close();
		$totalkpi = $kpi['kpi']*6;
		$total = $totalview['tot_view']/$totalkpi;
		$total = $total*100;
		// var_dump($last);
		return $total;
	}
	
	function getTotalView($id, $start, $end, $last){
		//Check Date Range
		if($start != '--' && $end == '--'){
			$end = $last;
		}
		if ($start == '--' && $end == '--'){
			$q= "SELECT SUM(c.views) totalHits 
				FROM channel_views c
				LEFT JOIN tbl_project k
				ON c.channel_name = k.channel_id
				WHERE k.id = '".$id."'
				AND c.date >= DATE_SUB('".$last."', INTERVAL 6 DAY)
				AND c.date <='".$last."'
				ORDER BY c.date 
				DESC LIMIT 1";
		}else{
			$q= "SELECT SUM(c.views) totalHits 
				FROM channel_views c
				LEFT JOIN tbl_project k
				ON c.channel_name = k.channel_id
				WHERE k.id = '".$id."'
				AND c.date >= '".$start."'
				AND c.date <= '".$end."'
				ORDER BY c.date 
				DESC LIMIT 1";
		}
		$this->open(0);
		$data = $this->fetch($q);
		$this->close();
		return $data;
	}
	
	function getTopChannel($id="CastrolAsiaPacific", $start, $end, $last){
		$this->open(0);
		//Check Date Range
		if($start != '--' && $end == '--'){
			$end = $last;
		}
		if ($start == '--' && $end == '--'){
			$q=	"SELECT c.player_location AS playback_location,SUM(c.views) AS views 
				FROM  geography_raw c
				WHERE c.date >= DATE_SUB('".$last."', INTERVAL 6 DAY)
				AND c.date <='".$last."'
				GROUP BY c.player_location 
				ORDER BY views 
				DESC";
		}else{
			$q=	"SELECT c.player_location AS playback_location,SUM(c.views) AS views 
				FROM  geography_raw c 
				WHERE c.date >= '".$start."'
				AND c.date <= '".$end."'
				GROUP BY c.player_location 
				ORDER BY views 
				DESC";
		}
		$r = $this->fetch($q);
		$rTotal = $this->fetch($q,1);
		$this->close();
		foreach ($rTotal as $asd){
			$total += $asd[views];
		}
		$r['persen'] = ($r['views']/$total)*100;
		// var_dump($r);
		return $r;
	}
	
	function getTopCountry($id="CastrolAsiaPacific", $start, $end, $last){
		//Check Date Range
		if($start != '--' && $end == '--'){
			$end = $last;
		}
		if ($start == '--' && $end == '--'){
			$q= "SELECT region,SUM(views) AS views 
				FROM video_raw c
				WHERE date >= DATE_SUB('".$last."', INTERVAL 6 DAY)
				AND date <='".$last."'
				GROUP BY region 
				ORDER BY views 
				DESC LIMIT 1";
		}else{
			$q= "SELECT region,SUM(views) AS views 
				FROM video_raw
				WHERE date >= '".$start."'
				AND date <= '".$end."'
				GROUP BY region 
				ORDER BY views 
				DESC LIMIT 1";
		}
		$this->open(0);
		$r = $this->fetch($q);
		$this->close();
		return $r;
	}
	
	function getChannelViewOneMonth($id, $start, $end, $last){
		//Check Date Range
		if($start != '--' && $end == '--'){
			$end = $last;
		}
		if ($start == '--' && $end == '--'){
			$q= "SELECT *  
				FROM channel_views c
				LEFT JOIN tbl_project k
				ON c.channel_name = k.channel_id
				WHERE k.id = '".$id."' 
				AND c.date >= DATE_SUB('".$last."', INTERVAL 6 DAY)";
		}else{
			$q= "SELECT *  
				FROM channel_views c
				LEFT JOIN tbl_project k
				ON c.channel_name = k.channel_id
				WHERE k.id = '".$id."' 
				AND c.date >= '".$start."'
				AND c.date <= '".$end."'";
		}
		$this->open(0);
		$r = $this->fetch($q,1);
		$this->close();
		foreach($r as $key => $v){
			$r[$key]['ts'] = strtotime($v['date'])*1000;
		}
		// var_dump($q);exit;
		return $r;
	}
	
	function getCountry($id="CastrolAsiaPacific", $start, $end, $last){
		//Check Date Range
		if($start != '--' && $end == '--'){
			$end = $last;
		}
		if ($start == '--' && $end == '--'){
			$q= "SELECT region,SUM(views)AS views 
				FROM video_raw
				WHERE date >= DATE_SUB('".$last."', INTERVAL 6 DAY)
				GROUP BY region 
				ORDER BY views 
				DESC LIMIT 5";
		}else{
			$q= "SELECT region,SUM(views)AS views 
				FROM video_raw
				WHERE date >= '".$start."'
				AND date <= '".$end."'
				GROUP BY region 
				ORDER BY views 
				DESC LIMIT 5";
		}
		$this->open(0);
		$r = $this->fetch($q,1);
		$this->close();
		return $r;
	}
	
	function getTopChannelChart($id="CastrolAsiaPacific", $start, $end, $last){
		$this->open(0);
		//Check Date Range
		if($start != '--' && $end == '--'){
			$end = $last;
		}
		if ($start == '--' && $end == '--'){
			$q=	"SELECT c.player_location AS playback_location,SUM(c.views) views 
				FROM  geography_raw c 
				WHERE date >= DATE_SUB('".$last."', INTERVAL 6 DAY)
				GROUP BY c.player_location 
				ORDER BY views 
				DESC";
		}else{
			$q=	"SELECT c.player_location AS playback_location,SUM(c.views) views 
				FROM  geography_raw c 
				WHERE date >= '".$start."'
				AND date <= '".$end."'
				GROUP BY c.player_location 
				ORDER BY views 
				DESC";
		}
		$r = $this->fetch($q,1);
		$this->close();
		//var_dump($r);
		return $r;
	}
	
	function getTopGender($id, $start, $end, $last){
		//Check Date Range
		if($start != '--' && $end == '--'){
			$end = $last;
		}
		if ($start == '--' && $end == '--'){
			$q= "SELECT gender, SUM(persen) AS percent, tgl
				FROM demography_final
				WHERE tgl_demog >= DATE_SUB('".$last." 00:00:00', INTERVAL 6 DAY)
				AND proID = '".$id."'
				GROUP BY gender";
		}else{
			$q= "SELECT gender, SUM(persen) AS percent, tgl
				FROM demography_final
				WHERE tgl_demog >= '".$start." 00:00:00'
				AND tgl_demog <= '".$end." 00:00:00'
				AND proID = '".$id."'
				GROUP BY gender";
		}
		$this->open(0);
		$r = $this->fetch($q,1);
		$this->close();
		return $r;
	}
	
	function getTopAge($id, $start, $end, $last){
		//Check Date Range
		if($start != '--' && $end == '--'){
			$end = $last;
		}
		if ($start == '--' && $end == '--'){
			$q= "SELECT age_group, SUM(persen) AS percent, tgl
				FROM demography_final
				WHERE tgl_demog >= DATE_SUB('".$last." 00:00:00', INTERVAL 6 DAY)
				AND proID = '".$id."'
				GROUP BY age_group";
		}else{
			$q= "SELECT age_group, SUM(persen) AS percent, tgl
				FROM demography_final
				WHERE tgl_demog >= '".$start." 00:00:00'
				AND tgl_demog <= '".$end." 00:00:00'
				AND proID = '".$id."'
				GROUP BY age_group";
		}
		$this->open(0);
		$r = $this->fetch($q,1);
		$this->close();
		return $r;
	}
	
	function getChannelSubscribersOneMonth($id, $start, $end, $last){
		//Check Date Range
		if($start != '--' && $end == '--'){
			$end = $last;
		}
		if ($start == '--' && $end == '--'){
			$tgl = $this->getChannelViewOneMonth($id, $start, $end, $last);
			$q=	"SELECT c.subscribe, c.date
				FROM channel_subscribers c
				LEFT JOIN tbl_project k
				ON c.channel_name = k.channel_id
				WHERE c.date >= DATE_SUB('".$tgl[6]['date']."', INTERVAL 6 DAY)
				AND c.date <='".$tgl[6]['date']."'
				AND k.id = '".$id."'";
		}else{
			$q=	"SELECT c.subscribe, c.date
				FROM channel_subscribers c
				LEFT JOIN tbl_project k
				ON c.channel_name = k.channel_id
				WHERE date >= '".$start."'
				AND date <= '".$end."'
				AND k.id = '".$id."'
				ORDER BY c.date";
		}
		$this->open(0);
		$r = $this->fetch($q,1);
		$this->close();
		foreach($r as $key => $v){
			$r[$key]['ts'] = strtotime($v['date'])*1000;
		}
		$r = json_encode($r);
		return $r;
	}
//=============================================================	
	function getChannelViews(){
		$q = "SELECT * FROM channel_views";
		$this->open(0);
		$r = $this->fetch($q,1);
		$this->close();
		foreach($r as $key => $v){
			$r[$key]['ts'] = strtotime($v['date'])*1000;
		}
		$r = json_encode($r);
		// print "<pre>";
		// print_r($r);exit;
		return $r;
	}
	
	function getTop10Country(){
		$q = "SELECT country,region_id as region,views FROM channel_country_views ORDER BY views DESC LIMIT 10";
		$this->open(0);
		$r = $this->fetch($q,1);
		$this->close();
		// $r = json_encode($r);
		return $r;
	}
	
	function getProjectList(){
		$this->open(0);
		$project = 'SELECT * FROM tbl_project ORDER BY start_date DESC';
		$rs = $this->fetch($project,1);
		$this->close();
		return $rs;
	}
	function getChannelStatistics($id){
		$channel = $this->getKPI($id);
		$this->open(0);
		$q = 'SELECT * FROM channel_stats WHERE channel_id="'.$channel[0]['channel_id'].'"';
		$r = $this->fetch($q,1);
		$this->close();
		//var_dump($r);
		//$data = json_encode($r);
		return $r;
	}
	
	function getWeeklyView(){
		// $week[0] = date('Y-m-d'); 
		$week[1] = date('Y-m-d', strtotime('-7 days')); //0406
		$week[2] = date('Y-m-d', strtotime('-14 days'));
		$week[3] = date('Y-m-d', strtotime('-21 days'));
		$week[4] = date('Y-m-d', strtotime('-28 days'));
		$this->open(0);
		
		foreach($week as $key => $w){
			$t = explode("-",$w);
			$tgl = date('Y-m-d',mktime(0,0,0,$t[1],$t[2]+7,$t[0]));
			// $tgl = date($w, strtotime('+7 days'));
			$q = "SELECT sum(views) view_week FROM channel_views WHERE date between '".$w."' AND DATE_ADD('".$w."', INTERVAL 7 DAY) ";
			// echo $q."<br>";
			$d = $this->fetch($q);
			$wk = $t[2]."/".$t[1];
			//echo $wk;exit;
			$t2 = explode("-",$tgl);
			$dt = $t2[2]."/".$t2[1];
			//echo $dt;exit;
			$data[] = array("week" => $wk." - ".$dt, "views" => $d['view_week']);
		}
		//print_r($data);exit;
		$this->close();
		//$data = json_encode($data);
		return $data;
	}
	
	function getMonthlyView(){
		$q = "SELECT sum(views)  view_month,date_format(date,'%Y-%m') month FROM channel_views group by 	
			  date_format(date,'%Y-%m')";
		$this->open(0);
		$r = $this->fetch($q,1);
		$this->close();
		$data=$r;
		// print_r($r);exit;
		//$data = json_encode($data);
		return $data;
	}
	
	function getVideoStatistics(){
		$this->open(0);
		$q = 'SELECT * FROM channel_video_list';
		$list = $this->fetch($q,1);
		// print "<pre>";
		// print_r($list);exit;
		foreach($list as $l){
			$vid = $l['video_id'];
			$qv = "SELECT * FROM channel_video_stats WHERE video_id='".$vid."'";
			$v = $this->fetch($qv,1);
			foreach($v as $key => $val){
				$v[$key]['ts'] = strtotime($val['date'])*1000;
				// $v[$key]['ts'] = $val['ts'];
			}
			$data[] = array("$vid"=>$v);
		}
		// print "<pre>";
		// print_r($data);exit;
		$this->close();
		$data = json_encode($data);
		return $data;
	}
	
	function getThisMonthView(){
		$date = date("Y-m");
		$q = "SELECT sum(views)  view_month,date_format(date,'%Y-%m') month FROM channel_views WHERE date_format(date,'%Y-%m') ='".$date."'  group by
		date_format(date,'%Y-%m')";
		$this->open(0);
		$r = $this->fetch($q);
		$this->close();
		$data=$r;
		//print_r($r);exit;
		//$data = json_encode($data);
		return $data;
	}
	
	
	
	
	
	// GET TOP TRAFFIC
	function topTraffic(){
		$q = "SELECT * FROM top_traffic";
		$qt = "SELECT SUM(views) total FROM top_traffic";
		$this->open(0);
		$r = $this->fetch($q,1);
		$t = $this->fetch($qt);
		$this->close();
		 //print '<pre>';
		 //echo $t['total'];
		// print_r($t);
		// exit;
		// $data=array();
		foreach($r as $a){
			$data[] = array("source"=>$a['source'], 
							"views"=>$a['views'], 
							"persen"=>$a['views']/$t['total']*100);
		}
		return $data;	
	}
	
	function getDemographicStatsByCountry($semID, $id){
		// $q = "SELECT region, gender, age_group, total_views FROM youtube_demography WHERE region='".$id."'";
		$q = "SELECT * FROM demography_final WHERE country='".$id."' AND proID='".$semID."' ORDER BY country,gender,age_group";
		$this->open(0);
		$r = $this->fetch($q,1);
		$this->close();
		return $r;
	}
	
	function get10TotalViewsPerCountry($id){
		$q = "SELECT SUM(total_views) AS views FROM youtube_demography WHERE region='".$id."' GROUP BY region ORDER BY views DESC LIMIT 10 ";
		$this->open(0);
		$r = $this->fetch($q,1);
		$this->close();
		return $r;
	}
	function getCountryTotalViews($id){
		$q = " SELECT region, SUM(total_views) AS total FROM youtube_demography WHERE region='".$id."' GROUP BY region;";
		$this->open(0);
		$r = $this->fetch($q);
		$this->close();
		return $r;
	}
	
	
	
	/** MODEL DATA **/
}