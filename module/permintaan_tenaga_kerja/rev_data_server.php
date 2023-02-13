
<?php 



error_reporting(0);
date_default_timezone_set('Asia/Jakarta');
session_start();

require('../../class.php');
require('../../object.php');

$db->koneksi();


$cek_nik = $_SESSION['kar'];
//$num_nik = mysql_num_rows(mysql_query("SELECT * FROM x_po_user WHERE kar_nik='$cek_nik'  "));
//if ($_SESSION['role']=="1" || $_SESSION['role']=="2"){
//  $num_nik = 1 ;
//}
/*
class dataTable {
	protected $ssql;
	protected $whys = array();
	protected $config = array();
	public function __construct($config = array()) {		
		$this->config = $config;
	}
}
*/
	
foreach($_REQUEST as $name=>$value)
	{
			$$name=$value;
			//echo "$name : $value;<br />\n";
   }

 
			  
   
//return;

if(isset($_POST['mode']) && $_POST['mode'] <> '') {

	if($_POST['mode'] == "list_data_tenaga_kerja") {
	


 		
	//	$range_now = date('01/m/Y') . ' - ' . date('d/m/Y');
	//	$range_now_ori = date('Y-m-01') . ' - ' . date('Y-m-d');
	
    	$range_now = date('01/01/Y') . ' - ' . date('d/m/Y');
		$range_now_ori = date('Y-01-01') . ' - ' . date('Y-m-d');
		if ($tanggal <> ""){
		    $range_now_ori = $tanggal ;
		}
		
       // echo $range_now_ori ;return;
		
		$range = @explode(" - ", $range_now_ori);
		$datestart = date('Y-m-d', strtotime(str_replace('/', '-', $range[0])));
		$dateend = date('Y-m-d', strtotime(str_replace('/', '-', $range[1])));
		$filter_tgl = "";
		$filter_nomor = "";
		$filter_progres = "";
		if (filter_tgl <> "") {
	   		$filter_tgl = ' AND (DATE_FORMAT(a.tanggal, "%Y-%m-%d") BETWEEN "' . $datestart . '" AND "'. $dateend . '" )';
	   }

		$id =  $_REQUEST['id'] ;
		if ($id <> ""){
		   //  $filter_nik =  " AND a.kar_id = '$id' "; 
		}
	    $filter_nik = "";
		if ($cek_nik == 499 || $cek_nik == 551 || $cek_nik == 542 || $cek_nik == 37 ){
		  ////////admin atau sdm////////////// 
		}else{
           $filter_nik = " AND ( a.pemohon_id = '$cek_nik' OR a.manager_id='$cek_nik' 
		                        OR a.dirmud_id='$cek_nik' OR a.direktur_id='$cek_nik'
						      ) ";
		}
		
		$filter_jab    =  "  AND a.jbt_id > 13  AND a.div_id > 3 "; //////selain direksi dan komesaris//////// 
		$filter_status =  "  AND d.kar_dtl_typ_krj <> 'Resign'  ";
		$filter_div    =  "  AND ( c.div_nm <> 'IT'  AND c.div_nm <> 'SDM' 
		                     AND c.div_nm <> 'Desain Grafis' AND c.div_nm <> 'Umum' ) ";
		$query   = '';
		$output  = array();

		$query .= "
					SELECT
					a.tk_id,a.manager_id,dirmud_id,direktur_id,
					a.tgl_kerja,a.status_proses,a.tk_id,a.tanggal,
					a.nama,a.usia,a.pendidikan,e.jbt_nm,a.pemohon_id,
					a.manager_approval,a.dirmud_approval,a.direktur_approval,
					c.div_nm,b.ktr_kd,
					f.kar_nm as nm_manager,g.kar_nm as nm_dirmud,h.kar_nm as nm_direktur 
					FROM _tenaga_kerja_master a
					LEFT JOIN  ktr_master b ON b.ktr_id=a.ktr_id
					LEFT JOIN  div_master c ON c.div_id=a.div_id
					LEFT JOIN  kar_detail d ON d.kar_id=a.kar_id
					LEFT JOIN  jbt_master e ON e.jbt_id=a.jbt_id
					LEFT JOIN  kar_master f ON f.kar_id = a.manager_id 
					LEFT JOIN  kar_master g ON g.kar_id = a.dirmud_id
					LEFT JOIN  kar_master h ON h.kar_id = a.direktur_id 
					WHERE 1=1  ".$filter_nik." ".$filter_tgl." " ;
		
		//filter_status $filter_jab $filter_div $filter_nik //
					
		if(isset($_POST["search"]["value"]))
		{
			$query .= ' AND ( ';
			$query .= ' a.nik LIKE "%'.$_POST["search"]["value"].'%" ';
			$query .= ' OR a.nomor LIKE "%'.$_POST["search"]["value"].'%" ';
			$query .= ' OR c.div_nm LIKE "%'.$_POST["search"]["value"].'%" ';
			$query .= ' OR e.jbt_nm LIKE "%'.$_POST["search"]["value"].'%" ';
			$query .= ' OR f.kar_nm LIKE "%'.$_POST["search"]["value"].'%" ';
			$query .= ' OR g.kar_nm LIKE "%'.$_POST["search"]["value"].'%" ';
			$query .= ' OR h.kar_nm LIKE "%'.$_POST["search"]["value"].'%" ';
			$query .= ' OR c.div_nm LIKE "%'.$_POST["search"]["value"].'%" ';
			$query .= ' OR b.ktr_kd LIKE "%'.$_POST["search"]["value"].'%" ';
			$query .= ' ) ';
		}
		if(isset($_POST["order"]))
		{
			$query .= 'ORDER BY '.$_POST['order']['0']['column'].' '.$_POST['order']['0']['dir'].' ';
		}
		else
		{
			$query .= ' ORDER BY a.nik ASC ';
		}
		$query_total = $query ;
		
		// echo $query_total;return;
		
		if($_POST["length"] != -1)
		{
			$query .= 'LIMIT ' . $_POST['start'] . ', ' . $_POST['length'];
		}
		
	
		$num_total = mysql_num_rows(mysql_query($query_total)); 


		//////////////////////////////////////////////////////
		$q_brg   	 = mysql_query($query);
		$data1 		= array();
		$urut 		= 0 ;
		$no			= 0 ;
		$previous_season = "" ;
		while ($r=mysql_fetch_array($q_brg)){
			$urut++;
			$no++;
			$season = $r['nik'];
			if ($season != $previous_season) {
				//echo '<tr>';echo "<td> Group : $season </td>";echo '</tr>';
				$previous_season = $season;
				$no = 1;
				
		    }		
			$xstatus = "";
			$class = "label-default";	 
			
			$cek_id      = $r['tk_id'];
			$kar_nik     = $r['nik'];  
			$kar_nm      = $r['nama'];  
			$pemohon_id  = $r['pemohon_id'];
			///////////////////////////////////////////////////////////////////////////		
			$id        	= $r[do_id];
			
			$approve_1  = '<a href="#"  
							 onclick="doUpdateData(\''.$cek_id.'\',\''.'approve-manager'.'\')" 
							 title="Approval Manager" >
						     <span class="btn btn-info mb1 bg-info btn-xs"  > 
								<i class="fa fa-pencil-square-o"></i> 
						    </span>
						 </a> ';			

			$approve_2  = '<a href="#"  
							 onclick="doUpdateData(\''.$cek_id.'\',\''.'approve-dirmud'.'\')" 
							 title="Approval Dirmud" >
						     <span class="btn btn-info mb1 bg-info btn-xs"  > 
								<i class="fa fa-pencil-square-o"></i> 
						    </span>
						 </a> ';			

			$approve_3  = '<a href="#"  
							 onclick="doUpdateData(\''.$cek_id.'\',\''.'approve-direktur'.'\')" 
							 title="Approval Direktur" >
						     <span class="btn btn-info mb1 bg-info btn-xs"  > 
								<i class="fa fa-pencil-square-o"></i> 
						    </span>
						 </a> ';
						 
			$cetak_data  = '<a href="#"  
							 onclick="doUpdateData(\''.$cek_id.'\',\''.'hanya-cetak'.'\')" title="Print">
						     <span class="btn btn-primary mb1 bg-black btn-xs"  > 
								<i class="fa fa-print"></i> 
						    </span>
						 </a> ';			

			$del_data  = '<button type="button" class=" btn  btn-danger  btn-xs " 
							 onclick="doDeletePerform(\''.$cek_id.'\')"
							 title="Delete"  >
							 <span class="fa fa-trash"></span>
					      </button>
				   		';	


			$edit_data  = '<button type="button" class=" btn  btn-primary  btn-xs " 
							 onclick="doUpdateData(\''.$cek_id.'\')"
							 title="Edit Data"  >
							 <span class="fa fa-pencil"></span>
					      </button>
				   		';	
         
/*
		  $edit_pemohon  = '<button type="button" class=" btn  btn-primary  btn-xs " 
							 onclick="doUpdateData(\''.$cek_id.'\')"
							 title="Edit Data"  >
							 <span class="fa fa-pencil"></span>
					      </button>
				   		';				

*/

		  $edit_pemohon  = '<button type="button" class=" btn  btn-primary  btn-xs " 
							  onclick="doUpdateData(\''.$cek_id.'\',\''.'edit-manager'.'\')" 
							 title="Edit Data"  >
							 <span class="fa fa-pencil"></span>
					      </button>
				   		';				
	
						 
				$block="";
				$check1="";		
                if($r['manager_approval'] == 1 ){
                    $block="danger";
                    $check1="<i class='fa fa-check text-green'></i>";
					$approve_1 = '';
					$edit_pemohon = "";
                } 	

				$check2="";		
                if($r['dirmud_approval'] == 1 ){
                    $check2="<i class='fa fa-check text-green'></i>";
					$approve_2 = '';
					$edit_pemohon = "";
                } 	

				$check3="";		
                if($r['direktur_approval'] == 1 ){
                   $check3="<i class='fa fa-check text-green'></i>";
				   $approve_3 = '';
				   $edit_pemohon = "";
                } 	

			$tbl_1 ='<div style="line-height:30px">'.$check.' <a href="#" 
					 onclick="doNIK(\''.$kar_id.'\',\''.$kar_nik.'\',\''.$kar_nm.'\')">'
					 .$r['nik'].'</a>'.'</div>';
			
			$proses = $r['status_proses'];
			$lbl    = "label-default";
		
			if ($proses == "New"){
			  	$lbl    = "label-primary" ;
			}elseif($proses == "Proses"){ 
				$lbl    = "label-info" ;
			}elseif($proses == "Diterima"){ 
				$lbl    = "label-success" ;	   
			}elseif($proses == "Ditolak"){ 
				$lbl    = "label-danger" ;	
			}elseif($proses == "Batal"){ 
				$lbl    = "label-danger" ;	   										   	
		    }
			
			$tgl_kerja = '-';
			if ($proses == "Diterima" ){
			    $tgl_kerja = $r['tgl_kerja'] ;
			}
			if ($proses <> "New" ){
				  $edit_data = '';
			      $del_data  = '';
			}
		   if ($cek_nik == 499 || $cek_nik == 551 || $cek_nik == 542 ){
		   }else{
		     $edit_data = "";
			 $del_data = "";
		   }
			if ($r['pemohon_id']==$cek_nik || $r['manager_id']==$cek_nik ){
			  $approve_2 = "";
			  $approve_3 = "";
			}
			if ($r['dirmud_id']==$cek_nik ){
			   $edit_pemohon = "";
			   $approve_3 = "";
			}	
			if ($r['direktur_id']==$cek_nik ){
			    $edit_pemohon = "";
				$approve_2 = "";
			}
			if ($r['manager_approval']=='0' || $r['dirmud_approval']=='0' ){
			   $approve_3 = "";
			}							
			$proses = '<span class="label '.$lbl.' " style="font-size:14px;  ">'.$proses.'</span>';				
									  
			$sub_array = array();
			$sub_array[] = $r['tk_id'];
			$sub_array[] = '<center>'.$cetak_data.' '.$edit_data.' '.$del_data .'</center>' ;
//			$sub_array[] = '<center>'.$check1.' '.$approve_1.' '.$r['nm_manager'].'</center>';
			$sub_array[] = ''.$edit_pemohon.' '.$check1.' '.$r['nm_manager'].'';
			$sub_array[] = ''.$check2.' '.$approve_2.' '.$r['nm_dirmud'].'';;
			$sub_array[] = ''.$check3.' '.$approve_3.' '.$r['nm_direktur'].'';;
			$sub_array[] = '<div ><center><b>'.$tgl_kerja.'</b></center></div>';;
			$sub_array[] = '<div ><center>'.$proses.'</center></div>';
			$sub_array[] = '<center>'.$r['tk_id'].'</center>';
			$sub_array[] = '<div  >'.$r['tanggal'].'</div>';
			$sub_array[] = $r['nm_manager'];
			$sub_array[] = '<center>'.$r['usia'].'</center>';
			$sub_array[] = '<center>'.$r['pendidikan'].'</center>';
			$sub_array[] = $r['jbt_nm'];
			$sub_array[] = $r['div_nm'];
			$sub_array[] = $r['ktr_kd'];

			//$sub_array[] = '';			

						
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
			die();
		
	}

	elseif($_POST['mode'] == "simpan") {
		//echo "simpan sini ... ";exit;	
		$output = simpan_datauser($_POST);
		echo json_encode($output);
		die();

	}

	elseif($_POST['mode'] == "batal") {
		$output = batalkan_datauser($_POST);
		echo json_encode($output);
		die();
	}

	

	else{

		//header('Location: http://kpt.co.id/');
		die();

	}

}





