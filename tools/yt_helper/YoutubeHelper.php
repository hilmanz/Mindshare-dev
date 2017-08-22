<?php
	/*
	 *==========================================
	 * YOUTUBE API HELPER
	 * @author: Babar @.@
	 *==========================================
	 */
	 include_once 'curl_class.php';

	 class YoutubeHelper{
	 
		var $BASE_URL;
		var $query;
		var $API_URL;
		var $API_KEY;
		var $t = '$t';
		var $mgroup = 'media$group';
		var $mthumb = 'media$thumbnail';
		var $gcomments = 'gd$comments';
		var $gfeedlink = 'gd$feedLink';
		var $ystatistic = 'yt$statistics';
		var $attr = '@attributes';
		var $curl ;
		
		function __construct($q,$api_key){
			$this->query = $q;
			$this->query = str_replace(" ", "+", $this->query);
			$this->API_URL = 'http://gdata.youtube.com/feeds/api/';
			$this->API_KEY = $api_key;
			$this->BASE_URL = 'http://localhost/mindshare-dashboard/trunk/tools/yt_helper/';
			//curl class
			$this->curl = new curl_class;
		}
		
		function getVideo(){
			$arr = json_decode($this->curl->get($this->API_URL.'videos?alt=json&q='.$this->query.'&key='.$this->API_KEY));
			$entry = $arr->feed->entry[0];
			return $entry;
		}
		
		function getVideoTitle(){
			$entry = $this->getVideo();
			$t = $this->t;
			$title = $entry->title->$t;
			return $title;
		}
		
		function getVideoThumb(){
			$entry = $this->getVideo();
			$mg = $this->mgroup;
			$mt = $this->mthumb;
			$thumb = $entry->$mg->$mt;
			$result = array("thumb"=>$thumb);
			return $thumb;
		}
		
		function getVideoStatistics(){
			$entry = $this->getVideo();
			$ys = $this->ystatistic;
			$stats = $entry->$ys;
			return $stats;
		}
		
		function XMLChannel($filename){
			$handle = fopen($filename, 'w') or die("can't open file");
			$xml = $this->curl->get($this->API_URL.'users/'.$this->query);
			$potongan = array("yt:","gd:","media:");
			$channel = str_replace($potongan,'',$xml);
			fwrite($handle, $channel);
			fclose($handle);
		}
		
		function getChannel(){
			$filename = "report/".$this->query."-".date('d-m-Y').".xml";
			$file = $this->XMLChannel($filename);
			$var = simplexml_load_file($filename);
			return $var;
		}
		
		function getChannelTitle(){
			$channel = $this->getChannel();
			$title = $channel->title;
			return $title;
		}
		
		function getChannelStatistics(){
			$channel = $this->getChannel();
			$statistics = $channel->statistics;
			$statistics = array("statistics"=>$statistics);
			return $statistics;
		}
		
		function getChannelSubscriber(){
			$channel = $this->getChannel();
			$statistics = $channel->statistics;
			$subs = $statistics['subscriberCount'][0];
			return $subs;
		}
		
		function getChannelViews(){
			$channel = $this->getChannel();
			$statistics = $channel->statistics;
			$subs = $statistics['totalUploadViews'][0];
			return $subs;
		}
		
		function getChannelVideoID(){
			$var = simplexml_load_file($this->API_URL.'users/'.$this->query.'/uploads');
			foreach($var->entry as $val){
				 $video = $val->id[0];
				 $video = str_replace('http://gdata.youtube.com/feeds/api/videos/','',$video);
				 $vid[] = $video;
			}
			return $vid;
		}
		
	 }
?>