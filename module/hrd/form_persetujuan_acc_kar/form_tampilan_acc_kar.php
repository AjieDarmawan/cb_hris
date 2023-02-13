<?php require('module/hrd/form_persetujuan_acc_kar/act_acc_ttd.php');
$pel_id = $_GET['pelamar_id'];
$kar_data2 = $pelamar->pelamar_id_detail($pel_id);

$pelamar_acc_form_rekomen_detail = $pelamar->pelamar_acc_form_rekomen_detail($pel_id);
$pelamar_acc = mysql_fetch_array($pelamar_acc_form_rekomen_detail);

// echo "<pre>";
// print_r($pelamar_acc);
// die;

$kar_data_ = mysql_fetch_array($kar_data2);


$kar_data_form = $pelamar->pelamar_form_rekomendasi_detail($pel_id);

$kar_data_form2 = mysql_fetch_array($kar_data_form);




// echo "<pre>";
// print_r($kar_data_)
?>
<?php //if($fpk_cek_id > 0){
?>
<!-- Content Header (Page header) -->
<section class="content-header">
  <h1> <?php echo $title . " - " . $kar_data_['nama']; ?> <small></small> </h1>
  <ol class="breadcrumb">
    <li><a href="media.php"><i class="fa fa-dashboard"></i> Dashboard</a></li>
    <li class="active"><?php echo $title; ?></li>
  </ol>
</section>
<!--
    <div class="row">
    <div class="col-xs-6">-->
<form class="form-horizontal" action="" method="post">


  <!-- Main content -->
  <section class="invoice col-md-8">
    <!-- title row -->
    <div class="row">
      <div class="col-sm-12 col-md-10">
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
      <div class="col-sm-12 col-md-2">
        <center><img src="module/cv/profile_pelamar/<?php echo $kar_data_form2['photo']; ?>" width="100" height="125"></center>
      </div>
    </div>
    <!-- info row -->
    <div class="row invoice-info">
      <center>
        <h3 style="margin-bottom: 20px;"><u>Identitas Calon Tenaga Kerja</u></h3>
      </center>

      <!-- <div class="col-sm-8 invoice-col">
        <address>
          <strong><?php echo $kar_data_['kar_nm']; ?></strong><br>
          NIK: <?php echo $kar_data_['kar_nik']; ?><br>
          Divisi: <?php echo $kar_data_['div_nm']; ?> / <?php echo $kar_data_['jbt_nm']; ?><br>
          Location: <?php echo $kar_data_['unt_nm']; ?> / <?php echo $kar_data_['ktr_nm']; ?><br>
        </address>
      </div> -->



      <div class="container">
        <table class="col-sm-8 invoice-col">
          <tr>
            <td>Nama</td>
            <td style="
    padding-right: 10px;
