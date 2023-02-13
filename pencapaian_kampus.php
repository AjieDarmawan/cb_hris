<?php
error_reporting(E_ALL ^ E_NOTICE);
date_default_timezone_set('Asia/Jakarta');
session_start();

require('class.php');
require('object.php');

$db->koneksi();

$date = date('Y-m-d');
$year = date('Y');

$page = "pencapaian_kampus.php";

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

$groupAlias = array(
    'KAR' => array('kode' => 'af', 'nama' => 'Alih Fungsi'),
    '8' => array('kode' => 'ut', 'nama' => 'Sekretariat'),
    'CS' => array('kode' => 'cs', 'nama' => 'CS-Telemarketing')
);

$arr_tanggal = array();
$max_date_month = date("t", strtotime($tanggalnya));


/*--- AMBIL KAMPUSNYA SIEMA ---------------------------------------------------------------------------------------------------------------------*/
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "https://api.p2k.co.id/kampus/list-min?length=1000&manwil=" . $_GET['wilayah']);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
$pts_sipema = @json_decode(curl_exec($ch), true);
curl_close($ch);

$list_pts = array();
if (isset($pts_sipema['listdata']['datanya'])) {
    foreach ($pts_sipema['listdata']['datanya'] as $k => $v) {
        $key = $v['kode'];


        $list_pts['pts'][$key]['kode'] = $key;
        $list_pts['pts'][$key]['wilayah'] = $v['wilayah'];
        $list_pts['pts'][$key]['nama'] = $v['nama'];
        $list_pts['pts'][$key]['singkatan'] = $v['singkatan'];

        for ($idt = 1; $idt <= $max_date_month; $idt++) {
            $list_pts['pts'][$key]['detail'][str_pad($idt, 2, "0", STR_PAD_LEFT)] = 0;

            $list_pts['cs']['date'][str_pad($idt, 2, "0", STR_PAD_LEFT)] = 0;
            $list_pts['af']['date'][str_pad($idt, 2, "0", STR_PAD_LEFT)] = 0;
            $list_pts['ut']['date'][str_pad($idt, 2, "0", STR_PAD_LEFT)] = 0;

            $list_pts['sum']['date'][str_pad($idt, 2, "0", STR_PAD_LEFT)] = 0;
        }
        $list_pts['pts'][$key]['total'] = array_sum($list_pts['pts'][$key]['detail']);

        $list_pts['cs']['total'] = array_sum($list_pts['cs']['date']);
        $list_pts['af']['total'] = array_sum($list_pts['af']['date']);
        $list_pts['ut']['total'] = array_sum($list_pts['ut']['date']);

        $list_pts['sum']['total'] = array_sum($list_pts['sum']['date']);
    }
}
/*-----------------------------------------------------------------------------------------------------------------------------------------------*/


/*--- AMBIL DATA PENCAPAIAN DARI RWD CB ---------------------------------------------------------------------------------------------------------*/
$sql = "
	SELECT x.rwd_nik, x.rwd_nm, x.rwd_div, x.rwd_jumlah1, x.rwd_datatext1, x.rwd_tanggal, y.kar_jdw_akses 
	FROM 
	( 
		SELECT * FROM `rwd_data_karyawan` WHERE rwd_div LIKE '%_KAR%' AND rwd_tanggal BETWEEN '" . $r_awal_ori . "' AND '" . $r_sekarang_ori . "' AND rwd_jumlah1 > 0
		UNION ALL 
		SELECT * FROM `rwd_data_cs` WHERE rwd_div LIKE '%_CS%' AND rwd_tanggal BETWEEN '" . $r_awal_ori . "' AND '" . $r_sekarang_ori . "' AND rwd_jumlah1 > 0
		UNION ALL 
		SELECT * FROM `rwd_data` WHERE rwd_div = '8' AND rwd_tanggal BETWEEN '" . $r_awal_ori . "' AND '" . $r_sekarang_ori . "' AND rwd_jumlah1 > 0
	) as x
	left join kar_master as y on y.kar_nik = x.rwd_nik
	ORDER BY rwd_tanggal ASC
