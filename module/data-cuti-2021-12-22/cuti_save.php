<?php
date_default_timezone_set("Asia/Bangkok");
$page=$_GET['p'];
$act =$_GET['act'];
$id  =$_GET['id'];

echo 'page : '.$page.' act: '.$act.' id : '.$id; 
return;
//exit();

$date_indo = date("d/m/Y", strtotime($date));

foreach($_REQUEST as $name=>$value)
{
	$$name=$value;
 	//echo "Name: $name : $value;<br />\n";
}


if(isset($page)&&($act=="hapus")){
//   echo 'Hapus-data';
/*
   $tab_atk = " cuti_master ";
   $qcari	= " DELETE FROM $tab_atk ";
   $qcari  .= " WHERE kar_id='$id' ";
   $res     = mysql_query($qcari);
*/
/*   
   //echo '<script>alert("Data Sudah Di Hapus")</script>';
*/   
  
}




if(isset($page)&&($act=="UpdateCuti")){
     $id        = $_REQUEST['id'];
     $jml_cuti  = $_REQUEST['jml_cuti'];
	 $rec       = count($_REQUEST["tgl_cuti"]);
	 $adtcuti   = "";
	 $adtket    = "";
	 $adtvalid  = "";
	 $jmlcuti   = 0 ;
	 if ($rec > 0){
	    $jmlcuti   = 0 ;
	 }
	 for($i=0;$i < $rec; $i++){
	    $adtcuti .=$_REQUEST["tgl_cuti"][$i];
	    $adtcuti .="#";
		if ($_REQUEST["tgl_cuti"][$i] <> ""){
		    $adtket .=$_REQUEST["dataket"][$i];
		    $adtvalid .=$_REQUEST["datavalid"][$i];
		}	
	    $adtket   .="#";
	    $adtvalid .="#";
		if ($_REQUEST["tgl_cuti"][$i] !=""){
			$jmlcuti++;
		}	
	 }
	 
     //	 echo 'Upddate : '.$id.' -> '.$adtcuti; exit();

        $q_nik = " SELECT kar_id FROM cuti_master 
		            WHERE kar_id = '$id' ";
		$q_nik = mysql_query($q_nik);
		$r_nik = mysql_fetch_array($q_nik);
		$cek_nik = $r_nik['kar_id'];
		
	
		
		if (empty($cek_nik)){
           $q_add=" INSERT INTO cuti_master (kar_id) VALUES ('$id') ";		
           $result_add= mysql_query($q_add);
		}   
	  
        $q_upd    = "UPDATE cuti_master
	                 SET
					 jml_cuti = '$jml_cuti',
		  		     datacuti = '$adtcuti',
		  		     dataket  = '$adtket',
		  		     datavalid  = '$adtvalid',
				     sisa_cuti= jml_cuti - '$jmlcuti'
				     WHERE kar_id='$id'   
			    ";

        $result_upd = mysql_query($q_upd);
/*
	   $host  = $_SERVER['HTTP_HOST'];
	   $uri   = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
	   $file   = 'mypage.php';
       echo 'http://'.$host.$uri.'/'.$extra;		
*/	   
    echo "<script>document.location='?p=$page&id='".$id."</script>";	
}




