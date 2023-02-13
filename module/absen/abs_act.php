<?php

$page=$_GET['p'];

if(isset($_POST['bsortir_history'])){
	$_SESSION['tanggal_absen_history']=$_POST['tanggal_absen_history'];
}

if(!empty($_SESSION['tanggal_absen_history'])){
	$abs_tgl_masuk=$_SESSION['tanggal_absen_history'];
}else{
	$abs_tgl_masuk=$date;
}

if(isset($_POST['brefresh_history'])){
	$_SESSION['tanggal_absen_history']='';
	echo"<script>document.location='?p=$page';</script>";
}

/////////////////////////////////////////////////////////////////////////

if(isset($_POST['bsortir_checkpoint'])){
	$_SESSION['tanggal_absen_checkpoint']=$_POST['tanggal_absen_checkpoint'];
}

if(!empty($_SESSION['tanggal_absen_checkpoint'])){
	$chc_tgl_masuk=$_SESSION['tanggal_absen_checkpoint'];
}else{
	$chc_tgl_masuk=$date;
}

if(isset($_POST['brefresh_checkpoint'])){
	$_SESSION['tanggal_absen_checkpoint']='';
	echo"<script>document.location='?p=$page';</script>";
}

/////////////////////////////////////////////////////////////////////////

if(isset($_POST['bsortir_detail'])){
	$_SESSION['tanggal_absen_detail']=$_POST['tanggal_absen_detail'];
}

if(!empty($_SESSION['tanggal_absen_detail'])){
	$abs_dtl_tgl=$_SESSION['tanggal_absen_detail'];
}else{
	$abs_dtl_tgl=$date;
}

if(isset($_POST['brefresh_detail'])){
	$_SESSION['tanggal_absen_detail']='';
	echo"<script>document.location='?p=$page';</script>";
}


if(isset($_GET['ip'])){
	$abs_id=$_GET['id'];
	$abs_ip=$_GET['ip'];
	$abs_ip_konfirm=$abs->abs_ip_konfirm($abs_id,$abs_ip);
	if($abs_ip_konfirm){
		
		//Notify
		$ntf_id=$abs_id;
		$ntf_act="Konfirm Absensi";
		$ntf_isi=$abs_id.'-'.$abs_ip;
		$ntf_ip=$ip_jaringan;
		$ntf_tgl=$date;
		$ntf_jam=$time;
		$ntf_insert=$ntf->ntf_insert($ntf_act,$ntf_isi,$ntf_ip,$ntf_tgl,$ntf_jam,$kar_id);
		//End Notify
		
		echo"<script>document.location='?p=$page';</script>";
	}else{
		echo"<script>alert('Insert Failed');document.location='?p=$page';</script>";
	}
}
if(isset($_GET['point'])){
	$abs_id=$_GET['id'];
	$abs_point=$_GET['point'];
	$abs_point_update=$abs->abs_point_update($abs_id,$abs_point);
	if($abs_point_update){
		echo"<script>document.location='?p=$page';</script>";
	}else{
		echo"<script>alert('Insert Failed');document.location='?p=$page';</script>";
	}
}
if(isset($_POST['bsave'])){
	
	$kar_id_hidden= $_POST['kar_id'];

	$jml_data = count($kar_id_hidden);
		  
	for ($i=0; $i < $jml_data; $i++){
		$kar_id=$_POST['kar_id'][$i];
		$abs_dtl_sts=$_POST['abs_dtl_sts'.$i];
		
		$abs_dtl_tampil=$abs->abs_dtl_kar_id($kar_id,$abs_dtl_tgl);
	  	$abs_dtl_cek=mysql_num_rows($abs_dtl_tampil);

		if($abs_dtl_cek > 0){
			//echo "UPDATE : ".$kar_id." - ".$abs_dtl_sts."<br>";
			$abs_dtl_action=$abs->abs_dtl_update($abs_dtl_tgl,$abs_dtl_sts,$kar_id);
		}else{
			//echo "INSERT : ".$kar_id." - ".$abs_dtl_sts."<br>";
			$abs_dtl_action=$abs->abs_dtl_insert($abs_dtl_tgl,$abs_dtl_sts,$kar_id);
		}
	}
	
	echo"<script>document.location='?p=$page';</script>";
}
if(!empty($_GET['s'])){
	if($_GET['s']=="history_absen"){
		$active_history="active";
	}else{
		$active_history="";
	}
	if($_GET['s']=="detail_absen"){
		$active_detail="active";
	}else{
		$active_detail="";
	}
}
if(isset($_POST['bupdate_telat_pagi'])){
	$abs_stm_jam=$_POST['jam_telat_pagi'];
	$abs_stm_id=$_POST['abs_stm_id'];
	$abs_stm_update=$abs->abs_stm_update($abs_stm_jam,$abs_stm_id);
	if($abs_stm_update){
		echo"<script>document.location='?p=$page';</script>";
	}else{
		echo"<script>alert('Saving Failed');document.location='?p=$page';</script>";
	}
}
if(isset($_POST['bupdate_telat_siang'])){
	$abs_stm_jam=$_POST['jam_telat_siang'];
	$abs_stm_id=$_POST['abs_stm_id'];
	$abs_stm_update=$abs->abs_stm_update($abs_stm_jam,$abs_stm_id);
	if($abs_stm_update){
		echo"<script>document.location='?p=$page';</script>";
	}else{
		echo"<script>alert('Saving Failed');document.location='?p=$page';</script>";
	}
}
if(isset($_POST['bupdate_telat_sore'])){
	$abs_stm_jam=$_POST['jam_telat_sore'];
	$abs_stm_id=$_POST['abs_stm_id'];
	$abs_stm_update=$abs->abs_stm_update($abs_stm_jam,$abs_stm_id);
	if($abs_stm_update){
		echo"<script>document.location='?p=$page';</script>";
	}else{
		echo"<script>alert('Saving Failed');document.location='?p=$page';</script>";
	}
}
if(isset($_POST['bupdate_telat_malam'])){
	$abs_stm_jam=$_POST['jam_telat_malam'];
	$abs_stm_id=$_POST['abs_stm_id'];
	$abs_stm_update=$abs->abs_stm_update($abs_stm_jam,$abs_stm_id);
	if($abs_stm_update){
		echo"<script>document.location='?p=$page';</script>";
	}else{
		echo"<script>alert('Saving Failed');document.location='?p=$page';</script>";
	}
}


