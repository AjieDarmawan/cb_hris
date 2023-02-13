<style>
.loader_bola {
  border: 16px solid #f3f3f3; /* Light grey */
  border-top: 16px solid #3498db; /* Blue */
  border-radius: 50%;
  width: 100px;
  height: 100px;
  animation: spin 2s linear infinite;
}

@keyframes spin {
  0% { transform: rotate(0deg); }
  100% { transform: rotate(360deg); }
}
</style>


<!-- general form elements -->
              <div class="box box-success" tooltipPosition="auto" data-step="2" 
              data-intro="<strong>Absensi</strong> Merupakan fasilitas utama dalam aplikasi ini, cara kerjanya mudah dan simple<br>
              			  Kamu hanya menekan tombol <strong>Absen Masuk</strong> untuk melakukan absen masuk, tombol 
              			  <strong>Absen Pulang</strong> untuk melakukan absensi pulang, tapi nanti Kamu
              			  jangan kaget ya karena sistem yang kami buat bisa di bilang middle protection, dimana jika terjadi
              			  kesalahan seperti: <br><strong>Keterlabatan</strong>, <strong>Pulang kurang dari 8 jam kerja</strong>,  
              			  <strong>Login diluar Area kantor</strong>, dll <br>maka
              			  sistem secara otomatis akan memproteksi dan meragukan absensi Kamu, bila terjadi kesalahan seperti itu
              			  segera melakukan konfirmasi ke pihak SDM.">
                <div class="box-header">
                  <h3 class="box-title">Absensi <small><?php echo $tgl->tgl_indo($date);?></small></h3>
                  <!-- tools box -->
                  <div class="pull-right box-tools">
                  	<button class="btn btn-info btn-sm" data-widget='collapse' data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
                    <button class="btn btn-info btn-sm" data-widget='remove' data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
                  </div><!-- /. tools -->
                </div><!-- /.box-header -->
                <div class="box-header">
                
				<div class="col-sm-5">
                <form action="" method="post">
<!--				
				   <div id="loading"></div>
!-->				   
                	<?php
					$abs_tgl_masuk=$date;
					$abs_tampil_kar=$abs->abs_tampil_kar($kar_id,$abs_tgl_masuk);
					$data=mysql_fetch_array($abs_tampil_kar);
					$cek=mysql_num_rows($abs_tampil_kar);
					
					$kar_id = $data['kar_id'];
					
//////////////////////////////////////////////////////////////////////////////////////
					$sql_kar   = "SELECT kar_nik FROM kar_master WHERE kar_id='$kar_id' LIMIT 1 ";
					$q_kar 	   = mysql_query($sql_kar) ;
					$r_nik     = mysql_fetch_array($q_kar);
					$xnik       =  $r_nik['kar_nik']; 
					$nik       = str_replace(".","", $xnik);
					/////////////////////////////////////////////////////////////////////////////
					///////////////////////////////Target FU UNIT dan CS //////////////////////					
