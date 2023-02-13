<?php 
session_start();
require('module/salary/salary_act.php'); 
$kar_id  = $kar_data['kar_id'];	
$kar_nik = $kar_data['kar_nik'];	

?>

<!-- Content Header (Page header) -->

    <section class="content-header">

      <h1> <?php echo $title;?> <small><?php //echo substr($tgl->tgl_indo($datemax), 3,20);?></small> </h1>

      <ol class="breadcrumb">

        <li><a href="media.php"><i class="fa fa-dashboard"></i> Dashboard</a></li>

        <li class="active"><?php echo $title;?> <?php //echo substr($tgl->tgl_indo($datemax), 3,20);?></li>

      </ol>

    </section>

    

    <!-- Main content -->

    <section class="content"> 

      

      <!-- Your Page Content Here -->

      <div class="row">

        <div class="col-xs-12">

            

            <div class="nav-tabs-custom">


            <ul class="nav nav-tabs pull-right">
              <?php

               if( $kar_id == "0021" || $kar_id=="0037"  || $kar_id == "0248" ){ //kalo ada yang ganti kena SP - dyan
              	 	
              ?>
              <li class="pull-left header" ><span style="cursor:pointer"  
			  class="label label-primary" data-toggle="modal" data-target="#myModal">
			  <i class="fa fa-file-excel-o"></i> Import</span>
			  </li>
			  
			 <form name="form" action="#"  method="post" class="form-horizontal" > 
          	 <select class="form-control select2" name="bulan" 
		   	 	 aria-describedby="sizing-addon2" style="width:150px; height:40px "
				 onchange="this.form.submit()" <?php echo $disabled2;?>  >
          <?php
	        $kode = $bulan;
			$query_bln =mysql_query("SELECT * FROM salary_periode ORDER BY id DESC ");
			while($r1 = mysql_fetch_array($query_bln)){
             $selected ="";
			 $cek_periode=$r1['periode'];
             if ($cek_periode==$kode){
			    $selected="selected";
			 }
		     echo "<option value='$cek_periode'".$selected.">".ucwords($cek_periode)." </option>";
			
			}
		  ?>			 		 
           	 </select>
			 </form>
       <?php }else{ // keuangan// ?>		
	         <li class="pull-left header">
			          <span>
                      <a href='#myModalPsw' class='label label-primary' title="Gangi Password" 
				      data-toggle='modal' data-id="<?php echo $kar_id ?>">
					  <i class="fa fa-pencil"></i> Ganti Password eSLIP
					  </a>	
					  </span>					 
			 </li>	
			 <?php if ($kar_id == 430 ) { ?>
	         <li class="pull-left header">
			          <span>
                      <a href='#myModalPassReset' class='label label-primary' title="Gangi Password" 
				      data-toggle='modal' data-id="<?php echo $kar_id ?>">
					  <i class="fa fa-pencil"></i> Reset Pasword eSLIP
					  </a>	
					  </span>					 
			 </li>	
             <?php } ?>
     <?php } ?>	
	 		  
            </ul>
            <div class="tab-content">
<!--             <div class="tab-pane active visible-lg-block">  !-->
         <div class="box-body">			  
          <table id="tb_salary" class="table table-hover table-striped table-bordered nowrap" style="width:100%"> 
		    <thead>
			<tr>
			    <th  class="pinned" ><div style="vertical-align:middle; text-align:center;width:70px">Periode</div></th>
			    <th  class="pinned" ><div style="vertical-align:middle; text-align:center;width:100px">Nama</div></th>
			    <th  class="pinned" ><div style="vertical-align:middle; text-align:center;">NIK</div></th>
			    <th  class="pinned" ><div style="vertical-align:middle; text-align:center;">Jabatan</div></th>
			    <th  class="pinned" ><div style="vertical-align:middle; text-align:center;">Divisi</div></th>
			    <th  class="pinned" ><div style="vertical-align:middle; text-align:center;">Wilayah</div></th>
