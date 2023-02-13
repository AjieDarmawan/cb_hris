<?php 
	require('module/data-cuti/ntf_act.php'); 
?>
<!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
             <a href="?p=cuti" class='btn btn-primary'><i class="fa fa-arrow-left"></i>&nbsp;Back
			 </a> <?php echo 'Data Permohonan Cuti Karyawan'// $title;?>
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
                  <h3 class="box-title">
		    <?php
			$ntf_data_sts_read=$cti->cuti_ntf_data_sts_read_all($kar_id);
			$ntf_data_sts_cek=mysql_num_rows($ntf_data_sts_read);
			if($ntf_data_sts_cek > 0){
		    ?>  
		    <span class="label label-warning"><?php echo $ntf_data_sts_cek;?></span> Notifikasi Baru
		    <?php }?>
		  </h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <table id="tb_inbox" class="table table-striped table-hover">
					<thead>
					  <tr>
						<th></th>
						<th>Data</th>
						<th>Date</th>
						<th>Atasan</th>
						<th>ACC</th>
						<th>Form Cuti</th>
						<th>Print</th>
						<th></th>
					  </tr>
					</thead>
                <tbody>
                <?php
				$ntf_data_tujuan=$kar_id;
                $ntf_data_tampil=$cti->cuti_ntf_data_tampil_all($ntf_data_tujuan);
                if($ntf_data_tampil){
                foreach($ntf_data_tampil as $data){
		  
                  $jointime=$data['ntf_data_tgl']." ".$data['ntf_data_jam'];
                  $sorttime=strtotime("$jointime");
		  
		  if($data['ntf_data_sumber']=="SYSTEM"){
		    $sumber="SYSTEM";
			$tujuan ="SYSTEM";
		  }else{
		    $kar_id_ = $data['ntf_data_sumber'];
		    $kar_tampil_id_ = $kar->kar_tampil_id($kar_id_);
		    $data_kar_ = mysql_fetch_array($kar_tampil_id_);
		    $sumber=$data_kar_['kar_nm'];
			///////////////////////////////////////
		    $kar_id_2 = $data['ntf_data_tujuan'];
		    $kar_tampil_id_2 = $kar->kar_tampil_id($kar_id_2);
		    $data_kar_2 = mysql_fetch_array($kar_tampil_id_2);
		    $tujuan = $data_kar_2['kar_nm'];

		  }

		  
		  
                ?> 
                  <tr>
             <td>
		    <?php
		    $ntf_data_read_=$kar_id;
		    $i=0;
		    $ntf_data_sts_read=$cti->cuti_ntf_data_sts_read_all($ntf_data_read_);
		    while($ntf_data_sts_data=mysql_fetch_array($ntf_data_sts_read)){
		       $ntf_data_id_array['ntf'][$i]=$ntf_data_sts_data['ntf_data_id'];
		       $i++;
		    }
		    $notif=$ntf_data_id_array['ntf'];
		    $found = True;
		    foreach($notif as $data_notif){			
			if($data_notif == $data['ntf_data_id']){
//			    echo"<a><i class='fa fa-circle'></i></a>";
			    $found = False;
			}
		    }
		    if($found)
		    {
//		    	echo "<a><i class='fa fa-circle-thin'></i></a>";
		    }
			$xnik_atasan= $data['ntf_data_tujuan'];
			$xnik	= $data['ntf_data_sumber'];
			$xtgl  	= $data['ntf_data_tgl'];
            $xnota 	= $data['ntf_data_tgl'].'-'.$data['ntf_data_sumber'];		
			
			$url  = $data['ntf_data_url'];
			if ($url==""){
			   $url = "?p=cuti&act=open&ntf_id=".$data['ntf_data_id']."&ntf_tujuan=".$data['ntf_data_tujuan'];
			}else{
			  $url .= "&ntf_id=".$data['ntf_data_id']."&ntf_tujuan=".$data['ntf_data_tujuan'];
			}
			
			$url_nota  = $data['ntf_nota'];
			if ($url_nota==""){
			   $url_nota = "?p=form-print&act=open&id=".$xnik."&nota=".$xnota.'&tgl='.$xtgl.'&atasan='.$tujuan.'&nik_atasan='.$xnik_atasan;
			}else{
			   $url_nota .= '&tgl='.$xtgl.'&atasan='.$tujuan.'&nik_atasan='.$xnik_atasan;
			}
			
//			$text_ntf = '<i class="fa fa-check-square-o"></i>';;
			$text_ntf = '<i class="fa fa-check"></i>';;
			if ($data['ntf_data_read'] == ""){
//			  $text_ntf = '<span class="label label-danger"> - </span>';
			  $text_ntf = '-';
			    echo"<a><i class='fa fa-circle'></i></a>";
			}else{
		    	echo "<a><i class='fa fa-circle-thin'></i></a>";
			
			}
			$url_nota = "module/data-cuti/form-cuti-print.php".$url_nota;
			$url_nota_new = "window.open('".$url_nota."', '_blank');return false;";
		    ?>
		    </td>
                    <td><?php echo $sumber; ?></td>
					<td><?php echo $data['ntf_data_tgl']; ?></td>
					<td><?php echo $tujuan ;?></td>
					<td><?php echo $text_ntf ;?></td>
                    <td > <a href="<?php echo $url; ?>">
					<strong><?php echo $data['ntf_data_act']; ?></strong> - <?php echo $sumber ;//$data['ntf_data_isi']; ?>
					</a>
					</td>

					<td>
				   <!-- 
				   		<a href="#" onClick="<?php //echo $url_nota_new; ?>" 
				   		target="_blank"><i class="fa fa-print"></i> Cetak</a>	
				   !-->
				   <?php if ($text_ntf != '-'){ ?>
					   <a href="#"  onclick="OpenPopupCenter('<?php echo $url_nota ; ?>', 'TEST!?', 600, 600)" 
					   title=" Print Form Cuti " ><i class="fa fa-print"></i> <b> Cetak </b></a>
				   <?php } ?>   
					</td>
                    <td><i class="fa fa-clock-o"></i> <?php echo $tms->humanTiming($sorttime); ?></td>
                  </tr>    
                <?php }}?>  
                </tbody>      
              </table>
                </div><!-- /.box-body -->
                
              </div><!-- /. box -->


            </div><!-- /.col -->
          </div><!-- /.row -->
        </section><!-- /.content -->
		
		
<script>


</script>		
