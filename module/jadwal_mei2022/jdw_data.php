<?php 

			date_default_timezone_set("Asia/Bangkok");
		    require('module/jadwal_mei2022/jdw_act.php'); 

		    $xtgl = date('Y-m');
			$ch   = curl_init();
			curl_setopt($ch, CURLOPT_URL,"http://103.86.160.10/sipema/api/api_pmb.php");
			curl_setopt($ch, CURLOPT_POST, 1);
			curl_setopt($ch, CURLOPT_POSTFIELDS,"tgl=$xtgl");
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			$server_output = curl_exec($ch);
			curl_close ($ch);
			$json_data=json_decode($server_output,true);



           function cek_totalpmb($cektgl,$json_data ){
		        $g_total = 0;
				foreach($json_data as $k=>$v) {
				  $tgl = $v['tanggal'];
				  if ($tgl==$cektgl){
					$tot_p2k = $v['tot_p2k'];
					$tot_p2r = $v['tot_p2r'];
				  }
				}	
				$gtotal = $tot_p2k+$tot_p2r ;
				return $gtotal;
		   
		   }				
		   
?>

<!-- Content Header (Page header) -->

    <section class="content-header">

      <h1> <?php echo $title;?> <small><?php echo substr($tgl->tgl_indo($datemax), 3,20);?></small> </h1>

      <ol class="breadcrumb">

        <li><a href="media.php"><i class="fa fa-dashboard"></i> Dashboard</a></li>

        <li class="active"><?php echo $title;?> <?php echo substr($tgl->tgl_indo($datemax), 3,20);?></li>

      </ol>

    </section>

    

    <!-- Main content -->

    <section class="content"> 

      

      <!-- Your Page Content Here -->

      <div class="row">

        <div class="col-xs-12">

            

            <div class="nav-tabs-custom">

            <ul class="nav nav-tabs pull-right">

              <li class="<?php if($zona == "JABODETABEK"){ echo 'active'; }else{ echo '';}?>"><a href="?p=<?php echo $page.'&zona=1';?>"><strong>JABODETABEK</strong></a></li>

              <li class="<?php if($zona == "LUAR KOTA"){ echo 'active'; }else{ echo '';}?>"><a href="?p=<?php echo $page.'&zona=2';?>"><strong>LUAR KOTA</strong></a></li>

              <?php

              if(($kar_data['kar_id']=="447") || 
              	 	($kar_data['kar_id']=="255") ||
              	 	($kar_data['kar_id']=="430") ||
              	    ($kar_data['kar_id']=="248") ||
              	    ($kar_data['kar_id']=="453") ||
              	    ($kar_data['kar_id']=="13") ||
					($kar_data['kar_id']=="551") ||
					($kar_data['kar_id']=="542") ||
					($kar_data['kar_id']=="476")){
              	 	
              ?>

              <!--<li class="pull-left header"><span style="cursor:pointer" class="label label-primary" data-toggle="modal" data-target="#myModal"><i class="fa fa-plus"></i></span></li>-->

              <?php }?>
