
	  
<?php
	error_reporting(0);
	session_start();
	date_default_timezone_set('Asia/Jakarta');

	require('../../class.php');
	require('../../object.php');
	
	
	$nik    = $_REQUEST['nik'];
	$tgl    = $_REQUEST['tgl'];
	
	
	
	//echo $nama_pts;
	$dbopen = $db->koneksi();
	$sSQL = "select a.* from bni_direct_detail a
			 left join bni_direct b ON b.nik=a.nik and b.tanggal=a.tanggal
			 where b.nik='$nik' and b.tanggal='$tgl'
			 "; 

	$result1  = @mysql_query($sSQL) or die (mysql_error());
	$jmlrec1  = @mysql_num_rows($result1);	 
/*
	while($row = mysql_fetch_array($result1)) {
		//$attr_emp = $row;
		echo $row['nik'].' '.$row['tanggal'].'<br>';
	}
	    echo $jmlred2.' '.$nik.' => '.' '.$jmlrec2;
		exit;
*/
 //    echo $sql_sipema;
 //   echo $sql_nota_tunai;
	 
     $no=0 ;
	 $total = 0;
	 if ($jmlrec1==0 ){
	    echo '<font color=red>Data Kosong !...</font>';return ;
	 }	 
if ($jmlrec1 > 0 ){	 
//	 echo ' <font size=+1 ><b>'.$kode.'</b></font> ';
//     echo '<h4>'.$nama_pts.'</h4>';
	 echo ' <table  class="table table-bordered" > ';
	 $total = 0;
     while ($r1=@mysql_fetch_array( $result1 )){
	     $no++; 
		 $nik   = $r1['nik'];		
		 $nama  = $r1['nama'];
		 $tgl   = $r1['tanggal'];
		 $nama_barang  = $r1['nama_barang'];
		 $qty    = $r1['qty'];
		 $harga  = $r1['harga'];
		 $subtot = $qty*$harga;
		 $total += $subtot ;
		if ($no==1){
//			 echo ' <font size=+1 ><b>'.$kode.'</b></font> ';

			 echo '<thead>
				   <tr  bgcolor="#FFFFFF">
				   <th colspan="1" style="text-align:right;">Nana : </th>
				   <th colspan="1">'.$nama.' ['.$nik.'] </th>
				   </tr> 
				   <tr  bgcolor="#FFFFFF">
				   <th colspan="1" style="text-align:right;">Tanggal : </th>
				   <th colspan="1">'.$tgl.'</th>
				   </tr> 
				   </thead>  
				  ';	   
			 echo '<thead>
				   <tr  bgcolor="#CCCCCC">
				   <th>No</th>
				   <th>Tanggal</th>
				   <th>Items Barang</th>
				   <th style="text-align:center;">QTY</th>
				   <th style="text-align:center;">Harga</th>
				   <th  style="text-align:right;">Total</th>
				   </tr> 
				   </thead>  
				  ';	   		
		}
		
		echo '
		    <tr >
			<td> '.$no.' </td>
			<td> '.$tgl.' </td>
			<td> '.$nama_barang.' </td>
			<td style="text-align:right;"> '.$qty.' </td>
			<td style="text-align:right"> '.number_format($harga).' </td>
			<td style="text-align:right"> '.number_format($subtot).' </td>';
			
		 echo '</tr>';
		 
	 }
	  echo '<tr  bgcolor="#CCCCCC">
	        <th colspan="5" ></th>
	        <th style="text-align:right">'.number_format($total).'</th>
	        </tr>';
      echo '</table>' ; 	

} /// $jmlrec > 0 ////

	  
//     return;
 
?>




