<?php
global $ENGINE_PATH;
include_once $ENGINE_PATH."Utility/Paginate.php";
include_once APP_PATH."Admin/model/ProjectModel.php";
include_once APP_PATH."Admin/helper/ReadCSV.php";
include_once APP_PATH.'Admin/excel_reader2.php';
include_once 'excel_reader2.php';
class SEM extends SQLData{
	var $model;
	function __construct($req){
		parent::SQLData();
		$this->Request = $req;
		$this->View = new BasicView();
		$this->User = new UserManager();
		$this->model = new ProjectModel();
	}
	function admin(){
		$act = $this->Request->getParam('act');
		
		if ($this->Request->getPost('upload_csv')){
			return $this->addCSV();	
		}elseif ($act=='upload_csv_ads'){
			return $this->addCSVAds();	
		}elseif ($act=='upload_csv_keyword'){
			return $this->addCSVKeyword();	
		}else{
			return $this->main();
		}
	}

	function main(){
		$plist = $this->model->getProjectList();
		$this->View->assign('plist',$plist);
		return $this->View->toString("dashboard/admin/SEM/upload-sem-report.html");
	}
	function addCSV(){
		set_time_limit(0);
		$csv = basename($_FILES['csv']['name'])."_".date('Y-m-d');
		$target_path = "../admin/csv/";
		$csv_type = $_FILES["csv"]["type"];
		$csv_size = $_FILES["csv"]["size"];
			$project_id = $this->Request->getPost('project');
			
// 		print_r($csv_type);exit;
		//Check Directory
		if(!is_dir($target_path)){
			@mkdir($target_path);
		}
		$upload_path = $target_path . $csv;
		//print_r($_FILES['csv']['tmp_name']);exit;
		if ($csv==""){
			$msg = "Please insert cvs file that you want to upload.";
		}else{
			if ($csv_type == 'application/vnd.ms-excel' && $csv_size < 2000000){
	
				if(move_uploaded_file($_FILES['csv']['tmp_name'], $upload_path)) {
					$this->open(0);
					$data = new Spreadsheet_Excel_Reader($upload_path);
					
					$baris = $data->rowcount($sheet_index=0); // baca jumlah baris dari excel
					
					$sukses = 0;
					$gagal = 0;
					$n=0;
					$tanggal = date("Y-m-d",strtotime($data->val(3, 1)));
					
					$qcek1 = "SELECT COUNT(range_date) t FROM tbl_semad_report WHERE range_date='".$tanggal."' AND semID='{$project_id}'";
					$r = $this->fetch($qcek1);
					$cek1 = $r['t'];
					// echo $cek1;exit;
					if($cek1 < 1){
						// echo $baris-3;exit;
						// echo $data->val($baris-3, 10);exit;
						for($i=3;$i<=$baris;$i++){
							if($i >= $baris-2){
							$total[$data->val($i, 1)]['clicks'] = str_replace(",", "", $data->val($i, 6));
							$total[$data->val($i, 1)]['impression'] = str_replace(",", "", $data->val($i, 7));
							$total[$data->val($i, 1)]['ctr'] = str_replace(",", "", $data->val($i, 8));
							$total[$data->val($i, 1)]['avg_cpc'] = str_replace(",", "", $data->val($i, 9));
							$total[$data->val($i, 1)]['cost'] = str_replace(",", "", $data->val($i, 10));
							$total[$data->val($i, 1)]['avg_position'] = str_replace(",", "", $data->val($i, 11));
							}else{
							$data2[$n]['date'] = date("Y-m-d",strtotime($data->val($i, 1))); // baca kolom 1
							$data2[$n]['state'] = $data->val($i, 2); // baca kolom 2
							$data2[$n]['campaign'] = $data->val($i, 3); // baca kolom 3
							// $data2[$n]['budget'] = $data->val($i, 4); // baca kolom 4
							$data2[$n]['status'] = $data->val($i, 5); // baca kolom 5
							$data2[$n]['clicks'] = str_replace(",", "", $data->val($i, 6)); // baca kolom 6
							$data2[$n]['impression'] = str_replace(",", "", $data->val($i, 7)); // baca kolom 6
							$data2[$n]['ctr'] = str_replace(",", "", $data->val($i, 8)); // baca kolom 7
							$data2[$n]['avg_cpc'] = str_replace(",", "", $data->val($i, 9)); // baca kolom 8
							$data2[$n]['cost'] = str_replace(",", "", $data->val($i, 10)); // baca kolom 9
							$data2[$n]['avg_position'] = str_replace(",", "", $data->val($i, 11)); // baca kolom 10
							// $data2[$n]['ctr'] = $data->val($i, 12); // baca kolom 11
							// $data2[$n]['avg_cpc'] = $data->val($i, 13); // baca kolom 12
							// $data2[$n]['cost'] = $data->val($i, 14); // baca kolom 13
							// $data2[$n]['avg_position'] = $data->val($i, 15); // baca kolom 14
							}
							$n++;
						}
						
						// print '<pre>';
						// print_r($data2);exit;
						$sukses = 0;$gagal = 0;
						foreach($data2 as $dt){
							// $q = "INSERT INTO tbl_semad_report (id, semID, range_date, adState, ad, desc_1, desc_2, display_url, full_url, campaign, ad_group, status, click, impressions, ctr, avg_cost, cost, avg_position) VALUES (NULL, '1', NOW(), '".$dt['ad_state']."', '".$dt['ad']."', '".$dt['desc_line1']."', '".$dt['desc_line2']."', '".$dt['display_url']."', 
			// '".$dt['destination_url']."', '".$dt['campaign']."', '".$dt['ad_group']."', '".$dt['status']."', '".$dt['clicks']."', '".$dt['impression']."', '".$dt['ctr']."', 
			// '".$dt['avg_cpc']."', '".$dt['cost']."', '".$dt['avg_position']."');";
							$q = "INSERT INTO tbl_semad_report (id, semID, range_date,adState,campaign,status,click,impressions,ctr,avg_cost,cost,avg_position) 
									VALUES (NULL,'{$project_id}','".$dt['date']."','".$dt['state']."','".$dt['campaign']."','".$dt['status']."','".$dt['clicks']."'
											,'".$dt['impression']."','".$dt['ctr']."','".$dt['avg_cpc']."','".$dt['cost']."','".$dt['avg_position']."')";
							// echo $q.'<br>';exit;
							if($this->query($q)){
								$sukses = $sukses+1;
							}else{
								$gagal = $gagal+1;
	// 							echo mysql_errno() . ": " . mysql_error(). "\n";
							}
							
						}
						$stat1 = 'Input data tbl_semad_report => Sukses : '.$sukses.', Gagal : '.$gagal.'';
						
						
						// INPUT SUMMARY
						$sukses2 = 0;$gagal2 = 0;
						foreach($total as $key => $t){
							$qw = "INSERT INTO tbl_semad_summary (id, semID, range_date, description, clicks, impression, ctr, avg_cpc, cost, avg_position) 
			VALUES (NULL, '{$project_id}', '".$tanggal."', '".$key."', '".$t['clicks']."', '".$t['impression']."', '".$t['ctr']."', '".$t['avg_cpc']."', 
			'".$t['cost']."', '".$t['avg_position']."');";
							// echo $q.'<br>';
							if($this->query($qw)){
								$sukses2 = $sukses2+1;
							}else{
								$gagal2 = $gagal2+1;
							}
						}
						$stat2 = 'Input data tbl_semad_summary => Sukses : '.$sukses2.', Gagal : '.$gagal2.'';
						$this->close();	
						//if(!$rs){
						//	$msg = "Uploading failed";
	// 						@unlink($upload_path);
						//}
							
						$msg = $stat1.'<=>'.$stat2;
					}else{
						$msg = "Sorry , data already exist!";
					}
				} else{
					$msg = "There was an error uploading the file, please try again!";
				}
			}else{
				$msg = "You must upload the *.csv only and the size most not exceeded 2MB.";
			}
		}
		$plist = $this->model->getProjectList();
		$this->View->assign('plist',$plist);
		$this->View->assign('err',$msg);
		return $this->View->toString("dashboard/admin/SEM/upload-sem-report.html");
	}
	
