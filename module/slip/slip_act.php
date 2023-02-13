<?php

$page=$_GET['p'];
$zona=$_GET['zona'];

$act=$_GET['act'];

if(isset($_POST['bupdate'])){
    $jdw_id = $_POST['jdw_id'];
    $jdw_data = $_POST['jdw_data'];
    $jdw_count = count($jdw_data);
    //print_r($jdw_data);

    $hasTag = false;
    $dataText = '';

    for($i=1; $i<=$jdw_count; $i++){

      if ($hasTag){ 
        $dataText .= "#";

      }

      $dataText .= $jdw_data[$i];

      $hasTag = true;

    }


    if($dataText !==''){
      //echo $jdw_id;
      //echo "<br>";
      //echo $dataText;

      $jdw_data = $dataText;
      $jdw_update = $jdw->jdw_update($jdw_id,$jdw_data);

      if($jdw_update){
        if(!empty($zona)){
          echo"<script>document.location='?p=$page&zona=$zona';</script>";
        }else{
          echo"<script>document.location='?p=$page';</script>";
        }

      }

    }
    

}



if(isset($_POST['bimport'])){

    if(isset($_FILES['jdw_file']) && is_uploaded_file($_FILES['jdw_file']['tmp_name'])){

	

	$upload_dir = "file_jadwal/";

        $array = explode('.', $_FILES['jdw_file']['name']);

        $extension = end($array);

        $file_name = "JADWAL_".str_replace('/','',$_POST['jdw_bulan']).".".$extension;

	$file_path = $upload_dir . $file_name;

	if (!move_uploaded_file($_FILES['jdw_file']['tmp_name'], $file_path)) {

		echo "Error moving file upload";

	}else{

            

            $jdw_bulan = str_replace('/','',$_POST['jdw_bulan']);

            $jdw_delete = $jdw->jdw_delete($jdw_bulan);

        

            require('excel-reader/excel_reader2.php');

            require('excel-reader/SpreadsheetReader_XLSX.php');

            $data_reader = new SpreadsheetReader_XLSX('file_jadwal/'.$file_name);

            

            $dataArr = array();

            $Sheets = $data_reader -> Sheets();

            foreach ($Sheets as $Index => $Name)

            {

                    //echo $Name."<br>";

                    $data_reader -> ChangeSheet($Index);

                    $hasComma = false;

                    foreach ($data_reader as $row){

                        if ($hasComma){ 

                            //echo "<br>"; 

                        }

                        $hasTag = false;

                        $dataText = '';

                        $x=1;

                        foreach ($row as $col){

                          

                          if($col){

                            

                              if ($hasTag){ 

                                  //echo "#";

                                  if($x==4){

                                    $dataText .= "---";

                                  }else{

                                    $dataText .= "#";

                                  }

                              }

                              //echo $col;

                              $dataText .= $col;

                              $hasTag = true;

                          }

                          $x++;

                        }

                        

                        $dataArr[$Name][] = $dataText;

                        

                        $hasComma=true;

                    }

                    

                    //echo "<br>";

            }

            

            $dataArr2 = array();

            $dataText2 = '';

            $hasStart = false;

            foreach($dataArr as $key => $val){

              

                if($hasStart){

                  $dataText2 .= '***';

                }

              

                $dataText2 .= $key.'@@';

                if($key == "JABODETABEK"){

                  $dataArr2[$key][] = "Wil#Jabodetabek||";

                  $dataText2 .= "Wil#Jabodetabek||";

                }

                

                $hasxxx = false;

                foreach($val as $key1 => $val1){

                  $nik = strpos($val1, 'SG.');

                  $wil = strpos($val1, 'Wil#');

                  

                  if ($nik !== false || $wil !== false) {

                    if($wil !== false){

                      

                      if($hasxxx){

                        $dataText2 .= 'xxx';

                      }

                      

                      $dataArr2[$key][] = $val1."||";

                      $dataText2 .= $val1."||";

                      $hasxxx = true;

                    }else{

                      $dataArr2[$key][] = $val1;

                      $dataText2 .= $val1.",";

                    }

                    

                  }

                }

                

                $hasStart = true;

                

            }

            

            //echo"<pre>";

            //print_r($dataText2);

            //echo"</pre>";

            

            $zona = explode('***',$dataText2);

            $dataArr3 = array();

            foreach($zona as $key => $val){

              $exp1 = explode('@@',$val);

              

              $exp2 = explode('xxx',$exp1[1]);

              for($i=0; $i<count($exp2);$i++){

                $exp3 = explode('||',$exp2[$i]);

                $exp4 = explode(',',$exp3[1]);

                for($z=0; $z<count($exp4)-1;$z++){

                  $dataArr3[$exp1[0]][$exp3[0]][$z] = $exp4[$z];

                }

              }

            }

            

            //echo"<pre>";

            //print_r($dataArr3);

            //echo"</pre>";
	    
	    //exit();

            

            foreach($dataArr3 as $key => $val){

                foreach($val as $key1 => $val1){

                    foreach($val1 as $key2 => $val2){

                        

                        $exp1 = explode('---',$val2);

                        $exp2 = explode('#',$exp1[0]);

              

                        $jdw_blnthn = $jdw_bulan;

                        $jdw_username = str_replace('.','',$exp2[1]);

                        $jdw_nik = $exp2[1];

                        $jdw_nama = $exp2[2];

                        $jdw_zona = $key;

                        $jdw_wilayah = $key1;

                        $jdw_data = $exp1[1];

                        

                        $jdw_insert = $jdw->jdw_insert($jdw_blnthn,$jdw_username,$jdw_nik,$jdw_nama,$jdw_zona,$jdw_wilayah,$jdw_data);

                        if($jdw_insert){

                          //echo $key." - ".$key1." - ".$val2."<hr>";

                        }

                    }

                }

            }

        }
	
	$jdw_setting = $_POST['jdw_setting'];
	if($jdw_setting == 'Y'){
	    $jdw_aktif_update=$jdw->jdw_aktif_update($jdw_bulan);
	}

        echo"<script>document.location='?p=$page';</script>";

	

    }

    

}



