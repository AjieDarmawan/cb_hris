<?php

date_default_timezone_set("Asia/Bangkok");

$kar_tampil=$kar->kar_tampil_filter_2(); 

foreach($_REQUEST as $name=>$value)
{
	$$name=$value;
// 	echo "Name: $name : $value;<br />\n";
}


$page=$_REQUEST['p'];
$act =$_REQUEST['act'];
$id  =$_REQUEST['id'];    
$ntf_id    =$_REQUEST['ntf_id'];    
$ntf_read  =$_REQUEST['ntf_tujuan'];   

$xkar_nik  = $_REQUEST['xkar_nik'];
$xkar_nm   = $_REQUEST['xkar_nm'];

///////////////////////////////////////////
$sql_atasan= "
			SELECT a.kar_id,a.kar_nik,a.kar_nm,c.acc_sts,b.jbt_nm,d.div_nm from kar_master a
			LEFT JOIN jbt_master b ON b.jbt_id=a.jbt_id 
			LEFT JOIN acc_master c ON c.kar_id=a.kar_id 
			LEFT JOIN div_master d ON d.div_id=a.div_id
			WHERE a.kar_id <> '$id' AND a.kar_id IN('499','447','255') AND c.acc_sts='A' 
			OR (b.jbt_nm NOT LIKE '%staff%' AND b.jbt_nm NOT LIKE '%Freelance%' 
			AND b.jbt_nm NOT LIKE '%Komisaris%'   )
			ORDER BY a.kar_nm 
			";

////////////////////////////////////////////

//echo 'page : '.$page.' act: '.$act.' id : '.$id.' login : '.$kar_id; 
//return;
/////////////////////////////////////////////
if(isset($page)&&($act=="open")){
/*
	$sql_upd = " UPDATE cuti_ntf SET ntf_data_read='$ntf_read' WHERE ntf_data_id='$ntf_id '";
	$sql_cek = " SELECT * FROM cuti_ntf WHERE ntf_data_id='$ntf_id' AND ntf_data_read = '' ";
	$cek_rec = mysql_num_rows(mysql_query($sql_cek));
	if ($cek_rec == 1 ){
	  $query_upd = mysql_query($sql_upd);
	}
*/	
}



///////////////cek data - jumlah data ///////////////
	$sql_0 = " SELECT b.kar_nik,b.kar_nm,a.* FROM cuti_master a
			   LEFT JOIN kar_master b ON b.kar_id=a.kar_id
			   WHERE a.kar_id = '$id' ";
	$q_cuti_0= mysql_query($sql_0);
	$r0 = mysql_fetch_array($q_cuti_0);
	$adatacuti = explode("#",$r0['datacuti']);
	$jml_data = 0;
	for ($i=0 ;$i < 12;$i++){ 
	  if ($adatacuti[$i] != ""){
		 $jml_data++;
	  }
	}
	
	$jml_input = 0 ;
	$cek_nm_atasan = "Y";
	for($i=0; $i < count($_REQUEST["tgl_cuti"]); $i++){
	   if ($_REQUEST["tgl_cuti"][$i] <> "" ){
	   	  $jml_input++;
		  if ($jml_input > $jml_data and $_REQUEST["data_atasan"][$i]==""){
		     $cek_nm_atasan = "N";
			 echo "<script>
				    alert('Nama Atasan Masih Kosong !...Ulangi !... ( Atau Pilih Cancel ) ');
				  </script>";		     
			 		  
		  }
	   }
	   
	}	
	
    if ($jml_data == $jml_input){
		     $cek_nm_atasan = "N";
/*			 
			 echo "<script>
				    alert('Tidak Ada data baru yg diajukan !...Ulangi !... ( Atau Pilih Cancel )');
				  </script>";	
*/				  	     
	} 	
//	echo 'jml_data:'.$jml_data; 
	
