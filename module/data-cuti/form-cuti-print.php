<?php
error_reporting(0);

require('../../class.php');
require('../../object.php');


$db->koneksi();

date_default_timezone_set("Asia/Bangkok");

$kar_tampil=$kar->kar_tampil_filter_2(); 

foreach($_REQUEST as $name=>$value)
{
	$$name=$value;
// 	echo "Name: $name : $value;<br />\n";
}

//return;



$page		=$_REQUEST['p'];
$act 		=$_REQUEST['act'];
$id  		=$_REQUEST['id'];    
$kar_id  	=$_REQUEST['id'];    
$ntf_id    	=$_REQUEST['ntf_id'];    
$ntf_read  	=$_REQUEST['ntf_tujuan'];   

$xkar_nik  	=$_REQUEST['xkar_nik'];
$xkar_nm   	=$_REQUEST['xkar_nm'];

//////////////nama atasan//////////////////////////////////////////////////////
$kar_id_atasan = $nik_atasan;
$r_kar_ats = mysql_fetch_array($kar->kar_tampil_id($kar_id_atasan));
$xkar_nm_atasan  = $r_kar_ats['kar_nm'];
//////////////////////////////////////////////////////////

//////////////447=nopita 13=sri handayani//////////////////////////////////////////
$kar_id_sdm = 13;
$r_kar_sdm = mysql_fetch_array($kar->kar_tampil_id($kar_id_sdm));
//$xkar_nm_sdm  = $r_kar_sdm['kar_nm'];
$xkar_nm_sdm  = "Isman Nugraha";
//////////////////////////////////////////////////////////
$r_kar = mysql_fetch_array($kar->kar_tampil_id($kar_id));
$xkar_id  = $r_kar['kar_id'];
$xkar_nik = $r_kar['kar_nik'];
$xkar_nm  = $r_kar['kar_nm'];
$xjbt_nm  = $r_kar['jbt_nm'];
$xdiv_nm  = $r_kar['div_nm'];
$xnota    = $nota;
$xtgl     = $tgl;
/////////////////////////////////////////////////////////
	$sql_cuti = " SELECT b.kar_nik,b.kar_nm,a.* FROM cuti_master a
				  LEFT JOIN kar_master b ON b.kar_id=a.kar_id
				  WHERE a.kar_id = '$id' 
				 ";
	$r = mysql_fetch_array(mysql_query($sql_cuti));
	$detal_act = "./media.php?p=cuti";
	$jml_cuti  = $r['jml_cuti'];
	$adatacuti = explode("#",$r['datacuti']);
	$adataket  = explode("#",$r['dataket']);
	$adatavalid= explode("#",$r['datavalid']);
	$adata_atasan  = explode("#",$r['data_atasan']);
	$adatanota  = explode("#",$r['datanota']);
	////////cuti-sebelumnya////////////
	$tot_cuti_old   = 0;
	for ($i=0 ;$i < 12;$i++){ 
	   if ($adatanota[$i]==$nota){
          break;		  
	   }
	   if ($adatacuti[$i] <> "" ){
	      $tot_cuti_old++;
	   }
	   
	}
	////////cuti-baru////////////
	$aTGLCUTI   = "";
	$aKET       = "";
	$tot_cuti_new   = 0 ;
	for ($i=0 ;$i < 12;$i++){ 
	   if ($adatanota[$i]==$nota){
		 if ($tot_cuti_new > 0 ){
		 	$aTGLCUTI .= ", ";
		 }
	   	 $aTGLCUTI .= $adatacuti[$i];
	   	 $aKET      = $adataket[$i];
		 $tot_cuti_new++;
		  
	   }
	}



