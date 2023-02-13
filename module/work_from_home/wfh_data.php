<?php require('module/work_from_home/wfh_act.php'); ?>

<style>
    .bfh-selectbox .bfh-selectbox-options{
        width: 100%;
    }
    .bfh-selectbox .bfh-selectbox-options ul{
        max-width: 100%;
    }
</style>
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
            <!-- Custom Tabs -->
            <div class="nav-tabs-custom">
              <ul class="nav nav-tabs">
                <li class="active"><a href="#tab_1" data-toggle="tab">Aktifitas Rutin</a></li>
                <li><a href="#tab_2" data-toggle="tab">Aktifitas Lainnya</a></li>
                <li class="pull-right"><a href="#" class="text-muted"><i class="fa fa-gear"></i></a></li>
              </ul>
              <div class="tab-content">
                <div class="tab-pane active" id="tab_1">
                    
                    <form action="" method="post">
                        <div class="row">
                          <div class="col-sm-4">
                            <div class="form-group">
                                <label>Tanggal:</label>
                                <div class="input-group">
                                  <div class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                  </div>
                                  <input type="text" class="form-control" name="wfd_tanggal" value="<?php echo $wfd_date;?>" data-inputmask="'alias': 'dd/mm/yyyy'" data-mask/>
                                </div><!-- /.input group -->
                            </div><!-- /.form group -->
                          </div>
                          <div class="col-sm-4">
                              <div class="bootstrap-timepicker">
                                <div class="form-group">
                                  <label>Start:</label>
                                  <div class="input-group">
                                    <input type="text" name="wfd_start" data-default-time="09:00:00" class="form-control timepicker"/>
                                    <div class="input-group-addon">
                                      <i class="fa fa-clock-o"></i>
                                    </div>
                                  </div><!-- /.input group -->
                                </div><!-- /.form group -->
                              </div>
                          </div>
                          <div class="col-sm-4">
                              <div class="bootstrap-timepicker">
                                <div class="form-group">
                                  <label>End:</label>
                                  <div class="input-group">
                                    <input type="text" name="wfd_end" data-default-time="17:00:00" class="form-control timepicker"/>
                                    <div class="input-group-addon">
                                      <i class="fa fa-clock-o"></i>
                                    </div>
                                  </div><!-- /.input group -->
                                </div><!-- /.form group -->
                              </div>
                          </div>
                        </div>
                        
                        <div class="row">
                          <div class="col-lg-12">
                            <div class="form-group">
                              <label>Aktifitas</label>
                              <div class="bfh-selectbox" id="wfh_id" data-name="wfh_id" data-value="" data-filter="true">
                                <div data-value=""></div>
                                <?php
                                    if($wfh_aktifitas){
                                        foreach($wfh_aktifitas as $data){  
                                ?>
                                <div data-value="<?php echo $data['wfh_id'];?>"><?php echo $data['wfh_aktifitas'];?></div>
                                <?php }}?>
                              </div>
                            </div>
                          </div>
                        </div>
                        
                        <div class="row">
                          <div class="col-sm-4">
                            <div class="form-group">
                                <label>Aksi</label>
                                <select class="form-control" name="wfd_aksi[]" id="wfd_aksi">
                                </select>
                            </div>
                          </div>
                          <div class="col-sm-4">
                            <div class="form-group">
                                <label>Satuan</label>
                                <select class="form-control" name="wfd_satuan" id="wfd_satuan">
                                </select>
                            </div>
                          </div>
                          <div class="col-sm-4">
                            <div class="form-group">
                                <label>Value</label>
                                <input type="number" name="wfd_value" class="form-control" value="0"/>
                            </div>
                          </div>
                        </div>
                        
                        <div class="form-group">
                            <label>Lokasi</label>
                            <select class="form-control" name="wfd_lokasi" id="wfd_lokasi">
                            </select>
                        </div>
                        
                        <div class="form-group">
                          <label id="wfd_keterangan_label">Keterangan</label>
                          <textarea class="form-control" name="wfd_keterangan" id="wfd_keterangan" rows="3" placeholder="Keterangan ..." required></textarea>
                        </div>
                        
                        <button type="submit" name="btncreatewfh" id="btnwfhrutin" class="btn btn-success" disabled>Create Report</button>
                    </form>
                </div><!-- /.tab-pane -->
                <div class="tab-pane" id="tab_2">
                    
                    <form action="" method="post">
                        <div class="row">
                          <div class="col-sm-4">
                              <div class="bootstrap-timepicker">
                                <div class="form-group">
                                  <label>Target Start:</label>
                                  <div class="input-group">
                                    <input type="text" name="wft_start" data-default-time="09:00:00" class="form-control timepicker"/>
                                    <div class="input-group-addon">
                                      <i class="fa fa-clock-o"></i>
                                    </div>
                                  </div><!-- /.input group -->
                                </div><!-- /.form group -->
                              </div>
                          </div>
                          <div class="col-sm-4">
                              <div class="bootstrap-timepicker">
                                <div class="form-group">
                                  <label>Target End:</label>
                                  <div class="input-group">
                                    <input type="text" name="wft_end" data-default-time="17:00:00" class="form-control timepicker"/>
                                    <div class="input-group-addon">
                                      <i class="fa fa-clock-o"></i>
                                    </div>
                                  </div><!-- /.input group -->
                                </div><!-- /.form group -->
                              </div>
                          </div>
                          <div class="col-sm-4">
                            <div class="form-group">
                                <label>Target Value</label>
                                <input type="number" name="wft_value" class="form-control" value="0"/>
                            </div>
                          </div>
                        </div>
                        
                        <hr>
                        
                        <div class="row">
                          <div class="col-sm-4">
                            <div class="form-group">
                                <label>Tanggal:</label>
                                <div class="input-group">
                                  <div class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                  </div>
                                  <input type="text" name="wfd_tanggal" value="<?php echo $wfd_date;?>" class="form-control" data-inputmask="'alias': 'dd/mm/yyyy'" data-mask/>
                                </div><!-- /.input group -->
                            </div><!-- /.form group -->
                          </div>
                          <div class="col-sm-4">
                              <div class="bootstrap-timepicker">
                                <div class="form-group">
                                  <label>Start:</label>
                                  <div class="input-group">
                                    <input type="text" name="wfd_start" data-default-time="09:00:00" class="form-control timepicker"/>
                                    <div class="input-group-addon">
                                      <i class="fa fa-clock-o"></i>
                                    </div>
                                  </div><!-- /.input group -->
                                </div><!-- /.form group -->
                              </div>
                          </div>
                          <div class="col-sm-4">
                              <div class="bootstrap-timepicker">
                                <div class="form-group">
                                  <label>End:</label>
                                  <div class="input-group">
                                    <input type="text" name="wfd_end" data-default-time="17:00:00" class="form-control timepicker"/>
                                    <div class="input-group-addon">
                                      <i class="fa fa-clock-o"></i>
                                    </div>
                                  </div><!-- /.input group -->
                                </div><!-- /.form group -->
                              </div>
                          </div>
                        </div>
                        
                        <div class="form-group">
                          <label>Aktifitas</label>
                          <input type="hidden" name="wfh_id" value="1"/>
                          <input type="text" name="wfd_aktifitas" id="wfd_aktifitas" class="form-control" placeholder="Aktifitas ..."/>
                        </div>
                        
                        <div class="row">
                          <div class="col-sm-4">
                            <div class="form-group">
                                <label>Aksi</label>
                                <select class="form-control" name="wfd_aksi[]">
                                  <?php
                                    if($dataArr){
                                        foreach($dataArr['data']['wfh_aksi'] as $data){  
                                    ?>
                                  <option value="<?php echo $data;?>"><?php echo $data;?></option>
                                  <?php }}?>
                                </select>
                            </div>
                          </div>
                          <div class="col-sm-4">
                            <div class="form-group">
                                <label>Satuan</label>
                                <select class="form-control" name="wfd_satuan">
                                  <?php
                                    if($dataArr){
                                        foreach($dataArr['data']['wfh_satuan'] as $data){  
                                    ?>
                                  <option value="<?php echo $data;?>"><?php echo $data;?></option>
                                  <?php }}?>
                                </select>
                            </div>
                          </div>
                          <div class="col-sm-4">
                            <div class="form-group">
                                <label>Value</label>
                                <input type="number" name="wfd_value" class="form-control" value="0"/>
                            </div>
                          </div>
                        </div>
                        
                        <div class="form-group">
                            <label>Lokasi</label>
                            <select class="form-control" name="wfd_lokasi">
                              <?php
                                if($dataArr){
                                    foreach($dataArr['data']['wfh_lokasi'] as $data){  
                                ?>
                              <option value="<?php echo $data;?>"><?php echo $data;?></option>
                              <?php }}?>
                            </select>
                        </div>
                        
                        <div class="form-group">
                          <label>Keterangan/Link/URL</label>
                          <textarea class="form-control" name="wfd_keterangan" rows="3" placeholder="Keterangan/Link/URL ..." required></textarea>
                        </div>
                        
                        <button type="submit" name="btncreatewfh" id="btnwfhlain" class="btn btn-warning" disabled>Create Report</button>
                    </form>
                </div><!-- /.tab-pane -->
              </div><!-- /.tab-content -->
            </div><!-- nav-tabs-custom -->
        
        </div>
        <div class="col-md-6">
            <div class="box">
                <div class="box-header">
                  <h3 class="box-title">
                    Daily Report
                  </h3>
                  <div class="pull-right">
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
                </div><!-- /.box-header -->
                <div class="box-body">
                    <table id="tb_report_wfh" class="table table-hover table-striped table-bordered">
                        <thead>
                          <tr>
                            <th>Nomor</th>
                            <th>Nama</th>
                            <th>Aksi</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php
                            if($kar_data['kar_jdw_akses'] == "ALL"){
                                $_karID = "all";
                            }elseif($kar_data['kar_jdw_akses'] == "" || $kar_data['kar_jdw_akses'] == NULL){
                                $_arrID = array($kar_data['kar_nik']);
                                $_karID = implode("','", $_arrID);
                            }else{
                                $kar_jdw_akses = $kar_data['kar_nik'].",".$kar_data['kar_jdw_akses'];
                                $_arrID = explode(",",$kar_jdw_akses);
                                $_karID = implode("','", $_arrID);
                            }
                            
                            $wfh_data_distict=$wfh->wfh_data_distict($wfd_date_ori,$_karID);
                            while($data=mysql_fetch_array($wfh_data_distict)){
                                $IDnya = md5($data['wfd_nomor']);
                                if($data['kar_id'] == $kar_id){
                                    $wfd_lock= "lock";
                                }else{
                                    if($data['wfd_lock']=="Y"){
                                        $wfd_lock= "lock";
                                    }else{
                                        $wfd_lock= "";
                                    }
                                }
                                if($wfd_lock == "lock"){
                          ?>
                          <tr>
                            <td><?php echo $data['wfd_nomor'];?></td>
                            <td><?php echo $data['wfd_nama'];?></td>
                            <td>
                                <a href="?p=daily_activity_report&act=open&id=<?php echo $IDnya;?>" target="_blank" title="Detail Report"><span style="cursor:pointer" class="label label-primary">(<?php echo $data['wfd_count'];?>)</a>
                                <?php
                                if($data['kar_id'] == $kar_id){
                                    if($data['wfd_lock']=="Y"){
                                ?>
                                <a href="#" title="Delete"><span class="label label-default"><i class="fa fa-trash"></i></span></a>
                                <a href="#block-confirm" title="Unpublish" data-toggle="modal" data-data="<h4>Yakin Nomor Report <strong><?php echo $data['wfd_nomor'];?></strong> akan di Unpublish?</h4>" data-url="?p=daily_activity&act=unpublish&id=<?php echo $IDnya;?>"><span style="cursor:pointer" class="label label-success"><i class="fa fa-check"></i></span></a>
                                <?php 
                                    }elseif($data['wfd_lock']=="N"){
                                ?>
                                <a href="#delete-confirm" title="Delete" data-toggle="modal" data-data="Report <?php echo $data['wfd_nomor'];?>" data-url="?p=daily_activity&act=hapus&id=<?php echo $IDnya;?>"><span style="cursor:pointer" class="label label-danger"><i class="fa fa-trash"></i></span></a>
                                <a href="#block-confirm" title="Publish" data-toggle="modal" data-data="<h4>Yakin Nomor Report <strong><?php echo $data['wfd_nomor'];?></strong> akan di Publish?</h4>" data-url="?p=daily_activity&act=publish&id=<?php echo $IDnya;?>"><span style="cursor:pointer" class="label label-default"><i class="fa fa-check"></i></span></a>
                                <?php }}?>
                            </td>
                          </tr>
                          <?php }}?>
                        </tbody>
                    </table>
                </div>
                <div class="box-footer">
                <?php
                if($kar_data['kar_jdw_akses'] == "ALL"){
                ?>
                    <div class="row">
                        <div class="col-sm-8" style="padding-top:5px">
                            <button type="button" data-tanggal="<?php echo $wfd_date_ori;?>" data-status="N" data-wfd_mdcolor="bg-red" data-wfd_mdlabel="Tidak Mereport : <?php echo $wfd_date;?>" data-toggle="modal" data-target="#wfh_statusreport" class="btn btn-danger">Tidak Mereport</button>
                            <button type="button" data-tanggal="<?php echo $wfd_date_ori;?>" data-status="C" data-wfd_mdcolor="bg-yellow" data-wfd_mdlabel="Belum diPublish : <?php echo $wfd_date;?>" data-toggle="modal" data-target="#wfh_statusreport" class="btn btn-warning">Belum Publish</button>
                            <button type="button" data-tanggal="<?php echo $wfd_date_ori;?>" data-status="P" data-wfd_mdcolor="bg-green" data-wfd_mdlabel="Sudah Publish : <?php echo $wfd_date;?>" data-toggle="modal" data-target="#wfh_statusreport" class="btn btn-success">Sudah Publish</button>
                        </div>
                        <div class="col-sm-4" style="padding-top:5px; text-align: center">
                            <a href="?p=daily_activity_summary" target="_blank" class="btn btn-primary">Summary Activity</a>
                        </div>
                    </div>
                <?php }else{?>
                    <a href="?p=daily_activity_summary" target="_blank" class="btn btn-block btn-primary">Summary Activity</a>
                    <div class="alert alert-info" style="margin-top: 5px;">
                    <h4><i class="icon fa fa-info"></i> Keterangan :</h4>
                    1. <strong>"Aktifitas Rutin"</strong> (data aktifitas yang sudah tersistem dan sudah memiliki target perdivisi).<br>
                    2. <strong>"Aktifitas Lainnya"</strong> (data aktifitas yang belum ada di sistem dan targetnya di tentukan sendiri). <br>
                    3. <strong>Tombol Detail</strong> (untuk melihat seluruh aktifitas yang akan dilaporkan perharinya), berserta info jumlah aktifitas.<br>
                    4. <strong>Tombol Hapus</strong> (untuk menghapus report), <strong>*ketika report di publish tidak bisa dihapus</strong>.<br>
                    5. <strong>Tombol Publish</strong> (untuk menpublish report) <strong>*jika belum dipublish report hanya bisa dilihat oleh karyawan itu sendiri</strong>. Pastikan cheklist sudah berwarna hijau <span class="label label-success"><i class="fa fa-check"></i></span> (Publish)<br>
                    </div>
                <?php }?>
                </div>
            </div>
        </div>
    </div>
  
  
</section>
<!-- /.content -->

<!-- Modal Status Report -->
<div class="modal fade" id="wfh_statusreport" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header" id="wfd_mdcolor">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel"><i class="fa fa-file"></i> <span id="wfd_mdlabel"></span></h4>
      </div>
      <div class="modal-body" id="body_wfh_statusreport">
        <table id="tb_wfh_statusreport" class="table table-hover table-striped table-bordered">
            <thead>
              <tr>
                <th>NIK</th>
                <th>Nama</th>
                <th>Divisi</th>
              </tr>
            </thead>
            <tbody id="list_wfh_statusreport">
            </tbody>
        </table>
      </div>
    </div>
  </div>
</div>