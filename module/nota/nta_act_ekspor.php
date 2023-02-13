<?php
error_reporting(E_ALL ^ E_NOTICE);
require('../../class.php');
require('../../object.php');
session_start();

$db->koneksi();

if($_POST['p']) { $page=$_POST['p']; } else { $page=$_GET['p']; }
if($_POST['act']) { $act=$_POST['act']; } else { $act=$_GET['act']; }


if($page=='data_nota' AND $act=='ekspor'){
    
    
    $i=1;
    if(!empty($_SESSION['priode1']) || !empty($_SESSION['priode2']) || !empty($_SESSION['pts']) || !empty($_SESSION['program']) || !empty($_SESSION['wilayah'])){
                
      $sespriode1=$_SESSION['priode1'];
      $sespriode2=$_SESSION['priode2'];
      $sespts=$_SESSION['pts'];
      $sesprogram=$_SESSION['program'];
      $seswilayah=$_SESSION['wilayah'];
      
      $nta_tampil=$nta->nta_tampil_filter($sespriode1,$sespriode2,$sespts,$sesprogram,$seswilayah);
      
    }else{
      $nta_tampil=$nta->nta_tampil();
    }
    
    while($data=mysql_fetch_assoc($nta_tampil)){
        
        $ktr_id_nta= $data['nta_pts'];
        $ktr_tampil_id_nta=$ktr->ktr_tampil_id($ktr_id_nta);
        $ktr_data_nta=mysql_fetch_assoc($ktr_tampil_id_nta);
        
        $kar_id_validasi= $data['nta_validasi'];
        $kar_tampil_id_validasi=$kar->kar_tampil_id($kar_id_validasi);
        $kar_data_validasi=mysql_fetch_assoc($kar_tampil_id_validasi);

        $jumlah=$data['nta_daftar'] + $data['nta_spb'] + $data['nta_spp'];

        
        $arr["nta_id"][$i]=$data['nta_id'];
        $arr["nta_mhs"][$i]=$data['nta_mhs'];
        $arr["nta_angkatan"][$i]=$data['nta_angkatan'];
        $arr["nta_jurusan"][$i]=$data['nta_jurusan'];
        $arr["nta_nomor"][$i]=$data['nta_nomor'];
        $arr["nta_tgl"][$i]=$data['nta_tgl'];
        $arr["nta_daftar"][$i]=$data['nta_daftar'];
        $arr["nta_spb"][$i]=$data['nta_spb'];
        $arr["nta_spp"][$i]=$data['nta_spp'];
        $arr["nta_jumlah"][$i]= $jumlah;
        $arr["nta_wilayah"][$i]=$data['nta_wilayah'];
        $arr["nta_pts"][$i]=$ktr_data_nta['ktr_kd'];
        $arr["nta_program"][$i]=$data['nta_program'];
        $arr["nta_keterangan"][$i]=$data['nta_keterangan'];
        $arr["nta_validasi"][$i]=$kar_data_validasi['kar_nm'];
     
        
        $i++;
    }
    
    $jumdat=count($arr["nta_id"]);
    
    error_reporting(E_ALL);
    ini_set('display_errors', TRUE);
    ini_set('display_startup_errors', TRUE);
    define('EOL',(PHP_SAPI == 'cli') ? PHP_EOL : '<br />');
    date_default_timezone_set('Europe/London');
    require_once("../../plugins/phpexel/PHPExcel.php");
    include "nta_excel_export.php";
    $date=date('Ymd');
    $namafile="REKAP_NOTA_".$date.".xlsx";
    $loknam="files/".$namafile;
    $directory = "files/";
    if(glob($loknam) != false){
        unlink($loknam);
    }

    echo $namafile;
    
    require_once("../../plugins/phpexel/PHPExcel/IOFactory.php");
    $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
    $objWriter->save(str_replace('.php', '.xlsx',$loknam));
    

}
?>