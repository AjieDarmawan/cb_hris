<?php

error_reporting(E_ALL ^ E_NOTICE);

date_default_timezone_set('Asia/Jakarta');

session_start();



class Database{

	private $db_host="103.86.160.12:3337";

	private $db_user="gilland";

	private $db_pass="tes30052012";

	private $db_name="gg_sipema";



	function koneksi(){

		@$conn = mysql_connect($this->db_host,$this->db_user,$this->db_pass) or die (mysql_error());

		if($conn){

			mysql_select_db($this->db_name) or die (mysql_error());

		}else{

			echo"koneksi gagal";

		}

	}



}



class DatabaseReg{

	private $db_host="103.86.160.12:3337";

	private $db_user="gilland";

	private $db_pass="tes30052012";

	private $db_name="gg_reguler";



	function koneksi_reg(){

		@$conn_reg = mysql_connect($this->db_host,$this->db_user,$this->db_pass) or die (mysql_error());

		if($conn_reg){

			mysql_select_db($this->db_name) or die (mysql_error());

		}else{

			echo"koneksi reguler gagal";

		}

	}



}



class Pts{

	function pts_tampil(){

		$sql="SELECT * FROM `gg_sipema`.datapt1 WHERE aktif='1'";

		$query=mysql_query($sql) or die (mysql_error());

		return $query;	

	}

	function ptsx_tampil($kpt)
	{

		$sql = "SELECT COUNT(*) FROM `gg_reguler`.datapt1 WHERE kpt='$kpt' AND aktif='1'";

		$query = mysql_query($sql) or die(mysql_error());

		return $query;
	}

}



class Kpi {

        function kpi_grab_bio($syntac_union){

		$sql="SELECT * FROM ($syntac_union) bio ORDER BY tgl_daftar ASC";

		$query=mysql_query($sql) or die (mysql_error());

		return $query;	

	}

}





$db=new Database();

$dbg=new DatabaseReg();

$pts = new Pts();

$kpi = new Kpi();



$db->koneksi();

$dbg->koneksi_reg();



$username = str_replace('.','',$_POST['kar_nik']);

$r_awal_ori = $_POST['start'];

$r_sekarang_ori = $_POST['end'];



/*$username = 'SG00312007';

$r_awal_ori = '2018-09-01';

$r_sekarang_ori = '2018-09-02';*/



$kptArr = array();

$ptsArr = array();



$pts_tampil = $pts->pts_tampil();

while($pts_data = mysql_fetch_assoc($pts_tampil)){

    $kptArr[]=array('kpt' => $pts_data['kpt'],

		    'reguler' => $pts_data['reguler']);

}



$kptCount = count($kptArr);



$z=0;

for($i=0; $i<$kptCount; $i++){

    

    $kpt = $kptArr[$i]['kpt'];

    $tb_bio_baru = $kpt."_bio_baru";
    $tb_rea_baru = $kpt."_rea_baru";

    $tb_xbio_baru = $kpt."_xbio_baru";
    $tb_xrea_baru = $kpt."_xrea_baru";

    

    $z = $z + 1;

    $ptsArr[$z] = $tb_bio_baru;
    $ptsReaArr[$z] = $tb_rea_baru;

    $regArr[$z] = $tb_xbio_baru;
    $regReaArr[$z] = $tb_xrea_baru;

    $regCek[$z] = $kptArr[$i]['reguler'];

    

}



$ptsCount = count($ptsArr);



$syntac_union = "";

//$field = "biobid,kodept,angkatan,status,nosel,no_pokok,nama,kodefak,kodejrs,kelompok,virtu_acc,no_hp,email,tgl_daftar,potong_spb,potong_spp,smb_informasi,hp_rekomendasi,nama_rekomendasi,kode_agent,kode_gsf,kpi";

/*$field = "a.biobid,
       a.kodept,
       a.angkatan,
       a.status,
       a.nosel,
       a.no_pokok,
       a.nama,
       a.kodefak,
       a.kodejrs,
       a.kelompok,
       a.virtu_acc,
       a.no_hp,
       a.email,
       a.tgl_daftar,
       a.potong_spb,
       a.potong_spp,
       a.smb_informasi,
       a.hp_rekomendasi,
       a.nama_rekomendasi,
       a.kode_agent,
       a.kode_gsf,
       b.singkatan,
       c.namajrs,
       a.kpi";*/

$field = "a.biobid,
       a.kodept,
       a.angkatan,
       a.status,
       a.nosel,
       a.no_pokok,
       a.nama,
       a.kodefak,
       a.kodejrs,
       a.kelompok,
       a.virtu_acc,
       a.no_hp,
       a.email,
       a.tgl_daftar,
       a.potong_spb,
       a.potong_spp,
       a.smb_informasi,
       a.hp_rekomendasi,
       a.nama_rekomendasi,
       a.kode_agent,
       a.kode_gsf,
       b.singkatan,
       c.namajrs,
       d.tanggal,
       a.kpi";
       

       
