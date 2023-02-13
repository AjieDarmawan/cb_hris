<?php 

   session_start();
   
   $cek_kar_id     = $_SESSION['kar'] ;
  
				   
?>


<div id="printThis" >
<div class="modal fade"  id="modal-update-user"  role="dialog"     
		aria-labelledby="myModalLabel" aria-hidden="true"   
        style="overflow-y: scroll; max-height:100%;  margin-top: 0px; margin-bottom:0px;" >   	

  <div class="modal-dialog modal-lg">

    <div class="modal-content">

      <div class="modal-header bg-primary">
        <button type="button" class="close hidden-print" data-dismiss="modal" aria-label="Close">
		<span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel"><i class="fa fa-bar-chart"></i> Form Pinjaman Paguyuban</h4>
      </div>

      
      <div class="modal-body" style="margin-top:-25px">
	  <?php
			
			date_default_timezone_set('Asia/Jakarta'); 
			foreach($_REQUEST as $name=>$value){
				$$name=$value;
				//echo "$name : $value;<br />\n";
			}	  
			include "pag_data_action.php"; 
			
			//$range_now 	= date('01/m/Y') . ' - ' . date('d/m/Y');
			
			$range_now 	=  date('Y-m-d');
	 		
			$xdata = __list_pinjaman($id);  
			
			//echo '<br>pinjaman : '.$xdata[0]['pg_pinjaman']; 
			///////////////////////////////////////////////////////////
			//echo  $num_rev;	
			$cek_proses = $xdata[0]['pg_status'];
			if ($cek_proses == "" || $cek_proses == "New" || $cek_proses == "Proses" ){
			   $cek_proses = "-";
			}
			if ($cek_proses == "Disejui"){
			   $cek_proses  = $xdata[0]['pg_status'];
			  // $cek_proses .=' dan Mulai Kerja Tgl : '.date('d-m-Y',strtotime($xdata[0]['tgl_kerja']));
			}	
			
			$xREQUIRED = "required" ;
			if ($aksi == "save_add_data" and $act =="add" ){
			  // $xREQUIRED = "";
			}
			
			$xDISPLAY = "block";
		
			if ($kar_id == 499 || $kar_id == 551 || $kar_id == 542 || $kar_id == 37 ){
			  ////////admin atau sdm////////////// 
			}else{
			    $xDISPLAY = "none";
			}
			
			$cek_pemohon_id = $xdata[0]['pg_kar_id'];
		   ////////////////////////////////////////////////// 
		   if ($id <> 0 ){
		     /////edit-data/////////
			 $cek_kar_id = $cek_pemohon_id ;
		   } 
		   
		   //echo '<br><br>cek_kar_id : '.$cek_kar_id ;
		   
		   $json_pemohon =  __list_karyawan($cek_kar_id);   
		   for($a=0; $a < count($json_pemohon); $a++) {
					$v_id  	   		= $json_pemohon[$a]['kar_id'] ;
					$v_jbt_id   	= $json_pemohon[$a]['jbt_id'] ;
					$v_div_id   	= $json_pemohon[$a]['div_id'] ;
					$v_lvl_id   	= $json_pemohon[$a]['lvl_id'] ;
					$v_unt_id   	= $json_pemohon[$a]['unt_id'] ;
					$v_ktr_id   	= $json_pemohon[$a]['ktr_id'] ;
					/////////////////////////////////
					$v_kar_nik      = $json_pemohon[$a]['kar_nik'] ;
					$v_kar_nm       = $json_pemohon[$a]['kar_nm'] ;
					$v_lvl_nama    	= $json_pemohon[$a]['lvl_nm'] ;
					$v_jbt_nm      	= $json_pemohon[$a]['jbt_nm'] ;
					$v_div_nm   	= $json_pemohon[$a]['div_nm'] ;
					$v_ktr_nm   	= $json_pemohon[$a]['ktr_nm'] ;
					$v_status       = $json_pemohon[$a]['kar_dtl_typ_krj'] ;
					$v_tgl_masuk    = date('d-m-Y',strtotime($json_pemohon[$a]['kar_dtl_tgl_joi'])) ;
		   }
		   
		 $v_akhir_kontrak = "-";
		 if ($v_status == "Kontrak"){
            $kkn_tampil_kar_limit=$nla->kkn_tampil_kar_limit($cek_kar_id);
            $kkn_data_kar_limit=mysql_fetch_assoc($kkn_tampil_kar_limit);
            $kkn_cek_kar_limit=mysql_num_rows($kkn_tampil_kar_limit);
            if($kkn_cek_kar_limit > 0){
			   $v_tgl_masuk     = date('d M Y',strtotime($kkn_data_kar_limit['kkn_start']));
			   $v_akhir_kontrak = date('d M Y',strtotime($kkn_data_kar_limit['kkn_end']));
            }
		 }   
			//echo '<br>'.$cek_kar_id;			   
	
	 ?>
	 
	<!-- Main content -->

      <section class="invoice">
         <div class="row">
		 	  <div class="form-check hidden-print">&nbsp;&nbsp;
				<input type="checkbox" class="form-check-input" id="checkbox_1" 
							onclick="doRefreshFormA(this)" >
				<label class="form-check-label" for="exampleCheck1">&nbsp;&nbsp; CHECK </label>
							
				<button  onclick="doBTNPRINT()" type="button" class="btn btn-default">
					<i class="fa fa-print"></i> Print
				</button>
				
	 		 </div>
		  	<table border="1"  class="xtable" 
			    style=" border-collapse: collapse;  "
			    width="100%"   >
			  <tr>
				<th rowspan="2"  colspan="1" width="50px" >
				 <div >
				  <img src="dist/img/logo_gg_small130.JPG" width="80px" height="50px">				 
				 </div>
				</th>
				<th colspan="5" ><div align="center" style="font-size:20">PT. Gilland Group</div></th>
			  </tr>
			  <tr>
				<th class="xbtn-secondary2 "  colspan="5">
				<div  class="xbtn-secondary2 " style=" text-align:center ;  font-size:20">
				FORMULIR PINJAMAN PAGUYUBAN</div>				
				</th>
			  </tr>

		 	 <tr>
			   <td colspan="2" style="padding-right: 5px; padding-left: 5px;" >NIK</td>
			   <th colspan="4" style="padding-right: 5px; padding-left: 5px;" >
			     <div ><?php echo ''.$v_kar_nik;?></div>	
			  </th>
			  </tr>	
			  			  	
			  <tr>
			   <td colspan="2" style="padding-right: 5px; padding-left: 5px;" >Nama</td>
			   <th colspan="4" style="padding-right: 5px; padding-left: 5px;" >
			     <input type="hidden" name="pg_kar_id" value="<?php echo $cek_kar_id;?>"> 
				 <input type="hidden" name="pg_kar_nik" value="<?php echo $v_kar_nik;?>"> 
				 <input type="hidden" name="pg_kar_nm" value="<?php echo $v_kar_nm;?>"> 
			     <div ><?php echo ''.$v_kar_nm;?></div>	
			  </th>
			  </tr>	
			  			  				  
			  <tr>
			   <td colspan="2" style="padding-right: 5px; padding-left: 5px;" >Jabatan / Posisi</td>
			   <th colspan="4" style="padding-right: 5px; padding-left: 5px;" >
			     <div ><?php echo ''.$v_jbt_nm;?></div>	
			  </th>
			  </tr>	
			  <tr>
			   <td colspan="2" style="padding-right: 5px; padding-left: 5px;" >Divisi</td>
			   <th colspan="4" style="padding-right: 5px; padding-left: 5px;" >
			   		 <div ><?php echo ''.$v_div_nm;?></div>	
			   </th>
			  </tr>				  

