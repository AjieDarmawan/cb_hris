<?php

$page = $_GET['p'];
$act = $_GET['act'];
$id = $_GET['id'];
$pfm_hrd = $_GET['pfm_hrd'];


$pfm_id = $_POST['pfm_id'];
$pfm_tgl = $_POST['pfm_tgl'];
$pfm_waktu = $_POST['pfm_waktu'];
$pfm_picid = $_POST['pfm_picid'];

$pfm_pic = $_POST['pfm_pic'];
$pfm_metode = $_POST['pfm_metode'];
$pfm_unit = $_POST['pfm_unit'];
$pfm_staff = $_POST['pfm_staff'];
$pfm_topic_cat = $_POST['pfm_topic_cat'];
$pfm_knowledge = $_POST['pfm_knowledge'];
$pfm_knowledge_cat = $_POST['pfm_knowledge_cat'];
$pfm_komunikasi = $_POST['pfm_komunikasi'];
$pfm_komunikasi_cat = $_POST['pfm_komunikasi_cat'];
$pfm_closing = $_POST['pfm_closing'];
$pfm_closing_cat = $_POST['pfm_closing_cat'];
$pfm_mempengaruhi = $_POST['pfm_mempengaruhi'];
$pfm_mempengaruhi_cat = $_POST['pfm_mempengaruhi_cat'];
$pfm_lain_cat = $_POST['pfm_lain_cat'];
$pfm_arahan_cat = $_POST['pfm_arahan_cat'];
$pfm_perkembangan = $_POST['pfm_perkembangan'];
$pfm_pelatihan_cat = $_POST['pfm_pelatihan_cat'];
$pfm_crdt = date('Y-m-d H:i:s');
$pfm_mddt = date('Y-m-d H:i:s');

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
			$allowed_ext = array("jpg", "jpeg", "png", "gif");
			if (in_array($file_name[1], $allowed_ext)) {
				$new_name = "Performa_Staff_" . $pfm_picid . "_" . $pfm_tgl . "_" . $pfm_waktu . "_" . $key . '.' . $file_name[1];
				$sourcePath = $_FILES['files']['tmp_name'][$key];
				$targetPath = "module/performa_staff/files/image/" . $new_name;
				// $sql = "INSERT INTO tbl_images (id, location) VALUES (null, '{$targetPath}')";
				// $image = mysqli_query($conn, $sql);
				if (move_uploaded_file($sourcePath, $targetPath)) {
					$pfm_img_arr[$key] = $new_name;
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
	$pfm_img = $pfm_img_arr ? @json_encode($pfm_img_arr, JSON_FORCE_OBJECT) : '';

	$pfm_insert = $pfm->pfm_insert($pfm_tgl, $pfm_waktu, $pfm_picid, $pfm_pic, $pfm_metode, $pfm_unit, $pfm_staff, $pfm_topic_cat, $pfm_knowledge, $pfm_knowledge_cat, $pfm_komunikasi, $pfm_komunikasi_cat, $pfm_closing, $pfm_closing_cat, $pfm_mempengaruhi, $pfm_mempengaruhi_cat, $pfm_lain_cat, $pfm_arahan_cat, $pfm_perkembangan, $pfm_pelatihan_cat, $pfm_crdt, $pfm_img);

	if ($pfm_insert) {

		echo "<script>document.location='?p=$page';</script>";
	} else {
		echo "<script>alert('Insert Failed');document.location='?p=$page';</script>";
	}
}

if (isset($_POST['forminput']) && $_POST['forminput'] == 'put') {

	$pfm_img_arr = array();
	$pfm_img_tampil = $pfm->pfm_tampil_img($pfm_id);
	$pfm_img_data = mysql_fetch_assoc($pfm_img_tampil);
	if ($pfm_img_data['pfm_img'] != '') {
		$pfm_img_arr = @json_decode($pfm_img_data['pfm_img'], true);
	}
	// echo "<script>console.log('" . $pfm_img . "')</script>";

	if (is_array($_FILES)) {
		// print_r($_FILES['files']);
		// exit;
		foreach ($_FILES['files']['name'] as $key => $name) {
			$file_name = explode(".", $_FILES['files']['name'][$key]);
			$allowed_ext = array("jpg", "jpeg", "png", "gif");
			if (in_array($file_name[1], $allowed_ext)) {
				$new_name = "Performa_Staff_" . $pfm_picid . "_" . $pfm_tgl . "_" . $pfm_waktu . "_" . $key . '.' . $file_name[1];
				$sourcePath = $_FILES['files']['tmp_name'][$key];
				$targetPath = "module/performa_staff/files/image/" . $new_name;
				// $sql = "INSERT INTO tbl_images (id, location) VALUES (null, '{$targetPath}')";
				// $image = mysqli_query($conn, $sql);
				if (move_uploaded_file($sourcePath, $targetPath)) {
					$pfm_img_arr[$key] = $new_name;
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
	$pfm_img = $pfm_img_arr ? @json_encode($pfm_img_arr, JSON_FORCE_OBJECT) : '';
	// echo $pfm_img;
	$pfm_update = $pfm->pfm_update($pfm_id, $pfm_tgl, $pfm_waktu, $pfm_metode, $pfm_unit, $pfm_staff, $pfm_topic_cat, $pfm_knowledge, $pfm_knowledge_cat, $pfm_komunikasi, $pfm_komunikasi_cat, $pfm_closing, $pfm_closing_cat, $pfm_mempengaruhi, $pfm_mempengaruhi_cat, $pfm_lain_cat, $pfm_arahan_cat, $pfm_perkembangan, $pfm_pelatihan_cat, $pfm_crdt, $pfm_img);
	if ($pfm_update) {
		echo "<script>document.location='?p=$page';</script>";
	} else {
		echo "<script>alert('Insert Failed');document.location='?p=$page';</script>";
	}
}

if (isset($page) && ($act == "hapus")) {
	$pfm_id_ = $id;
	$pfm_delete = $pfm->pfm_delete($pfm_id_);
	echo "<script>document.location='?p=$page';</script>";
}


if (isset($page) && ($act == "konfirmhrd")) {
	$pfm_id_ = $id;
	$pfm_hrd_ = $pfm_hrd;
	$pfm_konfirmhrd = $pfm->pfm_konfirmhrd($pfm_id_, $pfm_hrd_);
	echo "<script>document.location='?p=$page';</script>";
}

if (isset($_POST['bfilterperf'])) {
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

if (isset($_POST['brefreshperf'])) {
	if (!empty($_SESSION['priode1']) || !empty($_SESSION['priode2']) || !empty($_SESSION['pts']) || !empty($_SESSION['staff']) || !empty($_SESSION['wilayah'])) {
		$_SESSION['priode1'] = "";
		$_SESSION['priode2'] = "";

		$_SESSION['pts'] = "";

		$_SESSION['staff'] = "";

		$_SESSION['wilayah'] = "";
	}

	echo "<script>document.location='?p=$page';</script>";
}
