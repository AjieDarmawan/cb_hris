<?php
class Database{
	private $db_host="203.29.27.140";
	private $db_user="absen";
	private $db_pass="2014sukses";
	private $db_name="absen";
	
	//private $db_host="localhost";
	//private $db_user="persoweb_absen";
	//private $db_pass="2014sukses";
	//private $db_name="persoweb_absen";

	function koneksi(){
		mysql_connect($this->db_host, $this->db_user, $this->db_pass) or die(mysql_error());
		if(mysql_connect){
			mysql_select_db($this->db_name) or die(mysql_error());
		}else{
			echo"Database Not Connection";
		}
	}
}

class Encode {
	function ecrypt($sData, $sKey='Kebangkitan Pendidikan Nasional'){
		$eco=new Encode();
		$sResult = '';
		for($i=0;$i<strlen($sData);$i++){
		    $sChar    = substr($sData, $i, 1);
		    $sKeyChar = substr($sKey, ($i % strlen($sKey)) - 1, 1);
		    $sChar    = chr(ord($sChar) + ord($sKeyChar));
		    $sResult .= $sChar;
		}
		return $eco->encode_base64($sResult);
	}
	    
	function dcrypt($sData, $sKey='Kebangkitan Pendidikan Nasional'){
		$eco=new Encode();
		$sResult = '';
		$sData   = $eco->decode_base64($sData);
		for($i=0;$i<strlen($sData);$i++){
		    $sChar    = substr($sData, $i, 1);
		    $sKeyChar = substr($sKey, ($i % strlen($sKey)) - 1, 1);
		    $sChar    = chr(ord($sChar) - ord($sKeyChar));
		    $sResult .= $sChar;
		}
		return $sResult;
	}
	    
	function encode_base64($sData){
		$sBase64 = base64_encode($sData);
		return strtr($sBase64, '+/', '-_');
	}
	    
	function decode_base64($sData){
		$sBase64 = strtr($sData, '-_', '+/');
		return base64_decode($sBase64);
	}
}

class Karyawan{
	function kar_nik($kdawal){
		$sql="SELECT MAX(kar_nik) AS max_nik FROM kar_master WHERE kar_nik LIKE '$kdawal%'";
		$query=mysql_query($sql) or die (mysql_error());
		return $query;
	}
	function kar_nik_auto(){
		$sql="SELECT MAX(kar_id) AS max_nik_auto FROM kar_master";
		$query=mysql_query($sql) or die (mysql_error());
		return $query;
	}
	function kar_tampil(){
		$sql="SELECT * FROM 
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
		$query=mysql_query($sql) or die (mysql_error());
		while($row=mysql_fetch_array($query))
			$data[]=$row;
		return $data;		
	}
	function kar_tampil_2(){
		$sql="SELECT * FROM 
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
		$query=mysql_query($sql) or die (mysql_error());
		while($row=mysql_fetch_array($query))
			$data[]=$row;
		return $data;		
	}
	function kar_tampil_3(){
		$sql="SELECT * FROM 
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
		$query=mysql_query($sql) or die (mysql_error());
		while($row=mysql_fetch_array($query))
			$data[]=$row;
		return $data;		
	}
	function kar_tampil_filter(){
		$sql="SELECT * FROM 
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
		$query=mysql_query($sql) or die (mysql_error());
		while($row=mysql_fetch_array($query))
			$data[]=$row;
		return $data;		
	}
	function kar_tampil_filter_2(){
		$sql="SELECT * FROM 
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
		$query=mysql_query($sql) or die (mysql_error());
		while($row=mysql_fetch_array($query))
			$data[]=$row;
		return $data;		
	}
	function kar_tampil_id($kar_id){
		$sql="SELECT * FROM 
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
		$query=mysql_query($sql) or die (mysql_error());
		return $query;	
	}
	function kar_insert($kar_nik,$kar_nm,$kar_tgl_lahir,$div_id,$jbt_id,$lvl_id,$unt_id,$ktr_id){
		$sql="INSERT INTO kar_master VALUES(NULL,'$kar_nik','$kar_nm','$kar_tgl_lahir','U','$div_id','$jbt_id','$lvl_id','$unt_id','$ktr_id',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL)";
		$query=mysql_query($sql) or die (mysql_error());
		return $query;	
	}
	function kar_delete($kar_id){
		$sql="DELETE FROM kar_master WHERE kar_id='$kar_id'";
		$query=mysql_query($sql) or die (mysql_error());
		return $query;	
	}
	function kar_update($kar_id,$kar_nm,$kar_tgl_lahir,$div_id,$jbt_id,$lvl_id,$unt_id,$ktr_id){
		$sql="UPDATE kar_master SET kar_nm='$kar_nm',kar_tgl_lahir='$kar_tgl_lahir',jbt_id='$jbt_id',lvl_id='$lvl_id',div_id='$div_id',unt_id='$unt_id',ktr_id='$ktr_id' WHERE kar_id='$kar_id'";
		$query=mysql_query($sql) or die (mysql_error());
		return $query;	
	}
	function kar_tampil_pvl_user(){
		$sql="SELECT * FROM 
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
			  kar_master.kar_pvl='U'
			  ORDER BY kar_id
			  ";
		$query=mysql_query($sql) or die (mysql_error());
		while($row=mysql_fetch_array($query))
			$data[]=$row;
		return $data;		
	}
	function kar_tampil_pvl_admin(){
		$sql="SELECT * FROM 
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
			  kar_master.kar_pvl='A'
			  ORDER BY kar_id
			  ";
		$query=mysql_query($sql) or die (mysql_error());
		while($row=mysql_fetch_array($query))
			$data[]=$row;
		return $data;		
	}
	function kar_tampil_pvl_super_admin(){
		$sql="SELECT * FROM 
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
			  kar_master.kar_pvl='S'
			  ORDER BY kar_id
			  ";
		$query=mysql_query($sql) or die (mysql_error());
		while($row=mysql_fetch_array($query))
			$data[]=$row;
		return $data;		
	}
	function kar_update_pvl($kar_id,$kar_pvl){
		$sql="UPDATE kar_master SET kar_pvl='$kar_pvl' WHERE kar_id='$kar_id'";
		$query=mysql_query($sql) or die (mysql_error());
		return $query;	
	}
	function kar_tampil_div($div_id){
		$sql="SELECT * FROM 
			  kar_master,
			  div_master
		 	  WHERE 
			  kar_master.div_id=div_master.div_id AND
			  kar_master.div_id='$div_id'
			  ORDER BY kar_id
			  ";
		$query=mysql_query($sql) or die (mysql_error());
		while($row=mysql_fetch_array($query))
			$data[]=$row;
		return $data;		
	}
	function kar_update_location($kar_id,$ktr_id_,$unt_id_){
		$sql="UPDATE kar_master SET ktr_id='$ktr_id_',unt_id='$unt_id_' WHERE kar_id='$kar_id'";
		$query=mysql_query($sql) or die (mysql_error());
		return $query;	
	}
	function kar_tampil_location($ktr_id_,$unt_id_){
		$sql="SELECT * FROM kar_master WHERE ktr_id='$ktr_id_' AND unt_id='$unt_id_' ORDER BY kar_id";
		$query=mysql_query($sql) or die (mysql_error());
		return $query;	
	}
	function kar_tampil_detail($kar_id){
		$sql="SELECT * FROM kar_detail WHERE kar_id='$kar_id' ORDER BY kar_id";
		$query=mysql_query($sql) or die (mysql_error());
		return $query;	
	}
	function kar_update_employee($kar_dtl_sts_krj,$kar_dtl_typ_krj,$kar_dtl_tgl_joi,$kar_dtl_msa_krj,$kar_id){
		$sql="UPDATE kar_detail SET kar_dtl_sts_krj='$kar_dtl_sts_krj',kar_dtl_typ_krj='$kar_dtl_typ_krj',kar_dtl_tgl_joi='$kar_dtl_tgl_joi',kar_dtl_msa_krj='$kar_dtl_msa_krj' WHERE kar_id='$kar_id'";
		$query=mysql_query($sql) or die (mysql_error());
		return $query;	
	}
	function kar_insert_employee($kar_dtl_sts_krj,$kar_dtl_typ_krj,$kar_dtl_tgl_joi,$kar_dtl_msa_krj,$kar_id){
		$sql="INSERT INTO kar_detail VALUES(NULL,'$kar_dtl_sts_krj','$kar_dtl_typ_krj','$kar_dtl_tgl_joi','$kar_dtl_msa_krj','','','','','','','','','','','','','','','','','','','','','','','$kar_id')";
		$query=mysql_query($sql) or die (mysql_error());
		return $query;	
	}
	function kar_update_bio($kar_dtl_usa,$kar_dtl_gen,$kar_dtl_tmp_lhr,$kar_dtl_sts_nkh,$kar_dtl_jml_ank,$kar_dtl_tgn,$kar_id){
		$sql="UPDATE kar_detail SET kar_dtl_usa='$kar_dtl_usa',kar_dtl_gen='$kar_dtl_gen',kar_dtl_tmp_lhr='$kar_dtl_tmp_lhr',kar_dtl_sts_nkh='$kar_dtl_sts_nkh',kar_dtl_jml_ank='$kar_dtl_jml_ank',kar_dtl_tgn='$kar_dtl_tgn' WHERE kar_id='$kar_id'";
		$query=mysql_query($sql) or die (mysql_error());
		return $query;	
	}
	function kar_insert_bio($kar_dtl_usa,$kar_dtl_gen,$kar_dtl_tmp_lhr,$kar_dtl_sts_nkh,$kar_dtl_jml_ank,$kar_dtl_tgn,$kar_id){
		$sql="INSERT INTO kar_detail VALUES(NULL,'','','','','$kar_dtl_usa','$kar_dtl_gen','$kar_dtl_tmp_lhr','$kar_dtl_sts_nkh','$kar_dtl_jml_ank','$kar_dtl_tgn','','','','','','','','','','','','','','','','','$kar_id')";
		$query=mysql_query($sql) or die (mysql_error());
		return $query;	
	}
	function kar_update_education($kar_dtl_pnd,$kar_dtl_jrs,$kar_dtl_unv_sch,$kar_dtl_sts_pnd,$kar_dtl_thn_lls,$kar_id){
		$sql="UPDATE kar_detail SET kar_dtl_pnd='$kar_dtl_pnd',kar_dtl_jrs='$kar_dtl_jrs',kar_dtl_unv_sch='$kar_dtl_unv_sch',kar_dtl_sts_pnd='$kar_dtl_sts_pnd',kar_dtl_thn_lls='$kar_dtl_thn_lls' WHERE kar_id='$kar_id'";
		$query=mysql_query($sql) or die (mysql_error());
		return $query;	
	}
	function kar_insert_education($kar_dtl_pnd,$kar_dtl_jrs,$kar_dtl_unv_sch,$kar_dtl_sts_pnd,$kar_dtl_thn_lls,$kar_id){
		$sql="INSERT INTO kar_detail VALUES(NULL,'','','','','','','','','','','$kar_dtl_pnd','$kar_dtl_jrs','$kar_dtl_unv_sch','$kar_dtl_sts_pnd','$kar_dtl_thn_lls','','','','','','','','','','','','$kar_id')";
		$query=mysql_query($sql) or die (mysql_error());
		return $query;	
	}
	function kar_update_card($kar_dtl_no_ktp,$kar_dtl_exp_ktp,$kar_dtl_no_kk,$kar_dtl_no_npw,$kar_dtl_no_kpj,$kar_dtl_no_rek,$kar_dtl_no_bpj,$kar_dtl_no_jms,$kar_id){
		$sql="UPDATE kar_detail SET kar_dtl_no_ktp='$kar_dtl_no_ktp',kar_dtl_exp_ktp='$kar_dtl_exp_ktp',kar_dtl_no_kk='$kar_dtl_no_kk',kar_dtl_no_npw='$kar_dtl_no_npw',kar_dtl_no_kpj='$kar_dtl_no_kpj',kar_dtl_no_rek='$kar_dtl_no_rek',kar_dtl_no_bpj='$kar_dtl_no_bpj',kar_dtl_no_jms='$kar_dtl_no_jms' WHERE kar_id='$kar_id'";
		$query=mysql_query($sql) or die (mysql_error());
		return $query;	
	}
	function kar_insert_card($kar_dtl_no_ktp,$kar_dtl_exp_ktp,$kar_dtl_no_kk,$kar_dtl_no_npw,$kar_dtl_no_kpj,$kar_dtl_no_rek,$kar_dtl_no_bpj,$kar_dtl_no_jms,$kar_id){
		$sql="INSERT INTO kar_detail VALUES(NULL,'','','','','','','','','','','','','','','','$kar_dtl_no_ktp','$kar_dtl_exp_ktp','$kar_dtl_no_kk','$kar_dtl_no_npw','$kar_dtl_no_kpj','$kar_dtl_no_rek','$kar_dtl_no_bpj','$kar_dtl_no_jms','','','','$kar_id')";
		$query=mysql_query($sql) or die (mysql_error());
		return $query;	
	}
	function kar_update_contact($kar_dtl_eml,$kar_dtl_tlp,$kar_dtl_alt,$kar_id){
		$sql="UPDATE kar_detail SET kar_dtl_eml='$kar_dtl_eml',kar_dtl_tlp='$kar_dtl_tlp',kar_dtl_alt='$kar_dtl_alt' WHERE kar_id='$kar_id'";
		$query=mysql_query($sql) or die (mysql_error());
		return $query;	
	}
	function kar_insert_contact($kar_dtl_eml,$kar_dtl_tlp,$kar_dtl_alt,$kar_id){
		$sql="INSERT INTO kar_detail VALUES(NULL,'','','','','','','','','','','','','','','','','','','','','','','','$kar_dtl_eml','$kar_dtl_tlp','$kar_dtl_alt','$kar_id')";
		$query=mysql_query($sql) or die (mysql_error());
		return $query;	
	}
	function kar_tampil_typ($kar_dtl_typ_krj){
		$sql="SELECT * FROM kar_master,kar_detail WHERE kar_master.kar_id=kar_detail.kar_id AND kar_detail.kar_dtl_typ_krj='$kar_dtl_typ_krj' AND kar_detail.kar_dtl_typ_krj!='' ORDER BY kar_master.kar_id";
		$query=mysql_query($sql) or die (mysql_error());
		return $query;	
	}
	function kar_tampil_sts($kar_dtl_sts_krj){
		$sql="SELECT * FROM kar_master,kar_detail WHERE kar_master.kar_id=kar_detail.kar_id AND kar_detail.kar_dtl_sts_krj='$kar_dtl_sts_krj' AND kar_detail.kar_dtl_sts_krj!='' ORDER BY kar_master.kar_id";
		$query=mysql_query($sql) or die (mysql_error());
		return $query;	
	}
	function kar_tampil_libur($id_karyawan){
		$sql="SELECT * FROM kar_master WHERE kar_id NOT REGEXP '$id_karyawan' ORDER BY kar_id";
		$query=mysql_query($sql) or die (mysql_error());
		return $query;	
	}
	function kar_tampil_kontrak(){
		$sql="SELECT * FROM 
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
		$query=mysql_query($sql) or die (mysql_error());
		return $query;	
	}
	function kar_update_jdwakses($kar_id,$kar_jdw_akses){
		$sql="UPDATE kar_master SET kar_jdw_akses='$kar_jdw_akses' WHERE kar_id='$kar_id'";
		$query=mysql_query($sql) or die (mysql_error());
		return $query;	
	}
	function kar_tampil_div_in($div_value){
		$sql="SELECT * FROM 
			  kar_master,
			  div_master
		 	  WHERE 
			  kar_master.div_id=div_master.div_id AND
			  kar_master.div_id IN ($div_value)
			  ORDER BY kar_master.kar_id
			  ";
		$query=mysql_query($sql) or die (mysql_error());
		return $query;			
	}
	function kar_tampil_div_in_new($div_value){
		$sql="SELECT * FROM 
			  kar_master,
			  kar_detail,
			  div_master
		 	  WHERE
			  kar_master.kar_id=kar_detail.kar_id AND
			  kar_master.div_id=div_master.div_id AND
			  kar_master.div_id IN ($div_value) AND
			  (kar_master.kar_default_shift2_in='' OR kar_master.kar_default_shift2_in IS NULL) AND
			  (kar_master.kar_default_shift2_out='' OR kar_master.kar_default_shift2_out IS NULL) AND
			  (kar_master.kar_default_shift3_in='' OR kar_master.kar_default_shift3_in IS NULL) AND
			  (kar_master.kar_default_shift3_out='' OR kar_master.kar_default_shift3_out IS NULL) AND
			  (kar_master.kar_jdw_akses='' OR kar_master.kar_jdw_akses IS NULL) AND
			  kar_detail.kar_dtl_typ_krj <>'Resign'
			  ORDER BY kar_master.kar_id
			  ";
		$query=mysql_query($sql) or die (mysql_error());
		return $query;			
	}
	function kar_tampil_nik($kar_nik){
		$sql="SELECT * FROM kar_master WHERE kar_nik = '$kar_nik' ORDER BY kar_id";
		$query=mysql_query($sql) or die (mysql_error());
		return $query;	
	}
	function kar_sync_update($kar_nik,$datetime){
		$sql="UPDATE kar_master SET kar_sync_date='$datetime' WHERE kar_nik='$kar_nik'";
		$query=mysql_query($sql) or die (mysql_error());
		return $query;	
	}
}

