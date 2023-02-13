<?php require('module/grade_pencapaian/grd_act.php'); ?>
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
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
			<!--
              <h3 class="box-title"><span style="cursor:pointer" class="label label-primary" data-toggle="modal" data-target="#myModal"><i class="fa fa-plus"></i></span></h3>-->
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="tb_grade_pencapaian" class="table table-bordered table-striped table-hover">
                <thead>
                  <tr>
                    <th>Wilayah</th>
                    <th>Manwil</th>
                    <th>kpt</th>
                    <th>Kampus</th>
                    <th>Status</th>
                    <th>Grade</th>
                    <th>Target</th>
                    <th>Jumlah Staff</th>
                    <th>Unit</th>
                    <th>Aksi</th>
                  </tr>
                </thead>
                <tbody>
                <?php
				$grd_tampil=$grd->grd_tampil();
				$grd_namaunit = $grd->grd_tampil_nmunit_by_nik(); // Ambil data karyawan semuanya
				
			
				if($grd_tampil){
				foreach($grd_tampil as $data){									
					$tmp_kar = array();
					//jadiin nik ke array split by koma
					foreach( @explode(",", $data['grd_karyawan']) as $k_kar => $v_kar) {
						
						@reset($grd_namaunit);
						//Cek niknya ada apa engga
						if(isset($grd_namaunit[$v_kar])) {
							//kalo ada ambil namanya
							$tmp_kar[] = $grd_namaunit[$v_kar]['kar_nm'];
						}
					}
					//gabungin namanya
					$data['txt_grd_karyawan'] = @implode(",", $tmp_kar);				
				?>
                  <tr>
                    <td><?php echo $data['grd_wilayah']; ?></td>
                    <td><?php echo $data['grd_manwil']; ?></td>
                    <td><?php echo $data['grd_kpt']; ?></td>
                    <td><?php echo $data['grd_pts']; ?></td>
                    <td><?php echo $data['grd_staff']; ?></td>
                    <td><b><?php echo $data['grd_grade']; ?></b></td>
                    <td><?php echo $data['grd_target']; ?></td>
                    <td><?php echo count($tmp_kar); ?></td>
                    <td><?php echo $data['txt_grd_karyawan'];?></td>
                   <td>
				   
                    <a href='javascript:;'
                        data-grd_id="<?php echo $data['grd_id']; ?>"
                        data-grdwilayah="<?php echo $data['grd_wilayah']; ?>"
                        data-grdmanwil="<?php echo $data['grd_manwil']; ?>"
                        data-grdkpt="<?php echo $data['grd_kpt']; ?>"
                        data-grdpts="<?php echo $data['grd_pts']; ?>"
                        data-grdgrade="<?php echo $data['grd_grade']; ?>"
                        data-grdtarget="<?php echo $data['grd_target']; ?>"
                        data-grdjmlstaff="<?php echo count($tmp_kar); ?>"
						data-grdkaryawan='<?php echo $data['grd_karyawan']; ?>'
						data-toggle="modal" data-target="#edit_use" title='Edit GRADE'><span style='cursor:pointer' title='Edit' class='label label-primary'><i class='fa fa-pencil'></i></span></a>
                  <!--
                    <a href="#block-confirm" data-toggle="modal" data-data="<h4>UNBLOCK Akun <strong><?php echo $data['acc_username'];?></strong></h4>" data-url="?p=data_account&act=unblock&id=<?php echo $data['acc_id'];?>"><span style="cursor:pointer" class="label label-danger"><i class="fa fa-ban"></i></span></a>
                    
                    <a href="#delete-confirm" data-toggle="modal" data-data="<?php echo $data['acc_username'];?>" data-url="?p=data_account&act=hapus&id=<?php echo $data['acc_id'];?>"><span style="cursor:pointer" class="label label-danger"><i class="fa fa-trash"></i></span></a>
					-->
                    </td>
                  </tr>
                <?php }}?>  
                </tbody>      
                <tfoot>
                  <tr>
                    <th>Wilayah</th>
                    <th>Manwil</th>
                    <th>kpt</th>
                    <th>Kampus</th>
                    <th>Status</th>
                    <th>Grade</th>
                    <th>Target</th>
                    <th>Jumlah Staff</th>
                    <th>Unit</th>
                    <th>Aksi</th>
                  </tr>
                </tfoot>
              </table>
            </div>
            <!-- /.box-body --> 
          </div>
          <!-- /.box --> 
        </div>
        <!-- /.col --> 
      </div>
      <!-- /.row --> 
      
    </section>
    <!-- /.content --> 
    
