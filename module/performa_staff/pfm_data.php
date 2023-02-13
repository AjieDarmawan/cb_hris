<?php require('module/performa_staff/pfm_act.php'); ?>
<!-- Content Header (Page header) -->



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
              /*if (($kar_data['kar_id'] == "69") ||
                ($kar_data['kar_id'] == "273") ||
                ($kar_data['kar_id'] == "248") ||
                ($kar_data['kar_id'] == "255") ||
                ($kar_data['kar_id'] == "410") ||
                ($kar_data['kar_id'] == "534") ||
                ($kar_data['kar_id'] == "421")
              ) {*/
              ?>
              <div class="form-group">
                <span class="btn btn-md btn-primary" data-toggle="modal" data-target="#inputperf"><i class="fa fa-plus"></i> Add</span>
              </div>
              <?php //} 
              ?>
              <div class="form-group">
                <?php
                if (!empty($_SESSION['priode1']) || !empty($_SESSION['priode2']) || !empty($_SESSION['pts']) || !empty($_SESSION['staff']) || !empty($_SESSION['wilayah'])) {
                  $filter_aktif = " : <em>Active</em>";
                }
                ?>
                <span class="btn btn-md btn-warning" data-toggle="modal" data-target="#filterperf"><i class="fa fa-search"></i> Filter <?php echo $filter_aktif; ?></span>
              </div>
              <div class="form-group">
                <button type="submit" name="brefreshperf" data-toggle="tooltip" class="btn btn-md btn-default" title="Kembali ke default, kosongkan Filter"><i class="fa fa-refresh"></i></button>
              </div>
            </form>
            <?php //echo $_SESSION['priode1']." / ".$_SESSION['priode2']." / ".$_SESSION['pts']." / ".$_SESSION['program'];
            ?>
          </h3>
          <div class="pull-right">
            <form class="form-inline" method="post" action="">
              <div class="form-group">
                <!--<input type="hidden" name="tglekspor" id="tglekspor" value="">-->
                <button type="button" onclick="perf_ekspor()" class="btn btn-md btn-success"><i class="fa fa-file-excel-o"></i> Export to Excel</button>
              </div>
            </form>
          </div>
        </div>
        <!-- /.box-header -->
        <div class="box-body">

          <table id="tb_karyawan" class="table table-bordered table-striped table-hover">
            <thead>
              <tr>
                <th>No</th>
                <th>Tanggal</th>
                <th>Jam</th>
                <th>PIC Test</th>
                <th>Metode Test</th>
                <th>Unit</th>
                <th>Nama Staff</th>
                <th>Topik dan Ringkasan</th>
                <th>Perkembangan</th>
                <th width="7%">Konf. HRD</th>
                <th width="7%">Aksi</th>
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

                $pfm_tampil = $pfm->pfm_tampil_filter($sespriode1, $sespriode2, $sespts, $sesstaff, $seswilayah);
              } else {

                // $pfm_tampil_max = $pfm->pfm_tampil_max();
                // $pfm_data_max = mysql_fetch_assoc($pfm_tampil_max);
                // $tgl_terakhir = $pfm_data_max['tgl_terakhir'];

                // $pfm_tampil = $pfm->pfm_tampil($tgl_terakhir);
                $pfm_tampil = $pfm->pfm_tampil_all();
              }
              $no = 1;
              while ($data = mysql_fetch_assoc($pfm_tampil)) {

                $ktr_id_pfm = $data['pfm_unit'];
                $ktr_tampil_id_pfm = $ktr->ktr_tampil_id($ktr_id_pfm);
                $ktr_data_pfm = mysql_fetch_assoc($ktr_tampil_id_pfm);

                $kar_id_staff = $data['pfm_staff'];
                $kar_tampil_id_staff = $kar->kar_tampil_id($kar_id_staff);
                $kar_data_staff = mysql_fetch_assoc($kar_tampil_id_staff);

                $perkembangan = '';
                if ($data['pfm_perkembangan'] == 'Menurun') {
                  $perkembangan = '<span class="label label-danger">Menurun</span>';
                } else if ($data['pfm_perkembangan'] == 'Tetap') {
                  $perkembangan = '<span class="label label-warning">Tetap</span>';
                } else if ($data['pfm_perkembangan'] == 'Meningkat') {
                  $perkembangan = '<span class="label label-success">Meningkat</span>';
                }
              ?>
                <tr>
                  <td><small><?php echo $no++ ?></small></td>
                  <td><small><?php echo $tgl->tgl_indo($data['pfm_tgl']); ?></small></td>
                  <td><small><?php echo $data['pfm_waktu']; ?></small></td>
                  <td class="text-blue"><small><?php echo $data['pfm_pic']; ?></small></td>
                  <td><small><?php echo $data['pfm_metode']; ?></small></td>
                  <td class="text-blue"><small><?php echo $ktr_data_pfm['ktr_kd']; ?></small></td>
                  <td class="text-blue"><small><?php echo $kar_data_staff['kar_nm']; ?></small></td>
                  <td><small><?php echo $data['pfm_topic_cat']; ?></small></td>
                  <td><small><?php echo $perkembangan ?></small></td>
                  <td class="text-center">

                    <?php
                    if ($data['pfm_hrd'] == 'Y') {
                      $icon = 'fa fa-check text-success';
                    } else {
                      $icon = 'fa fa-times text-danger';
                    }

                    if (($kar_id == '534' || $kar_id == '248' || $kar_id == '255' || $kar_id == '453' || $kar_id == '37' || $kar_id=="447" || $kar_id=="551" || $kar_id== "542") && $data['pfm_hrd'] == 'N') { ?>

                      <a class="hrd-confirm" href="#block-confirm" data-toggle="modal" data-data="<h4>Yakin rubah Performa <strong><?php echo $kar_data_staff['kar_nm']; ?> <?php echo $data['pfm_tgl']; ?> menjadi Sudah di Konfirmasi HRD </strong>?</h4>" data-url="?p=performa_staff&act=konfirmhrd&id=<?php echo $data['pfm_id']; ?>&pfm_hrd=Y"><i class="<?php echo $icon ?>"></i></a>

                    <?php } else if (($kar_id == '534' || $kar_id == '248' || $kar_id == '255' || $kar_id == '453' || $kar_id == '37' || $kar_id=="447" || $kar_id=="551" || $kar_id== "542") && $data['pfm_hrd'] == 'Y') { ?>

                      <a class="hrd-confirm" href="#block-confirm" data-toggle="modal" data-data="<h4>Yakin rubah Performa <strong><?php echo $kar_data_staff['kar_nm']; ?> <?php echo $data['pfm_tgl']; ?> menjadi Belum di Konfirmasi HRD </strong>?</h4>" data-url="?p=performa_staff&act=konfirmhrd&id=<?php echo $data['pfm_id']; ?>&pfm_hrd=N"><i class="<?php echo $icon ?>"></i></a>

                    <?php } else { ?>

                      <i class="<?php echo $icon ?>"></i>

                    <?php } ?>
                  </td>
                  <td class="text-center">
                    <a href="javascript:;" data-pfm_id="<?php echo $data['pfm_id']; ?>" data-pfm_tgl="<?php echo $data['pfm_tgl']; ?>" data-pfm_metode="<?php echo $data['pfm_metode']; ?>" data-pfm_unit="<?php echo $data['pfm_unit']; ?>" data-pfm_staff="<?php echo $data['pfm_staff']; ?>" data-pfm_waktu="<?php echo $data['pfm_waktu']; ?>" data-pfm_pic="<?php echo $data['pfm_pic']; ?>" data-pfm_topic_cat="<?php echo $data['pfm_topic_cat']; ?>" data-pfm_knowledge="<?php echo $data['pfm_knowledge']; ?>" data-pfm_knowledge_cat="<?php echo $data['pfm_knowledge_cat']; ?>" data-pfm_komunikasi="<?php echo $data['pfm_komunikasi']; ?>" data-pfm_komunikasi_cat="<?php echo $data['pfm_komunikasi_cat']; ?>" data-pfm_closing="<?php echo $data['pfm_closing']; ?>" data-pfm_closing_cat="<?php echo $data['pfm_closing_cat']; ?>" data-pfm_mempengaruhi="<?php echo $data['pfm_mempengaruhi']; ?>" data-pfm_mempengaruhi_cat="<?php echo $data['pfm_mempengaruhi_cat']; ?>" data-pfm_lain_cat="<?php echo $data['pfm_lain_cat']; ?>" data-pfm_arahan_cat="<?php echo $data['pfm_arahan_cat']; ?>" data-pfm_perkembangan="<?php echo $data['pfm_perkembangan']; ?>" data-pfm_pelatihan_cat="<?php echo $data['pfm_pelatihan_cat']; ?>" data-pfm_img=`<?php echo $data['pfm_img']; ?>` data-pfm_hrd="<?php echo $data['pfm_hrd']; ?>" data-toggle="modal" data-target="#viewperf"><i class="fa fa-eye"></i></a>&nbsp;&nbsp;&nbsp;
                    <?php
                    if ($data['pfm_picid'] == $kar_id) {
                    ?>
                      <!-- $pfm_tgl, $pfm_waktu, $pfm_pic, $pfm_metode, $pfm_unit, $pfm_staff, $pfm_topic_cat, $pfm_knowledge, $pfm_knowledge_cat, $pfm_komunikasi, $pfm_komunikasi_cat, $pfm_closing, $pfm_closing_cat, $pfm_mempengaruhi, $pfm_mempengaruhi_cat, $pfm_lain_cat, $pfm_arahan_cat, $pfm_perkembangan, $pfm_crdt -->


                      <a href="javascript:;" data-pfm_id="<?php echo $data['pfm_id']; ?>" data-pfm_tgl="<?php echo $data['pfm_tgl']; ?>" data-pfm_metode="<?php echo $data['pfm_metode']; ?>" data-pfm_unit="<?php echo $data['pfm_unit']; ?>" data-pfm_staff="<?php echo $data['pfm_staff']; ?>" data-pfm_waktu="<?php echo $data['pfm_waktu']; ?>" data-pfm_pic="<?php echo $data['pfm_pic']; ?>" data-pfm_topic_cat="<?php echo $data['pfm_topic_cat']; ?>" data-pfm_knowledge="<?php echo $data['pfm_knowledge']; ?>" data-pfm_knowledge_cat="<?php echo $data['pfm_knowledge_cat']; ?>" data-pfm_komunikasi="<?php echo $data['pfm_komunikasi']; ?>" data-pfm_komunikasi_cat="<?php echo $data['pfm_komunikasi_cat']; ?>" data-pfm_closing="<?php echo $data['pfm_closing']; ?>" data-pfm_closing_cat="<?php echo $data['pfm_closing_cat']; ?>" data-pfm_mempengaruhi="<?php echo $data['pfm_mempengaruhi']; ?>" data-pfm_mempengaruhi_cat="<?php echo $data['pfm_mempengaruhi_cat']; ?>" data-pfm_lain_cat="<?php echo $data['pfm_lain_cat']; ?>" data-pfm_arahan_cat="<?php echo $data['pfm_arahan_cat']; ?>" data-pfm_perkembangan="<?php echo $data['pfm_perkembangan']; ?>" data-pfm_pelatihan_cat="<?php echo $data['pfm_pelatihan_cat']; ?>" data-pfm_img=`<?php echo $data['pfm_img']; ?>` data-toggle="modal" data-target="#editperf"><i class="fa  fa-pencil"></i></a>&nbsp;&nbsp;&nbsp;

                      <a class="delete-performa" href="#delete-confirm" data-toggle="modal" data-data="<h4>Performa <strong><?php echo $kar_data_staff['kar_nm']; ?> <?php echo $data['pfm_tgl']; ?></strong>?</h4>" data-url="?p=performa_staff&act=hapus&id=<?php echo $data['pfm_id']; ?>"><i class="fa fa-trash"></i></a>
                    <?php } ?>
                  </td>
                </tr>
              <?php } ?>
            </tbody>
            <tfoot>
              <tr>
                <th>No</th>
                <th>Tanggal</th>
                <th>Jam</th>
                <th>PIC Test</th>
                <th>Metode Test</th>
                <th>Unit</th>
                <th>Nama Staff</th>
                <th>Topic dan Ringkasan</th>
                <th>Perkembangan</th>
                <th width="7%">Konf. HRD</th>
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



