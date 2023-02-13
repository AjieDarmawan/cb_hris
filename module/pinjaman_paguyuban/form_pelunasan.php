<?php 
	session_start();
	date_default_timezone_set('Asia/Jakarta'); 
	foreach($_REQUEST as $name=>$value){
		$$name=$value;
		//echo "Name: $name : $value;<br />\n";
	}	
	  
	include "pag_data_action.php"; 

	///////////////////////////////////////////////////////////



	$xdata = __list_pinjaman($id);
	$nota  =  $xdata[0]['pg_nomor'];
	$nama  =  $xdata[0]['pg_kar_nm'];
	$tgl  = $xdata[0]['pg_tanggal'];
	if ($tgl == "" || $tgl == NULL){
		$tgl = date('Y-m-d');
	}
	$pelunasan  = $xdata[0]['pg_pelunasan'];
	$tgl_lunas  = $xdata[0]['pg_tanggal_lunas'];
	if ($tgl_lunas == "" || substr($tgl_lunas,0,4)== "0000" || $tgl_lunas == NULL){
		//$tgl_lunas = date('Y-m-d');
		$tgl_lunas = "";
	}

	$tgl_transfer  = $xdata[0]['pg_tanggal_transfer'];
	if ($tgl_transfer == "" || substr($tgl_transfer,0,4)== "0000" || $tgl_transfer == NULL){
		$tgl_transfer = "";
	}
		
    $pinjaman 	= $xdata[0]['pg_pinjaman'];
	$lama	 	= $xdata[0]['pg_lama'];
	$angsuran 	= $pinjaman / $lama ;
	//$angsuran 	= $xdata[0]['pg_angsuran'];
	$ke		 	= $xdata[0]['pg_ke'];
    $bayar     	= $xdata[0]['pg_bayar'];
    $sisa 		= $pinjaman - $bayar;
	
	if ($pelunsan == 0 ){
	  // $pelunasan =  $sisa;
	}
// echo $nota.'/'.$nama; return ; 
     
?>

<style>

body {font-family: Arial, Helvetica, sans-serif;}
/*
form {
    border: 3px solid #f1f1f1;
    font-family: Arial;
}
*/
.container {
    padding: 20px;
    background-color: #f1f1f1;
    width: 100%; 
}

input,
select,
textarea {
  /*
    max-width: 280px;
  */	
  
}

</style>

<div class="modal fade"  id="modal-update-user"  role="dialog"     
		aria-labelledby="myModalLabel" aria-hidden="true"   
        style="overflow-y: scroll; max-height:85%;  margin-top: 50px; margin-bottom:50px;" >   
		 
<div class="modal-dialog text-justify modal-lg "  style="width:60%" >
	<div class="modal-content "  >  
	<div class="modal-header" style="background:#0066FF">   
		<button type="button" class="close" data-dismiss="modal">   
			<span aria-hidden="true"><i class="fa fa-times-circle fa-2x"  > 
			</i></span><span class="sr-only">Close</span>   
		</button>  
		
		<h3 class="modal-title" id="myLabel_do" >  
		<strong style="color:#FFFFFF "> <?php echo $sub_title; ?> <?php echo $num_nopo; ?>  </strong>  
		</h3>
		<?php //echo $x_sisa; //echo '<br>'.$sSQL_Update ?>
   </div>  
	 
<div class="box-body " >  
<div class="table-responsive">  

<table class="table" border="0" width="100%">

