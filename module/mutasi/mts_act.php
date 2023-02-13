<?php

session_start(); 


function cek_jbt($kd) {
 $xsql 		= "SELECT * FROM jbt_master WHERE jbt_id='$kd' ";
 $xquery  	= mysql_query($xsql) ;
 $xrow  	= mysql_fetch_array($xquery);
 return $xrow['jbt_nm'] ; 
}

function cek_div($kd) {
 $xsql 		= "SELECT * FROM div_master WHERE div_id='$kd' ";
 $xquery  	= mysql_query($xsql) ;
 $xrow  	= mysql_fetch_array($xquery);
 return $xrow['div_nm'] ; 
}

function cek_lvl($kd) {
 $xsql 		= "SELECT * FROM lvl_master WHERE lvl_id='$kd' ";
 $xquery  	= mysql_query($xsql) ;
 $xrow  	= mysql_fetch_array($xquery);
 return $xrow['lvl_nm'] ; 
}

function cek_unt($kd) {
 $xsql 		= "SELECT * FROM unt_master WHERE unt_id='$kd' ";
 $xquery  	= mysql_query($xsql) ;
 $xrow  	= mysql_fetch_array($xquery);
 return $xrow['unt_nm'] ; 
}

function cek_ktr($kd) {
 $xsql 		= "SELECT * FROM ktr_master WHERE ktr_id='$kd' ";
 $xquery  	= mysql_query($xsql) ;
 $xrow  	= mysql_fetch_array($xquery);
 return $xrow['ktr_nm'] ; 
}

function cek_nama($kd) {
 $xsql 		= "SELECT kar_nm FROM kar_master WHERE kar_id='$kd' ";
 $xquery  	= mysql_query($xsql) ;
 $xrow  	= mysql_fetch_array($xquery);
 return $xrow['kar_nm'] ; 
}

foreach($_REQUEST as $name=>$value)
	{
		$$name=$value;
		//echo "$name : $value;<br />\n";
    }
 
 
$page=$_GET['p'];

$act=$_GET['act'];

$print=$_GET['to'];

$pdf=$_GET['to'];

$nonaktif="disabled";
//$nonaktif="";



if(isset($page)&&($act=="open")){
  

  $fpk_id_=$_GET['id'];

  $fpk_tampil_id=$mts->mts_tampil_id($fpk_id_);

  $fpk_data_id=mysql_fetch_array($fpk_tampil_id);

  $fpk_cek_id=mysql_num_rows($fpk_tampil_id);
  
  $fpk_konfirm_user=$mts->mts_konfirm_user($fpk_id_,$kar_id);
  $fpk_cek_konfirm=mysql_num_rows($fpk_konfirm_user);
  
 // echo 'xxx:'.$fpk_data_id['fpk_konfirm'];

  if(!empty($fpk_data_id['fpk_konfirm'])){
    $datasts=$fpk_data_id['fpk_konfirm'];
    $ceksts="N";
    if (strpos($datasts,$ceksts) !== false) {
	    $konfirm="disabled";
	    $ignore="";
    }else{
	    $konfirm="";
	    $ignore="disabled";
    }
  
  }else{
     $konfirm="";//disabled
     $ignore="disabled";
  }


/*  
  if(!empty($fpk_data_id['fpk_ditetapkan'])){
    $konfirm2="disabled";
  }else{
    $konfirm2="";//disabled
  }
*/

  if ($fpk_data_id['fpk_approval_2']=="Y"){
    $konfirm2="disabled";
  }else{
    $konfirm2="";//disabled
  }

  if ($fpk_data_id['fpk_approval_1']=="Y"){
    $konfirm="disabled";
  }else{
    $konfirm="";//disabled
  }
  
  if($fpk_data_id['fpk_sts']=="Y"){
    
    $disabled="disabled";

  }else{
    if($fpk_data_id['fpk_sts']=="Z"){
      $disabled="disabled";
    }else{
      $disabled="";
    }

  }
  
  if($fpk_data_id['fpk_sts']!=="Y"){

    $disabled_approv="disabled";

  }else{

    $disabled_approv="";

  }

  
  if($fpk_data_id['fpk_sts']=="Z"){

    $done="disabled";

  }else{

    $done="";

  }


  //Update Read Notify
  
  $ntf_data_url=$fpk_id_;
  $ntf_data_tujuan=$kar_id;

  $ntf_data_tampil_kd=$ntf->ntf_data_tampil_kd($page,$ntf_data_url,$ntf_data_tujuan);

  $ntf_data_kd_cek = mysql_num_rows($ntf_data_tampil_kd);

  if($ntf_data_kd_cek == 1){

     $ntf_data_kd_data = mysql_fetch_array($ntf_data_tampil_kd);

     $read_first=$kar_id;

     $read_next=$ntf_data_kd_data['ntf_data_read']."#".$kar_id;

     $ntf_data_id=$ntf_data_kd_data['ntf_data_id'];

     if(empty($ntf_data_kd_data['ntf_data_read'])){

        $ntf_data_read=$read_first;

	$ntf_data_tampil_read=$ntf->ntf_data_tampil_read($ntf_data_id,$read_first);

	$ntf_data_kar_cek = mysql_num_rows($ntf_data_tampil_read);

	if($ntf_data_kar_cek == 0){

	  $ntf_data_update_read=$ntf->ntf_data_update_read($ntf_data_id,$ntf_data_read);

	}

     }else{

	$ntf_data_read=$read_next;

	$ntf_data_tampil_read=$ntf->ntf_data_tampil_read($ntf_data_id,$read_first);

	$ntf_data_kar_cek = mysql_num_rows($ntf_data_tampil_read);

	if($ntf_data_kar_cek == 0){

	  $ntf_data_update_read=$ntf->ntf_data_update_read($ntf_data_id,$ntf_data_read);

	}

     }

    /* echo"<script>alert('$ntf_data_kd_data[ntf_data_read].$ntf_data_kd_data[ntf_data_id]');</script>"; */

  }

    

  $kar_id_=$fpk_data_id['kar_id'] ? $fpk_data_id['kar_id']:$_GET['id'];  

}else{

  $kar_id_=$_GET['id'];

}



