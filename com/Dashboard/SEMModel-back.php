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
	
	function getCampaign($id){
		$this->open(0);
		$q ="SELECT * FROM tbl_campaign WHERE proID = '".$id."'";
		$this->close;
		$r = $this->fetch($q);
		return $r;
		
	}
	function getStartDate($id){
		$this->open(0);
		$q ="SELECT start_date FROM tbl_project campaign WHERE id = '".$id."'";
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
	
	function getTotalClickFromStart($id, $kpi){
		$this->open(0);
		$q = "SELECT tbl_semad_summary.description, clicks AS clicks, ctr FROM tbl_semad_summary JOIN tbl_project WHERE tbl_semad_summary.description = 'Total - Search' OR tbl_semad_summary.description = 'Total - Display network' AND tbl_semad_summary.semID = tbl_project.id AND tbl_semad_summary.range_date = DATE_SUB(CURRENT_DATE, INTERVAL 0 DAY) AND tbl_semad_summary.semID = '".$id."' GROUP BY tbl_semad_summary.description";
		$data = $this->fetch($q,1);
		
 		// $q = "SELECT SUM(click) AS total_click FROM tbl_semad_report r LEFT JOIN tbl_project p ON p.id=r.semID WHERE r.semID='".$id."' AND r.range_date >= p.start_date;";
		// $r = $this->fetch($q);
		if ($s == null){
			$s['clicks'] = 0;
		}
		
		$this->close();
		
		foreach($data as $val){
			$r['total_click']+=$val['clicks'];	
		}
		$data =null;
		$percent = (($r['total_click']/$kpi)*100);
//  		var_dump($kpi);exit;
		$data = array(
				"click" => $r['total_click'],
				"percent" => $percent
				);
		//$data = json_encode($r);
		return $data;
	}
	function getClickThisMonth($id, $kpi){
		$date = date("Y-m");
		$q = "SELECT SUM(click) AS this_month FROM tbl_semad_report r LEFT JOIN tbl_project p ON p.id=r.semID WHERE DATE_FORMAT(range_date,'%Y-%m') ='2012-04' AND  semID = '2'";
		$this->open(0);
		$r = $this->fetch($q);
		$this->close();
		
		$percent = (($r['this_month']/$kpi)*100);
		
		$data = array(
				"click" => $r['this_month'],
				"percent" => round($percent,2)
		);
		//print_r($r);exit;
		//$data = json_encode($data);
		return $data;
	}
	function getCTRFromStart($id, $kpi){
		$this->open(0);
		$q = "SELECT SUM(click) AS total_click , SUM(impressions) AS total_impression FROM tbl_semad_report r LEFT JOIN tbl_project p ON p.id = r.semID  WHERE  r.range_date >= p.start_date AND  r.semID = '".$id."';";
		$r = $this->fetch($q);
		$this->close();
		$ctr = ($r['total_click']/$r['total_impression'])*100;
		$percent = ((($ctr)/$kpi)*100);
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
		$q = "SELECT SUM(avg_cost) AS cost FROM tbl_semad_report JOIN tbl_project WHERE semID = '".$id."' AND range_date = DATE_SUB(CURRENT_DATE, INTERVAL 1 DAY)";
// 		$s = "SELECT SUM(avg_cost) AS cost FROM tbl_semad_report JOIN tbl_project WHERE semID = '".$id."' AND range_date = DATE_SUB(CURRENT_DATE, INTERVAL 2 DAY)";
		$this->open(0);
		$r = $this->fetch($q);
// 		$b = $this->fetch($s);
		$this->close();
		$percent = (($r['cost']/$cpc)*100);
//   		var_dump($b);exit;
		$data = array(
				"cost" => round($r['cost'],2),
				"percent" => round($percent,2)
		);
		//print_r($r);exit;
		//$data = json_encode($data);
		return $data;
	}
	function getTotalCostFromStart($id, $budget){
		$this->open(0);

		$q = "SELECT SUM(cost) AS cost 
			FROM tbl_semad_report r LEFT JOIN tbl_project s ON s.id = r.semID 
			WHERE  semID = '".$id."' AND r.range_date >= s.start_date;";
		$r = $this->fetch($q);
		if ($s == null){
			$s['twodayscost'] = 0;
		}
		$this->close();
		$percent = ($r['cost']/$budget)*100;
		$remainingBudget = $budget-$r['cost'];
		// 		var_dump($percent);exit;
		$data = array(
				"cost" => round($r['cost'],2),
				"percent" => $percent,
				"budget" => round($remainingBudget,2)
		);
		//$data = json_encode($r);
		return $data;
	}
	function getClickPerDay($id){
		$this->open();
		$q = "SELECT click AS clicks, range_date FROM tbl_semad_report JOIN tbl_project WHERE  semID = '".$id."' AND tbl_semad_report.range_date >= tbl_project.start_date AND  range_date >= DATE_SUB(CURRENT_DATE, INTERVAL 10 DAY) GROUP BY range_date,campaign";
		//$q = "SELECT clicks, range_date FROM tbl_semad_summary JOIN tbl_project WHERE description = 'Total' AND tbl_project.id = '2' AND tbl_semad_summary.range_date >= tbl_project.start_date AND  range_date >= DATE_SUB(CURRENT_DATE, INTERVAL 10 DAY) GROUP BY range_date";
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
	function getCPCPerDay($id){
		$this->open();
		$q = "SELECT avg_cost AS avg_cpc, range_date FROM tbl_semad_report JOIN tbl_project WHERE  semID = '".$id."' AND tbl_semad_report.range_date >= tbl_project.start_date AND  range_date >= DATE_SUB(CURRENT_DATE, INTERVAL 10 DAY) GROUP BY range_date,campaign";
		//$q = "SELECT avg_cpc, range_date FROM tbl_semad_summary JOIN tbl_project WHERE description = 'Total' AND tbl_project.id = '2' AND tbl_semad_summary.range_date >= tbl_project.start_date AND  range_date >= DATE_SUB(CURRENT_DATE, INTERVAL 10 DAY) GROUP BY range_date";
		$data = $this->fetch($q,1);
		$this->close();
		//data [0] avg_cpc range_date 
		foreach($data as $val){
			$arr[$val['range_date']]+=$val['avg_cpc'];	
		}
		$data = null;
		foreach($arr as $key => $val){
		$data[] = array('avg_cpc'=>$val,'range_date'=>$key);
		}
		
// 		var_dump($data);exit;
		return $data;
		
	}
	function getCTRPerDay($id, $ctr, $kpi){
		$this->open();
		$q = "SELECT  click AS ctrs, range_date,impressions FROM tbl_semad_report r LEFT JOIN tbl_project s ON s.id = r.semID WHERE  semID = '".$id."' AND r.range_date >= s.start_date AND  range_date >= DATE_SUB(CURRENT_DATE, INTERVAL 5 DAY) AND campaign not in ('Search - Optimization-1','Search - Optimization-2') GROUP BY range_date,campaign";
		//$q = "SELECT ctr, range_date FROM tbl_semad_summary JOIN tbl_project WHERE description = 'Total' AND tbl_project.id = '2' AND tbl_semad_summary.range_date >= tbl_project.start_date AND  range_date >= DATE_SUB(CURRENT_DATE, INTERVAL 6 DAY) GROUP BY range_date";
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
// 		var_dump($data2);exit;
		return $data2;
	
	}
	function getSearchAndDisplay($id){
		$this->open();
		//$q = "SELECT SUM(ctr) AS ctrs, range_date FROM tbl_semad_report JOIN tbl_project WHERE tbl_project.id = '2' AND tbl_semad_report.range_date >= tbl_project.start_date AND  range_date >= DATE_SUB(CURRENT_DATE, INTERVAL 4 DAY) GROUP BY range_date";
		$q = "SELECT tbl_semad_summary.description, clicks AS clicks, ctr FROM tbl_semad_summary JOIN tbl_project WHERE tbl_semad_summary.description = 'Total - Search' OR tbl_semad_summary.description = 'Total - Display network' AND tbl_semad_summary.semID = tbl_project.id AND tbl_semad_summary.range_date = DATE_SUB(CURRENT_DATE, INTERVAL 0 DAY) AND tbl_semad_summary.semID = '".$id."' GROUP BY tbl_semad_summary.description";
		$data = $this->fetch($q,1);
		$this->close();
		// 		var_dump($data);exit;
		return $data;
	}
	function getCostPerDay($id){
		$this->open();
		$q = "SELECT cost AS costperhari, range_date 
		FROM tbl_semad_report r 
		LEFT JOIN tbl_project s ON s.id = r.semID 
		WHERE 
		r.range_date >= DATE_SUB(CURRENT_DATE, INTERVAL 5 DAY) 
		AND r.range_date >= s.start_date 
		AND s.id = '".$id."' 
		AND campaign not in ('Search - Optimization-1','Search - Optimization-2')  
		GROUP BY range_date, campaign";
		$data = $this->fetch($q,1);
		$this->close();
		foreach($data as $val){
			$arr[$val['range_date']]+=$val['costperhari'];	
		}
		$data = null;
		foreach($arr as $key => $val){
		$data[] = array('costperhari'=>$val,'range_date'=>$key);
		}
		
// 		var_dump($data);exit;
		return $data;
	}
	
}