<?php
session_start();

foreach($_REQUEST as $name=>$value){
    //$$name=$value;
    //echo "$name : $value;<br />\n";
}

$page=$_GET['p'];
$zona=$_GET['zona'];
$act=$_GET['act'];
$date_file = date('Y-m-d');
if(isset($_POST['bimport'])){

	
    if(isset($_FILES['jdw_file']) && is_uploaded_file($_FILES['jdw_file']['tmp_name'])){

	$nmfile  = $_FILES["jdw_file"]["name"];	
	$upload_dir = "file_marketing/";
        $array = explode('.', $_FILES['jdw_file']['name']);
        $extension = end($array);
	//$file_name = $nmfile."_".str_replace('/','',$date_file).".".$extension;
	$file_name = $nmfile;
	$file_path = $upload_dir . $file_name;
		
	if (!move_uploaded_file($_FILES['jdw_file']['tmp_name'], $file_path)) {
		echo "Error moving file upload";
	}else{
		
            require('excel-reader/excel_reader2.php');
            require('excel-reader/SpreadsheetReader_XLSX.php');
            $data_reader = new SpreadsheetReader_XLSX('file_marketing/'.$file_name);
            $dataArr = array();
            $Sheets = $data_reader -> Sheets();
            foreach ($Sheets as $Index => $Name){
		
		    // echo $Name."<br>";
                    $Index = 0; //sheet1 //		
                    $data_reader -> ChangeSheet($Index);
                    $brs=0; 
                    foreach ($data_reader as $row){
                        $brs++;
			if ($brs<=2){
			    //judul
			    //echo ' .................... Data Excel - ERROR() ! ..................... ';return;
			}else{	
                            $x=1;
			    foreach ($row as $col){
	                        if($col){
				    //echo $col;
				    $urut 				= $row[0];
				    $nama    				= str_replace("'", "", $row[1]);
				    $nohp 				= $row[2];
				    $email  				= $row[3];
				    $kota 				= $row[4];
				    
				    $tmplahir 				= $row[5];
				    $tgllahir 				= $row[6];
				    $pendidikan 			= $row[7];
				    $pekerjaan 				= $row[8];
				    
				    $informasi			  	= $row[9];
				    $status			  	= $row[10];
				    $ket  				= $row[11];
				    $batch	 			= $row[12];
                           	}else{

				}
                           	$x++;
                            } 
			}

			    ///////////////////////////////////////
			    //echo '<br>'.$urut.' '.$informasi;
			    ////////////////////////////////////////
			    $sql_cek=" SELECT mfc_id,mfc_nama FROM tmp_marketing_support WHERE mfc_nama='$nama' and mfc_email='$email' and mfc_nohp='$nohp'";
						    
			    $query_mfc  = mysql_query($sql_cek);
			    $r_kode	= mysql_fetch_array($query_mfc);
			    $cek_id    	= $r_kode['mfc_id'];
			    $cek_nama  	= $r_kode['mfc_nama'];
			    $tgl   	= date('Y-m-d');
			    
			    if ($urut <> ""){
				if ($cek_nama==""){
				    //echo '<br>'.$urut.' '.$nama;
				    //////add//////
				    $sql_add = "INSERT INTO tmp_marketing_support (mfc_nama,mfc_kota,mfc_email,mfc_nohp,mfc_informasi,mfc_tmplahir,mfc_tglahir,mfc_pendidikan,mfc_pekerjaan,mfc_status,mfc_ket,mfc_batch,mfc_tglupd,mfc_tglmdf) VALUES ('$nama','$kota','$email','$nohp','$informasi','$tmplahir','$tgllahir','$pendidikan','$pekerjaan','$status','$ket','$batch','$date_file','$date_file')";					    
				    
				    //echo '<br>'.$sql_add;return;
				    if ($urut <> ""){													
					    $query_add=mysql_query($sql_add );
				    }								   
						   
				}else{
				    //////update////////
				    $sql_upd = "UPDATE tmp_marketing_support SET mfc_kota='$kota',mfc_informasi='$informasi',mfc_tmplahir='$tmplahir',mfc_tglahir='$tgllahir',mfc_pendidikan='$pendidikan',mfc_pekerjaan='$pekerjaan',mfc_status='$status',mfc_ket='$ket',mfc_batch='$batch',mfc_tglmdf='$date_file' WHERE mfc_id = '$cek_id'";

					//echo '<br>'.$sql_add;return;
					if ($urut <> ""){													
					    $query_upd=mysql_query($sql_upd );
					}								 						   
				}	
			    } ///not empty///					

                    }//for data_reader //
                    // echo "<br>";
            } //for sheet //

        }
       
        echo "<script>document.location='?p=$page';</script>";
	   

    }

    

}




function strpos_arr($haystack, $needle) {
    if(!is_array($needle)) $needle = array($needle);
    foreach($needle as $what) {
        if(($pos = strpos($haystack, $what))!==false) return $pos;
    }
    return false;
}
?>