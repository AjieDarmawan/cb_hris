<?php

$page=$_GET['p'];

$act=$_GET['act'];

$id=$_GET['id'];

$id_=$_GET['id_'];



//Variable Unlist Domain

$udo_id=$_POST['udo_id'];

$tdo_id=$id;

$udo_id_=$id_;



$udo_nama=$_POST['udo_nama'];

$udo_username=$_POST['udo_username'];

$udo_password=$_POST['udo_password'];

$udo_server=$_POST['udo_server'];

$udo_ip=$_POST['udo_ip'];

$udo_keterangan=$_POST['udo_keterangan'];



if(isset($_POST['binputdomain'])){

	

	$hitdomain=count($udo_nama);

	for($i=0; $i <= $hitdomain-1; $i++){



	$arr_nama=$udo_nama[$i];

        $arr_username=$udo_username[$i];

        $arr_password=$udo_password[$i];

        $arr_server=$udo_server[$i];

        $arr_ip=$udo_ip[$i];

        $arr_keterangan=$udo_keterangan[$i];

		

	$udo_insert=$udo->udo_insert($arr_nama,$arr_username,$arr_password,$arr_server,$arr_ip,$arr_keterangan,$tdo_id,$kar_id);

	

	}

	

	if($udo_insert){

		echo"<script>document.location='?p=$page';</script>";

	}else{

		echo"<script>alert('Insert Failed');document.location='?p=$page&id=$id';</script>";

	}

}

if (isset($_POST['bupdateunlist'])) {
	
	$udo_update=$udo->udo_update($udo_id,$udo_nama,$udo_username,$udo_password,$udo_server,$udo_ip,$udo_keterangan,$kar_id);

	if($udo_update){

		echo"<script>document.location='?p=$page&id=$id';</script>";

	}else{

		echo"<script>alert('Insert Failed');document.location='?p=$page&id=$id';</script>";

	}
}

if(isset($page)&&($act=="hapus")){
	$udo_id_=$id_;
	$udo_delete=$udo->udo_delete($udo_id_);
	echo"<script>document.location='?p=$page';</script>";
}

?>