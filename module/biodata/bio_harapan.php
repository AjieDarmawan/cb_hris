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

                    <th>Harapan </th>

                    <th>Tahun</th>

                    <th>Aksi</th>

                  </tr>

                </thead>

                <tbody>

                <?php

				$hrp_tampil_id=$bio->hrp_tampil_id($kar_id);

				while($data=mysql_fetch_array($hrp_tampil_id)){

                                    

				?>

                  <tr>

                    <td><?php echo $data['hrp_nm']; ?></td>

                    <td><?php echo $data['hrp_thn']; ?></td>

                    <td>

                    <a href="javascript:;"
                    data-hrpid="<?php echo $data['hrp_id']; ?>"
                    data-hrpnm="<?php echo $data['hrp_nm']; ?>"
                    data-hrpthn="<?php echo $data['hrp_thn']; ?>" data-toggle="modal" data-target="#hrp_edt" title="Edit Harapan"><span style="cursor:pointer" class="label label-primary"><i class="fa fa-ellipsis-h"></i></span></a>

                    <a href="#delete-confirm" data-toggle="modal" data-data="<?php echo $data['hrp_nm'];?>" data-url="?p=harapan&act=hapus&id=<?php echo $data['hrp_id'];?>"><span style="cursor:pointer" class="label label-danger"><i class="fa fa-trash"></i></span></a>

                    <?php

                    if(!empty($data['hrp_sts'])){

                      if($data['hrp_sts']=="A"){

                    ?>

                    <a href="#block-confirm" data-toggle="modal" data-data="<h4>Yakin Harapan <strong><?php echo $data['hrp_nm'];?></strong> akan di HIDDEN?</h4>" data-url="?p=harapan&act=block&id=<?php echo $data['hrp_id'];?>"><span style="cursor:pointer" class="label label-success"><i class="fa fa-check"></i></span></a>

                    <?php 

                    }elseif($data['hrp_sts']=="N"){

                    ?>

                    <a href="#block-confirm" data-toggle="modal" data-data="<h4>UNHIDE Harapan <strong><?php echo $data['hrp_nm'];?></strong></h4>" data-url="?p=harapan&act=unblock&id=<?php echo $data['hrp_id'];?>"><span style="cursor:pointer" class="label label-danger"><i class="fa fa-ban"></i></span></a>

                    <?php }}?>

                    </td>

                  </tr>

                <?php }?>  

                </tbody>      

                <tfoot>

                  <tr>

                    <th>Harapan </th>

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

        <h4 class="modal-title" id="myModalLabel"><i class="fa fa-star"></i> Edit Harapan</h4>

      </div>

      <form class="form-horizontal" action="" method="post">

      <div class="modal-body">

          <div class="form-group">

            <label for="hrp_nm" class="col-sm-2 control-label">Harapan</label>

            <div class="col-sm-10">

              <input type="text" name="hrp_nm" class="form-control" id="hrp_nm" placeholder="Harapan" required>

            </div>

          </div>

          <div class="form-group">

            <label for="hrp_thn" class="col-sm-2 control-label">Tahun</label>

            <div class="col-sm-10">

              <input type="text" name="hrp_thn" class="form-control" id="hrp_thn" placeholder="Tahun" required>

            </div>

          </div>

      </div>

      <div class="modal-footer">

        <button type="submit" name="bsave_harapan" class="btn btn-primary"><i class="fa fa-save"></i></button>

      </div>

      </form>

    </div>

  </div>

</div>

<!-- Modal Edit -->

<div class="modal fade" id="hrp_edt" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">

  <div class="modal-dialog">

    <div class="modal-content">

      <div class="modal-header bg-primary">

        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>

        <h4 class="modal-title" id="myModalLabel"><i class="fa fa-star"></i> Tambah Harapan</h4>

      </div>

      <form class="form-horizontal" action="" method="post">

      <div class="modal-body">

          <div class="form-group">

            <label for="hrp_nm" class="col-sm-2 control-label">Harapan</label>

            <div class="col-sm-10">

              <input type="text" name="hrp_nm" class="form-control" id="hrp_nm" placeholder="Harapan" required>

            </div>

          </div>

          <div class="form-group">

            <label for="hrp_thn" class="col-sm-2 control-label">Tahun</label>

            <div class="col-sm-10">

              <input type="text" name="hrp_thn" class="form-control" id="hrp_thn" placeholder="Tahun" required>

            </div>

          </div>

      </div>

      <div class="modal-footer">

        <button type="submit" name="bupdate_harapan" class="btn btn-primary"><i class="fa fa-save"></i></button>

      </div>

      </form>

    </div>

  </div>

</div>