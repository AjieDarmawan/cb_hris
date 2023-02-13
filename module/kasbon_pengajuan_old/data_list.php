
<?php 
  error_reporting(0);
  session_start();
  date_default_timezone_set('Asia/Jakarta');
  foreach($_REQUEST as $name=>$value)
	{
			$$name=$value;
			//echo "Name: $name : $value;<br />\n";
    }
   
  require('module/kasbon_pengajuan/ksbn_conf.php'); 

  $kar_id = $_SESSION['kar'] ;
  
 // echo $range_now;

?>

<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script> !-->
<!--
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-sweetalert/1.0.1/sweetalert.css"> 
<script src="plugins/jQuery/jQuery-2.1.4.min.js"></script>  
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-sweetalert/1.0.1/sweetalert.min.js"></script>
!-->



<link rel="stylesheet" href="plugins/sweetalert/sweetalert2.min.css"> 
<script src="plugins/jQuery/jQuery-2.1.4.min.js"></script>  
<script src="plugins/sweetalert/sweetalert2.min.js" type="text/javascript"></script>  



<!-- Content Header (Page header) -->

<section class="content-header">
	<h1> <?php echo $title;?> <small><?php echo ucwords($_GET['t']); ?></small> </h1>
	<ol class="breadcrumb">
		<li><a href="media.php"><i class="fa fa-dashboard"></i> Dashboard</a></li>
		<li class="active"><?php echo $title;?></li>
	</ol>
</section>

	<div class="row">
		<div class="col-xs-12">
			<div class="box">
				<div class="box-header" style="padding-top:15px!important;">
					<div class="row">
						<div class="col-md-12 pull-left">	
							<form class="form-inline" action="javascript:void(0);">	
								<div class="input-group pull-left">
									<!-- FILTER TANGGAL -->
									<span class="input-group-btn">
										<button class="btn btn-default btn-flat" type="button" 
										title="Filter"><i class="fa fa-calendar"></i></button>

									</span>

									<input type="text" class="form-control dr-kasbon" name="filter_day" id="filter_day"
									 title="Filter" value="<?php echo $range_now; ?>" placeholder="Day">

									<!-- FILTER STATUS -->
									<div class="input-group-btn">
									    <input type="hidden" name="status_kasbon" value="" />
										<select class="form-control " style="width: 100%;" 
											name="id_status" id="id_status"
										    data-live-search="true" onchange="#check_kasbon(this);" >
											<option value=""> All Status </option>
											<option value="0" >Menunggu</option>
											<option value="1" >Disetujui</option>
											<option value="2" >Ditolak</option>
											<option value="3" >Dibatalkan</option>										
									  </select>
									</div>

									<div class="input-group pull-left">&nbsp;
								   		<a href='#modal-pengajuan-sebelumnya' class='btn btn-primary' 
								   			title="Buat Pengajuan" 
	     									data-toggle='modal' >
												  <i class="fa fa-plus"></i> Buat Pengajuan 
										</a>	
									</div>	
									<div class="input-group pull-left">&nbsp;
										<a href="#" id="myRefresh"  class='btn btn-primary'>
											<i class="fa fa-refresh"></i>&nbsp; 
										</a> 
									</div>

								<div class="input-group pull-left">&nbsp;&nbsp;
								    <!-- <label><b>form terbaru => </b></label> !-->
									<span class="input-group-btn">
										<button class="btn btn-default btn-flat" type="button" 
											title="Filter"><i class="fa fa-list"></i>
										</button>

									</span>
									<div class="form-group">
										<select class="form-control selectpicker" style="width: 100%;" 
											name="id_jns_kasbon" id="id_jns_kasbon"
											data-live-search="true" onchange="#check_kasbon(this);" >
											<option value=""  >- PILIH KASBON -</option>
											<option value="1" >Kasbon oprasional</option>
											<option value="2" >Kasbbon kuliah perdana</option>
											<option value="3" >Kasbon properties marketing</option>
											<option value="4" >Refund</option>										
										</select>
								   </div>

							  </div>	

								</div>
<!--
								<div class="input-group pull-right">&nbsp;
									   <a href='#myModalMarkTool' class='btn btn-info' title="Tambah Data " 
										  data-toggle='modal' data-id="<?php //echo 'add' ?>">
										  <i class="fa fa-plus"></i> 
									  </a>			
								</div>