if(isset($_POST['bimport'])){

	$jdw_setting = $_POST['jdw_setting'];
	$jdw_bulan   = $_POST['jdw_bulan'];   
	
    if(isset($_FILES['jdw_file']) && is_uploaded_file($_FILES['jdw_file']['tmp_name'])){
		$upload_dir = "file_salary/";
        $array = explode('.', $_FILES['jdw_file']['name']);
        $extension = end($array);
        $file_name = "Cuti_Karyawan".$extension;
		$file_path = $upload_dir . $file_name;
	if (!move_uploaded_file($_FILES['jdw_file']['tmp_name'], $file_path)) {
		echo "Error moving file upload";
	}else{
            $jdw_bulan = str_replace('/','',$_POST['jdw_bulan']);
//            $jdw_delete = $jdw->jdw_delete($jdw_bulan);
            require('excel-reader/excel_reader2.php');
            require('excel-reader/SpreadsheetReader_XLSX.php');
            $data_reader = new SpreadsheetReader_XLSX('file_salary/'.$file_name);
            $dataArr = array();
            $Sheets = $data_reader -> Sheets();
            foreach ($Sheets as $Index => $Name)

            {
                  //  echo $Name."<br>";
                    $Index = 0; //sheet1 //		
                    $data_reader -> ChangeSheet($Index);
                    $brs=0; 
					
					$xperiode="";
					$jenis_gaji = $_POST['jenis_gaji'];
                    foreach ($data_reader as $row){
                        $brs++;
						if ($brs <= 5 ){
					   		//judul
						}else{
						     $kol=0	;
						     $kol2=1	;
							 $datacuti="";
							 $dataket ="";
                       		 foreach ($row as $col){
						       
	                        	if($col){
							      $kol++;
/*								  
							  	  $nu   				= $row[0];
							  	  $nik    				= str_replace(" ","",$row[1]);
							  	  $nama    				= $row[2];
							  	  $jml_cuti				= $row[3];
*/							  
								  
								}  
							
                        	 }

							  	  $nu   				= $row[0];
							  	  $nik    				= str_replace(" ","",$row[1]);
							  	  $nama    				= $row[2];
							  	  $jml_cuti				= $row[3];
							 
							      if ($row[4] <> ""){
									  $datacuti  .= date('d-m-Y',strtotime($row[4]))."#";
								  }else{
								     $datacuti  .= "#";
								  }
							      if ($row[6] <> "" ){
									  $datacuti  .= date('d-m-Y',strtotime($row[6]))."#";
								  }else{
								     $datacuti  .= "#";
								  }
							      if ($row[8] <> "" ){
									  $datacuti  .= date('d-m-Y',strtotime($row[8]))."#";
								  }else{
								     $datacuti  .= "#";
								  }
							      if ($row[10] <> ""){
									  $datacuti  .= date('d-m-Y',strtotime($row[10]))."#";
								  }else{
								     $datacuti  .= "#";
								  }

							      if ($row[12] <> ""){
									  $datacuti  .= date('d-m-Y',strtotime($row[12]))."#";
								  }else{
								     $datacuti  .= "#";
								  }
							      if ($row[14] <> "" ){
									  $datacuti  .= date('d-m-Y',strtotime($row[14]))."#";
								  }else{
								     $datacuti  .= "#";
								  }
							      if ($row[16] <> "" ){
									  $datacuti  .= date('d-m-Y',strtotime($row[16]))."#";
								  }else{
								      $datacuti  .= "#";
								  }
							      if ($row[18] <> "" ){
									  $datacuti  .= date('d-m-Y',strtotime($row[18]))."#";
								  }else{
								     $datacuti  .= "#";
								  }
							      if ($row[20] <> ""){
									  $datacuti  .= date('d-m-Y',strtotime($row[20]))."#";
								  }else{
								     $datacuti  .= "#";
								  }
							      if ($row[22] <> ""){
									  $datacuti  .= date('d-m-Y',strtotime($row[22]))."#";
								  }else{
								      $datacuti  .= "#";
								  }
							      if ($row[24] <> ""){
									  $datacuti  .= date('d-m-Y',strtotime($row[24]))."#";
								  }else{
								      $datacuti  .= "#";
								  }

							      if ($row[26] <> ""){
									  $datacuti  .= date('d-m-Y',strtotime($row[26]))."#";
								  }else{
								      $datacuti  .= "#";
								  }

/*								  
								  $datacuti  .= date('d-m-Y',strtotime($row[4]))."#";
								  $datacuti  .= date('d-m-Y',strtotime($row[8]))."#";
								  $datacuti  .= date('d-m-Y',strtotime($row[10]))."#";
								  $datacuti  .= date('d-m-Y',strtotime($row[12]))."#";
								  $datacuti  .= date('d-m-Y',strtotime($row[14]))."#";
								  $datacuti  .= date('d-m-Y',strtotime($row[16]))."#";
								  $datacuti  .= date('d-m-Y',strtotime($row[18]))."#";
								  $datacuti  .= date('d-m-Y',strtotime($row[20]))."#";
								  $datacuti  .= date('d-m-Y',strtotime($row[22]))."#";
								  $datacuti  .= date('d-m-Y',strtotime($row[24]))."#";
								  $datacuti  .= date('d-m-Y',strtotime($row[26]))."#";
*/
								  $dataket   .= $row[5]."#";
								  $dataket   .= $row[7]."#";
								  $dataket   .= $row[9]."#";
								  $dataket   .= $row[11]."#";
								  $dataket   .= $row[13]."#";
								  $dataket   .= $row[15]."#";
								  $dataket   .= $row[17]."#";
								  $dataket   .= $row[19]."#";
								  $dataket   .= $row[21]."#";
								  $dataket   .= $row[23]."#";
								  $dataket   .= $row[25]."#";
								  $dataket   .= $row[27]."#";
							 
						//	echo '<br>'.$brs.' '.$nik.' '.$nama.' => '.$datacuti;
						//	echo '<br>'.$kol2.' '.$dataket;
							  
						      $simpan_libur = $row[28];
							  $xsimpan_libur = explode("#",$simpan_libur);
							 // $jml_simpan_libur = count($xsimpan_libur);
							  $j_simpan_libur = 0 ;
  							  for ($i=0; $i<count($xsimpan_libur); $i++ ) { 
								 if ($xsimpan_libur[$i] != ""){
									$j_simpan_libur++ ;
								 } 		 
							   } ;

							  
							  $xcuti =explode("#",$datacuti);
							  $j_cuti = 0; 
							  for ($i=0; $i<count($xcuti); $i++ ) { 
								 if ($xcuti[$i] != ""){
									$j_cuti++ ;
								 } 		 
							   } ;
							  $sisa_cuti = ($jml_cuti + $j_simpan_libur) - $j_cuti; 

							$kar_id = (int)ltrim(substr($nik,3,4)); 
							if (!empty($nik)){
								$tabel_cuti = " cuti_master ";
					       	    $sql_cek	= " SELECT * FROM $tabel_cuti 
								           		WHERE kar_id='$kar_id' 
										  	  ";
										  
										  
								$query_cek=mysql_query($sql_cek);
								$cek_nik= mysql_fetch_array($query_cek);
								
								$sql_add="INSERT INTO $tabel_cuti 
									      (kar_id,jml_cuti,sisa_cuti,datacuti,dataket,simpan_libur,jml_simpan_libur)  
										  VALUES
										 ('$kar_id','$jml_cuti','$sisa_cuti','$datacuti','$dataket','$simpan_libur',
										  '$j_simpan_libur') 
										  ";
										  
								$sql_upd=" UPDATE $tabel_cuti 
								           SET 
										   jml_cuti ='$jml_cuti',
										   sisa_cuti ='$sisa_cuti',
										   datacuti='$datacuti',
										   dataket ='$dataket',
										   simpan_libur ='$simpan_libur',
										   jml_simpan_libur ='$j_simpan_libur'
										   WHERE kar_id='$kar_id' 
								         ";
					               
								 if (empty($cek_nik['kar_id'])){
								    // echo $sql_add; exit();
									 $query_add=mysql_query($sql_add);
								 }else{
								    // echo $sql_upd;exit();
									 $query_upd=mysql_query($sql_upd);
								 
								 }	
								 
								// echo '<br>'.$brs.') '.$nu.' '.$kar_id.' '.$nik.' '.$nama;
								// echo '<br>'.$brs.') '.$nu.' '.$kar_id.' '.$nama;
								
							} 
							//exit();  
				     	}//brs// 

                    }//for data_reader //
                    // echo "<br>";
            } //for sheet //

        }

//	echo 'seting:'.$jdw_setting. ' bln : '.$jdw_bulan.' periode: '.$xperiode ;exit();
		 
  //      exit(); 
        echo "<script>document.location='?p=$page';</script>";

    }

    

}




/////////////////////////////////
?>