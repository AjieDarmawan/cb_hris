<?php 
 
 date_default_timezone_set('Asia/Jakarta');
// include('module/kasbon_databarang/databarang_act.php');
 
 $kar_id  = $kar_data['kar_id'];	
 $kar_nik = $kar_data['kar_nik'];	

?>


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
	   <a href="?p=kasbon_data_barang" class='btn btn-primary'><i class="fa fa-refresh"></i>&nbsp; </a>
		   	
      <ol class="breadcrumb">
        <li><a href="media.php"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li class="active"><?php echo $title;?></li>
      </ol>
    </section>
	
</form>	

<!-- Main content -->
<section class="content"> 

<div class="row"  >
 <div class="col-lg-12 connectedSortable " >  
            <!-- /.box-header -->
          <div class="box box-solid box-primary  ">
            <div class="box-header with-border">
              <center>
			  <h3 class="box-title">
			  	<label>Data Items Barang</label>
			  </h3>
            </div>
            <!-- /.box-header -->
        <div class="box-body table-responsive" id="list-barang" > <!--table-responsive-->
              <table id="tb_barang" class="table table-bordered table-striped table-hover " 
			  style="font-size:14px;font-weight: normal;">
                <thead>
                  <tr >
                    <th style="text-align:center">No</th>
                    <th style="text-align:center">kdBarang</th>
                    <th style="text-align:center">Nama Barang</th>
                    <th style="text-align:center">Harga</th>
                    <th style="text-align:center">Kelompok</th>
                    <th style="text-align:center">Aksi</th>
					
                  </tr>
                </thead>
                <tbody>
                <?php
				    //include('inc/koneksi.php');
                
				$sql  =" SELECT * from barang_master ";		
				$q_brg   = mysql_query($sql);
				$no=0;
				while ($r=mysql_fetch_array($q_brg)){
				   $no++;
				   $kdklp = $r['kdklp'];
				   $xklp  = "";
				   if ($kdklp =="1"){
				     $xklp = "Operasinoal";
				   }elseif($kdklp=="2"){
				      $xklp ="Marketing Tools";
				   }elseif($kdklp=="3"){
				      $xklp ="ATK";
				   }elseif($kdklp=="4"){
				      $xklp ="Komsumsi";
				   }
					
		?>
                  <tr style="text-align:left">
                    <td><?php echo $no; ?></td>
                    <td><?php echo $r['kode_barang']; ?></td>
                    <td><?php echo $r['nama_barang'];?></td>
                    <td align="right"><?php echo number_format($r['harga1']);?></td>
                    <td><?php echo $xklp;?></td>

                    <td>
					<?php 
					 //if ($kar_id==499 || $kar_id==509 ) { 
					?>
                      <a href='#myModalbarang' class='label label-primary' title="Edit Data Barang" 
				      data-toggle='modal' data-id="<?php echo $r['id'] ?>" data-p="<?php echo $p ?>">
					  <i class="fa fa-pencil"></i> 
					  </a>					
                    <?php //} ;?> 
                    </td>
                  </tr>
                <?php } ;?>  
                </tbody>  
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
							   <button type="submit" class="btn btn-primary save-databarang" 
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
                    <div class="fetched-data-add"></div>
                </div>
            </div>
        </div>
</div>







<!-- jQuery 2.1.4 -->

<script src="plugins/jQuery/jQuery-2.1.4.min.js"></script> 

<!-- <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>  !-->

  <script type="text/javascript">
    $(document).ready(function(){
      /////////////////////////
	    
		var save_method; //for save method string
		var table;
	    var groupColumn = 1;
	    var table = $('#tb_barang').dataTable({
		"iDisplayLength": 10,
		"aLengthMenu": [[5,10, 20, 50, 100, 200, 300,400,-1], [5,10, 20, 50, 100, 200, 300,400,'All']],
	    "order": [[ 1, 'asc' ],[ 2, 'asc' ]],	
	  	"aoColumnDefs": [
			  {"bSortable": false,"bVisible": true,"aTargets": [ 0 ]},
			  {"bSortable": false,"aTargets": [ -1 ]},
		 ],		  		
        "displayLength": 25,
	  });

    

        $('#myModalbarang').on('show.bs.modal', function (e) {
            var rowid = $(e.relatedTarget).data('id');
            var p     = $(e.relatedTarget).data('p');
            //menggunakan fungsi ajax untuk pengambilan data
            $.ajax({
                type : 'post',
                url : 'module/kasbon_databarang/databarang-edit.php',
                data :  {rowid:rowid, p:p },
                success : function(data){
                $('.fetched-data').html(data);//menampilkan data ke dalam modal
                }
            });
         });


       $('#myModalAddbarang').on('show.bs.modal', function (e) {
            var rowid = $(e.relatedTarget).data('id');
            //menggunakan fungsi ajax untuk pengambilan data
            $.ajax({
                type : 'post',
                url : 'module/kasbon_databarang/databarang-edit.php',
                data :  'rowid='+ rowid,
                success : function(data){
                $('.fetched-data-add').html(data);//menampilkan data ke dalam modal
                }
            });
         });


	function refresh_table() {	  
		 alert('reload-table');
		 //tablebrg.reload();
	 }


	/* Update user */
	$(".save-databarang").click(function(e){
				var form = document.myform;
				var dataString = $(form).serialize();
				//alert('save-data');
				$.ajax({
					type:'POST',
					url: 'module/kasbon_databarang/databarang_act.php',
					data: dataString,
					success: function(data){
						//$("#list-barang").load(" #list-barang > *");	
						$("#tb_barang").load(" #tb_barang > *");
						//location.reload(); 
						$(".modal").modal('hide');
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
				//alert('simpan data barang');
				return false
		/////////////////////////////////////////////////////////////////////////////
	
	});


	
////////////////////////////////////////////////////////////////
    });
	
   


	
	
  </script>
  
<!-- Bootstrap 3.3.5 -->
<!-- <script src="bootstrap/js/bootstrap.min.js"></script> !-->
