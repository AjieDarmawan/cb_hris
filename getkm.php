
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <table border="1">
        <thead>
            <tr>
                <td>Nama Karyawan</td>
                <td>Jarak</td>
                <td>Waktu</td>
            </tr>
        </thead>
        <tbody>
<?php
$url_base = 'https://maps.googleapis.com/maps/api/distancematrix/json?';
$db = mysqli_connect('localhost','absen','2014sukses','absen');
$query = mysqli_query($db,"SELECT km.kar_nm,km.kar_lat,km.kar_long,ktr.ktr_lat,ktr_long FROM kar_master km JOIN (SELECT ktr_lat,ktr_long,ktr_id FROM ktr_master) ktr ON km.ktr_id = ktr.ktr_id JOIN (SELECT kar_dtl_typ_krj,kar_id FROM kar_detail) kd ON km.kar_id=kd.kar_id WHERE kar_lat != '' AND kar_long != '' AND kd.kar_dtl_typ_krj != 'Resign'");
while($data = mysqli_fetch_array($query)){
// var_dump($data);
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL,$url_base.'destinations='.$data["kar_lat"].','.$data["kar_long"].'&origins='.$data["ktr_lat"].','.$data["ktr_long"].'&mode=driving&key=AIzaSyAv55eTFQnFNA_nnzzDlGwJ0xJLg7shyow');
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_HTTPHEADER, array("REFERER:Referer: http://live.ai.web.id/"));
curl_setopt($ch, CURLOPT_POSTFIELDS, "type=semuanya");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$server_output = curl_exec($ch);
$arrResponse = (array) json_decode($server_output);
curl_close ($ch);
$dataKaryawan = $arrResponse;
$distance = $dataKaryawan['rows'][0]->elements[0]->distance;
$duration = $dataKaryawan['rows'][0]->elements[0]->duration;
?>

            <tr>
                <td><?php echo $data['kar_nm']; ?></td>
                <td><?php echo $distance->text; ?></td>
                <td><?php echo $duration->text; ?></td>
            </tr>

<?php } ?>
</tbody>
    </table>
</body>
</html>