<?php
	/*
	 * BOT DEMOGSTATS
	 */
	
	set_time_limit(0);
	  date_default_timezone_set('Europe/Paris');
	$con = mysql_connect("localhost","root","coppermine");
	if (!$con){
	  die('Could not connect: ' . mysql_error());
	}
	// SELECT DB
	mysql_select_db("mindsharedb", $con);
	
	// GET TOTAL VIEWS
	echo "GET TOTAL VIEWS...
	";
	$q = "SELECT SUM(views) tv
			FROM video_raw
			WHERE DATE >= '2012-03-15'
			";
	$sql = mysql_query($q);
	$r = mysql_fetch_object($sql);
	$tv = $r->tv;
	echo 'Total Views : '.$tv.'
	';
	// exit;
	
	// GET DEMOGRAPHIC DATA
	echo "GET DEMOGRAPHY DATA....
	";
	$q = "SELECT videoID,gender,age_group, SUM(percentage) p
			FROM demography_raw 
			WHERE start_date >= '2012-03-15'
			GROUP BY videoID,gender,age_group";
	$sql = mysql_query($q);
	$tp = 0;
	while($r = mysql_fetch_object($sql)){
		$data[] = $r;
		$tp = $tp+$r->p; // GET DATA TOTAL PERSEN
	}
	print '<pre>'; 
	// echo count($data);exit;
	// print 'Total Percent : '.$tp;print_r($data);exit;
	// $dt = array();
	
	// GET PERSEN ASLI
	echo 'GET PERSEN ASLI..
	';
	echo count($data)."
	";
	foreach($data as $key => $d){
		$data[$key]->pa = itungPA($d->p,$tp);
	}
	// print_r($data);exit;
	
	// GET VIEWS
	echo 'GET VIEWS..
	';
	foreach($data as $key => $d){
		$data[$key]->views = itungViews($d->pa,$tv);
	}
	// print_r($data);exit;
	
	echo 'SAVING DATA TO TABLE demography_temp..
	';
	if($data!=''){
		if(mysql_query('truncate demography_temp')){
			echo 'SUCCESS TRUNCATE TABLE demography_temp
			';
			$sukses = 0;
			$gagal = 0;
			foreach($data as $d){
				$q = "INSERT INTO demography_temp (videoID,gender,age_group,persen,persen_asli,views)
					  VALUES ('".$d->videoID."', '".$d->gender."', '".$d->age_group."', '".$d->p."', '".$d->pa."', '".$d->views."')";
				echo $q."
				";
				 if(mysql_query($q)){
					$sukses = $sukses+1;
				}else{
					$gagal = $gagal+1;
				}
			}
			echo 'SUKSES INPUT : '.$sukses.'
			';
			echo 'GAGAL INPUT : '.$gagal.'
			'; 
		}else{
			echo 'FAILED TRUNCATE TABLE demography_temp
			';
		}
	}
	
	
	echo "Fetching data from table demography_temp...
	";
	$q2 = "SELECT gender,age_group,SUM(persen) p, SUM(persen_asli) pa, SUM(views) v FROM demography_temp GROUP BY gender,age_group";
	// echo $q;exit;
	$sql2 = mysql_query($q2);
	while($r = mysql_fetch_object($sql2)){
		$data2[] = $r;
	}
	// print_r($data2);exit;
	 if($data2){
		echo 'DATA DAPET! COOL..
		';
		if(mysql_query('truncate demography_temp2')){
			echo 'SUCCESS TRUNCATE TABLE demography_temp2
			';
			$sukses2 = 0;
			$gagal2 = 0;
			foreach($data2 as $d2){
				$q = "INSERT INTO demography_temp2 (gender,age_group,persen,persen_asli,views)
					  VALUES ('".$d2->gender."', '".$d2->age_group."', '".$d2->p."', '".$d2->pa."', '".$d2->v."')";
				echo $q."
				";
				 if(mysql_query($q)){
					$sukses2 = $sukses2+1;
				}else{
					$gagal2 = $gagal2+1;
				}
			}
			echo 'SUKSES INPUT : '.$sukses2.'
			';
			echo 'GAGAL INPUT : '.$gagal2.'
			'; 
		}else{
			echo 'FAILED TRUNCATE TABLE demography_temp2
			';
		}
	}else{
		echo 'GAK DAPET DATA... CRAAAAPPP!
		';
	}
	
	// GET DATA SUM VIEWS/REGION
	echo 'GET REGION DATA...<br>CALCULATING PERSEN...
	';
	$q3 = "SELECT region, SUM(views) total
		FROM video_raw
		GROUP BY region";
	$sql3 = mysql_query($q3);
	$trv = 0;
	while($r3 = mysql_fetch_object($sql3)){
		$data3[] = $r3;
		$trv = $trv+$r3->total;
	}
	print '<pre>';
	// print $trv.'<br>';
	// print_r($data);exit;
	
	foreach($data3 as $key => $d3){
		$data3[$key]->persen = ($d3->total/$trv)*100;
	}
	// print_r($data);exit;
	echo 'FETCHING DATA FROM demography_temp2..
	';
	$qr = "SELECT * FROM demography_temp2";
	$sqlr = mysql_query($qr);
	while($rr = mysql_fetch_object($sqlr)){
		$data4[] = $rr;
	}
	
	echo 'COOKING DATA..
	';
	foreach($data4 as $d4){
		foreach($data3 as $d3){
			$mateng = intval($d4->views*$d3->persen)/100;
			$result[$d3->region][$d4->gender][$d4->age_group] = $mateng;
		}
	}
	// print_r($result);
	// exit;
	echo 'DATA MATENG! TARAAAAA..
	';
	echo 'TRUNCATE DATA youtube_demography..
	';
	if(mysql_query('truncate youtube_demography')){
		echo 'SUCCESS TRUNCATE DATA youtube_demography..
		';
		echo 'SAVING DATA..
		';
		
				$sukses3 = 0;
				$gagal3 = 0;
		foreach($result as $reg => $rs){
			foreach($rs as $gen => $rs2){
				foreach($rs2 as $age => $val){
					$qData = "INSERT INTO youtube_demography (region,gender,age_group,total_views) 		
					VALUES ('{$reg}','{$gen}','{$age}',{$val})
					";
					echo $qData."
					";
					if(mysql_query($qData)){
					$sukses3 = $sukses3+1;
					}else{
					$gagal3 = $gagal3+1;
					}
				}
			}
		}
		echo "Sukses : ".$sukses3."
		";
		echo "Gagal : ".$gagal3."
		";
		echo 'FINISH!!!! Fiuuuh....
		';
	}else{
		echo 'FAILED TRUNCATE DATA youtube_demography..
		';
	}
	
	// hitung persentasi asli
	function itungPA($p,$tp){
		$pa = ($p/$tp)*100;
		return $pa;
	}
	// function views
	function itungViews($pa,$tv){
		$v = ($pa/100)*$tv;
		return intval($v);
	}
	
	mysql_close($con); 
?>