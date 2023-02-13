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
#map {

        height: 400px;

        width: 100%;

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
                  <h3 class="box-title">Check Posisi  <small><?php echo $tgl->tgl_indo($date);?></small></h3>
                  <!-- tools box -->
                  <div class="pull-right box-tools">
                  	
                    <button class="btn btn-info btn-sm" data-widget='remove' data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
                  </div><!-- /. tools -->
                </div><!-- /.box-header -->
                <div class="box-header">
                <div class="box-footer">
                  <div class="alert alert-default alert-dismissable">
				  <!--
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <h4><i class="icon fa fa-warning"></i> PERHATIAN!</h4>
                    *) Check Posisi 2 dilakukan <strong>3 jam setelah absen masuk</strong> dan batas check posisi 2 setelah muncul adalah <strong>10 menit</strong>.<br>
                    *) Check Posisi 3 dilakukan <strong>6 jam setelah absen masuk</strong> dan batas check posisi 3 setelah muncul adalah <strong>10 menit</strong>.<br> 
					-->
                  </div>
                </div>
				<div class="col-sm-5">
                <form action="" method="post">			               					
				    <?php
					 $chc_tgl_masuk = $date;
					 $chc_tampil_kar = $chc->chc_tampil_kar($chc_tgl_masuk,$kar_idtst);
					 $datacheckpoint=mysql_fetch_array($chc_tampil_kar);
					 $cekdatachc=mysql_num_rows($chc_tampil_kar);					 
					 $jammasuk = $datacheckpoint['jam'];
					 
					 // ASLI Pembacaan pada jam absen masuk
					 // $waktu_jam_menit=substr($jammasuk, 0,5);
					 // $waktu_jam_checkpoint2 = date('H:i', strtotime('+120 minutes', strtotime($jammasuk)));					 
					 // $waktu_jam_checkpoint3 = date('H:i', strtotime('+300 minutes', strtotime($jammasuk)));	 				 
					 // $waktucheck2=$waktu_jam_checkpoint2;
					 // $waktucheck3=$waktu_jam_checkpoint3;
					 // ASLI Pembacaan pada jam absen masuk
					 
					 $jamcheck2="11:00";
					 $jamcheck3="14:00";
					 $waktucheck2=$jamcheck2;
					 $waktucheck3=$jamcheck3;
					 
					 $waktu=date('H:i', strtotime($time));
									 
					 $datetimecheck2 = date("Y-m-d")." ".$waktucheck2.":00";
					 $waktuberakhircheck2 = date('H:i', strtotime('+10 minutes', strtotime($datetimecheck2)));
					 
					 $datetimecheck3 = date("Y-m-d")." ".$waktucheck3.":00";
					 $waktuberakhircheck3 = date('H:i', strtotime('+10 minutes', strtotime($datetimecheck3)));
					 
					 echo "realtime --".$waktu."<br>" ;				 
					 echo "penambahan 3 jam setelah absen masuk --".$waktucheck2."<br>" ;					 
					 echo "batas akhir + 10 minutes --".$waktuberakhircheck2."<br>" ;
					 
					 echo "penambahan 6 jam setelah absen masuk --".$waktucheck3."<br>" ;					 
					 echo "batas akhir + 10 minutes --".$waktuberakhircheck3."<br>" ;
         
					 if($cekdatachc > 0){
						 
						 if ($waktu >= $waktucheck2 && $waktu <= $waktuberakhircheck2){	
							 $latlongchc2 = $datacheckpoint['checkpoint2'];
							 $checkok = "checkpoint2";
							//echo "Muncul<br>".$checkok;		
							
						 	if($latlongchc2 == ""){		
								
					?>
					<?php
					if($inihp){
					?>
					 <!-- penambahan 1 -->
                	<button type="<?php echo $type; ?>" name="<?php echo $name; ?>" data-toggle="modal" data-target="#" id="<?php echo $checkok;?>"  class="btn btn-primary btn-lg"><i class="fa fa-sign-in"></i> Check Posisi 2. <br><?php //echo $jammasuk.'-'.$waktu_jam_menit."-".$waktu_jam_checkpoint2; ?> </button>
					<?php }else{?>
					<button type="<?php echo $type; ?>" name="" data-toggle="<?php echo $toggle; ?>" data-target="#" id="#"  class="btn btn-success btn-lg"><i class="fa fa-sign-in"></i> Wajib HP<br><?php //echo $exp_datanya[$date_intnya]; ?> </button>
					<?php }?>
					<input type="text" class="form-control" id="waktucheck2" value="<?php echo $waktucheck2;?>">
					<input type="text" class="form-control" id="waktuberakhircheck2" value="<?php echo $waktuberakhircheck2;?>">
					<div id="posisi"></div>
				    <div id="status"></div>
					 <!-- penambahan 1 -->	
					 <?php }else{?>
					   <button type="button" class="btn btn-danger btn-lg" disabled><i class="fa fa-smile-o"></i> Thanks Check 2 telah selesai</button>    
					 <?php }?>
					
					 <?php }?>
					<br><br>
					
                </form>
                </div>
                <div class="col-sm-5">
                <form action="" method="post">			               					
					<?php
						 if ($waktu >= $waktucheck3 && $waktu <= $waktuberakhircheck3){	
							 $latlongchc3 = $datacheckpoint['checkpoint3'];
							 $checkok = "checkpoint3";
							//echo "Muncul<br>".$checkok;							 
						 	if($latlongchc3 == ""){					 
					?>
					<?php
					if($inihp){
					?>
					 <!-- penambahan 2 -->
                	<button type="<?php echo $type; ?>" name="<?php echo $name; ?>" data-toggle="modal" data-target="#" id="<?php echo $checkok;?>"  class="btn btn-primary btn-lg"><i class="fa fa-sign-in"></i> Check Posisi 3. <br><?php //echo $jammasuk.'-'.$waktu_jam_menit."-".$waktu_jam_checkpoint2; ?> </button>
					<?php }else{?>
					<button type="<?php echo $type; ?>" name="" data-toggle="<?php echo $toggle; ?>" data-target="#" id="#"  class="btn btn-success btn-lg"><i class="fa fa-sign-in"></i> Wajib HP<br><?php //echo $exp_datanya[$date_intnya]; ?> </button>
					<?php }?>					
					<input type="text" class="form-control" id="waktucheck3" value="<?php echo $waktucheck3;?>">
					<input type="text" class="form-control" id="waktuberakhircheck3" value="<?php echo $waktuberakhircheck3;?>">
					 <div id="posisi"></div>
				     <div id="status"></div>
					 <!-- penambahan 2 -->	
					 <?php }else{?>
					   <button type="button" class="btn btn-danger btn-lg" disabled><i class="fa fa-smile-o"></i>  Thanks Check 3 telah selesai</button>    
					 <?php }?>
					
				     <?php }?>					
					<br><br> 				
                </form>
				<?php }?>
				</div>
                </div>
              </div><!-- /.box -->

