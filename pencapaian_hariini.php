<?php
header("Access-Control-Allow-Origin: *");

error_reporting(E_ALL ^ E_NOTICE);
date_default_timezone_set('Asia/Jakarta');
session_start();

require('class.php');
require('object.php');

$db->koneksi();

$date = date('Y-m-d');
$kemarin = date("Y-m-d", mktime(0, 0, 0, date("m"), date("d") - 1, date("Y")));

$time = date('H:i:s');

$sql = "SELECT
	a.*, SUM(rwd_jumlah1) as jum
FROM
(
	SELECT
		rwd_nik,
		rwd_nm,
		IF( rwd_div LIKE '%_KAR%', 'KAR', rwd_div ) AS rwd_div,
		rwd_jumlah1 
	FROM
		`rwd_data_karyawan` 
	WHERE 1=1
		AND rwd_tanggal = '".$date."' 
		AND rwd_div LIKE '%KAR%' 
) AS a 
GROUP BY
	a.rwd_div
	
UNION ALL 

SELECT
		rwd_nik,
		rwd_nm,
		rwd_div,
		rwd_jumlah1 ,
		SUM(rwd_jumlah1) as jum
	FROM
		`rwd_data_cs` 
	WHERE 1=1
		AND rwd_tanggal = '".$date."' 
	GROUP BY rwd_div

UNION ALL 

SELECT
		rwd_nik,
		rwd_nm,
		rwd_div,
		rwd_jumlah1 ,
		SUM(rwd_jumlah1) as jum
	FROM
		`rwd_data` 
	WHERE 1=1
		AND rwd_tanggal = '".$date."' 
	GROUP BY rwd_div		
	";
// echo $sql;
// exit;
$arr = array();
$res = mysql_query($sql);
while ($row = mysql_fetch_array($res)) {
	if($row['rwd_div']=="8"){
		$label ="Unit";
	}elseif($row['rwd_div']=="13_CS"){
		$label ="CS";
	}else{
		$label ="Alih Fungsi";
	}
   
   $arr[] = array(
        'tim' => $label,
        'pencapaian' => $row['jum']
    );
}

echo json_encode($arr);
?>