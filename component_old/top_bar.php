<header class="main-header"> 
    
    <!-- Logo --> 
    <a href="media.php" class="logo"> 
    <!-- mini logo for sidebar mini 50x50 pixels --> 
    <span class="logo-mini"><b>G</b>G</span> 
    <!-- logo for regular state and mobile devices --> 
    <span class="logo-lg"><b>Gilland</b>Ganesha <small><span class="label label-warning">v.2</span></small></span> </a> 
    
    <!-- Header Navbar -->
    <nav class="navbar navbar-static-top" role="navigation" data-step="1" 
    data-intro="Hello, <strong><?php echo $kar_data['kar_nm']?></strong><br> Selamat datang  di Gilland Ganesha Absen,
                nah sebelum melakukan <strong>Absen Masuk</strong>
                alangkah baiknya ikut tata caranya dulu yuk.<br><br>
                Saat ini Kamu ada di menu <strong>Top Bar</strong>. Pada menu top bar
                terdapat menu seperti Data Profile Kamu, Notifikasi Pesan, DLL.
                Namun untuk saat ini yang berfungsi hanya data profile & notifikasi pesan,
                sisanya masih dalam tahap pengembangan oleh <strong>IT</strong>.<br><br>
                Ayo kamu tekan tombol <strong>next</strong> dibawah ini
                untuk tahap pengenalan berikutnya."> 
      <!-- Sidebar toggle button--> 
      <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button"> <span class="sr-only">Toggle navigation</span> </a> 
      <!-- Navbar Right Menu -->
      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
        <li class="find-people">
            <input type="text" name="find" class="twitter-typeahead form-control" id="find" placeholder="Find People..." autocomplete="off">
        </li>
        <?php
        //if(empty($acc_data['acc_sts'])){
        ?>
        <!-- <li><a class="shake" href="javascript:void(0);" onclick="javascript:introJs().setOption('showProgress', true).start();"> <i class="fa fa-info-circle"></i> Tutorial, Click Me..</a>  </li>-->
        <?php //}?>
          <!-- Messages: style can be found in dropdown.less-->
          <li class="dropdown messages-menu"> 
            <!-- Menu toggle button --> 
            <a href="#" class="dropdown-toggle" data-toggle="dropdown"> <i class="fa fa-envelope-o"></i>
            <?php
                $div_id=$kar_data['div_id'];
                $mlb_tampil_sts=$mlb->mlb_tampil_sts($div_id,$kar_id);
                $mlb_cek_sts=mysql_num_rows($mlb_tampil_sts);
                if($mlb_cek_sts > 0){
            ?>    
                <span class="label label-success"><?php echo $mlb_cek_sts;?></span>
            <?php }?>     
            </a>
            <ul class="dropdown-menu">
              <li class="header">You have 
              <?php
                  $div_id=$kar_data['div_id'];
                  $mlb_tampil_sts=$mlb->mlb_tampil_sts($div_id,$kar_id);
                  $mlb_cek_sts=mysql_num_rows($mlb_tampil_sts);
                  if($mlb_cek_sts > 0){
                    echo $mlb_cek_sts;
                  }else{
                    echo"0";
                  }
              ?>
              new messages</li> 
              <li> 
                <!-- inner menu: contains the messages -->
                <ul class="menu">
                  <?php
                      $div_id=$kar_data['div_id'];
                      $mlb_tampil_sts_limit=$mlb->mlb_tampil_sts_limit($div_id,$kar_id);
                      while($mlb_cek_sts_limit=mysql_fetch_array($mlb_tampil_sts_limit)){

                      if(!empty($mlb_cek_sts_limit['mlb_tujuan'])){
                      if($mlb_cek_sts_limit['mlb_tujuan']==$div_id){

                        $div_id_ = $mlb_cek_sts_limit['mlb_tujuan'];
                        $div_tampil_id_ = $div->div_tampil_id_($div_id_);
                        $data_div_ = mysql_fetch_array($div_tampil_id_);

                        $nm_user = $data_div_['div_nm'];
                        $id_user = $mlb_cek_sts_limit['kar_id'];

                      }}elseif(!empty($mlb_cek_sts_limit['mlb_sub_tujuan'])){
                      if($mlb_cek_sts_limit['mlb_sub_tujuan']==$kar_id){

                        $kar_id_=$mlb_cek_sts_limit['kar_id'];
                        $kar_tampil_id_=$kar->kar_tampil_id($kar_id_);
                        $kar_data_=mysql_fetch_array($kar_tampil_id_);

                        $nm_user = $kar_data_['kar_nm'];
                        $id_user = $mlb_cek_sts_limit['kar_id'];

                      }}
                      
                      $acc_tampil_kar_=$acc->acc_tampil_kar($id_user);
                      $acc_data_=mysql_fetch_array($acc_tampil_kar_);
                      
                      if(!empty($acc_data_['acc_img'])){
                        $img_user=$acc_data_['acc_img'];
                      }else{
                        $img_user="avatar.jpg";
                      }

                      $jointime=$mlb_cek_sts_limit['mlb_tgl']." ".$mlb_cek_sts_limit['mlb_jam'];
                      $sorttime=strtotime("$jointime");

                      if($mlb_cek_sts_limit['mlb_sts']=="N"){
                        $unread="unread";
                      }elseif($mlb_cek_sts_limit['mlb_sts']=="R"){
                        $unread="";
                      }
                  ?>    
                  <li class="<?php echo $unread; ?>"><!-- start message --> 
                    <a href="?p=data_mailbox&s=inbox&r=read&id=<?php echo $mlb_cek_sts_limit['mlb_id']; ?>">
                    <div class="pull-left"> 
                      <!-- User Image --> 
                      <img src="module/profile/img/<?php echo $img_user;?>" class="img-circle" alt="User Image"/> </div>
                    <!-- Message title and timestamp -->
                    <h4> <?php echo $nm_user;?> <small><i class="fa fa-clock-o"></i> <?php echo $tms->humanTiming($sorttime); ?></small> </h4>
                    <!-- The message -->
                    <p><?php echo strip_tags(substr(str_replace('"','',$mlb_cek_sts_limit['mlb_msg']),0,35));?></p>
                    </a> </li>
                    <?php }?>
                  <!-- end message -->
                </ul>
                <!-- /.menu --> 
              </li>
              <li class="footer"><a href="?p=data_mailbox&s=inbox">See All Messages</a></li>
            </ul>
          </li>
          <!-- /.messages-menu --> 
          
          <!-- Notifications Menu -->
          <li class="dropdown notifications-menu">
            
            <!-- Menu toggle button --> 
            <a href="#" class="dropdown-toggle" data-toggle="dropdown"> <i class="fa fa-bell-o"></i>
            <?php
                $ntf_data_sts_read=$ntf->ntf_data_sts_read($kar_id);
                $ntf_data_sts_cek=mysql_num_rows($ntf_data_sts_read);
                if($ntf_data_sts_cek > 0){
            ?>  
            <span class="label label-warning"><?php echo $ntf_data_sts_cek;?></span>
            <?php }?>
            </a>
            <ul class="dropdown-menu">
              <li class="header">You have
              <?php
                $ntf_data_sts_read=$ntf->ntf_data_sts_read($kar_id);
                $ntf_data_sts_cek=mysql_num_rows($ntf_data_sts_read);
                if($ntf_data_sts_cek > 0){
                  echo $ntf_data_sts_cek;
                }else{
                  echo"0";
                }
              ?> 
              new notifications</li>
              <li> 
                <!-- Inner Menu: contains the notifications -->
                <ul class="menu">
                  <?php
                  $ntf_data_tujuan=$kar_id;
                  $ntf_data_tampil_limit=$ntf->ntf_data_tampil_limit($ntf_data_tujuan);
                  if($ntf_data_tampil_limit){
                  foreach($ntf_data_tampil_limit as $data){
                    
                    $jointime=$data['ntf_data_tgl']." ".$data['ntf_data_jam'];
                    $sorttime=strtotime("$jointime");
  
                    $kar_id_ = $data['ntf_data_sumber'];
                    $kar_tampil_id_ = $kar->kar_tampil_id($kar_id_);
                    $data_kar_ = mysql_fetch_array($kar_tampil_id_);
                    
                    if($data['ntf_data_act'] == "Form Penilaian Kerja" || $data['ntf_data_act'] == "Hasil Penilaian Kerja" || $data['ntf_data_act'] == "Approval Penilaian Kerja"){
			  $icon_="<i class='fa fa-line-chart text-aqua'></i>";
		    }
                    elseif($data['ntf_data_act'] == "Selamat Ulang Tahun"){
			  $icon_="<i class='fa fa-birthday-cake text-danger'></i>";
		    }
                    else{
			  $icon_="<i class='fa fa-info-circle text-primary'></i>";
		    }
                    
                  ?> 
                  <li class="<?php
		    $ntf_data_read_=$kar_id;
		    $i=0;
		    $ntf_data_sts_read=$ntf->ntf_data_sts_read($ntf_data_read_);
		    while($ntf_data_sts_data=mysql_fetch_array($ntf_data_sts_read)){
		       $ntf_data_id_array['ntf'][$i]=$ntf_data_sts_data['ntf_data_id'];
		       $i++;
		    }
		    $notif=$ntf_data_id_array['ntf'];
                    $found = True;
		    foreach($notif as $data_notif){			
			if($data_notif == $data['ntf_data_id']){
			    echo"unread";
			    $found = False;
			}
		    }
		    if($found)
		    {
			echo "";
		    }
                    ?>"><a href="<?php echo $data['ntf_data_url']; ?>"> <?php echo $icon_; ?> <strong><?php echo $data['ntf_data_act']; ?></strong> - <?php echo strip_tags(substr(str_replace('"','',$data['ntf_data_isi']),0,35));?></a> </li>
                  <?php }}?>
                </ul>
              </li>
              <li class="footer"><a href="?p=data_notifikasi">View all</a></li>
            </ul>
          </li>
          <!-- User Account Menu -->
          <li class="dropdown user user-menu"> 
            <!-- Menu Toggle Button --> 
            <a href="#" class="dropdown-toggle" data-toggle="dropdown"> 
            <!-- The user image in the navbar--> 
            <img src="module/profile/img/<?php
  			    if(!empty($acc_data['acc_img'])){
  			      echo $acc_data['acc_img'];
  			    }else{
  			      echo "avatar.jpg";
  			    }
  			    ?>" class="user-image" alt="User Image"/> 
            <!-- hidden-xs hides the username on small devices so only the image appears. --> 
            <span class="hidden-xs"><?php echo $kar_data['kar_nm'];?></span> </a>
            <ul class="dropdown-menu">
              <!-- The user image in the menu -->
              <li class="user-header"> <img src="module/profile/img/<?php
    			    if(!empty($acc_data['acc_img'])){
    			      echo $acc_data['acc_img'];
    			    }else{
    			      echo "avatar.jpg";
    			    }
    			    ?>" class="img-circle" alt="User Image" />
                <p> <?php echo $kar_data['kar_nm'];?> - <?php echo $kar_data['jbt_nm'];?> <small>Tgl Lahir <?php echo $tgl->tgl_indo($kar_data['kar_tgl_lahir']);?></small> </p>
              </li>
              <!-- Menu Body -->
              <!-- <li class="user-body">
                <div class="col-xs-4 text-center"> <a href="#">Followers</a> </div>
                <div class="col-xs-4 text-center"> <a href="#">Sales</a> </div>
                <div class="col-xs-4 text-center"> <a href="#">Friends</a> </div>
              </li> -->
              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-left"> <a href="?p=data_profile&id=<?php echo $kar_data['kar_id'];?>" class="btn btn-primary btn-flat">Profile</a> </div>
                <div class="pull-right"> <form action="" method="post"><button type="submit" name="bsignout" class="btn btn-danger btn-flat">Sign out</button></form> </div>
              </li>
            </ul>
          </li>
          <!-- Control Sidebar Toggle Button -->
          <li> <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a> </li>
        </ul>
      </div>
    </nav>
  </header>