!-->


							</form>

						</div>
			
						<!-- <div class="col-md-3 pull-right">&nbsp;</div> !-->

					</div>

				</div>
				

<!-- Main content -->

<section class="content"> 

<div class="row"  >
 <div class="col-lg-12 connectedSortable " >  
            <!-- /.box-header -->
          <div class="box box-solid box-primary  ">
            <div class="box-header with-border">
              <center>
			  <h3 class="box-title">
			  	<label>Pengajuan Kasbon Unit</label>
			  </h3>
            </div>
            <!-- /.box-header -->
        <div class="box-body " id="list-kasbon" > <!-- table-responsive -->
				<table id="tb_kasbon" class="table table-bordered table-striped">
					<thead>
						<tr>
							<th width="2%">No</th>
							<th width="5%">Tanggal</th>
							<th width="5%">Pemohon</th>
							<th width="5%">Devisi</th>
							<th width="10%">Kampus</th>
							<th width="5%" style="text-align:right" >Nominal</th>
							<th width="10%">Kasbon</th>
							<th width="10%">Keperluan</th>
							<th width="5%">Catatan</th>
							<th width="5%">Status</th>
							<th width="5%">-</th>
						</tr>
					</thead>
				</table>
		    

  </div>

  
</div> <!-- /.row -->

</div>

<!-- /.content --> 


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
				<div class="modal-body  table-responsive" id="data_kasbon"></div>
				<!-- selesai konten dinamis -->
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				</div>
			</div>
		</div>
</div>


<div class="modal fade" id="modal-batal-pengajuan-kasbon" tabindex="-1" role="dialog"
  aria-labelledby="myModalLabel" aria-hidden="true">
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

<div class="modal fade" id="modal-pengajuan-sebelumnya" tabindex="-1" role="dialog" 
 		aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog text-justify">
		<div class="modal-content ">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">
					<span aria-hidden="true">&times;</span><span class="sr-only">Close</span>
				</button>
				<h3 class="modal-title" id="myLabel_kasbon"><strong>Pengajuan Kasbon </strong>
			</div>
			<div class="modal-body">
				<form role="form" id="pengajuan_kasbon_sebelumnya" >
						<?php include "module/kasbon_pengajuan/form_kasbon_sebelumnya.php"; ?>					
				</form>				
			</div>
		</div>
	</div>
</div>

<div class="modal fade"  id="modal-pengajuan-kasbon-opr" tabindex="-1" role="dialog"  
	aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog text-justify">
		<div class="modal-content ">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">
					<span aria-hidden="true">&times;</span><span class="sr-only">Close</span>
				</button>
				<h3 class="modal-title" id="myLabel_kasbon_opr"><strong>Pengajuan Kasbon </strong>
			</div>
			<div class="modal-body" id="body_kasbon_opr" >
				<form role="form" id="pengajuan_kasbon_opr" >
						<?php 
						   //if ($jenis_kasbon == "1" ){
							   include "module/kasbon_pengajuan/form_kasbon_opr.php"; 
						   //}	   
						?>					
				</form>				
			</div>
		</div>
	</div>
</div>


<div class="modal fade" id="modal-pengajuan-kasbon-marketing" tabindex="-1" role="dialog" 
 		aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog text-justify">
		<div class="modal-content ">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">
					<span aria-hidden="true">&times;</span><span class="sr-only">Close</span>
				</button>
				<h3 class="modal-title" id="myLabel_kasbon_mar"><strong>Pengajuan Kasbon </strong>
			</div>
			<div class="modal-body">
				<form role="form" id="pengajuan_kasbon_marketing" >
						<?php include "module/kasbon_pengajuan/form_kasbon_marketing.php"; ?>					
				</form>				
			</div>
		</div>
	</div>
</div>



<div class="modal fade" id="modal-pengajuan-umum" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" 
 	 aria-hidden="true">
	<div class="modal-dialog text-justify">
		<div class="modal-content ">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">
					<span aria-hidden="true">&times;</span><span class="sr-only">Close</span>
				</button>
				<h3 class="modal-title" id="myLabel_refund"><strong>Pengajuan Refund </strong>
			</div>
			<div class="modal-body">
				<form role="form" id="pengajuan_umum" >
					<?php include "module/kasbon_pengajuan/form_kasbon_umum.php"; ?>	
				</form>				
			</div>
		</div>
	</div>
