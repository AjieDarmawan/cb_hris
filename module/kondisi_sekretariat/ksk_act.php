<?php

$page = $_GET['p'];
$act = $_GET['act'];
$id = $_GET['id'];
$ksk_hrd = $_GET['ksk_hrd'];


$ksk_id = $_POST['ksk_id'];
// $ksk_tgl = $_POST['ksk_tgl'];
// $ksk_waktu = $_POST['ksk_waktu'];
// $ksk_picid = $_POST['ksk_picid'];

// $ksk_pic = $_POST['ksk_pic'];
// $ksk_metode = $_POST['ksk_metode'];
$ksk_unit = $_POST['ksk_unit'];
$ksk_staff = $_POST['ksk_staff'];
$ksk_posisi = $_POST['ksk_posisi'];
$ksk_deskripsi_arr = $_POST['ksk_deskripsi'];
$ksk_kondisi = $_POST['ksk_kondisi'];
$ksk_kondisi_txt = $_POST['ksk_kondisi_txt'];
$ksk_status = $_POST['ksk_status'];
$ksk_crdt = date('Y-m-d H:i:s');
$ksk_mddt = date('Y-m-d H:i:s');

// $propfile = array();
// $propfile['dir'] = $v['cid'];
// $attr['attr'] = json_encode($propfile);

//Variable Filter
$priode = $_POST['priode'];
$pts = $_POST['pts'];
$staff = $_POST['staff'];
$wilayah = $_POST['wilayah'];


if (isset($_POST['forminput']) && $_POST['forminput'] == 'post') {

	// echo "<script>alert('Insert masuk sini');document.location='?p=$page';</script>";

	if (is_array($_FILES)) {
		// print_r($_FILES['files']);
		// exit;
		foreach ($_FILES['files']['name'] as $key => $name) {
			$file_name = explode(".", $_FILES['files']['name'][$key]);
			// $file_name = end($file_namearr);
			$allowed_ext = array("jpg", "jpeg", "png", "gif");
			if (in_array(end($file_name), $allowed_ext)) {
				$new_name = "Kondisi_Sekretariat_" . $ksk_unit . "_" . $ksk_staff . "_" . $ksk_tgl . "_" . $key . '.' . end($file_name);
				$sourcePath = $_FILES['files']['tmp_name'][$key];
				$targetPath = "module/kondisi_sekretariat/files/image/" . $new_name;
				// $sql = "INSERT INTO tbl_images (id, location) VALUES (null, '{$targetPath}')";
				// $image = mysqli_query($conn, $sql);
				if (move_uploaded_file($sourcePath, $targetPath)) {
					$ksk_img_arr[$key] = $new_name;
				} else {
					// echo "source ";
					// echo $sourcePath;
					// echo "path";
					// echo $targetPath;
					// exit;
				}
			}
		}
	}
	$ksk_img = $ksk_img_arr ? @json_encode($ksk_img_arr, JSON_FORCE_OBJECT) : '';
	$ksk_deskripsi = $ksk_deskripsi_arr ? @json_encode($ksk_deskripsi_arr, JSON_FORCE_OBJECT) : '';

	$ksk_insert = $ksk->ksk_insert($ksk_unit, $ksk_staff, $ksk_posisi, $ksk_deskripsi, $ksk_kondisi, $ksk_kondisi_txt, $ksk_crdt, $ksk_img);

	if ($ksk_insert) {

		echo "<script>document.location='?p=$page';</script>";
	} else {
		echo "<script>alert('Insert Failed');document.location='?p=$page';</script>";
	}
}

