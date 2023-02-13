<?php
error_reporting(E_ALL ^ E_NOTICE);
date_default_timezone_set('Asia/Jakarta');
session_start();

$page = "rekap_simulasi_new_reward_v3.php";

$date = date('Y-m-d');

if(isset($_POST['bday'])){
    
    if(!empty($_POST['filter_divisi'])){
        $_SESSION['fdivisi'] = $_POST['filter_divisi'];
        $filter_divisi = $_SESSION['fdivisi'];
    }else{
        $_SESSION['fdivisi'] = "";
    }

    if(!empty($_POST['filter_day'])){
        $_SESSION['fday'] = $_POST['filter_day'];
        $filter_day = $_SESSION['fday'];
    }else{
        $_SESSION['fday'] = "";
    }
    
    if(!empty($_POST['filter_day2'])){
        $_SESSION['fday2'] = $_POST['filter_day2'];
        $filter_day2 = $_SESSION['fday2'];
    }else{
        $_SESSION['fday2'] = "";
    }
    echo"<script>document.location='".$page."';</script>";
}

if(isset($_POST['bclearday'])){
    $_SESSION['fdivisi'] = "";
    $_SESSION['fday'] = "";
    $_SESSION['fday2'] = "";
    echo"<script>document.location='".$page."';</script>";
}

$data_bulan = array();

if(!empty($_SESSION['fday']) &&
   !empty($_SESSION['fday2']) &&
   !empty($_SESSION['fdivisi'])){
        $sesi_divisi = $_SESSION['fdivisi'];
		$sesi_day = $_SESSION['fday'];
        $sesi_day2 = $_SESSION['fday2'];
        
        $exp_day_ori = explode('/', $sesi_day);
        $exp_day2_ori = explode('/', $sesi_day2);
        $sesi_day_ori = $exp_day_ori[2]."-".$exp_day_ori[1]."-".$exp_day_ori[0];
        $sesi_day2_ori = $exp_day2_ori[2]."-".$exp_day2_ori[1]."-".$exp_day2_ori[0];
	
		$data_bulan[] = $exp_day_ori[1] . $exp_day_ori[2];
		$data_bulan[] = $exp_day2_ori[1] . $exp_day2_ori[2];
        
}else{
        $sesi_divisi = 'cs';
		$sesi_day = date("d/m/Y", strtotime($date));
        $sesi_day2 = date("d/m/Y", strtotime($date));
        
        $exp_day_ori = explode('/', $sesi_day);
        $exp_day2_ori = explode('/', $sesi_day2);
        $sesi_day_ori = $exp_day_ori[2]."-".$exp_day_ori[1]."-".$exp_day_ori[0];
        $sesi_day2_ori = $exp_day2_ori[2]."-".$exp_day2_ori[1]."-".$exp_day2_ori[0];
	
		$data_bulan[] = $exp_day_ori[1] . $exp_day_ori[2];
		$data_bulan[] = $exp_day2_ori[1] . $exp_day2_ori[2];
}

$list_divisi = array('cs'=>'CS-Telemarketing',
                     'unit'=>'Sekretariat');

//ABM KHUSUS 14-25 SEP 20
$target_abm = array('CS' => 18,
	     'A' => 12,
	     'B' => 9,
	     'C' => 5);

////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////

require('class.php');
require('object.php');

$db->koneksi();

function array_sort_by_column(&$arr, $col, $dir = SORT_ASC) {
    $sort_col = array();
    foreach ($arr as $key=> $row) {
        $sort_col[$key] = $row[$col];
    }

    array_multisort($sort_col, $dir, $arr);
}

function replaceCharsInNumber($num, $chars) {
   return substr((string) $num, 0, -strlen($chars)) . $chars;
}

function strpos_arr($haystack, $needle) {
    if(!is_array($needle)) $needle = array($needle);
    foreach($needle as $what) {
        if(($pos = strpos($haystack, $what))!==false) return $pos;
    }
    return false;
}

//kode tanggal merah
$needle1 = array('C-','GL-');
$needle2 = array('L','LN','LM');

$karyawanArr = array();