$tot_hak_cuti = $jml_cuti - $tot_cuti_old;	
$sisa_cuti  = $tot_hak_cuti - $tot_cuti_new;	
//////////////////////////////////////////////////////
/*
echo '<br>id	= '.$xkar_id ;
echo '<br>nik	= '.$xkar_nik ;
echo '<br>nama	= '.$xkar_nm ;
echo '<br>jabatan= '.$xjbt_nm ;
echo '<br>div	= '.$xdiv_nm ;
echo '<br>Nota	= '.$xnota ;
echo '<br>Tgl	= '.$xtgl ;
echo '<br>Total Cuti  = '.$jml_cuti ;
echo '<br>sebelumnya = '.$tot_cuti_old ;
echo '<br>Hak = '.$tot_hak_cuti ;
echo '<br>baru = '.$tot_cuti_new ;
echo '<br>sisa = '.$sisa_cuti ;
echo '<br>TglCuti = '.$aTGLCUTI ;
echo '<br>Atasan  = '.$atasan ;
echo '<br>Atasan  = '.$xkar_nm_sdm ;
*/
//echo '<br>page : '.$page.' act: '.$act.' id : '.$id.' login : '.$kar_id; 
//return;

?>
<div style="margin-left:50px">
		&nbsp;
		<input style="cursor:pointer" type="button" 
		&nbsp; <input type="button" id="btnExport" value="To PDF / Print " onClick="Export_pdf()" />
<!--		&nbsp;<input type="button" onclick="printDiv('printableArea')" value="Print" /> !-->
		<br />  
</div>
<div id="printableArea" style=";width:600; height:900">
<style>

</style>
<div id="content" style="margin-left:50px; font-family:sans-serif; font-size:15px; font-weight: bold;"> 
	<div id="judul" ><img src="image/cuti-1.jpg" alt="" width="500" height="600" /></div>

    <table style=" margin-top:-517px; font-family:sans-serif; font-size:15px; font-weight: bold;" border="0">
	  <tr>
		  <td>
		  <div style=" margin-left:100px; text-align:left">
		  	<?php echo date('d F Y',strtotime($xtgl)); ?> 
		  </div>
		  </td>
	  </tr>
	  <tr>
		  <td>
		  <div style=" margin-left:100px; margin-top:-5px; text-align:left">
		  	<?php echo $xdiv_nm; ?> 
		  </div>
		  </td>
	  </tr>
	  <tr>
		  <td>
		  <div style=" margin-left:155px; margin-top:5px; text-align:left">
		  	<?php echo $xkar_nm; ?> 
		  </div>
		  </td>
	  </tr>
	  <tr>
		  <td>
		  <div style=" margin-left:155px; margin-top:0px; text-align:left">
		  	<?php echo $xjbt_nm; ?> 
		  </div>
		  </td>
	  </tr>
	  <tr>
		  <td>
		  <div style=" margin-left:155px; margin-top:0px; text-align:left">
		  	<?php echo  $aKET; ?> 
		  </div>
		  </td>
	  </tr>
	  <tr>
	  <td>&nbsp;
     <?php
	  $browser = $_SERVER['HTTP_USER_AGENT'];
  	  $chrome = '/Chrome/';
	  $firefox = '/Firefox/';
	  $ie = '/MSIE/';
		if (preg_match($chrome, $browser)){
//			echo "Chrome/Opera";
		}elseif (preg_match($firefox, $browser)){
//			echo "Firefox";
		  echo '<div style=" margin-left:175px; margin-top:-28px; text-align:left">&nbsp;</div>';			
		}elseif (preg_match($ie, $browser)){
//			echo "Ie";
		}	
	

	 ?>
	 </td>
	 </tr>
	  <tr>
		  <td>
		  <div style=" margin-left:175px; margin-top:30px; text-align:left">
		  <em><font size="+1"> &radic; </font></em>
		  </div>
		  </td>
	  </tr>

	  <tr>
		  <td>
		  <div style=" margin-left:120px; margin-top:18px; text-align:left">
		  	<?php  echo date('F',strtotime($xtgl));; ?> 
		  </div>
		  </td>
	  </tr>
	  <tr>
		  <td>
		  <div style=" margin-left:120px; margin-top:2px; text-align:left">
		  	<?php  echo date('Y',strtotime($xtgl));; ?> 
		  </div>
		  </td>
	  </tr>
	  <tr>
		  <td>
		  <div style=" margin-left:120px; margin-top:2px; text-align:left">
		  	<?php  echo $aTGLCUTI; ?> 
		  </div>
		  </td>
	  </tr>

	  <tr>
		  <td>
		  <div style=" margin-left:280px; margin-top:35px; text-align:left">
		  	<?php  echo $tot_cuti_new; ; ?> Hari
		  </div>
		  </td>
	  </tr>

	  <tr>
		  <td>
		  <div style=" margin-left:280px; margin-top:3px; text-align:left">
		  	<?php  echo $tot_hak_cuti; ?> Hari
		  </div>
		  </td>
	  </tr>

	  <tr>
		  <td>
		  <div style=" margin-left:280px; margin-top:3px; text-align:left">
		  	<?php  echo $sisa_cuti; ; ?> Hari
		  </div>
		  </td>
	  </tr>


	</table>
    <table style=" margin-top:50px" border="0">
	  <tr>
		  <td>
		  <div style="width:105px; text-align:center">
		  	&nbsp; <img src="image/chek-1.png" alt="" width="50" height="50" /></img>
		  </div>
		  </td>
		  <td>
		  <div style="width:105px; text-align:center">
		  	&nbsp; <img src="image/chek-1.png" alt="" width="50" height="50" /></img>
		  </div>
		  </td>
		  <td>
		  <div style="width:105px; text-align:center">
		  	&nbsp; <img src="image/chek-1.png" alt="" width="50" height="50" /></img>
		  </div>
		  </td>
	  </tr>
	</table>
	
    <table style=" margin-left:3px; margin-top:-8px;font-family:sans-serif; font-size:13px; font-weight: bold;" border="0">
	  <tr>
		  <td>
		  	  <div style="width:105px; text-align:center; vertical-align:middle; height:30px; line-height: 0.8;">
				  <u>(<?php echo $xkar_nm;?>)</u>
			  </div>
		  </td>
		  <td>
		  	<div style="width:105px; text-align:center; vertical-align:middle; height:30px; line-height: 0.8;">
			  	<u>(<?php echo $xkar_nm_atasan ;?>)</u>
		    </div>
		  </td>
		  <td>
		  	<div style="width:105px; text-align:center; vertical-align:middle;height:30px; line-height: 0.8;">
		  		<u>(<?php echo $xkar_nm_sdm;?>)</u>
		  	</div>
		  </td>
	  </tr>
	</table>
	<div style="width:496px">
	<table style="margin-top:10px" border="1" cellpadding="0" cellspacing="0" >
		<thead >
		 <tr>
		  <td>
				 <div style="font-size:12px; margin-top:5px">
					 <ul>
						<font style="margin-left:-20px"><b>CATATAN : </b></font>
						<li>1. Lakukan pengecekan  sisa cuti terlebih dahulu </li>
						<li>2. Pastikan sudah berkoordinasi dengan atasan langsung sehingga mempercepat  proses persetujuan cuti</li>  
						<li>3. Pastikan sudah ada backup di sekretariat (bagi karyawan unit)</li>
						<li>4. Pengajuan cuti dilakukan minimal 1 bulan sebelum tanggal cuti</li>  
						<li>5. Segera lakukan konfirmasi ke HRD terkait pengajuan cuti</li>						
						

