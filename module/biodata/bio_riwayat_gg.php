<?php require('module/biodata/bio_act.php'); ?>
<!-- Content Header (Page header) -->
    <section class="content-header">
      <h1> <?php echo $title;?> <small></small> </h1>
      <ol class="breadcrumb">
        <li><a href="media.php"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li><a href="?p=biodata"> Biodata</a></li>
        <li><a href="?p=pekerjaan"> Pekerjaan</a></li>
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
                    <th>Jabatan</th>
                    <th>Level</th>
                    <th>Penghasilan</th>
                    <th>Perusahaan</th>
                    <th>Alamat</th>
                    <th>Start</th>
                    <th>End</th>
                    <th>Alasan Berhenti</th>
                    <th>Aksi</th>
                  </tr>
                </thead>
                <tbody>
                <?php
				$rwp_tampil_id=$bio->rwp_tampil_id($kar_id);
				while($data=mysql_fetch_array($rwp_tampil_id)){
                                    
				?>
                  <tr>
                    <td><?php echo $data['rwp_jbt']; ?></td>
                    <td><?php echo $data['rwp_lvl']; ?></td>
                    <td><?php echo $rph->format_rupiah($data['rwp_penghasilan']); ?></td>
                    <td><?php echo $data['rwp_perusahaan']; ?></td>
                    <td><?php echo $data['rwp_alt']; ?></td>
                    <td><?php echo $data['rwp_start']; ?></td>
                    <td><?php echo $data['rwp_end']; ?></td>
                    <td><?php echo $data['rwp_berhenti']; ?></td>
                    <td>
                    <a href="#"><span style="cursor:pointer" class="label label-primary"><i class="fa fa-ellipsis-h"></i></span></a>
                    <a href="#delete-confirm" data-toggle="modal" data-data="<?php echo $data['rwp_tempat'];?>" data-url="?p=pendidikan_formal&act=hapus&id=<?php echo $data['rwp_id'];?>"><span style="cursor:pointer" class="label label-danger"><i class="fa fa-trash"></i></span></a>
                    <?php
                    if(!empty($data['rwp_sts'])){
                      if($data['rwp_sts']=="A"){
                    ?>
                    <a href="#block-confirm" data-toggle="modal" data-data="<h4>Yakin Headline <strong><?php echo $data['rwp_tempat'];?></strong> akan di HIDDEN?</h4>" data-url="?p=pendidikan_formal&act=block&id=<?php echo $data['rwp_id'];?>"><span style="cursor:pointer" class="label label-success"><i class="fa fa-check"></i></span></a>
                    <?php 
                    }elseif($data['rwp_sts']=="N"){
                    ?>
                    <a href="#block-confirm" data-toggle="modal" data-data="<h4>UNHIDE Headline <strong><?php echo $data['rwp_tempat'];?></strong></h4>" data-url="?p=pendidikan_formal&act=unblock&id=<?php echo $data['rwp_id'];?>"><span style="cursor:pointer" class="label label-danger"><i class="fa fa-ban"></i></span></a>
                    <?php }}?>
                    </td>
                  </tr>
                <?php }?>  
                </tbody>      
                <tfoot>
                  <tr>
                    <th>Jabatan</th>
                    <th>Level</th>
                    <th>Penghasilan</th>
                    <th>Perusahaan</th>
                    <th>Alamat</th>
                    <th>Start</th>
                    <th>End</th>
                    <th>Alasan Berhenti</th>
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
        <h4 class="modal-title" id="myModalLabel"><i class="fa fa-briefcase"></i> Tambah Riwayat Pekerjaan</h4>
      </div>
      <form class="form-horizontal" action="" method="post">
      <div class="modal-body">
          <div class="form-group">
            <label for="rwp_jbt" class="col-sm-2 control-label">Jabatan</label>
            <div class="col-sm-10">
              <input type="text" name="rwp_jbt" class="form-control" id="rwp_jbt" placeholder="Jabatan" required>
            </div>
          </div>
          <div class="form-group">
            <label for="rwp_lvl" class="col-sm-2 control-label">Level</label>
            <div class="col-sm-10">
              <input type="text" name="rwp_lvl" class="form-control" id="rwp_lvl" placeholder="Level" required>
            </div>
          </div>
          <div class="form-group">
            <label for="rwp_penghasilan" class="col-sm-2 control-label">Penghasilan</label>
            <div class="col-sm-10">
              <input type="text" name="rwp_penghasilan" class="form-control" id="rwp_penghasilan" placeholder="Penghasilan" required>
            </div>
          </div>
          <div class="form-group">
            <label for="rwp_perusahaan" class="col-sm-2 control-label">Perusahaan</label>
            <div class="col-sm-10">
              <input type="text" name="rwp_perusahaan" class="form-control" id="rwp_perusahaan" placeholder="Perusahaan" required>
            </div>
          </div>
          <div class="form-group">
            <label for="rwp_alt" class="col-sm-2 control-label">Alamat</label>
            <div class="col-sm-10">
              <textarea name="rwp_alt" class="form-control" id="rwp_alt" placeholder="Alamat" required></textarea>
            </div>
          </div>
          <div class="form-group">
            <label for="rwp_start" class="col-sm-2 control-label">Start</label>
            <div class="col-sm-10">
              <input type="text" name="rwp_start" class="form-control" id="rwp_start" placeholder="Start" required>
            </div>
          </div>
	  <div class="form-group">
            <label for="rwp_end" class="col-sm-2 control-label">End</label>
            <div class="col-sm-10">
              <input type="text" name="rwp_end" class="form-control" id="rwp_end" placeholder="End" required>
            </div>
          </div>
          <div class="form-group">
            <label for="rwp_berhenti" class="col-sm-2 control-label">Alasan Berhenti</label>
            <div class="col-sm-10">
              <input type="text" name="rwp_berhenti" class="form-control" id="rwp_berhenti" placeholder="Alasan Berhenti" required>
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