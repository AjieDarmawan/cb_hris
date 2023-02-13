<?php
error_reporting(E_ALL ^ E_NOTICE);
date_default_timezone_set('Asia/Jakarta');
session_start();

require('../class.php');

$db=new Database();
$db->koneksi();

$wfh=new WorkFromHome();

$dataArr=array();
$wfh_id=$_POST['wfh_id'];
$wfh_aktifitas_id=$wfh->wfh_aktifitas_id($wfh_id);
$wfh_jml=mysql_num_rows($wfh_aktifitas_id);
if($wfh_jml > 0){
    $data=mysql_fetch_array($wfh_aktifitas_id);
    $dataArr['data']['wfh_insert'] = $data['wfh_insert'];
    $dataArr['data']['wfh_aksi_type'] = $data['wfh_aksi_type'];
    $exp_aksi = explode(",",$data['wfh_aksi']);
    for($i=0;$i<count($exp_aksi);$i++){
        $dataArr['data']['wfd_aksi'][] = $exp_aksi[$i];
    }
    
    $exp_satuan = explode(",",$data['wfh_satuan']);
    for($i=0;$i<count($exp_satuan);$i++){
        $dataArr['data']['wfd_satuan'][] = $exp_satuan[$i];
    }
    
    $exp_lokasi = explode(",",$data['wfh_lokasi']);
    for($i=0;$i<count($exp_lokasi);$i++){
        $dataArr['data']['wfd_lokasi'][] = $exp_lokasi[$i];
    }
}else{
    $dataArr['data'] = '--Pilih--';
}

echo json_encode($dataArr);
?>