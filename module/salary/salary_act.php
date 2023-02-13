<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-sweetalert/1.0.1/sweetalert.css"> 
<script src="http://code.jquery.com/jquery-1.9.1.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-sweetalert/1.0.1/sweetalert.min.js"></script>
<?php
session_start();
$page=$_GET['p'];
$zona=$_GET['zona'];
$act=$_GET['act'];

if(isset($_POST['bimport'])){


	$jdw_setting = $_POST['jdw_setting'];
	$jdw_bulan   = $_POST['jdw_bulan'];   
	
    if(isset($_FILES['jdw_file']) && is_uploaded_file($_FILES['jdw_file']['tmp_name'])){
		$upload_dir = "file_salary/";
        $array = explode('.', $_FILES['jdw_file']['name']);
        $extension = end($array);
        $file_name = "SALARY_".str_replace('/','',$_POST['jdw_bulan']).".".$extension;
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
						if ($brs==1){
					   		//judul
					        //echo ' .................... Data Excel - ERROR() ! ..................... ';return;
/*							
							if ( strtoupper(ltrim($row[6])) <> "GAJI POKOK"){
							    echo '<script>alert("Mohon Maaf ini bukan file Salary !...tidak bisa diproses")
								     </script>';
								echo "<script>document.location='?p=$page';</script>"; 
								exit();
							}
*/							
						}else{	
                        	 $x=1;
							 $datagaji ="";
                       		 foreach ($row as $col){
	                        	if($col){
	                             // echo $col;
							  	  $periode 				= $row[0];
								  if ($jenis_gaji=="T"){
								  	  $periode 		    = $periode."-THR";
								  }
							  	  $nama    				= $row[1];
							  	  $nik     				= $row[2];
							  	  $jabatan 				= $row[3];
							  	  $divisi  				= $row[4];
							  	  $wilayah 				= $row[5];
							  	  $gt_gapok   			= $row[6];
							  	  $gt_t_struktural  	= $row[7];
							  	  $gt_t_fungsional  	= $row[8];
							  	  	$tot_upah_tetap 		= $row[9];
							  	  $gtt_t_umum        	= $row[10];
							  	  $gtt_t_kinerja     	= $row[11];
							  	  	$tot_upah_tidak_tetap	= $row[12];
							  	  $tunj_transport    	= $row[13];
							  	  $tunj_makan       	= $row[14];
							  	  $tunj_beras       	= $row[15];
							  	  $tunj_rumah       	= $row[16];
							  	  $tunj_dinas_lk    	= $row[17];
							  	  $tunj_lain       		= $row[18];
							  	  	$tot_tunjangan       	= $row[19];
							  	  	$total_gaji       	= $row[20];
							  	  $pot_bpjs_kes       	= $row[21];
							  	  $pot_bpjs_tk       	= $row[22];
							  	  $pot_bpjs_jp       	= $row[23];
							  	  $pot_iuran_paguyuban  = $row[24];
							  	  $pot_uang_beras       = $row[25];
							  	  $pot_sewa_rumah       = $row[26];
							  	  $pot_pinj_paguyuban   = $row[27];
							  	  $ke       			= $row[28];
							  	  $pot_pinj_lain       	= $row[29];
							  	  $pot_kewajiban_lain	= $row[30];
							  	  	$total_potongan       	= $row[31];
							  	  	$total_gaji_diterima	= $row[32];
							  	  $bpjs_pk       		= $row[33];
							  	  $jht_pk       		= $row[34];
							  	  $jkk       			= $row[35];
							  	  $jkm       			= $row[36];
							  	  $jp       			= $row[37];
							  	  $pph21       			= $row[38];
							  	  $bank       			= $row[39];
							  	  $norek       			= $norek_bank   =  str_replace('.','',$row[40]);
								  
								  $pot_10persen       	= $row[51];
								  $reword_pmb          	= $row[52];
							  
								  $datagaji .= $col."#" ;
								  
                           		}else{
								   $datagaji .= "#";
								}
                           		$x++;
                        	 }
							if (!empty($periode)){
							    $xperiode	= $row[0];
								
								//$test_encode=$eco->ecrypt($datagaji);
								//$test_decode=$eco->dcrypt($test_encode);
                                $datagaji = $eco->ecrypt($datagaji);
								
                               // echo $datagaji.'<br>';
								
								//$aDatagaji = explode("#",$datagaji);
					       	    $sql_periode="SELECT periode FROM salary_periode 
								              WHERE periode='$periode'
										    ";
										  
								$query_periode=mysql_query($sql_periode);
								$cek_periode= mysql_fetch_array($query_periode);
								$jdw_bulan   = $_POST['jdw_bulan'];
								if (empty($cek_periode['periode'])){
								    $sql_bln_add = "INSERT INTO salary_periode 
									                (periode,blnthn) 
													VALUES 
													('$periode','$jdw_bulan') ";
									$query_add=mysql_query($sql_bln_add);
								}

					       	    $sql_cek="SELECT nik FROM salary_master 
								           WHERE periode='$periode' AND nik='$nik'
										  ";
										  
								$query_cek=mysql_query($sql_cek);
								$cek_nik= mysql_fetch_array($query_cek);
								
								$sql_add="INSERT INTO salary_master 
									      (periode,nama,nik,jabatan,divisi,wilayah,datagaji)  
										  VALUES
										  ('$periode','$nama','$nik','$jabatan','$divisi','$wilayah','$datagaji') 
										  ";
										  
								$sql_upd=" UPDATE salary_master 
								           SET 
										   nama ='$nama',
										   jabatan='$jabatan',
										   divisi ='$divisi',
										   wilayah='$wilayah',
										   datagaji='$datagaji' 
										   WHERE periode='$periode' AND nik='$nik'
								         ";
					  
								 if (empty($cek_nik['nik'])){
									 $query_add=mysql_query($sql_add);
								 }else{
									 $query_upd=mysql_query($sql_upd);
								 
								 }	
								 /// update pin ///	 
								 $xnik     =  trim(strtoupper(str_replace('.','',$nik)));
								 $sql_pin1 = "SELECT acc_username FROM acc_master WHERE  acc_username='$xnik' ";
								 $cek_pin1 =  mysql_fetch_array(mysql_query($sql_pin1));
								 if ($cek_pin1['acc_username']==""){ 
									 $sql_pin2 = "SELECT nik FROM salary_pin WHERE  nik = '$xnik' ";
									 $cek_pin2 =  mysql_fetch_array(mysql_query($sql_pin2));
									 if ($cek_pin2['nik']==""){ 
									 	$pin_text = "123456";
										$pin	  = $eco->ecrypt($pin_text);	
										$sql_pin2="INSERT INTO salary_pin 
										      		  (nik,pin_text,pin,bank,norek)  
											  		  VALUES 
											 		  ('$xnik','$pin_text','$pin','$bank','$norek') 
											  	   ";
													 
									    $query_add_pin=mysql_query($sql_pin2);
										
									 }
								    
								 } 
								 
								// echo '<br>'.$brs.') '.$periode.' '.$nama;
								
							} 
							//exit();  
				     	}//brs// 

                    }//for data_reader //
                    // echo "<br>";
            } //for sheet //

        }

