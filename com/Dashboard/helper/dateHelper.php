<?php 

class dateHelper{

	var $Request;
	
	function __construct($req=null){
	$this->Request = $req;
	
	}
	
	function dMyformat($date) {
		$bulan = array("JAN","FEB","MAR","APR","MAY","JUN","JUL","AUG","SEP","OCT","NOV","DEC");
		$year = substr($date, 2, 4);
		$month = intval(substr($date, 5, 2))-1;
		$tgl = substr($date, 8, 2);
		$dMy = $tgl."-".$bulan[$month]."-".+$year;
		//var_dump($dMy);exit;
		return $dMy;
	}
	function mformat($date) {
		$bulan = array("January","February","March","April","May","June","July","August","September","October","November","December");
		$month = intval(substr($date, 5, 2))-1;
		$m = $bulan[$month];
		//var_dump($dMy);exit;
		return $m;
	}
	
	
	
	
}	

?>

