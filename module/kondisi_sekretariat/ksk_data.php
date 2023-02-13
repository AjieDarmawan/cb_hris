<?php require('module/kondisi_sekretariat/ksk_act.php'); ?>
<!-- Content Header (Page header) -->

<style>
  .round img {
    border-radius: 10px;
    box-shadow: 3px 3px 5px;
  }

  .card img {
    border-radius: 10px;
    /* box-shadow: 3px 3px 5px; */

  }
</style>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" integrity="sha512-bLT0Qm9VnAYZDflyKcBaQ2gg0hSYNQrJ8RilYldYQ1FxQYoCLtUjuuRuZo+fjqhx/qtq/1itJ0C2ejDxltZVFg==" crossorigin="anonymous"></script>
<!-- <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.1/dist/jquery.validate.js"></script> -->

<section class="content-header">
  <h1> <?php echo $title; ?> <small></small> </h1>
  <ol class="breadcrumb">
    <li><a href="media.php"><i class="fa fa-dashboard"></i> Dashboard</a></li>
    <li class="active"><?php echo $title; ?></li>
  </ol>
</section>

<!-- Main content -->
<section class="content">

  <!-- Your Page Content Here -->
  <div class="row">
    <div class="col-xs-12">
      <div class="box">
        <div class="box-header">
          <h3 class="box-title">
            <form class="form-inline" method="post" action="">
              <?php
              if (($kar_data['div_id'] == "8" || $kar_data['kar_id'] == '534' || $kar_data['kar_id'] == '248')) {
              ?>
                <div class="form-group">
                  <span class="btn btn-md btn-primary" data-toggle="modal" data-target="#inputksk"><i class="fa fa-plus"></i> Add</span>
                </div>
              <?php
              }
              ?>
              <div class="form-group">
                <?php
                if (!empty($_SESSION['priode1']) || !empty($_SESSION['priode2']) || !empty($_SESSION['pts']) || !empty($_SESSION['staff']) || !empty($_SESSION['wilayah'])) {
                  $filter_aktif = " : <em>Active</em>";
                }
                ?>
                <span class="btn btn-md btn-warning" data-toggle="modal" data-target="#filterksk"><i class="fa fa-search"></i> Filter <?php echo $filter_aktif; ?></span>
              </div>
              <div class="form-group">
                <button type="submit" name="brefreshksk" data-toggle="tooltip" class="btn btn-md btn-default" title="Kembali ke default, kosongkan Filter"><i class="fa fa-refresh"></i></button>
              </div>
            </form>
            <?php //echo $_SESSION['priode1']." / ".$_SESSION['priode2']." / ".$_SESSION['pts']." / ".$_SESSION['program'];
            ?>
          </h3>

          <?php
          if (($kar_data['lvl_id'] <= 3) || ($kar_data['kar_id'] == "248" || $kar_data['kar_id'] == "534" || $kar_data['kar_id'] == "551" || $kar_data['kar_id'] == "447" || $kar_data['kar_id'] == "542")) {
          ?>
            <div class="pull-right">
              <form class="form-inline" method="post" action="">
                <!-- <div class="form-group"> -->
                <!--<input type="hidden" name="tglekspor" id="tglekspor" value="">-->
                <!-- <button type="button" onclick="ksk_ekspor()" class="btn btn-md btn-success"><i class="fa fa-file-excel-o"></i> Export to Excel</button> -->
                <!-- </div> -->

                <div class="form-group">
                  <!--<input type="hidden" name="tglekspor" id="tglekspor" value="">-->
                  <a href="#viewrekap" data-toggle="modal" type="button" class="btn btn-md btn-success"><i class="fa fa-file"></i> &nbsp;Rekapan</a>
                </div>
              </form>
            </div>
          <?php } ?>

        </div>
        <!-- /.box-header -->
        <div class="box-body">

          <table id="tb_karyawan" class="table table-bordered table-striped table-hover">
            <thead>
              <tr>
                <th>No</th>
                <th>Tanggal Upload</th>
                <th>Nama Unit</th>
                <th>Nama Staff</th>
                <th>Posisi Sekretariat</th>
                <th>Deskripsi Ruangan</th>
                <th>Saran Perbaikan Kondisi Saat Ini</th>
                <th>Kondisi</th>
                <th>Status</th>
                <th width="8%">Foto/Edit</th>
              </tr>
            </thead>
            <tbody>
              <?php

              if (!empty($_SESSION['priode1']) || !empty($_SESSION['priode2']) || !empty($_SESSION['pts']) || !empty($_SESSION['staff']) || !empty($_SESSION['wilayah'])) {

                $sespriode1 = $_SESSION['priode1'];
                $sespriode2 = $_SESSION['priode2'];
                $sespts = $_SESSION['pts'];
                $sesstaff = $_SESSION['staff'];
                $seswilayah = $_SESSION['wilayah'];

                $ksk_tampil = $ksk->ksk_tampil_filter($sespriode1, $sespriode2, $sespts, $sesstaff, $seswilayah);
              } else {

                // $ksk_tampil_max = $ksk->ksk_tampil_max();
                // $ksk_data_max = mysql_fetch_assoc($ksk_tampil_max);
                // $tgl_terakhir = $ksk_data_max['tgl_terakhir'];

                // $ksk_tampil = $ksk->ksk_tampil($tgl_terakhir);
                $ksk_tampil = $ksk->ksk_tampil_all();
              }
              $no = 1;
              while ($data = mysql_fetch_assoc($ksk_tampil)) {

                $ktr_id_ksk = $data['ksk_unit'];
                $ktr_tampil_id_ksk = $ktr->ktr_tampil_id($ktr_id_ksk);
                $ktr_data_ksk = mysql_fetch_assoc($ktr_tampil_id_ksk);

                $kar_id_staff = $data['ksk_staff'];
                $kar_tampil_id_staff = $kar->kar_tampil_id($kar_id_staff);
                $kar_data_staff = mysql_fetch_assoc($kar_tampil_id_staff);

                $deskripsi = json_decode($data['ksk_deskripsi'], true);

                $kondisi = '';
                if ($data['ksk_kondisi'] == 'Sangat') {
                  $kondisi = '<span class="label label-success">Sangat Layak</span>';
                } else if ($data['ksk_kondisi'] == 'Cukup') {
                  $kondisi = '<span class="label label-warning">Cukup Layak</span>';
                } else if ($data['ksk_kondisi'] == 'Kurang') {
                  $kondisi = '<span class="label label-danger">Kurang Layak</span>';
                }


                $status = '';
                if ($data['ksk_status'] == 'Done') {
                  $status = '<span class="label label-success">Done</span>';
                } else if ($data['ksk_status'] == 'Progress') {
                  $status = '<span class="label label-warning">Progress</span>';
                } else if ($data['ksk_status'] == 'Cancel') {
                  $status = '<span class="label label-danger">Cancel</span>';
                } else {
                  $status = '-';
                }

              ?>
                <tr>
                  <td><small><?php echo $no++ ?></small></td>
                  <td><small><?php echo $tgl->tgl_indo($data['ksk_mddt']); ?></small></td>
                  <td class="text-blue"><small><?php echo $ktr_data_ksk['ktr_kd']; ?></small></td>
                  <td class="text-blue"><small><?php echo $kar_data_staff['kar_nik'] . '-' . $kar_data_staff['kar_nm']; ?></small></td>
                  <td><small><?php echo $data['ksk_posisi']; ?></small></td>
                  <td><small><?php echo $deskripsi[1] ?></small></td>
                  <td><small><?php echo $data['ksk_kondisi_txt']; ?></small></td>
                  <td><small><?php echo $kondisi ?></small></td>
                  <td><small><?php echo $status; ?></small></td>
                  <td class="text-center">
                    <a href="javascript:;" data-ksk_id="<?php echo $data['ksk_id']; ?>" data-ksk_mddt="<?php echo $data['ksk_mddt']; ?>" data-ksk_unit="<?php echo $ktr_data_ksk['ktr_nm']; ?>" data-ksk_staff="<?php echo $kar_data_staff['kar_nik'] . '-' . $kar_data_staff['kar_nm']; ?>" data-ksk_pic="<?php echo $data['ksk_pic']; ?>" data-ksk_posisi="<?php echo $data['ksk_posisi']; ?>" data-ksk_kondisi="<?php echo $data['ksk_kondisi']; ?>" data-ksk_kondisi_txt="<?php echo $data['ksk_kondisi_txt']; ?>" data-ksk_deskripsi=`<?php echo base64_encode($data['ksk_deskripsi']); ?>` data-ksk_img=`<?php echo $data['ksk_img']; ?>` data-ksk_hrd="<?php echo $data['ksk_hrd']; ?>" data-ksk_status="<?php echo $data['ksk_status']; ?>" data-toggle="modal" data-target="#viewksk"><i class="fa fa-eye"></i></a>&nbsp;&nbsp;&nbsp;
                    <?php
                    if ($data['ksk_staff'] == $kar_id) {
                    ?>
                      <!-- $ksk_tgl, $ksk_waktu, $ksk_pic, $ksk_metode, $ksk_unit, $ksk_staff, $ksk_topic_cat, $ksk_knowledge, $ksk_knowledge_cat, $ksk_komunikasi, $ksk_komunikasi_cat, $ksk_closing, $ksk_closing_cat, $ksk_mempengaruhi, $ksk_mempengaruhi_cat, $ksk_lain_cat, $ksk_arahan_cat, $ksk_perkembangan, $ksk_crdt -->


                      <a href="javascript:;" data-ksk_id="<?php echo $data['ksk_id']; ?>" data-ksk_mddt="<?php echo $data['ksk_mddt']; ?>" data-ksk_unit="<?php echo $data['ksk_unit']; ?>" data-ksk_staff="<?php echo $data['ksk_staff']; ?>" data-ksk_pic="<?php echo $data['ksk_pic']; ?>" data-ksk_posisi="<?php echo $data['ksk_posisi']; ?>" data-ksk_kondisi="<?php echo $data['ksk_kondisi']; ?>" data-ksk_kondisi_txt="<?php echo $data['ksk_kondisi_txt']; ?>" data-ksk_deskripsi=`<?php echo base64_encode($data['ksk_deskripsi']); ?>` data-ksk_img=`<?php echo $data['ksk_img']; ?>` data-toggle="modal" data-target="#editksk"><i class="fa  fa-pencil"></i></a>&nbsp;&nbsp;&nbsp;

                      <a class="delete-kskorma" href="#delete-confirm" data-toggle="modal" data-data="<h4>Kondisi Sekretariat <strong><?php echo $ktr_data_ksk['ktr_kd']; ?></strong>?</h4>" data-url="?p=kondisi_sekretariat&act=hapus&id=<?php echo $data['ksk_id']; ?>"><i class="fa fa-trash"></i></a>
                    <?php
                    }
                    ?>
                  </td>
                </tr>
              <?php } ?>
            </tbody>
            <tfoot>
              <tr>
                <th>No</th>
                <th>Tanggal Upload</th>
                <th>Nama Unit</th>
                <th>Nama Staff</th>
                <th>Posisi Sekretariat</th>
                <th>Deskripsi Ruangan</th>
                <th>Saran Perbaikan Kondisi Saat Ini</th>
                <th>Kondisi</th>
                <th>Status</th>
                <th width="8%">Foto/Edit</th>
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



