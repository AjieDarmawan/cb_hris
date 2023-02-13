<?php 


   // echo '<br>xxxxxxxxxxxxxx';
  //return false;


  	
				   
?>



	
<div class="modal fade"  id="modal-update-user"  role="dialog"     
		aria-labelledby="myModalLabel" aria-hidden="true"   
        style="overflow-y: scroll; max-height:85%;  margin-top: 50px; margin-bottom:50px;" >   	

  <div class="modal-dialog modal-lg">

    <div class="modal-content">

      <div class="modal-header bg-primary">

        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>

        <h4 class="modal-title" id="myModalLabel"><i class="fa fa-bar-chart"></i> Form Performance Review</h4>

      </div>

      
      <div class="modal-body">
	  <?php
			session_start();
			date_default_timezone_set('Asia/Jakarta'); 
			foreach($_REQUEST as $name=>$value){
				$$name=$value;
				//echo "$name : $value;<br />\n";
			}	  
			include "rev_data_action.php"; 
			
			$range_now 	= date('01/m/Y') . ' - ' . date('d/m/Y');
		
			$xdata = __list_karyawan($id);  
			
			///////////////////////////////////////////////////////////
			$json_rev = __list_noreview();  
			$nik      = $xdata[0]['kar_nik'];
			$number   = 1000000+1;
			$num_rev  = "REV-".substr($nik,3,4).'-'.substr($number,-4);
			/////////////////////////////////////////////////////////
			$cekno    = '' ;
			for($a=0; $a < count($json_rev); $a++) {
			  // echo '<br>'.$json_nopo[$a]['do_id']; 
			   $cekno     = $json_rev[$a]['rev_nomor']; 
			   $xkd       = substr($cekno,-4);
			   $number    = 1000000+intval( $xkd )+1;
			   $nik        = $xdata[0]['kar_nik'];
			   $num_rev    = "REV-".substr($nik,3,4).'-'.substr($number,-4);
			   // echo $num_rev;
			 
			}	
			//echo  $num_rev;	 
	 ?>
	<!-- Main content -->

        <section class="invoice">

          <!-- title row -->

          <div class="row">

            <div class="col-xs-12">

              <h2 class="page-header">

                <img src="dist/img/logo_gg_small130.JPG" width="80"> PT. Gilland Ganesha

                <small class="pull-right">

		  <br>

		  <div class="form-group">

		    <label for="kpi_tgl" class="col-sm-2 control-label">Date</label>

		    <div class="col-sm-10">
			
			   <input type="hidden" class="form-control" name="rev_nomor"   
			      value="<?php echo  $num_rev;?>" readonly >

		      <input type="text" class="form-control" name="rev_tanggal"  id="rev_tanggal" 
			      value="<?php echo date('Y-m-d');?>"
				  placeholder="Tanggal Review" data-inputmask="'alias': 'yyyy-mm-dd'" 
				  data-mask style="width:182;" required readonly >

		    </div>

		  </div>

		</small>

                <center><small>Jl. Raya Bogor Km 47,5 Perum Bumi Sentosa Blok A3 No.3, Nanggewer Cibinong, Jawa Barat 16912.</small></center>

              </h2>

            </div><!-- /.col -->

          </div>

          <!-- info row -->

          <div class="row invoice-info">

          <center><h3><u>Review Performance</u></h3>
           <!-- Nomor Surat&nbsp;&nbsp;<b> <?php //echo $new_kd;?></b> <br/><br/><br/> !-->
			<br/><br/> 
		  </center>

            <div class="col-sm-6 invoice-col">

              <address>

                <strong><?php echo $xdata[0]['kar_nm'];?></strong><br>

                NIK: <?php echo $xdata[0]['kar_nik'];?><br>

                Divisi: <?php echo $xdata[0]['div_nm'];?> / <?php echo  $xdata[0]['jbt_nm'];?><br>

                Location: <?php echo $xdata[0]['unt_nm'];?> / <?php echo $xdata[0]['ktr_nm'];?><br>

	       	   <input type="hidden" name="rev_div" value="<?php echo $xdata[0]['div_nm'];?>">

              </address>

            </div><!-- /.col -->



            <div class="col-sm-6 invoice-col">





		<div class="form-group">

		  <label for="rev_priode" class="col-sm-6 control-label">Priode Review</label>

		  <div class="col-sm-6">

		    <select class="form-control " onchange="doCekReview(this.value)" 
			  name="rev_kode" id="id_rev_kode" style="width:171px;" required >

		      <option value="" selected></option>

		      <?php

			$huruf=array(
					    "REV-1" => 'Review Ke-1',
					    "REV-2" => 'Review Ke-2',
						"REV-3" => 'Review Ke-3',
						"REV-4" => 'Review Ke-4',
						"REV-5" => 'Review Ke-5',
						"REV-6" => 'Review Ke-6',
						"REV-7" => 'Review Ke-7',
						"REV-8" => 'Review Ke-8',
						"REV-9" => 'Review Ke-9',
						"REV-10" => 'Review Ke-10',
						"REV-11" => 'Review Ke-11',
						"REV-12" => 'Review Ke-12'
                       );

                        

			foreach($huruf as $value => $caption) {	

		      ?>

		      <option value="<?php echo $value; ?>"><?php echo $caption; ?></option>

		      <?php }?>

		    </select>

		  </div>

		</div>

            </div><!-- /.col -->

          </div><!-- /.row -->



          <!-- Table row -->

          <div class="row">

            <div class="col-xs-12 table-responsive">

	          <input type="hidden" id="kar_nik" value="<?php echo $xdata[0]['kar_nik']; ?>">

                <table class="table table-striped table-bordered table-condensed" 
				      style="font-size:16px">

                    <thead>

                        <tr>
                            <th rowspan="1" style="vertical-align: middle;text-align: center">NO</th>
                            <th rowspan="1" colspan="2" style="vertical-align: middle;text-align: center">
							SASARAN							</th>
                            <th colspan="1" style="vertical-align: middle;text-align: center">AKTUAL</th>
                        </tr>
                     </thead>

		      <tbody>
			  <?php
			 	 $no=1;
		 		// $div_nama =  $xdata[0]['div_nm'];	
			  	// $kps_div =$div_nama;
			 	// $kpi_sasaran_div = $kpi->kpi_sasaran_div($kps_div);
				 
			  ?>  	
			  <tr>
			      <td style="text-align: center"><?php echo $no ; ?></td>
				  <td>
				     Pencapaian Mahasiswa Baru Review <span id="xrev_ke1">ke ...</span> 
					 <b> 
					  <input type="text" name="rev_ke[<?php echo $no; ?>]"  
					  value="1" style="width:40px; text-align:center;   ">
					 </b>				  </td>
			      <td>
					<input type="text" name="date_range[<?php echo $no; ?>]" id="sipema_range1" 
					class="form-control sipema_range pull-right"  
					value="" placeholder="cut off point"  required>
					
					<input type="hidden" name="data_detail[<?php echo $no; ?>]" id="sipema-detail"
					 class="form-control pull-right"  value="" readonly >
					
					<input type="hidden" name="data_reward" id="sipema-reward" 
					class="form-control pull-right"  value="" readonly>
					
					<input type="hidden" name="data_reward_detail" id="sipema-reward-detail" 
					class="form-control pull-right"  value="" readonly>				 
					 </td>
			      <td style="text-align: center">
				  	<input type="hidden" class="form-control" name="rev_data1[<?php echo $no; ?>]" 
					id="sipema1-val"  value="" style="width:60px;"><span id="sipema1-data"></span>				  </td>
 		     </tr>
			  
              <?php $no++ ;?>
			  <tr>
			      <td style="text-align: center"><?php echo $no ; ?></td>
				  <td>
			  	    Pencapaian Mahasiswa Baru Review <span id="xrev_ke2">ke ... </span><b>
			  	    <input type="text" name="rev_ke[<?php echo $no; ?>]"  
					  value="2" style="width:40px; text-align:center;   " />
			  	    </b>
				 </td>
				 
			      <td>
					<input type="text" name="date_range[<?php echo $no; ?>]" id="sipema_range2" 
					class="form-control sipema_range2 pull-right"  
					value="" placeholder="cut off point"  required>				 
				 </td>
			      <td style="text-align: center">
				  	<input type="hidden" class="form-control" name="rev_data1[<?php echo $no; ?>]" 
					id="sipema1-val2"  value="" style="width:60px;"><span id="sipema1-data2"></span>				  				</td>
 		      </tr>
			

              <?php $no++ ;?>
			  <tr>
			      <td style="text-align: center"><?php echo $no ; ?></td>
				  <td>
			  	    Pencapaian Mahasiswa Baru Review <span id="xrev_ke3">ke ... </span><b>
			  	    <input type="text" name="rev_ke[<?php echo $no; ?>]"  
					  value="3" style="width:40px; text-align:center;   " />
			  	    </b>
				 </td>
				 
			      <td>
					<input type="text" name="date_range[<?php echo $no; ?>]" id="sipema_range3" 
					class="form-control sipema_range3 pull-right"  
					value="" placeholder="cut off point"  required>				 
				 </td>
			      <td style="text-align: center">
				  	<input type="hidden" class="form-control" name="rev_data1[<?php echo $no; ?>]" 
					id="sipema1-val3"  value="" style="width:60px;"><span id="sipema1-data3">
					</span>				  				
				 </td>
 		      </tr>
			
			  
              <?php $no++ ;?>
			  <tr>
			      <td style="text-align: center"><?php echo $no ; ?></td>
				  <td>
				  	Total Pencapaian Kampus PIC Unit pada Review <span id="xrev_ke4">ke ... </span>
					 <b> 
					  <input type="text" name="rev_ke[<?php echo $no; ?>]"  
					  value="1" style="width:40px; text-align:center;   ">
					 </b>  						
				  </td>
			      <td>
					<input type="text" name="date_range[<?php echo $no; ?>]" id="pic_range" 
					class="form-control pic_range pull-right"  
					value="" placeholder="cut off point"  required>				 
				 </td>
			      <td style="text-align: center">
				  	<input type="hidden" class="form-control" name="rev_data1[<?php echo $no; ?>]" 
					id="pic-val"  value="" style="width:60px;"><span id="pic-data"></span>				  </td>
 		      </tr>
			  
			  
              <?php $no++ ;?>
			  <tr>
			      <td style="text-align: center"><?php echo $no ; ?></td>
				  <td>
				  	Total Pencapaian Kampus PIC Unit pada Review <span id="xrev_ke5">ke ... </span> 
					 <b> 
					  <input type="text" name="rev_ke[<?php echo $no; ?>]"  
					  value="2" style="width:40px; text-align:center;   ">
					 </b>  						
				  </td>
			      <td>
					<input type="text" name="date_range[<?php echo $no; ?>]" id="pic_range2" 
					class="form-control pic_range2 pull-right"  
					value="" placeholder="cut off point"  required>				  
					</td>
			      <td style="text-align: center">
				  	<input type="hidden" class="form-control" name="rev_data1[<?php echo $no; ?>]" 
					id="pic-val2"  value="" style="width:60px;"><span id="pic-data2"></span>				  
					</td>
 		      </tr>			  
			  
			  
              <?php $no++ ;?>
			  <tr>
			      <td style="text-align: center"><?php echo $no ; ?></td>
				  <td>Progress Pencapaian Kampus dari Review Sebelumnya </td>
			      <td>				  </td>
			      <td style="text-align: center">
				  	<input type="hidden" class="form-control" name="rev_data1[<?php echo $no; ?>]" 
					id="unit-val"  value="" style="width:60px;"><span id="unit-data"></span>				  
					</td>
 		      </tr>			  

			  
              <?php $no++ ;?>
			  <tr>
			      <td style="text-align: center"><?php echo $no ; ?></td>
				  <td>Sumbangan Pencapaian Kampus dari Pencapaian Unit PIC </td>
			      <td>				  </td>
			      <td style="text-align: center">
				  	<input type="hidden" class="form-control" name="rev_data1[<?php echo $no; ?>]" 
					id="unit-val2"  value="" style="width:60px;"><span id="unit-data2"></span>				  </td>
 		      </tr>			  
		      </tbody>
              </table>

            </div><!-- /.col -->

          </div><!-- /.row -->



 

	  <br>

	  <!-- info row -->


     </section><!-- /.content -->





      </div>

      <div class="modal-footer">
		<input type="hidden" name="mode" value="simpan"> 
		<input type="hidden" name="act" value="<?php echo $act;?>">   
		<input type="hidden" name="aksi" value="<?php echo $aksi;?>">  
		<input type="hidden" name="aksi_proses" value="<?php echo $aksi_proses;?>">  		
		<button type="submit" name="bsave" class="btn btn-primary">
			<i class="fa fa-save"></i> Simpan & Kirim
		</button>
		<button type="button" class="btn btn-danger" data-dismiss="modal">
			<i class="fa fa-close"></i> Close
		</button> 
      </div>

   

    </div>

  </div>

</div>
