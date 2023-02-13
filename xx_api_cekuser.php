<?php

	//header("Access-Control-Allow-Origin: *");
	//header("Access-Control-Allow-Headers: *");
	error_reporting(0);
	date_default_timezone_set('Asia/Jakarta'); 
	
    $nik = 'SG.0040.2008'; 
	$ch = curl_init();
	///////////set-localhost////////////////
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
	///////////set-localhost////////////////	
	curl_setopt($ch, CURLOPT_URL,"https://cb.web.id/apikaryawan/getdata.php");
	curl_setopt($ch, CURLOPT_POST, 1);
	curl_setopt($ch, CURLOPT_HTTPHEADER, array("REFERER:Referer: http://localhost/"));
	curl_setopt($ch, CURLOPT_POSTFIELDS, "type=terizin&nik=".$nik);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	// var_dump($akses->nik);
	$server_output = curl_exec($ch);
	$arrResponse = (array) json_decode($server_output);
	curl_close ($ch);
	
	//echo $server_output;
	var_dump($server_output);
	/////////////////////////////////////////////////
	echo '<br>kar_nik = '.$arrResponse['kar_nik'];
	echo '<br>kar_nm = '.$arrResponse['kar_nm'];
	echo '<br>lvl_id = '.$arrResponse['lvl_id'];
	echo '<br>lvl_nm = '.$arrResponse['lvl_nm'];
	echo '<br>acc_md5 = '.$arrResponse['acc_md5'];
	///////////////////////////////////////////////
	return;
			

 
?>