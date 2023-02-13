<?php
if(isset($_POST['bpos'])){
	$path ='module/post/atc/';
	$file = $path.$_POST['pos_file'];
}

if(isset($_POST['bacv'])){
	$path ='module/archive/file/';
	$file = $path.$_POST['acv_file'];
}

if(isset($_POST['bmlb'])){
	$path ='module/mailbox/atc/';
	$file = $path.$_POST['mlb_file'];
}


if (file_exists($file)) {
    header('Content-Description: File Transfer');
    header('Content-Type: application/octet-stream');
    header('Content-Disposition: attachment; filename='.basename($file));
    header('Expires: 0');
    header('Cache-Control: must-revalidate');
    header('Pragma: public');
    header('Content-Length: ' . filesize($file));
    readfile($file);
    exit;
}
?>
