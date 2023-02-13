<?php require('module/biodata/bio_act.php'); ?>

<!-- Content Header (Page header) -->

    <section class="content-header">

      <h1> <?php echo $title;?> <small></small> </h1>

      <ol class="breadcrumb">

        <li><a href="media.php"><i class="fa fa-dashboard"></i> Dashboard</a></li>

        <li><a href="?p=biodata"> Biodata</a></li>

        <li class="active"><?php echo $title;?></li>

      </ol>

    </section>

    

    <!-- Main content -->

    <section class="content"> 

      

      <!-- Your Page Content Here -->

      <div class="row">

        <!-- left column -->

            <div class="col-md-4">

              <!-- general form elements -->

              <!-- form start -->

              <form class="form-horizontal" action="" method="post">

              <div class="box box-primary">

                <div class="box-header">

                  <h3 class="box-title">KTP <small>(Kartu Tanda Penduduk)</small></h3>

                  	<div class="pull-right box-tools">

                      <button type="submit" name="bupdate" id="bupdate" class="btn btn-primary"><i class="fa fa-save"></i></button>

                      <button type="button" id="edit" class="btn btn-primary"><i class="fa fa-pencil"></i></button>

                    </div>

                </div><!-- /.box-header -->

                  <div class="box-body">

		    

                  <div class="form-group">

                    <label for="ktp_no" class="col-sm-2 control-label">Nomor</label>

                    <div class="col-sm-10">

                      <input type="text" name="ktp_no" value="" class="form-control" id="ktp_no" placeholder="Nomor KTP" required disabled>

                    </div>

                  </div>  

                  <div class="form-group">

                    <label for="ktp_img" class="col-sm-2 control-label">Scan</label>

                    <div class="col-sm-10">

                      <div class="btn btn-default btn-file" id="ktp_file">

			<i class="fa fa-paperclip"></i> Attachment

		      </div>

		      <input type="file" name="ktp_img" id="ktp_img"/>

		      <small class="help-block"><em>Max. 2MB</em></small>

                    </div>

                  </div>

                  <div class="form-group">

                    <label for="ktp_masa" class="col-sm-2 control-label">Masa</label>

                    <div class="col-sm-10">

                      <input type="text" name="ktp_masa" value="" class="form-control" id="ktp_masa" placeholder="Masa KTP" required disabled>

                    </div>

                  </div>

		  <div class="form-group">

		    <label for="ktp_sts" class="col-sm-2 control-label">Hidden</label>

		    <div class="col-sm-10">

		      <input type="radio" name="ktp_sts" value="A" class="flat-red" id="ktp_sts" /> Ya &nbsp;

		      <input type="radio" name="ktp_sts" value="N" class="flat-red" id="ktp_sts" checked /> Tidak &nbsp;

		    </div>

		  </div>

                  

		  

                  </div><!-- /.box-body -->



                  <div class="box-footer">

                    <!-- apa gitu -->

                  </div>

              </div><!-- /.box -->

              </form>

	      

          </div>







          <div class="col-md-4">

           

            <!-- general form elements -->

            <form class="form-horizontal" action="" method="post">

              <div class="box box-success">

                <div class="box-header">

                  <h3 class="box-title">NPWP <small>(Nomor Pokok Wajib Pajak)</small></h3>

                  <!-- tools box -->

                  <div class="pull-right box-tools">

                    <button type="submit" name="bupdate_bio" id="bupdate_bio" class="btn btn-primary"><i class="fa fa-save"></i></button>

                    <button type="button" id="edit_bio" class="btn btn-primary"><i class="fa fa-pencil"></i></button>

                  </div><!-- /. tools -->

                </div><!-- /.box-header -->

                  <div class="box-body">

		    

                    <div class="form-group">

                    <label for="npw_no" class="col-sm-2 control-label">Nomor</label>

                    <div class="col-sm-10">

                      <input type="text" name="npw_no" value="" class="form-control" id="npw_no" placeholder="Nomor NPWP" required disabled>

                    </div>

                  </div>  

                  <div class="form-group">

                    <label for="npw_img" class="col-sm-2 control-label">Scan</label>

                    <div class="col-sm-10">

                      <div class="btn btn-default btn-file" id="npw_file">

			<i class="fa fa-paperclip"></i> Attachment

		      </div>

		      <input type="file" name="npw_img" id="npw_img"/>

		      <small class="help-block"><em>Max. 2MB</em></small>

                    </div>

                  </div>

		  <div class="form-group">

		    <label for="npw_sts" class="col-sm-2 control-label">Hidden</label>

		    <div class="col-sm-10">

		      <input type="radio" name="npw_sts" value="A" class="flat-red" id="npw_sts" /> Ya &nbsp;

		      <input type="radio" name="npw_sts" value="N" class="flat-red" id="npw_sts" checked /> Tidak &nbsp;

		    </div>

		  </div>

                    

                  </div><!-- /.box-body -->



                  <div class="box-footer">

                    <!-- ini juga apa gitu -->

                  </div>

              </div><!-- /.box -->

            </form>





	  </div>

	  <!-- /.col --> 	



          <div class="col-md-4">

	    

            <!-- general form elements -->

            <form class="form-horizontal" action="" method="post">

              <div class="box box-warning">

                <div class="box-header">

                  <h3 class="box-title">Passport</h3>

                  <!-- tools box -->

                  <div class="pull-right box-tools">

                    <button type="submit" name="bupdate_card" id="bupdate_card" class="btn btn-primary"><i class="fa fa-save"></i></button>

                    <button type="button" id="edit_card" class="btn btn-primary"><i class="fa fa-pencil"></i></button>

                  </div><!-- /. tools -->

                </div><!-- /.box-header -->

                  <div class="box-body">

		    

		    <div class="form-group">

                    <label for="psp_no" class="col-sm-2 control-label">Nomor</label>

                    <div class="col-sm-10">

                      <input type="text" name="psp_no" value="" class="form-control" id="psp_no" placeholder="Nomor Passport" required disabled>

                    </div>

                  </div>  

                  <div class="form-group">

                    <label for="psp_img" class="col-sm-2 control-label">Scan</label>

                    <div class="col-sm-10">

                      <div class="btn btn-default btn-file" id="psp_file">

			<i class="fa fa-paperclip"></i> Attachment

		      </div>

		      <input type="file" name="psp_img" id="psp_img"/>

		      <small class="help-block"><em>Max. 2MB</em></small>

                    </div>

                  </div>

                  <div class="form-group">

                    <label for="psp_masa" class="col-sm-2 control-label">Masa</label>

                    <div class="col-sm-10">

                      <input type="text" name="psp_masa" value="" class="form-control" id="psp_masa" placeholder="Masa Passport" required disabled>

                    </div>

                  </div>

		  <div class="form-group">

		    <label for="psp_sts" class="col-sm-2 control-label">Hidden</label>

		    <div class="col-sm-10">

		      <input type="radio" name="psp_sts" value="A" class="flat-red" id="psp_sts" /> Ya &nbsp;

		      <input type="radio" name="psp_sts" value="N" class="flat-red" id="psp_sts" checked /> Tidak &nbsp;

		    </div>

		  </div>

                    

                  </div><!-- /.box-body -->



                  <div class="box-footer">

                    <!-- ini juga apa gitu -->

                  </div>

              </div><!-- /.box -->

            </form>

   

	  </div>

	  <!-- /.col --> 

      </div>

      <!-- /.row --> 

      

      

      

      

      <div class="row">

        <div class="col-md-12">

          

	  <div class="box">

            <div class="box-header">

	      <h3 class="box-title">SIM <small>(Surat Izin Mengemudi)</small></h3>

                  <!-- tools box -->

                  <div class="pull-right box-tools">

                    <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#myModal"><i class="fa fa-plus"></i></button>

                  </div><!-- /. tools -->

            </div>

            <!-- /.box-header -->

            <div class="box-body">

              <table id="tb_karyawan" class="table table-bordered table-striped table-hover">

                <thead>

                  <tr>

		                <th>Jenis</th>

                    <th>Nomor</th>

                    <th>Scan</th>

		                <th>Masa</th>

                    <th>Aksi</th>

                  </tr>

                </thead>

                <tbody>

                <?php

				$sim_tampil_id=$bio->sim_tampil_id($kar_id);

				while($data=mysql_fetch_array($sim_tampil_id)){

				if(!empty($data['sim_img'])){
				  $img="<i class='fa fa-file-picture-o'></i>";
				  $popover="popover";
				}else{
				  $img="-";
				  $popover="";
				}
                                    

				?>

                  <tr>

		                <td><?php echo $data['sim_jns']; ?></td>

                    <td><?php echo $data['sim_no']; ?></td>

                    <td><a style="cursor: pointer" class="name" data-toggle="<?php echo $popover;?>" title="<?php echo $data['sim_img'];?>" data-content="<center><img src='module/biodata/doc_scan/<?php echo $data['sim_img'];?>' class='img-popover' alt='Sim Image' width='222'/>"><?php echo $img;?></a></td>

		                <td><?php echo $tgl->tgl_indo($data['sim_masa']); ?></td>

                    <td>

                    <a href="javascript:;"
                    data-simid="<?php echo $data['sim_id']; ?>"
                    data-simjns="<?php echo $data['sim_jns']; ?>"
                    data-simno="<?php echo $data['sim_no']; ?>"
                    data-simimg="<?php echo $data['sim_img'];?>"
                    data-simmasa="<?php echo $data['sim_masa']; ?>" data-toggle="modal" data-target="#sim_edt" title="Edit Dokumen Pribadi"><span style="cursor:pointer" class="label label-primary"><i class="fa fa-ellipsis-h"></i></span></a>

                    <a href="#delete-confirm" data-toggle="modal" data-data="<?php echo $data['sim_jns'];?>" data-url="?p=dokumen_pribadi&act=hapus&id=<?php echo $data['sim_id'];?>"><span style="cursor:pointer" class="label label-danger"><i class="fa fa-trash"></i></span></a>

                    <?php

                    if(!empty($data['sim_sts'])){

                      if($data['sim_sts']=="A"){

                    ?>

                    <a href="#block-confirm" data-toggle="modal" data-data="<h4>Yakin SIM <strong><?php echo $data['sim_jns'];?></strong> akan di HIDDEN?</h4>" data-url="?p=dokumen_pribadi&act=block&id=<?php echo $data['sim_id'];?>"><span style="cursor:pointer" class="label label-success"><i class="fa fa-check"></i></span></a>

                    <?php 

                    }elseif($data['sim_sts']=="N"){

                    ?>

                    <a href="#block-confirm" data-toggle="modal" data-data="<h4>UNHIDE SIM <strong><?php echo $data['sim_jns'];?></strong></h4>" data-url="?p=dokumen_pribadi&act=unblock&id=<?php echo $data['sim_id'];?>"><span style="cursor:pointer" class="label label-danger"><i class="fa fa-ban"></i></span></a>

                    <?php }}?>

                    </td>

                  </tr>

                <?php }?>  

                </tbody>      

                <tfoot>

                  <tr>

		                <th>Jenis</th>

                    <th>Nomor</th>

                    <th>Scan</th>

		                <th>Masa</th>

                    <th>Aksi</th>

                  </tr>

                </tfoot>

              </table>

            </div>

            <!-- /.box-body --> 

          </div>

          <!-- /.box --> 

	  

        </div>

        <!-- /.col --> 

      </div>

      <!-- /.row --> 

      

      

      

    </section>

    <!-- /.content -->

    

    