/*					
					$ch = curl_init();
					curl_setopt($ch, CURLOPT_URL,"daftarkuliah.my.id/bdc/x_crontab_activity.php");
					curl_setopt($ch, CURLOPT_POST, 1);
					curl_setopt($ch, CURLOPT_POSTFIELDS,"nik=$nik");
					curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
					$server_output = curl_exec($ch);
					curl_close ($ch);
					
					$json_data=json_decode($server_output,true);
					//$status_fu = $json_data[0]['status'];
					$status_fu = $json_data[1]['status'];
					//echo $status_fu;
*/
					//////////////////////////////////////////////////////////////////////////////					
					///////////////////////////////Target FU UntukPenagihan//////////////////////
				 	if ($kar_id==60 || $kar_id==118 || $kar_id==205 || $kar_id==269 || $kar_id==437 || $kar_id==518 )
					{
/*
						$url_tagih = "http://203.29.27.139/dev2/cronhistory_absen_fu/".$nik;
						//$filter = "nik=".$nik;
						$filter = "";
						$ch = curl_init();
						curl_setopt($ch, CURLOPT_URL,$url_tagih);
						curl_setopt($ch, CURLOPT_POST, 1);
						curl_setopt($ch, CURLOPT_POSTFIELDS,$filter);
						curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
						$server_output = curl_exec($ch);
						curl_close ($ch);
						$json_data=json_decode($server_output,true);
						$status_fu = $json_data[1]['status'];
						echo '<br>status:'.$status_fu;
*/
					}					
					/////////////////////////////////////////////////////////////////////////////////
					
					if($cek == 0){
						$waktu=$time;
						$t=explode(":",$waktu);
						if($t[0]=="00"){
							$jam="24";
						}else{
							$jam=$t[0];
						}
						$menit=$t[1];

						//NEW CHANGE
						$waktu_jam_menit=substr($time, 0,5);

						//Range Pagi
						$abs_stm_nm="Jam Telat Pagi";
						$abs_settime_id=$abs->abs_settime_id($abs_stm_nm);
						$abs_settime_data=mysql_fetch_array($abs_settime_id);
						if(!empty($kar_data['ktr_default_shift1_in']) && !empty($kar_data['ktr_default_shift1_out'])){
							if(!empty($kar_data['kar_default_shift1_in']) && !empty($kar_data['kar_default_shift1_out'])){
								$jam_telat_pagi=substr($kar_data['kar_default_shift1_in'], 0,5);
							}else{
								$jam_telat_pagi=substr($kar_data['ktr_default_shift1_in'], 0,5);
							}
						}else{
							if(!empty($kar_data['kar_default_shift1_in']) && !empty($kar_data['kar_default_shift1_out'])){
								$jam_telat_pagi=substr($kar_data['kar_default_shift1_in'], 0,5);
							}else{
								$jam_telat_pagi=substr($abs_settime_data['abs_stm_jam'], 0,5);
							}
						}						

						//Range Siang
						$abs_stm_nm="Jam Telat Siang";
						$abs_settime_id=$abs->abs_settime_id($abs_stm_nm);
						$abs_settime_data=mysql_fetch_array($abs_settime_id);
						if(!empty($kar_data['ktr_default_shift2_in']) && !empty($kar_data['ktr_default_shift2_out'])){
							if(!empty($kar_data['kar_default_shift2_in']) && !empty($kar_data['kar_default_shift2_out'])){
								$jam_telat_siang=substr($kar_data['kar_default_shift2_in'], 0,5);
							}else{
								$jam_telat_siang=substr($kar_data['ktr_default_shift2_in'], 0,5);
							}
						}else{
							if(!empty($kar_data['kar_default_shift2_in']) && !empty($kar_data['kar_default_shift2_out'])){
								$jam_telat_siang=substr($kar_data['kar_default_shift2_in'], 0,5);
							}else{
								$jam_telat_siang=substr($abs_settime_data['abs_stm_jam'], 0,5);
							}
						}

						//Range Sore
						$abs_stm_nm="Jam Telat Sore";
						$abs_settime_id=$abs->abs_settime_id($abs_stm_nm);
						$abs_settime_data=mysql_fetch_array($abs_settime_id);
						if(!empty($kar_data['ktr_default_shift3_in']) && !empty($kar_data['ktr_default_shift3_out'])){
							if(!empty($kar_data['kar_default_shift3_in']) && !empty($kar_data['kar_default_shift3_out'])){
								$jam_telat_sore=substr($kar_data['kar_default_shift3_in'], 0,5);
							}else{
								$jam_telat_sore=substr($kar_data['ktr_default_shift3_in'], 0,5);
							}
						}else{
							if(!empty($kar_data['kar_default_shift3_in']) && !empty($kar_data['kar_default_shift3_out'])){
								$jam_telat_sore=substr($kar_data['kar_default_shift3_in'], 0,5);
							}else{
								$jam_telat_sore=substr($abs_settime_data['abs_stm_jam'], 0,5);
							}
						}

						//Range Malam
						$abs_stm_nm="Jam Telat Malam";
						$abs_settime_id=$abs->abs_settime_id($abs_stm_nm);
						$abs_settime_data=mysql_fetch_array($abs_settime_id);
						if(!empty($kar_data['ktr_default_shift4_in']) && !empty($kar_data['ktr_default_shift4_out'])){
							if(!empty($kar_data['kar_default_shift4_in']) && !empty($kar_data['kar_default_shift4_out'])){
								$jam_telat_malam=substr($kar_data['kar_default_shift4_in'], 0,5);
							}else{
								$jam_telat_malam=substr($kar_data['ktr_default_shift4_in'], 0,5);
							}
						}else{
							if(!empty($kar_data['kar_default_shift4_in']) && !empty($kar_data['kar_default_shift4_out'])){
								$jam_telat_malam=substr($kar_data['kar_default_shift4_in'], 0,5);
							}else{
								$jam_telat_malam=substr($abs_settime_data['abs_stm_jam'], 0,5);
							}
						}


						if ($jam > 00 and $jam < 10 ){
							if ($menit >00 and $menit<60){
							$ucapan="Shift Pagi";
							$checked_pagi="checked";
								if($waktu_jam_menit > $jam_telat_pagi){
									$type="button";
									$name="";
									$toggle="modal";
									//$target="#masuk_telat";
									
									$target="#masuk";
									$dispaly="";
									$title_rajin="display:none";
									$title_telat="";

									//Tampil selisih terlambat
									$start_date = new DateTime(''.$date.' '.$jam_telat_pagi.'');
									$since_start = $start_date->diff(new DateTime(''.$date.' '.$time.''));
									if($since_start->h > 0){
										$jam_telat=$since_start->h." Jam ".$since_start->i." Menit ".$since_start->s." Detik ";
									}else{
										$jam_telat=$since_start->i." Menit ".$since_start->s." Detik ";
									}
										

								}
								else{
									$type="button";
									$name="";
									$toggle="modal";
									$target="#masuk";
									
									$dispaly="display:none";
									$title_rajin="";
									$title_telat="display:none";
								}
							}
						}else if ($jam >= 10 and $jam < 13 ){
							if ($menit >00 and $menit<60){
							$ucapan="Shift Siang";
							$checked_siang="checked";
								if($waktu_jam_menit > $jam_telat_siang){
									$type="button";
									$name="";
									$toggle="modal";
									//$target="#masuk_telat";
									
									
									$target="#masuk";
									$dispaly="";
									$title_rajin="display:none";
									$title_telat="";
									
									//Tampil selisih terlambat
									$start_date = new DateTime(''.$date.' '.$jam_telat_siang.'');
									$since_start = $start_date->diff(new DateTime(''.$date.' '.$time.''));
										if($since_start->h > 0){
										$jam_telat=$since_start->h." Jam ".$since_start->i." Menit ".$since_start->s." Detik ";
									}else{
										$jam_telat=$since_start->i." Menit ".$since_start->s." Detik ";
									}

								}else{
									$type="button";
									$name="";
									$toggle="modal";
									$target="#masuk";
									
									$dispaly="display:none";
									$title_rajin="";
									$title_telat="display:none";
								}
							}
						}else if ($jam >= 13 and $jam < 18 ){
							if ($menit >00 and $menit<60){
							$ucapan="Shift Sore";
							$checked_sore="checked";
								if($waktu_jam_menit > $jam_telat_sore){
									$type="button";
									$name="";
									$toggle="modal";
									//$target="#masuk_telat";
									
									
									$target="#masuk";
									$dispaly="";
									$title_rajin="display:none";
									$title_telat="";
									
									//Tampil selisih terlambat
									$start_date = new DateTime(''.$date.' '.$jam_telat_sore.'');
									$since_start = $start_date->diff(new DateTime(''.$date.' '.$time.''));
										if($since_start->h > 0){
										$jam_telat=$since_start->h." Jam ".$since_start->i." Menit ".$since_start->s." Detik ";
									}else{
										$jam_telat=$since_start->i." Menit ".$since_start->s." Detik ";
									}

								}else{
									$type="button";
									$name="";
									$toggle="modal";
									$target="#masuk";
									
									$dispaly="display:none";
									$title_rajin="";
									$title_telat="display:none";
								}
							}
						}else if ($jam >= 18 and $jam <= 24 ){
							if ($menit >00 and $menit<60){
							$ucapan="Shift Malam";
							$checked_malam="checked";
								
									$type="button";
									$name="";
									$toggle="modal";
									$target="#masuk";
									
									$dispaly="display:none";
									$title_rajin="";
									$title_telat="display:none";
						
							}
						}else {
							$ucapan="Error";
						}
					?>
					<?php
                    	$waktu=$time;
						$t=explode(":",$waktu);
						if($t[0]=="00"){
							$jam="24";
						}else{
							$jam=$t[0];
						}
						$menit=$t[1];

						if ($jam > 07 and $jam < 24 ){
							if ($menit >00 and $menit<60){
					?>
                	<button type="<?php echo $type; ?>" name="<?php echo $name; ?>" data-toggle="<?php echo $toggle; ?>" data-target="<?php echo $target; ?>" class="btn btn-primary btn-lg"><i class="fa fa-sign-in"></i> Absen Masuk</button>
			<br><br>
	                <?php }}?>   
	                    <?php
	                    	$waktu=$time;
							$t=explode(":",$waktu);
							$jam=$t[0];
							$menit=$t[1];

							if ($jam >= 00 and $jam <= 07 ){
								if ($menit >00 and $menit<60){

									$abs_tgl_las=$kemarin;
									$abs_tampil_las=$abs->abs_tampil_las($kar_id,$abs_tgl_las);
									$data_las=mysql_fetch_array($abs_tampil_las);
									if($data_las['abs_sts']=="M"){
										if($data_las['abs_shift']=="Shift Malam"){
	                    ?>
	                    	<button type="button" name="" data-toggle="modal" data-target="#pulangmalam" class="btn btn-success btn-lg"><i class="fa fa-sign-out"></i> Absen Pulang <br><small><small><small>Khusus Shift Malam</small></small></small></button>
	                    	<!--<small class="help-block"><small>Akses Absensi akan ditutup setiap jam <strong>5:30</strong> - <strong>6:30 WIB</strong> lakukanlah absen pulang sebelum lewat dari jam yang sudah ditentukan. #IT-GG</small></small>-->
	                    			<?php }else{?>
	                    				<button type="<?php echo $type; ?>" name="<?php echo $name; ?>" data-toggle="<?php echo $toggle; ?>" data-target="<?php echo $target; ?>" class="btn btn-primary btn-lg"><i class="fa fa-sign-in"></i> Absen Masuk</button>
	                    			<?php }?>
	                    <?php }else{?>
	                    	<button type="<?php echo $type; ?>" name="<?php echo $name; ?>" data-toggle="<?php echo $toggle; ?>" data-target="<?php echo $target; ?>" class="btn btn-primary btn-lg"><i class="fa fa-sign-in"></i> Absen Masuk</button>				
	                    <?php }}}?>

                    <?php
					}elseif($data['abs_sts']=="M"){
						$abs_tampil_kar=$abs->abs_tampil_kar($kar_id,$abs_tgl_masuk);
						$abs_data=mysql_fetch_array($abs_tampil_kar);
					  
						//NEW CHANGE
						$waktu_jam_menit=substr($time, 0,5);

						//Range Pagi
						$abs_stm_nm="Jam Cepat Pagi";
						$abs_settime_id=$abs->abs_settime_id($abs_stm_nm);
						$abs_settime_data=mysql_fetch_array($abs_settime_id);
						if(!empty($kar_data['ktr_default_shift1_in']) && !empty($kar_data['ktr_default_shift1_out'])){
							if(!empty($kar_data['kar_default_shift1_in']) && !empty($kar_data['kar_default_shift1_out'])){
								$jam_cepat_pagi=substr($kar_data['kar_default_shift1_out'], 0,5);
							}else{
								$jam_cepat_pagi=substr($kar_data['ktr_default_shift1_out'], 0,5);
							}
						}else{
							if(!empty($kar_data['kar_default_shift1_in']) && !empty($kar_data['kar_default_shift1_out'])){
								$jam_cepat_pagi=substr($kar_data['kar_default_shift1_out'], 0,5);
							}else{
								$jam_cepat_pagi=substr($abs_settime_data['abs_stm_jam'], 0,5);
							}
						}

						//Range Siang
						$abs_stm_nm="Jam Cepat Siang";
						$abs_settime_id=$abs->abs_settime_id($abs_stm_nm);
						$abs_settime_data=mysql_fetch_array($abs_settime_id);
						if(!empty($kar_data['ktr_default_shift2_in']) && !empty($kar_data['ktr_default_shift2_out'])){
							if(!empty($kar_data['kar_default_shift2_in']) && !empty($kar_data['kar_default_shift2_out'])){
								$jam_cepat_siang=substr($kar_data['kar_default_shift2_out'], 0,5);
							}else{
								$jam_cepat_siang=substr($kar_data['ktr_default_shift2_out'], 0,5);
							}
						}else{
							if(!empty($kar_data['kar_default_shift2_in']) && !empty($kar_data['kar_default_shift2_out'])){
								$jam_cepat_siang=substr($kar_data['kar_default_shift2_out'], 0,5);
							}else{
								$jam_cepat_siang=substr($abs_settime_data['abs_stm_jam'], 0,5);
							}
						}

						//Range Sore
						$abs_stm_nm="Jam Cepat Sore";
						$abs_settime_id=$abs->abs_settime_id($abs_stm_nm);
						$abs_settime_data=mysql_fetch_array($abs_settime_id);
						if(!empty($kar_data['ktr_default_shift3_in']) && !empty($kar_data['ktr_default_shift3_out'])){
							if(!empty($kar_data['kar_default_shift3_in']) && !empty($kar_data['kar_default_shift3_out'])){
								$jam_cepat_sore=substr($kar_data['kar_default_shift3_out'], 0,5);
							}else{
								$jam_cepat_sore=substr($kar_data['ktr_default_shift3_out'], 0,5);
							}
						}else{
							if(!empty($kar_data['kar_default_shift3_in']) && !empty($kar_data['kar_default_shift3_out'])){
								$jam_cepat_sore=substr($kar_data['kar_default_shift3_out'], 0,5);
							}else{
								$jam_cepat_sore=substr($abs_settime_data['abs_stm_jam'], 0,5);
							}
						}

						//Range Malam
						$abs_stm_nm="Jam Cepat Malam";
						$abs_settime_id=$abs->abs_settime_id($abs_stm_nm);
						$abs_settime_data=mysql_fetch_array($abs_settime_id);
						if(!empty($kar_data['ktr_default_shift4_in']) && !empty($kar_data['ktr_default_shift4_out'])){
							if(!empty($kar_data['kar_default_shift4_in']) && !empty($kar_data['kar_default_shift4_out'])){
								$jam_cepat_malam=substr($kar_data['kar_default_shift4_out'], 0,5);
							}else{
								$jam_cepat_malam=substr($kar_data['ktr_default_shift4_out'], 0,5);
							}
						}else{
							if(!empty($kar_data['kar_default_shift4_in']) && !empty($kar_data['kar_default_shift4_out'])){
								$jam_cepat_malam=substr($kar_data['kar_default_shift4_out'], 0,5);
							}else{
								$jam_cepat_malam=substr($abs_settime_data['abs_stm_jam'], 0,5);
							}
						}

					    if($abs_data['abs_shift']=="Shift Pagi"){
					    	if($waktu_jam_menit < $jam_cepat_pagi){

					    	$type="button";
							$name="";
							$toggle="modal";
							$target="#pulang";
							$shift=$data['abs_shift'];
							$message="Jam pulang anda adalah pukul $jam_cepat_pagi";
							$title_cepat="";
							$title_tepat="display:none";
							$dispaly="";

					    	}elseif($waktu_jam_menit >= $jam_cepat_pagi){

					    		$type="button";
							$name="";
							$toggle="modal";
							$target="#pulang";
							$shift="";
						        $message="";
							$title_cepat="display:none";
							$title_tepat="";
							$dispaly="display:none";

					    	}
					    }elseif($abs_data['abs_shift']=="Shift Siang"){
	    					if($waktu_jam_menit < $jam_cepat_siang){

	    					    $type="button";
						    $name="";
						    $toggle="modal";
						    $target="#pulang";
						    $shift=$data['abs_shift'];
						    $message="Jam pulang anda adalah pukul $jam_cepat_siang";
						    $title_cepat="";
						    $title_tepat="display:none";
						    $dispaly="";

	    					}elseif($waktu_jam_menit >= $jam_cepat_siang){

	    						$type="button";
							$name="";
							$toggle="modal";
							$target="#pulang";
							$shift="";
						        $message="";
							$title_cepat="display:none";
							$title_tepat="";
							$dispaly="display:none";

	    					}
					    }elseif($abs_data['abs_shift']=="Shift Sore"){
	    					if($waktu_jam_menit < $jam_cepat_sore){

	    						$type="button";
							$name="";
							$toggle="modal";
							$target="#pulang";
							$shift=$data['abs_shift'];
							$message="Jam pulang anda adalah pukul $jam_cepat_sore";
							$title_cepat="";
							$title_tepat="display:none";
							$dispaly="";

	    					}elseif($waktu_jam_menit >= $jam_cepat_sore){

	    						$type="button";
							$name="";
							$toggle="modal";
							$target="#pulang";
							$shift="";
						        $message="";
							$title_cepat="display:none";
							$title_tepat="";
							$dispaly="display:none";

	    					}
					    }elseif($abs_data['abs_shift']=="Shift Malam"){

	    					$type="button";
							$name="";
							$toggle="modal";
							$target="#pulang";
							$shift="";
						        $message="";
							$title_cepat="display:none";
							$title_tepat="";
							$dispaly="display:none";

					    }
						


					/////////////////////////////////////////////////////////////////////////////////						
					if ($status_fu == "disabled"){
						//$toggle="modal";
						//$target="#pulang_target_fu";
					}
					/////////////////////////////////////////////////////////////////////////////////						
						
					?>	
				   <input class="form-control" type="hidden" id="nik" value="<?php echo $nik;?>">
<!--					
                    <button type="<?php echo $type; ?>" name="<?php echo $name; ?>" 
					data-toggle="<?php echo $toggle; ?>" data-target="<?php echo $target; ?>" 
					class="btn btn-danger btn-lg"><i class="fa fa-sign-out"></i> Absen Pulang
					</button>
!-->	
			
                    <?php //echo  'status:'.$status_fu ;?>
					
                    <button type="<?php echo $type; ?>" name="<?php echo $name; ?>" id="submit" 
					data-toggle="<?php echo $toggle; ?>" data-target="<?php //echo $target; ?>" 
					class="btn btn-danger btn-lg"><i class="fa fa-sign-out"></i> Absen Pulang <?php //echo $type;?>
					</button>
<!--					
                     <button type="button" class="btn btn-primary" id="submit">CEK</button>
!-->					
					<?php
                    }elseif($data['abs_sts']=="P"){
                    ?>
                    <button type="button" class="btn btn-danger btn-lg" disabled><i class="fa fa-smile-o"></i> See You Tomorrow</button>
                    <?php
					}
					?>
                </form>
                </div>
                <div class="col-sm-7">
                <input type="text" class="h" value="0">
				<input type="text" class="m" value="0">
				<input type="text" class="s" value="0">
				<span class="label label-default"><?php echo $shf->waktu_shift();?></span>
				</div>

                </div>
                  <div class="box-body table-responsive no-padding">
                    <table class="table table-hover">
                    <?php
					$abs_tgl_masuk=$date;
					$abs_tampil_kar=$abs->abs_tampil_kar($kar_id,$abs_tgl_masuk);
					while($data=mysql_fetch_array($abs_tampil_kar)){
					  
					  if(!empty($data[abs_alasan_masuk])){
					    $alasan=$data['abs_alasan_masuk'];
					  }else{
					    $alasan="-";
					  }
					  
						if($data['abs_rwd_masuk']=="Telat"){
						  $lbl="danger";
						}elseif($data['abs_rwd_masuk']=="Rajin"){
						  $lbl="success";
						}elseif($data['abs_rwd_masuk']=="Tepat"){
						  $lbl="primary";
						}
						
						
					?>
                    <tr>
                      <td>Masuk</td>
                      <td><?php echo $data['abs_masuk']; ?></td>
                      <!--<td><?php //echo $data['abs_shift']; ?></td>-->
                      <td><a data-toggle="tooltip" title="<?php echo $kar_data['ktr_nm']; ?>" style="cursor:pointer"><?php echo $kar_data['ktr_kd']; ?></a></td>
                      <td><?php echo $tgl->tgl_indo($data['abs_tgl_masuk']); ?></td>
                      <td><span class="label label-<?php echo $lbl; ?>"><?php echo $data['abs_rwd_masuk']; ?></span></td>
                      <td><span data-toggle="tooltip" title="<?php echo $alasan; ?>" style="cursor:pointer">... <i class="fa fa-external-link"></i></span></td>
                    </tr>
                    <?php }?>
                    <?php
					$abs_tgl_masuk=$date;
					$abs_tampil_kar=$abs->abs_tampil_kar($kar_id,$abs_tgl_masuk);
					while($data=mysql_fetch_array($abs_tampil_kar)){
					  
					  if(!empty($data[abs_alasan_pulang])){
					    $alasan=$data['abs_alasan_pulang'];
					  }else{
					    $alasan="-";
					  }
					
					if($data[abs_sts]=="P"){	
						if($data['abs_rwd_pulang']=="Izin"){
						  $lbl="danger";
						}elseif($data['abs_rwd_pulang']=="Loyal"){
						  $lbl="success";
						}elseif($data['abs_rwd_pulang']=="Tepat"){
						  $lbl="primary";
						}
					?>
                    <tr>
                      <td>Pulang</td>
                      <td><?php echo $data['abs_pulang']; ?></td>
                      <!--<td><?php //echo $data['abs_shift']; ?></td>-->
                      <td><a data-toggle="tooltip" title="<?php echo $kar_data['ktr_nm']; ?>" style="cursor:pointer"><?php echo $kar_data['ktr_kd']; ?></a></td>
                      <td><?php echo $tgl->tgl_indo($data['abs_tgl_pulang']); ?></td>
                      <td><span class="label label-<?php echo $lbl; ?>"><?php echo $data['abs_rwd_pulang']; ?></span></td>
                      <td><span data-toggle="tooltip" title="<?php echo $alasan; ?>" style="cursor:pointer">... <i class="fa fa-external-link"></i></span></td>
                    </tr>
                    <?php }}?>
                  </table>
                  </div><!-- /.box-body -->

                  <div class="box-footer">
                    <?php
					$abs_tgl_masuk=$date;
					$abs_tampil_kar=$abs->abs_tampil_kar($kar_id,$abs_tgl_masuk);
					while($data=mysql_fetch_array($abs_tampil_kar)){
					  
					  $kar_id_abs=$data['kar_id'];
					  $kar_tampil_id_abs=$kar->kar_tampil_id($kar_id_abs);
					  $kar_data_abs=mysql_fetch_array($kar_tampil_id_abs);
					  
					  $unt_id=$kar_data_abs['unt_id'];
					  $ktr_id=$kar_data_abs['ktr_id'];
						
						$ip_tampil_unt_ktr=$ip->ip_tampil_unt_ktr($unt_id,$ktr_id);
						$ip_data=mysql_fetch_array($ip_tampil_unt_ktr);
					  
					  if($data['abs_sts']=="P"){
					    
					    $lama_kerja=7; //khusus ramadhan ubah menjadi 7 jam
						  
					    $start_date = new DateTime(''.$data[abs_tgl_masuk].' '.$data[abs_masuk].'');
					    $since_start = $start_date->diff(new DateTime(''.$data[abs_tgl_pulang].' '.$data[abs_pulang].''));
					    /*echo $since_start->days.' days total<br>';
					    echo $since_start->y.' years<br>';
					    echo $since_start->m.' months<br>';
					    echo $since_start->d.' days<br>';*/
					    echo "<small>Anda Bekerja Selama:</small><br>";
					    echo $since_start->h.' jam<br>';
					    echo $since_start->i.' menit<br>';
					    echo $since_start->s.' detik<br>';
					    
					    if($since_start->h < $lama_kerja){
						    echo"<small>Kurang Dari ".$lama_kerja." Jam,</small> Grade: <span class='label label-danger'>Bad</span>";
					    }elseif($since_start->h > $lama_kerja){
						    echo"<small>Lebih Dari ".$lama_kerja." Jam,</small> Grade: <span class='label label-success'>Good</span>";
					    }elseif($since_start->h = $lama_kerja){
						    echo"<small>".$lama_kerja." Jam,</small> Grade: <span class='label label-primary'>Mediocre</span>";
					    }
					  }
					  
					  if(!($ip_data['ip_nm']==$data['abs_ip'])){
					?>
		  <!--<br><br>
		  <div class="alert alert-danger alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <h4><i class="icon fa fa-ban"></i> System Protected!</h4>
                    Sistem kami telah menditeksi bahwa Anda absen dengan jaringan IP lain yaitu <strong><u><?php //echo $data['abs_ip'];?></u></strong>, <br> absen Anda secara sistem Kami ragukan, segera konfirmasi Departement SDM.
		    <br><br>
		    Laporkan segera apabila terjadi kesalahan seperti berikut:
		    <ul>
		      <li>Mati Listrik</li>
		      <li>Reset Router/Modem</li>
		      <li>Jaringan Mati/ tidak ada</li>
		      <li>Beda Lokasi Login (Kantor)</li>
		      <li>DLL <em>(yang mengakibatkan IP Address berubah)</em></li>
		    </ul>
		    <br>
		    **)Bagi yang mengakses SIPEMA, tidak dapat login sebelum proteksi absen dihilangkan (Konfirmasi SDM/IT).
		  </div>-->
		  <?php }}?>
                  </div>
              </div><!-- /.box -->