/////////////////////////////////////

	 	   
////////////////////////////////
if(isset($page)&&($act=="UpdateCUTI") and $cek_nm_atasan =="Y" ){
	 echo "<script>
			alert('Data Telah Terkirim Tunggu Persetujan Atasan (...Wait...) ');
		  </script>";		     
	 
     $id        = $_REQUEST['id'];
     $jml_cuti  = $_REQUEST['jml_cuti'];
	 $rec       = count($_REQUEST["tgl_cuti"]);
	 $adtcuti   = "";
	 $adtket    = "";
	 $adtvalid  = "";
	 $adt_atasan = "";
	 $adtnota = "";
	 $jmlcuti   = 0 ;
	 if ($rec > 0){
	    $jmlcuti   = 0 ;
	 }
	 $ntf_data_url = "";	
	 $ntf_data_nota= "";	
	 for($i=0;$i < $rec; $i++){
	    $cek_tgl    = $_REQUEST["tgl_cuti"][$i];
		$cek_nota   = $_REQUEST["datanota"][$i];
	    $cek_atasan = $_REQUEST["data_atasan"][$i];
		$cek_valid  = $_REQUEST["adatavalid"][$i];

		if ($cek_tgl != "" AND $cek_atasan != "" and $cek_nota==""   ){
		
		   $adtnota .= date('Ymd').'-'.$id;
		   $xnota    = date('Ymd').'-'.$id;;
		   $ntf_data_url  = '?p=form-cuti-acc&act=open&id='.$id.'&nota='.$xnota;
		   $ntf_data_nota = '?p=form-cuti-print&id='.$id.'&nota='.$xnota;
		   
		}else{
		   $adtnota .= $_REQUEST["adatanota"][$i];
		}

	    $adtnota .= $_REQUEST["datanota"][$i];
		$adtnota .="#";
		
	    $adtcuti .=$_REQUEST["tgl_cuti"][$i];
	    $adtcuti .="#";
		if ($_REQUEST["tgl_cuti"][$i] <> ""){
		    $adtket .=$_REQUEST["dataket"][$i];
	    $adt_atasan .=$_REQUEST["data_atasan"][$i];
		}	
	    $adtket   .="#";
	    $adt_atasan .="#";
		if ($_REQUEST["tgl_cuti"][$i] <> ""){		
		    $adtvalid .=$_REQUEST["adatavalid"][$i];
		}	
	    $adtvalid .="#";
		if ($_REQUEST["tgl_cuti"][$i] !=""){
			$jmlcuti++;
		}	
		//echo  $adtnota ;return;
       //////////////cek-notif-nota///////////////////////
	if ($cek_tgl != "" AND $cek_atasan != "" and $cek_nota==""){	   
		$ntf_data_act = "Cuti";
		$ntf_data_isi = $xkar_nm ;				
		$ntf_data_ip  = "";
		$ntf_data_tgl = date('Y-m-d');
		$ntf_data_jam = date('H:i:s');
		$ntf_data_tujuan = $_REQUEST["data_atasan"][$i];
		$ntf_data_sumber = $id;
		$sql_nota_ntf_add="INSERT INTO cuti_ntf 	
						   VALUES(NULL,'$ntf_data_act','$ntf_data_isi','$ntf_data_url','$ntf_data_ip',
			   			   '$ntf_data_tgl','$ntf_data_jam','$ntf_data_tujuan','$ntf_data_sumber','','$ntf_data_nota')
			  		      ";
						  
		$sql_nota_ntf="SELECT * FROM cuti_ntf WHERE ntf_data_url='$ntf_data_url' AND ntf_data_tujuan = '$ntf_data_tujuan' ";	
        if ($ntf_data_url != ""){
			$cek_rec_ntf_nota = mysql_num_rows(mysql_query($sql_nota_ntf));
			if ($cek_rec_ntf_nota == 0 ){
			   $ntf_nota_add = mysql_num_rows(mysql_query($sql_nota_ntf_add));
			}
		}	
	}	

		///////////cek-notif-read///////////////////
/*		
		if ($_REQUEST["adatavalid"][$i]=="Y"){
			$sql_upd_ntf = " UPDATE cuti_ntf SET ntf_data_read='$ntf_read' WHERE ntf_data_id='$ntf_id '";
			$sql_cek_ntf = " SELECT * FROM cuti_ntf WHERE ntf_data_id='$ntf_id' AND ntf_data_read = '' ";
			$cek_rec_ntf = mysql_num_rows(mysql_query($sql_cek_ntf));
			if ($cek_rec_ntf == 1 ){
			  $query_upd = mysql_query($sql_upd_ntf);
			}
		}	
*/		
		///////////////////////////////////////////////
		
	 }

      //	 echo 'Upddate : '.$id.' -> '.$adtcuti; exit();
     // 	 echo 'dataatasan : '.$adt_atasan; return;

        $q_nik = " SELECT kar_id FROM cuti_master 
		            WHERE kar_id = '$id' ";
		$q_nik = mysql_query($q_nik);
		$r_nik = mysql_fetch_array($q_nik);
		$cek_nik = $r_nik['kar_id'];
		
	
		
		if (empty($cek_nik)){
           $q_add=" INSERT INTO cuti_master (kar_id) VALUES ('$id') ";		
           $result_add= mysql_query($q_add);
		}   
        $q_upd_acc    = "UPDATE cuti_master
	                 SET
					 jml_cuti = '$jml_cuti',
		  		     datacuti = '$adtcuti',
		  		     dataket  = '$adtket',
		  		     datanota = '$adtnota',
		  		     data_atasan = '$adt_atasan',
				     sisa_cuti= jml_cuti - '$jmlcuti'
				     WHERE kar_id='$id'   
			    ";
         
		// echo  $q_upd_acc ; return;
		/////////////////////////////////////////////// 
        $result_upd_acc = mysql_query($q_upd_acc);
		///////////////////////////////////////////
		
/*	    echo "<script>document.location='?p=$page&id='".$id."</script>";	*/
/*	    echo "<script>document.location='?p=cuti&id='".$id."</script>";	*/
/*
	    echo "<script>
			  document.location='?p=cuti&id=$id';
			 </script>";	
*/		
	 
	    echo "<script>
			  document.location='?p=form-cuti&act=open&id=$id';
			 </script>";	



}


 
  