<!--				
			    <th  class="pinned" style="vertical-align:middle; text-align:center;">Jumlah Gaji<br />Tetap</th>
			    <th  class="pinned" style="vertical-align:middle; text-align:center;">Jumlah Gaji<br /> Tidak Tetap</th>
			    <th  class="pinned" style="vertical-align:middle; text-align:center;">Jumlah <br />Tunj Lain</th>
			    <th  class="pinned" style="vertical-align:middle; text-align:center;">Jumlah <br />Gaji</th>
			    <th  class="pinned" style="vertical-align:middle; text-align:center;">Jumlah <br />Potongan</th>
			    <th  class="pinned" style="vertical-align:middle; text-align:center;">Jumlah Gaji <br />Diterima</th>
!-->				
			    <th  class="pinned" style="vertical-align:middle; text-align:center;">BANK</th>
			    <th  class="pinned" style="vertical-align:middle; text-align:center;">Rekening</th>
			    <th  class="pinned" style="vertical-align:middle; text-align:center;">Print</th>
			</tr>

		    </thead>
		    <tbody>
			<?php
			
			if 	( $kar_id=="0021" || $kar_id=="0037" ||  $kar_id == "0248" ){ //kalo ada yang ganti kena SP - dyan
			    $filter_nik = " a.periode='$kode' ";
			}else{
			    $filter_nik = " a.nik='$kar_nik' ";
			}	 
			
			$sql_gaji  =" SELECT a.* FROM salary_master a 
			         	  WHERE $filter_nik 
			         	  ORDER BY a.divisi,a.id desc";
						  
			//echo $sql_gaji; exit();
					  
			$Qgaji   = mysql_query($sql_gaji);
			while($r = mysql_fetch_array($Qgaji)){
			     $agaji = explode('#',$eco->dcrypt($r['datagaji']));
			     // echo '<br>'.$r['nik'];
				 $agaji[40]=str_replace(' ','',$agaji[40]);//norek = hilangkan karakter kosong //
				 $status_slip = $agaji[50];
			?>
			<tr>
			<td align="center" ><?php echo $r['periode'];?></td>
			<td><?php echo $r['nama'];?></td>
			<td><?php echo $r['nik'];?></td>
			<td><?php echo $r['jabatan'];?></td>
			<td><?php echo $r['divisi'];?></td>
			<td><?php echo $r['wilayah'];?></td>
<!--			
			<td align="right"><?php echo number_format($agaji[9]);?></td>
			<td align="right"><?php echo number_format($agaji[12]);?></td>
			<td align="right"><?php echo number_format($agaji[19]);?></td>
			<td align="right"><?php echo number_format($agaji[20]);?></td>
			<td align="right"><?php echo number_format($agaji[31]);?></td>
			<td align="right"><?php echo number_format($agaji[32]);?></td>
!-->			
			<td align="center"><?php echo $agaji[39];?></td>
			<td align="left"><?php echo $agaji[40];?></td>
			<td align="center">
			   <?php
				$fpdf  = "slip_gaji";
				if ($status_slip <> ""){
					$fpdf  = "slip_gaji_reward";
				}
				
				if ( substr($r["periode"],-3)=="THR" ){
					$fpdf  = "slip_thr";
				}
				
				$fctk = "./html2pdf/".$fpdf.".php?id=".$r['datagaji']."&idkar=".$kar_id."&filepdf=".$fpdf;
				

			   ?>
		       <a  href="#" 
   				  onclick="OpenPopupCenter('<?php echo $fctk ;?>', 'PRINT!?', 800, 600); " 
			      class='btn btn-success ' title="Print :  Strook "> 
			     <i class="fa fa-print"></i>
			   </a>			

			</td>
			
			</tr>
			<?php }	?>		
		    </tbody>
		  </table>

                

              </div>
	      


          </div>

            

          

        </div>


      </div>


    </section>
 
 
    
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
</style>
    
