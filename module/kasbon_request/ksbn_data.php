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

						

						<div class="col-md-4 pull-right">

							<!-- TOMBOL TAMBAH -->
							<button class="btn btn-primary pull-right" style="margin-right:5px;" 
									data-toggle="modal" data-target="#modal-pengajuan-kasbon">Buat Pengajuan
							</button>	
<!--							
							<button class="btn btn-primary pull-right" style="margin-right:5px;" 
									data-toggle="modal" data-target="#modal-pengajuan-kasbon-opr">Pengajuan Operasional
							</button>	
!-->
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
				<form role="form" id="pengajuan_kasbon" >
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
									<select class="form-control selectpicker" style="width: 100%;" id="kodebank" name="kodebank" data-live-search="true" >
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

									<textarea class="form-control" rows="2" name="keperluan" placeholder=""></textarea>

								</div>

							</div>

						</div>

						

						<div class="row">

							<div class="col-md-6">

								<div class="form-group">

									<label for="kantor">Kantor / Kampus</label>

									<select class="form-control selectpicker" style="width: 100%;" id="kantor" name="kantor" data-live-search="true">

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

									<select class="form-control selectpicker" style="width: 100%;" name="jeniskasbon" id="jeniskasbon"
									    data-live-search="true" onchange="check_kasbon(this);" >

										<option>- PILIH -</option>

										<option value="1" data-opr="1">Kasbon oprasional</option>

										<option value="2" data-opr="2">Kasbbon kuliah perdana</option>

										<option value="3" data-opr="3">Kasbon properties marketing</option>

										<option value="4" data-opr="4">Refund</option>										

									</select>

								</div>

							</div>					

						</div>


						<div id="item-barang"  style="display:none">
						
										   <div class="row" >
													<div class="col-md-1"  style="width:5px">
														<div class="form-group" align="right">
															<label for="kantor">#</label>
														</div>
													</div>
													<div class="col-md-3">
														<div class="form-group">
															<label for="kantor">KdBrg</label>
														</div>
													</div>
													<div class="col-md-4">
														<div class="form-group">
															<label for="kantor">Nama Barang</label>
														</div>
													</div>
													<div class="col-md-1" >
														<div class="form-group" style="width:40px">
															<label for="kantor">QTY</label>
														</div>
													</div>
													<div class="col-md-3">
														<div class="form-group">
															<label for="kantor">Harga</label>
														</div>
													</div>
											</div>	
						
						<?php 
							$x = 0 ;
							$qty = 1 ; 
							for ($i=0; $i< 10; $i++){ 
								$x++;
						?>
										   <div class="row" >
													<div class="col-md-1"  style="width:5px">
														<div class="form-group" align="right" ><?php echo ($i+1);?></div>
													</div>	
													
													<div class="col-md-3">
														<div class="form-group">
													<select class="form-control selectpicker" style="width: 100%;" id="kode_barang" name="kode_barang[]"
															data-live-search="true" onchange="check_harga(this);"  >
													  <option value="">-- Pilih --</option>
													  <?php
													  $sqlproduk   =" SELECT * FROM barang_master ORDER BY nama_barang ";      
													  $pro_tampil  = mysql_query($sqlproduk);							  
													  $data_jml    = mysql_num_rows($pro_tampil);
													 // $x=1;
													  while($data=mysql_fetch_array($pro_tampil)){
														$kdbrg = $data['kode_barang'];
														$nmbrg   = $data['nama_barang'];;
													  ?>
													  <option  data="<?php echo $data['harga1']; ?>" 
															   data-urut="<?php echo $x; ?>" 
															   data-kode="<?php echo $kdbrg; ?>" 
															   data-nmbrg="<?php echo $nmbrg; ?>" 
															  value="<?php echo $kdbrg;?>">
													  <?php echo $kdbrg.' '.$nmbrg.' : [Rp.'.$data['harga1']." ... ".$data['harga2']."]";?>
													  </option>
													  <?php }?>
													</select>
														</div>
													</div>
													<div class="col-md-4">
														<div class="form-group">
															<input type="text" class="form-control" id="nmbrg_<?php echo $x; ?>" 
																name="nama_barang[]"  placeholder="Nama Barang" readonly=""  >
														</div>
													</div>					
						
													<div class="col-md-1" >
														<div class="form-group" style=" text-align:left;width:40px">
															<input type="text" class="form-control"  
															value = "<?php echo $qty; ?>"  name="qty[]" 
															id="qty_<?php echo $x; ?>"
															placeholder="Qty"  onchange="check_total(this);" >
														</div>
													</div>					
													<div class="col-md-3">
														<div class="form-group">
															<input type="text" class="form-control" id="harga_<?php echo $x; ?>" 
															 name="harga[]" placeholder="Harga"  
															 onchange="check_total(this);" readonly="">
														</div>
													</div>					
						
											</div>
										
						<?php } ?>
						
						</div>
						
					</div> <!-- box-body !-->
					<div class="box-footer">
						<input type="hidden" name="mode" value="simpan">
						<button type="submit" class="btn btn-primary">Ajukan</button>
					   <button type="reset" value="reset" type="reset" class="btn btn-danger" 
					   onclick="window.location.reload()">Reset</button>
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


