<?php 
 
 date_default_timezone_set('Asia/Jakarta');
 include('module/data-cuti/cuti_act.php');
 
 $kar_id  = $kar_data['kar_id'];	
 $kar_nik = $kar_data['kar_nik'];	

?>
<script>
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
		
</script>

<!-- Content Header (Page header) -->
<form  class="form-horizontal" method="POST" id="form1"  name="input" 
       enctype="multipart/form-data" action="#">

<input type="hidden"  name="p" value="<?php echo $_REQUEST['p'] ; ?>"    >
	
    <br />
    <section class="content-header">
           <?php if( $kar_id=="0499"  ){ ?>
		      <span style="cursor:pointer" 
			  class="btn btn-primary" data-toggle="modal" data-target="#myModalImport">
			  <i class="fa fa-file-excel-o"></i> Import
			  </span>
		  <?php } ?>	
		  <?php
			 $url_xls   = "./module/data-cuti/excel_cuti.php";
			 $url_xls  .= "?drtgl=$tgl_ori&sdtgl=$tgl_ori2&act=excel";	
		  
		  ?>		    
	       <?php if(  $kar_id==248  || $kar_id==499  || $kar_id == 447 
	       		 || $kar_id == 542 || $kar_id == 551 || $kar_id==37 || $kar_id==246 ){ ?>	  
		     <a href="?p=cuti_notifikasi_all" class='btn btn-success'>
				 <i class="fa fa-bell"></i> Data Permohonan Cuti 
			 </a>
			 
  		<a href="#" class='btn btn-success'  onclick="OpenPopupCenter('<?php echo $url_xls ?>', 'TEST!?', 900, 500)" title="Export Excel" >
  		 	<i class="fa fa-folder-open-o"></i> Export to Excel 
		 </a>   			 
			<?php } ?>	 


  			 			 
		   <a href="?p=cuti" class='btn btn-primary'><i class="fa fa-refresh"></i>&nbsp; </a>
      <ol class="breadcrumb">
        <li><a href="media.php"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li class="active"><?php echo $title;?></li>
      </ol>
    </section>
	
</form>	

<!-- Main content -->
<section class="content"> 

