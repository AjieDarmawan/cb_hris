<?php
header('Content-Type: application/json');
//$db = new PDO('mysql:host=203.29.27.140;dbname=persoweb', 'personalia', 'kagaklupa');
$db = new PDO('mysql:host=localhost;dbname=absen', 'absen', '2014sukses');
$param = "%{$_GET['q']}%";
$stmt = $db->prepare("SELECT a.*,b.*, a.kar_nm as value FROM kar_master as a, acc_master as b WHERE a.kar_id=b.kar_id AND a.kar_nm LIKE :query ");
$stmt->bindValue(':query', $param);
$stmt->execute();
$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
if(!empty($result)) {
    echo json_encode($result);
}
else{
    return false;
}
?>