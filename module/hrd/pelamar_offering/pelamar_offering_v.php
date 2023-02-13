<?php require('module/hrd/pelamar_offering/act_pelamar_offering_status.php'); ?>
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
    <li><a href="media.php"><i class="fa fa-dashboard"></i> Offering</a></li>
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
                <th>No Wa</th>

                <th>Tgl Interview Hrd</th>
                <th>Masukan HRD</th>

                <th>Tgl Interview User</th>
                <th>Masukan User</th>
             
                <th>Lihat Cv</th>
                <th>Status</th>
                <th></th>
              </tr>

            </thead>
            <tbody>



              <?php
              $pelamar_list = $pelamar->pelamar_list_offering($izn_kirim);
              $no = 1;
              while ($data = mysql_fetch_array($pelamar_list)) {

                $interview = $pelamar->detail_interview($data['id_pelamar']);

                $data_interview = mysql_fetch_array($interview);

              ?>
                <tr>
                <td><?php echo $no++; ?></td>
                  <td><?php echo $data['lowongan']; ?></td>
                  <td><?php echo $data['nama']; ?></td>
                  <td><?php echo $data['jk']; ?></td>
                  <td><?php echo $data['no_wa']; ?></td>
                  <td><?php echo $data_interview['tgl_interview_satu'];  ?></td>
                  <td><?php echo $data['masukan_satu']; ?></td>

                  <td><?php echo $data_interview['tgl_interview_dua'];  ?></td>
                  <td><?php echo $data['masukan_dua']; ?></td>


                  <td><a target="_blank" href="module/cv/<?php echo $data['cv']; ?>">Lihat Cv</a></td>
                  <td>
                    <form method="post">
                      <input type="hidden" name="id_pelamar" value="<?php echo $data['id_pelamar']; ?>">
                      <?php 
                        if($data_interview['status_offering']){

                          //  echo $data_interview['status_offering'];

                            if($data_interview['status_offering']=='bersedia_gabung'){
                                  echo "Bersedia Gabung";
                            }elseif($data_interview['status_offering']=='tidak_bersedia_gabung'){
                                 echo "Tidak Bersedia Gabung";

                            }
                           //echo "<br>";
                           // echo $data_interview['date_status_offering'];

                        }else{
                          ?>
                     
                            <select name="status" onchange="submit()">
                              <option value="">--Pilih--</option>
                              <option value="bersedia_gabung">Bersedia Gabung</option>
                              <option value="tidak_bersedia_gabung">Tidak Bersedia Gabung</option>
                          </select>

                          <?php
                        }
                      ?>

                         
                    
                    </form>
                  </td>
                  <td>

                  <?php 
                     if($data_interview['status_offering']=='bersedia_gabung'){
                      ?>
                       <a href="?p=pelamar_form_karyawan&pelamar_id=<?php echo $data['pelamar_id']; ?>" class="btn btn-primary btn-sm" >Form Karyawan</a>


                    <?php
                     }else{

                     }
                  ?>


                  </td>
                
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

