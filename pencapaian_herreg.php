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
$page = "pencapaian_herreg.php";

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
$tgldoang = date("d");

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

/*$groupAlias = array('KAR'=>'Alih Fungsi',
                    '8'=>'Sekretariat',
                    'CS'=>'CS-Telemarketing',
		    'MS'=>'Marketing Support');*/

$groupAlias = array(
    // 'KAR' => 'Alih Fungsi',
    // '8' => 'Sekretariat',
    // 'CS' => 'CS-Telemarketing',
    'KEU' => 'TIM-Herregis'
);

$dataArr = array();
$dataArr2 = array();
$groupArr = array();

$sql = "SELECT rwd_nik, rwd_nm, rwd_div, SUM(rwd_jumlah1) AS jumlah, rwd_tanggal
FROM ( SELECT * FROM `rwd_data_penagihan` WHERE rwd_div LIKE '%_KEU%' AND rwd_tanggal BETWEEN '" . $r_awal_ori . "' AND '" . $r_sekarang_ori . "'
)
x GROUP BY rwd_nik, rwd_div, rwd_tanggal ORDER BY rwd_nm ASC";

/*$sql = "SELECT x.rwd_nik, x.rwd_nm, x.rwd_div, SUM(x.rwd_jumlah1) AS jumlah, x.rwd_tanggal, y.kar_jdw_akses 
FROM ( SELECT * FROM `rwd_data_karyawan` WHERE rwd_div LIKE '%_KAR%' AND rwd_tanggal BETWEEN '" . $r_awal_ori . "' AND '" . $r_sekarang_ori . "'
       UNION ALL SELECT * FROM `rwd_data_cs` WHERE rwd_div LIKE '%_CS%' AND rwd_tanggal BETWEEN '" . $r_awal_ori . "' AND '" . $r_sekarang_ori . "'
       UNION ALL SELECT * FROM `rwd_data` WHERE rwd_div = '8' AND rwd_tanggal BETWEEN '" . $r_awal_ori . "' AND '" . $r_sekarang_ori . "'
	   UNION ALL SELECT * FROM `rwd_data_penagihan` WHERE rwd_div LIKE '%_KEU%' AND rwd_tanggal BETWEEN '" . $r_awal_ori . "' AND '" . $r_sekarang_ori . "'
) as x
left join kar_master as y on y.kar_nik = x.rwd_nik
GROUP BY rwd_nik, rwd_div, rwd_tanggal ORDER BY rwd_nm ASC";*/

$query = mysql_query($sql);
while ($result = mysql_fetch_assoc($query)) {
    $rwd_div = $result['rwd_div'];
    $rwd_nik = $result['rwd_nik'];
    $rwd_nm = $result['rwd_nm'];
    $jumlah = $result['jumlah'];
    $rwd_tanggal = $result['rwd_tanggal'];
    $manwil = $result['kar_jdw_akses'];

    $expgroup = explode('_', $result['rwd_div']);
    if (count($expgroup) > 1) {
        $group = $expgroup[1];
    } else {
        $group = $result['rwd_div'];
    }

    $key = $rwd_nik . '_' . $rwd_nm;
    $dd = date('d', strtotime($rwd_tanggal));

    $dataArr[$group][$key][$dd] = $jumlah;

    $groupArr[$group] = $groupAlias[$group];

    if ($group == '8') {
        $dataArr2[$rwd_nik][$key][$dd] = $jumlah;
        if ($manwil <> '') {
            // $anak = array($rwd_nik);
            $anak = explode(',', $manwil);
            array_unshift($anak, $rwd_nik);
            $manwilArr[$key] = $anak;
        } else {
            // $anak = array();
            // array_unshift($anak, $rwd_nik);
            // $manwilArr["Nnn_Non"] = $anak;
        }
    }
}

