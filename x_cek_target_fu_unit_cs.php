<?php
					$nik = "SG04312017";
					
					$ch = curl_init();
					curl_setopt($ch, CURLOPT_URL,"daftarkuliah.my.id/bdc/x_crontab_activity.php");
					curl_setopt($ch, CURLOPT_POST, 1);
					curl_setopt($ch, CURLOPT_POSTFIELDS,"nik=$nik");
					curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
					$server_output = curl_exec($ch);
					curl_close ($ch);
					
					$json_data=json_decode($server_output,true);
					//$status_fu = $json_data[0]['status'];
					$status_fu = $json_data[1]['status'];

					echo 'status:'.$status_fu;
		
					echo '<br>';					
					echo '<pre>';
					echo print_r($json_data);
					echo '</pre>';

?>