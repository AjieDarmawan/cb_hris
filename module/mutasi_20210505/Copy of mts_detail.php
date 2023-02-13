<?php require('module/mutasi/mts_act.php'); ?>

<?php 
	//if($fpk_cek_id > 0 && $kar_id==$fpk_data_id['fpk_penilai']){
	if($fpk_cek_id > 0 ){
?>


<script>
	function valueselect()
	{
		var i = document.getElementById('jenis_data');
		var p = i.options[i.selectedIndex].value;
		var x = "MUTASI";
		if ( p == "Demosi"){
		  x = "DEMOSI"; 
		}
		//alert(p);
		//window.location.href = "channelinformation.html?selected="+p;
		document.getElementById("judul_1").innerHTML = 'FORM '+x+'  TENAGA KERJA'; 
	}

	function validateForm() {
	  var x_jbt = document.forms["myFormMutasi"]["fpk_jabatan2"].value;
	  var x_div = document.forms["myFormMutasi"]["fpk_divisi2"].value;
	  var x_lvl = document.forms["myFormMutasi"]["fpk_level2"].value;
	  var x_ktr = document.forms["myFormMutasi"]["fpk_ktr2"].value;
	  
/*	  
	  var x_penilai = document.forms["myFormMutasi"]["fpk_penilai"].value;
	  var x_mengetahui = document.forms["myFormMutasi"]["fpk_mengetahui"].value;
	  var x_mengetahui2 = document.forms["myFormMutasi"]["fpk_mengetahui2"].value;
	  var x_menyetujui = document.forms["myFormMutasi"]["fpk_menyetujui"].value;
*/
	  if (x_jbt == "") {
		alert("Kolom Jabatan Harus Diisi !...");
		return false;
	  }
	  if (x_div == "") {
		alert("Kolom Divisi Harus Diisi !...");
		return false;
	  }
	  if (x_lvl == "") {
		alert("Kolom Level Harus Diisi !...");
		return false;
	  }
	  if (x_ktr == "") {
		alert("Kolom Unit/Lokasi Harus Diisi !...");
		return false;
	  }
/*	  
	  if (x_penilai == "") {
		alert("Kolom Nama Pemohon Harus Diisi !...");
		return false;
	  }
	  if (x_mengetahui == "") {
		alert("Kolom Mengetaui-1 Harus Diisi !...");
		return false;
	  }
	  if (x_mengetahui2 == "") {
		alert("Kolom Mengetahui-2 Harus Diisi !...");
		return false;
	  }
	  if (x_menyetujui == "") {
		alert("Kolom Menyetujui Harus Diisi !...");
		return false;
	  }
*/	  
      if (confirm("Mau di Simpan ?")==false){
	     return false;
	  }
	  
	} 
</script>
<?php  $title= " ".$xjenis; ?>
<!-- Content Header (Page header) -->
    <section class="content-header">
      <h1> <?php echo $title." : ".$kar_data_['kar_nm'];?> <small></small> </h1>
      <ol class="breadcrumb">
        <li><a href="media.php"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li class="active"><?php echo $title;?></li>
      </ol>
    </section>

 <form name="myFormMutasi" class="form-horizontal" action="" onsubmit="return validateForm()" method="post">
<fieldset <?php echo $disabled;?> >
      <!-- Main content -->
        <section class="invoice col-xs-6">
          <!-- title row -->
          <div class="row">
            <div class="col-xs-12">
              <h2 class="page-header">
                <img src="dist/img/logo_gg_small130.JPG" width="80"> PT. Gilland Ganesha
                <small class="pull-right">
		  <br>
		  <div class="form-group">
		    <label for="fpk_tgl" class="col-sm-5 control-label">Tanggal: </label>
		    <div class="col-sm-6">
<!--			
		      <input type="text" name="fpk_tgl" class="form-control " id="fpk_tgl" value="<?php echo $fpk_data_id['fpk_tgl'];?>" placeholder="Tanggal Penilaian" data-inputmask="'alias': 'yyyy-mm-dd'" data-mask style="width:182;" required <?php echo $disabled;?>>
!-->	
			  
              <input type="text" value="<?php echo $fpk_data_id['fpk_tgl'];?>" name="fpk_tgl" class="form-control" placeholder="Tanggal" id="dpdays"   style="width:100px" required <?php echo $disabled;?> />

		    </div>
		  </div>
		</small>
                <center><small>Jl. Raya Bogor Km 47,5 Perum Bumi Sentosa Blok A3 No.3, Nanggewer Cibinong, Jawa Barat 16912.</small></center>
              </h2>
            </div><!-- /.col -->
          </div>
          <!-- info row -->
          <div class="row invoice-info">
          <center><h3><u>FORM <?php echo strtoupper($fpk_data_id['fpk_jenis']);?> TENAGA KERJA</u></h3>
          Nomor Surat&nbsp;&nbsp;<b> <?php echo $fpk_data_id['fpk_kd'];?></b><br/><br/><br/></center>
            <div class="col-sm-8 invoice-col">
              <address>
                <strong><?php echo $kar_data_['kar_nm'];?></strong><br>
                NIK: <?php echo $kar_data_['kar_nik'];?><br>
                Divisi: <?php echo $kar_data_['div_nm'];?> / <?php echo $kar_data_['jbt_nm'];?><br>
                Location: <?php //echo $kar_data_['unt_nm'];?> <?php echo $kar_data_['ktr_nm'];?><br>
              </address>
            </div><!-- /.col -->
            
            <div class="col-sm-4 invoice-col">
              <address>
                <br>
                Priode : <strong><?php echo $fpk_data_id['fpk_priode'];?></strong><br>
                <br>
                Gaji Terakhir: Rp. <strong><?php echo $fpk_data_id['fpk_gaji']? $rph->format_rupiah($fpk_data_id['fpk_gaji']) : '-';?></strong><br>
              </address>
            </div><!-- /.col -->
          </div><!-- /.row -->

          <!-- Table row -->
          <div class="row">
            <div class="col-xs-12 table-responsive">

<div class="panel-group" id="accordion">
<!-------------------------------------------------------------------!-->  
		
		<div class="panel panel-default">

		  <div class="panel-heading">

		    <h4 class="panel-title">

		      <a data-toggle="collapse" data-parent="#accordion" 
			  href="#aspek_1<?php //echo $fpk_data_asp['fpk_asp_id']; ?>">
              I. POSISI SEKARANG
		      <div class="pull-right"><i class="fa fa-chevron-down"></i></div></a>

		    </h4>

		  </div>
          <?php  $in = "in"; ?>    
		  <div id="aspek_1<?php //echo $fpk_data_asp['fpk_asp_id']; ?>" 
		    class="panel-collapse collapse <?php echo $in; ?>" >

		    <div class="panel-body">
	      
		      <table class="" border="0" width="100%">


			  
			  <tbody>


			  <tr>

			    <td width="30%">
					<div >
					<i class="fa fa-check-square-o"></i> Jabatan / Posisi
					</div>
				</td>
				<td width="3%">:</td>
			    <td  width="" >
					<div >
						<b><?php echo cek_jbt($fpk_data_id['fpk_jbt1']);?></b>
					</div>
				</td>



			  </tr>

	
			  <tr>

			    <td>
					<div >
					<i class="fa fa-check-square-o"></i> Devisi / Unit Kerja
					</div>
				</td>
				<td>:</td>
			    <td >
					<div >
						<b><?php echo cek_div($fpk_data_id['fpk_div1']);?></b>
					</div>
				</td>




			  </tr>

			  <tr>

			    <td>
					<div >
					<i class="fa fa-check-square-o"></i> Level
					</div>
				</td>
				<td>:</td>
			    <td >
					<div >
						<b><?php echo cek_lvl($fpk_data_id['fpk_lvl1']);?></b>
					</div>
				</td>



			  </tr>

			  <tr>

			    <td>
					<div >
					<i class="fa fa-check-square-o"></i> Lokasi
					</div>
				</td>
				<td>:</td>
			    <td >
					<div >
						<b><?php 
						//echo cek_unt($fpk_data_id['fpk_unt1']);
						echo cek_ktr($fpk_data_id['fpk_ktr1']);
						?></b>
					</div>
				</td>



			  </tr>
			 

			</tbody>

		      </table>

		      

		    </div>

		  </div>

		</div>


<!-------------------------------------------------------------------!-->

<!-------------------------------------------------------------------!-->      
		<div class="panel panel-default">

		  <div class="panel-heading">

		    <h4 class="panel-title">

		      <a data-toggle="collapse" data-parent="#accordion" 
			  href="#aspek_2<?php //echo $fpk_data_asp['fpk_asp_id']; ?>">
              II. POSISI SETELAH  <font id="judul_2">MUTASI</font>
		      <div class="pull-right"><i class="fa fa-chevron-down"></i></div></a>

		    </h4>

		  </div>
		  <?php  $in = "in"; ?>    
		  <div id="aspek_2<?php //echo $fpk_data_asp['fpk_asp_id']; ?>" 
		       class="panel-collapse collapse <?php echo $in; ?>">

		    <div class="panel-body">
	      
		      <table class="" border="0"  width="100%">

		  
			  <tbody >
			  <tr >

			    <td width="30%">
					<div >
					<i class="fa fa-check-square-o"></i> Jabatan / Posisi *)
					</div>
				</td>

				<td width="3%"> : </td>


			    <td width="">
				<div class="bfh-selectbox" data-name="fpk_jabatan2" data-value="<?php echo $fpk_data_id['fpk_jbt2'];?>" data-filter="true" 
				 style="width:90%; "  >
						<div data-value=""></div>
						<?php
							if($jbt_tampil){
							foreach($jbt_tampil as $data){  
						 ?>
				
						<div data-value="<?php echo $data['jbt_id'];?>"  >
							 <b><?php echo $data['jbt_nm'];?></b>
						</div>
						<?php }}?>    
		
				   </div>		
			    </td>

			  </tr>

	
			  <tr>

			    <td>
					<div >
					<i class="fa fa-check-square-o"></i> Devisi / Unit Kerja *)
					</div>
				</td>

				<td>:</td>


			    <td>
				<div class="bfh-selectbox" data-name="fpk_divisi2" data-value="<?php echo $fpk_data_id['fpk_div2'];?>" data-filter="true" 
				 style="width:90%; "  >
						<div data-value=""></div>
						<?php
							if($div_tampil){
							foreach($div_tampil as $data){  
						 ?>
				
						<div data-value="<?php echo $data['div_id'];?>"  >
							 <b><?php echo $data['div_nm'];?></b>
						</div>
						<?php }}?>    
		
				   </div>		
			    </td>

			  </tr>

			  <tr>

			    <td>
					<div >
					<i class="fa fa-check-square-o"></i> Level *)
					</div>
				</td>

				<td>:</td>


			    <td>
				<div class="bfh-selectbox" data-name="fpk_level2" data-value="<?php echo $fpk_data_id['fpk_lvl2'];?>" data-filter="true" 
				 style="width:90%; "  >
						<div data-value=""></div>
						<?php
							if($lvl_tampil){
							foreach($lvl_tampil as $data){  
						 ?>
				
						<div data-value="<?php echo $data['lvl_id'];?>"  >
							 <b><?php echo $data['lvl_nm'];?></b>
						</div>
						<?php }}?>    
		
				   </div>		
			    </td>

			  </tr>

			  <tr>

			    <td>
					<div >
					<i class="fa fa-check-square-o"></i> Lokasi *)
					</div>
				</td>

				<td>:</td>


			    <td >
				<div class="bfh-selectbox" data-name="fpk_ktr2" data-value="<?php echo $fpk_data_id['fpk_ktr2'];?>" data-filter="true" 
				 style="width:90%; "  >
						<div data-value=""></div>
						<?php
							if($ktr_tampil){
							foreach($ktr_tampil as $data){  
						 ?>
				
						<div data-value="<?php echo $data['ktr_id'];?>"  >
							 <b><?php 
							    echo $data['ktr_nm'];
							   ?>
							  </b>  
						</div>
						<?php }}?>    
		
				   </div>		
			    </td>

			  </tr>
			 

			</tbody>

		      </table>

		      

		    </div>

		  </div>

		</div>


		<!-------------------------------------------------------------------!-->
		<div class="panel panel-default">

		  <div class="panel-heading">

		    <h4 class="panel-title">

		      <a data-toggle="collapse" data-parent="#accordion" 
			  href="#aspek_3<?php //echo $fpk_data_asp['fpk_asp_id']; ?>">
              III. ALASAN / PERTIMBANGAN
		      <div class="pull-right"><i class="fa fa-chevron-down"></i></div></a>

		    </h4>

		  </div>
		   <?php  $in = "in"; ?>    
		  <div id="aspek_3<?php //echo $fpk_data_asp['fpk_asp_id']; ?>" 
		    class="panel-collapse collapse <?php echo $in; ?>" >

		    <div class="panel-body">
	      
		      <table class="" border="0" width="100%">


			  <tbody>


			  <tr>
			    <td width="30%">
					<div >
					<i class="fa fa-check-square-o"></i> Alasan / Pertimbangan 
					</div>
				</td>

                <td width="3%">:</td>
			    <td width="70%">
					<div style="width:90%" >
					<div >
			  
			      <textarea name="fpk_alasan" class="form-control" rows="5" required <?php echo $disabled;?> ><?php echo $fpk_data_id['fpk_alasan']; ?></textarea>				  
					</div>
					</div>
			   </td>
			  </tr>
	
			</tbody>

		      </table>

		      

		    </div>

		  </div>

		</div>
	    <!-------------------------------------------------------------------!-->
		<!-------------------------------------------------------------------!-->
		<div class="panel panel-default">

		  <div class="panel-heading">

		    <h4 class="panel-title">

		      <a data-toggle="collapse" data-parent="#accordion" 
			  href="#aspek_4<?php //echo $fpk_data_asp['fpk_asp_id']; ?>">
              IV. PEMOHON
		      <div class="pull-right"><i class="fa fa-chevron-down"></i></div></a>

		    </h4>

		  </div>
		  <?php  $in = "in"; ?>    
		  <div id="aspek_4<?php //echo $fpk_data_asp['fpk_asp_id']; ?>" 
		    class="panel-collapse collapse <?php echo $in; ?>" >

		    <div class="panel-body">
		      <table class="" border="0" width="100%">
				  <tbody>
				     
					  <tr>
						<td width="30%">
							<div >
							<i class="fa fa-check-square-o"></i> Nama
							</div>
						</td>
		
						<td width="3%">:</td>
						<td width="70%">
						  <div> <b><?php echo $nm_pemohon ; ?></b> </div>
					   </td>
					  </tr>
					  <tr>
						<td width="30%">
							<div >
							<i class="fa fa-check-square-o"></i> Jabatan
							</div>
						</td>
		
						<td width="3%">:</td>
						<td width="70%">
						  <div> <b><?php echo $jbt_pemohon ; ?></b> </div>
					   </td>
					  </tr>
					  						
					  <tr>
						<td width="30%">
							<div >
							<i class="fa fa-check-square-o"></i> Devisi
							</div>
						</td>
		
						<td width="3%">:</td>
						<td width="70%">
						  <div> <b><?php echo $div_pemohon ; ?></b> </div>
					   </td>
					  </tr>
				  </tbody>
		      </table>

		    </div>

		  </div>

		</div>
	 <!-------------------------------------------------------------------!-->
	 
		<div class="panel panel-default">

		  <div class="panel-heading">

		    <h4 class="panel-title">

		      <a data-toggle="collapse" data-parent="#accordion" 
			  href="#aspek_5<?php //echo $fpk_data_asp['fpk_asp_id']; ?>">
              V. PENGESEHAN
		      <div class="pull-right"><i class="fa fa-chevron-down"></i></div></a>

		    </h4>

		  </div>
		  <?php $in = "in"; ?>	
		  <div id="aspek_5<?php //echo $fpk_data_asp['fpk_asp_id']; ?>" 
		    class="panel-collapse collapse <?php echo $in; ?>" >

		    <div class="panel-body">
	      
		      <table class="" border="0" width="100%">


			  <tbody>


			  <tr>
			    <td width="30%">
					<div >
					<i class="fa fa-check-square-o"></i> Pemohon *)<strong><em>  </em></strong>
					</div>
				</td>

                <td width="3%">:</td>
			    <td width="70%">
					<b><?php echo cek_nama($fpk_data_id['fpk_penilai']);?></b>
			   </td>
			  </tr>

			  <tr>
			    <td width="30%">
					<div >
					<i class="fa fa-check-square-o"></i> Menyetujui 1 *)
					</div>
				</td>

                <td width="3%">:</td>
			    <td width="70%">
					<b><?php echo cek_nama($fpk_data_id['fpk_mengetahui2']);?></b>
			   </td>
			  </tr>	
			  
			  <tr>
			    <td width="30%">
					<div >
					<i class="fa fa-check-square-o"></i> Menyetujui 2 *)
					</div>
				</td>

                <td width="3%">:</td>
			    <td width="70%">
					<b><?php echo cek_nama($fpk_data_id['fpk_mengetahui']);?></b>
			   </td>
			  </tr>	
			  			  
			  
			  <tr>
			    <td width="30%">
					<div >
					<i class="fa fa-check-square-o"></i> Mengetahui *)
					</div>
				</td>

                <td width="3%">:</td>
			    <td width="70%">
					<b><?php echo cek_nama($fpk_data_id['fpk_menyetujui']);?></b>
			   </td>
			  </tr>	
			  			  
			</tbody>

		      </table>

		      

		    </div>

		  </div>

		</div>
	 <!-------------------------------------------------------------------!-->
	 	 
	 
 </div> <!--panel-group!-->
	      
