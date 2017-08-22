<?php
/** MODEL DATA 
 ** @Babar
 **	@cendekiApp
 **/
class SEMModel extends SQLData{
	function __construct($req){
		parent::SQLData();
		$this->Request = $req;
		$this->View = new BasicView();
		$this->User = new UserManager();
	}
	function getLastUpdate($id){
		$this->open(0);
		$q=	"SELECT DATE_FORMAT(c.range_date,'%d %M %Y') AS lastUpdate, c.range_date AS end_date
			FROM tbl_semad_report c 
			LEFT JOIN tbl_project k
			ON c.semID = k.id
			WHERE k.id = '".$id."'
			ORDER BY c.range_date 
			DESC LIMIT 1	
			";
		$r = $this->fetch($q);
		$s=	"SELECT DATE_FORMAT(c.range_date,'%d %M %Y') AS seven_date
			FROM tbl_semad_report c 
			LEFT JOIN tbl_project k
			ON c.semID = k.id
			WHERE k.id = '".$id."'
			AND c.range_date = DATE_SUB('".$r['end_date']."', INTERVAL 6 DAY)
			ORDER BY c.range_date 
			DESC LIMIT 1	
			";
		$this->close;
		$t = $this->fetch($s);
		$r["min7"] = $t["seven_date"];
		// var_dump($r);exit;
		return $r;
	}
	function getCampaign($id){
		$this->open(0);
		$q=	"SELECT * 
			FROM tbl_campaign 
			WHERE proID = '".$id."'";
		$this->close;
		$r = $this->fetch($q);
		return $r;
		
	}
	function getStartDate($id){
		$this->open(0);
		$q=	"SELECT * 
			FROM tbl_project 
			WHERE id = '".$id."'";
		$this->close;
		$r = $this->fetch($q);
		return $r;
	}
	
	function getKPI($id, $type){
		$this->open(0);
		$q=	"SELECT * 
			FROM tbl_kpi 
			WHERE projectID = '".$id."'
			AND tipe = '".$type."'";
		$this->close;
		$r = $this->fetch($q);
		return $r;
	}
	
