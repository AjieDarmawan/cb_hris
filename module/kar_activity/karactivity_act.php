<?php
session_start(); 
$page=$_GET['p'];
$act=$_GET['act'];
$datenow = date('Y-m-d');

if($act == 'list') {
	
	$list_jam = array();
	// echo date('Y-m-d H:i:s');
	// exit;
	require('../../class.php');
	require('../../object.php');
	$db->koneksi();
	
	$my_activity = $karacv->karact_tampil_sum($_SESSION['kar'], true);
	
	$jam = 0;
	while($jam++ < 24) {
		
		$time = date('H:i',mktime($jam,0,0,1,1,2011));
		// $compare = date("H:i", strtotime(date('Y-m-d') . ' ' . $time . " +30 minutes")); // BUAT CEK
		// echo date('Y-m-d H:i:s');
		
		$tmp = array();
		$tmp['jam'] = $time;
		$tmp['class'] = 'btn-default';
		$tmp['laporan'] = "0";
		$tmp['disable'] = 'disabled';

		
		$compare_now = strtotime("+0 minutes");
		// $compare_start = strtotime(date('Y-m-d') . ' ' . $time . " -59 minutes");
		$compare_start = strtotime(date('Y-m-d') . ' ' . $time . " +0 minutes");
		// $compare_end = strtotime(date('Y-m-d') . ' ' . $time . " +10 minutes");
		$compare_end = strtotime(date('Y-m-d') . ' ' . $time . " +59 minutes");
		$tmp['disable'] = ($compare_now >= $compare_start && $compare_now <= $compare_end ) ? "" : "disabled";

		if(strlen($tmp['disable']) <= 0) {
			$tmp['class'] = 'btn-primary';
		}
		
		if($compare_now >= $compare_end && $tmp['laporan'] == "0") {
			$tmp['class'] = 'btn-danger';
			
			@reset($my_activity);
			if(isset($my_activity[$time])) {
				
				$tmp['class'] = 'btn-success';
			}
		}
		
		if(isset($my_activity[$time])) {
			$tmp['laporan'] = $my_activity[$time];
		}
		

		// $tmp['class'] = 'btn-primary'; // kalo udah ada submitnya jadi 1 tombol jadi biru ada icon ceklis tp g bisa di klik
		// $tmp['laporan'] = 1; // kalo udah ada submitnya jadi 1 tombol jadi biru ada icon ceklis tp g bisa di klik
		 
		$list_jam[] = $tmp;
	}
	
	usort($list_jam, function($a, $b) {
		return $a['jam'] - $b['jam'];
	});
	
	header('Content-Type: application/json; charset=utf-8');
	echo json_encode($list_jam);
	exit;
	
} 

/* SAVE */
elseif(isset($_POST['bsave'])) {
	$txt=$_POST['txt_monitor_karactivity_upload'];
	$jam=$_POST['jam_txt_monitor_karactivity_upload'];
	$start=date('Y-m-d') .' '. $jam . ':00';
	$end=date("Y-m-d H:i:s", strtotime($start . " +60 minutes"));
			
	$karact_size=$_FILES['monitor_karactivity_file']['size'];
	$karact_lok=str_replace(' ', '_', $_FILES['monitor_karactivity_file']['tmp_name']);
	$karact_file=str_replace(' ', '_', (date("YmdHis") . "-" . $kar_id .'_'. str_replace(":", "", $jam) . '_' . $_FILES['monitor_karactivity_file']['name']));

	if(!empty($karact_file)) {
		$errors     = array();
		$maxsize    = 550024;
		$acceptable = array('jpg', 'png', 'jpeg');

		if(($karact_size >= $maxsize) || ($karact_size == 0)) {
			$errors[] = 'File too large. File must be less than 1 megabytes. (' .$karact_size. ')' ;
		}
		
		if(!in_array($karact_extend, $acceptable) && !empty($karact_extend)) {
			$errors[] = 'Invalid file type. Only JPG, JPEG and PNG types are accepted.';
		}
		
		if(count($errors) === 0) {
			
			
			$karact_insert_file=$karacv->karact_insert($txt,$karact_file,$kar_data['kar_id'],$start,$end,date("Y-m-d H:i:s"), date("Y-m-d H:i:s"));
			if($karact_insert_file){
				// move_uploaded_file($karact_lok,"module/kar_activity/file/$karact_file");
				compressedImage($karact_lok,"module/kar_activity/file/$karact_file",60);
				echo"<script>document.location='?p=$page';</script>";
			}
		}else{
			foreach($errors as $error) {
				echo "<script>alert('$error');document.location='?p=$page';</script>";
			}
			die(); 
		}
	}else{
		$karact_insert_file=$karacv->karact_insert($txt,"",$kar_data['kar_id'],$start,$end,date("Y-m-d H:i:s"), date("Y-m-d H:i:s"));
		if($karact_insert){
			echo"<script>document.location='?p=$page';</script>";
		}
	}
}

function compressedImage($source, $path, $quality) {

		$info = getimagesize($source);

		if ($info['mime'] == 'image/jpeg') 
			$image = imagecreatefromjpeg($source);

		elseif ($info['mime'] == 'image/gif') 
			$image = imagecreatefromgif($source);

		elseif ($info['mime'] == 'image/png') 
			$image = imagecreatefrompng($source);

		imagejpeg($image, $path, $quality);

}
?>