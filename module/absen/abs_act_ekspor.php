<?php
error_reporting(E_ALL ^ E_NOTICE);
require('../../class.php');
require('../../object.php');
session_start();

$db->koneksi();

if($_POST['p']) { $page=$_POST['p']; } else { $page=$_GET['p']; }
if($_POST['act']) { $act=$_POST['act']; } else { $act=$_GET['act']; }


//////////////////////////////////////////////////////////////////////////////
$sesidate = $_SESSION['bulan']."-01";
$akhirbulan = date("Y-m-t", strtotime($sesidate));

$tgl_1 = $sesidate;
$tgl_31= $akhirbulan;
			
$abs_tgl_rpt_bln_array=$abs->abs_tgl_rpt_bln_array($tgl_1,$tgl_31);
while($abs_data_rpt_bln_array=mysql_fetch_assoc($abs_tgl_rpt_bln_array)){
       $reportabsen[$abs_data_rpt_bln_array['kar_id']]=array("abs_cek_rpt_bln_array"=>$abs_data_rpt_bln_array['num_rows']);              
}

                        
$abs_tgl_rpt_point_array=$abs->abs_tgl_rpt_point_array($tgl_1,$tgl_31);
while($abs_cek_point_array=mysql_fetch_assoc($abs_tgl_rpt_point_array)){
       $pointabsen[$abs_cek_point_array['kar_id']]=array("abs_total_point_array"=>$abs_cek_point_array['point']);  
}


//////////////////////////////////////////////////////////////////////////////



if($page=='report_absen' AND $act=='ekspor_point' OR $act=='ekspor_detail' OR $act=='ekspor_reward'){
    
    $exact=explode('_',$act);
    $actname=strtoupper($exact[1]);
    
    $i=1;
    if(!empty($_SESSION['bulan']) || !empty($_SESSION['divisi'])){
                
      $sesdivisi=$_SESSION['divisi'];
      			
        $kar_tampil_div=$kar->kar_tampil_div($sesdivisi);

        foreach ($kar_tampil_div as $data) {

            $abs_cek_rpt_bln=$reportabsen[$data['kar_id']]["abs_cek_rpt_bln_array"]?$reportabsen[$data['kar_id']]["abs_cek_rpt_bln_array"]:'0';
	    $abs_total_point=$pointabsen[$data['kar_id']]["abs_total_point_array"];
            
            $arr["kar_id"][$i]=$data['kar_id'];
            $arr["kar_nik"][$i]=$data['kar_nik'];
            $arr["kar_nm"][$i]=$data['kar_nm'];
            $arr["div_nm"][$i]=$data['div_nm'];
            $arr["hadir"][$i]=$abs_cek_rpt_bln;
            $arr["point"][$i]=$abs_total_point ? $abs_total_point: '0';
	    
	    //////////////////////////////////////////////////////////////////////////
	    
	    $idnya=$data['kar_id'];
	    for(${'i'.$idnya}=$sesidate; ${'i'.$idnya}<=$akhirbulan; ${'i'.$idnya}++){
		$detrewardabsen[$idnya][${'i'.$idnya}]=array("kar_id"=>"",
							"abs_tgl_masuk"=>"",
							"abs_masuk"=>"",
							"abs_pulang"=>"",
							"abs_rwd_masuk"=>"",
							"abs_rwd_pulang"=>"");
	    }
	    
	    //////////////////////////////////////////////////////////////////////////
            
            $i++;
        }
        $jumdat=count($arr["kar_id"]);
        
        $abs_tgl_rpt=$abs->abs_tgl_rpt();
	while($abs_tgl_data=mysql_fetch_assoc($abs_tgl_rpt)){
            $arr["abs_tgl_id"][$i]=$abs_tgl_data['abs_tgl_id'];
            $arr["abs_tgl_nm"][$i]=$abs_tgl_data['abs_tgl_nm'];
        }
        $jumdat_tgl=count($arr["abs_tgl_id"]);
	
	///////////////////////////////////////////////////////////
	
	$abs_tampil_allkar_2=$abs->abs_tampil_allkar_2($sesdivisi,$sesidate,$akhirbulan);
	while($abs_data_allkar_2=mysql_fetch_assoc($abs_tampil_allkar_2)){
	       $detrewardabsen[$abs_data_allkar_2['kar_id']][$abs_data_allkar_2['abs_tgl_masuk']]=array("kar_id"=>$abs_data_allkar_2['kar_id'],
								"abs_tgl_masuk"=>$abs_data_allkar_2['abs_tgl_masuk'],
								"abs_masuk"=>$abs_data_allkar_2['abs_masuk'],
								"abs_pulang"=>$abs_data_allkar_2['abs_pulang'],
								"abs_rwd_masuk"=>$abs_data_allkar_2['abs_rwd_masuk'],
								"abs_rwd_pulang"=>$abs_data_allkar_2['abs_rwd_pulang']);              
	}
	
	///////////////////////////////////////////////////////////
        
        error_reporting(E_ALL);
        ini_set('display_errors', TRUE);
        ini_set('display_startup_errors', TRUE);
        define('EOL',(PHP_SAPI == 'cli') ? PHP_EOL : '<br />');
        date_default_timezone_set('Europe/London');
        require_once("../../plugins/phpexel/PHPExcel.php");
        include "abs_excel".$exact[1].".php";
        $date=date('Ymd');
        $namafile="REPORT_ABSEN_".$actname.$date.".xlsx";
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

}

?>