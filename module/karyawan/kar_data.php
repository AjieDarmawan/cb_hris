<?php require('module/karyawan/kar_act.php'); ?>
<?php
  $status = $_REQUEST['status'];
  $divisi = $_REQUEST['divisi'];

  function __list_div_master() {
    $data = array();
    $sSQL = "   SELECT * FROM div_master  WHERE div_id > 0 ORDER BY div_id ";
          
    $query=mysql_query($sSQL) or die (mysql_error());
    while($row=mysql_fetch_assoc($query)) {
       $data[] = $row ;
      // array_push($data,$row);
    }
    $json   = json_encode($data);
    return (json_decode($json,true));
  } 
  

 

 
?>

<!-- Content Header (Page header) -->
    <section class="content-header">
      <h1> <?php echo $title.' : '.$status;?> <small></small> </h1>
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

              <!-- tools box -->
		 <div class="pull-left " style=" margin-top:5px"> 
		    <b> STATUS : &nbsp;</b>
		 </div>
		<div class="pull-left">
			  <form id="form" class="form-horizontal" action="" method="post">
				<div class="input-group">
				<?php
				  $selected1 = "";
				  if ($status == ""){
				      $selected1 = "selected";
				  }
				  $selected2 = "";
				  if ($status == "Aktif"){
				     $selected2 = "selected";
				  }
				  $selected3 = "";
				  if ($status == "Kartap"){
				     $selected3 = "selected";
				  }

				  $selected4 = "";
				  if ($status == "Kontrak"){
				     $selected4 = "selected";
				  }

				  $selected5 = "";
				  if ($status == "Resign"){
				     $selected5 = "selected";
				  }
				  
				?>
					<select class="form-control "   name="status" style=" width:150px;" 
						onchange="onSelectChange();" >  
						<option value=""			<?php echo $selected1;?> > All Data </option>  
						<option value ="Aktif"  	<?php echo $selected2;?> > Aktif  </option> 
						<option value ="Kartap" 	<?php echo $selected3;?> > Kartap  </option>   
						<option value ="Kontrak" 	<?php echo $selected4;?> > Kontrak </option>   
						<option value ="Resign" 	<?php echo $selected5;?> > Resign  </option>   
				
					</select>    

          <select class="form-control "   name="divisi" style=" width:150px;" 
            onchange="onSelectChange();" >  
            <option value=""  > All Data Divisi </option>  
             <?php
                 $cek_div_id = $_REQUEST['divisi'];
                 $json_div = __list_div_master();     
             for($a=0; $a < count($json_div); $a++) {
               $v_id      = $json_div[$a]['div_id'] ;
               $v_nama    = $json_div[$a]['div_nm'] ; 
              //$pos     = strpos($v_jbt, "Direktur Muda");
               if ($cek_div_id == $v_id){
                 echo ' <option  value="'.$v_id.'" selected >'.$v_nama.'</option>'; 
               }else{
                 echo ' <option  value="'.$v_id.'"  >'.$v_nama.'</option>';  
            
               }
                   
                   
             }
          
          ?>
        
          </select>    

				</div> 

		
			</form>  
   
	     </div> 

	
 
		<div class="input-group">&nbsp;
              <h3 class="box-title"><span style="cursor:pointer" class="btn btn-primary" 
			  data-toggle="modal" data-target="#myModal"><i class="fa fa-plus"></i></span>
			  </h3>
		</div>

			  
		  <div class="pull-right box-tools">
			<!-- Date and time range -->
		  <div class="form-group">
			<div class="input-group">
			  <button class="btn btn-default pull-right" id="daterange-btn">
				<i class="fa fa-calendar"></i> Sortir Karyawan <small>Under Construction</small>
				<i class="fa fa-caret-down"></i>
			  </button>
			</div>
		 </div><!-- /.form group -->
		  </div><!-- /. tools -->
			  				  
				  
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive">
              <table id="tb_karyawan" class="table table-bordered table-striped table-hover">
                <thead>
                  <tr>
				    <th>PT</th>
                    <th>NIK</th>
                    <th>Nama</th>
                    <th>Tgl Join</th>
                    <th>Tgl Lahir</th>
                    <th>Divisi</th>
                    <th>Jabatan</th>
                    <th>Level</th>
                    <th>Kantor</th>
                    <th style="display: none;">Kota</th>
                    <th>Status Karyawan</th>
					<th style="display: none;">Tgl Lahir</th>
					<th style="display: none;">Tgl Join</th>
                    <th style="display: none;">Tgl Resign</th>
                    <th style="display: none;">Alasan Resign</th>
                    <th style="display: none;">Usia</th>
                    <th style="display: none;">Jenis Kelamin</th>
                    <th style="display: none;">Tempat Lahir</th>
                    <th style="display: none;">Satus Nikah</th>
                    <th style="display: none;">Jumlah Anak</th>
                    <th style="display: none;">Tanggungan</th>
                    <th style="display: none;">Pendidikan</th>
                    <th style="display: none;">Jurusan</th>
                    <th style="display: none;">Univ. / School</th>
                    <th style="display: none;">Status Pendidikan</th>
                    <th style="display: none;">Tahun Lulus</th>
                    <th style="display: none;">Nik. KTP</th>
                    <th style="display: none;">No. KK</th>
                    <th style="display: none;">No. NPWP</th>
                    <th style="display: none;">No. KPJ</th>
                    <th style="display: none;">No. Rek</th>
                    <th style="display: none;">BPJS</th>
					<th style="display: none;">Jamsostek</th>
					<th style="display: none;">Email</th>
					<th style="display: none;">No. Tlp</th>
					<th style="display: none;">Alamat Rumah</th>
                    <th>Aksi</th>
                  </tr>
                </thead>
                <tbody>
