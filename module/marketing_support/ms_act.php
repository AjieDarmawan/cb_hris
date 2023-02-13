<?php
$kar_nik=$_POST['kar_nik'];
$kar_nm=ucwords($_POST['kar_nm']);
$kar_tgl_lahir=$_POST['kar_tgl_lahir'];
$div_id=$_POST['div_id'];
$jbt_id=$_POST['jbt_id'];
$lvl_id=$_POST['lvl_id'];
$unt_id=$_POST['unt_id'];
$ktr_id=$_POST['ktr_id'];
$kot_id=$_POST['kot_id'];

//EMPLOYEE
$kar_dtl_sts_krj=$_POST['kar_dtl_sts_krj'];
$kar_dtl_typ_krj=$_POST['kar_dtl_typ_krj'];
$kar_dtl_tgl_joi=$_POST['kar_dtl_tgl_joi'];
$kar_dtl_tgl_res=$_POST['kar_dtl_tgl_res'];
$kar_dtl_als_res=$_POST['kar_dtl_als_res'];
//$kar_dtl_msa_krj=$_POST['kar_dtl_msa_krj'];
$masa_kerja=$msa->hitung_masa_kerja($kar_dtl_tgl_joi, $date);
$kar_dtl_msa_krj=$masa_kerja['years']." Thn, ".$masa_kerja['months']. " Bln";
$kar_dtl_apv_krj=$_POST['kar_dtl_apv_krj'];
$kar_dtl_btc_krj=$_POST['kar_dtl_btc_krj'];
$kar_dtl_mem_krj=$_POST['kar_dtl_mem_krj'];

//PROFILE PICTURE
$acc_lok=str_replace(' ', '_', $_FILES['acc_img']['tmp_name']);
$acc_img=str_replace(' ', '_', $_FILES['acc_img']['name']);
$acc_size=$_FILES['acc_img']['size'];
$acc_type=$_FILES['acc_img']['type'];
$acc_pecah=explode(".", $acc_img);
$acc_extend=$acc_pecah[1];

//BIO
$kar_dtl_usa=$_POST['kar_dtl_usa'];
$kar_dtl_gen=$_POST['kar_dtl_gen'];
$kar_dtl_tmp_lhr=$_POST['kar_dtl_tmp_lhr'];
$kar_dtl_sts_nkh=$_POST['kar_dtl_sts_nkh'];
$kar_dtl_jml_ank=$_POST['kar_dtl_jml_ank'];
$kar_dtl_tgn=$_POST['kar_dtl_tgn'];

//EDUCATION
$kar_dtl_pnd=$_POST['kar_dtl_pnd'];
$kar_dtl_jrs=$_POST['kar_dtl_jrs'];
$kar_dtl_unv_sch=$_POST['kar_dtl_unv_sch'];
$kar_dtl_sts_pnd=$_POST['kar_dtl_sts_pnd'];
$kar_dtl_thn_lls=$_POST['kar_dtl_thn_lls'];

//CARD
$kar_dtl_no_ktp=$_POST['kar_dtl_no_ktp'];
$kar_dtl_exp_ktp=$_POST['kar_dtl_exp_ktp'];
$kar_dtl_no_kk=$_POST['kar_dtl_no_kk'];
$kar_dtl_no_npw=$_POST['kar_dtl_no_npw'];
$kar_dtl_no_kpj=$_POST['kar_dtl_no_kpj'];
$kar_dtl_no_rek=$_POST['kar_dtl_no_rek'];
$kar_dtl_no_bpj=$_POST['kar_dtl_no_bpj'];
$kar_dtl_no_jms=$_POST['kar_dtl_no_jms'];

//CONTACT
$kar_dtl_eml=$_POST['kar_dtl_eml'];
$kar_dtl_tlp=$_POST['kar_dtl_tlp'];
$kar_dtl_alt=$_POST['kar_dtl_alt'];

$page=$_GET['p'];
$act=$_GET['act'];
$kar_id_=$_GET['id'];

