<?php require('module/account_fl/acc_act_fl.php'); ?>
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
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="tb_karyawan" class="table table-bordered table-striped table-hover">
                <thead>
                  <tr>
                    <th>NIK</th>
                    <th>Nama</th>
                    <th>Username</th>
                    <th>Password</th>
                    <th>Aksi</th>
                  </tr>
                </thead>
                <tbody>
                <?php
				$acc_tampil=$afl->acc_tampil();
				if($acc_tampil){
				foreach($acc_tampil as $data){	
				?>
                  <tr>
                    <td><?php echo $data['kar_nik']; ?></td>
                    <td><?php echo $data['kar_nm']; ?></td>
                    <td><?php echo $data['acc_username']; ?></td>
                    <td><?php echo str_repeat('*', strlen($data['acc_password'])); ?> <span data-toggle="tooltip" title="<?php echo $data['acc_password']; ?>" style="cursor:pointer"><i class="fa fa-external-link"></i></span></td>
                    <td>
                    <?php
                    if(!empty($data['acc_sts'])){
                      if($data['acc_sts']=="A"){
                    ?>
                    <a href="#block-confirm" data-toggle="modal" data-data="<h4>Yakin Akun <strong><?php echo $data['acc_username'];?></strong> akan di BLOCK?</h4>" data-url="?p=data_account_fl&act=block&id=<?php echo $data['acc_id'];?>"><span style="cursor:pointer" class="label label-success"><i class="fa fa-check"></i></span></a>
                    <?php 
                    }elseif($data['acc_sts']=="N"){
                    ?>
                    <a href="#block-confirm" data-toggle="modal" data-data="<h4>UNBLOCK Akun <strong><?php echo $data['acc_username'];?></strong></h4>" data-url="?p=data_account_fl&act=unblock&id=<?php echo $data['acc_id'];?>"><span style="cursor:pointer" class="label label-danger"><i class="fa fa-ban"></i></span></a>
                    <?php }}?>
                    <a href="#delete-confirm" data-toggle="modal" data-data="<?php echo $data['acc_username'];?>" data-url="?p=data_account_fl&act=hapus&id=<?php echo $data['acc_id'];?>"><span style="cursor:pointer" class="label label-danger"><i class="fa fa-trash"></i></span></a>
                    </td>
                  </tr>
                <?php }}?>  
                </tbody>      
                <tfoot>
                  <tr>
                    <th>NIK</th>
                    <th>Nama</th>
                    <th>Username</th>
                    <th>Password</th>
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
        <h4 class="modal-title" id="myModalLabel"><i class="fa fa-globe"></i> Tambah Account Freelance</h4>
      </div>
      <form class="form-horizontal" action="" method="post">
      <div class="modal-body">
          <div class="form-group">
            <label for="kar_id" class="col-sm-2 control-label">NIK</label>
            <div class="col-sm-10">
              <select class="form-control" name="kar_id" id="kar_id_fl" required>
              	<option value="" selected></option>
                <?php
				$kar_tampil=$fln->kar_tampil();
				foreach($kar_tampil as $data){
                                    $kar_id=$data['kar_id'];
                                    $acc_tampil_kar=$afl->acc_tampil_kar($kar_id);
                                    $cek_acc=mysql_num_rows($acc_tampil_kar);
                                    
                                    if($cek_acc > 0){
                                        echo"";
                                    }else{
                                   
				?>
                <option value="<?php echo $data['kar_id']; ?>"><?php echo $data['kar_nik']; ?></option>
                <?php }}?>
              </select>
            </div>
          </div>
          <center><div id="kar_data_fl"></div></center>
          <div class="form-group">
            <label for="acc_username_dis" class="col-sm-2 control-label">Username</label>
            <div class="col-sm-10">
              <input type="text" name="acc_username_dis" class="form-control" id="acc_username_dis" maxlength="10" placeholder="Username" required>
              <input type="hidden" name="acc_username" class="form-control" id="acc_username">
              <span id="acc_pesan"></span> <small class="help-block">(<em>Cek Ketersediaan</em>)</small>
            </div>
          </div>
          <div class="form-group">
            <label for="acc_password_dis" class="col-sm-2 control-label">Password</label>
            <div class="col-sm-10">
              <input type="text" name="acc_password_dis" maxlength="4" class="form-control" id="acc_password_dis" placeholder="Password" pattern="\d{6}" required>
              <input type="hidden" name="acc_password" class="form-control" id="acc_password">
	      <small class="help-block">(<em>6 Digit</em>)</small>
            </div>
          </div>
          <div class="form-group">
            <label for="re_acc_password_dis" class="col-sm-2 control-label">Re-Password</label>
            <div class="col-sm-10">
              <input type="text" name="re_acc_password_dis" class="form-control" id="re_acc_password_dis" placeholder="Re-Password" required>
              <input type="hidden" name="re_acc_password" class="form-control" id="re_acc_password">
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