<?php require('module/absen/abs_act.php'); ?>
<!-- Content Header (Page header) -->
<section class="content-header">
  <h1> <?php echo $title;?> 
  <small>
    <?php 
        echo $tgl->tgl_indo($chc_tgl_masuk);
    ?>
  </small> 
  </h1>
  <ol class="breadcrumb">
    <li><a href="media.php"><i class="fa fa-dashboard"></i> Dashboard</a></li>
    <li><a href="?p=history_checkpoint">Data Checkpoint</a></li>
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
           
            <div class="pull-right">
              <form class="form-inline" method="post" action="">
                <div class="form-group">
                  <a href="#"  class="btn btn-md btn-default"><i class="fa fa-print"></i></a>
                </div>
                
                <div class="input-group">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                  <input type="text" name="tanggal_absen_checkpoint" class="form-control pull-right" placeholder="Sortir Absensi" id="dpdays" readonly />
                </div>

                <div class="form-group">
                  <button type="submit" name="bsortir_checkpoint" class="btn btn-md btn-default"><i class="fa fa-eye"></i> View</a></button>
                </div>

                <div class="form-group">
                  <button type="submit" name="brefresh_checkpoint" data-toggle="tooltip"  class="btn btn-md btn-default" title="Kembali ke default <?php echo $tgl->tgl_indo($date); ?>"><i class="fa fa-refresh"></i></button>
                </div>
              </form>
            </div>
          </div>
          <!-- /.box-header -->

          <div class="box-body table-responsive">
            <table id="tb_history_absen" class="table table-bordered table-striped table-hover">
              <thead>
                  <tr>
                    <th rowspan="2">Nama</th>
                    <th colspan="4" class="success">Check Position 1</th>
                    <th colspan="4" class="danger">Check Position 2</th>
                    <th colspan="4" class="info">Check Position 3</th>
                  </tr>
                  <tr>
                    <th class="success">Jam</th>
                    <!--<th class="success">Tgl</th>-->
                    <th class="success">Status</th>
                    <th class="success">RD(km)</th>
                    <th class="success">Aksi</th>
                    <th class="danger">Jam</th>
                    <!--<th class="danger">Tgl</th>-->
                    <th class="danger">Status</th>
                    <th class="danger">RD(km)</th>
                    <th class="danger">Aksi</th>
		    <th class="info">Jam</th>
                    <!--<th class="info">Tgl</th>-->
                    <th class="info">Status</th>
                    <th class="info">RD(km)</th>
                    <th class="info">Aksi</th>
                  </tr>
              </thead>
              <tbody>
                <?php
		  $chc_tampil_tgl=$chc->chc_tampil_tgl($chc_tgl_masuk);
		  while($data=mysql_fetch_array($chc_tampil_tgl)){
		    $kar_id_abs=$data['kar_id'];
		    $kar_tampil_id_abs=$kar->kar_tampil_id($kar_id_abs);
		    $kar_data_abs=mysql_fetch_array($kar_tampil_id_abs);                                                            
                ?>
                <tr>
                    <td><?php echo $kar_data_abs['kar_nm']; ?></td>	               
                    <td class="success"><?php echo $data['jam']; ?></td>
                    <!--<td class="success"><?php //echo $tgl->tgl_indo($data['tanggal']); ?></td>-->
                    <td class="success"><?php echo substr($data['status1'],3); ?></td>
                    <td class="success"><?php echo round($data['radius'],3); ?></td>
                    <td class="success">
		      <?php
		      if($data['checkpoint1'] != '' && $data['status1'] == 'DI LUAR RADIUS'){
		      ?>
		      <a href="?p=detail_maps&id=<?php echo $data['kar_id']; ?>&chc=1" target="_blank" title="Check Map"><span style="cursor:pointer" class="label label-success">Check Map</span></a>
		      <?php }?>
		    </td>
					
                    <td class="danger"><?php echo $data['jam2']; ?></td>
                    <!--<td class="danger"><?php //echo $tgl->tgl_indo($data['tanggal']); ?></td>-->
                    <td class="danger"><?php echo substr($data['status2'],3); ?></td>
                    <td class="danger"><?php echo round($data['radius2'],3); ?></td> 
                    <td class="danger">
		      <?php
		      if($data['checkpoint2'] != '' && $data['status2'] == 'DI LUAR RADIUS'){
		      ?>
		      <a href="?p=detail_maps&id=<?php echo $data['kar_id']; ?>&chc=2" target="_blank" title="Check Map"><span style="cursor:pointer" class="label label-success">Check Map</span></a>
		      <?php }?>
		    </td> 
		    
		    <td class="info"><?php echo $data['jam3']; ?></td>
                    <!--<td class="info"><?php //echo $tgl->tgl_indo($data['tanggal']); ?></td>-->
                    <td class="info"><?php echo substr($data['status3'],3); ?></td>
                    <td class="info"><?php echo round($data['radius3'],3); ?></td>					
                    <td class="info">
		      <?php
		      if($data['checkpoint3'] != '' && $data['status3'] == 'DI LUAR RADIUS'){
		      ?>
		      <a href="?p=detail_maps&id=<?php echo $data['kar_id']; ?>&chc=3" target="_blank" title="Check Map"><span style="cursor:pointer" class="label label-success">Check Map</span></a>
		      <?php }?>
		    </td>					
                  </tr>  
                <?php }?>  
              </tbody>      
              <tfoot>
                  <tr>
                    <th rowspan="2">Nama</th>
                    <th colspan="4" class="success">Check Position 1</th>
                    <th colspan="4" class="danger">Check Position 2</th>
                    <th colspan="4" class="info">Check Position 3</th>                 	
                  </tr>
                  <tr>
                    <th class="success">Jam</th>
                    <!--<th class="success">Tgl</th>-->
                    <th class="success">Status</th>
                    <th class="success">Radius (km)</th>
                    <th class="success">Aksi</th>
                    <th class="danger">Jam</th>
                    <!--<th class="danger">Tgl</th>-->
                    <th class="danger">Status</th>
                    <th class="danger">Radius (km)</th>
                    <th class="danger">Aksi</th>
		    <th class="info">Jam</th>
                    <!--<th class="info">Tgl</th>-->
                    <th class="info">Status</th>
                    <th class="info">Radius (km)</th>
                    <th class="info">Aksi</th>
                  </tr>
              </tfoot>
            </table>
	    <input type="hidden" class="form-control" name="latitude" value="<?php echo $latlongnya1[0];?>">
	    <input type="hidden" class="form-control" name="longitude" value="<?php echo $latlongnya1[1];?>">
	    <input type="hidden" class="form-control" name="max_radius" value="<?php echo $statuscheck1;?>">
          </div>
          <!-- /.box-body --> 
      </div>
      <!-- /.box --> 
    </div>
    <!-- /.col --> 
  </div>
  <!-- /.row --> 
  
  <!-- ===========================DATA KOMULATIF=========================== -->

