<?php
	error_reporting(0);
	date_default_timezone_set('Asia/Jakarta');
	session_start();
	
	require('../../class.php');
	require('../../object.php');
	
	$db->koneksi();

	foreach($_REQUEST as $name=>$value)
	{
			$$name=$value;
			//echo "$name : $value;<br />\n";
    }	
	
function kekata($x) {
    $x = abs($x);
    $angka = array("", "satu", "dua", "tiga", "empat", "lima",
    "enam", "tujuh", "delapan", "sembilan", "sepuluh", "sebelas");
    $temp = "";
    if ($x <12) {
        $temp = " ". $angka[$x];
    } else if ($x <20) {
        $temp = kekata($x - 10). " belas";
    } else if ($x <100) {
        $temp = kekata($x/10)." puluh". kekata($x % 10);
    } else if ($x <200) {
        $temp = " seratus" . kekata($x - 100);
    } else if ($x <1000) {
        $temp = kekata($x/100) . " ratus" . kekata($x % 100);
    } else if ($x <2000) {
        $temp = " seribu" . kekata($x - 1000);
    } else if ($x <1000000) {
        $temp = kekata($x/1000) . " ribu" . kekata($x % 1000);
    } else if ($x <1000000000) {
        $temp = kekata($x/1000000) . " juta" . kekata($x % 1000000);
    } else if ($x <1000000000000) {
        $temp = kekata($x/1000000000) . " milyar" . kekata(fmod($x,1000000000));
    } else if ($x <1000000000000000) {
        $temp = kekata($x/1000000000000) . " trilyun" . kekata(fmod($x,1000000000000));
    }     
        return $temp;
}
 

function terbilangx($x, $style=4) {
    if($x<0) {
        $hasil = "minus ". trim(kekata($x));
    } else {
        $hasil = trim(kekata($x));
    }     
    switch ($style) {
        case 1:
            $hasil = strtoupper($hasil);
            break;
        case 2:
            $hasil = strtolower($hasil);
            break;
        case 3:
            $hasil = ucwords($hasil);
            break;
        default:
            $hasil = ucfirst($hasil);
            break;
    }     
    return $hasil;
}


	function tgl_indo($tgl){
			$tanggal = substr($tgl,8,2);
			$bulan = getBulan(substr($tgl,5,2));
			$tahun = substr($tgl,0,4);
			return $tanggal.' '.$bulan.' '.$tahun;		 
	}	

	function getBulan($bln){
				switch ($bln){
					case 1: 
						return "Januari";
						break;
					case 2:
						return "Februari";
						break;
					case 3:
						return "Maret";
						break;
					case 4:
						return "April";
						break;
					case 5:
						return "Mei";
						break;
					case 6:
						return "Juni";
						break;
					case 7:
						return "Juli";
						break;
					case 8:
						return "Agustus";
						break;
					case 9:
						return "September";
						break;
					case 10:
						return "Oktober";
						break;
					case 11:
						return "November";
						break;
					case 12:
						return "Desember";
						break;
				}
			} 
			
	
    ////////////////////////////////////////	
	$cek_nik = $_SESSION['kar'];
	$xtgl_ctk  =  date(' D, d M Y h:i:s',strtotime($tgl_ctk));
	$judul = 'Cetak-Nota';
 


	$SQL = "			
			SELECT 
			a.*,
			b.kar_nik,b.kar_nm as peminjam,
			c.kar_nm as nm_ketua,
			d.kar_nm as nm_bendahara,
			e.kar_dtl_tgl_joi as tgl_masuk_kerja,
			e.kar_dtl_tlp as nohp,e.kar_dtl_alt as alamat,
			b.kar_tgl_lahir 
			FROM _paguyuban_master a 
			LEFT JOIN kar_master b ON b.kar_id = a.pg_kar_id
			LEFT JOIN kar_master c ON c.kar_id = a.pg_ketua_id 
			LEFT JOIN kar_master d ON d.kar_id = a.pg_bendahara_id 
			LEFT JOIN kar_detail e ON e.kar_id = a.pg_kar_id 
			WHERE 1=1  AND a.pg_id='$id' 
			" ;
					
	$sResult = mysql_query($SQL);		
	$r = mysql_fetch_array($sResult);	
	
	$kar_nik 	  = $r['kar_nik'];
	$kar_nm  	  = $r['peminjam'];
	$tgllahir     = date('m-d-Y',strtotime($r['kar_tgl_lahir']));
	$nohp 	  	  = $r['nohp'];
	$alamat	  	  = $r['alamat'];
	$nm_ketua	  = $r['nm_ketua'];
	$nm_bendahara = $r['nm_bendahara'];
	$jml_pinjaman = number_format($r['pg_pinjaman']);
	$jml_lama 	  = number_format($r['pg_lama']);
	$jml_angsuran = number_format($r['pg_pinjaman']/$r['pg_lama']);	
	$jml_bayar 	  = number_format($r['pg_bayar']);	
	$jml_sisa 	  = number_format($r['pg_pinjaman']-$r['pg_bayar']);	
	$norek		  = $r['pg_norek'];	
	$keterangan	  = $r['pg_ket'];	
	$nonota		  = $r['pg_nomor'];	
	$tanggal  	  = $r['pg_tanggal'];
	
	