<!--						
						<li>Data asli dipegang oleh Divisi HRD, Fotocopy 1 lembar dipegang oleh karyawan.</li>
!-->																							
					</ul>
				</div> 	
			</td>	
		 </tr>
		</thead>
	</table>
   </div>

</div>
 
</div> 



<script type="text/javascript" 
	src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.22/pdfmake.min.js">
</script>
<script type="text/javascript"
	 src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.4.1/html2canvas.min.js">
</script>

<script type="text/javascript">
        function Export_pdf() {
		    //alert('xxx');
            html2canvas(document.getElementById('printableArea'), {
                onrendered: function (canvas) {
                    var data = canvas.toDataURL();
                    var docDefinition = {
//					     pageOrientation: 'landscape',
//					     pageOrientation: 'portrait',
                        content: [{
  							image: data,
                            width: 500,
							height:600,
                            }]
                    };
//                  pdfMake.createPdf(docDefinition).download("Tabel.pdf");
					pdfMake.createPdf(docDefinition).open();	

										
                }
            });
        }
		
		function printDiv(divName) {
			 var printContents = document.getElementById(divName).innerHTML;
			 var originalContents = document.body.innerHTML;
		
			 document.body.innerHTML = printContents;
		
			 window.print();
		
			 document.body.innerHTML = originalContents;
		}
		
</script>

