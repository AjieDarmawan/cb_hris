<?php
error_reporting(E_ALL ^ E_NOTICE);
date_default_timezone_set('Asia/Jakarta');
session_start();

require('class.php');
require('object.php');

$db->koneksi();

$dataArr = array();
$summaryArr = array();
$total = 0; $none = 0; $proses = 0; $diterima = 0; $gagal = 0;

$ms_tmp_list=$ms->ms_tmp_list();
while($ms_tmp_data=mysql_fetch_assoc($ms_tmp_list)){
    
    $mfc_nama = $ms_tmp_data['mfc_nama'];
    $mfc_nohp = $ms_tmp_data['mfc_nohp'];
    $mfc_kota = $ms_tmp_data['mfc_kota'];
    $mfc_informasi = $ms_tmp_data['mfc_informasi'];
    $mfc_tanggal = $ms_tmp_data['mfc_tanggal'];
    $mfc_status = $ms_tmp_data['mfc_status'];
    $mfc_tmplahir = $ms_tmp_data['mfc_tmplahir'];
    $mfc_tglahir = $ms_tmp_data['mfc_tglahir'];
    $mfc_pendidikan = $ms_tmp_data['mfc_pendidikan'];
    $mfc_pekerjaan = $ms_tmp_data['mfc_pekerjaan'];
    
    $dataArr[] = array('mfc_nama'=>$mfc_nama,
                       'mfc_nohp'=>$mfc_nohp,
                       'mfc_kota'=>$mfc_kota,
                       'mfc_informasi'=>$mfc_informasi,
                       'mfc_tanggal'=>$mfc_tanggal,
                       'mfc_status'=>$mfc_status,
                       'mfc_tmplahir'=>$mfc_tmplahir,
                       'mfc_tglahir'=>$mfc_tglahir,
                       'mfc_pendidikan'=>$mfc_pendidikan,
                       'mfc_pekerjaan'=>$mfc_pekerjaan);
    
    if($mfc_status == 'Proses'){
        $proses++;
        $summaryArr['proses'] = $proses;
    }elseif($mfc_status == 'Diterima'){
        $diterima++;
        $summaryArr['diterima'] = $diterima;
    }elseif($mfc_status == 'Gagal'){
        $gagal++;
        $summaryArr['gagal'] = $gagal;
    }else{
        $none++;
        $summaryArr['none'] = $none;
    }
    
    $total++;
    $summaryArr['total'] = $total;
}

/*echo "<pre>";
print_r($summaryArr);
echo "</pre>";*/

$ms_last_upload=$ms->ms_last_upload();
$tgl_last_update=mysql_fetch_assoc($ms_last_upload);
?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://sipema.p2k.co.id/assets/css/bootstrap.min.css">
        
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/css/bootstrap-datepicker.min.css" rel="stylesheet"/>
    <link href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css" rel="stylesheet"/>
    <link href="https://cdn.datatables.net/buttons/1.6.2/css/buttons.dataTables.min.css" rel="stylesheet"/>
    
    <title>Data Marketing Support</title>
    
    <style>
        table{
            font-size: 0.9em;
        }
        .sticky-offset {
            top: 25px;
        }
    </style>
    
  </head>
  <body class="bg-secondary">
    
    <div class="container-fluid">
        <div class="row">
          <div class="col-lg-12">
            <div class="card mt-1 mb-1 border-0">
              <div class="card-body bg-secondary">
                <div class="row">
                  <div class="col-sm-12 col-md-2 col-md-2 text-center">
                    <h4 class="text-light">
                      <strong>Summary</strong><br>
                      <small><small>Update : <?php echo $tgl->tgl_indo($tgl_last_update['last_update']);?></small></small>
                    </h4>
                  </div>
                  <div class="col-sm-12 col-md-2 col-md-2">
                    <button type="button" class="btn btn-info btn-block">
                      Total Data <span class="badge badge-light"><?php echo $summaryArr['total'];?></span>
                    </button>
                  </div>
                  <div class="col-sm-12 col-md-2 col-md-2">
                    <button type="button" class="btn btn-dark btn-block">
                      Belum Proses <span class="badge badge-light"><?php echo $summaryArr['none'];?></span>
                    </button>
                  </div>
                  <div class="col-sm-12 col-md-2 col-md-2">
                    <button type="button" class="btn btn-warning btn-block">
                      Proses <span class="badge badge-light"><?php echo $summaryArr['proses'];?></span>
                    </button>
                  </div>
                  <div class="col-sm-12 col-md-2 col-md-2">
                    <button type="button" class="btn btn-primary btn-block">
                      Diterima <span class="badge badge-light"><?php echo $summaryArr['diterima'];?></span>
                    </button>
                  </div>
                  <div class="col-sm-12 col-md-2 col-md-2">
                    <button type="button" class="btn btn-danger btn-block">
                      Gagal <span class="badge badge-light"><?php echo $summaryArr['gagal'];?></span>
                    </button>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="table-responsive">
                    <table id="dt-marketing-support" class="table table-dark table-sm table-hover table-bordered">
                        <thead class="thead-light text-center">
                            <tr>
                                <th>No</th>
                                <th>Nama</th>						
                                <th>No.HP</th>
                                <th>Kota</th>
                                <th>Smb.Info</th>
                                <th>Tgl.Apply</th>
                                <th>Status</th>
                                <th>Tmp.Lahir</th>
                                <th>Tgl.Lahir</th>
                                <th>Pendidikan</th>
                                <th>Pekerjaan</th>								
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                              $no = 1;
                              foreach($dataArr as $key => $val){
                            ?>
                            <tr>
                                <td><?php echo $no;?></td>
                                <td><?php echo $val['mfc_nama'];?></td>
                                <td><?php echo $val['mfc_nohp'];?></td>
                                <td><?php echo $val['mfc_kota'];?></td>
                                <td><?php echo $val['mfc_informasi'];?></td>
                                <td><?php echo $tgl->tgl_indo($val['mfc_tanggal']);?></td>
                                <td><?php echo $val['mfc_status'];?></td>
                                <td><?php echo $val['mfc_tmplahir'];?></td>
                                <td><?php echo $tgl->tgl_indo($val['mfc_tglahir']);?></td>
                                <td><?php echo $val['mfc_pendidikan'];?></td>
                                <td><?php echo $val['mfc_pekerjaan'];?></td>								
                            </tr>
                            <?php $no++; }?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://sipema.p2k.co.id/assets/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/js/bootstrap-datepicker.min.js"></script>
        
    <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.2/js/buttons.flash.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.2/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.2/js/buttons.print.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#dt-marketing-support').DataTable({
                dom: 'Bfrtip',
                buttons: [
                    'pageLength','excel'
                ]
            });
        });
    </script>
  </body>
</html>