	function getTotalClickFromStart($id, $kpi, $start, $end, $last){
		//Check Date Range
		if($start != '--' && $end == '--'){
			$end = $last;
		}
		$this->open(0);
		if ($start == '--' && $end == '--'){
			$q=	"SELECT SUM(c.click) AS clicks
				FROM tbl_semad_report c
				LEFT JOIN tbl_project k
				ON c.semID = k.id
				WHERE  c.semID = '".$id."' 
				AND c.range_date >= k.start_date
				";
		}else{
			$q=	"SELECT SUM(c.click) AS clicks
				FROM tbl_semad_report c
				LEFT JOIN tbl_project k
				ON c.semID = k.id
				WHERE  c.semID = '".$id."' 
				AND c.range_date >= '".$start."'
				AND c.range_date <= '".$end."'
				";
		}
		$data = $this->fetch($q);
		$this->close();
		$percent = (($data['clicks']/$kpi)*100);
		$data = array(
				"click" => $data['clicks'],
				"percent" => $percent
				);
		return $data;
	}
	function getClickThisMonth($id){
		$firstDay = date('d');
		if ($firstDay == '01'){
			$month = date('m')-1;
			$year = date('Y');
			if($month < 10){$month = "0".$month;}
			$date = $year."-".$month;
		}else{
			$date = date("Y-m");
		}
		$q= "SELECT SUM(click) AS this_month 
			FROM tbl_semad_report r 
			LEFT JOIN tbl_project p 
			ON p.id=r.semID 
			WHERE DATE_FORMAT(range_date,'%Y-%m') ='".$date."'
			AND  semID = '".$id."'";
		$this->open(0);
		$r = $this->fetch($q);
		$this->close();
		
		$type = 'click';
		$kpi = $this->getKPI($id, $type);
		$kpiMonth = $kpi['kpi_month'];
		$percent = (($r['this_month']/$kpiMonth)*100);
		
		$data = array(
				"click" => $r['this_month'],
				"percent" => round($percent,2)
		);
		return $data;
	}
	function getCTRFromStart($id, $kpi, $start, $end, $last){
		$last = $this->getLastUpdate($id);
		//Check Date Range
		if($start != '--' && $end == '--'){
			$end = $last;
		}
		$this->open(0);
		if ($start == '--' && $end == '--'){
			$q= "SELECT SUM(c.click) AS total_click, SUM(c.impressions)  AS total_impression
				FROM tbl_semad_report c 
				LEFT JOIN tbl_project k 
				ON c.semID = k.id
				WHERE c.semID = '".$id."'
				AND c.range_date = '".$last['end_date']."'
				";
		}else{
			$q= "SELECT SUM(c.click) AS total_click, SUM(c.impressions)  AS total_impression
				FROM tbl_semad_report c 
				LEFT JOIN tbl_project k 
				ON c.semID = k.id
				WHERE c.semID = '".$id."'
				AND c.range_date >= '".$start."'
				AND c.range_date <= '".$end."'
				GROUP BY c.range_date 
				DESC LIMIT 1
				";			
		}
		$r = $this->fetch($q);
		$this->close();
		$ctr = ($r['total_click']/$r['total_impression'])*100;
		$percent = $ctr-$kpi;
		$data = array(
				"ctr" => round($ctr,2),
				"percent" => round($percent,2)
		);
		return $data;
	}
	function getBudget($id){
		$this->open(0);
		$budget=	"SELECT budget 
					FROM tbl_project_budget 
					JOIN tbl_project 
					WHERE tbl_project_budget.id_project = tbl_project.id 
					AND tbl_project_budget.id_project = '".$id."'";
		$budget = $this->fetch($budget);
		$this->close();
		return $budget;
	}
	function getTotalCostThisMonth($id, $cpc, $start, $end, $last){
		$last = $this->getLastUpdate($id);
		//Check Date Range
		if($start != '--' && $end == '--'){
			$end = $last;
		}
		if ($start == '--' && $end == '--'){
			$q= "SELECT SUM(c.cost) AS cost, SUM(c.click) AS click 
				FROM tbl_semad_report c 
				LEFT JOIN tbl_project k 
				ON c.semID = k.id
				WHERE c.semID = '".$id."'
				AND c.range_date = '".$last['end_date']."'";
		}else{
			$q= "SELECT SUM(c.cost) AS cost, SUM(c.click) AS click 
				FROM tbl_semad_report c 
				LEFT JOIN tbl_project k 
				ON c.semID = k.id
				WHERE c.semID = '".$id."'
				AND c.range_date >= '".$start."'
				AND c.range_date <= '".$end."'
				GROUP BY c.range_date 
				DESC LIMIT 1";
		}
		$this->open(0);
		$r = $this->fetch($q);
		$this->close();
		$currCost = $r['cost']/$r['click'];
		$percent = $currCost-$cpc;
		$data = array(
				"cost" => round($currCost,2),
				"percent" => round($percent,2)
		);
		return $data;
	}
	function getTotalCostFromStart($id, $budget, $start, $end, $last){
		//Check Date Range
		if($start != '--' && $end == '--'){
			$end = $last;
		}
		$this->open(0);
		if ($start == '--' && $end == '--'){
			$q=	"SELECT SUM(c.cost) AS cost
				FROM tbl_semad_report c 
				LEFT JOIN tbl_project k 
				ON c.semID = k.id
				WHERE c.semID = '".$id."'
				AND c.range_date >= k.start_date";
		}else{
			$q=	"SELECT SUM(c.cost) AS cost
				FROM tbl_semad_report c 
				LEFT JOIN tbl_project k 
				ON c.semID = k.id
				WHERE c.semID = '".$id."'
				AND c.range_date >= '".$start."'
				AND c.range_date <= '".$end."'";		
		}
		$r = $this->fetch($q);
		$this->close();
		$percent = ($r['cost']/$budget)*100;
		$remainingBudget = $budget-$r['cost'];
		$data = array(
				"cost" => round($r['cost'],2),
				"percent" => $percent,
				"budget" => round($remainingBudget,2)
		);
		return $data;
	}
	function getClickPerDay($id, $start, $end, $last){
		$last = $this->getLastUpdate($id);
		//Check Date Range
		if($start != '--' && $end == '--'){
			$end = $last;
		}
		$this->open();
		if ($start == '--' && $end == '--'){
			$q=	"SELECT click AS clicks, range_date 
				FROM tbl_semad_report 
				JOIN tbl_project 
				WHERE  semID = '".$id."' 
				AND tbl_semad_report.range_date >= tbl_project.start_date 
				AND  range_date >= DATE_SUB('".$last['end_date']."', INTERVAL 6 DAY) 
				GROUP BY range_date,campaign";
		}else{
			$q=	"SELECT click AS clicks, range_date 
				FROM tbl_semad_report
				WHERE  semID = '".$id."' 
				AND tbl_semad_report.range_date >= '".$start."'
				AND tbl_semad_report.range_date <= '".$end."' 
				GROUP BY range_date,campaign";
		}
		$data = $this->fetch($q,1);
		$this->close();
		foreach($data as $val){
			$arr[$val['range_date']]+=$val['clicks'];	
		}
		$data = null;
		foreach($arr as $key => $val){
		$data[] = array('clicks'=>$val,'range_date'=>$key);
		}
		
		return $data;
	}
	function getCPCPerDay($id, $start, $end, $last){
		$last = $this->getLastUpdate($id);
		//Check Date Range
		if($start != '--' && $end == '--'){
			$end = $last;
		}
		$this->open();
		if ($start == '--' && $end == '--'){
			$q=	"SELECT cost, click, range_date 
				FROM tbl_semad_report 
				JOIN tbl_project 
				WHERE  semID = '".$id."' 
				AND tbl_semad_report.range_date >= tbl_project.start_date 
				AND  range_date >= DATE_SUB('".$last['end_date']."', INTERVAL 6 DAY) 
				GROUP BY range_date,campaign";
		}else{
			$q=	"SELECT cost, click, range_date 
				FROM tbl_semad_report 
				JOIN tbl_project 
				WHERE  semID = '".$id."' 
				AND tbl_semad_report.range_date >= '".$start."'
				AND tbl_semad_report.range_date <= '".$end."'
				GROUP BY range_date,campaign";
		}
		$data = $this->fetch($q,1);
		$this->close();
		foreach($data as $val){
			$arr[$val['range_date']]['cost']+=$val['cost'];
			$arr[$val['range_date']]['click']+=$val['click'];
		}
		$data = null;
		foreach($arr as $key => $val){
			$sums = round(($val['cost']/$val['click']),2);	
			$data[] = array('avg_cpc'=>$sums,'range_date'=>$key);
		}
		return $data;
		
	}
	function getCTRPerDay($id, $ctr, $kpi, $start, $end, $last){
		$last = $this->getLastUpdate($id);
		//Check Date Range
		if($start != '--' && $end == '--'){
			$end = $last;
		}
		$this->open();
		if ($start == '--' && $end == '--'){
			$q=	"SELECT  click AS ctrs, range_date,impressions 
				FROM tbl_semad_report r 
				LEFT JOIN tbl_project s 
				ON s.id = r.semID 
				WHERE  semID = '".$id."' 
				AND r.range_date >= s.start_date 
				AND  range_date >= DATE_SUB('".$last['end_date']."', INTERVAL 6 DAY) 
				GROUP BY range_date,campaign";
		}else{
			$q=	"SELECT  click AS ctrs, range_date,impressions 
				FROM tbl_semad_report r 
				LEFT JOIN tbl_project s 
				ON s.id = r.semID 
				WHERE  semID = '".$id."' 
				AND r.range_date >= '".$start."'
				AND r.range_date <= '".$end."'
				GROUP BY range_date,campaign";
		}
	 	
		$data = $this->fetch($q,1);
		$this->close();
		foreach($data as $val){
			$arr[$val['range_date']]['click']+=$val['ctrs'];	
		}
		foreach($data as $val){
			$arr[$val['range_date']]['impressions']+=$val['impressions'];	
		}
		$data = null;
		foreach($arr as $key => $val){
		$sums = (($val['click']/$val['impressions'])*100);
		
		$data[] = array('ctrs'=>$sums,'range_date'=>$key);
		}
		for ($i=0;$i<sizeof($data);$i++){
			$data2[$i] = array(
					"ctrs" => $data[$i]['ctrs'],
					"range_date" => $data[$i]['range_date'],
					"ctr_target" => $ctr
			);
		}
		return $data2;
	
	}
	function getSearchAndDisplay($id, $start, $end, $last){
		$last = $this->getLastUpdate($id);
		//Check Date Range
		if($start != '--' && $end == '--'){
			$end = $last;
		}
		$this->open();
		if ($start == '--' && $end == '--'){
			$q= "SELECT c.description, c.clicks AS clicks, c.ctr AS ctr, c.impression AS impression 
				FROM tbl_semad_summary c
				LEFT JOIN tbl_project k 
				ON c.semID = k.id
				WHERE c.description = 'Total - Search' 
				AND c.range_date >= DATE_SUB('".$last['end_date']."', INTERVAL 6 DAY) 
				AND c.semID = '".$id."'";
			$s= "SELECT c.description, c.clicks AS clicks, c.ctr AS ctr, c.impression AS impression 
				FROM tbl_semad_summary c
				LEFT JOIN tbl_project k 
				ON c.semID = k.id
				WHERE c.description = 'Total - Display Network' 
				AND c.range_date >= DATE_SUB('".$last['end_date']."', INTERVAL 6 DAY) 
				AND c.semID = '".$id."'";
		}else{
			$q= "SELECT c.description, c.clicks AS clicks, c.ctr AS ctr, c.impression AS impression 
				FROM tbl_semad_summary c
				LEFT JOIN tbl_project k 
				ON c.semID = k.id
				WHERE c.description = 'Total - Search' 
				AND c.range_date >= '".$start."'
				AND c.range_date <= '".$end."'
				AND c.semID = '".$id."'";
			$s= "SELECT c.description, c.clicks AS clicks, c.ctr AS ctr, c.impression AS impression 
				FROM tbl_semad_summary c
				LEFT JOIN tbl_project k 
				ON c.semID = k.id
				WHERE c.description = 'Total - Display Network' 
				AND c.range_date >= '".$start."'
				AND c.range_date <= '".$end."'
				AND c.semID = '".$id."'";
		}
		$data = $this->fetch($q,1);
		$data2 = $this->fetch($s,1);
		$this->close();
		
		for ($i=0;$i<sizeof($data);$i++){
			$search += intval($data[$i]['clicks']);
			$impresi += intval($data[$i]['impression']);
		}
		$ctrS = ($search/$impresi)*100;
		for ($i=0;$i<sizeof($data2);$i++){
			$DN += intval($data2[$i]['clicks']);
			$impresi2 += intval($data2[$i]['impression']);
		}
		$ctrDN = ($DN/$impresi2)*100;
		$searchData = array("clicks" => $search, "ctr" => $ctrS);
		$DNData = array("clicks" => $DN, "ctr" => $ctrDN);
		$hasil = array($DNData, $searchData);
		return $hasil;
	}
	function getCostPerDay($id, $dailyBudget, $start, $end, $last){
		$last = $this->getLastUpdate($id);
		//Check Date Range
		if($start != '--' && $end == '--'){
			$end = $last;
		}
		$this->open();
		if ($start == '--' && $end == '--'){
			$q=	"SELECT cost AS costperhari, range_date
				FROM tbl_semad_report r
				LEFT JOIN tbl_project s ON s.id = r.semID
				WHERE r.range_date >= DATE_SUB('".$last['end_date']."', INTERVAL 6 DAY)
				AND r.range_date >= s.start_date
				AND s.id = '".$id."'
				GROUP BY range_date, campaign";
		}else{
			$q=	"SELECT cost AS costperhari, range_date
				FROM tbl_semad_report r LEFT JOIN tbl_project s 
				ON s.id = r.semID
				WHERE s.id = '".$id."'
				AND r.range_date >= '".$start."'
				AND r.range_date <= '".$end."'
				GROUP BY range_date, campaign";
		}
		$data = $this->fetch($q,1);
		$this->close();
		foreach($data as $val){
			$arr[$val['range_date']]+=$val['costperhari'];	
		}
		$data = null;
		foreach($arr as $key => $val){
		$data[] = array('costperhari'=>$val,'range_date'=>$key, 'budget' => $dailyBudget);
		}
		
		return $data;
	}
	
