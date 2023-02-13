<?php

header("Access-Control-Allow-Origin: *");

error_reporting(E_ALL ^ E_NOTICE);
date_default_timezone_set('Asia/Jakarta');

require('class.php');
require('object.php');

$db->koneksi();

$date = date('Y-m-d');
$kemarin = date("Y-m-d", mktime(0, 0, 0, date("m"), date("d") - 1, date("Y")));

$time = date('H:i:s');

/*$sql = "
	SELECT
		a.kar_nm,
		c.acc_username
	FROM
		kar_master a
		LEFT JOIN kar_detail b ON a.kar_id = b.kar_id 
		LEFT JOIN acc_master c ON a.kar_id = c.kar_id 
	WHERE
		a.div_id = '6' AND b.kar_dtl_typ_krj <> 'Resign'
		
";*/

//UPDATE PIC KHUSUS HEREGIS
//UPDATE NIK KHUSUS PIC HEREGIS
$sql = "
	SELECT
		a.kar_nm,
		c.acc_username
	FROM
		kar_master a
		LEFT JOIN kar_detail b ON a.kar_id = b.kar_id 
		LEFT JOIN acc_master c ON a.kar_id = c.kar_id 
	WHERE
		a.kar_nik IN('SG.0064.2011','SG.0015.2004','SG.0021.2004','SG.0028.2007','SG.0050.2009','SG.0060.2010','SG.0069.2011','SG.0088.2012','SG.0118.2013','SG.0174.2014','SG.0269.2015','SG.0273.2015','SG.0289.2016','SG.0390.2017','SG.0437.2017','SG.0470.2018','SG.0518.2019','SG.0584.2020','SG.0186.2014') AND b.kar_dtl_typ_krj <> 'Resign'
		
";
//echo $sql; exit;
$response = array();
$res = mysql_query($sql);
while ($row = mysql_fetch_array($res)) {
	$response['data'][$row['acc_username']]['kar_nm'] = $row['kar_nm'];
	$response['data'][$row['acc_username']]['acc_username'] = $row['acc_username'];
	//echo "<pre>".print_r($response, 1)."</pre>";
}

if($_GET['debug']) {
	echo "<pre>".print_r($sql, 1)."</pre>";
	exit;
}
echo json_encode($response);
