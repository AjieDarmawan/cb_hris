<?php

   $date_file = date('Y-m-d');

   foreach($_REQUEST as $name=>$value){
      $$name=$value;
      //echo "$name : $value;<br />\n";
   }
 
   //informasi koneksi ke database////////////////////////
	include("koneksi_db.php");
   ///////////////////////////////////////////////////////////////////////
	if ($aksi=="delete"){
		 $q_del   = " DELETE FROM tmp_marketing_support WHERE  mfc_id = '$id' ";
		 $ret_del =  mysql_query($q_del);
 	}
	if ($act=="edit"){
		 $q_upd   = " UPDATE tmp_marketing_support 
		 			  SET mfc_status='$mfc_status',mfc_batch='$mfc_batch', mfc_ket = '$mfc_ket' ,mfc_tglmdf='$date_file'
		 			  WHERE  mfc_id = '$id' ";
		 //echo $q_upd; return;			  
		 $ret_upd =  mysql_query($q_upd);	
	}	   
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
		 
		 $id   = $aRow['mfc_id'];
		 $nama = $aRow['mfc_nama'];			 
	   
		  $edit = " <button  onclick=\"doMyEDIT('$id','$nama')\" class=\"btn-xs btn-primary \">
		  			<i class=\"fa fa-edit\" title=\"Edit Status\"></i>&nbsp; </button> 
					<button  onclick=\"doMyDELETE('$id','$nama')\" class=\"btn-xs btn-danger \">
					<i class=\"fa fa-trash\" title=\"del-data\"></i>&nbsp; 
					</button> ";
						   
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
		   $sub_array[] = '<center>'.$aRow['mfc_batch'].'</center>';
		   $sub_array[] = '<div>'.$edit.'</div>';	  
						     
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