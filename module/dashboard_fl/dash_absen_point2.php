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
              <div class="box box-success" tooltipPosition="auto" data-step="0" 
              data-intro="">
                <div class="box-header">
                  <h3 class="box-title">Check Position  <small><?php echo $tgl->tgl_indo($date);?></small></h3>
                  <!-- tools box -->
                  <div class="pull-right box-tools">
                  	
                    <button class="btn btn-info btn-sm" data-widget='remove' data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
                  </div><!-- /. tools -->
                </div><!-- /.box-header -->
                <div class="box-header">
                <!--<div class="box-footer">
                  <div class="alert alert-default alert-dismissable">
				  
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <h4><i class="icon fa fa-warning"></i> PERHATIAN!</h4>
                    *) Check Posisi 2 dilakukan <strong>3 jam setelah absen masuk</strong> dan batas check posisi 2 setelah muncul adalah <strong>10 menit</strong>.<br>
                    *) Check Posisi 3 dilakukan <strong>6 jam setelah absen masuk</strong> dan batas check posisi 3 setelah muncul adalah <strong>10 menit</strong>.<br> 
					
                  </div>
                </div>-->
				<div class="col-sm-5">
                <form action="" method="post">			               					
				    <?php
					 $chc_tgl_masuk = $date;
					 $chc_tampil_kar = $chc->chc_tampil_kar($chc_tgl_masuk,$kar_id);
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
					 
					$abs_tampil_kar=$abs->abs_tampil_kar($kar_id,$chc_tgl_masuk);
					$datashift=mysql_fetch_array($abs_tampil_kar);
					$shift_msk=$datashift['abs_shift'];
					if($shift_msk == "Shift Pagi"){
						if($kar_id == '255'){
						   $jamcheck2="11:00";
						}else{
						   $jamcheck2="11:00";
						}
						if($kar_id == '255'){
						   $jamcheck3="14:00";
						}else{
						   $jamcheck3="14:00";
						}						
					}elseif($shift_msk == "Shift Siang"){
						if($kar_data['div_id']== 8){
						   $jamcheck2="14:00";
						   $jamcheck3="16:00";
						}else{
						   $jamcheck2="17:00";
						   $jamcheck3="20:00";
						}						
					}elseif($shift_msk == "Shift Sore"){
						if($kar_id == '542'){
						   $jamcheck2="16:49";
						}else{
						   $jamcheck2="16:00";;
						}
						
						$jamcheck3="19:00";
					}elseif($shift_msk == "Shift Malam"){
						$jamcheck2="23:00";
						//$jamcheck3="03:00";
					}
					
					 $waktucheck2=$jamcheck2;
					 $waktucheck3=$jamcheck3;
					 
					 $waktu=date('H:i', strtotime($time));
									 
					 $datetimecheck2 = date("Y-m-d")." ".$waktucheck2.":00";
					 $waktuberakhircheck2 = date('H:i', strtotime('+10 minutes', strtotime($datetimecheck2)));
					 
					 $datetimecheck3 = date("Y-m-d")." ".$waktucheck3.":00";
					 $waktuberakhircheck3 = date('H:i', strtotime('+10 minutes', strtotime($datetimecheck3)));
					 
					 // echo "realtime --".$waktu."<br>" ;				 
					 // echo "penambahan 3 jam setelah absen masuk --".$waktucheck2."<br>" ;					 
					 // echo "batas akhir + 10 minutes --".$waktuberakhircheck2."<br>" ;				 
					 // echo "penambahan 6 jam setelah absen masuk --".$waktucheck3."<br>" ;					 
					 // echo "batas akhir + 10 minutes --".$waktuberakhircheck3."<br>" ;
         
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
                	<button type="<?php echo $type; ?>" name="<?php echo $name; ?>" data-toggle="modal" data-target="#" id="<?php echo $checkok;?>"  class="btn btn-primary btn-lg"><i class="fa fa-sign-in"></i> Check Position 2</button>
					<?php }else{?>
					<button type="<?php echo $type; ?>" name="" data-toggle="<?php echo $toggle; ?>" data-target="#" id="#"  class="btn btn-success btn-lg" disabled><i class="fa fa-sign-in"></i> Wajib Gunakan HP</button>
					<?php }?>
					<input type="hidden" class="form-control" id="waktucheck2" value="<?php echo $waktucheck2;?>">
					<input type="hidden" class="form-control" id="waktuberakhircheck2" value="<?php echo $waktuberakhircheck2;?>">
					<div id="posisi"></div>
				    <div id="status"></div>
					 <!-- penambahan 1 -->	
					 <?php }else{?>
					   <button type="button" class="btn btn-danger btn-lg" disabled><i class="fa fa-smile-o"></i> Thanks Check Position 2 done</button>    
					 <?php }?>
					
					 <?php }?>
                </div>
                <div class="col-sm-5">		               					
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
                	<button type="<?php echo $type; ?>" name="<?php echo $name; ?>" data-toggle="modal" data-target="#" id="<?php echo $checkok;?>"  class="btn btn-primary btn-lg"><i class="fa fa-sign-in"></i> Check Position 3</button>
					<?php }else{?>
					<button type="<?php echo $type; ?>" name="" data-toggle="<?php echo $toggle; ?>" data-target="#" id="#"  class="btn btn-success btn-lg" disabled><i class="fa fa-sign-in"></i> Wajib Gunakan HP</button>
					<?php }?>					
					<input type="hidden" class="form-control" id="waktucheck3" value="<?php echo $waktucheck3;?>">
					<input type="hidden" class="form-control" id="waktuberakhircheck3" value="<?php echo $waktuberakhircheck3;?>">
					 <div id="posisi"></div>
				     <div id="status"></div>
					 <!-- penambahan 2 -->	
					 <?php }else{?>
					   <button type="button" class="btn btn-danger btn-lg" disabled><i class="fa fa-smile-o"></i>  Thanks Check Position 3 done</button>    
					 <?php }?>
					
				     <?php }?>									
                </form>
				<?php }?>
				</div>
                </div>
              </div><!-- /.box -->
			  


			  