">:</td>
            <td><?php echo $kar_data_['nama']; ?></td>
          </tr>

          <tr>
            <td>Jenis Kelamin</td>
            <td>:</td>
            <td><?php echo $kar_data_['jk'] ? 'Laki - Laki' : 'Perempuan'; ?></td>
          </tr>

          <tr>
            <td>Tempat/Tgl/Lahir/Umur</td>
            <td>:</td>
            <td><?php echo $kar_data_['tmpt_lahir']; ?> - <?php echo $tgl->tgl_indo($kar_data_['tgl_lahir']); ?> - <?php echo $umr->hitung_umur($kar_data_['tgl_lahir']); ?> Tahun </td>
          </tr>

          <tr>
            <td>Alamat</td>
            <td>:</td>
            <td><?php echo $kar_data_['alamat']; ?></td>
          </tr>

          <tr>
            <td>Pendidikan Terakhir</td>
            <td>:</td>
            <td><?php echo $kar_data_form2['pendidikan']; ?></td>
          </tr>

          <tr>
            <td>Pengalaman Kerja</td>
            <td>:</td>
            <td><?php echo $kar_data_form2['pengalaman_kerja']; ?></td>
          </tr>

          <tr>
            <td>Posisi Jabatan</td>
            <td>:</td>
            <td><?php
                $jabatan = $jbt->jbt_tampil_id($kar_data_form2['jbt_id']);

                $jabatan2  = mysql_fetch_array($jabatan);

                echo $jabatan2['jbt_nm'];
                ?></td>
          </tr>

          <tr>
            <td>Sumber Loker</td>
            <td>:</td>
            <td><?php echo $kar_data_form2['sumber_loker']; ?></td>
          </tr>

          <tr>
            <td>Divisi</td>
            <td>:</td>
            <td>
              <?php
              $divisi = $div->div_tampil_id_($kar_data_form2['div_id']);

              $divisi2  = mysql_fetch_array($divisi);

              echo $divisi2['div_nm'];

              ?>


            </td>
          </tr>

          <tr>
            <td>Penempatan</td>
            <td>:</td>
            <td> <?php
                  $Kantor = $ktr->ktr_tampil_id($kar_data_form2['ktr_id']);

                  $Kantor2  = mysql_fetch_array($Kantor);


                  // echo "<pre>";
                  // print_r($Kantor2);

                  echo $Kantor2['ktr_nm'];

                  ?></td>
          </tr>

          <tr>
            <td>Gaji</td>
            <td>:</td>
            <td>_____</td>
          </tr>

          <tr>
            <td>Status Pegawai</td>
            <td>:</td>
            <td>Kontrak</td>
          </tr>

          <tr>
            <td>User Absen</td>
            <td>:</td>
            <td>___________</td>


            <td>Aktif Per tgl</td>
            <td>:</td>
            <td>___________</td>
          </tr>

          <tr>
            <td>Password</td>
            <td>:</td>
            <td>___________</td>
          </tr>
        </table>
      </div>


      <br><br><br>


      <p style="padding: 15px;"> Cibinong, <?php echo $tgl->tgl_indo(date('Y-m-d')) ?>
      <p>

        <input type="hidden" name="pelamar_id" value="<?php echo $pelamar_id ?>">


    </div><!-- /.row -->

    <!-- Table row -->

    <br>

    <table>


      <?php

      $kardirmud = $kar->kar_tampil_id($pelamar_acc['dirmud']);
      $kar_dirmud = mysql_fetch_array($kardirmud);

      $kardir_divisi = $kar->kar_tampil_id($pelamar_acc['dir_divisi']);
      $kar_dir_divisi = mysql_fetch_array($kardir_divisi);


      $kardir_hrd = $kar->kar_tampil_id($pelamar_acc['dir_hrd']);
      $kar_dir_hrd = mysql_fetch_array($kardir_hrd);


      $kardir_keuangan = $kar->kar_tampil_id($pelamar_acc['dir_keuangan']);
      $kar_dir_keuangan = mysql_fetch_array($kardir_keuangan);


      $kardirut1 = $kar->kar_tampil_id($pelamar_acc['dirut1']);
      $kar_dirut1 = mysql_fetch_array($kardirut1);


      $kardirut2 = $kar->kar_tampil_id($pelamar_acc['dirut2']);
      $kar_dirut2 = mysql_fetch_array($kardirut2);

      $kardirut3 = $kar->kar_tampil_id($pelamar_acc['dirut3']);
      $kar_dirut3 = mysql_fetch_array($kardirut3);


      ?>

      <tr>
        <td style="padding: 15px;"><img width="130" src="module/ttd_atasan/isman.jpg"> </td>
        <td style="padding: 15px;">

        <?php

          $photo =  $kar->kar_tampil_id($kar_dirmud['kar_id']);

          if ($pelamar_acc['status_acc_dirmud'] == '1') {
          ?>

            <img width="130" src="module/ttd_atasan/" <?php echo $photo['ttd'] ?>>

          <?php
          } else {
          ?>

          <?php
          }


          ?>
          
      
        </td>
        <td style="padding: 15px;">

          <?php

          $photo =  $kar->kar_tampil_id($kar_dir_divisi['kar_id']);

          if ($pelamar_acc['status_acc_dir_divisi'] == '1') {
          ?>

            <img width="130" src="module/ttd_atasan/" <?php echo $photo['ttd'] ?>>

          <?php
          } else {
          ?>

          <?php
          }


          ?>


        </td>

        <td style="padding: 15px;">

          <?php

          $photo =  $kar->kar_tampil_id($kar_dir_hrd['kar_id']);

          if ($pelamar_acc['status_acc_dir_hrd'] == '1') {
          ?>

            <img width="130" src="module/ttd_atasan/" <?php echo $photo['ttd'] ?>>

          <?php
          } else {
          ?>

          <?php
          }


          ?>

        </td>
        <td style="padding: 15px;">
          <?php

          $photo =  $kar->kar_tampil_id($kar_dir_keuangan['kar_id']);

          if ($pelamar_acc['status_acc_dir_keuangan'] == '1') {
          ?>

            <img width="130" src="module/ttd_atasan/" <?php echo $photo['ttd'] ?>>

          <?php
          } else {
          ?>

          <?php
          }


          ?>
        </td>
        <td style="padding: 15px;">
          <?php

          $photo =  $kar->kar_tampil_id($kar_dirut1['kar_id']);

          if ($pelamar_acc['status_acc_dirut1'] == '1') {
          ?>

            <img width="130" src="module/ttd_atasan/" <?php echo $photo['ttd'] ?>>

          <?php
          } else {
          ?>

          <?php
          }


          ?>
        </td>
        <td style="padding: 15px;">
          <?php

          $photo =  $kar->kar_tampil_id($kar_dirut2['kar_id']);

          if ($pelamar_acc['status_acc_dirut2'] == '1') {
          ?>

            <img width="130" src="module/ttd_atasan/" <?php echo $photo['ttd'] ?>>

          <?php
          } else {
          ?>

          <?php
          }
          ?>

        </td>
        <td style="padding: 15px;">
          <?php

          $photo =  $kar->kar_tampil_id($kar_dirut3['kar_id']);

          if ($pelamar_acc['status_acc_dirut3'] == '1') {
          ?>

            <img width="130" src="module/ttd_atasan/" <?php echo $photo['ttd'] ?>>

          <?php
          } else {
          ?>

          <?php
          }
          ?>
        </td>
      </tr>



      <tr>
        <td style="padding: 15px;">Isman Nugraha</td>
        <td style="padding: 15px;"><?php echo $kar_dirmud['kar_nm']; ?></td>
        <td style="padding: 15px;"><?php echo $kar_dir_divisi['kar_nm']; ?></td>
        <td style="padding: 15px;"><?php echo $kar_dir_hrd['kar_nm']; ?></td>

        <td style="padding: 15px;"><?php echo $kar_dir_keuangan['kar_nm']; ?></td>
        <td style="padding: 15px;"><?php echo $kar_dirut1['kar_nm']; ?></td>
        <td style="padding: 15px;"><?php echo $kar_dirut2['kar_nm']; ?></td>
        <td style="padding: 15px;"><?php echo $kar_dirut3['kar_nm']; ?></td>

      </tr>



    </table>
    <button type="submit" name="bsave" class="btn btn-success btn-sm">Tanda Tangan</button>

  </section><!-- /.content -->
  <div class="clearfix"></div>


</form>
<!--
    </div>
    </div>    -->

    


<!-- Modal Keterangan -->
<div class="modal fade" id="isiketerngan" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header bg-primary">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel"><i class="fa fa-file"></i> Keterangan/Link/URL <strong id="wfd_aktifitas"></strong></h4>
      </div>
      <div class="modal-body">
        <textarea class="form-control" id="wfd_keterangan" rows="15" readonly style="display:none;"></textarea>
        <div class="tarea" id="wfd_keterangan_output"></div>
      </div>
    </div>
  </div>
</div>

<?php //}else{ echo"<script>document.location='?p=not_found';</script>";}
?>