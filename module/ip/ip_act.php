<?php
$ip_nm=$_POST['ip_nm'];
$ip_dns=$_POST['ip_dns'];
$ip_release=$date;
$typ_id=$_POST['typ_id'];
$unt_id=$_POST['unt_id'];
$ktr_id=$_POST['ktr_id'];

$page=$_GET['p'];
$act=$_GET['act'];
$ip_id=$_GET['id'];

if(isset($_POST['bsave'])){

	$ip_cek=$ip->ip_cek($ip_nm);
	$ip_jml=mysql_num_rows($ip_cek);
	if($ip_jml = 0){
		$ip_insert=$ip->ip_insert($ip_nm,$ip_dns,$ip_release,$typ_id,$unt_id,$ktr_id);
	}
	if($ip_insert){
		echo"<script>document.location='?p=$page';</script>";
	}else{
		echo"<script>alert('Insert Failed');document.location='?p=$page';</script>";
	}
}
elseif(isset($_POST['bupdate'])){
	//$ip_cek=$ip->ip_cek($ip_nm);
	//$ip_data=mysql_fetch_array($ip_cek);
	//$ip_jml=mysql_num_rows($ip_cek);
	
	$ip_update=$ip->ip_update($ip_id,$ip_nm,$ip_dns,$ip_release,$typ_id);
	
	if($ip_update){
		echo"<script>document.location='?p=$page&id=$ip_id';</script>";
	}else{
		echo"<script>alert('Insert Failed');document.location='?p=$page&id=$ip_id';</script>";
	}
}
if(isset($page)&&($act)){
	$ip_delete=$ip->ip_delete($ip_id);
	echo"<script>document.location='?p=$page';</script>";
}
if(isset($page)&&($ip_id)){
	$ip_tampil_id=$ip->ip_tampil_id($ip_id);
	$ip_data=mysql_fetch_array($ip_tampil_id);
}
?>