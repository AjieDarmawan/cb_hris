<?php require('module/coaching/coa_act.php'); ?>
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
    <div class="col-md-6">
      <div class="box box-info">
        <div class="box-header">
            <h3 class="box-title">Data Karyawan</h3>
            <!-- tools box -->
            <div class="pull-right box-tools">
              <a href="?p=data_coaching"  class="btn btn-sm btn-default"><i class="fa fa-refresh"></i></a>
              <button class="btn btn-info btn-sm" data-widget='collapse' data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
              <button class="btn btn-info btn-sm" data-widget='remove' data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
            </div><!-- /. tools -->
        </div>

        <!-- /.box-header -->

        <div class="box-body">
          <table id="tb_karyawan" class="table table-bordered table-striped table-hover">
            <thead>
                <tr>
                  <th>NIK</th>
                  <th>Nama</th>
                  <th>Divisi</th>
                  <th>Kantor</th>
                </tr>
            </thead>
            <tbody>
            <?php
            //$kar_tampil=$kar->kar_tampil();
            if($kar_tampil){
                foreach($kar_tampil as $data){ 
                    if($data['kar_id']==$_GET['id']){
                        $block="danger";
                        $check="<i class='fa fa-check text-green'></i>";
                    }else{
                        $block="";
                        $check="";
                    } 
            ?>        
                <tr class="<?php echo $block;?>">
                  <td><?php echo $check;?> <a href="?p=data_coaching&id=<?php echo $data['kar_id']; ?>"><?php echo $data['kar_nik']; ?></a></td>
                  <td><a href="?p=data_coaching&id=<?php echo $data['kar_id']; ?>"><?php echo $data['kar_nm']; ?></a></td>
                  <td><?php echo $data['div_nm']; ?></td>
                  <td><a data-toggle="tooltip" title="<?php echo $data['ktr_nm']; ?>" style="cursor:pointer"><?php echo $data['ktr_kd']; ?></a></td>
                </tr>
            <?php }}?>  
            </tbody>      
            <tfoot>
                <tr>
                  <th>NIK</th>
                  <th>Nama</th>
                  <th>Divisi</th>
                  <th>Kantor</th>
                </tr>
            </tfoot>
          </table>

        </div>
        <!-- /.box-body -->
      </div>
      <!-- /.box -->

    </div>
    <!-- /.col -->


    <div class="col-md-6">
      <div class="box box-danger">
        <div class="box-header">
            <h3 class="box-title">History Data Coaching</h3>
            <!-- tools box -->
            <div class="pull-right box-tools">
              <?php if(!empty($_GET['id'])){ ?>
              <button style="cursor:pointer" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#md_fpk"><i class="fa fa-plus"></i></button>
              <?php }?>
              <button class="btn btn-info btn-sm" data-widget='collapse' data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
              <button class="btn btn-info btn-sm" data-widget='remove' data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
            </div><!-- /. tools -->
        </div>

        <!-- /.box-header -->
        <div class="box-body">
          <table id="tb_absen" class="table table-bordered table-striped table-hover">
            <thead>
              <tr>
                <th>Nomor</th>
                <th>Keterangan</th>
                <th>Priode</th>
                <th>Tanggal</th>
                <th>Status</th>
                <th>Aksi</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
              </tr>
            </tbody>  
            <tfoot>
              <tr>
                <th>Nomor</th>
                <th>Keterangan</th>
                <th>Priode</th>
                <th>Tanggal</th>
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




