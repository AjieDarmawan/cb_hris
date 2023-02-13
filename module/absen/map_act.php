<?php
$page=$_GET['p'];
$act=$_GET['act'];
$kar_id_=$_GET['id'];
$chc_=$_GET['chc'];

/////////////////////////////////////////////////////////////////////////

if(isset($_POST['bsortir_checkpoint'])){
	$_SESSION['tanggal_absen_checkpoint']=$_POST['tanggal_absen_checkpoint'];
}

if(!empty($_SESSION['tanggal_absen_checkpoint'])){
	$chc_tgl_masuk=$_SESSION['tanggal_absen_checkpoint'];
}else{
	$chc_tgl_masuk=$date;
}

if(isset($_POST['brefresh_checkpoint'])){
	$_SESSION['tanggal_absen_checkpoint']='';
	echo"<script>document.location='?p=$page';</script>";
}

/////////////////////////////////////////////////////////////////////////

if(isset($page)&&($kar_id_)&&($chc_)){
	$chc_tampil_kar=$chc->chc_tampil_kar($chc_tgl_masuk,$kar_id_);
	$maps_data_id=mysql_fetch_array($chc_tampil_kar);
	
	$acc_tampil_kar=$acc->acc_tampil_kar($kar_id_);
	$acc_data_=mysql_fetch_array($acc_tampil_kar);
	
	if($chc_ == 1){
		$ll = $maps_data_id['checkpoint1'];
		$jamnya = $maps_data_id['jam'];
		$statusny = $maps_data_id['status1'];
		$radiusnya = $maps_data_id['radius'];
	}elseif($chc_ == 2){
		$ll = $maps_data_id['checkpoint2'];
		$jamnya = $maps_data_id['jam2'];
		$statusny = $maps_data_id['status2'];
		$radiusnya = $maps_data_id['radius2'];
	}elseif($chc_ == 3){
		$ll = $maps_data_id['checkpoint3'];
		$jamnya = $maps_data_id['jam3'];
		$statusny = $maps_data_id['status3'];
		$radiusnya = $maps_data_id['radius3'];
	}
	
	
	$API_KEY = "AIzaSyDcoUbTUBMZm42oPa2O2HE-iJCWSQtiwU8";
	
	
	$latlongcheck = $ll;
	$latlongnya = explode("#", $latlongcheck);
	
	if($radiusnya == 'DI DALAM RADIUS'){
		$text_color = "success";
	}else{
		$text_color = "danger";
	}
	
	if($latlongnya[5] != "WFH"  ){
		$imagekar = "/dist/img/Gilland_Ganesha.png";		
	}else{
		$imagekar = "/dist/img/home.png";
	}
	
	$adds_url  = "https://maps.googleapis.com/maps/api/geocode/json?latlng=".$latlongnya[2].",".$latlongnya[3]."&sensor=true&key=" . $API_KEY;
	$adds_json = file_get_contents($adds_url);
	$adds_json = json_decode($adds_json);
	
	$adds1_url  = "https://maps.googleapis.com/maps/api/geocode/json?latlng=".$latlongnya[0].",".$latlongnya[1]."&sensor=true&key=" . $API_KEY;
	$adds1_json = file_get_contents($adds1_url);
	$adds1_json = json_decode($adds1_json);
	
}
?>