<div id="loading"><img src="dist/img/loadingnew3.gif" /></div>





<!-- Modal -->

<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">

  <div class="modal-dialog">

    <div class="modal-content">

      <div class="modal-header bg-primary">

        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>

        <h4 class="modal-title" id="myModalLabel"><i class="fa fa-calendar"></i> Upload Salary</h4>

      </div>

      <form class="form-horizontal" action="" method="post" enctype="multipart/form-data">

      <div class="modal-body">
          <div class="form-group">

            <label for="jdw_bulan" class="col-sm-2 control-label">Bulan</label>

            <div class="col-sm-5">

              <input type="text" name="jdw_bulan" class="form-control dpmonth2" id="jdw_bulan" 
			  placeholder="Bulan" required  >

            </div>
            <div class="col-sm-5">
		      <input type="radio" name="jenis_gaji" value="Y" checked> Gaji Bulanan
		      &nbsp;&nbsp;&nbsp;&nbsp;
		      <input type="radio" name="jenis_gaji" value="T" > THR
            </div>

          </div>

	  <div class="form-group">

            <label for="jdw_file" class="col-sm-2 control-label">File</label>

            <div class="col-sm-10">

              <div class="btn btn-default btn-file" id="file">

                    <i class="fa fa-paperclip"></i> Attachment File

              </div>

                    <input type="file" name="jdw_file" accept="application/vnd.openxmlformats-officedocument.spreadsheetml.sheet" required />

                    <small class="help-block"><em>Max. 5MB</em></small>

            </div>

          </div>


	  <div class="form-group">

            <label for="jdw_bulan" class="col-sm-2 control-label">Setting</label>

            <div class="col-sm-10">

              Aktifkan sebagai bulan default(ditampilkan): <br>
	      <input type="radio" name="jdw_setting" value="Y"> Ya
	      &nbsp;&nbsp;&nbsp;&nbsp;
	      <input type="radio" name="jdw_setting" value="T" checked> Tidak

            </div>

          </div>

      </div>

      <div class="modal-footer">

        <button type="submit" name="bimport" class="btn btn-primary btn-block hidden-lg"><i class="fa fa-upload"></i></button>
	<div class="pull-right"><button type="submit" name="bimport" class="btn btn-primary visible-lg"><i class="fa fa-upload"></i></button></div>

      </div>

      </form>

    </div>

  </div>

</div>


<div class="modal fade" id="myModalPsw" role="dialog" >
        <div class="modal-dialog" role="document">
            <div class="modal-content">
		        <div class="modal-header bg-primary">
    	        	<button type="button" class="close" data-dismiss="modal">&times;</button>
                	<h4 class="modal-title">Ganti Pasword</h4>
		        </div>	
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

<div class="modal fade" id="myModalPassReset" role="dialog" >
        <div class="modal-dialog" role="document">
            <div class="modal-content">
		        <div class="modal-header bg-primary">
    	        	<button type="button" class="close" data-dismiss="modal">&times;</button>
                	<h4 class="modal-title">Reset Pasword</h4>
		        </div>	
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
<script src="plugins/jQuery/jQuery-2.1.4.min.js"></script> 

<script type="text/javascript">
  $(document).ready(function(){
	   
       $('#myModalPsw').on('show.bs.modal', function (e) {
            var rowid = $(e.relatedTarget).data('id');
            //menggunakan fungsi ajax untuk pengambilan data
            $.ajax({
                type : 'post',
                url : 'module/salary/pass-edit.php',
                data :  'rowid='+ rowid,
                success : function(data){
                $('.fetched-data').html(data);//menampilkan data ke dalam modal
                }
            });
         });

       $('#myModalPassReset').on('show.bs.modal', function (e) {
            var rowid = $(e.relatedTarget).data('id');
            //menggunakan fungsi ajax untuk pengambilan data
            $.ajax({
                type : 'post',
                url : 'module/salary/pass-reset.php',
                data :  'rowid='+ rowid,
                success : function(data){
                $('.fetched-data').html(data);//menampilkan data ke dalam modal
                }
            });
         });

  });		
  
  
