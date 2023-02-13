<?php require('module/hrd/publikasi_iklan/act_publikasi_iklan.php'); ?>




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
                        <h3 class="box-title">Publikasi Iklan</h3>
                    </div>

                    <div class="box-body">
                        <form role="form" action="" method="post" enctype="multipart/form-data">

                            <div class="form-group">
                                <label>Lowongan</label>
                                <input type="text" class="form-control" required name="lowongan" placeholder="ex Seo ...">
                            </div>


                            <div class="form-group">
                                <label>Portal Lain</label>
                                <input type="text" class="form-control" required name="portal" placeholder="Masukan Nama">
                            </div>



                            <div class="form-group">
                                <label>Share Link</label>
                                <input type="text" class="form-control" required name="share_link" placeholder="Masukan Nama">
                            </div>


                           
                           

                            


                            <button type="submit" name="bsave" class="btn btn-primary">Simpan</button>


                        </form>
                    </div>

                </div>

            </div>
        </div>
    </div>
</section>