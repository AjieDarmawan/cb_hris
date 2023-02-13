<?php

session_start();
error_reporting(0);
date_default_timezone_set('Asia/Jakarta');
require('../../class.php');
require('../../object.php');
$db->koneksi();

foreach($_REQUEST as $name=>$value)
{
		$$name=$value;
		//echo " $name : $value;<br />\n";
}


//echo 'test-export-to-execl => '.$_REQUEST['act'].'<br>';



if ($drtgl !="" ){
   $tgl = date('d-m-Y',strtotime($drtgl)).' s/d '.date('d-m-Y',strtotime($sdtgl));
}
if ($act=='excel'){
   $filexls="data-cuti-karyawan.xls";
   header("Content-type: application/vnd-ms-excel");
   header("Content-Disposition: attachment; filename=$filexls");
}
$color_head='bgcolor="#CCCCCC""';


?>
<table >
<tr>
 <td colspan="4"><b>PT.Gilland Ganesha </b></td>
</tr>
<tr>
 <td colspan="4"><b>Data Cuti Karyawan</b></td>
</tr>

</table>
<table border="1" width="100%" align="center" style=";border-collapse: collapse; font-family:Arial, Helvetica, sans-serif; font-size:11px" >

		<tr bgcolor="#CCCCCC"  style="font-size:13px" >
			<th style="vertical-align:middle;text-align:center;">#</th>
			<th style="vertical-align:middle;text-align:center">Devisi</th>
			<th style="vertical-align:middle;text-align:center">NIK</th>
			<th style="vertical-align:middle;text-align:center">Nama</th>
			<th style="vertical-align:middle;text-align:center;">Jabatan</th>
			<th style="vertical-align:middle;text-align:center;">Hak Cuti</th>
			
			<th style="vertical-align:middle;text-align:center">Cuti di Ambil</th>
			<th style="vertical-align:middle;text-align:center">Sisa Cuti</th>
	
			<th style="vertical-align:middle;text-align:center">Tanggal Cuti</th>

			<th style="vertical-align:middle;text-align:center">Simpan Libur</th>

		
		 
		</tr>


  <?php
				//$_REQUEST['id'] = '499';
				//$filter_nik = " AND a.kar_id = '".$_REQUEST['id']."' ";
				$filter_nik = '';
				$sql  =" SELECT 
						e.tahun,a.kar_id,a.kar_nik as nik,a.kar_nm as nama,d.jbt_nm as jabatan,
						c.div_nm as divisi,
						b.kar_dtl_sts_krj as status,e.jml_cuti,e.jml_simpan_libur, e.sisa_cuti, e.datacuti,
						e.dataket, e.simpan_libur, e.simpan_libur_ambil
						FROM kar_master a
						LEFT JOIN kar_detail b ON b.kar_id=a.kar_id 
						LEFT JOIN div_master c ON c.div_id=a.div_id
						LEFT JOIN jbt_master d ON d.jbt_id=a.jbt_id
						LEFT JOIN cuti_master e ON e.kar_id=a.kar_id
						WHERE b.kar_dtl_sts_krj='A' and kar_dtl_typ_krj <> 'Resign'  $filter_nik 
						ORDER BY c.div_nm, a.kar_nik
						 ";		
						 			
												
					$q_cuti   = mysql_query($sql);
					$no=0;
				while ($r=mysql_fetch_array($q_cuti)){
				   $no++;
//				   $acuti = explode('#',$eco->dcrypt($r['datacuti']));	
				  	  $acuti = $r['datacuti'];	
				   	  $aket  = $r['dataket'];	

  					  $xcuti =explode("#",$acuti);
  					
					  $j_cuti = 0; 
					  for ($i=0; $i<count($xcuti); $i++ ) { 
					     if ($xcuti[$i] != ""){
						    $j_cuti++ ;
						 } 		 
					   } ;
					  $sisa_cuti = $r['jml_cuti'] - $j_cuti; 
					  
				      $xsisa_cuti ='<span class="label label-primary">'.$sisa_cuti.
						             '</span>'.'&nbsp;&nbsp;' ;
					  
					  if ($sisa_cuti < 0 ){
					     $xsisa_cuti ='<span class="label label-danger">'.$sisa_cuti.
						             '</span>'.'&nbsp;&nbsp;' ;
					  } 
					
		
  ?>  
    <tr align="left" style="background:white;" >
    <td style="width:5mm; vertical-align:middle;text-align:center; padding:0px 3px 0px 3px ">
	<?php echo $no ;?>
	</td>
    <td style="width:30mm;vertical-align:middle;padding:0px 3px 0px 3px"><?php echo $r['divisi'];; ?></td>
    <td style="width:10mm;vertical-align:middle;text-align:center;padding:0px 3px 0px 3px">
	<?php echo $r['nik'];?>
	</td>
    <td style="width:30mm;vertical-align:middle;text-align:center;padding:0px 3px 0px 3px">
	<?php echo $r['nama'];?>
	</td>	
    <td style="width:20mm;vertical-align:middle;text-align:left;padding:0px 3px 0px 3px">
	<?php echo $r['jabatan']; ?></td>	
    <td style="width:10mm;vertical-align:middle;padding:0px 3px 0px 3px; text-align:right">
	<?php echo $r['jml_cuti'];?>
	 </td>
    <td style="width:10mm;vertical-align:middle;text-align:right;padding:0px 3px 0px 3px;text-align:right">
   <?php echo $j_cuti;?>

	</td>
    <td style="width:10mm;vertical-align:middle;text-align:right;padding:0px 3px 0px 3px;text-align:right">
	 <?php echo $xsisa_cuti ;?>
	</td>

    <td style="width:60mm;vertical-align:middle;text-align:left;padding:0px 3px 0px 3px">
						<?php 
					   $xtgl  =explode("#",$acuti);
					   $xket  =explode("#",$aket);
					   $x = 0 ;
					   echo '<ol>';
					   for ($i=0; $i<count($xtgl); $i++ ) { 
					     if ($xtgl[$i] != ""){
						   $text_ket = "";
						   if ($xket[$i] !=""){
						      $text_ket = '<span class="label label-primary" >'.' '.$xket[$i].' '.'</span>';
						   }
						   $text_tgl = $xtgl[$i].":".$text_ket;
			   		 
						   echo '<li> ) <b>'.$text_tgl.'</b></li>';
						 } 		 
					   } ;
					   echo '</ol>';
					?>
	</td>
    <td style="width:40mm;vertical-align:middle;text-align:left;padding:0px 3px 0px 3px;">
					<?php 
					   $xtgl2  =explode("#",$r['simpan_libur']);
					   $xtgl3  =explode("#",$r['simpan_libur_ambil']);
					   $x = 0 ;
					   for ($i=0; $i<count($xtgl2); $i++ ) { 
					     if ($xtgl2[$i] != "" and  $xtgl3[$i] == "" ){
							 if ($xtgl2[$i] != ""){
							   $text_ket = "";
							   if ($xtgl2[$i] <> ""){
								  $text_ket = '<span class="label label-primary">'.' simpan libur '.'</span>';
							   }
							   $text_tgl = date('d-m-Y',strtotime($xtgl2[$i]))." ".$text_ket;
							   $x++;
							   echo $x.')<a  class="label label-danger" title="'.$xket[$i].'" >'.$text_tgl.
									 '</a>'.'&nbsp;&nbsp;' ;
							   echo '<br>';		 
							 } 		 
						 }
					   } ;
					?>
	</td>	
    </tr>
  <?php  $no++; } ?>
</table>