<?php



$filter_status = "" ;
if ($status == "Aktif"){
  $filter_status = "AND  kar_detail.kar_dtl_sts_krj = 'A' AND kar_detail.kar_dtl_typ_krj <> 'Resign' " ;
}
if ($status == "Resign"){
  $filter_status = "AND kar_detail.kar_dtl_typ_krj = 'Resign' " ;
}
if ($status == "Kontrak"){
  $filter_status = "AND  kar_detail.kar_dtl_typ_krj = 'Kontrak' " ;
}
if ($status == "Permanen"){
  $filter_status = "AND  kar_detail.kar_dtl_typ_krj = 'Permanen' " ;
}

if ($divisi <> ""){
   $filter_status .= " AND kar_master.div_id = '$divisi' ";
}

/*
if ($status=="resign"){
 $kar_tampil=$kar->kar_tampil_resign();
}else{
 $kar_tampil=$kar->kar_tampil_aktif(); 
}
*/
//$kar_tampil=$kar->kar_tampil();
$kar_tampil=$kar->kar_tampil_status($filter_status);
if($kar_tampil){
  foreach($kar_tampil as $data){

        $kar_id_=$data['kar_id'];
        $kar_tampil_detail=$kar->kar_tampil_detail($kar_id_);
        $kar_data_detail=mysql_fetch_assoc($kar_tampil_detail);


        if($kar_data_detail['kar_dtl_typ_krj']=="Kontrak"){

            $kkn_tampil_kar_limit=$nla->kkn_tampil_kar_limit($kar_id_);
            $kkn_data_kar_limit=mysql_fetch_assoc($kkn_tampil_kar_limit);
            $kkn_cek_kar_limit=mysql_num_rows($kkn_tampil_kar_limit);
            if($kkn_cek_kar_limit > 0){

            $pecah_end=explode("-", $kkn_data_kar_limit['kkn_end']);
            $end_hari=$pecah_end[2];
            $end_bulan=sprintf('%02d', $pecah_end[1] - 2); //2 bulan sebelum
            $end_tahun=$pecah_end[0];
            $end_sebulansebelumny=$end_tahun."-".$end_bulan."-".$end_hari;

            if($end_sebulansebelumny > $date){
              $lbl_kontrak="primary";
              $alert_kontrak="Berjalan";
            }else{
              $lbl_kontrak="danger";
              $alert_kontrak="Habis";
            }

            $sts_kontrak="<span class='label label-".$lbl_kontrak."'>".$kkn_data_kar_limit['kkn_kontrak']." ".$alert_kontrak."</span>";

            }else{
            $sts_kontrak="<span class='label label-primary'>Kontrak</span>"; 
            }

        }elseif($kar_data_detail['kar_dtl_typ_krj']=="Kartap"){

          $sts_kontrak="<span class='label label-success'>Tetap</span>";
          
        }elseif($kar_data_detail['kar_dtl_typ_krj']=="Resign"){

          $sts_kontrak="<span class='label label-danger'>Resign</span>";
          
        }else{

          $sts_kontrak="<span class='label label-default'>Undifine</span>";
        }
		
		if($kar_data_detail['kar_dtl_tgl_joi']=="0000-00-00"){
			$tgljoin="";
		}else{
			$tgljoin= $data['kar_dtl_tgl_joi'];
		}
		
		if($kar_data_detail['kar_dtl_tgl_res']=="0000-00-00"){
			$tglrres="";
		}else{
			$tglrres= $data['kar_dtl_tgl_res'];
		}
		
		if($kar_data_detail['kar_dtl_gen']=="L"){
			$jeniskelamin="Laki-Laki";
		}else{
			$jeniskelamin= "Perempuan";
		}
		
		if($kar_data_detail['kar_dtl_sts_nkh']=="K"){
			$statusnikah="Kawin";
		}else{
			$statusnikah= "Tidak Kawin";
		}
		
		if($kar_data_detail['kar_dtl_sts_pnd']==""){
			$statuspendidikan="";
		}else{
			$statuspendidikan= "Lulus";
		}
		
		
?>
                  <tr>
					<td><?php echo $data['pt_nama']; ?></td>
                    <td><?php echo $data['kar_nik']; ?></td>
                    <td><?php echo $data['kar_nm']; ?></td>
                    <td><?php echo $tgl->tgl_indo($data['kar_dtl_tgl_joi']); ?></td>
                    <td><?php echo $tgl->tgl_indo($data['kar_tgl_lahir']); ?></td>
                    <td><?php echo $data['div_nm']; ?></td>
                    <td><?php echo $data['jbt_nm']; ?></td>
                    <td><?php echo $data['lvl_nm']; ?></td>
                    <!--<td><?php echo $data['unt_nm']; ?></td>-->
                    <td><a data-toggle="tooltip" title="<?php echo $data['ktr_nm']; ?>" style="cursor:pointer"><?php echo $data['ktr_kd']; ?></a></td>
					<td style="display: none;"><?php echo $data['kot_kota']; ?></td>
                    <td><?php echo $sts_kontrak; ?></td>
					<td style="display: none;"><?php echo $data['kar_tgl_lahir']; ?></td>
					<td style="display: none;"><?php echo $tgljoin; ?></td>
                    <!--<td style="display: none;"><?php echo $tgl->tgl_indo($tglrres); ?></td>-->
                    <td style="display: none;"><?php echo $tglrres; ?></td>
                    <td style="display: none;"><?php echo $data['kar_dtl_als_res']; ?></td>
                    <td style="display: none;"><?php echo $data['kar_dtl_usa']; ?></td>
                    <td style="display: none;"><?php echo $jeniskelamin; ?></td>
                    <td style="display: none;"><?php echo $data['kar_dtl_tmp_lhr']; ?></td>
                    <td style="display: none;"><?php echo $statusnikah; ?></td>
					<td style="display: none;"><?php echo $data['kar_dtl_jml_ank']; ?></td>
					<td style="display: none;"><?php echo $data['kar_dtl_tgn']; ?></td>
					<td style="display: none;"><?php echo $data['kar_dtl_pnd']; ?></td>
					<td style="display: none;"><?php echo $data['kar_dtl_jrs']; ?></td>
					<td style="display: none;"><?php echo $data['kar_dtl_unv_sch']; ?></td>
					<td style="display: none;"><?php echo $statuspendidikan; ?></td>
					<td style="display: none;"><?php echo $data['kar_dtl_thn_lls']; ?></td>
					<td style="display: none;"><?php echo $data['kar_dtl_no_ktp']; ?></td>
					<td style="display: none;"><?php echo $data['kar_dtl_no_kk']; ?></td>
					<td style="display: none;"><?php echo $data['kar_dtl_no_npw']; ?></td>
					<td style="display: none;"><?php echo $data['kar_dtl_no_kpj']; ?></td>
					<td style="display: none;"><?php echo $data['kar_dtl_no_rek']; ?></td>
					<td style="display: none;"><?php echo $data['kar_dtl_no_bpj']; ?></td>
					<td style="display: none;"><?php echo $data['kar_dtl_no_jms']; ?></td>
					<td style="display: none;"><?php echo $data['kar_dtl_eml']; ?></td>
					<td style="display: none;"><?php echo $data['kar_dtl_tlp']; ?></td>
					<td style="display: none;"><?php echo $data['kar_dtl_alt']; ?></td>
                    <td>
                    <a href="?p=detail_karyawan&id=<?php echo $data['kar_id'];?>"><span style="cursor:pointer" class="label label-primary"><i class="fa fa-ellipsis-h"></i></span></a>
                    <a href="#delete-confirm" data-toggle="modal" data-data="<?php echo $data['kar_nm'];?>" data-url="?p=data_karyawan&act=hapus&id=<?php echo $data['kar_id'];?>"><span style="cursor:pointer" class="label label-danger"><i class="fa fa-trash"></i></span></a>
                    </td>
                  </tr>
                <?php }}?>  
                </tbody>      
                <tfoot>
                  <tr>
				    <th>PT</th>
                    <th>NIK</th>
                    <th>Nama</th>
                    <th>Tgl Join</th>
                    <th>Tgl Lahir</th>
                    <th>Divisi</th>
                    <th>Jabatan</th>
                    <th>Level</th>
                    <th>Kantor</th>
					<th style="display: none;">Kota</th>
                    <th>Status Karyawan</th>
					<th style="display: none;">Tgl Join</th>
                    <th style="display: none;">Tgl Resign</th>
                    <th style="display: none;">Alasan Resign</th>
					<th style="display: none;">Usia</th>
					<th style="display: none;">Jenis Kelamin</th>
					<th style="display: none;">Tempat Lahir</th>
					<th style="display: none;">Satus Nikah</th>
					<th style="display: none;">Jumlah Anak</th>
					<th style="display: none;">Tanggungan</th>
					<th style="display: none;">Pendidikan</th>
					<th style="display: none;">Jurusan</th>
					<th style="display: none;">Univ. / School</th>
					<th style="display: none;">Status Pendidikan</th>
					<th style="display: none;">Tahun Lulus</th>
					<th style="display: none;">Nik. KTP</th>
					<th style="display: none;">No. KK</th>
					<th style="display: none;">No. NPWP</th>
					<th style="display: none;">No. KPJ</th>
					<th style="display: none;">No. Rek</th>
					<th style="display: none;">BPJS</th>
					<th style="display: none;">Jamsostek</th>
					<th style="display: none;">Email</th>
					<th style="display: none;">No. Tlp</th>
					<th style="display: none;">Alamat Rumah</th>
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

      <!-- =========================================================== -->

          <!-- Small boxes (Stat box) -->
          <div class="row">
            <div class="col-lg-3 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-aqua">
                <div class="inner">
		  <?php
		  $kar_dtl_sts_krj="A";
		  $kar_tampil_sts=$kar->kar_tampil_sts($kar_dtl_sts_krj);
		  $kar_cek_sts=mysql_num_rows($kar_tampil_sts);
		  if($kar_cek_sts > 0){
		    $modal="modal";
		  }else{
		    $modal="";
		  }
		  ?>
                  <h3><?php echo $kar_cek_sts;?><sup style="font-size: 20px">Orang</sup></h3>
                  <p>Total Karyawan</p>
                </div>
                <div class="icon">
                  <i class="fa fa-users"></i>
                </div>
                <a style="cursor:pointer;" data-toggle="<?php echo $modal;?>" data-target="#total_karyawan_modal" class="small-box-footer">
		  More info <i class="fa fa-arrow-circle-right"></i>
		</a>
              </div>
            </div><!-- ./col -->
            <div class="col-lg-3 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-green">
                <div class="inner">
		  <?php
		  $kar_dtl_typ_krj="Kontrak";
		  $kar_tampil_typ=$kar->kar_tampil_typ($kar_dtl_typ_krj);
		  $kar_cek_typ=mysql_num_rows($kar_tampil_typ);
		  if($kar_cek_typ > 0){
		    $modal="modal";
		  }else{
		    $modal="";
		  }
		  ?>
                  <h3><?php echo $kar_cek_typ;?><sup style="font-size: 20px">Orang</sup></h3>
                  <p>Kontrak</p>
                </div>
                <div class="icon">
                  <i class="fa fa-user"></i>
                </div>
                <a style="cursor:pointer;" data-toggle="<?php echo $modal;?>" data-target="#kontrak_modal" class="small-box-footer">
		  More info <i class="fa fa-arrow-circle-right"></i>
		</a>
              </div>
            </div><!-- ./col -->
            <div class="col-lg-3 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-yellow">
                <div class="inner">
                  <?php
		  $kar_dtl_typ_krj="Permanen";
		  $kar_tampil_typ=$kar->kar_tampil_typ($kar_dtl_typ_krj);
		  $kar_cek_typ=mysql_num_rows($kar_tampil_typ);
		  if($kar_cek_typ > 0){
		    $modal="modal";
		  }else{
		    $modal="";
		  }
		  ?>
                  <h3><?php echo $kar_cek_typ;?><sup style="font-size: 20px">Orang</sup></h3>
                  <p>Permanent</p>
                </div>
                <div class="icon">
                  <i class="fa fa-male"></i>
                </div>
                <a style="cursor:pointer;" data-toggle="<?php echo $modal;?>" data-target="#permanent_modal" class="small-box-footer">
		  More info <i class="fa fa-arrow-circle-right"></i>
		</a>
              </div>
            </div><!-- ./col -->
            <div class="col-lg-3 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-red">
                <div class="inner">
                  <?php
		  $kar_dtl_typ_krj="Resign";
		  $kar_tampil_typ=$kar->kar_tampil_typ($kar_dtl_typ_krj);
		  $kar_cek_typ=mysql_num_rows($kar_tampil_typ);
		  if($kar_cek_typ > 0){
		    $modal="modal";
		  }else{
		    $modal="";
		  }
		  ?>
                  <h3><?php echo $kar_cek_typ;?><sup style="font-size: 20px">Orang</sup></h3>
                  <p>Resign</p>
                </div>
                <div class="icon">
                  <i class="fa fa-user-times"></i>
                </div>
                <a style="cursor:pointer;" data-toggle="<?php echo $modal;?>" data-target="#resign_modal" class="small-box-footer">
		  More info <i class="fa fa-arrow-circle-right"></i>
		</a>
              </div>
            </div><!-- ./col -->
          </div><!-- /.row -->

          <!-- =========================================================== --> 

    </section>
    <!-- /.content --> 


    
