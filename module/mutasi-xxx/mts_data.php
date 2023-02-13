<?php require('module/mutasi/mts_act.php'); ?>

<script>
	function valueselect()
	{
		var i = document.getElementById('jenis_data');
		var p = i.options[i.selectedIndex].value;
		var x = "MUTASI";
		var x2 = "Mutasi";
		if ( p == "Demosi"){
		  x  = "DEMOSI"; 
		  x2 = "Demosi";
		}
		//alert(p);
		//window.location.href = "channelinformation.html?selected="+p;
		document.getElementById("judul_1").innerHTML = 'FORM '+x+'  TENAGA KERJA'; 
		document.getElementById("judul_2").innerHTML = x ; 
	}

	function validateForm() {
	  var x_jbt = document.forms["myFormMutasi"]["fpk_jabatan2"].value;
	  var x_div = document.forms["myFormMutasi"]["fpk_divisi2"].value;
	  var x_lvl = document.forms["myFormMutasi"]["fpk_level2"].value;
	  var x_ktr = document.forms["myFormMutasi"]["fpk_ktr2"].value;
	  var x_penilai = document.forms["myFormMutasi"]["fpk_penilai"].value;
	  var x_mengetahui = document.forms["myFormMutasi"]["fpk_mengetahui"].value;
	  var x_mengetahui2 = document.forms["myFormMutasi"]["fpk_mengetahui2"].value;
	  var x_menyetujui = document.forms["myFormMutasi"]["fpk_menyetujui"].value;
	  if (x_jbt == "") {
		alert("Kolom Jabatan Harus Diisi !...");
		return false;
	  }
	  if (x_div == "") {
		alert("Kolom Divisi Harus Diisi !...");
		return false;
	  }
	  if (x_lvl == "") {
		alert("Kolom Level Harus Diisi !...");
		return false;
	  }
	  if (x_ktr == "") {
		alert("Kolom Unit/Lokasi Harus Diisi !...");
		return false;
	  }
	  if (x_penilai == "") {
		alert("Kolom Nama Pemohon Harus Diisi !...");
		return false;
	  }
	  if (x_mengetahui == "") {
		alert("Kolom Menyetujui-1 Harus Diisi !...");
		return false;
	  }
	  if (x_mengetahui2 == "") {
		alert("Kolom Menyetujui-2 Harus Diisi !...");
		return false;
	  }
	  if (x_menyetujui == "") {
		alert("Kolom Mengetahui Harus Diisi !...");
		return false;
	  }
      if (confirm("Mau di Simpan ?")==false){
	     return false;
	  }
	  
	} 
	
</script>

