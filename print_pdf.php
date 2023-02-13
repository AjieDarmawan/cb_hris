<?php
error_reporting(E_ALL ^ E_NOTICE);
date_default_timezone_set('Asia/Jakarta');
session_start();

ini_set('max_execution_time', 300); 

require('class.php');
require('object.php');

$db->koneksi();

$date=date('Y-m-d');

require('module/penilaian/nla_act.php'); 

if($fpk_cek_id > 0){

ob_start();

$title=$fpk_data_id['fpk_kd'];  

?>
<!-- Main content -->
<style>
  .table td{
    padding: 3px;
  }
</style>
<div style="padding:30px">
  <table style="width: 93%">
    <tr>
      <td style="width: 10%"><img src="dist/img/logo_gg_small130.JPG" width="80"></td>
      <td style="width: 70%;vertical-align: middle;font-size:18px;"><strong>PT. Gilland Ganesha</strong></td>
      <td style="width: 20%;vertical-align: middle;text-align: right;">
	<?php
	if($fpk_data_id['fpk_tgl']!=="0000-00-00"){
	  $fpk_tgl_="<strong>Date: </strong> ".$tgl->tgl_indo($fpk_data_id['fpk_tgl']);
	}else{
	  $fpk_tgl_="";
	}
	echo $fpk_tgl_;
	?>
      </td>
    </tr>
    <tr>
      <td colspan="3" style="text-align: center;">Jl. Raya Bogor Km 47,5 Perum Bumi Sentosa Blok A3 No.3, Nanggewer Cibinong, Jawa Barat 16912.</td>
    </tr>
    <tr>
      <td colspan="3" style="text-align: center;"><hr></td>
    </tr>
  </table>
  
  <table style="width: 98%">
    <tr>
      <td style="width: 100%;text-align: center;">
	<h4><u>FORM PENILAIAN KERJA</u></h4>
	Nomor Surat&nbsp;&nbsp;<b> <?php echo $fpk_data_id['fpk_kd'];?></b>
      </td>
    </tr>
  </table>
  
  <table style="width: 98%; margin-top: 50px">
    <tr>
      <td style="width: 40%;text-align: left;">
	<strong><?php echo $kar_data__['kar_nm'];?></strong><br>
	NIK: <?php echo $kar_data__['kar_nik'];?><br>
	Divisi: <?php echo $kar_data__['div_nm'];?> / <?php echo $kar_data__['jbt_nm'];?><br>
	Location: <?php echo $kar_data__['unt_nm'];?> / <?php echo $kar_data__['ktr_nm'];?><br>
      </td>
      <td style="width: 30%;text-align: left;">
	&nbsp;
      </td>
      <td style="width: 30%;text-align: left;">
	<br>
	Priode Penilaian: <strong><?php echo $fpk_data_id['fpk_priode'];?></strong><br>
	<br>
	Gaji Terakhir: Rp. <strong><?php echo $rph->format_rupiah($fpk_data_id['fpk_gaji']);?></strong><br>
      </td>
    </tr>
  </table>
  
  <table class="table" style="width: 98%;margin-top: 30px">
    <tbody>
      <?php
      $fpk_tampil_point=$nla->fpk_tampil_point_all();
      while($fpk_data_point=mysql_fetch_array($fpk_tampil_point)){
	 $i=$fpk_data_point['fpk_point_id'];
	 $x = "fpk_nilai{$i}";
	 
	 if($fpk_data_id[$x]!=="0"){
	    $fpk_bobot=$fpk_data_id[$x];
	 }else{
	    $fpk_bobot="-";
	 }
	 
	 $fpk_grade=$fpk_data_id[$x];
	 $fpk_tampil_grade=$nla->fpk_tampil_grade($fpk_grade);
	 $fpk_data_grade=mysql_fetch_array($fpk_tampil_grade);
	 
      ?>  
      <tr>
	<td style="width: 3%;text-align: left;">-</td>
	<td style="width: 70%;text-align: left;"><?php echo $fpk_data_point['fpk_point_nm']; ?></td>
	<td style="width: 3%;text-align: left;"><?php echo $fpk_data_grade['fpk_huruf'];?></td>
	<td style="width: 3%;text-align: right;"><?php echo $fpk_bobot;?></td>
	<td style="width: 10%;text-align: left;"><small><?php echo $fpk_data_grade['fpk_lable'];?></small></td>
      </tr>
      <?php }?>
     
    </tbody>
  </table>
  
  <table style="width: 98%; margin-top: 50px">
    <tr>
      <td style="width: 30%;text-align: left;">
	<strong>Team Penilai:</strong>
	<br>
	<?php
	$fpk_penilai_=$fpk_data_id['fpk_penilai'];
	$fpk_tampil_penilai=$kar->kar_tampil_id($fpk_penilai_);
	$fpk_data_penilai=mysql_fetch_array($fpk_tampil_penilai);
	echo $fpk_data_penilai['kar_nm'];
	?>
      </td>
      <td style="width: 30%;text-align: left;">
	<strong>Mengetahui:</strong>
	<br>
	 <?php
	 /*
	$fpk_mengetahui_=$fpk_data_id['fpk_mengetahui'];
	$fpk_tampil_mengetahui=$kar->kar_tampil_id($fpk_mengetahui_);
	$fpk_data_mengetahui=mysql_fetch_array($fpk_tampil_mengetahui);
	echo $fpk_data_mengetahui['kar_nm'];
	*/
	$fpk_mengetahui_=$fpk_data_id['fpk_mengetahui'];
                $fpk_tampil_mengetahui=$kar->kar_tampil_id($fpk_mengetahui_);
                $fpk_data_mengetahui=mysql_fetch_array($fpk_tampil_mengetahui);
				
				$fpk_mengetahui_2=$fpk_data_id['fpk_mengetahui2'];
                $fpk_tampil_mengetahui2=$kar->kar_tampil_id($fpk_mengetahui_2);
                $fpk_data_mengetahui2=mysql_fetch_array($fpk_tampil_mengetahui2);
				
				$fpk_mengetahui_3=$fpk_data_id['fpk_mengetahui3'];
                $fpk_tampil_mengetahui3=$kar->kar_tampil_id($fpk_mengetahui_3);
                $fpk_data_mengetahui3=mysql_fetch_array($fpk_tampil_mengetahui3);
				
                echo $fpk_data_mengetahui2['kar_nm'];
				
				if(!empty($fpk_data_mengetahui2['kar_nm'])){
				  echo "<br>";
				}
				
                echo $fpk_data_mengetahui['kar_nm'];
				
				if(!empty($fpk_data_mengetahui['kar_nm'])){
				  echo "<br>";
				}
				
				 echo $fpk_data_mengetahui3['kar_nm'];
	?>
      </td>
      <td style="width: 40%;text-align: left;">
	<strong>Ditetapkan: </strong><em><small>(Hanya Karyawan Kontrak)</small></em>
	<br>
       <?php echo $fpk_data_id['fpk_ditetapkan'] ? : "-"; ?>
      </td>
    </tr>
  </table>
  
  <table class="table" style="width: 98%; margin-top: 50px">
    <tr>
      <td style="width: 30%;text-align: left;">
	<strong>* Prestasi</strong><br>
	<small><?php echo $fpk_data_id['fpk_prestasi'] ? : "-"; ?></small>
      </td>
      <td style="width: 30%;text-align: left;">
	<strong>* Pelanggaran</strong><br>
	<small><?php echo $fpk_data_id['fpk_pelanggaran'] ? : "-"; ?></small>
      </td>
      <td style="width: 40%;text-align: left;">
	<strong>* Saran</strong><br>
	<small><?php echo $fpk_data_id['fpk_saran'] ? : "-"; ?></small>
      </td>
    </tr>
  </table>
  
</div>

<?php

  $content = ob_get_clean();
  require_once('plugins/html2pdf/html2pdf.class.php');
  try
  {

      $html2pdf = new HTML2PDF('P','A4','en', false, 'ISO-8859-15', array(mL, mT, mR, mB));
  
      $html2pdf->setDefaultFont('Arial');
      $html2pdf->pdf->SetTitle($title . ' | Personalia Gilland Ganesha');
      $html2pdf->writeHTML($content, false);
      
      $html2pdf->Output('DATA_PENILAIAN_KARYAWAN'.'_'.$fpk_data_id['fpk_kd'].'.pdf');
  
  }
  catch(HTML2PDF_exception $e) {
      echo $e;
      exit;
  }
 
?>   

<?php }else{ echo"<script>document.location='media.php?p=not_found';</script>";}?> 