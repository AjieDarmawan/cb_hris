<?php
$page=$_GET['p'];
$act=$_GET['act'];
$id=$_GET['id'];

$nta_id=$_POST['nta_id'];
$nta_mhs=strtoupper($_POST['nta_mhs']);
$nta_angkatan=$_POST['nta_angkatan'];
$nta_jurusan=strtoupper($_POST['nta_jurusan']);
$nta_nomor=$_POST['nta_nomor'];
$nta_tgl=$_POST['nta_tgl'];
$nta_daftar=$_POST['nta_daftar'];
$nta_spb=$_POST['nta_spb'];
$nta_spp=$_POST['nta_spp'];
$nta_wilayah=$_POST['nta_wilayah'];
$nta_pts=$_POST['nta_pts'];
$nta_program=$_POST['nta_program'];
$nta_keterangan=$_POST['nta_keterangan'];

//Variable Filter
$priode=$_POST['priode'];
$pts=$_POST['pts'];
$program=$_POST['program'];
$wilayah=$_POST['wilayah'];


if(isset($_POST['binputnota'])){

	$nta_insert=$nta->nta_insert($nta_mhs,$nta_angkatan,$nta_jurusan,$nta_nomor,$nta_tgl,$nta_daftar,$nta_spb,$nta_spp,$nta_wilayah,$nta_pts,$nta_program,$nta_keterangan,$kar_id);

	if($nta_insert){

		echo"<script>document.location='?p=$page';</script>";
	}else{
		echo"<script>alert('Insert Failed');document.location='?p=$page';</script>";
	}
}

if(isset($_POST['beditnota'])){
	$nta_update=$nta->nta_update($nta_id,$nta_mhs,$nta_angkatan,$nta_jurusan,$nta_nomor,$nta_tgl,$nta_daftar,$nta_spb,$nta_spp,$nta_wilayah,$nta_pts,$nta_program,$nta_keterangan);
	if($nta_update){
		echo"<script>document.location='?p=$page';</script>";
	}else{
		echo"<script>alert('Insert Failed');document.location='?p=$page';</script>";
	}
}

if(isset($page)&&($act=="hapus")){
	$nta_id_=$id;
	$nta_delete=$nta->nta_delete($nta_id_);
	echo"<script>document.location='?p=$page';</script>";
}

if(isset($_POST['bfilternota'])){
	if(!empty($priode) || !empty($pts) || !empty($program) || !empty($wilayah)){
		$pecahpriode=explode(" - ",$priode);
		$_SESSION['priode1']=$pecahpriode[0];
		$_SESSION['priode2']=$pecahpriode[1];
		
		$_SESSION['pts']=$pts;
		
		$_SESSION['program']=$program;
		
		$_SESSION['wilayah']=$wilayah;
	}
	
	if(empty($priode)){
		$_SESSION['priode1']="";
		$_SESSION['priode2']="";
	}
	
	if(empty($pts)){
		$_SESSION['pts']="";
	}
	
	if(empty($program)){
		$_SESSION['program']="";
	}
	
	if(empty($wilayah)){
		$_SESSION['wilayah']="";
	}
	
	echo"<script>document.location='?p=$page';</script>";
	
}

if(isset($_POST['brefreshnota'])){
	if(!empty($_SESSION['priode1']) || !empty($_SESSION['priode2']) || !empty($_SESSION['pts']) || !empty($_SESSION['program']) || !empty($_SESSION['wilayah'])){
		$_SESSION['priode1']="";
		$_SESSION['priode2']="";

		$_SESSION['pts']="";
	
		$_SESSION['program']="";
		
		$_SESSION['wilayah']="";
	}
	
	echo"<script>document.location='?p=$page';</script>";
	
}

?>