class Divisi{
	function div_tampil(){
		$sql="SELECT * FROM div_master ORDER BY div_id";
		$query=mysql_query($sql) or die (mysql_error());
		while($row=mysql_fetch_array($query))
			$data[]=$row;
		return $data;	
	}
	function div_tampil_id_($div_id){
		$sql="SELECT * FROM div_master WHERE div_id='$div_id' ORDER BY div_id";
		$query=mysql_query($sql) or die (mysql_error());
		return $query;	
	}
}

class Jabatan{
	function jbt_tampil(){
		$sql="SELECT * FROM jbt_master ORDER BY jbt_id";
		$query=mysql_query($sql) or die (mysql_error());
		while($row=mysql_fetch_array($query))
			$data[]=$row;
		return $data;	
	}
	function jbt_tampil_div($div_id){
		$sql="SELECT * FROM jbt_master WHERE div_id='$div_id' ORDER BY jbt_id";
		$query=mysql_query($sql) or die (mysql_error());
		return $query;	
	}
}

class Level{
	function lvl_tampil(){
		$sql="SELECT * FROM lvl_master ORDER BY lvl_id";
		$query=mysql_query($sql) or die (mysql_error());
		while($row=mysql_fetch_array($query))
			$data[]=$row;
		return $data;	
	}
}

class Unit{
	function unt_tampil(){
		$sql="SELECT * FROM unt_master ORDER BY unt_id";
		$query=mysql_query($sql) or die (mysql_error());
		while($row=mysql_fetch_array($query))
			$data[]=$row;
		return $data;	
	}
}

class Kantor{
	function ktr_tampil(){
		$sql="SELECT * FROM ktr_master WHERE ktr_aktif='A' ORDER BY ktr_id";
		$query=mysql_query($sql) or die (mysql_error());
		while($row=mysql_fetch_array($query))
			$data[]=$row;
		return $data;	
	}
	function ktr_tampil_unt($unt_id){
		$sql="SELECT * FROM ktr_master WHERE unt_id='$unt_id' AND ktr_aktif='A' ORDER BY ktr_id";
		$query=mysql_query($sql) or die (mysql_error());
		return $query;	
	}
	function ktr_tampil_id($ktr_id){
		$sql="SELECT * FROM ktr_master WHERE ktr_id='$ktr_id' AND ktr_aktif='A' ORDER BY ktr_id";
		$query=mysql_query($sql) or die (mysql_error());
		return $query;	
	}
	function ktr_tampil_id_location($location){
		$sql="SELECT * FROM ktr_master WHERE ktr_id='$location' AND ktr_aktif='A' ORDER BY ktr_id";
		$query=mysql_query($sql) or die (mysql_error());
		return $query;	
	}
	function ktr_update_status($ktr_id,$ktr_nm,$ktr_status){
		$sql="UPDATE ktr_master SET ktr_status='$ktr_status' WHERE ktr_id='$ktr_id' AND ktr_nm='$ktr_nm'";
		$query=mysql_query($sql) or die (mysql_error());
		return $query;	
	}
	function ktr_update_status_unit($ktr_id,$ktr_nm,$ktr_status){
		$sql="UPDATE ktr_master SET ktr_status='$ktr_status',ktr_open_update=NOW() WHERE ktr_id='$ktr_id' AND ktr_nm='$ktr_nm'";
		$query=mysql_query($sql) or die (mysql_error());
		return $query;	
	}
	function ktr_tampil_mac($mac_address){
		$sql="SELECT * FROM ktr_master WHERE unt_id='2' AND ktr_mac_address='$mac_address' AND ktr_aktif='A' ORDER BY ktr_id";
		$query=mysql_query($sql) or die (mysql_error());
		return $query;	
	}
	function ktr_tampil_status(){
		$sql="SELECT * FROM ktr_master WHERE unt_id='2' AND ktr_aktif='A' ORDER BY ktr_id";
		$query=mysql_query($sql) or die (mysql_error());
		return $query;	
	}
}

class Ip{
	function ip_tampil(){
		$sql="SELECT * FROM 
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
		$query=mysql_query($sql) or die (mysql_error());
		while($row=mysql_fetch_array($query))
			$data[]=$row;
		return $data;		
	}
	function ip_tampil_id($ip_id){
		$sql="SELECT * FROM ip_master WHERE ip_id='$ip_id' ORDER BY ip_id";
		$query=mysql_query($sql) or die (mysql_error());
		return $query;	
	}
	function ip_insert($ip_nm,$ip_dns,$ip_release,$typ_id,$unt_id,$ktr_id){
		$sql="INSERT INTO ip_master VALUES(NULL,'$ip_nm','$ip_dns','$ip_release','$typ_id','$unt_id','$ktr_id')";
		$query=mysql_query($sql) or die (mysql_error());
		return $query;	
	}
	function ip_delete($ip_id){
		$sql="DELETE FROM ip_master WHERE ip_id='$ip_id'";
		$query=mysql_query($sql) or die (mysql_error());
		return $query;	
	}
	function ip_update($ip_id,$ip_nm,$ip_dns,$ip_release,$typ_id){
		$sql="UPDATE ip_master SET ip_nm='$ip_nm',ip_dns='$ip_dns',ip_release='$ip_release',typ_id='$typ_id' WHERE ip_id='$ip_id'";
		$query=mysql_query($sql) or die (mysql_error());
		return $query;	
	}
	function ip_update_unt_ktr_static($date,$unt_id,$ktr_id){
		$sql="UPDATE ip_master SET ip_release='$date' WHERE unt_id='$unt_id' AND ktr_id='$ktr_id'";
		$query=mysql_query($sql) or die (mysql_error());
		return $query;	
	}
	function ip_update_unt_ktr_dynamic($ip_jaringan,$date,$unt_id,$ktr_id){
		$sql="UPDATE ip_master SET ip_nm='$ip_jaringan',ip_release='$date' WHERE unt_id='$unt_id' AND ktr_id='$ktr_id'";
		$query=mysql_query($sql) or die (mysql_error());
		return $query;	
	}
	function ip_tampil_unt_ktr($unt_id,$ktr_id){
		$sql="SELECT * FROM ip_master WHERE unt_id='$unt_id' AND ktr_id='$ktr_id' ORDER BY ip_id ASC LIMIT 1";
		$query=mysql_query($sql) or die (mysql_error());
		return $query;	
	}
	function ip_cek($ip_nm){
		$sql="SELECT * FROM ip_master WHERE ip_nm='$ip_nm' ORDER BY ip_id ASC LIMIT 1";
		$query=mysql_query($sql) or die (mysql_error());
		return $query;	
	}
	function ip_cek_dns($ip_nm,$ip_dns){
		$sql="SELECT * FROM ip_master WHERE ip_nm='$ip_nm' OR ip_dns='$ip_dns' ORDER BY ip_id ASC LIMIT 1";
		$query=mysql_query($sql) or die (mysql_error());
		return $query;	
	}
	function ip_tampil_location($location){
		$sql="SELECT * FROM ip_master WHERE ktr_id='$location' ORDER BY ip_id ASC LIMIT 1";
		$query=mysql_query($sql) or die (mysql_error());
		return $query;	
	}
	function ip_update_location_static($date,$location){
		$sql="UPDATE ip_master SET ip_release='$date' WHERE ktr_id='$location'";
		$query=mysql_query($sql) or die (mysql_error());
		return $query;	
	}
	function ip_update_location_dynamic($ip_jaringan,$date,$location){
		$sql="UPDATE ip_master SET ip_nm='$ip_jaringan',ip_release='$date' WHERE ktr_id='$location'";
		$query=mysql_query($sql) or die (mysql_error());
		return $query;	
	}
}

class Type{
	function typ_tampil(){
		$sql="SELECT * FROM typ_master ORDER BY typ_id";
		$query=mysql_query($sql) or die (mysql_error());
		while($row=mysql_fetch_array($query))
			$data[]=$row;
		return $data;	
	}
}

class Tanggal{
	function tgl_indo($date) {
		$BulanIndo = array("Januari", "Februari", "Maret",
				   "April", "Mei", "Juni",
				   "Juli", "Agustus", "September",
				   "Oktober", "November", "Desember");
	
		$tahun = substr($date, 0, 4);
		$bulan = substr($date, 5, 2);
		$tgl   = substr($date, 8, 2); 
		$result = $tgl . " " . $BulanIndo[(int)$bulan-1] . " ". $tahun;
		return($result);
	}
	
	function date_range($first, $last, $step = '+1 day', $output_format = 'Y-m-d' ) {

		$dates = array();
		$current = strtotime($first);
		$last = strtotime($last);
	    
		while( $current <= $last ) {
	    
		    $dates[] = date($output_format, $current);
		    $current = strtotime($step, $current);
		}
	    
		return $dates;
	}
}

class Absen{
	function abs_masuk($abs_masuk,$abs_ip,$abs_tgl_masuk,$abs_shift,$abs_rwd_masuk,$abs_point,$kar_id){
		$sql="INSERT INTO abs_master VALUES(NULL,'$abs_masuk','','$abs_ip','$abs_tgl_masuk','','','','M','$abs_shift','$abs_rwd_masuk','','$abs_point','$kar_id')";
		$query=mysql_query($sql) or die (mysql_error());
		return $query;	
	}
	function abs_masuk_telat($abs_masuk,$abs_ip,$abs_tgl_masuk,$abs_alasan_masuk,$abs_shift,$abs_rwd_masuk,$abs_point,$kar_id){
		$sql="INSERT INTO abs_master VALUES(NULL,'$abs_masuk','','$abs_ip','$abs_tgl_masuk','','$abs_alasan_masuk','','M','$abs_shift','$abs_rwd_masuk','','$abs_point','$kar_id')";
		$query=mysql_query($sql) or die (mysql_error());
		return $query;	
	}
	function abs_pulang($abs_pulang,$abs_ip,$abs_tgl_pulang,$abs_rwd_pulang,$abs_point,$kar_id,$abs_tgl_masuk){
		$sql="UPDATE abs_master SET abs_pulang='$abs_pulang',abs_sts='P',abs_tgl_pulang='$abs_tgl_pulang',abs_rwd_pulang='$abs_rwd_pulang',abs_point='$abs_point',abs_ip='$abs_ip' WHERE kar_id='$kar_id' AND abs_tgl_masuk='$abs_tgl_masuk'";
		$query=mysql_query($sql) or die (mysql_error());
		return $query;	
	}
	function abs_pulang_cepat($abs_pulang,$abs_ip,$abs_tgl_pulang,$abs_alasan_pulang,$abs_rwd_pulang,$abs_point,$kar_id,$abs_tgl_masuk){
		$sql="UPDATE abs_master SET abs_pulang='$abs_pulang',abs_alasan_pulang='$abs_alasan_pulang',abs_sts='P',abs_tgl_pulang='$abs_tgl_pulang',abs_rwd_pulang='$abs_rwd_pulang',abs_point='$abs_point',abs_ip='$abs_ip' WHERE kar_id='$kar_id' AND abs_tgl_masuk='$abs_tgl_masuk'";
		$query=mysql_query($sql) or die (mysql_error());
		return $query;	
	}
	function abs_tampil_kar_location($kar_id_,$date){
		$sql="SELECT * FROM abs_master WHERE kar_id='$kar_id_' AND abs_tgl_masuk='$date' ORDER BY abs_id";
		$query=mysql_query($sql) or die (mysql_error());
		return $query;	
	}
	function abs_tampil_kar_location_array($date){
		$sql="SELECT * FROM abs_master WHERE abs_tgl_masuk='$date' ORDER BY abs_id";
		$query=mysql_query($sql) or die (mysql_error());
		return $query;	
	}
	function abs_tampil_kar($kar_id,$abs_tgl_masuk){
		$sql="SELECT * FROM abs_master WHERE kar_id='$kar_id' AND abs_tgl_masuk='$abs_tgl_masuk' ORDER BY abs_id";
		$query=mysql_query($sql) or die (mysql_error());
		return $query;	
	}
	function abs_tampil_kar_2($kar_id,$abs_tgl_start,$abs_tgl_end){
		$sql="SELECT * FROM abs_master WHERE kar_id='$kar_id' AND abs_tgl_masuk BETWEEN '$abs_tgl_start' AND '$abs_tgl_end' ORDER BY abs_id";
		$query=mysql_query($sql) or die (mysql_error());
		return $query;	
	}
	function abs_tampil_allkar_2($div_id,$abs_tgl_start,$abs_tgl_end){
		$sql="SELECT * FROM abs_master AS A,kar_master AS B WHERE A.kar_id=B.kar_id AND A.abs_tgl_masuk BETWEEN '$abs_tgl_start' AND '$abs_tgl_end' AND B.div_id='$div_id' ORDER BY abs_id";
		$query=mysql_query($sql) or die (mysql_error());
		return $query;	
	}
	function abs_tampil_las($kar_id,$abs_tgl_las){
		$sql="SELECT * FROM abs_master WHERE kar_id='$kar_id' AND abs_tgl_masuk='$abs_tgl_las' ORDER BY abs_id";
		$query=mysql_query($sql) or die (mysql_error());
		return $query;	
	}
	function abs_tampil_tgl($abs_tgl_masuk){
		$sql="SELECT * FROM abs_master WHERE abs_tgl_masuk='$abs_tgl_masuk' ORDER BY abs_id DESC";
		$query=mysql_query($sql) or die (mysql_error());
		return $query;	
	}
	function abs_tampil_tgl_masuk($abs_tgl_masuk){
		$sql="SELECT * FROM abs_master WHERE abs_tgl_masuk='$abs_tgl_masuk' AND abs_sts='M' ORDER BY abs_id";
		$query=mysql_query($sql) or die (mysql_error());
		return $query;	
	}
	function abs_tampil_tgl_pulang($abs_tgl_masuk){
		$sql="SELECT * FROM abs_master WHERE abs_tgl_masuk='$abs_tgl_masuk' AND abs_sts='P' ORDER BY abs_id";
		$query=mysql_query($sql) or die (mysql_error());
		return $query;	
	}
	function abs_tampil(){
		$sql="SELECT * FROM abs_master ORDER BY abs_id";
		$query=mysql_query($sql) or die (mysql_error());
		while($row=mysql_fetch_array($query))
			$data[]=$row;
		return $data;	
	}
	function abs_ip_konfirm($abs_id,$abs_ip){
		$sql="UPDATE abs_master SET abs_ip='$abs_ip' WHERE abs_id='$abs_id'";
		$query=mysql_query($sql) or die (mysql_error());
		return $query;	
	}
	function abs_tampil_acc($kar_id){
		$sql="SELECT * FROM abs_master WHERE kar_id='$kar_id' ORDER BY abs_id DESC LIMIT 0,7";
		$query=mysql_query($sql) or die (mysql_error());
		return $query;	
	}
	function abs_tampil_rwd($abs_rwd_masuk,$abs_tgl_masuk){
		$sql="SELECT * FROM abs_master WHERE abs_rwd_masuk='$abs_rwd_masuk' AND abs_tgl_masuk='$abs_tgl_masuk' ORDER BY abs_id";
		$query=mysql_query($sql) or die (mysql_error());
		return $query;	
	}
	function abs_dtl_tampil($kar_id_,$abs_dtl_tgl){
		$sql="SELECT * FROM abs_detail WHERE kar_id='$kar_id_' AND abs_dtl_tgl='$abs_dtl_tgl' ORDER BY abs_dtl_id";
		$query=mysql_query($sql) or die (mysql_error());
		return $query;	
	}
	function abs_dtl_tampil_array($abs_dtl_tgl){
		$sql="SELECT * FROM abs_detail WHERE abs_dtl_tgl='$abs_dtl_tgl' ORDER BY abs_dtl_id";
		$query=mysql_query($sql) or die (mysql_error());
		return $query;	
	}
	function abs_dtl_insert($abs_dtl_tgl,$abs_dtl_sts,$kar_id){
		$sql="INSERT INTO abs_detail VALUES(NULL,'$abs_dtl_tgl','$abs_dtl_sts','$kar_id')";
		$query=mysql_query($sql) or die (mysql_error());
		return $query;	
	}
	function abs_dtl_update($abs_dtl_tgl,$abs_dtl_sts,$kar_id){
		$sql="UPDATE abs_detail SET abs_dtl_sts='$abs_dtl_sts' WHERE abs_dtl_tgl='$abs_dtl_tgl' AND kar_id='$kar_id'";
		$query=mysql_query($sql) or die (mysql_error());
		return $query;	
	}
	function abs_dtl_tampil_sts($abs_dtl_sts,$abs_dtl_tgl){
		$sql="SELECT * FROM abs_detail WHERE abs_dtl_tgl='$abs_dtl_tgl' AND abs_dtl_sts='$abs_dtl_sts' ORDER BY abs_dtl_id";
		$query=mysql_query($sql) or die (mysql_error());
		return $query;	
	}
	function abs_settime_id($abs_stm_nm){
		$sql="SELECT * FROM abs_settime WHERE abs_stm_nm='$abs_stm_nm' ORDER BY abs_stm_id";
		$query=mysql_query($sql) or die (mysql_error());
		return $query;	
	}
	function abs_stm_update($abs_stm_jam,$abs_stm_id){
		$sql="UPDATE abs_settime SET abs_stm_jam='$abs_stm_jam' WHERE abs_stm_id='$abs_stm_id'";
		$query=mysql_query($sql) or die (mysql_error());
		return $query;	
	}
	function abs_sort_tgl($tgl_awal,$tgl_akhir){
		$sql="SELECT * FROM abs_master WHERE abs_tgl_masuk BETWEEN '$tgl_awal' AND '$tgl_akhir' ORDER BY abs_id";
		$query=mysql_query($sql) or die (mysql_error());
		return $query;	
	}
	function abs_dtl_sort_tgl($kar_id_,$tgl_awal,$tgl_akhir){
		$sql="SELECT * FROM abs_detail WHERE kar_id='$kar_id_' AND abs_dtl_tgl BETWEEN '$tgl_awal' AND '$tgl_akhir' ORDER BY abs_dtl_id";
		$query=mysql_query($sql) or die (mysql_error());
		return $query;	
	}
	function abs_tampil_rwd_sort($abs_rwd_masuk,$tgl_awal,$tgl_akhir){
		$sql="SELECT * FROM abs_master WHERE abs_rwd_masuk='$abs_rwd_masuk' AND abs_tgl_masuk BETWEEN '$tgl_awal' AND '$tgl_akhir' ORDER BY abs_id";
		$query=mysql_query($sql) or die (mysql_error());
		return $query;	
	}
	function abs_dtl_tampil_sts_sort($abs_dtl_sts,$tgl_awal,$tgl_akhir){
		$sql="SELECT * FROM abs_detail WHERE abs_dtl_sts='$abs_dtl_sts' AND abs_dtl_tgl BETWEEN '$tgl_awal' AND '$tgl_akhir'  ORDER BY abs_dtl_id";
		$query=mysql_query($sql) or die (mysql_error());
		return $query;	
	}
	function abs_point_update($abs_id,$abs_point){
		$sql="UPDATE abs_master SET abs_point='$abs_point' WHERE abs_id='$abs_id'";
		$query=mysql_query($sql) or die (mysql_error());
		return $query;	
	}
	function abs_tgl_rpt(){
		$sql="SELECT * FROM abs_tanggal ORDER BY abs_tgl_id";
		$query=mysql_query($sql) or die (mysql_error());
		return $query;	
	}
	function abs_tgl_rpt_bln($kar_id_,$tgl_1,$tgl_31){
		$sql="SELECT * FROM abs_master WHERE kar_id='$kar_id_' AND abs_tgl_masuk BETWEEN '$tgl_1' AND '$tgl_31' ORDER BY abs_id";
		$query=mysql_query($sql) or die (mysql_error());
		return $query;	
	}
	function abs_tgl_rpt_point($kar_id_,$tgl_1,$tgl_31){
		$sql="SELECT SUM(abs_point) AS point FROM abs_master WHERE kar_id='$kar_id_' AND abs_point!='0' AND abs_tgl_masuk BETWEEN '$tgl_1' AND '$tgl_31' ORDER BY abs_id";
		$query=mysql_query($sql) or die (mysql_error());
		return $query;	
	}
	function abs_tgl_rpt_bln_array($tgl_1,$tgl_31){
		$sql="SELECT COUNT(DISTINCT abs_tgl_masuk) AS num_rows,kar_id FROM `abs_master` WHERE abs_tgl_masuk BETWEEN '$tgl_1' AND '$tgl_31' GROUP BY kar_id";
		$query=mysql_query($sql) or die (mysql_error());
		return $query;	
	}
	function abs_tgl_rpt_point_array($tgl_1,$tgl_31){
		$sql="SELECT COUNT(DISTINCT abs_tgl_masuk) AS num_rows, SUM(abs_point) AS point,kar_id FROM abs_master WHERE abs_point!='0' AND abs_tgl_masuk BETWEEN '$tgl_1' AND '$tgl_31' GROUP BY kar_id";
		$query=mysql_query($sql) or die (mysql_error());
		return $query;	
	}
	function abs_masuk_update($edt_abs_masuk,$edt_abs_id){
		$sql="UPDATE abs_master SET abs_masuk='$edt_abs_masuk' WHERE abs_id='$edt_abs_id'";
		$query=mysql_query($sql) or die (mysql_error());
		return $query;	
	}
	
}

