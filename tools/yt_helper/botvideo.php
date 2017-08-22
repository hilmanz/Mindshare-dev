<?php
	/*
	 * BOT VIDEO
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
	 
		$gcomments = 'gd$comments';
		$gfeedlink = 'gd$feedLink';
		$ystatistic = 'yt$statistics';
	// GET LIST VIDEO 
	$q = "SELECT * FROM channel_video_list WHERE channel_id='".$query."' ORDER BY id DESC LIMIT 25";
	$sql = mysql_query($q);
	while($r = mysql_fetch_array($sql)){
		$vid = $r['video_id'];
		$yt = new YoutubeHelper($vid);
		$title = $yt->getVideoTitle();
		$thumb = $yt->getVideoThumb();
		// print_r($thumb[0]->url);exit;
		$thumbb = $thumb[0]->url;
		// echo $thumbb;exit;
		$entry = $yt->getVideo();
		$tcomment = $entry->$gcomments->$gfeedlink->countHint;
		$view = $entry->$ystatistic->viewCount;
		$q = "INSERT INTO channel_video_stats (channel_id,video_id,video_title,thumbnail,comments,views,date,date_ts) 
			  VALUES ('".$query."','".$vid."','".$title."','".$thumbb."','".$tcomment."','".$view."',NOW(),NOW())";
		$input = mysql_query($q);
		if($input){echo $vid." Sukses<br>";}else{echo $vid." Gagal<br>";}
	}
	
	 mysql_close($con);
?>