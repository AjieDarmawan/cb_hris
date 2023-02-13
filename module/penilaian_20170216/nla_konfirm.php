<?php require('module/penilaian/nla_act.php'); ?>
<?php if($fpk_cek_id > 0 && $fpk_cek_konfirm > 0){?>
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
        <section class="invoice col-xs-6">
          <!-- title row -->
          <div class="row">
            <div class="col-xs-12">
              <h2 class="page-header">
                <img src="dist/img/logo_gg_small130.JPG" width="80"> PT. Gilland Ganesha
                <small class="pull-right">
		  <br>
                  <?php
                  if($fpk_data_id['fpk_tgl']!=="0000-00-00"){
                    $fpk_tgl_="<strong>Date: </strong> ".$tgl->tgl_indo($fpk_data_id['fpk_tgl']);
                  }else{
                    $fpk_tgl_="";
                  }
                  echo $fpk_tgl_;
                  ?>
		</small>
                <center><small>Jl. Raya Bogor Km 47,5 Perum Bumi Sentosa Blok A3 No.3, Nanggewer Cibinong, Jawa Barat 16912.</small></center>
              </h2>
            </div><!-- /.col -->
          </div>
          <!-- info row -->
          <div class="row invoice-info">
          <center><h3><u>FORM PENILAIAN KERJA</u></h3>
          Nomor Surat&nbsp;&nbsp;<b> <?php echo $new_kd;?></b><br/><br/><br/></center>
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
                             $i=$fpk_data_point['fpk_point_id'];
                             $x = "fpk_nilai{$i}";
                             
                             if($fpk_data_id[$x]!=="0"){
                                $fpk_bobot=$fpk_data_id[$x];
                             }else{
                                $fpk_bobot="-";
                             }
                             
                             $fpk_grade=$fpk_data_id[$x];
                             $fpk_tampil_grade=$nla->fpk_tampil_grade($fpk_grade);
                             $fpk_data_grade=mysql_fetch_array($fpk_tampil_grade);
                             
			  ?>  
			  <tr>
			    <td><i class="fa fa-check-square-o"></i></td>
			    <td><?php echo $fpk_data_point['fpk_point_nm']; ?></td>
			    <td><?php echo $fpk_data_grade['fpk_huruf'];?></td>
			    <td><?php echo $fpk_bobot;?></td>
                            <td><small><?php echo $fpk_data_grade['fpk_lable'];?></small></td>
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
            <div class="col-xs-4">

	      <strong>Team Penilai:</strong>
                <br>
		<?php
                $fpk_penilai_=$fpk_data_id['fpk_penilai'];
                $fpk_tampil_penilai=$kar->kar_tampil_id($fpk_penilai_);
                $fpk_data_penilai=mysql_fetch_array($fpk_tampil_penilai);
                echo $fpk_data_penilai['kar_nm'];
                ?>
	      <br>
            </div><!-- /.col -->
            <div class="col-xs-4">

	      <strong>Mengetahui:</strong>
                <br>
		 <?php
                $fpk_mengetahui_=$fpk_data_id['fpk_mengetahui'];
                $fpk_tampil_mengetahui=$kar->kar_tampil_id($fpk_mengetahui_);
                $fpk_data_mengetahui=mysql_fetch_array($fpk_tampil_mengetahui);
                echo $fpk_data_mengetahui['kar_nm'];
                ?>
	      <br>
            </div><!-- /.col -->
            <div class="col-xs-4">
              <strong>Ditetapkan: </strong><em><small>(Hanya Karyawan Kontrak)</small></em>
                <br>
		 <?php echo $fpk_data_id['fpk_ditetapkan'] ? : "-"; ?>
	      <br>
            </div><!-- /.col -->
          </div><!-- /.row -->
	  <br>
	  <!-- info row -->
          <div class="row invoice-info">
            <div class="col-sm-4 invoice-col">
              <i class="fa fa-check-square-o"></i> Prestasi<br>
                    <?php echo $fpk_data_id['fpk_prestasi'] ? : "-"; ?>
              
            </div><!-- /.col -->
            <div class="col-sm-4 invoice-col">
              <i class="fa fa-check-square-o"></i> Pelanggaran<br>
                    <?php echo $fpk_data_id['fpk_pelanggaran'] ? : "-"; ?>
              
            </div><!-- /.col -->
            <div class="col-sm-4 invoice-col">
              <i class="fa fa-check-square-o"></i> Saran<br>
                    <?php echo $fpk_data_id['fpk_saranperbaikan'] ? : "-"; ?>
	      
            </div><!-- /.col -->
          </div><!-- /.row -->
	  
          <!-- this row will not appear when printing -->

	  
	<br>
          <div class="row no-print">
            <div class="col-xs-12">
              <!--<a href="invoice-print.html" target="_blank" class="btn btn-default"><i class="fa fa-print"></i> Print</a>
              <button class="btn btn-danger pull-right"><i class="fa fa-ban"></i> Ignore</button>-->
	      <?php
	      if(!empty($fpk_data_id['fpk_konfirm'])){
		  $pecah1= explode("||",$fpk_data_id['fpk_konfirm']);	  
		  $hitung= count($pecah1);
		  for($j=0;$j<$hitung;$j++){		  
		    $pecah2= explode(";",$pecah1[$j]);		  
		    $idkonfirm= $pecah2[0];		  
		    $stskonfirm= $pecah2[1];
		    
		    if($idkonfirm == $kar_id){
		      
		      if($stskonfirm == 'Y'){
	      ?>
              <button type="submit" name="bmengetahui" class="btn btn-success pull-right" style="margin-right: 5px;" disabled><i class="fa fa-thumbs-up"></i> Menyetujui</button>
	      <?php }else{?>
	      <button type="submit" name="bmengetahui" class="btn btn-success pull-right" style="margin-right: 5px;"><i class="fa fa-thumbs-up"></i> Menyetujui</button>
	      <?php }}else{?>
	      <button type="submit" name="bmengetahui" class="btn btn-success pull-right" style="margin-right: 5px;display: none;"><i class="fa fa-thumbs-up"></i> Menyetujui</button>
	      <?php }}}?>
	    </div>
          </div>
	  
        </section><!-- /.content -->
        <div class="clearfix"></div>
  </form>      
<!--
    </div>
    </div>    -->
<?php }else{ echo"<script>document.location='?p=not_found';</script>";}?>