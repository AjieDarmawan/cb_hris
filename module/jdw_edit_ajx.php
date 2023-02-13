<?php

error_reporting(E_ALL ^ E_NOTICE);

date_default_timezone_set('Asia/Jakarta');

session_start();



require('../class.php');



$db=new Database();

$db->koneksi();



$jdw=new Jadwal();

$jdw_aktif_blnthn = $jdw->jdw_aktif_blnthn();
$jdw_aktif_data = mysql_fetch_assoc($jdw_aktif_blnthn);

$jdw_blnthn = $jdw_aktif_data['jda_blnthn'];

$bulannya = substr($jdw_blnthn, 0,2);
$tahunnya = substr($jdw_blnthn, -4);
$thnbln = $tahunnya."-".$bulannya;

//$date=$thnbln."-".date('d');
$date=$thnbln."-01";

$bulan=$thnbln;



if($_POST['jdw_id']) {



$akhirbulan = date("Y-m-t", strtotime($date));



$exp_sesidate = explode("-", $akhirbulan);

$year = $exp_sesidate[0];

$month = $exp_sesidate[1];

$daysInMonth = $exp_sesidate[2];



$exp_date = explode("-", $date);

$year_month_now = $exp_date[0]."-".$exp_date[1];



if($bulan == $year_month_now){
	
	$cek_bln_now = date('Y-m');
	if($bulan !== $cek_bln_now){
		$day = 0;
	}else{
		$day = $exp_date[2];	
	}

}else{

	$day = 0;

}





$jdw_id__=$_POST['jdw_id'];

$jdw_tampil_id=$jdw->jdw_tampil_id($jdw_id__);

$jdw_data_id=mysql_fetch_assoc($jdw_tampil_id);

$jdw_data = explode('#', $jdw_data_id['jdw_data']);
$jdw_count = count($jdw_data);

$z=0;
for($i=0; $i<$jdw_count; $i++){
	$z = $i + 1;
	$jdwArr[$z] = $jdw_data[$i];
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

	

	echo"<h4>".$title." ".$year."</h4>";

	

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

		

						$bg="class='success'";

		

		

		

			if($day == $i):

			

				if($year_month_now==$bulan):

					echo"<td ".$bg."><strong>";

                                        echo $i;

                                        echo "<br><input type='text' class='form-control input-sm' name='jdw_data[$i]' value='".$jdwArr[$i]."'>";

                                        echo"</strong></td>";		

				else:

					echo"<td ".$bg.">";

                                        echo $i;

                                        echo "<br><input type='text' class='form-control input-sm' name='jdw_data[$i]' value='".$jdwArr[$i]."'>";

                                        echo"</td>";	

				endif;

			else:



				echo"<td ".$bg.">";

                                echo $i;

                                echo "<br><input type='text' class='form-control input-sm' name='jdw_data[$i]' value='".$jdwArr[$i]."'>";

                                echo"</td>";

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

?>



