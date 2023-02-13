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

          <div class="col-md-2">
                <div class="box-header with-border">
                  <h3 class="box-title">Information</h3>
                </div>
                <div class="box-body no-padding">
                  <ul class="nav nav-pills nav-stacked">
                    <li><a href="#"><span class="label label-primary">H</span> Hadir</a></li>
                    <li><a href="#"><span class="label label-warning">I</span> Izin</a></li>
                    <li><a href="#"><span class="label label-success">S</span> Sakit</a></li>
                    <li><a href="#"><span class="label label-danger">A</span> Alpa</a></li>
                    <li><a href="#"><span class="label label-danger">L</span> Libur</a></li>
                    <li><a href="#"><span class="label label-danger">C</span> Cuti</a></li>
                  </ul>
                </div>
          </div>

          <div class="col-md-10">
             <form class="form-inline" action="" method="post">
                
              <div class="box-header">
                <h3 class="box-title">Absensi Karyawan <small>
                  <?php 
                      echo $tgl->tgl_indo($abs_dtl_tgl);
                  ?>
                </small>
                </h3>
         
                <div class="pull-right box-tools">

	                <!--<div class="form-group">
	                <button type="submit" name="bsave" id="bsave" class="btn btn-primary btn-md" data-toggle="tooltip" title="Save"><i class="fa fa-save"></i></button>
	                </div>-->

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
	                  <th class="info"><span class="label label-primary">H</span></th>
	                  <th class="warning"><span class="label label-warning">I</span></th>
	                  <th class="success"><span class="label label-success">S</span></th>
	                  <th class="danger"><span class="label label-danger">A</span></th>
	                  <th class="danger"><span class="label label-danger">L</span></th>
	                  <th class="danger"><span class="label label-danger">C</span></th>
	                </tr>
	              </thead>
	              <tbody>
	              	<?php
	                  $kar_tampil=$kar->kar_tampil_uptodate();
	                  if($kar_tampil){
	                  $i=0;
	                  foreach($kar_tampil as $data){
	                      $kar_id_=$data['kar_id'];
	                      /*$abs_dtl_tampil=$abs->abs_dtl_tampil($kar_id_,$abs_dtl_tgl);
	                      $abs_dtl_data=mysql_fetch_array($abs_dtl_tampil);*/

	                      if($data['kar_id']==$absensidtl[$data['kar_id']]["kar_id"]){

	                        if($absensidtl[$data['kar_id']]["abs_dtl_sts"]=="H"){
	                          $check_hadir="checked";
	                        }else{
	                          $check_hadir="";
	                        }

	                        if($absensidtl[$data['kar_id']]["abs_dtl_sts"]=="I"){
	                          $check_izin="checked";
	                        }else{
	                          $check_izin="";
	                        }

	                        if($absensidtl[$data['kar_id']]["abs_dtl_sts"]=="S"){
	                          $check_sakit="checked";
	                        }else{
	                          $check_sakit="";
	                        }

	                        if($absensidtl[$data['kar_id']]["abs_dtl_sts"]=="A"){
	                          $check_alpa="checked";
	                        }else{
	                          $check_alpa="";
	                        }

	                        if($absensidtl[$data['kar_id']]["abs_dtl_sts"]=="L"){
	                          $check_libur="checked";
	                        }else{
				  $jwd_tampil_now=$jwd->jwd_tampil_now($abs_dtl_tgl,$kar_id_,$kemarin);
				  $jwd_jml_data=mysql_num_rows($jwd_tampil_now);
				  $jwd_tampil_data=mysql_fetch_array($jwd_tampil_now);
				  
				  if($jwd_jml_data > 0){
				    if($jwd_tampil_data['jwd_nm']=="Libur"){
				      $check_libur="checked";
				    }else{
				      $check_libur="";
				    }
				  }else{
				    $check_libur="";
				  }
	                        }

	                        if($absensidtl[$data['kar_id']]["abs_dtl_sts"]=="C"){
	                          $check_cuti="checked";
	                        }else{
				  $jwd_tampil_now=$jwd->jwd_tampil_now($abs_dtl_tgl,$kar_id_,$kemarin);
				  $jwd_jml_data=mysql_num_rows($jwd_tampil_now);
				  $jwd_tampil_data=mysql_fetch_array($jwd_tampil_now);
				  
				  if($jwd_jml_data > 0){
				    if($jwd_tampil_data['jwd_nm']=="Cuti"){
				      $check_cuti="checked";
				    }else{
				      $check_cuti="";
				    }
				  }else{
				    $check_cuti="";
				  }
	                        }
	                        
	                      }else{
	                        $jwd_tampil_now=$jwd->jwd_tampil_now($abs_dtl_tgl,$kar_id_,$kemarin);
	                        $jwd_tampil_data=mysql_fetch_array($jwd_tampil_now);

	                        if($jwd_tampil_data['jwd_nm']=="Libur"){
	                          $check_libur="checked";
	                        }else{
	                          $check_libur="";
	                        }

	                        if($jwd_tampil_data['jwd_nm']=="Cuti"){
	                          $check_cuti="checked";
	                        }else{
	                          $check_cuti="";
	                        }

	                        $check_alpa="checked";
	                      }
	                  ?>
	                <tr>
	                  <td><?php echo $data['kar_nik']; ?></td>
	                  <td><?php echo $data['kar_nm']; ?></td>
	                  <td><?php echo $data['div_nm']; ?></td>
	                  <td class="info">
	                    <input type="hidden" value="<?php echo $data['kar_id'];?>" name="kar_id[<?php echo $i;?>]">
	                    <input type="radio" value="H" name="abs_dtl_sts<?php echo $i;?>" data-karid="<?php echo $data['kar_id'];?>" onclick="check(this)" <?php echo $check_hadir;?> />
	                  </td>
	                  <td class="warning">
	                    <input type="radio" value="I" name="abs_dtl_sts<?php echo $i;?>" data-karid="<?php echo $data['kar_id'];?>" onclick="check(this)" <?php echo $check_izin;?> />
	                  </td>
	                  <td class="success">
	                    <input type="radio" value="S" name="abs_dtl_sts<?php echo $i;?>" data-karid="<?php echo $data['kar_id'];?>" onclick="check(this)" <?php echo $check_sakit;?> />
	                  </td>
	                  <td class="danger">
	                    <input type="radio" value="A" name="abs_dtl_sts<?php echo $i;?>" data-karid="<?php echo $data['kar_id'];?>" onclick="check(this)" <?php echo $check_alpa;?> />
	                  </td>
	                  <td class="danger">
	                    <input type="radio" value="L" name="abs_dtl_sts<?php echo $i;?>" data-karid="<?php echo $data['kar_id'];?>" onclick="check(this)" <?php echo $check_libur;?> />
	                  </td>
	                  <td class="danger">
	                    <input type="radio" value="C" name="abs_dtl_sts<?php echo $i;?>" data-karid="<?php echo $data['kar_id'];?>" onclick="check(this)" <?php echo $check_cuti;?> />
	                  </td>                        
	                </tr>
	              <?php $i++;}}?>  
	              </tbody>      
	              <tfoot>
	                <tr>
	                  <th>NIK</th>
	                  <th>Nama</th>
	                  <th>Divisi</th>
	                  <th class="info"><span class="label label-primary">H</span></th>
				      <th class="warning"><span class="label label-warning">I</span></th>
				      <th class="success"><span class="label label-success">S</span></th>
				      <th class="danger"><span class="label label-danger">A</span></th>
				      <th class="danger"><span class="label label-danger">L</span></th>
				      <th class="danger"><span class="label label-danger">C</span></th>
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


