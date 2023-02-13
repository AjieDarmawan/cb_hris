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

                    <th>Bank</th>

                    <th>Limit</th>

                    <th>Jatuh Tempo</th>

                    <th>Aksi</th>

                  </tr>

                </thead>

                <tbody>

                <?php

				$kkr_tampil_id=$bio->kkr_tampil_id($kar_id);

				while($data=mysql_fetch_array($kkr_tampil_id)){

                                    

				?>

                  <tr>

                    <td><?php echo $data['kkr_bank']; ?></td>

                    <td><?php echo $rph->format_rupiah($data['kkr_limit']); ?></td>

                    <td><?php echo $tgl->tgl_indo($data['kkr_tempo']); ?></td>

                    <td>

                    <a href="javascript:;"
                       data-kkrid="<?php echo $data['kkr_id']; ?>"
                       data-kkrbank="<?php echo $data['kkr_bank']; ?>"
                       data-kkrlimit="<?php echo $data['kkr_limit']; ?>"
                       data-kkrtempo="<?php echo $data['kkr_tempo']; ?>" data-toggle="modal" data-target="#kkr_edt" title="Edit Kartu Kredit"><span style="cursor:pointer" class="label label-primary"><i class="fa fa-ellipsis-h"></i></span></a>

                    <a href="#delete-confirm" data-toggle="modal" data-data="<?php echo $data['kkr_bank'];?>" data-url="?p=kartu_kredit&act=hapus&id=<?php echo $data['kkr_id'];?>"><span style="cursor:pointer" class="label label-danger"><i class="fa fa-trash"></i></span></a>

                    </td>

                  </tr>

                <?php }?>  

                </tbody>      

                <tfoot>

                  <tr>

                    <th>Bank</th>

                    <th>Limit</th>

                    <th>Jatuh Tempo</th>

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

        <h4 class="modal-title" id="myModalLabel"><i class="fa fa-cc"></i> Tambah Kartu Kredit</h4>

      </div>

      <form class="form-horizontal" action="" method="post">

      <div class="modal-body">

          <div class="form-group">

            <label for="kkr_bank" class="col-sm-2 control-label">Bank</label>

            <div class="col-sm-10">

              <input type="text" name="kkr_bank" class="form-control" id="kkr_bank" placeholder="Bank" required>

            </div>

          </div>

          <div class="form-group">

            <label for="kkr_limit" class="col-sm-2 control-label">Limit</label>

            <div class="col-sm-10">

              <input type="text" name="kkr_limit" class="form-control" id="kkr_limit" placeholder="Limit" required>

            </div>

          </div>

          <div class="form-group">

            <label for="kkr_tempo" class="col-sm-2 control-label">Tempo</label>

            <div class="col-sm-10">

              <input type="text" name="kkr_tempo" class="form-control" id="kkr_tempo" placeholder="Jatuh tempo" required>

            </div>

          </div>

      </div>

      <div class="modal-footer">

        <button type="submit" name="bsave_kartu_kredit" class="btn btn-primary"><i class="fa fa-save"></i></button>

      </div>

      </form>

    </div>

  </div>

</div>


<!-- Modal Edit -->

<div class="modal fade" id="kkr_edt" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">

  <div class="modal-dialog">

    <div class="modal-content">

      <div class="modal-header bg-primary">

        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>

        <h4 class="modal-title" id="myModalLabel"><i class="fa fa-cc"></i> Edit Kartu Kredit</h4>

      </div>

      <form class="form-horizontal" action="" method="post">

      <input type="hidden" name="kkr_id" id="kkr_id">

      <div class="modal-body">

          <div class="form-group">

            <label for="kkr_bank" class="col-sm-2 control-label">Bank</label>

            <div class="col-sm-10">

              <input type="text" name="kkr_bank" class="form-control" id="kkr_bank" placeholder="Bank" required>

            </div>

          </div>

          <div class="form-group">

            <label for="kkr_limit" class="col-sm-2 control-label">Limit</label>

            <div class="col-sm-10">

              <input type="text" name="kkr_limit" class="form-control" id="kkr_limit" placeholder="Limit" required>

            </div>

          </div>

          <div class="form-group">

            <label for="kkr_tempo" class="col-sm-2 control-label">Tempo</label>

            <div class="col-sm-10">

              <input type="text" name="kkr_tempo" class="form-control" id="kkr_tempo" placeholder="Jatuh tempo" required>

            </div>

          </div>

      </div>

      <div class="modal-footer">

        <button type="submit" name="bupdate_kartu_kredit" class="btn btn-primary"><i class="fa fa-save"></i></button>

      </div>

      </form>

    </div>

  </div>

</div>