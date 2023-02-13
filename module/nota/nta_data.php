<?php require('module/nota/nta_act.php'); ?>
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
          <h3 class="box-title">
            <form class="form-inline" method="post" action="">
	        <?php
		if(($kar_data['kar_id']=="69")||
      ($kar_data['kar_id']=="273")||
		    ($kar_data['kar_id']=="248")||
		    ($kar_data['kar_id']=="255")||
        ($kar_data['kar_id']=="410")||
        ($kar_data['kar_id']=="534")||
        ($kar_data['kar_id']=="421")){
		?> 
                <div class="form-group">
                  <span class="btn btn-md btn-primary" data-toggle="modal" data-target="#inputnota"><i class="fa fa-plus"></i> Add</span>
                </div>
		<?php }?>
                <div class="form-group">
                 <?php
                  if(!empty($_SESSION['priode1']) || !empty($_SESSION['priode2']) || !empty($_SESSION['pts']) || !empty($_SESSION['program']) || !empty($_SESSION['wilayah'])){
                    $filter_aktif=" : <em>Active</em>";
                  }
                  ?>
                  <span class="btn btn-md btn-warning" data-toggle="modal" data-target="#filternota"><i class="fa fa-search"></i> Filter <?php echo $filter_aktif;?></span>
                </div>
                <div class="form-group">
                  <button type="submit" name="brefreshnota" data-toggle="tooltip"  class="btn btn-md btn-default" title="Kembali ke default, kosongkan Filter"><i class="fa fa-refresh"></i></button>
                </div>
              </form>
	      <small>**) Data list nota tampilan defaultnya tanggal terakhir input & data dengan tanggal yang kosong, dikarenakan data sudah mulai banyak dan berat ketika buka. (dyan)</small>
            <?php //echo $_SESSION['priode1']." / ".$_SESSION['priode2']." / ".$_SESSION['pts']." / ".$_SESSION['program'];?>
          </h3>
          <div class="pull-right">
            <form class="form-inline" method="post" action="">
                <div class="form-group">
                  <!--<input type="hidden" name="tglekspor" id="tglekspor" value="">-->
                  <button type="button" onclick="nota_ekspor()"  class="btn btn-md btn-success"><i class="fa fa-file-excel-o"></i> Export to Excel</button>
                </div>
              </form>
          </div>
        </div>
        <!-- /.box-header -->
        <div class="box-body">

        <table id="tb_nota" class="table table-bordered table-striped table-hover">
            <thead>
              <tr>
                <th>Nama</th>
                <th>Akt</th>
                <th>Jurusan</th>
		            <th>PTS</th>
                <th>Program</th>
		            <th>Wilayah</th>
                <th>No.Nota</th>
                <th>Tanggal</th>
                <th>Daftar</th>
                <th>SPb</th>
                <th>SPP</th>
                <th>Jumlah</th>
                <th>Keterangan</th>
                <!--<th>Validasi</th>-->
		<?php
		if(($kar_data['kar_id']=="69")||
      ($kar_data['kar_id']=="273")||
		    ($kar_data['kar_id']=="248")||
		    ($kar_data['kar_id']=="255")||
        ($kar_data['kar_id']=="410")||
      ($kar_data['kar_id']=="421")){
		?> 
                <th>Aksi</th>
		<?php }?>
              </tr>
            </thead>
            <tbody>
            <?php

              if(!empty($_SESSION['priode1']) || !empty($_SESSION['priode2']) || !empty($_SESSION['pts']) || !empty($_SESSION['program']) || !empty($_SESSION['wilayah'])){

              $sespriode1=$_SESSION['priode1'];
              $sespriode2=$_SESSION['priode2'];
              $sespts=$_SESSION['pts'];
              $sesprogram=$_SESSION['program'];
              $seswilayah=$_SESSION['wilayah'];
              
              $nta_tampil=$nta->nta_tampil_filter($sespriode1,$sespriode2,$sespts,$sesprogram,$seswilayah);
            
              }else{
	      
	      $nta_tampil_max=$nta->nta_tampil_max();
	      $nta_data_max=mysql_fetch_assoc($nta_tampil_max);
	      $tgl_terakhir=$nta_data_max['tgl_terakhir'];
	      
              $nta_tampil=$nta->nta_tampil($tgl_terakhir);
              }
                   
              while($data=mysql_fetch_assoc($nta_tampil)){
              
              $ktr_id_nta= $data['nta_pts'];
              $ktr_tampil_id_nta=$ktr->ktr_tampil_id($ktr_id_nta);
              $ktr_data_nta=mysql_fetch_assoc($ktr_tampil_id_nta);
                          
              $kar_id_validasi= $data['nta_validasi'];
              $kar_tampil_id_validasi=$kar->kar_tampil_id($kar_id_validasi);
              $kar_data_validasi=mysql_fetch_assoc($kar_tampil_id_validasi);
	      
	      $jumlah=$data['nta_daftar'] + $data['nta_spb'] + $data['nta_spp'];
              
            ?>
              <tr>
                <td><small><?php echo $data['nta_mhs']; ?></small></td>
                <td><small><?php echo $data['nta_angkatan']; ?></small></td>
		<td><small><?php echo strtoupper($data['nta_jurusan']); ?></small></td>
                <td class="text-blue"><small><?php echo $ktr_data_nta['ktr_kd']; ?></small></td>
                <td><small><?php echo $data['nta_program']; ?></small></td>
		<td><small><?php echo $data['nta_wilayah']; ?></small></td>
                <td class="text-blue"><small><?php echo $data['nta_nomor']; ?></small></td>
                <td class="text-blue"><small><?php echo $tgl->tgl_indo($data['nta_tgl']); ?></small></td>
                <td class="text-blue"><small><?php echo $rph->format_rupiah($data['nta_daftar']); ?></small></td>
                <td class="text-blue"><small><?php echo $rph->format_rupiah($data['nta_spb']); ?></small></td>
                <td class="text-blue"><small><?php echo $rph->format_rupiah($data['nta_spp']); ?></small></td>
                <td class="text-blue"><small><?php echo $rph->format_rupiah($jumlah); ?></small></td>                
                <td><em><small><?php echo $data['nta_keterangan'] ? : '-'; ?></small></em></td>
                <!--<td><small><?php //echo $kar_data_validasi['kar_nm']; ?></td>-->
		<?php
		if(($kar_data['kar_id']=="69")||
      ($kar_data['kar_id']=="273")||
		    ($kar_data['kar_id']=="248")||
		    ($kar_data['kar_id']=="255")||
        ($kar_data['kar_id']=="410")||
      ($kar_data['kar_id']=="421")){
		?> 
                <td> <a href="javascript:;"
                	data-ntaid="<?php echo $data['nta_id']; ?>"
                    data-ntamhs="<?php echo $data['nta_mhs']; ?>"
                    data-ntaangkatan="<?php echo $data['nta_angkatan']; ?>"
                    data-ntajurusan="<?php echo $data['nta_jurusan']; ?>"
                    data-ntanomor="<?php echo $data['nta_nomor']; ?>"
                    data-ntatgl="<?php echo $data['nta_tgl']; ?>"
                    data-ntawilayah="<?php echo $data['nta_wilayah']; ?>"
                    data-ntaprogram="<?php echo $data['nta_program']; ?>"
                    data-ntapts="<?php echo $data['nta_pts']; ?>"
                    data-ntadaftar="<?php echo $data['nta_daftar']; ?>"
                    data-ntaspb="<?php echo $data['nta_spb']; ?>"
                    data-ntaspp="<?php echo $data['nta_spp']; ?>"
                    data-ntaketerangan="<?php echo $data['nta_keterangan']; ?>"
                    data-ntavalidasi="<?php echo $data['nta_validasi']; ?>" data-toggle="modal" data-target="#editnota"><i class="fa  fa-pencil"></i></a>&nbsp;&nbsp;&nbsp;
                <a href="#block-confirm" data-toggle="modal" data-data="<h4>Yakin Hapus Nomor Nota <strong><?php echo $data['nta_nomor'];?></strong>?</h4>" data-url="?p=data_nota&act=hapus&id=<?php echo $data['nta_id'];?>" ><i class="fa fa-trash"></i></a>
		</td>
		<?php }?> 
		
	      </tr>
            <?php }?>  
            </tbody>      
            <tfoot>
              <tr>
                <th>Nama</th>
                <th>Akt</th>
                <th>Jurusan</th>
		            <th>PTS</th>
                <th>Program</th>
		            <th>Wilayah</th>
                <th>No.Nota</th>
                <th>Tanggal</th>
                <th>Daftar</th>
                <th>SPb</th>
                <th>SPP</th>
                <th>Jumlah</th>
                <th>Keterangan</th>
                <?php
		if(($kar_data['kar_id']=="69")||
      ($kar_data['kar_id']=="273")||
		    ($kar_data['kar_id']=="248")||
		    ($kar_data['kar_id']=="255")||
        ($kar_data['kar_id']=="410")||
      ($kar_data['kar_id']=="421")){
		?> 
                <th>Aksi</th>
		<?php }?>
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