for($i=1; $i<=$ptsCount; $i++){

    if($i !== $ptsCount){ $union = " UNION ALL "; }else{ $union = ""; }

    //$syntac_union .= "(SELECT $field FROM `gg_sipema`.$ptsArr[$i] WHERE kpi='$username' AND tgl_daftar BETWEEN '$r_awal_ori' AND '$r_sekarang_ori')".$union;
    //$syntac_union .= "(SELECT $field FROM `gg_sipema`.$ptsArr[$i] AS a,`gg_sipema`.datapt1 AS b,`gg_sipema`.datajrs AS c WHERE a.kodept = b.kodept3 AND a.kodept = c.kodept AND a.kodejrs=c.kodejrs AND a.kpi='$username' AND a.tgl_daftar BETWEEN '$r_awal_ori' AND '$r_sekarang_ori')".$union;
    $syntac_union .= "(SELECT $field FROM `gg_sipema`.$ptsArr[$i] AS a,`gg_sipema`.datapt1 AS b,`gg_sipema`.datajrs AS c, `gg_sipema`.$ptsReaArr[$i] AS d WHERE a.kodept = b.kodept3 AND a.kodept = c.kodept AND a.kodejrs=c.kodejrs AND a.biobid=d.id AND a.kpi='$username' AND d.formulir !='0' AND d.formulir_ke = '1' AND IF(d.tgl_transfer != NULL AND d.tgl_transfer != '', d.tgl_transfer, d.tanggal) BETWEEN '$r_awal_ori' AND '$r_sekarang_ori')".$union;
    

    if($regCek[$i]==1){
	
		$kptreg = explode('_', $regArr[$i]);
		$ptsx_tampil = $pts->ptsx_tampil($kptreg[0]);
		$ptsx_cek = mysql_num_rows($ptsx_tampil);

		if ($ptsx_cek > 0 && $i == $ptsCount) {

			$xunion = " UNION ALL ";
			//$syntac_union .= $xunion . "(SELECT $field FROM `gg_reguler`.$regArr[$i] WHERE kpi='$username' AND tgl_daftar BETWEEN '$r_awal_ori' AND '$r_sekarang_ori')".$union;
			//$syntac_union .= $xunion . "(SELECT $field FROM `gg_reguler`.$regArr[$i] AS a,`gg_reguler`.datapt1 AS b,`gg_reguler`.datajrs AS c WHERE a.kodept = b.kodept3 AND a.kodept = c.kodept AND a.kodejrs=c.kodejrs AND a.kpi='$username' AND a.tgl_daftar BETWEEN '$r_awal_ori' AND '$r_sekarang_ori')".$union;
			$syntac_union .= $xunion . "(SELECT $field FROM `gg_reguler`.$regArr[$i] AS a,`gg_reguler`.datapt1 AS b,`gg_reguler`.datajrs AS c, `gg_reguler`.$regReaArr[$i] AS d WHERE a.kodept = b.kodept3 AND a.kodept = c.kodept AND a.kodejrs=c.kodejrs AND a.biobid=d.id AND a.kpi='$username' AND d.formulir !='0' AND d.formulir_ke = '1' AND IF(d.tgl_transfer != NULL AND d.tgl_transfer != '', d.tgl_transfer, d.tanggal) BETWEEN '$r_awal_ori' AND '$r_sekarang_ori')".$union;
		}elseif ($ptsx_cek > 0) {

			$xunion = "";
			//$syntac_union .= "(SELECT $field FROM `gg_reguler`.$regArr[$i] WHERE kpi='$username' AND tgl_daftar BETWEEN '$r_awal_ori' AND '$r_sekarang_ori')".$union;
			//$syntac_union .= $xunion . "(SELECT $field FROM `gg_reguler`.$regArr[$i] AS a,`gg_reguler`.datapt1 AS b,`gg_reguler`.datajrs AS c WHERE a.kodept = b.kodept3 AND a.kodept = c.kodept AND a.kodejrs=c.kodejrs AND a.kpi='$username' AND a.tgl_daftar BETWEEN '$r_awal_ori' AND '$r_sekarang_ori')".$union;
			$syntac_union .= $xunion . "(SELECT $field FROM `gg_reguler`.$regArr[$i] AS a,`gg_reguler`.datapt1 AS b,`gg_reguler`.datajrs AS c, `gg_reguler`.$regReaArr[$i] AS d WHERE a.kodept = b.kodept3 AND a.kodept = c.kodept AND a.kodejrs=c.kodejrs AND a.biobid=d.id AND a.kpi='$username' AND d.formulir !='0' AND d.formulir_ke = '1' AND IF(d.tgl_transfer != NULL AND d.tgl_transfer != '', d.tgl_transfer, d.tanggal) BETWEEN '$r_awal_ori' AND '$r_sekarang_ori')".$union;
		}
	
    }

}



/*echo "<pre>";

print_r($ptsArr);

echo "</pre>";*/



//echo $syntac_union; exit();



$exp_filed = explode(',',$field);

$dataText = "";

$dataText1 = "";

$dataText2 = "";

$jumlah = 0;

$jumlah2 = 0;

$hasComma = false;

$hasComma1 = false;

$hasComma2 = false;

$kpi_grab_bio=$kpi->kpi_grab_bio($syntac_union);

