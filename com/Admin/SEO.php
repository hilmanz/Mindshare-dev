<?php
global $ENGINE_PATH;
include_once $ENGINE_PATH."Utility/Paginate.php";
include_once APP_PATH."Admin/helper/ReadCSV.php";
include_once APP_PATH.'Admin/excel_reader2.php';
include_once APP_PATH."Admin/model/ProjectModel.php";
class SEO extends SQLData{
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
		if ($act=='upload-demog-report'){
			return $this->uploadDemogReport();	
		}else{
			return $this->main();
		}
	}

	function main(){
	
		return $this->View->toString("dashboard/addCSV.html");
	}
	function uploadDemogReport(){
		$save = $this->Request->getPost('save');
		if($save==1){
			set_time_limit(0);
			$proID = $this->Request->getPost('project');
			$csv = basename($_FILES['csv']['name']);
			$target_path = "../admin/csv/";
			$csv_type = $_FILES["csv"]["type"];
			$csv_size = $_FILES["csv"]["size"];
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
				if (eregi('.csv',$csv) && $csv_size < 2000000){
					$tgd = explode(".",$csv);
					$tgl_demog = date("Y-m-d",strtotime($tgd[1]));
					// print_r($tgl_demog);exit;
					if(move_uploaded_file($_FILES['csv']['tmp_name'], $upload_path)) {
						$this->open(0);
						$_csv = ReadCSV($upload_path);
						// print'<pre>';print_r($_csv);exit;
						// JIKA DATA ADA
						if($_csv){
							// JIKA SUKSES DELETE DATA DI TABLE BACKUP
							// if($this->query("DELETE FROM demography_final_backup WHERE proID='".$proID."'")){
								// JIKA SUKSES COPY DATA FINAL KE BACKUP
								// if($this->query("INSERT INTO demography_final_backup SELECT * FROM demography_final WHERE proID='".$proID."';")){
									// JIKA SUKSES TRUNCATE DATA FINAL
									// if($this->query("DELETE FROM demography_final WHERE proID='".$proID."'")){
										$sukses=0;$gagal=0;
										// INPUT DATA CSV KE DB
										foreach($_csv as $i=> $c){
											if($i==0)continue;
											$q = "INSERT INTO demography_final (proID,tgl,tgl_demog, country, age_group, gender, persen) 
													VALUES ('".$proID."', now(), '".$tgl_demog."','".$c[0]."','".$c[1]."','".$c[2]."','".$c[3]."')";
													// echo $q."<br>";
											$input = $this->query($q);
											if($input){$sukses = $sukses+1;}else{$gagal = $gagal+1;}
										}
										$this->close();
										$msg = 'Sukses : '.$sukses." Gagal : ".$gagal;
									// }else{
										// $msg = 'Sorry, failed to truncate demography_final';
									// }
								// }else{
									// $msg = 'Sorry, failed to backup old data';
								// }
							// }else{
								// $msg = 'Sorry, failed to truncate demography_final_backup';
							// }
						}else{
							$msg = 'No data in your CSV file!';
						}
					}
				}else{
					$msg = 'Only *.csv file allowed! & Max.File Size 2MB';
				}
			}
		}
		$plist = $this->model->getProjectList();
		$this->View->assign('plist',$plist);
		$this->View->assign('err',$msg);
		return $this->View->toString("dashboard/admin/SEO/upload_demog_report.html");
	}
}