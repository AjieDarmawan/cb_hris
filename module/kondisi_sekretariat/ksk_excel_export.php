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
$objPHPExcel->getActiveSheet()->setTitle('Rekap Performa Staff');
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// echo "jumlah " . $jumdat;
// exit;
if ($jumdat > 0) {
	$tglnow = date('Y-m-d');
	// Set Header
	$objPHPExcel->getActiveSheet()->setCellValue('A1', 'REKAPITULASI PERFORMA STAFF');
	if (!empty($_SESSION['priode1']) || !empty($_SESSION['priode2'])) {
		$objPHPExcel->getActiveSheet()->setCellValue('A3', strtoupper($tgl->tgl_indo($_SESSION['priode1'])) . ' - ' . strtoupper($tgl->tgl_indo($_SESSION['priode2'])));
		$objPHPExcel->getActiveSheet()->mergeCells('A3:D3');
	} else {
		$objPHPExcel->getActiveSheet()->setCellValue('A3', strtoupper($tgl->tgl_indo($tglnow)));
		$objPHPExcel->getActiveSheet()->mergeCells('A3:B3');
	}

	$objPHPExcel->getActiveSheet()->setCellValue('M3', 'PERFORMA STAFF');
	$objPHPExcel->getActiveSheet()->setCellValue('M4', 'JUMLAH DATA  :  ' . $jumdat);
	$objPHPExcel->getActiveSheet()->mergeCells('M3:N3');
	$objPHPExcel->getActiveSheet()->mergeCells('M4:N4');

	// Style Header
	$objPHPExcel->getActiveSheet()->getStyle('A1')->getFont()->setSize(16);
	if (!empty($_SESSION['priode1']) || !empty($_SESSION['priode2'])) {
		$objPHPExcel->getActiveSheet()->getStyle('A3')->getFont()->setSize(14);
	} else {
		$objPHPExcel->getActiveSheet()->getStyle('A3')->getFont()->setSize(16);
	}
	$objPHPExcel->getActiveSheet()->getStyle('I3')->getFont()->setSize(14);
	$objPHPExcel->getActiveSheet()->getStyle('A1:J4')->getFont()->setBold(true);
	$objPHPExcel->getActiveSheet()->getStyle('A1:J4')->getFont()->getColor()->setARGB(PHPExcel_Style_Color::COLOR_BLACK);
	$objPHPExcel->getActiveSheet()->getStyle('M3:N4')->applyFromArray($styleBorderAll);
	$objPHPExcel->getActiveSheet()->getStyle('M3:N4')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
	$objPHPExcel->getActiveSheet()->getStyle('N4')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);

	// Set Header Columns
	$objPHPExcel->getActiveSheet()->setCellValue('A6', 'NO');
	$objPHPExcel->getActiveSheet()->setCellValue('B6', 'TANGGAL');
	$objPHPExcel->getActiveSheet()->setCellValue('C6', 'WAKTU');
	$objPHPExcel->getActiveSheet()->setCellValue('D6', 'PIC');
	$objPHPExcel->getActiveSheet()->setCellValue('E6', 'METODE');
	$objPHPExcel->getActiveSheet()->setCellValue('F6', 'UNIT');
	$objPHPExcel->getActiveSheet()->setCellValue('G6', 'STAFF');
	$objPHPExcel->getActiveSheet()->setCellValue('H6', 'TOPIK');
	$objPHPExcel->getActiveSheet()->setCellValue('I6', 'KNOWLEDGE');
	$objPHPExcel->getActiveSheet()->setCellValue('J6', 'KNOWLEDGE CAT');
	$objPHPExcel->getActiveSheet()->setCellValue('K6', 'KOMUNIKASI');
	$objPHPExcel->getActiveSheet()->setCellValue('L6', 'KOMUNIKASI CAT');
	$objPHPExcel->getActiveSheet()->setCellValue('M6', 'MEMPENGARUHI');
	$objPHPExcel->getActiveSheet()->setCellValue('N6', 'MEMPENGARUHI CAT');
	$objPHPExcel->getActiveSheet()->setCellValue('O6', 'CATATAN LAIN');
	$objPHPExcel->getActiveSheet()->setCellValue('P6', 'ARAHAN');
	$objPHPExcel->getActiveSheet()->setCellValue('Q6', 'PERKEMBANGAN');
	$objPHPExcel->getActiveSheet()->setCellValue('R6', 'PELATIHAN');
	$objPHPExcel->getActiveSheet()->setCellValue('S6', 'KONFIRMASI HRD');
	$objPHPExcel->getActiveSheet()->mergeCells('A6:A7');
	$objPHPExcel->getActiveSheet()->mergeCells('B6:B7');
	$objPHPExcel->getActiveSheet()->mergeCells('C6:C7');
	$objPHPExcel->getActiveSheet()->mergeCells('D6:D7');
	$objPHPExcel->getActiveSheet()->mergeCells('E6:E7');
	$objPHPExcel->getActiveSheet()->mergeCells('F6:F7');
	$objPHPExcel->getActiveSheet()->mergeCells('G6:G7');
	$objPHPExcel->getActiveSheet()->mergeCells('H6:H7');
	$objPHPExcel->getActiveSheet()->mergeCells('I6:I7');
	$objPHPExcel->getActiveSheet()->mergeCells('J6:J7');
	$objPHPExcel->getActiveSheet()->mergeCells('K6:K7');
	$objPHPExcel->getActiveSheet()->mergeCells('L6:L7');
	$objPHPExcel->getActiveSheet()->mergeCells('M6:M7');
	$objPHPExcel->getActiveSheet()->mergeCells('N6:N7');
	$objPHPExcel->getActiveSheet()->mergeCells('O6:O7');
	$objPHPExcel->getActiveSheet()->mergeCells('P6:P7');
	$objPHPExcel->getActiveSheet()->mergeCells('Q6:Q7');
	$objPHPExcel->getActiveSheet()->mergeCells('R6:R7');
	$objPHPExcel->getActiveSheet()->mergeCells('S6:S7');
	$objPHPExcel->getActiveSheet()->getStyle('A6:S7')->getAlignment()->setWrapText(true);
	$objPHPExcel->getActiveSheet()->getStyle('A6:S7')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
	$objPHPExcel->getActiveSheet()->getStyle('A1:S7')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
	$objPHPExcel->getActiveSheet()->getStyle('A6:S7')->applyFromArray($styleBorderAll);


	// Set Header Width Columns
	$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(5.71);
	$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(15.71);
	$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(15.71);
	$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(30.71);
	$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(15.71);
	$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(30.71);
	$objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(30.71);
	$objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(30.71);
	$objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(15.71);
	$objPHPExcel->getActiveSheet()->getColumnDimension('J')->setWidth(50.71);
	$objPHPExcel->getActiveSheet()->getColumnDimension('K')->setWidth(15.71);
	$objPHPExcel->getActiveSheet()->getColumnDimension('L')->setWidth(50.71);
	$objPHPExcel->getActiveSheet()->getColumnDimension('M')->setWidth(15.71);
	$objPHPExcel->getActiveSheet()->getColumnDimension('N')->setWidth(50.71);
	$objPHPExcel->getActiveSheet()->getColumnDimension('O')->setWidth(50.71);
	$objPHPExcel->getActiveSheet()->getColumnDimension('P')->setWidth(50.71);
	$objPHPExcel->getActiveSheet()->getColumnDimension('Q')->setWidth(15.71);
	$objPHPExcel->getActiveSheet()->getColumnDimension('R')->setWidth(15.71);
	$objPHPExcel->getActiveSheet()->getColumnDimension('S')->setWidth(15.71);

	$objPHPExcel->getActiveSheet()->getRowDimension('7')->SetRowHeight(23);
	$objPHPExcel->getActiveSheet()->getStyle('A6:S7')->getFont()->setName('Arial');
	$objPHPExcel->getActiveSheet()->getStyle('A6:S7')->getFont()->setSize(9);
	$objPHPExcel->getActiveSheet()->getStyle('A6:S7')->getFont()->setBold(true);

	$brsAWAL = 8;
	for ($i = 1; $i <= $jumdat; $i++) {
		$brs = ($brsAWAL + $i) - 1;

		$objPHPExcel->getActiveSheet()->setCellValue('A' . $brs, $i);
		$objPHPExcel->getActiveSheet()->setCellValue('B' . $brs, $arr["pfm_tgl"][$i]);
		$objPHPExcel->getActiveSheet()->setCellValue('C' . $brs, $arr["pfm_waktu"][$i]);
		$objPHPExcel->getActiveSheet()->setCellValue('D' . $brs, $arr["pfm_pic"][$i]);
		$objPHPExcel->getActiveSheet()->setCellValue('E' . $brs, $arr["pfm_metode"][$i]);
		$objPHPExcel->getActiveSheet()->setCellValue('F' . $brs, $arr["pfm_unit"][$i]);
		$objPHPExcel->getActiveSheet()->setCellValue('G' . $brs, $arr["pfm_staff"][$i]);
		$objPHPExcel->getActiveSheet()->setCellValue('H' . $brs, $arr["pfm_topic_cat"][$i]);
		$objPHPExcel->getActiveSheet()->setCellValue('I' . $brs, $arr["pfm_knowledge"][$i]);
		$objPHPExcel->getActiveSheet()->setCellValue('J' . $brs, $arr["pfm_knowledge_cat"][$i]);
		$objPHPExcel->getActiveSheet()->setCellValue('k' . $brs, $arr["pfm_komunikasi"][$i]);
		$objPHPExcel->getActiveSheet()->setCellValue('L' . $brs, $arr["pfm_komunikasi_cat"][$i]);
		$objPHPExcel->getActiveSheet()->setCellValue('M' . $brs, $arr["pfm_mempengaruhi"][$i]);
		$objPHPExcel->getActiveSheet()->setCellValue('N' . $brs, $arr["pfm_mempengaruhi_cat"][$i]);
		$objPHPExcel->getActiveSheet()->setCellValue('O' . $brs, $arr["pfm_lain_cat"][$i]);
		$objPHPExcel->getActiveSheet()->setCellValue('P' . $brs, $arr["pfm_arahan_cat"][$i]);
		$objPHPExcel->getActiveSheet()->setCellValue('Q' . $brs, $arr["pfm_perkembangan"][$i]);
		$objPHPExcel->getActiveSheet()->setCellValue('R' . $brs, $arr["pfm_pelatihan_cat"][$i]);
		$objPHPExcel->getActiveSheet()->setCellValue('S' . $brs, $arr["pfm_hrd"][$i]);

		// $objPHPExcel->getActiveSheet()->setCellValueExplicit('H' . $brs, $arr["pfm_pic"][$i], PHPExcel_Cell_DataType::TYPE_STRING);
		//$objPHPExcel->getActiveSheet()->setCellValueExplicit('J'.$brs,$arr["pfm_daftar"][$i],PHPExcel_Cell_DataType::TYPE_STRING);
		//$objPHPExcel->getActiveSheet()->setCellValueExplicit('K'.$brs,$arr["pfm_spb"][$i],PHPExcel_Cell_DataType::TYPE_STRING);
		//$objPHPExcel->getActiveSheet()->setCellValueExplicit('L'.$brs,$arr["pfm_spp"][$i],PHPExcel_Cell_DataType::TYPE_STRING);
		//$objPHPExcel->getActiveSheet()->setCellValueExplicit('M'.$brs,$arr["pfm_jumlah"][$i],PHPExcel_Cell_DataType::TYPE_STRING);

		// $objPHPExcel->getActiveSheet()->getStyle('J' . $brs . ':' . 'M' . $brs)->getNumberFormat()->setFormatCode('#,##0.00');

		if ($i == $jumdat) {
			$brsAKHIR = $brs + 1;
			$brsAKHIR1 = $brs + 1;
			$brsAKHIR2 = $brs;
		}
	}

	//$objPHPExcel->getActiveSheet()->getStyle('F'.$brsAWAL.':'.'F'.$brsAKHIR)->getNumberFormat()->setFormatCode( PHPExcel_Style_NumberFormat::FORMAT_TEXT ); 
	//$objPHPExcel->getActiveSheet()->getStyle('F'.$brsAWAL.':'.'F'.$brsAKHIR)->getNumberFormat()->setFormatCode("0000000000"); 


	$objPHPExcel->getActiveSheet()->getStyle('A' . $brsAWAL . ':' . 'S' . $brsAKHIR)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
	$objPHPExcel->getActiveSheet()->getStyle('B' . $brsAWAL . ':' . 'S' . $brsAKHIR)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
	$objPHPExcel->getActiveSheet()->getStyle('C' . $brsAWAL . ':' . 'S' . $brsAKHIR)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
	$objPHPExcel->getActiveSheet()->getStyle('D' . $brsAWAL . ':' . 'S' . $brsAKHIR)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
	$objPHPExcel->getActiveSheet()->getStyle('A' . $brsAKHIR . ':' . 'S' . $brsAKHIR)->getFont()->setName('Arial');
	$objPHPExcel->getActiveSheet()->getStyle('A' . $brsAKHIR . ':' . 'S' . $brsAKHIR)->getFont()->setSize(9);
	$objPHPExcel->getActiveSheet()->getStyle('A' . $brsAKHIR . ':' . 'S' . $brsAKHIR)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
	$objPHPExcel->getActiveSheet()->getStyle('A' . $brsAKHIR . ':S' . $brsAKHIR)->getFont()->setBold(true);

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


	$areanya = "A" . $brsAWAL . ":S" . $brsAKHIR2;
	$objPHPExcel->getActiveSheet()->getStyle($areanya)->applyFromArray($styleBorderAll);
}

$objPHPExcel->setActiveSheetIndex(0);
