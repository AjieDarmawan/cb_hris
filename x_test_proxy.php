<?php

$test_HTTP_proxy_headers = array(
	'HTTP_VIA',
	'VIA',
	'Proxy-Connection',
	'HTTP_X_FORWARDED_FOR',  
	'HTTP_FORWARDED_FOR',
	'HTTP_X_FORWARDED',
	'HTTP_FORWARDED',
	'HTTP_CLIENT_IP',
	'HTTP_FORWARDED_FOR_IP',
	'X-PROXY-ID',
	'MT-PROXY-ID',
	'X-TINYPROXY',
	'X_FORWARDED_FOR',
	'FORWARDED_FOR',
	'X_FORWARDED',
	'FORWARDED',
	'CLIENT-IP',
	'CLIENT_IP',
	'PROXY-AGENT',
	'HTTP_X_CLUSTER_CLIENT_IP',
	'FORWARDED_FOR_IP',
	'HTTP_PROXY_CONNECTION');
	
	foreach($test_HTTP_proxy_headers as $header){
		if (isset($_SERVER[$header]) && !empty($_SERVER[$header])) {
			exit("Please disable your proxy connection!");
		}
	}

echo 'User Real IP - '.GetClientIP(true);

function GetClientIP($validate = False) {
  $ipkeys = array(
  'REMOTE_ADDR',
  'HTTP_CLIENT_IP',
  'HTTP_X_FORWARDED_FOR',
  'HTTP_X_FORWARDED',
  'HTTP_FORWARDED_FOR',
  'HTTP_FORWARDED',
  'HTTP_X_CLUSTER_CLIENT_IP'
  );

  /*
  Now we check each key against $_SERVER if containing such value
  */
  $ip = array();
  foreach ($ipkeys as $keyword) {
    if (isset($_SERVER[$keyword])) {
      if ($validate) {
        if (ValidatePublicIP($_SERVER[$keyword])) {
          $ip[] = $_SERVER[$keyword];
        }
      }
      else{
        $ip[] = $_SERVER[$keyword];
      }
    }
  }

  $ip = ( empty($ip) ? 'Unknown' : implode(", ", $ip) );
  return $ip;
}

function ValidatePublicIP($ip){
  if (filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_NO_PRIV_RANGE | FILTER_FLAG_NO_RES_RANGE)) {
    return true;
  }
  else {
    return false;
  }
}
?>
