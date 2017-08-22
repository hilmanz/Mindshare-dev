<?php
global $ENGINE_PATH;
include_once $ENGINE_PATH."Utility/Paginate.php";
include_once APP_PATH."Dashboard/SocialModel.php";
require_once $APP_PATH."Dashboard/helper/wordcloudHelper.php";
class Social extends SQLData{
	var $model;
	function __construct($req){
		parent::SQLData();
		$this->Request = $req;
		$this->View = new BasicView();
		$this->User = new UserManager();
		$this->model = new SocialModel();
	}
	function admin(){
		$id = $this->Request->getParam('id');
		$act = $this->Request->getParam('act');
		$twit = $this->Request->getParam('twitID');
		$_SESSION['twitterID'] = $twit;
		
		//Get Date Range From User
		$startRange = $this->Request->getPost('from');
		$endRange = $this->Request->getPost('to');
		$_SESSION['startRange'] = $startRange;
		$_SESSION['endRange'] = $endRange;
		
		//FB Detail
		$fbDetails = $this->model->getFBPageDetails($id);
		$_SESSION['fbPageName'] = $fbDetails['fbName'];
		
		//Session ID
		if ($id != $_SESSION['project_id']){
			$_SESSION['project_id'] = $id;
		}
		
		if ($id == $_SESSION['project_id'] && $act == null && $twit == null){
			return $this->main();
		}else if ($id == $_SESSION['project_id'] && $act =="fb"){
			return $this->fbDetail();
		}else if ($id == $_SESSION['project_id'] && $act =="twit"){
			return $this->twitDetail();
		}else if ($id == $_SESSION['project_id'] && $_SESSION['twitterID'] == $twit){
			return $this->popupProfile($id, $twit);
		}
		
	}

	function main(){
		$id = $_SESSION['project_id'];
		$fb = $_SESSION['fbPageName'];
		$this->View->assign('fbPageName', $fb);

		//Buzz volume
		$totalSentiment = $this->model->getTWSentimentTotal($id);
		$totalBuzz = intval($totalSentiment['plus'])+intval($totalSentiment['minus'])+intval($totalSentiment['normal']);
		$this->View->assign("buzzVolume", $totalBuzz);
		
		//Unique People
		$totalPeople = $this->model->getTWCountPeople($id);
		$unique = intval($totalPeople['unik']);
		$this->View->assign("uniquePeople", $unique);
		
		//Sentiment Daily
		unset($category);
		$data = $this->model->getTWSentimentDaily($id);
		foreach ($data as $dat){
			$tgl = substr($dat["tgl"], 8, 2)."/".substr($dat["tgl"], 5, -3)."/".substr($dat["tgl"], 0, -6);
			$category[] = $tgl;
			$positive[] = intval($dat['plus']);
			$negatif[] = intval($dat['minus']);
			$neutral[] = intval($dat['normal']);
		}
		$senPart = array(
					"category" => $category,
					"positive" => $positive,
					"negatif" => $negatif,
					"neutral" => $neutral
					);
		 // var_dump(json_encode($senPart));exit;
		$this->View->assign("sentiment", json_encode($senPart));
		
		//Sentiment
		unset($category);
		$data = $this->model->getTWSentiment($id);
		foreach ($data as $dat){
			$positive[] = intval($dat['plus']);
			$negatif[] = intval($dat['minus']);
			$neutral[] = intval($dat['normal']);
		}
		$senPart = array(
					"positive" => $positive,
					"negatif" => $negatif,
					"neutral" => $neutral
					);
		// var_dump(json_encode($folPart));exit;
		$this->View->assign("sentimentoverall", json_encode($senPart));
		
		//Channels
		$data = $this->model->getChannels($id);
		$channel = array(
					"twitter" => intval($data['twitter']),
					"facebook" => intval($data['facebook']),
					"blog" => intval($data['blog'])
					);
		$this->View->assign("getChannels", json_encode($channel));			
		
		//Top Countries
		$data = $this->model->getTWTopCountries($id);
		foreach ($data as $dat){
			$countries[$dat['country_name']] = intval($dat['mentions']);
		}
		// var_dump(json_encode($countries));exit;
		$this->View->assign("getCountries", json_encode($countries));	
		
		//Wordcloud
		$data = $this->model->getTWWordcloud($id);
		// var_dump($data);
		$rs = array();
		$m=0;
		foreach($data as $w){
			$m = max($m,intval($w['total']));
			$mm = min($m,intval($w['total']));
			
			$rs[] = array(
						"txt"=>$w['keyword'],
						"amount"=>intval($w['total']),
						"weight"=>intval($w['total']),
						"url"=>$link,
						"is_main"=>null,
						"sentiment"=>intval($w['sentiment']),
						"title"=> "Click to see detailed analysis"
						);
		}
		
		foreach($rs as $n=>$v){
			
			$weight = ceil(($v['amount']/($m-$mm))*9);
			$rs[$n]['weight'] = $weight;
			$rs[$n]['max'] = $m;
			$rs[$n]['min'] = $mm;
		}
		// print ('<pre>');
		// print_r($rs);exit;
		
		$wordcloud = new wordcloudHelper(470,370);
		$wordcloud->urlto=$link;
		$wordcloud->setHandler('homewordcloud');
		$wordcloud->set_sentiment_style(array("positive"=>"wcstat1","negative"=>"wcstat2","neutral"=>"wcstat0","main_keyword"=>"wcstat3"));
		$this->View->assign("wordcloud",$wordcloud->draw($rs));
		
		//Conversations
		$conversation = $this->model->getTWConversations($id);
		$this->View->assign("conversation", $conversation);
		
		//Keyword
		$keyword = $this->model->getTWKeyword($id);
		$this->View->assign("keyword", $keyword);
		
		//KOL
		$kolPositif = $this->model->getTWKOL($id, 1);
		$this->View->assign("kolPlus", $kolPositif);
		$kolNegatif = $this->model->getTWKOL($id, -1);
		$this->View->assign("kolMinus", $kolNegatif);
		$kolNeutral = $this->model->getTWKOL($id, 0);
		$this->View->assign("kolNetral", $kolNeutral);

		
		//Tab
		$this->View->assign("tabSEO", 0);
		$this->View->assign("tabSEM", 0);
		$this->View->assign("tabSOCIAL", 1);
		
		$this->View->assign("userID", $_SESSION['project_id']);
		$this->View->assign("page", "project");
		return $this->View->toString("dashboard/social.html");
	}
	
