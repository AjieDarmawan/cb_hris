<?php require('module/post/pos_act.php'); ?>
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
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Information Posting</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="tb_karyawan" class="table table-bordered table-striped table-hover">
                <thead>
                  <tr>
                    <th>Nama</th>
                    <th>Message</th>
                    <th>Attachment</th>
                    <th>Waktu</th>
                    <th>Mark</th>
                    <th>Aksi</th>
                  </tr>
                </thead>
                <tbody>
                <?php
        $pos_tampil=$pos->pos_tampil();
        while($data=mysql_fetch_array($pos_tampil)){
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

          if(!empty($data['pos_atc'])){
                      $pos_pecah=explode(".", $data['pos_atc']);
                      $pos_extend=$pos_pecah[1];

                      if($pos_extend == "pdf"){
                        $file = "fa-file-pdf-o";
                      }elseif($pos_extend == "doc" || $pos_extend == "docx"){
                        $file = "fa-file-word-o";
                      }elseif($pos_extend == "xls" || $pos_extend == "xlsx"){
                        $file = "fa-file-excel-o";
                      }elseif($pos_extend == "ppt" || $pos_extend == "pptx"){
                        $file = "fa-file-powerpoint-o";
                      }elseif($pos_extend == "zip" || $pos_extend == "rar"){
                        $file = "fa-file-archive-o";
                      }else{
                        $file = "fa-file-image-o";
                      }
               }       
        ?>
                  <tr>
                    <td><?php echo $data['kar_nm']; ?></td>
                    <td><?php echo strip_tags(substr(str_replace('"','',$data['pos_msg']),0,50)); ?> <span data-toggle="tooltip" title="<?php echo strip_tags(str_replace('"','',$data['pos_msg']));?>" style="cursor:pointer">... <i class="fa fa-external-link"></i></span> </td>
                    <td><?php if(!empty($data['pos_atc'])){?>
                    <form action="download.php" method="post" enctype="multipart/form-data">
                          <input type="hidden" name="pos_file" value="<?php echo $data['pos_atc']; ?>">
                          <button type="submit" name="bpos" style="background:none;border:none;color:#3c8dbc;" title="Download"><i class="fa <?php echo $file;?>"></i> <?php echo $data['pos_atc']; ?></button>
                    </form>
                    <!--<a href="module/post/atc/<?php //echo $data['pos_atc']; ?>"><i class="fa <?php //echo $file;?>"></i> <?php //echo $data['pos_atc']; ?> </a></span>-->
                    <?php }?></td>
                    <td><?php echo $tgl->tgl_indo($data['pos_tgl']); ?> <?php echo $data['pos_jam']; ?></td>
                    <td><span class="label label-<?php echo $lbl;?>"><?php echo $data['mrk_nm']; ?></span></td>
                    <td>
                    <!--<a href="#delete-confirm" data-toggle="modal" data-data="<?php //echo $data['kar_nm'];?> Posting" data-url="?p=data_posting&act=hapus&id=<?php //echo $data['pos_id'];?>"><span style="cursor:pointer" class="label label-danger"><i class="fa fa-trash"></i></span></a>-->
                    <?php
                    if(!empty($data['pos_sts'])){
                      if($data['pos_sts']=="A"){
                    ?>
                    <a href="#block-confirm" data-toggle="modal" data-data="<h4>Yakin Posting <strong><?php echo $data['kar_nm'];?></strong> akan di HIDDEN?</h4>" data-url="?p=data_posting&act=block&id=<?php echo $data['pos_id'];?>"><span style="cursor:pointer" class="label label-success"><i class="fa fa-check"></i></span></a>
                    <?php 
                    }elseif($data['pos_sts']=="N"){
                    ?>
                    <a href="#block-confirm" data-toggle="modal" data-data="<h4>UNHIDE Posting <strong><?php echo $data['kar_nm'];?></strong></h4>" data-url="?p=data_posting&act=unblock&id=<?php echo $data['pos_id'];?>"><span style="cursor:pointer" class="label label-danger"><i class="fa fa-ban"></i></span></a>
                    <?php }}?>
                    </td>
                  </tr>
                <?php }?>  
                </tbody>      
                <tfoot>
                  <tr>
                    <th>Nama</th>
                    <th>Message</th>
                    <th>Attachment</th>
                    <th>Waktu</th>
                    <th>Mark</th>
                    <th>Aksi</th>
                  </tr>
                </tfoot>
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
    
<!-- POPUP -->
<!-- Button trigger modal -->


