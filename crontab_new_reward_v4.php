<?php
//setiap tgl 26 jam 00:15 wib

error_reporting(E_ALL ^ E_NOTICE);
date_default_timezone_set('Asia/Jakarta');
session_start(); 

require('class.php');
require('object.php');

$db->koneksi();
$nrw=new NewReward();

$tgl_awal = date('Y-m-d', strtotime('-1 month', strtotime(date('Y-m-26'))));
$tgl_akhir = date('Y-m-25');
/*
$tgl_awal = date('Y-m-09'); //SEMENTARA
$tgl_akhir = date('Y-m-25'); //SEMENTARA
*/

$data_bulan = array();

$exp_tgl_awal = explode('-', $tgl_awal);
$exp_tgl_akhir = explode('-', $tgl_akhir);
$data_bulan[] = $exp_tgl_awal[1] . $exp_tgl_awal[0];
$data_bulan[] = $exp_tgl_akhir[1] . $exp_tgl_akhir[0];


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

//ABM KHUSUS 14-25 SEP 20
$target_abm = array('CS' => 18,
	     'A' => 12,
	     'B' => 9,
	     'C' => 5);

$karyawanArr = array();

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
/*
$jdw_blnthn = implode("','",$data_bulan);
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
}
*/
$sql = "SELECT a.kar_nik,a.kar_nm,a.kar_logika,
GROUP_CONCAT(b.grd_kpt ORDER BY a.kar_nik) kpt,
GROUP_CONCAT(b.grd_pts ORDER BY a.kar_nik) pts,
GROUP_CONCAT(b.grd_grade ORDER BY a.kar_nik) grade,
GROUP_CONCAT(b.grd_target ORDER BY a.kar_nik) target
FROM `kar_master` a, `grade_pencapaian` b
WHERE b.grd_karyawan LIKE CONCAT('%', REPLACE(a.kar_nik,'.',''), '%')
#AND a.kar_nik IN ('SG.0441.2017')
AND a.div_id = '8' GROUP BY a.kar_nik;";

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
            'start' => urlencode($tgl_awal),
            'end' => urlencode($tgl_akhir),
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
    
    if($tgl_awal == '2020-09-14' && $tgl_akhir == '2020-09-25'){
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
		
		$status_her = $val['status_her'];
		
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
			   
			 if($status_her == 'NOT'){  
			   
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
				
			 }else{
				 $persen_formulir = 0;
				 $data_reg[$key]='NOT';				 
			 }
			 
			//disini
				
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
				  //'status_her' => 'NOT', //reward heregis ditutup
				  'status_her' => $val['status_her'], //reward heregis dibukalagi
				  'biaya_formulir' => $val['biaya_formulir'],
				  'formulir' => $val['formulir'],
				  'logika' => $val['logika'],
				  'kodept' => $val['kodept']);
			}
		}
    }
	$rwd_reg_pts = 0;
	$rwd_her = 0;
	if(!empty($data_source)){
		foreach($data_source as $key => $val){
			if(($val['kodept'] == strtoupper($kpt)) && ($val['status_reg'] !='NOT-PROMO' || $val['status_reg'] !='GSF-PROMO')){
				$rwd_reg_pts = $rwd_reg_pts + 1;
			}
			if($val['tanggal'] == $val['tanggal_her']){
				$rwd_her = $jml_her * 50000;
			}
		}
	}
    /////////////////////////////SETTINGAN RWD BARU///////////////////////////////////
    
    $real_reg = $jml_pmb - $incase;
	
	/* Kondisi Unit Reward ALL PTS */
	if($real_reg >= $target_tcm){
		$extra_insentif = 500000;
	}else{
		$extra_insentif = 0;
	}
	/* Kondisi Unit Reward ALL PTS */
	
	/* Kondisi Unit Reward Per PTS */
	/*
	if($rwd_reg_pts >= $target_tcm){
		$extra_insentif = 500000;
	}else{
		$extra_insentif = 0;
	}
	*/
	/* Kondisi Unit Reward Per PTS */
	
	$insentif = $rwd_reg;	
	/*$extra_insentif = ($rwd_reg_extra) ? 500000 : 0;*/
	$total_insentif = $insentif + $extra_insentif + $rwd_her;
    
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
				    'tg1' => $tgl_awal,
				    'tg2' => $tgl_akhir,
				    'closing_rp25' => 0,
				    'closing_rp50' => 0,
				    'reward_reg' => 0,
				    'reward_her' => $rwd_her,
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
				       'tg1' => $tgl_awal,
				       'tg2' => $tgl_akhir,
				       'closing_rp25' => 0,
				       'closing_rp50' => 0,
				       'reward_reg' => 0,
				       'reward_her' => $rwd_her,
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

array_sort_by_column($karyawanArr, 'nama');

/*echo "<pre>";
print_r($karyawanArr);
echo "</pre>";
exit();*/


foreach($karyawanArr as $data){
    $nrw_priode = date('mY', strtotime($data['tg2']));
    $nrw_cutoff = $data['tg1'] .' - '. $data['tg2'];
    $nrw_nik = $data['nik'];
    $nrw_nama = $data['nama'];
    $nrw_kpt = $data['kpt'];
    $nrw_pts = $data['pts'];
    $nrw_grade = $data['grade'];
    $nrw_tcm = $data['tcm'];
    $nrw_jml_pmb = $data['jml_pmb'];
    $nrw_jml_reg = $data['jml_reg'];
    $nrw_jml_her = $data['jml_her'];
    $nrw_data = $data['data'];
    $nrw_normal_data = $data['reward_normal_data'];
    $nrw_libur_data = $data['reward_libur_data'];
    $nrw_incase_data = $data['incase'];
    $nrw_closing_rp25 = $data['closing_rp25'];
    $nrw_closing_rp50 = $data['closing_rp50'];
    $nrw_reward_reg = $data['reward_reg'];
    $nrw_reward_her = $data['reward_her'];
    $nrw_insentif = $data['insentif'];
    $nrw_extra_insentif = $data['extra_insentif'];
    $nrw_total_insentif = $data['total_insentif'];
    $nrw_reg_real = $data['real_reg'];
    $nrw_jml_reg_pts = $data['rwd_reg_pts'];
    $nrw_cek = $nrw->nrw_cek($nrw_priode,$nrw_nik);
    $nrw_cek_jml = mysql_num_rows($nrw_cek);
    if($nrw_cek_jml == 0){
        $nrw_insert = $nrw->nrw_insert($nrw_priode,$nrw_cutoff,$nrw_nik,$nrw_nama,$nrw_kpt,$nrw_pts,$nrw_grade,$nrw_tcm,$nrw_jml_pmb,$nrw_jml_reg,$nrw_jml_her,$nrw_data,$nrw_normal_data,$nrw_libur_data,$nrw_incase_data,$nrw_closing_rp25,$nrw_closing_rp50,$nrw_reward_reg,$nrw_reward_her,$nrw_insentif,$nrw_extra_insentif,$nrw_total_insentif,$nrw_reg_real,$nrw_jml_reg_pts);
    }
}

?>