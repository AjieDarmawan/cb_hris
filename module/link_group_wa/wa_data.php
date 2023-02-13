<?php
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
    
    $dataArr[] = array( 'gwa_propinsi'=>$gwa_propinsi,
                        'gwa_kota'=>$gwa_kota,
                        'gwa_nama'=>$gwa_nama,
                       'gwa_tautan'=>$gwa_tautan,
                       'gwa_tanggal'=>$gwa_tanggal);
       
    $total++;
    $summaryArr['total'] = $total;
}

/*echo "<pre>";
print_r($summaryArr);
echo "</pre>";*/
?>

<!-- Content Header (Page header) -->
<section class="content-header">
  <h1> <?php echo $title;?> <small></small> </h1>
  <ol class="breadcrumb">
    <li><a href="media.php"><i class="fa fa-dashboard"></i> Dashboard</a></li>
    <li class="active"><?php echo $title;?></li>
  </ol>
</section>

<!-- Main content -->
<section class="content">
  
  <!-- Your Page Content Here -->
  <div class="row">
    <div class="col-xs-12">
      <div class="box">
	<div class="box-header">
	  <h3 class="box-title">
            Link Group WA
	  </h3>
	</div>
	<!-- /.box-header -->
	<div class="box-body table-responsive">
            <table id="dt_link_group_wa" class="table table-dark table-sm table-hover table-bordered">
                <thead class="thead-light text-center">
                    <tr>
                        <th>No</th>
                        <th>Nama</th>                       
                        <th>Tautan</th>
                        <th>Kota</th>
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
                        <td><?php echo $val['gwa_nama'];?></td>
                        <td><a href=<?php echo $val['gwa_tautan'];?>><?php echo $val['gwa_tautan'];?></a></td>
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
  
</section>