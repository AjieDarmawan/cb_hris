<?php

   foreach($_REQUEST as $name=>$value){
      $$name=$value;
      //echo "$name : $value;<br />\n";
   }
 
   //informasi koneksi ke database////////////////////////
	
   if ($_SERVER['HTTP_HOST']=="localhost"){
	    $gaSql['user']       = "root";
	    $gaSql['password']   = "mysql";
	    $gaSql['db']         = "absen";
	    $gaSql['server']     = "localhost";
    }else{
	    $gaSql['user']       = "absen";
	    $gaSql['password']   = "2014sukses";
	    $gaSql['db']         = "absen";
	    $gaSql['server']     = "localhost";	
    }	
       
   $gaSql['link'] =  @mysql_pconnect( $gaSql['server'], $gaSql['user'], $gaSql['password']  ) or
	   die( 'Could not open connection to server' );
   
   @mysql_select_db( $gaSql['db'], $gaSql['link'] ) or 
	   die( 'Could not select database '. $gaSql['db'] );
	   
   ///////////////////////////////////////////////////////////////////////
   $filter_tool = "";
   $query   = '';
   $output  = array();
   
   $query .= "
			   SELECT a.*
			   FROM tmp_marketing_support a
			   WHERE 1=1 $filter_tool  
			   ";
   
   if(isset($_POST["search"]["value"]))
   {
	   $query .= ' AND ( ';
	   $query .= ' a.mfc_nama LIKE "%'.$_POST["search"]["value"].'%" ';
	   $query .= ' OR a.mfc_nohp LIKE "%'.$_POST["search"]["value"].'%" ';
	   $query .= ' OR a.mfc_email LIKE "%'.$_POST["search"]["value"].'%" ';
	   $query .= ' OR a.mfc_kota LIKE "%'.$_POST["search"]["value"].'%" ';
	   $query .= ' OR a.mfc_informasi LIKE "%'.$_POST["search"]["value"].'%" ';
	   $query .= ' OR a.mfc_status LIKE "%'.$_POST["search"]["value"].'%" ';
	   
	   $query .= ' ) ';
   }
   if(isset($_POST["order"]))
   {
	   $query .= 'ORDER BY '.$_POST['order']['0']['column'].' '.$_POST['order']['0']['dir'].' ';
   }
   else
   {
	   $query .= ' ORDER BY a.mfc_id ';
   }
   $query_total = $query ;

   if($_POST["length"] != -1)
   {
	   if ($_POST['start']==""){
		   $_POST['start'] = 0;
		   $_POST['length']=10;
	   }		
	   $query .= 'LIMIT ' . $_POST['start'] . ', ' . $_POST['length'];
   }
   
   //echo $query; return;
    
   $num_total = mysql_num_rows(mysql_query($query_total)); 

   $q_data   = mysql_query($query);
   $data1 = array();
   $urut = 0;
   while ($aRow=mysql_fetch_array($q_data)){
	   $urut++;
		   $sub_array = array();
		   $sub_array[] = $aRow['mfc_id'];
		   $sub_array[] = $aRow['mfc_nama'];
		   $sub_array[] = $aRow['mfc_nohp'];		
		   $sub_array[] = $aRow['mfc_email'];
		   $sub_array[] = $aRow['mfc_kota'];
		   $sub_array[] = $aRow['mfc_tmplahir'];
		   $sub_array[] = $aRow['mfc_tglahir'];
		   $sub_array[] = $aRow['mfc_pendidikan'];
		   $sub_array[] = $aRow['mfc_pekerjaan'];
		   $sub_array[] = $aRow['mfc_informasi'];
		   $sub_array[] = $aRow['mfc_status'];
		   $sub_array[] = $aRow['mfc_ket'];
		   $sub_array[] = $aRow['mfc_batch'];
						     
		   array_push($data1,$sub_array);
      
   }
   $output = array(
	   "draw"		=>	intval($_POST["draw"]),
	   "recordsTotal"	=> 	$num_total,
	   "recordsFiltered"	=>	$num_total,
	   "data"		=>	$data1
   );
   echo json_encode($output);
   ////////////////////////////////////////////////////////////////////////////////

?>