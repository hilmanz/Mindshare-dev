<?php
	/*
	 * BOT CHANNEL
	 * @author Babar
	 */
	 error_reporting(0);
	$con = mysql_connect("localhost","root","coppermine");
	if (!$con)
	  {
	  die('Could not connect: ' . mysql_error());
	  }
	  mysql_select_db("mindsharedb", $con);
	  //channel_total_subscriber | channel_total_view | date       | date_ts    
// CastrolAsiaPacific | 1RC50zu8dG9Ttk3l16jViw |         7 | 2012-04-14 | 2012-04-13 15:36:19 
	$data ="SELECT channel_total_subscriber,date,date_ts from channel_stats order by date asc";
	$qData = mysql_query($data);

	$subcribeLama  = 0;
	$i = 0;
	while($row = mysql_fetch_object($qData)){
	if($i==0)$subcribeLama  = $row->channel_total_subscriber - 7;
	if($row->date >= date('Y-m-d',strtotime('-1 days'))) exit;
	$subscribe =$row->channel_total_subscriber - $subcribeLama ;
	
	//channel_name       |              |  |        | date_ts  
	 $q = "INSERT IGNORE INTO channel_subscribers (channel_name,channel_id,subscribe,date,date_ts) 
			VALUES ('CastrolAsiaPacific','1RC50zu8dG9Ttk3l16jViw', '".$subscribe."', '".$row->date."', '".$row->date_ts."') ";
	echo $q.$row->channel_total_subscriber;
	if($row->date >='2012-04-15') $input = mysql_query($q);
	$subcribeLama = $row->channel_total_subscriber;
	$i++;
	}
	
	
	mysql_close($con);
?>