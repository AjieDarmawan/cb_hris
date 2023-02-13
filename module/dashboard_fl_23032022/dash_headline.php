<!-- general form elements -->
              <div class="box box-primary" data-step="5" data-intro="<strong>Headline News</strong> Merupakan sumber berita terupdate dimana informasi tersebut
                         datang dari <strong>Kantor Pusat</strong> perihal berita/pengumuman penting yang ditujukan
                         bagi semua karyawan <strong>Gilland Group</strong>. Jadi sering-sering di cek ya ada  
                         pengumuman apa hari ini.<br><br>
                         Bagi Karyawan yang ingin memasang berita di headline ini bisa hubungi ke bagian SDM.">
                <div class="box-header">
                  <h3 class="box-title">Headline News</h3>
                  <!-- tools box -->
                  <div class="pull-right box-tools">
                    <!-- <button class="btn btn-primary btn-sm" data-toggle="tooltip" title="Create"><i class="fa fa-pencil"></i></button> -->
                    <button class="btn btn-info btn-sm" data-widget='collapse' data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
                    <button class="btn btn-info btn-sm" data-widget='remove' data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
                  </div><!-- /. tools -->
                </div><!-- /.box-header -->
                  <div class="box-body table-responsive no-padding"> <!--headline-->
                    <ul class="news_ticker">
                      <?php
				$hed_tampil_aktif=$hed->hed_tampil_aktif($sepuluhhrsebelumnya);
				if($hed_tampil_aktif){
				foreach($hed_tampil_aktif as $data){
				  if($data['mrk_nm']=="Urgent"){
				    $lbl="danger";
				    $checked="";
                                    $block="danger";
				  }elseif($data['mrk_nm']=="Info"){
				    $lbl="primary";
				    $checked="checked";
                                    $block="";
				  }elseif($data['mrk_nm']=="Warning"){
				    $lbl="warning";
				    $checked="";
                                    $block="";
				  }

          $jointime=$data['hed_tgl'];
          $sorttime=strtotime("$jointime");
				?>
                        <li>
                          <table class="table table-hover">
                          <tr class="<?php echo $block;?>">
                            <td><small><i class="fa fa-clock-o"></i> <?php echo $tms->humanTiming($sorttime); ?></small></td>
                            <td><span class="label label-<?php echo $lbl;?>"><?php echo $data['mrk_nm']; ?></span></td>
                            <td><?php echo $data['hed_sbj']; ?></td>
                            <td><span class="label label-default"><i class="fa fa-user"></i> <?php echo $data['div_nm']; ?></span></td>
                            <td><a href="#view_headline_<?php echo $data['hed_id']; ?>" data-toggle="modal" title="View Headline"><i class="fa fa-external-link"></i></a></td>
                          </tr>
                          </table>
                          <!-- View Headline -->
                        <div class="modal fade" id="view_headline_<?php echo $data['hed_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                          <div class="modal-dialog">
                            <div class="modal-content">
                              <div class="modal-header bg-primary">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title" id="myModalLabel"><?php echo $data['hed_sbj']; ?></h4>
                              </div>
                              <form class="form-horizontal" action="" method="post">
                              <div class="modal-body">
                                  <p><?php echo $data['hed_msg']; ?></p>
                              </div>
                              <div class="modal-footer">
                                <span style="float:left;"><small>From:</small> <?php echo $data['div_nm']; ?></span> <small><?php echo $tgl->tgl_indo($data['hed_tgl']); ?></small> &nbsp;&nbsp; <span class="label label-<?php echo $lbl;?>"><?php echo $data['mrk_nm']; ?></span>
                              </div>
                              </form>
                            </div>
                          </div>
                        </div>
                        </li>
                        
                        
                        
                        <?php }}?>
                      </ul>
                  </div><!-- /.box-body -->


                  <div class="box-footer">
                    <!-- Note : -->    
                  </div>
              </div><!-- /.box -->
              
              