<div  id="myRekapDetail" class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" 
     aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
  			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" >
						<i class="fa fa-times-circle-o fa-2x" ></i>
					</button>
					<h4 class="modal-title" id="myModalLabel"><?php echo ' Detail Pengajuan Kasbon Operasional ';?> </h4>
				</div>
				<!-- memulai untuk konten dinamis -->
				<!-- lihat id="data_siswa", ini yang di pangging pada ajax di bawah -->
				<div class="modal-body  table-responsive" id="data_barang"></div>
				<!-- selesai konten dinamis -->
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				</div>
			</div>
		</div>
</div>



<script>
function check_harga(obj) {
  var harga = obj.options[obj.selectedIndex].getAttribute('data');
  var kdbrg  = obj.options[obj.selectedIndex].getAttribute('data-kode');
  var nmbrg  = obj.options[obj.selectedIndex].getAttribute('data-nmbrg');
  var urut  = obj.options[obj.selectedIndex].getAttribute('data-urut');
//  alert(urut+' -> '+harga);
  var x = document.getElementById("harga_"+urut).value=harga;
  var y = document.getElementById("nmbrg_"+urut).value=nmbrg; 
//  var z = document.getElementById("qty_"+urut).value;
  
  var jnskasbon = document.getElementById("jeniskasbon").value;
  ////jika 000Kasbon Operasional ////
  if (kdbrg=="000"){
	  document.getElementById("harga_"+urut).readOnly = false; 
	  document.getElementById("nmbrg_"+urut).readOnly = false; 
//	  document.getElementById("qty_"+urut).readOnly = false; 
//	  document.getElementById("nmbrg_"+urut).value=""; 
  }else{
	  document.getElementById("harga_"+urut).readOnly = true; 
//	  document.getElementById("qty_"+urut).readOnly = true; 
	  document.getElementById("nmbrg_"+urut).readOnly = true; 
  }	  
    xtotal=check_total();
}

function check_total() {

    var count = $('input[name="qty[]"]').length;
  	var i;
	var total=0;
	for (i = 1; i <= count; i++) {
	   var qty = document.getElementById("qty_"+i).value;
	   var hrg = document.getElementById("harga_"+i).value;
	   total += (qty*hrg);
	  
	}
	document.getElementById("nominal").value=total;
//	alert('total: '+total);
	return total;
}


function check_kasbon(obj) {
 var x = obj.options[obj.selectedIndex].getAttribute('data-opr');
/* 
 if (x==1){
	  var y = document.getElementById("item-barang").style.display = "block"; 
	  document.getElementById("nominal").readOnly = true; 
 }else{
	  document.getElementById("nominal").readOnly = false; 
	  var y = document.getElementById("item-barang").style.display = "none"; 
 }
*/ 
}

function CekPODetail(data){
			 var str = data;
			 var res = str.split("#");
			 var nik = res[0];
			 var tgl = res[1];
			 var kampus = res[2];
			 $.ajax({
				url: './module/kasbon_request/view_detail.php',	
				method: 'post',		
				data: {nik:nik, tgl:tgl,kampus:kampus },		
				success:function(data){		
					// alert(data);
					//$('#data_arsip').html(data);	
					$('#data_barang').html(data);	
					$('#myRekapDetail').modal("show");	
				},
			    error: function(){
					$('#myRekapDetail').modal("hide");	
					//error_data();			
			  	}		
				
			});
		
		 
}; 






		



		
</script>