<!-- Modal Input ksk -->
<div class="modal fade" id="inputksk" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header bg-primary">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel"><i class="fa fa-plus"></i> Tambah Kondisi Sekretariat</h4>
      </div>
      <!-- action="" method="post" -->
      <form id="form_add_ksk" class="form-horizontal" enctype="multipart/form-data" method="post">
        <div class="modal-body">

          <div class="row">
            <div class="col-sm-6">

              <div class="form-group">
                <label for="ksk_staff" class="col-sm-12" style="margin-bottom:7px">Nama Staff <span class="text-danger">*</span></label>
                <!-- <div class="field_wrapper col-sm-12">
                  <input type="text" name="ksk_staff" class="form-control" id="ksk_staff" value="" placeholder="Nama Staff">
                </div> -->

                <div class="col-sm-12">
                  <div class="bfh-selectbox" data-name="ksk_staff" data-value="<?php echo $kar_data['kar_id'] ?>" data-filter="true" disabled>
                    <div data-value=""></div>
                    <?php
                    $kar_tampil = $kar->kar_tampil_uptodate();
                    if ($kar_tampil) {
                      foreach ($kar_tampil as $data) {
                    ?>
                        <div data-value="<?php echo $data['kar_id']; ?>"><?php echo $data['kar_nik'] . ' - ' . $data['kar_nm']; ?></div>
                    <?php
                      }
                    } ?>
                  </div>
                </div>



              </div>


            </div>

            <div class="col-sm-6">

              <div class="form-group">
                <label for="ksk_unit" class="col-sm-12" style="margin-bottom:7px">Kantor/Unit <span class="text-danger">*</span></label>
                <!-- <div class="field_wrapper col-sm-12">
                  <input type="text" name="ksk_unit" class="form-control" id="ksk_unit" value="" placeholder="Unit">
                </div> -->
                <div class="col-sm-12">
                  <div class="bfh-selectbox" data-name="ksk_unit" data-value="<?php echo $kar_data['unt_id'] ?>" data-filter="true">
                    <div data-value=""></div>
                    <?php
                    $ktr_tampil = $ktr->ktr_tampil();
                    if ($ktr_tampil) {
                      foreach ($ktr_tampil as $data) {
                        //if (($data['ktr_id'] !== "1") && ($data['ktr_id'] !== "2")) {
                    ?>
                        <div data-value="<?php echo $data['ktr_id']; ?>"><?php echo $data['ktr_nm']; ?></div>
                    <?php //}
                      }
                    } ?>
                  </div>
                </div>
              </div>

            </div>


            <!-- <div class="col-sm-6">


            </div> -->
          </div>
          <hr>

          <div class="row">
            <div class="col-md-12">
              <div class="row">

                <div class="col-sm-12 text-center" style="margin-bottom:15px">

                  <div class="form-group">
                    <label class="col-sm-12" style="margin-bottom:15px">Posisi Sekretariat</label>
                    <div class="col-sm-12">

                      <input type="radio" name="ksk_posisi" value="Sendiri" class="" id="ksk_posisi1" checked /> <label for="ksk_posisi1" class="label label-success" style="cursor:pointer">Ruang Tersendiri</label> &nbsp;
                      <input type="radio" name="ksk_posisi" value="Gabung" class="" id="ksk_posisi2" /> <label for="ksk_posisi2" class="label label-primary" style="cursor:pointer">Gabung dengan PMB Kampus</label> &nbsp;

                    </div>
                  </div>
                </div>


                <div class="col-sm-12 text-center" style="margin-bottom:15px">

                  <div class="form-group">
                    <label class="col-sm-12" style="margin-bottom:15px">Kondisi Sekretariat Saat Ini</label>
                    <div class="col-sm-12" style="margin-bottom:15px">


                      <input type="radio" name="ksk_kondisi" value="Sangat" class="kondisiyes" id="ksk_kondisi1" checked /> <label for="ksk_kondisi1" class="label label-success" style="cursor:pointer">Sangat Layak</label> &nbsp;
                      <input type="radio" name="ksk_kondisi" value="Cukup" class="kondisino" id="ksk_kondisi2" /> <label for="ksk_kondisi2" class="label label-warning" style="cursor:pointer">Cukup Layak</label> &nbsp;
                      <input type="radio" name="ksk_kondisi" value="Kurang" class="kondisino" id="ksk_kondisi3" /> <label for="ksk_kondisi3" class="label label-danger" style="cursor:pointer">Kurang Layak</label> &nbsp;

                    </div>

                    <script>
                      $('.kondisiyes').click(function() {
                        $('#ksk_kondisi_txt').val('');
                        $('#div_ksk_kondisi_txt').fadeOut();
                      })
                      $('.kondisino').click(function() {
                        $('#div_ksk_kondisi_txt').fadeIn();
                      })
                    </script>

                    <div class="col-sm-12" style="margin-bottom:15px; display:none" id="div_ksk_kondisi_txt">
                      <center>
                        <textarea name="ksk_kondisi_txt" id="ksk_kondisi_txt" class="form-control ksk_kondisi_txt" rows="5" placeholder="Keterangan / Saran Perbaikan" style="width: 50%; height: 100px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea>
                      </center>
                    </div>
                  </div>
                </div>

                <div class="col-sm-4  text-center" style="margin-bottom:15px">
                  <label for="ksk_deskripsi" class="col-sm-12" style="margin-bottom:15px;">Foto Tampak Depan <span class="text-danger">*</span></label>
                  <div class="col-sm-12 text-center">
                    <label for="ksk_img1">
                      <div class="card" style="cursor: pointer;">
                        <img src="https://edunitas.com/assets/icon/focus.svg" id="ksk_img1_img" alt="No images" class="card-img-top card-img" style="width:100%; height:120px; object-fit:cover;">
                      </div>
                    </label>
                    <input type="file" name="files[]" id="ksk_img1" accept="image/*" style="display:none;">
                  </div>
                  <div class="col-sm-12">
                    <textarea name="ksk_deskripsi[]" id="ksk_deskripsi" class="form-control ksk_deskripsi" rows="5" placeholder="Deskripsi" style="width: 100%; height: 100px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea>
                  </div>
                </div>

                <div class="col-sm-4  text-center" style="margin-bottom:15px">
                  <label for="ksk_deskripsi" class="col-sm-12" style="margin-bottom:15px;">Foto Ruangan <span class="text-danger">*</span></label>
                  <div class="col-sm-12">
                    <label for="ksk_img2">
                      <div class="card" style="cursor: pointer;">
                        <img src="https://edunitas.com/assets/icon/focus.svg" id="ksk_img2_img" alt="No images" class="card-img-top card-img" style="width:100%; height:120px;object-fit:cover;">
                      </div>
                    </label>
                    <input type="file" name="files[]" id="ksk_img2" accept="image/*" style="display:none;">
                  </div>
                  <div class="col-sm-12">
                    <textarea name="ksk_deskripsi[]" id="ksk_deskripsi2" class="form-control ksk_deskripsi" rows="5" placeholder="Deskripsi" style="width: 100%; height: 100px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea>
                  </div>
                </div>

                <div class="col-sm-4  text-center" style="margin-bottom:15px">
                  <label for="ksk_deskripsi" class="col-sm-12" style="margin-bottom:15px;">Foto Tampak Samping <span class="text-danger">*</span></label>
                  <div class="col-sm-12">
                    <label for="ksk_img3">
                      <div class="card" style="cursor: pointer;">
                        <img src="https://edunitas.com/assets/icon/focus.svg" id="ksk_img3_img" alt="No images" class="card-img-top card-img" style="width:100%; height:120px;object-fit:cover;">
                      </div>
                    </label>
                    <input type="file" name="files[]" id="ksk_img3" accept="image/*" style="display:none;">
                  </div>
                  <div class="col-sm-12">
                    <textarea name="ksk_deskripsi[]" id="ksk_deskripsi3" class="form-control ksk_deskripsi" rows="5" placeholder="Deskripsi" style="width: 100%; height: 100px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea>
                  </div>
                </div>

                <div id="kondisiplus">

                </div>

                <div class="col-sm-4 text-center" style="margin-top:15px;margin-bottom:15px">
                  <button type="button" id="bkondisiplus" class="btn btn-primary"><i class="fa fa-plus"></i> Tambah Gambar</button>
                </div>


              </div>
            </div>

          </div>

        </div>

        <div class="modal-footer">
          <input type="hidden" name="forminput" value="post">
          <button type="submit" name="binputksk" class="btn btn-primary"><i class="fa fa-save"></i> Simpan</button>
        </div>
      </form>
    </div>
  </div>