	function getTop10Ads($id, $start, $end, $last){
		$last = $this->getLastUpdate($id);
		//Check Date Range
		if($start != '--' && $end == '--'){
			$end = $last;
		}
		$this->open();
		if ($start == '--' && $end == '--'){
			$q="SELECT c.ads, SUM(click) AS klik
				FROM tbl_semad_ads c
				WHERE proID = '".$id."'
				AND c.day >= DATE_SUB('".$last['end_date']."', INTERVAL 6 DAY)
				GROUP BY c.ads
				ORDER BY klik DESC
				LIMIT 10
				";
		}else{
			$q="SELECT c.ads, SUM(click) AS klik
				FROM tbl_semad_ads c
				WHERE proID = '".$id."'
				AND c.day >= '".$start."'
				AND c.day <= '".$end."'
				GROUP BY c.ads
				ORDER BY klik DESC
				LIMIT 10
				";
		}
		$this->close;
		$data = $this->fetch($q,1);
		return $data;
	}
	
	function getTop10Keywords($id, $start, $end, $last){
		$last = $this->getLastUpdate($id);
		//Check Date Range
		if($start != '--' && $end == '--'){
			$end = $last;
		}
		$this->open();
		if ($start == '--' && $end == '--'){
			$q="SELECT c.keyword, SUM(click) AS klik
				FROM tbl_semad_keyword c
				WHERE proID = '".$id."'
				AND c.day >= DATE_SUB('".$last['end_date']."', INTERVAL 6 DAY)
				GROUP BY c.keyword
				ORDER BY klik DESC
				LIMIT 10";
		}else{
			$q="SELECT c.keyword, SUM(click) AS klik
				FROM tbl_semad_keyword c
				WHERE proID = '".$id."'
				AND c.day >= '".$start."'
				AND c.day <= '".$end."'
				GROUP BY c.keyword
				ORDER BY klik DESC
				LIMIT 10";
		}
		$this->close;
		$data = $this->fetch($q,1);
		return $data;
	}
	
