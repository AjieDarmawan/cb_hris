<?php
error_reporting(E_ALL ^ E_NOTICE);
date_default_timezone_set('Asia/Jakarta');
session_start(); 

require('class.php');
require('object.php');

$db->koneksi();
$wfh=new WorkFromHome();

$date = date('Y-m-d',strtotime("-01 days"));
//$date="2020-04-19";
//$date=$_GET['date'];

$wfh_karyawan=$wfh->wfh_karyawan();
while($datakar=mysql_fetch_array($wfh_karyawan)){
    $_kar_id = $datakar['kar_id'];
    $wfh_activity_rekap=$wfh->wfh_activity_rekap($date,$_kar_id);
    $wfh_jml=mysql_num_rows($wfh_activity_rekap);
    if($wfh_jml > 0){
        $datawfh=mysql_fetch_array($wfh_activity_rekap);
        $wfa_username = $datawfh['wfd_username'];
        $wfa_nama = $datawfh['wfd_nama'];
        $wfa_nomor = $datawfh['wfd_nomor'];
        $wfa_data = $datawfh['wfd_count'];
        $wfa_lock = $datawfh['wfd_lock'];
        
        $wfh_activity_cek=$wfh->wfh_activity_cek($_kar_id,$date);
        $wfh_activity_jml=mysql_num_rows($wfh_activity_cek);
        if($wfh_activity_jml == 0){
            $wfh_activity_insert=$wfh->wfh_activity_insert($wfa_username,$wfa_nama,$wfa_nomor,$wfa_data,$wfa_lock,$date,$_kar_id);
        }else{
            $wfh_activity_update=$wfh->wfh_activity_update($wfa_data,$wfa_lock,$_kar_id,$date);
        }
        
        $_status = "OK";
    }else{
        $_status = "NO";
    }
    
    echo $datakar['kar_nm'] . " - " .$_status."<br>";
}
?>