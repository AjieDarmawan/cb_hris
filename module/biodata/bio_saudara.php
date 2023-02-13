<?php require('module/biodata/bio_act.php'); ?>

<!-- Content Header (Page header) -->

    <section class="content-header">

      <h1> <?php echo $title;?> <small></small> </h1>

      <ol class="breadcrumb">

        <li><a href="media.php"><i class="fa fa-dashboard"></i> Dashboard</a></li>

        <li><a href="?p=biodata"> Biodata</a></li>

        <li><a href="?p=keluarga"> Keluarga</a></li>

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

                    <th>Status</th>

                    <th>Alamat</th>

                    <th>Pekerjaan</th>

                    <th>Kode Pos</th>

                    <th>No. Telepon</th>

                    <th>No. HP</th>

                    <th>Aksi</th>

                  </tr>

                </thead>

                <tbody>

                <?php

				          $sdr_tampil_id=$bio->sdr_tampil_id($kar_id);

				          while($data=mysql_fetch_array($sdr_tampil_id)){                                

				        ?>

                  <tr>

                    <td><?php echo $data['sdr_nm']; ?></td>

                    <td><?php echo $data['sdr_hubungan']; ?></td>

                    <td><?php echo $data['sdr_kondisi']; ?></td>

                    <td><?php echo $data['sdr_alt']; ?></td>

                    <td><?php echo $data['sdr_pekerjaan']; ?></td>

                    <td><?php echo $data['sdr_kodepos']; ?></td>

                    <td><?php echo $data['sdr_tlp']; ?></td>

                    <td><?php echo $data['sdr_hp']; ?></td>

                    <td>

                    <a href="javascript:;"
                    data-sdrid="<?php echo $data['sdr_id']; ?>"
                    data-sdrnm="<?php echo $data['sdr_nm']; ?>"
                    data-sdrhubungan="<?php echo $data['sdr_hubungan']; ?>"
                    data-sdrkondisi="<?php echo $data['sdr_kondisi']; ?>"
                    data-sdralt="<?php echo $data['sdr_alt']; ?>"
                    data-sdrpekerjaan="<?php echo $data['sdr_pekerjaan']; ?>"
                    data-sdrkodepos="<?php echo $data['sdr_kodepos']; ?>"
                    data-sdrtlp="<?php echo $data['sdr_tlp']; ?>"
                    data-sdrhp="<?php echo $data['sdr_hp']; ?>" data-toggle="modal" data-target="#sdr_edt" title="Edit Saudara"><span style="cursor:pointer" class="label label-primary"><i class="fa fa-pencil"></i></span></a>

                    <a href="#delete-confirm" data-toggle="modal" data-data="<?php echo $data['sdr_nm'];?>" data-url="?p=saudara&act=hapus&id=<?php echo $data['sdr_id'];?>"><span style="cursor:pointer" class="label label-danger"><i class="fa fa-trash"></i></span></a>

                    </td>

                  </tr>

                <?php }?>  

                </tbody>      

                <tfoot>

                  <tr>

                    <th>Nama</th>

                    <th>Hubungan</th>

                    <th>Status</th>

                    <th>Alamat</th>

                    <th>Pekerjaan</th>

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

            <label for="sdr_nm" class="col-sm-2 control-label">Nama</label>

            <div class="col-sm-10">

              <input type="text" name="sdr_nm" class="form-control" id="sdr_nm" placeholder="Nama" required>

            </div>

          </div>

          <div class="form-group">

            <label for="sdr_hubungan" class="col-sm-2 control-label">Hubungan</label>

            <div class="col-sm-10">

              <input type="text" name="sdr_hubungan" class="form-control" id="sdr_hubungan" placeholder="Hubungan" required>

            </div>

          </div>

          <div class="form-group">

            <label for="sdr_kondisi" class="col-sm-2 control-label">Status</label>

              <div class="col-sm-10">

                <select type="text" name="sdr_kondisi" value="" class="form-control" id="sdr_kondisi" placeholder="Kondisi" required>

                 <option value="" selected></option>

                 <option value="Masih Hidup">Masih Hidup</option>

                 <option value="Almarhum">Almarhum</option>

                </select>

              </div>

           </div>

          <div class="form-group">

            <label for="sdr_alt" class="col-sm-2 control-label">Alamat</label>

            <div class="col-sm-10">

              <textarea name="sdr_alt" class="form-control" id="sdr_alt" placeholder="Alamat" required></textarea>

            </div>

          </div>

           <div class="form-group">

            <label for="sdr_pekerjaan" class="col-sm-2 control-label">Pekerjaan</label>

            <div class="col-sm-10">

              <input type="text" name="sdr_pekerjaan" class="form-control" id="sdr_pekerjaan" placeholder="Pekerjaan" required>

            </div>

          </div>

          <div class="form-group">

            <label for="sdr_kodepos" class="col-sm-2 control-label">Kode Pos</label>

            <div class="col-sm-10">

              <input type="text" name="sdr_kodepos" class="form-control" id="sdr_kodepos" placeholder="Kode Pos" required>

            </div>

          </div>

	        <div class="form-group">

            <label for="sdr_tlp" class="col-sm-2 control-label">No. Telepon</label>

            <div class="col-sm-10">

              <input type="text" name="sdr_tlp" class="form-control" id="sdr_tlp" placeholder="No. Telepon" required>

            </div>

          </div>

          <div class="form-group">

            <label for="sdr_hp" class="col-sm-2 control-label">No. HP</label>

            <div class="col-sm-10">

              <input type="text" name="sdr_hp" class="form-control" id="sdr_hp" placeholder="No. HP" required>

            </div>

          </div>

      </div>

      <div class="modal-footer">

        <button type="submit" name="bsave_saudara" class="btn btn-primary"><i class="fa fa-save"></i></button>

      </div>

      </form>

    </div>

  </div>

