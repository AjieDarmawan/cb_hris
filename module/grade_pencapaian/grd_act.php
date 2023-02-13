<?php
$page=$_GET['p'];
$act=$_GET['act'];
$acc_id=$_GET['id'];

if(isset($_POST['bupdate'])){
	
	$grd_id = $_POST['grd_id'];
	$grd_wilayah = $_POST['grd_wilayah'];
	$grd_manwil = $_POST['grd_manwil'];
	$grd_kpt = $_POST['grd_kpt'];
	$grd_pts = $_POST['grd_pts'];
	$grd_grade = $_POST['grd_grade'];
	$grd_target = $_POST['grd_target'];
	$grd_jml_staff = $_POST['grd_jml_staff'];
	
	$grd_karyawan="";
        foreach ($_POST['grd_karyawan'] as $val){
                $userunit[] = $val;
        }
        $grd_karyawan=implode(",", $userunit); 
 
	$grd_update=$grd->grd_update($grd_id,$grd_wilayah,$grd_manwil,$grd_kpt,$grd_pts,$grd_grade,$grd_target,$grd_jml_staff,$grd_karyawan);
	echo"<script>document.location='?p=$page';</script>";
}

if(isset($_POST['bsave'])){
        if(!($acc_password==$re_acc_password)){
            echo"<script>alert('Ulangi Password tidak sama');document.location='?p=$page';</script>";
        }else{
            $acc_insert=$acc->acc_insert($acc_username,$acc_password,$kar_id);
            if($acc_insert){
                    echo"<script>document.location='?p=$page';</script>";
            }else{
                    echo"<script>alert('Insert Failed');document.location='?p=$page';</script>";
	}
        }
}
if(isset($page)&&($act=="hapus")){
	$acc_delete=$acc->acc_delete($acc_id);
	echo"<script>document.location='?p=$page';</script>";
}
elseif(isset($page)&&($act=="block")){
    $acc_sts="N";
    $acc_update_sts=$acc->acc_update_sts($acc_id,$acc_sts);
    echo"<script>document.location='?p=$page';</script>";
}
elseif(isset($page)&&($act=="unblock")){
    $acc_sts="A";
    $acc_update_sts=$acc->acc_update_sts($acc_id,$acc_sts);
    echo"<script>document.location='?p=$page';</script>";
}
?>