if(isset($_GET['p']) && isset($_GET['id'])){

  $_SESSION['kar_id_nla'] = $_GET['id'];

}

if(isset($_GET['p']) && !isset($_GET['id'])){

  $_SESSION['kar_id_nla'] = '';

}

$kar_tampil_id=$kar->kar_tampil_id($kar_id_);
$kar_data_=mysql_fetch_array($kar_tampil_id);


//////////detail karyawan/////////////////////
$sql_kary= "SELECT
			a.kar_id,a.kar_nik,a.kar_nm,
			a.jbt_id,b.jbt_nm,
			a.div_id,c.div_nm,
			a.lvl_id,d.lvl_nm,
			a.unt_id,e.unt_nm,
			a.ktr_id,f.ktr_nm 
			FROM kar_master a
			LEFT JOIN jbt_master b ON b.jbt_id=a.jbt_id
			LEFT JOIN div_master c ON c.div_id=a.div_id
			LEFT JOIN lvl_master d ON d.lvl_id=a.lvl_id
   		    LEFT JOIN unt_master e ON e.unt_id=a.unt_id
			LEFT JOIN ktr_master f ON f.ktr_id=a.ktr_id
			WHERE a.kar_id='$kar_id'
			";
$q_kar		 = mysql_query($sql_kary) or die (mysql_error());	
$kar_detail  = mysql_fetch_array($q_kar);

/////////////////////////////////////////////////
$sql_jbt= "SELECT
			a.kar_id,a.kar_nik,a.kar_nm,
			a.jbt_id,b.jbt_nm,
			a.div_id,c.div_nm,
			a.lvl_id,d.lvl_nm,
			a.unt_id,e.unt_nm,
			a.ktr_id,f.ktr_nm 
			FROM kar_master a
			LEFT JOIN jbt_master b ON b.jbt_id=a.jbt_id
			LEFT JOIN div_master c ON c.div_id=a.div_id
			LEFT JOIN lvl_master d ON d.lvl_id=a.lvl_id
			LEFT JOIN unt_master e ON e.unt_id=a.unt_id
			LEFT JOIN ktr_master f ON f.ktr_id=a.ktr_id
			WHERE a.kar_id='$id'
			";
$q_jbt	  = mysql_query($sql_jbt) or die (mysql_error());	
$kar_jbt  = mysql_fetch_array($q_jbt);
/////////////////////////////////////////////
//////////detail Pemohon / Penilai /////////////////////
$x_penilai = $fpk_penilai;
if ( $fpk_penilai == "" ){
  $x_penilai = $fpk_data_id['fpk_penilai'];

}


$sql_pemohon= "SELECT
			a.kar_id,a.kar_nik,a.kar_nm,
			a.jbt_id,b.jbt_nm,
			a.div_id,c.div_nm,
			a.lvl_id,d.lvl_nm,
			a.unt_id,e.unt_nm,
			a.ktr_id,f.ktr_nm  
			FROM kar_master a
			LEFT JOIN jbt_master b ON b.jbt_id=a.jbt_id
			LEFT JOIN div_master c ON c.div_id=a.div_id
			LEFT JOIN lvl_master d ON d.lvl_id=a.lvl_id
			LEFT JOIN unt_master e ON e.unt_id=a.unt_id
			LEFT JOIN ktr_master f ON f.ktr_id=a.ktr_id
			WHERE a.kar_id='$x_penilai'
			";
			
			
