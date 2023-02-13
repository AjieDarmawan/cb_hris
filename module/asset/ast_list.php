<?php require('module/asset/ast_act.php'); ?>
<!-- Content Header (Page header) -->
<section class="content-header">
  <h1> <?php echo $title;?> <small></small> </h1>
  <ol class="breadcrumb">
    <li><a href="media.php"><i class="fa fa-dashboard"></i> Dashboard</a></li>
    <li><a href="?p=list_asset">Data Asset</a></li>
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
          <h3 class="box-title">All Asset</h3>
          <div class="pull-right">
            <button class="btn btn-sm btn-primary" data-toggle="modal" data-target="#inputasset"><i class="fa fa-plus"></i> Add</button>
          </div>
        </div>
        <!-- /.box-header -->
        <div class="box-body">

        <table id="tb_karyawan" class="table table-bordered table-striped table-hover">
            <thead>
              <tr>
                <th>Nama</th>
                <th>SN</th>
                <th>Jenis</th>
                <th>Deskripsi</th>
                <th>Status</th>
                <th>Aksi</th>
              </tr>
            </thead>
            <tbody>
            <?php
            $ast_tampil=$ast->ast_tampil();
            if($ast_tampil){
            foreach($ast_tampil as $data){

              
              if($data['ast_sts']=="H"){
                $sts_nm="Hidup";
                $lbl="success";
              }elseif($data['ast_sts']=="R"){
                $sts_nm="Rusak";
                $lbl="danger";
              }elseif($data['ast_sts']=="B"){
                $sts_nm="Baru";
                $lbl="primary";
              }


            ?>
              <tr>
                <td><?php echo $data['ast_nm']; ?></td>
                <td><?php echo $data['ast_sn']; ?></td>
                <td><?php echo $data['ast_jns_nm']; ?></td>
                <!--<td><?php //echo $data['ast_stk']; ?></td>-->
                <td><?php echo strip_tags(substr(str_replace('"','',$data['ast_des']),0,50)); ?> <span data-toggle="tooltip" title="<?php echo strip_tags(str_replace('"','',$data['ast_des'])); ?>" style="cursor:pointer">... <i class="fa fa-external-link"></i></span></td>
                <td><span class="label label-<?php echo $lbl; ?>"><?php echo $sts_nm; ?></span></td>
                <td> <a href="javascript:;"
                    data-astid="<?php echo $data['ast_id']; ?>"
                    data-astnm="<?php echo $data['ast_nm']; ?>"
                    data-astsn="<?php echo $data['ast_sn']; ?>"
                    data-astjnsid="<?php echo $data['ast_jns_id']; ?>"
                    data-aststs="<?php echo $data['ast_sts']; ?>"
                    data-astdes="<?php echo $data['ast_des']; ?>" data-toggle="modal" data-target="#editasset"><i class="fa  fa-pencil"></i></a></td>
              </tr>
            <?php }}?>  
            </tbody>      
            <tfoot>
              <tr>
                <th>Nama</th>
                <th>SN</th>
                <th>Jenis</th>
                <th>Deskripsi</th>
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
  
</section>
<!-- /.content --> 