<thead>
<tr >
	<th style="border: 1px solid">
	  <div class="input-group" >
		<label for="" style="width:150px" >Nomor</label>  
		<input type="hidden" class="form-control" id="id_row" name="id_row" value="0" >   	
		<input type="text"   class="form-control" name="pg_nomor_tgl"  
			value="<?php echo $nota;?>" readonly="" > 
	  </div>	
     <div class="input-group" >
		<label for="" style="width:150px;  " >Tanggal</label>  
		<input type="text"   class="form-control " name="pg_tanggal"  
			value="<?php echo $tgl;?>" readonly="" > 
	  </div>	

     <div class="input-group" >
		 <label for=""  style="width:150px">Nama</label>  
		 <input type="text" class="form-control" name="pg_kar_nm"  
		 value="<?php echo $nama;?>"  readonly="">
	   </div>
	  	  
	</th>
	<th style="border: 1px solid">
	  <div class="input-group" >
		 <label for=""  style="width:150px; ">Jumlah Pinjaman</label>  
		 <input type="text" class="form-control number-separator" name="pg_pinjaman"  
		 onkeypress="return isNumberKey(event)" 
		 value="<?php echo number_format($pinjaman);?>"  readonly="" >
	   </div>	   
	  <div class="input-group" >
		 <label for=""  style="width:150px;  ">Bayar</label>  
		 <input type="text" class="form-control number-separator" name="pg_bayar"  
		 onkeypress="return isNumberKey(event)" 
		 value="<?php echo number_format($bayar);?>"   readonly="">
	   </div>	   
	  <div class="input-group" >
		 <label for=""  style="width:150px;  ">Saldo</label>  
		 <input type="text" class="form-control number-separator" name="pg_sisa"  
		 onkeypress="return isNumberKey(event)" 
		 value="<?php echo number_format($sisa);?>"  readonly="" >
	   </div>	   
	
	  	  
	</th>

	<th style="border: 1px solid">
	 <div class="input-group" >
		 <label for=""  style="width:150px; color:blue ">Jumlah Pelunasan</label>  
		 <input type="text" class="form-control number-separator" name="pg_pelunasan"  
		 onkeypress="return isNumberKey(event)" 
		 value="<?php echo  number_format($pelunasan); ?>" 
		  required >
	  </div>	   
	  <div class="input-group" >
		<label for="" style="width:150px;  color:blue" >Tanggal</label>  
		<input type="text"   class="form-control dp" name="pg_tanggal_lunas"  
			value="<?php echo $tgl_lunas;?>"   > 
	  </div>	
	 <div class="input-group" >
		 <label for=""  style="width:150px; color:blue ">Angsuran Ke</label>  
		 <input type="hidden" name="pg_pinjaman" value="<?php echo $pinjaman;?>" >  
		 <input type="hidden" name="pg_angsuran" value="<?php echo $angsuran;?>" >  
		 <input type="text" class="form-control number-separator" name="pg_ke"  
		 onkeypress="return isNumberKey(event)" 
		 value="<?php echo  $ke; ?>" 
		  required >
	  </div>	   


	  	  
	</th>
</tr>

<tr>
  <td colspan="1"> 
  	  <div class="input-group" >
		<label for="" style="width:150px;  color:blue" >Tanggal Transfer</label>  
		<input type="text"   class="form-control dp" name="pg_tanggal_transfer"  
			value="<?php echo $tgl_transfer;?>"   > 
	  </div>	
  </td>
  <td colspan="2">
  </td>
  
</tr>

		
</thead>



</table>


	<div class="modal-footer">  
		 <div class="box-footer" align="right">  
			<input type="hidden" name="mode" value="simpan">  
			<input type="hidden" name="id" value="<?php echo $id;?>">  			
			<input type="hidden" name="aksi" value="<?php echo $aksi;?>">  
			<input type="hidden" name="aksi_proses" value="<?php echo $aksi_proses;?>">  		
			<button type="submit" class="btn btn-primary" <?php echo $xdisabled ;?> >Simpan</button>  
			<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>  
	   </div>  
	</div>  
	
</div>  <!--modal-body!-->
</div>  <!--modal-content!-->
</div>  <!--modal-dialag!-->
</div>  <!--modal!-->


<script>
  // Currency Separator
    var commaCounter = 10;

    function numberSeparator(Number) {
        Number += '';

        for (var i = 0; i < commaCounter; i++) {
            Number = Number.replace(',', '');
        }

        x = Number.split('.');
        y = x[0];
        z = x.length > 1 ? '.' + x[1] : '';
        var rgx = /(\d+)(\d{3})/;

        while (rgx.test(y)) {
            y = y.replace(rgx, '$1' + ',' + '$2');
        }
        commaCounter++;
        return y + z;
    }

    // Set Currency Separator to input fields
    $(document).on('keypress , paste', '.number-separator', function (e) {
        if (/^-?\d*[,.]?(\d{0,3},)*(\d{3},)?\d{0,3}$/.test(e.key)) {
            $('.number-separator').on('input', function () {
                e.target.value = numberSeparator(e.target.value);
            });
        } else {
            e.preventDefault();
            return false;
        }
    });
	
</script>