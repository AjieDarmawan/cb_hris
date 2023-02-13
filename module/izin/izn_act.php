<?php
session_start(); 
$page=$_GET['p'];
$act=$_GET['act'];
$print=$_GET['to'];
$pdf=$_GET['to'];
/*
if(isset($_POST['bfilter'])){
    if(!empty($_POST['f_divisi']) && !empty($_POST['f_type_kar'])){
        $_SESSION['f_divisi'] = $_POST['f_divisi'];
	$_SESSION['f_type_kar'] = $_POST['f_type_kar'];
    }else{
        $_SESSION['f_divisi'] = "";
	$_SESSION['f_type_kar'] = "";
	echo"<script>alert('Disabled Filter!');</script>";
    }
    echo"<script>document.location='?p=$page';</script>";
}

if(!empty($_SESSION['f_divisi']) && !empty($_SESSION['f_type_kar'])){
  $f_divisi = $_SESSION['f_divisi'];
  $f_type_kar = $_SESSION['f_type_kar'];
}else{
  $f_divisi = "";
  $f_type_kar = "";
}
*/
if(isset($_POST['bsortir_history'])){
	$_SESSION['tanggal_absen_history']=$_POST['tanggal_absen_history'];
}

if(!empty($_SESSION['tanggal_absen_history'])){
	$izn_kirim=$_SESSION['tanggal_absen_history'];
}else{
	$izn_kirim=$date;
}

if(isset($_POST['brefresh_history'])){
	$_SESSION['tanggal_absen_history']='';
	echo"<script>document.location='?p=$page';</script>";
}
if(isset($page)&&($act=="open")){
  
  $kpi_id_=$_GET['id'];
  $kpi_tampil_id=$izn->izn_tampil_kode($kpi_id_);
  $kpi_data_id=mysql_fetch_array($kpi_tampil_id);
  $kpi_cek_id=mysql_num_rows($kpi_tampil_id);

  //Update Read Notify
  $ntf_data_url=$kpi_id_;
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
  }

  $kar_id_=$kpi_data_id['kar_id'] ? $kpi_data_id['kar_id'] : $_GET['id'];  

}else{
  $kar_id_=$_GET['id'];
}

////////////////////////////////////////////////////////////////////////////////////////////

if(isset($_GET['p']) && isset($_GET['id'])){
  $_SESSION['kar_id_izn'] = $_GET['id'];
}

if(isset($_GET['p']) && !isset($_GET['id'])){
  $_SESSION['kar_id_izn'] = '';
}

////////////////////////////////////////////////////////////////////////////////////////////

$kar_tampil_id=$kar->kar_bio_kpi($kar_id_);
$kar_data_=mysql_fetch_array($kar_tampil_id);

//AUTO KPI
$pecah_nik=explode(".",$kar_data_['kar_nik']);
$kd_karyawan=$pecah_nik[1];	
$kd_awal="IZN";

if($kar_data_['kar_dtl_typ_krj'] == "Permanen"){
  $kd_akhir="-P";
}else{
  $kd_akhir="";
}

$kd_tahun = substr(date("Y"),2,4);
$izn_kd_awal = $izn->izn_kd_awal($kdawal);
$cek_kpi_kd  = mysql_num_rows($izn_kd_awal);
$data_kpi_kd  = mysql_fetch_array($izn_kd_awal);

$izn_kd_auto = $izn->izn_kd_auto();
$data_kd_auto  = mysql_fetch_array($izn_kd_auto);
$no_urut_auto = $data_kd_auto['max_kd_auto'];
$no_urut_auto++;
$new_kd = $kd_awal .$kd_karyawan. $kd_tahun .sprintf("%04s", $no_urut_auto) . $kd_akhir;

///////////////////////////////////////////////////////////////////////////////////////////

