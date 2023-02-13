<?php require('module/absen/abs_act.php'); ?>
<!-- Content Header (Page header) -->

  <section class="content-header">

    <h1>

      <?php echo $title;?>

      <small>Bulanan</small>

    </h1>

    <ol class="breadcrumb">

      <li><a href="#"><i class="fa fa-dashboard"></i> Level</a></li>

      <li class="active"><?php echo $title;?></li>

    </ol>

  </section>



  <!-- Main content -->

  <section class="content">


    <!-- Your Page Content Here -->

    <div class="box">

	    <div class="box-header">

		      <h3 class="box-title">
			
			    <?php

			      if(!empty($_SESSION['bulan']) || !empty($_SESSION['divisi'])){
      
				      $pecah_tgl = explode( "-", $date );
      
				      $tgl_rpt = $pecah_tgl[2];

				      $date_rpt = $_SESSION['bulan']."-".$tgl_rpt;	

				      echo "<span class='label label-primary'>".substr($tgl->tgl_indo($date_rpt), 3,20)."</span>";

			      }
      
			     ?>
		      
		       </h3>

		      <div class="pull-right">

                  <form class="form-inline" method="post" action="">
		    <?php
		      if(!empty($_SESSION['bulan']) || !empty($_SESSION['divisi'])){
		    ?>	
		    <div class="form-group">
		      <!--<input type="hidden" name="tglekspor" id="tglekspor" value="">-->
		      <button type="button" onclick="rptpointabsen_ekspor()"  class="btn btn-md btn-success"><i class="fa fa-file-excel-o"></i> <strong>POINT</strong></button>
		      <button type="button" onclick="rptdetailabsen_ekspor()"  class="btn btn-md btn-success"><i class="fa fa-file-excel-o"></i> <strong>DETAIL</strong></button>
		      <button type="button" onclick="rptrewardabsen_ekspor()"  class="btn btn-md btn-success"><i class="fa fa-file-excel-o"></i> <strong>REWARD</strong></button>
		    </div>
		    <?php }?>
		    <div class="form-group">
		      <?php
		      if(!empty($_SESSION['bulan']) || !empty($_SESSION['divisi'])){
			$filter_aktif=" : <em>Active</em>";
		      }
		      ?>
		      <span class="btn btn-md btn-warning" data-toggle="modal" data-target="#filterrptabsen"><i class="fa fa-search"></i> Filter <?php echo $filter_aktif;?></span>
		    </div>
		    <div class="form-group">
		      <button type="submit" name="brefreshrptabsen" data-toggle="tooltip"  class="btn btn-md btn-default" title="Kembali ke default, kosongkan Filter"><i class="fa fa-refresh"></i></button>
		    </div>
		    

                  </form>

                  </div>

	    </div><!-- /.box-header -->

	    <div class="box-body">

	    	<table id="tb_report_abs" class="table table-bordered table-hover table-striped">

				<thead>

				<tr>

					<th>NIK</th>

                                        <th>Nama</th>

                                        <th>Divisi</th>

					<th><span class="label label-primary">Hadir</span></th>

                                        <th><span class="label label-danger">Point</span></th>
					

                                        <!--

                                        <th><span class="label label-warning">Izin</span></th>

                                        <th><span class="label label-success">Sakit</span></th>

                                        <th><span class="label label-danger">Alpa</span></th>

                                        <th><span class="label label-danger">Libur</span></th>

                                        <th><span class="label label-danger">Cuti</span></th>

                                        -->

				</tr>

				</thead>

	            <tbody>

			<?php
			
			if(!empty($_SESSION['bulan']) || !empty($_SESSION['divisi'])){
			  
			$div_id_=$_SESSION['divisi'];
			
			$kar_tampil_div=$kar->kar_tampil_div($div_id_);

			foreach ($kar_tampil_div as $data) {

			/*
                        $abs_tgl_rpt_bln=$abs->abs_tgl_rpt_bln($kar_id_,$tgl_1,$tgl_31);

                        $abs_data_rpt_bln=mysql_fetch_assoc($abs_tgl_rpt_bln);

                        $abs_cek_rpt_bln=mysql_num_rows($abs_tgl_rpt_bln);

                        

                        $abs_tgl_rpt_point=$abs->abs_tgl_rpt_point($kar_id_,$tgl_1,$tgl_31);

                        $abs_cek_point=mysql_fetch_assoc($abs_tgl_rpt_point);

                        $abs_total_point=$abs_cek_point['point'];
                        */
			
			$abs_cek_rpt_bln=$reportabsen[$data['kar_id']]["abs_cek_rpt_bln_array"]?$reportabsen[$data['kar_id']]["abs_cek_rpt_bln_array"]:'0';
			$abs_total_point=$pointabsen[$data['kar_id']]["abs_total_point_array"];

			?>

				<tr>

					<td><?php echo $data['kar_nik'];?></td>

					<td><a href="javascript:;"
					data-kar_id="<?php echo $data['kar_id'];?>"
					data-kar_nm="<?php echo $data['kar_nm'];?>" data-toggle="modal" data-target="#detailabsen" title="Detail Absen"><i class="fa fa-bars" aria-hidden="true"></i>&nbsp;&nbsp;<?php echo $data['kar_nm'];?></a></td>

                                        <td><?php echo $data['div_nm'];?></td>

					<td class="info"><strong><?php echo $abs_cek_rpt_bln;?></strong> <sup>Hari</sup></td>

                                        <td class="danger"><strong><?php echo $abs_total_point ? $abs_total_point: '0';?></strong> <sup>Point</sup></td>

                                        <!--

                                        <td class="warning">&nbsp;</td>

                                        <td class="success">&nbsp;</td>

                                        <td class="danger">&nbsp;</td>

                                        <td class="danger">&nbsp;</td>

                                        <td class="danger">&nbsp;</td>

                                        -->

				</tr>

			<?php }}?>
			
	<?php
	/*
	$div_id_=$_SESSION['divisi'];	
	$kar_tampil_div=$kar->kar_tampil_div($div_id_);
	foreach ($kar_tampil_div as $data) {
	  $idnya=$data['kar_id'];
	  for(${'i'.$idnya}=$sesidate; ${'i'.$idnya}<=$akhirbulan; ${'i'.$idnya}++){
	      $rewardabsen_tmp[$idnya][${'i'.$idnya}]=array("kar_id"=>"",
								"abs_tgl_masuk"=>"",
								"abs_masuk"=>"",
								"abs_pulang"=>"",
								"abs_rwd_masuk"=>"",
								"abs_rwd_pulang"=>"");
	  }
	}
	
	
	
	$sesdivisi=$_SESSION['divisi'];
	$abs_tampil_allkar_2=$abs->abs_tampil_allkar_2($sesdivisi,$sesidate,$akhirbulan);
	while($abs_data_allkar_2=mysql_fetch_assoc($abs_tampil_allkar_2)){
	  
	       $rewardabsen_tmp[$abs_data_allkar_2['kar_id']][$abs_data_allkar_2['abs_tgl_masuk']]=array("kar_id"=>$abs_data_allkar_2['kar_id'],
								"abs_tgl_masuk"=>$abs_data_allkar_2['abs_tgl_masuk'],
								"abs_masuk"=>$abs_data_allkar_2['abs_masuk'],
								"abs_pulang"=>$abs_data_allkar_2['abs_pulang'],
								"abs_rwd_masuk"=>$abs_data_allkar_2['abs_rwd_masuk'],
								"abs_rwd_pulang"=>$abs_data_allkar_2['abs_rwd_pulang']);
								
	}
	
	echo $rewardabsen_tmp[13]['2017-03-01']["abs_rwd_masuk"];
	
	echo"<pre>";
	print_r($rewardabsen_tmp);
	echo"</pre>";
	*/
	?>

				</tbody>	

			</table>

		</div>

	</div>	

  </section><!-- /.content -->
  
  
  <style type="text/css">
    #loading{
      text-align: center;
      display: none;
      position: fixed;
      background-color: rgba(0, 0, 0, 0.3);
      z-index: 1000;
      left: 0;
      top: 0;
      height: 100%;
      width: 100%;
      padding-top:10%;
    }
    #output{
      font-size: 10px;
    }
    </style>
    
    <div id="loading"><img src="dist/img/loadingnew3.gif" /></div>
  


