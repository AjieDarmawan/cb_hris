<?php

session_start(); 

$page=$_GET['p'];

$act=$_GET['act'];

$print=$_GET['to'];

$pdf=$_GET['to'];

$nonaktif="disabled";

if(isset($page)&&($act=="open")){

  $fpk_id_=$_GET['id'];

  $fpk_tampil_id=$nla->fpk_tampil_id($fpk_id_);

  $fpk_data_id=mysql_fetch_array($fpk_tampil_id);

  $fpk_cek_id=mysql_num_rows($fpk_tampil_id);
  
  $fpk_konfirm_user=$nla->fpk_konfirm_user($fpk_id_,$kar_id);
  $fpk_cek_konfirm=mysql_num_rows($fpk_konfirm_user);

  $kar_id_=$fpk_data_id['kar_id'];

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
     $konfirm="disabled";
  }
  

  if($fpk_data_id['fpk_sts']=="Y"){

    $disabled="disabled";

  }else{

    $disabled="";

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

     //echo"<script>alert('$ntf_data_kd_data[ntf_data_read].$ntf_data_kd_data[ntf_data_id]');</script>";

  }//else{echo"<script>alert('gagal');</script>";}

    

    

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



//AUTO FPK

$pecah_nik=explode('.', $kar_data_['kar_nik']);

$kd_karyawan=$pecah_nik[1];	

$kd_awal="FPK";

$kd_tahun = substr(date("Y"),2,4);

$fpk_kd_awal = $nla->fpk_kd_awal($kdawal);

$cek_fpk_kd  = mysql_num_rows($fpk_kd_awal);

$data_fpk_kd  = mysql_fetch_array($fpk_kd_awal);



$max_fpk_kd = $data_fpk_kd['max_kd'];



$no_urut_kd = (int) substr($max_fpk_nik, 7, 4);

$no_urut_kd++;



$fpk_kd_auto = $nla->fpk_kd_auto();

$data_kd_auto  = mysql_fetch_array($fpk_kd_auto);

$no_urut_auto = $data_kd_auto['max_kd_auto'];

$no_urut_auto++;



$new_kd = $kd_awal .$kd_karyawan. $kd_tahun .sprintf("%04s", $no_urut_auto);



//VARIABLE

$fpk_kd=$new_kd;

