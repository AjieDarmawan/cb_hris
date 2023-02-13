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

    

    $ktr_id = $_POST['ktr_id'];

    $ktr_nm = $_POST['ktr_nm'];

    $ktr_status = json_decode($_POST['ktr_status']);

    

    $ktr_tampil_id=$ktr->ktr_tampil_id($ktr_id);

    $ktr_cek_id = mysql_num_rows($ktr_tampil_id);

    

    if($ktr_cek_id == 1){

            $ktr_update_status= $ktr->ktr_update_status_unit($ktr_id,$ktr_nm,$ktr_status[0]);

            if($ktr_update_status){

                    echo json_encode('Connected');

            }else{

                    echo json_encode('Disconnected');

            }

    }else{

            echo json_encode('Disconnected');

    }

?>