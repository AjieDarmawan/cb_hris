<?php date_default_timezone_set('Asia/Jakarta');

session_start();

require('../../class.php');
require('../../object.php');



class dataTable {

	protected $ssql;
	protected $whys = array();
	protected $config = array();

	public function __construct($config = array()) {
		$this->config = $config;
	}

	private function datatable_query($filsearch = true) {		

		if(isset($this->config['status']) && $this->config['status'] <> '') {
			$this->whys['status'] = ' AND status = "' . $this->config['status'] . '"';
		}else {
			$this->whys['status'] = ' AND status IN (1,4,99)';
		}
		
		if(isset($this->config['tanggal']) && $this->config['tanggal'] <> '') {			
			$range = @explode(" - ", $this->config['tanggal']);
			$datestart = date('Y-m-d', strtotime(str_replace('/', '-', $range[0])));
			$dateend = date('Y-m-d', strtotime(str_replace('/', '-', $range[1])));
			
			$this->whys['tanggal'] = ' AND DATE_FORMAT(tanggal, "%Y-%m-%d") BETWEEN "' . $datestart . '" AND "'. $dateend . '"';
		}else {
			$this->whys['tanggal'] = '';
		}

		$this->ssql = '
			SELECT  a.*, b.ktr_kd, c.div_id, d.filename
			FROM bni_direct a
			LEFT JOIN ktr_master b 
			ON a.kantor = b.ktr_id
			LEFT JOIN kar_master c 
			ON a.nik = c.kar_nik
			LEFT JOIN bni_direct_file d 
			ON a.kodedirect = d.kode
			WHERE 1=1 
				' . @implode("", $this->whys) . ' 
			ORDER BY a.tanggal
		';
	}
	
	
	public function get_datatables() {
		GLOBAL $db;
		
		$dbopen = $db->koneksi();
		$this->datatable_query();
		
		$this->ssql .= " LIMIT ".$this->config['start']." , ".$this->config['length'];
		$query=mysql_query($this->ssql) or die (mysql_error());
		while($row=mysql_fetch_assoc($query)) {
			$data[]=$row;
		}		
		mysql_close($dbopen);
		
		return $data;
	}
	
	public function count_all() {
		GLOBAL $db;
		
		$dbopen = $db->koneksi();		
		$this->datatable_query();
		
		$query=mysql_query($this->ssql) or die (mysql_error());
		$count = mysql_num_rows($query);
		mysql_close($dbopen);
		
		return $count;
	}
	
	public function count_filtered() {
		GLOBAL $db;
		
		$dbopen = $db->koneksi();		
		$this->datatable_query();
		
		$query=mysql_query($this->ssql) or die (mysql_error());
		$count = mysql_num_rows($query);
		mysql_close($dbopen);
		
		return $count;
	}
}



