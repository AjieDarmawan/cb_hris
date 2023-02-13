<?php

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
        // mengambil data berdasarkan id
        // dan menampilkan data ke dalam form modal bootstrap
        $sql = "SELECT b.kar_nik,b.kar_nm,a.* FROM cuti_master a
		        LEFT JOIN kar_master b ON b.kar_id=a.kar_id
		        WHERE a.kar_id = '$id' ";
		$q_cuti= mysql_query($sql);
		$r = mysql_fetch_array($q_cuti);
        $detal_act = "./media.php?p=cuti";
		$adatacuti = explode("#",$r['datacuti']);
		$adataket  = explode("#",$r['dataket']);
		$adata_atasan  = explode("#",$r['data_atasan']);
		$adatavalid    = explode("#",$r['datavalid']);
		$adatanota    = explode("#",$r['datanota']);
		
    ?>
	
<!-- MEMBUAT FORM -->
<form class="form-horizontal" action="<?php echo $detail_act ?>" method="post"> 
        <input type="hidden" name="id" value="<?php echo $id; ?>">

<div class='row'>    
  <div class="modal-header ">
       <button type="button" class="close" data-dismiss="modal">&times;</button>
               <h4 class="modal-title">NIK  : <?php echo $r['kar_nik'].'/'.$r['kar_nm'];?></h4>
  </div>
  <br />
  <div class="form-group">
      <label class="control-label col-sm-2" for="">JmlCuti : </label>
      <div class="col-sm-2">
          <input type="text" class="form-control" name="jml_cuti" 
				placeholder="Jml Cuti"
		  value="<?php echo $r['jml_cuti']; ?>" >
      </div>
      <label class="control-label col-sm-3" for="" style="text-align:left">Keterangan </label>
      <label class="control-label col-sm-1" for="" style="text-align:left">NIK Atasan</label>
      <label class="control-label col-sm-1" for="" style="text-align:left">ACC Atasan</label>
      <label class="control-label col-sm-2" for="" style="text-align:left">NoNota</label>
  </div>

<?php 
  for ($i=0 ;$i < 12;$i++){ 
    $xtgl =""; 
    if ($i==0){
	    $xtgl ="Tgl"; 
	   
	}
?>
  <div class="form-group">
      <label class="control-label col-sm-2" for=""><?php echo $xtgl.' Ke - '.($i+1)?></label>
      <div class="col-sm-2">
          <input type="text" class="form-control" id="tglct<?php echo $i; ?>" name="tgl_cuti[]" 
				placeholder="-"
		  value="<?php echo $adatacuti[$i]; ?>" >
      </div>
      <div class="col-sm-3">
          <input type="text" class="form-control" name="dataket[]"
				placeholder="-"
		  value="<?php echo $adataket[$i]; ?>" >
      </div>
      <div class="col-sm-1" style=" display:block">
          <input type="text" class="form-control" name="data_atasan[]"
				placeholder="-"
		  value="<?php echo $adata_atasan[$i]; ?>" style="text-align:center">
      </div>
      <div class="col-sm-1" style=" display:block;" >
          <input  type="text" class="form-control" name="datavalid[]"
				placeholder="-"
		  value="<?php echo $adatavalid[$i]; ?>"  style="text-align:center">
      </div>
      <div class="col-sm-2" style=" display:block;" >
          <input  type="text" class="form-control" name="datanota[]"
				placeholder="-"
		  value="<?php echo $adatanota[$i]; ?>"  style="text-align:center">
      </div>

  </div>
<?php } ?>


  <div class="modal-footer">
 
	   <button class="btn btn-primary" name="act" value="UpdateCuti" type="submit">
		 <i class="fa fa-save"></i> <?php echo $status_upd ?>
	   </button>
       <button type="button" class="btn btn-default" data-dismiss="modal">cancel</button>
  </div>

</div>			  
</form>
 
<?php } ?>
<?php //	include('../../component/tag_bottom.php');?>

       <script src="module/data-cuti/jquery.min.js"></script> 
       <script src="module/data-cuti/jquery.maskedinput.js"></script> 
        <script>
        jQuery(function($){
		    for (var i = 0; i <= 30; ++i) {
              $("#tglct"+i).mask("99-99-9999",{placeholder:"dd-mm-yyyy"});
//              $("#jam"+i).mask("99:99",{placeholder:"hh-mm"});
//              $("#nopo"+i).mask("PO-999999",{placeholder:"xx-xxxxxx"});
			}  
        });
        </script>
