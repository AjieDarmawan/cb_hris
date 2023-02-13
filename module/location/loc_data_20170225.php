<!-- Content Header (Page header) -->
<section class="content-header">
  <h1> <?php echo $title;?> <small><?php echo $tgl->tgl_indo($date);?></small> </h1>
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
              <div class="form-group">
                <input autofocus="autofocus" class="form-control" placeholder='Search keyword, kampus, karyawan, etc' type="text" id="search-term" />
              </div>
             </div> 
          </div>

          <div class="row item-container">
          <?php
          $ip_tampil=$ip->ip_tampil();
          if($ip_tampil){
          foreach($ip_tampil as $data){
          if(($data['ktr_id']!=="44")&&($data['ktr_id']!=="23")&&($data['ktr_id']!=="22")&&($data['ktr_id']!=="51")&&($data['ktr_id']!=="11")&&($data['ktr_id']!=="20")&&($data['ktr_id']!=="28")&&($data['ktr_id']!=="26")&&($data['ktr_id']!=="34")&&($data['ktr_id']!=="70")){
            if($data['ip_release']==$date){
              $bg="bg-green";
            }else{
              $bg="bg-gray";
            }

              $location=$data['ktr_id'];
              $ktr_tampil_id_location=$ktr->ktr_tampil_id_location($location);
              $ktr_data_id_location=mysql_fetch_array($ktr_tampil_id_location);

              $ktr_id_=$ktr_data_id_location['ktr_id'];
              $unt_id_=$ktr_data_id_location['unt_id'];
              $kar_tampil_location=$kar->kar_tampil_location($ktr_id_,$unt_id_);

          ?>
           <div class="col-lg-2 col-xs-6 item">
              <!-- small box -->
              <div class="small-box <?php echo $bg; ?>" data-toggle="tooltip" title="<?php echo $data['ktr_nm']; ?>" style="cursor:pointer">
                <div class="inner">
                  <h4 style="padding:5px; background:rgba(0,0,0,0.1);"><?php echo $ktr_data_id_location['ktr_kd'];?></h4>
                  <p>
                  <?php
                  
                    while($kar_data_location=mysql_fetch_array($kar_tampil_location)){

                       $kar_id_=$kar_data_location['kar_id'];
                       $abs_tampil_kar_location=$abs->abs_tampil_kar_location($kar_id_,$date);
                       while($abs_data_kar_location=mysql_fetch_array($abs_tampil_kar_location)){

                          $kar_id=$abs_data_kar_location['kar_id'];
                          $kar_tampil_id=$kar->kar_tampil_id($kar_id);
                         
                          $kar_data_id=mysql_fetch_array($kar_tampil_id);
                          $kar_id_pos=$kar_data_id['kar_id'];
                          $acc_tampil_kar_pos=$acc->acc_tampil_kar($kar_id_pos);
                          $acc_data_pos=mysql_fetch_array($acc_tampil_kar_pos);
                       ?>
                          <span style="cursor: pointer" class="name" data-toggle="popover" title="<?php echo $kar_data_id['kar_nm']; ?>" data-content="<center><img onError='imgError(this);' src='module/profile/img/<?php echo $acc_data_pos['acc_img'];?>' class='img-circle img-popover' alt='User Image'/> <br><small><span class='label label-danger'><?php echo $kar_data_id['jbt_nm']; ?></span> <span class='label label-primary'><?php echo $kar_data_id['ktr_nm']; ?></span></small></center> <br> <a href='?p=data_profile&id=<?php echo $kar_data_id['kar_id'];?>' class='btn btn-primary btn-flat btn-block'>Go to Profile</a> ">
                          <img src="module/profile/img/<?php
                          if(!empty($acc_data_pos['acc_img'])){
                            echo $acc_data_pos['acc_img'];
                          }else{
                            echo "avatar.jpg";
                          }
                          ?>" class="img-circle border_white" alt="User Image" width="30"/>
                          <?php echo $kar_data_id['kar_nm']; ?>
                          </span>
                          <br>

                       <?php   
                          
                       }
                    }
                    
                  ?>
                  </p>
                </div>
                <a data-toggle="modal" data-target="#myModal<?php echo $ktr_data_id_location['ktr_id'];?>" class="small-box-footer">View <i class="fa fa-arrow-circle-right"></i></a>
              </div>
            </div><!-- ./col --> 

       
          <div class="modal fade" id="myModal<?php echo $ktr_data_id_location['ktr_id'];?>" role="dialog">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header bg-primary">
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                  <h4 class="modal-title"><?php echo $ktr_data_id_location['ktr_kd'];?></h4>
                </div>
                <div class="modal-body" id="hadir_overflow">
                  <table class="table table-bordered table-striped table-hover">
                          <thead>
                            <tr>
                              <th>NIK</th>
                              <th>Nama</th>
                              <th>Divisi</th>
                            </tr>
                          </thead>
                          <tbody>
                    <?php
                    $ktr_id_=$ktr_data_id_location['ktr_id'];
                    $unt_id_=$ktr_data_id_location['unt_id'];
                    $kar_tampil_location=$kar->kar_tampil_location($ktr_id_,$unt_id_);
                    while($kar_data_location=mysql_fetch_array($kar_tampil_location)){

                       $kar_id_=$kar_data_location['kar_id'];
                       $abs_tampil_kar_location=$abs->abs_tampil_kar_location($kar_id_,$date);
                       while($abs_data_kar_location=mysql_fetch_array($abs_tampil_kar_location)){

                          $kar_id=$abs_data_kar_location['kar_id'];
                          $kar_tampil_id=$kar->kar_tampil_id($kar_id);
                         
                          $kar_data_id=mysql_fetch_array($kar_tampil_id);
                    ?>      
                          <tr>
                              <td><?php echo $kar_data_id['kar_nik']; ?></td>
                              <td><?php echo $kar_data_id['kar_nm']; ?></td>
                              <td><?php echo $kar_data_id['div_nm']; ?></td>                     
                          </tr>
                  <?php        
                       }
                    }
                  ?>
                          </tbody>      
                          <tfoot>
                            <tr>
                              <th>NIK</th>
                              <th>Nama</th>
                              <th>Divisi</th>
                            </tr>
                          </tfoot>
                        </table>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                </div>
              </div>
            </div>
          </div>


           <?php }}}?>
            
          </div>

          
</section><!-- /.content -->  