<!-- Content Header (Page header) -->

    <section class="content-header">

      <h1> <?php echo $title;?> <small></small> </h1>

      <ol class="breadcrumb">

        <li><a href="media.php"><i class="fa fa-dashboard"></i> Dashboard</a></li>

        <li class="active"><?php echo $title;?></li>

      </ol>

    </section>

    

    <!-- Main content -->

    <section class="content"> 

      

      <!-- Your Page Content Here -->

      <div class="row">

        <div class="col-md-6">

          <div class="box box-info">

            <div class="box-header">

              <h3 class="box-title">Data Karyawan</h3>

	      <!-- tools box -->

                  <div class="pull-right box-tools">

                    <a href="?p=data_mutasi"  class="btn btn-sm btn-default"><i class="fa fa-refresh"></i></a>

                    <button class="btn btn-info btn-sm" data-widget='collapse' data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>

                    <button class="btn btn-info btn-sm" data-widget='remove' data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>

                  </div><!-- /. tools -->

	    </div>

            <!-- /.box-header -->

            <div class="box-body">

              

              <table id="tb_karyawan" class="table table-bordered table-striped table-hover">

                <thead>

                  <tr>

                    <th>NIK</th>

                    <th>Nama</th>

                    <th>Divisi</th>

                    <th>Kantor</th>

                  </tr>

                </thead>

                <tbody>

                <?php

        //$kar_tampil=$kar->kar_tampil();

        if($kar_tampil){

        foreach($kar_tampil as $data){ 



        if($data['kar_id']==$_GET['id']){

            $block="danger";

            $check="<i class='fa fa-check text-green'></i>";

        }else{

            $block="";

            $check="";

        } 

        ?>        

                  <tr class="<?php echo $block;?>">

                    <td><?php echo $check;?> <a href="?p=data_mutasi&id=<?php echo $data['kar_id']; ?>"><?php echo $data['kar_nik']; ?></a></td>

                    <td><a href="?p=data_mutasi&id=<?php echo $data['kar_id']; ?>"><?php echo $data['kar_nm']; ?></a></td>

                    <td><?php echo $data['div_nm']; ?></td>

                    <td><a data-toggle="tooltip" title="<?php echo $data['ktr_nm']; ?>" style="cursor:pointer"><?php echo $data['ktr_kd']; ?></a></td>

                  </tr>

                  

                <?php }}?>  

                </tbody>      

                <tfoot>

                  <tr>

                    <th>NIK</th>

                    <th>Nama</th>

                    <th>Divisi</th>

                    <th>Kantor</th>

                  </tr>

                </tfoot>

              </table>



            </div>

            <!-- /.box-body -->

          </div>

          <!-- /.box -->



        </div>

        <!-- /.col -->

	

	<div class="col-md-6">

          <div class="box box-danger">

            <div class="box-header">

              <h3 class="box-title">Form Mutasi / Demosi Tenaga Kerja</h3>

                  <!-- tools box -->

                  <div class="pull-right box-tools">

                    <?php

                  if(!empty($_GET['id'])){ 

                  ?>
<!--
		    <a href="?p=report_penilaian&id=<?php echo $kar_id_;?>" style="cursor:pointer" class="btn btn-sm btn-primary"><i class="fa fa-bar-chart"></i> Report Penilaian</a>
!-->

		    <button style="cursor:pointer" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#md_fpk"><i class="fa fa-plus" title="Form Mutasi/Demosi"></i> Add </button>


                  <?php }?>

                    <button class="btn btn-info btn-sm" data-widget='collapse' data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>

                    <button class="btn btn-info btn-sm" data-widget='remove' data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>

                  </div><!-- /. tools -->

            </div>

            <!-- /.box-header -->

            <div class="box-body">

              

              <table id="tb_absen" class="table table-bordered table-striped table-hover">

                <thead>

                  <tr>

		    <th>Nomor</th>

                    <th>Keterangan</th>

                    <th>Priode</th>
		    
		    <th>Tanggal</th>

		    <th>Status</th>

                    <th>Aksi</th>

                  </tr>

                </thead>

                <tbody>

                <?php

                if(!empty($_GET['id'])){  

                $kar_id_=$_GET['id'];      

                $fpk_tampil_kar=$mts->mts_tampil_kar($kar_id_);

                while($fpk_data_kar=mysql_fetch_array($fpk_tampil_kar)){ 



                  $kar_id_=$fpk_data_kar['kar_id'];

                  $kar_tampil_id_=$kar->kar_tampil_id($kar_id_);

                  $kar_data_=mysql_fetch_array($kar_tampil_id_);



                if($fpk_data_kar['fpk_keterangan']=="Mutasi Karyawan"){

                    $label="<span class='label label-warning'>Mutasi Karyawan</span>";

                }elseif($fpk_data_kar['fpk_keterangan']=="Demosi Karyawan"){

                    $label="<span class='label label-primary'>Demosi Karyawan</span>";

                }else{

                    $label="";

                }

		

		if($fpk_data_kar['fpk_sts']=="X"){
                    $label_sts="<span class='label label-warning'>Proses</span>";
               }elseif($fpk_data_kar['fpk_sts']=="Y"){
                  $label_sts="<span class='label label-primary'>Lock</span>";
               }elseif($fpk_data_kar['fpk_sts']=="Z"){
                    $label_sts="<span class='label label-success'>Approved</span>";
               }elseif($fpk_data_kar['fpk_sts']=="T"){
                    $label_sts="<span class='label label-success'>Ditolak</span>";
                }else{
                    $label_sts="";
                } 


       ?>        

                  <tr>

		    <td><?php echo $fpk_data_kar['fpk_kd'];?></td>

                    <td><?php echo $label; ?></td>

                    <td><?php echo $fpk_data_kar['fpk_priode'];?></td>
		    
		    <td><?php echo $tgl->tgl_indo($fpk_data_kar['fpk_kirim']);?></td>

		    <td><?php echo $label_sts; ?></td>

                    <td>

		      <a href="?p=form_mutasi&act=open&id=<?php echo md5($fpk_data_kar['fpk_kd']); ?>"><span style="cursor:pointer" class="label label-primary"><i class="fa fa-ellipsis-h"></i></span></a>

                      <!--<a href="#delete-fpk" data-toggle="modal" data-data="<h4>Yakin Hapus <strong><?php echo $fpk_data_kar['fpk_keterangan'];?> - <?php echo $kar_data_['kar_nm'];?></strong> ?</h4>" data-url="?p=data_mutasi&id=<?php echo $fpk_data_kar['kar_id'];?>&act=hapus_fpk&no=<?php echo $fpk_data_kar['fpk_id'];?>"><span style="cursor:pointer" class="label label-danger"><i class="fa fa-trash"></i></span></a>-->

                    </td>

                  </tr>

                  

                <?php }}?>  

                </tbody>      

                <tfoot>

                  <tr>
			
		    <th>Nomor</th>

                    <th>Keterangan</th>

                    <th>Priode</th>
		    
		    <th>Tanggal</th>

		    <th>Status</th>

                    <th>Aksi</th>

                  </tr>

                </tfoot>

              </table>

	      

            </div>
            <!-- /.box-body -->

          </div>
          <!-- /.box -->
	  
	  
 <!----------------------------------------------------------------------------->
	  

 <!----------------------------------------------------------------------------->


          <!-- /.box -->
	  
