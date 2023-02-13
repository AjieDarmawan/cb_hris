<?php
 if ($_SESSION['frange']==""){
      $r_awal = date("01/m/Y", strtotime($date));
      $r_sekarang = date("d/m/Y", strtotime($date));
      $r_awal_ori = date("Y-m-01", strtotime($date));
      $r_sekarang_ori = date("Y-m-d", strtotime($date));
      $f_daterange = $r_awal." - ".$r_sekarang; 
 }
?>

<!-- Content Header (Page header) -->

<section class="content-header">

  <h1> <?php echo $title;?> <small>(s/d H-1)</small>   </h1> 

  <ol class="breadcrumb">
    
    <li><a href="media.php"><i class="fa fa-dashboard"></i> Dashboard</a></li>

    <li class="active"><?php echo $title;?> </li>
  
  </ol>

</section>



<!-- Main content -->

<section class="content"> 

    <!-- Your Page Content Here -->

    <div class="row">

        <div class="col-md-12">

            <div class="box">

                <div class="box-header">

                  <h3 class="box-title">

                    <form class="form-inline" method="post" action="">

                        

                        <div class="input-group">

                            <span class="input-group-btn">
                              <button class="btn btn-default btn-flat CHEK_BCLEAR" data-clear="bclearday"
							   name="bclearday" 
							    title="Clear Filter"><i class="fa fa-close"></i>
							  </button>
                            </span>

                            <input style="width: 200px;" type="text" class="form-control dr" 
							id="filter_day" name="filter_day" title="Filter" 
							value="<?php if(!empty($_SESSION['frange'])){ echo $_SESSION['frange'];}else{ echo $f_daterange; }?>" placeholder="Day">

                            <span class="input-group-btn">
                              <button class="btn btn-default btn-flat CHEK_DAY"  name="bday">
							 	 <i class="fa fa-search"></i>
							  </button>
				
                            </span>

                        </div>  

 
                        <?php if(!empty($_SESSION['frange'])){?>
                     	<!--   <span class="label bg-maroon"><i class="fa fa-check"></i> Filter Active</span> !-->
                        <?php }?>


                        <div class="input-group">

                            <span class="input-group-addon"><i class="fa fa-user text-green"></i></span>
							 <select class="form-control select" name="filter_divisi"   onchange="doDEVISI(this);" >
                              <?php

                              if($kar_data['kar_jdw_akses'] == "ALL"){

                                $wfh_div_tampil=$wfh->wfh_div_tampil();

                              }else{

                                $wfh_div_tampil=$wfh->wfh_div_tampil_id($filter_divisi);

                              }

                              while($data=mysql_fetch_array($wfh_div_tampil)){

                              

                              if($data['div_id'] == $filter_divisi){

                                    $selected="selected";

                              }else{

                                    $selected="";

                              }

                              ?>

                              <option value="<?php echo $data['div_id'];?>" <?php echo $selected;?>><?php echo $data['div_nm'];?></option>

                              <?php }?>

                            </select>
							
                        </div>
					   <div class="input-group">
						  <b id="loading_page"></b>
					   </div>

                                

                    </form>

                  </h3>

                  <div class="pull-right">

                   

                  </div>

                </div><!-- /.box-header -->

                <div class ="DATA_LIST">
				  
	            </div>

 

            </div>

        </div>

    </div>

</section>
<script src="plugins/jQuery/jQuery-2.1.4.min.js"></script>
<link rel="stylesheet" type='text/css' href="plugins/sweetalert/sweetalert.css"> 
<script src="plugins/sweetalert/sweetalert.min.js" type="text/javascript"></script>  

<script>
$(document).ready(function(){

    // myAlert('Data Berhasil di Simpan','success',3000);
	 function myAlert(title,type,timer){
				setTimeout(function () { 	
					swal({
						title: title,
						text:  '',
						type: type,
						timer: timer,
						showConfirmButton: true
					});		
				},10);	
	  }
	 

	function cek_url(url){
		var http = new XMLHttpRequest();
		http.open('HEAD', url, false);
		http.send();
		if (http.status === 404){
			//alert('File Not Found !...');
		};
		return (http.status) ;	
	}
	////////load-datatanaman///////////////////
	doDataTanaman(data="");
	//////////////////////////////////////////   
	function doDataTanaman(data) {
 		var now = new Date();
		var dateString1 = moment(now).format('01/MM/YYYY');
		var dateString2 = moment(now).format('DD/MM/YYYY');
		var date_range = dateString1+' - '+dateString2;	
		var bclearday  	= "";	
		if (data == "bclearday"){
			document.getElementById("filter_day").value = date_range;
			bclearday  = data ;	
		};
		//////////////////////////////////////////////////////////////////////
	   	var filter_day 	 	= $('input[name=filter_day]').val();
		var filter_divisi 	= $('select[name=filter_divisi]').val();	
        var loading_page 	= ' <a class="btn btn-info">... <i class=" fa fa-refresh fa-spin"></i> ...<a>';
		document.getElementById("loading_page").innerHTML = loading_page ;
		///////////////////////////////////////////////////////////////////
		var page = "module/menanam_activity/list_data.php";
		var url = page;
/*	
		if (cek_url(page) == 404 ){
		   alert('File Not Found !...');
		   return false;
		}
*/	
		
		// AJAX request
 		$(".DATA_LIST").load(page,
				{bclearday:bclearday, filter_day:filter_day, filter_divisi:filter_divisi },
				function( response, status, xhr ) {
					  if ( status == "error" ) {
						var msg = " Error: File Not Found !... ";
						//$( "#error" ).html( msg + xhr.status + " " + xhr.statusText );
						 myAlert(' Error #'+xhr.status+' : File Not Found !... ','error',3000);	
					  }	
			 
						setTimeout(function () { 	
							document.getElementById("loading_page").innerHTML = '';
						},10);	
				       //myAlert('Data Berhasil di Simpan','success',2000);	
					   return false; 							  
				}	
				
		);
		return false;		 
	}
	
 
	
    $('.CHEK_BCLEAR').click(function(){
         doDataTanaman(data="bclearday");
		 return false;
		  /////////////////////////		
    });

    $('.CHEK_DAY').click(function(){
        doDataTanaman(data="");
		return false;
	});

   //////////////////////////////////////////////////////////////
	doDEVISI = function(data) {
	        doDataTanaman(data="");
			return false;
		 /////////////////////////		 
	};




/////////////////////////////////////////////////
});
</script>
