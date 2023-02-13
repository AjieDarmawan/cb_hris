<?php
$page=$_GET['p'];
$act=$_GET['act'];

//BIO-BIO
$bio_nm_panggil=$_POST['bio_nm_panggil'];
$bio_gender	   =$_POST['bio_gender'];
$bio_tml 	   =$_POST['bio_tml'];
$bio_goldarah  =$_POST['bio_goldarah'];
$bio_agama     =$_POST['bio_agama'];
$bio_bintang   =$_POST['bio_bintang'];
$bio_shio	   =$_POST['bio_shio'];
$bio_alt	   =$_POST['bio_alt'];
$bio_rtrw      =$_POST['bio_rtrw'];
$bio_kelurahan =$_POST['bio_kelurahan'];
$bio_kecamatan =$_POST['bio_kecamatan'];
$bio_kota	   =$_POST['bio_kota'];
$bio_propinsi  =$_POST['bio_propinsi'];
$bio_kodepos   =$_POST['bio_kodepos'];
$bio_tlp       =$_POST['bio_tlp'];
$bio_hp        =$_POST['bio_hp'];
$bio_eml       =$_POST['bio_eml'];
$bio_web 	   =$_POST['bio_web'];

if(isset($_POST['bsave_bio_bio'])){

    $bio_insert=$bio->bio_insert($bio_nm_panggil,$bio_gender,$bio_tml,$bio_goldarah,$bio_agama,$bio_bintang,$bio_shio,$bio_alt,$bio_rtrw,$bio_kelurahan,$bio_kecamatan,$bio_kota,$bio_propinsi,$bio_kodepos,$bio_tlp,$bio_hp,$bio_eml,$bio_web,$kar_id);
    echo"<script>document.location='?p=$page';</script>";
}
if($_GET['p']=="bio"){
    $bio_tampil_id=$bio->bio_tampil_id($kar_id);
    $data=mysql_fetch_array($bio_tampil_id);
}

//BIO PH
if($_GET['p']=="biodata_pasangan_hidup"){

    $bio_ph_tampil_id=$bio->bio_ph_tampil_id($kar_id);

    $data=mysql_fetch_array($bio_ph_tampil_id);

}

//HOBI
$hbi_nm =$_POST['hbi_nm'];
$hbi_lvl=$_POST['hbi_lvl'];
$hbi_thn=$_POST['hbi_thn'];

if(isset($_POST['bsave_hobi'])){

	$hbi_insert=$bio->hbi_insert($hbi_nm,$hbi_lvl,$hbi_thn,$kar_id);
	echo"<script>document.location='?p=$page';</script>";
}
if(isset($_POST['bupdate_hobi'])){

	$hbi_update=$bio->hbi_update($hbi_id,$hbi_nm,$hbi_lvl,$hbi_thn,$kar_id);
	echo"<script>document.location='?p=$page';</script>";
}

//CITA-CITA
$cta_nm =$_POST['cta_nm'];
$cta_thn=$_POST['cta_thn'];

if(isset($_POST['bsave_cita_cita'])){

	$cta_insert=$bio->cta_insert($cta_nm,$cta_thn,$kar_id);
	echo"<script>document.location='?p=$page';</script>";
}
if(isset($_POST['bupdate_cita_cita'])){

	$cta_update=$bio->cta_update($cta_id,$cta_nm,$cta_thn,$kar_id);
	echo"<script>document.location='?p=$page';</script>";
}

//KHURSUS
$khs_nm         =$_POST['khs_nm'];
$khs_lembaga    =$_POST['khs_lembaga'];
$khs_sertifikat =$_POST['khs_sertifikat'];
$khs_start		=$_POST['khs_start'];
$khs_end		=$_POST['khs_end'];
$khs_lokasi		=$_POST['khs_lokasi'];

if(isset($_POST['bsave_khursus'])){

	$khs_insert=$bio->khs_insert($khs_nm,$khs_lembaga,$khs_sertifikat,$khs_start,$khs_end,$khs_lokasi,$kar_id);
	echo"<script>document.location='?p=$page';</script>";
}
if(isset($_POST['bupdate_khursus'])){

	$khs_update=$bio->khs_update($khs_id,$khs_nm,$khs_lembaga,$khs_sertifikat,$khs_start,$khs_end,$khs_lokasi,$kar_id);
	echo"<script>document.location='?p=$page';</script>";
}

