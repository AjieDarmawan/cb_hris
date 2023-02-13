<?php
	$page=$_GET['p'];

	$act=$_GET['act'];

	
/*
	function getListBank() {

		

		$data = array();

		$sSQL = 'SELECT * FROM bank_kliring;

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

	$list_kliring = getListBank();
	*/
?>