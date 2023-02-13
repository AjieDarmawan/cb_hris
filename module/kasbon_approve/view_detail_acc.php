
	  
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
	$sSQL = "select a.*,b.catatan as ket from bni_direct_detail  a
			 left join bni_direct  b ON b.nik=a.nik and b.tanggal=a.tanggal
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
		 $id    = $r1['id'];
		 $nik   = $r1['nik'];		
		 $nama  = $r1['nama'];
		 $status  = $r1['status'];
		 $ket     = $r1['ket'];
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
		 if ($status=="0"){
		    $xstatus = "";
		 }else{
		    $xstatus = "checked";
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
				   <td style="text-align:center; vertical-align:middle;">No</td>
				   <td style="text-align:center; vertical-align:middle;">Tanggal</td>
				   <td style="text-align:center; vertical-align:middle;">Items Barang</td>
				   <td style="text-align:center; vertical-align:middle;">QTY</td>
				   <td style="text-align:center; vertical-align:middle;">Harga</td>
				   <td style="text-align:right; vertical-align:middle;">Total</td>
                   <td style="text-align:center; vertical-align:middle;">
					   <button id="deleteTriger" title="Save Data" style="background:#33CCFF">
					   <i class="fa fa-save"> Save</i></button>
					   <br>
					   <input type="checkbox"  id="bulkDelete"  /> 
				   </td>				   
                   <td style="text-align:left; vertical-align:middle;">
				   	    Catatan Penting
						<br>
						<textarea class="form-control" rows="1" id="ket" placeholder="...Catatan...">'.$ket.'</textarea>
				   </td>
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
			<td style="text-align:right"> '.number_format($subtot).' </td>
			<td align="center">
			
			<input type="checkbox"  class="deleteRow" value="'.$id.'"'.$xstatus.' />
			<input style="display:none" type="checkbox"  class="itemRow" value="'.$id.'" checked />
			</td>
			<td>
			<input type="text"  class="catatanRow" value="'.$catatan.'"  />
			</td>
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
	  echo '<tr>
	        <th colspan="1" ></th>
	        <th colspan="2"> Appropal By : Dewi</th>
			<th></th>
	        </tr>';
      echo '</table>' ; 	

} /// $jmlrec > 0 ////

	  
//     return;
 
?>

<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script> !-->

<script>
	$("#bulkDelete").on('click',function() { // bulk checked
          var status = this.checked;
          $(".deleteRow").each( function() {
             $(this).prop("checked",status);
          });
		 
        });

	$('#deleteTriger').on("click", function(event){
          if( $('.deleteRow:checked').length >= 0 ){
            event.preventDefault();
            var ids = [];
            $('.deleteRow').each(function(){
              if($(this).is(':checked')) {
                 ids.push($(this).val());
              }
            });
            var ids2 = [];
            $('.itemRow').each(function(){
              if($(this).is(':checked')) {
                 ids2.push($(this).val());
              }
            });
            var ids3 = [];
            $('.catatanRow').each(function(){
				 ids3.push($(this).val());			
            });
           var ids_string = ids.toString();
           var ids_string2 = ids2.toString();
           var ids_string3 = ids3.toString();
		   var nik = "<?php echo $nik;?>";
		   var tgl = "<?php echo $tgl;?>";
		   var ket = $('#ket').val();
		  // alert(ids_string3);
		  //  alert(ket); 
           $.ajax({
              type: "POST",
              url: "module/kasbon_approve/save_act.php",
              data: {data_ids:ids_string,data_item:ids_string2,
			  		 catatan:ids_string3, mode:"simpan_item",
					 nik:nik, tgl:tgl, ket:ket 
					 },
              success: function(result) {
			    //alert('Items Yang disujui !...');
				$('#myRekapDetail').modal("hide");	
                //window.location.reload();
                window.location.href="?p=approval_kasbon_unit";
              },
              async:false
            });

          }
        });
</script>