<!-- Small boxes 1 (Stat box) -->
<div class="row">
  <div class="col-lg-2 col-xs-4">
    <!-- small box -->
    <div class="small-box bg-gray">
      <div class="inner">
        <?php
        $status1="DI LUAR RADIUS";
        $chc_tampil_radius1=$chc->chc_tampil_radius1($status1,$chc_tgl_masuk);
        $chc_cek1=mysql_num_rows($chc_tampil_radius1);
        if($chc_cek1 > 0){
          $modal="modal";
        }else{
          $modal="";
        }
        ?>
        <h3><?php echo $chc_cek1;?></h3>
        <p>Check Posisi 1 </p>
        <p>di Luar Radius </p>
      </div>
      <div class="icon">
        <i class="fa fa-thumbs-o-down"></i>
      </div>
      <a style="cursor:pointer;" data-toggle="<?php echo $modal;?>" data-target="#luar_radius1" class="small-box-footer">
        More info <i class="fa fa-arrow-circle-right"></i>
      </a>
    </div>
  </div><!-- ./col -->
    
  <div class="col-lg-2 col-xs-4">
    <!-- small box -->
    <div class="small-box bg-gray">
      <div class="inner">
        <?php
        $status2="DI LUAR RADIUS";
        $chc_tampil_radius2=$chc->chc_tampil_radius2($status2,$chc_tgl_masuk);
        $chc_cek2=mysql_num_rows($chc_tampil_radius2);
        if($chc_cek2 > 0){
          $modal="modal";
        }else{
          $modal="";
        }
        ?>
        <h3><?php echo $chc_cek2;?></h3>
        <p>Check Posisi 2 </p>
        <p>di Luar Radius </p>
      </div>
      <div class="icon">
        <i class="fa fa-thumbs-o-down"></i>
      </div>
      <a style="cursor:pointer;" data-toggle="<?php echo $modal;?>" data-target="#luar_radius2" class="small-box-footer">
        More info <i class="fa fa-arrow-circle-right"></i>
      </a>
    </div>
  </div><!-- ./col -->
  
    <div class="col-lg-2 col-xs-4">
    <!-- small box -->
    <div class="small-box bg-gray">
      <div class="inner">
        <?php
        $status3="DI LUAR RADIUS";
        $chc_tampil_radius3=$chc->chc_tampil_radius3($status3,$chc_tgl_masuk);
        $chc_cek3=mysql_num_rows($chc_tampil_radius3);
        if($chc_cek3 > 0){
          $modal="modal";
        }else{
          $modal="";
        }
        ?>
        <h3><?php echo $chc_cek3;?></h3>
        <p>Check Posisi 3 </p>
        <p>di Luar Radius </p>
      </div>
      <div class="icon">
        <i class="fa fa-thumbs-o-down"></i>
      </div>
      <a style="cursor:pointer;" data-toggle="<?php echo $modal;?>" data-target="#luar_radius3" class="small-box-footer">
        More info <i class="fa fa-arrow-circle-right"></i>
      </a>
    </div>
  </div><!-- ./col -->


