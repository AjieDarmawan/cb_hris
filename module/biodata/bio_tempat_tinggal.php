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

                    <th>Type</th>

                    <th>Luas Tanah</th>

                    <th>Luas Bangunan</th>

                    <th>Alamat</th>

                    <th>Tahun</th>

                    <th>Aksi</th>

                  </tr>

                </thead>

                <tbody>

                <?php

				$ttg_tampil_id=$bio->ttg_tampil_id($kar_id);

				while($data=mysql_fetch_array($ttg_tampil_id)){

                                    

				?>

                  <tr>

                    <td><?php echo $data['ttg_jns']; ?></td>

                    <td><?php echo $data['ttg_typ']; ?></td>

                    <td><?php echo $data['ttg_luas_tanah']; ?></td>

                    <td><?php echo $data['ttg_luas_bangunan']; ?></td>

                    <td><?php echo $data['ttg_alt']; ?></td>

                    <td><?php echo $data['ttg_thn']; ?></td>

                    <td>

                    <a href="javascript:;"
                    data-ttgid="<?php echo $data['ttg_id']; ?>"
                    data-ttgjns="<?php echo $data['ttg_jns']; ?>"
                    data-ttgtyp="<?php echo $data['ttg_typ']; ?>"
                    data-ttgluastanah="<?php echo $data['ttg_luas_tanah']; ?>"
                    data-ttgluasbangunan="<?php echo $data['ttg_luas_bangunan']; ?>"
                    data-ttgalt="<?php echo $data['ttg_alt']; ?>"
                    data-ttgthn="<?php echo $data['ttg_thn']; ?>" data-toggle="modal" data-target="#ttg_edt" title="Edit Tempat Tinggal"><span style="cursor:pointer" class="label label-primary"><i class="fa fa-ellipsis-h"></i></span></a>

                    <a href="#delete-confirm" data-toggle="modal" data-data="<?php echo $data['ttg_jns'];?>" data-url="?p=tempat_tinggal&act=hapus&id=<?php echo $data['ttg_id'];?>"><span style="cursor:pointer" class="label label-danger"><i class="fa fa-trash"></i></span></a>

                    </td>

                  </tr>

                <?php }?>  

                </tbody>      

                <tfoot>

                  <tr>

                    <th>Jenis</th>

                    <th>Type</th>

                    <th>Luas Tanah</th>

                    <th>Luas Bangunan</th>

                    <th>Alamat</th>

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

        <h4 class="modal-title" id="myModalLabel"><i class="fa fa-home"></i> Tambah Tempat Tinggal</h4>

      </div>

      <form class="form-horizontal" action="" method="post">

      <div class="modal-body">

          <div class="form-group">

            <label for="ttg_jns" class="col-sm-2 control-label">Jenis</label>

            <div class="col-sm-10">

              <select class="form-control" name="ttg_jns" id="ttg_jns" required>

              	<option value="" selected></option>

                <option value="RUMAH (Orang Tua)">RUMAH (Orang Tua)</option>

		            <option value="RUMAH (Pribadi)">RUMAH (Pribadi)</option>

                <option value="APARTEMENT">APARTEMENT</option>

                <option value="RUSUN">RUSUN</option>

                <option value="SEWA">SEWA</option>

              </select>

            </div>

          </div>

          <div class="form-group">

            <label for="ttg_typ" class="col-sm-2 control-label">Type</label>

            <div class="col-sm-10">

              <input type="text" name="ttg_typ" class="form-control" id="ttg_typ" placeholder="Type" step="1" min="1" max="10" required>

            </div>

          </div>

          <div class="form-group">

            <label for="ttg_luas_tanah" class="col-sm-2 control-label">Luas Tanah</label>

            <div class="col-sm-10">

              <input type="text" name="ttg_luas_tanah" class="form-control" id="ttg_luas_tanah" placeholder="Luas Tanah" required>

            </div>

          </div>

          <div class="form-group">

            <label for="ttg_luas_bangunan" class="col-sm-2 control-label">Luas Bangunan</label>

            <div class="col-sm-10">

              <input type="text" name="ttg_luas_bangunan" class="form-control" id="ttg_luas_bangunan" placeholder="Luas Bangunan" required>

            </div>

          </div>

	  <div class="form-group">

            <label for="ttg_alt" class="col-sm-2 control-label">Alamat</label>

            <div class="col-sm-10">

              <textarea name="ttg_alt" class="form-control" id="ttg_alt" placeholder="Alamat" required></textarea>

            </div>

          </div>

          <div class="form-group">

            <label for="ttg_thn" class="col-sm-2 control-label">Tahun</label>

            <div class="col-sm-10">

              <input type="text" name="ttg_thn" class="form-control" id="ttg_thn" placeholder="Tahun" required>

            </div>

          </div>

      </div>

      <div class="modal-footer">

        <button type="submit" name="bsave_tempat_tinggal" class="btn btn-primary"><i class="fa fa-save"></i></button>

      </div>

      </form>

    </div>

  </div>

