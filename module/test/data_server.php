<?php
session_start();

foreach ($_REQUEST as $name => $value) {
	$$name = $value;
	//echo "$name : $value;<br />\n";
}

//informasi koneksi ke database////////////////////////
include("koneksi_db.php");
///////////////////////////////////////////////////////////////////////
if ($aksi == "delete") {
	$q_del   = " DELETE FROM rwd_data_ms_b WHERE  rwd_id = '$id' ";
	$ret_del =  mysql_query($q_del);
}
if ($act == "edit") {
	$rwd_update = str_replace("_StatusUpdate_", "$rwd_status", "$updateready");
	$q_upd   = " UPDATE rwd_data_ms_b SET rwd_datatext3='$rwd_update' WHERE rwd_id = '$id' ";
	$ret_upd =  mysql_query($q_upd);
}
///////////////////////////////////////////////////////////////////////

if (!empty($_SESSION['fday'])) {

	$exp_daterange = explode(' - ', $_SESSION['fday']);
	$exp_datestart = explode('/', $exp_daterange[0]);
	$exp_dateend = explode('/', $exp_daterange[1]);
	$day_start = $exp_datestart[2] . "-" . $exp_datestart[1] . "-" . $exp_datestart[0];
	$day_end = $exp_dateend[2] . "-" . $exp_dateend[1] . "-" . $exp_dateend[0];

	$r_awal = date("d/m/Y", strtotime($day_start));
	$r_sekarang = date("d/m/Y", strtotime($day_end));

	$r_awal_ori = date("Y-m-d", strtotime($day_start));
	$r_sekarang_ori = date("Y-m-d", strtotime($day_end));

	$f_daterange = $r_awal . " - " . $r_sekarang;
} else {

	$r_awal = date("01/m/Y", strtotime($date));
	$r_sekarang = date("d/m/Y", strtotime($date));

	$r_awal_ori = date("Y-m-01", strtotime($date));
	$r_sekarang_ori = date("Y-m-d", strtotime($date));

	$f_daterange = $r_awal . " - " . $r_sekarang;
}

$date1 = date_create($r_awal_ori);
$date2 = date_create($r_sekarang_ori);
$diff = date_diff($date1, $date2);
$days = $diff->format("%a");

$filter_tool = "";
$query   = '';
$output  = array();

$query .= "SELECT rwd_id, rwd_nik, rwd_nm, rwd_tanggal, rwd_datatext3, SUBSTRING_INDEX(SUBSTRING_INDEX(a.rwd_datatext3, ',', n.n), ',', -1) as rwd_mhs, n.n-1 as rwd_mhsindex
			FROM rwd_data_ms_b a CROSS JOIN 
			(
			SELECT a.N + b.N * 10 + 1 n
				FROM 
				(SELECT 0 AS N UNION ALL SELECT 1 UNION ALL SELECT 2 UNION ALL SELECT 3 UNION ALL SELECT 4 UNION ALL SELECT 5 UNION ALL SELECT 6 UNION ALL SELECT 7 UNION ALL SELECT 8 UNION ALL SELECT 9) a
			,(SELECT 0 AS N UNION ALL SELECT 1 UNION ALL SELECT 2 UNION ALL SELECT 3 UNION ALL SELECT 4 UNION ALL SELECT 5 UNION ALL SELECT 6 UNION ALL SELECT 7 UNION ALL SELECT 8 UNION ALL SELECT 9) b
				ORDER BY n
			) n
			WHERE n.n <= 1 + (LENGTH(a.rwd_datatext3) - LENGTH(REPLACE(a.rwd_datatext3, ',', '')))
			AND rwd_jumlah3>0";

$terbayar = '';
if (!empty($_SESSION['terbayar'])) {

	$query .= ' AND ( ';
	$query .= ' SUBSTRING_INDEX(SUBSTRING_INDEX(a.rwd_datatext3, \',\', n.n), \',\', -1) LIKE "%#B#%"';
	$query .= ') ';

	if ((!empty($_SESSION['fday']))) {
		$query .= ' AND ( ';
		$query .= ' a.rwd_tanggal BETWEEN "' . $r_awal_ori . '" and "' . $r_sekarang_ori . '"';
		$query .= ') ';
	}
	$terbayar = 'B';
} else {
	$query .= ' AND ';
	$query .= ' SUBSTRING_INDEX(SUBSTRING_INDEX(a.rwd_datatext3, \',\', n.n), \',\', -1) NOT LIKE "%#B#%"';
	$query .= ' ';
}

