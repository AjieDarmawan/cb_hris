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

		      <h3 class="box-title"><?php

		      	if(isset($_POST['bsortir'])){

		      		$pecah_tgl = explode( "-", $date );

		   			$tgl_rpt = $pecah_tgl[2];

		   			$date_rpt = $_POST['bulan_absen']."-".$tgl_rpt;	

		   			echo substr($tgl->tgl_indo($date_rpt), 3,20);

		   		}else{

		   			echo substr($tgl->tgl_indo($date), 3,20);

		   		}

		       ?></h3>

		      <div class="pull-right">

                  <form class="form-inline" method="post" action="">

                    <div class="form-group">

                      <a href="#"  class="btn btn-md btn-default"><i class="fa fa-print"></i></a>

                    </div><!-- /.form group -->

                    

                    <div class="input-group">

                      <div class="input-group-addon">

                        <i class="fa fa-calendar"></i>

                      </div>

                      <input type="text" name="bulan_absen" class="form-control pull-right" placeholder="Sortir Bulan" id="sort_bulan" readonly />

                    </div><!-- /.form group -->



                    <div class="form-group">

                      <button type="submit" name="bsortir" class="btn btn-md btn-default"><i class="fa fa-eye"></i> View</button>

                    </div><!-- /.form group -->

                    <div class="form-group">

                      <a href="?p=report_absen_v1"  class="btn btn-md btn-default" title="Kembali ke default <?php echo substr($tgl->tgl_indo($date), 3,20); ?>"><i class="fa fa-refresh"></i></a> &nbsp;

                    </div><!-- /.form group -->



                  </form>

                  </div>

	    </div><!-- /.box-header -->

	    <div class="box-body">

	    	<table class="table table-bordered table-hover table-striped">

				<thead>

				<tr>

					<th>Nama</th>

					<?php

					$abs_tgl_rpt=$abs->abs_tgl_rpt();

					while($abs_tgl_data=mysql_fetch_assoc($abs_tgl_rpt)){

					?>

					<th><center><?php echo $abs_tgl_data['abs_tgl_nm'];?></center></th>

					<?php }?>

					<th><span class="label label-primary">H</span></th>

				</tr>

				</thead>

	            <tbody>

			<?php
			$karid_=255;
			$kar_tampil_id=$kar->kar_tampil_id($karid_);

			while($data=mysql_fetch_assoc($kar_tampil_id)) {

					$kar_id_=$data['kar_id'];	

			?>

				<tr>

					<td><?php echo $data['kar_nm'];?></td>

					<?php

					$abs_tgl_rpt=$abs->abs_tgl_rpt();

					while($abs_tgl_data=mysql_fetch_assoc($abs_tgl_rpt)){

						if(isset($_POST['bsortir'])){

						$pecah_tgl = explode( "-", $_POST['bulan_absen'] );

						}else{

						$pecah_tgl = explode( "-", $date );	

						}



						$abs_tgl_masuk=$pecah_tgl[0]."-".$pecah_tgl[1]."-".$abs_tgl_data['abs_tgl_nm'];

						$abs_tampil_kar=$abs->abs_tampil_kar($kar_id_,$abs_tgl_masuk);

						$abs_data_kar=mysql_fetch_assoc($abs_tampil_kar);





						$tgl_1=$pecah_tgl[0]."-".$pecah_tgl[1]."-"."01";

						$tgl_31=$pecah_tgl[0]."-".$pecah_tgl[1]."-"."31";



						$abs_tgl_rpt_bln=$abs->abs_tgl_rpt_bln($kar_id_,$tgl_1,$tgl_31);

						$abs_data_rpt_bln=mysql_fetch_assoc($abs_tgl_rpt_bln);

						$abs_cek_rpt_bln=mysql_num_rows($abs_tgl_rpt_bln);



						if($abs_data_kar > 0){

							$hasil="<i class='fa fa-check'></i>";

							$bg="class='success'";

						}else{

							$hasil="<i class='fa fa-close'></i>";

							$bg="class='danger'";

						}



						

					?>

					<td <?php echo $bg;?> align="center"><a style="cursor:pointer; color:#a1a1a1;"><?php echo $hasil; ?></a></td>

					<?php }?>

					<td class="info"><?php echo $abs_cek_rpt_bln;?></td>

				</tr>

			<?php }?>

				</tbody>	

			</table>

		</div>

	</div>	



  </section><!-- /.content -->



