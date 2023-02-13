<?php
$page=$_GET['p'];
$act=$_GET['act'];

if(isset($_POST['bday'])){

    if(!empty($_POST['filter_day'])){
        $_SESSION['fday'] = $_POST['filter_day'];
        $filter_day = $_SESSION['fday'];
    }else{
        $_SESSION['fday'] = "";
    }

    echo"<script>document.location='?p=$page';</script>";
}

if(isset($_POST['bclearday'])){
    $_SESSION['fday'] = "";
    echo"<script>document.location='?p=$page';</script>";
}

if(!empty($_SESSION['fday'])){
        
        $exp_daterange = explode(' - ', $_SESSION['fday']);
        $exp_datestart = explode('/', $exp_daterange[0]);
        $exp_dateend = explode('/', $exp_daterange[1]);
        $day_start = $exp_datestart[2]."-".$exp_datestart[1]."-".$exp_datestart[0];
        $day_end = $exp_dateend[2]."-".$exp_dateend[1]."-".$exp_dateend[0];
                
        $r_awal = date("d/m/Y", strtotime($day_start));
        $r_sekarang = date("d/m/Y", strtotime($day_end));
        
        $r_awal_ori = date("Y-m-d", strtotime($day_start));
        $r_sekarang_ori = date("Y-m-d", strtotime($day_end));
        
        $f_daterange = $r_awal." - ".$r_sekarang;
}else{

      $r_awal = date("01/m/Y", strtotime($date));
      $r_sekarang = date("d/m/Y", strtotime($date));
      
      $r_awal_ori = date("Y-m-01", strtotime($date));
      $r_sekarang_ori = date("Y-m-d", strtotime($date));
      
      $f_daterange = $r_awal." - ".$r_sekarang;

}


$date1=date_create($r_awal_ori);
$date2=date_create($r_sekarang_ori);
$diff=date_diff($date1,$date2);
$days = $diff->format("%a");

$dataArr = array();
$bdc = 0; $pendaftaran = 0; $herregis = 0; $noreward = 0; $reward = 0; $nomial = 0;
$tb_rwd = "rwd_data";
$divisi = "8','10";
$rwd_activity_list = $rwd->rwd_activity_list($tb_rwd,$r_awal_ori,$r_sekarang_ori,$divisi);
while($rwd_activity_data = mysql_fetch_assoc($rwd_activity_list)){
      $rwd_nik = $rwd_activity_data['rwd_nik'];
      $rwd_nm = $rwd_activity_data['rwd_nm'];
      
      $keynya = $rwd_nik."#".$rwd_nm;
      
      $bdc = $rwd_activity_data['rwd_jumlah'];
      $pendaftaran = $rwd_activity_data['rwd_jumlah1'];
      $pendaftaran_mhs = $rwd_activity_data['rwd_datatext1'];
      $herregis = $rwd_activity_data['rwd_jumlah2'];
      $herregis_mhs = $rwd_activity_data['rwd_datatext2'];
      $reward = $rwd_activity_data['rwd_jumlah3'];
      $reward_mhs = $rwd_activity_data['rwd_datatext3'];
      $noreward = $herregis - $reward;
      $noherregis = $pendaftaran - $herregis;
      
      if($kar_data['kar_jdw_akses'] == "ALL"){
      
        $dataArr[$keynya][] = array('bdc'=>$bdc,
                                        'pendaftaran'=>$pendaftaran,
                                        'pendaftaran_mhs'=>$pendaftaran_mhs,
                                        'herregis'=>$herregis,
                                        'herregis_mhs'=>$herregis_mhs,
                                        'reward'=>$reward,
                                        'reward_mhs'=>$reward_mhs,
                                        'noreward'=>$noreward,
                                        'noherregis'=>$noherregis);
        
      }elseif($kar_data['kar_jdw_akses'] == "" || $kar_data['kar_jdw_akses'] == NULL){
        
        if($kar_data['kar_nik']==$rwd_nik){
          
            $dataArr[$keynya][] = array('bdc'=>$bdc,
                                        'pendaftaran'=>$pendaftaran,
                                        'pendaftaran_mhs'=>$pendaftaran_mhs,
                                        'herregis'=>$herregis,
                                        'herregis_mhs'=>$herregis_mhs,
                                        'reward'=>$reward,
                                        'reward_mhs'=>$reward_mhs,
                                        'noreward'=>$noreward,
                                        'noherregis'=>$noherregis);
          
        }
        
      }else{
        
        $kar_jdw_akses = $kar_data['kar_jdw_akses'].",".$kar_data['kar_nik'];
        $pos = strpos($kar_jdw_akses,$rwd_nik);
        if ($pos !== false) {
          
            $dataArr[$keynya][] = array('bdc'=>$bdc,
                                        'pendaftaran'=>$pendaftaran,
                                        'pendaftaran_mhs'=>$pendaftaran_mhs,
                                        'herregis'=>$herregis,
                                        'herregis_mhs'=>$herregis_mhs,
                                        'reward'=>$reward,
                                        'reward_mhs'=>$reward_mhs,
                                        'noreward'=>$noreward,
                                        'noherregis'=>$noherregis);
        }
      }
}

/*echo"<pre>";
print_r($dataArr);
echo"</pre>";*/

//////////////////////////////////////////////////////////////////////////////////////////////////////////////

