
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
		echo "$name = $value;<br />\n";
		
	}
     $catatan    = explode(',',$catatan);
     $dataitem   = explode(',',$data_item);
	 $j_dataitem = count($dataitem);
	 for ($i=0; $i < $j_dataitem; $i++){
	    $id = $dataitem[$i]; 
		$catat = $catatan[$i];
//		echo '<br>id : '.$id;
//		echo '<br>';
        $sSQL_upd_0 = " UPDATE bni_direct_detail SET status='0',catatan='$catat' WHERE id='$id' ";
	    $query_0 = mysql_query($sSQL_upd_0) or die (mysql_error());
	 }

    //   $mode = $_REQUEST['mode'];
     $id_item = explode(',',$data_ids);
	 $j_item = count($id_item);
	 for ($i=0; $i < $j_item; $i++){
	    $id = $id_item[$i]; 
//		echo '<br>id : '.$id;
//		echo '<br>';
        $sSQL_upd = " UPDATE bni_direct_detail SET status='1' WHERE id='$id' ";
	    $query = mysql_query($sSQL_upd) or die (mysql_error());
	 }

/////////UPDATE TOTAL DISETUJUI/////////////////////////////////////////	 
	$sSQL = " select sum(total) as total from bni_direct_detail 
			  where nik='$nik' and tanggal='$tgl' and status='1'
			 "; 

	$result1  = @mysql_query($sSQL) or die (mysql_error());
//	$jmlrec1  = @mysql_num_rows($result1);	
	$r = @mysql_fetch_array( $result1 ); 
	$total = $r['total'];
	if ($total > 0 ){
	   // $sSQL_upd = " UPDATE bni_direct SET nominal='$total',status='1' WHERE nik='$nik' and tanggal='$tgl'  ";
	    $sSQL_upd = " UPDATE bni_direct SET nominal='$total' WHERE nik='$nik' and tanggal='$tgl'  ";
    	$query = mysql_query($sSQL_upd) or die (mysql_error());
	}	
	
//	echo '<br>'.$total;
//////////////////////////////////////////////////////////////////////////////	
/*	 
	$sSQL = ' SELECT a.* FROM bni_direct_detail a ';
	$query = mysql_query($sSQL) or die (mysql_error());
	while($row = mysql_fetch_assoc($query)) {
		//echo '<br>'.$row['nik'];

	}
*/	
	
?>