<!-- Modal Input perf -->
<div class="modal fade" id="inputperf" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header bg-primary">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel"><i class="fa fa-plus"></i> Tambah Performa Staff</h4>
      </div>
      <!-- action="" method="post" -->
      <form id="form_add_pfm" class="form-horizontal" enctype="multipart/form-data" method="post">
        <div class="modal-body">

          <div class="row">
            <div class="col-sm-6">

              <div class="form-group">
                <label for="pfm_tgl" class="col-sm-12" style="margin-bottom:10px">Waktu <span class="text-danger">*</span></label>
                <div class="col-sm-7">
                  <div class="input-group">
                    <div class="input-group-addon">
                      <i class="fa fa-calendar"></i>
                    </div>
                    <input type="text" name="pfm_tgl" class="form-control pull-right" placeholder="Tanggal Terbitan" id="dpdays" value="<?php echo date('Y-m-d') ?>" readonly required />
                  </div>
                </div>
                <div class="field_wrapper col-sm-5">
                  <input type="text" name="pfm_waktu" class="form-control timepicker" id="pfm_waktu" value="" placeholder="Jam" required>
                </div>
              </div>

              <div class="form-group">
                <label for="pfm_pic" class="col-sm-12" style="margin-bottom:10px">PIC Test</label>
                <div class="field_wrapper col-sm-12">
                  <input type="hidden" name="pfm_picid" class="form-control" id="pfm_picid" value="<?php echo $kar_data['kar_id'] ?>" placeholder="User Login" readonly>
                  <input type="text" name="pfm_pic" class="form-control" id="pfm_pic" value="<?php echo $kar_data['kar_nm'] ?>" placeholder="User Login" readonly>
                </div>
              </div>

              <div class="form-group">
                <label for="pfm_metode" class="col-sm-12" style="margin-bottom:10px">Metode test</label>
                <div class="col-sm-12">

                  <input type="radio" name="pfm_metode" value="voice" class="flat-red" id="pfm_metode" checked /> <span class="label label-warning">Voice (Telp./WA Call)</span> &nbsp;
                  <input type="radio" name="pfm_metode" value="text" class="flat-red" id="pfm_metode" /> <span class="label label-primary">Text (WA Msg./SMS/Email, dll</span> &nbsp;

                </div>
              </div>

              <!-- 
              <div class="form-group">
                <label for="pfm_pts" class="col-sm-2 control-label">PTS</label>
                <div class="col-sm-10">
                  <div class="bfh-selectbox" data-name="pfm_pts" data-value="" data-filter="true">
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
                <label for="pfm_wilayah" class="col-sm-2 control-label">Wilayah</label>
                <div class="col-sm-10">
                  <div class="col-sm-4 nopadding">
                    <input type="radio" name="pfm_wilayah" value="JABODETABEK" class="flat-red" id="pfm_wilayah" checked /> <span class="label label-default">Jabodetabek</span> &nbsp;<br>
                    <input type="radio" name="pfm_wilayah" value="WIL-BANDUNG" class="flat-red" id="pfm_wilayah" /> <span class="label label-primary">Wil-Bandung</span> &nbsp;
                  </div>
                  <div class="col-sm-4 nopadding">
                    <input type="radio" name="pfm_wilayah" value="LUAR KOTA" class="flat-red" id="pfm_wilayah" /> <span class="label label-danger">Luar Kota</span> &nbsp;<br>
                    <input type="radio" name="pfm_wilayah" value="LUAR JAWA" class="flat-red" id="pfm_wilayah" /> <span class="label label-warning">Luar Jawa</span> &nbsp;
                  </div>
                  <div class="col-sm-4 nopadding">
                    <input type="radio" name="pfm_wilayah" value="SUBANG" class="flat-red" id="pfm_wilayah" /> <span class="label label-primary">Subang</span> &nbsp;
                  </div>
                </div>
              </div> -->

            </div>

            <div class="col-sm-6">



              <div class="form-group">
                <label for="pfm_unit" class="col-sm-12" style="margin-bottom:7px">Kantor/Unit <span class="text-danger">*</span></label>
                <!-- <div class="field_wrapper col-sm-12">
                  <input type="text" name="pfm_unit" class="form-control" id="pfm_unit" value="" placeholder="Unit">
                </div> -->
                <div class="col-sm-12">
                  <div class="bfh-selectbox" data-name="pfm_unit" data-value="" data-filter="true">
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
                <label for="pfm_staff" class="col-sm-12" style="margin-bottom:7px">Nama Staff <span class="text-danger">*</span></label>
                <!-- <div class="field_wrapper col-sm-12">
                  <input type="text" name="pfm_staff" class="form-control" id="pfm_staff" value="" placeholder="Nama Staff">
                </div> -->

                <div class="col-sm-12">
                  <div class="bfh-selectbox" data-name="pfm_staff" data-value="" data-filter="true">
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
          </div>
          <hr>

          <div class="row">
            <div class="col-sm-6">

              <div class="form-group">
                <label for="pfm_topic_cat" class="col-sm-12" style="margin-bottom:10px;">Topic dan Ringkasan Materi Tes <span class="text-danger">*</span></label>
                <div class="col-sm-12">
                  <textarea name="pfm_topic_cat" id="pfm_topic_cat" class="form-control" rows="1" placeholder="Catatan" style="width: 100%; height: 80px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea>
                </div>
              </div>

            </div>

            <div class="col-sm-6">

              <div class="row text-center">
                <label class="col-sm-12 text-left" style="margin-bottom:10px;">Foto/Screenshot Aktifitas/Temuan</label>
                <div class="col-sm-4">
                  <label for="pfm_img1">
                    <div class="card" style="cursor: pointer;">
                      <img src="https://edunitas.com/assets/icon/focus.svg" id="pfm_img1_img" alt="No images" class="card-img-top card-img" style="width:100%; height:80px;object-fit:cover;">
                    </div>
                  </label>
                  <input type="file" name="files[]" id="pfm_img1" style="display:none;">
                </div>
                <div class="col-sm-4">
                  <label for="pfm_img2">
                    <div class="card" style="cursor: pointer;">
                      <img src="https://edunitas.com/assets/icon/focus.svg" id="pfm_img2_img" alt="No images" class="card-img-top card-img" style="width:100%; height:80px;object-fit:cover;">
                    </div>
                  </label>
                  <input type="file" name="files[]" id="pfm_img2" style="display:none;">
                </div>
                <div class="col-sm-4">
                  <label for="pfm_img3">
                    <div class="card" style="cursor: pointer;">
                      <img src="https://edunitas.com/assets/icon/focus.svg" id="pfm_img3_img" alt="No images" class="card-img-top card-img" style="width:100%; height:80px;object-fit:cover;">
                    </div>
                  </label>
                  <input type="file" name="files[]" id="pfm_img3" style="display:none;">
                </div>
              </div>


            </div>

          </div>
          <div class="row">


            <div class="col-sm-6">

              <div class="form-group">
                <label for="pfm_knowledge" class="col-sm-12" style="margin-bottom:10px;">Pemahaman Product Knowledge</label>
                <div class="col-sm-12">
                  <input type="radio" name="pfm_knowledge" value="Kurang" class="flat-red" id="pfm_knowledge" checked /> <span class="label label-danger">Kurang</span> &nbsp;
                  <input type="radio" name="pfm_knowledge" value="Cukup" class="flat-red" id="pfm_knowledge" /> <span class="label label-warning">Cukup</span> &nbsp;
                  <input type="radio" name="pfm_knowledge" value="Bagus" class="flat-red" id="pfm_knowledge" /> <span class="label label-success">Bagus</span> &nbsp;
                </div>
              </div>
              <div class="form-group">
                <div class="col-sm-12">
                  <textarea name="pfm_knowledge_cat" id="pfm_knowledge_cat" class="form-control" rows="1" placeholder="Catatan" style="width: 100%; height: 80px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea>
                </div>
              </div>

            </div>
            <div class="col-sm-6">

              <div class="form-group">
                <label for="pfm_komunikasi" class="col-sm-12" style="margin-bottom:10px;">Komunikasi</label>
                <div class="col-sm-12">
                  <input type="radio" name="pfm_komunikasi" value="Kurang" class="flat-red" id="pfm_komunikasi" checked /> <span class="label label-danger">Kurang</span> &nbsp;
                  <input type="radio" name="pfm_komunikasi" value="Cukup" class="flat-red" id="pfm_komunikasi" /> <span class="label label-warning">Cukup</span> &nbsp;
                  <input type="radio" name="pfm_komunikasi" value="Bagus" class="flat-red" id="pfm_komunikasi" /> <span class="label label-success">Bagus</span> &nbsp;
                </div>
              </div>
              <div class="form-group">
                <div class="col-sm-12">
                  <textarea name="pfm_komunikasi_cat" id="pfm_komunikasi_cat" class="form-control" rows="1" placeholder="Catatan" style="width: 100%; height: 80px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea>
                </div>
              </div>

            </div>
            <div class="col-sm-6">


              <div class="form-group">
                <label for="pfm_closing" class="col-sm-12" style="margin-bottom:10px;">Greget Closing</label>
                <div class="col-sm-12">
                  <input type="radio" name="pfm_closing" value="Kurang" class="flat-red" id="pfm_closing" checked /> <span class="label label-danger">Kurang</span> &nbsp;
                  <input type="radio" name="pfm_closing" value="Cukup" class="flat-red" id="pfm_closing" /> <span class="label label-warning">Cukup</span> &nbsp;
                  <input type="radio" name="pfm_closing" value="Bagus" class="flat-red" id="pfm_closing" /> <span class="label label-success">Bagus</span> &nbsp;
                </div>
              </div>
              <div class="form-group">
                <div class="col-sm-12">
                  <textarea name="pfm_closing_cat" id="pfm_closing_cat" class="form-control" rows="1" placeholder="Catatan" style="width: 100%; height: 80px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea>
                </div>
              </div>

            </div>
            <div class="col-sm-6">


              <div class="form-group">
                <label for="pfm_mempengaruhi" class="col-sm-12" style="margin-bottom:10px;">Kemampuan Mempengaruhi</label>
                <div class="col-sm-12">
                  <input type="radio" name="pfm_mempengaruhi" value="Kurang" class="flat-red" id="pfm_mempengaruhi" checked /> <span class="label label-danger">Kurang</span> &nbsp;
                  <input type="radio" name="pfm_mempengaruhi" value="Cukup" class="flat-red" id="pfm_mempengaruhi" /> <span class="label label-warning">Cukup</span> &nbsp;
                  <input type="radio" name="pfm_mempengaruhi" value="Bagus" class="flat-red" id="pfm_mempengaruhi" /> <span class="label label-success">Bagus</span> &nbsp;
                </div>
              </div>
              <div class="form-group">
                <div class="col-sm-12">
                  <textarea name="pfm_mempengaruhi_cat" id="pfm_mempengaruhi_cat" class="form-control" rows="1" placeholder="Catatan" style="width: 100%; height: 80px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea>
                </div>
              </div>

            </div>
            <div class="col-sm-6">


              <div class="form-group">
                <label for="pfm_lain_cat" class="col-sm-12" style="margin-bottom:10px;">Catatan Lain</label>
                <div class="col-sm-12">
                  <textarea name="pfm_lain_cat" id="pfm_lain_cat" class="form-control" rows="1" placeholder="Catatan" style="width: 100%; height: 80px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea>
                </div>
              </div>

            </div>
            <div class="col-sm-6">


              <div class="form-group">
                <label for="pfm_arahan_cat" class="col-sm-12" style="margin-bottom:10px;">Arahan atau Corrective <span class="text-danger">*</span></label>
                <div class="col-sm-12">
                  <textarea name="pfm_arahan_cat" id="pfm_arahan_cat" class="form-control" rows="1" placeholder="Catatan" style="width: 100%; height: 80px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea>
                </div>
              </div>

            </div>
            <div class="col-sm-6">


              <div class="form-group">
                <label for="pfm_perkembangan" class="col-sm-12" style="margin-bottom:10px;">Perkembangan dari Sebelumnya</label>
                <div class="col-sm-12">
                  <input type="radio" name="pfm_perkembangan" value="Menurun" class="flat-red" id="pfm_perkembangan" checked /> <span class="label label-danger">Menurun</span> &nbsp;
                  <input type="radio" name="pfm_perkembangan" value="Tetap" class="flat-red" id="pfm_perkembangan" /> <span class="label label-warning">Tetap</span> &nbsp;
                  <input type="radio" name="pfm_perkembangan" value="Meningkat" class="flat-red" id="pfm_perkembangan" /> <span class="label label-success">Meningkat</span> &nbsp;
                </div>
              </div>

            </div>

            <div class="col-sm-6">


              <div class="form-group">
                <label for="pfm_pelatihan_cat" class="col-sm-12" style="margin-bottom:10px;">Training atau Pelatihan yang Dibutuhkan <span class="text-danger">*</span></label>
                <div class="col-sm-12">
                  <textarea name="pfm_pelatihan_cat" id="pfm_pelatihan_cat" class="form-control" rows="1" placeholder="Catatan" style="width: 100%; height: 80px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea>
                </div>
              </div>

            </div>

          </div>

        </div>
        <div class="modal-footer">
          <input type="hidden" name="forminput" value="post">
          <button type="submit" name="binputperf" class="btn btn-primary"><i class="fa fa-save"></i></button>
        </div>
      </form>
    </div>
  </div>
</div>


<!-- Modal Edit perf -->
<div class="modal fade" id="editperf" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header bg-primary">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel"><i class="fa fa-pencil"></i> Edit Performa Staff</h4>
      </div>
      <form id="form_edit_pfm" class="form-horizontal" enctype="multipart/form-data" method="post">
        <input type="hidden" name="pfm_id" id="e_pfm_id">
        <div class="modal-body">

          <div class="row">
            <div class="col-sm-6">

              <div class="form-group">
                <label for="pfm_tgl" class="col-sm-12" style="margin-bottom:10px">Waktu</label>
                <div class="col-sm-7">
                  <div class="input-group">
                    <div class="input-group-addon">
                      <i class="fa fa-calendar"></i>
                    </div>
                    <input type="text" name="pfm_tgl" class="form-control pull-right" placeholder="Tanggal Terbitan" id="dpdays2" readonly required />
                  </div>
                </div>
                <div class="field_wrapper col-sm-5">
                  <input type="text" name="pfm_waktu" class="form-control timepicker" id="e_pfm_waktu" value="" placeholder="Jam">
                </div>
              </div>

              <div class="form-group">
                <label for="pfm_pic" class="col-sm-12" style="margin-bottom:10px">PIC Test</label>
                <div class="field_wrapper col-sm-12">
                  <!-- <input type="text" name="pfm_picid" class="form-control" id="e_pfm_picid" value="<?php echo $kar_data['kar_id'] ?>" placeholder="User Login"> -->
                  <input type="text" name="pfm_pic" class="form-control" id="e_pfm_pic" value="<?php echo $kar_data['kar_nm'] ?>" placeholder="User Login" readonly>
                </div>
              </div>

              <div class="form-group">
                <label for="pfm_metode" class="col-sm-12" style="margin-bottom:10px">Metode test</label>
                <div class="col-sm-12">

                  <input type="radio" name="pfm_metode" value="Voice" class="flat-red" id="e_pfm_metode-v" checked /> <span class="label label-warning">Voice (Telp./WA Call)</span> &nbsp;
                  <input type="radio" name="pfm_metode" value="Text" class="flat-red" id="e_pfm_metode-t" /> <span class="label label-primary">Text (WA Msg./SMS/Email, dll</span> &nbsp;

                </div>

              </div>
            </div>

            <div class="col-sm-6">



              <div class="form-group">
                <label for="pfm_unit" class="col-sm-12" style="margin-bottom:7px">Kantor/Unit</label>
                <!-- <div class="field_wrapper col-sm-12">
                  <input type="text" name="pfm_unit" class="form-control" id="e_pfm_unit" value="" placeholder="Unit">
                </div> -->
                <div class="col-sm-12">

                  <select class="form-control" name="pfm_unit" id="e_pfm_unit" required>
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
                <label for="pfm_staff" class="col-sm-12" style="margin-bottom:7px">Nama Staff</label>
                <!-- <div class="field_wrapper col-sm-12">
                  <input type="text" name="pfm_staff" class="form-control" id="e_pfm_staff" value="" placeholder="Nama Staff">
                </div> -->

                <div class="col-sm-12">

                  <select class="form-control" name="pfm_staff" id="e_pfm_staff" required>
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

          <div class="row">
            <div class="col-sm-6">

              <div class="form-group">
                <label for="pfm_topic_cat" class="col-sm-12" style="margin-bottom:10px;">Topic dan Ringkasan Materi Tes</label>
                <div class="col-sm-12">
                  <textarea name="pfm_topic_cat" id="e_pfm_topic_cat" class="form-control" rows="1" placeholder="Catatan" style="width: 100%; height: 80px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea>
                </div>
              </div>

            </div>

            <div class="col-sm-6">

              <div class="row text-center">
                <label class="col-sm-12 text-left" style="margin-bottom:10px;">Foto/Screenshot Aktifitas/Temuan</label>
                <div class="col-sm-4">
                  <label for="e_pfm_img1">
                    <div class="card" style="cursor: pointer;">
                      <img src="https://edunitas.com/assets/icon/focus.svg" id="e_pfm_img1_img" alt="No images" class="card-img-top card-img" style="width:100%; height:80px;object-fit:cover;">
                    </div>
                  </label>
                  <input type="file" name="files[]" id="e_pfm_img1" style="display:none;">
                </div>
                <div class="col-sm-4">
                  <label for="e_pfm_img2">
                    <div class="card" style="cursor: pointer;">
                      <img src="https://edunitas.com/assets/icon/focus.svg" id="e_pfm_img2_img" alt="No images" class="card-img-top card-img" style="width:100%; height:80px;object-fit:cover;">
                    </div>
                  </label>
                  <input type="file" name="files[]" id="e_pfm_img2" style="display:none;">
                </div>
                <div class="col-sm-4">
                  <label for="e_pfm_img3">
                    <div class="card" style="cursor: pointer;">
                      <img src="https://edunitas.com/assets/icon/focus.svg" id="e_pfm_img3_img" alt="No images" class="card-img-top card-img" style="width:100%; height:80px;object-fit:cover;">
                    </div>
                  </label>
                  <input type="file" name="files[]" id="e_pfm_img3" style="display:none;">
                </div>
              </div>

            </div>

          </div>
          <div class="row">


            <div class="col-sm-6">

              <div class="form-group">
                <label for="pfm_knowledge" class="col-sm-12" style="margin-bottom:10px;">Pemahaman Product Knowledge</label>
                <div class="col-sm-12">
                  <input type="radio" name="pfm_knowledge" value="Kurang" class="flat-red" id="e_pfm_knowledge-k" checked /> <span class="label label-danger">Kurang</span> &nbsp;
                  <input type="radio" name="pfm_knowledge" value="Cukup" class="flat-red" id="e_pfm_knowledge-c" /> <span class="label label-warning">Cukup</span> &nbsp;
                  <input type="radio" name="pfm_knowledge" value="Bagus" class="flat-red" id="e_pfm_knowledge-b" /> <span class="label label-success">Bagus</span> &nbsp;
                </div>
              </div>
              <div class="form-group">
                <div class="col-sm-12">
                  <textarea name="pfm_knowledge_cat" id="e_pfm_knowledge_cat" class="form-control" rows="1" placeholder="Catatan" style="width: 100%; height: 80px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea>
                </div>
              </div>

            </div>
            <div class="col-sm-6">

              <div class="form-group">
                <label for="pfm_komunikasi" class="col-sm-12" style="margin-bottom:10px;">Komunikasi</label>
                <div class="col-sm-12">
                  <input type="radio" name="pfm_komunikasi" value="Kurang" class="flat-red" id="e_pfm_komunikasi-k" checked /> <span class="label label-danger">Kurang</span> &nbsp;
                  <input type="radio" name="pfm_komunikasi" value="Cukup" class="flat-red" id="e_pfm_komunikasi-c" /> <span class="label label-warning">Cukup</span> &nbsp;
                  <input type="radio" name="pfm_komunikasi" value="Bagus" class="flat-red" id="e_pfm_komunikasi-b" /> <span class="label label-success">Bagus</span> &nbsp;
                </div>
              </div>
              <div class="form-group">
                <div class="col-sm-12">
                  <textarea name="pfm_komunikasi_cat" id="e_pfm_komunikasi_cat" class="form-control" rows="1" placeholder="Catatan" style="width: 100%; height: 80px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea>
                </div>
              </div>

            </div>
            <div class="col-sm-6">


              <div class="form-group">
                <label for="pfm_closing" class="col-sm-12" style="margin-bottom:10px;">Greget Closing</label>
                <div class="col-sm-12">
                  <input type="radio" name="pfm_closing" value="Kurang" class="flat-red" id="e_pfm_closing-k" checked /> <span class="label label-danger">Kurang</span> &nbsp;
                  <input type="radio" name="pfm_closing" value="Cukup" class="flat-red" id="e_pfm_closing-c" /> <span class="label label-warning">Cukup</span> &nbsp;
                  <input type="radio" name="pfm_closing" value="Bagus" class="flat-red" id="e_pfm_closing-b" /> <span class="label label-success">Bagus</span> &nbsp;
                </div>
              </div>
              <div class="form-group">
                <div class="col-sm-12">
                  <textarea name="pfm_closing_cat" id="e_pfm_closing_cat" class="form-control" rows="1" placeholder="Catatan" style="width: 100%; height: 80px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea>
                </div>
              </div>

            </div>
            <div class="col-sm-6">


              <div class="form-group">
                <label for="pfm_mempengaruhi" class="col-sm-12" style="margin-bottom:10px;">Kemampuan Mempengaruhi</label>
                <div class="col-sm-12">
                  <input type="radio" name="pfm_mempengaruhi" value="Kurang" class="flat-red" id="e_pfm_mempengaruhi-k" checked /> <span class="label label-danger">Kurang</span> &nbsp;
                  <input type="radio" name="pfm_mempengaruhi" value="Cukup" class="flat-red" id="e_pfm_mempengaruhi-c" /> <span class="label label-warning">Cukup</span> &nbsp;
                  <input type="radio" name="pfm_mempengaruhi" value="Bagus" class="flat-red" id="e_pfm_mempengaruhi-b" /> <span class="label label-success">Bagus</span> &nbsp;
                </div>
              </div>
              <div class="form-group">
                <div class="col-sm-12">
                  <textarea name="pfm_mempengaruhi_cat" id="e_pfm_mempengaruhi_cat" class="form-control" rows="1" placeholder="Catatan" style="width: 100%; height: 80px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea>
                </div>
              </div>

            </div>
            <div class="col-sm-6">


              <div class="form-group">
                <label for="pfm_lain_cat" class="col-sm-12" style="margin-bottom:10px;">Catatan Lain</label>
                <div class="col-sm-12">
                  <textarea name="pfm_lain_cat" id="e_pfm_lain_cat" class="form-control" rows="1" placeholder="Catatan" style="width: 100%; height: 80px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea>
                </div>
              </div>

            </div>
            <div class="col-sm-6">


              <div class="form-group">
                <label for="pfm_arahan_cat" class="col-sm-12" style="margin-bottom:10px;">Arahan atau Corrective</label>
                <div class="col-sm-12">
                  <textarea name="pfm_arahan_cat" id="e_pfm_arahan_cat" class="form-control" rows="1" placeholder="Catatan" style="width: 100%; height: 80px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea>
                </div>
              </div>

            </div>
            <div class="col-sm-6">


              <div class="form-group">
                <label for="pfm_perkembangan" class="col-sm-12" style="margin-bottom:10px;">Perkembangan dari Sebelumnya</label>
                <div class="col-sm-12">
                  <input type="radio" name="pfm_perkembangan" value="Menurun" class="flat-red" id="e_pfm_perkembangan-k" checked /> <span class="label label-danger">Menurun</span> &nbsp;
                  <input type="radio" name="pfm_perkembangan" value="Tetap" class="flat-red" id="e_pfm_perkembangan-c" /> <span class="label label-warning">Tetap</span> &nbsp;
                  <input type="radio" name="pfm_perkembangan" value="Meningkat" class="flat-red" id="e_pfm_perkembangan-b" /> <span class="label label-success">Meningkat</span> &nbsp;
                </div>
              </div>

            </div>


            <div class="col-sm-6">


              <div class="form-group">
                <label for="pfm_pelatihan_cat" class="col-sm-12" style="margin-bottom:10px;">Training atau Pelatihan yang Dibutuhkan <span class="text-danger">*</span></label>
                <div class="col-sm-12">
                  <textarea name="pfm_pelatihan_cat" id="e_pfm_pelatihan_cat" class="form-control" rows="1" placeholder="Catatan" style="width: 100%; height: 80px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea>
                </div>
              </div>

            </div>

          </div>

        </div>
        <div class="modal-footer">
          <input type="hidden" name="forminput" value="put">
          <button type="submit" name="beditperf" class="btn btn-primary"><i class="fa fa-save"></i></button>
        </div>
      </form>
    </div>
  </div>
</div>


<!-- Modal View perf -->
<div class="modal fade" id="viewperf" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header bg-primary">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel"><i class="fa fa-file"></i> &nbsp;View Performa Staff</h4>
      </div>
      <form id="form_view_pfm" class="form-horizontal" enctype="multipart/form-data" method="post">
        <input type="hidden" name="pfm_id" id="v_pfm_id">
        <div class="modal-body">

          <form class="form-horizontal" action="" method="post">
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
                    <h3><u>PERFORMA STAFF</u></h3>
                    <span id="v_pfm_hrd" class="label label-danger" style="font-size:13px;"> Unconfirmed by HRD </span>
                  </center>

                  <div class="col-md-12 text-center">
                  </div>
                  <div class="col-sm-8 invoice-col">
                    <address>
                      <strong id="v_pfm_pic">Nama PIC</strong><br>
                      Kantor/Unit : <span id="v_pfm_unit_label">Kantor/Unit</span><br>
                      Staff : <span id="v_pfm_staff_label">Staff</span><br>
                    </address>
                  </div><!-- /.col -->

                  <div class="col-sm-4 invoice-col">
                    <div class="row">
                      <div class="col-md-12 text-center">
                        Date : <strong id="v_pfm_waktu"> waktu </strong><br>
                        Metode : <b><span id="v_pfm_metode" class="text-danger"> metode </span></b>
                      </div>
                      <div class="col-md-12 text-center" style="margin-top:10px">
                        <div id="v_pfm_perkembangan" class="label label-danger text-center" style="font-size:13px;">
                          Kurang
                        </div>
                      </div>
                    </div>
                  </div><!-- /.col -->
                </div><!-- /.row -->

                <!-- Table row -->
                <div class="row" style="margin-top:10px">
                  <div class="col-xs-12 table-responsive">

                    <table class="table">
                      <tbody>

                        <tr>
                          <th colspan="4"><small>Topic dan Ringkasan Materi Tes</small></th>
                        </tr>
                        <tr>
                          <td colspan="4"><span id="v_pfm_topic_cat">Catatan</span></td>
                        </tr>
                        <tr>
                          <td colspan="4"><span> </span></td>
                        </tr>
                        <tr>
                          <th colspan="2"><small>List Test</small></th>
                          <th><small>Catatan</small></th>
                          <th><small>Nilai</small></th>
                        </tr>
                        <tr class="info">
                          <th colspan="4"><small>Laporan dan Rincian Hasil Test</small></th>
                        </tr>
                        <tr>
                          <td><i class="fa fa-check-square-o"></i></td>
                          <td>Pemahaman Product Knowledge</td>
                          <td><span id="v_pfm_knowledge_cat">Catatan</span></td>
                          <td><span id="v_pfm_knowledge" class="label label-danger">Kurang</span></td>
                        </tr>
                        <tr>
                          <td><i class="fa fa-check-square-o"></i></td>
                          <td>Komunikasi</td>
                          <td><span id="v_pfm_komunikasi_cat">Catatan</span></td>
                          <td><span id="v_pfm_komunikasi" class="label label-danger">Kurang</span></td>
                        </tr>
                        <tr>
                          <td><i class="fa fa-check-square-o"></i></td>
                          <td>Greget Closing</td>
                          <td><span id="v_pfm_closing_cat">Catatan</span></td>
                          <td><span id="v_pfm_closing" class="label label-danger">Kurang</span></td>
                        </tr>
                        <tr>
                          <td><i class="fa fa-check-square-o"></i></td>
                          <td>Kemampuan Mempengaruhi</td>
                          <td><span id="v_pfm_mempengaruhi_cat">Catatan</span></td>
                          <td><span id="v_pfm_mempengaruhi" class="label label-danger">Kurang</span></td>
                        </tr>
                        <tr class="warning">
                          <th colspan="4"><small>Catatan Lain</small></th>
                        </tr>
                        <tr>
                          <td colspan="4"><span id="v_pfm_lain_cat">Catatan</span></td>
                        </tr>
                        <tr class="danger">
                          <th colspan="4"><small>Arahan atau Corrective</small></th>
                        </tr>
                        <tr class="">
                          <td colspan="4"><span id="v_pfm_arahan_cat">Catatan</span></td>
                        </tr>
                        <tr class="success">
                          <th colspan="4"><small>Training atau Pelatihan yang DIbutuhkan</small></th>
                        </tr>
                        <tr class="">
                          <td colspan="4"><span id="v_pfm_pelatihan_cat">Catatan</span></td>
                        </tr>
                      </tbody>
                    </table>

                  </div><!-- /.col -->
                </div><!-- /.row -->

                <div class="row text-center">
                  <b><small class="col-sm-12 text-left" style="margin-bottom:20px; margin-left:10px;">Foto/Screenshot Aktifitas/Temuan</small></b>
                  <div class="col-sm-4">
                    <div class="card" style="cursor: pointer;" onclick="toggleFullscreen('v_pfm_img1_img');">
                      <img src="" id="v_pfm_img1_img" alt="Temuan 1" class="card-img-top card-img" style="width:100%; height:150px;object-fit:cover;">
                    </div>
                  </div>
                  <div class="col-sm-4">
                    <div class="card" style="cursor: pointer;" onclick="toggleFullscreen('v_pfm_img2_img');">
                      <img src="" id="v_pfm_img2_img" alt="Temuan 2" class="card-img-top card-img" style="width:100%; height:150px;object-fit:cover;">
                    </div>
                  </div>
                  <div class="col-sm-4">
                    <div class="card" style="cursor: pointer;" onclick="toggleFullscreen('v_pfm_img3_img');">
                      <img src="" id="v_pfm_img3_img" alt="Temuan 3" class="card-img-top card-img" style="width:100%; height:150px;object-fit:cover;">
                    </div>
                  </div>
                </div>

              </div><!-- /.content -->
              <div class="clearfix"></div>
            </div>
          </form>

          <div class="row" style="display:none">

            <div class="col-sm-6">

              <div class="form-group">
                <label for="pfm_unit" class="col-sm-12" style="margin-bottom:7px">Kantor/Unit</label>
                <!-- <div class="field_wrapper col-sm-12">
                  <input type="text" name="pfm_unit" class="form-control" id="v_pfm_unit" value="" placeholder="Unit">
                </div> -->
                <div class="col-sm-12">

                  <select class="form-control" name="pfm_unit" id="v_pfm_unit" required>
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
                <label for="pfm_staff" class="col-sm-12" style="margin-bottom:7px">Nama Staff</label>
                <!-- <div class="field_wrapper col-sm-12">
                  <input type="text" name="pfm_staff" class="form-control" id="v_pfm_staff" value="" placeholder="Nama Staff">
                </div> -->

                <div class="col-sm-12">

                  <select class="form-control" name="pfm_staff" id="v_pfm_staff" required>
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
      </form>
    </div>
  </div>
</div>


<!-- Modal Filter filterperf -->
<div class="modal fade" id="filterperf" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header bg-yellow">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel"><i class="fa fa-filter"></i> Filter perf</h4>
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
          <button type="submit" name="bfilterperf" class="btn btn-warning"><i class="fa fa-search"></i></button>
        </div>
      </form>
    </div>
  </div>
</div>
<script>
  $("#form_add_pfm").submit(function(e) { // capture the click
    e.preventDefault();
    e.stopImmediatePropagation();

    if ($("#dpdays").val() == '') {
      alert('Lengkapi Tanggal terlebih dahulu');
    } else if ($("#pfm_waktu").val() == '') {
      alert('Mohon isi waktu terlebih dahulu');
    } else if ($("input[name='pfm_unit']").val() == '') {
      alert('Mohon Pilih Unit terlebih dahulu');
    } else if ($("input[name='pmf_staff']").val() == '') {
      alert('Mohon pilih Staff terlebih dahulu');
    } else if ($("#pfm_topic_cat").val() == '') {
      alert('Mohon isi Topik terlebih dahulu');
    } else if ($("#pfm_arahan_cat").val() == '') {
      alert('Mohon isi Arahan terlebih dahulu');
    } else {
      $("#form_add_pfm").submit();
    }
  });

  $("#form_edit_pfm").submit(function(e) { // capture the click
    e.preventDefault();
    e.stopImmediatePropagation();

    if ($("#dpdays2").val() == '') {
      alert('Lengkapi Tanggal terlebih dahulu');
    } else if ($("#e_pfm_waktu").val() == '') {
      alert('Mohon isi waktu terlebih dahulu');
    } else if ($("#e_pfm_unit").val() == '') {
      alert('Mohon Pilih Unit terlebih dahulu');
    } else if ($("e_pmf_staff").val() == '') {
      alert('Mohon pilih Staff terlebih dahulu');
    } else if ($("#e_pfm_topic_cat").val() == '') {
      alert('Mohon isi Topik terlebih dahulu');
    } else if ($("#e_pfm_arahan_cat").val() == '') {
      alert('Mohon isi Arahan terlebih dahulu');
    } else {
      $("#form_edit_pfm").submit();
    }
  });

  $("#pfm_img1").change(function() {
    readURLimage(this, 'pfm_img1_img');
  });
  $("#pfm_img2").change(function() {
    readURLimage(this, 'pfm_img2_img');
  });
  $("#pfm_img3").change(function() {
    readURLimage(this, 'pfm_img3_img');
  });
  $("#e_pfm_img1").change(function() {
    readURLimage(this, 'e_pfm_img1_img');
  });
  $("#e_pfm_img2").change(function() {
    readURLimage(this, 'e_pfm_img2_img');
  });
  $("#e_pfm_img3").change(function() {
    readURLimage(this, 'e_pfm_img3_img');
  });

  function readURLimage(input, img) {
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