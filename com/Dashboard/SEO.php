<?php
global $ENGINE_PATH;
include_once $ENGINE_PATH."Utility/Paginate.php";
include_once APP_PATH."Dashboard/SEOModel.php";
include_once APP_PATH."Dashboard/helper/dateHelper.php";
include_once APP_PATH."Dashboard/helper/countryNameHelper.php";
include_once APP_PATH."Dashboard/helper/youtubeChannelHelper.php";
class SEO extends SQLData{
	var $model;
	var $date;
	var $countryID;
	var $channelName;
	function __construct($req){
		parent::SQLData();
		$this->Request = $req;
		$this->View = new BasicView();
		$this->User = new UserManager();
		$this->model = new SEOModel();
		$this->date = new dateHelper();
		$this->countryID = new countryNameHelper();
		$this->channelName =  new youtubeChannelHelper();
	}
	function admin(){
		$id = $this->Request->getParam('id');
		$act = $this->Request->getParam('act');
		
		//Get Date Range From User
		$startRange = $this->Request->getPost('from');
		$endRange = $this->Request->getPost('to');
		$_SESSION['startRange'] = $startRange;
		$_SESSION['endRange'] = $endRange;
		
		$starts = $this->model->getKPI($id);
		
		//GA Credential
		if ($id != $_SESSION['project_id']){
			$_SESSION['project_id'] = $id;
			
			//Start Date
			$start = $starts['start_date'];
			$_SESSION['project_name'] = $starts['name'];
		}
		
		if ($id == $_SESSION['project_id'] && $act == null){
			return $this->main();
		}elseif($id == $_SESSION['project_id'] && $act == 'detail'){
			return $this->seoDetail();
		}
	}

	function main(){
		$id = $_SESSION['project_id'];
		
		//Get KPI project
		$kpi = $this->model->getKPI($id);
		$this->View->assign("kpi", $kpi["kpi"]);
		
		//Get Last Update
		$last = $this->model->getLastUpdate($id);
		$this->View->assign("lastUpdate", $last['lastUpdate']);
		
		//Date Range Format
		$starts = $_SESSION['startRange'];
		$ends = $_SESSION['endRange'];
		$start = substr($starts,6,4)."-".substr($starts,3,2)."-".substr($starts,0,2);
		$end = substr($ends,6,4)."-".substr($ends,3,2)."-".substr($ends,0,2);
		$startD = substr($starts,3,2)."/".substr($starts,0,2)."/".substr($starts,6,4);
		$endD = substr($ends,3,2)."/".substr($ends,0,2)."/".substr($ends,6,4);

		//Date Range Limit
		$this->View->assign("startDate", $kpi['start_date']);
		$this->View->assign("currDate", $last['lastUpdate']);
		$this->View->assign("currDate2", $last['end_date']);
		$this->View->assign("min7", $last['min7']);
		
		//Range Date
		$this->View->assign("startD", $startD);
		$this->View->assign("endD", $endD);
		
		//Assign Project ID
		$this->View->assign("id", $id);
			
		//Tab
		$this->View->assign("tabSEO", $kpi['seo']);
		$this->View->assign("tabSEM", $kpi['sem']);
		$this->View->assign("tabSOCIAL", $kpi['social']);
		
		//Total KPI Achievement
		$totalKPI = $this->model->getTotalKPI($id, $start, $end, $last['end_date']);
		$this->View->assign("kpiTotal", round($totalKPI,2));
		
		
		//Hits From Organic Search
		$totalHits = $this->model->getTotalView($id, $start, $end, $last['end_date']);
		$this->View->assign("totalHits", $totalHits);
		
		//Top Channel
		$top_channel = $this->model->getTopChannel($id, $start, $end, $last['end_date']);	
			$top_channel['playback_location'] = $this->channelName->youtubeChannel($top_channel['playback_location']);
			$top_channel_arr= array(
						"playback_location" => $top_channel['playback_location'],
						"views" => $top_channel['views'],
						"persen" => round($top_channel['persen'],2)
					);
		$this->View->assign("top_channel",$top_channel_arr);
		
		//Top Country
		$top_country = $this->model->getTopCountry($id, $start, $end, $last['end_date']);
		$top_country['country'] = $this->countryID->countryName($top_country['region']);
		$this->View->assign("topCountry", $top_country);
		
	//===CHART===//
		
		//Views
		$channel_month = $this->model->getChannelViewOneMonth($id, $start, $end, $last['end_date']);
		$kpiperhari = round($kpi["kpi"]/30,2);
		$this->View->assign("kpiHari", $kpiperhari);
		$this->View->assign("view", json_encode($channel_month));
		
		//Top Countries
		$country = $this->model->getCountry($id, $start, $end, $last['end_date']);
		foreach($country as $country5){
			$data5[] = array($this->countryID->countryName($country5['region']), intval($country5['views']));
		}
		$this->View->assign("countries", json_encode($data5));		
		
		//Top Channel
		$channelChart = $this->model->getTopChannelChart($id, $start, $end, $last['end_date']);
		foreach ($channelChart as $chan){
			$chan['playback_location'] = $this->channelName->youtubeChannel($chan['playback_location']);
			$channelTube[] = array($chan['playback_location'], intval($chan['views']));
		}
		$this->View->assign("channelChart", json_encode($channelTube));
		
		//Gender
		$genderTop = $this->model->getTopGender($id, $start, $end, $last['end_date']);
		foreach($genderTop as $x){
			$gender = $x['gender'] == "f"? 'Female':'Male';
			$genderData[] = array($gender, floatval($x['percent']));
		}
		$this->View->assign("getTopGender", json_encode($genderData));
		
		//Age
		$ageTop = $this->model->getTopAge($id, $start, $end, $last['end_date']);
		foreach($ageTop as $x){
			$ageData[] = array($x['age_group'], floatval($x['percent']));
		}
		$this->View->assign("getTopAge", json_encode($ageData));
		
		//Subscriber Overtime
		$channel_subscribers = $this->model->getChannelSubscribersOneMonth($id, $start, $end, $last['end_date']);
		$this->View->assign("so", $channel_subscribers);

		$this->View->assign("projectID", $_SESSION['project_id']);
		return $this->View->toString("dashboard/seo.html");
	}
	
