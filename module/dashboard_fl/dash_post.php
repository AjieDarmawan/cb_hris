 <!-- Chat box -->
              <div class="box box-success" data-step="7" 
              data-intro="<strong>Information Posting</strong> Merupakan kemudahan bagi karyawan yang ingin
                          menginformasikan <strong>Berita, Pengumuman, Attachment</strong> bersumber dari Kamu sendiri yang
                          dapat dilihat oleh seluruh karyawan <strong>Gilland Group</strong>.">
                <div class="box-header">
                  <!-- <i class="fa fa-comments-o"></i>-->
                  <h3 class="box-title">Information Posting</h3>
                  <!-- tools box -->
                  <div class="pull-right box-tools">
                    <!--<button class="btn btn-danger btn-sm" data-toggle="" data-target="" data-toggle="tooltip" title="Create Posting"><i class="fa fa-pencil"></i> Posting Closed</button>-->
                    <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#myModal" data-toggle="tooltip" title="Create Posting"><i class="fa fa-pencil"></i> Create Posting</button>
                  </div><!-- /. tools -->
                </div>
                <div class="box-body chat" id="forum-box">
                <?php
                $no=1;
                $pos_tampil_aktif=$pos->pos_tampil_aktif($kemarinnya_ymd);
                while($data=mysql_fetch_array($pos_tampil_aktif)){
                  $kar_id_pos=$data['kar_id'];
                  $acc_tampil_kar_pos=$acc->acc_tampil_kar($kar_id_pos);
                  $acc_data_pos=mysql_fetch_array($acc_tampil_kar_pos);

                  $kar_tampil_id=$kar->kar_tampil_id($kar_id_pos);
                  $kar_data_id=mysql_fetch_array($kar_tampil_id);

                  $jointime=$data['pos_tgl']." ".$data['pos_jam'];
                  $sorttime=strtotime("$jointime");

                  if($data['mrk_nm']=="Urgent"){
                    $lbl="danger";
                  }elseif($data['mrk_nm']=="Info"){
                    $lbl="primary";
                  }elseif($data['mrk_nm']=="Warning"){
                    $lbl="warning";
                  }

                  if(($no % 2)==0){
                    $warna="online";
                  }else{
                    $warna="offline";
                  }
                ?>
                  <!-- chat item -->
                  <div class="item">
                    <img src="module/profile/img/<?php
                    if(!empty($acc_data_pos['acc_img'])){
                      echo $acc_data_pos['acc_img'];
                    }else{
                      echo "avatar.jpg";
                    }
                    ?>" class="<?php echo $warna;?>" alt="User Image"/>

                    <p class="message">
                      <span class="name">
                        <small class="text-muted pull-right"><i class="fa fa-clock-o"></i> <?php echo $tms->humanTiming($sorttime); ?></small>
                        <a style="cursor: pointer" class="name" data-toggle="popover" title="<?php echo $data['kar_nm']; ?>" data-content="<center><img src='module/profile/img/<?php
                    if(!empty($acc_data_pos['acc_img'])){
                      echo $acc_data_pos['acc_img'];
                    }else{
                      echo "avatar.jpg";
                    }
                    ?>' class='img-circle img-popover' alt='User Image'/> <br><small><span class='label label-danger'><?php echo $kar_data_id['jbt_nm']; ?></span> <span class='label label-primary'><?php echo $kar_data_id['ktr_nm']; ?></span></small></center> <br> <a href='?p=data_profile&id=<?php echo $data['kar_id'];?>' class='btn btn-primary btn-flat btn-block'>Go to Profile</a> "><?php echo $data['kar_nm']; ?></a> &nbsp; <span class="label label-<?php echo $lbl;?>"><?php echo $data['mrk_nm']; ?></span>
                      </span>
                      <?php echo $data['pos_msg']; ?>
                    </p>

                    <?php
                    if(!empty($data['pos_atc'])){
                      $pos_pecah=explode(".", $data['pos_atc']);
                      $pos_extend=$pos_pecah[1];

                      /*
                      if($pos_extend == "pdf"){
                        $file = "Adobe_Acrobat_Reader.png";
                      }elseif($pos_extend == "doc" || $pos_extend == "docx"){
                        $file = "1435412505_Word_15.png";
                      }elseif($pos_extend == "xls" || $pos_extend == "xlsx"){
                        $file = "1435412515_Excel_15.png";
                      }elseif($pos_extend == "ppt" || $pos_extend == "pptx"){
                        $file = "1435412522_PowerPoint_15.png";
                      }elseif($pos_extend == "zip" || $pos_extend == "rar"){
                        $file = "ZIP_Archive.png";
                      }else{
                        $file = $data['pos_atc'];
                      }*/

                      if($pos_extend == "pdf"){
                        $file = "<i class='fa fa-file-pdf-o fa-3x text-danger'></i>";
                      }elseif($pos_extend == "doc" || $pos_extend == "docx"){
                        $file = "<i class='fa fa-file-word-o fa-3x text-primary'></i>";
                      }elseif($pos_extend == "xls" || $pos_extend == "xlsx"){
                        $file = "<i class='fa fa-file-excel-o fa-3x text-success'></i>";
                      }elseif($pos_extend == "ppt" || $pos_extend == "pptx"){
                        $file = "<i class='fa fa-file-powerpoint-o fa-3x text-danger'></i>";
                      }elseif($pos_extend == "zip" || $pos_extend == "rar"){
                        $file = "<i class='fa fa-file-archive-o fa-3x text-warning'></i>";
                      }else{
                        $file = "<img src='module/post/atc/$data[pos_atc]' alt='Attachment' width='50px'/>";
                      }
                    ?>
                    <div class="attachment">
                      <h4>Attachments:</h4>
                      <p class="filename">
                        <div id="profile-pic-large"><?php echo $file;?></div> <small><?php echo $data['pos_atc']; ?> 
                        (<?php echo $sze->size2Byte(filesize("module/post/atc/$data[pos_atc]")); ?>)</small>
                      </p>
                      <div class="pull-right">
                        <form action="download.php" method="post" enctype="multipart/form-data">
                          <input type="hidden" name="pos_file" value="<?php echo $data['pos_atc']; ?>">
                          <button type="submit" name="bpos" class="btn btn-primary btn-sm btn-flat">Open</button>
                        </form>
                        <!--<a href="module/post/atc/<?php //echo $data['pos_atc']; ?>" class="btn btn-primary btn-sm btn-flat">Open</a>-->
                      </div>
                    </div><!-- /.attachment -->
                    <?php }?>

                  </div><!-- /.item -->
                  <hr>
                <?php $no++;} ?>  
                </div><!-- /.chat -->
                <div class="box-footer">

                </div>
              </div><!-- /.box (chat box) -->


