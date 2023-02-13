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
}

//$tujuan = array('248');
$tujuan_count=count($tujuan);

$kar_tampil=$kar->kar_tampil();
if($kar_tampil){
foreach($kar_tampil as $data){

    $kar_id_=$data['kar_id'];
    $kar_nm_=$data['kar_nm'];
    $kar_tampil_detail=$kar->kar_tampil_detail($kar_id_);
    $kar_data_detail=mysql_fetch_assoc($kar_tampil_detail);
    
    if($kar_data_detail['kar_dtl_typ_krj']=="Kontrak"){
    
        $kpi_history_kar_limit=$kpi->kpi_history_kar_limit($kar_id_);
        $kpi_data_kar_limit=mysql_fetch_assoc($kpi_history_kar_limit);
        $kpi_cek_kar_limit=mysql_num_rows($kpi_history_kar_limit);
        if($kpi_cek_kar_limit > 0){
            
            $kpi_kontrak = $kpi_data_kar_limit['kph_kode'];
            $kpi_cek_history=$kpi->kpi_cek_history($kpi_kontrak,$kar_id_);
            $kpi_data_history=mysql_fetch_assoc($kpi_cek_history);
            $kpi_jml_history=mysql_num_rows($kpi_cek_history);
            if($kpi_jml_history == 0){
                $kpi_label = "Eva.KPI-01";
            }else{
                $exp_kpi = explode('-',$kpi_data_history['kpi_priode']);
                $kpi_ke = intval($exp_kpi[1]) + 1;
                $kpi_label = "Eva.KPI-".sprintf("%02d", $kpi_ke);
            }
    
            $kph_data = explode(',',$kpi_data_kar_limit['kph_data']);
            for($i=0;$i<$kpi_data_kar_limit['kph_masa'];$i++){
 
                if($kph_data[$i] == $date){
                    
                    //Notify DATA
                    $ntf_data_act="Pengajuan ".$kpi_label." K".$kpi_data_kar_limit['kph_kontrak']; //ACT Disesuaikan
                    $ntf_data_isi=$kar_nm_; //ISI Disesuaikan
                    $ntf_data_url="?p=data_kpi&id=".$kar_id_."&act=open"; //URL Disesuaikan
                    $ntf_data_sumber="SYSTEM"; //Auto Sumber = SYSTEM
                    $ntf_data_ip="";
                    $ntf_data_tgl=$date;
                    $ntf_data_jam=$time;
                    
                    for($z=0; $z<$tujuan_count; $z++){
                        $ntf_data_tujuan=$tujuan[$z]; //Semua Tujuan = ALL
                     
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
}

    
    
    
    

?>
