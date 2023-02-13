<?php 

$servername = "localhost";
$username = "absen";
$password = "2014sukses";
$dbname = "test_absen";


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


$sortby = 'ORDER BY a.tanggal DESC';

if (isset($_GET['tanggal']) && trim($_GET['tanggal']) <> '') {
	$whys[] = '(a.tanggal = "'.$_GET['tanggal'].'")';
}
$stw_whys = count($whys) > 0 ? ' AND ' . @implode(" AND ", $whys) : '';


/*--- PREPARE PAGINATION -------------------------------------------------------------------------------------------------------------------------*/
$num = 0;
$limit = isset($_GET['length']) ? (int)$_GET['length'] : 10;
$halaman = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$no_awal = ($halaman * $limit) - $limit;

$sSQL = '
	SELECT COUNT(a.id_sembilan) as tot
	FROM aktifitas_sembilan a
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
	SELECT a.*,c.nama_karyawan as nickname, b.nama_aktifitas_sembilan as nama_aktifitas, d.div_nm as label_divisi
	FROM aktifitas_sembilan a
	LEFT JOIN tipe_aktifitas_sembilan b ON a.id_aktifitas_sembilan = b.id_aktifitas_sembilan
	LEFT JOIN users c ON a.nik = c.nik
	LEFT JOIN divisi d ON c.divisi_id = d.div_id
	WHERE 1=1
		' . $stw_whys . '
	GROUP BY a.id_sembilan
	' . $sortby . '
	LIMIT ' . $no_awal . ', ' . $limit . '
';
$res_data = $conn->query($sSQL);
if ($res_data->num_rows > 0) {
	
	$no = $no_awal;
	
    while($row = $res_data->fetch_assoc()) {
		$no++;
		
		unset($row['createdAt']);
		unset($row['updatedAt']);
		unset($row['id_sembilan']);
		unset($row['id_aktifitas_sembilan']);
		
		$rowdata = array();
		$rowdata['no'] = $no;
		$rowdata['nik'] = $row['nik'];
		$rowdata['nama'] = $row['nickname'];
		$rowdata['divisi'] = $row['label_divisi'];
		$rowdata['aktifitas'] = $row['nama_aktifitas'];
		$rowdata['keterangan'] = $row['judul_aktifitas'];
		$rowdata['tanggal'] = $row['tanggal'];
		$rowdata['link'] = $row['link'];
		$rowdata['kampus'] = '';
		// $rowdata = array();
		// $rowdata = $row;
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