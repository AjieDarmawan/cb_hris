<?php
error_reporting(E_ALL ^ E_NOTICE);
date_default_timezone_set('Asia/Jakarta');
session_start();

require('../class.php');

$db=new Database();
$db->koneksi();

$ktr=new Kantor();
$dataARR=array();
$ktr_id=$_POST['ktr_id'];
$ktr_tampil_id=$ktr->ktr_tampil_id($ktr_id);
$ktr_jml=mysql_num_rows($ktr_tampil_id);
if($ktr_jml > 0){
	$data=mysql_fetch_array($ktr_tampil_id);
	
	$lokasi_wfh = array(171,172,173);
	if (in_array($ktr_id, $lokasi_wfh)){
		$dataARR = array(
		    "status_absen" => "WFH",
			"kar_long" => 0,
			"kar_lat"  => 0,
			"kar_radius"  => 0
		);
	} else {
		$dataARR = array(
		    "status_absen" => "WFO",
			"kar_long" => $data['kar_long'],
			"kar_lat"  => $data['kar_lat'],
			"kar_radius"  => $data['kar_radius']
		);
	}
}else{
	$dataARR = array(
		"status_absen" => "X",
		"kar_long" => 0,
		"kar_lat"  => 0,
		"kar_radius"  => 0
	);		
}
echo json_encode($dataARR);
?>