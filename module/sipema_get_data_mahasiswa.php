<?php
require('../class.php');

$db=new Database();
$db->koneksi();
$kar=new Karyawan();
$ms=new Marketing_support();

//$exp_date = explode('/', $_POST['tgl_daftar']);
//$tgl_daftar = $exp_date[2]."-".$exp_date[1]."-".$exp_date[0];
$email = $_POST['email'];
$prg = $_POST['prg'];
$kpt = $_POST['kpt'];


$header = array(
        'Content-Type: application/x-www-form-urlencoded',
        'Connection: keep-alive'
);

$fields = array(
        //'tgl_daftar' => $tgl_daftar,
        'email' => $email,
        'prg' => $prg,
        'kpt' => $kpt
);

$fields_string = '';
foreach($fields as $key1=>$value1) { $fields_string .= $key1.'='.$value1.'&'; }
rtrim($fields_string, '&');

////////////////////////////////////////////////////////////////////////////

$SIPEMA_url = "http://103.86.160.10/api/get_data_mahasiswa.php";
    
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

if($SIPEMA_datares['message'] == 'success'){
    if($SIPEMA_datares['kpi'] != 'EDUNITAS' && $SIPEMA_datares['kpi'] != '' && $SIPEMA_datares['kpi'] != NULL){
        $username = $SIPEMA_datares['kpi'];
        $nik = substr($username,0,2);
        
        if($nik == 'SG'){
        
            $nik .= ".";
            $nik .= substr($username,2,4);
            $nik .= ".";
            $nik .= substr($username,-4);
            
            $kar_tampil_username=$kar->kar_tampil_username($nik);
            $data=mysql_fetch_array($kar_tampil_username);
            
            $SIPEMA_datares['kpi']=$data['kar_nm'] . " (" . $data['div_nm'] . ")";
            
        }elseif($nik == 'MS'){
            $nik .= ".";
            $nik .= substr($username,2,4);
            $nik .= ".";
            $nik .= substr($username,-4);
            
            $kar_tampil_username=$ms->ms_tampil_username($nik);
            $data=mysql_fetch_array($kar_tampil_username);
            
            $SIPEMA_datares['kpi']=$data['kar_nm'] . " (" . $data['div_nm'] . ")";
            
        }else{
            $SIPEMA_datares['kpi']=$username;
        }
    
        
    }
}

echo json_encode($SIPEMA_datares);
?>