<a href="?p=jadwal" class="label label-info">Lihat Jadwal April 2022</a>
            </ul>

            <div class="tab-content">

              <div class="tab-pane active visible-lg-block">

                

                <table id="tb_jadwal" class="table table-hover table-striped table-bordered nowrap" style="width:100%">

		    <thead>

			<tr>

			    <th rowspan="2" class="pinned" style="vertical-align:middle; text-align:center;">NIK</th>

			    <th rowspan="2" class="pinned" style="vertical-align:middle; text-align:center;">Nama</th>
			    
			    <th rowspan="2" class="pinned" style="vertical-align:middle; text-align:center;">Divisi</th>

			    <th rowspan="2" class="pinned" style="vertical-align:middle; text-align:center;">Wilayah</th>

			    <th rowspan="2" class="pinned" style="vertical-align:middle; text-align:center;">Libur</th>

			    <?php

			    for($d=0;$d<=$maxDays-1;$d++){
			      $day = $d + 1;
			      $carihari = $thnbln."-".sprintf("%02d",$day);
				  $cektgl   = $carihari; 
				  $tot_p2k = 0; $tot_p2r = 0 ;
				  $jum_pmb = cek_totalpmb($cektgl,$json_data);		
			      if(hari_ini($carihari) == "MGG"){
						$bordercolor = "border-right: 2px solid black";
			      }else{
						$bordercolor = "";
			      }

			    ?>

			    <th style="<?php echo $bordercolor;?>">
					<span class="label label-warning"><?php echo $jum_pmb;?></span>
					<br>
					<?php echo hari_ini($carihari);?>
				</th>

			    <?php }?>

			</tr>

			<tr>

			    <?php

			    for($d=0;$d<=$maxDays-1;$d++){
			      $day = $d + 1;
			      $carihari = $thnbln."-".sprintf("%02d",$day);
			      if(hari_ini($carihari) == "MGG"){
						$bordercolor = "border-right: 2px solid black";
			      }else{
						$bordercolor = "";
			      }

			    ?>

			    <th style="<?php echo $bordercolor;?>"><span class="label label-success"><?php echo $day;?></span></th>

			    <?php }?>

			</tr>

		    </thead>

		    <tbody>

		      <?php

		      for($i=0;$i<count($dataArr);$i++){

			$jdw_nik = $dataArr[$i]['jdw_nik'];

			$jdw_nama = $dataArr[$i]['jdw_nama'];
			
			$jdw_divisi = $dataArr[$i]['jdw_divisi'];

			$jdw_wilayah = $dataArr[$i]['jdw_wilayah'];
			
			$jdw_id = $dataArr[$i]['jdw_id'];

			

			$libur = $sumLibur[$jdw_nik] ? $sumLibur[$jdw_nik] : 0;

		      ?>

			<tr>

			    <td><small><?php echo $jdw_nik;?></small></td>

			    <td><small>

			    <?php

	              if(($kar_data['kar_id']=="447") || 
	              	 	($kar_data['kar_id']=="255") ||
	              	 	($kar_data['kar_id']=="430") ||
	              	    ($kar_data['kar_id']=="248") ||
	              	    ($kar_data['kar_id']=="453") ||
						($kar_data['kar_id']=="551") ||
						($kar_data['kar_id']=="542") ||
	              	    ($kar_data['kar_id']=="13") ||
					    ($kar_data['kar_id']=="476")){
	              	 	
	              ?>

			    <a href="javascript:;"
					data-kar_nik="<?php echo $jdw_nik;?>"
					data-kar_nm="<?php echo $jdw_nama;?>"
					data-div_nm="<?php echo $jdw_divisi;?>"
					data-jdw_id="<?php echo $jdw_id;?>" data-toggle="modal" data-target="#" title="Edit Jadwal"><?php echo $jdw_nama;?></a>

					<?php }else{?>
						<?php echo $jdw_nama;?>
					<?php }?>

					</small></td>
			    
			    <td><small><?php echo $jdw_divisi;?></small></td>

			    <td><span class="label label-default"><?php echo $jdw_wilayah;?></span></td>

			    <td><span class="label label-warning"><?php echo $libur;?></span></td>

			    <?php

			    for($d=0;$d<=$maxDays-1;$d++){

			      $day = $d + 1;

			      

			      $pos_GL = strpos($dataArr2[$jdw_nik][$day],'GL');

			      $pos_C = strpos($dataArr2[$jdw_nik][$day],'C-');

			      $pos_HC = strpos($dataArr2[$jdw_nik][$day],'HC-');

			      

			      if($dataArr2[$jdw_nik][$day] == 'L' ||

				 $dataArr2[$jdw_nik][$day] == 'LM' ||

				 $dataArr2[$jdw_nik][$day] == 'LN' ||

                                 $dataArr2[$jdw_nik][$day] == 'C'){

				$bgcolor = "danger";

			      }elseif($dataArr2[$jdw_nik][$day] == 'Sebar' ||
				      $dataArr2[$jdw_nik][$day] == 'WFH'){

				$bgcolor = "info";

			      }elseif($pos_GL !== false ||

				      $pos_C !== false ||

				      $pos_HC !== false){

				$bgcolor = "success";

			      }else{

				$bgcolor = "default";

			      }

			      

			      $carihari = $thnbln."-".sprintf("%02d",$day);

			      if(hari_ini($carihari) == "MGG"){

				$bordercolor = "border-right: 2px solid black";

			      }else{

				$bordercolor = "";

			      }

			    ?>

			    <td style="<?php echo $bordercolor;?>" class="success"><span class="label label-<?php echo $bgcolor;?>"><?php echo $dataArr2[$jdw_nik][$day];?></span></td>

			    <?php }?>

			</tr>

		      <?php }?> 

		    </tbody>

		  </table>

                

              </div>
	      
	      <div class="tab-pane active hidden-lg">

                

                <table id="tb_jadwal_res" class="table table-hover table-striped table-bordered nowrap" style="width:100%">

		    <thead>

			<tr>

			    <th rowspan="2" class="pinned" style="vertical-align:middle; text-align:center;">NIK</th>

			    <th rowspan="2" class="pinned" style="vertical-align:middle; text-align:center;">Nama</th>
			    
			    <th rowspan="2" class="pinned" style="vertical-align:middle; text-align:center;">Divisi</th>

			    <th rowspan="2" class="pinned" style="vertical-align:middle; text-align:center;">Wilayah</th>

			    <th rowspan="2" class="pinned" style="vertical-align:middle; text-align:center;">Libur</th>

			    <?php

			    for($d=0;$d<=$maxDays-1;$d++){

			      $day = $d + 1;

			      $carihari = $thnbln."-".sprintf("%02d",$day);

			      if(hari_ini($carihari) == "MGG"){

				$bordercolor = "border-right: 2px solid black";

			      }else{

				$bordercolor = "";

			      }

			    ?>

			    <th style="<?php echo $bordercolor;?>"><?php echo hari_ini($carihari);?></th>

			    <?php }?>

			</tr>

			<tr>

			    <?php

			    for($d=0;$d<=$maxDays-1;$d++){

			      $day = $d + 1;

			      $carihari = $thnbln."-".sprintf("%02d",$day);

			      if(hari_ini($carihari) == "MGG"){

				$bordercolor = "border-right: 2px solid black";

			      }else{

				$bordercolor = "";

			      }

			    ?>

			    <th style="<?php echo $bordercolor;?>"><span class="label label-primary"><?php echo $day;?></span></th>

			    <?php }?>

			</tr>

		    </thead>

		    <tbody>

		      <?php

		      for($i=0;$i<count($dataArr);$i++){

			$jdw_nik = $dataArr[$i]['jdw_nik'];

			$jdw_nama = $dataArr[$i]['jdw_nama'];
			
			$jdw_divisi = $dataArr[$i]['jdw_divisi'];

			$jdw_wilayah = $dataArr[$i]['jdw_wilayah'];

			

			$libur = $sumLibur[$jdw_nik] ? $sumLibur[$jdw_nik] : 0;

		      ?>

			<tr>

			    <td><small><?php echo $jdw_nik;?></small></td>

			   <td><small>

			    <?php

	              if(($kar_data['kar_id']=="447") || 
	              	 	($kar_data['kar_id']=="255") ||
	              	 	($kar_data['kar_id']=="430") ||
	              	    ($kar_data['kar_id']=="248") ||
	              	    ($kar_data['kar_id']=="453") ||
						($kar_data['kar_id']=="551") ||
						($kar_data['kar_id']=="542") ||
	              	    ($kar_data['kar_id']=="13") ||
					    ($kar_data['kar_id']=="476")){
	              	 	
	              ?>

			    <a href="javascript:;"
					data-kar_nik="<?php echo $jdw_nik;?>"
					data-kar_nm="<?php echo $jdw_nama;?>"
					data-div_nm="<?php echo $jdw_divisi;?>"
					data-jdw_id="<?php echo $jdw_id;?>" data-toggle="modal" data-target="#editjadwal" title="Edit Jadwal"><?php echo $jdw_nama;?></a>

					<?php }else{?>
						<?php echo $jdw_nama;?>
					<?php }?>

					</small></td>
			   
			    <td><small><?php echo $jdw_divisi;?></small></td>

			    <td><span class="label label-default"><?php echo $jdw_wilayah;?></span></td>

			    <td><span class="label label-warning"><?php echo $libur;?></span></td>

			    <?php

			    for($d=0;$d<=$maxDays-1;$d++){

			      $day = $d + 1;

			      

			      $pos_GL = strpos($dataArr2[$jdw_nik][$day],'GL');

			      $pos_C = strpos($dataArr2[$jdw_nik][$day],'C-');

			      $pos_HC = strpos($dataArr2[$jdw_nik][$day],'HC-');

			      

			      if($dataArr2[$jdw_nik][$day] == 'L' ||

				 $dataArr2[$jdw_nik][$day] == 'LM' ||

				 $dataArr2[$jdw_nik][$day] == 'LN' ||

                                 $dataArr2[$jdw_nik][$day] == 'C'){

				$bgcolor = "danger";

			      }elseif($dataArr2[$jdw_nik][$day] == 'Sebar'){

				$bgcolor = "info";

			      }elseif($pos_GL !== false ||

				      $pos_C !== false ||

				      $pos_HC !== false){

				$bgcolor = "success";

			      }else{

				$bgcolor = "default";

			      }

			      

			      $carihari = $thnbln."-".sprintf("%02d",$day);

			      if(hari_ini($carihari) == "MGG"){

				$bordercolor = "border-right: 2px solid black";

			      }else{

				$bordercolor = "";

			      }

			    ?>

			    <td style="<?php echo $bordercolor;?>" class="success"><span class="label label-<?php echo $bgcolor;?>"><?php echo $dataArr2[$jdw_nik][$day];?></span></td>

			    <?php }?>

			</tr>

		      <?php }?> 

		    </tbody>

		  </table>

                

              </div>

              

            </div>

            <!-- /.tab-content -->

          </div>

          <!-- nav-tabs-custom -->          

        </div>

        <!-- /.col --> 

      </div>

      <!-- /.row --> 
    </section>
    
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

