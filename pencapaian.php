<?php
error_reporting(E_ALL ^ E_NOTICE);
date_default_timezone_set('Asia/Jakarta');
session_start();

require('class.php');
require('object.php');

$db->koneksi();

$date = date('Y-m-d');
$year = date('Y');

//$page = "pencapaian_test.php";
$page = "pencapaian.php";

if (isset($_POST['bmonth'])) {

	if (!empty($_POST['filter_month'])) {
		$_SESSION['fmonth'] = $_POST['filter_month'];
		$filter_month = $_SESSION['fmonth'];
	} else {
		$_SESSION['fmonth'] = "";
	}

	echo "<script>document.location='" . $page . "';</script>";
}

if (isset($_POST['bclearmonth'])) {

	$_SESSION['fmonth'] = "";
	$_SESSION['fday'] = "";
	echo "<script>document.location='" . $page . "';</script>";
}

if (!empty($_SESSION['fmonth'])) {
	$sesi_month = $_SESSION['fmonth'];
	$sesi_year = explode("/", $_SESSION['fmonth'])[1];
} else {
	//$sesi_month = date("m/Y", strtotime('-1 months', strtotime($date)));
	$sesi_month = date("m/Y", strtotime($date));
	$sesi_year = date("Y", strtotime($date));
}

$exp_date = explode('/', $sesi_month);
$tanggalnya = $exp_date[1] . '-' . $exp_date[0] . '-01';

$r_awal_ori = date("Y-m-01", strtotime($tanggalnya));
$r_sekarang_ori = date("Y-m-t", strtotime($tanggalnya));

$monthshort = array(
	'01' => 'Jan',
	'02' => 'Feb',
	'03' => 'Mar',
	'04' => 'Apr',
	'05' => 'May',
	'06' => 'Jun',
	'07' => 'Jul',
	'08' => 'Aug',
	'09' => 'Sep',
	'10' => 'Oct',
	'11' => 'Nov',
	'12' => 'Dec'
);

$daterange = date_range($r_awal_ori, $r_sekarang_ori, '+1 day', 'Y-m-d');
$head_colspan = count($daterange);

/* cell day def */
$def_cell = array();
for ($i = 1; $i <= date("t", strtotime($tanggalnya)); $i++) {
	$def_cell[str_pad($i, 2, "0", STR_PAD_LEFT)] = 0;
}
$head_colspan = count($def_cell);


$groupAlias = array(
	'KAR' => 'Alih Fungsi',
	'CS' => 'CS-Telemarketing',
	'8' => 'Sekretariat',
);
$groupAlamat = array(
	'Solehudin' => 1,
	'Mustafa Khaidir' => 2,
	'Ahmad Fauzi' => 3,
	'Wisnu Wijaya Purwarna' => 4,
	'Ruli Haris' => 5,
	'Cepi Saepudin' => 6,
	'Agus Sarwoko' => 7,
	'Hamaruddin' => 8,
	'Azhari' => 9,
	'Ahmad Humaidi' => 10,
	'Kurniawan Candra Guzman' => 11,
	'Zainal Maulana Saputra' => 12
);

$arr_row = array();
foreach ($groupAlias as $k => $v) {
	$arr_row[$k]['kode'] = $k;
	$arr_row[$k]['label'] = $v;
	$arr_row[$k]['manwil'] = array();
}


$sql = "

	SELECT x.rwd_nik, x.rwd_nm, x.rwd_div, SUM(x.rwd_jumlah1) AS jumlah, x.rwd_tanggal, y.kar_jdw_akses , z.kar_dtl_tlp_marketing 
	FROM ( SELECT * FROM `rwd_data_karyawan` WHERE rwd_div LIKE '%_KAR%' AND rwd_tanggal BETWEEN '" . $r_awal_ori . "' AND '" . $r_sekarang_ori . "'
		   UNION ALL SELECT * FROM `rwd_data_cs` WHERE rwd_div LIKE '%_CS%' AND rwd_tanggal BETWEEN '" . $r_awal_ori . "' AND '" . $r_sekarang_ori . "'
		   UNION ALL SELECT * FROM `rwd_data` WHERE rwd_div = '8' AND rwd_tanggal BETWEEN '" . $r_awal_ori . "' AND '" . $r_sekarang_ori . "'
	) as x
	left join kar_master as y on y.kar_nik = x.rwd_nik
	left join kar_detail as z on y.kar_id = z.kar_id
	GROUP BY rwd_nik, rwd_div, rwd_tanggal ORDER BY kar_jdw_akses DESC