//	echo $SQL.'<br>'.$kar_nik,'/'.$kar_nm; return;	 

	ob_start();
				
?>

<html xmlns="http://www.w3.org/1999/xhtml"> <!-- Bagian halaman HTML yang akan konvert -->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title><?php echo $judul; ?></title>
</head>
<style type="text/css" >


</style>

<body>

	<page_header  >

		<table width="80%"  border="0mm" class="page_footer" 
		style="border-collapse: collapse; margin-left:5mm; font-size:16px;line-height:14px;   ">
		<tr>
		
	   	<td   colspan="3"  align="left" style="width:180mm">
			 <div style="width:20mm; height:50px; margin-left:0mm" >
			  <img src="../../dist/img/logo_gg_small130.JPG" width="80" height="80">				 
			 </div>
			<div style=" margin-left:25mm ; margin-top:-20mm">
				Jl. Bumi Sentosa Raya Blok A3 No.3, A1 No. 5-8  Perum Bumi Sentosa
				<br>
				Cibinong, Bogor, Jawa Barat 16912 
				<br>&nbsp;
			</div>	
			<div style="margin-left:25mm;  margin-top:0mm;
						background:#666666; color:#FFFFFF; 
						width:152mm; text-align:center; line-height:6mm; 
						padding:1mm 1mm 1mm 1mm">
			  <font size="+1">
			  FORMULIR PENGAJUAN PINJAMAN PAGUYUBAN
			  <BR>
			  KELUARGA BESAR GILLAND GROUP
			  </font>
			</div>			


		  </td>
<!--		  
		  <td  colspan="2"  align="left" style="width:150mm;"  >
			<div style=" margin-left:-120mm ; width:150mm;">
				Jl. Bumi Sentosa Raya Blok A3 No.3, A1 No. 5-8  Perum Bumi Sentosa
				<br>
				Cibinong, Bogor, Jawa Barat 16912 
				<br>&nbsp;
			</div>		  
			<div style="margin-left:-120mm;background:#666666; color:#FFFFFF; 
						width:152mm; text-align:center; line-height:6mm; 
						padding:1mm 1mm 1mm 1mm">
			  <font size="+1">
			  FORMULIR PENGAJUAN PINJAMAN ANGGOTA PAGUYUBAN
			  <BR>
			  KELUARGA BESAR SINGO GROUP
			  </font>
			</div>
		  </td>
