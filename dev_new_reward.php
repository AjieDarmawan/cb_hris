<?php
error_reporting(E_ALL ^ E_NOTICE);
date_default_timezone_set('Asia/Jakarta');
session_start();

$page = "dev_new_reward.php";

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
        
}else{
        $sesi_divisi = 'cs';
	$sesi_day = date("d/m/Y", strtotime($date));
        $sesi_day2 = date("d/m/Y", strtotime($date));
        
        $exp_day_ori = explode('/', $sesi_day);
        $exp_day2_ori = explode('/', $sesi_day2);
        $sesi_day_ori = $exp_day_ori[2]."-".$exp_day_ori[1]."-".$exp_day_ori[0];
        $sesi_day2_ori = $exp_day2_ori[2]."-".$exp_day2_ori[1]."-".$exp_day2_ori[0];
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


$karyawanArr = array();

if(!empty($_SESSION['fday']) &&
   !empty($_SESSION['fday2']) &&
   !empty($_SESSION['fdivisi'])){
    
    if($_SESSION['fdivisi'] == "unit"){
    
        $ptg=new PotongGaji();
        
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
        #AND a.kar_nik IN ('SG.0234.2015','SG.0310.2016')
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
			    /*if($reg_tanggal >= '2020-12-21' &&
			       $smb_info != 'GSF' &&
			       $smb_info != 'eduAgent' &&
			       $smb_info != 'Teman'){*/
				if($logika >= 10 && $logika <= 100){
                                    if($nom_formulir >= $biaya_formulir){
                                        if($nom_formulir >= 100000 && $nom_formulir <= 100999){
                                            $persen_formulir = $nom_formulir * 0.25;
                                        }elseif($nom_formulir > 100999){
                                            $persen_formulir = $nom_formulir * 0.2;
                                        }else{
                                            $persen_formulir = 0;
                                        }
                                    }else{
                                        $persen_formulir = 0;
                                    }
                                }else{
                                    if($nom_formulir >= 100000 && $nom_formulir <= 100999){
                                        $persen_formulir = $nom_formulir * 0.25;
                                    }elseif($nom_formulir > 100999){
                                        $persen_formulir = $nom_formulir * 0.2;
                                    }else{
                                        $persen_formulir = 0;
                                    }
                                }
			    /*}else{
				$persen_formulir = 0;
			    }*/
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
				    'data' => $data_mhs,
				    'tg1' => $sesi_day_ori,
				    'tg2' => $sesi_day2_ori,
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
				       'data' => $data_mhs,
				       'tg1' => $sesi_day_ori,
				       'tg2' => $sesi_day2_ori,
				       'closing_rp25' => $closing_rp25,
				       'closing_rp50' => $closing_rp50,
				       'reward_reg' => $rwd_reg,
				       'reward_her' => $rwd_her,
				       'insentif' => $insentif);
	    }
        }
        
    }else{
        
        $div_id = "13"; //ID DIVISI CS
        $insentif = 0;
        $closing_rp = 0;
	$rwd_reg = 0;
        $rwd_her = 0;
        $closing_rp25 = 0;
        $closing_rp50 = 0;
        
        $kar_tampil = $kar->kar_tampil_div_in_cs_staff($div_id);
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
		$target_tcm = 50; //TARGET CAPAIAN MINIMUM
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
			    /*if($reg_tanggal >= '2020-12-21' &&
			       $smb_info != 'GSF' &&
			       $smb_info != 'eduAgent' &&
			       $smb_info != 'Teman'){*/
				if($logika >= 10 && $logika <= 100){
                                    if($nom_formulir >= $biaya_formulir){
                                        if($nom_formulir >= 100000 && $nom_formulir <= 100999){
                                            $persen_formulir = $nom_formulir * 0.25;
                                        }elseif($nom_formulir > 100999){
                                            $persen_formulir = $nom_formulir * 0.2;
                                        }else{
                                            $persen_formulir = 0;
                                        }
                                    }else{
                                        $persen_formulir = 0;
                                    }
                                }else{
                                    if($nom_formulir >= 100000 && $nom_formulir <= 100999){
                                        $persen_formulir = $nom_formulir * 0.25;
                                    }elseif($nom_formulir > 100999){
                                        $persen_formulir = $nom_formulir * 0.2;
                                    }else{
                                        $persen_formulir = 0;
                                    }
                                }
			    /*}else{
				$persen_formulir = 0;
			    }*/
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
	    /////////////////////////////SETTINGAN RWD BARU///////////////////////////////////
	    
            $rwd_her = $jml_her * 100000;
            
            $insentif = $closing_rp + $rwd_reg + $rwd_her;
            
            
            $karyawanArr[$nik] = array('nik' => $nik,
                                   'nama' => $nama,
                                   'tcm' => $target_tcm,
                                   'jml_pmb' => $jml_pmb,
                                   'jml_reg' => $jml_reg,
                                   'jml_her' => $jml_her,
                                   'data' => $data_mhs,
                                   'tg1' => $sesi_day_ori,
                                   'tg2' => $sesi_day2_ori,
                                   'closing_rp25' => $closing_rp25,
                                   'closing_rp50' => $closing_rp50,
				   'reward_reg' => $rwd_reg,
                                   'reward_her' => $rwd_her,
                                   'insentif' => $insentif);
            
        }
    }
}

array_sort_by_column($karyawanArr, 'nama');
?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://sipema.p2k.co.id/assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/css/bootstrap-datepicker.min.css" rel="stylesheet"/>
    
    <title>Simulasi New Reward</title>
    
    <style>
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
        .highlight { background-color: yellow }
        @media all and (max-width:480px) {
            .btn-xs-block { width: 100%; display:block; }
        }   
    </style>
    
  </head>
  <body>
    
    <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
      <a class="navbar-brand" href="#">Simulasi New Reward</a>
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
            <div class="col">
		<?php
                    if(!empty($karyawanArr)){
		?>
                <div class="sticky-top sticky-offset">
                    <input class="form-control" id="myInput" type="text" placeholder="Search..">
                </div>
		<?php }?>
                <div id="myDiv">
                    <?php
                    if(!empty($karyawanArr)){
                        echo "<pre>";
                        print_r($karyawanArr);
                        echo "</pre>";
                    }else{
                        echo "<h5>Silahkan jalankan filter diatas</h5>";
                    }
                    
                    ?>
                </div>
            </div>
        </div>
    </div>
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://sipema.p2k.co.id/assets/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/js/bootstrap-datepicker.min.js"></script></script>
    <script type="text/javascript" src="https://johannburkard.de/resources/Johann/jquery.highlight-5.js"></script>
    <script>
        $(document).ready(function(){
            $("#myInput").on("keyup", function() {
              var value = $(this).val().toLowerCase();
              
              if (value.length > 2) {
                
                $("#myDiv").removeHighlight().highlight(value);
                
                var $container = $("html,body");
                var $scrollTo = $('.highlight');
  
                $container.animate({scrollTop: $scrollTo.offset().top - $container.offset().top + $container.scrollTop() - 105, scrollLeft: 0},300);
              }
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
</html>