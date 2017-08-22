<?php 
global $ENGINE_PATH;
include_once "../config/config.inc.php";
include_once $ENGINE_PATH."Utility/gapi/gapi.class.php";

class DashboardManager extends SQLData{
	var $View;
	var $Request;
	
	function DashboardManager($req){
		$this->SQLData();
		$this->View = new BasicView();
		$this->Request = $req;
	}
	
	function getLastUpdateSEO($id){
		$this->open(0);
		$q=	"SELECT DATE_FORMAT(c.date,'%d %M %Y') AS lastUpdate
			FROM channel_views c 
			LEFT JOIN tbl_project k
			ON c.channel_name = k.channel_id
			WHERE k.id = '".$id."'
			ORDER BY c.date 
			DESC LIMIT 1	
			";
		$r = $this->fetch($q);
		$this->close;
		// var_dump($r);exit;
		return $r;
	}
	
	function getLastUpdateSEM($id){
		$this->open(0);
		$q=	"SELECT DATE_FORMAT(c.range_date,'%d %M %Y') AS lastUpdate
			FROM tbl_semad_report c 
			LEFT JOIN tbl_project k
			ON c.semID = k.id
			WHERE k.id = '".$id."'
			ORDER BY c.range_date 
			DESC LIMIT 1	
			";
		$r = $this->fetch($q);
		$this->close;
		// var_dump($r);exit;
		return $r;
	}
	
	function getLastUpdateSocial($id){
		$this->open(0);
		$q=	"SELECT DATE_FORMAT(c.range_date,'%d %M %Y') AS lastUpdate
			FROM tbl_semad_report c 
			LEFT JOIN tbl_project k
			ON c.semID = k.id
			WHERE k.id = '".$id."'
			ORDER BY c.range_date 
			DESC LIMIT 1	
			";
		$r = $this->fetch($q);
		$this->close;
		// var_dump($r);exit;
		$dummy = array("lastUpdate" => "14 May 2012");
		return $dummy;
	}
	
	function getProjectList($id){
		$this->open(0);
// 		var_dump($page);exit;
// 		$project = "SELECT tbl_project.id, name, DATE_FORMAT(start_date,'%d %M %Y') AS mulai, seo, sem, social, kpi, project_status, channel_stats.channel_name as cname, tbl_project.channel_id, description FROM tbl_project JOIN channel_stats WHERE tbl_project.userID='".$id."' GROUP BY tbl_project.id LIMIT 5";
		$project = "SELECT c.id, name, DATE_FORMAT(c.start_date,'%d %M %Y') AS mulai, c.seo, c.sem, c.social, c.project_status, c.channel_id AS cname, c.description
					FROM tbl_project c LEFT JOIN tbl_project_user k
					ON k.project_id = c.id
					WHERE k.user_id = '".$id."'
					GROUP BY c.id
					";
		$rs = $this->fetch($project,1);
		$this->close();
		// print ('<pre>');
		// print_r($rs);exit;
		return $rs;
	}
	
	function getProjectListPage($id, $proID){
		$this->open(0);
		// 		var_dump($page);exit;
		$project = "SELECT c.id, name, DATE_FORMAT(c.start_date,'%d %M %Y') AS mulai, c.seo, c.sem, c.social, c.project_status, c.channel_id AS cname, c.description
					FROM tbl_project c LEFT JOIN tbl_project_user k
					ON k.project_id = c.id
					WHERE k.user_id = '".$id."' AND c.id = '".$proID."'
					GROUP BY c.id
					";
// 		var_dump($project);exit;
		$rs = $this->fetch($project);
		$this->close();
		//var_dump($rs);
		return $rs;
	}
	
	function getConfiguration(){
		//$this->open();
		$rs = $this->fetch("SELECT * FROM gm_dashboard LIMIT 20",1);
		///$this->close();
		return $rs;
	}
	function getPath($uri){
		$str = explode(".",trim($uri));
		$f = "";
		for($i=0;$i<sizeof($str);$i++){
			$f.=$str[$i];
			if($i<sizeof($str)-1){
			$f.="/";
			}
		}
		if(strlen($f)>5){
			$f.=".php";
			$className = $str[sizeof($str)-1];
		}
		$rs['file'] = $f;
		$rs['className'] = $className;
		return $rs;
	}
	function load(){
		global $APP_PATH,$ENGINE_PATH;
		$this->open(0);
		$items = $this->getConfiguration();
		$this->close();
		$plugins = array();
		for($i=0;$i<sizeof($items);$i++){
			$item = $this->getPath($items[$i]['class']);
			if(file_exists("../../".$item['file'])){
				
				include_once "../../".$item['file'];
				$obj = new $item['className']($this->Request);
				$plugins[$i]['name'] = $items[$i]['name'];
				$plugins[$i]['html'] = $obj->Dashboard();
				$plugins[$i]['slot'] = $items[$i]['slot'];
				
			}else{
				
				//print "class not found-->../".$item['file'];
			}
		}
		$this->View->assign("plugins",$plugins);
		return $this->View->toString("common/admin/dashboard_panel.html");
	}
	function addItem($name,$className,$invoker,$slot,$status){
		return $this->query("INSERT INTO gm_dashboard(name,class,invoker,slot,status) 
					 VALUES('".$name."','".$className."','".$invoker."','".$slot."','".$status."')");
	}
	function removeItem($id){
		return $this->query("DELETE FROM gm_dashboard WHERE id='".$id."'");
	}
	function editItem($id,$name,$className,$invoker,$status){
		return $this->query("UPDATE gm_dashboard 
							SET name='".$name."',class='".$className."',
							invoker='".$invoker."',status='".$status."' 
							WHERE id='".$id."'");
	}
}
?>