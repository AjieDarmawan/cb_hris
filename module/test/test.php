<?php
session_start();
require('module/test/rwd_act.php');
$kar_id  = $kar_data['kar_id'];
$kar_nik = $kar_data['kar_nik'];
$p  = $_REQUEST['p'];
$act = $_SESSION['act'];

$aksi_download = "module/test/download.php?act=download&filename=template-import-marketing-support.xlsx";

?>

<!-- Content Header (Page header) -->
<section class="content-header">
	<h1> <?php echo $title; ?> <small></small> </h1>
	<ol class="breadcrumb">
		<li><a href="media.php"><i class="fa fa-dashboard"></i> Dashboard</a></li>
		<li class="active"><?php echo $title; ?></li>
	</ol>
</section>

<!-- Main content -->
<section class="content">

	<!-- Your Page Content Here -->
	<div class="row">
		<div class="col-xs-12">
			<div class="box">
				<div class="box-header">
					<div class="row">
						<div class="col-md-8">
							<?php if (!empty($_SESSION['terbayar'])) { ?>
								<form class="form-inline" action="" method="post">
									<div class="input-group">
										<span class="input-group-btn">
											<?php if (!empty($_SESSION['fday'])) { ?>
												<button class="btn btn-danger btn-flat" type="submit" name="bclearday" title="Clear Filter"><i class="fa fa-close"></i></button>
											<?php } else { ?>
												<button class="btn btn-default btn-flat" type="button" title="Filter"><i class="fa fa-calendar"></i></button>
											<?php } ?>
										</span>
										<input type="text" class="form-control dr" name="filter_day" id="filter_day" title="Filter" value="<?php if (!empty($_SESSION['fday'])) {
																																				echo $_SESSION['fday'];
																																			} else {
																																				echo $f_daterange;
																																			} ?>" placeholder="Day">
										<span class="input-group-btn">
											<button class="btn btn-default btn-flat" type="submit" name="bday"><i class="fa fa-search"></i></button>
										</span>
									</div>
								</form>
							<?php } ?>
						</div>
						<div class="col-md-4 text-right">
							<form class="form-inline" action="" method="post">
								<?php if (!empty($_SESSION['terbayar'])) { ?>
									<button class="btn btn-danger btn-flat" type="submit" name="bxterbayar" title="Klik untuk Belum terbayar"><i class="fa fa-close"></i> Terbayar</button>
								<?php } else { ?>
									<button class="btn btn-success btn-flat" type="submit" name="bterbayar" title="Klik untuk Terbayar"><i class="fa fa-check"></i> Terbayar</button>
								<?php } ?>
							</form>
						</div>
					</div>
				</div>
				<!-- /.box-header -->
				<div class="box-body table-responsive">
					<table id="tb_marketing" class="table table-hover table-striped table-bordered">
						<thead>
							<tr>
								<th>
									<div style="vertical-align:middle; text-align:center;width:10px">#</div>
								</th>

								<!-- Data Mahasiswa -->

								<!-- <th>
									<div style="vertical-align:middle; text-align:center;">biobid</div>
								</th>
								<th>
									<div style="vertical-align:middle; text-align:center;">kodept</div>
								</th>
								<th>
									<div style="vertical-align:middle; text-align:center;">angkatan</div>
								</th> -->
								<th>
									<div style="vertical-align:middle; text-align:center;">Nama Mahasiswa</div>
								</th>
								<th>
									<div style="vertical-align:middle; text-align:center;">Nosel</div>
								</th>
								<!-- <th>
									<div style="vertical-align:middle; text-align:center;">Formulir</div>
								</th> -->
								<!-- <th>
									<div style="vertical-align:middle; text-align:center;">kodefak</div>
								</th>
								<th>
									<div style="vertical-align:middle; text-align:center;">kodejrs</div>
								</th>
								<th>
									<div style="vertical-align:middle; text-align:center;">kelompok</div>
								</th> -->
								<th>
									<div style="vertical-align:middle; text-align:center;">No Va</div>
								</th>
								<th>
									<div style="vertical-align:middle; text-align:center;">No HP</div>
								</th>
								<!-- <th>
									<div style="vertical-align:middle; text-align:center;">Email</div>
								</th> -->
								<!-- <th>
									<div style="vertical-align:middle; text-align:center;">Tanggal Daftar</div>
								</th> -->
								<!-- <th>
									<div style="vertical-align:middle; text-align:center;">potong_spb</div>
								</th>
								<th>
									<div style="vertical-align:middle; text-align:center;">potong_spp</div>
								</th>
								<th>
									<div style="vertical-align:middle; text-align:center;">smb_informasi</div>
								</th>
								<th>
									<div style="vertical-align:middle; text-align:center;">hp_rekomendasi</div>
								</th>
								<th>
									<div style="vertical-align:middle; text-align:center;">nama_rekomendasi</div>
								</th>
								<th>
									<div style="vertical-align:middle; text-align:center;">kode_agent</div>
								</th>
								<th>
									<div style="vertical-align:middle; text-align:center;">kode_gsf</div>
								</th> -->
								<th>
									<div style="vertical-align:middle; text-align:center;">Kampus</div>
								</th>
								<th>
									<div style="vertical-align:middle; text-align:center;">Jurusan</div>
								</th>
								<!-- <th>
									<div style="vertical-align:middle; text-align:center;">tgl_closing</div>
								</th> -->
								<th>
									<div style="vertical-align:middle; text-align:center;">Status Bayar</div>
								</th>
								<th>
									<div style="vertical-align:middle; text-align:center;width:100px">NIK MS</div>
								</th>
								<th>
									<div style="vertical-align:middle; text-align:center;width:100px">Nama MS</div>
								</th>
								<th>
									<div style="vertical-align:middle; text-align:center;">Tanggal Closing</div>
								</th>
								<!-- <th>
									<div style="vertical-align:middle; text-align:center;">kpi</div>
								</th> -->

								<!-- Data Mahasiswa -->

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

