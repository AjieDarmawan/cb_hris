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

    

    $mac_address = $_GET['mac_address'];

    

    $dataArr = array();

    $ktr_tampil_mac=$ktr->ktr_tampil_mac($mac_address);

    $ktr_cek_mac=mysql_num_rows($ktr_tampil_mac);

    

    $dataArr['ktr_cek_mac'] = $ktr_cek_mac;

    if($ktr_cek_mac > 0){

	if($ktr_cek_mac == 1){

		$ktr_data_mac=mysql_fetch_assoc($ktr_tampil_mac);

                $dataArr['ktr_data_mac'] = array('ktr_nm'=>$ktr_data_mac['ktr_nm'],

                                                 'ktr_id'=>$ktr_data_mac['ktr_id']

                                                 );

        }else{

            $dataArr['ktr_data_mac'] = "";

        }

        

    }else{

        $dataArr['ktr_data_mac'] = "";

    }

    

    echo json_encode($dataArr);

?>