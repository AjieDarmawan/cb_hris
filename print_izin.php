<?php

error_reporting(E_ALL ^ E_NOTICE);

date_default_timezone_set('Asia/Jakarta');

session_start();



ini_set('max_execution_time', 300); 



require('class.php');

require('object.php');



$db->koneksi();

$date=date('Y-m-d');



require('module/izin/izn_act.php');



$p1_readonly = "readonly"; //readonly

$p2_readonly = "readonly"; //readonly

$p3_readonly = "readonly"; //readonly

$p1_disabled = "disabled"; //disabled

$p2_disabled = "disabled"; //disabled

$p3_disabled = "disabled"; //disabled

$p3_ditetapkan = "";

$p3_tanggal = "readonly";



if($kpi_cek_id > 0){

  

if($kpi_data_id['kpi_sts']=='A'){

  $p3_readonly = "";

  $p3_disabled = "";

}else{

  $p3_readonly = "readonly";

  $p3_disabled = "disabled";

  $p3_ditetapkan = "disabled";

}



$title = $kpi_data_id['kpi_kd'];

if($kpi_data_id['izn_jenis']=='Sebar Brosur'){
	$checked_sebarbrosur = "checked";
}else{
	$checked_sebarbrosur = "";
}
if($kpi_data_id['izn_jenis']=='Sakit'){
	$checked_sakit = "checked";
}else{
	$checked_sakit = "";
}
if($kpi_data_id['izn_jenis']=='Kunjungan Marketing'){
	$checked_kunjungan = "checked";
}else{
	$checked_kunjungan = "";
}
if($kpi_data_id['izn_jenis']=='Keluarga Inti Sakit'){
	$checked_keluargaskt = "checked";
}else{
	$checked_keluargaskt = "";
}
if($kpi_data_id['izn_jenis']=='Keluarga Inti Meninggal'){
	$checked_keluargaintmng = "checked";
}else{
	$checked_keluargaintmng = "";
}

if($kpi_data_id['izn_sts']=='Y'){
	$labelstatus = "Ya";
}elseif($kpi_data_id['izn_sts']=='T'){
	$labelstatus = "Tidak";
}else{
	$labelstatus = "Proses";
}

?>



<?php include('component/tag_head.php'); ?>



<script type="text/javascript">

  window.print();

</script>



<!-- Main content -->

<section class="invoice col-md-7">

  <!-- title row -->

  <div class="row">

    <div class="col-xs-10">

      <h2 class="page-header">

	<div class="row">

	  <div class="col-xs-3 col-md-2">

	    <img src="dist/img/logo_gg_small130.JPG" width="80"> 

	  </div>

	  <div class="col-xs-9 col-md-10">

	    PT. Gilland Ganesha<br>

	    <small>Jl. Raya Bogor Km 47,5 Perum Bumi Sentosa Blok A3 No.3, Nanggewer Cibinong, Jawa Barat 16912.</small>

	  </div>

	</div>

      </h2>

    </div><!-- /.col -->

    <div class="col-xs-2">

      <center>

	<img src="module/profile/img/<?php

	if(!empty($kar_data__['acc_img'])){

	  echo $kar_data__['acc_img'];

	}else{

	  echo "avatar.jpg";

	}

	?>" alt="No images" width="100" height="100">

      </center> 

    </div>

  </div>

  <!-- info row -->

  <div class="row invoice-info">



    <center><h3><u>FORMULIR IZIN MENINGGALKAN KANTOR</u></h3></center>

    <center style="margin-bottom: 20px;">Nomor Surat&nbsp;&nbsp;<strong><?php echo $kpi_data_id['izn_kd'];?></strong></center>

    

    <div class="col-xs-9 invoice-col">

      <address>

	<h4><strong><?php echo $kar_data__['kar_nm'];?></strong></h4>

	NIK: <?php echo $kar_data__['kar_nik'];?><br>

	Divisi: <?php echo $kar_data__['div_nm'];?> / <?php echo $kar_data__['jbt_nm'];?><br>

	Kantor: <?php echo $kar_data__['unt_nm'];?> / <?php echo $kar_data__['ktr_nm'];?><br>

	<input type="hidden" name="kpi_div" value="<?php echo $kar_data__['div_nm'];?>">

      </address>

    </div><!-- /.col -->

    
<!--
    <div class="col-xs-3 invoice-col">

      <address>

	<h4>&nbsp;</h4>

	Tgl. Izin: <strong><?php if($kpi_data_id['izn_tanggal']!=="0000-00-00"){ echo $tgl->tgl_indo($kpi_data_id['izn_tanggal']); } else { echo "-"; };?></strong><br>

      </address>

    </div>
-->
  </div><!-- /.row -->



  <!-- Table row -->

  <div class="row">

    <div class="col-md-12 table-responsive">

	<table class="table table-striped table-bordered table-condensed" style="font-size: 14px;">

	    <thead>

		<tr>

		    <th rowspan="2" style="vertical-align: middle;text-align: center">Tgl. Izin</th>

		    <th rowspan="2" style="vertical-align: middle;text-align: center">Alasan</th>

		    <th colspan="2" style="text-align: center">Waktu</th>
			
			<th rowspan="2" style="vertical-align: middle;text-align: center">Durasi</th>
			
			<th rowspan="2" style="vertical-align: middle;text-align: center">Approved</th>

		</tr>

		<tr>

		    <th style="text-align: center">Jam Awal</th>

		    <th style="text-align: center">Jam Akhir</th>

		</tr>

	    </thead>

	      <tbody>

		  <?php

		  $no=1;

		  ?>

		  <tr>

		      <td><?php echo $tgl->tgl_indo($kpi_data_id['izn_tanggal']); ?></td>

		      <td>					
				<?php
					if($kpi_data_id['izn_jenis'] == ""){
						echo $kpi_data_id['izn_keterangan'];
					}elseif($kpi_data_id['izn_keterangan'] == ""){
						echo $kpi_data_id['izn_jenis'];
					}else{
						echo $kpi_data_id['izn_keterangan'].",".$kpi_data_id['izn_jenis'];
					}
				?>						  
			  </td>

		      <td style="text-align: right"><?php echo $kpi_data_id['izn_waktu1']; ?></td>

		      <td style="text-align: right"><?php echo $kpi_data_id['izn_waktu2']; ?></td>
			  
			  <td style="text-align: right"><?php echo $kpi_data_id['izn_durasi']; ?></td>
			  
			  <td style="text-align: right"><?php echo $labelstatus; ?></td>

		  </tr>

		  <?php $no++;?>

	      </tbody>

	</table>

    </div><!-- /.col -->

  </div><!-- /.row -->



  <div class="row">

    <!-- accepted payments column -->

    <div class="col-xs-4">

      <strong>Pemohon:</strong>

      <br>
      <br>
	  <br>

      <strong><?php echo $kar_data__['kar_nm'];?></strong>

      <br>
      <br>
	
    </div><!-- /.col -->



    <div class="col-xs-4">

      <strong>Atasan:</strong>

      <br>
      <br>
	  <br>

      <strong>
		<?php

		$kpi_atasan_=$kpi_data_id['izn_atasan'];

		$kpi_tampil_atasan=$kar->kar_tampil_id($kpi_atasan_);

		$kpi_data_atasan=mysql_fetch_array($kpi_tampil_atasan);

		echo $kpi_data_atasan['kar_nm'];

		?>
	  </strong>

      <br>
      <br>
	
    </div><!-- /.col -->

    

    <div class="col-xs-4">

      <strong>Mengetahui:</strong>

      <br>
      <br>
	  <br>

      <strong>HRD</strong>

      <br>
      <br>
	
    </div><!-- /.col -->

    

  </div><!-- /.row -->

  <br>

  <!-- this row will not appear when printing -->

  

</section><!-- /.content -->

<div class="clearfix"></div>

        

<?php include('component/tag_js.php'); ?>



<?php }else{ echo"<script>document.location='media.php?p=not_found';</script>";}?>