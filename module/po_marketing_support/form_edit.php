<?php
date_default_timezone_set("Asia/Bangkok");
include("koneksi_db.php");
foreach($_REQUEST as $name=>$value)
{
	$$name=$value;
	//echo "$name : $value;<br />\n";
}

$userid = $_POST['userid'];
if ($aksi == "add"){
    $userid = 0 ; 
}
?>

<!-- Modal -->
<div class="modal fade" id="ModalEdit" role="dialog" style="" >
<div class="modal-dialog"  >
<div class="modal-content " >
<div class="modal-header " style=" background:#00CCFF">
<button type="button" class="close" data-dismiss="modal">
<span class="glyphicon glyphicon-remove-circle"></span>
</button>
<h4 class="modal-title "><?php echo $judul; ?> </h4>
</div>
<div class="modal-body " >
<?php


$sql = "select * FROM tmp_marketing_support  where mfc_id = '$id' ";

$result =mysql_query($sql);
while( $row = mysql_fetch_array($result) ){
    $id   = $row['mfc_id'];
	$nama = $row['mfc_nama'];
	$nohp = $row['mfc_nohp'];
	$email = $row['mfc_email'];
	$status = $row['mfc_status'];
	$ket	= $row['mfc_ket'];
	$batch  = $row['mfc_batch'];

 }

$disabled = "";
if ($aksi=="list" || $aksi=="delete" ){
    $disabled = "disabled";
}


?>	

<div  class = "table-responsive" >


 <fieldset <?php echo $disabled ; ?> >

  <table class="table table-border"  >
  	<tbody>

	  	
	  <tr>
		<td width="15%" style="vertical-align:middle">Nama</td>
		<td width="1%" style="vertical-align:middle">:</td>
		<td width="50%">
		 	<input name="mfc_nama" class="form-control" style=" font-weight: bold; " 
			   value="<?php echo $nama; ?>"  disabled="disabled"  required >
			</input>
		</td>
	
	  <tr>

	  <tr>
		<td  style="vertical-align:middle">NoHP</td>
		<td  style="vertical-align:middle">:</td>
		<td >
		 		 <input name="mfc_nohp" class="form-control"  value="<?php echo $nohp; ?>"  disabled="disabled"></input>
		</td>
	
	  <tr>	
	  
	    <tr>
		<td style="vertical-align:middle">Status</td>
		<td  style="vertical-align:middle">:</td>
		<td >
		     <?php
			  $selected0 = "";
			  if ($status==""){
			     $selected0 = "selected";
			  }
			  $selected1 = "";
			  if ($status=="Diterima"){
			     $selected1 = "selected";
			  }	
			  $selected2 = "";
			  if ($status=="Proses"){
			     $selected2 = "selected";
			  }		
			  $selected3 = "";
			  if ($status=="Gagal"){
			     $selected3 = "selected";
			  }					  			  		  
			 ?>
			 <select class="btn btn-default" name="mfc_status" >
				 <option  value="" <?php echo $selected0;?> ></option>
				 <option  value="Diterima" <?php echo $selected1;?> >Diterima</option>
				 <option  value="Proses" <?php echo $selected2;?> >Proses</option>
				 <option  value="Gagal" <?php echo $selected3;?> >Gagal</option>				 
			 </select>	 
		</td>
	
	  <tr>	 

	    <tr>
		<td style="vertical-align:middle">Bacth</td>
		<td  style="vertical-align:middle">:</td>
		<td >
		     <?php
	  		  
			 ?>
			 <select class="btn btn-default" name="mfc_batch"  style="width:100px; text-align:left  ;  " >

				 <?php
				  
				   for ($i=0;$i<=20;$i++){
				       $selected = "";
				       if ($batch==$i){
					   	  $selected = "selected";	
					   }
				      echo "<option  value=\"$i\" $selected >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; $i  </option>";
				   }
				 ?>			 
			 </select>	 
		</td> 
	
	  <tr>	 	  
	  <tr>
		<td  style="vertical-align:middle">Keterangan</td>
		<td  style="vertical-align:middle">:</td>
		<td >
		 	<!-- <textarea  name="mfc_ket" class="form-control"  ><?php //echo $ket; ?></textarea> !-->
			<input name="mfc_ket" class="form-control"  value="<?php echo $ket; ?>"  ></input>	
		</td>
	
	  <tr>	

	</tbody>
	
  </table>
<?php
 if ($aksi <> "list" and $aksi <> "delete"){ 
   ?>
    <div class="modal-footer">
	    <input type="hidden" name="id" value="<?php echo $id;?>" /></input>
	    <input type="hidden" name="act" value="<?php echo $aksi;?>" /></input>
	    <button  class="btn btn-primary SAVEDATA "><i class="fa fa-save"></i> Simpan</button>
		<button  class="btn btn-danger pull-right" data-dismiss="modal">Batalkan</button>
     </div> 

<?php } ?>
 </fieldset> 	 
<?php
 if ($aksi == "delete"){ 
?>
    <div class="modal-footer">
	    <input type="hidden" name="id" value="<?php echo $id;?>" /></input>
	    <input type="hidden" name="act" value="<?php echo $aksi;?>" /></input>
	    <button  class="btn btn-primary SAVEDATA "><i class="fa fa-trash"></i> Delete </button>
		<button  class="btn btn-danger pull-right" data-dismiss="modal">Batalkan</button>
     </div> 

<?php } ?>	 	     

</div> <!-- table-responsive !-->					
						
						
						



	
</div>  <!-- body !-->
<!--
<div class="modal-footer">
	<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
</div>
!-->
</div>
<div>
</div>	



<script>
function validateForm() {
  if (confirm("Mau di Simpan ?")==false){
	 return false;
  }
  
} 

$(function() {
	  $('.fetched-date input').datepicker({
		format: "yyyy-mm-dd",
	  //  calendarWeeks: true,
		todayHighlight: true,
		autoclose: true
	  });
});
$(function(){	
	//  alert('xxx');			   	 
 
 	$('#xxx_f_user_save_edit').submit(function(e) {
	    alert('f_user_save_edit');
		$('#empModalEdit').modal('hide');
		
						
		$.ajax({
			type: 'POST',
			url: 'mod_emp/data_act.php',
			enctype: 'multipart/form-data',
			data: new FormData(this),
			processData: false,
			contentType: false,
			success: function(data) {
			  //alert(data);
			  if(data == 1 ) {
				  	//table.ajax.reload();

					//var page = "mod_emp/data.php";
	                //$('#myMainMenu').load(page);
					
					//$('#empModalEdit').modal('hide');
					$('#f_save_edit').trigger("reset");	
					
					var page = $("#__page").data('mod');
					var menu = $("#__page").data('menu');
					var aksi = $("#__page").data('aksi');
					var title = $("#__page").text();
					var limit = $("#__page").data('limit');
					alert(page+' '+aksi+' '+title+' '+limit );
					
                    $('#myMainMenu').load(page,
						{page:page,menu:menu,aksi:aksi,title:title,limit:limit}
					);
					//location.reload(true); 				
					 			
				} else {
					alert(json.msg);
				}		  
				return false;
			}
		});
		
		return false;
	});	
              	
});
	
</script>				