/////////////////////////////////////////////////////////////////////////////////////////////

if(isset($_POST['bupdate_cepat_pagi'])){
	$abs_stm_jam=$_POST['jam_cepat_pagi'];
	$abs_stm_id=$_POST['abs_stm_id'];
	$abs_stm_update=$abs->abs_stm_update($abs_stm_jam,$abs_stm_id);
	if($abs_stm_update){
		echo"<script>document.location='?p=$page';</script>";
	}else{
		echo"<script>alert('Saving Failed');document.location='?p=$page';</script>";
	}
}
if(isset($_POST['bupdate_cepat_siang'])){
	$abs_stm_jam=$_POST['jam_cepat_siang'];
	$abs_stm_id=$_POST['abs_stm_id'];
	$abs_stm_update=$abs->abs_stm_update($abs_stm_jam,$abs_stm_id);
	if($abs_stm_update){
		echo"<script>document.location='?p=$page';</script>";
	}else{
		echo"<script>alert('Saving Failed');document.location='?p=$page';</script>";
	}
}
if(isset($_POST['bupdate_cepat_sore'])){
	$abs_stm_jam=$_POST['jam_cepat_sore'];
	$abs_stm_id=$_POST['abs_stm_id'];
	$abs_stm_update=$abs->abs_stm_update($abs_stm_jam,$abs_stm_id);
	if($abs_stm_update){
		echo"<script>document.location='?p=$page';</script>";
	}else{
		echo"<script>alert('Saving Failed');document.location='?p=$page';</script>";
	}
}
if(isset($_POST['bupdate_cepat_malam'])){
	$abs_stm_jam=$_POST['jam_cepat_malam'];
	$abs_stm_id=$_POST['abs_stm_id'];
	$abs_stm_update=$abs->abs_stm_update($abs_stm_jam,$abs_stm_id);
	if($abs_stm_update){
		echo"<script>document.location='?p=$page';</script>";
	}else{
		echo"<script>alert('Saving Failed');document.location='?p=$page';</script>";
	}
}
if(isset($_POST['bupdate_tepat_pagi'])){
	$abs_stm_jam=$_POST['jam_tepat_pagi'];
	$abs_stm_id=$_POST['abs_stm_id'];
	$abs_stm_update=$abs->abs_stm_update($abs_stm_jam,$abs_stm_id);
	if($abs_stm_update){
		echo"<script>document.location='?p=$page';</script>";
	}else{
		echo"<script>alert('Saving Failed');document.location='?p=$page';</script>";
	}
}
if(isset($_POST['bupdate_tepat_siang'])){
	$abs_stm_jam=$_POST['jam_tepat_siang'];
	$abs_stm_id=$_POST['abs_stm_id'];
	$abs_stm_update=$abs->abs_stm_update($abs_stm_jam,$abs_stm_id);
	if($abs_stm_update){
		echo"<script>document.location='?p=$page';</script>";
	}else{
		echo"<script>alert('Saving Failed');document.location='?p=$page';</script>";
	}
}
if(isset($_POST['bupdate_tepat_sore'])){
	$abs_stm_jam=$_POST['jam_tepat_sore'];
	$abs_stm_id=$_POST['abs_stm_id'];
	$abs_stm_update=$abs->abs_stm_update($abs_stm_jam,$abs_stm_id);
	if($abs_stm_update){
		echo"<script>document.location='?p=$page';</script>";
	}else{
		echo"<script>alert('Saving Failed');document.location='?p=$page';</script>";
	}
}
if(isset($_POST['bupdate_tepat_malam'])){
	$abs_stm_jam=$_POST['jam_tepat_malam'];
	$abs_stm_id=$_POST['abs_stm_id'];
	$abs_stm_update=$abs->abs_stm_update($abs_stm_jam,$abs_stm_id);
	if($abs_stm_update){
		echo"<script>document.location='?p=$page';</script>";
	}else{
		echo"<script>alert('Saving Failed');document.location='?p=$page';</script>";
	}
}

