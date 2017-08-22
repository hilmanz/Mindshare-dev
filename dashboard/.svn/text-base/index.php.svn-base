<?php
/**
* ADMINISTRATION PAGE
* @author Hapsoro Renaldy N <hapsoro.renaldy@winixmedia.com>
*/

include_once "common.php";
//header('Pragma: public');        
//header('Cache-control: private');
//header('Expires: -1');
$view = new BasicView();

$admin = new Admin();
//$admin->DEBUG=true;
//assign sections
if($admin->auth->isLogin()){
	switch($req->getRequest("s")){
        case "seo":
        	include_once $APP_PATH."Dashboard/SEO.php";
        	$admin->execute(new SEO($req),"seo");
        break;
        case "sem":
        	include_once $APP_PATH."Dashboard/SEM.php";
        	$admin->execute(new SEM($req),"sem");
        break;
        case "social":
        	include_once $APP_PATH."Dashboard/Social.php";
        	$admin->execute(new Social($req),"social");
        	break;
		default:
			//$view->assign("mainContent","dashboard");
			//load Plugin
			if($req->getRequest("s")!=NULL){
				$plugin = $admin->loadPlugin($req,$req->getRequest("s"));
				//print_r($plugin);
				if($plugin){
					$admin->execute($plugin,$req->getRequest("s"));
				}
			}else{
				//or load dashboard if there's no request specified.
				$admin->showDashboard();
			}
		break;
	}
}
//assign content to main template
$admin->show();
$view->assign("mainContent",$admin->toString());
//output the populated main template
print $view->toString($MAIN_TEMPLATE);
?>