// echo "<pre>";
// print_r($dataArr2);
// print_r(explode("/", $_SESSION['fmonth'])[1]);
// echo "</pre>";
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
                <a class="navbar-brand" href="#">
				<span>Rekap Pencapaian Herregis <small class="text-warning">(Target min. 5)</small></span>
				</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarCollapse">
                    <ul class="navbar-nav mr-auto">
                    </ul>
                    <form method="post" action="" class="form-inline mt-2 mt-md-0">
                        <?php if (!empty($_SESSION['fmonth'])) { ?>
                            <input id="datepicker" name="filter_month" value="<?php echo $sesi_month; ?>" class="form-control mr-sm-2" type="text" disabled>
                            <button name="bclearmonth" class="btn btn-outline-danger my-2 my-sm-0" type="submit">Close</button>
                        <?php } else { ?>
                            <input id="datepicker" name="filter_month" value="<?php echo $sesi_month; ?>" class="form-control mr-sm-2" type="text" style="z-index:999999">
                            <button name="bmonth" class="btn btn-outline-success my-2 my-sm-0" type="submit">View</button>
                        <?php } ?>
                    </form>
                </div>
            </nav>

            <div class="row">
                <div class="col">
                    <table class="table table-dark table-sm table-hover">
                        <thead class="thead-light text-center sticky-top heading sticky-offset">
                            <tr>
                                <th rowspan="2" class="align-middle">Nama</th>
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
                            <?php
                            asort($groupArr);
                            $fooTotal = array();
                            $sumtotal2 = 0;
                            foreach ($groupArr as $key1 => $val1) {
								
								$exp = explode("-",$val1);
								$namanya = $exp[0]." ".$exp[1] ;
                            ?>
                                <tr class="sticky-top heading sticky-sub-offset">
                                    <th class="bg-danger" colspan="<?php echo $head_colspan + 2; ?>">
                                        <h5><?php echo $namanya; ?> </h5>
                                    </th>
                                </tr>
                             

                                    <?php
                               

                                    foreach ($dataArr[$key1] as $nim_nama => $arr_tgl_n_cl) {
                                        $expname = explode('_', $nim_nama);
                                        $nama = $expname[1];
										
										if($nama == 'auto'){
											$classtd = 'bg-danger';
										}else{
											$classtd = '';
										}
                                    ?>
                                        <tr>
                                            <td class="<?php echo $classtd; ?>"><?php echo $nama; ?></td>
                                            <?php
                                            $subtotal = 0;
                                            foreach ($daterange as $data) {
                                                $tglnya = date('d', strtotime($data));
                                                $nilai = $arr_tgl_n_cl[$tglnya] ? $arr_tgl_n_cl[$tglnya] : 0;

                                                if ($nilai > 0) {
													if ($nilai >= 5) {
														$txt_color = 'warning';
													}else{
														$txt_color = 'danger';
													}
                                                } else {
													if($tglnya > $tgldoang){
														$txt_color = 'muted';
													}else{
														$txt_color = 'danger';
													}
                                                }

                                                $totalArr[$nim_nama][] = $nilai;
                                                $subtotal += $nilai;

                                            ?>
                                                <td class="text-center text-<?php echo $txt_color; ?>"><strong><?php echo $nilai; ?></strong></td>
                                            <?php }
                                            $sumtotal += $subtotal; ?>
                                            <td class="text-right text-dark bg-warning"><strong><?php echo $subtotal ?></strong></td>
                                        </tr>
                                <?php }?>
                                <tr>
                                    <th class="text-right text-dark bg-info">Total <?php echo $val1; ?></th>
                                    <?php
                                    $sumArray = array();
                                    foreach ($totalArr as $k => $subArray) {
                                        foreach ($subArray as $id => $value) {
                                            $sumArray[$id] += $value;
                                        }
                                    }

                                    foreach ($sumArray as $key => $grandtotal) {
                                        $fooTotal[$key1][] = $grandtotal;
                                    ?>
                                        <th class="text-center text-dark bg-info"><strong><?php echo $grandtotal; ?></strong></th>
                                    <?php }
                                    $sumtotal2 += $sumtotal; ?>
                                    <th class="text-right text-white bg-danger"><strong><?php echo $sumtotal ?></strong></th>
                                </tr>
                            <?php
                            } ?>
                            
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