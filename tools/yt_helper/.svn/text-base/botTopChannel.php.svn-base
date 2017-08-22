<?php
	/*
	 * BOT TOP CHANNEL
	 * @author Babar
	 */
	 error_reporting(0);
	$con = mysql_connect("localhost","root","coppermine");
	if (!$con)
	  {
	  die('Could not connect: ' . mysql_error());
	  }
	  mysql_select_db("mindsharedb", $con);
	  
	  echo 'Fetching data from geography_raw.... 
	  ';
	  $q = "SELECT player_location AS playback_location,SUM(views) views FROM  geography_raw GROUP BY player_location ORDER BY views DESC;";
	  $sql = mysql_query($q);
	  $td = 0;
	  while($r = mysql_fetch_assoc($sql)){
		$data[] = $r;
		$td = $td+$r['views'];
	  }
	  // print '<pre>'.$td;
	  // print_r($data);
	  // exit;
	  echo 'CALCULATING PERSENAN...
	  ';
	  foreach($data as $key => $d){
		$data[$key]['persen'] = ($d['views']/$td)*100;
	  }
	  // print '<pre>'.$td;
	  // print_r($data);
	  // exit;
	    if(mysql_query('truncate top_channel')){
		  echo 'TRUNCATE TABLE...
		  ';
		  echo 'SAVING TO DATABASE...
		  ';
		  $sukses = 0; $gagal=0;
		  foreach($data as $key => $d){
			  $q = "INSERT INTO top_channel (playback_location,views,persen) VALUES ('".$d['playback_location']."','".$d['views']."','".$d['persen']."')";
				echo $q.'
				';
			  if(mysql_query($q)){
				$sukses = $sukses+1;
			  }else{
				$gagal = $gagal+1;
			  }
		  }
		  echo 'SUKSES : '.$sukses.'
		  ';
		  echo 'GAGAL : '.$gagal.'
		  ';
		}else{
			echo 'TRUNCATE FAILED...
		  ';
		}
	  mysql_close($con);
?>