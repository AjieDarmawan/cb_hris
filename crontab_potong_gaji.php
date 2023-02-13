<?php
//setiap tgl 26 jam 00:15 wib

error_reporting(E_ALL ^ E_NOTICE);
date_default_timezone_set('Asia/Jakarta');
session_start(); 

require('class.php');
require('object.php');

$db->koneksi();
$ptg=new PotongGaji();

$tgl_awal = date('Y-m-d', strtotime('-1 month', strtotime(date('Y-m-26'))));
$tgl_akhir = date('Y-m-25');

function array_sort_by_column(&$arr, $col, $dir = SORT_ASC) {
    $sort_col = array();
    foreach ($arr as $key=> $row) {
        $sort_col[$key] = $row[$col];
    }

    array_multisort($sort_col, $dir, $arr);
}


$karyawanArr = array();

$sql = "SELECT a.kar_nik,a.kar_nm,
GROUP_CONCAT(b.grd_kpt ORDER BY a.kar_nik) kpt,
GROUP_CONCAT(b.grd_pts ORDER BY a.kar_nik) pts,
GROUP_CONCAT(b.grd_grade ORDER BY a.kar_nik) grade,
GROUP_CONCAT(b.grd_target ORDER BY a.kar_nik) target
FROM `kar_master` a, `grade_pencapaian` b
WHERE b.grd_karyawan LIKE CONCAT('%', REPLACE(a.kar_nik,'.',''), '%')
#AND a.kar_nik IN ('SG.0234.2015','SG.0310.2016')
AND a.div_id = '8' GROUP BY a.kar_nik;";

$query=mysql_query($sql) or die (mysql_error());
while($data = mysql_fetch_assoc($query)){
    $data_pencapaian = 0;
    $prosentase = 0;
    
    $nik = $data['kar_nik'];
    $nama = $data['kar_nm'];
    $kpt = $data['kpt'];
    $pts = $data['pts'];
    $exp_grade = explode(",",$data['grade']);
    $exp_target = explode(",",$data['target']);
    
    $arr_grade = array();
    for($x=0;$x<count($exp_target);$x++){
        $arr_grade[$exp_target[$x]] = array('grade' => $exp_grade[$x], 'target' => $exp_target[$x]);
    }
    
    ksort($arr_grade);
    $grade = end($arr_grade);
    
    ////////////////////////////////////////////////////////////////////////////////////////////////
    
    $header = array(
            'Content-Type: application/x-www-form-urlencoded',
            'Connection: keep-alive'
    );

    $fields = array(
            'kar_nik' => urlencode($nik),
            'start' => urlencode($tgl_awal),
            'end' => urlencode($tgl_akhir),
            'kodept' => urlencode($kpt)
    );
  
    $fields_string = '';
    foreach($fields as $key1=>$value1) { $fields_string .= $key1.'='.$value1.'&'; }
    rtrim($fields_string, '&');
    
    ////////////////////////////////////////////////////////////////////////////
    
    $SIPEMA_url = "http://103.86.160.10/sipema/grade_pencapaian.php";
    
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
    
    $data_pencapaian = $SIPEMA_datares[0];
    
    ////////////////////////////////////////////////////////////////////////////////////////////////
    $potongan = (( $grade['target'] - $data_pencapaian ) / $grade['target'] ) * 0.3;
    $prosentase = round($potongan * 100);
    
    if($data_pencapaian > $grade['target']){
        $nilai_insentif = 50000;
        $pmb_insentif = $data_pencapaian - $grade['target'];
        $insentif = $pmb_insentif * $nilai_insentif;
        
        $prosentase = 0;
    }else{
        $insentif = 0;
    }
    ////////////////////////////////////////////////////////////////////////////////////////////////
    
    
    $karyawanArr[$nik] = array('nik' => $nik,
                           'nama' => $nama,
                           'kpt' => $kpt,
                           'pts' => $pts,
                           'grade' => $grade['grade'],
                           'target' => $grade['target'],
                           'data' => $data_pencapaian,
                           'tg1' => $tgl_awal,
                           'tg2' => $tgl_akhir,
                           'prosen' => $prosentase,
                           'insentif' => $insentif);
}

array_sort_by_column($karyawanArr, 'nama');

foreach($karyawanArr as $data){
    
    $ptg_priode = date('mY', strtotime($data['tg2']));
    $ptg_cutoff = $data['tg1'] .' - '. $data['tg2'];
    $ptg_nik = $data['nik'];
    $ptg_nama = $data['nama'];
    $ptg_kampus = $data['pts'];
    $ptg_grade = $data['grade'];
    $ptg_target = $data['target'];
    $ptg_pencapaian = $data['data'];
    $ptg_potongan = $data['prosen'];
    $ptg_insentif = $data['insentif'];
    
    $ptg_cek = $ptg->ptg_cek($ptg_priode,$ptg_nik);
    $ptg_cek_jml = mysql_num_rows($ptg_cek);
    if($ptg_cek_jml == 0){
        $ptg_insert = $ptg->ptg_insert($ptg_priode,$ptg_cutoff,$ptg_nik,$ptg_nama,$ptg_kampus,$ptg_grade,$ptg_target,$ptg_pencapaian,$ptg_potongan,$ptg_insentif);
    }
}
?>