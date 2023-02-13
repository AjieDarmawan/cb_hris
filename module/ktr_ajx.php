<?php
error_reporting(E_ALL ^ E_NOTICE);
date_default_timezone_set('Asia/Jakarta');
session_start();

require('../class.php');

$db=new Database();
$db->koneksi();

$unt=new Unit();
$ktr=new Kantor();

$unt_id=$_POST['unt_id'];
$ktr_tampil_unt=$ktr->ktr_tampil_unt($unt_id);
$ktr_jml=mysql_num_rows($ktr_tampil_unt);
if($ktr_jml > 0){
	echo"<option  value='' selected>Pilih Kantor</option>";
	while($data=mysql_fetch_array($ktr_tampil_unt)){
		if(($data['ktr_id']!=="44")&&($data['ktr_id']!=="23")&&($data['ktr_id']!=="22")){
		echo "<option value='$data[ktr_id]'>$data[ktr_nm]</option>";
		}
	}
}else{
		echo "<option value='' selected>Tidak Ada Kantor</option>";
}
?>