<!-- Modal Input Nota -->
<div class="modal fade" id="inputnota" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header bg-primary">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel"><i class="fa fa-credit-card"></i> Tambah Nota</h4>
      </div>
      <form class="form-horizontal" action="" method="post">
      <div class="modal-body">
        
        <div class="row">
        <div class="col-sm-6">

        <div class="form-group">
           <label for="nta_mhs" class="col-sm-2 control-label">Nama</label>
            <div class="field_wrapper col-sm-10">             
              <input type="text" name="nta_mhs" class="form-control" id="nta_mhs" value="" placeholder="Nama Mahasiswa" >            
            </div>
        </div>

        <div class="form-group">
           <label for="nta_angkatan" class="col-sm-2 control-label">Angkatan</label>
            <div class="field_wrapper col-sm-10">             
              <input type="number" name="nta_angkatan" class="form-control" id="nta_angkatan" value="" placeholder="Angkatan" onKeyPress="return onlyNumbers(event);">            
            </div>
        </div>

        <div class="form-group">
           <label for="nta_jurusan" class="col-sm-2 control-label">Jurusan</label>
            <div class="field_wrapper col-sm-10">             
              <input type="text" name="nta_jurusan" class="form-control" id="nta_jurusan" value="" placeholder="Jurusan" >            
            </div>
        </div>

         <div class="form-group">
            <label for="nta_pts" class="col-sm-2 control-label">PTS</label>
            <div class="col-sm-10">
              <div class="bfh-selectbox" data-name="nta_pts" data-value="" data-filter="true">
              <div data-value=""></div>
                <?php
                  $ktr_tampil=$ktr->ktr_tampil();
                  if($ktr_tampil){
                  foreach($ktr_tampil as $data){
		    	if(($data['ktr_id']!=="1")&&($data['ktr_id']!=="2")){
               ?>
               <div data-value="<?php echo $data['ktr_id'];?>"><?php echo $data['ktr_nm'];?></div>
               <?php }}}?> 
             </div>
            </div>
           </div>
	 
	 <div class="form-group">
            <label for="nta_program" class="col-sm-2 control-label">Program</label>
            <div class="col-sm-10">
               
                <input type="radio" name="nta_program" value="P2K" class="flat-red" id="nta_program" checked /> <span class="label label-warning">P2K</span> &nbsp;
                <input type="radio" name="nta_program" value="REGULER" class="flat-red" id="nta_program"  /> <span class="label label-primary">Reguler</span> &nbsp;
                
            </div>   
          </div>
	 
	 <div class="form-group">
            <label for="nta_wilayah" class="col-sm-2 control-label">Wilayah</label>
            <div class="col-sm-10">
              <div class="col-sm-4 nopadding">
                <input type="radio" name="nta_wilayah" value="JABODETABEK" class="flat-red" id="nta_wilayah" checked /> <span class="label label-default">Jabodetabek</span> &nbsp;<br>
                <input type="radio" name="nta_wilayah" value="WIL-BANDUNG" class="flat-red" id="nta_wilayah"  /> <span class="label label-primary">Wil-Bandung</span> &nbsp;
              </div>
              <div class="col-sm-4 nopadding">
                <input type="radio" name="nta_wilayah" value="LUAR KOTA" class="flat-red" id="nta_wilayah"  /> <span class="label label-danger">Luar Kota</span> &nbsp;<br>
                <input type="radio" name="nta_wilayah" value="LUAR JAWA" class="flat-red" id="nta_wilayah"  /> <span class="label label-warning">Luar Jawa</span> &nbsp;
              </div>
              <div class="col-sm-4 nopadding">
                <input type="radio" name="nta_wilayah" value="SUBANG" class="flat-red" id="nta_wilayah"  /> <span class="label label-primary">Subang</span> &nbsp;
              </div>
            </div>
          </div>  


     
        </div>

        <div class="col-sm-6">
	  
	<div class="form-group">
           <label for="nta_nomor" class="col-sm-2 control-label">No.Nota</label>
            <div class="field_wrapper col-sm-10">             
              <input type="text" name="nta_nomor" class="form-control" id="nta_nomor" value="" placeholder="No Nota" required>            
            </div>
        </div>

        <div class="form-group">
            <label for="nta_tgl" class="col-sm-2 control-label">Tanggal</label>
            <div class="col-sm-10">
              <div class="input-group">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                  <input type="text" name="nta_tgl" class="form-control pull-right" placeholder="Tanggal Terbitan" id="dpdays" readonly required/>
                </div>
            </div>
          </div>  

        <div class="form-group">
           <label for="nta_daftar" class="col-sm-2 control-label">Daftar</label>
            <div class="field_wrapper col-sm-10">             
              <input type="text" name="nta_daftar" class="form-control" id="nta_daftar" value="" placeholder="Pendaftaran" onKeyPress="return onlyNumbers(event);" required>            
            </div>
        </div>

         <div class="form-group">
           <label for="nta_spb" class="col-sm-2 control-label">SPb</label>
            <div class="field_wrapper col-sm-10">             
              <input type="text" name="nta_spb" class="form-control" id="nta_spb" value="" placeholder="SPB" onKeyPress="return onlyNumbers(event);" required>            
            </div>
        </div>

        <div class="form-group">
           <label for="nta_spp" class="col-sm-2 control-label">SPP</label>
            <div class="field_wrapper col-sm-10">             
              <input type="text" name="nta_spp" class="form-control" id="nta_spp" value="" placeholder="SPP" onKeyPress="return onlyNumbers(event);" required>            
            </div>
        </div>     
                    
          <div class="form-group">
            <label for="nta_keterangan" class="col-sm-2 control-label">Ket</label>
            <div class="col-sm-10">
              <textarea name="nta_keterangan" id="nta_keterangan" class="form-control" rows="1"  placeholder="Keterangan" style="width: 100%; height: 125px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea>
            </div>
          </div>
            
        </div>  
    
        </div>
      </div>
      <div class="modal-footer">
        <button type="submit" name="binputnota" class="btn btn-primary"><i class="fa fa-save"></i></button>
      </div>
      </form>
    </div>
  </div>
