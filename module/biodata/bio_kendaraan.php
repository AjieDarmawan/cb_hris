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

        <div class="col-xs-12">

          <div class="box">

            <div class="box-header">

              <h3 class="box-title"><span style="cursor:pointer" class="label label-primary" data-toggle="modal" data-target="#myModal"><i class="fa fa-plus"></i></span></h3>

            </div>

            <!-- /.box-header -->

            <div class="box-body">

              <table id="tb_karyawan" class="table table-bordered table-striped table-hover">

                <thead>

                  <tr>

                    <th>Jenis</th>

                    <th>No. Polisi</th>

                    <th>Merk</th>

                    <th>Type</th>

                    <th>Tahun</th>

                    <th>Aksi</th>

                  </tr>

                </thead>

                <tbody>

                <?php

				$kdr_tampil_id=$bio->kdr_tampil_id($kar_id);

				while($data=mysql_fetch_array($kdr_tampil_id)){

                                    

				?>

                  <tr>

                    <td><?php echo $data['kdr_jns']; ?></td>

                    <td><?php echo $data['kdr_no']; ?></td>

                    <td><?php echo $data['kdr_mrk']; ?></td>

                    <td><?php echo $data['kdr_typ']; ?></td>

                    <td><?php echo $data['kdr_thn']; ?></td>

                    <td>
		    
		                    <a href="javascript:;"
                        data-kdrid="<?php echo $data['kdr_id']; ?>"
                        data-kdrjns="<?php echo $data['kdr_jns'] ?>"
                        data-kdrno="<?php echo $data['kdr_no'] ?>"
                        data-kdrmrk='<?php echo $data['kdr_mrk']; ?>'
                        data-kdrtyp="<?php echo $data['kdr_typ'] ?>"
                        data-kdrthn="<?php echo $data['kdr_thn'] ?>" data-toggle="modal" data-target="#kdr_edt" title="Edit Kendaraan"><span style="cursor:pointer" class="label label-primary"><i class="fa fa-pencil"></i></span></a>
			
                    <a href="#delete-confirm" data-toggle="modal" data-data="<?php echo $data['kdr_no'];?>" data-url="?p=kendaraan&act=hapus&id=<?php echo $data['kdr_id'];?>"><span style="cursor:pointer" class="label label-danger"><i class="fa fa-trash"></i></span></a>
                    
                    </td>

                  </tr>

                <?php }?>  

                </tbody>      

                <tfoot>

                  <tr>

                    <th>Jenis</th>

                    <th>No. Polisi</th>

                    <th>Merk</th>

                    <th>Type</th>

                    <th>Tahun</th>

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

    

<!-- POPUP -->

<!-- Button trigger modal -->





<!-- Modal -->

<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">

  <div class="modal-dialog">

    <div class="modal-content">

      <div class="modal-header bg-primary">

        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>

        <h4 class="modal-title" id="myModalLabel"><i class="fa fa-motorcycle"></i> Tambah Kendaraan</h4>

      </div>

      <form class="form-horizontal" action="" method="post">

      <div class="modal-body">

          <div class="form-group">

            <label for="kdr_jns" class="col-sm-2 control-label">Jenis</label>

            <div class="col-sm-10">

              <select class="form-control" name="kdr_jns" id="kdr_jns" required>

              	<option value="" selected></option>

                <option value="MOTOR (Pribadi)">MOTOR (Pribadi)</option>
		<option value="MOTOR (Orang Tua)">MOTOR (Orang Tua)</option>
		<option value="MOBIL (Pribadi)">MOBIL (Pribadi)</option>
                <option value="MOBIL (Orang Tua)">MOBIL (Orang Tua)</option>
		

              </select>

            </div>

          </div>

          <div class="form-group">

            <label for="kdr_no" class="col-sm-2 control-label">No. Polisi</label>

            <div class="col-sm-10">

              <input type="text" name="kdr_no" class="form-control" id="kdr_no" placeholder="No. Polisi" required>

            </div>

          </div>

	  <div class="form-group">

            <label for="kdr_mrk" class="col-sm-2 control-label">Merk</label>

            <div class="col-sm-10">

              <select class="form-control" name="kdr_mrk" id="kdr_mrk" required>

              	<option value="" selected></option>

                <option value="Honda">Honda</option>

                <option value="Yamaha">Yamaha</option>

                <option value="Suzuki">Suzuki</option>

                <option value="Toyota">Toyota</option>

                <option value="Nissan">Nissan</option>

                <option value="Kawasaki">Kawasaki</option>

              </select>

            </div>

          </div>

	  <div class="form-group">

            <label for="kdr_typ" class="col-sm-2 control-label">Type</label>

            <div class="col-sm-10">

              <input type="text" name="kdr_typ" class="form-control" id="kdr_typ" placeholder="Type" required>

            </div>

          </div>

          <div class="form-group">

            <label for="kdr_thn" class="col-sm-2 control-label">Tahun</label>

            <div class="col-sm-10">

              <input type="text" name="kdr_thn" class="form-control" id="kdr_thn" placeholder="Tahun" required>

            </div>

          </div>

      </div>

      <div class="modal-footer">

        <button type="submit" name="bsave_kendaraan" class="btn btn-primary"><i class="fa fa-save"></i></button>

      </div>

      </form>

    </div>

  </div>