class Mark{
	function mrk_tampil(){
		$sql="SELECT * FROM mrk_master ORDER BY mrk_id";
		$query=mysql_query($sql) or die (mysql_error());
		while($row=mysql_fetch_array($query))
			$data[]=$row;
		return $data;	
	}
}

class Headline{
	function hed_insert($hed_sbj,$hed_msg,$hed_tgl,$mrk_id,$div_id){
		$sql="INSERT INTO hed_master VALUES(NULL,'$hed_sbj','$hed_msg','$hed_tgl','A','$mrk_id','$div_id')";
		$query=mysql_query($sql) or die (mysql_error());
		return $query;	
	}
	function hed_tampil(){
		$sql="SELECT * FROM 
			  hed_master,
			  mrk_master,
			  div_master
		 	  WHERE 
			  hed_master.mrk_id=mrk_master.mrk_id AND
			  hed_master.div_id=div_master.div_id 
			  ORDER BY hed_id
			  DESC
			  ";
		$query=mysql_query($sql) or die (mysql_error());
		while($row=mysql_fetch_array($query))
			$data[]=$row;
		return $data;	
	}
	function hed_tampil_aktif($sepuluhhrsebelumnya){
		$sql="SELECT * FROM 
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
		$query=mysql_query($sql) or die (mysql_error());
		while($row=mysql_fetch_array($query))
			$data[]=$row;
		return $data;	
	}
	function hed_update($hed_id,$hed_sbj,$hed_msg,$mrk_id,$div_id){
		$sql="UPDATE hed_master SET hed_sbj='$hed_sbj',hed_msg='$hed_msg',mrk_id='$mrk_id',div_id='$div_id' WHERE hed_id='$hed_id'";
		$query=mysql_query($sql) or die (mysql_error());
		return $query;
	}
	function hed_delete($hed_id){
		$sql="DELETE FROM hed_master WHERE hed_id='$hed_id'";
		$query=mysql_query($sql) or die (mysql_error());
		return $query;	
	}
	function hed_tampil_id($hed_id){
		$sql="SELECT * FROM hed_master WHERE hed_id='$hed_id' ORDER BY hed_id";
		$query=mysql_query($sql) or die (mysql_error());
		return $query;	
	}
	function hed_update_sts($hed_id,$hed_sts){
		$sql="UPDATE hed_master SET hed_sts='$hed_sts' WHERE hed_id='$hed_id'";
		$query=mysql_query($sql) or die (mysql_error());
		return $query;
	}
}

class Account{
	function acc_tampil(){
		$sql="SELECT * FROM 
			  acc_master,
			  kar_master
		 	  WHERE 
			  acc_master.kar_id=kar_master.kar_id
			  ORDER BY acc_id
			  ";
		$query=mysql_query($sql) or die (mysql_error());
		while($row=mysql_fetch_array($query))
			$data[]=$row;
		return $data;		
	}
	function acc_tampil_id($acc_id){
		$sql="SELECT * FROM 
			  acc_master,
			  kar_master
		 	  WHERE 
			  acc_master.kar_id=kar_master.kar_id AND
			  acc_master.acc_id='$acc_id'
			  ORDER BY acc_id
			  ";
		$query=mysql_query($sql) or die (mysql_error());
		return $query;	
	}
	function acc_tampil_username($acc_username){
		$sql="SELECT * FROM acc_master WHERE acc_username='$acc_username' ORDER BY acc_id";
		$query=mysql_query($sql) or die (mysql_error());
		return $query;	
	}
	function acc_insert($acc_username,$acc_password,$kar_id){
		$sql="INSERT INTO acc_master VALUES(NULL,'$acc_username','$acc_password',md5('$acc_password'),'','','','','$kar_id')";
		$query=mysql_query($sql) or die (mysql_error());
		return $query;	
	}
	function acc_tampil_kar($kar_id){
		$sql="SELECT * FROM  
			  acc_master,
			  kar_master
			  WHERE 
			  acc_master.kar_id=kar_master.kar_id AND
			  acc_master.kar_id='$kar_id' 
			  ORDER BY acc_id";
		$query=mysql_query($sql) or die (mysql_error());
		return $query;	
	}
	function acc_delete($acc_id){
		$sql="DELETE FROM acc_master WHERE acc_id='$acc_id'";
		$query=mysql_query($sql) or die (mysql_error());
		return $query;	
	}
	function acc_img_update($acc_img,$kar_id){
		$sql="UPDATE acc_master SET acc_img='$acc_img' WHERE kar_id='$kar_id'";
		$query=mysql_query($sql) or die (mysql_error());
		return $query;	
	}
	function acc_pass_update($acc_password,$kar_id){
		$sql="UPDATE acc_master SET acc_password='$acc_password' WHERE kar_id='$kar_id'";
		$query=mysql_query($sql) or die (mysql_error());
		return $query;	
	}
	function acc_signin($acc_username,$acc_password,$date,$time){ 
		$result = mysql_query("SELECT * FROM acc_master WHERE acc_username = '$acc_username' AND acc_password = '$acc_password' AND (acc_sts = 'A' OR acc_sts ='')"); 
		$acc_data = mysql_fetch_array($result); 
		$cek_acc = mysql_num_rows($result); 
		if ($cek_acc == 1){ 
			$_SESSION['kar'] = $acc_data['kar_id'];
			$sql="UPDATE acc_master SET acc_log_tgl='$date',acc_log_jam='$time' WHERE kar_id='$acc_data[kar_id]'";
			$query=mysql_query($sql) or die (mysql_error()); 
			return TRUE; 
		}else{ 
			return FALSE; 
		} 
	}
	function acc_signout($kar_id,$date,$time){
		$sql="UPDATE acc_master SET acc_log_tgl='$date',acc_log_jam='$time' WHERE kar_id='$kar_id'";
		$query=mysql_query($sql) or die (mysql_error()); 
		session_start();    
		$_SESSION['kar']='';
		session_unset();
		session_destroy();
		session_start();
		session_regenerate_id(true);
		return TRUE; 
	}
	function acc_update_sts($acc_id,$acc_sts){
		$sql="UPDATE acc_master SET acc_sts='$acc_sts' WHERE acc_id='$acc_id'";
		$query=mysql_query($sql) or die (mysql_error());
		return $query;	
	}
}

class Injection{
	function anti_injection($data){
		$filter = mysql_real_escape_string(stripslashes(strip_tags(htmlspecialchars($data,ENT_QUOTES))));
		return $filter;
	}
}

class Shift{
	function waktu_shift(){
		$waktu=date("H:i:s");
		$t=explode(":",$waktu);
		if($t[0]=="00"){
			$jam="24";
		}else{
			$jam=$t[0];
		}
		$menit=$t[1];
		if ($jam > 00 and $jam < 10 ){
			if ($menit >00 and $menit<60){
			$ucapan="Pagi";
			}
		}else if ($jam >= 10 and $jam < 13 ){
			if ($menit >00 and $menit<60){
			$ucapan="Siang";
			}
		}else if ($jam >= 13 and $jam < 18 ){
			if ($menit >00 and $menit<60){
			$ucapan="Sore";
			}
		}else if ($jam >= 18 and $jam <= 24 ){
			if ($menit >00 and $menit<60){
			$ucapan="Malam";
			}
		}else {
			$ucapan="Error";
		}
		return $ucapan; 
	}
}

class Post{
	function pos_insert_atc($pos_msg,$pos_atc,$pos_tgl,$pos_jam,$mrk_id,$kar_id){
		$sql="INSERT INTO pos_master VALUES(NULL,'$pos_msg','$pos_atc','$pos_tgl','$pos_jam','A','$mrk_id','$kar_id')";
		$query=mysql_query($sql) or die (mysql_error());
		return $query;	
	}
	function pos_insert($pos_msg,$pos_tgl,$pos_jam,$mrk_id,$kar_id){
		$sql="INSERT INTO pos_master VALUES(NULL,'$pos_msg','','$pos_tgl','$pos_jam','A','$mrk_id','$kar_id')";
		$query=mysql_query($sql) or die (mysql_error());
		return $query;	
	}
	function pos_tampil(){
		$sql="SELECT * FROM 
			  pos_master,
			  mrk_master,
			  kar_master
		 	  WHERE 
			  pos_master.mrk_id=mrk_master.mrk_id AND 
			  pos_master.kar_id=kar_master.kar_id 
			  ORDER BY pos_id
			  DESC
			  ";
		$query=mysql_query($sql) or die (mysql_error());
		return $query;	
	}
	function pos_tampil_aktif($kemarinnya_ymd){
		$sql="SELECT * FROM 
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
		$query=mysql_query($sql) or die (mysql_error());
		return $query;	
	}
	function pos_update_sts($pos_id,$pos_sts){
		$sql="UPDATE pos_master SET pos_sts='$pos_sts' WHERE pos_id='$pos_id'";
		$query=mysql_query($sql) or die (mysql_error());
		return $query;	
	}
	function pos_delete($pos_id){
		$sql="DELETE FROM pos_master WHERE pos_id='$pos_id'";
		$query=mysql_query($sql) or die (mysql_error());
		return $query;	
	}
}

