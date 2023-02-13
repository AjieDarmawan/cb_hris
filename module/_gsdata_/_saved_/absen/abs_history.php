<?php require('module/absen/abs_act.php'); ?>
<!-- Content Header (Page header) -->
<section class="content-header">
  <h1> <?php echo $title;?> 
  <small>
    <?php 
        echo $tgl->tgl_indo($abs_tgl_masuk);
    ?>
  </small> 
  </h1>
  <ol class="breadcrumb">
    <li><a href="media.php"><i class="fa fa-dashboard"></i> Dashboard</a></li>
    <li><a href="?p=history_absen">Data Absen</a></li>
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
              <button class="btn btn-md btn-primary" data-toggle="modal" data-target="#masukmanual" ><i class="fa fa-sign-in"></i> Manual Absen Masuk</button> &nbsp;
              <i class="fa fa-child"></i> &nbsp;
              <button class="btn btn-md btn-danger" data-toggle="modal" data-target="#pulangmanual" ><i class="fa fa-sign-out"></i> Manual Absen Pulang</button> &nbsp;
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
                  <input type="text" name="tanggal_absen_history" class="form-control pull-right" placeholder="Sortir Absensi" id="dpdays" readonly />
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
            <table id="tb_history_absen" class="table table-bordered table-striped table-hover">
              <thead>
                <tr>
                    <th rowspan="2">Nama</th>
	                  <th rowspan="2">Shift</th>
                    <th colspan="4" class="success">Masuk</th>
                    <th colspan="4" class="danger">Pulang</th>
                    <th colspan="2">IP</th>
                    <!--<th rowspan="2">Lokasi</th>-->
                  	<th rowspan="2">Durasi Kerja</th>
                  	<th rowspan="2">Point</th>
                    <th rowspan="2">Status</th>
                  </tr>
                  <tr>
                    <th class="success">Waktu</th>
                    <th class="success">Tgl</th>
                    <th class="success">Reward</th>
                    <th class="success">Alasan</th>
                    <th class="danger">Waktu</th>
                    <th class="danger">Tgl</th>
                    <th class="danger">Reward</th>
                    <th class="danger">Alasan</th>
                    <th>IP Pusat</th>
                    <th>IP Lain</th>
                  </tr>
              </thead>
              <tbody>
                <?php
                    $abs_tampil_tgl=$abs->abs_tampil_tgl($abs_tgl_masuk);
                    while($data=mysql_fetch_array($abs_tampil_tgl)){

                    $kar_id_abs=$data['kar_id'];
                    $kar_tampil_id_abs=$kar->kar_tampil_id($kar_id_abs);
                    $kar_data_abs=mysql_fetch_array($kar_tampil_id_abs);
                    
                    $unt_id=$kar_data_abs['unt_id'];
                    $ktr_id=$kar_data_abs['ktr_id'];
                        
                        $ip_tampil_unt_ktr=$ip->ip_tampil_unt_ktr($unt_id,$ktr_id);
                        $ip_data=mysql_fetch_array($ip_tampil_unt_ktr);
                    
                        if($data['abs_sts']=="P"){
                          $pulang=$data['abs_pulang'];
                          $tgl_pulang=$tgl->tgl_indo($data['abs_tgl_pulang']);

                          $start_date = new DateTime(''.$data[abs_tgl_masuk].' '.$data[abs_masuk].'');
                            $since_start = $start_date->diff(new DateTime(''.$data[abs_tgl_pulang].' '.$data[abs_pulang].''));
                          $durasi_kerja = $since_start->h." Jam, ".$since_start->i." Menit ";
                        }else{
                          $pulang="-";
                          $tgl_pulang="-";
                          $durasi_kerja ="-";
                        }
                      
                        if($data['abs_rwd_masuk']=="Telat"){
                          $lbl_masuk="danger";
                        }elseif($data['abs_rwd_masuk']=="Rajin"){
                          $lbl_masuk="success";
                        }elseif($data['abs_rwd_masuk']=="Tepat"){
                          $lbl_masuk="primary";
                        }
                      
                        if($data['abs_rwd_pulang']=="Izin"){
                          $lbl_pulang="danger";
                        }elseif($data['abs_rwd_pulang']=="Loyal"){
                          $lbl_pulang="success";
                        }elseif($data['abs_rwd_pulang']=="Tepat"){
                          $lbl_pulang="primary";
                        }
	    
                  	    if($ip_data['ip_nm']==$data['abs_ip']){
                  	      $konfirm="<span class='label label-default'>Success</span>";
                  	    }else{
                  	      $konfirm="<a href='?p=history_absen&id=$data[abs_id]&ip=$ip_data[ip_nm]'><span class='label label-primary'>Konfirm</span></a>";
                  	    }
                  	    
                  	    if($data['abs_point']=="30"){
                  	      $point="<a data-placement='top' data-toggle='tooltip' title='Klik untuk merubah point menjadi (50) jika alasan keterlambatan dapat diterima secara jelas' href='?p=history_absen&id=$data[abs_id]&point=50'>$data[abs_point]</a>";
                  	    }else{
                  	      $point="$data[abs_point]";
                  	    }
                                        
                ?>
                <tr>
                    <td><?php echo $kar_data_abs['kar_nm']; ?></td>
	                  <td><span class="label label-default"><?php echo str_replace('Shift','',$data['abs_shift']); ?></span></td>
                    <td class="success"><?php echo $data['abs_masuk']; ?></td>
                    <td class="success"><?php echo $tgl->tgl_indo($data['abs_tgl_masuk']); ?></td>
                    <td class="success"><span class="label label-<?php echo $lbl_masuk; ?>"><?php echo $data['abs_rwd_masuk']; ?></span></td>
                    <td class="success"><span data-toggle="tooltip" title="<?php echo $data['abs_alasan_masuk']; ?>" style="cursor:pointer">... <i class="fa fa-external-link"></i></span></td>
                    <td class="danger"><?php echo $pulang; ?></td>
                    <td class="danger"><?php echo $tgl_pulang; ?></td>
                    <?php
                    if($data[abs_sts]=="P"){
                    ?>
                    <td class="danger"><span class="label label-<?php echo $lbl_pulang; ?>"><?php echo $data['abs_rwd_pulang']; ?></td>
                    <td class="danger"><span data-toggle="tooltip" title="<?php echo $data['abs_alasan_pulang']; ?>" style="cursor:pointer">... <i class="fa fa-external-link"></i></span></td>
                    <?php
                    }else{
                    ?>
                    <td class="danger">-</td><td class="danger">-</td>
                    <?php }?>
                    <td><?php echo $ip_data['ip_nm']; ?><br><a data-placement="right" data-toggle="tooltip" title="<?php echo $kar_data_abs['ktr_nm']; ?>" style="cursor:pointer"><?php echo $kar_data_abs['ktr_kd']; ?></a></td>
                    <td><?php echo $data['abs_ip']; ?></td>
                    <!--<td><a data-toggle="tooltip" title="<?php //echo $kar_data_abs['ktr_nm']; ?>" style="cursor:pointer"><?php //echo $kar_data_abs['ktr_kd']; ?></a></td>-->
                    <td><?php echo $durasi_kerja; ?></td>
                  	<td><?php echo $point; ?></td>
                  	<td><?php echo $konfirm; ?></td>
                  </tr>  

                <?php }?>  
              </tbody>      
              <tfoot>
                  <tr>
	                  <th rowspan="2">Shift</th>
                    <th rowspan="2">Nama</th>
                    <th class="success">Waktu</th>
                    <th class="success">Tgl</th>
                    <th class="success">Reward</th>
                    <th class="success">Alasan</th>
                    <th class="danger">Waktu</th>
                    <th class="danger">Tgl</th>
                    <th class="danger">Reward</th>
                    <th class="danger">Alasan</th>
                    <th>IP Pusat</th>
                    <th>IP Lain</th>
                    <!--<th rowspan="2">Lokasi</th>-->
                  	<th rowspan="2">Durasi Kerja</th>
                  	<th rowspan="2">Point</th>
                    <th rowspan="2">Status</th>
                  </tr>
                  <tr>
                    <th colspan="4" class="success">Masuk</th>
                    <th colspan="4" class="danger">Pulang</th>
                    <th colspan="2">IP</th>
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

