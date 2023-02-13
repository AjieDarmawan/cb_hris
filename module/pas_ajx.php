<?php
error_reporting(E_ALL ^ E_NOTICE);
date_default_timezone_set('Asia/Jakarta');
session_start();

require('../class.php');

$db=new Database();
$db->koneksi();

$kar=new Karyawan();

$kar_id=$_POST['kar_id'];
$kar_tampil_id=$kar->kar_tampil_id($kar_id);
$data=mysql_fetch_array($kar_tampil_id);
$kar_jml=mysql_num_rows($kar_tampil_id);

$numbers = range(1, 9);
shuffle($numbers);

function UniqueRandomNumbersWithinRange($min, $max, $quantity) {
    $numbers = range($min, $max);
    shuffle($numbers);
    return array_slice($numbers, 0, $quantity);
}

$array=UniqueRandomNumbersWithinRange(0,9,6);
$password=implode($array);

$nik_pecah=explode(".", $data['kar_nik']);
$nik=implode($nik_pecah);

if($kar_jml > 0){
        echo $nik."|".$password;        
}
?>