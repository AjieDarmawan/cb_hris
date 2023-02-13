<?php require('module/marketing_support/ms_act.php'); ?>
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
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title"><span style="cursor:pointer" class="label label-primary" data-toggle="modal" data-target="#myModal"><i class="fa fa-plus"></i></span></h3>
              <!-- tools box -->
                  <div class="pull-right box-tools">
                    <!-- Date and time range -->
                  <div class="form-group">
                    <div class="input-group">
                      <button class="btn btn-default pull-right" id="daterange-btn">
                        <i class="fa fa-calendar"></i> Sortir Marketing Support <small>Under Construction</small>
                        <i class="fa fa-caret-down"></i>
                      </button>
                    </div>
                  </div><!-- /.form group -->
                  </div><!-- /. tools -->
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive">
              <table id="tb_karyawan" class="table table-bordered table-striped table-hover">
                <thead>
                  <tr>
                    <th>NIK</th>
                    <th>Nama</th>
                    <th>Tgl Lahir</th>
                    <th>Divisi</th>
                    <th>Jabatan</th>
                    <th>Level</th>
                    <th>Unit</th>
                    <th>Kantor</th>
                    <th>Kontrak</th>
                    <th>Aksi</th>
                  </tr>
                </thead>
                <tbody>
                <?php
				$kar_tampil=$ms->ms_tampil();
				if($kar_tampil){
				foreach($kar_tampil as $data){

        $kar_id_=$data['kar_id'];
        $kar_tampil_detail=$ms->ms_tampil_detail($kar_id_);
        $kar_data_detail=mysql_fetch_assoc($kar_tampil_detail);


        if($kar_data_detail['kar_dtl_typ_krj']=="Freelance"){

          $sts_kontrak="<span class='label label-primary'>Freelance</span>";

        }elseif($kar_data_detail['kar_dtl_typ_krj']=="Resign"){

          $sts_kontrak="<span class='label label-danger'>Resign</span>";
          
        }else{

          $sts_kontrak="<span class='label label-default'>Undifine</span>";
        }
				?>
                  <tr>
                    <td><?php echo $data['kar_nik']; ?></td>
                    <td><?php echo $data['kar_nm']; ?></td>
                    <td><?php echo $tgl->tgl_indo($data['kar_tgl_lahir']); ?></td>
                    <td><?php echo $data['div_nm']; ?></td>
                    <td><?php echo $data['jbt_nm']; ?></td>
                    <td><?php echo $data['lvl_nm']; ?></td>
                    <td><?php echo $data['unt_nm']; ?></td>
                    <td><a data-toggle="tooltip" title="<?php echo $data['ktr_nm']; ?>" style="cursor:pointer"><?php echo $data['ktr_kd']; ?></a></td>
                    <td><?php echo $sts_kontrak; ?></td>
                    <td>
                    <a href="?p=detail_marketing_support&id=<?php echo $data['kar_id'];?>"><span style="cursor:pointer" class="label label-primary"><i class="fa fa-ellipsis-h"></i></span></a>
                    <a href="#delete-confirm" data-toggle="modal" data-data="<?php echo $data['kar_nm'];?>" data-url="?p=data_marketing_support&act=hapus&id=<?php echo $data['kar_id'];?>"><span style="cursor:pointer" class="label label-danger" disabled><i class="fa fa-trash"></i></span></a>
                    </td>
                  </tr>
                <?php }}?>  
                </tbody>      
                <tfoot>
                  <tr>
                    <th>NIK</th>
                    <th>Nama</th>
                    <th>Tgl Lahir</th>
                    <th>Divisi</th>
                    <th>Jabatan</th>
                    <th>Level</th>
                    <th>Unit</th>
                    <th>Kantor</th>
                    <th>Kontrak</th>
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

      <!-- =========================================================== -->

          <!-- Small boxes (Stat box) -->
          <div class="row">
            <div class="col-lg-3 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-aqua">
                <div class="inner">
		  <?php
		  $kar_dtl_sts_krj="A";
		  $kar_tampil_sts=$ms->ms_tampil_sts($kar_dtl_sts_krj);
		  $kar_cek_sts=mysql_num_rows($kar_tampil_sts);
		  if($kar_cek_sts > 0){
		    $modal="modal";
		  }else{
		    $modal="";
		  }
		  ?>
                  <h3><?php echo $kar_cek_sts;?><sup style="font-size: 20px">Orang</sup></h3>
                  <p>Total Karyawan</p>
                </div>
                <div class="icon">
                  <i class="fa fa-users"></i>
                </div>
                <a style="cursor:pointer;" data-toggle="<?php echo $modal;?>" data-target="#total_karyawan_modal" class="small-box-footer">
		  More info <i class="fa fa-arrow-circle-right"></i>
		</a>
              </div>
            </div><!-- ./col -->
            <div class="col-lg-3 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-green">
                <div class="inner">
		  <?php
		  $kar_dtl_typ_krj="Freelance";
		  $kar_tampil_typ=$ms->ms_tampil_typ($kar_dtl_typ_krj);
		  $kar_cek_typ=mysql_num_rows($kar_tampil_typ);
		  if($kar_cek_typ > 0){
		    $modal="modal";
		  }else{
		    $modal="";
		  }
		  ?>
                  <h3><?php echo $kar_cek_typ;?><sup style="font-size: 20px">Orang</sup></h3>
                  <p>Freelance</p>
                </div>
                <div class="icon">
                  <i class="fa fa-user"></i>
                </div>
                <a style="cursor:pointer;" data-toggle="<?php echo $modal;?>" data-target="#kontrak_modal" class="small-box-footer">
		  More info <i class="fa fa-arrow-circle-right"></i>
		</a>
              </div>
            </div><!-- ./col -->
            <div class="col-lg-3 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-red">
                <div class="inner">
                  <?php
		  $kar_dtl_typ_krj="Resign";
		  $kar_tampil_typ=$ms->ms_tampil_typ($kar_dtl_typ_krj);
		  $kar_cek_typ=mysql_num_rows($kar_tampil_typ);
		  if($kar_cek_typ > 0){
		    $modal="modal";
		  }else{
		    $modal="";
		  }
		  ?>
                  <h3><?php echo $kar_cek_typ;?><sup style="font-size: 20px">Orang</sup></h3>
                  <p>Resign</p>
                </div>
                <div class="icon">
                  <i class="fa fa-user-times"></i>
                </div>
                <a style="cursor:pointer;" data-toggle="<?php echo $modal;?>" data-target="#resign_modal" class="small-box-footer">
		  More info <i class="fa fa-arrow-circle-right"></i>
		</a>
              </div>
            </div><!-- ./col -->
          </div><!-- /.row -->

          <!-- =========================================================== --> 

    </section>
    <!-- /.content --> 


    