<!-- Modal Input Asset -->
<div class="modal fade" id="inputasset" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header bg-primary">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel"><i class="fa fa-cube"></i> Tambah Asset</h4>
      </div>
      <form class="form-horizontal" action="" method="post">
      <div class="modal-body">
        <div class="form-group">
            <label for="ast_jns_id" class="col-sm-2 control-label">Jenis</label>
            <div class="col-sm-10">
              <select class="form-control" name="ast_jns_id" id="ast_jns_id" required>
                <option value="" selected></option>
                <?php
                $ast_jns_tampil=$ast->ast_jns_tampil();
                foreach($ast_jns_tampil as $data){   
                ?>
                <option value="<?php echo $data['ast_jns_id']; ?>"><?php echo $data['ast_jns_nm']; ?></option>
                <?php }?>
              </select>
            </div>
          </div> 

          <div class="form-group">
            <label for="ast_nm" class="col-sm-2 control-label">Nama</label>
            <div class="col-sm-10">
              <input type="text" name="ast_nm" class="form-control" id="ast_nm" value="" placeholder="Nama Asset" required>
            </div>
          </div>
          <div class="form-group">
            <label for="ast_sn" class="col-sm-2 control-label">SN</label>
            <div class="col-sm-10">
              <input type="text" name="ast_sn" class="form-control" id="ast_sn" value="" placeholder="Serial Number" required>
            </div>
          </div>
    <div class="form-group">
            <label for="ast_des" class="col-sm-2 control-label">Deskripsi</label>
            <div class="col-sm-10">
              <textarea name="ast_des" id="ast_des" class="form-control" rows="3"  placeholder="Deskripsi" style="width: 100%; height: 125px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;" required></textarea>
            </div>
          </div>
    <div class="form-group">
            <label for="ast_sts" class="col-sm-2 control-label">Status</label>
            <div class="col-sm-10">
               
                <input type="radio" name="ast_sts" value="H" class="flat-red" id="ast_sts" /> <span class="label label-success">Hidup</span> &nbsp;
                <input type="radio" name="ast_sts" value="B" class="flat-red" id="ast_sts" checked /> <span class="label label-primary">Baru</span> &nbsp;
                <input type="radio" name="ast_sts" value="R" class="flat-red" id="ast_sts" /> <span class="label label-danger">Rusak</span> &nbsp;
                
            </div>   
          </div>
    
      </div>
      <div class="modal-footer">
        <button type="submit" name="binputasset" class="btn btn-primary"><i class="fa fa-save"></i></button>
      </div>
      </form>
    </div>
  </div>
</div>


<!-- Modal Edit Asset -->
<div class="modal fade" id="editasset" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header bg-primary">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel"><i class="fa fa-cube"></i> Edit Asset <strong id="ast_nm"></strong></h4>
      </div>
      <form class="form-horizontal" action="" method="post">
      <input type="hidden" name="ast_id" id="ast_id">
      <div class="modal-body">
        <div class="form-group">
            <label for="ast_jns_id" class="col-sm-2 control-label">Jenis</label>
            <div class="col-sm-10">
              <select class="form-control" name="ast_jns_id" id="ast_jns_id" required>
                <option value="" selected></option>
                <?php
                $ast_jns_tampil=$ast->ast_jns_tampil();
                foreach($ast_jns_tampil as $data){   
                ?>
                <option value="<?php echo $data['ast_jns_id']; ?>"><?php echo $data['ast_jns_nm']; ?></option>
                <?php }?>
              </select>
            </div>
          </div> 

          <div class="form-group">
            <label for="ast_nm" class="col-sm-2 control-label">Nama</label>
            <div class="col-sm-10">
              <input type="text" name="ast_nm" class="form-control" id="ast_nm" placeholder="Nama Asset" required>
            </div>
          </div>
          <div class="form-group">
            <label for="ast_sn" class="col-sm-2 control-label">SN</label>
            <div class="col-sm-10">
              <input type="text" name="ast_sn" class="form-control" id="ast_sn" placeholder="Serial Number" required>
            </div>
          </div>
    <div class="form-group">
            <label for="ast_des" class="col-sm-2 control-label">Deskripsi</label>
            <div class="col-sm-10">
              <textarea name="ast_des" id="ast_des_edt" class="form-control" rows="3"  placeholder="Deskripsi" style="width: 100%; height: 125px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;" required></textarea>
            </div>
          </div>
    <div class="form-group">
            <label for="ast_sts" class="col-sm-2 control-label">Status</label>
            <div class="col-sm-10">
               
                <input type="radio" name="ast_sts" value="H" class="flat-red" id="ast_sts_h" /> <span class="label label-success">Hidup</span> &nbsp;
                <input type="radio" name="ast_sts" value="B" class="flat-red" id="ast_sts_b" /> <span class="label label-primary">Baru</span> &nbsp;
                <input type="radio" name="ast_sts" value="R" class="flat-red" id="ast_sts_r" /> <span class="label label-danger">Rusak</span> &nbsp;
                
            </div>   
          </div>
    
      </div>
      <div class="modal-footer">
        <button type="submit" name="beditasset" class="btn btn-primary"><i class="fa fa-save"></i></button>
      </div>
      </form>
    </div>
  </div>
</div>