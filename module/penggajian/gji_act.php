<?php
$gji_gapok=$_POST['gji_gapok'];
$gji_tunj_kel=$_POST['gji_tunj_kel'];
$gji_tunj_jab=$_POST['gji_tunj_jab'];
$gji_tunj_fung=$_POST['gji_tunj_fung'];
$gji_jum_gaji=$_POST['gji_jum_gaji'];
$gji_gaji_bpjs=$_POST['gji_gaji_bpjs'];
$gji_lain_lain=$_POST['gji_lain_lain'];
$gji_bpjs_jamsos=$_POST['gji_bpjs_jamsos'];
$gji_jum_komp=$_POST['gji_jum_komp'];
$gji_gaji_std=$_POST['gji_gaji_std'];
$gji_gaji_baru=$_POST['gji_gaji_baru'];
$gji_gaji_pajak=$_POST['gji_gaji_pajak'];
$gji_paguyuban=$_POST['gji_paguyuban'];
$gji_pajak_pph21=$_POST['gji_pajak_pph21'];

$page=$_GET['p'];
$kar_id_=$_GET['id'];
$act=$_GET['act'];

if(!empty($_GET['id'])){
  $kar_tampil_id_=$kar->kar_tampil_id($kar_id_);
  $kar_data_=mysql_fetch_array($kar_tampil_id_);
}

if(isset($_POST['bupdate'])){
  
  $gji_tampil_kar=$gji->gji_tampil_kar($kar_id_);
  $gji_cek=mysql_num_rows($gji_tampil_kar);
  if($gji_cek > 0){
	  $gji_update_kar=$gji->gji_update_kar($kar_id_,$gji_gapok,$gji_tunj_kel,$gji_tunj_jab,$gji_tunj_fung,$gji_jum_gaji,$gji_gaji_bpjs,$gji_lain_lain,$gji_bpjs_jamsos,$gji_jum_komp,$gji_gaji_std,$gji_gaji_baru,$gji_gaji_pajak,$gji_paguyuban,$gji_pajak_pph21);
  }else{
	  $gji_update_kar=$gji->gji_insert_kar($kar_id_,$gji_gapok,$gji_tunj_kel,$gji_tunj_jab,$gji_tunj_fung,$gji_jum_gaji,$gji_gaji_bpjs,$gji_lain_lain,$gji_bpjs_jamsos,$gji_jum_komp,$gji_gaji_std,$gji_gaji_baru,$gji_gaji_pajak,$gji_paguyuban,$gji_pajak_pph21);
  }
  
  if($gji_update_kar){
    echo"<script>document.location='?p=$page&id=$kar_id_';</script>";
  }else{
    echo"<script>alert('Update Failed');document.location='?p=$page&id=$kar_id_';</script>";
  }
}
?>