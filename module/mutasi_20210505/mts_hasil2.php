<?php require('module/mutasi/mts_act.php'); ?>

<?php 
 //if($fpk_cek_id > 0 && $kar_id==$fpk_data_id['fpk_mengetahui2']){
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
</script>

<?php  $title="Konfirmasi ".$xjenis; ?>

<!-- Content Header (Page header) -->
    <section class="content-header">
      <h1> <?php echo $title ." - ". $kar_data_['kar_nm'];?> <small></small> </h1>
      <ol class="breadcrumb">
        <li><a href="media.php"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li class="active"><?php echo $title;?></li>
      </ol>
    </section>
 <form name="myFormMutasi" class="form-horizontal" action="" onsubmit="return validateForm()" method="post">

      <!-- Main content -->
        <section class="invoice col-xs-6">
          <!-- title row -->
          <div class="row">
            <div class="col-xs-12">
              <h2 class="page-header">
                <img src="dist/img/logo_gg_small130.JPG" width="80"> PT. Gilland Ganesha
                <small class="pull-right">
		  <br>
<!--		  
		  <div class="form-group">
		    <label for="fpk_tgl" class="col-sm-2 control-label">Date</label>
		    <div class="col-sm-10">
		      <input type="text" name="fpk_tgl" class="form-control" id="fpk_tgl" value="<?php echo $fpk_data_id['fpk_tgl'];?>" placeholder="Tanggal Penilaian" data-inputmask="'alias': 'yyyy-mm-dd'" data-mask style="width:182;" required <?php echo $disabled;?>>
		    </div>
		  </div>
!-->		  
		</small>
                <center><small>Jl. Raya Bogor Km 47,5 Perum Bumi Sentosa Blok A3 No.3, Nanggewer Cibinong, Jawa Barat 16912.</small></center>
              </h2>
            </div><!-- /.col -->
          </div>
		  
<fieldset <?php echo $disabled;?> >			  
          <!-- info row -->
          <div class="row invoice-info">
          <center><h3><u>FORM <?php echo strtoupper($fpk_data_id['fpk_jenis']);?> TENAGA KERJA</u></h3>
          Nomor Surat&nbsp;&nbsp;<b> <?php echo $fpk_data_id['fpk_kd'];?></b><br/><br/><br/></center>
            <div class="col-sm-8 invoice-col">
              <address>
                <strong><?php echo $kar_data_['kar_nm'];?></strong><br>
                NIK: <?php echo $kar_data_['kar_nik'];?><br>
                Divisi: <?php echo $kar_data_['div_nm'];?> / <?php echo $kar_data_['jbt_nm'];?><br>
                Location: <?php //echo $kar_data_['unt_nm'];?><?php echo $kar_data_['ktr_nm'];?><br>
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
							 <b><?php echo $data['ktr_nm'];?></b>
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
					<i class="fa fa-check-square-o"></i> Alasan / Pertimbangan *)
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

         <div class="row">

          </div><!-- /.row -->
		  <br>
	      <!-- info row -->
          <div class="row invoice-info">
            <div class="col-sm-4 invoice-col">
             <strong>Pemohon</strong>
             <br>
                <?php
                $fpk_penilai_=$fpk_data_id['fpk_penilai'];
                $fpk_tampil_penilai=$kar->kar_tampil_id($fpk_penilai_);
                $fpk_data_penilai=mysql_fetch_array($fpk_tampil_penilai);
                echo $fpk_data_penilai['kar_nm'];
                ?>			  

              
            </div><!-- /.col -->
            <div class="col-sm-4 invoice-col">
              <strong>Menyetujui</strong>
               <br>
		 <?php
                $fpk_mengetahui_=$fpk_data_id['fpk_mengetahui'];
                $fpk_tampil_mengetahui=$kar->kar_tampil_id($fpk_mengetahui_);
                $fpk_data_mengetahui=mysql_fetch_array($fpk_tampil_mengetahui);
                
				$fpk_mengetahui2_=$fpk_data_id['fpk_mengetahui2'];
                $fpk_tampil_mengetahui2=$kar->kar_tampil_id($fpk_mengetahui2_);
                $fpk_data_mengetahui2=mysql_fetch_array($fpk_tampil_mengetahui2);
		
				echo '1) '.$fpk_data_mengetahui2['kar_nm'];
				if(!empty($fpk_data_mengetahui2['kar_nm'])){
				  echo "<br>";
				}
                echo '2) '.$fpk_data_mengetahui['kar_nm'];
        ?>
              
            </div><!-- /.col -->
            <div class="col-sm-4 invoice-col">
              <strong>Mengetahui</strong>
               <br>
			  <?php 
				$fpk_menyetujui_=$fpk_data_id['fpk_menyetujui'];
                $fpk_tampil_menyetujui=$kar->kar_tampil_id($fpk_menyetujui_);
                $fpk_data_menyetujui=mysql_fetch_array($fpk_tampil_menyetujui);	
                echo $fpk_data_menyetujui['kar_nm'];
			  ?>	      
            </div><!-- /.col -->
          </div><!-- /.row -->


	  	
