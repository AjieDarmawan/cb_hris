<?php
$header = array(
        'Content-Type: application/x-www-form-urlencoded',
        'Connection: keep-alive'
);

$fields = array(
        'type' => 'datagaada',
        'username' => 'sg02482015'
);


$fields_string = '';
foreach($fields as $key1=>$value1) { $fields_string .= $key1.'='.$value1.'&'; }
rtrim($fields_string, '&');

////////////////////////////////////////////////////////////////////////////
$SIPEMA_url = "https://cb.web.id/apikaryawan/getdata.php";
$SIPEMA_curl = curl_init();
curl_setopt_array($SIPEMA_curl, array(
        CURLOPT_URL => $SIPEMA_url,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        //CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "POST",
        CURLOPT_POSTFIELDS => $fields_string,
        CURLOPT_HTTPHEADER => $header,
));

$SIPEMA_response = curl_exec($SIPEMA_curl);
$SIPEMA_err = curl_error($SIPEMA_curl);

curl_close($SIPEMA_curl);
$SIPEMA_datares = json_decode($SIPEMA_response, true);

print_r($SIPEMA_datares);

echo "dddd";
?>