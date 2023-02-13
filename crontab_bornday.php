<?php
error_reporting(E_ALL ^ E_NOTICE);
date_default_timezone_set('Asia/Jakarta');
session_start(); 

require('class.php');
require('object.php');

$db->koneksi();

$date=date('Y-m-d');
$time=date('H:i:s');

$date_now=date('m-d');

$kar_tampil_=$kar->kar_tampil();
if($kar_tampil_){
foreach($kar_tampil_ as $data){

    $kar_id_=$data['kar_id'];
    $kar_nm_=$data['kar_nm'];
    $kar_tgl_lahir_=date('m-d',strtotime($data['kar_tgl_lahir']));

    if($kar_tgl_lahir_ == $date_now ){
	$div_id=5;
	$kar_tampil_div=$kar->kar_tampil_div($div_id);
	if($kar_tampil_div){
	    foreach($kar_tampil_div as $data2){
		$tujuan[$kar_id_][]=$data2['kar_id'];
	    }
	}
        $tujuan[$kar_id_][]=$kar_id_;
    }
}
}

////////////////////////////////////////////////////////////

$kar_tampil=$kar->kar_tampil();
if($kar_tampil){
foreach($kar_tampil as $data){

    $kar_id_=$data['kar_id'];
    $kar_nm_=$data['kar_nm'];
    $kar_tgl_lahir_=date('m-d',strtotime($data['kar_tgl_lahir']));

    if($kar_tgl_lahir_ == $date_now ){
        
        //Notify DATA
        $ntf_data_act="Happy Born Day"; //ACT Disesuaikan
        $ntf_data_isi=$kar_nm_; //ISI Disesuaikan
        $ntf_data_url="?p=lihat_notifikasi&act=open&id=".md5($kar_id_).""; //URL Disesuaikan
        $ntf_data_sumber="SYSTEM"; //Auto Sumber = SYSTEM
        $ntf_data_ip="";
        $ntf_data_tgl=$date;
        $ntf_data_jam=$time;
        
        $tujuan_count = count($tujuan[$kar_id_]);
        
        for($i=0; $i<$tujuan_count; $i++){
            
            $ntf_data_tujuan=$tujuan[$kar_id_][$i]; //Semua Tujuan = ALL
          
            $ntf_data_cek=$ntf->ntf_data_cek_bornday($ntf_data_act,$ntf_data_isi,$ntf_data_url,$ntf_data_tujuan,$ntf_data_sumber,$ntf_data_tgl);
            $ntf_jml_cek=mysql_num_rows($ntf_data_cek);
            if($ntf_jml_cek == 0){

                //$ntf_data_insert=$ntf->ntf_data_insert($ntf_data_act,$ntf_data_isi,$ntf_data_url,$ntf_data_ip,$ntf_data_tgl,$ntf_data_jam,$ntf_data_tujuan,$ntf_data_sumber);
                //End Notify DATA
            }

        }

    }
}
}
?>