</div>




<!-- Modal Edit -->

<div class="modal fade" id="sdr_edt" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">

  <div class="modal-dialog">

    <div class="modal-content">

      <div class="modal-header bg-primary">

        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>

        <h4 class="modal-title" id="myModalLabel"><i class="fa fa-users"></i> Edit Kerabat</h4>

      </div>

      <form class="form-horizontal" action="" method="post">

      <input type="hidden" name="sdr_id" id="sdr_id">

      <div class="modal-body">

          <div class="form-group">

            <label for="sdr_nm" class="col-sm-2 control-label">Nama</label>

            <div class="col-sm-10">

              <input type="text" name="sdr_nm" class="form-control" id="sdr_nm" placeholder="Nama" required>

            </div>

          </div>

          <div class="form-group">

            <label for="sdr_hubungan" class="col-sm-2 control-label">Hubungan</label>

            <div class="col-sm-10">

              <input type="text" name="sdr_hubungan" class="form-control" id="sdr_hubungan" placeholder="Hubungan" required>

            </div>

          </div>

          <div class="form-group">

            <label for="sdr_kondisi" class="col-sm-2 control-label">Status</label>

              <div class="col-sm-10">

                <select type="text" name="sdr_kondisi" value="" class="form-control" id="sdr_kondisi" placeholder="Kondisi" required>

                 <option value="" selected></option>

                 <option value="Masih Hidup">Masih Hidup</option>

                 <option value="Almarhum">Almarhum</option>

                </select>

              </div>

           </div>

          <div class="form-group">

            <label for="sdr_alt" class="col-sm-2 control-label">Alamat</label>

            <div class="col-sm-10">

              <textarea name="sdr_alt" class="form-control" id="sdr_alt" placeholder="Alamat" required></textarea>

            </div>

          </div>

           <div class="form-group">

            <label for="sdr_pekerjaan" class="col-sm-2 control-label">Pekerjaan</label>

            <div class="col-sm-10">

              <input type="text" name="sdr_pekerjaan" class="form-control" id="sdr_pekerjaan" placeholder="Pekerjaan" required>

            </div>

          </div>

          <div class="form-group">

            <label for="sdr_kodepos" class="col-sm-2 control-label">Kode Pos</label>

            <div class="col-sm-10">

              <input type="text" name="sdr_kodepos" class="form-control" id="sdr_kodepos" placeholder="Kode Pos" required>

            </div>

          </div>

          <div class="form-group">

            <label for="sdr_tlp" class="col-sm-2 control-label">No. Telepon</label>

            <div class="col-sm-10">

              <input type="text" name="sdr_tlp" class="form-control" id="sdr_tlp" placeholder="No. Telepon" required>

            </div>

          </div>

          <div class="form-group">

            <label for="sdr_hp" class="col-sm-2 control-label">No. HP</label>

            <div class="col-sm-10">

              <input type="text" name="sdr_hp" class="form-control" id="sdr_hp" placeholder="No. HP" required>

            </div>

          </div>

      </div>

      <div class="modal-footer">

        <button type="submit" name="bupdate_saudara" class="btn btn-primary"><i class="fa fa-save"></i></button>

      </div>

      </form>

    </div>

  </div>

</div>