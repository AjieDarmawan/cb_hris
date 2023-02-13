<?php 

error_reporting(E_ALL ^ E_NOTICE);
date_default_timezone_set('Asia/Jakarta');
/*
$useragent=$_SERVER['HTTP_USER_AGENT'];

$inihp = preg_match('/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows (ce|phone)|xda|xiino/i',$useragent)||preg_match('/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i',substr($useragent,0,4));
*/


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

// echo "<pre>";
// print_r($kar_data);

// die;

if($kar_id != 36 && $kar_id != 56 && $kar_id != '255' && $kar_id != '551' && $kar_id != '542' && $kar_id != '447' && $kar_id != '248' && $kar_id != '499' && $kar_id != '459'){
// $useragent=$_SERVER['HTTP_USER_AGENT'];
// if(preg_match('/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows (ce|phone)|xda|xiino/i',$useragent)||preg_match('/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i',substr($useragent,0,4)))
// {
	// header('Location: https://edunitas.com');
	// exit;
// }
}
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



/*
if(preg_match('/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows (ce|phone)|xda|xiino/i',$useragent)||preg_match('/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i',substr($useragent,0,4)))
{
  if($exp_data[$date_int] !== "WFH"  ){
    header('Location: http://kpt.co.id');
    exit;
  }
}
*/
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
			include"module/dashboard/dashboard.php";
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
	$('#types_informasi').change(function(){
		if($('#types_informasi').val() === 'Mengundurkan Diri'){ 

			$('#mengundurkandiri').show();  

			document.getElementById("mengundurkandiri").placeholder = "Alasan Mengundurkan Diri";

		}else{   

		  $('#mengundurkandiri').hide(); 

		}
	});
</script>
<?php
if(($kar_id != '255') && ($kar_id != '551') && ($kar_id != '542') && ($kar_id != '447') && ($kar_id != '248') && ($kar_id != '499') && ($kar_id != '459') && ($kar_id != '36') && ($kar_id != '56')){
?>
<script>
	if (screen.width <= 699) {
		// alert("HP ni yaaaa...");
		// header('Location: https://edunitas.com');
		
		// window.alert('Wajib PC Ya');
		// window.location.href='https://edunitas.com';
	} 
</script>
<?php }?>
<!-- Optionally, you can add Slimscroll and FastClick plugins.
          Both of these plugins are recommended to enhance the
          user experience. Slimscroll is required when using the
          fixed layout. -->
</body>
</html>
<?php
}else{
	header('location:index.php');
}
?>