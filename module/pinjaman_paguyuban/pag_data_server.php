
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

	if($_POST['mode'] == "list_data_paguyuban") {
	


 		
	//	$range_now = date('01/m/Y') . ' - ' . date('d/m/Y');
	//	$range_now_ori = date('Y-m-01') . ' - ' . date('Y-m-d');
	
    	$range_now = date('01/01/2020') . ' - ' . date('d/m/Y');
		$range_now_ori = date('2020-01-01') . ' - ' . date('Y-m-d');
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
	   	$filter_tgl = ' AND (DATE_FORMAT(a.pg_tanggal, "%Y-%m-%d") BETWEEN "' . $datestart . '" AND "'. $dateend . '" )';
	}

		$id =  $_REQUEST['id'] ;
		if ($id <> ""){
		   //  $filter_nik =  " AND a.kar_id = '$id' "; 
		}
	    $filter_nik = "";
		if ($cek_nik == 499 || $cek_nik == 21 || $cek_nik == 37 || $cek_nik == 63 ){
		  ////////admin atau sdm////////////// 
		}else{
   //        $filter_nik = " AND ( a.pg_kar_id = '$cek_nik' OR a.pg_ketua_id='$cek_nik' ) ";
           $filter_nik = " AND ( a.pg_kar_id = '$cek_nik' ) ";
		}
		
		$filter_jab    =  "  AND a.jbt_id > 13  AND a.div_id > 3 "; //////selain direksi dan komesaris//////// 
		$filter_status =  "  AND d.kar_dtl_typ_krj <> 'Resign'  ";
		$filter_div    =  "  AND ( c.div_nm <> 'IT'  AND c.div_nm <> 'SDM' 
		                     AND c.div_nm <> 'Desain Grafis' AND c.div_nm <> 'Umum' ) ";
		$query   = '';
		$output  = array();
				
		$query .= "			
					SELECT 
					a.*,
					b.kar_nik,b.kar_nm as peminjam,
					c.kar_nm as nm_ketua,
					d.kar_nm as nm_bendahara,
					e.kar_dtl_tgl_joi as tgl_masuk_kerja
					FROM _paguyuban_master a 
					LEFT JOIN kar_master b ON b.kar_id = a.pg_kar_id
					LEFT JOIN kar_master c ON c.kar_id = a.pg_ketua_id 
					LEFT JOIN kar_master d ON d.kar_id = a.pg_bendahara_id 
					LEFT JOIN kar_detail e ON e.kar_id = a.pg_kar_id 
					WHERE 1=1  ".$filter_nik." ".$filter_tgl." " ;

 		
		//filter_status $filter_jab $filter_div $filter_nik //
					
		if(isset($_POST["search"]["value"]))
		{
			$query .= ' AND ( ';
			$query .= ' a.pg_kar_id LIKE "%'.$_POST["search"]["value"].'%" ';
			$query .= ' OR a.pg_kar_nik LIKE "%'.$_POST["search"]["value"].'%" ';
			$query .= ' OR a.pg_nomor LIKE "%'.$_POST["search"]["value"].'%" ';
			$query .= ' OR a.pg_kar_nm LIKE "%'.$_POST["search"]["value"].'%" ';
			$query .= ' OR b.kar_nm LIKE "%'.$_POST["search"]["value"].'%" ';
			$query .= ' OR c.kar_nm LIKE "%'.$_POST["search"]["value"].'%" ';
			$query .= ' OR d.kar_nm LIKE "%'.$_POST["search"]["value"].'%" ';
			$query .= ' ) ';
		}
		if(isset($_POST["order"]))
		{
			$query .= 'ORDER BY '.$_POST['order']['0']['column'].' '.$_POST['order']['0']['dir'].' ';
		}
		else
		{
			 $query .= ' ORDER BY a.pg_id DESC ';
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
			$season = $r['pg_kar_id'];
			if ($season != $previous_season) {
				//echo '<tr>';echo "<td> Group : $season </td>";echo '</tr>';
				$previous_season = $season;
				$no = 1;
				
		    }		
			$xstatus = "";
			$class = "label-default";	 
			
			$cek_id      = $r['pg_id'];
			$kar_nik     = $r['pg_kar_id'];  
			$kar_nm      = $r['pg_kar_nm'];  
			$pemohon_id  = $r['pg_kar_id'];
			///////////////////////////////////////////////////////////////////////////		
			$id        	= $r[do_id];
			
			$approve_1  = '<a href="#"  
							 onclick="doUpdateData(\''.$cek_id.'\',\''.'approve-ketua'.'\')" 
							 title="Approval Ketua" >
						     <span class="btn btn-info mb1 bg-info btn-xs"  > 
								<i class="fa fa-pencil-square-o"></i> Acc 
						    </span>
						 </a> <br> ';			


			$approve_2  = '<a href="#"  
							 onclick="doUpdateData(\''.$cek_id.'\',\''.'approve-bendahara'.'\')" 
							 title="Approval Ketua" >
						     <span class="btn btn-info mb1 bg-info btn-xs"  > 
								<i class="fa fa-pencil-square-o"></i> Acc 
						    </span>
						 </a> <br> ';	
						 
			if ($cek_nik == 499 || $cek_nik == 21 || $cek_nik == 63  ){
			  ////////admin atau sdm////////////// 
			}else{
			   $approve_1 = "";
			   $approve_2 = "";
			}
						 
			$cetak_data  = '<a href="#"  
							 onclick="doUpdateData(\''.$cek_id.'\',\''.'hanya-cetak'.'\')" title="Print Nota">
						     <span class="btn btn-primary mb1 bg-white btn-xs"  > 
								<i class="fa fa-print"></i> 
						    </span>
						 </a> ';			

			$fpdf_1      = '';
			$v_url_1     = "module/pinjaman_paguyuban/topdf_nota.php";
			$pageURL	= $v_url_1."?id=".$cek_id."&zfilepdf=".$fpdf_1;
			$cetak_nota ='
					 <a  href="#" 
						 onclick="OpenPopupCenterNew(\''.$pageURL.'\')" title="Print Nota "> 
						  <span class="btn btn-primary mb1 bg-black btn-xs"  > 
							<i class="fa fa-print"></i> 
						  </span>
							  
					 </a>  
					 '; 
				 	

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
						
			$edit_pelunasan  = '<button type="button" class=" btn  btn-primary  btn-xs " 
							 onclick="doPelunasan(\''.$cek_id.'\')"
							 title="Edit Data"  >
							 <span class="fa fa-pencil"></span>
						  </button>
						';	
						
			if ($cek_nik == 499 || $cek_nik == 21  ){
			  ////////admin atau sdm////////////// 
			}else{
			   $edit_pelunasan = "";
			}
         
		    $edit_pemohon  = '<button type="button" class=" btn  btn-primary  btn-xs " 
							 onclick="doUpdateData(\''.$cek_id.'\')"
							 title="Edit Data"  >
							 <span class="fa fa-pencil"></span>
					      </button>
						  <br>
				   		';				

			$block="";
			$check1="";		
			if($r['pg_ketua_acc'] == 1 ){
				$block="danger";
				$check1="<i class='fa fa-check text-green'></i>";
				$approve_1 = '';
			} 	

			$check2="";		
			if($r['pg_bendahara_acc'] == 1 ){
				$block="danger";
				$check2="<i class='fa fa-check text-green'></i>";
				$approve_2 = '';
			} 	


			$tbl_1 ='<div style="line-height:30px">'.$check.' <a href="#" 
					 onclick="doNIK(\''.$kar_id.'\',\''.$kar_nik.'\',\''.$kar_nm.'\')">'
					 .$r['nik'].'</a>'.'</div>';
			
			$proses = $r['pg_status'];
			$lbl    = "label-default";
		
			if ($proses == "New"){
			  	$lbl    = "label-primary" ;
			}elseif($proses == "Proses"){ 
				$lbl    = "label-info" ;
			}elseif($proses == "Disetujui"){ 
				$lbl    = "label-success" ;	   
			}elseif($proses == "Dipending"){ 
				$lbl    = "label-danger" ;	
			}elseif($proses == "Batal"){ 
				$lbl    = "label-danger" ;	   										   	
		    }
			
			if ($proses <> "New" ){
				  $edit_data = '';
			      $del_data  = '';
			}
		   if ($cek_nik == 499 || $cek_nik == 21 || $cek_nik == 37 || $cek_nik == 63 ){
		   }else{
		     $edit_data = "";
			 $del_data = "";
		   }
			if ($r['pg_ketua_id'] == $cek_nik  ){
			  $approve_1 = "";
			}
				
			$proses = '<span class="label '.$lbl.' " style="font-size:14px;  ">'.$proses.'</span>';	
			
			$tgl_masuk_kerja = date('d-m-Y',strtotime($r['tgl_masuk_kerja']));
			$tgl_input = date('d-m-Y',strtotime($r['pg_tanggal']));	
			$tgl_mulai_bayar = date('d-m-Y',strtotime($r['pg_mulai_bayar']));	
			if ($r['pg_mulai_bayar'] == ""){
			    $tgl_mulai_bayar = "";
			}

			$tgl_update_bayar = date('d-m-Y',strtotime($r['pg_update_bayar']));	
			if ($r['pg_update_bayar'] == ""){
			    $tgl_update_bayar = "";
			}
			
			$tgl_lunas = date('d-m-Y',strtotime($r['pg_tanggal_lunas']));
			if ($r['pg_tanggal_lunas'] == ""){
			    $tgl_lunas = "";
			}

			$tgl_transfer = date('d-m-Y',strtotime($r['pg_tanggal_transfer']));
			if ($r['pg_tanggal_transfer'] == ""){
			    $tgl_transfer = "";
			}			
			$xnu		  = $r['pg_id'];
			$kar_nik	  = $r['kar_nik'];	
			$kar_nm		  = $r['pg_kar_nm'];
			$nm_ketua	  = $r['nm_ketua'];
			$nm_bendahara	  = $r['nm_bendahara'];
			$jml_pinjaman	  = number_format($r['pg_pinjaman']);
			$jml_lama 	  = number_format($r['pg_lama']);
			$lama		  = $r['pg_lama'];
			$ke		  = $r['pg_ke'];
			/////////////////////////////
			$xpinjaman 	= $r['pg_pinjaman'] ;
			//$xbayar 	= ($xpinjaman/$lama) * $ke;
			$xbayar 	= $r['pg_bayar'];
			$xlunas 	= $r['pg_pelunasan'];
			/////////////////////////////
			//$jml_angsuran = number_format($xpinjaman/$lama);
			$jml_angsuran   = number_format($r['pg_angsuran']);

			//$jml_bayar 	  = number_format($r['pg_bayar']);	
			$jml_bayar 	  = number_format($xbayar);	
			$jml_pelunasan    = number_format($r['pg_pelunasan']);	
			$jml_sisa 	  = number_format($r['pg_pinjaman']-$xbayar-$xlunas);	
			$norek		  = $r['pg_norek'];				
			//////////////////////////////////////////////////////////////////////						  
			$sub_array = array();
			$sub_array[] = $r['pg_id'];
			//$sub_array[] = '<center>'.$cetak_data.' '.$cetak_nota .' '.$edit_data.' '.$del_data.'</center>' ;
			$sub_array[] = '<div style="">'.'<center>'.$cetak_nota .' '.$edit_data.' '.$del_data.'</center>'.'</div>' ;
			$sub_array[] = '<center>'.$r['pg_id'].'</center>';
			$sub_array[] = '<center >'.'<b>'.$tgl_input.'</b>'.'</center>';
			$sub_array[] =  $kar_nik.'<br>'.$kar_nm ;
			$sub_array[] = '<center>'.$jml_pinjaman.'</center>';;
			$sub_array[] = '<center>'.$check2.' '.$approve_2.' '.$nm_bendahara.'</center>';;
			$sub_array[] = '<center>'.$check1.' '.$approve_1.' '.$nm_ketua.'</center>';;
			$sub_array[] = '<center>'.$proses.'</center>';
			$sub_array[] = '<center>'.$jml_lama.'</center>';
			$sub_array[] = '<center>'.$jml_angsuran.'</center>';
			$sub_array[] = '<center>'.$ke.'</center>';
			$sub_array[] = '<center>'.$jml_bayar.'</center>';
			$sub_array[] = '<center>'.$jml_pelunasan.'</center>';
			$sub_array[] = '<center>'.$edit_pelunasan.'<br>'.$tgl_lunas.'</center>' ;
			$sub_array[] = '<center>'.$jml_sisa.'</center>';
			$sub_array[] = '<center><b>'.$tgl_transfer.'</b></center>';
			$sub_array[] = '<center>'.$tgl_update_bayar.'</center>';
			$sub_array[] = $norek;
			$sub_array[] = '<center>'.$cetak_data.'</center>';

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
	foreach($_REQUEST as $name=>$value)
	{
		$$name=$value;
		//echo "$name : $value;<br />\n";
	}


	$kar_id   = $_SESSION['kar'] ; 
	
	$tgl = date('Y-m-d');
	$xpemesan = $pemesan ;
	
	$sSQL = "";
	$sSQL_OK = "0";
	
	//echo $kar_id; return;
	
    if ( $btnDITOLAK  == "DITOLAK" ){
	        $sql_upd = " UPDATE _paguyuban_master SET pg_ketua_acc = '1', pg_ketua_id= '$kar_id', pg_status='Dipending' 
						 WHERE  pg_id = '$id' " ;
			//echo $sql_upd ; return;
			$sSQL  = mysql_query($sql_upd) ;	
			if( $sSQL) {
				$retuen = array('status'=>"1","msg"=>"berhasil");
			} else {
				$retuen = array('status'=>"0","msg"=>"gatot");
	
			}
			
			return $retuen; 	 		
    }
	
	//return;	
	if ($aksi=="save_add_data" and $aksi_proses=='add_data'){
	  //  $sql_auto_reset = " ALTER TABLE _tenaga_kerja_master AUTO_INCREMENT = 1 ";
	  //  $sSQL = mysql_query($sql_auto_reset) ;	
	  
			$cek_nourut    =" SELECT pg_id FROM _paguyuban_master  ORDER BY pg_id DESC LIMIT 1  ";
			$tampil_akt_no = mysql_query($cek_nourut);
			$row_no		   = mysql_fetch_assoc($tampil_akt_no);
			$pg_id         = ($row_no['pg_id'])+1;
			$no_urut       = (1000000000000+$row_no['pg_id'])+1;
		
			$no_auto	   = 'PG-'.substr($no_urut,-5);
						  
	  
		    $tanggal = date('Y-m-d');
            $status_proses 	 	= 'New' ;
			$manager_approval 	= '0' ;
			$dirmud_approval  	= '0' ;
			$direktur_approval 	= '0' ;
			$pg_pinjaman        = str_replace(",","",$pg_pinjaman);
			$pg_angsuran        = ($pg_pinjaman / $pg_lama) ;

			
			$sql_add="INSERT INTO _paguyuban_master  
					  ( 
					    pg_nomor,
						pg_tanggal,
					    pg_kar_id,
						pg_kar_nik,
						pg_kar_nm,
						pg_norek,
						pg_pinjaman,
						pg_angsuran,
						pg_lama,
						pg_ket,
						pg_user_id
					  )	
					  VALUES
						(
					    '$no_auto',
						'$tanggal',
						'$pg_kar_id',
						'$pg_kar_nik',
						'$pg_kar_nm',
						'$pg_norek',
						'$pg_pinjaman',
						'$pg_angsuran',
						'$pg_lama',
						'$pg_ket',
						'$pg_kar_id'
						)
					 ";	
			
			
			//echo '<br>'.$sql_add ; return ;
			
			$sSQL  = mysql_query($sql_add) ;
			$sSQL_OK = "1";
	}
 	
	if ($aksi == "save_add_data" and $aksi_proses == "edit_data" ){
		    $tanggal		    = date('Y-m-d');
            $status_proses 	 	= 'New' ;
			$pg_pinjaman        = str_replace(",","",$pg_pinjaman);
			$sql_upd="UPDATE  _paguyuban_master   
					    SET 
						pg_kar_nik='$pg_kar_nik',
						pg_kar_nm='$pg_kar_nm',
						pg_pinjaman='$pg_pinjaman',
						pg_lama='$pg_lama',
						pg_norek='$pg_norek',
						pg_ket='$pg_ket'
					    WHERE pg_id ='$id' 	
					 ";	
			
			
			// echo '<br>'.$sql_upd ; return ;
			
			$sSQL  = mysql_query($sql_upd) ;	
			$sSQL_OK = "1";	 	  
	}
	
	
  	if ($aksi == "save_data_all"){
	
	}elseif($aksi=="save_editdata_pelunasan"){	
			$pinjaman        = str_replace(",","",$pg_pinjaman);
			$pg_angsuran     = str_replace(",","",$pg_angsuran);
			$pg_ke		     = str_replace(",","",$pg_ke);

			$xbayar			 = ($pg_angsuran * $pg_ke);
			$pg_bayar	     = str_replace(",","",$xbayar);
	     	$pg_pelunasan    = str_replace(",","",$pg_pelunasan);
			
			$sisa	         = ($pg_pinjaman - $xbayar - $pg_pelunasan);
			
			$tanggal_lunas   = " pg_tanggal_lunas = '$pg_tanggal_lunas' " ;
			if ($pg_tanggal_lunas == "" || substr($pg_tanggal_lunas,0,4)=="0000"){
			   $tanggal_lunas   = " pg_tanggal_lunas = NULL " ;
			}
			$tanggal_transfer   = " pg_tanggal_transfer = '$pg_tanggal_transfer' " ;
			if ($pg_tanggal_transfer == "" || substr($pg_tanggal_transfer,0,4)=="0000"){
			   $tanggal_transfer   = " pg_tanggal_transfer = NULL " ;
			}			
	        $sql_upd = " UPDATE _paguyuban_master 
								 SET 
								 $tanggal_transfer ,
								 $tanggal_lunas ,
								 pg_pelunasan='$pg_pelunasan',
								 pg_bayar	='$xbayar',
								 pg_sisa	='$sisa',
								 pg_ke		='$pg_ke' 
						 WHERE  pg_id = '$id' " ;
						 
			//echo $sql_upd ; return;
			
			$sSQL  = mysql_query($sql_upd) ;
			$sSQL_OK = "1";	 	  


	}elseif($aksi=="approve-ketua"){	
			$pg_pinjaman_acc  = str_replace(",","",$pg_pinjaman_acc);
			$pg_angsuran	  = $pg_pinjaman_acc/$pg_lama;
			
	        $sql_upd = " UPDATE _paguyuban_master SET pg_ketua_acc = '1',
								 pg_pinjaman = '$pg_pinjaman_acc',
			                     pg_angsuran = '$pg_angsuran',
								 pg_ketua_id='$kar_id',pg_mulai_bayar='$pg_mulai_bayar', 
								 pg_status='Disetujui' 
						 WHERE  pg_id = '$id' " ;
						 
			//echo $sql_upd ; return;
			
			$sSQL  = mysql_query($sql_upd) ;	
			$sSQL_OK = "1";	 	  

	}elseif($aksi=="approve-bendahara"){	
			$pg_pinjaman_acc  = str_replace(",","",$pg_pinjaman_acc);
			$pg_angsuran	  = $pg_pinjaman_acc/$pg_lama;
			
	        $sql_upd = " UPDATE _paguyuban_master 
								 SET 
								 pg_bendahara_acc = '1',
								 pg_pinjaman_acc = '$pg_pinjaman_acc',
								 pg_pinjaman = '$pg_pinjaman_acc',
			                     pg_angsuran = '$pg_angsuran',
								 pg_bendahara_id='$kar_id',
								 pg_mulai_bayar='$pg_mulai_bayar', 
								 pg_status='Disetujui' 
						 WHERE  pg_id = '$id' " ;
						 
			//echo $sql_upd ; return;
			
			$sSQL  = mysql_query($sql_upd) ;	
			$sSQL_OK = "1";	 	  

	 ////////////////////////////////////////////////////	   
	}	
	
	

   
	if ($user_update=="" || $tanggal_update){
	    //$sSQL = "GAGAL TOTAL";
		
	}

	//echo $sSQL;return;
	////////////////////////////////////////////////
	if( $sSQL) {
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