	function addCSVAds(){
		$save = $this->Request->getPost('save');
		if($save==1){
			set_time_limit(0);
			$csv = "ads_"."_".date('Y-m-d').basename($_FILES['csv']['name']);
			$target_path = "../admin/csv/";
			$csv_type = $_FILES["csv"]["type"];
			$csv_size = $_FILES["csv"]["size"];
			$project_id = $this->Request->getPost('project');
				
	// 		print_r($csv_type);exit;
			//Check Directory
			if(!is_dir($target_path)){
				@mkdir($target_path);
			}
			$upload_path = $target_path . $csv;
			//print_r($_FILES['csv']['tmp_name']);exit;
			if ($csv==""){
				$msg = "Please insert cvs file that you want to upload.";
			}else{
				if ($csv_type == 'application/vnd.ms-excel' && $csv_size < 2000000){
		
					if(move_uploaded_file($_FILES['csv']['tmp_name'], $upload_path)) {
						$this->open(0);
						$data = new Spreadsheet_Excel_Reader($upload_path);
						
						$baris = $data->rowcount($sheet_index=0); // baca jumlah baris dari excel
						
						$sukses = 0;
						$gagal = 0;
						$n=0;
						$tanggal = date("Y-m-d",strtotime($data->val(3, 1)));
						
						$qcek1 = "SELECT COUNT(day) t FROM tbl_semad_ads WHERE day='".$tanggal."' AND proID='{$project_id}'";
						$r = $this->fetch($qcek1);
						$cek1 = $r['t'];
						// echo $cek1;exit;
						if($cek1 < 1){
							// echo $baris-3;exit;
							// echo $data->val($baris-3, 10);exit;
							for($i=3;$i<=$baris;$i++){
								if($i >= $baris-2){
								}else{
								if($i==0)continue;
								if($i==1)continue;
								$data2[$n]['day'] = date("Y-m-d",strtotime($data->val($i, 1))); // baca kolom 1
								$data2[$n]['ads'] = $data->val($i, 3); // baca kolom 3
								$data2[$n]['click'] = $data->val($i, 12); // baca kolom 12
								}
								$n++;
							}
							
							// print '<pre>';
							// print_r($data2);exit;
							$sukses = 0;$gagal = 0;
							foreach($data2 as $dt){
								$q = "INSERT INTO tbl_semad_ads (id, proID, day,ads,click) 
										VALUES (NULL,'{$project_id}','".$dt['day']."','".$dt['ads']."','".$dt['click']."')";
								// echo $q.'<br>';exit;
								if($this->query($q)){
									$sukses = $sukses+1;
								}else{
									$gagal = $gagal+1;
		// 							echo mysql_errno() . ": " . mysql_error(). "\n";
								}
								
							}
							$stat1 = 'Input data tbl_semad_ads => Sukses : '.$sukses.', Gagal : '.$gagal.'';
							
								
							$msg = $stat1;
						}else{
							$msg = "Sorry , data already exist!";
						}
					} else{
						$msg = "There was an error uploading the file, please try again!";
					}
				}else{
					$msg = "You must upload the *.csv only and the size most not exceeded 2MB.";
				}
			}
			
		}
		$plist = $this->model->getProjectList();
			$this->View->assign('plist',$plist);
			$this->View->assign('err',$msg);
			return $this->View->toString("dashboard/admin/SEM/upload_csv_ads.html");
	}
	
