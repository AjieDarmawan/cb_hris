<?php require('module/penilaian/nla_act.php'); ?>

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

                    <a href="?p=data_penilaian"  class="btn btn-sm btn-default"><i class="fa fa-refresh"></i></a>

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

                    <td><?php echo $check;?> <a href="?p=data_penilaian&id=<?php echo $data['kar_id']; ?>"><?php echo $data['kar_nik']; ?></a></td>

                    <td><a href="?p=data_penilaian&id=<?php echo $data['kar_id']; ?>"><?php echo $data['kar_nm']; ?></a></td>

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
	  
	  <button type="button" onclick="kontrak_ekspor()"  class="btn btn-lg btn-block btn-success"><i class="fa fa-file-excel-o"></i> <strong>Export Data Kontrak</strong></button><br>

          <div class="box box-danger">

            <div class="box-header">

              <h3 class="box-title">Form Penilaian Kerja</h3>

                  <!-- tools box -->

                  <div class="pull-right box-tools">

                    <?php

                  if(!empty($_GET['id'])){ 

                  ?>

		    <a href="?p=report_penilaian&id=<?php echo $kar_id_;?>" style="cursor:pointer" class="btn btn-sm btn-primary"><i class="fa fa-bar-chart"></i> Report Penilaian</a>

		    <button style="cursor:pointer" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#md_fpk"><i class="fa fa-plus"></i></button>

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

                $fpk_tampil_kar=$nla->fpk_tampil_kar($kar_id_);

                while($fpk_data_kar=mysql_fetch_array($fpk_tampil_kar)){ 



                  $kar_id_=$fpk_data_kar['kar_id'];

                  $kar_tampil_id_=$kar->kar_tampil_id($kar_id_);

                  $kar_data_=mysql_fetch_array($kar_tampil_id_);



                if($fpk_data_kar['fpk_keterangan']=="Evaluasi Kontrak"){

                    $label="<span class='label label-warning'>Evaluasi Kontrak</span>";

                }elseif($fpk_data_kar['fpk_keterangan']=="Evaluasi Tetap"){

                    $label="<span class='label label-primary'>Evaluasi Tetap</span>";

                }else{

                    $label="";

                }

		

		if($fpk_data_kar['fpk_sts']=="X"){

                    $label_sts="<span class='label label-warning'>Proses</span>";

                }elseif($fpk_data_kar['fpk_sts']=="Y"){

                    $label_sts="<span class='label label-primary'>Lock</span>";

                }elseif($fpk_data_kar['fpk_sts']=="Z"){

                    $label_sts="<span class='label label-success'>Approved</span>";

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

		      <a href="?p=form_penilaian&act=open&id=<?php echo md5($fpk_data_kar['fpk_kd']); ?>"><span style="cursor:pointer" class="label label-primary"><i class="fa fa-ellipsis-h"></i></span></a>

                      <!--<a href="#delete-fpk" data-toggle="modal" data-data="<h4>Yakin Hapus <strong><?php echo $fpk_data_kar['fpk_keterangan'];?> - <?php echo $kar_data_['kar_nm'];?></strong> ?</h4>" data-url="?p=data_penilaian&id=<?php echo $fpk_data_kar['kar_id'];?>&act=hapus_fpk&no=<?php echo $fpk_data_kar['fpk_id'];?>"><span style="cursor:pointer" class="label label-danger"><i class="fa fa-trash"></i></span></a>-->

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
	  
	  <?php
	  $kar_tampil_detail=$kar->kar_tampil_detail($kar_id_);
	  $kar_data_detail=mysql_fetch_assoc($kar_tampil_detail);
	  if($kar_data_detail['kar_dtl_typ_krj']=="Kontrak"){
	  ?>
	  
	  <div class="box box-success">

            <div class="box-header">

              <h3 class="box-title">History Kontrak Karyawan</h3>

	      <!-- tools box -->

                  <div class="pull-right box-tools">

                  <?php

                  if(!empty($_GET['id'])){ 

                  ?>

		   		 <button style="cursor:pointer" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#md_kontrak"><i class="fa fa-plus"></i></button>

             	 <?php }?>

                    <button class="btn btn-info btn-sm" data-widget='collapse' data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>

                    <button class="btn btn-info btn-sm" data-widget='remove' data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>

                  </div><!-- /. tools -->

	    </div>

            <!-- /.box-header -->

            <div class="box-body">

              

              <table id="tb_kontrak" class="table table-bordered table-striped table-hover">

                <thead>

                  <tr>

                    <th>Kontrak</th>

                    <th>Start</th>

                    <th>End</th>

                    <th>Keterangan</th>

                    <th>Aksi</th>

                  </tr>

                </thead>

                <tbody>

                <?php

                if(!empty($_GET['id'])){  

                $kar_id_=$_GET['id'];      

                $kkn_tampil_kar=$nla->kkn_tampil_kar($kar_id_);

                while($kkn_data_kar=mysql_fetch_array($kkn_tampil_kar)){ 

                $daterange=$kkn_data_kar['kkn_start']." - ".$kkn_data_kar['kkn_end'];
		
		if($kkn_data_kar['kkn_end'] < $date){
		  $bgcolor="danger";
		}else{
		  $bgcolor="";
		}

                ?>

                  <tr class="<?php echo $bgcolor;?>">

                    <td><?php echo $kkn_data_kar['kkn_kontrak']; ?></td>

                    <td><?php echo $tgl->tgl_indo($kkn_data_kar['kkn_start']); ?></td>

                    <td><?php echo $tgl->tgl_indo($kkn_data_kar['kkn_end']); ?></td>

                    <td><?php echo $kkn_data_kar['kkn_keterangan']; ?></td>

                    <td>
                    	<a href="javascript:;"
                      data-kknid="<?php echo $kkn_data_kar['kkn_id']; ?>"
                      data-kknkontrak="<?php echo $kkn_data_kar['kkn_kontrak']; ?>"
                      data-kknrange="<?php echo $daterange; ?>"
                      data-kknstart="<?php echo $kkn_data_kar['kkn_start']; ?>"
                      data-kknend="<?php echo $kkn_data_kar['kkn_end']; ?>"
                      data-kknketerangan="<?php echo $kkn_data_kar['kkn_keterangan']; ?>"
                      data-toggle="modal" data-target="#editkontrak"><span style="cursor:pointer" class="label label-primary"><i class="fa fa-ellipsis-h"></i></span></a>
                      <a href="#block-confirm" data-toggle="modal" data-data="<h4>Yakin Hapus Kontrak <strong><?php echo $kkn_data_kar['kkn_kontrak'];?></strong>?</h4>" data-url="?p=data_penilaian&id=<?php echo $kkn_data_kar['kar_id'];?>&act=hapus_kkn&no=<?php echo $kkn_data_kar['kkn_id'];?>" ><span style="cursor:pointer" class="label label-danger"><i class="fa fa-trash"></i></span></a>
                    </td>

                  </tr>

                  
                  <?php }}?>
             

                </tbody>      

                <tfoot>

                  <tr>

                    <th>Kontrak</th>

                    <th>Start</th>

                    <th>End</th>

                    <th>Keterangan</th>

                    <th>Aksi</th>

                  </tr>

                </tfoot>

              </table>



            </div>

            <!-- /.box-body -->

          </div>

          <!-- /.box -->
	  
	  <?php }?>
	  
	  <!----------------------------------------------------------------------------->
	  
	  <div class="box box-warning">

            <div class="box-header">

              <h3 class="box-title">Rekam Jejak (Prestasi / Pelanggaran)</h3>

	      <!-- tools box -->

                  <div class="pull-right box-tools">

                  <?php

                  if(!empty($_GET['id'])){ 

                  ?>

		    <button style="cursor:pointer" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#md_rekam"><i class="fa fa-plus"></i></button>

                  <?php }?>

                    <button class="btn btn-info btn-sm" data-widget='collapse' data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>

                    <button class="btn btn-info btn-sm" data-widget='remove' data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>

                  </div><!-- /. tools -->

	    </div>

            <!-- /.box-header -->

            <div class="box-body">

              

              <table id="tb_user" class="table table-bordered table-striped table-hover">

                <thead>

                  <tr>

                    <th>Nilai</th>

                    <th>Keterangan</th>

                    <th>Sanksi</th>

                    <th>Tanggal</th>
					
                    <th>Tanggal Berakhir</th>

                    <th>Aksi</th>

                  </tr>

                </thead>

                <tbody>

                <?php

                if(!empty($_GET['id'])){  

                $kar_id_=$_GET['id'];      

                $rkm_tampil_kar=$nla->rkm_tampil_kar($kar_id_);

                while($rkm_data_kar=mysql_fetch_array($rkm_tampil_kar)){ 



                  $kar_id_=$rkm_data_kar['kar_id'];

                  $kar_tampil_id_=$kar->kar_tampil_id($kar_id_);

                  $kar_data_=mysql_fetch_array($kar_tampil_id_);



                if($rkm_data_kar['rkm_nilai']=="Prestasi"){

                    $label="<span class='label label-success'>Prestasi</span>";

                }elseif($rkm_data_kar['rkm_nilai']=="Pelanggaran"){

                    $label="<span class='label label-danger'>Pelanggaran</span>";

                }elseif($rkm_data_kar['rkm_nilai']=="Pemanggilan"){

                    $label="<span class='label label-primary'>Pemanggilan</span>";

                }else{

                    $label="";

                } 

                ?>        

                  <tr>

                    <td><?php echo $label;?></td>
		    
		    <?php if(strlen($rkm_data_kar['rkm_keterangan']) > 50){?>
                    <td><?php echo strip_tags(substr(str_replace('"','',$rkm_data_kar['rkm_keterangan']),0,50)); ?> <span data-toggle="tooltip" title="<?php echo strip_tags(str_replace('"','',$rkm_data_kar['rkm_keterangan'])); ?>" style="cursor:pointer">... <i class="fa fa-external-link"></i></span></td>
		    <?php }else{?>
		    <td><?php echo $rkm_data_kar['rkm_keterangan'];?></td>
		    <?php }?>
		    
		    <?php if(strlen($rkm_data_kar['rkm_sanksi']) > 50){?>
                    <td><?php echo strip_tags(substr(str_replace('"','',$rkm_data_kar['rkm_sanksi']),0,50)); ?> <span data-toggle="tooltip" title="<?php echo strip_tags(str_replace('"','',$rkm_data_kar['rkm_sanksi'])); ?>" style="cursor:pointer">... <i class="fa fa-external-link"></i></span></td>
		    <?php }else{?>
		    <td><?php echo $rkm_data_kar['rkm_sanksi'];?></td>
		    <?php }?>
		    
                    <td><?php echo $tgl->tgl_indo($rkm_data_kar['rkm_tgl']); ?></td>
					
                    <td><?php echo $tgl->tgl_indo($rkm_data_kar['rkm_tgl_akhir']); ?></td>

                    <td>
                      <a href="javascript:;"
                      data-rkmid="<?php echo $rkm_data_kar['rkm_id']; ?>"
                      data-rkmnilai="<?php echo $rkm_data_kar['rkm_nilai']; ?>" 
                      data-rkmketerangan="<?php echo $rkm_data_kar['rkm_keterangan']; ?>"
		      data-rkmsanksi="<?php echo $rkm_data_kar['rkm_sanksi']; ?>"
                      data-rkmpelapor="<?php echo $rkm_data_kar['rkm_pelapor']; ?>"
                      data-rkmtgl="<?php echo $rkm_data_kar['rkm_tgl']; ?>"
                      data-rkmtglakhir="<?php echo $rkm_data_kar['rkm_tgl_akhir']; ?>"
                      data-toggle="modal" data-target="#editrekamjejak"><span style="cursor:pointer" class="label label-primary"><i class="fa fa-ellipsis-h"></i></span></a>
                      <a href="#block-confirm" data-toggle="modal" data-data="<h4>Yakin Hapus Rekam Jejak <strong><?php echo $rkm_data_kar['rkm_nilai'];?></strong></h4>" data-url="?p=data_penilaian&id=<?php echo $rkm_data_kar['kar_id'];?>&act=hapus_rkm&no=<?php echo $rkm_data_kar['rkm_id'];?>" ><span style="cursor:pointer" class="label label-danger"><i class="fa fa-trash"></i></span></a>
                    </td>

                  </tr>

                  

                <?php }}?>  

                </tbody>      

                <tfoot>

                  <tr>

                    <th>Nilai</th>

                    <th>Keterangan</th>

                    <th>Sanksi</th>

                    <th>Tanggal</th>
					
                    <th>Tanggal Berakhir</th>

                    <th>Aksi</th>

                  </tr>

                </tfoot>

              </table>

	  

            </div>

            <!-- /.box-body -->

          </div>

          <!-- /.box -->
	  
	   <button type="button" onclick="window.location.href='?p=rekam_jejak'"  class="btn btn-lg btn-block btn-danger"><i class="fa fa-file-o"></i> <strong>Rekapitulasi Rekam Jejak</strong></button>
	  
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

<div class="modal fade" id="editkontrak" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">

  <div class="modal-dialog">

    <div class="modal-content">

      <div class="modal-header bg-primary">

        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>

        <h4 class="modal-title" id="myModalLabel"><i class="fa fa-file-text"></i> Edit Kontrak Karyawan</h4>

      </div>

      <form class="form-horizontal" action="" method="post">
      <input type="hidden" name="kkn_id" id="kkn_id">
      <div class="modal-body">


          <div class="form-group">

            <label for="kkn_kontrak" class="col-sm-2 control-label">Kontrak</label>

            <div class="col-sm-10">

              <input type="number" name="kkn_kontrak" class="form-control kkn_kontrak" id="kkn_kontrak" placeholder="" style="width:15%" onkeypress="return onlyNumbers(event);" maxlength = "1" min = "1" max = "3" required>

            </div>

          </div>

           <div class="form-group">
            <label for="ip_nm" class="col-sm-2 control-label">Date Range</label>
              <div class="col-sm-10">
                <div class="input-group">
                        <div class="input-group-addon">
                          <i class="fa fa-calendar"></i>
                        </div>
                        <input type="text" name="date_range" class="form-control pull-right history_kontrak_edt" id="kkn_range"/>
                      </div><!-- /.input group -->
              </div>
          </div>



        <div class="form-group">

            <label for="kkn_keterangan" class="col-sm-2 control-label">Keterangan</label>

            <div class="col-sm-10">

              <textarea name="kkn_keterangan" id="kkn_keterangan" class="form-control" rows="3"  placeholder="Keterangan" style="width: 100%; height: 125px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;" required></textarea>

            </div>

          </div>
              

      </div>

      <div class="modal-footer">

        <button type="submit" name="bedit_kontrak" class="btn btn-primary"><i class="fa fa-save"></i></button>

      </div>

      </form>

    </div>

  </div>

</div>


<!-- Modal Edit Rekam Jejak-->

<div class="modal fade" id="editrekamjejak" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">

  <div class="modal-dialog">

    <div class="modal-content">

      <div class="modal-header bg-primary">

        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>

        <h4 class="modal-title" id="myModalLabel"><i class="fa fa-history"></i> Edit Rekam Jejak</h4>

      </div>

      <form class="form-horizontal" action="" method="post">
      <input type="hidden" name="rkm_id" id="rkm_id">
      <div class="modal-body">



          <div class="form-group">

            <label for="rkm_nilai" class="col-sm-2 control-label">Nilai</label>

            <div class="col-sm-10">

                <input type="radio" name="rkm_nilai" value="Prestasi" class="flat-red" id="rkm_nilai_pr" checked/> <span class="label label-success">Prestasi</span> &nbsp;

                <input type="radio" name="rkm_nilai" value="Pelanggaran" class="flat-red" id="rkm_nilai_pe" /> <span class="label label-danger">Pelanggaran</span> &nbsp;
				
				<input type="radio" name="rkm_nilai" value="Pemanggilan" class="flat-red" id="rkm_nilai_pem" /> <span class="label label-primary">Pemanggilan</span> &nbsp;

            </div>   

          </div>



    <div class="form-group">

            <label for="rkm_keterangan" class="col-sm-2 control-label">Keterangan</label>

            <div class="col-sm-10">

              <textarea name="rkm_keterangan" id="rkm_keterangan" class="form-control" rows="3"  placeholder="Keterangan" style="width: 100%; height: 125px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;" required></textarea>

            </div>

          </div>
    
    <div class="form-group">

            <label for="rkm_sanksi" class="col-sm-2 control-label">Sanksi</label>

            <div class="col-sm-10">

              <textarea name="rkm_sanksi" id="rkm_sanksi" class="form-control" rows="3"  placeholder="Sanksi" style="width: 100%; height: 125px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;" required></textarea>

            </div>

          </div>


          <div class="form-group">

            <label for="rkm_pelapor" class="col-sm-2 control-label">Pelapor</label>

            <div class="col-sm-10">

              <input type="text" name="rkm_pelapor" class="form-control" id="rkm_pelapor" placeholder="Pelapor" required>

            </div>

          </div>

          

          <div class="form-group">

            <label for="rkm_tgl" class="col-sm-2 control-label">Tanggal</label>

            <div class="col-sm-10">

              <div class="input-group">

                <div class="input-group-addon">

                  <i class="fa fa-calendar"></i>

                </div>

                <input type="text" name="rkm_tgl" class="rkm_tgl form-control pull-right" id="dpdays2"/>

              </div><!-- /.input group -->

            </div>

          </div>
		  
		  <div class="form-group">

            <label for="rkm_tgl_akhir" class="col-sm-2 control-label">Tanggal Berakhir</label>

            <div class="col-sm-10">

              <div class="input-group">

                <div class="input-group-addon">

                  <i class="fa fa-calendar"></i>

                </div>

                <input type="text" name="rkm_tgl_akhir" class="rkm_tgl_akhir form-control pull-right" id="dpdays2_rkm"/>

              </div><!-- /.input group -->

            </div>

          </div>

          

      </div>

      <div class="modal-footer">

        <button type="submit" name="bedit_rekamjejak" class="btn btn-primary"><i class="fa fa-save"></i></button>

      </div>

      </form>

    </div>

  </div>

</div>



<!-- input Modal Kontrak Karyawan-->

<div class="modal fade" id="md_kontrak" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">

  <div class="modal-dialog">

    <div class="modal-content">

      <div class="modal-header bg-primary">

        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>

        <h4 class="modal-title" id="myModalLabel"><i class="fa fa-file-text"></i> Tambah Kontrak Karyawan</h4>

      </div>

      <form class="form-horizontal" action="" method="post">

      <div class="modal-body">

          <div class="form-group">

            <label for="kkn_kontrak" class="col-sm-2 control-label">Kontrak</label>

            <div class="col-sm-10">
            <?php


                $kar_id_=$_GET['id'];      

                $kkn_tampil_kar_limit=$nla->kkn_tampil_kar_limit($kar_id_);

                $kkn_data_kar=mysql_fetch_array($kkn_tampil_kar_limit); 

                $kkn_cek_data=mysql_num_rows($kkn_tampil_kar_limit);

                if($kkn_cek_data > 0){

                	$jml_kontrak=$kkn_data_kar['kkn_kontrak']+1;

                }else{

                	$jml_kontrak=1;
                }

             ?>

              <input type="number" name="kkn_kontrak" class="form-control" id="kkn_kontrak" placeholder="" style="width:15%" onkeypress="return onlyNumbers(event);" maxlength = "1" min = "<?php echo $jml_kontrak;?>" max = "5" required>

            </div>

          </div>

           <div class="form-group">
            <label for="ip_nm" class="col-sm-2 control-label">Date Range</label>
	            <div class="col-sm-10">
	              <div class="input-group">
	                      <div class="input-group-addon">
	                        <i class="fa fa-calendar"></i>
	                      </div>
	                      <input type="text" name="date_range" class="form-control pull-right" id="history_kontrak"/>
	                    </div><!-- /.input group -->
	            </div>
          </div>



	      <div class="form-group">

            <label for="kkn_keterangan" class="col-sm-2 control-label">Keterangan</label>

            <div class="col-sm-10">

              <textarea name="kkn_keterangan" id="kkn_keterangan" class="form-control" rows="3"  placeholder="Keterangan" style="width: 100%; height: 125px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;" required></textarea>

            </div>

          </div>
              

      </div>

      <div class="modal-footer">

        <button type="submit" name="bsimpan_kontrak" class="btn btn-primary"><i class="fa fa-save"></i></button>

      </div>

      </form>

    </div>

  </div>

</div>



<!-- Modal Rekam Jejak-->

<div class="modal fade" id="md_rekam" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">

  <div class="modal-dialog">

    <div class="modal-content">

      <div class="modal-header bg-primary">

        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>

        <h4 class="modal-title" id="myModalLabel"><i class="fa fa-history"></i> Tambah Rekam Jejak</h4>

      </div>

      <form class="form-horizontal" action="" method="post">

      <div class="modal-body">



          <div class="form-group">

            <label for="rkm_nilai" class="col-sm-2 control-label">Nilai</label>

            <div class="col-sm-10">

                <input type="radio" name="rkm_nilai" value="Prestasi" class="flat-red" id="rkm_nilai" checked/> <span class="label label-success">Prestasi</span> &nbsp;

                <input type="radio" name="rkm_nilai" value="Pelanggaran" class="flat-red" id="rkm_nilai"/> <span class="label label-danger">Pelanggaran</span> &nbsp;
				
				<input type="radio" name="rkm_nilai" value="Pemanggilan" class="flat-red" id="rkm_nilai"/> <span class="label label-primary">Pemanggilan</span> &nbsp;

            </div>   

          </div>



	  <div class="form-group">

            <label for="rkm_keterangan" class="col-sm-2 control-label">Keterangan</label>

            <div class="col-sm-10">

              <textarea name="rkm_keterangan" id="rkm_keterangan" class="form-control" rows="3"  placeholder="Keterangan" style="width: 100%; height: 125px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;" required></textarea>

            </div>

          </div>
	  
	  <div class="form-group">

            <label for="rkm_sanksi" class="col-sm-2 control-label">Sanksi</label>

            <div class="col-sm-10">

              <textarea name="rkm_sanksi" id="rkm_sanksi" class="form-control" rows="3"  placeholder="Sanksi" style="width: 100%; height: 125px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;" required></textarea>

            </div>

          </div>
	  

          <div class="form-group">

            <label for="rkm_pelapor" class="col-sm-2 control-label">Pelapor</label>

            <div class="col-sm-10">

              <input type="text" name="rkm_pelapor" class="form-control" id="rkm_pelapor" placeholder="Pelapor" required>

            </div>

          </div>

          

          <div class="form-group">

            <label for="rkm_tgl" class="col-sm-2 control-label">Tanggal</label>

            <div class="col-sm-10">

              <div class="input-group">

                <div class="input-group-addon">

                  <i class="fa fa-calendar"></i>

                </div>

                <input type="text" name="rkm_tgl" class="form-control pull-right" id="dpdays"/>

              </div><!-- /.input group -->

            </div>

          </div>
		  
		  <div class="form-group">

            <label for="rkm_tgl_akhir" class="col-sm-2 control-label">Tanggal Berakhir</label>

            <div class="col-sm-10">

              <div class="input-group">

                <div class="input-group-addon">

                  <i class="fa fa-calendar"></i>

                </div>

                <input type="text" name="rkm_tgl_akhir" class="form-control pull-right dpdays2_rkm"/>

              </div><!-- /.input group -->

            </div>

          </div>

          

      </div>

      <div class="modal-footer">

        <button type="submit" name="btambah" class="btn btn-primary"><i class="fa fa-save"></i></button>

      </div>

      </form>

    </div>

  </div>

</div>



<!-- Modal FPK-->

<div class="modal fade" id="md_fpk" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">

  <div class="modal-dialog modal-lg">

    <div class="modal-content">

      <div class="modal-header bg-primary">

        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>

        <h4 class="modal-title" id="myModalLabel"><i class="fa fa-bar-chart"></i> Form Penilaian Kerja</h4>

      </div>

      <form class="form-horizontal" action="" method="post">

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

		      <input type="text" name="fpk_tgl" class="form-control" id="fpk_tgl" placeholder="Tanggal Penilaian" data-inputmask="'alias': 'yyyy-mm-dd'" data-mask style="width:182;" required <?php echo $nonaktif;?>>

		    </div>

		  </div>

		</small>

                <center><small>Jl. Raya Bogor Km 47,5 Perum Bumi Sentosa Blok A3 No.3, Nanggewer Cibinong, Jawa Barat 16912.</small></center>

              </h2>

            </div><!-- /.col -->

          </div>

          <!-- info row -->

          <div class="row invoice-info">

          <center><h3><u>FORM PENILAIAN KERJA</u></h3>

          Nomor Surat&nbsp;&nbsp;<b> <?php echo $new_kd;?></b><br/><br/><br/></center>

            <div class="col-sm-6 invoice-col">

              <address>

                <strong><?php echo $kar_data_['kar_nm'];?></strong><br>

                NIK: <?php echo $kar_data_['kar_nik'];?><br>

                Divisi: <?php echo $kar_data_['div_nm'];?> / <?php echo $kar_data_['jbt_nm'];?><br>

                Location: <?php echo $kar_data_['unt_nm'];?> / <?php echo $kar_data_['ktr_nm'];?><br>

              </address>

            </div><!-- /.col -->

            

            <div class="col-sm-6 invoice-col">



		<div class="form-group">

		  <label for="fpk_priode" class="col-sm-6 control-label">Priode Penilaian</label>

		  <div class="col-sm-6">

		    <select class="form-control" name="fpk_priode" id="fpk_priode" style="width:171px;" onchange="eventDitetapkan()" required>

		      <option value="" selected></option>

		      <?php
			////// Penambahan Eva.Keempat dan Eva.Kelima 19-09-2021 konf mas isman //////
			$huruf=array(
					  
				      "Eva.Kedua" => 'Eva.Kedua',

				      "Eva.Ketiga" => 'Eva.Ketiga',
					  
				      "Eva.Keempat" => 'Eva.Keempat',
					  
				      "Eva.Kelima" => 'Eva.Kelima',

				      "Eva.Akhir" => 'Eva.Akhir',
				      
				      "Eva.KPI" => 'Eva.KPI'

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

		<?php

		$fpk_tampil_asp=$nla->fpk_tampil_asp();

                while($fpk_data_asp=mysql_fetch_array($fpk_tampil_asp)){

		  if($fpk_data_asp['fpk_asp_nm']=="Aspek Teknis"){

		    $in="in";

		  }else{

		    $in="";

		  }

		?>  

		<div class="panel panel-default">

		  <div class="panel-heading">

		    <h4 class="panel-title">

		      <a data-toggle="collapse" data-parent="#accordion" href="#aspek<?php echo $fpk_data_asp['fpk_asp_id']; ?>">

		      <?php echo $fpk_data_asp['fpk_asp_nm']; ?>

		      <div class="pull-right"><i class="fa fa-chevron-down"></i></div></a>

		    </h4>

		  </div>

		  <div id="aspek<?php echo $fpk_data_asp['fpk_asp_id']; ?>" class="panel-collapse collapse <?php echo $in; ?>">

		    <div class="panel-body">

		      

		      <table class="table table-striped">

			<tbody>

			  

			  <?php

			  $fpk_asp_id=$fpk_data_asp['fpk_asp_id'];

			  $fpk_tampil_point=$nla->fpk_tampil_point($fpk_asp_id);

			  while($fpk_data_point=mysql_fetch_array($fpk_tampil_point)){

			  ?>  

			  <tr>

			    <td><i class="fa fa-check-square-o"></i></td>

			    <td><?php echo $fpk_data_point['fpk_point_nm']; ?></td>

			    <td>

			      <select class="form-control" name="fpk_huruf<?php echo $fpk_data_point['fpk_point_id'];?>" id="fpk_huruf<?php echo $fpk_data_point['fpk_point_id'];?>" style="width:60px;" <?php echo $nonaktif;?>>

			      <option value="" selected></option>

			      <?php

				$huruf=array(

					      "A" => 'A',

					      "B" => 'B',

					      "C" => 'C',

					      "D" => 'D'

					      );

				foreach($huruf as $value => $caption) {	

			      ?>

			      <option value="<?php echo $value; ?>"><?php echo $caption; ?></option>

			      <?php }?>

			    </select>

			    </td>

			    <td>

			      <select class="form-control" name="fpk_nilai<?php echo $fpk_data_point['fpk_point_id'];?>" id="fpk_nilai<?php echo $fpk_data_point['fpk_point_id'];?>" <?php echo $nonaktif;?>>

				<option value="" selected></option>

			      </select>

			    </td>

			  </tr>

			  <?php }?>

			 

			</tbody>

		      </table>

		      

		    </div>

		  </div>

		</div>

		<?php }?>

	      </div> 

	      

              

            </div><!-- /.col -->

          </div><!-- /.row -->



          <div class="row">

            <!-- accepted payments column -->

            <div class="col-xs-6">

	      <p class="lead">Team Penilai:</p>

              <!--<strong>Penilai</strong>-->



		<div class="bfh-selectbox" data-name="fpk_penilai" data-value="" data-filter="true">

		<div data-value=""></div>

		<?php

		    //$kar_tampil_2=$kar->kar_tampil_2();

		    if($kar_tampil){

		    foreach($kar_tampil as $data){  


		 ?>

		<div data-value="<?php echo $data['kar_id'];?>"><?php echo $data['kar_nik'];?> - <?php echo $data['kar_nm'];?></div>

		<?php }}?>    

	       </div>

		

	      <strong>Mengetahui:</strong>
		
		<div class="bfh-selectbox" data-name="fpk_mengetahui2" data-value="" data-filter="true">

		<div data-value=""></div>

		<?php

		    //$kar_tampil_3=$kar->kar_tampil_3();

		    if($kar_tampil){

		    foreach($kar_tampil as $data){  


		 ?>

		<div data-value="<?php echo $data['kar_id'];?>"><?php echo $data['kar_nik'];?> - <?php echo $data['kar_nm'];?></div>

		<?php }}?>    

	       </div>


		<div class="bfh-selectbox" data-name="fpk_mengetahui" data-value="" data-filter="true">

		<div data-value=""></div>

		<?php

		    //$kar_tampil_3=$kar->kar_tampil_3();

		    if($kar_tampil){

		    foreach($kar_tampil as $data){  


		 ?>

		<div data-value="<?php echo $data['kar_id'];?>"><?php echo $data['kar_nik'];?> - <?php echo $data['kar_nm'];?></div>

		<?php }}?>    

	       </div>
		   
		   <div class="bfh-selectbox" data-name="fpk_mengetahui3" data-value="" data-filter="true">

		<div data-value=""></div>

		<?php

		    //$kar_tampil_3=$kar->kar_tampil_3();

		    if($kar_tampil_drt){

		    foreach($kar_tampil_drt as $data){  


		 ?>

		<div data-value="<?php echo $data['kar_id'];?>"><?php echo $data['kar_nik'];?> - <?php echo $data['kar_nm'];?></div>

		<?php }}?>    

	       </div>

	      

            </div><!-- /.col -->

            <div class="col-xs-6">

              <p class="lead">Ditetapkan: <em><small><strong>(Hanya Karyawan Kontrak)</strong></small></em></p>

              <div class="table-responsive" id="ditetapkan1">

	      

		      <?php

			$huruf=array(

				      "Untuk Tidak Diperpanjang" => 'Untuk Tidak Diperpanjang',

				      "Diperpanjang 6 Bulan" => 'Diperpanjang 6 Bulan',

				      "Diperpanjang 1 Tahun" => 'Diperpanjang 1 Tahun',

				      "Karyawan Tetap" => 'Karyawan Tetap'

				      );

			foreach($huruf as $value => $caption) {	

		      ?>

		      <input type="radio" name="fpk_ditetapkan" value="<?php echo $value;?>" class="flat-red" id="fpk_ditetapkan" <?php echo $nonaktif;?> /> <?php echo $caption;?><br>

		      <?php }?>  



              </div>
	      
	      <div class="table-responsive" id="ditetapkan2">

	      

		      <?php

			$huruf=array(

				      "Untuk Tidak Diperpanjang" => 'Untuk Tidak Diperpanjang',

				      "Karyawan Tetap" => 'Karyawan Tetap'

				      );

			foreach($huruf as $value => $caption) {	

		      ?>

		      <input type="radio" name="fpk_ditetapkan" value="<?php echo $value;?>" class="flat-red" id="fpk_ditetapkan" <?php echo $nonaktif;?> /> <?php echo $caption;?><br>

		      <?php }?>  



              </div>

            </div><!-- /.col -->

          </div><!-- /.row -->

	  <br>

	  <!-- info row -->

          <div class="row invoice-info">

            <div class="col-sm-4 invoice-col">

              <i class="fa fa-check-square-o"></i> Prestasi

	      <textarea name="fpk_prestasi" class="form-control" <?php echo $nonaktif;?>></textarea>

              

            </div><!-- /.col -->

            <div class="col-sm-4 invoice-col">

              <i class="fa fa-check-square-o"></i> Pelanggaran

	      <textarea name="fpk_pelanggaran" class="form-control" <?php echo $nonaktif;?>></textarea>

              

            </div><!-- /.col -->

            <div class="col-sm-4 invoice-col">

              <i class="fa fa-check-square-o"></i> Saran

	      <textarea name="fpk_saranperbaikan" class="form-control" <?php echo $nonaktif;?>></textarea>

	      

            </div><!-- /.col -->

          </div><!-- /.row -->

	  

          <!-- this row will not appear when printing -->

	  

	  <!--

          <div class="row no-print">

            <div class="col-xs-12">

              <a href="invoice-print.html" target="_blank" class="btn btn-default"><i class="fa fa-print"></i> Print</a>

              <button class="btn btn-success pull-right"><i class="fa fa-credit-card"></i> Submit Payment</button>

              <button class="btn btn-primary pull-right" style="margin-right: 5px;"><i class="fa fa-download"></i> Generate PDF</button>

            </div>

          </div>-->

	  

        </section><!-- /.content -->

          

      </div>

      <div class="modal-footer">

        <button type="submit" name="bsave" class="btn btn-primary"><i class="fa fa-save"></i> Simpan & Kirim</button>

      </div>

      </form>

    </div>

  </div>

</div>
<?php
}
?>
