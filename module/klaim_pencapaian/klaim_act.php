<?php
session_start(); 
$page=$_GET['p'];
$act=$_GET['act'];

$klm_date=date('d/m/Y');
$klm_date_ori=date('Y-m-d');

$_kar_nik= str_replace(".","",$kar_data['kar_nik']);
?>