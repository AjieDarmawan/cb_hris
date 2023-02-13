<?php require('module/unlistdomain/udo_act.php');?>

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

    

    <div class="col-md-4">



          <div class="box box-info">



            <div class="box-header">



              <h3 class="box-title">Type Domain</h3>



	      <!-- tools box -->



                  <div class="pull-right box-tools">



                    <a href="?p=unlist_domain"  class="btn btn-sm btn-default" data-toggle="tooltip" title="Back to Default"><i class="fa fa-refresh"></i></a>



                    <button class="btn btn-info btn-sm" data-widget='collapse' data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>



                    <button class="btn btn-info btn-sm" data-widget='remove' data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>



                  </div><!-- /. tools -->



	    </div>



            <!-- /.box-header -->



            <div class="box-body">



              



              <table id="tb_karyawan" class="table table-bordered table-striped table-hover">



                <thead>



                <tr>

  

                  <th>Kategori</th>

                  <th>Format</th>

  

                </tr>

  

              </thead>

  

              <tbody>

  

              <?php 

                  $tdo_tampil=$tdo->tdo_tampil();

                  while($data=mysql_fetch_assoc($tdo_tampil)){

                    

                    if($data['tdo_id']==$_GET['id']){



                        $block="danger";

            

                        $check="<i class='fa fa-check text-green'></i>";

            

                    }else{

            

                        $block="";

            

                        $check="";

            

                    } 

  

              ?>

  

                <tr class="<?php echo $block;?>">

  

                  <td><?php echo $check;?> <a href="?p=unlist_domain&id=<?php echo $data['tdo_id'];?>"><?php echo $data['tdo_nama'];?></a></td>

                  <td><?php echo $data['tdo_keterangan'];?></td>

                  

                </tr>

  

           <?php }?>

  

              </tbody>

  



              </table>







            </div>



            <!-- /.box-body -->



          </div>



          <!-- /.box -->







        </div>



        <!-- /.col -->

    

    <div class="col-md-8">

      <div class="box">

        <div class="box-header">

          <h3 class="box-title">

            <?php

            if(!empty($_GET['id'])){

              $tdo_id_=$id;

              $tdo_tampil_id=$tdo->tdo_tampil_id($tdo_id_);

              $tdo_data_id=mysql_fetch_assoc($tdo_tampil_id);

              echo $tdo_data_id['tdo_nama'];

            }else{

              echo"Type Domain Not Selected";

            }

            ?>

          </h3>

            <!-- tools box -->

            <div class="pull-right box-tools">

            <?php

            if(!empty($_GET['id'])){ 

            ?>

              <button style="cursor:pointer" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#tambahunlist"><i class="fa fa-plus"></i> Add <?php echo $tdo_data_id['tdo_nama'];?></button>

            <?php }?>

              <button class="btn btn-info btn-sm" data-widget='collapse' data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>

              <button class="btn btn-info btn-sm" data-widget='remove' data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>

            </div><!-- /. tools -->

        </div>

        <!-- /.box-header -->

        <div class="box-body">



        <table id="tb_unlist" class="table table-bordered table-striped table-hover">

            <thead>

              <tr>

                <th>URL</th>

                <th>Username</th>

                <th>Password</th>

                

                <?php if($_GET['id']=="1" || $_GET['id']=="2"){?>    

                <th>Server</th>

                <th>IP</th>

                <?php }?>

		

		<!--<th>PIC</th>-->

                

                <th>Aksi</th>

              </tr>

            </thead>

            <tbody>

              <?php

              if(!empty($_GET['id'])){

                $tdo_id_=$id;

                $udo_tampil_typ=$udo->udo_tampil_typ($tdo_id_);

                while($udo_data_typ=mysql_fetch_assoc($udo_tampil_typ)){

		  

		  $kar_id_=$udo_data_typ['kar_id'];

                  $kar_tampil_id_=$kar->kar_tampil_id($kar_id_);

                  $kar_data_=mysql_fetch_array($kar_tampil_id_);

		  

		  $kar_id_pos=$kar_data_['kar_id'];

	          $acc_tampil_kar_pos=$acc->acc_tampil_kar($kar_id_pos);

	          $acc_data_pos=mysql_fetch_array($acc_tampil_kar_pos);

                  

              ?>

              <tr>

                <td><a href="http://<?php echo $udo_data_typ['udo_nama']; ?>" target="_blank"><?php echo $udo_data_typ['udo_nama']; ?></a></td>

                <td><?php echo $udo_data_typ['udo_username']; ?></td>

                <td class="text-blue"><?php echo $udo_data_typ['udo_password']; ?></td>

                

                <?php if($_GET['id']=="1" || $_GET['id']=="2"){?>    

                <td><?php echo $udo_data_typ['udo_server'];?></td>

                <td><?php echo $udo_data_typ['udo_ip'];?></td>

                <?php }?>

		

		<!--<td>

		    <a style="cursor: pointer" class="name" data-toggle="popover" title="<?php echo $kar_data_['kar_nm']; ?>" data-content="<center><img src='module/profile/img/<?php

                    if(!empty($acc_data_pos['acc_img'])){

                      echo $acc_data_pos['acc_img'];

                    }else{

                      echo "avatar.jpg";

                    }

                    ?>' class='img-circle img-popover' alt='User Image'/> <br><small><span class='label label-danger'><?php echo $kar_data_['jbt_nm']; ?></span> <span class='label label-primary'><?php echo $kar_data_['ktr_nm']; ?></span></small></center> <br> <a href='?p=data_profile&id=<?php echo $kar_data_['kar_id'];?>' class='btn btn-primary btn-flat btn-block'>Go to Profile</a> "><?php echo $kar_data_['kar_nm']; ?></a>

		</td>-->

                

                <td>

                <a href="javascript:;"

                  data-udoid="<?php echo $udo_data_typ['udo_id'];?>"

                  data-udonama="<?php echo $udo_data_typ['udo_nama'];?>"

                  data-udousername="<?php echo $udo_data_typ['udo_username'];?>"

                  data-udopassword="<?php echo $udo_data_typ['udo_password'];?>" 

                  data-udoserver="<?php echo $udo_data_typ['udo_server'];?>"  

                  data-udoip="<?php echo $udo_data_typ['udo_ip'];?>"  

                  data-udoketerangan="<?php echo $udo_data_typ['udo_keterangan'];?>"  data-toggle="modal" data-target="#editunlist" title="Edit Unlist Domain"><i class="fa fa-pencil"></i></a>&nbsp;&nbsp;&nbsp;

                  <!--<a href="#block-confirm" data-toggle="modal" data-data="<h4>Yakin Hapus <strong><?php echo $udo_data_typ['udo_nama'];?></strong>?</h4>" data-url="?p=unlist_domain&act=hapus&id_=<?php echo $udo_data_typ['udo_id'];?>"><i class="fa fa-trash"></i></a>-->

                  <a href="#delete-confirm" data-toggle="modal" data-data="<?php echo $udo_data_typ['udo_nama'];?>" data-url="?p=unlist_domain&act=hapus&id_=<?php echo $udo_data_typ['udo_id'];?>"><i class="fa fa-trash"></i></a>

                </td>

              </tr>

            <?php }}?> 

            </tbody>      

            <tfoot>

              <tr>

                <th>URL</th>

                <th>Username</th>

                <th>Password</th>

                

                <?php if($_GET['id']=="1" || $_GET['id']=="2"){?>    

                <th>Server</th>

                <th>IP</th>

                <?php }?>

		

		<!--<th>PIC</th>-->

                

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





