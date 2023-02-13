<?php
error_reporting(E_ALL ^ E_NOTICE);
date_default_timezone_set('Asia/Jakarta');
session_start();

ini_set('max_execution_time', 300); 

require('class.php');
require('object.php');

$db->koneksi();

$date=date('Y-m-d');

require('module/request/req_act.php'); 

if($req_cek_id > 0){

//ob_start();

$title=$req_data_id['req_kd'];  

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
                <small class="pull-right">Date: <?php echo $tgl->tgl_indo($req_data_id['req_tgl']);?></small>
                <center><small>Jl. Raya Bogor Km 47,5 Perum Bumi Sentosa Blok A3 No.3, Nanggewer Cibinong, Jawa Barat 16912.</small></center>
              </h2>
            </div><!-- /.col -->
          </div>
          <!-- info row -->
          <div class="row invoice-info">
          <center><h3><u>SURAT PENGAJUAN ASSET</u></h3>
          <b>Nomor Surat <?php echo $req_data_id['req_kd'];?></b><br/></center><br><br>
            <div class="col-sm-4 invoice-col">
              From
              <address>
                <strong><?php echo $kar_nm;?></strong><br>
                NIK: <?php echo $kar_nik;?><br>
                Divisi: <?php echo $div_nm;?><br>
                Location: <?php echo $unt_nm;?> / <?php echo $ktr_nm;?><br>
              </address>
            </div><!-- /.col -->
            <div class="col-sm-4 invoice-col">
            </div>
            <div class="col-sm-4 invoice-col">
              To
              <address>
                <strong>IT Division</strong><br>
                Location: Kantor Pusat / Kantor SINGO<br>
                Phone: (021) 000-0000<br/>
                Email: it@gilland-ganesha.com
              </address>
            </div><!-- /.col -->
          </div><!-- /.row -->

          <!-- Table row -->
          <div class="row">
            <div class="col-xs-12 table-responsive">
              <table class="table table-bordered table-striped table-hover">
                <thead>
                  <tr>
                    <th>Asset</th>
                    <th>Jenis</th>
                    <th>QTY</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $req_id=$req_data_id['req_id'];
                  $req_dtl_tampil=$req->req_dtl_tampil($req_id);
                  while($req_data=mysql_fetch_array($req_dtl_tampil)){ 

                    $ast_id=$req_data['ast_id'];
                    $ast_tampil_id=$ast->ast_tampil_id($ast_id);
                    $ast_data=mysql_fetch_array($ast_tampil_id);

                    $totalqty= $totalqty + $req_data['req_dtl_jml'];
                  ?>
                  <tr>
                    <td><?php echo $ast_data['ast_nm'];?></td>
                    <td><?php echo $ast_data['ast_jns_nm'];?></td>
                    <td><?php echo $req_data['req_dtl_jml'];?></td>
                  </tr>
                  <?php }?>
                </tbody>      
                </tfoot>
              </table>
            </div><!-- /.col -->
          </div><!-- /.row -->

          <div class="row">
            <!-- accepted payments column -->
            <div class="col-xs-6">
              <p class="lead">Security Key:</p>
             

              <div id="barcodeTarget" class="barcodeTarget"></div>
              <canvas id="canvasTarget" width="150" height="150"></canvas>
              <p class="text-muted well well-sm no-shadow" style="margin-top: 10px;">
              <small>Surat Pengajuan ini sah dan sudah dilengkapi dengan Q.R Code.</small>
              </p>
              <input type="text" id="barcodeValue" value="<?php echo $req_data_id['req_kd'];?>" style="visibility:hidden">
              <input type="radio" name="btype" id="datamatrix" value="datamatrix" checked="checked" style="visibility:hidden">
              <input type="radio" id="bmp" name="renderer" value="bmp" checked="checked" style="visibility:hidden">

            </div><!-- /.col -->
            <div class="col-xs-6">
              <p class="lead">Jumlah</p>
              <div class="table-responsive">
                <table class="table">
                  <tr>
                    <th style="width:50%">Total QTY:</th>
                    <td><?php echo $totalqty;?> Items</td>
                  </tr>
                </table>
              </div>
            </div><!-- /.col -->
          </div><!-- /.row -->

          <div class="row">
            <div class="col-sm-4 invoice-col">
              <center>
                <strong>Mengatahui</strong><br>
                IT Hardware<br><br><br><br><br>
                (Roni Abdulloh)
              </center>
            </div>
            <div class="col-sm-4 invoice-col">
            </div>
            <div class="col-sm-4 invoice-col">
              <center>
                <br>
                Penerima<br><br><br><br><br>
                (<?php echo $kar_nm;?>)
                <!--<hr style="width:50%">-->
              </center>  
            </div>
          </div>
          
         
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