$q_kar2		 = mysql_query($sql_pemohon) or die (mysql_error());	
$kar_pemohon  = mysql_fetch_array($q_kar2);		
/////////////////////////////////////////////
$sql1 = "SELECT * FROM jbt_master ORDER BY jbt_id ";
$query1=mysql_query($sql1) or die (mysql_error());
while($row1=mysql_fetch_array($query1)){ $data_jbt[]=$row1; }
$jbt_tampil = $data_jbt;
/////////////////////////////////////////////
$sql2 = "SELECT * FROM div_master ORDER BY div_id ";
$query2  =mysql_query($sql2) or die (mysql_error());
while($row2=mysql_fetch_array($query2)){ $data_div[]=$row2; }
$div_tampil = $data_div;
/////////////////////////////////////////////
$sql3 = "SELECT * FROM lvl_master ORDER BY lvl_id ";
$query3  =mysql_query($sql3) or die (mysql_error());
while($row3=mysql_fetch_array($query3)){ $data_lvl[]=$row3; }
$lvl_tampil = $data_lvl;
/////////////////////////////////////////////

$sql4 = "SELECT * FROM unt_master ORDER BY unt_id ";
$query4  =mysql_query($sql4) or die (mysql_error());
while($row4=mysql_fetch_array($query4)){ $data_unt[]=$row4; }
$unt_tampil = $data_unt;
/////////////////////////////////////////////
//$filter_ktr = " WHERE (ktr_id <> '171' and ktr_id<>'172' and ktr_id<>'173') ";
$filter_ktr = "";
$sql5 = "SELECT * FROM ktr_master $filter_ktr ORDER BY ktr_id ";
$query5  =mysql_query($sql5) or die (mysql_error());
while($row5=mysql_fetch_array($query5)){ $data_ktr[]=$row5; }
$ktr_tampil = $data_ktr;
/////////////////////////////////////////////

//AUTO FPK

$pecah_nik=explode(".",$kar_data_['kar_nik']);
$kd_karyawan=$pecah_nik[1];	
$kd_awal		="FMK";
$kd_tahun 		= substr(date("Y"),2,4);
$fpk_kd_awal 	= $mts->mts_kd_awal($kdawal);
$cek_fpk_kd  	= mysql_num_rows($fpk_kd_awal);
$data_fpk_kd  	= mysql_fetch_array($fpk_kd_awal);

$max_fpk_kd = $data_fpk_kd['max_kd'];
$no_urut_kd = (int) substr($max_fpk_nik, 7, 4);
$no_urut_kd++;

$fpk_kd_auto = $mts->mts_kd_auto();
$data_kd_auto  = mysql_fetch_array($fpk_kd_auto);
$no_urut_auto = $data_kd_auto['max_kd_auto'];
$no_urut_auto++;

$new_kd = $kd_awal .$kd_karyawan. $kd_tahun .sprintf("%04s", $no_urut_auto);

//VARIABLE

$fpk_kd=$new_kd;

//if($_POST['fpk_priode'] == "Evaluasi"){

//  $fpk_keterangan="Evaluasi Tetap";

//}else{

//  $fpk_keterangan="Evaluasi Kontrak";

//}

if ( $jenis_data=="" ){
  $jenis_data = $fpk_data_id['fpk_jenis']; 
  
}

if($jenis_data == "Mutasi"){
  $fpk_keterangan="Mutasi Karyawan";
  $xjenis = "Mutasi";
}else{
  $xjenis = "Demosi";
  $fpk_keterangan="Demosi Karyawan";
}


$fpk_priode=$_POST['fpk_priode'];
$fpk_gaji = $_POST['fpk_gaji'];
$fpk_tgl = $_POST['fpk_tgl'];



for ($i = 1; $i < 19; $i++) {
    $x = "fpk_nilai{$i}";
    ${'fpk_nilai'.$i}=$_POST[$x]; 

}

$fpk_prestasi=$_POST['fpk_prestasi'];
$fpk_pelanggaran=$_POST['fpk_pelanggaran'];
$fpk_saranperbaikan=$_POST['fpk_saranperbaikan'];
$fpk_penilai=$_POST['fpk_penilai'];
$fpk_mengetahui=$_POST['fpk_mengetahui'];
$fpk_mengetahui2=$_POST['fpk_mengetahui2'];
$fpk_ditetapkan="";
/* 
if($_POST['fpk_priode'] == "Evaluasi"){

  $fpk_ditetapkan="";

}else{

  $fpk_ditetapkan=$_POST['fpk_ditetapkan'];

}
*/


