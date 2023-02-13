<?php require('module/izin/izn_act.php'); ?>
<?php

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
<!-- Content Header (Page header) -->
<section class="content-header">
  <h1> <?php echo $title ." - ". $kar_data_['kar_nm'];?> <small></small> </h1>
  <ol class="breadcrumb">
    <li><a href="media.php"><i class="fa fa-dashboard"></i> Dashboard</a></li>
    <li class="active"><?php echo $title;?></li>
  </ol>
</section>
<!--
<div class="row">
<div class="col-xs-6">-->
<form class="form-horizontal" action="" method="post">
  <!-- Main content -->
  <section class="invoice col-md-8">
    <!-- title row -->
    <div class="row">
      <div class="col-sm-12 col-md-10">
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
      <div class="col-sm-12 col-md-2">
	<center>
	  <img src="module/profile/img/<?php
	  if(!empty($kar_data_['acc_img'])){
	    echo $kar_data_['acc_img'];
	  }else{
	    echo "avatar.jpg";
	  }
	  ?>" alt="No images" width="100" height="100">
	</center> 
      </div>
    </div>
    <!-- info row -->
       <div class="row invoice-info">
	    
	    <center><h3><u>FORMULIR IZIN MENINGGALKAN KANTOR </u></h3></center>
	    <center style="margin-bottom: 20px;">Nomor Surat&nbsp;&nbsp;<strong><?php echo $kpi_data_id['izn_kd']; ?></strong></center>
	    
	    <div class="col-sm-7 invoice-col">
                <address>
		  <h4><strong><?php echo $kar_data_['kar_nm'];?></strong></h4>
		  NIK: <?php echo $kar_data_['kar_nik'];?><br>
          Divisi: <?php echo $kar_data_['div_nm'];?> / <?php echo $kar_data_['jbt_nm'];?><br>
          Kantor: <?php echo $kar_data_['unt_nm'];?> / <?php echo $kar_data_['ktr_nm'];?><br>
		  <input type="hidden" name="izn_div" value="<?php echo $kar_data_['div_nm'];?>">
                </address>
         </div><!-- /.col -->
			<!--
            <div class="col-sm-5 invoice-col">
	      
	        <div class="form-group">
			  <label for="kpi_kontrak" class="col-md-12 col-md-6 control-label">Tgl. Izin :</label>
			  <div class="col-md-12 col-md-6">
				<h5><strong><?php echo $tgl->tgl_indo($kpi_data_id['izn_tanggal']);?></strong></h5>
			  </div>
			</div>
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

		  //$no=1;

		  ?>

		  <tr>

		      <td style="text-align: center"><?php echo $tgl->tgl_indo($kpi_data_id['izn_tanggal']);?></td>

		      <td style="text-align: center">					
				<?php
					if($kpi_data_id['izn_jenis'] == ""){
						echo $kpi_data_id['izn_keterangan'];
					}elseif($kpi_data_id['izn_keterangan'] == ""){
						echo $kpi_data_id['izn_jenis'];
					}else{
						echo $kpi_data_id['izn_keterangan']." ".$kpi_data_id['izn_jenis'];
					}
				?>						  
			  </td>

		      <td style="text-align: right"><?php echo $kpi_data_id['izn_waktu1']; ?></td>

		      <td style="text-align: right"><?php echo $kpi_data_id['izn_waktu2']; ?></td>
			  
			  <td style="text-align: right"><?php echo $kpi_data_id['izn_durasi']; ?></td>
			  
			  <td style="text-align: center"><?php echo $labelstatus; ?></td>

		  </tr>

		  <?php $no++;?>

	      </tbody>

	</table>

    </div><!-- /.col -->

  </div><!-- /.row -->
<hr>
<br>

        <div class="row">
            <!-- accepted payments column -->
            <div class="col-md-5">
			<strong>Pemohon</strong>
			<br>
			<br>
			<br>
			<br>
			<h5><strong><?php echo $kar_data_['kar_nm'];?></strong></h5>
            </div><!-- /.col -->
            
           <div class="col-md-4">
	      <strong>Atasan</strong>
			<br>
			<br>
			<br>
			<br>
			<h5><strong><?php

					$kpi_atasan_=$kpi_data_id['izn_atasan'];

					$kpi_tampil_atasan=$kar->kar_tampil_id($kpi_atasan_);

					$kpi_data_atasan=mysql_fetch_array($kpi_tampil_atasan);

					echo $kpi_data_atasan['kar_nm'];

					?></strong></h5>
            </div><!-- /.col -->
	    
	    <div class="col-md-3">
	     <strong>Mengetahui</strong>
			<br>
			<br>
			<br>
			<br>
			<h5><strong>HRD</strong></h5>
        </div><!-- /.col -->
	    
          </div><!-- /.row -->
    <br>
    
    <br>
    <div class="row no-print">
      <div class="col-md-12">
	  
	<?php if($kpi_data_id['izn_sts']=="X"){?>
	<a href="print_izin.php?to=prt&id=<?php echo md5($kpi_data_id['izn_kd']); ?>" target="_blank" class="btn btn-default"><i class="fa fa-print"></i> Print</a>
	<div class="pull-right">
	  <button name="baiyahh" class="btn btn-success pull-right"><i class="fa fa-thumbs-up"></i> YA</button> &nbsp;<br><br>
	  <button name="notpproved" class="btn btn-danger pull-right"><i class="fa fa-thumbs-down"></i> TIDAK</button>
	</div>
	<?php }?>
      </div>
    </div>
    
  </section><!-- /.content -->
  <div class="clearfix"></div>
</form>

<!--
</div>
</div>    -->
<?php }else{ echo"<script>document.location='?p=not_found';</script>";}?>