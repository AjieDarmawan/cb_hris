<?php
//Absen Variable
$abs_masuk=$time;
$abs_pulang=$time;
$abs_ip=$ip_jaringan;
$abs_tgl_masuk=$date;
$abs_tgl_pulang=$date;
$abs_alasan_masuk=ucwords($_POST['abs_alasan_masuk']);
$abs_alasan_pulang=ucwords($_POST['abs_alasan_pulang']);
$unt_id=$kar_data['unt_id'];
$ktr_id=$kar_data['ktr_id'];
$location=$_POST['location'];
$shift=$_POST['abs_shift'];

//Post Variable
//$pos_msg=ucwords($_POST['pos_msg']);
$pos_msg=$_POST['pos_msg'];
$pos_lok=str_replace(' ', '_', $_FILES['pos_atc']['tmp_name']);
$pos_atc=str_replace(' ', '_', $_FILES['pos_atc']['name']);
$pos_size=$_FILES['pos_atc']['size'];
$pos_type=$_FILES['pos_atc']['type'];
$pos_pecah=explode(".", $pos_atc);
$pos_extend=$pos_pecah[1];
$pos_tgl=$date;
$pos_jam=$time;
$mrk_id=$_POST['mrk_id'];
$text="bismillah";

//check point//
$chc_nik = $kar_data['kar_nik'];
$chc_nm = $kar_data['kar_nm'];
$latitudepost = $_POST['latitudepost'];
$longitudepost = $_POST['longitudepost'];
//check point//
function distance($lat1, $lon1, $lat2, $lon2, $unit) {
  if (($lat1 == $lat2) && ($lon1 == $lon2)) {
    return 0;
  }
  else {
    $theta = $lon1 - $lon2;
    $dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) +  cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
    $dist = acos($dist);
    $dist = rad2deg($dist);
    $miles = $dist * 60 * 1.1515;
    $unit = strtoupper($unit);

    if ($unit == "K") {
      return ($miles * 1.609344);
    } else if ($unit == "N") {
      return ($miles * 0.8684);
    } else {
      return $miles;
    }
  }
}

