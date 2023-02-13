<?php require('module/mutasi/mts_act.php'); ?>
<!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            <?php echo $title;?>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active"><?php echo $title;?></li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
          <div class="row">
	    
            <div class="col-md-12">

              <div class="box box-primary">
                <div class="box-header with-border">
                  <h3 class="box-title"><?php echo $kar_data_['kar_nm'];?>  -  <?php echo $thn__;?></h3>
                  <div class="pull-right box-tools"><small></small></div>
                </div><!-- /.box-header -->
                <div class="box-body">
                    
                    <!-- Table row -->
                    <div class="row">
                      <div class="col-xs-12 table-responsive">
                  
                                      
                                <table class="table table-hover">
                                  <thead>
                                  <tr>
                                    <th rowspan="2">Aspek Penilaian</th>
                                    <?php
				    $fpk_tampil_thn=$nla->fpk_tampil_thn($kar_id_,$thn__);   
                                    for($i=1; $fpk_data_thn=mysql_fetch_array($fpk_tampil_thn); $i++){
					$fpk_cek_thn=mysql_num_rows($fpk_tampil_thn);
					if($fpk_cek_thn > 0){
					    $pecah=explode(" ",$tgl->tgl_indo($fpk_data_thn['fpk_tgl']));
					    $thnnya=$pecah[2];
					    $blnnya=$pecah[1];
					    $tglnya=$pecah[0];
                                    ?>
                                    <th colspan="2"><center><?php echo $blnnya;?></center></th>
                                    <?php }}?>
                                  </tr>
                                  <tr>
                                    <?php
				    $fpk_tampil_thn=$nla->fpk_tampil_thn($kar_id_,$thn__);   
                                    for($a=1; $fpk_data_thn=mysql_fetch_array($fpk_tampil_thn); $a++){
				      $fpk_cek_thn=mysql_num_rows($fpk_tampil_thn);
					if($fpk_cek_thn > 0){
                                    ?>
                                    <th class="active">Angka</th>
                                    <th class="active">Nilai</th>
                                    <?php }}?>
                                  </tr>
                                </thead>    
                                  <tbody>
                                    
                                    <?php
                                    $fpk_tampil_point=$nla->fpk_tampil_point_all();
                                    while($fpk_data_point=mysql_fetch_array($fpk_tampil_point)){
                                       $z=$fpk_data_point['fpk_point_id'];
                                    ?>  
                                    <tr>
                                      <td><i class="fa fa-check-square-o"></i>&nbsp; <?php echo $fpk_data_point['fpk_point_nm']; ?></td>
                                      <?php
				      $fpk_tampil_thn=$nla->fpk_tampil_thn($kar_id_,$thn__);   
                                      for($i=1; $fpk_data_thn=mysql_fetch_array($fpk_tampil_thn); $i++){
					$fpk_cek_thn=mysql_num_rows($fpk_tampil_thn);
					if($fpk_cek_thn > 0){
					  
					  $x = "fpk_nilai{$z}";
                                       
					  if($fpk_data_thn[$x]!=="0"){
					     $fpk_bobot=$fpk_data_thn[$x];
					  }else{
					     $fpk_bobot="-";
					  }
                                       
					  $fpk_grade=$fpk_data_thn[$x];
					  $fpk_tampil_grade=$nla->fpk_tampil_grade($fpk_grade);
					  $fpk_data_grade=mysql_fetch_array($fpk_tampil_grade);
					  
					  $jumlah_nilai=$jumlah_nilai + $fpk_data_thn[$x];
					  
					  $arr=array(
						     $fpk_data_thn['fpk_nilai1'],
						     $fpk_data_thn['fpk_nilai2'],
						     $fpk_data_thn['fpk_nilai3'],
						     $fpk_data_thn['fpk_nilai4'],
						     $fpk_data_thn['fpk_nilai5'],
						     $fpk_data_thn['fpk_nilai6'],
						     $fpk_data_thn['fpk_nilai7'],
						     $fpk_data_thn['fpk_nilai8'],
						     $fpk_data_thn['fpk_nilai9'],
						     $fpk_data_thn['fpk_nilai10'],
						     $fpk_data_thn['fpk_nilai11'],
						     $fpk_data_thn['fpk_nilai12'],
						     $fpk_data_thn['fpk_nilai13'],
						     $fpk_data_thn['fpk_nilai14'],
						     $fpk_data_thn['fpk_nilai15'],
						     $fpk_data_thn['fpk_nilai16'],
						     $fpk_data_thn['fpk_nilai17'],
						     $fpk_data_thn['fpk_nilai18']
						     );
					  $nilai_rata_rata=$hit->hitung_median($arr);
					  
					  if(($i % 2)==0){
					    $warna="success";
					  }else{
					    $warna="info";
					  }
					  
                                      ?>
                                      <td class="<?php echo $warna;?>"><?php echo $fpk_data_thn[$x];?></td>
                                      <td class="<?php echo $warna;?>"><?php echo $fpk_data_grade['fpk_huruf'];?></td>
                                      <?php }}?>
                                    </tr>
                                    <?php }
				    
				    
				      $fpk_grade=$nilai_rata_rata;
				      $fpk_tampil_grade=$nla->fpk_tampil_grade($fpk_grade);
				      $fpk_data_grade=mysql_fetch_array($fpk_tampil_grade);
				    ?>
				    <tr class="active">
					<th colspan="10"></th>
				    </tr>
                                    <tr>
                                      <td><center><strong>Jumlah Nilai</strong></center></td>
                                      <?php
				      $fpk_tampil_thn=$nla->fpk_tampil_thn($kar_id_,$thn__);   
                                      for($i=1; $fpk_data_thn=mysql_fetch_array($fpk_tampil_thn); $i++){
					$fpk_cek_thn=mysql_num_rows($fpk_tampil_thn);
					if($fpk_cek_thn > 0){
                                      ?>
                                      <td class="warning"><em><strong><?php echo $jumlah_nilai; ?></strong></em></td>
                                      <td class="warning"></td>
                                      <?php }}?>
                                    </tr>
                                    <tr>
                                      <td><center><strong>Nilai Rata-rata</strong></center></td>
                                      <?php
				      $fpk_tampil_thn=$nla->fpk_tampil_thn($kar_id_,$thn__);   
                                      for($i=1; $fpk_data_thn=mysql_fetch_array($fpk_tampil_thn); $i++){
					$fpk_cek_thn=mysql_num_rows($fpk_tampil_thn);
					if($fpk_cek_thn > 0){
                                      ?>
                                      <td class="danger"><strong><?php echo $nilai_rata_rata;?></strong></td>
                                      <td class="danger"><strong><?php echo $fpk_data_grade['fpk_huruf'];?></strong></td>
                                      <?php }}?>
                                    </tr>
				    <tr class="active">
					<th colspan="10"></th>
				    </tr>
				    <tr>
                                      <td><strong>Prestasi</strong></td>
                                      <?php
				      $fpk_tampil_thn=$nla->fpk_tampil_thn($kar_id_,$thn__);   
                                      for($i=1; $fpk_data_thn=mysql_fetch_array($fpk_tampil_thn); $i++){
					$fpk_cek_thn=mysql_num_rows($fpk_tampil_thn);
					if($fpk_cek_thn > 0){
                                      ?>
                                      <td colspan="13"><strong><em><?php echo strip_tags(substr(str_replace('"','',$fpk_data_thn['fpk_prestasi']),0,30)); ?></em> <span data-toggle="tooltip" title="<?php echo strip_tags(str_replace('"','',$fpk_data_thn['fpk_prestasi']));?>" style="cursor:pointer">...</span></strong></td>
                                      <?php }}?>
                                    </tr>
				    <tr>
                                      <td><strong>Pelanggaran</strong></td>
                                      <?php
				      $fpk_tampil_thn=$nla->fpk_tampil_thn($kar_id_,$thn__);   
                                      for($i=1; $fpk_data_thn=mysql_fetch_array($fpk_tampil_thn); $i++){
					$fpk_cek_thn=mysql_num_rows($fpk_tampil_thn);
					if($fpk_cek_thn > 0){
                                      ?>
                                      <td colspan="2"><strong><em><?php echo strip_tags(substr(str_replace('"','',$fpk_data_thn['fpk_pelanggaran']),0,30)); ?></em> <span data-toggle="tooltip" title="<?php echo strip_tags(str_replace('"','',$fpk_data_thn['fpk_pelanggaran']));?>" style="cursor:pointer">...</span></strong></td>
                                      <?php }}?>
                                    </tr>
				    <tr>
                                      <td><strong>Saran Perbaikan</strong></td>
                                      <?php
				      $fpk_tampil_thn=$nla->fpk_tampil_thn($kar_id_,$thn__);   
                                      for($i=1; $fpk_data_thn=mysql_fetch_array($fpk_tampil_thn); $i++){
					$fpk_cek_thn=mysql_num_rows($fpk_tampil_thn);
					if($fpk_cek_thn > 0){
                                      ?>
                                      <td colspan="2"><strong><em><?php echo strip_tags(substr(str_replace('"','',$fpk_data_thn['fpk_saranperbaikan']),0,30)); ?></em> <span data-toggle="tooltip" title="<?php echo strip_tags(str_replace('"','',$fpk_data_thn['fpk_saranperbaikan']));?>" style="cursor:pointer">...</span></strong></td>
                                      <?php }}?>
                                    </tr>
				    <tr class="active">
					<th colspan="10"></th>
				    </tr>
				    <tr>
                                      <td><strong>Penilai</strong></td>
                                      <?php
				      $fpk_tampil_thn=$nla->fpk_tampil_thn($kar_id_,$thn__);   
                                      for($i=1; $fpk_data_thn=mysql_fetch_array($fpk_tampil_thn); $i++){
					$fpk_cek_thn=mysql_num_rows($fpk_tampil_thn);
					if($fpk_cek_thn > 0){
					  
					  $fpk_penilai_=$fpk_data_thn['fpk_penilai'];
					  $fpk_tampil_penilai=$kar->kar_tampil_id($fpk_penilai_);
					  $fpk_data_penilai=mysql_fetch_array($fpk_tampil_penilai);
                                      ?>
                                      <td colspan="2"><center><strong>( <u><?php echo $fpk_data_penilai['kar_nm'];?></u> )</strong></center></td>
                                      <?php }}?>
                                    </tr>
                                   
                                  </tbody>
                                </table>
           
                        
                        
                      </div><!-- /.col -->
                    </div><!-- /.row -->
                            
                </div><!-- /.box-body -->
                <div class="box-footer">
                  <button type="button" class="btn btn-sm btn-default" onclick="history.back(-1);"><i class="fa fa-chevron-left"></i> Back</button>
                </div><!-- /.box-footer -->
              </div><!-- /. box -->


            </div><!-- /.col -->
          </div><!-- /.row -->
        </section><!-- /.content -->
