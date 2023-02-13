<?php 

   session_start();
   
   $kar_id     = $_SESSION['kar'] ;
  
				   
?>


<div id="printThis">
<div class="modal fade"  id="modal-update-user"  role="dialog"     
		aria-labelledby="myModalLabel" aria-hidden="true"   
        style="overflow-y: scroll; max-height:100%;  margin-top: 0px; margin-bottom:0px;" >   	

  <div class="modal-dialog modal-lg">

    <div class="modal-content">

      <div class="modal-header bg-primary">
        <button type="button" class="close hidden-print" data-dismiss="modal" aria-label="Close">
		<span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel"><i class="fa fa-bar-chart"></i> Form Permintaan Tenaga Kerja</h4>
      </div>

      
      <div class="modal-body" style="margin-top:-25px">
	  <?php
			
			date_default_timezone_set('Asia/Jakarta'); 
			foreach($_REQUEST as $name=>$value){
				$$name=$value;
				//echo "$name : $value;<br />\n";
			}	  
			include "rev_data_action.php"; 
			
			//$range_now 	= date('01/m/Y') . ' - ' . date('d/m/Y');
			
			$range_now 	=  date('Y-m-d');
	 		
			//$xdata = __list_karyawan($id);  
			$xdata = __list_pelamar($id);  
			///////////////////////////////////////////////////////////
			//echo  $num_rev;	
			$cek_proses = $xdata[0]['status_proses'];
			if ($cek_proses == "" || $cek_proses == "New" || $cek_proses == "Proses" ){
			   $cek_proses = "-";
			}
			if ($cek_proses == "Diterima"){
			   $cek_proses  = $xdata[0]['status_proses'];
			   $cek_proses .=' dan Mulai Kerja Tgl : '.date('d-m-Y',strtotime($xdata[0]['tgl_kerja']));
			}	
			
			$xREQUIRED = "required" ;
			if ($aksi == "save_adddata_review" and $act =="add" ){
			   $xREQUIRED = "";
			}
			
			$xDISPLAY = "block";
		
			if ($kar_id == 499 || $kar_id == 551 || $kar_id == 542 || $kar_id == 37 ){
			  ////////admin atau sdm////////////// 
			}else{
			    $xDISPLAY = "none";
			}
			
			$cek_pemohon_id = $xdata[0]['pemohon_id'];

			//echo '<br>kar_id:'.$_SESSION['kar']; 
			//echo '<br>pemohon:'. $xdata[0]['pemohon_id'];
	
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
				<th colspan="5" ><div align="center" style="font-size:20">PT. Gilland Ganesha</div></th>
			  </tr>
			  <tr>
				<th class="xbtn-secondary2 "  colspan="5">
				<div  class="xbtn-secondary2 " style=" text-align:center ;  font-size:20">
				FORMULIR PERMINTAAN TENAGA KERJA</div>				</th>
			  </tr>
			  <tr>
			   <th class="xbtn-secondary3 " colspan="6" 
			   style=" text-align:center;padding-right: 5px; padding-left: 5px;" >
			   	 Kebutuhan Tenaga Kerja			   
				 </th>
			  </tr>					  
			  <tr>
			   <td colspan="2" style="padding-right: 5px; padding-left: 5px;" >Jabatan / Posisi</td>
			   <th colspan="4" style="padding-right: 5px; padding-left: 5px;" >
			     <div id="div1_jbt_id" class="hidden-print" >
				 <select  class="form-control myselect"  data-width="100%" 
				 	 id="jbt_id" name="jbt_id" data-live-search="true"  <?php echo $xREQUIRED;?> >
					 <option value=""  >...</option>
						<?php
						
						   $cek_jbt_id = $xdata[0]['jbt_id'];
						   $json_jbt = __list_jabatan();   
						   for($a=0; $a < count($json_jbt); $a++) {
							   $v_id  	= $json_jbt[$a]['jbt_id'] ;
							   $v_nama  = $json_jbt[$a]['jbt_nm'] ;
							   if ($cek_jbt_id == $v_id){
									 echo ' <option  value="'.$v_id.'" selected >'.$v_nama.'</option>';	
							   }else{
									 echo ' <option  value="'.$v_id.'"  >'.$v_nama.'</option>';	
						
							   }						 
						   }
							
						?>
			  	</select>
				</div>	
				<div id="div2_jbt_id"></div >
			  </th>
			  </tr>	
			  <tr>
			   <td colspan="2" style="padding-right: 5px; padding-left: 5px;" >Divisi</td>
			   <th colspan="4" style="padding-right: 5px; padding-left: 5px;" >
			    <div id="div1_div_id" class="hidden-print" >
			        <select  class="form-control myselect "   data-width="100%" 
				 	 id="div_id" name="div_id" data-live-search="true"  <?php echo $xREQUIRED;?> >
                      <option value=""  >...</option>
                      <?php
						
						   $cek_div_id = $xdata[0]['div_id'];
						   $json_div = __list_divisi();   
						   for($a=0; $a < count($json_div); $a++) {
							   $v_id    = $json_div[$a]['div_id'] ;
							   $v_nama  = $json_div[$a]['div_nm'] ;
							   if ($cek_div_id == $v_id){
									 echo ' <option  value="'.$v_id.'" selected >'.$v_nama.'</option>';	
							   }else{
									 echo ' <option  value="'.$v_id.'"  >'.$v_nama.'</option>';	
						
							   }						 
						   }
							
						?>
                    </select>
					</div>	
					<div id="div2_div_id"></div >					
				   </th>
			  </tr>				  
			  <tr>
			   <td colspan="2" style="padding-right: 5px; padding-left: 5px;" >Level</td>
			   <th colspan="4" style="padding-right: 5px; padding-left: 5px;" >
			       <div id="div1_lvl_id" class="hidden-print" >
					<select  class="form-control myselect "  data-width="100%" 
				 	 id="lvl_id" name="lvl_id" data-live-search="true"  <?php echo $xREQUIRED;?> >
                      <option value=""  >...</option>
                      <?php
						
						   $cek_lvl_id = $xdata[0]['lvl_id'];
						   $json_lvl = __list_level();   
						   for($a=0; $a < count($json_lvl); $a++) {
							   $v_id    = $json_lvl[$a]['lvl_id'] ;
							   $v_nama  = $json_lvl[$a]['lvl_nm'] ;
							   if ($cek_lvl_id == $v_id){
									 echo ' <option  value="'.$v_id.'" selected >'.$v_nama.'</option>';	
							   }else{
									 echo ' <option  value="'.$v_id.'"  >'.$v_nama.'</option>';	
						
							   }						 
						   }
							
						?>
                    </select>	
					
					</div>	
					<div id="div2_lvl_id"></div >										   
			   </th>
			  </tr>				  
			  <tr>
			   <td colspan="2" style="padding-right: 5px; padding-left: 5px;" >Unit Kerja</td>
			   <th colspan="4" style="padding-right: 5px; padding-left: 5px;" >
			     <div id="div1_unt_id" class="hidden-print" >
				 <select  class="form-control myselect"   data-width="100%" 
				 	 id="unt_id" name="unt_id" data-live-search="true"  <?php echo $xREQUIRED;?> >
					 <option value=""  >...</option>
						<?php
						
						   $cek_unit_id = $xdata[0]['unt_id'];
						   $json_unit = __list_unit_kerja($id); 
						   for($a=0; $a < count($json_unit); $a++) {
							   $v_id  = $json_unit[$a]['unt_id'] ;
							   $v_nama  = $json_unit[$a]['unt_nm'] ;
							   if ($cek_unit_id == $v_id){
									 echo ' <option  value="'.$v_id.'" selected >'.$v_nama.'</option>';	
							   }else{
									 echo ' <option  value="'.$v_id.'"  >'.$v_nama.'</option>';	
						
							   }						 
						   }
							
						?>
				</select>	
					
					</div>	
					<div id="div2_unt_id"></div >		
									
				  </th>
			  </tr>				  
			  <tr>
			   <td colspan="2" style="padding-right: 5px; padding-left: 5px;" >Lokasi Kerja</td>
			   <th colspan="4" style="padding-right: 5px; padding-left: 5px;" >
			    <div id="div1_ktr_id" class="hidden-print" >
				 <select  class="form-control myselect"   data-width="100%"  
				 	 id="ktr_id" name="ktr_id" data-live-search="true"   <?php echo $xREQUIRED;?> >
					 <option value=""  >...</option>
						<?php
      				
						   $cek_ktr_id = $xdata[0]['ktr_id'];
						   $json_ktr = __list_kantor();   
						   for($a=0; $a < count($json_ktr); $a++) {
							   $v_id    = $json_ktr[$a]['ktr_id'] ;
							   $v_nama  = $json_ktr[$a]['ktr_nm'] ;
							   if ($cek_ktr_id == $v_id){
									 echo ' <option  value="'.$v_id.'" selected >'.$v_nama.'</option>';	
							   }else{
									 echo ' <option  value="'.$v_id.'"  >'.$v_nama.'</option>';	
						
							   }						 
						   }
						   
						?>
						
				</select>					   
			   
					
					</div>	
					<div id="div2_ktr_id"></div >					   
			   
			   </th>
			  </tr>	

			  <tr>
			   <td colspan="2" style="padding-right: 5px; padding-left: 5px;" >Jumlah Kebutuhan</td>
			   <th colspan="4" style="padding-right: 5px; padding-left: 5px;" >
			    <div id="div1_jumlah" class="hidden-print" >
				 <select  class="form-control myselect"    data-width="100%" 
				 	 id="jumlah" name="jumlah" data-live-search="true"   <?php echo $xREQUIRED;?> >
					 <option value="0"  >0</option>
						<?php
						
						   $cek_jumlah= $xdata[0]['jumlah'];
						   for($a = 0; $a <= 20; $a++) {
							   $v_id  	= $a ;
							   $v_nama  = $a ;
							   if ($cek_jumlah == $v_id){
									 echo ' <option  value="'.$v_id.'" selected >'.$v_nama.'</option>';	
							   }else{
									 echo ' <option  value="'.$v_id.'"  >'.$v_nama.'</option>';	
						
							   }						 
						   }
							
						?>
				</select>					   
					
					</div>	
					<div id="div2_jumlah"></div >			
					
			   </th>
			  </tr>	

			  <tr>
			   <td colspan="2" style="padding-right: 5px; padding-left: 5px;" >Status Pegawai</td>
			   <th colspan="4" style="padding-right: 5px; padding-left: 5px;" >
			   
			     <div id="div1_status_pegawai" class="hidden-print" >
				 <select  class="form-control myselect"    data-width="100%" 
				 	 id="status_pegawai" name="status_pegawai" data-live-search="true"   <?php echo $xREQUIRED;?> >
					   <!-- <option value=""  >...</option> !-->
						<?php
						
						   $cek_status = $xdata[0]['status_pegawai'];
						   for($a = 1; $a <= 4; $a++) {
							   if ($a==1){ 
							     $v_nama = "Kontrak";
							   }elseif($a==2){
							      $v_nama = "Tetap";
							   }elseif($a==3){
							      $v_nama = "Freelance";
							   }elseif($a==4){
							      $v_nama = "Magang";
							   }
							   if ($cek_status == $v_nama){
									 echo ' <option  value="'.$v_nama.'" selected >'.$v_nama.'</option>';	
							   }else{
									 echo ' <option  value="'.$v_nama.'"  >'.$v_nama.'</option>';	
						
							   }						 
						   }
							
						?>
				</select>							   

					</div>	
					<div id="div2_status_pegawai"></div >			

			   </th>
			  </tr>	

			  <tr>
			   <td colspan="2" style="padding-right: 5px; padding-left: 5px;" >Tanggal Mulai Kerja</td>
			   <th colspan="4" style="padding-right: 5px; padding-left: 5px;" >
			     <div id="div1_tgl_kerja" class="input-group hidden-print" >
					<input type="text" class="form-control dp"   style=" font:bold " 
						name="tgl_kerja" id="tgl_kerja"  data-width="100%"    
						title="Filter" value="<?php echo $range_now;?> " placeholder="Input Date... " 
						 <?php echo $xREQUIRED;?> > 
 			     
			     </div>
				<div id="div2_tgl_kerja"></div >					 
			   </th>
			  </tr>	

			  <tr>
			   <th class="xbtn-secondary3 " colspan="6" 
			   style=" text-align:center;padding-right: 5px; padding-left: 5px;" >
			   	Jabatan Tenaga Kerja			   </th>
			  </tr>					  
			  <tr>
			   <td colspan="2" style="padding-right: 5px; padding-left: 5px;" >Uraian Jabatan</td>
			   <th colspan="4" style="padding-right: 5px; padding-left: 5px;" >
			     <div id="div1_uraian_jabatan" class="input-group hidden-print" style="width:100%"  >			   
					<textarea class="form-textarea" style="width:100%" id="uraian_jabatan"  name="uraian_jabatan" rows="1"  placeholder="Uraian Jabatan ..."><?php echo $xdata[0]['uraian_jabatan'];?></textarea> 

			     </div>
				<div id="div2_uraian_jabatan"></div >	
				
			   </th>
			  </tr>	


			  <tr>
			   <th class="xbtn-secondary3 " colspan="6" 
			   style=" text-align:center;padding-right: 5px; padding-left: 5px;" >
			   	Kualifikasi Tenaga Kerja			   </th>
			  </tr>		