</div>

<!-- Modal Filter filternota -->
<div class="modal fade" id="filternota" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header bg-yellow">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel"><i class="fa fa-credit-card"></i> Filter Nota</h4>
      </div>
      <form class="form-horizontal" action="" method="post">
      <div class="modal-body">
        <div class="form-group">
            <label for="priode" class="col-sm-2 control-label">Priode Tgl</label>
            <div class="col-sm-10">
              <div class="input-group">
                      <div class="input-group-addon">
                        <i class="fa fa-calendar"></i>
                      </div>
                      <?php
                      if(!empty($_SESSION['priode1']) && !empty($_SESSION['priode2'])){
                        $data_priode=$_SESSION['priode1']." - ".$_SESSION['priode2'];
                      }else{
                        $data_priode="";
                      }
                      ?>
                      <input type="text" name="priode" value="<?php echo $data_priode;?>" class="form-control pull-right" id="reservation"/>
                    </div><!-- /.input group -->
            </div>
          </div>
        
        <div class="form-group">
            <label for="kwi_wilayah" class="col-sm-2 control-label">Wilayah</label>
            <div class="col-sm-10">
            <?php
              if(!empty($_SESSION['wilayah'])){
                if($_SESSION['wilayah']=="JABODETABEK"){
                  $data_jb="checked";
                }else{
                  $data_jb="";
                }
                if($_SESSION['wilayah']=="WIL-BANDUNG"){
                  $data_wb="checked";
                }else{
                  $data_wb="";
                }
                if($_SESSION['wilayah']=="LUAR KOTA"){
                  $data_lk="checked";
                }else{
                  $data_lk="";
                }
                if($_SESSION['wilayah']=="LUAR JAWA"){
                  $data_lj="checked";
                }else{
                  $data_lj="";
                }
                if($_SESSION['wilayah']=="SUBANG"){
                  $data_sb="checked";
                }else{
                  $data_sb="";
                }
              }else{
                  $data_all1="checked";
              }
              ?>
            
              <div class="col-sm-2 nopadding">
                <input type="radio" name="wilayah" value="" class="flat-red" id="wilayah" <?php echo $data_all1;?> /> <span class="label label-default">ALL</span> &nbsp;
              </div>
              <div class="col-sm-3 nopadding">
                <input type="radio" name="wilayah" value="JABODETABEK" class="flat-red" id="wilayah" <?php echo $data_jb;?> /> <span class="label label-default">Jabodetabek</span> &nbsp;<br>
                <input type="radio" name="wilayah" value="WIL-BANDUNG" class="flat-red" id="wilayah" <?php echo $data_wb;?> /> <span class="label label-primary">Wil-Bandung</span> &nbsp;
              </div>
              <div class="col-sm-3 nopadding">
                <input type="radio" name="wilayah" value="LUAR KOTA" class="flat-red" id="wilayah" <?php echo $data_lk;?> /> <span class="label label-danger">Luar Kota</span> &nbsp;<br>
                <input type="radio" name="wilayah" value="LUAR JAWA" class="flat-red" id="wilayah" <?php echo $data_lj;?> /> <span class="label label-warning">Luar Jawa</span> &nbsp;
              </div>
              <div class="col-sm-4 nopadding">
                <input type="radio" name="wilayah" value="SUBANG" class="flat-red" id="wilayah" <?php echo $data_sb;?> /> <span class="label label-primary">Subang</span> &nbsp;
              </div>
            </div>
          </div>

         <div class="form-group">
            <label for="pts" class="col-sm-2 control-label">Pilih PTS</label>
            <div class="col-sm-10">
              <?php
              if(!empty($_SESSION['pts'])){
                $data_pts=$_SESSION['pts'];
              }else{
                $data_pts="";
              }
              ?>
              <div class="bfh-selectbox" data-name="pts" data-value="<?php echo $data_pts;?>" data-filter="true">
              <div data-value=""></div>
              <?php
              $ktr_tampil=$ktr->ktr_tampil();
              if($ktr_tampil){
              foreach($ktr_tampil as $data){
	    	  if(($data['ktr_id']!=="1")&&($data['ktr_id']!=="2")){
              ?>
              <div data-value="<?php echo $data['ktr_id'];?>"><?php echo $data['ktr_nm'];?></div>
               <?php }}}?>
             </div>
            </div>
           </div>
         
         <div class="form-group">
            <label for="program" class="col-sm-2 control-label">Program</label>
            <div class="col-sm-10">
           	<?php
              if(!empty($_SESSION['program'])){
                if($_SESSION['program']=="P2K"){
                  $data_p2k="checked";
                }else{
                  $data_p2k="";
                }
                if($_SESSION['program']=="REGULER"){
                  $data_reguler="checked";
                }else{
                  $data_reguler="";
                }
              }else{
                $data_all="checked";
              }
              ?>
                <input type="radio" name="program" value="" class="flat-red" id="program" <?php echo $data_all;?> /> <span class="label label-default">ALL</span> &nbsp;
                <input type="radio" name="program" value="P2K" class="flat-red" id="program" <?php echo $data_p2k;?> /> <span class="label label-warning">P2K</span> &nbsp;
                <input type="radio" name="program" value="REGULER" class="flat-red" id="program" <?php echo $data_reguler;?> /> <span class="label label-primary">Reguler</span> &nbsp;
            </div>
           </div>
    
      </div>
      <div class="modal-footer">
        <small class="pull-left text-red"><em><strong>**) Filter sesuai dengan kebutuhan</strong></em></small>
        <button type="submit" name="bfilternota" class="btn btn-warning"><i class="fa fa-search"></i></button>
      </div>
      </form>
    </div>
  </div>
