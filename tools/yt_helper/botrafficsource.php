<?php
	set_time_limit(0);
	/*
	 * BOT VIDEO TRAFFIC SOURCE
	 * BABAR 18/APR 2012
	 */
	 date_default_timezone_set('Europe/Paris');
	 // DB CONNECTION
	$con = mysql_connect("localhost","root","coppermine");
	if (!$con){
	  die('Could not connect: ' . mysql_error());
	}
	// SELECT DB
	mysql_select_db("mindsharedb", $con);
	include_once "ReadCSV.php";
	print '<pre>';
	$csvdir = "csv";
	$dir = scandir($csvdir);
	// print_r($dir);exit;
	foreach($dir as $d){
		
		if($d=='.' || $d=='..')continue;
		$tgl = substr($d,-22);
		$exp = explode('_',$tgl);
		$tgl = $exp[1];
		if($tgl >= date('Y-m-d',strtotime('-2 days'))) continue ;
		$length = strlen($d)-22;
		$id = substr($d,0,$length);
		$folder = $csvdir."/".$d."/";
		$file = $id.'_'.$tgl.'-'.$tgl.'_world_referrers_1.csv';
		echo $folder.$file."
		";
		$open = scandir($folder);
		if(is_file($folder.$file)){
			$read = ReadCSV($folder.$file);
			// print_r($read);
			foreach($read as $i => $rd){
				if($i<1)continue;
				$range = $rd[0]."_".$rd[1]."_".$rd[2]."_".$rd[4];
				// cek exist atau gak
				$qcek = "SELECT COUNT(id) total FROM bot_traffic WHERE act_value='".$range."' LIMIT 1";
				$sql = mysql_query($qcek);
				$rcek = mysql_fetch_object($sql);
				// echo $rcek->total;exit;
				if($rcek->total==0){
					$q = "INSERT IGNORE INTO traffic_raw (date,region,videoID,title,source_type,Detail,referred_views) 
							VALUES ('".$rd[0]."','".$rd[1]."','".$rd[2]."','".$rd[3]."','".$rd[4]."','".$rd[5]."','".$rd[6]."')";
					echo  $q."
					";
					if(mysql_query($q)){
						
						$qa = "INSERT IGNORE INTO bot_traffic (act_value) VALUES ('".$range."')";
						echo  $qa."
						";
						if(mysql_query($qa)){
							echo $rd[1].": SUKSES INPUT traffic raw &amp; track bot
							";
							// exit;
						}else{
							echo $rd[1]."GAGAL INPUT traffic raw &amp; track bot
							";
						}
					}else{
						echo $rd[2]."GAGAL INPUT traffic raw
						";
					}
				}
			}
			// exit;
		}else{
			echo $folder.$file.' : File ga ada
			';
		}
	}
	mysql_close($con);
?>