";

// echo $sql;
// exit;

$arr_manwil = array();
$query = mysql_query($sql);
while ($result = mysql_fetch_assoc($query)) {

	/* DEFAULT VAR */
	$rwd_div = $result['rwd_div'];
	$rwd_nik = $result['rwd_nik'];
	$rwd_nm = $result['rwd_nm'];
	$jumlah = $result['jumlah'];
	$rwd_tanggal = $result['rwd_tanggal'];
	$manwil = $result['kar_jdw_akses'];
	$tlpmarketing = $result['kar_dtl_tlp_marketing'];

	/* SET GROUP */
	$expgroup = explode('_', $result['rwd_div']);
	$group = count($expgroup) > 1 ? $expgroup[1] : $result['rwd_div'];

	/* MANWIL */
	if ($group == '8' && strlen(trim($manwil)) > 0) {
		$anak = explode(',', $manwil);
		array_unshift($anak, $rwd_nik);

		foreach ($anak as $k => $v) {
			$arr_manwil[$v] = $rwd_nm;
		}
		array_unique($arr_manwil);
	}

	@reset($arr_manwil);
	// ksort($arr_manwil);
	$kar_manwil = isset($arr_manwil[$rwd_nik]) ? $arr_manwil[$rwd_nik] : $group;

	/* LIST MANWIL DEFAULT */
	if (isset($arr_row[$group]['manwil'][$kar_manwil]) === false) {
		$arr_row[$group]['manwil'][$kar_manwil]['nik'] = $rwd_nik;
		$arr_row[$group]['manwil'][$kar_manwil]['nama'] = $rwd_nm;
		$arr_row[$group]['manwil'][$kar_manwil]['tlpmarketing'] = $tlpmarketing;
		$arr_row[$group]['manwil'][$kar_manwil]['divisi'] = $groupAlias[$group];
		$arr_row[$group]['manwil'][$kar_manwil]['kode'] = $kar_manwil;
		$arr_row[$group]['manwil'][$kar_manwil]['alamat'] = $groupAlamat[$rwd_nm];
		$arr_row[$group]['manwil'][$kar_manwil]['list'] = array();
		$arr_row[$group]['manwil'][$kar_manwil]['total'] = 0;
	}

	/* LIST KAR DEFAULT */
	if (isset($arr_row[$group]['manwil'][$kar_manwil]['list'][$rwd_nik]) === false) {
		$arr_row[$group]['manwil'][$kar_manwil]['list'][$rwd_nik]['nik'] = $rwd_nik;
		$arr_row[$group]['manwil'][$kar_manwil]['list'][$rwd_nik]['nama'] = $rwd_nm;
		$arr_row[$group]['manwil'][$kar_manwil]['list'][$rwd_nik]['tlpmarketing'] = $tlpmarketing;
		$arr_row[$group]['manwil'][$kar_manwil]['list'][$rwd_nik]['manwil'] = $kar_manwil;
		$arr_row[$group]['manwil'][$kar_manwil]['list'][$rwd_nik]['divisi'] = $groupAlias[$group];
		$arr_row[$group]['manwil'][$kar_manwil]['list'][$rwd_nik]['days'][str_pad($dd, 2, "0", STR_PAD_LEFT)] = $jumlah;

		$arr_row[$group]['manwil'][$kar_manwil]['list'][$rwd_nik]['days'] = $def_cell;
		$arr_row[$group]['manwil'][$kar_manwil]['list'][$rwd_nik]['total'] = 0;
	}

	/* MASUKIN VALUE HARI KARYAWAN */
	$dd = date('d', strtotime($rwd_tanggal));
	$arr_row[$group]['manwil'][$kar_manwil]['list'][$rwd_nik]['days'][str_pad($dd, 2, "0", STR_PAD_LEFT)] = (int)$jumlah;
	$arr_row[$group]['manwil'][$kar_manwil]['list'][$rwd_nik]['total'] = array_sum($arr_row[$group]['manwil'][$kar_manwil]['list'][$rwd_nik]['days']);

	/* MASUKIN SUM MANWIL */
	$arr_row[$group]['manwil'][$kar_manwil]['tmp_total'][$rwd_nik] = $arr_row[$group]['manwil'][$kar_manwil]['list'][$rwd_nik]['total'];
	$arr_row[$group]['manwil'][$kar_manwil]['total'] = array_sum($arr_row[$group]['manwil'][$kar_manwil]['tmp_total']);
}


$select_asc = '';
$select_desc = '';
$select_def = 'selected';

