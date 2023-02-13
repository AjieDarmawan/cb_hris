<?php
    require('excel-reader/excel_reader2.php');
    require('excel-reader/SpreadsheetReader_XLSX.php');
    $data_reader = new SpreadsheetReader_XLSX('file_jadwal/Jadwal-Bulan-Mei-2018.xlsx');
    
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
    
    foreach($dataArr3 as $key => $val){
        foreach($val as $key1 => $val1){
            foreach($val1 as $key2 => $val2){
                
                $exp1 = explode('---',$val2);
                $exp2 = explode('#',$exp1[0]);
      
                $jdw_blnthn = date('mY');
                $jdw_username = str_replace('.','',$exp2[1]);
                $jdw_nik = $exp2[1];
                $jdw_nama = $exp2[2];
                $jdw_zona = $key;
                $jdw_wilayah = $key1;
                $jdw_data = $exp1[1];
                
                $jdw_insert = $jdw->jdw_insert($jdw_blnthn,$jdw_username,$jdw_nik,$jdw_nama,$jdw_zona,$jdw_wilayah,$jdw_data);
                if($jdw_insert){
                  echo $key." - ".$key1." - ".$val2."<hr>";
                }
            }
        }
    }
    
?>