$dataArr2 = array();
$tb_rwd_last = "rwd_last";
$rwd_bulan = date('mY');
$rwd_last_list = $rwd->rwd_last_list($tb_rwd_last,$rwd_bulan);
while($rwd_last_data = mysql_fetch_assoc($rwd_last_list)){
    $rwd_nik_last = $rwd_last_data['rwd_nik'];
    $rwd_nm_last = $rwd_last_data['rwd_nm'];
    
    $keynya_last = $rwd_nik_last."#".$rwd_nm_last;
    
    $noherregis_last = $rwd_last_data['rwd_jumlah1'];
    $noherregis_mhs_last = $rwd_last_data['rwd_datatext1'];
    $herregis_last = $rwd_last_data['rwd_jumlah2'];
    $herregis_mhs_last = $rwd_last_data['rwd_datatext2'];
    $reward_last = $rwd_last_data['rwd_jumlah3'];
    $reward_mhs_last = $rwd_last_data['rwd_datatext3'];
    
    $dataArr2[$keynya_last] = array('noherregis_last' => $noherregis_last,
                                    'noherregis_mhs_last' => $noherregis_mhs_last,
                                    'herregis_last' => $herregis_last,
                                    'herregis_mhs_last' => $herregis_mhs_last,
                                    'reward_last' => $reward_last,
                                    'reward_mhs_last' => $reward_mhs_last
                                ); 
}

//////////////////////////////////////////////////////////////////////////////////////////////////////////////

$dataArr1 = array();
foreach($dataArr as $key1=>$val1){
  
  $pendaftaran_comma = "";
  $pendaftaran_mhs = "";
  
  $herregis_comma = "";
  $herregis_mhs = "";
  
  $reward_comma = "";
  $reward_mhs = "";
  
  $noreward_comma = "";
  $noreward_mhs = "";
  
  $noherregis_comma = "";
  $noherregis_mhs = "";
  
  foreach($val1 as $key2=>$val2){
    $dataArr1[$key1]['bdc']+=$val2['bdc'];
    $dataArr1[$key1]['pendaftaran']+=$val2['pendaftaran'];
    $dataArr1[$key1]['herregis']+=$val2['herregis'];
    $dataArr1[$key1]['reward']+=$val2['reward'];
    $dataArr1[$key1]['noreward']+=$val2['noreward'];
    $dataArr1[$key1]['noherregis']+=$val2['noherregis'];
    
    if(!empty($val2['pendaftaran_mhs'])){ 
      if($pendaftaran_comma){
          $pendaftaran_mhs .= ",";
      }
      
      $pendaftaran_mhs .= $val2['pendaftaran_mhs'];
      $pendaftaran_comma = true;
    }
    
    if(!empty($val2['herregis_mhs'])){ 
      if($herregis_comma){
          $herregis_mhs .= ",";
      }
      
      $herregis_mhs .= $val2['herregis_mhs'];
      $herregis_comma = true;
    }
    
    if(!empty($val2['reward_mhs'])){ 
      if($reward_comma){
          $reward_mhs .= ",";
      }
      
      $reward_mhs .= $val2['reward_mhs'];
      $reward_comma = true;
    }
    
  }
  
  if($dataArr2[$key1]['reward_mhs']!==''){
    $reward_mhs .= ",".$dataArr2[$key1]['reward_mhs_last'];
  }
  
  $keyExp = explode('#',$key1);
  $keyori = str_replace(".","",$keyExp[0]).",";
  $keyori2 = str_replace(".","",$keyExp[0]);
  
  $hrExp = explode($keyori,$herregis_mhs);
  $rwExp = explode($keyori,$reward_mhs);
  $pdExp = explode($keyori,$pendaftaran_mhs);
  
  $hrArr = array();
  foreach($hrExp as $key4 => $val4){
    $hrArr[] = str_replace($keyori2,"",$val4);
  }
  
  $rwArr = array();
  foreach($rwExp as $key5 => $val5){
    $rwArr[] = str_replace($keyori2,"",$val5);
  }
  
  $pdArr = array();
  foreach($pdExp as $key6 => $val6){
    $pdArr[] = str_replace($keyori2,"",$val6);
  }

  $result=array_diff($hrArr,$rwArr);
  $result=array_values($result);
  
  $result2=array_diff($pdArr,$hrArr);
  $result2=array_values($result2);
  
  /*echo"<pre>";
  print_r($result);
  echo"</pre>";*/
  
  foreach($result as $key3=>$val3){
    if($noreward_comma){
        $noreward_mhs .= ",";
    }
    
    $noreward_mhs .= $val3.$keyori2;
    $noreward_comma = true;
  }
  
  foreach($result2 as $key7=>$val7){
    if($noherregis_comma){
        $noherregis_mhs .= ",";
    }
    
    $noherregis_mhs .= $val7.$keyori2;
    $noherregis_comma = true;
  }
  
  
  if($pendaftaran_mhs !== ""){
    $dataArr1[$key1]['pendaftaran_mhs'] = $pendaftaran_mhs;
  }else{
    $dataArr1[$key1]['pendaftaran_mhs'] = "";
  }
  
  if($herregis_mhs !== ""){
    $dataArr1[$key1]['herregis_mhs'] = $herregis_mhs;
  }else{
    $dataArr1[$key1]['herregis_mhs'] = "";
  }
  
  if($reward_mhs !== ""){
    $dataArr1[$key1]['reward_mhs'] = $reward_mhs;
  }else{
    $dataArr1[$key1]['reward_mhs'] = "";
  }
  
  if($noreward_mhs !== ""){
    $dataArr1[$key1]['noreward_mhs'] = $noreward_mhs;
  }else{
    $dataArr1[$key1]['noreward_mhs'] = "";
  }
  
  if($noherregis_mhs !== ""){
    $dataArr1[$key1]['noherregis_mhs'] = $noherregis_mhs;
  }else{
    $dataArr1[$key1]['noherregis_mhs'] = "";
  }
  
}

/*echo"<pre>";
print_r($dataArr1);
echo"</pre>";*/

?>