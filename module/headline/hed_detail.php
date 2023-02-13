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
        <!-- left column -->
            <div class="col-md-6">
              <!-- general form elements -->
              <div class="box box-primary">
              <!-- form start -->
               <form class="form-horizontal" action="" method="post">
                <div class="box-header">
                  <h3 class="box-title"><?php echo $hed_data['hed_sbj'];?></h3>
                  	<div class="pull-right box-tools">
                      <button type="submit" name="bupdate" id="bupdate" class="btn btn-primary"><i class="fa fa-save"></i></button>
                      <button type="button" id="edit" class="btn btn-primary"><i class="fa fa-pencil"></i></button>
                    </div>
                </div><!-- /.box-header -->
                  <div class="box-body">
                    <div class="form-group">
            <label for="hed_sbj" class="col-sm-2 control-label">Subject</label>
            <div class="col-sm-10">
              <input type="text" name="hed_sbj" value="<?php echo $hed_data['hed_sbj'];?>" class="form-control" id="hed_sbj" placeholder="Subject" required disabled>
            </div>
          </div>
	  <div class="form-group">
            <label for="hed_msg" class="col-sm-2 control-label">Message</label>
            <div class="col-sm-10">
              <textarea name="hed_msg" id="hed_msg" class="form-control" rows="3"  placeholder="Message" required><?php echo $hed_data['hed_msg'];?></textarea>
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
				  }elseif($data['mrk_nm']=="Info"){
				    $lbl="primary";
				  }elseif($data['mrk_nm']=="Warning"){
				    $lbl="warning";
				  }
				  
				  if($hed_data['mrk_id']==$data['mrk_id']){
				  
				?>
				<input type="radio" name="mrk_id" value="<?php echo $data['mrk_id']; ?>" class="flat-red" id="mrk_id" checked /> <span class="label label-<?php echo $lbl;?>"><?php echo $data['mrk_nm']; ?></span> &nbsp;
				<?php
				}else{
				?>
				<input type="radio" name="mrk_id" value="<?php echo $data['mrk_id']; ?>" class="flat-red" id="mrk_id" /> <span class="label label-<?php echo $lbl;?>"><?php echo $data['mrk_nm']; ?></span> &nbsp;
				<?php }}?>
            </div>   
          </div>
	  <div class="form-group">
            <label for="div_id" class="col-sm-2 control-label">From</label>
            <div class="col-sm-10">
              <select class="form-control" name="div_id" id="div_id" required disabled>
              	<?php
                        $div_tampil=$div->div_tampil();
                        foreach($div_tampil as $data){	
						if($hed_data['div_id']==$data['div_id']){
                        ?>
                        <option value="<?php echo $data['div_id']; ?>" selected><?php echo $data['div_nm']; ?></option>
                        <?php
						}else{
						?>
                        <option value="<?php echo $data['div_id']; ?>"><?php echo $data['div_nm']; ?></option>
                <?php }}?>
              </select>
            </div>
          </div> 
                  </div><!-- /.box-body -->

                  <div class="box-footer">
                    <!-- apa gitu -->
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