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
			$this->whys['status'] = ' AND a.status = "' . $this->config['status'] . '"';
		}else {
			$this->whys['status'] = '';
		}
		
		if(isset($this->config['tanggal']) && $this->config['tanggal'] <> '') {			
			$range = @explode(" - ", $this->config['tanggal']);
			$datestart = date('Y-m-d', strtotime(str_replace('/', '-', $range[0])));
			$dateend = date('Y-m-d', strtotime(str_replace('/', '-', $range[1])));
			
			$this->whys['tanggal'] = ' AND DATE_FORMAT(a.tanggal, "%Y-%m-%d") BETWEEN "' . $datestart . '" AND "'. $dateend . '"';
		}else {
			$this->whys['tanggal'] = '';
		}

		$this->ssql = '
			SELECT * FROM bank_kliring_tes ORDER BY nama_bank
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
		$dataTable = new dataTable($_POST);
		$listdata = $dataTable->get_datatables();
		
		$data = array();
		$no = $_POST['start'];
		
		foreach ($listdata as $rows) {	
			$class = "label-default";			
			$no++;
			$row = array();
			$row[] = $no;
			$row[] = $rows['kode_rtgs'];
			$row[] = $rows['kode_kliring'];
			$row[] = $rows['kode_bank'];
			$row[] = $rows['nama_bank'];
			$row[] = $rows['singkatan'];
			$row[] = $rows['kode_branch'];
			$row[] = $rows['nama_branch'];
			$row[] = $rows['kota'];
			$row[] = '<button class="btn btn-primary btn-xs" title="Update" onclick="updatedatabank(\'' . $rows['id'] . '\', \'' . $rows['nama_bank'] . '\', \'' . $rows['singkatan'] . '\',\'' . $rows['kode_branch'] . '\',\'' . $rows['nama_branch'] . '\',\'' . $rows['kota'] . '\')"><i class="fa fa-pencil"></i></button>';
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
	
	elseif($_POST['mode'] == "update") {
		$output = update_databank($_POST);
		
		echo json_encode($output);
		die();
	}

	else{
		header('Location: http://kpt.co.id/');
		die();
	}
}



function simpan_databank($prop = array()) {
	GLOBAL $db;
	
	
	$attr_emp = array();
	$attr_bank = array();
	$dbopen = $db->koneksi(); 
	
	
	// AMBIL DATA KARYAWAN
	$sSQL = 'SELECT a.kar_nik, a.kar_nm  FROM kar_master a WHERE a.kar_id = "' . $_SESSION['kar'] . '"';
	$query = mysql_query($sSQL) or die (mysql_error());
	while($row = mysql_fetch_assoc($query)) {
		$attr_emp = $row;
	}
	
	
	// AMBIL DATA BANK 
	$sSQL = '
		SELECT a.*, kode_rtgs, b.kode_kliring, c.singkatan as bank_tujuan
		FROM (
			SELECT a.* 
			FROM bank_listrek a
			WHERE a.id = "' . $prop['kodebank'] . '"
		) as a
		LEFT JOIN bank_kliring b
		ON b.status = 1
			AND a.kode_bank = b.kode_bank 
			AND a.kota = b.kota
		LEFT JOIN bank_master c
		ON a.kode_bank = c.kodebank
		WHERE 1=1
	';
	$query = mysql_query($sSQL) or die (mysql_error());
	while($row = mysql_fetch_assoc($query)) {
		$attr_bank = $row;
	}
	
	// TENTUKAN REMARK
	if(strlen($prop['keperluan']) <= 33) {
		$attr_bank['remark1'] = $prop['keperluan'];
	}elseif(strlen($prop['keperluan']) > 33 && strlen($prop['keperluan']) <= 50) {
		$attr_bank['remark2'] = $prop['keperluan'];
	}elseif(strlen($prop['keperluan']) > 50 && strlen($prop['keperluan']) <= 100) {
		$attr_bank['remark3'] = $prop['keperluan'];
	}
	
	$data_direct = getDirectdata($attr_bank, $prop);
	
	$savetodb = array();
	$savetodb['direct_mode'] = $data_direct['direct_mode'];
	unset($data_direct['direct_mode']);
	
	
	$savetodb['nik'] = $attr_emp['kar_nik'];
	$savetodb['nama'] = $attr_emp['kar_nm'];
	$savetodb['tanggal'] = date('Y-m-d H:i:s');
	$savetodb['kantor'] = $prop['kantor'];
	$savetodb['nominal'] = $prop['nominal'];
	$savetodb['userek'] = $prop['kodebank'];
	$savetodb['keperluan'] = $prop['keperluan'];
	$savetodb['status'] = '0';
	$savetodb['crdt'] = date('Y-m-d H:i:s');
	$savetodb['crur'] = $_SESSION['kar'];
	$savetodb['mddt'] = date('Y-m-d H:i:s');
	$savetodb['mdur'] = $_SESSION['kar'];
	$savetodb['rowcsv'] = @implode(",", $data_direct);
	
	$sSQL = 'INSERT INTO bni_direct ('. @implode(",", array_keys($savetodb)) .') VALUE ("'. @implode('","', array_values($savetodb)) .'")';
	if(mysql_query($sSQL)) {
		$retuen = array('status'=>"1","msg"=>"berhasil");
	} else {
		$retuen = array('status'=>"0","msg"=>"gatot");
	}
	mysql_close($dbopen);
	return $retuen;
}

function update_databank($prop = array()) {
	GLOBAL $db;
	
	$dbopen = $db->koneksi(); 
	
	$sSQL = 'UPDATE bank_kliring_tes SET  nama_bank="' .$prop['namabank']. '", singkatan="' .$prop['singkatan']. '", kode_branch="' .$prop['kodebranch']. '", nama_branch="' .$prop['namabranch']. '", kota="' .$prop['kota']. '"  WHERE id = "'.$prop['reff'].'"';
	
	if(mysql_query($sSQL)) {
		$retuen = array('status'=>"1","msg"=>"berhasil");
	} else {
		$retuen = array('status'=>"0","msg"=>"gatot");
	}
	
	mysql_close($dbopen);
	return $retuen;
}

header('Location: http://kpt.co.id/');
die();