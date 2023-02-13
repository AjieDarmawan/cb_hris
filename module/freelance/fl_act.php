<?php
$kar_nik=$_POST['kar_nik'];
$kar_nm=ucwords($_POST['kar_nm']);
$kar_tgl_lahir=$_POST['kar_tgl_lahir'];
$div_id=$_POST['div_id'];
$lvl_id=$_POST['lvl_id'];
$unt_id=$_POST['unt_id'];
$ktr_id=$_POST['ktr_id'];

$page=$_GET['p'];
$act=$_GET['act'];
$kar_id_=$_GET['id'];

//EMPLOYEE
$kar_dtl_sts_krj=$_POST['kar_dtl_sts_krj'];
$kar_dtl_typ_krj=$_POST['kar_dtl_typ_krj'];
$kar_dtl_tgl_joi=$_POST['kar_dtl_tgl_joi'];
//$kar_dtl_msa_krj=$_POST['kar_dtl_msa_krj'];
$masa_kerja=$msa->hitung_masa_kerja($kar_dtl_tgl_joi, $date);
$kar_dtl_msa_krj=$masa_kerja['years']." Thn, ".$masa_kerja['months']. " Bln";

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
$kar_dtl_alt_dms=$_POST['kar_dtl_alt_dms'];

$kar_tampil_detail=$fln->kar_tampil_detail($kar_id_);
$kar_cek_detail=mysql_num_rows($kar_tampil_detail);

