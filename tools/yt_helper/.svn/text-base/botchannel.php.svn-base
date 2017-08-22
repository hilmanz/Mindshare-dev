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
	  
	 include "YoutubeHelper.php";
	 $query = "CastrolAsiaPacific"; //==> Your search query
	 $api_key = "AI39si54HjQDTYiJbogQq1TO1Pk6qQK4dKDkLDvQS9_pg7EiKZl2Gio-w1Y81LrWyEnvx4Wn44o0gPx_LWwuU6fqhZPYH9J1gA"; //==> API KEY
	 $yt = new YoutubeHelper($query);

	 echo "Fetching data from Youtube Channel : ".$query;
	 echo "<br>===================================================<br>";
	 // GET ALL CHANNEL TITLE
	 $title = $yt->getChannelTitle();
	 echo "CHANNEL NAME : ". $title;
	 echo "<hr>";
	 // GET ALL CHANNEL SUBSCRIBER
	 $subs = $yt->getChannelSubscriber();
	 echo "TOTAL SUBSCRIBER : ". $subs;
	 // GET ALL CHANNEL SUBSCRIBER
	 echo "<hr>";
	 // GET ALL CHANNEL VIEWS
	 $views = $yt->getChannelViews();
	 echo "TOTAL VIDEO VIEWS: ". $views;
	 // GET ALL CHANNEL VIEWS
	 echo "<hr>";
	 // GET LIST VIDEO
	 $listvid = $yt->getChannelVideoID();
	 echo "LIST VIDEO ID: <br>";
	 foreach($listvid as $list){
		echo $list."<br>";
	 }
	 
	
	 // GET LIST VIDEO
	 echo "<br>===================================================<br>";
	 $q = "INSERT IGNORE INTO channel_stats (channel_id,channel_name,channel_total_subscriber,channel_total_view,date,date_ts) 
			VALUES ('".$query."','".$title."', '".$subs."', '".$views."', NOW(), NOW())";
	$input = mysql_query($q);
			
	if($input){
		echo "<b>SUBMIT CHANNEL DATA SUCCED!</b>";
		echo "<br>===================================================<br>";
		foreach($listvid as $list){
			$q2 = "INSERT IGNORE INTO channel_video_list (channel_id,video_id,date,date_ts) 
					VALUES ('".$query."','".$list."',NOW(),NOW())";
			$input2 = mysql_query($q2);
			if($input2){
			echo $list." Sukses 
			";
			}	else{
			echo $list." Gagal
			";
			}
		}
		 	// $get_yesterday_views = "SELECT channel_total_view FROM channel_stats WHERE date = DATE_SUB(CURRENT_DATE,INTERVAL 1 DAY) LIMIT 1";
			// $yestedayViews = mysql_fetch_object(mysql_query($get_yesterday_views));
			// $daily_views_video = "INSERT IGNORE INTO tbl_daily_views (views,date_time,	date_time_ts,channel) 
			// VALUES ('".($yestedayViews->views-$views)."',NOW(), '".time()."', '".$query."')";
			// $qinsertViewDaily = mysql_query($daily_views_video);
	}
	else{echo "<b>SUBMIT CHANNEL DATA FAILED</b>".mysql_error;}
	
	mysql_close($con);
?>