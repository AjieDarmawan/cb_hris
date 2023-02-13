<?php

if (isset($_SERVER['HTTP_ORIGIN'])) {
    header("Access-Control-Allow-Origin: {$_SERVER['HTTP_ORIGIN']}");
    header('Access-Control-Allow-Credentials: true');
    header('Access-Control-Max-Age: 86400');
}

if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {

    if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_METHOD']))
        header("Access-Control-Allow-Methods: GET, POST, OPTIONS");         

    if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']))
        header("Access-Control-Allow-Headers:        {$_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']}");

    exit(0);
}

error_reporting(E_ALL ^ E_NOTICE);

$postdata = file_get_contents("php://input");
if (isset($postdata)) {
    
    $request = json_decode($postdata);
    
    $pts = urldecode($request->pts);
    $keyword = urldecode($request->keyword);
    
    function file_get_contents_curl($url) {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_URL, $url);
        $data = curl_exec($ch);
        curl_close($ch);
        return $data;
    }
    
    $params = array('q' => $pts.' '.$keyword);
    $content = file_get_contents_curl('https://www.google.com/search?' . http_build_query($params));
    //$content = file_get_contents_curl('https://www.google.com/search?client=firefox-b-d&' . http_build_query($params));
    preg_match('/About (.*) results/i', $content, $matchesEN);
    preg_match('/Sekitar (.*) hasil/i', $content, $matchesID);
    echo !empty($matchesEN[1]) ? preg_replace('~\D~', '',strip_tags($matchesEN[1])) : '';
    echo !empty($matchesID[1]) ? preg_replace('~\D~', '',strip_tags($matchesID[1])) : '';
    
}else{
    echo 0;
}