<!--
			  <tr>
			   <td colspan="2" style="padding-right: 5px; padding-left: 5px;" >Unit Kerja</td>
			   <th colspan="4" style="padding-right: 5px; padding-left: 5px;" >
			       <div ><?php echo ''.$v_ktr_nm;?></div>	
			   </th>
			  </tr>				  

!-->


			  <tr>
			   <td colspan="2" style="padding-right: 5px; padding-left: 5px;" >Status Pegawai</td>
			   <th colspan="4" style="padding-right: 5px; padding-left: 5px;" >
					<div ><?php echo ''.$v_status;?></div>		
			   </th>
			  </tr>	

			  <tr>
			   <td colspan="2" style="padding-right: 5px; padding-left: 5px;" >Tanggal Masuk Kerja</td>
			   <th colspan="4" style="padding-right: 5px; padding-left: 5px;" >
					<div ><?php echo ''.$v_tgl_masuk;?></div>					 
			   </th>
			  </tr>	

			  <tr>
			   <td colspan="2" style="padding-right: 5px; padding-left: 5px;" >Tanggal Akhir Kontrak</td>
			   <th colspan="4" style="padding-right: 5px; padding-left: 5px;" >
					<div ><?php echo ''.$v_akhir_kontrak ;?></div>					 
			   </th>
			  </tr>	
			  			  		
			  <tr>
			   <td colspan="2" style="padding-right: 5px; padding-left: 5px;" >Jumlah Pinjaman</td>
			   <th colspan="4" style="padding-right: 5px; padding-left: 5px; " >
			    <div id="div1_pg_pinjaman" class="hidden-print" >
			     <?php
				    
				    if ($xdata[0]['pg_pinjaman'] <= 0 || $xdata[0]['pg_pinjaman'] == ""){
					  // $xdata[0]['pg_pinjaman']  = "" ;
					}
				 ?>
				 <input type="text"  class="form-control number-separator"  id="pg_pinjaman" name="pg_pinjaman"
				  value="<?php echo  number_format($xdata[0]['pg_pinjaman']); ?>" 
				  onkeypress="return isNumberKey(event)"
				  placeholder="Jumlah Pinjaman "  <?php echo $xREQUIRED;?>  >
			     </div>
				<div id="div2_pg_pinjaman"></div >							  
			   </th>
			  </tr>			


			  <tr>
			   <td colspan="2" style="padding-right: 5px; padding-left: 5px;" >Lama Angsuran</td>
			   <th colspan="4" style="padding-right: 5px; padding-left: 5px; " >
			    <div id="div1_pg_lama" class="hidden-print" >
			     <?php
				    
				    if ($xdata[0]['pg_lama'] <= 0 || $xdata[0]['pg_lama'] == ""){
					   $xdata[0]['pg_lama']  = ""  ;
					}
			     ?>
				 <input type="text" class="form-control" id="pg_lama" name="pg_lama"
				  value="<?php echo $xdata[0]['pg_lama']; ?>" 
				  onkeypress="return isNumberKey(event)" 
				  placeholder="Lama Angsuran...(1 sd 10)"  <?php echo $xREQUIRED;?> >
			     </div>
				<div id="div2_pg_lama"></div >							  
			   </th>
			  </tr>			

			  <tr>
			   <td colspan="2" style="padding-right: 5px; padding-left: 5px;" >Untuk Keperluan</td>
			   <th colspan="4" style="padding-right: 5px; padding-left: 5px;" >
			     <div id="div1_pg_ket" class="input-group hidden-print" style="width:100%"  >			   
					<textarea class="form-textarea" style="width:100%" id="pg_ket"  name="pg_ket" rows="1"  placeholder="Untuk Keperluan ..." required ><?php echo $xdata[0]['pg_ket'];?></textarea> 

			     </div>
				<div id="div2_pg_ket"></div >	
				
			   </th>
			  </tr>	


			  <tr>
			   <td colspan="2" style="padding-right: 5px; padding-left: 5px;" >Bank... / NoRek... / an ...  </td>
			   <th colspan="4" style="padding-right: 5px; padding-left: 5px; " >
			    <div id="div1_pg_norek" class="hidden-print" >
				 <input type="text"  class="form-control "  id="pg_norek" name="pg_norek"
				  value="<?php echo  $xdata[0]['pg_norek']; ?>" 
				  placeholder="Bank... : NoRek... : an ... "  <?php echo $xREQUIRED;?>  >
			     </div>
				<div id="div2_pg_norek"></div >							  
			   </th>
			  </tr>			
			  			  			  

			  


			  <tr>
			   <th class="xbtn-secondary3 " colspan="6"  
			   style=" text-align:center;padding-right: 5px; padding-left: 5px;" >&nbsp;
				</th>
			  </tr>		




			  		  
			  <tr>
			   <td colspan="2" width="200px" style="padding-right: 5px; padding-left: 5px;" > 
			      <div style=" line-height:20px; vertical-align:text-bottom">
				   <br />
			       Cibinong , <?php echo date('d-m-Y') ;?> 
				   <br />
				   Peminjam
				   <br /><br /><br /><br />
				   <u><?php echo $v_kar_nm; ?></u><br />Peminjam 
				  </div> 
				</td>
				
			   <td colspan="1" width="150px" style="padding-right: 5px; padding-left: 5px;" >
			     <div style=" line-height:20px; vertical-align:text-bottom">
					<br />&nbsp;<br />
					Mengetahui,
					 <br /><br /><br /><br />
					 <u>Siti Rayahu</u><br />Bendahara
			  	 </div>		  			   

			  </td>
			   <td colspan="1" width="150px" style="padding-right: 5px; padding-left: 5px;" >
			     <div style=" line-height:20px; vertical-align:text-bottom">
					<br />&nbsp;<br />
					Menyetujui,
					 <br /><br /><br /><br />
					 <u>Suyanto</u><br />Ketua
					

			  	 </div>		  			   

			  </td>			  
			   <td colspan="2" width="150x" style="padding-right: 5px; padding-left: 5px; line-height:inherit" >
