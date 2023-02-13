<?php require('module/kasbon_request/ksbn_conf.php'); ?>

<style>
	.custom-btn {cursor:pointer!important;}
	.custom-btn:hover {background:#eee!important;}
	.no-radius {border-radius:0px!important;}
	.left-1 {margin-left:-1!important;}
	.btn-default-trans {background-color:transparent!important;}
	
	.big-box h2 {
		text-align: center;
		width: 100%;
		font-size: 1.8em;
		letter-spacing: 2px;
		font-weight: 700;
		text-transform: uppercase;
		cursor:pointer;
	}
	
	
	.btn-default {
		background-color: transparent!important;
	}
	
	.label-payment{
		background-color: #3c0d93 !important;
	}
	
	#kasbonTbl_length{display:none;}
	#kasbonTbl_filter{display:none;}
</style>
	


<!-- Content Header (Page header) -->
<section class="content-header">
	<h1> <?php echo $title;?> <small><?php echo ucwords($_GET['t']); ?></small> </h1>
	<ol class="breadcrumb">
		<li><a href="media.php"><i class="fa fa-dashboard"></i> Dashboard</a></li>
		<li class="active"><?php echo $title;?></li>
	</ol>
</section>


<!-- Main content -->
<section class="content"> 
	<div class="row">
		<div class="col-xs-12">
			<div class="box">
				<div class="box-header" style="padding-top:15px!important;">
				
					<div class="row">
						
						<div class="col-md-9 pull-left">	
						
							<form class="form-inline" action="javascript:void(0);">	
								<div class="input-group pull-left">
									<!-- FILTER TANGGAL -->
									<span class="input-group-btn">
										<button class="btn btn-default btn-flat" type="button" title="Filter"><i class="fa fa-calendar"></i></button>
									</span>
									<input type="text" class="form-control dr-kasbon" name="filter_day" id="filter_day" title="Filter" value="<?php echo $range_now; ?>" placeholder="Day">
									
									<!-- FILTER STATUS -->
									<div class="input-group-btn">
										<button type="button" class="btn no-radius btn-default btn-default-trans dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
											<span style="min-width:100px;width: 100px;" id="label_filter_status">All Status</span>&nbsp;
											<span class="fa fa-caret-down"></span>
											<input type="hidden" name="status_kasbon" value="" />
											<input type="hidden" name="start_kasbon" value="" />
											<input type="hidden" name="end_kasbon" value="" />
										</button>
										<ul class="dropdown-menu">
											<li><a href="javascript:set_status_kasbon('', 'All Status');">All Status</a></li>
											<li><a href="javascript:set_status_kasbon('0', 'Menunggu');">Menunggu</a></li>
											<li><a href="javascript:set_status_kasbon('1', 'Disetujui');">Disetujui</a></li>
											<li><a href="javascript:set_status_kasbon('2', 'Ditolak');">Ditolak</a></li>
											<li><a href="javascript:set_status_kasbon('3', 'Dibatalkan');">Dibatalkan</a></li>
										</ul>											
									</div>
									
									<div class="input-group pull-left">
										<!-- FILTER TEXT -->
										<input type="text" class="form-control search-data-table" name="search-data">
										
										<!-- BUTTON PROCESS -->
										
										<span class="input-group-btn">
											<div class="btn-group">
												<div class="input-group">              
													<select name='length_change' id='length_change' class="selectpicker rmresetdataselect gridpage" >
														<option value='10'>10</option>
														<option value='50'>50</option>
														<option value='100'>100</option>
														<option value='200'>200</option>
														<!--<option value='-1'>All</option>-->
													</select>
												</div>
												<!--
												<button class="btn btn-default btn-flat" type="button" name="cari" onclick="__remake_datatable();">
													<i class="fa fa-search"></i>
												</button>
												-->
											</div>											
										</span>
									</div>	
								</div>
							</form>
						</div>
						
						<div class="col-md-3 pull-right">
							<!-- TOMBOL TAMBAH -->
							<button class="btn btn-primary pull-right" style="margin-right:5px;" data-toggle="modal" data-target="#modal-pengajuan-kasbon">Buat Pengajuan</button>	
						</div>
					</div>
				</div>
				<div class="box-body">
					<table id="kasbonTbl" class="table table-striped table-bordered" style="width:100%">
						<thead>
							<tr>
								<th>No</th>
								<th>Tanggal</th>
								<th>Pemohon</th>
								<th>Divisi</th>
								<th>Kampus</th>
								<th>Nominal</th>
								<th>Keperluan</th>
								<th>Catatan</th>
								<th>Status</th>
								<th>&nbsp;</th>
							</tr>
						</thead>
						<tbody id="listdata_kasbon"></tbody>
					</table>
				</div>
				<!--
				<div class="box-footer">
					<div class="alert alert-info">
						<h4><i class="icon fa fa-info"></i> Keterangan :</h4>
						1. Target Minimal Her Registrasi <strong>25 Mahasiswa Baru</strong> per bulan.<br>
						2. Terhitung Reward jika pencapaian Min. <strong>25 Mahasiswa Baru</strong> per bulan. <br>
						3. Syarat mendapatkan reward pencapaian <strong>BDC minimal 50 data</strong> per hari<br>
					</div>
				</div>
				-->
			</div>
		</div>
	</div>   
</section>
	
	
	
<!-- POPUP -->
 <div class="modal fade" id="modal-pengajuan-kasbon" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog text-justify">
		<div class="modal-content ">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
				<h3 class="modal-title" id="myModalLabel"><strong>Pengajuan Kasbon </strong>
			</div>
			<div class="modal-body">
				<form role="form" id="pengajuan_kasbon">
					<div class="box-body">
						
						<div class="row">
							<div class="col-md-4">
								<div class="form-group">
									<label for="nominal">Jumlah Rp</label>
									<input type="text" class="form-control" id="nominal" name="nominal">
								</div>
							</div>
							<div class="col-md-8">
								<div class="form-group">
									<label for="kodebank">Pembayaran</label>
									<select class="form-control selectpicker" style="width: 100%;" name="kodebank" data-live-search="true">
										<option>- PILIH -</option>
										<?php
											foreach($list_kliring as $k => $v) {
												echo '<option value="'. $v['value'] .'">'. $v['label'] .'</option>';
											}
										?>
									</select>
								</div>
							</div>					
						</div>
						
						<div class="row">
							<div class="col-md-12">
								<div class="form-group">
									<label for="exampleInputEmail1">Keperluan</label>
									<textarea class="form-control" rows="3" name="keperluan" placeholder=""></textarea>
								</div>
							</div>
						</div>
						
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label for="kantor">Kantor / Kampus</label>
									<select class="form-control selectpicker" style="width: 100%;" name="kantor" data-live-search="true">
										<option>- PILIH -</option>
										<?php
											foreach($list_kantor as $k => $v) {
												echo '<option value="'. $v['value'] .'">'. $v['label'] .'</option>';
											}
										?>
									</select>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label for="kantor">Jenis Kasbon</label>
									<select class="form-control selectpicker" style="width: 100%;" name="jeniskasbon" data-live-search="true">
										<option>- PILIH -</option>
										<option value="1">Kasbon oprasional</option>
										<option value="2">Kasbbon kuliah perdana</option>
										<option value="3">Kasbon properties marketing</option>
										<option value="4">Refund</option>										
									</select>
								</div>
							</div>					
						</div>
					</div>
					<div class="box-footer">
						<input type="hidden" name="mode" value="simpan">
						<button type="submit" class="btn btn-primary">Ajukan</button>
					</div>
				</form>				
			</div>
		</div>
	</div>
</div>
<!-- Button trigger modal -->


 <div class="modal fade" id="modal-batal-pengajuan-kasbon" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog text-justify modal-xs">
		<div class="modal-content">
			<div class="modal-body">
				<form role="form" id="batal_kasbon">
					<div class="box-body">
						<h3 class="modal-title" id="myModalLabel">Apakah kamu yakin untuk membatalkan pengajuan ?</h3><br />
						<div class="row">
							<div class="col-md-12">
								<div class="form-group">
									<label for="catatan">Berikan alasan pembatalan ?</label>
									<textarea class="form-control" rows="4" name="catatan" placeholder=""></textarea>
								</div>
							</div>
						</div>
						<input type="hidden" name="reff" value="">
						<input type="hidden" name="mode" value="batal">
						<button type="submit" class="btn btn-danger pull-right">Batalkan</button>
					</div>
				</form>				
			</div>
		</div>
	</div>
</div>