<!-- TRAP LOCATION-->
<div class="modal fade" id="trap_location" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-md">
    <div class="modal-content">
      <div class="modal-header bg-yellow">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel"><i class="icon fa fa-warning"></i>
		<strong>Peringatan!, Anda diluar radius</strong></h4>
      </div>
      <div class="modal-body">
		<div class="row">
			<div class="col-sm-12">
			  <center>
			  <h4>
			  </h4>
			  <div id="map"></div>
			  </center>
			</div>
			<div class="col-sm-12">
			  <center>
			  <h4>
			  </h4>
			  <div><b>Apakah Anda Ingin Tetap Absen , di luar radius dan Terima resikonya</b> ?  <button type="button"  data-toggle="modal" data-target="#masuk" class="btn btn-primary btn-sm"><i class="fa fa-sign-in"></i> Ya </button> <a class="btn btn-danger btn-sm" href="https://cb.web.id/media.php"> Tidak </a> </div>
			  </center>
			</div>
				
		</div>
      </div>
    </div>
  </div>
</div>
			  
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
        <h4 class="modal-title" id="myModalLabel"><i class="fa fa-meh-o"></i> Peringatan !...</h4>
      </div>
      <div class="modal-body">
	<div class="row">
	    <div class="col-sm-12">
	      <center>
	      <h4><i class="icon fa fa-warning"></i>
		      Mohon maaf, untuk saat ini ANDA tidak diperbolehkan untuk pulang
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

<!-- Belum saatnya check point 2 -->
<div class="modal fade" id="batascheckshow" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-md">
    <div class="modal-content">
      <div class="modal-header bg-yellow">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel"><i class="fa fa-meh-o"></i> Peringatan !...</h4>
      </div>
      <div class="modal-body">
		<div class="row">
			<div class="col-sm-12">
			  <center>
			  <h4><i class="icon fa fa-warning"></i>
				  <strong>Anda sudah melewati batas check point.</strong>
			  </h4>
			  </center>
			</div>
		</div>
      </div>
    </div>
  </div>
</div>