<!-- batas check point -->
<div class="modal fade" id="batascheckshow" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-md">
    <div class="modal-content">
      <div class="modal-header bg-yellow">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel"><i class="fa fa-meh-o"></i> Peringatan!</h4>
      </div>
      <div class="modal-body">
	<div class="row">
	  <div class="col-sm-12">
	    <center>
	    <h4>
	      <i class="icon fa fa-warning"></i>
	      <strong>Mohon maaf batas check position Anda<br>sudah habis.</strong>
	    </h4>
	    </center>
	  </div>
	</div>
      </div>
    </div>
  </div>
</div>

<!-- Check Position 2 -->
<div class="modal fade" id="checkpoint2show" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-md">
    <div class="modal-content">
      <div class="modal-header bg-purple">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel"><i class="fa fa-smile-o"> Check Position 2</i></h4>
      </div>
      <div class="modal-body">
	<form class="form-horizontal" action="" method="post">
	<div id="inpoyformchc2"></div>
	<center>
	  <button type="submit" name="checkpoint2post" class="btn btn-success btn-lg"><i class="fa fa-sign-in"></i> Confirm</button>
	</center>
	</form>
      </div>
    </div>
  </div>
</div>

<!-- Check Position 3  -->
<div class="modal fade" id="checkpoint3show" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-md">
    <div class="modal-content">
      <div class="modal-header bg-purple">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel"><i class="fa fa-smile-o"> Check Position 3</i></h4>
      </div>
      <div class="modal-body">
	<form class="form-horizontal" action="" method="post">
	  <div id="inpoyformchc3"></div>
	  <center>
	    <button type="submit" name="checkpoint3post" class="btn btn-success btn-lg"><i class="fa fa-sign-in"></i> Confirm</button>
	  </center>
	</form>
      </div>
    </div>
  </div>
</div>


<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDcoUbTUBMZm42oPa2O2HE-iJCWSQtiwU8&callback" async defer></script>
<script>
  var x = document.getElementById("posisi");
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
     
    if(waktu >= waktucheck2 && waktu <= waktuberakhircheck2){
      if (navigator.geolocation) {
	//navigator.geolocation.getCurrentPosition(showPosition2, showError);
	navigator.geolocation.watchPosition(showPosition2, showError);
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
     
     if(waktu >= waktucheck3 && waktu <= waktuberakhircheck3){
      if (navigator.geolocation) {
        navigator.geolocation.watchPosition(showPosition3, showError);
      } else { 
	x.innerHTML = "Geolocation is not supported by this browser.";
      }
    }else{			  
      $('#batascheckshow').modal('show'); 
    }
  });
              
  function showPosition2(position) { 
	 $('#checkpoint2show').modal('show');

	var domhtml = "<input type='hidden' class='form-control' value="+ position.coords.longitude +" name='longitudepost' id='longitudepost'></input>"+
		"<input type='hidden' class='form-control' value="+ position.coords.latitude +" name='latitudepost' id='latitudepost'></input>";
		$('#inpoyformchc2').html(domhtml);
		   
  }
		
  function showPosition3(position) { 
     $('#checkpoint3show').modal('show');

	var domhtml = "<input type='hidden' class='form-control' value="+ position.coords.longitude +" name='longitudepost' id='longitudepost'></input>"+
		"<input type='hidden' class='form-control' value="+ position.coords.latitude +" name='latitudepost' id='latitudepost'></input>";
		$('#inpoyformchc3').html(domhtml);
		
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