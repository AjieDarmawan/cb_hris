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

/////////////////////////////////
if(isset($page)&&($act=="UpdateACC")){
//     echo 'Update-ACC';return;
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
	 for($i=0;$i < $rec; $i++){
	    $cek_tgl    = $_REQUEST["tgl_cuti"][$i];
		$cek_nota   = $_REQUEST["adatanota"][$i];
	    $cek_atasan = $_REQUEST["atasan"][$i];
		$cek_valid  = $_REQUEST["adatavalid"][$i];
		if ($cek_tgl != "" AND $cek_atasan != "" AND $cek_valid=="Y" and $cek_nota==""){
		   $adtnota .= date('Ymd').'-'.$id;
		}else{
		   $adtnota .= $_REQUEST["adatanota"][$i];
		}
		$adtnota .="#";
		
	    $adtcuti .=$_REQUEST["tgl_cuti"][$i];
	    $adtcuti .="#";
		if ($_REQUEST["tgl_cuti"][$i] <> ""){
		    $adtket .=$_REQUEST["dataket"][$i];
//		    $adtvalid .=$_REQUEST["datavalid"][$i];
		    $adt_atasan .=$_REQUEST["atasan"][$i];
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
		
		///////////cek-notif-read///////////////////
		if ($_REQUEST["adatavalid"][$i]=="Y"){
			$sql_upd_ntf = " UPDATE cuti_ntf SET ntf_data_read='$ntf_read' WHERE ntf_data_id='$ntf_id '";
			$sql_cek_ntf = " SELECT * FROM cuti_ntf WHERE ntf_data_id='$ntf_id' AND ntf_data_read = '' ";
			$cek_rec_ntf = mysql_num_rows(mysql_query($sql_cek_ntf));
			if ($cek_rec_ntf == 1 ){
			  $query_upd = mysql_query($sql_upd_ntf);
			}
		}	
		///////////////////////////////////////////////
		
	 }
	 
     //	 echo 'Upddate : '.$id.' -> '.$adtcuti; exit();

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
		  		     datavalid = '$adtvalid',
				     sisa_cuti= jml_cuti - '$jmlcuti'
				     WHERE kar_id='$id'   
			    ";
         
		// echo  $q_upd_acc ; return;
		 
        $result_upd_acc = mysql_query($q_upd_acc);
		
 /*   echo "<script>document.location='?p=$page&id='".$id."</script>";	*/
	    echo "<script>
			  document.location='?p=cuti&id=$id';
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
		
		$jml_acc_new = 0 ;
		for($i=0; $i < count($adatacuti); $i++){
		   if ($adatacuti[$i] <> "" AND $adata_atasan[$i] <> "" AND  $adatavalid[$i] <> "Y"){
			   $jml_acc_new++;
		   }
		   
		}			
       // echo 'jml_acc_new : '.$jml_acc_new;
  ?>

<style>

	input[type="checkbox"][readonly] {
	  pointer-events: none;
	}
	
 
</style>


    <section class="content-header">

      <h1> Form Cuti : Persetujuan Atasan <?php //echo 'Form Cuti Karyawan : Approval ' //$title;?> <small></small> </h1>

      <ol class="breadcrumb">

        <li><a href="media.php"><i class="fa fa-dashboard"></i> Dashboard</a></li>

        <li class="active"><?php echo $title;?></li>

      </ol>

    </section>

   <!-- Main content -->

    <section class="content"> 
      <div class="row">
        <div class="col-md-11">
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
        <input type="hidden" name="id" value="<?php echo $id; ?>">
        <input type="hidden" name="ntf_id" value="<?php echo $ntf_id; ?>">
        <input type="hidden" name="ntf_tujuan" value="<?php echo $ntf_tujuan; ?>">

<div class='row'>    
  <div class="modal-header ">
  </div>
  <div class="form-group">
      <label class="control-label col-sm-1" for="">JmlCuti : </label>
      <div class="col-sm-2">
          <input type="text" class="form-control" name="jml_cuti" 
				placeholder="Jml Cuti"
		  value="<?php echo $r['jml_cuti']; ?>"  readonly="">
      </div>
      <label class="control-label col-sm-3" for="" style="text-align:left" >Keterangan </label>
      <label class="control-label col-sm-3" for="" style="text-align:left">Menyetujui Atasan </label>
      <label class="control-label col-sm-1" for="" style="text-align:left">Nomor</label>
      <label class="control-label col-sm-1" for="" style="text-align:right">Setuju </label>
  </div>

<?php 

  $jml_acc_new = 0 ;
  $disabled_acc = "disabled";
  for ($i=0 ;$i < 12;$i++){ 
     $xtgl =""; 
     if ($i==0){
	     $xtgl ="Tgl"; 
	 }
   ///////////////////////
    if ($adatacuti[$i] <> "" AND $adata_atasan[$i] <> "" AND  $adatavalid[$i] <> "Y"){
	    $jml_acc_new++;
		$disabled_acc = "";
    }
   ///////////////////
	$text_ntf = '-';;	
	if ( $adatavalid[$i] == "Y" ){
		$text_ntf = '<i class="fa fa-check"><b> OK </b></i>';;	
	}	

    $nota = $adatanota[$i];
	$checked  = "";
	$disabled = "";
	$cek_readonly = "";
	if ( $adatavalid[$i] == "1" ){
		$checked  = "checked";
//		$disabled = "disabled";
		$cek_readonly = "readonly";
//		$readonly = "readonly";
	}	
	$selected_1 = "";
	if ( $adatavalid[$i] == "Y"  ){
		$selected_1 = "selected";
	}	
	$selected_2 = "";
	if ( $adatavalid[$i] == "N" ){
		$selected_2 = "selected";
	}
		
	//$selected_0 = "";
	if ( $adatavalid[$i]=="" ){
		//$selected_0 = "selected";
		$selected_1 = "selected";
	}	

    $readonly = "readonly";
	
?>
  <div class="form-group">
      <label class="control-label col-sm-1" for=""><?php echo $xtgl.' Ke - '.($i+1)?></label>
      <div class="col-sm-2">
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
//	  if ($adatacuti[$i]!=""){
		   $display = "none";
		   $nama_atasan = "";
			if($kar_tampil){
				   foreach($kar_tampil as $data){  
					 if ($data['kar_id']== $adata_atasan[$i] ){
					   $nama_atasan = $data['kar_nik'].'-'.$data['kar_nm'];
					   break;
					 }
		          }
//		   }
		   //echo '<div class="col-sm-3" style=" background:#CCCCCC">'.$xdata_kar.'</div>';
	   $display_2 = "none";	   
	   if ($kar_id == $adata_atasan[$i] AND $adatavalid[$i] <> "Y" ){
		   $display_2 = "block";	   
	   }	   
	  ?>	   
      <div class="col-sm-3">
          <input type="text" class="form-control" name="xdata_acc[]"
				placeholder="-"
		  value="<?php echo $nama_atasan; ?>" <?php echo $readonly ;?> >
      </div>		   
	 <?php } ?>
	 	  
     <div class="col-sm-3" style=" display:<?php echo $display;?>;" >
		  <select   name="atasan[]" class="form-control select2"  aria-describedby="sizing-addon2" style="width:100%;" >	
		  	  <option value="" selected   > ................................. </option>" 
			<?php
				//$kar_tampil_3=$kar->kar_tampil_3();
				if($kar_tampil){
				   foreach($kar_tampil as $data){  
				     $selected = "";
					 $xdisabled = "";
					 if ($adatavalid[$i] <> ""){
						 $xdisabled = "disabled";
					   
					 }
					 if ($data['kar_id']== $adata_atasan[$i] ){
					    $selected = "selected";
					 }
			 ?>
			  <option value="<?php echo $data['kar_id'];?>" <?php echo $selected; ?> <?php //echo $xdisabled;?> >
				<?php echo $data['kar_nik'];?> - <?php echo $data['kar_nm'];?>
			  </option>
			  <?php }}?>  
		  
		  </select>
	 
		   
	 </div>	  

      <div class="col-sm-1" style="width:130px" >
          <input type="text" class="form-control" name="datanota[]"
				placeholder="-"
		  value="<?php echo $nota; ?>" <?php echo $readonly ;?> style="width:120px" >
      </div>

      <div class="col-sm-1" style=" display:<?php echo $display_2; ?>;">
		  <select   name="adatavalid[]" class="form-control "  aria-describedby="sizing-addon2" style="width:100%;"
		   onfocus="alert('Untuk Unit sebelum di ACC ...\nMohon dipastikan apakah permohonan cuti ybs, sdh ada backup di unit ?...')" >	
		  	  <option value="Y"  <?php echo $selected_1;?>  > Yes </option>" 
		  	  <option value="N"  <?php echo $selected_2;?>  > No </option>" 
		  	<!--  <option value=""   <?php //echo $selected_0; ?> > ... </option>" !-->
		  
		  </select>		
	 </div>	
	 <?php if ( $adatavalid[$i] == "Y" ){ ?> 
		<div class="col-sm-1" style=" width:150px;text-align:left" >
		  <?php echo $text_ntf; ?>
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
		  ?>
		   <a href="#"  onclick="OpenPopupCenter('<?php echo $url_nota ; ?>', 'TEST!?', 600, 650)" 
		   title=" Print Form Cuti " ><i class="fa fa-print"></i> <b> Cetak </b>
		   </a>
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
	 
	   <button type="submit" class="btn btn-primary" name="act" value="UpdateACC"  
	   		 onClick="if(confirm('Save ?...')==false){return false}"  <?php echo $disabled_acc ;?> >
			 <i class="fa fa-eyedropper"></i> <?php echo 'Approval' ?>
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
