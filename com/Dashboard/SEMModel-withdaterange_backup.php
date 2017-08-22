<?php
/** MODEL DATA 
 ** @Babar
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
		$q=	"SELECT DATE_FORMAT(c.range_date,'%d %M %Y') AS lastUpdate, range_date
			FROM tbl_semad_report c LEFT JOIN tbl_project k
			ON c.semID = k.id
			WHERE k.id = '".$id."'
			ORDER BY c.range_date DESC LIMIT 1	
			";
		$this->close;
		$r = $this->fetch($q);
// 		var_dump($r);exit;
		return $r;
	
	}
	function getCampaign($id){
		$this->open(0);
		$q ="SELECT * FROM tbl_campaign WHERE proID = '".$id."'";
		$this->close;
		$r = $this->fetch($q);
		return $r;
		
	}
	function getStartDate($id){
		$this->open(0);
		$q ="SELECT * FROM tbl_project WHERE id = '".$id."'";
		$this->close;
		$r = $this->fetch($q);
		return $r;
	}
	
	function getKPI($id, $type){
		$this->open(0);
		$q ="SELECT * FROM tbl_kpi WHERE projectID = '".$id."' AND tipe = '".$type."'";
		$this->close;
		$r = $this->fetch($q);
		return $r;
	}
	
	function getTotalClickFromStart($id, $kpi, $start, $end){
		$this->open(0);
//		by Request
		$request = "SELECT SUM(click) AS clicks
					FROM tbl_semad_report
					WHERE semID = '".$id."' 
					AND range_date >= '".$start."' 
					AND range_date <= '".$end."'";		
		$data = $this->fetch($request);
		$this->close();
		$temp = $data['clicks'];
		$percent = (($temp/$kpi)*100);
		$data = array(
				"click" => $temp,
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
		$q = "SELECT SUM(click) AS this_month FROM tbl_semad_report r 
			  LEFT JOIN tbl_project p ON p.id=r.semID 
			  WHERE DATE_FORMAT(range_date,'%Y-%m') ='".$date."' AND  semID = '".$id."'";
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
		//print_r($r);exit;
		//$data = json_encode($data);
		return $data;
	}
	function getCTRFromStart($id, $kpi, $start, $end){
		$this->open(0);
 		$q = "SELECT SUM(click) AS total_click , SUM(impressions) AS total_impression 
				FROM tbl_semad_report r LEFT JOIN tbl_project p ON p.id = r.semID  
 				WHERE  r.range_date = DATE_SUB(CURRENT_DATE, INTERVAL 1 DAY) AND  r.semID = '".$id."'";
		$r = $this->fetch($q);
		$this->close();
		$ctr = ($r['total_click']/$r['total_impression'])*100;
// 		$percent = ((($ctr)/$kpi)*100);
		$percent = $ctr-$kpi;
		//var_dump($ctr);exit;
		$data = array(
				"ctr" => round($ctr,2),
				"percent" => round($percent,2)
		);
		//$data = json_encode($r);
		return $data;
	}
	function getBudget($id){
		$this->open(0);
		$budget = "SELECT budget FROM tbl_project_budget JOIN tbl_project WHERE tbl_project_budget.id_project = tbl_project.id AND tbl_project_budget.id_project = '".$id."'";
		$budget = $this->fetch($budget);
		$this->close();
		return $budget;
	}
	function getTotalCostThisMonth($id, $cpc){
		//$date = date("Y-m");
// 		$q = "SELECT c.cost, c.clicks 
// 			FROM tbl_semad_summary c LEFT JOIN tbl_project k ON k.id = c.semID 
// 			WHERE c.semID = '".$id."' AND c.range_date = DATE_SUB(CURRENT_DATE, INTERVAL 1 DAY) AND c.description='Total'";
 		$q = "SELECT SUM(c.cost) AS cost, SUM(c.click) AS clicks
			FROM tbl_semad_report c LEFT JOIN tbl_project k ON k.id = c.semID 
			WHERE c.semID = '".$id."' AND c.range_date = DATE_SUB(CURRENT_DATE, INTERVAL 1 DAY)";
		$this->open(0);
		$r = $this->fetch($q);
// 		$b = $this->fetch($s);
		$this->close();
		$currCost = $r['cost']/$r['clicks'];
// 		$percent = (($r['cost']/$cpc)*100);
		$percent = $currCost-$cpc;
//   		var_dump($b);exit;
		$data = array(
				"cost" => round($currCost,2),
				"percent" => round($percent,2)
		);
		//print_r($r);exit;
		//$data = json_encode($data);
		return $data;
	}
	function getTotalCostFromStart($id, $budget, $start, $end){
		$this->open(0);
// 		$q = "SELECT SUM(c.cost) AS cost FROM tbl_semad_summary c LEFT JOIN tbl_project k ON c.semID = k.id
// 		WHERE c.description = 'Total' AND c.range_date >= k.start_date AND c.semID = '".$id."'";
		$request = "SELECT SUM(cost) AS cost
					FROM tbl_semad_report
					WHERE semID = '".$id."' 
					AND range_date >= '".$start."' 
					AND range_date <= '".$end."'";	
		$r = $this->fetch($request);
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
	function getClickPerDay($id, $start, $end){
		$this->open();
		$q = 	"SELECT click AS clicks, range_date 
				FROM tbl_semad_report
				WHERE  semID = '".$id."' 
				AND tbl_semad_report.range_date >= '".$start."'
				AND tbl_semad_report.range_date <= '".$end."' 
				GROUP BY range_date,campaign";
		//$q = "SELECT clicks, range_date FROM tbl_semad_summary JOIN tbl_project WHERE description = 'Total' AND tbl_project.id = '2' AND tbl_semad_summary.range_date >= tbl_project.start_date AND  range_date >= DATE_SUB(CURRENT_DATE, INTERVAL 10 DAY) GROUP BY range_date";
		$data = $this->fetch($q,1);
		$this->close();
// 		var_dump($q);
		foreach($data as $val){
			$arr[$val['range_date']]+=$val['clicks'];	
		}
		$data = null;
		foreach($arr as $key => $val){
		$data[] = array('clicks'=>$val,'range_date'=>$key);
		}
		
		return $data;
	}
	function getCPCPerDay($id, $start, $end){
		$this->open();
		$q 	= 	"SELECT cost, click, range_date 
				FROM tbl_semad_report JOIN tbl_project 
				WHERE  semID = '".$id."' 
				AND tbl_semad_report.range_date >= '".$start."'
				AND tbl_semad_report.range_date <= '".$end."'
				GROUP BY range_date,campaign";
		//$q = "SELECT avg_cpc, range_date FROM tbl_semad_summary JOIN tbl_project WHERE description = 'Total' AND tbl_project.id = '2' AND tbl_semad_summary.range_date >= tbl_project.start_date AND  range_date >= DATE_SUB(CURRENT_DATE, INTERVAL 10 DAY) GROUP BY range_date";
		$data = $this->fetch($q,1);
		$this->close();
		//data [0] avg_cpc range_date 
		foreach($data as $val){
			$arr[$val['range_date']]['cost']+=$val['cost'];
			$arr[$val['range_date']]['click']+=$val['click'];
		}
// 		var_dump($arr);exit;
		$data = null;
		foreach($arr as $key => $val){
			$sums = round(($val['cost']/$val['click']),2);	
			$data[] = array('avg_cpc'=>$sums,'range_date'=>$key);
		}
// 		var_dump($data);exit;
		return $data;
		
	}
	function getCTRPerDay($id, $ctr, $kpi){
		$this->open();
// 		$q = "SELECT  click AS ctrs, range_date,impressions FROM tbl_semad_report r LEFT JOIN tbl_project s ON s.id = r.semID WHERE  semID = '".$id."' AND r.range_date >= s.start_date AND  range_date >= DATE_SUB(CURRENT_DATE, INTERVAL 5 DAY) AND campaign not in ('Search - Optimization-1','Search - Optimization-2') GROUP BY range_date,campaign";
	 	$q = "SELECT  click AS ctrs, range_date,impressions FROM tbl_semad_report r LEFT JOIN tbl_project s ON s.id = r.semID WHERE  semID = '".$id."' AND r.range_date >= s.start_date AND  range_date >= DATE_SUB(CURRENT_DATE, INTERVAL 5 DAY) GROUP BY range_date,campaign";
		//$q = "SELECT ctr, range_date FROM tbl_semad_summary JOIN tbl_project WHERE description = 'Total' AND tbl_project.id = '2' AND tbl_semad_summary.range_date >= tbl_project.start_date AND  range_date >= DATE_SUB(CURRENT_DATE, INTERVAL 6 DAY) GROUP BY range_date";
		$data = $this->fetch($q,1);
// 		var_dump($data);exit;
		$this->close();
		foreach($data as $val){
			$arr[$val['range_date']]['click']+=$val['ctrs'];	
		}
		foreach($data as $val){
			$arr[$val['range_date']]['impressions']+=$val['impressions'];	
		}
// 		var_dump($arr);exit;
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
// 		var_dump($data2);exit;
		return $data2;
	
	}
	function getSearchAndDisplay($id){
		$this->open();
		//$q = "SELECT SUM(ctr) AS ctrs, range_date FROM tbl_semad_report JOIN tbl_project WHERE tbl_project.id = '2' AND tbl_semad_report.range_date >= tbl_project.start_date AND  range_date >= DATE_SUB(CURRENT_DATE, INTERVAL 4 DAY) GROUP BY range_date";
//Bumi 	$q = "SELECT tbl_semad_summary.description, clicks AS clicks, ctr FROM tbl_semad_summary JOIN tbl_project WHERE tbl_semad_summary.description = 'Total - Search' AND tbl_semad_summary.description = 'Total - Display network' AND tbl_semad_summary.semID = tbl_project.id AND tbl_semad_summary.range_date >= tbl_project.start_date AND tbl_semad_summary.semID = '".$id."' GROUP BY tbl_semad_summary.description";
// 		$data = $this->fetch($q,1);
		$q = "SELECT c.description, c.clicks AS clicks, c.ctr AS ctr, c.impression AS impression FROM tbl_semad_summary c LEFT JOIN tbl_project k ON c.semID = k.id
		WHERE c.description = 'Total - Search' AND c.range_date >= k.start_date AND c.semID = '".$id."'";
		$s = "SELECT c.description, c.clicks AS clicks, c.ctr AS ctr, c.impression AS impression FROM tbl_semad_summary c LEFT JOIN tbl_project k ON c.semID = k.id
		WHERE c.description = 'Total - Display Network' AND c.range_date >= k.start_date AND c.semID = '".$id."'";
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
// 		var_dump($hasil);exit;
		return $hasil;
	}
	function getCostPerDay($id, $dailyBudget){
		$this->open();

		$q = "SELECT cost AS costperhari, range_date
		FROM tbl_semad_report r
		LEFT JOIN tbl_project s ON s.id = r.semID
		WHERE
		r.range_date >= DATE_SUB(CURRENT_DATE, INTERVAL 5 DAY)
		AND r.range_date >= s.start_date
		AND s.id = '".$id."'
		GROUP BY range_date, campaign";
		$data = $this->fetch($q,1);
		$this->close();
		foreach($data as $val){
			$arr[$val['range_date']]+=$val['costperhari'];	
		}
		$data = null;
		foreach($arr as $key => $val){
		$data[] = array('costperhari'=>$val,'range_date'=>$key, 'budget' => $dailyBudget);
		}
		
// 		var_dump($data);exit;
		return $data;
	}
	
	function getTop10Ads($id){
		$this->open();
		$q="SELECT c.ads, SUM(click) AS klik
			FROM tbl_semad_ads c
			WHERE proID = '".$id."'
			GROUP BY c.ads
			ORDER BY klik DESC
			LIMIT 10
			";
		$this->close;
		$data = $this->fetch($q,1);
// 		var_dump($data);exit;
		return $data;
	}
	
	function getTop10Keywords($id){
		$this->open();
		$q="SELECT c.keyword, SUM(click) AS klik
			FROM tbl_semad_keyword c
			WHERE proID = '".$id."'
			GROUP BY c.keyword
			ORDER BY klik DESC
			LIMIT 10
		";
		$this->close;
		$data = $this->fetch($q,1);
		// 		var_dump($data);exit;
		return $data;
	}
	
}