<!--			   
			       <div style=" line-height:20px; vertical-align:text-bottom">
					<br />&nbsp;<br />
					Menyetujui,
					<br /><br /><br /><br />
					( Ketua )
				   </div>	
!-->				   			
				   </td>
			  </tr>
			  <tr>
			    <th colspan="6" style="height:50px">
				  &nbsp; <?php //echo 'Keputusan : '.$cek_proses; ?>
				</th>
			  </tr>
			</table>
			  

          </div>

     </section><!-- /.content -->
        
      </div>
	  
      <div>&nbsp;</div>
	  <div class="hidden-print">
		  <div class="modal-footer">
		    <input type="hidden" id="btnDITOLAK" name="btnDITOLAK" value=""> 
		    <input type="hidden" name="id" value="<?php echo $id;?>"> 
			<input type="hidden" name="mode" value="simpan"> 
			<input type="hidden" name="act" value="<?php echo $act;?>">   
			<input type="hidden" id="aksi" name="aksi" value="<?php echo $aksi;?>">  
			<input type="hidden" id="aksi_proses" name="aksi_proses" value="<?php echo $aksi_proses;?>"> 
			
			<div class="input-group  pull-left" style="left:100px"  >
			<button type="submit" id="bsave" name="bsave" class="btn btn-primary"  >
				<i class="fa fa-save"></i> Simpan 
			</button>
			</div>
	
	
			<div class="input-group pull-left" style="left:50px" >	
			   <div class="input-group pull-left" >	
			   		
				<button type="submit" id="bapprove" name="bapprove"
					class="btn btn-primary"  >
					<i class="fa fa-save"></i> Approval / Setuju 
				</button>
			     <div  class="input-group" id="bmulai_bayar" >
				    <b>
					 <label class="label">Tgl.Mulai Angsuran</label>
					 <input type="text"  class="form-control number-separator"  name="pg_pinjaman_acc" 
					 	style="width:140px;"  value="<?php echo number_format($xdata[0]['pg_pinjaman']);?>"
						onkeypress="return isNumberKey(event)"  
					    placeholder="Pinjaman yg disetujui"   >

					 <input type="text"  class="form-control dp"  name="pg_mulai_bayar" 
					 	style="width:140px;"  value="" 
					    placeholder="Tgl Mulai Angsuran "   >
					</b>  
				 </div> 				
			  </div>

			  
			  <div class="input-group pull-left" >
			    &nbsp; &nbsp; 
			  </div>	
				 
			   <div class="input-group pull-left" >	
				<button  type="submit" id="bapprove_batal" name="bapprove_batal"  onclick="doBTNBATAL()"
					class="btn btn-danger"  >
					<i class="fa fa-save"></i> Ditolak / Batal
				</button>	
				</div>				
			
			</div>
