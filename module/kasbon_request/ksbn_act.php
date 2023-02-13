
<?php 


error_reporting(0);

date_default_timezone_set('Asia/Jakarta');

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

			SELECT  a.*, b.ktr_kd, c.div_id

			FROM bni_direct a

			LEFT JOIN ktr_master b 

			ON a.kantor = b.ktr_id

			LEFT JOIN kar_master c 

			ON a.nik = c.kar_nik

			WHERE 1=1 

				AND a.crur = "' . $_SESSION['kar'] . '" 

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

			$row[] = '<span class="label '. $class .'">'. $arrstatus[$rows['status']] .'</span>';
			
			$xdata = $rows['nik'].'#'.$rows['tanggal']."#".$rows['ktr_kd'];
			$list_item =  '<button type="button" class=" btn  btn-primary  btn-xs" 
							onclick="CekPODetail(\''.$xdata.'\')"
							data-toggle="modal" 
							data-target="#myRekapDetail" title="Detail" style="" >
							<span class="glyphicon glyphicon-list"></span>
						   </button>
						   ';
	
			if ($rows['jeniskasbon'] <> "1"){
			  $list_item ='';
			}			   
			if($rows['status'] == '0') {
				$row[] = $list_item.' <button class="btn btn-danger btn-xs" 
						  onclick="batalpengajuan(\'' . $rows['id'] . '\')"><i class="fa fa-ban"></i>
						 </button> ';
					
			} else {
				$row[] = $list_item.' '.'&nbsp; ' ;
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

	

	elseif($_POST['mode'] == "simpan") {
		//echo "simpan sini ... ";exit;	
		$output = simpan_pengajuan($_POST);
		echo json_encode($output);
		die();

	}
	
	
	elseif($_POST['mode'] == "simpan_opt") {
//		echo "sini aja...";exit;	
		$output = simpan_pengajuan_opt($_POST);
	    echo json_encode($output);
		die();

	}

	

	elseif($_POST['mode'] == "batal") {

		$output = batalkan_pengajuan($_POST);

		

		echo json_encode($output);

		die();

	}

	

	else{

		header('Location: http://kpt.co.id/');

		die();

	}

}



function simpan_pengajuan_opt($prop = array()) {
    
	GLOBAL $db;
	$attr_emp = array();
	$attr_bank = array();
	$dbopen = $db->koneksi(); 
//	echo $prop['keperluan'];
   $jml_items = count($prop['kode_barang']);
//   echo $jml_items.'<br>';
//   echo $prop['nama_barang'][0].'<br>';
   for ($i=0; $i < $jml_items; $i++){
      $kdbrg = $prop['kode_barang'][$i];
	  if ($kdbrg <> ""  ){
	      echo $kdbrg.'<br>';
	  }	  
   }
	
	
}



function simpan_pengajuan($prop = array()) {
    
//    echo 'simpan-data !... ';return;

	GLOBAL $db;
	
	$attr_emp = array();

	$attr_bank = array();

	$dbopen = $db->koneksi(); 

	

	

	// AMBIL DATA KARYAWAN

	$sSQL = '

		SELECT a.kar_nik, a.kar_nm, b.kar_dtl_eml 

		FROM kar_master a 

		LEFT JOIN kar_detail b

		ON a.kar_id = b.kar_id

		WHERE a.kar_id = "' . $_SESSION['kar'] . '"';

	$query = mysql_query($sSQL) or die (mysql_error());

	while($row = mysql_fetch_assoc($query)) {

		$attr_emp = $row;

	}

	

	

	// AMBIL DATA BANK 

	$sSQL = '

		SELECT a.*, kode_rtgs, b.kode_kliring, c.singkatan as bank_tujuan,b.inhouse

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

	

	$prop['email'] = $attr_emp['kar_dtl_eml'];

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

	$savetodb['jeniskasbon'] = $prop['jeniskasbon'];

	$savetodb['rowcsv'] = @implode(",", $data_direct);


	$sSQL = 'INSERT INTO bni_direct ('. @implode(",", array_keys($savetodb)) .') VALUE ("'. @implode('","', array_values($savetodb)) .'")';

  /////////////////save-item-barang////////////////////// 
       $savetodb2 = array();
	   $jml_items = count($prop['kode_barang']);
		//echo $prop['nama_barang'][0].'<br>';
	   $total = 0;	
	   for ($i=0; $i < $jml_items; $i++){
		  $kdbrg = $prop['kode_barang'][$i];
		  $nmbrg = $prop['nama_barang'][$i];
		  $qty	 = $prop['qty'][$i];
		  $hrg	 = $prop['harga'][$i];
		  $subtot = ($qty * $hrg);
		  $total += $subtot;
		  if ($kdbrg <> ""  ){
			   $savetodb2['nik']          = $attr_emp['kar_nik'];
			   $savetodb2['nama']         = $attr_emp['kar_nm'];
			   $savetodb2['tanggal']      = $savetodb['tanggal'];
			   $savetodb2['kantor']       = $savetodb['kantor'];
			   $savetodb2['status']       = $savetodb['status'];
			   $savetodb2['kar_id']       = $_SESSION['kar'];
			   $savetodb2['kode_barang']  = $kdbrg;
			   $savetodb2['nama_barang']  = $nmbrg;
			   $savetodb2['qty']  		  = $qty;
			   $savetodb2['harga']  	  = $hrg;
			   $savetodb2['total']  	  = $subtot;
//			   $savetodb2['status']  	  = '1';
			 // echo $kdbrg.'/'.$nmbrg.' '.$qty.' '.$hrg.' = '.$subtot.'<br>';
			$sSQL2 = 'INSERT INTO bni_direct_detail ('. @implode(",", array_keys($savetodb2)) .') VALUE ("'. @implode('","', array_values($savetodb2)) .'")';
			if(mysql_query($sSQL2)){
			  //echo 'sukses';
			}

		  }	  
	   }
	   
	   
		//echo 'Total:'.$total.'<br>';
	   //echo $sSQL2;return;
	
	////////////////////////////////////////////////


	if(mysql_query($sSQL)) {
		$retuen = array('status'=>"1","msg"=>"berhasil");
	} else {
		$retuen = array('status'=>"0","msg"=>"gatot");

	}
	
	mysql_close($dbopen);

	return $retuen;

}



