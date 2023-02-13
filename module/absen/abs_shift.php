<?php require('module/absen/abs_act.php'); ?>

<!-- Content Header (Page header) -->

<section class="content-header">

  <h1> <?php echo $title;?> <small></small> </h1>

  <ol class="breadcrumb">

    <li><a href="media.php"><i class="fa fa-dashboard"></i> Dashboard</a></li>

    <li><a href="?p=detail_absen">Data Absen</a></li>

    <li class="active"><?php echo $title;?> </li>

  </ol>

</section>

    

<!-- Main content -->

<section class="content"> 

  

  <!-- Your Page Content Here -->

  <div class="row">

    <div class="col-lg-12">

      <div class="box">

         

       	<div class="row">

          <div class="col-md-12">

             <form class="form-inline" action="" method="post">

                

              <div class="box-header">

                <h3 class="box-title">Absensi Shift Extra Karyawan <small>

                  <?php 

                      echo $tgl->tgl_indo($abs_dtl_tgl);

                  ?>

                </small>

                </h3>

         

                <div class="pull-right box-tools">

				<!--

	                <div class="form-group">

	                  <a href="#"  class="btn btn-md btn-default"><i class="fa fa-print"></i></a>

	                </div>

	                

	                <div class="input-group">

	                  <div class="input-group-addon">

	                    <i class="fa fa-calendar"></i>

	                  </div>

	                  <input type="text" name="tanggal_absen_detail" class="form-control pull-right" placeholder="Sortir Absensi" id="dpdays" readonly />

	                </div>



	                <div class="form-group">

	                  <button type="submit" name="bsortir_detail" class="btn btn-md btn-default"><i class="fa fa-eye"></i> View</a></button>

	                </div>



	                <div class="form-group">

	                  <button type="submit" name="brefresh_detail" data-toggle="tooltip"  class="btn btn-md btn-default" title="Kembali ke default <?php echo $tgl->tgl_indo($date); ?>"><i class="fa fa-refresh"></i></button>

	                </div>

				-->

                </div><!-- /. tools -->

              </div>

              <!-- /.box-header -->



	          <div class="box-body">

	            <table id="example" class="table table-bordered table-striped table-hover">

	              <thead>

	                <tr>

	                  <th>NIK</th>

	                  <th>Nama</th>

	                  <th>Divisi</th>

	                  <th class="info"><span class="label label-primary">Shift Extra</span></th>

	                  <th class="danger"><span class="label label-danger">Disable Pulang</span></th>

	                </tr>

	              </thead>

	              <tbody>

	              	<?php

	                  $kar_tampil=$kar->kar_tampil_uptodate_unit();

	                  if($kar_tampil){

	                  $i=0;

	                  foreach($kar_tampil as $data){

						  

					    if($data['kar_id']==$absensishfdtldtl[$data['kar_id']]["kar_id"]){

							

						 if(($absensishfdtldtl[$data['kar_id']]["kar_default_shift2_in"] <> '') AND $absensishfdtldtl[$data['kar_id']]["kar_default_shift2_out"] <> ''){

	                          $checked="checked";

	                        }else{

	                          $checked="";

	                        }

						 }

						 

						 if($data['kar_disable_pulang'] == "Y"){

							 $disable_checked="checked";

						 }else{

							 $disable_checked="";

						 }

						 

	                  ?>

	                <tr>

	                  <td><?php echo $data['kar_nik']; ?></td>   

	                  <td><?php echo $data['kar_nm']; ?></td>

	                  <td><?php echo $data['div_nm']; ?></td>

	                  <td class="info" width="5">                  

	                    <input type="checkbox" name="shiftextra<?php echo $i;?>" data-karid="<?php echo $data['kar_id'];?>" onclick="check(this)" <?php echo $checked;?> />					

	                  </td> 	

					  <td class="info" width="5">                  

	                    <input type="checkbox" name="disablepulang<?php echo $i;?>" data-karid="<?php echo $data['kar_id'];?>" onclick="disable_check(this)" <?php echo $disable_checked;?> />					

	                  </td>

	                </tr>

					  <?php $i++;}}?>  

	              </tbody>      

	              <tfoot>

	                <tr>

	                  <th>NIK</th>

	                  <th>Nama</th>

	                  <th>Divisi</th>

	                  <th class="info"><span class="label label-primary">Shift Extra</span></th>

	                  <th class="danger"><span class="label label-danger">Disable Pulang</span></th>

	                </tr>

	              </tfoot>

	            </table>



	          </div>

          	</form>



     	  </div>

  		</div>



	  </div><!-- /.box -->

	</div><!-- /.col -->

  </div>  

</section>

<!-- /.content --> 



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



<script>

  function check(e) {

    var shiftextra = $(e).is(':checked') ? 'true' : 'false';

    //var kar_default_shift2_out = $(e).val();

    var kar_id = $(e).data('karid');



    

   console.log(shiftextra);

   

    var loading = $("#loading");

    loading.fadeIn();

    $.post("abs_shift_update.php", {kar_id: kar_id,shiftextra: shiftextra}, function(data){

        if (data != 'success') {

			alert('Gagal Update');

	}

	loading.fadeOut();

    });

	

  }

  

  function disable_check(e) {

    var disablecheck = $(e).is(':checked') ? 'true' : 'false';

    //var kar_default_shift2_out = $(e).val();

    var kar_id = $(e).data('karid');



    

   console.log(disablecheck);

   

    var loading = $("#loading");

    loading.fadeIn();

    $.post("abs_disable_pulang.php", {kar_id: kar_id,disablecheck: disablecheck}, function(data){

        if (data != 'success') {

			alert('Gagal Update');

	}

	loading.fadeOut();

    });

	

  }

</script>