if(isset($_POST['mode']) && $_POST['mode'] <> '') {		


	if($_POST['mode'] == "list") {
		$arrstatus = array(
			'2' => 'Ditolak',
			'0' => 'Menunggu',
			'1' => 'Disetujui',
			'3' => 'Dibatalkan',
			'99' => 'Dibayarkan'
		);
		$dataTable = new dataTable($_POST);
		$listdata = $dataTable->get_datatables();
		$divisi = list_divisi();

		$data = array();
		$no = $_POST['start'];
		foreach ($listdata as $rows) {
			
			@reset($divisi);
			@reset($arrstatus);
			
			$class = "label-default";
			if($rows['status'] == '0') {
				$class = "label-info";
			}elseif($rows['status'] == '1') {
				$class = "label-success";
			}elseif($rows['status'] == '2') {
				$class = "label-danger";
			}elseif($rows['status'] == '99') {
				$class = "label-payment";
			}
			$link = 'https://cb.web.id/file_kasbon/'.$rows['filename'];
			
			$no++;
			$row = array();
			$row[] = $no;
			$row[] = date('d M Y',strtotime($rows['tanggal']));
			$row[] = $rows['nama'];
			$row[] = $divisi[$rows['div_id']];
			$row[] = $rows['ktr_kd'];
			$row[] = number_format($rows['nominal'],0,",",".");
			$row[] = $rows['keperluan'];
			$row[] = $rows['catatan'];

		
			$list_item =  '<button type="button" class=" btn  btn-primary  btn-xs" 
							onclick="CekPODetail(\''.$rows['nik'].'\#'.$rows['tanggal'].'\')"
							data-toggle="modal" 
							data-target="#myRekapDetail" title="Detail" style="" >
							<span class="glyphicon glyphicon-list"></span>
						   </button>
						   ';
			
			if ($rows['jeniskasbon'] <> "1"){
			  $list_item ='';
			}		
			
			if($rows['status'] == '99') {
			    $btn = $list_item ;
				$btn .= ' <button class="btn btn-info btn-xs" title="'.$rows['kodedirect'].'" onclick="downloadfile(\''.$link.'\');"><i class="fa fa-download"></i></button> ';
				//Tunai_Roki Rahmanda(IT).pdf
				if($rows['direct_mode'] == 'CASH') {
					
					@reset($divisi);
					$filename = str_replace(".zip", "/", $link) . 'Tunai ' . $rows['nama'] . '('. $divisi[$rows['div_id']] .').pdf';
					$btn .= ' <button class="btn btn-success btn-xs" title="Print" onclick="openfile(\''.$filename.'\');"><i class="fa fa fa-print"></i></button> ';
				} else {
					
					@reset($divisi);
					
					$set = ucwords($rows['direct_mode']);
					$key = date('YmdHis', strtotime($rows['tanggal'])) .' - '.$set.' '. $rows['nama'] . '('. $divisi[$rows['div_id']] .').pdf';
					$filename = str_replace(".zip", "/", $link) . $key;
					$btn .= '<button class="btn btn-success btn-xs" title="Print" onclick="openfile(\''.$filename.'\');"><i class="fa fa fa-print"></i></button> ';
				}
				$row[] = $btn;
			
			}else {
				$row[] = $list_item.' '.'&nbsp;';
			}
			$row[] = '<span class="label '. $class .'">'. $arrstatus[$rows['status']] .'</span>';
			
			
			if($rows['status'] == '1') {
				$row[] = '<input type="checkbox" name="check_ref[]" data-id="' .$rows['id']. '" class="check_masal" >';
			} else {
				$row[] = '&nbsp;';
			}


			$data[] = $row;
		}

		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $dataTable->count_all(),
			"recordsFiltered" => $dataTable->count_filtered(),
			"data" => $data
		);			
		echo json_encode($output);
		die();
	}

	
	elseif($_POST['mode'] == "cetakxlsx") {
		$output = cetakexcelpdf($_POST);

		echo json_encode($output);
		die();
	}

	else{
		header('Location: http://kpt.co.id/');
		die();
	}
}


