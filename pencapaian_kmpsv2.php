<?php
error_reporting(E_ALL ^ E_NOTICE);
date_default_timezone_set('Asia/Jakarta');
session_start();

require('class.php');
require('object.php');

$db->koneksi();

$date = date('Y-m-d');
$year = date('Y');


$page = "pencapaian_kmpsv2.php";

$dataArr = array();
$dataArr2 = array();
$groupArr = array();

$sql = "SELECT rwd_datatext1 FROM `rwd_data` WHERE rwd_datatext1 <> '' AND rwd_tanggal BETWEEN '2022-04-04' AND '2022-06-24' 
UNION ALL
SELECT rwd_datatext1 FROM `rwd_data_cs` WHERE rwd_datatext1 <> '' AND rwd_tanggal BETWEEN '2022-04-04' AND '2022-06-24'
UNION ALL
SELECT rwd_datatext1 FROM `rwd_data_karyawan` WHERE rwd_datatext1 <> '' AND rwd_tanggal BETWEEN '2022-04-04' AND '2022-06-24'";

$query = mysql_query($sql);

$hasComma = false;
$dataText = "";
while ($result = mysql_fetch_assoc($query)) {
   
	if ($hasComma){ 

	    $dataText .= ",";
    
	}
	$dataText .= $result['rwd_datatext1'];	
	$hasComma=true;
}
//echo $dataText;

$dataArr = array();

$exp1 = explode(",",$dataText);

foreach($exp1 as $k => $v){
	
	$exp2 = explode('#', $v);
	$expnosel = $exp2[0].'-'.$exp2[4].'-'.$exp2[6];
	
	$dataArr[] = array('kpt' => $exp2[1],
					   'nosel' => $expnosel,
					   'tanggal' => $exp2[23],
					   'nik' => $exp2[24]);
	
	
	
}
$dataArr2 = array();

foreach($dataArr as $k => $v){
		$v_kpt = $v['kpt'];
		$v_tanggal = $v['tanggal'];
		$v_nik = $v['nik'];
		$v_nosel = $v['nosel'];
	
		$dataArr2[$v_tanggal][$v_kpt][$v_nik][] = $v_nosel; 
}

$dataArr3 = array();

foreach($dataArr2 as $k => $v){
	
	foreach($v as $k2=> $v2){
				
		foreach($v2 as $k3=> $v3){
						
			$dataArr3[$k][$k2][$k3] = count($v3);
			
		}				
	
	}

}

// echo '<pre>';
// print_r($dataArr3);
// echo '</pre>';
echo json_encode($dataArr3);
?>

