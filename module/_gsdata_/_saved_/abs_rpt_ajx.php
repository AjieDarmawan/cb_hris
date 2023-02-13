<?php
error_reporting(E_ALL ^ E_NOTICE);
date_default_timezone_set('Asia/Jakarta');
session_start();

require('../class.php');

$db=new Database();
$db->koneksi();

$abs=new Absen();

$date=date("Y-m-d");

if($_POST['kar_id']) {

if(!empty($_SESSION['bulan']) || !empty($_SESSION['divisi'])){
    
$sesidate = $_SESSION['bulan']."-01";
$akhirbulan = date("Y-m-t", strtotime($sesidate));

$exp_sesidate = explode("-", $akhirbulan);
$year = $exp_sesidate[0];
$month = $exp_sesidate[1];
$daysInMonth = $exp_sesidate[2];

$exp_date = explode("-", $date);
$year_month_now = $exp_date[0]."-".$exp_date[1];

if($_SESSION['bulan'] == $year_month_now){
	$day = $exp_date[2];	
}else{
	$day = 0;
}


$kar_id__=$_POST['kar_id'];
$abs_tampil_kar_2=$abs->abs_tampil_kar_2($kar_id__,$sesidate,$akhirbulan);
while($abs_data_kar_2=mysql_fetch_assoc($abs_tampil_kar_2)){
       $reportabsen[$abs_data_kar_2['abs_tgl_masuk']]=array("abs_tgl_masuk"=>$abs_data_kar_2['abs_tgl_masuk']);              
}

$firstDay = mktime(0,0,0,$month, 1, $year);
$title = strftime('%B', $firstDay);

$timestamp = strtotime('next Sunday');
$weekDays = array();
for ($i = 0; $i < 7; $i++) {
	$weekDays[] = strftime('%a', $timestamp);
	$timestamp = strtotime('+1 day', $timestamp);
}
$blank = date('w', strtotime("{$year}-{$month}-01"));



echo"<table class='table table-bordered table-hover table-striped'>
<thead>
	<tr>
		<th colspan='7' class='text-center'>";
	
	echo"<h3>".$title." ".$year."</h3>";
	
echo"
	</th>
	</tr>
	<tr>";

foreach($weekDays as $key => $weekDay) :
			echo"<td class='text-center'>"; echo $weekDay; 
echo"</td>";

		endforeach;
	
			echo"</tr></thead>
	<tbody>
	<tr>";

		for($i = 0; $i < $blank; $i++):

			echo"<td></td>";
		endfor;

		for($i = 1; $i <= $daysInMonth; $i++):
		
						$hari=sprintf("%'.02d", $i);
						$tahun_bulan=$year."-".$month;

						$pecah_tgl = explode( "-", $tahun_bulan );	


						$abs_tgl_masuk=$pecah_tgl[0]."-".$pecah_tgl[1]."-".$hari;


						if($abs_tgl_masuk==$reportabsen[$abs_tgl_masuk]["abs_tgl_masuk"]){

							$bg="class='success'";

						}else{

							$bg="class='danger'";

						}
		
		
		
			if($day == $i):
			
				if($year_month_now==$_SESSION['bulan']):
					echo"<td ".$bg."><strong>"; echo $i; echo"</strong></td>";		
				else:
					echo"<td ".$bg.">"; echo $i; echo"</td>";	
				endif;
			else:

				echo"<td ".$bg.">"; echo $i; echo"</td>";
			endif;
			if(($i + $blank) % 7 == 0):
				echo"</tr><tr>";
			endif;
		endfor;
		for($i = 0; ($i + $blank + $daysInMonth) % 7 != 0; $i++):
			echo"<td></td>";
		endfor;
	echo"</tr></tbody>
</table>";
}
}
?>

