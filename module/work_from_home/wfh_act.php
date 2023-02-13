<?php
session_start(); 
$page=$_GET['p'];
$act=$_GET['act'];

if(isset($_POST['bday'])){

    if(!empty($_POST['filter_day'])){
        $_SESSION['fday'] = $_POST['filter_day'];
        $filter_day = $_SESSION['fday'];
    }else{
        $_SESSION['fday'] = "";
    }

    echo"<script>document.location='?p=$page';</script>";
}


if(isset($_POST['bclearday'])){
    $_SESSION['fday'] = "";
    echo"<script>document.location='?p=$page';</script>";
}

if(!empty($_SESSION['fday'])){
    $wfd_date=date('d/m/Y',strtotime($_SESSION['fday']));
    $wfd_date_ori = $_SESSION['fday'];
}else{
    $wfd_date=date('d/m/Y');
    $wfd_date_ori=date('Y-m-d');
}

$filter_divisi = 8;

if(isset($page)&&($act=="open")){
    $subact=$_GET['subact'];
    $wfd_key=$_GET['id'];
    $wfh_aktifitas_key=$wfh->wfh_aktifitas_key($wfd_key);
    $wfd_data=mysql_fetch_array($wfh_aktifitas_key);
    $kar_id_=$wfd_data['kar_id'];
    
    $acc_tampil_kar_=$acc->acc_tampil_kar($kar_id_);
    $acc_data_=mysql_fetch_array($acc_tampil_kar_);
    
    if(!empty($acc_data_['acc_img'])){
      $img_user=$acc_data_['acc_img'];
    }else{
      $img_user="avatar.jpg";
    }
    
    if($wfd_data['wfd_lock']=='Y'){
        $wfh_locked = "<span class='text-danger'>(LOCKED)</span>";
    }else{
        $wfh_locked = "";
    }
    
    $dataRPT=array();
    $wfh_tampil_aktifitas=$wfh->wfh_tampil_aktifitas($wfd_key);
    while($data=mysql_fetch_array($wfh_tampil_aktifitas)){
        if($data['wfd_satuan'] == "Persentase"){
            $wfd_value = $data['wfd_value'] . "%";
        }else{
            $wfd_value = $data['wfd_value'];
        }
        $dataRPT[$data['wfh_group']][] = array('wfd_id' => $data['wfd_id'],
                                               'wfd_key' => $data['wfd_key'],
                                               'wfd_aktifitas' => $data['wfd_aktifitas'],
                                               'wfd_aksi' => $data['wfd_aksi'],
                                               'wfd_start' => date('H:i',strtotime($data['wfd_start'])),
                                               'wfd_end' => date('H:i',strtotime($data['wfd_end'])),
                                               'wfd_value' => $wfd_value,
                                               'wfd_lokasi' => $data['wfd_lokasi'],
                                               'wfd_keterangan' => $data['wfd_keterangan'],
                                               'wfd_status' => $data['wfd_status'],
                                               'wfd_lock' => $data['wfd_lock'],
                                               'kar_id' => $data['kar_id']);
    }
    
    if(isset($page)&&($subact=="hapus")){
        $wfd_id=$_GET['subid'];
        $wfh_data_delete_id=$wfh->wfh_data_delete_id($wfd_id);
        echo"<script>document.location='?p=$page&act=open&id=$wfd_key';</script>";
    }
}else{
  $kar_id_=$_GET['id'];
}

if(isset($_GET['p']) && isset($_GET['id'])){
  $_SESSION['kar_id_wfh'] = $_GET['id'];
}

if(isset($_GET['p']) && !isset($_GET['id'])){
  $_SESSION['kar_id_wfh'] = '';
}

$kar_tampil_id=$kar->kar_tampil_id($kar_id_);
$kar_data_=mysql_fetch_array($kar_tampil_id);

