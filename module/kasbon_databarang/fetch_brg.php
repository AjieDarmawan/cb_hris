<?php

error_reporting(0);
date_default_timezone_set("Asia/Bangkok");
require('../../class.php');
require('../../object.php');
$db->koneksi();

$query = '';
$output = array();
$query .= "SELECT * FROM barang_master ";
if(isset($_POST["search"]["value"]))
{
	$query .= ' WHERE kode_barang LIKE "%'.$_POST["search"]["value"].'%" ';
	$query .= ' OR nama_barang LIKE "%'.$_POST["search"]["value"].'%" ';
	$query .= ' OR klp LIKE "%'.$_POST["search"]["value"].'%" ';
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

//echo $query; return;
$num_total = mysql_num_rows(mysql_query($query_total)); 
$q_brg    = mysql_query($query);
$data1 = array();
while ($r=mysql_fetch_array($q_brg)){
  $kdklp = $r['kdklp'];
  $xklp = "-";
  if ($kdklp=="1"){
    $xklp ="Operasional";
  }elseif($kdklp=="2"){
    $xklp ="Marketing Tools";
  }elseif($kdklp=="3"){
    $xklp ="ATK";
  }elseif($kdklp=="4"){
    $xklp ="Kumsumsi";
  }
  
  $edit='
		  <a href="#myModalbarang" class="label label-primary" title="Edit Data Barang" 
		  data-toggle="modal" data-id="'.$r['id'].'" data-p="'.$p.'">
		  <i class="fa fa-pencil"></i> 
		  </a>
		  ';
					  			  
  $sub_array = array();
  $sub_array[] = $r['id'];
  $sub_array[] = $r['kode_barang'];
  $sub_array[] = $r['nama_barang'];
  $sub_array[] = '<div align="center">'.number_format($r['harga1']).'</div>';
  $sub_array[] = $xklp;
  $sub_array[] = $edit;
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



?>