<!--			  
			  <tr>
			   <td colspan="2" style="padding-right: 5px; padding-left: 5px;" >Nama</td>
			   <th colspan="4" style="padding-right: 5px; padding-left: 5px;" >
			      <div id="div1_nama" class="input-group hidden-print" style="width:100%"  >
					<input type="text" class="input-group" style=" width:100%; height:30px" 
					 id="nama" name="nama"  
					 value="<?php //echo $xdata[0]['nama']; ?>" placeholder="..." required>
				  </div>
				  <div id="div2_nama"></div >						   
			   </th>
			  </tr>				  
!-->			  
			  
			  			  
			  <tr>
			   <td colspan="2" style="padding-right: 5px; padding-left: 5px;" >Jenis Kelamin</td>
			   <th colspan="4" style="padding-right: 5px; padding-left: 5px;" >
			    <div id="div1_jenis_kelamin" class="hidden-print" >
				 <select  class="form-control myselect"    data-width="100%" 
				 	 id="jenis_kelamin" name="jenis_kelamin" data-live-search="true"  <?php echo $xREQUIRED;?> >
						<?php
						
						   $cek_kelamin = $xdata[0]['jenis_kelamin'];
						   for($a = 1; $a <= 2; $a++) {
							   if ($a==1){ 
							     $v_nama = "Pria";
							   }else{
							      $v_nama = "Wanita";
							   }
							   if ($cek_kelamin == $v_nama){
									 echo ' <option  value="'.$v_nama.'" selected >'.$v_nama.'</option>';	
							   }else{
									 echo ' <option  value="'.$v_nama.'"  >'.$v_nama.'</option>';	
						
							   }						 
						   }
							
						?>
				</select>
			     </div>
				<div id="div2_jenis_kelamin"></div >									   
			   </th>
			  </tr>	
			  <tr>
			   <td colspan="2" style="padding-right: 5px; padding-left: 5px;" >Usia</td>
			   <th colspan="4" style="padding-right: 5px; padding-left: 5px; " >
			    <div id="div1_usia" class="hidden-print" >
			     <?php
				    
				    if ($xdata[0]['usia'] == 0 || $xdata[0]['usia'] == ""){
					   $xdata[0]['usia']  = 20  ;
					}
				 ?>
				 <input type="number" class="form-control" id="usia" name="usia"
				  value="<?php echo $xdata[0]['usia']; ?>" placeholder="Usia  .... "  <?php echo $xREQUIRED;?> >
			     </div>
				<div id="div2_usia"></div >							  
			   </th>
			  </tr>				  
			  <tr>
			   <td colspan="2" style="padding-right: 5px; padding-left: 5px;" >Status Pernikahan</td>
			   <th colspan="4" style="padding-right: 5px; padding-left: 5px;" >
			    <div id="div1_status_nikah" class="hidden-print" >
				 <select  class="form-control myselect"    data-width="100%" 
				 	 id="status_nikah" name="status_nikah" data-live-search="true"   <?php echo $xREQUIRED;?> >
						<?php
						
						   $cek_status_nikah = $xdata[0]['status_nikah'];
						   for($a = 1; $a <= 2; $a++) {
							   if ($a==1){ 
							     $v_nama = "Belum Menikah";
							   }else{
							      $v_nama = "Menikah";
							   }
							   if ($cek_status_nikah == $v_nama){
									 echo ' <option  value="'.$v_nama.'" selected >'.$v_nama.'</option>';	
							   }else{
									 echo ' <option  value="'.$v_nama.'"  >'.$v_nama.'</option>';	
						
							   }						 
						   }
							
						?>
				</select>
				
			     </div>
				<div id="div2_status_nikah"></div >												   
			   </th>
			  </tr>				  
			  <tr>
			   <td colspan="2" style="padding-right: 5px; padding-left: 5px;" >Pendidikan Minimal</td>
			   <th colspan="4" style="padding-right: 5px; padding-left: 5px;" >
			    <div id="div1_pendidikan" class="hidden-print" >
				 <select  class="form-control myselect"    data-width="100%" 
				 	 id="pendidikan" name="pendidikan" data-live-search="true"   <?php echo $xREQUIRED;?> >
						<?php
						
						   $cek_pendidikan = $xdata[0]['pendidikan'];
						   for($a = 1; $a <= 7; $a++) {
							   if ($a==1){ 
							     $v_nama = "SMP";
							   }elseif($a==2){
							   	 $v_nama = "SMA/SMK";
							   }elseif($a==3){
							   	 $v_nama = "D1";
							   }elseif($a==4){
							   	 $v_nama = "D2";
							   }elseif($a==5){
							   	 $v_nama = "D3";								 								 
							   }elseif($a==6){
							   	 $v_nama = "S1";
							   }elseif($a==7){
							   	 $v_nama = "S2";
							   }
							   if ($cek_pendidikan == $v_nama){
									 echo ' <option  value="'.$v_nama.'" selected >'.$v_nama.'</option>';	
							   }else{
									 echo ' <option  value="'.$v_nama.'"  >'.$v_nama.'</option>';	
						
							   }						 
						   }
							
						?>
				</select>	
			     </div>
				<div id="div2_pendidikan"></div >											   
			   </th>
			  </tr>				  
			  <tr>
			   <td colspan="2" style="padding-right: 5px; padding-left: 5px;" >Pengalamam</td>
			   <th colspan="4" style="padding-right: 5px; padding-left: 5px;" >
			   
				  <div id="div1_pengalaman_kerja" class="hidden-print" >		    
				 <select  class="form-control myselect"    data-width="100%" 
				 	 id="pengalaman_kerja" name="pengalaman_kerja" data-live-search="true"   <?php echo $xREQUIRED;?> >
						<?php
						
						   $cek_pengalaman = $xdata[0]['pengalaman_kerja'];
						   for($a = 1; $a <= 2; $a++) {
							   if ($a==1){ 
							      $v_id   = 0;
							      $v_nama = "Fresh Graduate - Pengalaman 0 - 1 tahun";
							   }else{
							      $v_id   = 1;
							      $v_nama = " Pengalaman  lebih dari 1 tahun";
							   }
							   if ($cek_pengalaman == $v_id){
									 echo ' <option  value="'.$v_id.'" selected >'.$v_nama.'</option>';	
							   }else{
									 echo ' <option  value="'.$v_id.'"  >'.$v_nama.'</option>';	
						
							   }						 
						   }
							
						?>
				</select>
			     </div>
				<div id="div2_pengalaman_kerja"></div >								   
			   </th>
			  </tr>	


			  <tr>
			   <td colspan="2" style="padding-right: 5px; padding-left: 5px;" >Kemampuan Lainnya</td>
			   <th colspan="4" style="padding-right: 5px; padding-left: 5px;" >
			     <div id="div1_kemampuan_lain" class="input-group hidden-print" style="width:100%"  >
					<textarea class="form-textarea" style="width:100%" id="kemampuan_lain" name="kemampuan_lain" rows="1" placeholder="Kemampuan Lain ... "><?php echo $xdata[0]['kemampuan_lain'];?></textarea> 
				 </div>
					<div id="div2_kemampuan_lain"></div >							   
			   </th>
			  </tr>	

			  <tr>
			   <th class="xbtn-secondary3 " colspan="6" 
			   style=" text-align:center;padding-right: 5px; padding-left: 5px;" >
			   	Alasan Permintaan Tenaga Kerja			   
				</th>
			  </tr>		
			  			  
			  <tr>
			   <td colspan="2" style="padding-right: 5px; padding-left: 5px;" >Alasan</td>
			   <th colspan="4" style="padding-right: 5px; padding-left: 5px;" >
			      <div id="div1_alasan" class="input-group hidden-print" style="width:100%"  >
					<textarea class="form-textarea" style="width:100%"  id="alasan" name="alasan" rows="1" placeholder="Alasan Permintaan Tenaga Kerja ..."><?php echo $xdata[0]['alasan'];?></textarea> 
					</div>
					<div id="div2_alasan"></div >						   
			   </th>
			  </tr>	

			  <tr>
			   <th class="xbtn-secondary3 " colspan="6" 
			   style=" text-align:center;padding-right: 5px; padding-left: 5px;" >
			   	Pemohon
			  </th>
			  </tr>					  
			  <tr>
			   <td colspan="2" style="padding-right: 5px; padding-left: 5px;" >Nama</td>
			   <th colspan="4" style="padding-right: 5px; padding-left: 5px;" >
			    <div id="div1_pemohon_id" class="hidden-print" style="display:<?php echo $xDISPLAY;?>"   >		
				 <select  class="form-control myselect"  data-width="100%" 
				     onchange="doMyKaryawan(this)"
				 	 id="pemohon_id" name="pemohon_id" data-live-search="true"  required  >
					 <option value=""  >...</option>
						<?php
						
						
						   
						   $cek_pemohon_id = $xdata[0]['pemohon_id'];
						   //////////////////////////////////////////////////
						   $xdata_pemohon = __list_karyawan($cek_pemohon_id);
						   //////////////////////////////////////////////////  
						   $json_pemohon = __list_karyawan_all();   
						   for($a=0; $a < count($json_pemohon); $a++) {
							   $v_id  	   	= $json_pemohon[$a]['kar_id'] ;
							   $v_jbt_id   	= $json_pemohon[$a]['jbt_id'] ;
							   $v_div_id   	= $json_pemohon[$a]['div_id'] ;
							   /////////////////////////////////
							   $v_jbt      	= $json_pemohon[$a]['jbt_nm'] ;
							   $v_jbt2     	= $json_pemohon[$a]['lvl_nm'] ;

							   $v_divisi   	= $json_pemohon[$a]['div_nm'] ;
							   $v_nama      = $json_pemohon[$a]['kar_nm'] ;
							   $v_nama2     = $json_pemohon[$a]['kar_nm'].' [ '.$json_pemohon[$a]['jbt_nm'].' ] ' ;
							   ///////////////////////////////// 
							   $v_data  	= $v_id."#".$v_jbt."#".$v_divisi."#".$v_jbt_id."#".$v_div_id; 	
							   //$v_jbt       = $json_pemohon[$a]['jbt_nm'];
							   $v_jbt       = $json_pemohon[$a]['lvl_nm'];
							   $pos = strpos($v_jbt, "Manager");
							   if ($pos !== false ) {
								   if ($cek_pemohon_id == $v_id){
										 echo ' <option  value="'.$v_data.'" selected >'.$v_nama.'</option>';	
								   }else{
										 echo ' <option  value="'.$v_data.'"  >'.$v_nama.'</option>';	
							
								   }
							    }
							  /////////////////////////////////////////		   						 
						   }
							
						?>
			  	</select>				   
					</div>
					<div id="div2_pemohon_id"></div >						   
			   </th>
			  </tr>	

			  <tr>
			   <td colspan="2" style="padding-right: 5px; padding-left: 5px;" >Jabatan</td>
			   <th colspan="4" style="padding-right: 5px; padding-left: 5px;" >
		       <div id="div1_pemohon_jbt" class="hidden-print" >	
			   		<input type="hidden" class="form-control" id="pemohon_kar_id" name="pemohon_kar_id" 
					 value="<?php echo  $cek_pemohon_id ;?>"> 
					<input type="hidden" class="form-control" id="pemohon_jbt_id" name="pemohon_jbt_id" 
					 value="<?php echo $xdata_pemohon[0]['jbt_id'] ;?>" > 
					<input type="hidden" class="form-control" id="pemohon_div_id" name="pemohon_div_id"
					  value="<?php echo $xdata_pemohon[0]['div_id'] ;?>" > 
					 	
				    <input type="text" class="form-control" id="pemohon_jbt" name="pemohon_jbt" 
					 value="<?php echo $xdata_pemohon[0]['jbt_nm'] ;?>"
					placeholder="Jabatan"  readonly="" >
					
					</div>
					<div id="div2_pemohon_jbt"></div > 						  			   
			   </th>
			  </tr>	

			  <tr>
			   <td colspan="2" style="padding-right: 5px; padding-left: 5px;" >Divisi</td>
			   <th colspan="4" style="padding-right: 5px; padding-left: 5px;" >
			     <div id="div1_pemohon_div" class="hidden-print" >
				    <input type="text" class="form-control" id="pemohon_div" name="pemohon_div"
					value="<?php echo $xdata_pemohon[0]['div_nm'] ;?>" 
					placeholder="Divisi"  readonly="" >  
					
					</div>
					<div id="div2_pemohon_div"></div >												   
			   </th>
			  </tr>	

			  <tr>
			   <th class="xbtn-secondary3 " colspan="6"  
			   style=" text-align:center;padding-right: 5px; padding-left: 5px;" >
			   	Pengesahan			
				   </th>
			  </tr>		




			  		  
			  <tr>
			   <td colspan="2" width="200px" style="padding-right: 5px; padding-left: 5px;" > 
			      <div style=" line-height:20px">
				   <br />
			       Cibinong , <?php echo date('d-m-Y') ;?> 
				   <br />
				   Pemohon 
				   <br />
				   <br />
				  
			  <div id="div1_manager_id" class="hidden-print" style="display:<?php echo $xDISPLAY;?>" >	
				 <select  class="form-control myselect"  data-width="200px" 
				     onchange="doMyUser(this)"
				      id="manager_id" name="manager_id" data-live-search="true" required >
					 <option value=""  >...</option>
						<?php
					
						   $cek_manager_id = $xdata[0]['manager_id'];
						   ////////////////////////////////////////////////////
						   $xdata_manager = __list_karyawan($cek_manager_id);
						   ////////////////////////////////////////////////////
						   $cek_manager_nama = $xdata[0]['manager_nama'];
						   $json_pemohon = __list_karyawan_all();   
						   for($a=0; $a < count($json_pemohon); $a++) {
							   $v_id  	    = $json_pemohon[$a]['kar_id'] ;
 						     $v_nama      = $json_pemohon[$a]['kar_nm'] ;
							   $v_jbt       = $json_pemohon[$a]['jbt_nm'];
							   $v_jbt2      = $json_pemohon[$a]['lvl_nm'];
							   $pos 			  = strpos($v_jbt2, "Manager");
							   $v_data  	  = $v_id."#".$v_nama; 	
							   if ($pos !== false ) {
								   if ($cek_manager_id == $v_id){
										 echo ' <option  value="'.$v_data.'" selected >'.$v_nama.'</option>';	
								   }else{
										 echo ' <option  value="'.$v_data.'"  >'.$v_nama.' / '.$v_jbt.'</option>';	
							
								   }
							  }  	   						 
						   }
						
						?>
			  	</select>
		   		 	<input type="hidden" class="form-control" id="manager_kar_id" name="manager_kar_id" 
						 value="<?php echo  $cek_manager_id ;?>"> 
					 
				</div>
				<br />	
				<br />
				<br />	
				<?php
					 $cek_approve_1 = $xdata[0]['manager_approval']; 
					 $lbl_check1 = "";
					 if ($cek_approve_1 == 1){
					   $lbl_check1 = "<i class='fa fa-check fa-2x text-green'></i>";
					 }
				?>
				<b>
				<u id="manager_nama">
					<?php echo $xdata_manager[0]['kar_nm'] ;?></u><br />Manager
				</b>				  
				</div>
				<?php  if ($cek_approve_1 == 1){ 	?>  
					<div style="margin-top:-40px; margin-left:150px ">
					   <?php echo $lbl_check1 ;?>
					</div>
				<?php } ?>	
				</td>
				
			   <td colspan="2" width="200px" style="padding-right: 5px; padding-left: 5px;" >
			     <div style=" line-height:20px">
					&nbsp;
					<br />
					Disetujui
					<br />
					<br />

			  <div id="div1_dirmud_id" class="hidden-print" style="display:<?php echo $xDISPLAY;?>" >	
				 <select  class="form-control myselect"  data-width="200px" 
				     onchange="doMyUserSetuju1(this)"
				      id="disetujui_dirmudirmud_id" name="dirmud_id" data-live-search="true" required >
					 <option value=""  >...</option>
						<?php
					
						   $cek_dirmud_id = $xdata[0]['dirmud_id'];
						   ////////////////////////////////////////////////////
						   $xdata_dirmud = __list_karyawan($cek_dirmud_id);
						   ////////////////////////////////////////////////////						   
						   $cek_dirmud = $xdata[0]['disetujui_dirmud'];
						   $json_dirmud = __list_karyawan_all();     
						   for($a=0; $a < count($json_dirmud); $a++) {
							   $v_id  	  = $json_dirmud[$a]['kar_id'] ;
 						     $v_nama    = $json_dirmud[$a]['kar_nm'] ;
 						     $v_nama    = $json_pemohon[$a]['kar_nm'] ;
							   $v_jbt     = $json_pemohon[$a]['jbt_nm'];
							   $v_data  	= $v_id."#".$v_nama; 	
							   //$pos 		= strpos($v_jbt, "Direktur Muda");
							   $pos1 = strpos($v_jbt, "Manager");
							   $pos2 = strpos($v_jbt, "Direktur");
							   if ($pos1 !== false || $pos2 !== false) {
								   if ($cek_dirmud_id == $v_id){
										 echo ' <option  value="'.$v_data.'" selected >'.$v_nama.'</option>';	
								   }else{
										 echo ' <option  value="'.$v_data.'"  >'.$v_nama.' / '.$v_jbt.'</option>';	
							
								   }
							   }  	   	
							  					 
						   }
						
						?>
			  	</select>
		   		 	<input type="hidden" class="form-control" id="dirmud_kar_id" name="dirmud_kar_id" 
						 value="<?php echo  $cek_dirmud_id ;?>"> 				
				</div>
			    <?php
					 $cek_approve_2 = $xdata[0]['dirmud_approval']; 
					 $lbl_check2 = "";
					 if ($cek_approve_2 == 1){
					    $lbl_check2 = "<i class='fa fa-check fa-2x text-green'></i>";
					 }
				?>	
					  				
					1. <b><u  id="dirmud_nama"><?php echo $xdata_dirmud[0]['kar_nm'] ;?></u><br />
					&nbsp;&nbsp;&nbsp;&nbsp;Dirmud Divisi</b>
					<br />
					&nbsp;
			  <?php  if ($cek_approve_2 == 1){ 	?>
				  <div style="margin-top:-60px; margin-left:180px ">
					   <?php echo $lbl_check2 ;?>
				  </div>	
			  <?php } ?>
			  			  			   
			  	<br />
			  <div id="div1_direktur_id" class="hidden-print" style="display:<?php echo $xDISPLAY;?>"  >	
				 <select  class="form-control myselect"  data-width="200px" 
				     onchange="doMyUserSetuju2(this)"
				      id="direktur_id" name="direktur_id" data-live-search="true" required >
					 <option value=""  >...</option>
						<?php
					
						   $cek_diretur_id= $xdata[0]['direktur_id'];
						   ////////////////////////////////////////////////////
						   $xdata_direktur = __list_karyawan($cek_diretur_id);
						   ////////////////////////////////////////////////////									   
						   $cek_manager_direktur = $xdata[0]['disetujui_direktur'];
						   $json_direktur = __list_karyawan_all();     
						   for($a=0; $a < count($json_direktur); $a++) {
							   $v_id  	   = $json_direktur[$a]['kar_id'] ;
 						       $v_nama      = $json_direktur[$a]['kar_nm'] ;
							   $v_jbt       = $json_pemohon[$a]['jbt_nm'];
							   $v_data  	= $v_id."#".$v_nama; 	
							   $pos = strpos($v_jbt, "Direktur");
							   if ($pos !== false ) {
								   if ($cek_diretur_id == $v_id){
										 echo ' <option  value="'.$v_data.'" selected >'.$v_nama.'</option>';	
								   }else{
										 echo ' <option  value="'.$v_data.'"  >'.$v_nama.' / '.$v_jbt.'</option>';	
							
								   }
							  }  	
							     	
						   }
						
						?>
			  	</select>
		   		 	<input type="hidden" class="form-control" id="direktur_kar_id" name="direktur_kar_id" 
						 value="<?php echo  $cek_diretur_id ;?>"> 				
				
				</div>
			   <?php
					 $cek_approve_3 = $xdata[0]['direktur_approval']; 
					 $lbl_check3 = "";
					 if ($cek_approve_3 == 1){
					   $lbl_check3 = "<i class='fa fa-check fa-2x text-green'></i>";
					 }
				?>	
					2. <b><u  id="direktur_nama"><?php echo $xdata_direktur[0]['kar_nm'] ;?></u><br />
					&nbsp;&nbsp;&nbsp;&nbsp;Direktur Divisi</b>
					<br />	
				  </div>
			 <?php  if ($cek_approve_2 == 1){ 	?>  
				 <div style="margin-top:-40px; margin-left:180px ">
				   <?php echo $lbl_check3 ;?>
				 </div>	
			 <?php } ?>				  			   
			  </td>
			   <td colspan="2" width="200px" style="padding-right: 5px; padding-left: 5px; line-height:inherit" >
			       <div style=" line-height:20px">
					&nbsp;
					<br />
					Mengetahui
					<br />
					<br />
					1. <b><u>Yandi Yuniansah</u><br />
					&nbsp;&nbsp;&nbsp;&nbsp;Direktur Utama</b>
					<br />
					<br />
					2. <b><u>Sri Rahayu.</u><br />
					&nbsp;&nbsp;&nbsp;&nbsp;Direktur HRD</b>
					<br />	
				   </div>				
				   </td>
			  </tr>
			  <tr>
			    <th colspan="6" style="height:50px">
				  &nbsp; Keputusan : <?php echo $cek_proses; ?>
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
			
			<div class="input-group  pull-left" style="margin-left:300px">
			<button type="submit" id="bsave" name="bsave" class="btn btn-primary"  >
				<i class="fa fa-save"></i> Simpan 
			</button>
			</div>
	
	
			<div class="input-group pull-left">				
				<button type="submit" id="bapprove" name="bapprove"
					class="btn btn-primary"  >
					<i class="fa fa-save"></i> Approval / Setuju 
				</button>
			</div>
			<div class="input-group pull-left" style=" left:10px;margin-top:-20px">	
					&nbsp;&nbsp;	
					<button  type="submit" id="bapprove_batal" name="bapprove_batal"  onclick="doBTNBATAL()"
						class="btn btn-danger"  >
						<i class="fa fa-save"></i> Ditolak / Batal
					</button>	
					
				</div>	
						
			<button id="bprin" onclick="doBTNPRINT()" type="button" class="btn btn-default">
				<i class="fa fa-print"></i> Print
			</button>


<!--					
			<button id="bprin" onclick="doPDF()" type="button" class="btn btn-default">
				<i class="fa fa-print"></i> PDF
			</button>
!-->					
			&nbsp;&nbsp; 		
			<button id="bclose" type="button" class="btn btn-danger" data-dismiss="modal">
				<i class="fa fa-close"></i> Close
			</button> 
	
			
		  </div>
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