function cetakexcelpdf($prop = array()) {
	GLOBAL $db;
	
	require_once str_replace("module/","" , str_replace(basename(__DIR__) ,"" , __DIR__)) . 'plugins/phpexel/PHPExcel.php';
	require_once str_replace("module/","" , str_replace(basename(__DIR__) ,"" , __DIR__)) . 'plugins/phpexel/PHPExcel/Writer/Excel2007.php';
	
	
	$data = array();
	$inselect = @implode('","', json_decode($prop['reff'], 1));
	$dbopen = $db->koneksi();
	
	$sSQL = '
		SELECT a.*, b.ktr_kd, c.div_id
		FROM bni_direct a
		LEFT JOIN ktr_master b 
		ON a.kantor = b.ktr_id
		LEFT JOIN kar_master c 
		ON a.nik = c.kar_nik
		WHERE a.id IN ("' . $inselect . '")
		ORDER BY a.tanggal';
	
	$query = mysql_query($sSQL) or die (mysql_error());
	while($row = mysql_fetch_assoc($query)) {
		
		@reset($excelfield);
		$tmp_excelfield = $excelfield;
		$alphabet = range('A', 'Z');
	
		$rowsdata = @explode(",", $row['rowcsv']);
		foreach($rowsdata as $k => $v) {
			$tmp_excelfield[$alphabet[$k]] = $v;
		}
		
		
		if($row['direct_mode'] == 'CASH') {
		
			$key = sha1(date('Ymd', strtotime($row['tanggal'])) . $row['nik']);
			$total = isset($data['tunai'][$key]['total']) ? $data['tunai'][$key]['total'] : 0;
			
			$data['tunai'][$key]['nik'] = $row['nik'];
			$data['tunai'][$key]['nama'] = $row['nama'];
			$data['tunai'][$key]['divisi'] = $row['div_id'];
			$data['tunai'][$key]['tanggal'] = $row['tanggal'];
			$data['tunai'][$key]['diajukan'] = $row['nama'];
			$data['tunai'][$key]['disetujui'] = $row['approveby'];
			$data['tunai'][$key]['diterima'] = $row['nama'];
			$data['tunai'][$key]['total'] += $row['nominal'];
			
			$list = array();
			$list['uraian'] = $row['keperluan'];
			$list['jumlah'] = $row['nominal'];
			$list['pembayaran'] = date('d/m/Y');
			$list['keterangan'] = $row['catatan'];
			
			$data['tunai'][$key]['list'][] = $list;
			
		} else {
			
			$key = sha1(date('Ymd', strtotime($row['tanggal'])) . $row['nik']);
			$total = isset($data['tunai'][$key]['total']) ? $data['tunai'][$key]['total'] : 0;
			
			$data['pdfnonunai'][$key]['nik'] = $row['nik'];
			$data['pdfnonunai'][$key]['nama'] = $row['nama'];
			$data['pdfnonunai'][$key]['divisi'] = $row['div_id'];
			$data['pdfnonunai'][$key]['tanggal'] = $row['tanggal'];
			$data['pdfnonunai'][$key]['diajukan'] = $row['nama'];
			$data['pdfnonunai'][$key]['disetujui'] = $row['approveby'];
			$data['pdfnonunai'][$key]['diterima'] = $row['nama'];
			$data['pdfnonunai'][$key]['direct_mode'] = $row['direct_mode'];
			$data['pdfnonunai'][$key]['total'] += $row['nominal'];
			
			$list = array();
			$list['uraian'] = $row['keperluan'];
			$list['jumlah'] = $row['nominal'];
			$list['pembayaran'] = date('d/m/Y');
			$list['keterangan'] = $row['catatan'];
			
			$data['pdfnonunai'][$key]['list'][] = $list;
			
			
			$data['direct'][$row['direct_mode']][] = $tmp_excelfield;
		}
	}
	
	if(count($data) > 0) {
		$cid = rand(100,999);
		$direct_code = trim('F'.date('ym') .'-'. date('dH') .'-'. $cid);
		$filename = $prop['judul'] == '' ? $direct_code : $prop['judul'];
		$path = str_replace("module/","" , str_replace(basename(__DIR__) ,"" , __DIR__)) . 'file_kasbon/'.$filename;
		
		if (!file_exists($path)) {
			mkdir($path, 0777, true);
		}
		
		$buat_excel_direct = buat_excel_direct($data['direct'], $path);
		$buat_excel_tunai = buat_pdf_tunai($data['tunai'], $path);
		$buat_excel_nontunai = buat_pdf_tunai($data['pdfnonunai'], $path, 'custom');
		
		
		if($buat_excel_direct || $buat_excel_tunai || $buat_excel_nontunai) {
			
			sleep(2);
			if(buat_data_download($path)) {
				
				$sSQL = '
					UPDATE bni_direct set
						status = "99", 
						tgldirect = "'.date('Y-m-d H:i:s').'",			
						kodedirect = "'.trim($direct_code).'",
						mddt = "'.date('Y-m-d H:i:s').'",
						mdur = "'.$_SESSION['kar'].'"
					WHERE id IN ("' . $inselect . '")
				';
				if(mysql_query($sSQL)) {
					
					$save_file = array();
					$save_file['kode'] = trim($direct_code);
					$save_file['filename'] = $filename . '.zip';
					$save_file['totalrow'] = count(json_decode($prop['reff'], 1));
					$save_file['norekpay'] = $prop['rek_debit'];
					$save_file['crdt'] = date('Y-m-d H:i:s');
					$save_file['crur'] = $_SESSION['kar'];
					
					$sSQL2 = '
						INSERT INTO bni_direct_file 
							('. @implode(',', array_keys($save_file)) .') 
						VALUE 
							("'. @implode('","', array_values($save_file)) .'")
					';
					if(mysql_query($sSQL2)) {
						
						$link = 'https://cb.web.id/file_kasbon/'.$filename . '.zip';
						echo json_encode(array("status"=>"1", "data"=>$link));
						
					} else {
						echo json_encode(array("status"=>"0","msg"=>$sSQL2));
					}
				} else {
					echo json_encode(array("status"=>"0","msg"=>$sSQL));
				}
			}
		}
	}
	
	mysql_close($dbopen);
	exit;
}