<div class="row">
 <div class="col-lg-12 connectedSortable ">  
            <!-- /.box-header -->
          <div class="box box-solid box-primary  ">
            <div class="box-header with-border">
              <center>
			  <h3 class="box-title">
			  	<label>Data Cuti Karyawan</label>
			  </h3>
            </div>
            <!-- /.box-header -->
        <div class="box-body table-responsive"> <!--table-responsive-->
              <table id="tb_cuti" class="table table-bordered table-striped table-hover " 
			  style="font-size:14px;font-weight: normal;">
                <thead>
                  <tr >
                    <th style="text-align:center">No</th>
                    <th style="text-align:center">Group</th>
                    <th style="text-align:center">Divisi</th>
                    <th style="text-align:center">Nama</th>
                    <th style="text-align:center">Jabatan</th>
                    <th style="text-align:center">Hak Cuti</th>
                    <th style="text-align:center">Cuti Yg  <br />diambil</th>
                    <th style="text-align:center">Jumlah <br />SisaCuti</th>
                    <th style="text-align:center; width:300px">Tanggal Cuti</th>
                    <th style="text-align:center">Simpan <br />Libur</th>
                    <th style="text-align:center">Simpan Libur</th>
                    <th style="text-align:center">Aksi</th>
					
                  </tr>
                </thead>
                <tbody>
                <?php
				    //include('inc/koneksi.php');
                
				$cari_jenis   = $_REQUEST['iddiv'];
					
				if 	($kar_id==13 || $kar_id==499 || $kar_id==447 ||  $kar_id == 430 || $kar_id == 542 || $kar_id == 535 || $kar_id == 551 || $kar_id == 37 || $kar_id==246 )
				{
				     $filter_nik = "";
				}else{
				    $filter_nik = " AND a.kar_nik = '$kar_nik' ";
				   // $filter_nik = " AND a.kar_nik = 'xxxxxxxx' ";
				}	
			    if ($_REQUEST['id'] <> ""){
				    $filter_nik = " AND a.kar_id = '".$_REQUEST['id']."' ";
				}
				$sql  =" SELECT 
						e.tahun,a.kar_id,a.kar_nik as nik,a.kar_nm as nama,d.jbt_nm as jabatan,
						c.div_nm as divisi,
						b.kar_dtl_sts_krj as status,e.jml_cuti,e.jml_simpan_libur, e.sisa_cuti, e.datacuti,
						e.dataket, e.datavalid, e.simpan_libur, e.simpan_libur_ambil
						FROM kar_master a
						LEFT JOIN kar_detail b ON b.kar_id=a.kar_id 
						LEFT JOIN div_master c ON c.div_id=a.div_id
						LEFT JOIN jbt_master d ON d.jbt_id=a.jbt_id
						LEFT JOIN cuti_master e ON e.kar_id=a.kar_id
						WHERE b.kar_dtl_sts_krj='A' and kar_dtl_typ_krj <> 'Resign'  $filter_nik 
						ORDER BY c.div_nm, a.kar_nik
						 ";		
						 			
					//echo $sql;	
							
					$q_cuti   = mysql_query($sql);
					$no=0;
				while ($r=mysql_fetch_array($q_cuti)){
				      $no++;
//				   $acuti = explode('#',$eco->dcrypt($r['datacuti']));	
				      $cek_kar_id = $r['kar_id'];
				  	  $acuti = $r['datacuti'];	
				   	  $aket  = $r['dataket'];
						  //////////////////////////////////////////
  					  $xcuti =explode("#",$acuti);
 					  $j_cuti = 0; 
					  for ($i=0; $i<count($xcuti); $i++ ) { 
					     if ($xcuti[$i] != ""){
						    $j_cuti++ ;
						 } 
 		 
					   } ;
					   
					  $a_valid  = $r['datavalid'];	
					  $x_valid  = explode("#",$a_valid);
					  $j_valid = 0; 
					  for ($a=0; $a<count($x_valid); $a++ ) { 
					     if ($x_valid[$a] == "Y"){
						     $j_valid++ ;
						 } 
	 		 
					   } ;					   
					   
					 // if ( $cek_kar_id==61){
					 // 	eho 'Robet';exit;
					//  }

					  $sisa_cuti = $r['jml_cuti'] - $j_valid;
					  
					 // $sisa_cuti = $r['sisa_cuti'];	
						  
				      $xsisa_cuti ='<span class="label label-primary">'.$sisa_cuti.
						             '</span>'.'&nbsp;&nbsp;' ;
					  
					  if ($sisa_cuti < 0 ){
					     $xsisa_cuti ='<span class="label label-danger">'.$sisa_cuti.
						             '</span>'.'&nbsp;&nbsp;' ;
					  } 


					
		?>
                  <tr style="text-align:left">
                    <td><?php echo $no; ?></td>
                    <td><?php echo $r['divisi']; ?></td>
                    <td>&nbsp;&nbsp;<?php echo $r['nik'];?></td>
                    <td><?php echo $r['nama']; ?></td>
                    <td><?php echo $r['jabatan'];?></td>
                    <td align="center"><?php echo $r['jml_cuti'];?></td>
                    <td align="center"><?php echo $j_valid; //$j_cuti;?>
					 <br />
					 <a href="?p=form-cuti&act=open&id=<?php echo $r['kar_id'];?>" 
					 	class='btn btn-success' title="ajukan cuti">
					 		<i class="fa fa-file"></i> Form Cuti 
					 </a>
					</td>
                    <td align="center"><?php echo $xsisa_cuti ;?></td>
                    <td align="left" >
					<div style="">
					<?php 
					   $xtgl  =explode("#",$acuti);
					   $xket  =explode("#",$aket);
					   $x = 0 ;
					   echo '<ol>';
					   for ($i=0; $i<count($xtgl); $i++ ) { 
					     if ($xtgl[$i] != ""){
						   $text_ket = "";
						   if ($xket[$i] !=""){
						      $text_ket = '<span class="label label-primary" >'.' '.$xket[$i].' '.'</span>';
						   }
						   $xket_valid = ' <font color=red><i> (pengajuan-cuti) </i></font>';
						   if ($x_valid[$i] == "Y"){
							   $xket_valid = '';
						   }						   
						   $text_tgl = '<b>'.$xtgl[$i].":".$text_ket.'</b>'.$xket_valid;
						   $x++;
/*	 
						   echo $x.')<li  class="label label-danger" title="'.$xket[$i].'" >'.$text_tgl.
						         '</li>'.'&nbsp;&nbsp;' ;
						   echo '<br>';
*/						   		 
						   echo '<li> ) '.$text_tgl.'</li>';
						 } 		 
					   } ;
					   echo '</ol>';
					   
					?>
					</div>
					</td>
                    <td align="center"><?php echo $r['jml_simpan_libur'];?></td>

                    <td align="left">
					<?php 
					 if ($kar_id==499 || $kar_id==447  || $kar_id==542 || $kar_id == 551  || $kar_id==37 || $kar_id==246 ) { 
					?>
					  <div style="text-align:center">
						  <a href='#mySimpanLibur' class='label label-info' title="Edit Simpan Libur" 
							  data-toggle='modal' data-id="<?php echo $r['kar_id'] ?>">
							  <i class="fa fa-pencil"></i> 
						  </a>	
					  </div>				
                    <?php } ;?> 
										
					<?php 
					   $xtgl2  =explode("#",$r['simpan_libur']);
					   $xtgl3  =explode("#",$r['simpan_libur_ambil']);
					   $x = 0 ;
					   for ($i=0; $i<count($xtgl2); $i++ ) { 
					     if ($xtgl2[$i] != "" and  $xtgl3[$i] == "" ){
							 if ($xtgl2[$i] != ""){
							   $text_ket = "";
							   if ($xtgl2[$i] <> ""){
								  $text_ket = '<span class="label label-primary">'.' simpan libur '.'</span>';
							   }
							   $text_tgl = date('d-m-Y',strtotime($xtgl2[$i]))." ".$text_ket;
							   $x++;
							   echo $x.')<a  class="label label-danger" title="'.$xket[$i].'" >'.$text_tgl.
									 '</a>'.'&nbsp;&nbsp;' ;
							   echo '<br>';		 
							 } 		 
						 }
					   } ;
					?>

					
					</td>

                    <td>
					<?php 
					 ///447=nopita 453=isman /// 
					 if ($kar_id==499 || $kar_id==542 || $kar_id==447 || $kar_id == 551 || $kar_id==37 || $kar_id==246 ) { 
					?>
                      <a href='#myModalCuti' class='label label-primary' title="Edit Data Cuti" 
				      data-toggle='modal' data-id="<?php echo $r['kar_id'] ?>">
					  <i class="fa fa-pencil"></i> 
					  </a>					
                    <?php } ;?> 
                    </td>
                  </tr>
                <?php } ;?>  
                </tbody>  
              </table>


  </div>


  


  