	function fbDetail(){
		$id = $_SESSION['project_id'];
		$fb = $_SESSION['fbPageName'];
		$this->View->assign('fbPageName', $fb);
		
		//Project Detail
		$project = $this->model->getProjectDetail($id);
		$this->View->assign("projectName", $project);
		
		//Tab
		$this->View->assign("tabSEO", 0);
		$this->View->assign("tabSEM", 0);
		$this->View->assign("tabSOCIAL", 1);
		
		//Summary
		$summary = $this->model->getFBTotalVolume($id);
		$this->View->assign('likes',intval($summary['likefan']));
		$this->View->assign('story',intval($summary['story']));
		$this->View->assign('postSum',intval($summary['post']));
		$reachTotal = $this->model->getFBReachTotal($id);
		$totalReach = intval($reachTotal['organic'])+intval($reachTotal['paid'])+intval($reachTotal['viral']);
		$this->View->assign('reachSum', $totalReach);
		
		//Volume
		unset($category);
		$volume = $this->model->getFBVolume($id);
		// var_dump($volume);exit;
		foreach ($volume as $cat){
			$tgl = substr($cat["tgl"], 8, 2)."/".substr($cat["tgl"], 5, -3)."/".substr($cat["tgl"], 0, -6);
			$category[] = $tgl;
			$like[] = intval($cat["likefan"]);
			$story[] = intval($cat["story"]);
			$post[] = intval($cat["post"]);
		}
		$volumePart = array(
					"category" => $category,
					"like" => $like,
					"story" => $story,
					"post" => $post
					);
		// var_dump(json_encode($volumePart));exit;
		$this->View->assign("volume", json_encode($volumePart));
		
		//VISIT
		unset($category);
		$visit = $this->model->getFBVisit($id);
		foreach ($visit as $vis){
			$tgl = substr($vis["tgl"], 8, 2)."/".substr($vis["tgl"], 5, -3);
			$category[] = $tgl;
			$all[] = intval($vis['visitAll']);
			$uni[] = intval($vis['visitUnique']);
		}
		$visitPart = array(
					"category" => $category,
					"all" => $all,
					"unique" => $uni
					);
		$this->View->assign("visit", json_encode($visitPart));
		
		//REACH
		unset($category);
		$reach = $this->model->getFBReach($id);
		foreach ($reach as $rea){
			$tgl = substr($rea["tgl"], 8, 2)."/".substr($rea["tgl"], 5, -3);
			$category[] = $tgl;
			$organic[] = intval($rea["organic"]);
			$paid[] = intval($rea["paid"]);
			$viral[] = intval($rea["viral"]);
		}
		$reachPart = array(
					"category" => $category,
					"organic" => $organic,
					"paid" => $paid,
					"viral" => $viral
					);
		// var_dump($reachPart);exit;
		$this->View->assign("reach", json_encode($reachPart));
		
		//Demography
		unset($category);
		$demography = $this->model->getFBDemography($id);
		$i=0;
		foreach ($demography as $demog){
			$gender[] = substr($demog['age'],0,1);
			if ($gender[$i] == 'M'){
				$male[] = intval($demog['nilai']);
				$age[] = substr($demog['age'],2,5);
			}else{
				$female[] = intval($demog['nilai']);
			}
			$i++;
		}
		$demogPart = array(
					"category" => $age,
					"female" => $female,
					"male" => $male
					);
		// var_dump(json_encode($demogPart));exit;
		$this->View->assign("demog", json_encode($demogPart));
		
		//Location
		unset($category);
		$location = $this->model->getFBLocation($id);
		// var_dump(json_encode($locPart));exit;
		$this->View->assign("location", json_encode($location));
		
		//POSTS
		$post = $this->model->getFBPost($id);
		// var_dump(json_encode($locPart));exit;
		$this->View->assign("post", $post);
		
		//CITIES
		$cities = $this->model->getFBCity($id);
		$this->View->assign("cities", $cities);
		
		$this->View->assign("userID", $_SESSION['project_id']);
		$this->View->assign("page", "project");
		return $this->View->toString("dashboard/fb_detail.html");
	}
	function twitDetail(){
		$id = $_SESSION['project_id'];
		$fb = $_SESSION['fbPageName'];
		$this->View->assign('fbPageName', $fb);
		
		//Summary
		$summary = $this->model->getTWVolumeTotal($id);
		$this->View->assign('mentions', intval($summary['mention']));
		$this->View->assign('retweet', intval($summary['retwit']));
		$impression = $this->model->getTWTotalImpression($id);
		$totalImpresi = intval($impression['impresi'])+intval($impression['rt']);
		$this->View->assign("potentialImpression", $totalImpresi);
		
		//Unique People
		$totalPeople = $this->model->getTWCountPeople($id);
		$unique = intval($totalPeople['unik']);
		$this->View->assign("uniquePeople", $unique);
		
		//Volume (mention, people, RTs)
		$data = $this->model->getTWVolume($id);
		foreach ($data as $dat){
			$category[] = substr($dat["tgl"], 8, 2)."/".substr($dat["tgl"], 5, -3)."/".substr($dat["tgl"], 0, -6);
			$mention[] = intval($dat['mention']);
			$people[] = intval($dat['person']);
			$rt[] = intval($dat['retwit']);
		}
		$volPart = array(
					"category" => $category,
					"mentions" => $mention,
					"people" => $people,
					"rts" => $rt
					);
		$this->View->assign("volume", json_encode($volPart));
		
		//Followers
		unset($category);
		$data = $this->model->getTWFollower($id);
		foreach ($data as $dat){
			$category[] = substr($dat["tgl"], 8, 2)."/".substr($dat["tgl"], 5, -3)."/".substr($dat["tgl"], 0, -6);
			$follower[$dat['author']][] = intval($dat['jml']);
		}
		$folPart = array(
					"category" => $category,
					"follower" => $follower
					);
		// var_dump(json_encode($folPart));exit;
		$this->View->assign("follower", json_encode($folPart));
		
		//Sentiment
		unset($category);
		$data = $this->model->getTWSentiment($id);
		foreach ($data as $dat){
			$positive[] = intval($dat['plus']);
			$negatif[] = intval($dat['minus']);
			$neutral[] = intval($dat['normal']);
		}
		$senPart = array(
					"positive" => $positive,
					"negatif" => $negatif,
					"neutral" => $neutral
					);
		// var_dump(json_encode($folPart));exit;
		$this->View->assign("sentiment", json_encode($senPart));
	
		//Wordcloud
		$data = $this->model->getTWWordcloud($id);
		// var_dump($data);
		$rs = array();
		$m=0;
		foreach($data as $w){
			$m = max($m,intval($w['total']));
			$mm = min($m,intval($w['total']));
			
			$rs[] = array(
						"txt"=>$w['keyword'],
						"amount"=>intval($w['total']),
						"weight"=>intval($w['total']),
						"url"=>$link,
						"is_main"=>null,
						"sentiment"=>intval($w['sentiment']),
						"title"=> "Click to see detailed analysis"
						);
		}
		
		foreach($rs as $n=>$v){
			
			$weight = ceil(($v['amount']/($m-$mm))*9);
			$rs[$n]['weight'] = $weight;
			$rs[$n]['max'] = $m;
			$rs[$n]['min'] = $mm;
		}
		// print ('<pre>');
		// print_r($rs);exit;
		
		$wordcloud = new wordcloudHelper(470,370);
		$wordcloud->urlto=$link;
		$wordcloud->setHandler('homewordcloud');
		$wordcloud->set_sentiment_style(array("positive"=>"wcstat1","negative"=>"wcstat2","neutral"=>"wcstat0","main_keyword"=>"wcstat3"));
		$this->View->assign("wordcloud",$wordcloud->draw($rs));
		
		
		//Conversations
		$conversation = $this->model->getTWConversations($id);
		$this->View->assign("conversation", $conversation);
		
		//Countries
		$location = $this->model->getTWCountries($id);
		$this->View->assign("location", $location);
		
		//Tab
		$this->View->assign("tabSEO", 0);
		$this->View->assign("tabSEM", 0);
		$this->View->assign("tabSOCIAL", 1);
		
		$this->View->assign("userID", $_SESSION['project_id']);
		$this->View->assign("page", "project");
		return $this->View->toString("dashboard/twit_detail.html");
	}
	function popupProfile($id, $twitID){
		$id = 16;
		$proDetails = $this->model->getTWProfileDetails($id, $twitID);
		$totalImpression = $this->model->getTotalImpression($id);
		$percentage = (intval($proDetails['impression'])/intval($totalImpression['total']))*100;
		
		$peopleRank = $this->model->getTWPeopleRank($id, $twitID);
		
		$response = file_get_contents("https://api.twitter.com/1/users/show.json?screen_name=".$proDetails['author_id']);
		$profile_obj = json_decode($response);
		$author_timezone = $profile_obj->time_zone;
		$author_location = $profile_obj->location;
		$author_about = $profile_obj->description;
		$arr_raw = explode(":",$author_location);
		$arr_loc = @explode(",",$arr_raw[1]);
		if(is_array($arr_loc)){
			$coordinate_x = @trim($arr_loc[0]);
			$coordinate_y = @trim($arr_loc[1]);
		}


		if(floatval($proDetails['coordinate_x'])>0||floatval($proDetails['coordinate_y'])>0){

			//check from our database first
			
			//not found, so we use google.
			$uri = "https://maps.googleapis.com/maps/api/geocode/json?latlng=".$proDetails['coordinate_x'].",".$proDetails['coordinate_y']."&sensor=false";
			
			$glmap_response = file_get_contents($uri);

			$map_obj = json_decode($glmap_response);
			
			if($map_obj->status=="OK"){

				$address = $map_obj->results[0]->formatted_address;

				$author_location = $address;
			}else{
				//try our geo database
				$sql = "SELECT country,iso FROM geo_country 
					WHERE {$proDetails['coordinate_x']} BETWEEN y1 AND y2 AND {$proDetails['coordinate_y']}
					BETWEEN x1 AND x2 LIMIT 100";
				$this->open(0);
				$geo = $this->fetch_many($sql,1);
				$this->close();
				if(sizeof($geo)==1){
					$author_location = $geo[0]['country'];
				}
			}

			
		}else if(floatval($coordinate_x)>0||floatval($coordinate_y)>0){
			$uri = "https://maps.googleapis.com/maps/api/geocode/json?latlng=".$coordinate_x.",".$coordinate_y."&sensor=false";
			
			$glmap_response = file_get_contents($uri);
			$map_obj = json_decode($glmap_response);
			
			if($map_obj->status=="OK"){
				$address = $map_obj->results[0]->formatted_address;
				$author_location = $address;
			}else{
				//try our geo database
				$sql = "SELECT country,iso FROM smac_data.geo_country 
					WHERE {$coordinate_x} BETWEEN y1 AND y2 AND {$coordinate_y}
					BETWEEN x1 AND x2 LIMIT 100;";
				$this->open(0);
				$geo = $this->fetch_many($sql,1);
				$this->close();

				if(sizeof($geo)==1){
					$author_location = $geo[0]['country'];
				}
			}
		}
		
		
		$data = $proDetails;
		$data['percentage'] = round($percentage,4);
		$data['rank'] = $peopleRank['rank'];
		$data['location'] = $author_location;
		$data['details'] = $author_about;
		$json = json_encode($data);
		echo $json;exit;
	}
}