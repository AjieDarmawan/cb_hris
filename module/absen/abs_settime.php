<?php require('module/absen/abs_act.php'); ?>
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
        <div class="col-md-4">
	  
	  <form class="form-horizontal" action="" method="post">
          <div class="box box-info">
            <?php
              $abs_stm_nm="Jam Telat Pagi";
              $abs_settime_id=$abs->abs_settime_id($abs_stm_nm);
              $abs_settime_data=mysql_fetch_array($abs_settime_id);
              $abs_settime_pecah=explode(":", $abs_settime_data['abs_stm_jam']);
              $abs_settime_h=$abs_settime_pecah[0];
              $abs_settime_i=$abs_settime_pecah[1];
              $abs_settime_s=$abs_settime_pecah[2];
            ?>
            <div class="box-header">
              <h3 class="box-title"><?php echo $abs_settime_data['abs_stm_nm'];?></h3>
	      <!-- tools box -->
                  <div class="pull-right box-tools">
		    <button type="submit" name="bupdate_telat_pagi" id="bupdate_telat_pagi" class="btn btn-primary btn-sm"><i class="fa fa-save"></i></button>
                    <button class="btn btn-info btn-sm" data-widget='collapse' data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
                    <button class="btn btn-info btn-sm" data-widget='remove' data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
                  </div><!-- /. tools -->
	    </div>
            <!-- /.box-header -->
            <div class="box-body">
              <div class="bootstrap-timepicker">
                    <div class="form-group">
                      
                      <div class="col-sm-12">
                      <div class="input-group">
                        <input name="jam_telat_pagi" type="text" value="<?php echo $abs_settime_data['abs_stm_jam'];?>" data-default-time="<?php echo $abs_settime_data['abs_stm_jam'];?>" class="form-control timepicker"/>
                        <input name="abs_stm_id" type="hidden" value="<?php echo $abs_settime_data['abs_stm_id'];?>">
                        <div class="input-group-addon">
                          <i class="fa fa-clock-o"></i>
                        </div>
                      </div><!-- /.input group -->
                    </div>

                    </div><!-- /.form group -->
                  </div>

                  <div class="row">

                    <div class="col-md-12 text-center">
                      <input type="text" class="knob" value="<?php echo $abs_settime_h;?>" data-skin="tron" data-thickness="0.1" data-width="90" data-height="90" data-fgColor="#f56954"/>
                      <input type="text" class="knob" value="<?php echo $abs_settime_i;?>" data-skin="tron" data-thickness="0.1" data-width="90" data-height="90" data-fgColor="#00a65a"/>
                      <input type="text" class="knob" value="<?php echo $abs_settime_s;?>" data-skin="tron" data-thickness="0.1" data-width="90" data-height="90" data-fgColor="#3c8dbc"/>
                    </div><!-- ./col -->

                  </div><!-- /.row -->


            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
	  </form>
	  
	  <form class="form-horizontal" action="" method="post">
	  <div class="box box-warning">
    <?php
              $abs_stm_nm="Jam Telat Siang";
              $abs_settime_id=$abs->abs_settime_id($abs_stm_nm);
              $abs_settime_data=mysql_fetch_array($abs_settime_id);
              $abs_settime_pecah=explode(":", $abs_settime_data['abs_stm_jam']);
              $abs_settime_h=$abs_settime_pecah[0];
              $abs_settime_i=$abs_settime_pecah[1];
              $abs_settime_s=$abs_settime_pecah[2];
            ?>
            <div class="box-header">
              <h3 class="box-title"><?php echo $abs_settime_data['abs_stm_nm'];?></h3>
	      <!-- tools box -->
                  <div class="pull-right box-tools">
		    <button type="submit" name="bupdate_telat_siang" id="bupdate_telat_siang" class="btn btn-primary btn-sm"><i class="fa fa-save"></i></button>
                    <button class="btn btn-info btn-sm" data-widget='collapse' data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
                    <button class="btn btn-info btn-sm" data-widget='remove' data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
                  </div><!-- /. tools -->
	    </div>
            <!-- /.box-header -->
            <div class="box-body">
              <!-- time Picker -->
                  <div class="bootstrap-timepicker">
                    <div class="form-group">
                      
                      <div class="col-sm-12">
                      <div class="input-group">
                        <input name="jam_telat_siang" type="text" value="<?php echo $abs_settime_data['abs_stm_jam'];?>" data-default-time="<?php echo $abs_settime_data['abs_stm_jam'];?>" class="form-control timepicker"/>
                        <input name="abs_stm_id" type="hidden" value="<?php echo $abs_settime_data['abs_stm_id'];?>">
                        <div class="input-group-addon">
                          <i class="fa fa-clock-o"></i>
                        </div>
                      </div><!-- /.input group -->
                    </div>

                    </div><!-- /.form group -->
                  </div>

                  <div class="row">

                    <div class="col-md-12 text-center">
                      <input type="text" class="knob" value="<?php echo $abs_settime_h;?>" data-skin="tron" data-thickness="0.1" data-width="90" data-height="90" data-fgColor="#f56954"/>
                      <input type="text" class="knob" value="<?php echo $abs_settime_i;?>" data-skin="tron" data-thickness="0.1" data-width="90" data-height="90" data-fgColor="#00a65a"/>
                      <input type="text" class="knob" value="<?php echo $abs_settime_s;?>" data-skin="tron" data-thickness="0.1" data-width="90" data-height="90" data-fgColor="#3c8dbc"/>
                    </div><!-- ./col -->

                  </div><!-- /.row -->

            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
	  </form>
	  
	  <form class="form-horizontal" action="" method="post">
          <div class="box box-success">
          <?php
              $abs_stm_nm="Jam Telat Sore";
              $abs_settime_id=$abs->abs_settime_id($abs_stm_nm);
              $abs_settime_data=mysql_fetch_array($abs_settime_id);
              $abs_settime_pecah=explode(":", $abs_settime_data['abs_stm_jam']);
              $abs_settime_h=$abs_settime_pecah[0];
              $abs_settime_i=$abs_settime_pecah[1];
              $abs_settime_s=$abs_settime_pecah[2];
            ?>
            <div class="box-header">
              <h3 class="box-title"><?php echo $abs_settime_data['abs_stm_nm'];?></h3>
	      <!-- tools box -->
                  <div class="pull-right box-tools">
		    <button type="submit" name="bupdate_telat_sore" id="bupdate_telat_sore" class="btn btn-primary btn-sm"><i class="fa fa-save"></i></button>
                    <button class="btn btn-info btn-sm" data-widget='collapse' data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
                    <button class="btn btn-info btn-sm" data-widget='remove' data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
                  </div><!-- /. tools -->
	    </div>
            <!-- /.box-header -->
            <div class="box-body">
              <!-- time Picker -->
                  <div class="bootstrap-timepicker">
                    <div class="form-group">
                      
                      <div class="col-sm-12">
                      <div class="input-group">
                        <input name="jam_telat_sore" type="text" value="<?php echo $abs_settime_data['abs_stm_jam'];?>" data-default-time="<?php echo $abs_settime_data['abs_stm_jam'];?>" class="form-control timepicker"/>
                        <input name="abs_stm_id" type="hidden" value="<?php echo $abs_settime_data['abs_stm_id'];?>">
                        <div class="input-group-addon">
                          <i class="fa fa-clock-o"></i>
                        </div>
                      </div><!-- /.input group -->
                    </div>

                    </div><!-- /.form group -->
                  </div>

                  <div class="row">

                    <div class="col-md-12 text-center">
                      <input type="text" class="knob" value="<?php echo $abs_settime_h;?>" data-skin="tron" data-thickness="0.1" data-width="90" data-height="90" data-fgColor="#f56954"/>
                      <input type="text" class="knob" value="<?php echo $abs_settime_i;?>" data-skin="tron" data-thickness="0.1" data-width="90" data-height="90" data-fgColor="#00a65a"/>
                      <input type="text" class="knob" value="<?php echo $abs_settime_s;?>" data-skin="tron" data-thickness="0.1" data-width="90" data-height="90" data-fgColor="#3c8dbc"/>
                    </div><!-- ./col -->

                  </div><!-- /.row -->

            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
	  </form>

    <form class="form-horizontal" action="" method="post">
          <div class="box box-danger">
          <?php
              $abs_stm_nm="Jam Telat Malam";
              $abs_settime_id=$abs->abs_settime_id($abs_stm_nm);
              $abs_settime_data=mysql_fetch_array($abs_settime_id);
              $abs_settime_pecah=explode(":", $abs_settime_data['abs_stm_jam']);
              $abs_settime_h=$abs_settime_pecah[0];
              $abs_settime_i=$abs_settime_pecah[1];
              $abs_settime_s=$abs_settime_pecah[2];
            ?>
            <div class="box-header">
              <h3 class="box-title"><?php echo $abs_settime_data['abs_stm_nm'];?></h3>
        <!-- tools box -->
                  <div class="pull-right box-tools">
        <button type="submit" name="bupdate_telat_malam" id="bupdate_telat_malam" class="btn btn-primary btn-sm"><i class="fa fa-save"></i></button>
                    <button class="btn btn-info btn-sm" data-widget='collapse' data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
                    <button class="btn btn-info btn-sm" data-widget='remove' data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
                  </div><!-- /. tools -->
      </div>
            <!-- /.box-header -->
            <div class="box-body">
              <!-- time Picker -->
                  <div class="bootstrap-timepicker">
                    <div class="form-group">
                      
                      <div class="col-sm-12">
                      <div class="input-group">
                        <input name="jam_telat_malam" type="text" value="<?php echo $abs_settime_data['abs_stm_jam'];?>" data-default-time="<?php echo $abs_settime_data['abs_stm_jam'];?>" class="form-control timepicker"/>
                        <input name="abs_stm_id" type="hidden" value="<?php echo $abs_settime_data['abs_stm_id'];?>">
                        <div class="input-group-addon">
                          <i class="fa fa-clock-o"></i>
                        </div>
                      </div><!-- /.input group -->
                    </div>

                    </div><!-- /.form group -->
                  </div>

                  <div class="row">

                    <div class="col-md-12 text-center">
                      <input type="text" class="knob" value="<?php echo $abs_settime_h;?>" data-skin="tron" data-thickness="0.1" data-width="90" data-height="90" data-fgColor="#f56954"/>
                      <input type="text" class="knob" value="<?php echo $abs_settime_i;?>" data-skin="tron" data-thickness="0.1" data-width="90" data-height="90" data-fgColor="#00a65a"/>
                      <input type="text" class="knob" value="<?php echo $abs_settime_s;?>" data-skin="tron" data-thickness="0.1" data-width="90" data-height="90" data-fgColor="#3c8dbc"/>
                    </div><!-- ./col -->

                  </div><!-- /.row -->
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </form>
	  
	  
	  
        </div>
        <!-- /.col -->
