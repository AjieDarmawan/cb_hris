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

			$this->whys['status'] = ' AND status = "' . $this->config['status'] . '"';

		}else {

			$this->whys['status'] = ' AND status IN (0,1,2, 99)';

		}

		

		if(isset($this->config['tanggal']) && $this->config['tanggal'] <> '') {			

			$range = @explode(" - ", $this->config['tanggal']);

			$datestart = date('Y-m-d', strtotime(str_replace('/', '-', $range[0])));

			$dateend = date('Y-m-d', strtotime(str_replace('/', '-', $range[1])));

			

			$this->whys['tanggal'] = ' AND DATE_FORMAT(tanggal, "%Y-%m-%d") BETWEEN "' . $datestart . '" AND "'. $dateend . '"';

		}else {

			$this->whys['tanggal'] = '';

		}

		

		if($_SESSION['kar'] == '88' ) {

			$this->whys['jeniskasbon'] = ' AND jeniskasbon IN ("4")';

		}elseif( $_SESSION['kar'] == '205' || $_SESSION['kar'] == '499' || $_SESSION['kar'] == '21' ) {
			$this->whys['jeniskasbon'] = ' AND jeniskasbon NOT IN ("4")';
		}elseif($_SESSION['kar'] == '459'  ) {

			$this->whys['jeniskasbon'] = '';

		}else{

			$this->whys['jeniskasbon'] = ' AND jeniskasbon = "10001"';

		}


	


		$this->ssql = '

			SELECT  a.*, b.ktr_kd, c.div_id

			FROM bni_direct a

			LEFT JOIN ktr_master b 

			ON a.kantor = b.ktr_id

			LEFT JOIN kar_master c 

			ON a.nik = c.kar_nik

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

//		mysql_close($dbopen);

		

		return $data;

	}

	

	public function count_all() {

		GLOBAL $db;

		

		$dbopen = $db->koneksi();		

		$this->datatable_query();

		

		$query=mysql_query($this->ssql) or die (mysql_error());

		$count = mysql_num_rows($query);

		//mysql_close($dbopen);

		

		return $count;

	}

	

	public function count_filtered() {

		GLOBAL $db;

		

		$dbopen = $db->koneksi();		

		$this->datatable_query();

		

		$query=mysql_query($this->ssql) or die (mysql_error());

		$count = mysql_num_rows($query);

		//mysql_close($dbopen);

		

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
			
			$list_item1 =  '<button type="button" class=" btn  btn-primary  btn-xs" 
							onclick="CekPODetail(\''.$xdata.'\')"
							data-toggle="modal" 
							data-target="#myRekapDetail" title="Pilih Items" style="" >
							<span class="glyphicon glyphicon-list"></span>
						   </button>
						   ';

			$list_item2 =  '<button type="button" class=" btn  btn-primary  btn-xs" 
							onclick="CekPODetail2(\''.$xdata.'\')"
							data-toggle="modal" 
							data-target="#myRekapDetail2" title="Pilih Items" style="" >
							<span class="glyphicon glyphicon-list"></span>
						   </button>
						   ';
			$list_item = $list_item2;
			if ($rows['status'] == '0'){
			   $list_item=$list_item1;
			}
						   			
			if ($rows['jeniskasbon'] <> "1"){
			  $list_item ='';
			}		
			
			if($rows['status'] == '0') {
				$ctrl  = $list_item;
				$ctrl .= '<button class="btn btn-success btn-xs" title="Setuju" onclick="approvalpengajuan(\'' . $rows['id'] . '\', \'1\')"><i class="fa fa-check-square-o"></i></button>';

				$ctrl .= '&nbsp;<button class="btn btn-danger btn-xs" title="Tolak" onclick="approvalpengajuan(\'' . $rows['id'] . '\', \'2\')"><i class="fa fa-ban"></i></button>';
				
               
				$row[] = $ctrl;

			} else {

				$row[] = $list_item.' '.'&nbsp; ';

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

	

	

	elseif($_POST['mode'] == "approval") {

		$output = approval_pengajuan($_POST);

		

		echo json_encode($output);

		die();

	}

	

	else{

		header('Location: http://kpt.co.id/');

		die();

	}

}



function approval_pengajuan($prop = array()) {

	GLOBAL $db;

	

	$dbopen = $db->koneksi(); 

	

	$sSQL = '

		UPDATE bni_direct 

		SET status = "' . $prop['stat'] . '", 

			catatan = "' . $prop['catatan']. '",

			approveby = "' . $_SESSION['kar'] . '",

			approvedate = "' . date('Y-m-d H:i:s') . '",

			mddt = "' . date('Y-m-d H:i:s') . '",

			mdur = "' . $_SESSION['kar'] . '"

		WHERE id = "'. $prop['reff'] .'"';

	if(mysql_query($sSQL)) {

		$retuen = array('status'=>"1","msg"=>"berhasil");

	} else {

		$retuen = array('status'=>"0","msg"=>"gatot");

	}

	

	//mysql_close($dbopen);

	return $retuen;

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

	

	//mysql_close($dbopen);

	return $data;		

}











function printd($data = array(), $out =  true) {

	echo "<pre>" . print_r($data, 1) . "</pre>";

	if($out) exit;

}



header('Location: http://kpt.co.id/');

die();