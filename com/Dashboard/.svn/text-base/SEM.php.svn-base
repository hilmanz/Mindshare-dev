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
		//Get Date Range From User
		$startRange = $this->Request->getPost('from');
		$endRange = $this->Request->getPost('to');
		$_SESSION['startRange'] = $startRange;
		$_SESSION['endRange'] = $endRange;
		
		
		$starts = $this->model->getStartDate($id);
		
		
		//GA Credential
		if ($id != $_SESSION['project_id']){
			$_SESSION['project_id'] = $id;
			
			//Start Date
			$start = $starts['start_date'];
			$_SESSION['project_name'] = $starts['name'];
		}
		
		if ($id == $_SESSION['project_id'] && $act == null){
			return $this->main();
		}
		
	}

	function main(){
		$ss = $_SESSION['project_id'];
		$starts = $_SESSION['startRange'];
		$ends = $_SESSION['endRange'];
		$start = substr($starts,6,4)."-".substr($starts,3,2)."-".substr($starts,0,2);
		$end = substr($ends,6,4)."-".substr($ends,3,2)."-".substr($ends,0,2);
		$startD = substr($starts,3,2)."/".substr($starts,0,2)."/".substr($starts,6,4);
		$endD = substr($ends,3,2)."/".substr($ends,0,2)."/".substr($ends,6,4);

		$this->View->assign("id", $ss);
		//Get Last Update
		$last = $this->model->getLastUpdate($ss);
		$this->View->assign("lastUpdate", $last['lastUpdate']);
		
		//Tab
		$tab = $this->model->getStartDate($ss);
		$this->View->assign("tabSEO", $tab['seo']);
		$this->View->assign("tabSEM", $tab['sem']);
		$this->View->assign("tabSOCIAL", $tab['social']);
		
		//Date Range Limit
		$this->View->assign("startDate", $tab['start_date']);
		$this->View->assign("currDate", $last['lastUpdate']);
		$this->View->assign("currDate2", $last['end_date']);
		$this->View->assign("min7", $last['min7']);
		
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
		$clickFromStart = $this->model->getTotalClickFromStart($ss, $kpi, $start, $end, $last['end_date']);
		$clickThisMonth = $this->model->getClickThisMonth($ss);
		$ctrFromStart = $this->model->getCTRFromStart($ss, $ctr, $start, $end, $last['end_date']);
		$costThisMonth = $this->model->getTotalCostThisMonth($ss, $cpc, $start, $end, $last['end_date']);
		$costFromStart = $this->model->getTotalCostFromStart($ss, $budget, $start, $end, $last['end_date']);
		$clickPerDay = $this->model->getClickPerDay($ss, $start, $end, $last['end_date']);
		$cpcPerDay = $this->model->getCPCPerDay($ss, $start, $end, $last['end_date']);
			$arrCPC = array();
			foreach ($cpcPerDay as $cpcperhari){
				array_push($arrCPC, $cpcperhari['avg_cpc']); 
			}
			$maxCPC = max($arrCPC)+0.1;
		$ctrPerDay = $this->model->getCTRPerDay($ss, $ctr, $kpi, $start, $end, $last['end_date']);
		$searchDisplay = $this->model->getSearchAndDisplay($ss, $start, $end, $last['end_date']);
		$expenditureCost = $this->model->getCostPerDay($ss, $dbgt, $start, $end, $last['end_date']);
 		
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
		$impact = $this->model->getImpactOnlineAsset($ss, $start, $end, $last['end_date']);
		$this->View->assign("impact", $impact);
// 		var_dump($result);exit;

		//campaignAssets
		$campaign = $this->model->getCampaignAsset($ss, $start, $end, $last['end_date']);
		$this->View->assign("assets", json_encode($campaign));

		
		//Top 10 Ads
		$topAds = $this->model->getTop10Ads($ss, $start, $end, $last['end_date']);
		$this->View->assign("topAds", $topAds);
// 		var_dump($topAds);exit;

		//Top 10 Keyword
		$topKey = $this->model->getTop10Keywords($ss, $start, $end, $last['end_date']);
		$this->View->assign("topKey", $topKey);
		
		//Range Date
		$this->View->assign("startD", $startD);
		$this->View->assign("endD", $endD);

		$this->View->assign("projectID", $_SESSION['project_id']);
		return $this->View->toString("dashboard/sem.html");
	}
}