class Archive{
	function acv_insert_file($acv_nm,$acv_file,$acv_tgl,$div_id){
		$sql="INSERT INTO acv_master VALUES(NULL,'$acv_nm','$acv_file','$acv_tgl','A','$div_id')";
		$query=mysql_query($sql) or die (mysql_error());
		return $query;	
	}
	function acv_insert($acv_nm,$acv_tgl,$div_id){
		$sql="INSERT INTO acv_master VALUES(NULL,'$acv_nm','','$acv_tgl','A',$div_id')";
		$query=mysql_query($sql) or die (mysql_error());
		return $query;	
	}
	function acv_tampil(){
		$sql="SELECT * FROM 
			  acv_master,
			  div_master
		 	  WHERE 
			  acv_master.div_id=div_master.div_id 
			  ORDER BY acv_id
			  DESC
			  ";
		$query=mysql_query($sql) or die (mysql_error());
		while($row=mysql_fetch_array($query))
			$data[]=$row;
		return $data;	
	}
	function acv_tampil_aktif(){
		$sql="SELECT * FROM 
			  acv_master,
			  div_master
		 	  WHERE 
			  acv_master.div_id=div_master.div_id AND
			  acv_master.acv_sts='A'
			  ORDER BY acv_id
			  DESC
			  LIMIT 0,5
			  ";
		$query=mysql_query($sql) or die (mysql_error());
		while($row=mysql_fetch_array($query))
			$data[]=$row;
		return $data;	
	}
	function acv_update_file($acv_id,$acv_nm,$acv_file,$div_id){
		$sql="UPDATE acv_master SET acv_nm='$acv_nm',acv_file='$acv_file',div_id='$div_id' WHERE acv_id='$acv_id'";
		$query=mysql_query($sql) or die (mysql_error());
		return $query;
	}
	function acv_update($acv_id,$acv_nm,$div_id){
		$sql="UPDATE acv_master SET acv_nm='$acv_nm',div_id='$div_id' WHERE acv_id='$acv_id'";
		$query=mysql_query($sql) or die (mysql_error());
		return $query;
	}
	function acv_delete($acv_id){
		$sql="DELETE FROM acv_master WHERE acv_id='$acv_id'";
		$query=mysql_query($sql) or die (mysql_error());
		return $query;	
	}
	function acv_tampil_id($acv_id){
		$sql="SELECT * FROM acv_master WHERE acv_id='$acv_id' ORDER BY acv_id";
		$query=mysql_query($sql) or die (mysql_error());
		return $query;	
	}
	function acv_update_sts($acv_id,$acv_sts){
		$sql="UPDATE acv_master SET acv_sts='$acv_sts' WHERE acv_id='$acv_id'";
		$query=mysql_query($sql) or die (mysql_error());
		return $query;	
	}
}

class Mailbox{
	function mlb_tampil($div_id,$kar_id){
		$sql="SELECT * FROM 
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
		$query=mysql_query($sql) or die (mysql_error());
		while($row=mysql_fetch_array($query))
			$data[]=$row;
		return $data;	
	}
	function mlb_tampil_array(){
		$sql="SELECT * FROM 
			  mlb_master,
			  kar_master,
			  mrk_master
			  WHERE
			  mlb_master.kar_id=kar_master.kar_id AND
			  mlb_master.mrk_id=mrk_master.mrk_id 
			  ORDER BY mlb_id
			  DESC
			  ";
		$query=mysql_query($sql) or die (mysql_error());
		while($row=mysql_fetch_array($query))
			$data[]=$row;
		return $data;	
	}
	function mlb_tampil_kar($div_id,$kar_id){
		$sql="SELECT * FROM 
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
		$query=mysql_query($sql) or die (mysql_error());
		while($row=mysql_fetch_array($query))
			$data[]=$row;
		return $data;	
	}
	function mlb_tampil_sts($div_id,$kar_id){
		$sql="SELECT * FROM 
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
		$query=mysql_query($sql) or die (mysql_error());
		return $query;	
	}
	function mlb_tampil_sts_limit($div_id,$kar_id){
		$sql="SELECT * FROM 
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
		$query=mysql_query($sql) or die (mysql_error());
		return $query;	
	}
	function mlb_tampil_id($mlb_id){
		$sql="SELECT * FROM 
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
		$query=mysql_query($sql) or die (mysql_error());
		return $query;	
	}
	function mlb_insert_atc_tujuan($mlb_sbj,$mlb_msg,$mlb_atc,$mlb_tgl,$mlb_jam,$mlb_tujuan,$mrk_id,$kar_id){
		$sql="INSERT INTO mlb_master VALUES(NULL,'$mlb_sbj','$mlb_msg','$mlb_atc','N','$mlb_tgl','$mlb_jam','$mlb_tujuan','','$mrk_id','$kar_id')";
		$query=mysql_query($sql) or die (mysql_error());
		return $query;	
	}
	function mlb_insert_atc_sub_tujuan($mlb_sbj,$mlb_msg,$mlb_atc,$mlb_tgl,$mlb_jam,$mlb_sub_tujuan,$mrk_id,$kar_id){
		$sql="INSERT INTO mlb_master VALUES(NULL,'$mlb_sbj','$mlb_msg','$mlb_atc','N','$mlb_tgl','$mlb_jam','','$mlb_sub_tujuan','$mrk_id','$kar_id')";
		$query=mysql_query($sql) or die (mysql_error());
		return $query;	
	}
	function mlb_insert_tujuan($mlb_sbj,$mlb_msg,$mlb_tgl,$mlb_jam,$mlb_tujuan,$mrk_id,$kar_id){
		$sql="INSERT INTO mlb_master VALUES(NULL,'$mlb_sbj','$mlb_msg','','N','$mlb_tgl','$mlb_jam','$mlb_tujuan','','$mrk_id','$kar_id')";
		$query=mysql_query($sql) or die (mysql_error());
		return $query;	
	}
	function mlb_insert_sub_tujuan($mlb_sbj,$mlb_msg,$mlb_tgl,$mlb_jam,$mlb_sub_tujuan,$mrk_id,$kar_id){
		$sql="INSERT INTO mlb_master VALUES(NULL,'$mlb_sbj','$mlb_msg','','N','$mlb_tgl','$mlb_jam','','$mlb_sub_tujuan','$mrk_id','$kar_id')";
		$query=mysql_query($sql) or die (mysql_error());
		return $query;	
	}
	function mlb_update_sts($mlb_id){
		$sql="UPDATE mlb_master SET mlb_sts='R' WHERE mlb_id='$mlb_id'";
		$query=mysql_query($sql) or die (mysql_error());
		return $query;	
	}
}

class Size{
	function size2Byte($size) {
		$units = array('KB', 'MB', 'GB', 'TB');
		$currUnit = '';
		while (count($units) > 0  &&  $size > 1024) {
		    $currUnit = array_shift($units);
		    $size /= 1024;
		}
		return (ceil($size)) . $currUnit;
	}
}

class TimeSet{
	function humanTiming ($time){
		$time = time() - $time;
		$tokens = array (
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
		    return $numberOfUnits.' '.$text.(($numberOfUnits>1)?'s':'');
		}
	}
}

class Penjadwalan{
	function jwd_tampil(){
		$sql="SELECT * FROM 
			  jwd_master,
			  kar_master
			  WHERE
			  jwd_master.kar_id=kar_master.kar_id
			  ORDER BY jwd_id
			  DESC
			  ";
		$query=mysql_query($sql) or die (mysql_error());
		return $query;	
	}
	function jwd_tampil_id($kar_id){
		$sql="SELECT * FROM 
			  jwd_master,
			  kar_master
			  WHERE
			  jwd_master.kar_id=kar_master.kar_id AND
			  jwd_master.kar_id='$kar_id'
			  ORDER BY jwd_id
			  DESC
			  ";
		$query=mysql_query($sql) or die (mysql_error());
		return $query;	
	}
	function jwd_insert($jwd_nm,$jwd_start,$jwd_end,$kar_id){
		$sql="INSERT INTO jwd_master VALUES(NULL,'$jwd_nm','$jwd_start','$jwd_end','$kar_id')";
		$query=mysql_query($sql) or die (mysql_error());
		return $query;	
	}
	function jwd_tampil_now($date,$kar_id,$kemarin){
		$sql="SELECT * FROM jwd_master WHERE kar_id='$kar_id' AND (jwd_start <= '$date' AND jwd_end >= '$date') ORDER BY jwd_id";
		$query=mysql_query($sql) or die (mysql_error());
		return $query;	
	}
	function jwd_delete($jwd_id){
		$sql="DELETE FROM jwd_master WHERE jwd_id='$jwd_id'";
		$query=mysql_query($sql) or die (mysql_error());
		return $query;	
	}
	function jwo_tampil(){
		$sql="SELECT * FROM jwo_master WHERE jwo_id='1'";
		$query=mysql_query($sql) or die (mysql_error());
		return $query;	
	}
	function jwo_update($jwo_kode){
		$sql="UPDATE jwo_master SET jwo_kode='$jwo_kode' WHERE jwo_id='1'";
		$query=mysql_query($sql) or die (mysql_error());
		return $query;	
	}
}

class Notify{
	function ntf_insert($ntf_act,$ntf_isi,$ntf_ip,$ntf_tgl,$ntf_jam,$kar_id){
		$sql="INSERT INTO ntf_master VALUES(NULL,'$ntf_act','$ntf_isi','$ntf_ip','$ntf_tgl','$ntf_jam','$kar_id')";
		$query=mysql_query($sql) or die (mysql_error());
		return $query;	
	}
	function ntf_delete($date){
		$sql="DELETE FROM ntf_master WHERE ntf_tgl!='$date'";
		$query=mysql_query($sql) or die (mysql_error());
		return $query;	
	}
	function ntf_tampil($tanggal){
		$sql="SELECT * FROM 
			  ntf_master,
			  kar_master
			  WHERE
			  ntf_master.kar_id=kar_master.kar_id AND
			  ntf_master.ntf_tgl='$tanggal'
			  ORDER BY ntf_id
			  DESC
			  ";
		$query=mysql_query($sql) or die (mysql_error());
		while($row=mysql_fetch_array($query))
			$data[]=$row;
		return $data;
	}
	function ntf_data_cek($ntf_data_act,$ntf_data_isi,$ntf_data_url,$ntf_data_tujuan,$ntf_data_sumber){
		$sql="SELECT * FROM ntf_data WHERE ntf_data_act='$ntf_data_act' AND ntf_data_isi='$ntf_data_isi'  AND ntf_data_url='$ntf_data_url' AND ntf_data_tujuan='$ntf_data_tujuan' AND ntf_data_sumber='$ntf_data_sumber' ORDER BY ntf_data_id DESC ";
		$query=mysql_query($sql) or die (mysql_error());
		return $query;	
	}
	function ntf_data_cek_bornday($ntf_data_act,$ntf_data_isi,$ntf_data_url,$ntf_data_tujuan,$ntf_data_sumber,$ntf_data_tgl){
		$sql="SELECT * FROM ntf_data WHERE ntf_data_act='$ntf_data_act' AND ntf_data_isi='$ntf_data_isi'  AND ntf_data_url='$ntf_data_url' AND ntf_data_tujuan='$ntf_data_tujuan' AND ntf_data_sumber='$ntf_data_sumber' AND ntf_data_tgl='$ntf_data_tgl' ORDER BY ntf_data_id DESC ";
		$query=mysql_query($sql) or die (mysql_error());
		return $query;	
	}
	function ntf_data_insert($ntf_data_act,$ntf_data_isi,$ntf_data_url,$ntf_data_ip,$ntf_data_tgl,$ntf_data_jam,$ntf_data_tujuan,$ntf_data_sumber){
		$sql="INSERT INTO ntf_data VALUES(NULL,'$ntf_data_act','$ntf_data_isi','$ntf_data_url','$ntf_data_ip','$ntf_data_tgl','$ntf_data_jam','$ntf_data_tujuan','$ntf_data_sumber','')";
		$query=mysql_query($sql) or die (mysql_error());
		return $query;	
	}
	function ntf_data_sts_read($kar_id){
		$sql="SELECT * FROM ntf_data WHERE (ntf_data_tujuan='$kar_id' OR ntf_data_tujuan='ALL') AND ntf_data_read NOT LIKE '%$kar_id%' ORDER BY ntf_data_id DESC ";
		$query=mysql_query($sql) or die (mysql_error());
		return $query;	
	}
	function ntf_data_tampil($ntf_data_tujuan){
		$sql="SELECT * FROM ntf_data WHERE ntf_data_tujuan='$ntf_data_tujuan' OR ntf_data_tujuan='ALL' ORDER BY ntf_data_id DESC ";
		$query=mysql_query($sql) or die (mysql_error());
		while($row=mysql_fetch_array($query))
			$data[]=$row;
		return $data;	
	}
	function ntf_data_tampil_read($ntf_data_id,$ntf_data_read){
		$sql="SELECT * FROM ntf_data WHERE (ntf_data_tujuan='$ntf_data_read' OR ntf_data_tujuan='ALL') AND ntf_data_id='$ntf_data_id' AND ntf_data_read LIKE '%$ntf_data_read%' ORDER BY ntf_data_id DESC";
		$query=mysql_query($sql) or die (mysql_error());
		return $query;
	}
	function ntf_data_update_read($ntf_data_id,$ntf_data_read){
		$sql="UPDATE ntf_data SET ntf_data_read='$ntf_data_read' WHERE ntf_data_id='$ntf_data_id'";
		$query=mysql_query($sql) or die (mysql_error());
		return $query;
	}
	function ntf_data_tampil_kd($page,$ntf_data_url,$ntf_data_tujuan){
		$sql="SELECT * FROM ntf_data WHERE ntf_data_url LIKE '%$ntf_data_url%' AND ntf_data_url LIKE '%$page%' AND ntf_data_tujuan LIKE '%$ntf_data_tujuan%' ORDER BY ntf_data_id DESC LIMIT 1";
		$query=mysql_query($sql) or die (mysql_error());
		return $query;
	}
	function ntf_data_tampil_limit($ntf_data_tujuan){
		$sql="SELECT * FROM ntf_data WHERE ntf_data_tujuan='$ntf_data_tujuan' OR ntf_data_tujuan='ALL' ORDER BY ntf_data_id DESC LIMIT 6";
		$query=mysql_query($sql) or die (mysql_error());
		while($row=mysql_fetch_array($query))
			$data[]=$row;
		return $data;	
	}
	
}

class Masa{
	function hitung_masa_kerja($tgl_join, $date){
		$tgl_join = (is_string($tgl_join) ? strtotime($tgl_join) : $tgl_join);
		$date = (is_string($date) ? strtotime($date) : $date);
		$diff_secs = abs($tgl_join - $date);
		$base_year = min(date("Y", $tgl_join), date("Y", $date));
		$diff = mktime(0, 0, $diff_secs, 1, 1, $base_year);
		return array( "years" => date("Y", $diff) - $base_year,
		"months_total" => (date("Y", $diff) - $base_year) * 12 + date("n", $diff) - 1,
		"months" => date("n", $diff) - 1,
		"days_total" => floor($diff_secs / (3600 * 24)),
		"days" => date("j", $diff) - 1,
		"hours_total" => floor($diff_secs / 3600),
		"hours" => date("G", $diff),
		"minutes_total" => floor($diff_secs / 60),
		"minutes" => (int) date("i", $diff),
		"seconds_total" => $diff_secs,
		"seconds" => (int) date("s", $diff)  );
	}
}

class Umur{
	function hitung_umur($tgl_lahir) {
        	$tgl = explode("-", $tgl_lahir);
		$umur = date("Y") - $tgl[0];
		if(($tgl[1] > date("m")) || ($tgl[1] == date("m") && date("d") < $tgl[2])){
			$umur -= 1;
		}
		return $umur;
	} 
}

