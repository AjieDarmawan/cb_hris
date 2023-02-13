<?php 
	require('module/data-cuti/ntf_act.php'); 
?>
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
                  <h3 class="box-title">
		    <?php
			$ntf_data_sts_read=$cti->cuti_ntf_data_sts_read($kar_id);
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
						<th>Form Cuti (diajukan)</th>
						<th>Date</th>
						<th></th>
					  </tr>
					</thead>
                <tbody>
                <?php
				$ntf_data_tujuan=$kar_id;
                $ntf_data_tampil=$cti->cuti_ntf_data_tampil($ntf_data_tujuan);
                if($ntf_data_tampil){
                foreach($ntf_data_tampil as $data){
		  
                  $jointime=$data['ntf_data_tgl']." ".$data['ntf_data_jam'];
                  $sorttime=strtotime("$jointime");
		  
		  if($data['ntf_data_sumber']=="SYSTEM"){
		    $sumber="SYSTEM";
		  }else{
		    $kar_id_ = $data['ntf_data_sumber'];
		    $kar_tampil_id_ = $kar->kar_tampil_id($kar_id_);
		    $data_kar_ = mysql_fetch_array($kar_tampil_id_);
		    $sumber=$data_kar_['kar_nm'];
		  }

		  
		  
                ?> 
                  <tr>
                    <td>
		    <?php
		    $ntf_data_read_=$kar_id;
		    $i=0;
		    $ntf_data_sts_read=$cti->cuti_ntf_data_sts_read($ntf_data_read_);
		    while($ntf_data_sts_data=mysql_fetch_array($ntf_data_sts_read)){
		       $ntf_data_id_array['ntf'][$i]=$ntf_data_sts_data['ntf_data_id'];
		       $i++;
		    }
		    $notif=$ntf_data_id_array['ntf'];
		    $found = True;
		    foreach($notif as $data_notif){			
			if($data_notif == $data['ntf_data_id']){
			    echo"<a><i class='fa fa-circle'></i></a>";
			    $found = False;
			}
		    }
		    if($found)
		    {
			echo "<a><i class='fa fa-circle-thin'></i></a>";
		    }
			$url  = $data['ntf_data_url'];
			if ($url==""){
			   $url = "?p=cuti&act=open&ntf_id=".$data['ntf_data_id']."&ntf_tujuan=".$data['ntf_data_tujuan'];
			}else{
			  $url .= "&ntf_id=".$data['ntf_data_id']."&ntf_tujuan=".$data['ntf_data_tujuan'];
			}
			$text_ntf = "";
			if ($data['ntf_data_read'] == ""){
			  $text_ntf = '<span class="label label-danger"> 1 </span>';
			}
			
		    ?>
		    </td>
                    <td><?php echo $sumber; ?></td>
                    <td > <a href="<?php echo $url; ?>">
					<?php echo $text_ntf ;?>
					<strong> <?php echo $data['ntf_data_act']; ?></strong> - <?php echo $sumber //$data['ntf_data_isi']; ?>
					</a>
					</td>
					<td><?php echo $data['ntf_data_tgl'].' '.$data['ntf_data_jam']; ?></td>
                    <td><i class="fa fa-clock-o"></i> <?php echo $tms->humanTiming($sorttime); ?></td>
                  </tr>    
                <?php }}?>  
                </tbody>      
                <tfoot>
                  <tr>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                  </tr>
                </tfoot>
              </table>
                </div><!-- /.box-body -->
                
              </div><!-- /. box -->


            </div><!-- /.col -->
          </div><!-- /.row -->
        </section><!-- /.content -->
