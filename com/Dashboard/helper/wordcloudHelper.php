<?php
global $ENGINE_PATH;
include_once $ENGINE_PATH."Utility/WordCloud.php";
class wordcloudHelper extends Wordcloud{
	var $sentiment_style = array();
	var $handler="wc";
	var $urlto = "javascript:void(0);";
	var $callback_func = "";
	function setHandler($handler){
		$this->handler = $handler;
	}
	function set_sentiment_style($style){
		$this->sentiment_style = $style;
	}
	function callback($params){
		if($this->callback_func!=""){
			$this->urlto="javascript:void(0);";
			return "onclick=\"".$this->callback_func."(".($params).")\"";
		}
	}
	function writeHTML($t,$n=0){
		if($t['is_main']==1){
			$style = $this->sentiment_style['main_keyword'];
		}else{
			if($t['sentiment']>0){
				$style = $this->sentiment_style['positive'];
			}else if($t['sentiment']<0){
				$style = $this->sentiment_style['negative'];
			}else{
				$style = $this->sentiment_style['neutral'];
			}
		}
		
		$str= "<span id='".$this->handler.$n."' class='wc".ceil($t['size'])." ".$style."' style='top:".$t['y']."px;left:".$t['x']."px;position:absolute;overflow:hidden;float:left;'><a href='".$this->urlto."' class='".$style."' style='float:left;text-decoration:none;font-family:verdana;width:".$t['txt']."em;height:".$t['height']."px;' ".$this->callback("'".$_GET['key']."','".$t['txt']."',".$_GET['id']).">".$t['txt']."</a></span>";
		
		return $str;
	}
}
?>