//	echo 'seting:'.$jdw_setting. ' bln : '.$jdw_bulan.' periode: '.$xperiode ;exit();
		 
	if($jdw_setting == 'Y'){
//	    $jdw_aktif_update=$jdw->jdw_aktif_update($jdw_bulan);
		$jdw_aktif_update=mysql_query("UPDATE salary_periode SET aktif='N' ");
		$jdw_aktif_update=mysql_query("UPDATE salary_periode SET aktif='$jdw_setting'
		                               WHERE blnthn='$jdw_bulan' ");

	}
		$jdw_aktif_update=mysql_query("UPDATE salary_periode SET blnthn='$jdw_bulan'
		                               WHERE blnthn='$jdw_bulan' ");


        echo "<script>document.location='?p=$page';</script>";

	

    }

    

}



if(isset($_POST['bsave_pass'])){
/////////////////////////////////////
   $oldpass = $_REQUEST['oldpass'];
   $xnewpass = $_REQUEST['newpass'];
   $newpass = $eco->ecrypt($xnewpass);
   $pass_absen = $_SESSION['pass_absen'];
   if ($pass_absen == $oldpass ){  
	   $sql_upd="UPDATE acc_master SET acc_pass_eslip='$newpass' WHERE kar_id='$kar_id'";
 	   $save_pass = mysql_query($sql_upd);
	   echo "
		  <script type='text/javascript'>
			setTimeout(function () { 	
				swal({
					title: 'Rubah Pasword',
					text:  '$xnewpass    =>  OK !...',
					type: 'success',
					timer: 300000,
					showConfirmButton: true
				});		
			},10);
		  </script>";	    
	}else{
	   echo "
		  <script type='text/javascript'>
			setTimeout(function () { 	
				swal({
					title: 'Pasword lama ... Salah !...',
					text:  'Ulangi Lagi !...',
					type: 'error',
					timer: 300000,
					showConfirmButton: true
				});		
			},10);
		  </script>";			
		
	
	}	  
///////////////////////////////////		   
}
if(isset($_POST['bsave_pass_reset'])){
  $xdata = $_REQUEST['pass_reset'];
  $pass_reset=explode("#",$xdata);
  $id      = $pass_reset[0];
  $oldpass = $pass_reset[1];
  $xnik    = $pass_reset[2];
  $xnama   = $pass_reset[3];
  $text    = $xnik.' '.$xnama.' \n pass-absen : '.$oldpass; 
  $sql_reset_pass  ="UPDATE acc_master SET acc_pass_eslip='' WHERE kar_id='$id' ";
  $save_pass_reset = mysql_query($sql_reset_pass);
	   echo "
		  <script type='text/javascript'>
			setTimeout(function () { 	
				swal({
					title: 'Reset Pasword eSlip',
					text:  '$text',
					type: 'success',
					timer: 300000,
					showConfirmButton: true
				});		
			},10);
		  </script>";		  
}