if (isset($_POST["search"]["value"])) {
	$query .= ' AND ( ';
	$query .= ' a.rwd_nik LIKE "%' . $_POST["search"]["value"] . '%" ';
	$query .= ' OR a.rwd_nm LIKE "%' . $_POST["search"]["value"] . '%" ';
	$query .= ' OR SUBSTRING_INDEX(SUBSTRING_INDEX(a.rwd_datatext3, \',\', n.n), \',\', -1) LIKE "%' . $_POST["search"]["value"] . '%" ';
	$query .= ' ) ';
}
if (isset($_POST["order"])) {
	$column_order = array(null, null, null, null, null, null, null, null, 'a.rwd_nik', 'a.rwd_nm', 'a.rwd_tanggal', null);
	$query .= 'ORDER BY ' . $column_order[$_POST['order']['0']['column']] . ' ' . $_POST['order']['0']['dir'] . ' ';
} else {
	$query .= ' ORDER BY a.rwd_nik ';
}
$query_total = $query;

if ($_POST["length"] != -1) {
	if ($_POST['start'] == "") {
		$_POST['start'] = 0;
		$_POST['length'] = 10;
	}
	$query .= 'LIMIT ' . $_POST['start'] . ', ' . $_POST['length'];
}

// echo $query;
// return;
// print_r($query);

$num_total = mysql_num_rows(mysql_query($query_total));

$q_data   = mysql_query($query);
$data1 = array();
$urut = 0;

while ($aRow = mysql_fetch_array($q_data)) {

	$id   = $aRow['rwd_id'];
	$nama = $aRow['rwd_nm'];
	$rwd_mhsindex = $aRow['rwd_mhsindex'];


	$arrrwd = explode(",", $aRow['rwd_mhs']);
	reset($arrrwd);
	while (list($keydata, $valdata) = each($arrrwd)) {
		$sub_array = array();

		$subarrrwd = explode("#", $valdata);

		// if ($subarrrwd[3] == $terbayar) {

		$urut++;
		$sub_array[] = $urut;
		$sub_array[] = $subarrrwd[6];

		reset($subarrrwd);
		while (list($key, $val) = each($subarrrwd)) {
			if (in_array($key, array(4, 10, 11, 21, 22))) {
				$sub_array[] = $val;
			}
		}

		$status = '<center>-</center>';
		if ($subarrrwd[3] == 'B') {
			$status = '<center><span class="label bg-green p-1 text-center" style="width:100%">BAYAR</span></center>';
		}
		$sub_array[] = $status;

		$sub_array[] = $aRow['rwd_nik'];
		$sub_array[] = $aRow['rwd_nm'];
		$sub_array[] = $aRow['rwd_tanggal'];
		$edit = " <button  onclick=\"doMyEDIT('$id','$nama','$rwd_mhsindex')\" class=\"btn btn-sm btn-primary p-1\">
						<i class=\"fa fa-edit\" title=\"Edit Status\"></i> Edit</button> 
						";

		$sub_array[] = '<div>' . $edit . '</div>';
		array_push($data1, $sub_array);
		// }
		//else {

		// 	$num_total = $num_total - 1;
		// }
	}
}
// '<button  onclick=\"doMyDELETE('$id','$nama','$keydata')\" class=\"btn-xs btn-danger \"><i class=\"fa fa-trash\" title=\"del-data\"></i>&nbsp;</button>';
$output = array(
	"draw"		=>	intval($_POST["draw"]),
	"recordsTotal"	=> 	$num_total,
	"recordsFiltered"	=>	$num_total,
	"data"		=>	$data1
);
echo json_encode($output);
   ////////////////////////////////////////////////////////////////////////////////
