<?php require('module/kar_activity_report/karactivityreport_act.php'); ?>
<style>
.tableFixHead          { overflow: auto; height: 70vh!important; width: 100%!important; }
.tableFixHead thead th { position: sticky; top: 0; z-index: 1; }
.tableFixHead tbody th { position: sticky; left: 0; }

/* Just common table stuff. Really. */
table  { border-collapse: collapse;}
th, td { padding: 8px 16px; }
th     { background:#eee; }
</style>

<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        <?php echo $title;?> &nbsp; <small><i>(<?php echo $datenow; ?>)</i></small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="media.php"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li class="active">
            <?php echo $title;?>
        </li>
    </ol>
</section>


<!-- Main content -->
<section class="content">
    <!-- Your Page Content Here -->
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header">
                    <form id="report_aktivitas_perjam" class="form-inline" action="" method="post">
                        <div class="form-group"> <label for="div_id" class="col-sm-2 control-label">Divisi</label>
                            <div class="col-sm-10">
                                <select class="form-control" name="div_id" id="div_id" required>
								<option value="0" selected>Seluruh Divisi</option>
									<?php 
										$div_tampil=$div->div_tampil();
										foreach($div_tampil as $data){echo $data['div_id'];	
											if($data['div_id'] == '6' || $data['div_id'] == '8' || $data['div_id'] == '10' || $data['div_id'] == '13') {
												echo '<option value="'.$data['div_id'].'">'.$data['div_nm'].'</option>';
											}
										}
									?>
								</select>
                            </div>
                        </div>
                        <div class="input-group"> <input type="text" id="filter_date" name="filter_date" class="form-control dpdays2_rkm"  placeholder="Tanggal">
                            <span class="input-group-btn">
							<button class="btn btn-default btn-flat" type="submit" name="tgl" id="tgl"><i class="fa fa-search"></i></button>		</span>
                        </div>
                    </form>
                </div>
                <div class="box-body table-responsive">
                    <?php echo $tbl; ?>
                </div>
            </div>
        </div>
    </div>
</section>



<div class="modal fade" id="modal_detail_report_perjam" tabindex="-1" role="dialog" aria-labelledby="myModalLabel_detail_report_perjam" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header bg-primary">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel_detail_report_perjam"><i class="fa fa-archive"></i> Laporan aktivitas aam <span id="label_mku"></span></h4>
      </div>
	  <div class="modal-body">
		  <table class="table wrap">
			<thead>
				<th>No</th>
				<th>Image</th>
				<th>Keterangan</th>
			</thead>
			<tbody id="detail_report_perjam"></tbody>
		  </table>
	 </div>
    </div>
  </div>
</div>