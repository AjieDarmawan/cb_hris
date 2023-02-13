<?php
$objPHPExcel = new PHPExcel();
$objPHPExcel->getProperties()->setCreator("GillandGroup")
							 ->setLastModifiedBy("GillandGroup")
							 ->setTitle("Export MySQL Result to XLSX")
							 ->setSubject("Export MySQL Result to XLSX")
							 ->setDescription("Generated using PHP Classes")
							 ->setKeywords("office 2007 openxml php")
							 ->setCategory("Result file");

// Set thin black border on all column
$styleBorderAll = array(
	'borders' => array(
		'allborders' => array(
			'style' => PHPExcel_Style_Border::BORDER_THIN,
			'color' => array('argb' => 'FF000000'),
		),
	),
);


/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
$objPHPExcel->setActiveSheetIndex(0);
$objPHPExcel->getActiveSheet()->setTitle('Point Absen');
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
if($jumdat>0) {
	$date_=("Y-m-d");
	// Set Header
	$objPHPExcel->getActiveSheet()->setCellValue('A1', 'POINT ABSEN');
	if(!empty($_SESSION['bulan']) || !empty($_SESSION['divisi'])){

		$pecah_tgl = explode( "-", $date_ );
		$tgl_rpt = $pecah_tgl[2];
		$sesidate = $_SESSION['bulan']."-01";	
		$objPHPExcel->getActiveSheet()->setCellValue('A3', substr($tgl->tgl_indo($sesidate), 2,20));
                $objPHPExcel->getActiveSheet()->mergeCells('A3:B3');

	}
      
	$objPHPExcel->getActiveSheet()->setCellValue('E3', 'ABSENSI KARYAWAN');
	$objPHPExcel->getActiveSheet()->setCellValue('E4', 'JUMLAH DATA  :  '.$jumdat);
	$objPHPExcel->getActiveSheet()->mergeCells('E3:F3');
	$objPHPExcel->getActiveSheet()->mergeCells('E4:F4');
	
	// Style Header
	$objPHPExcel->getActiveSheet()->getStyle('A1')->getFont()->setSize(16);
        $objPHPExcel->getActiveSheet()->getStyle('A3')->getFont()->setSize(16);

	$objPHPExcel->getActiveSheet()->getStyle('E3')->getFont()->setSize(14);
	$objPHPExcel->getActiveSheet()->getStyle('A1:F4')->getFont()->setBold(true);
	$objPHPExcel->getActiveSheet()->getStyle('A1:F4')->getFont()->getColor()->setARGB(PHPExcel_Style_Color::COLOR_BLACK);
	$objPHPExcel->getActiveSheet()->getStyle('E3:F4')->applyFromArray($styleBorderAll);
	$objPHPExcel->getActiveSheet()->getStyle('E3:F4')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
	$objPHPExcel->getActiveSheet()->getStyle('F4')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
	
	// Set Header Columns
	$objPHPExcel->getActiveSheet()->setCellValue('A6', 'NO.');
	$objPHPExcel->getActiveSheet()->setCellValue('B6', 'NIK');
	$objPHPExcel->getActiveSheet()->setCellValue('C6', 'NAMA');
	$objPHPExcel->getActiveSheet()->setCellValue('D6', 'DIVISI');
	$objPHPExcel->getActiveSheet()->setCellValue('E6', 'HADIR');
	$objPHPExcel->getActiveSheet()->setCellValue('F6', 'POINT');
	$objPHPExcel->getActiveSheet()->mergeCells('A6:A7');
	$objPHPExcel->getActiveSheet()->mergeCells('B6:B7');
	$objPHPExcel->getActiveSheet()->mergeCells('C6:C7');
	$objPHPExcel->getActiveSheet()->mergeCells('D6:D7');
	$objPHPExcel->getActiveSheet()->mergeCells('E6:E7');
        $objPHPExcel->getActiveSheet()->mergeCells('F6:F7');
	$objPHPExcel->getActiveSheet()->getStyle('A6:F7')->getAlignment()->setWrapText(true);
	$objPHPExcel->getActiveSheet()->getStyle('A6:F7')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
	$objPHPExcel->getActiveSheet()->getStyle('A1:F7')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
	$objPHPExcel->getActiveSheet()->getStyle('A6:F7')->applyFromArray($styleBorderAll);
	

	// Set Header Width Columns
	$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(8.71);
	$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(15.71);
	$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(30.71);
	$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(20.71);
	$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(15.71);
	$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(15.71);
	
	$objPHPExcel->getActiveSheet()->getRowDimension('7')->SetRowHeight(23);
	$objPHPExcel->getActiveSheet()->getStyle('A6:F7')->getFont()->setName('Arial');
	$objPHPExcel->getActiveSheet()->getStyle('A6:F7')->getFont()->setSize(9);
	$objPHPExcel->getActiveSheet()->getStyle('A6:F7')->getFont()->setBold(true);
	
	$brsAWAL=8;
	for ($i = 1; $i <= $jumdat; $i++) {
		$brs=($brsAWAL+$i)-1;
                       
		$objPHPExcel->getActiveSheet()->setCellValue('A'.$brs, $i);
		$objPHPExcel->getActiveSheet()->setCellValue('B'.$brs, $arr["kar_nik"][$i]);
		$objPHPExcel->getActiveSheet()->setCellValue('C'.$brs, $arr["kar_nm"][$i]);
		$objPHPExcel->getActiveSheet()->setCellValue('D'.$brs, $arr["div_nm"][$i]);
		$objPHPExcel->getActiveSheet()->setCellValue('E'.$brs, $arr["hadir"][$i]);
		$objPHPExcel->getActiveSheet()->setCellValue('F'.$brs, $arr["point"][$i]);

		if($i==$jumdat) { $brsAKHIR=$brs+1; $brsAKHIR1=$brs+1; $brsAKHIR2=$brs;}
	}
	
	//$objPHPExcel->getActiveSheet()->getStyle('F'.$brsAWAL.':'.'F'.$brsAKHIR)->getNumberFormat()->setFormatCode( PHPExcel_Style_NumberFormat::FORMAT_TEXT ); 
	//$objPHPExcel->getActiveSheet()->getStyle('F'.$brsAWAL.':'.'F'.$brsAKHIR)->getNumberFormat()->setFormatCode("0000000000"); 
	
	
	$objPHPExcel->getActiveSheet()->getStyle('A'.$brsAWAL.':'.'B'.$brsAKHIR)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
	$objPHPExcel->getActiveSheet()->getStyle('D'.$brsAWAL.':'.'F'.$brsAKHIR)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
	$objPHPExcel->getActiveSheet()->getStyle('A'.$brsAKHIR.':'.'F'.$brsAKHIR)->getFont()->setName('Arial');
	$objPHPExcel->getActiveSheet()->getStyle('A'.$brsAKHIR.':'.'F'.$brsAKHIR)->getFont()->setSize(9);
	$objPHPExcel->getActiveSheet()->getStyle('A'.$brsAKHIR.':'.'F'.$brsAKHIR)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
	$objPHPExcel->getActiveSheet()->getStyle('A'.$brsAKHIR.':F'.$brsAKHIR)->getFont()->setBold(true);
	
	/*
	$objPHPExcel->getActiveSheet()->setCellValue('A'.$brsAKHIR, 'TOTAL KESELURUHAN');
	$objPHPExcel->getActiveSheet()->mergeCells('A'.$brsAKHIR.':'.'G'.$brsAKHIR);
	$objPHPExcel->getActiveSheet()->getStyle('A'.$brsAKHIR)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
	$objPHPExcel->getActiveSheet()->setCellValue('H'.$brsAKHIR, '=SUM(H'.$brsAWAL.':H'.$brsAKHIR2.')');
	$objPHPExcel->getActiveSheet()->getStyle('H'.$brsAWAL.':'.'H'.$brsAKHIR)->getNumberFormat()->setFormatCode('#,##0'); 
	$objPHPExcel->getActiveSheet()->setCellValue('I'.$brsAKHIR, '=SUM(I'.$brsAWAL.':I'.$brsAKHIR2.')');
	$objPHPExcel->getActiveSheet()->getStyle('I'.$brsAWAL.':'.'I'.$brsAKHIR)->getNumberFormat()->setFormatCode('#,##0'); 
	$objPHPExcel->getActiveSheet()->setCellValue('J'.$brsAKHIR, '=SUM(J'.$brsAWAL.':J'.$brsAKHIR2.')');
	$objPHPExcel->getActiveSheet()->getStyle('J'.$brsAWAL.':'.'J'.$brsAKHIR)->getNumberFormat()->setFormatCode('#,##0'); 
	$objPHPExcel->getActiveSheet()->setCellValue('K'.$brsAKHIR, '=SUM(K'.$brsAWAL.':K'.$brsAKHIR2.')');
	$objPHPExcel->getActiveSheet()->getStyle('K'.$brsAWAL.':'.'K'.$brsAKHIR)->getNumberFormat()->setFormatCode('#,##0'); 
	$objPHPExcel->getActiveSheet()->setCellValue('L'.$brsAKHIR, '=SUM(L'.$brsAWAL.':L'.$brsAKHIR2.')');
	$objPHPExcel->getActiveSheet()->getStyle('L'.$brsAWAL.':'.'L'.$brsAKHIR)->getNumberFormat()->setFormatCode('#,##0'); 
	$objPHPExcel->getActiveSheet()->setCellValue('M'.$brsAKHIR, '=SUM(M'.$brsAWAL.':M'.$brsAKHIR2.')');
	$objPHPExcel->getActiveSheet()->getStyle('M'.$brsAWAL.':'.'M'.$brsAKHIR)->getNumberFormat()->setFormatCode('#,##0'); 
	$objPHPExcel->getActiveSheet()->setCellValue('N'.$brsAKHIR, '=SUM(N'.$brsAWAL.':N'.$brsAKHIR2.')');
	$objPHPExcel->getActiveSheet()->getStyle('N'.$brsAWAL.':'.'N'.$brsAKHIR)->getNumberFormat()->setFormatCode('#,##0'); 
	$objPHPExcel->getActiveSheet()->setCellValue('O'.$brsAKHIR, '=SUM(O'.$brsAWAL.':O'.$brsAKHIR2.')');
	$objPHPExcel->getActiveSheet()->getStyle('O'.$brsAWAL.':'.'O'.$brsAKHIR)->getNumberFormat()->setFormatCode('#,##0');
	$objPHPExcel->getActiveSheet()->setCellValue('P'.$brsAKHIR, '=SUM(P'.$brsAWAL.':P'.$brsAKHIR2.')');
	$objPHPExcel->getActiveSheet()->getStyle('P'.$brsAWAL.':'.'P'.$brsAKHIR)->getNumberFormat()->setFormatCode('#,##0'); 
	*/
	
	/*$brsAKHIR2=$brsAKHIR1+3;
	$brsAKHIR3=$brsAKHIR2+1;
	$brsAKHIR4=$brsAKHIR3+3;
	$objPHPExcel->getActiveSheet()->getStyle('B'.$brsAKHIR2.':'.'L'.$brsAKHIR4)->getFont()->setName('Arial');
	$objPHPExcel->getActiveSheet()->getStyle('B'.$brsAKHIR2.':'.'L'.$brsAKHIR4)->getFont()->setSize(8);
	$objPHPExcel->getActiveSheet()->getStyle('B'.$brsAKHIR2.':'.'L'.$brsAKHIR4)->getFont()->setBold(true);*/
	
	
	$areanya="A".$brsAWAL.":F".$brsAKHIR2;
	$objPHPExcel->getActiveSheet()->getStyle($areanya)->applyFromArray($styleBorderAll);
	
}
//include "abs_det_excel_export.php";
//include "abs_rwd_excel_export.php";
$objPHPExcel->setActiveSheetIndex(0);
?>