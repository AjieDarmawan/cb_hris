<?php 
session_start(); 

$lowongan=$_POST['lowongan'];
$share_link=$_POST['share_link'];
$nama_grup=$_POST['nama_grup'];




if(isset($_POST['bsave'])){
   $insert = $pelamar->insert_publikasi_loker($lowongan,$nama_grup,$share_link);

        if($insert){
            echo"<script>document.location='?p=publikasi_loker';</script>";
        }else{
            echo "gagal";
        }

}




?>