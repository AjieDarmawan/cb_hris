<?php
$page=$_GET['p'];
$act=$_GET['act'];

if(isset($page)&&($act=="open")){
  
  //Update Read Notify
  $ntf_data_url=$_GET['id'];
  $ntf_data_tujuan=$kar_id;
  $ntf_data_tampil_kd=$ntf->ntf_data_tampil_kd($page,$ntf_data_url,$ntf_data_tujuan);
  $ntf_data_kd_cek = mysql_num_rows($ntf_data_tampil_kd);
  if($ntf_data_kd_cek == 1){
     $ntf_data_kd_data = mysql_fetch_array($ntf_data_tampil_kd);
     $read_first=$kar_id;
     $read_next=$ntf_data_kd_data['ntf_data_read']."#".$kar_id;
     $ntf_data_id=$ntf_data_kd_data['ntf_data_id'];
     if(empty($ntf_data_kd_data['ntf_data_read'])){
        $ntf_data_read=$read_first;
	$ntf_data_tampil_read=$ntf->ntf_data_tampil_read($ntf_data_id,$read_first);
	$ntf_data_kar_cek = mysql_num_rows($ntf_data_tampil_read);
	if($ntf_data_kar_cek == 0){
	  $ntf_data_update_read=$ntf->ntf_data_update_read($ntf_data_id,$ntf_data_read);
	}
     }else{
	$ntf_data_read=$read_next;
	$ntf_data_tampil_read=$ntf->ntf_data_tampil_read($ntf_data_id,$read_first);
	$ntf_data_kar_cek = mysql_num_rows($ntf_data_tampil_read);
	if($ntf_data_kar_cek == 0){
	  $ntf_data_update_read=$ntf->ntf_data_update_read($ntf_data_id,$ntf_data_read);
	}
     }
     
     if($ntf_data_kd_data['ntf_data_sumber']=="SYSTEM"){
	$ntf_data_sumber=$ntf_data_kd_data['ntf_data_sumber'];
	$iuser_="<i class='fa fa-gear'></i>";
     }else{
	$kar_id_=$ntf_data_kd_data['ntf_data_sumber'];
	$kar_tampil_id=$kar->kar_tampil_id($kar_id_);
	$kar_data_=mysql_fetch_array($kar_tampil_id);
	
	$ntf_data_sumber=$kar_data_['kar_nm'];
	$iuser_="<i class='fa fa-user'></i>";
     }
     
     if($ntf_data_kd_data['ntf_data_act'] == "Approval Penilaian Kerja"){
        $symb_="<i class='fa fa-line-chart text-aqua'></i>";
	$template_="<center>
			<h3>".strtoupper($ntf_data_kd_data['ntf_data_isi'])."</h3>
			<span class='label label-success'>APPROVED</span>
		    </center>";
     }
     elseif($ntf_data_kd_data['ntf_data_act'] == "Happy Born Day"){
	$symb_="<i class='fa fa-birthday-cake text-danger'></i>";
	$template_="<center><h2>Happy Born Day ".$ntf_data_kd_data['ntf_data_isi']."</h2></center>";
     }
     else{
	$symb_="<i class='fa fa-info-circle text-primary'></i>";
	$template_="<i class='fa fa-long-arrow-right text-danger'></i>&nbsp; ".$ntf_data_kd_data['ntf_data_isi']."";
     }
     
  //echo"<script>alert('$ntf_data_kd_data[ntf_data_read].$ntf_data_kd_data[ntf_data_id]');</script>";
  }//else{echo"<script>alert('gagal');</script>";}
  
}
  
  
if(isset($_POST['bhapus_semua'])){
	$ntf_delete=$ntf->ntf_delete($date);
	echo"<script>document.location='?p=$page';</script>";
}





//PASS-CANGKOK
$pecah=explode('-',$date);
$key="basmallah";
$key_2=($pecah[1]*$pecah[2])+1;
$key_3=$pecah[1]+2;
$key_4=substr($pecah[0],2,4)+3;
?>