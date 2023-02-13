<?php require('module/absen/abs_act_magang.php'); ?>
<!-- Content Header (Page header) -->
<section class="content-header">
  <h1> <?php echo $title;?> 
  <small>
    <?php 
        echo $tgl->tgl_indo($abs_tgl_masuk);
    ?>
  </small> 
  </h1>
  <ol class="breadcrumb">
    <li><a href="media.php"><i class="fa fa-dashboard"></i> Dashboard</a></li>
    <li><a href="?p=history_absen">Data Absen</a></li>
    <li class="active"><?php echo $title;?> </li>
  </ol>
</section>
    
<!-- Main content -->
<section class="content"> 
  
  <!-- Your Page Content Here -->                 
  <div class="row">
    <div class="col-xs-12">
      <div class="box">
          <div class="box-header">
		  <!--
            <h3 class="box-title">
              <button class="btn btn-md btn-primary" data-toggle="modal" data-target="#masukmanual" ><i class="fa fa-sign-in"></i> Manual Absen Masuk</button> &nbsp;
              <i class="fa fa-child"></i> &nbsp;
              <button class="btn btn-md btn-danger" data-toggle="modal" data-target="#pulangmanual" ><i class="fa fa-sign-out"></i> Manual Absen Pulang</button> &nbsp;
            </h3>
		  -->
            <div class="pull-right">
              <form class="form-inline" method="post" action="">
                <div class="form-group">
                  <a href="#"  class="btn btn-md btn-default"><i class="fa fa-print"></i></a>
                </div>
                
                <div class="input-group">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                  <input type="text" name="tanggal_absen_history" class="form-control pull-right" placeholder="Sortir Absensi" id="dpdays" readonly />
                </div>

                <div class="form-group">
                  <button type="submit" name="bsortir_history" class="btn btn-md btn-default"><i class="fa fa-eye"></i> View</a></button>
                </div>

                <div class="form-group">
                  <button type="submit" name="brefresh_history" data-toggle="tooltip"  class="btn btn-md btn-default" title="Kembali ke default <?php echo $tgl->tgl_indo($date); ?>"><i class="fa fa-refresh"></i></button>
                </div>
              </form>
            </div>
          </div>
          <!-- /.box-header -->

          <div class="box-body">
            <table id="tb_history_absen" class="table table-bordered table-striped table-hover">
              <thead>
                <tr>
                    <th rowspan="2">Nama</th>
	                  <th rowspan="2">Shift</th>
                    <th colspan="4" class="success">Masuk</th>
                    <th colspan="4" class="danger">Pulang</th>
                    <th colspan="2">IP</th>
                    <!--<th rowspan="2">Lokasi</th>-->
                  	<th rowspan="2">Durasi Kerja</th>
                  	<th rowspan="2">Point</th>
                    <th rowspan="2">Status</th>
                  </tr>
                  <tr>
                    <th class="success">Waktu</th>
                    <th class="success">Tgl</th>
                    <th class="success">Reward</th>
                    <th class="success">Alasan</th>
                    <th class="danger">Waktu</th>
                    <th class="danger">Tgl</th>
                    <th class="danger">Reward</th>
                    <th class="danger">Alasan</th>
                    <th>IP Pusat</th>
                    <th>IP Lain</th>
                  </tr>
              </thead>
              <tbody>
                <?php
                    $abs_tampil_tgl=$abf->abs_tampil_tgl($abs_tgl_masuk);
                    while($data=mysql_fetch_array($abs_tampil_tgl)){
		      
		    $id_karyawan_arr[] = $data['kar_id'];

                    $kar_id_abs=$data['kar_id'];
                    $kar_tampil_id_fl=$fln->kar_tampil_id_fl($kar_id_abs);
                    $kar_data_abs=mysql_fetch_array($kar_tampil_id_fl);
                    
                    $unt_id=$kar_data_abs['unt_id'];
                    $ktr_id=$kar_data_abs['ktr_id'];
                        
                        $ip_tampil_unt_ktr=$ip->ip_tampil_unt_ktr($unt_id,$ktr_id);
                        $ip_data=mysql_fetch_array($ip_tampil_unt_ktr);
                    
                        if($data['abs_sts']=="P"){
                          $pulang=$data['abs_pulang'];
                          $tgl_pulang=$tgl->tgl_indo($data['abs_tgl_pulang']);

                          $start_date = new DateTime(''.$data[abs_tgl_masuk].' '.$data[abs_masuk].'');
                            $since_start = $start_date->diff(new DateTime(''.$data[abs_tgl_pulang].' '.$data[abs_pulang].''));
                          $durasi_kerja = $since_start->h." Jam, ".$since_start->i." Menit ";
                        }else{
                          $pulang="-";
                          $tgl_pulang="-";
                          $durasi_kerja ="-";
                        }
                      
                        if($data['abs_rwd_masuk']=="Telat"){
                          $lbl_masuk="danger";
                        }elseif($data['abs_rwd_masuk']=="Rajin"){
                          $lbl_masuk="success";
                        }elseif($data['abs_rwd_masuk']=="Tepat"){
                          $lbl_masuk="primary";
                        }
                      
                        if($data['abs_rwd_pulang']=="Izin"){
                          $lbl_pulang="danger";
                        }elseif($data['abs_rwd_pulang']=="Loyal"){
                          $lbl_pulang="success";
                        }elseif($data['abs_rwd_pulang']=="Tepat"){
                          $lbl_pulang="primary";
                        }
	    
                  	    if($ip_data['ip_nm']==$data['abs_ip']){
                  	      $konfirm="<span class='label label-default'>Success</span>";
                  	    }else{
                  	      $konfirm="<a href='?p=history_absen&id=$data[abs_id]&ip=$ip_data[ip_nm]'><span class='label label-primary'>Konfirm</span></a>";
                  	    }
                  	    
                  	    if($data['abs_point']=="30"){
                  	      $point="<a data-placement='top' data-toggle='tooltip' title='Klik untuk merubah point menjadi (50) jika alasan keterlambatan dapat diterima secara jelas' href='?p=history_absen&id=$data[abs_id]&point=50'>$data[abs_point]</a>";
                  	    }else{
                  	      $point="$data[abs_point]";
                  	    }
                                        
                ?>
                <tr>
                    <td><?php echo $kar_data_abs['kar_nm']; ?></td>
	                  <td><span class="label label-default"><?php echo str_replace('Shift','',$data['abs_shift']); ?></span></td>
                    <td class="success">
		      <a href="javascript:;"
			  data-absid="<?php echo $data['abs_id']; ?>"
			  data-absmasuk="<?php echo $data['abs_masuk']; ?>"
			  data-karnm="<?php echo $kar_data_abs['kar_nm']; ?>" data-toggle="modal" data-target="#jam_abs_masuk_edt"><?php echo $data['abs_masuk']; ?></a>
		      
		    </td>
                    <td class="success"><?php echo $tgl->tgl_indo($data['abs_tgl_masuk']); ?></td>
                    <td class="success"><span class="label label-<?php echo $lbl_masuk; ?>"><?php echo $data['abs_rwd_masuk']; ?></span></td>
                    <td class="success"><span data-toggle="tooltip" title="<?php echo $data['abs_alasan_masuk']; ?>" style="cursor:pointer">... <i class="fa fa-external-link"></i></span></td>
                    <td class="danger"><?php echo $pulang; ?></td>
                    <td class="danger"><?php echo $tgl_pulang; ?></td>
                    <?php
                    if($data[abs_sts]=="P"){
                    ?>
                    <td class="danger"><span class="label label-<?php echo $lbl_pulang; ?>"><?php echo $data['abs_rwd_pulang']; ?></td>
                    <td class="danger"><span data-toggle="tooltip" title="<?php echo $data['abs_alasan_pulang']; ?>" style="cursor:pointer">... <i class="fa fa-external-link"></i></span></td>
                    <?php
                    }else{
                    ?>
                    <td class="danger">-</td><td class="danger">-</td>
                    <?php }?>
                    <td><?php echo $ip_data['ip_nm']; ?><br><a data-placement="right" data-toggle="tooltip" title="<?php echo $kar_data_abs['ktr_nm']; ?>" style="cursor:pointer"><?php echo $kar_data_abs['ktr_kd']; ?></a></td>
                    <td><?php echo $data['abs_ip']; ?></td>
                    <!--<td><a data-toggle="tooltip" title="<?php //echo $kar_data_abs['ktr_nm']; ?>" style="cursor:pointer"><?php //echo $kar_data_abs['ktr_kd']; ?></a></td>-->
                    <td><?php echo $durasi_kerja; ?></td>
                  	<td><?php echo $point; ?></td>
                  	<td><?php echo $konfirm; ?></td>
                  </tr>  

                <?php }?>  
              </tbody>      
              <tfoot>
                  <tr>
	                  <th rowspan="2">Shift</th>
                    <th rowspan="2">Nama</th>
                    <th class="success">Waktu</th>
                    <th class="success">Tgl</th>
                    <th class="success">Reward</th>
                    <th class="success">Alasan</th>
                    <th class="danger">Waktu</th>
                    <th class="danger">Tgl</th>
                    <th class="danger">Reward</th>
                    <th class="danger">Alasan</th>
                    <th>IP Pusat</th>
                    <th>IP Lain</th>
                    <!--<th rowspan="2">Lokasi</th>-->
                  	<th rowspan="2">Durasi Kerja</th>
                  	<th rowspan="2">Point</th>
                    <th rowspan="2">Status</th>
                  </tr>
                  <tr>
                    <th colspan="4" class="success">Masuk</th>
                    <th colspan="4" class="danger">Pulang</th>
                    <th colspan="2">IP</th>
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