<!-- POPUP -->

<!-- Button trigger modal -->





<!-- Modal -->

<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">

  <div class="modal-dialog">

    <div class="modal-content">

      <div class="modal-header bg-primary">

        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>

        <h4 class="modal-title" id="myModalLabel"><i class="fa fa-credit-card"></i> Tambah SIM</h4>

      </div>

      <form class="form-horizontal" action="" method="post" enctype="multipart/form-data">

      <div class="modal-body">

	  <div class="form-group">

	    <label for="sim_jns" class="col-sm-2 control-label">Jenis</label>

	    <div class="col-sm-10">

	      <select class="form-control" name="sim_jns" id="sim_jns" required>

		<option value="" selected> -- Pilih --</option>

		<option value="SIM A"> SIM A</option>

		<option value="SIM B"> SIM B</option>

		<option value="SIM C"> SIM C</option>

	      </select>

	    </div>

	  </div>

          <div class="form-group">

            <label for="sim_no" class="col-sm-2 control-label">Nomor</label>

            <div class="col-sm-10">

              <input type="text" name="sim_no" class="form-control" id="sim_no" placeholder="Nomor" required>

            </div>

          </div>

	  <div class="form-group">

	    <label for="sim_img" class="col-sm-2 control-label">Scan</label>

	    <div class="col-sm-10">

	      <div class="btn btn-default btn-file" id="sim_file">

		<i class="fa fa-paperclip"></i> Attachment

	      </div>

	      <input type="file" name="sim_img" id="sim_img"/>

	      <small class="help-block"><em>Max. 2MB</em></small>

	    </div>

	  </div>

          <div class="form-group">

            <label for="sim_masa" class="col-sm-2 control-label">Masa</label>

            <div class="col-sm-10">

              <input type="text" name="sim_masa" class="form-control" id="sim_masa" placeholder="Masa" required>

            </div>

          </div>

      </div>

      <div class="modal-footer">

        <button type="submit" name="bsave_sim" class="btn btn-primary"><i class="fa fa-save"></i></button>

      </div>

      </form>

    </div>

  </div>

