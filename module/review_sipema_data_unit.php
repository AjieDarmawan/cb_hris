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
 
		$sql="SELECT * FROM `gg_sipema`.datapt1 WHERE aktif='1' ";

		$query=mysql_query($sql) or die (mysql_error());

		return $query;	

	}

	function pts_tampil_unit($filter_kpt){
 
		$sql="SELECT * FROM `gg_sipema`.datapt1 WHERE aktif='1'  $filter_kpt ";

		$query=mysql_query($sql) or die (mysql_error());

		return $query;
	

	}

	function ptsx_tampil($kpt)
	{

		$sql = "SELECT COUNT(*) FROM `gg_reguler`.datapt1 WHERE kpt='$kpt' AND aktif='1'";

		$query = mysql_query($sql) or die(mysql_error());
		
		return $query;
  
	}

	function pts_user($username){

		$sql="SELECT pts FROM `gg_sipema`.users WHERE username = '$username' ";

		$query=mysql_query($sql) or die (mysql_error());

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


//////////////////////////////////////
/*
$username 		= 'SG03102016';
$r_awal_ori 	= '2018-07-01';
$r_sekarang_ori = '2018-07-21';
*/
////////////////////////////////////

$UserArr = array();
$pts_user = $pts->pts_user($username);
while($r = mysql_fetch_assoc($pts_user)){
    $UserArr[]=array('pts' => $r['pts'],'sipema' => $r['sipema']);

}
/////////////////////////////////////////////////
$kpt 		=  $UserArr[0]['pts'] ;
$xpts 		= explode(",",$kpt) ;
$cek_pts 	= $xpts[0];
$ptsCount 	= count($xpts);
$q_kpt 		= "";
for($i=0; $i < $ptsCount; $i++){
  $vkpt   = $xpts[$i];
  $q_kpt .= " '$vkpt' " ;
  if ($i < $ptsCount -1 ){
      $q_kpt .= " , ";
  }
}
$q_kpt .= "";
$filter_kpt = " AND kpt IN ( $q_kpt ) ";
if ($cek_pts == "" AND $cek_pts == "all"){
   $filter_kpt = " ";
}

//echo $filter_kpt ; return;

/////////////////////////////////////////////////////
$kptArr = array();
$ptsArr = array();

//$pts_tampil = $pts->pts_tampil();
$pts_tampil = $pts->pts_tampil_unit($filter_kpt);
while($pts_data = mysql_fetch_assoc($pts_tampil)){
    $kptArr[]=array('kpt' => $pts_data['kpt'],'reguler' => $pts_data['reguler']);

}


//////////////////////////////////////
$kptCount = count($kptArr);
$z=0;
for($i=0; $i<$kptCount; $i++){

 
    $kpt = $kptArr[$i]['kpt'];

    $tb_bio_baru = $kpt."_bio_baru";

    $tb_xbio_baru = $kpt."_xbio_baru";

    

    $z = $z + 1;

    $ptsArr[$z] = $tb_bio_baru;

    $regArr[$z] = $tb_xbio_baru;

    $regCek[$z] = $kptArr[$i]['reguler'];

    

}



$ptsCount = count($ptsArr);


$syntac_union = "";

$field = "biobid,kodept,angkatan,status,nosel,no_pokok,nama,kodefak,kodejrs,kelompok,virtu_acc,no_hp,email,tgl_daftar,potong_spb,potong_spp,smb_informasi,hp_rekomendasi,nama_rekomendasi,kode_agent,kode_gsf,kpi";

for($i=1; $i<=$ptsCount; $i++){

    if($i !== $ptsCount){ $union = " UNION ALL "; }else{ $union = ""; }
/*	
    $syntac_union .= "(SELECT $field FROM `gg_sipema`.$ptsArr[$i] WHERE kpi='$username' AND tgl_daftar BETWEEN '$r_awal_ori' AND '$r_sekarang_ori')".$union;
*/
    $syntac_union .= "(SELECT $field FROM `gg_sipema`.$ptsArr[$i] WHERE  tgl_daftar BETWEEN '$r_awal_ori' AND '$r_sekarang_ori')".$union;    

    if($regCek[$i]==1){

    	$kptreg = explode('_', $regArr[$i]);
		$ptsx_tampil = $pts->ptsx_tampil($kptreg[0]);
		$ptsx_cek = mysql_num_rows($ptsx_tampil);

		if ($ptsx_cek > 0 && $i == $ptsCount) {

			$xunion = " UNION ALL ";

			$syntac_union .=  $xunion . "(SELECT $field FROM `gg_reguler`.$regArr[$i] WHERE kpi='$username' AND tgl_daftar BETWEEN '$r_awal_ori' AND '$r_sekarang_ori')".$union;
		} elseif ($ptsx_cek > 0) {

			$xunion = "";
/*
			$syntac_union .= "(SELECT $field FROM `gg_reguler`.$regArr[$i] WHERE kpi='$username' AND tgl_daftar BETWEEN '$r_awal_ori' AND '$r_sekarang_ori')".$union;
*/
			$syntac_union .= "(SELECT $field FROM `gg_reguler`.$regArr[$i] WHERE  tgl_daftar BETWEEN '$r_awal_ori' AND '$r_sekarang_ori')".$union;
			
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

$jumlah1 = 0;

$jumlah2 = 0;

$hasComma = false;

$hasComma1 = false;

$hasComma2 = false;

$kpi_grab_bio=$kpi->kpi_grab_bio($syntac_union);

$jumlah = mysql_num_rows($kpi_grab_bio);

//echo 'Jumlah Maba :'.$jumlah; return;

$dataArr = array($jumlah);


/*
echo"<pre>";
print_r($dataArr);
echo"</pre>";
*/



echo json_encode($dataArr);

?>