<form role="form" class="form-horizontal" id="save_update_konten" enctype="multipart/form-data">
	<div class="div_modal_2"></div>
</form>

<link rel="stylesheet" href="plugins/sweetalert/sweetalert2.min.css">
<script src="plugins/jQuery/jQuery-2.1.4.min.js"></script>
<script src="plugins/sweetalert/sweetalert2.min.js" type="text/javascript"></script>


<script type="text/javascript">
	$(document).ready(function() {



		var tgl_sekarang = Date.now();

		var today = new Date();
		var dd = today.getDate();
		var mm = today.getMonth() + 1;
		var yyyy = today.getFullYear();
		if (dd < 10) {
			dd = '0' + dd;
		}

		if (mm < 10) {
			mm = '0' + mm;
		}
		today = yyyy + '-' + mm + '-' + dd;


		var dataTable = $('#tb_marketing').DataTable({
			"processing": true,
			"serverSide": true,
			"ajax": {
				"url": "module/test/data_server.php",
				"type": "POST",
				"data": function(data) {
					data.mode = 'list';
					data.tanggal = $('#filter_day').val();
					//data.paket_tool=$('#id_paket_tool').val();
					//data.nm_barang=$('#nm_barang').val();

				}
			},
			"iDisplayLength": 10,
			"aLengthMenu": [
				[10, 20, 50, 100, -1],
				[10, 20, 50, 100, 'All']
			],
			//	"order": [[ 1, 'asc' ],[ 2, 'asc' ]],	
			//	"order": [[ 0, 'asc' ]],
			"order": [10, 'asc'],
			"aoColumnDefs": [{
					"bSortable": false,
					"bVisible": true,
					"aTargets": [0, 1, 2, 3, 4, 5, 6, 7]
				},
				{
					"bSortable": false,
					"aTargets": [-1]
				},
				{
					"targets": '_all',
					"defaultContent": "-", //////datatables.net/tn/4/////////
					"createdCell": function(td, cellData, rowData, row, col) {
						///////set-panding/////////
						// $(td).css('padding', '0px 5px 0px 0px');
					}
				},
			],
			"displayLength": 50,
			"oLanguage": {
				"sProcessing": "...sedang proses...",
				//"sProcessing": "...",
			},

			//		    dom: 'l-B-f-r-t-i-p',
			dom: 'B-f-r-t-i-p',
			buttons: [{
					extend: 'excelHtml5',
					text: '<i class="fa fa-file-excel-o"></i> Excel ',
					title: 'data-marketing-freelance ' + today,
					//orientation: 'landscape',
					/*					
					exportOptions: {
						columns: [0, 1, 2, 3],
						customize: function ( xlsx ) {
							var sheet = xlsx.xl.worksheets['sheet1.xml'];
							$('c[r=A2] t', sheet).text( 'Custom text' );
						}
					}
					*/

				},

			],



		});


		///////////////////////////////////////////////////
		function myAlert(title, type) {
			setTimeout(function() {
				swal({
					title: title,
					text: '',
					type: type,
					timer: 30000,
					showConfirmButton: true
				});
			}, 10);
		}

		//////////////////////////////////////////////////////////////
		//////////////////////////////////////////////////////////////
		doMyEDIT = function(id, data, arrmhs) {
			var userid = data;
			var page = "module/test/form_edit.php";
			var aksi = "edit";
			var judul = "Edit Data";

			//alert(userid);

			$.ajax({
				url: page,
				type: 'post',
				data: {
					id: id,
					arrmhs: arrmhs,
					aksi: aksi,
					judul: judul
				},
				success: function(data) {
					$('.div_modal_2').html(data);
					$('#ModalEdit').modal('show');
				}
			});
			/////////////////////////		 
		};
		//////////////////////////////////////////////////////////////
		doMyDELETE = function(id, data) {
			bootbox.confirm("<h4>Yakin Hapus <strong>" + data + "</strong> ?</h4>", function(result) {
				if (result) {
					var userid = data;
					var page = "module/test/data_server.php";
					var aksi = "delete";
					var judul = "Delete Data";
					$.ajax({
						url: page,
						type: 'post',
						data: {
							id: id,
							aksi: aksi,
							judul: judul
						},
						success: function(data) {
							dataTable.ajax.reload(); ///////all-page//////
							// dataTable.ajax.reload(null,false); ///////////
							myAlert('Data Berhasil di Hapus', 'success');
						}
					});
					return true;
				} else {
					show: false;
				}

			});

			/////////////////////////		 
		};




		/////////////////////////////////////////////////////////////////////////////////////////	
		$('#save_update_konten').submit(function(e) {

			var status = $('select[name=rwd_status]').val();
			//alert(status);return false;
			if (status != undefined) {
				if (status == "") {
					//$('select[name=mfc_status]').focus();
					// myAlert('Nama Tidak Boleh Kosong !...','error');return false;

				}
			}
			//$('#empModalEdit').modal('hide');
			$.ajax({
				type: 'POST',
				//url: 'mod_user/data_user_act.php',
				url: 'module/test/data_server.php',
				enctype: 'multipart/form-data',
				data: new FormData(this),
				processData: false,
				contentType: false,
				success: function(data) {
					//var obj = $.parseJSON(data);
					//var obj = JSON.parse(this.data);
					//alert(obj[0]); 
					//var obj = jQuery.parseJSON( '{ "status": "John" }' );
					$('#ModalEdit').modal('hide');
					var obj = jQuery.parseJSON(data);
					if (obj.status === "0") {
						// alert( obj.status );
						myAlert('Data Error !...', 'error');
						return false;
					}
					var aksi = $('input[name=act]').val();
					$('#save_update_konten').trigger("reset");
					//dataTable.ajax.reload(); ///////all-page///////
					if (aksi == "delete") {
						dataTable.ajax.reload(); ///////all-page///////
						myAlert('Data Berhasil di Hapus', 'success');
					} else {
						dataTable.ajax.reload(null, false);
						myAlert('Data Berhasil di Simpan', 'success');
					}
					// window.location.reload();

				},
				error: function(data) {

					myAlert('File Not Found !...', 'error');
				}
			});

			return false;
		});

		//////////////////////////////////////////

	});


	////////////////////////////////////////////////////////////////  
</script>