<?php require('module/notify/ntf_act.php'); ?>
<!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            <?php echo $title;?>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active"><?php echo $title;?></li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
          <div class="row">
	    
            <div class="col-md-6">

              <div class="box box-primary">
                <div class="box-header with-border">
                  <h3 class="box-title"><?php echo $symb_. "&nbsp;" .$ntf_data_kd_data['ntf_data_act'];?></h3>
                  <div class="pull-right box-tools"><small><i class="fa fa-calendar"></i> &nbsp;<?php echo $tgl->tgl_indo($ntf_data_kd_data['ntf_data_tgl']);?></small></div>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <p><?php echo $template_;?></p>
                </div><!-- /.box-body -->
                <div class="box-footer">
                  <button type="button" class="btn btn-sm btn-default" onclick="history.back(-1);"><i class="fa fa-chevron-left"></i> Back</button>
                  <div class="pull-right box-tools"><small class="label label-primary"><?php echo $iuser_;?> &nbsp;<?php echo $ntf_data_sumber;?></small></div>
                </div><!-- /.box-footer -->
              </div><!-- /. box -->


            </div><!-- /.col -->
          </div><!-- /.row -->
        </section><!-- /.content -->
