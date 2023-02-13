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
$objPHPExcel->getActiveSheet()->setTitle('Data Kontrak');
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
if($jumdat>0) {
    
        $objPHPExcel->getActiveSheet()->freezePane('G8');

	$objPHPExcel->getActiveSheet()->setCellValue('A1', 'DATA KONTRAK');      
	$objPHPExcel->getActiveSheet()->setCellValue('C3', 'KONTRAK');
	$objPHPExcel->getActiveSheet()->setCellValue('C4', 'JUMLAH DATA  :  '.$jumdat);
	$objPHPExcel->getActiveSheet()->mergeCells('C3:D3');
	$objPHPExcel->getActiveSheet()->mergeCells('C4:D4');
	
	// Style Header
	$objPHPExcel->getActiveSheet()->getStyle('A1')->getFont()->setSize(16);
        $objPHPExcel->getActiveSheet()->getStyle('A3')->getFont()->setSize(16);

	$objPHPExcel->getActiveSheet()->getStyle('C3')->getFont()->setSize(14);
	$objPHPExcel->getActiveSheet()->getStyle('A1:D4')->getFont()->setBold(true);
	$objPHPExcel->getActiveSheet()->getStyle('A1:D4')->getFont()->getColor()->setARGB(PHPExcel_Style_Color::COLOR_BLACK);
	$objPHPExcel->getActiveSheet()->getStyle('C3:D4')->applyFromArray($styleBorderAll);
	$objPHPExcel->getActiveSheet()->getStyle('C3:D4')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
	$objPHPExcel->getActiveSheet()->getStyle('D4')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
	
	// Set Header Columns
	$objPHPExcel->getActiveSheet()->setCellValue('A6', 'NO.');
	$objPHPExcel->getActiveSheet()->setCellValue('B6', 'NIK');
	$objPHPExcel->getActiveSheet()->setCellValue('C6', 'NAMA');
	$objPHPExcel->getActiveSheet()->setCellValue('D6', 'DIVISI');
	$objPHPExcel->getActiveSheet()->setCellValue('E6', 'TGL JOIN');
	$objPHPExcel->getActiveSheet()->setCellValue('F6', 'MASA KERJA');
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
        
        for($i=0,$j='G',$h=1,$k='F',$s='C';$i<3;$i++,$j++,$h++,$k++,$s++) {
            $objPHPExcel->getActiveSheet()->setCellValue($j.'6', $h);
            $objPHPExcel->getActiveSheet()->mergeCells($j.'6:'.$j.'7');
            $objPHPExcel->getActiveSheet()->getStyle($j.'6:'.$j.'7')->getAlignment()->setWrapText(true);
            $objPHPExcel->getActiveSheet()->getStyle($j.'6:'.$j.'7')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
            $objPHPExcel->getActiveSheet()->getStyle($j.'6:'.$j.'7')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
            $objPHPExcel->getActiveSheet()->getStyle($j.'6:'.$j.'7')->getFont()->setSize(14);
	    $objPHPExcel->getActiveSheet()->getStyle($j.'6:'.$j.'7')->getFont()->setBold(true);
            $objPHPExcel->getActiveSheet()->getStyle($j.'6:'.$j.'7')->applyFromArray($styleBorderAll);
            $objPHPExcel->getActiveSheet()->getColumnDimension($j)->setWidth(35.71);
            
        }
        

	// Set Header Width Columns
	$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(8.71);
	$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(15.71);
	$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(30.71);
	$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(20.71);
	$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(20.71);
	$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(20.71);
	
	$objPHPExcel->getActiveSheet()->getRowDimension('7')->SetRowHeight(23);
	$objPHPExcel->getActiveSheet()->getStyle('A6:F7')->getFont()->setName('Arial');
	$objPHPExcel->getActiveSheet()->getStyle('A6:F7')->getFont()->setSize(9);
	$objPHPExcel->getActiveSheet()->getStyle('A6:F7')->getFont()->setBold(true);
	
	$brsAWAL=8;
        
	for ($i = 1; $i <= $jumdat; $i++) {
		$brs=($brsAWAL+$i)-1;
                
                $objPHPExcel->getActiveSheet()->getStyle('A'.$brs)->getAlignment()->setWrapText(true);
                $objPHPExcel->getActiveSheet()->getStyle('A'.$brs)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                $objPHPExcel->getActiveSheet()->getStyle('A'.$brs)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
                $objPHPExcel->getActiveSheet()->getStyle('B'.$brs)->getAlignment()->setWrapText(true);
                $objPHPExcel->getActiveSheet()->getStyle('B'.$brs)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                $objPHPExcel->getActiveSheet()->getStyle('B'.$brs)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
                $objPHPExcel->getActiveSheet()->getStyle('C'.$brs)->getAlignment()->setWrapText(true);
                $objPHPExcel->getActiveSheet()->getStyle('C'.$brs)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                $objPHPExcel->getActiveSheet()->getStyle('C'.$brs)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
                $objPHPExcel->getActiveSheet()->getStyle('D'.$brs)->getAlignment()->setWrapText(true);
                $objPHPExcel->getActiveSheet()->getStyle('D'.$brs)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                $objPHPExcel->getActiveSheet()->getStyle('D'.$brs)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
                $objPHPExcel->getActiveSheet()->getStyle('E'.$brs)->getAlignment()->setWrapText(true);
                $objPHPExcel->getActiveSheet()->getStyle('E'.$brs)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                $objPHPExcel->getActiveSheet()->getStyle('E'.$brs)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
		$objPHPExcel->getActiveSheet()->getStyle('F'.$brs)->getAlignment()->setWrapText(true);
                $objPHPExcel->getActiveSheet()->getStyle('F'.$brs)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                $objPHPExcel->getActiveSheet()->getStyle('F'.$brs)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
		
		$objPHPExcel->getActiveSheet()->setCellValue('A'.$brs, $i);
		$objPHPExcel->getActiveSheet()->setCellValue('B'.$brs, $karArr[$i]['kar_nik']);
		$objPHPExcel->getActiveSheet()->setCellValue('C'.$brs, $karArr[$i]['kar_nm']);
		$objPHPExcel->getActiveSheet()->setCellValue('D'.$brs, $karArr[$i]['div_nm']);
		$objPHPExcel->getActiveSheet()->setCellValue('E'.$brs, $karArr[$i]['kar_dtl_tgl_joi']);
		$objPHPExcel->getActiveSheet()->setCellValue('F'.$brs, $karArr[$i]['kar_dtl_msa_krj']);
                
                for($i1=1,$j1='G';$i1<=3;$i1++,$j1++) {
                    $objPHPExcel->getActiveSheet()->getStyle($j1.$brs)->getAlignment()->setWrapText(true);
		    if($Arr[$karArr[$i]['kar_id']][$i1]['kkn_kontrak'] > 0){
			$objPHPExcel->getActiveSheet()->setCellValue($j1.$brs,'Start : '.$Arr[$karArr[$i]['kar_id']][$i1]['kkn_start'].' - End : '.$Arr[$karArr[$i]['kar_id']][$i1]['kkn_end']);
		    }else{
			$objPHPExcel->getActiveSheet()->setCellValue($j1.$brs,'');
		    }
                    $objPHPExcel->getActiveSheet()->getColumnDimension($j1)->setWidth(35.71);
                }

		if($i==$jumdat) { $brsAKHIR=$brs+1; $brsAKHIR1=$brs+1; $brsAKHIR2=$brs;}
	}
	
	
	$objPHPExcel->getActiveSheet()->getStyle('A'.$brsAWAL.':'.'B'.$brsAKHIR)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
	$objPHPExcel->getActiveSheet()->getStyle('F'.$brsAWAL.':'.$k.$brsAKHIR)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
	$objPHPExcel->getActiveSheet()->getStyle('A'.$brsAKHIR.':'.$k.$brsAKHIR)->getFont()->setName('Arial');
	$objPHPExcel->getActiveSheet()->getStyle('A'.$brsAKHIR.':'.$k.$brsAKHIR)->getFont()->setSize(9);
	$objPHPExcel->getActiveSheet()->getStyle('A'.$brsAKHIR.':'.$k.$brsAKHIR)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
	$objPHPExcel->getActiveSheet()->getStyle('A'.$brsAKHIR.':'.$k.$brsAKHIR)->getFont()->setBold(true);
		
	
	$areanya="A".$brsAWAL.":".$k.$brsAKHIR2;
	$objPHPExcel->getActiveSheet()->getStyle($areanya)->applyFromArray($styleBorderAll);
	
}
$objPHPExcel->setActiveSheetIndex(0);
?>