if($_REQUEST['id']) {
  
        // mengambil data berdasarkan id
        // dan menampilkan data ke dalam form modal bootstrap
        $sql = "SELECT b.kar_nik,b.kar_nm,a.* FROM cuti_master a
		        LEFT JOIN kar_master b ON b.kar_id=a.kar_id
		        WHERE a.kar_id = '$id' ";
		$q_cuti= mysql_query($sql);
		$r = mysql_fetch_array($q_cuti);
        $detal_act = "./media.php?p=cuti";
		$adatacuti = explode("#",$r['datacuti']);
		$adataket  = explode("#",$r['dataket']);
		$adatavalid= explode("#",$r['datavalid']);
		$adata_atasan  = explode("#",$r['data_atasan']);
		$adatanota  = explode("#",$r['datanota']);
/*		
		for ($i=0 ;$i < 12;$i++){ 	
		   echo '<br>'.$adata_atasan[$i] ;
		}
*/		
 
  ?>

<style>

	input[type="checkbox"][readonly] {
	  pointer-events: none;
	}
	
 
</style>


    <section class="content-header">

      <h1> <?php echo 'Form Cuti Karyawan : Pengajuan ' //$title;?> <small></small> </h1>

      <ol class="breadcrumb">

        <li><a href="media.php"><i class="fa fa-dashboard"></i> Dashboard</a></li>

        <li class="active"><?php echo $title;?></li>

      </ol>

    </section>

   <!-- Main content -->

    <section class="content"> 
      <div class="row">
        <div class="col-md-10">
          <div class="box box-info">
            <div class="box-header">
              <h3 class="box-title"><b>Nama : <?php echo $r['kar_nm'] ; ?></b></h3><br />
              <h3 class="box-title"><b>NIK&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: <?php echo $r['kar_nik']; ?></b></h3><br />
	      <!-- tools box -->
                  <div class="pull-right box-tools">
                    <a href="#?p=data_penilaian"  class="btn btn-sm btn-default"><i class="fa fa-refresh"></i></a>
                    <button class="btn btn-info btn-sm" data-widget='collapse' data-toggle="tooltip" title="Collapse">
					<i class="fa fa-minus"></i></button>
                    <button class="btn btn-info btn-sm" data-widget='remove' data-toggle="tooltip" title="Remove">
					<i class="fa fa-times"></i></button>
                  </div><!-- /. tools -->
	    </div>

            <!-- /.box-header -->

            <div class="box-body" style="margin-top:-45px">
<!-- MEMBUAT FORM -->
<form class="form-horizontal" action="<?php echo $detail_act ?>" method="post"> 
        <input type="hidden" name="xkar_nm" value="<?php echo $r['kar_nm']; ?>">
        <input type="hidden" name="xkar_nik" value="<?php echo $r['kar_nik']; ?>">
        <input type="hidden" name="id" value="<?php echo $id; ?>">
        <input type="hidden" name="ntf_id" value="<?php echo $ntf_id; ?>">
        <input type="hidden" name="ntf_tujuan" value="<?php echo $ntf_tujuan; ?>">

<div class='row'>    
  <div class="modal-header ">
  </div>
  <div class="form-group">
      <label class="control-label col-sm-1" for="">JmlCuti : </label>
      <div class="col-sm-1" style="width:130px">
          <input type="text" class="form-control" name="jml_cuti" 
				placeholder="Jml Cuti"
		  value="<?php echo $r['jml_cuti']; ?>"  readonly="">
      </div>
      <label class="control-label col-sm-3" for="" style="text-align:left" >Keterangan </label>
      <label class="control-label col-sm-2" for="" style="text-align:left">Menyetujui Atasan </label>
      <label class="control-label col-sm-1" for="" style="text-align:left">Setuju </label>
      <label class="control-label col-sm-1" for="" style="text-align:left">Nomor </label>
      <label class="control-label col-sm-1" for="" style="text-align:right">Print</label>
  </div>

<?php 
  for ($i=0 ;$i < 12;$i++){ 
    $xtgl =""; 
    if ($i==0){
	    $xtgl ="Tgl"; 
	   
	}
   
	$readonly = "";
	if ( $adataket[$i] <> "" ){
	   $readonly = "readonly";
	}
    $nota = $adatanota[$i];
	$checked  = "";
	$disabled = "";
	$cek_readonly = "";
	if ( $adatavalid[$i] == "1" ){
		$checked  = "checked";
		$cek_readonly = "readonly";
		$readonly = "readonly";
	}	
	$text_ntf = '-';;	
	if ( $adatavalid[$i] == "Y" ){
		$text_ntf = '<i class="fa fa-check"><b> OK </b> </i>';;	
	}	
	if ($adatanota[$i] <> "" AND $adatavalid[$i] <> "Y"  ){
		$text_ntf = '<font color=red> ... Wait ... </font>';;	
	}

    if ($i==$jml_data){
	    echo '<div class="form-group"> 
			 <label class="control-label col-sm-1" ></label>
			 <label class="control-label col-sm-6" style="color:red;text-align:left ">
			  	Pengajuan Cuti : Input ( TglCuti, Keterangan, Nama Atasan  ) :
			  </label>
			</div>';
	}	

?>
  <div class="form-group">
      <label class="control-label col-sm-1" for=""><?php echo $xtgl.' Ke - '.($i+1)?></label>
      <div class="col-sm-1" style="width:130px">
          <input type="text" class="form-control" id="tanggal<?php echo $i; ?>" name="tgl_cuti[]" 
				placeholder="-"
		  value="<?php echo $adatacuti[$i]; ?>"  <?php echo $readonly ;?>>
      </div>
      <div class="col-sm-3">
          <input type="text" class="form-control" name="dataket[]"
				placeholder="-"
		  value="<?php echo $adataket[$i]; ?>" <?php echo $readonly ;?> >
      </div>
	 <?php 
	  $display = "block";
	  if ($adatacuti[$i]!=""){
		   $display = "none";
		   $nama_atasan = "";
			if($kar_tampil){
				   foreach($kar_tampil as $data){  
					 if ($data['kar_id']== $adata_atasan[$i] ){
					   $nama_atasan = $data['kar_nm'];
					   break;
					 }
		          }
		   }
		   //echo '<div class="col-sm-3" style=" background:#CCCCCC">'.$xdata_kar.'</div>';
	  ?>	
	     
      <div class="col-sm-2">
          <input type="text" class="form-control" name="xdata_acc[]"
				placeholder="-"
		  value="<?php echo $nama_atasan; ?>" <?php echo $readonly ;?> >
      </div>		   
	 <?php } ?>
	  
     <div class="col-sm-2" style=" display:<?php echo $display;?>; " align="center" >
	 
<!--			<div class="bfh-selectbox" name="data_atasan[]" data-value="" data-filter="true"> !-->
		   
		  <select   name="data_atasan[]" class="form-control select2"  aria-describedby="sizing-addon2" style="width:100%;" 
		     >	
		  	  <option value="" selected  <?php //echo $xdisabled;?> > ................................. </option>" 
			<?php

			   $kar_atasan = mysql_query($sql_atasan);
			   while ($row = mysql_fetch_array($kar_atasan)){
				     $selected = "";
					 $xdisabled = "";
					 if ($adatavalid[$i] <> ""){
						 $xdisabled = "disabled";
					   
					 }
					 if ($row['kar_id']== $adata_atasan[$i] ){
					    $selected = "selected";
					 }
			 ?>
			  <option value="<?php echo $row['kar_id'];?>" <?php echo $selected; ?> <?php //echo $xdisabled;?> >
				<?php echo $row['kar_nik'];?> - <?php echo $row['kar_nm'];?>
			  </option>
			  <?php 
			  	}
			  //	}
			  ?>  
		  
		  </select>
	 
		   
	 </div>	  
      <div class="col-sm-1" style="text-align:left">
		<?php echo $text_ntf; ?>
	 </div>	
      <div class="col-sm-1">
          <input type="text" class="form-control" name="datanota[]"
				placeholder="-"
		  value="<?php echo $adatanota[$i] //$nota; ?>" style="width:110px"  readonly="">
      </div>
	  <?php
	   $xnik  = $id ;
	   $xnota = $adatanota[$i];
	   $xtgl  = $adatacuti[$i];
	   $atasan  = $adatacuti[$i];
	   $tujuan  = $adata_atasan[$i];
	   $xnik_atasan  = $adata_atasan[$i];
	   
	   $url_nota = "module/data-cuti/form-cuti-print.php";  
	   $url_nota .= "?p=form-print&act=open&id=".$xnik."&nota=".$xnota.'&tgl='.$xtgl;
	   $url_nota .= '&atasan='.$tujuan.'&nik_atasan='.$xnik_atasan;	
	   if ($adatavalid[$i]=="Y"){
	  ?>
      <div class="col-md-1" style="margin-left:30px" >
		   <a href="#"  onclick="OpenPopupCenter('<?php echo $url_nota ; ?>', 'TEST!?', 600, 650)" 
		   title=" Print Form Cuti " ><i class="fa fa-print"></i> <b> Cetak </b></a>
	  </div>			   
	  <?php } ?>
  </div>

<?php } ?>

     <label class="control-label col-sm-2" for="">Sisa Cuti : <?php echo $r['sisa_cuti']; ?></label>


  <div class="modal-footer">
<!--  
	   <button class="btn btn-primary" name="act" value="UpdateCuti" type="submit" >
		 <i class="fa fa-eyedropper"></i> <?php echo 'Approval' ?>
	   </button>
!-->
	 
	   <button type="submit" class="btn btn-primary" name="act" value="UpdateCUTI"  
	   		 onClick="if(confirm('Kirim ke Atasan ?...')==false){return false}" >
			 <i class="fa fa-location-arrow"></i> <?php echo 'Simpan dan Kirim' ?>
	   </button>	 
	   <a href="?p=cuti&id=<?php echo $id ;?>" class='btn btn-primary'><i class="fa fa-arrow-left"></i>&nbsp;Cancel</a> 	   
  </div>

</div>			  
</form>
 
<?php } ?>					 
					 
					 
					 
				 
					 
					 
					 
            </div>


          </div>
        </div>
	


