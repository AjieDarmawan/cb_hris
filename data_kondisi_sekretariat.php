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
$none = 0;
$sangat = 0;
$cukup = 0;
$kurang = 0;

if ($_GET['kondisi']) {
  if ($_GET['kondisi'] > '') {
    $ksk_tmp_list = $ksk->ksk_tampil_kondisi($_GET['kondisi']);
  } else {
    $ksk_tmp_list = $ksk->ksk_tampil_all();
  }
} else {
  $ksk_tmp_list = $ksk->ksk_tampil_all();
}
while ($ksk_tmp_data = mysql_fetch_assoc($ksk_tmp_list)) {

  $ksk_unit = $ksk_tmp_data['ksk_unit'];
  $ksk_staff = $ksk_tmp_data['ksk_staff'];
  $ksk_posisi = $ksk_tmp_data['ksk_posisi'];
  $ksk_deskripsi = $ksk_tmp_data['ksk_deskripsi'];
  $ksk_kondisi = $ksk_tmp_data['ksk_kondisi'];
  $ksk_kondisi_txt = $ksk_tmp_data['ksk_kondisi_txt'];
  $ksk_img = $ksk_tmp_data['ksk_img'];
  $ksk_mddt = $ksk_tmp_data['ksk_mddt'];

  $ktr_id_ksk = $ksk_unit;
  $ktr_tampil_id_ksk = $ktr->ktr_tampil_id($ktr_id_ksk);
  $ktr_data_ksk = mysql_fetch_assoc($ktr_tampil_id_ksk);

  $kar_id_staff = $ksk_staff;
  $kar_tampil_id_staff = $kar->kar_tampil_id($kar_id_staff);
  $kar_data_staff = mysql_fetch_assoc($kar_tampil_id_staff);


  $dataArr[] = array(
    'ksk_unit' => $ktr_data_ksk['ktr_kd'],
    'ksk_staff' =>  $kar_data_staff['kar_nik'] . '-' . $kar_data_staff['kar_nm'],
    'ksk_posisi' => $ksk_posisi,
    'ksk_deskripsi' => $ksk_deskripsi,
    'ksk_kondisi' => $ksk_kondisi,
    'ksk_kondisi_txt' => $ksk_kondisi_txt,
    'ksk_img' => $ksk_img,
    'ksk_mddt' => $ksk_mddt,
  );

  if ($ksk_kondisi == 'Sangat') {
    $sangat++;
    $summaryArr['sangat'] = $sangat;
  } elseif ($ksk_kondisi == 'Cukup') {
    $cukup++;
    $summaryArr['cukup'] = $cukup;
  } elseif ($ksk_kondisi == 'Kurang') {
    $kurang++;
    $summaryArr['kurang'] = $kurang;
  } else {
    $none++;
    $summaryArr['none'] = $none;
  }

  $total++;
  $summaryArr['total'] = $total;
}

$jsondataArr = json_encode($dataArr, 1);

// echo "<pre>";
// print_r($dataArr);
// echo "</pre>"
// exit();

// $ksk_last_upload = $ksk->ms_last_upload();
// $tgl_last_update = mysql_fetch_assoc($ksk_last_upload);
?>

