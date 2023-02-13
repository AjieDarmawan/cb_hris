<?php
if (isset($_SERVER['HTTP_ORIGIN'])) {
    header("Access-Control-Allow-Origin: {$_SERVER['HTTP_ORIGIN']}");
    header('Access-Control-Allow-Credentials: true');
    header('Access-Control-Max-Age: 86400');
}


if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
    if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_METHOD']))
        header("Access-Control-Allow-Methods: GET, POST, OPTIONS");         
    if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']))
        header("Access-Control-Allow-Headers:        {$_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']}");
    exit(0);
}

error_reporting(E_ALL ^ E_NOTICE);
date_default_timezone_set('Asia/Jakarta');
session_start(); 

require('class.php');
require('object.php');

$db->koneksi();

$username = $_GET['username'] ? $_GET['username'] : $_POST['username'];
$password =  $_GET['password'] ? $_GET['password'] : $_POST['password'];

$acc_signin=$acc->acc_signin($username,$password);
if(($acc_signin)){
	$str1 = substr($username, 0,2);
	$str2 = substr($username, 2,4);
	$str3 = substr($username, 6,4);
	$nik = strtoupper($str1.'.'.$str2.'.'.$str3);
	$kar_tampil_nik = $kar->kar_tampil_nik($nik);
	$kar_data_nik = mysql_fetch_assoc($kar_tampil_nik);
	$data['status'] = 'sukses';
	$data['nik'] = $nik;
	$data['account'] = array('username'=>strtoupper($username),
							 'nik'=>$kar_data_nik['kar_nik'],
							 'nama'=>$kar_data_nik['kar_nm']
							 );
}else{
	$data['status'] = 'gagal';
}

echo json_encode($data);