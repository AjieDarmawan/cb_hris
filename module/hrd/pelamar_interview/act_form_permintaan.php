<?php 
session_start(); 

$pendidikan=$_POST['pendidikan'];
$div_id=$_POST['div_id'];
$jbt_id=$_POST['jbt_id'];
$sumber_loker=$_POST['sumber_loker'];
$penempatan=$_POST['penempatan'];
$pengalaman_kerja=$_POST['pengalaman_kerja'];


$dirmud=$_POST['dirmud'];
$dir_divisi=$_POST['dir_divisi'];
$dir_keuangan=$_POST['dir_keuangan'];
$dir_hrd=$_POST['dir_hrd'];
$dirut1=$_POST['dirut1'];
$dirut2=$_POST['dirut2'];
$dirut3=$_POST['dirut3'];

$pelamar_id=$_POST['pelamar_id'];





$to=$_POST['to'];

if(isset($_POST['bsave'])){

    $ekstensi_diperbolehkan	= array('jpg','png','jpeg','image/jpeg');
    $nama_profile = $_FILES['profile']['name'];
   
    $x = explode('.', $nama_profile);
     $ekstensi = strtolower(end($x));
    $ukuran	= $_FILES['profile']['size'];
    $file_tmp = $_FILES['profile']['tmp_name'];	

   

   

    if(in_array($ekstensi, $ekstensi_diperbolehkan) === true){
        if($ukuran < 1044070){			
        	move_uploaded_file($file_tmp, 'module/cv/profile_pelamar/'.$nama_profile);
            //$query = mysql_query("INSERT INTO upload VALUES(NULL, '$nama')");

           $insert=$pelamar->insert_form_pengajuan_pelamar($jbt_id,$div_id,$sumber_loker,$pendidikan,$pengalaman_kerja,$ktr_id,$pelamar_id,$dirmud,$dir_divisi,$dir_hrd,$dir_keuangan,$dirut1,$dirut2,$dirut3,$nama_profile);

            $acc=$pelamar->insert_form_acc_pengajuan_pelamar($pelamar_id,$dirmud,$dir_divisi,$dir_hrd,$dir_keuangan,$dirut1,$dirut2,$dirut3);

            if($acc){
                

                if($insert){
                   // echo"<script>alert('Berhasil')</script>";
                    echo"<script>document.location='?p=pelamar_interview_user';</script>";
                }else{
                    echo "gagal";
                }
            }else{
                echo 'GAGAL MENGUPLOAD GAMBAR';
            }
        }else{
            echo 'UKURAN FILE TERLALU BESAR';
        }

       
    }else{
        echo 'EKSTENSI FILE YANG DI UPLOAD TIDAK DI PERBOLEHKAN';

        echo "<pre>";
        print_r($_FILES);
    
        die;

      
    }

}




?>