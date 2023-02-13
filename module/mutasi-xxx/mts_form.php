<?php require('module/mutasi/mts_act.php'); ?>

<?php 
   //if($fpk_cek_id > 0 && $kar_id==$fpk_data_id['fpk_mengetahui']){
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

<?php  
	$title="Konfirmasi ".$xjenis; 

	$tgl_berlaku = "";
	$disabled = "disabled";
	if ($fpk_data_id['fpk_approval_2']=="Y" ){
	   $tgl_berlaku = $fpk_data_id['fpk_berlaku'];
	  // $disabled = "disabled";
	}

?>




<div id="content">
<div id="masterContent">


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
                <img src="dist/img/logo_gg_small130.JPG" width="80"> 
				<div style="margin-left:90px; margin-top:-60px; line-height:20px">
					PT. Gilland Ganesha<br />
					 <small>Jl. Raya Bogor Km 47,5 Perum Bumi Sentosa Blok A3 No.3,
						    Nanggewer Cibinong, Jawa Barat 16912.
				     </small>
					
				
				</div>
              </h2>
            </div><!-- /.col -->
          </div>
		  
  
          <!-- info row -->
          <div class="row invoice-info"  style=" margin-top:-20px;line-height:5px">
          <center><h4><u>FORM <?php echo strtoupper($fpk_data_id['fpk_jenis']);?> TENAGA KERJA</u></h4>
          Nomor Surat&nbsp;&nbsp;<b> <?php echo $fpk_data_id['fpk_kd'];?></b><br/><br/><br/></center>
            <div class="col-sm-8 invoice-col" style="width:300px;">
              <address style="line-height:17px">
                <strong>
				Nama : <?php echo $kar_data_['kar_nm'];?>
				</strong><br>
                NIK     : <?php echo $kar_data_['kar_nik'];?><br>
                Divisi  : <?php echo $kar_data_['div_nm'];?> / <?php echo $kar_data_['jbt_nm'];?><br>
                Location: <?php //echo $kar_data_['unt_nm'];?> <?php echo $kar_data_['ktr_nm'];?><br>
              </address>
            </div><!-- /.col -->
            
            <div class="col-sm-4 invoice-col" >
              <address style="line-height:17px">
                <br>
                Priode : <strong><?php echo $fpk_data_id['fpk_priode'];?></strong><br>
                <br>
                Gaji Terakhir: Rp. <strong><?php echo $fpk_data_id['fpk_gaji']? $rph->format_rupiah($fpk_data_id['fpk_gaji']) : '-';?></strong><br>
              </address>
            </div><!-- /.col -->
          </div><!-- /.row -->

          <!-- Table row -->
          <div class="row" >
            <div class="col-xs-12 table-responsive">

