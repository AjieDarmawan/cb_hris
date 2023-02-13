
<?php 
  error_reporting(0);
  session_start();
  date_default_timezone_set('Asia/Jakarta');
  foreach($_REQUEST as $name=>$value)
	{
			$$name=$value;
			//echo "Name: $name : $value;<br />\n";
    }
   ///////////////////////////////////////////////////////////////////////
   require('module/kasbon_pengajuan/ksbn_conf.php'); 
  //	echo "<pre>";echo print_r($list_barang_properti);echo "</pre>";
  //////////////////////////////////////////////////////////////////////////
   $kar_id = $_SESSION['kar'] ;

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
<!--									
									<div class="input-group pull-left">&nbsp;
								   		<a href='#modal-pengajuan-sebelumnya' class='btn btn-primary' 
								   			title="Buat Pengajuan" 
	     									data-toggle='modal' >
												  <i class="fa fa-plus"></i> Buat Pengajuan 
										</a>	
									</div>	
!-->									
									<div class="input-group pull-left">&nbsp;
								   		<a  href='#' 
										   class='btn btn-primary modal-pengajuan-sebelumnya' 
								   			title="Buat Pengajuan" >
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
									<label for="">Berikan alasan pembatalan ?</label>
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



<form role="form" id="pengajuan_lain" > 
	<div  id="DIV_LAIN" > </div>	
</form>

<form role="form" id="pengajuan_kasbon_sebelumnya" > 
	<div  id="DIV_SEBELUMNYA" > </div>	
</form>



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
		
	  ///////////////////////////////////////////////////////////			


						
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
        });		
