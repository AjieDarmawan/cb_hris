<?php require('module/penjadwalan/jwd_act.php'); ?>
<!-- Content Header (Page header) -->
<style type='text/css'>
     a span.unclickable  { text-decoration: none; }
     a span.unclickable:hover { cursor: default; }
</style>
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
                    <a href="?p=data_penjadwalan"  class="btn btn-sm btn-default"><i class="fa fa-refresh"></i></a>
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
        $kar_tampil=$kar->kar_tampil_filter_2();
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
                    <td><?php echo $check;?> <a href="?p=data_penjadwalan&id=<?php echo $data['kar_id']; ?>"><?php echo $data['kar_nik']; ?></a></td>
                    <td><a href="?p=data_penjadwalan&id=<?php echo $data['kar_id']; ?>"><?php echo $data['kar_nm']; ?></a></td>
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
          <div class="box box-success">
            <div class="box-header">
              <h3 class="box-title">History Penjadwalan</h3>
	      <!-- tools box -->
                  <div class="pull-right box-tools">
                  <?php
                  if(!empty($_GET['id'])){ 
                  ?>
		    <button style="cursor:pointer" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#myModal"><i class="fa fa-plus"></i></button>
                  <?php }?>
                    <button class="btn btn-info btn-sm" data-widget='collapse' data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
                    <button class="btn btn-info btn-sm" data-widget='remove' data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
                  </div><!-- /. tools -->
	    </div>
            <!-- /.box-header -->
            <div class="box-body">
              
              <table id="tb_user" class="table table-bordered table-striped table-hover">
                <thead>
                  <tr>
                    <th>Keterangan</th>
                    <th>Start</th>
                    <th>End</th>
                    <th>Aksi</th>
                  </tr>
                </thead>
                <tbody>
                <?php
                if(!empty($_GET['id'])){  
                $kar_id_=$_GET['id'];      
                $jwd_tampil_id=$jwd->jwd_tampil_id($kar_id_);
                while($jwd_data_id=mysql_fetch_array($jwd_tampil_id)){ 

                  $kar_id_=$jwd_data_id['kar_id'];
                  $kar_tampil_id_=$kar->kar_tampil_id($kar_id_);
                  $kar_data_=mysql_fetch_array($kar_tampil_id_);

                if($jwd_data_id['jwd_nm']=="Libur"){
                    $label="<span class='label label-danger'>Libur</span>";
                }elseif($jwd_data_id['jwd_nm']=="Cuti"){
                    $label="<span class='label label-danger'>Cuti</span>";
                }else{
                    $label="";
                } 
                ?>        
                  <tr>
                    <td><?php echo $label;?></td>
                    <td><?php echo $tgl->tgl_indo($jwd_data_id['jwd_start']); ?></td>
                    <td><?php echo $tgl->tgl_indo($jwd_data_id['jwd_end']); ?></td>
                    <td>
                      <a href="#delete-jadwal" data-toggle="modal" data-data="<h4>Yakin Hapus <strong><?php echo $jwd_data_id['jwd_nm'];?> - <?php echo $kar_data_['kar_nm'];?></strong> (<?php echo $tgl->tgl_indo($jwd_data_id['jwd_start']);?> - <?php echo $tgl->tgl_indo($jwd_data_id['jwd_end']);?>) ?</h4>" data-url="?p=data_penjadwalan&id=<?php echo $jwd_data_id['kar_id'];?>&act=hapus&no=<?php echo $jwd_data_id['jwd_id'];?>"><span style="cursor:pointer" class="label label-danger"><i class="fa fa-trash"></i></span></a>
                    <?php
                    if(($jwd_data_id['jwd_start'] < $date) && ($jwd_data_id['jwd_end'] < $date)){

                    ?>  
                      <span class="label label-default">Nonaktif</span>
                    <?php
                    }else{
                    ?>
                      <span class="label label-primary">Aktif</span>
                    <?php }?>  
                      
                    </td>
                  </tr>
                  
                <?php }}?>  
                </tbody>      
                <tfoot>
                  <tr>
                    <th>Keterangan</th>
                    <th>Start</th>
                    <th>End</th>
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

        <div class="col-xs-6">

      <form action="" method="post">

      <div class="box">

        <div class="box-header">

          <h3 class="box-title"> API Jadwal Online</h3>

          <div class="pull-right">
            
            <button type="sumbit" name="apiupdate" class="btn btn-lg btn-primary"><i class="fa fa-send"></i> Update</button>

          </div>

        </div><!-- /.box-header -->

        <div class="box-body">

     <!--<div>
            <label for="name">Name</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <input type="text" name="name" style="width: 48%;  font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">
         </div><br>-->

     <!-- <div class="input_fields_wrap">
            <button class="add_field_button">Add Email</button><br>
          </div><br> -->
          <div>
          <label for="comments">Contoh Kode</label><br>          
          <textarea class="form-control" rows="3" disabled>https://onedrive.live.com/embed?cid=88ED02B3080A3C5D&resid=88ED02B3080A3C5D%21119&authkey=AKnIx2LUJ8keIoQ&em=2&wdAllowInteractivity=False&wdHideGridlines=True&wdHideHeaders=True&wdDownloadButton=True</textarea>
          </div>
          <br>
          <?php
            $jwo_tampil=$jwd->jwo_tampil();
            while($jwo_tampil_id=mysql_fetch_assoc($jwo_tampil)){
          ?>
          <div>
          <label for="comments">Kode</label>
           <textarea name="jwo_kode" class="form-control" rows="3"><?php echo $jwo_tampil_id['jwo_kode'];?></textarea>
          </div>
          <?php }?>
        </div><!-- /.box-body -->

       </div><!-- /.box -->

      </form>
      
    </div><!-- /.col -->

        <div class="col-md-6">
          <div class="box box-danger">
            <div class="box-header">
              <h3 class="box-title">Calendar</h3>
        <!-- tools box -->
                  <div class="pull-right box-tools">
                    <button class="btn btn-info btn-sm" data-widget='collapse' data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
                    <button class="btn btn-info btn-sm" data-widget='remove' data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
                  </div><!-- /. tools -->
      </div>
            <!-- /.box-header -->
            <div class="box-body no-padding">
              
              <!-- THE CALENDAR -->
                  <div id="master_calendar"></div>

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
        <h4 class="modal-title" id="myModalLabel"><i class="fa fa-calendar"></i> Buat Penjadwalan</h4>
      </div>
      <form class="form-horizontal" action="" method="post">
      <div class="modal-body">
          <div class="form-group">
            <label for="ip_nm" class="col-sm-2 control-label">Date Range</label>
            <div class="col-sm-10">
              <div class="input-group">
                      <div class="input-group-addon">
                        <i class="fa fa-calendar"></i>
                      </div>
                      <input type="text" name="date_range" class="form-control pull-right" id="reservation"/>
                    </div><!-- /.input group -->
            </div>
          </div>
          <div class="form-group">
            <label for="typ_id" class="col-sm-2 control-label">Keterangan</label>
            <div class="col-sm-10">
                <input type="radio" name="jwd_nm" value="Libur" class="flat-red" id="jwd_nm" checked/> <span class="label label-danger">Libur</span> &nbsp;
                <input type="radio" name="jwd_nm" value="Cuti" class="flat-red" id="jwd_nm" checked/> <span class="label label-danger">Cuti</span> &nbsp;
            </div>   
          </div>
          
      </div>
      <div class="modal-footer">
        <button type="submit" name="bsave" class="btn btn-primary"><i class="fa fa-save"></i></button>
      </div>
      </form>
    </div>
  </div>
</div>

<div id="fullCalModal" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span> <span class="sr-only">close</span></button>
                <h4 class="modal-title"><i class="fa fa-calendar"></i> <span id="modalTitle"></span></h4>
            </div>
            <div class="modal-body"><i class="fa fa-user"></i> <span id="modalBody"></span></div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <!--<button class="btn btn-primary"><a id="eventUrl" target="_blank">Event Page</a></button>-->
            </div>
        </div>
    </div>
</div>


    
