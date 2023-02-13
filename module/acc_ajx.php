<?php
error_reporting(E_ALL ^ E_NOTICE);
date_default_timezone_set('Asia/Jakarta');
session_start();

require('../class.php');

$db=new Database();
$db->koneksi();

$acc=new Account();

$acc_username=$_POST['acc_username'];
$acc_tampil_username=$acc->acc_tampil_username($acc_username);
$acc_jml = mysql_num_rows($acc_tampil_username);
echo $acc_jml;

?>