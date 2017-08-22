<?php
error_reporting(E_ALL);
include('ClassYouTubeAPI.php');

$username ='castrolasiapacific@gmail.com';
$pass='141sercon';
$obj = new ClassYouTubeAPI();
$result = $obj->clientLoginAuth($username,$pass);
// print_r($result);exit;
if($result){
	// echo $result['token'];exit;
	$tgl1 = strtotime('2012-04-14');
	$tgl1 = $tgl1*1000;
	$tgl2 = strtotime('2012-04-16');
	$tgl2 = $tgl2*1000;
	include "curl_class.php";
	$curl = new curl_class();
	// $curl->get('https://www.youtube.com/insight_proxy_csv?dim=COUNTRY%2CVIEWER_AGE%2CVIEWER_GENDER&met=VIEWER_PROMILLE&ord=VIEWER_PROMILLE&from=18032012&to=16042012&where=UN001&whatType=USER&whatId=1RC50zu8dG9Ttk3l16jViw');
	// $link = 'https://www.youtube.com/insight_proxy_csv?dim=COUNTRY%2CVIEWER_AGE%2CVIEWER_GENDER&met=VIEWER_PROMILLE&ord=VIEWER_PROMILLE&from=18032012&to=16042012&where=UN001&whatType=USER&whatId=1RC50zu8dG9Ttk3l16jViw';
	$link = 'http://insight.youtube.com/video-analytics/csvreports?query=1RC50zu8dG9Ttk3l16jViw&type=u&starttime=1332028800000&endtime=1334534400000&user_starttime=1332028800000&user_endtime=1334534400000&region=world&token=M-p9QFaIoSO2nibZ1QwOLEdc6_h8MTMzNDU2MTk4MkAxMzM0NTYwMTgy&hl=en_US';
	// $file = $curl->get($link);
	// print_r($file);exit;
	if($curl->copySecureFile($link,"c:/csv_youtube/".date('YmdHis').".zip"))
	{
		echo 'File transferred successfully.';
	}
	else
	{
		echo 'File transfer failed.';
	}
	
	// print_r($curl->get('http://insight.youtube.com/video-analytics/csvreports?query=CastrolAsiaPacific&type=v&starttime='.$tgl1.'&endtime='.$tgl2.'&user_starttime='.$tgl1.'&user_endtime='.$tgl2.'&region=world&token='.$result['token'].'&hl=en_US'));
}else{
	echo 'Belom login cuy!';
}
/*
echo "<br>================== createPlayList ===============<br>";
$title = 'my playlist test';
$summary = 'test description';
$result = $obj->createPlayList($title,$summary);
print_r($result);
flush();
$playlistId = 'A041299447FD961C';
$username = 'default';
echo "<pre><br>================== deletePlaylist ===============<br>";
$result = $obj->deletePlaylist($username,$playlistId);
print_r($result);
flush();
echo "<pre><br>============= getPlaylists ==============<br>";
$result = $obj->getPlaylists();
print_r($result);
echo "<br>============= getVideosbyPlayListId ==============<br>";
$result = $obj->getVideosbyPlayListId('1AC61F544EBB7E8D');
print_r($result);
flush();
echo "<pre><br>================== addVideoToPlayList mmmeuz1F0vA ===============<br>";
$playlistId = '84FF75583310004D';
$videoId = 'mmmeuz1F0vA';
$result = $obj->addVideoToPlayList($playlistId,$videoId);
print_r($result);
flush();

echo "<pre><br>================== deleteVideoFromPlayList ===============<br>";
$playlist_id = 'D18190019C51C53D';
$playlist_entry_list = '7';
$result = $obj->deleteVideoFromPlayList($playlist_id,$playlist_entry_list);
print_r($result);
flush();
echo "<br>============= getVideosbyPlayListId ==============<br>";
$result = $obj->getVideosbyPlayListId('1AC61F544EBB7E8D');
print_r($result);

flush();
$filename = 'test.mov';
$fullFilePath = 'D:\\Projects\\triveni\\myyoutube\\test.mov';
$title ='Testing  Video 4';
$description ='Testing "4';
echo "<pre>";
$result = $obj->uploadVideo($filename,$fullFilePath,$title,$description);
print_r($result);



echo "<br>============= getUploadedVideos ==============<br>";
$result = $obj->getUploadedVideos();
print_r($result);
*/
?>