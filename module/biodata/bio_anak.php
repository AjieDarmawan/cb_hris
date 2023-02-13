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

                    <th>Nama</th>

                    <th>Gender</th>

                    <th>Tempat Lahir</th>

                    <th>Tanggal Lahir</th>

                    <th>Golongan Darah</th>

                    <th>Status</th>

                    <th>Aksi</th>

                  </tr>

                </thead>

                <tbody>

                <?php

				$ank_tampil_id=$bio->ank_tampil_id($kar_id);

				while($data=mysql_fetch_array($ank_tampil_id)){

                                    

				?>

                  <tr>

                    <td><?php echo $data['ank_nm']; ?></td>

                    <td><?php echo $data['ank_gender']; ?></td>

                    <td><?php echo $data['ank_tml']; ?></td>

                    <td><?php echo $tgl->tgl_indo($data['ank_tll']); ?></td>

                    <td><?php echo $data['ank_goldarah']; ?></td>

                    <td><?php echo $data['ank_kondisi']; ?></td>

                    <td>

                    <a href="javascript:;"
                      data-ankid="<?php echo $data['ank_id']; ?>"
                      data-anknm="<?php echo $data['ank_nm']; ?>"
                      data-ankgender="<?php echo $data['ank_gender']; ?>"
                      data-anktml="<?php echo $data['ank_tml']; ?>"
                      data-anktll="<?php echo $data['ank_tll']; ?>"
                      data-ankgoldarah="<?php echo $data['ank_goldarah']; ?>"
                      data-ankkondisi="<?php echo $data['ank_kondisi']; ?>" data-toggle="modal" data-target="#ank_edt" title="Edit Anak"><span style="cursor:pointer" class="label label-primary"><i class="fa fa-ellipsis-h"></i></span></a>

                    <a href="#delete-confirm" data-toggle="modal" data-data="<?php echo $data['ank_nm'];?>" data-url="?p=anak&act=hapus&id=<?php echo $data['ank_id'];?>"><span style="cursor:pointer" class="label label-danger"><i class="fa fa-trash"></i></span></a>
 
                    </td>

                  </tr>

                <?php }?>  

                </tbody>      

                <tfoot>

                  <tr>

                    <th>Nama</th>

                    <th>Gender</th>

                    <th>Tempat Lahir</th>

                    <th>Tanggal Lahir</th>

                    <th>Golongan Darah</th>

                    <th>Status</th>

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

        <h4 class="modal-title" id="myModalLabel"><i class="fa fa-child"></i> Update Anak</h4>

      </div>

      <form class="form-horizontal" action="" method="post">

      <div class="modal-body">

    <div class="form-group">

	    <label for="ank_nm" class="col-sm-2 control-label">Nama</label>

	    <div class="col-sm-10">

	      <input type="text" name="ank_nm" value="" class="form-control" id="ank_nm" placeholder="Nama" required>

	    </div>

	  </div>

	  <div class="form-group">

	    <label for="ank_gender" class="col-sm-2 control-label">Gender</label>

	    <div class="col-sm-10">

	      <?php

	      $gender=array(

			  "Pria" => 'Pria',

			  "Wanita" => 'Wanita'

			);

	      

	      foreach($gender as $value => $caption) {

	      ?>

	      <input type="radio" name="ank_gender" value="<?php echo $value;?>" class="flat-red" id="ank_gender" /> <?php echo $caption;?> &nbsp;

	      <?php }?>

	    </div>

	  </div>

    <div class="form-group">

      <label for="ank_tml" class="col-sm-2 control-label">Kota Lahir</label>

      <div class="col-sm-10">

        <input type="text" name="ank_tml" value="" class="form-control" id="ank_tml" placeholder="Kota Lahir" required>

      </div>

    </div>

    <div class="form-group">

      <label for="ank_tll" class="col-sm-2 control-label">Tanggal Lahir</label>

      <div class="col-sm-10">

        <input type="text" name="ank_tll" value="" class="form-control" id="ank_tll" placeholder="Tanggal Lahir" data-inputmask="'alias': 'yyyy-mm-dd'" data-mask required>

      </div>

    </div>

    <div class="form-group">

      <label for="ank_goldarah" class="col-sm-2 control-label">Golongan Darah</label>

      <div class="col-sm-10">

        <input type="text" name="ank_goldarah" value="" class="form-control" id="ank_goldarah" placeholder="Golongan Darah" required>

      </div>

    </div>

    <div class="form-group">

      <label for="ank_kondisi" class="col-sm-2 control-label">Kondisi Anak</label>

        <div class="col-sm-10">

          <select type="text" name="ank_kondisi" value="" class="form-control" id="ank_kondisi" placeholder="Kondisi" required>

             <option value="" selected></option>

             <option value="Masih Hidup">Masih Hidup</option>

             <option value="Almarhum">Almarhum</option>

          </select>

       </div>

    </div>

      </div>

      <div class="modal-footer">

        <button type="submit" name="bsave_anak" class="btn btn-primary"><i class="fa fa-save"></i></button>

      </div>

      </form>

    </div>

  </div>