if(isset($_POST['bsave'])){
  
  $izn_div = $_POST['izn_div'];
  $izn_tanggal = $_POST['izn_tanggal'];
  $izn_waktu1 = $_POST['izn_waktu1'];
  $izn_waktu2 = $_POST['izn_waktu2'];
  //$izn_durasi = $_POST['izn_durasi'];
  $izn_jenis = $_POST['izn_jenis'];
  $izn_keterangan = $_POST['izn_keterangan'];
  $izn_atasan = $_POST['izn_atasan'];
  
  $awal  = strtotime($izn_waktu1);
  $akhir = strtotime($izn_waktu2);
  $diff  = $akhir - $awal;

  $jam   = floor($diff / (60 * 60));
  $menit = $diff - ( $jam * (60 * 60) );
  $detik = $diff % 60;

  $izn_durasi = $jam .  ' jam, ' . floor( $menit / 60 ) . ' menit, ' . $detik . ' detik';
  
  //echo"<pre>";
  //print_r($kpi_data1Arr);
  //echo"</pre>";
  
  //echo $dataText;
  $izn_sts = "X"; //status X,Y,Z,A  X=Proses. Y=Lock. Z=Lock. A=Approved
  $izn_sesi = $sesi;
  
  $filed1 = "izn_id,
             izn_div,
			 izn_kd,
			 izn_jenis,
			 izn_tanggal,
			 izn_durasi,
			 izn_keterangan,
			 izn_waktu1,
			 izn_waktu2,
			 izn_atasan,
			 izn_sts,
			 izn_sesi,
			 izn_kirim,
			 kar_id";
  
  $izn_insert=$izn->izn_insert($filed1,$izn_div,$new_kd,$izn_jenis,$izn_tanggal,$izn_durasi,$izn_keterangan,$izn_waktu1,$izn_waktu2,$izn_atasan,$izn_sts,$izn_sesi,$kar_id_);
  $kpi_id=mysql_insert_id();
  if($izn_insert){

    //Notify
    $ntf_act="Form Izin Meninggalkan Kantor";
    //ISI NOTIF = idFPK, Keterangan, Penilai, Mengetahui, Karyawan yg dinilai, kode, Sesi
    $ntf_isi=$kpi_id.'*%#'.$izn_keterangan.'*%#'.$izn_jenis.'*%#'.$izn_durasi.'*%#'.$kar_id_.'*%#'.$new_kd.'*%#'.$izn_sesi;
    $ntf_ip=$ip_jaringan;
    $ntf_tgl=$date;
    $ntf_jam=$time;
   //$ntf_insert=$ntf->ntf_insert($ntf_act,$ntf_isi,$ntf_ip,$ntf_tgl,$ntf_jam,$kar_id);
    //End Notify

    //Notify DATA
    //$ntf_data_act="FRM ".$ntf_priode." K".$ntf_kontrak[0]; //ACT Disesuaikan
    $ntf_data_act="Form Izin Meninggalkan Kantor"; //ACT Disesuaikan
    $ntf_data_isi=$kar_data_['kar_nm']; //ISI Disesuaikan
    $ntf_data_url="?p=berkas_izin&act=open&id=".md5($new_kd); //URL Disesuaikan
    $ntf_data_tujuan=$izn_atasan; //Semua Tujuan = ALL
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

///////////////////////////////////////////////////////////////////////////////////////////

if(isset($_POST['bsendupdate1'])){
  $kpi_sesi = $sesi;
  $kpi_tanggal = $_POST['kpi_tanggal'];
  $kpi_id = $kpi_data_id['kpi_id'];
  $kpi_kode = $kpi_data_id['kpi_kd'];
  $kpi_kontrak = $kpi_data_id['kpi_kontrak'];
  $kpi_priode = $kpi_data_id['kpi_priode'];
  $kpi_penilai1 = $kpi_data_id['kpi_penilai1'];
  $kpi_penilai2 = $kpi_data_id['kpi_penilai2'];
  $kpi_penilai3 = $kpi_data_id['kpi_penilai3'];
  
  if($kpi_kontrak == "0 (None)"){
    $kpi_keterangan = "Eva. Tetap";
  }else{
    $kpi_keterangan = "Eva. Kontrak ".$kpi_kontrak;
  }
  
  $data_namaArr = $_POST['data_nama'];
  $data_kdArr = $_POST['data_kd'];
  $date_rangeArr = $_POST['date_range'];
  $data_detail = $_POST['data_detail'];
  $kpi_data1Arr = $_POST['kpi_data1'];
  $kpi_data2Arr = $_POST['kpi_data2'];
 
  $countArr = count($data_kdArr);
  $dataText = "";
  $has1 = false;
  for($i=1;$i<=$countArr;$i++){
     if($has1){
       $dataText .= "||";
     }
     $dataText .= $data_namaArr[$i]."@%";
     $dataText .= $data_kdArr[$i]."@%";
     $dataText .= $date_rangeArr[$i]."@%";
     $dataText .= $data_detail[$i]."@%";
     $dataText .= $kpi_data1Arr[$i]."@%";
     $dataText .= $kpi_data2Arr[$i];
     
     $has1 = true;
  }
  
  /*echo"<pre>";
  print_r($kpi_data1Arr);
  echo"</pre>"; exit();*/
  
  //echo $dataText;
  
  $kpi_data = $dataText;
  $kpi_sts="Y"; //status X,Y,Z,A  X=Proses. Y=Lock. Z=Lock. A=Approved
  $kpi_update=$kpi->kpi_update($kpi_id,$kpi_tanggal,$kpi_data,$kpi_sts);

  if($kpi_update){

    //Notify
    $ntf_act="Penilaian Kerja Penilai 1";
    //ISI NOTIF = idFPK, Keterangan, Penilai, Mengetahui, Karyawan yg dinilai, kode, Sesi
    $ntf_isi=$kpi_id.'*%#'.$kpi_keterangan.'*%#'.$kpi_penilai1.'*%#'.$kpi_penilai2.'*%#'.$kar_id_.'*%#'.$kpi_kode.'*%#'.$kpi_sesi;
    $ntf_ip=$ip_jaringan;
    $ntf_tgl=$date;
    $ntf_jam=$time;
    $ntf_insert=$ntf->ntf_insert($ntf_act,$ntf_isi,$ntf_ip,$ntf_tgl,$ntf_jam,$kar_id);
    //End Notify
    

    //Notify DATA
    $ntf_data_act="Penilaian Kerja Penilai 1"; //ACT Disesuaikan
    $ntf_data_isi=$kar_data_['kar_nm']; //ISI Disesuaikan
    $ntf_data_url="?p=penilai2_kpi&act=open&id=".md5($kpi_kode); //URL Disesuaikan
    $ntf_data_tujuan=$izn_atasan; //Semua Tujuan = ALL
    $ntf_data_sumber=$kar_id; //Auto Sumber = SYSTEM
    $ntf_data_ip=$ip_jaringan;
    $ntf_data_tgl=$date;
    $ntf_data_jam=$time;
    $ntf_data_insert=$ntf->ntf_data_insert($ntf_data_act,$ntf_data_isi,$ntf_data_url,$ntf_data_ip,$ntf_data_tgl,$ntf_data_jam,$ntf_data_tujuan,$ntf_data_sumber);
    //End Notify DATA
    
    echo"<script>document.location='?p=$page&act=$act&id=".md5($kpi_kode)."';</script>";
  }else{
    echo"<script>alert('Insert Failed');document.location='?p=$page&act=$act&id=".md5($kpi_kode)."';</script>";
  }
}

///////////////////////////////////////////////////////////////////////////////////////////

if(isset($_POST['bsendupdate2'])){
  $kpi_sesi = $sesi;
  $kpi_tanggal = $_POST['kpi_tanggal'];
  $kpi_id = $kpi_data_id['kpi_id'];
  $kpi_kode = $kpi_data_id['kpi_kd'];
  $kpi_kontrak = $kpi_data_id['kpi_kontrak'];
  $kpi_priode = $kpi_data_id['kpi_priode'];
  $kpi_penilai1 = $kpi_data_id['kpi_penilai1'];
  $kpi_penilai2 = $kpi_data_id['kpi_penilai2'];
  $kpi_penilai3 = $kpi_data_id['kpi_penilai3'];
  
  if($kpi_kontrak == "0 (None)"){
    $kpi_keterangan = "Eva. Tetap";
  }else{
    $kpi_keterangan = "Eva. Kontrak ".$kpi_kontrak;
  }
  
  $data_namaArr = $_POST['data_nama'];
  $data_kdArr = $_POST['data_kd'];
  $date_rangeArr = $_POST['date_range'];
  $data_detail = $_POST['data_detail'];
  $kpi_data1Arr = $_POST['kpi_data1'];
  $kpi_data2Arr = $_POST['kpi_data2'];
 
  $countArr = count($data_kdArr);
  $dataText = "";
  $has1 = false;
  for($i=1;$i<=$countArr;$i++){
     if($has1){
       $dataText .= "||";
     }
     $dataText .= $data_namaArr[$i]."@%";
     $dataText .= $data_kdArr[$i]."@%";
     $dataText .= $date_rangeArr[$i]."@%";
     $dataText .= $data_detail[$i]."@%";
     $dataText .= $kpi_data1Arr[$i]."@%";
     $dataText .= $kpi_data2Arr[$i];
     
     $has1 = true;
  }
  
  /*echo"<pre>";
  print_r($kpi_data1Arr);
  echo"</pre>"; exit();*/
  
  //echo $dataText;
  
  $kpi_data = $dataText;
  
  $kpi_skor = $_POST['kpi_skor'];
   if($kpi_skor > 49.95){
      $kpi_sts_skor = "KONTRAK DIPERPANJANG";
   }else{
      $kpi_sts_skor = "KONTRAK TIDAK DIPERPANJANG";
   }
   
  $kpi_sts="Z"; //status X,Y,Z,A  X=Proses. Y=Lock. Z=Lock. A=Approved
  $kpi_update=$kpi->kpi_update_2($kpi_id,$kpi_tanggal,$kpi_data,$kpi_skor,$kpi_sts_skor,$kpi_sts);

  if($kpi_update){

    //Notify
    $ntf_act="Penilaian Kerja Penilai 2";
    //ISI NOTIF = idFPK, Keterangan, Penilai, Mengetahui, Karyawan yg dinilai, kode, Sesi
    $ntf_isi=$kpi_id.'*%#'.$kpi_keterangan.'*%#'.$kpi_penilai2.'*%#'.$kpi_penilai3.'*%#'.$kar_id_.'*%#'.$kpi_kode.'*%#'.$kpi_sesi;
    $ntf_ip=$ip_jaringan;
    $ntf_tgl=$date;
    $ntf_jam=$time;
    $ntf_insert=$ntf->ntf_insert($ntf_act,$ntf_isi,$ntf_ip,$ntf_tgl,$ntf_jam,$kar_id);
    //End Notify
    

    //Notify DATA
    $ntf_data_act="Penilaian Kerja Penilai 2"; //ACT Disesuaikan
    $ntf_data_isi=$kar_data_['kar_nm']; //ISI Disesuaikan
    $ntf_data_url="?p=penilai3_kpi&act=open&id=".md5($kpi_kode); //URL Disesuaikan
    $ntf_data_tujuan=$kpi_penilai3; //Semua Tujuan = ALL
    $ntf_data_sumber=$kar_id; //Auto Sumber = SYSTEM
    $ntf_data_ip=$ip_jaringan;
    $ntf_data_tgl=$date;
    $ntf_data_jam=$time;
    $ntf_data_insert=$ntf->ntf_data_insert($ntf_data_act,$ntf_data_isi,$ntf_data_url,$ntf_data_ip,$ntf_data_tgl,$ntf_data_jam,$ntf_data_tujuan,$ntf_data_sumber);
    //End Notify DATA
    
    echo"<script>document.location='?p=$page&act=$act&id=".md5($kpi_kode)."';</script>";
  }else{
    echo"<script>alert('Insert Failed');document.location='?p=$page&act=$act&id=".md5($kpi_kode)."';</script>";
  }
}

///////////////////////////////////////////////////////////////////////////////////////////

if(isset($_POST['baiyahh'])){
   
   $izn_id = $kpi_data_id['izn_id'];
   $izn_kd = $kpi_data_id['izn_kd'];
  
   $izn_sts="Y"; //status X,Y,Z,A  X=Proses. Y=Lock. Z=Lock. A=Approved
   $izn_update_sts=$izn->izn_update_sts($izn_id,$izn_sts);
   
   if($izn_update_sts){
    
    //Notify
    $ntf_act="Approval Izin Keluar Kantor";
    //ISI NOTIF = idFPK, Keterangan, Penilai, Mengetahui, Karyawan yg dinilai, kode, Sesi
    $ntf_isi=$izn_id.'*%#'.$izn_sts.'*%#'.$izn_kd;
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
    //$tujuan = array('248');
    $tujuan_count=count($tujuan);
    ////////////////////////////////////////

    
    //Notify DATA
    $ntf_data_act="Approval Izin Keluar Kantor"; //ACT Disesuaikan
    $ntf_data_isi=$kar_data_['kar_nm']; //ISI Disesuaikan
    $ntf_data_url="?p=berkas_izin&act=open&id=".md5($izn_kd); //URL Disesuaikan
    $ntf_data_sumber="SYSTEM"; //Auto Sumber = SYSTEM
    $ntf_data_ip=$ip_jaringan;
    $ntf_data_tgl=$date;
    $ntf_data_jam=$time;
    for($i=0; $i<$tujuan_count; $i++){      
        $ntf_data_tujuan=$tujuan[$i]; //Semua Tujuan = ALL
		$ntf_data_insert=$ntf->ntf_data_insert($ntf_data_act,$ntf_data_isi,$ntf_data_url,$ntf_data_ip,$ntf_data_tgl,$ntf_data_jam,$ntf_data_tujuan,$ntf_data_sumber);
    }

    echo"<script>document.location='?p=$page&act=$act&id=".md5($izn_kd)."';</script>";
  }else{
    echo"<script>alert('Insert Failed');document.location='?p=$page&act=$act&id=".md5($izn_kd)."';</script>";
  }
}


///////////////////////////////////////////////////////////////////////////////////////////

if(isset($_POST['notpproved'])){
   
   $izn_id = $kpi_data_id['izn_id'];
   $izn_kd = $kpi_data_id['izn_kd'];
  
   $izn_sts="T"; //status X,Y,Z,A  X=Proses. Y=Lock. Z=Lock. A=Approved
   $izn_update_sts=$izn->izn_update_sts($izn_id,$izn_sts);
   
   if($izn_update_sts){
    
    //Notify
    $ntf_act="Approval Izin Keluar Kantor";
    //ISI NOTIF = idFPK, Keterangan, Penilai, Mengetahui, Karyawan yg dinilai, kode, Sesi
    $ntf_isi=$izn_id.'*%#'.$izn_sts.'*%#'.$izn_kd;
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
    //$tujuan = array('248');
    $tujuan_count=count($tujuan);
    ////////////////////////////////////////

    
    //Notify DATA
    $ntf_data_act="Approval Izin Keluar Kantor"; //ACT Disesuaikan
    $ntf_data_isi=$kar_data_['kar_nm']; //ISI Disesuaikan
    $ntf_data_url="?p=berkas_izin&act=open&id=".md5($izn_kd); //URL Disesuaikan
    $ntf_data_sumber="SYSTEM"; //Auto Sumber = SYSTEM
    $ntf_data_ip=$ip_jaringan;
    $ntf_data_tgl=$date;
    $ntf_data_jam=$time;
    for($i=0; $i<$tujuan_count; $i++){      
        $ntf_data_tujuan=$tujuan[$i]; //Semua Tujuan = ALL
		$ntf_data_insert=$ntf->ntf_data_insert($ntf_data_act,$ntf_data_isi,$ntf_data_url,$ntf_data_ip,$ntf_data_tgl,$ntf_data_jam,$ntf_data_tujuan,$ntf_data_sumber);
    }

    echo"<script>document.location='?p=$page&act=$act&id=".md5($izn_kd)."';</script>";
  }else{
    echo"<script>alert('Insert Failed');document.location='?p=$page&act=$act&id=".md5($izn_kd)."';</script>";
  }
}

///////////////////////////////////////////////////////////////////////////////////////////


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

///////////////////////////////////////////////////////////////////////////////////////////


if(isset($_POST['bsimpan_kontrak'])){
   $pecah_tanggal=explode(" - ", $_POST['date_range']);
   $kph_start=$pecah_tanggal[0];
   $kph_end=$pecah_tanggal[1];
   
   //echo $kph_start."<br>".$kph_end;
  
   
    $dataMasa = array('3' => '2','6' => '4','12' => '10');  
    function dateDiffInMonths($date1, $date2) {
        $ts1 = strtotime($date1);
        $ts2 = strtotime($date2);
		
		
    
        $year1 = date('Y', $ts1);
        $year2 = date('Y', $ts2);
    
        $month1 = date('n', $ts1);
        $month2 = date('n', $ts2);
    
        return abs((($year2 - $year1) * 12) + ($month2 - $month1));
    }
	
    $count_month = dateDiffInMonths($kph_start, $kph_end);
    $loop_month = $dataMasa[$count_month] ? $dataMasa[$count_month] : 0;
    
    $dataArr = array();
    $dataText = '';
    $hasComma = false;
    for($i=1;$i<=$loop_month;$i++){
		
			$a = $i + 1;
			
			if($i == 1){				
				array_push($dataArr,date("Y-m-d",strtotime($kph_start." +".$a." month")));
			}else{
				array_push($dataArr,date("Y-m-d",strtotime($kph_start." +".$i." month")));           
			}
			//$dataArr[] = date("Y-m-d",strtotime($kph_start." +".$i." month"));
			
            //echo "<pre>";
			//print_r($dataArr);
			//echo "</pre>";		
			
            if ($hasComma){
                 $dataText .= ',';
            }
			
            if($i == 1){
				$dataText .= date("Y-m-d",strtotime($kph_start." +".$a." month"));
			}else{
				$dataText .= date("Y-m-d",strtotime($kph_start." +".$i." month"));			 
			}
			
            //$dataText .= date("Y-m-d",strtotime($kph_start." +".$i." month"));
            $hasComma=true;
    }
			//echo "<pre>";
			//print_r($dataText);
			//echo "</pre>";
			//exit;
   
   $kph_kontrak=$_POST['kph_kontrak'];
   if($kph_kontrak == 1){
      $kph_kode = "1 (Pertama)";
   }elseif($kph_kontrak == 2){
      $kph_kode = "2 (Kedua)";
   }elseif($kph_kontrak == 3){
      $kph_kode = "3 (Terakhir)";
   }else{
      $kph_kode = "0 (None)";
   }
   $kph_keterangan=$_POST['kph_keterangan'];
   $kph_masa=$loop_month;
   $kph_data=$dataText;
   $kpi_history_insert=$kpi->kpi_history_insert($kph_kontrak,$kph_kode,$kph_start,$kph_end,$kph_keterangan,$kph_masa,$kph_data,$kar_id_);
   if($kpi_history_insert){
    echo"<script>document.location='?p=$page&id=$kar_id_';</script>";
   }else{
    echo"<script>alert('Insert Failed');document.location='?p=$page&id=$kar_id_';</script>";
   }
}

if(isset($_POST['bedit_kontrak'])){
   $kph_id=$_POST['kph_id'];
   $pecah_tanggal=explode(" - ", $_POST['date_range']);
   $kph_start=$pecah_tanggal[0];
   $kph_end=$pecah_tanggal[1];
   
   $dataMasa = array('3' => '2','6' => '4','12' => '10');  
    function dateDiffInMonths($date1, $date2) {
        $ts1 = strtotime($date1);
        $ts2 = strtotime($date2);
    
        $year1 = date('Y', $ts1);
        $year2 = date('Y', $ts2);
    
        $month1 = date('n', $ts1);
        $month2 = date('n', $ts2);
    
        return abs((($year2 - $year1) * 12) + ($month2 - $month1));
    }
    
    $count_month = dateDiffInMonths($kph_start, $kph_end);
    $loop_month = $dataMasa[$count_month] ? $dataMasa[$count_month] : 0;
    
    $dataArr = array();
    $dataText = '';
    $hasComma = false;
    for($i=1;$i<=$loop_month;$i++){
			$a = $i + 1;
			if($i == 1){				
				array_push($dataArr,date("Y-m-d",strtotime($kph_start." +".$a." month")));
			}else{
				array_push($dataArr,date("Y-m-d",strtotime($kph_start." +".$i." month")));           
			}
            //$dataArr[] = date("Y-m-d",strtotime($kph_start." +".$i." month"));
            
            if ($hasComma){
                 $dataText .= ',';
            }
            if($i == 1){
				$dataText .= date("Y-m-d",strtotime($kph_start." +".$a." month"));
			}else{
				$dataText .= date("Y-m-d",strtotime($kph_start." +".$i." month"));			 
			}
            //$dataText .= date("Y-m-d",strtotime($kph_start." +".$i." month"));
            
            $hasComma=true;
    }
    
   $kph_kontrak=$_POST['kph_kontrak'];
   $kph_keterangan=$_POST['kph_keterangan'];
   $kph_masa=$loop_month;
   $kph_data=$dataText;
   
   $kpi_history_update=$kpi->kpi_history_update($kph_id,$kph_kontrak,$kph_start,$kph_end,$kph_keterangan,$kph_masa,$kph_data);
    if($kpi_history_update){
      echo"<script>document.location='?p=$page&id=$kar_id_';</script>";
    }else{
      echo"<script>alert('Insert Failed');document.location='?p=$page&id=$kar_id_';</script>";
    }
}

if(isset($page)&&($kar_id_)&&($act=="hapus_kph")){
  $kph_id_=$_GET['no'];
  $kph_delete=$kpi->kpi_history_delete($kph_id_);
  echo"<script>document.location='?p=$page&id=$kar_id_';</script>";     
}


///////////////////////////////////////////////////////////////////////////////////////////

if(isset($page)&&($kar_id_)&&($act=="hapus_kpi")){
	$kpi_id_=$_GET['no'];
	$kpi_delete=$kpi->kpi_delete($kpi_id_);
	echo"<script>document.location='?p=$page&id=$kar_id_';</script>";			
}

///////////////////////////////////////////////////////////////////////////////////////////

$pecah__=explode(" ",$tgl->tgl_indo($date));
$thn__=$pecah__[2];
$bln__=$pecah__[1];
$tgl__=$pecah__[0];
$kar_tampil=$kar->kar_tampil_kpi($f_divisi,$f_type_kar);

$f_level = array('4','3');
$team_penilai1 = $kar->kar_penilai_in_kpi($f_divisi,$f_level);
$team_penilai23 = $kar->kar_penilai_kpi(0,3);
$kar_typ_krj = array('Kontrak' => 'Kontrak', 'Kartap' => 'Tetap');


if($print=="prt") {
  $kpi_id__=$_GET['id'];
  $kpi_tampil_id=$izn->izn_tampil_kode($kpi_id__);
  $kpi_data_id=mysql_fetch_array($kpi_tampil_id);
  $kpi_cek_id=mysql_num_rows($kpi_tampil_id);
  $kar_id__=$kpi_data_id['kar_id'];
  $kar_tampil_id__=$kar->kar_bio_kpi($kar_id__);
  $kar_data__=mysql_fetch_array($kar_tampil_id__);
}

if($pdf=="pdf") {
  $kpi_id__=$_GET['id'];
  $kpi_tampil_id=$izn->izn_tampil_kode($kpi_id__);
  $kpi_data_id=mysql_fetch_array($kpi_tampil_id);
  $kpi_cek_id=mysql_num_rows($kpi_tampil_id);
  $kar_id__=$kpi_data_id['kar_id'];
  $kar_tampil_id__=$kar->kar_bio_kpi($kar_id__);
  $kar_data__=mysql_fetch_array($kar_tampil_id__);
}

?>