class Request{
	function req_kd($kdawal){
		$sql="SELECT MAX(req_id) AS max_kd FROM req_master WHERE req_kd LIKE '$kdawal%'";
		$query=mysql_query($sql) or die (mysql_error());
		return $query;
	}
	function req_kd_auto(){
		$sql="SELECT MAX(req_id) AS max_kd_auto FROM req_master";
		$query=mysql_query($sql) or die (mysql_error());
		return $query;
	}
	function req_tmp_insert($sesi,$date,$ast_id){
		$sql="INSERT INTO req_tmp VALUES(NULL,'$sesi','$date','1','$ast_id')";
		$query=mysql_query($sql) or die (mysql_error());
		return $query;	
	}
	function req_tmp_update($req_tmp_jml,$req_tmp_id){
		$sql="UPDATE req_tmp SET req_tmp_jml='$req_tmp_jml' WHERE req_tmp_id='$req_tmp_id'";
		$query=mysql_query($sql) or die (mysql_error());
		return $query;	
	}
	function req_tmp_delete_kemarin(){
		$kemarin = date('Y-m-d', mktime(0,0,0, date('m'), date('d') - 1, date('Y')));
		$sql="DELETE FROM req_tmp WHERE req_tmp_tgl < '$kemarin'";
		$query=mysql_query($sql) or die (mysql_error());
		return $query;
	}
	function req_tmp_tampil($sesi,$date){
		$sql="SELECT * FROM req_tmp WHERE req_tmp_sesi='$sesi' AND req_tmp_tgl='$date' ORDER BY req_tmp_id";
		$query=mysql_query($sql) or die (mysql_error());
		return $query;
	}
	function req_tmp_cek_ast($sesi,$date,$ast_id){
		$sql="SELECT * FROM req_tmp WHERE req_tmp_sesi='$sesi' AND req_tmp_tgl='$date' AND ast_id='$ast_id' ORDER BY req_tmp_id";
		$query=mysql_query($sql) or die (mysql_error());
		return $query;
	}
	function req_tmp_delete($req_tmp_id){
		$sql="DELETE FROM req_tmp WHERE req_tmp_id='$req_tmp_id'";
		$query=mysql_query($sql) or die (mysql_error());
		return $query;	
	}
	function req_insert($new_kd,$date,$time,$req_sts,$kar_id){
		$sql="INSERT INTO req_master VALUES(NULL,'$new_kd','$date','$time','$req_sts','$kar_id')";
		$query=mysql_query($sql) or die (mysql_error());
		return $query;	
	}
	function req_tmp_clear($sesi,$date){
		$sql="DELETE FROM req_tmp WHERE req_tmp_sesi = '$sesi' AND req_tmp_tgl = '$date'";
		$query=mysql_query($sql) or die (mysql_error());
		return $query;

		session_start();
		session_regenerate_id(true);
		return TRUE; 
	}
	function req_tmp_isi($sesi,$date){
		$req_tmp_isi = array();
		$sql="SELECT * FROM req_tmp WHERE req_tmp_sesi='$sesi' AND req_tmp_tgl='$date' ORDER BY req_tmp_id";
		$query=mysql_query($sql) or die (mysql_error());
		
		while ($req_tmp_data=mysql_fetch_array($query)) {
			$req_tmp_isi[] = $req_tmp_data;
		}
		return $req_tmp_isi;
	}
	function req_dtl_insert($ast_jml,$req_id,$ast_id_){
		$sql="INSERT INTO req_detail VALUES(NULL,'$ast_jml','$req_id','$ast_id_')";
		$query=mysql_query($sql) or die (mysql_error());
		return $query;	
	}
	function req_tampil_kar($kar_id){
		$sql="SELECT * FROM req_master WHERE kar_id='$kar_id' ORDER BY req_id DESC";
		$query=mysql_query($sql) or die (mysql_error());
		return $query;
	}
	function req_tampil_id($req_id){
		$sql="SELECT * FROM req_master WHERE md5(req_id)='$req_id' ORDER BY req_id";
		$query=mysql_query($sql) or die (mysql_error());
		return $query;
	}
	function req_dtl_tampil($req_id){
		$sql="SELECT * FROM req_detail WHERE req_id='$req_id' ORDER BY req_dtl_id";
		$query=mysql_query($sql) or die (mysql_error());
		return $query;
	}
	function req_tampil(){
		$sql="SELECT * FROM req_master ORDER BY req_id DESC";
		$query=mysql_query($sql) or die (mysql_error());
		return $query;
	}
	function req_sts_update($req_sts,$req_id_){
		$sql="UPDATE req_master SET req_sts='$req_sts' WHERE req_id='$req_id_'";
		$query=mysql_query($sql) or die (mysql_error());
		return $query;	
	}
}

class Asset{
	function ast_tampil(){
		$sql="SELECT * FROM 
			  ast_master,
			  ast_jenis
			  WHERE
			  ast_master.ast_jns_id=ast_jenis.ast_jns_id
			  ORDER BY ast_id
			  DESC
			  ";
		$query=mysql_query($sql) or die (mysql_error());
		while($row=mysql_fetch_array($query))
			$data[]=$row;
		return $data;
	}
	function ast_tampil_jns_id($ast_jns_id){
		$sql="SELECT * FROM ast_master WHERE ast_jns_id='$ast_jns_id' ORDER BY ast_id";
		$query=mysql_query($sql) or die (mysql_error());
		return $query;
	}
	function ast_tampil_jns($ast_jns_id,$ast_sts){
		$sql="SELECT * FROM ast_master WHERE ast_jns_id='$ast_jns_id' AND ast_sts='$ast_sts' ORDER BY ast_id";
		$query=mysql_query($sql) or die (mysql_error());
		return $query;
	}
	function ast_tampil_id($ast_id){
		$sql="SELECT * FROM 
			  ast_master,
			  ast_jenis
			  WHERE
			  ast_master.ast_jns_id=ast_jenis.ast_jns_id AND 
			  ast_master.ast_id='$ast_id'
			  ORDER BY ast_id
			  DESC
			  ";
		$query=mysql_query($sql) or die (mysql_error());
		return $query;
	}
	function ast_jns_tampil(){
		$sql="SELECT * FROM ast_jenis ORDER BY ast_jns_id";
		$query=mysql_query($sql) or die (mysql_error());
		while($row=mysql_fetch_array($query))
			$data[]=$row;
		return $data;
	}
	function ast_jns_id($ast_jns_id){
		$sql="SELECT * FROM ast_jenis WHERE ast_jns_id='$ast_jns_id' ORDER BY ast_jns_id";
		$query=mysql_query($sql) or die (mysql_error());
		return $query;
	}
	function ast_insert($ast_nm,$ast_sn,$ast_des,$ast_sts,$ast_jns_id){
		$sql="INSERT INTO ast_master VALUES(NULL,'$ast_nm','$ast_sn','$ast_des','$ast_sts','$ast_jns_id')";
		$query=mysql_query($sql) or die (mysql_error());
		return $query;	
	}
	function ast_update($ast_nm,$ast_sn,$ast_des,$ast_sts,$ast_jns_id,$ast_id){
		$sql="UPDATE ast_master SET ast_nm='$ast_nm',ast_sn='$ast_sn',ast_des='$ast_des',ast_sts='$ast_sts',ast_jns_id='$ast_jns_id' WHERE ast_id='$ast_id'";
		$query=mysql_query($sql) or die (mysql_error());
		return $query;	
	}
	function ast_jns_insert($ast_jns_nm){
		$sql="INSERT INTO ast_jenis VALUES(NULL,'$ast_jns_nm')";
		$query=mysql_query($sql) or die (mysql_error());
		return $query;	
	}
	function ast_jns_update($ast_jns_nm,$ast_jns_id){
		$sql="UPDATE ast_jenis SET ast_jns_nm='$ast_jns_nm' WHERE ast_jns_id='$ast_jns_id'";
		$query=mysql_query($sql) or die (mysql_error());
		return $query;	
	}
	function ast_sn_cek($ast_sn){
		$sql="SELECT * FROM ast_master WHERE ast_sn='$ast_sn' ORDER BY ast_id";
		$query=mysql_query($sql) or die (mysql_error());
		return $query;
	}

}

