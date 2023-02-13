<?php

error_reporting(0);
date_default_timezone_set("Asia/Bangkok");

require('../../class.php');
require('../../object.php');
$db->koneksi();

$page=$_GET['p'];
$act =$_GET['act'];
$id  =$_GET['id'];
$date_indo = date("d/m/Y", strtotime($date));
foreach($_REQUEST as $name=>$value)
{
	$$name=$value;
 	//echo "Name: $name : $value;<br />\n";
}
/*
	require('../../class.php');
	require('../../object.php');
	$db->koneksi();
*/


//if(isset($page)&&($act=="UpdateBarang")){
if($act=="UpdateBarang"){

		
        $q_upd    = "UPDATE barang_master
	                 SET
					 kode_barang = '$kodebrg',
		  		     nama_barang = '$namabrg',
		  		     harga1  = '$harga',
		  		     kdklp    = '$kdklp'
				     WHERE id='$id'   
			    ";
		echo $q_upd ;		
        $result_upd = mysql_query($q_upd);
/*		
	$pg = "?p=$page&id=$id";	
    echo "<script>document.location='".$pg."' ; </script>";	
*/   
}

//if(isset($page)&&($act=="AddBarang")){
if($act=="AddBarang"){
        $q_add    = "INSERT INTO barang_master 
		             (kode_barang,nama_barang,harga1,harga2,kdklp)
					 VALUES 
					 ('$kodebrg','$namabrg','$harga','$harga','$kdklp')
			    ";
        $q_brg    = "SELECT kode_barang FROM barang_master WHERE kode_barang ='$kodebrg' ";
        $cek_brg = mysql_query($q_brg);
		$r1 = mysql_fetch_array($cek_brg);
		if ($r1['kode_barang'] == "" and $kodebrg <> "" ){
		   // add_barang /////
		     $result_add = mysql_query($q_add);
		   
		}else{
		  if ($kodebrg <> ""){
		     echo 'Kode : '.$kodebrg." Sudah Ada !...";
		  }	
		}
/*		
	$pg = "?p=$page&id=$id";	
    echo "<script>document.location='".$pg."' ; </script>";	
*/	
}
  



/////////////////////////////////
?>