<!-- Masuk -->
<div class="modal fade" id="masuk" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg"> <!--modal-lg-->
    <div class="modal-content">
      <div class="modal-header bg-primary">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 style="<?php echo $title_rajin;?>" class="modal-title" id="myModalLabel"><i class="fa fa-map-marker"></i> Pilih <strong>Kantor</strong> / <strong>Unit</strong> dimana Anda akan melakukan <strong>Absen Masuk</strong></h4>
        <h4 style="<?php echo $title_telat;?>" class="modal-title" id="myModalLabel"><i class="fa fa-meh-o"></i> Yahh.. Kamu telat masuk <strong><?php echo $ucapan; ?></strong> ya, tulis ya alasannya.. <i class="fa fa-exclamation-triangle"></i></h4>
      </div>
      <form class="form-horizontal" action="" method="post" id="myform">
      <!--<form class="form-horizontal" action="" method="post">-->
      <div class="modal-body">
	
	<div class="row">
	    <div class="col-sm-4">
	      	
		<div class="form-group">
		  <div class="col-sm-12">
		    <center>
			<div id="my_camera"></div>
			<input id="mydata" type="hidden" name="mydata" value=""/>
			<input id="babsmasuk" type="hidden" name="babsmasuk" value=""/>
		    </center>	  
		  </div>
		</div>
		
	    </div>
	    
	    <div class="col-sm-8">
	      
		<div class="form-group" style="<?php echo $dispaly;?>">
		  <label for="abs_alasan" class="col-sm-2 control-label">Alasan</label>
		  <div class="col-sm-10">
		    <textarea name="abs_alasan_masuk" class="form-control" rows="3" id="abs_alasan_masuk" placeholder="Wajib diisi..." required></textarea>
		  </div>
		</div>
	    
		<div class="form-group">
		  <label for="abs_shift" class="col-sm-2 control-label">Shift</label>
		  <div class="col-sm-10">
		      <input type="radio" name="abs_shift" value="Shift Pagi" class="flat-red" id="abs_shift" <?php echo $checked_pagi;?> /> Pagi &nbsp;
		      <input type="radio" name="abs_shift" value="Shift Siang" class="flat-red" id="abs_shift" <?php echo $checked_siang;?> /> Siang &nbsp;
		      <input type="radio" name="abs_shift" value="Shift Sore" class="flat-red" id="abs_shift" <?php echo $checked_sore;?> /> Sore &nbsp;
		      <input type="radio" name="abs_shift" value="Shift Malam" class="flat-red" id="abs_shift" <?php echo $checked_malam;?> /> Malam &nbsp; 
		  </div>
		</div>
	       
	       <?php
	       $ip_nm=$ip_jaringan;
	       $ip_dns=$hostname;
	       $ip_cek_dns=$ip->ip_cek_dns($ip_nm,$ip_dns);
	       $ip_data=mysql_fetch_array($ip_cek_dns);
	       $ip_result=mysql_num_rows($ip_cek_dns);
      
	       if($ip_result > 0){
      
		      $ktr_id=$ip_data['ktr_id'];
	       ?>
      
	       <input type="hidden" name="location" value="<?php echo $ktr_id;?>">
      
	       <?php
	       }else{
	       ?>	
		
		<div class="form-group">
		  <label for="abs_alasan" class="col-sm-2 control-label">Location</label>
		  <div class="col-sm-10">
			<?php
			$ktr_id=$kar_data['ktr_id'];
			?>
		    <div class="bfh-selectbox" data-name="location" data-value="<?php echo $ktr_id;?>" data-filter="true">
		    <?php
			$ktr_tampil=$ktr->ktr_tampil();
					if($ktr_tampil){
					      foreach($ktr_tampil as $data){
						 if(($data['ktr_aktif']=="A")){
		    ?>
					<div data-value="<?php echo $data['ktr_id'];?>"><?php echo $data['ktr_nm'];?></div>
				<?php }}}?>	  
				      </div>
		  </div>
		</div>
      
	       <?php }?>
	       
	       <div class="form-group">
		  <div class="col-sm-12" style="padding-left:5%;">
		      <div class="alert alert-warning  alert-dismissable" align="left">
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
			<!--<h4><i class="icon fa fa-warning"></i> PERHATIAN!</h4>
			Ketika <strong>Absen Pulang</strong>, akan dicek berdasarkan lokasi <strong>Absen Masuk</strong> yang Anda pilih.-->
			<h4><i class="icon fa fa-warning"></i> KEEP CALM!</h4>

			<?php if($kar_data['div_id'] == 8){?>
				<strong>Selamat bekerja</strong>, <strong>jangan lupa berdoa</strong>, <strong>selalu tersenyum</strong>, <strong>lakukan pekerjaan dengan baik.</strong><br><br>
				<strong>Follow up BDC</strong>, <strong>Google Click</strong>, berusahalah <strong>dapat menyenangkan semua orang</strong> dan semoga <strong>hasil terbaik</strong> hari ini menghampiri Anda.
			<?php }else{ ?>
				<strong>Absensi via WebCam</strong> masih dalam tahap uji coba. Posisi kamera <strong>disebelah kiri</strong>.
				<strong><a href="http://personalia.web.id/absen/tutor-absen-v2.jpg" target="_blank">Klik disini</a></strong> untuk tutorial.
			<?php } ?>

		      </div>
		  </div>
	      </div>
	      
	      <div class="modal-footer">
		<span style="float:left;<?php echo $dispaly;?>"><small>Waktu:</small> <?php echo $ucapan; ?> <br> <small>Anda Terlambat:</small> <?php echo $jam_telat; ?></span>
		<!--<button type="submit" name="babsmasuk" class="btn btn-primary"><i class="fa fa-hand-o-up"></i></button>-->
		<span class="pull-right" id="btnmsg"><em>Please Wait...</em></span>
		<button type="button" onClick="take_snapshot()" id="btnabsen" class="btn btn-primary pull-right"><i class="fa fa-hand-o-up"></i></button>
	      </div>
	    
	    </div>
	</div>
	

      </div>
      
      </form>
    </div>
  </div>
