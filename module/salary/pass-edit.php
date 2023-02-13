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
     $status_upd="Save Data";
 }	
if($_POST['rowid']) {
        $sql = "SELECT b.kar_nik,b.kar_nm,a.acc_password as pass_absen,a.acc_pass_eslip as pass_eslip FROM acc_master a
		        LEFT JOIN kar_master b ON b.kar_id=a.kar_id
		        WHERE a.kar_id = '$id' ";
		$q_kary = mysql_query($sql);
		$r = mysql_fetch_array($q_kary);
        $detal_act   = "./media.php?p=salary_data";
		$old_pass    = $r['pass_absen'];
		$pass_eslip  = $r['pass_eslip'];
		if ($pass_eslip != ""){
			$old_pass = $eco->dcrypt($pass_eslip);
		}
		$_SESSION['pass_absen']=$old_pass;
//		$old_pass    = $eco->dcrypt($pass_absen);
		
    ?>
	
<!-- MEMBUAT FORM -->
<form class="form-horizontal" action="<?php echo $detail_act ?>" method="post"> 
        <input type="hidden" name="id" value="<?php echo $id; ?>">

<div class='row'>    
  <div class="form-group">
      <label class="control-label col-sm-5" for="">
	  <h4><?php echo $r['kar_nik'].'/'.$r['kar_nm'];?></h4>
	  </label>
  </div>

  <div class="form-group">
      <label class="control-label col-sm-3" for="">Password Lama : </label>
      <div class="col-sm-2">
          <input type="password" class="form-control" name="oldpass" maxlength="6" 
				placeholder="OldPas"
		  value=""  required >
      </div>
  </div>

  <div class="form-group">
      <label class="control-label col-sm-3" for="">Password Baru : </label>
      <div class="col-sm-2">
          <input type="password" class="form-control" name="newpass"  maxlength="6"
				placeholder="NewPas"
		  	    value=""  required>
      </div>
  </div>


  <div class="modal-footer">
	   <button class="btn btn-primary" name="bsave_pass" type="submit">
		 <i class="fa fa-database"></i> <?php echo $status_upd ?>
	   </button>
     <button type="button" class="btn btn-default" data-dismiss="modal">Keluar</button>
  </div>

</div>			  
</form>
 
<?php } ?>
<?php //	include('../../component/tag_bottom.php');?>

       <script src="module/data-cuti/jquery.min.js"></script>
       <script src="module/data-cuti/jquery.maskedinput.js"></script>
        <script>
        jQuery(function($){
		    for (var i = 0; i <=10; ++i) {
              $("#tgl"+i).mask("99-99-9999",{placeholder:"dd-mm-yyyy"});
              $("#jam"+i).mask("99:99",{placeholder:"hh-mm"});
			}  
        });
        </script>
