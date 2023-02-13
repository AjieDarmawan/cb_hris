<?php 
    require('module/hrd/pelamar_interview/act_pelamar_interview_satu.php'); 

    $pelamar_id=$_GET['pelamar_id'];

    $interview = $pelamar->detail_interview($pelamar_id);
    $data_interview = mysql_fetch_array($interview);

    if($data_interview){

        $tgl_interview = $data_interview['tgl_interview_satu'];
        $masukan =$data_interview['masukan_satu'];

    }else{
        $tgl_interview = date('Y-m-d');
        $masukan = "";
    }

    // echo "<pre>";
    // print_r($data_interview);
?>



<section class="content-header">
    <h1>
        <small>
            <?php
            //  echo $tgl->tgl_indo($izn_kirim);
            ?>
        </small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="media.php"><i class="fa fa-dashboard"></i> Interview Hrd</a></li>
        <li><a href="?p=history_izin">Hrd</a></li>
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
                        <h3 class="box-title">Interview Hrd</h3>
                    </div>

                    <div class="box-body">
                        <form role="form" action="" method="post" enctype="multipart/form-data">

                            <div class="form-group">
                                <label>Tanggal Interview</label>
                                <input type="date" class="form-control" value="<?php echo $tgl_interview?>" required name="tgl_interview" placeholder="ex Seo ...">
                            </div>

                            <div class="form-group">
                                <label>Masukan</label>
                                <textarea class="form-control" name="masukan" required rows="3" placeholder="Masukan ..."><?php echo $masukan?></textarea>
                            </div>

                            <?php 
                                if($data_interview){
                                    ?>

                                        <input type="hidden" class="form-control" value="update" required name="to">

                              <?php      
                                }else{
                                    ?>

                                    <input type="hidden" class="form-control" value="insert" required name="to">
                                 <?php       
                                }
                            ?>



                            <div class="form-group">
                                <label>Hasil Interview</label>
                                <select class="form-control" name="hasil_interview">
                                    <option value="">--Pilih--</option>
                                    <option value="gagal_interview_satu">Gagal</option>
                                    <option value="skip">Skip</option>
                                    <option value="interview_user">Lanjut Interview User</option>

                                </select>
                            </div>

                            <input type="hidden" name="pelamar_id" value="<?php echo $pelamar_id;?>">




                            <button type="submit" onclick="clicked(event)" name="bsave" class="btn btn-primary">Simpan</button>


                        </form>
                    </div>

                </div>

            </div>
        </div>
    </div>
</section>

<script>
function clicked(e)
{
    if(!confirm('Apakah Kamu Yakin?')) {
        e.preventDefault();
    }
}
</script>