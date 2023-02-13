<?php
$fields = array(
        'kodepts' => 'pl',
        'kodeprg' => 'P2K',
        'kodejrs' => 'D3UP',
        'klp' => 'AMDBL'
);

$fields_string = '';
foreach($fields as $key1=>$value1) { $fields_string .= $key1.'='.$value1.'&'; }
rtrim($fields_string, '&');

$json = file_get_contents('http://ai.web.id/dev6/api_komisi_marketing_freelance?'.$fields_string);
$data = json_decode($json,true);
echo $data[0]['komisi'];

print_r($data);
?>