<!-- POPUP -->
<!-- Button trigger modal -->


<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header bg-primary">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel"><i class="fa fa-user"></i> Tambah Marketing Support</h4>
      </div>
      <form class="form-horizontal" action="" method="post">
      <div class="modal-body">
          <div class="form-group">
            <label for="kar_nik_dis" class="col-sm-2 control-label">NIK</label>
            <div class="col-sm-10">
              <input type="text" name="kar_nik_dis" class="form-control" id="kar_nik_dis" value="<?php echo $new_nik;?>" disabled>
              <input type="hidden" name="kar_nik" id="kar_nik" value="<?php echo $new_nik;?>">
            </div>
          </div>
          <div class="form-group">
            <label for="kar_nm" class="col-sm-2 control-label">Nama</label>
            <div class="col-sm-10">
              <input type="text" name="kar_nm" class="form-control" id="kar_nm" placeholder="Nama Karyawan" required>
            </div>
          </div>
          <div class="form-group">
            <label for="kar_tgl_lahir" class="col-sm-2 control-label">Tgl Lahir</label>
            <div class="col-sm-10">
              <input type="text" name="kar_tgl_lahir" class="form-control" id="kar_tgl_lahir" placeholder="Tanggal Lahir" data-inputmask="'alias': 'yyyy-mm-dd'" data-mask required>
            </div>
          </div>
          <div class="form-group">
            <label for="div_id" class="col-sm-2 control-label">Divisi</label>
            <div class="col-sm-10">
              <select class="form-control" name="div_id" id="div_id" required>
              	<option value="" selected></option>
                <?php
				$div_tampil=$div->div_tampil();
				foreach($div_tampil as $data){	
				?>
                <option value="<?php echo $data['div_id']; ?>"><?php echo $data['div_nm']; ?></option>
                <?php }?>
              </select>
            </div>
          </div>
          <div class="form-group">
            <label for="jbt_id" class="col-sm-2 control-label">Jabatan</label>
            <div class="col-sm-10">
              <select class="form-control" name="jbt_id" id="jbt_id" required>
              	<option value="" selected></option>
              </select>
            </div>
          </div>
          <div class="form-group">
            <label for="lvl_id" class="col-sm-2 control-label">Level</label>
            <div class="col-sm-10">
              <select class="form-control" name="lvl_id" id="lvl_id" required>
              	<option value="" selected></option>
                <?php
				$lvl_tampil=$lvl->lvl_tampil();
				foreach($lvl_tampil as $data){	
				?>
                <option value="<?php echo $data['lvl_id']; ?>"><?php echo $data['lvl_nm']; ?></option>
                <?php }?>
              </select>
            </div>
          </div>
          <div class="form-group">
            <label for="unt_id" class="col-sm-2 control-label">Unit</label>
            <div class="col-sm-10">
              <select class="form-control" name="unt_id" id="unt_id" required>
              	<option value="" selected></option>
                <?php
				$unt_tampil=$unt->unt_tampil();
				foreach($unt_tampil as $data){	
				?>
                <option value="<?php echo $data['unt_id']; ?>"><?php echo $data['unt_nm']; ?></option>
                <?php }?>
              </select>
            </div>
          </div>
          <div class="form-group">
            <label for="ktr_id" class="col-sm-2 control-label">Kantor</label>
            <div class="col-sm-10">
              <select class="form-control" name="ktr_id" id="ktr_id" required>
              	<option value="" selected></option>
              </select>
            </div>
          </div>
		  <div class="form-group">
            <label for="kot_id" class="col-sm-2 control-label">Kota</label>
            <div class="col-sm-10">
              <select class="form-control" name="kot_id" id="kot_id" required>
              	<option value="" selected></option>
                <?php
				$kot_tampil=$kot->kot_tampil();
				foreach($kot_tampil as $data){	
				?>
                <option value="<?php echo $data['kot_id']; ?>"><?php echo $data['kot_kota']; ?></option>
                <?php }?>
              </select>
            </div>
          </div>
      </div>
      <div class="modal-footer">
        <button type="submit" name="bsave" class="btn btn-primary"><i class="fa fa-save"></i></button>
      </div>
      </form>
    </div>
  </div>
