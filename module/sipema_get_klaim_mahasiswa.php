<?php
$email = $_POST['email'];
$prg = $_POST['prg'];
$kpt = $_POST['kpt'];
$username = $_POST['username'];
$tanggal = $_POST['tanggal'];


$header = array(
        'Content-Type: application/x-www-form-urlencoded',
        'Connection: keep-alive'
);

$fields = array(
        //'tgl_daftar' => $tgl_daftar,
        'email' => $email,
        'prg' => $prg,
        'kpt' => $kpt,
        'username' => $username,
        'tanggal' => $tanggal
);

$fields_string = '';
foreach($fields as $key1=>$value1) { $fields_string .= $key1.'='.$value1.'&'; }
rtrim($fields_string, '&');

////////////////////////////////////////////////////////////////////////////

$SIPEMA_url = "http://103.86.160.10/api/get_klaim_mahasiswa.php";
    
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

print_r($SIPEMA_response);



////////////////////////////////////////////////////////////////////////////

$nik = substr($username,0,2);
if($nik == 'MS'){
    $BDC_url = "https://mf.daftarkuliah.my.id/klaim_closing.php";
}else{
    $BDC_url = "http://daftarkuliah.my.id/bdc/klaim_closing.php";
}

$BDC_curl = curl_init();

curl_setopt_array($BDC_curl, array(
        CURLOPT_URL => $BDC_url,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        //CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "POST",
        CURLOPT_POSTFIELDS => $fields_string,
        CURLOPT_HTTPHEADER => $header,
));


$BDC_response = curl_exec($BDC_curl);
$BDC_err = curl_error($BDC_curl);

curl_close($BDC_curl);

$BDC_datares = json_decode($BDC_response, true);
?>