if(isset($_POST['btncreatewfh'])){
    
    $exp_wfdtanggal=explode('/',$_POST['wfd_tanggal']);
    $wfd_tanggal = $exp_wfdtanggal[2]."-".$exp_wfdtanggal[1]."-".$exp_wfdtanggal[0];
    
    $wfd_username = $kar_data['kar_nik'];
    $wfd_nama = $kar_data['kar_nm'];
    $wfd_divisi = $kar_data['div_id'];
    $wfd_start = $_POST['wfd_start'];
    $wfd_end = $_POST['wfd_end'];
    $aksiArr = $_POST['wfd_aksi'] ? $_POST['wfd_aksi'] : 'Other';
    $wfd_aksi = implode(",", $aksiArr);
    $wfd_satuan = $_POST['wfd_satuan'] ? $_POST['wfd_satuan'] : 'QTY';
    $wfd_value = $_POST['wfd_value'] ? $_POST['wfd_value'] : 0;
    
    $wfd_lokasi = $_POST['wfd_lokasi'] ? $_POST['wfd_lokasi'] : 'Other';
    $wfd_keterangan = $_POST['wfd_keterangan'];
    
    $wfh_id = $_POST['wfh_id'];
    
    if($wfh_id > 1){
        $wfh_aktifitas_id=$wfh->wfh_aktifitas_id($wfh_id);
        $wfh_data=mysql_fetch_array($wfh_aktifitas_id);
        $wfd_aktifitas = $wfh_data['wfh_aktifitas'];
    }else{
        $wfd_aktifitas = $_POST['wfd_aktifitas'];
    }
    
    $wft_start = $_POST['wft_start'];
    $wft_end = $_POST['wft_end'];
    $wft_value = $_POST['wft_value'];
    
    $wft_target_id=$wfh->wfh_target_id($wfh_id);
    $wft_cek=mysql_num_rows($wft_target_id);
    if($wft_cek > 0){
        $wft_data=mysql_fetch_array($wft_target_id);
        $wft_start = $wft_data['wft_start'];
        $wft_end = $wft_data['wft_end'];
        $wft_value = $wft_data['wft_value'];
    }
    
    if($wfd_value > 0 && $wfd_value >= $wft_value){
        $wfd_status = "Selesai";
    }elseif($wfd_value > 0 && $wfd_value < $wft_value){
        $wfd_status = "Proses";
    }else{
        $wfd_status = "Nihil";
    }
    
    $_dateuniq = date('dmY',strtotime($wfd_tanggal));
    $wfd_nomor= str_replace(".","",$wfd_username) . $_dateuniq;
    $wfd_key=md5($wfd_nomor);
    
    $wfh_data_cek=$wfh->wfh_data_cek($wfd_nomor,$wfd_aktifitas,$wfd_aksi);
    $wfh_cek=mysql_num_rows($wfh_data_cek);
    if($wfh_cek == 0){
        $wfh_data_insert=$wfh->wfh_data_insert($wfd_tanggal,$wfd_key,$wfd_nomor,$wfd_username,$wfd_nama,$wfd_divisi,$wfd_start,$wfd_end,$wfd_aksi,$wfd_satuan,$wfd_value,$wfd_aktifitas,$wfd_lokasi,$wfd_keterangan,$wfd_status,$wfh_id,$wft_start,$wft_end,$wft_value,$kar_id);
    
    }
    echo"<script>document.location='?p=$page';</script>";
    //echo"<script>alert('Insert Rutin');document.location='?p=$page';</script>";
    
}
if(isset($page)&&($act=="hapus")){
    $wfd_key=$_GET['id'];
    $wfh_data_delete=$wfh->wfh_data_delete($wfd_key);
    echo"<script>document.location='?p=$page';</script>";
}
elseif(isset($page)&&($act=="publish")){
    $wfd_key=$_GET['id'];
    $wfd_lock="Y";
    $wfh_data_lock=$wfh->wfh_data_lock($wfd_key,$wfd_lock);
    if($wfh_data_lock){
        $wfh_activity_rekap=$wfh->wfh_activity_rekap($wfd_date_ori,$kar_id);
        $wfh_jml=mysql_num_rows($wfh_activity_rekap);
        if($wfh_jml > 0){
            $datawfh=mysql_fetch_array($wfh_activity_rekap);
            $wfa_username = $datawfh['wfd_username'];
            $wfa_nama = $datawfh['wfd_nama'];
            $wfa_nomor = $datawfh['wfd_nomor'];
            $wfa_data = $datawfh['wfd_count'];
            $wfa_lock = $datawfh['wfd_lock'];
            
            $wfh_activity_cek=$wfh->wfh_activity_cek($kar_id,$wfd_date_ori);
            $wfh_activity_jml=mysql_num_rows($wfh_activity_cek);
            if($wfh_activity_jml == 0){
                $wfh_activity_insert=$wfh->wfh_activity_insert($wfa_username,$wfa_nama,$wfa_nomor,$wfa_data,$wfa_lock,$wfd_date_ori,$kar_id);
            }else{
                $wfh_activity_update=$wfh->wfh_activity_update($wfa_data,$wfa_lock,$kar_id,$wfd_date_ori);
            }
        }
    }
    echo"<script>document.location='?p=$page';</script>";
}
elseif(isset($page)&&($act=="unpublish")){
    $wfd_key=$_GET['id'];
    $wfd_lock="N";
    $wfh_data_lock=$wfh->wfh_data_lock($wfd_key,$wfd_lock);
    if($wfh_data_lock){
        $wfh_activity_rekap=$wfh->wfh_activity_rekap($wfd_date_ori,$kar_id);
        $wfh_jml=mysql_num_rows($wfh_activity_rekap);
        if($wfh_jml > 0){
            $datawfh=mysql_fetch_array($wfh_activity_rekap);
            $wfa_username = $datawfh['wfd_username'];
            $wfa_nama = $datawfh['wfd_nama'];
            $wfa_nomor = $datawfh['wfd_nomor'];
            $wfa_data = $datawfh['wfd_count'];
            $wfa_lock = $datawfh['wfd_lock'];
            
            $wfh_activity_cek=$wfh->wfh_activity_cek($kar_id,$wfd_date_ori);
            $wfh_activity_jml=mysql_num_rows($wfh_activity_cek);
            if($wfh_activity_jml == 0){
                $wfh_activity_insert=$wfh->wfh_activity_insert($wfa_username,$wfa_nama,$wfa_nomor,$wfa_data,$wfa_lock,$wfd_date_ori,$kar_id);
            }else{
                $wfh_activity_update=$wfh->wfh_activity_update($wfa_data,$wfa_lock,$kar_id,$wfd_date_ori);
            }
        }
    }
    echo"<script>document.location='?p=$page';</script>";
}

$div_id = "";
$wfh_aktifitas=$wfh->wfh_aktifitas($div_id);

$dataArr=array();
$wfh_id=1; //Aktifitas Lainnya
$wfh_aktifitas_id=$wfh->wfh_aktifitas_id($wfh_id);
$wfh_jml=mysql_num_rows($wfh_aktifitas_id);
if($wfh_jml > 0){
    $data=mysql_fetch_array($wfh_aktifitas_id);
    $exp_aksi = explode(",",$data['wfh_aksi']);
    for($i=0;$i<count($exp_aksi);$i++){
        $dataArr['data']['wfh_aksi'][] = $exp_aksi[$i];
    }
    
    $exp_satuan = explode(",",$data['wfh_satuan']);
    for($i=0;$i<count($exp_satuan);$i++){
        $dataArr['data']['wfh_satuan'][] = $exp_satuan[$i];
    }
    
    $exp_lokasi = explode(",",$data['wfh_lokasi']);
    for($i=0;$i<count($exp_lokasi);$i++){
        $dataArr['data']['wfh_lokasi'][] = $exp_lokasi[$i];
    }
}else{
    $dataArr['data'] = '--Pilih--';
}
?>