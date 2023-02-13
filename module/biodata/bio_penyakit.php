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

                    <th>Penyakit</th>

                    <th>Tingkatan</th>

                    <th>Tahun Mulai</th>

                    <th>Tahun Akhir</th>

                    <th>Aksi</th>

                  </tr>

                </thead>

                <tbody>

                <?php

				$pyk_tampil_id=$bio->pyk_tampil_id($kar_id);

				while($data=mysql_fetch_array($pyk_tampil_id)){

                                    

				?>

                  <tr>

                    <td><?php echo $data['pyk_nm']; ?></td>

                    <td><?php echo $data['pyk_lvl']; ?></td>

                    <td><?php echo $data['pyk_start']; ?></td>

                    <td><?php echo $data['pyk_end']; ?></td>

                    <td>

                    <a href="javascript:;"
                    data-pykid="<?php echo $data['pyk_id']; ?>"
                    data-pyknm="<?php echo $data['pyk_nm']; ?>"
                    data-pyklvl="<?php echo $data['pyk_lvl']; ?>"
                    data-pykstart="<?php echo $data['pyk_start']; ?>"
                    data-pykend="<?php echo $data['pyk_end']; ?>" data-toggle="modal" data-target="#pyk_edt" title="Edit Riwayat Penyakit"><span style="cursor:pointer" class="label label-primary"><i class="fa fa-ellipsis-h"></i></span></a>

                    <a href="#delete-confirm" data-toggle="modal" data-data="<?php echo $data['pyk_nm'];?>" data-url="?p=riwayat_penyakit&act=hapus&id=<?php echo $data['pyk_id'];?>"><span style="cursor:pointer" class="label label-danger"><i class="fa fa-trash"></i></span></a>

                    </td>

                  </tr>

                <?php }?>  

                </tbody>      

                <tfoot>

                  <tr>

                    <th>Penyakit</th>

                    <th>Tingkatan</th>

                    <th>Tahun Mulai</th>

                    <th>Tahun Akhir</th>

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

        <h4 class="modal-title" id="myModalLabel"><i class="fa fa-heartbeat"></i> Tambah Riwayat Penyakit</h4>

      </div>

      <form class="form-horizontal" action="" method="post">

      <div class="modal-body">

          <div class="form-group">

            <label for="pyk_nm" class="col-sm-2 control-label">Penyakit</label>

            <div class="col-sm-10">

              <input type="text" name="pyk_nm" class="form-control" id="pyk_nm" placeholder="Nama Penyakit" required>

            </div>

          </div>

          <div class="form-group">

            <label for="pyk_lvl" class="col-sm-2 control-label">Tingkatan</label>

            <div class="col-sm-10">

              <select class="form-control" name="pyk_lvl" id="pyk_lvl" required>

              	<option value="" selected></option>

                <option value="RINGAN">RINGAN</option>

                <option value="SEDANG">SEDANG</option>

                <option value="KRONIS">KRONIS</option>

              </select>

            </div>

          </div>

          <div class="form-group">

            <label for="pyk_start" class="col-sm-2 control-label">Tahun Mulai</label>

            <div class="col-sm-10">

              <input type="text" name="pyk_start" class="form-control" id="pyk_start" placeholder="Tahun Mulai" required>

            </div>

          </div>

	  <div class="form-group">

            <label for="pyk_end" class="col-sm-2 control-label">Tahun Akhir</label>

            <div class="col-sm-10">

              <input type="text" name="pyk_end" class="form-control" id="pyk_end" placeholder="Tahun Akhir" required>

            </div>

          </div>

      </div>

      <div class="modal-footer">

        <button type="submit" name="bsave_penyakit" class="btn btn-primary"><i class="fa fa-save"></i></button>

      </div>

      </form>

    </div>

  </div>

</div>

<!-- Modal Edit -->

<div class="modal fade" id="pyk_edt" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">

  <div class="modal-dialog">

    <div class="modal-content">

      <div class="modal-header bg-primary">

        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>

        <h4 class="modal-title" id="myModalLabel"><i class="fa fa-heartbeat"></i> Edit Riwayat Penyakit</h4>

      </div>

      <form class="form-horizontal" action="" method="post">

      <div class="modal-body">

          <div class="form-group">

            <label for="pyk_nm" class="col-sm-2 control-label">Penyakit</label>

            <div class="col-sm-10">

              <input type="text" name="pyk_nm" class="form-control" id="pyk_nm" placeholder="Nama Penyakit" required>

            </div>

          </div>

          <div class="form-group">

            <label for="pyk_lvl" class="col-sm-2 control-label">Tingkatan</label>

            <div class="col-sm-10">

              <select class="form-control" name="pyk_lvl" id="pyk_lvl" required>

                <option value="" selected></option>

                <option value="RINGAN">RINGAN</option>

                <option value="SEDANG">SEDANG</option>

                <option value="KRONIS">KRONIS</option>

              </select>

            </div>

          </div>

          <div class="form-group">

            <label for="pyk_start" class="col-sm-2 control-label">Tahun Mulai</label>

            <div class="col-sm-10">

              <input type="text" name="pyk_start" class="form-control" id="pyk_start" placeholder="Tahun Mulai" required>

            </div>

          </div>

      <div class="form-group">

            <label for="pyk_end" class="col-sm-2 control-label">Tahun Akhir</label>

            <div class="col-sm-10">

              <input type="text" name="pyk_end" class="form-control" id="pyk_end" placeholder="Tahun Akhir" required>

            </div>

          </div>

      </div>

      <div class="modal-footer">

        <button type="submit" name="bupdate_penyakit" class="btn btn-primary"><i class="fa fa-save"></i></button>

      </div>

      </form>

    </div>

  </div>

</div>