</div> <!-- /.row -->

</section>
<!-- /.content --> 




<div class="modal fade" id="myModalCuti" role="dialog"  >
        <div class="modal-dialog modal-lg" role="document" >
            <div class="modal-content" >
<!--			
		        <div class="modal-header ">
    	        	<button type="button" class="close" data-dismiss="modal">&times;</button>
                	<h4 class="modal-title">Detail</h4>
		        </div>		
!-->						
                <div class="modal-body">
                    <div class="fetched-data"></div>
                </div>
<!--				
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Keluar</button>
                </div>
!-->				
            </div>
        </div>
</div>

<div class="modal fade" id="mySimpanLibur" role="dialog"  >
        <div class="modal-dialog modal-md" role="document" >
            <div class="modal-content" >
                <div class="modal-body">
                    <div class="fetched-data-sl"></div>
                </div>
            </div>
        </div>
</div>



<!-- Modal -->

<div class="modal fade" id="myModalImport" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" 
	aria-hidden="true">

  <div class="modal-dialog">

    <div class="modal-content">

      <div class="modal-header bg-primary">

        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
		<span aria-hidden="true">&times;</span></button>

        <h4 class="modal-title" id="myModalLabel"><i class="fa fa-calendar"></i> Upload File Cuti</h4>

      </div>

      <form class="form-horizontal" action="" method="post" enctype="multipart/form-data">

      <div class="modal-body">
