<?php 

$servername = "localhost";
$username = "liveai";
$password = "20215uk5e5";
$dbname = "liveai_dailyit";


$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}



$result = array();
$result['dari'] = 0;
$result['hingga'] = 0;
$result['totaldata'] = 0;
$result['totalhalaman'] = 0;
$result['datanya'] = array();


$sortby = 'ORDER BY a.id_maintenance DESC';

if (isset($_GET['tipe']) && $_GET['tipe'] <> '') {
	$whys[] = '(a.tipe = "'.$_GET['tipe'].'")';
}
$stw_whys = count($whys) > 0 ? ' AND ' . @implode(" AND ", $whys) : '';


/*--- PREPARE PAGINATION -------------------------------------------------------------------------------------------------------------------------*/
$num = 0;
$limit = isset($_GET['length']) ? (int)$_GET['length'] : 10;
$halaman = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$no_awal = ($halaman * $limit) - $limit;

$sSQL = '
	SELECT COUNT(a.id_maintenance) as tot
	FROM di_maintenance a
	WHERE 1=1
		' . $stw_whys . '
';
$res_hal = $conn->query($sSQL);

if ($res_hal->num_rows > 0) {
    while($row = $res_hal->fetch_assoc()) {
        $num = (int)$row["tot"];
    }
}
//echo $num;exit;
$total_halaman = ceil($num / $limit);
/*--- END PREPARE PAGINATION ---------------------------------------------------------------------------------------------------------------------*/



/*--- LIST DATANYA -------------------------------------------------------------------------------------------------------------------------------*/
$sSQL = '
	SELECT a.*,b.nickname, c.nickname as user_cek_hp, d.nickname as user_cek_laptop, e.nickname as user_cek_link
	FROM di_maintenance a
	LEFT JOIN di_user b ON a.nik = b.nik
	LEFT JOIN di_user c ON a.hp_dicheck_oleh = c.nik
	LEFT JOIN di_user d ON a.laptop_dicheck_oleh = d.nik
	LEFT JOIN di_user e ON a.link_dicheck_oleh = e.nik
	WHERE 1=1
		' . $stw_whys . '
	' . $sortby . '
	LIMIT ' . $no_awal . ', ' . $limit . '
';
$res_data = $conn->query($sSQL);
if ($res_data->num_rows > 0) {
	
	$no = $no_awal;
	
    while($row = $res_data->fetch_assoc()) {
		$no++;
		
		$rowdata = array();
		$rowdata = $row;
		$rowdata['no'] = $no;
		
		$result['datanya'][] = $rowdata;
		
		$result['hingga'] = $no;
    }
	
	$result['dari'] = ($no_awal  + 1);
	$result['totaldata'] = $num;
	$result['totalhalaman'] = $total_halaman;
}
/*--- END LIST DATANYA ---------------------------------------------------------------------------------------------------------------------------*/
$conn->close();

header('Content-Type: application/json');
echo json_encode($result);
exit;
?>