</div>
         
<!-- Pulang -->
<div class="modal fade" id="pulang" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header bg-red">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	<h4 style="<?php echo $title_tepat;?>" class="modal-title" id="myModalLabel"><i class="fa fa-smile-o"></i> See You Tomorrow <strong><?php echo $kar_data['kar_nm']; ?></strong>, Hati-hati dijalan...</h4>
        <h4 style="<?php echo $title_cepat;?>" class="modal-title" id="myModalLabel"><i class="fa fa-meh-o"></i> Hayoo, baru jam segini ko udah mau pulang <strong><?php echo $shift; ?></strong>.. <i class="fa fa-exclamation-triangle"></i></h4>
      </div>
      <form class="form-horizontal" action="" method="post" id="myform2">
      <div class="modal-body">
	
	<div class="row">
	  
	<div class="col-sm-4">
	  
	    <div class="form-group">
		  <div class="col-sm-12">
		    <center>
			<div id="my_camera2"></div>
			<input id="mydata2" type="hidden" name="mydata2" value=""/>
			<input id="babspulang" type="hidden" name="babspulang" value=""/>
		    </center>	  
		  </div>
		</div>
	  
	</div>
	<div class="col-sm-8">
	  
          <div class="form-group" style="<?php echo $dispaly;?>">
            <label for="abs_alasan" class="col-sm-2 control-label">Alasan</label>
            <div class="col-sm-10">
              <textarea name="abs_alasan_pulang" class="form-control" rows="3" id="abs_alasan_pulang" placeholder="Wajib diisi..." required></textarea>
            </div>
          </div>
	  <div class="form-group">
	      <div class="col-sm-12" style="padding-left:5%;">
		  <div class="alert alert-warning  alert-dismissable" align="left">
		    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
		    <!--<h4><i class="icon fa fa-warning"></i> PERHATIAN!</h4>
		    Ketika <strong>Absen Pulang</strong>, akan dicek berdasarkan lokasi <strong>Absen Masuk</strong> yang Anda pilih.-->
		    <h4><i class="icon fa fa-warning"></i> KEEP CALM!</h4>
		    <strong>Absensi via WebCam</strong> masih dalam tahap uji coba. Posisi kamera <strong>disebelah kiri</strong>.
		    <strong><a href="http://personalia.web.id/absen/tutor-absen-v2.jpg" target="_blank">Klik disini</a></strong> untuk tutorial.

		  </div>
	      </div>
	  </div>
	  
	  <div class="modal-footer">
	    <span style="float:left;<?php echo $dispaly;?>"><small>Waktu:</small> <?php echo $shift; ?> <br> <small><?php echo $message; ?></small> </span>
	    <span class="pull-right" id="btnmsgpulang"><em>Please Wait...</em></span>
	    <button type="button" onClick="take_snapshot2()" id="btnabsenpulang" class="btn btn-danger pull-right"><i class="fa fa-hand-o-up"></i></button>
	  </div>
	  
	</div>
      </div>	
	
      </div>
      
      
      </form>
    </div>
  </div>