<!-- POPUP -->
<!-- Button trigger modal -->


<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header bg-primary">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel"><i class="fa fa-user"></i> Tambah Karyawan</h4>
      </div>
      <form class="form-horizontal" action="" method="post">
      <div class="modal-body">
          <div class="form-group">
            <label for="kar_nik_dis" class="col-sm-2 control-label">NIK</label>
            <div class="col-sm-10">
              <input type="text" name="kar_nik_dis" class="form-control" id="kar_nik_dis" value="<?php echo $new_nik;?>" disabled>
              <input type="hidden" name="kar_nik" id="kar_nik" value="<?php echo $new_nik;?>">
            </div>
          </div>
          <div class="form-group">
            <label for="kar_nm" class="col-sm-2 control-label">Nama</label>
            <div class="col-sm-10">
              <input type="text" name="kar_nm" class="form-control" id="kar_nm" placeholder="Nama Karyawan" required>
            </div>
          </div>
		  <div class="form-group">
            <label for="kar_nm" class="col-sm-2 control-label">Nama Panggilan</label>
            <div class="col-sm-10">
              <input type="text" name="kar_nm_panggilan" class="form-control" id="kar_nm_panggilan" placeholder="Nama Panggilan Karyawan" required>
            </div>
          </div>
          <div class="form-group">
            <label for="kar_tgl_lahir" class="col-sm-2 control-label">Tgl Lahir</label>
            <div class="col-sm-10">
              <input type="text" name="kar_tgl_lahir" class="form-control" id="kar_tgl_lahir" placeholder="Tanggal Lahir" data-inputmask="'alias': 'yyyy-mm-dd'" data-mask required>
            </div>
          </div>
          <div class="form-group">
            <label for="div_id" class="col-sm-2 control-label">Divisi</label>
            <div class="col-sm-10">
              <select class="form-control" name="div_id" id="div_id" required>
              	<option value="" selected></option>
                <?php
				$div_tampil=$div->div_tampil();
				foreach($div_tampil as $data){	
				?>
                <option value="<?php echo $data['div_id']; ?>"><?php echo $data['div_nm']; ?></option>
                <?php }?>
              </select>
            </div>
          </div>
          <div class="form-group">
            <label for="jbt_id" class="col-sm-2 control-label">Jabatan</label>
            <div class="col-sm-10">
              <select class="form-control" name="jbt_id" id="jbt_id" required>
              	<option value="" selected></option>
              </select>
            </div>
          </div>
          <div class="form-group">
            <label for="lvl_id" class="col-sm-2 control-label">Level</label>
            <div class="col-sm-10">
              <select class="form-control" name="lvl_id" id="lvl_id" required>
              	<option value="" selected></option>
                <?php
				$lvl_tampil=$lvl->lvl_tampil();
				foreach($lvl_tampil as $data){	
				?>
                <option value="<?php echo $data['lvl_id']; ?>"><?php echo $data['lvl_nm']; ?></option>
                <?php }?>
              </select>
            </div>
          </div>
          <div class="form-group">
            <label for="unt_id" class="col-sm-2 control-label">Unit</label>
            <div class="col-sm-10">
              <select class="form-control" name="unt_id" id="unt_id" required>
              	<option value="" selected></option>
                <?php
				$unt_tampil=$unt->unt_tampil();
				foreach($unt_tampil as $data){	
				?>
                <option value="<?php echo $data['unt_id']; ?>"><?php echo $data['unt_nm']; ?></option>
                <?php }?>
              </select>
            </div>
          </div>
          <div class="form-group">
            <label for="ktr_id" class="col-sm-2 control-label">Kantor</label>
            <div class="col-sm-10">
              <select class="form-control" name="ktr_id" id="ktr_id" required>
              	<option value="" selected></option>
              </select>
            </div>
          </div>
		  <div class="form-group">
            <label for="kot_id" class="col-sm-2 control-label">Kota</label>
            <div class="col-sm-10">
              <select class="form-control" name="kot_id" id="kot_id" required>
              	<option value="" selected></option>
                <?php
				$kot_tampil=$kot->kot_tampil();
				foreach($kot_tampil as $data){	
				?>
                <option value="<?php echo $data['kot_id']; ?>"><?php echo $data['kot_kota']; ?></option>
                <?php }?>
              </select>
            </div>
          </div>
		  <div class="form-group">
            <label for="pt_id" class="col-sm-2 control-label">PT</label>
            <div class="col-sm-10">
              <select class="form-control" name="pt_id" id="pt_id" required>
              	<option value="" selected></option>
                <?php
				$npt_tampil=$npt->npt_tampil();
				foreach($npt_tampil as $data){	
				?>
                <option value="<?php echo $data['pt_id']; ?>"><?php echo $data['pt_nama']; ?></option>
                <?php }?>
              </select>
            </div>
          </div>
      </div>
      <div class="modal-footer">
        <button type="submit" name="bsave" class="btn btn-primary"><i class="fa fa-save"></i></button>
      </div>
      </form>
    </div>
  </div>