</div>


<!-- Modal Edit ksk -->
<div class="modal fade" id="editksk" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header bg-primary">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel"><i class="fa fa-pencil"></i> Edit Kondisi Sekretariat</h4>
      </div>
      <form id="form_edit_ksk" class="form-horizontal" enctype="multipart/form-data" method="post">
        <input type="hidden" name="ksk_id" id="e_ksk_id">
        <div class="modal-body">

          <div class="row">
            <div class="col-sm-6">


              <div class="form-group">
                <label for="ksk_staff" class="col-sm-12" style="margin-bottom:7px">Nama Staff</label>
                <!-- <div class="field_wrapper col-sm-12">
                  <input type="text" name="ksk_staff" class="form-control" id="e_ksk_staff" value="" placeholder="Nama Staff">
                </div> -->

                <div class="col-sm-12">
                  <input type="hidden" name="ksk_staff" id="e_ksk_staff_i" value="">
                  <select class="form-control" id="e_ksk_staff" required disabled>
                    <?php
                    $kar_tampil = $kar->kar_tampil_uptodate();
                    if ($kar_tampil) {
                      foreach ($kar_tampil as $data) {
                    ?>
                        <option value="<?php echo $data['kar_id']; ?>"><?php echo $data['kar_nik'] . ' - ' . $data['kar_nm']; ?></option>
                    <?php
                      }
                    } ?>
                  </select>
                </div>



              </div>

            </div>

            <div class="col-sm-6">



              <div class="form-group">
                <label for="ksk_unit" class="col-sm-12" style="margin-bottom:7px">Kantor/Unit</label>
                <!-- <div class="field_wrapper col-sm-12">
                  <input type="text" name="ksk_unit" class="form-control" id="e_ksk_unit" value="" placeholder="Unit">
                </div> -->
                <div class="col-sm-12">

                  <select class="form-control" name="ksk_unit" id="e_ksk_unit" required>
                    <?php
                    $ktr_tampil = $ktr->ktr_tampil();
                    if ($ktr_tampil) {
                      foreach ($ktr_tampil as $data) {
                        //if (($data['ktr_id'] !== "1") && ($data['ktr_id'] !== "2")) {
                    ?>
                        <option value="<?php echo $data['ktr_id']; ?>"><?php echo $data['ktr_nm']; ?></option>
                    <?php //}
                      }
                    } ?>
                  </select>
                </div>
              </div>

            </div>
          </div>
          <hr>

          <div class="row">
            <div class="col-md-12">
              <div class="row">
                <div class="col-sm-12 text-center" style="margin-bottom:15px">

                  <div class="form-group">
                    <label for="ksk_posisi" class="col-sm-12" style="margin-bottom:15px">Posisi Sekretariat</label>
                    <div class="col-sm-12">

                      <input type="radio" name="ksk_posisi" value="Sendiri" class="" id="e_ksk_posisi-1" checked /> <label for="e_ksk_posisi-1" class="label label-warning" style="cursor:pointer">Ruang Tersendiri</label> &nbsp;
                      <input type="radio" name="ksk_posisi" value="Gabung" class="" id="e_ksk_posisi-2" /> <label for="e_ksk_posisi-2" class="label label-primary" style="cursor:pointer">Gabung dengan PMB Kampus</label> &nbsp;

                    </div>
                  </div>

                </div>


                <div class="col-sm-12 text-center" style="margin-bottom:15px">

                  <div class="form-group">
                    <label class="col-sm-12" style="margin-bottom:15px">Kondisi Sekretariat Saat Ini</label>
                    <div class="col-sm-12" style="margin-bottom:15px">


                      <input type="radio" name="ksk_kondisi" value="Sangat" class="ekondisiyes" id="e_ksk_kondisi1" checked /> <label for="e_ksk_kondisi1" class="label label-success" style="cursor:pointer">Sangat Layak</label> &nbsp;
                      <input type="radio" name="ksk_kondisi" value="Cukup" class="ekondisino" id="e_ksk_kondisi2" /> <label for="e_ksk_kondisi2" class="label label-warning" style="cursor:pointer">Cukup Layak</label> &nbsp;
                      <input type="radio" name="ksk_kondisi" value="Kurang" class="ekondisino" id="e_ksk_kondisi3" /> <label for="e_ksk_kondisi3" class="label label-danger" style="cursor:pointer">Kurang Layak</label> &nbsp;

                    </div>

                    <script>
                      $('.ekondisiyes').click(function() {
                        $('#e_ksk_kondisi_txt').val('');
                        $('#div_e_ksk_kondisi_txt').fadeOut();
                      })
                      $('.ekondisino').click(function() {
                        $('#div_e_ksk_kondisi_txt').fadeIn();
                      })
                    </script>

                    <div class="col-sm-12" style="margin-bottom:15px; display:none" id="div_e_ksk_kondisi_txt">
                      <center>
                        <textarea name="ksk_kondisi_txt" id="e_ksk_kondisi_txt" class="form-control ksk_kondisi_txt" rows="5" placeholder="Keterangan / Saran Perbaikan" style="width: 50%; height: 100px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea>
                      </center>
                    </div>
                  </div>
                </div>

                <div id="e_kondisi_list">

                </div>
                <!-- <div class="col-sm-4  text-center">
                  <label for="ksk_deskripsi" class="col-sm-12" style="margin-bottom:15px;">Foto Tampak Depan <span class="text-danger">*</span></label>
                  <div class="col-sm-12 text-center">
                    <label for="e_ksk_img1">
                      <div class="card" style="cursor: pointer;">
                        <img src="https://edunitas.com/assets/icon/focus.svg" id="e_ksk_img1_img" alt="No images" class="card-img-top card-img" style="width:100%; height:120px; object-fit:cover;">
                      </div>
                    </label>
                    <input type="file" name="files[]" id="e_ksk_img1" accept="image/*" style="display:none;">
                  </div>
                  <div class="col-sm-12">
                    <textarea name="ksk_deskripsi" id="e_ksk_deskripsi" class="form-control" rows="5" placeholder="Deskripsi" style="width: 100%; height: 100px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea>
                  </div>
                </div>

                <div class="col-sm-4  text-center">
                  <label for="ksk_deskripsi" class="col-sm-12" style="margin-bottom:15px;">Foto Ruangan <span class="text-danger">*</span></label>
                  <div class="col-sm-12">
                    <label for="e_ksk_img2">
                      <div class="card" style="cursor: pointer;">
                        <img src="https://edunitas.com/assets/icon/focus.svg" id="e_ksk_img2_img" alt="No images" class="card-img-top card-img" style="width:100%; height:120px;object-fit:cover;">
                      </div>
                    </label>
                    <input type="file" name="files[]" id="e_ksk_img2" accept="image/*" style="display:none;">
                  </div>
                  <div class="col-sm-12">
                    <textarea name="ksk_deskripsi2" id="e_ksk_deskripsi2" class="form-control" rows="5" placeholder="Deskripsi" style="width: 100%; height: 100px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea>
                  </div>
                </div>

                <div class="col-sm-4  text-center">
                  <label for="ksk_deskripsi" class="col-sm-12" style="margin-bottom:15px;">Foto Tampak Samping <span class="text-danger">*</span></label>
                  <div class="col-sm-12">
                    <label for="e_ksk_img3">
                      <div class="card" style="cursor: pointer;">
                        <img src="https://edunitas.com/assets/icon/focus.svg" id="e_ksk_img3_img" alt="No images" class="card-img-top card-img" style="width:100%; height:120px;object-fit:cover;">
                      </div>
                    </label>
                    <input type="file" name="files[]" id="e_ksk_img3" accept="image/*" style="display:none;">
                  </div>
                  <div class="col-sm-12">
                    <textarea name="ksk_deskripsi3" id="e_ksk_deskripsi3" class="form-control" rows="5" placeholder="Deskripsi" style="width: 100%; height: 100px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea>
                  </div>
                </div> -->

              </div>
            </div>

          </div>

        </div>
        <div class="modal-footer">
          <input type="hidden" name="forminput" value="put">
          <button type="submit" name="beditksk" class="btn btn-primary"><i class="fa fa-save"></i></button>
        </div>
      </form>
    </div>
  </div>
