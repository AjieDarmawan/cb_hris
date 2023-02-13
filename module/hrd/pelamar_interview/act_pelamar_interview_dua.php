<?php 
session_start(); 

$tgl_interview=$_POST['tgl_interview'];
$masukan=$_POST['masukan'];
$hasil_interview=$_POST['hasil_interview'];
$pelamar_id=$_POST['pelamar_id'];
$ketemu_user=$_POST['ketemu_user'];



if(isset($_POST['bsave'])){
   $insert = $pelamar->interview_dua_insert($tgl_interview,$masukan,$hasil_interview,$pelamar_id,$ketemu_user);

        if($insert){
            echo"<script>document.location='?p=pelamar_interview_user';</script>";
        }else{
            echo "gagal";
        }

}




?>