<!-- ==========================DATA KOMULATIF=========================== -->


  <!-- Small boxes 1 (Stat box) -->
  	<div class="row">

    	<div class="col-lg-2 col-xs-4">
	      <!-- small box -->
	      <div class="small-box bg-aqua">
	        <div class="inner">
	        <?php
		        $abs_dtl_sts="H";
		        $abs_dtl_tampil_sts=$abs->abs_dtl_tampil_sts($abs_dtl_sts,$abs_dtl_tgl);
		        $abs_dtl_cek=mysql_num_rows($abs_dtl_tampil_sts);
		        if($abs_dtl_cek > 0){
		            $modal="modal";
		        }else{
		            $modal="";
		        }
	        ?>
	          <h3><?php echo $abs_dtl_cek;?></h3> 
	          <p>Hadir</p>
	        </div>
	        <div class="icon">
	          	<i class="fa fa-users"></i>
	        </div>
		        <a style="cursor:pointer;" data-toggle="<?php echo $modal;?>" data-target="#hadir_modal" class="small-box-footer">
		          View <i class="fa fa-arrow-circle-right"></i>
		        </a>
	      </div>
	    </div><!-- ./col -->

	    <div class="col-lg-2 col-xs-4">
	      <!-- small box -->
	      <div class="small-box bg-green">
	        <div class="inner">
	          <?php
		          $abs_dtl_sts="S";
				  $abs_dtl_tampil_sts=$abs->abs_dtl_tampil_sts($abs_dtl_sts,$abs_dtl_tgl);
		          $abs_dtl_cek=mysql_num_rows($abs_dtl_tampil_sts);
		          if($abs_dtl_cek > 0){
		            $modal="modal";
		          }else{
		            $modal="";
		          }
	          ?>
	          <h3><?php echo $abs_dtl_cek;?></h3>
	          <p>Sakit</p>
	        </div>
	        <div class="icon">
	          	<i class="fa fa-bed"></i>
	        </div>
		        <a style="cursor:pointer;" data-toggle="<?php echo $modal;?>" data-target="#sakit_modal" class="small-box-footer">
		          View <i class="fa fa-arrow-circle-right"></i>
		        </a>
	      	</div>
	    </div><!-- ./col -->

	    <div class="col-lg-2 col-xs-4">
	      <!-- small box -->
	      <div class="small-box bg-yellow">
	        <div class="inner">
	          <?php
		          $abs_dtl_sts="I";
				  $abs_dtl_tampil_sts=$abs->abs_dtl_tampil_sts($abs_dtl_sts,$abs_dtl_tgl);
		          $abs_dtl_cek=mysql_num_rows($abs_dtl_tampil_sts);
		          if($abs_dtl_cek > 0){
		            $modal="modal";
		          }else{
		            $modal="";
		          }
	          ?>
	          <h3><?php echo $abs_dtl_cek;?></h3>
	          <p>Izin</p>
	        </div>
	        <div class="icon">
	          	<i class="fa fa-street-view"></i>
	        </div>
		        <a style="cursor:pointer;" data-toggle="<?php echo $modal;?>" data-target="#izin_modal" class="small-box-footer">
		          View <i class="fa fa-arrow-circle-right"></i>
		        </a>
		    </div>
	    </div><!-- ./col -->

	    <div class="col-lg-2 col-xs-4">
	      <!-- small box -->
	      <div class="small-box bg-red">
	        <div class="inner">
	          <?php
		          $abs_dtl_sts="A";
				  $abs_dtl_tampil_sts=$abs->abs_dtl_tampil_sts($abs_dtl_sts,$abs_dtl_tgl);
		          $abs_dtl_cek=mysql_num_rows($abs_dtl_tampil_sts);
		          if($abs_dtl_cek > 0){
		            $modal="modal";
		          }else{
		            $modal="";
		          }
	          ?>
	          <h3><?php echo $abs_dtl_cek;?></h3>
	          <p>Alpa</p>
	        </div>
	        <div class="icon">
	          	<i class="fa fa-user-secret"></i>
	        </div>
		        <a style="cursor:pointer;" data-toggle="<?php echo $modal;?>" data-target="#alpa_modal" class="small-box-footer">
		          View <i class="fa fa-arrow-circle-right"></i>
		        </a>
		    </div>
	    </div><!-- ./col -->

	    <div class="col-lg-2 col-xs-4">
	      <!-- small box -->
	      <div class="small-box bg-red">
	        <div class="inner">
	          <?php
		          $abs_dtl_sts="L";
				  $abs_dtl_tampil_sts=$abs->abs_dtl_tampil_sts($abs_dtl_sts,$abs_dtl_tgl);
		          $abs_dtl_cek=mysql_num_rows($abs_dtl_tampil_sts);
		          if($abs_dtl_cek > 0){
		            $modal="modal";
		          }else{
		            $modal="";
		          }
	          ?>
	          <h3><?php echo $abs_dtl_cek;?></h3>
	          <p>Libur</p>
	        </div>
	        <div class="icon">
	          	<i class="fa fa-child"></i>
	        </div>
		        <a style="cursor:pointer;" data-toggle="<?php echo $modal;?>" data-target="#libur_modal" class="small-box-footer">
		          View <i class="fa fa-arrow-circle-right"></i>
		        </a>
	     	</div>
	    </div><!-- ./col -->

	    <div class="col-lg-2 col-xs-4">
	      <!-- small box -->
	      <div class="small-box bg-red">
	        <div class="inner">
	          <?php
		          $abs_dtl_sts="C";
				  $abs_dtl_tampil_sts=$abs->abs_dtl_tampil_sts($abs_dtl_sts,$abs_dtl_tgl);
		          $abs_dtl_cek=mysql_num_rows($abs_dtl_tampil_sts);
		          if($abs_dtl_cek > 0){
		            $modal="modal";
		          }else{
		            $modal="";
		          }
	          ?>
	          <h3><?php echo $abs_dtl_cek;?></h3>
	          <p>Cuti</p>
	        </div>
	        <div class="icon">
	          	<i class="fa fa-suitcase"></i>
	        </div>
		        <a style="cursor:pointer;" data-toggle="<?php echo $modal;?>" data-target="#cuti_modal" class="small-box-footer">
		          View <i class="fa fa-arrow-circle-right"></i>
		        </a>
	      	</div>
	    </div><!-- ./col --> 

	</div>