<!--			
			<div class="input-group pull-left" >
			    &nbsp;&nbsp;				
				<button  type="submit" id="bapprove_batal" name="bapprove_batal"  onclick="doBTNBATAL()"
					class="btn btn-danger"  >
					<i class="fa fa-save"></i> Ditolak / Batal
				</button>					
			</div>
!-->			
<!--			
			<div class="input-group pull-left" style=" left:10px;margin-top:-20px">	
					&nbsp;&nbsp;	
					<button  type="submit" id="bapprove_batal" name="bapprove_batal"  onclick="doBTNBATAL()"
						class="btn btn-danger"  >
						<i class="fa fa-save"></i> Ditolak / Batal
					</button>	
					
				</div>	
!-->

<!--					
			<button id="bprin" onclick="doPDF()" type="button" class="btn btn-default">
				<i class="fa fa-print"></i> PDF
			</button>
!-->	
		   <div class="input-group pull-right"  style=" margin-right:50px">					
				<button id="bprin" onclick="doBTNPRINT()" type="button" class="btn btn-default">
					<i class="fa fa-print"></i> Print
				</button>
				<button id="bclose" type="button" class="btn btn-danger"   data-dismiss="modal">
					<i class="fa fa-close"></i> Close
				</button> 
			</div>


	



		  </div>
		  
		  <br />
		  
      </div>
   

    </div>

  </div>