</div>

<!-- Modal Edit Sim -->

<div class="modal fade" id="sim_edt" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">

  <div class="modal-dialog">

    <div class="modal-content">

      <div class="modal-header bg-primary">

        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>

        <h4 class="modal-title" id="myModalLabel"><i class="fa fa-credit-card"></i> Edit SIM</h4>

      </div>

      <form class="form-horizontal" action="" method="post" enctype="multipart/form-data">
      <input type="hidden" name="sim_id" id="sim_id">

      <div class="modal-body">

    <div class="form-group">

      <label for="sim_jns" class="col-sm-2 control-label">Jenis</label>

      <div class="col-sm-10">

        <select class="form-control" name="sim_jns" id="sim_jns" required>

    <option value="" selected> -- Pilih --</option>

    <option value="SIM A"> SIM A</option>

    <option value="SIM B"> SIM B</option>

    <option value="SIM C"> SIM C</option>

        </select>

      </div>

    </div>

          <div class="form-group">

            <label for="sim_no" class="col-sm-2 control-label">Nomor</label>

            <div class="col-sm-10">

              <input type="text" name="sim_no" class="form-control" id="sim_no" placeholder="Nomor" required>

            </div>

          </div>

    <div class="form-group">

      <label for="sim_img_edit" class="col-sm-2 control-label">Scan</label>

      <div class="col-sm-10">

        <img src="dist/img/sample.jpg" id="sim_img_edt" width="200"><br><br>

        <div class="btn btn-default btn-file" id="sim_file_edit">

    <i class="fa fa-paperclip"></i> Attachment

        </div>

        <input type="file" name="sim_img" id="sim_img_edit"/>

        <small class="help-block"><em>Max. 2MB</em></small>

      </div>

    </div>

          <div class="form-group">

            <label for="sim_masa" class="col-sm-2 control-label">Masa</label>

            <div class="col-sm-10">

              <input type="text" name="sim_masa" class="form-control" id="sim_masa" placeholder="Masa" required>

            </div>

          </div>

      </div>

      <div class="modal-footer">

        <button type="submit" name="bupdate_sim" class="btn btn-primary"><i class="fa fa-save"></i></button>

      </div>

      </form>

    </div>

  </div>

</div>