<!--	  
          <div class="form-group">
            <label for="jdw_bulan" class="col-sm-2 control-label">Bulan</label>
            <div class="col-sm-5">
              <input type="text" name="jdw_bulan" class="form-control dpmonth2" id="jdw_bulan" 
			  placeholder="Bulan" required  >
            </div>
          </div>
!-->
		  <div class="form-group">
            <label for="jdw_file" class="col-sm-2 control-label">File</label>
            <div class="col-sm-10">
              <div class="btn btn-default btn-file" id="file">
                    <i class="fa fa-paperclip"></i> Attachment File
              </div>
                    <input type="file" name="jdw_file" 
						accept="application/vnd.openxmlformats-officedocument.spreadsheetml.sheet"
					 required />
                    <small class="help-block"><em>Max. 5MB</em></small>
            </div>
          </div>

      <div class="modal-footer">
        <button type="submit" name="bimport" class="btn btn-primary btn-block hidden-lg">
			<i class="fa fa-upload"></i>
		</button>
		<div class="pull-right"><button type="submit" name="bimport" class="btn btn-primary visible-lg">
			<i class="fa fa-upload"></i></button>
		</div>
      </div>

      </form>

    </div>

  </div>

</div>




<!-- jQuery 2.1.4 -->

<script src="plugins/jQuery/jQuery-2.1.4.min.js"></script> 

<!-- <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script> !-->

  <script type="text/javascript">
    $(document).ready(function(){
      /////////////////////////
		var save_method; //for save method string
		var table;
	    var groupColumn = 1;
	  $('#tb_cuti').dataTable({
/*	  
		iDisplayLength: 10,
		aLengthMenu: [[10, 20, 50, 100,-1], [10, 20, 50, 100,'All']],							
	    scrollY:        "300px",
	    scrollX:        true,
	    scrollCollapse: true,
	    paging:         true,
	    fixedColumns:   {
    	        leftColumns: 4,
	            rightColumns: 2
	    },
	    aaSorting : [[2, 'asc']],
*/		
		"iDisplayLength": 10,
		"aLengthMenu": [[5,10, 20, 50, 100, 200, 300,400,-1], [5,10, 20, 50, 100, 200, 300,400,'All']],

	    "order": [[ 1, 'asc' ],[ 2, 'asc' ]],	
	  	"aoColumnDefs": [
			  {"bSortable": false,"bVisible": false,"aTargets": [ 0 ]},
			  {"bSortable": true,"bVisible": false,"aTargets": [ 1 ]},
			  {"bSortable": false,"aTargets": [ -1 ]},
		 ],		  		
        "displayLength": 25,
        "drawCallback": function ( settings ) {
            var api = this.api();
            var rows = api.rows( {page:'current'} ).nodes();
            var last=null;
            api.column(groupColumn, {page:'current'} ).data().each( function ( group, i ) {
                if ( last !== group ) {
                    $(rows).eq( i ).before(
                        '<tr class="group" ><td colspan="8" style="font-size:12">' + ' <b>' + group  + '</b></td>'
						 +'</tr>'
					)	 
	                last = group;
                }
            } );
        },
		

	  });
	  
	  

        $('#myModalCuti').on('show.bs.modal', function (e) {
            var rowid = $(e.relatedTarget).data('id');
            //menggunakan fungsi ajax untuk pengambilan data
            $.ajax({
                type : 'post',
                url : 'module/data-cuti/cuti-edit.php',
                data :  'rowid='+ rowid,
                success : function(data){
                $('.fetched-data').html(data);//menampilkan data ke dalam modal
                }
            });
         });


         $('#mySimpanLibur').on('show.bs.modal', function (e) {
            var rowid = $(e.relatedTarget).data('id');
            //menggunakan fungsi ajax untuk pengambilan data
            $.ajax({
                type : 'post',
                url : 'module/data-cuti/fetched-edit-simpan-libur.php',
                data :  'rowid='+ rowid,
                success : function(data){
                $('.fetched-data-sl').html(data);//menampilkan data ke dalam modal
                }
            });
         });



    });
  </script>
  
<!-- Bootstrap 3.3.5 -->
<!-- <script src="bootstrap/js/bootstrap.min.js"></script> !-->