</div>

<!-- Modal Edit-->

<div class="modal fade" id="ttg_edt" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">

  <div class="modal-dialog">

    <div class="modal-content">

      <div class="modal-header bg-primary">

        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>

        <h4 class="modal-title" id="myModalLabel"><i class="fa fa-home"></i> Edit Tempat Tinggal</h4>

      </div>

      <form class="form-horizontal" action="" method="post">

      <div class="modal-body">

          <div class="form-group">

            <label for="ttg_jns" class="col-sm-2 control-label">Jenis</label>

            <div class="col-sm-10">

              <select class="form-control" name="ttg_jns" id="ttg_jns" required>

                <option value="" selected></option>

                <option value="RUMAH (Orang Tua)">RUMAH (Orang Tua)</option>

                <option value="RUMAH (Pribadi)">RUMAH (Pribadi)</option>

                <option value="APARTEMENT">APARTEMENT</option>

                <option value="RUSUN">RUSUN</option>

                <option value="SEWA">SEWA</option>

              </select>

            </div>

          </div>

          <div class="form-group">

            <label for="ttg_typ" class="col-sm-2 control-label">Type</label>

            <div class="col-sm-10">

              <input type="text" name="ttg_typ" class="form-control" id="ttg_typ" placeholder="Type" step="1" min="1" max="10" required>

            </div>

          </div>

          <div class="form-group">

            <label for="ttg_luas_tanah" class="col-sm-2 control-label">Luas Tanah</label>

            <div class="col-sm-10">

              <input type="text" name="ttg_luas_tanah" class="form-control" id="ttg_luas_tanah" placeholder="Luas Tanah" required>

            </div>

          </div>

          <div class="form-group">

            <label for="ttg_luas_bangunan" class="col-sm-2 control-label">Luas Bangunan</label>

            <div class="col-sm-10">

              <input type="text" name="ttg_luas_bangunan" class="form-control" id="ttg_luas_bangunan" placeholder="Luas Bangunan" required>

            </div>

          </div>

    <div class="form-group">

            <label for="ttg_alt" class="col-sm-2 control-label">Alamat</label>

            <div class="col-sm-10">

              <textarea name="ttg_alt" class="form-control" id="ttg_alt" placeholder="Alamat" required></textarea>

            </div>

          </div>

          <div class="form-group">

            <label for="ttg_thn" class="col-sm-2 control-label">Tahun</label>

            <div class="col-sm-10">

              <input type="text" name="ttg_thn" class="form-control" id="ttg_thn" placeholder="Tahun" required>

            </div>

          </div>

      </div>

      <div class="modal-footer">

        <button type="submit" name="bupdate_tempat_tinggal" class="btn btn-primary"><i class="fa fa-save"></i></button>

      </div>

      </form>

    </div>

  </div>

</div>