<!-- Modal Input Unlist -->

<div class="modal fade" id="tambahunlist" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">

  <div class="modal-dialog modal-lg">

    <div class="modal-content">

      <div class="modal-header bg-primary">

        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>

        <h4 class="modal-title" id="myModalLabel"><i class="fa fa-share-alt"></i> Add <?php echo $tdo_data_id['tdo_nama'];?></h4>

      </div>

      <form class="form-inline" action="" method="post">

      <div class="modal-body">

        

        <div class="row">

            <div class="col-sm-12">

              

              <div class="field_domain">

               <input type="hidden" id="typdom" value="<?php echo $_GET['id'];?>">

	       <?php

	       if($_GET['id']=="1" || $_GET['id']=="2"){

		  $disabled="";

	       }else{

		  $disabled="disabled";

	       }

	       ?>   

                <div class="form-group">

                     <div class="addlist">   

                          <input type="text" name="udo_nama[]" class="form-control" id="udo_nama" value="" placeholder="Domain Name" required>

                          <input type="text" name="udo_username[]" class="form-control" id="udo_username" value="" placeholder="Username" required>

                          <input type="text" name="udo_password[]" class="form-control" id="udo_password" value="" placeholder="Password" required>

			  <br>

			  <input type="text" name="udo_server[]" class="form-control" id="udo_server" value="" placeholder="Server" required <?php echo $disabled;?>>

			  <input type="text" name="udo_ip[]" class="form-control" id="udo_ip" value="" placeholder="IP Address" required <?php echo $disabled;?>>

			  <input type="text" name="udo_keterangan[]" class="form-control" id="udo_keterangan" value="" placeholder="Keterangan" required>&nbsp;

                          <a href="javascript:void(0);" class="add_domain text-blue" title="Add Field" style="float: right;"><i class="fa fa-plus"></i> <em>add</em></a>

		     </div>  

                </div>

              </div> 

               

                

            </div>



        </div>

      </div>

      <div class="modal-footer">

        <button type="submit" name="binputdomain" class="btn btn-primary"><i class="fa fa-save"></i> SAVE</button>

      </div>

      </form>

    </div>

  </div>

