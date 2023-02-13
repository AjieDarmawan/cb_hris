<?php
					//$nik = "SG02692015";
					$nik = $_REQUEST['nik'];
					$url_tagih = "http://103.86.160.10/dev2/cronhistory_absen_fu/".$nik;
					$filter = "";
					$ch = curl_init();
					curl_setopt($ch, CURLOPT_URL,$url_tagih);
					curl_setopt($ch, CURLOPT_POST, 1);
					curl_setopt($ch, CURLOPT_POSTFIELDS,$filter);
					curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
					$server_output = curl_exec($ch);
					curl_close ($ch);
					
					$json_data=json_decode($server_output,true);
					echo $json_data;
/*					
					//$status_fu = $json_data[0]['status'];
					$status_fu = $json_data[1]['status'];
					echo '<br>status:'.$status_fu;
					echo '<br>target_fu:'.$json_data[1]['target_fu'];
*/				
/*					
					echo '<br>';
					echo '<pre>';
					echo print_r($json_data);
					echo '</pre>';
*/
?>
