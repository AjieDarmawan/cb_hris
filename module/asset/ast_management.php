<?php require('module/asset/ast_act.php'); ?>
<!-- Content Header (Page header) -->
<section class="content-header">
  <h1> <?php echo $title;?> <small></small> </h1>
  <ol class="breadcrumb">
    <li><a href="media.php"><i class="fa fa-dashboard"></i> Dashboard</a></li>
    <li><a href="?p=management_asset">Data Asset</a></li>
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
          <h3 class="box-title"></h3>
          <div class="pull-right">
            <button class="btn btn-sm btn-primary" data-toggle="modal" data-target="#inputjenis"><i class="fa fa-plus"></i> Add</button>
          </div>
        </div>
        <!-- /.box-header -->
        <div class="box-body">

        <table id="tb_karyawan" class="table table-bordered table-striped table-hover">
          <thead>
            <tr>
              <th>Jenis</th>
              <th class="bg-success">Stok</th>
              <th class="bg-danger">Rusak</th>
              <th class="bg-info">Baru</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tbody>
          <?php
          $ast_jns_tampil=$ast->ast_jns_tampil();
          foreach($ast_jns_tampil as $data){

            $ast_jns_id=$data['ast_jns_id'];

            $ast_sts_h="H";
            $ast_tampil_jns_h=$ast->ast_tampil_jns($ast_jns_id,$ast_sts_h);
            $ast_jns_cek_h=mysql_num_rows($ast_tampil_jns_h);

            $ast_sts_r="R";
            $ast_tampil_jns_r=$ast->ast_tampil_jns($ast_jns_id,$ast_sts_r);
            $ast_jns_cek_r=mysql_num_rows($ast_tampil_jns_r);

            $ast_sts_b="B";
            $ast_tampil_jns_b=$ast->ast_tampil_jns($ast_jns_id,$ast_sts_b);
            $ast_jns_cek_b=mysql_num_rows($ast_tampil_jns_b);

            if($ast_jns_cek_h == 0){
              $tr="bg-danger";
            }else{
              $tr="";
            }
          ?>
            <tr>
              <td class="<?php echo $tr; ?>"><a href="?p=detail_asset&act=open&id=<?php echo $data['ast_jns_id']; ?>"><?php echo $data['ast_jns_nm']; ?></a></td>
              <td class="bg-success"><?php echo $ast_jns_cek_h ? $ast_jns_cek_h: '-'; ?></td>
              <td class="bg-danger"><?php echo $ast_jns_cek_r ? $ast_jns_cek_r: '-'; ?></td>
              <td class="bg-info"><?php echo $ast_jns_cek_b ? $ast_jns_cek_b: '-';; ?></td>
              <td> <a href="javascript:;"
                  data-astjnsid="<?php echo $data['ast_jns_id']; ?>"
                  data-astjnsnm="<?php echo $data['ast_jns_nm']; ?>" data-toggle="modal" data-target="#editjenis"><i class="fa  fa-pencil"></i></a></td>
            </tr>
          <?php }?>  
          </tbody>      
          <tfoot>
            <tr>
              <th>Jenis</th>
              <th class="bg-success">Stok</th>
              <th class="bg-danger">Rusak</th>
              <th class="bg-info">Baru</th>
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


<!-- Modal Input Jenis-->
<div class="modal fade" id="inputjenis" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header bg-primary">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel"><i class="fa fa-cube"></i> Tambah Jenis</h4>
      </div>
      <form class="form-horizontal" action="" method="post">
      <div class="modal-body">

          <div class="form-group">
            <label for="ast_jns_nm" class="col-sm-2 control-label">Jenis</label>
            <div class="col-sm-10">
              <input type="text" name="ast_jns_nm" class="form-control" id="ast_jns_nm" placeholder="Nama Jenis" required>
            </div>
          </div>
   
    
      </div>
      <div class="modal-footer">
        <button type="submit" name="binputjenis" class="btn btn-primary"><i class="fa fa-save"></i></button>
      </div>
      </form>
    </div>
  </div>
</div>


<!-- Modal Edit Jenis-->
<div class="modal fade" id="editjenis" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header bg-primary">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel"><i class="fa fa-cube"></i> Edit Jenis <strong id="ast_jns_nm"></strong></h4>
      </div>
      <form class="form-horizontal" action="" method="post">
      <input type="hidden" name="ast_jns_id" id="ast_jns_id">
      <div class="modal-body">

          <div class="form-group">
            <label for="ast_jns_nm" class="col-sm-2 control-label">Jenis</label>
            <div class="col-sm-10">
              <input type="text" name="ast_jns_nm" class="form-control" id="ast_jns_nm" placeholder="Nama Jenis" required>
            </div>
          </div>
   
    
      </div>
      <div class="modal-footer">
        <button type="submit" name="beditjenis" class="btn btn-primary"><i class="fa fa-save"></i></button>
      </div>
      </form>
    </div>
  </div>
</div>