/* SUSUN DATA BERDASARKAN ORDER BY GROUP */
$allowed_order = array("kode" => "txt", "nama" => "txt", "total" => "num");

if (isset($_GET['order']) && isset($allowed_order[$_GET['order']])) {

	$select_def = '';
	if ($_GET['mode'] == 'asc') {
		$select_asc = 'selected';
	} elseif ($_GET['mode'] == 'desc') {
		$select_desc = 'selected';
	}

	foreach ($arr_row as $k => $v) {
		/* LOOP MANWIL */
		foreach ($v['manwil'] as $k1 => $v1) {
			/* SORT UNIT */
			if ($allowed_order[$_GET['order']] == 'txt') {
				usort($v1['list'], function ($a, $b) {
					if (isset($_GET['mode']) && $_GET['mode'] == 'desc') {
						return strcmp($b[$_GET['order']], $a[$_GET['order']]);
					} else {
						return strcmp($a[$_GET['order']], $b[$_GET['order']]);
					}
				});
			} elseif ($allowed_order[$_GET['order']] == 'num') {
				usort($v1['list'], function ($a, $b) {
					if (isset($_GET['mode']) && $_GET['mode'] == 'desc') {
						return $b[$_GET['order']] - $a[$_GET['order']];
					} else {
						return $a[$_GET['order']] - $b[$_GET['order']];
					}
				});
			}

			$v['manwil'][$k1] =  $v1;
		}

		/* NEW VAL */
		$arr_row[$k] = $v;
		/* SORT MANWIL */
		if ($allowed_order[$_GET['order']] == 'txt') {
			usort($arr_row[$k]['manwil'], function ($a, $b) {
				if (isset($_GET['mode']) && $_GET['mode'] == 'desc') {
					return strcmp($b[$_GET['order']], $a[$_GET['order']]);
				} else {
					return strcmp($a[$_GET['order']], $b[$_GET['order']]);
				}
			});
		} elseif ($allowed_order[$_GET['order']] == 'num') {
			usort($arr_row[$k]['manwil'], function ($a, $b) {
				if (isset($_GET['mode']) && $_GET['mode'] == 'desc') {
					return $b[$_GET['order']] - $a[$_GET['order']];
				} else {
					return $a[$_GET['order']] - $b[$_GET['order']];
				}
			});
		}
	}
} else {
	foreach ($arr_row as $k => $v) {
		/* LOOP MANWIL */
		foreach ($v['manwil'] as $k1 => $v1) {
			/* SORT UNIT */
			usort($v1['list'], function ($a, $b) {
				return $a['alamat'] - $b['alamat'];
			});
			$v['manwil'][$k1] =  $v1;
		}

		/* NEW VAL */
		$arr_row[$k] = $v;
		/* SORT MANWIL */
		usort($arr_row[$k]['manwil'], function ($a, $b) {
			return $a['alamat'] - $b['alamat'];
		});
	}
}

// echo "<pre>";
// print_r($arr_row[8]);
// echo "</pre>";
// exit;


/* BIKIN DOM NYA */
$row_print = '';
$grand_total = $def_cell;

