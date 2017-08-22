<?php
	// BOT SEM impactOnOnlineAssest
	include "../../config/config.inc.php";
	global $ENGINE_PATH;
	global $CONFIG;
	
	// define('ga_email',$CONFIG['GA']['da4b9237bacccdf19c0760cab7aec4a8359010b0']['username']);
	// define('ga_password',$CONFIG['GA']['da4b9237bacccdf19c0760cab7aec4a8359010b0']['password']);
	// define('ga_profile_id',$CONFIG['GA']['da4b9237bacccdf19c0760cab7aec4a8359010b0']['profileid']);
	
	define('ga_email','beranikotoritubaik@gmail.com');
	define('ga_password','rinsoindonesia');
	define('ga_profile_id','52558708');
	// echo ga_email."<br>".ga_password."<br>".ga_profile_id;exit;
	
	// if(file_exists("../../engines/Utility/gapi/gapi.class.php"))echo "ada";exit;
	include_once "../../engines/Utility/gapi/gapi.class.php";
	$ga = new gapi(ga_email,ga_password);

	
	$con = mysql_connect($CONFIG['DATABASE'][0]['HOST'],$CONFIG['DATABASE'][0]['USERNAME'],$CONFIG['DATABASE'][0]['PASSWORD']);
	if (!$con){
	  die('Could not connect: ' . mysql_error());
	}
	mysql_select_db($CONFIG['DATABASE'][0]['DATABASE'], $con);
	
	//===========================================================>
	// STEP 1 tentukan tanggal
	$proID = 2; // Project ID
	$tgl = "2012-02-27";
	$yesterday = date("Y-m-d",mktime(0,0,0,date("m"),date("d")-1,date("Y")));
	// print_r($tgl.'|'.$yesterday);exit;
	// STEP 2 Object gapi inisiate
	$ga = new gapi(ga_email,ga_password);
	// print '<pre>'; print_r($ga);exit;
	
	$filter ="medium==cpa || medium==cpc || medium==cpm || medium==cpp || medium==cpv || medium==ppc";
	// $ga->requestReportData(ga_profile_id,array('source','medium'),array('visits'), null,$filter,
		$ga->requestReportData(ga_profile_id,array('source','medium','date'),array('visits'), array('date'),$filter,
		                       $tgl, // Start Date
		                       $yesterday, // End Date
		                       1,  // Start Index
		                       500 // Max results
		                       );
							   
		             
		$gaResult  = $ga->getResults();
		foreach($gaResult as $key => $res){
			$data1[$key]['date'] = $res->getDate();
			$data1[$key]['visits'] = $res->getVisits();
			$data1[$key]['medium'] = $res->getMedium();
			$data1[$key]['source'] = $res->getSource();
			$q = "INSERT INTO tbl_sem_paidsearch (proID, day, visits, medium, source) 
					VALUES ('".$proID."','".$res->getDate()."','".$res->getVisits()."','".$res->getMedium()."','".$res->getSource()."')";
			mysql_query($q);
		}
		print'<pre>';print_r($data1);
		
	//All Visits
		$ga2 = new gapi(ga_email,ga_password);
		$ga2->requestReportData(ga_profile_id,array('date'),array('visits'), array('date'),null,
				$tgl, // Start Date
				$yesterday, // End Date
				1,  // Start Index
				500 // Max results
		);
		$gaResult2  = $ga2->getResults();
		foreach($gaResult2 as $k => $res2){
			$data2[$k]['date'] = $res2->getDate();
			$data2[$k]['visits'] = $res2->getVisits();
			$q = "INSERT INTO tbl_sem_allvisits (proID, day, visits) 
					VALUES ('".$proID."','".$res->getDate()."','".$res->getVisits()."')";
			mysql_query($q);
		}
		echo '<hr>';print_r($data2);exit;
	
	mysql_close($con);
?>