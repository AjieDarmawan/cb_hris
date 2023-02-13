<?php 
error_reporting(E_ALL ^ E_NOTICE);
date_default_timezone_set('Asia/Jakarta');


session_start();

$sesi=session_id();

require('class.php');
require('object.php');

$db->koneksi();

$date=date('Y-m-d');

if(!empty($_SESSION['kar']) || !empty($_SESSION['kar_fl']) || !empty($_SESSION['kar_tst'])){

$kar_id=$_SESSION['kar'];
$kar_tampil_id=$kar->kar_tampil_id($kar_id);
$kar_data=mysql_fetch_array($kar_tampil_id);


$kar_tampil_acc=$kar->kar_tampil_acc($kar_id);
$kar_datacc=mysql_fetch_array($kar_tampil_acc);

$accnik  = $kar_datacc['kar_nik'];
$hasil = explode(".", $accnik); 
$nikhasil = $hasil[0].$hasil[1].$hasil[2];

/////////////////////////////////////////////////////////
$jdw_aktif_blnthn = $jdw->jdw_aktif_blnthn();
$jdw_aktif_data = mysql_fetch_assoc($jdw_aktif_blnthn);

$jdw_blnthn = $jdw_aktif_data['jda_blnthn'];

$bulannya = substr($jdw_blnthn, 0,2);
$tahunnya = substr($jdw_blnthn, -4);
$thnbln = $tahunnya."-".$bulannya;
 
$jdw_username = $kar_data['kar_nik'];
$jdw_tampil = $jdw->jdw_tampil_username($jdw_blnthn,$jdw_username);
$jdw_data = mysql_fetch_assoc($jdw_tampil);

$exp_data = explode('#',$jdw_data['jdw_data']);

$date_int = (int)date('d') - 1;



/////////////////////////////////////////////////////////

$kar_idfl=$_SESSION['kar_fl'];
$kar_tampil_id_fl=$fln->kar_tampil_id_fl($kar_idfl);
$kar_datafl=mysql_fetch_array($kar_tampil_id_fl);


$kar_idtst=$_SESSION['kar_tst'];
$kar_tampil_id_tst=$tst->kar_tampil_id_tst($kar_idtst);
$kar_datatst=mysql_fetch_array($kar_tampil_id_tst);

$jdw_usernamenya = $kar_datatst['kar_nik'];
$jdw_tampilny = $jdw->jdw_tampil_username_tst($jdw_blnthn,$jdw_usernamenya);
$jdw_datanya = mysql_fetch_assoc($jdw_tampilny);
$exp_datanya = explode('#',$jdw_datanya['jdw_data']);
$date_intnya = (int)date('d') - 1;

  if(!empty($kar_data['ktr_timezone'])){
    $ktr_timezone = $kar_data['ktr_timezone'];
    $time = date('H:i:s', strtotime("+$ktr_timezone minutes"));
  }else{
    $time = date('H:i:s');
  }    
}

$kemarin=date("Y-m-d",mktime(0, 0, 0, date("m"), date("d")-1, date("Y")));
$kemarinnya=date("w",mktime(0, 0, 0, date("m"), date("d")-2, date("Y")));
$kemarinnya_ymd=date("Y-m-d",mktime(0, 0, 0, date("m"), date("d")-2, date("Y")));
$limahrsebelumnya=date("w",mktime(0, 0, 0, date("m"), date("d")-4, date("Y")));
$limahrsebelumnya_ymd=date("Y-m-d",mktime(0, 0, 0, date("m"), date("d")-4, date("Y")));
$sepuluhhrsebelumnya=date("Y-m-d",mktime(0, 0, 0, date("m"), date("d")-8, date("Y")));

$ip_jaringan=$_SERVER['REMOTE_ADDR'];
$hostname =gethostname();//Tinggal dapetin ini aja yg susah

//$ip_jaringan_test = '203.29.27.137';

require('act.php');