</div><!-- /.row -->
</section>  
  <!-- ===========================MODAL========================= --> 

                
<!-- Modal DI LUAR RADIUS -->
<div class="modal fade" id="luar_radius1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header bg-gray">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel"><i class="fa fa-thumbs-o-down"></i>Check Posisi 1 di Luar Radius </h4>
      </div>
      <form class="form-horizontal" action="" method="post">
      <div class="modal-body" id="rajin_overflow">
          <table class="table table-bordered table-striped table-hover">
            <thead>
              <tr>
                <th>NIK</th>
                <th>Nama</th>
                <th>Divisi</th>
              </tr>
            </thead>
            <tbody>
            <?php
            $status1="DI LUAR RADIUS";
            $chc_tampil_radius1=$chc->chc_tampil_radius1($status1,$abs_tgl_masuk);
            while($chc_datalr1=mysql_fetch_array($chc_tampil_radius1)){

              $kar_id_=$chc_datalr1['kar_id'];
              $kar_tampil_id_=$kar->kar_tampil_id($kar_id_);
              $kar_data_=mysql_fetch_array($kar_tampil_id_);
            ?>
              <tr>
                <td><?php echo $kar_data_['kar_nik']; ?></td>
                <td><?php echo $kar_data_['kar_nm']; ?></td>
                <td><?php echo $kar_data_['div_nm']; ?></td>                     
              </tr>
            <?php }?>   
            </tbody>      
            <tfoot>
              <tr>
                <th>NIK</th>
                <th>Nama</th>
                <th>Divisi</th>
              </tr>
            </tfoot>
          </table>
      </div>
      <div class="modal-footer">
       
      </div>
      </form>
    </div>
  </div>
</div>

<!-- Modal DI DALAM RADIUS -->
<div class="modal fade" id="dalam_radius1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header bg-gray">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel"><i class="fa fa-thumbs-o-up"></i>Check Posisi 1 di Dalam Radius </h4>
      </div>
      <form class="form-horizontal" action="" method="post">
      <div class="modal-body" id="rajin_overflow">
          <table class="table table-bordered table-striped table-hover">
            <thead>
              <tr>
                <th>NIK</th>
                <th>Nama</th>
                <th>Divisi</th>
              </tr>
            </thead>
            <tbody>
            <?php
            $status1="DI DALAM RADIUS";
            $chc_tampil_radius1=$chc->chc_tampil_radius1($status1,$abs_tgl_masuk);
            while($chc_datalr1=mysql_fetch_array($chc_tampil_radius1)){

              $kar_id_=$chc_datalr1['kar_id'];
              $kar_tampil_id_=$kar->kar_tampil_id($kar_id_);
              $kar_data_=mysql_fetch_array($kar_tampil_id_);
            ?>
              <tr>
                <td><?php echo $kar_data_['kar_nik']; ?></td>
                <td><?php echo $kar_data_['kar_nm']; ?></td>
                <td><?php echo $kar_data_['div_nm']; ?></td>                     
              </tr>
            <?php }?>   
            </tbody>      
            <tfoot>
              <tr>
                <th>NIK</th>
                <th>Nama</th>
                <th>Divisi</th>
              </tr>
            </tfoot>
          </table>
      </div>
      <div class="modal-footer">
       
      </div>
      </form>
    </div>
  </div>
</div>

