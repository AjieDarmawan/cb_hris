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

                    <th>Nama</th>

                    <th>Hubungan</th>

                    <th>Alamat</th>

                    <th>Kode Pos</th>

                    <th>No. Telepon</th>

                    <th>No. HP</th>

                    <th>Aksi</th>

                  </tr>

                </thead>

                <tbody>

                <?php

				$kbt_tampil_id=$bio->kbt_tampil_id($kar_id);

				while($data=mysql_fetch_array($kbt_tampil_id)){

                                    

				?>

                  <tr>

                    <td><?php echo $data['kbt_nm']; ?></td>

                    <td><?php echo $data['kbt_hubungan']; ?></td>

                    <td><?php echo $data['kbt_alt']; ?></td>

                    <td><?php echo $data['kbt_kodepos']; ?></td>

                    <td><?php echo $data['kbt_tlp']; ?></td>

                    <td><?php echo $data['kbt_hp']; ?></td>

                    <td>

                    <a href="javascript:;"
                    data-kbtid="<?php echo $data['kbt_id']; ?>"
                    data-kbtnm="<?php echo $data['kbt_nm']; ?>"
                    data-kbthubungan="<?php echo $data['kbt_hubungan']; ?>"
                    data-kbtalt="<?php echo $data['kbt_alt']; ?>"
                    data-kbtkodepos="<?php echo $data['kbt_kodepos']; ?>"
                    data-kbttlp="<?php echo $data['kbt_tlp']; ?>"
                    data-kbthp="<?php echo $data['kbt_hp']; ?>" data-toggle="modal" data-target="#kbt_edt" title="Edit Kerabat"><span style="cursor:pointer" class="label label-primary"><i class="fa fa-ellipsis-h"></i></span></a>

                    <a href="#delete-confirm" data-toggle="modal" data-data="<?php echo $data['kbt_tempat'];?>" data-url="?p=pendidikan_formal&act=hapus&id=<?php echo $data['kbt_id'];?>"><span style="cursor:pointer" class="label label-danger"><i class="fa fa-trash"></i></span></a>

                    </td>

                  </tr>

                <?php }?>  

                </tbody>      

                <tfoot>

                  <tr>

                    <th>Nama</th>

                    <th>Hubungan</th>

                    <th>Alamat</th>

                    <th>Kode Pos</th>

                    <th>No. Telepon</th>

                    <th>No. HP</th>

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

        <h4 class="modal-title" id="myModalLabel"><i class="fa fa-users"></i> Tambah Kerabat</h4>

      </div>

      <form class="form-horizontal" action="" method="post">

      <div class="modal-body">

          <div class="form-group">

            <label for="kbt_nm" class="col-sm-2 control-label">Nama</label>

            <div class="col-sm-10">

              <input type="text" name="kbt_nm" class="form-control" id="kbt_nm" placeholder="Nama" required>

            </div>

          </div>

          <div class="form-group">

            <label for="kbt_hubungan" class="col-sm-2 control-label">Hubungan</label>

            <div class="col-sm-10">

              <input type="text" name="kbt_hubungan" class="form-control" id="kbt_hubungan" placeholder="Hubungan" required>

            </div>

          </div>

          <div class="form-group">

            <label for="kbt_alt" class="col-sm-2 control-label">Alamat</label>

            <div class="col-sm-10">

              <textarea name="kbt_alt" class="form-control" id="kbt_alt" placeholder="Alamat" required></textarea>

            </div>

          </div>

          <div class="form-group">

            <label for="kbt_kodepos" class="col-sm-2 control-label">Kode Pos</label>

            <div class="col-sm-10">

              <input type="text" name="kbt_kodepos" class="form-control" id="kbt_kodepos" placeholder="Kode Pos" required>

            </div>

          </div>

	  <div class="form-group">

            <label for="kbt_tlp" class="col-sm-2 control-label">No. Telepon</label>

            <div class="col-sm-10">

              <input type="text" name="kbt_tlp" class="form-control" id="kbt_tlp" placeholder="No. Telepon" required>

            </div>

          </div>

          <div class="form-group">

            <label for="kbt_hp" class="col-sm-2 control-label">No. HP</label>

            <div class="col-sm-10">

              <input type="text" name="kbt_hp" class="form-control" id="kbt_hp" placeholder="No. HP" required>

            </div>

          </div>

      </div>

      <div class="modal-footer">

        <button type="submit" name="bsave_kerabat" class="btn btn-primary"><i class="fa fa-save"></i></button>

      </div>

      </form>

    </div>

  </div>

</div>

<!-- Modal Edit -->

<div class="modal fade" id="kbt_edt" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">

  <div class="modal-dialog">

    <div class="modal-content">

      <div class="modal-header bg-primary">

        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>

        <h4 class="modal-title" id="myModalLabel"><i class="fa fa-users"></i> Edit Kerabat</h4>

      </div>

      <form class="form-horizontal" action="" method="post">

      <div class="modal-body">

          <div class="form-group">

            <label for="kbt_nm" class="col-sm-2 control-label">Nama</label>

            <div class="col-sm-10">

              <input type="text" name="kbt_nm" class="form-control" id="kbt_nm" placeholder="Nama" required>

            </div>

          </div>

          <div class="form-group">

            <label for="kbt_hubungan" class="col-sm-2 control-label">Hubungan</label>

            <div class="col-sm-10">

              <input type="text" name="kbt_hubungan" class="form-control" id="kbt_hubungan" placeholder="Hubungan" required>

            </div>

          </div>

          <div class="form-group">

            <label for="kbt_alt" class="col-sm-2 control-label">Alamat</label>

            <div class="col-sm-10">

              <textarea name="kbt_alt" class="form-control" id="kbt_alt" placeholder="Alamat" required></textarea>

            </div>

          </div>

          <div class="form-group">

            <label for="kbt_kodepos" class="col-sm-2 control-label">Kode Pos</label>

            <div class="col-sm-10">

              <input type="text" name="kbt_kodepos" class="form-control" id="kbt_kodepos" placeholder="Kode Pos" required>

            </div>

          </div>

          <div class="form-group">

            <label for="kbt_tlp" class="col-sm-2 control-label">No. Telepon</label>

            <div class="col-sm-10">

              <input type="text" name="kbt_tlp" class="form-control" id="kbt_tlp" placeholder="No. Telepon" required>

            </div>

          </div>

          <div class="form-group">

            <label for="kbt_hp" class="col-sm-2 control-label">No. HP</label>

            <div class="col-sm-10">

              <input type="text" name="kbt_hp" class="form-control" id="kbt_hp" placeholder="No. HP" required>

            </div>

          </div>

      </div>

      <div class="modal-footer">

        <button type="submit" name="bupdate_kerabat" class="btn btn-primary"><i class="fa fa-save"></i></button>

      </div>

      </form>

    </div>

  </div>

</div>