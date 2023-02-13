<?php

 date_default_timezone_set("Asia/Bangkok");

 require('../../class.php');
 require('../../object.php');
 $db->koneksi();


 $id=$_REQUEST['rowid'];    
 if ($id == "add"){
	 $status_upd="Add Data";
	 $readonly  = "";
	 $edit  	= "AddBarang";
 }else{
     $status_upd="Edit Data";
	 $readonly 	= "readonly='' ";
	 $edit		= "UpdateBarang";
 }	
if($_POST['rowid']) {
        // mengambil data berdasarkan id
        // dan menampilkan data ke dalam form modal bootstrap
        $sql = "SELECT a.* from barang_master a
		   		WHERE a.id = '$id' ";
		$q_cuti= mysql_query($sql);
		$r = mysql_fetch_array($q_cuti);
        $detal_act = "./media.php?p=kasbon_data_barang";
		$kdklp = $r["kdklp"];
		$selected1 = "";if ($kdklp == "1"){$selected1 = "selected";} ;
		$selected2 = "";if ($kdklp == "2"){$selected2 = "selected";} ;
		$selected3 = "";if ($kdklp == "3"){$selected3 = "selected";} ;
		$selected4 = "";if ($kdklp == "4"){$selected4 = "selected";} ;
		
    ?>
	
<!-- MEMBUAT FORM -->
<form role="form" action="<?php echo $detail_act ?>" method="post"> 
        <input type="hidden" name="id" value="<?php echo $id; ?>">
<div class='row'>    
  <div class="modal-header ">
       <button type="button" class="close" data-dismiss="modal">&times;</button>
	   <h4><?php echo $status_upd; ?></h4>
  </div>

<div class="box-body">
	<div class="row">
			<div class="col-md-1">
				<div class="form-group">
					<label for="">Kode</label>
					<input type="text" class="form-control" name="kodebrg"
							placeholder="-"
					  value="<?php echo $r['kode_barang']; ?>" <?php echo  $readonly  ;?> >							
				</div>
			</div>

			<div class="col-md-6">
				<div class="form-group">
					<label for="">Nama Barang</label>
					<input type="text" class="form-control" name="namabrg"
							placeholder="-"
					  value="<?php echo $r['nama_barang']; ?>"  >							
				</div>
			</div>
			<div class="col-md-2">
				<div class="form-group">
					<label for="">Harga</label>
					<input type="text" class="form-control" name="harga"
							placeholder="-"
					  value="<?php echo $r['harga1']; ?>"  >							
				</div>
			</div>
			<div class="col-md-3">
				<div class="form-group">
					<label for="">Kelompok</label>
					<select class="form-control " style="width: 100%;" name="kdklp" id="kdklp"
						data-live-search="true" >
						<!-- <option>- PILIH -</option> !-->
						<option value="1" <?php echo $selected1 ;?> >Operasional</option>
						<option value="2" <?php echo $selected2 ;?> >Marketing Tools</option>
						<option value="3" <?php echo $selected3 ;?> >ATK</option>
						<option value="4" <?php echo $selected4 ;?> >Komsumsi</option>
					</select>
				</div>
			</div>

	</div>
</div>


<?php } ?>


  <div class="modal-footer">
 
	   <button class="btn btn-primary" name="act" value="<?php echo $edit ;?>" type="submit">
		 <i class="fa fa-save"></i> Save Data 
	   </button>
       <button type="button" class="btn btn-default" data-dismiss="modal">cancel</button>
  </div>

</div>			  
</form>
 


  