<!-- Modal Edit-->

<div class="modal fade" id="edit_use" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">

  <div class="modal-dialog">

    <div class="modal-content">

      <div class="modal-header bg-purple">

        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>

        <h4 class="modal-title" id="myModalLabel"><i class="fa fa-users"></i> Edit <span id="use_nama"></span></h4>

      </div>

      <form class="form-horizontal" action="" method="post" enctype="multipart/form-data">

      <input type="hidden" name="grd_id" id="grd_id">

      <div class="modal-body">
	  
		  <div class="form-group">

            <label for="grd_wilayah" class="col-sm-2 control-label">Wilayah</label>

            <div class="col-sm-10">

              <input  class="form-control" type="text" name="grd_wilayah"  id="grd_wilayah" readonly> 

            </div>

          </div>
		  
		  <div class="form-group">

            <label for="grd_manwil" class="col-sm-2 control-label">Manwil</label>

            <div class="col-sm-10">

              <input  class="form-control" type="text" name="grd_manwil"  id="grd_manwil"> 

            </div>

          </div>
		  
		  <div class="form-group">

            <label for="grd_kpt" class="col-sm-2 control-label">KPT</label>

            <div class="col-sm-10">

              <input  class="form-control" type="text" name="grd_kpt"  id="grd_kpt" readonly> 

            </div>

          </div>
		  
		  <div class="form-group">

            <label for="grd_pts" class="col-sm-2 control-label">Kampus</label>

            <div class="col-sm-10">

              <input  class="form-control" type="text" name="grd_pts"  id="grd_pts" readonly> 

            </div>

          </div>
		  
		  <div class="form-group">

            <label for="grd_grade" class="col-sm-2 control-label">Grade</label>

            <div class="col-sm-10">

              <input  class="form-control" type="text" name="grd_grade"  id="grd_grade"> 

            </div>

          </div>
		  
		  <div class="form-group">

            <label for="grd_target" class="col-sm-2 control-label">Target</label>

            <div class="col-sm-10">

              <input  class="form-control" type="text" name="grd_target"  id="grd_target"> 

            </div>

          </div>
		  

              <input  class="form-control" type="hidden" name="grd_jml_staff"  id="grd_jml_staff"> 



          <div class="form-group">

            <label for="grd_karyawan" class="col-sm-2 control-label">Karyawan</label>

            <div class="col-sm-10">

              <select class="form-control select" name="grd_karyawan[]" id="grd_karyawan" multiple="multiple" style="width: 100%;">
				<?php

                $db->koneksi();
				$div_value = "8"; //id divisi		
                $uni_tampil=$kar->kar_tampil_div_in_new($div_value);

                while($data=mysql_fetch_assoc($uni_tampil)){
		  $data_nik = str_replace(".","",$data['kar_nik']);
                ?>

                <option value="<?php echo $data_nik; ?>"> <?php echo $data['kar_nm'];?></option>

                <?php }?>
              </select>

            </div>

          </div>
<!--
	  <div class="form-group">

            <label for="use_kode2" class="col-sm-2 control-label">User Unit</label>

            <div class="col-sm-10">

              <select class="form-control select" name="use_kode2[]" id="use_kode2" multiple="multiple" style="width: 100%;" required>

                <option value="">-- Pilih --</option>



                <option value=""> </option>

                

              </select>

            </div>

          </div>

          <div class="form-group">

            <label for="use_pic" class="col-sm-2 control-label">PIC</label>

            <div class="col-sm-10">

              <input type="radio" name="use_pic" value="Y" id="use_pic_Y" class="flat-red"> Y&nbsp;&nbsp;&nbsp;

	      <input type="radio" name="use_pic" value="T" id="use_pic_T" class="flat-red"> T

            </div>

          </div>
-->
      </div>

      <div class="modal-footer">

	<button type="submit" name="bupdate" class="btn btn-block btn-success btn-flat">Update</button>

      </div>

      </form>

    </div>

  </div>

</div>