$fpk_sts="X"; //status X,Y,Z  X=Proses. Y=Lock. Z=Approved

$fpk_sesi=$sesi;


$fpk_jabatan =$_POST['fpk_jabatan'];
$fpk_jabatan2=$_POST['fpk_jabatan2'];

/*
$fpk_jbt1 = $kar_jbt['jbt_id'] ;
$fpk_div1 = $kar_jbt['div_id'];
$fpk_lvl1 = $kar_jbt['lvl_id'];
$fpk_unt1 = $kar_jbt['unt_id'];
$fpk_ktr1 = $kar_jbt['ktr_id'];
*/

$fpk_jbt1 = $fpk_jabatan1 ;
$fpk_div1 = $fpk_divisi1;
$fpk_lvl1 = $fpk_level1;
$fpk_unt1 = $fpk_unit1;
$fpk_ktr1 = $fpk_ktr1;

$fpk_jbt2 = $fpk_jabatan2 ;
$fpk_div2 = $fpk_divisi2;
$fpk_lvl2 = $fpk_level2;
$fpk_unt2 = $fpk_unit2;
$fpk_ktr2 = $fpk_ktr2;
////////////////detail-pemohon///////////////
$fpk_pemohon     = $fpk_penilai;
$fpk_pemohon_jbt = $kar_pemohon['jbt_id'];
$fpk_pemohon_div = $kar_pemohon['div_id'];
$fpk_pemohon_lvl = $kar_pemohon['lvl_id'];
$fpk_pemohon_unt = $kar_pemohon['unt_id'];
////////////////////////////////////////////
$nm_pemohon      = $kar_pemohon['kar_nm'];
$jbt_pemohon     = $kar_pemohon['jbt_nm'];
$div_pemohon     = $kar_pemohon['div_nm'];
$lvl_pemohon     = $kar_pemohon['lvl_nm'];
$unt_pemohon     = $kar_pemohon['unt_nm'];



//////////////////////////////////////////
//echo '<br> div:'.cek_div('1').' '.cek_jbt('1').' '.cek_lvl('1').' '.cek_unt('1');
/*
echo '<br> '.$nm_pemohon;
echo '<br> '.$jbt_pemohon;
echo '<br> '.$div_pemohon;
echo '<br> '.$lvl_pemohon;
echo '<br> '.$unt_pemohon;
*/

if(isset($_POST['bsave'])){
    
	//return;
	
 	$sql="INSERT INTO mts_master 
		  (
		   fpk_kd,fpk_jenis,fpk_keterangan,fpk_priode,fpk_gaji,fpk_tgl,
		   fpk_jbt1,fpk_jbt2,fpk_div1,fpk_div2,fpk_lvl1,fpk_lvl2,fpk_unt1,fpk_unt2,
		   fpk_ktr1,fpk_ktr2,
		   fpk_pemohon,fpk_pemohon_jbt,fpk_pemohon_div,fpk_pemohon_lvl,fpk_pemohon_unt,
		   fpk_penilai,fpk_mengetahui,fpk_mengetahui2,fpk_menyetujui,fpk_konfirm, 
		   fpk_ditetapkan,fpk_sts,fpk_sesi,fpk_kirim,fpk_berlaku,kar_id
		  ) 
		  VALUES 
		  ('$fpk_kd','$jenis_data','$fpk_keterangan','$fpk_priode',NULL,NULL,
		   '$fpk_jbt1','$fpk_jbt2','$fpk_div1','$fpk_div2','$fpk_lvl1','$fpk_lvl2','$fpk_unt1','$fpk_unt2',
		   '$fpk_ktr1','$fpk_ktr2',
		   '$fpk_penilai','$fpk_pemohon_jbt','$fpk_pemohon_div','$fpk_pemohon_lvl','$fpk_pemohon_unt',
		   '$fpk_penilai','$fpk_mengetahui','$fpk_mengetahui2','$fpk_menyetujui',NULL, 
		   '$fpk_ditetapkan','$fpk_sts','$fpk_sesi','$date',NULL,'$kar_id_'
		  )
		  ";


   ////////////////////////////
   $fpk_insert=mysql_query($sql) or die (mysql_error());
   $fpk_id=mysql_insert_id();

  if($fpk_insert){
    //Notify
   // $ntf_act="";
   if ($jenis_data == "Mutasi"){
	   $ntf_act="Form Mutasi Karyawan - ".$fpk_priode;
   }else{
	   $ntf_act="Form Demosi Karyawan - ".$fpk_priode;
   }

    //ISI NOTIF = idFPK, Keterangan, Penilai, Mengetahui, Karyawan yg dinilai, kode, Sesi
    $ntf_isi=$fpk_id.'*%#'.$fpk_keterangan.'*%#'.$fpk_penilai.'*%#'.$fpk_mengetahui.'*%#'.$fpk_mengetahui2.'*%#'.$kar_id_.'*%#'.$fpk_kd.'*%#'.$fpk_sesi;

    $ntf_ip=$ip_jaringan;
    $ntf_tgl=$date;
    $ntf_jam=$time;
	//////////////////////////////////
    $ntf_insert=$ntf->ntf_insert($ntf_act,$ntf_isi,$ntf_ip,$ntf_tgl,$ntf_jam,$kar_id);
    //End Notify

    //Notify DATA

   // $ntf_data_act="Form Mutasi Kerja"; //ACT Disesuaikan
   if ($jenis_data == "Mutasi"){
	   $ntf_data_act ="Form Mutasi Karyawan - ".$fpk_priode;
   }else{
	   $ntf_data_act ="Form Demosi Karyawan - ".$fpk_priode;
   }	

    $ntf_data_isi=$kar_data_['kar_nm']; //ISI Disesuaikan

    $ntf_data_url="?p=detail_mutasi&act=open&id=".md5($fpk_kd); //URL Disesuaikan

    $ntf_data_tujuan=$fpk_penilai; //Semua Tujuan = ALL

    $ntf_data_sumber=$kar_id; //Auto Sumber = SYSTEM

    $ntf_data_ip=$ip_jaringan;

    $ntf_data_tgl=$date;

    $ntf_data_jam=$time;
	////////////////////////////////////////////////

   $ntf_data_insert=$ntf->ntf_data_insert($ntf_data_act,$ntf_data_isi,$ntf_data_url,$ntf_data_ip,$ntf_data_tgl,$ntf_data_jam,$ntf_data_tujuan,$ntf_data_sumber);

    //End Notify DATA

 	
    echo"<script>document.location='?p=$page&id=$kar_id_';</script>";

  }else{

    echo"<script>alert('Insert Failed');document.location='?p=$page&id=$kar_id_';</script>";

  }

}