<div class="panel-group" id="accordion" style="line-height:15px;   ">
<!-------------------------------------------------------------------!-->  
		
		<div class="panel panel-default">

		  <div class="panel-heading">

		      <b>

		      <a data-toggle="collapse" data-parent="#accordion" 
			  href="#aspek_1<?php //echo $fpk_data_asp['fpk_asp_id']; ?>">
              I. POSISI SEKARANG
		      <div class="pull-right"><i class="fa fa-chevron-down no-print"></i></div></a>
			  </b>

		   

		  </div>
          <?php  $in = "in"; ?>    
		  <div id="aspek_1<?php //echo $fpk_data_asp['fpk_asp_id']; ?>" 
		    class="panel-collapse collapse <?php echo $in; ?>" >

		    <div class="panel-body">
	      
		      <table class="" border="0" width="100%" style="margin-top:-10px">


			  
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
						<b>
						<?php 
						   //echo cek_unt($fpk_data_id['fpk_unt1']);
						   echo cek_ktr($fpk_data_id['fpk_ktr1']);
						?>
						</b>
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

		 
 			  <b>
		      <a data-toggle="collapse" data-parent="#accordion" 
			  href="#aspek_2<?php //echo $fpk_data_asp['fpk_asp_id']; ?>">
              II. POSISI SETELAH  <font id="judul_2">MUTASI</font>
		      <div class="pull-right"><i class="fa fa-chevron-down no-print"></i></div></a>
			  </b>

		  

		  </div>
		  <?php  $in = "in"; ?>    
		  <div id="aspek_2<?php //echo $fpk_data_asp['fpk_asp_id']; ?>" 
		       class="panel-collapse collapse <?php echo $in; ?>">

		    <div class="panel-body">
	      
		      <table class="" border="0"  width="100%" style="margin-top:-10px">

		  
			  <tbody >
			  <tr >

			    <td width="30%">
					<div >
					<i class="fa fa-check-square-o"></i> Jabatan / Posisi 
					</div>
				</td>

				<td width="3%"> : </td>


			    <td width="">
					<div >
						<b><?php echo cek_jbt($fpk_data_id['fpk_jbt2']);?></b>
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


			    <td>
					<div >
						<b><?php echo cek_div($fpk_data_id['fpk_div2']);?></b>
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


			    <td>
					<div >
						<b><?php echo cek_lvl($fpk_data_id['fpk_lvl2']);?></b>
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
						//echo cek_unt($fpk_data_id['fpk_unt2']);
						echo cek_ktr($fpk_data_id['fpk_ktr2']);
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
		<div class="panel panel-default">

		  <div class="panel-heading">

		 
              <b>
		      <a data-toggle="collapse" data-parent="#accordion" 
			  href="#aspek_3<?php //echo $fpk_data_asp['fpk_asp_id']; ?>">
              III. ALASAN / PERTIMBANGAN
		      <div class="pull-right"><i class="fa fa-chevron-down no-print"></i></div></a>
			  </b>

		 

		  </div>
		   <?php  $in = "in"; ?>    
		  <div id="aspek_3<?php //echo $fpk_data_asp['fpk_asp_id']; ?>" 
		    class="panel-collapse collapse <?php echo $in; ?>" >

		    <div class="panel-body">
	      
		      <table class="" border="0" width="100%" style="margin-top:-10px">


			  <tbody>


			  <tr>
			    <td width="30%">
					<div >
					<i class="fa fa-check-square-o"></i> Alasan / Pertimbangan 
					</div>
				</td>

                <td width="3%">:</td>
			    <td width="70%">
					<div style="width:100%" >
					
					<div >
								  
			      <textarea name="fpk_alasan" class="form-control" rows="3" required <?php echo $disabled;?> ><?php echo $fpk_data_id['fpk_alasan']; ?></textarea>				  
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

		
			  <b>	
		      <a data-toggle="collapse" data-parent="#accordion" 
			  href="#aspek_4<?php //echo $fpk_data_asp['fpk_asp_id']; ?>">
              IV. PEMOHON
		      <div class="pull-right"><i class="fa fa-chevron-down no-print"></i></div></a>
			 </b>
		  

		  </div>
		  <?php  $in = "in"; ?>    
		  <div id="aspek_4<?php //echo $fpk_data_asp['fpk_asp_id']; ?>" 
		    class="panel-collapse collapse <?php echo $in; ?>" >

		    <div class="panel-body">
		      <table class="" border="0" width="100%" style="margin-top:-10px">
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

		  <div class="panel-heading" >

		    
              <b>
		      <a data-toggle="collapse" data-parent="#accordion" 
			  href="#aspek_5<?php //echo $fpk_data_asp['fpk_asp_id']; ?>">
              V. PENGESEHAN
		      <div class="pull-right"><i class="fa fa-chevron-down no-print"></i></div></a>
			  </b>

		   

		  </div>
		  <?php $in = "in"; ?>	
		  <div id="aspek_5<?php //echo $fpk_data_asp['fpk_asp_id']; ?>" 
		    class="panel-collapse collapse <?php echo $in; ?>" >

		    <div class="panel-body" >
	      
		      <table class="" border="0" width="100%" style="margin-top:-10px">


			  <tbody>
				  <tr style=" vertical-align:top">
				  <td>
				   <?php 
				     $tgl_berlaku = "...............";
					 if (date('Y',strtotime($tgl_berlaku)) <= 2000){
					    $tgl_berlaku = date('d-m-Y',strtotime($tgl_berlaku)) ;
					 }
				   ?>
				   <b> Bogor , <?php echo $tgl_berlaku ;?> </b> 
				  </td>
				  </tr>

			  <tr style=" vertical-align:top">
			    <td width="30%">
					<div >
					Pemohon <br /><br />
					<?php echo cek_nama($fpk_data_id['fpk_penilai']);?>
					</div>
				</td>

                <td width="30%">
					<div>
					Menyetujui, <br /><br />
					<?php echo cek_nama($fpk_data_id['fpk_mengetahui2']);?>
					</div>
				</td>
			    <td width="30%">
				    <div>
					Menyetujui, <br /><br />
					<?php echo cek_nama($fpk_data_id['fpk_mengetahui']);?>
					</div>
			   </td>
			    <td width="30%">
				    <div>
					Mengetahui, <br /><br />
					<?php echo cek_nama($fpk_data_id['fpk_menyetujui']);?>
					</div>
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

	  <!-- info row -->


      </div>
	  
	  <?php
	   $xtgl_berlaku = $tgl_berlaku;
	   if (date('Y',strtotime($tgl_berlaku))<=2000){
	      $xtgl_berlaku = "..................";
	   }
	  ?>

      <div class="panel-body" style="line-height:14px; font-size:14px; ">
	    <div style="margin-top:-20px">