</div>

</div> <!-- printThis !-->



<style>

@media screen {

	#printSection {
	  	display: none;
	}
	
	.xbtn-primary {
		background:  #0099FF !important;
	
	}

	.xbtn-secondary {
		background: #999999   !important;
	}

	.xbtn-secondary2 {
		background: #666666   !important;
		color:#FFFFFF  !important ;
	}

	.xbtn-secondary3 {
		background: #CCCCCC   !important;
	}
	
	.xtable {
		font-size:16px  !important;
		line-height:40px !important;
	}

	input[type=checkbox]
	{
	  /* Double-sized Checkboxes */
	  -ms-transform: scale(2); /* IE */
	  -moz-transform: scale(2); /* FF */
	  -webkit-transform: scale(2); /* Safari and Chrome */
	  -o-transform: scale(2); /* Opera */
	  padding: 10px;
	}

    
}



@media print {

	.hidden-print {
		display: none !important;
	}
	
	.tabel-print {
		display: block !important;
	}
	
	body * {
		visibility:hidden;
	}
	#printSection, #printSection * {
		visibility:visible;
	}
	#printSection {
		position:absolute;
		left:0;
		top:0;
	}
	
	.xtable {
		font-size:16px;
	}
	
	.select2-selection__rendered {

		line-height: 12px !important;
		
	}
	
	.select2-selection {
		height: 20px !important; 
	
	}

	.form-control {
		line-height: 12px !important;
		height: 20px !important; 
	
	}

	.form-textarea {
		line-height: 30px !important;*/
		/*height: 30px !important; */
	
	}	
	
	.xbtn-primary {
		background:  #0099FF !important;
	}


	.xbtn-secondary {
		background: #999999   !important;
	}

	.xbtn-secondary2 {
		background: #666666   !important;
		color:#FFFFFF  !important ;
	}

	.xbtn-secondary3 {
		background: #CCCCCC  !important;
	}


		


  
}
</style>


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
