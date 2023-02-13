<?php
error_reporting(E_ALL ^ E_NOTICE);
date_default_timezone_set('Asia/Jakarta');
session_start(); 

require('class.php');
require('object.php');

$db->koneksi();

$datetime=date('Y-m-d H:i:s');

$tgl1 = str_replace("/","-",$_POST['tgl1']);
$tgl2 = str_replace("/","-",$_POST['tgl2']);
$date1 = date('Y-m-d', strtotime($tgl1));
$date2 = date('Y-m-d', strtotime($tgl2));

//$r_awal_ori = date('Y-m-01');
//$r_sekarang_ori = date('Y-m-d');

$r_awal_ori = $date1;
$r_sekarang_ori = $date2;

//$username = "SG.0151.2013";
$username = $_POST['nik'];

$kar_tampil_div_in = $kar->kar_tampil_nik($username);
$kar_data_div_in = mysql_fetch_assoc($kar_tampil_div_in);

$daterange = $tgl->date_range($r_awal_ori,$r_sekarang_ori,"+1 day","Y-m-d");
foreach($daterange as $datenya){
    
    $header = array(
            'Content-Type: application/x-www-form-urlencoded',
            'Connection: keep-alive'
    );

    $fields = array(
            'kar_nik' => urlencode($username),
            'start' => urlencode($datenya),
            'end' => urlencode($datenya)
    );
  
    $fields_string = '';
    foreach($fields as $key1=>$value1) { $fields_string .= $key1.'='.$value1.'&'; }
    rtrim($fields_string, '&');
    
    ////////////////////////////////////////////////////////////////////////////
    
    $BDC_url = "http://daftarkuliah.my.id/bdc/bdc_data.php";
    
    $BDC_curl = curl_init();
    
    curl_setopt_array($BDC_curl, array(
            CURLOPT_URL => $BDC_url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            //CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => $fields_string,
            CURLOPT_HTTPHEADER => $header,
    ));
    
    
    $BDC_response = curl_exec($BDC_curl);
    $BDC_err = curl_error($BDC_curl);
    
    curl_close($BDC_curl);
    
    $BDC_datares = json_decode($BDC_response, true);
    
    ////////////////////////////////////////////////////////////////////////////
    
    $SIPEMA_url = "http://103.86.160.10/sipema/sipema_data.php";
    
    $SIPEMA_curl = curl_init();
    
    curl_setopt_array($SIPEMA_curl, array(
            CURLOPT_URL => $SIPEMA_url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            //CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => $fields_string,
            CURLOPT_HTTPHEADER => $header,
    ));
    
    
    $SIPEMA_response = curl_exec($SIPEMA_curl);
    $SIPEMA_err = curl_error($SIPEMA_curl);
    
    curl_close($SIPEMA_curl);
    
    $SIPEMA_datares = json_decode($SIPEMA_response, true);
    
    $tb_rwd = "rwd_data_cs";
    $nik = $kar_data_div_in['kar_nik'];
    $nama = $kar_data_div_in['kar_nm'];
    
    if($kar_data_div_in['div_id']==13){
        $identifyCS = "_CS";
    }else{
        $identifyCS = "";
    }
    
    $divisi = $kar_data_div_in['div_id'].$identifyCS;
    $bdc = $BDC_datares;
    $pendaftaran = $SIPEMA_datares[0];
    $pendaftaran_mhs = mysql_real_escape_string(htmlspecialchars($SIPEMA_datares[1]));
    $herregis = $SIPEMA_datares[2];
    $herregis_mhs = mysql_real_escape_string(htmlspecialchars($SIPEMA_datares[3]));
    $reward = $SIPEMA_datares[4];
    $reward_mhs = mysql_real_escape_string(htmlspecialchars($SIPEMA_datares[5]));
    
    
    $rwd_activity_cek = $rwd->rwd_activity_cek($tb_rwd,$nik,$datenya);
    $rwd_activity_jml = mysql_num_rows($rwd_activity_cek);
    if($rwd_activity_jml == 0){
        $filed = "rwd_id,rwd_nik,rwd_nm,rwd_div,rwd_jumlah,rwd_jumlah1,rwd_datatext1,rwd_jumlah2,rwd_datatext2,rwd_jumlah3,rwd_datatext3,rwd_tanggal";
        $rwd_activity_insert = $rwd->rwd_activity_insert($tb_rwd,$filed,$nik,$nama,$divisi,$bdc,$pendaftaran,$pendaftaran_mhs,$herregis,$herregis_mhs,$reward,$reward_mhs,$datenya);
    }else{
        $rwd_activity_insert = $rwd->rwd_activity_update($tb_rwd,$nik,$bdc,$pendaftaran,$pendaftaran_mhs,$herregis,$herregis_mhs,$reward,$reward_mhs,$datenya);
        
    }
}

$kar_sync_update = $kar->kar_sync_update($username,$datetime);
?>