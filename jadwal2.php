<!-- Content Header (Page header) -->
    <section class="content-header">
      <h1> Not Found ! <small></small> </h1>
      <!--<ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Level</a></li>
        <li class="active">Here</li>
      </ol>-->
    </section>
    
    <!-- Main content -->
    <section class="content">
      
      <?php
      
	function hari_ini($carihari){
		$hari = date("D",strtotime($carihari));
		switch($hari){
			case 'Sun':
				$hari_ini = "MGG";
			break;
			case 'Mon':			
				$hari_ini = "SN";
			break;
			case 'Tue':
				$hari_ini = "SL";
			break;
			case 'Wed':
				$hari_ini = "RB";
			break;
			case 'Thu':
				$hari_ini = "KM";
			break;
			case 'Fri':
				$hari_ini = "JM";
			break;
			case 'Sat':
				$hari_ini = "SB";
			break;
			default:
				$hari_ini = "NN";		
			break;
		}
	 
		return $hari_ini;
	}
	
	function strpos_arr($haystack, $needle) {
	    if(!is_array($needle)) $needle = array($needle);
	    foreach($needle as $what) {
		if(($pos = strpos($haystack, $what))!==false) return $pos;
	    }
	    return false;
	}
      
	$jdw_blnthn = date('mY');
	$jdw_zona = "JABODETABEK";
	$maxDays = date('t');
	
	$dataArr = array();
	$dataArr2 = array();
	$dataArr3 = array();
	$jdw_tampil = $jdw->jdw_tampil($jdw_blnthn,$jdw_zona);
	while($jdw_data = mysql_fetch_assoc($jdw_tampil)){
	    $exp_wilayah = explode('#',$jdw_data['jdw_wilayah']);
	    $dataArr[]=array('jdw_nik'=>$jdw_data['jdw_nik'],
			     'jdw_nama'=>$jdw_data['jdw_nama'],
			     'jdw_wilayah'=>$exp_wilayah[1]);
	    
	    $exp_data = explode('#',$jdw_data['jdw_data']);
	    for($d=0;$d<=$maxDays-1;$d++){
	        $day = $d + 1;
		$dataArr2[$jdw_data['jdw_nik']][$day] = $exp_data[$d];
		
		$pos_GL = strpos($exp_data[$d],'GL');
		
		if($exp_data[$d] == 'L' ||
		  $exp_data[$d] == 'LM' ||
		  $exp_data[$d] == 'LN' ||
		  $pos_GL !== false){
		 
		  $dataArr3[$jdw_data['jdw_nik']][$day] = 1;
		  
		}
	    }
	}
	
	$sumLibur = array();
	foreach ($dataArr3 as $k=>$subArray) {
	  foreach ($subArray as $id=>$value) {
	    $sumLibur[$k]+=$value;
	  }
	}
	
	//echo"<pre>";
	//print_r($sumArray);
	//echo"</pre>";
	?>
      
      <!-- Your Page Content Here -->
      <div class="row">
        <div class="col-xs-12">
	  
	  <div class="box">
	      <div class="box-header">
		<h3 class="box-title">New Jadwal</h3>
	      </div>
  
	      <div class="box-body">
		  <table id="tb_jadwal" class="table table-hover table-striped table-bordered nowrap" style="width:100%">
		    <thead>
			<tr>
			    <th rowspan="2" class="pinned" style="vertical-align:middle; text-align:center;">NIK</th>
			    <th rowspan="2" class="pinned" style="vertical-align:middle; text-align:center;">Nama</th>
			    <th rowspan="2" class="pinned" style="vertical-align:middle; text-align:center;">Wilayah</th>
			    <th rowspan="2" class="pinned" style="vertical-align:middle; text-align:center;">Libur</th>
			    <?php
			    for($d=0;$d<=$maxDays-1;$d++){
			      $day = $d + 1;
			      $carihari = date('Y-m')."-".sprintf("%02d",$day);
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
			      $carihari = date('Y-m')."-".sprintf("%02d",$day);
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
			$jdw_wilayah = $dataArr[$i]['jdw_wilayah'];
			
			$libur = $sumLibur[$jdw_nik] ? $sumLibur[$jdw_nik] : 0;
		      ?>
			<tr>
			    <td><small><?php echo $jdw_nik;?></small></td>
			    <td><small><?php echo $jdw_nama;?></small></td>
			    <td><span class="label label-default"><?php echo $jdw_wilayah;?></span></td>
			    <td><span class="label label-warning"><?php echo $libur;?></span></td>
			    <?php
			    for($d=0;$d<=$maxDays-1;$d++){
			      $day = $d + 1;
			      
			      $pos_GL = strpos($dataArr2[$jdw_nik][$day],'GL');
			      
			      if($dataArr2[$jdw_nik][$day] == 'L' ||
				 $dataArr2[$jdw_nik][$day] == 'LM' ||
				 $dataArr2[$jdw_nik][$day] == 'LN'){
				$bgcolor = "danger";
			      }elseif($dataArr2[$jdw_nik][$day] == 'Sebar'){
				$bgcolor = "info";
			      }elseif($pos_GL !== false){
				$bgcolor = "success";
			      }else{
				$bgcolor = "default";
			      }
			      
			      $carihari = date('Y-m')."-".sprintf("%02d",$day);
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
	  
	
	  
        </div>
        <!-- /.col --> 
      </div>
      <!-- /.row --> 
      
    </section>
    <!-- /.content --> 