<?php

error_reporting(E_ALL ^ E_NOTICE);

date_default_timezone_set('Asia/Jakarta');

session_start(); 



require('api/class.php');

require('api/object.php');



$db->koneksi();



$date1 = date("Y-m-d H:i",strtotime(date("Y-m-d H:i")." 0 minutes"));

$unt_id = 2;

$ktr_status = "CLOSE";



$ktr_tampil_unt = $ktr->ktr_tampil_unt($unt_id);

while($ktr_data_unt = mysql_fetch_assoc($ktr_tampil_unt)){

    $ktr_open_update = $ktr_data_unt['ktr_open_update'];

    $date2 = date('Y-m-d H:i', strtotime($ktr_open_update));

    if($date2 <= $date1){

        $ktr_id = $ktr_data_unt['ktr_id'];

        $ktr_nm = $ktr_data_unt['ktr_nm'];

        $ktr_update_status = $ktr->ktr_update_status($ktr_id,$ktr_nm,$ktr_status);

        if($ktr_update_status){

            echo $ktr_nm." - ".$date2." - ".$ktr_status."<br>";

        }

    }

}

?>