/* LOOP DIVISI */
foreach ($arr_row as $k => $v) {
	$total_div = $def_cell;

	/* DOM DIVISI */
	$row_print .= '
		<tr class="sticky-top heading sticky-sub-offset">
			<th class="bg-danger" colspan="' . ($head_colspan + 3) . '">
				<h5>' . $v['label'] . '</h5>
			</th>
		</tr>
	';

	/* LOOP MANWIL */
	foreach ($v['manwil'] as $k_mwl => $v_mwl) {
		/* DOM MANWIL */
		if ($v_mwl['kode'] <> $k) {
			$row_print .= '
				<tr class="sticky-top heading sticky-sub-offset">
					<th class="bg-info" colspan="' . ($head_colspan + 3) . '">
						<h5>' . "Wil. " . $groupAlamat[$v_mwl['nama']] . " " . $v_mwl['nama'] . ' <small>( ' . $v_mwl['tlpmarketing'] . ' )</small></h5>
					</th>
				</tr>
			';
		}

		/* LOOP UNIT */
		$tmp_days = array();
		foreach ($v_mwl['list'] as $k_unt => $v_unt) {
			/* DOM UNIT */
			$tmp_unit = array();
			$tmp_unit['nama'] = '<td>' . $v_unt['nama'] . '</td>';

			$tmp_unit['days'] = '';
			foreach ($v_unt['days'] as $k_untd => $v_untd) {
				$txt_color = (int)$v_untd <= 0 ? 'text-muted' : 'text-warning';
				$tmp_unit['days'] .= '<td class="text-center ' . $txt_color . '"><strong>' . $v_untd . '</strong></td>';


				/* LOOP SUM DAYS DAYS */
				if (isset($tmp_days[$k_untd])) {
					$tmp_days[$k_untd] += (int)$v_untd;
				} else {
					$tmp_days[$k_untd] = (int)$v_untd;
				}

				/* SUM GRANTOTAL */
				$grand_total[$k_untd] += (int)$v_untd;
				$total_div[$k_untd] += (int)$v_untd;
			}
			$tmp_unit['total'] = '<td class="text-right text-dark bg-warning"><strong>' . $v_unt['total'] . '</strong></td>';
			$tmp_unit['tlpmarketing'] = '<td>' . $v_unt['tlpmarketing'] . '</td>';

			$row_print .= '<tr>' . @implode('', $tmp_unit) . '</tr>';
		}

		/* TOTAL MANWIL */
		if ($v_mwl['kode'] <> $k) {
			$tmp_total = array();
			$tmp_total['nama'] = '<td>Total ' . $v_mwl['nama'] . '</td>';
			$tmp_total['days'] = '<td class="text-center text-white"><strong>' . @implode('</strong></td><td class="text-center text-white"><strong>', $tmp_days) . '</strong></td>';
			$tmp_total['total'] = '<td class="text-right text-white" style="background:#00871d"><strong>' . $v_mwl['total'] . '</strong></td>';

			$row_print .= '<tr class="bg-success">' . @implode('', $tmp_total) . '</tr>';
		}
	}

	/* TOTAL DIVISI */
	$tmp_sub_total = array();
	$tmp_sub_total['nama'] = '<th  class="text-right">Sub. Total ' . $v['label'] . ' &nbsp;&nbsp;</th>';
	$tmp_sub_total['days'] = '<th class="text-center text-dark bg-warning"><strong>' . @implode('</strong></th><th class="text-center text-dark bg-warning"><strong>', $total_div) . '</strong></th>';
	$tmp_sub_total['total'] = '<th class="text-right text-white bg-success"><strong>' . array_sum($total_div) . '</strong></th>';

	$row_print .= '<tr class="text-dark bg-warning">' . @implode('', $tmp_sub_total) . '</tr>';
}

/* GRAND TOTAL */
$tmp_sub_total = array();
$tmp_sub_total['nama'] = '<th  class="text-right text-dark bg-info">Grand. Total &nbsp;&nbsp;</th>';
$tmp_sub_total['days'] = '<th class="text-center text-dark bg-info"><strong>' . @implode('</strong></th><th class="text-center text-dark bg-info"><strong>', $grand_total) . '</strong></th>';
$tmp_sub_total['total'] = '<th class="text-right text-white bg-danger"><strong>' . array_sum($grand_total) . '</strong></th>';

$row_print .= '<tr class="text-dark bg-warning">' . @implode('', $tmp_sub_total) . '</tr>';


$dom_tbl = '
	<table class="table table-dark table-sm table-hover">
		<thead class="thead-light text-center sticky-top heading sticky-offset">
			<tr>
				<th rowspan="2" class="align-middle">Nama</th>				
				<th colspan="' . ($head_colspan) . '">' . $monthshort[$exp_date[0]] . ' ' . $$exp_date[1] . '</th>
				<th rowspan="2" class="align-middle">Total</th>
				<th rowspan="2" class="align-middle">No. Marketing</th>
			</tr>
			<tr style="font-size:13px;">
				<th>' . @implode("</th><th>", array_keys($def_cell)) . '</th>
			</tr>
		</thead>
		<tbody>' . $row_print . '</tbody>
	</table>
';

// echo "<pre>". print_r(array_keys($def_cell), 1) ."</pre>";
// echo "<pre>". print_r($grand_total, 1) ."</pre>";
// exit;
?>

<!doctype html>
<html lang="en">

<head>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<!-- Bootstrap CSS -->
	<!-- <link rel="stylesheet" href="https://sipema.p2k.co.id/assets/css/bootstrap.min.css"> -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

	<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/css/bootstrap-datepicker.min.css" rel="stylesheet" />

	<title>Rekap Pencapaian Closing PMB</title>

	<style>
		.sticky-offset {
			/* top: 35px !important; */
		}

		.sticky-sub-offset {
			top: 70px !important;
		}

		.sticky-top {

			-webkit-backface-visibility: hidden;
		}

		.position-fixed {
			-webkit-backface-visibility: hidden;
		}

		.app {
			overflow: auto;
			height: 100vh;
		}

		.heading {
			/* height: 50px; */
			/* line-height: 50px; */
			margin-top: 10px;
			/* font-size: 30px; */
			padding-left: 10px;
			position: -webkit-sticky;
			position: sticky;
			top: 0px;
		}

		.sticky-top {
			z-index: 9 !important;
		}
	</style>

