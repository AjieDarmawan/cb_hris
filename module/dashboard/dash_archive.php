<!-- TO DO List -->
              <div class="box box-primary" data-step="6" 
              data-intro="<strong>Download Archive</strong> Merupakan kumpulan <strong>file-file</strong> yang dapat di download oleh karyawan
                         terkait <strong>Archive Penting</strong> yang bersumber dari <strong>Kantor Pusat</strong>.">
                <div class="box-header">
                  <!-- <i class="ion ion-clipboard"></i> -->
                  <h3 class="box-title">Download Archive</h3>
                  <!-- tools box -->
                  <div class="pull-right box-tools">
                    <button class="btn btn-info btn-sm" data-widget='collapse' data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
                    <button class="btn btn-info btn-sm" data-widget='remove' data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
                  </div><!-- /. tools -->
                </div><!-- /.box-header -->
                <div class="box-body" id="download">
                  <ul class="todo-list">
                    <?php
                    $acv_tampil_aktif=$acv->acv_tampil_aktif();
                    if($acv_tampil_aktif){
                    foreach($acv_tampil_aktif as $data){
                      $jointime=$data['acv_tgl'];
                      $sorttime=strtotime("$jointime");

                      $acv_pecah=explode(".", $data['acv_file']);
                      $acv_extend=$acv_pecah[1];

                      if($acv_extend == "pdf"){
                        $file = "<i class='fa fa-file-pdf-o text-danger'></i>";
                      }elseif($acv_extend == "doc" || $acv_extend == "docx"){
                        $file = "<i class='fa fa-file-word-o text-primary'></i>";
                      }elseif($acv_extend == "xls" || $acv_extend == "xlsx"){
                        $file = "<i class='fa fa-file-excel-o text-success'></i>";
                      }elseif($acv_extend == "ppt" || $acv_extend == "pptx"){
                        $file = "<i class='fa fa-file-powerpoint-o text-danger'></i>";
                      }elseif($acv_extend == "zip" || $acv_extend == "rar"){
                        $file = "<i class='fa fa-file-archive-o text-warning'></i>";
                      }else{
                        $file = "<i class='fa-file-image-o text-default'></i>";
                      }
                    ?>
                    <li>
                      <!-- drag handle -->
                      <span class="handle">
                        <i class="fa fa-ellipsis-v"></i>
                        <i class="fa fa-ellipsis-v"></i>
                      </span>
                      <!-- todo text -->
                      <span class="text"><?php echo $data['acv_nm']; ?></span>
                      <!-- Emphasis label -->
                      <small class="label label-danger"><i class="fa fa-user"></i> <?php echo $data['div_nm']; ?></small> <span class="label label-default"><i class="fa fa-clock-o"></i> <?php echo $tms->humanTiming($sorttime); ?></span>
                      <!-- General tools such as edit or delete-->
                      <div class="tools">
                        <form action="download.php" method="post" enctype="multipart/form-data">
                          <input type="hidden" name="acv_file" value="<?php echo $data['acv_file']; ?>">
                          <button type="submit" name="bacv" style="background:none;border:none;color:#3c8dbc;" title="Download"><?php echo $file;?> (<?php echo $sze->size2Byte(filesize("module/archive/file/$data[acv_file]")); ?>) <i class="fa fa-download"></i></button>
                        </form>
                        <!--<a href="module/archive/file/<?php //echo $data['acv_file']; ?>" title="Download"><?php //echo $file;?> (<?php //echo $sze->size2Byte(filesize("module/archive/file/$data[acv_file]")); ?>) <i class="fa fa-download"></i></a>-->
                      </div>
                    </li>
                    <?php }}?>
                  </ul>
                </div><!-- /.box-body -->
                <div class="box-footer clearfix no-border">
                </div>
              </div><!-- /.box -->