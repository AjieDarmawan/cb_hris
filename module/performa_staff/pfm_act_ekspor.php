<?php
error_reporting(E_ALL ^ E_NOTICE);
require('../../class.php');
require('../../object.php');
session_start();

$db->koneksi();

if ($_POST['p']) {
  $page = $_POST['p'];
} else {
  $page = $_GET['p'];
}
if ($_POST['act']) {
  $act = $_POST['act'];
} else {
  $act = $_GET['act'];
}


if ($page == 'performa_staff' and $act == 'ekspor') {


  $i = 1;
  if (!empty($_SESSION['priode1']) || !empty($_SESSION['priode2']) || !empty($_SESSION['pts']) || !empty($_SESSION['staff']) || !empty($_SESSION['wilayah'])) {

    $sespriode1 = $_SESSION['priode1'];
    $sespriode2 = $_SESSION['priode2'];
    $sespts = $_SESSION['pts'];
    $sesstaff = $_SESSION['staff'];
    $seswilayah = $_SESSION['wilayah'];

    $pfm_tampil = $pfm->pfm_tampil_filter($sespriode1, $sespriode2, $sespts, $sesstaff, $seswilayah);
  } else {
    $pfm_tampil = $pfm->pfm_tampil_all();
  }

  while ($data = mysql_fetch_assoc($pfm_tampil)) {


    $ktr_id_pfm = $data['pfm_unit'];
    $ktr_tampil_id_pfm = $ktr->ktr_tampil_id($ktr_id_pfm);
    $ktr_data_pfm = mysql_fetch_assoc($ktr_tampil_id_pfm);

    $kar_id_staff = $data['pfm_staff'];
    $kar_tampil_id_staff = $kar->kar_tampil_id($kar_id_staff);
    $kar_data_staff = mysql_fetch_assoc($kar_tampil_id_staff);

    $arr["pfm_id"][$i] = $data['pfm_id'];
    $arr["pfm_tgl"][$i] = $tgl->tgl_indo($data['pfm_tgl']);
    $arr["pfm_waktu"][$i] = $data['pfm_waktu'];
    $arr["pfm_pic"][$i] = $data['pfm_pic'];
    $arr["pfm_metode"][$i] = $data['pfm_metode'];
    $arr["pfm_unit"][$i] = $ktr_data_pfm['ktr_kd'];;
    $arr["pfm_staff"][$i] = $kar_data_staff['kar_nm'];
    $arr["pfm_topic_cat"][$i] = $data['pfm_topic_cat'];
    $arr["pfm_knowledge"][$i] = $data['pfm_knowledge'];
    $arr["pfm_knowledge_cat"][$i] = $data['pfm_knowledge_cat'];
    $arr["pfm_komunikasi"][$i] = $data['pfm_komunikasi'];
    $arr["pfm_komunikasi_cat"][$i] = $data['pfm_komunikasi_cat'];
    $arr["pfm_closing"][$i] = $data['pfm_closing'];
    $arr["pfm_closing_cat"][$i] = $data['pfm_closing_cat'];
    $arr["pfm_mempengaruhi"][$i] = $data['pfm_mempengaruhi'];
    $arr["pfm_mempengaruhi_cat"][$i] = $data['pfm_mempengaruhi_cat'];
    $arr["pfm_lain_cat"][$i] = $data['pfm_lain_cat'];
    $arr["pfm_arahan_cat"][$i] = $data['pfm_arahan_cat'];
    $arr["pfm_perkembangan"][$i] = $data['pfm_perkembangan'];
    $arr["pfm_pelatihan_cat"][$i] = $data['pfm_pelatihan_cat'];
    $arr["pfm_hrd"][$i] = $data['pfm_hrd'] == 'Y' ? 'Sudah' : 'Belum';


    $i++;
  }

  $jumdat = count($arr["pfm_id"]);


  error_reporting(E_ALL);
  ini_set('display_errors', TRUE);
  ini_set('display_startup_errors', TRUE);
  define('EOL', (PHP_SAPI == 'cli') ? PHP_EOL : '<br />');
  date_default_timezone_set('Europe/London');
  require_once("../../plugins/phpexel/PHPExcel.php");
  include "pfm_excel_export.php";
  $date = date('Ymd');
  $namafile = "REKAP_PERFORMA_STAFF_" . $date . ".xlsx";
  $loknam = "files/" . $namafile;
  $directory = "files/";
  if (glob($loknam) != false) {
    unlink($loknam);
  }

  echo $namafile;

  require_once("../../plugins/phpexel/PHPExcel/IOFactory.php");
  $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
  $objWriter->save(str_replace('.php', '.xlsx', $loknam));
}
