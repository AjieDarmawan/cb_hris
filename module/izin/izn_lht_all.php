<?php require('module/izin/izn_act2.php'); ?>
<!-- Content Header (Page header) -->
<section class="content-header">
  <h1> <?php echo $title;?> 
  <small>
    <?php 
        echo $tgl->tgl_indo($izn_kirim);
    ?>
  </small> 
  </h1>
  <ol class="breadcrumb">
    <li><a href="media.php"><i class="fa fa-dashboard"></i> Dashboard</a></li>
    <li><a href="?p=history_izin">Data Izin</a></li>
    <li class="active"><?php echo $title;?> </li>
  </ol>
</section>
    
<!-- Main content -->
<section class="content"> 
  
  <!-- Your Page Content Here -->                 
  <div class="row">
    <div class="col-xs-12">
      <div class="box">
          <div class="box-header">
            <h3 class="box-title">
              
            </h3>
            <div class="pull-right">
              <form class="form-inline" method="post" action="">
                <div class="form-group">
                  <a href="#"  class="btn btn-md btn-default"><i class="fa fa-print"></i></a>
                </div>
                
                <div class="input-group">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                  <input type="text" name="tanggal_absen_history" class="form-control pull-right" placeholder="Sortir Izin" id="dpdays" readonly />
                </div>

                <div class="form-group">
                  <button type="submit" name="bsortir_history" class="btn btn-md btn-default"><i class="fa fa-eye"></i> View</a></button>
                </div>

                <div class="form-group">
                  <button type="submit" name="brefresh_history" data-toggle="tooltip"  class="btn btn-md btn-default" title="Kembali ke default <?php echo $tgl->tgl_indo($date); ?>"><i class="fa fa-refresh"></i></button>
                </div>
              </form>
            </div>
          </div>
          <!-- /.box-header -->

          <div class="box-body">
            <table id="tb_history_izin" class="table table-bordered table-striped table-hover">
              <thead>
                 <tr>
                    <th rowspan="2">Nama</th>
	                <th rowspan="2">Nomor</th>
                    <th colspan="3" class="success">Waktu</th>
                    <th rowspan="2">Alasan</th>
					<th rowspan="2">Tanggal</th>
					<th rowspan="2">Status</th>
                  </tr>
                  <tr>
                    <th class="success">Waktu awal</th>
                    <th class="success">Waktu akhir</th>
                    <th class="success">Durasi</th>                  
                  </tr>
              </thead>
              <tbody>
                <?php
                    $izn_tampil_tanggal=$izn->izn_tampil_tanggal($izn_kirim);
                    while($data=mysql_fetch_array($izn_tampil_tanggal)){
		             if($data['izn_sts'] == "X"){
						  $label_sts = "Belum diizinkan";
					  }elseif($data['izn_sts'] == "Y"){
						  $label_sts = "diizinkan";
					  }elseif($data['izn_sts'] == "T"){
						   $label_sts = "Tidak diizinkan";
					  }                             
                ?>
					<tr>
                    <td><?php echo $data['kar_nm']; ?></td>
	                <td><?php echo $data['izn_kd']; ?></td>
                    <td class="success">
					  <?php echo $data['izn_waktu1']; ?>			  
					</td>
					<td class="success">
					  <?php echo $data['izn_waktu2']; ?>			  
					</td>
					<td class="success">
					  <?php echo $data['izn_durasi']; ?>			  
					</td>
					 <td class="danger"> <?php echo $data['izn_jenis']; ?>&nbsp;<?php echo $data['izn_keterangan']; ?></td> 
                    <td class="success"><?php echo $tgl->tgl_indo($data['izn_kirim']); ?></td>                 
                    <td class="success"><?php echo $label_sts; ?></td>                 
                  </tr>  

                <?php }?>  
              </tbody>      
            </table>
          </div>
          <!-- /.box-body --> 
      </div>
      <!-- /.box --> 
    </div>
    <!-- /.col --> 
  </div>
  <!-- /.row --> 
  </section>

