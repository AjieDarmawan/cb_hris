<?php
error_reporting(E_ALL ^ E_NOTICE);
date_default_timezone_set('Asia/Jakarta');
session_start();

require('../class.php');

$db=new Database();
$db->koneksi();

$div=new Divisi();
$jbt=new Jabatan();

$div_id=$_POST['div_id'];
$jbt_tampil_div=$jbt->jbt_tampil_div($div_id);
$jbt_jml=mysql_num_rows($jbt_tampil_div);
if($jbt_jml > 0){
	echo"<option  value='' selected>Pilih Jabatan</option>";
	while($data=mysql_fetch_array($jbt_tampil_div)){
		echo "<option value='$data[jbt_id]'>$data[jbt_nm]</option>";
	}
}else{
		echo "<option value='' selected>Tidak Ada Jabatan</option>";
}
?>