<!------------------------------------------------------------------------------->

	<div class="col-md-4">
	  
	  
	  <form class="form-horizontal" action="" method="post">
          <div class="box box-info">
            <?php
              $abs_stm_nm="Jam Cepat Pagi";
              $abs_settime_id=$abs->abs_settime_id($abs_stm_nm);
              $abs_settime_data=mysql_fetch_array($abs_settime_id);
              $abs_settime_pecah=explode(":", $abs_settime_data['abs_stm_jam']);
              $abs_settime_h=$abs_settime_pecah[0];
              $abs_settime_i=$abs_settime_pecah[1];
              $abs_settime_s=$abs_settime_pecah[2];
            ?>
            <div class="box-header">
              <h3 class="box-title"><?php echo $abs_settime_data['abs_stm_nm'];?></h3>
	      <!-- tools box -->
                  <div class="pull-right box-tools">
		    <button type="submit" name="bupdate_cepat_pagi" id="bupdate_cepat_pagi" class="btn btn-primary btn-sm"><i class="fa fa-save"></i></button>
                    <button class="btn btn-info btn-sm" data-widget='collapse' data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
                    <button class="btn btn-info btn-sm" data-widget='remove' data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
                  </div><!-- /. tools -->
	    </div>
            <!-- /.box-header -->
            <div class="box-body">
              <div class="bootstrap-timepicker">
                    <div class="form-group">
                      
                      <div class="col-sm-12">
                      <div class="input-group">
                        <input name="jam_cepat_pagi" type="text" value="<?php echo $abs_settime_data['abs_stm_jam'];?>" data-default-time="<?php echo $abs_settime_data['abs_stm_jam'];?>" class="form-control timepicker"/>
                        <input name="abs_stm_id" type="hidden" value="<?php echo $abs_settime_data['abs_stm_id'];?>">
                        <div class="input-group-addon">
                          <i class="fa fa-clock-o"></i>
                        </div>
                      </div><!-- /.input group -->
                    </div>

                    </div><!-- /.form group -->
                  </div>

                  <div class="row">

                    <div class="col-md-12 text-center">
                      <input type="text" class="knob" value="<?php echo $abs_settime_h;?>" data-skin="tron" data-thickness="0.1" data-width="90" data-height="90" data-fgColor="#f56954"/>
                      <input type="text" class="knob" value="<?php echo $abs_settime_i;?>" data-skin="tron" data-thickness="0.1" data-width="90" data-height="90" data-fgColor="#00a65a"/>
                      <input type="text" class="knob" value="<?php echo $abs_settime_s;?>" data-skin="tron" data-thickness="0.1" data-width="90" data-height="90" data-fgColor="#3c8dbc"/>
                    </div><!-- ./col -->

                  </div><!-- /.row -->


            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
	  </form>
	  
	  <form class="form-horizontal" action="" method="post">
	  <div class="box box-warning">
    <?php
              $abs_stm_nm="Jam Cepat Siang";
              $abs_settime_id=$abs->abs_settime_id($abs_stm_nm);
              $abs_settime_data=mysql_fetch_array($abs_settime_id);
              $abs_settime_pecah=explode(":", $abs_settime_data['abs_stm_jam']);
              $abs_settime_h=$abs_settime_pecah[0];
              $abs_settime_i=$abs_settime_pecah[1];
              $abs_settime_s=$abs_settime_pecah[2];
            ?>
            <div class="box-header">
              <h3 class="box-title"><?php echo $abs_settime_data['abs_stm_nm'];?></h3>
	      <!-- tools box -->
                  <div class="pull-right box-tools">
		    <button type="submit" name="bupdate_cepat_siang" id="bupdate_cepat_siang" class="btn btn-primary btn-sm"><i class="fa fa-save"></i></button>
                    <button class="btn btn-info btn-sm" data-widget='collapse' data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
                    <button class="btn btn-info btn-sm" data-widget='remove' data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
                  </div><!-- /. tools -->
	    </div>
            <!-- /.box-header -->
            <div class="box-body">
              <!-- time Picker -->
                  <div class="bootstrap-timepicker">
                    <div class="form-group">
                      
                      <div class="col-sm-12">
                      <div class="input-group">
                        <input name="jam_cepat_siang" type="text" value="<?php echo $abs_settime_data['abs_stm_jam'];?>" data-default-time="<?php echo $abs_settime_data['abs_stm_jam'];?>" class="form-control timepicker"/>
                        <input name="abs_stm_id" type="hidden" value="<?php echo $abs_settime_data['abs_stm_id'];?>">
                        <div class="input-group-addon">
                          <i class="fa fa-clock-o"></i>
                        </div>
                      </div><!-- /.input group -->
                    </div>

                    </div><!-- /.form group -->
                  </div>

                  <div class="row">

                    <div class="col-md-12 text-center">
                      <input type="text" class="knob" value="<?php echo $abs_settime_h;?>" data-skin="tron" data-thickness="0.1" data-width="90" data-height="90" data-fgColor="#f56954"/>
                      <input type="text" class="knob" value="<?php echo $abs_settime_i;?>" data-skin="tron" data-thickness="0.1" data-width="90" data-height="90" data-fgColor="#00a65a"/>
                      <input type="text" class="knob" value="<?php echo $abs_settime_s;?>" data-skin="tron" data-thickness="0.1" data-width="90" data-height="90" data-fgColor="#3c8dbc"/>
                    </div><!-- ./col -->

                  </div><!-- /.row -->

            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
	  </form>
	  
	  <form class="form-horizontal" action="" method="post">
          <div class="box box-success">
          <?php
              $abs_stm_nm="Jam Cepat Sore";
              $abs_settime_id=$abs->abs_settime_id($abs_stm_nm);
              $abs_settime_data=mysql_fetch_array($abs_settime_id);
              $abs_settime_pecah=explode(":", $abs_settime_data['abs_stm_jam']);
              $abs_settime_h=$abs_settime_pecah[0];
              $abs_settime_i=$abs_settime_pecah[1];
              $abs_settime_s=$abs_settime_pecah[2];
            ?>
            <div class="box-header">
              <h3 class="box-title"><?php echo $abs_settime_data['abs_stm_nm'];?></h3>
	      <!-- tools box -->
                  <div class="pull-right box-tools">
		    <button type="submit" name="bupdate_cepat_sore" id="bupdate_cepat_sore" class="btn btn-primary btn-sm"><i class="fa fa-save"></i></button>
                    <button class="btn btn-info btn-sm" data-widget='collapse' data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
                    <button class="btn btn-info btn-sm" data-widget='remove' data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
                  </div><!-- /. tools -->
	    </div>
            <!-- /.box-header -->
            <div class="box-body">
              <!-- time Picker -->
                  <div class="bootstrap-timepicker">
                    <div class="form-group">
                      
                      <div class="col-sm-12">
                      <div class="input-group">
                        <input name="jam_cepat_sore" type="text" value="<?php echo $abs_settime_data['abs_stm_jam'];?>" data-default-time="<?php echo $abs_settime_data['abs_stm_jam'];?>" class="form-control timepicker"/>
                        <input name="abs_stm_id" type="hidden" value="<?php echo $abs_settime_data['abs_stm_id'];?>">
                        <div class="input-group-addon">
                          <i class="fa fa-clock-o"></i>
                        </div>
                      </div><!-- /.input group -->
                    </div>

                    </div><!-- /.form group -->
                  </div>

                  <div class="row">

                    <div class="col-md-12 text-center">
                      <input type="text" class="knob" value="<?php echo $abs_settime_h;?>" data-skin="tron" data-thickness="0.1" data-width="90" data-height="90" data-fgColor="#f56954"/>
                      <input type="text" class="knob" value="<?php echo $abs_settime_i;?>" data-skin="tron" data-thickness="0.1" data-width="90" data-height="90" data-fgColor="#00a65a"/>
                      <input type="text" class="knob" value="<?php echo $abs_settime_s;?>" data-skin="tron" data-thickness="0.1" data-width="90" data-height="90" data-fgColor="#3c8dbc"/>
                    </div><!-- ./col -->

                  </div><!-- /.row -->

            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
	  </form>

    <form class="form-horizontal" action="" method="post">
          <div class="box box-danger">
          <?php
              $abs_stm_nm="Jam Cepat Malam";
              $abs_settime_id=$abs->abs_settime_id($abs_stm_nm);
              $abs_settime_data=mysql_fetch_array($abs_settime_id);
              $abs_settime_pecah=explode(":", $abs_settime_data['abs_stm_jam']);
              $abs_settime_h=$abs_settime_pecah[0];
              $abs_settime_i=$abs_settime_pecah[1];
              $abs_settime_s=$abs_settime_pecah[2];
            ?>
            <div class="box-header">
              <h3 class="box-title"><?php echo $abs_settime_data['abs_stm_nm'];?></h3>
        <!-- tools box -->
                  <div class="pull-right box-tools">
        <button type="submit" name="bupdate_cepat_malam" id="bupdate_cepat_malam" class="btn btn-primary btn-sm"><i class="fa fa-save"></i></button>
                    <button class="btn btn-info btn-sm" data-widget='collapse' data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
                    <button class="btn btn-info btn-sm" data-widget='remove' data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
                  </div><!-- /. tools -->
      </div>
            <!-- /.box-header -->
            <div class="box-body">
              <!-- time Picker -->
                  <div class="bootstrap-timepicker">
                    <div class="form-group">
                      
                      <div class="col-sm-12">
                      <div class="input-group">
                        <input name="jam_cepat_malam" type="text" value="<?php echo $abs_settime_data['abs_stm_jam'];?>" data-default-time="<?php echo $abs_settime_data['abs_stm_jam'];?>" class="form-control timepicker"/>
                        <input name="abs_stm_id" type="hidden" value="<?php echo $abs_settime_data['abs_stm_id'];?>">
                        <div class="input-group-addon">
                          <i class="fa fa-clock-o"></i>
                        </div>
                      </div><!-- /.input group -->
                    </div>

                    </div><!-- /.form group -->
                  </div>

                  <div class="row">

                    <div class="col-md-12 text-center">
                      <input type="text" class="knob" value="<?php echo $abs_settime_h;?>" data-skin="tron" data-thickness="0.1" data-width="90" data-height="90" data-fgColor="#f56954"/>
                      <input type="text" class="knob" value="<?php echo $abs_settime_i;?>" data-skin="tron" data-thickness="0.1" data-width="90" data-height="90" data-fgColor="#00a65a"/>
                      <input type="text" class="knob" value="<?php echo $abs_settime_s;?>" data-skin="tron" data-thickness="0.1" data-width="90" data-height="90" data-fgColor="#3c8dbc"/>
                    </div><!-- ./col -->

                  </div><!-- /.row -->
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
    </form>
	  
	  
        </div>
        <!-- /.col -->
		
		<div class="col-md-4">
	  
	  <form class="form-horizontal" action="" method="post">
          <div class="box box-info">
            <?php
              $abs_stm_nm="Jam Tepat Pagi";
              $abs_settime_id=$abs->abs_settime_id($abs_stm_nm);
              $abs_settime_data=mysql_fetch_array($abs_settime_id);
              $abs_settime_pecah=explode(":", $abs_settime_data['abs_stm_jam']);
              $abs_settime_h=$abs_settime_pecah[0];
              $abs_settime_i=$abs_settime_pecah[1];
              $abs_settime_s=$abs_settime_pecah[2];
            ?>
            <div class="box-header">
              <h3 class="box-title"><?php echo $abs_settime_data['abs_stm_nm'];?></h3>
	      <!-- tools box -->
                  <div class="pull-right box-tools">
		    <button type="submit" name="bupdate_tepat_pagi" id="bupdate_tepat_pagi" class="btn btn-primary btn-sm"><i class="fa fa-save"></i></button>
                    <button class="btn btn-info btn-sm" data-widget='collapse' data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
                    <button class="btn btn-info btn-sm" data-widget='remove' data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
                  </div><!-- /. tools -->
	    </div>
            <!-- /.box-header -->
            <div class="box-body">
              <div class="bootstrap-timepicker">
                    <div class="form-group">
                      
                      <div class="col-sm-12">
                      <div class="input-group">
                        <input name="jam_tepat_pagi" type="text" value="<?php echo $abs_settime_data['abs_stm_jam'];?>" data-default-time="<?php echo $abs_settime_data['abs_stm_jam'];?>" class="form-control timepicker"/>
                        <input name="abs_stm_id" type="hidden" value="<?php echo $abs_settime_data['abs_stm_id'];?>">
                        <div class="input-group-addon">
                          <i class="fa fa-clock-o"></i>
                        </div>
                      </div><!-- /.input group -->
                    </div>

                    </div><!-- /.form group -->
                  </div>

                  <div class="row">

                    <div class="col-md-12 text-center">
                      <input type="text" class="knob" value="<?php echo $abs_settime_h;?>" data-skin="tron" data-thickness="0.1" data-width="90" data-height="90" data-fgColor="#f56954"/>
                      <input type="text" class="knob" value="<?php echo $abs_settime_i;?>" data-skin="tron" data-thickness="0.1" data-width="90" data-height="90" data-fgColor="#00a65a"/>
                      <input type="text" class="knob" value="<?php echo $abs_settime_s;?>" data-skin="tron" data-thickness="0.1" data-width="90" data-height="90" data-fgColor="#3c8dbc"/>
                    </div><!-- ./col -->

                  </div><!-- /.row -->


            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
	  </form>
	  
	  <form class="form-horizontal" action="" method="post">
	  <div class="box box-warning">
    <?php
              $abs_stm_nm="Jam Tepat Siang";
              $abs_settime_id=$abs->abs_settime_id($abs_stm_nm);
              $abs_settime_data=mysql_fetch_array($abs_settime_id);
              $abs_settime_pecah=explode(":", $abs_settime_data['abs_stm_jam']);
              $abs_settime_h=$abs_settime_pecah[0];
              $abs_settime_i=$abs_settime_pecah[1];
              $abs_settime_s=$abs_settime_pecah[2];
            ?>
            <div class="box-header">
              <h3 class="box-title"><?php echo $abs_settime_data['abs_stm_nm'];?></h3>
	      <!-- tools box -->
                  <div class="pull-right box-tools">
		    <button type="submit" name="bupdate_tepat_siang" id="bupdate_tepat_siang" class="btn btn-primary btn-sm"><i class="fa fa-save"></i></button>
                    <button class="btn btn-info btn-sm" data-widget='collapse' data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
                    <button class="btn btn-info btn-sm" data-widget='remove' data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
                  </div><!-- /. tools -->
	    </div>
            <!-- /.box-header -->
            <div class="box-body">
              <!-- time Picker -->
                  <div class="bootstrap-timepicker">
                    <div class="form-group">
                      
                      <div class="col-sm-12">
                      <div class="input-group">
                        <input name="jam_tepat_siang" type="text" value="<?php echo $abs_settime_data['abs_stm_jam'];?>" data-default-time="<?php echo $abs_settime_data['abs_stm_jam'];?>" class="form-control timepicker"/>
                        <input name="abs_stm_id" type="hidden" value="<?php echo $abs_settime_data['abs_stm_id'];?>">
                        <div class="input-group-addon">
                          <i class="fa fa-clock-o"></i>
                        </div>
                      </div><!-- /.input group -->
                    </div>

                    </div><!-- /.form group -->
                  </div>

                  <div class="row">

                    <div class="col-md-12 text-center">
                      <input type="text" class="knob" value="<?php echo $abs_settime_h;?>" data-skin="tron" data-thickness="0.1" data-width="90" data-height="90" data-fgColor="#f56954"/>
                      <input type="text" class="knob" value="<?php echo $abs_settime_i;?>" data-skin="tron" data-thickness="0.1" data-width="90" data-height="90" data-fgColor="#00a65a"/>
                      <input type="text" class="knob" value="<?php echo $abs_settime_s;?>" data-skin="tron" data-thickness="0.1" data-width="90" data-height="90" data-fgColor="#3c8dbc"/>
                    </div><!-- ./col -->

                  </div><!-- /.row -->

            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
	  </form>
	  
	  <form class="form-horizontal" action="" method="post">
          <div class="box box-success">
          <?php
              $abs_stm_nm="Jam Tepat Sore";
              $abs_settime_id=$abs->abs_settime_id($abs_stm_nm);
              $abs_settime_data=mysql_fetch_array($abs_settime_id);
              $abs_settime_pecah=explode(":", $abs_settime_data['abs_stm_jam']);
              $abs_settime_h=$abs_settime_pecah[0];
              $abs_settime_i=$abs_settime_pecah[1];
              $abs_settime_s=$abs_settime_pecah[2];
            ?>
            <div class="box-header">
              <h3 class="box-title"><?php echo $abs_settime_data['abs_stm_nm'];?></h3>
	      <!-- tools box -->
                  <div class="pull-right box-tools">
		    <button type="submit" name="bupdate_tepat_sore" id="bupdate_tepat_sore" class="btn btn-primary btn-sm"><i class="fa fa-save"></i></button>
                    <button class="btn btn-info btn-sm" data-widget='collapse' data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
                    <button class="btn btn-info btn-sm" data-widget='remove' data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
                  </div><!-- /. tools -->
	    </div>
            <!-- /.box-header -->
            <div class="box-body">
              <!-- time Picker -->
                  <div class="bootstrap-timepicker">
                    <div class="form-group">
                      
                      <div class="col-sm-12">
                      <div class="input-group">
                        <input name="jam_tepat_sore" type="text" value="<?php echo $abs_settime_data['abs_stm_jam'];?>" data-default-time="<?php echo $abs_settime_data['abs_stm_jam'];?>" class="form-control timepicker"/>
                        <input name="abs_stm_id" type="hidden" value="<?php echo $abs_settime_data['abs_stm_id'];?>">
                        <div class="input-group-addon">
                          <i class="fa fa-clock-o"></i>
                        </div>
                      </div><!-- /.input group -->
                    </div>

                    </div><!-- /.form group -->
                  </div>

                  <div class="row">

                    <div class="col-md-12 text-center">
                      <input type="text" class="knob" value="<?php echo $abs_settime_h;?>" data-skin="tron" data-thickness="0.1" data-width="90" data-height="90" data-fgColor="#f56954"/>
                      <input type="text" class="knob" value="<?php echo $abs_settime_i;?>" data-skin="tron" data-thickness="0.1" data-width="90" data-height="90" data-fgColor="#00a65a"/>
                      <input type="text" class="knob" value="<?php echo $abs_settime_s;?>" data-skin="tron" data-thickness="0.1" data-width="90" data-height="90" data-fgColor="#3c8dbc"/>
                    </div><!-- ./col -->

                  </div><!-- /.row -->

            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
	  </form>

    <form class="form-horizontal" action="" method="post">
          <div class="box box-danger">
          <?php
              $abs_stm_nm="Jam Tepat Malam";
              $abs_settime_id=$abs->abs_settime_id($abs_stm_nm);
              $abs_settime_data=mysql_fetch_array($abs_settime_id);
              $abs_settime_pecah=explode(":", $abs_settime_data['abs_stm_jam']);
              $abs_settime_h=$abs_settime_pecah[0];
              $abs_settime_i=$abs_settime_pecah[1];
              $abs_settime_s=$abs_settime_pecah[2];
            ?>
            <div class="box-header">
              <h3 class="box-title"><?php echo $abs_settime_data['abs_stm_nm'];?></h3>
        <!-- tools box -->
                  <div class="pull-right box-tools">
        <button type="submit" name="bupdate_tepat_malam" id="bupdate_tepat_malam" class="btn btn-primary btn-sm"><i class="fa fa-save"></i></button>
                    <button class="btn btn-info btn-sm" data-widget='collapse' data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
                    <button class="btn btn-info btn-sm" data-widget='remove' data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
                  </div><!-- /. tools -->
      </div>
            <!-- /.box-header -->
            <div class="box-body">
              <!-- time Picker -->
                  <div class="bootstrap-timepicker">
                    <div class="form-group">
                      
                      <div class="col-sm-12">
                      <div class="input-group">
                        <input name="jam_tepat_malam" type="text" value="<?php echo $abs_settime_data['abs_stm_jam'];?>" data-default-time="<?php echo $abs_settime_data['abs_stm_jam'];?>" class="form-control timepicker"/>
                        <input name="abs_stm_id" type="hidden" value="<?php echo $abs_settime_data['abs_stm_id'];?>">
                        <div class="input-group-addon">
                          <i class="fa fa-clock-o"></i>
                        </div>
                      </div><!-- /.input group -->
                    </div>

                    </div><!-- /.form group -->
                  </div>

                  <div class="row">

                    <div class="col-md-12 text-center">
                      <input type="text" class="knob" value="<?php echo $abs_settime_h;?>" data-skin="tron" data-thickness="0.1" data-width="90" data-height="90" data-fgColor="#f56954"/>
                      <input type="text" class="knob" value="<?php echo $abs_settime_i;?>" data-skin="tron" data-thickness="0.1" data-width="90" data-height="90" data-fgColor="#00a65a"/>
                      <input type="text" class="knob" value="<?php echo $abs_settime_s;?>" data-skin="tron" data-thickness="0.1" data-width="90" data-height="90" data-fgColor="#3c8dbc"/>
                    </div><!-- ./col -->

                  </div><!-- /.row -->
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </form>
	  
	  
	  
        </div>
        <!-- /.col -->
<!------------------------------------------------------------------------------->
		
      </div>
      <!-- /.row --> 
      
    </section>
    <!-- /.content --> 
    
