<?php
error_reporting(E_ALL ^ E_NOTICE);
date_default_timezone_set('Asia/Jakarta');
session_start(); 

require('class.php');
require('object.php');

$db->koneksi();

function outputProgress($current, $total) {
    echo "<span style='position: absolute;z-index:$current;background:#FFF;'>Proses: " . round($current / $total * 100) . "% </span>";
    myFlush();
    slaap(0.5);
}

function myFlush() {
    echo(str_repeat(' ', 256));
    if (@ob_get_contents()) {
        @ob_end_flush();
    }
    flush();
}

function slaap($seconds){
    $seconds = abs($seconds);
    if ($seconds < 1):
       usleep($seconds*1000000);
    else:
       sleep($seconds);
    endif;   
}

//$date = date('Y-m-d',strtotime("-10 days"));
$date = "2020-03-01";
$time=date('H:i:s');

//$r_awal_ori = "2018-08-10";
//$r_sekarang_ori = "2018-08-10";

$username = "SG.0252.2015";

$r_awal_ori = $date;
$r_sekarang_ori = $date;

$current = 0;
$karyawanArr = array();
$div_value = "8,10"; //id divisi
$kar_tampil_div_in = $kar->kar_tampil_nik($username);
$kar_jml_div_in = mysql_num_rows($kar_tampil_div_in);
while($kar_data_div_in = mysql_fetch_assoc($kar_tampil_div_in)){
  
    $kar_nik = $kar_data_div_in['kar_nik'];
    $start = $r_awal_ori;
    $end = $r_sekarang_ori;
    
    $header = array(
            'Content-Type: application/x-www-form-urlencoded',
            'Connection: keep-alive'
    );

    $fields = array(
            'kar_nik' => urlencode($kar_nik),
            'start' => urlencode($start),
            'end' => urlencode($end)
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
    
    //$BDC_datares = '0';
    
    
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
    
    //$SIPEMA_datares = array('0','1','2','3','4','5');
    
    
    
    ////////////////////////////////////////////////////////////////////////
    
    $tb_rwd = "rwd_data";
    $nik = $kar_data_div_in['kar_nik'];
    $nama = $kar_data_div_in['kar_nm'];
    
    if(($kar_data_div_in['kar_default_shift2_in']!='' || $kar_data_div_in['kar_default_shift2_in']!=NULL) &&
    ($kar_data_div_in['kar_default_shift2_out']!='' || $kar_data_div_in['kar_default_shift2_out']!=NULL) &&
    ($kar_data_div_in['kar_default_shift3_in']=='' || $kar_data_div_in['kar_default_shift3_in']==NULL) &&
    ($kar_data_div_in['kar_default_shift3_out']=='' || $kar_data_div_in['kar_default_shift3_out']==NULL) &&
    ($kar_data_div_in['kar_jdw_akses']=='' || $kar_data_div_in['kar_jdw_akses']==NULL)){
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
    
    
    $rwd_activity_cek = $rwd->rwd_activity_cek($tb_rwd,$nik,$date);
    $rwd_activity_jml = mysql_num_rows($rwd_activity_cek);
    if($rwd_activity_jml == 0){
        $filed = "rwd_id,rwd_nik,rwd_nm,rwd_div,rwd_jumlah,rwd_jumlah1,rwd_datatext1,rwd_jumlah2,rwd_datatext2,rwd_jumlah3,rwd_datatext3,rwd_tanggal";
        //$rwd_activity_insert = $rwd->rwd_activity_insert($tb_rwd,$filed,$nik,$nama,$divisi,$bdc,$pendaftaran,$pendaftaran_mhs,$herregis,$herregis_mhs,$reward,$reward_mhs,$date);
    }else{
        $rwd_activity_insert = $rwd->rwd_activity_update($tb_rwd,$nik,$bdc,$pendaftaran,$pendaftaran_mhs,$herregis,$herregis_mhs,$reward,$reward_mhs,$date);
    }
    
    ////////////////////////////////////////////////////////////////////////
    
  
    $karyawanArr[] = array('nik' => $nik,
                           'nama' => $nama,
                           'bdc' => $bdc,
                           'pendaftaran' => $pendaftaran,
                           'pendaftaran_mhs' => $pendaftaran_mhs,
                           'herregis' => $herregis,
                           'herregis_mhs' => $herregis_mhs,
                           'reward' => $reward,
                           'reward_mhs' => $reward_mhs);
    
    $nik." - ".$nama."<br>";
    
    $current++;
    outputProgress($current, $kar_jml_div_in);

}

echo "<pre>";
print_r($karyawanArr);
echo "</pre>";

?>