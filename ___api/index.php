<?php
    if (isset($_SERVER['HTTP_ORIGIN'])) {
        header("Access-Control-Allow-Origin: {$_SERVER['HTTP_ORIGIN']}");
        header('Access-Control-Allow-Credentials: true');
        header('Access-Control-Max-Age: 86400');    // cache 1 hari
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

    $dataArr = array();
    
    $unt_id = 2;
    $ktr_tampil_unt=$ktr->ktr_tampil_unt($unt_id);
    $ktr_cek = mysql_num_rows($ktr_tampil_unt);
    
    if($ktr_cek > 0){
        while($ktr_data = mysql_fetch_assoc($ktr_tampil_unt)){
    
            $dataArr["dataView"]["unit"][] = array("kode_unit"=>$ktr_data['ktr_id'],
                                                   "nama_unit"=>$ktr_data['ktr_kd'],
                                                   "koordinator_unit"=>$ktr_data['ktr_koordinator'],
                                                   "status_unit"=>$ktr_data['ktr_status']);
        
        }
        
        $dataArr["mgs"] = "Connected";
        $dataArr["status"] = "success";
    }else{
        $dataArr["mgs"] = "Disconnected";
        $dataArr["status"] = "failed";
    }

    echo json_encode($dataArr);
?>