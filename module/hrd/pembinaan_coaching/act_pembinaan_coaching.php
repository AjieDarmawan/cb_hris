<?php 
session_start(); 

$nama=$_POST['nama'];
$pembina=$_POST['pembina'];
$tanggal=$_POST['tanggal'];
$masukan=$_POST['masukan'];
$tempat=$_POST['tempat'];




if(isset($_POST['bsave'])){
   $insert = $pelamar->insert_coaching_kar($nama,$pembina,$tanggal,$masukan,$tempat);

        if($insert){
            echo"<script>document.location='?p=pembinaan_coaching';</script>";
        }else{
            echo "gagal";
        }

}




?>