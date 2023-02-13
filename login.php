<?php if($date >= "2017-01-01" && $date < "2017-01-03"){ $padding="no-padding"; }else{ $padding=""; };?>
<form class="form-signin" action="" method="post" autocomplete="off">
  <div class="form-signin-logo <?php echo $padding;?>">
    <?php if($date >= "2017-01-01" && $date < "2017-01-03"){?>
    <img src="dist/img/ggnewyear2017n.jpg" alt="Welcome 2017" title="Welcome 2017"/>
    <?php }else{?>
    <img src="dist/img/logo_depan_baru.JPG" class="img-circle" alt="User Image"/>
    <?php }?>
  </div>
  <?php if($date >= "2016-07-01" && $date < "2016-07-18"){?>
  <?php }else{?>
  <h2 class="form-signin-heading"><i class="fa fa-user"></i> KARYAWAN</h2>
  <?php }?>
  <label for="acc_username" class="sr-only">NIK</label>
  <input autocomplete="off" type="text" name="acc_username" id="acc_username" class="form-control" placeholder="Username" required autofocus>
  <label for="acc_password" class="sr-only">Password</label>
  <input autocomplete="off" type="password" name="acc_password" id="acc_password" class="form-control" placeholder="Password" required>
  <div class="checkbox">
    <label> 
      <!--<input type="checkbox" value="remember-me">
                  Remember me --> 
      <i class="fa fa-circle-o"></i> <a href="#">Lupa Password?</a> </label>
  </div>
  <button name="bsignin" class="btn btn-lg btn-primary btn-block" type="submit"><i class="fa fa-check"></i> Sign in</button>
</form>