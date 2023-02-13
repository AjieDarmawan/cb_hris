
<?php 
	error_reporting(0);
	date_default_timezone_set('Asia/Jakarta');
	session_start();
	require('../../class.php');
	require('../../object.php');
	$dbopen = $db->koneksi(); 
	
	foreach($_REQUEST as $name=>$value)
	{
		$$name=$value;
		//echo "$name = $value;<br />\n";
		
	}
	
     $catatan    = explode(',',$catatan);
     $dataitem   = explode(',',$data_item);
	 $j_dataitem = count($dataitem);
	 for ($i=0; $i < $j_dataitem; $i++){
	    $id = $dataitem[$i]; 
		$catat = $catatan[$i];
//		echo '<br>id : '.$id;
//		echo '<br>';
        $sSQL_upd_0 = " UPDATE bni_direct_detail_coba SET status='0',catatan='$catat' WHERE id='$id' ";
	    $query_0 = mysql_query($sSQL_upd_0) or die (mysql_error());
	 }

    //   $mode = $_REQUEST['mode'];
     $id_item = explode(',',$data_ids);
	 $j_item = count($id_item);
	 $cekno = 0;
	 for ($i=0; $i < $j_item; $i++){
	    $cekno++;
	    $id = $id_item[$i]; 
        $sSQL_upd = " UPDATE bni_direct_detail_coba SET status='1' WHERE id='$id' ";
	    $query = mysql_query($sSQL_upd) or die (mysql_error());
	 }

/////////UPDATE TOTAL DISETUJUI/////////////////////////////////////////	 

	$sSQL = " select sum(total) as total from bni_direct_detail_coba 
			  where nik='$nik' and tanggal='$tgl' and status='1'
			 "; 

	$result1  = @mysql_query($sSQL) or die (mysql_error());
	$r = @mysql_fetch_array( $result1 ); 
	$total = $r['total'];
	if ($total > 0 ){
		$sSQL_upd_2 = " UPDATE bni_direct_coba SET catatan='$ket',nominal='$total',status='1' 
						WHERE nik='$nik' and tanggal='$tgl'  ";
		$query = mysql_query($sSQL_upd_2) or die (mysql_error());
	}else{
		$sSQL_upd_2 = " UPDATE bni_direct_coba SET catatan='$ket',nominal='$total',status='0' 
						WHERE nik='$nik' and tanggal='$tgl'  ";
		$query = mysql_query($sSQL_upd_2) or die (mysql_error());
	}	
	
//	echo '<br>'.$total;
//////////////////////////////////////////////////////////////////////////////	
/*	 
	$sSQL = ' SELECT a.* FROM bni_direct_detail_coba a ';
	$query = mysql_query($sSQL) or die (mysql_error());
	while($row = mysql_fetch_assoc($query)) {
		//echo '<br>'.$row['nik'];

	}
*/	
	
?>