	function seoDetail(){
		
		$id = $_SESSION['project_id'];
		$kpi = $this->model->getKPI($id);
		
		//Get KPI project
		$kpi = $this->model->getKPI($id);
		$this->View->assign("kpi", $kpi["kpi"]);
		
		//Get Last Update
		$last = $this->model->getLastUpdate($id);
		$this->View->assign("lastUpdate", $last['lastUpdate']);
		
		//Date Range Format
		$starts = $_SESSION['startRange'];
		$ends = $_SESSION['endRange'];
		$start = substr($starts,6,4)."-".substr($starts,3,2)."-".substr($starts,0,2);
		$end = substr($ends,6,4)."-".substr($ends,3,2)."-".substr($ends,0,2);
		$startD = substr($starts,3,2)."/".substr($starts,0,2)."/".substr($starts,6,4);
		$endD = substr($ends,3,2)."/".substr($ends,0,2)."/".substr($ends,6,4);
		
		//TAB
		$this->View->assign("tabSEO", $kpi['seo']);
		$this->View->assign("tabSEM", $kpi['sem']);
		$this->View->assign("tabSOCIAL", $kpi['social']);
		
		// DEMOGRAPHYCS
		$top10 = $this->model->getTop10Country();
		
		 foreach($top10 as $ten){
			$detail = $this->model->getDemographicStatsByCountry($_SESSION['project_id'], $ten['country']);
// 			$viewspercountry = $this->model->get10TotalViewsPerCountry($ten['region']);
// 			print '<pre>';
// 			print_r($detail);exit;
			$sumFemalePerAge = 0;
			$sumMalePerAge = 0;
			//FEMALE
			$female = array();
			for ($i=0;$i<7;$i++){
				if ($detail[0]['age_group'] != '13-17' && $i == 0){
					array_push($female, 0);
					array_push($female,  $detail[$i]['persen']);
					$stats = 1;
				}else if($stats == 1 && $i == 6){
					
				}else{
					array_push($female,  $detail[$i]['persen']);
				}
			}
			//MALE
			$stats=0;
			$range=14;
			$male = array();
			if ($detail[0]['age_group'] != '13-17' && $stats == 0){
				$i=6;
				array_push($male, $detail[$i]['persen']);
				$stats = 1;
				$range = 13;
			}
			for ($i=7;$i<$range;$i++){
				array_push($male, $detail[$i]['persen']);
			}
			
			
			
		
			//Calculate Percent per age
			for ($i=0;$i<7;$i++){
				$percentAge[$i] = $female[$i]+$male[$i];
				$sumFemalePerAge += $female[$i];
				$sumMalePerAge += $male[$i];
				//$totalviewage[]=$percentAge[$i];
			}
			//Calculate Percent per Gender
			$percentFemale = ($sumFemalePerAge);
			$percentMale = ($sumMalePerAge); 
			
			//Store Data per Country
			$demog[] = array(
					"country" => $ten['country'],
					"country_views"=>$ten['views'],
					"PercentPerAge"=>$percentAge,
					"FemalePercent" => $percentFemale,
					"MalePercent" => $percentMale
			);
// 			print '<pre>';
// 			print_r($male);
			unset($percentAge);
			unset($totalviewage);
			unset($male);
			unset($female);
			unset($detail);
			
		} 
				
// 		print '<pre>';
// 		print_r($female);exit;
		
		$this->View->assign("demograp", $demog);
		
		// TOP TRAFFIC
		$top_traffic = $this->model->topTraffic();
		// print '<pre>';
		// print_r($top_traffic);exit;
		
		//DAILY VIEWS
		$channel_month = $this->model->getChannelViewOneMonth($id, $start, $end, $last['end_date']);
		$kpiperhari = round($kpi["kpi"]/30,2);
		for ($i=0;$i<sizeof($channel_month);$i++){
			$daily[$i] = array(
						"date" => $this->date->dMyformat($channel_month[$i]['date']),
						"views" => $channel_month[$i]['views'],
						"target" => $kpiperhari
					);
			$totalViews += intval($channel_month[$i]['views']);
			$totalKPI += $kpiperhari;
		}
		
		//MONTHLY VIEW
		$monthlyView = $this->model->getMonthlyView();
		for ($i=0;$i<sizeof($monthlyView);$i++){
			$monthly[$i] = array(
						"month" => $this->date->mformat($monthlyView[$i]['month']),
						"views" => $monthlyView[$i]['view_month'],
						//asumsi KPI gk berubah per project
						"target" => $kpi["kpi"]
					);
		}
		
		//WEEKLY VIEW
		$weeklyView = $this->model->getWeeklyView();
		//var_dump($weeklyView);exit;
		$kpiperminggu = round($kpi["kpi"]/4,2);
		$j = sizeof($weeklyView)-1;
		for ($i=0;$i<sizeof($weeklyView);$i++){
			$weekly[$i] = array(
						"weeks" => "Week (".$weeklyView[$j]['week'].")",
						"views" => $weeklyView[$j]['views'],
						"target" => $kpiperminggu
					);
			$j--;
		}
		//var_dump($weekly);exit;
		
		//TOP TRAFFIC
		$top_traffic = $this->model->topTraffic();
		foreach ($top_traffic as $top){
			switch($top['source']){
				case "EXT_URL":
					$top['source'] = "External website";
				break;
				case "RELATED_VIDEO":
					$top['source'] = "YouTube suggested video";
				break;
				case "NO_LINK_EMBEDDED":
					$top['source'] = "Embedded player (unknown sources)";
				break;
				case "NO_LINK_VIRAL":
					$top['source'] = "Viral (unknown sources)";
				break;
				case "YT_SEARCH":
					$top['source'] = "YouTube Search";
				break;
				case "NO_LINK_MOBILE":
					$top['source'] = "Mobile apps and direct traffic (unknown sources)";
				break;
				case "YT_CHANNEL":
					$top['source'] = "YouTube Channel";
				break;
				case "YT_OTHER_PAGE":
					$top['source'] = "YouTube – other features";
				break;
				case "GOOGLE_SEARCH":
					$top['source'] = "Google Search";
				break;
				case "SUBSCRIBER":
					$top['source'] = "Subscriber";
				break;
				default:
				break;
			}
			$traffic[] = array(
						"source" => $top['source'],
						"views" => $top['views'],
						"percent" => round($top['persen'],2)
					);
		}
		
		//Daily Views
		$this->View->assign("daily", $daily);
		$this->View->assign("totViews", $totalViews);
		$this->View->assign("totKPI", $totalKPI);
		
		//Monthly Views
		$this->View->assign("monthly", $monthly);
		
		//Weekly Views
		$this->View->assign("weekly", $weekly);
		
		//Top Traffic
		$this->View->assign("top_traffic", $traffic);
		
		$this->View->assign("projectID", $_SESSION['project_id']);
		return $this->View->toString("dashboard/seo_detail.html");
	}
	
}