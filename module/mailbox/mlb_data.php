<?php require('module/mailbox/mlb_act_new.php'); ?>
<!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            <?php echo $title;?>
            <?php
                $div_id=$kar_data['div_id'];
                $kar_id=$kar_data['kar_id'];
                $mlb_tampil_sts=$mlb->mlb_tampil_sts($div_id,$kar_id);
                $mlb_cek_sts=mysql_num_rows($mlb_tampil_sts);
                if($mlb_cek_sts > 0){
            ?>  
            <small><?php echo $mlb_cek_sts;?> new messages</small>
            <?php }?>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active"><?php echo $title;?></li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
          <div class="row">
            <div class="col-md-3">
              <a class="btn btn-primary btn-block margin-bottom" data-toggle="modal" data-target="#myModal"><i class="fa fa-pencil"></i> Compose</a>
              <div class="box box-solid">
                <div class="box-header with-border">
                  <h3 class="box-title">Folders</h3>
                  <div class='box-tools'>
                    <button class='btn btn-box-tool' data-widget='collapse'><i class='fa fa-minus'></i></button>
                  </div>
                </div>
                <div class="box-body no-padding">
                  <ul class="nav nav-pills nav-stacked">
                    <?php
                      $active="active";
                    ?>
                    <li class="<?php if(($_GET['s']=="inbox")){ echo $active;}?>"><a href="?p=data_mailbox&s=inbox"><i class="fa fa-inbox"></i> Inbox 
                    <?php
                        $div_id=$kar_data['div_id'];
                        $kar_id=$kar_data['kar_id'];
                        $mlb_tampil_sts=$mlb->mlb_tampil_sts($div_id,$kar_id);
                        $mlb_cek_sts=mysql_num_rows($mlb_tampil_sts);
                        if($mlb_cek_sts > 0){
                    ?>
                    <span class="label label-primary pull-right"><?php echo $mlb_cek_sts;?></span>
                    <?php }?> 
                    </a></li>
                    <li class="<?php if(($_GET['s']=="sent")){ echo $active;}?>"><a href="?p=data_mailbox&s=sent"><i class="fa fa-envelope-o"></i> Sent</a></li>
                  </ul>
                </div><!-- /.box-body -->
              </div><!-- /. box -->
              
            </div><!-- /.col -->

            
            <div class="col-md-9">

            <?php
            if(!empty($_GET['s'])){
            if($_GET['s']=="inbox"){
              if(empty($_GET['r'])){
            ?>
            <!--INBOX-->
              <div class="box box-primary">
                <div class="box-header with-border">
                  <h3 class="box-title">Inbox</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <table id="tb_inbox" class="table table-striped table-hover">
                <thead>
                  <tr>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                  </tr>
                </thead>
                <tbody>
                <?php
                $div_id=$kar_data['div_id'];
                $kar_id=$kar_data['kar_id'];
                $mlb_tampil_array=$mlb->mlb_tampil_array();
                if($mlb_tampil_array){
                foreach($mlb_tampil_array as $data){

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

                  if(!empty($data['mlb_atc'])){
                    $icon="<i class='fa fa-paperclip'></i>";
                  }else{
                    $icon="";
                  }

                  if(!empty($data['mlb_sts'])){
                    if($data['mlb_sts']=="N"){
                      $sts="<a><i class='fa fa-circle'></i></a>";
                    }elseif($data['mlb_sts']=="R"){
                      $sts="<a><i class='fa fa-circle-thin'></i></a>";
                    }
                  }

                  $jointime=$data['mlb_tgl']." ".$data['mlb_jam'];
                  $sorttime=strtotime("$jointime");
                ?>
                <?php
                if(!empty($data['mlb_tujuan'])){
                    if($data['mlb_tujuan']==$div_id){

                      $div_id_ = $data['mlb_tujuan'];
                      $div_tampil_id_ = $div->div_tampil_id_($div_id_);
                      $data_div_ = mysql_fetch_array($div_tampil_id_);
                ?>
                  <tr>
                    <td><?php echo $sts;?></td>
                    <td><a href="?p=data_mailbox&s=inbox&r=read&id=<?php echo $data['mlb_id']; ?>"><?php echo $data_div_['div_nm']; ?></a></td>
                    <td><strong><?php echo strip_tags(substr(str_replace('"','',$data['mlb_sbj']),0,20)); ?></strong> - <?php echo strip_tags(substr(str_replace('"','',$data['mlb_msg']),0,50)); ?>...</td>
                    <td><span class="label label-<?php echo $lbl;?>"><?php echo $data['mrk_nm']; ?></span></td>
                    <td><?php echo $icon;?></td>
                    <td><i class="fa fa-clock-o"></i> <?php echo $tms->humanTiming($sorttime); ?></td>
                  </tr>
                <?php 
                    }
                }
                if(!empty($data['mlb_sub_tujuan'])){
                    if($data['mlb_sub_tujuan']==$kar_id){

                      $kar_id_ = $data['kar_id'];
                      $kar_tampil_id_ = $kar->kar_tampil_id($kar_id_);
                      $data_kar_ = mysql_fetch_array($kar_tampil_id_);
                ?> 
                  <tr>
                    <td><?php echo $sts;?></td>
                    <td><a href="?p=data_mailbox&s=inbox&r=read&id=<?php echo $data['mlb_id']; ?>"><?php echo $data_kar_['kar_nm']; ?></a></td>
                    <td><strong><?php echo strip_tags(substr(str_replace('"','',$data['mlb_sbj']),0,20)); ?></strong> - <?php echo strip_tags(substr(str_replace('"','',$data['mlb_msg']),0,50)); ?>...</td>
                    <td><span class="label label-<?php echo $lbl;?>"><?php echo $data['mrk_nm']; ?></span></td>
                    <td><?php echo $icon;?></td>
                    <td><i class="fa fa-clock-o"></i> <?php echo $tms->humanTiming($sorttime); ?></td>
                  </tr>
                <?php
                    }
                }
                ?>     
                <?php }}?>  
                </tbody>      
                <tfoot>
                  <tr>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                  </tr>
                </tfoot>
              </table>
                </div><!-- /.box-body -->
                
              </div><!-- /. box -->
              <?php
              }}elseif($_GET['s']=="sent"){
                if(empty($_GET['r'])){
              ?>
              <!--SENT-->
              <div class="box box-primary">
                <div class="box-header with-border">
                  <h3 class="box-title">Sent</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <table id="tb_sent" class="table table-striped table-hover">
                <thead>
                  <tr>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                  </tr>
                </thead>
                <tbody>
                <?php
                $div_id=$kar_data['div_id'];
                $kar_id=$kar_data['kar_id'];
                $mlb_tampil_array=$mlb->mlb_tampil_array();
                if($mlb_tampil_array){
                foreach($mlb_tampil_array as $data){  
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

                  if(!empty($data['mlb_atc'])){
                    $icon="<i class='fa fa-paperclip'></i>";
                  }else{
                    $icon="";
                  }

                  if(!empty($data['mlb_sts'])){
                    if($data['mlb_sts']=="N"){
                      $sts="<a><i class='fa fa-clock-o'></i></a>";
                    }elseif($data['mlb_sts']=="R"){
                      $sts="<a><i class='fa fa-check-circle'></i></a>";
                    }
                  }

                  $jointime=$data['mlb_tgl']." ".$data['mlb_jam'];
                  $sorttime=strtotime("$jointime");
                ?>
                <?php
                if(!empty($data['mlb_tujuan'])){
                    if($data['kar_id']==$kar_id){

                      $div_id_ = $data['mlb_tujuan'];
                      $div_tampil_id_ = $div->div_tampil_id_($div_id_);
                      $data_div_ = mysql_fetch_array($div_tampil_id_);
                ?>
                  <tr>
                    <td><?php echo $sts;?></td>
                    <td><a href="?p=data_mailbox&s=sent&r=read&id=<?php echo $data['mlb_id']; ?>"><?php echo $data_div_['div_nm']; ?></a></td>
                    <td><strong><?php echo strip_tags(substr(str_replace('"','',$data['mlb_sbj']),0,20)); ?></strong> - <?php echo strip_tags(substr(str_replace('"','',$data['mlb_msg']),0,50)); ?>...</td>
                    <td><span class="label label-<?php echo $lbl;?>"><?php echo $data['mrk_nm']; ?></span></td>
                    <td><?php echo $icon;?></td>
                    <td><i class="fa fa-clock-o"></i> <?php echo $tms->humanTiming($sorttime); ?></td>
                  </tr>
                <?php 
                    }
                }
                if(!empty($data['mlb_sub_tujuan'])){
                    if($data['kar_id']==$kar_id){

                      $kar_id_ =$data['mlb_sub_tujuan'];
                      $kar_tampil_id_ = $kar->kar_tampil_id($kar_id_);
                      $data_kar_ = mysql_fetch_array($kar_tampil_id_);
                ?>
                  <tr>
                    <td><?php echo $sts;?></td>
                    <td><a href="?p=data_mailbox&s=sent&r=read&id=<?php echo $data['mlb_id']; ?>"><?php echo $data_kar_['kar_nm']; ?></a></td>
                    <td><strong><?php echo strip_tags(substr(str_replace('"','',$data['mlb_sbj']),0,20)); ?></strong> - <?php echo strip_tags(substr(str_replace('"','',$data['mlb_msg']),0,50)); ?>...</td>
                    <td><span class="label label-<?php echo $lbl;?>"><?php echo $data['mrk_nm']; ?></span></td>
                    <td><?php echo $icon;?></td>
                    <td><i class="fa fa-clock-o"></i> <?php echo $tms->humanTiming($sorttime); ?></td>
                  </tr>
                <?php
                    }
                }
                ?>   
                <?php }}?>  
                </tbody>      
                <tfoot>
                  <tr>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                  </tr>
                </tfoot>
              </table>
                </div><!-- /.box-body -->
                
              </div><!-- /. box -->
              <?php }}}?>

              <?php
              if(!empty($_GET['r'])){
              if($_GET['r']=="read"){
                $kar_id_ = $mlb_data['mlb_sub_tujuan'];
                $kar_tampil_id_ = $kar->kar_tampil_id($kar_id_);
                $data_kar_ = mysql_fetch_array($kar_tampil_id_);

                $div_id_ = $mlb_data['mlb_tujuan'];
                $div_tampil_id_ = $div->div_tampil_id_($div_id_);
                $data_div_ = mysql_fetch_array($div_tampil_id_);

                if($_GET['s']=="inbox"){
                  $kar_id_=$mlb_data['kar_id'];
                }
                if($_GET['s']=="sent"){
                  $kar_id_=$mlb_data['mlb_sub_tujuan'];
                }

                if(!empty($mlb_data['mlb_tujuan'])){
                  $to=$data_div_['div_nm'];
                  $kar_id_=$mlb_data['kar_id'];
                  $kar_tampil_id_ = $kar->kar_tampil_id($kar_id_);
                  $data_kar_ = mysql_fetch_array($kar_tampil_id_);
                  $acc_tampil_kar_=$acc->acc_tampil_kar($kar_id_);
                  $acc_data_=mysql_fetch_array($acc_tampil_kar_);
                  $jbt=$data_kar_['jbt_nm'];
                  if($_GET['s']=="inbox"){
                    $pop=$mlb_data['kar_nm'];
                    $id=$mlb_data['kar_id'];
                  }
                  if($_GET['s']=="sent"){
                    $pop=$data_kar_['kar_nm'];
                    $id=$data_kar_['kar_id'];
                  }
                }
                if(!empty($mlb_data['mlb_sub_tujuan'])){
                  $to=$data_kar_['kar_nm'];
                  $acc_tampil_kar_=$acc->acc_tampil_kar($kar_id_);
                  $acc_data_=mysql_fetch_array($acc_tampil_kar_);
                  if($_GET['s']=="inbox"){
                    $kar_id_=$mlb_data['kar_id'];
                    $kar_tampil_id_ = $kar->kar_tampil_id($kar_id_);
                    $data_kar_ = mysql_fetch_array($kar_tampil_id_);
                    $jbt=$data_kar_['jbt_nm'];
                    $pop=$mlb_data['kar_nm'];
                    $id=$mlb_data['kar_id'];
                  }
                  if($_GET['s']=="sent"){
                    $kar_id_=$mlb_data['mlb_sub_tujuan'];
                    $kar_tampil_id_ = $kar->kar_tampil_id($kar_id_);
                    $data_kar_ = mysql_fetch_array($kar_tampil_id_);
                    $jbt=$data_kar_['jbt_nm'];
                    $pop=$data_kar_['kar_nm'];
                    $id=$data_kar_['kar_id'];
                  }
                }
              ?>
              <!--READ MAIL-->
              <div class="box box-primary">
                <div class="box-header with-border">
                  <h3 class="box-title">Read Mail</h3>
                  <div class="box-tools pull-right">
                    <!-- User Image -->
                      <a style="cursor: pointer" class="name" data-toggle="popover" title="<?php echo $pop; ?>" data-content="<center><img src='module/profile/img/<?php
                    if(!empty($acc_data_['acc_img'])){
                      echo $acc_data_['acc_img'];
                    }else{
                      echo "avatar.jpg";
                    }
                    ?>' class='img-circle img-popover' alt='User Image'/> <br><small><span class='label label-danger'><?php echo $jbt; ?></span> <span class='label label-primary'><?php echo $data_kar_['ktr_nm']; ?></span></small></center> <br> <a href='?p=data_profile&id=<?php echo $id;?>' class='btn btn-primary btn-flat btn-block'>Go to Profile</a> ">
                      <img src="module/profile/img/<?php
                      if(!empty($acc_data_['acc_img'])){
                        echo $acc_data_['acc_img'];
                      }else{
                        echo "avatar.jpg";
                      }
                      ?>" class="img-circle img-read" alt="User Image"/></a>&nbsp; 
                    <button class="btn btn-default btn-sm" data-toggle="tooltip" title="Print"><i class="fa fa-print"></i></button>
                  </div>
                </div><!-- /.box-header -->
                <div class="box-body no-padding">
                  <div class="mailbox-read-info">
                    <h3><?php echo $mlb_data['mlb_sbj']; ?></h3>
                    <h5>
                    <?php
                    if($_GET['s']=="inbox"){
                    ?>
                    From: <span class="label label-success"><?php echo $mlb_data['kar_nm']; ?></span>
                    <?php }elseif($_GET['s']=="sent"){?>
                    From: <span class="label label-default"><?php echo $mlb_data['kar_nm']; ?></span> 
                    To: <span class="label label-success"><?php echo $to; ?></span>
                    <?php }?> 
                    <span class="mailbox-read-time pull-right"><?php echo $tgl->tgl_indo($mlb_data['mlb_tgl'])." ".$mlb_data['mlb_jam']; ?></span></h5>
                  </div><!-- /.mailbox-read-info -->
                  <div class="mailbox-read-message">
                    <?php echo nl2br($mlb_data['mlb_msg']); ?>
                  </div><!-- /.mailbox-read-message -->
                </div><!-- /.box-body -->
                <div class="box-footer">
                  <ul class="mailbox-attachments clearfix">
                  <?php
                    if(!empty($mlb_data['mlb_atc'])){
                            $mlb_pecah=explode(".", $mlb_data['mlb_atc']);
                            $mlb_extend=$mlb_pecah[1];

                            if($mlb_extend == "pdf"){
                              $file = "<i class='fa fa-file-pdf-o'></i>";
                              $style="";
                            }elseif($mlb_extend == "doc" || $mlb_extend == "docx"){
                              $file = "<i class='fa fa-file-word-o'></i>";
                              $style="";
                            }elseif($mlb_extend == "xls" || $mlb_extend == "xlsx"){
                              $file = "<i class='fa fa-file-excel-o'></i>";
                              $style="";
                            }elseif($mlb_extend == "ppt" || $mlb_extend == "pptx"){
                              $file = "<i class='fa fa-file-powerpoint-o'></i>";
                              $style="";
                            }elseif($mlb_extend == "zip" || $mlb_extend == "rar"){
                              $file = "<i class='fa fa-file-archive-o'></i>";
                              $style="";
                            }else{
                              $file = "<img src='module/mailbox/atc/$mlb_data[mlb_atc]' alt='Attachment'/>";
                              $style="has-img";
                            }
                      
                   ?> 
                    <li>
                      <span class="mailbox-attachment-icon <?php echo $style;?>"><?php echo $file;?></span>
                      <div class="mailbox-attachment-info">
                        <a href="module/mailbox/atc/<?php echo $mlb_data['mlb_atc']; ?>" class="mailbox-attachment-name"><i class="fa fa-paperclip"></i> <?php echo $mlb_data['mlb_atc']; ?></a>
                        <span class="mailbox-attachment-size">
                          <?php echo $sze->size2Byte(filesize("module/mailbox/atc/$mlb_data[mlb_atc]")); ?>
                          <form action="download.php" method="post" enctype="multipart/form-data">
                            <input type="hidden" name="mlb_file" value="<?php echo $mlb_data['mlb_atc']; ?>">
                            <button type="submit" name="bmlb" class="btn btn-default btn-xs pull-right" title="Download"><i class="fa fa-cloud-download"></i></button>
                          </form>
                          <!--<a href="module/mailbox/atc/<?php //echo $mlb_data['mlb_atc']; ?>" class="btn btn-default btn-xs pull-right"><i class="fa fa-cloud-download"></i></a>-->
                        </span>
                      </div>
                    </li>
                    <?php }?>
                  </ul>
                </div><!-- /.box-footer -->
                <div class="box-footer">
                  <button class="btn btn-default"><i class="fa fa-print"></i> Print</button>
                </div><!-- /.box-footer -->
              </div><!-- /. box -->
              <?php }}?>

            </div><!-- /.col -->
          </div><!-- /.row -->
        </section><!-- /.content -->

