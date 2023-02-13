<?php
error_reporting(E_ALL ^ E_NOTICE);
date_default_timezone_set('Asia/Jakarta');
session_start();

ini_set('max_execution_time', 300); 

require('class.php');
require('object.php');

$db->koneksi();

$date=date('Y-m-d');

require('module/penilaian/nla_act.php'); 

if($fpk_cek_id > 0){

//ob_start();

$title=$fpk_data_id['fpk_kd'];  

?>

<?php include('component/tag_head.php'); ?>

<script type="text/javascript">
  window.print();
</script>


	 <!-- Main content -->
            <section class="invoice col-xs-6">
          <!-- title row -->
          <div class="row">
            <div class="col-xs-12">
              <h2 class="page-header">
                <img src="dist/img/logo_gg_small130.JPG" width="80"> PT. Gilland Ganesha
                <small class="pull-right" style="font-size:12px;">
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
                <center style="font-size:12px;">Jl. Raya Bogor Km 47,5 Perum Bumi Sentosa Blok A3 No.3, Nanggewer Cibinong, Jawa Barat 16912.</center>
              </h2>
            </div><!-- /.col -->
          </div>
          <!-- info row -->
          <div class="row invoice-info">
          <center><h4><u>FORM PENILAIAN KERJA</u></h4>
          Nomor Surat&nbsp;&nbsp;<b> <?php echo $fpk_data_id['fpk_kd'];?></b><br/><br/><br/></center>
            <div class="col-sm-6 invoice-col" style="font-size:12px;">
              <address>
                <strong><?php echo $kar_data__['kar_nm'];?></strong><br>
                NIK: <?php echo $kar_data__['kar_nik'];?><br>
                Divisi: <?php echo $kar_data__['div_nm'];?> / <?php echo $kar_data__['jbt_nm'];?><br>
                Location: <?php echo $kar_data__['unt_nm'];?> / <?php echo $kar_data__['ktr_nm'];?><br>
              </address>
            </div><!-- /.col -->
	    
	    <div class="col-sm-2 invoice-col" style="font-size:12px;">
              <address>
		&nbsp;
	      </address>
            </div><!-- /.col -->
            
            <div class="col-sm-4 invoice-col" style="font-size:12px;">
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
        
                            
                            <table class="table table-striped table-condensed" style="font-size:12px;">
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
            <div class="col-xs-4" style="font-size:12px;">

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
            <div class="col-xs-4" style="font-size:12px;">

	      <strong>Mengetahui:</strong>
                <br>
		 <?php
                $fpk_mengetahui_=$fpk_data_id['fpk_mengetahui'];
                $fpk_tampil_mengetahui=$kar->kar_tampil_id($fpk_mengetahui_);
                $fpk_data_mengetahui=mysql_fetch_array($fpk_tampil_mengetahui);
				
				$fpk_mengetahui_2=$fpk_data_id['fpk_mengetahui2'];
                $fpk_tampil_mengetahui2=$kar->kar_tampil_id($fpk_mengetahui_2);
                $fpk_data_mengetahui2=mysql_fetch_array($fpk_tampil_mengetahui2);
				
				$fpk_mengetahui_3=$fpk_data_id['fpk_mengetahui3'];
                $fpk_tampil_mengetahui3=$kar->kar_tampil_id($fpk_mengetahui_3);
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
            <div class="col-xs-4" style="font-size:12px;">
              <strong>Ditetapkan: </strong><em><small>(Hanya Karyawan Kontrak)</small></em>
                <br>
		 <?php echo $fpk_data_id['fpk_ditetapkan'] ? : "-"; ?>
	      <br>
            </div><!-- /.col -->
          </div><!-- /.row -->
	  <br>
	  <!-- info row -->
          <div class="row invoice-info" style="font-size:12px;">
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
	  
        </section><!-- /.content -->
        <div class="clearfix"></div>

<?php include('component/tag_js.php'); ?>   

<?php
/*
  $content = ob_get_clean();
  require_once('plugins/html2pdf/html2pdf.class.php');
  try
  {

      $html2pdf = new HTML2PDF('P','A4','en', false, 'ISO-8859-15', array(mL, mT, mR, mB));
  
      $html2pdf->setDefaultFont('Arial');
      $html2pdf->writeHTML($content, false);
      
      $html2pdf->Output('SURAT_PENGAJUAN'.'_'.$req_data_id['req_kd'].'.pdf');
  
  }
  catch(HTML2PDF_exception $e) {
      echo $e;
      exit;
  }
*/  
?>   

<?php }else{ echo"<script>document.location='media.php?p=not_found';</script>";}?> 