</section>
<!-- /.content --> 

<!-- ============================MODAL========================= --> 

<!-- Modal Hadir -->
<div class="modal fade" id="hadir_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header bg-aqua">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel"><i class="fa fa-users"></i> Hadir</h4>
      </div>
      <form class="form-horizontal" action="" method="post">
      <div class="modal-body" id="hadir_overflow">
        <table class="table table-bordered table-striped table-hover">
          <thead>
            <tr>
              <th>NIK</th>
              <th>Nama</th>
              <th>Divisi</th>
            </tr>
          </thead>
          <tbody>
          <?php
          $abs_dtl_sts="H";
		  $abs_dtl_tampil_sts=$abs->abs_dtl_tampil_sts($abs_dtl_sts,$abs_dtl_tgl);
          while($abs_dtl_data=mysql_fetch_array($abs_dtl_tampil_sts)){

            $kar_id_=$abs_dtl_data['kar_id'];
            $kar_tampil_id_=$kar->kar_tampil_id($kar_id_);
            $kar_data_=mysql_fetch_array($kar_tampil_id_);
          ?>
            <tr>
              <td><?php echo $kar_data_['kar_nik']; ?></td>
              <td><?php echo $kar_data_['kar_nm']; ?></td>
              <td><?php echo $kar_data_['div_nm']; ?></td>                     
            </tr>
          <?php }?>  
          </tbody>      
          <tfoot>
            <tr>
              <th>NIK</th>
              <th>Nama</th>
              <th>Divisi</th>
            </tr>
          </tfoot>
        </table>
      </div>
      <div class="modal-footer">
       
      </div>
      </form>
    </div>
  </div>
