<?php
global $ENGINE_PATH;
include_once "../config/config.inc.php";
include_once $ENGINE_PATH."Utility/Paginate.php";
include_once $ENGINE_PATH."Utility/gapi/gapi.class.php";
include_once APP_PATH."Dashboard/SEMModel.php";
class SEM extends SQLData{
	var $model;
	var $ga_email;
	var $ga_password;
	var $ga_profile_id;
	function __construct($req){
		parent::SQLData();
		$this->Request = $req;
		$this->View = new BasicView();
		$this->User = new UserManager();
		$this->model = new SEMModel();
	}
	function admin(){
		$id = $this->Request->getParam('id');
		$act = $this->Request->getParam('act');
		
		//GA Credential
		if ($id != $_SESSION['project_id']){
			$_SESSION['project_id'] = $id;
			//Start Date
			$starts = $this->model->getStartDate($id);
			$start = $starts['start_date'];
			$_SESSION['project_name'] = $starts['name'];
			
			global $CONFIG;
			$hashID = sha1($_SESSION['project_id']+$_SESSION['project_name']);
			
			$this->ga_email = $CONFIG['GA'][$hashID]['username'];
			$this->ga_password = $CONFIG['GA'][$hashID]['password'];
			$this->ga_profile_id = $CONFIG['GA'][$hashID]['profileid'];
			
			if ($this->ga_email != "" && $this->ga_password != "" && $this->ga_profile_id != ""){
				$_SESSION['impact'] = $this->impactOnOnlineAssest($start, $this->ga_email, $this->ga_password, $this->ga_profile_id);
				$_SESSION['assets'] = $this->campaignAssetPerform($start, $this->ga_email, $this->ga_password, $this->ga_profile_id);
			}else{
				$_SESSION['impact'] = "";
				$_SESSION['assets'] = "";	
			}
		}
		
		if ($id == $_SESSION['project_id'] && $act == null){
			return $this->main();
		}
		
	}

	function main(){
		$ss = $_SESSION['project_id'];
		//Get Last Update
		$last = $this->model->getLastUpdate($ss);
		$this->View->assign("lastUpdate", $last['lastUpdate']);
// 		var_dump($last);exit;
		
		//Tab
		$tab = $this->model->getStartDate($ss);
		$this->View->assign("tabSEO", $tab['seo']);
		$this->View->assign("tabSEM", $tab['sem']);
		$this->View->assign("tabSOCIAL", $tab['social']);
		
		//BUDGET
		$budget = $this->model->getBudget($ss);
		$budget = intval($budget['budget']);
		
		//KPI click
		$type = 'click';
		$kpis = $this->model->getKPI($ss, $type);
		$kpi = floatval($kpis['kpi']);
		
		//CTR target
		$type = 'ctr';
		$ctr = $this->model->getKPI($ss, $type);
		$ctr = floatval($ctr['kpi']);
		
		//CPC target
		$type = 'cpc';
		$cpc = $this->model->getKPI($ss, $type);
		$cpc = floatval($cpc['kpi']);
		
		//Daily Budget target
		$type = 'budget';
		$bgt = $this->model->getKPI($ss, $type);
		$dbgt = floatval($bgt['kpi_daily']);
//  	var_dump($dbgt);exit;

// 		$getCampaignDuration = $this->model->getCampaignDuration($ss);
		$clickFromStart = $this->model->getTotalClickFromStart($ss, $kpi);
		$clickThisMonth = $this->model->getClickThisMonth($ss);
		$ctrFromStart = $this->model->getCTRFromStart($ss, $ctr);
		$costThisMonth = $this->model->getTotalCostThisMonth($ss, $cpc);
		$costFromStart = $this->model->getTotalCostFromStart($ss, $budget);
		$clickPerDay = $this->model->getClickPerDay($ss);
		$cpcPerDay = $this->model->getCPCPerDay($ss);
			$arrCPC = array();
			foreach ($cpcPerDay as $cpcperhari){
				array_push($arrCPC, $cpcperhari['avg_cpc']); 
			}
			$maxCPC = max($arrCPC)+0.1;
		$ctrPerDay = $this->model->getCTRPerDay($ss, $ctr, $kpi);
		$searchDisplay = $this->model->getSearchAndDisplay($ss);
		$expenditureCost = $this->model->getCostPerDay($ss, $dbgt);
 		//var_dump($clickFromStart);exit;
 		$this->View->assign("kpiClick", floatval($kpis['kpi_daily']));
		$this->View->assign("clickFromStart", $clickFromStart);
		$this->View->assign("clickThisMonth", $clickThisMonth);
		$this->View->assign("ctrFromStart", $ctrFromStart);
		$this->View->assign("costThisMonth", $costThisMonth);
		$this->View->assign("costFromStart", $costFromStart);
		$this->View->assign("clickPerday", json_encode($clickPerDay));
		$this->View->assign("cpcPerDay", json_encode($cpcPerDay));
		$this->View->assign("maxCPC", $maxCPC);
		$this->View->assign("ctrPerDay", json_encode($ctrPerDay));
		$this->View->assign("searchdisplay", json_encode($searchDisplay));
		$this->View->assign("expenditure", json_encode($expenditureCost));
		
		//Google Analytic API
		$impact = $_SESSION['impact'];
		$result = round(($impact['paid_search']/$impact['all_search'])*100,2);	
		$this->View->assign("impact", $result);
// 		var_dump($result);exit;

		//campaignAssets
		$campaign = $_SESSION['assets'];
		$this->View->assign("assets", json_encode($campaign));
// 		print "<pre>";
// 		print_r($campaign);exit;
		//var_dump(json_encode($campaign));exit;
		
		//Top 10 Ads
		$topAds = $this->model->getTop10Ads($ss);
		$this->View->assign("topAds", $topAds);
// 		var_dump($topAds);exit;

		//Top 10 Keyword
		$topKey = $this->model->getTop10Keywords($ss);
		$this->View->assign("topKey", $topKey);

		$this->View->assign("projectID", $_SESSION['project_id']);
		return $this->View->toString("dashboard/sem.html");
	}
	
