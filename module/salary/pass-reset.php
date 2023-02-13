<?php
 session_start();
 date_default_timezone_set("Asia/Bangkok");

 require('../../class.php');
 require('../../object.php');
 $db->koneksi();


 $id=$_REQUEST['rowid'];    
 if ($id == "add"){
	 $status_upd="Create Data";
 }else{
     $status_upd="Save Reset Pasword";
 }	
if($_POST['rowid']) {

		
    ?>
	
<!-- MEMBUAT FORM -->
<form class="form-horizontal" action="<?php echo $detail_act ?>" method="post"> 
        <input type="hidden" name="id" value="<?php echo $id; ?>">

<div class='row'>    

  <div class="form-group">
      <label class="control-label col-sm-3" for="">NIK / Nama : </label>
      <div class="col-sm-8">
		    <select  style=" width:100%;height:30px;" class="form-control select"  id='pass_reset' name='pass_reset'    >
            <?php
		       $sql = " SELECT a.kar_id,b.kar_nik,b.kar_nm,a.acc_password as pass_absen,a.acc_pass_eslip as pass_eslip 
				        FROM acc_master a
				        LEFT JOIN kar_master b ON b.kar_id=a.kar_id 
						WHERE b.kar_nik <> ''
		    		   ";
						
				$q_kary = mysql_query($sql);
									
				while($row = mysql_fetch_array($q_kary)) {
				?>
					<option value="<?php echo $row['kar_id'].'#'.$row['pass_absen']."#".$row['kar_nik']."#".$row['kar_nm'];?>" >
					<?php echo $row['kar_nik'].' - '.$row['kar_nm'];?> 
					</option>

				<?php	} ?>
            </select>

      </div>
  </div>


  <div class="modal-footer">
	   <button class="btn btn-primary" name="bsave_pass_reset" type="submit">
		 <i class="fa fa-database"></i> <?php echo $status_upd ?>
	   </button>
     <button type="button" class="btn btn-default" data-dismiss="modal">Keluar</button>
  </div>

</div>			  
</form>
 
<?php } ?>
<?php //	include('../../component/tag_bottom.php');?>

<link href="plugins/select2-4.0.3/select2.min.css" rel="stylesheet" />
<link rel="stylesheet" href="dist/css/bootstrap-select.css">

<script src="plugins/jQuery/jQuery-2.1.4.min.js"></script> 
<script src="plugins/select2-4.0.3/select2.min.js"></script>

<script type="text/javascript">
  $(document).ready(function(){
       $('.select').select2();
  });		   
</script>  
  