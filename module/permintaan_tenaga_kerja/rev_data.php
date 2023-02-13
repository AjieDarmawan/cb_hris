	
<?php 

  
 // error_reporting(0);
   session_start();
   date_default_timezone_set('Asia/Jakarta');

	
	$db->koneksi();
	
	$cek_nik = $_SESSION['kar'];

	$filter_nik = "";
 	if ($cek_nik == 499 || $cek_nik == 551 || $cek_nik == 542 || $cek_nik == 37  ){
		  ////////admin atau sdm////////////// 
	}else{
        $filter_nik = " AND ( a.pemohon_id = '$cek_nik' OR a.manager_id='$cek_nik' 
		                        OR a.dirmud_id='$cek_nik' OR a.direktur_id='$cek_nik'
						      ) ";
	
		$query = "
						SELECT
						a.tk_id,a.manager_id,dirmud_id,direktur_id
						FROM _tenaga_kerja_master a
						WHERE 1=1  ".$filter_nik ;
						
		//echo $query; return;

		$num_total = mysql_num_rows(mysql_query($query)); 
		if ($num_total == 0 ){
			 echo ' '; return ;
		}
    }
   //////////////////////////////////////////////////////////////////	
   foreach($_REQUEST as $name=>$value){
		$$name=$value;
		//echo "$name : $value;<br />\n";
   }


    ///////////////////////////////////////////////////////////////////////
   $page 	 	= $_GET['p'];
   $act 	 	= $_GET['act'];
   $range_now 	= date('01/m/Y') . ' - ' . date('d/m/Y');
   $title 		= "Permintaan Tenaga Kerja";
   $sub_title 	= "Permintaan Tenaga Kerja";
   
   $dir_url 	= "module/$p/";
  // $dir_url 	= "module/data_order_cetakan_new";
   $user_nama = $use_data['use_nama'];
   $_SESSION['user_nama'] = $use_data['use_nama'];;
   
   //require('././component/tag_js.php')  ; 
   require('././component/tag_plugins.php')  ;
   
   $kar_id_user = $_SESSION['kar'] ;


 
?>


<!--
<script src="mod_worker.js"></script> 
!-->	

<style type="text/css">


</style>	




<section class="content-header"  >
	<font size="+2"> &nbsp; <?php echo $title; ?> </font>
	<ol class="breadcrumb">
		<li><a href="media.php"><i class="fa fa-dashboard"></i> Dashboard</a></li>
		<li class="active"><?php echo $title;?></li>
	</ol>





<div  id="DIV_HEADER_1"></div>

<section class="content"> 	
	<div class="row">
    
	     <div class="col-md-6">  <label id="label_nik" >&nbsp;</label></div>
		 <div class="col-md-6">  <label id="label_nama">&nbsp;</label></div>

<!--		 
		 <div class="col-md-6">
			  <div class="box box-info">
				<div class="box-header">
					 <h3 class="box-title"><?php echo $title;?></h3>
					 <div class="pull-right box-tools">
						   <a href="#?p=data_kpi" onclick="doRefresh()"  
						     class="btn btn-sm btn-default"><i class="fa fa-refresh"></i>
						   </a>
						   <button class="btn btn-info btn-sm" data-widget='collapse' 
								data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i>
							</button>
							<button class="btn btn-info btn-sm" data-widget='remove' 
								data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i>
							</button>
					 </div>
				 </div>
		
				
				<div class="box-body ">
				 <table id="tabel_karyawan"  width="98%" 
					 class="table table-bordered table-striped table-hover table-condensed display" 
	 				 >
						<thead>
						  <tr >
						    <th width="5%">ID</th>
							<th width="5%">NIK</th>
							<th width="5%">Nama</th>
							<th width="5%">Divisi</th>
							<th width="5%">Kantor</th>
						  </tr>
						</thead>
				 </table>
			   </div>

		   </div>
		 </div>  

!-->
		 <div class="col-md-12">
			  <div class="box box-info">
				<div class="box-header">
					 <h3 class="box-title"> <?php echo 'Form : '.$title ;?></h3>
					 <div class="pull-right box-tools">
                  <?php 
				     //if(!empty($_GET['id'])){ 
                  ?>
<!--				
                    <button style="cursor:pointer" onclick="doUpdateData(0)"
							 class="btn btn-sm btn-primary " >
						 <i class="fa fa-plus"></i>
					</button>					
!-->
         	  <?php //}; ?>
						   
						   <button class="btn btn-info btn-sm" data-widget='collapse' 
								data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i>
							</button>
							<button class="btn btn-info btn-sm" data-widget='remove' 
								data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i>
							</button>
					 </div><!-- /. tools -->
				 </div>
		
				<!-- /.box-header -->
	
				<div class="box-body  table-responsive">
				 <table id="tabel_tenaga_kerja" width="98%"
				  class="table table-bordered table-striped table-hover"
				  style="line-height:22px; " >
					
					<thead>

						<th>ID</th>
						<th  style="vertical-align:middle">Action</th>
						<th  style="vertical-align:middle" >Pemohon Manager</th>
						<th  style="vertical-align:middle">Approve Dirmud</th>
						<th  style="vertical-align:middle">Approve Direktur </th>
						<th  style="vertical-align:middle">Tanggal Masuk Kerja</th>
						<th  style="vertical-align:middle" >Status</th>
						<th  style="vertical-align:middle">No Urut</th>
						<th  style="vertical-align:middle">Tanggal Input</th>
						<th  style="vertical-align:middle">Pemohon</th>
						<th  style="vertical-align:middle">Usia</th>
						<th  style="vertical-align:middle">Pendikan</th>
						<th  style="vertical-align:middle">Jabatan / Posisi</th>
						<th  style="vertical-align:middle">Divisi</th>
						<th  style="vertical-align:middle">Unit Kerja</th>
						</tr>
						
					</thead>
				 </table>
			   </div>

		   </div>
		 </div>  

		 
	</div>
	
</div> 
	
<!-- <div  id="DIV_KONTEN_1"  ></div>	 !-->
<form role="form" method="post" class="form-horizontal" id="save_update_konten"  enctype="multipart/form-data" > 
    <input type="hidden" class="form-control" name="user_nama"  value="<?php echo  $user_nama;?>"   > 
	<input type="hidden" class="form-control" name="data_id"  id="data_id"  value="<?php echo  $data_id;?>"  >  	
	<input type="hidden" class="form-control" name="data_nik" id="data_nik" value="<?php echo  $data_nik;?>" >  	 	<div  id="DIV_MODAL"   > </div>	