if(!empty($_SESSION['fday']) &&
   !empty($_SESSION['fday2']) &&
   !empty($_SESSION['fdivisi'])){
    
    if($_SESSION['fdivisi'] == "unit"){
    
        $insentif = 0;
        $closing_rp = 0;
		$rwd_reg = 0;
		$rwd_reg_pts = 0;
        $rwd_her = 0;
        $closing_rp_10 = 0;
        $closing_rp_11 = 0;
        $closing_rp25 = 0;
        $closing_rp50 = 0;
	
		$nor_npromo = 0;
		$nor_promo = 0;
		$nor_total = 0;
		$nor_npromo_rp = 0;
		$nor_promo_rp = 0;
		$nor_total_rp = 0;

		$lib_npromo = 0;
		$lib_promo = 0;
		$lib_total = 0;
		$lib_npromo_rp = 0;
		$lib_promo_rp = 0;
		$lib_total_rp = 0;

		$incase = 0;

		$dataTglMerah = array();
		/*$jdw_blnthn = implode("','",$data_bulan);
		$jdw_rwd_tglmerah = $jdw->jdw_rwd_tglmerah($jdw_blnthn, 'Sekretariat');
		while($data = mysql_fetch_assoc($jdw_rwd_tglmerah)){
			$jdw_nik = $data['jdw_nik'];
			$jdw_blnthn = $data['jdw_blnthn'];
			$jdw_data = explode("#",$data['jdw_data']);
			
			$tgl_merah = false;
			$z=1;
			for($i=0; $i<count($jdw_data); $i++){
			
			$jdw_hari = sprintf("%02d", $z);
			$jdw_bulan = substr($jdw_blnthn,0,2);
			$jdw_tahun = substr($jdw_blnthn,2,4);
			
			$jdw_tanggal = $jdw_tahun ."-". $jdw_bulan ."-". $jdw_hari;
			
			$haystack1 = $jdw_data[$i];
			
			if (is_numeric(strpos_arr($haystack1, $needle1))) {
				$tgl_merah = true;
			} else {
				if(in_array($haystack1, $needle2)) {
					$tgl_merah = true;
				}else{
					$tgl_merah = false;
				}
			}
			
			if($tgl_merah){
				$dataTglMerah[$jdw_nik][]= $jdw_tanggal;
			}
			$z++;
			}
		}*/

		/*echo "<pre>";
		print_r($dataTglMerah);
		echo "</pre>";

		die;*/
        
        $sql = "SELECT a.kar_nik,a.kar_nm,a.kar_logika,
        GROUP_CONCAT(b.grd_kpt ORDER BY a.kar_nik) kpt,
        GROUP_CONCAT(b.grd_pts ORDER BY a.kar_nik) pts,
        GROUP_CONCAT(b.grd_grade ORDER BY a.kar_nik) grade,
        GROUP_CONCAT(b.grd_target ORDER BY a.kar_nik) target
        FROM `kar_master` a, `grade_pencapaian` b
        WHERE b.grd_karyawan LIKE CONCAT('%', REPLACE(a.kar_nik,'.',''), '%')
		#AND a.kar_nik IN ('SG.0357.2016','SG.0609.2021','SG.0143.2013','SG.0637.2021','SG.0596.2021','SG.0615.2021')
        AND a.div_id = '8' GROUP BY a.kar_nik
		#LIMIT 50;";
        
        $query=mysql_query($sql) or die (mysql_error());
        while($data = mysql_fetch_assoc($query)){
        
            $nik = $data['kar_nik'];
            $nama = $data['kar_nm'];
			$logika = $data['kar_logika'];
            $kpt = $data['kpt'];
            $pts = $data['pts'];
            $exp_grade = explode(",",$data['grade']);
            $exp_target = explode(",",$data['target']);
            
            $arr_grade = array();
            for($x=0;$x<count($exp_target);$x++){
                $arr_grade[$exp_target[$x]] = array('grade' => $exp_grade[$x], 'target' => $exp_target[$x]);
            }
            
            ksort($arr_grade);
            $grade = end($arr_grade);
            
            ////////////////////////////////////////////////////////////////////////////////////////////////
            
            $header = array(
                    'Content-Type: application/x-www-form-urlencoded',
                    'Connection: keep-alive'
            );
        
            $fields = array(
                    'kar_nik' => urlencode($nik),
                    'start' => urlencode($sesi_day_ori),
                    'end' => urlencode($sesi_day2_ori),
                    'kodept' => urlencode($kpt),
					'logika' => urlencode($logika)
            );
          
            $fields_string = '';
            foreach($fields as $key1=>$value1) { $fields_string .= $key1.'='.$value1.'&'; }
            rtrim($fields_string, '&');
            
            ////////////////////////////////////////////////////////////////////////////
            
            $SIPEMA_url = "http://103.86.160.10/sipema/grade_new_pencapaian.php";
            
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
            ////////////////////////////////////////////////////////////////////////////////////////////////
            
            $jml_pmb = $SIPEMA_datares[0];
            $jml_her = $SIPEMA_datares[1];
            $jml_reg = $SIPEMA_datares[2];
            $data_mhs = $SIPEMA_datares[3];
            
            ////////////////////////////////////////////////////////////////////////////////////////////////
            if($sesi_day_ori == '2020-09-14' && $sesi_day2_ori == '2020-09-25'){
				if($logika == 2){ // UNTUK YANG ROLLING
					$target_tcm = 11;
				}else{
					$target_tcm = $target_abm[$grade['grade']]; //SEMENTARA ABM
				}
			}else{
				if($logika == 2){ // UNTUK YANG ROLLING
					$target_tcm = 30;
				}else{
					$target_tcm = $grade['target']; //TARGET CAPAIAN MINIMUM
				}
			}
            
            if($jml_reg > $target_tcm){
                
                $jml_capai = $jml_reg - $target_tcm;
                
                if($jml_capai <= 10){
                    $closing_rp_10 = $jml_capai * 25000;
                    $closing_rp_11 = 0;
                }else{
                    $closing_rp_10 = 10 * 25000;
                    
                    $jml_capai_11 = $jml_capai - 10;
                    $closing_rp_11 = $jml_capai_11 * 50000;
                }
                
                $closing_rp25 = $closing_rp_10;
                $closing_rp50 = $closing_rp_11;
                
                $closing_rp = $closing_rp_10 + $closing_rp_11;
                
            }else{
                
                $closing_rp25 = 0;
                $closing_rp50 = 0;
                
                $closing_rp = 0;
            }
	    
			/////////////////////////////SETTINGAN RWD BARU///////////////////////////////////
            $data_reg = array();
			if($jml_pmb > 0){
				$data_parse = json_decode($data_mhs, true);
				if(!empty($data_parse)){
					$rwd_reg = 0;
					$rwd_reg_extra = 0;
					$persen_formulir = 0;
					$nor_npromo = 0;
					$nor_promo = 0;
					$lib_npromo = 0;
					$lib_promo = 0;
					$nor_npromo_rp = 0;
					$nor_promo_rp = 0;
					$lib_npromo_rp = 0;
					$lib_promo_rp = 0;
					$incase = 0;
					$y=1;
					foreach($data_parse as $key => $val){
						
							$status = $val['status'];
							$smb_info = $val['smb_info'];
							$reg_tanggal = $val['tanggal'];
							$logika = $val['logika'];
							$kodept = strtoupper($val['kodept']);
							
							if($kodept == 'TB'){ //khusus stt bandung frm dibuat max 100rb krna ada up jaket dimasukan ke frm
								$biaya_formulir = 100000;
							}elseif($kodept == 'KOM' || $kodept == 'JIM'){ //khusus stikom frm dibuat max 300rb
								$biaya_formulir = 300000;
							}else{
								$biaya_formulir = $val['biaya_formulir'];
							}
							
							$nom_formulir = (float)replaceCharsInNumber($val['formulir'], '00');
							
							if($status != 'KP'){
								
																	
									if($logika >= 10 && $logika <= 100){
										if($smb_info != 'GSF' &&
										   $smb_info != 'eduAgent' &&
										   $smb_info != 'Rekomendasi Online' &&
										   $smb_info != 'Teman'){
											   
												if($nom_formulir < $biaya_formulir){
													if(in_array($reg_tanggal, $dataTglMerah[$nik])) {
														$persen_formulir = 50000; //promo registrasi HARI LIBUR
														$data_reg[$key]='GET-LIBUR';
														$lib_promo = $lib_promo + 1;
														$lib_promo_rp = $lib_promo_rp + $persen_formulir;
													}else{
														$persen_formulir = 5000; //promo registrasi
														$data_reg[$key]='GET';
														$nor_promo = $nor_promo + 1;
														$nor_promo_rp = $nor_promo_rp + $persen_formulir;
													}
												}else{
													$persen_formulir = 0;
													$data_reg[$key]='NOT PROMO';
													$incase = $incase + 1;
												}
										}else{
											$persen_formulir = 0;
											$data_reg[$key]='GSF PROMO';
											$incase = $incase + 1;
										}
									}else{
										if($nom_formulir >= $biaya_formulir){
											if($nom_formulir >= 100000 && $nom_formulir <= 100999){
												if(in_array($reg_tanggal, $dataTglMerah[$nik])) {
													$persen_formulir = 100000;
													$data_reg[$key]='GET-LIBUR';
													$lib_npromo = $lib_npromo + 1;
													$lib_npromo_rp = $lib_npromo_rp + $persen_formulir;
												}else{
													$persen_formulir = 25000;
													$data_reg[$key]='GET';
													$nor_npromo = $nor_npromo + 1;
													$nor_npromo_rp = $nor_npromo_rp + $persen_formulir;
												}
											}elseif($nom_formulir > 100999){
												if(in_array($reg_tanggal, $dataTglMerah[$nik])) {
													$persen_formulir = 100000;
													$data_reg[$key]='GET-LIBUR';
													$lib_npromo = $lib_npromo + 1;
													$lib_npromo_rp = $lib_npromo_rp + $persen_formulir;
												}else{
													if($kodept == 'KOM' || $kodept == 'JIM'){ //khusus stikom frm dibuat max 300rb
														if($nom_formulir > 300000){
															$persen_formulir = 25000;
															$data_reg[$key]='GET';
															$nor_npromo = $nor_npromo + 1;
															$nor_npromo_rp = $nor_npromo_rp + $persen_formulir;
														}else{
															$persen_formulir = 25000;
															$data_reg[$key]='GET';
															$nor_npromo = $nor_npromo + 1;
															$nor_npromo_rp = $nor_npromo_rp + $persen_formulir;
														}
													}else{
														$persen_formulir = 25000;
														$data_reg[$key]='GET';
														$nor_npromo = $nor_npromo + 1;
														$nor_npromo_rp = $nor_npromo_rp + $persen_formulir;
													}
												}
											}else{
												$persen_formulir = 0;
												$data_reg[$key]='NOT PROMO';
												$incase = $incase + 1;
											}
										}else{
											$persen_formulir = 0;
											$data_reg[$key]='NOT PROMO';
											$incase = $incase + 1;
										}
									}
								
								//dsni
							}else{
								$persen_formulir = 0;
								$data_reg[$key]='NOT';
								//$incase = $incase + 1;
							}
							
							/*if($y <= $target_tcm){
								$rwd_reg = $rwd_reg + $persen_formulir;
							}else{
								$rwd_reg_extra = $rwd_reg_extra + $persen_formulir;
							}*/
							
							$rwd_reg = $rwd_reg + $persen_formulir;
							
							$y++;
					}
				}else{
					$rwd_reg = 0;
					$rwd_reg_extra = 0;
				}
			}else{
				$rwd_reg = 0;
				$rwd_reg_extra = 0;
			}
            
            $data_source = array();
            $data_parse = json_decode($data_mhs, true);
            if(!empty($data_parse)){
                foreach($data_parse as $key => $val){
					if($val['status'] != 'KP'){
						$data_source[$key] = array('biobid' => $val['biobid'],
							  'angkatan' => $val['angkatan'],
							  'status' => $val['status'],
							  'nosel' => $val['nosel'],
							  'nama' => $val['nama'],
							  'smb_info' => $val['smb_info'],
							  'tanggal' => $val['tanggal'],
							  'tanggal_her' => $val['tanggal_her'],
							  'status_reg' => $data_reg[$key],
							  'status_her' => 'NOT', //reward heregis di tutup
							  'biaya_formulir' => $val['biaya_formulir'],
							  'formulir' => $val['formulir'],
							  'logika' => $val['logika'],
							  'kodept' => $val['kodept']);
					}
                }
            }
			$rwd_reg_pts = 0;
			if(!empty($data_source)){			
                foreach($data_source as $key => $val){
					if(($val['kodept'] == strtoupper($kpt)) && ($val['status_reg'] !='NOT-PROMO' || $val['status_reg'] !='GSF-PROMO')){
						$rwd_reg_pts = $rwd_reg_pts + 1;
					}
				}
			}
			
			$real_reg = $jml_pmb - $incase;
			/*
			if($real_reg > $target_tcm){
				$extra_insentif = 500000;
			}else{
				$extra_insentif = 0;
			}
			*/
			if($rwd_reg_pts >= $target_tcm){
				$extra_insentif = 500000;
			}else{
				$extra_insentif = 0;
			}
			$insentif = $rwd_reg;
			
			/*$extra_insentif = ($rwd_reg_extra) ? 500000 : 0;*/
			$total_insentif = $insentif + $extra_insentif;
			
			$nor_total = (int)$nor_npromo + (int)$nor_promo;
			$nor_total_rp = (float)$nor_npromo_rp + (float)$nor_promo_rp;
			$reward_normal_data = array('nor_npromo' => $nor_npromo,
						'nor_promo' => $nor_promo,
						'nor_total' => $nor_total,
						'nor_npromo_rp' => $nor_npromo_rp,
						'nor_promo_rp' => $nor_promo_rp,
						'nor_total_rp' => $nor_total_rp
						 );
			
			$lib_total = (int)$lib_npromo + (int)$lib_promo;
			$lib_total_rp = (float)$lib_npromo_rp + (float)$lib_promo_rp;
			$reward_libur_data = array('lib_npromo' => $lib_npromo,
						'lib_promo' => $lib_promo,
						'lib_total' => $lib_total,
						'lib_npromo_rp' => $lib_npromo_rp,
						'lib_promo_rp' => $lib_promo_rp,
						'lib_total_rp' => $lib_total_rp
						 );
            
            if($logika == 2){ // UNTUK YANG ROLLING
				$karyawanArr[$nik] = array('nik' => $nik,
							'nama' => $nama,
							'kpt' => '-',
							'pts' => '(ROLLING)',
							'grade' => 'D',
							'tcm' => $target_tcm,
							'jml_pmb' => $jml_pmb,
							'jml_reg' => $jml_reg,
							'jml_her' => $jml_her,
							'data' => json_encode($data_source, JSON_HEX_APOS),
							'tg1' => $sesi_day_ori,
							'tg2' => $sesi_day2_ori,
							'closing_rp25' => 0,
							'closing_rp50' => 0,
							'reward_reg' => 0,
							'reward_her' => 0,
							'reward_normal_data' => json_encode($reward_normal_data, JSON_HEX_APOS),
							'reward_libur_data' => json_encode($reward_libur_data, JSON_HEX_APOS),
							'insentif' => $insentif,
							'extra_insentif' => $extra_insentif,
						    'total_insentif' => $total_insentif,
							'real_reg' => $real_reg,
							'rwd_reg_pts' => $rwd_reg_pts,
							'incase' => $incase);
			}else{
				$karyawanArr[$nik] = array('nik' => $nik,
						   'nama' => $nama,
						   'kpt' => $kpt,
						   'pts' => $pts,
						   'grade' => $grade['grade'],
						   'tcm' => $target_tcm,
						   'jml_pmb' => $jml_pmb,
						   'jml_reg' => $jml_reg,
						   'jml_her' => $jml_her,
						   'data' => json_encode($data_source, JSON_HEX_APOS),
						   'tg1' => $sesi_day_ori,
						   'tg2' => $sesi_day2_ori,
						   'closing_rp25' => 0,
						   'closing_rp50' => 0,
						   'reward_reg' => 0,
						   'reward_her' => 0,
						   'reward_normal_data' => '',
						   'reward_libur_data' => '',
						   'reward_normal_data' => json_encode($reward_normal_data, JSON_HEX_APOS),
						   'reward_libur_data' => json_encode($reward_libur_data, JSON_HEX_APOS),
						   'insentif' => $insentif,
						   'extra_insentif' => $extra_insentif,
						   'total_insentif' => $total_insentif,
						   'real_reg' => $real_reg,
						   'rwd_reg_pts' => $rwd_reg_pts,
						   'incase' => $incase);
			}
        }
		
    }else{
        
        $insentif = 0;
        $closing_rp = 0;
		$rwd_reg = 0;
		$rwd_reg_pts=0;
        $rwd_her = 0;
        $closing_rp25 = 0;
        $closing_rp50 = 0;
	
		$nor_npromo = 0;
		$nor_promo = 0;
		$nor_total = 0;
		$nor_npromo_rp = 0;
		$nor_promo_rp = 0;
		$nor_total_rp = 0;

		$lib_npromo = 0;
		$lib_promo = 0;
		$lib_total = 0;
		$lib_npromo_rp = 0;
		$lib_promo_rp = 0;
		$lib_total_rp = 0;

		$incase = 0;
	
		$dataTglMerah = array();
		/*$jdw_blnthn = implode("','",$data_bulan);
		$jdw_rwd_tglmerah = $jdw->jdw_rwd_tglmerah($jdw_blnthn, 'CS - Telemarketing');
		while($data = mysql_fetch_assoc($jdw_rwd_tglmerah)){
			$jdw_nik = $data['jdw_nik'];
			$jdw_blnthn = $data['jdw_blnthn'];
			$jdw_data = explode("#",$data['jdw_data']);
			
			$tgl_merah = false;
			$z=1;
			for($i=0; $i<count($jdw_data); $i++){
			
			$jdw_hari = sprintf("%02d", $z);
			$jdw_bulan = substr($jdw_blnthn,0,2);
			$jdw_tahun = substr($jdw_blnthn,2,4);
			
			$jdw_tanggal = $jdw_tahun ."-". $jdw_bulan ."-". $jdw_hari;
			
			$haystack1 = $jdw_data[$i];
			
			if (is_numeric(strpos_arr($haystack1, $needle1))) {
				$tgl_merah = true;
			} else {
				if(in_array($haystack1, $needle2)) {
					$tgl_merah = true;
				}else{
					$tgl_merah = false;
				}
			}
			
			if($tgl_merah){
				$dataTglMerah[$jdw_nik][]= $jdw_tanggal;
			}
			$z++;
			}
		}*/
		
		/*echo "<pre>";
		print_r($dataTglMerah);
		echo "</pre>";
		
		die;*/
        
        $kar_tampil = $kar->kar_tampil_cs_staff();
        while($data = mysql_fetch_assoc($kar_tampil)){
            
            $nik = $data['kar_nik'];
            $nama = $data['kar_nm'];
            
            ////////////////////////////////////////////////////////////////////////////////////////////////
            
            $header = array(
                    'Content-Type: application/x-www-form-urlencoded',
                    'Connection: keep-alive'
            );
        
            $fields = array(
                    'kar_nik' => urlencode($nik),
                    'start' => urlencode($sesi_day_ori),
                    'end' => urlencode($sesi_day2_ori)
            );
          
            $fields_string = '';
            foreach($fields as $key1=>$value1) { $fields_string .= $key1.'='.$value1.'&'; }
            rtrim($fields_string, '&');
            
            ////////////////////////////////////////////////////////////////////////////
            
            $SIPEMA_url = "http://103.86.160.10/sipema/grade_new_pencapaian_cs.php";
            
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
            ////////////////////////////////////////////////////////////////////////////////////////////////
            
            $jml_pmb = $SIPEMA_datares[0];
            $jml_her = $SIPEMA_datares[1];
            $jml_reg = $SIPEMA_datares[2];
            $data_mhs = $SIPEMA_datares[3];
            
            ////////////////////////////////////////////////////////////////////////////////////////////////
            
            if($sesi_day_ori == '2020-09-14' && $sesi_day2_ori == '2020-09-25'){
				$target_tcm = $target_abm['CS']; //SEMENTARA ABM
			}else{
				$target_tcm = 60; //TARGET CAPAIAN MINIMUM
			}
            
            if($jml_reg > $target_tcm){
                
                $jml_capai = $jml_reg - $target_tcm;
                
                if($jml_capai <= 10){
                    $closing_rp_10 = $jml_capai * 25000;
                    $closing_rp_11 = 0;
                }else{
                    $closing_rp_10 = 10 * 25000;
                    
                    $jml_capai_11 = $jml_capai - 10;
                    $closing_rp_11 = $jml_capai_11 * 50000;
                }
                
                $closing_rp25 = $closing_rp_10;
                $closing_rp50 = $closing_rp_11;
                
                $closing_rp = $closing_rp_10 + $closing_rp_11;
                
            }else{
                
                $closing_rp25 = 0;
                $closing_rp50 = 0;
                
                $closing_rp = 0;
            }
	    
            $data_reg = array();
			if($jml_pmb > 0){
				$data_parse = json_decode($data_mhs, true);
				if(!empty($data_parse)){
					$rwd_reg = 0;
					$rwd_her =0;
					$rwd_reg_extra = 0;
					$persen_formulir = 0;
					$nor_npromo = 0;
					$nor_promo = 0;
					$lib_npromo = 0;
					$lib_promo = 0;
					$nor_npromo_rp = 0;
					$nor_promo_rp = 0;
					$lib_npromo_rp = 0;
					$lib_promo_rp = 0;
					$incase = 0;
					$y=1;
					foreach($data_parse as $key => $val){
						
						$status = $val['status'];
						$smb_info = $val['smb_info'];
						$reg_tanggal = $val['tanggal'];
						$logika = $val['logika'];
						$kodept = strtoupper($val['kodept']);
						
						if($kodept == 'TB'){ //khusus stt bandung frm dibuat max 100rb krna ada up jaket dimasukan ke frm
							$biaya_formulir = 100000;
						}elseif($kodept == 'KOM' || $kodept == 'JIM'){ //khusus stikom frm dibuat max 300rb
							$biaya_formulir = 300000;
						}else{
							$biaya_formulir = $val['biaya_formulir'];
						}

						$nom_formulir = (float)replaceCharsInNumber($val['formulir'], '00');
						
						if($status != 'KP'){
							
								if($logika >= 10 && $logika <= 100){
									if($smb_info != 'GSF' &&
									   $smb_info != 'eduAgent' &&
									   $smb_info != 'Rekomendasi Online' &&
									   $smb_info != 'Teman'){
									
											if($nom_formulir < $biaya_formulir){
												if(in_array($reg_tanggal, $dataTglMerah[$nik])) {
													$persen_formulir = 50000;
													$data_reg[$key]='GET-LIBUR';
													$lib_promo = $lib_promo + 1;
													$lib_promo_rp = $lib_promo_rp + $persen_formulir;
												}else{
													$persen_formulir = 5000;
													$data_reg[$key]='GET';
													$nor_promo = $nor_promo + 1;
													$nor_promo_rp = $nor_promo_rp + $persen_formulir;
												}
											}else{
												$persen_formulir = 0;
												$data_reg[$key]='NOT PROMO';
												$incase = $incase + 1;
											}
									}else{
										$persen_formulir = 0;
										$data_reg[$key]='GSF PROMO';
										$incase = $incase + 1;
									}
								}else{
									if($nom_formulir >= $biaya_formulir){
										if($nom_formulir >= 100000 && $nom_formulir <= 100999){
											if(in_array($reg_tanggal, $dataTglMerah[$nik])) {
												$persen_formulir = 100000;
												$data_reg[$key]='GET-LIBUR';
												$lib_npromo = $lib_npromo + 1;
												$lib_npromo_rp = $lib_npromo_rp + $persen_formulir;
											}else{
												$persen_formulir = 25000;
												$data_reg[$key]='GET';
												$nor_npromo = $nor_npromo + 1;
												$nor_npromo_rp = $nor_npromo_rp + $persen_formulir;
											}
										}elseif($nom_formulir > 100999){
											if(in_array($reg_tanggal, $dataTglMerah[$nik])) {
												$persen_formulir = 100000;
												$data_reg[$key]='GET-LIBUR';
												$lib_npromo = $lib_npromo + 1;
												$lib_npromo_rp = $lib_npromo_rp + $persen_formulir;
											}else{
												if($kodept == 'KOM' || $kodept == 'JIM'){ //khusus stikom frm dibuat max 300rb
													if($nom_formulir > 300000){
														$persen_formulir = 25000;
														$data_reg[$key]='GET';
														$nor_npromo = $nor_npromo + 1;
														$nor_npromo_rp = $nor_npromo_rp + $persen_formulir;
													}else{
														$persen_formulir = 25000;
														$data_reg[$key]='GET';
														$nor_npromo = $nor_npromo + 1;
														$nor_npromo_rp = $nor_npromo_rp + $persen_formulir;
													}
												}else{
													$persen_formulir = 25000;
													$data_reg[$key]='GET';
													$nor_npromo = $nor_npromo + 1;
													$nor_npromo_rp = $nor_npromo_rp + $persen_formulir;
												}
											}
										}else{
											$persen_formulir = 0;
											$data_reg[$key]='NOT PROMO';
											$incase = $incase + 1;
										}
									}else{
										$persen_formulir = 0;
										$data_reg[$key]='NOT PROMO';
										$incase = $incase + 1;
									}
								}
								
							
							//dsni
						}else{
							$persen_formulir = 0;
							$data_reg[$key]='NOT';
							//$incase = $incase + 1;
						}
						/*
						if($y <= $target_tcm){
							$rwd_reg = $rwd_reg + $persen_formulir;
						}else{
							$rwd_reg_extra = $rwd_reg_extra + $persen_formulir;
						}
						*/
						$rwd_reg = $rwd_reg + $persen_formulir;
						$y++;
					}
				}else{
					$rwd_reg = 0;
					$rwd_reg_extra = 0;
				}
			}else{
				$rwd_reg = 0;
				$rwd_reg_extra = 0;
			}
            
            $data_source = array();
            $data_parse = json_decode($data_mhs, true);
            if(!empty($data_parse)){
                foreach($data_parse as $key => $val){
					if($val['status'] != 'KP'){
						$data_source[$key] = array('biobid' => $val['biobid'],
							  'angkatan' => $val['angkatan'],
							  'status' => $val['status'],
							  'nosel' => $val['nosel'],
							  'nama' => $val['nama'],
							  'smb_info' => $val['smb_info'],
							  'tanggal' => $val['tanggal'],
							  'tanggal_her' => $val['tanggal_her'],
							  'status_reg' => $data_reg[$key],
							  'status_her' => 'NOT', //reward heregis ditutup
							  'biaya_formulir' => $val['biaya_formulir'],
							  'formulir' => $val['formulir'],
							  'logika' => $val['logika']);
					}
                }
            }
			
			$real_reg = $jml_pmb - $incase;
			if($real_reg >= $target_tcm){
				$extra_insentif = 500000;
			}else{
				$extra_insentif = 0;
			}
			$insentif = $rwd_reg;
			
			/*$extra_insentif = ($rwd_reg_extra) ? 500000 : 0;*/
			$total_insentif = $insentif + $extra_insentif;
	    
			$nor_total = (int)$nor_npromo + (int)$nor_promo;
			$nor_total_rp = (float)$nor_npromo_rp + (float)$nor_promo_rp;
			$reward_normal_data = array('nor_npromo' => $nor_npromo,
						'nor_promo' => $nor_promo,
						'nor_total' => $nor_total,
						'nor_npromo_rp' => $nor_npromo_rp,
						'nor_promo_rp' => $nor_promo_rp,
						'nor_total_rp' => $nor_total_rp
						);
			
			$lib_total = (int)$lib_npromo + (int)$lib_promo;
			$lib_total_rp = (float)$lib_npromo_rp + (float)$lib_promo_rp;
			$reward_libur_data = array('lib_npromo' => $lib_npromo,
						'lib_promo' => $lib_promo,
						'lib_total' => $lib_total,
						'lib_npromo_rp' => $lib_npromo_rp,
						'lib_promo_rp' => $lib_promo_rp,
						'lib_total_rp' => $lib_total_rp
						);

            $karyawanArr[$nik] = array('nik' => $nik,
                                   'nama' => $nama,
                                   'tcm' => $target_tcm,
                                   'jml_pmb' => $jml_pmb,
                                   'jml_reg' => $jml_reg,
                                   'jml_her' => $jml_her,
                                   'data' => json_encode($data_source, JSON_HEX_APOS),
                                   'tg1' => $sesi_day_ori,
                                   'tg2' => $sesi_day2_ori,
                                   'closing_rp25' => 0,
                                   'closing_rp50' => 0,
								   'reward_reg' => 0,
                                   'reward_her' => 0,
								   'reward_normal_data' => json_encode($reward_normal_data, JSON_HEX_APOS),
								   'reward_libur_data' => json_encode($reward_libur_data, JSON_HEX_APOS),
                                   'insentif' => $insentif,
								   'extra_insentif' => $extra_insentif,
								   'total_insentif' => $total_insentif,
								   'real_reg' => $real_reg,
								   'rwd_reg_pts' => $rwd_reg_pts,
								   'incase' => $incase
								   );
            
        }
    }
}

