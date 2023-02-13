<?php
session_start(); 
$page=$_GET['p'];
$act=$_GET['act'];
$kar_id_=$_GET['id'];

$kar_tampil_id=$kar->kar_tampil_id($kar_id_);
$kar_data_=mysql_fetch_array($kar_tampil_id);

//AUTO FPK
$pecah_nik=explode(".",$kar_data_['kar_nik']);
$kd_karyawan=$pecah_nik[1];	
$kd_awal="FC";
$kd_tahun = substr(date("Y"),2,4);
$fpk_kd_awal = $nla->fpk_kd_awal($kdawal);
$cek_fpk_kd  = mysql_num_rows($fpk_kd_awal);
$data_fpk_kd  = mysql_fetch_array($fpk_kd_awal);

$max_fpk_kd = $data_fpk_kd['max_kd'];
$no_urut_kd = (int) substr($max_fpk_nik, 7, 4);
$no_urut_kd++;

$fpk_kd_auto = $nla->fpk_kd_auto();
$data_kd_auto  = mysql_fetch_array($fpk_kd_auto);
$no_urut_auto = $data_kd_auto['max_kd_auto'];
$no_urut_auto++;

$new_kd = $kd_awal .$kd_karyawan. $kd_tahun .sprintf("%04s", $no_urut_auto);


//VARIABLE
$fpk_kd = $new_kd;


if(isset($_POST['btambah'])){
    $rkm_nilai=$_POST['rkm_nilai'];
    $rkm_keterangan=$_POST['rkm_keterangan'];
    $rkm_pelapor=$_POST['rkm_pelapor'];
    $rkm_tgl=$_POST['rkm_tgl'];
    
    $rkm_insert=$nla->rkm_insert($rkm_nilai,$rkm_keterangan,$rkm_pelapor,$rkm_tgl,$kar_id_);
    if($rkm_insert){
        echo"<script>document.location='?p=$page&id=$kar_id_';</script>";
    }else{
        echo"<script>alert('Insert Failed');document.location='?p=$page&id=$kar_id_';</script>";
    }
}


$pecah__=explode(" ",$tgl->tgl_indo($date));
$thn__=$pecah__[2];
$bln__=$pecah__[1];
$tgl__=$pecah__[0];


$kar_tampil=$kar->kar_tampil_filter_2();
?>