<?php 


error_reporting(0);
date_default_timezone_set('Asia/Jakarta');
session_start();
require('../../class.php');
require('../../object.php');
//$db->koneksi();

class dataTable {
	protected $ssql;
	protected $whys = array();
	protected $config = array();
	public function __construct($config = array()) {		
		$this->config = $config;
	}
}


	
foreach($_REQUEST as $name=>$value)
	{
			$$name=$value;
			//echo "Name: $name : $value;<br />\n";
   }
   
//return;
   
if ($_REQUEST['jenis_kasbon'] <>""){
	$_SESSION['jenis_kasbon'] = $_REQUEST['jenis_kasbon'];
}


if(isset($_POST['mode']) && $_POST['mode'] <> '') {
	 
	if($_POST['mode'] == "list") {
		$db->koneksi();

		$id_kar = $_SESSION['kar'];
		$range_now = date('d/m/Y') . ' - ' . date('d/m/Y');
		$range_now_ori = date('Y-m-d') . ' - ' . date('Y-m-d');
		if ($tanggal <> ""){
		  $range_now_ori = $tanggal ;
		}
		//$range_now_ori = date('Y-m-d') . ' - ' . date('Y-m-d');
		//$range_now_ori = date('Y-m-d',strtotime('2020-01-01')) . ' - ' . date('Y-m-d');
		$range = @explode(" - ", $range_now_ori);
		$datestart = date('Y-m-d', strtotime(str_replace('/', '-', $range[0])));
		$dateend = date('Y-m-d', strtotime(str_replace('/', '-', $range[1])));
		$sFilter       = "";
		$filter_status = "";
		$filter_tgl = ' AND ( DATE_FORMAT(a.tanggal, "%Y-%m-%d") BETWEEN "' . $datestart . '" AND "'. $dateend . '" )';
		if ($status <> ""){
		   $filter_status =" AND a.status='$status' ";
		}
		
		$query = '';
		$output = array();
		$sFilter = " a.crur = '$id_kar' $filter_status $filter_tgl ";
		
		//echo $sFilter; return;
		
		$query .= "
					SELECT  a.*, b.ktr_kd, c.div_id,d.div_nm 
					FROM bni_direct_coba a
					LEFT JOIN ktr_master b ON a.kantor = b.ktr_id
					LEFT JOIN kar_master c ON a.nik = c.kar_nik
					LEFT JOIN div_master d ON c.div_id=d.div_id			
					WHERE 1=1 AND $sFilter
					";
		
		
		if(isset($_POST["search"]["value"]))
		{
			$query .= ' AND ( ';
			$query .= ' a.tanggal LIKE "%'.$_POST["search"]["value"].'%" ';
			$query .= ' OR nama LIKE "%'.$_POST["search"]["value"].'%" ';
			$query .= ' OR keperluan LIKE "%'.$_POST["search"]["value"].'%" ';
			$query .= ' OR nominal LIKE "%'.$_POST["search"]["value"].'%" ';
			$query .= ' ) ';
		}
		if(isset($_POST["order"]))
		{
			$query .= 'ORDER BY '.$_POST['order']['0']['column'].' '.$_POST['order']['0']['dir'].' ';
		}
		else
		{
			$query .= ' ORDER BY id ASC ';
		}
		$query_total = $query ;
		
		//echo $query_total;return;
		
		if($_POST["length"] != -1)
		{
			$query .= 'LIMIT ' . $_POST['start'] . ', ' . $_POST['length'];
		}
		
		
		$num_total = mysql_num_rows(mysql_query($query_total)); 
		$q_brg    = mysql_query($query);
		$data1 = array();
		while ($r=mysql_fetch_array($q_brg)){
			 $xstatus = "";
			 $class = "label-default";	 
			 $status = $r['status'];
			 if ($status=="0"){
				 $xstatus = "Menuggu";
				 $class = "label-info";
			 }elseif($status=="1"){
				 $xstatus = "Disetujui";
				 $class = "label-success";
			 }elseif($status=="2"){
				 $xstatus = "Ditolak";
				 $class = "label-danger";
			 }elseif($status=="3"){
				 $xstatus = "Dibatalkan";
				 $class = "label-danger";
			 }elseif($status=="99"){
				 $xstatus = "Dibayarkan";
				 $class = "label-payment";
			 
			 }
			 $xjnskasbon = "";
			 $jnskasbon = $r['jeniskasbon'];
			 if ($jnskasbon=="1"){
				 $xjnskasbon = "Operasional";
			 }elseif($jnskasbon=="2"){
				 $xjnskasbon = "Kuliah Perdana";
			 }elseif($jnskasbon=="3"){
				 $xjnskasbon = "Properti Marketing";
			 }elseif($jnskasbon=="4"){
				 $xjnskasbon = "Refund";
			 }
		
				  
				$xdata = $r['nik'].'#'.$r['tanggal']."#".$r['ktr_kd'];
				$list_item ='';
				if ($jnskasbon == "1" ||  $jnskasbon == "3"){
					$list_item =  '<button type="button" class=" btn  btn-primary  btn-xs" 
									onclick="CekPODetail(\''.$xdata.'\')"
									data-toggle="modal" 
									data-target="#myRekapDetail" title="Detail" style="" >
									<span class="glyphicon glyphicon-list"></span>
								   </button>
								   ';
				}
		
		  $sub_array = array();
		  $sub_array[] = $r['id'];
		//  $sub_array[] = date('d-m-Y',strtotime($r['tanggal']));
		  $sub_array[] = date('Y-m-d',strtotime($r['tanggal']));
		  $sub_array[] = $r['nama'];
		  $sub_array[] = $r['div_nm'];
		  $sub_array[] = $r['ktr_kd'];
		  $sub_array[] = '<div align="right"><b>'.number_format($r['nominal']).'</b></div>';
		  $sub_array[] = $xjnskasbon;
		  $sub_array[] = $r['keperluan'];
		  $sub_array[] = $r['catatan'];
		  $sub_array[] = '<span class="label '. $class .'">'. $xstatus .'</span>';  
		  if($r['status'] == '0') {
				$sub_array[]  = $list_item.' <button class="btn btn-danger btn-xs" title="Batalkan" 
							  onclick="batalpengajuan(\'' . $r['id'] . '\')"><i class="fa fa-ban"></i>
							 </button> ';
						
		  } else {
			   $sub_array[]  = $list_item.' '.'&nbsp; ' ;
		  }  
		//  array_push($data1,$r);
		  array_push($data1,$sub_array);
		   
		}
		
		
		$output = array(
			"draw"				=>	intval($_POST["draw"]),
			"recordsTotal"		=> 	$num_total,
			"recordsFiltered"	=>	$num_total,
			"data"				=>	$data1
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





function simpan_pengajuan($prop = array()) {
//    echo 'simpan-data !... ';return;
	GLOBAL $db;
	$attr_emp = array();
	$attr_bank = array();
	$dbopen = $db->koneksi(); 
	foreach($_REQUEST as $name=>$value)
	{
		$$name=$value;
		//echo "Name: $name : $value;<br />\n";
	}
	
	
	$nilai = intval($nominal) ;
	if ($nilai > 0 and $keperluan <> "" and $kantor <> "" and $kodebank <> "" ){
	     //////ok//////////////////////////////
	}else{
	    ///////data belum lengkap///////////
		$retuen = array('status'=>"0","msg"=>"gatot");
		return $retuen ;
	}

    //////////////////////////////////////////////////

	

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
	$savetodb['semester'] 	 = $prop['semester'];
	$savetodb['tahap'] 		 = $prop['tahap'];

	$savetodb['rowcsv'] = @implode(",", $data_direct);



	$sSQL = 'INSERT INTO bni_direct_coba ('. @implode(",", array_keys($savetodb)) .') VALUE ("'. @implode('","', array_values($savetodb)) .'")';

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
				$sSQL2 = 'INSERT INTO bni_direct_detail_coba ('. @implode(",", array_keys($savetodb2)) .') VALUE ("'. @implode('","', array_values($savetodb2)) .'")';
				if(mysql_query($sSQL2)){
				  //echo 'sukses';
				}
				
	
			  }	  
		   }
	      /////////////////////////// 
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
	$sSQL = 'UPDATE bni_direct_coba SET status = "3", catatan="' .$prop['catatan']. '", mddt = "' .date('Y-m-d H:i:s'). '", mdur="' . $_SESSION['kar'] . '"  WHERE id = "'.$prop['reff'].'"';

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



//header('Location: http://kpt.co.id/');
//die();

?>