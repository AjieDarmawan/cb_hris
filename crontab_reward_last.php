<?php
error_reporting(E_ALL ^ E_NOTICE);
date_default_timezone_set('Asia/Jakarta');
session_start(); 

require('class.php');
require('object.php');

$db->koneksi();

$r_awal_ori = date('Y-m-01');
echo $r_awal_ori;

$dataArr = array();
$bdc = 0; $pendaftaran = 0; $herregis = 0; $noreward = 0; $reward = 0; $nomial = 0;
$tb_rwd = "rwd_data";
$divisi = "8','10";
$rwd_activity_list = $rwd->rwd_activity_last($tb_rwd,$r_awal_ori,$divisi);
while($rwd_activity_data = mysql_fetch_assoc($rwd_activity_list)){
      $rwd_nik = $rwd_activity_data['rwd_nik'];
      $rwd_nm = $rwd_activity_data['rwd_nm'];
      $rwd_div = $rwd_activity_data['rwd_div'];
      
      $keynya = $rwd_nik."#".$rwd_nm."#".$rwd_div;
      
      $bdc = $rwd_activity_data['rwd_jumlah'];
      $pendaftaran = $rwd_activity_data['rwd_jumlah1'];
      $pendaftaran_mhs = $rwd_activity_data['rwd_datatext1'];
      $herregis = $rwd_activity_data['rwd_jumlah2'];
      $herregis_mhs = $rwd_activity_data['rwd_datatext2'];
      $reward = $rwd_activity_data['rwd_jumlah3'];
      $reward_mhs = $rwd_activity_data['rwd_datatext3'];
      $noreward = $herregis - $reward;
      $noherregis = $pendaftaran - $herregis;
      
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

/*echo"<pre>";
print_r($dataArr);
echo"</pre>";*/

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

echo"<pre>";
print_r($hrArr);
echo"</pre>";
exit();


//////////////////////////////////////////////////////////////////////////////////////////////

$tb_rwd_last = "rwd_last";
$rwd_bulan = date('mY');

foreach($dataArr1 as $key8=>$val8){
      $exp_key8 = explode('#',$key8);

      $nik = $exp_key8[0];
      $nama = $exp_key8[1];
      $divisi = $exp_key8[2];
      
      
      
      /*$bdc = $val8['bdc'];
      $pendaftaran = $val8['pendaftaran'];
      $pendaftaran_mhs = $val8['pendaftaran_mhs'];
      $herregis = $val8['herregis'];
      $herregis_mhs = $val8['herregis_mhs'];
      $reward = $val8['reward'];
      $reward_mhs = $val8['reward_mhs'];*/
      
      $bdc = NULL;
      $pendaftaran = $val8['noherregis'];
      $pendaftaran_mhs = $val8['noherregis_mhs'];
      $herregis = NULL;
      $herregis_mhs = NULL;
      $reward = NULL;
      $reward_mhs = NULL;
      
      
      $rwd_last_cek = $rwd->rwd_last_cek($tb_rwd_last,$nik,$rwd_bulan);
      $rwd_last_jml = mysql_num_rows($rwd_last_cek);
      if($rwd_last_jml == 0){
          $filed = "rwd_id,rwd_nik,rwd_nm,rwd_div,rwd_jumlah,rwd_jumlah1,rwd_datatext1,rwd_jumlah2,rwd_datatext2,rwd_jumlah3,rwd_datatext3,rwd_bulan";
          $rwd_last_insert = $rwd->rwd_last_insert($tb_rwd_last,$filed,$nik,$nama,$divisi,$bdc,$pendaftaran,$pendaftaran_mhs,$herregis,$herregis_mhs,$reward,$reward_mhs,$rwd_bulan);
      }else{
          $rwd_last_update = $rwd->rwd_last_update($tb_rwd_last,$nik,$bdc,$pendaftaran,$pendaftaran_mhs,$herregis,$herregis_mhs,$reward,$reward_mhs,$rwd_bulan);
      }
      
}
?>