<!-- ===========================DATA KOMULATIF=========================== -->

<!-- Small boxes 1 (Stat box) -->
<div class="row">
  <div class="col-lg-2 col-xs-4">
    <!-- small box -->
    <div class="small-box bg-gray">
      <div class="inner">
        <?php
        $abs_rwd_masuk="Rajin";
        $abs_tampil_rwd=$abs->abs_tampil_rwd($abs_rwd_masuk,$abs_tgl_masuk);
        $abs_rwd_cek=mysql_num_rows($abs_tampil_rwd);
        if($abs_rwd_cek > 0){
          $modal="modal";
        }else{
          $modal="";
        }
        ?>
        <h3><?php echo $abs_rwd_cek;?></h3>
        <p>Rajin</p>
      </div>
      <div class="icon">
        <i class="fa fa-thumbs-o-up"></i>
      </div>
      <a style="cursor:pointer;" data-toggle="<?php echo $modal;?>" data-target="#rajin_modal" class="small-box-footer">
        More info <i class="fa fa-arrow-circle-right"></i>
      </a>
    </div>
  </div><!-- ./col -->

  <div class="col-lg-2 col-xs-4">
    <!-- small box -->
    <div class="small-box bg-gray">
      <div class="inner">
        <?php
        $abs_rwd_masuk="Telat";
        $abs_tampil_rwd=$abs->abs_tampil_rwd($abs_rwd_masuk,$abs_tgl_masuk);
        $abs_rwd_cek=mysql_num_rows($abs_tampil_rwd);
        if($abs_rwd_cek > 0){
          $modal="modal";
        }else{
          $modal="";
        }
        ?>
        <h3><?php echo $abs_rwd_cek;?></h3>
        <p>Terlambat</p>
      </div>
      <div class="icon">
        <i class="fa fa-thumbs-o-down"></i>
      </div>
      <a style="cursor:pointer;" data-toggle="<?php echo $modal;?>" data-target="#telat_modal" class="small-box-footer">
        More info <i class="fa fa-arrow-circle-right"></i>
      </a>
    </div>
  </div><!-- ./col -->
