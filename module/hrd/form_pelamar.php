<?php require('module/hrd/act_pelamar.php'); ?>



<section class="content-header">
    <h1>
        <small>
            <?php
            echo $tgl->tgl_indo($izn_kirim);
            ?>
        </small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="media.php"><i class="fa fa-dashboard"></i> Dashboard</a></li>
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
                        <h3 class="box-title">Tambah Pelamar</h3>
                    </div>

                    <div class="box-body">
                        <form role="form" action="" method="post" enctype="multipart/form-data">

                            <div class="form-group">
                                <label>Lowongan</label>
                                <input type="text" class="form-control" required name="lowongan" placeholder="ex Seo ...">
                            </div>



                            <div class="form-group">
                                <label>Nama</label>
                                <input type="text" class="form-control" required name="nama" placeholder="Masukan Nama">
                            </div>
                            <div class="form-group">
                                <label>Tempat Lahir</label>
                                <input type="text" class="form-control" required name="tmpt_lahir" placeholder="Ex Bekasi ..">
                            </div>

                            <div class="form-group">
                                <label>Tanggal Lahir</label>
                                <input type="date" class="form-control" required name="tgl_lahir" >
                            </div>

                            <div class="form-group">
                                <label>No Wa</label>
                                <input type="number" class="form-control" required name="no_wa" placeholder="ex 08912312312xxx.">
                            </div>

                            <div class="form-group">
                                <label>Jenis Kelamin</label>
                                <div class="radio">
                                    <label>
                                        <input type="radio" name="jk"  id="jk2" value="L">
                                        Laki - Laki
                                    </label>
                                </div>
                                <div class="radio">
                                    <label>
                                        <input type="radio" name="jk" id="jk3" value="P">
                                        Perempuan
                                    </label>
                                </div>
                            </div>

                            <div class="form-group">
                                <label>Alamat</label>
                                <textarea class="form-control" name="alamat" required rows="3" placeholder="Masukan Alamat Lengkap ..."></textarea>
                            </div>

                            <div class="form-group">
                                <label>Cv</label>
                                <strong>File Harus PDF/Doc Max 1 GB</strong>
                                <input type="file"  name="cv">
                            </div>



                            <button type="submit" name="bsave" class="btn btn-primary">Simpan</button>


                        </form>
                    </div>

                </div>

            </div>
        </div>
    </div>
</section>