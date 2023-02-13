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

require('class.php');
require('object.php');

$db->koneksi();

$r_awal_ori = date('Y-m-01');
$r_sekarang_ori = date('Y-m-d');

$username = $_GET['nik'] ? $_GET['nik'] : $_POST['nik'];

$kar_tampil_div_in = $kar->kar_tampil_nik($username);
$kar_data_div_in = mysql_fetch_assoc($kar_tampil_div_in);

echo $kar_data_div_in['kar_disable_pulang'];

?>