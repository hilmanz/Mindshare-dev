<?php
	/*
	 * BOT YOUTUBE VIDEO DATA
	 * BABAR 17/Apr/2012
	 */
	 date_default_timezone_set('Europe/Paris');
	// DB CONNECTION

	$con = mysql_connect("localhost","root","coppermine");
	if (!$con){
	  die('Could not connect: ' . mysql_error());
	}
	// SELECT DB
	mysql_select_db("mindsharedb", $con);

	// $applicationId = "kana-reporting-01";
	// $clientId = "81290576560.apps.googleusercontent.com";
	// $developerKey = "AI39si54HjQDTYiJbogQq1TO1Pk6qQK4dKDkLDvQS9_pg7EiKZl2Gio-w1Y81LrWyEnvx4Wn44o0gPx_LWwuU6fqhZPYH9J1gA";
	// Enter your Google account credentials
	// $email = 'castrolasiapacific@gmail.com';
	// $passwd = '141sercon';
	
	// try {
		// $client = Zend_Gdata_ClientLogin::getHttpClient($email, $passwd,'youtube');
		// $client = Zend_Gdata_AuthSub::getHttpClient($apiKey);
		// $yt = new Zend_Gdata_YouTube($client,
		// $applicationId, null,
		// $developerKey);
		// $yt->setMajorProtocolVersion(2);
		
		// STEP 1 fetch video id
		$qvid = "SELECT video_id FROM channel_video_list GROUP BY video_id";
		$sql = mysql_query($qvid);
		while($r = mysql_fetch_object($sql)){
			$arr_vid[] = $r;
		}
		// $vidid = 'eaCnvnFVQVU';
		// print '<pre>';print_r($arr_vid);exit;
		
		//$tgl1 = '2012-03-16'; // sampai
		// $tgl2 = date('Y-m-d',strtotime('-7 days')); // dari
		
			// STEP 2 cek tgl
			
			foreach($arr_vid as $vid){
			$tgl2 = date('Y-m-d',strtotime('-4 days'));
			echo $tgl2.'|'.date('Y-m-d')."
			";
	
				echo $vid->video_id."
				";
				while ($tgl2 < date('Y-m-d',strtotime('-2 days'))){
				$vidid = $vid->video_id;
				$expl2 = explode('-',$tgl2);
				$tgl1 = date('Y-m-d', mktime(0, 0, 0,$expl2[1] , $expl2[2]+1, $expl2[0]));
				$id = $tgl1.$tgl2.$vidid;
				$cek = cekbotact($id);
				
				// JIKA BELUM DILAKUKAN
				if($cek==0){
						$stm = strtotime(date($tgl1.' 02:00:00'))*1000;
						$stm2 = strtotime(date($tgl2.' 02:00:00'))*1000;
						if(bot($id,$tgl1,$tgl2,$stm,$stm2,$vidid)==false){
							echo "Gagal parsing link 
							";
						}else{
						insertbotact($id);
						}
				}
				$expl = explode('-',$tgl2);
				$tgl2 = date('Y-m-d', mktime(0, 0, 0,$expl[1] , $expl[2]+1, $expl[0]));
				echo $tgl2.'|';
				}
		}
		 echo '
		 end of process | '.$tgl2;
		 exit;  
	
	// } catch (Zend_Gdata_App_CaptchaRequiredException $cre) {
		// echo 'URL of CAPTCHA image: ' . $cre->getCaptchaUrl() . "\n";
		// echo 'Token ID: ' . $cre->getCaptchaToken() . "\n";
	// } catch (Zend_Gdata_App_AuthException $ae) {
	   // echo 'Problem authenticating: ' . $ae->exception() . "\n";
	// }
	
	function cekbotact($id){
		$q = "SELECT COUNT(id) total FROM bot_activity WHERE id='".$id."' LIMIT 1";
		$sql = mysql_query($q);
		$r = mysql_fetch_object($sql);
		return $r->total;
	}
	
	function insertbotact($id){
		$q = "INSERT IGNORE INTO bot_activity (tgl_act,id) VALUES (NOW(), '".$id."')";
		return mysql_query($q);
	}
	
	function bot($id,$tgl1,$tgl2,$stm,$stm2,$vidid){
		set_time_limit(0);
		require_once 'Zend/Loader.php';
		include_once 'ReadCSV.php';
		require_once 'curl_class.php';
		$curl = new curl_class();
		
		Zend_Loader::loadClass('Zend_Gdata_YouTube');
		Zend_Loader::loadClass('Zend_Gdata_AuthSub');
		Zend_Loader::loadClass('Zend_Gdata_ClientLogin');
		Zend_Loader::loadClass('Zend_Gdata_App_Exception');
		
		$applicationId = "kana-reporting-01";
		$clientId = "81290576560.apps.googleusercontent.com";
		$developerKey = "AI39si54HjQDTYiJbogQq1TO1Pk6qQK4dKDkLDvQS9_pg7EiKZl2Gio-w1Y81LrWyEnvx4Wn44o0gPx_LWwuU6fqhZPYH9J1gA";
		// Enter your Google account credentials
		$email = 'castrolasiapacific@gmail.com';
		$passwd = '141sercon';
		
		$client = Zend_Gdata_ClientLogin::getHttpClient($email, $passwd,'youtube');
		// $client = Zend_Gdata_AuthSub::getHttpClient($apiKey);
		$yt = new Zend_Gdata_YouTube($client,
		$applicationId, null,
		$developerKey);
		$yt->setMajorProtocolVersion(2);
		
		$feeds = $yt->getVideoEntry($vidid);
		$link = $feeds->link[7]->href;
		$arr_link = explode('&',$link);
		if(!$arr_link) return false;
		$ls = $arr_link[0].'&'.$arr_link[1].'&'.$arr_link[2].'&'.$arr_link[3].'&user_starttime='.$stm2.'&user_endtime='.$stm.'&'.$arr_link[6].'&'.$arr_link[7].'&'.$arr_link[8];
		
		$name = $vidid.'_'.$tgl2.'_'.$tgl1;
		if($curl->copySecureFile($ls,"temp/".$name.".zip"))
			{
				echo "File transferred successfully. 
				";
				if(!is_dir('csv/'.$name)){
					mkdir('csv/'.$name);
				}
				
				$zip = new ZipArchive;
				 $res = $zip->open('temp/'.$name.'.zip');
				 if ($res === TRUE) {
					 $zip->extractTo('csv/'.$name.'/');
					 $zip->close();
					 @unlink('temp/'.$name.'.zip');
					 echo "unzipped 
					 ";
					 echo "-------------------------------------- 
					 ";
					 $file_csv = 'csv/'.$name.'/'.$vidid.'_'.$tgl2.'-'.$tgl2.'_world_views_1.csv';
					 
					 $read = ReadCSV($file_csv);
					 $total = count($read);
					 
					 $sukses = 0;
					 $gagal = 0;
					 foreach($read as $i => $r){
						if($i<1)continue;
						$q = "INSERT IGNORE INTO video_raw (date,region,videoID,title,views,unique_users,unique_users_7,unique_users_30,popularity,comments,favorites,rate1,rate2,rate3,rate4,rate5) 
								VALUES ('".$r[0]."', '".$r[1]."', '".$r[2]."', '".$r[3]."', '".$r[4]."', '".$r[5]."', '".$r[6]."', '".$r[7]."', '".$r[8]."', '".$r[9]."', '".$r[10]."', 
								'".$r[11]."', '".$r[12]."','".$r[13]."', '".$r[14]."', '".$r[15]."')";
								echo $q." 
								";
						if(mysql_query($q)){
							$sukses = $sukses+1;
						}else{
							$gagal = $gagal+1;
						}
						
					 }
					 echo "  Sukses : ".$sukses." 
					 ";
					 echo "  Gagal : ".$gagal." 
					 ";
					 return true;
				 } else {
					 echo "unzip failed 
					 ";
					 return false;
					 
				 }
				
			}
			else
			{
				echo "File transfer failed. 
				";
				return false;
				
			}	
			return false;
			// exit;
	}
	mysql_close($con);
		// if($tgl2 >= date('Y-m-d'))echo "end process \n ";
?>