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

                    <th>Khursus</th>

                    <th>Lembaga</th>

                    <th>Sertifikat</th>

                    <th>Tahun Mulai</th>

                    <th>Tahun Akhir</th>

                    <th>Lokasi</th>

                    <th>Aksi</th>

                  </tr>

                </thead>

                <tbody>

                <?php

				$khs_tampil_id=$bio->khs_tampil_id($kar_id);

				while($data=mysql_fetch_array($khs_tampil_id)){

                                    

				?>

                  <tr>

                    <td><?php echo $data['khs_nm']; ?></td>

                    <td><?php echo $data['khs_lembaga']; ?></td>

                    <td><?php echo $data['khs_sertifikat']; ?></td>

                    <td><?php echo $data['khs_start']; ?></td>

                    <td><?php echo $data['khs_end']; ?></td>

                    <td><?php echo $data['khs_lokasi']; ?></td>

                    <td>

                    <a href="javascript:;"
                    data-khsid="<?php echo $data['khs_id']; ?>"
                    data-khsnm="<?php echo $data['khs_nm']; ?>"
                    data-khslembaga="<?php echo $data['khs_lembaga']; ?>"
                    data-khssertifikat="<?php echo $data['khs_sertifikat']; ?>"
                    data-khsstart="<?php echo $data['khs_start']; ?>"
                    data-khsend="<?php echo $data['khs_end']; ?>"
                    data-khslokasi="<?php echo $data['khs_lokasi']; ?>" data-toggle="modal" data-target="#khs_edt" title="Edit Khursus"><span style="cursor:pointer" class="label label-primary"><i class="fa fa-ellipsis-h"></i></span></a>

                    <a href="#delete-confirm" data-toggle="modal" data-data="<?php echo $data['khs_tempat'];?>" data-url="?p=pendidikan_formal&act=hapus&id=<?php echo $data['khs_id'];?>"><span style="cursor:pointer" class="label label-danger"><i class="fa fa-trash"></i></span></a>

                    </td>

                  </tr>

                <?php }?>  

                </tbody>      

                <tfoot>

                  <tr>

                    <th>Khursus</th>

                    <th>Lembaga</th>

                    <th>Sertifikat</th>

                    <th>Tahun Mulai</th>

                    <th>Tahun Akhir</th>

                    <th>Lokasi</th>

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

        <h4 class="modal-title" id="myModalLabel"><i class="fa fa-puzzle-piece"></i> Tambah Khursus</h4>

      </div>

      <form class="form-horizontal" action="" method="post">

      <div class="modal-body">

          <div class="form-group">

            <label for="khs_nm" class="col-sm-2 control-label">Khursus</label>

            <div class="col-sm-10">

              <input type="text" name="khs_nm" class="form-control" id="khs_nm" placeholder="Nama Khursus" required>

            </div>

          </div>

          <div class="form-group">

            <label for="khs_lembaga" class="col-sm-2 control-label">Lembaga</label>

            <div class="col-sm-10">

              <input type="text" name="khs_lembaga" class="form-control" id="khs_lembaga" placeholder="Nama Lembaga" required>

            </div>

          </div>

          <div class="form-group">

            <label for="khs_sertifikat" class="col-sm-2 control-label">Sertifikat</label>

            <div class="col-sm-10">

              <input type="text" name="khs_sertifikat" class="form-control" id="khs_sertifikat" placeholder="Sertifikat" required>

            </div>

          </div>

          <div class="form-group">

            <label for="khs_start" class="col-sm-2 control-label">Tahun Mulai</label>

            <div class="col-sm-10">

              <input type="text" name="khs_start" class="form-control" id="khs_start" placeholder="Tahun Mulai" required>

            </div>

          </div>

	  <div class="form-group">

            <label for="khs_end" class="col-sm-2 control-label">Tahun Akhir</label>

            <div class="col-sm-10">

              <input type="text" name="khs_end" class="form-control" id="khs_end" placeholder="Tahun Akhir" required>

            </div>

          </div>

          <div class="form-group">

            <label for="khs_lokasi" class="col-sm-2 control-label">Lokasi</label>

            <div class="col-sm-10">

              <input type="text" name="khs_lokasi" class="form-control" id="khs_lokasi" placeholder="Lokasi" required>

            </div>

          </div>

      </div>

      <div class="modal-footer">

        <button type="submit" name="bsave_khursus" class="btn btn-primary"><i class="fa fa-save"></i></button>

      </div>

      </form>

    </div>

  </div>

</div>

<!-- Modal Edit-->

<div class="modal fade" id="khs_edt" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">

  <div class="modal-dialog">

    <div class="modal-content">

      <div class="modal-header bg-primary">

        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>

        <h4 class="modal-title" id="myModalLabel"><i class="fa fa-puzzle-piece"></i> Edit Khursus</h4>

      </div>

      <form class="form-horizontal" action="" method="post">

      <div class="modal-body">

          <div class="form-group">

            <label for="khs_nm" class="col-sm-2 control-label">Khursus</label>

            <div class="col-sm-10">

              <input type="text" name="khs_nm" class="form-control" id="khs_nm" placeholder="Nama Khursus" required>

            </div>

          </div>

          <div class="form-group">

            <label for="khs_lembaga" class="col-sm-2 control-label">Lembaga</label>

            <div class="col-sm-10">

              <input type="text" name="khs_lembaga" class="form-control" id="khs_lembaga" placeholder="Nama Lembaga" required>

            </div>

          </div>

          <div class="form-group">

            <label for="khs_sertifikat" class="col-sm-2 control-label">Sertifikat</label>

            <div class="col-sm-10">

              <input type="text" name="khs_sertifikat" class="form-control" id="khs_sertifikat" placeholder="Sertifikat" required>

            </div>

          </div>

          <div class="form-group">

            <label for="khs_start" class="col-sm-2 control-label">Tahun Mulai</label>

            <div class="col-sm-10">

              <input type="text" name="khs_start" class="form-control" id="khs_start" placeholder="Tahun Mulai" required>

            </div>

          </div>

      <div class="form-group">

            <label for="khs_end" class="col-sm-2 control-label">Tahun Akhir</label>

            <div class="col-sm-10">

              <input type="text" name="khs_end" class="form-control" id="khs_end" placeholder="Tahun Akhir" required>

            </div>

          </div>

          <div class="form-group">

            <label for="khs_lokasi" class="col-sm-2 control-label">Lokasi</label>

            <div class="col-sm-10">

              <input type="text" name="khs_lokasi" class="form-control" id="khs_lokasi" placeholder="Lokasi" required>

            </div>

          </div>

      </div>

      <div class="modal-footer">

        <button type="submit" name="bupdate_khursus" class="btn btn-primary"><i class="fa fa-save"></i></button>

      </div>

      </form>

    </div>

  </div>

</div>