</div>



<!-- Modal Total Karyawan -->
<div class="modal fade" id="total_karyawan_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header bg-gray">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel"><i class="fa fa-users"></i> Total Karyawan</h4>
      </div>
      <form class="form-horizontal" action="" method="post">
      <div class="modal-body" id="total_karyawan_overflow">
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
            $kar_dtl_sts_krj="A";
	    $kar_tampil_sts=$kar->kar_tampil_sts($kar_dtl_sts_krj);
            while($kar_data_sts=mysql_fetch_array($kar_tampil_sts)){

              $kar_id_=$kar_data_sts['kar_id'];
              $kar_tampil_id_=$kar->kar_tampil_id($kar_id_);
              $kar_data_=mysql_fetch_array($kar_tampil_id_);
            ?>
              <tr>
                <td><?php echo $kar_data_['kar_nik']; ?></td>
                <td><?php echo $kar_data_['kar_nm']; ?></td>
                <td><?php echo $kar_data_['div_nm']; ?></td>                     
              </tr>
            <?php }?>   
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
       
      </div>
      </form>
    </div>
  </div>
</div>



<!-- Modal Karyawan Kontrak -->
<div class="modal fade" id="kontrak_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header bg-gray">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel"><i class="fa fa-user"></i> Karyawan Kontrak</h4>
      </div>
      <form class="form-horizontal" action="" method="post">
      <div class="modal-body" id="kontrak_overflow">
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
            $kar_dtl_typ_krj="Kontrak";
	    $kar_tampil_typ=$kar->kar_tampil_typ($kar_dtl_typ_krj);
            while($kar_data_typ=mysql_fetch_array($kar_tampil_typ)){

              $kar_id_=$kar_data_typ['kar_id'];
              $kar_tampil_id_=$kar->kar_tampil_id($kar_id_);
              $kar_data_=mysql_fetch_array($kar_tampil_id_);
            ?>
              <tr>
                <td><?php echo $kar_data_['kar_nik']; ?></td>
                <td><?php echo $kar_data_['kar_nm']; ?></td>
                <td><?php echo $kar_data_['div_nm']; ?></td>                     
              </tr>
            <?php }?>   
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
       
      </div>
      </form>
    </div>
  </div>