</div>


<!-- Pulang Kurang dari Target FU -->
<div class="modal fade" id="pulang_target_fu" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-md">
    <div class="modal-content">
      <div class="modal-header bg-red">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 style="<?php echo $title_cepat;?>" class="modal-title" id="myModalLabel"><i class="fa fa-meh-o"></i>
          Peringatan !... 
        </h4>
      </div>
      <div class="modal-body">
		  <div class="row">
				<div class="col-sm-12">
					<center>
					<h4><i class="icon fa fa-warning"></i>
						Mohon maaf, FU anda baru  <font id="jml_fu"></font>
						<BR />Saat ini anda belum dapat melakukan absen pulang 
						<BR />sebelum melaksanakan Follow Up BDC <font id="target_fu"></font> data/hari.
					</h4>
					</center>
				  
				</div>
		  </div>
	  </div>	  
	  
    </div>
  </div>
</div>

<!-- DISABLE PULANG -->
<div class="modal fade" id="disable_pulang" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-md">
    <div class="modal-content">
      <div class="modal-header bg-red">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 style="<?php echo $title_cepat;?>" class="modal-title" id="myModalLabel"><i class="fa fa-meh-o"></i>
          Peringatan !... 
        </h4>
      </div>
      <div class="modal-body">
		  <div class="row">
				<div class="col-sm-12">
					<center>
					<h4><i class="icon fa fa-warning"></i>
						Mohon maaf, untuk saat ini ANDA tidak diperbolehkan untuk pulang<font id="jml_fu"></font>
						<br>
						silahkan hubungi SDM untuk penjelasan lebih lanjutnya.
					</h4>
					</center>
				  
				</div>
		  </div>
	  </div>	  
	  
    </div>
  </div>
