<?php require('module/dashboard_fl/dash_act.php'); ?>
<!-- Content Header (Page header) -->
    <section class="content-header">
      <h1> <?php echo $title;?> <small></small> </h1>
      <ol class="breadcrumb">
        <li class="active"><i class="fa fa-dashboard"></i> <?php echo $title;?></li>
      </ol>
      <!-- <a class="btn btn-large btn-success" href="javascript:void(0);" onclick="javascript:introJs().start();">Show me how</a> -->
    </section>
    
    <!-- Main content -->
    <section class="content"> 
      <!-- Your Page Content Here -->
      <div class="row">
       <!-- Left column -->
            <div class="col-md-6 connectedSortable">
	    <?php include('module/dashboard_fl/dash_absen.php'); ?>
	    <?php //include('module/dashboard_fl/dash_absen_point2.php'); ?>
            <?php //include('module/dashboard_fl/dash_absen_history.php'); ?>
	    
            </div>
       <!--/.col (left) -->
       

       <!-- right column -->
            <div class="col-md-6 connectedSortable">
            <?php //include('module/dashboard_fl/dash_sayembara.php'); ?>
            <?php //include('module/dashboard_fl/dash_headline.php'); ?>
            <?php //include('module/dashboard_fl/dash_post.php'); ?>
            <?php //include('module/dashboard_fl/dash_archive.php'); ?>
            <?php //include('module/dashboard_fl/dash_penjadwalan.php'); ?>  
			<?php include('module/dashboard_fl/dash_perform_chart.php'); ?>
            </div>
       <!--/.col (right) -->
      </div>
      <div class="row">
        <div class="col-xs-12">
            <?php //include('module/dashboard_fl/dash_perform_chart.php'); ?> 
        </div>
        <!-- /.col --> 
      </div>
      <!-- /.row --> 
      
    </section>
    <!-- /.content --> 
    