<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header bg-primary">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel"><i class="fa fa-pencil-square-o"></i> Compose</h4>
      </div>
      <form class="form-horizontal" id="mailbox" action="" method="post" enctype="multipart/form-data">
      <div class="modal-body">
      <div class="form-group">
            <label for="mlb_tujuan" class="col-sm-2 control-label">Send to</label>
            <div class="col-sm-1">
              <input id="chosen_mlb_tujuan" type="checkbox" class="flat-red"/>
            </div>
            <div class="col-sm-4">
              <select class="form-control selectpicker" name="mlb_tujuan[]" id="mlb_tujuan" multiple data-live-search="true" data-live-search-style="begins" data-live-search-placeholder="Search" title="Divisi" data-selected-text-format="count>1">
                <?php
                $div_tampil=$div->div_tampil();
                foreach($div_tampil as $data){  
                ?>
                <option value="<?php echo $data['div_id']; ?>"><?php echo $data['div_nm']; ?></option>
                <?php }?>
              </select>
              </div>
              <div class="col-sm-5">
              <select class="form-control selectpicker" name="mlb_sub_tujuan[]" id="mlb_sub_tujuan"  required multiple data-live-search="true" data-live-search-placeholder="Search" title="Contact" data-actions-box="true" data-selected-text-format="count>1">
                <?php
                $div_tampil=$div->div_tampil();
                foreach($div_tampil as $data){  
                ?>
                <optgroup label="<strong><?php echo strtoupper($data['div_nm']); ?></strong>">
                  <?php
                  $div_id=$data['div_id'];
                  $kar_tampil_div=$kar->kar_tampil_div($div_id);
                  foreach($kar_tampil_div as $data){ 

                    $kar_id_acc=$data['kar_id'];
                    $acc_tampil_kar=$acc->acc_tampil_kar($kar_id_acc);
                    while($data=mysql_fetch_array($acc_tampil_kar)){ 
                      if($data['kar_id']!==$kar_data['kar_id']){
                  ?>
                  <option value="<?php echo $data['kar_id']; ?>"><?php echo $data['kar_nm']; ?></option>
                  <?php }}}?>
                </optgroup>
                <?php }?>
            </select>
            </div>
          </div>
          <div class="form-group">
            <label for="mlb_sbj" class="col-sm-2 control-label">Subject</label>
            <div class="col-sm-10">
              <input type="text" name="mlb_sbj" class="form-control" id="mlb_sbj" placeholder="Subject" required>
            </div>
          </div>
    <div class="form-group">
            <label for="mlb_msg" class="col-sm-2 control-label">Message</label>
            <div class="col-sm-10">
              <textarea name="mlb_msg" id="mlb_msg" class="form-control" rows="3"  placeholder="Message" style="width: 100%; height: 125px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;" required></textarea>
              <br>
              <div class="btn btn-default btn-file" id="file">
                    <i class="fa fa-paperclip"></i> Attachment
              </div>
                    <input type="file" name="mlb_atc"/>
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