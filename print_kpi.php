<?php
error_reporting(E_ALL ^ E_NOTICE);
date_default_timezone_set('Asia/Jakarta');
session_start();

ini_set('max_execution_time', 300); 

require('class.php');
require('object.php');

$db->koneksi();
$date=date('Y-m-d');

require('module/kpi/kpi_act.php');

$p1_readonly = "readonly"; //readonly
$p2_readonly = "readonly"; //readonly
$p3_readonly = "readonly"; //readonly
$p1_disabled = "disabled"; //disabled
$p2_disabled = "disabled"; //disabled
$p3_disabled = "disabled"; //disabled$p4_disabled = "disabled"; //disabled
$p3_ditetapkan = "";$p4_ditetapkan = "";
$p3_tanggal = "readonly";

if($kpi_cek_id > 0){
  
if($kpi_data_id['kpi_sts']=='A'){
  $p3_readonly = "";
  $p3_disabled = "";    $p4_disabled = "";
}else{
  $p3_readonly = "readonly";
  $p3_disabled = "disabled";    $p4_disabled = "disabled";
  $p3_ditetapkan = "disabled";    $p4_ditetapkan = "disabled";
}

$title = $kpi_data_id['kpi_kd'];

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

    <center><h3><u>KEY PERFORMANCE INDICATOR</u></h3></center>
    <center style="margin-bottom: 20px;">Nomor Surat&nbsp;&nbsp;<strong><?php echo $kpi_data_id['kpi_kd'];?></strong></center>
    
    <div class="col-xs-9 invoice-col">
      <address>
	<h4><strong><?php echo $kar_data__['kar_nm'];?></strong></h4>
	NIK: <?php echo $kar_data__['kar_nik'];?><br>
	Divisi: <?php echo $kar_data__['div_nm'];?> / <?php echo $kar_data__['jbt_nm'];?><br>
	Type Kerja: <?php echo $kar_data__['kar_dtl_typ_krj'];?><br>
	Kantor: <?php echo $kar_data__['unt_nm'];?> / <?php echo $kar_data__['ktr_nm'];?><br>
	<input type="hidden" name="kpi_div" value="<?php echo $kar_data__['div_nm'];?>">
      </address>
    </div><!-- /.col -->
    
    <div class="col-xs-3 invoice-col">
      <address>
	<h4>&nbsp;</h4>
	Tgl. Penilaian: <strong><?php if($kpi_data_id['kpi_tanggal']!=="0000-00-00"){ echo $tgl->tgl_indo($kpi_data_id['kpi_tanggal']); } else { echo "-"; };?></strong><br>
	<?php if($kar_data__['kar_dtl_typ_krj'] == "Kontrak"){ ?>
	Prd. Kontrak: <strong><?php echo $kpi_data_id['kpi_kontrak'];?></strong><br>
	<?php }?>
	Prd. Penilaian: <strong><?php echo $kpi_data_id['kpi_priode'];?></strong><br>
      </address>
    </div><!-- /.col -->
  </div><!-- /.row -->

  <!-- Table row -->
  <div class="row">
    <div class="col-md-12 table-responsive">
	<table class="table table-striped table-bordered table-condensed" style="font-size: 14px;">
	    <thead>
		<tr>
		    <th rowspan="2" style="vertical-align: middle;text-align: center">NO</th>
		    <th rowspan="2" colspan="2" style="vertical-align: middle;text-align: center">SASARAN</th>
		    <th rowspan="2" style="vertical-align: middle;text-align: center">BOBOT</th>
		    <th rowspan="2" style="vertical-align: middle;text-align: center">TARGET</th>
		    <th colspan="2" style="text-align: center">AKTUAL</th>
		</tr>
		<tr>
		    <th style="text-align: center">PENILAI 1</th>
		    <th style="text-align: center">PENILAI 2</th>
		</tr>
	    </thead>
	      <tbody>
		  <?php
		  $no=1;
		  $exp1 = explode('||',$kpi_data_id['kpi_data']);
		  for($i=0;$i<count($exp1);$i++){
		    $exp2 = explode('@%',$exp1[$i]);

		    $kps_kd = $exp2[1];
		    $kpi_sasaran_kode = $kpi->kpi_sasaran_kode($kps_kd);
		    $kpi_sasaran_data = mysql_fetch_array($kpi_sasaran_kode);
		    
		  ?>
		  <tr>
		      <td><?php echo $no;?></td>
		      <td><?php echo $exp2[0];?></td>
		      <td><?php echo $exp2[2];?></td>
		      <td style="text-align: right"><?php echo $kpi_sasaran_data['kps_bobot'];?></td>
		      <td style="text-align: right"><?php echo $kpi_sasaran_data['kps_target'];?></td>
		      <td style="text-align: right"><?php echo $exp2[4];?></td>
		      <td style="text-align: right"><?php echo $exp2[5];?></td>
		  </tr>
		  <?php $no++; }?>
	      </tbody>
	</table>
    </div><!-- /.col -->
  </div><!-- /.row -->

  <div class="row">
    <!-- accepted payments column -->
    <div class="col-xs-4">
      <strong>Penilai 1 & 2:</strong>
      <br>
      <?php
      $kpi_penilai_=$kpi_data_id['kpi_penilai1'];
      $kpi_tampil_penilai=$kar->kar_tampil_id($kpi_penilai_);
      $kpi_data_penilai=mysql_fetch_array($kpi_tampil_penilai);
      
      $kpi_mengetahui_=$kpi_data_id['kpi_penilai2'];
      $kpi_tampil_mengetahui=$kar->kar_tampil_id($kpi_mengetahui_);
      $kpi_data_mengetahui=mysql_fetch_array($kpi_tampil_mengetahui);
      
      echo $kpi_data_penilai['kar_nm'];
      echo "<br>";
      echo $kpi_data_mengetahui['kar_nm'];
      ?>
      <br><br>
	
      <strong>Penilai 3:</strong>
      <br>
      <?php
      $kpi_mengetahui2_=$kpi_data_id['kpi_penilai3'];
      $kpi_tampil_mengetahui2=$kar->kar_tampil_id($kpi_mengetahui2_);
      $kpi_data_mengetahui2=mysql_fetch_array($kpi_tampil_mengetahui2);
      
      echo $kpi_data_mengetahui2['kar_nm'];
      ?>	  	  <br><br>	      <strong>Penilai 4:</strong>      <br>      <?php      $kpi_mengetahui3_=$kpi_data_id['kpi_penilai4'];      $kpi_tampil_mengetahui3=$kar->kar_tampil_id($kpi_mengetahui3_);      $kpi_data_mengetahui3=mysql_fetch_array($kpi_tampil_mengetahui3);            echo $kpi_data_mengetahui3['kar_nm'];      ?>
      <br>
    </div><!-- /.col -->

    <div class="col-xs-4">
	
	<?php if($kpi_data_id['kpi_jenis']==1){?>
      
      <strong>Merekomendasikan: (PENILAI 2)</strong>
      <div class="table-responsive">
      
		<?php echo "<strong class='text-blue'>".$kpi_data_id['kpi_merekomendasikan5']."</strong>";?>

      </div>
      
      <?php }?>
      
      <strong>Keterangan: (PENILAI 2)</strong>
      <div class="table-responsive">
		<?php echo "<strong class='text-blue'>".$kpi_data_id['kpi_saranperbaikan5']."</strong>";?>
      </div>
	  
	  <br>
      
      <?php if($kpi_data_id['kpi_jenis']==1){?>
      
      <strong>Ditetapkan: (PENILAI 3)</strong>
      <div class="table-responsive">
      
		<?php echo "<strong class='text-blue'>".$kpi_data_id['kpi_ditetapkan']."</strong>";?>

      </div>
      
      <?php }?>
      
      <strong>Keterangan: (PENILAI 3)</strong>
      <div class="table-responsive">
		<?php echo "<strong class='text-blue'>".$kpi_data_id['kpi_saranperbaikan']."</strong>";?>
      </div>	
  	  
	  <br>	  	  
	  <?php if($kpi_data_id['kpi_jenis']==1){?>           
	  <strong>Ditetapkan: (PENILAI 4)</strong>      
	  <div class="table-responsive">      	
	  <?php echo "<strong class='text-blue'>".$kpi_data_id['kpi_ditetapkan4']."</strong>";?>      
	  </div>            
	  <?php }?>           
	  <strong>Keterangan: (PENILAI 4)</strong>      
	  <div class="table-responsive">	
	  <?php echo "<strong class='text-blue'>".$kpi_data_id['kpi_saranperbaikan4']."</strong>";?>      
	  </div>
      
    </div><!-- /.col -->
    
    <div class="col-xs-4">
      <strong>Reward:</strong>
      <br>
	<?php echo "<strong class='text-red'>".$kpi_data_id['kpi_sts_reward']."</strong>";?>
      <br><br>
	
      <strong>Skor:</strong>
	<br>
	<?php
	if(!empty($kpi_data_id['kpi_sts_skor'])){
	  $sts_skor = "(".$kpi_data_id['kpi_sts_skor'].")";
	}else{
	  $sts_skor = "";
	}
	
	echo "<strong class='text-green'>".$kpi_data_id['kpi_skor']." ".$sts_skor."</strong>";
	?>
      <br>
    </div><!-- /.col -->
    
  </div><!-- /.row -->
  <br>
  <!-- info row -->
  <?php if(!empty($kpi_data_id['kpi_lampiran'])){?>
  <div class="row">
    <div class="col-xs-12">
      <strong>Lampiran:</strong>
	<br>
    <?php
      $hascomma = false;
      $exp_lampiran1 = explode(',',$kpi_data_id['kpi_lampiran']);
      for($i=0;$i<count($exp_lampiran1);$i++){
	$exp_lampiran2 = explode('#',$exp_lampiran1[$i]);
	if($hascomma){
	  echo ", ";
	}
	echo "<strong class='text-yellow'>".$exp_lampiran2[0]."</strong>";
	
	$hascomma = true;
      }
    ?>
    </div>
  </div><!-- /.row -->
  <?php }?>
  
  <!-- this row will not appear when printing -->
  
</section><!-- /.content -->
<div class="clearfix"></div>
        
<?php include('component/tag_js.php'); ?>

<?php }else{ echo"<script>document.location='media.php?p=not_found';</script>";}?>