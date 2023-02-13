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

$sql = "SELECT a.kar_id,a.kar_nik,a.kar_nm,d.abs_shift,c.rwd_jumlah1, e.abs_shift as shift_kemarin, e.rwd_jumlah1 as rwd_kemarin
FROM kar_master AS a 
INNER JOIN kar_detail AS b
ON a.kar_id = b.kar_id
	AND b.kar_dtl_typ_krj != 'Resign'
INNER JOIN rwd_data_cs AS c
ON a.kar_nik = c.rwd_nik
	AND c.rwd_tanggal= '" . $date . "'
LEFT OUTER JOIN abs_master AS d
ON a.kar_id = d.kar_id
	AND d.abs_tgl_masuk= '" . $date . "'
LEFT JOIN 
(
	SELECT a.kar_id,a.kar_nik,a.kar_nm,d.abs_shift,c.rwd_jumlah1
	FROM kar_master AS a 
	INNER JOIN kar_detail AS b
	ON a.kar_id = b.kar_id
		AND b.kar_dtl_typ_krj != 'Resign'
	INNER JOIN rwd_data_cs AS c
	ON a.kar_nik = c.rwd_nik
		AND c.rwd_tanggal= '" . $kemarin . "'
	LEFT OUTER JOIN abs_master AS d
	ON a.kar_id = d.kar_id
		AND d.abs_tgl_masuk= '" . $kemarin . "' 
	#WHERE a.lvl_id='7' AND a.div_id='13'
	WHERE a.div_id='13'
	GROUP BY a.kar_nm ORDER BY c.rwd_jumlah1 DESC, a.kar_nm ASC
) as e
ON a.kar_id = e.kar_id

#WHERE a.lvl_id='7' AND a.div_id='13'
WHERE a.div_id='13'
GROUP BY a.kar_nm ORDER BY c.rwd_jumlah1 DESC, a.kar_nm ASC";
// echo $sql; exit;
$arr = array();
$res = mysql_query($sql);
while ($row = mysql_fetch_array($res)) {
    $arr[] = array(
        'nama' => $row['kar_nm'],
        // 'shift' => $row['abs_shift'], /* NANTI KALO UDAHAN CORONA BUKA LAGI */
        'shift' => 'WFH',
        'pencapaian' => $row['rwd_jumlah1'],
        // 'shift_kemarin' => $row['shift_kemarin'], /* NANTI KALO UDAHAN CORONA BUKA LAGI */
        'shift_kemarin' => 'WFH',
        'pencapaian_kemarin' => $row['rwd_kemarin']
    );
}

if($_GET['debug']) {
	echo "<pre>".print_r($sql, 1)."</pre>";
	exit;
}
echo json_encode($arr);