	function addCSVKeyword(){
		$save = $this->Request->getPost('save');
		if($save==1){
			set_time_limit(0);
			$csv = "keyword_"."_".date('Y-m-d').basename($_FILES['csv']['name']);
			$target_path = "../admin/csv/";
			$csv_type = $_FILES["csv"]["type"];
			$csv_size = $_FILES["csv"]["size"];
			$project_id = $this->Request->getPost('project');
				
	// 		print_r($csv_type);exit;
			//Check Directory
			if(!is_dir($target_path)){
				@mkdir($target_path);
			}
			$upload_path = $target_path . $csv;
			//print_r($_FILES['csv']['tmp_name']);exit;
			if ($csv==""){
				$msg = "Please insert cvs file that you want to upload.";
			}else{
				if ($csv_type == 'application/vnd.ms-excel' && $csv_size < 2000000){
		
					if(move_uploaded_file($_FILES['csv']['tmp_name'], $upload_path)) {
						$this->open(0);
						$data = new Spreadsheet_Excel_Reader($upload_path);
						
						$baris = $data->rowcount($sheet_index=0); // baca jumlah baris dari excel
						
						$sukses = 0;
						$gagal = 0;
						$n=0;
						$tanggal = date("Y-m-d",strtotime($data->val(3, 1)));
						
						$qcek1 = "SELECT COUNT(day) t FROM tbl_semad_keyword WHERE day='".$tanggal."' AND proID='{$project_id}'";
						$r = $this->fetch($qcek1);
						$cek1 = $r['t'];
						// echo $cek1;exit;
						if($cek1 < 1){
							// echo $baris-3;exit;
							// echo $data->val($baris-3, 10);exit;
							for($i=3;$i<=$baris;$i++){
								if($i >= $baris-2){
								}else{
								if($i==0)continue;
								if($i==1)continue;
								$data2[$n]['day'] = date("Y-m-d",strtotime($data->val($i, 1))); // baca kolom 1
								$data2[$n]['ads'] = $data->val($i, 3); // baca kolom 3
								$data2[$n]['click'] = $data->val($i, 8); // baca kolom 8
								}
								$n++;
							}
							
							// print '<pre>';
							// print_r($data2);exit;
							$sukses = 0;$gagal = 0;
							foreach($data2 as $dt){
								$q = "INSERT INTO tbl_semad_keyword (id, proID, day,keyword,click) 
										VALUES (NULL,'{$project_id}','".$dt['day']."','".$dt['ads']."','".$dt['click']."')";
								// echo $q.'<br>';exit;
								if($this->query($q)){
									$sukses = $sukses+1;
								}else{
									$gagal = $gagal+1;
		// 							echo mysql_errno() . ": " . mysql_error(). "\n";
								}
								
							}
							$stat1 = 'Input data tbl_semad_keyword => Sukses : '.$sukses.', Gagal : '.$gagal.'';
							
								
							$msg = $stat1;
						}else{
							$msg = "Sorry , data already exist!";
						}
					} else{
						$msg = "There was an error uploading the file, please try again!";
					}
				}else{
					$msg = "You must upload the *.csv only and the size most not exceeded 2MB.";
				}
			}
			
		}
		$plist = $this->model->getProjectList();
			$this->View->assign('plist',$plist);
			$this->View->assign('err',$msg);
			return $this->View->toString("dashboard/admin/SEM/upload_csv_keyword.html");
	}
}