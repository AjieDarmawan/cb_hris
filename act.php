<?php
$acc_username=$inj->anti_injection($_POST['acc_username']);
$acc_password=$inj->anti_injection($_POST['acc_password']);

if(isset($_POST['bsignin'])){
	if (!ctype_alnum($acc_username) OR !ctype_alnum($acc_password)){
	  	echo"<script>document.location='media.php';</script>";
	}
	else{
		$acc_signin=$acc->acc_signin($acc_username,$acc_password,$date,$time);
		$acc_signin_freelance=$afl->acc_signin($acc_username,$acc_password,$date,$time);
		$acc_signin_test=$ats->acc_signin($acc_username,$acc_password,$date,$time);
		if(($acc_signin) || ($acc_signin_freelance) || ($acc_signin_test)){
			echo"<script>document.location='media.php';</script>";
		}else{
			echo"<script>alert('Signin Failed');document.location='?';</script>";
		}
	}
}
elseif(isset($_POST['bsignout'])){
	$kar_id=$_SESSION['kar'];
	$kar_id_=$_SESSION['kar_fl'];
	$kar_id__=$_SESSION['kar_tst'];
	$acc_signout=$acc->acc_signout($kar_id,$date,$time);
	$acc_signout_fl=$afl->acc_signout($kar_id_,$date,$time);
	$acc_signout_tst=$afl->acc_signout($kar_id__,$date,$time);
	echo"<script>document.location='index.php';</script>";
}
?>