<?php

header("Access-Control-Allow-Origin: *");
header('Access-Control-Allow-Headers: token, Content-Type, cid, x-mail');

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
		  a.div_id ='8' AND a.lvl_id='4'  AND b.kar_dtl_typ_krj <> 'Resign' ORDER BY a.kar_nm
		
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
