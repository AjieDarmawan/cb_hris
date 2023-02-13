<?php require('module/data_bank/bnk_conf.php'); ?>
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

        </div>
        <!-- /.box-header -->
        <div class="box-body">

        <table id="BankDataTbl" class="table table-bordered table-striped table-hover">
            <thead>
              <tr>
				<th>No</th>
                <th>Kode rtgs</th>
                <th>Kode Kliring</th>
                <th>Kode Bank</th>
                <th>Nama Bank</th>
                <th>Singkatan</th>
                <th>Kode Branch</th>
                <th>Nama Branch</th>
                <th>Kota</th>
                <th>Aksi</th>
              </tr>
            </thead>
            <tbody></tbody>      
            <tfoot>
              <tr>
				<th>No</th>
                <th>Kode rtgs</th>
                <th>Kode Kliring</th>
                <th>Kode Bank</th>
                <th>Nama Bank</th>
                <th>Singkatan</th>
                <th>Kode Branch</th>
				<th>Nama Branch</th>
                <th>Kota</th>
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
 <div class="modal fade" id="modal-update-bank" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog text-justify">
		<div class="modal-content ">
			<div class="modal-body">
				<form role="form" id="form_bankdata_update">
					<div class="box-body">
						<h3 class="modal-title">UPDATE DATA BANK</h3>
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label for="nama_bank">Nama Bank</label>
									<input type="text" class="form-control" name="namabank" value="">
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label for="singkatan">Singkatan</label>
									<input type="text" class="form-control" name="singkatan" value="">
								</div>
							</div>
						</div>
						
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label for="kode_branch">Kode Branch</label>
									<input type="text" class="form-control" name="kodebranch" value="">
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label for="nama_branch">Nama Branch</label>
									<input type="text" class="form-control" name="namabranch" value="">
								</div>
							</div>								
						</div>
						
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label for="kota">Kota</label>
									<input type="text" class="form-control"  name="kota" value="">
								</div>
							</div>							
						</div>

					</div>
					<div class="box-footer">
						<input type="text" name="reff" value="">
						<input type="text" name="mode" value="update">
						<button type="submit" class="btn btn-primary" id="btn_act"></button>
					</div>
				</form>				
			</div>
		</div>
	</div>
</div>
<!-- Button trigger modal -->



