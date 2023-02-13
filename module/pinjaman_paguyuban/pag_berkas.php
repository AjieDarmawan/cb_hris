<?php require('module/kpi/kpi_act.php'); ?>
<?php

$p1_readonly = "readonly"; //readonly
$p2_readonly = "readonly"; //readonly
$p3_readonly = "readonly"; //readonly
$p1_disabled = "disabled"; //disabled
$p2_disabled = "disabled"; //disabled
$p3_disabled = "disabled"; //disabled
$p3_ditetapkan = "";
$p3_tanggal = "readonly";

if($kpi_cek_id > 0){
  
if($kpi_data_id['kpi_sts']=='A'){
  $p3_readonly = "";
  $p3_disabled = "";
}else{
  $p3_readonly = "readonly";
  $p3_disabled = "disabled";
  $p3_ditetapkan = "disabled";
}

?>
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
        <section class="invoice col-xs-7">
          <!-- title row -->
          <div class="row">
            <div class="col-xs-12">
              <h2 class="page-header">
                <img src="dist/img/logo_gg_small130.JPG" width="80"> PT. Gilland Ganesha
                <small class="pull-right">
		  <br>
		  <?php
                  if($kpi_data_id['kpi_tanggal']!=="0000-00-00"){
                    $kpi_tgl_="<strong>Date: </strong> ".$tgl->tgl_indo($kpi_data_id['kpi_tanggal']);
                  }else{
                    $kpi_tgl_="";
                  }
                  echo $kpi_tgl_;
                  ?>
		</small>
                <center><small>Jl. Raya Bogor Km 47,5 Perum Bumi Sentosa Blok A3 No.3, Nanggewer Cibinong, Jawa Barat 16912.</small></center>
              </h2>
            </div><!-- /.col -->
          </div>
          <!-- info row -->
          <div class="row invoice-info">
          <center><h3><u>KEY PERFORMANCE INDICATOR</u></h3>
          Nomor Surat&nbsp;&nbsp;<b> <?php echo $kpi_data_id['kpi_kd'];?></b><br/><br/><br/></center>
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
                Priode Kontrak: <strong><?php echo $kpi_data_id['kpi_kontrak'];?></strong><br>
                <br>
                Priode Penilaian: <strong><?php echo $kpi_data_id['kpi_priode'];?></strong><br>
              </address>
            </div><!-- /.col -->
          </div><!-- /.row -->

          <!-- Table row -->
          <div class="row">
            <div class="col-xs-12 table-responsive">
	      <input type="hidden" id="kar_nik" value="<?php echo $kar_data_['kar_nik']; ?>">
                <table class="table table-striped table-bordered table-condensed">
                    <thead>
                        <tr>
                            <th rowspan="2" style="vertical-align: middle;text-align: center">NO</th>
                            <th rowspan="2" colspan="2" style="vertical-align: middle;text-align: center">SASARAN</th>
                            <th rowspan="2" style="vertical-align: middle;text-align: center">BOBOT</th>
                            <th rowspan="2" style="vertical-align: middle;text-align: center">TARGET</th>
                            <th colspan="2" style="text-align: center">AKTUAL</th>
                        </tr>
                        <tr>
                            <th style="text-align: center">PENILAI 1</th>
                            <th style="text-align: center">PENILAI 2</th>
                        </tr>
                    </thead>
		      <tbody>
			  <?php
			  $no=1;
			  $exp1 = explode('||',$kpi_data_id['kpi_data']);
                          for($i=0;$i<count($exp1);$i++){
                            $exp2 = explode('@%',$exp1[$i]);

                            $kps_kd = $exp2[1];
                            $kpi_sasaran_kode = $kpi->kpi_sasaran_kode($kps_kd);
                            $kpi_sasaran_data = mysql_fetch_array($kpi_sasaran_kode);
                            
			  ?>
			  <tr>
			      <td><?php echo $no;?></td>
			      <td><?php echo $exp2[0];?></td>
			      <td><?php echo $exp2[2];?></td>
			      <td style="text-align: right"><?php echo $kpi_sasaran_data['kps_bobot'];?></td>
			      <td style="text-align: right"><?php echo $kpi_sasaran_data['kps_target'];?></td>
			      <td style="text-align: right"><?php echo $exp2[4];?></td>
			      <td style="text-align: right"><?php echo $exp2[5];?></td>
			  </tr>
			  <?php $no++; }?>
		      </tbody>
                </table>
            </div><!-- /.col -->
          </div><!-- /.row -->

          <div class="row">
            <!-- accepted payments column -->
            <div class="col-xs-4">
	      <strong>Penilai 1:</strong>
              <br>
                <?php
                $kpi_penilai_=$kpi_data_id['kpi_penilai1'];
                $kpi_tampil_penilai=$kar->kar_tampil_id($kpi_penilai_);
                $kpi_data_penilai=mysql_fetch_array($kpi_tampil_penilai);
                echo $kpi_data_penilai['kar_nm'];
                ?>
	      <br><br>
              	
	      <strong>Penilai 2 & 3:</strong>
                <br>
		 <?php
                $kpi_mengetahui_=$kpi_data_id['kpi_penilai2'];
                $kpi_tampil_mengetahui=$kar->kar_tampil_id($kpi_mengetahui_);
                $kpi_data_mengetahui=mysql_fetch_array($kpi_tampil_mengetahui);
		
                $kpi_mengetahui2_=$kpi_data_id['kpi_penilai3'];
                $kpi_tampil_mengetahui2=$kar->kar_tampil_id($kpi_mengetahui2_);
                $kpi_data_mengetahui2=mysql_fetch_array($kpi_tampil_mengetahui2);
		
		echo $kpi_data_mengetahui['kar_nm'];
                echo "<br>";
                echo $kpi_data_mengetahui2['kar_nm'];
                ?>
	      <br>
            </div><!-- /.col -->
	    
            <div class="col-xs-4">
	      
	      <?php if($kpi_data_id['kpi_jenis']==1){?>
	      
              <strong>Ditetapkan: (PENILAI 3)</strong>
              <div class="table-responsive">
	      
		<?php
		if($kpi_data_id['kpi_ditetapkan'] == "..."){
		  echo "<strong class='text-blue'>".$kpi_data_id['kpi_saranperbaikan']."</strong>";
		}else{
		  echo "<strong class='text-blue'>".$kpi_data_id['kpi_ditetapkan']."</strong>";
		}
		?>

              </div>
	      
	      <?php }?>
	      
            </div><!-- /.col -->

	    <div class="col-xs-4">
	      <strong>Reward:</strong>
              <br>
                <?php echo "<strong class='text-red'>".$kpi_data_id['kpi_sts_reward']."</strong>";?>
	      <br><br>
              	
	      <strong>Skor:</strong>
                <br>
		<?php
		if(!empty($kpi_data_id['kpi_sts_skor'])){
		  $sts_skor = "(".$kpi_data_id['kpi_sts_skor'].")";
		}else{
		  $sts_skor = "";
		}
		
		echo "<strong class='text-green'>".$kpi_data_id['kpi_skor']." ".$sts_skor."</strong>";
		?>
	      <br>
            </div><!-- /.col -->
	    
          </div><!-- /.row -->
	  <br>
	  <!-- info row -->
	  <?php if(!empty($kpi_data_id['kpi_lampiran'])){?>
          <div class="row">
	    <div class="col-xs-12">
	      <strong>Lampiran:</strong>
                <br>
	    <?php
	      $hascomma = false;
	      $exp_lampiran1 = explode(',',$kpi_data_id['kpi_lampiran']);
	      for($i=0;$i<count($exp_lampiran1);$i++){
		$exp_lampiran2 = explode('#',$exp_lampiran1[$i]);
		if($hascomma){
		  echo ", ";
		}
		echo "<a href='".$exp_lampiran2[1]."' target='_blank'><span class='label label-warning'><i class='fa fa-file-o'></i> ".$exp_lampiran2[0]."</span></a>";
		
		$hascomma = true;
	      }
            ?>
	    </div>
          </div><!-- /.row -->
	  <?php }?>
	  
          <!-- this row will not appear when printing -->
	  
	<br>
          <div class="row no-print">
            <div class="col-xs-12">
              <?php if($kpi_data_id['kpi_sts']=="A"){?>
              <a href="print_kpi.php?to=prt&id=<?php echo md5($kpi_data_id['kpi_kd']); ?>" target="_blank" class="btn btn-default"><i class="fa fa-print"></i> Print</a>
              <div class="pull-right">
                <button name="bapproved" id="bapproved" class="btn btn-success pull-right" disabled><i class="fa fa-thumbs-up"></i> Approved</button>
              </div>
              <?php }?>
            </div>
          </div>
	  
        </section><!-- /.content -->
        <div class="clearfix"></div>
  </form>
    
<!--
    </div>
    </div>    -->
<?php }else{ echo"<script>document.location='?p=not_found';</script>";}?>