</div>


<!-- Modal Edit Nota -->
<div class="modal fade" id="editnota" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header bg-primary">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel"><i class="fa fa-credit-card"></i> Edit Nota <strong id="ast_nm"></strong></h4>
      </div>
      <form class="form-horizontal" action="" method="post">
      <input type="hidden" name="nta_id" id="nta_id">
      <div class="modal-body">
        
       <div class="row">
        <div class="col-sm-6">

        <div class="form-group">
           <label for="nta_mhs" class="col-sm-2 control-label">Nama</label>
            <div class="field_wrapper col-sm-10">             
              <input type="text" name="nta_mhs" class="form-control" id="nta_mhs" value="" placeholder="Nama Mahasiswa" >            
            </div>
        </div>

        <div class="form-group">
           <label for="nta_angkatan" class="col-sm-2 control-label">Angkatan</label>
            <div class="field_wrapper col-sm-10">             
              <input type="number" name="nta_angkatan" class="form-control" id="nta_angkatan" value="" placeholder="Angkatan" onKeyPress="return onlyNumbers(event);">            
            </div>
        </div>

        <div class="form-group">
           <label for="nta_jurusan" class="col-sm-2 control-label">Jurusan</label>
            <div class="field_wrapper col-sm-10">             
              <input type="text" name="nta_jurusan" class="form-control" id="nta_jurusan" value="" placeholder="Jurusan" >            
            </div>
        </div>

         <div class="form-group">
            <label for="nta_pts" class="col-sm-2 control-label">PTS</label>
            <div class="col-sm-10">
              <select class="form-control" name="nta_pts" id="nta_pts" required>  
              <?php
                  $ktr_tampil=$ktr->ktr_tampil();
                  if($ktr_tampil){
                  foreach($ktr_tampil as $data){
		    if(($data['ktr_id']!=="1")&&($data['ktr_id']!=="2")){
               ?>
              <option value="<?php echo $data['ktr_id']; ?>"><?php echo $data['ktr_nm'];?></option>
              <?php }}}?>  
             </select>
            </div>
           </div>
	 
	 <div class="form-group">
            <label for="nta_program" class="col-sm-2 control-label">Program</label>
            <div class="col-sm-10">
               
                <input type="radio" name="nta_program" value="P2K" class="flat-red" id="nta_program_p" checked /> <span class="label label-warning">P2K</span> &nbsp;
                <input type="radio" name="nta_program" value="REGULER" class="flat-red" id="nta_program_r"  /> <span class="label label-primary">Reguler</span> &nbsp;
                
            </div>   
          </div>
	 
	 <div class="form-group">
            <label for="nta_wilayah" class="col-sm-2 control-label">Wilayah</label>
            <div class="col-sm-10">
              <div class="col-sm-4 nopadding">
                <input type="radio" name="nta_wilayah" value="JABODETABEK" class="flat-red" id="nta_wilayah_jb" checked /> <span class="label label-default">Jabodetabek</span> &nbsp;<br>
                <input type="radio" name="nta_wilayah" value="WIL-BANDUNG" class="flat-red" id="nta_wilayah_wb"  /> <span class="label label-primary">Wil-Bandung</span> &nbsp;
              </div>
              <div class="col-sm-4 nopadding">
                <input type="radio" name="nta_wilayah" value="LUAR KOTA" class="flat-red" id="nta_wilayah_lk"  /> <span class="label label-danger">Luar Kota</span> &nbsp;<br>
                <input type="radio" name="nta_wilayah" value="LUAR JAWA" class="flat-red" id="nta_wilayah_lj"  /> <span class="label label-warning">Luar Jawa</span> &nbsp;
              </div>
              <div class="col-sm-4 nopadding">
                <input type="radio" name="nta_wilayah" value="SUBANG" class="flat-red" id="nta_wilayah_sb"  /> <span class="label label-primary">Subang</span> &nbsp;
              </div>
            </div>
          </div>  

     
        </div>

        <div class="col-sm-6">
	  
	<div class="form-group">
           <label for="nta_nomor" class="col-sm-2 control-label">No.Nota</label>
            <div class="field_wrapper col-sm-10">             
              <input type="text" name="nta_nomor" class="form-control" id="nta_nomor" value="" placeholder="No Nota" required>            
            </div>
        </div>

        <div class="form-group">
            <label for="nta_tgl" class="col-sm-2 control-label">Tanggal</label>
            <div class="col-sm-10">
              <div class="input-group">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                  <input type="text" name="nta_tgl" class="nta_tgl form-control pull-right" placeholder="Tanggal Terbitan" id="dpdays2" readonly required/>
                </div>
            </div>
          </div>  

        <div class="form-group">
           <label for="nta_daftar" class="col-sm-2 control-label">Daftar</label>
            <div class="field_wrapper col-sm-10">             
              <input type="text" name="nta_daftar" class="form-control" id="nta_daftar" value="" placeholder="Pendaftaran" onKeyPress="return onlyNumbers(event);" required>            
            </div>
        </div>

         <div class="form-group">
           <label for="nta_spb" class="col-sm-2 control-label">SPb</label>
            <div class="field_wrapper col-sm-10">             
              <input type="text" name="nta_spb" class="form-control" id="nta_spb" value="" placeholder="SPB" onKeyPress="return onlyNumbers(event);" required>            
            </div>
        </div>

        <div class="form-group">
           <label for="nta_spp" class="col-sm-2 control-label">SPP</label>
            <div class="field_wrapper col-sm-10">             
              <input type="text" name="nta_spp" class="form-control" id="nta_spp" value="" placeholder="SPP" onKeyPress="return onlyNumbers(event);" required>            
            </div>
        </div>
      
                    
          <div class="form-group">
            <label for="nta_keterangan" class="col-sm-2 control-label">Ket</label>
            <div class="col-sm-10">
              <textarea name="nta_keterangan" id="nta_keterangan" class="form-control" rows="1"  placeholder="Keterangan" style="width: 100%; height: 125px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea>
            </div>
          </div>
            
        </div>  
    
        </div>
      </div>
      <div class="modal-footer">
        <button type="submit" name="beditnota" class="btn btn-primary"><i class="fa fa-save"></i></button>
      </div>
      </form>
    </div>
  </div>
</div>