if(isset($_POST['bsave'])){
	if($kar_data['kar_nik']==$kar_nik){
		echo"<script>alert('Sorry NIK or Username already registered ');document.location='?p=$page';</script>";
	}else{
		$kar_insert=$ms->ms_insert($kar_nik,$kar_nm,$kar_tgl_lahir,$div_id,$jbt_id,$lvl_id,$unt_id,$ktr_id,$kot_id);

		//Notify
		$ntf_id=mysql_insert_id();
		$ntf_act="Tambah Karyawan";
        $ntf_isi=$kar_id.'-'.$ntf_id.'-'.$kar_nik.'-'.$kar_nm.'-'.$kar_tgl_lahir.'-'.$jbt_id.'-'.$ktr_id.'-'.$kot_id;
        $ntf_ip=$ip_jaringan;
        $ntf_tgl=$date;
        $ntf_jam=$time;
        $ntf_insert=$ntf->ntf_insert($ntf_act,$ntf_isi,$ntf_ip,$ntf_tgl,$ntf_jam,$kar_id);
        //End Notify

		if($kar_insert){
			echo"<script>document.location='?p=$page';</script>";
		}else{
			echo"<script>alert('Insert Failed');document.location='?p=$page';</script>";
		}
	}
}
elseif(isset($_POST['bupdate'])){
	$kar_update=$ms->ms_update($kar_id_,$kar_nm,$kar_tgl_lahir,$div_id,$jbt_id,$lvl_id,$unt_id,$ktr_id,$kot_id);

	//Notify
	$ntf_id=$kar_id;
	$ntf_act="Update Karyawan";
    $ntf_isi=$ntf_id.'-'.$kar_nm.'-'.$kar_tgl_lahir.'-'.$jbt_id.'-'.$ktr_id.'-'.$kot_id;
    $ntf_ip=$ip_jaringan;
    $ntf_tgl=$date;
    $ntf_jam=$time;
    $ntf_insert=$ntf->ntf_insert($ntf_act,$ntf_isi,$ntf_ip,$ntf_tgl,$ntf_jam,$kar_id);
    //End Notify

	if($kar_update){
		echo"<script>document.location='?p=$page&id=$kar_id_';</script>";
	}else{
		echo"<script>alert('Insert Failed');document.location='?p=$page&id=$kar_id_';</script>";
	}
}
if(isset($_POST['bupdate_employee'])){

		$kar_tampil_detail=$ms->ms_tampil_detail($kar_id_);
		$kar_cek_detail=mysql_num_rows($kar_tampil_detail);

		if($kar_cek_detail > 0){
			$kar_update_employee=$ms->ms_update_employee($kar_dtl_sts_krj,$kar_dtl_typ_krj,$kar_dtl_tgl_joi,$kar_dtl_msa_krj,$kar_dtl_apv_krj,$kar_dtl_btc_krj,$kar_dtl_mem_krj,$kar_dtl_tgl_res,$kar_dtl_als_res,$kar_id_);
		}else{
			$kar_update_employee=$ms->ms_insert_employee($kar_dtl_sts_krj,$kar_dtl_typ_krj,$kar_dtl_tgl_joi,$kar_dtl_msa_krj,$kar_dtl_apv_krj,$kar_dtl_btc_krj,$kar_dtl_mem_krj,$kar_dtl_tgl_res,$kar_dtl_als_res,$kar_id_);
		}

		//Notify
		$ntf_id=$kar_id;
		$ntf_act="Update Employe";
	    $ntf_isi=$ntf_id.'-'.$kar_id_;
	    $ntf_ip=$ip_jaringan;
	    $ntf_tgl=$date;
	    $ntf_jam=$time;
	    $ntf_insert=$ntf->ntf_insert($ntf_act,$ntf_isi,$ntf_ip,$ntf_tgl,$ntf_jam,$kar_id);
	    //End Notify

	    //API INACTIVE ACCOUNT
	    $kar_tampil_id=$ms->ms_tampil_id($kar_id_);
		$kar_data_id=mysql_fetch_array($kar_tampil_id);

		$kar_nik_=$kar_data_id['kar_nik'];
		$div_id_=$kar_data_id['div_id'];

		$header = array(
		        'Content-Type: application/x-www-form-urlencoded',
		        'Connection: keep-alive'
		);

		$fields = array(
		        'nik' => $kar_nik_,
		        'status' => $kar_dtl_typ_krj,
		        'divisi' => $div_id_
		);

		$fields_string = '';
		foreach($fields as $key1=>$value1) { $fields_string .= $key1.'='.$value1.'&'; }
		rtrim($fields_string, '&');

		
		//SIPEMA ACCOUNT
		$SIPEMA_url = "http://103.86.160.10/api/inactive_user.php";
		$SIPEMA_curl = curl_init();
		curl_setopt_array($SIPEMA_curl, array(
		        CURLOPT_URL => $SIPEMA_url,
		        CURLOPT_RETURNTRANSFER => true,
		        CURLOPT_ENCODING => "",
		        CURLOPT_MAXREDIRS => 10,
		        //CURLOPT_TIMEOUT => 30,
		        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		        CURLOPT_CUSTOMREQUEST => "POST",
		        CURLOPT_POSTFIELDS => $fields_string,
		        CURLOPT_HTTPHEADER => $header,
		));
		$SIPEMA_response = curl_exec($SIPEMA_curl);
		$SIPEMA_err = curl_error($SIPEMA_curl);
		curl_close($SIPEMA_curl);
		$SIPEMA_datares = json_decode($SIPEMA_response, true);


		//BDC ACCOUNT
		$BDC_url = "https://mf.daftarkuliah.my.id/api/inactive_user.php";
		$BDC_curl = curl_init();
		curl_setopt_array($BDC_curl, array(
		        CURLOPT_URL => $BDC_url,
		        CURLOPT_RETURNTRANSFER => true,
		        CURLOPT_ENCODING => "",
		        CURLOPT_MAXREDIRS => 10,
		        //CURLOPT_TIMEOUT => 30,
		        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		        CURLOPT_CUSTOMREQUEST => "POST",
		        CURLOPT_POSTFIELDS => $fields_string,
		        CURLOPT_HTTPHEADER => $header,
		));
		$BDC_response = curl_exec($BDC_curl);
		$BDC_err = curl_error($BDC_curl);
		curl_close($BDC_curl);
		$BDC_datares = json_decode($BDC_response, true);


		//GGKLIK ACCOUNT
		$GGKLIK_url = "http://personalia.web.id/ayorajinklik/api/inactive_user.php";
		$GGKLIK_curl = curl_init();
		curl_setopt_array($GGKLIK_curl, array(
		        CURLOPT_URL => $GGKLIK_url,
		        CURLOPT_RETURNTRANSFER => true,
		        CURLOPT_ENCODING => "",
		        CURLOPT_MAXREDIRS => 10,
		        //CURLOPT_TIMEOUT => 30,
		        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		        CURLOPT_CUSTOMREQUEST => "POST",
		        CURLOPT_POSTFIELDS => $fields_string,
		        CURLOPT_HTTPHEADER => $header,
		));
		$GGKLIK_response = curl_exec($GGKLIK_curl);
		$GGKLIK_err = curl_error($GGKLIK_curl);
		curl_close($GGKLIK_curl);
		$GGKLIK_datares = json_decode($GGKLIK_response, true);
		

		//MARKTOOL ACCOUNT
		$MARKTOOL_url = "http://gg.gilland-grafika.com/api/inactive_user.php";
		$MARKTOOL_curl = curl_init();
		curl_setopt_array($MARKTOOL_curl, array(
		        CURLOPT_URL => $MARKTOOL_url,
		        CURLOPT_RETURNTRANSFER => true,
		        CURLOPT_ENCODING => "",
		        CURLOPT_MAXREDIRS => 10,
		        //CURLOPT_TIMEOUT => 30,
		        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		        CURLOPT_CUSTOMREQUEST => "POST",
		        CURLOPT_POSTFIELDS => $fields_string,
		        CURLOPT_HTTPHEADER => $header,
		));
		$MARKTOOL_response = curl_exec($MARKTOOL_curl);
		$MARKTOOL_err = curl_error($MARKTOOL_curl);
		curl_close($MARKTOOL_curl);
		$MARKTOOL_datares = json_decode($MARKTOOL_response, true);


		if($kar_update_employee){
			echo"<script>document.location='?p=$page&id=$kar_id_';</script>";
		}else{
			echo"<script>alert('Insert Failed');document.location='?p=$page&id=$kar_id_';</script>";
		}
}
if(isset($_POST['bupdate_bio'])){

		$kar_tampil_detail=$ms->ms_tampil_detail($kar_id_);
		$kar_cek_detail=mysql_num_rows($kar_tampil_detail);

		if($kar_cek_detail > 0){
			$kar_update_bio=$ms->ms_update_bio($kar_dtl_usa,$kar_dtl_gen,$kar_dtl_tmp_lhr,$kar_dtl_sts_nkh,$kar_dtl_jml_ank,$kar_dtl_tgn,$kar_id_);
		}else{
			$kar_update_bio=$ms->ms_insert_bio($kar_dtl_usa,$kar_dtl_gen,$kar_dtl_tmp_lhr,$kar_dtl_sts_nkh,$kar_dtl_jml_ank,$kar_dtl_tgn,$kar_id_);
		}

		//Notify
		$ntf_id=$kar_id;
		$ntf_act="Update Bio";
	    $ntf_isi=$ntf_id.'-'.$kar_id_;
	    $ntf_ip=$ip_jaringan;
	    $ntf_tgl=$date;
	    $ntf_jam=$time;
	    $ntf_insert=$ntf->ntf_insert($ntf_act,$ntf_isi,$ntf_ip,$ntf_tgl,$ntf_jam,$kar_id);
	    //End Notify

		if($kar_update_bio){
			echo"<script>document.location='?p=$page&id=$kar_id_';</script>";
		}else{
			echo"<script>alert('Insert Failed');document.location='?p=$page&id=$kar_id_';</script>";
		}
}
if(isset($_POST['bupdate_education'])){
		
		$kar_tampil_detail=$ms->ms_tampil_detail($kar_id_);
		$kar_cek_detail=mysql_num_rows($kar_tampil_detail);

		if($kar_cek_detail > 0){
			$kar_update_education=$ms->ms_update_education($kar_dtl_pnd,$kar_dtl_jrs,$kar_dtl_unv_sch,$kar_dtl_sts_pnd,$kar_dtl_thn_lls,$kar_id_);
		}else{
			$kar_update_education=$ms->ms_insert_education($kar_dtl_pnd,$kar_dtl_jrs,$kar_dtl_unv_sch,$kar_dtl_sts_pnd,$kar_dtl_thn_lls,$kar_id_);
		}

		//Notify
		$ntf_id=$kar_id;
		$ntf_act="Update Education";
	    $ntf_isi=$ntf_id.'-'.$kar_id_;
	    $ntf_ip=$ip_jaringan;
	    $ntf_tgl=$date;
	    $ntf_jam=$time;
	    $ntf_insert=$ntf->ntf_insert($ntf_act,$ntf_isi,$ntf_ip,$ntf_tgl,$ntf_jam,$kar_id);
	    //End Notify

		if($kar_update_education){
			echo"<script>document.location='?p=$page&id=$kar_id_';</script>";
		}else{
			echo"<script>alert('Insert Failed');document.location='?p=$page&id=$kar_id_';</script>";
		}
}
if(isset($_POST['bupdate_card'])){

		$kar_tampil_detail=$ms->ms_tampil_detail($kar_id_);
		$kar_cek_detail=mysql_num_rows($kar_tampil_detail);

		if($kar_cek_detail > 0){
			$kar_update_card=$ms->ms_update_card($kar_dtl_no_ktp,$kar_dtl_exp_ktp,$kar_dtl_no_kk,$kar_dtl_no_npw,$kar_dtl_no_kpj,$kar_dtl_no_rek,$kar_dtl_no_bpj,$kar_dtl_no_jms,$kar_id_);
		}else{
			$kar_update_card=$ms->ms_insert_card($kar_dtl_no_ktp,$kar_dtl_exp_ktp,$kar_dtl_no_kk,$kar_dtl_no_npw,$kar_dtl_no_kpj,$kar_dtl_no_rek,$kar_dtl_no_bpj,$kar_dtl_no_jms,$kar_id_);
		}

		//Notify
		$ntf_id=$kar_id;
		$ntf_act="Update Card";
	    $ntf_isi=$ntf_id.'-'.$kar_id_;
	    $ntf_ip=$ip_jaringan;
	    $ntf_tgl=$date;
	    $ntf_jam=$time;
	    $ntf_insert=$ntf->ntf_insert($ntf_act,$ntf_isi,$ntf_ip,$ntf_tgl,$ntf_jam,$kar_id);
	    //End Notify

		if($kar_update_card){
			echo"<script>document.location='?p=$page&id=$kar_id_';</script>";
		}else{
			echo"<script>alert('Insert Failed');document.location='?p=$page&id=$kar_id_';</script>";
		}
}
if(isset($_POST['bupdate_contact'])){
		
		$kar_tampil_detail=$ms->ms_tampil_detail($kar_id_);
		$kar_cek_detail=mysql_num_rows($kar_tampil_detail);

		if($kar_cek_detail > 0){
			$kar_update_contact=$ms->ms_update_contact($kar_dtl_eml,$kar_dtl_tlp,$kar_dtl_alt,$kar_id_);
		}else{
			$kar_update_contact=$ms->ms_insert_contact($kar_dtl_eml,$kar_dtl_tlp,$kar_dtl_alt,$kar_id_);
		}

		//Notify
		$ntf_id=$kar_id;
		$ntf_act="Update Contact";
	    $ntf_isi=$ntf_id.'-'.$kar_id_;
	    $ntf_ip=$ip_jaringan;
	    $ntf_tgl=$date;
	    $ntf_jam=$time;
	    $ntf_insert=$ntf->ntf_insert($ntf_act,$ntf_isi,$ntf_ip,$ntf_tgl,$ntf_jam,$kar_id);
	    //End Notify

		if($kar_update_contact){
			echo"<script>document.location='?p=$page&id=$kar_id_';</script>";
		}else{
			echo"<script>alert('Insert Failed');document.location='?p=$page&id=$kar_id_';</script>";
		}
}
if(isset($_POST['bupdate_img'])){
		$errors     = array();
		$maxsize    = 512000;
		$acceptable = array('jpeg','jpg','gif','png','JPEG','JPG','GIF','PNG');

		if(($acc_size >= $maxsize) || ($acc_size == 0)) {
		        $errors[] = 'File too large. File must be less than 500 Kilobytes (KB).';
		}
		if(!in_array($acc_extend, $acceptable) && !empty($acc_extend)) {
		    $errors[] = 'Invalid file type. Only JPG, GIF and PNG types are accepted.';
		}
		if(count($errors) === 0) {
		    $acc_img_update=$acc->acc_img_update($acc_img,$kar_id_);

		    //Notify
		    $ntf_id=$kar_id;
		    $ntf_act="Upload Foto Profile";
		    $ntf_isi=$ntf_id.'-'.$acc_img;
		    $ntf_ip=$ip_jaringan;
		    $ntf_tgl=$date;
		    $ntf_jam=$time;
		    $ntf_insert=$ntf->ntf_insert($ntf_act,$ntf_isi,$ntf_ip,$ntf_tgl,$ntf_jam,$kar_id);
		    //End Notify

            if($acc_img_update){
				if(!empty($acc_data['acc_img'])){
				    $dir_img="module/profile/img/$acc_data[acc_img]";	
				    unlink($dir_img);
				    move_uploaded_file($acc_lok,"module/profile/img/$acc_img");
				    echo"<script>document.location='?p=$page&id=$kar_id_';</script>";
				}else{
				    move_uploaded_file($acc_lok,"module/profile/img/$acc_img");
				    echo"<script>document.location='?p=$page&id=$kar_id_';</script>";
				}
					require_once('lib/php_image_magician.php');
					$magicianObj = new imageLib('module/profile/img/'.$acc_img);
                    $magicianObj->resizeImage(300, 300, 'crop');
                    $magicianObj->saveImage('module/profile/img/'.$acc_img,300);  
            }else{
                    echo"<script>alert('Upload Failed');document.location='?p=$page&id=$kar_id_';</script>";
			}
		}else{
		    foreach($errors as $error) {
		        echo "<script>alert('$error');document.location='?p=$page&id=$kar_id_';</script>";
		    }
		    die(); 
		}


}
if(isset($_POST['bupdate_jdwakses'])){
		
		foreach ($_POST['kar_jdw_akses'] as $val){
			$jdw_akses[] = $val;
		}
		$kar_jdw_akses=implode(",", $jdw_akses);
	
		$kar_update_jdwakses = $ms->ms_update_jdwakses($kar_id_,$kar_jdw_akses);
		
		/*//Notify
		$ntf_id=$kar_id;
		$ntf_act="Update Jadwal View Akses";
	    $ntf_isi=$ntf_id.'-'.$kar_id_;
	    $ntf_ip=$ip_jaringan;
	    $ntf_tgl=$date;
	    $ntf_jam=$time;
	    $ntf_insert=$ntf->ntf_insert($ntf_act,$ntf_isi,$ntf_ip,$ntf_tgl,$ntf_jam,$kar_id);
	    //End Notify

		if($kar_update_contact){
			echo"<script>document.location='?p=$page&id=$kar_id_';</script>";
		}else{
			echo"<script>alert('Insert Failed');document.location='?p=$page&id=$kar_id_';</script>";
		}*/
}

