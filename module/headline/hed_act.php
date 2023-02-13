<?php
$hed_sbj=ucwords($_POST['hed_sbj']);
$hed_msg=$_POST['hed_msg'];
//$hed_msg=str_replace('<br>', '', $_POST['hed_msg']);
$hed_tgl=$date;
$mrk_id=$_POST['mrk_id'];
$div_id=$_POST['div_id'];

$page=$_GET['p'];
$act=$_GET['act'];
$hed_id=$_GET['id'];

if(isset($_POST['bsave'])){
	$hed_insert=$hed->hed_insert($hed_sbj,$hed_msg,$hed_tgl,$mrk_id,$div_id);
	if($hed_insert){
		echo"<script>document.location='?p=$page';</script>";
	}else{
		echo"<script>alert('Insert Failed');document.location='?p=$page';</script>";
	}
}
elseif(isset($_POST['bupdate'])){
	$hed_update=$hed->hed_update($hed_id,$hed_sbj,$hed_msg,$mrk_id,$div_id);
	if($hed_update){
		echo"<script>document.location='?p=$page&id=$hed_id';</script>";
	}else{
		echo"<script>alert('Insert Failed');document.location='?p=$page&id=$hed_id';</script>";
	}
}
if(isset($page)&&($act=="hapus")){
	$hed_delete=$hed->hed_delete($hed_id);
	echo"<script>document.location='?p=$page';</script>";
}
elseif(isset($page)&&($act=="block")){
    $hed_sts="N";
    $hed_update_sts=$hed->hed_update_sts($hed_id,$hed_sts);
    echo"<script>document.location='?p=$page';</script>";
}
elseif(isset($page)&&($act=="unblock")){
    $hed_sts="A";
    $hed_update_sts=$hed->hed_update_sts($hed_id,$hed_sts);
    echo"<script>document.location='?p=$page';</script>";
}
if(isset($page)&&($hed_id)){
	$hed_tampil_id=$hed->hed_tampil_id($hed_id);
	$hed_data=mysql_fetch_array($hed_tampil_id);
}
?>