</div>




<!-- Modal Edit -->

<div class="modal fade" id="kdr_edt" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">

  <div class="modal-dialog">

    <div class="modal-content">

      <div class="modal-header bg-primary">

        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>

        <h4 class="modal-title" id="myModalLabel"><i class="fa fa-motorcycle"></i> Edit Kendaraan</h4>

      </div>

      <form class="form-horizontal" action="" method="post">
	
	<input type="hidden" name="kdr_id" id="kdr_id">

      <div class="modal-body">

          <div class="form-group">

            <label for="kdr_jns" class="col-sm-2 control-label">Jenis</label>

            <div class="col-sm-10">

              <select class="form-control" name="kdr_jns" id="kdr_jns" required>

              	<option value="" selected></option>

                <option value="MOTOR (Pribadi)">MOTOR (Pribadi)</option>
		<option value="MOTOR (Orang Tua)">MOTOR (Orang Tua)</option>
		<option value="MOBIL (Pribadi)">MOBIL (Pribadi)</option>
                <option value="MOBIL (Orang Tua)">MOBIL (Orang Tua)</option>
		

              </select>

            </div>

          </div>

          <div class="form-group">

            <label for="kdr_no" class="col-sm-2 control-label">No. Polisi</label>

            <div class="col-sm-10">

              <input type="text" name="kdr_no" class="form-control" id="kdr_no" placeholder="No. Polisi" required>

            </div>

          </div>

	  <div class="form-group">

            <label for="kdr_mrk" class="col-sm-2 control-label">Merk</label>

            <div class="col-sm-10">

              <select class="form-control" name="kdr_mrk" id="kdr_mrk" required>

              	<option value="" selected></option>

                <option value="Honda">Honda</option>

                <option value="Yamaha">Yamaha</option>

                <option value="Suzuki">Suzuki</option>

                <option value="Toyota">Toyota</option>

                <option value="Nissan">Nissan</option>

                <option value="Kawasaki">Kawasaki</option>

              </select>

            </div>

          </div>

	  <div class="form-group">

            <label for="kdr_typ" class="col-sm-2 control-label">Type</label>

            <div class="col-sm-10">

              <input type="text" name="kdr_typ" class="form-control" id="kdr_typ" placeholder="Type" required>

            </div>

          </div>

          <div class="form-group">

            <label for="kdr_thn" class="col-sm-2 control-label">Tahun</label>

            <div class="col-sm-10">

              <input type="text" name="kdr_thn" class="form-control" id="kdr_thn" placeholder="Tahun" required>

            </div>

          </div>

      </div>

      <div class="modal-footer">

        <button type="submit" name="bupdate_kendaraan" class="btn btn-primary"><i class="fa fa-save"></i></button>

      </div>

      </form>

    </div>

  </div>

</div>