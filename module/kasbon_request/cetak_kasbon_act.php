<?php
	error_reporting(0);
	session_start();
	date_default_timezone_set('Asia/Jakarta');

	require('../../class.php');
	require('../../object.php');

	foreach($_REQUEST as $name=>$value)
	{
		$$name=$value;
		//echo "$name = $value;<br />\n";
		
	}

	$dbopen = $db->koneksi();
	$sSQL = "select a.*,b.status as status_acc from bni_direct_detail a
			 left join bni_direct b ON b.nik=a.nik and b.tanggal=a.tanggal
			 where b.nik='$nik' and b.tanggal='$tgl' and a.status='1'
			 "; 

   $sResult   = @mysql_query($sSQL);
   $jmlrec    = @mysql_num_rows($sResult);	 	 
   $adata    = array();
   while ($r=@mysql_fetch_array( $sResult )){
         array_push($adata,$r); 
  }
  $_SESSION['dataku'] = json_encode($adata);	
//  echo $sql_kasbon ; exit();  
  	 
/////////////////////////////////////////////////////////////////////////////


?>
