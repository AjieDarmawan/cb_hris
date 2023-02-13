<aside class="main-sidebar"> 
    
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar"> 
      
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel">
        <div class="pull-left image"> <img src="module/profile/img/<?php
			    if(!empty($acc_data['acc_img'])){
			      echo $acc_data['acc_img'];
			    }else{
			      echo "avatar.jpg";
			    }
			    ?>" class="img-circle" alt="User Image" /> </div>
        <div class="pull-left info">
          <p><?php echo $kar_data['kar_nm'];?></p>
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
  <li><a href="media.php"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a></li>	
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
  <li class="<?php if(($_GET['p']=="jadwal_online")){ echo $active;}?>"> <a href="?p=jadwal_online"><i class='fa fa-calendar-o'></i> <span>Jadwal Online</span> <small class="label pull-right bg-yellow">New</small></a></li>
  <li class="<?php if(($_GET['p']=="biodata")){ echo $active;}?>"><a href="?p=biodata"><i class='fa fa-child'></i> <span>Personal Biodata</span> <small class="label pull-right bg-blue">Beta</small></a></li>
  <li><a href="http://personalia.web.id/ayorajinklik" target="_blank"><i class='fa fa-thumbs-o-up'></i> <span>Ayo Rajin Klik</span> </a></li>
  <!--<li class="<?php //if(($_GET['p']=="unlist_domain")){ echo $active;}?>"><a href="?p=unlist_domain"><i class='fa fa-share-alt'></i> <span>Unlist Domain</span> <small class="label pull-right bg-yellow">Alfa</small></a></li>-->
  
  <?php
  if(($kar_data['kar_id']=="17")||
      ($kar_data['kar_id']=="24")||
      ($kar_data['kar_id']=="69")||
      ($kar_data['kar_id']=="248")||
      ($kar_data['kar_id']=="255")){
  ?>  
  <li class="<?php if(($_GET['p']=="data_kwitansi")){ echo $active;}?>"><a href="?p=data_kwitansi"><i class='fa fa-credit-card'></i> <span>Data Kwitansi</span> </a></li>
  <?php }?>
  <?php
  if(($kar_data['kar_id']=="24")||
      ($kar_data['kar_id']=="69")||
      ($kar_data['kar_id']=="273")||
      ($kar_data['kar_id']=="248")||
      ($kar_data['kar_id']=="255")){
  ?> 
  <li class="<?php if(($_GET['p']=="data_nota")){ echo $active;}?>"><a href="?p=data_nota"><i class='fa fa-file-text'></i> <span>Data Nota</span> </a></li>
  <?php }?>
  <!--<li class="<?php //if(($_GET['p']=="asset_request")){ echo $active;}?>"><a href="?p=asset_request"><i class='fa fa-desktop'></i> <span>Asset Request</span> <small class="label pull-right bg-blue">Beta</small></a></li>-->
  <?php
	if(($kar_data['kar_pvl']=="A")||($kar_data['kar_pvl']=="S")){
	  
	?>
        <li class="header">SDM</li>
        <!-- Optionally, you can add icons to the links -->
        <li class="<?php if(($_GET['p']=="data_karyawan")||($_GET['p']=="detail_karyawan")){ echo $active;}?>"><a href="?p=data_karyawan"><i class='fa fa-user'></i> <span>Data Karyawan</span></a></li>
        
        <li class="treeview <?php if(($_GET['p']=="history_absen")||($_GET['p']=="detail_absen")||($_GET['p']=="report_absen_v1")||($_GET['p']=="report_absen_v2")){ echo $active;}?>">
          <a href="#"><i class='fa fa-line-chart'></i> <span>Data Absen</span> <i class="fa fa-angle-left pull-right"></i></a>
          <ul class="treeview-menu">
            <li class="<?php if(($_GET['p']=="history_absen")){ echo $active;}?>"><a href="?p=history_absen"><i class="fa fa-circle-o"></i> History Absen</a></li>
            <li class="<?php if(($_GET['p']=="detail_absen")){ echo $active;}?>"><a href="?p=detail_absen"><i class="fa fa-circle-o"></i> Detail Absen</a></li>
            <li class="<?php if(($_GET['p']=="report_absen")){ echo $active;}?>"><a href="?p=report_absen"><i class="fa fa-circle-o"></i> Report Absen</a></li>
          </ul>
        </li>
	
	<li class="<?php if(($_GET['p']=="data_penilaian")){ echo $active;}?>"> <a href="?p=data_penilaian"><i class='fa fa-street-view'></i> <span>Data Penilaian</span> <small class="label pull-right bg-yellow">New</small></a></li>
	
        <li class="<?php if(($_GET['p']=="data_penjadwalan")){ echo $active;}?>"> <a href="?p=data_penjadwalan"><i class='fa fa-calendar'></i> <span>Penjadwalan</span></a></li>
	<li class="<?php if(($_GET['p']=="data_account")){ echo $active;}?>"><a href="?p=data_account"><i class='fa fa-user-plus'></i> <span>Data Account</span></a></li>
	<li class="<?php if(($_GET['p']=="data_headline")||($_GET['p']=="detail_headline")){ echo $active;}?>"> <a href="?p=data_headline"><i class='fa fa-newspaper-o'></i> <span>Data Headline</span></a></li>      
	<li class="<?php if(($_GET['p']=="data_archive")||($_GET['p']=="detail_archive")){ echo $active;}?>"> <a href="?p=data_archive"><i class="fa fa-archive"></i><span>Data Archive</span></a></li>
  
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
      </ul>
      <!-- /.sidebar-menu --> 
    </section>
    <!-- /.sidebar --> 
  </aside>