<!-------------------------------------------------------------------!-->
              


            </div><!-- /.col -->


	  <br>

	  <!-- info row -->

	

      </div>
	  <div>
		  <em>
		  <strong style=" color:red">
		  Keterangan : *) Wajib diisi <br />
		  1) Isilah Form yang telah di sediakan<br>
		  2) Simpan dan Kirim utk dapat persetujan dari dua orang Pimpinan<br />
			  
		  </strong> 
		  </em>
	  </div>		
	  <br>
	  
	  <div class="row no-print">
		<div class="col-xs-12">
		  <!--<a href="invoice-print.html" target="_blank" class="btn btn-default"><i class="fa fa-print"></i> Print</a>-->
		  <button name="bsendupdate" onclick="return confirm('Simpan ?...  ')"  class="btn btn-success pull-right <?php echo $disabled;?>"><i class="fa fa fa-send"></i> Simpan & Kirim</button>
		  <!--<button name="bupdate" class="btn btn-primary pull-right <?php echo $disabled;?>" style="margin-right: 5px;"><i class="fa fa-save"></i> Hanya Simpan</button>-->
		</div>
	  </div>

       </section><!-- /.content -->
        <div class="clearfix"></div>
 </fieldset>	
 		
</form>

<?php }else{ echo"<script>document.location='?p=not_found';</script>";}?>