class Biodata{
	function kdr_tampil_id($kar_id){
		$sql="SELECT * FROM kendaraan WHERE kar_id='$kar_id' ORDER BY kdr_id";
		$query=mysql_query($sql) or die (mysql_error());
		return $query;	
	}
	function pyk_tampil_id($kar_id){
		$sql="SELECT * FROM penyakit WHERE kar_id='$kar_id' ORDER BY pyk_id";
		$query=mysql_query($sql) or die (mysql_error());
		return $query;	
	}
	function hbi_tampil_id($kar_id){
		$sql="SELECT * FROM hobi WHERE kar_id='$kar_id' ORDER BY hbi_id";
		$query=mysql_query($sql) or die (mysql_error());
		return $query;	
	}
	function pdd_tampil_id($kar_id){
		$sql="SELECT * FROM pendidikan WHERE kar_id='$kar_id' ORDER BY pdd_id DESC";
		$query=mysql_query($sql) or die (mysql_error());
		return $query;	
	}
	function ttg_tampil_id($kar_id){
		$sql="SELECT * FROM tempat_tinggal WHERE kar_id='$kar_id' ORDER BY ttg_id";
		$query=mysql_query($sql) or die (mysql_error());
		return $query;	
	}
	function kpd_tampil_id($kar_id){
		$sql="SELECT * FROM kemampuan_diri WHERE kar_id='$kar_id' ORDER BY kpd_id";
		$query=mysql_query($sql) or die (mysql_error());
		return $query;	
	}
	function pgd_tampil_id($kar_id){
		$sql="SELECT * FROM pengembangan_diri WHERE kar_id='$kar_id' ORDER BY pgd_id";
		$query=mysql_query($sql) or die (mysql_error());
		return $query;	
	}
	function cta_tampil_id($kar_id){
		$sql="SELECT * FROM cita_cita WHERE kar_id='$kar_id' ORDER BY cta_id";
		$query=mysql_query($sql) or die (mysql_error());
		return $query;	
	}
	function hrp_tampil_id($kar_id){
		$sql="SELECT * FROM harapan WHERE kar_id='$kar_id' ORDER BY hrp_id";
		$query=mysql_query($sql) or die (mysql_error());
		return $query;	
	}
	function krd_tampil_id($kar_id){
		$sql="SELECT * FROM kredit WHERE kar_id='$kar_id' ORDER BY krd_id";
		$query=mysql_query($sql) or die (mysql_error());
		return $query;	
	}
	function khs_tampil_id($kar_id){
		$sql="SELECT * FROM khursus WHERE kar_id='$kar_id' ORDER BY khs_id";
		$query=mysql_query($sql) or die (mysql_error());
		return $query;	
	}
	function kbt_tampil_id($kar_id){
		$sql="SELECT * FROM kerabat WHERE kar_id='$kar_id' ORDER BY kbt_id";
		$query=mysql_query($sql) or die (mysql_error());
		return $query;	
	}
	function rwp_tampil_id($kar_id){
		$sql="SELECT * FROM riwayat_pekerjaan WHERE kar_id='$kar_id' ORDER BY rwp_id";
		$query=mysql_query($sql) or die (mysql_error());
		return $query;	
	}
	function rwg_tampil_id($kar_id){
		$sql="SELECT * FROM riwayat_gg WHERE kar_id='$kar_id' ORDER BY rwg_id";
		$query=mysql_query($sql) or die (mysql_error());
		return $query;	
	}
	function sim_tampil_id($kar_id){
		$sql="SELECT * FROM sim WHERE kar_id='$kar_id' ORDER BY sim_id";
		$query=mysql_query($sql) or die (mysql_error());
		return $query;	
	}
	function kkr_tampil_id($kar_id){
		$sql="SELECT * FROM kartu_kredit WHERE kar_id='$kar_id' ORDER BY kkr_id";
		$query=mysql_query($sql) or die (mysql_error());
		return $query;	
	}
	function sdr_tampil_id($kar_id){
		$sql="SELECT * FROM saudara WHERE kar_id='$kar_id' ORDER BY sdr_id";
		$query=mysql_query($sql) or die (mysql_error());
		return $query;	
	}
	function ank_tampil_id($kar_id){
		$sql="SELECT * FROM anak WHERE kar_id='$kar_id' ORDER BY ank_id";
		$query=mysql_query($sql) or die (mysql_error());
		return $query;	
	}
	function bio_tampil_id($kar_id){
		$sql="SELECT * FROM bio WHERE kar_id='$kar_id' ORDER BY bio_id";
		$query=mysql_query($sql) or die (mysql_error());
		return $query;	
	}
	function bio_ph_tampil_id($kar_id){
		$sql="SELECT * FROM pasangan_hidup WHERE kar_id='$kar_id' ORDER BY bio_ph_id";
		$query=mysql_query($sql) or die (mysql_error());
		return $query;	
	}
	function hbi_insert($hbi_nm,$hbi_lvl,$hbi_thn,$kar_id){
		$sql="INSERT INTO hobi  VALUES(NULL,'$hbi_nm','$hbi_lvl','$hbi_thn','A','$kar_id')";
		$query=mysql_query($sql) or die (mysql_error());
		return $query;
	}
	function cta_insert($cta_nm,$cta_thn,$kar_id){
		$sql="INSERT INTO cita_cita VALUES(NULL,'$cta_nm','$cta_thn','A','$kar_id')";
		$query=mysql_query($sql) or die (mysql_error());
		return $query;
	}
	function khs_insert($khs_nm,$khs_lembaga,$khs_sertifikat,$khs_start,$khs_end,$khs_lokasi,$kar_id){
		$sql="INSERT INTO khursus VALUES(NULL,'$khs_nm','$khs_lembaga','$khs_sertifikat','$khs_start','$khs_end','$khs_lokasi','A','$kar_id')";
		$query=mysql_query($sql) or die (mysql_error());
		return $query;
	}
	function pgd_insert($pgd_nm,$pgd_thn,$kar_id){
		$sql="INSERT INTO pengembangan_diri VALUES(NULL,'$pgd_nm','$pgd_thn','A','$kar_id')";
		$query=mysql_query($sql) or die (mysql_error());
		return $query;
	}
	function hrp_insert($hrp_nm,$hrp_thn,$kar_id){
		$sql="INSERT INTO harapan VALUES(NULL,'$hrp_nm','$hrp_thn','A','$kar_id')";
		$query=mysql_query($sql) or die (mysql_error());
		return $query;
	}
	function kpd_insert($kpd_nm,$kpd_lvl,$kar_id){
		$sql="INSERT INTO kemampuan_diri VALUES(NULL,'$kpd_nm','$kpd_lvl','A','$kar_id')";
		$query=mysql_query($sql) or die (mysql_error());
		return $query;
	}
	function pyk_insert($pyk_nm,$pyk_lvl,$pyk_start,$pyk_end,$kar_id){
		$sql="INSERT INTO penyakit VALUES(NULL,'$pyk_nm','$pyk_lvl','$pyk_start','$pyk_end','A','$kar_id')";
		$query=mysql_query($sql) or die (mysql_error());
		return $query;
	}
	function kbt_insert($kbt_nm,$kbt_hubungan,$kbt_alt,$kbt_kodepos,$kbt_tlp,$kbt_hp,$kar_id){
		$sql="INSERT INTO kerabat VALUES(NULL,'$kbt_nm','$kbt_hubungan','$kbt_alt','$kbt_kodepos','$kbt_tlp','$kbt_hp','A','$kar_id')";
		$query=mysql_query($sql) or die (mysql_error());
		return $query;
	}
	function kdr_insert($kdr_jns,$kdr_no,$kdr_mrk,$kdr_typ,$kdr_thn,$kar_id){
		$sql="INSERT INTO kendaraan VALUES(NULL,'$kdr_jns','$kdr_no','$kdr_mrk','$kdr_typ','$kdr_thn','A','$kar_id')";
		$query=mysql_query($sql) or die (mysql_error());
		return $query;
	}
	function kkr_insert($kkr_bank,$kkr_limit,$kkr_tempo,$kar_id){
		$sql="INSERT INTO kartu_kredit VALUES(NULL,'$kkr_bank','$kkr_limit','$kkr_tempo','A','$kar_id')";
		$query=mysql_query($sql) or die (mysql_error());
		return $query;
	}
	function krd_insert($krd_jns,$krd_nm,$krd_des,$krd_akad,$krd_durasi,$krd_via,$kar_id){
		$sql="INSERT INTO kredit VALUES(NULL,'$krd_jns','$krd_nm','$krd_des','$krd_akad','$krd_durasi','$krd_via','A','$kar_id')";
		$query=mysql_query($sql) or die (mysql_error());
		return $query;
	}
	function ttg_insert($ttg_jns,$ttg_typ,$ttg_luas_tanah,$ttg_luas_bangunan,$ttg_alt,$ttg_thn,$kar_id){
		$sql="INSERT INTO tempat_tinggal VALUES(NULL,'$ttg_jns','$ttg_typ','$ttg_luas_tanah','$ttg_luas_bangunan','$ttg_alt','$ttg_thn','A','$kar_id')";
		$query=mysql_query($sql) or die (mysql_error());
		return $query;
	}
	function ank_insert($ank_nm,$ank_gender,$ank_tml,$ank_tll,$ank_goldarah,$ank_kondisi,$kar_id){
		$sql="INSERT INTO anak VALUES(NULL,'$ank_nm','$ank_gender','$ank_tml','$ank_tll','$ank_goldarah','$ank_kondisi','A','$kar_id')";
		$query=mysql_query($sql) or die (mysql_error());
		return $query;
	}
	function bio_insert($bio_nm_panggil,$bio_gender,$bio_tml,$bio_goldarah,$bio_agama,$bio_bintang,$bio_shio,$bio_alt,$bio_rtrw,$bio_kelurahan,$bio_kecamatan,$bio_kota,$bio_propinsi,$bio_kodepos,$bio_tlp,$bio_hp,$bio_eml,$bio_web,$kar_id){
		$sql="INSERT INTO bio VALUES(NULL,'$bio_nm_panggil','$bio_gender','$bio_tml','$bio_goldarah','$bio_agama','$bio_bintang','$bio_shio','$bio_alt','$bio_rtrw','$bio_kelurahan','$bio_kecamatan','$bio_kota','$bio_propinsi','$bio_kodepos','$bio_tlp','$bio_hp','$bio_eml','$bio_web','A','$kar_id')";
		$query=mysql_query($sql) or die (mysql_error());
		return $query;
	}
	function bio_ph_insert($bio_ph_nm,$bio_ph_nm_panggil,$bio_ph_tml,$bio_ph_tll,$bio_ph_goldarah,$bio_ph_agama,$kar_id){
		$sql="INSERT INTO pasangan_hidup VALUES(NULL,'$bio_ph_nm','$bio_ph_nm_panggil','$bio_ph_tml','$bio_ph_tll','$bio_ph_goldarah','$bio_ph_agama','A','$kar_id')";
		$query=mysql_query($sql) or die (mysql_error());
		return $query;
	}
	function sim_insert_file($sim_jns,$sim_no,$sim_newname,$sim_masa,$kar_id){
		$sql="INSERT INTO sim VALUES(NULL,'$sim_jns','$sim_no','$sim_newname','$sim_masa','A','$kar_id')";
		$query=mysql_query($sql) or die (mysql_error());
		return $query;
	}
	function sim_insert($sim_jns,$sim_no,$sim_masa,$kar_id){
		$sql="INSERT INTO sim VALUES(NULL,'$sim_jns','$sim_no','','$sim_masa','A','$kar_id')";
		$query=mysql_query($sql) or die (mysql_error());
		return $query;
	}
	function rwp_insert($rwp_jbt,$rwp_lvl,$rwp_penghasilan,$rwp_perusahaan,$rwp_alt,$rwp_start,$rwp_end,$rwp_berhenti,$kar_id){
		$sql="INSERT INTO riwayat_pekerjaan VALUES(NULL,'$rwp_jbt','$rwp_lvl','$rwp_penghasilan','$rwp_perusahaan','$rwp_alt','$rwp_start','$rwp_end','$rwp_berhenti','A','$kar_id')";
		$query=mysql_query($sql) or die (mysql_error());
		return $query;
	}
	function pdd_insert($pdd_lvl,$pdd_nm,$pdd_jurusan,$pdd_start,$pdd_end,$pdd_nilai,$pdd_lokasi,$kar_id){
		$sql="INSERT INTO pendidikan VALUES(NULL,'$pdd_lvl','$pdd_nm','$pdd_jurusan','$pdd_start','$pdd_end','$pdd_nilai','$pdd_lokasi','A','$kar_id')";
		$query=mysql_query($sql) or die (mysql_error());
		return $query;
	}
	function sdr_insert($sdr_nm,$sdr_hubungan,$sdr_kondisi,$sdr_alt,$sdr_pekerjaan,$sdr_kodepos,$sdr_tlp,$sdr_hp,$kar_id){
		$sql="INSERT INTO saudara VALUES(NULL,'$sdr_nm','$sdr_hubungan','$sdr_kondisi','$sdr_alt','$sdr_pekerjaan','$sdr_kodepos','$sdr_tlp','$sdr_hp','A','$kar_id')";
		$query=mysql_query($sql) or die (mysql_error());
		return $query;
	}
	function bio_update($bio_nm_panggil,$bio_gender,$bio_tml,$bio_goldarah,$bio_agama,$bio_bintang,$bio_shio,$bio_alt,$bio_rtrw,$bio_kelurahan,$bio_kecamatan,$bio_kota,$bio_propinsi,$bio_kodepos,$bio_tlp,$bio_hp,$bio_eml,$bio_web,$kar_id){
		$sql="UPDATE bio SET bio_nm_panggil='$bio_nm_panggil', bio_gender='$bio_gender', bio_tml='$bio_tml', bio_goldarah='$bio_goldarah', bio_agama='$bio_agama', bio_bintang='$bio_bintang', bio_shio='$bio_shio',  bio_alt='$bio_alt', bio_rtrw='$bio_rtrw', bio_kelurahan='$bio_kelurahan', bio_kecamatan='$bio_kecamatan', bio_kota='$bio_kota', bio_propinsi='$bio_propinsi', bio_kodepos='$bio_kodepos', bio_tlp='$bio_tlp', bio_hp='$bio_hp', bio_eml='$bio_eml', bio_web='$bio_web' WHERE kar_id='$kar_id'";
		$query=mysql_query($sql) or die (mysql_error());
		return $query;
	}
	function kdr_update($kdr_id,$kdr_jns,$kdr_no,$kdr_mrk,$kdr_typ,$kdr_thn,$kar_id){
		$sql="UPDATE kendaraan SET kdr_jns='$kdr_jns',kdr_no='$kdr_no',kdr_mrk='$kdr_mrk',kdr_typ='$kdr_typ',kdr_thn='$kdr_thn' WHERE kdr_id='$kdr_id' AND kar_id='$kar_id'";
		$query=mysql_query($sql) or die (mysql_error());
		return $query;	
	}
	function ank_update($ank_id,$ank_nm,$ank_gender,$ank_tml,$ank_tll,$ank_goldarah,$ank_kondisi,$kar_id){
		$sql="UPDATE anak SET ank_nm='$ank_nm',ank_gender='$ank_gender',ank_tml='$ank_tml',ank_tll='$ank_tll',ank_goldarah='$ank_goldarah',ank_kondisi='$ank_kondisi' WHERE ank_id='$ank_id' AND kar_id='$kar_id'";
		$query=mysql_query($sql) or die (mysql_error());
		return $query;	
	}
	function kkr_update($kkr_id,$kkr_bank,$kkr_limit,$kkr_tempo,$kar_id){
		$sql="UPDATE kartu_kredit SET kkr_bank='$kkr_bank',kkr_limit='$kkr_limit',kkr_tempo='$kkr_tempo' WHERE kkr_id='$kkr_id' AND kar_id='$kar_id'";
		$query=mysql_query($sql) or die (mysql_error());
		return $query;	
	}
	function sdr_update($sdr_id,$sdr_nm,$sdr_hubungan,$sdr_kondisi,$sdr_alt,$sdr_pekerjaan,$sdr_kodepos,$sdr_tlp,$sdr_hp,$kar_id){
		$sql="UPDATE saudara SET sdr_nm='$sdr_nm',sdr_hubungan='$sdr_hubungan',sdr_kondisi='$sdr_kondisi',sdr_alt='$sdr_alt',sdr_pekerjaan='$sdr_pekerjaan',sdr_kodepos='$sdr_kodepos',sdr_tlp='$sdr_tlp',sdr_hp='$sdr_hp' WHERE sdr_id='$sdr_id' AND  kar_id='$kar_id'";
		$query=mysql_query($sql) or die (mysql_error());
		return $query;	
	}
	function pdd_update($pdd_id,$pdd_lvl,$pdd_nm,$pdd_jurusan,$pdd_start,$pdd_end,$pdd_nilai,$pdd_lokasi,$kar_id){
		$sql="UPDATE pendidikan SET pdd_lvl='$pdd_lvl',pdd_nm='$pdd_nm',pdd_jurusan='$pdd_jurusan',pdd_start='$pdd_start',pdd_end='$pdd_end',pdd_nilai='$pdd_nilai',pdd_lokasi='$pdd_lokasi' WHERE pdd_id='$pdd_id' AND kar_id='$kar_id'";
		$query=mysql_query($sql) or die (mysql_error());
		return $query;	
	}
	function khs_update($khs_id,$khs_nm,$khs_lembaga,$khs_sertifikat,$khs_start,$khs_end,$khs_lokasi,$kar_id){
		$sql="UPDATE khursus SET khs_nm='$khs_nm',khs_lembaga='$khs_lembaga',khs_sertifikat='$khs_sertifikat',khs_start='$khs_start',khs_end='$khs_end',khs_lokasi='$khs_lokasi' WHERE kar_id='$kar_id'";
		$query=mysql_query($sql) or die (mysql_error());
		return $query;	
	}
	function rwp_update($rwp_id,$rwp_jbt,$rwp_lvl,$rwp_penghasilan,$rwp_perusahaan,$rwp_alt,$rwp_start,$rwp_end,$rwp_berhenti,$kar_id){
		$sql="UPDATE riwayat_pekerjaan SET rwp_jbt='$rwp_jbt',rwp_lvl='$rwp_lvl',rwp_penghasilan='$rwp_penghasilan',rwp_perusahaan='$rwp_perusahaan',rwp_alt='$rwp_alt',rwp_start='$rwp_start',rwp_end='$rwp_end',rwp_berhenti='$rwp_berhenti' WHERE kar_id='$kar_id'";
		$query=mysql_query($sql) or die (mysql_error());
		return $query;	
	}
	function pyk_update($pyk_id,$pyk_nm,$pyk_lvl,$pyk_start,$pyk_end,$kar_id){
		$sql="UPDATE penyakit SET pyk_nm='$pyk_nm',pyk_lvl='$pyk_lvl',pyk_start='$pyk_start',pyk_end='$pyk_end' WHERE kar_id='$kar_id'";
		$query=mysql_query($sql) or die (mysql_error());
		return $query;	
	}
	function hbi_update($hbi_id,$hbi_nm,$hbi_lvl,$hbi_thn,$kar_id){
		$sql="UPDATE hobi SET hbi_nm='$hbi_nm',hbi_lvl='$hbi_lvl',hbi_thn='$hbi_thn' WHERE kar_id='$kar_id'";
		$query=mysql_query($sql) or die (mysql_error());
		return $query;	
	}
	function ttg_update($ttg_id,$ttg_jns,$ttg_typ,$ttg_luas_tanah,$ttg_luas_bangunan,$ttg_alt,$ttg_thn,$kar_id){
		$sql="UPDATE tempat_tinggal SET ttg_jns='$ttg_jns',ttg_typ='$ttg_typ',ttg_luas_tanah='$ttg_luas_tanah',ttg_luas_bangunan='$ttg_luas_bangunan',ttg_alt='$ttg_alt',ttg_thn='$ttg_thn' WHERE kar_id='$kar_id'";
		$query=mysql_query($sql) or die (mysql_error());
		return $query;	
	}
	function kbt_update($kbt_id,$kbt_nm,$kbt_hubungan,$kbt_alt,$kbt_kodepos,$kbt_tlp,$kbt_hp,$kar_id){
		$sql="UPDATE kerabat SET kbt_nm='$kbt_nm',kbt_hubungan='$kbt_hubungan',kbt_alt='$kbt_alt',kbt_kodepos='$kbt_kodepos',kbt_tlp='$kbt_tlp',kbt_hp='$kbt_hp' WHERE kar_id='$kar_id'";
		$query=mysql_query($sql) or die (mysql_error());
		return $query;	
	}
	function kpd_update($kpd_id,$kpd_nm,$kpd_lvl,$kar_id){
		$sql="UPDATE kemampuan_diri SET kpd_nm='$kpd_nm',kpd_lvl='$kpd_lvl' WHERE kar_id='$kar_id'";
		$query=mysql_query($sql) or die (mysql_error());
		return $query;	
	}
	function pgd_update($pgd_id,$pgd_nm,$pgd_thn,$kar_id){
		$sql="UPDATE pengembangan_diri SET pgd_nm='$pgd_nm',pgd_thn='$pgd_thn' WHERE kar_id='$kar_id'";
		$query=mysql_query($sql) or die (mysql_error());
		return $query;	
	}
	function krd_update($krd_id,$krd_jns,$krd_nm,$krd_des,$krd_akad,$krd_durasi,$krd_via,$kar_id){
		$sql="UPDATE kredit SET krd_jns='$krd_jns',krd_nm='$krd_nm',krd_des='$krd_des',krd_akad='$krd_akad',krd_durasi='$krd_durasi',krd_via='$krd_via' WHERE kar_id='$kar_id'";
		$query=mysql_query($sql) or die (mysql_error());
		return $query;	
	}
	function cta_update($cta_id,$cta_nm,$cta_thn,$kar_id){
		$sql="UPDATE cita_cita SET cta_nm='$cta_nm',cta_thn='$cta_thn' WHERE kar_id='$kar_id'";
		$query=mysql_query($sql) or die (mysql_error());
		return $query;	
	}
	function hrp_update($hrp_id,$hrp_nm,$hrp_thn,$kar_id){
		$sql="UPDATE harapan SET hrp_nm='$hrp_nm',hrp_thn='$hrp_thn' WHERE kar_id='$kar_id'";
		$query=mysql_query($sql) or die (mysql_error());
		return $query;	
	}
	function sim_update($sim_id,$sim_jns,$sim_no,$sim_masa,$kar_id){
		$sql="UPDATE sim SET sim_jns='$sim_jns',sim_no='$sim_no',sim_masa='$sim_masa' WHERE sim_id='$sim_id' AND kar_id='$kar_id'";
		$query=mysql_query($sql) or die (mysql_error());
		return $query;	
	}
	function sim_update_file($sim_id,$sim_jns,$sim_no,$sim_newname,$sim_masa,$kar_id){
		$sql="UPDATE sim SET sim_jns='$sim_jns',sim_no='$sim_no',sim_img='$sim_newname',sim_masa='$sim_masa' WHERE sim_id='$sim_id' AND kar_id='$kar_id'";
		$query=mysql_query($sql) or die (mysql_error());
		return $query;	
	}
	function sim_cek_img($sim_id){
		$sql="SELECT * FROM sim WHERE sim_id='$sim_id' ORDER BY sim_id";
		$query=mysql_query($sql) or die (mysql_error());
		return $query;	
	}

}

class Penggajian{
	function gji_tampil_kar($kar_id){
		$sql="SELECT * FROM gji_master WHERE kar_id='$kar_id' ORDER BY gji_id";
		$query=mysql_query($sql) or die (mysql_error());
		return $query;	
	}
	function gji_update_kar($kar_id_,$gji_gapok,$gji_tunj_kel,$gji_tunj_jab,$gji_tunj_fung,$gji_jum_gaji,$gji_gaji_bpjs,$gji_lain_lain,$gji_bpjs_jamsos,$gji_jum_komp,$gji_gaji_std,$gji_gaji_baru,$gji_gaji_pajak,$gji_paguyuban,$gji_pajak_pph21){
		$sql="UPDATE gji_master SET gji_gapok='$gji_gapok',gji_tunj_kel='$gji_tunj_kel',gji_tunj_jab='$gji_tunj_jab',gji_tunj_fung='$gji_tunj_fung',gji_jum_gaji='$gji_jum_gaji',gji_gaji_bpjs='$gji_gaji_bpjs',gji_lain_lain='$gji_lain_lain',gji_bpjs_jamsos='$gji_bpjs_jamsos',gji_jum_komp='$gji_jum_komp',gji_gaji_std='$gji_gaji_std',gji_gaji_baru='$gji_gaji_baru',gji_gaji_pajak='$gji_gaji_pajak',gji_paguyuban='$gji_paguyuban',gji_pajak_pph21='$gji_pajak_pph21' WHERE kar_id='$kar_id_'";
		$query=mysql_query($sql) or die (mysql_error());
		return $query;	
	}
	function gji_insert_kar($kar_id_,$gji_gapok,$gji_tunj_kel,$gji_tunj_jab,$gji_tunj_fung,$gji_jum_gaji,$gji_gaji_bpjs,$gji_lain_lain,$gji_bpjs_jamsos,$gji_jum_komp,$gji_gaji_std,$gji_gaji_baru,$gji_gaji_pajak,$gji_paguyuban,$gji_pajak_pph21){
		$sql="INSERT INTO gji_master VALUES(NULL,'$gji_gapok','$gji_tunj_kel','$gji_tunj_jab','$gji_tunj_fung','$gji_jum_gaji','$gji_gaji_bpjs','$gji_lain_lain','$gji_bpjs_jamsos','$gji_jum_komp','$gji_gaji_std','$gji_gaji_baru','$gji_gaji_pajak','$gji_paguyuban','$gji_pajak_pph21','$kar_id_')";
		$query=mysql_query($sql) or die (mysql_error());
		return $query;
	}
}