<!-- ===========================DATA KOMULATIF=========================== -->



 
  
  <!--
  <div class="col-lg-2 col-xs-4">   
    <div class="small-box bg-gray">
      <div class="inner">
        <?php
        $id_karyawan=implode("|",$id_karyawan_arr);
        $kar_tampil_libur=$kar->kar_tampil_libur($id_karyawan);
        $kar_cek_libur=mysql_num_rows($kar_tampil_libur);
        if($kar_cek_libur > 0){
          $modal="modal";
        }else{
          $modal="";
        }
        ?>
        <h3><?php echo $kar_cek_libur;?></h3>
        <p>Libur</p>
      </div>
      <div class="icon">
        <i class="fa fa-user-times"></i>
      </div>
      <a style="cursor:pointer;" data-toggle="<?php echo $modal;?>" data-target="#libur_modal" class="small-box-footer">
        More info <i class="fa fa-arrow-circle-right"></i>
      </a>
    </div>
  </div>
  -->
<?php
$attr_jdw = array();
$attr_jdw_ct = array();
$datenya=date("d");
//echo $datenya;
$jdw_blnthn = "092020";
$bulannya = substr($jdw_blnthn, 0,2);
$tahunnya = substr($jdw_blnthn, -4);
$thnbln = $tahunnya."-".$bulannya;
$datemax=$thnbln."-01";
$maxDays = date("t", strtotime($datemax));

