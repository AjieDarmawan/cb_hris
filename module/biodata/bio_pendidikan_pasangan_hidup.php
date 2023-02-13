<?php require('module/biodata/bio_act.php'); ?>



<!-- Content Header (Page header) -->



    <section class="content-header">



      <h1> <?php echo $title;?> <small></small> </h1>



      <ol class="breadcrumb">



        <li><a href="media.php"><i class="fa fa-dashboard"></i> Dashboard</a></li>



        <li><a href="?p=biodata"> Biodata</a></li>



        <li><a href="?p=pasangan_hidup"> Pasangan hidup</a></li>

        

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



                    <th>Pendidikan</th>



                    <th>Sekolah / Perguruan Tinggi</th>



                    <th>Jurusan</th>



                    <th>Tahun Mulai</th>



                    <th>Tahun Akhir</th>



                    <th>Nilai / IPK</th>



                    <th>Lokasi</th>



                    <th>Aksi</th>



                  </tr>



                </thead>



                <tbody>



                <?php



				$pdd_tampil_id=$bio->pdd_tampil_id($kar_id);



				while($data=mysql_fetch_array($pdd_tampil_id)){



                                    



				?>



                  <tr>



                    <td><?php echo $data['pdd_lvl']; ?></td>



                    <td><?php echo $data['pdd_nm']; ?></td>



                    <td><?php echo $data['pdd_jurusan']; ?></td>



                    <td><?php echo $data['pdd_start']; ?></td>



                    <td><?php echo $data['pdd_end']; ?></td>



                    <td><?php echo $data['pdd_nilai']; ?></td>



                    <td><?php echo $data['pdd_lokasi']; ?></td>



                    <td>



                    <a href="javascript:;"
                    data-pddid="<?php echo $data['pdd_id']; ?>"
                    data-pddlvl="<?php echo $data['pdd_lvl']; ?>"
                    data-pddnm="<?php echo $data['pdd_nm']; ?>"
                    data-pddjurusan="<?php echo $data['pdd_jurusan']; ?>"
                    data-pddstart="<?php echo $data['pdd_start']; ?>"
                    data-pddend="<?php echo $data['pdd_end']; ?>"
                    data-pddnilai="<?php echo $data['pdd_nilai']; ?>"
                    data-pddlokasi="<?php echo $data['pdd_lokasi']; ?>" data-toggle="modal" data-target="#pdd_edt" title="Edit Pendidikan Formal"><span style="cursor:pointer" class="label label-primary"><i class="fa fa-ellipsis-h"></i></span></a>



                    <a href="#delete-confirm" data-toggle="modal" data-data="<?php echo $data['pdd_tempat'];?>" data-url="?p=pendidikan_formal&act=hapus&id=<?php echo $data['pdd_id'];?>"><span style="cursor:pointer" class="label label-danger"><i class="fa fa-trash"></i></span></a>



                    <?php



                    if(!empty($data['pdd_sts'])){



                      if($data['pdd_sts']=="A"){



                    ?>



                    <a href="#block-confirm" data-toggle="modal" data-data="<h4>Yakin Headline <strong><?php echo $data['pdd_tempat'];?></strong> akan di HIDDEN?</h4>" data-url="?p=pendidikan_formal&act=block&id=<?php echo $data['pdd_id'];?>"><span style="cursor:pointer" class="label label-success"><i class="fa fa-check"></i></span></a>



                    <?php 



                    }elseif($data['pdd_sts']=="N"){



                    ?>



                    <a href="#block-confirm" data-toggle="modal" data-data="<h4>UNHIDE Headline <strong><?php echo $data['pdd_tempat'];?></strong></h4>" data-url="?p=pendidikan_formal&act=unblock&id=<?php echo $data['pdd_id'];?>"><span style="cursor:pointer" class="label label-danger"><i class="fa fa-ban"></i></span></a>



                    <?php }}?>



                    </td>



                  </tr>



                <?php }?>  



                </tbody>      



                <tfoot>



                  <tr>



                    <th>Pendidikan</th>



                    <th>Sekolah / Perguruan Tinggi</th>



                    <th>Jurusan</th>



                    <th>Tahun Mulai</th>



                    <th>Tahun Akhir</th>



                    <th>Nilai / IPK</th>



                    <th>Lokasi</th>



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



        <h4 class="modal-title" id="myModalLabel"><i class="fa fa-graduation-cap"></i> Tambah Pendidikan Formal</h4>



      </div>



      <form class="form-horizontal" action="" method="post">



      <div class="modal-body">



          <div class="form-group">



            <label for="pdd_lvl" class="col-sm-2 control-label">Pendidikan</label>



            <div class="col-sm-10">



              <select class="form-control" name="pdd_lvl" id="pdd_lvl" required>



              	<option value="" selected></option>



                <option value="S1">S1</option>



                <option value="D3">D3</option>



                <option value="SMA">SMA</option>



              </select>



            </div>



          </div>



          <div class="form-group">



            <label for="pdd_tempat" class="col-sm-2 control-label">Sekolah / Perguruan Tinggi</label>



            <div class="col-sm-10">



              <input type="text" name="pdd_nm" class="form-control" id="pdd_tempat" placeholder="Nama Sekolah / Perguruan Tinggi" step="1" min="1" max="10" required>



            </div>



          </div>



          <div class="form-group">



            <label for="pdd_jurusan" class="col-sm-2 control-label">Jurusan</label>



            <div class="col-sm-10">



              <input type="text" name="pdd_jurusan" class="form-control" id="pdd_jurusan" placeholder="Jurusan" required>



            </div>



          </div>



          <div class="form-group">



            <label for="pdd_start" class="col-sm-2 control-label">Tahun Mulai</label>



            <div class="col-sm-10">



              <input type="text" name="pdd_start" class="form-control" id="pdd_start" placeholder="Tahun Mulai" required>



            </div>



          </div>



	  <div class="form-group">



            <label for="pdd_end" class="col-sm-2 control-label">Tahun Akhir</label>



            <div class="col-sm-10">



              <input type="text" name="pdd_end" class="form-control" id="pdd_end" placeholder="Tahun Akhir" required>



            </div>



          </div>



          <div class="form-group">



            <label for="pdd_nilai" class="col-sm-2 control-label">Nilai / IPK</label>



            <div class="col-sm-10">



              <input type="text" name="pdd_nilai" class="form-control" id="pdd_nilai" placeholder="Nilai / IPK" required>



            </div>



          </div>



          <div class="form-group">



            <label for="pdd_lokasi" class="col-sm-2 control-label">Lokasi</label>



            <div class="col-sm-10">



              <input type="text" name="pdd_lokasi" class="form-control" id="pdd_lokasi" placeholder="Lokasi" required>



            </div>



          </div>



      </div>



      <div class="modal-footer">



        <button type="submit" name="bsave_pendidikan" class="btn btn-primary"><i class="fa fa-save"></i></button>



      </div>



      </form>



    </div>



  </div>