function buat_excel_direct($data = array(), $path) {
	
	$excelfield = array(
		"A" => "Rek. Tujuan",
		"B" => "Nama Penerima",
		"C" => "Amount",
		"D" => "Remark1",
		"E" => "Remark2",
		"F" => "Remark3",
		"G" => "KODEBANK(8)--(M)",
		"H" => "NAMA BANK TUJUAN",
		"I" => "NAMA CABANG",
		"J" => "ALAMAT BANK1",
		"K" => "ALAMAT BANK2",
		"L" => "ALAMAT BANK3",
		"M" => "NAMA KOTA",
		"N" => "NAMA NEGARA",
		"O" => "WARGA NEGARA",
		"P" => "KODE WN",
		"Q" => "EMAIL FLAG",
		"R" => "Email",
		"S" => "Reff Num"
	);

	$G_SHEET = array(
		'Inhouse' => 'KODEBANK',
		'Kliring' => 'Clearing Code',
		'RTGS' => 'RTGS Member'
	);
	

	// BIKIN EXCELNYA 
	$sheetindex = 0;
	$objPHPExcel = new PHPExcel();
	$objPHPExcel->getProperties()->setCreator("Konsultan Pendidikan Tinggi");
	$objPHPExcel->getProperties()->setLastModifiedBy("Konsultan Pendidikan Tinggi");
	$objPHPExcel->getProperties()->setTitle("Kasbon");
	$objPHPExcel->getProperties()->setSubject("KPT :: BNI Direct");
	$objPHPExcel->getProperties()->setDescription("List data kasbon yang akan dibayarkan melalui BNI Direct.");
	
	foreach($data as $k => $v) {
		
		$sheetrows = 1;
		$style_sheet = array();
		$excelfield['G'] = $G_SHEET[$k];
		
		if($sheetindex == 0) {
			
		} else {
			$objPHPExcel->createSheet();
		}
		$objPHPExcel->setActiveSheetIndex($sheetindex);
		$objPHPExcel->getActiveSheet()->setTitle($k);
		
		
		foreach($excelfield as $kfield => $vfield) {
			$keyfield = $kfield . $sheetrows;
			$style_sheet[$kfield] = $vfield;
			$objPHPExcel->getActiveSheet()->setCellValue($keyfield, $vfield,PHPExcel_Cell_DataType::TYPE_STRING);
			
		}
		$sheetrows++;
		
		foreach($v as $krows => $vrows) {
			foreach($vrows as $kfield => $vfield) {
				$keyfield = $kfield . $sheetrows;
				$style_sheet[$kfield] = $vfield;
				$objPHPExcel->getActiveSheet()->setCellValue($keyfield, $vfield,PHPExcel_Cell_DataType::TYPE_STRING);
			}			
			$sheetrows++;
		}
		
		
		// LOOP STYLE
		foreach($style_sheet as $ksheet => $vsheet) {
			
			if($vsheet == '' || strlen($vsheet) < 5) {
				$objPHPExcel->getActiveSheet()->getColumnDimension($ksheet)->setWidth(10);
			} else {
				$objPHPExcel->getActiveSheet()->getColumnDimension($ksheet)->setAutoSize(true);
			}
			
			$objPHPExcel->getActiveSheet()->getStyle($ksheet . '1')->getFont()->setBold(true);
		}
		
		$sheetindex++;
	}
	
	$s_path = $path . '/Direct.xlsx';
	$objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel);
	$objWriter->save($s_path);
	
	return true;
}

