<?php
error_reporting(E_ALL ^ E_NOTICE);
date_default_timezone_set('Asia/Jakarta');
session_start(); 

require('class.php');
require('object.php');

$db->koneksi();

$kar_id = $_POST['kar_id'];
$shiftextra =  $_POST['shiftextra'];
$kar_update_shift=$kar->kar_update_shift($kar_id,$shiftextra);
if($kar_update_shift){
    echo "success";
}else{
    echo "failed";
}
?>