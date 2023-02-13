
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
    <li><a href="media.php"><i class="fa fa-dashboard"></i> Dashboard</a></li>
    <li><a href="?p=history_izin">Data Izin</a></li>
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
                <a href="?p=form-pelamar" class="btn btn-success">Tambah Pelamar</a>

                <a href="?p=form-pelamar" class="btn btn-success">Upload Data Excel Pelamar</a>
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
                <th>Tgl</th>
                <th>Masuk</th>
                <th>Pulang</th>
                <th>Nama</th>
                <th>Divisi</th>
                <th>Jarak</th>
                <th>Lihat</th>
               
              </tr>

            </thead>
            <tbody>



              <?php
              $absen_list = $mon_absen->list_absen_hari();
              $no = 1;
              while ($data = mysql_fetch_array($absen_list)) {
              ?>
                <tr>
                  <td><?php echo $no++; ?></td>
                  <td><?php echo $data['abs_tgl_masuk']; ?></td>
                  <td><?php echo $data['abs_masuk']; ?></td>
                  <td><?php echo $data['abs_pulang']; ?></td>
                  <td><?php echo $data['kar_nm']; ?></td>
                  <td><?php echo $data['div_nm']; ?></td>
                  <td><?php echo $data['jarak']; ?> M</td>
                  <td><a href="?p=cek_posisi_absen" class="btn btn-success btn-sm">Lihat Posisi</a></td>
              
                 
                
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
