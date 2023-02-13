<?php
error_reporting(E_ALL ^ E_NOTICE);
date_default_timezone_set('Asia/Jakarta');
session_start();

class Database{
	private $db_host="daftarkuliah.my.id";
	private $db_user="daftarin_bdc";
	private $db_pass="kagaklupa";
	private $db_name="daftarin_bdc";
	
	function koneksi(){
		mysql_connect($this->db_host, $this->db_user, $this->db_pass) or die(mysql_error());
		if(mysql_connect){
			mysql_select_db($this->db_name) or die(mysql_error());
		}else{
			echo"Database Not Connection";
		}
	}
}

class Activity_facebook{
        function act_tampil_arr_fbpo($table_activity_facebook,$table_activity_po,$act_username,$r_awal_ori,$r_sekarang_ori){
		$sql="SELECT 
			t.act_username,
			t.act_nama,
			SUM(t.act_data) AS act_data
			FROM 
			(SELECT 
			act_username,
			act_nama,
			act_data,
			act_tanggal
			FROM `$table_activity_facebook` 
                      WHERE 
			act_username IN ('$act_username') AND
			act_tanggal BETWEEN '$r_awal_ori' AND '$r_sekarang_ori'
			UNION ALL SELECT 
			act_username,
			act_nama,
			act_data,
			act_tanggal
			FROM `$table_activity_po`
                      WHERE 
			act_username IN ('$act_username') AND
			act_tanggal BETWEEN '$r_awal_ori' AND '$r_sekarang_ori'
                        ) 
			AS t 
			GROUP BY t.act_nama,t.act_username;";
		$query=mysql_query($sql) or die (mysql_error());
		return $query;	
	}
}

$db=new Database();
$act=new Activity_facebook();

$db->koneksi();


$table_activity_facebook = 'activity_facebook_ads';
$table_activity_po = 'activity_po_ads';
$act_username = str_replace('.','',$_POST['kar_nik']);
$r_awal_ori = $_POST['start'];
$r_sekarang_ori = $_POST['end'];

$act_tampil_arr = $act->act_tampil_arr_fbpo($table_activity_facebook,$table_activity_po,$act_username,$r_awal_ori,$r_sekarang_ori);
$act_data_arr = mysql_fetch_assoc($act_tampil_arr);



$date1=date_create($r_awal_ori);
$date2=date_create($r_sekarang_ori);
$diff=date_diff($date1,$date2);
$days = $diff->format("%a");

$bdc_data = 0;

if($act_data_arr['act_data'] > 0){
	$rata2 = $act_data_arr['act_data'] / $days;
	$bdc_data = round($rata2, 0, PHP_ROUND_HALF_DOWN);
}

echo $bdc_data ? $bdc_data : 0;
?>