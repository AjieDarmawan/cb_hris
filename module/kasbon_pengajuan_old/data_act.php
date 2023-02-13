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

$xklp = "";
if($kdklp=="1"){
  $xklp = "Operasional";
}elseif($kdklp=="2"){
  $xklp = "Marketing Tools";
}elseif($kdklp=="3"){
  $xklp = "ATK";
}elseif($kdklp=="4"){
  $xklp = "Komsumsi";
}

//if(isset($page)&&($act=="UpdateBarang")){
if($act=="UpdateBarang"){
        $q_upd    = "UPDATE barang_master
	                 SET
					 kode_barang = '$kodebrg',
		  		     nama_barang = '$namabrg',
		  		     harga1  = '$harga',
		  		     kdklp   = '$kdklp',
					 klp	 = '$xklp'
				     WHERE id='$id'   
			    ";
        $result_upd = mysql_query($q_upd);
		if ($result_upd==1){
		  $message = "OK";
		}else{
		  $message = "NO";
		}
		echo $message;	
/*		
	$pg = "?p=$page&id=$id";	
    echo "<script>document.location='".$pg."' ; </script>";	
*/   
}

//if(isset($page)&&($act=="AddBarang")){
if($act=="AddBarang"){
         $q_add    = "INSERT INTO barang_master 
		             (kode_barang,nama_barang,harga1,harga2,kdklp,klp)
					 VALUES 
					 ('$kodebrg','$namabrg','$harga','$harga','$kdklp','$xklp')
			    ";
        $q_brg    = "SELECT kode_barang FROM barang_master WHERE kode_barang ='$kodebrg' ";
        $cek_brg = mysql_query($q_brg);
		$r1 = mysql_fetch_array($cek_brg);
		if ($r1['kode_barang'] == ""  ){
		   // add_barang /////
		     if ($kodebrg <> "" and $namabrg <> "" and $harga <> ""){
			     $result_add = mysql_query($q_add);
				 $message = "OK";
			 }else{
				 $message = "NO";
			 }	 
		}else{
		    //echo 'Kode : '.$kodebrg." Sudah Ada !...";
			 $message="NO";
		}
		echo $message ;	


/*		
	$pg = "?p=$page&id=$id";	
    echo "<script>document.location='".$pg."' ; </script>";	
*/	
}
  



/////////////////////////////////
?>