</div>

<!-- Modal Edit -->

<div class="modal fade" id="ank_edt" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">

  <div class="modal-dialog">

    <div class="modal-content">

      <div class="modal-header bg-primary">

        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>

        <h4 class="modal-title" id="myModalLabel"><i class="fa fa-child"></i> Edit Anak</h4>

      </div>

      <form class="form-horizontal" action="" method="post">

      <input type="hidden" name="ank_id" id="ank_id">

      <div class="modal-body">

    <div class="form-group">

      <label for="ank_nm" class="col-sm-2 control-label">Nama</label>

      <div class="col-sm-10">

        <input type="text" name="ank_nm" value="" class="form-control" id="ank_nm" placeholder="Nama" required>

      </div>

    </div>

    <div class="form-group">

      <label for="ank_gender" class="col-sm-2 control-label">Gender</label>

      <div class="col-sm-10">

        <?php

        $gender=array(

        "Pria" => 'Pria',

        "Wanita" => 'Wanita'

      );

        

        foreach($gender as $value => $caption) {

        ?>

        <input type="radio" name="ank_gender" value="<?php echo $value;?>"  id="ank_gender<?php echo $value;?>" class="flat-red" /> <?php echo $caption;?> &nbsp;

        <?php }?>

      </div>

    </div>

    <div class="form-group">

      <label for="ank_tml" class="col-sm-2 control-label">Kota Lahir</label>

      <div class="col-sm-10">

        <input type="text" name="ank_tml" value="" class="form-control" id="ank_tml" placeholder="Kota Lahir" required>

      </div>

    </div>

    <div class="form-group">

      <label for="ank_tll" class="col-sm-2 control-label">Tanggal Lahir</label>

      <div class="col-sm-10">

        <input type="text" name="ank_tll" value="" class="form-control" id="ank_tll" placeholder="Tanggal Lahir" required>

      </div>

    </div>

    <div class="form-group">

      <label for="ank_goldarah" class="col-sm-2 control-label">Golongan Darah</label>

      <div class="col-sm-10">

        <input type="text" name="ank_goldarah" value="" class="form-control" id="ank_goldarah" placeholder="Golongan Darah" required>

      </div>

    </div>

    <div class="form-group">

      <label for="ank_kondisi" class="col-sm-2 control-label">Kondisi Anak</label>

        <div class="col-sm-10">

          <select type="text" name="ank_kondisi" value="" class="form-control" id="ank_kondisi" placeholder="Kondisi" required>

             <option value="" selected></option>

             <option value="Masih Hidup">Masih Hidup</option>

             <option value="Almarhum">Almarhum</option>

          </select>

       </div>

    </div>

      </div>

      <div class="modal-footer">

        <button type="submit" name="bupdate_anak" class="btn btn-primary"><i class="fa fa-save"></i></button>

      </div>

      </form>

    </div>

  </div>

</div>