</div>

<!-- Modal Sakit -->
<div class="modal fade" id="sakit_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header bg-green">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel"><i class="fa fa-bed"></i> Sakit</h4>
      </div>
      <form class="form-horizontal" action="" method="post">
      <div class="modal-body" id="sakit_overflow">
        <table class="table table-bordered table-striped table-hover">
          <thead>
            <tr>
              <th>NIK</th>
              <th>Nama</th>
              <th>Divisi</th>
            </tr>
          </thead>
          <tbody>
          <?php
          $abs_dtl_sts="S";
		  $abs_dtl_tampil_sts=$abs->abs_dtl_tampil_sts($abs_dtl_sts,$abs_dtl_tgl);
          while($abs_dtl_data=mysql_fetch_array($abs_dtl_tampil_sts)){

            $kar_id_=$abs_dtl_data['kar_id'];
            $kar_tampil_id_=$kar->kar_tampil_id($kar_id_);
            $kar_data_=mysql_fetch_array($kar_tampil_id_);
          ?>
            <tr>
              <td><?php echo $kar_data_['kar_nik']; ?></td>
              <td><?php echo $kar_data_['kar_nm']; ?></td>
              <td><?php echo $kar_data_['div_nm']; ?></td>                     
            </tr>
          <?php }?>    
          </tbody>      
          <tfoot>
            <tr>
              <th>NIK</th>
              <th>Nama</th>
              <th>Divisi</th>
            </tr>
          </tfoot>
        </table>
      </div>
      <div class="modal-footer">
       
      </div>
      </form>
    </div>
  </div>