array_sort_by_column($karyawanArr, 'nama');

//echo"<pre>";
//print_r($karyawanArr);
//echo"</pre>";

//echo json_encode($karyawanArr);
//die;
?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/css/bootstrap-datepicker.min.css" rel="stylesheet"/>
    
    <link href="https://cdn.datatables.net/1.10.22/css/dataTables.bootstrap4.min.css" rel="stylesheet"/>
    <link href="https://cdn.datatables.net/buttons/1.6.2/css/buttons.dataTables.min.css" rel="stylesheet"/>
    <link href="https://cdn.datatables.net/scroller/2.0.3/css/scroller.bootstrap4.min.css" rel="stylesheet"/>
    
    <title>Rekap Simulasi New Reward</title>
    
    <style>
        table{
            font-size: 0.7em;
        }
        .sticky-offset {
            top: 65px;
        }
        .sticky-sub-offset {
            top: 125px;
        }
        .datepicker {
            padding: 6px;
            -webkit-border-radius: 4px;
            -moz-border-radius: 4px;
            border-radius: 4px;
                border-top-left-radius: 4px;
                border-bottom-left-radius: 4px;
            direction: ltr;
        }
    </style>
    
  </head>
  <body>
    
    <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
      <a class="navbar-brand" href="#">Rekap Simulasi New Reward</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarCollapse">
        <ul class="navbar-nav mr-auto">
        </ul>
        <form method="post" action="" class="form-inline mt-2 mt-md-0">
          <?php if(!empty($_SESSION['fday']) &&
                   !empty($_SESSION['fday2']) &&
                   !empty($_SESSION['fdivisi'])){ ?>
          
          <div class="input-group">
            <div class="input-group-prepend">
              <div class="input-group-text"><i class="far fa-user"></i></div>
            </div>
            <select name="filter_divisi" class="custom-select mr-sm-2">
              <?php
              foreach($list_divisi as $key => $val){
                if($key == $sesi_divisi){
                    $div_selected = "selected";
                }else{
                    $div_selected = "";
                }
              ?>
              <option value="<?php echo $key;?>" <?php echo $div_selected;?>><?php echo $val;?></option>
              <?php }?>
            </select>
          </div>
          <div class="input-group">
            <div class="input-group-prepend">
              <div class="input-group-text"><i class="far fa-calendar"></i></div>
            </div>
            <input name="filter_day" value="<?php echo $sesi_day;?>" class="form-control mr-sm-2 datepicker" type="text" disabled>
          </div>
          <div class="input-group">
            <div class="input-group-prepend">
              <div class="input-group-text"><i class="far fa-calendar"></i></div>
            </div>
            <input name="filter_day2" value="<?php echo $sesi_day2;?>" class="form-control input-lg mr-sm-2 datepicker" type="text" disabled>
          </div>
          
          <button name="bclearday" class="btn btn-outline-danger my-2 my-sm-0" type="submit">Close</button>
          <?php }else{ ?>

          <div class="input-group">
            <div class="input-group-prepend">
              <div class="input-group-text"><i class="far fa-user"></i></div>
            </div>
            <select name="filter_divisi" class="custom-select mr-sm-2">
              <?php
              foreach($list_divisi as $key => $val){
                if($key == $sesi_divisi){
                    $div_selected = "selected";
                }else{
                    $div_selected = "";
                }
              ?>
              <option value="<?php echo $key;?>" <?php echo $div_selected;?>><?php echo $val;?></option>
              <?php }?>
            </select>
          </div>
          <div class="input-group">
            <div class="input-group-prepend">
              <div class="input-group-text"><i class="far fa-calendar"></i></div>
            </div>
            <input name="filter_day" value="<?php echo $sesi_day;?>" class="form-control mr-sm-2 datepicker" type="text">
          </div>
          <div class="input-group">
            <div class="input-group-prepend">
              <div class="input-group-text"><i class="far fa-calendar"></i></div>
            </div>
            <input name="filter_day2" value="<?php echo $sesi_day2;?>" class="form-control input-lg mr-sm-2 datepicker" type="text">
          </div>
          <button name="bday" class="btn btn-xs-block btn-outline-warning my-2 my-sm-0" type="submit">Check</button>
          <?php }?>
        </form>
      </div>
    </nav>
    
    <div class="container-fluid pt-5">
        <div class="row mt-3">
            <div class="col-lg-12">
                <?php if(!empty($karyawanArr)){ ?>
                
                <div class="table-responsive">
                    <table id="dt-rekap" class="table table-sm table-hover table-bordered">
                        <thead class="thead-light text-center">
                            <tr>
                                <th>No</th>
                                <th>NIK</th>						
                                <th>Nama</th>
                                <th>Kampus</th>
                                <th>Grade</th>
                                <th>TCM</th>
                                <th>REG</th>
                                <th>HER</th>
								<th>CASE</th>
								<th>REAL</th>
								<th>REAL<br>PTS</th>
                                <th>Closing<br>Rp25</th>
                                <th>Closing<br>Rp50</th>
                                <th>Reward<br>REG</th>
                                <th>Reward<br>HER</th>
                                <th>Insentif</th>
								<th>Extra Insentif</th>
								<th>Total Insentif</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                              $no = 1;
                              foreach($karyawanArr as $key => $val){
                            ?>
                            <tr>
                                <td><?php echo $no;?></td>
                                <td><?php echo $val['nik'];?></td>
                                <td><?php echo $val['nama'];?></td>
                                <td><?php echo $val['pts'];?></td>
                                <td style="text-align: center"><?php echo $val['grade'];?></td>
                                <td style="text-align: right"><?php echo $val['tcm'];?></td>
                                <td style="text-align: right"><?php echo $val['jml_reg'];?></td>
                                <td style="text-align: right"><?php echo $val['jml_her'];?></td>
								<td style="text-align: right"><?php echo $val['incase'];?></td>
								<td style="text-align: right"><?php echo $val['real_reg'];?></td>
								<td style="text-align: right"><?php echo $val['rwd_reg_pts'];?></td>
                                <td style="text-align: right"><?php echo $val['closing_rp25'];?></td>
                                <td style="text-align: right"><?php echo $val['closing_rp50'];?></td>
                                <td style="text-align: right"><?php echo $val['reward_reg'];?></td>
                                <td style="text-align: right"><?php echo $val['reward_her'];?></td>
                                <td style="text-align: right"><?php echo $val['insentif'];?></td>
								<td style="text-align: right"><?php echo $val['extra_insentif'];?></td>
								<td style="text-align: right"><?php echo $val['total_insentif'];?></td>
                                <td style="text-align: center;">
                                    <a href="#"
                                       data-nama='<?php echo $val['nama'];?>'
                                       data-source='<?php echo $val['data'];?>'
                                       data-toggle="modal" data-target="#datamhs_newreward"><i class="fa fa-users"></i></a>
                                </td>
                            </tr>
                            <?php $no++; }?>
                        </tbody>
                    </table>
                </div>
                
                <?php }else{ echo "<h5>Silahkan jalankan filter diatas</h5>"; }?>
            </div>
        </div>
    </div>
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/js/bootstrap-datepicker.min.js"></script>
    
    <script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.22/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/scroller/2.0.3/js/dataTables.scroller.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.2/js/buttons.flash.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.2/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.2/js/buttons.print.min.js"></script>
    
    <script>
        $(document).ready(function() {
            $('#dt-rekap').DataTable({
                deferRender: true,
                scrollY: 450,
                scrollCollapse: true,
                scroller: true,
                dom: 'Bfrtip',
                buttons: [
                    'copy', 'excel',
                    {
                        extend: 'pdfHtml5',
                        orientation: 'landscape',
                        pageSize: 'LEGAL'
                    }
                ],
                columnDefs: [
                    { "width": "50px", "targets": 3 }
                ]
            });
            
            $('#datamhs_newreward').on('show.bs.modal', function(event) {
                var div = $(event.relatedTarget)
            
                var nama = div.data('nama');
                var source = div.data('source');
            
                var modal = $(this)
            
                modal.find('#data_nama').html(nama);
                modal.find('#data_source').html('');
            
                var txt = '<table class="table table-condensed" style="font-size: 0.7em">';
                txt += '<thead>';
                txt += '<tr>';
                txt += '<th>NO</th>';
                txt += '<th>NOSEL</th>';
                txt += '<th>NAMA</th>';
                txt += '<th>SUMBER</th>';
                txt += '<th>TGLDFTR</th>';
                txt += '<th>TGLHER</th>';
                txt += '<th>RWDREG</th>';
                txt += '<th>RWDHER</th>';
		
		txt += '<th>BYFRM</th>';
                txt += '<th>FRM</th>';
                txt += '<th>LOG</th>';
		
		txt += '<th>STS</th>';
		
                txt += '</tr>';
                txt += '</thead>';
                txt += '<tbody>';
            
                var no = 1;
                Object.keys(source).forEach(function(key) {
                    
                    if (source[key].status_reg == 'GET' || source[key].status_reg == 'GET-LIBUR') {
                        var regcolor = 'green';
                        var regweight = 'bold';
                    }else{
                        var regcolor = 'grey';
                        var regweight = 'normal';
                    }
                    
                    if (source[key].status_her == 'GET') {
                        var hercolor = 'green';
                        var herweight = 'bold';
                    }else{
                        var hercolor = 'grey';
                        var herweight = 'normal';
                    }
            
                    txt += '<tr>';
                    txt += '<td>' + no + '</td>';
                    txt += '<td>' + source[key].nosel + '</td>';
                    txt += '<td>' + source[key].nama + '</td>';
                    txt += '<td>' + source[key].smb_info + '</td>';
                    txt += '<td>' + source[key].tanggal + '</td>';
                    txt += '<td>' + source[key].tanggal_her + '</td>';
                    txt += '<td style="color:' + regcolor + ';font-weight: ' + regweight + '">' + source[key].status_reg + '</td>';
                    txt += '<td style="color:' + hercolor + ';font-weight: ' + herweight + '">' + source[key].status_her + '</td>';
                    
		    txt += '<td>' + source[key].biaya_formulir + '</td>';
                    txt += '<td>' + source[key].formulir + '</td>';
                    txt += '<td>' + source[key].logika + '</td>';
		    
		    txt += '<td>' + source[key].status + '</td>';
		    
		    txt += '</tr>';
            
                    no++;
            
                });
            
                txt += '</tbody>';
                txt += '</table>';
            
                modal.find('#data_source').html(txt);
            
            });
        });
        
        $('.datepicker').datepicker({
            format: 'dd/mm/yyyy',
            //minViewMode: 1,
            weekStart: 1,
            daysOfWeekHighlighted: "6,0",
            autoclose: true,
            todayHighlight: true,
        });
    </script>
  </body>
  
    <style>
    .modal-dialog,
    .modal-content {
        height: 80%;
    }
    
    .modal-body {
        max-height: calc(100% - 120px);
        overflow-y: scroll;
    }
    #loading{
          text-align: center;
          display: none;
          position: fixed;
          background-color: rgba(0, 0, 0, 0.3);
          z-index: 1000;
          left: 0;
          top: 0;
          height: 100%;
          width: 100%;
          padding-top:10%;
        }
        #output{
          font-size: 10px;
        }
    </style>
    
        
    <div id="loading"><img src="dist/img/loadingnew3.gif" /></div>
    
    <!-- Modal -->
    <div class="modal fade" id="datamhs_newreward" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel"><i class="fa fa-users"></i> <span id="data_nama"></span> | Raw Data Perolehan Reward</strong></h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body" id="data_source">
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
    </div>

</html>