</div>


<!-- Modal View ksk -->
<div class="modal fade" id="viewksk" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header bg-primary">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel"><i class="fa fa-file"></i> &nbsp;View Kondisi Sekretariat</h4>
      </div>
      <form id="form_view_ksk" class="form-horizontal" enctype="multipart/form-data" method="post">
        <div class="modal-body">
          <!-- Main content -->
          <div class="row">
            <div class="invoice col-md-11">
              <!-- title row -->
              <div class="row">
                <div class="col-sm-12 col-md-12">
                  <h2 class="page-header">
                    <div class="row">
                      <div class="col-xs-3 col-md-2">
                        <img src="dist/img/logo_gg_small130.JPG" width="80">
                      </div>
                      <div class="col-xs-9 col-md-10">
                        PT. Gilland Ganesha<br>
                        <small>Jl. Raya Bogor Km 47,5 Perum Bumi Sentosa Blok A3 No.3, Nanggewer Cibinong, Jawa Barat 16912.</small>
                      </div>
                    </div>
                  </h2>
                </div><!-- /.col -->
                <!-- <div class="col-sm-12 col-md-2">
                    <center><img src="module/profile/img/SG05342019-20201009050833.jpg" width="100" height="125"></center>
                  </div> -->
              </div>
              <!-- info row -->
              <div class="row invoice-info">
                <center style="margin-bottom: 20px;">
                  <h3><u>Kondisi Sekretariat</u></h3>
                  <!-- <span id="v_ksk_hrd" class="label label-danger" style="font-size:13px;"> Unconfirmed by HRD </span> -->
                </center>

                <div class="col-md-12 text-center">
                </div>
                <div class="col-sm-8 invoice-col">
                  <address>
                    <!-- <strong id="v_ksk_pic">Nama PIC</strong><br> -->
                    Kantor/Unit : <span id="v_ksk_unit_label">Kantor/Unit</span><br>
                    Staff : <span id="v_ksk_staff_label">Staff</span><br>
                  </address>
                </div><!-- /.col -->

                <div class="col-sm-4 invoice-col">
                  <div class="row">
                    <div class="col-md-12 text-center">
                      Waktu Upload : <strong id="v_ksk_waktu"> waktu </strong><br>
                      Posisi : <b><span id="v_ksk_posisi" class="text-danger"> posisi </span></b>
                    </div>
                    <!-- <div class="col-md-12 text-center" style="margin-top:10px">
                        <div id="v_ksk_perkembangan" class="label label-danger text-center" style="font-size:13px;">
                          Kurang
                        </div>
                      </div> -->
                  </div>
                </div><!-- /.col -->
              </div><!-- /.row -->

              <!-- Table row -->
              <div class="row" style="margin-top:10px">
                <div class="col-xs-12 table-responsive">


                  <table class="table">
                    <tbody id="tb_kondisi_txt">
                      <tr class="info">
                        <th colspan="4"><small>Kondisi Sekretariat Saat Ini</small></th>
                      </tr>
                      <tr>
                        <td colspan="3" width="85%"><span id="v_ksk_kondisi_txt">-</span></td>
                        <td><span id="v_ksk_kondisi" class="label label-danger">Kurang Layak</span></td>
                      </tr>

                    </tbody>
                  </table>

                  <table class="table">
                    <tbody id="tb_kondisi">

                    </tbody>
                  </table>

                </div><!-- /.col -->
              </div><!-- /.row -->

              <!-- <div class="row text-center">
                  <b class="info" id="div_ksk_img_lain" class="v_ksk_img"><small class="col-sm-12 text-left" style="margin-bottom:20px; margin-left:10px;">Foto/Screenshot Lainnya</small></b>

                  <div class="col-sm-4 v_ksk_img" id="div_ksk_img4">
                    <div class="card round" style="cursor: pointer; margin-bottom:25px" onclick="toggleFullscreen('v_ksk_img4_img');">
                      <img src="" id="v_ksk_img4_img" alt="Kondisi 4" class="card-img-top card-img" style="width:100%; height:150px;object-fit:cover;">
                    </div>
                  </div>
                  <div class="col-sm-4 v_ksk_img" id="div_ksk_img5">
                    <div class="card round" style="cursor: pointer; margin-bottom:25px" onclick="toggleFullscreen('v_ksk_img5_img');">
                      <img src="" id="v_ksk_img5_img" alt="Kondisi 5" class="card-img-top card-img" style="width:100%; height:150px;object-fit:cover;">
                    </div>
                  </div>
                  <div class="col-sm-4 v_ksk_img" id="div_ksk_img6">
                    <div class="card round" style="cursor: pointer; margin-bottom:25px" onclick="toggleFullscreen('v_ksk_img6_img');">
                      <img src="" id="v_ksk_img6_img" alt="Kondisi 6" class="card-img-top card-img" style="width:100%; height:150px;object-fit:cover;">
                    </div>
                  </div>
                </div> -->


            </div><!-- /.content -->
            <div class="clearfix"></div>
          </div>

          <div class="row" style="display:none">

            <div class="col-sm-6">

              <div class="form-group">
                <label for="ksk_unit" class="col-sm-12" style="margin-bottom:7px">Kantor/Unit</label>
                <!-- <div class="field_wrapper col-sm-12">
                  <input type="text" name="ksk_unit" class="form-control" id="v_ksk_unit" value="" placeholder="Unit">
                </div> -->
                <div class="col-sm-12">

                  <select class="form-control" name="ksk_unit" id="v_ksk_unit" required>
                    <?php
                    $ktr_tampil = $ktr->ktr_tampil();
                    if ($ktr_tampil) {
                      foreach ($ktr_tampil as $data) {
                        //if (($data['ktr_id'] !== "1") && ($data['ktr_id'] !== "2")) {
                    ?>
                        <option value="<?php echo $data['ktr_id']; ?>"><?php echo $data['ktr_nm']; ?></option>
                    <?php //}
                      }
                    } ?>
                  </select>
                </div>
              </div>

              <div class="form-group">
                <label for="ksk_staff" class="col-sm-12" style="margin-bottom:7px">Nama Staff</label>
                <!-- <div class="field_wrapper col-sm-12">
                  <input type="text" name="ksk_staff" class="form-control" id="v_ksk_staff" value="" placeholder="Nama Staff">
                </div> -->

                <div class="col-sm-12">

                  <select class="form-control" name="ksk_staff" id="v_ksk_staff" required readonly>
                    <?php
                    $kar_tampil = $kar->kar_tampil_uptodate();
                    if ($kar_tampil) {
                      foreach ($kar_tampil as $data) {
                    ?>
                        <option value="<?php echo $data['kar_id']; ?>"><?php echo $data['kar_nik'] . ' - ' . $data['kar_nm']; ?></option>
                    <?php
                      }
                    } ?>
                  </select>
                </div>



              </div>

            </div>
          </div>
          <hr>

        </div>
        <div class="modal-footer">
          <?php
          if (($kar_data['div_id'] == "9" || $kar_data['kar_id'] == '534' || $kar_data['kar_id'] == '248')) {
          ?>
            <div class="row">
              <div class="col-md-6">
                Status Perbaikan Kondisi Sekretariat Oleh General Affair saat ini :
              </div>
              <div class="col-md-4">

                <input type="radio" name="ksk_status" value="" id="v_ksk_status0" checked=""> <label for="v_ksk_status0" class="label label-info" style="cursor:pointer">None</label> &nbsp;
                <input type="radio" name="ksk_status" value="Progress" id="v_ksk_status1"> <label for="v_ksk_status1" class="label label-warning" style="cursor:pointer">Progress</label> &nbsp;
                <input type="radio" name="ksk_status" value="Cancel" id="v_ksk_status2"> <label for="v_ksk_status2" class="label label-danger" style="cursor:pointer">Cancel</label> &nbsp;
                <input type="radio" name="ksk_status" value="Done" id="v_ksk_status3"> <label for="v_ksk_status3" class="label label-success" style="cursor:pointer">Done</label> &nbsp;

              </div>
              <div class="col-md-2">
                <input type="hidden" name="formprogress" value="put">
                <input type="hidden" name="ksk_id" id="v_ksk_id">
                <button type="submit" name="beditksk" id="v_beditksk" class="btn btn-primary"><i class="fa fa-save"></i> Progress</button>
              </div>
            </div>

          <?php
          }
          ?>
        </div>
      </form>
    </div>
  </div>