</fieldset>	
	    <hr />  	
		  <?php 
			$tgl_berlaku = "";
			$text_ditolak = "Disetujui / Ditolak";
			if ($fpk_data_id['fpk_approval_2']=="Y" ){
			   $tgl_berlaku = $fpk_data_id['fpk_berlaku'];
			   $disabled = "disabled";
			   $text_ditolak = "Disetujui";
			}else{
			   $tgl_berlaku = "";
			   $disabled = "";				
			}
			
			if ($fpk_data_id['fpk_sts']=="T" ){
			   $text_ditolak = "Ditolak/Tidak Disetujui";
	
			}			
		  ?> 

		 <div align="left" style="width:100%" >
		    <b>Alasan : <?php echo $text_ditolak;?>  </b>
			<div >
			  
	   <textarea name="fpk_alasan_ditolak" class="form-control" rows="2" required <?php echo $disabled;?> ><?php echo $fpk_data_id['fpk_alasan_ditolak']; ?></textarea>				  
			</div>
	     </div>		
		 <br />

		  <div class="form-group"  >
		    <label for="fpk_tgl" class="col-sm-9 control-label " style="text-align:right">
			 <?php echo $text_ditolak;?>  Tanggal :
			</label>
		    <div class="col-sm-3">

              <input type="text" value="<?php echo $tgl_berlaku;?>" name="fpk_berlaku" class="form-control" placeholder="Tgl Berlaku" id="dpdays"   style="width:100px" required <?php echo $disabled;?> />
			  		   
		    </div>
		  </div>
		  <div align="right">
			  Oleh : <b><?php echo $fpk_data_mengetahui2['kar_nm'] ;?></b>
		  </div>		  		  
		
		     

	   
	  <hr /> 
	  <div class="row no-print">
		<div class="col-xs-12">

          <?php
	          
		      if($fpk_data_id['fpk_sts']=="Z" ){

	      ?>
		  
     
	      <button type="submit" name="bapproved2" class="btn btn-success pull-right" <?php echo $done;?>>
		  	<i class="fa fa-thumbs-up"></i> Approved / Setuju 
		  </button>

	      <?php }else{?>



		  
	      <button type="submit" name="bapproved2" onclick="return confirm('Apakah Setuju ?...  ')" 
		  class="btn btn-success pull-right" <?php echo $konfirm2;?> >
		  	<i class="fa fa-thumbs-up"></i> Approved / Setuju 
		  </button>
          
	      <button type="submit" name="bditolak" onclick="return confirm(' Ditolak / Tidak Setuju ?...  ')" 
		  class="btn btn-danger pull-right" style="margin-right: 5px;"  <?php echo $konfirm2;?> >
		  	 <i class="fa fa-ban"></i> Ditolak 
		  </button>
		   
	      <?php }?>

	      <button class="btn btn-danger pull-right" style="margin-right: 5px;"  <?php echo $ignore;?>>
		  	<i class="fa fa-ban"></i> Cancel
		  </button>
		  
		</div>
	  </div>

       </section><!-- /.content -->
        <div class="clearfix"></div>
 
 		
</form>

<?php }else{ echo"<script>document.location='?p=not_found';</script>";}?>