$jumlah = mysql_num_rows($kpi_grab_bio);

$no = 1;

while($data = mysql_fetch_array($kpi_grab_bio)){
	
	if ($hasComma){ 

	    $dataText .= ",";
    
	}
    
	
	$hasTag = false;
    
	for($i=0;$i<count($exp_filed);$i++){
    
	    $expdot = explode(".",$exp_filed[$i]);
    
	    ${$expdot[1]} = $data[$expdot[1]];
    
	    
    
	    if ($hasTag){ 
    
		$dataText .= "#";
    
	    }
    
	    $dataText .= ${$expdot[1]};
    
	    $hasTag = true;
    
	}
    
	
    
	$hasComma=true;
    

	$jumlahArr[] = $no;

	

	$herregis = 0;

    

	$cid = "056";

	$secret = "0bf499cac9da37f2f96c866219ad416a";

	$nopem = $data['virtu_acc'];

	

	$url = "http://103.86.160.10/api-services/v2/biodata";

	$header = array(

		'Content-Type: application/x-www-form-urlencoded',

		'Connection: keep-alive'

	);

	

	$fields = array(

		'cid' => urlencode($cid),

		'secret' => urlencode($secret),

		'npm' => urlencode($nopem)

	);

	

	

	$fields_string = '';

	foreach($fields as $key1=>$value1) { $fields_string .= $key1.'='.$value1.'&'; }

	rtrim($fields_string, '&');

	

	$curl = curl_init();

	

	curl_setopt_array($curl, array(

		CURLOPT_URL => $url,

		CURLOPT_RETURNTRANSFER => true,

		CURLOPT_ENCODING => "",

		CURLOPT_MAXREDIRS => 10,

		//CURLOPT_TIMEOUT => 30,

		CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,

		CURLOPT_CUSTOMREQUEST => "POST",

		CURLOPT_POSTFIELDS => $fields_string,

		CURLOPT_HTTPHEADER => $header,

	));

	

	

	$response = curl_exec($curl);

	$err = curl_error($curl);

	

	curl_close($curl);

	

	$datares = json_decode($response, true);

	

	

	///////////////////////////////////////////////////////////////////////////////////////

	

	

	if($datares['status'] == "success"){

	    

	    $herSPBrp = $datares['data_rr']['spb']['realita'][0]['rp'];

	    $herSPPrp = $datares['data_rr']['spp']['realita'][1][0]['rp'];

	    

	    $herregis = $herSPBrp + $herSPPrp; 

	    

	}

	

	if($herregis > 0){

	

		if ($hasComma1){ 

		    $dataText1 .= ",";

		}

		

		$hasTag1 = false;

		for($i=0;$i<count($exp_filed);$i++){

		    $expdot = explode(".",$exp_filed[$i]);

		    ${$expdot[1]} = $data[$expdot[1]];

		    

		    if ($hasTag1){ 

			$dataText1 .= "#";

		    }

		    $dataText1 .= ${$expdot[1]};

		    $hasTag1 = true;

		}

		

		$hasComma1=true;

		

		$jumlah1Arr[] = $no;

    

    

		if(($data['potong_spb'] == '' || $data['potong_spb'] == NULL || $data['potong_spb'] == 0) &&

		   ($data['potong_spp'] == '' || $data['potong_spp'] == NULL || $data['potong_spp'] == 0) &&

		   ($data['hp_rekomendasi'] == '' || $data['hp_rekomendasi'] == NULL) &&

		   ($data['nama_rekomendasi'] == '' || $data['nama_rekomendasi'] == NULL) &&

		   ($data['kode_agent'] == '' || $data['kode_agent'] == NULL) &&

		   ($data['kode_gsf'] == '' || $data['kode_gsf'] == NULL) &&
		   
		   ($data['smb_informasi'] !== 'Teman' && $data['smb_informasi'] !== 'Rekomendasi' && $data['smb_informasi'] !== 'Agency' && $data['smb_informasi'] !== 'GSF' && $data['smb_informasi'] !== 'eduAgent')){

		

	     

			    if ($hasComma2){ 

				$dataText2 .= ",";

			    }

			    

			    $hasTag2 = false;

			    for($z=0;$z<count($exp_filed);$z++){

				$expdot = explode(".",$exp_filed[$z]);

				${$expdot[1]} = $data[$expdot[1]];

				

				if ($hasTag2){ 

				    $dataText2 .= "#";

				}

				$dataText2 .= ${$expdot[1]};

				$hasTag2 = true;

			    }

			    

			    $hasComma2=true;

			    

			    $jumlah2Arr[] = $no;

		    

		    

		}

	}

    

    ///////////////////////////////////////////////////////

    

    $no++;

    

}



$jumlah1 = count($jumlah1Arr);

$jumlah2 = count($jumlah2Arr);



$dataArr = array($jumlah,$dataText,$jumlah1,$dataText1,$jumlah2,$dataText2);
//$dataArr = array($jumlah,$jumlah1,$jumlah2);

//$dataArr2 = array($jumlah2,$dataText2);



/*echo"<pre>";

print_r($dataArr);

echo"</pre>";*/



echo json_encode($dataArr);

?>