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

    $ktr_tampil_status = $ktr->ktr_tampil_status();

    if(mysql_num_rows($ktr_tampil_status) > 0){

        while($row = mysql_fetch_assoc($ktr_tampil_status)){  

            //$dataArr[] = 'unit'.$row['ktr_id']."#".$row['ktr_status'];

            $dataArr['dataid'][] = 'unit'.$row['ktr_id'];

            $dataArr['datastatus'][] = $row['ktr_status'];    

        }

    }else{

            $dataArr['dataid'][] = 'unit0';

        $dataArr['datastatus'][] = 'CLOSE';

    }

    

    echo json_encode($dataArr);

?>