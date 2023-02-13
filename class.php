<?php
class Database
{
/*
	private $db_host = "localhost";
	private $db_user = "root";
	private $db_pass = "mysql";
	private $db_name = "absen";
*/	
		
	private $db_host = "localhost";
	private $db_user = "root";
	private $db_pass = "";
	private $db_name = "absen";


	function koneksi()
	{
		$conn = @mysql_connect($this->db_host, $this->db_user, $this->db_pass) or die(mysql_error());
		if (mysql_error) {
			mysql_select_db($this->db_name) or die(mysql_error());
		} else {
			echo "Database Not Connection";
		}
	}
}

class Encode
{
	function ecrypt($sData, $sKey = 'Kebangkitan Pendidikan Nasional')
	{
		$eco = new Encode();
		$sResult = '';
		for ($i = 0; $i < strlen($sData); $i++) {
			$sChar    = substr($sData, $i, 1);
			$sKeyChar = substr($sKey, ($i % strlen($sKey)) - 1, 1);
			$sChar    = chr(ord($sChar) + ord($sKeyChar));
			$sResult .= $sChar;
		}
		return $eco->encode_base64($sResult);
	}

	function dcrypt($sData, $sKey = 'Kebangkitan Pendidikan Nasional')
	{
		$eco = new Encode();
		$sResult = '';
		$sData   = $eco->decode_base64($sData);
		for ($i = 0; $i < strlen($sData); $i++) {
			$sChar    = substr($sData, $i, 1);
			$sKeyChar = substr($sKey, ($i % strlen($sKey)) - 1, 1);
			$sChar    = chr(ord($sChar) - ord($sKeyChar));
			$sResult .= $sChar;
		}
		return $sResult;
	}

	function encode_base64($sData)
	{
		$sBase64 = base64_encode($sData);
		return strtr($sBase64, '+/', '-_');
	}

	function decode_base64($sData)
	{
		$sBase64 = strtr($sData, '-_', '+/');
		return base64_decode($sBase64);
	}
}

class Karyawan
{
	function kar_nik($kdawal)
	{
		$sql = "SELECT MAX(kar_nik) AS max_nik FROM kar_master WHERE kar_nik LIKE '$kdawal%'";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	function kar_nik_auto()
	{
		$sql = "SELECT MAX(kar_id) AS max_nik_auto FROM kar_master";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	function kar_tampil()
	{
		$sql = "SELECT * FROM 
			  kar_master,
			  jbt_master,
			  lvl_master,
			  div_master,
			  unt_master,
			  ktr_master,
			  pt_master
		 	  WHERE 
			  kar_master.jbt_id=jbt_master.jbt_id AND 
			  kar_master.lvl_id=lvl_master.lvl_id AND
			  kar_master.div_id=div_master.div_id AND
			  kar_master.unt_id=unt_master.unt_id AND
			  kar_master.ktr_id=ktr_master.ktr_id AND
			  kar_master.pt_id=pt_master.pt_id
			  ORDER BY kar_id
			  ";
		//echo $sql;
		$query = mysql_query($sql) or die(mysql_error());
		while ($row = mysql_fetch_array($query))
			$data[] = $row;
		return $data;
	}
	function kar_tampil_aktif()
	{
		$sql = "SELECT * FROM 
			  kar_master,
			  jbt_master,
			  lvl_master,
			  div_master,
			  unt_master,
			  ktr_master,
			  kar_detail
		 	  WHERE 
			  kar_master.jbt_id=jbt_master.jbt_id AND 
			  kar_master.lvl_id=lvl_master.lvl_id AND
			  kar_master.div_id=div_master.div_id AND
			  kar_master.unt_id=unt_master.unt_id AND
			  kar_master.ktr_id=ktr_master.ktr_id AND
			  kar_master.kar_id=kar_detail.kar_id AND
			  kar_detail.kar_dtl_typ_krj <> 'Resign'
			  ORDER BY kar_master.kar_id
			  ";
		$query = mysql_query($sql) or die(mysql_error());
		while ($row = mysql_fetch_array($query))
			$data[] = $row;
		return $data;
	}


	function kar_tampil_aktif_by_atasan_manager()
	{
		$sql = "SELECT * FROM 
		kar_master,
		jbt_master,
		lvl_master,
		div_master,
		unt_master,
		ktr_master,
		kar_detail
		 WHERE 
		kar_master.jbt_id=jbt_master.jbt_id AND 
		kar_master.lvl_id=lvl_master.lvl_id AND
		kar_master.div_id=div_master.div_id AND
		kar_master.unt_id=unt_master.unt_id AND
		kar_master.ktr_id=ktr_master.ktr_id AND
		kar_master.kar_id=kar_detail.kar_id AND
		kar_detail.kar_dtl_typ_krj <> 'Resign' and 
		lvl_master.lvl_id <= 4
		ORDER BY kar_master.kar_id
			  ";
		$query = mysql_query($sql) or die(mysql_error());
		while ($row = mysql_fetch_array($query))
			$data[] = $row;
		return $data;
	}


	function kar_tampil_resign()
	{
		$sql = "SELECT * FROM 
			  kar_master,
			  jbt_master,
			  lvl_master,
			  div_master,
			  unt_master,
			  ktr_master,
			  kar_detail
		 	  WHERE 
			  kar_master.jbt_id=jbt_master.jbt_id AND 
			  kar_master.lvl_id=lvl_master.lvl_id AND
			  kar_master.div_id=div_master.div_id AND
			  kar_master.unt_id=unt_master.unt_id AND
			  kar_master.ktr_id=ktr_master.ktr_id AND
			  kar_master.kar_id=kar_detail.kar_id AND
			  kar_detail.kar_dtl_typ_krj = 'Resign'
			  ORDER BY kar_master.kar_id
			  ";
		$query = mysql_query($sql) or die(mysql_error());
		while ($row = mysql_fetch_array($query))
			$data[] = $row;
		return $data;
	}


	function kar_tampil_status($filter_status)
	{
		$sql = "SELECT * FROM 
			  kar_master,
			  jbt_master,
			  lvl_master,
			  div_master,
			  unt_master,
			  ktr_master,
			  kot_master,
			  pt_master,
			  kar_detail
		 	  WHERE 
			  kar_master.jbt_id=jbt_master.jbt_id AND 
			  kar_master.lvl_id=lvl_master.lvl_id AND
			  kar_master.div_id=div_master.div_id AND
			  kar_master.unt_id=unt_master.unt_id AND
			  kar_master.ktr_id=ktr_master.ktr_id AND
			  kar_master.kot_id=kot_master.kot_id AND
			  kar_master.pt_id=pt_master.pt_id AND
			  kar_master.kar_id=kar_detail.kar_id 
			  $filter_status 
			  ORDER BY kar_master.kar_id
			  ";
		$query = mysql_query($sql) or die(mysql_error());
		while ($row = mysql_fetch_array($query))
			$data[] = $row;
		return $data;
	}


	function kar_tampil_2()
	{
		$sql = "SELECT * FROM 
			  kar_master,
			  jbt_master,
			  lvl_master,
			  div_master,
			  unt_master,
			  ktr_master
		 	  WHERE 
			  kar_master.jbt_id=jbt_master.jbt_id AND 
			  kar_master.lvl_id=lvl_master.lvl_id AND
			  kar_master.div_id=div_master.div_id AND
			  kar_master.unt_id=unt_master.unt_id AND
			  kar_master.ktr_id=ktr_master.ktr_id 
			  ORDER BY kar_id
			  ";
		$query = mysql_query($sql) or die(mysql_error());
		while ($row = mysql_fetch_array($query))
			$data[] = $row;
		return $data;
	}
	function kar_tampil_3()
	{
		$sql = "SELECT * FROM 
			  kar_master,
			  jbt_master,
			  lvl_master,
			  div_master,
			  unt_master,
			  ktr_master
		 	  WHERE 
			  kar_master.jbt_id=jbt_master.jbt_id AND 
			  kar_master.lvl_id=lvl_master.lvl_id AND
			  kar_master.div_id=div_master.div_id AND
			  kar_master.unt_id=unt_master.unt_id AND
			  kar_master.ktr_id=ktr_master.ktr_id 
			  ORDER BY kar_id
			  ";
		$query = mysql_query($sql) or die(mysql_error());
		while ($row = mysql_fetch_array($query))
			$data[] = $row;
		return $data;
	}
	function kar_tampil_filter()
	{
		$sql = "SELECT * FROM 
			  kar_master,
			  jbt_master,
			  lvl_master,
			  div_master,
			  unt_master,
			  ktr_master
		 	  WHERE 
			  kar_master.jbt_id=jbt_master.jbt_id AND 
			  kar_master.lvl_id=lvl_master.lvl_id AND
			  kar_master.div_id=div_master.div_id AND
			  kar_master.unt_id=unt_master.unt_id AND
			  kar_master.ktr_id=ktr_master.ktr_id AND
			  div_master.div_nm <> 'Komisaris' AND
			  div_master.div_nm <> 'Komite' AND
			  div_master.div_nm <> 'Direksi' AND
			  lvl_master.lvl_nm <> 'Komisaris' AND
			  lvl_master.lvl_nm <> 'Komite' AND
			  lvl_master.lvl_nm <> 'Direksi'
			  ORDER BY kar_id
			  ";
		$query = mysql_query($sql) or die(mysql_error());
		while ($row = mysql_fetch_array($query))
			$data[] = $row;
		return $data;
	}

	function kar_tampil_filter_2()
	{
		/*		
		$sql = "SELECT * FROM 
			  kar_master,
			  jbt_master,
			  lvl_master,
			  div_master,
			  unt_master,
			  ktr_master
		 	  WHERE 
			  kar_master.jbt_id=jbt_master.jbt_id AND 
			  kar_master.lvl_id=lvl_master.lvl_id AND
			  kar_master.div_id=div_master.div_id AND
			  kar_master.unt_id=unt_master.unt_id AND
			  kar_master.ktr_id=ktr_master.ktr_id AND
			  div_master.div_nm <> 'Komisaris' AND
			  lvl_master.lvl_nm <> 'Komisaris'
			  ORDER BY kar_id
			  ";
*/

		$sql = "SELECT * FROM 
			  kar_master,
			  jbt_master,
			  lvl_master,
			  div_master,
			  unt_master,
			  ktr_master
		 	  WHERE 
			  kar_master.jbt_id=jbt_master.jbt_id AND 
			  kar_master.lvl_id=lvl_master.lvl_id AND
			  kar_master.div_id=div_master.div_id AND
			  kar_master.unt_id=unt_master.unt_id AND
			  kar_master.ktr_id=ktr_master.ktr_id 
			  ORDER BY kar_id
			  ";

		$query = mysql_query($sql) or die(mysql_error());
		while ($row = mysql_fetch_array($query))
			$data[] = $row;
		return $data;
	}
	
		function kar_tampil_drt()
	{

		$sql = "SELECT * FROM kar_master WHERE kar_id IN('38','30','63')";

		$query = mysql_query($sql) or die(mysql_error());
		while ($row = mysql_fetch_array($query))
			$data[] = $row;
		return $data;
	}

	function kar_tampil_id($kar_id)
	{
		$sql = "SELECT * FROM 
			  kar_master,
			  jbt_master,
			  lvl_master,
			  div_master,
			  unt_master,
			  ktr_master
		 	  WHERE 
			  kar_master.jbt_id=jbt_master.jbt_id AND 
			  kar_master.lvl_id=lvl_master.lvl_id AND
			  kar_master.div_id=div_master.div_id AND
			  kar_master.unt_id=unt_master.unt_id AND
			  kar_master.ktr_id=ktr_master.ktr_id AND
			  kar_master.kar_id='$kar_id'
			  ORDER BY kar_id
			  ";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}



	function kar_tampil_username($username)
	{
		$sql = "SELECT * FROM 
			  kar_master,
			  jbt_master,
			  lvl_master,
			  div_master,
			  unt_master,
			  ktr_master
		 	  WHERE 
			  kar_master.jbt_id=jbt_master.jbt_id AND 
			  kar_master.lvl_id=lvl_master.lvl_id AND
			  kar_master.div_id=div_master.div_id AND
			  kar_master.unt_id=unt_master.unt_id AND
			  kar_master.ktr_id=ktr_master.ktr_id AND
			  kar_master.kar_nik='$username'
			  ORDER BY kar_id
			  ";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	function kar_insert($kar_nik, $kar_nm, $kar_tgl_lahir, $div_id, $jbt_id, $lvl_id, $unt_id, $ktr_id, $kot_id, $pt_id, $kar_nik_new,$kar_nm_panggilan)
	{
		$sql = "INSERT INTO kar_master VALUES(NULL,'$kar_nik','$kar_nm','$kar_tgl_lahir','U','$div_id','$jbt_id','$lvl_id','$unt_id','$ktr_id','$kot_id','$pt_id',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'0',NULL,'N','0','','','','$kar_nik_new','$kar_nm_panggilan')";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	function kar_insert_detail($kar_dtl_tgl_lahir,$ntf_id)
	{
		$sql = "INSERT INTO kar_detail VALUES(NULL,'A','Kontrak','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','$kar_dtl_tgl_lahir','','','','','$ntf_id')";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	function kar_delete($kar_id)
	{
		$sql = "DELETE FROM kar_master WHERE kar_id='$kar_id'";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	function kar_update($kar_id, $kar_nm, $kar_tgl_lahir, $div_id, $jbt_id, $lvl_id, $unt_id, $ktr_id, $kot_id, $pt_id, $kar_nm_panggilan)
	{
		$sql = "UPDATE kar_master SET kar_nm='$kar_nm',kar_tgl_lahir='$kar_tgl_lahir',jbt_id='$jbt_id',lvl_id='$lvl_id',div_id='$div_id',unt_id='$unt_id',ktr_id='$ktr_id',kot_id='$kot_id',pt_id='$pt_id',kar_nm_panggilan='$kar_nm_panggilan' WHERE kar_id='$kar_id'";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	function kar_update_shift($kar_id, $shiftextra)
	{
		if ($shiftextra == 'true') {
			$kar_default_shift2_in = '12:00:00';
			$kar_default_shift2_out = '20:00:00';
			$sql = "UPDATE kar_master SET kar_default_shift2_in='$kar_default_shift2_in',kar_default_shift2_out='$kar_default_shift2_out' WHERE kar_id='$kar_id'";
		} else {
			$sql = "UPDATE kar_master SET kar_default_shift2_in=NULL,kar_default_shift2_out=NULL WHERE kar_id='$kar_id'";
		}
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	function kar_update_disable_pulang($kar_id, $disablecheck)
	{
		if ($disablecheck == 'true') {
			$sql = "UPDATE kar_master SET kar_disable_pulang='Y' WHERE kar_id='$kar_id'";
		} else {
			$sql = "UPDATE kar_master SET kar_disable_pulang='N' WHERE kar_id='$kar_id'";
		}
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	function kar_tampil_pvl_user()
	{
		$sql = "SELECT * FROM 
			  kar_master,
			  jbt_master,
			  lvl_master,
			  div_master,
			  unt_master,
			  ktr_master,
			  kar_detail
		 	  WHERE 
			  kar_master.jbt_id=jbt_master.jbt_id AND 
			  kar_master.lvl_id=lvl_master.lvl_id AND
			  kar_master.div_id=div_master.div_id AND
			  kar_master.unt_id=unt_master.unt_id AND
			  kar_master.ktr_id=ktr_master.ktr_id AND
			  kar_master.kar_id=kar_detail.kar_id AND
			  kar_detail.kar_dtl_typ_krj <> 'Resign' AND
			  kar_master.kar_pvl='U'
			  ORDER BY kar_master.kar_id
			  ";
		$query = mysql_query($sql) or die(mysql_error());
		while ($row = mysql_fetch_array($query))
			$data[] = $row;
		return $data;
	}
	function kar_tampil_pvl_admin()
	{
		$sql = "SELECT * FROM 
			  kar_master,
			  jbt_master,
			  lvl_master,
			  div_master,
			  unt_master,
			  ktr_master,
			  kar_detail
		 	  WHERE 
			  kar_master.jbt_id=jbt_master.jbt_id AND 
			  kar_master.lvl_id=lvl_master.lvl_id AND
			  kar_master.div_id=div_master.div_id AND
			  kar_master.unt_id=unt_master.unt_id AND
			  kar_master.ktr_id=ktr_master.ktr_id AND
			  kar_master.kar_id=kar_detail.kar_id AND
			  kar_detail.kar_dtl_typ_krj <> 'Resign' AND
			  kar_master.kar_pvl='A'
			  ORDER BY kar_master.kar_id
			  ";
		$query = mysql_query($sql) or die(mysql_error());
		while ($row = mysql_fetch_array($query))
			$data[] = $row;
		return $data;
	}
	function kar_tampil_pvl_super_admin()
	{
		$sql = "SELECT * FROM 
			  kar_master,
			  jbt_master,
			  lvl_master,
			  div_master,
			  unt_master,
			  ktr_master,
			  kar_detail
		 	  WHERE 
			  kar_master.jbt_id=jbt_master.jbt_id AND 
			  kar_master.lvl_id=lvl_master.lvl_id AND
			  kar_master.div_id=div_master.div_id AND
			  kar_master.unt_id=unt_master.unt_id AND
			  kar_master.ktr_id=ktr_master.ktr_id AND
			  kar_master.kar_id=kar_detail.kar_id AND
			  kar_detail.kar_dtl_typ_krj <> 'Resign' AND
			  kar_master.kar_pvl='S'
			  ORDER BY kar_master.kar_id
			  ";
		$query = mysql_query($sql) or die(mysql_error());
		while ($row = mysql_fetch_array($query))
			$data[] = $row;
		return $data;
	}
	function kar_update_pvl($kar_id, $kar_pvl)
	{
		$sql = "UPDATE kar_master SET kar_pvl='$kar_pvl' WHERE kar_id='$kar_id'";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	function kar_tampil_div($div_id)
	{
		$sql = "SELECT * FROM 
			  kar_master,
			  div_master
		 	  WHERE 
			  kar_master.div_id=div_master.div_id AND
			  kar_master.div_id='$div_id'
			  ORDER BY kar_id
			  ";
		$query = mysql_query($sql) or die(mysql_error());
		while ($row = mysql_fetch_array($query))
			$data[] = $row;
		return $data;
	}
	function kar_update_location($kar_id, $ktr_id_, $unt_id_)
	{
		$sql = "UPDATE kar_master SET ktr_id='$ktr_id_',unt_id='$unt_id_' WHERE kar_id='$kar_id'";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	function kar_tampil_location($ktr_id_, $unt_id_)
	{
		$sql = "SELECT * FROM kar_master WHERE ktr_id='$ktr_id_' AND unt_id='$unt_id_' ORDER BY kar_id";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	function kar_tampil_detail($kar_id)
	{
		$sql = "SELECT * FROM kar_detail WHERE kar_id='$kar_id' ORDER BY kar_id";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	function kar_update_employee($kar_dtl_sts_krj, $kar_dtl_typ_krj, $kar_dtl_tgl_joi, $kar_dtl_msa_krj, $kar_dtl_tgl_ttp, $kar_dtl_tgl_sk, $kar_dtl_tgl_res, $kar_dtl_als_res, $kar_dtl_tgl_joi2,$kar_dtl_als_res_md, $kar_id)
	{
		$sql = "UPDATE kar_detail SET kar_dtl_sts_krj='$kar_dtl_sts_krj',kar_dtl_typ_krj='$kar_dtl_typ_krj',kar_dtl_tgl_joi='$kar_dtl_tgl_joi',kar_dtl_msa_krj='$kar_dtl_msa_krj',kar_dtl_tgl_ttp='$kar_dtl_tgl_ttp',kar_dtl_tgl_sk='$kar_dtl_tgl_sk',kar_dtl_tgl_res='$kar_dtl_tgl_res',kar_dtl_als_res='$kar_dtl_als_res',kar_dtl_tgl_joi2='$kar_dtl_tgl_joi2',kar_dtl_als_res_md='$kar_dtl_als_res_md' WHERE kar_id='$kar_id'";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	function kar_insert_employee($kar_dtl_sts_krj, $kar_dtl_typ_krj, $kar_dtl_tgl_joi, $kar_dtl_msa_krj,$kar_dtl_tgl_ttp, $kar_dtl_tgl_sk ,$kar_dtl_tgl_res, $kar_dtl_als_res,$kar_dtl_tgl_joi2,$kar_dtl_als_res_md, $kar_id)
	{
		$sql = "INSERT INTO kar_detail VALUES(NULL,'$kar_dtl_sts_krj','$kar_dtl_typ_krj','$kar_dtl_tgl_joi','$kar_dtl_msa_krj','$kar_dtl_tgl_ttp','$kar_dtl_tgl_sk','$kar_dtl_tgl_res','$kar_dtl_als_res','','','','','','','','','','','','','','','','','','','','','$kar_dtl_tgl_joi2','','','$kar_dtl_als_res_md','$kar_id')";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	function kar_update_bio($kar_dtl_usa, $kar_dtl_gen, $kar_dtl_tmp_lhr, $kar_dtl_sts_nkh, $kar_dtl_jml_ank, $kar_dtl_tgn, $kar_dtl_agama, $kar_dtl_tgl_lahir, $kar_dtl_ibu_kandung, $kar_id)
	{
		$sql = "UPDATE kar_detail SET kar_dtl_usa='$kar_dtl_usa',kar_dtl_gen='$kar_dtl_gen',kar_dtl_tmp_lhr='$kar_dtl_tmp_lhr',kar_dtl_sts_nkh='$kar_dtl_sts_nkh',kar_dtl_jml_ank='$kar_dtl_jml_ank',kar_dtl_tgn='$kar_dtl_tgn',kar_dtl_agama='$kar_dtl_agama',kar_dtl_tgl_lahir='$kar_dtl_tgl_lahir',kar_dtl_ibu_kandung='$kar_dtl_ibu_kandung' WHERE kar_id='$kar_id'";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	function kar_insert_bio($kar_dtl_usa, $kar_dtl_gen, $kar_dtl_tmp_lhr, $kar_dtl_sts_nkh, $kar_dtl_jml_ank, $kar_dtl_tgn, $kar_dtl_agama, $kar_dtl_tgl_lahir, $kar_dtl_ibu_kandung, $kar_id)
	{
		$sql = "INSERT INTO kar_detail VALUES(NULL,'','','','','','','$kar_dtl_usa','$kar_dtl_gen','$kar_dtl_tmp_lhr','$kar_dtl_sts_nkh','$kar_dtl_jml_ank','$kar_dtl_tgn','','','','','','','','','','','','','','','','','','$kar_dtl_agama','$kar_dtl_tgl_lahir','','$kar_dtl_ibu_kandung','$kar_id')";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	function kar_update_education($kar_dtl_pnd, $kar_dtl_jrs, $kar_dtl_unv_sch, $kar_dtl_sts_pnd, $kar_dtl_thn_lls, $kar_id)
	{
		$sql = "UPDATE kar_detail SET kar_dtl_pnd='$kar_dtl_pnd',kar_dtl_jrs='$kar_dtl_jrs',kar_dtl_unv_sch='$kar_dtl_unv_sch',kar_dtl_sts_pnd='$kar_dtl_sts_pnd',kar_dtl_thn_lls='$kar_dtl_thn_lls' WHERE kar_id='$kar_id'";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	function kar_insert_education($kar_dtl_pnd, $kar_dtl_jrs, $kar_dtl_unv_sch, $kar_dtl_sts_pnd, $kar_dtl_thn_lls, $kar_id)
	{
		$sql = "INSERT INTO kar_detail VALUES(NULL,'','','','','','','','','','','','','$kar_dtl_pnd','$kar_dtl_jrs','$kar_dtl_unv_sch','$kar_dtl_sts_pnd','$kar_dtl_thn_lls','','','','','','','','','','','','$kar_id')";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	function kar_update_card($kar_dtl_no_ktp, $kar_dtl_exp_ktp, $kar_dtl_no_kk, $kar_dtl_no_npw, $kar_dtl_no_kpj, $kar_dtl_no_rek, $kar_dtl_no_bpj, $kar_dtl_no_jms, $kar_id)
	{
		$sql = "UPDATE kar_detail SET kar_dtl_no_ktp='$kar_dtl_no_ktp',kar_dtl_exp_ktp='$kar_dtl_exp_ktp',kar_dtl_no_kk='$kar_dtl_no_kk',kar_dtl_no_npw='$kar_dtl_no_npw',kar_dtl_no_kpj='$kar_dtl_no_kpj',kar_dtl_no_rek='$kar_dtl_no_rek',kar_dtl_no_bpj='$kar_dtl_no_bpj',kar_dtl_no_jms='$kar_dtl_no_jms' WHERE kar_id='$kar_id'";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	function kar_insert_card($kar_dtl_no_ktp, $kar_dtl_exp_ktp, $kar_dtl_no_kk, $kar_dtl_no_npw, $kar_dtl_no_kpj, $kar_dtl_no_rek, $kar_dtl_no_bpj, $kar_dtl_no_jms, $kar_id)
	{
		$sql = "INSERT INTO kar_detail VALUES(NULL,'','','','','','','','','','','','','','','','','','$kar_dtl_no_ktp','$kar_dtl_exp_ktp','$kar_dtl_no_kk','$kar_dtl_no_npw','$kar_dtl_no_kpj','$kar_dtl_no_rek','$kar_dtl_no_bpj','$kar_dtl_no_jms','','','','$kar_id')";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	function kar_update_contact($kar_dtl_eml, $kar_dtl_tlp,$kar_dtl_tlp_marketing, $kar_dtl_alt, $kar_dtl_alt_dms, $kar_id)
	{
		$sql = "UPDATE kar_detail SET kar_dtl_eml='$kar_dtl_eml',kar_dtl_tlp='$kar_dtl_tlp',kar_dtl_tlp_marketing='$kar_dtl_tlp_marketing',kar_dtl_alt='$kar_dtl_alt',kar_dtl_alt_dms='$kar_dtl_alt_dms' WHERE kar_id='$kar_id'";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	function kar_insert_contact($kar_dtl_eml, $kar_dtl_tlp, $kar_dtl_alt, $kar_id)
	{
		$sql = "INSERT INTO kar_detail VALUES(NULL,'','','','','','','','','','','','','','','','','','','','','','','','','','$kar_dtl_eml','$kar_dtl_tlp','$kar_dtl_alt','$kar_id')";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	function kar_tampil_typ($kar_dtl_typ_krj)
	{
		$sql = "SELECT * FROM kar_master,kar_detail WHERE kar_master.kar_id=kar_detail.kar_id AND kar_detail.kar_dtl_typ_krj='$kar_dtl_typ_krj' AND kar_detail.kar_dtl_typ_krj!='' ORDER BY kar_master.kar_id";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	function kar_tampil_sts($kar_dtl_sts_krj)
	{
		$sql = "SELECT * FROM kar_master,kar_detail WHERE kar_master.kar_id=kar_detail.kar_id AND kar_detail.kar_dtl_sts_krj='$kar_dtl_sts_krj' AND kar_detail.kar_dtl_sts_krj!='' ORDER BY kar_master.kar_id";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	function kar_tampil_libur($id_karyawan)
	{
		$sql = "SELECT * FROM kar_master WHERE kar_id NOT REGEXP '$id_karyawan' ORDER BY kar_id";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	function kar_tampil_kontrak()
	{
		$sql = "SELECT * FROM 
			  kar_master,
			  jbt_master,
			  lvl_master,
			  div_master,
			  unt_master,
			  ktr_master,
			  kar_detail
		 	  WHERE 
			  kar_master.jbt_id=jbt_master.jbt_id AND 
			  kar_master.lvl_id=lvl_master.lvl_id AND
			  kar_master.div_id=div_master.div_id AND
			  kar_master.unt_id=unt_master.unt_id AND
			  kar_master.ktr_id=ktr_master.ktr_id AND
			  kar_master.kar_id=kar_detail.kar_id AND
			  kar_detail.kar_dtl_typ_krj = 'Kontrak'
			  ORDER BY kar_master.kar_id
			  ";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	function kar_tampil_uptodate()
	{
		$sql = "SELECT * FROM 
			  kar_master,
			  jbt_master,
			  lvl_master,
			  div_master,
			  unt_master,
			  ktr_master,
			  kar_detail
		 	  WHERE 
			  kar_master.jbt_id=jbt_master.jbt_id AND 
			  kar_master.lvl_id=lvl_master.lvl_id AND
			  kar_master.div_id=div_master.div_id AND
			  kar_master.unt_id=unt_master.unt_id AND
			  kar_master.ktr_id=ktr_master.ktr_id AND
			  kar_master.kar_id=kar_detail.kar_id AND
			  div_master.div_nm <> 'Komisaris' AND
			  div_master.div_nm <> 'Komite' AND
			  div_master.div_nm <> 'Direksi' AND
			  lvl_master.lvl_nm <> 'Komisaris' AND
			  lvl_master.lvl_nm <> 'Komite' AND
			  lvl_master.lvl_nm <> 'Direksi' AND
			  kar_detail.kar_dtl_typ_krj <> 'Resign'
			  ORDER BY kar_master.kar_id
			  ";
		$query = mysql_query($sql) or die(mysql_error());
		while ($row = mysql_fetch_array($query))
			$data[] = $row;
		return $data;
	}
	function kar_tampil_uptodate_unit()
	{
		$sql = "SELECT * FROM 
			  kar_master,
			  lvl_master,
			  div_master,
			  unt_master,
			  ktr_master,
			  kar_detail
		 	  WHERE 
			  kar_master.lvl_id=lvl_master.lvl_id AND
			  kar_master.div_id=div_master.div_id AND
			  kar_master.unt_id=unt_master.unt_id AND
			  kar_master.unt_id='2' AND
			  kar_master.ktr_id=ktr_master.ktr_id AND
			  kar_master.kar_id=kar_detail.kar_id AND
			  div_master.div_nm <> 'Komisaris' AND
			  div_master.div_nm <> 'Komite' AND
			  div_master.div_nm <> 'Direksi' AND
			  div_master.div_nm <> 'Marketing' AND
			  div_master.div_nm <> 'Umum' AND
			  lvl_master.lvl_nm <> 'Komisaris' AND
			  lvl_master.lvl_nm <> 'Komite' AND
			  lvl_master.lvl_nm <> 'Direksi' AND
			  kar_detail.kar_dtl_typ_krj <> 'Resign'
			  ORDER BY kar_master.kar_id
			  ";
		$query = mysql_query($sql) or die(mysql_error());
		while ($row = mysql_fetch_array($query))
			$data[] = $row;
		return $data;
	}
	function kar_tampil_uptodate_unit2()
	{
		$sql = "SELECT * FROM 
			  kar_master,
			  jbt_master,
			  lvl_master,
			  div_master,
			  unt_master,
			  ktr_master,
			  kar_detail
		 	  WHERE 
			  kar_master.jbt_id=jbt_master.jbt_id AND 
			  kar_master.lvl_id=lvl_master.lvl_id AND
			  kar_master.div_id=div_master.div_id AND
			  kar_master.unt_id=unt_master.unt_id AND
			  kar_master.unt_id='2' AND
			  kar_master.ktr_id=ktr_master.ktr_id AND
			  kar_master.kar_id=kar_detail.kar_id AND
			  div_master.div_nm <> 'Komisaris' AND
			  div_master.div_nm <> 'Komite' AND
			  div_master.div_nm <> 'Direksi' AND
			  div_master.div_nm <> 'Marketing' AND
			  div_master.div_nm <> 'Umum' AND
			  lvl_master.lvl_nm <> 'Komisaris' AND
			  lvl_master.lvl_nm <> 'Komite' AND
			  lvl_master.lvl_nm <> 'Direksi' AND
			  kar_detail.kar_dtl_typ_krj <> 'Resign'
			  ORDER BY kar_master.kar_id
			  ";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	function kar_update_jdwakses($kar_id, $kar_jdw_akses)
	{
		$sql = "UPDATE kar_master SET kar_jdw_akses='$kar_jdw_akses' WHERE kar_id='$kar_id'";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	function kar_tampil_div_in($div_value)
	{
		$sql = "SELECT * FROM 
			  kar_master,
			  div_master
		 	  WHERE 
			  kar_master.div_id=div_master.div_id AND
			  kar_master.div_id IN ($div_value)
			  ORDER BY kar_master.kar_id
			  ";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	function kar_tampil_div_in_new($div_value)
	{
		$sql = "SELECT * FROM 
			  kar_master,
			  kar_detail,
			  div_master
		 	  WHERE
			  kar_master.kar_id=kar_detail.kar_id AND
			  kar_master.div_id=div_master.div_id AND
			  kar_master.div_id IN ($div_value) AND
			  kar_master.kar_logika <> 1  AND
			  kar_detail.kar_dtl_typ_krj <>'Resign'
			  ORDER BY kar_master.kar_id
			  ";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	function kar_tampil_div_in_cs($div_value)
	{
		$sql = "SELECT * FROM 
			  kar_master,
			  kar_detail,
			  div_master
		 	  WHERE
			  kar_master.kar_id=kar_detail.kar_id AND
			  kar_master.div_id=div_master.div_id AND
			  kar_master.div_id IN ($div_value) AND
			  kar_master.kar_logika <> 1  AND
			  kar_detail.kar_dtl_typ_krj <>'Resign'
			  ORDER BY kar_master.kar_id
			  ";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	function kar_tampil_div_in_cs_staff($div_value)
	{
		$sql = "SELECT * FROM 
			  kar_master,
			  kar_detail,
			  div_master
		 	  WHERE
			  kar_master.kar_id=kar_detail.kar_id AND
			  kar_master.div_id=div_master.div_id AND
			  kar_master.div_id IN ($div_value) AND
			  kar_master.lvl_id='7' AND
			  kar_master.kar_logika <> 1  AND
			  kar_detail.kar_dtl_typ_krj <>'Resign'
			  ORDER BY kar_master.kar_id
			  ";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	function kar_tampil_div_in_logika($logika_value)
	{
		$sql = "SELECT * FROM 
			  kar_master,
			  kar_detail,
			  div_master
		 	  WHERE
			  kar_master.kar_id=kar_detail.kar_id AND
			  kar_master.div_id=div_master.div_id AND
			  kar_master.kar_logika='$logika_value' AND
			  kar_detail.kar_dtl_typ_krj <>'Resign'
			  ORDER BY kar_master.kar_id
			  ";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	function kar_tampil_cs_staff()
	{
		$sql = "SELECT kar_master.kar_nik,kar_master.kar_nm FROM 
			  kar_master,
			  kar_detail
		 	  WHERE
			  kar_master.kar_id=kar_detail.kar_id AND
			  kar_master.div_id='13' AND
			  kar_master.lvl_id='7' AND
			  kar_master.kar_logika <> 1  AND
			  kar_detail.kar_dtl_typ_krj <>'Resign' AND
			  kar_master.kar_nik <> 'SG.0639.2021'
			  ORDER BY kar_master.kar_id
			  ";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	function kar_tampil_nik($kar_nik)
	{
		$sql = "SELECT * FROM kar_master WHERE kar_nik = '$kar_nik' ORDER BY kar_id";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	function kar_tampil_nik_keuangan()
	{
		$sql = "SELECT
					a.kar_id as karyawan,
					a.kar_nik,
					a.kar_nm,
					a.div_id,
					b.kar_id as account,
					b.acc_username
				FROM
					kar_master a
					LEFT JOIN acc_master b ON a.kar_id = b.kar_id	
					LEFT JOIN kar_detail c ON a.kar_id = c.kar_id WHERE  (a.div_id ='6' or a.kar_nik IN('SG.0028.2007','SG.0015.2004','SG.0021.2004','SG.0584.2020')) AND c.kar_dtl_typ_krj <> 'Resign'";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	function kar_sync_update($kar_nik, $datetime)
	{
		$sql = "UPDATE kar_master SET kar_sync_date='$datetime' WHERE kar_nik='$kar_nik'";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	function kar_tampil_akses($kar_nik)
	{
		if ($kar_nik == "all") {
			$sql = "SELECT a.kar_id,a.kar_nik, a.kar_nm, c.div_nm FROM 
				  kar_master a,
				  lvl_master b,
				  div_master c,
				  kar_detail d
				  WHERE 
				  a.lvl_id=b.lvl_id AND
				  a.div_id=c.div_id AND
				  a.kar_id=d.kar_id AND
				  d.kar_dtl_typ_krj <> 'Resign'
				  ORDER BY a.kar_id
				  ";
		} else {
			$sql = "SELECT a.kar_id,a.kar_nik, a.kar_nm, c.div_nm FROM 
				kar_master a,
				lvl_master b,
				div_master c,
				kar_detail d
				WHERE 
				a.lvl_id=b.lvl_id AND
				a.div_id=c.div_id AND
				a.kar_id=d.kar_id AND
				a.kar_nik IN ('$kar_nik') AND 
				d.kar_dtl_typ_krj <> 'Resign'
				ORDER BY a.kar_id
				";
		}
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	function kar_tampil_acc($kar_id){
		$sql = "SELECT
					a.kar_id as karyawan,
					a.kar_nik,
					a.kar_nm,
					b.kar_id as account,
					b.acc_username,
					b.acc_md5
				FROM
					kar_master a
					LEFT JOIN acc_master b ON a.kar_id = b.kar_id	
					LEFT JOIN kar_detail c ON a.kar_id = c.kar_id WHERE a.kar_id = '$kar_id' AND c.kar_dtl_typ_krj <> 'Resign'
						";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	function kar_tampil_kpi($div_id,$kar_dtl_typ_krj)
	{
		$sql = "SELECT
		          kar_master.kar_id,
		          kar_master.kar_nik,
			  kar_master.kar_nm,
			  div_master.div_nm,
			  ktr_master.ktr_kd,
			  ktr_master.ktr_nm
			  FROM 
			  kar_master,
			  div_master,
			  ktr_master,
			  kar_detail
		 	  WHERE 
			  kar_master.div_id=div_master.div_id AND
			  kar_master.ktr_id=ktr_master.ktr_id AND
			  kar_master.kar_id=kar_detail.kar_id AND
			  kar_master.div_id='$div_id' AND
			  kar_detail.kar_dtl_typ_krj = '$kar_dtl_typ_krj'
			  ORDER BY kar_master.kar_id
			  ";
		$query = mysql_query($sql) or die(mysql_error());
		while ($row = mysql_fetch_array($query))
			$data[] = $row;
		return $data;
	}
	function kar_bio_kpi($kar_id){
		$sql = "SELECT
					a.kar_id,
					a.kar_nik,
					a.kar_nm,
					b.div_nm,
					b.div_id,
					c.acc_img,
					d.kar_dtl_typ_krj,
					e.jbt_nm,
					f.lvl_nm,
					g.ktr_nm,
					h.unt_nm
				FROM
					kar_master a
					LEFT JOIN div_master b ON a.div_id = b.div_id
					LEFT JOIN acc_master c ON a.kar_id = c.kar_id
					LEFT JOIN kar_detail d ON a.kar_id = d.kar_id
					LEFT JOIN jbt_master e ON a.jbt_id = e.jbt_id
					LEFT JOIN lvl_master f ON a.lvl_id = f.lvl_id
					LEFT JOIN ktr_master g ON a.ktr_id = g.ktr_id
					LEFT JOIN unt_master h ON a.unt_id = h.unt_id
					WHERE a.kar_id = '$kar_id' AND d.kar_dtl_typ_krj <> 'Resign'
						";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	function kar_penilai_kpi($div_id,$lvl_id)
	{
		if($div_id == "" || $div_id == 0){
			$sql = "SELECT
				  kar_master.kar_id,
				  kar_master.kar_nik,
				  kar_master.kar_nm
				  FROM 
				  kar_master,
				  kar_detail
				  WHERE 
				  kar_master.kar_id=kar_detail.kar_id AND
				  kar_master.lvl_id='$lvl_id' AND
				  kar_detail.kar_dtl_typ_krj <> 'Resign'
				  ORDER BY kar_master.kar_id
				  ";
		}else{
			$sql = "SELECT
				  kar_master.kar_id,
				  kar_master.kar_nik,
				  kar_master.kar_nm
				  FROM 
				  kar_master,
				  kar_detail
				  WHERE 
				  kar_master.kar_id=kar_detail.kar_id AND
				  kar_master.div_id='$div_id' AND
				  kar_master.lvl_id='$lvl_id' AND
				  kar_detail.kar_dtl_typ_krj <> 'Resign'
				  ORDER BY kar_master.kar_id
				  ";
		}
		$query = mysql_query($sql) or die(mysql_error());
		while ($row = mysql_fetch_array($query))
			$data[] = $row;
		return $data;
	}
	
	function kar_penilai_dirut_kpi()
	{
		$sql = "SELECT
				  kar_id,
				  kar_nik,
				  kar_nm
				  FROM 
				  kar_master
				  WHERE 
				  kar_id IN('30','38','63')
				  ORDER BY kar_id
				  ";
		$query = mysql_query($sql) or die(mysql_error());
		while ($row = mysql_fetch_array($query))
			$data[] = $row;
		return $data;
	}
	
	function kar_penilai_in_kpi($div_id,$lvl_id)
	{
		if($div_id == "" || $div_id == 0){
			$sql = "SELECT
				  kar_master.kar_id,
				  kar_master.kar_nik,
				  kar_master.kar_nm
				  FROM 
				  kar_master,
				  kar_detail
				  WHERE 
				  kar_master.kar_id=kar_detail.kar_id AND
				  kar_master.lvl_id IN (" . implode(',', $lvl_id) . ") AND
				  kar_detail.kar_dtl_typ_krj <> 'Resign'
				  ORDER BY kar_master.kar_id
				  ";
		}else{
			$sql = "SELECT
				  kar_master.kar_id,
				  kar_master.kar_nik,
				  kar_master.kar_nm
				  FROM 
				  kar_master,
				  kar_detail
				  WHERE 
				  kar_master.kar_id=kar_detail.kar_id AND
				  kar_master.div_id='$div_id' AND
				  kar_master.lvl_id IN (" . implode(',', $lvl_id) . ") AND
				  kar_detail.kar_dtl_typ_krj <> 'Resign'
				  ORDER BY kar_master.kar_id
				  ";
		}
		$query = mysql_query($sql) or die(mysql_error());
		while ($row = mysql_fetch_array($query))
			$data[] = $row;
		return $data;
	}
}

class Divisi
{
	function div_tampil()
	{
		$sql = "SELECT * FROM div_master ORDER BY div_id";
		$query = mysql_query($sql) or die(mysql_error());
		while ($row = mysql_fetch_array($query))
			$data[] = $row;
		return $data;
	}
	function div_tampil_id_($div_id)
	{
		$sql = "SELECT * FROM div_master WHERE div_id='$div_id' ORDER BY div_id";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	function div_tampil_level2()
	{
		$sql = "SELECT * FROM div_master WHERE div_id > 2 ORDER BY div_nm";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
}

class Jabatan
{
	function jbt_tampil()
	{
		$sql = "SELECT * FROM jbt_master ORDER BY jbt_id";
		$query = mysql_query($sql) or die(mysql_error());
		while ($row = mysql_fetch_array($query))
			$data[] = $row;
		return $data;
	}
	function jbt_tampil_div($div_id)
	{
		$sql = "SELECT * FROM jbt_master WHERE div_id='$div_id' ORDER BY jbt_id";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}

	function jbt_tampil_id($jbt_id)
	{
		$sql = "SELECT * FROM jbt_master WHERE jbt_id='$jbt_id' ORDER BY jbt_id";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
}

class Kota
{
	function kot_tampil()
	{
		$sql = "SELECT * FROM kot_master ORDER BY kot_id";
		$query = mysql_query($sql) or die(mysql_error());
		while ($row = mysql_fetch_array($query))
			$data[] = $row;
		return $data;
	}
	function kot_tampil_div($kot_id)
	{
		$sql = "SELECT * FROM kot_master WHERE kot_id='$kot_id' ORDER BY kot_id";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
}

class Level
{
	function lvl_tampil()
	{
		$sql = "SELECT * FROM lvl_master ORDER BY lvl_id";
		$query = mysql_query($sql) or die(mysql_error());
		while ($row = mysql_fetch_array($query))
			$data[] = $row;
		return $data;
	}
}

class Unit
{
	function unt_tampil()
	{
		$sql = "SELECT * FROM unt_master ORDER BY unt_id";
		$query = mysql_query($sql) or die(mysql_error());
		while ($row = mysql_fetch_array($query))
			$data[] = $row;
		return $data;
	}
}

class Kantor
{
	function ktr_tampil()
	{
		$sql = "SELECT * FROM ktr_master WHERE ktr_aktif='A' ORDER BY ktr_id";
		$query = mysql_query($sql) or die(mysql_error());
		while ($row = mysql_fetch_array($query))
			$data[] = $row;
		return $data;
	}
	function ktr_tampil_unitny($idkar)
	{
		$sql = "SELECT
				a.ktr_id,
				a.ktr_nm,
				a.ktr_aktif,
				a.ktr_kd,
				b.kar_id,
				b.kar_nm,
				b.kar_nik,
				c.ip_nm,
				c.ip_release,
				d.kar_dtl_typ_krj 
			FROM
				ktr_master a
				LEFT JOIN kar_master b ON a.ktr_id = b.ktr_id
				LEFT JOIN ip_master c ON a.ktr_id = c.ktr_id
				LEFT JOIN kar_detail d ON b.kar_id = d.kar_id 
			WHERE
				a.ktr_aktif = 'A' 
				AND b.unt_id = 2  
				AND b.kar_id = '$idkar'  
				AND d.kar_dtl_typ_krj <> 'Resign' 
			ORDER BY
				c.ip_release,
				a.ktr_kd";
		$query = mysql_query($sql) or die(mysql_error());
		while ($row = mysql_fetch_array($query))
			$data[] = $row;
		return $data;
	}
	function ktr_tampil_unit($kar_id)
	{
		$sql = "SELECT
				a.ktr_id,
				a.ktr_nm,
				a.ktr_aktif,
				a.ktr_kd,
				a.ktr_long,
				a.ktr_lat,
				b.kar_id,
				b.kar_nm,
				b.kar_nik,
				b.lvl_id,
				c.ip_nm,
				c.ip_release,
				d.kar_dtl_typ_krj 
			FROM
				ktr_master a
				LEFT JOIN kar_master b ON a.ktr_id = b.ktr_id
				LEFT JOIN ip_master c ON a.ktr_id = c.ktr_id
				LEFT JOIN kar_detail d ON b.kar_id = d.kar_id 
			WHERE
				a.ktr_aktif = 'A' 
				AND b.unt_id = 2 
				AND b.kar_id = '$kar_id' 
				AND d.kar_dtl_typ_krj <> 'Resign' 
			ORDER BY
				c.ip_release,
				a.ktr_kd";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	function ktr_tampil_pusat()
	{
		$sql = "SELECT * FROM ktr_master WHERE ktr_id='1' AND ktr_aktif='A' ORDER BY ktr_id";
		$query = mysql_query($sql) or die(mysql_error());
		while ($row = mysql_fetch_array($query))
			$data[] = $row;
		return $data;
	}
	function ktr_tampil_uniba()
	{
		$sql = "SELECT * FROM ktr_master WHERE ktr_id='152' AND ktr_aktif='A' ORDER BY ktr_id";
		$query = mysql_query($sql) or die(mysql_error());
		while ($row = mysql_fetch_array($query))
			$data[] = $row;
		return $data;
	}
	function ktr_tampil_tarkol()
	{
		$sql = "SELECT * FROM ktr_master WHERE ktr_id='2' AND ktr_aktif='A' ORDER BY ktr_id";
		$query = mysql_query($sql) or die(mysql_error());
		while ($row = mysql_fetch_array($query))
			$data[] = $row;
		return $data;
	}
	function ktr_tampil_ciracas()
	{
		$sql = "SELECT * FROM ktr_master WHERE ktr_id='46' AND ktr_aktif='A' ORDER BY ktr_id";
		$query = mysql_query($sql) or die(mysql_error());
		while ($row = mysql_fetch_array($query))
			$data[] = $row;
		return $data;
	}
	function ktr_tampil_ubudiyah()
	{
		$sql = "SELECT * FROM ktr_master WHERE ktr_id='156' AND ktr_aktif='A' ORDER BY ktr_id";
		$query = mysql_query($sql) or die(mysql_error());
		while ($row = mysql_fetch_array($query))
			$data[] = $row;
		return $data;
	}
	function ktr_tampil_stitbatam()
	{
		$sql = "SELECT * FROM ktr_master WHERE ktr_id='202' AND ktr_aktif='A' ORDER BY ktr_id";
		$query = mysql_query($sql) or die(mysql_error());
		while ($row = mysql_fetch_array($query))
			$data[] = $row;
		return $data;
	}
	function ktr_tampil_stihdeli()
	{
		$sql = "SELECT * FROM ktr_master WHERE ktr_id='183' OR ktr_id='182'  AND ktr_aktif='A' ORDER BY ktr_id";
		$query = mysql_query($sql) or die(mysql_error());
		while ($row = mysql_fetch_array($query))
			$data[] = $row;
		return $data;
	}
	function ktr_tampil_unt($unt_id)
	{
		$sql = "SELECT * FROM ktr_master WHERE unt_id='$unt_id' AND ktr_aktif='A' ORDER BY ktr_id";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	function ktr_tampil_id($ktr_id)
	{
		$sql = "SELECT * FROM ktr_master WHERE ktr_id='$ktr_id' AND ktr_aktif='A' ORDER BY ktr_id";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	function ktr_tampil_id_location($location)
	{
		$sql = "SELECT * FROM ktr_master WHERE ktr_id='$location' AND ktr_aktif='A' ORDER BY ktr_id";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	function ktr_update_status($ktr_id, $ktr_nm, $ktr_status)
	{
		$sql = "UPDATE ktr_master SET ktr_status='$ktr_status' WHERE ktr_id='$ktr_id' AND ktr_nm='$ktr_nm'";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	function ktr_update_status_unit($ktr_id, $ktr_nm, $ktr_status)
	{
		$sql = "UPDATE ktr_master SET ktr_status='$ktr_status',ktr_open_update=NOW() WHERE ktr_id='$ktr_id' AND ktr_nm='$ktr_nm'";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	function ktr_tampil_mac($mac_address)
	{
		$sql = "SELECT * FROM ktr_master WHERE unt_id='2' AND ktr_mac_address='$mac_address' AND ktr_aktif='A' ORDER BY ktr_id";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	function ktr_tampil_status()
	{
		$sql = "SELECT * FROM ktr_master WHERE unt_id='2' AND ktr_aktif='A' ORDER BY ktr_id";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
}

class Ip
{
	function ip_tampil()
	{
		$sql = "SELECT * FROM 
			  ip_master,
			  typ_master,
			  unt_master,
			  ktr_master
		 	  WHERE 
			  ip_master.typ_id=typ_master.typ_id AND
			  ip_master.unt_id=unt_master.unt_id AND
			  ip_master.ktr_id=ktr_master.ktr_id 
			  ORDER BY ip_id
			  ";
		$query = mysql_query($sql) or die(mysql_error());
		while ($row = mysql_fetch_array($query))
			$data[] = $row;
		return $data;
	}
	function ip_tampil_id($ip_id)
	{
		$sql = "SELECT * FROM ip_master WHERE ip_id='$ip_id' ORDER BY ip_id";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	function ip_insert($ip_nm, $ip_dns, $ip_release, $typ_id, $unt_id, $ktr_id)
	{
		$sql = "INSERT INTO ip_master VALUES(NULL,'$ip_nm','$ip_dns','$ip_release','$typ_id','$unt_id','$ktr_id')";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	function ip_delete($ip_id)
	{
		$sql = "DELETE FROM ip_master WHERE ip_id='$ip_id'";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	function ip_update($ip_id, $ip_nm, $ip_dns, $ip_release, $typ_id)
	{
		$sql = "UPDATE ip_master SET ip_nm='$ip_nm',ip_dns='$ip_dns',ip_release='$ip_release',typ_id='$typ_id' WHERE ip_id='$ip_id'";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	function ip_update_unt_ktr_static($date, $unt_id, $ktr_id)
	{
		$sql = "UPDATE ip_master SET ip_release='$date' WHERE unt_id='$unt_id' AND ktr_id='$ktr_id'";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	function ip_update_unt_ktr_dynamic($ip_jaringan, $date, $unt_id, $ktr_id)
	{
		$sql = "UPDATE ip_master SET ip_nm='$ip_jaringan',ip_release='$date' WHERE unt_id='$unt_id' AND ktr_id='$ktr_id'";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	function ip_tampil_unt_ktr($unt_id, $ktr_id)
	{
		$sql = "SELECT * FROM ip_master WHERE unt_id='$unt_id' AND ktr_id='$ktr_id' ORDER BY ip_id ASC LIMIT 1";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	function ip_cek($ip_nm)
	{
		$sql = "SELECT * FROM ip_master WHERE ip_nm='$ip_nm' ORDER BY ip_id ASC LIMIT 1";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	function ip_cek_dns($ip_nm, $ip_dns)
	{
		$sql = "SELECT * FROM ip_master WHERE ip_nm='$ip_nm' OR ip_dns='$ip_dns' ORDER BY ip_id ASC LIMIT 1";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	function ip_tampil_location($location)
	{
		$sql = "SELECT * FROM ip_master WHERE ktr_id='$location' ORDER BY ip_id ASC LIMIT 1";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	function ip_update_location_static($date, $location)
	{
		$sql = "UPDATE ip_master SET ip_release='$date' WHERE ktr_id='$location'";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	function ip_update_location_dynamic($ip_jaringan, $date, $location)
	{
		$sql = "UPDATE ip_master SET ip_nm='$ip_jaringan',ip_release='$date' WHERE ktr_id='$location'";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
}

class Type
{
	function typ_tampil()
	{
		$sql = "SELECT * FROM typ_master ORDER BY typ_id";
		$query = mysql_query($sql) or die(mysql_error());
		while ($row = mysql_fetch_array($query))
			$data[] = $row;
		return $data;
	}
}

class Tanggal
{
	function tgl_indo($date)
	{
		$BulanIndo = array(
			"Januari", "Februari", "Maret",
			"April", "Mei", "Juni",
			"Juli", "Agustus", "September",
			"Oktober", "November", "Desember"
		);

		$tahun = substr($date, 0, 4);
		$bulan = substr($date, 5, 2);
		$tgl   = substr($date, 8, 2);
		$result = $tgl . " " . $BulanIndo[(int)$bulan - 1] . " " . $tahun;
		return ($result);
	}

	function date_range($first, $last, $step = '+1 day', $output_format = 'Y-m-d')
	{

		$dates = array();
		$current = strtotime($first);
		$last = strtotime($last);

		while ($current <= $last) {

			$dates[] = date($output_format, $current);
			$current = strtotime($step, $current);
		}

		return $dates;
	}
}

class Absen
{
	function abs_masuk($abs_masuk, $abs_ip, $abs_tgl_masuk, $abs_shift, $abs_rwd_masuk, $abs_point, $kar_id)
	{
		$sql = "INSERT INTO abs_master VALUES(NULL,'$abs_masuk','','$abs_ip','$abs_tgl_masuk','','','','M','$abs_shift','$abs_rwd_masuk','','$abs_point','$kar_id')";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	function abs_masuk_telat($abs_masuk, $abs_ip, $abs_tgl_masuk, $abs_alasan_masuk, $abs_shift, $abs_rwd_masuk, $abs_point, $kar_id)
	{
		$sql = "INSERT INTO abs_master VALUES(NULL,'$abs_masuk','','$abs_ip','$abs_tgl_masuk','','$abs_alasan_masuk','','M','$abs_shift','$abs_rwd_masuk','','$abs_point','$kar_id')";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	function abs_pulang($abs_pulang, $abs_ip, $abs_tgl_pulang, $abs_rwd_pulang, $abs_point, $kar_id, $abs_tgl_masuk)
	{
		$sql = "UPDATE abs_master SET abs_pulang='$abs_pulang',abs_sts='P',abs_tgl_pulang='$abs_tgl_pulang',abs_rwd_pulang='$abs_rwd_pulang',abs_point='$abs_point',abs_ip='$abs_ip' WHERE kar_id='$kar_id' AND abs_tgl_masuk='$abs_tgl_masuk'";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	function abs_pulang_cepat($abs_pulang, $abs_ip, $abs_tgl_pulang, $abs_alasan_pulang, $abs_rwd_pulang, $abs_point, $kar_id, $abs_tgl_masuk)
	{
		$sql = "UPDATE abs_master SET abs_pulang='$abs_pulang',abs_alasan_pulang='$abs_alasan_pulang',abs_sts='P',abs_tgl_pulang='$abs_tgl_pulang',abs_rwd_pulang='$abs_rwd_pulang',abs_point='$abs_point',abs_ip='$abs_ip' WHERE kar_id='$kar_id' AND abs_tgl_masuk='$abs_tgl_masuk'";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	function abs_tampil_kar_location($kar_id_, $date)
	{
		$sql = "SELECT * FROM abs_master WHERE kar_id='$kar_id_' AND abs_tgl_masuk='$date' ORDER BY abs_id";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	function abs_tampil_kar_location_array($date)
	{
		$sql = "SELECT * FROM abs_master WHERE abs_tgl_masuk='$date' ORDER BY abs_id";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	function abs_tampil_kar($kar_id, $abs_tgl_masuk)
	{
		$sql = "SELECT * FROM abs_master WHERE kar_id='$kar_id' AND abs_tgl_masuk='$abs_tgl_masuk' ORDER BY abs_id";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	function abs_tampil_kar_2($kar_id, $abs_tgl_start, $abs_tgl_end)
	{
		$sql = "SELECT * FROM abs_master WHERE kar_id='$kar_id' AND abs_tgl_masuk BETWEEN '$abs_tgl_start' AND '$abs_tgl_end' ORDER BY abs_id";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	function abs_tampil_allkar_2($div_id, $abs_tgl_start, $abs_tgl_end)
	{
		$sql = "SELECT * FROM abs_master AS A,kar_master AS B WHERE A.kar_id=B.kar_id AND A.abs_tgl_masuk BETWEEN '$abs_tgl_start' AND '$abs_tgl_end' AND B.div_id='$div_id' ORDER BY abs_id";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	function abs_tampil_las($kar_id, $abs_tgl_las)
	{
		$sql = "SELECT * FROM abs_master WHERE kar_id='$kar_id' AND abs_tgl_masuk='$abs_tgl_las' ORDER BY abs_id";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	function abs_tampil_tgl($abs_tgl_masuk)
	{
		$sql = "SELECT * FROM abs_master WHERE abs_tgl_masuk='$abs_tgl_masuk' ORDER BY abs_id DESC";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	function abs_tampil_tgl_masuk($abs_tgl_masuk)
	{
		$sql = "SELECT * FROM abs_master WHERE abs_tgl_masuk='$abs_tgl_masuk' AND abs_sts='M' ORDER BY abs_id";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	function abs_tampil_tgl_pulang($abs_tgl_masuk)
	{
		$sql = "SELECT * FROM abs_master WHERE abs_tgl_masuk='$abs_tgl_masuk' AND abs_sts='P' ORDER BY abs_id";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	function abs_tampil()
	{
		$sql = "SELECT * FROM abs_master ORDER BY abs_id";
		$query = mysql_query($sql) or die(mysql_error());
		while ($row = mysql_fetch_array($query))
			$data[] = $row;
		return $data;
	}
	function abs_ip_konfirm($abs_id, $abs_ip)
	{
		$sql = "UPDATE abs_master SET abs_ip='$abs_ip' WHERE abs_id='$abs_id'";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	function abs_tampil_acc($kar_id)
	{
		$sql = "SELECT * FROM abs_master WHERE kar_id='$kar_id' ORDER BY abs_id DESC LIMIT 0,7";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	function abs_tampil_rwd($abs_rwd_masuk, $abs_tgl_masuk)
	{
		$sql = "SELECT * FROM abs_master WHERE abs_rwd_masuk='$abs_rwd_masuk' AND abs_tgl_masuk='$abs_tgl_masuk' ORDER BY abs_id";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	function abs_dtl_tampil($kar_id_, $abs_dtl_tgl)
	{
		$sql = "SELECT * FROM abs_detail WHERE kar_id='$kar_id_' AND abs_dtl_tgl='$abs_dtl_tgl' ORDER BY abs_dtl_id";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	function abs_dtl_kar_id($kar_id_, $abs_dtl_tgl)
	{
		$sql = "SELECT kar_id FROM abs_detail WHERE kar_id='$kar_id_' AND abs_dtl_tgl='$abs_dtl_tgl' ORDER BY abs_dtl_id ASC LIMIT 1";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	function abs_dtl_tampil_array($abs_dtl_tgl)
	{
		$sql = "SELECT * FROM abs_detail WHERE abs_dtl_tgl='$abs_dtl_tgl' ORDER BY abs_dtl_id";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	function abs_dtl_insert($abs_dtl_tgl, $abs_dtl_sts, $kar_id)
	{
		$sql = "INSERT INTO abs_detail VALUES(NULL,'$abs_dtl_tgl','$abs_dtl_sts','','','$kar_id')";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	function abs_dtl_update($abs_dtl_tgl, $abs_dtl_sts, $kar_id)
	{
		$sql = "UPDATE abs_detail SET abs_dtl_sts='$abs_dtl_sts' WHERE abs_dtl_tgl='$abs_dtl_tgl' AND kar_id='$kar_id'";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	function abs_dtl_insert_full($abs_dtl_tgl, $abs_dtl_sts, $abs_dtl_type, $ktr_id, $kar_id)
	{
		$sql = "INSERT INTO abs_detail VALUES(NULL,'$abs_dtl_tgl','$abs_dtl_sts','$abs_dtl_type','$ktr_id','$kar_id')";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	function abs_dtl_tampil_sts($abs_dtl_sts, $abs_dtl_tgl)
	{
		$sql = "SELECT * FROM abs_detail WHERE abs_dtl_tgl='$abs_dtl_tgl' AND abs_dtl_sts='$abs_dtl_sts' ORDER BY abs_dtl_id";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	function abs_settime_id($abs_stm_nm)
	{
		$sql = "SELECT * FROM abs_settime WHERE abs_stm_nm='$abs_stm_nm' ORDER BY abs_stm_id";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	function abs_stm_update($abs_stm_jam, $abs_stm_id)
	{
		$sql = "UPDATE abs_settime SET abs_stm_jam='$abs_stm_jam' WHERE abs_stm_id='$abs_stm_id'";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	function abs_sort_tgl($tgl_awal, $tgl_akhir)
	{
		$sql = "SELECT * FROM abs_master WHERE abs_tgl_masuk BETWEEN '$tgl_awal' AND '$tgl_akhir' ORDER BY abs_id";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	function abs_dtl_sort_tgl($kar_id_, $tgl_awal, $tgl_akhir)
	{
		$sql = "SELECT * FROM abs_detail WHERE kar_id='$kar_id_' AND abs_dtl_tgl BETWEEN '$tgl_awal' AND '$tgl_akhir' ORDER BY abs_dtl_id";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	function abs_tampil_rwd_sort($abs_rwd_masuk, $tgl_awal, $tgl_akhir)
	{
		$sql = "SELECT * FROM abs_master WHERE abs_rwd_masuk='$abs_rwd_masuk' AND abs_tgl_masuk BETWEEN '$tgl_awal' AND '$tgl_akhir' ORDER BY abs_id";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	function abs_dtl_tampil_sts_sort($abs_dtl_sts, $tgl_awal, $tgl_akhir)
	{
		$sql = "SELECT * FROM abs_detail WHERE abs_dtl_sts='$abs_dtl_sts' AND abs_dtl_tgl BETWEEN '$tgl_awal' AND '$tgl_akhir'  ORDER BY abs_dtl_id";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	function abs_point_update($abs_id, $abs_point)
	{
		$sql = "UPDATE abs_master SET abs_point='$abs_point' WHERE abs_id='$abs_id'";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	function abs_tgl_rpt()
	{
		$sql = "SELECT * FROM abs_tanggal ORDER BY abs_tgl_id";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	function abs_tgl_rpt_bln($kar_id_, $tgl_1, $tgl_31)
	{
		$sql = "SELECT * FROM abs_master WHERE kar_id='$kar_id_' AND abs_tgl_masuk BETWEEN '$tgl_1' AND '$tgl_31' ORDER BY abs_id";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	function abs_tgl_rpt_point($kar_id_, $tgl_1, $tgl_31)
	{
		$sql = "SELECT SUM(abs_point) AS point FROM abs_master WHERE kar_id='$kar_id_' AND abs_point!='0' AND abs_tgl_masuk BETWEEN '$tgl_1' AND '$tgl_31' ORDER BY abs_id";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	function abs_tgl_rpt_bln_array($tgl_1, $tgl_31)
	{
		$sql = "SELECT COUNT(DISTINCT abs_tgl_masuk) AS num_rows,kar_id FROM `abs_master` WHERE abs_tgl_masuk BETWEEN '$tgl_1' AND '$tgl_31' GROUP BY kar_id";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	function abs_tgl_rpt_point_array($tgl_1, $tgl_31)
	{
		$sql = "SELECT COUNT(DISTINCT abs_tgl_masuk) AS num_rows, SUM(abs_point) AS point,kar_id FROM abs_master WHERE abs_point!='0' AND abs_tgl_masuk BETWEEN '$tgl_1' AND '$tgl_31' GROUP BY kar_id";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	function abs_masuk_update($edt_abs_masuk, $edt_abs_id)
	{
		$sql = "UPDATE abs_master SET abs_masuk='$edt_abs_masuk' WHERE abs_id='$edt_abs_id'";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	function abs_abs($abs_tgl_masuk)
	{
		$sql = "SELECT
				a.kar_id,
				a.kar_nik,
				a.kar_nm 
			FROM
				kar_master a
				LEFT JOIN kar_detail b ON a.kar_id = b.kar_id 
			WHERE
				b.kar_dtl_typ_krj <> 'Resign' AND b.kar_dtl_sts_krj ='A'
				AND a.kar_id NOT IN ( SELECT kar_id FROM abs_master c WHERE c.abs_tgl_masuk = '$abs_tgl_masuk' )
			ORDER BY
				a.kar_id";
		//echo $sql; 
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
}

class Mark
{
	function mrk_tampil()
	{
		$sql = "SELECT * FROM mrk_master ORDER BY mrk_id";
		$query = mysql_query($sql) or die(mysql_error());
		while ($row = mysql_fetch_array($query))
			$data[] = $row;
		return $data;
	}
}

class Headline
{
	function hed_insert($hed_sbj, $hed_msg, $hed_tgl, $mrk_id, $div_id)
	{
		$sql = "INSERT INTO hed_master VALUES(NULL,'$hed_sbj','$hed_msg','$hed_tgl','A','$mrk_id','$div_id')";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	function hed_tampil()
	{
		$sql = "SELECT * FROM 
			  hed_master,
			  mrk_master,
			  div_master
		 	  WHERE 
			  hed_master.mrk_id=mrk_master.mrk_id AND
			  hed_master.div_id=div_master.div_id 
			  ORDER BY hed_id
			  DESC
			  ";
		$query = mysql_query($sql) or die(mysql_error());
		while ($row = mysql_fetch_array($query))
			$data[] = $row;
		return $data;
	}
	function hed_tampil_aktif($sepuluhhrsebelumnya)
	{
		$sql = "SELECT * FROM 
			  hed_master,
			  mrk_master,
			  div_master
		 	  WHERE 
			  hed_master.mrk_id=mrk_master.mrk_id AND
			  hed_master.div_id=div_master.div_id AND
			  hed_master.hed_sts='A' AND
			  hed_master.hed_tgl >= '$sepuluhhrsebelumnya'
			  ORDER BY hed_id
			  DESC
			  ";
		$query = mysql_query($sql) or die(mysql_error());
		while ($row = mysql_fetch_array($query))
			$data[] = $row;
		return $data;
	}
	function hed_update($hed_id, $hed_sbj, $hed_msg, $mrk_id, $div_id)
	{
		$sql = "UPDATE hed_master SET hed_sbj='$hed_sbj',hed_msg='$hed_msg',mrk_id='$mrk_id',div_id='$div_id' WHERE hed_id='$hed_id'";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	function hed_delete($hed_id)
	{
		$sql = "DELETE FROM hed_master WHERE hed_id='$hed_id'";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	function hed_tampil_id($hed_id)
	{
		$sql = "SELECT * FROM hed_master WHERE hed_id='$hed_id' ORDER BY hed_id";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	function hed_update_sts($hed_id, $hed_sts)
	{
		$sql = "UPDATE hed_master SET hed_sts='$hed_sts' WHERE hed_id='$hed_id'";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
}

class Account
{
	function acc_tampil()
	{
		$sql = "SELECT * FROM 
			  acc_master,
			  kar_master
		 	  WHERE 
			  acc_master.kar_id=kar_master.kar_id
			  ORDER BY acc_id
			  ";
		$query = mysql_query($sql) or die(mysql_error());
		while ($row = mysql_fetch_array($query))
			$data[] = $row;
		return $data;
	}
	function acc_tampil_id($acc_id)
	{
		$sql = "SELECT * FROM 
			  acc_master,
			  kar_master
		 	  WHERE 
			  acc_master.kar_id=kar_master.kar_id AND
			  acc_master.acc_id='$acc_id'
			  ORDER BY acc_id
			  ";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	function acc_tampil_username($acc_username)
	{
		$sql = "SELECT * FROM acc_master WHERE acc_username='$acc_username' ORDER BY acc_id";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	function acc_insert($acc_username, $acc_password, $kar_id)
	{
		$sql = "INSERT INTO acc_master VALUES(NULL,'$acc_username','$acc_password',md5('$acc_password'),'','','','','','$kar_id')";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	function acc_tampil_kar($kar_id)
	{
		$sql = "SELECT * FROM  
			  acc_master,
			  kar_master
			  WHERE 
			  acc_master.kar_id=kar_master.kar_id AND
			  acc_master.kar_id='$kar_id' 
			  ORDER BY acc_id";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	function acc_delete($acc_id)
	{
		$sql = "DELETE FROM acc_master WHERE acc_id='$acc_id'";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	function acc_img_update($acc_img, $kar_id)
	{
		$sql = "UPDATE acc_master SET acc_img='$acc_img' WHERE kar_id='$kar_id'";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	function acc_pass_update($acc_password, $kar_id)
	{
		$sql = "UPDATE acc_master SET acc_password='$acc_password', acc_md5=md5('$acc_password') WHERE kar_id='$kar_id'";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	function acc_signin($acc_username, $acc_password, $date, $time)
	{
		$result = mysql_query("SELECT * FROM acc_master WHERE acc_username = '$acc_username' AND acc_password = '$acc_password' AND (acc_sts = 'A' OR acc_sts ='')");
		$acc_data = mysql_fetch_array($result);
		$cek_acc = mysql_num_rows($result);
		if ($cek_acc == 1) {
			$_SESSION['kar'] = $acc_data['kar_id'];
			$sql = "UPDATE acc_master SET acc_log_tgl='$date',acc_log_jam='$time' WHERE kar_id='$acc_data[kar_id]'";
			$query = mysql_query($sql) or die(mysql_error());
			return TRUE;
		} else {
			return FALSE;
		}
	}
	function acc_signout($kar_id, $date, $time)
	{
		$sql = "UPDATE acc_master SET acc_log_tgl='$date',acc_log_jam='$time' WHERE kar_id='$kar_id'";
		$query = mysql_query($sql) or die(mysql_error());
		session_start();
		$_SESSION['kar'] = '';
		session_unset();
		session_destroy();
		session_start();
		session_regenerate_id(true);
		return TRUE;
	}
	function acc_update_sts($acc_id, $acc_sts)
	{
		$sql = "UPDATE acc_master SET acc_sts='$acc_sts' WHERE acc_id='$acc_id'";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}

	//////////////////////////////////////////////////////////////////////////////////////////////


	function acc_tampil_ms()
	{
		$sql = "SELECT * FROM 
			  ms_acc_master,
			  ms_kar_master
		 	  WHERE 
			  ms_acc_master.kar_id=ms_kar_master.kar_id
			  ORDER BY acc_id
			  ";
		$query = mysql_query($sql) or die(mysql_error());
		while ($row = mysql_fetch_array($query))
			$data[] = $row;
		return $data;
	}
	function acc_tampil_ms_id($acc_id)
	{
		$sql = "SELECT * FROM 
			  ms_acc_master,
			  ms_kar_master
		 	  WHERE 
			  ms_acc_master.kar_id=ms_kar_master.kar_id AND
			  ms_acc_master.acc_id='$acc_id'
			  ORDER BY acc_id
			  ";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	function acc_tampil_ms_username($acc_username)
	{
		$sql = "SELECT * FROM ms_acc_master WHERE acc_username='$acc_username' ORDER BY acc_id";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	function acc_insert_ms($acc_username, $acc_password, $kar_id)
	{
		$sql = "INSERT INTO ms_acc_master VALUES(NULL,'$acc_username','$acc_password',md5('$acc_password'),'','','','','','$kar_id')";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	function acc_tampil_ms_kar($kar_id)
	{
		$sql = "SELECT * FROM  
			  ms_acc_master,
			  ms_kar_master
			  WHERE 
			  ms_acc_master.kar_id=ms_kar_master.kar_id AND
			  ms_acc_master.kar_id='$kar_id' 
			  ORDER BY acc_id";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	function acc_delete_ms($acc_id)
	{
		$sql = "DELETE FROM ms_acc_master WHERE acc_id='$acc_id'";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	function acc_img_ms_update($acc_img, $kar_id)
	{
		$sql = "UPDATE ms_acc_master SET acc_img='$acc_img' WHERE kar_id='$kar_id'";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	function acc_pass_ms_update($acc_password, $kar_id)
	{
		$sql = "UPDATE ms_acc_master SET acc_password='$acc_password', acc_md5=md5('$acc_password') AND  WHERE kar_id='$kar_id'";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	function acc_signin_ms($acc_username, $acc_password, $date, $time)
	{
		$result = mysql_query("SELECT * FROM ms_acc_master WHERE acc_username = '$acc_username' AND acc_password = '$acc_password' AND (acc_sts = 'A' OR acc_sts ='')");
		$acc_data = mysql_fetch_array($result);
		$cek_acc = mysql_num_rows($result);
		if ($cek_acc == 1) {
			$_SESSION['kar'] = $acc_data['kar_id'];
			$sql = "UPDATE ms_acc_master SET acc_log_tgl='$date',acc_log_jam='$time' WHERE kar_id='$acc_data[kar_id]'";
			$query = mysql_query($sql) or die(mysql_error());
			return TRUE;
		} else {
			return FALSE;
		}
	}
	function acc_signout_ms($kar_id, $date, $time)
	{
		$sql = "UPDATE ms_acc_master SET acc_log_tgl='$date',acc_log_jam='$time' WHERE kar_id='$kar_id'";
		$query = mysql_query($sql) or die(mysql_error());
		session_start();
		$_SESSION['kar'] = '';
		session_unset();
		session_destroy();
		session_start();
		session_regenerate_id(true);
		return TRUE;
	}
	function acc_update_ms_sts($acc_id, $acc_sts)
	{
		$sql = "UPDATE ms_acc_master SET acc_sts='$acc_sts' WHERE acc_id='$acc_id'";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
}

class Injection
{
	function anti_injection($data)
	{
		$filter = mysql_real_escape_string(stripslashes(strip_tags(htmlspecialchars($data, ENT_QUOTES))));
		return $filter;
	}
}

class Shift
{
	function waktu_shift()
	{
		$waktu = date("H:i:s");
		$t = explode(":", $waktu);
		if ($t[0] == "00") {
			$jam = "24";
		} else {
			$jam = $t[0];
		}
		$menit = $t[1];
		if ($jam > 00 and $jam < 10) {
			if ($menit > 00 and $menit < 60) {
				$ucapan = "Pagi";
			}
		} else if ($jam >= 10 and $jam < 13) {
			if ($menit > 00 and $menit < 60) {
				$ucapan = "Siang";
			}
		} else if ($jam >= 13 and $jam < 18) {
			if ($menit > 00 and $menit < 60) {
				$ucapan = "Sore";
			}
		} else if ($jam >= 18 and $jam <= 24) {
			if ($menit > 00 and $menit < 60) {
				$ucapan = "Malam";
			}
		} else {
			$ucapan = "Error";
		}
		return $ucapan;
	}
}

class Post
{
	function pos_insert_atc($pos_msg, $pos_atc, $pos_tgl, $pos_jam, $mrk_id, $kar_id)
	{
		$sql = "INSERT INTO pos_master VALUES(NULL,'$pos_msg','$pos_atc','$pos_tgl','$pos_jam','A','$mrk_id','$kar_id')";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	function pos_insert($pos_msg, $pos_tgl, $pos_jam, $mrk_id, $kar_id)
	{
		$sql = "INSERT INTO pos_master VALUES(NULL,'$pos_msg','','$pos_tgl','$pos_jam','A','$mrk_id','$kar_id')";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	function pos_tampil()
	{
		$sql = "SELECT * FROM 
			  pos_master,
			  mrk_master,
			  kar_master
		 	  WHERE 
			  pos_master.mrk_id=mrk_master.mrk_id AND 
			  pos_master.kar_id=kar_master.kar_id 
			  ORDER BY pos_id
			  DESC
			  ";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	function pos_tampil_aktif($kemarinnya_ymd)
	{
		$sql = "SELECT * FROM 
			  pos_master,
			  mrk_master,
			  kar_master
		 	  WHERE 
			  pos_master.mrk_id=mrk_master.mrk_id AND 
			  pos_master.kar_id=kar_master.kar_id AND
			  pos_master.pos_sts='A' AND
			  pos_master.pos_tgl >= '$kemarinnya_ymd'
			  ORDER BY pos_id
			  DESC
			  ";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	function pos_update_sts($pos_id, $pos_sts)
	{
		$sql = "UPDATE pos_master SET pos_sts='$pos_sts' WHERE pos_id='$pos_id'";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	function pos_delete($pos_id)
	{
		$sql = "DELETE FROM pos_master WHERE pos_id='$pos_id'";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
}

class Archive
{
	function acv_insert_file($acv_nm, $acv_file, $acv_tgl, $div_id)
	{
		$sql = "INSERT INTO acv_master VALUES(NULL,'$acv_nm','$acv_file','$acv_tgl','A','$div_id')";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	function acv_insert($acv_nm, $acv_tgl, $div_id)
	{
		$sql = "INSERT INTO acv_master VALUES(NULL,'$acv_nm','','$acv_tgl','A',$div_id')";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	function acv_tampil()
	{
		$sql = "SELECT * FROM 
			  acv_master,
			  div_master
		 	  WHERE 
			  acv_master.div_id=div_master.div_id 
			  ORDER BY acv_id
			  DESC
			  ";
		$query = mysql_query($sql) or die(mysql_error());
		while ($row = mysql_fetch_array($query))
			$data[] = $row;
		return $data;
	}
	function acv_tampil_aktif()
	{
		$sql = "SELECT * FROM 
			  acv_master,
			  div_master
		 	  WHERE 
			  acv_master.div_id=div_master.div_id AND
			  acv_master.acv_sts='A'
			  ORDER BY acv_id
			  DESC
			  LIMIT 0,5
			  ";
		$query = mysql_query($sql) or die(mysql_error());
		while ($row = mysql_fetch_array($query))
			$data[] = $row;
		return $data;
	}
	function acv_update_file($acv_id, $acv_nm, $acv_file, $div_id)
	{
		$sql = "UPDATE acv_master SET acv_nm='$acv_nm',acv_file='$acv_file',div_id='$div_id' WHERE acv_id='$acv_id'";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	function acv_update($acv_id, $acv_nm, $div_id)
	{
		$sql = "UPDATE acv_master SET acv_nm='$acv_nm',div_id='$div_id' WHERE acv_id='$acv_id'";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	function acv_delete($acv_id)
	{
		$sql = "DELETE FROM acv_master WHERE acv_id='$acv_id'";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	function acv_tampil_id($acv_id)
	{
		$sql = "SELECT * FROM acv_master WHERE acv_id='$acv_id' ORDER BY acv_id";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	function acv_update_sts($acv_id, $acv_sts)
	{
		$sql = "UPDATE acv_master SET acv_sts='$acv_sts' WHERE acv_id='$acv_id'";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
}

class Mailbox
{
	function mlb_tampil($div_id, $kar_id)
	{
		$sql = "SELECT * FROM 
			  mlb_master,
			  kar_master,
			  mrk_master
			  WHERE
			  mlb_master.kar_id=kar_master.kar_id AND
			  mlb_master.mrk_id=mrk_master.mrk_id AND
			  mlb_master.mlb_tujuan='$div_id' AND 
			  mlb_master.mlb_sub_tujuan='$kar_id'
			  ORDER BY mlb_id
			  DESC
			  ";
		$query = mysql_query($sql) or die(mysql_error());
		while ($row = mysql_fetch_array($query))
			$data[] = $row;
		return $data;
	}
	function mlb_tampil_array()
	{
		$sql = "SELECT * FROM 
			  mlb_master,
			  kar_master,
			  mrk_master
			  WHERE
			  mlb_master.kar_id=kar_master.kar_id AND
			  mlb_master.mrk_id=mrk_master.mrk_id 
			  ORDER BY mlb_id
			  DESC
			  ";
		$query = mysql_query($sql) or die(mysql_error());
		while ($row = mysql_fetch_array($query))
			$data[] = $row;
		return $data;
	}
	function mlb_tampil_kar($div_id, $kar_id)
	{
		$sql = "SELECT * FROM 
			  mlb_master,
			  kar_master,
			  mrk_master
			  WHERE
			  mlb_master.kar_id=kar_master.kar_id AND
			  mlb_master.mrk_id=mrk_master.mrk_id AND
			  (mlb_master.mlb_tujuan='$div_id' OR 
			  mlb_master.mlb_sub_tujuan='$kar_id')
			  ORDER BY mlb_id
			  DESC
			  ";
		$query = mysql_query($sql) or die(mysql_error());
		while ($row = mysql_fetch_array($query))
			$data[] = $row;
		return $data;
	}
	function mlb_tampil_sts($div_id, $kar_id)
	{
		$sql = "SELECT * FROM 
			  mlb_master,
			  kar_master,
			  mrk_master
			  WHERE
			  mlb_master.kar_id=kar_master.kar_id AND
			  mlb_master.mrk_id=mrk_master.mrk_id AND
			  (mlb_master.mlb_tujuan='$div_id' OR 
			  mlb_master.mlb_sub_tujuan='$kar_id') AND
			  mlb_master.mlb_sts='N'
			  ORDER BY mlb_id
			  DESC
			  ";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	function mlb_tampil_sts_limit($div_id, $kar_id)
	{
		$sql = "SELECT * FROM 
			  mlb_master,
			  kar_master,
			  mrk_master
			  WHERE
			  mlb_master.kar_id=kar_master.kar_id AND
			  mlb_master.mrk_id=mrk_master.mrk_id AND
			  (mlb_master.mlb_tujuan='$div_id' OR 
			  mlb_master.mlb_sub_tujuan='$kar_id')
			  ORDER BY mlb_id
			  DESC LIMIT 3
			  ";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	function mlb_tampil_id($mlb_id)
	{
		$sql = "SELECT * FROM 
			  mlb_master,
			  kar_master,
			  mrk_master
			  WHERE
			  mlb_master.kar_id=kar_master.kar_id AND
			  mlb_master.mrk_id=mrk_master.mrk_id AND
			  mlb_master.mlb_id='$mlb_id'
			  ORDER BY mlb_id
			  DESC
			  ";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	function mlb_insert_atc_tujuan($mlb_sbj, $mlb_msg, $mlb_atc, $mlb_tgl, $mlb_jam, $mlb_tujuan, $mrk_id, $kar_id)
	{
		$sql = "INSERT INTO mlb_master VALUES(NULL,'$mlb_sbj','$mlb_msg','$mlb_atc','N','$mlb_tgl','$mlb_jam','$mlb_tujuan','','$mrk_id','$kar_id')";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	function mlb_insert_atc_sub_tujuan($mlb_sbj, $mlb_msg, $mlb_atc, $mlb_tgl, $mlb_jam, $mlb_sub_tujuan, $mrk_id, $kar_id)
	{
		$sql = "INSERT INTO mlb_master VALUES(NULL,'$mlb_sbj','$mlb_msg','$mlb_atc','N','$mlb_tgl','$mlb_jam','','$mlb_sub_tujuan','$mrk_id','$kar_id')";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	function mlb_insert_tujuan($mlb_sbj, $mlb_msg, $mlb_tgl, $mlb_jam, $mlb_tujuan, $mrk_id, $kar_id)
	{
		$sql = "INSERT INTO mlb_master VALUES(NULL,'$mlb_sbj','$mlb_msg','','N','$mlb_tgl','$mlb_jam','$mlb_tujuan','','$mrk_id','$kar_id')";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	function mlb_insert_sub_tujuan($mlb_sbj, $mlb_msg, $mlb_tgl, $mlb_jam, $mlb_sub_tujuan, $mrk_id, $kar_id)
	{
		$sql = "INSERT INTO mlb_master VALUES(NULL,'$mlb_sbj','$mlb_msg','','N','$mlb_tgl','$mlb_jam','','$mlb_sub_tujuan','$mrk_id','$kar_id')";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	function mlb_update_sts($mlb_id)
	{
		$sql = "UPDATE mlb_master SET mlb_sts='R' WHERE mlb_id='$mlb_id'";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
}

class Size
{
	function size2Byte($size)
	{
		$units = array('KB', 'MB', 'GB', 'TB');
		$currUnit = '';
		while (count($units) > 0  &&  $size > 1024) {
			$currUnit = array_shift($units);
			$size /= 1024;
		}
		return (ceil($size)) . $currUnit;
	}
}

class TimeSet
{
	function humanTiming($time)
	{
		$time = time() - $time;
		$tokens = array(
			31536000 => 'year',
			2592000 => 'month',
			604800 => 'week',
			86400 => 'day',
			3600 => 'hour',
			60 => 'minute',
			1 => 'second'
		);
		foreach ($tokens as $unit => $text) {
			if ($time < $unit) continue;
			$numberOfUnits = floor($time / $unit);
			return $numberOfUnits . ' ' . $text . (($numberOfUnits > 1) ? 's' : '');
		}
	}
}

class Penjadwalan
{
	function jwd_tampil()
	{
		$sql = "SELECT * FROM 
			  jwd_master,
			  kar_master
			  WHERE
			  jwd_master.kar_id=kar_master.kar_id
			  ORDER BY jwd_id
			  DESC
			  ";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	function jwd_tampil_id($kar_id)
	{
		$sql = "SELECT * FROM 
			  jwd_master,
			  kar_master
			  WHERE
			  jwd_master.kar_id=kar_master.kar_id AND
			  jwd_master.kar_id='$kar_id'
			  ORDER BY jwd_id
			  DESC
			  ";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	function jwd_insert($jwd_nm, $jwd_start, $jwd_end, $kar_id)
	{
		$sql = "INSERT INTO jwd_master VALUES(NULL,'$jwd_nm','$jwd_start','$jwd_end','$kar_id')";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	function jwd_tampil_now($date, $kar_id, $kemarin)
	{
		$sql = "SELECT * FROM jwd_master WHERE kar_id='$kar_id' AND (jwd_start <= '$date' AND jwd_end >= '$date') ORDER BY jwd_id";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	function jwd_delete($jwd_id)
	{
		$sql = "DELETE FROM jwd_master WHERE jwd_id='$jwd_id'";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	function jwo_tampil()
	{
		$sql = "SELECT * FROM jwo_master WHERE jwo_id='1'";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	function jwo_update($jwo_kode)
	{
		$sql = "UPDATE jwo_master SET jwo_kode='$jwo_kode' WHERE jwo_id='1'";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
}

class Notify
{
	function ntf_insert($ntf_act, $ntf_isi, $ntf_ip, $ntf_tgl, $ntf_jam, $kar_id)
	{
		$sql = "INSERT INTO ntf_master VALUES(NULL,'$ntf_act','$ntf_isi','$ntf_ip','$ntf_tgl','$ntf_jam','$kar_id')";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	function ntf_delete($date)
	{
		$sql = "DELETE FROM ntf_master WHERE ntf_tgl!='$date'";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	function ntf_tampil($tanggal)
	{
		$sql = "SELECT * FROM 
			  ntf_master,
			  kar_master
			  WHERE
			  ntf_master.kar_id=kar_master.kar_id AND
			  ntf_master.ntf_tgl='$tanggal'
			  ORDER BY ntf_id
			  DESC
			  ";
		$query = mysql_query($sql) or die(mysql_error());
		while ($row = mysql_fetch_array($query))
			$data[] = $row;
		return $data;
	}
	function ntf_data_cek($ntf_data_act, $ntf_data_isi, $ntf_data_url, $ntf_data_tujuan, $ntf_data_sumber)
	{
		$sql = "SELECT * FROM ntf_data WHERE ntf_data_act='$ntf_data_act' AND ntf_data_isi='$ntf_data_isi'  AND ntf_data_url='$ntf_data_url' AND ntf_data_tujuan='$ntf_data_tujuan' AND ntf_data_sumber='$ntf_data_sumber' ORDER BY ntf_data_id DESC ";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	function ntf_data_cek_bornday($ntf_data_act, $ntf_data_isi, $ntf_data_url, $ntf_data_tujuan, $ntf_data_sumber, $ntf_data_tgl)
	{
		$sql = "SELECT * FROM ntf_data WHERE ntf_data_act='$ntf_data_act' AND ntf_data_isi='$ntf_data_isi'  AND ntf_data_url='$ntf_data_url' AND ntf_data_tujuan='$ntf_data_tujuan' AND ntf_data_sumber='$ntf_data_sumber' AND ntf_data_tgl='$ntf_data_tgl' ORDER BY ntf_data_id DESC ";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	function ntf_data_insert($ntf_data_act, $ntf_data_isi, $ntf_data_url, $ntf_data_ip, $ntf_data_tgl, $ntf_data_jam, $ntf_data_tujuan, $ntf_data_sumber)
	{
		$sql = "INSERT INTO ntf_data VALUES(NULL,'$ntf_data_act','$ntf_data_isi','$ntf_data_url','$ntf_data_ip','$ntf_data_tgl','$ntf_data_jam','$ntf_data_tujuan','$ntf_data_sumber','')";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	function ntf_data_sts_read($kar_id)
	{
		$sql = "SELECT * FROM ntf_data WHERE (ntf_data_tujuan='$kar_id' OR ntf_data_tujuan='ALL') AND ntf_data_read NOT LIKE '%$kar_id%' ORDER BY ntf_data_id DESC ";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	function ntf_data_tampil($ntf_data_tujuan)
	{
		$sql = "SELECT * FROM ntf_data WHERE ntf_data_tujuan='$ntf_data_tujuan' OR ntf_data_tujuan='ALL' ORDER BY ntf_data_id DESC ";
		$query = mysql_query($sql) or die(mysql_error());
		while ($row = mysql_fetch_array($query))
			$data[] = $row;
		return $data;
	}
	function ntf_data_tampil_read($ntf_data_id, $ntf_data_read)
	{
		$sql = "SELECT * FROM ntf_data WHERE (ntf_data_tujuan='$ntf_data_read' OR ntf_data_tujuan='ALL') AND ntf_data_id='$ntf_data_id' AND ntf_data_read LIKE '%$ntf_data_read%' ORDER BY ntf_data_id DESC";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	function ntf_data_update_read($ntf_data_id, $ntf_data_read)
	{
		$sql = "UPDATE ntf_data SET ntf_data_read='$ntf_data_read' WHERE ntf_data_id='$ntf_data_id'";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	function ntf_data_tampil_kd($page, $ntf_data_url, $ntf_data_tujuan)
	{
		$sql = "SELECT * FROM ntf_data WHERE ntf_data_url LIKE '%$ntf_data_url%' AND ntf_data_url LIKE '%$page%' AND ntf_data_tujuan LIKE '%$ntf_data_tujuan%' ORDER BY ntf_data_id DESC LIMIT 1";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	function ntf_data_tampil_limit($ntf_data_tujuan)
	{
		$sql = "SELECT * FROM ntf_data WHERE ntf_data_tujuan='$ntf_data_tujuan' OR ntf_data_tujuan='ALL' ORDER BY ntf_data_id DESC LIMIT 6";
		$query = mysql_query($sql) or die(mysql_error());
		while ($row = mysql_fetch_array($query))
			$data[] = $row;
		return $data;
	}
}

class Masa
{
	function hitung_masa_kerja($tgl_join, $date)
	{
		$tgl_join = (is_string($tgl_join) ? strtotime($tgl_join) : $tgl_join);
		$date = (is_string($date) ? strtotime($date) : $date);
		$diff_secs = abs($tgl_join - $date);
		$base_year = min(date("Y", $tgl_join), date("Y", $date));
		$diff = mktime(0, 0, $diff_secs, 1, 1, $base_year);
		return array(
			"years" => date("Y", $diff) - $base_year,
			"months_total" => (date("Y", $diff) - $base_year) * 12 + date("n", $diff) - 1,
			"months" => date("n", $diff) - 1,
			"days_total" => floor($diff_secs / (3600 * 24)),
			"days" => date("j", $diff) - 1,
			"hours_total" => floor($diff_secs / 3600),
			"hours" => date("G", $diff),
			"minutes_total" => floor($diff_secs / 60),
			"minutes" => (int) date("i", $diff),
			"seconds_total" => $diff_secs,
			"seconds" => (int) date("s", $diff)
		);
	}
}

class Umur
{
	function hitung_umur($tgl_lahir)
	{
		$tgl = explode("-", $tgl_lahir);
		$umur = date("Y") - $tgl[0];
		if (($tgl[1] > date("m")) || ($tgl[1] == date("m") && date("d") < $tgl[2])) {
			$umur -= 1;
		}
		return $umur;
	}
}

class Request
{
	function req_kd($kdawal)
	{
		$sql = "SELECT MAX(req_id) AS max_kd FROM req_master WHERE req_kd LIKE '$kdawal%'";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	function req_kd_auto()
	{
		$sql = "SELECT MAX(req_id) AS max_kd_auto FROM req_master";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	function req_tmp_insert($sesi, $date, $ast_id)
	{
		$sql = "INSERT INTO req_tmp VALUES(NULL,'$sesi','$date','1','$ast_id')";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	function req_tmp_update($req_tmp_jml, $req_tmp_id)
	{
		$sql = "UPDATE req_tmp SET req_tmp_jml='$req_tmp_jml' WHERE req_tmp_id='$req_tmp_id'";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	function req_tmp_delete_kemarin()
	{
		$kemarin = date('Y-m-d', mktime(0, 0, 0, date('m'), date('d') - 1, date('Y')));
		$sql = "DELETE FROM req_tmp WHERE req_tmp_tgl < '$kemarin'";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	function req_tmp_tampil($sesi, $date)
	{
		$sql = "SELECT * FROM req_tmp WHERE req_tmp_sesi='$sesi' AND req_tmp_tgl='$date' ORDER BY req_tmp_id";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	function req_tmp_cek_ast($sesi, $date, $ast_id)
	{
		$sql = "SELECT * FROM req_tmp WHERE req_tmp_sesi='$sesi' AND req_tmp_tgl='$date' AND ast_id='$ast_id' ORDER BY req_tmp_id";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	function req_tmp_delete($req_tmp_id)
	{
		$sql = "DELETE FROM req_tmp WHERE req_tmp_id='$req_tmp_id'";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	function req_insert($new_kd, $date, $time, $req_sts, $kar_id)
	{
		$sql = "INSERT INTO req_master VALUES(NULL,'$new_kd','$date','$time','$req_sts','$kar_id')";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	function req_tmp_clear($sesi, $date)
	{
		$sql = "DELETE FROM req_tmp WHERE req_tmp_sesi = '$sesi' AND req_tmp_tgl = '$date'";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;

		session_start();
		session_regenerate_id(true);
		return TRUE;
	}
	function req_tmp_isi($sesi, $date)
	{
		$req_tmp_isi = array();
		$sql = "SELECT * FROM req_tmp WHERE req_tmp_sesi='$sesi' AND req_tmp_tgl='$date' ORDER BY req_tmp_id";
		$query = mysql_query($sql) or die(mysql_error());

		while ($req_tmp_data = mysql_fetch_array($query)) {
			$req_tmp_isi[] = $req_tmp_data;
		}
		return $req_tmp_isi;
	}
	function req_dtl_insert($ast_jml, $req_id, $ast_id_)
	{
		$sql = "INSERT INTO req_detail VALUES(NULL,'$ast_jml','$req_id','$ast_id_')";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	function req_tampil_kar($kar_id)
	{
		$sql = "SELECT * FROM req_master WHERE kar_id='$kar_id' ORDER BY req_id DESC";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	function req_tampil_id($req_id)
	{
		$sql = "SELECT * FROM req_master WHERE md5(req_id)='$req_id' ORDER BY req_id";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	function req_dtl_tampil($req_id)
	{
		$sql = "SELECT * FROM req_detail WHERE req_id='$req_id' ORDER BY req_dtl_id";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	function req_tampil()
	{
		$sql = "SELECT * FROM req_master ORDER BY req_id DESC";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	function req_sts_update($req_sts, $req_id_)
	{
		$sql = "UPDATE req_master SET req_sts='$req_sts' WHERE req_id='$req_id_'";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
}

class Asset
{
	function ast_tampil()
	{
		$sql = "SELECT * FROM 
			  ast_master,
			  ast_jenis
			  WHERE
			  ast_master.ast_jns_id=ast_jenis.ast_jns_id
			  ORDER BY ast_id
			  DESC
			  ";
		$query = mysql_query($sql) or die(mysql_error());
		while ($row = mysql_fetch_array($query))
			$data[] = $row;
		return $data;
	}
	function ast_tampil_jns_id($ast_jns_id)
	{
		$sql = "SELECT * FROM ast_master WHERE ast_jns_id='$ast_jns_id' ORDER BY ast_id";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	function ast_tampil_jns($ast_jns_id, $ast_sts)
	{
		$sql = "SELECT * FROM ast_master WHERE ast_jns_id='$ast_jns_id' AND ast_sts='$ast_sts' ORDER BY ast_id";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	function ast_tampil_id($ast_id)
	{
		$sql = "SELECT * FROM 
			  ast_master,
			  ast_jenis
			  WHERE
			  ast_master.ast_jns_id=ast_jenis.ast_jns_id AND 
			  ast_master.ast_id='$ast_id'
			  ORDER BY ast_id
			  DESC
			  ";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	function ast_jns_tampil()
	{
		$sql = "SELECT * FROM ast_jenis ORDER BY ast_jns_id";
		$query = mysql_query($sql) or die(mysql_error());
		while ($row = mysql_fetch_array($query))
			$data[] = $row;
		return $data;
	}
	function ast_jns_id($ast_jns_id)
	{
		$sql = "SELECT * FROM ast_jenis WHERE ast_jns_id='$ast_jns_id' ORDER BY ast_jns_id";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	function ast_insert($ast_nm, $ast_sn, $ast_des, $ast_sts, $ast_jns_id)
	{
		$sql = "INSERT INTO ast_master VALUES(NULL,'$ast_nm','$ast_sn','$ast_des','$ast_sts','$ast_jns_id')";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	function ast_update($ast_nm, $ast_sn, $ast_des, $ast_sts, $ast_jns_id, $ast_id)
	{
		$sql = "UPDATE ast_master SET ast_nm='$ast_nm',ast_sn='$ast_sn',ast_des='$ast_des',ast_sts='$ast_sts',ast_jns_id='$ast_jns_id' WHERE ast_id='$ast_id'";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	function ast_jns_insert($ast_jns_nm)
	{
		$sql = "INSERT INTO ast_jenis VALUES(NULL,'$ast_jns_nm')";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	function ast_jns_update($ast_jns_nm, $ast_jns_id)
	{
		$sql = "UPDATE ast_jenis SET ast_jns_nm='$ast_jns_nm' WHERE ast_jns_id='$ast_jns_id'";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	function ast_sn_cek($ast_sn)
	{
		$sql = "SELECT * FROM ast_master WHERE ast_sn='$ast_sn' ORDER BY ast_id";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
}

class Biodata
{
	function kdr_tampil_id($kar_id)
	{
		$sql = "SELECT * FROM kendaraan WHERE kar_id='$kar_id' ORDER BY kdr_id";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	function pyk_tampil_id($kar_id)
	{
		$sql = "SELECT * FROM penyakit WHERE kar_id='$kar_id' ORDER BY pyk_id";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	function hbi_tampil_id($kar_id)
	{
		$sql = "SELECT * FROM hobi WHERE kar_id='$kar_id' ORDER BY hbi_id";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	function pdd_tampil_id($kar_id)
	{
		$sql = "SELECT * FROM pendidikan WHERE kar_id='$kar_id' ORDER BY pdd_id DESC";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	function ttg_tampil_id($kar_id)
	{
		$sql = "SELECT * FROM tempat_tinggal WHERE kar_id='$kar_id' ORDER BY ttg_id";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	function kpd_tampil_id($kar_id)
	{
		$sql = "SELECT * FROM kemampuan_diri WHERE kar_id='$kar_id' ORDER BY kpd_id";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	function pgd_tampil_id($kar_id)
	{
		$sql = "SELECT * FROM pengembangan_diri WHERE kar_id='$kar_id' ORDER BY pgd_id";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	function cta_tampil_id($kar_id)
	{
		$sql = "SELECT * FROM cita_cita WHERE kar_id='$kar_id' ORDER BY cta_id";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	function hrp_tampil_id($kar_id)
	{
		$sql = "SELECT * FROM harapan WHERE kar_id='$kar_id' ORDER BY hrp_id";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	function krd_tampil_id($kar_id)
	{
		$sql = "SELECT * FROM kredit WHERE kar_id='$kar_id' ORDER BY krd_id";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	function khs_tampil_id($kar_id)
	{
		$sql = "SELECT * FROM khursus WHERE kar_id='$kar_id' ORDER BY khs_id";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	function kbt_tampil_id($kar_id)
	{
		$sql = "SELECT * FROM kerabat WHERE kar_id='$kar_id' ORDER BY kbt_id";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	function rwp_tampil_id($kar_id)
	{
		$sql = "SELECT * FROM riwayat_pekerjaan WHERE kar_id='$kar_id' ORDER BY rwp_id";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	function rwg_tampil_id($kar_id)
	{
		$sql = "SELECT * FROM riwayat_gg WHERE kar_id='$kar_id' ORDER BY rwg_id";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	function sim_tampil_id($kar_id)
	{
		$sql = "SELECT * FROM sim WHERE kar_id='$kar_id' ORDER BY sim_id";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	function kkr_tampil_id($kar_id)
	{
		$sql = "SELECT * FROM kartu_kredit WHERE kar_id='$kar_id' ORDER BY kkr_id";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	function sdr_tampil_id($kar_id)
	{
		$sql = "SELECT * FROM saudara WHERE kar_id='$kar_id' ORDER BY sdr_id";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	function ank_tampil_id($kar_id)
	{
		$sql = "SELECT * FROM anak WHERE kar_id='$kar_id' ORDER BY ank_id";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	function bio_tampil_id($kar_id)
	{
		$sql = "SELECT * FROM bio WHERE kar_id='$kar_id' ORDER BY bio_id";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	function bio_ph_tampil_id($kar_id)
	{
		$sql = "SELECT * FROM pasangan_hidup WHERE kar_id='$kar_id' ORDER BY bio_ph_id";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	function hbi_insert($hbi_nm, $hbi_lvl, $hbi_thn, $kar_id)
	{
		$sql = "INSERT INTO hobi  VALUES(NULL,'$hbi_nm','$hbi_lvl','$hbi_thn','A','$kar_id')";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	function cta_insert($cta_nm, $cta_thn, $kar_id)
	{
		$sql = "INSERT INTO cita_cita VALUES(NULL,'$cta_nm','$cta_thn','A','$kar_id')";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	function khs_insert($khs_nm, $khs_lembaga, $khs_sertifikat, $khs_start, $khs_end, $khs_lokasi, $kar_id)
	{
		$sql = "INSERT INTO khursus VALUES(NULL,'$khs_nm','$khs_lembaga','$khs_sertifikat','$khs_start','$khs_end','$khs_lokasi','A','$kar_id')";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	function pgd_insert($pgd_nm, $pgd_thn, $kar_id)
	{
		$sql = "INSERT INTO pengembangan_diri VALUES(NULL,'$pgd_nm','$pgd_thn','A','$kar_id')";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	function hrp_insert($hrp_nm, $hrp_thn, $kar_id)
	{
		$sql = "INSERT INTO harapan VALUES(NULL,'$hrp_nm','$hrp_thn','A','$kar_id')";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	function kpd_insert($kpd_nm, $kpd_lvl, $kar_id)
	{
		$sql = "INSERT INTO kemampuan_diri VALUES(NULL,'$kpd_nm','$kpd_lvl','A','$kar_id')";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	function pyk_insert($pyk_nm, $pyk_lvl, $pyk_start, $pyk_end, $kar_id)
	{
		$sql = "INSERT INTO penyakit VALUES(NULL,'$pyk_nm','$pyk_lvl','$pyk_start','$pyk_end','A','$kar_id')";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	function kbt_insert($kbt_nm, $kbt_hubungan, $kbt_alt, $kbt_kodepos, $kbt_tlp, $kbt_hp, $kar_id)
	{
		$sql = "INSERT INTO kerabat VALUES(NULL,'$kbt_nm','$kbt_hubungan','$kbt_alt','$kbt_kodepos','$kbt_tlp','$kbt_hp','A','$kar_id')";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	function kdr_insert($kdr_jns, $kdr_no, $kdr_mrk, $kdr_typ, $kdr_thn, $kar_id)
	{
		$sql = "INSERT INTO kendaraan VALUES(NULL,'$kdr_jns','$kdr_no','$kdr_mrk','$kdr_typ','$kdr_thn','A','$kar_id')";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	function kkr_insert($kkr_bank, $kkr_limit, $kkr_tempo, $kar_id)
	{
		$sql = "INSERT INTO kartu_kredit VALUES(NULL,'$kkr_bank','$kkr_limit','$kkr_tempo','A','$kar_id')";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	function krd_insert($krd_jns, $krd_nm, $krd_des, $krd_akad, $krd_durasi, $krd_via, $kar_id)
	{
		$sql = "INSERT INTO kredit VALUES(NULL,'$krd_jns','$krd_nm','$krd_des','$krd_akad','$krd_durasi','$krd_via','A','$kar_id')";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	function ttg_insert($ttg_jns, $ttg_typ, $ttg_luas_tanah, $ttg_luas_bangunan, $ttg_alt, $ttg_thn, $kar_id)
	{
		$sql = "INSERT INTO tempat_tinggal VALUES(NULL,'$ttg_jns','$ttg_typ','$ttg_luas_tanah','$ttg_luas_bangunan','$ttg_alt','$ttg_thn','A','$kar_id')";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	function ank_insert($ank_nm, $ank_gender, $ank_tml, $ank_tll, $ank_goldarah, $ank_kondisi, $kar_id)
	{
		$sql = "INSERT INTO anak VALUES(NULL,'$ank_nm','$ank_gender','$ank_tml','$ank_tll','$ank_goldarah','$ank_kondisi','A','$kar_id')";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	function bio_insert($bio_nm_panggil, $bio_gender, $bio_tml, $bio_goldarah, $bio_agama, $bio_bintang, $bio_shio, $bio_alt, $bio_rtrw, $bio_kelurahan, $bio_kecamatan, $bio_kota, $bio_propinsi, $bio_kodepos, $bio_tlp, $bio_hp, $bio_eml, $bio_web, $kar_id)
	{
		$sql = "INSERT INTO bio VALUES(NULL,'$bio_nm_panggil','$bio_gender','$bio_tml','$bio_goldarah','$bio_agama','$bio_bintang','$bio_shio','$bio_alt','$bio_rtrw','$bio_kelurahan','$bio_kecamatan','$bio_kota','$bio_propinsi','$bio_kodepos','$bio_tlp','$bio_hp','$bio_eml','$bio_web','A','$kar_id')";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	function bio_ph_insert($bio_ph_nm, $bio_ph_nm_panggil, $bio_ph_tml, $bio_ph_tll, $bio_ph_goldarah, $bio_ph_agama, $kar_id)
	{
		$sql = "INSERT INTO pasangan_hidup VALUES(NULL,'$bio_ph_nm','$bio_ph_nm_panggil','$bio_ph_tml','$bio_ph_tll','$bio_ph_goldarah','$bio_ph_agama','A','$kar_id')";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	function sim_insert_file($sim_jns, $sim_no, $sim_newname, $sim_masa, $kar_id)
	{
		$sql = "INSERT INTO sim VALUES(NULL,'$sim_jns','$sim_no','$sim_newname','$sim_masa','A','$kar_id')";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	function sim_insert($sim_jns, $sim_no, $sim_masa, $kar_id)
	{
		$sql = "INSERT INTO sim VALUES(NULL,'$sim_jns','$sim_no','','$sim_masa','A','$kar_id')";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	function rwp_insert($rwp_jbt, $rwp_lvl, $rwp_penghasilan, $rwp_perusahaan, $rwp_alt, $rwp_start, $rwp_end, $rwp_berhenti, $kar_id)
	{
		$sql = "INSERT INTO riwayat_pekerjaan VALUES(NULL,'$rwp_jbt','$rwp_lvl','$rwp_penghasilan','$rwp_perusahaan','$rwp_alt','$rwp_start','$rwp_end','$rwp_berhenti','A','$kar_id')";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	function pdd_insert($pdd_lvl, $pdd_nm, $pdd_jurusan, $pdd_start, $pdd_end, $pdd_nilai, $pdd_lokasi, $kar_id)
	{
		$sql = "INSERT INTO pendidikan VALUES(NULL,'$pdd_lvl','$pdd_nm','$pdd_jurusan','$pdd_start','$pdd_end','$pdd_nilai','$pdd_lokasi','A','$kar_id')";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	function sdr_insert($sdr_nm, $sdr_hubungan, $sdr_kondisi, $sdr_alt, $sdr_pekerjaan, $sdr_kodepos, $sdr_tlp, $sdr_hp, $kar_id)
	{
		$sql = "INSERT INTO saudara VALUES(NULL,'$sdr_nm','$sdr_hubungan','$sdr_kondisi','$sdr_alt','$sdr_pekerjaan','$sdr_kodepos','$sdr_tlp','$sdr_hp','A','$kar_id')";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	function bio_update($bio_nm_panggil, $bio_gender, $bio_tml, $bio_goldarah, $bio_agama, $bio_bintang, $bio_shio, $bio_alt, $bio_rtrw, $bio_kelurahan, $bio_kecamatan, $bio_kota, $bio_propinsi, $bio_kodepos, $bio_tlp, $bio_hp, $bio_eml, $bio_web, $kar_id)
	{
		$sql = "UPDATE bio SET bio_nm_panggil='$bio_nm_panggil', bio_gender='$bio_gender', bio_tml='$bio_tml', bio_goldarah='$bio_goldarah', bio_agama='$bio_agama', bio_bintang='$bio_bintang', bio_shio='$bio_shio',  bio_alt='$bio_alt', bio_rtrw='$bio_rtrw', bio_kelurahan='$bio_kelurahan', bio_kecamatan='$bio_kecamatan', bio_kota='$bio_kota', bio_propinsi='$bio_propinsi', bio_kodepos='$bio_kodepos', bio_tlp='$bio_tlp', bio_hp='$bio_hp', bio_eml='$bio_eml', bio_web='$bio_web' WHERE kar_id='$kar_id'";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	function kdr_update($kdr_id, $kdr_jns, $kdr_no, $kdr_mrk, $kdr_typ, $kdr_thn, $kar_id)
	{
		$sql = "UPDATE kendaraan SET kdr_jns='$kdr_jns',kdr_no='$kdr_no',kdr_mrk='$kdr_mrk',kdr_typ='$kdr_typ',kdr_thn='$kdr_thn' WHERE kdr_id='$kdr_id' AND kar_id='$kar_id'";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	function ank_update($ank_id, $ank_nm, $ank_gender, $ank_tml, $ank_tll, $ank_goldarah, $ank_kondisi, $kar_id)
	{
		$sql = "UPDATE anak SET ank_nm='$ank_nm',ank_gender='$ank_gender',ank_tml='$ank_tml',ank_tll='$ank_tll',ank_goldarah='$ank_goldarah',ank_kondisi='$ank_kondisi' WHERE ank_id='$ank_id' AND kar_id='$kar_id'";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	function kkr_update($kkr_id, $kkr_bank, $kkr_limit, $kkr_tempo, $kar_id)
	{
		$sql = "UPDATE kartu_kredit SET kkr_bank='$kkr_bank',kkr_limit='$kkr_limit',kkr_tempo='$kkr_tempo' WHERE kkr_id='$kkr_id' AND kar_id='$kar_id'";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	function sdr_update($sdr_id, $sdr_nm, $sdr_hubungan, $sdr_kondisi, $sdr_alt, $sdr_pekerjaan, $sdr_kodepos, $sdr_tlp, $sdr_hp, $kar_id)
	{
		$sql = "UPDATE saudara SET sdr_nm='$sdr_nm',sdr_hubungan='$sdr_hubungan',sdr_kondisi='$sdr_kondisi',sdr_alt='$sdr_alt',sdr_pekerjaan='$sdr_pekerjaan',sdr_kodepos='$sdr_kodepos',sdr_tlp='$sdr_tlp',sdr_hp='$sdr_hp' WHERE sdr_id='$sdr_id' AND  kar_id='$kar_id'";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	function pdd_update($pdd_id, $pdd_lvl, $pdd_nm, $pdd_jurusan, $pdd_start, $pdd_end, $pdd_nilai, $pdd_lokasi, $kar_id)
	{
		$sql = "UPDATE pendidikan SET pdd_lvl='$pdd_lvl',pdd_nm='$pdd_nm',pdd_jurusan='$pdd_jurusan',pdd_start='$pdd_start',pdd_end='$pdd_end',pdd_nilai='$pdd_nilai',pdd_lokasi='$pdd_lokasi' WHERE pdd_id='$pdd_id' AND kar_id='$kar_id'";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	function khs_update($khs_id, $khs_nm, $khs_lembaga, $khs_sertifikat, $khs_start, $khs_end, $khs_lokasi, $kar_id)
	{
		$sql = "UPDATE khursus SET khs_nm='$khs_nm',khs_lembaga='$khs_lembaga',khs_sertifikat='$khs_sertifikat',khs_start='$khs_start',khs_end='$khs_end',khs_lokasi='$khs_lokasi' WHERE kar_id='$kar_id'";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	function rwp_update($rwp_id, $rwp_jbt, $rwp_lvl, $rwp_penghasilan, $rwp_perusahaan, $rwp_alt, $rwp_start, $rwp_end, $rwp_berhenti, $kar_id)
	{
		$sql = "UPDATE riwayat_pekerjaan SET rwp_jbt='$rwp_jbt',rwp_lvl='$rwp_lvl',rwp_penghasilan='$rwp_penghasilan',rwp_perusahaan='$rwp_perusahaan',rwp_alt='$rwp_alt',rwp_start='$rwp_start',rwp_end='$rwp_end',rwp_berhenti='$rwp_berhenti' WHERE kar_id='$kar_id'";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	function pyk_update($pyk_id, $pyk_nm, $pyk_lvl, $pyk_start, $pyk_end, $kar_id)
	{
		$sql = "UPDATE penyakit SET pyk_nm='$pyk_nm',pyk_lvl='$pyk_lvl',pyk_start='$pyk_start',pyk_end='$pyk_end' WHERE kar_id='$kar_id'";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	function hbi_update($hbi_id, $hbi_nm, $hbi_lvl, $hbi_thn, $kar_id)
	{
		$sql = "UPDATE hobi SET hbi_nm='$hbi_nm',hbi_lvl='$hbi_lvl',hbi_thn='$hbi_thn' WHERE kar_id='$kar_id'";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	function ttg_update($ttg_id, $ttg_jns, $ttg_typ, $ttg_luas_tanah, $ttg_luas_bangunan, $ttg_alt, $ttg_thn, $kar_id)
	{
		$sql = "UPDATE tempat_tinggal SET ttg_jns='$ttg_jns',ttg_typ='$ttg_typ',ttg_luas_tanah='$ttg_luas_tanah',ttg_luas_bangunan='$ttg_luas_bangunan',ttg_alt='$ttg_alt',ttg_thn='$ttg_thn' WHERE kar_id='$kar_id'";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	function kbt_update($kbt_id, $kbt_nm, $kbt_hubungan, $kbt_alt, $kbt_kodepos, $kbt_tlp, $kbt_hp, $kar_id)
	{
		$sql = "UPDATE kerabat SET kbt_nm='$kbt_nm',kbt_hubungan='$kbt_hubungan',kbt_alt='$kbt_alt',kbt_kodepos='$kbt_kodepos',kbt_tlp='$kbt_tlp',kbt_hp='$kbt_hp' WHERE kar_id='$kar_id'";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	function kpd_update($kpd_id, $kpd_nm, $kpd_lvl, $kar_id)
	{
		$sql = "UPDATE kemampuan_diri SET kpd_nm='$kpd_nm',kpd_lvl='$kpd_lvl' WHERE kar_id='$kar_id'";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	function pgd_update($pgd_id, $pgd_nm, $pgd_thn, $kar_id)
	{
		$sql = "UPDATE pengembangan_diri SET pgd_nm='$pgd_nm',pgd_thn='$pgd_thn' WHERE kar_id='$kar_id'";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	function krd_update($krd_id, $krd_jns, $krd_nm, $krd_des, $krd_akad, $krd_durasi, $krd_via, $kar_id)
	{
		$sql = "UPDATE kredit SET krd_jns='$krd_jns',krd_nm='$krd_nm',krd_des='$krd_des',krd_akad='$krd_akad',krd_durasi='$krd_durasi',krd_via='$krd_via' WHERE kar_id='$kar_id'";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	function cta_update($cta_id, $cta_nm, $cta_thn, $kar_id)
	{
		$sql = "UPDATE cita_cita SET cta_nm='$cta_nm',cta_thn='$cta_thn' WHERE kar_id='$kar_id'";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	function hrp_update($hrp_id, $hrp_nm, $hrp_thn, $kar_id)
	{
		$sql = "UPDATE harapan SET hrp_nm='$hrp_nm',hrp_thn='$hrp_thn' WHERE kar_id='$kar_id'";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	function sim_update($sim_id, $sim_jns, $sim_no, $sim_masa, $kar_id)
	{
		$sql = "UPDATE sim SET sim_jns='$sim_jns',sim_no='$sim_no',sim_masa='$sim_masa' WHERE sim_id='$sim_id' AND kar_id='$kar_id'";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	function sim_update_file($sim_id, $sim_jns, $sim_no, $sim_newname, $sim_masa, $kar_id)
	{
		$sql = "UPDATE sim SET sim_jns='$sim_jns',sim_no='$sim_no',sim_img='$sim_newname',sim_masa='$sim_masa' WHERE sim_id='$sim_id' AND kar_id='$kar_id'";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	function sim_cek_img($sim_id)
	{
		$sql = "SELECT * FROM sim WHERE sim_id='$sim_id' ORDER BY sim_id";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
}

class Penggajian
{
	function gji_tampil_kar($kar_id)
	{
		$sql = "SELECT * FROM gji_master WHERE kar_id='$kar_id' ORDER BY gji_id";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	function gji_update_kar($kar_id_, $gji_gapok, $gji_tunj_kel, $gji_tunj_jab, $gji_tunj_fung, $gji_jum_gaji, $gji_gaji_bpjs, $gji_lain_lain, $gji_bpjs_jamsos, $gji_jum_komp, $gji_gaji_std, $gji_gaji_baru, $gji_gaji_pajak, $gji_paguyuban, $gji_pajak_pph21)
	{
		$sql = "UPDATE gji_master SET gji_gapok='$gji_gapok',gji_tunj_kel='$gji_tunj_kel',gji_tunj_jab='$gji_tunj_jab',gji_tunj_fung='$gji_tunj_fung',gji_jum_gaji='$gji_jum_gaji',gji_gaji_bpjs='$gji_gaji_bpjs',gji_lain_lain='$gji_lain_lain',gji_bpjs_jamsos='$gji_bpjs_jamsos',gji_jum_komp='$gji_jum_komp',gji_gaji_std='$gji_gaji_std',gji_gaji_baru='$gji_gaji_baru',gji_gaji_pajak='$gji_gaji_pajak',gji_paguyuban='$gji_paguyuban',gji_pajak_pph21='$gji_pajak_pph21' WHERE kar_id='$kar_id_'";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	function gji_insert_kar($kar_id_, $gji_gapok, $gji_tunj_kel, $gji_tunj_jab, $gji_tunj_fung, $gji_jum_gaji, $gji_gaji_bpjs, $gji_lain_lain, $gji_bpjs_jamsos, $gji_jum_komp, $gji_gaji_std, $gji_gaji_baru, $gji_gaji_pajak, $gji_paguyuban, $gji_pajak_pph21)
	{
		$sql = "INSERT INTO gji_master VALUES(NULL,'$gji_gapok','$gji_tunj_kel','$gji_tunj_jab','$gji_tunj_fung','$gji_jum_gaji','$gji_gaji_bpjs','$gji_lain_lain','$gji_bpjs_jamsos','$gji_jum_komp','$gji_gaji_std','$gji_gaji_baru','$gji_gaji_pajak','$gji_paguyuban','$gji_pajak_pph21','$kar_id_')";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
}

class Penilaian
{
	function kkn_insert($kkn_kontrak, $kkn_start, $kkn_end, $kkn_keterangan, $kar_id)
	{
		$sql = "INSERT INTO kkn_master VALUES(NULL,'$kkn_kontrak','$kkn_start','$kkn_end','$kkn_keterangan','$kar_id')";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	function kkn_tampil_kar($kar_id)
	{
		$sql = "SELECT * FROM kkn_master WHERE kar_id='$kar_id' ORDER BY kkn_id DESC";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	function kkn_tampil_kar_asc($kar_id)
	{
		$sql = "SELECT * FROM kkn_master WHERE kar_id='$kar_id' ORDER BY kkn_id ASC";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	function kkn_tampil_kar_limit($kar_id)
	{
		$sql = "SELECT * FROM kkn_master WHERE kar_id='$kar_id' ORDER BY kkn_id DESC LIMIT 1";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	function kkn_update($kkn_id, $kkn_kontrak, $kkn_start, $kkn_end, $kkn_keterangan)
	{
		$sql = "UPDATE kkn_master SET kkn_kontrak='$kkn_kontrak',kkn_start='$kkn_start',kkn_end='$kkn_end',kkn_keterangan='$kkn_keterangan' WHERE kkn_id='$kkn_id'";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	function kkn_delete($kkn_id_)
	{
		$sql = "DELETE FROM kkn_master WHERE kkn_id='$kkn_id_'";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	function fpk_tampil_kar($kar_id)
	{
		$sql = "SELECT * FROM fpk_master WHERE kar_id='$kar_id' ORDER BY fpk_id";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	function fpk_tampil_thn($kar_id_, $thn__)
	{
		$sql = "SELECT * FROM fpk_master WHERE kar_id='$kar_id_' AND fpk_tgl LIKE '%$thn__%' ORDER BY fpk_id";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	function fpk_tampil_asp()
	{
		$sql = "SELECT * FROM fpk_aspek ORDER BY fpk_asp_id";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	function fpk_tampil_point($fpk_asp_id)
	{
		$sql = "SELECT * FROM fpk_point WHERE fpk_asp_id='$fpk_asp_id' ORDER BY fpk_point_id";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	function fpk_tampil_bobot($fpk_huruf)
	{
		$sql = "SELECT * FROM fpk_bobot WHERE fpk_huruf='$fpk_huruf' ORDER BY fpk_bobot_id";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	function fpk_kd_awal($kdawal)
	{
		$sql = "SELECT MAX(fpk_id) AS max_kd FROM fpk_master WHERE fpk_kd LIKE '$kdawal%'";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	function fpk_kd_auto()
	{
		$sql = "SELECT MAX(fpk_id) AS max_kd_auto FROM fpk_master";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	function fpk_insert($fpk_kd, $fpk_keterangan, $fpk_priode, $fpk_gaji, $fpk_tgl, $fpk_nilai1, $fpk_nilai2, $fpk_nilai3, $fpk_nilai4, $fpk_nilai5, $fpk_nilai6, $fpk_nilai7, $fpk_nilai8, $fpk_nilai9, $fpk_nilai10, $fpk_nilai11, $fpk_nilai12, $fpk_nilai13, $fpk_nilai14, $fpk_nilai15, $fpk_nilai16, $fpk_nilai17, $fpk_nilai18, $fpk_prestasi, $fpk_pelanggaran, $fpk_saranperbaikan, $fpk_penilai, $fpk_mengetahui, $fpk_mengetahui2, $fpk_mengetahui3, $fpk_ditetapkan, $fpk_sts, $fpk_sesi, $fpk_kirim, $kar_id_)
	{
		$sql = "INSERT INTO fpk_master VALUES(NULL,'$fpk_kd','$fpk_keterangan','$fpk_priode',NULL,NULL,'$fpk_nilai1','$fpk_nilai2','$fpk_nilai3','$fpk_nilai4','$fpk_nilai5','$fpk_nilai6','$fpk_nilai7','$fpk_nilai8','$fpk_nilai9','$fpk_nilai10','$fpk_nilai11','$fpk_nilai12','$fpk_nilai13','$fpk_nilai14','$fpk_nilai15','$fpk_nilai16','$fpk_nilai17','$fpk_nilai18','$fpk_prestasi','$fpk_pelanggaran','$fpk_saranperbaikan','$fpk_penilai','$fpk_mengetahui','$fpk_mengetahui2','$fpk_mengetahui3',NULL,'$fpk_ditetapkan','$fpk_sts','$fpk_sesi','$fpk_kirim','$kar_id_')";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	function fpk_tampil_id($fpk_kd)
	{
		$sql = "SELECT * FROM fpk_master WHERE md5(fpk_kd)='$fpk_kd' ORDER BY fpk_id";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	function fpk_tampil_grade($fpk_grade)
	{
		$sql = "SELECT * FROM fpk_bobot WHERE fpk_bobot_angka='$fpk_grade' ORDER BY fpk_bobot_id";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	function fpk_tampil_point_all()
	{
		$sql = "SELECT * FROM fpk_point ORDER BY fpk_point_id";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	function fpk_tampil_bobot_all($fpk_huruf)
	{
		$sql = "SELECT * FROM fpk_bobot WHERE fpk_huruf='$fpk_huruf' ORDER BY fpk_bobot_id";
		$query = mysql_query($sql) or die(mysql_error());
		while ($row = mysql_fetch_array($query))
			$data[] = $row;
		return $data;
	}
	function fpk_update($fpk_id, $fpk_tgl, $fpk_nilai1, $fpk_nilai2, $fpk_nilai3, $fpk_nilai4, $fpk_nilai5, $fpk_nilai6, $fpk_nilai7, $fpk_nilai8, $fpk_nilai9, $fpk_nilai10, $fpk_nilai11, $fpk_nilai12, $fpk_nilai13, $fpk_nilai14, $fpk_nilai15, $fpk_nilai16, $fpk_nilai17, $fpk_nilai18, $fpk_prestasi, $fpk_pelanggaran, $fpk_saranperbaikan, $fpk_ditetapkan, $fpk_sts)
	{
		$sql = "UPDATE fpk_master SET fpk_tgl='$fpk_tgl',fpk_nilai1='$fpk_nilai1',fpk_nilai2='$fpk_nilai2',fpk_nilai3='$fpk_nilai3',fpk_nilai4='$fpk_nilai4',fpk_nilai5='$fpk_nilai5',fpk_nilai6='$fpk_nilai6',fpk_nilai7='$fpk_nilai7',fpk_nilai8='$fpk_nilai8',fpk_nilai9='$fpk_nilai9',fpk_nilai10='$fpk_nilai10',fpk_nilai11='$fpk_nilai11',fpk_nilai12='$fpk_nilai12',fpk_nilai13='$fpk_nilai13',fpk_nilai14='$fpk_nilai14',fpk_nilai15='$fpk_nilai15',fpk_nilai16='$fpk_nilai16',fpk_nilai17='$fpk_nilai17',fpk_nilai18='$fpk_nilai18',fpk_prestasi='$fpk_prestasi',fpk_pelanggaran='$fpk_pelanggaran',fpk_saranperbaikan='$fpk_saranperbaikan',fpk_ditetapkan='$fpk_ditetapkan',fpk_sts='$fpk_sts' WHERE fpk_id='$fpk_id'";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	function fpk_update_sts($fpk_id, $fpk_ditetapkan, $fpk_sts)
	{
		$sql = "UPDATE fpk_master SET fpk_ditetapkan='$fpk_ditetapkan',fpk_sts='$fpk_sts' WHERE fpk_id='$fpk_id'";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	function fpk_update_konfirm($fpk_id, $fpk_konfirm)
	{
		$sql = "UPDATE fpk_master SET fpk_konfirm='$fpk_konfirm' WHERE fpk_id='$fpk_id'";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	function fpk_konfirm_user($fpk_id, $kar_id)
	{
		$sql = "SELECT * FROM fpk_master WHERE md5(fpk_kd)='$fpk_id' AND fpk_konfirm LIKE '%$kar_id%'";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	function rkm_insert($rkm_nilai, $rkm_keterangan, $rkm_sanksi, $rkm_pelapor, $rkm_tgl, $rkm_tgl_akhir, $kar_id)
	{
		$sql = "INSERT INTO rkm_master VALUES(NULL,'$rkm_nilai','$rkm_keterangan','$rkm_sanksi','$rkm_pelapor','$rkm_tgl','$rkm_tgl_akhir','$kar_id')";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	function rkm_tampil_kar($kar_id)
	{
		$sql = "SELECT * FROM rkm_master WHERE kar_id='$kar_id' ORDER BY rkm_id";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	function rkm_tampil_tanggal($rkm_tgl)
	{
		$sql = "SELECT * FROM rkm_master WHERE rkm_tgl='$rkm_tgl' ORDER BY rkm_id";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	function rkm_update($rkm_id, $rkm_nilai, $rkm_keterangan, $rkm_sanksi, $rkm_pelapor, $rkm_tgl, $rkm_tgl_akhir)
	{
		$sql = "UPDATE rkm_master SET rkm_nilai='$rkm_nilai',rkm_keterangan='$rkm_keterangan',rkm_sanksi='$rkm_sanksi',rkm_pelapor='$rkm_pelapor',rkm_tgl='$rkm_tgl',rkm_tgl_akhir='$rkm_tgl_akhir' WHERE rkm_id='$rkm_id'";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	function rkm_delete($rkm_id_)
	{
		$sql = "DELETE FROM rkm_master WHERE rkm_id='$rkm_id_'";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	function rkm_tampil_filter($sespriode1, $sespriode2, $seskaryawan)
	{
		if (!empty($sespriode1) && !empty($sespriode2)) {
			if (!empty($seskaryawan)) {
				$filter_priode = " AND rkm_tgl BETWEEN '$sespriode1' AND '$sespriode2' ";
			} else {
				$filter_priode = " rkm_tgl BETWEEN '$sespriode1' AND '$sespriode2' ";
			}
		} else {
			$filter_priode = "";
		}

		if (!empty($seskaryawan)) {
			$filter_karyawan = "kar_id='$seskaryawan' ";
		} else {
			$filter_karyawan = "";
		}

		$sql = "SELECT * FROM rkm_master WHERE $filter_karyawan $filter_priode ORDER BY rkm_id DESC";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	function rkm_tampil_max()
	{
		$sql = "SELECT MAX(rkm_tgl) AS tgl_terakhir FROM rkm_master ORDER BY rkm_id DESC";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
}

class Cam_absen
{
	function cam_update_img($cam_img, $kar_id)
	{
		$sql = "UPDATE cam_absen SET cam_img='$cam_img' WHERE kar_id='$kar_id'";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	function cam_tampil_kar($kar_id)
	{
		$sql = "SELECT * FROM cam_absen WHERE kar_id='$kar_id' ORDER BY cam_id";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
}

class Rupiah
{
	function format_rupiah($angka)
	{
		$rupiah = number_format($angka, 2, ',', '.');
		return $rupiah;
	}
}

class Hitung
{
	function hitung_median($arr)
	{
		sort($arr);
		$count = count($arr);
		$middleval = floor(($count - 1) / 2);
		if ($count % 2) {
			$median = $arr[$middleval];
		} else {
			$low = $arr[$middleval];
			$high = $arr[$middleval + 1];
			$median = (($low + $high) / 2);
		}
		return $median;
	}
}
class Kwitansi
{
	function kwi_tampil($tgl_terakhir)
	{
		$sql = "SELECT * FROM kwi_master WHERE kwi_tgl='$tgl_terakhir' OR kwi_tgl='0000-00-00' ORDER BY kwi_id DESC";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	function kwi_update($kwi_id, $kwi_tgl, $kwi_wilayah, $kwi_pts, $kwi_program, $kwi_nomor, $kwi_kanit, $kwi_unit, $kwi_keterangan)
	{
		$sql = "UPDATE kwi_master SET kwi_tgl='$kwi_tgl',kwi_wilayah='$kwi_wilayah',kwi_pts='$kwi_pts',kwi_program='$kwi_program',kwi_nomor='$kwi_nomor',kwi_kanit='$kwi_kanit',kwi_unit='$kwi_unit',kwi_keterangan='$kwi_keterangan' WHERE kwi_id='$kwi_id'";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	function kwi_insert($kwi_tgl, $kwi_wilayah, $kwi_pts, $kwi_program, $kwi_nomor, $kwi_kanit, $kwi_unit, $kwi_keterangan, $kar_id)
	{
		$sql = "INSERT INTO kwi_master VALUES(NULL,'$kwi_tgl','$kwi_wilayah','$kwi_pts','$kwi_program','$kwi_nomor','$kwi_kanit','$kwi_unit','$kwi_keterangan','$kar_id')";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	function kwi_delete($kwi_id_)
	{
		$sql = "DELETE FROM kwi_master WHERE kwi_id='$kwi_id_'";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	function kwi_tampil_filter($sespriode1, $sespriode2, $sespts, $sesprogram, $seswilayah)
	{
		if (!empty($sespriode1) && !empty($sespriode2)) {
			if (!empty($sespts) || !empty($sesprogram) || !empty($seswilayah)) {
				$filter_priode = " AND kwi_tgl BETWEEN '$sespriode1' AND '$sespriode2' ";
			} else {
				$filter_priode = " kwi_tgl BETWEEN '$sespriode1' AND '$sespriode2' ";
			}
		} else {
			$filter_priode = "";
		}

		if (!empty($sespts)) {
			$filter_pts = "kwi_pts='$sespts' ";
		} else {
			$filter_pts = "";
		}

		if (!empty($sesprogram)) {
			if (!empty($sespts) || !empty($sespriode1) && !empty($sespriode2)) {
				$filter_program = " AND kwi_program='$sesprogram' ";
			} else {
				$filter_program = " kwi_program='$sesprogram' ";
			}
		} else {
			$filter_program = "";
		}

		if (!empty($seswilayah)) {
			if (!empty($sespts) || !empty($sesprogram) || !empty($sespriode1) && !empty($sespriode2)) {
				$filter_wilayah = " AND kwi_wilayah='$seswilayah' ";
			} else {
				$filter_wilayah = " kwi_wilayah='$seswilayah' ";
			}
		} else {
			$filter_wilayah = "";
		}

		$sql = "SELECT * FROM kwi_master WHERE $filter_pts  $filter_program  $filter_wilayah  $filter_priode ORDER BY kwi_id DESC";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	function kwi_tampil_max()
	{
		$sql = "SELECT MAX(kwi_tgl) AS tgl_terakhir FROM kwi_master ORDER BY kwi_nomor DESC";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
}
class Nota
{

	function nta_tampil($tgl_terakhir)
	{
		$sql = "SELECT * FROM nta_master WHERE nta_tgl='$tgl_terakhir' OR nta_tgl='0000-00-00' ORDER BY nta_nomor ASC";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	function nta_insert($nta_mhs, $nta_angkatan, $nta_jurusan, $nta_nomor, $nta_tgl, $nta_daftar, $nta_spb, $nta_spp, $nta_wilayah, $nta_pts, $nta_program, $nta_keterangan, $kar_id)
	{
		$sql = "INSERT INTO nta_master VALUES(NULL,'$nta_mhs','$nta_angkatan','$nta_jurusan','$nta_nomor','$nta_tgl','$nta_daftar','$nta_spb','$nta_spp','$nta_wilayah','$nta_pts','$nta_program','$nta_keterangan','$kar_id')";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	function nta_update($nta_id, $nta_mhs, $nta_angkatan, $nta_jurusan, $nta_nomor, $nta_tgl, $nta_daftar, $nta_spb, $nta_spp, $nta_wilayah, $nta_pts, $nta_program, $nta_keterangan)
	{
		$sql = "UPDATE nta_master SET nta_mhs='$nta_mhs',nta_angkatan='$nta_angkatan',nta_jurusan='$nta_jurusan',nta_nomor='$nta_nomor',nta_tgl='$nta_tgl',nta_daftar='$nta_daftar',nta_spb='$nta_spb',nta_spp='$nta_spp',nta_wilayah='$nta_wilayah',nta_pts='$nta_pts',nta_program='$nta_program',nta_keterangan='$nta_keterangan' WHERE nta_id='$nta_id'";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	function nta_delete($nta_id_)
	{
		$sql = "DELETE FROM nta_master WHERE nta_id='$nta_id_'";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	function nta_tampil_filter($sespriode1, $sespriode2, $sespts, $sesprogram, $seswilayah)
	{
		if (!empty($sespriode1) && !empty($sespriode2)) {
			if (!empty($sespts) || !empty($sesprogram) || !empty($seswilayah)) {
				$filter_priode = " AND nta_tgl BETWEEN '$sespriode1' AND '$sespriode2' ";
			} else {
				$filter_priode = " nta_tgl BETWEEN '$sespriode1' AND '$sespriode2' ";
			}
		} else {
			$filter_priode = "";
		}

		if (!empty($sespts)) {
			$filter_pts = "nta_pts='$sespts' ";
		} else {
			$filter_pts = "";
		}

		if (!empty($sesprogram)) {
			if (!empty($sespts) || !empty($sespriode1) && !empty($sespriode2)) {
				$filter_program = " AND nta_program='$sesprogram' ";
			} else {
				$filter_program = " nta_program='$sesprogram' ";
			}
		} else {
			$filter_program = "";
		}

		if (!empty($seswilayah)) {
			if (!empty($sespts) || !empty($sesprogram) || !empty($sespriode1) && !empty($sespriode2)) {
				$filter_wilayah = " AND nta_wilayah='$seswilayah' ";
			} else {
				$filter_wilayah = " nta_wilayah='$seswilayah' ";
			}
		} else {
			$filter_wilayah = "";
		}

		$sql = "SELECT * FROM nta_master WHERE $filter_pts  $filter_program  $filter_wilayah  $filter_priode ORDER BY nta_id DESC";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	function nta_tampil_max()
	{
		$sql = "SELECT MAX(nta_tgl) AS tgl_terakhir FROM nta_master ORDER BY nta_nomor DESC";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
}
class Typedomain
{
	function tdo_tampil()
	{
		$sql = "SELECT * FROM type_domain WHERE tdo_status='Y' ORDER BY tdo_id ASC";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	function tdo_tampil_id($tdo_id)
	{
		$sql = "SELECT * FROM type_domain WHERE tdo_status='Y' AND tdo_id='$tdo_id' ORDER BY tdo_id ASC";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
}
class Unlistdomain
{
	function udo_tampil()
	{
		$sql = "SELECT * FROM unlist_domain ORDER BY udo_id DESC";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	function udo_tampil_typ($tdo_id)
	{
		$sql = "SELECT * FROM unlist_domain WHERE tdo_id='$tdo_id' ORDER BY udo_id DESC";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	function udo_insert($arr_nama, $arr_username, $arr_password, $arr_server, $arr_ip, $arr_keterangan, $tdo_id, $kar_id)
	{
		$sql = "INSERT INTO unlist_domain VALUES(NULL,'$arr_nama','$arr_username','$arr_password','$arr_server','$arr_ip','$arr_keterangan','C','$tdo_id','$kar_id')";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	function udo_update($udo_id, $udo_nama, $udo_username, $udo_password, $udo_server, $udo_ip, $udo_keterangan, $kar_id)
	{
		$sql = "UPDATE unlist_domain SET udo_nama='$udo_nama',udo_username='$udo_username',udo_password='$udo_password',udo_server='$udo_server',udo_ip='$udo_ip',udo_keterangan='$udo_keterangan' WHERE udo_id='$udo_id'";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	function udo_delete($udo_id_)
	{
		$sql = "DELETE FROM unlist_domain WHERE udo_id='$udo_id_'";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
}
class Jadwal
{
	function jdw_insert($jdw_blnthn, $jdw_username, $jdw_nik, $jdw_nama, $jdw_divisi, $jdw_zona, $jdw_wilayah, $jdw_data)
	{
		$sql = "INSERT INTO jdw_master VALUES(NULL,'$jdw_blnthn','$jdw_username','$jdw_nik','$jdw_nama','$jdw_divisi','$jdw_zona','$jdw_wilayah','$jdw_data')";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	function jdw_tampil($jdw_blnthn, $jdw_zona)
	{
		$sql = "SELECT * FROM jdw_master WHERE jdw_blnthn='$jdw_blnthn' AND jdw_zona='$jdw_zona'";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	function jdw_tampil_jie($jdw_blnthn)
	{
		$sql = "SELECT * FROM jdw_master WHERE jdw_blnthn='$jdw_blnthn'";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	function jdw_tampil_nik($jdw_blnthn, $jdw_zona, $jdw_nik)
	{
		$sql = "SELECT * FROM jdw_master WHERE jdw_blnthn='$jdw_blnthn' AND jdw_zona='$jdw_zona' AND jdw_nik='$jdw_nik'";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	function jdw_tampil_username($jdw_blnthn, $jdw_username)
	{
		$sql = "SELECT * FROM jdw_master WHERE jdw_blnthn='$jdw_blnthn' AND jdw_nik='$jdw_username'";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	function jdw_tampil_username_tst($jdw_blnthn, $jdw_usernamenya)
	{
		$sql = "SELECT * FROM tst_jdw_master WHERE jdw_blnthn='$jdw_blnthn' AND jdw_nik='$jdw_usernamenya'";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	function jdw_tampil_REGEXP($jdw_blnthn, $jdw_zona, $jdw_nik, $kar_jdw_akses)
	{
		$sql = "SELECT * FROM jdw_master WHERE jdw_blnthn='$jdw_blnthn' AND jdw_zona='$jdw_zona' AND (jdw_nik='$jdw_nik' OR jdw_nik REGEXP '$kar_jdw_akses')";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	function jdw_delete($jdw_blnthn)
	{
		$sql = "DELETE FROM jdw_master WHERE jdw_blnthn='$jdw_blnthn'";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	function jdw_tampil_id($jdw_id)
	{
		$sql = "SELECT * FROM jdw_master WHERE jdw_id='$jdw_id'";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	function jdw_update($jdw_id, $jdw_data)
	{
		$sql = "UPDATE jdw_master SET jdw_data='$jdw_data' WHERE jdw_id='$jdw_id'";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	function jdw_aktif_blnthn()
	{
		$sql = "SELECT * FROM jdw_aktif WHERE jda_id='1' LIMIT 1";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	function jdw_aktif_mei2022()
	{
		$sql = "SELECT * FROM jdw_aktif WHERE jda_id='2' LIMIT 1";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	function jdw_aktif_update($jda_blnthn)
	{
		$sql = "UPDATE jdw_aktif SET jda_blnthn='$jda_blnthn' WHERE jda_id='1'";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	function jdw_rwd_tglmerah($jdw_blnthn, $divisi)
	{
		$sql = "SELECT jdw_nik,jdw_blnthn,jdw_data FROM jdw_master WHERE jdw_blnthn IN ('$jdw_blnthn') AND jdw_divisi='$divisi'";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
}

class Kpi
{
	function kpi_history_kar($kar_id)
	{
		$sql = "SELECT * FROM kpi_history WHERE kar_id='$kar_id' ORDER BY kph_id DESC";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	function kpi_history_kar_limit($kar_id)
	{
		$sql = "SELECT * FROM kpi_history WHERE kar_id='$kar_id' ORDER BY kph_id DESC LIMIT 1";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	function kpi_history_insert($kph_kontrak, $kph_kode, $kph_start, $kph_end, $kph_keterangan, $kph_masa, $kph_data, $kar_id)
	{
		$sql = "INSERT INTO kpi_history VALUES(NULL,'$kph_kontrak','$kph_kode','$kph_start','$kph_end','$kph_keterangan','$kph_masa','$kph_data','$kar_id')";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	function kpi_history_update($kph_id, $kph_kontrak, $kph_start, $kph_end, $kph_keterangan, $kph_masa, $kph_data)
	{
		$sql = "UPDATE kpi_history SET kph_kontrak='$kph_kontrak',kph_start='$kph_start',kph_end='$kph_end',kph_keterangan='$kph_keterangan',kph_masa='$kph_masa',kph_data='$kph_data' WHERE kph_id='$kph_id'";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	function kpi_history_delete($kph_id_)
	{
		$sql = "DELETE FROM kpi_history WHERE kph_id='$kph_id_'";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	function kpi_kd_awal($kdawal)
	{
		$sql = "SELECT MAX(kpi_id) AS max_kd FROM kpi_master WHERE kpi_kd LIKE '$kdawal%'";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	function kpi_kd_auto()
	{
		$sql = "SELECT MAX(kpi_id) AS max_kd_auto FROM kpi_master";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	function kpi_sasaran_div($kps_div)
	{
		$sql = "SELECT * FROM kpi_sasaran WHERE kps_div='$kps_div' ORDER BY kps_id";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	function kpi_point_jenis($kpb_jenis)
	{
		$sql = "SELECT * FROM kpi_point WHERE kpb_jenis='$kpb_jenis' ORDER BY kpb_id";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	function kpi_tampil_kar($kar_id)
	{
		$sql = "SELECT * FROM kpi_master WHERE kar_id='$kar_id' ORDER BY kpi_id";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	function kpi_insert($filed, $kpi_div, $kpi_kd, $kpi_jenis, $kpi_jenis4, $kpi_jenis5, $kpi_keterangan, $kpi_kontrak, $kpi_priode, $kpi_data, $kpi_reward, $kpi_reward_data, $kpi_lampiran, $kpi_penilai1, $kpi_penilai2, $kpi_penilai3, $kpi_penilai4, $kpi_sts, $kpi_sts4, $kpi_sts5, $kpi_sesi, $kar_id)
	{
		$sql = "INSERT INTO kpi_master ($filed) VALUES(NULL,'$kpi_div','$kpi_kd','$kpi_jenis','$kpi_jenis4','$kpi_jenis5','$kpi_keterangan','$kpi_kontrak','$kpi_priode','$kpi_data','$kpi_reward','$kpi_reward_data','$kpi_lampiran','$kpi_penilai1','$kpi_penilai2','$kpi_penilai3','$kpi_penilai4','$kpi_sts','$kpi_sts4','$kpi_sts5','$kpi_sesi',NOW(),'$kar_id')";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	function kpi_tampil_kode($kpi_kd)
	{
		$sql = "SELECT * FROM kpi_master WHERE md5(kpi_kd)='$kpi_kd' ORDER BY kpi_id";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	function kpi_sasaran_kode($kps_kd)
	{
		$sql = "SELECT * FROM kpi_sasaran WHERE kps_kd='$kps_kd' ORDER BY kps_id";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	function kpi_update($kpi_id, $kpi_tanggal, $kpi_data, $kpi_sts, $kpi_sts4, $kpi_sts5)
	{
		$sql = "UPDATE kpi_master SET kpi_tanggal='$kpi_tanggal',kpi_data='$kpi_data',kpi_sts='$kpi_sts',kpi_sts4='$kpi_sts4',kpi_sts5='$kpi_sts5' WHERE kpi_id='$kpi_id'";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	function kpi_update_2($kpi_id, $kpi_tanggal, $kpi_data, $kpi_skor, $kpi_sts_skor, $kpi_sts, $kpi_sts4, $kpi_sts5, $kpi_merekomendasikan5)
	{
		$sql = "UPDATE kpi_master SET kpi_tanggal='$kpi_tanggal',kpi_data='$kpi_data',kpi_skor='$kpi_skor',kpi_sts_skor='$kpi_sts_skor',kpi_sts='$kpi_sts',kpi_sts4='$kpi_sts4',kpi_sts5='$kpi_sts5',kpi_merekomendasikan5='$kpi_merekomendasikan5' WHERE kpi_id='$kpi_id'";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	function kpi_update_sts($kpi_id, $kpi_sts_reward, $kpi_skor, $kpi_sts_skor, $kpi_ditetapkan, $kpi_ditetapkan4, $kpi_saranperbaikan, $kpi_saranperbaika4, $kpi_sts, $kpi_sts4)
	{
		$sql = "UPDATE kpi_master SET kpi_sts_reward='$kpi_sts_reward',kpi_skor='$kpi_skor',kpi_sts_skor='$kpi_sts_skor',kpi_ditetapkan='$kpi_ditetapkan',kpi_ditetapkan4='$kpi_ditetapkan4',kpi_saranperbaikan='$kpi_saranperbaikan',kpi_saranperbaikan4='$kpi_saranperbaikan4',kpi_sts='$kpi_sts',kpi_sts4='$kpi_sts4' WHERE kpi_id='$kpi_id'";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	function kpi_tampil_id($kpi_id)
	{
		$sql = "SELECT * FROM kpi_master WHERE md5(kpi_kd)='$kpi_id' ORDER BY kpi_id";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	function kpi_cek_history($kpi_kontrak, $kar_id)
	{
		$sql = "SELECT * FROM `kpi_master` WHERE kpi_kontrak='$kpi_kontrak' AND kar_id='$kar_id' ORDER BY kpi_priode DESC LIMIT 1";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
}

class Reward
{
	function rwd_activity_cek($tb_rwd, $rwd_nik, $rwd_tanggal)
	{
		$sql = "SELECT * FROM $tb_rwd WHERE rwd_nik='$rwd_nik' AND rwd_tanggal='$rwd_tanggal' ORDER BY rwd_id ASC";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	function rwd_activity_insert($tb_rwd, $filed, $rwd_nik, $rwd_nm, $rwd_div, $rwd_jumlah, $rwd_jumlah1, $rwd_datatext1, $rwd_jumlah2, $rwd_datatext2, $rwd_jumlah3, $rwd_datatext3, $rwd_tanggal)
	{
		$sql = "INSERT INTO $tb_rwd ($filed) VALUES(NULL,'$rwd_nik','$rwd_nm','$rwd_div','$rwd_jumlah','$rwd_jumlah1','$rwd_datatext1','$rwd_jumlah2','$rwd_datatext2','$rwd_jumlah3','$rwd_datatext3','$rwd_tanggal')";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	function rwd_activity_update($tb_rwd, $rwd_nik, $rwd_jumlah, $rwd_jumlah1, $rwd_datatext1, $rwd_jumlah2, $rwd_datatext2, $rwd_jumlah3, $rwd_datatext3, $rwd_tanggal)
	{
		$sql = "UPDATE $tb_rwd SET rwd_jumlah='$rwd_jumlah',rwd_jumlah1='$rwd_jumlah1',rwd_datatext1='$rwd_datatext1',rwd_jumlah2='$rwd_jumlah2',rwd_datatext2='$rwd_datatext2',rwd_jumlah3='$rwd_jumlah3',rwd_datatext3='$rwd_datatext3' WHERE rwd_nik='$rwd_nik' AND rwd_tanggal='$rwd_tanggal'";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	function rwd_activity_insert_penagihan($tb_rwd, $filed, $rwd_nik, $rwd_nm, $rwd_div, $rwd_jumlah1, $rwd_datatext1, $rwd_tanggal)
	{
		$sql = "INSERT INTO $tb_rwd ($filed) VALUES(NULL,'$rwd_nik','$rwd_nm','$rwd_div','$rwd_jumlah1','$rwd_datatext1','$rwd_tanggal')";
		//echo $sql;
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	function rwd_activity_update_penagihan($tb_rwd, $rwd_nik, $rwd_jumlah1, $rwd_datatext1, $rwd_tanggal)
	{
		$sql = "UPDATE $tb_rwd SET rwd_jumlah1='$rwd_jumlah1',rwd_datatext1='$rwd_datatext1' WHERE rwd_nik='$rwd_nik' AND rwd_tanggal='$rwd_tanggal'";
		//echo $sql;
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	function rwd_activity_like($tb_rwd, $start, $end, $divisi)
	{
		//$sql="SELECT * FROM rwd_data WHERE rwd_tanggal BETWEEN '$start' AND '$end' ORDER BY rwd_nm ASC";
		$sql = "SELECT a.*, c.kar_dtl_typ_krj FROM $tb_rwd a LEFT JOIN kar_master b ON a.rwd_nik = b.kar_nik LEFT JOIN kar_detail c ON b.kar_id = c.kar_id WHERE a.rwd_div LIKE '%$divisi%' AND a.rwd_tanggal BETWEEN '$start' AND '$end' AND c.kar_dtl_typ_krj <> 'Resign' ORDER BY a.rwd_nm ASC";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	function rwd_activity_list($tb_rwd, $start, $end, $divisi)
	{
		//$sql="SELECT * FROM rwd_data WHERE rwd_tanggal BETWEEN '$start' AND '$end' ORDER BY rwd_nm ASC";
		$sql = "SELECT a.*, c.kar_dtl_typ_krj FROM $tb_rwd a LEFT JOIN kar_master b ON a.rwd_nik = b.kar_nik LEFT JOIN kar_detail c ON b.kar_id = c.kar_id WHERE a.rwd_div IN ('$divisi') AND a.rwd_tanggal BETWEEN '$start' AND '$end' AND c.kar_dtl_typ_krj <> 'Resign' ORDER BY a.rwd_nm ASC";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	function rwd_activity_last($tb_rwd, $start, $divisi)
	{
		//$sql="SELECT * FROM rwd_data WHERE rwd_tanggal BETWEEN '$start' AND '$end' ORDER BY rwd_nm ASC";
		$sql = "SELECT a.*, c.kar_dtl_typ_krj FROM $tb_rwd a LEFT JOIN kar_master b ON a.rwd_nik = b.kar_nik LEFT JOIN kar_detail c ON b.kar_id = c.kar_id WHERE a.rwd_nik='SG.0234.2015' AND a.rwd_div IN ('$divisi') AND a.rwd_tanggal < '$start' AND c.kar_dtl_typ_krj <> 'Resign' ORDER BY a.rwd_nm ASC";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	function rwd_last_list($tb_rwd_last, $rwd_bulan)
	{
		$sql = "SELECT * FROM $tb_rwd_last WHERE rwd_bulan='$rwd_bulan' ORDER BY rwd_id ASC";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}



	function rwd_activity_like_ms($tb_rwd, $start, $end, $divisi)
	{
		//$sql="SELECT * FROM rwd_data WHERE rwd_tanggal BETWEEN '$start' AND '$end' ORDER BY rwd_nm ASC";
		$sql = "SELECT a.*, c.kar_dtl_typ_krj FROM $tb_rwd a LEFT JOIN ms_kar_master b ON a.rwd_nik = b.kar_nik LEFT JOIN ms_kar_detail c ON b.kar_id = c.kar_id WHERE a.rwd_div LIKE '%$divisi%' AND a.rwd_tanggal BETWEEN '$start' AND '$end' AND c.kar_dtl_typ_krj <> 'Resign' ORDER BY a.rwd_nm ASC";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	function rwd_activity_list_ms($tb_rwd, $start, $end, $divisi)
	{
		//$sql="SELECT * FROM rwd_data WHERE rwd_tanggal BETWEEN '$start' AND '$end' ORDER BY rwd_nm ASC";
		$sql = "SELECT a.*, c.kar_dtl_typ_krj FROM $tb_rwd a LEFT JOIN ms_kar_master b ON a.rwd_nik = b.kar_nik LEFT JOIN ms_kar_detail c ON b.kar_id = c.kar_id WHERE a.rwd_div IN ('$divisi') AND a.rwd_tanggal BETWEEN '$start' AND '$end' AND c.kar_dtl_typ_krj <> 'Resign' ORDER BY a.rwd_nm ASC";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	function rwd_activity_last_ms($tb_rwd, $start, $divisi)
	{
		//$sql="SELECT * FROM rwd_data WHERE rwd_tanggal BETWEEN '$start' AND '$end' ORDER BY rwd_nm ASC";
		$sql = "SELECT a.*, c.kar_dtl_typ_krj FROM $tb_rwd a LEFT JOIN ms_kar_master b ON a.rwd_nik = b.kar_nik LEFT JOIN ms_kar_detail c ON b.kar_id = c.kar_id WHERE a.rwd_nik='SG.0234.2015' AND a.rwd_div IN ('$divisi') AND a.rwd_tanggal < '$start' AND c.kar_dtl_typ_krj <> 'Resign' ORDER BY a.rwd_nm ASC";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}


	function rwd_last_cek($tb_rwd_last, $rwd_nik, $rwd_bulan)
	{
		$sql = "SELECT * FROM $tb_rwd_last WHERE rwd_nik='$rwd_nik' AND rwd_bulan='$rwd_bulan' ORDER BY rwd_id ASC";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	function rwd_last_insert($tb_rwd_last, $filed, $rwd_nik, $rwd_nm, $rwd_div, $rwd_jumlah, $rwd_jumlah1, $rwd_datatext1, $rwd_jumlah2, $rwd_datatext2, $rwd_jumlah3, $rwd_datatext3, $rwd_bulan)
	{
		$sql = "INSERT INTO $tb_rwd_last ($filed) VALUES(NULL,'$rwd_nik','$rwd_nm','$rwd_div','$rwd_jumlah','$rwd_jumlah1','$rwd_datatext1','$rwd_jumlah2','$rwd_datatext2','$rwd_jumlah3','$rwd_datatext3','$rwd_bulan')";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	function rwd_last_update($tb_rwd_last, $rwd_nik, $rwd_jumlah, $rwd_jumlah1, $rwd_datatext1, $rwd_jumlah2, $rwd_datatext2, $rwd_jumlah3, $rwd_datatext3, $rwd_bulan)
	{
		$sql = "UPDATE $tb_rwd_last SET rwd_jumlah='$rwd_jumlah',rwd_jumlah1='$rwd_jumlah1',rwd_datatext1='$rwd_datatext1',rwd_jumlah2='$rwd_jumlah2',rwd_datatext2='$rwd_datatext2',rwd_jumlah3='$rwd_jumlah3',rwd_datatext3='$rwd_datatext3' WHERE rwd_nik='$rwd_nik' AND rwd_bulan='$rwd_bulan'";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	function rwd_summary_cek($tb_rwd, $rwd_nik, $rwd_tanggal)
	{
		$sql = "SELECT SUM(rwd_jumlah1) AS rwd_jumlah FROM $tb_rwd WHERE rwd_nik='$rwd_nik' AND rwd_tanggal='$rwd_tanggal' GROUP BY rwd_nik";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
}

class Freelance
{
	function kar_nik($kdawal)
	{
		$sql = "SELECT MAX(kar_nik) AS max_nik FROM fl_kar_master WHERE kar_nik LIKE '$kdawal%'";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	function kar_nik_auto()
	{
		$sql = "SELECT MAX(kar_id) AS max_nik_auto FROM fl_kar_master";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	function kar_tampil()
	{
		$sql = "SELECT * FROM 
			  fl_kar_master,
			  lvl_master,
			  div_master,
			  unt_master,
			  ktr_master
		 	  WHERE 
			  fl_kar_master.lvl_id=lvl_master.lvl_id AND
			  fl_kar_master.div_id=div_master.div_id AND
			  fl_kar_master.unt_id=unt_master.unt_id AND
			  fl_kar_master.ktr_id=ktr_master.ktr_id 
			  ORDER BY kar_id
			  ";
		$query = mysql_query($sql) or die(mysql_error());
		while ($row = mysql_fetch_array($query))
			$data[] = $row;
		return $data;
	}


	function kar_tampil_id_fl($kar_idfl)
	{
		$sql = "SELECT * FROM 
			  fl_kar_master,
			  lvl_master,
			  div_master,
			  unt_master,
			  ktr_master
		 	  WHERE 			  
			  fl_kar_master.lvl_id=lvl_master.lvl_id AND
			  fl_kar_master.div_id=div_master.div_id AND
			  fl_kar_master.unt_id=unt_master.unt_id AND
			  fl_kar_master.ktr_id=ktr_master.ktr_id AND
			  fl_kar_master.kar_id='$kar_idfl'
			  ORDER BY kar_id
			  ";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	function kar_tampil_detail($kar_id)
	{
		$sql = "SELECT * FROM fl_kar_detail WHERE kar_id='$kar_id' ORDER BY kar_id";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	function kar_tampil_sts($kar_dtl_sts_krj)
	{
		$sql = "SELECT * FROM fl_kar_master,fl_kar_detail WHERE fl_kar_master.kar_id=fl_kar_detail.kar_id AND fl_kar_detail.kar_dtl_sts_krj='$kar_dtl_sts_krj' AND fl_kar_detail.kar_dtl_sts_krj!='' ORDER BY fl_kar_master.kar_id";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	function kar_insert($kar_nik, $kar_nm, $kar_tgl_lahir, $div_id, $lvl_id, $unt_id, $ktr_id)
	{
		$sql = "INSERT INTO fl_kar_master VALUES(NULL,'$kar_nik','$kar_nm','$kar_tgl_lahir','F','$div_id','0','$lvl_id','$unt_id','$ktr_id','0',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL)";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	function kar_update($kar_id, $kar_nm, $kar_tgl_lahir, $div_id, $lvl_id, $unt_id, $ktr_id)
	{
		$sql = "UPDATE fl_kar_master SET kar_nm='$kar_nm',kar_tgl_lahir='$kar_tgl_lahir',jbt_id='0',lvl_id='$lvl_id',div_id='$div_id',unt_id='$unt_id',ktr_id='$ktr_id' WHERE kar_id='$kar_id'";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	function kar_update_employee($kar_dtl_sts_krj, $kar_dtl_typ_krj, $kar_dtl_tgl_joi, $kar_dtl_msa_krj, $kar_id)
	{
		$sql = "UPDATE fl_kar_detail SET kar_dtl_sts_krj='$kar_dtl_sts_krj',kar_dtl_typ_krj='$kar_dtl_typ_krj',kar_dtl_tgl_joi='$kar_dtl_tgl_joi',kar_dtl_msa_krj='$kar_dtl_msa_krj' WHERE kar_id='$kar_id'";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	function kar_insert_employee($kar_dtl_sts_krj, $kar_dtl_typ_krj, $kar_dtl_tgl_joi, $kar_dtl_msa_krj, $kar_id)
	{
		$sql = "INSERT INTO fl_kar_detail VALUES(NULL,'$kar_dtl_sts_krj','$kar_dtl_typ_krj','$kar_dtl_tgl_joi','$kar_dtl_msa_krj','','','','','','','','','','','','','','','','','','','','','','','$kar_id')";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	function kar_update_bio($kar_dtl_usa, $kar_dtl_gen, $kar_dtl_tmp_lhr, $kar_dtl_sts_nkh, $kar_dtl_jml_ank, $kar_dtl_tgn, $kar_id)
	{
		$sql = "UPDATE fl_kar_detail SET kar_dtl_usa='$kar_dtl_usa',kar_dtl_gen='$kar_dtl_gen',kar_dtl_tmp_lhr='$kar_dtl_tmp_lhr',kar_dtl_sts_nkh='$kar_dtl_sts_nkh',kar_dtl_jml_ank='$kar_dtl_jml_ank',kar_dtl_tgn='$kar_dtl_tgn' WHERE kar_id='$kar_id'";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	function kar_insert_bio($kar_dtl_usa, $kar_dtl_gen, $kar_dtl_tmp_lhr, $kar_dtl_sts_nkh, $kar_dtl_jml_ank, $kar_dtl_tgn, $kar_id)
	{
		$sql = "INSERT INTO fl_kar_detail VALUES(NULL,'','','','','$kar_dtl_usa','$kar_dtl_gen','$kar_dtl_tmp_lhr','$kar_dtl_sts_nkh','$kar_dtl_jml_ank','$kar_dtl_tgn','','','','','','','','','','','','','','','','','','$kar_id')";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	function kar_update_education($kar_dtl_pnd, $kar_dtl_jrs, $kar_dtl_unv_sch, $kar_dtl_sts_pnd, $kar_dtl_thn_lls, $kar_id)
	{
		$sql = "UPDATE fl_kar_detail SET kar_dtl_pnd='$kar_dtl_pnd',kar_dtl_jrs='$kar_dtl_jrs',kar_dtl_unv_sch='$kar_dtl_unv_sch',kar_dtl_sts_pnd='$kar_dtl_sts_pnd',kar_dtl_thn_lls='$kar_dtl_thn_lls' WHERE kar_id='$kar_id'";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	function kar_insert_education($kar_dtl_pnd, $kar_dtl_jrs, $kar_dtl_unv_sch, $kar_dtl_sts_pnd, $kar_dtl_thn_lls, $kar_id)
	{
		$sql = "INSERT INTO fl_kar_detail VALUES(NULL,'','','','','','','','','','','$kar_dtl_pnd','$kar_dtl_jrs','$kar_dtl_unv_sch','$kar_dtl_sts_pnd','$kar_dtl_thn_lls','','','','','','','','','','','','$kar_id')";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	function kar_update_card($kar_dtl_no_ktp, $kar_dtl_exp_ktp, $kar_dtl_no_kk, $kar_dtl_no_npw, $kar_dtl_no_kpj, $kar_dtl_no_rek, $kar_dtl_no_bpj, $kar_dtl_no_jms, $kar_id)
	{
		$sql = "UPDATE fl_kar_detail SET kar_dtl_no_ktp='$kar_dtl_no_ktp',kar_dtl_exp_ktp='$kar_dtl_exp_ktp',kar_dtl_no_kk='$kar_dtl_no_kk',kar_dtl_no_npw='$kar_dtl_no_npw',kar_dtl_no_kpj='$kar_dtl_no_kpj',kar_dtl_no_rek='$kar_dtl_no_rek',kar_dtl_no_bpj='$kar_dtl_no_bpj',kar_dtl_no_jms='$kar_dtl_no_jms' WHERE kar_id='$kar_id'";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	function kar_insert_card($kar_dtl_no_ktp, $kar_dtl_exp_ktp, $kar_dtl_no_kk, $kar_dtl_no_npw, $kar_dtl_no_kpj, $kar_dtl_no_rek, $kar_dtl_no_bpj, $kar_dtl_no_jms, $kar_id)
	{
		$sql = "INSERT INTO fl_kar_detail VALUES(NULL,'','','','','','','','','','','','','','','','$kar_dtl_no_ktp','$kar_dtl_exp_ktp','$kar_dtl_no_kk','$kar_dtl_no_npw','$kar_dtl_no_kpj','$kar_dtl_no_rek','$kar_dtl_no_bpj','$kar_dtl_no_jms','','','','$kar_id')";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	function kar_update_contact($kar_dtl_eml, $kar_dtl_tlp, $kar_dtl_alt,$kar_dtl_alt_dms, $kar_id)
	{
		$sql = "UPDATE fl_kar_detail SET kar_dtl_eml='$kar_dtl_eml',kar_dtl_tlp='$kar_dtl_tlp',kar_dtl_alt='$kar_dtl_alt',kar_dtl_alt_dms='$kar_dtl_alt_dms' WHERE kar_id='$kar_id'";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	function kar_insert_contact($kar_dtl_eml, $kar_dtl_tlp, $kar_dtl_alt,$kar_dtl_alt_dms, $kar_id)
	{
		$sql = "INSERT INTO fl_kar_detail VALUES(NULL,'','','','','','','','','','','','','','','','','','','','','','','','$kar_dtl_eml','$kar_dtl_tlp','$kar_dtl_alt','$kar_dtl_alt_dms','$kar_id')";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	function kar_delete($kar_id)
	{
		$sql = "DELETE FROM fl_kar_master WHERE kar_id='$kar_id'";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
}

class AccountFreelance
{
	function acc_tampil()
	{
		$sql = "SELECT * FROM 
			  fl_acc_master,
			  fl_kar_master
		 	  WHERE 
			  fl_acc_master.kar_id=fl_kar_master.kar_id
			  ORDER BY acc_id
			  ";
		$query = mysql_query($sql) or die(mysql_error());
		while ($row = mysql_fetch_array($query))
			$data[] = $row;
		return $data;
	}
	function acc_tampil_id($acc_id)
	{
		$sql = "SELECT * FROM 
			  fl_acc_master,
			  fl_kar_master
		 	  WHERE 
			  fl_acc_master.kar_id=fl_kar_master.kar_id AND
			  fl_acc_master.acc_id='$acc_id'
			  ORDER BY acc_id
			  ";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	function acc_tampil_username($acc_username)
	{
		$sql = "SELECT * FROM fl_acc_master WHERE acc_username='$acc_username' ORDER BY acc_id";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	function acc_insert($acc_username, $acc_password, $kar_id)
	{
		$sql = "INSERT INTO fl_acc_master VALUES(NULL,'$acc_username','$acc_password',md5('$acc_password'),'','','','','','$kar_id')";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	function acc_tampil_kar($kar_id)
	{
		$sql = "SELECT * FROM  
			  fl_acc_master,
			  fl_kar_master
			  WHERE 
			  fl_acc_master.kar_id=fl_kar_master.kar_id AND
			  fl_acc_master.kar_id='$kar_id' 
			  ORDER BY acc_id";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	function acc_tampil_karfl($kar_idfl)
	{
		$sql = "SELECT * FROM  
			  fl_acc_master,
			  fl_kar_master
			  WHERE 
			  fl_acc_master.kar_id=fl_kar_master.kar_id AND
			  fl_acc_master.kar_id='$kar_idfl' 
			  ORDER BY acc_id";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	function acc_delete($acc_id)
	{
		$sql = "DELETE FROM fl_acc_master WHERE acc_id='$acc_id'";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	function acc_img_update($acc_img, $kar_id)
	{
		$sql = "UPDATE fl_acc_master SET acc_img='$acc_img' WHERE kar_id='$kar_id'";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	function acc_pass_update($acc_password, $kar_id)
	{
		$sql = "UPDATE fl_acc_master SET acc_password='$acc_password', acc_md5=md5('$acc_password') WHERE kar_id='$kar_id'";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	function acc_signin($acc_username, $acc_password, $date, $time)
	{
		$result = mysql_query("SELECT * FROM fl_acc_master WHERE acc_username = '$acc_username' AND acc_password = '$acc_password' AND (acc_sts = 'A' OR acc_sts ='')");
		$acc_data = mysql_fetch_array($result);
		$cek_acc = mysql_num_rows($result);
		if ($cek_acc == 1) {
			$_SESSION['kar_fl'] = $acc_data['kar_id'];
			$sql = "UPDATE fl_acc_master SET acc_log_tgl='$date',acc_log_jam='$time' WHERE kar_id='$acc_data[kar_id]'";
			$query = mysql_query($sql) or die(mysql_error());
			return TRUE;
		} else {
			return FALSE;
		}
	}
	function acc_signout($kar_id, $date, $time)
	{
		$sql = "UPDATE fl_acc_master SET acc_log_tgl='$date',acc_log_jam='$time' WHERE kar_id='$kar_id'";
		$query = mysql_query($sql) or die(mysql_error());
		session_start();
		$_SESSION['kar_fl'] = '';
		session_unset();
		session_destroy();
		session_start();
		session_regenerate_id(true);
		return TRUE;
	}
	function acc_update_sts($acc_id, $acc_sts)
	{
		$sql = "UPDATE fl_acc_master SET acc_sts='$acc_sts' WHERE acc_id='$acc_id'";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
}

class AbsenFreelance
{
	function abs_masuk($abs_masuk, $abs_ip, $abs_tgl_masuk, $abs_shift, $abs_rwd_masuk, $abs_point, $kar_id)
	{
		$sql = "INSERT INTO fl_abs_master VALUES(NULL,'$abs_masuk','','$abs_ip','$abs_tgl_masuk','','','','M','$abs_shift','$abs_rwd_masuk','','$abs_point','$kar_id')";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	function abs_masuk_telat($abs_masuk, $abs_ip, $abs_tgl_masuk, $abs_alasan_masuk, $abs_shift, $abs_rwd_masuk, $abs_point, $kar_id)
	{
		$sql = "INSERT INTO fl_abs_master VALUES(NULL,'$abs_masuk','','$abs_ip','$abs_tgl_masuk','','$abs_alasan_masuk','','M','$abs_shift','$abs_rwd_masuk','','$abs_point','$kar_id')";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	function abs_pulang($abs_pulang, $abs_ip, $abs_tgl_pulang, $abs_rwd_pulang, $abs_point, $kar_id, $abs_tgl_masuk)
	{
		$sql = "UPDATE fl_abs_master SET abs_pulang='$abs_pulang',abs_sts='P',abs_tgl_pulang='$abs_tgl_pulang',abs_rwd_pulang='$abs_rwd_pulang',abs_point='$abs_point',abs_ip='$abs_ip' WHERE kar_id='$kar_id' AND abs_tgl_masuk='$abs_tgl_masuk'";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	function abs_pulang_cepat($abs_pulang, $abs_ip, $abs_tgl_pulang, $abs_alasan_pulang, $abs_rwd_pulang, $abs_point, $kar_id, $abs_tgl_masuk)
	{
		$sql = "UPDATE fl_abs_master SET abs_pulang='$abs_pulang',abs_alasan_pulang='$abs_alasan_pulang',abs_sts='P',abs_tgl_pulang='$abs_tgl_pulang',abs_rwd_pulang='$abs_rwd_pulang',abs_point='$abs_point',abs_ip='$abs_ip' WHERE kar_id='$kar_id' AND abs_tgl_masuk='$abs_tgl_masuk'";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	function abs_tampil_kar_location($kar_id_, $date)
	{
		$sql = "SELECT * FROM fl_abs_master WHERE kar_id='$kar_id_' AND abs_tgl_masuk='$date' ORDER BY abs_id";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	function abs_tampil_kar_location_array($date)
	{
		$sql = "SELECT * FROM fl_abs_master WHERE abs_tgl_masuk='$date' ORDER BY abs_id";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	function abs_tampil_kar($kar_id, $abs_tgl_masuk)
	{
		$sql = "SELECT * FROM fl_abs_master WHERE kar_id='$kar_id' AND abs_tgl_masuk='$abs_tgl_masuk' ORDER BY abs_id";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	function abs_tampil_kar_2($kar_id, $abs_tgl_start, $abs_tgl_end)
	{
		$sql = "SELECT * FROM fl_abs_master WHERE kar_id='$kar_id' AND abs_tgl_masuk BETWEEN '$abs_tgl_start' AND '$abs_tgl_end' ORDER BY abs_id";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	function abs_tampil_allkar_2($div_id, $abs_tgl_start, $abs_tgl_end)
	{
		$sql = "SELECT * FROM fl_abs_master AS A,fl_kar_master AS B WHERE A.kar_id=B.kar_id AND A.abs_tgl_masuk BETWEEN '$abs_tgl_start' AND '$abs_tgl_end' AND B.div_id='$div_id' ORDER BY abs_id";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	function abs_tampil_las($kar_id, $abs_tgl_las)
	{
		$sql = "SELECT * FROM fl_abs_master WHERE kar_id='$kar_id' AND abs_tgl_masuk='$abs_tgl_las' ORDER BY abs_id";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	function abs_tampil_tgl($abs_tgl_masuk)
	{
		$sql = "SELECT * FROM fl_abs_master WHERE abs_tgl_masuk='$abs_tgl_masuk' ORDER BY abs_id DESC";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	function abs_tampil_tgl_masuk($abs_tgl_masuk)
	{
		$sql = "SELECT * FROM fl_abs_master WHERE abs_tgl_masuk='$abs_tgl_masuk' AND abs_sts='M' ORDER BY abs_id";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	function abs_tampil_tgl_pulang($abs_tgl_masuk)
	{
		$sql = "SELECT * FROM fl_abs_master WHERE abs_tgl_masuk='$abs_tgl_masuk' AND abs_sts='P' ORDER BY abs_id";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	function abs_tampil()
	{
		$sql = "SELECT * FROM fl_abs_master ORDER BY abs_id";
		$query = mysql_query($sql) or die(mysql_error());
		while ($row = mysql_fetch_array($query))
			$data[] = $row;
		return $data;
	}
	function abs_ip_konfirm($abs_id, $abs_ip)
	{
		$sql = "UPDATE fl_abs_master SET abs_ip='$abs_ip' WHERE abs_id='$abs_id'";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	function abs_tampil_acc($kar_id)
	{
		$sql = "SELECT * FROM fl_abs_master WHERE kar_id='$kar_id' ORDER BY abs_id DESC LIMIT 0,7";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	function abs_tampil_rwd($abs_rwd_masuk, $abs_tgl_masuk)
	{
		$sql = "SELECT * FROM fl_abs_master WHERE abs_rwd_masuk='$abs_rwd_masuk' AND abs_tgl_masuk='$abs_tgl_masuk' ORDER BY abs_id";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	function abs_dtl_tampil($kar_id_, $abs_dtl_tgl)
	{
		$sql = "SELECT * FROM fl_abs_detail WHERE kar_id='$kar_id_' AND abs_dtl_tgl='$abs_dtl_tgl' ORDER BY abs_dtl_id";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	function abs_dtl_kar_id_($kar_id_, $abs_dtl_tgl)
	{
		$sql = "SELECT kar_id FROM fl_abs_detail WHERE kar_id='$kar_id_' AND abs_dtl_tgl='$abs_dtl_tgl' ORDER BY abs_dtl_id ASC LIMIT 1";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	function abs_dtl_tampil_array($abs_dtl_tgl)
	{
		$sql = "SELECT * FROM fl_abs_detail WHERE abs_dtl_tgl='$abs_dtl_tgl' ORDER BY abs_dtl_id";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	function abs_dtl_insert($abs_dtl_tgl, $abs_dtl_sts, $kar_id)
	{
		$sql = "INSERT INTO fl_abs_detail VALUES(NULL,'$abs_dtl_tgl','$abs_dtl_sts','$kar_id')";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	function abs_dtl_update($abs_dtl_tgl, $abs_dtl_sts, $kar_id)
	{
		$sql = "UPDATE fl_abs_detail SET abs_dtl_sts='$abs_dtl_sts' WHERE abs_dtl_tgl='$abs_dtl_tgl' AND kar_id='$kar_id'";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	function abs_dtl_tampil_sts($abs_dtl_sts, $abs_dtl_tgl)
	{
		$sql = "SELECT * FROM fl_abs_detail WHERE abs_dtl_tgl='$abs_dtl_tgl' AND abs_dtl_sts='$abs_dtl_sts' ORDER BY abs_dtl_id";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	function abs_settime_id($abs_stm_nm)
	{
		$sql = "SELECT * FROM abs_settime WHERE abs_stm_nm='$abs_stm_nm' ORDER BY abs_stm_id";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	function abs_stm_update($abs_stm_jam, $abs_stm_id)
	{
		$sql = "UPDATE abs_settime SET abs_stm_jam='$abs_stm_jam' WHERE abs_stm_id='$abs_stm_id'";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	function abs_sort_tgl($tgl_awal, $tgl_akhir)
	{
		$sql = "SELECT * FROM fl_abs_master WHERE abs_tgl_masuk BETWEEN '$tgl_awal' AND '$tgl_akhir' ORDER BY abs_id";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	function abs_dtl_sort_tgl($kar_id_, $tgl_awal, $tgl_akhir)
	{
		$sql = "SELECT * FROM fl_abs_detail WHERE kar_id='$kar_id_' AND abs_dtl_tgl BETWEEN '$tgl_awal' AND '$tgl_akhir' ORDER BY abs_dtl_id";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	function abs_tampil_rwd_sort($abs_rwd_masuk, $tgl_awal, $tgl_akhir)
	{
		$sql = "SELECT * FROM fl_abs_master WHERE abs_rwd_masuk='$abs_rwd_masuk' AND abs_tgl_masuk BETWEEN '$tgl_awal' AND '$tgl_akhir' ORDER BY abs_id";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	function abs_dtl_tampil_sts_sort($abs_dtl_sts, $tgl_awal, $tgl_akhir)
	{
		$sql = "SELECT * FROM fl_abs_detail WHERE abs_dtl_sts='$abs_dtl_sts' AND abs_dtl_tgl BETWEEN '$tgl_awal' AND '$tgl_akhir'  ORDER BY abs_dtl_id";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	function abs_point_update($abs_id, $abs_point)
	{
		$sql = "UPDATE fl_abs_master SET abs_point='$abs_point' WHERE abs_id='$abs_id'";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	function abs_tgl_rpt()
	{
		$sql = "SELECT * FROM abs_tanggal ORDER BY abs_tgl_id";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	function abs_tgl_rpt_bln($kar_id_, $tgl_1, $tgl_31)
	{
		$sql = "SELECT * FROM fl_abs_master WHERE kar_id='$kar_id_' AND abs_tgl_masuk BETWEEN '$tgl_1' AND '$tgl_31' ORDER BY abs_id";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	function abs_tgl_rpt_point($kar_id_, $tgl_1, $tgl_31)
	{
		$sql = "SELECT SUM(abs_point) AS point FROM fl_abs_master WHERE kar_id='$kar_id_' AND abs_point!='0' AND abs_tgl_masuk BETWEEN '$tgl_1' AND '$tgl_31' ORDER BY abs_id";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	function abs_tgl_rpt_bln_array($tgl_1, $tgl_31)
	{
		$sql = "SELECT COUNT(DISTINCT abs_tgl_masuk) AS num_rows,kar_id FROM `fl_abs_master` WHERE abs_tgl_masuk BETWEEN '$tgl_1' AND '$tgl_31' GROUP BY kar_id";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	function abs_tgl_rpt_point_array($tgl_1, $tgl_31)
	{
		$sql = "SELECT COUNT(DISTINCT abs_tgl_masuk) AS num_rows, SUM(abs_point) AS point,kar_id FROM fl_abs_master WHERE abs_point!='0' AND abs_tgl_masuk BETWEEN '$tgl_1' AND '$tgl_31' GROUP BY kar_id";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	function abs_masuk_update($edt_abs_masuk, $edt_abs_id)
	{
		$sql = "UPDATE fl_abs_master SET abs_masuk='$edt_abs_masuk' WHERE abs_id='$edt_abs_id'";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
}

////////////ntf_cuti/////////////////////////////////////////////////////////
class cuti
{

	function cuti_ntf_data_insert($ntf_data_act, $ntf_data_isi, $ntf_data_url, $ntf_data_ip, $ntf_data_tgl, $ntf_data_jam, $ntf_data_tujuan, $ntf_data_sumber)
	{
		$sql = "INSERT INTO cuti_ntf VALUES(NULL,'$ntf_data_act','$ntf_data_isi','$ntf_data_url','$ntf_data_ip','$ntf_data_tgl','$ntf_data_jam','$ntf_data_tujuan','$ntf_data_sumber','')";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}

	function cuti_ntf_data_update_read($ntf_data_id, $ntf_data_read)
	{
		$sql = "UPDATE cuti_ntf SET ntf_data_read='$ntf_data_read' WHERE ntf_data_id='$ntf_data_id'";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}

	function cuti_ntf_data_cek($ntf_data_act, $ntf_data_isi, $ntf_data_url, $ntf_data_tujuan, $ntf_data_sumber)
	{
		$sql = "SELECT * FROM cuti_ntf WHERE ntf_data_act='$ntf_data_act' AND ntf_data_isi='$ntf_data_isi'  AND ntf_data_url='$ntf_data_url' AND ntf_data_tujuan='$ntf_data_tujuan' AND ntf_data_sumber='$ntf_data_sumber' ORDER BY ntf_data_id DESC ";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}

	function cuti_ntf_data_tampil($ntf_data_tujuan)
	{
		$sql = "SELECT * FROM cuti_ntf WHERE ntf_data_tujuan='$ntf_data_tujuan' OR ntf_data_tujuan='ALL' ORDER BY ntf_data_id DESC ";
		$query = mysql_query($sql) or die(mysql_error());
		while ($row = mysql_fetch_array($query))
			$data[] = $row;
		return $data;
	}



	function cuti_ntf_data_tampil_read($ntf_data_id, $ntf_data_read)
	{
		$sql = "SELECT * FROM cuti_ntf WHERE (ntf_data_tujuan='$ntf_data_read' OR ntf_data_tujuan='ALL') AND ntf_data_id='$ntf_data_id' AND ntf_data_read LIKE '%$ntf_data_read%' ORDER BY ntf_data_id DESC";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}

	function cuti_ntf_data_tampil_all($ntf_data_tujuan)
	{
		$sql = "SELECT * FROM cuti_ntf  ORDER BY ntf_data_id DESC ";
		$query = mysql_query($sql) or die(mysql_error());
		while ($row = mysql_fetch_array($query))
			$data[] = $row;
		return $data;
	}

	function cuti_ntf_data_tampil_read_all($ntf_data_id, $ntf_data_read)
	{
		$sql = "SELECT * FROM cuti_ntf ORDER BY ntf_data_id DESC";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}



	function cuti_ntf_data_sts_read_all($kar_id)
	{
		$sql = "SELECT * FROM cuti_ntf WHERE ntf_data_read = '' ORDER BY ntf_data_id DESC ";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}

	function cuti_ntf_data_sts_read($kar_id)
	{
		$sql = "SELECT * FROM cuti_ntf WHERE (ntf_data_tujuan='$kar_id' OR ntf_data_tujuan='ALL') AND ntf_data_read NOT LIKE '%$kar_id%' ORDER BY ntf_data_id DESC ";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	function cuti_ntf_data_tampil_kd($page, $ntf_data_url, $ntf_data_tujuan)
	{
		$sql = "SELECT * FROM cuti_ntf WHERE ntf_data_url LIKE '%$ntf_data_url%' AND ntf_data_url LIKE '%$page%' AND ntf_data_tujuan LIKE '%$ntf_data_tujuan%' ORDER BY ntf_data_id DESC LIMIT 1";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}

	function cuti_ntf_data_tampil_limit($ntf_data_tujuan)
	{
		$sql = "SELECT * FROM cuti_ntf WHERE ntf_data_tujuan='$ntf_data_tujuan' OR ntf_data_tujuan='ALL' ORDER BY ntf_data_id DESC LIMIT 6";
		$query = mysql_query($sql) or die(mysql_error());
		while ($row = mysql_fetch_array($query))
			$data[] = $row;
		return $data;
	}
}

///////////////////////////////////////////////////////////////////////////////////////////////////////////////////

class WorkFromHome
{
	function wfh_aktifitas($div_id)
	{
		if ($div_id) {
			$sql = "SELECT * FROM wfh_master WHERE wfh_id > 1 AND (FIND_IN_SET('$div_id', wfh_divisi) OR wfh_divisi IS NULL OR wfh_divisi = '') ORDER BY wfh_aktifitas ASC";
		} else {
			$sql = "SELECT * FROM wfh_master WHERE wfh_id > 1 ORDER BY wfh_aktifitas ASC";
		}
		$query = mysql_query($sql) or die(mysql_error());
		while ($row = mysql_fetch_array($query))
			$data[] = $row;
		return $data;
	}
	function wfh_aktifitas_id($wfh_id)
	{
		$sql = "SELECT * FROM wfh_master WHERE wfh_id = '$wfh_id' ORDER BY wfh_id ASC LIMIT 1";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	function wfh_data_cek($wfd_nomor, $wfd_aktifitas, $wfd_aksi)
	{
		$sql = "SELECT * FROM wfh_data WHERE wfd_nomor = '$wfd_nomor' AND wfd_aktifitas = '$wfd_aktifitas' AND wfd_aksi = '$wfd_aksi' ORDER BY wfd_id ASC LIMIT 1";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	function wfh_data_insert($wfd_tanggal, $wfd_key, $wfd_nomor, $wfd_username, $wfd_nama, $wfd_divisi, $wfd_start, $wfd_end, $wfd_aksi, $wfd_satuan, $wfd_value, $wfd_aktifitas, $wfd_lokasi, $wfd_keterangan, $wfd_status, $wfh_id, $wft_start, $wft_end, $wft_value, $kar_id)
	{
		$sql = "INSERT INTO wfh_data VALUES(NULL,'$wfd_tanggal','$wfd_key','$wfd_nomor','$wfd_username','$wfd_nama','$wfd_divisi','$wfd_start','$wfd_end','$wfd_aksi','$wfd_satuan','$wfd_value','$wfd_aktifitas','$wfd_lokasi','$wfd_keterangan',NOW(),'N','$wfd_status','$wfh_id','$wft_start','$wft_end','$wft_value','$kar_id')";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	function wfh_target_id($wfh_id)
	{
		$sql = "SELECT * FROM wfh_target WHERE wfh_id = '$wfh_id' ORDER BY wft_id ASC LIMIT 1";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	function wfh_data_distict($wfd_tanggal, $kar_id)
	{
		if ($kar_id == "all") {
			//$sql="SELECT COUNT(DISTINCT wfd_id) AS wfd_count,wfd_nomor,wfd_nama,wfd_lock,kar_id FROM wfh_data WHERE wfd_tanggal = '$wfd_tanggal' GROUP BY wfd_nomor ORDER BY wfd_nomor ASC";
			$sql = "SELECT r.wfd_count,t.wfd_nomor, t.wfd_nama, t.wfd_lock, r.wfd_datetime, t.kar_id
				FROM (
				      SELECT COUNT(DISTINCT wfd_id) AS wfd_count, wfd_nomor, MAX(wfd_createdate) AS wfd_datetime
				      FROM wfh_data
				      GROUP BY wfd_nomor
				) r
				INNER JOIN wfh_data t
				ON t.wfd_nomor = r.wfd_nomor AND t.wfd_createdate = r.wfd_datetime AND t.wfd_tanggal = '$wfd_tanggal'";
		} else {
			//$sql="SELECT COUNT(DISTINCT wfd_id) AS wfd_count,wfd_nomor,wfd_nama,wfd_lock,kar_id FROM wfh_data WHERE wfd_tanggal = '$wfd_tanggal' AND wfd_username IN ('$kar_id') GROUP BY wfd_nomor ORDER BY wfd_nomor ASC";
			$sql = "SELECT r.wfd_count,t.wfd_nomor, t.wfd_nama, t.wfd_lock, r.wfd_datetime, t.kar_id
				FROM (
				      SELECT COUNT(DISTINCT wfd_id) AS wfd_count, wfd_nomor, MAX(wfd_createdate) AS wfd_datetime
				      FROM wfh_data
				      GROUP BY wfd_nomor
				) r
				INNER JOIN wfh_data t
				ON t.wfd_nomor = r.wfd_nomor AND t.wfd_createdate = r.wfd_datetime AND t.wfd_tanggal = '$wfd_tanggal' AND t.wfd_username IN ('$kar_id')";
		}
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	function wfh_aktifitas_key($wfd_key)
	{
		$sql = "SELECT * FROM wfh_data WHERE wfd_key = '$wfd_key' ORDER BY wfd_id ASC LIMIT 1";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	function wfh_tampil_aktifitas($wfd_key)
	{
		$sql = "SELECT a.*,b.wfh_group FROM 
			  wfh_data a,
			  wfh_master b
		 	  WHERE 
			  a.wfh_id=b.wfh_id AND
			  a.wfd_key='$wfd_key'
			  ORDER BY wfh_group ASC, wfd_aktifitas ASC
			  ";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	function wfh_data_lock($wfd_key, $wfd_lock)
	{
		$sql = "UPDATE wfh_data SET wfd_lock='$wfd_lock' WHERE wfd_key='$wfd_key'";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	function wfh_data_delete($wfd_key)
	{
		$sql = "DELETE FROM wfh_data WHERE wfd_key='$wfd_key'";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	function wfh_data_delete_id($wfd_id)
	{
		$sql = "DELETE FROM wfh_data WHERE wfd_id='$wfd_id'";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	function wfh_status_report()
	{
		$sql = "SELECT a.kar_id,a.kar_nik, a.kar_nm, c.div_nm FROM 
			  kar_master a,
			  lvl_master b,
			  div_master c,
			  kar_detail d
		 	  WHERE 
			  a.lvl_id=b.lvl_id AND
			  a.div_id=c.div_id AND
			  c.div_nm <> 'Komisaris' AND
			  c.div_nm <> 'Komite' AND
			  c.div_nm <> 'Direksi' AND
			  b.lvl_nm <> 'Komisaris' AND
			  b.lvl_nm <> 'Komite' AND
			  b.lvl_nm <> 'Direksi' AND
			  a.kar_id=d.kar_id AND
			  d.kar_dtl_typ_krj <> 'Resign'
			  ORDER BY a.kar_id
			  ";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	function wfh_aktifitas_last($wfd_tanggal, $kar_id)
	{
		$sql = "SELECT t.wfd_nomor, t.wfd_nama, t.wfd_lock, r.wfd_datetime, t.kar_id
				FROM (
				      SELECT wfd_nomor, MAX(wfd_createdate) AS wfd_datetime
				      FROM wfh_data
				      GROUP BY wfd_nomor
				) r
				INNER JOIN wfh_data t
				ON t.wfd_nomor = r.wfd_nomor AND t.wfd_createdate = r.wfd_datetime AND t.wfd_tanggal = '$wfd_tanggal' AND t.kar_id='$kar_id'";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	function wfh_aktifitas_last_username($wfd_tanggal, $wfd_username)
	{
		$sql = "SELECT t.wfd_nomor, t.wfd_nama, t.wfd_lock, r.wfd_datetime, t.kar_id
				FROM (
				      SELECT wfd_nomor, MAX(wfd_createdate) AS wfd_datetime
				      FROM wfh_data
				      GROUP BY wfd_nomor
				) r
				INNER JOIN wfh_data t
				ON t.wfd_nomor = r.wfd_nomor AND t.wfd_createdate = r.wfd_datetime AND t.wfd_tanggal = '$wfd_tanggal' AND t.wfd_username='$wfd_username'";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	function wfh_activity_insert($wfa_username, $wfa_nama, $wfa_nomor, $wfa_data, $wfa_lock, $wfa_tanggal, $kar_id)
	{
		$sql = "INSERT INTO wfh_activity VALUES(NULL,'$wfa_username','$wfa_nama','$wfa_nomor','$wfa_data','$wfa_lock','$wfa_tanggal','$kar_id')";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	function wfh_activity_update($wfa_data, $wfa_lock, $kar_id, $wfa_tanggal)
	{
		$sql = "UPDATE wfh_activity SET wfa_data='$wfa_data',wfa_lock='$wfa_lock' WHERE kar_id='$kar_id' AND wfa_tanggal='$wfa_tanggal'";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	function wfh_activity_cek($kar_id, $wfa_tanggal)
	{
		$sql = "SELECT wfa_id FROM wfh_activity WHERE kar_id='$kar_id' AND wfa_tanggal='$wfa_tanggal' ORDER BY wfa_id ASC LIMIT 1";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	function wfh_activity_rekap($wfd_tanggal, $kar_id)
	{
		$sql = "SELECT r.wfd_count,t.wfd_nomor, t.wfd_username, t.wfd_nama, t.wfd_lock, r.wfd_datetime, t.kar_id
				FROM (
				      SELECT COUNT(DISTINCT wfd_id) AS wfd_count, wfd_nomor, MAX(wfd_createdate) AS wfd_datetime
				      FROM wfh_data
				      GROUP BY wfd_nomor
				) r
				INNER JOIN wfh_data t
				ON t.wfd_nomor = r.wfd_nomor AND t.wfd_createdate = r.wfd_datetime AND t.wfd_tanggal = '$wfd_tanggal' AND t.kar_id='$kar_id'";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	function wfh_karyawan()
	{
		$sql = "SELECT a.kar_id,a.kar_nik, a.kar_nm, c.div_nm FROM 
			  kar_master a,
			  lvl_master b,
			  div_master c,
			  kar_detail d
		 	  WHERE 
			  a.lvl_id=b.lvl_id AND
			  a.div_id=c.div_id AND
			  c.div_nm <> 'Komisaris' AND
			  c.div_nm <> 'Komite' AND
			  c.div_nm <> 'Direksi' AND
			  b.lvl_nm <> 'Komisaris' AND
			  b.lvl_nm <> 'Komite' AND
			  b.lvl_nm <> 'Direksi' AND
			  a.kar_id=d.kar_id AND
			  d.kar_dtl_typ_krj <> 'Resign'
			  ORDER BY a.kar_id
			  ";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	function wfh_karyawan_divisi($div_id)
	{
		$sql = "SELECT a.kar_id,a.kar_nik, a.kar_nm, c.div_nm FROM 
			  kar_master a,
			  lvl_master b,
			  div_master c,
			  kar_detail d
		 	  WHERE 
			  a.lvl_id=b.lvl_id AND
			  a.div_id=c.div_id AND
			  c.div_nm <> 'Komisaris' AND
			  c.div_nm <> 'Komite' AND
			  c.div_nm <> 'Direksi' AND
			  b.lvl_nm <> 'Komisaris' AND
			  b.lvl_nm <> 'Komite' AND
			  b.lvl_nm <> 'Direksi' AND
			  a.kar_id=d.kar_id AND
			  a.div_id='$div_id' AND
			  d.kar_dtl_typ_krj <> 'Resign'
			  ORDER BY a.kar_nm
			  ";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	function wfh_div_tampil()
	{
		$sql = "SELECT * FROM div_master WHERE div_id > 3 ORDER BY div_nm";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	function wfh_div_tampil_id($div_id)
	{
		$sql = "SELECT * FROM div_master WHERE div_id > 3 AND div_id = '$div_id' ORDER BY div_nm";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	function wfh_activity_monthly($wfh_username, $r_awal_ori, $r_sekarang_ori)
	{
		$sql = "SELECT * FROM wfh_activity WHERE wfa_username IN('$wfh_username') AND wfa_tanggal BETWEEN '$r_awal_ori' AND '$r_sekarang_ori' GROUP BY wfa_username,wfa_tanggal ORDER BY wfa_tanggal DESC";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
}

class Absen_menanam
{
	function abm_menaman_karyawan($abm_date)
	{
		$sql = "SELECT a.*, c.div_nm FROM 
			  abs_menanam a,
			  kar_master b,
			  div_master c
		 	  WHERE 
			  a.kar_id=b.kar_id AND
			  b.div_id=c.div_id AND
			  a.abm_date = '$abm_date'
			  ORDER BY a.abm_nm
			  ";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
}

///////////////////////////////////////////////////////////
class Mutasi
{

	function mts_tampil_kar($kar_id)
	{
		$sql = "SELECT * FROM mts_master WHERE kar_id='$kar_id' ORDER BY fpk_id";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	function mts_tampil_thn($kar_id_, $thn__)
	{
		$sql = "SELECT * FROM mts_master WHERE kar_id='$kar_id_' AND fpk_tgl LIKE '%$thn__%' ORDER BY fpk_id";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}

	function mts_kd_awal($kdawal)
	{
		$sql = "SELECT MAX(fpk_id) AS max_kd FROM mts_master WHERE fpk_kd LIKE '$kdawal%'";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	function mts_kd_auto()
	{
		$sql = "SELECT MAX(fpk_id) AS max_kd_auto FROM mts_master";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}

	function mts_tampil_id($fpk_kd)
	{
		$sql = "SELECT * FROM mts_master WHERE md5(fpk_kd)='$fpk_kd' ORDER BY fpk_id";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}

	function mts_update_sts($fpk_id, $fpk_ditetapkan, $fpk_sts)
	{
		$sql = "UPDATE mts_master SET fpk_ditetapkan='$fpk_ditetapkan',fpk_sts='$fpk_sts' WHERE fpk_id='$fpk_id'";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	function mts_update_konfirm($fpk_id, $fpk_konfirm)
	{
		$sql = "UPDATE mts_master SET fpk_konfirm='$fpk_konfirm' WHERE fpk_id='$fpk_id'";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	function mts_konfirm_user($fpk_id, $kar_id)
	{
		$sql = "SELECT * FROM mts_master WHERE md5(fpk_kd)='$fpk_id' AND fpk_konfirm LIKE '%$kar_id%'";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}



	function mts_delete($fpk_id)
	{
		$sql = "DELETE FROM mts_master  WHERE md5(fpk_kd)='$fpk_id' ";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
}

///////////////////////////////////////////////////////////


class Marketing_support
{
	function ms_nik($kdawal)
	{
		$sql = "SELECT MAX(kar_nik) AS max_nik FROM ms_kar_master WHERE kar_nik LIKE '$kdawal%'";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	function ms_nik_auto()
	{
		$sql = "SELECT MAX(kar_id) AS max_nik_auto FROM ms_kar_master";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	function ms_tampil()
	{
		$sql = "SELECT * FROM 
			  ms_kar_master,
			  jbt_master,
			  lvl_master,
			  div_master,
			  unt_master,
			  ktr_master
		 	  WHERE 
			  ms_kar_master.jbt_id=jbt_master.jbt_id AND 
			  ms_kar_master.lvl_id=lvl_master.lvl_id AND
			  ms_kar_master.div_id=div_master.div_id AND
			  ms_kar_master.unt_id=unt_master.unt_id AND
			  ms_kar_master.ktr_id=ktr_master.ktr_id 
			  ORDER BY kar_id
			  ";
		$query = mysql_query($sql) or die(mysql_error());
		while ($row = mysql_fetch_array($query))
			$data[] = $row;
		return $data;
	}
	function ms_tampil_2()
	{
		$sql = "SELECT * FROM 
			  ms_kar_master,
			  jbt_master,
			  lvl_master,
			  div_master,
			  unt_master,
			  ktr_master
		 	  WHERE 
			  ms_kar_master.jbt_id=jbt_master.jbt_id AND 
			  ms_kar_master.lvl_id=lvl_master.lvl_id AND
			  ms_kar_master.div_id=div_master.div_id AND
			  ms_kar_master.unt_id=unt_master.unt_id AND
			  ms_kar_master.ktr_id=ktr_master.ktr_id 
			  ORDER BY kar_id
			  ";
		$query = mysql_query($sql) or die(mysql_error());
		while ($row = mysql_fetch_array($query))
			$data[] = $row;
		return $data;
	}
	function ms_tampil_3()
	{
		$sql = "SELECT * FROM 
			  ms_kar_master,
			  jbt_master,
			  lvl_master,
			  div_master,
			  unt_master,
			  ktr_master
		 	  WHERE 
			  ms_kar_master.jbt_id=jbt_master.jbt_id AND 
			  ms_kar_master.lvl_id=lvl_master.lvl_id AND
			  ms_kar_master.div_id=div_master.div_id AND
			  ms_kar_master.unt_id=unt_master.unt_id AND
			  ms_kar_master.ktr_id=ktr_master.ktr_id 
			  ORDER BY kar_id
			  ";
		$query = mysql_query($sql) or die(mysql_error());
		while ($row = mysql_fetch_array($query))
			$data[] = $row;
		return $data;
	}
	function ms_tampil_filter()
	{
		$sql = "SELECT * FROM 
			  ms_kar_master,
			  jbt_master,
			  lvl_master,
			  div_master,
			  unt_master,
			  ktr_master
		 	  WHERE 
			  ms_kar_master.jbt_id=jbt_master.jbt_id AND 
			  ms_kar_master.lvl_id=lvl_master.lvl_id AND
			  ms_kar_master.div_id=div_master.div_id AND
			  ms_kar_master.unt_id=unt_master.unt_id AND
			  ms_kar_master.ktr_id=ktr_master.ktr_id AND
			  div_master.div_nm <> 'Komisaris' AND
			  div_master.div_nm <> 'Komite' AND
			  div_master.div_nm <> 'Direksi' AND
			  lvl_master.lvl_nm <> 'Komisaris' AND
			  lvl_master.lvl_nm <> 'Komite' AND
			  lvl_master.lvl_nm <> 'Direksi'
			  ORDER BY kar_id
			  ";
		$query = mysql_query($sql) or die(mysql_error());
		while ($row = mysql_fetch_array($query))
			$data[] = $row;
		return $data;
	}
	function ms_tampil_filter_2()
	{
		$sql = "SELECT * FROM 
			  ms_kar_master,
			  jbt_master,
			  lvl_master,
			  div_master,
			  unt_master,
			  ktr_master
		 	  WHERE 
			  ms_kar_master.jbt_id=jbt_master.jbt_id AND 
			  ms_kar_master.lvl_id=lvl_master.lvl_id AND
			  ms_kar_master.div_id=div_master.div_id AND
			  ms_kar_master.unt_id=unt_master.unt_id AND
			  ms_kar_master.ktr_id=ktr_master.ktr_id AND
			  div_master.div_nm <> 'Komisaris' AND
			  lvl_master.lvl_nm <> 'Komisaris'
			  ORDER BY kar_id
			  ";
		$query = mysql_query($sql) or die(mysql_error());
		while ($row = mysql_fetch_array($query))
			$data[] = $row;
		return $data;
	}
	function ms_tampil_id($kar_id)
	{
		$sql = "SELECT * FROM 
			  ms_kar_master,
			  jbt_master,
			  lvl_master,
			  div_master,
			  unt_master,
			  ktr_master
		 	  WHERE 
			  ms_kar_master.jbt_id=jbt_master.jbt_id AND 
			  ms_kar_master.lvl_id=lvl_master.lvl_id AND
			  ms_kar_master.div_id=div_master.div_id AND
			  ms_kar_master.unt_id=unt_master.unt_id AND
			  ms_kar_master.ktr_id=ktr_master.ktr_id AND
			  ms_kar_master.kar_id='$kar_id'
			  ORDER BY kar_id
			  ";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	function ms_tampil_username($username)
	{
		$sql = "SELECT * FROM 
			  ms_kar_master,
			  jbt_master,
			  lvl_master,
			  div_master,
			  unt_master,
			  ktr_master
		 	  WHERE 
			  ms_kar_master.jbt_id=jbt_master.jbt_id AND 
			  ms_kar_master.lvl_id=lvl_master.lvl_id AND
			  ms_kar_master.div_id=div_master.div_id AND
			  ms_kar_master.unt_id=unt_master.unt_id AND
			  ms_kar_master.ktr_id=ktr_master.ktr_id AND
			  ms_kar_master.kar_nik='$username'
			  ORDER BY kar_id
			  ";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	function ms_insert($kar_nik, $kar_nm, $kar_tgl_lahir, $div_id, $jbt_id, $lvl_id, $unt_id, $ktr_id, $kot_id)
	{
		$sql = "INSERT INTO ms_kar_master VALUES(NULL,'$kar_nik','$kar_nm','$kar_tgl_lahir','U','$div_id','$jbt_id','$lvl_id','$unt_id','$ktr_id','$kot_id',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'N','0')";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	function ms_delete($kar_id)
	{
		$sql = "DELETE FROM ms_kar_master WHERE kar_id='$kar_id'";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	function ms_update($kar_id, $kar_nm, $kar_tgl_lahir, $div_id, $jbt_id, $lvl_id, $unt_id, $ktr_id, $kot_id)
	{
		$sql = "UPDATE ms_kar_master SET kar_nm='$kar_nm',kar_tgl_lahir='$kar_tgl_lahir',jbt_id='$jbt_id',lvl_id='$lvl_id',div_id='$div_id',unt_id='$unt_id',ktr_id='$ktr_id',kot_id='$kot_id' WHERE kar_id='$kar_id'";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	function ms_update_shift($kar_id, $shiftextra)
	{
		if ($shiftextra == 'true') {
			$kar_default_shift2_in = '12:00:00';
			$kar_default_shift2_out = '20:00:00';
			$sql = "UPDATE ms_kar_master SET kar_default_shift2_in='$kar_default_shift2_in',kar_default_shift2_out='$kar_default_shift2_out' WHERE kar_id='$kar_id'";
		} else {
			$sql = "UPDATE ms_kar_master SET kar_default_shift2_in=NULL,kar_default_shift2_out=NULL WHERE kar_id='$kar_id'";
		}
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	function ms_update_disable_pulang($kar_id, $disablecheck)
	{
		if ($disablecheck == 'true') {
			$sql = "UPDATE ms_kar_master SET kar_disable_pulang='Y' WHERE kar_id='$kar_id'";
		} else {
			$sql = "UPDATE ms_kar_master SET kar_disable_pulang='N' WHERE kar_id='$kar_id'";
		}
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	function ms_tampil_pvl_user()
	{
		$sql = "SELECT * FROM 
			  ms_kar_master,
			  jbt_master,
			  lvl_master,
			  div_master,
			  unt_master,
			  ktr_master,
			  ms_kar_detail
		 	  WHERE 
			  ms_kar_master.jbt_id=jbt_master.jbt_id AND 
			  ms_kar_master.lvl_id=lvl_master.lvl_id AND
			  ms_kar_master.div_id=div_master.div_id AND
			  ms_kar_master.unt_id=unt_master.unt_id AND
			  ms_kar_master.ktr_id=ktr_master.ktr_id AND
			  ms_kar_master.kar_id=ms_kar_detail.kar_id AND
			  ms_kar_detail.kar_dtl_typ_krj <> 'Resign' AND
			  ms_kar_master.kar_pvl='U'
			  ORDER BY ms_kar_master.kar_id
			  ";
		$query = mysql_query($sql) or die(mysql_error());
		while ($row = mysql_fetch_array($query))
			$data[] = $row;
		return $data;
	}
	function ms_tampil_pvl_admin()
	{
		$sql = "SELECT * FROM 
			  ms_kar_master,
			  jbt_master,
			  lvl_master,
			  div_master,
			  unt_master,
			  ktr_master,
			  ms_kar_detail
		 	  WHERE 
			  ms_kar_master.jbt_id=jbt_master.jbt_id AND 
			  ms_kar_master.lvl_id=lvl_master.lvl_id AND
			  ms_kar_master.div_id=div_master.div_id AND
			  ms_kar_master.unt_id=unt_master.unt_id AND
			  ms_kar_master.ktr_id=ktr_master.ktr_id AND
			  ms_kar_master.kar_id=ms_kar_detail.kar_id AND
			  ms_kar_detail.kar_dtl_typ_krj <> 'Resign' AND
			  ms_kar_master.kar_pvl='A'
			  ORDER BY ms_kar_master.kar_id
			  ";
		$query = mysql_query($sql) or die(mysql_error());
		while ($row = mysql_fetch_array($query))
			$data[] = $row;
		return $data;
	}
	function ms_tampil_pvl_super_admin()
	{
		$sql = "SELECT * FROM 
			  ms_kar_master,
			  jbt_master,
			  lvl_master,
			  div_master,
			  unt_master,
			  ktr_master,
			  ms_kar_detail
		 	  WHERE 
			  ms_kar_master.jbt_id=jbt_master.jbt_id AND 
			  ms_kar_master.lvl_id=lvl_master.lvl_id AND
			  ms_kar_master.div_id=div_master.div_id AND
			  ms_kar_master.unt_id=unt_master.unt_id AND
			  ms_kar_master.ktr_id=ktr_master.ktr_id AND
			  ms_kar_master.kar_id=ms_kar_detail.kar_id AND
			  ms_kar_detail.kar_dtl_typ_krj <> 'Resign' AND
			  ms_kar_master.kar_pvl='S'
			  ORDER BY ms_kar_master.kar_id
			  ";
		$query = mysql_query($sql) or die(mysql_error());
		while ($row = mysql_fetch_array($query))
			$data[] = $row;
		return $data;
	}
	function ms_update_pvl($kar_id, $kar_pvl)
	{
		$sql = "UPDATE ms_kar_master SET kar_pvl='$kar_pvl' WHERE kar_id='$kar_id'";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	function ms_tampil_div($div_id)
	{
		$sql = "SELECT * FROM 
			  ms_kar_master,
			  div_master
		 	  WHERE 
			  ms_kar_master.div_id=div_master.div_id AND
			  ms_kar_master.div_id='$div_id'
			  ORDER BY kar_id
			  ";
		$query = mysql_query($sql) or die(mysql_error());
		while ($row = mysql_fetch_array($query))
			$data[] = $row;
		return $data;
	}
	function ms_update_location($kar_id, $ktr_id_, $unt_id_)
	{
		$sql = "UPDATE ms_kar_master SET ktr_id='$ktr_id_',unt_id='$unt_id_' WHERE kar_id='$kar_id'";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	function ms_tampil_location($ktr_id_, $unt_id_)
	{
		$sql = "SELECT * FROM ms_kar_master WHERE ktr_id='$ktr_id_' AND unt_id='$unt_id_' ORDER BY kar_id";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	function ms_tampil_detail($kar_id)
	{
		$sql = "SELECT * FROM ms_kar_detail WHERE kar_id='$kar_id' ORDER BY kar_id";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	function ms_update_employee($kar_dtl_sts_krj, $kar_dtl_typ_krj, $kar_dtl_tgl_joi, $kar_dtl_msa_krj, $kar_dtl_apv_krj, $kar_dtl_btc_krj, $kar_dtl_mem_krj, $kar_dtl_tgl_res, $kar_dtl_als_res, $kar_id)
	{
		$sql = "UPDATE ms_kar_detail SET kar_dtl_sts_krj='$kar_dtl_sts_krj',kar_dtl_typ_krj='$kar_dtl_typ_krj',kar_dtl_tgl_joi='$kar_dtl_tgl_joi',kar_dtl_msa_krj='$kar_dtl_msa_krj',kar_dtl_apv_krj='$kar_dtl_apv_krj',kar_dtl_btc_krj='$kar_dtl_btc_krj',kar_dtl_mem_krj='$kar_dtl_mem_krj',kar_dtl_tgl_res='$kar_dtl_tgl_res',kar_dtl_als_res='$kar_dtl_als_res' WHERE kar_id='$kar_id'";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	function ms_insert_employee($kar_dtl_sts_krj, $kar_dtl_typ_krj, $kar_dtl_tgl_joi, $kar_dtl_msa_krj, $kar_dtl_apv_krj, $kar_dtl_btc_krj, $kar_dtl_mem_krj, $kar_dtl_tgl_res, $kar_dtl_als_res, $kar_id)
	{
		$sql = "INSERT INTO ms_kar_detail VALUES(NULL,'$kar_dtl_sts_krj','$kar_dtl_typ_krj','$kar_dtl_tgl_joi','$kar_dtl_msa_krj','$kar_dtl_apv_krj','$kar_dtl_btc_krj','$kar_dtl_mem_krj','$kar_dtl_tgl_res','$kar_dtl_als_res','','','','','','','','','','','','','','','','','','','','','','','$kar_id')";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	function ms_update_bio($kar_dtl_usa, $kar_dtl_gen, $kar_dtl_tmp_lhr, $kar_dtl_sts_nkh, $kar_dtl_jml_ank, $kar_dtl_tgn, $kar_id)
	{
		$sql = "UPDATE ms_kar_detail SET kar_dtl_usa='$kar_dtl_usa',kar_dtl_gen='$kar_dtl_gen',kar_dtl_tmp_lhr='$kar_dtl_tmp_lhr',kar_dtl_sts_nkh='$kar_dtl_sts_nkh',kar_dtl_jml_ank='$kar_dtl_jml_ank',kar_dtl_tgn='$kar_dtl_tgn' WHERE kar_id='$kar_id'";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	function ms_insert_bio($kar_dtl_usa, $kar_dtl_gen, $kar_dtl_tmp_lhr, $kar_dtl_sts_nkh, $kar_dtl_jml_ank, $kar_dtl_tgn, $kar_id)
	{
		$sql = "INSERT INTO ms_kar_detail VALUES(NULL,'','','','','','','','','','$kar_dtl_usa','$kar_dtl_gen','$kar_dtl_tmp_lhr','$kar_dtl_sts_nkh','$kar_dtl_jml_ank','$kar_dtl_tgn','','','','','','','','','','','','','','','','','$kar_id')";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	function ms_update_education($kar_dtl_pnd, $kar_dtl_jrs, $kar_dtl_unv_sch, $kar_dtl_sts_pnd, $kar_dtl_thn_lls, $kar_id)
	{
		$sql = "UPDATE ms_kar_detail SET kar_dtl_pnd='$kar_dtl_pnd',kar_dtl_jrs='$kar_dtl_jrs',kar_dtl_unv_sch='$kar_dtl_unv_sch',kar_dtl_sts_pnd='$kar_dtl_sts_pnd',kar_dtl_thn_lls='$kar_dtl_thn_lls' WHERE kar_id='$kar_id'";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	function ms_insert_education($kar_dtl_pnd, $kar_dtl_jrs, $kar_dtl_unv_sch, $kar_dtl_sts_pnd, $kar_dtl_thn_lls, $kar_id)
	{
		$sql = "INSERT INTO ms_kar_detail VALUES(NULL,'','','','','','','','','','','','','','','','$kar_dtl_pnd','$kar_dtl_jrs','$kar_dtl_unv_sch','$kar_dtl_sts_pnd','$kar_dtl_thn_lls','','','','','','','','','','','','$kar_id')";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	function ms_update_card($kar_dtl_no_ktp, $kar_dtl_exp_ktp, $kar_dtl_no_kk, $kar_dtl_no_npw, $kar_dtl_no_kpj, $kar_dtl_no_rek, $kar_dtl_no_bpj, $kar_dtl_no_jms, $kar_id)
	{
		$sql = "UPDATE ms_kar_detail SET kar_dtl_no_ktp='$kar_dtl_no_ktp',kar_dtl_exp_ktp='$kar_dtl_exp_ktp',kar_dtl_no_kk='$kar_dtl_no_kk',kar_dtl_no_npw='$kar_dtl_no_npw',kar_dtl_no_kpj='$kar_dtl_no_kpj',kar_dtl_no_rek='$kar_dtl_no_rek',kar_dtl_no_bpj='$kar_dtl_no_bpj',kar_dtl_no_jms='$kar_dtl_no_jms' WHERE kar_id='$kar_id'";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	function ms_insert_card($kar_dtl_no_ktp, $kar_dtl_exp_ktp, $kar_dtl_no_kk, $kar_dtl_no_npw, $kar_dtl_no_kpj, $kar_dtl_no_rek, $kar_dtl_no_bpj, $kar_dtl_no_jms, $kar_id)
	{
		$sql = "INSERT INTO ms_kar_detail VALUES(NULL,'','','','','','','','','','','','','','','','','','','','','$kar_dtl_no_ktp','$kar_dtl_exp_ktp','$kar_dtl_no_kk','$kar_dtl_no_npw','$kar_dtl_no_kpj','$kar_dtl_no_rek','$kar_dtl_no_bpj','$kar_dtl_no_jms','','','','$kar_id')";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	function ms_update_contact($kar_dtl_eml, $kar_dtl_tlp, $kar_dtl_alt, $kar_id)
	{
		$sql = "UPDATE ms_kar_detail SET kar_dtl_eml='$kar_dtl_eml',kar_dtl_tlp='$kar_dtl_tlp',kar_dtl_alt='$kar_dtl_alt' WHERE kar_id='$kar_id'";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	function ms_insert_contact($kar_dtl_eml, $kar_dtl_tlp, $kar_dtl_alt, $kar_id)
	{
		$sql = "INSERT INTO ms_kar_detail VALUES(NULL,'','','','','','','','','','','','','','','','','','','','','','','','','','','','','$kar_dtl_eml','$kar_dtl_tlp','$kar_dtl_alt','$kar_id')";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	function ms_tampil_typ($kar_dtl_typ_krj)
	{
		$sql = "SELECT * FROM ms_kar_master,ms_kar_detail WHERE ms_kar_master.kar_id=ms_kar_detail.kar_id AND ms_kar_detail.kar_dtl_typ_krj='$kar_dtl_typ_krj' AND ms_kar_detail.kar_dtl_typ_krj!='' ORDER BY ms_kar_master.kar_id";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	function ms_tampil_sts($kar_dtl_sts_krj)
	{
		$sql = "SELECT * FROM ms_kar_master,ms_kar_detail WHERE ms_kar_master.kar_id=ms_kar_detail.kar_id AND ms_kar_detail.kar_dtl_sts_krj='$kar_dtl_sts_krj' AND ms_kar_detail.kar_dtl_sts_krj!='' ORDER BY ms_kar_master.kar_id";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	function ms_tampil_libur($id_karyawan)
	{
		$sql = "SELECT * FROM ms_kar_master WHERE kar_id NOT REGEXP '$id_karyawan' ORDER BY kar_id";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	function ms_tampil_kontrak()
	{
		$sql = "SELECT * FROM 
			  ms_kar_master,
			  jbt_master,
			  lvl_master,
			  div_master,
			  unt_master,
			  ktr_master,
			  ms_kar_detail
		 	  WHERE 
			  ms_kar_master.jbt_id=jbt_master.jbt_id AND 
			  ms_kar_master.lvl_id=lvl_master.lvl_id AND
			  ms_kar_master.div_id=div_master.div_id AND
			  ms_kar_master.unt_id=unt_master.unt_id AND
			  ms_kar_master.ktr_id=ktr_master.ktr_id AND
			  ms_kar_master.kar_id=ms_kar_detail.kar_id AND
			  ms_kar_detail.kar_dtl_typ_krj = 'Kontrak'
			  ORDER BY ms_kar_master.kar_id
			  ";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	function ms_tampil_uptodate()
	{
		$sql = "SELECT * FROM 
			  ms_kar_master,
			  jbt_master,
			  lvl_master,
			  div_master,
			  unt_master,
			  ktr_master,
			  ms_kar_detail
		 	  WHERE 
			  ms_kar_master.jbt_id=jbt_master.jbt_id AND 
			  ms_kar_master.lvl_id=lvl_master.lvl_id AND
			  ms_kar_master.div_id=div_master.div_id AND
			  ms_kar_master.unt_id=unt_master.unt_id AND
			  ms_kar_master.ktr_id=ktr_master.ktr_id AND
			  ms_kar_master.kar_id=ms_kar_detail.kar_id AND
			  div_master.div_nm <> 'Komisaris' AND
			  div_master.div_nm <> 'Komite' AND
			  div_master.div_nm <> 'Direksi' AND
			  lvl_master.lvl_nm <> 'Komisaris' AND
			  lvl_master.lvl_nm <> 'Komite' AND
			  lvl_master.lvl_nm <> 'Direksi' AND
			  ms_kar_detail.kar_dtl_typ_krj <> 'Resign'
			  ORDER BY ms_kar_master.kar_id
			  ";
		$query = mysql_query($sql) or die(mysql_error());
		while ($row = mysql_fetch_array($query))
			$data[] = $row;
		return $data;
	}
	function ms_tampil_uptodate_unit()
	{
		$sql = "SELECT * FROM 
			  ms_kar_master,
			  lvl_master,
			  div_master,
			  unt_master,
			  ktr_master,
			  ms_kar_detail
		 	  WHERE 
			  ms_kar_master.lvl_id=lvl_master.lvl_id AND
			  ms_kar_master.div_id=div_master.div_id AND
			  ms_kar_master.unt_id=unt_master.unt_id AND
			  ms_kar_master.unt_id='2' AND
			  ms_kar_master.ktr_id=ktr_master.ktr_id AND
			  ms_kar_master.kar_id=ms_kar_detail.kar_id AND
			  div_master.div_nm <> 'Komisaris' AND
			  div_master.div_nm <> 'Komite' AND
			  div_master.div_nm <> 'Direksi' AND
			  div_master.div_nm <> 'Marketing' AND
			  div_master.div_nm <> 'Umum' AND
			  lvl_master.lvl_nm <> 'Komisaris' AND
			  lvl_master.lvl_nm <> 'Komite' AND
			  lvl_master.lvl_nm <> 'Direksi' AND
			  ms_kar_detail.kar_dtl_typ_krj <> 'Resign'
			  ORDER BY ms_kar_master.kar_id
			  ";
		$query = mysql_query($sql) or die(mysql_error());
		while ($row = mysql_fetch_array($query))
			$data[] = $row;
		return $data;
	}
	function ms_tampil_uptodate_unit2()
	{
		$sql = "SELECT * FROM 
			  ms_kar_master,
			  jbt_master,
			  lvl_master,
			  div_master,
			  unt_master,
			  ktr_master,
			  ms_kar_detail
		 	  WHERE 
			  ms_kar_master.jbt_id=jbt_master.jbt_id AND 
			  ms_kar_master.lvl_id=lvl_master.lvl_id AND
			  ms_kar_master.div_id=div_master.div_id AND
			  ms_kar_master.unt_id=unt_master.unt_id AND
			  ms_kar_master.unt_id='2' AND
			  ms_kar_master.ktr_id=ktr_master.ktr_id AND
			  ms_kar_master.kar_id=ms_kar_detail.kar_id AND
			  div_master.div_nm <> 'Komisaris' AND
			  div_master.div_nm <> 'Komite' AND
			  div_master.div_nm <> 'Direksi' AND
			  div_master.div_nm <> 'Marketing' AND
			  div_master.div_nm <> 'Umum' AND
			  lvl_master.lvl_nm <> 'Komisaris' AND
			  lvl_master.lvl_nm <> 'Komite' AND
			  lvl_master.lvl_nm <> 'Direksi' AND
			  ms_kar_detail.kar_dtl_typ_krj <> 'Resign'
			  ORDER BY ms_kar_master.kar_id
			  ";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	function ms_update_jdwakses($kar_id, $kar_jdw_akses)
	{
		$sql = "UPDATE ms_kar_master SET kar_jdw_akses='$kar_jdw_akses' WHERE kar_id='$kar_id'";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	function ms_tampil_div_in($div_value)
	{
		$sql = "SELECT * FROM 
			  ms_kar_master,
			  div_master
		 	  WHERE 
			  ms_kar_master.div_id=div_master.div_id AND
			  ms_kar_master.div_id IN ($div_value)
			  ORDER BY ms_kar_master.kar_id
			  ";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	function ms_tampil_div_in_new($div_value)
	{
		$sql = "SELECT * FROM 
			  ms_kar_master,
			  ms_kar_detail,
			  div_master
		 	  WHERE
			  ms_kar_master.kar_id=ms_kar_detail.kar_id AND
			  ms_kar_master.div_id=div_master.div_id AND
			  ms_kar_master.div_id IN ($div_value) AND
			  ms_kar_master.kar_logika <> 1  AND
			  ms_kar_detail.kar_dtl_typ_krj <>'Resign'
			  ORDER BY ms_kar_master.kar_id
			  ";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	function ms_tampil_div_in_cs($div_value)
	{
		$sql = "SELECT * FROM 
			  ms_kar_master,
			  ms_kar_detail,
			  div_master
		 	  WHERE
			  ms_kar_master.kar_id=ms_kar_detail.kar_id AND
			  ms_kar_master.div_id=div_master.div_id AND
			  ms_kar_master.div_id IN ($div_value) AND
			  ms_kar_master.kar_logika <> 1  AND
			  ms_kar_detail.kar_dtl_typ_krj <>'Resign'
			  ORDER BY ms_kar_master.kar_id
			  ";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	function ms_tampil_div_in_logika($logika_value)
	{
		$sql = "SELECT * FROM 
			  ms_kar_master,
			  ms_kar_detail,
			  div_master
		 	  WHERE
			  ms_kar_master.kar_id=ms_kar_detail.kar_id AND
			  ms_kar_master.div_id=div_master.div_id AND
			  ms_kar_master.kar_logika='$logika_value' AND
			  ms_kar_detail.kar_dtl_typ_krj <>'Resign'
			  ORDER BY ms_kar_master.kar_id
			  ";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	function ms_tampil_nik($kar_nik)
	{
		$sql = "SELECT * FROM ms_kar_master WHERE kar_nik = '$kar_nik' ORDER BY kar_id";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	function ms_sync_update($kar_nik, $datetime)
	{
		$sql = "UPDATE ms_kar_master SET kar_sync_date='$datetime' WHERE kar_nik='$kar_nik'";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	function ms_tampil_akses($kar_nik)
	{
		if ($kar_nik == "all") {
			$sql = "SELECT a.kar_id,a.kar_nik, a.kar_nm, c.div_nm FROM 
				  ms_kar_master a,
				  lvl_master b,
				  div_master c,
				  ms_kar_detail d
				  WHERE 
				  a.lvl_id=b.lvl_id AND
				  a.div_id=c.div_id AND
				  a.kar_id=d.kar_id AND
				  d.kar_dtl_typ_krj <> 'Resign'
				  ORDER BY a.kar_id
				  ";
		} else {
			$sql = "SELECT a.kar_id,a.kar_nik, a.kar_nm, c.div_nm FROM 
				ms_kar_master a,
				lvl_master b,
				div_master c,
				ms_kar_detail d
				WHERE 
				a.lvl_id=b.lvl_id AND
				a.div_id=c.div_id AND
				a.kar_id=d.kar_id AND
				a.kar_nik IN ('$kar_nik') AND 
				d.kar_dtl_typ_krj <> 'Resign'
				ORDER BY a.kar_id
				";
		}
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	function ms_tmp_list()
	{
		$sql = "SELECT * FROM tmp_marketing_support ORDER BY mfc_id";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	function ms_last_upload()
	{
		$sql = "SELECT MAX(mfc_tglmdf) AS last_update FROM tmp_marketing_support";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
}

class LinkGroupWA
{
	function list_tautan()
	{
		$sql = "SELECT * FROM _link_group_wa ORDER BY idnya";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
}

class GradePencapaian
{
	function grd_tampil()
	{
		$sql = "SELECT grd_id,grd_wilayah,grd_manwil,grd_kpt,grd_pts,grd_grade,grd_target,grd_jml_staff,grd_karyawan,grd_staff
		FROM grade_pencapaian";
		$query = mysql_query($sql) or die(mysql_error());
		while ($row = mysql_fetch_array($query))
			$data[] = $row;
		return $data;
	}
	function grd_tampil_nmunit_by_nik()
	{
		$data = array();
		$sql = "SELECT kar_nik,kar_nm FROM kar_master";
		$query = mysql_query($sql) or die(mysql_error());
		while ($row = mysql_fetch_array($query)) {
			$key = @implode("", @explode(".", $row['kar_nik']));
			$data[$key] = $row;
			// echo "<pre>";
			// print_r($data[$key]=$row);
			// echo "</pre>";

		}
		return $data;
	}
	function uni_tampil()
	{
		$sql = "SELECT * FROM unit WHERE uni_aktif='Y' ORDER BY uni_nama ASC";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	function grd_update($grd_id, $grd_wilayah, $grd_manwil, $grd_kpt, $grd_pts, $grd_grade, $grd_target, $grd_jml_staff, $grd_karyawan)
	{
		$sql = "UPDATE grade_pencapaian SET grd_wilayah='$grd_wilayah',grd_manwil='$grd_manwil',grd_kpt='$grd_kpt',grd_pts='$grd_pts',grd_grade='$grd_grade',grd_target='$grd_target',grd_jml_staff='$grd_jml_staff',grd_karyawan='$grd_karyawan' WHERE grd_id='$grd_id'";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
}

class PotongGaji
{
	function ptg_insert($ptg_priode, $ptg_cutoff, $ptg_nik, $ptg_nama, $ptg_kampus, $ptg_grade, $ptg_target, $ptg_pencapaian, $ptg_potongan, $ptg_insentif)
	{
		$sql = "INSERT INTO pemotongan_gaji VALUES(NULL,'$ptg_priode','$ptg_cutoff','$ptg_nik','$ptg_nama','$ptg_kampus','$ptg_grade','$ptg_target','$ptg_pencapaian','$ptg_potongan','$ptg_insentif',NOW())";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	function ptg_cek($ptg_priode, $ptg_nik)
	{
		$sql = "SELECT ptg_nik FROM pemotongan_gaji WHERE ptg_priode='$ptg_priode' AND ptg_nik='$ptg_nik' ORDER BY ptg_nik ASC LIMIT 1";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
}

class NewReward
{
	function nrw_insert_cs($nrw_priode, $nrw_cutoff, $nrw_nik, $nrw_nama, $nrw_tcm, $nrw_jml_pmb, $nrw_jml_reg, $nrw_jml_her, $nrw_data, $nrw_normal_data, $nrw_libur_data, $nrw_incase_data, $nrw_closing_rp25, $nrw_closing_rp50, $nrw_reward_reg, $nrw_reward_her, $nrw_insentif, $nrw_extra_insentif, $nrw_total_insentif, $nrw_reg_real,$nrw_jml_reg_pts)
	{
		$sql = "INSERT INTO nrw_data_cs VALUES(NULL,'$nrw_priode','$nrw_cutoff','$nrw_nik','$nrw_nama','$nrw_tcm','0','$nrw_jml_pmb','$nrw_jml_reg','$nrw_jml_her','$nrw_data','$nrw_normal_data','$nrw_libur_data','$nrw_incase_data','$nrw_closing_rp25','$nrw_closing_rp50','$nrw_reward_reg','$nrw_reward_her','$nrw_insentif','$nrw_extra_insentif','$nrw_total_insentif','$nrw_reg_real','$nrw_jml_reg_pts',NOW())";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	function nrw_cek_cs($nrw_priode, $nrw_nik)
	{
		$sql = "SELECT nrw_nik FROM nrw_data_cs WHERE nrw_priode='$nrw_priode' AND nrw_nik='$nrw_nik' ORDER BY nrw_nik ASC LIMIT 1";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	function nrw_update_cs($nrw_priode, $nrw_nik, $nrw_jml_pmb_kotor)
	{
		$sql = "UPDATE nrw_data_cs SET nrw_jml_pmb_kotor='$nrw_jml_pmb_kotor' WHERE nrw_priode='$nrw_priode' AND nrw_nik='$nrw_nik'";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	function nrw_insert($nrw_priode, $nrw_cutoff, $nrw_nik, $nrw_nama, $nrw_kpt, $nrw_pts, $nrw_grade, $nrw_tcm, $nrw_jml_pmb, $nrw_jml_reg, $nrw_jml_her, $nrw_data, $nrw_normal_data, $nrw_libur_data, $nrw_incase_data, $nrw_closing_rp25, $nrw_closing_rp50, $nrw_reward_reg, $nrw_reward_her, $nrw_insentif,$nrw_extra_insentif,$nrw_total_insentif, $nrw_reg_real, $nrw_jml_reg_pts)
	{
		$sql = "INSERT INTO nrw_data VALUES(NULL,'$nrw_priode','$nrw_cutoff','$nrw_nik','$nrw_nama','$nrw_kpt','$nrw_pts','$nrw_grade','$nrw_tcm','0','$nrw_jml_pmb','$nrw_jml_reg','$nrw_jml_her','$nrw_data','$nrw_normal_data','$nrw_libur_data','$nrw_incase_data','$nrw_closing_rp25','$nrw_closing_rp50','$nrw_reward_reg','$nrw_reward_her','$nrw_insentif','$nrw_extra_insentif','$nrw_total_insentif','$nrw_reg_real','$nrw_jml_reg_pts',NOW())";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	function nrw_cek($nrw_priode, $nrw_nik)
	{
		$sql = "SELECT nrw_nik FROM nrw_data WHERE nrw_priode='$nrw_priode' AND nrw_nik='$nrw_nik' ORDER BY nrw_nik ASC LIMIT 1";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	function nrw_update($nrw_priode, $nrw_nik, $nrw_jml_pmb_kotor)
	{
		$sql = "UPDATE nrw_data SET nrw_jml_pmb_kotor='$nrw_jml_pmb_kotor' WHERE nrw_priode='$nrw_priode' AND nrw_nik='$nrw_nik'";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
}

class Test
{
	function test()
	{
	}
}


class PfmStaff
{

	function pfm_insert($pfm_tgl, $pfm_waktu, $pfm_picid, $pfm_pic, $pfm_metode, $pfm_unit, $pfm_staff, $pfm_topic_cat, $pfm_knowledge, $pfm_knowledge_cat, $pfm_komunikasi, $pfm_komunikasi_cat, $pfm_closing, $pfm_closing_cat, $pfm_mempengaruhi, $pfm_mempengaruhi_cat, $pfm_lain_cat, $pfm_arahan_cat, $pfm_perkembangan, $pfm_pelatihan_cat, $pfm_crdt, $pfm_img)
	{
		$sql = "INSERT INTO pfm_master VALUES(NULL,'$pfm_tgl','$pfm_waktu','$pfm_picid','$pfm_pic','$pfm_metode','$pfm_unit','$pfm_staff','$pfm_topic_cat','$pfm_knowledge','$pfm_knowledge_cat','$pfm_komunikasi','$pfm_komunikasi_cat','$pfm_closing','$pfm_closing_cat','$pfm_mempengaruhi','$pfm_mempengaruhi_cat','$pfm_lain_cat','$pfm_arahan_cat','$pfm_perkembangan','$pfm_pelatihan_cat','$pfm_img','$pfm_crdt','$pfm_crdt','N')";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	function pfm_update($pfm_id, $pfm_tgl, $pfm_waktu, $pfm_metode, $pfm_unit, $pfm_staff, $pfm_topic_cat, $pfm_knowledge, $pfm_knowledge_cat, $pfm_komunikasi, $pfm_komunikasi_cat, $pfm_closing, $pfm_closing_cat, $pfm_mempengaruhi, $pfm_mempengaruhi_cat, $pfm_lain_cat, $pfm_arahan_cat, $pfm_perkembangan, $pfm_pelatihan_cat, $pfm_mddt, $pfm_img)
	{
		// print_r($pfm_img);
		// exit;
		$sql = "UPDATE pfm_master SET pfm_tgl='$pfm_tgl',pfm_waktu='$pfm_waktu',pfm_metode='$pfm_metode',pfm_unit='$pfm_unit',pfm_staff='$pfm_staff',pfm_topic_cat='$pfm_topic_cat',pfm_knowledge='$pfm_knowledge',pfm_knowledge_cat='$pfm_knowledge_cat',pfm_komunikasi='$pfm_komunikasi',pfm_komunikasi_cat='$pfm_komunikasi_cat',pfm_closing='$pfm_closing',pfm_closing_cat='$pfm_closing_cat',pfm_mempengaruhi='$pfm_mempengaruhi',pfm_mempengaruhi_cat='$pfm_mempengaruhi_cat',pfm_lain_cat='$pfm_lain_cat',pfm_perkembangan='$pfm_perkembangan',pfm_arahan_cat='$pfm_arahan_cat',pfm_pelatihan_cat='$pfm_pelatihan_cat',pfm_mddt='$pfm_mddt',pfm_img='$pfm_img' WHERE pfm_id='$pfm_id'";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	function pfm_delete($pfm_id_)
	{
		$sql = "DELETE FROM pfm_master WHERE pfm_id='$pfm_id_'";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}

	function pfm_konfirmhrd($pfm_id_, $pfm_hrd_)
	{
		$sql = "UPDATE pfm_master SET pfm_hrd='$pfm_hrd_' WHERE pfm_id='$pfm_id_'";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}

	//Select disini

	function pfm_tampil_all()
	{
		$sql = "SELECT * FROM pfm_master ORDER BY pfm_crdt DESC";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	function pfm_tampil($tgl_terakhir)
	{
		$sql = "SELECT * FROM pfm_master WHERE pfm_tgl='$tgl_terakhir' OR pfm_tgl='0000-00-00' ORDER BY pfm_crdt ASC";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	function pfm_tampil_filter($sespriode1, $sespriode2, $sespts, $sesstaff, $seswilayah)
	{
		if (!empty($sespriode1) && !empty($sespriode2)) {
			if (!empty($sespts) || !empty($sesstaff) || !empty($seswilayah)) {
				$filter_priode = " AND pfm_tgl BETWEEN '$sespriode1' AND '$sespriode2' ";
			} else {
				$filter_priode = " pfm_tgl BETWEEN '$sespriode1' AND '$sespriode2' ";
			}
		} else {
			$filter_priode = "";
		}

		if (!empty($sespts)) {
			$filter_pts = "pfm_unit='$sespts' ";
		} else {
			$filter_pts = "";
		}

		if (!empty($sesstaff)) {
			if (!empty($sespts) || !empty($sespriode1) && !empty($sespriode2)) {
				$filter_staff = " AND pfm_picid='$sesstaff' ";
			} else {
				$filter_staff = " pfm_picid='$sesstaff' ";
			}
		} else {
			$filter_staff = "";
		}

		// if (!empty($seswilayah)) {
		// 	if (!empty($sespts) || !empty($sesprogram) || !empty($sespriode1) && !empty($sespriode2)) {
		// 		$filter_wilayah = " AND pfm_wilayah='$seswilayah' ";
		// 	} else {
		// 		$filter_wilayah = " pfm_wilayah='$seswilayah' ";
		// 	}
		// } else {
		// 	$filter_wilayah = "";
		// }

		$sql = "SELECT * FROM pfm_master WHERE $filter_pts $filter_priode $filter_staff ORDER BY pfm_crdt DESC";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	function pfm_tampil_max()
	{
		$sql = "SELECT MAX(pfm_tgl) AS tgl_terakhir FROM pfm_master ORDER BY pfm_crdt DESC";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}

	function pfm_tampil_img($pfm_id)
	{
		$sql = "SELECT pfm_img FROM pfm_master WHERE pfm_id='$pfm_id'";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
}

class KondisiSekretariat
{

	function ksk_insert($ksk_unit, $ksk_staff, $ksk_posisi, $ksk_deskripsi, $ksk_kondisi, $ksk_kondisi_txt, $ksk_crdt, $ksk_img)
	{
		$sql = "INSERT INTO ksk_master VALUES(NULL,'$ksk_unit','$ksk_staff','$ksk_posisi','$ksk_deskripsi','$ksk_kondisi','$ksk_kondisi_txt','$ksk_img','$ksk_crdt','$ksk_crdt','N')";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	function ksk_update($ksk_id, $ksk_unit, $ksk_staff, $ksk_posisi, $ksk_deskripsi, $ksk_kondisi, $ksk_kondisi_txt, $ksk_crdt, $ksk_img)
	{
		$sql = "UPDATE ksk_master SET ksk_unit='$ksk_unit',ksk_staff='$ksk_staff',ksk_posisi='$ksk_posisi',ksk_deskripsi='$ksk_deskripsi',ksk_kondisi='$ksk_kondisi',ksk_kondisi_txt='$ksk_kondisi_txt',ksk_mddt='$ksk_crdt',ksk_img='$ksk_img' WHERE ksk_id='$ksk_id'";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}

	function ksk_progress($ksk_id, $ksk_status, $ksk_crdt)
	{
		$sql = "UPDATE ksk_master SET ksk_status='$ksk_status',ksk_mddt='$ksk_crdt' WHERE ksk_id='$ksk_id'";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}

	function ksk_delete($ksk_id_)
	{
		$sql = "DELETE FROM ksk_master WHERE ksk_id='$ksk_id_'";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}

	function ksk_konfirmhrd($ksk_id_, $ksk_hrd_)
	{
		$sql = "UPDATE ksk_master SET ksk_hrd='$ksk_hrd_' WHERE ksk_id='$ksk_id_'";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}

	//Select disini

	function ksk_tampil_all()
	{
		$sql = "SELECT * FROM ksk_master ORDER BY ksk_crdt DESC";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}

	function ksk_rekapan()
	{
		// $sql = "SELECT * FROM kar_master WHERE unt_id = '2'";
		$sql = "SELECT * FROM 
		kar_master,
		jbt_master,
		lvl_master,
		div_master,
		unt_master,
		ktr_master,
		kar_detail
		WHERE 
		kar_master.jbt_id=jbt_master.jbt_id AND 
		kar_master.lvl_id=lvl_master.lvl_id AND
		kar_master.div_id=div_master.div_id AND
		kar_master.unt_id=unt_master.unt_id AND
		kar_master.div_id='8' AND
		kar_master.ktr_id=ktr_master.ktr_id AND
		kar_master.kar_id=kar_detail.kar_id AND
		div_master.div_nm <> 'Komisaris' AND
		div_master.div_nm <> 'Komite' AND
		div_master.div_nm <> 'Direksi' AND
		div_master.div_nm <> 'Marketing' AND
		div_master.div_nm <> 'Umum' AND
		lvl_master.lvl_nm <> 'Komisaris' AND
		lvl_master.lvl_nm <> 'Komite' AND
		lvl_master.lvl_nm <> 'Direksi' AND
		kar_detail.kar_dtl_typ_krj <> 'Resign'
		ORDER BY kar_master.kar_id
		";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}

	function ksk_tampil_id($kar_id)
	{
		$sql = "SELECT ksk_staff,ksk_mddt FROM ksk_master WHERE ksk_staff ='$kar_id' AND ksk_img !='' ";

		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}

	function ksk_tampil_kondisi($kondisi)
	{
		$sql = "SELECT * FROM ksk_master WHERE ksk_kondisi ='$kondisi' ";

		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}

	function ksk_tampil($tgl_terakhir)
	{
		$sql = "SELECT * FROM ksk_master WHERE ksk_mddt='$tgl_terakhir' OR ksk_mddt='0000-00-00' ORDER BY ksk_crdt ASC";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	function ksk_tampil_filter($sespriode1, $sespriode2, $sespts, $sesstaff, $seswilayah)
	{
		if (!empty($sespriode1) && !empty($sespriode2)) {
			if (!empty($sespts) || !empty($sesstaff) || !empty($seswilayah)) {
				$filter_priode = " AND ksk_mddt BETWEEN '$sespriode1' AND '$sespriode2' ";
			} else {
				$filter_priode = " ksk_mddt BETWEEN '$sespriode1' AND '$sespriode2' ";
			}
		} else {
			$filter_priode = "";
		}

		if (!empty($sespts)) {
			$filter_pts = "ksk_unit='$sespts' ";
		} else {
			$filter_pts = "";
		}

		if (!empty($sesstaff)) {
			if (!empty($sespts) || !empty($sespriode1) && !empty($sespriode2)) {
				$filter_staff = " AND ksk_staff='$sesstaff' ";
			} else {
				$filter_staff = " ksk_staff='$sesstaff' ";
			}
		} else {
			$filter_staff = "";
		}

		// if (!empty($seswilayah)) {
		// 	if (!empty($sespts) || !empty($sesprogram) || !empty($sespriode1) && !empty($sespriode2)) {
		// 		$filter_wilayah = " AND ksk_wilayah='$seswilayah' ";
		// 	} else {
		// 		$filter_wilayah = " ksk_wilayah='$seswilayah' ";
		// 	}
		// } else {
		// 	$filter_wilayah = "";
		// }

		$sql = "SELECT * FROM ksk_master WHERE $filter_pts $filter_priode $filter_staff ORDER BY ksk_crdt DESC";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	function ksk_tampil_max()
	{
		$sql = "SELECT MAX(ksk_mddt) AS tgl_terakhir FROM ksk_master ORDER BY ksk_crdt DESC";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}

	function ksk_tampil_img($ksk_id)
	{
		$sql = "SELECT ksk_img FROM ksk_master WHERE ksk_id='$ksk_id'";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
}

class AccountTest
{
	function acc_tampil()
	{
		$sql = "SELECT * FROM 
			  tst_acc_master,
			  tst_kar_master
		 	  WHERE 
			  tst_acc_master.kar_id=tst_kar_master.kar_id
			  ORDER BY acc_id
			  ";
		$query = mysql_query($sql) or die(mysql_error());
		while ($row = mysql_fetch_array($query))
			$data[] = $row;
		return $data;
	}
	function acc_tampil_id($acc_id)
	{
		$sql = "SELECT * FROM 
			  tst_acc_master,
			  tst_kar_master
		 	  WHERE 
			  tst_acc_master.kar_id=tst_kar_master.kar_id AND
			  tst_acc_master.acc_id='$acc_id'
			  ORDER BY acc_id
			  ";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	function acc_tampil_username($acc_username)
	{
		$sql = "SELECT * FROM tst_acc_master WHERE acc_username='$acc_username' ORDER BY acc_id";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	function acc_insert($acc_username, $acc_password, $kar_id)
	{
		$sql = "INSERT INTO tst_acc_master VALUES(NULL,'$acc_username','$acc_password',md5('$acc_password'),'','','','','','$kar_id')";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	function acc_tampil_kartst($kar_idtst)
	{
		$sql = "SELECT * FROM  
			  tst_acc_master,
			  tst_kar_master
			  WHERE 
			  tst_acc_master.kar_id=tst_kar_master.kar_id AND
			  tst_acc_master.kar_id='$kar_idtst' 
			  ORDER BY acc_id";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	function acc_delete($acc_id)
	{
		$sql = "DELETE FROM tst_acc_master WHERE acc_id='$acc_id'";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	function acc_img_update($acc_img, $kar_id)
	{
		$sql = "UPDATE tst_acc_master SET acc_img='$acc_img' WHERE kar_id='$kar_id'";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	function acc_pass_update($acc_password, $kar_id)
	{
		$sql = "UPDATE tst_acc_master SET acc_password='$acc_password', acc_md5=md5('$acc_password') WHERE kar_id='$kar_id'";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	function acc_signin($acc_username, $acc_password, $date, $time)
	{
		$result = mysql_query("SELECT * FROM tst_acc_master WHERE acc_username = '$acc_username' AND acc_password = '$acc_password' AND (acc_sts = 'A' OR acc_sts ='')");
		$acc_data = mysql_fetch_array($result);
		$cek_acc = mysql_num_rows($result);
		if ($cek_acc == 1) {
			$_SESSION['kar_tst'] = $acc_data['kar_id'];
			$sql = "UPDATE tst_acc_master SET acc_log_tgl='$date',acc_log_jam='$time' WHERE kar_id='$acc_data[kar_id]'";
			$query = mysql_query($sql) or die(mysql_error());
			return TRUE;
		} else {
			return FALSE;
		}
	}
	function acc_signout($kar_id, $date, $time)
	{
		$sql = "UPDATE tst_acc_master SET acc_log_tgl='$date',acc_log_jam='$time' WHERE kar_id='$kar_id'";
		$query = mysql_query($sql) or die(mysql_error());
		session_start();
		$_SESSION['kar_tst'] = '';
		session_unset();
		session_destroy();
		session_start();
		session_regenerate_id(true);
		return TRUE;
	}
	function acc_update_sts($acc_id, $acc_sts)
	{
		$sql = "UPDATE tst_acc_master SET acc_sts='$acc_sts' WHERE acc_id='$acc_id'";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}

	//////////////////////////////////////////////////////////////////////////////////////////////


	function acc_tampil_ms()
	{
		$sql = "SELECT * FROM 
			  ms_tst_acc_master,
			  ms_tst_kar_master
		 	  WHERE 
			  ms_tst_acc_master.kar_id=ms_tst_kar_master.kar_id
			  ORDER BY acc_id
			  ";
		$query = mysql_query($sql) or die(mysql_error());
		while ($row = mysql_fetch_array($query))
			$data[] = $row;
		return $data;
	}
	function acc_tampil_ms_id($acc_id)
	{
		$sql = "SELECT * FROM 
			  ms_tst_acc_master,
			  ms_tst_kar_master
		 	  WHERE 
			  ms_tst_acc_master.kar_id=ms_tst_kar_master.kar_id AND
			  ms_tst_acc_master.acc_id='$acc_id'
			  ORDER BY acc_id
			  ";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	function acc_tampil_ms_username($acc_username)
	{
		$sql = "SELECT * FROM ms_tst_acc_master WHERE acc_username='$acc_username' ORDER BY acc_id";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	function acc_insert_ms($acc_username, $acc_password, $kar_id)
	{
		$sql = "INSERT INTO ms_tst_acc_master VALUES(NULL,'$acc_username','$acc_password',md5('$acc_password'),'','','','','','$kar_id')";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	function acc_tampil_ms_kar($kar_id)
	{
		$sql = "SELECT * FROM  
			  ms_tst_acc_master,
			  ms_tst_kar_master
			  WHERE 
			  ms_tst_acc_master.kar_id=ms_tst_kar_master.kar_id AND
			  ms_tst_acc_master.kar_id='$kar_id' 
			  ORDER BY acc_id";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	function acc_delete_ms($acc_id)
	{
		$sql = "DELETE FROM ms_tst_acc_master WHERE acc_id='$acc_id'";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	function acc_img_ms_update($acc_img, $kar_id)
	{
		$sql = "UPDATE ms_tst_acc_master SET acc_img='$acc_img' WHERE kar_id='$kar_id'";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	function acc_pass_ms_update($acc_password, $kar_id)
	{
		$sql = "UPDATE ms_tst_acc_master SET acc_password='$acc_password', acc_md5=md5('$acc_password') AND  WHERE kar_id='$kar_id'";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	function acc_signin_ms($acc_username, $acc_password, $date, $time)
	{
		$result = mysql_query("SELECT * FROM ms_tst_acc_master WHERE acc_username = '$acc_username' AND acc_password = '$acc_password' AND (acc_sts = 'A' OR acc_sts ='')");
		$acc_data = mysql_fetch_array($result);
		$cek_acc = mysql_num_rows($result);
		if ($cek_acc == 1) {
			$_SESSION['kar'] = $acc_data['kar_id'];
			$sql = "UPDATE ms_tst_acc_master SET acc_log_tgl='$date',acc_log_jam='$time' WHERE kar_id='$acc_data[kar_id]'";
			$query = mysql_query($sql) or die(mysql_error());
			return TRUE;
		} else {
			return FALSE;
		}
	}
	function acc_signout_ms($kar_id, $date, $time)
	{
		$sql = "UPDATE ms_tst_acc_master SET acc_log_tgl='$date',acc_log_jam='$time' WHERE kar_id='$kar_id'";
		$query = mysql_query($sql) or die(mysql_error());
		session_start();
		$_SESSION['kar'] = '';
		session_unset();
		session_destroy();
		session_start();
		session_regenerate_id(true);
		return TRUE;
	}
	function acc_update_ms_sts($acc_id, $acc_sts)
	{
		$sql = "UPDATE ms_tst_acc_master SET acc_sts='$acc_sts' WHERE acc_id='$acc_id'";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
}

class AbsenTest
{
	function abs_masuk($abs_masuk, $abs_ip, $abs_tgl_masuk, $abs_shift, $abs_rwd_masuk, $abs_point, $kar_id)
	{
		$sql = "INSERT INTO tst_abs_master VALUES(NULL,'$abs_masuk','','$abs_ip','$abs_tgl_masuk','','','','M','$abs_shift','$abs_rwd_masuk','','$abs_point','$kar_id')";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	function abs_masuk_telat($abs_masuk, $abs_ip, $abs_tgl_masuk, $abs_alasan_masuk, $abs_shift, $abs_rwd_masuk, $abs_point, $kar_id)
	{
		$sql = "INSERT INTO tst_abs_master VALUES(NULL,'$abs_masuk','','$abs_ip','$abs_tgl_masuk','','$abs_alasan_masuk','','M','$abs_shift','$abs_rwd_masuk','','$abs_point','$kar_id')";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	function abs_pulang($abs_pulang, $abs_ip, $abs_tgl_pulang, $abs_rwd_pulang, $abs_point, $kar_id, $abs_tgl_masuk)
	{
		$sql = "UPDATE tst_abs_master SET abs_pulang='$abs_pulang',abs_sts='P',abs_tgl_pulang='$abs_tgl_pulang',abs_rwd_pulang='$abs_rwd_pulang',abs_point='$abs_point',abs_ip='$abs_ip' WHERE kar_id='$kar_id' AND abs_tgl_masuk='$abs_tgl_masuk'";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	function abs_pulang_cepat($abs_pulang, $abs_ip, $abs_tgl_pulang, $abs_alasan_pulang, $abs_rwd_pulang, $abs_point, $kar_id, $abs_tgl_masuk)
	{
		$sql = "UPDATE tst_abs_master SET abs_pulang='$abs_pulang',abs_alasan_pulang='$abs_alasan_pulang',abs_sts='P',abs_tgl_pulang='$abs_tgl_pulang',abs_rwd_pulang='$abs_rwd_pulang',abs_point='$abs_point',abs_ip='$abs_ip' WHERE kar_id='$kar_id' AND abs_tgl_masuk='$abs_tgl_masuk'";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	function abs_tampil_kar_location($kar_id_, $date)
	{
		$sql = "SELECT * FROM tst_abs_master WHERE kar_id='$kar_id_' AND abs_tgl_masuk='$date' ORDER BY abs_id";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	function abs_tampil_kar_location_array($date)
	{
		$sql = "SELECT * FROM tst_abs_master WHERE abs_tgl_masuk='$date' ORDER BY abs_id";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	function abs_tampil_kar($kar_idtst, $abs_tgl_masuk)
	{
		$sql = "SELECT * FROM tst_abs_master WHERE kar_id='$kar_idtst' AND abs_tgl_masuk='$abs_tgl_masuk' ORDER BY abs_id";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	function abs_tampil_kar_2($kar_id, $abs_tgl_start, $abs_tgl_end)
	{
		$sql = "SELECT * FROM tst_abs_master WHERE kar_id='$kar_id' AND abs_tgl_masuk BETWEEN '$abs_tgl_start' AND '$abs_tgl_end' ORDER BY abs_id";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	function abs_tampil_allkar_2($div_id, $abs_tgl_start, $abs_tgl_end)
	{
		$sql = "SELECT * FROM tst_abs_master AS A,kar_master AS B WHERE A.kar_id=B.kar_id AND A.abs_tgl_masuk BETWEEN '$abs_tgl_start' AND '$abs_tgl_end' AND B.div_id='$div_id' ORDER BY abs_id";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	function abs_tampil_las($kar_id, $abs_tgl_las)
	{
		$sql = "SELECT * FROM tst_abs_master WHERE kar_id='$kar_id' AND abs_tgl_masuk='$abs_tgl_las' ORDER BY abs_id";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	function abs_tampil_tgl($abs_tgl_masuk)
	{
		$sql = "SELECT * FROM tst_abs_master WHERE abs_tgl_masuk='$abs_tgl_masuk' ORDER BY abs_id DESC";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	function abs_tampil_tgl_masuk($abs_tgl_masuk)
	{
		$sql = "SELECT * FROM tst_abs_master WHERE abs_tgl_masuk='$abs_tgl_masuk' AND abs_sts='M' ORDER BY abs_id";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	function abs_tampil_tgl_pulang($abs_tgl_masuk)
	{
		$sql = "SELECT * FROM tst_abs_master WHERE abs_tgl_masuk='$abs_tgl_masuk' AND abs_sts='P' ORDER BY abs_id";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	function abs_tampil()
	{
		$sql = "SELECT * FROM tst_abs_master ORDER BY abs_id";
		$query = mysql_query($sql) or die(mysql_error());
		while ($row = mysql_fetch_array($query))
			$data[] = $row;
		return $data;
	}
	function abs_ip_konfirm($abs_id, $abs_ip)
	{
		$sql = "UPDATE tst_abs_master SET abs_ip='$abs_ip' WHERE abs_id='$abs_id'";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	function abs_tampil_acc($kar_id)
	{
		$sql = "SELECT * FROM tst_abs_master WHERE kar_id='$kar_id' ORDER BY abs_id DESC LIMIT 0,7";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	function abs_tampil_rwd($abs_rwd_masuk, $abs_tgl_masuk)
	{
		$sql = "SELECT * FROM tst_abs_master WHERE abs_rwd_masuk='$abs_rwd_masuk' AND abs_tgl_masuk='$abs_tgl_masuk' ORDER BY abs_id";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	function abs_dtl_tampil($kar_id_, $abs_dtl_tgl)
	{
		$sql = "SELECT * FROM tst_abs_detail WHERE kar_id='$kar_id_' AND abs_dtl_tgl='$abs_dtl_tgl' ORDER BY abs_dtl_id";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	function abs_dtl_kar_id($kar_id_, $abs_dtl_tgl)
	{
		$sql = "SELECT kar_id FROM tst_abs_detail WHERE kar_id='$kar_id_' AND abs_dtl_tgl='$abs_dtl_tgl' ORDER BY abs_dtl_id ASC LIMIT 1";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	function abs_dtl_tampil_array($abs_dtl_tgl)
	{
		$sql = "SELECT * FROM tst_abs_detail WHERE abs_dtl_tgl='$abs_dtl_tgl' ORDER BY abs_dtl_id";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	function abs_dtl_insert($abs_dtl_tgl, $abs_dtl_sts, $kar_id)
	{
		$sql = "INSERT INTO tst_abs_detail VALUES(NULL,'$abs_dtl_tgl','$abs_dtl_sts','','','$kar_id')";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	function abs_dtl_update($abs_dtl_tgl, $abs_dtl_sts, $kar_id)
	{
		$sql = "UPDATE tst_abs_detail SET abs_dtl_sts='$abs_dtl_sts' WHERE abs_dtl_tgl='$abs_dtl_tgl' AND kar_id='$kar_id'";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	function abs_dtl_insert_full($abs_dtl_tgl, $abs_dtl_sts, $abs_dtl_type, $ktr_id, $kar_id)
	{
		$sql = "INSERT INTO tst_abs_detail VALUES(NULL,'$abs_dtl_tgl','$abs_dtl_sts','$abs_dtl_type','$ktr_id','$kar_id')";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	function abs_dtl_tampil_sts($abs_dtl_sts, $abs_dtl_tgl)
	{
		$sql = "SELECT * FROM tst_abs_detail WHERE abs_dtl_tgl='$abs_dtl_tgl' AND abs_dtl_sts='$abs_dtl_sts' ORDER BY abs_dtl_id";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	function abs_settime_id($abs_stm_nm)
	{
		$sql = "SELECT * FROM tst_abs_settime WHERE abs_stm_nm='$abs_stm_nm' ORDER BY abs_stm_id";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	function abs_stm_update($abs_stm_jam, $abs_stm_id)
	{
		$sql = "UPDATE tst_abs_settime SET abs_stm_jam='$abs_stm_jam' WHERE abs_stm_id='$abs_stm_id'";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	function abs_sort_tgl($tgl_awal, $tgl_akhir)
	{
		$sql = "SELECT * FROM tst_abs_master WHERE abs_tgl_masuk BETWEEN '$tgl_awal' AND '$tgl_akhir' ORDER BY abs_id";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	function abs_dtl_sort_tgl($kar_id_, $tgl_awal, $tgl_akhir)
	{
		$sql = "SELECT * FROM tst_abs_detail WHERE kar_id='$kar_id_' AND abs_dtl_tgl BETWEEN '$tgl_awal' AND '$tgl_akhir' ORDER BY abs_dtl_id";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	function abs_tampil_rwd_sort($abs_rwd_masuk, $tgl_awal, $tgl_akhir)
	{
		$sql = "SELECT * FROM tst_abs_master WHERE abs_rwd_masuk='$abs_rwd_masuk' AND abs_tgl_masuk BETWEEN '$tgl_awal' AND '$tgl_akhir' ORDER BY abs_id";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	function abs_dtl_tampil_sts_sort($abs_dtl_sts, $tgl_awal, $tgl_akhir)
	{
		$sql = "SELECT * FROM tst_abs_detail WHERE abs_dtl_sts='$abs_dtl_sts' AND abs_dtl_tgl BETWEEN '$tgl_awal' AND '$tgl_akhir'  ORDER BY abs_dtl_id";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	function abs_point_update($abs_id, $abs_point)
	{
		$sql = "UPDATE tst_abs_master SET abs_point='$abs_point' WHERE abs_id='$abs_id'";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	function abs_tgl_rpt()
	{
		$sql = "SELECT * FROM abs_tanggal ORDER BY abs_tgl_id";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	function abs_tgl_rpt_bln($kar_id_, $tgl_1, $tgl_31)
	{
		$sql = "SELECT * FROM tst_abs_master WHERE kar_id='$kar_id_' AND abs_tgl_masuk BETWEEN '$tgl_1' AND '$tgl_31' ORDER BY abs_id";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	function abs_tgl_rpt_point($kar_id_, $tgl_1, $tgl_31)
	{
		$sql = "SELECT SUM(abs_point) AS point FROM tst_abs_master WHERE kar_id='$kar_id_' AND abs_point!='0' AND abs_tgl_masuk BETWEEN '$tgl_1' AND '$tgl_31' ORDER BY abs_id";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	function abs_tgl_rpt_bln_array($tgl_1, $tgl_31)
	{
		$sql = "SELECT COUNT(DISTINCT abs_tgl_masuk) AS num_rows,kar_id FROM `tst_abs_master` WHERE abs_tgl_masuk BETWEEN '$tgl_1' AND '$tgl_31' GROUP BY kar_id";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	function abs_tgl_rpt_point_array($tgl_1, $tgl_31)
	{
		$sql = "SELECT COUNT(DISTINCT abs_tgl_masuk) AS num_rows, SUM(abs_point) AS point,kar_id FROM tst_abs_master WHERE abs_point!='0' AND abs_tgl_masuk BETWEEN '$tgl_1' AND '$tgl_31' GROUP BY kar_id";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	function abs_masuk_update($edt_abs_masuk, $edt_abs_id)
	{
		$sql = "UPDATE tst_abs_master SET abs_masuk='$edt_abs_masuk' WHERE abs_id='$edt_abs_id'";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	function abs_abs($abs_tgl_masuk)
	{
		$sql = "SELECT
				a.kar_id,
				a.kar_nik,
				a.kar_nm 
			FROM
				kar_master a
				LEFT JOIN tst_kar_detail b ON a.kar_id = b.kar_id 
			WHERE
				b.kar_dtl_typ_krj <> 'Resign' AND b.kar_dtl_sts_krj ='A'
				AND a.kar_id NOT IN ( SELECT kar_id FROM tst_abs_master c WHERE c.abs_tgl_masuk = '$abs_tgl_masuk' )
			ORDER BY
				a.kar_id";
		//echo $sql; 
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
}

class KaryawanTest
{
	function kar_nik($kdawal)
	{
		$sql = "SELECT MAX(kar_nik) AS max_nik FROM tst_kar_master WHERE kar_nik LIKE '$kdawal%'";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	function kar_nik_auto()
	{
		$sql = "SELECT MAX(kar_id) AS max_nik_auto FROM tst_kar_master";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	function kar_tampil()
	{
		$sql = "SELECT * FROM 
			  tst_kar_master,
			  jbt_master,
			  lvl_master,
			  div_master,
			  unt_master,
			  ktr_master
		 	  WHERE 
			  tst_kar_master.jbt_id=jbt_master.jbt_id AND 
			  tst_kar_master.lvl_id=lvl_master.lvl_id AND
			  tst_kar_master.div_id=div_master.div_id AND
			  tst_kar_master.unt_id=unt_master.unt_id AND
			  tst_kar_master.ktr_id=ktr_master.ktr_id 
			  ORDER BY kar_id
			  ";
		$query = mysql_query($sql) or die(mysql_error());
		while ($row = mysql_fetch_array($query))
			$data[] = $row;
		return $data;
	}
	function kar_tampil_aktif()
	{
		$sql = "SELECT * FROM 
			  tst_kar_master,
			  jbt_master,
			  lvl_master,
			  div_master,
			  unt_master,
			  ktr_master,
			  tst_kar_detail
		 	  WHERE 
			  tst_kar_master.jbt_id=jbt_master.jbt_id AND 
			  tst_kar_master.lvl_id=lvl_master.lvl_id AND
			  tst_kar_master.div_id=div_master.div_id AND
			  tst_kar_master.unt_id=unt_master.unt_id AND
			  tst_kar_master.ktr_id=ktr_master.ktr_id AND
			  tst_kar_master.kar_id=tst_kar_detail.kar_id AND
			  tst_kar_detail.kar_dtl_typ_krj <> 'Resign'
			  ORDER BY tst_kar_master.kar_id
			  ";
		$query = mysql_query($sql) or die(mysql_error());
		while ($row = mysql_fetch_array($query))
			$data[] = $row;
		return $data;
	}
	function kar_tampil_2()
	{
		$sql = "SELECT * FROM 
			  tst_kar_master,
			  jbt_master,
			  lvl_master,
			  div_master,
			  unt_master,
			  ktr_master
		 	  WHERE 
			  tst_kar_master.jbt_id=jbt_master.jbt_id AND 
			  tst_kar_master.lvl_id=lvl_master.lvl_id AND
			  tst_kar_master.div_id=div_master.div_id AND
			  tst_kar_master.unt_id=unt_master.unt_id AND
			  tst_kar_master.ktr_id=ktr_master.ktr_id 
			  ORDER BY kar_id
			  ";
		$query = mysql_query($sql) or die(mysql_error());
		while ($row = mysql_fetch_array($query))
			$data[] = $row;
		return $data;
	}
	function kar_tampil_3()
	{
		$sql = "SELECT * FROM 
			  tst_kar_master,
			  jbt_master,
			  lvl_master,
			  div_master,
			  unt_master,
			  ktr_master
		 	  WHERE 
			  tst_kar_master.jbt_id=jbt_master.jbt_id AND 
			  tst_kar_master.lvl_id=lvl_master.lvl_id AND
			  tst_kar_master.div_id=div_master.div_id AND
			  tst_kar_master.unt_id=unt_master.unt_id AND
			  tst_kar_master.ktr_id=ktr_master.ktr_id 
			  ORDER BY kar_id
			  ";
		$query = mysql_query($sql) or die(mysql_error());
		while ($row = mysql_fetch_array($query))
			$data[] = $row;
		return $data;
	}
	function kar_tampil_filter()
	{
		$sql = "SELECT * FROM 
			  tst_kar_master,
			  jbt_master,
			  lvl_master,
			  div_master,
			  unt_master,
			  ktr_master
		 	  WHERE 
			  tst_kar_master.jbt_id=jbt_master.jbt_id AND 
			  tst_kar_master.lvl_id=lvl_master.lvl_id AND
			  tst_kar_master.div_id=div_master.div_id AND
			  tst_kar_master.unt_id=unt_master.unt_id AND
			  tst_kar_master.ktr_id=ktr_master.ktr_id AND
			  div_master.div_nm <> 'Komisaris' AND
			  div_master.div_nm <> 'Komite' AND
			  div_master.div_nm <> 'Direksi' AND
			  lvl_master.lvl_nm <> 'Komisaris' AND
			  lvl_master.lvl_nm <> 'Komite' AND
			  lvl_master.lvl_nm <> 'Direksi'
			  ORDER BY kar_id
			  ";
		$query = mysql_query($sql) or die(mysql_error());
		while ($row = mysql_fetch_array($query))
			$data[] = $row;
		return $data;
	}
	function kar_tampil_filter_2()
	{
		$sql = "SELECT * FROM 
			  tst_kar_master,
			  jbt_master,
			  lvl_master,
			  div_master,
			  unt_master,
			  ktr_master
		 	  WHERE 
			  tst_kar_master.jbt_id=jbt_master.jbt_id AND 
			  tst_kar_master.lvl_id=lvl_master.lvl_id AND
			  tst_kar_master.div_id=div_master.div_id AND
			  tst_kar_master.unt_id=unt_master.unt_id AND
			  tst_kar_master.ktr_id=ktr_master.ktr_id AND
			  div_master.div_nm <> 'Komisaris' AND
			  lvl_master.lvl_nm <> 'Komisaris'
			  ORDER BY kar_id
			  ";
		$query = mysql_query($sql) or die(mysql_error());
		while ($row = mysql_fetch_array($query))
			$data[] = $row;
		return $data;
	}
	function kar_tampil_id_tst($kar_idtst)
	{
		$sql = "SELECT * FROM 
			  tst_kar_master,
			  jbt_master,
			  lvl_master,
			  div_master,
			  unt_master,
			  ktr_master
		 	  WHERE 
			  tst_kar_master.jbt_id=jbt_master.jbt_id AND 
			  tst_kar_master.lvl_id=lvl_master.lvl_id AND
			  tst_kar_master.div_id=div_master.div_id AND
			  tst_kar_master.unt_id=unt_master.unt_id AND
			  tst_kar_master.ktr_id=ktr_master.ktr_id AND
			  tst_kar_master.kar_id='$kar_idtst'
			  ORDER BY kar_id
			  ";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
		echo $sql;
	}
	function kar_tampil_username($username)
	{
		$sql = "SELECT * FROM 
			  tst_kar_master,
			  jbt_master,
			  lvl_master,
			  div_master,
			  unt_master,
			  ktr_master
		 	  WHERE 
			  tst_kar_master.jbt_id=jbt_master.jbt_id AND 
			  tst_kar_master.lvl_id=lvl_master.lvl_id AND
			  tst_kar_master.div_id=div_master.div_id AND
			  tst_kar_master.unt_id=unt_master.unt_id AND
			  tst_kar_master.ktr_id=ktr_master.ktr_id AND
			  tst_kar_master.kar_nik='$username'
			  ORDER BY kar_id
			  ";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	function kar_insert($kar_nik, $kar_nm, $kar_tgl_lahir, $div_id, $jbt_id, $lvl_id, $unt_id, $ktr_id, $kot_id)
	{
		$sql = "INSERT INTO tst_kar_master VALUES(NULL,'$kar_nik','$kar_nm','$kar_tgl_lahir','U','$div_id','$jbt_id','$lvl_id','$unt_id','$ktr_id','$kot_id',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'0',NULL,'N','0')";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	function kar_delete($kar_id)
	{
		$sql = "DELETE FROM tst_kar_master WHERE kar_id='$kar_id'";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	function kar_update($kar_id, $kar_nm, $kar_tgl_lahir, $div_id, $jbt_id, $lvl_id, $unt_id, $ktr_id, $kot_id)
	{
		$sql = "UPDATE tst_kar_master SET kar_nm='$kar_nm',kar_tgl_lahir='$kar_tgl_lahir',jbt_id='$jbt_id',lvl_id='$lvl_id',div_id='$div_id',unt_id='$unt_id',ktr_id='$ktr_id',kot_id='$kot_id' WHERE kar_id='$kar_id'";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	function kar_update_shift($kar_id, $shiftextra)
	{
		if ($shiftextra == 'true') {
			$kar_default_shift2_in = '12:00:00';
			$kar_default_shift2_out = '20:00:00';
			$sql = "UPDATE tst_kar_master SET kar_default_shift2_in='$kar_default_shift2_in',kar_default_shift2_out='$kar_default_shift2_out' WHERE kar_id='$kar_id'";
		} else {
			$sql = "UPDATE tst_kar_master SET kar_default_shift2_in=NULL,kar_default_shift2_out=NULL WHERE kar_id='$kar_id'";
		}
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	function kar_update_disable_pulang($kar_id, $disablecheck)
	{
		if ($disablecheck == 'true') {
			$sql = "UPDATE tst_kar_master SET kar_disable_pulang='Y' WHERE kar_id='$kar_id'";
		} else {
			$sql = "UPDATE tst_kar_master SET kar_disable_pulang='N' WHERE kar_id='$kar_id'";
		}
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	function kar_tampil_pvl_user()
	{
		$sql = "SELECT * FROM 
			  tst_kar_master,
			  jbt_master,
			  lvl_master,
			  div_master,
			  unt_master,
			  ktr_master,
			  tst_kar_detail
		 	  WHERE 
			  tst_kar_master.jbt_id=jbt_master.jbt_id AND 
			  tst_kar_master.lvl_id=lvl_master.lvl_id AND
			  tst_kar_master.div_id=div_master.div_id AND
			  tst_kar_master.unt_id=unt_master.unt_id AND
			  tst_kar_master.ktr_id=ktr_master.ktr_id AND
			  tst_kar_master.kar_id=tst_kar_detail.kar_id AND
			  tst_kar_detail.kar_dtl_typ_krj <> 'Resign' AND
			  tst_kar_master.kar_pvl='U'
			  ORDER BY tst_kar_master.kar_id
			  ";
		$query = mysql_query($sql) or die(mysql_error());
		while ($row = mysql_fetch_array($query))
			$data[] = $row;
		return $data;
	}
	function kar_tampil_pvl_admin()
	{
		$sql = "SELECT * FROM 
			  tst_kar_master,
			  jbt_master,
			  lvl_master,
			  div_master,
			  unt_master,
			  ktr_master,
			  tst_kar_detail
		 	  WHERE 
			  tst_kar_master.jbt_id=jbt_master.jbt_id AND 
			  tst_kar_master.lvl_id=lvl_master.lvl_id AND
			  tst_kar_master.div_id=div_master.div_id AND
			  tst_kar_master.unt_id=unt_master.unt_id AND
			  tst_kar_master.ktr_id=ktr_master.ktr_id AND
			  tst_kar_master.kar_id=tst_kar_detail.kar_id AND
			  tst_kar_detail.kar_dtl_typ_krj <> 'Resign' AND
			  tst_kar_master.kar_pvl='A'
			  ORDER BY tst_kar_master.kar_id
			  ";
		$query = mysql_query($sql) or die(mysql_error());
		while ($row = mysql_fetch_array($query))
			$data[] = $row;
		return $data;
	}
	function kar_tampil_pvl_super_admin()
	{
		$sql = "SELECT * FROM 
			  tst_kar_master,
			  jbt_master,
			  lvl_master,
			  div_master,
			  unt_master,
			  ktr_master,
			  tst_kar_detail
		 	  WHERE 
			  tst_kar_master.jbt_id=jbt_master.jbt_id AND 
			  tst_kar_master.lvl_id=lvl_master.lvl_id AND
			  tst_kar_master.div_id=div_master.div_id AND
			  tst_kar_master.unt_id=unt_master.unt_id AND
			  tst_kar_master.ktr_id=ktr_master.ktr_id AND
			  tst_kar_master.kar_id=tst_kar_detail.kar_id AND
			  tst_kar_detail.kar_dtl_typ_krj <> 'Resign' AND
			  tst_kar_master.kar_pvl='S'
			  ORDER BY tst_kar_master.kar_id
			  ";
		$query = mysql_query($sql) or die(mysql_error());
		while ($row = mysql_fetch_array($query))
			$data[] = $row;
		return $data;
	}
	function kar_update_pvl($kar_id, $kar_pvl)
	{
		$sql = "UPDATE tst_kar_master SET kar_pvl='$kar_pvl' WHERE kar_id='$kar_id'";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	function kar_tampil_div($div_id)
	{
		$sql = "SELECT * FROM 
			  tst_kar_master,
			  div_master
		 	  WHERE 
			  tst_kar_master.div_id=div_master.div_id AND
			  tst_kar_master.div_id='$div_id'
			  ORDER BY kar_id
			  ";
		$query = mysql_query($sql) or die(mysql_error());
		while ($row = mysql_fetch_array($query))
			$data[] = $row;
		return $data;
	}
	function kar_update_location($kar_id, $ktr_id_, $unt_id_)
	{
		$sql = "UPDATE tst_kar_master SET ktr_id='$ktr_id_',unt_id='$unt_id_' WHERE kar_id='$kar_id'";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	function kar_tampil_location($ktr_id_, $unt_id_)
	{
		$sql = "SELECT * FROM tst_kar_master WHERE ktr_id='$ktr_id_' AND unt_id='$unt_id_' ORDER BY kar_id";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	function kar_tampil_detail($kar_id)
	{
		$sql = "SELECT * FROM tst_kar_detail WHERE kar_id='$kar_id' ORDER BY kar_id";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	function kar_update_employee($kar_dtl_sts_krj, $kar_dtl_typ_krj, $kar_dtl_tgl_joi, $kar_dtl_msa_krj, $kar_dtl_tgl_res, $kar_dtl_als_res, $kar_id)
	{
		$sql = "UPDATE tst_kar_detail SET kar_dtl_sts_krj='$kar_dtl_sts_krj',kar_dtl_typ_krj='$kar_dtl_typ_krj',kar_dtl_tgl_joi='$kar_dtl_tgl_joi',kar_dtl_msa_krj='$kar_dtl_msa_krj',kar_dtl_tgl_res='$kar_dtl_tgl_res',kar_dtl_als_res='$kar_dtl_als_res' WHERE kar_id='$kar_id'";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	function kar_insert_employee($kar_dtl_sts_krj, $kar_dtl_typ_krj, $kar_dtl_tgl_joi, $kar_dtl_msa_krj, $kar_dtl_tgl_res, $kar_dtl_als_res, $kar_id)
	{
		$sql = "INSERT INTO tst_kar_detail VALUES(NULL,'$kar_dtl_sts_krj','$kar_dtl_typ_krj','$kar_dtl_tgl_joi','$kar_dtl_msa_krj','$kar_dtl_tgl_res','$kar_dtl_als_res','','','','','','','','','','','','','','','','','','','','','','','$kar_id')";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	function kar_update_bio($kar_dtl_usa, $kar_dtl_gen, $kar_dtl_tmp_lhr, $kar_dtl_sts_nkh, $kar_dtl_jml_ank, $kar_dtl_tgn, $kar_id)
	{
		$sql = "UPDATE tst_kar_detail SET kar_dtl_usa='$kar_dtl_usa',kar_dtl_gen='$kar_dtl_gen',kar_dtl_tmp_lhr='$kar_dtl_tmp_lhr',kar_dtl_sts_nkh='$kar_dtl_sts_nkh',kar_dtl_jml_ank='$kar_dtl_jml_ank',kar_dtl_tgn='$kar_dtl_tgn' WHERE kar_id='$kar_id'";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	function kar_insert_bio($kar_dtl_usa, $kar_dtl_gen, $kar_dtl_tmp_lhr, $kar_dtl_sts_nkh, $kar_dtl_jml_ank, $kar_dtl_tgn, $kar_id)
	{
		$sql = "INSERT INTO tst_kar_detail VALUES(NULL,'','','','','','','$kar_dtl_usa','$kar_dtl_gen','$kar_dtl_tmp_lhr','$kar_dtl_sts_nkh','$kar_dtl_jml_ank','$kar_dtl_tgn','','','','','','','','','','','','','','','','','$kar_id')";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	function kar_update_education($kar_dtl_pnd, $kar_dtl_jrs, $kar_dtl_unv_sch, $kar_dtl_sts_pnd, $kar_dtl_thn_lls, $kar_id)
	{
		$sql = "UPDATE tst_kar_detail SET kar_dtl_pnd='$kar_dtl_pnd',kar_dtl_jrs='$kar_dtl_jrs',kar_dtl_unv_sch='$kar_dtl_unv_sch',kar_dtl_sts_pnd='$kar_dtl_sts_pnd',kar_dtl_thn_lls='$kar_dtl_thn_lls' WHERE kar_id='$kar_id'";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	function kar_insert_education($kar_dtl_pnd, $kar_dtl_jrs, $kar_dtl_unv_sch, $kar_dtl_sts_pnd, $kar_dtl_thn_lls, $kar_id)
	{
		$sql = "INSERT INTO tst_kar_detail VALUES(NULL,'','','','','','','','','','','','','$kar_dtl_pnd','$kar_dtl_jrs','$kar_dtl_unv_sch','$kar_dtl_sts_pnd','$kar_dtl_thn_lls','','','','','','','','','','','','$kar_id')";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	function kar_update_card($kar_dtl_no_ktp, $kar_dtl_exp_ktp, $kar_dtl_no_kk, $kar_dtl_no_npw, $kar_dtl_no_kpj, $kar_dtl_no_rek, $kar_dtl_no_bpj, $kar_dtl_no_jms, $kar_id)
	{
		$sql = "UPDATE tst_kar_detail SET kar_dtl_no_ktp='$kar_dtl_no_ktp',kar_dtl_exp_ktp='$kar_dtl_exp_ktp',kar_dtl_no_kk='$kar_dtl_no_kk',kar_dtl_no_npw='$kar_dtl_no_npw',kar_dtl_no_kpj='$kar_dtl_no_kpj',kar_dtl_no_rek='$kar_dtl_no_rek',kar_dtl_no_bpj='$kar_dtl_no_bpj',kar_dtl_no_jms='$kar_dtl_no_jms' WHERE kar_id='$kar_id'";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	function kar_insert_card($kar_dtl_no_ktp, $kar_dtl_exp_ktp, $kar_dtl_no_kk, $kar_dtl_no_npw, $kar_dtl_no_kpj, $kar_dtl_no_rek, $kar_dtl_no_bpj, $kar_dtl_no_jms, $kar_id)
	{
		$sql = "INSERT INTO tst_kar_detail VALUES(NULL,'','','','','','','','','','','','','','','','','','$kar_dtl_no_ktp','$kar_dtl_exp_ktp','$kar_dtl_no_kk','$kar_dtl_no_npw','$kar_dtl_no_kpj','$kar_dtl_no_rek','$kar_dtl_no_bpj','$kar_dtl_no_jms','','','','$kar_id')";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	function kar_update_contact($kar_dtl_eml, $kar_dtl_tlp, $kar_dtl_alt, $kar_id)
	{
		$sql = "UPDATE tst_kar_detail SET kar_dtl_eml='$kar_dtl_eml',kar_dtl_tlp='$kar_dtl_tlp',kar_dtl_alt='$kar_dtl_alt' WHERE kar_id='$kar_id'";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	function kar_insert_contact($kar_dtl_eml, $kar_dtl_tlp, $kar_dtl_alt, $kar_id)
	{
		$sql = "INSERT INTO tst_kar_detail VALUES(NULL,'','','','','','','','','','','','','','','','','','','','','','','','','','$kar_dtl_eml','$kar_dtl_tlp','$kar_dtl_alt','$kar_id')";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	function kar_tampil_typ($kar_dtl_typ_krj)
	{
		$sql = "SELECT * FROM tst_kar_master,tst_kar_detail WHERE tst_kar_master.kar_id=tst_kar_detail.kar_id AND tst_kar_detail.kar_dtl_typ_krj='$kar_dtl_typ_krj' AND tst_kar_detail.kar_dtl_typ_krj!='' ORDER BY tst_kar_master.kar_id";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	function kar_tampil_sts($kar_dtl_sts_krj)
	{
		$sql = "SELECT * FROM tst_kar_master,tst_kar_detail WHERE tst_kar_master.kar_id=tst_kar_detail.kar_id AND tst_kar_detail.kar_dtl_sts_krj='$kar_dtl_sts_krj' AND tst_kar_detail.kar_dtl_sts_krj!='' ORDER BY tst_kar_master.kar_id";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	function kar_tampil_libur($id_karyawan)
	{
		$sql = "SELECT * FROM tst_kar_master WHERE kar_id NOT REGEXP '$id_karyawan' ORDER BY kar_id";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	function kar_tampil_kontrak()
	{
		$sql = "SELECT * FROM 
			  tst_kar_master,
			  jbt_master,
			  lvl_master,
			  div_master,
			  unt_master,
			  ktr_master,
			  tst_kar_detail
		 	  WHERE 
			  tst_kar_master.jbt_id=jbt_master.jbt_id AND 
			  tst_kar_master.lvl_id=lvl_master.lvl_id AND
			  tst_kar_master.div_id=div_master.div_id AND
			  tst_kar_master.unt_id=unt_master.unt_id AND
			  tst_kar_master.ktr_id=ktr_master.ktr_id AND
			  tst_kar_master.kar_id=tst_kar_detail.kar_id AND
			  tst_kar_detail.kar_dtl_typ_krj = 'Kontrak'
			  ORDER BY tst_kar_master.kar_id
			  ";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	function kar_tampil_uptodate()
	{
		$sql = "SELECT * FROM 
			  tst_kar_master,
			  jbt_master,
			  lvl_master,
			  div_master,
			  unt_master,
			  ktr_master,
			  tst_kar_detail
		 	  WHERE 
			  tst_kar_master.jbt_id=jbt_master.jbt_id AND 
			  tst_kar_master.lvl_id=lvl_master.lvl_id AND
			  tst_kar_master.div_id=div_master.div_id AND
			  tst_kar_master.unt_id=unt_master.unt_id AND
			  tst_kar_master.ktr_id=ktr_master.ktr_id AND
			  tst_kar_master.kar_id=tst_kar_detail.kar_id AND
			  div_master.div_nm <> 'Komisaris' AND
			  div_master.div_nm <> 'Komite' AND
			  div_master.div_nm <> 'Direksi' AND
			  lvl_master.lvl_nm <> 'Komisaris' AND
			  lvl_master.lvl_nm <> 'Komite' AND
			  lvl_master.lvl_nm <> 'Direksi' AND
			  tst_kar_detail.kar_dtl_typ_krj <> 'Resign'
			  ORDER BY tst_kar_master.kar_id
			  ";
		$query = mysql_query($sql) or die(mysql_error());
		while ($row = mysql_fetch_array($query))
			$data[] = $row;
		return $data;
	}
	function kar_tampil_uptodate_unit()
	{
		$sql = "SELECT * FROM 
			  tst_kar_master,
			  lvl_master,
			  div_master,
			  unt_master,
			  ktr_master,
			  tst_kar_detail
		 	  WHERE 
			  tst_kar_master.lvl_id=lvl_master.lvl_id AND
			  tst_kar_master.div_id=div_master.div_id AND
			  tst_kar_master.unt_id=unt_master.unt_id AND
			  tst_kar_master.unt_id='2' AND
			  tst_kar_master.ktr_id=ktr_master.ktr_id AND
			  tst_kar_master.kar_id=tst_kar_detail.kar_id AND
			  div_master.div_nm <> 'Komisaris' AND
			  div_master.div_nm <> 'Komite' AND
			  div_master.div_nm <> 'Direksi' AND
			  div_master.div_nm <> 'Marketing' AND
			  div_master.div_nm <> 'Umum' AND
			  lvl_master.lvl_nm <> 'Komisaris' AND
			  lvl_master.lvl_nm <> 'Komite' AND
			  lvl_master.lvl_nm <> 'Direksi' AND
			  tst_kar_detail.kar_dtl_typ_krj <> 'Resign'
			  ORDER BY tst_kar_master.kar_id
			  ";
		$query = mysql_query($sql) or die(mysql_error());
		while ($row = mysql_fetch_array($query))
			$data[] = $row;
		return $data;
	}
	function kar_tampil_uptodate_unit2()
	{
		$sql = "SELECT * FROM 
			  tst_kar_master,
			  jbt_master,
			  lvl_master,
			  div_master,
			  unt_master,
			  ktr_master,
			  tst_kar_detail
		 	  WHERE 
			  tst_kar_master.jbt_id=jbt_master.jbt_id AND 
			  tst_kar_master.lvl_id=lvl_master.lvl_id AND
			  tst_kar_master.div_id=div_master.div_id AND
			  tst_kar_master.unt_id=unt_master.unt_id AND
			  tst_kar_master.unt_id='2' AND
			  tst_kar_master.ktr_id=ktr_master.ktr_id AND
			  tst_kar_master.kar_id=tst_kar_detail.kar_id AND
			  div_master.div_nm <> 'Komisaris' AND
			  div_master.div_nm <> 'Komite' AND
			  div_master.div_nm <> 'Direksi' AND
			  div_master.div_nm <> 'Marketing' AND
			  div_master.div_nm <> 'Umum' AND
			  lvl_master.lvl_nm <> 'Komisaris' AND
			  lvl_master.lvl_nm <> 'Komite' AND
			  lvl_master.lvl_nm <> 'Direksi' AND
			  tst_kar_detail.kar_dtl_typ_krj <> 'Resign'
			  ORDER BY tst_kar_master.kar_id
			  ";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	function kar_update_jdwakses($kar_id, $kar_jdw_akses)
	{
		$sql = "UPDATE tst_kar_master SET kar_jdw_akses='$kar_jdw_akses' WHERE kar_id='$kar_id'";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	function kar_tampil_div_in($div_value)
	{
		$sql = "SELECT * FROM 
			  tst_kar_master,
			  div_master
		 	  WHERE 
			  tst_kar_master.div_id=div_master.div_id AND
			  tst_kar_master.div_id IN ($div_value)
			  ORDER BY tst_kar_master.kar_id
			  ";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	function kar_tampil_div_in_new($div_value)
	{
		$sql = "SELECT * FROM 
			  tst_kar_master,
			  tst_kar_detail,
			  div_master
		 	  WHERE
			  tst_kar_master.kar_id=tst_kar_detail.kar_id AND
			  tst_kar_master.div_id=div_master.div_id AND
			  tst_kar_master.div_id IN ($div_value) AND
			  tst_kar_master.kar_logika <> 1  AND
			  tst_kar_detail.kar_dtl_typ_krj <>'Resign'
			  ORDER BY tst_kar_master.kar_id
			  ";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	function kar_tampil_div_in_cs($div_value)
	{
		$sql = "SELECT * FROM 
			  tst_kar_master,
			  tst_kar_detail,
			  div_master
		 	  WHERE
			  tst_kar_master.kar_id=tst_kar_detail.kar_id AND
			  tst_kar_master.div_id=div_master.div_id AND
			  tst_kar_master.div_id IN ($div_value) AND
			  tst_kar_master.kar_logika <> 1  AND
			  tst_kar_detail.kar_dtl_typ_krj <>'Resign'
			  ORDER BY tst_kar_master.kar_id
			  ";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	function kar_tampil_div_in_cs_staff($div_value)
	{
		$sql = "SELECT * FROM 
			  tst_kar_master,
			  tst_kar_detail,
			  div_master
		 	  WHERE
			  tst_kar_master.kar_id=tst_kar_detail.kar_id AND
			  tst_kar_master.div_id=div_master.div_id AND
			  tst_kar_master.div_id IN ($div_value) AND
			  tst_kar_master.lvl_id='7' AND
			  tst_kar_master.kar_logika <> 1  AND
			  tst_kar_detail.kar_dtl_typ_krj <>'Resign'
			  ORDER BY tst_kar_master.kar_id
			  ";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	function kar_tampil_div_in_logika($logika_value)
	{
		$sql = "SELECT * FROM 
			  tst_kar_master,
			  tst_kar_detail,
			  div_master
		 	  WHERE
			  tst_kar_master.kar_id=tst_kar_detail.kar_id AND
			  tst_kar_master.div_id=div_master.div_id AND
			  tst_kar_master.kar_logika='$logika_value' AND
			  tst_kar_detail.kar_dtl_typ_krj <>'Resign'
			  ORDER BY tst_kar_master.kar_id
			  ";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	function kar_tampil_nik($kar_nik)
	{
		$sql = "SELECT * FROM tst_kar_master WHERE kar_nik = '$kar_nik' ORDER BY kar_id";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	function kar_sync_update($kar_nik, $datetime)
	{
		$sql = "UPDATE tst_kar_master SET kar_sync_date='$datetime' WHERE kar_nik='$kar_nik'";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	function kar_tampil_akses($kar_nik)
	{
		if ($kar_nik == "all") {
			$sql = "SELECT a.kar_id,a.kar_nik, a.kar_nm, c.div_nm FROM 
				  tst_kar_master a,
				  lvl_master b,
				  div_master c,
				  tst_kar_detail d
				  WHERE 
				  a.lvl_id=b.lvl_id AND
				  a.div_id=c.div_id AND
				  a.kar_id=d.kar_id AND
				  d.kar_dtl_typ_krj <> 'Resign'
				  ORDER BY a.kar_id
				  ";
		} else {
			$sql = "SELECT a.kar_id,a.kar_nik, a.kar_nm, c.div_nm FROM 
				tst_kar_master a,
				lvl_master b,
				div_master c,
				tst_kar_detail d
				WHERE 
				a.lvl_id=b.lvl_id AND
				a.div_id=c.div_id AND
				a.kar_id=d.kar_id AND
				a.kar_nik IN ('$kar_nik') AND 
				d.kar_dtl_typ_krj <> 'Resign'
				ORDER BY a.kar_id
				";
		}
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
}

class CheckPoint
{
	function chc_insert_masuk($abs_tgl_masuk, $chc_nik, $chc_nm, $time_test, $latlong, $status_radius, $location, $jarak, $idkaryawan)
	{
		$sql = "INSERT INTO checkpoint_master VALUES(NULL,'$abs_tgl_masuk','$chc_nik','$chc_nm','MASUK','$time_test','$latlong','$status_radius','$jarak','','','','','','','','','','','','','','$location','$idkaryawan')";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	function chc_update_checkpoint2($abs_tgl_masuk, $time_test, $latlong, $status_radius, $jarak, $idkaryawan)
	{
		$sql = "UPDATE checkpoint_master SET jam2='$time_test', checkpoint2 = '$latlong', status2='$status_radius', radius2='$jarak' WHERE tanggal ='$abs_tgl_masuk' AND kar_id='$idkaryawan'";
		//echo $sql;
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	function chc_update_checkpoint3($abs_tgl_masuk, $time_test, $latlong, $status_radius, $jarak, $idkaryawan)
	{
		$sql = "UPDATE checkpoint_master SET jam3='$time_test', checkpoint3 = '$latlong', status3='$status_radius', radius3='$jarak' WHERE tanggal ='$abs_tgl_masuk' AND kar_id='$idkaryawan'";
		//echo $sql;
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	function chc_tampil_tgl($chc_tgl_masuk)
	{
		$sql = "SELECT * FROM checkpoint_master WHERE tanggal='$chc_tgl_masuk' ORDER BY id DESC";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	function chc_tampil_kar($chc_tgl_masuk,$kar_id)
	{
		$sql = "SELECT * FROM checkpoint_master WHERE tanggal='$chc_tgl_masuk' AND kar_id = '$kar_id' ORDER BY id DESC";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
		
	}
	function chc_tampil_latlong_kar_wfo($kar_id)
	{
		$sql = "SELECT
				a.kar_id,
				a.kar_nik,
				a.kar_nm, 
				b.kar_long, 
				b.kar_lat, 
				b.kar_radius
			FROM
				kar_master a
				LEFT JOIN ktr_master b ON a.ktr_id = b.ktr_id 
			WHERE a.kar_id = '$kar_id'
			ORDER BY
				a.kar_id";
		$query = mysql_query($sql) or die(mysql_error());		
		return $query;
		//echo $sql;
	}
	function chc_tampil_latlong_kar_wfh($kar_id)
	{
		$sql = "SELECT
				kar_id,
				kar_nik,
				kar_nm, 
				kar_long, 
				kar_lat,
				kar_radius
			FROM
				kar_master 
			WHERE kar_id = '$kar_id'
			ORDER BY
				kar_id";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
		//echo $sql;
	}
	
	function chc_tampil_radius1($status1, $chc_tgl_masuk)
	{
		$sql = "SELECT * FROM checkpoint_master WHERE status1='$status1' AND tanggal='$chc_tgl_masuk' ORDER BY id";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	
	function chc_tampil_radius2($status2, $chc_tgl_masuk)
	{
		$sql = "SELECT * FROM checkpoint_master WHERE status2='$status2' AND tanggal='$chc_tgl_masuk' ORDER BY id";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	function chc_tampil_radius3($status3, $chc_tgl_masuk)
	{
		$sql = "SELECT * FROM checkpoint_master WHERE status3='$status3' AND tanggal='$chc_tgl_masuk' ORDER BY id";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	function chc_tampil_id($kar_id,$abs_tgl_masuk)
	{
		$sql = "SELECT * FROM checkpoint_master WHERE kar_id = '$kar_id' AND tanggal='$abs_tgl_masuk' ORDER BY id";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	
}

class NamaPT
{
	function npt_tampil()
	{
		$sql = "SELECT * FROM pt_master ORDER BY pt_id";
		$query = mysql_query($sql) or die(mysql_error());
		while ($row = mysql_fetch_array($query))
			$data[] = $row;
		return $data;
	}
	function npt_tampil_id($pt_id)
	{
		$sql = "SELECT * FROM pt_master WHERE pt_id='$pt_id' ORDER BY pt_id";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
}

class Izin
{
	function izn_history_kar($kar_id)
	{
		$sql = "SELECT * FROM izn_history WHERE kar_id='$kar_id' ORDER BY kph_id DESC";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	function izn_history_kar_limit($kar_id)
	{
		$sql = "SELECT * FROM izn_history WHERE kar_id='$kar_id' ORDER BY kph_id DESC LIMIT 1";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	function izn_history_insert($kph_kontrak, $kph_kode, $kph_start, $kph_end, $kph_keterangan, $kph_masa, $kph_data, $kar_id)
	{
		$sql = "INSERT INTO izn_history VALUES(NULL,'$kph_kontrak','$kph_kode','$kph_start','$kph_end','$kph_keterangan','$kph_masa','$kph_data','$kar_id')";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	function izn_history_update($kph_id, $kph_kontrak, $kph_start, $kph_end, $kph_keterangan, $kph_masa, $kph_data)
	{
		$sql = "UPDATE izn_history SET kph_kontrak='$kph_kontrak',kph_start='$kph_start',kph_end='$kph_end',kph_keterangan='$kph_keterangan',kph_masa='$kph_masa',kph_data='$kph_data' WHERE kph_id='$kph_id'";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	function izn_history_delete($kph_id_)
	{
		$sql = "DELETE FROM izn_history WHERE kph_id='$kph_id_'";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	function izn_kd_awal($kdawal)
	{
		$sql = "SELECT MAX(izn_id) AS max_kd FROM izn_master WHERE izn_kd LIKE '$kdawal%'";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	function izn_kd_auto()
	{
		$sql = "SELECT MAX(izn_id) AS max_kd_auto FROM izn_master";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	function izn_sasaran_div($kps_div)
	{
		$sql = "SELECT * FROM izn_sasaran WHERE kps_div='$kps_div' ORDER BY kps_id";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	function izn_point_jenis($kpb_jenis)
	{
		$sql = "SELECT * FROM izn_point WHERE kpb_jenis='$kpb_jenis' ORDER BY kpb_id";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	function izn_tampil_kar($kar_id)
	{
		//$sql = "SELECT * FROM izn_master WHERE kar_id='$kar_id' ORDER BY izn_id";
		$sql = "SELECT kar_nm,izn_kd,izn_durasi,izn_keterangan,izn_tanggal,izn_kirim,izn_sts
				FROM izn_master a
				LEFT JOIN kar_master b
				ON a.kar_id = b.kar_id
				WHERE a.kar_id='$kar_id'";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	function izn_tampil_tanggal($izn_kirim)
	{
		//$sql = "SELECT * FROM izn_master WHERE kar_id='$kar_id' ORDER BY izn_id";
		$sql = "SELECT * FROM izn_master a
				LEFT JOIN kar_master b
				ON a.kar_id = b.kar_id
				WHERE a.izn_kirim='$izn_kirim'";
				
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	function izn_insert($filed1,$izn_div,$new_kd,$izn_jenis,$izn_tanggal,$izn_durasi,$izn_keterangan,$izn_waktu1,$izn_waktu2,$izn_atasan,$izn_sts,$izn_sesi,$kar_id)
	{
		$sql = "INSERT INTO izn_master ($filed1) VALUES(NULL,'$izn_div','$new_kd','$izn_jenis','$izn_tanggal','$izn_durasi','$izn_keterangan','$izn_waktu1','$izn_waktu2','$izn_atasan','$izn_sts','$izn_sesi',NOW(),'$kar_id')";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	function izn_tampil_kode($izn_kd)
	{
		$sql = "SELECT * FROM izn_master WHERE md5(izn_kd)='$izn_kd' ORDER BY izn_id";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	function izn_sasaran_kode($kps_kd)
	{
		$sql = "SELECT * FROM izn_sasaran WHERE kps_kd='$kps_kd' ORDER BY kps_id";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	function izn_update($izn_id, $izn_tanggal, $izn_data, $izn_sts)
	{
		$sql = "UPDATE izn_master SET izn_tanggal='$izn_tanggal',izn_data='$izn_data',izn_sts='$izn_sts' WHERE izn_id='$izn_id'";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	function izn_update_2($izn_id, $izn_tanggal, $izn_data, $izn_skor, $izn_sts_skor, $izn_sts)
	{
		$sql = "UPDATE izn_master SET izn_tanggal='$izn_tanggal',izn_data='$izn_data',izn_skor='$izn_skor',izn_sts_skor='$izn_sts_skor',izn_sts='$izn_sts' WHERE izn_id='$izn_id'";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	function izn_update_sts($izn_id, $izn_sts)
	{
		$sql = "UPDATE izn_master SET izn_sts='$izn_sts' WHERE izn_id='$izn_id'";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	function izn_tampil_id($izn_id)
	{
		$sql = "SELECT * FROM izn_master WHERE md5(izn_kd)='$izn_id' ORDER BY izn_id";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	function izn_cek_history($izn_kontrak, $kar_id)
	{
		$sql = "SELECT * FROM `izn_master` WHERE izn_kontrak='$izn_kontrak' AND kar_id='$kar_id' ORDER BY izn_priode DESC LIMIT 1";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	/*
	function izn_atasan($div_id,$lvl_id)
	{
	
			$sql = "SELECT
				  kar_master.kar_id,
				  kar_master.kar_nik,
				  kar_master.kar_nm
				  FROM 
				  kar_master,
				  kar_detail
				  WHERE 
				  kar_master.kar_id=kar_detail.kar_id AND
				  kar_master.div_id='$div_id' AND
				  kar_master.lvl_id ='$lvl_id' AND
				  kar_detail.kar_dtl_typ_krj <> 'Resign'
				  ORDER BY kar_master.kar_id
				  ";
		
		$query = mysql_query($sql) or die(mysql_error());
		while ($row = mysql_fetch_array($query))
			$data[] = $row;
		return $data;
	}
	*/
	function izn_atasan()
	{
	
			$sql = "SELECT
				  kar_master.kar_id,
				  kar_master.kar_nik,
				  kar_master.kar_nm
				  FROM 
				  kar_master,
				  kar_detail
				  WHERE 
				  kar_master.kar_id=kar_detail.kar_id AND
				  kar_master.kar_id NOT IN('10','11','381','382') AND
				  kar_detail.kar_dtl_typ_krj <> 'Resign'
				  ORDER BY kar_master.kar_id
				  ";
		
		$query = mysql_query($sql) or die(mysql_error());
		while ($row = mysql_fetch_array($query))
			$data[] = $row;
		return $data;
	}
	function izn_atasan_direksi($div_id,$lvl_id)
	{
	
			$sql = "SELECT
				  kar_master.kar_id,
				  kar_master.kar_nik,
				  kar_master.kar_nm
				  FROM 
				  kar_master,
				  kar_detail
				  WHERE 
				  kar_master.kar_id=kar_detail.kar_id AND
				  kar_master.div_id='$div_id' AND
				  kar_master.lvl_id ='$lvl_id' AND
				  kar_detail.kar_dtl_typ_krj <> 'Resign'
				  ORDER BY kar_master.kar_id
				  ";
		
		$query = mysql_query($sql) or die(mysql_error());
		while ($row = mysql_fetch_array($query))
			$data[] = $row;
		return $data;
	}
}
class AW_Rekap_Sosmed{
	function aw_get_rekap($start_date,$end_date){
		// var_dump($start_date);die();
		// $sql = "SELECT 
		// 			wfd_aktifitas,
		// 			wfd_tanggal,
		// 			wfd_username,
		// 			wfd_nama, 
		// 			div_nm, 
		// 			wfd_keterangan,
		// 			group_concat(wfd_aksi SEPARATOR '-') as jumlah 
		// 		FROM (
		// 			SELECT 
		// 				wfd_aktifitas,
		// 				wfd_tanggal,
		// 				wfd_username,
		// 				wfd_nama,
		// 				wfd_keterangan,
		// 				concat(wfd_aktifitas,':', group_concat(wfd_aksi separator ',')) as wfd_aksi, 
		// 				kar_id 
		// 			FROM wfh_data 
		// 			JOIN (
		// 				SELECT 
		// 					wfh_aktifitas,
		// 					wfh_group 
		// 				FROM wfh_master
		// 			) as m 
		// 			ON wfh_data.wfd_aktifitas=m.wfh_aktifitas
		// 			WHERE m.wfh_group = 'Publikasi Media Sosial'
		// 			AND wfd_tanggal BETWEEN '$start_date' AND '$end_date'
		// 			GROUP BY wfd_aksi
		// 		) d 
		// 		JOIN (
		// 			SELECT 
		// 				wfh_aktifitas,
		// 				wfh_group 
		// 			FROM wfh_master
		// 		) as m 
		// 		ON d.wfd_aktifitas=m.wfh_aktifitas 
		// 		LEFT JOIN (
		// 			SELECT 
		// 				kar_id, 
		// 				div_id 
		// 			FROM kar_master
		// 		) km 
		// 		ON d.kar_id = km.kar_id 
		// 		JOIN div_master dm ON km.div_id = dm.div_id 
		// 		WHERE m.wfh_group = 'Publikasi Media Sosial' 
		// 		AND km.div_id ='8' 
		// 		AND wfd_tanggal BETWEEN '$start_date' AND '$end_date' 
		// 		GROUP BY wfd_tanggal,wfd_username ORDER BY wfd_username
			// ";
		// $sql="SELECT wfd_aktifitas,wfd_tanggal,wfd_username,wfd_nama, div_nm, wfd_keterangan,concat(wfd_aktifitas,':',group_concat(wfd_aksi SEPARATOR ',')) as wfd_aksi FROM wfh_data d JOIN (SELECT wfh_aktifitas,wfh_group FROM wfh_master) as m ON d.wfd_aktifitas=m.wfh_aktifitas LEFT JOIN (SELECT kar_id, div_id FROM kar_master) km ON d.kar_id = km.kar_id JOIN div_master dm ON km.div_id = dm.div_id WHERE m.wfh_group = 'Publikasi Media Sosial' AND km.div_id ='8' AND wfd_tanggal BETWEEN '$start_date' AND '$end_date' GROUP BY wfd_tanggal,wfd_username,wfd_aksi ORDER BY wfd_username";
		// $sql = "SELECT wfd_aktifitas,wfd_tanggal,wfd_username,wfd_nama, div_nm, SUM(wfd_value) as jumlah, wfd_keterangan FROM wfh_data d JOIN (SELECT wfh_aktifitas,wfh_group FROM wfh_master) as m ON d.wfd_aktifitas=m.wfh_aktifitas LEFT JOIN (SELECT kar_id, div_id FROM kar_master) km ON d.kar_id = km.kar_id JOIN div_master dm ON km.div_id = dm.div_id WHERE m.wfh_group = 'Publikasi Media Sosial' AND km.div_id ='8' AND wfd_tanggal BETWEEN '$start_date' AND '$end_date' GROUP BY wfd_tanggal,wfd_username ORDER BY wfd_username";
		$arr = array();
		$sql = "SELECT km.kar_nik,kar_nm,km.div_id,b.*,c.kar_dtl_typ_krj,group_concat(jumlah separator '-') as qqq FROM kar_master km
				LEFT JOIN (SELECT 
									wfd_aktifitas,
									wfd_tanggal,
									wfd_username,
									wfd_nama, 
									div_nm, 
									wfd_aksi,
									wfd_keterangan,
									group_concat(zzz SEPARATOR '-') as jumlah 
								FROM (
									SELECT 
										wfd_aktifitas,
										wfd_tanggal,
										wfd_username,
										wfd_nama,
										wfd_keterangan,
										wfd_aksi,
										concat(wfd_aktifitas,':', group_concat(wfd_aksi separator ',')) as zzz, 
										kar_id 
									FROM wfh_data 
									JOIN (
										SELECT 
											wfh_aktifitas,
											wfh_group 
										FROM wfh_master
									) as m 
									ON wfh_data.wfd_aktifitas=m.wfh_aktifitas
									WHERE m.wfh_group = 'Publikasi Media Sosial'
									AND wfd_tanggal BETWEEN '$start_date' AND '$end_date'
									GROUP BY wfd_tanggal,wfd_username,wfd_aksi,wfd_aktifitas
								) d 
								JOIN (
									SELECT 
										wfh_aktifitas,
										wfh_group 
									FROM wfh_master
								) as m 
								ON d.wfd_aktifitas=m.wfh_aktifitas 
								LEFT JOIN (
									SELECT 
										kar_id, 
										div_id 
									FROM kar_master
								) km 
								ON d.kar_id = km.kar_id 
								JOIN div_master dm ON km.div_id = dm.div_id 
								WHERE m.wfh_group = 'Publikasi Media Sosial' 
								AND km.div_id ='8' 
								AND wfd_tanggal BETWEEN '$start_date' AND '$end_date' 
								GROUP BY wfd_tanggal,wfd_username,wfd_aksi,wfd_aktifitas ORDER BY wfd_username
								) b on km.kar_nik=b.wfd_username
				LEFT JOIN (
					SELECT kar_dtl_typ_krj,kar_id FROM kar_detail 
				) c ON km.kar_id = c.kar_id
				WHERE km.div_id = '8'
				AND kar_dtl_typ_krj != 'Resign'
				group by kar_nik
		";
		$data = mysql_query($sql) or die(mysql_error());
		return $data;
	}
}



class Karactivity
{
	function karact_insert($txt, $file, $karid, $start, $end, $crdt, $mddt)
	{
		$sql = "INSERT INTO rpt_activity (kar_id,txt_activity,attach_activity, date_report_start, date_report_end, crdt, mddt) VALUES('$karid','$txt','$file','$start','$end','$crdt','$mddt')";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}
	
	function karact_tampil_sum($karid, $group=false)
	{
		$data = array();
		
		$sql = "
			SELECT date_report_start, count(date_report_start) as jum FROM rpt_activity
			WHERE 1=1
				AND kar_id = '".$karid."'
				AND DATE_FORMAT(date_report_start, '%Y-%m-%d') = '".date('Y-m-d')."'
		";
		if($group) {
			$sql .= ' GROUP BY date_report_start';
		}
			  
		$query = mysql_query($sql) or die(mysql_error());
		
		while ($row = mysql_fetch_array($query)) {
			$key = date('H:i', strtotime($row['date_report_start']));
			$data[$key] = $row['jum'];
		}
			
		return $data;
	}
	
	function karact_tampil_day($tgl, $div='')
	{
		$data = array();
		$defjam = array();
		
		$jam = 0;
		while($jam++ < 24) {
			$time = date('H:i',mktime($jam,0,0,1,1,2011));
			$defjam[$time] = 0;
		}
		ksort($defjam);
		
		$whys_div = '';
		if(strlen($div) > 0) {
			$whys_div = " AND a.div_id = '". $div ."'";
		}
		
		$sql = "
			SELECT a.kar_nik, a.kar_nm, a.kar_id as userid, b.*
			FROM kar_master a
			LEFT JOIN 
			(
				SELECT id, kar_id, date_report_start, count(date_report_start) as jum FROM rpt_activity
				WHERE 1=1
					AND DATE_FORMAT(date_report_start, '%Y-%m-%d') = '".$tgl."'
				GROUP BY kar_id,date_report_start
			) as b
			ON a.kar_id = b.kar_id
			LEFT JOIN kar_detail c
			ON a.kar_id=c.kar_id
			WHERE 1=1
				AND a.div_id IN ('6','8','10','13')
				AND c.kar_dtl_typ_krj <> 'Resign'
				". $whys_div ."
			GROUP BY a.kar_id, b.date_report_start
			ORDER BY a.div_id, a.kar_nm 
		";
		
		
			  
		$query = mysql_query($sql) or die(mysql_error());
		
		while ($row = mysql_fetch_array($query)) {
			$key = date('H:i', strtotime($row['date_report_start']));
			
			if(isset($data[$row['userid']]['jam']) == false || count($data[$row['userid']]['jam']) <= 0) {
				@reset($defjam);
				$data[$row['userid']]['jam'] = $defjam;
			}
			
			$data[$row['userid']]['nik'] = $row['kar_nik'];
			$data[$row['userid']]['nama'] = $row['kar_nm'];
			
			if(isset($data[$row['userid']]['total_officehour']) == false) {
				$data[$row['userid']]['total_officehour'] = 0;
				$data[$row['userid']]['total_nonofficehour'] = 0;
			}

			if((int)$row['jum'] > 0) {
				$data[$row['userid']]['jam'][$key] = "
					<a href='javascript:void(0);' onclick='___showdetailreport(\"".$key."\", \"".$row['userid']."\", \"".$row['kar_nm']."\");'>
						<span style='font-weight:bold;color:red;'>". (int)$row['jum'] ."</span>
					</a>
				";
				
				$hour_check = strtotime(date('Y-m-d') .' '. $key .':00');
				$office_hour_start = strtotime(date('Y-m-d') .' 07:00:00');
				$office_hour_end =  strtotime(date('Y-m-d') .' 18:00:00');
				if($hour_check >= $office_hour_start && $hour_check <= $office_hour_end) {
					$data[$row['userid']]['total_officehour']++;
				} else {
					$data[$row['userid']]['total_nonofficehour']++;
				}
			}
		}
			
		return $data;
	}
	
	function karact_tampil_detail($jam, $kar, $tgl) {
		$data = array();
		
		$sql = "
			SELECT txt_activity, attach_activity FROM rpt_activity
			WHERE 1=1
				AND kar_id = '".$kar."'
				AND DATE_FORMAT(date_report_start, '%Y-%m-%d %H:%i') = '". $tgl.' '.$jam."'
		";			  
		$query = mysql_query($sql) or die(mysql_error());
		$no = 1;
		while ($row = mysql_fetch_array($query)) {
			// $key = date('H:i', strtotime($row['date_report_start']));
			$tmp = array();
			$tmp['no'] = $no;
			$tmp['gambar'] = "<img style='cursor:pointer;' id='".$no."' onclick='showimg(\"".$no."\")' src='module/kar_activity/file/" . $row['attach_activity']."' width='50px'/>";
			$tmp['keterangan'] = '<span>'.$row['txt_activity'].'</span>';
			$data[] = $tmp;
			
			$no++;
		}
			
		return $data;
	}



}


class Pelamar{

	
	function pelamar_insert($nama, $lowongan, $alamat, $no_wa, $jk, $tgl_lahir, $tmpt_lahir,$cv)
	{


		$tanggal = date('Y-m-d H:i:s');



		$sql = "INSERT INTO pelamar (nama,lowongan,alamat, no_wa, jk, tgl_lahir, tmpt_lahir,cv,create_add) 
		VALUES('$nama','$lowongan','$alamat','$no_wa','$jk','$tgl_lahir','$tmpt_lahir','$cv','$tanggal')";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}

	function pelamar_list(){
		$sql = "SELECT * FROM  pelamar order by id_pelamar desc";
		$query = mysql_query($sql) or die(mysql_error());
		
		return $query;
	}

	function pelamar_update_status($status,$id_pelamar){

		$tanggal = date('Y-m-d H:i:s');

		

			$sql = "UPDATE pelamar
				SET status = '$status',date_status = '$tanggal'
				WHERE id_pelamar = '$id_pelamar'";
				$query = mysql_query($sql) or die(mysql_error());
				return $query;
			}

	function pelamar_list_interview(){

				$sql = "SELECT * FROM  pelamar where status = 'undang_interview' order by id_pelamar desc";
				$query = mysql_query($sql) or die(mysql_error());
				
				return $query;

	}

	function pelamar_id_detail($pelamar_id){

		$sql = "SELECT * FROM  pelamar where id_pelamar = '".$pelamar_id."' order by id_pelamar desc";
		$query = mysql_query($sql) or die(mysql_error());
		
		return $query;

}


	  function interview_satu_insert($tgl_interview,$masukan,$hasil_interview,$pelamar_id)
	{

		$tanggal = date('Y-m-d H:i:s');
		$sql = "INSERT INTO pelamar_interview (tgl_interview_satu,masukan_satu,status,pelamar_id,date_status_satu) 
		VALUES('$tgl_interview','$masukan','$hasil_interview','$pelamar_id','$tanggal')";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	
	}


	function interview_satu_update($tgl_interview,$masukan,$hasil_interview,$pelamar_id)
	{

		$tanggal = date('Y-m-d H:i:s');
		$sql = "UPDATE pelamar_interview
				SET tgl_interview_satu = '$tgl_interview',masukan_satu = '$masukan',
				status = '$hasil_interview',pelamar_id = '$pelamar_id',date_status_satu = '$tanggal'
				WHERE pelamar_id = '$pelamar_id'";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	
	}



	function interview_dua_insert($tgl_interview,$masukan,$hasil_interview,$pelamar_id,$ketemu_user)
	{

		$tanggal = date('Y-m-d H:i:s');

		$sql = "UPDATE pelamar_interview
				SET tgl_interview_dua = '$tgl_interview',masukan_dua = '$masukan',
				status = '$hasil_interview',pelamar_id = '$pelamar_id',ketemu_user = '$ketemu_user',date_status_dua = '$tanggal'
				WHERE pelamar_id = '$pelamar_id'";

		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	
	}

	function detail_interview($pelamar_id){

		$sql = "SELECT * FROM  pelamar_interview where pelamar_id = '".$pelamar_id."'";
				$query = mysql_query($sql) or die(mysql_error());
				
				return $query;

	}

	function pelamar_list_interview_user(){

		$sql = "SELECT * FROM  pelamar_interview as p inner join pelamar  as e
				on e.id_pelamar = p.pelamar_id 
				where (p.status = 'interview_user' or p.status = 'skip_interview_dua' ) order by p.interview_id desc";
				$query = mysql_query($sql) or die(mysql_error());
				
				return $query;

	}

	function pelamar_list_offering(){

		$sql = "SELECT * FROM  pelamar_interview as p inner join pelamar  as e
				on e.id_pelamar = p.pelamar_id 
				where p.status = 'offering' order by p.interview_id desc";
				$query = mysql_query($sql) or die(mysql_error());
				return $query;

	}

	function pelamar_offering_update_status($status,$pelamar_id){

		$tanggal = date('Y-m-d H:i:s');

		$sql = "UPDATE pelamar_interview
				SET status_offering = '$status',date_status_offering = '$tanggal'
				
				WHERE pelamar_id = '$pelamar_id'";

		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	

	}

	function publikasi_loker_list(){
		$sql = "SELECT * FROM  publikasi_loker 
				order by id_publikasi_loker desc";
				$query = mysql_query($sql) or die(mysql_error());
				return $query;
	}

	function publikasi_iklan_list(){

		$sql = "SELECT * FROM  publikasi_iklan 
				order by id_publikasi_iklan desc";
				$query = mysql_query($sql) or die(mysql_error());
				return $query;

	}

	function insert_publikasi_loker($lowongan,$nama_grup,$share_link){
		$tanggal = date('Y-m-d H:i:s');
		$sql = "INSERT INTO publikasi_loker (lowongan,media,share_link,tanggal) 
		VALUES('$lowongan','$nama_grup','$share_link','$tanggal')";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}


	function insert_publikasi_iklan($lowongan,$portal,$share_link){
		$tanggal = date('Y-m-d H:i:s');
		$sql = "INSERT INTO publikasi_iklan (lowongan,media,share_link,tanggal) 
		VALUES('$lowongan','$portal','$share_link','$tanggal')";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}





	function coaching_kar_list(){

		$sql = "SELECT * FROM  pembina_coaching_kar 
				order by id_pembina_coaching_kar desc";
				$query = mysql_query($sql) or die(mysql_error());
				return $query;

	}

	function insert_coaching_kar($nama,$pembina,$tanggal,$masukan,$tempat){
		
		$sql = "INSERT INTO pembina_coaching_kar (nama,nama_pembina,tanggal,masukan,tempat) 
		VALUES('$nama','$pembina','$tanggal','$masukan','$tempat')";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}

	function insert_form_pengajuan_pelamar($jbt_id,$div_id,$sumber_loker,$pendidikan,$pengalaman_kerja,$ktr_id,$pelamar_id,$dirmud,$dir_divisi,$dir_hrd,$dir_keuangan,$dirut1,$dirut2,$dirut3,$photo){
		
		$sql = "INSERT INTO pelamar_form_rekomendasi (jbt_id,div_id,sumber_loker,pendidikan,pengalaman_kerja,ktr_id,pelamar_id,dirmud,dir_divisi,dir_hrd,dir_keuangan,dirut1,dirut2,dirut3,photo) 
		VALUES('$jbt_id','$div_id','$sumber_loker','$pendidikan','$pengalaman_kerja','$ktr_id','$pelamar_id','$dirmud','$dir_divisi','$dir_hrd','$dir_keuangan','$dirut1','$dirut2','$dirut3','$photo')";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}

	function pelamar_form_rekomendasi_detail($pelamar_id){
		$sql = "SELECT * FROM  pelamar_form_rekomendasi where pelamar_id = '".$pelamar_id."' order by id_pelamar_form_rekomendasi desc";
		$query = mysql_query($sql) or die(mysql_error());
		
		return $query;
	}

	function insert_form_acc_pengajuan_pelamar($pelamar_id,$dirmud,$dir_divisi,$dir_hrd,$dir_keuangan,$dirut1,$dirut2,$dirut3){
		
		$sql = "INSERT INTO pelamar_acc_form_rekomen (pelamar_id,dirmud,dir_divisi,dir_hrd,dir_keuangan,dirut1,dirut2,dirut3) 
		VALUES('$pelamar_id','$dirmud','$dir_divisi','$dir_hrd','$dir_keuangan','$dirut1','$dirut2','$dirut3')";
		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	}


	function kar_acc_pengajuan_pelamar()
	{
		$sql = "SELECT * FROM 
			  pelamar_acc_form_rekomen as p 
			  join pelamar as pel on pel.id_pelamar = p.pelamar_id
			   ORDER BY p.id_acc_form_rekome
			  ";
		$query = mysql_query($sql) or die(mysql_error());
		while ($row = mysql_fetch_array($query))
			$data[] = $row;
		return $data;
	}

	function pelamar_acc_form_rekomen_detail($pelamar_id){
		$sql = "SELECT * FROM  pelamar_acc_form_rekomen where pelamar_id = '".$pelamar_id."' order by id_acc_form_rekome desc";
		$query = mysql_query($sql) or die(mysql_error());
		
		return $query;
	}

	function pelamar_acc_form_rekomen_status($pelamar_id,$kar_id,$acc1,$date_acc1){

		$tanggal = date('Y-m-d H:i:s');

		$sql = "UPDATE pelamar_acc_form_rekomen
				SET $acc1 = '1',$date_acc1 = '$tanggal'
				
				WHERE pelamar_id = '$pelamar_id'";

				

		$query = mysql_query($sql) or die(mysql_error());
		return $query;
	

	}

	
}

class Monitoring_absen{
	function list_absen_hari(){

		$sql = "SELECT a.*,k.kar_nm,div_nm,md.abs_masuk,abs_pulang,abs_tgl_masuk FROM  abs_kar_titik_kordinat as a 
		join kar_master as k on k.kar_id = a.kar_id 
		join div_master as d on d.div_id = k.div_id 
		join abs_master_dev as md on md.abs_id=a.abs_id 
				order by id_abs_kar_titik_kordinat desc";
				$query = mysql_query($sql) or die(mysql_error());
				return $query;

	}

	// function row_absen_hari($id){

	// 			$sql = "SELECT a.*,k.kar_nm,div_nm,md.abs_masuk,abs_pulang,abs_tgl_masuk FROM  abs_kar_titik_kordinat as a 
	// 			join kar_master as k on k.kar_id = a.kar_id 
	// 			join div_master as d on d.div_id = k.div_id 
	// 			join abs_master_dev as md on md.abs_id=a.abs_id  where id_abs_kar_titik_kordinat = '".$id."'";
	// 			$query = mysql_query($sql) or die(mysql_error());
				
	// 			return $query;

	// }
}