</form>





<!-- modal-delete !-->
<div class="modal fade" id="confirm-delete"  role="dialog" 
	aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header"  style="background:#66FFFF">
               <p id="data-delete"> </p>
            </div>
            <div class="modal-body" >
                 <center><i class="fa fa-cog fa-spin fa-3x fa-fw"></i> <span class="sr-only">Loading...</span></center>         
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                <a class="btn btn-danger btn-delete-ok">Delete</a>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="list_data_fu" role="dialog">
		<div class="modal-dialog modal-lg">
			<!-- Modal content-->
			<div class="modal-content">
				<div class="modal-header">
				  <button type="button" class="close" data-dismiss="modal">&times;</button>
				  <h4 class="modal-title">FollowUp</h4>
				</div>
				<div class="modal-body tampil_datafu">
				  
				</div>
				<div class="modal-footer">
				  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				</div>
			</div>
		  
		</div>
</div>


<!-- modal-delete !-->
<div class="modal fade" id="loading_data"  role="dialog" 
	aria-labelledby="myModalLabel" aria-hidden="true" >
    <div class="modal-dialog" style="width:300px; margin-top:20%">
        <div class="modal-content">
 
            <div class="modal-body" style="" >
                 <center><i class="fa fa-cog fa-spin fa-3x fa-fw"></i> Mohon Tunggu ...  <span class="sr-only">
				 </span>
				 </center>  
            </div>
			<div class="modal-footer"> 
			 <!-- <button type="button" class="btn btn-default" data-dismiss="modal">Close</button> !-->
			</div>
        </div>
    </div>
</div>


<section>



      <style type="text/css">

      #loading{

	text-align: center;

	display: none;

	position: fixed;

	background-color: rgba(0, 0, 0, 0.3);

	z-index: 1000;

	left: 0;

	top: 0;

	height: 100%;

	width: 100%;

	padding-top:10%;

      }

      #output{

	font-size: 10px;

      }

      

      .loader {

	margin: auto 0;

	border: 3px solid #f3f3f3;

	border-radius: 50%;

	border-top: 3px solid #157ebf;

	width: 20px;

	height: 20px;

	-webkit-animation: spin 1s linear infinite;

	animation: spin 1s linear infinite;

      }

      

      @-webkit-keyframes spin {

	0% { -webkit-transform: rotate(0deg); }

	100% { -webkit-transform: rotate(360deg); }

      }

      

      @keyframes spin {

	0% { transform: rotate(0deg); }

	100% { transform: rotate(360deg); }

      }



      </style>

      

      <div id="loading"><img src="dist/img/loadingnew3.gif" /></div>
	  
</section>


</div>	
</div> <!-- content !-->



<!--
<script type="text/javascript" src="././lib/pdfmake.min.js"></script>
<script type="text/javascript" src="././lib/html2canvas.min.js"></script>
!-->

<!--	
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.5.3/jspdf.debug.js" integrity="sha384-NaWTHo/8YCBYJ59830LTz/P4aQZK1sS0SneOgAvhsIl3zBu8r9RevNg5lHCHAuQ/" crossorigin="anonymous">
</script>
!-->


<!--
<script type="text/javascript" src="module/data_order_cetakan_new/custom_ajax.js"></script>
!-->

<script>

