<?php
$page=$_GET['p'];

if(isset($_POST['bmonth'])){

    if(!empty($_POST['filter_month'])){
        $_SESSION['fmonth'] = $_POST['filter_month'];
        $f_month = $_SESSION['fmonth'];
    }else{
        $_SESSION['fmonth'] = "";
    }

    echo"<script>document.location='?p=$page';</script>";
}

if(isset($_POST['bclearmonth'])){
    $_SESSION['fmonth'] = "";
    echo"<script>document.location='?p=$page';</script>";
}

if(!empty($_SESSION['fmonth'])){
    $f_month = $_SESSION['fmonth'];
}else{
    $f_month = date('m/Y');
}

/////////////////////////////////////////////////////////////////////////////////////////////
$exp_date = explode('/',$f_month);

if($f_month == '09/2020'){ //SEMENTARA
    $sesi_date1 = $exp_date[1] . '-' . $exp_date[0] . '-14'; //SEMENTARA
    $sesi_date2 = $exp_date[1] . '-' . $exp_date[0] . '-25';
    $tgl_awal = $sesi_date1; //SEMENTARA
    $tgl_akhir = $sesi_date2;
}elseif($f_month == '11/2021'){
	$sesi_date1 = $exp_date[1] . '-' . $exp_date[0] . '-09'; //SEMENTARA
    $sesi_date2 = $exp_date[1] . '-' . $exp_date[0] . '-25';
    $tgl_awal = $sesi_date1; //SEMENTARA
    $tgl_akhir = $sesi_date2;
}else{
    $sesi_date1 = $exp_date[1] . '-' . $exp_date[0] . '-26';
    $sesi_date2 = $exp_date[1] . '-' . $exp_date[0] . '-25';
    $tgl_awal = date('Y-m-d', strtotime('-1 month', strtotime($sesi_date1)));
    $tgl_akhir = $sesi_date2;
}

$karyawanArr = array();

$nrw_priode = str_replace('/','',$f_month);

$sql = "SELECT * FROM `nrw_data`
WHERE nrw_priode = '$nrw_priode' ORDER BY nrw_nama ASC";

