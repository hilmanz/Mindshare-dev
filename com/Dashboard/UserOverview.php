<?php
global $ENGINE_PATH;
include_once "../config/config.inc.php";
include_once $ENGINE_PATH."Utility/gapi/gapi.class.php";

class UserOverview extends SQLData{
	function __construct($req){
		parent::SQLData();
		$this->Request = $req;
		$this->View = new BasicView();
		$this->User = new UserManager();
	}
	function admin(){
		$act = $this->Request->getParam('act');
		if( $act == 'new' ){
			
		}else{
			return $this->main();
		}
	}

	function main(){
		$yesterday = mktime(0,0,0,date("m"),date("d")-1,date("Y"));
		$twodaysago = mktime(0,0,0,date("m"),date("d")-2,date("Y"));
		$threedaysago = mktime(0,0,0,date("m"),date("d")-3,date("Y"));
		
		$ga = new gapi(ga_email,ga_password);
		
		$ga->requestReportData(ga_profile_id,array('country'),array('avgTimeOnSite','visitBounceRate','visits','visitors','newVisits'), null,null,
				date('2012-04-02'), // Start Date
				date("Y-m-d", $yesterday), // End Date
				1,  // Start Index
				500 // Max results
		);
		$gaResult  = array(
				'bounce_rate'=>$ga->getVisitBounceRate(),
				'avg_time'=>$ga->getAVGTimeOnSite(),
				'loyalty'=>round(($ga->getVisits()-$ga->getNewVisits())/$ga->getVisits()*100,2));
		
		$ga2 = new gapi(ga_email,ga_password);
		$ga2->requestReportData(ga_profile_id,array('country'),array('avgTimeOnSite','visitBounceRate','visits','visitors','newVisits'), null,null,
				date('2012-04-02'), // Start Date
				date("Y-m-d", $twodaysago), // End Date
				1,  // Start Index
				500 // Max results
		);
		$gaResult2  = array(
				'bounce_rate'=>$ga2->getVisitBounceRate(),
				'avg_time'=>$ga2->getAVGTimeOnSite(),
				'loyalty'=>round(($ga2->getVisits()-$ga2->getNewVisits())/$ga2->getVisits()*100,2));
		
	
		$listGa = array('yesterday' => $gaResult, 'twodaysago' => $gaResult2);
		//var_dump($listGa);
		
		//AVG time on site
		$yesterdays = $listGa["yesterday"]["avg_time"];
		$twodaysagos = $listGa["twodaysago"]["avg_time"];
		//var_dump($yesterdays);
		$this->View->assign("avg", $yesterdays);
		$avgTemp = (($yesterdays-$twodaysagos)/$yesterdays)*100;
		if (abs($avgTemp) <1){
			$avgArrow = round($avgTemp,2);
		}else{
			$avgArrow = round($avgTemp);
		}
		$avgPercentage = abs($avgArrow);
		$this->View->assign('avgPercentage', $avgPercentage);
		$this->View->assign('avgArrow', $avgArrow);
		
		//Loyalty
		$yesterdays = $listGa["yesterday"]["loyalty"];
		//var_dump($yesterdays);
		//print_r($yesterdays);
		$twodaysagos = $listGa["twodaysago"]["loyalty"];
		$this->View->assign("loyalty", $yesterdays);
		$loyArrow = round((($yesterdays-$twodaysagos)/$yesterdays)*100);
		$loyPercentage = abs($loyArrow);
		$this->View->assign('loyPercentage', $loyPercentage);
		$this->View->assign('loyArrow', $loyArrow);
		
		//Bounce Rate
		$yesterdays = $listGa["yesterday"]["bounce_rate"];
		$twodaysagos = $listGa["twodaysago"]["bounce_rate"];
		$this->View->assign("bounce", $yesterdays);
		$bArrow = round((($yesterdays-$twodaysagos)/$yesterdays)*100);
		$bPercentage = abs($loyArrow);
		$this->View->assign('bPercentage', $bPercentage);
		$this->View->assign('bArrow', $bArrow);
		
		//Activity Distribution
		$this->open(0);
		$rs = $this->fetch("SELECT date_d, activity_id, activity_name, percentage ,num, total FROM ".ReportDB.".rp_activity_dist_daily WHERE date_d = DATE_SUB(CURRENT_DATE, INTERVAL 1 DAY)",1);
		$rs2 = $this->fetch("SELECT date_d, activity_id, activity_name, percentage ,num, total FROM ".ReportDB.".rp_activity_dist_daily WHERE date_d = DATE_SUB(CURRENT_DATE, INTERVAL 2 DAY)",1);
		$this->close();

		$ad = (intval($rs[0]["total"]));
		$ad2 = (intval($rs2[0]["total"]));
		
		$this->View->assign("actDis", $ad);
		$adArrow = round((($ad-$ad2)/$ad)*100);
		$adPercentage = abs($adArrow);
		$this->View->assign('adPercentage', $adPercentage);
		$this->View->assign('adArrow', $adArrow);
		
		//Geographical Distribution
		$this->open(0);
		$rs = $this->fetch("SELECT date_d, location, percentage ,num, total FROM ".ReportDB.".rp_geo_dist_daily WHERE date_d = DATE_SUB(CURRENT_DATE, INTERVAL 1 DAY) LIMIT 10",1);
		//sample
		// $rs = $this->fetch("SELECT date_d, location, percentage ,num, total FROM ".ReportDB.".rp_geo_dist_daily WHERE date_d = '2012-03-30' LIMIT 10",1);
		$this->close();
		$data = json_encode($rs);
		//var_dump($data);
		// print_r("SELECT date_d, location, percentage ,num, total FROM ".ReportDB.".rp_geo_dist_daily WHERE date_d = '2012-03-30' LIMIT 10");exit;
		$this->View->assign('GD', $data);
		
		//GENDER/AGE
		$this->open(0);
		$male = $this->fetch("SELECT date_d, age_range, sex, people_count FROM ".ReportDB.".rp_overall_gender_daily WHERE sex = 'M' AND date_d = DATE_SUB(CURRENT_DATE, INTERVAL 1 DAY)",1);
		$female = $this->fetch("SELECT date_d, age_range, sex, people_count FROM ".ReportDB.".rp_overall_gender_daily WHERE sex = 'F' AND date_d = DATE_SUB(CURRENT_DATE, INTERVAL 1 DAY)",1);
		//sample
		// $male = $this->fetch("SELECT date_d, age_range, sex, people_count FROM ".ReportDB.".rp_overall_gender_daily WHERE sex = 'M' AND date_d = '2012-03-30'",1);
		// $female = $this->fetch("SELECT date_d, age_range, sex, people_count FROM ".ReportDB.".rp_overall_gender_daily WHERE sex = 'F' AND date_d = '2012-03-30'",1);
		$this->close();
		$rs = array('male' => $male, 'female' => $female);
		$data = json_encode($rs);
		//var_dump($data);exit;
		$this->View->assign('GENDER', $data);
		
		//Devices Used
		$this->open(0);
		$rs = $this->fetch("SELECT COUNT(device_name) AS num, device_name FROM ".ReportDB.".rp_user_device WHERE date_time = DATE_SUB(CURRENT_DATE, INTERVAL 1 DAY) GROUP BY device_name",1);
		$this->close();
		$data = json_encode($rs);
		$this->View->assign('DU', $data);
		
		//Brand Preference
		$this->open(0);
		$rs = $this->fetch("SELECT * FROM ".ReportDB.".rp_overall_brand_preference ORDER BY age ASC LIMIT 3",1);
		$this->close();
		$data = json_encode($rs);
		$this->View->assign('BP', $data);
		
		
		return $this->View->toString("RedRushWeb/dashboard/useroverview.html");
	}
	
}