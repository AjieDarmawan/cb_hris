<?php 
session_start();
require('module/po_marketing_support/marketing_act.php'); 
$kar_id  = $kar_data['kar_id'];	
$kar_nik = $kar_data['kar_nik'];
$p  = $_REQUEST['p'];
$act= $_SESSION['act'];

$aksi_download = "module/po_marketing_support/download.php?act=download&filename=template-import-marketing-support.xlsx";
	
?>

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
	  <h3 class="box-title">
	    <a class="btn btn-primary" href="#" role="button" 
		  data-toggle="modal" data-target="#myIMPORT" title="Import Data">
	      <i class="fa fa-upload" aria-hidden="true"></i> Import Data
	    </a>	
    
	    <a class="btn btn-success" href="<?php echo $aksi_download ;?>" role="button"  
		  title="Download Template PO Marketing Suport">
	      <i class="fa fa-download" aria-hidden="true"></i> Download Template 
	    </a>


	  </h3>
	</div>
	<!-- /.box-header -->
	<div class="box-body table-responsive">
	  <table id="tb_marketing" class="table table-hover table-striped table-bordered"> 
	    <thead>
	      <tr>
		<th><div style="vertical-align:middle; text-align:center;width:10px">#</div></th>
		<th><div style="vertical-align:middle; text-align:center;width:100px">Nama</div></th>
		<th><div style="vertical-align:middle; text-align:center;">No. HP</div></th>
		<th><div style="vertical-align:middle; text-align:center;">Email</div></th>
		<th><div style="vertical-align:middle; text-align:center;">Kota</div></th>
		<th><div style="vertical-align:middle; text-align:center;">Tmp. Lahir</div></th>
		<th><div style="vertical-align:middle; text-align:center;">Tgl. Lahir</div></th>
		<th><div style="vertical-align:middle; text-align:center;">Pend. Terakhir</div></th>
		<th><div style="vertical-align:middle; text-align:center;">Pekerjaan</div></th>
		<th><div style="vertical-align:middle; text-align:center;">Sumber Info</div></th>
		<th><div style="vertical-align:middle; text-align:center;">Status</div></th>
		<th style="vertical-align:middle; text-align:center;">Keterangan</th>
		<th style="vertical-align:middle; text-align:center;">Batch</th>
		<th style="vertical-align:middle; text-align:center;">Aksi</th>
	      </tr>
	    </thead>
	    <tbody>
	      
	    </tbody>
	  </table>
	</div>
      </div>
    </div>
  </div>
</section>


<!-- Modal -->
<div class="modal fade" id="myIMPORT" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header bg-primary">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel"><i class="fa fa-calendar"></i> Upload Data </h4>
      </div>
      <form class="form-horizontal" action="" method="post" enctype="multipart/form-data">
	<div class="modal-body">
	    <div class="form-group">
	      <label for="jdw_file" class="col-sm-2 control-label">File</label>
	      <div class="col-sm-10">
		<div class="btn btn-default btn-file" id="file">
		  <i class="fa fa-paperclip"></i> Attachment File
		</div>
		<input type="file" name="jdw_file" accept="application/vnd.openxmlformats-officedocument.spreadsheetml.sheet" required />			
		<!-- <small class="help-block"><em>Max. 5MB</em></small> !-->
		<br />
					
		<button type="submit" name="bimport" class="btn btn-primary visible-lg">
		  <i class="fa fa-upload"></i> Proses
		</button>
	      </div>
	    </div>
	</div>
	
	<div class="modal-footer">
	  <div class="pull-right">
	    <button type="button" class="btn btn-default " data-dismiss="modal">CLOSE</button>
	  </div>
	</div>
      </form>
    </div>
  </div>
</div>

<form role="form" class="form-horizontal" id="save_update_konten"  enctype="multipart/form-data" >  
	<div class="div_modal_2" ></div>
</form>

<link rel="stylesheet" href="plugins/sweetalert/sweetalert2.min.css"> 
<script src="plugins/jQuery/jQuery-2.1.4.min.js"></script>  
<script src="plugins/sweetalert/sweetalert2.min.js" type="text/javascript"></script>

<script src="module/po_marketing_support/ajax_marketing.js"></script>

