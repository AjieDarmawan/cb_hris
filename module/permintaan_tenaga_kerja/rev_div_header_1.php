<?php 
    session_start();
    date_default_timezone_set('Asia/Jakarta'); 
    foreach($_REQUEST as $name=>$value){
		$$name=$value;
		//echo "Name: $name : $value;<br />\n";
    }	  
   // include "rev_data_action.php"; 
	
 //   $range_now 	= date('01/m/Y') . ' - ' . date('d/m/Y');
    $range_now 	= date('01/01/Y') . ' - ' . date('d/m/Y');
 	$cek_nospk = "";
	
	$kar_id     = $_SESSION['kar'] ;
	
   //return false;
			   
?>


<div class="col-xs-12">  
<div class="box">
	<div class="box-header">    
		<div class="row" >    
		<div class="pull-left " style="margin-left:10px">   
<form method="post" class="form-inline" action="javascript:void(0);">   

      	<div class="input-group ">   
			<span class="input-group-btn" >     
				<a href="#" id="myRefresh"  class="btn btn-default" >    
					<i class="fa fa-refresh"></i>&nbsp;     
				</a>     			
			</span>    
			<input type="text" class="form-control dr-tanggal"   onchange="doFilterDAY()"
				name="filter_day" id="filter_day" style="width: 180px;"    
				title="Filter" value="<?php echo $range_now;?> " placeholder="Day" >   
     	</div>    

<!--	
     	<div class="input-group">
			<select class="form-control myselect" id="id_progres_po" 
			  name="id_progres_po" style="width:120px;"  >  
				<option value="" selected > ALL  </option>  
				<option value ="NEW" 	> NEW  </option>  
				<option value ="PROSES" > PROSES </option>  
				<option value ="CLOSE"	> CLOSE  </option>  
		
			</select>    
     	</div> 
!-->	

 <?php if ($kar_id == 499 || $kar_id == 551 || $kar_id == 542 ){ ?>	
     	<div class="input-group">
     		<a  href="#" class="btn btn-success  "
			     onclick="doUpdateData(0)" 
			     style="width:120px"     
     			 title="Tambah Data" >     
      			<i class="fa fa-plus "></i> ADD DATA      
     		</a>     
     	</div>    
<?php  } ?>
<!--	
     	<div class="input-group ">   
			<button class="btn btn-primary "  style="width:120px"   
				onclick="doMyExcel('tb_paket_tool','SLIP-ORDER','Data-Slip-Order.xls')"  
				 title="To Excel" >     
				 <i class="fa fa-file-excel-o"></i> TO EXCEL    
			</button>    		
     	</div>    
!-->		
	
</form>  
   
</div>    
</div>   

