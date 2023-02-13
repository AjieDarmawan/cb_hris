<?php 

if($_POST['status']){
     $status=$_POST['status'];
     $id_pelamar=$_POST['id_pelamar'];

    $insert=$pelamar->pelamar_offering_update_status($status, $id_pelamar);


    if($insert){
       // echo"<script>alert('Berhasil Disimpan')</script>";
    }else{
        //echo "<script>alert('Gagal Disimpan')</script>";
    }
}





?>