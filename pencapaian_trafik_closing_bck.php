<?php
error_reporting(E_ALL ^ E_NOTICE);
date_default_timezone_set('Asia/Jakarta');
session_start();

$page = "pencapaian_trafik_closing.php";

$date = date('Y-m');

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

$tanggal = date("Y-m", strtotime($tanggalnya));

// echo $tanggal;
// exit;
//$tanggal = isset($_GET['tanggal']) ? $_GET['tanggal'] : date('Y-m');

$monthshort = array(
    '01' => 'Januari',
    '02' => 'Februari',
    '03' => 'Maret',
    '04' => 'April',
    '05' => 'Mei',
    '06' => 'Juni',
    '07' => 'Juli',
    '08' => 'Agustus',
    '09' => 'September',
    '10' => 'Oktober',
    '11' => 'November',
    '12' => 'Desember'
);

$ch = curl_init(); 

curl_setopt($ch, CURLOPT_URL, "http://103.86.160.10/sipema/statistik_jamdaftar.php?tanggal=".$tanggal);

curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 

$output = curl_exec($ch); 

curl_close($ch); 


$loop_data = @json_decode($output, true);


$header = false;

$outpunya = '';

$tr = array();
$th_1 = array();
$th_2 = array();
@reset($loop_data);
foreach($loop_data as $k => $v) {
	
	if($header === false) {
		$th_1[] = '<th>Dari Jam</th>';
		$th_2[] = '<th>Sampai Jam</th>';
		foreach($v['field'] as $kjam => $vjam) {
			$th_1[] = '<th>'. $vjam['dari'] .'</th>'; // thead 1 (dari)
			$th_2[] = '<th>'. $vjam['hingga'] .'</th>'; // thead 2 (hingga)
		}
		$th_1[] = '<th rowspan="2">Jumlah</th>';
		$header = true;
	}
	
	$isi = '<td>'.$v['nama'].'</td>'; // td hari
	foreach($v['total'] as $kd => $vd) {
		$isi .= '<td>'.(int)$vd.'</td>'; // td buat total per jam
	}
	$isi .= '<td class="text-dark bg-warning">'.array_sum($v['total']).'</td>'; // td buat jumlah
	$tr[] = '<tr>'.$isi.'</tr>'; // gabungin tdnya
	
}

$tblnya =  '
	<center><h5>'.$monthshort[$exp_date[0]].' '. $$exp_date[1].'</h5></center>
	<table class="table table-dark table-sm table-hover">
		<thead>
			<tr>'. @implode("", $th_1) .'</tr>
			<tr>'. @implode("", $th_2) .'</tr>
		</thead>
		<tbody>'. @implode("", $tr) .'</tbody>
	</table>
';


?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Monitoring Trafik Jam Pencapaian</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/css/bootstrap-datepicker.min.css" rel="stylesheet" />
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
  
  <title>Monitoring Trafik Jam Pencapaian</title>
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
  <div class="container-fluid p-0 p-lg-2">
	<nav class="navbar navbar-expand-md navbar-dark heading bg-dark rounded">
		<a class="navbar-brand" href="#">Monitoring Trafik Jam Pencapaian</a>
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>
		<div class="col-md-2 mt-2 mt-md-0">
           &nbsp;
        </div>
		<div class="col-md-2 mt-2 mt-md-0">
		   &nbsp;
		</div>
		<div class="col-md-2 mt-2 mt-md-0">
		   &nbsp;
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
	</nav>
	</div>
   <div class="row">
       <div class="col">
		<div class="container mt-5">
			<?php echo $tblnya; ?>
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