$(document).ready(function(){
		
		/////////////////////////////////////////////////////
		var x_row = 0 ;	
		var x_row2 = 0 ;	
		var x_aksi_delete = '';
		var dir_url = "<?php echo $dir_url; ?>";
		//////////////////////////////////////////////////////			
	    $.fn.modal.Constructor.prototype.enforceFocus = function() {};	
		   
		$('.dr-tanggal').daterangepicker({
			format: 'DD/MM/YYYY'
		});
	
	     $(".myselect").select2();
/*		 
		 $('body').on('shown.bs.modal', '.modal', function() {
			  $(this).find('select').each(function() {
				var dropdownParent = $(document.body);
				if ($(this).parents('.modal.in:first').length !== 0)
				  dropdownParent = $(this).parents('.modal.in:first');
				$(this).select2({
				  dropdownParent: dropdownParent
				  // ...
				});
			  });
		 });
				
*/
		
       $('#confirm-delete').on('show.bs.modal', function(e) {
			var id = $('.delete-data').attr('data-id');
			var text_delete = '<h3>'+'Delete Data ?  '+id+'</h3>';
			$('#data-delete').html(text_delete);

			$(".btn-delete-ok").click(function(e){
			   $('#confirm-delete').modal('hide');			
			  //alert('delete');	 
			  // dataTable.ajax.reload();///////all-page/////////
			});


	   });

	//	 $('#confirm-delete').modal('show');	
   ///////////////////////////////////////////////////////////////////////////////
	//$('#loading_data').modal({ show: true,backdrop: 'static',keyboard: false });	
	html_top_header();
	//html_tabel_do();
	//$('#loading_data').modal('hide');	
	
	///////////////////////////////////////////////////////
	function html_top_header(){
	     
			var fieldHTML = '';
			$.ajax({url: dir_url+"/rev_div_header_1.php",
				async: false, // makes request synchronous //
				data:{mode:"_list_nomor_nospk"},
				success: function(result){
					//alert("success\n "+result);
					fieldHTML = result ;

			   } 
			});
			$('#DIV_HEADER_1').html(fieldHTML);	
			$(".myselect").select2();
		   
			$('.dr-tanggal').daterangepicker({
				format: 'DD/MM/YYYY'
			});
			
			
		
	};
	


///////////////////////////////////////////////////////////
var dataTableKaryawan = $('#tabel_tenaga_kerja').DataTable({
	//"responsive":true,
	"processing":true,
	"serverSide":true,
	"ajax":{
		"url": dir_url+"/rev_data_server.php",
		"type":"POST",
	
		"data":function(data){
				data.mode='list_data_tenaga_kerja';
				data.id   = $('#data_id').val();
				data.nik  = $('#data_nik').val();
				data.tanggal=$('#filter_day').val();
				//data.id_nomor_po=$('#id_nomor_po').val();
				//data.id_progres_po=$('#id_progres_po').val();
				//data.nm_barang=$('#nm_barang').val();
			},
		
         "beforeSend": function() {
             // $("#loading-image").show();
         },	
		 "error": function(){ 
			$("#tb_pts").append('<tbody><tr><th colspan="3">No data found in the server</th></tr></tbody>');
		 },	
							
	 },
//			"pageLength": 20,			 
	"iDisplayLength": -1,
	"aLengthMenu": [[5,10, 20, 50, 100, 200, 300,400,-1], [5,10, 20, 50, 100, 200, 300,400,'All']],
//	"order": [[ 1, 'asc' ],[ 2, 'asc' ]],	
	"order": [[ 8, 'desc' ]],	
//	"order": [],
		
	"aoColumnDefs": [
		  {"bSortable": false,"aTargets": [ 0, 1, 2 , 3, 4 ]},
		 // {"bSortable": false,"aTargets": [ -1 ]},
		  {"visible": false, "targets": 0 },
		 // { "visible": false, "targets": 2 },
		  {"targets": 6, "className": "info text-center text-bold","width": "2%"},
		 // {"targets": 6, "className": "text-right","width": "2%"},
		 // {"targets": 7, "render": $.fn.dataTable.render.number( ',', '.', 0 )},
		  {"targets": '_all',
		   "defaultContent": "-", //////datatables.net/tn/4/////////
		   "createdCell": function (td, cellData, rowData, row, col) {
				///////set-panding/////////
				$(td).css('padding', '0px 5px 0px 0px');
		   }},


	 ],	
	
//	"displayLength": 25,
	"oLanguage": {
		//"sProcessing": "...proses...",
        "sProcessing": "<i class=\"fa fa-cog fa-spin fa-3x fa-fw\"></i> <span class=\"sr-only\">Loading...</span>", 			
	 },
	 
	 "language": {
			"decimal":        ",",
			"thousands":      ".",
	        	
	 },

			 
/////////////////////////////////////////////

});		

///////////////////////////////////////////////////////////		


document.onkeydown=function(evt){
	var keyCode = evt ? (evt.which ? evt.which : evt.keyCode) : event.keyCode;
	///////cek-key-enter///////////
	if(keyCode == 13)
	{
	  //alert("Key Enter");
	  return false; 
		//your function call here
	}
}
 
						
///////////////update tiap 10 detik/////////////////////// 
var timer = window.setInterval(myAction, 10000);
function myAction(){
 //  dataTableKaryawan.ajax.reload(null,false);
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
/*
	Swal.fire({
	  title: 'Are you sure Delete ?',
	 // text: "Data ",
	  icon: 'warning',
	  showCancelButton: true,
	  confirmButtonColor: '#3085d6',
	  cancelButtonColor: '#d33',
	  confirmButtonText: 'Yes, Delete ! '
	}).then((result) => {
	  if (result.value) {
		Swal.fire('Deleted!','Yes Delete','success') ;
		///////////////////////
	  }
	})
*/






///////////////////////////////////////////////////////////
function html_edit_data_performance(act,id){
       // alert('id:'+id);

	    var mode   		= "list_data_review";
		var aksi   		= "save_editdata_review";
		var aksi_proses = "edit_data";
		var sub_title 	= "Form Performance Review Edit # " ;
		var user_nama   = "<?php echo $user_nama;?>" ;
		///////add-data/////////////////////////
		if (act=="add"){
			var aksi	    = "save_adddata_review" ;
			var aksi_proses = "add_data" ; 
			var sub_title 	= "Form Performance Review Add # " ;
		}
		////////////////////////////////////////		
	    var xdata  = "";
		var fieldHTML = '';
		$.ajax({url: dir_url+"/rev_modal_performance.php",
			async: false, // makes request synchronous //
			data:{ id			: id,
			       mode			: mode,
				   act          : act, 
			       aksi 		: aksi,
				   aksi_proses  : aksi_proses,
				   sub_title 	: sub_title,
				   user_nama	: user_nama 
				 },
			success: function(result){
				//alert(result);
				fieldHTML = result ;
		
		   } 
		});		  
		//$('.dp').datepicker();
		//$(".myselect").select2();
		
		return fieldHTML;

};


///////////////////////////////////////////////////////////
function html_update_daftar(act,id){
       // alert('id:'+id);


	    var mode   		= "list_data_review";
		var aksi   		= "save_editdata_review";
		var aksi_proses = "edit_data";
		var sub_title 	= "Form Performance Review Edit # " ;
		var user_nama   = "<?php echo $user_nama;?>" ;
		///////add-data/////////////////////////
		if (act=="add"){
			var aksi	    = "save_adddata_review" ;
			var aksi_proses = "add_data" ; 
			var sub_title 	= "Form Performance Review Add # " ;
		}
		////////////////////////////////////////		
	    var xdata  = "";
		var fieldHTML = '';
		$.ajax({url: dir_url+"/rev_modal_daftar.php",
			async: false, // makes request synchronous //
			data:{ id			: id,
			       mode			: mode,
				   act          : act, 
			       aksi 		: aksi,
				   aksi_proses  : aksi_proses,
				   sub_title 	: sub_title,
				   user_nama	: user_nama 
				 },
			success: function(result){
				//alert(result);
				fieldHTML = result ;
		
		   } 
		});		  
		//$('.dp').datepicker();
		//$(".myselect").select2();
		
		return fieldHTML;

};





     ////////////////////////////////////////////////////////////////////////////////////
	$('.modal-add-performance').click(function() {
		x_row 	  = 0 ;
		var id    = 0 ;	
        if (document.getElementById("data_id")){
			id		  = document.getElementById("data_id").value;	
		}		
	    if (id==""){
		  //alert('Data Tidak Ada !..'); return false;
	    }
	   // $('#loading_data').modal('show');	
	    $('#loading_data').modal({
					   show: true,
					   backdrop: 'static',
					   keyboard: false
					});	
							
/*			
		if (document.getElementById('DIV_LOADING_1')) {	
		    document.getElementById("DIV_LOADING_1").style.display = "block"; 
		}	
*/		

		var act = 'add';
		fieldHTML = html_edit_data_performance(act,id);
		$('#DIV_MODAL').html(fieldHTML);  /////////////add-html//////////	
		//$('.selectpicker').selectpicker();////////datepicker///////////
		$('.dp').datepicker({
			 todayHighlight: true,
			 format: "yyyy-mm-dd",
		});
		$(".myselect").select2();
		
		var total1  = 0 ;
		var total2  = 0 ;
		var total3  = 0 ;
		var total4  = 0 ;
		var total5  = 0 ;
		var total6  = 0 ; 
//////////////////////////////////////////////////////////////////////////////////////////
		$('.sipema_range').daterangepicker();
		$('.sipema_range').on('apply.daterangepicker', function(ev, picker) {
		  var kar_nik = $("#kar_nik").val();
		//  alert('kar_nik : '+kar_nik); return false;
		  var start = picker.startDate.format('YYYY-MM-DD');
		  var end   = picker.endDate.format('YYYY-MM-DD');
		  $('#sipema1-data').html('<center><div class="loader"></div></center>');
		 // $('#sipema2-data').html('<center><div class="loader"></div></center>');
		  $.ajax({
		      async: false, // makes request synchronous //
			  type : 'post',
			  url : 'module/review_sipema_data_user.php',
			  data :  'start='+ start +'&end='+ end +'&kar_nik='+ kar_nik,
			  success : function(data){
				console.log(data);
				var row = JSON.parse(data);
				$('#sipema1-data').html(row[0]);
			//	$('#sipema2-data').html(row[0]);
				$('#sipema1-val').val(row[0]);
			//	$('#sipema2-val').val(row[0]);
			//	$('#sipema-detail').val(row[1]);
			//	$('#sipema-reward').val(row[2]);
			//	$('#sipema-reward-detail').val(row[3]);
			   total1 = row[0] ;
			   total_pic_unit() ;
				
			  }
		  });
	  
		});
//////////////////////////////////////////////////////////////////////////////////////////
		$('.sipema_range2').daterangepicker();
		$('.sipema_range2').on('apply.daterangepicker', function(ev, picker) {
		  var kar_nik = $("#kar_nik").val();
		//  alert('kar_nik : '+kar_nik); return false;
		  var start = picker.startDate.format('YYYY-MM-DD');
		  var end   = picker.endDate.format('YYYY-MM-DD');
		  $('#sipema1-data2').html('<center><div class="loader"></div></center>');
		  $.ajax({
		      async: false, // makes request synchronous //
			  type : 'post',
			  url : 'module/review_sipema_data_user.php',
			  data :  'start='+ start +'&end='+ end +'&kar_nik='+ kar_nik,
			  success : function(data){
				console.log(data);
				var row = JSON.parse(data);
				$('#sipema1-data2').html(row[0]);
				$('#sipema1-val2').val(row[0]);
				total2 = row[0] ;
				total_pic_unit() ;
			  }
		  });
	  
		});
		

//////////////////////////////////////////////////////////////////////////////////////////
		$('.sipema_range3').daterangepicker();
		$('.sipema_range3').on('apply.daterangepicker', function(ev, picker) {
		  var kar_nik = $("#kar_nik").val();
		//  alert('kar_nik : '+kar_nik); return false;
		  var start = picker.startDate.format('YYYY-MM-DD');
		  var end   = picker.endDate.format('YYYY-MM-DD');
		  $('#sipema1-data3').html('<center><div class="loader"></div></center>');
		  $.ajax({
		      async: false, // makes request synchronous //
			  type : 'post',
			  url : 'module/review_sipema_data_user.php',
			  data :  'start='+ start +'&end='+ end +'&kar_nik='+ kar_nik,
			  success : function(data){
				console.log(data);
				var row = JSON.parse(data);
				$('#sipema1-data3').html(row[0]);
				$('#sipema1-val3').val(row[0]);
				total2 = row[0] ;
				total_pic_unit() ;
			  }
		  });
	  
		});
				
//////////////////////////////////////////////////////////////////////////////////////////
		$('.pic_range').daterangepicker();
		$('.pic_range').on('apply.daterangepicker', function(ev, picker) {
		  var kar_nik = $("#kar_nik").val();
		//  alert('kar_nik : '+kar_nik); return false;
		  var start = picker.startDate.format('YYYY-MM-DD');
		  var end   = picker.endDate.format('YYYY-MM-DD');
		  $('#pic-data').html('<center><div class="loader"></div></center>');
		 // $('#sipema2-data').html('<center><div class="loader"></div></center>');
		  $.ajax({
			  async: false, // makes request synchronous //		  
			  type : 'post',
			  url : 'module/review_sipema_data_unit.php',
			  data :  'start='+ start +'&end='+ end +'&kar_nik='+ kar_nik,
			  success : function(data){
				console.log(data);
				var row = JSON.parse(data);
				$('#pic-data').html(row[0]);
				$('#pic-val').val(row[0]);
				total3 = row[0] ;
				total_pic_unit() ;
				 
				
			  }
		  });
	  
		});
		
//////////////////////////////////////////////////////////////////////////////////////////

		$('.pic_range2').daterangepicker();
		$('.pic_range2').on('apply.daterangepicker', function(ev, picker) {
		  var kar_nik = $("#kar_nik").val();
		//  alert('kar_nik : '+kar_nik); return false;
		  var start = picker.startDate.format('YYYY-MM-DD');
		  var end   = picker.endDate.format('YYYY-MM-DD');
		  $('#pic-data2').html('<center><div class="loader"></div></center>');
		 // $('#sipema2-data').html('<center><div class="loader"></div></center>');
		  $.ajax({
			  async: false, // makes request synchronous //		  
			  type : 'post',
			  url : 'module/review_sipema_data_unit.php',
			  data :  'start='+ start +'&end='+ end +'&kar_nik='+ kar_nik,
			  success : function(data){
				console.log(data);
				var row = JSON.parse(data);
				$('#pic-data2').html(row[0]);
				$('#pic-val2').val(row[0]);
				
				 total4 = row[0] ;
				 
				 total_pic_unit() ;
/*				 
				 var total5 = total4-total3 ;
				 $('#unit-data').html(total5);
				 $('#unit-data').val(total5);
				 
				 var total6 = total2 ;
				 $('#unit-data2').html(total6);
				 $('#unit-data2').val(total6);
*/				
				
			  }
		  });
	  
		});
		
		
//////////////////////////////////////////////////////////////////////////////////////////
		
		 $('#loading_data').modal('hide');	
		 $('#modal-update-user').modal('show');	
/*		
	     $('#modal-update-user').modal({
					   show: true,
					   backdrop: 'static',
					   keyboard: false
					});		
*/						 	
		//alert('test-modal') ; 			
		
	});	 

	///////////////////////////////////////////////////////////

	 	function total_pic_unit(){
		        
				 var total1 = $('#sipema1-val').val();
		         var total2 = $('#sipema1-val2').val();
				 var total3 = $('#pic-val').val();
				 var total4 = $('#pic-val2').val();
				 var total5 = total4-total3 ;
				 $('#unit-data').html(total5);
				 $('#unit-val').val(total5);
				 
				 $('#unit-data2').html(total2);
				 $('#unit-val2').val(total2);

		}	
	 		

	
    ///////////////////////////////////////////////////////////////////////////////////	 
	  doCekReview = function(data) {
	     /*
	        var x_ke = ' <B>ke '+data+'</B>' ;
			$('#rev_ke1').html( x_ke );
			$('#rev_ke2').html( x_ke );
			$('#rev_ke3').html( x_ke );
			$('#rev_ke4').html( x_ke );
		 */	
	  };

	 //////////////////////////////////////////////////////
	 	function formatNumber(num) {
 			 return num.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,')
		}	
		

	 	function display_total(){
		        var tot_qty = 0 ;
		  		var ris = new Array();
				$("input[name^='qty']").each(function() {
					ris.push($(this).val());
					tot_qty += Number($(this).val());
				});	
				xhtml = tot_qty;
				$('.id_tot_qty').html(xhtml);
				
				///////////////////total-harga/////////////////////

		}	


 
     //////////////////////////////////////////////////////////////////////////////////////////
		





     doNIK = function(id,nik,nama) {
	 
	     // alert('doNIK:'+id+' '+nik+' '+nama) ;
		 if (document.getElementById("label_nik")){
		     var label_nik   = document.getElementById("label_nik").innerHTML="NIK : "+nik+' / '+nama;		
		 }

		 if (document.getElementById("label_nama")){
		      var label_nama  = document.getElementById("label_nama").innerHTML="NIK : "+nik+' / '+nama;	
		 }

		 if (document.getElementById("data_id")){
		     var kar_id      = document.getElementById("data_id").value = id ;	
		 }

		 if (document.getElementById("data_nik")){
		      var kar_nama    = document.getElementById("data_nik").value = nik ;	
		 }
			 
 		  dataTableKaryawan.ajax.reload(null,false);////per-page///////
		  
		  //dataTablePerformance.ajax.reload(null,false);////per-page///////
		  dataTablePerformance.ajax.reload(); /////all-page/////////
		 
      }

     doRefresh = function() {
	      //alert('doRefresh');
		 if (document.getElementById("label_nik")){
		     var label_nik   = document.getElementById("label_nik").innerHTML="";		
		 }
		 if (document.getElementById("label_nama")){
		      var label_nama  = document.getElementById("label_nama").innerHTML="";
		 }
		  		  
		 if (document.getElementById("data_id")){
		     var kar_id      = document.getElementById("data_id").value = "" ;
		 }
		 if (document.getElementById("data_nik")){
		     var kar_nama    = document.getElementById("data_nik").value = "" ;
		 }
				   
		 
 		  dataTableKaryawan.ajax.reload(null,false);////per-page///////
		  dataTablePerformance.ajax.reload(); /////all-page/////////
		 
      }
	  	  
 
	  
     doDeleteDetail = function(data) {
		 if (confirm('Delete Record ?...'+data)==false){
			   return false;
		 }	 
		  var mode   = "delete_nota_detail";
 			  x_aksi_delete = mode ;	
			  var xdata  = "";
			  $.ajax({
					url: dir_url+'/rev_data_action.php',
					type: 'POST',
					dataType: 'json',
					async: false,
					data : { mode:mode, id : data },
					beforeSend: function(){
					  //  $("#loading-image").show();
					  //  alert('loading');
					},		
					success: function (response) {
					xdata = data ;
						$('#modal-update-user').modal('hide');
					    $('#save_update_konten').trigger("reset");		
						dataTableKaryawan.ajax.reload(null,false);////per-page///////
						// dataTableKaryawan.ajax.reload(); /////all-page/////////
					}
			   });			
		 
      };	
	  /////////////////////////////////////////////////////////////////////
    doDeletePerform = function(data) {
		 if (confirm('Delete Record # '+data+' ?')==false){
			   return false;
		 }	
		 		  
		  var mode   = "delete_detail_perform";
 			  x_aksi_delete = mode ;	
			  var xdata  = "";
			  $.ajax({
					url: dir_url+'/rev_data_action.php',
					type: 'POST',
					dataType: 'json',
					async: false,
					data : { mode:mode, id : data },
					beforeSend: function(){
					  //  $("#loading-image").show();
					  //  alert('loading');
					},		
					success: function (response) {
					xdata = data ;
						$('#modal-update-user').modal('hide');
					    $('#save_update_konten').trigger("reset");		
						dataTableKaryawan.ajax.reload(null,false);////per-page///////
						// dataTable.ajax.reload(); /////all-page/////////
					}
			   });			
		 
      };			  		  		  	

	  /////////////////////////////////////////////////////////////////////
    doUpdateData = function(id , xcetak ) {
	    //alert('Update:'+id);
		//alert(cetak);
		var act = 'edit';	
	    if (id==0 || id == "" ){
		    act = 'add';
	    }

	    $('#loading_data').modal({
					   show: true,
					   backdrop: 'static',
					   keyboard: false
					});	


		fieldHTML = html_update_daftar(act,id);
		//alert(fieldHTML);
		$('#DIV_MODAL').html(fieldHTML);  /////////////add-html//////////	
		//$('.selectpicker').selectpicker();////////datepicker///////////
		$('.dp').datepicker({
			 todayHighlight: true,
			 format: "yyyy-mm-dd",
		});
		
		$(".myselect").select2(
		);
		
		$('.dr-tanggal').daterangepicker({
			format: 'DD/MM/YYYY'
		});		
		//////////////////////////////////////////
		$('#loading_data').modal('hide');	
		//$('#modal-update-user').modal('show');

		$('#modal-update-user').modal({
					   show: true,
					   backdrop: 'static',
					   keyboard: false
		});	
/*
		 if (document.getElementById("bsave")){
			// document.getElementById("bsave").style.display = "block" ;
			document.getElementById("bsave").disabled = true ;
		 }	
		 if (document.getElementById("bapprove")){
			document.getElementById("bapprove").disabled = true ;
		 }	
*/	
		  if (document.getElementById("bapprove")){
			  document.getElementById("bapprove").disabled = true ;
			  document.getElementById("bapprove").style.display = "none" ;
		  }	
		  if (document.getElementById("bapprove_batal")){
			  document.getElementById("bapprove_batal").disabled = true ;
			  document.getElementById("bapprove_batal").style.display = "none" ;
		  }			 
    /////////////////////hanya-cetak///////////////////////////
		//CetakPrinter(cetak);
		//CekApprove(cetak) ; 
	    
		if (xcetak == "edit-manager"){
		   $('#aksi').val("edit_manager");	
	    }
		
		if (xcetak == "hanya-cetak"    ||  xcetak == "approve-manager" || 
			xcetak == "approve-dirmud" ||  xcetak == "approve-direktur" ){
			
			  CekTOPRINT(data="xxx",cetak=true ) ;	
			  if (document.getElementById("checkbox_1")){
				  document.getElementById("checkbox_1").checked = true ;
				  document.getElementById("checkbox_1").disabled = true ;
			  }	
			  if (document.getElementById("bsave")){
				 // document.getElementById("bsave").disabled = true ;
				  document.getElementById("bsave").style.display = "none" ;
			  }	
			  if (document.getElementById("bapprove")){
				 // document.getElementById("bsave").disabled = true ;
				  document.getElementById("bapprove").style.display = "none" ;
			  }	

			  if (document.getElementById("bapprove_batal")){
				 // document.getElementById("bsave").disabled = true ;
				  document.getElementById("bapprove_batal").style.display = "none" ;
			  }	
			  			  
			  if ( xcetak == "approve-manager" ){
			     document.getElementById("bapprove").disabled = false;
			     document.getElementById("bapprove").style.display = "block" ;
				 $('#aksi').val("approve_manager");	
				 
				 if (document.getElementById("aksi")){
					// document.getElementById("aksi").value = "approve_manager";
				 }
				 	 
			  }				  
			  if ( xcetak == "approve-dirmud" ){
			     document.getElementById("bapprove").disabled = false;
			     document.getElementById("bapprove").style.display = "block" ;

			     document.getElementById("bapprove_batal").disabled = false;
			     document.getElementById("bapprove_batal").style.display = "block" ;
				 
				 $('#aksi').val("approve_dirmud");	
				 if (document.getElementById("aksi")){
				//	 document.getElementById("aksi").value = "approve_dirmud";
				 }
				 	 
			  }	
			  
			  if ( xcetak == "approve-direktur" ){
			     document.getElementById("bapprove").disabled = false;
			     document.getElementById("bapprove").style.display = "block" ;
				 
			     document.getElementById("bapprove_batal").disabled = false;
			     document.getElementById("bapprove_batal").style.display = "block" ;				 
				 $('#aksi').val("approve_direktur");	
				 if (document.getElementById("aksi")){
					// document.getElementById("aksi").value = "approve_direktur";
				 }	
				 			 	 
			  }						  		  	
			  			  	
		}	  
	
		/////////////////////////////////////////		
     };	
	 

	 function CetakPrinter(cetak) {
			if (cetak == "hanya-cetak" ){
				  CekTOPRINT(data="xxx",cetak=true ) ;	
				  if (document.getElementById("checkbox_1")){
					  document.getElementById("checkbox_1").checked = true ;
					  document.getElementById("checkbox_1").disabled = true ;
				  }	
				  if (document.getElementById("bsave")){
					  document.getElementById("bsave").disabled = true ;
					  document.getElementById("bsave").style.display = "none" ;
				  }	
				  if (document.getElementById("bapprove")){
					  document.getElementById("bapprove").disabled = true ;
					  document.getElementById("bapprove").style.display = "none" ;
				  }	
				  if (document.getElementById("bapprove_batal")){
					  document.getElementById("bapprove_batal").disabled = true ;
					  document.getElementById("bapprove_batal").style.display = "none" ;
				  }	
				  
		  }		  			  	
	 }	 
	 	 
	 function CekApprove(cetak) {
	        
			if (cetak == "approve-dirmud" ){
				  CekTOPRINT(data="xxx",cetak=true ) ;	
				  if (document.getElementById("checkbox_1")){
					  document.getElementById("checkbox_1").checked = true ;
					  document.getElementById("checkbox_1").disabled = true ;
				  }	
				  if (document.getElementById("bsave")){
					    document.getElementById("bsave").disabled = false ;
						document.getElementById("bsave").style.display = "none" ;
				  }	
				  if (document.getElementById("bapprove")){
					   document.getElementById("bapprove").disabled = false ;
					   document.getElementById("bapprove").style.display = "block" ;
				  }	
				  if (document.getElementById("bapprove_batal")){
					  document.getElementById("bapprove_batal").disabled = false ;
					  document.getElementById("bapprove_batal").style.display = "block" ;
				  }					  
		  }		  			  	
	 }	 
	
 		  	
//////////////////////////////////////////////////////////////////////////
   doMyKaryawan= function(data) {
		  var string =  data.value;
		  var explode = string.split("#");
		  var id  = explode[0];
		  var jbt_nm = explode[1]; 
		  var div_nm = explode[2]; 
		  var jbt_id = explode[3]; 
		  var div_id = explode[4]; 
		  
		  $('#pemohon_kar_id').val(id);	
		  $('#pemohon_jbt_id').val(jbt_id);	
		  $('#pemohon_div_id').val(div_id);	
		 //////////////////////////////////////
		  $('#pemohon_jbt').val(jbt_nm);
		  $('#pemohon_div').val(div_nm);	
				
    }; 
	
   doMyUser= function(data) {
		  var string =  data.value;
		  var explode = string.split("#");
		  var id  = explode[0];
		  var nama = explode[1]; 
		  $('#manager_kar_id').val(id);	
	   	  $('#manager_nama').html(nama);	
	   	
    }; 	
	
   doMyUserSetuju1= function(data) {
		  var string =  data.value;
		  var explode = string.split("#");
		  var id  = explode[0];
		  var nama = explode[1]; 
		  $('#dirmud_kar_id').val(id);	
	   	  $('#dirmud_nama').html(nama);	
    };	
	
   doMyUserSetuju2= function(data) {
		  var string =  data.value;
		  var explode = string.split("#");
		  var id  = explode[0];
		  var nama = explode[1]; 
		  $('#direktur_kar_id').val(id);
		  $('#direktur_nama').html(nama);		

    };
	
	
//	doRefreshForm(data,labe);

	function CekValueForm(data,label ) {
	      var cek = data.checked ; 
		  if (cek == undefined ){
		    //  cek = true ;
			  cek = data ;
		  }
		  
		  var cek_select = false ;
		  var label_id = "";
	  	  var display1 = "" ;
		  var display2 = "" ;
		  if (cek == true){
		      display1 = "none" ;
			  display2 = "block" ;
		  }else{
		      display1 = "block" ;
			  display2 = "none" ;
		  }
		  
         
		  if ( document.getElementById(label)){
				var e = document.getElementById(label);
				if (e.options){
				   label_id = e.options[e.selectedIndex].text;
				}else{
				   label_id = document.getElementById(label).value;
				}   
		  }	
 
 		  if (document.getElementById("div1_"+label)){
		      document.getElementById("div1_"+label).style.display = display1 ; 
		  }	
		  if (document.getElementById("div2_"+label)){
		      document.getElementById("div2_"+label).style.display = display2 ;
		  }		
		  $('#div2_'+label).html(label_id);			   		   
		 // alert(label_id);

	}

   function CekTOPRINT(data,cetak=true) {
 	    var cek = data.checked ; 
		if (cek == undefined ){
		    data = cetak ;
		}
		 
      
	   CekValueForm(data,label="jbt_id") ;
	   CekValueForm(data,label="div_id") ;
	   CekValueForm(data,label="lvl_id") ;
	   CekValueForm(data,label="unt_id") ;
	   CekValueForm(data,label="ktr_id") ;
	   CekValueForm(data,label="jumlah") ;
	   CekValueForm(data,label="status_pegawai") ;	
	   CekValueForm(data,label="tgl_kerja") ;	
 	   CekValueForm(data,label="uraian_jabatan") ;	
	  
	   CekValueForm(data,label="nama") ;	 
	   CekValueForm(data,label="jenis_kelamin") ;	
	   CekValueForm(data,label="usia") ;	
  	   CekValueForm(data,label="status_nikah") ;
	   CekValueForm(data,label="pendidikan") ;	
	   CekValueForm(data,label="pengalaman_kerja") ;	

       CekValueForm(data,label="kemampuan_lain") ;	
       CekValueForm(data,label="alasan") ;		   

	   CekValueForm(data,label="pemohon_id") ;
       CekValueForm(data,label="pemohon_jbt") ;	
	   CekValueForm(data,label="pemohon_div") ;	
	
	   CekValueForm(data,label="manager_id") ; 
	   
	   CekValueForm(data,label="dirmud_id") ; 
 	   CekValueForm(data,label="direktur_id") ;    
   }
  
 
  

   doRefreshFormA = function(data) {
        var data = data ;
	    CekTOPRINT(data) ;
   }

	//////////////////////////////////////////////
    doBTNBATAL = function() {
        alert('Ditolak');
        $('#btnDITOLAK').val('DITOLAK');
     }	
			
////////////////////to-print///////////////////////////////////////////////
     doBTNPRINT = function() {
	 
          CekTOPRINT(data="xxx",cetak=true ) ;	
		   
		  if (document.getElementById("printThis")){
		    printElement(document.getElementById("printThis"));
		  } 
		  
		  CekTOPRINT(data="xxx",cetak=false ) ;
		 
		  if (document.getElementById("checkbox_1")){
		      document.getElementById("checkbox_1").checked = false ;
		  }
		  	
     }


	  	  
	function printElement(elem) {
		//alert('printElement-xxxxxxxxx'); return false;
		var domClone = elem.cloneNode(true);
		
		var $printSection = document.getElementById("printSection");
		if (!$printSection) {
			var $printSection = document.createElement("div");
			$printSection.id = "printSection";
			document.body.appendChild($printSection);
		}
		
		$printSection.innerHTML = "";
		$printSection.appendChild(domClone);
		
		window.print();
		
     	

		
	}


//////////////////////////////////////////////////////////////////////
	
		$("#myRefresh").click(function(e){
		     //alert('refresh');
			 //dataTableKaryawan.ajax.reload(null,false);///////per-page/////////
			 dataTableKaryawan.ajax.reload();///////all-page/////////
		});


     doFilterDAY = function() {
         // alert('cek-tgl');
		  dataTableKaryawan.ajax.reload();///////all-page/////////
     }



 
/////////////////////////////////////////////////////////////////



   doMyExcel = function(table, name, filename) {
   
	let uri = 'data:application/vnd.ms-excel;base64,', 
			template = '<html xmlns:o="urn:schemas-microsoft-com:office:office" xmlns:x="urn:schemas-microsoft-com:office:excel" xmlns="http://www.w3.org/TR/REC-html40"><title></title><head><!--[if gte mso 9]><xml><x:ExcelWorkbook><x:ExcelWorksheets><x:ExcelWorksheet><x:Name>{worksheet}</x:Name><x:WorksheetOptions><x:DisplayGridlines/></x:WorksheetOptions></x:ExcelWorksheet></x:ExcelWorksheets></x:ExcelWorkbook></xml><![endif]--><meta http-equiv="content-type" content="text/plain; charset=UTF-8"/></head><body><table>{table}</table></body></html>', 
			base64 = function(s) { return window.btoa(decodeURIComponent(encodeURIComponent(s))) },         format = function(s, c) { return s.replace(/{(\w+)}/g, function(m, p) { return c[p]; })}
			
			if (!table.nodeType) table = document.getElementById(table)
			var ctx = {worksheet: name || 'Worksheet', table: table.innerHTML}
	
			var link = document.createElement('a');
			link.download = filename;
			link.href = uri + base64(format(template, ctx));
			link.click();

    }; 
	 
	 
/////////////////////////////////////////////////////////////////	
	$('#save_update_konten').submit(function(e) {
	    ///////////cek-delete /////////////
		//alert('save_update_konten'); return false;
		
	    if (x_aksi_delete != '' ){
		    x_aksi_delete = '';
		   return false ;
		}
		
        let aksi_submit = '';
		if (document.getElementById('aksi_submit') ) {
		    aksi_submit = document.getElementById('aksi_submit').value ;
	
		}
		
       //  alert(aksi_submit); return false;
		
 		//var nm = $('#user_update').val();
		var mode   = $('input[name=mode]').val();	
		var aksi   = $('input[name=aksi]').val();	
		var aksi_proses   = $('input[name=aksi_proses]').val();	
        //var nama   = $('input[name=pic_nama]').val();	
 
		//alert(aksi_proses);
		//alert(mode);

		if (confirm('Apakah Data Sudah Benar ?...')==false){
			 return false;
		}			 
		
		$.ajax({
			type: 'POST',
			url: dir_url+'/rev_data_server.php',
			enctype: 'multipart/form-data',
			data: new FormData(this),
			processData: false,
			contentType: false,
			beforeSend: function(){
			  //  $("#loading-image").show();
			  //  alert('loading');
			},		
			success: function(data) {
				var json = $.parseJSON(data);
				
					if(json.status == '1') {
				    //////////jika closing///////////////
					
						$('#modal-update-user').modal('hide');
						$('#save_update_konten').trigger("reset");
				
				
					if (aksi_proses == "edit_data"  ){
					  	dataTableKaryawan.ajax.reload(null,false);
					}else{
						dataTableKaryawan.ajax.reload(); ///////all-page///////
					}
					
					myAlert('Data Berhasil di Simpan','success');
					// window.location.reload();
				} else {
					$('#modal-update-user').modal('hide');
					$('#save_update_konten').trigger("reset");	
								
				    dataTableKaryawan.ajax.reload(null,false);
					myAlert('OK !...','success');
				    //myAlert('Data Tidak Lengkap\nSilahkan Cek Kembali !...','error');
					//alert(json.msg);
				}
			},
          error: function(data) { 
                   myAlert('Gagal !...','error');
                }   
			
		});
					
		return false;
	});

  
 /////////////////////////////////////////////////////////////////////////////
		 doPDF = function() {
			saveDoc();
		 }



//////////////////////////////////////////////////////////
    var pdf = new jsPDF('p', 'pt', 'a4');
    function saveDoc() {

        window.html2canvas = html2canvas
        const doc = document.getElementById('printThis');

        if (doc) {
           // console.log("div is ");
           // console.log(doc);
           // console.log("hellowww");
            pdf.html(document.getElementById('printThis'), {
                callback: function (pdf) {
				    alert('save_to_pdf');
                    pdf.save('DOC.pdf');
                }
            })
       }
     }
/////////////////////////////////////////////////////////
		function TEST_PDF() {
		    
	
			var doc = new jsPDF();
			var elementHTML = $('#content').html();
			
			var specialElementHandlers = {
				'#elementH': function (element, renderer) {
					return true;
				}
			};


			
	
			doc.fromHTML(elementHTML, 15, 15, {
				'width': 170,
				'elementHandlers': specialElementHandlers
			});
			doc.save('form-tenaga-kerja.pdf');
		
		}	  	  	 
/////////////////////////////////////////////////////////
        function ExportPDF() {
		    alert('PDF');
            html2canvas(document.getElementById('printThis'), {
                onrendered: function (canvas) {
                    var data = canvas.toDataURL();
                    var docDefinition = {
					     pageOrientation: 'landscape',
                        content: [{
  							image: data,
                            width: 780,
                            }]
                    };
//                    pdfMake.createPdf(docDefinition).download("Tabel.pdf");
					pdfMake.createPdf(docDefinition).open();					
                }
            });
        }
	 	
}); ////* eof => (document.ready) *///

////////////////////////////////////////////////////////////////////////////////




var windowObjectReference = null; // global variable
function OpenPopupCenterNew(pageURL) {
    var title = "TEST!";
//	var w = 600;
	var w = 800;
	var h = 500;
    var left = (screen.width - w) / 2;
    var top = (screen.height - h) / 4;  

  if(windowObjectReference == null || windowObjectReference.closed) {
	    windowObjectReference = window.open(pageURL, title, 'toolbar=no, location=no, directories=no, status=no, menubar=yes, scrollbars=yes, resizable=yes,titlebar=no, copyhistory=no, width=' + w + ', height=' + h + ', top=' + top + ', left=' + left);

  } else {
  
    windowObjectReference.close();
	windowObjectReference = window.open(pageURL, title, 'toolbar=no, location=no, directories=no, status=no, menubar=yes, scrollbars=yes, resizable=yes,titlebar=no, copyhistory=no, width=' + w + ', height=' + h + ', top=' + top + ', left=' + left);			
	
  };


} ;



function exportTableToExcel(tableID, filename = ''){

    var downloadLink;
    var dataType = 'application/vnd.ms-excel';
    var tableSelect = document.getElementById(tableID);
    var tableHTML = tableSelect.outerHTML.replace(/ /g, '%20');
    
    // Specify file name
    filename = filename?filename+'.xls':'excel_data.xls';
    
    // Create download link element
    downloadLink = document.createElement("a");
    
    document.body.appendChild(downloadLink);
    
    if(navigator.msSaveOrOpenBlob){
        var blob = new Blob(['\ufeff', tableHTML], {
            type: dataType
        });
        navigator.msSaveOrOpenBlob( blob, filename);
    }else{
        // Create a link to the file
        downloadLink.href = 'data:' + dataType + ', ' + tableHTML;
    
        // Setting the file name
        downloadLink.download = filename;
        
        //triggering the function
        downloadLink.click();
    }
}
		


function tableToExcel(table, name, filename) {

        let uri = 'data:application/vnd.ms-excel;base64,', 
        template = '<html xmlns:o="urn:schemas-microsoft-com:office:office" xmlns:x="urn:schemas-microsoft-com:office:excel" xmlns="http://www.w3.org/TR/REC-html40"><title></title><head><!--[if gte mso 9]><xml><x:ExcelWorkbook><x:ExcelWorksheets><x:ExcelWorksheet><x:Name>{worksheet}</x:Name><x:WorksheetOptions><x:DisplayGridlines/></x:WorksheetOptions></x:ExcelWorksheet></x:ExcelWorksheets></x:ExcelWorkbook></xml><![endif]--><meta http-equiv="content-type" content="text/plain; charset=UTF-8"/></head><body><table>{table}</table></body></html>', 
        base64 = function(s) { return window.btoa(decodeURIComponent(encodeURIComponent(s))) },         format = function(s, c) { return s.replace(/{(\w+)}/g, function(m, p) { return c[p]; })}
        
        if (!table.nodeType) table = document.getElementById(table)
        var ctx = {worksheet: name || 'Worksheet', table: table.innerHTML}

        var link = document.createElement('a');
        link.download = filename;
        link.href = uri + base64(format(template, ctx));
        link.click();
}




        function Export_pdf() {
            html2canvas(document.getElementById('printableArea'), {
                onrendered: function (canvas) {
                    var data = canvas.toDataURL();
                    var docDefinition = {
					     pageOrientation: 'landscape',
                        content: [{
  							image: data,
                            width: 780,
                            }]
                    };
//                    pdfMake.createPdf(docDefinition).download("Tabel.pdf");
					pdfMake.createPdf(docDefinition).open();					
                }
            });
        }


function isNumberKey(event)
	{
		var charCode = (event.which) ? event.which : event.keyCode;
		if (charCode != 46 && charCode > 31 
		&& (charCode < 48 || charCode > 57))
		return false;
		return true;
	}



////////////////////////////////////////////////////////////////



</script>

