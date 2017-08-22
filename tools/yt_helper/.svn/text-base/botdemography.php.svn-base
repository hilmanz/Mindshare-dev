<?php
	set_time_limit(0);
	/*
	 * BOT VIDEO DEMOGRAPHY
	 * BABAR 18/APR/2012
	 */
	 // DB CONNECTION
	 date_default_timezone_set('Europe/Paris');
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
		$tgl2 = $exp[2];
		$length = strlen($d)-22;
		$id = substr($d,0,$length);
		$folder = $csvdir."/".$d."/";
		$file = $id.'_demographics_1.csv';
		// echo $folder.$file."<br>";
		$open = scandir($folder);
		if(is_file($folder.$file)){
			$read = ReadCSV($folder.$file);
			// print_r($read);
			// exit;
			foreach($read as $i => $rd){
				if($i<1)continue;
				$range = $rd[0]."_".$rd[2]."_".$rd[3]."_".$tgl."_".$tgl2;
				// cek exist atau gak
				$qcek = "SELECT COUNT(id) total FROM bot_demography WHERE act_value='".$range."' LIMIT 1";
				$sql = mysql_query($qcek);
				$rcek = mysql_fetch_object($sql);
				// echo $rcek->total;exit;
				if($rcek->total==0){
					$q = "INSERT IGNORE INTO demography_raw (videoID,title,gender,age_group,percentage,start_date,end_date) 
							VALUES ('".$rd[0]."','".$rd[1]."','".$rd[2]."','".$rd[3]."','".$rd[4]."','".$tgl."','".$tgl2."')";
					echo  $q."<br>";
					
					if(mysql_query($q)){
						
						$qa = "INSERT IGNORE INTO bot_demography (act_value) VALUES ('".$range."')";
						echo  $qa."<br>";
						if(mysql_query($qa)){
							echo $rd[1].": SUKSES INPUT demography raw &amp; track bot<br>";
							// exit;
						}else{
							echo $rd[1]."GAGAL INPUT demography raw &amp; track bot<br>";
						}
					}else{
						echo $rd[2]."GAGAL INPUT demography raw<br>";
					}
				}
				// end cek
			}
			// exit;
		}else{
			echo $folder.$file.' : File ga ada<br>';
		}
	}
	mysql_close($con);
?>