</div>


<!-- Modal Edit -->



<div class="modal fade" id="pdd_edt" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">



  <div class="modal-dialog">



    <div class="modal-content">



      <div class="modal-header bg-primary">



        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>



        <h4 class="modal-title" id="myModalLabel"><i class="fa fa-graduation-cap"></i> Edit Pendidikan Formal</h4>



      </div>



      <form class="form-horizontal" action="" method="post">


      <input type="hidden" name="pdd_id" id="pdd_id">


      <div class="modal-body">



          <div class="form-group">



            <label for="pdd_lvl" class="col-sm-2 control-label">Pendidikan</label>



            <div class="col-sm-10">



              <select class="form-control" name="pdd_lvl" id="pdd_lvl" required>



                <option value="" selected></option>



                <option value="S1">S1</option>



                <option value="D3">D3</option>



                <option value="SMA">SMA</option>



              </select>



            </div>



          </div>



          <div class="form-group">



            <label for="pdd_nm" class="col-sm-2 control-label">Sekolah / Perguruan Tinggi</label>



            <div class="col-sm-10">



              <input type="text" name="pdd_nm" class="form-control" id="pdd_nm" placeholder="Nama Sekolah / Perguruan Tinggi" step="1" min="1" max="10" required>



            </div>



          </div>



          <div class="form-group">



            <label for="pdd_jurusan" class="col-sm-2 control-label">Jurusan</label>



            <div class="col-sm-10">



              <input type="text" name="pdd_jurusan" class="form-control" id="pdd_jurusan" placeholder="Jurusan" required>



            </div>



          </div>



          <div class="form-group">



            <label for="pdd_start" class="col-sm-2 control-label">Tahun Mulai</label>



            <div class="col-sm-10">



              <input type="text" name="pdd_start" class="form-control" id="pdd_start" placeholder="Tahun Mulai" required>



            </div>



          </div>



    <div class="form-group">



            <label for="pdd_end" class="col-sm-2 control-label">Tahun Akhir</label>



            <div class="col-sm-10">



              <input type="text" name="pdd_end" class="form-control" id="pdd_end" placeholder="Tahun Akhir" required>



            </div>



          </div>



          <div class="form-group">



            <label for="pdd_nilai" class="col-sm-2 control-label">Nilai / IPK</label>



            <div class="col-sm-10">



              <input type="text" name="pdd_nilai" class="form-control" id="pdd_nilai" placeholder="Nilai / IPK" required>



            </div>



          </div>



          <div class="form-group">



            <label for="pdd_lokasi" class="col-sm-2 control-label">Lokasi</label>



            <div class="col-sm-10">



              <input type="text" name="pdd_lokasi" class="form-control" id="pdd_lokasi" placeholder="Lokasi" required>



            </div>



          </div>



      </div>



      <div class="modal-footer">



        <button type="submit" name="bupdate_pendidikan" class="btn btn-primary"><i class="fa fa-save"></i></button>



      </div>



      </form>



    </div>



  </div>



</div>