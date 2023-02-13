
	  
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
/*	
	$nik    = $_REQUEST['nik'];
	$tgl    = $_REQUEST['tgl'];
	$kampus = $_REQUEST['kampus'];
*/	
	
	
	//echo $nama_pts;
	$dbopen = $db->koneksi();
	$sSQL = "select a.*,b.status as status_acc from bni_direct_detail_coba a
			 left join bni_direct_coba b ON b.nik=a.nik and b.tanggal=a.tanggal
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
	 $tot_acc=0;
     while ($r1=@mysql_fetch_array( $result1 )){
	     $no++; 
		 $status_acc = $r1['status_acc'];
		 $id    = $r1['id'];
		 $nik   = $r1['nik'];		
		 $nama  = $r1['nama'];
		 $status  = $r1['status'];
		 $catatan  = $r1['catatan'];
		 $tgl   = $r1['tanggal'];
		 $nama_barang  = $r1['nama_barang'];
		 $qty    = $r1['qty'];
		 $harga  = $r1['harga'];
		 $subtot = $qty*$harga;
		 $total += $subtot ;
		 if ($status=="1"){
			 $tot_acc += $subtot ;
		 }
	     $xstatus = "-";
		 if ($status=="0"){
		    $xstatus = "-";
		 }else{
		    if ($status_acc=="1"){
		      $xstatus = "<b>"."&radic;"." OK "."</b>";
			}  
		 }
		if ($no==1){
//			 echo ' <font size=+1 ><b>'.$kode.'</b></font> ';

			 echo '<thead>
				   <tr  bgcolor="#FFFFFF">
				   <th colspan="2" style="text-align:right;">Kampus : </th>
				   <th colspan="6">'.$kampus.'</th>
				   </tr> 
				   <tr  bgcolor="#FFFFFF">
				   <th colspan="2" style="text-align:right;">Nama : </th>
				   <th colspan="6">'.$nama.' ['.$nik.'] </th>
				   </tr> 
				   <tr  bgcolor="#FFFFFF">
				   <th colspan="2" style="text-align:right;">Tanggal : </th>
				   <th colspan="1">'.$tgl.'</th>
				   <th colspan="5">'.date('F-Y',strtotime($tgl)).'</th>
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
                   <td align="center">Appropal</td>				   
                   <th>Catatan</th>
				   </tr> 
				   </thead>  
				  ';	   		
		}
		
		echo '
		    <tr >
			<td> '.$no.' </td>
			<td> '.$tgl.' </td>
			<td> '.$nama_barang.' '.$status_acc.' </td>
			<td style="text-align:right;"> '.$qty.' </td>
			<td style="text-align:right"> '.number_format($harga).' </td>
			<td style="text-align:right"> '.number_format($subtot).' </td>
			<td align="center">'.$xstatus.'</td>
			<td>'.$catatan.'</td>
			';			
			
		 echo '</tr>';
		 
	 }
	  echo '<tr  bgcolor="#CCCCCC">
	        <th colspan="5"  style="text-align:right"> Total Pengajuan</th>
	        <th style="text-align:right">'.number_format($total).'</th>
			<th></th>
			<th></th>
	        </tr>';
	  echo '<tr  bgcolor="#CCCCCC">
	        <th colspan="5" style="text-align:right">Total di ACC</th>
	        <th style="text-align:right">'.number_format($tot_acc).'</th>
			<th></th>
			<th></th>
	        </tr>';
/*			
	  echo '<tr>
	        <th colspan="1" ></th>
	        <th colspan="2"> Appropal By : Dewi</th>
			<th></th>
	        </tr>';
*/			
	  echo '<tr>';
	  echo '<td colspan="8" align="right">';
	    $data  =  "module/kasbon_pengajuan_coba/cetak-kasbon.php";
		$data .= "?id=$id&nik=$nik&tgl=$tgl&kampus=$kampus";
		if ($status=="1"){

?>
  			    <a href="#"  onclick="OpenPopupCenter('<?php echo $data; ?>', 'TEST!?', 700, 400)"
						     title=" Cetak Kas Bon " >
				   <span class="btn btn-primary">
			  		<i class="fa fa-print"></i> PRINT  
					</span>
			    </a>  
<?			
      }else{
	     echo ' *** BELUM DISETUJUI ***';
	  }
	  echo	'</td>';
	  echo  '</tr>';
      echo '</table>' ; 	

} /// $jmlrec > 0 ////

	  
//     return;
 
?>


 
