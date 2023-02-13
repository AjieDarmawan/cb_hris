<?php

error_reporting(0);
?>
<!-- Content Header (Page header) -->
<section class="content-header">
  <h1> <?php echo $title; ?>
    <small>
      <?php
      echo $tgl->tgl_indo($izn_kirim);
      ?>
    </small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="media.php"><i class="fa fa-dashboard"></i> Pembinaan Karyawan</a></li>
    <li><a href="?p=history_izin">Pembinaan Karyawan</a></li>
    <li class="active"><?php echo $title; ?> </li>
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

          </h3>
          <div class="pull-right">
            <form class="form-inline" method="post" action="">
              <div class="form-group">
                <a href="#" class="btn btn-md btn-default"><i class="fa fa-print"></i></a>
                <!-- <a href="?p=form-pembinaan-coaching" class="btn btn-success">Pembinaan Karyawan</a> -->
                <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#myModal" title="Create Posting"><i class="fa fa-pencil"></i> Pembinaan Karyawan</button>
              </div>

              <div class="input-group">
                <div class="input-group-addon">
                  <i class="fa fa-calendar"></i>
                </div>
                <input type="text" name="tanggal_absen_history" class="form-control pull-right" placeholder="Sortir Izin" id="dpdays" readonly />
              </div>

              <div class="form-group">
                <button type="submit" name="bsortir_history" class="btn btn-md btn-default"><i class="fa fa-eye"></i> View</a></button>
              </div>

              <div class="form-group">
                <button type="submit" name="brefresh_history" data-toggle="tooltip" class="btn btn-md btn-default" title="Kembali ke default <?php echo $tgl->tgl_indo($date); ?>"><i class="fa fa-refresh"></i></button>
              </div>
            </form>
          </div>
        </div>
        <!-- /.box-header -->

        <div class="box-body">
          <table id="tb_history_izin" class="table table-bordered table-striped table-hover">
            <thead>
              <tr>
                <th>No</th>
                <th>Nama </th>
                <th>Nama Pembinaan</th>
                <th>Tanggal </th>
                <th>Tempat</th>
                <th>Arahan</th>


              </tr>

            </thead>
            <tbody>



              <?php
              $coaching = $pelamar->coaching_kar_list($izn_kirim);
              $no = 1;
              while ($data = mysql_fetch_array($coaching)) {
              ?>
                <tr>
                  <td><?php echo $no++; ?></td>
                  <td><?php echo $data['nama']; ?></td>
                  <td><?php echo $data['nama_pembina']; ?></td>
                  <td><?php echo $data['tanggal']; ?></td>
                  <td><?php echo $data['tempat']; ?></td>
                  <td><?php echo $data['masukan']; ?></td>



                </tr>
              <?php
              }

              ?>



            </tbody>
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



<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header bg-primary">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel"><i class="fa fa-pencil-square-o"></i> Create Posting</h4>
      </div>
      <form role="form" action="" method="post" enctype="multipart/form-data">

        <div class="form-group">
          <label>Nama Yang Di Coaching</label>
          <!-- <input type="text" class="form-control" required name="nama" placeholder="Masukan Nama .."> -->
          <select class="form-control" required name="nama" data-value="" data-filter="true">
            <option value="">--Pilih--</option>
            <?php
            $karyawan = $kar->kar_tampil();
            foreach ($karyawan as $data_karyawan) {
            ?>

              <option value="<?php echo $data_karyawan['kar_id'] ?>"><?php echo $data_karyawan['kar_nm'] ?></option>


            <?php
            }
            ?>
          </select>
        </div>


        <div class="form-group">
          <label>Nama Pembina</label>
          <!-- <input type="text" class="form-control" required name="pembina" placeholder="Masukan Nama"> -->
          <select class="form-control" required name="pembina" data-value="" data-filter="true">
            <option value="">--Pilih--</option>
            <?php
            $karyawan = $kar->kar_tampil();
            foreach ($karyawan as $data_karyawan) {
            ?>

              <option value="<?php echo $data_karyawan['kar_id'] ?>"><?php echo $data_karyawan['kar_nm'] ?></option>


            <?php
            }
            ?>
          </select>
        </div>



        <div class="form-group">
          <label>Tanggal</label>
          <input type="date" class="form-control" required name="tanggal">
        </div>

        <div class="form-group">
          <label>Tempat</label>
          <input type="text" class="form-control" required name="tempat" placeholder="Lokasi Coaching">
        </div>

        <div class="form-group">
          <label>Masukan / Arahan</label>
          <textarea type="text" class="form-control" rows="3" required name="masukan"></textarea>
        </div>








        <button type="submit" name="bsave" class="btn btn-primary">Simpan</button>


      </form>
    </div>
  </div>
</div>