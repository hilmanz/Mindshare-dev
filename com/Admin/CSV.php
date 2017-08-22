<?php
global $ENGINE_PATH;
include_once $ENGINE_PATH."Utility/Paginate.php";
include_once 'excel_reader2.php';
class CSV extends SQLData{
	function __construct($req){
		parent::SQLData();
		$this->Request = $req;
		$this->View = new BasicView();
		$this->User = new UserManager();
	}
	function admin(){
		$act = $this->Request->getParam('act');
		
		if ($this->Request->getPost('upload_csv')){
			return $this->addCSV();	
		}else{
			return $this->main();
		}
	}

	function main(){
	
		return $this->View->toString("dashboard/addCSV.html");
	}
	function addCSV(){
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
			if ($csv_type == 'application/vnd.ms-excel' && $csv_size < 2000000){
	
				if(move_uploaded_file($_FILES['csv']['tmp_name'], $upload_path)) {
					$this->open(0);
					$data = new Spreadsheet_Excel_Reader($upload_path);
					
					$baris = $data->rowcount($sheet_index=0); // baca jumlah baris dari excel
					
					$sukses = 0;
					$gagal = 0;
					$n=0;
					// echo $baris-3;exit;
					// echo $data->val($baris-3, 10);exit;
					for($i=3;$i<=$baris;$i++){
						if($i >= $baris-3){
						$total[$data->val($i, 1)]['clicks'] = $data->val($i, 10);
						$total[$data->val($i, 1)]['impression'] = $data->val($i, 11);
						$total[$data->val($i, 1)]['ctr'] = $data->val($i, 12);
						$total[$data->val($i, 1)]['avg_cpc'] = $data->val($i, 13);
						$total[$data->val($i, 1)]['cost'] = $data->val($i, 14);
						$total[$data->val($i, 1)]['avg_position'] = $data->val($i, 15);
						}else{
						$data2[$n]['ad_state'] = $data->val($i, 1); // baca kolom 1
						$data2[$n]['ad'] = $data->val($i, 2); // baca kolom 2
						$data2[$n]['desc_line1'] = $data->val($i, 3); // baca kolom 3
						$data2[$n]['desc_line2'] = $data->val($i, 4); // baca kolom 4
						$data2[$n]['display_url'] = $data->val($i, 5); // baca kolom 5
						$data2[$n]['destination_url'] = $data->val($i, 6); // baca kolom 6
						$data2[$n]['campaign'] = $data->val($i, 7); // baca kolom 6
						$data2[$n]['ad_group'] = $data->val($i, 8); // baca kolom 7
						$data2[$n]['status'] = $data->val($i, 9); // baca kolom 8
						$data2[$n]['clicks'] = $data->val($i, 10); // baca kolom 9
						$data2[$n]['impression'] = $data->val($i, 11); // baca kolom 10
						$data2[$n]['ctr'] = $data->val($i, 12); // baca kolom 11
						$data2[$n]['avg_cpc'] = $data->val($i, 13); // baca kolom 12
						$data2[$n]['cost'] = $data->val($i, 14); // baca kolom 13
						$data2[$n]['avg_position'] = $data->val($i, 15); // baca kolom 14
						}
						$n++;
					}
					
// 					print '<pre>';
// 					print_r($total);exit;
					$sukses = 0;$gagal = 0;
					foreach($data2 as $dt){
						$q = "INSERT INTO tbl_semad_report (id, semID, range_date, adState, ad, desc_1, desc_2, display_url, full_url, campaign, ad_group, status, click, impressions, ctr, avg_cost, cost, avg_position) VALUES (NULL, '1', NOW(), '".$dt['ad_state']."', '".$dt['ad']."', '".$dt['desc_line1']."', '".$dt['desc_line2']."', '".$dt['display_url']."', 
		'".$dt['destination_url']."', '".$dt['campaign']."', '".$dt['ad_group']."', '".$dt['status']."', '".$dt['clicks']."', '".$dt['impression']."', '".$dt['ctr']."', 
		'".$dt['avg_cpc']."', '".$dt['cost']."', '".$dt['avg_position']."');";
						// echo $q.'<br>';
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
		VALUES (NULL, '1', NOW(), '".$key."', '".$t['clicks']."', '".$t['impression']."', '".$t['ctr']."', '".$t['avg_cpc']."', 
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
						@unlink($upload_path);
					//}
						
					$msg = $stat1.'<=>'.$stat2;
				} else{
					$msg = "There was an error uploading the file, please try again!";
				}
			}else{
				$msg = "You must upload the *.csv only and the size most not exceeded 2MB.";
			}
		}
		$this->View->assign('err',$msg);
		return $this->View->toString("dashboard/addCSV.html");
	}
}