</div>


<!-- Pulang Malam -->
<div class="modal fade" id="pulangmalam" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header bg-green">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	<h4 class="modal-title" id="myModalLabel"><i class="fa fa-smile-o"></i> See You Tomorrow <strong><?php echo $kar_data['kar_nm']; ?></strong>, Hati-hati dijalan, Jangan Ngantuk!!!</h4>
      </div>
      <form class="form-horizontal" action="" method="post" id="myform3">
      <div class="modal-body">
	
	<div class="row">
	  
	<div class="col-sm-4">
	  
	    <div class="form-group">
		  <div class="col-sm-12">
		    <center>
			<div id="my_camera3"></div>
			<input id="mydata3" type="hidden" name="mydata3" value=""/>
			<input id="babspulangmalam" type="hidden" name="babspulangmalam" value=""/>
		    </center>	  
		  </div>
		</div>
	  
	</div>
	<div class="col-sm-8">
	  
	  <div class="form-group">
	      <div class="col-sm-12" style="padding-left:5%;">
		  <div class="alert alert-warning  alert-dismissable" align="left">
		    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
		    <!--<h4><i class="icon fa fa-warning"></i> PERHATIAN!</h4>
		    Ketika <strong>Absen Pulang</strong>, akan dicek berdasarkan lokasi <strong>Absen Masuk</strong> yang Anda pilih.-->
		    <h4><i class="icon fa fa-warning"></i> KEEP CALM!</h4>
		    <strong>Absensi via WebCam</strong> masih dalam tahap uji coba. Posisi kamera <strong>disebelah kiri</strong>.
		    <strong><a href="http://personalia.web.id/absen/tutor-absen-v2.jpg" target="_blank">Klik disini</a></strong> untuk tutorial.
		  </div>
	      </div>
	  </div>
	  
	  <div class="modal-footer">
	    <span class="pull-right" id="btnmsgpulangmalam"><em>Please Wait...</em></span>
	    <button type="button" onClick="take_snapshot3()" id="btnabsenpulangmalam" class="btn btn-success pull-right"><i class="fa fa-hand-o-up"></i></button>
	  </div>
	  
	</div>
      </div>	
	
      </div>
      
      
      </form>
    </div>
  </div>