function hari_ini($carihari){

        $hari = date("D",strtotime($carihari));

        switch($hari){

                case 'Sun':

                        $hari_ini = "MGG";

                break;

                case 'Mon':			

                        $hari_ini = "SN";

                break;

                case 'Tue':

                        $hari_ini = "SL";

                break;

                case 'Wed':

                        $hari_ini = "RB";

                break;

                case 'Thu':

                        $hari_ini = "KM";

                break;

                case 'Fri':

                        $hari_ini = "JM";

                break;

                case 'Sat':

                        $hari_ini = "SB";

                break;

                default:

                        $hari_ini = "NN";		

                break;

        }

 

        return $hari_ini;

}



function strpos_arr($haystack, $needle) {

    if(!is_array($needle)) $needle = array($needle);

    foreach($needle as $what) {

        if(($pos = strpos($haystack, $what))!==false) return $pos;

    }

    return false;

}





$zonaArr = array('1'=>"JABODETABEK",

                 '2'=>"LUAR KOTA");



if(!empty($_GET['zona'])){

    if($_GET['zona'] == "1"){

        $zona = $zonaArr[1];

    }else{

        $zona = $zonaArr[2];

    }

    

}else{

    $zona = $zonaArr[1];

}


$jdw_aktif_blnthn = $jdw->jdw_aktif_blnthn();
$jdw_aktif_data = mysql_fetch_assoc($jdw_aktif_blnthn);

$jdw_blnthn = $jdw_aktif_data['jda_blnthn'];

$bulannya = substr($jdw_blnthn, 0,2);
$tahunnya = substr($jdw_blnthn, -4);
$thnbln = $tahunnya."-".$bulannya;

$kar_jdw_akses = str_replace(',','|',$kar_data['kar_jdw_akses']);

$jdw_nik = $kar_data['kar_nik'];

$jdw_zona = $zona;

$datemax=$thnbln."-01";
$maxDays = date("t", strtotime($datemax));



$dataArr = array();

$dataArr2 = array();

$dataArr3 = array();



$pos = strpos($kar_jdw_akses,"|");



if($kar_jdw_akses == "ALL"){

    $jdw_tampil = $jdw->jdw_tampil($jdw_blnthn,$jdw_zona);

}elseif($kar_jdw_akses == "" || $kar_jdw_akses == NULL){

    $jdw_tampil = $jdw->jdw_tampil_nik($jdw_blnthn,$jdw_zona,$jdw_nik);

}else{

    $jdw_tampil = $jdw->jdw_tampil_REGEXP($jdw_blnthn,$jdw_zona,$jdw_nik,$kar_jdw_akses);

}

while($jdw_data = mysql_fetch_assoc($jdw_tampil)){

    $exp_wilayah = explode('#',$jdw_data['jdw_wilayah']);

    $dataArr[]=array('jdw_nik'=>$jdw_data['jdw_nik'],

                     'jdw_nama'=>$jdw_data['jdw_nama'],

                     'jdw_wilayah'=>$exp_wilayah[1],

		     'jdw_id'=>$jdw_data['jdw_id']);

    

    $exp_data = explode('#',$jdw_data['jdw_data']);

    for($d=0;$d<=$maxDays-1;$d++){

        $day = $d + 1;

        $dataArr2[$jdw_data['jdw_nik']][$day] = $exp_data[$d];

        

        $pos_GL = strpos($exp_data[$d],'GL-');

	$pos_C = strpos($exp_data[$d],'C-');

	$pos_HC = strpos($exp_data[$d],'HC-');

        

        if($exp_data[$d] == 'L' ||

          $exp_data[$d] == 'LM' ||

          $exp_data[$d] == 'LN' ||

          $pos_GL !== false ||

	  $pos_C !== false ||

	  $pos_HC !== false){

         

          $dataArr3[$jdw_data['jdw_nik']][$day] = 1;

          

        }

    }

}



$sumLibur = array();

foreach ($dataArr3 as $k=>$subArray) {

  foreach ($subArray as $id=>$value) {

    $sumLibur[$k]+=$value;

  }

}

?>