<?php
if(!empty($_GET['id'])){
?>

<!-- Modal FPK-->
<div class="modal fade" id="md_fpk" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header bg-primary">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel"><i class="fa fa-bar-chart"></i> Formulir Coaching</h4>
      </div>
      <form class="form-horizontal" action="" method="post">
      <div class="modal-body">
        
	<!-- Main content -->
        <section class="invoice">
          <!-- title row -->
          <div class="row">
            <div class="col-sm-12 col-md-12">
              <h2 class="page-header">
		<div class="row">
		  <div class="col-xs-3 col-md-2">
		    <img src="dist/img/logo_gg_small130.JPG" width="80"> 
		  </div>
		  <div class="col-xs-9 col-md-10">
		    PT. Gilland Ganesha<br>
		    <small>Jl. Raya Bogor Km 47,5 Perum Bumi Sentosa Blok A3 No.3, Nanggewer Cibinong, Jawa Barat 16912.</small>
		  </div>
		</div>
              </h2>
            </div><!-- /.col -->
          </div>
          <!-- info row -->
          <div class="row invoice-info">
          <center><h3 style="margin-bottom: 20px;"><u>FORMULIR COACHING</u></h3></center>
          
            <div class="col-sm-8 invoice-col">
                <address>
		  <strong><?php echo $kar_data_['kar_nm'];?></strong><br>
		  NIK: <?php echo $kar_data_['kar_nik'];?><br>
                  Divisi: <?php echo $kar_data_['div_nm'];?> / <?php echo $kar_data_['jbt_nm'];?><br>
                  Location: <?php echo $kar_data_['unt_nm'];?> / <?php echo $kar_data_['ktr_nm'];?><br>
                </address>
            </div><!-- /.col -->
            
            <div class="col-sm-4 invoice-col">
              <address>
                Nomor &nbsp;&nbsp;<b> <?php echo $new_kd;?></b>
                <br><br>
                <input type="text" name="fpk_tgl" class="form-control" id="fpk_tgl" placeholder="Tanggal Coaching" data-inputmask="'alias': 'yyyy-mm-dd'" data-mask style="width:182;" required>
              </address>
            </div><!-- /.col -->
            
          </div><!-- /.row -->
          <!-- Table row -->
          <div class="row">
            <div class="col-xs-12 table-responsive">
	       <div class="panel-group" id="accordion">
                
		<div class="panel panel-default">
		  <div class="panel-heading">
		    <h4 class="panel-title">
		      <a data-toggle="collapse" data-parent="#accordion" href="#paramkerja">
		      Parameter Kinerja Saya
		      <div class="pull-right"><i class="fa fa-chevron-down"></i></div></a>
		    </h4>
		  </div>
		  <div id="paramkerja" class="panel-collapse collapse in">
		    <div class="panel-body">
		      <table class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th style="width: 20%">Uraian</th>
                                <th class="danger">Goal</th>
                                <th>Sn</th>
                                <th>Sl</th>
                                <th>Rb</th>
                                <th>Km</th>
                                <th>Jm</th>
                                <th>Sb</th>
                                <th>Ahad</th>
                                <th class="info">Total</th>
                            </tr>
                        </thead>
			<tbody>
			  <tr>
			    <td><i class="fa fa-check-square-o"></i> Follow Up</td>
			    <td><input type="text" onblur="calcRasio('closing','rasio', 'ras_1')" name="fu_1" class="form-control rasio" id="fu_1"></td>
                            <td><input type="text" onblur="calcItems('fu', 'fu_9')" name="fu_2" class="form-control fu" id="fu_2"></td>
                            <td><input type="text" onblur="calcItems('fu', 'fu_9')" name="fu_3" class="form-control fu" id="fu_3"></td>
                            <td><input type="text" onblur="calcItems('fu', 'fu_9')" name="fu_4" class="form-control fu" id="fu_4"></td>
                            <td><input type="text" onblur="calcItems('fu', 'fu_9')" name="fu_5" class="form-control fu" id="fu_5"></td>
                            <td><input type="text" onblur="calcItems('fu', 'fu_9')" name="fu_6" class="form-control fu" id="fu_6"></td>
                            <td><input type="text" onblur="calcItems('fu', 'fu_9')" name="fu_7" class="form-control fu" id="fu_7"></td>
                            <td><input type="text" onblur="calcItems('fu', 'fu_9')" name="fu_8" class="form-control fu" id="fu_8"></td>
                            <td><input type="text" name="fu_9" class="form-control" id="fu_9" readonly></td>
			  </tr>
                          <tr>
			    <td><i class="fa fa-check-square-o"></i> Feedback</td>
			    <td><input type="text" onblur="calcRasio('closing','rasio', 'ras_1')" name="fb_1" class="form-control rasio" id="fb_1"></td>
                            <td><input type="text" onblur="calcItems('fb', 'fb_9')" name="fb_2" class="form-control fb" id="fb_2"></td>
                            <td><input type="text" onblur="calcItems('fb', 'fb_9')" name="fb_3" class="form-control fb" id="fb_3"></td>
                            <td><input type="text" onblur="calcItems('fb', 'fb_9')" name="fb_4" class="form-control fb" id="fb_4"></td>
                            <td><input type="text" onblur="calcItems('fb', 'fb_9')" name="fb_5" class="form-control fb" id="fb_5"></td>
                            <td><input type="text" onblur="calcItems('fb', 'fb_9')" name="fb_6" class="form-control fb" id="fb_6"></td>
                            <td><input type="text" onblur="calcItems('fb', 'fb_9')" name="fb_7" class="form-control fb" id="fb_7"></td>
                            <td><input type="text" onblur="calcItems('fb', 'fb_9')" name="fb_8" class="form-control fb" id="fb_8"></td>
                            <td><input type="text" name="fb_9" class="form-control" id="fb_9" readonly></td>
			  </tr>
                          <tr>
			    <td><i class="fa fa-check-square-o"></i> Prospek</td>
			    <td><input type="text" name="pro_1" class="form-control" id="pro_1"></td>
                            <td><input type="text" onblur="calcItems('pro', 'pro_9')" name="pro_2" class="form-control pro" id="pro_2"></td>
                            <td><input type="text" onblur="calcItems('pro', 'pro_9')" name="pro_3" class="form-control pro" id="pro_3"></td>
                            <td><input type="text" onblur="calcItems('pro', 'pro_9')" name="pro_4" class="form-control pro" id="pro_4"></td>
                            <td><input type="text" onblur="calcItems('pro', 'pro_9')" name="pro_5" class="form-control pro" id="pro_5"></td>
                            <td><input type="text" onblur="calcItems('pro', 'pro_9')" name="pro_6" class="form-control pro" id="pro_6"></td>
                            <td><input type="text" onblur="calcItems('pro', 'pro_9')" name="pro_7" class="form-control pro" id="pro_7"></td>
                            <td><input type="text" onblur="calcItems('pro', 'pro_9')" name="pro_8" class="form-control pro" id="pro_8"></td>
                            <td><input type="text" name="pro_9" class="form-control" id="pro_9" readonly></td>
			  </tr>
                          <tr>
			    <td><i class="fa fa-check-square-o"></i> Closing</td>
			    <td><input type="text" onblur="calcRasio('closing','rasio', 'ras_1')" name="cl_1" class="form-control closing" id="cl_1"></td>
                            <td><input type="text" onblur="calcItems('cl', 'cl_9')" name="cl_2" class="form-control cl" id="cl_2"></td>
                            <td><input type="text" onblur="calcItems('cl', 'cl_9')" name="cl_3" class="form-control cl" id="cl_3"></td>
                            <td><input type="text" onblur="calcItems('cl', 'cl_9')" name="cl_4" class="form-control cl" id="cl_4"></td>
                            <td><input type="text" onblur="calcItems('cl', 'cl_9')" name="cl_5" class="form-control cl" id="cl_5"></td>
                            <td><input type="text" onblur="calcItems('cl', 'cl_9')" name="cl_6" class="form-control cl" id="cl_6"></td>
                            <td><input type="text" onblur="calcItems('cl', 'cl_9')" name="cl_7" class="form-control cl" id="cl_7"></td>
                            <td><input type="text" onblur="calcItems('cl', 'cl_9')" name="cl_8" class="form-control cl" id="cl_8"></td>
                            <td><input type="text" name="cl_9" class="form-control" id="cl_9" readonly></td>
			  </tr>
                          <tr>
			    <td><i class="fa fa-check-square-o"></i> %Rasio</td>
			    <td colspan="2"><input type="text" name="ras_1" class="form-control" id="ras_1"></td>
                            <td colspan="7"></td>
			  </tr>
			</tbody>
		      </table>
                      <p class="text-red"><em><small>*) Rasio = closing : ( FU + FB ) x 100%</small></em></p>
                      <table class="table">
                        <tr>
                            <td>Minggu lalu, saya telah menghabiskan</td>
                            <td><input type="text" name="jm_bekerja" class="form-control" id="jm_bekerja"></td>
                            <td>Jam untuk bekerja.</td>
                        </tr>
                        <tr>
                            <td>Level motivasi saya</td>
                            <td><input type="text" name="lvl_motivasi" class="form-control" id="lvl_motivasi"></td>
                            <td>%.</td>
                        </tr>
                      </table>
		    </div>
		  </div>
		</div>
                
                <div class="panel panel-default">
		  <div class="panel-heading">
		    <h4 class="panel-title">
		      <a data-toggle="collapse" data-parent="#accordion" href="#parammelakukan">
		      Saya Juga Telah Melakukan
		      <div class="pull-right"><i class="fa fa-chevron-down"></i></div></a>
		    </h4>
		  </div>
		  <div id="parammelakukan" class="panel-collapse collapse">
		    <div class="panel-body">
                        <table class="table table-striped table-bordered" id="tab_melakukan">
                            <thead>
                                <tr>
                                    <th>Aktifitas</th>
                                    <th>Investasi Waktu</th>
                                    <th>Prospek Baru</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr id="addr0">
                                    <td><input type="text" name="akf_0" class="form-control"/></td>
                                    <td><input type="text" name="inw_0" class="form-control"/></td>
                                    <td><input type="text" name="prb_0" class="form-control"/></td>
                                </tr>
                                <tr id="addr1"></tr>
                            </tbody>
			</table>
                        <div class="row">
                            <div class="col-xs-12">
                                <a id="melakukan_add_row" class="btn btn-default pull-left">Add Row</a><a id="melakukan_delete_row" class="pull-right btn btn-default">Delete Row</a>
                            </div>
                        </div>
                        <hr>
                        <table class="table table-striped table-bordered" id="tab_rasio_closing">
                            <thead>
                                <tr>
                                    <th colspan="2">Aktifitas untuk meningkatkan rasio closing</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr id="addx0">
                                    <td>#</td>
                                    <td><input type="text" name="akf_ras_cl_0" class="form-control"></td>
                                </tr>
                                <tr id="addx1"></tr>
                            </tbody>
                        </table>
                        <div class="row">
                            <div class="col-xs-12">
                                <a id="ras_cl_add_row" class="btn btn-default pull-left">Add Row</a><a id="ras_cl_delete_row" class="pull-right btn btn-default">Delete Row</a>
                            </div>
                        </div>
                    </div>
                  </div>
                </div>
                
                <div class="panel panel-default">
		  <div class="panel-heading">
		    <h4 class="panel-title">
		      <a data-toggle="collapse" data-parent="#accordion" href="#parampenajaman">
		      Penajaman
		      <div class="pull-right"><i class="fa fa-chevron-down"></i></div></a>
		    </h4>
		  </div>
		  <div id="parampenajaman" class="panel-collapse collapse">
		    <div class="panel-body">
                        <textarea name="penajaman" rows="5" class="form-control"></textarea>
                    </div>
                  </div>
                </div>
                
                <div class="panel panel-default">
		  <div class="panel-heading">
		    <h4 class="panel-title">
		      <a data-toggle="collapse" data-parent="#accordion" href="#paramrencanamgdepan">
		      Rencana Minggu Depan
		      <div class="pull-right"><i class="fa fa-chevron-down"></i></div></a>
		    </h4>
		  </div>
		  <div id="paramrencanamgdepan" class="panel-collapse collapse">
		    <div class="panel-body">
                        <textarea name="rencanamgdepan" rows="5" class="form-control"></textarea>
                    </div>
                  </div>
                </div>
                
	      </div> 
            </div><!-- /.col -->
          </div><!-- /.row -->
          <div class="row">
            <div class="col-xs-6">
              <strong>Dibuat oleh:</strong><br>
	      <?php echo $kar_data['kar_nik'];?> - <?php echo $kar_data['kar_nm'];?>
            </div><!-- /.col -->
            <div class="col-xs-6">
            </div><!-- /.col -->
          </div><!-- /.row -->
        </section><!-- /.content -->
      </div>
      <div class="modal-footer">
        <button type="submit" name="bsave" class="btn btn-primary"><i class="fa fa-save"></i> Simpan Hasil</button>
      </div>
      </form>
    </div>
  </div>
</div>

<?php
}
?>
</script>