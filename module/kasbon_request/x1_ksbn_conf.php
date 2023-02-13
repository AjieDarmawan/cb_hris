<?php
	$page=$_GET['p'];
	$act=$_GET['act'];
	$range_now = date('d/m/Y') . ' - ' . date('d/m/Y');
	
	function getListkliring() {
		
		$data = array();
		$sSQL = 'SELECT id, unit, norek FROM bank_listrek where `status` = 1';
		$query=mysql_query($sSQL) or die (mysql_error());
		while($row=mysql_fetch_assoc($query)) {
			
			$newdata = array();
			$newdata['value'] = $row['id'];
			unset($row['id']);
			$newdata['label'] = @implode(" - ", array_filter($row));
			
			$data[] = $newdata;
		}
		
		return $data;		
	}
	$list_kliring = getListkliring();
	
	
	
	function getListkantor() {
		
		$data = array();
		$sSQL = 'SELECT ktr_id as id, ktr_nm FROM ktr_master where `ktr_aktif` = "A"';
		$query=mysql_query($sSQL) or die (mysql_error());
		while($row=mysql_fetch_assoc($query)) {
			
			$newdata = array();
			$newdata['value'] = $row['id'];
			unset($row['id']);
			$newdata['label'] = @implode(" - ", array_filter($row));
			
			$data[] = $newdata;
		}
		
		return $data;		
	}
	$list_kantor = getListkantor();
	
	
	
	
	
	
	/*
	echo "<pre>";
	echo print_r($list_kliring);
	echo "</pre>";
	exit;
	*/