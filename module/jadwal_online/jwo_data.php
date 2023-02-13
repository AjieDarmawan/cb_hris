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
        <div class="box-body">
          <?php
            $jwo_tampil=$jwd->jwo_tampil();
            while($jwo_tampil_id=mysql_fetch_assoc($jwo_tampil)){
          ?>
	  <!--<iframe width="100%" height="500" frameborder="0" scrolling="no" src="https://onedrive.live.com/embed?cid=779A07911D8DB396&resid=779A07911D8DB396%21112&authkey=AL7-9XQOaj20nW0&em=2&wdAllowInteractivity=False&wdHideGridlines=True&wdHideHeaders=True&wdDownloadButton=True"></iframe>-->
	  <iframe width="100%" height="500" frameborder="0" scrolling="no" src="<?php echo $jwo_tampil_id['jwo_kode'];?>"></iframe>
	       <?php }?>
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