<!-- Modal DI LUAR RADIUS -->
<div class="modal fade" id="luar_radius2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header bg-gray">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel"><i class="fa fa-thumbs-o-down"></i>Check Posisi 2 di Luar Radius </h4>
      </div>
      <form class="form-horizontal" action="" method="post">
      <div class="modal-body" id="rajin_overflow">
          <table class="table table-bordered table-striped table-hover">
            <thead>
              <tr>
                <th>NIK</th>
                <th>Nama</th>
                <th>Divisi</th>
              </tr>
            </thead>
            <tbody>
            <?php
            $status2="DI LUAR RADIUS";
            $chc_tampil_radius2=$chc->chc_tampil_radius2($status2,$abs_tgl_masuk);
            while($chc_datalr1=mysql_fetch_array($chc_tampil_radius2)){

              $kar_id_=$chc_datalr1['kar_id'];
              $kar_tampil_id_=$kar->kar_tampil_id($kar_id_);
              $kar_data_=mysql_fetch_array($kar_tampil_id_);
            ?>
              <tr>
                <td><?php echo $kar_data_['kar_nik']; ?></td>
                <td><?php echo $kar_data_['kar_nm']; ?></td>
                <td><?php echo $kar_data_['div_nm']; ?></td>                     
              </tr>
            <?php }?>   
            </tbody>      
            <tfoot>
              <tr>
                <th>NIK</th>
                <th>Nama</th>
                <th>Divisi</th>
              </tr>
            </tfoot>
          </table>
      </div>
      <div class="modal-footer">
       
      </div>
      </form>
    </div>
  </div>
</div>

<!-- Modal DI DALAM RADIUS -->
<div class="modal fade" id="dalam_radius2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header bg-gray">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel"><i class="fa fa-thumbs-o-up"></i>Check Posisi 2 di Dalam Radius </h4>
      </div>
      <form class="form-horizontal" action="" method="post">
      <div class="modal-body" id="rajin_overflow">
          <table class="table table-bordered table-striped table-hover">
            <thead>
              <tr>
                <th>NIK</th>
                <th>Nama</th>
                <th>Divisi</th>
              </tr>
            </thead>
            <tbody>
            <?php
            $status2="DI DALAM RADIUS";
            $chc_tampil_radius2=$chc->chc_tampil_radius2($status2,$abs_tgl_masuk);
            while($chc_datalr1=mysql_fetch_array($chc_tampil_radius2)){

              $kar_id_=$chc_datalr1['kar_id'];
              $kar_tampil_id_=$kar->kar_tampil_id($kar_id_);
              $kar_data_=mysql_fetch_array($kar_tampil_id_);
            ?>
              <tr>
                <td><?php echo $kar_data_['kar_nik']; ?></td>
                <td><?php echo $kar_data_['kar_nm']; ?></td>
                <td><?php echo $kar_data_['div_nm']; ?></td>                     
              </tr>
            <?php }?>   
            </tbody>      
            <tfoot>
              <tr>
                <th>NIK</th>
                <th>Nama</th>
                <th>Divisi</th>
              </tr>
            </tfoot>
          </table>
      </div>
      <div class="modal-footer">
       
      </div>
      </form>
    </div>
  </div>
</div>

<!-- Modal DI LUAR RADIUS 3 -->
<div class="modal fade" id="luar_radius2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header bg-gray">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel"><i class="fa fa-thumbs-o-down"></i>Check Posisi 3 di Luar Radius </h4>
      </div>
      <form class="form-horizontal" action="" method="post">
      <div class="modal-body" id="rajin_overflow">
          <table class="table table-bordered table-striped table-hover">
            <thead>
              <tr>
                <th>NIK</th>
                <th>Nama</th>
                <th>Divisi</th>
              </tr>
            </thead>
            <tbody>
            <?php
            $status3="DI LUAR RADIUS";
            $chc_tampil_radius3=$chc->chc_tampil_radius3($status3,$abs_tgl_masuk);
            while($chc_datalr1=mysql_fetch_array($chc_tampil_radius3)){

              $kar_id_=$chc_datalr1['kar_id'];
              $kar_tampil_id_=$kar->kar_tampil_id($kar_id_);
              $kar_data_=mysql_fetch_array($kar_tampil_id_);
            ?>
              <tr>
                <td><?php echo $kar_data_['kar_nik']; ?></td>
                <td><?php echo $kar_data_['kar_nm']; ?></td>
                <td><?php echo $kar_data_['div_nm']; ?></td>                     
              </tr>
            <?php }?>   
            </tbody>      
            <tfoot>
              <tr>
                <th>NIK</th>
                <th>Nama</th>
                <th>Divisi</th>
              </tr>
            </tfoot>
          </table>
      </div>
      <div class="modal-footer">
       
      </div>
      </form>
    </div>
  </div>
</div>

