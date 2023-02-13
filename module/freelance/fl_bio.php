<?php require('module/karyawan/kar_act.php'); ?>
<!-- Content Header (Page header) -->
    <section class="content-header">
      <h1> <?php echo $title;?> <small></small> </h1>
      <ol class="breadcrumb">
        <li><a href="media.php"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li class="active"><?php echo $title;?></li>
      </ol>
    </section>
    
    <!-- Main content -->
    <section class="content"> 
      
      <!-- Your Page Content Here -->
      <div class="row">
        <!-- left column -->
            <div class="col-md-4">
              <!-- general form elements -->
              <!-- form start -->
              <form class="form-horizontal" action="" method="post">
              <div class="box box-primary">
                <div class="box-header">
                  <h3 class="box-title"><?php echo $kar_data_id['kar_nm'];?></h3>
                  	<div class="pull-right box-tools">
                      <button type="submit" name="bupdate" id="bupdate" class="btn btn-primary"><i class="fa fa-save"></i></button>
                      <button type="button" id="edit" class="btn btn-primary"><i class="fa fa-pencil"></i></button>
                    </div>
                </div><!-- /.box-header -->
                  <div class="box-body">
                  <div class="form-group">
                    <label for="nik" class="col-sm-2 control-label">NIK</label>
                    <div class="col-sm-10">
                      <input type="text" name="nik" value="" class="form-control" id="nik" placeholder="NIK" required disabled>
                    </div>
                  </div>  
                  <div class="form-group">
                    <label for="nama_lengkap" class="col-sm-2 control-label">Nama Lengkap</label>
                    <div class="col-sm-10">
                      <input type="text" name="nama_lengkap" value="" class="form-control" id="nama_lengkap" placeholder="Nama Lengkap" required disabled>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="nama_panggil" class="col-sm-2 control-label">Nama Panggil</label>
                    <div class="col-sm-10">
                      <input type="text" name="nama_panggil" value="" class="form-control" id="nama_panggil" placeholder="Nama Panggil" required disabled>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="jenis_kelamin" class="col-sm-2 control-label">Jenis Kelamin</label>
                    <div class="col-sm-10">
                      <input type="radio" name="jenis_kelamin" value="Pria" class="flat-red" id="jenis_kelamin" /> Pria &nbsp;
                      <input type="radio" name="jenis_kelamin" value="Wanita" class="flat-red" id="jenis_kelamin" /> Wanita &nbsp;
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="tempat_lahir" class="col-sm-2 control-label">Tempat Lahir</label>
                    <div class="col-sm-10">
                      <input type="text" name="tempat_lahir" value="" class="form-control" id="tempat_lahir" placeholder="Tempat Lahir" required disabled>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="tanggal_lahir" class="col-sm-2 control-label">Tanggal Lahir</label>
                    <div class="col-sm-10">
                      <input type="text" name="tanggal_lahir" value="" class="form-control" id="tanggal_lahir" placeholder="Tanggal Lahir" data-inputmask="'alias': 'yyyy-mm-dd'" data-mask required disabled>
                    </div>
                  </div>
		  <div class="form-group">
                    <label for="gologan_darah" class="col-sm-2 control-label">Golongan Darah</label>
                    <div class="col-sm-10">
                      <input type="radio" name="gologan_darah" value="A" class="flat-red" id="jenis_kelamin" /> A &nbsp;
                      <input type="radio" name="gologan_darah" value="B" class="flat-red" id="jenis_kelamin" /> B &nbsp;
		      <input type="radio" name="gologan_darah" value="AB" class="flat-red" id="jenis_kelamin" /> AB &nbsp;
		      <input type="radio" name="gologan_darah" value="O" class="flat-red" id="jenis_kelamin" /> O &nbsp;
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="agama" class="col-sm-2 control-label">Agama</label>
                    <div class="col-sm-10">
                      <select class="form-control" name="agama" id="agama" required disabled>
                        <option value="" selected> -- Pilih --</option>
			<option value="Islam"> Islam</option>
			<option value="Kristen Protestan"> Kristen Protestan</option>
			<option value="Kristen Katolik"> Kristen Katolik</option>
			<option value="Hindu"> Hindu</option>
			<option value="Budha"> Budha</option>
                      </select>
                    </div>
                  </div>
		  <div class="form-group">
                    <label for="bintang" class="col-sm-2 control-label">Bintang</label>
                    <div class="col-sm-10">
                      <select class="form-control" name="bintang" id="bintang" required disabled>
                        <option value="" selected> -- Pilih --</option>
			<option value="Capricon"> Capricon</option>
			<option value="Aquarius"> Aquarius</option>
			<option value="Pisces"> Pisces</option>
			<option value="Hindu"> Aries</option>
			<option value="Taurus"> Taurus</option>
			<option value="Gemini"> Gemini</option>
			<option value="Cancer"> Cancer</option>
			<option value="Leo"> Leo</option>
			<option value="Virgo"> Virgo</option>
			<option value="Libra"> Libra</option>
			<option value="Scorpio"> Scorpio</option>
			<option value="Sagitarius"> Sagitarius</option>
                      </select>
                    </div>
                  </div>
		  <div class="form-group">
                    <label for="shio" class="col-sm-2 control-label">Shio</label>
                    <div class="col-sm-10">
                      <select class="form-control" name="shio" id="shio" required disabled>
                        <option value="" selected> -- Pilih --</option>
			<option value="Naga"> Naga</option>
			<option value="Tikus"> Tikus</option>
			<option value="Monyet"> Monyet</option>
			<option value="Kelinci"> Kelinci</option>
			<option value="Babi"> Babi</option>
			<option value="Kambing"> Kambing</option>
			<option value="Harimau"> Harimau</option>
			<option value="Anjing"> Anjing</option>
			<option value="Kuda"> Kuda</option>
			<option value="Kerbau"> Kerbau</option>
			<option value="Ayam"> Ayam</option>
			<option value="Ular"> Ular</option>
                      </select>
                    </div>
                  </div>
		  <div class="form-group">
                      <label for="alamat" class="col-sm-2 control-label">Alamat</label>
                      <div class="col-sm-10">
                        <textarea name="alamat" class="form-control" id="alamat" placeholder="alamat" disabled></textarea>
                      </div>
                  </div>
		  <div class="form-group">
                    <label for="rt_rw" class="col-sm-2 control-label">RT / RW</label>
                    <div class="col-sm-10">
                      <input type="text" name="rt_rw" value="" class="form-control" id="rt_rw" placeholder="Tempat Lahir" required disabled>
                    </div>
                  </div>
		  <div class="form-group">
                    <label for="kelurahan" class="col-sm-2 control-label">Kelurahan</label>
                    <div class="col-sm-10">
                      <input type="text" name="kelurahan" value="" class="form-control" id="kelurahan" placeholder="Kelurahan" required disabled>
                    </div>
                  </div>
		  <div class="form-group">
                    <label for="kecamatan" class="col-sm-2 control-label">Kecamatan</label>
                    <div class="col-sm-10">
                      <input type="text" name="kecamatan" value="" class="form-control" id="kecamatan" placeholder="Kecamatan" required disabled>
                    </div>
                  </div>
		  <div class="form-group">
                    <label for="kota" class="col-sm-2 control-label">Kota</label>
                    <div class="col-sm-10">
                      <input type="text" name="kota" value="" class="form-control" id="kota" placeholder="Kota" required disabled>
                    </div>
                  </div>
		  <div class="form-group">
                    <label for="propinsi" class="col-sm-2 control-label">Propinsi</label>
                    <div class="col-sm-10">
                      <input type="text" name="propinsi" value="" class="form-control" id="propinsi" placeholder="Propinsi" required disabled>
                    </div>
                  </div>
		  <div class="form-group">
                    <label for="kode_pos" class="col-sm-2 control-label">Kode Pos</label>
                    <div class="col-sm-10">
                      <input type="text" name="kode_pos" value="" class="form-control" id="kode_pos" placeholder="Kode Pos" required disabled>
                    </div>
                  </div>
		  <div class="form-group">
                    <label for="telepon" class="col-sm-2 control-label">Telepon</label>
                    <div class="col-sm-10">
                      <input type="text" name="telepon" value="" class="form-control" id="telepon" placeholder="Telepon" required disabled>
                    </div>
                  </div>
		  <div class="form-group">
                    <label for="hp" class="col-sm-2 control-label">HP</label>
                    <div class="col-sm-10">
                      <input type="text" name="hp" value="" class="form-control" id="hp" placeholder="HP" required disabled>
                    </div>
                  </div>
		  <div class="form-group">
                    <label for="email" class="col-sm-2 control-label">Email</label>
                    <div class="col-sm-10">
                      <input type="email" name="email" value="" class="form-control" id="email" placeholder="Email" required disabled>
                    </div>
                  </div>
		  <div class="form-group">
                    <label for="website" class="col-sm-2 control-label">Website</label>
                    <div class="col-sm-10">
                      <input type="text" name="website" value="" class="form-control" id="website" placeholder="Website" required disabled>
                    </div>
                  </div>
		  <div class="form-group">
                    <label for="penyakit" class="col-sm-2 control-label">Penyakit</label>
                    <div class="col-sm-10">
                      <input type="text" name="penyakit" value="" class="form-control" id="penyakit" placeholder="Penyakit" required disabled>
                    </div>
                  </div>
                  
                  </div><!-- /.box-body -->

                  <div class="box-footer">
                    <!-- apa gitu -->
                  </div>
              </div><!-- /.box -->
              </form>

              <!-- general form elements -->
            <form class="form-horizontal" action="" method="post">
              <div class="box box-primary">
                <div class="box-header">
                  <h3 class="box-title">Employee</h3>
                  <!-- tools box -->
                  <div class="pull-right box-tools">
                    <button type="submit" name="bupdate_employee" id="bupdate_employee" class="btn btn-primary"><i class="fa fa-save"></i></button>
                    <button type="button" id="edit_employee" class="btn btn-primary"><i class="fa fa-pencil"></i></button>
                  </div><!-- /. tools -->
                </div><!-- /.box-header -->
                  <div class="box-body">
                    <div class="form-group">
                      <label for="kar_dtl_sts_krj" class="col-sm-2 control-label">Sts Kerja</label>
                      <div class="col-sm-10">
                        <select class="form-control" name="kar_dtl_sts_krj" id="kar_dtl_sts_krj" disabled>
                        <?php 
                        if($kar_data_detail['kar_dtl_sts_krj']=="A"){
                          $selected_aktif="selected";
                        }elseif($kar_data_detail['kar_dtl_sts_krj']=="N"){
                          $selected_nonaktif="selected";
                        }else{
                          $selected_aktif="selected";
                        }
                        ?>
                            <option value="A" <?php echo $selected_aktif;?>>Aktif</option>
                            <option value="N" <?php echo $selected_nonaktif;?>>Nonaktif</option>
                        </select>
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="kar_dtl_typ_krj" class="col-sm-2 control-label">Typ Karyawan</label>
                      <div class="col-sm-10">
                        <?php 
                        if($kar_data_detail['kar_dtl_typ_krj']=="Kontrak"){
                          $checked_kontrak="checked";
                        }elseif($kar_data_detail['kar_dtl_typ_krj']=="Permanen"){
                          $checked_permanen="checked";
                        }elseif($kar_data_detail['kar_dtl_typ_krj']=="Resign"){
                          $checked_resign="checked";
                        }else{
                          $checked_kontrak="checked";
                        }
                        ?>
                        <input type="radio" name="kar_dtl_typ_krj" value="Kontrak" class="flat-red" id="kontrak" <?php echo $checked_kontrak;?>/> Kontrak &nbsp;
                        <input type="radio" name="kar_dtl_typ_krj" value="Permanen" class="flat-red" id="permanen" <?php echo $checked_permanen;?>/> Permanen &nbsp;
                        <input type="radio" name="kar_dtl_typ_krj" value="Resign" class="flat-red" id="resign" <?php echo $checked_resign;?>/> Resign &nbsp; 
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="kar_dtl_tgl_joi" class="col-sm-2 control-label">Tgl Join</label>
                      <div class="col-sm-10">
                        <?php 
                        if($kar_data_detail['kar_dtl_tgl_joi']=="0000-00-00"){
                          $kar_dtl_tgl_joi="";
                        }else{
                          $kar_dtl_tgl_joi="$kar_data_detail[kar_dtl_tgl_joi]";
                        }
                        ?>
                        <input type="text" name="kar_dtl_tgl_joi" value="<?php echo $kar_dtl_tgl_joi;?>" class="form-control" id="kar_dtl_tgl_joi" placeholder="Tanggal Join" data-inputmask="'alias': 'yyyy-mm-dd'" data-mask disabled>
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="kar_dtl_msa_krj" class="col-sm-2 control-label">Masa Kerja</label>
                      <div class="col-sm-10">
                        <input type="text" name="kar_dtl_msa_krj" value="<?php echo $kar_dtl_msa_krj_;?>" class="form-control" id="kar_dtl_msa_krj" placeholder="Masa Kerja Akan Muncul Automatis" readonly disabled>
                      </div>
                    </div>
                  </div><!-- /.box-body -->

                  <div class="box-footer">
                    <!-- ini juga apa gitu -->
                  </div>
              </div><!-- /.box -->
            </form>

          </div>


           <div class="col-md-4">
            <!-- general form elements -->
          <form class="form-horizontal" action="" method="post" enctype="multipart/form-data">
                  <div class="box box-success">
                    <div class="box-header">
                      <h3 class="box-title">Profile Picture</h3>
                      <?php
                        if($kar_id==$kar_data_id['kar_id']){
                      ?>  
                      <!-- tools box -->
                      <div class="pull-right box-tools">
            <button type="submit" name="bupdate_img" id="bupdate_img" class="btn btn-primary btn-sm"><i class="fa fa-save"></i></button>
                        <button class="btn btn-info btn-sm" data-widget='collapse' data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
                        <button class="btn btn-info btn-sm" data-widget='remove' data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
                      </div><!-- /. tools -->
                      <?php } ?>
                    </div><!-- /.box-header -->
                      <div class="box-body">
            <center>
            <!--<div id="acc_img1" style="width: 200px; height: 200px;"><img src="dist/img/avatar-item.jpg"></div><br>-->
                            <label for="acc_img">
                                <img src="module/profile/img/<?php
              if(!empty($acc_data_['acc_img'])){
                echo $acc_data_['acc_img'];
              }else{
                echo "avatar.jpg";
              }
              ?>" id="user_img" class="img-circle" alt="No images" width="150" height="150" style="cursor: pointer;">
                            </label>
                            <?php
                              if($kar_id==$kar_data_id['kar_id']){
                            ?> 
                            <input type="File" name="acc_img" id="acc_img" style="display:none;">
                            <small class="help-block"><em>Max. 500 Kilobytes (KB)</em></small>
                            <?php } ?>
            </center>   
                      </div><!-- /.box-body -->

                      <div class="box-footer">
                        <!-- ini juga apa gitu -->
                      </div>
                  </div><!-- /.box -->
            </form>

            <!-- general form elements -->
            <form class="form-horizontal" action="" method="post">
              <div class="box box-success">
                <div class="box-header">
                  <h3 class="box-title">Bio</h3>
                  <!-- tools box -->
                  <div class="pull-right box-tools">
                    <button type="submit" name="bupdate_bio" id="bupdate_bio" class="btn btn-primary"><i class="fa fa-save"></i></button>
                    <button type="button" id="edit_bio" class="btn btn-primary"><i class="fa fa-pencil"></i></button>
                  </div><!-- /. tools -->
                </div><!-- /.box-header -->
                  <div class="box-body">
                    <div class="form-group">
                      <label for="kar_dtl_usa" class="col-sm-2 control-label">Usia</label>
                      <div class="col-sm-10">
                        <input type="text" name="kar_dtl_usa" value="<?php echo $umr->hitung_umur($kar_data_id['kar_tgl_lahir']);?>" class="form-control" id="kar_dtl_usa" placeholder="Usia" readonly disabled>
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="kar_dtl_gen" class="col-sm-2 control-label">Gender</label>
                      <div class="col-sm-10">
                        <?php 
                        if($kar_data_detail['kar_dtl_gen']=="L"){
                          $checked_l="checked";
                        }elseif($kar_data_detail['kar_dtl_gen']=="P"){
                          $checked_p="checked";
                        }else{
                          $checked_l="checked";
                        }
                        ?>
                        <input type="radio" name="kar_dtl_gen" value="L" class="flat-red" id="kar_dtl_gen" <?php echo $checked_l;?> /> Laki-laki &nbsp;
                        <input type="radio" name="kar_dtl_gen" value="P" class="flat-red" id="kar_dtl_gen" <?php echo $checked_p;?> /> Perempuan &nbsp;
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="kar_dtl_tmp_lhr" class="col-sm-2 control-label">Tmp Lahir</label>
                      <div class="col-sm-10">
                        <input type="text" name="kar_dtl_tmp_lhr" value="<?php echo $kar_data_detail['kar_dtl_tmp_lhr'];?>" class="form-control" id="kar_dtl_tmp_lhr" placeholder="Tempat Lahir" disabled>
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="kar_dtl_sts_nkh" class="col-sm-2 control-label">Sts Nikah</label>
                      <div class="col-sm-10">
                        <?php 
                        if($kar_data_detail['kar_dtl_sts_nkh']=="TK"){
                          $checked_tk="checked";
                        }elseif($kar_data_detail['kar_dtl_sts_nkh']=="K"){
                          $checked_k="checked";
                        }else{
                          $checked_tk="checked";
                        }
                        ?>
                        <input type="radio" name="kar_dtl_sts_nkh" value="TK" class="flat-red" id="kar_dtl_sts_nkh" <?php echo $checked_tk;?> /> Tidak Kawin &nbsp;
                        <input type="radio" name="kar_dtl_sts_nkh" value="K" class="flat-red" id="kar_dtl_sts_nkh" <?php echo $checked_k;?> /> Kawin &nbsp;
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="kar_dtl_jml_ank" class="col-sm-2 control-label">Jml Anak</label>
                      <div class="col-sm-10">
                        <input type="number" name="kar_dtl_jml_ank" value="<?php echo $kar_data_detail['kar_dtl_jml_ank'];?>" class="form-control" id="kar_dtl_jml_ank" placeholder="Jumlah Anak" disabled>
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="kar_dtl_tgn" class="col-sm-2 control-label">Tanggungan</label>
                      <div class="col-sm-10">
                        <input type="number" name="kar_dtl_tgn" value="<?php echo $kar_data_detail['kar_dtl_tgn'];?>" class="form-control" id="kar_dtl_tgn" placeholder="Tanggungan" disabled>
                      </div>
                    </div>
                    
                  </div><!-- /.box-body -->

                  <div class="box-footer">
                    <!-- ini juga apa gitu -->
                  </div>
              </div><!-- /.box -->
            </form>

            <!-- general form elements -->
            <form class="form-horizontal" action="" method="post">
              <div class="box box-success">
                <div class="box-header">
                  <h3 class="box-title">Education</h3>
                  <!-- tools box -->
                  <div class="pull-right box-tools">
                    <button type="submit" name="bupdate_education" id="bupdate_education" class="btn btn-primary"><i class="fa fa-save"></i></button>
                    <button type="button" id="edit_education" class="btn btn-primary"><i class="fa fa-pencil"></i></button>
                  </div><!-- /. tools -->
                </div><!-- /.box-header -->
                  <div class="box-body">
                    <div class="form-group">
                      <label for="kar_dtl_pnd" class="col-sm-2 control-label">Pendidikan</label>
                      <div class="col-sm-10">
                        <select class="form-control" name="kar_dtl_pnd" id="kar_dtl_pnd" disabled>
                        <?php 
                        if($kar_data_detail['kar_dtl_pnd']=="S2"){
                          $selected_s2="selected";
                        }elseif($kar_data_detail['kar_dtl_pnd']=="S1"){
                          $selected_s1="selected";
                        }elseif($kar_data_detail['kar_dtl_pnd']=="D3"){
                          $selected_d3="selected";
                        }elseif($kar_data_detail['kar_dtl_pnd']=="SMA"){
                          $selected_sma="selected";
                        }elseif($kar_data_detail['kar_dtl_pnd']=="SMK"){
                          $selected_smk="selected";
                        }elseif($kar_data_detail['kar_dtl_pnd']=="SMEA"){
                          $selected_smea="selected";
                        }elseif($kar_data_detail['kar_dtl_pnd']=="STM"){
                          $selected_stm="selected";
                        }elseif($kar_data_detail['kar_dtl_pnd']=="SMP"){
                          $selected_smp="selected";
                        }elseif($kar_data_detail['kar_dtl_pnd']=="Lainnya"){
                          $selected_lainnya="selected";
                        }else{
                          $selected_s1="selected";
                        }
                        ?>
                            <option value="S2" <?php echo $selected_s2;?>>S2</option>
                            <option value="S1" <?php echo $selected_s1;?>>S1</option>
                            <option value="D3" <?php echo $selected_d3;?>>D3</option>
                            <option value="SMA" <?php echo $selected_sma;?>>SMA</option>
                            <option value="SMK" <?php echo $selected_smk;?>>SMK</option>
                            <option value="SMEA" <?php echo $selected_smea;?>>SMEA</option>
                            <option value="STM" <?php echo $selected_stm;?>>STM</option>
                            <option value="SMP" <?php echo $selected_smp;?>>SMP</option>
                            <option value="Lainnya" <?php echo $selected_lainnya;?>>Lainnya</option>
                        </select>
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="kar_dtl_jrs" class="col-sm-2 control-label">Jurusan</label>
                      <div class="col-sm-10">
                        <input type="text" name="kar_dtl_jrs" value="<?php echo $kar_data_detail['kar_dtl_jrs'];?>" class="form-control" id="kar_dtl_jrs" placeholder="Jurusan"  disabled>
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="kar_dtl_unv_sch" class="col-sm-2 control-label">Univ / School</label>
                      <div class="col-sm-10">
                        <input type="text" name="kar_dtl_unv_sch" value="<?php echo $kar_data_detail['kar_dtl_unv_sch'];?>" class="form-control" id="kar_dtl_unv_sch" placeholder="Universitas / Sekolah"  disabled>
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="kar_dtl_sts_pnd" class="col-sm-2 control-label">Sts Pendidikan</label>
                      <div class="col-sm-10">
                        <!--<select class="form-control" name="kar_dtl_sts_pnd" id="kar_dtl_sts_pnd" required disabled>
                            <option value="L" selected>Lulus</option>
                            <option value="TL">Tidak Lulus</option>
                        </select>-->
                        <?php 
                        if($kar_data_detail['kar_dtl_sts_pnd']=="L"){
                          $checked_l="checked";
                        }elseif($kar_data_detail['kar_dtl_sts_pnd']=="TL"){
                          $checked_tl="checked";
                        }else{
                          $checked_l="checked";
                        }
                        ?>
                        <input type="radio" name="kar_dtl_sts_pnd" value="L" class="flat-red" id="kar_dtl_sts_pnd" <?php echo $checked_l;?> /> Lulus &nbsp;
                        <input type="radio" name="kar_dtl_sts_pnd" value="TL" class="flat-red" id="kar_dtl_sts_pnd" <?php echo $checked_tl;?> /> Tidak Lulus &nbsp;
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="kar_dtl_thn_lls" class="col-sm-2 control-label">Tahun Lulus</label>
                      <div class="col-sm-10">
                        <input type="text" name="kar_dtl_thn_lls" value="<?php echo $kar_data_detail['kar_dtl_thn_lls'];?>" class="form-control" id="kar_dtl_thn_lls" placeholder="Tahun Lulus"  disabled>
                      </div>
                    </div>
                  </div><!-- /.box-body -->

                  <div class="box-footer">
                    <!-- ini juga apa gitu -->
                  </div>
              </div><!-- /.box -->
            </form>

        </div>
        <!-- /.col --> 

          <div class="col-md-4">
            <!-- general form elements -->
            <form class="form-horizontal" action="" method="post">
              <div class="box box-warning">
                <div class="box-header">
                  <h3 class="box-title">Card</h3>
                  <!-- tools box -->
                  <div class="pull-right box-tools">
                    <button type="submit" name="bupdate_card" id="bupdate_card" class="btn btn-primary"><i class="fa fa-save"></i></button>
                    <button type="button" id="edit_card" class="btn btn-primary"><i class="fa fa-pencil"></i></button>
                  </div><!-- /. tools -->
                </div><!-- /.box-header -->
                  <div class="box-body">
                    <div class="form-group">
                      <label for="kar_dtl_no_ktp" class="col-sm-2 control-label">KTP</label>
                      <div class="col-sm-6">
                        <input type="text" name="kar_dtl_no_ktp" value="<?php echo $kar_data_detail['kar_dtl_no_ktp'];?>" class="form-control" id="kar_dtl_no_ktp" placeholder="No. KTP"  disabled>
                      </div>
                      <div class="col-sm-4">
                        <?php 
                        if($kar_data_detail['kar_dtl_exp_ktp']=="0000-00-00"){
                          $kar_dtl_exp_ktp="";
                        }else{
                          $kar_dtl_exp_ktp="$kar_data_detail[kar_dtl_exp_ktp]";
                        }
                        ?>
                        <input type="text" name="kar_dtl_exp_ktp" value="<?php echo $kar_dtl_exp_ktp;?>" class="form-control" id="kar_dtl_exp_ktp" placeholder="Masa Berlaku KTP" data-inputmask="'alias': 'yyyy-mm-dd'" data-mask  disabled>
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="kar_dtl_no_npw" class="col-sm-2 control-label">NPWP</label>
                      <div class="col-sm-10">
                        <input type="text" name="kar_dtl_no_npw" value="<?php echo $kar_data_detail['kar_dtl_no_npw'];?>" class="form-control" id="kar_dtl_no_npw" placeholder="No. NPWP"  disabled>
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="kar_dtl_no_kpj" class="col-sm-2 control-label">No. KPJ</label>
                      <div class="col-sm-10">
                        <input type="text" name="kar_dtl_no_kpj" value="<?php echo $kar_data_detail['kar_dtl_no_kpj'];?>" class="form-control" id="kar_dtl_no_kpj" placeholder="No. KPJ"  disabled>
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="kar_dtl_no_rek" class="col-sm-2 control-label">No. Rek</label>
                      <div class="col-sm-10">
                        <textarea name="kar_dtl_no_rek" class="form-control" id="kar_dtl_no_rek" placeholder="No. Rekening" disabled><?php echo $kar_data_detail['kar_dtl_no_rek'];?></textarea>
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="kar_dtl_no_bpj" class="col-sm-2 control-label">BPJS</label>
                      <div class="col-sm-10">
                        <input type="text" name="kar_dtl_no_bpj" value="<?php echo $kar_data_detail['kar_dtl_no_bpj'];?>" class="form-control" id="kar_dtl_no_bpj" placeholder="No. BPJS"  disabled>
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="kar_dtl_no_jms" class="col-sm-2 control-label">Jamsostek</label>
                      <div class="col-sm-10">
                        <input type="text" name="kar_dtl_no_jms" value="<?php echo $kar_data_detail['kar_dtl_no_jms'];?>" class="form-control" id="kar_dtl_no_jms" placeholder="No. Jamsostek"  disabled>
                      </div>
                    </div>
                  </div><!-- /.box-body -->

                  <div class="box-footer">
                    <!-- ini juga apa gitu -->
                  </div>
              </div><!-- /.box -->
            </form>


            <!-- general form elements -->
            <form class="form-horizontal" action="" method="post">
              <div class="box box-warning">
                <div class="box-header">
                  <h3 class="box-title">Contact</h3>
                  <!-- tools box -->
                  <div class="pull-right box-tools">
                    <button type="submit" name="bupdate_contact" id="bupdate_contact" class="btn btn-primary"><i class="fa fa-save"></i></button>
                    <button type="button" id="edit_contact" class="btn btn-primary"><i class="fa fa-pencil"></i></button>
                  </div><!-- /. tools -->
                </div><!-- /.box-header -->
                  <div class="box-body">
                    <div class="form-group">
                      <label for="kar_dtl_eml" class="col-sm-2 control-label">Email</label>
                      <div class="col-sm-10">
                        <input type="text" name="kar_dtl_eml" value="<?php echo $kar_data_detail['kar_dtl_eml'];?>" class="form-control" id="kar_dtl_eml" placeholder="Email"  disabled>
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="kar_dtl_tlp" class="col-sm-2 control-label">No. Tlp</label>
                      <div class="col-sm-10">
                        <textarea name="kar_dtl_tlp" class="form-control" id="kar_dtl_tlp" placeholder="No. Telepon"  disabled><?php echo $kar_data_detail['kar_dtl_tlp'];?></textarea>
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="kar_dtl_alt" class="col-sm-2 control-label">Alamat</label>
                      <div class="col-sm-10">
                        <textarea name="kar_dtl_alt" class="form-control" id="kar_dtl_alt" placeholder="Alamat"  disabled><?php echo $kar_data_detail['kar_dtl_alt'];?></textarea>
                      </div>
                    </div>
                  </div><!-- /.box-body -->

                  <div class="box-footer">
                    <!-- ini juga apa gitu -->
                  </div>
              </div><!-- /.box -->
            </form>

        </div>
        <!-- /.col --> 

      </div>
      <!-- /.row --> 
      
      <div class="row">
        <div class="col-xs-12">
          
        </div>
        <!-- /.col --> 
      </div>
      <!-- /.row --> 
      
    </section>
    <!-- /.content --> 