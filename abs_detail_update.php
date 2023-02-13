<?php
error_reporting(E_ALL ^ E_NOTICE);
date_default_timezone_set('Asia/Jakarta');
session_start(); 

require('class.php');
require('object.php');

$db->koneksi();

$kar_id = $_POST['kar_id'];
$abs_dtl_sts = $_POST['abs_dtl_sts'];
$abs_dtl_tgl = $_POST['abs_dtl_tgl'];

$abs_dtl_tampil=$abs->abs_dtl_kar_id($kar_id,$abs_dtl_tgl);
$abs_dtl_cek=mysql_num_rows($abs_dtl_tampil);

if($abs_dtl_cek > 0){
        $abs_dtl_action=$abs->abs_dtl_update($abs_dtl_tgl,$abs_dtl_sts,$kar_id);
}else{
        $abs_dtl_action=$abs->abs_dtl_insert($abs_dtl_tgl,$abs_dtl_sts,$kar_id);
}

if($abs_dtl_action){
    echo "success";
}else{
    echo "failed";
}
?>