";
//echo $sql;
$query = mysql_query($sql);
while ($result = mysql_fetch_assoc($query)) {

    $dd = date('d', strtotime($result['rwd_tanggal']));

    $split_by = str_replace(".", "", $result['rwd_nik']);
    $row_pencapaian = @explode($split_by, $result['rwd_datatext1']);
    $row_pencapaian = array_filter($row_pencapaian);

    $expgroup = explode('_', $result['rwd_div']);
    $group = $expgroup[1];
    if (count($expgroup) > 1) {
        $group = $expgroup[1];
    } else {
        $group = $result['rwd_div'];
    }

    foreach ($row_pencapaian as $k => $v) {
        $tmp_data = @explode("#", $v);
        $key = strtolower($tmp_data[1]);

        if (isset($list_pts['pts'][$key])) {
            @reset($list_pts);
            $list_pts['sum']['date'][$dd]++;
            $list_pts['sum']['total'] = array_sum($list_pts['sum']['date']);

            $list_pts[$groupAlias[$group]['kode']]['date'][$dd]++;
            $list_pts[$groupAlias[$group]['kode']]['total'] = array_sum($list_pts[$groupAlias[$group]['kode']]['date']);

            $list_pts['pts'][$key]['detail'][$dd]++;
            $list_pts['pts'][$key]['total'] = array_sum($list_pts['pts'][$key]['detail']);
        }
    }
}

$select_asc = '';
$select_desc = '';
$select_wilayah = '';
if (isset($_GET['urut']) && $_GET['urut'] == 'asc') {
    $resort = $list_pts['pts'];

    usort($resort, function ($a, $b) {
        return $a['total'] - $b['total'];
    });
    $list_pts['pts'] = $resort;
    $select_asc = 'selected';
} else if (isset($_GET['urut']) && $_GET['urut'] == 'wilayah') {
    $resort = $list_pts['pts'];

    usort($resort, function ($a, $b) {
        $anya = trim(explode(" ", $a['wilayah'])[1]);
        $bnya = trim(explode(" ", $b['wilayah'])[1]);
        return $anya - $bnya;
    });
    $list_pts['pts'] = $resort;
    $select_wilayah = 'selected';
} else {
    $resort = $list_pts['pts'];

    usort($resort, function ($a, $b) {
        return $b['total'] - $a['total'];
    });
    $list_pts['pts'] = $resort;
    $select_desc = 'selected';
}


// if(isset($_GET['rm'])) {

// $resort = $list_pts['pts'];

// usort($resort, function($a, $b) {
// return $b['total'] - $a['total'];
// });
// $list_pts['pts'] = $resort;
// echo "<pre>". print_r($resort,1) ."</pre>";
// echo "<pre>". print_r($list_pts,1) ."</pre>";
// exit;
// }
/*-----------------------------------------------------------------------------------------------------------------------------------------------*/

$row_pencapaian = '';
if (isset($_GET['rowdata']) && $_GET['rowdata'] == '1') {
    header('Content-Type: application/json');
    echo json_encode($list_pts, JSON_PRETTY_PRINT);
    exit;
} else {

    @reset($list_pts);
    foreach ($list_pts['pts'] as $k => $v) {

        $jum_tgl = '';
        foreach ($v['detail'] as $kt => $vt) {
            $txt_color = (int)$vt > 0 ? 'warning' : 'muted';
            $jum_tgl .= '<td class="text-center text-' . $txt_color . ' font-weight-bold">' . $vt . '</td>';
        }

        $row_pencapaian .= '<tr>';
        $row_pencapaian .= '	<td>' . $v['kode'] . '</td>';
        $row_pencapaian .= '	<td>' . $v['wilayah'] . '</td>';
        $row_pencapaian .= '	<td>' . $v['singkatan'] . '</td>';
        $row_pencapaian .=         $jum_tgl;
        $row_pencapaian .= '	<td class="text-right text-dark bg-warning  font-weight-bold">' . $v['total'] . '</td>';
        $row_pencapaian .= '</tr>';
    }


    /* TOTAL ALIH FUNGSI */
    $row_pencapaian .= '<tr class="bg-info font-weight-bold">';
    $row_pencapaian .= '	<td class="text-center text-white" colspan="3">Total Alih Fungsi</td>';
    $row_pencapaian .= '	<td class="text-center text-white">' . @implode('</td><td class="text-center text-white">', $list_pts['af']['date']) . '</td>';
    $row_pencapaian .= '	<td class="text-right text-white" style="background:#0d8093">' . $list_pts['af']['total'] . '</td>';
    $row_pencapaian .= '</tr>';

    /* TOTAL CS */
    $row_pencapaian .= '<tr class="bg-primary font-weight-bold">';
    $row_pencapaian .= '	<td class="text-center text-white" colspan="3">Total CS</td>';
    $row_pencapaian .= '	<td class="text-center text-white">' . @implode('</td><td class="text-center text-white">', $list_pts['cs']['date']) . '</td>';
    $row_pencapaian .= '	<td class="text-right text-white" style="background:#016cdf">' . $list_pts['cs']['total'] . '</td>';
    $row_pencapaian .= '</tr>';

    /* TOTAL SEKRETARIAT */
    $row_pencapaian .= '<tr class="bg-danger font-weight-bold">';
    $row_pencapaian .= '	<td class="text-center text-white" colspan="3">Total Sekretariat</td>';
    $row_pencapaian .= '	<td class="text-center text-white">' . @implode('</td><td class="text-center text-white">', $list_pts['ut']['date']) . '</td>';
    $row_pencapaian .= '	<td class="text-right text-white" style="background:#aa2835">' . $list_pts['ut']['total'] . '</td>';
    $row_pencapaian .= '</tr>';


    /* TOTAL KESELURUHAN */
    $row_pencapaian .= '<tr class="bg-success font-weight-bold">';
    $row_pencapaian .= '	<td class="text-center text-white" colspan="3">Total Keseluruhan</td>';
    $row_pencapaian .= '	<td class="text-center text-white">' . @implode('</td><td class="text-center text-white">', $list_pts['sum']['date']) . '</td>';
    $row_pencapaian .= '	<td class="text-right text-white" style="background:#00871d">' . $list_pts['sum']['total'] . '</td>';
    $row_pencapaian .= '</tr>';
}