if(isset($_POST['babsmasuk'])){
	
				$string_loc = $location;
				$array_wfh  = array(171, 172, 173); //WFH Location
				
				if(in_array($string_loc, $array_wfh)){
					$kar_lat = $kar_data['kar_lat'];
					$kar_long = $kar_data['kar_long'];							
					$kar_radius = $kar_data['kar_radius'];	
					$abs_dtl_type = "WFH";
				}else{
					$ktr_tampil_id =$ktr->ktr_tampil_id($location);
					$latlongdata=mysql_fetch_array($ktr_tampil_id);
					$kar_lat = $latlongdata['ktr_lat'];
					$kar_long = $latlongdata['ktr_long'];
					$kar_radius = $latlongdata['ktr_radius'];
					$abs_dtl_type = "WFO";
				}
				//pengkondisian lock lokasi absen//
				/*
				if($kar_id){
					if(($exp_data[$date_int] !== "WFH" && $exp_data[$date_int] !== "WFH-M" && $abs_dtl_type == "WFH") || ($exp_data[$date_int] == "WFH" && $abs_dtl_type == "WFO")){
						echo "<script>alert('Pilih Lokasi sesuai jadwal, Terima kasih');document.location='media.php';</script>'";
						exit;
					}
				}
				*/
				//pengkondisian lock lokasi absen//
				$latlong = $latitudepost."#".$longitudepost."#".$kar_lat."#".$kar_long."#".$kar_radius."#".$abs_dtl_type;
				$jarak = distance($kar_lat, $kar_long, $latitudepost, $longitudepost, 'K');
				if ($jarak < (float)$kar_radius) {
					$status_radius = "DI DALAM RADIUS";
				} else {
					$status_radius = "DI LUAR RADIUS";
				}		
				//pengkondisian lock unit//
				
				if($_SESSION['kar'] == 247 || $_SESSION['kar'] == 413){
					if($status_radius == "DI LUAR RADIUS"){
						echo "<script>alert('Sistem telah menditeksi Anda diharuskan absensi di Kampus Terima kasih');document.location='media.php';</script>'";
						exit;
					}
				}
				
				//pengkondisian lock unit//
				$ip_tampil_location=$ip->ip_tampil_location($location);
				$ip_data=mysql_fetch_array($ip_tampil_location);

				if($ip_data['typ_id']=="1"){
					if($ip_data['ip_release']!==$date){
							$ip_update_location_static=$ip->ip_update_location_static($date,$location);
					}
				}
				elseif($ip_data['typ_id']=="2"){
					if($ip_data['ip_release']!==$date){
							$ip_update_location_dynamic=$ip->ip_update_location_dynamic($ip_jaringan,$date,$location);
					}
				}	

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
				
				//PENAMBAHAN//
				//Range Tepat Pagi
				$abs_stm_nm="Jam Tepat Pagi";
                                $abs_settime_id=$abt->abs_settime_id($abs_stm_nm);
                                $abs_settime_data=mysql_fetch_array($abs_settime_id);
				if(!empty($kar_data['ktr_default_shift1_in']) && !empty($kar_data['ktr_default_shift1_out'])){
					if(!empty($kar_data['kar_default_shift1_in']) && !empty($kar_data['kar_default_shift1_out'])){
						$jam_tepat_pagi=substr($kar_data['kar_default_shift1_in'], 0,5);
					}else{
						$jam_tepat_pagi=substr($kar_data['ktr_default_shift1_in'], 0,5);
					}
				}else{
					if(!empty($kar_data['kar_default_shift1_in']) && !empty($kar_data['kar_default_shift1_out'])){
						$jam_tepat_pagi=substr($kar_data['kar_default_shift1_in'], 0,5);
					}else{
						$jam_tepat_pagi=substr($abs_settime_data['abs_stm_jam'], 0,5);
					}
				}
				
				//PENAMBAHAN//
				//Range Tepat Siang
				$abs_stm_nm="Jam Tepat Siang";
                                $abs_settime_id=$abt->abs_settime_id($abs_stm_nm);
                                $abs_settime_data=mysql_fetch_array($abs_settime_id);
				if(!empty($kar_data['ktr_default_shift1_in']) && !empty($kar_data['ktr_default_shift1_out'])){
					if(!empty($kar_data['kar_default_shift1_in']) && !empty($kar_data['kar_default_shift1_out'])){
						$jam_tepat_siang=substr($kar_data['kar_default_shift1_in'], 0,5);
					}else{
						$jam_tepat_siang=substr($kar_data['ktr_default_shift1_in'], 0,5);
					}
				}else{
					if(!empty($kar_data['kar_default_shift1_in']) && !empty($kar_data['kar_default_shift1_out'])){
						$jam_tepat_siang=substr($kar_data['kar_default_shift1_in'], 0,5);
					}else{
						$jam_tepat_siang=substr($abs_settime_data['abs_stm_jam'], 0,5);
					}
				}
				
				//PENAMBAHAN//
				//Range Tepat Sore
				$abs_stm_nm="Jam Tepat Sore";
                                $abs_settime_id=$abt->abs_settime_id($abs_stm_nm);
                                $abs_settime_data=mysql_fetch_array($abs_settime_id);
				if(!empty($kar_data['ktr_default_shift1_in']) && !empty($kar_data['ktr_default_shift1_out'])){
					if(!empty($kar_data['kar_default_shift1_in']) && !empty($kar_data['kar_default_shift1_out'])){
						$jam_tepat_sore=substr($kar_data['kar_default_shift1_in'], 0,5);
					}else{
						$jam_tepat_sore=substr($kar_data['ktr_default_shift1_in'], 0,5);
					}
				}else{
					if(!empty($kar_data['kar_default_shift1_in']) && !empty($kar_data['kar_default_shift1_out'])){
						$jam_tepat_sore=substr($kar_data['kar_default_shift1_in'], 0,5);
					}else{
						$jam_tepat_sore=substr($abs_settime_data['abs_stm_jam'], 0,5);
					}
				}
				
				//PENAMBAHAN//
				//Range Tepat Malam
				$abs_stm_nm="Jam Tepat Malam";
                                $abs_settime_id=$abt->abs_settime_id($abs_stm_nm);
                                $abs_settime_data=mysql_fetch_array($abs_settime_id);
				if(!empty($kar_data['ktr_default_shift1_in']) && !empty($kar_data['ktr_default_shift1_out'])){
					if(!empty($kar_data['kar_default_shift1_in']) && !empty($kar_data['kar_default_shift1_out'])){
						$jam_tepat_malam=substr($kar_data['kar_default_shift1_in'], 0,5);
					}else{
						$jam_tepat_malam=substr($kar_data['ktr_default_shift1_in'], 0,5);
					}
				}else{
					if(!empty($kar_data['kar_default_shift1_in']) && !empty($kar_data['kar_default_shift1_out'])){
						$jam_tepat_malam=substr($kar_data['kar_default_shift1_in'], 0,5);
					}else{
						$jam_tepat_malam=substr($abs_settime_data['abs_stm_jam'], 0,5);
					}
				}

				if ($shift == "Shift Pagi"){
					
					$abs_shift="Shift Pagi";
						if($waktu_jam_menit > $jam_telat_pagi){
							$abs_rwd_masuk="Telat";
                                                        $abs_point=30;
							$abs_masuk=$abs->abs_masuk_telat($abs_masuk,$abs_ip,$abs_tgl_masuk,$abs_alasan_masuk,$abs_shift,$abs_rwd_masuk,$abs_point,$kar_id);
							$chc_insert_masuk=$chc->chc_insert_masuk($abs_tgl_masuk, $chc_nik, $chc_nm, $time, $latlong, $status_radius, $location, $jarak, $kar_id);
                                                        //Notify
							$ntf_id=mysql_insert_id();
                                                        $ntf_act="Absen Masuk";
                                                        $ntf_isi=$ntf_id.'-'.$abs_shift.'-'.$abs_rwd_masuk.'-'.$abs_point.'-'.$abs_alasan_masuk;
                                                        $ntf_ip=$ip_jaringan;
                                                        $ntf_tgl=$date;
                                                        $ntf_jam=$time;
                                                        $ntf_insert=$ntf->ntf_insert($ntf_act,$ntf_isi,$ntf_ip,$ntf_tgl,$ntf_jam,$kar_id);
                                                        //End Notify
                                                
                                                }
						elseif($waktu_jam_menit < $jam_tepat_pagi){
							$abs_rwd_masuk="Rajin";
                                                        $abs_point=80;
							$abs_masuk=$abs->abs_masuk($abs_masuk,$abs_ip,$abs_tgl_masuk,$abs_shift,$abs_rwd_masuk,$abs_point,$kar_id);
							$chc_insert_masuk=$chc->chc_insert_masuk($abs_tgl_masuk, $chc_nik, $chc_nm, $time, $latlong, $status_radius, $location, $jarak, $kar_id);
                                                        //Notify
							$ntf_id=mysql_insert_id();
                                                        $ntf_act="Absen Masuk";
                                                        $ntf_isi=$ntf_id.'-'.$abs_shift.'-'.$abs_rwd_masuk.'-'.$abs_point.'-'.$abs_alasan_masuk;
                                                        $ntf_ip=$ip_jaringan;
                                                        $ntf_tgl=$date;
                                                        $ntf_jam=$time;
                                                        $ntf_insert=$ntf->ntf_insert($ntf_act,$ntf_isi,$ntf_ip,$ntf_tgl,$ntf_jam,$kar_id);
                                                        //End Notify
                                                        
                                                }
						elseif($waktu_jam_menit = $jam_tepat_pagi){
							$abs_rwd_masuk="Tepat";
                                                        $abs_point=50;
							$abs_masuk=$abs->abs_masuk($abs_masuk,$abs_ip,$abs_tgl_masuk,$abs_shift,$abs_rwd_masuk,$abs_point,$kar_id);
							$chc_insert_masuk=$chc->chc_insert_masuk($abs_tgl_masuk, $chc_nik, $chc_nm, $time, $latlong, $status_radius, $location, $jarak, $kar_id);
                                                        //Notify
							$ntf_id=mysql_insert_id();
                                                        $ntf_act="Absen Masuk";
                                                        $ntf_isi=$ntf_id.'-'.$abs_shift.'-'.$abs_rwd_masuk.'-'.$abs_point.'-'.$abs_alasan_masuk;
                                                        $ntf_ip=$ip_jaringan;
                                                        $ntf_tgl=$date;
                                                        $ntf_jam=$time;
                                                        $ntf_insert=$ntf->ntf_insert($ntf_act,$ntf_isi,$ntf_ip,$ntf_tgl,$ntf_jam,$kar_id);
                                                        //End Notify
                                                        
                                                }else{
							$abs_rwd_masuk="Error";
						}
					
				}else if ($shift == "Shift Siang"){
					
					$abs_shift="Shift Siang";
						if($waktu_jam_menit > $jam_telat_siang){
							$abs_rwd_masuk="Telat";
                                                        $abs_point=30;
							$abs_masuk=$abs->abs_masuk_telat($abs_masuk,$abs_ip,$abs_tgl_masuk,$abs_alasan_masuk,$abs_shift,$abs_rwd_masuk,$abs_point,$kar_id);
							$chc_insert_masuk=$chc->chc_insert_masuk($abs_tgl_masuk, $chc_nik, $chc_nm, $time, $latlong, $status_radius, $location, $jarak, $kar_id);
                                                        //Notify
							$ntf_id=mysql_insert_id();
                                                        $ntf_act="Absen Masuk";
                                                        $ntf_isi=$ntf_id.'-'.$abs_shift.'-'.$abs_rwd_masuk.'-'.$abs_point.'-'.$abs_alasan_masuk;
                                                        $ntf_ip=$ip_jaringan;
                                                        $ntf_tgl=$date;
                                                        $ntf_jam=$time;
                                                        $ntf_insert=$ntf->ntf_insert($ntf_act,$ntf_isi,$ntf_ip,$ntf_tgl,$ntf_jam,$kar_id);
                                                        //End Notify
                                                        
                                                }
						elseif($waktu_jam_menit < $jam_tepat_siang){
							$abs_rwd_masuk="Rajin";
                                                        $abs_point=80;
							$abs_masuk=$abs->abs_masuk($abs_masuk,$abs_ip,$abs_tgl_masuk,$abs_shift,$abs_rwd_masuk,$abs_point,$kar_id);
							$chc_insert_masuk=$chc->chc_insert_masuk($abs_tgl_masuk, $chc_nik, $chc_nm, $time, $latlong, $status_radius, $location, $jarak, $kar_id);
                                                        //Notify
							$ntf_id=mysql_insert_id();
                                                        $ntf_act="Absen Masuk";
                                                        $ntf_isi=$ntf_id.'-'.$abs_shift.'-'.$abs_rwd_masuk.'-'.$abs_point.'-'.$abs_alasan_masuk;
                                                        $ntf_ip=$ip_jaringan;
                                                        $ntf_tgl=$date;
                                                        $ntf_jam=$time;
                                                        $ntf_insert=$ntf->ntf_insert($ntf_act,$ntf_isi,$ntf_ip,$ntf_tgl,$ntf_jam,$kar_id);
                                                        //End Notify
                                                        
                                                }
						elseif($waktu_jam_menit = $jam_tepat_siang){
							$abs_rwd_masuk="Tepat";
                                                        $abs_point=50;
							$abs_masuk=$abs->abs_masuk($abs_masuk,$abs_ip,$abs_tgl_masuk,$abs_shift,$abs_rwd_masuk,$abs_point,$kar_id);
							$chc_insert_masuk=$chc->chc_insert_masuk($abs_tgl_masuk, $chc_nik, $chc_nm, $time, $latlong, $status_radius, $location, $jarak, $kar_id);
                                                        //Notify
							$ntf_id=mysql_insert_id();
                                                        $ntf_act="Absen Masuk";
                                                        $ntf_isi=$ntf_id.'-'.$abs_shift.'-'.$abs_rwd_masuk.'-'.$abs_point.'-'.$abs_alasan_masuk;
                                                        $ntf_ip=$ip_jaringan;
                                                        $ntf_tgl=$date;
                                                        $ntf_jam=$time;
                                                        $ntf_insert=$ntf->ntf_insert($ntf_act,$ntf_isi,$ntf_ip,$ntf_tgl,$ntf_jam,$kar_id);
                                                        //End Notify
                                                        
                                                }else{
							$abs_rwd_masuk="Error";
						}
					
				}else if ($shift == "Shift Sore"){
				
					$abs_shift="Shift Sore";
						if($waktu_jam_menit > $jam_telat_sore){
							$abs_rwd_masuk="Telat";
                                                        $abs_point=30;
							$abs_masuk=$abs->abs_masuk_telat($abs_masuk,$abs_ip,$abs_tgl_masuk,$abs_alasan_masuk,$abs_shift,$abs_rwd_masuk,$abs_point,$kar_id);
							$chc_insert_masuk=$chc->chc_insert_masuk($abs_tgl_masuk, $chc_nik, $chc_nm, $time, $latlong, $status_radius, $location, $jarak, $kar_id);
                                                        //Notify
							$ntf_id=mysql_insert_id();
                                                        $ntf_act="Absen Masuk";
                                                        $ntf_isi=$ntf_id.'-'.$abs_shift.'-'.$abs_rwd_masuk.'-'.$abs_point.'-'.$abs_alasan_masuk;
                                                        $ntf_ip=$ip_jaringan;
                                                        $ntf_tgl=$date;
                                                        $ntf_jam=$time;
                                                        $ntf_insert=$ntf->ntf_insert($ntf_act,$ntf_isi,$ntf_ip,$ntf_tgl,$ntf_jam,$kar_id);
                                                        //End Notify
                                                        
                                                }
						elseif($waktu_jam_menit < $jam_tepat_sore){
							$abs_rwd_masuk="Rajin";
                                                        $abs_point=80;
							$abs_masuk=$abs->abs_masuk($abs_masuk,$abs_ip,$abs_tgl_masuk,$abs_shift,$abs_rwd_masuk,$abs_point,$kar_id);
							$chc_insert_masuk=$chc->chc_insert_masuk($abs_tgl_masuk, $chc_nik, $chc_nm, $time, $latlong, $status_radius, $location, $jarak, $kar_id);
                                                        //Notify
							$ntf_id=mysql_insert_id();
                                                        $ntf_act="Absen Masuk";
                                                        $ntf_isi=$ntf_id.'-'.$abs_shift.'-'.$abs_rwd_masuk.'-'.$abs_point.'-'.$abs_alasan_masuk;
                                                        $ntf_ip=$ip_jaringan;
                                                        $ntf_tgl=$date;
                                                        $ntf_jam=$time;
                                                        $ntf_insert=$ntf->ntf_insert($ntf_act,$ntf_isi,$ntf_ip,$ntf_tgl,$ntf_jam,$kar_id);
                                                        //End Notify
                                                
                                                }
						elseif($waktu_jam_menit = $jam_tepat_sore){
							$abs_rwd_masuk="Tepat";
                                                        $abs_point=50;
							$abs_masuk=$abs->abs_masuk($abs_masuk,$abs_ip,$abs_tgl_masuk,$abs_shift,$abs_rwd_masuk,$abs_point,$kar_id);
							$chc_insert_masuk=$chc->chc_insert_masuk($abs_tgl_masuk, $chc_nik, $chc_nm, $time, $latlong, $status_radius, $location, $jarak, $kar_id);
                                                        //Notify
							$ntf_id=mysql_insert_id();
                                                        $ntf_act="Absen Masuk";
                                                        $ntf_isi=$ntf_id.'-'.$abs_shift.'-'.$abs_rwd_masuk.'-'.$abs_point.'-'.$abs_alasan_masuk;
                                                        $ntf_ip=$ip_jaringan;
                                                        $ntf_tgl=$date;
                                                        $ntf_jam=$time;
                                                        $ntf_insert=$ntf->ntf_insert($ntf_act,$ntf_isi,$ntf_ip,$ntf_tgl,$ntf_jam,$kar_id);
                                                        //End Notify
                                                        
                                                }else{
							$abs_rwd_masuk="Error";
						}
					
				}else if ($shift == "Shift Malam"){
					
					$abs_shift="Shift Malam";
                                                        $abs_rwd_masuk="Rajin";
                                                        $abs_point=50;
                                                        $abs_masuk=$abs->abs_masuk($abs_masuk,$abs_ip,$abs_tgl_masuk,$abs_shift,$abs_rwd_masuk,$abs_point,$kar_id);
														$chc_insert_masuk=$chc->chc_insert_masuk($abs_tgl_masuk, $chc_nik, $chc_nm, $time, $latlong, $status_radius, $location, $jarak, $kar_id);
                                                        //Notify
                                                        $ntf_id=mysql_insert_id();
                                                        $ntf_act="Absen Masuk";
                                                        $ntf_isi=$ntf_id.'-'.$abs_shift.'-'.$abs_rwd_masuk.'-'.$abs_point.'-'.$abs_alasan_masuk;
                                                        $ntf_ip=$ip_jaringan;
                                                        $ntf_tgl=$date;
                                                        $ntf_jam=$time;
                                                        $ntf_insert=$ntf->ntf_insert($ntf_act,$ntf_isi,$ntf_ip,$ntf_tgl,$ntf_jam,$kar_id);
                                                        //End Notify
                                        
                                       
				}else {
					$abs_shift="Error";
				}

				if($abs_masuk){
					if(empty($acc_data['acc_sts'])){
						$acc_id=$acc_data['acc_id'];
						$acc_sts="A";
						$acc_update_sts=$acc->acc_update_sts($acc_id,$acc_sts);
					}
					
					$abs_dtl_tgl=$date;
					$abs_dtl_sts="H";
					$abs_dtl_tampil=$abs->abs_dtl_tampil($kar_id,$abs_dtl_tgl);
				  	$abs_dtl_cek=mysql_num_rows($abs_dtl_tampil);
					if($abs_dtl_cek > 0){
						$abs_dtl_update=$abs->abs_dtl_update($abs_dtl_tgl,$abs_dtl_sts,$kar_id);
					}else{
						//$abs_dtl_insert=$abs->abs_dtl_insert($abs_dtl_tgl,$abs_dtl_sts,$kar_id);
						$abs_dtl_insert=$abs->abs_dtl_insert_full($abs_dtl_tgl,$abs_dtl_sts,$abs_dtl_type,$location,$kar_id);
					}
					
					$ktr_tampil_id_location=$ktr->ktr_tampil_id_location($location);
					$ktr_data_id_location=mysql_fetch_array($ktr_tampil_id_location);
					$ktr_id_=$ktr_data_id_location['ktr_id'];
					$unt_id_=$ktr_data_id_location['unt_id'];
					$kar_update_location=$kar->kar_update_location($kar_id,$ktr_id_,$unt_id_);
					//$kar_update_location=$kar->kar_update_location($kar_id,$location);
					
					
				        $kduser=$acc_data['acc_username'];
				        $nmfoto = date('YmdHis');
				        $foto = "module/profile/img/".$kduser."-".$nmfoto.".jpg";
				        $encoded_data = $_POST['mydata'];
				        $binary_data = base64_decode($encoded_data);
				        $acc_img=$kduser."-".$nmfoto.".jpg";
				        if(!empty($_POST['mydata'])){
				           $acc_img_update=$acc->acc_img_update($acc_img,$kar_id);
				           if(!empty($acc_data['acc_img'])){
				             $dir_img="module/profile/img/$acc_data[acc_img]";	
				             unlink($dir_img);
				           }
				           $result = file_put_contents($foto, $binary_data);
				           //if (!$result) die("Gagal masuk ftp");
				        }
					
					echo"<script>document.location='media.php';</script>";
				}else{
					echo"<script>alert('Absen Masuk Failed');document.location='media.php';</script>";
				}
			
}
elseif(isset($_POST['babspulang'])){
	
	$abs_tampil_kar=$abs->abs_tampil_kar($kar_id,$abs_tgl_masuk);
	$abs_data=mysql_fetch_array($abs_tampil_kar);
        
        $ip_tampil_unt_ktr=$ip->ip_tampil_unt_ktr($unt_id,$ktr_id);
	$ip_data=mysql_fetch_array($ip_tampil_unt_ktr);
	
	//if($abs_data['abs_ip']==$ip_data['ip_nm']){
        $abs_ip=$ip_jaringan;

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
                $jamloyal = substr($jam_cepat_pagi , 0,2).":29";
		$jamtepat = substr($jam_cepat_pagi , 0,2).":30";
	    	if($waktu_jam_menit < $jam_cepat_pagi){
	    		$abs_rwd_pulang="Izin";
	    		$abs_point=($abs_data['abs_point']+30);
			$abs_pulang=$abs->abs_pulang_cepat($abs_pulang,$abs_ip,$abs_tgl_pulang,$abs_alasan_pulang,$abs_rwd_pulang,$abs_point,$kar_id,$abs_tgl_masuk);

                        //Notify
                        $ntf_id=mysql_insert_id();
	    		$ntf_act="Absen Pulang";
                        $ntf_isi=$ntf_id.'-'.$abs_shift.'-'.$abs_rwd_pulang.'-'.$abs_point.'-'.$abs_alasan_pulang;
                        $ntf_ip=$ip_jaringan;
                        $ntf_tgl=$date;
                        $ntf_jam=$time;
                        $ntf_insert=$ntf->ntf_insert($ntf_act,$ntf_isi,$ntf_ip,$ntf_tgl,$ntf_jam,$kar_id);
                        //End Notify

	    	}elseif($waktu_jam_menit > $jamloyal){
	    		$abs_rwd_pulang="Loyal";
	    		$abs_point=($abs_data['abs_point']+80);
			$abs_pulang=$abs->abs_pulang($abs_pulang,$abs_ip,$abs_tgl_pulang,$abs_rwd_pulang,$abs_point,$kar_id,$abs_tgl_masuk);

                        //Notify
                        $ntf_id=mysql_insert_id();
	    		$ntf_act="Absen Pulang";
                        $ntf_isi=$ntf_id.'-'.$abs_shift.'-'.$abs_rwd_pulang.'-'.$abs_point.'-'.$abs_alasan_pulang;
                        $ntf_ip=$ip_jaringan;
                        $ntf_tgl=$date;
                        $ntf_jam=$time;
                        $ntf_insert=$ntf->ntf_insert($ntf_act,$ntf_isi,$ntf_ip,$ntf_tgl,$ntf_jam,$kar_id);
                        //End Notify

	    	}elseif($waktu_jam_menit >= $jam_cepat_pagi && $waktu_jam_menit < $jamtepat){
	    		$abs_rwd_pulang="Tepat";
	    		$abs_point=($abs_data['abs_point']+50);
			$abs_pulang=$abs->abs_pulang($abs_pulang,$abs_ip,$abs_tgl_pulang,$abs_rwd_pulang,$abs_point,$kar_id,$abs_tgl_masuk); 

                        //Notify
                        $ntf_id=mysql_insert_id();
	    		$ntf_act="Absen Pulang";
                        $ntf_isi=$ntf_id.'-'.$abs_shift.'-'.$abs_rwd_pulang.'-'.$abs_point.'-'.$abs_alasan_pulang;
                        $ntf_ip=$ip_jaringan;
                        $ntf_tgl=$date;
                        $ntf_jam=$time;
                        $ntf_insert=$ntf->ntf_insert($ntf_act,$ntf_isi,$ntf_ip,$ntf_tgl,$ntf_jam,$kar_id);
                        //End Notify
	    	}

	    }elseif($abs_data['abs_shift']=="Shift Siang"){
                $jamloyal = substr($jam_cepat_siang , 0,2).":29";
		$jamtepat = substr($jam_cepat_siang , 0,2).":30";
	    	if($waktu_jam_menit < $jam_cepat_siang){
	    		$abs_rwd_pulang="Izin";
	    		$abs_point=($abs_data['abs_point']+30);
			$abs_pulang=$abs->abs_pulang_cepat($abs_pulang,$abs_ip,$abs_tgl_pulang,$abs_alasan_pulang,$abs_rwd_pulang,$abs_point,$kar_id,$abs_tgl_masuk);

                        //Notify
                        $ntf_id=mysql_insert_id();
	    		$ntf_act="Absen Pulang";
                        $ntf_isi=$ntf_id.'-'.$abs_shift.'-'.$abs_rwd_pulang.'-'.$abs_point.'-'.$abs_alasan_pulang;
                        $ntf_ip=$ip_jaringan;
                        $ntf_tgl=$date;
                        $ntf_jam=$time;
                        $ntf_insert=$ntf->ntf_insert($ntf_act,$ntf_isi,$ntf_ip,$ntf_tgl,$ntf_jam,$kar_id);
                        //End Notify

	    	}elseif($waktu_jam_menit > $jamloyal){
	    		$abs_rwd_pulang="Loyal";
	    		$abs_point=($abs_data['abs_point']+80);
			$abs_pulang=$abs->abs_pulang($abs_pulang,$abs_ip,$abs_tgl_pulang,$abs_rwd_pulang,$abs_point,$kar_id,$abs_tgl_masuk);

                        //Notify
                        $ntf_id=mysql_insert_id();
	    		$ntf_act="Absen Pulang";
                        $ntf_isi=$ntf_id.'-'.$abs_shift.'-'.$abs_rwd_pulang.'-'.$abs_point.'-'.$abs_alasan_pulang;
                        $ntf_ip=$ip_jaringan;
                        $ntf_tgl=$date;
                        $ntf_jam=$time;
                        $ntf_insert=$ntf->ntf_insert($ntf_act,$ntf_isi,$ntf_ip,$ntf_tgl,$ntf_jam,$kar_id);
                        //End Notify

	    	}elseif($waktu_jam_menit >= $jam_cepat_siang && $waktu_jam_menit < $jamtepat){
	    		$abs_rwd_pulang="Tepat";
	    		$abs_point=($abs_data['abs_point']+50);
			$abs_pulang=$abs->abs_pulang($abs_pulang,$abs_ip,$abs_tgl_pulang,$abs_rwd_pulang,$abs_point,$kar_id,$abs_tgl_masuk);

                        //Notify
                        $ntf_id=mysql_insert_id();
                        $ntf_act="Absen Pulang";
                        $ntf_isi=$ntf_id.'-'.$abs_shift.'-'.$abs_rwd_pulang.'-'.$abs_point.'-'.$abs_alasan_pulang;
                        $ntf_ip=$ip_jaringan;
                        $ntf_tgl=$date;
                        $ntf_jam=$time;
                        $ntf_insert=$ntf->ntf_insert($ntf_act,$ntf_isi,$ntf_ip,$ntf_tgl,$ntf_jam,$kar_id);
                        //End Notify 
	    	}
	    }elseif($abs_data['abs_shift']=="Shift Sore"){
                $jamloyal = substr($jam_cepat_sore , 0,2).":29";
		$jamtepat = substr($jam_cepat_sore , 0,2).":30";
	    	if($waktu_jam_menit < $jam_cepat_sore){
	    		$abs_rwd_pulang="Izin";
	    		$abs_point=($abs_data['abs_point']+30);
			$abs_pulang=$abs->abs_pulang_cepat($abs_pulang,$abs_ip,$abs_tgl_pulang,$abs_alasan_pulang,$abs_rwd_pulang,$abs_point,$kar_id,$abs_tgl_masuk);

                        //Notify
                        $ntf_id=mysql_insert_id();
	    		$ntf_act="Absen Pulang";
                        $ntf_isi=$ntf_id.'-'.$abs_shift.'-'.$abs_rwd_pulang.'-'.$abs_point.'-'.$abs_alasan_pulang;
                        $ntf_ip=$ip_jaringan;
                        $ntf_tgl=$date;
                        $ntf_jam=$time;
                        $ntf_insert=$ntf->ntf_insert($ntf_act,$ntf_isi,$ntf_ip,$ntf_tgl,$ntf_jam,$kar_id);
                        //End Notify

	    	}elseif($waktu_jam_menit > $jamloyal){
	    		$abs_rwd_pulang="Loyal";
	    		$abs_point=($abs_data['abs_point']+80);
			$abs_pulang=$abs->abs_pulang($abs_pulang,$abs_ip,$abs_tgl_pulang,$abs_rwd_pulang,$abs_point,$kar_id,$abs_tgl_masuk);

                        //Notify
                        $ntf_id=mysql_insert_id();
	    		$ntf_act="Absen Pulang";
                        $ntf_isi=$ntf_id.'-'.$abs_shift.'-'.$abs_rwd_pulang.'-'.$abs_point.'-'.$abs_alasan_pulang;
                        $ntf_ip=$ip_jaringan;
                        $ntf_tgl=$date;
                        $ntf_jam=$time;
                        $ntf_insert=$ntf->ntf_insert($ntf_act,$ntf_isi,$ntf_ip,$ntf_tgl,$ntf_jam,$kar_id);
                        //End Notify

	    	}elseif($waktu_jam_menit >= $jam_cepat_sore && $waktu_jam_menit < $jamtepat){
	    		$abs_rwd_pulang="Tepat";
	    		$abs_point=($abs_data['abs_point']+50);
			$abs_pulang=$abs->abs_pulang($abs_pulang,$abs_ip,$abs_tgl_pulang,$abs_rwd_pulang,$abs_point,$kar_id,$abs_tgl_masuk); 

                        //Notify
                        $ntf_id=mysql_insert_id();
	    		$ntf_act="Absen Pulang";
                        $ntf_isi=$ntf_id.'-'.$abs_shift.'-'.$abs_rwd_pulang.'-'.$abs_point.'-'.$abs_alasan_pulang;
                        $ntf_ip=$ip_jaringan;
                        $ntf_tgl=$date;
                        $ntf_jam=$time;
                        $ntf_insert=$ntf->ntf_insert($ntf_act,$ntf_isi,$ntf_ip,$ntf_tgl,$ntf_jam,$kar_id);
                        //End Notify
	    	}
	    }elseif($abs_data['abs_shift']=="Shift Malam"){

	    		$abs_rwd_pulang="Loyal";
	    		$abs_point=($abs_data['abs_point']+50);
			$abs_pulang=$abs->abs_pulang($abs_pulang,$abs_ip,$abs_tgl_pulang,$abs_rwd_pulang,$abs_point,$kar_id,$abs_tgl_masuk); 

                        //Notify
                        $ntf_id=mysql_insert_id();
	    		$ntf_act="Absen Pulang";
                        $ntf_isi=$ntf_id.'-'.$abs_shift.'-'.$abs_rwd_pulang.'-'.$abs_point.'-'.$abs_alasan_pulang;
                        $ntf_ip=$ip_jaringan;
                        $ntf_tgl=$date;
                        $ntf_jam=$time;
                        $ntf_insert=$ntf->ntf_insert($ntf_act,$ntf_isi,$ntf_ip,$ntf_tgl,$ntf_jam,$kar_id);
                        //End Notify

	    }else{
	    	die();
	    }


	    
		if($abs_pulang){
			
				$kduser=$acc_data['acc_username'];
				$nmfoto = date('YmdHis');
				$foto = "module/profile/img/".$kduser."-".$nmfoto.".jpg";
				$encoded_data = $_POST['mydata2'];
				$binary_data = base64_decode($encoded_data);
				$acc_img=$kduser."-".$nmfoto.".jpg";
				if(!empty($_POST['mydata2'])){
				   $acc_img_update=$acc->acc_img_update($acc_img,$kar_id);
				   if(!empty($acc_data['acc_img'])){
				     $dir_img="module/profile/img/$acc_data[acc_img]";	
				     unlink($dir_img);
				   }
				   $result = file_put_contents($foto, $binary_data);
				   //if (!$result) die("Gagal masuk ftp");
				}	
				
			echo"<script>document.location='media.php';</script>";
		}else{
			echo"<script>alert('Absen Pulang Failed');document.location='media.php';</script>";
		}
	//}else{
		//echo"<script>alert('Maaf Anda tidak dapat melakukan Absen Pulang sebelum mengkonfirmasikan Absen Masuk Anda ke Departement SDM');document.location='media.php';</script>";
	//}
}
elseif(isset($_POST['babspulangmalam'])){
	$abs_tgl_las=$kemarin;
	$abs_tampil_las=$abs->abs_tampil_las($kar_id,$abs_tgl_las);
	$abs_data=mysql_fetch_array($abs_tampil_las);
        
        $ip_tampil_unt_ktr=$ip->ip_tampil_unt_ktr($unt_id,$ktr_id);
	$ip_data=mysql_fetch_array($ip_tampil_unt_ktr);
	
	//if($abs_data['abs_ip']==$ip_data['ip_nm']){
        $abs_ip=$ip_jaringan;

                //NEW CHANGE
		$waktu_jam_menit=substr($time, 0,5);

		//Range Pagi
		$abs_stm_nm="Jam Cepat Pagi";
                $abs_settime_id=$abs->abs_settime_id($abs_stm_nm);
                $abs_settime_data=mysql_fetch_array($abs_settime_id);
		$jam_cepat_pagi=substr($abs_settime_data['abs_stm_jam'], 0,5);

		//Range Siang
		$abs_stm_nm="Jam Cepat Siang";
                $abs_settime_id=$abs->abs_settime_id($abs_stm_nm);
                $abs_settime_data=mysql_fetch_array($abs_settime_id);
		$jam_cepat_siang=substr($abs_settime_data['abs_stm_jam'], 0,5);

		//Range Sore
		$abs_stm_nm="Jam Cepat Sore";
                $abs_settime_id=$abs->abs_settime_id($abs_stm_nm);
                $abs_settime_data=mysql_fetch_array($abs_settime_id);
		$jam_cepat_sore=substr($abs_settime_data['abs_stm_jam'], 0,5);

		//Range Malam
		$abs_stm_nm="Jam Cepat Malam";
                $abs_settime_id=$abs->abs_settime_id($abs_stm_nm);
                $abs_settime_data=mysql_fetch_array($abs_settime_id);
		$jam_cepat_malam=substr($abs_settime_data['abs_stm_jam'], 0,5);

	    if($abs_data['abs_shift']=="Shift Pagi"){
	    	if($waktu_jam_menit < $jam_cepat_pagi){
	    		$abs_rwd_pulang="Izin";
	    		$abs_point=($abs_data['abs_point']+30);
			$abs_pulang=$abs->abs_pulang_cepat($abs_pulang,$abs_ip,$abs_tgl_pulang,$abs_alasan_pulang,$abs_rwd_pulang,$abs_point,$kar_id,$abs_tgl_las);

                        //Notify
                        $ntf_id=mysql_insert_id();
	    		$ntf_act="Absen Pulang";
                        $ntf_isi=$ntf_id.'-'.$abs_shift.'-'.$abs_rwd_pulang.'-'.$abs_point.'-'.$abs_alasan_pulang;
                        $ntf_ip=$ip_jaringan;
                        $ntf_tgl=$date;
                        $ntf_jam=$time;
                        $ntf_insert=$ntf->ntf_insert($ntf_act,$ntf_isi,$ntf_ip,$ntf_tgl,$ntf_jam,$kar_id);
                        //End Notify

	    	}elseif($waktu_jam_menit > "17:29"){
	    		$abs_rwd_pulang="Loyal";
	    		$abs_point=($abs_data['abs_point']+80);
			$abs_pulang=$abs->abs_pulang($abs_pulang,$abs_ip,$abs_tgl_pulang,$abs_rwd_pulang,$abs_point,$kar_id,$abs_tgl_las);

                        //Notify
                        $ntf_id=mysql_insert_id();
	    		$ntf_act="Absen Pulang";
                        $ntf_isi=$ntf_id.'-'.$abs_shift.'-'.$abs_rwd_pulang.'-'.$abs_point.'-'.$abs_alasan_pulang;
                        $ntf_ip=$ip_jaringan;
                        $ntf_tgl=$date;
                        $ntf_jam=$time;
                        $ntf_insert=$ntf->ntf_insert($ntf_act,$ntf_isi,$ntf_ip,$ntf_tgl,$ntf_jam,$kar_id);
                        //End Notify

	    	}elseif($waktu_jam_menit >= $jam_cepat_pagi && $waktu_jam_menit < "17:30"){
	    		$abs_rwd_pulang="Tepat";
	    		$abs_point=($abs_data['abs_point']+50);
			$abs_pulang=$abs->abs_pulang($abs_pulang,$abs_ip,$abs_tgl_pulang,$abs_rwd_pulang,$abs_point,$kar_id,$abs_tgl_las); 

                        //Notify
                        $ntf_id=mysql_insert_id();
	    		$ntf_act="Absen Pulang";
                        $ntf_isi=$ntf_id.'-'.$abs_shift.'-'.$abs_rwd_pulang.'-'.$abs_point.'-'.$abs_alasan_pulang;
                        $ntf_ip=$ip_jaringan;
                        $ntf_tgl=$date;
                        $ntf_jam=$time;
                        $ntf_insert=$ntf->ntf_insert($ntf_act,$ntf_isi,$ntf_ip,$ntf_tgl,$ntf_jam,$kar_id);
                        //End Notify

	    	}

	    }elseif($abs_data['abs_shift']=="Shift Siang"){
	    	if($waktu_jam_menit < $jam_cepat_siang){
	    		$abs_rwd_pulang="Izin";
	    		$abs_point=($abs_data['abs_point']+30);
                        $abs_pulang=$abs->abs_pulang_cepat($abs_pulang,$abs_ip,$abs_tgl_pulang,$abs_alasan_pulang,$abs_rwd_pulang,$abs_point,$kar_id,$abs_tgl_las);

                        //Notify
                        $ntf_id=mysql_insert_id();
	    		$ntf_act="Absen Pulang";
                        $ntf_isi=$ntf_id.'-'.$abs_shift.'-'.$abs_rwd_pulang.'-'.$abs_point.'-'.$abs_alasan_pulang;
                        $ntf_ip=$ip_jaringan;
                        $ntf_tgl=$date;
                        $ntf_jam=$time;
                        $ntf_insert=$ntf->ntf_insert($ntf_act,$ntf_isi,$ntf_ip,$ntf_tgl,$ntf_jam,$kar_id);
                        //End Notify

	    	}elseif($waktu_jam_menit > "19:29"){
	    		$abs_rwd_pulang="Loyal";
	    		$abs_point=($abs_data['abs_point']+80);
                        $abs_pulang=$abs->abs_pulang($abs_pulang,$abs_ip,$abs_tgl_pulang,$abs_rwd_pulang,$abs_point,$kar_id,$abs_tgl_las);

                        //Notify
                        $ntf_id=mysql_insert_id();
	    		$ntf_act="Absen Pulang";
                        $ntf_isi=$ntf_id.'-'.$abs_shift.'-'.$abs_rwd_pulang.'-'.$abs_point.'-'.$abs_alasan_pulang;
                        $ntf_ip=$ip_jaringan;
                        $ntf_tgl=$date;
                        $ntf_jam=$time;
                        $ntf_insert=$ntf->ntf_insert($ntf_act,$ntf_isi,$ntf_ip,$ntf_tgl,$ntf_jam,$kar_id);
                        //End Notify

	    	}elseif($waktu_jam_menit >= $jam_cepat_siang && $waktu_jam_menit < "19:30"){
	    		$abs_rwd_pulang="Tepat";
	    		$abs_point=($abs_data['abs_point']+50);
                        $abs_pulang=$abs->abs_pulang($abs_pulang,$abs_ip,$abs_tgl_pulang,$abs_rwd_pulang,$abs_point,$kar_id,$abs_tgl_las); 

                        //Notify
                        $ntf_id=mysql_insert_id();
	    		$ntf_act="Absen Pulang";
                        $ntf_isi=$ntf_id.'-'.$abs_shift.'-'.$abs_rwd_pulang.'-'.$abs_point.'-'.$abs_alasan_pulang;
                        $ntf_ip=$ip_jaringan;
                        $ntf_tgl=$date;
                        $ntf_jam=$time;
                        $ntf_insert=$ntf->ntf_insert($ntf_act,$ntf_isi,$ntf_ip,$ntf_tgl,$ntf_jam,$kar_id);
                        //End Notify
	    	}
	    }elseif($abs_data['abs_shift']=="Shift Sore"){
	    	if($waktu_jam_menit < $jam_cepat_sore){
	    		$abs_rwd_pulang="Izin";
	    		$abs_point=($abs_data['abs_point']+30);
                        $abs_pulang=$abs->abs_pulang_cepat($abs_pulang,$abs_ip,$abs_tgl_pulang,$abs_alasan_pulang,$abs_rwd_pulang,$abs_point,$kar_id,$abs_tgl_las);

                        //Notify
                        $ntf_id=mysql_insert_id();
	    		$ntf_act="Absen Pulang";
                        $ntf_isi=$ntf_id.'-'.$abs_shift.'-'.$abs_rwd_pulang.'-'.$abs_point.'-'.$abs_alasan_pulang;
                        $ntf_ip=$ip_jaringan;
                        $ntf_tgl=$date;
                        $ntf_jam=$time;
                        $ntf_insert=$ntf->ntf_insert($ntf_act,$ntf_isi,$ntf_ip,$ntf_tgl,$ntf_jam,$kar_id);
                        //End Notify

	    	}elseif($waktu_jam_menit > "21:29"){
	    		$abs_rwd_pulang="Loyal";
	    		$abs_point=($abs_data['abs_point']+80);
                        $abs_pulang=$abs->abs_pulang($abs_pulang,$abs_ip,$abs_tgl_pulang,$abs_rwd_pulang,$abs_point,$kar_id,$abs_tgl_las);

                        //Notify
                        $ntf_id=mysql_insert_id();
	    		$ntf_act="Absen Pulang";
                        $ntf_isi=$ntf_id.'-'.$abs_shift.'-'.$abs_rwd_pulang.'-'.$abs_point.'-'.$abs_alasan_pulang;
                        $ntf_ip=$ip_jaringan;
                        $ntf_tgl=$date;
                        $ntf_jam=$time;
                        $ntf_insert=$ntf->ntf_insert($ntf_act,$ntf_isi,$ntf_ip,$ntf_tgl,$ntf_jam,$kar_id);
                        //End Notify

	    	}elseif($waktu_jam_menit >= $jam_cepat_sore && $waktu_jam_menit < "21:30"){
	    		$abs_rwd_pulang="Tepat";
	    		$abs_point=($abs_data['abs_point']+50);
                        $abs_pulang=$abs->abs_pulang($abs_pulang,$abs_ip,$abs_tgl_pulang,$abs_rwd_pulang,$abs_point,$kar_id,$abs_tgl_las); 

                        //Notify
                        $ntf_id=mysql_insert_id();
	    		$ntf_act="Absen Pulang";
                        $ntf_isi=$ntf_id.'-'.$abs_shift.'-'.$abs_rwd_pulang.'-'.$abs_point.'-'.$abs_alasan_pulang;
                        $ntf_ip=$ip_jaringan;
                        $ntf_tgl=$date;
                        $ntf_jam=$time;
                        $ntf_insert=$ntf->ntf_insert($ntf_act,$ntf_isi,$ntf_ip,$ntf_tgl,$ntf_jam,$kar_id);
                        //End Notify
	    	}
	    }elseif($abs_data['abs_shift']=="Shift Malam"){

	    		$abs_rwd_pulang="Loyal";
	    		$abs_point=($abs_data['abs_point']+50);
                        $abs_pulang=$abs->abs_pulang($abs_pulang,$abs_ip,$abs_tgl_pulang,$abs_rwd_pulang,$abs_point,$kar_id,$abs_tgl_las); 

                        //Notify
                        $ntf_id=mysql_insert_id();
	    		$ntf_act="Absen Pulang";
                        $ntf_isi=$ntf_id.'-'.$abs_shift.'-'.$abs_rwd_pulang.'-'.$abs_point.'-'.$abs_alasan_pulang;
                        $ntf_ip=$ip_jaringan;
                        $ntf_tgl=$date;
                        $ntf_jam=$time;
                        $ntf_insert=$ntf->ntf_insert($ntf_act,$ntf_isi,$ntf_ip,$ntf_tgl,$ntf_jam,$kar_id);
                        //End Notify

	    }else{
	    	die();
	    }


		if($abs_pulang){
			
				$kduser=$acc_data['acc_username'];
				$nmfoto = date('YmdHis');
				$foto = "module/profile/img/".$kduser."-".$nmfoto.".jpg";
				$encoded_data = $_POST['mydata3'];
				$binary_data = base64_decode($encoded_data);
				$acc_img=$kduser."-".$nmfoto.".jpg";
				if(!empty($_POST['mydata3'])){
				   $acc_img_update=$acc->acc_img_update($acc_img,$kar_id);
				   if(!empty($acc_data['acc_img'])){
				     $dir_img="module/profile/img/$acc_data[acc_img]";	
				     unlink($dir_img);
				   }
				   $result = file_put_contents($foto, $binary_data);
				   //if (!$result) die("Gagal masuk ftp");
				}	
				
			echo"<script>document.location='media.php';</script>";
		}else{
			echo"<script>alert('Absen Pulang Failed');document.location='media.php';</script>";
		}
	//}else{
		//echo"<script>alert('Maaf Anda tidak dapat melakukan Absen Pulang sebelum mengkonfirmasikan Absen Masuk Anda ke Departement SDM');document.location='media.php';</script>";
	//}
}
elseif(isset($_POST['bsave'])){
	if(!empty($pos_atc)){
			$errors     = array();
			$maxsize    = 10485760;
			$acceptable = array('jpeg','jpg','gif','png','JPEG','JPG','GIF','PNG','pdf','docx','doc','xlsx','xls','ppt','pptx','rar','zip');

			if(($pos_size >= $maxsize) || ($pos_size == 0)) {
			        $errors[] = 'File too large. File must be less than 10 megabytes.';
			}
			if(!in_array($pos_extend, $acceptable) && !empty($pos_extend)) {
			    $errors[] = 'Invalid file type. Only JPG, GIF, PNG, PDF, DOC, XLS, PPT, ZIP and RAR types are accepted.';
			}
			if(count($errors) === 0) {
			    $pos_insert_atc=$pos->pos_insert_atc($pos_msg,$pos_atc,$pos_tgl,$pos_jam,$mrk_id,$kar_id);
			    
			    $ntf_id=mysql_insert_id();
			    $ntf_act="Create Posting";
			    $ntf_isi=$ntf_id.'-'.$pos_atc.'-'.$pos_msg;
			    $ntf_ip=$ip_jaringan;
			    $ntf_tgl=$date;
			    $ntf_jam=$time;
			    $ntf_insert=$ntf->ntf_insert($ntf_act,$ntf_isi,$ntf_ip,$ntf_tgl,$ntf_jam,$kar_id);
			    
	            if($pos_insert_atc){
	            	move_uploaded_file($pos_lok,"module/post/atc/$pos_atc");
			    	echo"<script>document.location='media.php';</script>";
	            }
			}else{
			    foreach($errors as $error) {
			        echo "<script>alert('$error');document.location='media.php';</script>";
			    }
			    die(); 
			}
            
    }else{
            $pos_insert=$pos->pos_insert($pos_msg,$pos_tgl,$pos_jam,$mrk_id,$kar_id);
	    
	    $ntf_id=mysql_insert_id();
    	    $ntf_act="Create Posting";
            $ntf_isi=$ntf_id.'-'.$pos_msg;
            $ntf_ip=$ip_jaringan;
            $ntf_tgl=$date;
            $ntf_jam=$time;
            $ntf_insert=$ntf->ntf_insert($ntf_act,$ntf_isi,$ntf_ip,$ntf_tgl,$ntf_jam,$kar_id);
	    
            if($pos_insert){
		    	echo"<script>document.location='media.php';</script>";
            }
    }
}

