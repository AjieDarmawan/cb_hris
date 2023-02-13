<?php
error_reporting(E_ALL ^ E_NOTICE);
date_default_timezone_set('Asia/Jakarta');
session_start();

require('../class.php');

$db=new Database();
$db->koneksi();

$wfh=new WorkFromHome();

$dataArr=array('data'=>'');
$wfh_status=$_POST['wfh_status'];
if($wfh_status == 'P'){
    $wfh_status_report=$wfh->wfh_status_report();
    while($datakar=mysql_fetch_array($wfh_status_report)){
        $wfh_tanggal=$_POST['wfh_tanggal'];
        $_kar_id = $datakar['kar_id'];
        $wfh_aktifitas_last=$wfh->wfh_aktifitas_last($wfh_tanggal,$_kar_id);
        $wfh_jml=mysql_num_rows($wfh_aktifitas_last);
        if($wfh_jml > 0){
            $datawfh=mysql_fetch_array($wfh_aktifitas_last);
            if($datawfh['wfd_lock'] == 'Y'){
                $dataArr['data'][] = array('wdf_nik'=>$datakar['kar_nik'],
                                    'wdf_nama'=>$datakar['kar_nm'],
                                    'wdf_divisi'=>$datakar['div_nm']);
            }
        }
       
    }
}elseif($wfh_status == 'C'){
    $wfh_status_report=$wfh->wfh_status_report();
    while($datakar=mysql_fetch_array($wfh_status_report)){
        $wfh_tanggal=$_POST['wfh_tanggal'];
        $_kar_id = $datakar['kar_id'];
        $wfh_aktifitas_last=$wfh->wfh_aktifitas_last($wfh_tanggal,$_kar_id);
        $wfh_jml=mysql_num_rows($wfh_aktifitas_last);
        if($wfh_jml > 0){
            $datawfh=mysql_fetch_array($wfh_aktifitas_last);
            if($datawfh['wfd_lock'] == 'N'){
                $dataArr['data'][] = array('wdf_nik'=>$datakar['kar_nik'],
                                    'wdf_nama'=>$datakar['kar_nm'],
                                    'wdf_divisi'=>$datakar['div_nm']);
            }
        }
       
    }
}elseif($wfh_status == 'N'){
   $wfh_status_report=$wfh->wfh_status_report();
    while($datakar=mysql_fetch_array($wfh_status_report)){
        $wfh_tanggal=$_POST['wfh_tanggal'];
        $_kar_id = $datakar['kar_id'];
        $wfh_aktifitas_last=$wfh->wfh_aktifitas_last($wfh_tanggal,$_kar_id);
        $datawfh=mysql_fetch_array($wfh_aktifitas_last);
        if($datawfh['wfd_lock'] == NULL){
            $dataArr['data'][] = array('wdf_nik'=>$datakar['kar_nik'],
                                    'wdf_nama'=>$datakar['kar_nm'],
                                    'wdf_divisi'=>$datakar['div_nm']);
        }
       
    } 
}

echo json_encode($dataArr);
?>