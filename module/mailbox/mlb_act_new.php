<?php
//MailBox Variable
$mlb_sbj=$_POST['mlb_sbj'];
$mlb_msg=$_POST['mlb_msg'];
$mlb_lok=str_replace(' ', '_', $_FILES['mlb_atc']['tmp_name']);
$mlb_atc=str_replace(' ', '_', $_FILES['mlb_atc']['name']);
$mlb_size=$_FILES['mlb_atc']['size'];
$mlb_type=$_FILES['mlb_atc']['type'];
$mlb_pecah=explode(".", $mlb_atc);
$mlb_extend=$mlb_pecah[1];
$mlb_tgl=$date;
$mlb_jam=$time;
//$mlb_tujuan=implode(",", (array)$_POST['mlb_tujuan']);
//$mlb_sub_tujuan=implode(",", (array)$_POST['mlb_sub_tujuan']);
$mrk_id=$_POST['mrk_id'];

$page=$_GET['p'];
$sub_page=$_GET['s'];
$read_page=$_GET['r'];
$mlb_id=$_GET['id'];

if(isset($_POST['bsave'])){
	if(!empty($mlb_atc)){
			$errors     = array();
			$maxsize    = 10485760;
			$acceptable = array('jpeg','jpg','gif','png','JPEG','JPG','GIF','PNG','pdf','docx','doc','xlsx','xls','ppt','pptx','rar','zip');

			if(($mlb_size >= $maxsize) || ($mlb_size == 0)) {
			        $errors[] = 'File too large. File must be less than 10 megabytes.';
			}
			if(!in_array($mlb_extend, $acceptable) && !empty($mlb_extend)) {
			    $errors[] = 'Invalid file type. Only JPG, GIF, PNG, PDF, DOC, XLS, PPT, ZIP and RAR types are accepted.';
			}
			if(count($errors) === 0) {

				if(!empty($_POST['mlb_tujuan'])){

					$_tujuan=$_POST['mlb_tujuan'];
					$_jml_tujuan = count($_tujuan);

					for ($i=0; $i < $_jml_tujuan; $i++)
		  			{
		  				$mlb_tujuan=$_tujuan[$i];
				    	$mlb_insert_atc_tujuan=$mlb->mlb_insert_atc_tujuan($mlb_sbj,$mlb_msg,$mlb_atc,$mlb_tgl,$mlb_jam,$mlb_tujuan,$mrk_id,$kar_id);
	            	}
			
			//Notify
			$ntf_id=mysql_insert_id();
		    	$ntf_act="MailBox";
			$ntf_isi=$ntf_id.'-'.$mlb_sbj.'-'.$mlb_msg.'-'.$mlb_atc.'-'.$mlb_tujuan;
			$ntf_ip=$ip_jaringan;
			$ntf_tgl=$date;
			$ntf_jam=$time;
			$ntf_insert=$ntf->ntf_insert($ntf_act,$ntf_isi,$ntf_ip,$ntf_tgl,$ntf_jam,$kar_id);
			//End Notify

	            }
	            elseif(!empty($_POST['mlb_sub_tujuan'])){
	            	$_sub_tujuan=$_POST['mlb_sub_tujuan'];
					$_jml_sub_tujuan = count($_sub_tujuan);

				    for ($i=0; $i < $_jml_sub_tujuan; $i++)
		  			{
		  				$mlb_sub_tujuan=$_sub_tujuan[$i];
				    	$mlb_insert_atc_sub_tujuan=$mlb->mlb_insert_atc_sub_tujuan($mlb_sbj,$mlb_msg,$mlb_atc,$mlb_tgl,$mlb_jam,$mlb_sub_tujuan,$mrk_id,$kar_id);
	            	}
			
			//Notify
			$ntf_id=mysql_insert_id();
		    	$ntf_act="MailBox";
			$ntf_isi=$ntf_id.'-'.$mlb_sbj.'-'.$mlb_msg.'-'.$mlb_atc.'-'.$mlb_sub_tujuan;
			$ntf_ip=$ip_jaringan;
			$ntf_tgl=$date;
			$ntf_jam=$time;
			$ntf_insert=$ntf->ntf_insert($ntf_act,$ntf_isi,$ntf_ip,$ntf_tgl,$ntf_jam,$kar_id);
			//End Notify

	            }
	            if($mlb_insert_atc_sub_tujuan){
		            	move_uploaded_file($mlb_lok,"module/mailbox/atc/$mlb_atc");
				    	echo"<script>document.location='?p=$page&s=$sub_page';</script>";
		        }
	            
			}else{
			    foreach($errors as $error) {
			        echo "<script>alert('$error');document.location='?p=$page&s=$sub_page';</script>";
			    }
			    die(); 
			}
            
    }else{
    		if(!empty($_POST['mlb_tujuan'])){
    			$_tujuan=$_POST['mlb_tujuan'];
				$_jml_tujuan = count($_tujuan);

				for ($i=0; $i < $_jml_tujuan; $i++)
		  		{
		  			$mlb_tujuan=$_tujuan[$i];
            		$mlb_insert_tujuan=$mlb->mlb_insert_tujuan($mlb_sbj,$mlb_msg,$mlb_tgl,$mlb_jam,$mlb_tujuan,$mrk_id,$kar_id);
        		}
			
			//Notify
			$ntf_id=mysql_insert_id();
	    		$ntf_act="MailBox";
			$ntf_isi=$ntf_id.'-'.$mlb_sbj.'-'.$mlb_msg.'-'.$mlb_tujuan;
			$ntf_ip=$ip_jaringan;
			$ntf_tgl=$date;
			$ntf_jam=$time;
			$ntf_insert=$ntf->ntf_insert($ntf_act,$ntf_isi,$ntf_ip,$ntf_tgl,$ntf_jam,$kar_id);
			//End Notify

        	}
        	elseif(!empty($_POST['mlb_sub_tujuan'])){
        		$_sub_tujuan=$_POST['mlb_sub_tujuan'];
				$_jml_sub_tujuan = count($_sub_tujuan);

				for ($i=0; $i < $_jml_sub_tujuan; $i++)
		  		{
		  			$mlb_sub_tujuan=$_sub_tujuan[$i];
            		$mlb_insert_sub_tujuan=$mlb->mlb_insert_sub_tujuan($mlb_sbj,$mlb_msg,$mlb_tgl,$mlb_jam,$mlb_sub_tujuan,$mrk_id,$kar_id);
        		}
			
			//Notify
			$ntf_id=mysql_insert_id();
	    		$ntf_act="MailBox";
			$ntf_isi=$ntf_id.'-'.$mlb_sbj.'-'.$mlb_msg.'-'.$mlb_sub_tujuan;
			$ntf_ip=$ip_jaringan;
			$ntf_tgl=$date;
			$ntf_jam=$time;
			$ntf_insert=$ntf->ntf_insert($ntf_act,$ntf_isi,$ntf_ip,$ntf_tgl,$ntf_jam,$kar_id);
			//End Notify

        	}
        	if($mlb_insert_sub_tujuan){
			    	echo"<script>document.location='?p=$page&s=$sub_page';</script>";
	        }
            
    }
}
if(isset($read_page)&&($mlb_id)){
	$mlb_tampil_id=$mlb->mlb_tampil_id($mlb_id);
	$mlb_data=mysql_fetch_array($mlb_tampil_id);
}
if(($_GET['s']=="inbox")&&($_GET['r']=="read")){
	$mlb_update_sts=$mlb->mlb_update_sts($mlb_id);
}
?>