</div>




<script type="text/javascript">

$(document).ready(function(){
        /////////////////////////////////////////////////////
		var dataTable = $('#tb_kasbon').DataTable({
			"processing":true,
			"serverSide":true,
			"ajax":{
//				"url":"module/kasbon_pengajuan/data_server.php",
				"url":"module/kasbon_pengajuan/ksbn_act.php",
				"type":"POST",
				"data":function(data){
						data.mode='list';
						data.tanggal=$('#filter_day').val();
						data.status=$('input[name=status_kasbon]').val();
						data.jenis_kasbon=$('#id_jns_kasbon').val();
					}
			 },
			"iDisplayLength": 10,
			"aLengthMenu": [[5,10, 20, 50, 100, 200, 300,400,-1], [5,10, 20, 50, 100, 200, 300,400,'All']],
		//	"order": [[ 1, 'asc' ],[ 2, 'asc' ]],	
		//	"order": [[ 1, 'asc' ]],
			"order": [],		
			"aoColumnDefs": [
				  {"bSortable": false,"bVisible": true,"aTargets": [ 0 ]},
				  {"bSortable": false,"aTargets": [ -1 ]},
			 ],		  		
			"displayLength": 25,
			"oLanguage": {
				//"sProcessing": "...proses...",
				"sProcessing": "...",
			 },
/*			 
			"columnDefs": [{
				"defaultContent": "-",
				"targets": "_all"
			}],				 
*/			
/*			
			"drawCallback": function( settings ) {
				$('<li><a onclick="refresh_tab()" class="fa fa-refresh"></a></li>').prependTo('div.dataTables_paginate ul.pagination');
			},						
*/			

		});		
		
      ///////////////update tiap 10 detik/////////////////////// 
      var timer = window.setInterval(myAction, 10000);
	  function myAction(){
	     //  dataTable.ajax.reload(null,false);
	   }
      /////////////////////////////////////////////////////   
     //  myAlert('Data Berhasil di Simpan','success');
	   function myAlert(title,type){
				setTimeout(function () { 	
					swal({
						title: title,
						text:  '',
						type: type,
						timer: 30000,
						showConfirmButton: true
					});		
				},10);	
	   }
	    /////////////////////////////////////////////////////

		/////////////////////////////////////////////////////							
		$('.dr-kasbon').daterangepicker({
			format: 'DD/MM/YYYY',
			minDate: '01/08/2018',
			maxDate: new Date()
		}, function(start, end, label) {
			dataTable.ajax.reload(null,false);
		});

		function set_status_kasbon(stat, txt) {
			$('#label_filter_status').html(txt);
			$('input[name=status_kasbon]').val(stat);
			dataTable.ajax.reload(null,false);
		}

		////////////////////////////////////////////// 
		$('#id_status').on('change', function() {
		    var stat = this.value;
			//$('#label_filter_status').html(txt);
			$('input[name=status_kasbon]').val(stat);		  
		    //dataTable.ajax.reload(null,false);
		    dataTable.ajax.reload();
		});	

/*
		$('#modal-pengajuan-kasbon-opr').on('show.bs.modal', function (e) {  
		  // dataTable.ajax.reload();         
           // location.reload();
		   // alert('modal-pengajuan-kasbon-opr');
           // $('#modal-pengajuan-kasbon-opr').show();
        })		
*/		

//		$('#modal-pengajuan-kasbon-opr').on('show.bs.modal', function (e) {  
//			 $('#modal-pengajuan-kasbon-opr').show();
//        })		

		////////////////////////////////////////////// 
		$('#id_jns_kasbon').on('change', function() {
		 	var jns = this.value;
		 	//dataTable.ajax.reload();
			////////////////RESET-FORM/////////////////////////////
			document.getElementById('pengajuan_kasbon_opr').reset();			
			document.getElementById('pengajuan_kasbon_marketing').reset();			
			document.getElementById('pengajuan_umum').reset();	
			///////////reset single marketing tools ///////////////////////
				$("#mar_kantor option:selected").val('');
				$("#mar_kantor").selectpicker("refresh");
				$("#mar_kodebank option:selected").val('');
				$("#mar_kodebank").selectpicker("refresh");
				//////////////////operasional////////////////////////////
				$("#opr_kantor option:selected").val('');
				$("#opr_kantor").selectpicker("refresh");
				$("#opr_kodebank option:selected").val('');
				$("#opr_kodebank").selectpicker("refresh");
				//////////////////umum////////////////////////////
				$("#umu_kantor option:selected").val('');
				$("#umu_kantor").selectpicker("refresh");
				$("#umu_kodebank option:selected").val('');
				$("#umu_kodebank").selectpicker("refresh");
			/////////////reset multi select items///////////////////////////////	
			 	var j;
				for (j = 1; j <= 20; j++) {
					 $("#mar_kodebrg_"+j).selectpicker('val', '');
					 $("#mar_kodebrg_"+j).selectpicker('deselectAll');
					 $("#opr_kodebrg_"+j).selectpicker('val', '');
					 $("#opr_kodebrg_"+j).selectpicker('deselectAll');
				}
			/////////////////////////////////////////////////////////////
			///////////////////////////////////////////
			//if ( jns <> ""){
			//    document.location.reload();
			//}
			/////////////////////////////////////////////////////////////	  
			var jns_tex ="<strong>Kasbon </strong>";
			//////////////////////////////////////////
			if (jns==1){
			   jns_tex ="<strong>Kasbon : Operasional </strong>";
			   $('#modal-pengajuan-kasbon-opr').modal('show');
			}
			if (jns==2){
			   jns_tex ="<strong>Kasbon : Kuliah Perdana </strong>";
			   $('#modal-pengajuan-umum').modal('show');
			}
			if (jns==3){
			   jns_tex ="<strong>Kasbon : Marketing Tools </strong>";
			  // $('#modal-pengajuan-kasbon-opr').modal('show');
			   $('#modal-pengajuan-kasbon-marketing').modal('show');
			}
			if (jns==4){
			   jns_tex ="<strong>Pengajuan Refund </strong>";
			   $('#modal-pengajuan-umum').modal('show');
			}
			
			$('input[name=jeniskasbon]').val(jns);
			$('#myLabel_kasbon_opr').html(jns_tex);
			$('#myLabel_kasbon_mar').html(jns_tex);
			$('#myLabel_refund').html(jns_tex);
			//jnskasbon=1;
			//$('input[name=status_kasbon]').val(stat);		  
		    //dataTable.ajax.reload();
		});	
	
 
		/////////////////////////////////////
		$("#myRefresh").click(function(e){
			 dataTable.ajax.reload(null,false);
		});

    //////////////////////////////////////////////////////////////////////////////////////////
	$('#pengajuan_kasbon_sebelumnya').submit(function(e) {
		//alert('berhasil'); 
		$.ajax({
			type: 'POST',
			url: 'module/kasbon_pengajuan/ksbn_act.php',
			enctype: 'multipart/form-data',
			data: new FormData(this),
			processData: false,
			contentType: false,
			success: function(data) {
				var json = $.parseJSON(data);
				if(json.status == '1') {
					$('#modal-pengajuan-sebelumnya').modal('hide');
					$('#pengajuan_kasbon_sebelumnya').trigger("reset");
					dataTable.ajax.reload(null,false);
					myAlert('Data Berhasil di Simpan','success');
					// window.location.reload();
				} else {
				    myAlert('Data Tidak Lengkap\nSilahkan Cek Kembali !...','error');
					//alert(json.msg);
				}
//				return false;
			}
		});
		return false;
	});

 
    //////////////////////////////////////////////////////////////////////////////////////////
	$('#pengajuan_kasbon_marketing').submit(function(e) {
		//alert('berhasil'); 
		var status     = $('select[name=id_jns_kasbon]').val();
		/////*Marketing tolls*/////////////
		if (document.getElementById('mar_kantor') !=null ) {
			mar_kantor    = document.getElementById("mar_kantor").value;
		    if (mar_kantor==""){myAlert('Kantor Tidak Boleh Kosong !...','error');return false; }
			
 		}
		if (document.getElementById('mar_kodebank') !=null ) {
			mar_kodebank    = document.getElementById("mar_kodebank").value;
		    if (mar_kodebank==""){myAlert('NoRekening Tidak Boleh Kosong !...','error');return false; }
 		}
		if (document.getElementById('mar_keperluan') !=null ) {
			mar_keperluan    = document.getElementById("mar_keperluan").value;
		    if (mar_keperluan==""){myAlert('Keperluan Tidak Boleh Kosong !...','error');return false; }
 		}

		//////////////////////////////////////////////////////
		var mar_smt    = $('select[name=semester]').val();
	    if (mar_smt==""	){myAlert('Semester Tidak Boleh Kosong !...','error');return false; }
		var mar_tahap  = $('select[name=tahap]').val();
	    if (mar_tahap==""){myAlert('Tahap Tidak Boleh Kosong !...','error');return false; }
		//////////////////////////////////////////////////////
		if (document.getElementById('nominal_properti') !=null ) {
			nominal_properti    = document.getElementById("nominal_properti").value;
		    if (nominal_properti==""){myAlert('Nominal Tidak Boleh Nol !...\nPilih Items Barang','error');return false; }
 		}
		/////////////////////////////////////////////////
		//var text = status+" "+mar_smt+" "+mar_tahap+" "+mar_kantor+" "+mar_kodebank+" "+mar_keperluan+" "+nominal_properti;
		$.ajax({
			type: 'POST',
			url: 'module/kasbon_pengajuan/ksbn_act.php',
			enctype: 'multipart/form-data',
			data: new FormData(this),
			processData: false,
			contentType: false,
			success: function(data) {
				var json = $.parseJSON(data);
				if(json.status == '1') {
					$('#modal-pengajuan-kasbon-marketing').modal('hide');
					$('#pengajuan_kasbon_marketing').trigger("reset");
					dataTable.ajax.reload(null,false);
					myAlert('Data Berhasil di Simpan','success');
					// window.location.reload();
				} else {
				    myAlert('Data Tidak Lengkap\nSilahkan Cek Kembali !...','error');
					//alert(json.msg);
				}
//				return false;
			}
		});
		return false;
	});

	
    //////////////////////////////////////////////////////////////////////////////////////////
	$('#pengajuan_kasbon_opr').submit(function(e){
		//alert('berhasil'); 
		var status     = $('select[name=id_jns_kasbon]').val();		
		/////* Kas Operasional */////////////
		if (document.getElementById('opr_kantor') !=null ) {
			opr_kantor    = document.getElementById("opr_kantor").value;
			if (opr_kantor==""){myAlert('Kantor Tidak Boleh Kosong !...','error');return false; }
 		}
		if (document.getElementById('opr_kodebank') !=null ) {
			opr_kodebank    = document.getElementById("opr_kodebank").value;
		    if (opr_kodebank==""){myAlert('NoRekening Tidak Boleh Kosong !...','error');return false; }
			
 		}
		if (document.getElementById('opr_keperluan') != null ) {
			opr_keperluan    = document.getElementById("opr_keperluan").value;
			if (opr_keperluan==""){myAlert('Keperluan Tidak Boleh Kosong !...','error')}
 		}
		if (document.getElementById('nominal_opr') !=null ) {
			nominal_opr    = document.getElementById("nominal_opr").value;
			if (nominal_opr==""){myAlert('Nominal Tidak Boleh Nol !...\nPilih Items Barang','error');return false; }
 		}
		////alert(status)	
		$.ajax({
			type: 'POST',
			url: 'module/kasbon_pengajuan/ksbn_act.php',
			enctype: 'multipart/form-data',
			data: new FormData(this),
			processData: false,
			contentType: false,
			success: function(data) {
				var json = $.parseJSON(data);
				if(json.status == '1') {
					$('#modal-pengajuan-kasbon-opr').modal('hide');
					$('#pengajuan_kasbon_opr').trigger("reset");
					dataTable.ajax.reload(null,false);
					myAlert('Data Berhasil di Simpan','success');
					// window.location.reload();
				} else {
				    myAlert('Data Tidak Lengkap\nSilahkan Cek Kembali !...','error');
					//alert(json.msg);
				}
//				return false;
			}
		});
		return false;
	});

  //////////////////////////////////////////////////////////////////////////////////////////
	$('#pengajuan_umum').submit(function(e) {
		//alert('berhasil'); 
		var status     = $('select[name=id_jns_kasbon]').val();
		/////*UMUM*/////////////
		if (document.getElementById('umu_kantor') !=null ) {
			umu_kantor    = document.getElementById("umu_kantor").value;
		    if (umu_kantor==""){myAlert('Kantor Tidak Boleh Kosong !...','error');return false; }
			
 		}
		if (document.getElementById('umu_kodebank') !=null ) {
			umu_kodebank    = document.getElementById("umu_kodebank").value;
		    if (umu_kodebank==""){myAlert('NoRekening Tidak Boleh Kosong !...','error');return false; }
 		}
		if (document.getElementById('umu_keperluan') !=null ) {
			umu_keperluan    = document.getElementById("umu_keperluan").value;
		    if (umu_keperluan==""){myAlert('Keperluan Tidak Boleh Kosong !...','error');return false; }
 		}	
		if (document.getElementById('umu_nominal') !=null ) {
			umu_nominal    = document.getElementById("umu_nominal").value;
		    if (umu_nominal==""){myAlert('Nominal Tidak Boleh Kosong !...','error');return false; }
 		}	
		
		$.ajax({
			type: 'POST',
			url: 'module/kasbon_pengajuan/ksbn_act.php',
			enctype: 'multipart/form-data',
			data: new FormData(this),
			processData: false,
			contentType: false,
			success: function(data) {
				var json = $.parseJSON(data);
				if(json.status == '1') {
					$('#modal-pengajuan-umum').modal('hide');
					$('#pengajuan_umum').trigger("reset");
					dataTable.ajax.reload(null,false);
					myAlert('Data Berhasil di Simpan','success');
					// window.location.reload();
				} else {
				    myAlert('Data Tidak Lengkap\nSilahkan Cek Kembali !...','error');
					//alert(json.msg);
				}
//				return false;
			}
		});
		return false;
	});
		
	$('#batal_kasbon').submit(function(e) {
		$.ajax({
			type: 'POST',
			url: 'module/kasbon_pengajuan/ksbn_act.php',
			enctype: 'multipart/form-data',
			data: new FormData(this),
			processData: false,
			contentType: false,
			success: function(data) {
				var json = $.parseJSON(data);
				if(json.status == '1') {
					//table.ajax.reload();
					$('#modal-batal-pengajuan-kasbon').modal('hide');
					$('#batal_kasbon').trigger("reset");
					dataTable.ajax.reload(null,false);
				} else {
					alert(json.msg);
				}
				
				return false;
			}
		});
		return false;
	});
    //////////////////////////////////////////////////////////////////////////////////////////


	 	
}); ////* eof => (document.ready) *///

