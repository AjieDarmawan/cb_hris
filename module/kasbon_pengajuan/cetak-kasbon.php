<?php
error_reporting(0);
session_start();


/////////////////////////////////////////////////////////////////////////////
//include '../../js/ajax.php'; 
include "cetak_kasbon_act.php";
/////////////////////////////////////////////////////////////////////////////
$data=json_decode($_SESSION['dataku'],true);
$jmldata = count($data);
if ($jmldata ==0 ){
   echo '<center><font size="3" color="red"> Data Kosong !... </font></center>';
   return;
}

//var_dump($data);
//echo $data;
/*
for($a=0; $a < $jmldata; $a++)
{
  echo '<br>'.($a+1).' - '.$data[$a]['kpt'];  
  if ($a >= 10){
     break;
  }
}
*/
/*
echo '<pre>';
print_r($data);
echo '</pre>';
*/
$tgl_pengajuan = date('d-m-Y',strtotime($tgl));
$nama  = $data[0]['nama'];
$nama_acc = "Dewi";

?>
&nbsp; <input type="button" onClick="printDiv('printableArea')" value="Print" />

<br />  
<br /> 



<div id="printableArea">
<body>
<table  border="0" width="100%" align="center" 
	style=" border-collapse:collapse; font-family:Arial, Helvetica, sans-serif; font-size:12px" >
	<tr>
	<td></td>
	<td colspan="7"><font size="+1">Pengajuan Kasbon Operasional  </font></td>
	</tr>
	<tr>
	<td></td>
	<td colspan="2" style="vertical-align:middle;padding:0px 3px 0px 3px">Kampus</td>
	<td colspan="15" > : <b><?php echo $kampus; ?></b></td>
	</tr>
	<tr>
	<td></td>
	<td colspan="2" style="vertical-align:middle;padding:0px 3px 0px 3px">Nama</td>
	<td colspan="15" > : <b><?php echo $nama; ?></b></td>
	</tr>
	<tr>
	<td></td>
	<td colspan="2" style="vertical-align:middle;padding:0px 3px 0px 3px">Hari / Tangal </td>
	<td colspan="15"> : <b><?php echo $tgl_pengajuan; ?> </b></td>
	</tr>
	<tr>
    <tr style="">
	   <th></th>
	   <th colspan="1" rowspan="1" style="border:1px solid; vertical-align:middle;text-align:center">#</th>
	   <th colspan="1" rowspan="1" 
	   style="border:1px solid; vertical-align:middle;text-align:center">Kode</th>
	   <th colspan="1" rowspan="1" style="border:1px solid; vertical-align:middle;text-align:center">Nama Barang</th>
	   <th colspan="1" rowspan="1" style="border:1px solid; vertical-align:middle;text-align:center">QTY</th>
       <th style="border:1px solid; vertical-align:middle;text-align:center;">Harga</th>
       <th style="border:1px solid; vertical-align:middle;text-align:center;">Jumlah</th>
       <th style="border:1px solid; vertical-align:middle;text-align:center;">Ket</th>
    </tr>
<?php
$no = 1; // Untuk penomoran tabel, di awal set dengan 1
$tot_global=0;
for($a=0; $a < $jmldata; $a++)
{
  if ($data[$a]['status']=="1"){
     $tot_global += $data[$a]['total'];
  }
  ?>  
    <tr  style=" " >
	<td></td>
    <td style="width:7mm; border:1px solid;  vertical-align:middle;text-align:center; ">
	<?php echo $no ;?>
	</td>
    <td style="border:1px solid; vertical-align:middle;text-align:center;padding:0px 3px 0px 3px">
	<?php echo $data[$a]['kode_barang']; ?> 
	</td>
    <td style="border:1px solid; vertical-align:middle;text-align:left;padding:0px 3px 0px 3px">
	<?php echo $data[$a]['nama_barang']; ?>
	</td>
    <td style="border:1px solid; vertical-align:middle;text-align:center;padding:0px 3px 0px 3px">
	<?php echo $data[$a]['qty']; ?>
	</td>
    <td style="border:1px solid; vertical-align:middle;text-align:center;padding:0px 3px 0px 3px">
	<?php echo number_format( $data[$a]['harga'],0,",","."); ?>
	</td>
    <td style="border:1px solid; vertical-align:middle;text-align:right;padding:0px 3px 0px 3px">
	<?php echo number_format( $data[$a]['total'],0,",","."); ?>
	</td>
    <td style="border:1px solid; vertical-align:middle;text-align:left;padding:0px 3px 0px 3px">
	<?php echo $data[$a]['catatan']; ?>
	</td>


    </tr>
  <?php  $no++; } ?>
    <tr >
    <th></th>	
    <th rowspan="1" colspan="4" align="right" style="border:0px solid; ">&nbsp;</th>
    <th rowspan="1" colspan="1" align="right" style="border:1px solid; ">TOTAL ( RUPIAH ) &nbsp;</th>
    <th style="border:1px solid; vertical-align:middle;text-align:right;padding:0px 3px 0px 3px">
	<?php echo number_format($tot_global,0,",","."); ?>
	</th>

	</tr>
	<tr>
	<td></td>
	<td colspan="17" rowspan="1" style=" height:10mm;"> 
	</td>
	</tr>
	<tr>
	<td></td>
	<td colspan="5" rowspan="1" style=" height:20mm;   ;">
	   Penerima Kas Bon
	   <br />
	   Diterima Tgl. ........................
	   <br />
	   <br />
	   <br />
	   <br />
       <u>( <?php echo $nama;?> )</u> 
	   <br>
	   Pemohon	   
	     
	</td>
	<td colspan="5" rowspan="1" style=" height:20mm;   ;">
	   Approval
	   <br />
	   <br />
	   <br />
	   <br />
	   <br />
       <u>( <?php echo $nama_acc ;?> )</u>
	   <br>
	   Keuangan	   
	     
	</td>

	</tr>

	
</table>
</body>
</div>

<script>

	function printDiv(divName) {
		 var printContents = document.getElementById(divName).innerHTML;
		 var originalContents = document.body.innerHTML;
		 document.body.innerHTML = printContents;
		 window.print();
		 document.body.innerHTML = originalContents;
	};
	
</script>




