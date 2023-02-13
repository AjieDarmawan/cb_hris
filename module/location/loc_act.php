<?php
$abs_tampil_kar_location_array=$abs->abs_tampil_kar_location_array($date);
while($abs_data_kar_location_array=mysql_fetch_array($abs_tampil_kar_location_array)){
    $absensi[$abs_data_kar_location_array['kar_id']]=array("kar_id"=>$abs_data_kar_location_array['kar_id']);
}
?>