class Penilaian{
	function rkm_tampil_kar($kar_id){
		$sql="SELECT * FROM rkm_master WHERE kar_id='$kar_id' ORDER BY rkm_id";
		$query=mysql_query($sql) or die (mysql_error());
		return $query;	
	}
	function rkm_update($rkm_id,$rkm_nilai,$rkm_keterangan,$rkm_pelapor,$rkm_tgl){
		$sql="UPDATE rkm_master SET rkm_nilai='$rkm_nilai',rkm_keterangan='$rkm_keterangan',rkm_pelapor='$rkm_pelapor',rkm_tgl='$rkm_tgl' WHERE rkm_id='$rkm_id'";
		$query=mysql_query($sql) or die (mysql_error());
		return $query;
	}
	function rkm_delete($rkm_id_){
		$sql="DELETE FROM rkm_master WHERE rkm_id='$rkm_id_'";
		$query=mysql_query($sql) or die (mysql_error());
		return $query;	
	}
	function kkn_tampil_kar($kar_id){
		$sql="SELECT * FROM kkn_master WHERE kar_id='$kar_id' ORDER BY kkn_id DESC";
		$query=mysql_query($sql) or die (mysql_error());
		return $query;	
	}
	function kkn_tampil_kar_asc($kar_id){
		$sql="SELECT * FROM kkn_master WHERE kar_id='$kar_id' ORDER BY kkn_id ASC";
		$query=mysql_query($sql) or die (mysql_error());
		return $query;	
	}
	function kkn_tampil_kar_limit($kar_id){
		$sql="SELECT * FROM kkn_master WHERE kar_id='$kar_id' ORDER BY kkn_id DESC LIMIT 1";
		$query=mysql_query($sql) or die (mysql_error());
		return $query;	
	}
	function kkn_update($kkn_id,$kkn_kontrak,$kkn_start,$kkn_end,$kkn_keterangan){
		$sql="UPDATE kkn_master SET kkn_kontrak='$kkn_kontrak',kkn_start='$kkn_start',kkn_end='$kkn_end',kkn_keterangan='$kkn_keterangan' WHERE kkn_id='$kkn_id'";
		$query=mysql_query($sql) or die (mysql_error());
		return $query;
	}
	function kkn_delete($kkn_id_){
		$sql="DELETE FROM kkn_master WHERE kkn_id='$kkn_id_'";
		$query=mysql_query($sql) or die (mysql_error());
		return $query;	
	}
	function fpk_tampil_kar($kar_id){
		$sql="SELECT * FROM fpk_master WHERE kar_id='$kar_id' ORDER BY fpk_id";
		$query=mysql_query($sql) or die (mysql_error());
		return $query;	
	}
	function fpk_tampil_thn($kar_id_,$thn__){
		$sql="SELECT * FROM fpk_master WHERE kar_id='$kar_id_' AND fpk_tgl LIKE '%$thn__%' ORDER BY fpk_id";
		$query=mysql_query($sql) or die (mysql_error());
		return $query;	
	}
	function fpk_tampil_asp(){
		$sql="SELECT * FROM fpk_aspek ORDER BY fpk_asp_id";
		$query=mysql_query($sql) or die (mysql_error());
		return $query;	
	}
	function fpk_tampil_point($fpk_asp_id){
		$sql="SELECT * FROM fpk_point WHERE fpk_asp_id='$fpk_asp_id' ORDER BY fpk_point_id";
		$query=mysql_query($sql) or die (mysql_error());
		return $query;	
	}
	function fpk_tampil_bobot($fpk_huruf){
		$sql="SELECT * FROM fpk_bobot WHERE fpk_huruf='$fpk_huruf' ORDER BY fpk_bobot_id";
		$query=mysql_query($sql) or die (mysql_error());
		return $query;	
	}
	function fpk_kd_awal($kdawal){
		$sql="SELECT MAX(fpk_id) AS max_kd FROM fpk_master WHERE fpk_kd LIKE '$kdawal%'";
		$query=mysql_query($sql) or die (mysql_error());
		return $query;
	}
	function fpk_kd_auto(){
		$sql="SELECT MAX(fpk_id) AS max_kd_auto FROM fpk_master";
		$query=mysql_query($sql) or die (mysql_error());
		return $query;
	}
	function fpk_insert($fpk_kd,$fpk_keterangan,$fpk_priode,$fpk_gaji,$fpk_tgl,$fpk_nilai1,$fpk_nilai2,$fpk_nilai3,$fpk_nilai4,$fpk_nilai5,$fpk_nilai6,$fpk_nilai7,$fpk_nilai8,$fpk_nilai9,$fpk_nilai10,$fpk_nilai11,$fpk_nilai12,$fpk_nilai13,$fpk_nilai14,$fpk_nilai15,$fpk_nilai16,$fpk_nilai17,$fpk_nilai18,$fpk_prestasi,$fpk_pelanggaran,$fpk_saranperbaikan,$fpk_penilai,$fpk_mengetahui,$fpk_mengetahui2,$fpk_ditetapkan,$fpk_sts,$fpk_sesi,$fpk_kirim,$kar_id_){
		$sql="INSERT INTO fpk_master VALUES(NULL,'$fpk_kd','$fpk_keterangan','$fpk_priode',NULL,NULL,'$fpk_nilai1','$fpk_nilai2','$fpk_nilai3','$fpk_nilai4','$fpk_nilai5','$fpk_nilai6','$fpk_nilai7','$fpk_nilai8','$fpk_nilai9','$fpk_nilai10','$fpk_nilai11','$fpk_nilai12','$fpk_nilai13','$fpk_nilai14','$fpk_nilai15','$fpk_nilai16','$fpk_nilai17','$fpk_nilai18','$fpk_prestasi','$fpk_pelanggaran','$fpk_saranperbaikan','$fpk_penilai','$fpk_mengetahui','$fpk_mengetahui2',NULL,'$fpk_ditetapkan','$fpk_sts','$fpk_sesi','$fpk_kirim','$kar_id_')";
		$query=mysql_query($sql) or die (mysql_error());
		return $query;
	}
	function fpk_tampil_id($fpk_kd){
		$sql="SELECT * FROM fpk_master WHERE md5(fpk_kd)='$fpk_kd' ORDER BY fpk_id";
		$query=mysql_query($sql) or die (mysql_error());
		return $query;
	}
	function fpk_tampil_grade($fpk_grade){
		$sql="SELECT * FROM fpk_bobot WHERE fpk_bobot_angka='$fpk_grade' ORDER BY fpk_bobot_id";
		$query=mysql_query($sql) or die (mysql_error());
		return $query;	
	}
	function fpk_tampil_point_all(){
		$sql="SELECT * FROM fpk_point ORDER BY fpk_point_id";
		$query=mysql_query($sql) or die (mysql_error());
		return $query;	
	}
	function fpk_tampil_bobot_all($fpk_huruf){
		$sql="SELECT * FROM fpk_bobot WHERE fpk_huruf='$fpk_huruf' ORDER BY fpk_bobot_id";
		$query=mysql_query($sql) or die (mysql_error());
		while($row=mysql_fetch_array($query))
			$data[]=$row;
		return $data;	
	}
	function fpk_update($fpk_id,$fpk_tgl,$fpk_nilai1,$fpk_nilai2,$fpk_nilai3,$fpk_nilai4,$fpk_nilai5,$fpk_nilai6,$fpk_nilai7,$fpk_nilai8,$fpk_nilai9,$fpk_nilai10,$fpk_nilai11,$fpk_nilai12,$fpk_nilai13,$fpk_nilai14,$fpk_nilai15,$fpk_nilai16,$fpk_nilai17,$fpk_nilai18,$fpk_prestasi,$fpk_pelanggaran,$fpk_saranperbaikan,$fpk_ditetapkan,$fpk_sts){
		$sql="UPDATE fpk_master SET fpk_tgl='$fpk_tgl',fpk_nilai1='$fpk_nilai1',fpk_nilai2='$fpk_nilai2',fpk_nilai3='$fpk_nilai3',fpk_nilai4='$fpk_nilai4',fpk_nilai5='$fpk_nilai5',fpk_nilai6='$fpk_nilai6',fpk_nilai7='$fpk_nilai7',fpk_nilai8='$fpk_nilai8',fpk_nilai9='$fpk_nilai9',fpk_nilai10='$fpk_nilai10',fpk_nilai11='$fpk_nilai11',fpk_nilai12='$fpk_nilai12',fpk_nilai13='$fpk_nilai13',fpk_nilai14='$fpk_nilai14',fpk_nilai15='$fpk_nilai15',fpk_nilai16='$fpk_nilai16',fpk_nilai17='$fpk_nilai17',fpk_nilai18='$fpk_nilai18',fpk_prestasi='$fpk_prestasi',fpk_pelanggaran='$fpk_pelanggaran',fpk_saranperbaikan='$fpk_saranperbaikan',fpk_ditetapkan='$fpk_ditetapkan',fpk_sts='$fpk_sts' WHERE fpk_id='$fpk_id'";
		$query=mysql_query($sql) or die (mysql_error());
		return $query;
	}
	function fpk_update_sts($fpk_id,$fpk_ditetapkan,$fpk_sts){
		$sql="UPDATE fpk_master SET fpk_ditetapkan='$fpk_ditetapkan',fpk_sts='$fpk_sts' WHERE fpk_id='$fpk_id'";
		$query=mysql_query($sql) or die (mysql_error());
		return $query;
	}
	function fpk_update_konfirm($fpk_id,$fpk_konfirm){
		$sql="UPDATE fpk_master SET fpk_konfirm='$fpk_konfirm' WHERE fpk_id='$fpk_id'";
		$query=mysql_query($sql) or die (mysql_error());
		return $query;
	}
	function fpk_konfirm_user($fpk_id,$kar_id){
		$sql="SELECT * FROM fpk_master WHERE md5(fpk_kd)='$fpk_id' AND fpk_konfirm LIKE '%$kar_id%'";
		$query=mysql_query($sql) or die (mysql_error());
		return $query;
	}
	function rkm_insert($rkm_nilai,$rkm_keterangan,$rkm_pelapor,$rkm_tgl,$kar_id){
		$sql="INSERT INTO rkm_master VALUES(NULL,'$rkm_nilai','$rkm_keterangan','$rkm_pelapor','$rkm_tgl','$kar_id')";
		$query=mysql_query($sql) or die (mysql_error());
		return $query;
	}
	function kkn_insert($kkn_kontrak,$kkn_start,$kkn_end,$kkn_keterangan,$kar_id){
		$sql="INSERT INTO kkn_master VALUES(NULL,'$kkn_kontrak','$kkn_start','$kkn_end','$kkn_keterangan','$kar_id')";
		$query=mysql_query($sql) or die (mysql_error());
		return $query;
	}
}

class Cam_absen{
	function cam_update_img($cam_img,$kar_id){
		$sql="UPDATE cam_absen SET cam_img='$cam_img' WHERE kar_id='$kar_id'";
		$query=mysql_query($sql) or die (mysql_error());
		return $query;
	}
	function cam_tampil_kar($kar_id){
		$sql="SELECT * FROM cam_absen WHERE kar_id='$kar_id' ORDER BY cam_id";
		$query=mysql_query($sql) or die (mysql_error());
		return $query;	
	}
}

class Rupiah {
	function format_rupiah($angka) {
	   $rupiah = number_format($angka ,2, ',' , '.' );
	   return $rupiah;
	}
}

class Hitung {
	function hitung_median($arr) {
	    sort($arr);
	    $count = count($arr);
	    $middleval = floor(($count-1)/2);
	    if($count % 2) {
		$median = $arr[$middleval];
	    } else {
		$low = $arr[$middleval];
		$high = $arr[$middleval+1];
		$median = (($low+$high)/2);
	    }
	    return $median;
	}
}
class Kwitansi {
	function kwi_tampil($tgl_terakhir){
		$sql="SELECT * FROM kwi_master WHERE kwi_tgl='$tgl_terakhir' OR kwi_tgl='0000-00-00' ORDER BY kwi_id DESC";
		$query=mysql_query($sql) or die (mysql_error());
		return $query;	
	}
	function kwi_update($kwi_id,$kwi_tgl,$kwi_wilayah,$kwi_pts,$kwi_program,$kwi_nomor,$kwi_kanit,$kwi_unit,$kwi_keterangan){
		$sql="UPDATE kwi_master SET kwi_tgl='$kwi_tgl',kwi_wilayah='$kwi_wilayah',kwi_pts='$kwi_pts',kwi_program='$kwi_program',kwi_nomor='$kwi_nomor',kwi_kanit='$kwi_kanit',kwi_unit='$kwi_unit',kwi_keterangan='$kwi_keterangan' WHERE kwi_id='$kwi_id'";
		$query=mysql_query($sql) or die (mysql_error());
		return $query;
	}
	function kwi_insert($kwi_tgl,$kwi_wilayah,$kwi_pts,$kwi_program,$kwi_nomor,$kwi_kanit,$kwi_unit,$kwi_keterangan,$kar_id){
		$sql="INSERT INTO kwi_master VALUES(NULL,'$kwi_tgl','$kwi_wilayah','$kwi_pts','$kwi_program','$kwi_nomor','$kwi_kanit','$kwi_unit','$kwi_keterangan','$kar_id')";
		$query=mysql_query($sql) or die (mysql_error());
		return $query;
	}
	function kwi_delete($kwi_id_){
		$sql="DELETE FROM kwi_master WHERE kwi_id='$kwi_id_'";
		$query=mysql_query($sql) or die (mysql_error());
		return $query;	
	}
	function kwi_tampil_filter($sespriode1,$sespriode2,$sespts,$sesprogram,$seswilayah){
		if(!empty($sespriode1) && !empty($sespriode2)){
			if(!empty($sespts) || !empty($sesprogram) || !empty($seswilayah)){
				$filter_priode = " AND kwi_tgl BETWEEN '$sespriode1' AND '$sespriode2' ";
			}else{
				$filter_priode = " kwi_tgl BETWEEN '$sespriode1' AND '$sespriode2' ";
			}
		}else{
			$filter_priode = "";
		}
		
		if(!empty($sespts)){
			$filter_pts = "kwi_pts='$sespts' ";
		}else{
			$filter_pts = "";
		}
		
		if(!empty($sesprogram)){
			if(!empty($sespts) || !empty($sespriode1) && !empty($sespriode2)){
				$filter_program = " AND kwi_program='$sesprogram' ";
			}else{
				$filter_program = " kwi_program='$sesprogram' ";
			}
		}else{
			$filter_program = "";
		}
		
		if(!empty($seswilayah)){
			if(!empty($sespts) || !empty($sesprogram) || !empty($sespriode1) && !empty($sespriode2)){
				$filter_wilayah = " AND kwi_wilayah='$seswilayah' ";
			}else{
				$filter_wilayah = " kwi_wilayah='$seswilayah' ";
			}
		}else{
			$filter_wilayah = "";
		}
		
		$sql="SELECT * FROM kwi_master WHERE $filter_pts  $filter_program  $filter_wilayah  $filter_priode ORDER BY kwi_id DESC";
		$query=mysql_query($sql) or die (mysql_error());
		return $query;	
	}
	function kwi_tampil_max(){
		$sql="SELECT MAX(kwi_tgl) AS tgl_terakhir FROM kwi_master ORDER BY kwi_nomor DESC";
		$query=mysql_query($sql) or die (mysql_error());
		return $query;	
	}
}
class Nota {

