<?php require('module/biodata/bio_act.php'); ?>

<!-- Content Header (Page header) -->

    <section class="content-header">

      <h1> <?php echo $title;?> <small></small> </h1>

      <ol class="breadcrumb">

        <li><a href="media.php"><i class="fa fa-dashboard"></i> Dashboard</a></li>

        <li><a href="?p=biodata"> Biodata</a></li>

        <li class="active"><?php echo $title;?></li>

      </ol>

    </section>

    

    <!-- Main content -->

    <section class="content"> 

      

      <!-- Your Page Content Here -->

      <div class="row">

        <!-- left column -->

            <div class="col-md-8">

              <!-- general form elements -->

              <!-- form start -->

              <form class="form-horizontal" action="" method="post">

              <div class="box box-primary">

                <div class="box-header">

                  <h3 class="box-title"> Personal Bio</h3>

                  	<div class="pull-right box-tools">

                      <button type="submit" name="bsave_bio_bio" id="bsave_bio_bio" class="btn btn-primary"><i class="fa fa-save"></i></button>

                      <button type="button" id="edit_bio_bio" class="btn btn-primary"><i class="fa fa-pencil"></i></button>

                    </div>

                </div><!-- /.box-header -->

                  <div class="box-body">

		    

	  <div class="col-md-6">

		    

                  <div class="form-group">

                    <label for="bio_nm_panggil" class="col-sm-2 control-label">Nama Panggil</label>

                    <div class="col-sm-10">

                      <input type="text" name="bio_nm_panggil" value="<?php echo $data['bio_nm_panggil'];?>" class="form-control" id="bio_nm_panggil" placeholder="Nama Panggil" required disabled>

                    </div>

                  </div>

                  <div class="form-group">

                    <label for="bio_gender" class="col-sm-2 control-label">Gender</label>

                    <div class="col-sm-10">

		      <?php

		      $gender=array(

				  "Pria" => 'Pria',

				  "Wanita" => 'Wanita'

				);

		      

		      foreach($gender as $value => $caption) {

			if($value==$data['bio_gender']){

			  $gender_cek="checked";

			}else{

			  $gender_cek="";

			}

		      ?>

                      <input type="radio" name="bio_gender" value="<?php echo $value;?>" class="flat-red" id="bio_gender" <?php echo $gender_cek;?> /> <?php echo $caption;?> &nbsp;

                      <?php }?>

                    </div>

                  </div>

                  <div class="form-group">

                    <label for="bio_tml" class="col-sm-2 control-label">Tempat Lahir</label>

                    <div class="col-sm-10">

                      <input type="text" name="bio_tml" value="<?php echo $data['bio_tml'];?>" class="form-control" id="bio_tml" placeholder="Tempat Lahir" required disabled>

                    </div>

                  </div>

		  <div class="form-group">

                    <label for="bio_goldarah" class="col-sm-2 control-label">Golongan Darah</label>

                    <div class="col-sm-10">

		      <?php

		      $goldarah=array(

				  "A" => 'A',

				  "B" => 'B',

				  "AB" => 'AB', 

				  "O" => 'O'

				);

		      

		      foreach($goldarah as $value => $caption) {

			if($value==$data['bio_goldarah']){

			  $goldarah_cek="checked";

			}else{

			  $goldarah_cek="";

			}

		      ?>

                      <input type="radio" name="bio_goldarah" value="<?php echo $value;?>" class="flat-red" id="bio_goldarah" <?php echo $goldarah_cek;?> /> <?php echo $caption;?> &nbsp;

                      <?php }?>

                    </div>

                  </div>

                  <div class="form-group">

                    <label for="bio_agama" class="col-sm-2 control-label">Agama</label>

                    <div class="col-sm-10">

                      <select class="form-control" name="bio_agama" id="bio_agama" required disabled>

                        <option value="" selected> -- Pilih --</option>

			<?php

			$agama=array(

				    "Islam" => 'Islam',

				    "Kristen Protestan" => 'Kristen Protestan',

				    "Kristen Katolik" => 'Kristen Katolik', 

				    "Hindu" => 'Hindu',

				    "Budha" => 'Budha'

				  );

			

			foreach($agama as $value => $caption) {

			  if($value==$data['bio_agama']){

			    $agama_cek="selected";

			  }else{

			    $agama_cek="";

			  }

			?>

			<option value="<?php echo $value;?>" <?php echo $agama_cek;?>> <?php echo $caption;?></option>

			<?php }?>

                      </select>

                    </div>

                  </div>

		  <div class="form-group">

                    <label for="bio_bintang" class="col-sm-2 control-label">Bintang</label>

                    <div class="col-sm-10">

                      <select class="form-control" name="bio_bintang" id="bio_bintang" required disabled>

                        <option value="" selected> -- Pilih --</option>

			<?php

			$bintang=array(

				    "Capricon" => 'Capricon',

				    "Aquarius" => 'Aquarius',

				    "Pisces" => 'Pisces', 

				    "Aries" => 'Aries',

				    "Taurus" => 'Taurus',

				    "Gemini" => 'Gemini',

				    "Cancer" => 'Cancer',

				    "Leo" => 'Leo', 

				    "Virgo" => 'Virgo',

				    "Libra" => 'Libra',

				    "Scorpio" => 'Scorpio',

				    "Sagitarius" => 'Sagitarius'

				  );

			

			foreach($bintang as $value => $caption) {

			  if($value==$data['bio_bintang']){

			    $bintang_cek="selected";

			  }else{

			    $bintang_cek="";

			  }

			?>

			<option value="<?php echo $value; ?>" <?php echo $bintang_cek; ?>> <?php echo $caption; ?></option>

			<?php }?>

                      </select>

                    </div>

                  </div>

		  <div class="form-group">

                    <label for="bio_shio" class="col-sm-2 control-label">Shio</label>

                    <div class="col-sm-10">

                      <select class="form-control" name="bio_shio" id="bio_shio" required disabled>

                        <option value="" selected> -- Pilih --</option>

			<?php

			$shio=array(

				    "Naga" => 'Naga',

				    "Tikus" => 'Tikus',

				    "Monyet" => 'Monyet', 

				    "Kelinci" => 'Kelinci',

				    "Babi" => 'Babi',

				    "Kambing" => 'Kambing',

				    "Harimau" => 'Harimau',

				    "Anjing" => 'Anjing', 

				    "Kuda" => 'Kuda',

				    "Kerbau" => 'Kerbau',

				    "Ayam" => 'Ayam',

				    "Ular" => 'Ular'

				  );

			

			foreach($shio as $value => $caption) {

			  if($value==$data['bio_shio']){

			    $shio_cek="selected";

			  }else{

			    $shio_cek="";

			  }

			?>

			<option value="<?php echo $value; ?>" <?php echo $shio_cek; ?>> <?php echo $caption; ?></option>

			<?php }?>

                      </select>

                    </div>

                  </div>

		  <div class="form-group">

                      <label for="bio_alt" class="col-sm-2 control-label">Alamat</label>

                      <div class="col-sm-10">

                        <textarea name="bio_alt" class="form-control" id="bio_alt" placeholder="Alamat" required disabled><?php echo $data['bio_alt'];?></textarea>

                      </div>

                  </div>

		  

		  

	  </div>

	  <!-- /.col --> 	



          <div class="col-md-6">

            

		  

		  <div class="form-group">

                    <label for="bio_rtrw" class="col-sm-2 control-label">RT / RW</label>

                    <div class="col-sm-10">

                      <input type="text" name="bio_rtrw" value="<?php echo $data['bio_rtrw'];?>" class="form-control" id="bio_rtrw" placeholder="RT / RW" required disabled>

                    </div>

                  </div>

		  <div class="form-group">

                    <label for="bio_kelurahan" class="col-sm-2 control-label">Kelurahan</label>

                    <div class="col-sm-10">

                      <input type="text" name="bio_kelurahan" value="<?php echo $data['bio_kelurahan'];?>" class="form-control" id="bio_kelurahan" placeholder="Kelurahan" required disabled>

                    </div>

                  </div>

		  <div class="form-group">

                    <label for="bio_kecamatan" class="col-sm-2 control-label">Kecamatan</label>

                    <div class="col-sm-10">

                      <input type="text" name="bio_kecamatan" value="<?php echo $data['bio_kecamatan'];?>" class="form-control" id="bio_kecamatan" placeholder="Kecamatan" required disabled>

                    </div>

                  </div>

		  <div class="form-group">

                    <label for="bio_kota" class="col-sm-2 control-label">Kota</label>

                    <div class="col-sm-10">

                      <input type="text" name="bio_kota" value="<?php echo $data['bio_kota'];?>" class="form-control" id="bio_kota" placeholder="Kota" required disabled>

                    </div>

                  </div>

		  <div class="form-group">

                    <label for="bio_propinsi" class="col-sm-2 control-label">Propinsi</label>

                    <div class="col-sm-10">

                      <input type="text" name="bio_propinsi" value="<?php echo $data['bio_propinsi'];?>" class="form-control" id="bio_propinsi" placeholder="Propinsi" required disabled>

                    </div>

                  </div>

		  <div class="form-group">

                    <label for="bio_kodepos" class="col-sm-2 control-label">Kode Pos</label>

                    <div class="col-sm-10">

                      <input type="text" name="bio_kodepos" value="<?php echo $data['bio_kodepos'];?>" class="form-control" id="bio_kodepos" placeholder="Kode Pos" required disabled>

                    </div>

                  </div>

		  <div class="form-group">

                    <label for="bio_tlp" class="col-sm-2 control-label">Telepon</label>

                    <div class="col-sm-10">

                      <input type="text" name="bio_tlp" value="<?php echo $data['bio_tlp'];?>" class="form-control" id="bio_tlp" placeholder="Telepon" required disabled>

                    </div>

                  </div>

		  <div class="form-group">

                    <label for="bio_hp" class="col-sm-2 control-label">HP</label>

                    <div class="col-sm-10">

                      <input type="text" name="bio_hp" value="<?php echo $data['bio_hp'];?>" class="form-control" id="bio_hp" placeholder="HP" required disabled>

                    </div>

                  </div>

		  <div class="form-group">

                    <label for="bio_eml" class="col-sm-2 control-label">Email</label>

                    <div class="col-sm-10">

                      <input type="email" name="bio_eml" value="<?php echo $data['bio_eml'];?>" class="form-control" id="bio_eml" placeholder="Email" required disabled>

                    </div>

                  </div>

		  <div class="form-group">

                    <label for="bio_web" class="col-sm-2 control-label">Website</label>

                    <div class="col-sm-10">

                      <input type="text" name="bio_web" value="<?php echo $data['bio_web'];?>" class="form-control" id="bio_web" placeholder="Website" required disabled>

                    </div>

                  </div>

		  

	   </div>

	  <!-- /.col --> 

                  

                  </div><!-- /.box-body -->



                  <div class="box-footer">

                    <!-- apa gitu -->

                  </div>

              </div><!-- /.box -->

              </form>

	      

          </div>





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