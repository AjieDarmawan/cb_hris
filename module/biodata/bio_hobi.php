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

                    <th>Hobi</th>

                    <th>Rating</th>

                    <th>Tahun</th>

                    <th>Aksi</th>

                  </tr>

                </thead>

                <tbody>

                <?php

				$hbi_tampil_id=$bio->hbi_tampil_id($kar_id);

				while($data=mysql_fetch_array($hbi_tampil_id)){

                                    

				?>

                  <tr>

                    <td><?php echo $data['hbi_nm']; ?></td>

                    <td><?php echo $data['hbi_lvl']; ?></td>

                    <td><?php echo $data['hbi_thn']; ?></td>

                    <td>

                    <a href="javascript:;"
                    data-hbiid="<?php echo $data['hbi_id']; ?>"
                    data-hbinm="<?php echo $data['hbi_nm']; ?>"
                    data-hbilvl="<?php echo $data['hbi_lvl']; ?>"
                    data-hbithn="<?php echo $data['hbi_thn']; ?>" data-toggle="modal" data-target="#hbi_edt" title="Edit Hobi" ><span style="cursor:pointer" class="label label-primary"><i class="fa fa-ellipsis-h"></i></span></a>

                    <a href="#delete-confirm" data-toggle="modal" data-data="<?php echo $data['hbi_nm'];?>" data-url="?p=hobi&act=hapus&id=<?php echo $data['hbi_id'];?>"><span style="cursor:pointer" class="label label-danger"><i class="fa fa-trash"></i></span></a>

                    </td>

                  </tr>

                <?php }?>  

                </tbody>      

                <tfoot>

                  <tr>

                    <th>Hobi</th>

                    <th>Rating</th>

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

        <h4 class="modal-title" id="myModalLabel"><i class="fa fa-gamepad"></i> Tambah Hobi</h4>

      </div>

      <form class="form-horizontal" action="" method="post">

      <div class="modal-body">

          <div class="form-group">

            <label for="hbi_nm" class="col-sm-2 control-label">Hobi</label>

            <div class="col-sm-10">

              <input type="text" name="hbi_nm" class="form-control" id="hbi_nm" placeholder="Nama Hobi" required>

            </div>

          </div>

          <div class="form-group">

            <label for="hbi_lvl" class="col-sm-2 control-label">Rating</label>

            <div class="col-sm-10">

              <input type="number" name="hbi_lvl" class="form-control" id="hbi_lvl" placeholder="Rating" step="1" min="1" max="10" required>

            </div>

          </div>

          <div class="form-group">

            <label for="hbi_thn" class="col-sm-2 control-label">Tahun</label>

            <div class="col-sm-10">

              <input type="text" name="hbi_thn" class="form-control" id="hbi_thn" placeholder="Tahun" required>

            </div>

          </div>

      </div>

      <div class="modal-footer">

        <button type="submit" name="bsave_hobi" class="btn btn-primary"><i class="fa fa-save"></i></button>

      </div>

      </form>

    </div>

  </div>

</div>

<!-- Modal Edit -->

<div class="modal fade" id="hbi_edt" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">

  <div class="modal-dialog">

    <div class="modal-content">

      <div class="modal-header bg-primary">

        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>

        <h4 class="modal-title" id="myModalLabel"><i class="fa fa-gamepad"></i> Edit Hobi</h4>

      </div>

      <form class="form-horizontal" action="" method="post">

      <div class="modal-body">

          <div class="form-group">

            <label for="hbi_nm" class="col-sm-2 control-label">Hobi</label>

            <div class="col-sm-10">

              <input type="text" name="hbi_nm" class="form-control" id="hbi_nm" placeholder="Nama Hobi" required>

            </div>

          </div>

          <div class="form-group">

            <label for="hbi_lvl" class="col-sm-2 control-label">Rating</label>

            <div class="col-sm-10">

              <input type="number" name="hbi_lvl" class="form-control" id="hbi_lvl" placeholder="Rating" step="1" min="1" max="10" required>

            </div>

          </div>

          <div class="form-group">

            <label for="hbi_thn" class="col-sm-2 control-label">Tahun</label>

            <div class="col-sm-10">

              <input type="text" name="hbi_thn" class="form-control" id="hbi_thn" placeholder="Tahun" required>

            </div>

          </div>

      </div>

      <div class="modal-footer">

        <button type="submit" name="bupdate_hobi" class="btn btn-primary"><i class="fa fa-save"></i></button>

      </div>

      </form>

    </div>

  </div>

</div>