<?php 
  if ($_SERVER['HTTP_HOST']=="localhost"){
	    $gaSql['user']       = "root";
	    $gaSql['password']   = "mysql";
	    $gaSql['db']         = "absen";
	    $gaSql['server']     = "localhost";
    }else{
	    $gaSql['user']       = "absen";
	    $gaSql['password']   = "2014sukses";
	    $gaSql['db']         = "absen";
	    $gaSql['server']     = "localhost";	
    }	
       
   $gaSql['link'] =  @mysql_pconnect( $gaSql['server'], $gaSql['user'], $gaSql['password']  ) or
	   die( 'Could not open connection to server' );
   
   @mysql_select_db( $gaSql['db'], $gaSql['link'] ) or 
	   die( 'Could not select database '. $gaSql['db'] );
?>
  