// echo "<pre>". print_r($list_pts['pts'],1) . "</pre>";
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
                            <span class="text-white txt-bold">Filter Wilayah:</span>
                            <select class="form-control  w-100" onchange="filter_wilayah(this);">
                                <?php
                                echo "<option value='' selected>Semua</option>";
                                $selected = '';
                                for ($i = 1; $i < 13; $i++) {
                                    if ($i == $_GET['wilayah']) {
                                        $selected = 'selected';
                                    } else {
                                        $selected = '';
                                    }
                                    echo "<option value='{$i}' {$selected}>Wil {$i}</option>";
                                }
                                ?>
                            </select>
                        </div>

                        <div class="col-md-3 mt-2 mt-md-0">
                            <span class="text-white txt-bold">Sort Berdasarkan: &nbsp;</span>
                            <select class="form-control w-100" onchange="reload_data(this);">
                                <option value="desc" <?php echo $select_desc; ?>>Total Ter-banyak</option>
                                <option value="asc" <?php echo $select_asc; ?>>Total Ter-minim</option>
                                <option value="wilayah" <?php echo $select_wilayah; ?>>Wilayah</option>
                            </select>
                        </div>

                        <div class="col-md-3 mt-2 mt-md-0">
                            <span class="text-white txt-bold">Pencapaian: &nbsp;</span>
                            <select class="form-control  w-100" onchange="gotosite(this);">
                                <option value="kampus" selected>Per-Kampus</option>
                                <option value="karyawan">Per-Karyawan</option>
                            </select>
                            <script>
                                function gotosite(e) {
                                    if (e.value == 'kampus') {
                                        location.href = "https://cb.web.id/pencapaian_kampus.php";
                                    } else if (e.value == 'karyawan') {
                                        location.href = "https://cb.web.id/pencapaian.php";
                                    }
                                }

                                function reload_data(e) {
                                    location.href = "https://cb.web.id/pencapaian_kampus.php?urut=" + e.value;
                                }

                                function filter_wilayah(e) {
                                    location.href = "https://cb.web.id/pencapaian_kampus.php?wilayah=" + e.value;
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
                    <table class="table table-dark table-sm table-hover">
                        <thead class="thead-light text-center sticky-top heading sticky-offset">
                            <tr>
                                <th rowspan="2" class="align-middle" width="5%">Kode</th>
                                <th rowspan="2" class="align-middle">Wilayah</th>
                                <th rowspan="2" class="align-middle">Kampus</th>
                                <th colspan="<?php echo $head_colspan; ?>"><?php echo $monthshort[$exp_date[0]] . ' ' . $exp_date[1]; ?></th>
                                <th rowspan="2" class="align-middle">Total</th>
                            </tr>
                            <tr>
                                <?php
                                foreach ($daterange as $data) {
                                ?>
                                    <th><?php echo date('d', strtotime($data)); ?></th>
                                <?php } ?>
                            </tr>
                        </thead>
                        <tbody>
                            <?php echo $row_pencapaian; ?>
                        </tbody>
                    </table>
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