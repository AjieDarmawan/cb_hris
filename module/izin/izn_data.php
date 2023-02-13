<?php require('module/izin/izn_act.php'); ?>
<?php //echo $_GET['id']; ?>
<!-- Content Header (Page header) -->
<section class="content-header">
  <h1> <?php echo $title;?> <small></small> </h1>
  <ol class="breadcrumb">
    <li><a href="media.php"><i class="fa fa-dashboard"></i> Dashboard</a></li>
    <li class="active"><?php echo $title;?></li>
  </ol>
</section>

<!-- Main content -->
<section class="content"> 
  <!-- Your Page Content Here -->
  <div class="row">
    <div class="col-md-12">     
      <div class="box box-danger">
	<div class="box-header">
	  <h3 class="box-title">Form Izin </h3>
	      <!-- tools box -->
	      <div class="pull-right box-tools">
		<?php if(!empty($_GET['id'])){ ?>
		<button style="cursor:pointer" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#md_izin"><i class="fa fa-plus"></i></button>
		<?php }?>
		<button class="btn btn-info btn-sm" data-widget='collapse' data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
		<button class="btn btn-info btn-sm" data-widget='remove' data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
	      </div><!-- /. tools -->
	</div>

	<!-- /.box-header -->
	<div class="box-body table-responsive">
	  <table id="tb_absen" class="table table-bordered table-striped table-hover">
	    <thead>
	      <tr>
		<th>Nama</th>
		<th>Nomor</th>
		<th>Durasi</th>
		<th>Alasan</th>
		<th>Tanggal</th>
		<th>Status</th>
		<th>Aksi</th>
	      </tr>
	    </thead>
	    <tbody>
			 <?php
			if(!empty($_GET['id'])){
			  
			  $kar_id_=$_GET['id'];      
			  $izn_tampil_kar=$izn->izn_tampil_kar($kar_id_);
			  while($izn_data_kar=mysql_fetch_array($izn_tampil_kar)){ 
			  if($izn_data_kar['izn_sts'] == "X"){
				  $label_sts = "Belum diizinkan";
			  }elseif($izn_data_kar['izn_sts'] == "Y"){
				  $label_sts = "diizinkan";
			  }elseif($izn_data_kar['izn_sts'] == "T"){
				   $label_sts = "Tidak diizinkan";
			  }
			?>
	      <tr>
		<td><?php echo $izn_data_kar['kar_nm'];?></td>
		<td><?php echo $izn_data_kar['izn_kd'];?></td>
		<td><?php echo $izn_data_kar['izn_durasi']; ?></td>
		<td>
		<?php
			if($izn_data_kar['izn_jenis'] == ""){
				echo $izn_data_kar['izn_keterangan'];
			}elseif($izn_data_kar['izn_keterangan'] == ""){
				echo $izn_data_kar['izn_jenis'];
			}else{
				echo $izn_data_kar['izn_keterangan']." ".$izn_data_kar['izn_jenis'];
			}
		?>		
		</td>
		<td><?php echo $tgl->tgl_indo($izn_data_kar['izn_kirim']);?></td>
		<td><?php echo $label_sts; ?></td>
		<td>
		  <a href="?p=berkas_izin_lihat&act=open&id=<?php echo md5($izn_data_kar['izn_kd']); ?>"><span style="cursor:pointer" class="label label-primary"><i class="fa fa-ellipsis-h"></i></span></a>
		</td>
	      </tr>
		<?php }}?>
	    </tbody>      
	    <tfoot>
	      <tr>
		<th>Nama</th>
		<th>Nomor</th>
		<th>Durasi</th>
		<th>Alasan</th>
		<th>Tanggal</th>
		<th>Status</th>
		<th>Aksi</th>
	      </tr>
	    </tfoot>
	  </table>
	</div>
	<!-- /.box-body -->
      </div>
      <!-- /.box -->
    </div>
    <!-- /.col -->
  </div>
  <!-- /.row -->
  
  <style type="text/css">
  #loading{
    text-align: center;
    display: none;
    position: fixed;
    background-color: rgba(0, 0, 0, 0.3);
    z-index: 1000;
    left: 0;
    top: 0;
    height: 100%;
    width: 100%;
    padding-top:10%;
  }
  #output{
    font-size: 10px;
  }
  
  .loader {
    margin: auto 0;
    border: 3px solid #f3f3f3;
    border-radius: 50%;
    border-top: 3px solid #157ebf;
    width: 20px;
    height: 20px;
    -webkit-animation: spin 1s linear infinite;
    animation: spin 1s linear infinite;
  }
  
  @-webkit-keyframes spin {
    0% { -webkit-transform: rotate(0deg); }
    100% { -webkit-transform: rotate(360deg); }
  }
  
  @keyframes spin {
    0% { transform: rotate(0deg); }
    100% { transform: rotate(360deg); }
  }

  </style>
  
  <div id="loading"><img src="dist/img/loadingnew3.gif" /></div>
  
</section>
<!-- /.content --> 