</div><!-- /.row -->

</section>
<!-- /.content --> 


<!-- ===========================MODAL========================= --> 

                
<!-- Modal Rajin -->
<div class="modal fade" id="rajin_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header bg-gray">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel"><i class="fa fa-thumbs-o-up"></i> Rajin</h4>
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
            $abs_rwd_masuk="Rajin";
            $abs_tampil_rwd=$abs->abs_tampil_rwd($abs_rwd_masuk,$abs_tgl_masuk);
            while($abs_data_rwd=mysql_fetch_array($abs_tampil_rwd)){

              $kar_id_=$abs_data_rwd['kar_id'];
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


<!-- Modal Terlamat -->
<div class="modal fade" id="telat_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header bg-gray">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel"><i class="fa fa-thumbs-o-down"></i> Terlambat</h4>
      </div>
      <form class="form-horizontal" action="" method="post">
      <div class="modal-body" id="telat_overflow">
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
            $abs_rwd_masuk="Telat";
            $abs_tampil_rwd=$abs->abs_tampil_rwd($abs_rwd_masuk,$abs_tgl_masuk);
            while($abs_data_rwd=mysql_fetch_array($abs_tampil_rwd)){

              $kar_id_=$abs_data_rwd['kar_id'];
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


<!-- Manual Masuk -->
<div class="modal fade" id="masukmanual" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header bg-primary">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel"><i class="fa fa-sign-in"></i> Manual <strong>Absen Masuk</strong></h4>
      </div>
      <form class="form-horizontal" action="" method="post">
      <div class="modal-body">

          <div class="form-group">
            <label for="kar_id" class="col-sm-2 control-label">Karyawan</label>
            <div class="col-sm-10">
              <div class="bfh-selectbox" data-name="kar_id" data-value="" data-filter="true">
              <div data-value=""></div>
              <?php
                  $kar_tampil_2=$kar->kar_tampil_2();
                  if($kar_tampil_2){
                  foreach($kar_tampil_2 as $data){  
                    /*
                    $kar_id_=$data['kar_id'];
                    $abs_tampil_kar=$abs->abs_tampil_kar($kar_id_,$abs_tgl_masuk);
                    $abs_data_kar=mysql_fetch_array($abs_tampil_kar);
                    */

                    if($data['kar_id']!==$absensi[$data['kar_id']]["kar_id"]){
               ?>
              <div data-value="<?php echo $data['kar_id'];?>"><?php echo $data['kar_nik'];?> - <?php echo $data['kar_nm'];?></div>
              <?php }}}?>    
             </div>
            </div>
           </div>
        
          <div class="form-group">
            <label for="abs_shift" class="col-sm-2 control-label">Shift</label>
            <div class="col-sm-10">
                <input type="radio" name="abs_shift" value="Shift Pagi" class="flat-red" id="abs_shift"  /> Pagi &nbsp;
                <input type="radio" name="abs_shift" value="Shift Siang" class="flat-red" id="abs_shift"  /> Siang &nbsp;
    <input type="radio" name="abs_shift" value="Shift Sore" class="flat-red" id="abs_shift"  /> Sore &nbsp;
                <input type="radio" name="abs_shift" value="Shift Malam" class="flat-red" id="abs_shift"  /> Malam &nbsp; 
            </div>
          </div>
          
          <div class="form-group">
            <label for="location" class="col-sm-2 control-label">Location</label>
            <div class="col-sm-10">
              <div class="bfh-selectbox" data-name="location" data-value="" data-filter="true">
              <div data-value=""></div>
              <?php
                  $ktr_tampil=$ktr->ktr_tampil();
                  if($ktr_tampil){
                  foreach($ktr_tampil as $data){
        if(($data['ktr_id']!=="44")&&($data['ktr_id']!=="23")&&($data['ktr_id']!=="22")&&($data['ktr_id']!=="51")&&($data['ktr_id']!=="11")&&($data['ktr_id']!=="20")&&($data['ktr_id']!=="28")&&($data['ktr_id']!=="26")&&($data['ktr_id']!=="34")&&($data['ktr_id']!=="70")){
               ?>
              <div data-value="<?php echo $data['ktr_id'];?>"><?php echo $data['ktr_nm'];?></div>
              <?php }}}?>    
             </div>
            </div>
           </div>

           <div class="bootstrap-timepicker">
            <div class="form-group">
              <label for="abs_masuk" class="col-sm-2 control-label">Jam</label>
              <div class="col-sm-10">
              <div class="input-group">
                <style type="text/css">
                .dropdown-menu{
                  left: 100px;
                }
                </style>
                <input name="abs_masuk" type="text" value="" data-default-time="" class="form-control timepicker" required/>
                <div class="input-group-addon">
                  <i class="fa fa-clock-o"></i>
                </div>
              </div><!-- /.input group -->
            </div>

            </div><!-- /.form group -->
          </div>

          <div class="form-group">
            <label for="abs_alasan_masuk" class="col-sm-2 control-label">Alasan</label>
            <div class="col-sm-10">
              <textarea name="abs_alasan_masuk" class="form-control" rows="3" id="abs_alasan_masuk" placeholder="Wajib diisi..." required></textarea>
            </div>
          </div>


      </div>
      <div class="modal-footer">
      
         <div class="alert alert-warning  alert-dismissable" align="left">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
          <h4><i class="icon fa fa-warning"></i> PERHATIAN! (Admin)</h4>
          Manual <strong>Absen Masuk</strong> hanya berlaku jika karyawan yang bersangkutan telah melakukan konfirmasi terkait masalah absensi yang disebabkan oleh <strong>Gangguan Koneksi Internet</strong>.
        </div>
       
        <button type="submit" name="babsmasuk" class="btn btn-primary"><i class="fa fa-hand-o-up"></i></button>
      </div>
      </form>
    </div>
  </div>
</div>


<!-- Manual Pulang -->
<div class="modal fade" id="pulangmanual" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header bg-red">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel"><i class="fa fa-sign-out"></i> Manual <strong>Absen Pulang</strong></h4>
      </div>
      <form class="form-horizontal" action="" method="post">
      <div class="modal-body">

          <div class="form-group">
            <label for="kar_id" class="col-sm-2 control-label">Karyawan</label>
            <div class="col-sm-10">
              <div class="bfh-selectbox" data-name="kar_id" data-value="" data-filter="true">
              <div data-value=""></div>
              <?php
                  $kar_tampil_3=$kar->kar_tampil_3();
                  if($kar_tampil_3){
                  foreach($kar_tampil_3 as $data){

                    /*$kar_id_=$data['kar_id'];
                    $abs_tampil_kar=$abs->abs_tampil_kar($kar_id_,$abs_tgl_masuk);
                    $abs_data_kar=mysql_fetch_array($abs_tampil_kar);*/

                    if($data['kar_id']==$absensi[$data['kar_id']]["kar_id"] && $absensi[$data['kar_id']]["abs_sts"]=="M"){
               ?>
              <div data-value="<?php echo $data['kar_id'];?>"><?php echo $data['kar_nik'];?> - <?php echo $data['kar_nm'];?></div>
              <?php }}}?>    
             </div>
            </div>
           </div>

           <div class="bootstrap-timepicker">
            <div class="form-group">
              <label for="abs_pulang" class="col-sm-2 control-label">Jam</label>
              <div class="col-sm-10">
              <div class="input-group">
                <style type="text/css">
                .dropdown-menu{
                  left: 100px;
                }
                </style>
                <input name="abs_pulang" type="text" value="" data-default-time="" class="form-control timepicker" required/>
                <div class="input-group-addon">
                  <i class="fa fa-clock-o"></i>
                </div>
              </div><!-- /.input group -->
            </div>

            </div><!-- /.form group -->
          </div>

          <div class="form-group">
            <label for="abs_alasan_pulang" class="col-sm-2 control-label">Alasan</label>
            <div class="col-sm-10">
              <textarea name="abs_alasan_pulang" class="form-control" rows="3" id="abs_alasan_pulang" placeholder="Wajib diisi..." required></textarea>
            </div>
          </div>

      </div>
      <div class="modal-footer">
      
         <div class="alert alert-warning  alert-dismissable" align="left">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
          <h4><i class="icon fa fa-warning"></i> PERHATIAN! (Admin)</h4>
          Manual <strong>Absen Pulang</strong> hanya berlaku jika karyawan yang bersangkutan telah melakukan konfirmasi terkait masalah absensi yang disebabkan oleh <strong>Gangguan Koneksi Internet</strong>.
        </div>
       
        <button type="submit" name="babspulang" class="btn btn-danger"><i class="fa fa-hand-o-up"></i></button>
      </div>
      </form>
    </div>
  </div>
</div>