$query=mysql_query($sql) or die (mysql_error());
while($data = mysql_fetch_assoc($query)){
    
    $nik = $data['nrw_nik'];
    $nama = $data['nrw_nama'];
    $kampus = $data['nrw_pts'];
    $grade = $data['nrw_grade'];
    $tcm = $data['nrw_tcm'];
    $jml_pmb_kotor = $data['nrw_jml_pmb_kotor'];
    $jml_pmb = $data['nrw_jml_pmb'];
    $jml_reg = $data['nrw_jml_reg'];
    $jml_her = $data['nrw_jml_her'];
    $jml_reg_real = $data['nrw_jml_reg_real'];
    $jml_reg_pts = $data['nrw_jml_reg_pts'];
    $data_source = $data['nrw_data'];
    $closing_rp25 = $data['nrw_closing_rp25']+0;
    $closing_rp50 = $data['nrw_closing_rp50']+0;
    $reward_reg = $data['nrw_reward_reg']+0;
    $reward_her = $data['nrw_reward_her']+0;
    $insentif = $data['nrw_insentif']+0;
	$ext_insentif = $data['nrw_extra_insentif']+0;
    $tot_insentif = $data['nrw_total_insentif']+0;
    $tot_insentif = $data['nrw_total_insentif']+0;
	
	$data_normal = json_decode($data['nrw_normal_data'], true);
    $data_libur = json_decode($data['nrw_libur_data'], true);
	
	$nor_npromo = $data_normal['nor_npromo'];
    $nor_promo = $data_normal['nor_promo'];
    $nor_total = $data_normal['nor_total'];
    
    $lib_npromo = $data_libur['lib_npromo'];
    $lib_promo = $data_libur['lib_promo'];
    $lib_total = $data_libur['lib_total'];
    
    $incase = $data['nrw_incase_data'];
    
    $nor_npromo_rp = $data_normal['nor_npromo_rp'];
    $nor_promo_rp = $data_normal['nor_promo_rp'];
    $nor_total_rp = $data_normal['nor_total_rp'];
    
    $lib_npromo_rp = $data_libur['lib_npromo_rp'];
    $lib_promo_rp = $data_libur['lib_promo_rp'];
    $lib_total_rp = $data_libur['lib_total_rp'];
    
    if($kar_data['kar_jdw_akses'] == "ALL"){
    
        $karyawanArr[$nik] = array('nik' => $nik,
                               'nama' => $nama,
                               'kampus' => $kampus,
                               'grade' => $grade,
                               'tcm' => $tcm,
                               'jml_pmb_kotor' => $jml_pmb_kotor,
                               'jml_pmb' => $jml_pmb,
                               'jml_reg' => $jml_reg,
                               'jml_her' => $jml_her,
                               'jml_reg_real' => $jml_reg_real,
                               'jml_reg_pts' => $jml_reg_pts,
                               'data_source' => $data_source,
                               'closing_rp25' => $closing_rp25,
                               'closing_rp50' => $closing_rp50,
                               'reward_reg' => $reward_reg,
                               'reward_her' => $reward_her,
                               'insentif' => $insentif,
							   'extra_insentif' => $ext_insentif,
                               'total_insentif' => $tot_insentif,
							   'nor_npromo' => $nor_npromo,
                               'nor_promo' => $nor_promo,
                               'nor_total' => $nor_total,
                               'lib_npromo' => $lib_npromo,
                               'lib_promo' => $lib_promo,
                               'lib_total' => $lib_total,
                               'incase' => $incase,
                               'nor_npromo_rp' => $nor_npromo_rp,
                               'nor_promo_rp' => $nor_promo_rp,
                               'nor_total_rp' => $nor_total_rp,
                               'lib_npromo_rp' => $lib_npromo_rp,
                               'lib_promo_rp' => $lib_promo_rp,
                               'lib_total_rp' => $lib_total_rp);
        
    }elseif($kar_data['kar_jdw_akses'] == "" || $kar_data['kar_jdw_akses'] == NULL){
        
        if($kar_data['kar_nik']==$nik){
            
            $karyawanArr[$nik] = array('nik' => $nik,
                               'nama' => $nama,
                               'kampus' => $kampus,
                               'grade' => $grade,
                               'tcm' => $tcm,
                               'jml_pmb_kotor' => $jml_pmb_kotor,
                               'jml_pmb' => $jml_pmb,
                               'jml_reg' => $jml_reg,
                               'jml_her' => $jml_her,
							   'jml_reg_real' => $jml_reg_real,
							   'jml_reg_pts' => $jml_reg_pts,
                               'data_source' => $data_source,
                               'closing_rp25' => $closing_rp25,
                               'closing_rp50' => $closing_rp50,
                               'reward_reg' => $reward_reg,
                               'reward_her' => $reward_her,
                               'insentif' => $insentif,
							   'extra_insentif' => $ext_insentif,
                               'total_insentif' => $tot_insentif,
							   'nor_npromo' => $nor_npromo,
                               'nor_promo' => $nor_promo,
                               'nor_total' => $nor_total,
                               'lib_npromo' => $lib_npromo,
                               'lib_promo' => $lib_promo,
                               'lib_total' => $lib_total,
                               'incase' => $incase,
                               'nor_npromo_rp' => $nor_npromo_rp,
                               'nor_promo_rp' => $nor_promo_rp,
                               'nor_total_rp' => $nor_total_rp,
                               'lib_npromo_rp' => $lib_npromo_rp,
                               'lib_promo_rp' => $lib_promo_rp,
                               'lib_total_rp' => $lib_total_rp);
        }
        
    }else{
        
        $kar_jdw_akses = $kar_data['kar_jdw_akses'].",".$kar_data['kar_nik'];
        $pos = strpos($kar_jdw_akses,$nik);
        if ($pos !== false) {
            
            $karyawanArr[$nik] = array('nik' => $nik,
                               'nama' => $nama,
                               'kampus' => $kampus,
                               'grade' => $grade,
                               'tcm' => $tcm,
                               'jml_pmb_kotor' => $jml_pmb_kotor,
                               'jml_pmb' => $jml_pmb,
                               'jml_reg' => $jml_reg,
                               'jml_her' => $jml_her,
							   'jml_reg_pts' => $jml_reg_pts,
                               'data_source' => $data_source,
                               'closing_rp25' => $closing_rp25,
                               'closing_rp50' => $closing_rp50,
                               'reward_reg' => $reward_reg,
                               'reward_her' => $reward_her,
                               'insentif' => $insentif,
							   'extra_insentif' => $ext_insentif,
                               'total_insentif' => $tot_insentif,
							   'nor_npromo' => $nor_npromo,
                               'nor_promo' => $nor_promo,
                               'nor_total' => $nor_total,
                               'lib_npromo' => $lib_npromo,
                               'lib_promo' => $lib_promo,
                               'lib_total' => $lib_total,
                               'incase' => $incase,
                               'nor_npromo_rp' => $nor_npromo_rp,
                               'nor_promo_rp' => $nor_promo_rp,
                               'nor_total_rp' => $nor_total_rp,
                               'lib_npromo_rp' => $lib_npromo_rp,
                               'lib_promo_rp' => $lib_promo_rp,
                               'lib_total_rp' => $lib_total_rp);
        }
    }
}

$exp_title = explode(" | ",$title);
$export_file_name = $exp_title[0] . " Cut Off " .  $tgl_awal . " - " . $tgl_akhir;
?>