!-->	  
		</tr>

		<tr>
		<td colspan="3">
		    <div style="width:180mm">
			 <hr >
			</div>
		</td>
		</tr>
		<tr >
		<td   colspan="3"  > 
			<div style=" width:180mm;font-size: 18px; margin-top:-5mm;
					letter-spacing:2px; line-height:20px; text-align:center">
				<u><b>NOMOR : <?php echo $nonota;?></b></u>
			</div>
		</td>
		</tr>	
		
		<tr>
		 <td colspan="3" style="width:180mm" >
		    <div style="width:180mm; line-height:5mm; ">
			     <div >Yang bertanda tangan dibawah ini</div>
				 <div style="width:50mm; margin-left:5mm">NIK</div> 
				 <div style="width:130mm; margin-left:50mm ;margin-top:-5mm"> : </div> 
				 <div style="width:130mm; margin-left:55mm ;margin-top:-5mm"><b><?php echo $kar_nik;?></b></div> 
				 <div style="width:50mm; margin-left:5mm">Nama</div> 
				 <div style="width:130mm; margin-left:50mm ;margin-top:-5mm"> : </div> 
				 <div style="width:130mm; margin-left:55mm ;margin-top:-5mm"><b><?php echo $kar_nm;?></b></div> 
				 <div style="width:50mm; margin-left:5mm">Tempat / Tgl.Lahir</div> 
				 <div style="width:130mm; margin-left:50mm ;margin-top:-5mm"> : </div> 
				 <div style="width:130mm; margin-left:55mm ;margin-top:-5mm"><b><?php echo $tgllahir;?></b></div> 
				 <div style="width:50mm; margin-left:5mm">Alamat</div> 
				 <div style="width:130mm; margin-left:50mm ;margin-top:-5mm"> : </div> 
				 <div style="width:130mm; margin-left:55mm ;margin-top:-5mm"><b><?php echo $alamat;?></b></div> 
				 <div style="width:50mm; margin-left:5mm">NoTelephone</div> 
				 <div style="width:130mm; margin-left:50mm ;margin-top:-5mm"> : </div> 
				 <div style="width:130mm; margin-left:55mm ;margin-top:-5mm"><b><?php echo $nohp;?></b></div> 

			</div>
		 </td>
		</tr>


		<tr>
		 <td colspan="3" style="width:180mm" >
		    <div style="line-height:5mm; margin-top:5mm" >
			Adalah anggota Paguyuban Gilland Group.<br>
			Dengan ini saya akan mengajukan pinjaman paguyuban sebesar :<br>
			Rp <b> <?php echo $jml_pinjaman;?> </b><br>
			Terbilang ( <?php echo terbilangx($r['pg_pinjaman']);?> rupiah )<br>
			Yang akan saya gunakan untuk : <b><?php echo $keterangan; ?></b><br>
			Dan saya akan mengembalikan pinjaman tersebut dengan cara diangsur tiap bulan<br>
			Selama <b><?php echo $jml_lama;?></b> bulan, sebesar <b> Rp <?php echo $jml_angsuran;?> </b>/ Bulan<br>
			Demikian permohonan ini saya sampaikan, terima kasih.<br><br>
			Cibinong, <?php echo tgl_indo($tanggal);?> <br><br>
			Peminjam,<br><br><br>
			( <?php echo $kar_nm;?> )
			
			</div>
		 </td>
		</tr>
		
		<tr>
		  <td colspan="3" style="width:180mm">&nbsp;</td>
		</tr>
		

		
					
	  </table>

	<table width="80%"  border="0mm" 
			style="border-collapse: collapse; margin-left:5mm; font-size:16px;line-height:14px;   ">
	
			<tr>
			  <td style="width:50mm; " >
				<div  style="margin-top:0mm">
				   Mengetahui,
				   <br><br><br> <br><br><br>
				   <u>Siti Rahayu</u><br>Bendahara
				</div>
			  </td>
			  <td  style="width:50mm;" >
				<div style="margin-top:8mm">
				   Menyetujui,
				   <br><br><br> <br><br><br>
				   <u>Suyanto</u><br>Ketua
				</div>
			  </td>
			  <td  style="width:50mm;" >
<!--			  
				<div  style="margin-top:8mm">
				   Menyetujui,
				   <br><br><br> <br><br><br>
				   (.................)
				</div>
!-->				
			  </td>
			  
			</tr>    	  
	</table>	  

	  
	</page_header>

  
</body>
</html>



<?php

 
	$filename="NOTA-".$nonota.".pdf"; 
	$content = ob_get_clean();
	$content = $content;
	
 //	echo 'xxxx';return;
	
//   require_once(dirname(__FILE__).'/html2pdf/html2pdf.class.php');
	require_once('../../_html2pdf/html2pdf.class.php');

 	
	try
	{
		//$html2pdf = new HTML2PDF('P','A4','en', false, 'ISO-8859-15',array(30, 0, 20, 0));
		$html2pdf = new HTML2PDF('P','A4','en');
		//$html2pdf->setDefaultFont('Arial');
		//$html2pdf->setDefaultFont('Arial');
		$html2pdf->writeHTML($content, isset($_GET['vuehtml']));
		$html2pdf->Output($filename);
	}
	catch(HTML2PDF_exception $e) { echo $e; }
?>