////////////////////////////////////////////////////////////////////////////////



	function check_harga_properti(obj) {
	  var harga = obj.options[obj.selectedIndex].getAttribute('data');
	  var kdbrg  = obj.options[obj.selectedIndex].getAttribute('data-kode');
	  var nmbrg  = obj.options[obj.selectedIndex].getAttribute('data-nmbrg');
	  var urut  = obj.options[obj.selectedIndex].getAttribute('data-urut');
	 // alert(urut+' -> '+harga);
	  var x = document.getElementById("harga_p"+urut).value=harga;
	  var y = document.getElementById("nmbrg_p"+urut).value=nmbrg; 
	//  var z = document.getElementById("qty_"+urut).value;
	//  var jnskasbon = document.getElementById("jeniskasbon").value;
	  ////jika 000Kasbon Operasional ////
/*	 
	  if (kdbrg=="000"){
		  document.getElementById("harga_p"+urut).readOnly = false; 
		  document.getElementById("nmbrg_p"+urut).readOnly = false; 
	//	  document.getElementById("qty_"+urut).readOnly = false; 
	//	  document.getElementById("nmbrg_"+urut).value=""; 
	  }else{
		  document.getElementById("harga_p"+urut).readOnly = true; 
	//	  document.getElementById("qty_"+urut).readOnly = true; 
		  document.getElementById("nmbrg_p"+urut).readOnly = true; 
	  }	  
*/	  
		xtotal=check_total_properti();
		
	}
	function check_total_properti() {
		var count = $('input[name="qty_p[]"]').length;
		var i;
		var total=0;
		for (i = 1; i <= count; i++) {
		   var qty =  document.getElementById("qty_p"+i).value;
		   var hrg =  document.getElementById("harga_p"+i).value;
		   total +=(qty*hrg);
		}
		//alert(total);
		document.getElementById("nominal_properti").value=total;
		return total;
	}
	

	function check_harga_opr(obj) {
	  var harga = obj.options[obj.selectedIndex].getAttribute('data');
	  var kdbrg  = obj.options[obj.selectedIndex].getAttribute('data-kode');
	  var nmbrg  = obj.options[obj.selectedIndex].getAttribute('data-nmbrg');
	  var urut  = obj.options[obj.selectedIndex].getAttribute('data-urut');
	  //alert(urut+' '+kdbrg+' '+nmbrg+' -> '+harga);
	  var y = document.getElementById("nmbrg_"+urut).value=nmbrg; 
	  var x = document.getElementById("harga_"+urut).value=harga;
	//  var z = document.getElementById("qty_"+urut).value;
	//  var jnskasbon = document.getElementById("jeniskasbon").value;
	  ////jika 000Kasbon Operasional ////
/*	 
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
*/	  
		xtotal=check_total_opr();
		
	}
	function check_total_opr() {
		var count = $('input[name="qty[]"]').length;
		var i;
		var total=0;
		for (i = 1; i <= count; i++) {
		   var qty =  document.getElementById("qty_"+i).value;
		   var hrg =  document.getElementById("harga_"+i).value;
		   total +=(qty*hrg);
		}
		document.getElementById("nominal_opr").value=total;
		return total;
	}
	
	
	function check_kasbon(obj) {
	 var x = obj.options[obj.selectedIndex].getAttribute('data-opr');
	 if (x==1){
		 // var y = document.getElementById("item-barang").style.display = "block"; 
		 // document.getElementById("nominal").readOnly = true; 
	 }else{
		//  document.getElementById("nominal").readOnly = false; 
		 // var y = document.getElementById("item-barang").style.display = "none"; 
	 }
	}

	function CekPODetail(data){
				 var str = data;
				 var res = str.split("#");
				 var nik = res[0];
				 var tgl = res[1];
				 var kampus = res[2];
				 $.ajax({
					url: './module/kasbon_pengajuan/view_detail.php',	
					method: 'post',		
					data: {nik:nik, tgl:tgl,kampus:kampus },		
					success:function(data){		
						// alert(data);
						//$('#data_arsip').html(data);	
						$('#data_kasbon').html(data);	
						$('#myRekapDetail').modal("show");	
					},
					error: function(){
						$('#myRekapDetail').modal("hide");	
						//error_data();			
					}		
					
				});
			
			 
	}; 




	    var windowObjectReference = null; // global variable
        function OpenPopupCenter(pageURL, title, w, h) {
            var left = (screen.width - w) / 2;
            var top = (screen.height - h) / 4;  
		
		  if(windowObjectReference == null || windowObjectReference.closed) {
			    windowObjectReference = window.open(pageURL, title, 'toolbar=no, location=no, directories=no, status=no, menubar=yes, scrollbars=yes, resizable=yes,titlebar=no, copyhistory=no, width=' + w + ', height=' + h + ', top=' + top + ', left=' + left);

		  } else {
		  
	        windowObjectReference.close();
			windowObjectReference = window.open(pageURL, title, 'toolbar=no, location=no, directories=no, status=no, menubar=yes, scrollbars=yes, resizable=yes,titlebar=no, copyhistory=no, width=' + w + ', height=' + h + ', top=' + top + ', left=' + left);			
			
		  };
		
		
        } ;
		
		

function check_harga_x(obj) {
  var harga = obj.options[obj.selectedIndex].getAttribute('data');
  var urut  = obj.options[obj.selectedIndex].getAttribute('data-urut');
//  alert(urut+' -> '+harga);
  var x = document.getElementById("harga_"+urut).value=harga;
 
}

		
</script>
  
<!-- Bootstrap 3.3.5 -->
<!-- <script src="bootstrap/js/bootstrap.min.js"></script> !-->