$jdw_tampil_jie=$jdw->jdw_tampil_jie($jdw_blnthn);
while($jdw_data=mysql_fetch_assoc($jdw_tampil_jie)){       

	$jdw_blnthn = $jdw_data['jdw_blnthn'];
	$jdw_nik = $jdw_data['jdw_nik'];	
	$jdw_nama = $jdw_data['jdw_nama'];	
						
	$exp_data = explode('#',$jdw_data['jdw_data']);
	for($d=0;$d<=$maxDays-1;$d++){ 
		$day = $d + 1;		
		$pos_GL = strpos($exp_data[$d],'GL-');
		if($day==$datenya && ($exp_data[$d]=="L" || $pos_GL!==false ||$exp_data[$d]=="LN")){
			/* BIAR BAGUS AJA URUTANNYA */
			if(isset($attr_jdw[$day]['sumlist']) === false) {
				$attr_jdw[$day]['sumlist'] = array();
				$attr_jdw[$day]['sumtotal'] = 0;
				$attr_jdw[$day]['detaildata'] = array();
			}
			
			
			$attr_jdw[$day]['detaildata'][$exp_data[$d]]['detail'][$jdw_nik]['nik'] = $jdw_nik;
			$attr_jdw[$day]['detaildata'][$exp_data[$d]]['detail'][$jdw_nik]['nikr'] = @implode("", @explode(".", $jdw_nik));
			$attr_jdw[$day]['detaildata'][$exp_data[$d]]['detail'][$jdw_nik]['nama'] = $jdw_nama;			
			$attr_jdw[$day]['detaildata'][$exp_data[$d]]['detail'][$jdw_nik]['jadwalnya'] = $exp_data[$d];			
			$attr_jdw[$day]['detaildata'][$exp_data[$d]]['sumdata'] = count($attr_jdw[$day]['detaildata'][$exp_data[$d]]['detail']);

			$attr_jdw[$day]['sumlist'][$exp_data[$d]] = count($attr_jdw[$day]['detaildata'][$exp_data[$d]]['detail']);
			$attr_jdw[$day]['sumtotal'] = array_sum($attr_jdw[$day]['sumlist']);
			
		}
		$pos_C = strpos($exp_data[$d],'C-');
			if($day==$datenya && $pos_C!==false){
			/* BIAR BAGUS AJA URUTANNYA */
			if(isset($attr_jdw_ct[$day]['sumlist']) === false) {
				$attr_jdw_ct[$day]['sumlist'] = array();
				$attr_jdw_ct[$day]['sumtotal'] = 0;
				$attr_jdw_ct[$day]['detaildata'] = array();
			}
			
			
			$attr_jdw_ct[$day]['detaildata'][$exp_data[$d]]['detail'][$jdw_nik]['nik'] = $jdw_nik;
			$attr_jdw_ct[$day]['detaildata'][$exp_data[$d]]['detail'][$jdw_nik]['nikr'] = @implode("", @explode(".", $jdw_nik));
			$attr_jdw_ct[$day]['detaildata'][$exp_data[$d]]['detail'][$jdw_nik]['nama'] = $jdw_nama;			
			$attr_jdw_ct[$day]['detaildata'][$exp_data[$d]]['detail'][$jdw_nik]['jadwalnya'] = $exp_data[$d];			
			$attr_jdw_ct[$day]['detaildata'][$exp_data[$d]]['sumdata'] = count($attr_jdw_ct[$day]['detaildata'][$exp_data[$d]]['detail']);

			$attr_jdw_ct[$day]['sumlist'][$exp_data[$d]] = count($attr_jdw_ct[$day]['detaildata'][$exp_data[$d]]['detail']);
			$attr_jdw_ct[$day]['sumtotal'] = array_sum($attr_jdw_ct[$day]['sumlist']);
			
		}
	 
	}   
}
//$jumlahlibur=0;
$kar_libur = array();
foreach($attr_jdw as $value1){
	
	foreach($value1 as $k => $value2){
		
		foreach($value2 as $k1 => $value3){
			
		  foreach($value3 as $k2 => $value4){
			  
		    foreach($value4 as $k3 => $value5){
				
				  $rowlistlistmodal .= "<tr class='success'>";
				  $rowlistlistmodal .= "<td>".$value5['nik']."</td>";						  
				  $rowlistlistmodal .= "<td>".$value5['nama']."</td>";						  
				  $rowlistlistmodal .= "</tr>";
				// echo "<pre>";
				// print_r($value5);
				// echo "</pre>";
				$kar_libur[$value5['nik']] = $value5['nik'];
				
			}			  
			 
		  }
			
		}

	}
	$jumlahlibur .= $value1['sumtotal'];
}

