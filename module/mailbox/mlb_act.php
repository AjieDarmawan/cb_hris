<?php
//MailBox Variable
$mlb_sbj=ucwords($_POST['mlb_sbj']);
$mlb_msg=ucwords($_POST['mlb_msg']);
$mlb_lok=str_replace(' ', '_', $_FILES['mlb_atc']['tmp_name']);
$mlb_atc=str_replace(' ', '_', $_FILES['mlb_atc']['name']);
$mlb_size=$_FILES['mlb_atc']['size'];
$mlb_type=$_FILES['mlb_atc']['type'];
$mlb_pecah=explode(".", $mlb_atc);
$mlb_extend=$mlb_pecah[1];
$mlb_tgl=$date;
$mlb_jam=$time;
//$mlb_tujuan=implode(",", (array)$_POST['mlb_tujuan']);
//$mlb_sub_tujuan=implode(",", (array)$_POST['mlb_sub_tujuan']);

$mlb_tujuan=$_POST['mlb_tujuan'];
$mlb_sub_tujuan=$_POST['mlb_sub_tujuan'];
$mrk_id=$_POST['mrk_id'];

$page=$_GET['p'];
$sub_page=$_GET['s'];
$read_page=$_GET['r'];
$mlb_id=$_GET['id'];

if(isset($_POST['bsave'])){
	if(!empty($mlb_atc)){
			$errors     = array();
			$maxsize    = 10485760;
			$acceptable = array('jpeg','jpg','gif','png','JPEG','JPG','GIF','PNG','pdf','docx','doc','xlsx','xls','ppt','pptx','rar','zip');

			if(($mlb_size >= $maxsize) || ($mlb_size == 0)) {
			        $errors[] = 'File too large. File must be less than 10 megabytes.';
			}
			if(!in_array($mlb_extend, $acceptable) && !empty($mlb_extend)) {
			    $errors[] = 'Invalid file type. Only JPG, GIF, PNG, PDF, DOC, XLS, PPT, ZIP and RAR types are accepted.';
			}
			if(count($errors) === 0) {
			    $mlb_insert_atc=$mlb->mlb_insert_atc($mlb_sbj,$mlb_msg,$mlb_atc,$mlb_tgl,$mlb_jam,$mlb_tujuan,$mlb_sub_tujuan,$mrk_id,$kar_id);
	            if($mlb_insert_atc){
	            	move_uploaded_file($mlb_lok,"module/mailbox/atc/$mlb_atc");
			    	echo"<script>document.location='?p=$page&s=$sub_page';</script>";
	            }
			}else{
			    foreach($errors as $error) {
			        echo "<script>alert('$error');document.location='?p=$page&s=$sub_page';</script>";
			    }
			    die(); 
			}
            
    }else{
            $mlb_insert=$mlb->mlb_insert($mlb_sbj,$mlb_msg,$mlb_tgl,$mlb_jam,$mlb_tujuan,$mlb_sub_tujuan,$mrk_id,$kar_id);
            if($mlb_insert){
		    	echo"<script>document.location='?p=$page&s=$sub_page';</script>";
            }
    }
}
if(isset($read_page)&&($mlb_id)){
	$mlb_tampil_id=$mlb->mlb_tampil_id($mlb_id);
	$mlb_data=mysql_fetch_array($mlb_tampil_id);
}
?>