//PENGEMBANGAN_DIRI
$pgd_nm =$_POST['pgd_nm'];
$pgd_thn=$_POST['pgd_thn'];

if(isset($_POST['bsave_pengembangan_diri'])){

	$pgd_insert=$bio->pgd_insert($pgd_nm,$pgd_thn,$kar_id);
	echo"<script>document.location='?p=$page';</script>";
}
if(isset($_POST['bupdate_pengembangan_diri'])){

	$pgd_update=$bio->pgd_update($pgd_id,$pgd_nm,$pgd_thn,$kar_id);
	echo"<script>document.location='?p=$page';</script>";
}

//HARAPAN
$hrp_nm =$_POST['hrp_nm'];
$hrp_thn=$_POST['hrp_thn'];

if(isset($_POST['bsave_harapan'])){

	$hrp_insert=$bio->hrp_insert($hrp_nm,$hrp_thn,$kar_id);
	echo"<script>document.location='?p=$page';</script>";
}
if(isset($_POST['bupdate_harapan'])){

	$hrp_update=$bio->hrp_update($hrp_id,$hrp_nm,$hrp_thn,$kar_id);
	echo"<script>document.location='?p=$page';</script>";
}

//KEMAMPUAN_DIRI
$kpd_nm =$_POST['kpd_nm'];
$kpd_lvl=$_POST['kpd_lvl'];

if(isset($_POST['bsave_kemampuan_diri'])){

	$kpd_insert=$bio->kpd_insert($kpd_nm,$kpd_lvl,$kar_id);
	echo"<script>document.location='?p=$page';</script>";

}
if(isset($_POST['bupdate_kemampuan_diri'])){

	$kpd_update=$bio->kpd_update($kpd_id,$kpd_nm,$kpd_lvl,$kar_id);
	echo"<script>document.location='?p=$page';</script>";

}

//PENYAKIT
$pyk_nm   =$_POST['pyk_nm'];
$pyk_lvl  =$_POST['pyk_lvl'];
$pyk_start=$_POST['pyk_start'];
$pyk_end  =$_POST['pyk_end'];

if(isset($_POST['bsave_penyakit'])){

	$pyk_insert=$bio->pyk_insert($pyk_nm,$pyk_lvl,$pyk_start,$pyk_end,$kar_id);
	echo"<script>document.location='?p=$page';</script>";
}
if(isset($_POST['bupdate_penyakit'])){

	$pyk_update=$bio->pyk_update($pyk_id,$pyk_nm,$pyk_lvl,$pyk_start,$pyk_end,$kar_id);
	echo"<script>document.location='?p=$page';</script>";
}

//KERABAT
$kbt_nm      =$_POST['kbt_nm'];
$kbt_hubungan=$_POST['kbt_hubungan'];
$kbt_alt     =$_POST['kbt_alt'];
$kbt_kodepos =$_POST['kbt_kodepos'];
$kbt_tlp     =$_POST['kbt_tlp'];
$kbt_hp      =$_POST['kbt_hp'];

if(isset($_POST['bsave_kerabat'])){

	$kbt_insert=$bio->kbt_insert($kbt_nm,$kbt_hubungan,$kbt_alt,$kbt_kodepos,$kbt_tlp,$kbt_hp,$kar_id);
	echo"<script>document.location='?p=$page';</script>";
}
if(isset($_POST['bupdate_kerabat'])){

	$kbt_update=$bio->kbt_update($kbt_id,$kbt_nm,$kbt_hubungan,$kbt_alt,$kbt_kodepos,$kbt_tlp,$kbt_hp,$kar_id);
	echo"<script>document.location='?p=$page';</script>";
}

//KENDARAAN
$kdr_id=$_POST['kdr_id'];
$kdr_jns=$_POST['kdr_jns'];
$kdr_no =$_POST['kdr_no'];
$kdr_mrk=$_POST['kdr_mrk'];
$kdr_typ=$_POST['kdr_typ'];
$kdr_thn=$_POST['kdr_thn'];

