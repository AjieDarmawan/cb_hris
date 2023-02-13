<?php
$file = '../'.$_GET['origin'].'/assets/berkas/'.$_GET['file'];
if(file_exists($file)) {
	
	$finfo = finfo_open(FILEINFO_MIME_TYPE);
	$type = finfo_file($finfo, $file);
	finfo_close($finfo);
	
	// header($_SERVER["SERVER_PROTOCOL"] . " 200 OK");
	// header("Cache-Control: public"); // needed for internet explorer
	// header("Content-Type: ".$type);
	// header("Content-Transfer-Encoding: Binary");
	// header("Content-Length:".filesize($file));
	// header("Content-Disposition: attachment; filename=".$_GET['file']);
	// readfile($file);
	// die();
	
	
	header('Content-Description: File Transfer');
    header('Content-Type: application/octet-stream');
    header('Content-Disposition: attachment; filename="'.basename($file).'"');
    header('Expires: 0');
    header('Cache-Control: must-revalidate');
    header('Pragma: public');
    header('Content-Length: ' . filesize($file));
    readfile($file);
	exit();
}
echo "gadad";
exit;
?>