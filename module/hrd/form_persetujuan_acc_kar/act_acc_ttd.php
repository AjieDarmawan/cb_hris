<?php 
session_start(); 

$pelamar_id = $_GET['pelamar_id'];

$pelamar_acc_form_rekomen_detail = $pelamar->pelamar_acc_form_rekomen_detail($pelamar_id);
$pelamar_acc = mysql_fetch_array($pelamar_acc_form_rekomen_detail);



// echo "<pre>";
// print_r();
if(isset($_POST['bsave'])){


//     echo "<pre>";
// print_r($pelamar_acc);
// die;

 //  echo $kar_id = $kar_data['kar_id'];

    if($kar_data['kar_id']==$pelamar_acc['dirmud']){ 

        $acc1 = "status_acc_dirmud";
        $date_acc1 = "date_acc_dirmud";
        


    }elseif($kar_data['kar_id']==$pelamar_acc['dir_divisi']){
        $acc1 = "status_acc_dir_divisi";
        $date_acc1 = "date_acc_dir_divisi";
    }

    elseif($kar_data['kar_id']==$pelamar_acc['dir_hrd']){

        $acc1 = "status_acc_dir_hrd";
        $date_acc1 = "date_acc_dir_hrd";

    }


    elseif($kar_data['kar_id']==$pelamar_acc['dir_keuangan']){

        $acc1 = "status_acc_dir_keuangan";
        $date_acc1 = "date_acc_dir_keuangan";

    }

    elseif($kar_data['kar_id']==$pelamar_acc['dirut1']){

        $acc1 = "status_acc_dirut1";
        $date_acc1 = "date_acc_dirut1";

    }


    elseif($kar_data['kar_id']==$pelamar_acc['dirut2']){

        $acc1 = "status_acc_dirut2";
        $date_acc1 = "date_acc_dirut2";

    }

    elseif($kar_data['kar_id']==$pelamar_acc['dirut3']){
        $acc1 = "status_acc_dirut3";
        $date_acc1 = "date_acc_dirut3";
    }


    // echo $acc1;
    // echo $date_acc1;
    // die;

    $q = $pelamar->pelamar_acc_form_rekomen_status($pelamar_id,$kar_data['kar_id'],$acc1,$date_acc1);

    if($q){
         echo"<script>alert('Berhasil')</script>";
         echo"<script>document.location='?p=form_persetujuan_acc_kar';</script>";
     }else{
         echo "gagal";
     }



   
}


?>