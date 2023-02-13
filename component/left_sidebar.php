<aside class="main-sidebar"> 
    
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar"> 
      
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel">
        <div class="pull-left image"> <img src="module/profile/img/<?php
			    if(!empty($acc_data['acc_img'])){
					 echo $acc_data['acc_img'];
			    }elseif(!empty($acc_datafl['acc_img'])){
					 echo $acc_datafl['acc_img'];
				}
				else{
			      echo "avatar.jpg";
			    }
			    ?>" class="img-circle" alt="User Image" /> </div>
        <div class="pull-left info">
          <p><?php echo $kar_data['kar_nm'];?><?php echo $kar_datafl['kar_nm'];?></p>
          <!-- Status --> 
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a> </div>
      </div>
      
      <!-- search form (Optional) -->
      <form action="#" method="get" class="sidebar-form">
        <div class="input-group">
          <input type="text" name="q" class="form-control" placeholder="Search..."/>
          <span class="input-group-btn">
          <button type='submit' name='search' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i></button>
          </span> </div>
      </form>
      <!-- /.search form --> 
      
      <!-- Sidebar Menu -->
      <ul class="sidebar-menu">
	<?php
		$active="active";
	?>
	 <!------------------------------------ Freelance -------------------------------------------->
	<?php
		if($kar_datafl['kar_pvl']=="F"){
	?>
		<!--<li class="<?php if(($_GET['p']=="link_group_wa")){ echo $active;}?>"> <a href="?p=link_group_wa"><i class='fa fa-circle text-success'></i> <span>Link Group WhatsApp</span> </a></li>-->
		<li><a href="media.php"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a></li>
	<?php }else{?>
		<!--<li class="<?php if(($_GET['p']=="link_group_wa")){ echo $active;}?>"> <a href="?p=link_group_wa"><i class='fa fa-circle text-success'></i> <span>Link Group WhatsApp</span> </a></li>-->
	  <li><a href="http://informasi.web.id/" target="_blank"><i class="fa fa-question-circle"></i> <span>Q & A</span></a></li>
	  <li><a href="media.php"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a></li>
	  
	  <li class="<?php if(($_GET['p']=="work_from_home")){ echo $active;}?>"> <a href="?p=daily_activity"><i class='fa fa-home'></i> <span>Daily Activity</span> <small class="label pull-right bg-yellow">New</small></a></li>
	  
	   <?php
      if (($kar_data['kar_id'] == "459" || $kar_data['kar_id'] == "255" || $kar_data['div_id'] == "6" || $kar_data['div_id'] == "8" || $kar_data['div_id'] == "10" || $kar_data['div_id'] == "13")) {
      ?>
      <li class="<?php if(($_GET['p']=="aktivitas_karyawan")){ echo $active;}?>"> <a href="?p=aktivitas_karyawan"><i class='fa fa-home'></i> <span>Aktivitas Per Jam</span> <small class="label pull-right bg-yellow">New</small></a></li>
	  <?php }?>
	  
	  
	  <?php
      if (($kar_data['kar_id'] == "459" || $kar_data['kar_id'] == "255" || $kar_data['div_id'] == "3")) {
      ?>
      <li class="<?php if(($_GET['p']=="report_aktivitas_karyawan")){ echo $active;}?>"> <a href="?p=report_aktivitas_karyawan"><i class='fa fa-home'></i> <span>Laporan Aktivitas Per Jam</span> <small class="label pull-right bg-yellow">New</small></a></li>
	  <?php }?>
	  
	  
  <li data-step="8" 
  data-intro="<strong>MailBox</strong> Merupakan fitur aplikasi terbaru juga yang Kami harapkan
              dapat memudahkan Kamu dalam hal kirim-kirim data <strong>Secara Private</strong>,
              message atau attachment bisa di tujukan langsung <strong>Perdivisi</strong> maupun <strong>Perorangan</strong>." 
  class="<?php if(($_GET['p']=="data_mailbox")||($_GET['p']=="detail_mailbox")){ echo $active;}?>"><a href="?p=data_mailbox&s=inbox"><i class='fa fa-envelope'></i> <span>Mailbox</span>
  <?php
      $div_id_=$kar_data['div_id'];
      $kar_id_=$kar_data['kar_id'];
      $mlb_tampil_sts=$mlb->mlb_tampil_sts($div_id_,$kar_id_);
      $mlb_cek_sts=mysql_num_rows($mlb_tampil_sts);
      if($mlb_cek_sts > 0){
  ?> 
  <small class="label pull-right bg-green"><?php echo $mlb_cek_sts;?></small>
  <?php }?>
  </a></li>
  <li data-step="9" 
  data-intro="<strong>Monitoring Location</strong> Merupakan fasilitas pencarian <strong>Karyawan</strong> atau rekan
              secara cepat untuk mengetahui <strong>posisi (Kantor / Unit)</strong> masing-masing bekerja secara <strong>Real Time</strong>."
  class="<?php if(($_GET['p']=="monitoring_location")){ echo $active;}?>"><a href="?p=monitoring_location"><i class='fa fa-bank'></i> <span>Monitoring Location</span></a></li>

  <li class="<?php if(($_GET['p']=="jadwal")){ echo $active;}?>"> <a href="?p=jadwal"><i class='fa fa-calendar-o'></i> <span>Jadwal Online</span></a></li>

<?php if ( $kar_data['kar_id']=="499" || ($kar_data['lvl_id'] >= "1" and $kar_data['lvl_id'] <= "4" )) { ?>  
	<li class="<?php if(($_GET['p']=="permintaan_tenaga_kerja")){ echo $active;}?>"> 
		
		<a href="?p=permintaan_tenaga_kerja&kar_id=<?php echo $_SESSION['kar'];?>">
			<i class='fa fa-street-view'></i> <span>Permintaan Tenaga Kerja</span>
		</a>


	</li>
						
<?php }?>


<?php
/*
  if($kar_data['kar_id']=="499" || $kar_data['kar_id']=="21" ||
		 $kar_data['kar_id']=="37" || $kar_data['kar_id']=="63" ){ 
*/		 	
?> 

	<li class="<?php if(($_GET['p']=="pinjaman_paguyuban")){ echo $active;}?>"> 
		<a href="?p=pinjaman_paguyuban&kar_id=<?php echo $_SESSION['kar'];?>">
			<i class='fa fa-list'></i> <span>Pinjaman Paguyuban</span>
		</a>
	</li>		

<?php //} ?>



	<li class="<?php if(($_GET['p']=="data_izin")){ echo $active;}?>"> 
		<a href="?p=data_izin&id=<?php echo $_SESSION['kar'];?>">
			<i class='fa fa-list'></i> <span>Izin Meninggalkan Kantor</span>
		</a>
	</li>		




  <li class="<?php if(($_GET['p']=="salary")){ echo $active;}?>"> <a href="?p=salary"><i class='fa fa-credit-card'></i> <span>eSLIP</span></a></li>

  <li class="<?php if(($_GET['p']=="cuti")){ echo $active;}?>"> <a href="?p=cuti"><i class='fa fa-calendar'></i> <span>Cuti</span></a></li>

  <li class="<?php if(($_GET['p']=="monitoring_absen")){ echo $active;}?>"> <a href="?p=monitoring_absen"><i class='fa fa-calendar'></i> <span>Monitoring Absen</span></a></li>






	<!-- RM0952 :: 20190803 - KASBON --> 
	
	<?php if($kar_data['kar_id']=="459" || 
			$kar_data['kar_id']=="255" || 
			$kar_data['kar_id']=="37" || 
			$kar_data['kar_id']=="461" || 
			$kar_data['kar_id']=="21" || 
			$kar_data['kar_id']=="383" || 
			$kar_data['kar_id']=="205"){ ?>
	
		<li class="treeview <?php if(($_GET['p']=="data_bank")){ echo $active;}?>">
			<a href="#"><i class='fa fa-money'></i> <span>Data Bank</span> <i class="fa fa-angle-left pull-right"></i></a>
			<ul class="treeview-menu">
				<li class="<?php if(($_GET['p']=="data_bank")){ echo $active;}?>">
					<a href="?p=data_bank"><i class="fa fa-circle-o"></i> Data Bank</a>
				</li>
			</ul>
		</li>
		
	<?php } ?>
	
	
	
	
	
		<li class="treeview <?php if(($_GET['p']=="pengajuan_kasbon")||($_GET['p']=="approval_kasbon")){ echo $active;}?>">
			<a href="#"><i class='fa fa-money'></i> <span>Data Kasbon</span> <i class="fa fa-angle-left pull-right"></i></a>
			<ul class="treeview-menu">
			   <?php 
			   		if ( 
			   			 $kar_data['kar_id']=="53" || 
						 $kar_data['kar_id']=="499"
						){ ?>
				<li class="<?php if(($_GET['p']=="kasbon_data_barang")){ echo $active;}?>">
						<a href="?p=kasbon_data_barang"><i class="fa fa-circle-o"></i> <span> Items Barang (New)</span></a>
				</li>						
				<li class="<?php if(($_GET['p']=="pengajuan_kasbon_unit")){ echo $active;}?>">
					<a href="?p=pengajuan_kasbon_unit"><i class="fa fa-circle-o"></i> Pengajuan Kasbon (New)</a>
				</li>
				<li class="<?php if(($_GET['p']=="approval_kasbon_unit")){ echo $active;}?>">
					<a href="?p=approval_kasbon_unit"><i class="fa fa-circle-o"></i> Approval (New)</a>
				</li>
			  <?php } ?>	

  				<li class="<?php if(($_GET['p']=="pengajuan_kasbon")){ echo $active;}?>">
					<a href="?p=pengajuan_kasbon&t=unit"><i class="fa fa-circle-o"></i> Pengajuan Unit</a>
				</li>
				<?php if($kar_data['kar_id']=="459" || 
						$kar_data['kar_id']=="255" || 
						$kar_data['kar_id']=="37" || 
						$kar_data['kar_id']=="53" || 
						$kar_data['kar_id']=="461" || 
						$kar_data['kar_id']=="499" || 
						$kar_data['kar_id']=="21" || 
						$kar_data['kar_id']=="205"){ ?>
						
						<li class="<?php if(($_GET['p']=="approval_kasbon")){ echo $active;}?>">
							<a href="?p=approval_kasbon"><i class="fa fa-circle-o"></i> <span>Approval Pengajuan</span></a>
						</li>
						<li class="<?php if(($_GET['p']=="pembayaran_kasbon")){ echo $active;}?>">
							<a href="?p=pembayaran_kasbon"><i class="fa fa-circle-o"></i> <span>Pembayaran Pengajuan</span></a>
						</li>
<!--				
						<li class="<?php if(($_GET['p']=="kasbon_data_barang")){ echo $active;}?>">
							<a href="?p=kasbon_data_barang"><i class="fa fa-circle-o"></i> <span>Data Items Barang</span></a>
						</li>
!-->						
				<?php } ?>
			</ul>
		</li>
	
	
	
	
	
	<!-- END KASBON -------------------------------------------------------------------------------->
	
	<!-- <li><a href="?p=hrd" target="_blank"><i class='fa fa-thumbs-o-up'></i> <span>HRD</span> </a></li>  -->


	<?php if($kar_data['kar_id']=="542" || 
			$kar_data['kar_id']=="453" || 
			$kar_data['kar_id']=="551" || 
			$kar_data['kar_id']=="447" 
			){ ?>



	<li class="treeview ">
    <a href="#"><i class='fa fa-bar-chart'></i> <span>HRD</span> <i class="fa fa-angle-left pull-right"></i></a>
    <ul class="treeview-menu">
      <li class="<?php if(($_GET['p']=="hrd")){ echo $active;}?>"><a href="?p=hrd"><i class="fa fa-circle-o"></i> Palamar</a></li>
      <li class="<?php if(($_GET['p']=="pelamar_interview")){ echo $active;}?>"><a href="?p=pelamar_interview"><i class="fa fa-circle-o"></i> Interview</a></li>
	  <li class="<?php if(($_GET['p']=="pelamar_interview_user")){ echo $active;}?>"><a href="?p=pelamar_interview_user"><i class="fa fa-circle-o"></i> Interview User</a></li>
	  <li class="<?php if(($_GET['p']=="pelamar_offering")){ echo $active;}?>"><a href="?p=pelamar_offering"><i class="fa fa-circle-o"></i> Offering</a></li>

	  <li class="<?php if(($_GET['p']=="monitoring_karyawan_absen")){ echo $active;}?>"><a href="?p=monitoring_karyawan_absen"><i class="fa fa-circle-o"></i> Monitoring Karyawan Absen</a></li>

	  <li class="<?php if(($_GET['p']=="publikasi_loker")){ echo $active;}?>"><a href="?p=publikasi_loker"><i class="fa fa-circle-o"></i> Publikasi Loker</a></li>

	  <li class="<?php if(($_GET['p']=="publikasi_iklan")){ echo $active;}?>"><a href="?p=publikasi_iklan"><i class="fa fa-circle-o"></i> Publikasi Loker</a></li>

	  <li class="<?php if(($_GET['p']=="pembinaan_coaching")){ echo $active;}?>"><a href="?p=pembinaan_coaching"><i class="fa fa-circle-o"></i> Coaching Karyawan</a></li>



      <!-- <li class="<?php if(($_GET['p']=="data_reward_alih_fungsi")){ echo $active;}?>"><a href="?p=data_reward_alih_fungsi"><i class="fa fa-circle-o"></i> Perform. Alih Fungsi</a></li>
      <li class="<?php if(($_GET['p']=="data_reward_marketing_support")){ echo $active;}?>"><a href="?p=data_reward_marketing_support"><i class="fa fa-circle-o"></i> Perform. MS</a></li> -->
     
    </ul>
  </li>

  <?php
		}
	?>

<?php 
	$acc = $pelamar->kar_acc_pengajuan_pelamar();
	foreach($acc as $a){

		if($kar_data['kar_id']==$a['dirmud'] || 
			$kar_data['kar_id']==$a['dir_divisi'] || 
			$kar_data['kar_id']==$a['dir_hrd'] || 
			$kar_data['kar_id']==$a['dir_keuangan'] ||
			$kar_data['kar_id']==$a['dirut1'] || 
			$kar_data['kar_id']==$a['dirut1'] || 
			$kar_data['kar_id']==$a['dirut3'] 
			){

				$form_acc[] = $a;
			}else{
				$form_acc[] = [];

			}

		
    ?>
	
	<?php
	}
?>

<?php 
	if(count($form_acc) > 0){
		?>

			<li class="<?php if(($_GET['p']=="form_persetujuan_acc_kar")){ echo $active;}?>"><a href="?p=form_persetujuan_acc_kar"><i class='fa fa-child'></i> <span>Form Persetujuan Karyawan</span></a></li>
 

		<?php
	}
?>





  <li class="<?php if(($_GET['p']=="biodata")){ echo $active;}?>"><a href="?p=biodata"><i class='fa fa-child'></i> <span>Personal Biodata <?php echo count($form_acc);?></span></a></li>
 
 
  <li><a href="https://live.ai.web.id/ggklikv2/login/loginkaryawan/<?php echo $nikhasil; ?>/<?php echo $kar_datacc['acc_md5']; ?>/" target="_blank"><i class='fa fa-thumbs-o-up'></i> <span>Ayo Rajin Klik</span> </a></li> 


 



  <li class="treeview <?php if(($_GET['p']=="data_reward")||($_GET['p']=="data_reward_cs")||($_GET['p']=="data_reward_alih_fungsi")||($_GET['p']=="data_reward_marketing_support")||($_GET['p']=="klaim_pencapaian")||($_GET['p']=="klaim_closing")||($_GET['p']=="klaim_marketing_support")){ echo $active;}?>">
    <a href="#"><i class='fa fa-bar-chart'></i> <span>Data Performance</span> <i class="fa fa-angle-left pull-right"></i></a>
    <ul class="treeview-menu">
      <li class="<?php if(($_GET['p']=="data_reward")){ echo $active;}?>"><a href="?p=data_reward"><i class="fa fa-circle-o"></i> Perform. Unit</a></li>
      <li class="<?php if(($_GET['p']=="data_reward_cs")){ echo $active;}?>"><a href="?p=data_reward_cs"><i class="fa fa-circle-o"></i> Perform. CS</a></li>
      <li class="<?php if(($_GET['p']=="data_reward_alih_fungsi")){ echo $active;}?>"><a href="?p=data_reward_alih_fungsi"><i class="fa fa-circle-o"></i> Perform. Alih Fungsi</a></li>
      <li class="<?php if(($_GET['p']=="data_reward_marketing_support")){ echo $active;}?>"><a href="?p=data_reward_marketing_support"><i class="fa fa-circle-o"></i> Perform. MS</a></li>
      <?php
      if($kar_data['kar_jdw_akses'] != "ALL" &&
	 $kar_data['kar_jdw_akses'] != "" &&
	 $kar_data['kar_jdw_akses'] != NULL &&
	 $kar_data['div_id'] == 8 ||
	 $kar_data['div_id'] == 13){
	if($kar_id == 35 ||
	   $kar_id == 36){
	  $link_klaim_pencapaian = "klaim_closing";
	  $label_klaim_pencapaian = "Klaim Closing";
	}else{
	  $link_klaim_pencapaian = "klaim_pencapaian";
	  $label_klaim_pencapaian = "Klaim Pencapaian";
	}
      ?>
      <li class="<?php if(($_GET['p']==$link_klaim_pencapaian)){ echo $active;}?>"><a href="?p=<?php echo $link_klaim_pencapaian;?>"><i class="fa fa-circle-o"></i> <span><?php echo $label_klaim_pencapaian;?></span> <small class="label pull-right bg-blue">Beta</small></a></li>
      <?php }?>
      <?php
      if($kar_data['kar_logika'] == 1){
      ?>
      <li class="<?php if(($_GET['p']=="klaim_closing")){ echo $active;}?>"><a href="?p=klaim_closing"><i class="fa fa-circle-o"></i> <span>Klaim Closing</span> <small class="label pull-right bg-blue">Beta</small></a></li>
      <?php }?>
      <?php
      if($kar_data['div_id'] == 5){
      ?>
      <li class="<?php if(($_GET['p']=="klaim_marketing_support")){ echo $active;}?>"><a href="?p=klaim_marketing_support"><i class="fa fa-circle-o"></i> <span>Klaim Closing MS</span> <small class="label pull-right bg-blue">Beta</small></a></li>
      <?php }?>
    </ul>
  </li>
  
  <li class="treeview <?php if(($_GET['p']=="new_reward")||($_GET['p']=="new_reward_cs")){ echo $active;}?>">
    <a href="#"><i class='fa fa-gift'></i> <span>Data Reward</span> <i class="fa fa-angle-left pull-right"></i></a>
    <ul class="treeview-menu">
      <li class="<?php if(($_GET['p']=="new_reward")){ echo $active;}?>"><a href="?p=new_reward"><i class="fa fa-circle-o"></i> Reward Unit</a></li>
      <li class="<?php if(($_GET['p']=="new_reward_cs")){ echo $active;}?>"><a href="?p=new_reward_cs"><i class="fa fa-circle-o"></i> Reward CS</a></li>
    </ul>
  </li>
  <?php
  if(($kar_data['lvl_id']=="3") || ($kar_data['kar_id']=="248" || $kar_data['kar_id']=="534" || $kar_data['kar_id']=="551" || $kar_data['kar_id']=="447" || $kar_data['kar_id']=="542" || $kar_data['kar_id']=="383")){
  ?> 
   <li class="<?php if(($_GET['p']=="performa_staff")){ echo $active;}?>"><a href="?p=performa_staff"><i class='fa fa-child'></i> <span>Performa Staff</span> <small class="label pull-right bg-yellow">New</small></a></li>
  <?php }?>
  
  
  
   <li class="<?php if(($_GET['p']=="kondisi_sekretariat")){ echo $active;}?>"><a href="?p=kondisi_sekretariat"><i class='fa fa-child'></i> <span>Kondisi Sekretariat</span> <small class="label pull-right bg-yellow">New</small></a></li>
   
   
  <!--<li class="<?php //if(($_GET['p']=="unlist_domain")){ echo $active;}?>"><a href="?p=unlist_domain"><i class='fa fa-share-alt'></i> <span>Unlist Domain</span> <small class="label pull-right bg-yellow">Alfa</small></a></li>-->
  <?php }?>
	 <!------------------------------------ Freelance -------------------------------------------->
	
   <?php
  if(($kar_data['kar_id']=="21")||($kar_data['kar_id']=="37")){
  ?> 
  <li class="<?php if(($_GET['p']=="data_headline")||($_GET['p']=="detail_headline")){ echo $active;}?>"> <a href="?p=data_headline"><i class='fa fa-newspaper-o'></i> <span>Data Headline</span></a></li> 
  <li class="<?php if(($_GET['p']=="data_archive")||($_GET['p']=="data_archive")){ echo $active;}?>"> <a href="?p=data_archive"><i class='fa fa-archive'></i> <span>Data Archive</span></a></li>
  <?php }?>
  
  <?php
  if(($kar_data['kar_id']=="17")||
      ($kar_data['kar_id']=="24")||
      ($kar_data['kar_id']=="69")||
      ($kar_data['kar_id']=="248")||
      ($kar_data['kar_id']=="255")||
      ($kar_data['kar_id']=="410")||
      ($kar_data['kar_id']=="421")||
  	  ($kar_data['kar_id']=="88")){
  ?>  
  <li class="<?php if(($_GET['p']=="data_kwitansi")){ echo $active;}?>"><a href="?p=data_kwitansi"><i class='fa fa-credit-card'></i> <span>Data Kwitansi</span> </a></li>
  <?php }?>
  <?php
  if(($kar_data['kar_id']=="24")||
      ($kar_data['kar_id']=="69")||
      ($kar_data['kar_id']=="273")||
      ($kar_data['kar_id']=="248")||
      ($kar_data['kar_id']=="255")||
      ($kar_data['kar_id']=="410")||
      ($kar_data['kar_id']=="421")||
      ($kar_data['kar_id']=="534")||
      ($kar_data['kar_id']=="88")){
  ?> 
  <li class="<?php if(($_GET['p']=="data_nota")){ echo $active;}?>"><a href="?p=data_nota"><i class='fa fa-file-text'></i> <span>Data Nota</span> </a></li>
  <?php }?>
  <!--<li class="<?php //if(($_GET['p']=="asset_request")){ echo $active;}?>"><a href="?p=asset_request"><i class='fa fa-desktop'></i> <span>Asset Request</span> <small class="label pull-right bg-blue">Beta</small></a></li>-->
  <?php
	if(($kar_data['kar_pvl']=="A")||($kar_data['kar_pvl']=="S")){
	  
	?>
	
        <li class="header">SDM</li>
        <!-- Optionally, you can add icons to the links -->
  <?php
  if(($kar_data['kar_id']=="37") || ($kar_data['kar_id']=="255") || ($kar_data['kar_id']=="383")){
  ?> 
		<li class="<?php if(($_GET['p']=="grade_pencapaian")){ echo $active;}?>"> <a href="?p=grade_pencapaian"><i class='fa fa-home'></i> <span>Grade Pencapaian</span></a></li>
 <?php }?>

        <li class="<?php if(($_GET['p']=="data_karyawan")||($_GET['p']=="detail_karyawan")){ echo $active;}?>"><a href="?p=data_karyawan"><i class='fa fa-user'></i> <span>Data Karyawan</span></a></li>

 
 <!-- 
    <li class="treeview <?php if(($_GET['p']=="list_karyawan")||($_GET['p']=="data_karyawan")||($_GET['p']=="detail_karyawan")){ echo $active;}?>">
		<a href="#"><i class='fa fa-cube'></i> <span>Data Karyawan</span> <i class="fa fa-angle-left pull-right"></i></a>
		<ul class="treeview-menu">
		  <li class="<?php if(($_GET['p']=="data_karyawan")){ echo $active;}?>"><a href="?p=data_karyawan&status=aksif"><i class="fa fa-circle-o"></i> Karyawan Aktif</a></li>
		  <li class="<?php if(($_GET['p']=="data_karyawan")){ echo $active;}?>"><a href="?p=data_karyawan&status=resign"><i class="fa fa-circle-o"></i> Karyawan Resign</a></li>
		</ul>
	</li>
!-->
 <?php
  if(($kar_data['kar_id']=="63") ||($kar_data['kar_id']=="383")){
  ?> 
	  
 <?php }else{?>
 <li class="<?php if(($_GET['p']=="data_marketing_support")||($_GET['p']=="detail_marketing_support")){ echo $active;}?>"><a href="?p=data_marketing_support"><i class='fa fa-user'></i> <span>Data Karyawan MS</span></a></li>
 <?php }?>
	<li class="<?php if(($_GET['p']=="data_karyawan_fl")||($_GET['p']=="detail_karyawan_fl")){ echo $active;}?>"><a href="?p=data_karyawan_fl"><i class='fa fa-user'></i> <span>Data Karyawan Magang</span></a></li> 
        
	<li class="treeview <?php if(($_GET['p']=="history_absen")||($_GET['p']=="detail_absen")||($_GET['p']=="report_absen_v1")||($_GET['p']=="report_absen_v2") ||($_GET['p']=="history_absen_magang")){ echo $active;}?>">
          <a href="#"><i class='fa fa-line-chart'></i> <span>Data Absen</span> <i class="fa fa-angle-left pull-right"></i></a>
          <ul class="treeview-menu">
            <li class="<?php if(($_GET['p']=="history_absen")){ echo $active;}?>"><a href="?p=history_absen"><i class="fa fa-circle-o"></i> History Absen</a></li>
            <li class="<?php if(($_GET['p']=="history_absen_magang")){ echo $active;}?>"><a href="?p=history_absen_magang"><i class="fa fa-circle-o"></i> History Absen Magang</a></li>
            <li class="<?php if(($_GET['p']=="detail_absen")){ echo $active;}?>"><a href="?p=detail_absen"><i class="fa fa-circle-o"></i> Detail Absen</a></li>
            <li class="<?php if(($_GET['p']=="report_absen")){ echo $active;}?>"><a href="?p=report_absen"><i class="fa fa-circle-o"></i> Report Absen</a></li>
			<li class="<?php if(($_GET['p']=="shift_absen")){ echo $active;}?>"><a href="?p=shift_absen"><i class="fa fa-circle-o"></i> Shift Absen</a></li>
			<li class="<?php if(($_GET['p']=="history_check_position")){ echo $active;}?>"><a href="?p=history_check_position"><i class="fa fa-circle-o"></i> Check Position</a></li>
          </ul>
        </li>
	<?php
	if(($kar_data['kar_id']=="248")||
	   ($kar_data['kar_id']=="13")||
	   ($kar_data['kar_id']=="430")||
	   ($kar_data['kar_id']=="453")||
	   ($kar_data['kar_id']=="447") ||
	   ($kar_data['kar_id']=="499")||
	   ($kar_data['kar_id']=="551") ||
	   ($kar_data['kar_id']=="542") ||
	   ($kar_data['kar_id']=="37") ||
       ($kar_data['kar_id']=="476") ||
       ($kar_data['kar_id']=="383") ||
       ($kar_data['kar_id']=="535")){
	?>
	<li class="<?php if(($_GET['p']=="data_penilaian")){ echo $active;}?>"> <a href="?p=data_penilaian"><i class='fa fa-street-view'></i> <span>Data Penilaian</span></a></li>
	<li class="<?php if(($_GET['p']=="data_kpi")){ echo $active;}?>"> <a href="?p=data_kpi"><i class='fa fa-street-view'></i> <span>Data KPI</span></a></li>
	<li class="<?php if(($_GET['p']=="history_izin")){ echo $active;}?>"> <a href="?p=history_izin"><i class='fa fa-street-view'></i> <span>Data Izin</span></a></li>
	
	<li class="<?php if(($_GET['p']=="review_performance")){ echo $active;}?>"> 
		<a href="?p=review_performance">
			<i class='fa fa-street-view'></i> <span>Data Review Performance</span>
		</a>
	</li>	

	<?php }?>

	

	
	<?php
	if(($kar_data['kar_id']=="248")||
	   ($kar_data['kar_id']=="13")||
	   ($kar_data['kar_id']=="430")||
	   ($kar_data['kar_id']=="453")||
	   ($kar_data['kar_id']=="447") ||
	   ($kar_data['kar_id']=="499")||
	   ($kar_data['kar_id']=="551") ||
	   ($kar_data['kar_id']=="542") ||
	   ($kar_data['kar_id']=="37") ||
       ($kar_data['kar_id']=="476") ||
       ($kar_data['kar_id']=="383") ||
       ($kar_data['kar_id']=="535")){
	?>
	<li class="<?php if(($_GET['p']=="data_mutasi")){ echo $active;}?>"> <a href="?p=data_mutasi"><i class='fa fa-users'></i> <span>Data Mutasi / Demosi </span></a></li>

	<?php }?>	
   <li class="<?php if(($_GET['p']=="data_penjadwalan")){ echo $active;}?>"> <a href="?p=data_penjadwalan"><i class='fa fa-calendar'></i> <span>Penjadwalan</span></a></li>
   
   <?php
	if(($kar_data['kar_id']=="37")||
	   ($kar_data['kar_id']=="21")||
	   ($kar_data['kar_id']=="383")||
	   ($kar_data['kar_id']=="453")||
	   ($kar_data['kar_id']=="248") ||
	   ($kar_data['kar_id']=="551") ||
	   ($kar_data['kar_id']=="542") ||
	   ($kar_data['kar_id']=="447") ||
	   ($kar_data['kar_id']=="255")){
	?>
	<li class="<?php if(($_GET['p']=="data_account")){ echo $active;}?>"><a href="?p=data_account"><i class='fa fa-user-plus'></i> <span>Data Account</span></a></li>
	<?php }?>
	
	<?php
  if(($kar_data['kar_id']=="63") ||($kar_data['kar_id']=="383")){
  ?> 
	  
 <?php }else{?>
	<li class="<?php if(($_GET['p']=="account_marketing_support")){ echo $active;}?>"><a href="?p=account_marketing_support"><i class='fa fa-user-plus'></i> <span>Data Account MS</span></a></li>
<?php }?>	

	<li class="<?php if(($_GET['p']=="data_account_fl")){ echo $active;}?>"><a href="?p=data_account_fl"><i class='fa fa-user-plus'></i> <span>Data Account Magang</span></a></li>
	
	<?php
  if(($kar_data['kar_id']=="63") ||($kar_data['kar_id']=="383")){
  ?> 
	  
 <?php }else{?>
	<li class="<?php if(($_GET['p']=="data_headline")||($_GET['p']=="detail_headline")){ echo $active;}?>"> <a href="?p=data_headline"><i class='fa fa-newspaper-o'></i> <span>Data Headline</span></a></li>      
	<li class="<?php if(($_GET['p']=="data_archive")||($_GET['p']=="detail_archive")){ echo $active;}?>"> <a href="?p=data_archive"><i class="fa fa-archive"></i><span>Data Archive</span></a></li>
<?php }?>

	<?php
	if($kar_data['kar_id']=="447"){
	?>
	<li class="<?php if(($_GET['p']=="data_ip")||($_GET['p']=="detail_ip")){ echo $active;}?>"><a href="?p=data_ip"><i class='fa fa-globe'></i> <span>Data IP Address</span></a></li>
  <?php }?>
  <?php
    if(($kar_data['kar_id']=="248")||
      ($kar_data['kar_id']=="76")||
      //($kar_data['kar_id']=="53")||
      //($kar_data['kar_id']=="140")||
      ($kar_data['kar_id']=="124")||
      ($kar_data['kar_id']=="139")||
      ($kar_data['kar_id']=="156")||
      ($kar_data['kar_id']=="29")){
  ?>    
  <li class="<?php if(($_GET['p']=="data_request")){ echo $active;}?>"><a href="?p=data_request"><i class='fa fa-bell'></i> <span>Data Request</span></a></li>
  <li class="treeview <?php if(($_GET['p']=="list_asset")||($_GET['p']=="management_asset")||($_GET['p']=="detail_asset")){ echo $active;}?>">
    <a href="#"><i class='fa fa-cube'></i> <span>Data Asset</span> <i class="fa fa-angle-left pull-right"></i></a>
    <ul class="treeview-menu">
      <li class="<?php if(($_GET['p']=="list_asset")){ echo $active;}?>"><a href="?p=list_asset"><i class="fa fa-circle-o"></i> List Asset</a></li>
      <li class="<?php if(($_GET['p']=="management_asset")||($_GET['p']=="detail_asset")){ echo $active;}?>"><a href="?p=management_asset"><i class="fa fa-circle-o"></i> Management Asset</a></li>
    </ul>
  </li>
  <?php }?>

  <?php }?>
	<?php
	if(($kar_data['kar_pvl']=="S")){
	  
	?>
	<li class="header">IT</li>
	<li class="<?php if(($_GET['p']=="data_posting")){ echo $active;}?>"> <a href="?p=data_posting"><i class="fa fa-comments"></i><span>Data Posting</span></a></li>
	<li class="<?php if(($_GET['p']=="data_ip")||($_GET['p']=="detail_ip")){ echo $active;}?>"><a href="?p=data_ip"><i class='fa fa-globe'></i> <span>Data IP Address</span></a></li>
	<li class="<?php if(($_GET['p']=="data_privilege")){ echo $active;}?>"> <a href="?p=data_privilege"><i class='fa fa-key'></i> <span>Privilege</span></a></li>
	<li class="<?php if(($_GET['p']=="settime_absen")){ echo $active;}?>"><a href="?p=settime_absen"><i class='fa fa-clock-o'></i> <span>SetTime Absen</span></a></li>
  <?php }?>      

  <?php

//   echo "<pre>";
//   print_r($kar_data['kar_id']);
	if(($kar_data['kar_id']=="617")){
	  
	?>
	  <li class="<?php if(($_GET['p']=="work_from_home")){ echo $active;}?>"> <a href="?p=daily_activity"><i class='fa fa-home'></i> <span>Daily Activity</span> <small class="label pull-right bg-yellow">New</small></a></li>
  <?php }?>      


      </ul>
      <!-- /.sidebar-menu --> 
    </section>
    <!-- /.sidebar --> 
  </aside>