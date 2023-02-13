<?php 
 
 date_default_timezone_set('Asia/Jakarta');
// include('module/kasbon_databarang/databarang_act.php');
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
<form  class="form-horizontal" method="POST" id="form1"  name="input" 
       enctype="multipart/form-data" action="#">

<input type="hidden"  name="p" value="<?php echo $_REQUEST['p'] ; ?>"    >
	
    <br />
    <section class="content-header">
<!--	
	  <a href="?p=tambah_data_barang" class='btn btn-success'><i class="fa fa-bell"></i> Tambah Data Barang </a>
!-->	  
       <a href='#myModalAddbarang' class='btn btn-info' title="Tambah Data Barang" 
	      data-toggle='modal' data-id="<?php echo 'add' ?>">
		  <i class="fa fa-plus"></i> 
	  </a>					
<!--  <a href="?p=kasbon_data_barang" class='btn btn-primary'><i class="fa fa-refresh"></i>&nbsp; </a> !-->
    <a href="#" id="myRefresh"  class='btn btn-primary'><i class="fa fa-refresh"></i>&nbsp; </a> 
		   	
      <ol class="breadcrumb">
        <li><a href="media.php"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li class="active"><?php echo $title;?></li>
      </ol>
    </section>
	
</form>	

<!-- Main content -->
<section class="content"> 

<div class="row"   >
 <div class="col-lg-10 connectedSortable "  >  
            <!-- /.box-header -->
       <div class="box box-solid box-primary " >
            <div class="box-header with-border">
              <center>
			  <h3 class="box-title">
			  	<label>Data Items Barang</label>
			  </h3>
            </div>
            <!-- /.box-header -->
        <div class="box-body table-responsive" id="list-barang"   > <!--table-responsive-->
				<table id="tb_barang" class="table table-bordered table-striped">
					<thead>
						<tr>
							<th width="5%">No</th>
							<th width="5%">Kode</th>
							<th width="50%">Nama Barang</th>
							<th width="10%">Harga</th>
							<th width="10%">Kelompok</th>
							<th width="5%">Aksi</th>
						</tr>
					</thead>
				</table>
		    

  </div>
  
</div> <!-- /.row -->

</section>
<!-- /.content --> 




<div class="modal fade" id="myModalbarang" role="dialog"  >
        <div class="modal-dialog modal-lg" role="document" >
            <div class="modal-content" >
                <div class="modal-body">
					<form id="myform"   name="myform"   method="post" enctype="multipart/form-data"> 
	                      <div class="fetched-data"></div>
						  <div class="modal-footer">
							   <button type="submit" class="btn btn-primary save-updbarang" 
										onClick="#return confirm('Save Data ?')" >
										<span class="fa fa-save"></span> Simpan 
								</button>
							   <button type="button" class="btn btn-default" data-dismiss="modal">cancel</button>
						  </div>						
					</form>
                </div>
            </div>
        </div>
</div>


<div class="modal fade" id="myModalAddbarang" role="dialog"  >
        <div class="modal-dialog modal-lg" role="document" >
            <div class="modal-content" >
                <div class="modal-body">
					<form id="myformAdd"   name="myformAdd"   method="post" enctype="multipart/form-data"> 
	                    <div class="fetched-data-add"></div>
						  <div class="modal-footer">
							   <button type="submit" class="btn btn-primary save-addbarang" 
										onClick="#return confirm('Save Data ?')" >
										<span class="fa fa-save"></span> Simpan 
								</button>
							   <button type="button" class="btn btn-default" data-dismiss="modal">cancel</button>
						  </div>						
						
					</form>	
                </div>
            </div>
        </div>