$tidak_absen = '';
$abs_abs=$abs->abs_abs($abs_tgl_masuk);							  
while($abs_data_noabs=mysql_fetch_array($abs_abs)){
	
	@reset($kar_libur);
	if(isset($kar_libur[$abs_data_noabs['kar_nik']])) {
		/* LEWATIN BOSS */
	} else {
		$tidak_absen .= '<tr>';
		$tidak_absen .= '<td>'.$abs_data_noabs['kar_nik'].'</td>';
		$tidak_absen .= '<td>'.$abs_data_noabs['kar_nm'].'</td>';
		$tidak_absen .= '<tr>';
	}
}


$jumlahcuti=0;
foreach($attr_jdw_ct as $value1){
	
	foreach($value1 as $k => $value2){
		
		foreach($value2 as $k1 => $value3){
			
		  foreach($value3 as $k2 => $value4){
			  
		    foreach($value4 as $k3 => $value5){
				
				  $rowlistlistmodal_cuti .= "<tr class='success'>";
				  $rowlistlistmodal_cuti .= "<td>".$value5['nik']."</td>";						  
				  $rowlistlistmodal_cuti .= "<td>".$value5['nama']."</td>";						  
				  $rowlistlistmodal_cuti .= "</tr>";
				// echo "<pre>";
				// print_r($value5);
				// echo "</pre>";
				
			}			  
			 
		  }
			
		}

	}
	$jumlahcuti .= $value1['sumtotal'];
}
//echo "<pre>". print_r($attr_jdw,1) ."</pre>";
/*echo "<pre>";
print_r($summaryArr);
echo "</pre>";*/
?>
 
  
  
