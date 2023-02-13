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
        <!-- left column -->
            <div class="col-md-6">
              <!-- general form elements -->
              <div class="box box-primary">
              <!-- form start -->
               <form class="form-horizontal" action="" method="post">
                <div class="box-header">
                  <h3 class="box-title"><?php echo $ip_data['ip_nm'];?></h3>
                  	<div class="pull-right box-tools">
                      <button type="submit" name="bupdate" id="bupdate" class="btn btn-primary"><i class="fa fa-save"></i></button>
                      <button type="button" id="edit" class="btn btn-primary"><i class="fa fa-pencil"></i></button>
                    </div>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <div class="form-group">
                    <label for="ip_nm" class="col-sm-2 control-label">IP</label>
                    <div class="col-sm-10">
                      <input type="text" name="ip_nm" value="<?php echo $ip_data['ip_nm'];?>" class="form-control" id="ip_nm" placeholder="IP Address" data-inputmask="'alias': 'ip'" data-mask required disabled>
                    </div>
                  </div>
		  <div class="form-group">
                    <label for="ip_dns" class="col-sm-2 control-label">DNS</label>
                    <div class="col-sm-10">
                      <input type="text" name="ip_dns" value="<?php echo $ip_data['ip_dns'];?>" class="form-control" id="ip_dns" placeholder="DNS" disabled>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="typ_id" class="col-sm-2 control-label">Type</label>
                    <div class="col-sm-10">
                        <?php
                        $typ_tampil=$typ->typ_tampil();
                        foreach($typ_tampil as $data){	
						if($ip_data['typ_id']==$data['typ_id']){
                        ?>
                        <input type="radio" name="typ_id" value="<?php echo $data['typ_id']; ?>" class="flat-red" id="typ_id1" checked /> <?php echo $data['typ_nm']; ?> &nbsp;
                        <?php
						}else{
						?>
                        <input type="radio" name="typ_id" value="<?php echo $data['typ_id']; ?>" class="flat-red" id="typ_id2" /> <?php echo $data['typ_nm']; ?> &nbsp;
                        <?php }}?>
                    </div>   
                  </div>
                  <div class="form-group">
                    <label for="unt_id" class="col-sm-2 control-label">Unit</label>
                    <div class="col-sm-10">
                      <select class="form-control" name="unt_id" id="" required disabled>
                        <?php
                        $unt_tampil=$unt->unt_tampil();
                        foreach($unt_tampil as $data){	
						if($ip_data['unt_id']==$data['unt_id']){
                        ?>
                        <option value="<?php echo $data['unt_id']; ?>" selected><?php echo $data['unt_nm']; ?></option>
                        <?php
						}else{
						?>
                        <option value="<?php echo $data['unt_id']; ?>"><?php echo $data['unt_nm']; ?></option>
                        <?php }}?>
                      </select>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="ktr_id" class="col-sm-2 control-label">Kantor</label>
                    <div class="col-sm-10">
                      <select class="form-control" name="ktr_id" id="" required disabled>
                        <?php
                        $ktr_tampil=$ktr->ktr_tampil();
                        foreach($ktr_tampil as $data){	
						if($ip_data['ktr_id']==$data['ktr_id']){
                        ?>
                        <option value="<?php echo $data['ktr_id']; ?>" selected><?php echo $data['ktr_nm']; ?></option>
                        <?php
						}else{
						?>
                        <option value="<?php echo $data['ktr_id']; ?>"><?php echo $data['ktr_nm']; ?></option>
                        <?php }}?>
                      </select>
                    </div>
                  </div>
                  </div><!-- /.box-body -->

                  <div class="box-footer">
                    <!-- apa gitu -->
					<button class="btn btn-info btn-sm" ><a href="?p=data_ip"><font color="white">BACK</font></a></button>
                  </div>
                </form>
              </div><!-- /.box -->
              
            </div><!--/.col (left) -->
            <!-- right column -->
            <div class="col-md-6">
            <!-- general form elements -->
              <div class="box box-success">
                <div class="box-header">
                  <h3 class="box-title">Under Construction</h3>
                  <!-- tools box -->
                  <div class="pull-right box-tools">
                    <button class="btn btn-info btn-sm" data-widget='collapse' data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
                    <button class="btn btn-info btn-sm" data-widget='remove' data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
                  </div><!-- /. tools -->
                </div><!-- /.box-header -->
                  <div class="box-body">
                    <!-- apa gitu -->
                  </div><!-- /.box-body -->

                  <div class="box-footer">
                    <!-- ini juga apa gitu -->
                  </div>
              </div><!-- /.box -->
            
            </div><!--/.col (right) -->
        <!-- /.col --> 
      </div>
      <!-- /.row --> 
      
      <div class="row">
        <div class="col-xs-12">
          
        </div>
        <!-- /.col --> 
      </div>
      <!-- /.row --> 
      
    </section>
    <!-- /.content --> 