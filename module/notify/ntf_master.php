<?php require('module/notify/ntf_act.php'); ?>
<!-- Content Header (Page header) -->
    <section class="content-header">
      <h1> <?php echo $title;?> <small>WIB: <?php echo $time;?></small>,
      <small>WITA: <?php echo gmdate("H:i:s", time()+60*60*8);?></small>,
      <small>Hostname: <?php echo $hostname;?></small>,
      <small><?php $hosts = gethostbynamel('thamrina.dyndns.org');print_r($hosts);?></small>,
      <small><?php echo $key.$key_2.$key_3.$key_4;?></small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="media.php"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li class="active"><?php echo $title;?></li>
      </ol>
    </section>
    
    <!-- Main content -->
    <section class="content">
            
      <!-- Your Page Content Here -->
      <div class="row">
        <div class="col-md-12">
	  <form class="form-horizontal" action="" method="post">
          <div class="box box-info">
            <div class="box-header">
              <h3 class="box-title">Action Monitoring <small><?php echo $tgl->tgl_indo($date);?></small></h3>
	      <!-- tools box -->
                  <div class="pull-right box-tools">
                    <button class="btn btn-info btn-sm" data-widget='collapse' data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
                    <button class="btn btn-info btn-sm" data-widget='remove' data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
                  </div><!-- /. tools -->
	    </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example_2" class="table table-bordered table-striped table-hover">
                <thead>
                  <tr>
                    <th>Username</th>
                    <th>Nama</th>
                    <th>Action</th>
                    <th>Transfer</th>
                    <th>IP Address</th>
                    <th>Tgl</th>
                    <th>Jam</th>
                  </tr>
                </thead>
                <tbody>
                <?php
                $tanggal=$date;
        				$ntf_tampil=$ntf->ntf_tampil($tanggal);
        				if($ntf_tampil){
        				  $i=0;
        				foreach($ntf_tampil as $data){

                  $kar_id_pos=$data['kar_id'];
                  $acc_tampil_kar_pos=$acc->acc_tampil_kar($kar_id_pos);
                  $acc_data_pos=mysql_fetch_array($acc_tampil_kar_pos);
        				?>
                  <tr>
                    <td><?php echo $acc_data_pos['acc_username']; ?></td>
                    <td><?php echo $data['kar_nm']; ?></td>
                    <td><?php echo $data['ntf_act']; ?></td>
                    <td><span data-toggle="tooltip" title="<?php echo strip_tags(substr(str_replace('"','',$data['ntf_isi']),0,50));?>" style="cursor:pointer">... <i class="fa fa-external-link"></i></span></td>
                    <td><?php echo $data['ntf_ip']; ?></td>
                    <td><?php echo $tgl->tgl_indo($data['ntf_tgl']); ?></td>
                    <td><?php echo $data['ntf_jam']; ?></td>
                  </tr>
                <?php $i++;}}?>  
                </tbody>      
                <tfoot>
                  <tr>
                    <th>Username</th>
                    <th>Nama</th>
                    <th>Action</th>
                    <th>Transfer</th>
                    <th>IP Address</th>
                    <th>Tgl</th>
                    <th>Jam</th>
                  </tr>
                </tfoot>
              </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
	  </form>
	  
        </div>
        <!-- /.col -->
	
	<div class="col-md-12">
	  <form class="form-horizontal" action="" method="post">
          <div class="box box-danger">
            <div class="box-header">
              <h3 class="box-title">Last Action Monitoring <small><?php echo $tgl->tgl_indo($kemarin); ?></small></h3>
	      <!-- tools box -->
                  <div class="pull-right box-tools">
		    <button onclick="return confirm('Are you sure for clear all Last Action?');" type="submit" name="bhapus_semua" id="bhapus_semua" data-toggle="tooltip" title="Delete All" class="btn btn-danger btn-sm"><i class="fa fa-recycle"></i></button>
                    <button class="btn btn-info btn-sm" data-widget='collapse' data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
                    <button class="btn btn-info btn-sm" data-widget='remove' data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
                  </div><!-- /. tools -->
	    </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example" class="table table-bordered table-striped table-hover">
                <thead>
                  <tr>
                    <th>Username</th>
                    <th>Nama</th>
                    <th>Action</th>
                    <th>Transfer</th>
                    <th>IP Address</th>
                    <th>Tgl</th>
                    <th>Jam</th>
                  </tr>
                </thead>
                <tbody>
                <?php
                $tanggal=$kemarin;
                $ntf_tampil=$ntf->ntf_tampil($tanggal);
                if($ntf_tampil){
                  $i=0;
                foreach($ntf_tampil as $data){

                  $kar_id_pos=$data['kar_id'];
                  $acc_tampil_kar_pos=$acc->acc_tampil_kar($kar_id_pos);
                  $acc_data_pos=mysql_fetch_array($acc_tampil_kar_pos);
                ?>
                  <tr>
                    <td><?php echo $acc_data_pos['acc_username']; ?></td>
                    <td><?php echo $data['kar_nm']; ?></td>
                    <td><?php echo $data['ntf_act']; ?></td>
                    <td><span data-toggle="tooltip" title="<?php echo strip_tags(substr(str_replace('"','',$data['ntf_isi']),0,50));?>" style="cursor:pointer">... <i class="fa fa-external-link"></i></span></td>
                    <td><?php echo $data['ntf_ip']; ?></td>
                    <td><?php echo $tgl->tgl_indo($data['ntf_tgl']); ?></td>
                    <td><?php echo $data['ntf_jam']; ?></td>
                  </tr>
                <?php $i++;}}?>  
                </tbody>      
                <tfoot>
                  <tr>
                    <th>Username</th>
                    <th>Nama</th>
                    <th>Action</th>
                    <th>Transfer</th>
                    <th>IP Address</th>
                    <th>Tgl</th>
                    <th>Jam</th>
                  </tr>
                </tfoot>
              </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
	  </form>
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row --> 
      
    </section>
    <!-- /.content --> 
    
