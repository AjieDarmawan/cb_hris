<?php

	header("Access-Control-Allow-Origin: *");
	header("Access-Control-Allow-Headers: *");
	error_reporting(0);
	date_default_timezone_set('Asia/Jakarta');
	

	require('../../class.php');
	require('../../object.php');
	
	$db->koneksi();
	
		
	foreach($_REQUEST as $name=>$value)
	{
			$$name=$value;
			//echo "$name : $value;<br />\n";
    }

    

	if ($level==""){
	    $level = "7";
	}
	
    //return;
	
///////////////kunpulan function///////////////////////////////////////////////////////////	
	function __list_karyawan($id) {
		$data = array();
		$sSQL = " 	
					SELECT * FROM 
						  kar_master,
						  kar_detail,
						  jbt_master,
						  lvl_master,
						  div_master,
						  unt_master,
						  ktr_master
						  WHERE
						  kar_master.kar_id=kar_detail.kar_id AND
						  kar_master.jbt_id=jbt_master.jbt_id AND 
						  kar_master.lvl_id=lvl_master.lvl_id AND
						  kar_master.div_id=div_master.div_id AND
						  kar_master.unt_id=unt_master.unt_id AND
						  kar_master.ktr_id=ktr_master.ktr_id AND
						  kar_master.kar_id='$id'
						  ORDER BY kar_master.kar_id					
					";
					
		$query=mysql_query($sSQL) or die (mysql_error());
		while($row=mysql_fetch_assoc($query)) {
			 $data[] = $row ;
 			// array_push($data,$row);
		}
		$json 	= json_encode($data);
		return (json_decode($json,true));
	}	



	function __list_pinjaman($id) {
		$data = array();
		$sSQL = "
				SELECT * FROM _paguyuban_master a
				WHERE a.pg_id='$id' 
				ORDER BY a.pg_id 		 	
				";
				
		$query=mysql_query($sSQL) or die (mysql_error());
		while($row=mysql_fetch_assoc($query)) {
			 $data[] = $row ;
 			// array_push($data,$row);
		}
		$json 	= json_encode($data);
		return (json_decode($json,true));
	}	
	
	function __list_karyawan_all() {
		$data = array();
		$sSQL = " 	
					SELECT * FROM 
						  kar_master,
						  kar_detail,
						  jbt_master,
						  lvl_master,
						  div_master,
						  unt_master,
						  ktr_master
						  WHERE 
						  kar_master.kar_id=kar_detail.kar_id AND 
						  kar_master.jbt_id=jbt_master.jbt_id AND 
						  kar_master.lvl_id=lvl_master.lvl_id AND
						  kar_master.div_id=div_master.div_id AND
						  kar_master.unt_id=unt_master.unt_id AND
						  kar_master.ktr_id=ktr_master.ktr_id AND
						  kar_detail.kar_dtl_typ_krj <> 'Resign' AND
						  jbt_master.jbt_id > 13 
						  ORDER BY kar_master.kar_id					
					";
					
		$query=mysql_query($sSQL) or die (mysql_error());
		while($row=mysql_fetch_assoc($query)) {
			 $data[] = $row ;
 			// array_push($data,$row);
		}
		$json 	= json_encode($data);
		return (json_decode($json,true));
	}	
		
	function __list_unit_kerja() {
		$data = array();
		$sSQL = " SELECT * FROM unt_master  ORDER BY unt_id ";
		$query=mysql_query($sSQL) or die (mysql_error());
		while($row=mysql_fetch_assoc($query)) {
			 $data[] = $row ;
 			// array_push($data,$row);
		}
		$json 	= json_encode($data);
		return (json_decode($json,true));
	}		

	function __list_divisi() {
		$data = array();
		$sSQL = " SELECT * FROM div_master WHERE div_id > 3 ORDER BY div_id ";
		$query=mysql_query($sSQL) or die (mysql_error());
		while($row=mysql_fetch_assoc($query)) {
			 $data[] = $row ;
 			// array_push($data,$row);
		}
		$json 	= json_encode($data);
		return (json_decode($json,true));
	}
	

	function __list_jabatan() {
		$data = array();
		$sSQL = " SELECT * FROM jbt_master WHERE jbt_id > 13  ORDER BY jbt_id ";
		$query=mysql_query($sSQL) or die (mysql_error());
		while($row=mysql_fetch_assoc($query)) {
			 $data[] = $row ;
 			// array_push($data,$row);
		}
		$json 	= json_encode($data);
		return (json_decode($json,true));
	}

	function __list_level() {
		$data = array();
		$sSQL = " SELECT * FROM lvl_master  WHERE lvl_id > 3  ORDER BY lvl_id ";
		$query=mysql_query($sSQL) or die (mysql_error());
		while($row=mysql_fetch_assoc($query)) {
			 $data[] = $row ;
 			// array_push($data,$row);
		}
		$json 	= json_encode($data);
		return (json_decode($json,true));
	}

	function __list_kantor() {
		$data = array();
		$sSQL = " SELECT ktr_id,ktr_nm FROM ktr_master  ORDER BY ktr_id ";
		$query=mysql_query($sSQL) or die (mysql_error());
		while($row=mysql_fetch_assoc($query)) {
			 $data[] = $row ;
 			// array_push($data,$row);
		}
		$json 	= json_encode($data);
		return (json_decode($json,true));
	}
				


		

	
///////////////////////////////////////////////////////////////////////////////////////////	
				
	if ($mode == "_list_tabel" || $aksi_proses == "add_data" || $aksi_proses == "edit_data"){
	    return '';
	}	
			
////////////////////////////////////////////////////////////////////////////////////////	

			
	if ($mode=="delete_detail_perform"){		
		$data = array();
		$sSQL_DEL = " DELETE FROM _paguyuban_master  WHERE pg_id = '$id'  ";
		$query=mysql_query($sSQL_DEL) or die (mysql_error());
		
		if($query) { 
			 $retuen = array('status'=>"1","msg"=>"delete");
		} else { 
			$retuen = array('status'=>"0","msg"=>"Gagal");
		}

		echo json_encode($retuen);		
															
	}else{
	    $retuen = array('status'=>"0","msg"=>"gagal");
	    echo json_encode($retuen);	
	}	
	//echo '<br>';
	//print_r($data);
	//echo '</br>';	
	
		
?>	