function batalkan_pengajuan($prop = array()) {

	GLOBAL $db;

	

	$dbopen = $db->koneksi(); 

	

	$sSQL = 'UPDATE bni_direct SET status = "3", catatan="' .$prop['catatan']. '", mddt = "' .date('Y-m-d H:i:s'). '", mdur="' . $_SESSION['kar'] . '"  WHERE id = "'.$prop['reff'].'"';

	if(mysql_query($sSQL)) {

		$retuen = array('status'=>"1","msg"=>"berhasil");

	} else {

		$retuen = array('status'=>"0","msg"=>"gatot");

	}

	

	mysql_close($dbopen);

	return $retuen;

}



function getDirectdata($prop = array(), $data = array()) {

	

	$patern_IFT = array();

	

	$patern_autodebet = array();

	

	$basic_pattern = array(

		'norek' => '',			// Length: 16	----> Rek. Tujuan

		'atasnama' => '',		// Length: 40	----> Nama Penerima

		'nominal' => '',		// Length: 11	----> Amount

		'remark1' => '',		// Length: 33	---->

		'remark2' => '',		// Length: 50	---->

		'remark3' => '',		// Length: 100	---->

		'kode_rtgs' => '',		// Length: 8	----> RTGS Member

		'bank_tujuan' => '',	// Length: 35	---->

		'nama_cabang' => '',	// Length: 100	---->

		'alamat_bank1' => '',	// Length: 50	---->

		'alamat_bank2' => '',	// Length: 50	---->

		'alamat_bank3' => '',	// Length: 50	---->

		'nama_kota' => '',		// Length: 100	---->

		'nama_negara' => '',	// Length: 100	---->

		'warga_negara' => '',	// Length: 40	---->

		'kode_wn' => '',		// Length: 40	---->

		'email_flag' => '',		// Length: 1	---->

		'email' => '',			// Length: 100	---->

		'kode_reff' => '',		// Length: 16	----> Reff Num

		'reff_flag' => ''		// Length: 1	---->

	);

	

	

	$rowdata = array();

	$rowdata = $basic_pattern;

	

	// CEK INHOUSE 

	if(isset($prop['inhouse']) && $prop['inhouse'] == '1') {

		$rowdata['direct_mode'] = 'Inhouse';

	} elseif($prop['kode_bank'] == '-1') {

		// KALO CASH

		$rowdata['direct_mode'] = 'CASH';

	} else {		

		// CEK NOMINAL 

		if((int)$data['nominal'] > 500000000) {

			$rowdata['direct_mode'] = 'RTGS';

		} else {

			$rowdata['direct_mode'] = 'Kliring';

		}

	}

	

	// DATA ROW CSV

	$savedata = array();

	foreach($rowdata as $k => $v) {

		

		@reset($data);

		@reset($prop);

		

		$val = $v;

		if(isset($data[$k])) {

			$val = $data[$k];

		} elseif(isset($prop[$k])) {

			$val = $prop[$k];

		}		

		$savedata[$k] = $val;

	}

	

	

	if(isset($savedata['email']) && $savedata['email'] <> '') {

		$savedata['email_flag'] = 1;

	}

	

	if(isset($savedata['kode_reff']) && $savedata['kode_reff'] <> '') {

		$savedata['reff_flag'] = 1;

	}

	

	return $savedata;

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