if (isset($_POST['forminput']) && $_POST['forminput'] == 'put') {

	$ksk_img_arr = array();
	$ksk_img_tampil = $ksk->ksk_tampil_img($ksk_id);
	$ksk_img_data = mysql_fetch_assoc($ksk_img_tampil);
	if ($ksk_img_data['ksk_img'] != '') {
		$ksk_img_arr = @json_decode($ksk_img_data['ksk_img'], true);
	}
	// echo "<script>console.log('" . $ksk_img . "')</script>";

	if (is_array($_FILES)) {
		// print_r($_FILES['files']);
		// exit;
		foreach ($_FILES['files']['name'] as $key => $name) {

			$file_name = explode(".", $_FILES['files']['name'][$key]);
			// $file_name = end($file_namearr);
			$allowed_ext = array("jpg", "jpeg", "png", "gif");
			if (in_array(end($file_name), $allowed_ext)) {
				$new_name = "Kondisi_Sekretariat_" . $ksk_unit . "_" . $ksk_staff . "_" . $ksk_tgl . "_" . $key . '.' . end($file_name);
				$sourcePath = $_FILES['files']['tmp_name'][$key];
				$targetPath = "module/kondisi_sekretariat/files/image/" . $new_name;
				// $sql = "INSERT INTO tbl_images (id, location) VALUES (null, '{$targetPath}')";
				// $image = mysqli_query($conn, $sql);
				if (move_uploaded_file($sourcePath, $targetPath)) {
					$ksk_img_arr[$key] = $new_name;
				} else {
					// echo "source ";
					// echo $sourcePath;
					// echo "path";
					// echo $targetPath;
					// exit;
				}
			}
		}
	}
	$ksk_img = $ksk_img_arr ? @json_encode($ksk_img_arr, JSON_FORCE_OBJECT) : '';
	$ksk_deskripsi = $ksk_deskripsi_arr ? @json_encode($ksk_deskripsi_arr, JSON_FORCE_OBJECT) : '';
	// echo $ksk_img;
	$ksk_update = $ksk->ksk_update($ksk_id, $ksk_unit, $ksk_staff, $ksk_posisi, $ksk_deskripsi, $ksk_kondisi, $ksk_kondisi_txt, $ksk_crdt, $ksk_img);
	if ($ksk_update) {
		echo "<script>document.location='?p=$page';</script>";
	} else {
		echo "<script>alert('Insert Failed');document.location='?p=$page';</script>";
	}
}

if (isset($_POST['formprogress']) && $_POST['formprogress'] == 'put') {

	$ksk_progress = $ksk->ksk_progress($ksk_id, $ksk_status, $ksk_crdt);
	if ($ksk_progress) {
		echo "<script>document.location='?p=$page';</script>";
	} else {
		echo "<script>alert('Update Progress Failed');document.location='?p=$page';</script>";
	}
}

if (isset($page) && ($act == "hapus")) {
	$ksk_id_ = $id;
	$ksk_delete = $ksk->ksk_delete($ksk_id_);
	echo "<script>document.location='?p=$page';</script>";
}


if (isset($page) && ($act == "konfirmhrd")) {
	$ksk_id_ = $id;
	$ksk_hrd_ = $ksk_hrd;
	$ksk_konfirmhrd = $ksk->ksk_konfirmhrd($ksk_id_, $ksk_hrd_);
	echo "<script>document.location='?p=$page';</script>";
}

if (isset($_POST['bfilterksk'])) {
	if (!empty($priode) || !empty($pts) || !empty($staff) || !empty($wilayah)) {
		$pecahpriode = explode(" - ", $priode);
		$_SESSION['priode1'] = $pecahpriode[0];
		$_SESSION['priode2'] = $pecahpriode[1];

		$_SESSION['pts'] = $pts;

		$_SESSION['staff'] = $staff;

		$_SESSION['wilayah'] = $wilayah;
	}

	if (empty($priode)) {
		$_SESSION['priode1'] = "";
		$_SESSION['priode2'] = "";
	}

	if (empty($pts)) {
		$_SESSION['pts'] = "";
	}

	if (empty($staff)) {
		$_SESSION['staff'] = "";
	}

	if (empty($wilayah)) {
		$_SESSION['wilayah'] = "";
	}

	echo "<script>document.location='?p=$page';</script>";
}

if (isset($_POST['brefreshksk'])) {
	if (!empty($_SESSION['priode1']) || !empty($_SESSION['priode2']) || !empty($_SESSION['pts']) || !empty($_SESSION['staff']) || !empty($_SESSION['wilayah'])) {
		$_SESSION['priode1'] = "";
		$_SESSION['priode2'] = "";

		$_SESSION['pts'] = "";

		$_SESSION['staff'] = "";

		$_SESSION['wilayah'] = "";
	}

	echo "<script>document.location='?p=$page';</script>";
}