	function nta_tampil($tgl_terakhir){
		$sql="SELECT * FROM nta_master WHERE nta_tgl='$tgl_terakhir' OR nta_tgl='0000-00-00' ORDER BY nta_nomor ASC";
		$query=mysql_query($sql) or die (mysql_error());
		return $query;	
	}
	function nta_insert($nta_mhs,$nta_angkatan,$nta_jurusan,$nta_nomor,$nta_tgl,$nta_daftar,$nta_spb,$nta_spp,$nta_wilayah,$nta_pts,$nta_program,$nta_keterangan,$kar_id){
		$sql="INSERT INTO nta_master VALUES(NULL,'$nta_mhs','$nta_angkatan','$nta_jurusan','$nta_nomor','$nta_tgl','$nta_daftar','$nta_spb','$nta_spp','$nta_wilayah','$nta_pts','$nta_program','$nta_keterangan','$kar_id')";
		$query=mysql_query($sql) or die (mysql_error());
		return $query;
	}
	function nta_update($nta_id,$nta_mhs,$nta_angkatan,$nta_jurusan,$nta_nomor,$nta_tgl,$nta_daftar,$nta_spb,$nta_spp,$nta_wilayah,$nta_pts,$nta_program,$nta_keterangan){
		$sql="UPDATE nta_master SET nta_mhs='$nta_mhs',nta_angkatan='$nta_angkatan',nta_jurusan='$nta_jurusan',nta_nomor='$nta_nomor',nta_tgl='$nta_tgl',nta_daftar='$nta_daftar',nta_spb='$nta_spb',nta_spp='$nta_spp',nta_wilayah='$nta_wilayah',nta_pts='$nta_pts',nta_program='$nta_program',nta_keterangan='$nta_keterangan' WHERE nta_id='$nta_id'";
		$query=mysql_query($sql) or die (mysql_error());
		return $query;
	}
	function nta_delete($nta_id_){
		$sql="DELETE FROM nta_master WHERE nta_id='$nta_id_'";
		$query=mysql_query($sql) or die (mysql_error());
		return $query;	
	}
	function nta_tampil_filter($sespriode1,$sespriode2,$sespts,$sesprogram,$seswilayah){
		if(!empty($sespriode1) && !empty($sespriode2)){
			if(!empty($sespts) || !empty($sesprogram) || !empty($seswilayah)){
				$filter_priode = " AND nta_tgl BETWEEN '$sespriode1' AND '$sespriode2' ";
			}else{
				$filter_priode = " nta_tgl BETWEEN '$sespriode1' AND '$sespriode2' ";
			}
		}else{
			$filter_priode = "";
		}
		
		if(!empty($sespts)){
			$filter_pts = "nta_pts='$sespts' ";
		}else{
			$filter_pts = "";
		}
		
		if(!empty($sesprogram)){
			if(!empty($sespts) || !empty($sespriode1) && !empty($sespriode2)){
				$filter_program = " AND nta_program='$sesprogram' ";
			}else{
				$filter_program = " nta_program='$sesprogram' ";
			}
		}else{
			$filter_program = "";
		}
		
		if(!empty($seswilayah)){
			if(!empty($sespts) || !empty($sesprogram) || !empty($sespriode1) && !empty($sespriode2)){
				$filter_wilayah = " AND nta_wilayah='$seswilayah' ";
			}else{
				$filter_wilayah = " nta_wilayah='$seswilayah' ";
			}
		}else{
			$filter_wilayah = "";
		}
		
		$sql="SELECT * FROM nta_master WHERE $filter_pts  $filter_program  $filter_wilayah  $filter_priode ORDER BY nta_id DESC";
		$query=mysql_query($sql) or die (mysql_error());
		return $query;	
	}
	function nta_tampil_max(){
		$sql="SELECT MAX(nta_tgl) AS tgl_terakhir FROM nta_master ORDER BY nta_nomor DESC";
		$query=mysql_query($sql) or die (mysql_error());
		return $query;	
	}

}
class Typedomain {
	function tdo_tampil(){
		$sql="SELECT * FROM type_domain WHERE tdo_status='Y' ORDER BY tdo_id ASC";
		$query=mysql_query($sql) or die (mysql_error());
		return $query;	
	}
	function tdo_tampil_id($tdo_id){
		$sql="SELECT * FROM type_domain WHERE tdo_status='Y' AND tdo_id='$tdo_id' ORDER BY tdo_id ASC";
		$query=mysql_query($sql) or die (mysql_error());
		return $query;	
	}
}
class Unlistdomain {
	function udo_tampil(){
		$sql="SELECT * FROM unlist_domain ORDER BY udo_id DESC";
		$query=mysql_query($sql) or die (mysql_error());
		return $query;	
	}
	function udo_tampil_typ($tdo_id){
		$sql="SELECT * FROM unlist_domain WHERE tdo_id='$tdo_id' ORDER BY udo_id DESC";
		$query=mysql_query($sql) or die (mysql_error());
		return $query;	
	}
	function udo_insert($arr_nama,$arr_username,$arr_password,$arr_server,$arr_ip,$arr_keterangan,$tdo_id,$kar_id){
		$sql="INSERT INTO unlist_domain VALUES(NULL,'$arr_nama','$arr_username','$arr_password','$arr_server','$arr_ip','$arr_keterangan','C','$tdo_id','$kar_id')";
		$query=mysql_query($sql) or die (mysql_error());
		return $query;
	}
	function udo_update($udo_id,$udo_nama,$udo_username,$udo_password,$udo_server,$udo_ip,$udo_keterangan,$kar_id){
		$sql="UPDATE unlist_domain SET udo_nama='$udo_nama',udo_username='$udo_username',udo_password='$udo_password',udo_server='$udo_server',udo_ip='$udo_ip',udo_keterangan='$udo_keterangan' WHERE udo_id='$udo_id'";
		$query=mysql_query($sql) or die (mysql_error());
		return $query;	
	}
	function udo_delete($udo_id_){
		$sql="DELETE FROM unlist_domain WHERE udo_id='$udo_id_'";
		$query=mysql_query($sql) or die (mysql_error());
		return $query;	
	}
}
class Jadwal {
	function jdw_insert($jdw_blnthn,$jdw_username,$jdw_nik,$jdw_nama,$jdw_zona,$jdw_wilayah,$jdw_data){
		$sql="INSERT INTO jdw_master VALUES(NULL,'$jdw_blnthn','$jdw_username','$jdw_nik','$jdw_nama','$jdw_zona','$jdw_wilayah','$jdw_data')";
		$query=mysql_query($sql) or die (mysql_error());
		return $query;
	}
	function jdw_tampil($jdw_blnthn,$jdw_zona){
		$sql="SELECT * FROM jdw_master WHERE jdw_blnthn='$jdw_blnthn' AND jdw_zona='$jdw_zona'";
		$query=mysql_query($sql) or die (mysql_error());
		return $query;	
	}
	function jdw_tampil_nik($jdw_blnthn,$jdw_zona,$jdw_nik){
		$sql="SELECT * FROM jdw_master WHERE jdw_blnthn='$jdw_blnthn' AND jdw_zona='$jdw_zona' AND jdw_nik='$jdw_nik'";
		$query=mysql_query($sql) or die (mysql_error());
		return $query;	
	}
	function jdw_tampil_REGEXP($jdw_blnthn,$jdw_zona,$jdw_nik,$kar_jdw_akses){
		$sql="SELECT * FROM jdw_master WHERE jdw_blnthn='$jdw_blnthn' AND jdw_zona='$jdw_zona' AND (jdw_nik='$jdw_nik' OR jdw_nik REGEXP '$kar_jdw_akses')";
		$query=mysql_query($sql) or die (mysql_error());
		return $query;	
	}
	function jdw_delete($jdw_blnthn){
		$sql="DELETE FROM jdw_master WHERE jdw_blnthn='$jdw_blnthn'";
		$query=mysql_query($sql) or die (mysql_error());
		return $query;	
	}
	function jdw_tampil_id($jdw_id){
		$sql="SELECT * FROM jdw_master WHERE jdw_id='$jdw_id'";
		$query=mysql_query($sql) or die (mysql_error());
		return $query;	
	}
	function jdw_update($jdw_id,$jdw_data){
		$sql="UPDATE jdw_master SET jdw_data='$jdw_data' WHERE jdw_id='$jdw_id'";
		$query=mysql_query($sql) or die (mysql_error());
		return $query;
	}
	function jdw_aktif_blnthn(){
		$sql="SELECT * FROM jdw_aktif WHERE jda_id='1' LIMIT 1";
		$query=mysql_query($sql) or die (mysql_error());
		return $query;	
	}
	function jdw_aktif_update($jda_blnthn){
		$sql="UPDATE jdw_aktif SET jda_blnthn='$jda_blnthn' WHERE jda_id='1'";
		$query=mysql_query($sql) or die (mysql_error());
		return $query;
	}
}

class Kpi {
	function kpi_history_kar($kar_id){
		$sql="SELECT * FROM kpi_history WHERE kar_id='$kar_id' ORDER BY kph_id DESC";
		$query=mysql_query($sql) or die (mysql_error());
		return $query;	
	}
	function kpi_history_kar_limit($kar_id){
		$sql="SELECT * FROM kpi_history WHERE kar_id='$kar_id' ORDER BY kph_id DESC LIMIT 1";
		$query=mysql_query($sql) or die (mysql_error());
		return $query;	
	}
	function kpi_history_insert($kph_kontrak,$kph_kode,$kph_start,$kph_end,$kph_keterangan,$kph_masa,$kph_data,$kar_id){
		$sql="INSERT INTO kpi_history VALUES(NULL,'$kph_kontrak','$kph_kode','$kph_start','$kph_end','$kph_keterangan','$kph_masa','$kph_data','$kar_id')";
		$query=mysql_query($sql) or die (mysql_error());
		return $query;
	}
	function kpi_history_update($kph_id,$kph_kontrak,$kph_start,$kph_end,$kph_keterangan,$kph_masa,$kph_data){
		$sql="UPDATE kpi_history SET kph_kontrak='$kph_kontrak',kph_start='$kph_start',kph_end='$kph_end',kph_keterangan='$kph_keterangan',kph_masa='$kph_masa',kph_data='$kph_data' WHERE kph_id='$kph_id'";
		$query=mysql_query($sql) or die (mysql_error());
		return $query;
	}
	function kpi_history_delete($kph_id_){
		$sql="DELETE FROM kpi_history WHERE kph_id='$kph_id_'";
		$query=mysql_query($sql) or die (mysql_error());
		return $query;	
	}
	function kpi_kd_awal($kdawal){
		$sql="SELECT MAX(kpi_id) AS max_kd FROM kpi_master WHERE kpi_kd LIKE '$kdawal%'";
		$query=mysql_query($sql) or die (mysql_error());
		return $query;
	}
	function kpi_kd_auto(){
		$sql="SELECT MAX(kpi_id) AS max_kd_auto FROM kpi_master";
		$query=mysql_query($sql) or die (mysql_error());
		return $query;
	}
	function kpi_sasaran_div($kps_div){
		$sql="SELECT * FROM kpi_sasaran WHERE kps_div='$kps_div' ORDER BY kps_id";
		$query=mysql_query($sql) or die (mysql_error());
		return $query;	
	}
	function kpi_point_jenis($kpb_jenis){
		$sql="SELECT * FROM kpi_point WHERE kpb_jenis='$kpb_jenis' ORDER BY kpb_id";
		$query=mysql_query($sql) or die (mysql_error());
		return $query;	
	}
	function kpi_tampil_kar($kar_id){
		$sql="SELECT * FROM kpi_master WHERE kar_id='$kar_id' ORDER BY kpi_id";
		$query=mysql_query($sql) or die (mysql_error());
		return $query;	
	}
	function kpi_insert($filed,$kpi_div,$kpi_kd,$kpi_jenis,$kpi_keterangan,$kpi_kontrak,$kpi_priode,$kpi_data,$kpi_reward,$kpi_reward_data,$kpi_lampiran,$kpi_penilai1,$kpi_penilai2,$kpi_penilai3,$kpi_sts,$kpi_sesi,$kar_id){
		$sql="INSERT INTO kpi_master ($filed) VALUES(NULL,'$kpi_div','$kpi_kd','$kpi_jenis','$kpi_keterangan','$kpi_kontrak','$kpi_priode','$kpi_data','$kpi_reward','$kpi_reward_data','$kpi_lampiran','$kpi_penilai1','$kpi_penilai2','$kpi_penilai3','$kpi_sts','$kpi_sesi',NOW(),'$kar_id')";
		$query=mysql_query($sql) or die (mysql_error());
		return $query;
	}
	function kpi_tampil_kode($kpi_kd){
		$sql="SELECT * FROM kpi_master WHERE md5(kpi_kd)='$kpi_kd' ORDER BY kpi_id";
		$query=mysql_query($sql) or die (mysql_error());
		return $query;
	}
	function kpi_sasaran_kode($kps_kd){
		$sql="SELECT * FROM kpi_sasaran WHERE kps_kd='$kps_kd' ORDER BY kps_id";
		$query=mysql_query($sql) or die (mysql_error());
		return $query;
	}
	function kpi_update($kpi_id,$kpi_tanggal,$kpi_data,$kpi_sts){
		$sql="UPDATE kpi_master SET kpi_tanggal='$kpi_tanggal',kpi_data='$kpi_data',kpi_sts='$kpi_sts' WHERE kpi_id='$kpi_id'";
		$query=mysql_query($sql) or die (mysql_error());
		return $query;
	}
	function kpi_update_2($kpi_id,$kpi_tanggal,$kpi_data,$kpi_skor,$kpi_sts_skor,$kpi_sts){
		$sql="UPDATE kpi_master SET kpi_tanggal='$kpi_tanggal',kpi_data='$kpi_data',kpi_skor='$kpi_skor',kpi_sts_skor='$kpi_sts_skor',kpi_sts='$kpi_sts' WHERE kpi_id='$kpi_id'";
		$query=mysql_query($sql) or die (mysql_error());
		return $query;
	}
	function kpi_update_sts($kpi_id,$kpi_sts_reward,$kpi_skor,$kpi_sts_skor,$kpi_ditetapkan,$kpi_saranperbaikan,$kpi_sts){
		$sql="UPDATE kpi_master SET kpi_sts_reward='$kpi_sts_reward',kpi_skor='$kpi_skor',kpi_sts_skor='$kpi_sts_skor',kpi_ditetapkan='$kpi_ditetapkan',kpi_saranperbaikan='$kpi_saranperbaikan',kpi_sts='$kpi_sts' WHERE kpi_id='$kpi_id'";
		$query=mysql_query($sql) or die (mysql_error());
		return $query;
	}
	function kpi_tampil_id($kpi_id){
		$sql="SELECT * FROM kpi_master WHERE md5(kpi_kd)='$kpi_id' ORDER BY kpi_id";
		$query=mysql_query($sql) or die (mysql_error());
		return $query;
	}
	function kpi_cek_history($kpi_kontrak,$kar_id){
		$sql="SELECT * FROM `kpi_master` WHERE kpi_kontrak='$kpi_kontrak' AND kar_id='$kar_id' ORDER BY kpi_priode DESC LIMIT 1";
		$query=mysql_query($sql) or die (mysql_error());
		return $query;
	}
}

class Reward {
	function rwd_activity_cek($rwd_nik,$rwd_tanggal){
		$sql="SELECT * FROM rwd_data WHERE rwd_nik='$rwd_nik' AND rwd_tanggal='$rwd_tanggal' ORDER BY rwd_id ASC";
		$query=mysql_query($sql) or die (mysql_error());
		return $query;	
	}
	function rwd_activity_insert($filed,$rwd_nik,$rwd_nm,$rwd_jumlah,$rwd_jumlah1,$rwd_datatext1,$rwd_jumlah2,$rwd_datatext2,$rwd_jumlah3,$rwd_datatext3,$rwd_tanggal){
		$sql="INSERT INTO rwd_data ($filed) VALUES(NULL,'$rwd_nik','$rwd_nm','$rwd_jumlah','$rwd_jumlah1','$rwd_datatext1','$rwd_jumlah2','$rwd_datatext2','$rwd_jumlah3','$rwd_datatext3','$rwd_tanggal')";
		$query=mysql_query($sql) or die (mysql_error());
		return $query;
	}
	function rwd_activity_update($rwd_nik,$rwd_jumlah,$rwd_jumlah1,$rwd_datatext1,$rwd_jumlah2,$rwd_datatext2,$rwd_jumlah3,$rwd_datatext3,$rwd_tanggal){
		$sql="UPDATE rwd_data SET rwd_jumlah='$rwd_jumlah',rwd_jumlah1='$rwd_jumlah1',rwd_datatext1='$rwd_datatext1',rwd_jumlah2='$rwd_jumlah2',rwd_datatext2='$rwd_datatext2',rwd_jumlah3='$rwd_jumlah3',rwd_datatext3='$rwd_datatext3' WHERE rwd_nik='$rwd_nik' AND rwd_tanggal='$rwd_tanggal'";
		$query=mysql_query($sql) or die (mysql_error());
		return $query;
	}
	function rwd_activity_list($start,$end){
		//$sql="SELECT * FROM rwd_data WHERE rwd_tanggal BETWEEN '$start' AND '$end' ORDER BY rwd_nm ASC";
		$sql="SELECT a.*, c.kar_dtl_typ_krj FROM rwd_data a LEFT JOIN kar_master b ON a.rwd_nik = b.kar_nik LEFT JOIN kar_detail c ON b.kar_id = c.kar_id WHERE a.rwd_tanggal BETWEEN '$start' AND '$end' AND c.kar_dtl_typ_krj <> 'Resign' ORDER BY a.rwd_nm ASC";
		$query=mysql_query($sql) or die (mysql_error());
		return $query;	
	}
}
?>
