<?php
$page=$_GET['p'];
$act=$_GET['act'];
$id=$_GET['id'];


//Variable Asset
$ast_nm=$_POST['ast_nm'];
$ast_sn=$_POST['ast_sn'];
$ast_des=$_POST['ast_des'];
$ast_sts=$_POST['ast_sts'];
$ast_id=$_POST['ast_id'];


//Variable Jenis
$ast_jns_nm=$_POST['ast_jns_nm'];
$ast_jns_id=$_POST['ast_jns_id'];


if(isset($page)&&($act=="open")){
	$ast_jns_get=$id;
	$ast_tampil_jns_id=$ast->ast_tampil_jns_id($ast_jns_get);
	//$ast_cek_jns_id=mysql_num_rows($ast_tampil_jns_id);

	//if($ast_cek_jns_id > 0){
		$ast_jns_id=$ast->ast_jns_id($ast_jns_get);
		$ast_jns_data=mysql_fetch_array($ast_jns_id);
	//}else{
	//	echo"<script>document.location='?p=not_found';</script>";
	//}

	if(isset($_POST['binputasset'])){
		$ast_sn_cek=$ast->ast_sn_cek($ast_sn);
		$ast_sn_result=mysql_num_rows($ast_sn_cek);

		if($ast_sn_result === 0){
			$ast_insert=$ast->ast_insert($ast_nm,$ast_sn,$ast_des,$ast_sts,$ast_jns_get);
			if($ast_insert){
				echo"<script>document.location='?p=$page&act=$act&id=$id';</script>";
			}else{
				echo"<script>alert('Insert Failed');document.location='?p=$page&act=$act&id=$id';</script>";
			}
		}else{
			echo"<script>alert('Maaf, Serial Number sudah terdaftar');document.location='?p=$page&act=$act&id=$id';</script>";
		}
	}

	if(isset($_POST['beditasset'])){
		$ast_update=$ast->ast_update($ast_nm,$ast_sn,$ast_des,$ast_sts,$ast_jns_get,$ast_id);
		if($ast_update){
			echo"<script>document.location='?p=$page&act=$act&id=$id';</script>";
		}else{
			echo"<script>alert('Insert Failed');document.location='?p=$page&act=$act&id=$id';</script>";
		}
	}	

}else{

	if(isset($_POST['binputasset'])){
		$ast_sn_cek=$ast->ast_sn_cek($ast_sn);
		$ast_sn_result=mysql_num_rows($ast_sn_cek);

		if($ast_sn_result === 0){
			$ast_insert=$ast->ast_insert($ast_nm,$ast_sn,$ast_des,$ast_sts,$ast_jns_id);
			if($ast_insert){
				echo"<script>document.location='?p=$page';</script>";
			}else{
				echo"<script>alert('Insert Failed');document.location='?p=$page';</script>";
			}
		}else{
			echo"<script>alert('Maaf, Serial Number sudah terdaftar');document.location='?p=$page';</script>";
		}
	}

	if(isset($_POST['beditasset'])){
		$ast_update=$ast->ast_update($ast_nm,$ast_sn,$ast_des,$ast_sts,$ast_jns_id,$ast_id);
		if($ast_update){
			echo"<script>document.location='?p=$page';</script>";
		}else{
			echo"<script>alert('Insert Failed');document.location='?p=$page';</script>";
		}
	}


}

if(isset($_POST['binputjenis'])){
	$ast_jns_insert=$ast->ast_jns_insert($ast_jns_nm);
	if($ast_jns_insert){
		echo"<script>document.location='?p=$page';</script>";
	}else{
		echo"<script>alert('Insert Failed');document.location='?p=$page';</script>";
	}
}

if(isset($_POST['beditjenis'])){
	$ast_jns_update=$ast->ast_jns_update($ast_jns_nm,$ast_jns_id);
	if($ast_jns_update){
		echo"<script>document.location='?p=$page';</script>";
	}else{
		echo"<script>alert('Insert Failed');document.location='?p=$page';</script>";
	}
}
?>