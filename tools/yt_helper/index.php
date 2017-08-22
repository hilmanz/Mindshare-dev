<?php
	/*
	 * Example Youtube Helper
	 * @author Babar
	 */
	 $var = simplexml_load_file('http://gdata.youtube.com/feeds/api/users/CastrolAsiaPacific/uploads');
	 print "<pre>";
	 foreach($var->entry as $val){
		 $video = $val->id[0];
		 $video = str_replace('http://gdata.youtube.com/feeds/api/videos/','',$video);
		 $vid[] = $video;
	 }
	 // print_r($vid);
	 foreach($vid as $v){
		echo $v."<br>";
	 }
	 exit;
	 include "YoutubeHelper.php";
	 $query = "CastrolAsiaPacific"; //==> Your search query
	 $yt = new YoutubeHelper($query);
	 
	 //==== FOR CHANNEL ====//
	 
	 // GET ALL CHANNEL TITLE
	 $title = $yt->getChannelTitle();
	 echo "CHANNEL : ". $title;
	 // GET ALL CHANNEL TITLE
	 echo "<hr>";
	 // GET ALL CHANNEL STATS
	 $stats = $yt->getChannelStatistics();
	 echo "STATISTICS : <pre>";print_r($stats);
	 // GET ALL CHANNEL STATS
	 echo "<hr>";
	 // GET ALL CHANNEL SUBSCRIBER
	 $subs = $yt->getChannelSubscriber();
	 echo "SUBSCRIBER: ". $subs;
	 // GET ALL CHANNEL SUBSCRIBER
	 echo "<hr>";
	 // GET ALL CHANNEL VIEWS
	 $views = $yt->getChannelViews();
	 echo "VIEWS: ". $views;
	 // GET ALL CHANNEL VIEWS
	 echo "<hr>";
	 // GET ALL CHANNEL DATA
	 $channel = $yt->getChannel();
	 print_r('<pre>');
	 print_r($channel);
	 // GET ALL CHANNEL DATA
	 
	 //==== FOR CHANNEL ====//
	 
	 //==== FOR VIDEO ====//
	 // $vid = $yt->getVideo();
	 // $thumb = $yt->getVideoThumb();
	 // $stats = $yt->getVideoStatistics();
	 
	 // VIDEO TITLE
	 // echo "<strong>Video Title : </strong>".$yt->getVideoTitle();
	 // echo "<hr>";
	 
	 // echo "<strong>VIDEO THUMBNAIL</strong>";
	 // print "<pre>";
	 // print_r($thumb);
	 // print "</pre>";
	 // echo "<hr>";
	 
	 // echo "<strong>VIDEO STATISTICS</strong>";
	 // print "<pre>";
	 // print_r($stats);
	 // print "</pre>";
	 // echo "<hr>";
	 
	 // echo "<strong>VIDEO DETAIL</strong>";
	 // print "<pre>";
	 // print_r($vid);
	 // print "</pre>";
	 // exit;
	  //==== FOR VIDEO ====//
?>