<?php
  if ($fpk_data_id['fpk_sts']=="T"){
?>  
     <b>
     Hasil Keputusan Management : Ditolak/Tidak Disetujui<br />
	 Alasan : <?php echo $fpk_data_id['fpk_alasan_ditolak'];?>
	 </b>
<?php	 
  }else{
?>		 
       <em>		
		<u>Catatan :</u><br />
		1) Surat <?php echo $xjenis ; ?> Tugas  ini  dibuat  u/Ybs, sesuai arahan dan hasil rapat Pimpinan dengan Jajaran Dewan Direksi.<br />
		2) <?php echo $xjenis ; ?> Tugas ini dikeluarkan, lebih kearah optimalisasi SDM di bidang promosi/marketing  dan tertib administrasi lainnya.<br />
		3) <?php echo $xjenis ; ?> Tugas ini u/Ybs, efektif  diberlakukan sejak tanggal,  <strong><?php echo $xtgl_berlaku ;?></strong>
		
<?php } ?>		
		</em>
		
		<?php
			if ($fpk_data_id['fpk_approval_2']=="N" ){
			   echo '<br></br>';
			   echo "<center><font color=red>Form ini belum ada persetujuan dari Atasan !...</font><center>";
	 		 
			}
		?>	

		</div>
	  </div>



	  
	  <div class="row no-print">
		<div class="col-xs-12">

          <?php
	          
		      if($fpk_data_id['fpk_sts']=="Z" || $fpk_data_id['fpk_sts']=="T" ){

	      ?>


              <a href="print_mutasi.php?p=form_mutasi&act=open&id=<?php echo md5($fpk_data_id['fpk_kd']); ?>" 
			 	  target="_blank" class="btn btn-primary" onclick="return confirm('Mau Di Print ?...')" >
			   <i class="fa fa-print"></i> Print</a>

 
			 <!--  
              <div class="pull-right">
	      		<a class="btn btn-success" ><i class="fa fa-thumbs-up"></i> Approved</a>
              </div>
			 !-->  
	      <?php }else{?>
	      <a href="print_mutasi.php?to=prt&id=<?php echo md5($fpk_data_id['fpk_kd']); ?>" target="_blank" class="btn btn-default" disabled><i class="fa fa-print"></i> Print </a>

	      <?php }?>

	
		  
		</div>
	  </div>

       </section><!-- /.content -->
        <div class="clearfix"></div>
 
 		
</form>

</div> <!-- ----print-area------ !-->
</div>

<?php }else{ echo"<script>document.location='?p=not_found';</script>";}?>