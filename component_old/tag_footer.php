<footer class="main-footer"> 
    <!-- To the right -->
    <?php
    $unt_id=$kar_data['unt_id'];
	$ktr_id=$kar_data['ktr_id'];
    $ip_tampil_unt_ktr=$ip->ip_tampil_unt_ktr($unt_id,$ktr_id);
	$ip_data=mysql_fetch_array($ip_tampil_unt_ktr);
    ?>
    <div class="pull-right hidden-xs">IP Kantor:&nbsp; <?php echo $ip_data['ip_nm'];?> <small>(Update Release : <?php echo $tgl->tgl_indo($ip_data['ip_release']);?>)</small>, <span class="label label-primary">My IP Address:&nbsp; <?php echo $ip_jaringan;?></span></div>
    <!-- Default to the left --> 
    <strong>Copyright &copy; 2015 - 2016 <a href="#">Gilland-Ganesha</a>.</strong> All rights reserved. &nbsp;
    <?php
    if($_SESSION['kar']=="255"){
    $pecah=explode('-',$date);
    $key="basmallah";
    $key_2=($pecah[1]*$pecah[2])+1;
    $key_3=$pecah[1]+2;
    $key_4=substr($pecah[0],2,4)+3;
    echo $key.$key_2.$key_3.$key_4;
    }
    ?>
</footer>