<?php require('module/hrd/pelamar_interview/act_form_permintaan.php');
$pel_id = $_GET['pelamar_id'];

$pelamar = $pelamar->pelamar_id_detail($pel_id);







$data = mysql_fetch_array($pelamar);


// echo "<pre>";
// print_r($divisi);

// die;


?>




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


    <form role="form" action="" method="post" enctype="multipart/form-data">

        <!-- Your Page Content Here -->
        <div class="row">
            <div class="col-md-12">
                <div class="box">
                    <div class="box box-warning">
                        <div class="box-header with-border">
                            <h3 class="box-title">Form Permintaan Karyawan</h3>
                        </div>





                        <div class="box-body">

                            <div class="row">

                                <div class="form-group col-md-4">
                                    <label>Nama Lengkap</label>
                                    <input type="text" disabled class="form-control" required value="<?php echo $data['nama'] ?>">
                                </div>

                                <input type="hidden" name="pelamar_id" value="<?php echo $pel_id ?>">


                                <div class="form-group col-md-4">
                                    <label>Jenis Kelamin</label>
                                    <input type="text" disabled class="form-control" required value="<?php echo $data['jk'] ?>">
                                </div>



                                <div class="form-group col-md-4">
                                    <label>Tempat Tgl Lahir</label>
                                    <input type="text" disabled class="form-control" required value="<?php echo $data['tmpt_lahir'] ?>  - <?php echo $data['tgl_lahir'] ?>">
                                </div>


                                <div class="form-group col-md-4">
                                    <label>Alamat</label>
                                    <input type="text" disabled class="form-control" required value="<?php echo $data['alamat'] ?>>">
                                </div>


                                <div class="form-group col-md-4">
                                    <label>Pendidikan Terakhir</label>
                                    <input type="text" class="form-control" required name="pendidikan" placeholder="Pendidikan Terakhir">
                                </div>



                                <div class="form-group col-md-4">
                                    <label>Pengalaman Kerja</label>
                                    <input type="text" class="form-control" required name="pengalaman_kerja" placeholder="Masukan Pengalaman Kerja">
                                </div>





                                <div class="form-group col-md-4">
                                    <label>Posisi Jabatan</label>


                                    <select class="form-control" name="jbt_id">
                                        <?php
                                        $jabatan = $jbt->jbt_tampil();
                                        foreach ($jabatan as $data_jabatan) {

                                        ?>
                                            <option value="<?php echo $data_jabatan['jbt_id']; ?>"><?php echo $data_jabatan['jbt_nm']; ?></option>
                                        <?php
                                        }
                                        ?>
                                    </select>



                                </div>




                                <div class="form-group col-md-4">
                                    <label>Sumber Loker</label>
                                    <input type="text" class="form-control" required name="sumber_loker" placeholder="Sumber Loker">
                                </div>






                                <div class="form-group col-md-4">
                                    <label>Divisi</label>



                                    <select class="form-control" name="div_id">
                                        <?php
                                        $divisi = $div->div_tampil();
                                        foreach ($divisi as $data_divisi) {

                                        ?>
                                            <option value="<?php echo $data_divisi['div_id']; ?>"><?php echo $data_divisi['div_nm']; ?></option>
                                        <?php
                                        }
                                        ?>
                                    </select>






                                </div>






                                <div class="form-group col-md-4">
                                    <label>Penempatan</label>

                                    <select class="form-control" name="ktr_id">
                                        <?php
                                        $kantor = $ktr->ktr_tampil();
                                        foreach ($kantor as $data_kantor) {

                                        ?>
                                            <option value="<?php echo $data_kantor['ktr_id']; ?>"><?php echo $data_kantor['ktr_nm']; ?></option>
                                        <?php
                                        }
                                        ?>
                                    </select>


                                </div>












                                <div class="form-group col-md-4">
                                    <label>Photo</label>



                                    <div class="btn btn-default btn-file" id="file">
                                        <i class="fa fa-paperclip"></i> Attachment
                                    </div>
                                    <input type="file" name="profile" />
                                    <small class="help-block"><em>JPG/PDF Max. 10MB</em></small>

                                </div>






                            </div>














                        </div>
                    </div>


                </div>
            </div>


        </div>



        <div class="row">
            <div class="col-md-12">
                <div class="box">
                    <div class="box box-warning">
                        <div class="box-header with-border">
                            <h3 class="box-title">Approval Atasan</h3>
                        </div>





                        <div class="box-body">

                            <div class="row">

                                <?php
                                $karyawan = $kar->kar_tampil();
                                ?>



                                <div class="form-group col-md-4">
                                    <label>Dirmud</label>
                                    <select class="form-control" name="dirmud">
                                        <?php
                                        foreach ($karyawan as $data_karyawan) {

                                        ?>
                                            <option value="<?php echo $data_karyawan['kar_id']; ?>"><?php echo $data_karyawan['kar_nm']; ?></option>
                                        <?php
                                        }
                                        ?>
                                    </select>
                                </div>






                                <div class="form-group col-md-4">
                                    <label>Dir Divisi</label>
                                    <select class="form-control" name="dir_divisi">
                                        <?php
                                        foreach ($karyawan as $data_karyawan) {

                                        ?>
                                            <option value="<?php echo $data_karyawan['kar_id']; ?>"><?php echo $data_karyawan['kar_nm']; ?></option>
                                        <?php
                                        }
                                        ?>
                                    </select>
                                </div>



                                <div class="form-group col-md-4">
                                    <label>Keuangan</label>
                                    <select class="form-control" name="dir_keuangan">
                                        <?php
                                       foreach ($karyawan as $data_karyawan) {
                                        if($data_karyawan['kar_id']=='38'){
                                            $selected = "selected";
                                        }else{
                                            $selected = "";
                                        }

                                        echo $selected;
                                ?>
                                    <option value="<?php echo $data_karyawan['kar_id']; ?>" <?php echo $selected?>><?php echo $data_karyawan['kar_nm']; ?></option>
                                <?php
                                }
                                        ?>
                                    </select>
                                </div>


                                <div class="form-group col-md-4">
                                    <label>Dir HRD</label>
                                    <select class="form-control" name="dir_hrd">
                                        <?php
                                       foreach ($karyawan as $data_karyawan) {
                                        if($data_karyawan['kar_id']=='37'){
                                            $selected = "selected";
                                        }else{
                                            $selected = "";
                                        }

                                        echo $selected;
                                ?>
                                    <option value="<?php echo $data_karyawan['kar_id']; ?>" <?php echo $selected?>><?php echo $data_karyawan['kar_nm']; ?></option>
                                <?php
                                }
                                        ?>
                                    </select>
                                </div>


                                <div class="form-group col-md-4">
                                    <label>Dirut 1</label>
                                    <select class="form-control" name="dirut1">
                                        <?php
                                        foreach ($karyawan as $data_karyawan) {
                                                if($data_karyawan['kar_id']=='38'){
                                                    $selected = "selected";
                                                }else{
                                                    $selected = "";
                                                }

                                                echo $selected;
                                        ?>
                                            <option value="<?php echo $data_karyawan['kar_id']; ?>" <?php echo $selected?>><?php echo $data_karyawan['kar_nm']; ?></option>
                                        <?php
                                        }
                                        ?>
                                    </select>
                                </div>



                                <div class="form-group col-md-4">
                                    <label>Dirut 2</label>
                                    <select class="form-control" name="dirut2">
                                        <?php
                                        foreach ($karyawan as $data_karyawan) {
                                            if($data_karyawan['kar_id']=='63'){
                                                $selected = "selected";
                                            }else{
                                                $selected = "";
                                            }

                                            echo $selected;
                                    ?>
                                        <option value="<?php echo $data_karyawan['kar_id']; ?>" <?php echo $selected?>><?php echo $data_karyawan['kar_nm']; ?></option>
                                    <?php
                                    }
                                        ?>
                                    </select>
                                </div>


                                <div class="form-group col-md-4">
                                    <label>Dirut 3</label>
                                    <select class="form-control" name="dirut3">
                                        <?php
                                         foreach ($karyawan as $data_karyawan) {
                                            if($data_karyawan['kar_id']=='30'){
                                                $selected = "selected";
                                            }else{
                                                $selected = "";
                                            }

                                            echo $selected;
                                    ?>
                                        <option value="<?php echo $data_karyawan['kar_id']; ?>" <?php echo $selected?>><?php echo $data_karyawan['kar_nm']; ?></option>
                                    <?php
                                    }
                                        ?>
                                    </select>

                                </div>








                            </div>














                        </div>
                    </div>


                </div>
            </div>


        </div>

        <button type="submit" name="bsave" class="btn btn-primary">Simpan</button>


    </form>
</section>