<?php
$acv_nm=ucwords($_POST['acv_nm']);
$acv_lok=str_replace(' ', '_', $_FILES['acv_file']['tmp_name']);
$acv_file=str_replace(' ', '_', $_FILES['acv_file']['name']);

//$acv_lok=$_FILES['acv_file']['tmp_name'];
//$acv_file=$_FILES['acv_file']['name'];
$acv_size=$_FILES['acv_file']['size'];
$acv_type=$_FILES['acv_file']['type'];
$acv_pecah=explode(".", $acv_file);
$acv_extend=$acv_pecah[1];
$acv_tgl=$date;
$div_id=$_POST['div_id'];

$page=$_GET['p'];
$act=$_GET['act'];
$acv_id=$_GET['id'];

if(isset($page)&&($act=="hapus")){
	$acv_delete=$acv->acv_delete($acv_id);
	echo"<script>document.location='?p=$page';</script>";
}
elseif(isset($page)&&($act=="block")){
    $acv_sts="N";
    $acv_update_sts=$acv->acv_update_sts($acv_id,$acv_sts);
    echo"<script>document.location='?p=$page';</script>";
}
elseif(isset($page)&&($act=="unblock")){
    $acv_sts="A";
    $acv_update_sts=$acv->acv_update_sts($acv_id,$acv_sts);
    echo"<script>document.location='?p=$page';</script>";
}
if(isset($page)&&($acv_id)){
	$acv_tampil_id=$acv->acv_tampil_id($acv_id);
	$acv_data=mysql_fetch_array($acv_tampil_id);
}

if(isset($_POST['bsave'])){
	if(!empty($acv_file)){
			$errors     = array();
			$maxsize    = 10485760;
			$acceptable = array('pdf','docx','doc','xlsx','xls','ppt','pptx','rar','zip');

			if(($acv_size >= $maxsize) || ($acv_size == 0)) {
			        $errors[] = 'File too large. File must be less than 10 megabytes.';
			}
			if(!in_array($acv_extend, $acceptable) && !empty($acv_extend)) {
			    $errors[] = 'Invalid file type. Only PDF, DOC, XLS, ZIP and RAR types are accepted.';
			}
			if(count($errors) === 0) {
			    $acv_insert_file=$acv->acv_insert_file($acv_nm,$acv_file,$acv_tgl,$div_id);
	            if($acv_insert_file){
	            	move_uploaded_file($acv_lok,"module/archive/file/$acv_file");
			    	echo"<script>document.location='?p=$page';</script>";
	            }
			}else{
			    foreach($errors as $error) {
			        echo "<script>alert('$error');document.location='?p=$page';</script>";
			    }
			    die(); 
			}
            
    }else{
            $acv_insert=$acv->acv_insert($acv_nm,$acv_tgl,$div_id);
            if($acv_insert){
		    	echo"<script>document.location='?p=$page';</script>";
            }
    }
}
elseif(isset($_POST['bupdate'])){
	if(!empty($acv_file)){
		$acv_update_file=$acv->acv_update_file($acv_id,$acv_nm,$acv_file,$div_id);
		if($acv_update_file){
			$dir_file="module/archive/file/$acv_data[acv_file]";	
			unlink($dir_file);
			move_uploaded_file($acv_lok,"module/archive/file/$acv_file");
			echo"<script>document.location='?p=$page&id=$acv_id';</script>";
		}else{
			echo"<script>alert('Update Failed');document.location='?p=$page&id=$acv_id';</script>";
		}
	}else{
		$acv_update=$acv->acv_update($acv_id,$acv_nm,$div_id);
		if($acv_update){
			echo"<script>document.location='?p=$page&id=$acv_id';</script>";
		}else{
			echo"<script>alert('Update Failed');document.location='?p=$page&id=$acv_id';</script>";
		}
	}
}
?>