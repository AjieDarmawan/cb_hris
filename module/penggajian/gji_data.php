<?php require('module/penggajian/gji_act.php'); ?>
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
        <div class="col-md-8">
          <div class="box box-info">
            <div class="box-header">
              <h3 class="box-title"><?php echo $tgl->tgl_indo($date);?></h3>
	      <!-- tools box -->
                  <div class="pull-right box-tools">
                    <a href="?p=data_penggajian"  class="btn btn-sm btn-default"><i class="fa fa-refresh"></i></a>
                    <button class="btn btn-info btn-sm" data-widget='collapse' data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
                    <button class="btn btn-info btn-sm" data-widget='remove' data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
                  </div><!-- /. tools -->
	    </div>
            <!-- /.box-header -->
            <div class="box-body">
              
              <table id="tb_karyawan" class="table table-bordered table-striped table-hover">
                <thead>
                  <tr>
                    <th>NIK</th>
                    <th>Nama</th>
                    <th>Join</th>
                    <th>Divisi</th>
                    <th>Jabatan</th>
                    <th>Kota</th>
                    <th>Pendidikan</th>
                    <th>Tanggungan</th>
                    <th>Gapok</th>
                  </tr>
                </thead>
                <tbody>
                <?php
        $kar_tampil=$kar->kar_tampil();
        if($kar_tampil){
        foreach($kar_tampil as $data){
            
        $kar_id__=$data['kar_id'];    
            
        $kar_tampil_detail=$kar->kar_tampil_detail($kar_id__);
        $kar_cek_detail=mysql_num_rows($kar_tampil_detail);
        if($kar_cek_detail > 0){
                $kar_data_detail=mysql_fetch_array($kar_tampil_detail);
        }
        
        
        $gji_tampil_kar=$gji->gji_tampil_kar($kar_id__);
        $gji_cek=mysql_num_rows($gji_tampil_kar);
        if($gji_cek > 0){
                $gji_data=mysql_fetch_array($gji_tampil_kar);
        }
        
        
        if($kar_data_detail['kar_dtl_tgl_joi']!=="0000-00-00"){
            $join=$kar_data_detail['kar_dtl_tgl_joi'];
        }else{
            $join="";
        }
                

        if($data['kar_id']==$_GET['id']){
            $block="danger";
            $check="<i class='fa fa-check text-green'></i>";
        }else{
            $block="";
            $check="";
        }
	
	if($data['kar_id']==$gji_data['kar_id']){
	  $gapok=$gji_data['gji_gapok'];
	}else{
	  $gapok="";
	}
        ?>        
                  <tr class="<?php echo $block;?>">
                    <td><?php echo $check;?> <a href="?p=data_penggajian&id=<?php echo $data['kar_id']; ?>"><?php echo $data['kar_nik']; ?></a></td>
                    <td><a href="?p=data_penggajian&id=<?php echo $data['kar_id']; ?>"><?php echo $data['kar_nm']; ?></a></td>
                    <td><?php echo $tgl->tgl_indo($join); ?></td>
                    <td><?php echo $data['div_nm']; ?></td>
                    <td><?php echo $data['jbt_nm']; ?></td>
                    <td><?php echo $kar_data_detail['kar_dtl_tmp_lhr']; ?></td>
                    <td><?php echo $kar_data_detail['kar_dtl_pnd']; ?></td>
                    <td><?php echo $kar_data_detail['kar_dtl_tgn']; ?></td>
                    <td><?php echo $rph->format_rupiah($gapok); ?></td>
                  </tr>
                  
                <?php }}?>  
                </tbody>      
                <tfoot>
                  <tr>
                    <th>NIK</th>
                    <th>Nama</th>
                    <th>Join</th>
                    <th>Divisi</th>
                    <th>Jabatan</th>
                    <th>Kota</th>
                    <th>Pendidikan</th>
                    <th>Tanggungan</th>
                    <th>Gapok</th>
                  </tr>
                </tfoot>
              </table>

            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->

        </div>
        <!-- /.col -->
	
	<div class="col-md-4">
            
        <!-- form start -->
        <form class="form-horizontal" action="" method="post">  
          <div class="box box-success">
            <div class="box-header">
              <h3 class="box-title">Rincian Gaji <?php if(!empty($_GET['id'])){ echo"- ".$kar_data_['kar_nm']; }?></h3>
	      <!-- tools box -->
                  <div class="pull-right box-tools">
                  <?php
                  if(!empty($_GET['id'])){
                  ?>
		    <button type="submit" name="bupdate" id="bupdate_penggajian" class="btn btn-sm btn-primary"><i class="fa fa-save"></i></button>
                      <button type="button" id="edit_penggajian" class="btn btn-sm btn-primary"><i class="fa fa-pencil"></i></button>
                  <?php }?>
                    <button class="btn btn-info btn-sm" data-widget='collapse' data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
                    <button class="btn btn-info btn-sm" data-widget='remove' data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
                  </div><!-- /. tools -->
	    </div>
            <!-- /.box-header -->
            <div class="box-body">
                
                <?php
                  if(!empty($_GET['id'])){
		    $gji_tampil_kar=$gji->gji_tampil_kar($kar_id_);
                    $gji_cek=mysql_num_rows($gji_tampil_kar);
                    if($gji_cek = 1){
                            $gji_data=mysql_fetch_array($gji_tampil_kar);
                    }
                  ?>
                  
                  <div class="form-group">
                    <label for="gji_gapok" class="col-sm-2 control-label">Gapok</label>
                    <div class="col-sm-10">
                      <input type="text" name="gji_gapok" value="<?php echo $gji_data['gji_gapok'];?>" class="form-control" id="gji_gapok" placeholder="Gaji Pokok" disabled>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="gji_tunj_kel" class="col-sm-2 control-label">Tunj. Kel</label>
                    <div class="col-sm-10">
                      <input type="text" name="gji_tunj_kel" value="<?php echo $gji_data['gji_tunj_kel'];?>" class="form-control" id="gji_tunj_kel" placeholder="Tunjangan Keluarga" disabled>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="gji_tunj_jab" class="col-sm-2 control-label">Tunj. Jab</label>
                    <div class="col-sm-10">
                      <input type="text" name="gji_tunj_jab" value="<?php echo $gji_data['gji_tunj_jab'];?>" class="form-control" id="gji_tunj_jab" placeholder="Tunjangan Jabatan" disabled>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="gji_tunj_fung" class="col-sm-2 control-label">Tunj. Fung</label>
                    <div class="col-sm-10">
                      <input type="text" name="gji_tunj_fung" value="<?php echo $gji_data['gji_tunj_fung'];?>" class="form-control" id="gji_tunj_fung" placeholder="Tunjangan Fungsional" disabled>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="gji_jum_gaji" class="col-sm-2 control-label">Jml Gaji</label>
                    <div class="col-sm-10">
                      <input type="text" name="gji_jum_gaji" value="<?php echo $gji_data['gji_jum_gaji'];?>" class="form-control" id="gji_jum_gaji" placeholder="Jumlah Gaji A" disabled>
                    </div>
                  </div>
		  <div class="form-group">
                    <label for="gji_gaji_bpjs" class="col-sm-2 control-label">Gaji BPJS</label>
                    <div class="col-sm-10">
                      <input type="text" name="gji_gaji_bpjs" value="<?php echo $gji_data['gji_gaji_bpjs'];?>" class="form-control" id="gji_gaji_bpjs" placeholder="Gaji BPJS" disabled>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="gji_lain_lain" class="col-sm-2 control-label">Lain-lain</label>
                    <div class="col-sm-10">
                      <input type="text" name="gji_lain_lain" value="<?php echo $gji_data['gji_lain_lain'];?>" class="form-control" id="gji_lain_lain" placeholder="Lain-lain" disabled>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="gji_bpjs_jamsos" class="col-sm-2 control-label">BPJS & JAMSOS</label>
                    <div class="col-sm-10">
                      <input type="text" name="gji_bpjs_jamsos" value="<?php echo $gji_data['gji_bpjs_jamsos'];?>" class="form-control" id="gji_bpjs_jamsos" placeholder="BPJS & JAMSOS" disabled>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="gji_jum_komp" class="col-sm-2 control-label">Jml. Komp</label>
                    <div class="col-sm-10">
                      <input type="text" name="gji_jum_komp" value="<?php echo $gji_data['gji_jum_komp'];?>" class="form-control" id="gji_jum_komp" placeholder="Jumlah Kompensasi" disabled>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="gji_gaji_std" class="col-sm-2 control-label">Gaji STD</label>
                    <div class="col-sm-10">
                      <input type="text" name="gji_gaji_std" value="<?php echo $gji_data['gji_gaji_std'];?>" class="form-control" id="gji_gaji_std" placeholder="Gaji STD" disabled>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="gji_gaji_baru" class="col-sm-2 control-label">Gaji BARU</label>
                    <div class="col-sm-10">
                      <input type="text" name="gji_gaji_baru" value="<?php echo $gji_data['gji_gaji_baru'];?>" class="form-control" id="gji_gaji_baru" placeholder="Gaji BARU" disabled>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="gji_gaji_pajak" class="col-sm-2 control-label">Gaji Pajak</label>
                    <div class="col-sm-10">
                      <input type="text" name="gji_gaji_pajak" value="<?php echo $gji_data['gji_gaji_pajak'];?>" class="form-control" id="gji_gaji_pajak" placeholder="Gaji Pajak" disabled>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="gji_paguyuban" class="col-sm-2 control-label">Paguyuban</label>
                    <div class="col-sm-10">
                      <input type="text" name="gji_paguyuban" value="<?php echo $gji_data['gji_paguyuban'];?>" class="form-control" id="gji_paguyuban" placeholder="Paguyuban" disabled>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="gji_pajak_pph21" class="col-sm-2 control-label">PPH 21</label>
                    <div class="col-sm-10">
                      <input type="text" name="gji_pajak_pph21" value="<?php echo $gji_data['gji_pajak_pph21'];?>" class="form-control" id="gji_pajak_pph21" placeholder="Pajak PPH 21" disabled>
                    </div>
                  </div>
                  
                   <?php }else{ echo"Silahkan pilih Karyawan";}?>

            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
          </form>

    
        </div>
        <!-- /.col -->


      </div>
      <!-- /.row --> 
      
    </section>
    <!-- /.content --> 




    