if($_POST['fpk_priode'] == "Per Tahun"){

  $fpk_keterangan="Evaluasi Tetap";

}else{

  $fpk_keterangan="Evaluasi Kontrak";

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



if($_POST['fpk_priode'] == "Per Tahun"){

  $fpk_ditetapkan="";

}else{

  $fpk_ditetapkan=$_POST['fpk_ditetapkan'];

}



$fpk_sts="X"; //status X,Y,Z  X=Proses. Y=Lock. Z=Approved

$fpk_sesi=$sesi;







if(isset($_POST['bsave'])){

  $fpk_insert=$nla->fpk_insert($fpk_kd,$fpk_keterangan,$fpk_priode,$fpk_gaji,$fpk_tgl,$fpk_nilai1,$fpk_nilai2,$fpk_nilai3,$fpk_nilai4,$fpk_nilai5,$fpk_nilai6,$fpk_nilai7,$fpk_nilai8,$fpk_nilai9,$fpk_nilai10,$fpk_nilai11,$fpk_nilai12,$fpk_nilai13,$fpk_nilai14,$fpk_nilai15,$fpk_nilai16,$fpk_nilai17,$fpk_nilai18,$fpk_prestasi,$fpk_pelanggaran,$fpk_saranperbaikan,$fpk_penilai,$fpk_mengetahui,$fpk_ditetapkan,$fpk_sts,$fpk_sesi,$kar_id_);

  

  $fpk_id=mysql_insert_id();

  

  if($fpk_insert){

    

    //Notify

    $ntf_act="Form Penilaian Kerja";

    //ISI NOTIF = idFPK, Keterangan, Penilai, Mengetahui, Karyawan yg dinilai, kode, Sesi

    $ntf_isi=$fpk_id.'*%#'.$fpk_keterangan.'*%#'.$fpk_penilai.'*%#'.$fpk_mengetahui.'*%#'.$kar_id_.'*%#'.$fpk_kd.'*%#'.$fpk_sesi;

    $ntf_ip=$ip_jaringan;

    $ntf_tgl=$date;

    $ntf_jam=$time;

    $ntf_insert=$ntf->ntf_insert($ntf_act,$ntf_isi,$ntf_ip,$ntf_tgl,$ntf_jam,$kar_id);

    //End Notify

    

    

    //Notify DATA

    $ntf_data_act="Form Penilaian Kerja"; //ACT Disesuaikan

    $ntf_data_isi=$kar_data_['kar_nm']; //ISI Disesuaikan

    $ntf_data_url="?p=detail_penilaian&act=open&id=".md5($fpk_kd); //URL Disesuaikan

    $ntf_data_tujuan=$fpk_penilai; //Semua Tujuan = ALL

    $ntf_data_sumber=$kar_id; //Auto Sumber = SYSTEM

    $ntf_data_ip=$ip_jaringan;

    $ntf_data_tgl=$date;

    $ntf_data_jam=$time;

    $ntf_data_insert=$ntf->ntf_data_insert($ntf_data_act,$ntf_data_isi,$ntf_data_url,$ntf_data_ip,$ntf_data_tgl,$ntf_data_jam,$ntf_data_tujuan,$ntf_data_sumber);

    //End Notify DATA

    

    echo"<script>document.location='?p=$page&id=$kar_id_';</script>";

  }else{

    echo"<script>alert('Insert Failed');document.location='?p=$page&id=$kar_id_';</script>";

  }

}



if(isset($_POST['bupdate'])){

  $fpk_id=$fpk_data_id['fpk_id'];

  $fpk_kode=$fpk_data_id['fpk_kd'];

  $fpk_sts="X"; //status X,Y,Z  X=Proses. Y=Lock. Z=Approved

  

  $fpk_update=$nla->fpk_update($fpk_id,$fpk_tgl,$fpk_nilai1,$fpk_nilai2,$fpk_nilai3,$fpk_nilai4,$fpk_nilai5,$fpk_nilai6,$fpk_nilai7,$fpk_nilai8,$fpk_nilai9,$fpk_nilai10,$fpk_nilai11,$fpk_nilai12,$fpk_nilai13,$fpk_nilai14,$fpk_nilai15,$fpk_nilai16,$fpk_nilai17,$fpk_nilai18,$fpk_prestasi,$fpk_pelanggaran,$fpk_saranperbaikan,$fpk_ditetapkan,$fpk_sts);



  if($fpk_update){

    

    //Notify

    $ntf_act="Update Penilaian Kerja";

    //ISI NOTIF = idFPK, Keterangan, Penilai, Mengetahui, Karyawan yg dinilai, kode, Sesi

    $ntf_isi=$fpk_id.'*%#'.$fpk_ditetapkan.'*%#'.$fpk_prestasi.'*%#'.$fpk_pelanggaran.'*%#'.$fpk_saranperbaikan;

    $ntf_ip=$ip_jaringan;

    $ntf_tgl=$date;

    $ntf_jam=$time;

    $ntf_insert=$ntf->ntf_insert($ntf_act,$ntf_isi,$ntf_ip,$ntf_tgl,$ntf_jam,$kar_id);

    //End Notify

    

    

    echo"<script>document.location='?p=$page&act=$act&id=".md5($fpk_kode)."';</script>";

  }else{

    echo"<script>alert('Insert Failed');document.location='?p=$page&act=$act&id=".md5($fpk_kode)."';</script>";

  }

}





if(isset($_POST['bsendupdate'])){

   $fpk_id=$fpk_data_id['fpk_id'];

   $fpk_kode=$fpk_data_id['fpk_kd'];

   $fpk_approvel=$fpk_data_id['fpk_mengetahui'];

   $fpk_sts="Y"; //status X,Y,Z  X=Proses. Y=Lock. Z=Approved

   

  $fpk_update=$nla->fpk_update($fpk_id,$fpk_tgl,$fpk_nilai1,$fpk_nilai2,$fpk_nilai3,$fpk_nilai4,$fpk_nilai5,$fpk_nilai6,$fpk_nilai7,$fpk_nilai8,$fpk_nilai9,$fpk_nilai10,$fpk_nilai11,$fpk_nilai12,$fpk_nilai13,$fpk_nilai14,$fpk_nilai15,$fpk_nilai16,$fpk_nilai17,$fpk_nilai18,$fpk_prestasi,$fpk_pelanggaran,$fpk_saranperbaikan,$fpk_ditetapkan,$fpk_sts);

  

  if($fpk_update){

    

    //Notify

    $ntf_act="Hasil Penilaian Kerja";

    //ISI NOTIF = idFPK, Keterangan, Penilai, Mengetahui, Karyawan yg dinilai, kode, Sesi

    $ntf_isi=$fpk_id.'*%#'.$fpk_keterangan.'*%#'.$fpk_penilai.'*%#'.$fpk_mengetahui.'*%#'.$kar_id_.'*%#'.$fpk_kd.'*%#'.$fpk_sesi;

    $ntf_ip=$ip_jaringan;

    $ntf_tgl=$date;

    $ntf_jam=$time;

    $ntf_insert=$ntf->ntf_insert($ntf_act,$ntf_isi,$ntf_ip,$ntf_tgl,$ntf_jam,$kar_id);

    //End Notify

    

    

    //Notify DATA

    $ntf_data_act="Hasil Penilaian Kerja"; //ACT Disesuaikan

    $ntf_data_isi=$kar_data_['kar_nm']; //ISI Disesuaikan

    $ntf_data_url="?p=hasil_penilaian&act=open&id=".md5($fpk_kode); //URL Disesuaikan

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

   $fpk_update_konfirm=$nla->fpk_update_konfirm($fpk_id,$fpk_konfirm);
   
   if($fpk_update_konfirm){
    echo"<script>document.location='?p=$page&act=$act&id=".md5($fpk_kode)."';</script>";
   }else{
    echo"<script>alert('Insert Failed');document.location='?p=$page&act=$act&id=".md5($fpk_kode)."';</script>";
   }
  
}

if(isset($_POST['bapproved'])){

   $fpk_id=$fpk_data_id['fpk_id'];

   $fpk_kode=$fpk_data_id['fpk_kd'];

   $fpk_approvel=$fpk_data_id['fpk_mengetahui'];

   $fpk_penilai_=$fpk_data_id['fpk_penilai'];

   $fpk_sts="Z"; //status X,Y,Z  X=Proses. Y=Lock. Z=Approved

   

  $fpk_update_sts=$nla->fpk_update_sts($fpk_id,$fpk_ditetapkan,$fpk_sts);

  

  if($fpk_update_sts){

    

    //Notify

    $ntf_act="Approval Penilaian Kerja";

    //ISI NOTIF = idFPK, Keterangan, Penilai, Mengetahui, Karyawan yg dinilai, kode, Sesi

    $ntf_isi=$fpk_id.'*%#'.$fpk_sts.'*%#'.$fpk_approvel.'*%#'.$fpk_kode.'*%#'.$fpk_penilai_;

    $ntf_ip=$ip_jaringan;

    $ntf_tgl=$date;

    $ntf_jam=$time;

    $ntf_insert=$ntf->ntf_insert($ntf_act,$ntf_isi,$ntf_ip,$ntf_tgl,$ntf_jam,$kar_id);

    //End Notify

    

    

    //Notify DATA

    //$ntf_data_act="Approval Penilaian Kerja"; //ACT Disesuaikan

    //$ntf_data_isi=$kar_data_['kar_nm']; //ISI Disesuaikan

    //$ntf_data_url="?p=lihat_notifikasi&act=open&id=".md5($fpk_kode); //URL Disesuaikan

    //$ntf_data_tujuan=$fpk_penilai_; //Semua Tujuan = ALL

    //$ntf_data_sumber=$kar_id; //Auto Sumber = SYSTEM

    //$ntf_data_ip=$ip_jaringan;

    //$ntf_data_tgl=$date;

    //$ntf_data_jam=$time;

    //$ntf_data_insert=$ntf->ntf_data_insert($ntf_data_act,$ntf_data_isi,$ntf_data_url,$ntf_data_ip,$ntf_data_tgl,$ntf_data_jam,$ntf_data_tujuan,$ntf_data_sumber);

    

    //$ntf_data_act="Form Penilaian Kerja"; //ACT Disesuaikan

    //$ntf_data_isi=$kar_data_['kar_nm']; //ISI Disesuaikan

    //$ntf_data_url="?p=lihat_penilaian&act=open&id=".md5($fpk_kode); //URL Disesuaikan

    //$ntf_data_tujuan=$kar_data_['kar_id']; //Semua Tujuan = ALL

    //$ntf_data_sumber="GILAND GANESHA SYSTEM"; //Auto Sumber = SYSTEM

    //$ntf_data_ip=$ip_jaringan;

    //$ntf_data_tgl=$date;

    //$ntf_data_jam=$time;

    //$ntf_data_insert=$ntf->ntf_data_insert($ntf_data_act,$ntf_data_isi,$ntf_data_url,$ntf_data_ip,$ntf_data_tgl,$ntf_data_jam,$ntf_data_tujuan,$ntf_data_sumber);

    //End Notify DATA

    

    echo"<script>document.location='?p=$page&act=$act&id=".md5($fpk_kode)."';</script>";

  }else{

    echo"<script>alert('Insert Failed');document.location='?p=$page&act=$act&id=".md5($fpk_kode)."';</script>";

  }

}

if(isset($_POST['bkonfirm'])){
  
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
      $ntf_data_act="Konfirm Penilaian Kerja"; //ACT Disesuaikan
  
      $ntf_data_isi=$kar_data_['kar_nm']; //ISI Disesuaikan
  
      $ntf_data_url="?p=konfirm_penilaian&act=open&id=".md5($fpk_kode); //URL Disesuaikan
  
      $ntf_data_tujuan=$fpk_konfirm; //Semua Tujuan = ALL
  
      $ntf_data_sumber=$kar_id; //Auto Sumber = SYSTEM
  
      $ntf_data_ip=$ip_jaringan;
  
      $ntf_data_tgl=$date;
  
      $ntf_data_jam=$time;
  
      $ntf_data_insert=$ntf->ntf_data_insert($ntf_data_act,$ntf_data_isi,$ntf_data_url,$ntf_data_ip,$ntf_data_tgl,$ntf_data_jam,$ntf_data_tujuan,$ntf_data_sumber);
      //End Notify DATA
      
   }
   
   $fpk_update_konfirm=$nla->fpk_update_konfirm($fpk_id,$data_kfm);
   
   if($fpk_update_konfirm){
     echo"<script>document.location='?p=$page&act=$act&id=".md5($fpk_kode)."';</script>";
   }else{
      echo"<script>alert('Insert Failed');document.location='?p=$page&act=$act&id=".md5($fpk_kode)."';</script>";
   }
   
}

if(isset($_POST['btambah'])){

   $rkm_nilai=$_POST['rkm_nilai'];

   $rkm_keterangan=$_POST['rkm_keterangan'];

   $rkm_pelapor=$_POST['rkm_pelapor'];

   $rkm_tgl=$_POST['rkm_tgl'];

   

   $rkm_insert=$nla->rkm_insert($rkm_nilai,$rkm_keterangan,$rkm_pelapor,$rkm_tgl,$kar_id_);

   

   if($rkm_insert){

    echo"<script>document.location='?p=$page&id=$kar_id_';</script>";

   }else{

    echo"<script>alert('Insert Failed');document.location='?p=$page&id=$kar_id_';</script>";

   }

  

}

if(isset($_POST['bedit_rekamjejak'])){

   $rkm_id=$_POST['rkm_id'];

   $rkm_nilai=$_POST['rkm_nilai'];

   $rkm_keterangan=$_POST['rkm_keterangan'];

   $rkm_pelapor=$_POST['rkm_pelapor'];

   $rkm_tgl=$_POST['rkm_tgl'];

  $rkm_update=$nla->rkm_update($rkm_id,$rkm_nilai,$rkm_keterangan,$rkm_pelapor,$rkm_tgl);

    if($rkm_update){

      echo"<script>document.location='?p=$page&id=$kar_id_';</script>";

    }else{

      echo"<script>alert('Insert Failed');document.location='?p=$page&id=$kar_id_';</script>";

    }

}

if(isset($page)&&($kar_id_)&&($act=="hapus_rkm")){

  $rkm_id_=$_GET['no'];

  $rkm_delete=$nla->rkm_delete($rkm_id_);

  echo"<script>document.location='?p=$page&id=$kar_id_';</script>";     

}

/////////////////////////////////////////////////////////////


/////////////////////////////////////////////////////////////



if(isset($_POST['bsimpan_kontrak'])){

   $pecah_tanggal=explode(" - ", $_POST['date_range']);

   $kkn_start=$pecah_tanggal[0];

   $kkn_end=$pecah_tanggal[1];

   $kkn_kontrak=$_POST['kkn_kontrak'];

   $kkn_keterangan=$_POST['kkn_keterangan'];
  

   $kkn_insert=$nla->kkn_insert($kkn_kontrak,$kkn_start,$kkn_end,$kkn_keterangan,$kar_id_);

   

   if($kkn_insert){

    echo"<script>document.location='?p=$page&id=$kar_id_';</script>";

   }else{

    echo"<script>alert('Insert Failed');document.location='?p=$page&id=$kar_id_';</script>";

   }

}

if(isset($_POST['bedit_kontrak'])){

   $kkn_id=$_POST['kkn_id'];

   $pecah_tanggal=explode(" - ", $_POST['date_range']);

   $kkn_start=$pecah_tanggal[0];

   $kkn_end=$pecah_tanggal[1];

   $kkn_kontrak=$_POST['kkn_kontrak'];

   $kkn_keterangan=$_POST['kkn_keterangan'];

  $kkn_update=$nla->kkn_update($kkn_id,$kkn_kontrak,$kkn_start,$kkn_end,$kkn_keterangan);
  if($kkn_update){
    echo"<script>document.location='?p=$page&id=$kar_id_';</script>";
  }else{
    echo"<script>alert('Insert Failed');document.location='?p=$page&id=$kar_id_';</script>";
  }
}

if(isset($page)&&($kar_id_)&&($act=="hapus_kkn")){

  $kkn_id_=$_GET['no'];

  $kkn_delete=$nla->kkn_delete($kkn_id_);

  echo"<script>document.location='?p=$page&id=$kar_id_';</script>";     

}

if(isset($page)&&($kar_id_)&&($act=="hapus_fpk")){

	$fpk_id_=$_GET['no'];

	$fpk_delete=$nla->fpk_delete($fpk_id_);

	echo"<script>document.location='?p=$page&id=$kar_id_';</script>";			

}



$pecah__=explode(" ",$tgl->tgl_indo($date));

$thn__=$pecah__[2];

$bln__=$pecah__[1];

$tgl__=$pecah__[0];

$kar_tampil=$kar->kar_tampil(); 




if($print="prt") {

  $fpk_id__=$_GET['id'];

  $fpk_tampil_id=$nla->fpk_tampil_id($fpk_id__);

  $fpk_data_id=mysql_fetch_array($fpk_tampil_id);

  $fpk_cek_id=mysql_num_rows($fpk_tampil_id);

  $kar_id__=$fpk_data_id['kar_id'];

  $kar_tampil_id=$kar->kar_tampil_id($kar_id__);

  $kar_data__=mysql_fetch_array($kar_tampil_id);


}

if ($pdf="pdf") {

  $fpk_id__=$_GET['id'];

  $fpk_tampil_id=$nla->fpk_tampil_id($fpk_id__);

  $fpk_data_id=mysql_fetch_array($fpk_tampil_id);

  $fpk_cek_id=mysql_num_rows($fpk_tampil_id);

  $kar_id__=$fpk_data_id['kar_id'];

  $kar_tampil_id=$kar->kar_tampil_id($kar_id__);

  $kar_data__=mysql_fetch_array($kar_tampil_id);
  
}

?>