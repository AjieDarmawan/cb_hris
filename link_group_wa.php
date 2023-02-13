<?php
error_reporting(E_ALL ^ E_NOTICE);
date_default_timezone_set('Asia/Jakarta');
session_start();

require('class.php');
require('object.php');

$db->koneksi();

$dataArr = array();
$summaryArr = array();
$total = 0;

$list_tautan=$gwa->list_tautan();
while($gwa_list_data=mysql_fetch_assoc($list_tautan)){       
    $gwa_propinsi = $gwa_list_data['propinsi'];
    $gwa_kota = $gwa_list_data['kota'];	
	$gwa_nama = $gwa_list_data['nama'];	
	$gwa_tautan = $gwa_list_data['tautan'];
    $gwa_tanggal = $gwa_list_data['tanggal'];
	$gwa_sudah = $gwa_list_data['sudah'];
    
    $dataArr[] = array( 'gwa_propinsi'=>$gwa_propinsi,
						'gwa_kota'=>$gwa_kota,
						'gwa_nama'=>$gwa_nama,
					   'gwa_tautan'=>$gwa_tautan,
                       'gwa_tanggal'=>$gwa_tanggal,
					   'gwa_sudah'=>$gwa_sudah);
       
    $total++;
    $summaryArr['total'] = $total;
}

/*echo "<pre>";
print_r($summaryArr);
echo "</pre>";*/
?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name='robots' content='noindex,nofollow' />
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://sipema.p2k.co.id/assets/css/bootstrap.min.css">
        
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/css/bootstrap-datepicker.min.css" rel="stylesheet"/>
    <link href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css" rel="stylesheet"/>
    <link href="https://cdn.datatables.net/buttons/1.6.2/css/buttons.dataTables.min.css" rel="stylesheet"/>
    
    <title>Link Group WA</title>
    
    <style>
        table{
            font-size: 0.9em;
        }
        .sticky-offset {
            top: 25px;
        }
		
		del { color: tomato; }
    </style>
    
  </head>
  <body class="bg-secondary">
    
    <div class="container-fluid">
        <div class="row">
          <div class="col-lg-12">
            <div class="card mt-1 mb-1 border-0">
              <div class="card-body bg-secondary">
                <div class="row">
                  <div class="col-lg-12 text-center">
                    <h3 class="text-light"><strong>Link Group WA</strong></h3>
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
                                <th>Tautan</th>
								<th>Kota/Keterangan</th>
								<th>Tgl. Update</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                              $no = 1;
                              foreach($dataArr as $key => $val){
                            ?>
                            <tr>
                                <td align="center"><?php echo $no;?></td>
                                <td>
									<?php if($val['gwa_sudah']==0) { ?>
										<?php echo $val['gwa_nama'];?>
									<?php } else { ?>
										<del><?php echo $val['gwa_nama'];?></del>
									<?php } ?>
									</td>
                                <td>
									<?php if($val['gwa_sudah']==0) { ?>
										<a href=<?php echo $val['gwa_tautan'];?>><?php echo $val['gwa_tautan'];?></a>
									<?php } else { ?>
										<del><?php echo $val['gwa_tautan'];?></del>
									<?php } ?>
								</td>
								<td><?php echo $val['gwa_kota'];?></td>
								<td align="center"><?php echo date('d-m-Y', strtotime($val['gwa_tanggal']));?></td>
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
