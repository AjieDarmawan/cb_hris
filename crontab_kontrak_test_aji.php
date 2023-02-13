<?php
error_reporting(E_ALL ^ E_NOTICE);
date_default_timezone_set('Asia/Jakarta');
session_start(); 

require('class.php');
require('object.php');

$db->koneksi();

$date=date('Y-m-d');
$time=date('H:i:s');

$div_id=5;
$kar_tampil_div=$kar->kar_tampil_div($div_id);
if($kar_tampil_div){
    foreach($kar_tampil_div as $data){
        $tujuan[]=$data['kar_id'];
    }
    $tujuan[]=37;
}

$tujuan_count=count($tujuan);

$kar_tampil=$kar->kar_tampil();
if($kar_tampil){
foreach($kar_tampil as $data){

    $kar_id_=$data['kar_id'];
    $kar_nm_=$data['kar_nm'];
    $kar_tampil_detail=$kar->kar_tampil_detail($kar_id_);
    $kar_data_detail=mysql_fetch_assoc($kar_tampil_detail);
    
    if($kar_data_detail['kar_dtl_typ_krj']=="Kontrak"){
    
        $kkn_tampil_kar_limit=$nla->kkn_tampil_kar_limit($kar_id_);
        $kkn_data_kar_limit=mysql_fetch_assoc($kkn_tampil_kar_limit);
        $kkn_cek_kar_limit=mysql_num_rows($kkn_tampil_kar_limit);
        if($kkn_cek_kar_limit > 0){
    
            $pecah_end=explode("-", $kkn_data_kar_limit['kkn_end']);
            $end_hari=$pecah_end[2];
            $end_bulan=sprintf('%02d', $pecah_end[1] - 2); //2 bulan sebelum
            $end_tahun=$pecah_end[0];
            $end_sebulansebelumny=$end_tahun."-".$end_bulan."-".$end_hari;
        
            if($end_sebulansebelumny < $date){
                //Notify DATA
                $ntf_data_act="Masa Kontrak ".$kkn_data_kar_limit['kkn_kontrak']." Habis"; //ACT Disesuaikan
                $ntf_data_isi=$kar_nm_; //ISI Disesuaikan
                $ntf_data_url="?p=data_penilaian&id=".$kar_id_."&act=open"; //URL Disesuaikan
                $ntf_data_sumber="SYSTEM"; //Auto Sumber = SYSTEM
                $ntf_data_ip="";
                $ntf_data_tgl=$date;
                $ntf_data_jam=$time;
                
                for($i=0; $i<$tujuan_count; $i++){
                    
                    $ntf_data_tujuan=$tujuan[$i]; //Semua Tujuan = ALL
                     
                    $ntf_data_cek=$ntf->ntf_data_cek($ntf_data_act,$ntf_data_isi,$ntf_data_url,$ntf_data_tujuan,$ntf_data_sumber);
                    $ntf_jml_cek=mysql_num_rows($ntf_data_cek);
                    if($ntf_jml_cek == 0){

                        $ntf_data_insert=$ntf->ntf_data_insert($ntf_data_act,$ntf_data_isi,$ntf_data_url,$ntf_data_ip,$ntf_data_tgl,$ntf_data_jam,$ntf_data_tujuan,$ntf_data_sumber);
                        //End Notify DATA
                    }
                }
                
            }
        }
    }
}
}

    
    
    
    

?>