//SIMPAN KARYAWAN
if(isset($_POST['bsave'])){
	if($kar_data['kar_nik']==$kar_nik){
		echo"<script>alert('Sorry NIK or Username already registered ');document.location='?p=$page';</script>";
	}else{
		$kar_insert=$fln->kar_insert($kar_nik,$kar_nm,$kar_tgl_lahir,$div_id,$lvl_id,$unt_id,$ktr_id);
		/*
		//Notify
		$ntf_id=mysql_insert_id();
		$ntf_act="Tambah Karyawan";
        $ntf_isi=$kar_id.'-'.$ntf_id.'-'.$kar_nik.'-'.$kar_nm.'-'.$kar_tgl_lahir.'-'.$ktr_id;
        $ntf_ip=$ip_jaringan;
        $ntf_tgl=$date;
        $ntf_jam=$time;
        $ntf_insert=$ntf->ntf_insert($ntf_act,$ntf_isi,$ntf_ip,$ntf_tgl,$ntf_jam,$kar_id);
        //End Notify
		*/
		if($kar_insert){
			echo"<script>document.location='?p=$page';</script>";
		}else{
			echo"<script>alert('Insert Failed');document.location='?p=$page';</script>";
		}
	}
}
//UPDATE KARYAWAN
elseif(isset($_POST['bupdate'])){
	$kar_update=$fln->kar_update($kar_id_,$kar_nm,$kar_tgl_lahir,$div_id,$lvl_id,$unt_id,$ktr_id);
	/*
	//Notify
	$ntf_id=$kar_id;
	$ntf_act="Update Karyawan";
    $ntf_isi=$ntf_id.'-'.$kar_nm.'-'.$kar_tgl_lahir.'-'.$jbt_id.'-'.$ktr_id;
    $ntf_ip=$ip_jaringan;
    $ntf_tgl=$date;
    $ntf_jam=$time;
    $ntf_insert=$ntf->ntf_insert($ntf_act,$ntf_isi,$ntf_ip,$ntf_tgl,$ntf_jam,$kar_id);
    //End Notify
	*/
	if($kar_update){
		echo"<script>document.location='?p=$page&id=$kar_id_';</script>";
	}else{
		echo"<script>alert('Insert Failed');document.location='?p=$page&id=$kar_id_';</script>";
	}
}
//UPDATE EMPLOYE
elseif(isset($_POST['bupdate_employee'])){

		if($kar_cek_detail > 0){
			$kar_update_employee=$fln->kar_update_employee($kar_dtl_sts_krj,$kar_dtl_typ_krj,$kar_dtl_tgl_joi,$kar_dtl_msa_krj,$kar_id_);
		}else{
			$kar_update_employee=$fln->kar_insert_employee($kar_dtl_sts_krj,$kar_dtl_typ_krj,$kar_dtl_tgl_joi,$kar_dtl_msa_krj,$kar_id_);
		}
		/*
		//Notify
		$ntf_id=$kar_id;
		$ntf_act="Update Employe";
	    $ntf_isi=$ntf_id.'-'.$kar_id_;
	    $ntf_ip=$ip_jaringan;
	    $ntf_tgl=$date;
	    $ntf_jam=$time;
	    $ntf_insert=$ntf->ntf_insert($ntf_act,$ntf_isi,$ntf_ip,$ntf_tgl,$ntf_jam,$kar_id);
	    //End Notify
		*/
		if($kar_update_employee){
			echo"<script>document.location='?p=$page&id=$kar_id_';</script>";
		}else{
			echo"<script>alert('Insert Failed');document.location='?p=$page&id=$kar_id_';</script>";
		}
}
//UPDATE BIODATA
elseif(isset($_POST['bupdate_bio'])){
	
		if($kar_cek_detail > 0){
			$kar_update_bio=$fln->kar_update_bio($kar_dtl_usa,$kar_dtl_gen,$kar_dtl_tmp_lhr,$kar_dtl_sts_nkh,$kar_dtl_jml_ank,$kar_dtl_tgn,$kar_id_);
		}else{
			$kar_update_bio=$fln->kar_insert_bio($kar_dtl_usa,$kar_dtl_gen,$kar_dtl_tmp_lhr,$kar_dtl_sts_nkh,$kar_dtl_jml_ank,$kar_dtl_tgn,$kar_id_);
		}
		/*
		//Notify
		$ntf_id=$kar_id;
		$ntf_act="Update Bio";
	    $ntf_isi=$ntf_id.'-'.$kar_id_;
	    $ntf_ip=$ip_jaringan;
	    $ntf_tgl=$date;
	    $ntf_jam=$time;
	    $ntf_insert=$ntf->ntf_insert($ntf_act,$ntf_isi,$ntf_ip,$ntf_tgl,$ntf_jam,$kar_id);
	    //End Notify
		*/

		if($kar_update_bio){
			echo"<script>document.location='?p=$page&id=$kar_id_';</script>";
		}else{
			echo"<script>alert('Insert Failed');document.location='?p=$page&id=$kar_id_';</script>";
		}
}
//UPDATE EDUCATION
elseif(isset($_POST['bupdate_education'])){
		
		if($kar_cek_detail > 0){
			$kar_update_education=$fln->kar_update_education($kar_dtl_pnd,$kar_dtl_jrs,$kar_dtl_unv_sch,$kar_dtl_sts_pnd,$kar_dtl_thn_lls,$kar_id_);
		}else{
			$kar_update_education=$fln->kar_insert_education($kar_dtl_pnd,$kar_dtl_jrs,$kar_dtl_unv_sch,$kar_dtl_sts_pnd,$kar_dtl_thn_lls,$kar_id_);
		}
		/*
		//Notify
		$ntf_id=$kar_id;
		$ntf_act="Update Education";
	    $ntf_isi=$ntf_id.'-'.$kar_id_;
	    $ntf_ip=$ip_jaringan;
	    $ntf_tgl=$date;
	    $ntf_jam=$time;
	    $ntf_insert=$ntf->ntf_insert($ntf_act,$ntf_isi,$ntf_ip,$ntf_tgl,$ntf_jam,$kar_id);
	    //End Notify
		*/
		if($kar_update_education){
			echo"<script>document.location='?p=$page&id=$kar_id_';</script>";
		}else{
			echo"<script>alert('Insert Failed');document.location='?p=$page&id=$kar_id_';</script>";
		}
}
//UPDATE CARD
elseif(isset($_POST['bupdate_card'])){
	
		if($kar_cek_detail > 0){
			$kar_update_card=$fln->kar_update_card($kar_dtl_no_ktp,$kar_dtl_exp_ktp,$kar_dtl_no_kk,$kar_dtl_no_npw,$kar_dtl_no_kpj,$kar_dtl_no_rek,$kar_dtl_no_bpj,$kar_dtl_no_jms,$kar_id_);
		}else{
			$kar_update_card=$fln->kar_insert_card($kar_dtl_no_ktp,$kar_dtl_exp_ktp,$kar_dtl_no_kk,$kar_dtl_no_npw,$kar_dtl_no_kpj,$kar_dtl_no_rek,$kar_dtl_no_bpj,$kar_dtl_no_jms,$kar_id_);
		}
		/*
		//Notify
		$ntf_id=$kar_id;
		$ntf_act="Update Card";
	    $ntf_isi=$ntf_id.'-'.$kar_id_;
	    $ntf_ip=$ip_jaringan;
	    $ntf_tgl=$date;
	    $ntf_jam=$time;
	    $ntf_insert=$ntf->ntf_insert($ntf_act,$ntf_isi,$ntf_ip,$ntf_tgl,$ntf_jam,$kar_id);
	    //End Notify
		*/
		if($kar_update_card){
			echo"<script>document.location='?p=$page&id=$kar_id_';</script>";
		}else{
			echo"<script>alert('Insert Failed');document.location='?p=$page&id=$kar_id_';</script>";
		}
}
//UPDATE KONTAK
elseif(isset($_POST['bupdate_contact'])){
		
		if($kar_cek_detail > 0){
			$kar_update_contact=$fln->kar_update_contact($kar_dtl_eml,$kar_dtl_tlp,$kar_dtl_alt,$kar_dtl_alt_dms,$kar_id_);
		}else{
			$kar_update_contact=$fln->kar_insert_contact($kar_dtl_eml,$kar_dtl_tlp,$kar_dtl_alt,$kar_dtl_alt_dms,$kar_id_);
		}
		/*
		//Notify
		$ntf_id=$kar_id;
		$ntf_act="Update Contact";
	    $ntf_isi=$ntf_id.'-'.$kar_id_;
	    $ntf_ip=$ip_jaringan;
	    $ntf_tgl=$date;
	    $ntf_jam=$time;
	    $ntf_insert=$ntf->ntf_insert($ntf_act,$ntf_isi,$ntf_ip,$ntf_tgl,$ntf_jam,$kar_id);
	    //End Notify
		*/
		if($kar_update_contact){
			echo"<script>document.location='?p=$page&id=$kar_id_';</script>";
		}else{
			echo"<script>alert('Insert Failed');document.location='?p=$page&id=$kar_id_';</script>";
		}
}
//DETAIL KARYAWAN
elseif(isset($page)&&($kar_id_)){
	$kar_tampil_id_fl=$fln->kar_tampil_id_fl($kar_id_);
	$kar_data_id=mysql_fetch_array($kar_tampil_id_fl);

	$kar_id_=$kar_data_id['kar_id'];

	$acc_tampil_kar_=$afl->acc_tampil_kar($kar_id_);
	$acc_data_=mysql_fetch_array($acc_tampil_kar_);

		if($kar_cek_detail > 0){
			$kar_data_detail=mysql_fetch_array($kar_tampil_detail);
			$kar_dtl_tgl_joi=$kar_data_detail['kar_dtl_tgl_joi'];
	        $masa_kerja=$msa->hitung_masa_kerja($kar_dtl_tgl_joi, $date);
	        $kar_dtl_msa_krj_=$masa_kerja['years']." Thn, ".$masa_kerja['months']. " Bln";
	    }
}
//HAPUS KARYAWAN
if(isset($page)&&($act)){
	$kar_delete=$fln->kar_delete($kar_id_);
	echo"<script>document.location='?p=$page';</script>";
	/*
	//Notify
	$ntf_id=$kar_id;
	$ntf_act="Delete Karyawan";
    $ntf_isi=$ntf_id;
    $ntf_ip=$ip_jaringan;
    $ntf_tgl=$date;
    $ntf_jam=$time;
    $ntf_insert=$ntf->ntf_insert($ntf_act,$ntf_isi,$ntf_ip,$ntf_tgl,$ntf_jam,$kar_id);
    //End Notify
	*/
}

//AUTO NIK	
$kd_awal="FL";
$kd_tahun = date("Y");
$kar_nik = $fln->kar_nik($kdawal);
$cek_kar_nik  = mysql_num_rows($kar_nik);
$data_kar_nik  = mysql_fetch_array($kar_nik);

$max_kar_nik = $data_kar_nik['max_nik'];

$no_urut_nik = (int) substr($max_kar_nik, 7, 6);
$no_urut_nik++;

$kar_nik_auto = $fln->kar_nik_auto();
$data_nik_auto  = mysql_fetch_array($kar_nik_auto);
$no_urut_auto = $data_nik_auto['max_nik_auto'];
$no_urut_auto++;

$new_nik = $kd_awal . "." .sprintf("%04s", $no_urut_auto). "." .$kd_tahun;
?>