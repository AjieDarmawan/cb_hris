<?php require('module/hrd/pembinaan_coaching/act_pembinaan_coaching.php'); ?>



<section class="content-header">
    <h1>
        <small>
            <?php
            echo $tgl->tgl_indo($izn_kirim);
            ?>
        </small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="media.php"><i class="fa fa-dashboard"></i> Tambah Pembinaan Coaching</a></li>
        <li><a href="?p=history_izin">Data Izin</a></li>
        <li class="active"> </li>
    </ol>
</section>


<section class="content">

    <!-- Your Page Content Here -->
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box box-warning">
                    <div class="box-header with-border">
                        <h3 class="box-title">Tambah Pembinaan Coaching</h3>
                    </div>

                    <div class="box-body">
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
                                <input type="date" class="form-control" required name="tanggal" >
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
        </div>
    </div>
</section>