</div>



<!-- Modal Total Karyawan -->
<div class="modal fade" id="total_karyawan_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header bg-gray">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel"><i class="fa fa-users"></i> Total Marketing Support</h4>
      </div>
      <form class="form-horizontal" action="" method="post">
      <div class="modal-body" id="total_karyawan_overflow">
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
            $kar_dtl_sts_krj="A";
	    $kar_tampil_sts=$ms->ms_tampil_sts($kar_dtl_sts_krj);
            while($kar_data_sts=mysql_fetch_array($kar_tampil_sts)){

              $kar_id_=$kar_data_sts['kar_id'];
              $kar_tampil_id_=$ms->ms_tampil_id($kar_id_);
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



<!-- Modal Karyawan Kontrak -->
<div class="modal fade" id="kontrak_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header bg-gray">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel"><i class="fa fa-user"></i> Marketing Support Kontrak</h4>
      </div>
      <form class="form-horizontal" action="" method="post">
      <div class="modal-body" id="kontrak_overflow">
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
            $kar_dtl_typ_krj="Freelance";
	    $kar_tampil_typ=$ms->ms_tampil_typ($kar_dtl_typ_krj);
            while($kar_data_typ=mysql_fetch_array($kar_tampil_typ)){

              $kar_id_=$kar_data_typ['kar_id'];
              $kar_tampil_id_=$ms->ms_tampil_id($kar_id_);
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

<!-- Modal Karyawan Resign -->
<div class="modal fade" id="resign_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header bg-gray">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel"><i class="fa fa-user-times"></i> Marketing Support Resign</h4>
      </div>
      <form class="form-horizontal" action="" method="post">
      <div class="modal-body" id="resign_overflow">
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
            $kar_dtl_typ_krj="Resign";
	    $kar_tampil_typ=$ms->ms_tampil_typ($kar_dtl_typ_krj);
            while($kar_data_typ=mysql_fetch_array($kar_tampil_typ)){

              $kar_id_=$kar_data_typ['kar_id'];
              $kar_tampil_id_=$ms->ms_tampil_id($kar_id_);
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