/////////////////////////////////////////////////////////////////////////////
if(isset($_POST['skode'])== $text){
	$_SESSION['freelance']=$_POST['skode'];
	$abs_tampil_tgl=$abf->abs_tampil_tgl($abs_tgl_masuk);
	while($abs_data_tgl=mysql_fetch_array($abs_tampil_tgl)){
    $hisabsensi[]=array("abs_sts"=>$abs_data_tgl['abs_sts'],
		                               "abs_alasan_masuk"=>$abs_data_tgl['abs_alasan_masuk'],
					       "abs_alasan_pulang"=>$abs_data_tgl['abs_alasan_pulang'],
					       "kar_id"=>$abs_data_tgl['kar_id'],
					       "abs_pulang"=>$abs_data_tgl['abs_pulang'],
					       "abs_tgl_pulang"=>$abs_data_tgl['abs_tgl_pulang'],
					       "abs_masuk"=>$abs_data_tgl['abs_masuk'],
					       "abs_tgl_masuk"=>$abs_data_tgl['abs_tgl_masuk'],
					       "abs_rwd_masuk"=>$abs_data_tgl['abs_rwd_masuk']);
	}
}else{
	$abs_tampil_tgl=$abs->abs_tampil_tgl($abs_tgl_masuk);
	while($abs_data_tgl=mysql_fetch_array($abs_tampil_tgl)){
    $hisabsensi[]=array("abs_sts"=>$abs_data_tgl['abs_sts'],
		                               "abs_alasan_masuk"=>$abs_data_tgl['abs_alasan_masuk'],
					       "abs_alasan_pulang"=>$abs_data_tgl['abs_alasan_pulang'],
					       "kar_id"=>$abs_data_tgl['kar_id'],
					       "abs_pulang"=>$abs_data_tgl['abs_pulang'],
					       "abs_tgl_pulang"=>$abs_data_tgl['abs_tgl_pulang'],
					       "abs_masuk"=>$abs_data_tgl['abs_masuk'],
					       "abs_tgl_masuk"=>$abs_data_tgl['abs_tgl_masuk'],
					       "abs_rwd_masuk"=>$abs_data_tgl['abs_rwd_masuk']);
	}
}

