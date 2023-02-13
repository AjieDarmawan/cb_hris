<?php require('module/absen_menanam/abm_act.php'); ?>
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
                <form class="form-inline" method="post" action="">
                        
                    <div class="input-group">
                        <span class="input-group-btn">
                          <button class="btn btn-default btn-flat" type="submit" name="bclearday" title="Clear Filter"><i class="fa fa-close"></i></button>
                        </span>
                        <input type="text" value="<?php echo $wfd_date_ori;?>" name="filter_day" class="form-control" placeholder="Filter Tanggal" id="dpdays" readonly />
                        <span class="input-group-btn">
                          <button class="btn btn-default btn-flat" type="submit" name="bday"><i class="fa fa-search"></i></button>
                        </span>
                    </div>  
                            
                </form>
              </div>
              <!-- /.box-header -->
              <div class="box-body">
                <table id="tb_abs_menanam" class="table table-hover table-striped table-bordered nowrap" style="width:100%">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th>NIK</th>
                      <th>Nama</th>
                      <th>Divisi</th>
                      <th>Absen</th>
                      <th>Foto</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    $no=1;
                    $abm_menaman_karyawan=$abm->abm_menaman_karyawan($wfd_date_ori);
                    while($data=mysql_fetch_array($abm_menaman_karyawan)){
                    ?>
                    <tr>
                      <td><?php echo $no;?></td>
                      <td><?php echo $data['abm_nik'];?></td>
                      <td><?php echo $data['abm_nm'];?></td>
                      <td><?php echo $data['div_nm'];?></td>
                      <td><?php echo $data['abm_datetime'];?></td>
                      <td>
                        <a href="javascript:void(0)" onclick="popupCenter({url: 'https://cb.web.id/foto_menanam/<?php echo $data['abm_foto'];?>', title: '<?php echo $data['abm_foto'];?>', w: 500, h: 300});"><?php echo $data['abm_foto'];?></a>
                    </tr>
                    <?php $no++;}?>
                  </tbody>      
                </table>
  
              </div>
              
            </div>
            <!-- /.box --> 
          </div>
          <!-- /.col --> 
        </div>
        <!-- /.row --> 
        
    </section>
    <!-- /.content --> 