</div>
<!--
 <div id="loading"></div>
!-->
 
<div class="modal fade" id="loading" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-md">
    <div class="modal-content">
      <div class="modal-header bg-red">
<!--	  
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 style="<?php echo $title_cepat;?>" class="modal-title" id="myModalLabel"><i class="fa fa-meh-o"></i>
          Peringatan !... 
        </h4>
!-->		
      </div>
      <div class="modal-body">
		  <div class="row">
				<div class="col-sm-3">
					<center class="loader_bola">
					</center>
				</div>
				<div class="col-sm-7">
					<center >
					<h4 ><i class="icon fa fa-warning"></i>
						Harap Tunggu !...<br /> Sedang Proses Cek FU BDC 
					</h4>
					</center>
				  
				</div>
		  </div>
	  </div>	  
	  
    </div>
  </div>
</div>

<?php 
/*
   $user_penagihan ="
	SG00602010 Ellyawati Rahayu 
	SG01182013 Rejeki Panca Prihartini 
	SG02052014 Runtut Istiarmalah 
	SG02692015 Anggita Megarestiyana 
	SG04372017 Puji Lestari 
	SG05182019 Indira Puspitasari 
	";
*/
$url_cek_disable ="https://cb.web.id/cek_disable_pulang.php?nik=".$kar_data[kar_nik];
$url_fu     = "//daftarkuliah.my.id/bdc/x_crontab_activity.php?nik=$nik";
if ($kar_id==60 || $kar_id==118 || $kar_id==205 || $kar_id==269 || $kar_id==437 || $kar_id==518 )
{
 ///User Penagihan ///
 // $url_fu = "//203.29.27.139/dev2/cronhistory_absen_fu/".$nik;
    $url_fu = "//daftarkuliah.my.id/bdc/x_crontab_activity_penagihan.php?nik=$nik";
  
}
?>	

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script>
$(document).ready(function(){
  $("#submit").click(function(){
	 var nik = $('#nik').val();	
//	    $('#loading').html("<font color='red'>Harap Tunggu !... <br> Sedang Cek FU BDC</font>");
	    $('#loading').modal('show');
		$.ajax({
		type: 'POST',
		processData: false,
		contentType: false,
		url: "<?php echo $url_fu; ?>",
/*		
		url: '//daftarkuliah.my.id/bdc/x_crontab_activity.php?nik='+nik,
		url: '//192.168.3.100/dev2/cronhistory_absen_fu/SG00602010/',
*/		
		crossDomain: true,
		
		success: function(responseData, textStatus, jqXHR) {
			
			var value = responseData.someKey;
			console.log(responseData); 
			var obj = JSON.parse(responseData);
//			$('#loading').html(obj[1].status);
//			$('#loading').html('');
		    $('#loading').modal('hide');
			var jml_fu = obj[0].jml_fu;
			var target_fu = obj[1].target_fu;
			if(obj[1].status === 'disabled'){
	            $('#jml_fu').html("<font color='red' size='5' >"+jml_fu+"</font>");
	            $('#target_fu').html("<font color='red' size='5' >"+target_fu+"</font>");
				$('#pulang_target_fu').modal('show');
			}else{
				
				$.ajax({
					type:"GET",
					url: "<?php echo $url_cek_disable; ?>",
					success: function(data) {
						console.log("test",data)
						if(data == 'Y'){
							$('#disable_pulang').modal('show');
						}else{
							$('#pulang').modal('show');
						}
					}
				});
				
				
			}
		},
		error: function (responseData, textStatus, errorThrown) {
			alert('POST failed.');
		}
	});
  });
});
</script>

