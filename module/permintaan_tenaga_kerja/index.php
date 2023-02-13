
<?php 
  
 // error_reporting(0);
   session_start();
   date_default_timezone_set('Asia/Jakarta');


   
   foreach($_REQUEST as $name=>$value){
		$$name=$value;
		//echo "Name: $name : $value;<br />\n";
   }
   //return;

   $user_nama = $use_data['use_nama']; 
   $_SESSION['user_nama'] = $use_data['use_nama'];
   $dir_url 	= "module/$p/";

   include_once($dir_url.'/rev_data.php');
   
?>

