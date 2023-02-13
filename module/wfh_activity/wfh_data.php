<?php require('module/wfh_activity/wfh_act.php'); ?>
<!-- Content Header (Page header) -->
<section class="content-header">
  <h1> <?php echo $title;?> <small>(s/d H-1)</small> </h1>
  <ol class="breadcrumb">
    <li><a href="media.php"><i class="fa fa-dashboard"></i> Dashboard</a></li>
    <li class="active"><?php echo $title;?></li>
  </ol>
</section>

<!-- Main content -->
<section class="content"> 
    <!-- Your Page Content Here -->
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header">
                  <h3 class="box-title">
                    <form class="form-inline" method="post" action="">
                        
                        <div class="input-group">
                            <span class="input-group-btn">
                              <button class="btn btn-default btn-flat" type="submit" name="bclearday" title="Clear Filter"><i class="fa fa-close"></i></button>
                            </span>
                            <input style="width: 200px;" type="text" class="form-control dr" name="filter_day" title="Filter" value="<?php if(!empty($_SESSION['frange'])){ echo $_SESSION['frange'];}else{ echo $f_daterange; }?>" placeholder="Day">
                            <span class="input-group-btn">
                              <button class="btn btn-default btn-flat" type="submit" name="bday"><i class="fa fa-search"></i></button>
                            </span>
                        </div>  
          
                        <?php if(!empty($_SESSION['frange'])){?>
                        <span class="label bg-maroon"><i class="fa fa-check"></i> Filter Active</span>
                        <?php }?>
                        
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-user text-green"></i></span>
                            <select class="form-control select" name="filter_divisi" onchange="this.form.submit()">
                              <?php
                              if($kar_data['kar_jdw_akses'] == "ALL"){
                                $wfh_div_tampil=$wfh->wfh_div_tampil();
                              }else{
                                $wfh_div_tampil=$wfh->wfh_div_tampil_id($filter_divisi);
                              }
                              while($data=mysql_fetch_array($wfh_div_tampil)){
                              
                              if($data['div_id'] == $filter_divisi){
                                    $selected="selected";
                              }else{
                                    $selected="";
                              }
                              ?>
                              <option value="<?php echo $data['div_id'];?>" <?php echo $selected;?>><?php echo $data['div_nm'];?></option>
                              <?php }?>
                            </select>
                        </div>
                                
                    </form>
                  </h3>
                  <div class="pull-right">
                    
                  </div>
                </div><!-- /.box-header -->
                <div class="box-body  table-responsive touch drag">
                    <table class="table table-bordered table-striped table-hover table-condensed display" title="Silahkan Geser Cursor Untuk Lanjut Melihat">
                      <thead>
                        <tr>
                          <th><small>Tanggal</small></th>
                          <?php
                          foreach($arr_Karyawan as $key1 => $val1){
                          ?>
                          <th title="<?php echo $val1['kar_nm'];?>"><small><?php echo $val1['kar_nm'];?></small></th>
                          <?php }?>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                        $daterange = $tgl->date_range($r_awal_ori,$r_sekarang_ori,"+1 day","Y-m-d");
                        rsort($daterange);
                        foreach($daterange as $data){
                          $wfh_tgl_input = $data;
                          
                        ?>
                          <tr style="cursor: grab;">
                            <td class="text-blue"><?php echo date("d/m/Y", strtotime($data));?></td>
                            
                            <?php
                            foreach($arr_Karyawan as $key1 => $val1){
                                if($arr_Activity[$val1['kar_nik']][$wfh_tgl_input] == 'P'){
                                    $tdColor="success";
                                }elseif($arr_Activity[$val1['kar_nik']][$wfh_tgl_input] == 'C'){
                                    $tdColor="warning";
                                }else{
                                    $tdColor="danger";
                                }
                                
                                if($kar_data['kar_jdw_akses'] == "ALL"){
                            ?>
                            <td class="<?php echo $tdColor;?>" style="text-align: center; font-weight: bold;"><a href="?p=daily_activity_report&act=open&id=<?php echo $arr_WFHKey[$val1['kar_nik']][$wfh_tgl_input];?>" target="_blank"><?php echo $arr_Activity[$val1['kar_nik']][$wfh_tgl_input];?></a></td>
                            <?php
                                }else{
                                  if($val1['kar_nik'] == $kar_data['kar_nik']){
                            ?>
                            <td class="<?php echo $tdColor;?>" style="text-align: center; font-weight: bold;"><a href="?p=daily_activity_report&act=open&id=<?php echo $arr_WFHKey[$val1['kar_nik']][$wfh_tgl_input];?>" target="_blank"><?php echo $arr_Activity[$val1['kar_nik']][$wfh_tgl_input];?></a></td>
                            <?php }else{ ?>
                            <td class="<?php echo $tdColor;?>" style="text-align: center; font-weight: bold;"><?php echo $arr_Activity[$val1['kar_nik']][$wfh_tgl_input];?></td>
                            <?php }}}?>
                          </tr>
                        <?php }?>
                      </tbody>
                    </table>
                </div>
                <div class="box-footer">
                  <div class="alert alert-info" style="margin-top: 5px;">
                  <h4><i class="icon fa fa-info"></i> Keterangan :</h4>
                  1. <strong>"(MERAH)"</strong> : Belum membuat & mengirim report.<br>
                  2. <strong>"P"</strong> : Sudah membuat & mengirim report. <br>
                  3. <strong>"C"</strong> : Sudah membuat namun belum mengirim report.<br>
                  </div>
                </div>
            </div>
        </div>
    </div>
</section>