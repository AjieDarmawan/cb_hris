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
//$tgl_awal = date('Y-m-14'); //SEMENTARA
//$tgl_akhir = date('Y-m-24'); //SEMENTARA
$tgl_akhir = date('Y-m-25');


function array_sort_by_column(&$arr, $col, $dir = SORT_ASC) {
    $sort_col = array();
    foreach ($arr as $key=> $row) {
        $sort_col[$key] = $row[$col];
    }

    array_multisort($sort_col, $dir, $arr);
}

//ABM KHUSUS 14-25 SEP 20
$target_abm = array('CS' => 18,
	     'A' => 12,
	     'B' => 9,
	     'C' => 5);

$karyawanArr = array();
$insentif = 0;
$closing_rp = 0;
$rwd_reg = 0;
$rwd_her = 0;
$closing_rp_10 = 0;
$closing_rp_11 = 0;
$closing_rp25 = 0;
$closing_rp50 = 0;

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
    if($jml_reg > 0){
	$data_parse = json_decode($data_mhs, true);
	if(!empty($data_parse)){
	    $rwd_reg = 0;
	    $persen_formulir = 0;
	    foreach($data_parse as $key => $val){
		$status_her = $val['status_her'];
		if($status_her == 'NOT'){
		    $biaya_formulir = $val['biaya_formulir'];
		    $nom_formulir = $val['formulir'];
		    $smb_info = $val['smb_info'];
		    $reg_tanggal = $val['tanggal'];
		    $logika = $val['logika'];
		    $kodept = strtoupper($val['kodept']);
		    if($reg_tanggal >= '2020-12-21' &&
		       $smb_info != 'GSF' &&
		       $smb_info != 'eduAgent' &&
		       $smb_info != 'Teman'){
			if($logika >= 10 && $logika <= 100){
			    if($nom_formulir >= $biaya_formulir){
				if($nom_formulir >= 100000 && $nom_formulir <= 100999){
				    $persen_formulir = $nom_formulir * 0.25;
				    $data_reg[$key]='GET';
				}elseif($nom_formulir > 100999){
				    if($kodept == 'KOM'){
					if($nom_formulir > 300000){
					    $persen_formulir = 300000 * 0.2;
					}else{
					    $persen_formulir = $nom_formulir * 0.2;
					}
				    }else{
					$persen_formulir = $nom_formulir * 0.2;
				    }
				    $data_reg[$key]='GET';
				}else{
				    $persen_formulir = 0;
				}
			    }else{
				$persen_formulir = 0;
			    }
			}else{
			    if($nom_formulir >= 100000 && $nom_formulir <= 100999){
				$persen_formulir = $nom_formulir * 0.25;
				$data_reg[$key]='GET';
			    }elseif($nom_formulir > 100999){
				if($kodept == 'KOM'){
				    if($nom_formulir > 300000){
					$persen_formulir = 300000 * 0.2;
				    }else{
					$persen_formulir = $nom_formulir * 0.2;
				    }
				}else{
				    $persen_formulir = $nom_formulir * 0.2;
				}
				$data_reg[$key]='GET';
			    }else{
				$persen_formulir = 0;
			    }
			}
		    }else{
			$persen_formulir = 0;
		    }
		}else{
		    $persen_formulir = 0;
		}
		$rwd_reg = $rwd_reg + $persen_formulir;
	    }
	}else{
	    $rwd_reg = 0;
	}
    }else{
	$rwd_reg = 0;
    }
    
    $data_source = array();
    $data_parse = json_decode($data_mhs, true);
    if(!empty($data_parse)){
	foreach($data_parse as $key => $val){
	    $status_reg = $data_reg[$key] ? $data_reg[$key] : 'NOT';
	    $data_source[$key] = array('biobid' => $val['biobid'],
		      'nosel' => $val['nosel'],
		      'nama' => $val['nama'],
		      'smb_info' => $val['smb_info'],
		      'tanggal' => $val['tanggal'],
		      'tanggal_her' => $val['tanggal_her'],
		      'status_reg' => $status_reg,
		      'status_her' => $val['status_her'],
		      'biaya_formulir' => $val['biaya_formulir'],
		      'formulir' => $val['formulir'],
		      'logika' => $val['logika']);
	}
    }
    /////////////////////////////SETTINGAN RWD BARU///////////////////////////////////
    
    $rwd_her = $jml_her * 100000;
    
    $insentif = $closing_rp + $rwd_reg + $rwd_her;
    
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
                            'closing_rp25' => $closing_rp25,
                            'closing_rp50' => $closing_rp50,
			    'reward_reg' => $rwd_reg,
                            'reward_her' => $rwd_her,
                            'insentif' => $insentif);
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
                                'closing_rp25' => $closing_rp25,
                                'closing_rp50' => $closing_rp50,
				'reward_reg' => $rwd_reg,
                                'reward_her' => $rwd_her,
                                'insentif' => $insentif);
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
    $nrw_closing_rp25 = $data['closing_rp25'];
    $nrw_closing_rp50 = $data['closing_rp50'];
    $nrw_reward_reg = $data['reward_reg'];
    $nrw_reward_her = $data['reward_her'];
    $nrw_insentif = $data['insentif'];
    $nrw_cek = $nrw->nrw_cek($nrw_priode,$nrw_nik);
    $nrw_cek_jml = mysql_num_rows($nrw_cek);
    if($nrw_cek_jml == 0){
        $nrw_insert = $nrw->nrw_insert($nrw_priode,$nrw_cutoff,$nrw_nik,$nrw_nama,$nrw_kpt,$nrw_pts,$nrw_grade,$nrw_tcm,$nrw_jml_pmb,$nrw_jml_reg,$nrw_jml_her,$nrw_data,$nrw_closing_rp25,$nrw_closing_rp50,$nrw_reward_reg,$nrw_reward_her,$nrw_insentif);
    }
}
?>