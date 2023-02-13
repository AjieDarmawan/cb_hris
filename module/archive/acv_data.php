<?php require('module/archive/acv_act.php'); ?>
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
                    <th>Nama</th>
                    <th>File</th>
                    <th>Tgl</th>
                    <th>From</th>
                    <th>Aksi</th>
                  </tr>
                </thead>
                <tbody>
                <?php
				$acv_tampil=$acv->acv_tampil();
				if($acv_tampil){
				foreach($acv_tampil as $data){

          if(!empty($data['acv_file'])){
                      $acv_pecah=explode(".", $data['acv_file']);
                      $acv_extend=$acv_pecah[1];

                      if($acv_extend == "pdf"){
                        $file = "fa-file-pdf-o text-danger";
                      }elseif($acv_extend == "doc" || $acv_extend == "docx"){
                        $file = "fa-file-word-o text-primary";
                      }elseif($acv_extend == "xls" || $acv_extend == "xlsx"){
                        $file = "fa-file-excel-o text-success";
                      }elseif($acv_extend == "ppt" || $acv_extend == "pptx"){
                        $file = "fa-file-powerpoint-o text-danger";
                      }elseif($acv_extend == "zip" || $acv_extend == "rar"){
                        $file = "fa-file-archive-o text-warning";
                      }else{
                        $file = "fa-file-image-o text-default";
                      }
               }  
				?>
                  <tr>
                    <td><?php echo $data['acv_nm']; ?></td>
                    <td><a href="module/archive/file/<?php echo $data['acv_file']; ?>"><i class="fa <?php echo $file;?>"></i> <?php echo $data['acv_file']; ?> </a></span></td>
                    <td><?php echo $tgl->tgl_indo($data['acv_tgl']); ?></td>
                    <td><?php echo $data['div_nm']; ?></td>
                    <td>
                    <a href="?p=detail_archive&id=<?php echo $data['acv_id'];?>"><span style="cursor:pointer" class="label label-primary"><i class="fa fa-ellipsis-h"></i></span></a>
                    <a href="#delete-confirm" data-toggle="modal" data-data="<?php echo $data['acv_nm'];?>" data-url="?p=data_archive&act=hapus&id=<?php echo $data['acv_id'];?>"><span style="cursor:pointer" class="label label-danger"><i class="fa fa-trash"></i></span></a>
                    <?php
                    if(!empty($data['acv_sts'])){
                      if($data['acv_sts']=="A"){
                    ?>
                    <a href="#block-confirm" data-toggle="modal" data-data="<h4>Yakin Archive <strong><?php echo $data['acv_nm'];?></strong> akan di HIDDEN?</h4>" data-url="?p=data_archive&act=block&id=<?php echo $data['acv_id'];?>"><span style="cursor:pointer" class="label label-success"><i class="fa fa-check"></i></span></a>
                    <?php 
                    }elseif($data['acv_sts']=="N"){
                    ?>
                    <a href="#block-confirm" data-toggle="modal" data-data="<h4>UNHIDE Archive <strong><?php echo $data['acv_nm'];?></strong></h4>" data-url="?p=data_archive&act=unblock&id=<?php echo $data['acv_id'];?>"><span style="cursor:pointer" class="label label-danger"><i class="fa fa-ban"></i></span></a>
                    <?php }}?>
                    </td>
                  </tr>
                <?php }}?>  
                </tbody>      
                <tfoot>
                  <tr>
                    <th>Nama</th>
                    <th>File</th>
                    <th>Tgl</th>
                    <th>From</th>
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
        <h4 class="modal-title" id="myModalLabel"><i class="fa fa-archive"></i> Tambah Archive</h4>
      </div>
      <form class="form-horizontal" action="" method="post" enctype="multipart/form-data">
      <div class="modal-body">
          <div class="form-group">
            <label for="acv_nm" class="col-sm-2 control-label">Nama</label>
            <div class="col-sm-10">
              <input type="text" name="acv_nm" class="form-control" id="acv_nm" placeholder="Nama" required>
            </div>
          </div>
	  <div class="form-group">
            <label for="acv_file" class="col-sm-2 control-label">File</label>
            <div class="col-sm-10">
              <div class="btn btn-default btn-file" id="file">
                    <i class="fa fa-paperclip"></i> Attachment File
              </div>
                    <input type="file" name="acv_file"/>
                    <small class="help-block"><em>Max. 10MB</em></small>
            </div>
          </div>
	  <div class="form-group">
            <label for="div_id" class="col-sm-2 control-label">From</label>
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
      </div>
      <div class="modal-footer">
        <button type="submit" name="bsave" class="btn btn-primary"><i class="fa fa-save"></i></button>
      </div>
      </form>
    </div>
  </div>
</div>