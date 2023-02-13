<?php 
session_start(); 

$lowongan=$_POST['lowongan'];
$share_link=$_POST['share_link'];
$portal=$_POST['portal'];




if(isset($_POST['bsave'])){
   $insert = $pelamar->insert_publikasi_iklan($lowongan,$portal,$share_link);

        if($insert){
            echo"<script>document.location='?p=publikasi_iklan';</script>";
        }else{
            echo "gagal";
        }

}




?>