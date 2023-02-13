<?php
error_reporting(E_ALL ^ E_NOTICE);
date_default_timezone_set('Asia/Jakarta');
session_start();

require('../class.php');

$db=new Database();
$db->koneksi();

$nla=new Penilaian();

for ($i = 1; $i < 19; $i++) {
    $x = "fpk_huruf{$i}";
    if(isset($_POST[$x])){
        $fpk_huruf=$_POST[$x];
        $fpk_tampil_bobot=$nla->fpk_tampil_bobot($fpk_huruf);
        $fpk_jml=mysql_num_rows($fpk_tampil_bobot);
        if($fpk_jml > 0){
            echo"<option  value='' selected>Pilih Bobot</option>";
            while($data=mysql_fetch_array($fpk_tampil_bobot)){
                    echo "<option value='$data[fpk_bobot_angka]'>$data[fpk_bobot_angka]</option>";
                    $lable_text=$data[fpk_lable];
            }
        }else{
                    echo "<option value='' selected>Tidak Ada Bobot</option>";
        }
    }
}
?>