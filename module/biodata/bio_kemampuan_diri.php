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

                    <th>Kemampuan / Keterampilan</th>

                    <th>Performa (<small>%</small>)</th>

                    <th>Aksi</th>

                  </tr>

                </thead>

                <tbody>

                <?php

        				$kpd_tampil_id=$bio->kpd_tampil_id($kar_id);

        				while($data=mysql_fetch_array($kpd_tampil_id)){

                                          
        				?>

                  <tr>

                    <td><?php echo $data['kpd_nm']; ?></td>

                    <td><?php echo $data['kpd_lvl']." %"; ?></td>

                    <td>

                    <a href="javascript:;"
                    data-kpdid="<?php echo $data['kpd_id']; ?>"
                    data-kpdnm="<?php echo $data['kpd_nm']; ?>"
                    data-kpdlvl="<?php echo $data['kpd_lvl']; ?>" data-toggle="modal" data-target="#kpd_edt" title="Edit Kemampuan diri"><span style="cursor:pointer" class="label label-primary"><i class="fa fa-ellipsis-h"></i></span></a>

                    <a href="#delete-confirm" data-toggle="modal" data-data="<?php echo $data['kpd_nm'];?>" data-url="?p=kemampuan_diri&act=hapus&id=<?php echo $data['kpd_id'];?>"><span style="cursor:pointer" class="label label-danger"><i class="fa fa-trash"></i></span></a>                

                    </td>

                  </tr>

                <?php }?>  

                </tbody>      

                <tfoot>

                  <tr>

                    <th>Kemampuan / Keterampilan</th>

                    <th>Performa (<small>%</small>)</th>

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

        <h4 class="modal-title" id="myModalLabel"><i class="fa fa-lightbulb-o"></i> Tambah Kemampuan Diri</h4>

      </div>

      <form class="form-horizontal" action="" method="post">

      <div class="modal-body">

          <div class="form-group">

            <label for="kpd_nm" class="col-sm-2 control-label">Kemampuan</label>

            <div class="col-sm-10">

              <input type="text" name="kpd_nm" class="form-control" id="kpd_nm" placeholder="Nama Kemampuan / Keterampilan" required>

            </div>

          </div>

          <div class="form-group">

            <label for="kpd_lvl" class="col-sm-2 control-label">Performa (<small>%</small>)</label>

            <div class="col-sm-10">

              <input type="number" name="kpd_lvl" class="form-control" id="kpd_lvl" placeholder="Performa" step="1" min="1" max="10" required>

            </div>

          </div>

      </div>

      <div class="modal-footer">

        <button type="submit" name="bsave_kemampuan_diri" class="btn btn-primary"><i class="fa fa-save"></i></button>

      </div>

      </form>

    </div>

  </div>

</div>

<!-- Modal Edit -->

<div class="modal fade" id="kpd_edt" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">

  <div class="modal-dialog">

    <div class="modal-content">

      <div class="modal-header bg-primary">

        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>

        <h4 class="modal-title" id="myModalLabel"><i class="fa fa-lightbulb-o"></i> Edit Kemampuan Diri</h4>

      </div>

      <form class="form-horizontal" action="" method="post">

      <div class="modal-body">

          <div class="form-group">

            <label for="kpd_nm" class="col-sm-2 control-label">Kemampuan</label>

            <div class="col-sm-10">

              <input type="text" name="kpd_nm" class="form-control" id="kpd_nm" placeholder="Nama Kemampuan / Keterampilan" required>

            </div>

          </div>

          <div class="form-group">

            <label for="kpd_lvl" class="col-sm-2 control-label">Performa (<small>%</small>)</label>

            <div class="col-sm-10">

              <input type="number" name="kpd_lvl" class="form-control" id="kpd_lvl" placeholder="Performa" step="1" min="1" max="10" required>

            </div>

          </div>

      </div>

      <div class="modal-footer">

        <button type="submit" name="bupdate_kemampuan_diri" class="btn btn-primary"><i class="fa fa-save"></i></button>

      </div>

      </form>

    </div>

  </div>

</div>