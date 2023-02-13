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
    }
}
/*-----------------------------------------------------------------------------------------------------------------------------------------------*/


$r_awal_ori = '2022-04-04';
$r_sekarang_ori = date("Y-m-d");

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

$arr_kar = array();
$query = mysql_query($sql);
while ($result = mysql_fetch_assoc($query)) {
	
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
		
		
		$key_user = sha1($result['rwd_nik'] . strtotime($result['rwd_tanggal']) . $key);

		@reset($list_pts);
		if (isset($list_pts['pts'][$key])) {
			$arr_kar[$key_user]['kode'] = $list_pts['pts'][$key]['kode'];
			$arr_kar[$key_user]['wilayah'] = $list_pts['pts'][$key]['wilayah'];
			$arr_kar[$key_user]['kampus'] = $list_pts['pts'][$key]['singkatan'];
		}
				
		$arr_kar[$key_user]['nik'] = $result['rwd_nik'];
		$arr_kar[$key_user]['nama'] = $result['rwd_nm'];
		$arr_kar[$key_user]['divisi1'] = $groupAlias[$group]['kode'];
		$arr_kar[$key_user]['divisi2'] = $groupAlias[$group]['nama'];
		$arr_kar[$key_user]['tanggal'] = $result['rwd_tanggal'];
		
		
		if(isset($arr_kar[$key_user]['total']) === false) {
			$arr_kar[$key_user]['total'] = 0;
		}
		
		$arr_kar[$key_user]['total']++;
	}
}


@reset($arr_kar);
$row_data = '';
foreach($arr_kar as $k => $v) {
	$row_data .= '<tr>';
	$row_data .= '	<td>' . $v['tanggal'] . '</td>';
	
	// $row_data .= '	<td>' . $v['kode'] . '</td>';
	// $row_data .= '	<td>' . $v['wilayah'] . '</td>';
	$row_data .= '	<td>' . $v['kampus'] . '</td>';
	
	$row_data .= '	<td>' . $v['nik'] . '</td>';
	$row_data .= '	<td>' . $v['nama'] . '</td>';
	// $row_data .= '	<td>' . $v['divisi1'] . '</td>';
	$row_data .= '	<td>' . $v['divisi2'] . '</td>';

	$row_data .= '	<td class="text-right text-dark bg-warning  font-weight-bold">' . $v['total'] . '</td>';
	$row_data .= '</tr>';
}


// echo "<pre>". print_r("-------------------------------------------------",1) ."</pre>";
// echo "<pre>". print_r($arr_kar,1) ."</pre>";
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
                <a class="navbar-brand" href="#">Rekap Pencapaian Closing PMB Periode <?php echo $r_awal_ori; ?> sd <?php echo $r_sekarang_ori; ?></a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarCollapse">
                    <ul class="navbar-nav mr-auto">
                    </ul>
                </div>
            </nav>

            <div class="row">
                <div class="col">
                    <table class="table table-dark table-sm table-hover">
                        <thead class="thead-light sticky-top heading sticky-offset">
                            <tr>
                                <th rowspan="1" class="align-left" align="left">Tanggal</th>
								<!--
                                <th rowspan="1" class="align-left" align="left" width="5%">Kode</th>
                                <th rowspan="1" class="align-left" align="left">Wilayah</th>
								-->
                                <th rowspan="1" class="align-left" align="left">Kampus</th>
								
                                <th rowspan="1" class="align-left" align="left">NIK</th>
                                <th rowspan="1" class="align-left" align="left">Nama</th>
								<!--
                                <th rowspan="1" class="align-left" align="left">Divisi 1</th>
								-->
                                <th rowspan="1" class="align-left" align="left">Divisi</th>
								
                                <th rowspan="1" class="align-middle" align="right">Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php echo $row_data; ?>
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