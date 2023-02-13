<?php
date_default_timezone_set('Asia/Jakarta');
session_start(); 

foreach($_REQUEST as $name=>$value)
{
		$$name=$value;
		//echo "$name : $value;<br />\n";
}

//if(isset($_POST['filter_day'])){
 require('../../class.php');
 require('../../object.php');
 $db->koneksi();
//}


$date=date('Y-m-d');
$time=date('H:i:s');


$page=$_GET['p'];

$act=$_GET['act'];



$_div_id = $kar_data['div_id'];



if(isset($_POST['bday'])){



    if(!empty($_POST['filter_day'])){

        $_SESSION['frange'] = $_POST['filter_day'];

        $filter_day = $_SESSION['frange'];

    }else{

        $_SESSION['frange'] = "";

    }

/*

   echo"<script>document.location='?p=$page';</script>";
*/

}



//if(isset($_POST['bclearday'])){
if(bclearday == "bclearday" || $filter_day == "" ){
    $_SESSION['frange'] = "";
/*
    echo"<script>document.location='?p=$page';</script>";
*/

}

if (  $filter_day <> "" ){
  $_SESSION['frange'] = $filter_day;
}

if(!empty($_SESSION['frange'])){

 
	$exp_daterange = explode(' - ', $_SESSION['frange']);

	$exp_datestart = explode('/', $exp_daterange[0]);

        $exp_dateend = explode('/', $exp_daterange[1]);

	$day_start = $exp_datestart[2]."-".$exp_datestart[1]."-".$exp_datestart[0];

	$day_end = $exp_dateend[2]."-".$exp_dateend[1]."-".$exp_dateend[0];

		

	$r_awal = date("d/m/Y", strtotime($day_start));

	$r_sekarang = date("d/m/Y", strtotime($day_end));

	

	$r_awal_ori = date("Y-m-d", strtotime($day_start));

	$r_sekarang_ori = date("Y-m-d", strtotime($day_end));

	

	$f_daterange = $r_awal." - ".$r_sekarang;

}else{



      $r_awal = date("01/m/Y", strtotime($date));

      $r_sekarang = date("d/m/Y", strtotime($date));

      

      $r_awal_ori = date("Y-m-01", strtotime($date));

      $r_sekarang_ori = date("Y-m-d", strtotime($date));

      

      $f_daterange = $r_awal." - ".$r_sekarang;



}



if(isset($_POST['filter_divisi'])){

    if(!empty($_POST['filter_divisi'])){

        $_SESSION['fdivisi'] = $_POST['filter_divisi'];

        $filter_divisi = $_SESSION['fdivisi'];

    }else{

        $filter_divisi = $_div_id;

    }

/*

    echo"<script>document.location='?p=$page';</script>";
*/
}



if(!empty($_SESSION['fdivisi'])){

    $filter_divisi = $_SESSION['fdivisi'];

}else{

    $filter_divisi = $_div_id;

}



$arr_STATUS=array('Y'=>'P','N'=>'C');

$arr_Karyawan = array();

$arr_NIK = array();

$wfh_karyawan_divisi=$wfh->wfh_karyawan_divisi($filter_divisi);

while($data=mysql_fetch_array($wfh_karyawan_divisi)){

    $arr_Karyawan[] = array('kar_nik' => $data['kar_nik'],'kar_nm' => $data['kar_nm']);

    $arr_NIK[] = $data['kar_nik'];

}

$wfh_username = implode("','", $arr_NIK);

$arr_Activity = array();
$arr_WFHKey = array();

$sql_1 = "SELECT * FROM abs_menanam WHERE abm_nik IN('$wfh_username')
		  AND abm_date BETWEEN '$r_awal_ori' AND '$r_sekarang_ori' 
		  GROUP BY abm_nik,abm_date ORDER BY abm_date DESC 
		";
	
$query_1 = mysql_query($sql_1) or die (mysql_error());
while($act_data_arr = mysql_fetch_assoc($query_1 )){
    $wfh_status = $arr_STATUS[$act_data_arr['abm_date']] ? $arr_STATUS[$act_data_arr['abm_date']] : 'P';
	//$wfh_status = "P";
    $arr_Activity[$act_data_arr['abm_nik']][$act_data_arr['abm_date']] = $wfh_status;
   
}

?>


                <div class="box-body  table-responsive touch drag">

                    <table class="table table-bordered table-striped table-hover table-condensed display" title="Silahkan Geser Cursor Untuk Lanjut Melihat">

                      <thead>

                        <tr>

                          <th><small>Tanggal</small></th>

                          <?php

                          foreach($arr_Karyawan as $key1 => $val1){

                          ?>

                          <th title="<?php echo $val1['kar_nm'];?>"><small><?php echo $val1['kar_nm'];?></small></th>

                          <?php }?>

                        </tr>

                      </thead>

                      <tbody>

                        <?php

                        $daterange = $tgl->date_range($r_awal_ori,$r_sekarang_ori,"+1 day","Y-m-d");

                        rsort($daterange);

                        foreach($daterange as $data){

                          $wfh_tgl_input = $data;

                          

                        ?>

                          <tr style="cursor: grab;">

                            <td class="text-blue"><?php echo date("d/m/Y", strtotime($data));?></td>

                            

                            <?php

                            foreach($arr_Karyawan as $key1 => $val1){

                                if($arr_Activity[$val1['kar_nik']][$wfh_tgl_input] == 'P'){

                                    $tdColor="success";

                                }elseif($arr_Activity[$val1['kar_nik']][$wfh_tgl_input] == 'C'){

                                    $tdColor="warning";

                                }else{

                                    $tdColor="danger";

                                }

                                

                                if($kar_data['kar_jdw_akses'] == "ALL"){

                            ?>

                            <td class="<?php echo $tdColor;?>" style="text-align: center; font-weight: bold;"><a href="?p=WFH_report&act=open&id=<?php echo $arr_WFHKey[$val1['kar_nik']][$wfh_tgl_input];?>" target="_blank"><?php echo $arr_Activity[$val1['kar_nik']][$wfh_tgl_input];?></a></td>

                            <?php

                                }else{

                                  if($val1['kar_nik'] == $kar_data['kar_nik']){

                            ?>

                            <td class="<?php echo $tdColor;?>" style="text-align: center; font-weight: bold;"><a href="?p=WFH_report&act=open&id=<?php echo $arr_WFHKey[$val1['kar_nik']][$wfh_tgl_input];?>" target="_blank"><?php echo $arr_Activity[$val1['kar_nik']][$wfh_tgl_input];?></a></td>

                            <?php }else{ ?>

                            <td class="<?php echo $tdColor;?>" style="text-align: center; font-weight: bold;"><?php echo $arr_Activity[$val1['kar_nik']][$wfh_tgl_input];?></td>

                            <?php }}}?>

                          </tr>

                        <?php }?>

                      </tbody>

                    </table>

                </div>

                <div class="box-footer">
<!--
                  <div class="alert alert-info" style="margin-top: 5px;">

                  <h4><i class="icon fa fa-info"></i> Keterangan :</h4>

                  1. <strong>"(MERAH)"</strong> : Belum membuat & mengirim report.<br>

                  2. <strong>"P"</strong> : Sudah membuat & mengirim report. <br>

                  3. <strong>"C"</strong> : Sudah membuat namun belum mengirim report.<br>
!-->
                  </div>

                </div>

            </div>