if(isset($_POST['closes'])){

    if($_POST['closes']==""){

        $_SESSION['freelance']=$_POST['closes'];

        echo"<script>document.location='media.php;</script>";

    }

}
elseif(isset($_POST['checkpoint2post'])){
	$string_loc = $ktr_id;
	$array_wfh  = array(171, 172, 173); //WFH Location
	
	if(in_array($string_loc, $array_wfh)){
		$kar_lat = $kar_data['kar_lat'];
		$kar_long = $kar_data['kar_long'];							
		$kar_radius = $kar_data['kar_radius'];	
		$abs_dtl_type = "WFH";
	}else{
		$ktr_tampil_id =$ktr->ktr_tampil_id($ktr_id);
		$latlongdata=mysql_fetch_array($ktr_tampil_id);
		$kar_lat = $latlongdata['ktr_lat'];
		$kar_long = $latlongdata['ktr_long'];
		$kar_radius = $latlongdata['ktr_radius'];
		$abs_dtl_type = "WFO";
	}
	$latlong = $latitudepost."#".$longitudepost."#".$kar_lat."#".$kar_long."#".$kar_radius."#".$abs_dtl_type;
	$jarak = distance($kar_lat, $kar_long, $latitudepost, $longitudepost, 'K');
	
	if ($jarak < (float)$kar_radius) {
		$status_radius = "DI DALAM RADIUS";
	} else {
		$status_radius = "DI LUAR RADIUS";
	}
	$chc_update_checkpoint2=$chc->chc_update_checkpoint2($abs_tgl_masuk, $abs_masuk, $latlong, $status_radius, $jarak, $kar_id);
	echo "<script>alert('Terima kasih, selamat bekerja kembali');document.location='media.php';</script>";
}
elseif(isset($_POST['checkpoint3post'])){
	$string_loc = $ktr_id;
	$array_wfh  = array(171, 172, 173); //WFH Location
	
	if(in_array($string_loc, $array_wfh)){
		$kar_lat = $kar_data['kar_lat'];
		$kar_long = $kar_data['kar_long'];							
		$kar_radius = $kar_data['kar_radius'];	
		$abs_dtl_type = "WFH";
	}else{
		$ktr_tampil_id =$ktr->ktr_tampil_id($ktr_id);
		$latlongdata=mysql_fetch_array($ktr_tampil_id);
		$kar_lat = $latlongdata['ktr_lat'];
		$kar_long = $latlongdata['ktr_long'];
		$kar_radius = $latlongdata['ktr_radius'];
		$abs_dtl_type = "WFO";
	}
	$latlong = $latitudepost."#".$longitudepost."#".$kar_lat."#".$kar_long."#".$kar_radius."#".$abs_dtl_type;
	$jarak = distance($kar_lat, $kar_long, $latitudepost, $longitudepost, 'K');
	
	if ($jarak < (float)$kar_radius) {
		$status_radius = "DI DALAM RADIUS";
	} else {
		$status_radius = "DI LUAR RADIUS";
	}
	$chc_update_checkpoint3=$chc->chc_update_checkpoint3($abs_tgl_masuk, $abs_masuk, $latlong, $status_radius, $jarak, $kar_id);
	echo "<script>alert('Terima kasih, semangat ya kerjanya');document.location='media.php';</script>";
}
?>