function simpan_datauser($prop = array()) {
//    echo 'simpan-data !... ';return;
	foreach($_REQUEST as $name=>$value)
	{
		$$name=$value;
		//echo "$name : $value;<br />\n";
	}


    //return;

	$kar_id = $_SESSION['kar'] ; 
	
	$tgl = date('Y-m-d');
	$xpemesan = $pemesan ;
	
	$sSQL = "";
	$sSQL_OK = "0";
	
    if ( $btnDITOLAK  == "DITOLAK" ){
	        $sql_upd = " UPDATE _tenaga_kerja_master SET dirmud_approval=1, direktur_approval=1,status_proses='Ditolak' 
						 WHERE  tk_id = '$id' " ;
			//echo $sql_upd ; return;
			$sSQL  = mysql_query($sql_upd) ;	
			$sSQL_OK = "1";	 
			$retuen = array('status'=>"1","msg"=>"berhasil");
			return $retuen; 	 		
    }
	//return;	
	if ($aksi=="save_adddata_review" and $aksi_proses=='add_data'){
	  //  $sql_auto_reset = " ALTER TABLE _tenaga_kerja_master AUTO_INCREMENT = 1 ";
	  //  $sSQL = mysql_query($sql_auto_reset) ;	
		    $tanggal = date('Y-m-d');
            $status_proses 	 	= 'New' ;
			$manager_approval 	= '0' ;
			$dirmud_approval  	= '0' ;
			$direktur_approval 	= '0' ;

			
			$sql_add="INSERT INTO _tenaga_kerja_master  
					  ( 
					    tanggal,
						tgl_kerja,
						nama,
						usia,
						jumlah,
						status_proses,
						status_pegawai,
						jenis_kelamin,
						pendidikan,
						pengalaman_kerja,
						uraian_jabatan,
						kemampuan_lain,
						alasan,
						lvl_id,
						jbt_id,
						div_id,
						unt_id,
						ktr_id,
						pemohon_id,
						pemohon_jbt,
						pemohon_div,
						manager_id,
						manager_approval,
						dirmud_id,
						dirmud_approval,
						direktur_id,
						direktur_approval,
						kar_id
					  )	
					  VALUES
						(
					    '$tanggal',
						'$tgl_kerja',
						'$nama',
						'$usia',
						'$jumlah',
						'$status_proses',
						'$status_pegawai',
						'$jenis_kelamin',
						'$pendidikan',
						'$pengalaman_kerja',
						'$uraian_jabatan',
						'$kemampuan_lain',
						'$alasan',
						'$lvl_id',
						'$jbt_id',
						'$div_id',
						'$unt_id',
						'$ktr_id',
						'$pemohon_kar_id',
						'$pemohon_jbt_id',
						'$pemohon_div_id',
						'$manager_kar_id',
						'$manager_approval',
						'$dirmud_kar_id',
						'$dirmud_approval',
						'$direktur_kar_id',
						'$direktur_approval',
						'$kar_id'
						)
					 ";	
			
			
			// echo '<br>'.$sql_add ; return ;
			
			$sSQL  = mysql_query($sql_add) ;	
			$sSQL_OK = "1";	 	
	}
 	
	if ($aksi == "save_adddata_review" and $aksi_proses == "edit_data" ){
		    $tanggal = date('Y-m-d');
            $status_proses 	 	= 'New' ;
			$manager_approval 	= '1' ;
			$dirmud_approval  	= '0' ;
			$direktur_approval 	= '0' ;
			if ($lvl_id==""){
			   $lvl_id = 0 ;
			}
			if ($jbt_id==""){
			   $jbt_id = 0 ;
			}
			if ($div_id==""){
			   $div_id = 0 ;
			}
			if ($unt_id==""){
			   $unt_id = 0 ;
			}
			if ($ktr_id==""){
			   $ktr_id = 0 ;
			}

			
			$sql_upd="UPDATE  _tenaga_kerja_master   
					    SET 
						tgl_kerja='$tgl_kerja',
						usia=$usia,
						jumlah=$jumlah,
						status_pegawai='$status_pegawai',
						jenis_kelamin='$jenis_kelamin',
						pendidikan='$pendidikan',
						pengalaman_kerja='$pengalaman_kerja',
						uraian_jabatan='$uraian_jabatan',
						kemampuan_lain='$kemampuan_lain',
						alasan='$alasan',
						lvl_id=$lvl_id,
						jbt_id=$jbt_id,
						div_id=$div_id,
						unt_id=$unt_id,
						ktr_id=$ktr_id,
						pemohon_id=$pemohon_kar_id,
						pemohon_jbt=$pemohon_jbt_id,
						pemohon_div=$pemohon_div_id,
						manager_id=$manager_kar_id,
						manager_approval=$manager_approval,
						dirmud_id=$dirmud_kar_id,
						dirmud_approval=$dirmud_approval,
						direktur_id=$direktur_kar_id,
						direktur_approval=$direktur_approval
					  WHERE tk_id ='$id' 	
					 ";	
			
			
			// echo '<br>'.$sql_upd ; return ;
			
			$sSQL  = mysql_query($sql_upd) ;	
			$sSQL_OK = "1";	 	  
	}

	if ($aksi == "edit_manager" and $aksi_proses == "edit_data" ){
		    $tanggal = date('Y-m-d');
            $status_proses 	 	= 'New' ;
			$manager_approval 	= '1' ;
			$dirmud_approval  	= '0' ;
			$direktur_approval 	= '0' ;
			if ($lvl_id==""){
			   $lvl_id = 0 ;
			}
			if ($jbt_id==""){
			   $jbt_id = 0 ;
			}
			if ($div_id==""){
			   $div_id = 0 ;
			}
			if ($unt_id==""){
			   $unt_id = 0 ;
			}
			if ($ktr_id==""){
			   $ktr_id = 0 ;
			}

			
			$sql_upd="UPDATE  _tenaga_kerja_master   
					    SET 
						tgl_kerja='$tgl_kerja',
						usia=$usia,
						jumlah=$jumlah,
						status_pegawai='$status_pegawai',
						jenis_kelamin='$jenis_kelamin',
						pendidikan='$pendidikan',
						pengalaman_kerja='$pengalaman_kerja',
						uraian_jabatan='$uraian_jabatan',
						kemampuan_lain='$kemampuan_lain',
						alasan='$alasan',
						lvl_id=$lvl_id,
						jbt_id=$jbt_id,
						div_id=$div_id,
						unt_id=$unt_id,
						ktr_id=$ktr_id,
						pemohon_id=$pemohon_kar_id,
						pemohon_jbt=$pemohon_jbt_id,
						pemohon_div=$pemohon_div_id,
						manager_id=$manager_kar_id,
						manager_approval=1,
						status_proses='Proses', 
						dirmud_id=$dirmud_kar_id,
						dirmud_approval=$dirmud_approval,
						direktur_id=$direktur_kar_id,
						direktur_approval=$direktur_approval
					  WHERE tk_id ='$id' 	
					 ";	
			
			
		
			$sSQL  = mysql_query($sql_upd) ;	
			$sSQL_OK = "1";	 	  
	}	
	
	
  	if ($aksi == "save_data_all"){
	
	}elseif($aksi=="approve_manager"){	
	        $sql_upd = " UPDATE _tenaga_kerja_master SET manager_approval=1,status_proses='Proses' 
						 WHERE  tk_id = '$id' " ;
			//echo $sql_upd ; return;
			$sSQL  = mysql_query($sql_upd) ;	
			$sSQL_OK = "1";	 	  
	 }elseif($aksi=="approve_dirmud"){	
	        $sql_upd = " UPDATE _tenaga_kerja_master SET dirmud_approval=1,status_proses='Proses' 
						 WHERE  tk_id = '$id' " ;
			//echo $sql_upd ; return;
			$sSQL  = mysql_query($sql_upd) ;	
			$sSQL_OK = "1";	 
	 }elseif($aksi=="approve_direktur"){	
	        $sql_upd = " UPDATE _tenaga_kerja_master SET direktur_approval=1,status_proses='Diterima' 
						 WHERE  tk_id = '$id' " ;
			//echo $sql_upd ; return;
			$sSQL  = mysql_query($sql_upd) ;	
			$sSQL_OK = "1";	 	 	  				 	  

	 ////////////////////////////////////////////////////	   
	}	
	
	

   
	if ($user_update=="" || $tanggal_update){
	    //$sSQL = "GAGAL TOTAL";
		
	}
	//echo $sSQL;
	////////////////////////////////////////////////
	if( mysql_query($sSQL) || $sSQL_OK=="1" ) {
		$retuen = array('status'=>"1","msg"=>"berhasil");
	} else {
		$retuen = array('status'=>"0","msg"=>"gatot");

	}

	return $retuen;

}








function printd($data = array(), $out =  true) {

	echo "<pre>" . print_r($data, 1) . "</pre>";

	if($out) exit;

}



//header('Location: http://kpt.co.id/');
//die();
?>

