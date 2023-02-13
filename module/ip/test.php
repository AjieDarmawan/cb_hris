<?php
header('Access-Control-Allow-Origin: *');

require('../../class.php');
require('../../object.php');

$db->koneksi();


$arr=array();
$unt_id="2";
$ktr_tampil_unt=$ktr->ktr_tampil_unt($unt_id);
while($data=mysql_fetch_array($ktr_tampil_unt)){
    array_push($arr, array("ktr_id" => $data['ktr_id'], "ktr_kd" => $data['ktr_kd']));
}
print_r(json_encode($arr));
?>