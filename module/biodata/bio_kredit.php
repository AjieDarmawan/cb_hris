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

                    <th>Jenis</th>

                    <th>Kredit</th>

                    <th>Deskripsi</th>

                    <th>Akad</th>

                    <th>Durasi</th>

                    <th>Bank / Leasing</th>

                    <th>Aksi</th>

                  </tr>

                </thead>

                <tbody>

                <?php

				$krd_tampil_id=$bio->krd_tampil_id($kar_id);

				while($data=mysql_fetch_array($krd_tampil_id)){

                                    

				?>

                  <tr>

                    <td><?php echo $data['krd_jns']; ?></td>

                    <td><?php echo $data['krd_nm']; ?></td>

                    <td><?php echo $data['krd_des']; ?></td>

                    <td><?php echo $tgl->tgl_indo($data['krd_akad']); ?></td>

                    <td><?php echo $data['krd_durasi']; ?></td>

                    <td><?php echo $data['krd_via']; ?></td>

                    <td>

                    <a href="javascript:;"
                    data-krdid="<?php echo $data['krd_id']; ?>"
                    data-krdjns="<?php echo $data['krd_jns']; ?>"
                    data-krdnm="<?php echo $data['krd_nm']; ?>"
                    data-krddes="<?php echo $data['krd_des']; ?>"
                    data-krdakad="<?php echo $data['krd_akad']; ?>"
                    data-krddurasi="<?php echo $data['krd_durasi']; ?>"
                    data-krdvia="<?php echo $data['krd_via']; ?>" data-toggle="modal" data-target="#krd_edt" title="Edit Kredit"><span style="cursor:pointer" class="label label-primary"><i class="fa fa-ellipsis-h"></i></span></a>

                    <a href="#delete-confirm" data-toggle="modal" data-data="<?php echo $data['krd_jns'];?>" data-url="?p=tempat_tinggal&act=hapus&id=<?php echo $data['krd_id'];?>"><span style="cursor:pointer" class="label label-danger"><i class="fa fa-trash"></i></span></a>

                    </td>

                  </tr>

                <?php }?>  

                </tbody>      

                <tfoot>

                  <tr>

                    <th>Jenis</th>

                    <th>Kredit</th>

                    <th>Deskripsi</th>

                    <th>Akad</th>

                    <th>Durasi</th>

                    <th>Bank / Leasing</th>

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

        <h4 class="modal-title" id="myModalLabel"><i class="fa fa-calculator"></i> Tambah Kredit</h4>

      </div>

      <form class="form-horizontal" action="" method="post">

      <div class="modal-body">

          <div class="form-group">

            <label for="krd_jns" class="col-sm-2 control-label">Jenis</label>

            <div class="col-sm-10">

              <select class="form-control" name="krd_jns" id="krd_jns" required>

              	<option value="" selected></option>

                <option value="RUMAH">RUMAH</option>

                <option value="APARTEMENT">APARTEMENT</option>

                <option value="MOTOR">MOTOR</option>

                <option value="MOBIL">MOBIL</option>

              </select>

            </div>

          </div>

          <div class="form-group">

            <label for="krd_nm" class="col-sm-2 control-label">Kredit</label>

            <div class="col-sm-10">

              <input type="text" name="krd_nm" class="form-control" id="krd_nm" placeholder="Kredit" required>

            </div>

          </div>

	  <div class="form-group">

            <label for="krd_des" class="col-sm-2 control-label">Deskrpsi</label>

            <div class="col-sm-10">

              <textarea name="krd_des" class="form-control" id="krd_des" placeholder="Deskrpsi" required></textarea>

            </div>

          </div>

          <div class="form-group">

            <label for="krd_akad" class="col-sm-2 control-label">Akad</label>

            <div class="col-sm-10">

              <input type="text" name="krd_akad" class="form-control" id="krd_akad" placeholder="Tanggal Akad" required>

            </div>

          </div>

          <div class="form-group">

            <label for="krd_durasi" class="col-sm-2 control-label">Durasi</label>

            <div class="col-sm-10">

              <input type="text" name="krd_durasi" class="form-control" id="krd_durasi" placeholder="Durasi Kredit" required>

            </div>

          </div>

          <div class="form-group">

            <label for="krd_via" class="col-sm-2 control-label">Bank / Leasing</label>

            <div class="col-sm-10">

              <input type="text" name="krd_via" class="form-control" id="krd_via" placeholder="Bank / Leasing" required>

            </div>

          </div>

      </div>

      <div class="modal-footer">

        <button type="submit" name="bsave_kredit" class="btn btn-primary"><i class="fa fa-save"></i></button>

      </div>

      </form>

    </div>

  </div>

</div>

<!-- Modal Edit -->

<div class="modal fade" id="krd_edt" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">

  <div class="modal-dialog">

    <div class="modal-content">

      <div class="modal-header bg-primary">

        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>

        <h4 class="modal-title" id="myModalLabel"><i class="fa fa-calculator"></i> Edit Kredit</h4>

      </div>

      <form class="form-horizontal" action="" method="post">

      <div class="modal-body">

          <div class="form-group">

            <label for="krd_jns" class="col-sm-2 control-label">Jenis</label>

            <div class="col-sm-10">

              <select class="form-control" name="krd_jns" id="krd_jns" required>

                <option value="" selected></option>

                <option value="RUMAH">RUMAH</option>

                <option value="APARTEMENT">APARTEMENT</option>

                <option value="MOTOR">MOTOR</option>

                <option value="MOBIL">MOBIL</option>

              </select>

            </div>

          </div>

          <div class="form-group">

            <label for="krd_nm" class="col-sm-2 control-label">Kredit</label>

            <div class="col-sm-10">

              <input type="text" name="krd_nm" class="form-control" id="krd_nm" placeholder="Kredit" required>

            </div>

          </div>

    <div class="form-group">

            <label for="krd_des" class="col-sm-2 control-label">Deskrpsi</label>

            <div class="col-sm-10">

              <textarea name="krd_des" class="form-control" id="krd_des" placeholder="Deskrpsi" required></textarea>

            </div>

          </div>

          <div class="form-group">

            <label for="krd_akad" class="col-sm-2 control-label">Akad</label>

            <div class="col-sm-10">

              <input type="text" name="krd_akad" class="form-control" id="krd_akad" placeholder="Tanggal Akad" required>

            </div>

          </div>

          <div class="form-group">

            <label for="krd_durasi" class="col-sm-2 control-label">Durasi</label>

            <div class="col-sm-10">

              <input type="text" name="krd_durasi" class="form-control" id="krd_durasi" placeholder="Durasi Kredit" required>

            </div>

          </div>

          <div class="form-group">

            <label for="krd_via" class="col-sm-2 control-label">Bank / Leasing</label>

            <div class="col-sm-10">

              <input type="text" name="krd_via" class="form-control" id="krd_via" placeholder="Bank / Leasing" required>

            </div>

          </div>

      </div>

      <div class="modal-footer">

        <button type="submit" name="bupdate_kredit" class="btn btn-primary"><i class="fa fa-save"></i></button>

      </div>

      </form>

    </div>

  </div>

</div>