<!-- POPUP -->

<!-- Button trigger modal -->





<!-- Modal -->

<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">

  <div class="modal-dialog">

    <div class="modal-content">

      <div class="modal-header bg-primary">

        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>

        <h4 class="modal-title" id="myModalLabel"><i class="fa fa-calendar"></i> Upload Jadwal</h4>

      </div>

      <form class="form-horizontal" action="" method="post" enctype="multipart/form-data">

      <div class="modal-body">

          <div class="form-group">

            <label for="jdw_bulan" class="col-sm-2 control-label">Bulan</label>

            <div class="col-sm-10">

              <input type="text" name="jdw_bulan" class="form-control dpmonth" id="jdw_bulan" placeholder="Bulan" required readonly>

            </div>

          </div>

	  <div class="form-group">

            <label for="jdw_file" class="col-sm-2 control-label">File</label>

            <div class="col-sm-10">

              <div class="btn btn-default btn-file" id="file">

                    <i class="fa fa-paperclip"></i> Attachment File

              </div>

                    <input type="file" name="jdw_file" accept="application/vnd.openxmlformats-officedocument.spreadsheetml.sheet" required/>

                    <small class="help-block"><em>Max. 5MB</em></small>

            </div>

          </div>
	  
	  <div class="form-group">

            <label for="jdw_bulan" class="col-sm-2 control-label">Setting</label>

            <div class="col-sm-10">

              Aktifkan sebagai bulan default(ditampilkan): <br>
	      <input type="radio" name="jdw_setting" value="Y"> Ya
	      &nbsp;&nbsp;&nbsp;&nbsp;
	      <input type="radio" name="jdw_setting" value="T" checked> Tidak

            </div>

          </div>

      </div>

      <div class="modal-footer">

        <button type="submit" name="bimport" class="btn btn-primary btn-block hidden-lg"><i class="fa fa-upload"></i></button>
	<div class="pull-right"><button type="submit" name="bimport" class="btn btn-primary visible-lg"><i class="fa fa-upload"></i></button></div>

      </div>
	  
      </form>

    </div>

  </div>

</div>

<!-- Modal Detail Absen -->
<div class="modal fade" id="editjadwal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header bg-primary">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel"><i class="fa fa-line-chart"></i> Jadwal <strong id="kar_nm"></strong> (<strong id="kar_nik"></strong>)</h4>
      </div>
      <form class="form-horizontal" action="" method="post">
	<input type="hidden" name="jdw_id" id="jdw_id" value="">
      <div class="modal-body">
        
         <span class="fetched-data">
	    <div class="progress" id="loading">
	      <div class="progress-bar progress-bar-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100" style="width:100%">
	      </div>
	    </div>
	 </span>
    
      </div>
      <div class="modal-footer">
        <button type="submit" name="bupdate" class="btn btn-success btn-block hidden-lg">Simpan Perubahan</button>
	<div class="pull-right"><button type="submit" name="bupdate" class="btn btn-success visible-lg">Simpan Perubahan</button></div>
      </div>
      </form>
    </div>
  </div>
</div>