</div>





<!--Modal editunlist-->

<div class="modal fade" id="editunlist" role="dialog">

  <div class="modal-dialog">

    <div class="modal-content">

      <div class="modal-header bg-primary">

        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>

        <h4 class="modal-title">Edit Unlist Domain</h4>

      </div>

      <form class="form-horizontal" action="" method="post" enctype="multipart/form-data">

      <input type="hidden" name="udo_id" id="udo_id">

        <div class="modal-body">

            <div class="form-group">

              <label for="udo_nama" class="col-sm-2 control-label">URL</label>

              <div class="col-sm-10">

                <input type="text" name="udo_nama" class="form-control" id="udo_nama" value="" placeholder="URL" required>

              </div>

            </div>

            <div class="form-group">

              <label for="udo_username" class="col-sm-2 control-label">Username</label>

              <div class="col-sm-10">

                <input type="text" name="udo_username" class="form-control" id="udo_username" value="" placeholder="Username" required>

              </div>

            </div>

            <div class="form-group">

              <label for="udo_password" class="col-sm-2 control-label">Password</label>

              <div class="col-sm-10">

                <input type="text" name="udo_password" class="form-control" id="udo_password" value="" placeholder="Password" required>

              </div>

            </div>

            <div class="form-group">

              <label for="udo_server" class="col-sm-2 control-label">Server</label>

              <div class="col-sm-10">

                <input type="text" name="udo_server" class="form-control" id="udo_server" value="" placeholder="Server" required>

              </div>

            </div>

            <div class="form-group">

              <label for="udo_ip" class="col-sm-2 control-label">Ip</label>

              <div class="col-sm-10">

                <input type="text" name="udo_ip" class="form-control" id="udo_ip" value="" placeholder="Ip" required>

              </div>

            </div>

            <div class="form-group">

              <label for="udo_keterangan" class="col-sm-2 control-label">Keterangan</label>

              <div class="col-sm-10">

                <input type="text" name="udo_keterangan" class="form-control" id="udo_keterangan" value="" placeholder="Keterangan" required>

              </div>

            </div>

          </div>

        <div class="modal-footer">

          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

          <button type="submit" name="bupdateunlist" class="btn btn-primary">Save changes</button>

        </div>

        </form>

    </div><!-- /.modal-content -->

  </div><!-- /.modal-dialog -->

</div><!-- /.modal -->