</div>


<!-- Modal Filter filterksk -->
<div class="modal fade" id="filterksk" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header bg-yellow">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel"><i class="fa fa-filter"></i> Filter ksk</h4>
      </div>
      <form class="form-horizontal" action="" method="post">
        <div class="modal-body">
          <div class="form-group">
            <label for="priode" class="col-sm-2 control-label">Priode Tgl</label>
            <div class="col-sm-10">
              <div class="input-group">
                <div class="input-group-addon">
                  <i class="fa fa-calendar"></i>
                </div>
                <?php
                if (!empty($_SESSION['priode1']) && !empty($_SESSION['priode2'])) {
                  $data_priode = $_SESSION['priode1'] . " - " . $_SESSION['priode2'];
                } else {
                  $data_priode = "";
                }
                ?>
                <input type="text" name="priode" value="<?php echo $data_priode; ?>" class="form-control pull-right" id="reservation" />
              </div><!-- /.input group -->
            </div>
          </div>

          <!-- <div class="form-group">
            <label for="kwi_wilayah" class="col-sm-2 control-label">Wilayah</label>
            <div class="col-sm-10">
              <?php
              if (!empty($_SESSION['wilayah'])) {
                if ($_SESSION['wilayah'] == "JABODETABEK") {
                  $data_jb = "checked";
                } else {
                  $data_jb = "";
                }
                if ($_SESSION['wilayah'] == "WIL-BANDUNG") {
                  $data_wb = "checked";
                } else {
                  $data_wb = "";
                }
                if ($_SESSION['wilayah'] == "LUAR KOTA") {
                  $data_lk = "checked";
                } else {
                  $data_lk = "";
                }
                if ($_SESSION['wilayah'] == "LUAR JAWA") {
                  $data_lj = "checked";
                } else {
                  $data_lj = "";
                }
                if ($_SESSION['wilayah'] == "SUBANG") {
                  $data_sb = "checked";
                } else {
                  $data_sb = "";
                }
              } else {
                $data_all1 = "checked";
              }
              ?>

              <div class="col-sm-2 nopadding">
                <input type="radio" name="wilayah" value="" class="flat-red" id="wilayah" <?php echo $data_all1; ?> /> <span class="label label-default">ALL</span> &nbsp;
              </div>
              <div class="col-sm-3 nopadding">
                <input type="radio" name="wilayah" value="JABODETABEK" class="flat-red" id="wilayah" <?php echo $data_jb; ?> /> <span class="label label-default">Jabodetabek</span> &nbsp;<br>
                <input type="radio" name="wilayah" value="WIL-BANDUNG" class="flat-red" id="wilayah" <?php echo $data_wb; ?> /> <span class="label label-primary">Wil-Bandung</span> &nbsp;
              </div>
              <div class="col-sm-3 nopadding">
                <input type="radio" name="wilayah" value="LUAR KOTA" class="flat-red" id="wilayah" <?php echo $data_lk; ?> /> <span class="label label-danger">Luar Kota</span> &nbsp;<br>
                <input type="radio" name="wilayah" value="LUAR JAWA" class="flat-red" id="wilayah" <?php echo $data_lj; ?> /> <span class="label label-warning">Luar Jawa</span> &nbsp;
              </div>
              <div class="col-sm-4 nopadding">
                <input type="radio" name="wilayah" value="SUBANG" class="flat-red" id="wilayah" <?php echo $data_sb; ?> /> <span class="label label-primary">Subang</span> &nbsp;
              </div>
            </div>
          </div> -->

          <div class="form-group">
            <label for="pts" class="col-sm-2 control-label">Pilih Kantor/Unit</label>
            <div class="col-sm-10">
              <?php
              if (!empty($_SESSION['pts'])) {
                $data_pts = $_SESSION['pts'];
              } else {
                $data_pts = "";
              }
              ?>
              <div class="bfh-selectbox" data-name="pts" data-value="<?php echo $data_pts; ?>" data-filter="true">
                <div data-value=""></div>
                <?php
                $ktr_tampil = $ktr->ktr_tampil();
                if ($ktr_tampil) {
                  foreach ($ktr_tampil as $data) {
                    //if (($data['ktr_id'] !== "1") && ($data['ktr_id'] !== "2")) {
                ?>
                    <div data-value="<?php echo $data['ktr_id']; ?>"><?php echo $data['ktr_nm']; ?></div>
                <?php //}
                  }
                } ?>
              </div>
            </div>
          </div>



          <div class="form-group">

            <label for="staff" class="col-sm-2 control-label">Pilih PIC Test</label>
            <div class="col-sm-10">
              <div class="bfh-selectbox" data-name="staff" data-value="" data-filter="true">
                <div data-value=""></div>
                <?php
                $kar_tampil = $kar->kar_tampil_uptodate();
                if ($kar_tampil) {
                  foreach ($kar_tampil as $data) {
                ?>
                    <div data-value="<?php echo $data['kar_id']; ?>"><?php echo $data['kar_nik'] . ' - ' . $data['kar_nm']; ?></div>
                <?php
                  }
                } ?>
              </div>
            </div>
          </div>

        </div>
        <div class="modal-footer">
          <small class="pull-left text-red"><em><strong>**) Filter sesuai dengan kebutuhan</strong></em></small>
          <button type="submit" name="bfilterksk" class="btn btn-warning"><i class="fa fa-search"></i></button>
        </div>
      </form>
    </div>
  </div>