	function getImpactOnlineAsset($id, $start, $end, $last){
		$last = $this->getLastUpdate($id);
		//Check Date Range
		if($start != '--' && $end == '--'){
			$end = $last;
		}
		$this->open();
		if ($start == '--' && $end == '--'){
			$q="SELECT SUM(c.visits) AS totalPaid
				FROM tbl_sem_paidsearch c
				LEFT JOIN tbl_project k
				ON c.proID = k.id
				WHERE c.proID = '".$id."'
				AND c.day <= '".$last['end_date']."'";
			$r="SELECT SUM(c.visits) AS totalVisits
				FROM tbl_sem_allvisits c
				LEFT JOIN tbl_project k
				ON c.proID = k.id
				WHERE c.proID = '".$id."'
				AND c.day <= '".$last['end_date']."'";
		}else{
			$q="SELECT SUM(c.visits) AS totalPaid
				FROM tbl_sem_paidsearch c
				LEFT JOIN tbl_project k
				ON c.proID = k.id
				WHERE c.proID = '".$id."'
				AND c.day >= '".$start."'
				AND c.day <= '".$end."'";
			$r="SELECT SUM(c.visits) AS totalVisits
				FROM tbl_sem_allvisits c
				LEFT JOIN tbl_project k
				ON c.proID = k.id
				WHERE c.proID = '".$id."'
				AND c.day >= '".$start."'
				AND c.day <= '".$end."'";
		}
		$this->close;
		$paid = $this->fetch($q);
		$allVisits = $this->fetch($r);
		$data = round(($paid['totalPaid']/$allVisits['totalVisits'])*100,2);
		return $data;
	}
	
