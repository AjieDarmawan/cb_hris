<?php require('module/kar_activity/karactivity_act.php'); ?>
<!-- Content Header (Page header) -->
<section class="content-header">
  <h1> Laporan Aktivitas Per Jam &nbsp; <small><i>(<?php echo $datenow; ?>)</i></small></h1>
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
                <div class="box-body">
                    <div class="row">
						<div class="col-md-7">
							<div class="row" id="list_jam"></div>
						</div>
						<div class="col-md-5">
							<div class="alert alert-info" style="margin-top: 5px;">
								<h4><i class="icon fa fa-info"></i> Keterangan :</h4>
								<ol>
									<li>Laporan hanya dapat dilakukan setiap jam</li>
									<li>Contoh kegiatan selama jam 08:00 - 09:00 bisa dilaporkan sampai dengan 08:55</li>
									<li>
										Keterangan Warna
										<ul>
											<li>Merah : Tidak ada kegiatan yang dilaporkan dijam tersebut</li>
											<li>Biru : Masih bisa laporan dijam tersebut</li>
											<li>Putih : Belum bisa laporan dijam tersebut</li>
											<li>Hijau : Sudah ada laporan kegiatan dijam tersebut</li>
										</ul>
									</li>
								</ol>
							</div>
						</div>
					</div>
					<input type="hidden" id="monitor_karactivity_upload" />
                </div>
            </div>
        </div>
    </div>
</section>


<div class="modal fade" id="modal_monitor_karactivity_upload" tabindex="-1" role="dialog" aria-labelledby="myModalLabel_monitor_karactivity_upload" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header bg-primary">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel_monitor_karactivity_upload"><i class="fa fa-archive"></i> Laporan aktivitas <span id="label_mku"></span></h4>
      </div>
      <form class="form-horizontal" action="" method="post" enctype="multipart/form-data">
		<div class="modal-body">
			<div class="form-group">
				<label for="acv_nm" class="col-sm-2 control-label">Keterangan</label>
				<div class="col-sm-10">
					<textarea type="text" name="txt_monitor_karactivity_upload" class="form-control" id="txt_monitor_karactivity_upload" placeholder="...."></textarea>
				</div>
			</div>
			<div class="form-group">
				<label for="acv_file" class="col-sm-2 control-label">Screenshoot</label>
				<div class="col-sm-10">
					<div class="btn btn-default btn-file" id="file">
						<i class="fa fa-paperclip"></i> Attachment File
					</div>
					<input type="file" name="monitor_karactivity_file"/>
					<small class="help-block"><em>Max. 1MB</em></small>
					<input type="hidden" value="" name="jam_txt_monitor_karactivity_upload" />
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