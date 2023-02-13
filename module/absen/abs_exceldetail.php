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
//$objPHPExcel->createSheet();
$objPHPExcel->setActiveSheetIndex(0);
$objPHPExcel->getActiveSheet()->setTitle('Detail Absen');
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
if($jumdat>0) {
    
        if(!empty($_SESSION['bulan']) || !empty($_SESSION['divisi'])){
            
	$sesidate = $_SESSION['bulan']."-01";
	$akhirbulan = date("Y-m-t", strtotime($sesidate));
	
	$exp_sesidate = explode("-", $akhirbulan);
	$year = $exp_sesidate[0];
	$month = $exp_sesidate[1];
	$daysInMonth = $exp_sesidate[2];

        }
        
        $objPHPExcel->getActiveSheet()->freezePane('E8');
	
	$objPHPExcel->getActiveSheet()->setCellValue('A1', 'DETAIL ABSEN');

        $objPHPExcel->getActiveSheet()->setCellValue('A3',substr($tgl->tgl_indo($sesidate), 3,20));
        $objPHPExcel->getActiveSheet()->mergeCells('A3:B3');

	$objPHPExcel->getActiveSheet()->getStyle('A1')->getFont()->setSize(16);
        $objPHPExcel->getActiveSheet()->getStyle('A3')->getFont()->setSize(16);

	
	$objPHPExcel->getActiveSheet()->setCellValue('A6', 'NO.');
	$objPHPExcel->getActiveSheet()->setCellValue('B6', 'NIK');
	$objPHPExcel->getActiveSheet()->setCellValue('C6', 'NAMA');
	$objPHPExcel->getActiveSheet()->setCellValue('D6', 'DIVISI');
        
        
        $objPHPExcel->getActiveSheet()->mergeCells('A6:A7');
	$objPHPExcel->getActiveSheet()->mergeCells('B6:B7');
	$objPHPExcel->getActiveSheet()->mergeCells('C6:C7');
	$objPHPExcel->getActiveSheet()->mergeCells('D6:D7');

        for($i=0,$j='E',$h=1,$k='D',$s='C';$i<$daysInMonth;$i++,$j++,$h++,$k++,$s++) {
            $objPHPExcel->getActiveSheet()->setCellValue($j.'6', 'TGL');
            $objPHPExcel->getActiveSheet()->setCellValue($j.'7', $h);
	    //$objPHPExcel->getActiveSheet()->mergeCells($j.'6:'.$j.'7');
            
            $objPHPExcel->getActiveSheet()->getColumnDimension($j)->setWidth(5.71);
            
            
        }

        /*
        $objPHPExcel->getActiveSheet()->setCellValue($s.'3', 'ABSENSI KARYAWAN');
	$objPHPExcel->getActiveSheet()->setCellValue($s.'4', 'JUMLAH DATA  :  '.$jumdat);
	$objPHPExcel->getActiveSheet()->mergeCells($s.'3:'.$k.'3');
	$objPHPExcel->getActiveSheet()->mergeCells($s.'4:'.$k.'4');
	*/
        
        $objPHPExcel->getActiveSheet()->getStyle('A6:'.$k.'7')->getAlignment()->setWrapText(true);
        $objPHPExcel->getActiveSheet()->getStyle('A6:'.$k.'7')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objPHPExcel->getActiveSheet()->getStyle('A1:'.$k.'7')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
        $objPHPExcel->getActiveSheet()->getStyle('A6:'.$k.'7')->applyFromArray($styleBorderAll);
        
        $objPHPExcel->getActiveSheet()->getStyle('A1:'.$k.'4')->getFont()->setBold(true);
	$objPHPExcel->getActiveSheet()->getStyle('A1:'.$k.'4')->getFont()->getColor()->setARGB(PHPExcel_Style_Color::COLOR_BLACK);
        /*
        $objPHPExcel->getActiveSheet()->getStyle($s.'3')->getFont()->setSize(14);
	$objPHPExcel->getActiveSheet()->getStyle($s.'3:'.$k.'4')->applyFromArray($styleBorderAll);
	$objPHPExcel->getActiveSheet()->getStyle($s.'3:'.$k.'4')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
	$objPHPExcel->getActiveSheet()->getStyle($k.'4')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
        */        
	
	$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(8.71);
	$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(15.71);
	$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(30.71);
	$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(20.71);
        
        
	
	$objPHPExcel->getActiveSheet()->getRowDimension('7')->SetRowHeight(23);
	$objPHPExcel->getActiveSheet()->getStyle('A6:'.$k.'7')->getFont()->setName('Arial');
	$objPHPExcel->getActiveSheet()->getStyle('A6:'.$k.'7')->getFont()->setSize(9);
	$objPHPExcel->getActiveSheet()->getStyle('A6:'.$k.'7')->getFont()->setBold(true);
	
	$brsAWAL=8;
	for ($i = 1; $i <= $jumdat; $i++) {
		$brs=($brsAWAL+$i)-1;
                       
		$objPHPExcel->getActiveSheet()->setCellValue('A'.$brs, $i);
		$objPHPExcel->getActiveSheet()->setCellValue('B'.$brs, $arr["kar_nik"][$i]);
		$objPHPExcel->getActiveSheet()->setCellValue('C'.$brs, $arr["kar_nm"][$i]);
		$objPHPExcel->getActiveSheet()->setCellValue('D'.$brs, $arr["div_nm"][$i]);
                
                for($i1=1,$j1='E';$i1<=$daysInMonth;$i1++,$j1++) {
                    
                                                $kar_id__=$arr["kar_id"][$i];
		
						$hari=sprintf("%'.02d", $i1);
						$tahun_bulan=$year."-".$month;

						$pecah_tgl = explode( "-", $tahun_bulan );	

						$abs_tgl_masuk=$pecah_tgl[0]."-".$pecah_tgl[1]."-".$hari;

                                                if($abs_tgl_masuk==$detrewardabsen[$kar_id__][$abs_tgl_masuk]["abs_tgl_masuk"]){

							$objPHPExcel->getActiveSheet()->setCellValue($j1.$brs, '*');
                                                        /*$objPHPExcel->getActiveSheet()->getStyle($j1.$brs)->getFill()
                                                        ->setFillType(PHPExcel_Style_Fill::FILL_SOLID)
                                                        ->getStartColor()->setARGB('d0ffb1');*/
						}else{

							$objPHPExcel->getActiveSheet()->setCellValue($j1.$brs, '');

						}
                                                
                                                /*
                                                if($abs_data_kar > 0){
                                                        $objPHPExcel->getActiveSheet()->getStyle($j1.$brs)->getFill()
                                                        ->setFillType(PHPExcel_Style_Fill::FILL_SOLID)
                                                        ->getStartColor()->setARGB('d0ffb1');
                                                        $objPHPExcel->getActiveSheet()->getStyle($j1.$brs)->getFont()
                                                        ->getColor()->setARGB('ffffff');
						}else{
                                                        $objPHPExcel->getActiveSheet()->getStyle($j1.$brs)->getFill()
                                                        ->setFillType(PHPExcel_Style_Fill::FILL_SOLID)
                                                        ->getStartColor()->setARGB('e91844');
                                                        $objPHPExcel->getActiveSheet()->getStyle($j1.$brs)->getFont()
                                                        ->getColor()->setARGB('ffffff');

						}
						*/

						
                }                                
                

		if($i==$jumdat) { $brsAKHIR=$brs+1; $brsAKHIR1=$brs+1; $brsAKHIR2=$brs;}
	}
		
	$objPHPExcel->getActiveSheet()->getStyle('A'.$brsAWAL.':'.'B'.$brsAKHIR)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
	$objPHPExcel->getActiveSheet()->getStyle('D'.$brsAWAL.':'.$k.$brsAKHIR)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
	$objPHPExcel->getActiveSheet()->getStyle('A'.$brsAKHIR.':'.$k.$brsAKHIR)->getFont()->setName('Arial');
	$objPHPExcel->getActiveSheet()->getStyle('A'.$brsAKHIR.':'.$k.$brsAKHIR)->getFont()->setSize(9);
	$objPHPExcel->getActiveSheet()->getStyle('A'.$brsAKHIR.':'.$k.$brsAKHIR)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
	$objPHPExcel->getActiveSheet()->getStyle('A'.$brsAKHIR.':'.$k.$brsAKHIR)->getFont()->setBold(true);
		
	
	$areanya="A".$brsAWAL.":".$k.$brsAKHIR2;
	$objPHPExcel->getActiveSheet()->getStyle($areanya)->applyFromArray($styleBorderAll);
	
}

$objPHPExcel->setActiveSheetIndex(0);
?>