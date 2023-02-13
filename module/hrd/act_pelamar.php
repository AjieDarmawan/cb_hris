<?php
session_start(); 
$page=$_POST['p'];
$act=$_POST['act'];
 $nama=$_POST['nama'];
$lowongan=$_POST['lowongan'];
$alamat=$_POST['alamat'];
$no_wa=$_POST['no_wa'];
$jk=$_POST['jk'];

$tgl_lahir=$_POST['tgl_lahir'];
$tmpt_lahir=$_POST['tmpt_lahir'];
$cv=$_POST['cv'];

// if($cv){


  
   

// }



if(isset($_POST['bsave'])){

   
    $ekstensi_diperbolehkan	= array('pdf','doc','docx');
    $nama_cv = $_FILES['cv']['name'];
    // echo "<pre>";
    // print_r($_FILES);

    // die;
    $x = explode('.', $nama_cv);
     $ekstensi = strtolower(end($x));
    $ukuran	= $_FILES['cv']['size'];
    $file_tmp = $_FILES['cv']['tmp_name'];	

   

    if(in_array($ekstensi, $ekstensi_diperbolehkan) === true){
        if($ukuran < 1044070){			
        	move_uploaded_file($file_tmp, 'module/cv/'.$nama_cv);
            //$query = mysql_query("INSERT INTO upload VALUES(NULL, '$nama')");

            $insert=$pelamar->pelamar_insert($nama, $lowongan, $alamat, $no_wa, $jk, $tgl_lahir, $tmpt_lahir,$nama_cv);
   
            if($insert){
                

                if($insert){
                    echo"<script>document.location='?p=hrd';</script>";
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

      
    }


    

}


