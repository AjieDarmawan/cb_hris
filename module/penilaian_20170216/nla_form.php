<?php require('module/penilaian/nla_act.php'); ?>
<?php if($fpk_cek_id > 0){?>
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
                Gaji Terakhir: Rp. <strong><?php echo $rph->format_rupiah($fpk_data_id['fpk_gaji']);?></strong><br>
              </address>
            </div><!-- /.col -->
          </div><!-- /.row -->

          <!-- Table row -->
          <div class="row">
            <div class="col-xs-12 table-responsive">
        
                            
                            <table class="table table-striped">
			<tbody>
			  
			  <?php
			  $fpk_tampil_point=$nla->fpk_tampil_point_all();
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
                    <?php echo $fpk_data_id['fpk_saran'] ? : "-"; ?>
	      
            </div><!-- /.col -->
          </div><!-- /.row -->
	  
          <!-- this row will not appear when printing -->
	  
	<br>
          <div class="row no-print">
            <div class="col-xs-12">
              <a href="print_nla.php?to=prt&id=<?php echo md5($fpk_data_id['fpk_kd']); ?>" target="_blank" class="btn btn-default"><i class="fa fa-print"></i> Print</a>
              <!--<button class="btn btn-success pull-right"><i class="fa fa-credit-card"></i> Submit Payment</button>-->
              <div class="pull-right">
              <a href="print_pdf.php?to=pdf&id=<?php echo md5($fpk_data_id['fpk_kd']); ?>" class="btn btn-primary" target="_blank"><i class="fa fa-download"></i> Generate PDF</a>
              </div>
            </div>
          </div>
	  
        </section><!-- /.content -->
        <div class="clearfix"></div>
  </form>      
<!--
    </div>
    </div>    -->

<?php }else{ echo"<script>document.location='?p=not_found';</script>";}?>