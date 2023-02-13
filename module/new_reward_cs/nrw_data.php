<?php require('module/new_reward_cs/nrw_act.php'); ?>
<!-- Content Header (Page header) -->
<section class="content-header">
  <h1> <?php echo $title;?> <small>Cut off tgl <?php echo $tgl_awal;?> s/d tgl <?php echo $tgl_akhir;?></small> </h1>
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
          <form class="form-inline" action="" method="post">
            <div class="input-group">
              <span class="input-group-btn">
                <?php if(!empty($_SESSION['fmonth'])){?>
                <button class="btn btn-danger btn-flat" type="submit" name="bclearmonth" title="Clear Filter"><i class="fa fa-close"></i></button>
                <?php }else{?>
                <button class="btn btn-default btn-flat" type="button" title="Filter"><i class="fa fa-calendar"></i></button>
                <?php }?>
              </span>
              <input type="text" name="filter_month" class="form-control dpmonth2" value="<?php echo $f_month;?>" placeholder="Bulan" readonly>
              <span class="input-group-btn">
                <button class="btn btn-default btn-flat" type="submit" name="bmonth"><i class="fa fa-search"></i></button>
              </span>
            </div>
          </form>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <table id="tb_new_reward_cs" class="table table-hover table-striped table-bordered nowrap" style="width:100%">
            <thead>
              <tr>
                <th rowspan="2" style="text-align: center; width: 5%">No</th>
                <th rowspan="2" style="text-align: center; width: 10%">NIK</th>
                <th rowspan="2" style="text-align: center; width: 30%">Nama</th>
                <th rowspan="2" style="text-align: center;">TCM</th>
                <th rowspan="2" style="text-align: center;">REG</th>				                
				<th rowspan="2" style="text-align: center;">REG Real</th>
				<th rowspan="2" style="text-align: center;">REG HER</th>
                <th colspan="3" style="text-align: center;">Normal</th>			
				<!--
                <th colspan="3" style="text-align: center;">Libur</th>			
				-->
                <th rowspan="2" style="text-align: center;">Incase</th>			
                <th colspan="3" style="text-align: center;">Normal(Rp)</th>			
				<!--
                <th colspan="3" style="text-align: center;">Libur(Rp)</th>			
				-->
                <th rowspan="2" style="text-align: center;">RWD HER</th>				                
                <th rowspan="2" style="text-align: center;">Insentif</th>				                
				<th rowspan="2" style="text-align: center;">Extra Insentif</th>				                
				<th rowspan="2" style="text-align: center;">Total Insentif</th>
                <th rowspan="2" style="text-align: center;"></th>
              </tr>
              <tr>
                <th style="text-align: center;">Full</th>
                <th style="text-align: center;">Promo</th>
                <th style="text-align: center;">Total</th><!--
                <th style="text-align: center;">Full</th>
                <th style="text-align: center;">Promo</th>
                <th style="text-align: center;">Total</th>-->

                <th style="text-align: center;">Full</th>
                <th style="text-align: center;">Promo</th>
                <th style="text-align: center;">Total</th><!--
                <th style="text-align: center;">Full</th>
                <th style="text-align: center;">Promo</th>
                <th style="text-align: center;">Total</th>-->
              </tr>
            </thead>
            <tbody>
              <?php
              $no=1;
              foreach($karyawanArr as $key=>$val){
                if($val['jml_pmb_kotor'] == 0){
                    $col_danger_kotor = "danger";
                }else{
                    $col_danger_kotor = "";
                }
                if($val['jml_pmb'] == 0){
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
                <td style="text-align: right;"><?php echo $val['tcm'];?></td>
                <td style="text-align: right;"><?php echo $val['jml_pmb'];?></td>				                
				<td style="text-align: right;"><?php echo $val['jml_reg_real'];?></td>
				<td style="text-align: right;"><?php echo $val['jml_her'];?></td>
                
                <td style="text-align: right;"><?php echo $val['nor_npromo'];?></td>
                <td style="text-align: right;"><?php echo $val['nor_promo'];?></td>
                <td style="text-align: right;"><?php echo $val['nor_total'];?></td>				
				<!--
                <td style="text-align: right;"><?php echo $val['lib_npromo'];?></td>
                <td style="text-align: right;"><?php echo $val['lib_promo'];?></td>
                <td style="text-align: right;"><?php echo $val['lib_total'];?></td>
                -->
                <td style="text-align: right;"><?php echo $val['incase'];?></td>
                <td style="text-align: right;"><?php echo $val['nor_npromo_rp'];?></td>
                <td style="text-align: right;"><?php echo $val['nor_promo_rp'];?></td>
                <td style="text-align: right;"><?php echo $val['nor_total_rp'];?></td>								
				<!--
                <td style="text-align: right;"><?php echo $val['lib_npromo_rp'];?></td>
                <td style="text-align: right;"><?php echo $val['lib_promo_rp'];?></td>
                <td style="text-align: right;"><?php echo $val['lib_total_rp'];?></td>				
				-->
                
                <td style="text-align: right;" class="<?php echo $col_success;?>"><?php echo $val['reward_her'];?></td>				                
                <td style="text-align: right;" class="<?php echo $col_success;?>"><?php echo $val['insentif'];?></td>				                
				<td style="text-align: right;" class="<?php echo $col_success;?>"><?php echo $val['extra_insentif'];?></td>				                
				<td style="text-align: right;" class="<?php echo $col_success;?>"><?php echo $val['total_insentif'];?></td>
                <td style="text-align: center;">
                  <a href="#"
                     data-nama='<?php echo $val['nama'];?>'
                     data-source='<?php echo $val['data_source'];?>'
                     data-toggle="modal" data-target="#datamhs_newreward"><i class="fa fa-users"></i></a>
                </td>
              </tr>
              <?php $no++; }?>
            </tbody>      
          </table>

        </div>
        <!-- /.box-body -->
        <div class="box-footer">
          <div class="alert alert-warning">
            <h4><i class="icon fa fa-info"></i> PERHATIAN!</h4>
            Hasil rekap reward <strong>Cut off tgl <?php echo $tgl_awal;?> s/d tgl <?php echo $tgl_akhir;?></strong> akan ditampilkan <strong>per tgl <?php echo date('d', strtotime('+1 day', strtotime($tgl_akhir)));?> (bulan berjalan) jam 00:30 wib</strong>
          </div>
        </div>
      </div>
      <!-- /.box --> 
    </div>
    <!-- /.col --> 
  </div>
  <!-- /.row --> 
  
</section>
<!-- /.content --> 
    

<style>
table{
    font-size: 0.9em;
}
.modal-dialog,
.modal-content {
    height: 80%;
}

.modal-body {
    max-height: calc(100% - 120px);
    overflow-y: scroll;
}
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

<div class="modal fade" id="datamhs_newreward" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel"><i class="fa fa-users"></i> <span id="data_nama"></span> | Raw Data Perolehan Reward</strong> </h4>
      </div>
      <div class="modal-body" id="data_source">
          
      </div>
    </div>
  </div>
</div>

<script>
  document.title = '<?php echo $export_file_name;?>';
</script>