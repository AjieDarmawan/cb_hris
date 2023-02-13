<?php
error_reporting(E_ALL ^ E_NOTICE);
date_default_timezone_set('Asia/Jakarta');
session_start();

require('class.php');
require('object.php');

$db->koneksi();

$date = date('Y-m-d');

$page = "pencapaianx.php";

if(isset($_POST['bmonth'])){

    if(!empty($_POST['filter_month'])){
        $_SESSION['fmonth'] = $_POST['filter_month'];
        $filter_month = $_SESSION['fmonth'];
    }else{
        $_SESSION['fmonth'] = "";
    }

    echo"<script>document.location='".$page."';</script>";
}

if(isset($_POST['bclearmonth'])){

    $_SESSION['fmonth'] = "";
    $_SESSION['fday'] = "";
    echo"<script>document.location='".$page."';</script>";
}

if(!empty($_SESSION['fmonth'])){
	$sesi_month = $_SESSION['fmonth'];
}else{
	//$sesi_month = date("m/Y", strtotime('-1 months', strtotime($date)));
	$sesi_month = date("m/Y", strtotime($date));
}

$exp_date = explode('/',$sesi_month);
$tanggalnya = $exp_date[1] .'-'. $exp_date[0] .'-01';

$r_awal_ori = date("Y-m-01", strtotime($tanggalnya));
$r_sekarang_ori = date("Y-m-t", strtotime($tanggalnya));

$monthshort = array(
  '01'=>'Jan', 
  '02'=>'Feb', 
  '03'=>'Mar', 
  '04'=>'Apr', 
  '05'=>'May', 
  '06'=>'Jun', 
  '07'=>'Jul', 
  '08'=>'Aug', 
  '09'=>'Sep', 
  '10'=>'Oct', 
  '11'=>'Nov', 
  '12'=>'Dec'
);

$daterange = date_range($r_awal_ori,$r_sekarang_ori,'+1 day','Y-m-d');
$head_colspan = count($daterange);

$groupAlias = array('KAR'=>'Alih Fungsi',
                    '8'=>'Sekretariat',
                    'CS'=>'CS-Telemarketing',
		    'MS'=>'Marketing Support');

$dataArr=array();
$groupArr=array();

$sql = "SELECT rwd_nik, rwd_nm, rwd_div, SUM(rwd_jumlah1) AS jumlah, rwd_tanggal
FROM ( SELECT * FROM `rwd_data_karyawan` WHERE rwd_div LIKE '%_KAR%' AND rwd_tanggal BETWEEN '".$r_awal_ori."' AND '".$r_sekarang_ori."'
       UNION ALL SELECT * FROM `rwd_data_cs` WHERE rwd_div LIKE '%_CS%' AND rwd_tanggal BETWEEN '".$r_awal_ori."' AND '".$r_sekarang_ori."'
       UNION ALL SELECT * FROM `rwd_data` WHERE rwd_div = '8' AND rwd_tanggal BETWEEN '".$r_awal_ori."' AND '".$r_sekarang_ori."'
       UNION ALL SELECT * FROM `rwd_data_ms` WHERE rwd_div LIKE '%_MS%' AND rwd_tanggal BETWEEN '".$r_awal_ori."' AND '".$r_sekarang_ori."'
)
x GROUP BY rwd_nik, rwd_div, rwd_tanggal ORDER BY rwd_nm ASC";

$query = mysql_query($sql);
while($result = mysql_fetch_assoc($query)){
    $rwd_div = $result['rwd_div'];
    $rwd_nik = $result['rwd_nik'];
    $rwd_nm = $result['rwd_nm'];
    $jumlah = $result['jumlah'];
    $rwd_tanggal = $result['rwd_tanggal'];
    
    $expgroup = explode('_',$result['rwd_div']);
    if(count($expgroup) > 1){
        $group = $expgroup[1];
    }else{
        $group = $result['rwd_div'];
    }
    $key = $rwd_nik .'_' . $rwd_nm;
    $dd = date('d', strtotime($rwd_tanggal));
    
    $dataArr[$group][$key][$dd] = $jumlah;
    $groupArr[$group] = $groupAlias[$group];
}

