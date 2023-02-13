<?php require('module/penilaian/nla_act.php'); ?>
<?php if($fpk_cek_id > 0 && $kar_id==$fpk_data_id['fpk_penilai']){?>
<!-- Content Header (Page header) -->
    <section class="content-header">
      <h1> <?php echo $title ." - ". $kar_data_['kar_nm'];?> <small></small> </h1>
      <ol class="breadcrumb">
        <li><a href="media.php"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li class="active"><?php echo $title;?></li>
      </ol>
    </section>
    <!--
    <div class="row">
    <div class="col-xs-6">-->
    <form class="form-horizontal" action="" method="post">
      <!-- Main content -->
        <section class="invoice col-md-6">
          <!-- title row -->
          <div class="row">
            <div class="col-xs-12">
              <h2 class="page-header">
                <img src="dist/img/logo_gg_small130.JPG" width="80"> PT. Gilland Ganesha
                <small class="pull-right">
		  <br>
		  <div class="form-group">
		    <label for="fpk_tgl" class="col-sm-2 control-label">Date</label>
		    <div class="col-sm-10">
		      <input type="text" name="fpk_tgl" class="form-control" id="fpk_tgl" value="<?php echo $fpk_data_id['fpk_tgl'];?>" placeholder="Tanggal Penilaian" data-inputmask="'alias': 'yyyy-mm-dd'" data-mask style="width:182;" required <?php echo $disabled;?>>
		    </div>
		  </div>
		</small>
                <center><small>Jl. Raya Bogor Km 47,5 Perum Bumi Sentosa Blok A3 No.3, Nanggewer Cibinong, Jawa Barat 16912.</small></center>
              </h2>
            </div><!-- /.col -->
          </div>
          <!-- info row -->
          <div class="row invoice-info">
          <center><h3><u>FORM PENILAIAN KERJA</u></h3>
          Nomor Surat&nbsp;&nbsp;<b> <?php echo $fpk_data_id['fpk_kd'];?></b><br/><br/><br/></center>
            <div class="col-sm-8 invoice-col">
              <address>
                <strong><?php echo $kar_data_['kar_nm'];?></strong><br>
                NIK: <?php echo $kar_data_['kar_nik'];?><br>
                Divisi: <?php echo $kar_data_['div_nm'];?> / <?php echo $kar_data_['jbt_nm'];?><br>
                Location: <?php echo $kar_data_['unt_nm'];?> / <?php echo $kar_data_['ktr_nm'];?><br>
              </address>
            </div><!-- /.col -->
            
            <div class="col-sm-4 invoice-col">
              <address>
                <br>
                Priode Penilaian: <strong><?php echo $fpk_data_id['fpk_priode'];?></strong><br>
                <br>
                Gaji Terakhir: Rp. <strong><?php echo $fpk_data_id['fpk_gaji']? $rph->format_rupiah($fpk_data_id['fpk_gaji']) : '-';?></strong><br>
              </address>
            </div><!-- /.col -->
          </div><!-- /.row -->

          <!-- Table row -->
          <div class="row">
            <div class="col-xs-12 table-responsive">
	      
	       <div class="panel-group" id="accordion">
		<?php
		$fpk_tampil_asp=$nla->fpk_tampil_asp();
                while($fpk_data_asp=mysql_fetch_array($fpk_tampil_asp)){
		  if($fpk_data_asp['fpk_asp_nm']=="Aspek Teknis"){
		    $in="in";
		  }else{
		    $in="";
		  }
		?>  
		<div class="panel panel-default">
		  <div class="panel-heading">
		    <h4 class="panel-title">
		      <a data-toggle="collapse" data-parent="#accordion" href="#aspek<?php echo $fpk_data_asp['fpk_asp_id']; ?>">
		      <?php echo $fpk_data_asp['fpk_asp_nm']; ?>
		      <div class="pull-right"><i class="fa fa-chevron-down"></i></div></a>
		    </h4>
		  </div>
		  <div id="aspek<?php echo $fpk_data_asp['fpk_asp_id']; ?>" class="panel-collapse collapse <?php echo $in; ?>">
		    <div class="panel-body">
		      
		      <table class="table table-striped">
			<tbody>
			  
			  <?php
			  $fpk_asp_id=$fpk_data_asp['fpk_asp_id'];
			  $fpk_tampil_point=$nla->fpk_tampil_point($fpk_asp_id);
			  while($fpk_data_point=mysql_fetch_array($fpk_tampil_point)){
			    
			    $x = "fpk_nilai".$fpk_data_point['fpk_point_id'];
			    $fpk_data_id[$x];
			  ?>  
			  <tr>
			    <td><i class="fa fa-check-square-o"></i></td>
			    <td><?php echo $fpk_data_point['fpk_point_nm']; ?></td>
			    <td>
			      <select class="form-control" name="fpk_huruf<?php echo $fpk_data_point['fpk_point_id'];?>" id="fpk_huruf<?php echo $fpk_data_point['fpk_point_id'];?>" style="width:60px;" required <?php echo $disabled;?>>
			      <?php
			        if($fpk_data_id[$x] !== "0"){
				$huruf=array(
					      "A" => 'A',
					      "B" => 'B',
					      "C" => 'C',
					      "D" => 'D'
					      );
				foreach($huruf as $value => $caption) {
				  
				  if($fpk_data_id[$x]=="10" || $fpk_data_id[$x]=="9"){
				      $fpk_huruf="A";
				  }elseif($fpk_data_id[$x]=="8" || $fpk_data_id[$x]=="7"){
				      $fpk_huruf="B";
				  }
				  elseif($fpk_data_id[$x]=="6" || $fpk_data_id[$x]=="5" || $fpk_data_id[$x]=="4"){
				      $fpk_huruf="C";
				  }
				  elseif($fpk_data_id[$x]=="3" || $fpk_data_id[$x]=="2" || $fpk_data_id[$x]=="1"){
				      $fpk_huruf="D";
				  }
				  
				  if($value==$fpk_huruf){
				    $pilih="selected";
				  }else{
				    $pilih="";
				  }
			      ?>
			      <option value="<?php echo $value; ?>" <?php echo $pilih; ?>><?php echo $caption; ?></option>
			      <?php }}else{?>
			      <option value="" selected></option>
			      <?php
				$huruf=array(
					      "A" => 'A',
					      "B" => 'B',
					      "C" => 'C',
					      "D" => 'D'
					      );
				foreach($huruf as $value => $caption) {
			      ?>
			      <option value="<?php echo $value; ?>" <?php echo $pilih; ?>><?php echo $caption; ?></option>
			      <?php }}?>
			    </select>
			    </td>
			    <td>
			      <select class="form-control" name="fpk_nilai<?php echo $fpk_data_point['fpk_point_id'];?>" id="fpk_nilai<?php echo $fpk_data_point['fpk_point_id'];?>" required <?php echo $disabled;?>>
				<?php
				if($fpk_data_id[$x] !== "0"){
				  
				  if($fpk_data_id[$x]=="10" || $fpk_data_id[$x]=="9"){
				      $fpk_huruf="A";
				  }elseif($fpk_data_id[$x]=="8" || $fpk_data_id[$x]=="7"){
				      $fpk_huruf="B";
				  }
				  elseif($fpk_data_id[$x]=="6" || $fpk_data_id[$x]=="5" || $fpk_data_id[$x]=="4"){
				      $fpk_huruf="C";
				  }
				  elseif($fpk_data_id[$x]=="3" || $fpk_data_id[$x]=="2" || $fpk_data_id[$x]=="1"){
				      $fpk_huruf="D";
				  }
				  
				$fpk_tampil_bobot_all=$nla->fpk_tampil_bobot_all($fpk_huruf);
				foreach($fpk_tampil_bobot_all as $data){	
							if($fpk_data_id[$x]==$data['fpk_bobot_angka']){
				?>
				<option value="<?php echo $data['fpk_bobot_angka']; ?>" selected><?php echo $data['fpk_bobot_angka']; ?></option>
				<?php
							}else{
							?>
				<option value="<?php echo $data['fpk_bobot_angka']; ?>"><?php echo $data['fpk_bobot_angka']; ?></option>
				<?php }}}else{?>
				<option value="" selected></option>
				<?php }?>
			      </select>
			    </td>
			  </tr>
			  <?php }?>
			 
			</tbody>
		      </table>
		      
		    </div>
		  </div>
		</div>
		<?php }?>
	      </div> 
	      
              
            </div><!-- /.col -->
          </div><!-- /.row -->

          <div class="row">
            <!-- accepted payments column -->
            <div class="col-xs-6">
	      <p class="lead">Team Penilai:
              <br>
                <?php
                $fpk_penilai_=$fpk_data_id['fpk_penilai'];
                $fpk_tampil_penilai=$kar->kar_tampil_id($fpk_penilai_);
                $fpk_data_penilai=mysql_fetch_array($fpk_tampil_penilai);
                echo $fpk_data_penilai['kar_nm'];
                ?>
	      <br>
              </p>
              	
	      <strong>Mengetahui:</strong>
                <br>
		 <?php
                $fpk_mengetahui_=$fpk_data_id['fpk_mengetahui'];
                $fpk_tampil_mengetahui=$kar->kar_tampil_id($fpk_mengetahui_);
                $fpk_data_mengetahui=mysql_fetch_array($fpk_tampil_mengetahui);
                
				$fpk_mengetahui2_=$fpk_data_id['fpk_mengetahui2'];
                $fpk_tampil_mengetahui2=$kar->kar_tampil_id($fpk_mengetahui2_);
                $fpk_data_mengetahui2=mysql_fetch_array($fpk_tampil_mengetahui2);
				
				$fpk_mengetahui3_=$fpk_data_id['fpk_mengetahui3'];
                $fpk_tampil_mengetahui3=$kar->kar_tampil_id($fpk_mengetahui3_);
                $fpk_data_mengetahui3=mysql_fetch_array($fpk_tampil_mengetahui3);
		
				echo $fpk_data_mengetahui2['kar_nm'];
				
				if(!empty($fpk_data_mengetahui2['kar_nm'])){
				  echo "<br>";
				}
				
                echo $fpk_data_mengetahui['kar_nm'];
				
				if(!empty($fpk_data_mengetahui['kar_nm'])){
				  echo "<br>";
				}
				echo $fpk_data_mengetahui3['kar_nm'];
                ?>
	      <br>
            </div><!-- /.col -->
            <div class="col-xs-6">
              <p class="lead">Ditetapkan: <em><small><strong>(Hanya Karyawan Kontrak)</strong></small></em></p>
              <div class="table-responsive">
	      
		      <?php
			if($fpk_data_id['fpk_priode']=="Eva.Akhir" || $fpk_data_id['fpk_priode']=="Eva.KPI"){
			  $huruf=array(
					"Untuk Tidak Diperpanjang" => 'Untuk Tidak Diperpanjang',
					"Karyawan Tetap" => 'Karyawan Tetap'
					);
			}else{
			  $huruf=array(
					"Untuk Tidak Diperpanjang" => 'Untuk Tidak Diperpanjang',
					"Diperpanjang 6 Bulan" => 'Diperpanjang 6 Bulan',
					"Diperpanjang 1 Tahun" => 'Diperpanjang 1 Tahun',
					"Karyawan Tetap" => 'Karyawan Tetap'
					);
			}
			
			foreach($huruf as $value => $caption) {
			  
				    if($fpk_data_id['fpk_ditetapkan']==$value){
		      ?>
		      <input type="radio" name="fpk_ditetapkan" value="<?php echo $value;?>" class="flat-red" id="fpk_ditetapkan" checked <?php echo $nonaktif;?>/> <?php echo $caption;?><br>
		      <?php }else{?>
		      <input type="radio" name="fpk_ditetapkan" value="<?php echo $value;?>" class="flat-red" id="fpk_ditetapkan" <?php echo $nonaktif;?>/> <?php echo $caption;?><br>
		      <?php }}?> 

              </div>
            </div><!-- /.col -->
          </div><!-- /.row -->
	  <br>
	  <!-- info row -->
          <div class="row invoice-info">
            <div class="col-sm-4 invoice-col">
              <i class="fa fa-check-square-o"></i> Prestasi
	      <textarea name="fpk_prestasi" class="form-control" required <?php echo $disabled;?>><?php echo $fpk_data_id['fpk_prestasi']; ?></textarea>
              
            </div><!-- /.col -->
            <div class="col-sm-4 invoice-col">
              <i class="fa fa-check-square-o"></i> Pelanggaran
	      <textarea name="fpk_pelanggaran" class="form-control" required <?php echo $disabled;?>><?php echo $fpk_data_id['fpk_pelanggaran']; ?></textarea>
              
            </div><!-- /.col -->
            <div class="col-sm-4 invoice-col">
              <i class="fa fa-check-square-o"></i> Saran
	      <textarea name="fpk_saranperbaikan" class="form-control" required <?php echo $disabled;?>><?php echo $fpk_data_id['fpk_saranperbaikan']; ?></textarea>
	      
            </div><!-- /.col -->
          </div><!-- /.row -->
	  
          <!-- this row will not appear when printing -->
	  
	<br>
          <div class="row no-print">
            <div class="col-xs-12">
              <!--<a href="invoice-print.html" target="_blank" class="btn btn-default"><i class="fa fa-print"></i> Print</a>-->
              <button name="bsendupdate" class="btn btn-success pull-right <?php echo $disabled;?>"><i class="fa fa fa-send"></i> Simpan & Kirim</button>
              <!--<button name="bupdate" class="btn btn-primary pull-right <?php echo $disabled;?>" style="margin-right: 5px;"><i class="fa fa-save"></i> Hanya Simpan</button>-->
            </div>
          </div>
	  
        </section><!-- /.content -->
        <div class="clearfix"></div>
  </form>      
<!--
    </div>
    </div>    -->
<?php }else{ echo"<script>document.location='?p=not_found';</script>";}?>