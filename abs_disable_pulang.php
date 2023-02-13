<?php
error_reporting(E_ALL ^ E_NOTICE);
date_default_timezone_set('Asia/Jakarta');
session_start(); 

require('class.php');
require('object.php');

$db->koneksi();

$kar_id = $_POST['kar_id'];
$disablecheck =  $_POST['disablecheck'];
$kar_update_disable_pulang=$kar->kar_update_disable_pulang($kar_id,$disablecheck);
if($kar_update_disable_pulang){
    echo "success";
}else{
    echo "failed";
}
?>