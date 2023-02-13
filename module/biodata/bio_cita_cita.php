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

        <div class="col-xs-12">

          <div class="box">

            <div class="box-header">

              <h3 class="box-title"><span style="cursor:pointer" class="label label-primary" data-toggle="modal" data-target="#myModal"><i class="fa fa-plus"></i></span></h3>

            </div>

            <!-- /.box-header -->

            <div class="box-body">

              <table id="tb_karyawan" class="table table-bordered table-striped table-hover">

                <thead>

                  <tr>

                    <th>Cita - Cita </th>

                    <th>Tahun</th>

                    <th>Aksi</th>

                  </tr>

                </thead>

                <tbody>

                <?php

				$cta_tampil_id=$bio->cta_tampil_id($kar_id);

				while($data=mysql_fetch_array($cta_tampil_id)){

                                    

				?>

                  <tr>

                    <td><?php echo $data['cta_nm']; ?></td>

                    <td><?php echo $data['cta_thn']; ?></td>

                    <td>

                    <a href="javascript:;"
                    data-ctaid="<?php echo $data['cta_id']; ?>"
                    data-ctanm="<?php echo $data['cta_nm']; ?>"
                    data-ctathn="<?php echo $data['cta_thn']; ?>" data-toggle="modal" data-target="#cta_edt" title="Edit Cita - Cita"><span style="cursor:pointer" class="label label-primary"><i class="fa fa-ellipsis-h"></i></span></a>

                    <a href="#delete-confirm" data-toggle="modal" data-data="<?php echo $data['cta_nm'];?>" data-url="?p=cita_-_cita&act=hapus&id=<?php echo $data['cta_id'];?>"><span style="cursor:pointer" class="label label-danger"><i class="fa fa-trash"></i></span></a>

                    <?php

                    if(!empty($data['cta_sts'])){

                      if($data['cta_sts']=="A"){

                    ?>

                    <a href="#block-confirm" data-toggle="modal" data-data="<h4>Yakin Cita - Cita <strong><?php echo $data['cta_nm'];?></strong> akan di HIDDEN?</h4>" data-url="?p=cita_-_cita&act=block&id=<?php echo $data['cta_id'];?>"><span style="cursor:pointer" class="label label-success"><i class="fa fa-check"></i></span></a>

                    <?php 

                    }elseif($data['cta_sts']=="N"){

                    ?>

                    <a href="#block-confirm" data-toggle="modal" data-data="<h4>UNHIDE Cita - Cita <strong><?php echo $data['cta_nm'];?></strong></h4>" data-url="?p=cita_-_cita&act=unblock&id=<?php echo $data['cta_id'];?>"><span style="cursor:pointer" class="label label-danger"><i class="fa fa-ban"></i></span></a>

                    <?php }}?>

                    </td>

                  </tr>

                <?php }?>  

                </tbody>      

                <tfoot>

                  <tr>

                    <th>Cita - Cita </th>

                    <th>Tahun</th>

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

        <h4 class="modal-title" id="myModalLabel"><i class="fa fa-line-chart"></i> Tambah Cita - Cita</h4>

      </div>

      <form class="form-horizontal" action="" method="post">

      <div class="modal-body">

          <div class="form-group">

            <label for="cta_nm" class="col-sm-2 control-label">Cita - Cita</label>

            <div class="col-sm-10">

              <input type="text" name="cta_nm" class="form-control" id="cta_nm" placeholder="Cita - Cita" required>

            </div>

          </div>

          <div class="form-group">

            <label for="cta_thn" class="col-sm-2 control-label">Tahun</label>

            <div class="col-sm-10">

              <input type="text" name="cta_thn" class="form-control" id="cta_thn" placeholder="Tahun" required>

            </div>

          </div>

      </div>

      <div class="modal-footer">

        <button type="submit" name="bsave_cita_cita" class="btn btn-primary"><i class="fa fa-save"></i></button>

      </div>

      </form>

    </div>

  </div>

</div>

<!-- Modal Edit-->

<div class="modal fade" id="cta_edt" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">

  <div class="modal-dialog">

    <div class="modal-content">

      <div class="modal-header bg-primary">

        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>

        <h4 class="modal-title" id="myModalLabel"><i class="fa fa-line-chart"></i> Tambah Cita - Cita</h4>

      </div>

      <form class="form-horizontal" action="" method="post">

      <div class="modal-body">

          <div class="form-group">

            <label for="cta_nm" class="col-sm-2 control-label">Cita - Cita</label>

            <div class="col-sm-10">

              <input type="text" name="cta_nm" class="form-control" id="cta_nm" placeholder="Cita - Cita" required>

            </div>

          </div>

          <div class="form-group">

            <label for="cta_thn" class="col-sm-2 control-label">Tahun</label>

            <div class="col-sm-10">

              <input type="text" name="cta_thn" class="form-control" id="cta_thn" placeholder="Tahun" required>

            </div>

          </div>

      </div>

      <div class="modal-footer">

        <button type="submit" name="bupdate_cita_cita" class="btn btn-primary"><i class="fa fa-save"></i></button>

      </div>

      </form>

    </div>

  </div>

</div>