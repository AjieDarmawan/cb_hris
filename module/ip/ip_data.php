<?php require('module/ip/ip_act.php'); ?>
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
                    <th>IP</th>
		    <th>DNS</th>
                    <th>Release</th>
                    <th>Type</th>
                    <th>Unit</th>
                    <th>Kantor</th>
                    <th>Aksi</th>
                  </tr>
                </thead>
                <tbody>
                <?php
				$ip_tampil=$ip->ip_tampil();
				if($ip_tampil){
				foreach($ip_tampil as $data){
				  if(($data['ktr_id']!=="44")&&($data['ktr_id']!=="23")&&($data['ktr_id']!=="22")&&($data['ktr_id']!=="51")&&($data['ktr_id']!=="11")&&($data['ktr_id']!=="20")&&($data['ktr_id']!=="28")&&($data['ktr_id']!=="26")&&($data['ktr_id']!=="34")&&($data['ktr_id']!=="70")){
				?>
                  <tr>
                    <td><?php echo $data['ip_nm']; ?></td>
		    <td><?php echo $data['ip_dns'] ? $data['ip_dns']: '-'; ?></td>
                    <td><?php echo $tgl->tgl_indo($data['ip_release']); ?></td>
                    <td><?php echo $data['typ_nm']; ?></td>
                    <td><?php echo $data['unt_nm']; ?></td>
                    <td><?php echo $data['ktr_nm']; ?></td>
                    <td>
                    <a href="?p=detail_ip&id=<?php echo $data['ip_id'];?>"><span style="cursor:pointer" class="label label-primary"><i class="fa fa-ellipsis-h"></i></span></a>
                    <a href="#delete-confirm" data-toggle="modal" data-data="<?php echo $data['ip_nm'];?>" data-url="?p=data_ip&act=hapus&id=<?php echo $data['ip_id'];?>"><span style="cursor:pointer" class="label label-danger"><i class="fa fa-trash"></i></span></a>
                    </td>
                  </tr>
                <?php }}}?>  
                </tbody>      
                <tfoot>
                  <tr>
                    <th>IP</th>
		    <th>DNS</th>
                    <th>Release</th>
                    <th>Type</th>
                    <th>Unit</th>
                    <th>Kantor</th>
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
        <h4 class="modal-title" id="myModalLabel"><i class="fa fa-globe"></i> Tambah IP</h4>
      </div>
      <form class="form-horizontal" action="" method="post">
      <div class="modal-body">
          <div class="form-group">
            <label for="ip_nm" class="col-sm-2 control-label">IP</label>
            <div class="col-sm-10">
              <input type="text" name="ip_nm" class="form-control" id="ip_nm" placeholder="IP Address" data-inputmask="'alias': 'ip'" data-mask required>
            </div>
          </div>
	  <div class="form-group">
                    <label for="ip_dns" class="col-sm-2 control-label">DNS</label>
                    <div class="col-sm-10">
                      <input type="text" name="ip_dns" value="" class="form-control" id="ip_dns" placeholder="DNS">
                    </div>
                  </div>
          <div class="form-group">
            <label for="typ_id" class="col-sm-2 control-label">Type</label>
            <div class="col-sm-10">
                <?php
				$typ_tampil=$typ->typ_tampil();
				foreach($typ_tampil as $data){	
				?>
                <input type="radio" name="typ_id" value="<?php echo $data['typ_id']; ?>" class="flat-red" id="typ_id" checked/> <?php echo $data['typ_nm']; ?> &nbsp;
                <?php }?>
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
      </div>
      <div class="modal-footer">
        <button type="submit" name="bsave" class="btn btn-primary"><i class="fa fa-save"></i></button>
      </div>
      </form>
    </div>
  </div>
</div>