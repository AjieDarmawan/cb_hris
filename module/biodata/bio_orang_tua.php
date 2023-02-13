<?php require('module/biodata/bio_act.php'); ?>
<!-- Content Header (Page header) -->
    <section class="content-header">
      <h1> <?php echo $title;?> <small></small> </h1>
      <ol class="breadcrumb">
        <li><a href="media.php"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li><a href="?p=biodata"> Biodata</a></li>
        <li><a href="?p=keluarga"> Keluarga</a></li>
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
                  <h3 class="box-title">Bapak Kandung</h3>
                  	<div class="pull-right box-tools">
                      <button type="submit" name="bupdate" id="bupdate" class="btn btn-primary"><i class="fa fa-save"></i></button>
                      <button type="button" id="edit" class="btn btn-primary"><i class="fa fa-pencil"></i></button>
                    </div>
                </div><!-- /.box-header -->
                  <div class="box-body">
                    
                  <div class="form-group">
                    <label for="nama_lengkap" class="col-sm-2 control-label">Nama Lengkap</label>
                    <div class="col-sm-10">
                      <input type="text" name="nama_lengkap" value="" class="form-control" id="nama_lengkap" placeholder="Nama Lengkap" required disabled>
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
                      <label for="kar_dtl_gen" class="col-sm-2 control-label">Status</label>
                      <div class="col-sm-10">
                        <input type="radio" name="kar_dtl_gen" value="Masih Hidup" class="flat-red" id="kar_dtl_gen" /> Masih Hidup &nbsp;
                        <input type="radio" name="kar_dtl_gen" value="Almarhum" class="flat-red" id="kar_dtl_gen" /> Almarhum &nbsp;
                      </div>
                  </div>
		  <div class="form-group">
                      <label for="alamat" class="col-sm-2 control-label">Alamat</label>
                      <div class="col-sm-10">
                        <textarea name="alamat" class="form-control" id="alamat" placeholder="alamat" disabled></textarea>
                      </div>
                  </div>
		  <div class="form-group">
                    <label for="rt_rw" class="col-sm-2 control-label">Pekerjaan</label>
                    <div class="col-sm-10">
                      <input type="text" name="rt_rw" value="" class="form-control" id="rt_rw" placeholder="Pekerjaan" required disabled>
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
		 
                 
                  </div><!-- /.box-body -->

                  <div class="box-footer">
                    <!-- apa gitu -->
                  </div>
              </div><!-- /.box -->
              </form>
	      
          </div>



          <div class="col-md-4">
           
            <!-- general form elements -->
            <form class="form-horizontal" action="" method="post">
              <div class="box box-success">
                <div class="box-header">
                  <h3 class="box-title">Ibu Kandung</h3>
                  <!-- tools box -->
                  <div class="pull-right box-tools">
                    <button type="submit" name="bupdate_bio" id="bupdate_bio" class="btn btn-primary"><i class="fa fa-save"></i></button>
                    <button type="button" id="edit_bio" class="btn btn-primary"><i class="fa fa-pencil"></i></button>
                  </div><!-- /. tools -->
                </div><!-- /.box-header -->
                  <div class="box-body">
                    
                    <div class="form-group">
                    <label for="nama_lengkap" class="col-sm-2 control-label">Nama Lengkap</label>
                    <div class="col-sm-10">
                      <input type="text" name="nama_lengkap" value="" class="form-control" id="nama_lengkap" placeholder="Nama Lengkap Gadis Ibu" required disabled>
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
                      <label for="kar_dtl_gen" class="col-sm-2 control-label">Status</label>
                      <div class="col-sm-10">
                        <input type="radio" name="kar_dtl_gen" value="Masih Hidup" class="flat-red" id="kar_dtl_gen" /> Masih Hidup &nbsp;
                        <input type="radio" name="kar_dtl_gen" value="Almarhum" class="flat-red" id="kar_dtl_gen" /> Almarhum &nbsp;
                      </div>
                  </div>
		  <div class="form-group">
                      <label for="alamat" class="col-sm-2 control-label">Alamat</label>
                      <div class="col-sm-10">
                        <textarea name="alamat" class="form-control" id="alamat" placeholder="alamat" disabled></textarea>
                      </div>
                  </div>
		  <div class="form-group">
                    <label for="rt_rw" class="col-sm-2 control-label">Pekerjaan</label>
                    <div class="col-sm-10">
                      <input type="text" name="rt_rw" value="" class="form-control" id="rt_rw" placeholder="Pekerjaan" required disabled>
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