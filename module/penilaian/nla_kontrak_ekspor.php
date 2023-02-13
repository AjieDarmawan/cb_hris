<?php
error_reporting(E_ALL ^ E_NOTICE);
require('../../class.php');
require('../../object.php');
session_start();

$db->koneksi();
$datenow = date('Y-m-d');

if($_POST['p']) { $page=$_POST['p']; } else { $page=$_GET['p']; }
if($_POST['act']) { $act=$_POST['act']; } else { $act=$_GET['act']; }

//////////////////////////////////////////////////////////////////////////////

$karArr = array();

$z=1;
$kar_tampil_kontrak=$kar->kar_tampil_kontrak();
while($kar_data_kontrak=mysql_fetch_assoc($kar_tampil_kontrak)){
       
       $kar_dtl_tgl_joi=$kar_data_kontrak['kar_dtl_tgl_joi'];
       $masa_kerja=$msa->hitung_masa_kerja($kar_dtl_tgl_joi, $datenow);
       $kar_dtl_msa_krj_=$masa_kerja['years']." Thn, ".$masa_kerja['months']. " Bln";
       
       $karArr[$z]=array('kar_id'=>$kar_data_kontrak['kar_id'],
		       'kar_nik'=>$kar_data_kontrak['kar_nik'],
		       'kar_nm'=>$kar_data_kontrak['kar_nm'],
		       'jbt_nm'=>$kar_data_kontrak['jbt_nm'],
		       'lvl_nm'=>$kar_data_kontrak['lvl_nm'],
		       'div_nm'=>$kar_data_kontrak['div_nm'],
		       'kar_dtl_typ_krj'=>$kar_data_kontrak['kar_dtl_typ_krj'],
		       'kar_dtl_tgl_joi'=>$kar_dtl_tgl_joi,
		       'kar_dtl_msa_krj'=>$kar_dtl_msa_krj_);
       $z++;
}

$kknArr = array();

foreach($karArr as $key => $value){
       
       $kar_id_ = $value['kar_id'];
       
       $s=1;
       $kkn_tampil_kar=$nla->kkn_tampil_kar_asc($kar_id_);
       while($kkn_data_kar=mysql_fetch_array($kkn_tampil_kar)){
	      
	      $kkn_start = $tgl->tgl_indo($kkn_data_kar['kkn_start']);
	      $kkn_end = $tgl->tgl_indo($kkn_data_kar['kkn_end']);
	      
	      $kknArr[$value['kar_id']][$s] = array('kkn_kontrak'=>$kkn_data_kar['kkn_kontrak'],
						  'kkn_start'=>$kkn_start,
						  'kkn_end'=>$kkn_end);
	      $s++;
       }
}

$Arr = array();

foreach($karArr as $key => $value){
       for($i=1; $i<=3; $i++){
	      if(!empty($kknArr[$value['kar_id']][$i])){
		     $Arr[$value['kar_id']][$i]=$kknArr[$value['kar_id']][$i];
	      }else{
		     $Arr[$value['kar_id']][$i]=array('kkn_kontrak'=>'',
						  'kkn_start'=>'',
						  'kkn_end'=>'');
	      }
       }
       
}


//////////////////////////////////////////////////////////////////////////////



if($page=='data_penilaian' AND $act=='export_kontrak'){
    
       $jumdat = count($karArr);
	
       ///////////////////////////////////////////////////////////
       
       error_reporting(E_ALL);
       ini_set('display_errors', TRUE);
       ini_set('display_startup_errors', TRUE);
       define('EOL',(PHP_SAPI == 'cli') ? PHP_EOL : '<br />');
       date_default_timezone_set('Europe/London');
       require_once("../../plugins/phpexel/PHPExcel.php");
       include "nla_excelkontrak.php";
       $date=date('Ymd');
       $namafile="DATA_KONTRAK_".$date.".xlsx";
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