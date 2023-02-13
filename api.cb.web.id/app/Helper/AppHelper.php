<?php

if(!function_exists('tanggal_indo'))
{
	function tanggal_indo($date, $format) {
		
		
		$defdate = date($format , strtotime($date));
		
		return $defdate;
	}
}


if(!function_exists('selisih_waktu'))
{
	function selisih_waktu($start=null, $end = true, $format='full') 
	{
		$res = array();
		$tanggal = new DateTime($start);
		$selisih = $tanggal->diff(new DateTime($end));
		
		switch($format) {
			case "y":
				$res = $selisih->y;
			break;
			case "m":
				$res = $selisih->m;
			break;
			case "d":
				$res = $selisih->d;
			break;
			case "h":
				$res = $selisih->h;
			break;
			case "i":
				$res = $selisih->i;
			break;
			default:
				$res['tahun'] = $selisih->y;
				$res['bulan'] = $selisih->m;
				$res['hari'] = $selisih->d;
				$res['jam'] = $selisih->h;
				$res['menit'] = $selisih->i;
			break;
		}
		
		return $res;
	}
}


if(!function_exists('rmprint'))
{
	function rmprint($data=null, $is_close = true) {
		echo "<pre>". print_r($data, 1) ."</pre>";
		if($is_close) {
			exit;
		}
	}
}


if(!function_exists('rmcrypt'))
{
	function rmcrypt($crypt = array())
	{
		$output = false;
		$encrypt_method = "AES-256-CFB8";
		
		if(is_array($crypt)) 
		{			
			if((isset($crypt['cid']) && $crypt['cid'] <> '') && (isset($crypt['secret']) && $crypt['secret'] <> ''))
			{		
				$secret_f = $crypt['cid'];
				$secret_s = $crypt['secret'];
				
				if(isset($crypt['data']) && is_string($crypt['data']))
				{
					$string = $crypt['data'];
					if(is_string($secret_f) && is_string($secret_s))
					{
						$key = hash('sha256', $secret_f);
						$iv = substr(hash('sha256', $secret_s), 0, 16);
						
						if(isset($crypt['action']) && $crypt['action'] <> '')
						{
							if($crypt['action'] == 'encrypt') 
							{
								$output = openssl_encrypt($string, $encrypt_method, $key, 0, $iv);
								$output = str_replace("=", "eniTas", base64_encode($output));
							} else if($crypt['action'] == 'decrypt')
							{
								$output = openssl_decrypt(base64_decode(str_replace("eniTas", "=", $string)), $encrypt_method, $key, 0, $iv);
							}
						}
					}
				}
			}		
		}
		
		return $output;
	}
}