<!-- Modal Filter Report Absen -->
<div class="modal fade" id="filterrptabsen" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header bg-yellow">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel"><i class="fa fa-line-chart"></i> Filter Report Absen</h4>
      </div>
      <form class="form-horizontal" action="" method="post">
      <div class="modal-body">
        <div class="form-group">
            <label for="bulan" class="col-sm-2 control-label">Bulan</label>
            <div class="col-sm-10">
              <div class="input-group">
                      <div class="input-group-addon">
                        <i class="fa fa-calendar"></i>
                      </div>
                      <?php
                      if(!empty($_SESSION['bulan'])){
                        $data_priode=$_SESSION['bulan'];
                      }else{
                        $data_priode=$bulan_aktif;
                      }
                      ?>
                      <input type="text" name="bulan" value="<?php echo $data_priode;?>" class="form-control pull-right" id="sort_bulan" readonly/>
                    </div><!-- /.input group -->
            </div>
          </div>

         <div class="form-group">
            <label for="divisi" class="col-sm-2 control-label">Divisi</label>
            <div class="col-sm-10">
              <?php
              if(!empty($_SESSION['divisi'])){
                $data_divisi=$_SESSION['divisi'];
              }else{
                $data_divisi=4;
              }
              ?>
              <div class="bfh-selectbox" data-name="divisi" data-value="<?php echo $data_divisi;?>" data-filter="true">
              <?php
                  $div_tampil=$div->div_tampil();
                  if($div_tampil){
                  foreach($div_tampil as $data){
		    if(($data['div_id']!=="1")&&($data['div_id']!=="2")){
               ?>
              <div data-value="<?php echo $data['div_id'];?>"><?php echo $data['div_nm'];?></div>
              <?php }}}?>    
             </div>
            </div>
           </div>
         
    
      </div>
      <div class="modal-footer">
        <small class="pull-left text-red"><em><strong>**) Filter sesuai dengan kebutuhan</strong></em></small>
        <button type="submit" name="bfilterrptabsen" class="btn btn-warning"><i class="fa fa-search"></i></button>
      </div>
      </form>
    </div>
  </div>
</div>


<!-- Modal Detail Absen -->
<div class="modal fade" id="detailabsen" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header bg-primary">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel"><i class="fa fa-line-chart"></i> Absensi <strong id="kar_nm"></strong></h4>
      </div>
      <form class="form-horizontal" action="" method="post">
      <div class="modal-body">
        
         <span class="fetched-data">
	    <div class="progress" id="loading">
	      <div class="progress-bar progress-bar-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100" style="width:100%">
	      </div>
	    </div>
	 </span>
    
      </div>
      <div class="modal-footer">
        <small class="pull-left text-red"><em><strong></strong></em></small>
      </div>
      </form>
    </div>
  </div>
</div>