if(isset($_POST['bupdate'])){
  /////update - hanya simpan //////
 
}



if(isset($_POST['bsendupdate'])){
   $xjenis      =$fpk_data_id['fpk_jenis']; 
   $fpk_id		=$fpk_data_id['fpk_id'];
   $fpk_kode	=$fpk_data_id['fpk_kd'];
   $fpk_approvel=$fpk_data_id['fpk_mengetahui2'];
   $fpk_priode  =$fpk_data_id['fpk_priode'];

   $fpk_sts="Y"; //status X,Y,Z  X=Proses. Y=Lock. Z=Approved
 
   $sql_upd="
		UPDATE mts_master 
		SET 
		fpk_tgl='$fpk_tgl',
		fpk_jbt2='$fpk_jabatan2',
		fpk_div2='$fpk_divisi2',
		fpk_lvl2='$fpk_level2',
		fpk_unt2='$fpk_unit2',
		fpk_ktr2='$fpk_ktr2',
		fpk_alasan='$fpk_alasan',
		fpk_sts='$fpk_sts' 
		WHERE fpk_id='$fpk_id'
		";
	
   // echo '<br>Update : mhs_detail.php';
   // echo '<br>'.$sql_upd;
   // return;	
	
	
    $fpk_update=mysql_query($sql_upd) or die (mysql_error());

  if($fpk_update){

    //Notify
    $ntf_act="Konfirm ".$xjenis." Karyawan - ".$fpk_priode;
    //ISI NOTIF = idFPK, Keterangan, Penilai, Mengetahui2, Karyawan yg dinilai, kode, Sesi
    $ntf_isi=$fpk_id.'*%#'.$fpk_keterangan.'*%#'.$fpk_penilai.'*%#'.$fpk_mengetahui2.'*%#'.$kar_id_.'*%#'.$fpk_kd.'*%#'.$fpk_sesi;
    $ntf_ip=$ip_jaringan;
    $ntf_tgl=$date;
    $ntf_jam=$time;
    $ntf_insert=$ntf->ntf_insert($ntf_act,$ntf_isi,$ntf_ip,$ntf_tgl,$ntf_jam,$kar_id);
    //End Notify
    //Notify DATA

    $ntf_data_act="Konfirm ".$xjenis." Karyawan - ".$fpk_priode; //ACT Disesuaikan
    $ntf_data_isi=$kar_data_['kar_nm']; //ISI Disesuaikan
    $ntf_data_url="?p=hasil_mutasi2&act=open&id=".md5($fpk_kode); //URL Disesuaikan
    $ntf_data_tujuan=$fpk_approvel; //Semua Tujuan = ALL
    $ntf_data_sumber=$kar_id; //Auto Sumber = SYSTEM
    $ntf_data_ip=$ip_jaringan;
    $ntf_data_tgl=$date;
    $ntf_data_jam=$time;
    $ntf_data_insert=$ntf->ntf_data_insert($ntf_data_act,$ntf_data_isi,$ntf_data_url,$ntf_data_ip,$ntf_data_tgl,$ntf_data_jam,$ntf_data_tujuan,$ntf_data_sumber);

    //End Notify DATA

    

    echo"<script>document.location='?p=$page&act=$act&id=".md5($fpk_kode)."';</script>";

  }else{

    echo"<script>alert('Insert Failed');document.location='?p=$page&act=$act&id=".md5($fpk_kode)."';</script>";

  }

}