</div>


<!-- Modal Filter filterksk -->
<div class="modal fade" id="viewrekap" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header bg-green">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel"><i class="fa fa-file"></i> Rekapan Kondisi Sekretariat</h4>
      </div>
      <form class="form-horizontal" action="" method="post">
        <div class="modal-body">


          <div class="box-body">

            <table id="tb_rekapkondisi" class="table table-bordered table-striped table-hover">
              <thead>
                <tr>
                  <th width="5%">No</th>
                  <th>Nama Staff</th>
                  <th>Nama Unit</th>
                  <th class="text-center">Status</th>
                  <th>Last Upload</th>
                </tr>
              </thead>
              <tbody>
                <?php

                if (!empty($_SESSION['priode1']) || !empty($_SESSION['priode2']) || !empty($_SESSION['pts']) || !empty($_SESSION['staff']) || !empty($_SESSION['wilayah'])) {

                  $sespriode1 = $_SESSION['priode1'];
                  $sespriode2 = $_SESSION['priode2'];
                  $sespts = $_SESSION['pts'];
                  $sesstaff = $_SESSION['staff'];
                  $seswilayah = $_SESSION['wilayah'];

                  $ksk_tampil = $ksk->ksk_tampil_filter($sespriode1, $sespriode2, $sespts, $sesstaff, $seswilayah);
                } else {

                  // $ksk_tampil_max = $ksk->ksk_tampil_max();
                  // $ksk_data_max = mysql_fetch_assoc($ksk_tampil_max);
                  // $tgl_terakhir = $ksk_data_max['tgl_terakhir'];

                  // $ksk_tampil = $ksk->ksk_tampil($tgl_terakhir);
                  $ksk_tampil = $ksk->ksk_rekapan();
                }
                $no = 1;
                while ($data = mysql_fetch_assoc($ksk_tampil)) {

                  $ktr_id_ksk = $data['ktr_id'];
                  $ktr_tampil_id_ksk = $ktr->ktr_tampil_id($ktr_id_ksk);
                  $ktr_data_ksk = mysql_fetch_assoc($ktr_tampil_id_ksk);

                  $kar_id_staff = $data['kar_id'];
                  $kar_tampil_id_staff = $kar->kar_tampil_id($kar_id_staff);
                  $kar_data_staff = mysql_fetch_assoc($kar_tampil_id_staff);

                  $kar_tampil_status_staff = $ksk->ksk_tampil_id($kar_id_staff);
                  $kar_data_status = mysql_fetch_assoc($kar_tampil_status_staff);

                ?>
                  <tr>
                    <td><small><?php echo $no++ ?></small></td>
                    <td class="text-blue"><small><?php echo $kar_data_staff['kar_nik'] . ' - ' . $kar_data_staff['kar_nm']; ?></small></td>
                    <td class="text-blue"><small><?php echo $ktr_data_ksk['ktr_kd']; ?></small></td>
                    <td class="text-green text-center"><small><?php echo ($kar_data_status['ksk_staff'] ? '&#10004;' : '') ?></small></td>
                    <td><small><?php echo $tgl->tgl_indo($kar_data_status['ksk_mddt']); ?></small></td>
                  </tr>
                <?php } ?>
              </tbody>
              <tfoot>
                <tr>
                  <th width="5%">No</th>
                  <th>Nama Staff</th>
                  <th>Nama Unit</th>
                  <th class="text-center">Status</th>
                  <th>Last Upload</th>
                </tr>
              </tfoot>
            </table>

          </div>

        </div>
        <!-- <div class="modal-footer">
          <small class="pull-left text-red"><em><strong>**) Filter sesuai dengan kebutuhan</strong></em></small>
          <button type="submit" name="bfilterksk" class="btn btn-warning"><i class="fa fa-search"></i></button>
        </div> -->
      </form>
    </div>
  </div>
