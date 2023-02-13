<?php
session_start(); 
$page=$_GET['p'];
$act=$_GET['act'];
$divid = isset($_GET['divisi']) && $_GET['divisi'] <> "0" ? $_GET['divisi'] : "";
$datenow = isset($_GET['tgl']) && strlen($_GET['tgl']) > 0 ? $_GET['tgl'] : date('Y-m-d');



if(isset($_GET['act']) && $_GET['act'] == 'detail') {
	require('../../class.php');
	require('../../object.php');
	$db->koneksi();
	
	$jam = isset($_GET['jam']) ? $_GET['jam'] : 'oke';
	$kar = isset($_GET['kar']) ? $_GET['kar'] : 'ini 123';
	$tgl = isset($_GET['tgl']) && strlen($_GET['tgl']) > 0 ? $_GET['tgl'] : date('Y-m-d');
	
	$list_activity = $karacv->karact_tampil_detail($jam, $kar, $tgl);
	
	header('Content-Type: application/json; charset=utf-8');
	echo json_encode($list_activity);
	exit;
}







$list_activity = $karacv->karact_tampil_day($datenow, $divid);

$domTh = '';
$domBody = '';
foreach($list_activity as $k => $v) {
	if(strlen($domTh) <= 0) {
		$domTh .= '<tr>';
		$domTh .= '	<th>NIK</th>';
		$domTh .= '	<th>Nama</th>';
		$domTh .= '	<th>Jam Kerja</th>';
		$domTh .= '	<th>Luar Jam Kerja</th>';
		$domTh .= '<th align="center">'. @implode('</th><th align="center">', array_keys($v['jam'])) .'</th>';
		$domTh .= '</tr>';
	}
	
	$domBody .= '
		<tr>
			<td>'.$v['nik'].'</td>
			<td>'.$v['nama'].'</td>
			<td align="center">'.$v['total_officehour'].'</td>
			<td align="center">'.$v['total_nonofficehour'].'</td>
			<td align="center">'. @implode('</td><td align="center">', array_values($v['jam'])) .'</td>
		</tr>
	';
}

$tbl = '
	<div class="tableFixHead">
		<table id="tb_aktivitas_karyawan_report" class="table table-hover table-striped table-bordered nowrap" width="100%" style="white-space: nowrap;">
			<thead>'. $domTh .'</thead>
			<tbody>'. $domBody .'</tbody>
		</table>
	</div>
';
?>