<?php
if(!empty($_GET['id'])){
?>

<!-- Modal KPI-->
<div class="modal fade" id="md_izin" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header bg-primary">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel"><i class="fa fa-bar-chart"></i> Form Izin Meninggalkan Kantor</h4>
      </div>
      <form class="form-horizontal" action="" method="post">
      <div class="modal-body">
	<!-- Main content -->
        <section class="invoice">
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
	    
	    <center><h3><u>FORMULIR IZIN MENINGGALKAN KANTOR</u></h3></center>
	    <center style="margin-bottom: 20px;">Nomor Surat&nbsp;&nbsp;<strong><?php echo $new_kd;?></strong></center>
	    
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
			  <label for="kpi_kontrak" class="col-md-12 col-md-6 control-label">Tgl. Izin</label>
			  <div class="col-md-12 col-md-6">
				<input type="text" name="izn_tanggal" class="form-control" id="izn_tanggal" placeholder="Tanggal Izin" data-inputmask="'alias': 'yyyy-mm-dd'" data-mask style="width:182;">
			  </div>
			</div>
            </div>
			-->
          </div><!-- /.row -->

          <!-- Table row -->
          <div class="row">
            <div class="col-md-8">
	        <input type="hidden" id="kar_nik" value="<?php echo $kar_data_['kar_nik']; ?>">	
				<div class="form-group">
				  <label for="kpi_kontrak" class="col-md-12 col-md-6 control-label">Tanggal Izin</label>
				  <div class="col-md-12 col-md-6">
					<input type="text" name="izn_tanggal" class="form-control" id="izn_tanggal" placeholder="Tanggal Izin" data-inputmask="'alias': 'yyyy-mm-dd'" data-mask style="width:182;">
				  </div>
				</div>
				<div class="form-group">
				  <label for="izn" class="col-md-12 col-md-6 control-label">Waktu Jam</label>
				  <div class="col-md-12 col-md-6 bootstrap-timepicker">
					Jam Menit <input name="izn_waktu1" type="text"  data-default-time="00:00:00" class="form-control timepicker">  s/d
					Jam Menit <input name="izn_waktu2" type="text"  data-default-time="00:00:00" class="form-control timepicker">
				  </div>
				</div>
				<!--
				<div class="form-group" style="display:none;">
				  <label for="izn" class="col-md-12 col-md-6 control-label">Durasi</label>
				  <div class="col-md-12 col-md-6">
					<input type="hidden" name="izn_durasi" class="form-control" id="izn_durasi"  placeholder="Durasi"  data-mask style="width:182;">
				  </div>
				</div>
				-->
				<div class="form-group">
				  <label for="izn" class="col-md-12 col-md-6 control-label">Alasan</label>
				  <div class="col-md-12 col-md-6">
					<input type="checkbox" name="izn_jenis" class="minimal-red" value="Sakit"> &nbsp;<strong>Sakit</strong><br>
					<input type="checkbox" name="izn_jenis" class="minimal-red" value="Sebar Brosur"> &nbsp;<strong>Sebar Brosur</strong><br>
					<input type="checkbox" name="izn_jenis" class="minimal-red" value="Kunjungan Marketing"> &nbsp;<strong>Kunjungan Marketing</strong><br>
					<input type="checkbox" name="izn_jenis" class="minimal-red" value="Keluarga Inti Sakit"> &nbsp;<strong>Keluarga Inti Sakit</strong><br>
					<input type="checkbox" name="izn_jenis" class="minimal-red" value="Keluarga Inti Meninggal"> &nbsp;<strong>Keluarga Inti Meninggal</strong><br>
				  </div>
				</div>
				<div class="form-group">
				  <label for="izn" class="col-md-12 col-md-6 control-label">Alasan Lain</label>
				  <div class="col-md-12 col-md-6">
					<textarea type="textarea" name="izn_keterangan" class="minimal-red" > </textarea>
					
				  </div>
				</div>
            </div><!-- /.col -->
          </div><!-- /.row -->
<hr>
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
			<div class="bfh-selectbox" data-name="izn_atasan" data-value="" data-filter="true">
                    <div data-value=""></div>
                    <?php
						// if($kar_data_['div_id'] == 8){
							// $div_id = 8;
							// $lvl_id = 4;
						// }elseif($kar_data_['div_id'] == 4){
							// $div_id = 3;
							// $lvl_id = 3;
						// }elseif($kar_data_['div_id'] == 3){
							// $div_id = 3;
							// $lvl_id = 3;
						// }elseif($kar_data_['div_id'] == 5){
							// $div_id = 3;
							// $lvl_id = 3;
						// }elseif($kar_data_['div_id'] == 6){
							// $div_id = 12;
							// $lvl_id = 4;
						// }
						
						$izn_atasan = $izn->izn_atasan();
                        if($izn_atasan){
                        foreach($izn_atasan as $data){  
						// if($team_penilai23){
                        // foreach($team_penilai23 as $data){
                    ?>
                    <div data-value="<?php echo $data['kar_id'];?>"><?php echo $data['kar_nik'];?> - <?php echo $data['kar_nm'];?></div>
                    <?php }}?>    
	        </div>
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
        </section><!-- /.content -->


      </div>
      <div class="modal-footer">
        <button type="submit" name="bsave" class="btn btn-primary"><i class="fa fa-save"></i> Simpan & Kirim</button>
      </div>
      </form>
    </div>
  </div>
</div>

<?php
}
?>