if(isset($_POST['bmengetahui'])){
 
   $fpk_id=$fpk_data_id['fpk_id'];
   $fpk_kode=$fpk_data_id['fpk_kd'];
   $pecah1= explode("||",$fpk_data_id['fpk_konfirm']);	  
   $hitung= count($pecah1);
   for($j=0;$j<$hitung;$j++){		  
      $pecah2= explode(";",$pecah1[$j]);		  
      $idkonfirm= $pecah2[0];		  
      $stskonfirm= $pecah2[1];		  
      
      if($j > 0){
	$fpk_konfirm .= '||';
      }
      if($idkonfirm == $kar_id){
	$sts_y='Y';
      }else{
	$sts_y=$stskonfirm;
      }
      $fpk_konfirm .= $idkonfirm . ';' . $sts_y;
   }

   $fpk_update_konfirm=$mts->mts_update_konfirm($fpk_id,$fpk_konfirm);
   
   if($fpk_update_konfirm){
     echo"<script>document.location='?p=$page&act=$act&id=".md5($fpk_kode)."';</script>";
   }else{
     echo"<script>alert('Insert Failed');document.location='?p=$page&act=$act&id=".md5($fpk_kode)."';</script>";
   }
  
}

if(isset($_POST['bapproved'])){
   $xjenis      =$fpk_data_id['fpk_jenis']; 
   $fpk_priode  =$fpk_data_id['fpk_priode'];  
   $fpk_id=$fpk_data_id['fpk_id'];
   $fpk_kode=$fpk_data_id['fpk_kd'];
   $fpk_approvel=$fpk_data_id['fpk_mengetahui'];
   $fpk_penilai_=$fpk_data_id['fpk_penilai'];
   $fpk_sts="Z"; //status X,Y,Z  X=Proses. Y=Lock. Z=Approved
   $fpk_approval_1="Y"; 
 
   $sql = " UPDATE mts_master SET fpk_approval_1='$fpk_approval_1',fpk_sts='$fpk_sts' WHERE fpk_id='$fpk_id' ";
   $fpk_update_sts=mysql_query($sql) or die (mysql_error());
  

  if($fpk_update_sts){
    //Notify

    $ntf_act="Approval ".$xjenis." Karyawan - ".$fpk_priode;
    //ISI NOTIF = idFPK, Keterangan, Penilai, Mengetahui, Karyawan yg dinilai, kode, Sesi
    $ntf_isi=$fpk_id.'*%#'.$fpk_sts.'*%#'.$fpk_approvel.'*%#'.$fpk_kode.'*%#'.$fpk_penilai_;
    $ntf_ip=$ip_jaringan;
    $ntf_tgl=$date;
    $ntf_jam=$time;
    $ntf_insert=$ntf->ntf_insert($ntf_act,$ntf_isi,$ntf_ip,$ntf_tgl,$ntf_jam,$kar_id);

    //End Notify
    
    ////////////////////////////////////////
    
    $div_id_=5;
    $kar_tampil_div=$kar->kar_tampil_div($div_id_);
    if($kar_tampil_div){
		foreach($kar_tampil_div as $data){
			$tujuan[]=$data['kar_id'];
		}
    }
    
    $tujuan_count=count($tujuan);
   
    ////////////////////////////////////////

    //Notify DATA

    $ntf_data_act="Approval ".$xjenis." Karyawan - ".$fpk_priode; //ACT Disesuaikan

    $ntf_data_isi=$kar_data_['kar_nm']; //ISI Disesuaikan

    $ntf_data_url="?p=form_mutasi&act=open&id=".md5($fpk_kode); //URL Disesuaikan

    $ntf_data_sumber="SYSTEM"; //Auto Sumber = SYSTEM

    $ntf_data_ip=$ip_jaringan;

    $ntf_data_tgl=$date;

    $ntf_data_jam=$time;
    
    for($i=0; $i<$tujuan_count; $i++){
                    
        $ntf_data_tujuan=$tujuan[$i]; //Semua Tujuan = ALL
	$ntf_data_insert=$ntf->ntf_data_insert($ntf_data_act,$ntf_data_isi,$ntf_data_url,$ntf_data_ip,$ntf_data_tgl,$ntf_data_jam,$ntf_data_tujuan,$ntf_data_sumber);
	
    }
    
    

    echo"<script>document.location='?p=$page&act=$act&id=".md5($fpk_kode)."';</script>";

  }else{

    echo"<script>alert('Insert Failed');document.location='?p=$page&act=$act&id=".md5($fpk_kode)."';</script>";

  }

}