<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header bg-primary">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel"><i class="fa fa-pencil-square-o"></i> Create Posting</h4>
      </div>
      <form class="form-horizontal" action="" method="post" enctype="multipart/form-data">
      <div class="modal-body">
        <div class="alert alert-danger alert-dismissable">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
          <h4><i class="icon fa fa-ban"></i> PERHATIAN!</h4>
          <p>Setiap Posting yang dibuat oleh masing-masing User / Karyawan, akan ter-publish pada halaman Home / Dashboard Aplikasi dan dapat dilihat oleh semua karyawan.
          <br>Oleh karena itu, diharapkan agar membuat posting yang bermanfaat dan positif bagi kinerja karyawan dan kemajuan perusahaan. </p>
          <br>
          <ul>
            <li>Tidak mengandung unsur Provokatif, SARA, Rasis, Pornografi </li>
            <li>Tidak melanggar norma kepatutan lainnya (baik dalam bentuk gambar/foto maupun tulisan)</li>
            <li>Harus dengan tata tulisan dan tata bahasa yang baik.</li>
          </ul>
          <br>
          <p>Jika terdapat pelanggaran / posting yang tidak layak, maka Admin akan langsung menghapus posting yang terkait.
          <br>Terima kasih, agar dapat disikapi dengan bijak.</p>



        </div>
    <div class="form-group">
            <label for="pos_msg" class="col-sm-2 control-label">Message</label>
            <div class="col-sm-10">
              <textarea name="pos_msg" id="pos_msg" class="form-control" rows="3"  placeholder="Message" style="width: 100%; height: 125px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;" required></textarea>
              <br>
              <div class="btn btn-default btn-file" id="file">
                    <i class="fa fa-paperclip"></i> Attachment
              </div>
                    <input type="file" name="pos_atc"/>
                    <small class="help-block"><em>Max. 10MB</em></small>
            </div>
          </div> 
    <div class="form-group">
            <label for="mrk_id" class="col-sm-2 control-label">Mark As</label>
            <div class="col-sm-10">
                <?php
        $mrk_tampil=$mrk->mrk_tampil();
        foreach($mrk_tampil as $data){
          if($data['mrk_nm']=="Urgent"){
            $lbl="danger";
            $checked="";
          }elseif($data['mrk_nm']=="Info"){
            $lbl="primary";
            $checked="checked";
          }elseif($data['mrk_nm']=="Warning"){
            $lbl="warning";
            $checked="";
          }
          
        ?>
                <input type="radio" name="mrk_id" value="<?php echo $data['mrk_id']; ?>" class="flat-red" id="mrk_id" <?php echo $checked;?> /> <span class="label label-<?php echo $lbl;?>"><?php echo $data['mrk_nm']; ?></span> &nbsp;
                <?php }?>
            </div>   
          </div>
    
      </div>
      <div class="modal-footer">
        <button type="submit" name="bsave" class="btn btn-primary"><i class="fa fa-paper-plane-o"></i></button>
      </div>
      </form>
    </div>
  </div>
</div>