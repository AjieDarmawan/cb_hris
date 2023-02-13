<?php
 error_reporting(0);
?>

<!-- general form elements -->
              <div class="box box-danger" data-step="3" 
              data-intro="<strong>History Absen</strong> Merupakan aktifitas Record data absensi masuk dan pulang dari semua karyawan 
              			  <strong>Gilland Group</strong>, Nah jadi bagi karyawan yang suka terlambat akan terpampang disini dengan 
              			  di beri tanda <strong>Red Block</strong>, jadi diusahakan datang tepat waktu dan pulang pada waktunya.">
                <form action="" method="post">
				<div class="box-header">
                  <h3 class="box-title">History Absen <small><?php echo $tgl->tgl_indo($date);?></small></h3>
                  <!-- tools box -->				  
                  <div class="pull-right box-tools">
				  <?php
					if(($kar_data['kar_id']=="255")||($kar_data['kar_id']=="430")){
				  ?>
					<?php
						if(isset($_POST['skode'])){						
							echo"<button class='btn btn-default btn-sm' type='submit' name='closes'>Non Aktif mode Freelance</button>";
						}else{
							echo"<button class='btn btn-success btn-sm' type='submit' name='skode'>Aktifkan mode Freelance</button>";
						}
					?>
					
					<!--<button class="btn btn-default btn-sm">Non Aktif mode Freelance</button>-->
				  <?php }?>				  
                    <button class="btn btn-info btn-sm" data-widget='collapse' data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
                    <button class="btn btn-info btn-sm" data-widget='remove' data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
                  </div><!-- /. tools -->				  
                </div><!-- /.box-header -->
				</form>
                  <div class="box-body table-responsive no-padding" id="history-absen-box"><!-- id="history-absen-box" -->
                    <table class="table table-hover">
		    <br>  
                    <?php

					$abs_tgl_masuk=$date;
					if(isset($_POST['skode'])){
						$abs_tampil_tgl_masuk=$abf->abs_tampil_tgl_masuk($abs_tgl_masuk);
						$abs_tampil_tgl_pulang=$abf->abs_tampil_tgl_pulang($abs_tgl_masuk);
					}else{
						$abs_tampil_tgl_masuk=$abs->abs_tampil_tgl_masuk($abs_tgl_masuk);
						$abs_tampil_tgl_pulang=$abs->abs_tampil_tgl_pulang($abs_tgl_masuk);
					}
					
					$abs_cek_masuk=mysql_num_rows($abs_tampil_tgl_masuk);
					$abs_cek_pulang=mysql_num_rows($abs_tampil_tgl_pulang);
					
					foreach($hisabsensi as $data){
					  if($data['abs_sts']=="M"){
					    if(!empty($data['abs_alasan_masuk'])){
					      $alasan=$data['abs_alasan_masuk'];
					    }else{
					      $alasan="-";
					    }
					  }else{
					    if(!empty($data['abs_alasan_pulang'])){
					      $alasan=$data['abs_alasan_pulang'];
					    }else{
					      $alasan="-";
					    }
					  }
						
						$kar_id_abs=$data['kar_id'];
						if(isset($_POST['skode'])){
							$kar_tampil_id_abs=$fln->kar_tampil_id($kar_id_abs);
						}else{
							$kar_tampil_id_abs=$kar->kar_tampil_id($kar_id_abs);
						}
						
						$kar_data_abs=mysql_fetch_array($kar_tampil_id_abs);
						
						if($data['abs_sts']=="P"){
							$sts="Pulang";
							$lbl="danger";
							$pulang=$data['abs_pulang'];
							$tgl_absen=$tgl->tgl_indo($data['abs_tgl_pulang']);
						}else{
							$sts="Masuk";
							$lbl="success";
							$pulang="-";
							$tgl_absen=$tgl->tgl_indo($data['abs_tgl_masuk']);
							
							if($data['abs_rwd_masuk']=="Telat"){
							  $block="danger";
							}elseif($data['abs_rwd_masuk']=="Rajin"){
							  $block="";
							}
							elseif($data['abs_rwd_masuk']=="Tepat"){
							  $block="";
							}
						}

						$kar_id_pos=$data['kar_id'];
						if(isset($_POST['skode'])){
							$acc_tampil_kar_pos=$afl->acc_tampil_kar($kar_id_pos);
						}else{
							$acc_tampil_kar_pos=$acc->acc_tampil_kar($kar_id_pos);
							
						}	                    
	                    $acc_data_pos=mysql_fetch_array($acc_tampil_kar_pos);
					?>	
                    <tr class="<?php echo $block;?>">
                      <td><?php echo $data['abs_masuk']; ?></td>
                      <td><?php echo $pulang; ?></td>
                      <td>
                      	<a style="cursor: pointer" class="name" data-toggle="popover" title="<?php echo $kar_data_abs['kar_nm']; ?>" data-content="<center><img src='module/profile/img/<?php
                    if(!empty($acc_data_pos['acc_img'])){
                      echo $acc_data_pos['acc_img'];
                    }else{
                      echo "avatar.jpg";
                    }
                    ?>' class='img-circle img-popover' alt='User Image'/> <br><small><span class='label label-danger'><?php echo $kar_data_abs['jbt_nm']; ?></span> <span class='label label-primary'><?php echo $kar_data_abs['ktr_nm']; ?></span></small></center> <br> <a href='?p=data_profile&id=<?php echo $data['kar_id'];?>' class='btn btn-primary btn-flat btn-block'>Go to Profile</a> "><?php echo $kar_data_abs['kar_nm']; ?></a>
                      </td>
		      <!--<td><span class="label label-default"><?php //echo str_replace('Shift','',$data['abs_shift']); ?></span></td>-->
                      <td><?php echo $kar_data_abs['ktr_kd']; ?><?php //echo $tgl_absen; ?></td>
                      <td><span class="label label-<?php echo $lbl; ?>"><?php echo $sts; ?></span></td>
                      <td><span data-toggle="tooltip" data-placement="left" title="<?php echo $alasan; ?>" style="cursor:pointer">... <i class="fa fa-external-link"></i></span></td>
                    </tr>
                    <?php }?>
                  </table>
                  </div><!-- /.box-body -->

                  <div class="box-footer">
                    <small>Total Karyawan Masuk:</small> <?php echo $abs_cek_masuk;?> orang<br>
                    <small>Total Karyawan Pulang:</small> <?php echo $abs_cek_pulang;?> orang
                  </div>
              </div><!-- /.box -->