if(isset($_POST['bapproved2'])){
   $xjenis      =$fpk_data_id['fpk_jenis']; 
   $fpk_priode  =$fpk_data_id['fpk_priode'];   
   $fpk_id=$fpk_data_id['fpk_id'];
   $fpk_kode=$fpk_data_id['fpk_kd'];
   $fpk_approvel=$fpk_data_id['fpk_mengetahui'];
   $fpk_penilai_=$fpk_data_id['fpk_penilai'];
   $fpk_sts="Y"; //status X,Y,Z  X=Proses. Y=Lock. Z=Approved
   
   $fpk_approval_2 = "Y";

   //$tgl_berlaku = date('Y-m-d');
   //$tgl_berlaku = $fpk_tgl;
   //$fpk_update_sts=$mts->mts_update_sts($fpk_id,$fpk_ditetapkan,$fpk_sts);
   $sql = " UPDATE mts_master 
   			SET  fpk_approval_2='$fpk_approval_2',fpk_berlaku='$fpk_berlaku',fpk_sts='$fpk_sts' 
			WHERE fpk_id='$fpk_id'
		  ";
   $fpk_update_sts=mysql_query($sql) or die (mysql_error());
  

  if($fpk_update_sts){
    //Notify
    $ntf_act="Hasil ".$xjenis." Karyawan - ".$fpk_priode;
    //ISI NOTIF = idFPK, Keterangan, Mengetahui2, Mengetahui, Karyawan yg dinilai, kode, Sesi
    $ntf_isi=$fpk_id.'*%#'.$fpk_keterangan.'*%#'.$fpk_mengetahui2.'*%#'.$fpk_mengetahui.'*%#'.$kar_id_.'*%#'.$fpk_kd.'*%#'.$fpk_sesi;
    $ntf_ip=$ip_jaringan;
    $ntf_tgl=$date;
    $ntf_jam=$time;
    $ntf_insert=$ntf->ntf_insert($ntf_act,$ntf_isi,$ntf_ip,$ntf_tgl,$ntf_jam,$kar_id);
    //End Notify
    
    //Notify DATA

    $ntf_data_act="Hasil ".$xjenis." Karyawan - ".$fpk_priode; //ACT Disesuaikan
    $ntf_data_isi=$kar_data_['kar_nm']; //ISI Disesuaikan
    $ntf_data_url="?p=hasil_mutasi&act=open&id=".md5($fpk_kode); //URL Disesuaikan
    $ntf_data_tujuan=$fpk_approvel; //Semua Tujuan = ALL
    $ntf_data_sumber=$kar_id; //Auto Sumber = SYSTEM
    $ntf_data_ip=$ip_jaringan;
    $ntf_data_tgl=$date;
    $ntf_data_jam=$time;
    $ntf_data_insert=$ntf->ntf_data_insert($ntf_data_act,$ntf_data_isi,$ntf_data_url,$ntf_data_ip,$ntf_data_tgl,$ntf_data_jam,$ntf_data_tujuan,$ntf_data_sumber);

    //End Notify DATA
    

    echo"<script>document.location='?p=$page&act=$act&id=".md5($fpk_kode)."';</script>";

  }else{

    echo"<script>alert('Insert Failed');document.location='?p=$page&act=$act&id=".md5($fpk_kode)."';</script>";

  }

}