	function impactOnOnlineAssest($tgl, $email, $pssword, $profile){
		$yesterday = mktime(0,0,0,date("m"),date("d")-1,date("Y"));
		//Paid Search
		$ga = new gapi($email,$pssword);
		$filter ="medium==cpa || medium==cpc || medium==cpm || medium==cpp || medium==cpv || medium==ppc";
		$ga->requestReportData($profile,array('source','medium'),array('visits'), null,$filter,
		                       $tgl, // Start Date
		                       date("Y-m-d", $yesterday), // End Date
		                       1,  // Start Index
		                       500 // Max results
		                       );
		$gaResult  =$ga->getVisits();
		
		//All Visits
		$ga2 = new gapi($email,$pssword);
		$ga2->requestReportData($profile,array('country'),array('visits'), null,null,
				$tgl, // Start Date
				date("Y-m-d", $yesterday), // End Date
				1,  // Start Index
				500 // Max results
		);
		$gaResult2  = $ga2->getVisits();
		
		
 		$listGa = array("paid_search" => $gaResult, "all_search" => $gaResult2);
		
		return $listGa;
	}
	
	function campaignAssetPerform($tgl, $email, $pssword, $profile){
		$yesterday = mktime(0,0,0,date("m"),date("d")-1,date("Y"));
		$fivedaysago = mktime(0,0,0,date("m"),date("d")-5,date("Y"));
		//Paid Search
		$ga = new gapi($email,$pssword);
		$filter ="medium==cpa || medium==cpc || medium==cpm || medium==cpp || medium==cpv || medium==ppc";
		$ga->requestReportData($profile,array('source','medium','date'),array('visits'), array('date'),$filter,
				 $tgl, // Start Date
		         date("Y-m-d", $yesterday), // End Date
				1,  // Start Index
				500 // Max results
		);
		$gaTemp = array();
		$tmpTgl = $tgl;
		foreach ($ga->getResults() as $result){
			$firtsDate = $result->getDate();
			while(strtotime($tmpTgl) < strtotime($firtsDate)) {
				$startDate = strtotime($tmpTgl);
				$currentDate= strtotime($firtsDate);
				$modDate = date('Ymd',($startDate + ($currentDate - $currentDate)));
				
				$gaTemp[] = array('datee' => $modDate,'visits' => 0);
				
				
				$date = strtotime(date("Y-m-d", strtotime($date)) . " +1 day");
				$tmpTgl = date('Ymd',strtotime(date("Ymd", strtotime($tmpTgl)) . " +1 day"));
// 				echo $tmpTgl.' | ';
			}
			$tmpTgl = date('Ymd',strtotime(date("Ymd", strtotime($result->getDate())) . " +1 day"));
			$gaTemp[] = array('datee' => $result->getDate(),'visits' => $result->getVisits());
			
		}
		$gaResult = $gaTemp;
	
		//All Visits per day
		$ga2 = new gapi($email,$pssword);
		$ga2->requestReportData($profile,array('date'),array('visits'), array('date'),null,
				 $tgl, // Start Date
		         date("Y-m-d", $yesterday), // End Date
				1,  // Start Index
				500 // Max results
		);
		
		$gaTemp2 = array();
		$i=0;
		foreach ($ga2->getResults() as $result){
			$gaTemp2[$i] = array('datee' => $result->getDate(),'visits' => $result->getVisits());
		$i++;
		}
		$gaResult2 = $gaTemp2;
// 		var_dump($gaResult);exit;
	
		// arr['20120229'] = array ('paid'=>132,'all'=>987);
	
		$listGa = array("paid_search" => $gaResult, "all_search" => $gaResult2);
//		var_dump($listGa);exit;
		
		return $listGa;
	}
}