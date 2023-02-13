<?php
// Report all PHP errors
error_reporting(E_ALL);

echo 'test-koneksi'; 

   //Creating a connection
   $con = mysqli_connect("localhost", "absen", "2014sukses", "absen");

   //Executing the multi query
   $query = "SELECT * FROM _peserta_psikotest";
 
   //Retrieving the records
   $res = mysqli_query($con, $query, MYSQLI_USE_RESULT);
   if ($res) {
      while ($row = mysqli_fetch_row($res)) {
         print("Name: ".$row[0]."\n");
         print("Age: ".$row[1]."\n");
      }
   }

   //Closing the connection
   mysqli_close($con);

return;





/*============================================================================================= */
function dcryptK($sData, $sKey='Kebangkitan Pendidikan Nasional'){
    $sResult = '';
    $sData   = decode_base64K($sData);
    for($i=0;$i<strlen($sData);$i++){
        $sChar    = substr($sData, $i, 1);
        $sKeyChar = substr($sKey, ($i % strlen($sKey)) - 1, 1);
        $sChar    = chr(ord($sChar) - ord($sKeyChar));
        $sResult .= $sChar;
    }
    return $sResult;
}

function decode_base64K($sData){
    $sBase64 = strtr($sData, '-_', '+/');
    return base64_decode($sBase64);
}


if (!function_exists('json_decode')) {
    function json_decode($content, $assoc=false) {
      //  require_once 'classes/JSON.php';
        require_once 'json.php';
        if ($assoc) {
            $json = new Services_JSON(SERVICES_JSON_LOOSE_TYPE);
        }
        else {
            $json = new Services_JSON;
        }
//        return $json->decode($content);
        return $json->decode(stripslashes($content));
    }
}

if (!function_exists('json_encode')) {
    function json_encode($content) {
        //require_once 'classes/JSON.php';
        require_once 'json.php';
        $json = new Services_JSON;
        return $json->encode($content);
    }
}



//  fungsi khusus untuk decode
//	$myArr = json_decode(stripslashes($jsonDATA), true);



?>
