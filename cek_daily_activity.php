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

$wfd_tanggal = date('Y-m-d');

$wfd_username = $_GET['nik'] ? $_GET['nik'] : $_POST['nik'];

$wfh_aktifitas = $wfh->wfh_aktifitas_last_username($wfd_tanggal,$wfd_username);
$wfh_cek = mysql_num_rows($wfh_aktifitas);
if($wfh_cek > 0){
    $wfh_data = mysql_fetch_assoc($wfh_aktifitas);
    if($wfh_data['wfd_lock'] == "Y"){
        $disable_pulang = "N";
    }else{
        $disable_pulang = "Y";
    }
}else{
    $disable_pulang = "Y";
}

echo $disable_pulang;
?>