	function getCampaignAsset($id, $start, $end, $last){
		$last = $this->getLastUpdate($id);
		//Check Date Range
		if($start != '--' && $end == '--'){
			$end = $last;
		}
		$this->open();
		if ($start == '--' && $end == '--'){
			$q="SELECT c.day AS datee, c.visits
				FROM tbl_sem_paidsearch c
				LEFT JOIN tbl_project k
				ON c.proID = k.id
				WHERE c.proID = '".$id."'
				AND c.day >= DATE_SUB('".$last['end_date']."', INTERVAL 6 DAY)";
			$r="SELECT c.day AS datee, c.visits
				FROM tbl_sem_allvisits c
				LEFT JOIN tbl_project k
				ON c.proID = k.id
				WHERE c.proID = '".$id."'
				AND c.day >= DATE_SUB('".$last['end_date']."', INTERVAL 6 DAY)";
		}else{
			$q="SELECT c.day AS datee,visits
				FROM tbl_sem_paidsearch c
				LEFT JOIN tbl_project k
				ON c.proID = k.id
				WHERE c.proID = '".$id."'
				AND c.day >= '".$start."'
				AND c.day <= '".$end."'";
			$r="SELECT c.day AS datee, c.visits
				FROM tbl_sem_allvisits c
				LEFT JOIN tbl_project k
				ON c.proID = k.id
				WHERE c.proID = '".$id."'
				AND c.day >= '".$start."'
				AND c.day <= '".$end."'";
		}
		$this->close;
		$paid = $this->fetch($q,1);
		$allVisits = $this->fetch($r,1);
		
		$data = array("paid_search" => $paid, "all_search" => $allVisits);
		
		return $data;
	}
	
}