if(!empty($_SESSION['kar']) || !empty($_SESSION['kar_fl']) || !empty($_SESSION['kar_tst'])){

$kar_id=$_SESSION['kar'];
$kar_tampil_id=$kar->kar_tampil_id($kar_id);
$kar_data=mysql_fetch_array($kar_tampil_id);

$acc_tampil_kar=$acc->acc_tampil_kar($kar_id);
$acc_data=mysql_fetch_array($acc_tampil_kar);

////////////////////////////////////////////////

$kar_idfl=$_SESSION['kar_fl'];
$kar_tampil_id_fl=$fln->kar_tampil_id_fl($kar_idfl);
$kar_datafl=mysql_fetch_array($kar_tampil_id_fl);

$acc_tampil_karfl=$afl->acc_tampil_karfl($kar_idfl);
$acc_datafl=mysql_fetch_array($acc_tampil_karfl);

////////////////////////////////////////////////

$kar_idtst=$_SESSION['kar_tst'];
$kar_tampil_id_tst=$tst->kar_tampil_id_tst($kar_idtst);
$kar_datatst=mysql_fetch_array($kar_tampil_id_tst);

$acc_tampil_kartst=$ats->acc_tampil_kartst($kar_idtst);
$acc_datatst=mysql_fetch_array($acc_tampil_kartst);

////////////////////////////////////////////////

if(!empty($_GET['p'])){
      if($_GET['p']=='data_reward_cs'){
	$title="Performance CS";
      }elseif($_GET['p']=='data_reward_alih_fungsi'){
	$title="Performance Alih Fungsi";
      }elseif($_GET['p']=='data_reward'){
	$title="Performance Unit";
      }elseif($_GET['p']=='data_reward_marketing_support'){
	$title="Performance Marketing Support";
      }elseif($_GET['p']=='new_reward'){
	$title="New Reward Unit";
      }elseif($_GET['p']=='new_reward_cs'){
	$title="New Reward CS";
      }elseif($_GET['p']=='data_karyawan_fl'){
	$title="Data Karyawan Magang";
      }elseif($_GET['p']=='detail_karyawan_fl'){
	$title="Detail Karyawan Magang";
      }else{
	$title=ucwords(str_replace("_"," ",$_GET['p']));
      }
}else{
	$title="Dashboard";
}

$kar_absen_masuk = $abs->abs_tampil_kar_location($kar_id, $date);
$kar_ada = mysql_num_rows($kar_absen_masuk);

?>
<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html>
<head>
<?php include('component/tag_head.php'); ?>
</head>
<!--
  BODY TAG OPTIONS:
  =================
  Apply one or more of the following classes to get the
  desired effect
  |---------------------------------------------------------|
  | SKINS         | skin-blue                               |
  |               | skin-black                              |
  |               | skin-purple                             |
  |               | skin-yellow                             |
  |               | skin-red                                |
  |               | skin-green                              |
  |---------------------------------------------------------|
  |LAYOUT OPTIONS | fixed                                   |
  |               | layout-boxed                            |
  |               | layout-top-nav                          |
  |               | sidebar-collapse                        |
  |               | sidebar-mini                            |
  |---------------------------------------------------------|
  -->
<?php
if(empty($acc_data['acc_sts'])){
  $collapse="";
}else{
  $collapse="sidebar-collapse";
}
?>  

<body class="skin-blue <?php echo $collapse;?>  sidebar-mini fixed">
<div class="wrapper"> 
  
  <!-- Main Header -->
  <?php include('component/top_bar.php'); ?>
  <!-- Left side column. contains the logo and sidebar -->
  <?php include('component/left_sidebar.php'); ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">

    <?php 

	if(!empty($_GET['p'])){
		include"open_file.php";
	}else{
		if(!empty($_SESSION['kar_fl'])){
			include"module/dashboard_fl/dashboard.php";
		}elseif(!empty($_SESSION['kar_tst'])){
			include"module/dashboard_tst/dashboard.php";
		}else{
			include"module/dashboard_x/dashboard.php";
		}
	}
	?>
  </div>
  <!-- /.content-wrapper --> 
  
  <!-- Main Footer -->
  <?php include('component/tag_footer.php'); ?>
  
  <!-- Control Sidebar -->
  <?php include('component/right_sidebar.php'); ?>
  
</div>
<!-- ./wrapper --> 

<!-- REQUIRED JS SCRIPTS --> 

<?php include('component/tag_js.php'); ?>
<script>
  $('#dr_publikasi').daterangepicker({
        format: 'DD/MM/YYYY',
        minDate: '01/01/2018',
        maxDate: new Date()
    });
</script>

</body>
</html>
<?php

}else{
	header('location:index.php');
}

?>