/*echo "<pre>";
print_r($dataArr);
echo "</pre>";*/
?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://sipema.p2k.co.id/assets/css/bootstrap.min.css">
        
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/css/bootstrap-datepicker.min.css" rel="stylesheet"/>

    <title>Rekap Pencapaian Closing PMB</title>
    
    <style>
        .sticky-offset {
            top: 56px;
        }
        .sticky-sub-offset {
            top: 125px;
        }
    </style>
    
  </head>
  <body>
    
    <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
      <a class="navbar-brand" href="#">Rekap Pencapaian Closing PMB</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarCollapse">
        <ul class="navbar-nav mr-auto">
        </ul>
        <form method="post" action="" class="form-inline mt-2 mt-md-0">
          <?php if(!empty($_SESSION['fmonth'])){ ?>
          <input id="datepicker" name="filter_month" value="<?php echo $sesi_month;?>" class="form-control mr-sm-2" type="text" disabled>
          <button name="bclearmonth" class="btn btn-outline-danger my-2 my-sm-0" type="submit">Close</button>
          <?php }else{ ?>
          <input id="datepicker" name="filter_month" value="<?php echo $sesi_month;?>" class="form-control mr-sm-2" type="text">
          <button name="bmonth" class="btn btn-outline-success my-2 my-sm-0" type="submit">View</button>
          <?php }?>
        </form>
      </div>
    </nav>
    
    <div class="row pt-5">
        <div class="col">
                <table class="table table-dark table-sm table-hover">
                    <thead class="thead-light text-center sticky-top sticky-offset">
                        <tr>
                            <th rowspan="2" class="align-middle">Nama</th>
                            <th colspan="<?php echo $head_colspan;?>"><?php echo $monthshort[$exp_date[0]] .' '. $exp_date[1];?></th>
                            <th rowspan="2" class="align-middle">Total</th>
                        </tr>
                        <tr>
                            <?php
                            foreach($daterange as $data){
                            ?>
                            <th><?php echo date('d',strtotime($data));?></th>
                            <?php }?>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        asort($groupArr);
                        $fooTotal=array();
                        $sumtotal2=0;
                        foreach($groupArr as $key1 => $val1){
                        ?>
                        <tr class="sticky-top sticky-sub-offset">
                            <th class="bg-danger" colspan="<?php echo $head_colspan + 2;?>"><h5><?php echo $val1;?></h5></th>
                        </tr>
                        <?php
                        $totalArr=array();
                        $subtotalArr=array();
                        $sumtotal=0;
                        foreach($dataArr[$key1] as $key2 => $val2){
                            $expname = explode('_',$key2);
                            $nama = $expname[1];
                        ?>
                        <tr>
                            <td><?php echo $nama;?></td>
                            <?php
                            $subtotal=0;
                            foreach($daterange as $data){
                                $hari = date('d',strtotime($data));
                                $nilai = $val2[$hari] ? $val2[$hari] : 0;
                                
                                if($nilai > 0){
                                    $txt_color = 'warning';
                                }else{
                                    $txt_color = 'muted';
                                }
                                
                                $totalArr[$key2][] = $nilai;
                                $subtotal += $nilai;
                                
                            ?>
                            <td class="text-center text-<?php echo $txt_color;?>"><strong><?php echo $nilai;?></strong></td>
                            <?php } $sumtotal += $subtotal; ?>
                            <td class="text-right text-dark bg-warning"><strong><?php echo $subtotal?></strong></td>
                        </tr>
                        <?php }?>
                        <tr>
                            <th class="text-right text-dark bg-warning">Sub. Total <?php echo $val1;?></th>
                            <?php
                            $sumArray = array();
                            foreach ($totalArr as $k=>$subArray) {
                              foreach ($subArray as $id=>$value) {
                                $sumArray[$id]+=$value;
                              }
                            }
                            
                            foreach ($sumArray as $key => $grandtotal) {
                                $fooTotal[$key1][] = $grandtotal;
                            ?>
                            <th class="text-center text-dark bg-warning"><strong><?php echo $grandtotal;?></strong></th>
                            <?php } $sumtotal2 += $sumtotal;?>
                            <th class="text-right text-dark bg-success"><strong><?php echo $sumtotal?></strong></th>
                        </tr>
                        <?php }?>
                        <tr>
                            <th class="text-right text-dark bg-info">Grand. Total</th>
                            <?php
                            $sumArray2 = array();
                            foreach ($fooTotal as $k=>$subArray2) {
                              foreach ($subArray2 as $id=>$value) {
                                $sumArray2[$id]+=$value;
                              }
                            }
                            
                            foreach ($sumArray2 as $key => $grandtotal2) {
                            ?>
                            <th class="text-center text-dark bg-info"><strong><?php echo $grandtotal2;?></strong></th>
                            <?php }?>
                            <th class="text-right text-dark bg-danger"><strong><?php echo $sumtotal2?></strong></th>
                        </tr>
                    </tbody>
                </table>
         
        </div>
    </div>
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://sipema.p2k.co.id/assets/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/js/bootstrap-datepicker.min.js"></script></script>
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
function date_range($first, $last, $step = '+1 day', $output_format = 'Y-m-d' ) {

    $dates = array();
    $current = strtotime($first);
    $last = strtotime($last);

    while( $current <= $last ) {

        $dates[] = date($output_format, $current);
        $current = strtotime($step, $current);
    }

    return $dates;
}
?>