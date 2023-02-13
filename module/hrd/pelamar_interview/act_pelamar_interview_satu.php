<?php 
session_start(); 

$tgl_interview=$_POST['tgl_interview'];
$masukan=$_POST['masukan'];
$hasil_interview=$_POST['hasil_interview'];
$pelamar_id=$_POST['pelamar_id'];

$to=$_POST['to'];

if(isset($_POST['bsave'])){

    if($to=='insert'){
        $insert = $pelamar->interview_satu_insert($tgl_interview,$masukan,$hasil_interview,$pelamar_id);
    }elseif($to=='update'){
        $insert = $pelamar->interview_satu_update($tgl_interview,$masukan,$hasil_interview,$pelamar_id);
    }
 

        if($insert){
            echo"<script>document.location='?p=pelamar_interview';</script>";
        }else{
            echo "gagal";
        }

}




?>