</div>

<!-- Modal Izin -->
<div class="modal fade" id="izin_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header bg-yellow">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel"><i class="fa fa-street-view"></i> Izin</h4>
      </div>
      <form class="form-horizontal" action="" method="post">
      <div class="modal-body" id="izin_overflow">
        <table class="table table-bordered table-striped table-hover">
          <thead>
            <tr>
              <th>NIK</th>
              <th>Nama</th>
              <th>Divisi</th>
            </tr>
          </thead>
          <tbody>
          <?php
          $abs_dtl_sts="I";
		  $abs_dtl_tampil_sts=$abs->abs_dtl_tampil_sts($abs_dtl_sts,$abs_dtl_tgl);
          while($abs_dtl_data=mysql_fetch_array($abs_dtl_tampil_sts)){

            $kar_id_=$abs_dtl_data['kar_id'];
            $kar_tampil_id_=$kar->kar_tampil_id($kar_id_);
            $kar_data_=mysql_fetch_array($kar_tampil_id_);
          ?>
            <tr>
              <td><?php echo $kar_data_['kar_nik']; ?></td>
              <td><?php echo $kar_data_['kar_nm']; ?></td>
              <td><?php echo $kar_data_['div_nm']; ?></td>                     
            </tr>
          <?php }?>   
          </tbody>      
          <tfoot>
            <tr>
              <th>NIK</th>
              <th>Nama</th>
              <th>Divisi</th>
            </tr>
          </tfoot>
        </table>
      </div>
      <div class="modal-footer">
       
      </div>
      </form>
    </div>
  </div>
</div>

<!-- Modal Alpa -->
<div class="modal fade" id="alpa_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header bg-red">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel"><i class="fa fa-user-secret"></i> Alpa</h4>
      </div>
      <form class="form-horizontal" action="" method="post">
      <div class="modal-body" id="alpa_overflow">
        <table class="table table-bordered table-striped table-hover">
          <thead>
            <tr>
              <th>NIK</th>
              <th>Nama</th>
              <th>Divisi</th>
            </tr>
          </thead>
          <tbody>
          <?php
          $abs_dtl_sts="A";
		  $abs_dtl_tampil_sts=$abs->abs_dtl_tampil_sts($abs_dtl_sts,$abs_dtl_tgl);
          while($abs_dtl_data=mysql_fetch_array($abs_dtl_tampil_sts)){

            $kar_id_=$abs_dtl_data['kar_id'];
            $kar_tampil_id_=$kar->kar_tampil_id($kar_id_);
            $kar_data_=mysql_fetch_array($kar_tampil_id_);
          ?>
            <tr>
              <td><?php echo $kar_data_['kar_nik']; ?></td>
              <td><?php echo $kar_data_['kar_nm']; ?></td>
              <td><?php echo $kar_data_['div_nm']; ?></td>                     
            </tr>
          <?php }?>   
          </tbody>      
          <tfoot>
            <tr>
              <th>NIK</th>
              <th>Nama</th>
              <th>Divisi</th>
            </tr>
          </tfoot>
        </table>
      </div>
      <div class="modal-footer">
       
      </div>
      </form>
    </div>
  </div>
