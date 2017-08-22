<?php 

class youtubeChannelHelper{

	var $Request;
	
	function __construct($req=null){
	$this->Request = $req;
	
	}
	
	function youtubeChannel($channel) {
		switch($channel){
				case "WATCH":
					$channel = "YouTube watch page";
				break;
				case "EMBEDDED":
					$channel = "Embedded player on other websites";
				break;
				case "MOBILE":
					$channel = "Mobile devices";
				break;
				default:
				break;
			}
		return $channel;
	}
}	
?>

