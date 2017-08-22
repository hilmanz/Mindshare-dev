<?php
	set_time_limit(0);
	/*
	 * BOT DEMOGRAFI BARU
	 * BABAR 07/MEI 2012
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
	$proID = 1;
	$csvdir = "dcsv";
	$dir = scandir($csvdir);
	// print_r($dir);exit;
	foreach($dir as $k => $d){
		
		if($d=='.' || $d=='..')continue;
		// $tgl = substr($d,-22);
		$exp = explode('.',$d);
		// print_r($exp);exit;
		$tgl = $exp[1];
		// $tgl2 = $exp[2];
		if($tgl >= date('Y-m-d',strtotime('-2 days'))) continue ;
		
		$file = $csvdir."/".$d;
		echo $file."<br>
		";
		if(is_file($file)){
			$read = ReadCSV($file);
			foreach($read as $i => $rd){
				if($i<1)continue;
				// echo $rd[0];exit;
				$q = "INSERT IGNORE INTO demography_final (proID,tgl,tgl_demog,country,age_group,gender,persen) 
						VALUES ('".$proID."',NOW(),'".$tgl."','".$rd[0]."','".$rd[1]."','".$rd[2]."','".$rd[3]."')";
				if(mysql_query($q)){
					echo $q." SUKSES! <br>";
				}else{
					echo $q." GAGAL! <br>";
				}
			}
		}else{
			echo $file.' : File ga ada
			';
		}
	}
	mysql_close($con);
?>