</div>

<?php //	include('../../component/tag_bottom.php');?>


       <script src="module/data-cuti/jquery.min.js"></script>
       <script src="module/data-cuti/jquery.maskedinput.js"></script>
<!--       <script src="plugins/select2-4.0.3/select2.min.css"></script> !-->
       <script src="plugins/select2-4.0.3/select2.min.js"></script>
        <script>
        jQuery(function($){
		    for (var i = 0; i <=200; ++i) {
              $("#tanggal"+i).mask("99-99-9999",{placeholder:"dd-mm-yyyy"});
              $("#tgl_sl"+i).mask("99-99-9999",{placeholder:"dd-mm-yyyy"});
              $("#jam"+i).mask("99:99",{placeholder:"hh-mm"});
			}  
			 $(".select2").select2();
        });
		
		function myFunction() {
		  // Get the checkbox
		  var checkBox = document.getElementById("myCheck");
//		  alert('xxxx');
		  // Get the output text
//		  var text = document.getElementById("text");
		
		  // If the checkbox is checked, display the output text
		  if (checkBox.checked == true){
//		    alert('true');
//			text.style.display = "block";
//			document.getElementById("myCheck").value='11';
		  } else {
//		    alert('false');
//			document.getElementById("myCheck").value='22';
//			text.style.display = "none";
		  }
		} 	




        </script>
