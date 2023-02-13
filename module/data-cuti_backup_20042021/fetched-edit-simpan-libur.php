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
        $detal_act	 = "./media.php?p=cuti";
		$adata_sl 	 = explode("#",$r['simpan_libur']);
		$adata_ambil = explode("#",$r['simpan_libur_ambil']);
		
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
      <label class="control-label col-md-3" for="">Simpan Libur : </label>
      <div class="col-md-3">
          <input type="text" class="form-control" name="jml_simpan_libur" 
				placeholder="Jml Cuti"
		  value="<?php echo $r['jml_simpan_libur']; ?>" >
      </div>
      <label class="control-label col-md-3" for="" style="text-align:left">Di Ambil </label>
  </div>

<?php 
  for ($i=0 ;$i < 12;$i++){ 
    $xtgl =""; 
    if ($i==0){
	    $xtgl ="Tgl"; 
	   
	}
	$t_tgl = date('d-m-Y',strtotime($adata_sl[$i]));
	if ($adata_sl[$i]==""){
	  $t_tgl = "";
	}
	$t_tgl_abl = date('d-m-Y',strtotime($adata_ambil[$i]));
	if ($adata_ambil[$i][$i] == "" ){
	  $t_tgl_abl = "";
	}
?>
  <div class="form-group">
      <label class="control-label col-md-3" for=""><?php echo $xtgl.' Ke - '.($i+1)?></label>
      <div class="col-md-3">
          <input type="text" class="form-control" id="tglsl<?php echo $i; ?>" name="tgl_simpan_libur[]" 
				placeholder="-"
		  value="<?php echo $t_tgl; ?>" >
      </div>
      <div class="col-md-3">
          <input type="text" class="form-control" id="tglabl<?php echo $i; ?>" name="data_ambil[]"
				placeholder="-"
		  value="<?php echo $t_tgl_abl; ?>" >
      </div>


  </div>
<?php } ?>


  <div class="modal-footer">
 
	   <button class="btn btn-primary" name="act" value="UpdateSimpanLibur" type="submit">
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
               $("#tglsl"+i).mask("99-99-9999",{placeholder:"dd-mm-yyyy"});
               $("#tglabl"+i).mask("99-99-9999",{placeholder:"dd-mm-yyyy"});
//              $("#jam"+i).mask("99:99",{placeholder:"hh-mm"});
//              $("#nopo"+i).mask("PO-999999",{placeholder:"xx-xxxxxx"});
			}  
        });
        </script>
