<?php require('module/kpi/kpi_act.php'); ?>
<?php

$p1_readonly = "readonly"; //readonly
$p2_readonly = "readonly"; //readonly
$p3_readonly = "readonly"; //readonly
$p1_disabled = "disabled"; //disabled
$p2_disabled = "disabled"; //disabled
$p3_disabled = "disabled"; //disabled
$p1_ditetapkan = "disabled";
$p1_tanggal = "";

if($kpi_cek_id > 0 && $kar_id==$kpi_data_id['kpi_penilai1']){
  
if($kpi_data_id['kpi_sts']=='X'){
  $p1_readonly = "";
  $p1_disabled = "";
}else{
  $p1_readonly = "disabled";
  $p1_disabled = "disabled";
  $p1_tanggal = "readonly";
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
  <section class="invoice col-md-7">
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
      
      <center><h3><u>KEY PERFORMANCE INDICATOR</u></h3></center>
      <center style="margin-bottom: 20px;">Nomor Surat&nbsp;&nbsp;<strong><?php echo $kpi_data_id['kpi_kd'];?></strong></center>
      
      <div class="col-sm-9 invoice-col">
	<address>
	  <h4><strong><?php echo $kar_data_['kar_nm'];?></strong></h4>
	  NIK: <?php echo $kar_data_['kar_nik'];?><br>
	  Divisi: <?php echo $kar_data_['div_nm'];?> / <?php echo $kar_data_['jbt_nm'];?><br>
	  Type Kerja: <?php echo $kar_data_['kar_dtl_typ_krj'];?><br>
	  Kantor: <?php echo $kar_data_['unt_nm'];?> / <?php echo $kar_data_['ktr_nm'];?><br>
	  <input type="hidden" name="kpi_div" value="<?php echo $kar_data_['div_nm'];?>">
	</address>
      </div><!-- /.col -->
      
      <div class="col-sm-3 invoice-col">
	<address>
	  <div class="form-group">
	    <label for="kpi_kontrak" class="col-md-12 control-label">Tgl. Penilaian</label>
	    <div class="col-md-12">
	      <input type="text" name="kpi_tanggal" class="form-control" id="kpi_tanggal" value="<?php echo $kpi_data_id['kpi_tanggal'];?>" placeholder="Tanggal Penilaian" data-inputmask="'alias': 'yyyy-mm-dd'" data-mask style="width:182;" required <?php echo $p1_tanggal;?>>
	    </div>
	  </div>
	  <?php if($kar_data_['kar_dtl_typ_krj'] == "Kontrak"){ ?>
	  Prd. Kontrak: <strong><?php echo $kpi_data_id['kpi_kontrak'];?></strong><br>
	  <?php }?>
	  Prd. Penilaian: <strong><?php echo $kpi_data_id['kpi_priode'];?></strong><br>
	</address>
      </div><!-- /.col -->
    </div><!-- /.row -->

    <!-- Table row -->
    <div class="row">
      <div class="col-md-12 table-responsive">
	<input type="hidden" id="kar_nik" value="<?php echo $kar_data_['kar_nik']; ?>">
	  <table class="table table-striped table-bordered table-condensed">
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
		    $no=1; $totskor=0; $skor1=0; $skor2=0; $akuskor=0; $skorakhr=0;
		    $exp1 = explode('||',$kpi_data_id['kpi_data']);
		    for($i=0;$i<count($exp1);$i++){
		      $exp2 = explode('@%',$exp1[$i]);

		      $kps_kd = $exp2[1];
		      $kpi_sasaran_kode = $kpi->kpi_sasaran_kode($kps_kd);
		      $kpi_sasaran_data = mysql_fetch_array($kpi_sasaran_kode);
		      
		      $bdc_cek = strpos($kps_kd,'_BDC');
		      $sipema_cek = strpos($kps_kd,'_SIPEMA');
		      
		      $btn_action = '<input type="hidden" name="data_nama['.$no.']" class="form-control pull-right"  value="'.$kpi_sasaran_data['kps_nama'].'" readonly>';
		      $btn_action .= '<input type="hidden" name="data_kd['.$no.']" class="form-control pull-right"  value="'.$kpi_sasaran_data['kps_kd'].'" readonly>';
		      
		      if($bdc_cek !== false) {
			  $btn_action .= '<input type="hidden" name="date_range['.$no.']" class="form-control form-inline pull-right" value="'.$exp2[2].'" readonly><span>'.$exp2[2].'</span>
					 <input type="hidden" name="data_detail['.$no.']" class="form-control pull-right"  value="'.$exp2[3].'" readonly>';
		      }elseif($sipema_cek !== false){
			  $btn_action .= '<input type="hidden" name="date_range['.$no.']" class="form-control pull-right"  value="'.$exp2[2].'" readonly><span>'.$exp2[2].'</span>
					 <input type="hidden" name="data_detail['.$no.']" class="form-control pull-right"  value="'.$exp2[3].'" readonly>
					 <input type="hidden" name="data_reward" class="form-control pull-right"  value="'.$kpi_data_id['kpi_reward'].'" readonly>
					 <input type="hidden" name="data_reward_detail" class="form-control pull-right"  value="'.$kpi_data_id['kpi_reward_data'].'" readonly>';
		      }else{
			  $btn_action .= '<input type="hidden" name="date_range['.$no.']" class="form-control pull-right"  value="" readonly>
					 <input type="hidden" name="data_detail['.$no.']" class="form-control pull-right"  value="" readonly>';
		      }
		      
		      if($kpi_sasaran_data['kps_jenis']=='1'){
			  if($bdc_cek !== false) {
			    $kps_aktual1 = '<input type="hidden" class="form-control" name="kpi_data1['.$no.']" id="bdc1-val" value="'.$exp2[4].'" style="width:60px;"><span>'.$exp2[4].'</span>';
			    $kps_aktual2 = '<input type="hidden" class="form-control" name="kpi_data2['.$no.']" id="bdc2-val" value="'.$exp2[5].'" style="width:60px;"><span>'.$exp2[5].'</span>';
			  }elseif($sipema_cek !== false){
			    $kps_aktual1 = '<input type="hidden" class="form-control" name="kpi_data1['.$no.']" id="sipema1-val" value="'.$exp2[4].'" style="width:60px;"><span>'.$exp2[4].'</span>';
			    $kps_aktual2 = '<input type="hidden" class="form-control" name="kpi_data2['.$no.']" id="sipema2-val" value="'.$exp2[5].'" style="width:60px;"><span>'.$exp2[5].'</span>';
			  }else{
			    $kps_aktual1 = '<input type="text" class="form-control" name="kpi_data1['.$no.']" value="'.$exp2[4].'" style="width:60px;">';
			    $kps_aktual2 = '<input type="text" class="form-control" name="kpi_data2['.$no.']" value="'.$exp2[5].'" style="width:60px;">';
			  }
			}elseif($kpi_sasaran_data['kps_jenis']=='2'){
			    $kps_aktual1 = '<input type="text" class="form-control" name="kpi_data1['.$no.']" value="'.$exp2[4].'" style="width:60px;" data-max="'.$kpi_sasaran_data['kps_target'].'" onkeyup="cekMax(this)" required '.$p1_readonly.'>';
			    $kps_aktual2 = '<input type="text" class="form-control" name="kpi_data2['.$no.']" value="'.$exp2[5].'" style="width:60px;" data-max="'.$kpi_sasaran_data['kps_target'].'" onkeyup="cekMax(this)" '.$p2_readonly.'>';
			}elseif($kpi_sasaran_data['kps_jenis']=='3'){
			    
			    $kps_aktual1 = '<select class="form-control" name="kpi_data1['.$no.']" style="width:60px;" required '.$p1_disabled.'>';
			    $kps_aktual1 .= '<option value="" selected></option>';
			    $kpb_jenis = $kpi_sasaran_data['kps_point'];
			    $kpi_point_jenis = $kpi->kpi_point_jenis($kpb_jenis);
			    while($kpi_point_data=mysql_fetch_array($kpi_point_jenis)){
			      if($kpi_point_data['kpb_nilai'] == $exp2[4]){
				$selected = "selected";
			      }else{
				$selected = "";
			      }
			      $kps_aktual1 .= '<option value="'.$kpi_point_data['kpb_nilai'].'" '.$selected.'>'.$kpi_point_data['kpb_kd'].'</option>';
			    }
			    $kps_aktual1 .= '</select>';

			    $kps_aktual2 = '<select class="form-control" style="width:60px;" '.$p2_disabled.'>';
			    $kps_aktual2 .= '<option value="" selected></option>';
			    $kpi_point_jenis = $kpi->kpi_point_jenis($kpb_jenis);
			    while($kpi_point_data=mysql_fetch_array($kpi_point_jenis)){
			      $kps_aktual2 .= '<option value="'.$kpi_point_data['kpb_nilai'].'">'.$kpi_point_data['kpb_kd'].'</option>';
			    }
			    $kps_aktual2 .= '</select>';
			    $kps_aktual2 .= '<input type="hidden" class="form-control" name="kpi_data2['.$no.']" value="'.$exp2[5].'" style="width:60px;" readonly>';
			    
			}else{
			    $kps_aktual1 = '';
			    $kps_aktual2 = '';
			}
			
			
			$skor1 = ($exp2[4]/$kpi_sasaran_data['kps_target'])*100;
			$skor2 = ($exp2[5]/$kpi_sasaran_data['kps_target'])*100;
			$akuskor = ($skor1+$skor2)/2;
			$skorakhr = ($akuskor*$kpi_sasaran_data['kps_bobot'])/100;
			
			$totskor = $totskor + $skorakhr;
		      
		    ?>
		    <tr>
			<td><?php echo $no;?></td>
			<td><?php echo $exp2[0];?></td>
			<td><?php echo $btn_action;?></td>
			<td style="text-align: right"><?php echo $kpi_sasaran_data['kps_bobot'];?></td>
			<td style="text-align: right"><?php echo $kpi_sasaran_data['kps_target'];?></td>
			<td style="text-align: right"><?php echo $kps_aktual1;?></td>
			<td style="text-align: right"><?php echo $kps_aktual2;?></td>
		    </tr>
		    <?php $no++; }?>
		</tbody>
	  </table>
      </div><!-- /.col -->
    </div><!-- /.row -->

    <div class="row">
      <!-- accepted payments column -->
      <div class="col-md-4">
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
	?>
	<br>
      </div><!-- /.col -->

      <div class="col-md-4">
	
	<?php if($kpi_data_id['kpi_jenis']==1){?>
	
	<strong>Ditetapkan: (PENILAI 3)</strong>
	<div class="table-responsive">
	
		<?php
		  if($kpi_data_id['kpi_kontrak']=="0 (None)"){
		    $huruf=array(
				  "Pemutusan Kerja" => 'Pemutusan Kerja',
				  "Mutasi" => 'Mutasi',				  				  "Pembinaan" => 'Pembinaan',
				  "..." => '...'
				);
		  }else{
		    $huruf=array(
				  "Di perpanjang" => 'Di perpanjang',
				  "Tidak di perpanjang" => 'Tidak di perpanjang',
				  "Karyawan Tetap" => 'Karyawan Tetap',
				  "Mutasi" => 'Mutasi',
				  "..." => '...'
				);
		  }
		  
		  foreach($huruf as $value => $caption) {
		    
			      if($kpi_data_id['kpi_ditetapkan']==$value){
		?>
		<input type="radio" name="kpi_ditetapkan" value="<?php echo $value;?>" class="flat-red" id="kpi_ditetapkan" checked <?php echo $p1_ditetapkan;?>/> <?php echo $caption;?><br>
		<?php }else{?>
		<input type="radio" name="kpi_ditetapkan" value="<?php echo $value;?>" class="flat-red" id="kpi_ditetapkan" <?php echo $p1_ditetapkan;?>/> <?php echo $caption;?><br>
		<?php }}?> 

	</div>
	
	<?php }?>

	<div class="table-responsive">
	  <?php
	  if($kpi_data_id['kpi_ditetapkan']=="..."){
	  ?>
	  <textarea name="kpi_saranperbaikan" class="form-control" <?php echo $p1_ditetapkan;?> ><?php echo $kpi_data_id['kpi_saranperbaikan'];?></textarea>
	  <?php }?>
	</div>
	
      </div><!-- /.col -->
      
      <div class="col-md-4">
	<strong>Reward:</strong>
	<br>
	  <?php
	  if($kpi_data_id['kpi_reward'] >= 40){
	    echo "<strong class='text-green'>(".$kpi_data_id['kpi_reward'].") GET REWARD</strong>";
	  }else{
	    echo "<strong class='text-red'>(".$kpi_data_id['kpi_reward'].") NO REWARD</strong>";
	  }
	  ?>
	<br><br>
	  
	<strong>Skor:</strong>
	  <br>
	  <?php
	  if($totskor>0){
	    if(!empty($kpi_data_id['kpi_sts_skor'])){
	      $sts_skor = "(".$kpi_data_id['kpi_sts_skor'].")";
	    }else{
	      $sts_skor = "";
	    }
	    
	    echo "<strong class='text-blue'>".round($totskor, 2)." ".$sts_skor."</strong>";
	  }else{
	    echo "-";
	  }
	  ?>
	<br>
      </div><!-- /.col -->
      
    </div><!-- /.row -->
    <br>
    <!-- info row -->
    <?php if(!empty($kpi_data_id['kpi_lampiran'])){?>
    <div class="row">
      <div class="col-md-12">
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
	  echo "<a href='".$exp_lampiran2[1]."' target='_blank'><span class='label label-warning'><i class='fa fa-file-o'></i> ".$exp_lampiran2[0]."</span></a>";
	  
	  $hascomma = true;
	}
      ?>
      </div>
    </div><!-- /.row -->
    <?php }?>
    
    <!-- this row will not appear when printing -->
    
    <br>
    <div class="row no-print">
      <div class="col-md-12">
	<button name="bsendupdate1" class="btn btn-success pull-right <?php echo $p1_disabled;?>"><i class="fa fa fa-send"></i> Simpan & Kirim</button>
      </div>
    </div>
    
  </section><!-- /.content -->
  <div class="clearfix"></div>
</form>      
<!--
    </div>
    </div>    -->
<?php }else{ echo"<script>document.location='?p=not_found';</script>";}?>