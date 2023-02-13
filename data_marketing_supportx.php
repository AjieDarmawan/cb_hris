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
    
    $dataArr[] = array('mfc_nama'=>$mfc_nama,
                       'mfc_nohp'=>$mfc_nohp,
                       'mfc_kota'=>$mfc_kota,
                       'mfc_informasi'=>$mfc_informasi,
                       'mfc_tanggal'=>$mfc_tanggal,
                       'mfc_status'=>$mfc_status);
    
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
    
    <div class="container">
        <div class="row pt-4">
            <div class="col-sm-3">
                <div class="card sticky-top sticky-offset mb-3">
                    <div class="card-header text-center">
                      <strong>Summary</strong>
                    </div>
                    <ul class="list-group list-group-flush">
                      <li class="list-group-item p-2">
                        <button type="button" class="btn btn-info btn-block">
                            Total Data <span class="badge badge-light"><?php echo $summaryArr['total'];?></span>
                        </button>
                      </li>
                      <li class="list-group-item p-2">
                        <button type="button" class="btn btn-dark btn-block">
                            Belum Proses <span class="badge badge-light"><?php echo $summaryArr['none'];?></span>
                        </button>
                      </li>
                      <li class="list-group-item p-2">
                        <button type="button" class="btn btn-warning btn-block">
                            Proses <span class="badge badge-light"><?php echo $summaryArr['proses'];?></span>
                        </button>
                      </li>
                      <li class="list-group-item p-2">
                        <button type="button" class="btn btn-primary btn-block">
                            Diterima <span class="badge badge-light"><?php echo $summaryArr['diterima'];?></span>
                        </button>
                      </li>
                      <li class="list-group-item p-2">
                        <button type="button" class="btn btn-danger btn-block">
                            Gagal <span class="badge badge-light"><?php echo $summaryArr['gagal'];?></span>
                        </button>
                      </li>
                    </ul>
                </div>
            </div>
            <div class="col-sm-9">
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
            
            
            var options = [
                createElement('option', '', {value: 'All'}),
                createElement('option', 'Belum Proses', {value: 'Belum Proses'}),
                createElement('option', 'Proses', {value: 'Proses'}),
                createElement('option', 'Diterima', {value: 'Diterima'}),
                createElement('option', 'Gagal', {value: 'Gagal'})
            ];
        
        
            var filterStatus = createElement('select', null, // 'select' = name of element to create, null = no text to insert
                {id: 'Select1', name: 'drop1', class: 'form-control form-control-sm'}, // Attributes to attach
                [options[0], options[1], options[2], options[3], options[4]], // append all 5 elements
                'body' // append final element to body - this also takes a element by id without the #
            );
            
            var node = document.createElement("label");
            node.appendChild(filterStatus);
            document.getElementById("dt-marketing-support_filter").appendChild(node);
        });
        
        
        function createElement(){
            var element  = document.createElement(arguments[0]),
                text     = arguments[1],
                attr     = arguments[2],
                append   = arguments[3],
                appendTo = arguments[4];
        
            for(var key = 0; key < Object.keys(attr).length ; key++){
                var name = Object.keys(attr)[key],
                     value = attr[name],
                     tempAttr = document.createAttribute(name);
                     tempAttr.value = value;
                element.setAttributeNode(tempAttr)
            }
        
            if(append){
                for(var _key = 0; _key < append.length; _key++) {
                    element.appendChild(append[_key]);
                }
            }
        
            if(text) element.appendChild(document.createTextNode(text));
        
            if(appendTo){
                var target = appendTo === 'body' ? document.body : document.getElementById(appendTo);
                target.appendChild(element)
            }       
        
            return element;
        }
    </script>
  </body>
</html>