<!-- TRAP DAILY ACTIVITY -->
<div class="modal fade" id="trap_daily_act" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-md">
    <div class="modal-content">
      <div class="modal-header bg-yellow">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel"><i class="fa fa-meh-o"></i> Peringatan !...</h4>
      </div>
      <div class="modal-body">
	<div class="row">
	    <div class="col-sm-12">
	      <center>
	      <h4><i class="icon fa fa-warning"></i>
		      <strong>Anda belum bisa melakukan absensi pulang. 
		      <br>
		      Segera membuat dan mempublish Daily Activity terlebih dahulu!</strong>
	      </h4>
	      </center>
	    </div>
	</div>
      </div>
    </div>
  </div>
</div>

<!-- Check Point 1 skiP langsung point2 -->
<div class="modal fade" id="checkpoint1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-md">
    <div class="modal-content">
      <div class="modal-header bg-purple">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel"><i class="fa fa-meh-o"> Pilih Absen</i></h4>
      </div>
      <div class="modal-body">
	<div class="row">
	    <div class="col-sm-12">
	      <center>
		  <!--
	      <h4><i class="icon fa fa-success"></i>
		      <strong></strong>
	      </h4>
		  -->
		  <button type="button" id="submitmasuk" class="btn btn-success btn-lg"><i class="fa fa-sign-in"></i> Absen di dalam Radius</button> ||
		  <button type="button" id="chc1"  class="btn btn-primary btn-lg"><i class="fa fa-sign-in"></i> Absen di Luar Radius </button>
	      </center>
	    </div>
	</div>
      </div>
    </div>
  </div>
</div>

<!-- Check Point 2 -->
<div class="modal fade" id="checkpoint2show" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-md">
    <div class="modal-content">
      <div class="modal-header bg-purple">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel"><i class="fa fa-meh-o">Check Point 2</i></h4>
      </div>
      <div class="modal-body">
		<div class="row">
			<div class="col-sm-12">
			  <form class="form-horizontal" action="" method="post">
			  <input type="hidden" class="form-control" id="latitude" value="<?php echo $kar_datatst['kar_lat'];?>">
			  <input type="hidden" class="form-control" id="longitude" value="<?php echo $kar_datatst['kar_long'];?>">
			  <input type="hidden" class="form-control" id="max_radius" value="<?php echo $kar_datatst['kar_radius'];?>">
			  <input type="hidden" class="form-control" name="chc_nik" value="<?php echo $kar_datatst['kar_nik'];?>">
			  <input type="hidden" class="form-control" name="chc_nama" value="<?php echo $kar_datatst['kar_nm'];?>">
			  <div id="inpoyformchc2"></div>
			  <center>
				<button type="submit" name="checkpoint2post" class="btn btn-success btn-lg"><i class="fa fa-sign-in"></i> Confirm</button>
			  </center>
			  </form>
			</div>
		</div>
      </div>
    </div>
  </div>
</div>

<!-- Check Point 3  -->
<div class="modal fade" id="checkpoint3show" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-md">
    <div class="modal-content">
      <div class="modal-header bg-purple">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel"><i class="fa fa-meh-o">Check Point 3</i></h4>
      </div>
      <div class="modal-body">
		<div class="row">
			<div class="col-sm-12">
			  <form class="form-horizontal" action="" method="post">
			  <input type="text" class="form-control" id="latitude" value="<?php echo $kar_datatst['kar_lat'];?>">
			  <input type="text" class="form-control" id="longitude" value="<?php echo $kar_datatst['kar_long'];?>">
			  <input type="text" class="form-control" id="max_radius" value="<?php echo $kar_datatst['kar_radius'];?>">
			  <input type="text" class="form-control" name="chc_nik" value="<?php echo $kar_datatst['kar_nik'];?>">
			  <input type="text" class="form-control" name="chc_nama" value="<?php echo $kar_datatst['kar_nm'];?>">
			  <div id="inpoyformchc3"></div>
			  <center>
			  <button type="submit" name="checkpoint3post" class="btn btn-success btn-lg"><i class="fa fa-sign-in"></i> Confirm</button>
			  </center>
			   </form>
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
 
<div class="modal fade" id="loading" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-md">
    <div class="modal-content">
      <div class="modal-header bg-red">	
      </div>
      <div class="modal-body">
	<div class="row">
	    <div class="col-sm-3">
	      <center class="loader_bola"></center>
	    </div>
	    <div class="col-sm-7">
	      <center>
		<h4 ><i class="icon fa fa-warning"></i> Harap Tunggu !...<br /> Sedang Proses Cek FU BDC</h4>
	      </center>
	    </div>
	</div>
      </div>
    </div>
  </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
 <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBTWSk-Yipimvagi0FeEtgRqvG-cXV8NhU&callback=initMap"></script>
