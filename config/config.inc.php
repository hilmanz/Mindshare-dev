<?php
$CONFIG['LOG_DIR'] = "../logs/";
$GLOBAL_PATH = "../";
$APP_PATH = "../com/";
$ENGINE_PATH = "../engines/";
$WEBROOT = "../html/";

//DEFINE VARIABLE
define('APPLICATION','Dashboard');        //set aplikasi yang digunakan
define('DB_PREFIX','rr');        //set DB prefix for frontend
define('BASEURL','http://localhost/Mindshare-dev/public_html/');        //set BASEURL frontend
define('BASEURL_ADMIN','http://localhost/Mindshare-dev/admin/');        //set BASEURL admin
define('APP_PATH',$APP_PATH);


//set database
$CONFIG['DEVELOPMENT'] = true;
if($CONFIG['DEVELOPMENT']){
        $CONFIG['DATABASE'][0]['HOST']             = "202.80.113.52";
        $CONFIG['DATABASE'][0]['USERNAME']         = "root";
        $CONFIG['DATABASE'][0]['PASSWORD']         = "coppermine";
        $CONFIG['DATABASE'][0]['DATABASE']         = "mindsharedb";
        error_reporting(0);
}else{
        $CONFIG['DATABASE'][0]['HOST']                                 = "";
        $CONFIG['DATABASE'][0]['USERNAME']         = "";
        $CONFIG['DATABASE'][0]['PASSWORD']         = "";
        $CONFIG['DATABASE'][0]['DATABASE']         = "";
}

$CONFIG['GA']['da4b9237bacccdf19c0760cab7aec4a8359010b0']['username'] = 'beranikotoritubaik@gmail.com';
$CONFIG['GA']['da4b9237bacccdf19c0760cab7aec4a8359010b0']['password'] = 'rinsoindonesia';
$CONFIG['GA']['da4b9237bacccdf19c0760cab7aec4a8359010b0']['profileid'] = '52558708';


$CONFIG['GA'][2]['username'] = '';
$CONFIG['GA'][2]['password'] = '';
$CONFIG['GA'][2]['profileid'] = '';


$CONFIG['GA'][3]['username'] = '';
$CONFIG['GA'][3]['password'] = '';
$CONFIG['GA'][3]['profileid'] = '';
	
?>