</div><!-- /.row -->

</section>
<!-- /.content --> 


<!-- ===========================MODAL========================= --> 

               


<!-- Manual Masuk -->
<div class="modal fade" id="masukmanual" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header bg-primary">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel"><i class="fa fa-sign-in"></i> Manual <strong>Absen Masuk</strong></h4>
      </div>
      <form class="form-horizontal" action="" method="post">
      <div class="modal-body">

          <div class="form-group">
            <label for="kar_id" class="col-sm-2 control-label">Karyawan</label>
            <div class="col-sm-10">
              <div class="bfh-selectbox" data-name="kar_id" data-value="" data-filter="true">
              <div data-value=""></div>
              <?php
                  $kar_tampil_2=$kar->kar_tampil_filter_2();
                  if($kar_tampil_2){
                  foreach($kar_tampil_2 as $data){  
                    /*
                    $kar_id_=$data['kar_id'];
                    $abs_tampil_kar=$abs->abs_tampil_kar($kar_id_,$abs_tgl_masuk);
                    $abs_data_kar=mysql_fetch_array($abs_tampil_kar);
                    */

                    if($data['kar_id']!==$absensi[$data['kar_id']]["kar_id"]){
               ?>
              <div data-value="<?php echo $data['kar_id'];?>"><?php echo $data['kar_nik'];?> - <?php echo $data['kar_nm'];?></div>
              <?php }}}?>    
             </div>
            </div>
           </div>
        
          <div class="form-group">
            <label for="abs_shift" class="col-sm-2 control-label">Shift</label>
            <div class="col-sm-10">
                <input type="radio" name="abs_shift" value="Shift Pagi" class="flat-red" id="abs_shift"  /> Pagi &nbsp;
                <input type="radio" name="abs_shift" value="Shift Siang" class="flat-red" id="abs_shift"  /> Siang &nbsp;
    <input type="radio" name="abs_shift" value="Shift Sore" class="flat-red" id="abs_shift"  /> Sore &nbsp;
                <input type="radio" name="abs_shift" value="Shift Malam" class="flat-red" id="abs_shift"  /> Malam &nbsp; 
            </div>
          </div>
          
          <div class="form-group">
            <label for="location" class="col-sm-2 control-label">Location</label>
            <div class="col-sm-10">
              <div class="bfh-selectbox" data-name="location" data-value="" data-filter="true">
              <div data-value=""></div>
              <?php
                  $ktr_tampil=$ktr->ktr_tampil();
                  if($ktr_tampil){
                  foreach($ktr_tampil as $data){
		  if(($data['ktr_aktif']=="A")){
               ?>
              <div data-value="<?php echo $data['ktr_id'];?>"><?php echo $data['ktr_nm'];?></div>
              <?php }}}?>    
             </div>
            </div>
           </div>

           <div class="bootstrap-timepicker">
            <div class="form-group">
              <label for="abs_masuk" class="col-sm-2 control-label">Jam</label>
              <div class="col-sm-10">
              <div class="input-group">
                <style type="text/css">
                .dropdown-menu{
                  left: 100px;
                }
                </style>
                <input name="abs_masuk" type="text" value="" data-default-time="" class="form-control timepicker" required/>
                <div class="input-group-addon">
                  <i class="fa fa-clock-o"></i>
                </div>
              </div><!-- /.input group -->
            </div>

            </div><!-- /.form group -->
          </div>

          <div class="form-group">
            <label for="abs_alasan_masuk" class="col-sm-2 control-label">Alasan</label>
            <div class="col-sm-10">
              <textarea name="abs_alasan_masuk" class="form-control" rows="3" id="abs_alasan_masuk" placeholder="Wajib diisi..." required></textarea>
            </div>
          </div>


      </div>
      <div class="modal-footer">
      
         <div class="alert alert-warning  alert-dismissable" align="left">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
          <h4><i class="icon fa fa-warning"></i> PERHATIAN! (Admin)</h4>
          Manual <strong>Absen Masuk</strong> hanya berlaku jika karyawan yang bersangkutan telah melakukan konfirmasi terkait masalah absensi yang disebabkan oleh <strong>Gangguan Koneksi Internet</strong>.
        </div>
       
        <button type="submit" name="babsmasuk" class="btn btn-primary"><i class="fa fa-hand-o-up"></i></button>
      </div>
      </form>
    </div>
  </div>