<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://sipema.p2k.co.id/assets/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

  <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/css/bootstrap-datepicker.min.css" rel="stylesheet" />
  <link href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css" rel="stylesheet" />
  <link href="https://cdn.datatables.net/buttons/1.6.2/css/buttons.dataTables.min.css" rel="stylesheet" />



  <title>Data Kondisi Sekretariat</title>

  <style>
    body {
      background: #000000;
      /* fallback for old browsers */
      background: -webkit-linear-gradient(to bottom right, #000000, #0f0c29, #000000);
      /* Chrome 10-25, Safari 5.1-6 */
      background: linear-gradient(to bottom right, #000000, #0f0c29, #000000);
      /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */

    }

    table {
      font-size: 0.9em;
    }

    .sticky-offset {
      top: 25px;
    }

    .invoice {
      position: relative;
      background: #fff;
      border: 1px solid #f4f4f4;
      padding: 20px;
      margin: 10px 25px;
    }

    .invoice-title {
      margin-top: 0;
    }

    .bg-custom {
      background: #74ebd5;
      /* fallback for old browsers */
      background: -webkit-linear-gradient(to right, #d9edf7, #9aece2);
      /* Chrome 10-25, Safari 5.1-6 */
      background: linear-gradient(to right, #d9edf7, #9aece2);
      /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */
    }




    @media print {

      .no-print,
      .main-sidebar,
      .left-side,
      .main-header,
      .content-header {
        display: none !important;
      }

      .content-wrapper,
      .right-side,
      .main-footer {
        margin-left: 0 !important;
        min-height: 0 !important;
        -webkit-transform: translate(0, 0) !important;
        -ms-transform: translate(0, 0) !important;
        -o-transform: translate(0, 0) !important;
        transform: translate(0, 0) !important;
      }

      .fixed .content-wrapper,
      .fixed .right-side {
        padding-top: 0 !important;
      }

      .invoice {
        width: 100%;
        border: 0;
        margin: 0;
        padding: 0;
      }

      .invoice-col {
        float: left;
        width: 33.3333333%;
      }

      .table-responsive {
        overflow: auto;
      }

      .table-responsive>.table tr th,
      .table-responsive>.table tr td {
        white-space: normal !important;
      }
    }

    .page-header {
      margin: 10px 0 20px 0;
      font-size: 20px;
    }

    .page-header {
      padding-bottom: 9px;
      margin: 20px 0 20px;
      border-bottom: 1px solid #eee;
    }

    .round img {
      border-radius: 10px;
      box-shadow: 3px 3px 5px;
    }

    .card img {
      border-radius: 10px;
      /* box-shadow: 3px 3px 5px; */

    }
  </style>
</head>


<body class="text-white">

  <div class="container-fluid">
    <div class="row">
      <div class="col-lg-12">
        <div class="card mt-1 mb-1 border-0">
          <div class="card-body bg-secondary">
            <div class="row">
              <div class="col-sm-12 col-md-4 text-center">
                <h4 class="text-light">
                  <strong>Report Kondisi Sekretariat</strong><br>
                </h4>
              </div>
              <div class="col-sm-12 col-md-2">
                <a type="button" href="https://cb.web.id/data_kondisi_sekretariat.php" class="btn btn-info btn-block">
                  Total Data <span class="badge badge-light"><?php echo $summaryArr['total']; ?></span>
                </a>
              </div>
              <!-- <div class="col-sm-12 col-md-2">
                <button type="button" class="btn btn-warning btn-block">
                  Belum Proses <span class="badge badge-light"><?php echo $summaryArr['none']; ?></span>
                </button>
              </div> -->
              <div class="col-sm-12 col-md-2">
                <a type="button" href="https://cb.web.id/data_kondisi_sekretariat.php?kondisi=sangat" class="btn btn-success btn-block">
                  Sangat Layak <span class="badge badge-light"><?php echo $summaryArr['sangat']; ?></span>
                </a>
              </div>
              <div class="col-sm-12 col-md-2">
                <a type="button" href="https://cb.web.id/data_kondisi_sekretariat.php?kondisi=cukup" class="btn btn-warning btn-block">
                  Cukup Layak <span class="badge badge-light"><?php echo $summaryArr['cukup']; ?></span>
                </a>
              </div>
              <div class="col-sm-12 col-md-2">
                <a type="button" href="https://cb.web.id/data_kondisi_sekretariat.php?kondisi=kurang" class="btn btn-danger btn-block">
                  Kurang Layak <span class="badge badge-light"><?php echo $summaryArr['kurang']; ?></span>
                </a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-lg-12">
        <div class="table-responsive">
          <table id="dt-table" class="table table-dark table-sm table-hover table-bordered">
            <thead class="thead-light text-center">
              <tr>
                <th>No</th>
                <th>Tanggal Upload</th>
                <th>Nama Unit</th>
                <th>Nama Staff</th>
                <th>Posisi Sekretariat</th>
                <th>Deskripsi Ruangan</th>
                <th>Saran Perbaikan Kondisi Saat Ini</th>
                <th>Status Kondisi</th>
                <th width="7%">Aksi</th>
              </tr>
            </thead>
            <tbody>
              <?php
              $no = 1;
              foreach ($dataArr as $key => $val) {

                $kondisi = '';
                if ($val['ksk_kondisi'] == 'Sangat') {
                  $kondisi = '<span class="badge badge-success">Sangat Layak</span>';
                } else if ($val['ksk_kondisi'] == 'Cukup') {
                  $kondisi = '<span class="badge badge-warning">Cukup Layak</span>';
                } else if ($val['ksk_kondisi'] == 'Kurang') {
                  $kondisi = '<span class="badge badge-danger">Kurang Layak</span>';
                }

                $deskripsi = json_decode($val['ksk_deskripsi'], true);

              ?>
                <tr>
                  <td class="text-center"><?php echo $no; ?></td>
                  <td><?php echo $tgl->tgl_indo($val['ksk_mddt']); ?></td>
                  <td><?php echo $val['ksk_unit']; ?></td>
                  <td><?php echo $val['ksk_staff']; ?></td>
                  <td class="text-center"><?php echo $val['ksk_posisi']; ?></td>
                  <td><?php echo $deskripsi[1]; ?></td>
                  <td><?php echo $val['ksk_kondisi_txt']; ?></td>
                  <td class="text-center"><?php echo $kondisi; ?></td>
                  <td class="text-center">
                    <a class="text-warning" href="javascript:;" data-ksk_id="<?php echo $val['ksk_id']; ?>" data-ksk_mddt="<?php echo $val['ksk_mddt']; ?>" data-ksk_unit="<?php echo $val['ksk_unit']; ?>" data-ksk_staff="<?php echo $val['ksk_staff']; ?>" data-ksk_pic="<?php echo $val['ksk_pic']; ?>" data-ksk_posisi="<?php echo $val['ksk_posisi']; ?>" data-ksk_kondisi="<?php echo $val['ksk_kondisi']; ?>" data-ksk_kondisi_txt="<?php echo $val['ksk_kondisi_txt']; ?>" data-ksk_deskripsi=`<?php echo base64_encode($val['ksk_deskripsi']); ?>` data-ksk_img=`<?php echo $val['ksk_img']; ?>` data-ksk_hrd="<?php echo $val['ksk_hrd']; ?>" data-toggle="modal" data-target="#viewksk"><i class="fa fa-eye"></i></a>&nbsp;&nbsp;&nbsp;
                  </td>
                </tr>
              <?php $no++;
              } ?>
            </tbody>
          </table>

        </div>
      </div>
    </div>
  </div>


  <!-- Modal View ksk -->
  <div class="modal" style="color:#000000" id="viewksk" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">

    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title" id="myModalLabel"><i class="fa fa-file"></i> &nbsp;View Kondisi Sekretariat</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form id="form_view_ksk" class="form-horizontal" enctype="multipart/form-data" method="post">
          <input type="hidden" name="ksk_id" id="v_ksk_id">
          <div class="modal-body">

            <form class="form-horizontal" action="" method="post">
              <!-- Main content -->
              <div class="row">
                <div class="invoice col-md-11">
                  <!-- title row -->
                  <div class="row">
                    <div class="col-sm-12 col-md-12">
                      <h4 class="page-header">
                        <div class="row">
                          <div class="col-xs-3 col-md-2">
                            <img src="dist/img/logo_gg_small130.JPG" width="80">
                          </div>
                          <div class="col-xs-9 col-md-10">
                            PT. Gilland Ganesha<br>
                            <small>Jl. Raya Bogor Km 47,5 Perum Bumi Sentosa Blok A3 No.3, Nanggewer Cibinong, Jawa Barat 16912.</small>
                          </div>
                        </div>
                      </h4>
                    </div><!-- /.col -->
                    <!-- <div class="col-sm-12 col-md-2">
                    <center><img src="module/profile/img/SG05342019-20201009050833.jpg" width="100" height="125"></center>
                  </div> -->
                  </div>
                  <!-- info row -->
                  <div class="row">

                    <div class="col-md-12 text-center">
                      <center style="margin-bottom: 20px;">
                        <h4><u>Kondisi Sekretariat</u></h4>
                        <!-- <span id="v_ksk_hrd" class="badge badge-danger" style="font-size:13px;"> Unconfirmed by HRD </span> -->
                      </center>
                    </div>
                    <div class="col-sm-7 invoice-col" style="font-size:13px">
                      <address>
                        <!-- <strong id="v_ksk_pic">Nama PIC</strong><br> -->
                        Kantor/Unit : <span id="v_ksk_unit_label">Kantor/Unit</span><br>
                        Staff : <span id="v_ksk_staff_label">Staff</span><br>
                      </address>
                    </div><!-- /.col -->

                    <div class="col-sm-5 invoice-col">
                      <div class="row">
                        <div class="col-md-12 text-center" style="font-size:13px">
                          Waktu Upload : <strong id="v_ksk_waktu"> waktu </strong><br>
                          Posisi : <b><span id="v_ksk_posisi" class="text-danger"> posisi </span></b>
                        </div>
                        <!-- <div class="col-md-12 text-center" style="margin-top:10px">
                        <div id="v_ksk_perkembangan" class="badge badge-danger text-center" style="font-size:13px;">
                          Kurang
                        </div>
                      </div> -->
                      </div>
                    </div><!-- /.col -->
                  </div><!-- /.row -->

                  <!-- Table row -->
                  <div class="row" style="margin-top:10px">
                    <div class="col-xs-12 table-responsive">


                      <table class="table">
                        <tbody id="tb_kondisi_txt">
                          <tr class="bg-custom">
                            <th colspan="4"><small><b>Kondisi Sekretariat Saat Ini</b></small></th>
                          </tr>
                          <tr>
                            <td colspan="3" width="85%"><span id="v_ksk_kondisi_txt">-</span></td>
                            <td>
                              <h5><span id="v_ksk_kondisi" class="badge badge-danger">Kurang Layak</span></h5>
                            </td>
                          </tr>

                        </tbody>
                      </table>

                      <table class="table">
                        <tbody id="tb_kondisi">

                        </tbody>
                      </table>
                    </div><!-- /.col -->
                  </div><!-- /.row -->

                  <!-- <div class="row text-center">
                  <b class="bg-custom" id="div_ksk_img_lain" class="v_ksk_img"><small class="col-sm-12 text-left" style="margin-bottom:20px; margin-left:10px;">Foto/Screenshot Lainnya</small></b>

                  <div class="col-sm-4 v_ksk_img" id="div_ksk_img4">
                    <div class="card round" style="cursor: pointer; margin-bottom:25px" onclick="toggleFullscreen('v_ksk_img4_img');">
                      <img src="" id="v_ksk_img4_img" alt="Kondisi 4" class="card-img-top card-img" style="width:100%; height:150px;object-fit:cover;">
                    </div>
                  </div>
                  <div class="col-sm-4 v_ksk_img" id="div_ksk_img5">
                    <div class="card round" style="cursor: pointer; margin-bottom:25px" onclick="toggleFullscreen('v_ksk_img5_img');">
                      <img src="" id="v_ksk_img5_img" alt="Kondisi 5" class="card-img-top card-img" style="width:100%; height:150px;object-fit:cover;">
                    </div>
                  </div>
                  <div class="col-sm-4 v_ksk_img" id="div_ksk_img6">
                    <div class="card round" style="cursor: pointer; margin-bottom:25px" onclick="toggleFullscreen('v_ksk_img6_img');">
                      <img src="" id="v_ksk_img6_img" alt="Kondisi 6" class="card-img-top card-img" style="width:100%; height:150px;object-fit:cover;">
                    </div>
                  </div>
                </div> -->

                </div><!-- /.content -->

                <div class="clearfix"></div>
              </div>
            </form>
          </div>
          <div class="modal-footer">
            <small class="text-danger">*Klik gambar untuk Zoom</small><br>

          </div>
        </form>
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
    var data;
    $(document).ready(function() {

      sessionStorage.removeItem('kondisi');
      var dataarr = `<?php echo $jsondataArr ?>`;
      sessionStorage.setItem('kondisi', JSON.stringify(dataarr));
      data = JSON.parse(sessionStorage.getItem('kondisi'));

      $('#dt-table').DataTable({
        dom: 'Bfrtip',
        buttons: [
          'pageLength', 'excel'
        ]
      });
    });



    // Tentang Konidi
    $('#viewksk').on('show.bs.modal', function(event) {
      // alert('aw');
      var div = $(event.relatedTarget)
      // $ksk_tgl, $ksk_waktu, $ksk_pic, $ksk_metode, $ksk_unit, $ksk_staff, $ksk_topic_cat, $ksk_knowledge, $ksk_knowledge_cat, $ksk_komunikasi, $ksk_komunikasi_cat, $ksk_closing, $ksk_closing_cat, $ksk_mempengaruhi, $ksk_mempengaruhi_cat, $ksk_lain_cat, $ksk_arahan_cat, $ksk_perkembangan

      // var ksk_id = div.data('ksk_id');
      var ksk_unit = div.data('ksk_unit');
      var ksk_staff = div.data('ksk_staff');
      var ksk_posisi = div.data('ksk_posisi');
      var ksk_mddt = div.data('ksk_mddt');
      var ksk_kondisi = div.data('ksk_kondisi');
      var ksk_kondisi_txt = div.data('ksk_kondisi_txt');
      // var ksk_hrd = div.data('ksk_hrd');

      // console.log(div.data('ksk_img'));
      // console.log(atob(div.data('ksk_deskripsi'));
      var ksk_img = div.data('ksk_img').replace(/\`/g, '');
      var ksk_deskripsi = atob(div.data('ksk_deskripsi').replace(/\`/g, ''));

      var modal = $(this);

      // modal.find('#v_ksk_img1_img').attr("src", "");
      // modal.find('#v_ksk_img2_img').attr("src", "");
      // modal.find('#v_ksk_img3_img').attr("src", "");
      // modal.find('#v_ksk_img4_img').attr("src", "");
      // modal.find('#v_ksk_img5_img').attr("src", "");
      // modal.find('#v_ksk_img6_img').attr("src", "");
      // modal.find('.v_ksk_img').attr("style", "display:none");

      if (ksk_img) {
        ksk_img = JSON.parse(ksk_img);
        ksk_deskripsi = JSON.parse(ksk_deskripsi);
        let no = 1;
        $('#tb_kondisi').empty();
        $.each(ksk_img, function(i, item) {

          let judul = 'Deskripsi Foto ';
          if (i == '0') {
            judul = 'Deskripsi Foto Bagian Depan Sekretariat';
          } else if (i == '1') {
            judul = 'Deskripsi Foto Ruangan Sekretariat';
          } else if (i == '2') {
            judul = 'Deskripsi Foto Bagian Samping Sekretariat';
          } else {
            judul = judul + (parseInt(no))
          }
          $('#tb_kondisi').append(`
            <tr class="bg-custom">
                <th colspan="4"><small><b>${judul}</b></small></th>
            </tr>
            <tr>
                <td colspan="2" width="30%">
                <div class="v_ksk_img" id="div_ksk_img${i}">
                    <div class="card round" style="cursor: pointer; margin-bottom:25px" onclick="toggleFullscreen('v_ksk_img${i}_img');">
                    <img src="module/kondisi_sekretariat/files/image/${item}" id="v_ksk_img${i}_img" alt="Kondisi ${i}" class="card-img-top card-img" style="width:100%; height:150px;object-fit:cover;" title="Klik gambar untuk Zoomin Zoomout">
                    </div>
                </div>
                </td>
                <td colspan="2"><span id="v_ksk_deskripsi${i}">${ksk_deskripsi[i]?ksk_deskripsi[i]:'-'}</span></td>
            </tr>
            `);
          no++;
        });

      } else {
        $('#tb_kondisi').empty();
      }

      // modal.find('#v_ksk_id').attr("value", ksk_id);

      // modal.find('#v_ksk_deskripsi').html(ksk_deskripsi);
      // modal.find('#v_ksk_deskripsi2').html(ksk_deskripsi2);
      // modal.find('#v_ksk_deskripsi3').html(ksk_deskripsi3);

      if (ksk_posisi == 'Sendiri' || ksk_posisi == 'sendiri') {
        modal.find('#v_ksk_posisi').html('Ruang Tersendiri');
      } else if (ksk_posisi == 'Gabung' || ksk_posisi == 'gabung') {
        modal.find('#v_ksk_posisi').html('Gabung dengan PMB Kampus');
      }

      modal.find('#v_ksk_kondisi_txt').html(ksk_kondisi_txt ? ksk_kondisi_txt : 'Sudah Sangat Layak');
      if (ksk_kondisi == 'Sangat') {
        modal.find('#v_ksk_kondisi').html('Sangat Layak');
        modal.find('#v_ksk_kondisi').attr('class', 'badge badge-lg badge-success');
      } else if (ksk_kondisi == 'Cukup') {
        modal.find('#v_ksk_kondisi').html('Cukup Layak');
        modal.find('#v_ksk_kondisi').attr('class', 'badge badge-large badge-warning');
      } else if (ksk_kondisi == 'Kurang') {
        modal.find('#v_ksk_kondisi').html('Kurang Layak');
        modal.find('#v_ksk_kondisi').attr('class', 'badge badge-large badge-danger');
      }

      // if (ksk_hrd == 'Y') {
      //     modal.find('#v_ksk_hrd').attr('class', 'badge badge-success');
      //     modal.find('#v_ksk_hrd').html('Confirmed by HRD');
      // } else {
      //     modal.find('#v_ksk_hrd').attr('class', 'badge badge-danger');
      //     modal.find('#v_ksk_hrd').html('Unconfirmed by HRD');
      // }

      // modal.find('#v_ksk_unit option').each(function() {
      //     if ($(this).val() == ksk_unit)
      //         $(this).attr("selected", "selected");
      // });
      // modal.find('#v_ksk_unit_label').html($('#v_ksk_unit option:selected').text());
      modal.find('#v_ksk_unit_label').html(ksk_unit);

      // modal.find('#v_ksk_staff option').each(function() {
      //     if ($(this).val() == ksk_staff)
      //         $(this).attr("selected", "selected");
      // });
      // modal.find('#v_ksk_staff_label').html($('#v_ksk_staff option:selected').text());
      modal.find('#v_ksk_staff_label').html(ksk_staff);

      // $('#dpdays3').datepicker({
      //     format: "yyyy-mm-dd",
      // });

      modal.find('#v_ksk_waktu').html(ksk_mddt);

    });



    function toggleFullscreen(event) {
      var element = document.getElementById(event);

      if (event instanceof HTMLElement) {
        element = event;
      }

      var isFullscreen = document.webkitIsFullScreen || document.mozFullScreen || false;

      element.requestFullScreen = element.requestFullScreen || element.webkitRequestFullScreen || element.mozRequestFullScreen || function() {
        return false;
      };
      document.cancelFullScreen = document.cancelFullScreen || document.webkitCancelFullScreen || document.mozCancelFullScreen || function() {
        return false;
      };

      if (isFullscreen) {
        document.cancelFullScreen();
      } else {
        element.requestFullScreen();
      }
    }
  </script>
</body>

</html>