if(isset($_POST['bditolak'])){
   $xjenis      =$fpk_data_id['fpk_jenis']; 
   $fpk_priode  =$fpk_data_id['fpk_priode'];   
   $fpk_id=$fpk_data_id['fpk_id'];
   $fpk_kode=$fpk_data_id['fpk_kd'];
   $fpk_approvel=$fpk_data_id['fpk_mengetahui'];
   $fpk_penilai_=$fpk_data_id['fpk_penilai'];
   $fpk_sts="T"; //status N,X,Y,Z  T=Tolak X=Proses Y=Lock Z=Approved
   $fpk_approval_2 = "Y";
   $sql = " UPDATE mts_master 
   			SET  
			fpk_approval_2='$fpk_approval_2',fpk_berlaku='$fpk_berlaku',
			fpk_sts='$fpk_sts',fpk_alasan_ditolak = '$fpk_alasan_ditolak' 
			WHERE fpk_id='$fpk_id'
		  ";
    $fpk_update_sts=mysql_query($sql) or die (mysql_error());

    echo"<script>alert('Form Pengajuan dibatalkan !...');document.location='?p=$page&act=$act&id=".md5($fpk_kode)."';</script>";


}

if(isset($_POST['bkonfirm'])){
   $xjenis      =$fpk_data_id['fpk_jenis'];   
   $fpk_priode  =$fpk_data_id['fpk_priode'];     
   $fpk_id=$fpk_data_id['fpk_id'];
   $fpk_kode=$fpk_data_id['fpk_kd'];
   
   $fpk_arry=$_POST['fpk_konfirm'];

   $jml_arry = count($fpk_arry);
   $data_kfm = '';
   for ($i=0; $i < $jml_arry; $i++)
   {
      $fpk_konfirm=$_POST['fpk_konfirm'][$i];
      
      if ($i > 0) {
	$data_kfm .= '||';
      }
      $data_kfm .= $fpk_konfirm . ';' . 'N';
      
      
      //Notify DATA
      $ntf_data_act="Konfirm ".$xjenis." Karyawan - ".$fpk_priode; //ACT Disesuaikan
  
      $ntf_data_isi=$kar_data_['kar_nm']; //ISI Disesuaikan
  
      $ntf_data_url="?p=konfirm_mutasi&act=open&id=".md5($fpk_kode); //URL Disesuaikan
  
      $ntf_data_tujuan=$fpk_konfirm; //Semua Tujuan = ALL
  
      $ntf_data_sumber=$kar_id; //Auto Sumber = SYSTEM
  
      $ntf_data_ip=$ip_jaringan;
  
      $ntf_data_tgl=$date;
  
      $ntf_data_jam=$time;
  
      $ntf_data_insert=$ntf->ntf_data_insert($ntf_data_act,$ntf_data_isi,$ntf_data_url,$ntf_data_ip,$ntf_data_tgl,$ntf_data_jam,$ntf_data_tujuan,$ntf_data_sumber);
      //End Notify DATA
      
   }
   
   $fpk_update_konfirm=$mts->mts_update_konfirm($fpk_id,$data_kfm);
   
   if($fpk_update_konfirm){
     echo"<script>document.location='?p=$page&act=$act&id=".md5($fpk_kode)."';</script>";
   }else{
      echo"<script>alert('Insert Failed');document.location='?p=$page&act=$act&id=".md5($fpk_kode)."';</script>";
   }
   
}


/////////////////////////////////////////////////////////////

if(isset($page)&&($kar_id_)&&($act=="hapus_fpk")){

	$fpk_id_=$_GET['no'];

	$fpk_delete=$mts->mts_delete($fpk_id_);

	echo"<script>document.location='?p=$page&id=$kar_id_';</script>";			

}



$pecah__=explode(" ",$tgl->tgl_indo($date));

$thn__=$pecah__[2];

$bln__=$pecah__[1];

$tgl__=$pecah__[0];

$kar_tampil=$kar->kar_tampil_filter_2(); 




if($print=="prt") {

  $fpk_id__= $_GET['id'];
  $fpk_tampil_id=$mts->mts_tampil_id($fpk_id__);
  
  $fpk_data_id=mysql_fetch_array($fpk_tampil_id);
  $fpk_cek_id=mysql_num_rows($fpk_tampil_id);
  
  
 

  $kar_id__=$fpk_data_id['kar_id'];
  $kar_tampil_id__=$kar->kar_tampil_id($kar_id__);

  $kar_id__=$fpk_data_id['kar_id'];
  $kar_tampil_id__=$kar->kar_tampil_id($kar_id__);
  
  $kar_data__=mysql_fetch_array($kar_tampil_id__);
  
  //echo $kar_data__['kar_nm'];
 

}


if ($pdf=="pdf") {

  $fpk_id__=$_GET['id'];

  $fpk_tampil_id=$mts->mts_tampil_id($fpk_id__);

  $fpk_data_id=mysql_fetch_array($fpk_tampil_id);

  $fpk_cek_id=mysql_num_rows($fpk_tampil_id);

  $kar_id__=$fpk_data_id['kar_id'];

  $kar_tampil_id__=$kar->kar_tampil_id($kar_id__);

  $kar_data__=mysql_fetch_array($kar_tampil_id__);
  
}

?>