</div>






  <script type="text/javascript">
  
 

  
  $(document).ready(function(){
        /////////////////////////////////////////////////////
		var dataTable = $('#tb_barang').DataTable({
			"processing":true,
			"serverSide":true,
	//		"order":[],
			"ajax":{
				url:"module/kasbon_databarang/fetch_brg.php",
				type:"POST"
			},
			"iDisplayLength": 10,
			"aLengthMenu": [[5,10, 20, 50, 100, 200, 300,400,-1], [5,10, 20, 50, 100, 200, 300,400,'All']],
			"order": [[ 1, 'asc' ],[ 2, 'asc' ]],	
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
    

        $('#myModalbarang').on('show.bs.modal', function (e) {
            var rowid = $(e.relatedTarget).data('id');
            var p     = $(e.relatedTarget).data('p');
            //menggunakan fungsi ajax untuk pengambilan data
            $.ajax({
                type : 'post',
                url : 'module/kasbon_databarang/databarang-edit.php',
                data :  {rowid:rowid, p:p , aksi:'edit'},
                success : function(data){
              	  $('.fetched-data').html(data);//menampilkan data ke dalam modal
                }
            });
         });


       $('#myModalAddbarang').on('show.bs.modal', function (e) {
            var rowid = $(e.relatedTarget).data('id');
			var p     = $(e.relatedTarget).data('p');
            //menggunakan fungsi ajax untuk pengambilan data
            $.ajax({
                type : 'post',
                url : 'module/kasbon_databarang/databarang-edit.php',
                data :  {rowid:rowid, p:p ,aksi:'add' },
                success : function(data){
	                $('.fetched-data-add').html(data);//menampilkan data ke dalam modal
                }
            });
         });



	$("#myRefresh").click(function(e){
		 dataTable.ajax.reload(null,false);
	});

	/* Update user */
	$(".save-updbarang").click(function(e){
				var form = document.myform;
				var dataString = $(form).serialize();
				
				//var x = document.getElementById("aksi").value;
				//alert('save-data');
				$.ajax({
					type:'POST',
					url: 'module/kasbon_databarang/databarang_act.php',
					data: dataString,
					success: function(data){
					    if (data=='OK' ){
						  //alert('Data Gagal Tersimpan ... Silahkan Cek Kembali !...');
						   myAlert('Data Berhasil di Simpan','success');
						}
						//$("#list-barang").load(" #list-barang > *");	
						//$("#tb_barang").load(" #tb_barang > *");
						//location.reload(); 
						$(".modal").modal('hide');
						dataTable.ajax.reload(null,false);
						//  $('#myResponse').html(data);
						//alert('Data Tersimpan');
						
			
					},
				   error: function(){
						/////refresh edit-krs////
						//$("#edit-krs").load(" #edit-krs > *");			
						$(".modal").modal('hide');
						alert('Data Error');
					}						
				});	
				
				//$('#myform')[0].reset(); 
				
				return false
		/////////////////////////////////////////////////////////////////////////////
	
	});

 
 
 	/* Update user */
	$(".save-addbarang").click(function(e){
				var form = document.myformAdd;
				var dataString = $(form).serialize();
				//alert('save-data');
				$.ajax({
					type:'POST',
					url: 'module/kasbon_databarang/databarang_act.php',
					data: dataString,
					success: function(data){
					    if (data=='NO' ){
						  //alert('Data Gagal Tersimpan ... Silahkan Cek Kembali !...');
  						   myAlert('Data Gagal Tersimpan\nSilahkan Cek Kembali !...','error');
						   return false;
						}
						//$("#list-barang").load(" #list-barang > *");	
						//$("#tb_barang").load(" #tb_barang > *");
						//location.reload(); 
						$(".modal").modal('hide');
						dataTable.ajax.reload(null,false);
						//  $('#myResponse').html(data);
						//alert('Data Tersimpan');
						
			
					},
				   error: function(){
						/////refresh edit-krs////
						//$("#edit-krs").load(" #edit-krs > *");			
						$(".modal").modal('hide');
						alert('Data Error');
					}						
				});	
				
				//$('#myform')[0].reset(); 
				
				return false
		/////////////////////////////////////////////////////////////////////////////
	
	});

	 	
////////////////////////////////////////////////////////////////
    });




  </script>
  
<!-- Bootstrap 3.3.5 -->
<!-- <script src="bootstrap/js/bootstrap.min.js"></script> !-->
