<?php
//setiap tgl 26 jam 00:15 wib

error_reporting(E_ALL ^ E_NOTICE);
date_default_timezone_set('Asia/Jakarta');
session_start(); 

require('class.php');
require('object.php');
$nrw=new NewReward();
$db->koneksi();

$tgl_awal = date('Y-m-d', strtotime('-1 month', strtotime(date('Y-m-26'))));
//$tgl_awal = date('Y-m-14'); //SEMENTARA//$tgl_akhir = date('Y-m-24'); //SEMENTARA
$tgl_akhir = date('Y-m-25');


function array_sort_by_column(&$arr, $col, $dir = SORT_ASC) {
    $sort_col = array();
    foreach ($arr as $key=> $row) {
        $sort_col[$key] = $row[$col];
    }

    array_multisort($sort_col, $dir, $arr);
}

$karyawanArr = array();

$kar_tampil = $kar->kar_tampil_cs_staff();
while($data = mysql_fetch_assoc($kar_tampil)){
    
    $nik = $data['kar_nik'];
    $nama = $data['kar_nm'];
    
    ////////////////////////////////////////////////////////////////////////////////////////////////
    
    $header = array(
            'Content-Type: application/x-www-form-urlencoded',
            'Connection: keep-alive'
    );

    $fields = array(
            'kar_nik' => urlencode($nik),
            'start' => urlencode($tgl_awal),
            'end' => urlencode($tgl_akhir)
    );
  
    $fields_string = '';
    foreach($fields as $key1=>$value1) { $fields_string .= $key1.'='.$value1.'&'; }
    rtrim($fields_string, '&');
    
    ////////////////////////////////////////////////////////////////////////////
    
    $SIPEMA_url = "http://103.86.160.10/sipema/grade_new_pencapaian_cs_kotor.php";
    
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
    ////////////////////////////////////////////////////////////////////////////////////////////////
    
    $jml_pmb_kotor = $SIPEMA_datares[0];
    
    ////////////////////////////////////////////////////////////////////////////////////////////////
    
    $karyawanArr[$nik] = array('nik' => $nik,
                            'nama' => $nama,
                            'jml_pmb_kotor' => $jml_pmb_kotor,
                            'tg2' => $tgl_akhir);
    
}

array_sort_by_column($karyawanArr, 'nama');

/*echo "<pre>";
print_r($karyawanArr);
echo "</pre>";
exit();*/

foreach($karyawanArr as $data){
    $nrw_priode = date('mY', strtotime($data['tg2']));
    $nrw_nik = $data['nik'];
    $nrw_nama = $data['nama'];
    $nrw_jml_pmb_kotor = $data['jml_pmb_kotor'];
    
    $nrw_cek_cs = $nrw->nrw_cek_cs($nrw_priode,$nrw_nik);
    $nrw_cek_jml = mysql_num_rows($nrw_cek_cs);
    if($nrw_cek_jml == 1){
        $nrw_update_cs = $nrw->nrw_update_cs($nrw_priode,$nrw_nik,$nrw_jml_pmb_kotor);
    }
}
?>