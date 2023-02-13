<?php require('module/reward_karyawan/rwd_act.php'); ?>
<!-- Content Header (Page header) -->
    <section class="content-header">
      <h1> <?php echo $title;?> <small>Daily</small> </h1>
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
              <form class="form-inline" action="" method="post">
                  <div class="input-group">
                    <span class="input-group-btn">
		      <?php if(!empty($_SESSION['fday'])){?>
                      <button class="btn btn-danger btn-flat" type="submit" name="bclearday" title="Clear Filter"><i class="fa fa-close"></i></button>
		      <?php }else{?>
		      <button class="btn btn-default btn-flat" type="button" title="Filter"><i class="fa fa-calendar"></i></button>
		      <?php }?>
		    </span>
                    <input type="text" class="form-control dr" name="filter_day" id="filter_day" title="Filter" value="<?php if(!empty($_SESSION['fday'])){ echo $_SESSION['fday'];}else{ echo $f_daterange; }?>" placeholder="Day">
                    <span class="input-group-btn">
                      <button class="btn btn-default btn-flat" type="submit" name="bday"><i class="fa fa-search"></i></button>
                    </span>
                  </div>
		  <?php if($kar_data['kar_jdw_akses'] == "" ||
			   $kar_data['kar_jdw_akses'] == NULL){
		    
			  /*$exp_sync_date = explode(" ",$kar_data['kar_sync_date']);
			  if($exp_sync_date[0] == $date){
			    $disabled_sync = "disabled";
			  }else{
			    $disabled_sync = "";
			  }
			  */
			  $disabled_sync = "";
			  $admfield = false;
		  ?>
		  <div class="input-group">
		    <button class="btn btn-success btn-flat" type="button" id="btn_sinkronisasi_karyawan" <?php echo $disabled_sync;?>>Sinkronisasi</button>
		    <input type="hidden" id="nik" value="<?php echo $kar_data['kar_nik'];?>">
		  </div>
		  <?php }else{
			  $admfield = true;
		  }?>
                </form>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="tb_reward" class="table table-hover table-striped table-bordered nowrap" style="width:100%">
                <thead>
                  <tr>
                    <th rowspan="2" style="text-align: center; vertical-align: middle;">No</th>
                    <th rowspan="2" style="text-align: center; vertical-align: middle;">NIK</th>
                    <th rowspan="2" style="text-align: center; vertical-align: middle;">Nama</th>
                    <th rowspan="2" style="text-align: center; vertical-align: middle;">BDC</th>
                    <th colspan="6" style="text-align: center">JUMLAH PENCAPAIAN</th>
                    <!--<th rowspan="2" style="text-align: center; vertical-align: middle;">Nominal</th>-->
					<?php
						if($admfield){
							echo "<th class=\"admfield\" rowspan=\"2\" style=\"text-align: center; vertical-align: middle;\">&nbsp;</th>";
						}
					?>				  
				  </tr>
		  <tr>
		    <th style="text-align: center">Pendaftaran</th>
		    <th style="text-align: center">Non Her Registrasi</th>
		    <th style="text-align: center">Her Registrasi</th>
		    <th style="text-align: center">(%)Herregis</th>
		    <th style="text-align: center">Non Reward</th>
		    <th style="text-align: center">Reward</th>
		  </tr>
                </thead>
                <tbody>
		  <?php
		  $no=1;
		  foreach($dataArr1 as $key=>$val){

		    $exp_key = explode('#',$key);
		    $nik = $exp_key[0];
		    $nama = $exp_key[1];
		    
		    if($val['bdc'] > 0){
			    $rata2 = $val['bdc'] / $days;
			    $bdc_data = round($rata2, 0, PHP_ROUND_HALF_DOWN);
		    }else{
			    $bdc_data = 0;
		    }
		    
		    $pendaftaran_mhs = str_replace("'","",$val['pendaftaran_mhs']);
		    $herregis_mhs = str_replace("'","",$val['herregis_mhs']);
                    $noreward_mhs = str_replace("'","",$val['noreward_mhs']);
		    $reward_mhs = str_replace("'","",$val['reward_mhs']);
		    $noherregis_mhs = str_replace("'","",$val['noherregis_mhs']);
		    $niknya = str_replace(".","",$nik);
		    
		    $arr1 = array();
		    $split1 = $niknya.",";
		    $exp1 = explode($split1,$herregis_mhs);
		    for($i=0;$i<count($exp1);$i++){
                      $data = str_replace($niknya,"",$exp1[$i]);
		      $arr1[$data] = $data;
		    }
                    
                    $arr2 = array();
		    $split2 = $niknya.",";
		    $exp2 = explode($split2,$noreward_mhs);
		    for($i=0;$i<count($exp2);$i++){
                      $data = str_replace($niknya,"",$exp2[$i]);
		      $arr2[$data] = $data;
		    }
		    
		    $arr3 = array();
		    $split3 = $niknya.",";
		    $exp3 = explode($split3,$reward_mhs);
		    for($i=0;$i<count($exp3);$i++){
                      $data = str_replace($niknya,"",$exp3[$i]);
		      $arr3[$data] = $data;
		    }
		    
		    $arr4 = array();
		    $split4 = $niknya.",";
		    $exp4 = explode($split4,$noherregis_mhs);
		    for($i=0;$i<count($exp4);$i++){
                      $data = str_replace($niknya,"",$exp4[$i]);
		      $arr4[$data] = $data;
		    }
		    
                    $_comma = "";
                    $data_mhs = "";
		    $arr = array();
		    $split = $niknya.",";
		    $exp = explode($split,$pendaftaran_mhs);
		    for($i=0;$i<count($exp);$i++){
                      
                      $data = str_replace($niknya,"",$exp[$i]);
		      
		      if($arr1[$data] == $data){
			$hr = "YES";
		      }else{
                        $hr = "NO";
                      }
                      
                      if($arr2[$data] == $data){
			$nr = "YES";
		      }else{
                        $nr = "NO";
                      }
                      
		      if($arr3[$data] == $data){
			$rw = "YES";
		      }else{
                        $rw = "NO";
                      }
		      
		      if($arr4[$data] == $data){
			$nh = "YES";
		      }else{
                        $nh = "NO";
                      }
		      
                      $datanya = $data."#".$nh."#".$hr."#".$nr."#".$rw;
		      //$arr[$nik][] = $datanya;
                      if($_comma){
                          $data_mhs .= "|";
                      }
                      
                      $data_mhs .= $datanya;
                      $_comma = true;
		    }
		    
		    if($bdc_data < 50){
		      $btext_red = "text-red";
		    }else{
		      $btext_red = "";
		    }
		    
		    if($val['herregis'] < 25){
		      $text_red = "text-red";
		    }else{
		      $text_red = "";
		    }
		    
		    if($val['pendaftaran'] > 0 && $val['herregis'] > 0){
		      $persen_ = ($val['herregis'] / $val['pendaftaran']) * 100;
		      $persen_HR = round($persen_, 0, PHP_ROUND_HALF_DOWN);
		    }else{
		      $persen_HR = 0;
		    }
		    
		    if($val['reward'] >= 25){
		      $rumus =  $val['reward'] * 35000;
		      $nominal = number_format($rumus);
		    }else{
		      $nominal = "";
		    }
		    
                    //echo $data_mhs."<br>";
		    //echo "<pre>";
		    //print_r($arr);
		    //echo "</pre>";
			
			/*** Tombol sinkronisasi Per-Pegawai Untuk Admin***/
			if($admfield){
				$karnik_syn = $nik;
				$act_admin = " <button id=\"btn_".$karnik_syn."\" title=\"Sinkronisasi\" class=\"admfield btn btn-xs btn-success\" onclick=\"___synperkar_karyawan('".$karnik_syn."');\"><i class=\"fa fa-exchange\"></i></button>";
				/*$sql="SELECT DATE_FORMAT(kar_sync_date,'%Y-%m-%d') as kar_sync_date FROM  kar_master WHERE kar_nik='$nik' AND DATE_FORMAT(kar_sync_date,'%Y-%m-%d') = DATE_FORMAT(NOW(),'%Y-%m-%d') ";
				$query=mysql_query($sql) or die (mysql_error());
				while($row=mysql_fetch_array($query)){
					if(strlen($row['kar_sync_date']) && $row['kar_sync_date'] <> ""){
						$act_admin = "";
					}
				}*/
			}
			
			
		    
		  ?>
		  <tr>
		    <td><?php echo $no;?></td>
		    <td><?php echo $nik;?></td>
		    <td><a href="javascript:;"
			data-nama="<?php echo $nama;?>"
			data-source="<?php echo $data_mhs;?>"
			data-toggle="modal" data-target="#data_pencapaian" ><?php echo $nama;?></a></td>
		    <td style="text-align: right" class="<?php echo $btext_red;?>"><?php echo $bdc_data;?></td>
		    <td style="text-align: right"><a href="javascript:;"
                        data-action="Pendaftaran"
			data-nik="<?php echo $niknya;?>"
			data-nama="<?php echo $nama;?>"
			data-source="<?php echo $pendaftaran_mhs;?>"
			data-toggle="modal" data-target="#view_pencapaian" ><?php echo $val['pendaftaran'];?></a></td>
		    <td style="text-align: right"><a href="javascript:;"
                        data-action="Non Her Registrasi"
			data-nik="<?php echo $niknya;?>"
			data-nama="<?php echo $nama;?>"
			data-source="<?php echo $noherregis_mhs;?>"
			data-toggle="modal" data-target="#view_pencapaian" class="<?php echo $text_red;?>"><?php echo $val['noherregis'];?></a></td>
		    <td style="text-align: right"><a href="javascript:;"
                        data-action="Her Registrasi"
			data-nik="<?php echo $niknya;?>"
			data-nama="<?php echo $nama;?>"
			data-source="<?php echo $herregis_mhs;?>"
			data-toggle="modal" data-target="#view_pencapaian" class="<?php echo $text_red;?>"><?php echo $val['herregis'];?></a></td>
		    <td style="text-align: right"><?php echo $persen_HR;?>%</td>
		    <td style="text-align: right"><a href="javascript:;"
                        data-action="Non Reward"
			data-nik="<?php echo $niknya;?>"
			data-nama="<?php echo $nama;?>"
			data-source="<?php echo $noreward_mhs;?>"
			data-toggle="modal" data-target="#view_pencapaian" ><?php echo $val['noreward'];?></a></td>
		    <td style="text-align: right"><a href="javascript:;"
                        data-action="Reward"
			data-nik="<?php echo $niknya;?>"
			data-nama="<?php echo $nama;?>"
			data-source="<?php echo $reward_mhs;?>"
			data-toggle="modal" data-target="#view_pencapaian" ><?php echo $val['reward'];?></a></td>
		    <!--<td style="text-align: right"><?php //echo $nominal;?></td>-->
			<?php
			if($admfield){
				echo "<td class=\"admfield\" style=\"text-align: center\">".$act_admin."</td>";
			}
			?>
		  </tr>
		  <?php $no++; }?>
                </tbody>      
              </table>

            </div>
            <!-- /.box-body -->
	    <div class="box-footer">
	      <div class="alert alert-info">
                <h4><i class="icon fa fa-info"></i> Keterangan :</h4>
                1. Target Minimal Her Registrasi <strong>25 Mahasiswa Baru</strong> per bulan.<br>
		2. Terhitung Reward jika pencapaian Min. <strong>25 Mahasiswa Baru</strong> per bulan. <br>
		3. Syarat mendapatkan reward pencapaian <strong>BDC minimal 50 data</strong> per hari<br>
		<?php if($kar_data['kar_jdw_akses'] == "" ||
			   $kar_data['kar_jdw_akses'] == NULL){ ?>
		4. Klik tombol <span class="label label-success">Sinkronisasi</span> untuk update data terbaru H-1 per hari 1x klik. (Last Sync: <?php if($kar_data['kar_sync_date']!=="00-00-00 00:00:00"){ echo "<strong>".$kar_data['kar_sync_date']."</strong>"; }?>)
		<?php }?>
              </div>
	    </div>
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

<style>
.modal-dialog,
.modal-content {
    height: 80%;
}

.modal-body {
    max-height: calc(100% - 120px);
    overflow-y: scroll;
}

#loading{
      text-align: center;
      display: none;
      position: fixed;
      background-color: rgba(0, 0, 0, 0.3);
      z-index: 1000;
      left: 0;
      top: 0;
      height: 100%;
      width: 100%;
      padding-top:10%;
    }
    #output{
      font-size: 10px;
    }
</style>

    
<div id="loading"><img src="dist/img/loadingnew3.gif" /></div>

<div class="modal fade" id="data_pencapaian" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel"><i class="fa fa-users"></i> <span id="data_nama"></span> | All Pencapaian</strong> </h4>
      </div>
      <div class="modal-body" id="data_source">
          
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="view_pencapaian" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel"><i class="fa fa-users"></i> <span id="lbl_nama"></span> | Pencapaian <strong id="lbl_action"></strong> </h4>
      </div>
      <div class="modal-body" id="lbl_source">
	
      </div>
    </div>
  </div>
</div>