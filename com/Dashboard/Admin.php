<?php
include_once $ENGINE_PATH."Security/Authentication.php";
include_once $ENGINE_PATH."Security/Permission.php";
include_once $ENGINE_PATH."Admin/UserManager.php";
include_once $ENGINE_PATH."Admin/PluginManager.php";
include_once $APP_PATH."Dashboard/helper/milisecHelper.php";
include_once $APP_PATH."Dashboard/helper/SessionHelper.php";
class Admin extends SQLData{
	var $auth ;
	var $perm;
	var $user;
	var $strHTML;
	var $milisecHelper;
	var $View;
	var $DEBUG=false;
	var $plugin;
	function Admin(){
		
		parent::SQLData();
		$this->Request = $req;
		$this->auth = new Authentication();
		$this->perm = new Permission();
		$this->user = new UserManager();
		$this->View = new BasicView();	
		$this->plugin = new PluginManager();
		$this->milisecHelper = new milisecHelper();
	}
	
	function show(){
		if(!$this->auth->isLogin()){
			$this->strHTML = $this->showLoginPage();
		}else{
			$this->strHTML = $this->showAdminPage();
		}
		if($this->DEBUG){
			print $this->getMessage();
			print $this->perm->getMessage();
			print $this->user->getMessage();
		}
	}
	function loadPlugin($request,$reqID){
		global $APP_PATH,$ENGINE_PATH;
		
		$rs = $this->plugin->getPluginByRequestID($reqID);
		
		if(file_exists($APP_PATH.$rs['plugin_path'].$rs['className'].".php")){
			include_once $APP_PATH.$rs['plugin_path'].$rs['className'].".php";
			$className =  $rs['className'];
			$instance = new $className($request);
			return $instance;
		}else{
			//print $APP_PATH.$rs['plugin_path'].$rs['className'].".php";
			return false;
		}
	}
	function showDashboard(){
		// print_r('<pre>');
		// print_r($this->auth->Session->sessions['uid']);
		$id = $this->auth->Session->sessions['uid'];
		include_once "DashboardManager.php";
		$dashboard = new DashboardManager(null);
		$output = $dashboard->load();
		// print_r($dashboard );exit;
		
		/** PROJECT LIST **/
		$projectList = $dashboard->getProjectList($id);
// 		var_dump($projectList);exit;
		$projectStats = array("Disable","Execution Phase","Completed");
		$tabStats = array("None","Active","Completed");
		for($i=0;$i<sizeof($projectList);$i++){
			//number of project
			if ($projectList[$i]["project_status"] != 0){
				$projectActive += $projectList[$i]["project_status"];
			}else{
				$projectActive = 0;
			}
			
			//project status
			$projectStatus[$i] = $projectStats[$projectList[$i]["project_status"]];
			
			//tab status
			$tabSEO[$i] = $tabStats[$projectList[$i]["seo"]];
			$tabSEM[$i] = $tabStats[$projectList[$i]["sem"]];
			$tabSocial[$i] = $tabStats[$projectList[$i]["social"]];
			
			//last update
			if ($tabSEO[$i] == 'Active'){
				$update[$i] = $dashboard->getLastUpdateSEO($projectList[$i]["id"]);
			}else if ($tabSEM[$i] == 'Active'){
				$update[$i] = $dashboard->getLastUpdateSEM($projectList[$i]["id"]);
			}else{
				$update[$i] = $dashboard->getLastUpdateSocial($projectList[$i]["id"]);
			}
		}
		$this->View->assign("lastUpdate",$update);
		$this->View->assign("tabSEO",$tabSEO);
		$this->View->assign("tabSEM",$tabSEM);
		$this->View->assign("tabSocial",$tabSocial);
		$this->View->assign("projectStatus",$projectStatus);
		$this->View->assign("projectActive", $projectActive);
		$this->View->assign("projectList",$projectList);
		/** PROJECT LIST **/
		
		/** CHANNEL STATISTICS **/
		// $cstats = $dashboard->getChannelStatistics();
		// print_r($cstats);exit;
		/** CHANNEL STATISTICS **/
		
		/** CHANNEL STATISTICS **/
		// $vstats = $dashboard->getVideoStatistics();
		// print_r($vstats);exit;
		/** CHANNEL STATISTICS **/
		
		$this->View->assign("DASHBOARD_CONTENT",$output);
		$this->View->assign("user",array("username"=>$this->auth->Session->getVariable("username")));
		$this->View->assign("content",$this->View->toString("dashboard/mainDashboard.html"));
	}
	function showAdminPage(){
		include_once "DashboardManager.php";
		$dashboard = new DashboardManager(null);
		$output = $dashboard->load();
		$proID = $_GET['id'];
		$id = $this->auth->Session->sessions['uid'];
		$projectList = $dashboard->getProjectListPage($id, $proID);	
//   	var_dump($projectList);exit;	
		$this->View->assign('pro1', $projectList['name']);
//  	$this->View->assign('pro2', $projectList[1]['name']);
        $this->View->assign("user",array("username"=>$this->auth->Session->getVariable("username")));
		return $this->View->toString("dashboard/admin.html");
	}
	function toString(){
		return $this->strHTML;
	}
	function showLoginPage(){
		if($_GET['f']==1){
			$this->View->assign("msg","Access Denied !");
		}
		return $this->View->toString("dashboard/login.html");
	}
	function execute($obj,$reqID){
		if($this->perm->isAllowed($reqID)){
			if($obj->autoconnect){
				$obj->open();
				$this->View->assign("content",$obj->admin());
				$obj->close();
			}else{
				$this->View->assign("content",$obj->admin());
			}
		}else{
			$this->View->assign("content","Access Denied !");
		}
		if($this->DEBUG){
			print $obj->getMessage();
		}
	}
	function attach($obj,$reqID,$arr,$adminMode=true){
		if($adminMode){
			if($this->perm->isAllowed($reqID)){
				$obj->open();
				
				for($i=0;$i<sizeof($arr);$i++){
					$this->View->assign("addon_".$arr[$i],$obj->addon($arr[$i]));	
				}
				$obj->close();
				
			}
		}else{
			for($i=0;$i<sizeof($arr);$i++){
				$this->View->assign("addon_".$arr[$i],$obj->addon($arr[$i]));	
			}
		}
		
		
		if($this->DEBUG){
			print $obj->getMessage();
		}
		
	
	}
}
?>