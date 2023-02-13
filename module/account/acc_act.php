<?php
$acc_username=$_POST['acc_username'];
$acc_password=$_POST['acc_password'];
$kar_id=$_POST['kar_id'];
$re_acc_password=$_POST['re_acc_password'];

$page=$_GET['p'];
$act=$_GET['act'];
$acc_id=$_GET['id'];

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