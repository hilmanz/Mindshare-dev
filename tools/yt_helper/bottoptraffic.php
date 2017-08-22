<?php
	/*
	 * BOT TOP TRAFFIC SOURCE
	 * BABAR - 18 APRIL 2012
	 */
	 
	 set_time_limit(0);
	  date_default_timezone_set('Europe/Paris');
	$con = mysql_connect("localhost","root","coppermine");
	if (!$con){
	  die('Could not connect: ' . mysql_error());
	}
	// SELECT DB
	mysql_select_db("mindsharedb", $con);
	
	// GET THE DATA
	$q = "SELECT source_type, SUM(referred_views) views FROM traffic_raw GROUP BY source_type ORDER BY views DESC;";
	$sql = mysql_query($q);
	while($r = mysql_fetch_object($sql)){
		$data[] = $r;
	}
	
	// CLEAR TABLE JIKA DAPAT DATA
	if($data!=null){
		// TRUNCATE TABLE
		$trun = mysql_query('truncate top_traffic');
		if($trun){
			echo 'Success truncate table
			';
			$sukses = 0;
			$gagal = 0;
			// PROSES INPUT DATA
			foreach($data as $dt){
				if(mysql_query("INSERT INTO top_traffic (source,views) VALUES ('".$dt->source_type."','".$dt->views."')")){
					$sukses = $sukses+1;
				}else{
					$gagal = $gagal+1;
				}
			}
			// MESSAGE AFTER INPUT DATA
			echo "Success Input : ".$sukses." data 
			";
			echo "Failed Input : ".$gagal." data 
			";
		}else{
			// IF FAILED TRUNCATE DATA
			echo 'Failed truncate table
			';
		}
	}
	
	// CLOSE CONNECTION
	mysql_close($con);
?>