function buat_pdf_tunai($data = array(), $path, $filename = '') {
	
	require_once(str_replace("module/","" , str_replace(basename(__DIR__) ,"" , __DIR__)) . 'plugins/html2pdf/_tcpdf_5.0.002/config/lang/eng.php');
	require_once(str_replace("module/","" , str_replace(basename(__DIR__) ,"" , __DIR__)) . 'plugins/html2pdf/_tcpdf_5.0.002/tcpdf.php');
	
	
	$divisi = list_divisi();
	foreach($data as $k => $v) {
		
		@reset($divisi);
		$html = '
			<table cellpadding="2" cellspacing="2" width="100%">
				<thead>
					<tr>
						<th align="center" colspan="9"><b>FORM PENGAJUAN KASBON</b></th>
					</tr>
					<tr>
						<th align="center" colspan="9">&nbsp;</th>
					</tr>
					<tr>
						<th align="left" width="12%">Tanggal</th><th align="left" width="5%">&nbsp; : &nbsp;</th><th align="left" width="20%">' . date('d/m/Y') . '</th>
						<th>&nbsp;</th><th>&nbsp;</th><th>&nbsp;</th>
						<th align="left" width="12%">Divisi</th><th align="left" width="5%">&nbsp; : &nbsp;</th><th align="left" width="20%">' . $divisi[$v['divisi']] . '</th>
					</tr>
					<tr>
						<th align="left" width="12%">Pemohon</th><th align="left" width="5%">&nbsp; : &nbsp;</th><th align="left" width="20%">' . $v['nama'] . '</th>
						<th width="20%">&nbsp;</th><th>&nbsp;</th><th>&nbsp;</th>
						<th>&nbsp;</th><th>&nbsp;</th><th>&nbsp;</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td colspan="9">
							<table width="100%" border="1" cellpadding="2" cellspacing="0">
								<thead>
									<tr>
										<th>No</th>
										<th>Uraian</th>
										<th>Jumlah</th>
										<th>Pembayaran</th>
										<th>Keterangan</th>
									</tr>
								</thead>
								<tbody>
									'. buat_row_cash($v['list']) .'
								</tbody>
							</table>
						</td>
					</tr>
				</tbody>
				<tfoot>
					<tr><td colspan="9">&nbsp;</td></tr>
					<tr>
						<td colspan="9">
							<table width="100%">
								<tr>
									<td width="25%">Yang Mengajukan,</td>
									<td>&nbsp;</td>
									<td>&nbsp;</td>
									<td width="25%">Keuangan,</td>
									<td>&nbsp;</td>
								</tr>
								<tr><td colspan="5">&nbsp;</td></tr>
								<tr><td colspan="5">&nbsp;</td></tr>
								<tr><td colspan="5">&nbsp;</td></tr>
								<tr><td colspan="5">&nbsp;</td></tr>
								<tr><td colspan="5">&nbsp;</td></tr>
								<tr><td colspan="5">&nbsp;</td></tr>
								<tr>
									<td width="25%"><hr /></td>
									<td>&nbsp;</td>
									<td>&nbsp;</td>
									<td width="25%"><hr /></td>
									<td>&nbsp;</td>
								</tr>
							</table>
						</td>
					</tr>
				</tfoot>
			</table>
		';
		
		@reset($divisi);
		if($filename == '') {
			
			$s_path = $path . '/Tunai '.$v['nama'].'('.$divisi[$v['divisi']].')'.'.pdf';
			$pdf = new TCPDF('P', PDF_UNIT, 'A4', true, 'UTF-8', false);
			
		} else {
			
			$set = ucwords($v['direct_mode']);
			$key = date('YmdHis', strtotime($v['tanggal'])) .' - '.$set.' '. $v['nama'] . '('. $divisi[$v['divisi']] .').pdf';
			
			$s_path = $path . '/' . $key;
			$pdf = new TCPDF('P', PDF_UNIT, 'A4', true, 'UTF-8', false);
			
		}
		
		$pdf->SetFont('dejavusans', '', 10);
		$pdf->AddPage();
		$pdf->writeHTML($html, true, false, true, false, '');
		$pdf->Output($s_path, 'F');
	}
	
	
	// foreach($data as $k => $v) {
		
		// @reset($divisi);
		// $objPHPExcel = new PHPExcel();
		// $objPHPExcel->getProperties()->setCreator("Konsultan Pendidikan Tinggi");
		// $objPHPExcel->getProperties()->setLastModifiedBy("Konsultan Pendidikan Tinggi");
		// $objPHPExcel->getProperties()->setTitle("Kasbon");
		// $objPHPExcel->getProperties()->setSubject("KPT :: Kasbon Tunai");
		// $objPHPExcel->getProperties()->setDescription("List data kasbon yang akan dibayarkan tunai.");
		
		// $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A1', "FORM PENGAJUAN KASBON");   
		// $objPHPExcel->getActiveSheet()->mergeCells('A1:F1');
		// $objPHPExcel->getActiveSheet()->getStyle('A1')->getFont()->setBold(TRUE);
		// $objPHPExcel->getActiveSheet()->getStyle('A1')->getFont()->setSize(14);
		
		// $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A3', "Tanggal");   
		// $objPHPExcel->getActiveSheet()->mergeCells('A3:B3');
		// $objPHPExcel->getActiveSheet()->getStyle('A3')->getFont()->setBold(TRUE);
		// $objPHPExcel->getActiveSheet()->getStyle('A3')->getFont()->setSize(12);
		
		// $objPHPExcel->setActiveSheetIndex(0)->setCellValue('C3', date('d/m/Y'));  
		// $objPHPExcel->getActiveSheet()->getStyle('C3')->getFont()->setBold(TRUE);
		// $objPHPExcel->getActiveSheet()->getStyle('C3')->getFont()->setSize(12);
		
		// $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A4', "Pemohon");   
		// $objPHPExcel->getActiveSheet()->mergeCells('A4:B4');
		// $objPHPExcel->getActiveSheet()->getStyle('A4')->getFont()->setBold(TRUE);
		// $objPHPExcel->getActiveSheet()->getStyle('A4')->getFont()->setSize(12);
		
		// $objPHPExcel->setActiveSheetIndex(0)->setCellValue('C4', $v['nama']);  
		// $objPHPExcel->getActiveSheet()->getStyle('C4')->getFont()->setBold(TRUE);
		// $objPHPExcel->getActiveSheet()->getStyle('C4')->getFont()->setSize(12);
		
		// $objPHPExcel->setActiveSheetIndex(0)->setCellValue('E3', "Divis : " . $divisi[$v['divisi']]);   
		// $objPHPExcel->getActiveSheet()->mergeCells('E3:F3');
		// $objPHPExcel->getActiveSheet()->getStyle('E3')->getFont()->setBold(TRUE);
		// $objPHPExcel->getActiveSheet()->getStyle('E3')->getFont()->setSize(12);
		
		// $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A7', "No");   
		// $objPHPExcel->setActiveSheetIndex(0)->setCellValue('B7', "Uraian");   
		// $objPHPExcel->getActiveSheet()->mergeCells('B7:C7');
		// $objPHPExcel->setActiveSheetIndex(0)->setCellValue('D7', "Jumlah");   
		// $objPHPExcel->setActiveSheetIndex(0)->setCellValue('E7', "Pembayaran");   
		// $objPHPExcel->setActiveSheetIndex(0)->setCellValue('F7', "Keterangan");
		
		// $no = 1;
		// $next_row = 8;
		// foreach($v['list'] as $klist => $vlist) {
			
			// $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A'.$next_row, $no);
			// $objPHPExcel->setActiveSheetIndex(0)->setCellValue('B'.$next_row, $vlist['uraian']);
			// $objPHPExcel->getActiveSheet()->mergeCells('B'.$next_row.':C'.$next_row);
			// $objPHPExcel->setActiveSheetIndex(0)->setCellValue('D'.$next_row, $vlist['jumlah']);
			// $objPHPExcel->setActiveSheetIndex(0)->setCellValue('E'.$next_row, $vlist['pembayaran']);
			// $objPHPExcel->setActiveSheetIndex(0)->setCellValue('F'.$next_row, $vlist['keterangan']);
			
			// $no++;
			// $next_row++;
		// }
		// @reset($divisi);
		// $s_path = $path . '/Tunai_'.$v['nama'].'('.$divisi[$v['divisi']].')'.'.xlsx';
		// $objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel);
		// $objWriter->save($s_path);
		
		// exit;
	// }
	
	return true;
}