</div>

<script>
  $("#form_add_ksk").submit(function(e) { // capture the click
    e.preventDefault();
    e.stopImmediatePropagation();

    if ($("input[name='ksk_unit']").val() == '') {
      alert('Mohon Pilih Unit terlebih dahulu');
    } else if ($("input[name='ksk_staff']").val() == '') {
      alert('Mohon pilih Staff terlebih dahulu');
    } else if (($("#ksk_kondisi2").is(':checked') || $("#ksk_kondisi3").is(':checked')) && $("#ksk_kondisi_txt").val() == '') {
      alert('Mohon Isi Saran perbaikan untuk Kondisi Saat ini');
    } else if ($("#ksk_deskripsi").val() == '' || $("#ksk_deskripsi2").val() == '' || $("#ksk_deskripsi3").val() == '') {
      alert('Mohon isi Deskripsi Foto depan, ruangan, dan samping terlebih dahulu');
    } else if ($('#ksk_img1').get(0).files.length === 0 || $('#ksk_img2').get(0).files.length === 0 || $('#ksk_img3').get(0).files.length === 0) {
      alert('Mohon pilih gambar terlebih dahulu');
    } else if ($('#ksk_img1').get(0).files[0].size > 800000) {
      alert('Ukuran gambar tampak depan yang diupload tidak boleh diatas 800KB');
    } else if ($('#ksk_img2').get(0).files[0].size > 800000) {
      alert('Ukuran gambar ruangan yang diupload tidak boleh diatas 800KB');
    } else if ($('#ksk_img3').get(0).files[0].size > 800000) {
      alert('Ukuran gambar tampak samping yang diupload tidak boleh diatas 800KB');
    } else {
      $("#form_add_ksk").submit();
    }
  });

  $("#form_edit_ksk").submit(function(e) { // capture the click
    e.preventDefault();
    e.stopImmediatePropagation();

    if ($("input[name='ksk_unit']").val() == '') {
      alert('Mohon Pilih Unit terlebih dahulu');
    } else if ($("input[name='ksk_staff']").val() == '') {
      alert('Mohon pilih Staff terlebih dahulu');
    } else if ($("#e_ksk_posisi").val() == '') {
      alert('Mohon Pilih Posisi Sekretariat terlebih dahulu');
    } else if ($("#e_ksk_deskripsi").val() == '' || $("#e_ksk_deskripsi2").val() == '' || $("#e_ksk_deskripsi3").val() == '') {
      alert('Mohon isi Deskripsi Foto depan, ruangan, dan samping terlebih dahulu');
    } else {
      $("#form_edit_ksk").submit();
    }
  });


  $("#form_view_ksk").submit(function(e) { // capture the click
    e.preventDefault();
    e.stopImmediatePropagation();
    $("#form_view_ksk").submit();

  });


  $("#ksk_img1").change(function() {
    readURLimage(this, 'ksk_img1_img');
  });
  $("#ksk_img2").change(function() {
    readURLimage(this, 'ksk_img2_img');
  });
  $("#ksk_img3").change(function() {
    readURLimage(this, 'ksk_img3_img');
  });

  $("#e_ksk_img1").change(function() {
    readURLimage(this, 'e_ksk_img1_img');
  });
  $("#e_ksk_img2").change(function() {
    readURLimage(this, 'e_ksk_img2_img');
  });
  $("#e_ksk_img3").change(function() {
    readURLimage(this, 'e_ksk_img3_img');
  });
  $("#e_ksk_img4").change(function() {
    readURLimage(this, 'e_ksk_img4_img');
  });
  $("#e_ksk_img5").change(function() {
    readURLimage(this, 'e_ksk_img5_img');
  });
  $("#e_ksk_img6").change(function() {
    readURLimage(this, 'e_ksk_img6_img');
  });

  function readURLimage(input, img) {
    console.log(input);
    console.log(img);
    if (input.files && input.files[0]) {
      var reader = new FileReader();

      reader.onload = function(e) {
        $('#' + img).attr('src', e.target.result);
      }

      reader.readAsDataURL(input.files[0]);
    }
  }


  function toggleFullscreen(event) {
    var element = document.getElementById(event);

    if (event instanceof HTMLElement) {
      element = event;
    }

    var isFullscreen = document.webkitIsFullScreen || document.mozFullScreen || false;

    element.requestFullScreen = element.requestFullScreen || element.webkitRequestFullScreen || element.mozRequestFullScreen || function() {
      return false;
    };
    document.cancelFullScreen = document.cancelFullScreen || document.webkitCancelFullScreen || document.mozCancelFullScreen || function() {
      return false;
    };

    if (isFullscreen) {
      document.cancelFullScreen();
    } else {
      element.requestFullScreen();
    }
  }
</script>