<script>
	var x = document.getElementById("posisi");
	//var f = document.getElementById("inpoyformchc2");
	//var ff = document.getElementById("inpoyformchc3");
	var s = document.getElementById("status");
		  
          $("#checkpoint2").click(function(){
			  /*belum coba pakai ini
			   const date = new Date();
			   const time = date.toTimeString().split(' ')[0].split(':');
			   console.log(time[0] + ':' + time[1])
			   */
			   const waktu = Date().slice(16,21);
			   //var waktu = document.getElementById("waktu").value;
			   var waktucheck2 = document.getElementById("waktucheck2").value;
			   var waktuberakhircheck2 = document.getElementById("waktuberakhircheck2").value;
			   console.log(waktu);
			  if(waktu >= waktucheck2 && waktu <= waktuberakhircheck2){
				  if (navigator.geolocation) {

					navigator.geolocation.getCurrentPosition(showPosition2, showError);

				  } else { 

					x.innerHTML = "Geolocation is not supported by this browser.";

				  }
			  }else{				  
				  $('#batascheckshow').modal('show');
				  
			  }

			  
		  });
		  
		  $("#checkpoint3").click(function(){

			  /*belum coba pakai ini
			   const date = new Date();
			   const time = date.toTimeString().split(' ')[0].split(':');
			   console.log(time[0] + ':' + time[1])
			   */
			   const waktu = Date().slice(16,21);
			   //var waktu = document.getElementById("waktu").value;
			   var waktucheck3 = document.getElementById("waktucheck3").value;
			   var waktuberakhircheck3 = document.getElementById("waktuberakhircheck3").value;
			   console.log(waktu);
			  if(waktu >= waktucheck3 && waktu <= waktuberakhircheck3){
				  if (navigator.geolocation) {

					navigator.geolocation.getCurrentPosition(showPosition3, showError);

				  } else { 

					x.innerHTML = "Geolocation is not supported by this browser.";

				  }
			  }else{				  
				  $('#batascheckshow').modal('show');
				  
			  }
		  });
              
        function showPosition2(position) { 
          var radius = document.getElementById("max_radius").value;
          n1 = document.getElementById("longitude").value;
          t1 = document.getElementById("latitude").value;          
          if (n1.length > 0 && t1.length > 0) {
            lon = parseFloat(n1);
            lat = parseFloat(t1);            
            //alert(lat);              
            var jarak = distance(position.coords.longitude, position.coords.latitude, lon, lat);
            if (jarak > radius) {					
              //s.innerHTML = "<h5>Peringatan!, Anda diluar radius</h5>";			   
			   $('#checkpoint2show').modal('show');			   
			   //$('#checkpoint1').modal('hide');	
				var chec2 = " <input type='hidden' value="+ position.coords.longitude +" name='longitudepost'></input><br>"+
				
						      "<input type='hidden' value="+ position.coords.latitude +" name='latitudepost'></input><br>" +	
							  
				              "<input type='hidden' value='DI LUAR RADIUS' name='status_radius'></input><br>" +
							  
                              "<input type='hidden' value="+ jarak +" name='jarak'></input>";
							  
							   $('#inpoyformchc2').html(chec2);	
				
            }else{				
			   $('#checkpoint2show').modal('show');
			   //$('#checkpoint1').modal('hide');
			   var chec2 = "<input type='hidden' value="+ position.coords.longitude +" name='longitudepost'></input><br>"+
			   
							 "<input type='hidden' value="+ position.coords.latitude +" name='latitudepost'></input><br>" +	
						  
				             "<input type='hidden' value='DI DALAM RADIUS' name='status_radius'></input><br>" +
						  
                             "<input type='hidden' value="+ jarak +" name='jarak'></input>";
							 
							 $('#inpoyformchc2').html(chec2);
			    
			}   
						      
            var uluru = {lat: position.coords.latitude, lng: position.coords.longitude};

            var uluru_center = {lat: lat, lng: lon};

            var map = new google.maps.Map(

                document.getElementById('map'), {zoom: 12, center: uluru}
			
			);
                      
            var marker = new google.maps.Marker({

                position: uluru_center,

                map: map,

                icon: 'https://img.icons8.com/color/1x/avengers.png',

            });
            
            var marker = new google.maps.Marker({

                position: uluru,

                map: map,

                icon: 'https://img.icons8.com/color/1x/iron-man.png',

            });
            
            var meters = parseFloat(radius * 500);
          
            const circle = new google.maps.Circle({

                strokeColor: "#007bff",

                strokeOpacity: 0.8,

                strokeWeight: 2,

                fillColor: "#007bff",

                fillOpacity: 0.35,

                map,

                center: uluru_center,

                radius: meters

            });
         
          }else{

            x.innerHTML = "Silahkan isi Longitude & Latitude"

            s.innerHTML = "-"

          }

        }
		
	    function showPosition3(position) { 
          var radius = document.getElementById("max_radius").value;
          n1 = document.getElementById("longitude").value;
          t1 = document.getElementById("latitude").value;          
          if (n1.length > 0 && t1.length > 0) {
            lon = parseFloat(n1);
            lat = parseFloat(t1);            
            //alert(lat);              
            var jarak = distance(position.coords.longitude, position.coords.latitude, lon, lat);
            if (jarak > radius) {					
              //s.innerHTML = "<h5>Peringatan!, Anda diluar radius</h5>";			   
			   $('#checkpoint3show').modal('show');			   
			   //$('#checkpoint1').modal('hide');	
				var chec3 = "<input type='hidden' value="+ position.coords.longitude +" name='longitudepost'></input><br>"+
				
						      "<input type='hidden' value="+ position.coords.latitude +" name='latitudepost'></input><br>" +	
							  
				              "<input type='hidden' value='DI LUAR RADIUS' name='status_radius'></input><br>" +
							  
                              "<input type='hidden' value="+ jarak +" name='jarak'></input>";
							  
							  $('#inpoyformchc3').html(chec3);
				
            }else{				
			   $('#checkpoint3show').modal('show');
			   //$('#checkpoint1').modal('hide');
			   var chec3 = "<input type='hidden' value="+ position.coords.longitude +" name='longitudepost'></input><br>"+
			   
							 "<input type='hidden' value="+ position.coords.latitude +" name='latitudepost'></input><br>" +	
						  
				             "<input type='hidden' value='DI DALAM RADIUS' name='status_radius'></input><br>" +
						  
                             "<input type='hidden' value="+ jarak +" name='jarak'></input>";			
							 
							 $('#inpoyformchc3').html(chec3);
			    
			}   
						      
            var uluru = {lat: position.coords.latitude, lng: position.coords.longitude};

            var uluru_center = {lat: lat, lng: lon};

            var map = new google.maps.Map(

                document.getElementById('map'), {zoom: 12, center: uluru}
			
			);
                      
            var marker = new google.maps.Marker({

                position: uluru_center,

                map: map,

                icon: 'https://img.icons8.com/color/1x/avengers.png',

            });
            
            var marker = new google.maps.Marker({

                position: uluru,

                map: map,

                icon: 'https://img.icons8.com/color/1x/iron-man.png',

            });
            
            var meters = parseFloat(radius * 500);
          
            const circle = new google.maps.Circle({

                strokeColor: "#007bff",

                strokeOpacity: 0.8,

                strokeWeight: 2,

                fillColor: "#007bff",

                fillOpacity: 0.35,

                map,

                center: uluru_center,

                radius: meters

            });
         
          }else{

            x.innerHTML = "Silahkan isi Longitude & Latitude"

            s.innerHTML = "-"

          }

        }
		
        function showError(error) {

          switch(error.code) {

            case error.PERMISSION_DENIED:

              //x.innerHTML = "Pengguna menolak permintaan untuk GPS."
              x.innerHTML = "GPS Wajib di Aktifkan ya Thanks"

              break;

            case error.POSITION_UNAVAILABLE:

              x.innerHTML = "Informasi lokasi tidak tersedia.."

              break;

            case error.TIMEOUT:

              x.innerHTML = "Waktu permintaan untuk mendapatkan lokasi pengguna habis."

              break;

            case error.UNKNOWN_ERROR:

              x.innerHTML = "Terjadi kesalahan yang tidak diketahui."

              break;

          }

        }

        
        function distance(lon1, lat1, lon2, lat2) {

          var R = 6371; // Radius bumi dalam km

          var dLat = (lat2-lat1).toRad();  // Fungsi javascript dalam radians

          var dLon = (lon2-lon1).toRad(); 

          var a = Math.sin(dLat/2) * Math.sin(dLat/2) +

                  Math.cos(lat1.toRad()) * Math.cos(lat2.toRad()) * 

                  Math.sin(dLon/2) * Math.sin(dLon/2); 

          var c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1-a)); 

          var d = R * c; // Jarak dalam km

          return round(d);

        }

        

        if (typeof(Number.prototype.toRad) === "undefined") {

          Number.prototype.toRad = function() {

            return this * Math.PI / 180;

          }

        }

        

        function deg2rad(deg) {

		rad = deg * Math.PI/180; // radians = degrees * pi/180

		return rad;

	}

        

        function round(x) {

            return Math.round( x * 1000) / 1000;

        }
 

</script>