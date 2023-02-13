<?php
error_reporting(E_ALL ^ E_NOTICE);
date_default_timezone_set('Asia/Jakarta');
session_start(); 

require('class.php');
require('object.php');

$db->koneksi();

//$datenya = date('Y-m-d');
$datenya = "2022-07-06";
// $datenya = '2021-08-01'; // Manual buat ngambil tanggal tertentu dan di apid_costum bulany di sesuaikan

if(strtotime(date($datenya.' H:i:s')) < strtotime($datenya . ' 05:00:00')){
	$datenya =  date('Y-m-d',strtotime($tanggal . " -1 days"));
}
// echo $datenya;exit;

$arr_kar_keu=array();
$kar_tampil_div_in = $kar->kar_tampil_nik_keuangan();
while($kar_data_div_in = mysql_fetch_assoc($kar_tampil_div_in)){
	$arr_kar_keu[$kar_data_div_in['acc_username']]= $kar_data_div_in;

}
    $header = array(
            'Content-Type: application/x-www-form-urlencoded',
            'Connection: keep-alive'
    );

    // $fields = array(
            // 'kar_nik' => urlencode($username),
            // 'start' => urlencode($datenya),
            // 'end' => urlencode($datenya)
    // );
  
    // $fields_string = '';
    // foreach($fields as $key1=>$value1) { $fields_string .= $key1.'='.$value1.'&'; }
    // rtrim($fields_string, '&');
    
    ////////////////////////////////////////////////////////////////////////////
    
    $PENAGIHAN_url = "http://103.86.160.10/sipema/sumperolehan/hereg_harian_rm_costum.php?detail=1&grouping=1&detailmhs=1&rawdata=1&tgl=".$datenya;
    
    $PENAGIHAN_curl = curl_init();
    
    curl_setopt_array($PENAGIHAN_curl, array(
            CURLOPT_URL => $PENAGIHAN_url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            //CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => $fields_string,
            CURLOPT_HTTPHEADER => $header,
    ));
    
    
    $PENAGIHAN_response = curl_exec($PENAGIHAN_curl);
    $SIPEMA_err = curl_error($PENAGIHAN_curl);
    
    curl_close($PENAGIHAN_curl);
    
    $PENAGIHAN_datares = @json_decode($PENAGIHAN_response, true);
	
	$arr_data_closing = array();
	if(is_array($PENAGIHAN_datares) && count($PENAGIHAN_datares) > 0) {
		foreach($PENAGIHAN_datares as $k => $v) {
			
			/* OLAH DATA TXT */
			// $kemarin = @implode("##",$v['detail']['kemarin']);
			$hariini = @implode("##",$v['detail']['hariini']);
			// $data_txt_1 = $kemarin .'###'. $hariini;
			
			$tmp_data_closing = array();
			$tmp_data_closing['txt'] = $hariini;
			$tmp_data_closing['jum'] = $v['total_hariini'];
			$arr_data_closing = $tmp_data_closing;
			
			/* DATA USER */
			@reset($arr_kar_keu);
			if(isset($arr_kar_keu[$v['username']])){
				$tmp_data_closing['rwd_nik'] = $arr_kar_keu[$v['username']]['kar_nik'];
				$tmp_data_closing['rwd_nm']  = $arr_kar_keu[$v['username']]['kar_nm'];
			}else{
				$tmp_data_closing['rwd_nik'] = $v['username'];
				$tmp_data_closing['rwd_nm']  = $v['nama'];
			}
			
			$tb_rwd = "rwd_data_penagihan";
			$nik = $tmp_data_closing['rwd_nik'];
			$nama = $tmp_data_closing['rwd_nm'];
			$divisi = "6_KEU";
			$herregis = $tmp_data_closing['jum'];
			$herregis_mhs = $tmp_data_closing['txt'];
			
			$rwd_activity_cek = $rwd->rwd_activity_cek($tb_rwd,$nik,$datenya);
			$rwd_activity_jml = mysql_num_rows($rwd_activity_cek);
			if($rwd_activity_jml == 0){
				$filed = "rwd_id,rwd_nik,rwd_nm,rwd_div,rwd_jumlah1,rwd_datatext1,rwd_tanggal";
				$rwd_activity_insert_penagihan = $rwd->rwd_activity_insert_penagihan($tb_rwd,$filed,$nik,$nama,$divisi,$herregis,$herregis_mhs,$datenya);
			}else{
				$rwd_activity_update_penagihan = $rwd->rwd_activity_update_penagihan($tb_rwd,$nik,$herregis,$herregis_mhs,$datenya);
				
			}
			
			// echo "<pre>";
			// print_r($tmp_data_closing);
			// echo "<pre>";			
		}
	} 
?>