</div>


<!-- Manual Pulang -->
<div class="modal fade" id="pulangmanual" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header bg-red">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel"><i class="fa fa-sign-out"></i> Manual <strong>Absen Pulang</strong></h4>
      </div>
      <form class="form-horizontal" action="" method="post">
      <div class="modal-body">

          <div class="form-group">
            <label for="kar_id" class="col-sm-2 control-label">Karyawan</label>
            <div class="col-sm-10">
              <div class="bfh-selectbox" data-name="kar_id" data-value="" data-filter="true">
              <div data-value=""></div>
              <?php
                  $kar_tampil_3=$kar->kar_tampil_filter_2();
                  if($kar_tampil_3){
                  foreach($kar_tampil_3 as $data){

                    /*$kar_id_=$data['kar_id'];
                    $abs_tampil_kar=$abs->abs_tampil_kar($kar_id_,$abs_tgl_masuk);
                    $abs_data_kar=mysql_fetch_array($abs_tampil_kar);*/

                    if($data['kar_id']==$absensi[$data['kar_id']]["kar_id"] && $absensi[$data['kar_id']]["abs_sts"]=="M"){
               ?>
              <div data-value="<?php echo $data['kar_id'];?>"><?php echo $data['kar_nik'];?> - <?php echo $data['kar_nm'];?></div>
              <?php }}}?>    
             </div>
            </div>
           </div>

           <div class="bootstrap-timepicker">
            <div class="form-group">
              <label for="abs_pulang" class="col-sm-2 control-label">Jam</label>
              <div class="col-sm-10">
              <div class="input-group">
                <style type="text/css">
                .dropdown-menu{
                  left: 100px;
                }
                </style>
                <input name="abs_pulang" type="text" value="" data-default-time="" class="form-control timepicker" required/>
                <div class="input-group-addon">
                  <i class="fa fa-clock-o"></i>
                </div>
              </div><!-- /.input group -->
            </div>

            </div><!-- /.form group -->
          </div>

          <div class="form-group">
            <label for="abs_alasan_pulang" class="col-sm-2 control-label">Alasan</label>
            <div class="col-sm-10">
              <textarea name="abs_alasan_pulang" class="form-control" rows="3" id="abs_alasan_pulang" placeholder="Wajib diisi..." required></textarea>
            </div>
          </div>

      </div>
      <div class="modal-footer">
      
         <div class="alert alert-warning  alert-dismissable" align="left">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
          <h4><i class="icon fa fa-warning"></i> PERHATIAN! (Admin)</h4>
          Manual <strong>Absen Pulang</strong> hanya berlaku jika karyawan yang bersangkutan telah melakukan konfirmasi terkait masalah absensi yang disebabkan oleh <strong>Gangguan Koneksi Internet</strong>.
        </div>
       
        <button type="submit" name="babspulang" class="btn btn-danger"><i class="fa fa-hand-o-up"></i></button>
      </div>
      </form>
    </div>
  </div>
</div>


<!-- Modal Edit Jam Absen Masuk-->
<div class="modal fade" id="jam_abs_masuk_edt" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-header bg-primary">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel"><i class="fa fa-line-chart"></i> Edit Jam Absen Masuk <br><span id="edt_kar_nm"></span></h4>
      </div>
      <form class="form-horizontal" action="" method="post">
      <input type="hidden" name="edt_abs_id" id="edt_abs_id">
      <div class="modal-body">
	
          <div class="bootstrap-timepicker">
	    
	    <div class="form-group">
	      <label for="edt_abs_masuk" class="col-sm-2 control-label">Jam</label>
	      <div class="col-sm-10">
		
		<div class="input-group">
		  <style type="text/css">
		  .dropdown-menu{
		    left: 100px;
		  }
		  </style>
		  <input name="edt_abs_masuk" id="edt_abs_masuk" type="text" value="" data-default-time="" class="form-control timepicker_abs_masuk" required/>
		  <div class="input-group-addon">
		    <i class="fa fa-clock-o"></i>
		  </div>
		</div><!-- /.input group -->
		
	      </div>
	    </div>
	  </div>   
	    
      </div>
      <div class="modal-footer">
        <button type="submit" name="bupdate_jam_abs_masuk" class="btn btn-primary"><i class="fa fa-save"></i></button>
      </div>
      </form>
    </div>
  </div>
</div>