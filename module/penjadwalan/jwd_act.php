<?php
session_start(); 
$jwd_start=substr($_POST['date_range'], 0,10);
$jwd_end=substr($_POST['date_range'], 13,23);
$jwd_nm=$_POST['jwd_nm'];
$jwo_kode=$_POST['jwo_kode'];

$page=$_GET['p'];
$kar_id_=$_GET['id'];
$act=$_GET['act'];
$jwd_id=$_GET['no'];

if(isset($_GET['p']) && isset($_GET['id'])){
  $_SESSION['kar_id_jwd'] = $_GET['id'];
}
if(isset($_GET['p']) && !isset($_GET['id'])){
  $_SESSION['kar_id_jwd'] = '';
}
if(isset($_POST['bsave'])){
  $jwd_insert=$jwd->jwd_insert($jwd_nm,$jwd_start,$jwd_end,$kar_id_);
  if($jwd_insert){
    echo"<script>document.location='?p=$page&id=$kar_id_';</script>";
  }else{
    echo"<script>alert('Insert Failed');document.location='?p=$page&id=$kar_id_';</script>";
  }
}
if(isset($page)&&($kar_id_)&&($act=="hapus")){
	$jwd_delete=$jwd->jwd_delete($jwd_id);
	echo"<script>document.location='?p=$page&id=$kar_id_';</script>";
}
if(isset($_POST['apiupdate'])){
  $jwo_update=$jwd->jwo_update($jwo_kode);
  if($jwo_update==1){
    echo"<script>document.location='?p=$page';</script>";
  }else{
    echo"<script>alert('Insert Failed');document.location='?p=$page';</script>";
  }
}
?>