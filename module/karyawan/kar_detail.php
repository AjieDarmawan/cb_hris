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
                    <label for="kar_nik" class="col-sm-2 control-label">NIK</label>
                    <div class="col-sm-10">
                      <input type="text" name="kar_nik" value="<?php echo $kar_data_id['kar_nik'];?>" class="form-control" id="kar_nik" placeholder="NIK" required disabled>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="kar_nm" class="col-sm-2 control-label">Nama</label>
                    <div class="col-sm-10">
                      <input type="text" name="kar_nm" value="<?php echo $kar_data_id['kar_nm'];?>" class="form-control" id="kar_nm" placeholder="Nama Karyawan" required disabled>
                    </div>
                  </div>
				  <div class="form-group">
                    <label for="kar_nm" class="col-sm-2 control-label">Nama Panggilan</label>
                    <div class="col-sm-10">
                      <input type="text" name="kar_nm_panggilan" value="<?php echo $kar_data_id['kar_nm_panggilan'];?>" class="form-control" id="kar_nm_panggilan" placeholder="Nama Panggilan Karyawan" required disabled>
                    </div>
                  </div>
                  <div class="form-group" style="display:none;">
                    <label for="kar_tgl_lahir" class="col-sm-2 control-label">Tgl Lahir</label>
                    <div class="col-sm-10">
                      <input type="text" name="kar_tgl_lahir" value="<?php echo $kar_data_id['kar_tgl_lahir'];?>" class="form-control" id="kar_tgl_lahir" placeholder="Tanggal Lahir" data-inputmask="'alias': 'yyyy-mm-dd'" data-mask required disabled>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="div_id" class="col-sm-2 control-label">Divisi</label>
                    <div class="col-sm-10">
                      <select class="form-control" name="div_id" id="div_id" required disabled>
                        <?php
                        $div_tampil=$div->div_tampil();
                        foreach($div_tampil as $data){	
						if($kar_data_id['div_id']==$data['div_id']){
                        ?>
                        <option value="<?php echo $data['div_id']; ?>" selected><?php echo $data['div_nm']; ?></option>
                        <?php
						}else{
						?>
                        <option value="<?php echo $data['div_id']; ?>"><?php echo $data['div_nm']; ?></option>
                        <?php }}?>
                      </select>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="jbt_id" class="col-sm-2 control-label">Jabatan</label>
                    <div class="col-sm-10">
                      <select class="form-control" name="jbt_id" id="jbt_id" required disabled>
                        <?php
                        $jbt_tampil=$jbt->jbt_tampil();
                        foreach($jbt_tampil as $data){	
						if($kar_data_id['jbt_id']==$data['jbt_id']){
                        ?>
                        <option value="<?php echo $data['jbt_id']; ?>" selected><?php echo $data['jbt_nm']; ?></option>
                        <?php
						}else{
						?>
                        <option value="<?php echo $data['jbt_id']; ?>"><?php echo $data['jbt_nm']; ?></option>
                        <?php }}?>
                      </select>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="lvl_id" class="col-sm-2 control-label">Level</label>
                    <div class="col-sm-10">
                      <select class="form-control" name="lvl_id" id="lvl_id" required disabled>
                        <?php
                        $lvl_tampil=$lvl->lvl_tampil();
                        foreach($lvl_tampil as $data){
						if($kar_data_id['lvl_id']==$data['lvl_id']){	
                        ?>
                        <option value="<?php echo $data['lvl_id']; ?>" selected><?php echo $data['lvl_nm']; ?></option>
                        <?php
						}else{
						?>
                        <option value="<?php echo $data['lvl_id']; ?>"><?php echo $data['lvl_nm']; ?></option>
                        <?php }}?>
                      </select>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="unt_id" class="col-sm-2 control-label">Unit</label>
                    <div class="col-sm-10">
                      <select class="form-control" name="unt_id" id="unt_id" required disabled>
                        <?php
                        $unt_tampil=$unt->unt_tampil();
                        foreach($unt_tampil as $data){	
						if($kar_data_id['unt_id']==$data['unt_id']){
                        ?>
                        <option value="<?php echo $data['unt_id']; ?>" selected><?php echo $data['unt_nm']; ?></option>
                        <?php
						}else{
						?>
                        <option value="<?php echo $data['unt_id']; ?>"><?php echo $data['unt_nm']; ?></option>
                        <?php }}?>
                      </select>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="ktr_id" class="col-sm-2 control-label">Kantor</label>
                    <div class="col-sm-10">
                      <select class="form-control selectpicker" data-live-search="true" name="ktr_id" id="ktr_id">
                        <?php
                        $ktr_tampil=$ktr->ktr_tampil();
                        foreach($ktr_tampil as $data){
			  if(($data['ktr_aktif']=="A")){
						if($kar_data_id['ktr_id']==$data['ktr_id']){
                        ?>
                        <option value="<?php echo $data['ktr_id']; ?>" selected><?php echo $data['ktr_nm']; ?></option>
                        <?php
						}else{
						?>
                        <option value="<?php echo $data['ktr_id']; ?>"><?php echo $data['ktr_nm']; ?></option>
                        <?php }}}?>
                      </select>
                    </div>
                  </div>
				  <div class="form-group">
                    <label for="kot_id" class="col-sm-2 control-label">Kota</label>
                    <div class="col-sm-10">
                      <select class="form-control" name="kot_id" id="kot_id" required disabled>
						<option></option>
                        <?php
                        $kot_tampil=$kot->kot_tampil();
                        foreach($kot_tampil as $data){
						if($kar_data_id['kot_id']==$data['kot_id']){
                        ?>
                        <option value="<?php echo $data['kot_id']; ?>" selected><?php echo $data['kot_kota']; ?></option>
                        <?php
						}else{
						?>
                        <option value="<?php echo $data['kot_id']; ?>"><?php echo $data['kot_kota']; ?></option>
                        <?php }}?>
                      </select>
                    </div>
                  </div>
				  <div class="form-group">
                    <label for="pt_id" class="col-sm-2 control-label">PT</label>
                    <div class="col-sm-10">
                      <select class="form-control" name="pt_id" id="pt_id" required disabled>
						<option></option>
                        <?php
                        $npt_tampil=$npt->npt_tampil();
                        foreach($npt_tampil as $data){
						if($kar_data_id['pt_id']==$data['pt_id']){
                        ?>
                        <option value="<?php echo $data['pt_id']; ?>" selected><?php echo $data['pt_nama']; ?></option>
                        <?php
						}else{
						?>
                        <option value="<?php echo $data['pt_id']; ?>"><?php echo $data['pt_nama']; ?></option>
                        <?php }}?>
                      </select>
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
                        }elseif($kar_data_detail['kar_dtl_typ_krj']=="Kartap"){
                          $checked_permanen="checked";
                        }elseif($kar_data_detail['kar_dtl_typ_krj']=="Resign"){
                          $checked_resign="checked";
                        }else{
                          $checked_kontrak="checked";
                        }
                        ?>
                        <input type="radio" name="kar_dtl_typ_krj" value="Kontrak" class="flat-red" id="kontrak" <?php echo $checked_kontrak;?>/> Kontrak &nbsp;
                        <input type="radio" name="kar_dtl_typ_krj" value="Kartap" class="flat-red" id="kartap" <?php echo $checked_permanen;?>/> Kartap &nbsp;
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
					<div class="form-group">
                      <label for="kar_dtl_tgl_joi2" class="col-sm-2 control-label">Tgl Join 2</label>
                      <div class="col-sm-10">
                        <?php 
                        if($kar_data_detail['kar_dtl_tgl_joi2']=="0000-00-00"){
                          $kar_dtl_tgl_joi2="";
                        }else{
                          $kar_dtl_tgl_joi2="$kar_data_detail[kar_dtl_tgl_joi2]";
                        }
                        ?>
                        <input type="text" name="kar_dtl_tgl_joi2" value="<?php echo $kar_dtl_tgl_joi2;?>" class="form-control" id="kar_dtl_tgl_joi2" placeholder="Tanggal Join" data-inputmask="'alias': 'yyyy-mm-dd'" data-mask disabled>
                      </div>
                    </div>
					<div class="form-group">
                      <label for="kar_dtl_tgl_sk" class="col-sm-2 control-label">Tgl SK</label>
                      <div class="col-sm-10">
                        <?php 
                        if($kar_data_detail['kar_dtl_tgl_sk']=="0000-00-00"){
                          $kar_dtl_tgl_sk="";
                        }else{
                          $kar_dtl_tgl_sk="$kar_data_detail[kar_dtl_tgl_sk]";
                        }
                        ?>
                        <input type="text" name="kar_dtl_tgl_sk" value="<?php echo $kar_dtl_tgl_sk;?>" class="form-control" id="kar_dtl_tgl_sk" placeholder="Tanggal SK" data-inputmask="'alias': 'yyyy-mm-dd'" data-mask disabled>
                      </div>
                    </div>
					<div class="form-group">
                      <label for="kar_dtl_tgl_ttp" class="col-sm-2 control-label">Tgl Tetap</label>
                      <div class="col-sm-10">
                        <?php 
                        if($kar_data_detail['kar_dtl_tgl_ttp']=="0000-00-00"){
                          $kar_dtl_tgl_ttp="";
                        }else{
                          $kar_dtl_tgl_ttp="$kar_data_detail[kar_dtl_tgl_ttp]";
                        }
                        ?>
                        <input type="text" name="kar_dtl_tgl_ttp" value="<?php echo $kar_dtl_tgl_ttp;?>" class="form-control" id="kar_dtl_tgl_ttp" placeholder="Tanggal Tetap" data-inputmask="'alias': 'yyyy-mm-dd'" data-mask disabled>
                      </div>
                    </div>
					<div class="form-group">
                      <label for="kar_dtl_tgl_res" class="col-sm-2 control-label">Tgl Non Aktif</label>
                      <div class="col-sm-10">
                        <?php 
                        if($kar_data_detail['kar_dtl_tgl_res']=="0000-00-00"){
                          $kar_dtl_tgl_res="";
                        }else{
                          $kar_dtl_tgl_res="$kar_data_detail[kar_dtl_tgl_res]";
                        }
                        ?>
                        <input type="text" name="kar_dtl_tgl_res" value="<?php echo $kar_dtl_tgl_res;?>" class="form-control" id="kar_dtl_tgl_res" placeholder="Tanggal Non Aktif" data-inputmask="'alias': 'yyyy-mm-dd'" data-mask disabled>
                      </div>
                    </div>
					<!--
					<div class="form-group">
                      <label for="kar_dtl_als_res" class="col-sm-2 control-label">Alasan PHK</label>
                      <div class="col-sm-10">
                        <textarea name="kar_dtl_als_res" class="form-control" id="kar_dtl_als_res" placeholder="Alasan PHK"  disabled><?php echo $kar_data_detail['kar_dtl_als_res'];?></textarea>
                      </div>
                    </div>
					-->
					<div class="form-group">
                      <label for="kar_dtl_als_res" class="col-sm-2 control-label">Alasan Non Aktif</label>
                      <div class="col-sm-10">
						<?php
							if($kar_data_detail['kar_dtl_als_res'] == "Mengundurkan Diri"){
								$sel_1 = "selected";
							}else{
								$sel_1 = "";
							}
							
							if($kar_data_detail['kar_dtl_als_res'] == "Pemutusan Hubungan Kerja (PHK)"){
								$sel_2 = "selected";
							}else{
								$sel_2 = "";
							}
							
							if($kar_data_detail['kar_dtl_als_res'] == "Berakhir Kontrak (Pekerja dengan Status PKWT/Kontrak)"){
								$sel_3 = "selected";
							}else{
								$sel_3 = "";
							}
							
							if($kar_data_detail['kar_dtl_als_res'] == "Usia Pensiun"){
								$sel_4 = "selected";
							}else{
								$sel_4 = "";
							}
							
							if($kar_data_detail['kar_dtl_als_res'] == "Catat Total Tetap"){
								$sel_5 = "selected";
							}else{
								$sel_5 = "";
							}
							
							if($kar_data_detail['kar_dtl_als_res'] == "Pensiun Karena PKB Perusahaan"){
								$sel_6 = "selected";
							}else{
								$sel_6 = "";
							}
							
							if($kar_data_detail['kar_dtl_als_res'] == "Meninggal Dunia"){
								$sel_7 = "selected";
							}else{
								$sel_7 = "";
							}
							
							if($kar_data_detail['kar_dtl_als_res'] == "Pindah Unit Kerja"){
								$sel_8 = "selected";
							}else{
								$sel_8 = "";
							}
							
							if($kar_data_detail['kar_dtl_als_res'] == "Peserta Meninggalkan Indonesia Untuk Selamanya"){
								$sel_9 = "selected";
							}else{
								$sel_9 = "";
							}
							
							
						?>
						
							<select name="kar_dtl_als_res" id="types_informasi" style="width:300px;">
							<option value="">Pilih Sebab Non Aktif</option>
							<option value="Mengundurkan Diri" <?php echo $sel_1;?> >Mengundurkan Diri</option>
							<option value="Pemutusan Hubungan Kerja (PHK)" <?php echo $sel_2;?>>Pemutusan Hubungan Kerja (PHK</option>
							<option value="Berakhir Kontrak (Pekerja dengan Status PKWT/Kontrak)" <?php echo $sel_3;?>>Berakhir Kontrak (Pekerja dengan Status PKWT/Kontrak</option>
							<option value="Usia Pensiun" <?php echo $sel_4;?>>Usia Pensiun</option>
							<option value="Catat Total Tetap" <?php echo $sel_5;?>>Catat Total Tetap</option>
							<option value="Pensiun Karena PKB Perusahaan" <?php echo $sel_6;?>>Pensiun Karena PKB Perusahaan</option>
							<option value="Meninggal Dunia" <?php echo $sel_7;?>>Meninggal Dunia</option>
							<option value="Pindah Unit Kerja" <?php echo $sel_8;?>>Pindah Unit Kerja</option>
							<option value="Peserta Meninggalkan Indonesia Untuk Selamanya" <?php echo $sel_9;?>>Peserta Meninggalkan Indonesia Untuk Selamanya</option>
						</select>						
          
                      </div>
					  <div class="col-sm-10" id="mengundurkandiri" style="width:250px;display: none;">
                        <textarea name="kar_dtl_als_res_md" class="form-control" id="mengundurkandiri"  placeholder="Alasan Mengundurkan Diri"></textarea>
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
                      <label for="kar_dtl_agama" class="col-sm-2 control-label">Agama</label>
                      <div class="col-sm-10">
                        <select class="form-control" name="kar_dtl_agama" id="kar_dtl_agama" disabled>
                        <?php 
                        if($kar_data_detail['kar_dtl_agama']=="Islam"){
                          $selected_islam="selected";
                        }elseif($kar_data_detail['kar_dtl_agama']=="Katholik"){
                          $selected_katholik="selected";
                        }elseif($kar_data_detail['kar_dtl_agama']=="Protestan"){
                          $selected_protestan="selected";
                        }elseif($kar_data_detail['kar_dtl_agama']=="Budha"){
                          $selected_budha="selected";
                        }elseif($kar_data_detail['kar_dtl_agama']=="Hindu"){
                          $selected_hindu="selected";
                        }else{
                          $selected_lainya="selected";
                        }
                        ?>
                            <option value="Islam" <?php echo $selected_islam;?>>Islam</option>
                            <option value="Katholik" <?php echo $selected_katholik;?>>Katholik</option>
                            <option value="Protestan" <?php echo $selected_protestan;?>>Protestan</option>
                            <option value="Budha" <?php echo $selected_budha;?>>Budha</option>
                            <option value="Hindu" <?php echo $selected_hindu;?>>Hindu</option>
                            <option value="" <?php echo $selected_lainya;?>>Lainnya</option>
                        </select>
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="kar_dtl_tmp_lhr" class="col-sm-2 control-label">Tmp Lahir</label>
                      <div class="col-sm-10">
                        <input type="text" name="kar_dtl_tmp_lhr" value="<?php echo $kar_data_detail['kar_dtl_tmp_lhr'];?>" class="form-control" id="kar_dtl_tmp_lhr" placeholder="Tempat Lahir" disabled>
                      </div>
                    </div>
					<div class="form-group">
                    <label for="kar_dtl_tgl_lahir" class="col-sm-2 control-label">Tgl Lahir</label>
                    <div class="col-sm-10">
                      <input type="text" name="kar_dtl_tgl_lahir" value="<?php echo $kar_data_detail['kar_dtl_tgl_lahir'];?>" class="form-control" id="kar_dtl_tgl_lahir" placeholder="Tanggal Lahir" data-inputmask="'alias': 'yyyy-mm-dd'" data-mask required disabled>
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
					<div class="form-group">
                      <label for="kar_dtl_ibu_kandung" class="col-sm-2 control-label">Ibu Kandung</label>
                      <div class="col-sm-10">
                        <input type="text" name="kar_dtl_ibu_kandung" value="<?php echo $kar_data_detail['kar_dtl_ibu_kandung'];?>" class="form-control" id="kar_dtl_ibu_kandung" placeholder="Ibu Kandung" disabled>
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
                        }elseif($kar_data_detail['kar_dtl_pnd']=="D4"){
                          $selected_d4="selected";
                        }elseif($kar_data_detail['kar_dtl_pnd']=="D3"){
                          $selected_d3="selected";
                        }elseif($kar_data_detail['kar_dtl_pnd']=="D2"){
                          $selected_d2="selected";
                        }elseif($kar_data_detail['kar_dtl_pnd']=="D1"){
                          $selected_d1="selected";
                        }elseif($kar_data_detail['kar_dtl_pnd']=="SMA"){
                          $selected_sma="selected";
                        }elseif($kar_data_detail['kar_dtl_pnd']=="SMK"){
                          $selected_smk="selected";
                        }elseif($kar_data_detail['kar_dtl_pnd']=="SMEA"){
                          $selected_smea="selected";
                        }elseif($kar_data_detail['kar_dtl_pnd']=="MAN"){
                          $selected_man="selected";
                        }elseif($kar_data_detail['kar_dtl_pnd']=="STM"){
                          $selected_stm="selected";
                        }elseif($kar_data_detail['kar_dtl_pnd']=="SMU-C"){
                          $selected_smuc="selected";
                        }elseif($kar_data_detail['kar_dtl_pnd']=="SMP"){
                          $selected_smp="selected";
                        }elseif($kar_data_detail['kar_dtl_pnd']=="SD"){
                          $selected_sd="selected";
                        }elseif($kar_data_detail['kar_dtl_pnd']=="Lainnya"){
                          $selected_lainnya="selected";
                        }else{
                          $selected_s1="selected";
                        }
                        ?>
                            <option value="S2" <?php echo $selected_s2;?>>S2</option>
                            <option value="S1" <?php echo $selected_s1;?>>S1</option>
			    <option value="D3" <?php echo $selected_d4;?>>D4</option>
                            <option value="D3" <?php echo $selected_d3;?>>D3</option>
			    <option value="D3" <?php echo $selected_d2;?>>D2</option>
			    <option value="D3" <?php echo $selected_d1;?>>D1</option>
                            <option value="SMA" <?php echo $selected_sma;?>>SMA</option>
                            <option value="SMK" <?php echo $selected_smk;?>>SMK</option>
                            <option value="SMEA" <?php echo $selected_smea;?>>SMEA</option>
			    <option value="SMEA" <?php echo $selected_man;?>>MAN</option>
                            <option value="STM" <?php echo $selected_stm;?>>STM</option>
			    <option value="STM" <?php echo $selected_smuc;?>>SMU-C</option>
                            <option value="SMP" <?php echo $selected_smp;?>>SMP</option>
			    <option value="SMP" <?php echo $selected_sd;?>>SD</option>
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
                      <label for="kar_dtl_no_kk" class="col-sm-2 control-label">KK</label>
                      <div class="col-sm-10">
                        <input type="text" name="kar_dtl_no_kk" value="<?php echo $kar_data_detail['kar_dtl_no_kk'];?>" class="form-control" id="kar_dtl_no_kk" placeholder="No. KK"  disabled>
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
                      <label for="kar_dtl_tlp_marketing" class="col-sm-2 control-label">No. Tlp Marketing</label>
                      <div class="col-sm-10">
                        <textarea name="kar_dtl_tlp_marketing" class="form-control" id="kar_dtl_tlp_marketing" placeholder="No. Telepon Marketing"  disabled><?php echo $kar_data_detail['kar_dtl_tlp_marketing'];?></textarea>
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="kar_dtl_alt" class="col-sm-2 control-label">Alamat</label>
                      <div class="col-sm-10">
                        <textarea name="kar_dtl_alt" class="form-control" id="kar_dtl_alt" placeholder="Alamat"  disabled><?php echo $kar_data_detail['kar_dtl_alt'];?></textarea>
                      </div>
                    </div>
					<div class="form-group">
                      <label for="kar_dtl_alt_dms" class="col-sm-2 control-label">Alamat Domisili</label>
                      <div class="col-sm-10">
                        <textarea name="kar_dtl_alt_dms" class="form-control" id="kar_dtl_alt_dms" placeholder="Alamat Domisili"  disabled><?php echo $kar_data_detail['kar_dtl_alt_dms'];?></textarea>
                      </div>
                    </div>
                  </div><!-- /.box-body -->

                  <div class="box-footer">
                    <!-- ini juga apa gitu -->
                  </div>
              </div><!-- /.box -->
	      
	      <!-- general form elements -->
            <form class="form-horizontal" action="" method="post">
              <div class="box box-warning">
                <div class="box-header">
                  <h3 class="box-title">Jadwal View Akses</h3>
                  <!-- tools box -->
                  <div class="pull-right box-tools">
                    <button type="submit" name="bupdate_jdwakses" id="bupdate_jdwakses" class="btn btn-primary"><i class="fa fa-save"></i></button>
                  </div><!-- /. tools -->
                </div><!-- /.box-header -->
                  <div class="box-body">
                    <div class="form-group">
                      <label for="kar_jdw_akses" class="col-sm-2 control-label">Akses</label>
                      <div class="col-sm-10">
			<?php
			if($kar_data_id['kar_jdw_akses']=='ALL'){
			?>
			<input type="text" value="<?php echo $kar_data_id['kar_jdw_akses'];?>" class="form-control" disabled>
			<?php }else{ ?>
			<select class="form-control select" name="kar_jdw_akses[]" multiple="multiple" style="width: 100%;">
			  <?php
			  $kar_tampil=$kar->kar_tampil();
			  if($kar_tampil){
			  foreach($kar_tampil as $data){
			    
			    $mystring = $kar_data_id['kar_jdw_akses'];
			    $findme   = $data['kar_nik'];
			    $pos = strpos($mystring, $findme);
			    if ($pos !== false) {
			      $selected_akses = "selected";
			    }else{
			      $selected_akses = "";
			    }
			  ?>
			  <option value="<?php echo $data['kar_nik'];?>" <?php echo $selected_akses;?>><?php echo $data['kar_nm'];?></option>
			  <?php }}?>
			</select>
			<?php }?>
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
	
	