</head>

<body>

	<div class="app bg-dark">
		<div class="container-fluid p-0 p-lg-2">
			<nav class="navbar navbar-expand-md navbar-dark heading bg-dark">
				<a class="navbar-brand" href="#">Rekap Pencapaian Closing PMB</a>
				<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
					<span class="navbar-toggler-icon"></span>
				</button>
				<div class="collapse navbar-collapse" id="navbarCollapse">
					<ul class="navbar-nav mr-auto">
					</ul>
					<div class="row mb-2">
						<div class="col-md-2 mt-2 mt-md-0">
							&nbsp;
						</div>

						<div class="col-md-3 mt-2 mt-md-0">
							<span class="text-white txt-bold">Sort Berdasarkan: &nbsp;</span>
							<select class="form-control w-100" name="order" onchange="filter_order(this);">
								<option value="" <?php echo $select_def; ?>>Default</option>
								<option value="total_desc" <?php echo $select_desc; ?>>Total Ter-banyak</option>
								<option value="total_asc" <?php echo $select_asc; ?>>Total Ter-minim</option>
							</select>
						</div>

						<div class="col-md-3 mt-2 mt-md-0">
							<span class="text-white txt-bold">Pencapaian: &nbsp;</span>
							<select class="form-control  w-100" onchange="gotosite(this);">
								<option value="karyawan <?php echo $select_def; ?>">Per-Karyawan</option>
								<option value="kampus">Per-Kampus</option>

							</select>
							<script>
								function gotosite(e) {
									if (e.value == 'kampus') {
										location.href = "https://cb.web.id/pencapaian_kampus.php";
									} else if (e.value == 'karyawan') {
										location.href = "https://cb.web.id/pencapaian.php";
									}
								}

								// function reload_data(e) {
								// location.href = "https://cb.web.id/pencapaian_kampus.php?urut=" + e.value;
								// }

								function filter_order(e) {
									var mode = '';
									var order = '';
									if (e.value == 'total_desc') {
										order = 'total';
										mode = 'desc';
									} else if (e.value == 'total_asc') {
										order = 'total';
										mode = 'asc';
									}
									location.href = "https://cb.web.id/pencapaian.php?order=" + order + "&mode=" + mode;
								}
							</script>
						</div>

						<div class="col-md-4 mt-2 mt-md-0">
							<span class="text-white txt-bold">Periode: &nbsp;</span>
							<form method="post" action="" class="form-inline mt-2 mt-md-0 d-flex">
								<?php if (!empty($_SESSION['fmonth'])) { ?>
									<input id="datepicker" name="filter_month" value="<?php echo $sesi_month; ?>" class="form-control mr-sm-2 w-50" type="text" disabled>
									<button name="bclearmonth" class="btn btn-outline-danger my-2 my-sm-0" type="submit">Close</button>
								<?php } else { ?>
									<input id="datepicker" name="filter_month" value="<?php echo $sesi_month; ?>" class="form-control mr-sm-2 w-50" type="text" style="z-index:999999">
									<button name="bmonth" class="btn btn-outline-success my-2 my-sm-0" type="submit">View</button>
								<?php } ?>
							</form>
						</div>
					</div>
				</div>
			</nav>

			<div class="row">
				<div class="col">
					<?php echo $dom_tbl; ?>

				</div>
			</div>
		</div>
	</div>


	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<!-- <script src="https://sipema.p2k.co.id/assets/js/bootstrap.min.js"></script> -->
	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/js/bootstrap-datepicker.min.js"></script>
	</script>
	<script>
		$('#datepicker').datepicker({
			format: 'mm/yyyy',
			minViewMode: 1,
			weekStart: 1,
			daysOfWeekHighlighted: "6,0",
			autoclose: true,
			todayHighlight: true,
		});
	</script>
</body>

</html>

<?php
function date_range($first, $last, $step = '+1 day', $output_format = 'Y-m-d')
{

	$dates = array();
	$current = strtotime($first);
	$last = strtotime($last);

	while ($current <= $last) {

		$dates[] = date($output_format, $current);
		$current = strtotime($step, $current);
	}

	return $dates;
}
?>