<!--	  
	  <button type="button" onclick="kontrak_ekspor()"  class="btn btn-lg btn-block btn-success">
	  	<i class="fa fa-file-excel-o"></i> <strong>Export Data Kontrak</strong>
	  </button>
!-->
	  
	  
        </div>
        <!-- /.col -->


      </div>

      <!-- /.row -->
      
      <style type="text/css">
      #loading{
	text-align: center;
	display: none;
	position: fixed;
	background-color: rgba(0, 0, 0, 0.3);
	z-index: 1000;
	left: 0;
	top: 0;
	height: 100%;
	width: 100%;
	padding-top:10%;
      }
      #output{
	font-size: 10px;
      }
      </style>
      
      <div id="loading"><img src="dist/img/loadingnew3.gif" /></div>
      
      
      

      

    </section>

    <!-- /.content --> 





    <!-- POPUP -->

<!-- Button trigger modal -->


<?php
if(!empty($_GET['id'])){
?>


<!-- Modal Edit Kontrak Karyawan-->




<!-- Modal FPK MUTASI -->

<div class="modal fade" id="md_fpk" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">

  <div class="modal-dialog modal-lg">

    <div class="modal-content">

      <div class="modal-header bg-primary">

        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>

        <h4 class="modal-title" id="myModalLabel"><i class="fa fa-bar-chart"></i> Form Mutasi Tenaga Kerja</h4>

      </div>

      <form name="myFormMutasi" class="form-horizontal" action="" onsubmit="return validateForm()" method="post">
         
      <div class="modal-body">

          

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

		    <label for="fpk_tgl" class="col-sm-2 control-label">Date</label>

		    <div class="col-sm-10">

		      <input type="text" name="fpk_tgl" class="form-control " id="fpk_tgl" placeholder="Tanggal " data-inputmask="'alias': 'yyyy-mm-dd'" data-mask style="width:182;" required <?php echo $nonaktif;?>>

		    </div>

		  </div>

		</small>

                <center><small>Jl. Raya Bogor Km 47,5 Perum Bumi Sentosa Blok A3 No.3, Nanggewer Cibinong, Jawa Barat 16912.</small></center>

              </h2>

            </div><!-- /.col -->

          </div>

          <!-- info row -->

          <div class="row invoice-info">

          <center><h3><u><p id="judul_1">FORM MUTASI / DEMOSI TENAGA KERJA</p></u></h3>

          Nomor Surat&nbsp;&nbsp;<b> <?php echo $new_kd;?></b><br/><br/><br/></center>

            <div class="col-sm-6 invoice-col">

              <address>

                <strong><?php echo $kar_data_['kar_nm'];?></strong><br>

                NIK: <?php echo $kar_data_['kar_nik'];?><br>

                Divisi: <?php echo $kar_data_['div_nm'];?> / <?php echo $kar_data_['jbt_nm'];?><br>

                Location: <?php //echo $kar_data_['unt_nm'];?>  <?php echo $kar_data_['ktr_nm'];?><br>

              </address>

            </div><!-- /.col -->

            

            <div class="col-sm-6 invoice-col">

		<div class="form-group">

		  <label for="fpk_priode" class="col-sm-6 control-label">Mutasi / Demosi</label>

		  <div class="col-sm-6">

		    <select class="form-control" name="jenis_data" id="jenis_data" style="width:171px;"
			 onchange="javascript:valueselect()" required  >
			 
		      <option value="" selected></option>

		      <?php

			$huruf_1=array(
				      "Mutasi" => 'Mutasi Karyawan',
				      "Demosi" => 'Demosi Karyawan'
				      );

			foreach($huruf_1 as $value => $caption) {	

		      ?>

		      <option value="<?php echo $value; ?>"><?php echo $caption; ?></option>

		      <?php }?>

		    </select>

		  </div>

		</div>


		<div class="form-group">

		  <label for="fpk_priode" class="col-sm-6 control-label">Priode</label>

		  <div class="col-sm-6">

		    <select class="form-control" name="fpk_priode" id="fpk_priode" style="width:171px;"
			 onchange="XXXX_eventDitetapkan()" required>

		      <option value="" selected></option>

		      <?php

			$huruf=array(
				      "Kesatu" => 'Kesatu',
				      "Kedua" => 'Kedua',
				      "Ketiga" => 'Ketiga',
				      "Keempat" => 'Keempat',
				      "Kelima" => 'Kelima',
				      "Keenam" => 'Keenam',
				      );

			foreach($huruf as $value => $caption) {	

		      ?>

		      <option value="<?php echo $value; ?>"><?php echo $caption; ?></option>

		      <?php }?>

		    </select>

		  </div>

		</div>

		<div class="form-group">

		  <label for="fpk_tgl" class="col-sm-6 control-label">Gaji Terakhir</label>

		  <div class="col-sm-6">

		    <input type="text" name="fpk_gaji" class="form-control" id="fpk_gaji" placeholder="Gaji Terakhir" style="width:182;" onKeyPress="return onlyNumbers(event);" <?php echo $nonaktif;?>>

		  </div>

		</div>

		

            </div><!-- /.col -->

          </div><!-- /.row -->



          <!-- Table row -->

          <div class="row">
            <div class="col-xs-12 table-responsive">


<div class="panel-group" id="accordion">
<!-------------------------------------------------------------------!-->  
		
		<div class="panel panel-default">

		  <div class="panel-heading">

		    <h4 class="panel-title">

		      <a data-toggle="collapse" data-parent="#accordion" 
			  href="#aspek_1<?php //echo $fpk_data_asp['fpk_asp_id']; ?>">
              I. POSISI SEKARANG
		      <div class="pull-right"><i class="fa fa-chevron-down"></i></div></a>

		    </h4>

		  </div>
          <?php  $in = "in"; ?>    
		  <div id="aspek_1<?php //echo $fpk_data_asp['fpk_asp_id']; ?>" 
		    class="panel-collapse collapse <?php echo $in; ?>" >

		    <div class="panel-body">
	      
		      <table class="" border="0" width="100%">


			  
			  <tbody>


			  <tr>

			    <td width="30%">
					<div >
					<i class="fa fa-check-square-o"></i> Jabatan / Posisi 
					</div>
				</td>
				<td width="3%">:</td>
			    <td  width="" >
					<div >
						<b><?php echo $kar_jbt['jbt_nm'];?></b>
					</div>
				</td>



			  </tr>

	
			  <tr>

			    <td>
					<div >
					<i class="fa fa-check-square-o"></i> Devisi / Unit Kerja
					</div>
				</td>
				<td>:</td>
			    <td >
					<div >
						<b><?php echo $kar_jbt['div_nm'];?></b>
					</div>
				</td>




			  </tr>

			  <tr>

			    <td>
					<div >
					<i class="fa fa-check-square-o"></i> Level
					</div>
				</td>
				<td>:</td>
			    <td >
					<div >
						<b><?php echo $kar_jbt['lvl_nm'];?></b>
					</div>
				</td>



			  </tr>

			  <tr>

			    <td>
					<div >
					<i class="fa fa-check-square-o"></i> Lokasi
					</div>
				</td>
				<td>:</td>
			    <td >
					<div >
						<b><?php 
						  //echo $kar_jbt['unt_nm'];
						   echo $kar_jbt['ktr_nm'];
						?></b>
					</div>
				</td>



			  </tr>
			 

			</tbody>

		      </table>

		      

		    </div>

		  </div>

		</div>


<!-------------------------------------------------------------------!-->

<!-------------------------------------------------------------------!-->      
		<div class="panel panel-default">

		  <div class="panel-heading">

		    <h4 class="panel-title">

		      <a data-toggle="collapse" data-parent="#accordion" 
			  href="#aspek_2<?php //echo $fpk_data_asp['fpk_asp_id']; ?>">
              II. POSISI SETELAH  <font id="judul_2">MUTASI</font>
		      <div class="pull-right"><i class="fa fa-chevron-down"></i></div></a>

		    </h4>

		  </div>
		  <?php  $in = "in"; ?>    
		  <div id="aspek_2<?php //echo $fpk_data_asp['fpk_asp_id']; ?>" 
		       class="panel-collapse collapse <?php echo $in; ?>">

		    <div class="panel-body">
	      
		      <table class="" border="0"  width="100%">

		  
			  <tbody >
			  <tr >

			    <td width="30%">
					<div >
					<i class="fa fa-check-square-o"></i> Jabatan / Posisi *)
					</div>
				</td>

				<td width="3%"> : </td>


			    <td width="">
				<div class="bfh-selectbox" data-name="fpk_jabatan2" data-value="<?php echo $kar_jbt['jbt_id'];?>" data-filter="true" 
				 style="width:70%; "  >
						<div data-value=""></div>
						<?php
							if($jbt_tampil){
							foreach($jbt_tampil as $data){  
						 ?>
				
						<div data-value="<?php echo $data['jbt_id'];?>"  >
							<b> <?php echo $data['jbt_nm'];?></b>
						</div>
						<?php }}?>    
		
				   </div>		
			    </td>

			  </tr>

	
			  <tr>

			    <td>
					<div >
					<i class="fa fa-check-square-o"></i> Devisi / Unit Kerja *)
					</div>
				</td>

				<td>:</td>


			    <td>
				<div class="bfh-selectbox" data-name="fpk_divisi2" data-value="<?php echo $kar_jbt['div_id'];?>" data-filter="true" 
				 style="width:70%; "  >
						<div data-value=""></div>
						<?php
							if($div_tampil){
							foreach($div_tampil as $data){  
						 ?>
				
						<div data-value="<?php echo $data['div_id'];?>"  >
							 <b><?php echo $data['div_nm'];?></b>
						</div>
						<?php }}?>    
		
				   </div>		
			    </td>

			  </tr>

			  <tr>

			    <td>
					<div >
					<i class="fa fa-check-square-o"></i> Level *)
					</div>
				</td>

				<td>:</td>


			    <td>
				<div class="bfh-selectbox" data-name="fpk_level2" data-value="<?php echo $kar_jbt['lvl_id'];?>" data-filter="true" 
				 style="width:70%; "  >
						<div data-value=""></div>
						<?php
							if($lvl_tampil){
							foreach($lvl_tampil as $data){  
						 ?>
				
						<div data-value="<?php echo $data['lvl_id'];?>"  >
							 <b><?php echo $data['lvl_nm'];?></b>
						</div>
						<?php }}?>    
		
				   </div>		
			    </td>

			  </tr>

			  <tr>

			    <td>
					<div >
					<i class="fa fa-check-square-o"></i> Lokasi *) 
					</div>
				</td>

				<td>:</td>


			    <td >
				<div class="bfh-selectbox" data-name="fpk_ktr2" data-value="<?php echo $kar_jbt['ktr_id'];?>" data-filter="true" 
				 style="width:70%; "  >
						<div data-value=""></div>
						<?php
							if($ktr_tampil){
							foreach($ktr_tampil as $data){  
						 ?>
				
						<div data-value="<?php echo $data['ktr_id'];?>"  >
							 <b><?php echo $data['ktr_nm'];?></b>
						</div>
						<?php }}?>    
		
				   </div>		
			    </td>

			  </tr>
			 

			</tbody>

		      </table>

		      

		    </div>

		  </div>

		</div>


		<!-------------------------------------------------------------------!-->
		<div class="panel panel-default">

		  <div class="panel-heading">

		    <h4 class="panel-title">

		      <a data-toggle="collapse" data-parent="#accordion" 
			  href="#aspek_3<?php //echo $fpk_data_asp['fpk_asp_id']; ?>">
              III. ALASAN / PERTIMBANGAN
		      <div class="pull-right"><i class="fa fa-chevron-down"></i></div></a>

		    </h4>

		  </div>
		   <?php  $in = ""; ?>    
		  <div id="aspek_3<?php //echo $fpk_data_asp['fpk_asp_id']; ?>" 
		    class="panel-collapse collapse <?php echo $in; ?>" >

		    <div class="panel-body">
	      
		      <table class="" border="0" width="100%">


			  <tbody>


			  <tr>
			    <td width="30%">
					<div >
					<i class="fa fa-check-square-o"></i> Alasan / Pertimbangan
					</div>
				</td>

                <td width="3%">:</td>
			    <td width="70%">
					<div style="width:70%" >
			      <textarea name="fpk_alasan" class="form-control"  rows="5" <?php echo $nonaktif;?> ><?php echo $fpk_data_id['fpk_alasan']; ?></textarea>
					</div>
			   </td>
			  </tr>
	
			</tbody>

		      </table>

		      

		    </div>

		  </div>

		</div>
	    <!-------------------------------------------------------------------!-->
		<!-------------------------------------------------------------------!-->
		<div class="panel panel-default">

		  <div class="panel-heading">

		    <h4 class="panel-title">

		      <a data-toggle="collapse" data-parent="#accordion" 
			  href="#aspek_4<?php //echo $fpk_data_asp['fpk_asp_id']; ?>">
              IV. PEMOHON
		      <div class="pull-right"><i class="fa fa-chevron-down"></i></div></a>

		    </h4>

		  </div>
		  <?php  $in = ""; ?>    
		  <div id="aspek_4<?php //echo $fpk_data_asp['fpk_asp_id']; ?>" 
		    class="panel-collapse collapse <?php echo $in; ?>" >

		    <div class="panel-body">
		      <table class="" border="0" width="100%">
				  <tbody>
				     
					  <tr>
						<td width="30%">
							<div >
							<i class="fa fa-check-square-o"></i> Nama
							</div>
						</td>
		
						<td width="3%">:</td>
						<td width="70%">
						  <div> - </div>
					   </td>
					  </tr>
					  <tr>
						<td width="30%">
							<div >
							<i class="fa fa-check-square-o"></i> Jabatan
							</div>
						</td>
		
						<td width="3%">:</td>
						<td width="70%">
						  <div> - </div>
					   </td>
					  </tr>
					  						
					  <tr>
						<td width="30%">
							<div >
							<i class="fa fa-check-square-o"></i> Devisi
							</div>
						</td>
		
						<td width="3%">:</td>
						<td width="70%">
						  <div> - </div>
					   </td>
					  </tr>
				  </tbody>
		      </table>

		    </div>

		  </div>

		</div>
	 <!-------------------------------------------------------------------!-->
	 
		<div class="panel panel-default">

		  <div class="panel-heading">

		    <h4 class="panel-title">

		      <a data-toggle="collapse" data-parent="#accordion" 
			  href="#aspek_5<?php //echo $fpk_data_asp['fpk_asp_id']; ?>">
              V. PENGESEHAN
		      <div class="pull-right"><i class="fa fa-chevron-down"></i></div></a>

		    </h4>

		  </div>
		  <?php $in = "in"; ?>	
		  <div id="aspek_5<?php //echo $fpk_data_asp['fpk_asp_id']; ?>" 
		    class="panel-collapse collapse <?php echo $in; ?>" >

		    <div class="panel-body">
	      
		      <table class="" border="0" width="100%">


			  <tbody>


			  <tr>
			    <td width="30%">
					<div >
					<i class="fa fa-check-square-o"></i> Pemohon <strong><em> *) </em></strong>
					</div>
				</td>

                <td width="3%">:</td>
			    <td width="70%">
					<div class="bfh-selectbox" data-name="fpk_penilai" data-value="" data-filter="true" title="" style="width:70%">
						<div data-value="" ></div>
						<?php
							if($kar_tampil){
							foreach($kar_tampil as $data){  
						 ?>
						<div data-value="<?php echo $data['kar_id'];?>"><b><?php echo $data['kar_nik'];?> - <?php echo $data['kar_nm'];?></b></div>
						<?php }}?>    
					</div>
			   </td>
			  </tr>


			  <tr>
			    <td width="30%">
					<div >
					<i class="fa fa-check-square-o"></i> Menyetujui 1 *)
					</div>
				</td>

                <td width="3%">:</td>
			    <td width="70%">
					<div class="bfh-selectbox" data-name="fpk_mengetahui2" data-value="" data-filter="true" title="" style="width:70%">
						<div data-value="" ></div>
						<?php
							if($kar_tampil){
							foreach($kar_tampil as $data){  
						 ?>
						<div data-value="<?php echo $data['kar_id'];?>"><b><?php echo $data['kar_nik'];?> - <?php echo $data['kar_nm'];?></b></div>
						<?php }}?>    
					</div>
			   </td>
			  </tr>	

			  <tr>
			    <td width="30%">
					<div >
					<i class="fa fa-check-square-o"></i> Menyetujui 2 *)
					</div>
				</td>

                <td width="3%">:</td>
			    <td width="70%">
					<div class="bfh-selectbox" data-name="fpk_mengetahui" data-value="" data-filter="true" title="" style="width:70%">
						<div data-value="" ></div>
						<?php
							if($kar_tampil){
							foreach($kar_tampil as $data){  
						 ?>
						<div data-value="<?php echo $data['kar_id'];?>"><b><?php echo $data['kar_nik'];?> - <?php echo $data['kar_nm'];?></b></div>
						<?php }}?>    
					</div>
			   </td>
			  </tr>	
			  			  			  
			  
			  <tr>
			    <td width="30%">
					<div >
					<i class="fa fa-check-square-o"></i> Mengetahui *)
					</div>
				</td>

                <td width="3%">:</td>
			    <td width="70%">
					<div class="bfh-selectbox" data-name="fpk_menyetujui" data-value="" data-filter="true" title="" style="width:70%">
						<div data-value="" ></div>
						<?php
							if($kar_tampil){
							foreach($kar_tampil as $data){  
						 ?>
						<div data-value="<?php echo $data['kar_id'];?>"><b><?php echo $data['kar_nik'];?> - <?php echo $data['kar_nm'];?></b></div>
						<?php }}?>    
					</div>
			   </td>
			  </tr>	
			  			  
			</tbody>

		      </table>

		      

		    </div>

		  </div>

		</div>
	 <!-------------------------------------------------------------------!-->
	 	 
	 
 </div> <!--panel-group!-->
	      
<!-------------------------------------------------------------------!-->
              


            </div><!-- /.col -->


	  <br>

	  <!-- info row -->

	  

  

          

      </div>
	  <div>
	  <em>
	  <strong style=" color:red">
	  Keterangan : *) Wajib diisi <br />
	  1) Form ini dikirim oleh SDM atau yang berwenang kepada Pemohon.<br>
	  2) Kolom Pemohon, Menyetujui 2 Orang, Mengetahui harus diisi.<br />
	  3) Setelah Pemohon dapat notifikasi baru mengisi form yg sudah disediakan.<br />
	  
	  </strong> 
	  </em>
	  </div>	
      <div class="modal-footer">
        
        <button type="submit" onclick="return confirm(' Apakah Sudah Benar ?...  ')"  name="bsave" class="btn btn-primary"><i class="fa fa-save"></i> Simpan & Kirim</button>

      </div>

      </form>

    </div>

  </div>

</div>



<!--------------------------------------------------------------!-->			

<!--------------------------------------------------------------!-->			      
 


<?php
}
?>


