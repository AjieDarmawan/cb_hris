<?php
error_reporting(E_ALL ^ E_NOTICE);
date_default_timezone_set('Asia/Jakarta');
session_start();

$date=date('Y-m-d');
$time=date('H:i:s');

if(isset($_POST['bexportpdf'])){
	ob_start();
        
        require('class.php');
        require('object.php');
        $dbs->koneksi();
        
        $nosel_id=$_POST['nosel'];
        if(!empty($_SESSION['username'])){
            $sesi_username=$_SESSION['username'];
            $kodept = strtolower(preg_replace('/[0-9]+/', '', substr($sesi_username,0,3)));	
        }
	$tb_pts = $kodept;
        
        $flp_tampil_nosel=$flp->flp_tampil_nosel($tb_pts,$nosel_id);
	$flp_data_nosel=mysql_fetch_array($flp_tampil_nosel);
	$result=mysql_num_rows($flp_tampil_nosel);

	$mhs_cek_nosel=explode(",",$flp_data_nosel['mhs']);
	$ayah_cek_nosel=explode(",",$flp_data_nosel['ayah']); 
	$ibu_cek_nosel=explode(",",$flp_data_nosel['ibu']);
        
        $unv_tampil=$unv->unv_tampil($kodept);
        $unv_data=mysql_fetch_array($unv_tampil);

        $pecah_thn=explode("-",$date);
        $pecah_1=$pecah_thn[0];
        
        $tahun_akd=$pecah_1;
        $tahun_smp_akd=$pecah_1 +  1;
                
            echo"
            
            <style>
            table{
                margin:20px;
                font-size:8px;
            }
            table td{
                padding:3px;
            }
            </style>

            <table cellpadding='5' cellspacing='0' border='1'>

                <tr>

                    <td colspan='3'>

                       <img src='http://120.89.88.99/sipema/_img/_logo/logo_".$kodept.".jpg' style='float: left; margin-right: 10px;margin-left: 15px; width:50px'>

                       <p style='font-size: 10px; font-weight: bold; text-align:center;'>

                           DETAIL DATA ISIAN MAHASISWA BARU<br>

                           ".strtoupper($unv_data['namapt'])." <br>

                          TAHUN AJARAN ".$tahun_akd." / ".$tahun_smp_akd." <!--(".strtoupper($semester).")-->

                       </p>	  

                    </td>

                </tr>

                <tr>

                <td style='height:5px; width:5px; vertical-align:middle;'>1.</td>

                <td style='vertical-align:middle;'>Nama Lengkap</td>

                <td>".$flp_data_nosel['nama']."

                </td>

                </tr>



                <tr>

                <td style='height:5px; width:5px; vertical-align:middle;'>2.</td>

                <td style='vertical-align:middle;'>Jurusan / Program Studi</td>

                <td>".$flp_data_nosel['jurusan']."

                </td>

                </tr>



                <tr>

                <td style='height:5px; width:5px; vertical-align:middle;'>3.</td>

                <td style='vertical-align:middle;'>Npm</td>

                <td>".$flp_data_nosel['npm']."

                </td>

                </tr>



                <tr>

                <td style='height:5px; width:5px; vertical-align:middle;'>4.</td>

                <td style='vertical-align:middle;'>Tanggal Lahir</td>

                <td>";


                 if($flp_data_nosel['tgl_lahir']=="0000-00-00"){

                    $lahir="";

                 }else{

                    $lahir=$flp_data_nosel['tgl_lahir'];

                 }


                 $lahir = date('d-m-Y',strtotime($flp_data_nosel['tgl_lahir'])); 
                
                echo"
                
                 ".$lahir."
                
                </td>

                </tr>



                <tr>

                <td style='height:5px; width:5px; vertical-align:middle;'>5.</td>

                <td style='vertical-align:middle;'>Tempat Lahir</td>

                <td>".$flp_data_nosel['tmt_lahir']."

                </td>

                </tr>



                <tr>

                <td style='height:5px; width:5px; vertical-align:middle;'>6.</td>

                <td style='vertical-align:middle;'>Jenis Kelamin</td>

                <td>".$flp_data_nosel['kelamin']."

                </td>

                </tr>

                

                <tr>

                <td style='height:5px; width:5px; vertical-align:middle;'>7.</td>

                <td style='vertical-align:middle;'>NIK</td>

                <td>".$flp_data_nosel['nik']."

                </td>

                </tr>



                <tr>

                <td style='height:5px; width:5px; vertical-align:middle;'>8.</td>

                <td style='vertical-align:middle;'>Sekolah asal</td>

                <td>".$flp_data_nosel['sekolah']."

                </td>

                </tr>



                <tr>

                <td style='height:5px; width:5px; vertical-align:middle;'>9.</td>

                <td style='vertical-align:middle;'>Jurusan Sekolah asal</td>

                <td>".$flp_data_nosel['jur_sekolah']."

                </td>

                </tr>



                <tr>

                <td style='height:5px; width:5px; vertical-align:middle;'>10.</td>

                <td style='vertical-align:middle;'>Alamat Sekolah asal</td>

                <td>".$flp_data_nosel['alm_sekolah']."

                </td>

                </tr>



                <tr>

                <td style='height:5px; width:5px; vertical-align:middle;'>11.</td>

                <td style='vertical-align:middle;'>NISN</td>

                <td>".$flp_data_nosel['nisn']."

                </td>

                </tr>



                <tr>

                <td style='height:5px; width:5px; vertical-align:middle;'>12.</td>

                <td style='vertical-align:middle;'>Mahasiswa Pindahan / Program Lanjut</td>

                <td></td>

                </tr>

                <tr>

                <td></td>

                <td style='vertical-align:middle;'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;A.&nbsp;&nbsp;PTS Asal</td>

                <td>".$flp_data_nosel['pts_asl']."

                </td>

                </tr>

                <tr>

                <td></td>

                <td style='vertical-align:middle;'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;B.&nbsp;&nbsp;Jurusan / Program Studi asal</td>

                <td>".$flp_data_nosel['jrs_asal']."

                </td>

                </tr>

                <tr>

                <td></td>

                <td style='vertical-align:middle;'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;C.&nbsp;&nbsp;NPM Asal</td>

                <td>".$flp_data_nosel['npm_asal']."

                </td>

                </tr>

                <tr>

                <td></td>

                <td style='vertical-align:middle;'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;D.&nbsp;&nbsp;Tanggal Lulus</td> 

                <td>";


                 if($flp_data_nosel['tgl_lulus']=="0000-00-00"){

                    $lulus="";

                 }else{

                    $lulus=$flp_data_nosel['tgl_lulus'];

                 }

                echo"
                
                ".$lulus."

                </td>

                </tr>



                <tr>

                <td style='height:5px; width:5px; vertical-align:middle;'>13.</td>

                <td style='vertical-align:middle;'>Alamat Rumah</td>

                <td>".$flp_data_nosel['alm_rmh']."

                </td>

                </tr>



                <tr>

                <td style='height:5px; width:5px; vertical-align:middle;'>14.</td>

                <td style='vertical-align:middle;'>Telepon Rumah</td>

                <td>".$flp_data_nosel['tlp_rmh']."

                </td>

                </tr>



                <tr>

                <td style='height:5px; width:5px; vertical-align:middle;'>15.</td>

                <td style='vertical-align:middle;'>Hp</td>

                <td>".$flp_data_nosel['hp']."

                </td>

                </tr>



                <tr>

                <td style='height:5px; width:5px; vertical-align:middle;'>16.</td>

                <td style='vertical-align:middle;'>Email</td>

                <td>".$flp_data_nosel['email']."

                </td>

                </tr>



                <tr>

                <td style='height:5px; width:5px; vertical-align:middle;'>17.</td>

                <td style='vertical-align:middle;'>Agama</td>

                <td>".$flp_data_nosel['agama']."

                </td>

                </tr>



                <tr>

                <td style='height:5px; width:5px; vertical-align:middle;'>18.</td>

                <td style='vertical-align:middle;'>Penerima KPS</td>

                <td>".$flp_data_nosel['kps']."

                </td>

                </tr>



                <tr>

                <td style='height:5px; width:5px; vertical-align:middle;'>19.</td>

                <td style='vertical-align:middle;'>Orang Tua</td>

                <td></td>

                </tr>

                <tr>

                <td></td>

                <td style='vertical-align:middle;'>A.)&nbsp;&nbsp;Ayah</td>

                <td></td>

                </tr>

                <tr>

                <td></td>

                <td style='vertical-align:middle;'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;1.&nbsp;&nbsp;Nama Lengkap</td>

                <td>".$flp_data_nosel['nm_ayah']."

                </td>

                </tr>

                <tr>

                <td></td>

                <td style='vertical-align:middle;'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;2.&nbsp;&nbsp;Tanggal Lahir</td>

                <td>";

                 if($flp_data_nosel['tgl_lhr_ayah']=="0000-00-00"){

                    $lahir_ayah="";

                 }else{

                    $lahir_ayah=$flp_data_nosel['tgl_lhr_ayah'];

                 }


                echo"
                
                ".$lahir_ayah."

                </td>

                </tr>

                <tr>

                <td></td>

                <td style='vertical-align:middle;'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;3.&nbsp;&nbsp;Tempat Lahir</td>

                <td>".$flp_data_nosel['tmt_lhr_ayah']."

                </td>

                </tr>

                <tr>

                <td></td>

                <td style='vertical-align:middle;'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;4.&nbsp;&nbsp;NIK</td>

                <td>".$flp_data_nosel['nik_ayah']."

                </td>

                </tr>

                <tr>

                <td></td>

                <td style='vertical-align:middle;'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;5.&nbsp;&nbsp;Pendidikan</td>

                <td>".$flp_data_nosel['pnd_ayah']."

                </td>

                </tr>

                <tr>

                <td></td>

                <td style='vertical-align:middle;'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;6.&nbsp;&nbsp;Alamat Rumah Lengkap</td>

                <td>".$flp_data_nosel['alm_ayah']." 

                </td>

                </tr>

                <tr>

                <td></td>

                <td style='vertical-align:middle;'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;7.&nbsp;&nbsp;Pekerjaan</td>

                <td>".$flp_data_nosel['pek_ayah']."

                </td>

                </tr>

                <tr>

                <td></td>

                <td style='vertical-align:middle;'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;8.&nbsp;&nbsp;Penghasilan</td>

                <td>".$flp_data_nosel['hsl_ayah']."

                </td>

                </tr>

                <tr>

                <td></td>

                <td style='vertical-align:middle;'>B.)&nbsp;&nbsp;Ibu</td>

                <td></td>

                </tr>

                <tr>

                <td></td>

                <td style='vertical-align:middle;'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;1.&nbsp;&nbsp;Nama Lengkap</td>

                <td>".$flp_data_nosel['nm_ibu']."

                </td>

                </tr>

                <tr>

                <td></td>

                <td style='vertical-align:middle;'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;2.&nbsp;&nbsp;Tanggal Lahir</td>

                <td>";
                
                 if($flp_data_nosel['tgl_lhr_ibu']=="0000-00-00"){

                    $lahir_ibu="";

                 }else{

                    $lahir_ibu=$flp_data_nosel['tgl_lhr_ibu'];

                 }


               echo"
               
               ".$lahir_ibu."

                </td>

                </tr>

                <tr>

                <td></td>

                <td style='vertical-align:middle;'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;3.&nbsp;&nbsp;Tempat Lahir</td>

                <td>".$flp_data_nosel['tmt_lhr_ibu']."

                </td>

                </tr>

                <tr>

                <td></td>

                <td style='vertical-align:middle;'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;4.&nbsp;&nbsp;NIK</td>

                <td>". $flp_data_nosel['nik_ibu']."

                </td>

                </tr>

                <tr>

                <td></td>

                <td style='vertical-align:middle;'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;5.&nbsp;&nbsp;Pendidikan</td>

                <td>".$flp_data_nosel['pnd_ibu']."

                </td>

                </tr>

                <tr>

                <td></td>

                <td style='vertical-align:middle;'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;6.&nbsp;&nbsp;Alamat Rumah Lengkap</td>

                <td>".$flp_data_nosel['alm_ibu']."

                </td>

                </tr>

                <tr>

                <td></td>

                <td style='vertical-align:middle;'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;7.&nbsp;&nbsp;Pekerjaan</td>

                <td>".$flp_data_nosel['pek_ibu']."

                </td>

                </tr>

                <tr>

                <td></td>

                <td style='vertical-align:middle;'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;8.&nbsp;&nbsp;Penghasilan</td>

                <td>".$flp_data_nosel['hsl_ibu']."

                </td>

                </tr>



                <tr>

                <td style='height:5px; width:5px; vertical-align:middle;'>20.</td>

                <td style='vertical-align:middle;'>Wali</td>

                <td></td>

                </tr>

                <tr>

                <td></td>

                <td style='vertical-align:middle;'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;A.&nbsp;&nbsp;Nama Lengkap</td>

                <td>".$flp_data_nosel['nm_wali']."

                </td>

                </tr>

                <tr>

                <td></td>

                <td style='vertical-align:middle;'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;B.&nbsp;&nbsp;Tanggal Lahir</td>

                <td>";

                 if($flp_data_nosel['tgl_lhr_wali']=="0000-00-00"){

                    $lahir_wali="";

                 }else{

                    $lahir_wali=$flp_data_nosel['tgl_lhr_wali'];

                 }


                echo"
                
                ".$lahir_wali."

                </td>

                </tr>

                <tr>

                <td></td>

                <td style='vertical-align:middle;'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;C.&nbsp;&nbsp;Tempat Lahir</td>

                <td>".$flp_data_nosel['tmt_lhr_wali']."

                </td>

                </tr>

                <tr>

                <td></td>

                <td style='vertical-align:middle;'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;D.&nbsp;&nbsp;NIK</td>

                <td>".$flp_data_nosel['nik_wali']."

                </td>

                </tr>

                <tr>

                <td></td>

                <td style='vertical-align:middle;'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;E.&nbsp;&nbsp;Pendidikan</td>

                <td>".$flp_data_nosel['pnd_wali']."

                </td>

                </tr>

                <tr>

                <td></td>

                <td style='vertical-align:middle;'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;F.&nbsp;&nbsp;Alamat Rumah Lengkap</td>

                <td>".$flp_data_nosel['alm_wali']."

                </td>

                </tr>

                <tr>

                <td></td>

                <td style='vertical-align:middle;'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;G.&nbsp;&nbsp;Pekerjaan</td>

                <td>".$flp_data_nosel['pek_wali']."

                </td>

                </tr>

                <tr>

                <td></td>

                <td style='vertical-align:middle;'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;H.&nbsp;&nbsp;Penghasilan</td>

                <td>".$flp_data_nosel['hsl_wali']."

                </td>

                </tr>



                <tr>

                <td style='height:5px; width:5px; vertical-align:middle;'>21.</td>

                <td style='vertical-align:middle;'>Anak Ke-</td>

                <td>".$flp_data_nosel['ank_ke']."

                </td>

                </tr>



                <tr>

                <td style='height:5px; width:5px; vertical-align:middle;'>22.</td>

                <td style='vertical-align:middle;'>Kebutuhan Khusus ( bila ada )</td>

                <td></td>

                </tr>



                <tr>

                <td></td>

                <td style='vertical-align:middle;'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;A.&nbsp;&nbsp;Mahasiswa</td>

                <td>";
 
                                 $kebutuhan=explode(",",$flp_data_nosel['mhs']);
                                 foreach($kebutuhan as $data){
                                        echo"
                                                 $data<br>
                                        ";
                                 }
                                 
                echo"
                
                </td>

                </tr>



                <tr>

                <td></td>

                <td style='vertical-align:middle;'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;B.&nbsp;&nbsp;Ayah</td>

                <td>";

                                 $kebutuhan=explode(",",$flp_data_nosel['ayah']);
                                 foreach($kebutuhan as $data){
                                        echo"
                                                 $data<br>
                                        ";
                                 }
                echo"
                
                </td>

                </tr>



                <tr>

                <td></td>

                <td style='vertical-align:middle;'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;C.&nbsp;&nbsp;Ibu</td>

                <td>";

                                 $kebutuhan=explode(",",$flp_data_nosel['ibu']);
                                 foreach($kebutuhan as $data){
                                        echo"
                                                 $data<br>
                                        ";
                                 }
                echo"
                        
                </td>

                </tr>

				

		</table>
            ";   

	$content = ob_get_clean();
	require_once('plugins/html2pdf/html2pdf.class.php');
	try
	{
	    $html2pdf = new HTML2PDF('P','A4','en', false, 'ISO-8859-15', array(mL, mT, mR, mB));
	    
	    $html2pdf->setDefaultFont('Arial');
	    $html2pdf->writeHTML($content, false);
	    
	    $html2pdf->Output('BIODATA'.$flp_data_nosel['nama'].'_'.$flp_data_nosel['nosel'].'.pdf', 'D');
	}
	catch(HTML2PDF_exception $e) {
	    echo $e;
	    exit;
	}
}
if(isset($_POST['bexportexcel'])){
    
        ob_start();
        
        require('class.php');
        require('object.php');
        
        ob_clean();
        
        $dbs->koneksi();
        
        if(!empty($_SESSION['username'])){
            $sesi_username=$_SESSION['username'];
            $kodept = strtolower(preg_replace('/[0-9]+/', '', substr($sesi_username,0,3)));	
        }
	$tb_pts = $kodept;
	
	$unv_tampil=$unv->unv_tampil($kodept);
	$unv_data=mysql_fetch_array($unv_tampil);
	$nama_pt=strtoupper($unv_data['namapt']);
	
	$pecah_thn=explode("-",$date);
	$pecah_1=$pecah_thn[0];
	
	$tahun_akd=$pecah_1;
	$tahun_smp_akd=$pecah_1 +  1;

	require_once 'plugins/phpexel/PHPExcel.php';

	$objPHPExcel = new PHPExcel();

	$objPHPExcel->getProperties()->setCreator("Mahasiswa")
                                    ->setLastModifiedBy("Mahasiswa")
                                    ->setTitle("Forlap")
                                    ->setSubject("Forlap")
                                    ->setDescription("Forlap")
                                    ->setKeywords("office 2007 openxml php")
                                    ->setCategory("Test result file");
								 
	$objPHPExcel->getActiveSheet()->setCellValue('B7', 'No');
	$objPHPExcel->getActiveSheet()->setCellValue('C7', 'Nosel');
	$objPHPExcel->getActiveSheet()->setCellValue('D7', 'Nama');
	$objPHPExcel->getActiveSheet()->setCellValue('E7', 'Jurusan');
	$objPHPExcel->getActiveSheet()->setCellValue('F7', 'NPM');
	$objPHPExcel->getActiveSheet()->setCellValue('G7', 'NIK');
	$objPHPExcel->getActiveSheet()->setCellValue('H7', 'Kelamin');

	$i = 8;
	$no= 1;
	$flp_tampil_all=$flp->flp_tampil_all($tb_pts);
        while($flp_tampil_data=mysql_fetch_assoc($flp_tampil_all)){

            $objPHPExcel->getActiveSheet()->setCellValue('B'.$i, $no);
            $objPHPExcel->getActiveSheet()->setCellValue('C'.$i, $flp_tampil_data['nosel']);
            $objPHPExcel->getActiveSheet()->setCellValue('D'.$i, $flp_tampil_data['nama']);
            $objPHPExcel->getActiveSheet()->setCellValue('E'.$i, $flp_tampil_data['jurusan']);
            $objPHPExcel->getActiveSheet()->setCellValue('F'.$i, $flp_tampil_data['npm']);
            $objPHPExcel->getActiveSheet()->setCellValue('G'.$i, $flp_tampil_data['nik']);
            $objPHPExcel->getActiveSheet()->setCellValue('H'.$i, $flp_tampil_data['kelamin']);
            $i++;
            $no++;
	}
	$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(9);
	$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(20);
	$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(35);
	$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(35);
	$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(20);
	$objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(20);
	$objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(10);

	$objPHPExcel->getActiveSheet()->getStyle("B7:H7")->applyFromArray(
			 array(
				'font'    => array(
					'name' => 'Arial', 'size' => '9', 'bold' => true
				),
				'alignment' => array(
					'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
				),
				'borders' => array(
					'allborders' => array(
						'style' => PHPExcel_Style_Border::BORDER_THIN
					)
				),
				'fill' => array(
					'type'       => PHPExcel_Style_Fill::FILL_SOLID,
					'startcolor' => array(
						'argb' => 'efefef'
					)
				)
			));
	
	$objPHPExcel->getActiveSheet()->mergeCells('G3:H3');
	$objPHPExcel->getActiveSheet()->mergeCells('D3:E3');
	$objPHPExcel->getActiveSheet()->mergeCells('D4:E4');
	$objPHPExcel->getActiveSheet()->mergeCells('D5:E5');
	$objPHPExcel->getActiveSheet()->setCellValue('D3', "DATA ISIAN MAHASISWA BARU");
	$objPHPExcel->getActiveSheet()->setCellValue('D4', $nama_pt);
	$objPHPExcel->getActiveSheet()->setCellValue('D5', "TAHUN AJARAN ".$tahun_akd." / ".$tahun_smp_akd);
	
	$objPHPExcel->getActiveSheet()->getStyle("D3:E3")->applyFromArray(
		 array(
				'font'    => array(
					'name' => 'Arial', 'size' => '12', 'bold' => true
				),
				'alignment' => array(
					'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
				)
		));
	$objPHPExcel->getActiveSheet()->getStyle("D4:E4")->applyFromArray(
		 array(
				'font'    => array(
					'name' => 'Arial', 'size' => '12', 'bold' => true
				),
				'alignment' => array(
					'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
				)
		));
	$objPHPExcel->getActiveSheet()->getStyle("D5:E5")->applyFromArray(
		 array(
				'font'    => array(
					'name' => 'Arial', 'size' => '12', 'bold' => true
				),
				'alignment' => array(
					'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
				)
		));

	$objPHPExcel->getActiveSheet()->setCellValue('G3', "".$tgl->tgl_indo($date)."");

	$objPHPExcel->getDefaultStyle()->getAlignment('G3')->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

	$objPHPExcel->getActiveSheet()->getStyle('B7:' . $objPHPExcel->getActiveSheet()->getHighestColumn() . 
        $objPHPExcel->getActiveSheet()->getHighestRow())->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);


	$objPHPExcel->setActiveSheetIndex(0);

	$objDrawing = new PHPExcel_Worksheet_Drawing();
	$objDrawing->setName('Forlap');
	$objDrawing->setDescription('Forlap');
	$objDrawing->setPath('dist/img/logo/logo_'.$tb_pts.'.jpg');
	$objDrawing->setCoordinates('B3');
	$objDrawing->setWorksheet($objPHPExcel->getActiveSheet());


	 header('Content-type: application/vnd.ms-excel');

	 header('Content-Disposition: attachment; filename="forlap_'.$date.'.xls"');

	 header('Cache-Control: max-age=0');

	 header ('Expires: Mon, 26 Jul 1997 05:00:00 GMT');

	 header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT');

	 header ('Cache-Control: cache, must-revalidate');

	 header ('Pragma: public');

	 $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');

	 $objWriter->save('php://output');
}
?>