if(isset($_POST['bsave_kendaraan'])){

	$kdr_insert=$bio->kdr_insert($kdr_jns,$kdr_no,$kdr_mrk,$kdr_typ,$kdr_thn,$kar_id);
	echo"<script>document.location='?p=$page';</script>";
}
if(isset($_POST['bupdate_kendaraan'])){

	$kdr_update=$bio->kdr_update($kdr_id,$kdr_jns,$kdr_no,$kdr_mrk,$kdr_typ,$kdr_thn,$kar_id);
	echo"<script>document.location='?p=$page';</script>";
}

//KARTU_KREDIT
$kkr_id   =$_POST['kkr_id'];
$kkr_bank =$_POST['kkr_bank'];
$kkr_limit=$_POST['kkr_limit'];
$kkr_tempo=$_POST['kkr_tempo'];

if(isset($_POST['bsave_kartu_kredit'])){

	$kkr_insert=$bio->kkr_insert($kkr_bank,$kkr_limit,$kkr_tempo,$kar_id);
	echo"<script>document.location='?p=$page';</script>";
}
if(isset($_POST['bupdate_kartu_kredit'])){

	$kkr_update=$bio->kkr_update($kkr_id,$kkr_bank,$kkr_limit,$kkr_tempo,$kar_id);
	echo"<script>document.location='?p=$page';</script>";
}


//KREDIT
$krd_jns   =$_POST['krd_jns'];
$krd_nm    =$_POST['krd_nm'];
$krd_des   =$_POST['krd_des'];
$krd_akad  =$_POST['krd_akad'];
$krd_durasi=$_POST['krd_durasi'];
$krd_via   =$_POST['krd_via'];

if(isset($_POST['bsave_kredit'])){

	$krd_insert=$bio->krd_insert($krd_jns,$krd_nm,$krd_des,$krd_akad,$krd_durasi,$krd_via,$kar_id);
	echo"<script>document.location='?p=$page';</script>";
}
if(isset($_POST['bupdate_kredit'])){

	$krd_update=$bio->krd_update($krd_id,$krd_jns,$krd_nm,$krd_des,$krd_akad,$krd_durasi,$krd_via,$kar_id);
	echo"<script>document.location='?p=$page';</script>";
}

//TEMPAT_TINGGAL
$ttg_jns          =$_POST['ttg_jns'];
$ttg_typ          =$_POST['ttg_typ'];
$ttg_luas_tanah   =$_POST['ttg_luas_tanah'];
$ttg_luas_bangunan=$_POST['ttg_luas_bangunan'];
$ttg_alt          =$_POST['ttg_alt'];
$ttg_thn          =$_POST['ttg_thn'];

if(isset($_POST['bsave_tempat_tinggal'])){

	$ttg_insert=$bio->ttg_insert($ttg_jns,$ttg_typ,$ttg_luas_tanah,$ttg_luas_bangunan,$ttg_alt,$ttg_thn,$kar_id);
	echo"<script>document.location='?p=$page';</script>";
}
if(isset($_POST['bupdate_tempat_tinggal'])){

	$ttg_update=$bio->ttg_update($ttg_id,$ttg_jns,$ttg_typ,$ttg_luas_tanah,$ttg_luas_bangunan,$ttg_alt,$ttg_thn,$kar_id);
	echo"<script>document.location='?p=$page';</script>";
}

//ANAK
$ank_id      =$_POST['ank_id'];
$ank_nm      =$_POST['ank_nm'];
$ank_gender  =$_POST['ank_gender'];
$ank_tml     =$_POST['ank_tml'];
$ank_tll     =$_POST['ank_tll'];
$ank_goldarah=$_POST['ank_goldarah'];
$ank_kondisi =$_POST['ank_kondisi'];

if(isset($_POST['bsave_anak'])){

	$ank_insert=$bio->ank_insert($ank_nm,$ank_gender,$ank_tml,$ank_tll,$ank_goldarah,$ank_kondisi,$kar_id);
	echo"<script>document.location='?p=$page';</script>";
}
if(isset($_POST['bupdate_anak'])){

	$ank_update=$bio->ank_update($ank_id,$ank_nm,$ank_gender,$ank_tml,$ank_tll,$ank_goldarah,$ank_kondisi,$kar_id);
	echo"<script>document.location='?p=$page';</script>";
}