/////////////////////////////////////////////////////////////////////////////////////////////

//Absen Variable
$kar_id_=$_POST['kar_id'];

$abs_masuk=$_POST['abs_masuk'];

$abs_pulang=$_POST['abs_pulang'];

$abs_tgl_masuk=$abs_tgl_masuk;

$abs_tgl_pulang=$abs_tgl_masuk;

$abs_alasan_masuk=ucwords($_POST['abs_alasan_masuk']);

$abs_alasan_pulang=ucwords($_POST['abs_alasan_pulang']);

$location=$_POST['location'];

$shift=$_POST['abs_shift'];


function strposa($haystack, $needle, $offset=0) {
    if(!is_array($needle)) $needle = array($needle);
    foreach($needle as $x) {
        if(strpos($haystack, $x, $offset) !== false) return true;
    }
    return false;
}



if(isset($_POST['babsmasuk'])){

	if(empty($kar_id_) || empty($shift) || empty($location) || empty($abs_masuk) || empty($abs_alasan_masuk)){
			echo"<script>alert('Absen Masuk Failed');document.location='?p=$page';</script>";
	}
	else{

					

				$ip_tampil_location=$ip->ip_tampil_location($location);

				$ip_data=mysql_fetch_array($ip_tampil_location);

				$abs_ip_=$ip_data['ip_nm'];

				if($ip_data['typ_id']=="1"){

					if($ip_data['ip_release']!==$abs_tgl_masuk){

							$ip_update_location_static=$ip->ip_update_location_static($abs_tgl_masuk,$location);

					}

				}

				elseif($ip_data['typ_id']=="2"){

					if($ip_data['ip_release']!==$abs_tgl_masuk){

							$ip_update_location_dynamic=$ip->ip_update_location_dynamic($abs_ip_,$abs_tgl_masuk,$location);

					}

				}
				
				/////////////////////////////////////////////
				$kar_tampil_id=$kar->kar_tampil_id($kar_id_);
				$kar_data_=mysql_fetch_array($kar_tampil_id);
				/////////////////////////////////////////////


				//NEW CHANGE

				$waktu_jam_menit=substr($abs_masuk, 0,5);



				//Range Pagi

				$abs_stm_nm="Jam Telat Pagi";

                                $abs_settime_id=$abs->abs_settime_id($abs_stm_nm);

                                $abs_settime_data=mysql_fetch_array($abs_settime_id);
				
				if(!empty($kar_data_['ktr_default_shift1_in']) && !empty($kar_data_['ktr_default_shift1_out'])){
					if(!empty($kar_data_['kar_default_shift1_in']) && !empty($kar_data_['kar_default_shift1_out'])){
						$jam_telat_pagi=substr($kar_data_['kar_default_shift1_in'], 0,5);
					}else{
						$jam_telat_pagi=substr($kar_data_['ktr_default_shift1_in'], 0,5);
					}
				}else{
					if(!empty($kar_data_['kar_default_shift1_in']) && !empty($kar_data_['kar_default_shift1_out'])){
						$jam_telat_pagi=substr($kar_data_['kar_default_shift1_in'], 0,5);
					}else{
						$jam_telat_pagi=substr($abs_settime_data['abs_stm_jam'], 0,5);
					}
				}
				
				

				//Range Siang

				$abs_stm_nm="Jam Telat Siang";

                                $abs_settime_id=$abs->abs_settime_id($abs_stm_nm);

                                $abs_settime_data=mysql_fetch_array($abs_settime_id);
				
				if(!empty($kar_data_['ktr_default_shift2_in']) && !empty($kar_data_['ktr_default_shift2_out'])){
					if(!empty($kar_data_['kar_default_shift2_in']) && !empty($kar_data_['kar_default_shift2_out'])){
						$jam_telat_siang=substr($kar_data_['kar_default_shift2_in'], 0,5);
					}else{
						$jam_telat_siang=substr($kar_data_['ktr_default_shift2_in'], 0,5);
					}
				}else{
					if(!empty($kar_data_['kar_default_shift2_in']) && !empty($kar_data_['kar_default_shift2_out'])){
						$jam_telat_siang=substr($kar_data_['kar_default_shift2_in'], 0,5);
					}else{
						$jam_telat_siang=substr($abs_settime_data['abs_stm_jam'], 0,5);
					}
				}
				


				//Range Sore

				$abs_stm_nm="Jam Telat Sore";

                                $abs_settime_id=$abs->abs_settime_id($abs_stm_nm);

                                $abs_settime_data=mysql_fetch_array($abs_settime_id);
				
				if(!empty($kar_data_['ktr_default_shift3_in']) && !empty($kar_data_['ktr_default_shift3_out'])){
					if(!empty($kar_data_['kar_default_shift3_in']) && !empty($kar_data_['kar_default_shift3_out'])){
						$jam_telat_sore=substr($kar_data_['kar_default_shift3_in'], 0,5);
					}else{
						$jam_telat_sore=substr($kar_data_['ktr_default_shift3_in'], 0,5);
					}
				}else{
					if(!empty($kar_data_['kar_default_shift3_in']) && !empty($kar_data_['kar_default_shift3_out'])){
						$jam_telat_sore=substr($kar_data_['kar_default_shift3_in'], 0,5);
					}else{
						$jam_telat_sore=substr($abs_settime_data['abs_stm_jam'], 0,5);
					}
				}



				//Range Malam

				$abs_stm_nm="Jam Telat Malam";

                                $abs_settime_id=$abs->abs_settime_id($abs_stm_nm);

                                $abs_settime_data=mysql_fetch_array($abs_settime_id);
				
				if(!empty($kar_data_['ktr_default_shift4_in']) && !empty($kar_data_['ktr_default_shift4_out'])){
					if(!empty($kar_data_['kar_default_shift4_in']) && !empty($kar_data_['kar_default_shift4_out'])){
						$jam_telat_malam=substr($kar_data_['kar_default_shift4_in'], 0,5);
					}else{
						$jam_telat_malam=substr($kar_data_['ktr_default_shift4_in'], 0,5);
					}
				}else{
					if(!empty($kar_data_['kar_default_shift4_in']) && !empty($kar_data_['kar_default_shift4_out'])){
						$jam_telat_malam=substr($kar_data_['kar_default_shift4_in'], 0,5);
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

							$abs_masuk=$abs->abs_masuk_telat($abs_masuk,$abs_ip_,$abs_tgl_masuk,$abs_alasan_masuk,$abs_shift,$abs_rwd_masuk,$abs_point,$kar_id_);

						

                                                        //Notify

							$ntf_id=mysql_insert_id();

                                                        $ntf_act="Manual Absen Masuk";

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

							$abs_masuk=$abs->abs_masuk_telat($abs_masuk,$abs_ip_,$abs_tgl_masuk,$abs_alasan_masuk,$abs_shift,$abs_rwd_masuk,$abs_point,$kar_id_);

						

                                                        //Notify

							$ntf_id=mysql_insert_id();

                                                        $ntf_act="Manual Absen Masuk";

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

							$abs_masuk=$abs->abs_masuk_telat($abs_masuk,$abs_ip_,$abs_tgl_masuk,$abs_alasan_masuk,$abs_shift,$abs_rwd_masuk,$abs_point,$kar_id_);

						

                                                        //Notify

							$ntf_id=mysql_insert_id();

                                                        $ntf_act="Manual Absen Masuk";

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

							$abs_masuk=$abs->abs_masuk_telat($abs_masuk,$abs_ip_,$abs_tgl_masuk,$abs_alasan_masuk,$abs_shift,$abs_rwd_masuk,$abs_point,$kar_id_);

						

                                                        //Notify

							$ntf_id=mysql_insert_id();

                                                        $ntf_act="Manual Absen Masuk";

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

							$abs_masuk=$abs->abs_masuk_telat($abs_masuk,$abs_ip_,$abs_tgl_masuk,$abs_alasan_masuk,$abs_shift,$abs_rwd_masuk,$abs_point,$kar_id_);

						

                                                        //Notify

							$ntf_id=mysql_insert_id();

                                                        $ntf_act="Manual Absen Masuk";

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

							$abs_masuk=$abs->abs_masuk_telat($abs_masuk,$abs_ip_,$abs_tgl_masuk,$abs_alasan_masuk,$abs_shift,$abs_rwd_masuk,$abs_point,$kar_id_);

						

                                                        //Notify

							$ntf_id=mysql_insert_id();

                                                        $ntf_act="Manual Absen Masuk";

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

							$abs_masuk=$abs->abs_masuk_telat($abs_masuk,$abs_ip_,$abs_tgl_masuk,$abs_alasan_masuk,$abs_shift,$abs_rwd_masuk,$abs_point,$kar_id_);

						

                                                        //Notify

							$ntf_id=mysql_insert_id();

                                                        $ntf_act="Manual Absen Masuk";

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

							$abs_masuk=$abs->abs_masuk_telat($abs_masuk,$abs_ip_,$abs_tgl_masuk,$abs_alasan_masuk,$abs_shift,$abs_rwd_masuk,$abs_point,$kar_id_);

						

                                                        //Notify

							$ntf_id=mysql_insert_id();

                                                        $ntf_act="Manual Absen Masuk";

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

							$abs_masuk=$abs->abs_masuk_telat($abs_masuk,$abs_ip_,$abs_tgl_masuk,$abs_alasan_masuk,$abs_shift,$abs_rwd_masuk,$abs_point,$kar_id_);

						

                                                        //Notify

							$ntf_id=mysql_insert_id();

                                                        $ntf_act="Manual Absen Masuk";

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

                                                        $abs_masuk=$abs->abs_masuk_telat($abs_masuk,$abs_ip_,$abs_tgl_masuk,$abs_alasan_masuk,$abs_shift,$abs_rwd_masuk,$abs_point,$kar_id_);

                                                

                                                        //Notify

                                                        $ntf_id=mysql_insert_id();

                                                        $ntf_act="Manual Absen Masuk";

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

					$string_loc = $location;
				        $array_wfh  = array('171', '172', '173'); //WFH Location
								
				        if(strposa($string_loc, $array_wfh)){
						$abs_dtl_type = "WFH";
				        }else{
						$abs_dtl_type = "WFO";
				        }

					$abs_dtl_tgl=$abs_tgl_masuk;

					$abs_dtl_sts="H";

					$abs_dtl_tampil=$abs->abs_dtl_tampil($kar_id_,$abs_dtl_tgl);

				  	$abs_dtl_cek=mysql_num_rows($abs_dtl_tampil);

					if($abs_dtl_cek > 0){

						$abs_dtl_update=$abs->abs_dtl_update($abs_dtl_tgl,$abs_dtl_sts,$kar_id_);

					}else{

						//$abs_dtl_insert=$abs->abs_dtl_insert($abs_dtl_tgl,$abs_dtl_sts,$kar_id_);
						$abs_dtl_insert=$abs->abs_dtl_insert_full($abs_dtl_tgl,$abs_dtl_sts,$abs_dtl_type,$location,$kar_id_);

					}

					

					$ktr_tampil_id_location=$ktr->ktr_tampil_id_location($location);

					$ktr_data_id_location=mysql_fetch_array($ktr_tampil_id_location);

					$ktr_id_=$ktr_data_id_location['ktr_id'];

					$unt_id_=$ktr_data_id_location['unt_id'];

					$kar_update_location=$kar->kar_update_location($kar_id_,$ktr_id_,$unt_id_);

					//$kar_update_location=$kar->kar_update_location($kar_id_,$location);

					

					echo"<script>document.location='?p=$page';</script>";

				}else{

					echo"<script>alert('Absen Masuk Failed');document.location='?p=$page';</script>";

				}

		}	//Tutup else empty

}

elseif(isset($_POST['babspulang'])){

	if(empty($kar_id_) || empty($abs_pulang) || empty($abs_alasan_pulang)){
			echo"<script>alert('Absen Masuk Failed');document.location='?p=$page';</script>";
	}
	else{


	$abs_tampil_kar=$abs->abs_tampil_kar($kar_id_,$abs_tgl_masuk);

	$abs_data=mysql_fetch_array($abs_tampil_kar);

	$kar_tampil_id=$kar->kar_tampil_id($kar_id_);
	$kar_data_=mysql_fetch_array($kar_tampil_id);
    
    $unt_id=$kar_data_['unt_id'];
    $ktr_id=$kar_data_['ktr_id'];   

    $ip_tampil_unt_ktr=$ip->ip_tampil_unt_ktr($unt_id,$ktr_id);

	$ip_data=mysql_fetch_array($ip_tampil_unt_ktr);

	$abs_ip_=$ip_data['ip_nm'];

	//if($abs_data['abs_ip_']==$ip_data['ip_nm']){



        //NEW CHANGE

		$waktu_jam_menit=substr($abs_pulang, 0,5);



		//Range Pagi

		$abs_stm_nm="Jam Cepat Pagi";

                $abs_settime_id=$abs->abs_settime_id($abs_stm_nm);

                $abs_settime_data=mysql_fetch_array($abs_settime_id);
		
		if(!empty($kar_data_['ktr_default_shift1_in']) && !empty($kar_data_['ktr_default_shift1_out'])){
			if(!empty($kar_data_['kar_default_shift1_in']) && !empty($kar_data_['kar_default_shift1_out'])){
				$jam_cepat_pagi=substr($kar_data_['kar_default_shift1_out'], 0,5);
			}else{
				$jam_cepat_pagi=substr($kar_data_['ktr_default_shift1_out'], 0,5);
			}
		}else{
			if(!empty($kar_data_['kar_default_shift1_in']) && !empty($kar_data_['kar_default_shift1_out'])){
				$jam_cepat_pagi=substr($kar_data_['kar_default_shift1_out'], 0,5);
			}else{
				$jam_cepat_pagi=substr($abs_settime_data['abs_stm_jam'], 0,5);
			}
		}

		

		//Range Siang

		$abs_stm_nm="Jam Cepat Siang";

                $abs_settime_id=$abs->abs_settime_id($abs_stm_nm);

                $abs_settime_data=mysql_fetch_array($abs_settime_id);
		
		if(!empty($kar_data_['ktr_default_shift2_in']) && !empty($kar_data_['ktr_default_shift2_out'])){
			if(!empty($kar_data_['kar_default_shift2_in']) && !empty($kar_data_['kar_default_shift2_out'])){
				$jam_cepat_siang=substr($kar_data_['kar_default_shift2_out'], 0,5);
			}else{
				$jam_cepat_siang=substr($kar_data_['ktr_default_shift2_out'], 0,5);
			}
		}else{
			if(!empty($kar_data_['kar_default_shift2_in']) && !empty($kar_data_['kar_default_shift2_out'])){
				$jam_cepat_siang=substr($kar_data_['kar_default_shift2_out'], 0,5);
			}else{
				$jam_cepat_siang=substr($abs_settime_data['abs_stm_jam'], 0,5);
			}
		}



		//Range Sore

		$abs_stm_nm="Jam Cepat Sore";

                $abs_settime_id=$abs->abs_settime_id($abs_stm_nm);

                $abs_settime_data=mysql_fetch_array($abs_settime_id);
		
		if(!empty($kar_data_['ktr_default_shift3_in']) && !empty($kar_data_['ktr_default_shift3_out'])){
			if(!empty($kar_data_['kar_default_shift3_in']) && !empty($kar_data_['kar_default_shift3_out'])){
				$jam_cepat_sore=substr($kar_data_['kar_default_shift3_out'], 0,5);
			}else{
				$jam_cepat_sore=substr($kar_data_['ktr_default_shift3_out'], 0,5);
			}
		}else{
			if(!empty($kar_data_['kar_default_shift3_in']) && !empty($kar_data_['kar_default_shift3_out'])){
				$jam_cepat_sore=substr($kar_data_['kar_default_shift3_out'], 0,5);
			}else{
				$jam_cepat_sore=substr($abs_settime_data['abs_stm_jam'], 0,5);
			}
		}



		//Range Malam

		$abs_stm_nm="Jam Cepat Malam";

                $abs_settime_id=$abs->abs_settime_id($abs_stm_nm);

                $abs_settime_data=mysql_fetch_array($abs_settime_id);
		
		if(!empty($kar_data_['ktr_default_shift4_in']) && !empty($kar_data_['ktr_default_shift4_out'])){
			if(!empty($kar_data_['kar_default_shift4_in']) && !empty($kar_data_['kar_default_shift4_out'])){
				$jam_cepat_malam=substr($kar_data_['kar_default_shift4_out'], 0,5);
			}else{
				$jam_cepat_malam=substr($kar_data_['ktr_default_shift4_out'], 0,5);
			}
		}else{
			if(!empty($kar_data_['kar_default_shift4_in']) && !empty($kar_data_['kar_default_shift4_out'])){
				$jam_cepat_malam=substr($kar_data_['kar_default_shift4_out'], 0,5);
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

			$abs_pulang=$abs->abs_pulang_cepat($abs_pulang,$abs_ip_,$abs_tgl_pulang,$abs_alasan_pulang,$abs_rwd_pulang,$abs_point,$kar_id_,$abs_tgl_masuk);



                        //Notify

                        $ntf_id=mysql_insert_id();

	    		$ntf_act="Manual Absen Pulang";

                        $ntf_isi=$ntf_id.'-'.$abs_shift.'-'.$abs_rwd_pulang.'-'.$abs_point.'-'.$abs_alasan_pulang;

                        $ntf_ip=$ip_jaringan;

                        $ntf_tgl=$date;

                        $ntf_jam=$time;

                        $ntf_insert=$ntf->ntf_insert($ntf_act,$ntf_isi,$ntf_ip,$ntf_tgl,$ntf_jam,$kar_id);

                        //End Notify



	    	}elseif($waktu_jam_menit > $jamloyal){

	    		$abs_rwd_pulang="Loyal";

	    		$abs_point=($abs_data['abs_point']+80);

			$abs_pulang=$abs->abs_pulang_cepat($abs_pulang,$abs_ip_,$abs_tgl_pulang,$abs_alasan_pulang,$abs_rwd_pulang,$abs_point,$kar_id_,$abs_tgl_masuk);



                        //Notify

                        $ntf_id=mysql_insert_id();

	    		$ntf_act="Manual Absen Pulang";

                        $ntf_isi=$ntf_id.'-'.$abs_shift.'-'.$abs_rwd_pulang.'-'.$abs_point.'-'.$abs_alasan_pulang;

                        $ntf_ip=$ip_jaringan;

                        $ntf_tgl=$date;

                        $ntf_jam=$time;

                        $ntf_insert=$ntf->ntf_insert($ntf_act,$ntf_isi,$ntf_ip,$ntf_tgl,$ntf_jam,$kar_id);

                        //End Notify



	    	}elseif($waktu_jam_menit >= $jam_cepat_pagi && $waktu_jam_menit < $jamtepat){

	    		$abs_rwd_pulang="Tepat";

	    		$abs_point=($abs_data['abs_point']+50);

				$abs_pulang=$abs->abs_pulang_cepat($abs_pulang,$abs_ip_,$abs_tgl_pulang,$abs_alasan_pulang,$abs_rwd_pulang,$abs_point,$kar_id_,$abs_tgl_masuk);



                        //Notify

                        $ntf_id=mysql_insert_id();

	    		$ntf_act="Manual Absen Pulang";

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

			$abs_pulang=$abs->abs_pulang_cepat($abs_pulang,$abs_ip_,$abs_tgl_pulang,$abs_alasan_pulang,$abs_rwd_pulang,$abs_point,$kar_id_,$abs_tgl_masuk);



                        //Notify

                        $ntf_id=mysql_insert_id();

	    		$ntf_act="Manual Absen Pulang";

                        $ntf_isi=$ntf_id.'-'.$abs_shift.'-'.$abs_rwd_pulang.'-'.$abs_point.'-'.$abs_alasan_pulang;

                        $ntf_ip=$ip_jaringan;

                        $ntf_tgl=$date;

                        $ntf_jam=$time;

                        $ntf_insert=$ntf->ntf_insert($ntf_act,$ntf_isi,$ntf_ip,$ntf_tgl,$ntf_jam,$kar_id);

                        //End Notify



	    	}elseif($waktu_jam_menit > $jamloyal){

	    		$abs_rwd_pulang="Loyal";

	    		$abs_point=($abs_data['abs_point']+80);

			$abs_pulang=$abs->abs_pulang_cepat($abs_pulang,$abs_ip_,$abs_tgl_pulang,$abs_alasan_pulang,$abs_rwd_pulang,$abs_point,$kar_id_,$abs_tgl_masuk);



                        //Notify

                        $ntf_id=mysql_insert_id();

	    		$ntf_act="Manual Absen Pulang";

                        $ntf_isi=$ntf_id.'-'.$abs_shift.'-'.$abs_rwd_pulang.'-'.$abs_point.'-'.$abs_alasan_pulang;

                        $ntf_ip=$ip_jaringan;

                        $ntf_tgl=$date;

                        $ntf_jam=$time;

                        $ntf_insert=$ntf->ntf_insert($ntf_act,$ntf_isi,$ntf_ip,$ntf_tgl,$ntf_jam,$kar_id);

                        //End Notify



	    	}elseif($waktu_jam_menit >= $jam_cepat_siang && $waktu_jam_menit < $jamtepat){

	    		$abs_rwd_pulang="Tepat";

	    		$abs_point=($abs_data['abs_point']+50);

			$abs_pulang=$abs->abs_pulang_cepat($abs_pulang,$abs_ip_,$abs_tgl_pulang,$abs_alasan_pulang,$abs_rwd_pulang,$abs_point,$kar_id_,$abs_tgl_masuk);



                        //Notify

                        $ntf_id=mysql_insert_id();

                        $ntf_act="Manual Absen Pulang";

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

			$abs_pulang=$abs->abs_pulang_cepat($abs_pulang,$abs_ip_,$abs_tgl_pulang,$abs_alasan_pulang,$abs_rwd_pulang,$abs_point,$kar_id_,$abs_tgl_masuk);



                        //Notify

                        $ntf_id=mysql_insert_id();

	    		$ntf_act="Manual Absen Pulang";

                        $ntf_isi=$ntf_id.'-'.$abs_shift.'-'.$abs_rwd_pulang.'-'.$abs_point.'-'.$abs_alasan_pulang;

                        $ntf_ip=$ip_jaringan;

                        $ntf_tgl=$date;

                        $ntf_jam=$time;

                        $ntf_insert=$ntf->ntf_insert($ntf_act,$ntf_isi,$ntf_ip,$ntf_tgl,$ntf_jam,$kar_id);

                        //End Notify



	    	}elseif($waktu_jam_menit > $jamloyal){

	    		$abs_rwd_pulang="Loyal";

	    		$abs_point=($abs_data['abs_point']+80);

			$abs_pulang=$abs->abs_pulang_cepat($abs_pulang,$abs_ip_,$abs_tgl_pulang,$abs_alasan_pulang,$abs_rwd_pulang,$abs_point,$kar_id_,$abs_tgl_masuk);



                        //Notify

                        $ntf_id=mysql_insert_id();

	    		$ntf_act="Manual Absen Pulang";

                        $ntf_isi=$ntf_id.'-'.$abs_shift.'-'.$abs_rwd_pulang.'-'.$abs_point.'-'.$abs_alasan_pulang;

                        $ntf_ip=$ip_jaringan;

                        $ntf_tgl=$date;

                        $ntf_jam=$time;

                        $ntf_insert=$ntf->ntf_insert($ntf_act,$ntf_isi,$ntf_ip,$ntf_tgl,$ntf_jam,$kar_id);

                        //End Notify



	    	}elseif($waktu_jam_menit >= $jam_cepat_sore && $waktu_jam_menit < $jamtepat){

	    		$abs_rwd_pulang="Tepat";

	    		$abs_point=($abs_data['abs_point']+50);

			$abs_pulang=$abs->abs_pulang_cepat($abs_pulang,$abs_ip_,$abs_tgl_pulang,$abs_alasan_pulang,$abs_rwd_pulang,$abs_point,$kar_id_,$abs_tgl_masuk);



                        //Notify

                        $ntf_id=mysql_insert_id();

	    		$ntf_act="Manual Absen Pulang";

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

			$abs_pulang=$abs->abs_pulang_cepat($abs_pulang,$abs_ip_,$abs_tgl_pulang,$abs_alasan_pulang,$abs_rwd_pulang,$abs_point,$kar_id_,$abs_tgl_masuk);



                        //Notify

                        $ntf_id=mysql_insert_id();

	    		$ntf_act="Manual Absen Pulang";

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

			echo"<script>document.location='?p=$page';</script>";

		}else{

			echo"<script>alert('Absen Pulang Failed');document.location='?p=$page';</script>";

		}

	//}else{

		//echo"<script>alert('Maaf Anda tidak dapat melakukan Absen Pulang sebelum mengkonfirmasikan Absen Masuk Anda ke Departement SDM');document.location='?p=$page';</script>";

	//}

		}	//Tutup else empty

}

elseif(isset($_POST['bupdate_jam_abs_masuk'])){
	$edt_abs_id=$_POST['edt_abs_id'];
	$edt_abs_masuk=$_POST['edt_abs_masuk'];
	
	$abs_masuk_update=$abs->abs_masuk_update($edt_abs_masuk,$edt_abs_id);
	if($abs_masuk_update){
		echo"<script>document.location='?p=$page';</script>";
	}else{
		echo"<script>alert('Saving Failed');document.location='?p=$page';</script>";
	}
}


//Filter Report Absen
$bulan_exp=explode('-',$date);
$bulan_aktif=$bulan_exp[0]."-".$bulan_exp[1];

//Variable Filter
$bulan=$_POST['bulan'];
$divisi=$_POST['divisi'];

if(isset($_POST['bfilterrptabsen'])){
	if(!empty($bulan) || !empty($divisi)){
		$_SESSION['bulan']=$bulan;
		$_SESSION['divisi']=$divisi;
	}
	
	echo"<script>document.location='?p=$page';</script>";
}

if(isset($_POST['brefreshrptabsen'])){
	if(!empty($_SESSION['bulan']) || !empty($_SESSION['divisi'])){
		$_SESSION['bulan']="";
		$_SESSION['divisi']="";
	}
	
	echo"<script>document.location='?p=$page';</script>";
	
}

/////////////////////////////////////////////////////////////////////////////

$abs_tampil_tgl=$abs->abs_tampil_tgl($abs_tgl_masuk);
while($abs_data_tgl=mysql_fetch_array($abs_tampil_tgl)){
    $absensi[$abs_data_tgl['kar_id']]=array("kar_id"=>$abs_data_tgl['kar_id'],
		                         "abs_sts"=>$abs_data_tgl['abs_sts']);
}


$abs_dtl_tampil_array=$abs->abs_dtl_tampil_array($abs_dtl_tgl);
while($abs_dtl_data_array=mysql_fetch_array($abs_dtl_tampil_array)){
    $absensidtl[$abs_dtl_data_array['kar_id']]=array("kar_id"=>$abs_dtl_data_array['kar_id'],
		                         "abs_dtl_sts"=>$abs_dtl_data_array['abs_dtl_sts']);
}

$kar_tampil_uptodate_unit2=$kar->kar_tampil_uptodate_unit2($kar_id);
while($abs_shf_data_array=mysql_fetch_array($kar_tampil_uptodate_unit2)){
    $absensishfdtldtl[$abs_shf_data_array['kar_id']]=array("kar_id"=>$abs_shf_data_array['kar_id'],
		                         "kar_default_shift2_in"=>$abs_shf_data_array['kar_default_shift2_in'],
								 "kar_default_shift2_out"=>$abs_shf_data_array['kar_default_shift2_out']);
}

//////////////////////////////////////////////////////////////////////////////
$sesidate = $_SESSION['bulan']."-01";
$akhirbulan = date("Y-m-t", strtotime($sesidate));

$tgl_1 = $sesidate;
$tgl_31= $akhirbulan;
			
$abs_tgl_rpt_bln_array=$abs->abs_tgl_rpt_bln_array($tgl_1,$tgl_31);
while($abs_data_rpt_bln_array=mysql_fetch_assoc($abs_tgl_rpt_bln_array)){
       $reportabsen[$abs_data_rpt_bln_array['kar_id']]=array("abs_cek_rpt_bln_array"=>$abs_data_rpt_bln_array['num_rows']);              
}

                        
$abs_tgl_rpt_point_array=$abs->abs_tgl_rpt_point_array($tgl_1,$tgl_31);
while($abs_cek_point_array=mysql_fetch_assoc($abs_tgl_rpt_point_array)){
	$pointabsen[$abs_cek_point_array['kar_id']]=array("abs_total_point_array"=>$abs_cek_point_array['point']);  
}


//////////////////////////////////////////////////////////////////////////////

?>