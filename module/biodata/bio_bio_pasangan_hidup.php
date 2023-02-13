<?php require('module/biodata/bio_act.php'); ?>

<!-- Content Header (Page header) -->

    <section class="content-header">

      <h1> <?php echo $title;?> <small></small> </h1>

      <ol class="breadcrumb">

        <li><a href="media.php"><i class="fa fa-dashboard"></i> Dashboard</a></li>

        <li><a href="?p=biodata"> Biodata</a></li>

	<li><a href="?p=pasangan_hidup"> Pasangan Hidup</a></li>

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

                  <h3 class="box-title"> Bio PH</h3>

                  	<div class="pull-right box-tools">

                      <button type="submit" name="update_bio_pasangan_hidup" id="update_bio_pasangan_hidup" class="btn btn-primary"><i class="fa fa-save"></i></button>

                      <button type="button" id="edit_bio_pasangan_hidup" class="btn btn-primary"><i class="fa fa-pencil"></i></button>

                    </div>

                </div><!-- /.box-header -->

                  <div class="box-body">



                  <div class="form-group">

                    <label for="bio_ph_nm" class="col-sm-2 control-label">Nama Lengkap</label>

                    <div class="col-sm-10">

                      <input type="text" name="bio_ph_nm" value="<?php echo $data['bio_ph_nm'];?>" class="form-control" id="bio_ph_nm" placeholder="Nama Lengkap" required disabled>

                    </div>

                  </div>  

                  <div class="form-group">

                    <label for="bio_ph_nm_panggil" class="col-sm-2 control-label">Nama Panggil</label>

                    <div class="col-sm-10">

                      <input type="text" name="bio_ph_nm_panggil" value="<?php echo $data['bio_ph_nm_panggil'];?>" class="form-control" id="bio_ph_nm_panggil" placeholder="Nama Panggil" required disabled>

                    </div>

                  </div>

                  <div class="form-group">

                    <label for="bio_ph_tml" class="col-sm-2 control-label">Tempat Lahir</label>

                    <div class="col-sm-10">

                      <input type="text" name="bio_ph_tml" value="<?php echo $data['bio_ph_tml'];?>" class="form-control" id="bio_ph_tml" placeholder="Tempat Lahir" required disabled>

                    </div>

                  </div>

                  <div class="form-group">

                    <label for="bio_ph_tll" class="col-sm-2 control-label">Tanggal Lahir</label>

                    <div class="col-sm-10">

                      <input type="text" name="bio_ph_tll" value="<?php echo $data['bio_ph_tll'];?>" class="form-control" id="bio_ph_tll" placeholder="Tanggal Lahir" required disabled>

                    </div>

                  </div>

		  <div class="form-group">

                    <label for="bio_ph_goldarah" class="col-sm-2 control-label">Golongan Darah</label>

                    <div class="col-sm-10">

		      <?php

		      $goldarah=array(

				  "A" => 'A',

				  "B" => 'B',

				  "AB" => 'AB', 

				  "O" => 'O'

				);

		      

		      foreach($goldarah as $value => $caption) {

			if($value==$data['bio_ph_goldarah']){

			  $goldarah_cek="checked";

			}else{

			  $goldarah_cek="";

			}

		      ?>

                      <input type="radio" name="bio_ph_goldarah" value="<?php echo $value;?>" class="flat-red" id="bio_ph_goldarah" <?php echo $goldarah_cek;?> /> <?php echo $caption;?> &nbsp;

                      <?php }?>

                    </div>

                  </div>

                  <div class="form-group">

                    <label for="bio_ph_agama" class="col-sm-2 control-label">Agama</label>

                    <div class="col-sm-10">

                      <select class="form-control" name="bio_ph_agama" id="bio_ph_agama" required disabled>

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

			  if($value==$data['bio_ph_agama']){

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