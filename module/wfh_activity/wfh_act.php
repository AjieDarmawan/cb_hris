<?php
session_start(); 
$page=$_GET['p'];
$act=$_GET['act'];

$_div_id = $kar_data['div_id'];

if(isset($_POST['bday'])){

    if(!empty($_POST['filter_day'])){
        $_SESSION['frange'] = $_POST['filter_day'];
        $filter_day = $_SESSION['frange'];
    }else{
        $_SESSION['frange'] = "";
    }

    echo"<script>document.location='?p=$page';</script>";
}

if(isset($_POST['bclearday'])){
    $_SESSION['frange'] = "";
    echo"<script>document.location='?p=$page';</script>";
}

if(!empty($_SESSION['frange'])){
	
	$exp_daterange = explode(' - ', $_SESSION['frange']);
	$exp_datestart = explode('/', $exp_daterange[0]);
        $exp_dateend = explode('/', $exp_daterange[1]);
	$day_start = $exp_datestart[2]."-".$exp_datestart[1]."-".$exp_datestart[0];
	$day_end = $exp_dateend[2]."-".$exp_dateend[1]."-".$exp_dateend[0];
		
	$r_awal = date("d/m/Y", strtotime($day_start));
	$r_sekarang = date("d/m/Y", strtotime($day_end));
	
	$r_awal_ori = date("Y-m-d", strtotime($day_start));
	$r_sekarang_ori = date("Y-m-d", strtotime($day_end));
	
	$f_daterange = $r_awal." - ".$r_sekarang;
}else{

      $r_awal = date("01/m/Y", strtotime($date));
      $r_sekarang = date("d/m/Y", strtotime($date));
      
      $r_awal_ori = date("Y-m-01", strtotime($date));
      $r_sekarang_ori = date("Y-m-d", strtotime($date));
      
      $f_daterange = $r_awal." - ".$r_sekarang;

}

if(isset($_POST['filter_divisi'])){

    if(!empty($_POST['filter_divisi'])){
        $_SESSION['fdivisi'] = $_POST['filter_divisi'];
        $filter_divisi = $_SESSION['fdivisi'];
    }else{
        $filter_divisi = $_div_id;
    }

    echo"<script>document.location='?p=$page';</script>";
}

if(!empty($_SESSION['fdivisi'])){
    $filter_divisi = $_SESSION['fdivisi'];
}else{
    $filter_divisi = $_div_id;
}

$arr_STATUS=array('Y'=>'P','N'=>'C');
$arr_Karyawan = array();
$arr_NIK = array();
$wfh_karyawan_divisi=$wfh->wfh_karyawan_divisi($filter_divisi);
while($data=mysql_fetch_array($wfh_karyawan_divisi)){
    $arr_Karyawan[] = array('kar_nik' => $data['kar_nik'],'kar_nm' => $data['kar_nm']);
    $arr_NIK[] = $data['kar_nik'];
}

$wfh_username = implode("','", $arr_NIK);

$arr_Activity = array();
$arr_WFHKey = array();
$wfh_activity_monthly=$wfh->wfh_activity_monthly($wfh_username,$r_awal_ori,$r_sekarang_ori);
while($act_data_arr = mysql_fetch_assoc($wfh_activity_monthly)){
    $wfh_status = $arr_STATUS[$act_data_arr['wfa_lock']] ? $arr_STATUS[$act_data_arr['wfa_lock']] : 'N';
    $arr_Activity[$act_data_arr['wfa_username']][$act_data_arr['wfa_tanggal']] = $wfh_status;
    $arr_WFHKey[$act_data_arr['wfa_username']][$act_data_arr['wfa_tanggal']] = md5($act_data_arr['wfa_nomor']);
}
?>