//PASANGAN HIDUP
$bio_ph_nm        =$_POST['bio_ph_nm'];
$bio_ph_nm_panggil=$_POST['bio_ph_nm_panggil'];
$bio_ph_tml       =$_POST['bio_ph_tml'];
$bio_ph_tll	      =$_POST['bio_ph_tll'];
$bio_ph_goldarah  =$_POST['bio_ph_goldarah'];
$bio_ph_agama     =$_POST['bio_ph_agama'];

if(isset($_POST['bsave_pasangan_hidup'])){

	$bio_ph_insert=$bio->bio_ph_insert($bio_ph_nm,$bio_ph_nm_panggil,$bio_ph_tml,$bio_ph_tll,$bio_ph_goldarah,$bio_ph_agama,$kar_id);
	echo"<script>document.location='?p=$page';</script>";
}

//DOKUMEN PRIBADI

//SIM
$sim_jns       =$_POST['sim_jns'];
$sim_no        =$_POST['sim_no'];
$sim_masa      =$_POST['sim_masa'];

$sim_lok=str_replace(' ', '_', $_FILES['sim_img']['tmp_name']);
$sim_file=str_replace(' ', '_', $_FILES['sim_img']['name']);
$sim_size=$_FILES['sim_img']['size'];
$sim_type=$_FILES['sim_img']['type'];
$sim_pecah=explode(".", $sim_file);
$sim_extend=$sim_pecah[1];

$nmfoto = date('YmdHis');
$sim_newname=$nmfoto.$sim_file;

$sim_id      =$_POST['sim_id'];

if(isset($_POST['bsave_sim'])){
	if(!empty($sim_file)){
		    $errors     = array();
		    $maxsize    = 2097152;
		    $acceptable = array('jpg','png','jpeg','JPG','PNG','JPEG');

		    if(($sim_size >= $maxsize) || ($sim_size == 0)) {
			    $errors[] = 'File too large. File must be less than 2 megabytes.';
		    }
		    if(!in_array($sim_extend, $acceptable) && !empty($sim_extend)) {
			$errors[] = 'Invalid file type. Only JPG, PNG AND JPEG types are accepted.';
		    }
		    if(count($errors) === 0) {
			$sim_insert_file=$bio->sim_insert_file($sim_jns,$sim_no,$sim_newname,$sim_masa,$kar_id);
			if($sim_insert_file){
			    move_uploaded_file($sim_lok,"module/biodata/doc_scan/$sim_newname");
			    echo"<script>document.location='?p=$page';</script>";
			}
		    }else{
			foreach($errors as $error) {
			    echo "<script>alert('$error');document.location='?p=$page';</script>";
			}
			die(); 
		    }
            
	}else{
		$sim_insert=$bio->sim_insert($sim_jns,$sim_no,$sim_masa,$kar_id);
		echo"<script>document.location='?p=$page';</script>";
	}

}
if(isset($_POST['bupdate_sim'])){
	$sim_cek_img=$bio->sim_cek_img($sim_id);
    $sim_data_img=mysql_fetch_assoc($sim_cek_img);
	if(!empty($sim_file)){
		    $errors     = array();
		    $maxsize    = 2097152;
		    $acceptable = array('jpg','png','jpeg','JPG','PNG','JPEG');

		    if(($sim_size >= $maxsize) || ($sim_size == 0)) {
			    $errors[] = 'File too large. File must be less than 2 megabytes.';
		    }
		    if(!in_array($sim_extend, $acceptable) && !empty($sim_extend)) {
			$errors[] = 'Invalid file type. Only JPG, PNG AND JPEG types are accepted.';
		    }
		    if(count($errors) === 0) {
			$sim_update_file=$bio->sim_update_file($sim_id,$sim_jns,$sim_no,$sim_newname,$sim_masa,$kar_id);
			if($sim_update_file){

				$dir_img="module/biodata/doc_scan/".$sim_data_img['sim_img'];
				unlink($dir_img);

			    move_uploaded_file($sim_lok,"module/biodata/doc_scan/$sim_newname");
			    echo"<script>document.location='?p=$page';</script>";
			}
		    }else{
			foreach($errors as $error) {
			    echo "<script>alert('$error');document.location='?p=$page';</script>";
			}
			die(); 
		    }
            
	}else{
		$sim_update=$bio->sim_update($sim_id,$sim_jns,$sim_no,$sim_masa,$kar_id);
		echo"<script>document.location='?p=$page';</script>";
	}

}

