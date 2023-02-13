<?php require('module/work_from_home/wfh_act.php'); ?>
<?php //if($fpk_cek_id > 0){?>
<!-- Content Header (Page header) -->
    <section class="content-header">
      <h1> <?php echo $title ." - ". $kar_data_['kar_nm'];?> <small></small> </h1>
      <ol class="breadcrumb">
        <li><a href="media.php"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li class="active"><?php echo $title;?></li>
      </ol>
    </section>
    <!--
    <div class="row">
    <div class="col-xs-6">-->
    <form class="form-horizontal" action="" method="post">
      <!-- Main content -->
        <section class="invoice col-md-8">
          <!-- title row -->
          <div class="row">
            <div class="col-sm-12 col-md-10">
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
	    <div class="col-sm-12 col-md-2">
	      <center><img src="module/profile/img/<?php echo $img_user;?>" width="100" height="125"></center> 
	    </div>
          </div>
          <!-- info row -->
          <div class="row invoice-info">
          <center><h3 style="margin-bottom: 20px;"><u>JOBLIST DAILY ACTIVITY</u></h3></center>

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
		<?php
		if($wfd_data['wfd_tanggal']!=="0000-00-00"){
		  $wfd_tanggal_="Date: <strong> ".$tgl->tgl_indo($wfd_data['wfd_tanggal']) ."</strong>";
		}else{
		  $wfd_tanggal_="";
		}
		echo $wfd_tanggal_;
		?><br>
		Nomor &nbsp;&nbsp;<b> <?php echo $wfd_data['wfd_nomor'];?> <?php echo $wfh_locked;?></b>
              </address>
            </div><!-- /.col -->
          </div><!-- /.row -->

          <!-- Table row -->
          <div class="row">
            <div class="col-xs-12 table-responsive">
  
                <table class="table">
                  <tbody>
                    <tr>
                        <th colspan="2"><small>List Aktifitas</small></th>
			<th><small>Lokasi</small></th>
                        <th><small>Aksi</small></th>
                        <th><small>Start</small></th>
                        <th><small>End</small></th>
                        <th><small>QTY/%</small></th>
                        <th></th>
                        <th><small>Status</small></th>
                    </tr>
                    <?php
                    if($dataRPT){
                        foreach($dataRPT as $key => $val){
                    ?>
                    <tr class="info">
                        <th colspan="9"><small><?php echo $key;?></small></th>
                    </tr>
                    <?php foreach($val as $key1 => $val1){
                            if($val1['kar_id'] == $kar_id){
                                if($val1['wfd_lock']=="N"){
                                    $wfd_lock= "";
                                }else{
                                    $wfd_lock= "lock";
                                }
                            }else{
                                if($val1['wfd_lock']=="Y"){
                                    $wfd_lock= "lock";
                                }else{
                                    $wfd_lock= "";
                                }
                            }
                    ?>
                    <tr>
                        <td><i class="fa fa-check-square-o"></i></td>
                        <td><?php echo $val1['wfd_aktifitas'];?></td>
			<td><?php echo $val1['wfd_lokasi'];?></td>
                        <td><?php echo $val1['wfd_aksi'];?></td>
                        <td><?php echo $val1['wfd_start'];?></td>
                        <td><?php echo $val1['wfd_end'];?></td>
                        <td><?php echo $val1['wfd_value'];?></td>
                        <td>
                            <a href="javascript:;" title="Detail Keterangan/Link/URL" data-wfd_keterangan="<?php echo $val1['wfd_keterangan'];?>" data-wfd_aktifitas="<?php echo $val1['wfd_aktifitas'];?>" data-toggle="modal" data-target="#isiketerngan"><span style="cursor:pointer" class="label label-primary"><i class="fa fa-ellipsis-h"></i></span></a>
                            <?php
			    if($val1['kar_id'] == $kar_id){
			    if($wfd_lock == "lock"){?>
                            <a href="#" title="Delete"><span class="label label-default"><i class="fa fa-trash"></i></span></a>
                            <?php }else{?>
                            <a href="#delete-confirm" title="Delete" data-toggle="modal" data-data="Aktifitas <?php echo $val1['wfd_aktifitas'];?>" data-url="media.php?p=daily_activity_report&act=open&id=<?php echo $wfd_key;?>&subact=hapus&subid=<?php echo $val1['wfd_id'];?>?>"><span style="cursor:pointer" class="label label-danger"><i class="fa fa-trash"></i></span></a>
                            <?php }}?>
                        </td>
                        <td><small><?php echo $val1['wfd_status'];?></small></td>
                    </tr>
                    <?php }}}?>
                  </tbody>
                </table>

            </div><!-- /.col -->
          </div><!-- /.row -->
	  
        </section><!-- /.content -->
        <div class="clearfix"></div>
  </form>      
<!--
    </div>
    </div>    -->
    
    
<!-- Modal Keterangan -->
<div class="modal fade" id="isiketerngan" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header bg-primary">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel"><i class="fa fa-file"></i> Keterangan/Link/URL <strong id="wfd_aktifitas"></strong></h4>
      </div>
      <div class="modal-body">
	<textarea class="form-control" id="wfd_keterangan" rows="15" readonly style="display:none;"></textarea>
	<div class="tarea" id="wfd_keterangan_output"></div>
      </div>
    </div>
  </div>
</div>

<?php //}else{ echo"<script>document.location='?p=not_found';</script>";}?>