function strpos_arr($haystack, $needle) {

    if(!is_array($needle)) $needle = array($needle);

    foreach($needle as $what) {

        if(($pos = strpos($haystack, $what))!==false) return $pos;

    }

    return false;

}


$sql="SELECT * FROM salary_periode WHERE aktif='Y' LIMIT 1";
$query=mysql_query($sql);
$jdw_aktif_data  = mysql_fetch_array($query);
$jdw_blnthn = $jdw_aktif_data['periode'];
$tgl_cetak  = $jdw_aktif_data['blnthn'];

$bulan = $_REQUEST['bulan'];
if (empty($bulan)){
   $bulan = $jdw_blnthn;
}
$dtbln=explode('/',$tgl_cetak);
$bln  = $dtbln[0];
$thn  = $dtbln[1];
$xtgl_ctk = "$bln/01/$thn";
$_SESSION['tgl_cetak'] = $xtgl_ctk ;
//echo 'tgl.cetak:'.date('t M Y',strtotime($xtgl_ctk)).' - '.$_SESSION['tgl_cetak'];

//echo 'bulan:'.$bulan;

//$range = 3 ;
//$tgl_awal = date('M-Y',strtotime('+1 months',strtotime(date('M-Y'))));
//$tgl_awal = date('M-Y');
//$tgl_akhir = $tgl_awal.' - '.date('M-Y',strtotime('-'.$range.' months',strtotime($tgl_awal))); 
//echo $tgl_akhir;


/* list datagaji */
/*
$sqlx="SELECT * FROM salary_master LIMIT 1";
$queryx=mysql_query($sqlx);
$rdata = mysql_fetch_array($queryx);
$adata = explode('#',$eco->dcrypt($rdata['datagaji']));
for ($i=0;$i<count($adata);$i++){
    echo '<br>'.$i.') '.$adata[$i];
}	
*/


?>