//RIWAYAT_PEKERJAAN
$rwp_jbt         =$_POST['rwp_jbt'];
$rwp_lvl         =$_POST['rwp_lvl'];
$rwp_penghasilan =$_POST['rwp_penghasilan'];
$rwp_perusahaan  =$_POST['rwp_perusahaan'];
$rwp_alt         =$_POST['rwp_alt'];
$rwp_start       =$_POST['rwp_start'];
$rwp_end         =$_POST['rwp_end'];
$rwp_berhenti    =$_POST['rwp_berhenti'];

if(isset($_POST['bsave_riwayat_pekerjaan'])){

	$rwp_insert=$bio->rwp_insert($rwp_jbt,$rwp_lvl,$rwp_penghasilan,$rwp_perusahaan,$rwp_alt,$rwp_start,$rwp_end,$rwp_berhenti,$kar_id);
	echo"<script>document.location='?p=$page';</script>";
}
if(isset($_POST['bupdate_riwayat_pekerjaan'])){

	$rwp_update=$bio->rwp_update($rwp_id,$rwp_jbt,$rwp_lvl,$rwp_penghasilan,$rwp_perusahaan,$rwp_alt,$rwp_start,$rwp_end,$rwp_berhenti,$kar_id);
	echo"<script>document.location='?p=$page';</script>";
}

//PENDIDIKAN FORMAL PASANGAN HIDUP
$pdd_id       =$_POST['pdd_id'];
$pdd_lvl      =$_POST['pdd_lvl'];
$pdd_nm       =$_POST['pdd_nm'];
$pdd_jurusan  =$_POST['pdd_jurusan'];
$pdd_start    =$_POST['pdd_start'];
$pdd_end      =$_POST['pdd_end'];
$pdd_nilai    =$_POST['pdd_nilai'];
$pdd_lokasi   =$_POST['pdd_lokasi'];

 if(isset($_POST['bsave_pendidikan'])){
 
    $pdd_insert=$bio->pdd_insert($pdd_lvl,$pdd_nm,$pdd_jurusan,$pdd_start,$pdd_end,$pdd_nilai,$pdd_lokasi,$kar_id);
    echo"<script>document.location='?p=$page';</script>";
}
 if(isset($_POST['bupdate_pendidikan'])){
 
    $pdd_update=$bio->pdd_update($pdd_id,$pdd_lvl,$pdd_nm,$pdd_jurusan,$pdd_start,$pdd_end,$pdd_nilai,$pdd_lokasi,$kar_id);
    echo"<script>document.location='?p=$page';</script>";
}

//SAUDARA
$sdr_id       =$_POST['sdr_id'];
$sdr_nm       =$_POST['sdr_nm'];
$sdr_hubungan =$_POST['sdr_hubungan'];
$sdr_kondisi  =$_POST['sdr_kondisi'];
$sdr_alt      =$_POST['sdr_alt'];
$sdr_pekerjaan=$_POST['sdr_pekerjaan'];
$sdr_kodepos  =$_POST['sdr_kodepos'];
$sdr_tlp      =$_POST['sdr_tlp'];
$sdr_hp       =$_POST['sdr_hp'];

 if(isset($_POST['bsave_saudara'])){

 	$sdr_insert=$bio->sdr_insert($sdr_nm,$sdr_hubungan,$sdr_kondisi,$sdr_alt,$sdr_pekerjaan,$sdr_kodepos,$sdr_tlp,$sdr_hp,$kar_id);
 	echo"<script>document.location='?p=$page';</script>";
 }
 if(isset($_POST['bupdate_saudara'])){

 	$sdr_update=$bio->sdr_update($sdr_id,$sdr_nm,$sdr_hubungan,$sdr_kondisi,$sdr_alt,$sdr_pekerjaan,$sdr_kodepos,$sdr_tlp,$sdr_hp,$kar_id);
 	echo"<script>document.location='?p=$page';</script>";
 }

?>