function buat_row_cash($data=array()) {
	
	$no = 1;
	$row = '';
	foreach($data as $klist => $vlist) {
		
		$row .= '<tr>';
		$row .= '<td>'.$no.'</td>';
		$row .= '<td>'.$vlist['uraian'].'</td>';
		$row .= '<td>'.$vlist['jumlah'].'</td>';
		$row .= '<td>'.$vlist['pembayaran'].'</td>';
		$row .= '<td>'.$vlist['keterangan'].'</td>';
		$row .= '</tr>';
		
		$no++;
	}
	
	return $row;
}


function buat_data_download($path) {
	
	$zip = new ZipArchive;
	$zipname = $path . '.zip';
	
	if($zip->open($zipname, ZipArchive::CREATE) === TRUE) {
		
		$files = glob($path . '/*', GLOB_BRACE);
		foreach($files as $file) {
			if(is_file($file)) {
				$zip->addFile($file, end(@explode("/", $file)));
			}
		}
		$zip->close();
		
		$files = glob($path . '/*', GLOB_BRACE);
		foreach($files as $file) {
			if(is_file($file)) {
				
				$ext = pathinfo($file, PATHINFO_EXTENSION);				
				if($ext == 'pdf') {
					
				} else {
					unlink($file);
				}
			}
		}
		return true;
	}
	
	return false;
}

function list_divisi() {
	GLOBAL $db;
	
	
	$data = array();
	$dbopen = $db->koneksi();
	
	$sSQL = 'SELECT * FROM div_master';
	$query=mysql_query($sSQL) or die (mysql_error());
	while($row=mysql_fetch_assoc($query)) {
		$data[$row['div_id']] = $row['div_nm'];
	}
	
	mysql_close($dbopen);
	return $data;		
}




function printd($data = array(), $out =  true) {
	echo "<pre>" . print_r($data, 1) . "</pre>";
	if($out) exit;
}

header('Location: http://kpt.co.id/');
die();