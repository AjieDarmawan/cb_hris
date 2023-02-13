<?php require('module/pemotongan_gaji/ptg_act.php'); ?>
<!-- Content Header (Page header) -->
<section class="content-header">
  <h1> <?php echo $title;?> <small>Cut off tgl 26 bulan sebelumnya s/d tgl 25 bulan berjalan</small> </h1>
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
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <table id="tb_potongan_gaji" class="table table-hover table-striped table-bordered nowrap" style="width:100%">
            <thead>
              <tr>
                <th style="text-align: center; width: 5%">No</th>
                <th style="text-align: center; width: 10%">NIK</th>
                <th style="text-align: center; width: 30%">Nama</th>
                <th style="text-align: center; width: 30%">Kampus</th>
                <th style="text-align: center;">Grade</th>
                <th style="text-align: center;">Target</th>
                <th style="text-align: center;">Pencapaian</th>
                <th style="text-align: center;">(%)Pemotongan</th>
                <th style="text-align: center;">(Rp)Insentif</th>
            </thead>
            <tbody>
              <?php
              $no=1;
              foreach($karyawanArr as $key=>$val){
                if($val['data'] == 0){
                    $col_danger = "danger";
                }else{
                    $col_danger = "";
                }
                
                if($val['insentif'] > 0){
                    $col_success = "success";
                }else{
                    $col_success = "";
                }
              ?>
              <tr>
                <td><?php echo $no;?></td>
                <td><?php echo $val['nik'];?></td>
                <td><?php echo $val['nama'];?></td>
                <td><?php echo $val['pts'];?></td>
                <td><?php echo $val['grade'];?></td>
                <td style="text-align: right;"><?php echo $val['target'];?></td>
                <td style="text-align: right;" class="<?php echo $col_danger;?>"><?php echo $val['data'];?></td>
                <td style="text-align: right;" class="<?php echo $col_danger;?>"><?php echo $val['prosen'];?></td>
                <td style="text-align: right;" class="<?php echo $col_success;?>"><?php echo number_format($val['insentif']);?></td>
              </tr>
              <?php $no++; }?>
            </tbody>      
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
    

<style>
#loading{
      text-align: center;
      display: none;
      position: fixed;
      background-color: rgba(0, 0, 0, 0.3);
      z-index: 1000;
      left: 0;
      top: 0;
      height: 100%;
      width: 100%;
      padding-top:10%;
    }
    #output{
      font-size: 10px;
    }
</style>

    
<div id="loading"><img src="dist/img/loadingnew3.gif" /></div>