////////////////////////////////////////////////////////////////  
var objappVersion = navigator.appVersion;
var objAgent = navigator.userAgent;
var objbrowserName  = navigator.appName;
var objfullVersion  = ''+parseFloat(navigator.appVersion); 
var objBrMajorVersion = parseInt(navigator.appVersion,10);
var objOffsetName,objOffsetVersion,ix;

// In Chrome 
if ((objOffsetVersion=objAgent.indexOf("Chrome"))!=-1) {
 objbrowserName = "Chrome";
 objfullVersion = objAgent.substring(objOffsetVersion+7);
}
// In Microsoft internet explorer
else if ((objOffsetVersion=objAgent.indexOf("MSIE"))!=-1) {
 objbrowserName = "Microsoft Internet Explorer";
 objfullVersion = objAgent.substring(objOffsetVersion+5);
}

// In Firefox
else if ((objOffsetVersion=objAgent.indexOf("Firefox"))!=-1) {
 objbrowserName = "Firefox";
}
// In Safari 
else if ((objOffsetVersion=objAgent.indexOf("Safari"))!=-1) {
 objbrowserName = "Safari";
 objfullVersion = objAgent.substring(objOffsetVersion+7);
 if ((objOffsetVersion=objAgent.indexOf("Version"))!=-1) 
   objfullVersion = objAgent.substring(objOffsetVersion+8);
}
// For other browser "name/version" is at the end of userAgent 
else if ( (objOffsetName=objAgent.lastIndexOf(' ')+1) < 
          (objOffsetVersion=objAgent.lastIndexOf('/')) ) 
{
 objbrowserName = objAgent.substring(objOffsetName,objOffsetVersion);
 objfullVersion = objAgent.substring(objOffsetVersion+1);
 if (objbrowserName.toLowerCase()==objbrowserName.toUpperCase()) {
  objbrowserName = navigator.appName;
 }
}
// trimming the fullVersion string at semicolon/space if present
if ((ix=objfullVersion.indexOf(";"))!=-1)
   objfullVersion=objfullVersion.substring(0,ix);
if ((ix=objfullVersion.indexOf(" "))!=-1)
   objfullVersion=objfullVersion.substring(0,ix);

objBrMajorVersion = parseInt(''+objfullVersion,10);
if (isNaN(objBrMajorVersion)) {
 objfullVersion  = ''+parseFloat(navigator.appVersion); 
 objBrMajorVersion = parseInt(navigator.appVersion,10);
}


        var windowObjectReference = null; // global variable
        function OpenPopupCenter(pageURL, title, w, h) {
		    //close curent window
			//window.close();
            var left = (screen.width - w) / 2;
            var top = (screen.height - h) / 4;  
		  
          if (objbrowserName=='Firefox'){
			window.open(pageURL,'Print').close();	
			window.open(pageURL,'Print').focus();	
			return false ;
		  }
		  

		  if(windowObjectReference == null || windowObjectReference.closed) {
			    windowObjectReference = window.open(pageURL, title, 'toolbar=no, location=no, directories=no, status=no, menubar=yes, scrollbars=yes, resizable=yes,titlebar=no, copyhistory=no, width=' + w + ', height=' + h + ', top=' + top + ', left=' + left);

		  } else {
		  
	        windowObjectReference.close();
			windowObjectReference = window.open(pageURL, title, 'toolbar=no, location=no, directories=no, status=no, menubar=yes, scrollbars=yes, resizable=yes,titlebar=no, copyhistory=no, width=' + w + ', height=' + h + ', top=' + top + ', left=' + left);			
			
		  };

   
        } ;
		
 







</script>
