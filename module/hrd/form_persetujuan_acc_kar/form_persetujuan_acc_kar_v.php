<?php require('module/hrd/act_ajax_status.php'); ?>
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
                <th>Lowongan</th>
                <th>Nama</th>
                <th>Jenis Kelamin</th>
                <th>Tempat Lahir</th>

                <th>Alamat</th>
                <th>No Wa</th>
                <th>Lihat Cv</th>
                <th>Status</th>
              </tr>

            </thead>
            <tbody>



              <?php
                $no++;
              $pelamar_acc = $pelamar->kar_acc_pengajuan_pelamar();
                foreach($pelamar_acc as $data){
              ?>
                <tr>
                  <td><?php echo $no++; ?></td>
                  <td><?php echo $data['lowongan']; ?></td>
                  <td><?php echo $data['nama']; ?></td>
                  <td><?php echo $data['jk']; ?></td>
                  <td><?php echo $data['tmpt_lahir']; ?> - <?php echo $data['tgl_lahir']; ?>  </td>
                  <td><?php echo $data['alamat']; ?></td>
                  <td><?php echo $data['no_wa']; ?></td>
                  <td><a target="_blank" href="module/cv/<?php echo $data['cv']; ?>">Lihat Cv</a></td>
                  <td>   <a href="?p=pelamar_form_karyawan_acc&pelamar_id=<?php echo $data['pelamar_id']; ?>" class="btn btn-primary btn-sm" >Lihat Form Karyawan</a></td>

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