</div>

<!-- Modal Libur -->
<div class="modal fade" id="libur_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header bg-red">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel"><i class="fa fa-child"></i> Libur</h4>
      </div>
      <form class="form-horizontal" action="" method="post">
      <div class="modal-body" id="libur_overflow">
        <table class="table table-bordered table-striped table-hover">
          <thead>
            <tr>
              <th>NIK</th>
              <th>Nama</th>
              <th>Divisi</th>
            </tr>
          </thead>
          <tbody>
          <?php
          $abs_dtl_sts="L";
		  $abs_dtl_tampil_sts=$abs->abs_dtl_tampil_sts($abs_dtl_sts,$abs_dtl_tgl);
          while($abs_dtl_data=mysql_fetch_array($abs_dtl_tampil_sts)){

            $kar_id_=$abs_dtl_data['kar_id'];
            $kar_tampil_id_=$kar->kar_tampil_id($kar_id_);
            $kar_data_=mysql_fetch_array($kar_tampil_id_);
          ?>
            <tr>
              <td><?php echo $kar_data_['kar_nik']; ?></td>
              <td><?php echo $kar_data_['kar_nm']; ?></td>
              <td><?php echo $kar_data_['div_nm']; ?></td>                     
            </tr>
          <?php }?>  
          </tbody>      
          <tfoot>
            <tr>
              <th>NIK</th>
              <th>Nama</th>
              <th>Divisi</th>
            </tr>
          </tfoot>
        </table>
      </div>
      <div class="modal-footer">
       
      </div>
      </form>
    </div>
  </div>
</div>

<!-- Modal Cuti -->
<div class="modal fade" id="cuti_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header bg-red">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel"><i class="fa fa-suitcase"></i> Cuti</h4>
      </div>
      <form class="form-horizontal" action="" method="post">
      <div class="modal-body" id="cuti_overflow">
        <table class="table table-bordered table-striped table-hover">
          <thead>
            <tr>
              <th>NIK</th>
              <th>Nama</th>
              <th>Divisi</th>
            </tr>
          </thead>
          <tbody>
          <?php
          $abs_dtl_sts="C";
		  $abs_dtl_tampil_sts=$abs->abs_dtl_tampil_sts($abs_dtl_sts,$abs_dtl_tgl);
          while($abs_dtl_data=mysql_fetch_array($abs_dtl_tampil_sts)){

            $kar_id_=$abs_dtl_data['kar_id'];
            $kar_tampil_id_=$kar->kar_tampil_id($kar_id_);
            $kar_data_=mysql_fetch_array($kar_tampil_id_);
          ?>
            <tr>
              <td><?php echo $kar_data_['kar_nik']; ?></td>
              <td><?php echo $kar_data_['kar_nm']; ?></td>
              <td><?php echo $kar_data_['div_nm']; ?></td>                     
            </tr>
          <?php }?>   
          </tbody>      
          <tfoot>
            <tr>
              <th>NIK</th>
              <th>Nama</th>
              <th>Divisi</th>
            </tr>
          </tfoot>
        </table>
      </div>
      <div class="modal-footer">
       
      </div>
      </form>
    </div>
  </div>
</div>

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
    var abs_dtl_sts = $(e).val();
    var kar_id = $(e).data('karid');
    var abs_dtl_tgl = '<?php echo $abs_dtl_tgl;?>';
    
    //console.log($(e).data('karid'));
    var loading = $("#loading");
    loading.fadeIn();
    $.post("abs_detail_update.php", {kar_id: kar_id,abs_dtl_sts: abs_dtl_sts,abs_dtl_tgl: abs_dtl_tgl}, function(data){
        if (data != 'success') {
	  alert('Gagal Update');
	}
	loading.fadeOut();
    });
  }
</script>


