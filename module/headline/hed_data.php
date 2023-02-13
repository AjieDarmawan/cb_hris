<?php require('module/headline/hed_act.php'); ?>
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
            <div class="box-body table-responsive">
              <table id="tb_karyawan" class="table table-bordered table-striped table-hover">
                <thead>
                  <tr>
                    <th>Subject</th>
                    <th>Message</th>
                    <th>Tgl</th>
                    <th>Mark</th>
                    <th>From</th>
                    <th>Aksi</th>
                  </tr>
                </thead>
                <tbody>
                <?php
				$hed_tampil=$hed->hed_tampil();
				if($hed_tampil){
				foreach($hed_tampil as $data){
				  if($data['mrk_nm']=="Urgent"){
				    $lbl="danger";
				    $checked="";
				  }elseif($data['mrk_nm']=="Info"){
				    $lbl="primary";
				    $checked="checked";
				  }elseif($data['mrk_nm']=="Warning"){
				    $lbl="warning";
				    $checked="";
				  }
				?>
                  <tr>
                    <td><?php echo $data['hed_sbj']; ?></td>
                    <td><?php echo strip_tags(substr(str_replace('"','',$data['hed_msg']),0,50)); ?> <span data-toggle="tooltip" title="<?php echo strip_tags(str_replace('"','',$data['hed_msg'])); ?>" style="cursor:pointer">... <i class="fa fa-external-link"></i></span></td>
                    <td><?php echo $tgl->tgl_indo($data['hed_tgl']); ?></td>
                    <td><span class="label label-<?php echo $lbl;?>"><?php echo $data['mrk_nm']; ?></span></td>
                    <td><?php echo $data['div_nm']; ?></td>
                    <td>
                    <a href="?p=detail_headline&id=<?php echo $data['hed_id'];?>"><span style="cursor:pointer" class="label label-primary"><i class="fa fa-ellipsis-h"></i></span></a>
                    <a href="#delete-confirm" data-toggle="modal" data-data="<?php echo $data['hed_sbj'];?>" data-url="?p=data_headline&act=hapus&id=<?php echo $data['hed_id'];?>"><span style="cursor:pointer" class="label label-danger"><i class="fa fa-trash"></i></span></a>
                    <?php
                    if(!empty($data['hed_sts'])){
                      if($data['hed_sts']=="A"){
                    ?>
                    <a href="#block-confirm" data-toggle="modal" data-data="<h4>Yakin Headline <strong><?php echo $data['hed_sbj'];?></strong> akan di HIDDEN?</h4>" data-url="?p=data_headline&act=block&id=<?php echo $data['hed_id'];?>"><span style="cursor:pointer" class="label label-success"><i class="fa fa-check"></i></span></a>
                    <?php 
                    }elseif($data['hed_sts']=="N"){
                    ?>
                    <a href="#block-confirm" data-toggle="modal" data-data="<h4>UNHIDE Headline <strong><?php echo $data['hed_sbj'];?></strong></h4>" data-url="?p=data_headline&act=unblock&id=<?php echo $data['hed_id'];?>"><span style="cursor:pointer" class="label label-danger"><i class="fa fa-ban"></i></span></a>
                    <?php }}?>
                    </td>
                  </tr>
                <?php }}?>  
                </tbody>      
                <tfoot>
                  <tr>
                    <th>Subject</th>
                    <th>Message</th>
                    <th>Tgl</th>
                    <th>Mark</th>
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
        <h4 class="modal-title" id="myModalLabel"><i class="fa fa-newspaper-o"></i> Tambah Headline</h4>
      </div>
      <form class="form-horizontal" action="" method="post">
      <div class="modal-body">
          <div class="form-group">
            <label for="hed_sbj" class="col-sm-2 control-label">Subject</label>
            <div class="col-sm-10">
              <input type="text" name="hed_sbj" class="form-control" id="hed_sbj" placeholder="Subject" required>
            </div>
          </div>
	  <div class="form-group">
            <label for="hed_msg" class="col-sm-2 control-label">Message</label>
            <div class="col-sm-10">
              <textarea name="hed_msg" id="hed_msg" class="form-control" rows="3"  placeholder="Message" style="width: 100%; height: 125px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;" required></textarea>
            </div>
          </div>
	  <div class="form-group">
            <label for="mrk_id" class="col-sm-2 control-label">Mark As</label>
            <div class="col-sm-10">
                <?php
				$mrk_tampil=$mrk->mrk_tampil();
				foreach($mrk_tampil as $data){
				  if($data['mrk_nm']=="Urgent"){
				    $lbl="danger";
				    $checked="";
				  }elseif($data['mrk_nm']=="Info"){
				    $lbl="primary";
				    $checked="checked";
				  }elseif($data['mrk_nm']=="Warning"){
				    $lbl="warning";
				    $checked="";
				  }
				  
				?>
                <input type="radio" name="mrk_id" value="<?php echo $data['mrk_id']; ?>" class="flat-red" id="mrk_id" <?php echo $checked;?> /> <span class="label label-<?php echo $lbl;?>"><?php echo $data['mrk_nm']; ?></span> &nbsp;
                <?php }?>
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