<?php
session_start(); 
$page=$_GET['p'];
$act=$_GET['act'];
$print=$_GET['to'];
$pdf=$_GET['to'];
if(isset($_POST['bsortir_history'])){
	$_SESSION['tanggal_absen_history']=$_POST['tanggal_absen_history'];
}

if(!empty($_SESSION['tanggal_absen_history'])){
	$izn_kirim=$_SESSION['tanggal_absen_history'];
}else{
	$izn_kirim=$date;
}

if(isset($_POST['brefresh_history'])){
	$_SESSION['tanggal_absen_history']='';
	echo"<script>document.location='?p=$page';</script>";
}
?>