*/		
/*
		$('#modal-pengajuan-kasbon-opr').on('show.bs.modal', function (e) {  
			 $('#modal-pengajuan-kasbon-opr').show();
        });
*/		

		
		////////////////////////////////////////////////
		function html_kasbon_sebelumnya(){
			  var jns = $('#id_jns_kasbon').val();
			  var fieldHTML  ='';
				  fieldHTML  ='';		
				  fieldHTML +='<div class="modal fade"  id="modal-pengajuan-sebelumnya" tabindex="-1" role="dialog"  aria-labelledby="myModalLabel" aria-hidden="true">';
				  fieldHTML +='<div class="modal-dialog text-justify">';
				  fieldHTML +='	<div class="modal-content ">';
				  fieldHTML +='	<div class="modal-header">';
				  fieldHTML +='		<button type="button" class="close" data-dismiss="modal">';
				  fieldHTML +='			<span aria-hidden="true">&times;</span><span class="sr-only">Close</span>';
				  fieldHTML +='		</button>';
				  fieldHTML +='		<h3 class="modal-title" id="myLabel_kasbon_lain"><strong>KASBON </strong>';
				  fieldHTML +=' </div>';//////modal-header///////				  
				  fieldHTML +=' <div class="modal-body"  >';
				  fieldHTML +='<div class="row" >';
				  fieldHTML +='<div class="col-md-6">';
				  fieldHTML +='	<div class="form-group">';
				  fieldHTML +='		<label for="">Kantor / Kampus</label>';
				  fieldHTML +='		<select class="form-control selectpicker " style="width: 100%;"';  
				  fieldHTML +='			id="kantor_new" name="kantor" data-live-search="true">';
				  fieldHTML +='			<option value="">- PILIH -</option>';
					<?php $i=0; foreach($list_kantor as $k => $v) { $i++; ?>	  
					  fieldHTML +='		<option value="<?php echo $v[value];?>"> <?php echo $v[label] ?> </option>';
					<?php };?>
								
				  fieldHTML +='		</select>';
				  fieldHTML +='	</div>';
				  fieldHTML +='</div>';
				  ///////////////////////////////////////////////////////////
				  fieldHTML +='<div class="col-md-6">';
				  fieldHTML +='	<div class="form-group">';
				  fieldHTML +='		<label for="">NoRekening Bank</label>';
				  fieldHTML +='		<select class="form-control selectpicker " style="width: 100%;"';  
				  fieldHTML +='			id="kodebank_new" name="kodebank" data-live-search="true">';
				  fieldHTML +='		<option value="">- PILIH -</option>';
					<?php $i=0; foreach($list_kliring as $k => $v) { $i++; ?>	  
				  fieldHTML +='		<option value="<?php echo $v[value];?>"> <?php echo $v[label] ?> </option>';
					<?php };?>
								
				  fieldHTML +='		</select>';
				  fieldHTML +='	</div>';
				  fieldHTML +='</div>';				  
				  ///////////////////////////////////////////////////////////
				  fieldHTML +='</div>'; //row/////
				  ///////////////////////////////////////////////////////
				  fieldHTML +='<div class="row">';
				  fieldHTML +='	<div class="col-md-12">';
				  fieldHTML +='		<div class="form-group">';
				  fieldHTML +='			<label for="">Keperluan</label>';
				  fieldHTML +='			<textarea class="form-control" rows="2" id="new_keperluan" name="keperluan" placeholder=""></textarea>';
				  fieldHTML +='		</div>';
				  fieldHTML +='	</div>';
				  fieldHTML +='</div>'; ///row///

				  fieldHTML +='<div class="row">';
				  fieldHTML +='	<div class="col-md-6">';
				  fieldHTML +='	 <div class="form-group">';
				  fieldHTML +='	   <label for="">Jumlah Rp</label>';
				  fieldHTML +='		<input type="text" class="form-control" id="nominal_new" name="nominal" >';
				  fieldHTML +='	 </div>';
				  fieldHTML +='	</div>';	
				  fieldHTML +='	<div class="col-md-6">';
				  fieldHTML +='		<div class="form-group">';
				  fieldHTML +='			<label for="kantor">Jenis Kasbon</label>';
				  fieldHTML +='			<select class="form-control selectpicker" style="width: 100%;" name="jeniskasbon" ';
				  fieldHTML +='				id="jeniskasbon_new"';
				  fieldHTML +='					data-live-search="true" onchange="#check_kasbon(this);" >';
				  fieldHTML +='					<option value="">- PILIH -</option>';
				  fieldHTML +='					<option value="1" data-opr="1">Kasbon oprasional</option>';
				  fieldHTML +='					<option value="2" data-opr="2">Kasbbon kuliah perdana</option>';
				  fieldHTML +='					<option value="3" data-opr="3">Kasbon properties marketing</option>';
				  fieldHTML +='					<option value="4" data-opr="4">Refund</option>';										
				  fieldHTML +='			</select>';
				  fieldHTML +='		</div>';
				  fieldHTML +='	</div>';					  
				  				  
				  fieldHTML +='</div>'; ///row///

				  ///////////////////////////////////////////////////////				  
				  fieldHTML +='</div>';
				  fieldHTML +='<div class="modal-footer">';
				  fieldHTML +='	 <div class="box-footer" align="center">';
				  fieldHTML +='		<input type="hidden" name="mode" value="simpan">';
				  fieldHTML +='		<input type="hidden" name="aksi" value="save_opr">';
				  fieldHTML +='		<button type="submit" class="btn btn-primary">Ajukan</button>';
				  fieldHTML +='		<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>';
				  fieldHTML +=' </div>';
				  fieldHTML +='</div>';
				  fieldHTML +='</div>';
	
				  fieldHTML +='</div>';////modal-body///
				  fieldHTML +='</div>';////modal-content///
				  fieldHTML +='</div>';////modal-dialag///
				  fieldHTML +='</div>';////modal///
	
				  return fieldHTML;

	    };
				
		///////////////////////////////////////////////
		function html_kasbon_operasional(){
			  var jns = $('#id_jns_kasbon').val();
			  var fieldHTML  ='';
				  fieldHTML  ='';		
				  fieldHTML +='<div class="modal fade"  id="modal-pengajuan-lain" tabindex="-1" role="dialog"  aria-labelledby="myModalLabel" aria-hidden="true">';
				  fieldHTML +='<div class="modal-dialog text-justify">';
				  fieldHTML +='	<div class="modal-content ">';
				  fieldHTML +='	<div class="modal-header">';
				  fieldHTML +='		<button type="button" class="close" data-dismiss="modal">';
				  fieldHTML +='			<span aria-hidden="true">&times;</span><span class="sr-only">Close</span>';
				  fieldHTML +='		</button>';
				  fieldHTML +='		<h3 class="modal-title" id="myLabel_kasbon_lain"><strong>KASBON LAIN </strong>';
				  fieldHTML +=' </div>';//////modal-header///////				  
				  fieldHTML +=' <div class="modal-body" id="body_kasbon_lain" >';
				  fieldHTML +='<div class="row" >';
				  fieldHTML +='<div class="col-md-6">';
				  fieldHTML +='	<div class="form-group">';
				  fieldHTML +='		<label for="">Kantor / Kampus</label>';
				  fieldHTML +='		<select class="form-control selectpicker " style="width: 100%;"';  
				  fieldHTML +='			id="kantor_new" name="kantor" data-live-search="true">';
				  fieldHTML +='			<option value="">- PILIH -</option>';
					<?php $i=0; foreach($list_kantor as $k => $v) { $i++; ?>	  
					  fieldHTML +='		<option value="<?php echo $v[value];?>"> <?php echo $v[label] ?> </option>';
					<?php };?>
								
				  fieldHTML +='		</select>';
				  fieldHTML +='	</div>';
				  fieldHTML +='</div>';
				  ///////////////////////////////////////////////////////////
				  fieldHTML +='<div class="col-md-6">';
				  fieldHTML +='	<div class="form-group">';
				  fieldHTML +='		<label for="">NoRekening Bank</label>';
				  fieldHTML +='		<select class="form-control selectpicker " style="width: 100%;"';  
				  fieldHTML +='			id="kodebank_new" name="kodebank" data-live-search="true">';
				  fieldHTML +='		<option value="">- PILIH -</option>';
					<?php $i=0; foreach($list_kliring as $k => $v) { $i++; ?>	  
				  fieldHTML +='		<option value="<?php echo $v[value];?>"> <?php echo $v[label] ?> </option>';
					<?php };?>
								
				  fieldHTML +='		</select>';
				  fieldHTML +='	</div>';
				  fieldHTML +='</div>';				  
				  ///////////////////////////////////////////////////////////
				  fieldHTML +='</div>'; //row/////
				  ///////////////////////////////////////////////////////
				  fieldHTML +='<div class="row">';
				  fieldHTML +='	<div class="col-md-12">';
				  fieldHTML +='		<div class="form-group">';
				  fieldHTML +='			<label for="">Keperluan</label>';
				  fieldHTML +='			<textarea class="form-control" rows="2" id="new_keperluan" name="keperluan" placeholder=""></textarea>';
				  fieldHTML +='		</div>';
				  fieldHTML +='	</div>';
				  fieldHTML +='</div>'; ///row///

				  fieldHTML +='<div class="row">';
			///////////Marketing Tools////////////////////////////////////////////
		  	if (jns==3){ 
				  fieldHTML +='	<div class="col-md-3">';
				  fieldHTML +='		<div class="form-group">';
				  fieldHTML +='		<label for="">Semester</label>';
										<?php 
										  $xth1 = date("Y")-1;
										  $xth2 = date("Y");
										  $smt_11 = "1.$xth1";
										  $smt_12 = "2.$xth1";
										  $smt_21 = "1.$xth2";
										  $smt_22 = "2.$xth2";
										?>
				  fieldHTML +='		<select class="form-control " style="width: 100%;" name="semester" ';
				  fieldHTML +='			id="semester"';
				  fieldHTML +='			data-live-search="true" onchange="#;" >';
				  fieldHTML +='			<option value="">- PILIH -</option>';
				  fieldHTML +='			<option value="<?php echo $smt_11;?>" > <?php echo $smt_11;?></option>';
				  fieldHTML +='			<option value="<?php echo $smt_12;?>" > <?php echo $smt_12;?></option>';
				  fieldHTML +='			<option value="<?php echo $smt_21;?>" > <?php echo $smt_21;?></option>';
				  fieldHTML +='			<option value="<?php echo $smt_22;?>" > <?php echo $smt_22;?></option>';										
				  fieldHTML +='		</select>';
				  fieldHTML +='	</div>';
				  fieldHTML +=' </div>';	
	
				  fieldHTML +='	<div class="col-md-3">';
				  fieldHTML +='	  <div class="form-group">';
				  fieldHTML +='			<label for="">Tahap</label>';
				  fieldHTML +='			<select class="form-control " style="width: 100%;" name="tahap" ';
				  fieldHTML +='				id="tahap"';
				  fieldHTML +='				data-live-search="true" onchange="#;" >';
				  fieldHTML +='				<option value="">- PILIH -</option>';
				  fieldHTML +='				<option value="Tahap I"   > <?php echo 'Tahap I';?></option>';
				  fieldHTML +='				<option value="Tahap II"  > <?php echo 'Tahap II';?></option>';
				  fieldHTML +='				<option value="Tahap III" > <?php echo 'Tahap III';?></option>';
				  fieldHTML +='				<option value="Tahap IV"  > <?php echo 'Tahap IV';?></option>';										
				  fieldHTML +='			</select>';
				  fieldHTML +='	  </div>';
				  fieldHTML +='	</div>';	
            } ////jns=3 Marketing Tools//////
			var read_nominal = "";
			if (jns==1 || jns==3){
			   read_nominal = ' readonly="" ';
			}				  
				  fieldHTML +='	<div class="col-md-6">';
				  fieldHTML +='	 <div class="form-group">';
				  fieldHTML +='	   <label for="">Jumlah Rp</label>';
				  fieldHTML +='		<input type="text" class="form-control" id="nominal_new" name="nominal" '+read_nominal+' >';
				  fieldHTML +='	 </div>';
				  fieldHTML +='	</div>';					  
				  fieldHTML +='</div>'; ///row///
	       
    		if (jns==1 || jns==3){
				  fieldHTML +=' <div class="row" >';
				  fieldHTML +=' 	<div class="col-md-1"  style="width:5px">';
				  fieldHTML +='			<div class="form-group" align="right">';
				  fieldHTML +='				<label for="">#</label>';
				  fieldHTML +='			</div>';
				  fieldHTML +='		</div>';
				  fieldHTML +='		<div class="col-md-3">';
				  fieldHTML +='			<div class="form-group">';
				  fieldHTML +='				<label for="">KdBrg</label>';
				  fieldHTML +='			</div>';
				  fieldHTML +='		</div>';
				  fieldHTML +='		<div class="col-md-4">';
				  fieldHTML +='			<div class="form-group">';
				  fieldHTML +='				<label for="">Nama Barang</label>';
				  fieldHTML +='		 	</div>';
				  fieldHTML +='		</div>';
				  fieldHTML +='		<div class="col-md-1" >';
				  fieldHTML +='			<div class="form-group" style="width:40px">';
				  fieldHTML +='				<label for="">QTY</label>';
				  fieldHTML +='			</div>';
				  fieldHTML +='		</div>';
				  fieldHTML +='		<div class="col-md-3">';
				  fieldHTML +='			<div class="form-group">';
				  fieldHTML +='				<label for="">Harga</label>';
				  fieldHTML +='			</div>';
				  fieldHTML +='		</div>';
				  fieldHTML +='	</div> ';					  
		   }; ///////////////////		  
			 ///////////////////////////////////////////////////////
			if (jns==1){ 		  
				  <?php 
					$x = 0 ;
					$qty = 1 ; 
					for ($i=0; $i< 20; $i++){ 
						$x++;					
				  ?>
				  fieldHTML +='<div class="row" >';
				  fieldHTML +='		<div class="col-md-1"  style="width:5px">';
				  fieldHTML +='			<div class="form-group" align="right" ><?php echo ($i+1);?></div>';
				  fieldHTML +='		</div>';	
				  fieldHTML +='		<div class="col-md-3">';
				  fieldHTML +='		<div class="form-group">';
				  fieldHTML +='			<select class="form-control selectpicker" style="width: 100%;" id="kodebrg_new<?php echo $x; ?>"';  
				  fieldHTML +='				name="kode_barang[]"';
				  fieldHTML +='				data-live-search="true" onchange="check_harga_new(this);" >';
				  fieldHTML +='			  <option value="">-- Pilih --</option>';
					<?php $y=0; foreach($list_barang_opr as $k => $v) { $y++; ?>	
					<?php   
						$kdbrg = $v[kode_barang];
						$nmbrg = $v[nama_barang];
						$harga = $v[harga1];
						$ket_barang = $v[kode_barang]." - ".$v[nama_barang]."(Rp.".$v[harga1].")" ;
					?>  
				  fieldHTML +='			  <option value="<?php echo $kdbrg;?>"';
				  fieldHTML +=' 			data-urut="<?php echo $x; ?>" ';
				  fieldHTML +=' 			data-kode="<?php echo $kdbrg; ?>"';
				  fieldHTML +=' 			data-nmbrg="<?php echo $nmbrg; ?>"';
				  fieldHTML +=' 			data-harga="<?php echo $harga; ?>"';
				  fieldHTML +=' > <?php echo $ket_barang; ?>';
				  fieldHTML += '</option>';
					<?php };?>
				  
				  fieldHTML +='		    </select>';
				  fieldHTML +='	</div>';
				  fieldHTML +='	</div>';
	
				  fieldHTML +='	<div class="col-md-4">';
				  fieldHTML +='		<div class="form-group">';
				  fieldHTML +='			<input type="text" class="form-control" id="nmbrg_new<?php echo $x; ?>"'; 
				  fieldHTML +='				name="nama_barang[]"  placeholder="Nama Barang" readonly="" >';
				  fieldHTML +='		</div>';
				  fieldHTML +='	</div>';	
	
				  fieldHTML +='	<div class="col-md-1" >';
				  fieldHTML +='  <div class="form-group" style=" text-align:left;width:40px">';
				  fieldHTML +='		<input type="text" class="form-control" '; 
				  fieldHTML +='			value = "<?php echo $qty; ?>"  name="qty[]" ';
				  fieldHTML +='			id="qty_new<?php echo $x; ?>"';
				  fieldHTML +='			placeholder="Qty"  onchange="check_total_new(this);" >';
				  fieldHTML +='	 </div>';
				  fieldHTML +='	</div>';					
				  
				  fieldHTML +='	<div class="col-md-3">';
				  fieldHTML +='		<div class="form-group">';
				  fieldHTML +='		 <input type="text" class="form-control" id="harga_new<?php echo $x; ?>"'; 
				  fieldHTML +='			 name="harga[]" placeholder="Harga" '; 
				  fieldHTML +='			 onchange="check_total_opr(this);" readonly="">';
				  fieldHTML +='		 <input type="hidden" class="form-control" id="kode_baru<?php echo $x; ?>"'; 
				  fieldHTML +='			 name="kode_baru[]" '; 
				  fieldHTML +='			 onchange="check_total_opr(this);" readonly="">';
				  fieldHTML +='		</div>';
				  fieldHTML +='	</div>';			
				  ///////////////////////////////////
				  fieldHTML +='</div>';////row///
			  <?php } ?>	  
			  
            };//////jns=1 Operasional////////////			  
				  
			 ///////////////////////////////////////////////////////
			if (jns==3){ 		  
				  <?php 
					$x = 0 ;
					$qty = 1 ; 
					for ($i=0; $i< 10; $i++){ 
						$x++;					
				  ?>
				  fieldHTML +='<div class="row" >';
				  fieldHTML +='		<div class="col-md-1"  style="width:5px">';
				  fieldHTML +='			<div class="form-group" align="right" ><?php echo ($i+1);?></div>';
				  fieldHTML +='		</div>';	
				  fieldHTML +='		<div class="col-md-3">';
				  fieldHTML +='		<div class="form-group">';
				  fieldHTML +='			<select class="form-control selectpicker" style="width: 100%;" id="kodebrg_new<?php echo $x; ?>"';  
				  fieldHTML +='				name="kode_barang[]"';
				  fieldHTML +='				data-live-search="true" onchange="check_harga_new(this);" >';
				  fieldHTML +='			  <option value="">-- Pilih --</option>';
					<?php $y=0; foreach($list_barang_properti as $k => $v) { $y++; ?>	
					<?php   
						$kdbrg = $v[kode_barang];
						$nmbrg = $v[nama_barang];
						$harga = $v[harga1];
						$ket_barang = $v[kode_barang]." - ".$v[nama_barang]."(Rp.".$v[harga1].")" ;
					?>  
				  fieldHTML +='			  <option value="<?php echo $kdbrg;?>"';
				  fieldHTML +=' 			data-urut="<?php echo $x; ?>" ';
				  fieldHTML +=' 			data-kode="<?php echo $kdbrg; ?>"';
				  fieldHTML +=' 			data-nmbrg="<?php echo $nmbrg; ?>"';
				  fieldHTML +=' 			data-harga="<?php echo $harga; ?>"';
				  fieldHTML +=' > <?php echo $ket_barang; ?>';
				  fieldHTML += '</option>';
					<?php };?>
				  
				  fieldHTML +='		    </select>';
				  fieldHTML +='	</div>';
				  fieldHTML +='	</div>';
	
				  fieldHTML +='	<div class="col-md-4">';
				  fieldHTML +='		<div class="form-group">';
				  fieldHTML +='			<input type="text" class="form-control" id="nmbrg_new<?php echo $x; ?>"'; 
				  fieldHTML +='				name="nama_barang[]"  placeholder="Nama Barang" readonly="" >';
				  fieldHTML +='		</div>';
				  fieldHTML +='	</div>';	
	
				  fieldHTML +='	<div class="col-md-1" >';
				  fieldHTML +='  <div class="form-group" style=" text-align:left;width:40px">';
				  fieldHTML +='		<input type="text" class="form-control" '; 
				  fieldHTML +='			value = "<?php echo $qty; ?>"  name="qty[]" ';
				  fieldHTML +='			id="qty_new<?php echo $x; ?>"';
				  fieldHTML +='			placeholder="Qty"  onchange="check_total_new(this);" >';
				  fieldHTML +='	 </div>';
				  fieldHTML +='	</div>';					
				  
				  fieldHTML +='	<div class="col-md-3">';
				  fieldHTML +='		<div class="form-group">';
				  fieldHTML +='		 <input type="text" class="form-control" id="harga_new<?php echo $x; ?>"'; 
				  fieldHTML +='			 name="harga[]" placeholder="Harga" '; 
				  fieldHTML +='			 onchange="check_total_opr(this);" readonly="">';
				  fieldHTML +='		 <input type="hidden" class="form-control" id="kode_baru<?php echo $x; ?>"'; 
				  fieldHTML +='			 name="kode_baru[]" '; 
				  fieldHTML +='			 onchange="check_total_opr(this);" readonly="">';
				  fieldHTML +='		</div>';
				  fieldHTML +='	</div>';			
				  ///////////////////////////////////
				  fieldHTML +='</div>';////row///
			  <?php } ?>	  
			  
            };//////jns=3 marketing tools////////////		

				  ///////////////////////////////////////////////////////				  
				  fieldHTML +='</div>';
				  fieldHTML +='<div class="modal-footer">';
				  fieldHTML +='	 <div class="box-footer" align="center">';
				  fieldHTML +='		<input type="hidden" name="mode" value="simpan">';
				  fieldHTML +='		<input type="hidden" name="aksi" value="save_opr">';
				  fieldHTML +='		<input type="hidden" name="jeniskasbon">';
				  fieldHTML +='		<button type="submit" class="btn btn-primary">Ajukan</button>';
				  fieldHTML +='		<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>';
				  fieldHTML +=' </div>';
				  fieldHTML +='</div>';
				  fieldHTML +='</div>';
	
				  fieldHTML +='</div>';////modal-body///
				  fieldHTML +='</div>';////modal-content///
				  fieldHTML +='</div>';////modal-dialag///
				  fieldHTML +='</div>';////modal///
	
				  return fieldHTML;

	    };
		
		////////////////////////////////////////////// 
		$('#id_jns_kasbon').on('change', function() {
		 	var jns = this.value;
		 	//dataTable.ajax.reload();
			////////////////RESET-FORM/////////////////////////////
			/////////////////////////////////////////////////////////////
			var jns_tex ="<strong>Kasbon </strong>";
			//////////////////////////////////////////
			if (jns==1){jns_tex ="<strong>Kasbon : Operasional </strong>";}
			if (jns==2){jns_tex ="<strong>Kasbon : Kuliah Perdana </strong>";}
			if (jns==3){jns_tex ="<strong>Kasbon : Marketing Tools </strong>";}
			if (jns==4){jns_tex ="<strong>Pengajuan Refund </strong>";}
			
		
			var fieldHTML  ='';
			$('#DIV_LAIN').html(fieldHTML);////////reset//////////////
			//////////////////////////////////////////////////////////	
			if (jns !== ""  ){
				fieldHTML = html_kasbon_operasional();
				$('#DIV_LAIN').html(fieldHTML);  /////////////add-html//////////
				$('.selectpicker').selectpicker();////////datepicker///////////
				$('#modal-pengajuan-lain').modal('show');			  
				//////////////////////////////////////////////////////////
				$('input[name=jeniskasbon]').val(jns);
				$('#myLabel_kasbon_lain').html(jns_tex);
			}	

		});	
	
 
		/////////////////////////////////////
		$("#myRefresh").click(function(e){
			 //dataTable.ajax.reload(null,false);///////per-page/////////
			 dataTable.ajax.reload();///////all-page/////////
		});

    //////////////////////////////////////////////////////////////////////////////////////////
		$('.modal-pengajuan-sebelumnya').click(function() {
			var fieldHTML  ='';
			$('#DIV_SEBELUMNYA').html(fieldHTML);////////reset//////////////
			//////////////////////////////////////////////////////////	
			fieldHTML = html_kasbon_sebelumnya();
			$('#DIV_SEBELUMNYA').html(fieldHTML);  /////////////add-html//////////
			$('.selectpicker').selectpicker();////////datepicker///////////
			$('#modal-pengajuan-sebelumnya').modal('show');			  			
			
		});

    /////////////////////////////////////////////////////////////////////////////////////////	
	$('#pengajuan_kasbon_sebelumnya').submit(function(e) {
		//alert('berhasil'); 
		/////* Kas Operasional */////////////
		if (document.getElementById('kantor_new') !=null ) {
			var kantor_new    = document.getElementById("kantor_new").value;
			if (kantor_new==""){myAlert('Kantor Tidak Boleh Kosong !...','error');return false; }
 		}
		if (document.getElementById('kodebank_new') !=null ) {
			var kodebank_new    = document.getElementById("kodebank_new").value;
		    if (kodebank_new==""){myAlert('NoRekening Tidak Boleh Kosong !...','error');return false; }
			
 		}
		if (document.getElementById('new_keperluan') !=null ) {
			var new_keperluan    = document.getElementById("new_keperluan").value;
			if (new_keperluan==""){myAlert('Keperluan Tidak Boleh Kosong !...','error');return false; }
 		}
		if (document.getElementById('nominal_new') !=null ) {
			nominal_new    = document.getElementById("nominal_new").value;
			if (nominal_new=="" || nominal_new==0){
			  myAlert('Nominal Tidak Boleh Nol !...\nPilih Items Barang','error');return false; 
			}
 		}
		if (document.getElementById('jeniskasbon_new') !=null ) {
			jeniskasbon_new    = document.getElementById("jeniskasbon_new").value;
			if (jeniskasbon_new==""){myAlert('Jenis Kasbon Tidak Boleh Kosong !...','error');return false; }
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
					$('#modal-pengajuan-sebelumnya').modal('hide');
					$('#pengajuan_kasbon_sebelumnya').trigger("reset");
					//dataTable.ajax.reload(null,false);
					dataTable.ajax.reload(); ///////all-page///////
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
	$('#pengajuan_lain').submit(function(e){
		//alert('berhasil'); 
		var status     = $('select[name=id_jns_kasbon]').val();	
		/////* Kas Operasional */////////////
		if (document.getElementById('kantor_new') !=null ) {
			var kantor_new    = document.getElementById("kantor_new").value;
			if (kantor_new==""){myAlert('Kantor Tidak Boleh Kosong !...','error');return false; }
 		}
		if (document.getElementById('kodebank_new') !=null ) {
			var kodebank_new    = document.getElementById("kodebank_new").value;
		    if (kodebank_new==""){myAlert('NoRekening Tidak Boleh Kosong !...','error');return false; }
			
 		}
		if (document.getElementById('new_keperluan') !=null ) {
			var new_keperluan    = document.getElementById("new_keperluan").value;
			if (new_keperluan==""){myAlert('Keperluan Tidak Boleh Kosong !...','error');return false; }
 		}
		
		//var keperluan   = $('textarea[name=keperluan]').val();
		//if (keperluan==""){myAlert('Keperluan Tidak Boleh Kosong !...','error')}
		//////////////////////////////////////////////////////
		if (status==3){
			var mar_smt    = $('select[name=semester]').val();
			if (mar_smt==""	){myAlert('Semester Tidak Boleh Kosong !...','error');return false; }
			var mar_tahap  = $('select[name=tahap]').val();
			if (mar_tahap==""){myAlert('Tahap Tidak Boleh Kosong !...','error');return false; }
		}	
		//////////////////////////////////////////////////////		
		if (document.getElementById('nominal_new') !=null ) {
			nominal_new    = document.getElementById("nominal_new").value;
			if (nominal_new==""){myAlert('Nominal Tidak Boleh Nol !...\nPilih Items Barang','error');return false; }
 		}
       
		////////////////////////////
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
					$('#modal-pengajuan-lain').modal('hide');
					$('#pengajuan_lain').trigger("reset");
					//dataTable.ajax.reload(null,false);/////reload per-page///////////
					dataTable.ajax.reload();/////reload all page///////////
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




	function check_harga_new(obj) {
	  var urut  = obj.options[obj.selectedIndex].getAttribute('data-urut');
	  var kdbrg  = obj.options[obj.selectedIndex].getAttribute('data-kode');
	  var nmbrg  = obj.options[obj.selectedIndex].getAttribute('data-nmbrg');
	  var harga  = obj.options[obj.selectedIndex].getAttribute('data-harga');
	 // alert(urut+' '+kdbrg+' '+nmbrg+' -> '+harga);
	  var y = document.getElementById("nmbrg_new"+urut).value=nmbrg; 
	  var x = document.getElementById("harga_new"+urut).value=harga;
	  xtotal=check_total_new();
		
	}
	function check_total_new() {
		var count = $('input[name="kode_baru[]"]').length;
		var i=0 ;
		var total=0;
		for (i = 1; i <= count; i++) {
		   var qty =  document.getElementById("qty_new"+i).value;
		   var hrg =  document.getElementById("harga_new"+i).value;
		   total +=(qty*hrg);
		}
		document.getElementById("nominal_new").value=total;
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