</div>


<!-- Modal Karyawan Permanent -->
<div class="modal fade" id="permanent_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header bg-gray">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel"><i class="fa fa-male"></i> Karyawan Permanent</h4>
      </div>
      <form class="form-horizontal" action="" method="post">
      <div class="modal-body" id="permanent_overflow">
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
            $kar_dtl_typ_krj="Permanen";
	    $kar_tampil_typ=$kar->kar_tampil_typ($kar_dtl_typ_krj);
            while($kar_data_typ=mysql_fetch_array($kar_tampil_typ)){

              $kar_id_=$kar_data_typ['kar_id'];
              $kar_tampil_id_=$kar->kar_tampil_id($kar_id_);
              $kar_data_=mysql_fetch_array($kar_tampil_id_);
            ?>
              <tr>
                <td><?php echo $kar_data_['kar_nik']; ?></td>
                <td><?php echo $kar_data_['kar_nm']; ?></td>
                <td><?php echo $kar_data_['div_nm']; ?></td>                     
              </tr>
            <?php }?>   
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
       
      </div>
      </form>
    </div>
  </div>
</div>


<!-- Modal Karyawan Resign -->
<div class="modal fade" id="resign_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header bg-gray">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel"><i class="fa fa-user-times"></i> Karyawan Resign</h4>
      </div>
      <form class="form-horizontal" action="" method="post">
      <div class="modal-body" id="resign_overflow">
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
            $kar_dtl_typ_krj="Resign";
	    $kar_tampil_typ=$kar->kar_tampil_typ($kar_dtl_typ_krj);
            while($kar_data_typ=mysql_fetch_array($kar_tampil_typ)){

              $kar_id_=$kar_data_typ['kar_id'];
              $kar_tampil_id_=$kar->kar_tampil_id($kar_id_);
              $kar_data_=mysql_fetch_array($kar_tampil_id_);
            ?>
              <tr>
                <td><?php echo $kar_data_['kar_nik']; ?></td>
                <td><?php echo $kar_data_['kar_nm']; ?></td>
                <td><?php echo $kar_data_['div_nm']; ?></td>                     
              </tr>
            <?php }?>   
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
       
      </div>
      </form>
    </div>
  </div>
</div>

<script>
	function onSelectChange(){
	  //alert('submit');
	  document.getElementById('form').submit();
	}
</script>