if(isset($page)&&($act)){
	$kar_delete=$ms->ms_delete($kar_id_);
	echo"<script>document.location='?p=$page';</script>";

	//Notify
	$ntf_id=$kar_id;
	$ntf_act="Delete Karyawan";
    $ntf_isi=$ntf_id;
    $ntf_ip=$ip_jaringan;
    $ntf_tgl=$date;
    $ntf_jam=$time;
    $ntf_insert=$ntf->ntf_insert($ntf_act,$ntf_isi,$ntf_ip,$ntf_tgl,$ntf_jam,$kar_id);
    //End Notify
}
if(isset($page)&&($kar_id_)){
	$kar_tampil_id=$ms->ms_tampil_id($kar_id_);
	$kar_data_id=mysql_fetch_array($kar_tampil_id);

	$kar_id_=$kar_data_id['kar_id'];

	$acc_tampil_kar_=$acc->acc_tampil_ms_kar($kar_id_);
	$acc_data_=mysql_fetch_array($acc_tampil_kar_);

		$kar_tampil_detail=$ms->ms_tampil_detail($kar_id_);
		$kar_cek_detail=mysql_num_rows($kar_tampil_detail);

		if($kar_cek_detail > 0){
			$kar_data_detail=mysql_fetch_array($kar_tampil_detail);

			$kar_dtl_tgl_joi=$kar_data_detail['kar_dtl_tgl_joi'];
	        $masa_kerja=$msa->hitung_masa_kerja($kar_dtl_tgl_joi, $date);
	        $kar_dtl_msa_krj_=$masa_kerja['years']." Thn, ".$masa_kerja['months']. " Bln";
	    }
}

//AUTO NIK	
$kd_awal="MS";
$kd_tahun = date("Y");
$kar_nik = $ms->ms_nik($kdawal);
$cek_kar_nik  = mysql_num_rows($kar_nik);
$data_kar_nik  = mysql_fetch_array($kar_nik);

$max_kar_nik = $data_kar_nik['max_nik'];

$no_urut_nik = (int) substr($max_kar_nik, 7, 6);
$no_urut_nik++;

$kar_nik_auto = $ms->ms_nik_auto();
$data_nik_auto  = mysql_fetch_array($kar_nik_auto);
$no_urut_auto = $data_nik_auto['max_nik_auto'];
$no_urut_auto++;

$new_nik = $kd_awal . "." .sprintf("%04s", $no_urut_auto). "." .$kd_tahun;
?>