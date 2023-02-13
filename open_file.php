<?php
///////////////////////////////////////////////////


if ($_GET['p'] == "test") {
	include "module/test/test.php";
}
if($_GET['p'] == "rekap_publikasi"){
	include "module/rekap_publikasi/rekap_publikasi_sosmed.php";
}
if ($_GET['p'] == "review_performance") {
	//include "module/review_performance/index.php";
	
}

if ($_GET['p'] == "permintaan_tenaga_kerja") {
	//////////////divisi=sdm//////////////////////
	//if ( $kar_data['div_id'] == "5" || $kar_data['kar_pvl']=="S" ) {
		include "module/permintaan_tenaga_kerja/index.php";
	//}	
	
}

if ($_GET['p'] == "pinjaman_paguyuban") {
	include "module/pinjaman_paguyuban/index.php";
}

if ($_GET['p'] == "aktivitas_karyawan") {
	include "module/kar_activity/karactivity_data.php";
}



//monitoring absen
if ($_GET['p'] == "monitoring_absen") {
	include "module/monitoring_absen/monitoring_absen_v.php";
}
if ($_GET['p'] == "cek_posisi_absen") {
	
	include "module/monitoring_absen/cek_posisi_absen.php";
}


//HRD

// echo "<pre>";
// print_r($_GET['p']);
// die;

if ($_GET['p'] == "hrd") {
	include "module/hrd/pelamar_v.php";
}elseif($_GET['p'] == "form-pelamar"){
	include "module/hrd/form_pelamar.php";
}
elseif($_GET['p'] == "act_pelamar"){
	include "module/hrd/act_pelamar.php";
}
elseif($_GET['p'] == "act_ajax_status"){
	include "module/hrd/act_ajax_status.php";
}
elseif($_GET['p'] == "pelamar_interview"){
	include "module/hrd/pelamar_interview/pelamar_interview_v.php";
}
elseif($_GET['p'] == "pelamar_interview_proses"){
	include "module/hrd/pelamar_interview/form_interview_satu.php";
}

elseif($_GET['p'] == "pelamar_interview_user"){
	include "module/hrd/pelamar_interview/pelamar_interview_user_v.php";
}

elseif($_GET['p'] == "pelamar_interview_user_proses"){
	include "module/hrd/pelamar_interview/form_interview_dua.php";
}

elseif($_GET['p'] == "pelamar_offering"){
	include "module/hrd/pelamar_offering/pelamar_offering_v.php";
}

elseif($_GET['p'] == "pelamar_form_karyawan"){
	include "module/hrd/pelamar_interview/form_permintaan_kar.php";
}




elseif($_GET['p'] == "monitoring_karyawan_absen"){
	include "module/hrd/monitoring_karyawan_absen/monitoring_karyawan_absen_v.php";
}


elseif($_GET['p'] == "publikasi_loker"){
	include "module/hrd/publikasi_loker/publikasi_loker_v.php";
}

elseif($_GET['p'] == "publikasi_iklan"){
	include "module/hrd/publikasi_iklan/publikasi_iklan_v.php";
}

elseif($_GET['p'] == "form-publikasi-iklan"){
	include "module/hrd/publikasi_iklan/form_publikasi_iklan.php";
}

elseif($_GET['p'] == "form-publikasi-loker"){
	include "module/hrd/publikasi_loker/form_publikasi_loker.php";
}


elseif($_GET['p'] == "pembinaan_coaching"){
	include "module/hrd/pembinaan_coaching/pembinaan_coaching_v.php";
}



elseif($_GET['p'] == "form-pembinaan-coaching"){
	include "module/hrd/pembinaan_coaching/form_pembinaan_coaching.php";
}

elseif($_GET['p'] == "form_persetujuan_acc_kar"){


	include "module/hrd/form_persetujuan_acc_kar/form_persetujuan_acc_kar_v.php";
}

elseif($_GET['p'] == "pelamar_form_karyawan_acc"){

	
	include "module/hrd/form_persetujuan_acc_kar/form_tampilan_acc_kar.php";
}

elseif($_GET['p'] == "print_form_acc"){

	
	include "print_form_acc.php";
}
























/* TEST ROKI */
if (($kar_data['kar_id'] == "459" || $kar_data['kar_id'] == "255" || $kar_data['div_id'] == "3")) {
	if ($_GET['p'] == "aktivitas_karyawan") {
		// include "module/kar_activity/karactivity_data.php";
	} elseif ($_GET['p'] == "report_aktivitas_karyawan") {
		include "module/kar_activity_report/karactivityreport_data.php";
	} else {
		//include "not_found.php";
	}
}
		

////////////////////////////////////////////////////
if (($kar_data['kar_pvl'] == "A")) {
 
	if ($_GET['p'] == "data_karyawan") {
		include "module/karyawan/kar_data.php";
	} elseif ($_GET['p'] == "detail_karyawan") {
		include "module/karyawan/kar_detail.php";
	} elseif ($_GET['p'] == "history_absen") {
		include "module/absen/abs_history.php";
	} elseif ($_GET['p'] == "history_absen_magang") {
		include "module/absen/abs_history_magang.php";
	} elseif ($_GET['p'] == "detail_absen") {
		include "module/absen/abs_detail.php";
	} elseif ($_GET['p'] == "report_absen") {
		include "module/absen/abs_rpt.php";
	} elseif ($_GET['p'] == "data_headline") {
		include "module/headline/hed_data.php";
	} elseif ($_GET['p'] == "detail_headline") {
		include "module/headline/hed_detail.php";
	} elseif ($_GET['p'] == "data_account") {
		if (($kar_data['kar_id'] == "37") ||
			($kar_data['kar_id'] == "21") ||
			($kar_data['kar_id'] == "383") ||
			($kar_data['kar_id'] == "453") ||
			($kar_data['kar_id'] == "248") ||
			($kar_data['kar_id'] == "551") ||
			($kar_data['kar_id'] == "542") ||
			($kar_data['kar_id'] == "447") ||
			($kar_data['kar_id'] == "255") 
		) {
			include "module/account/acc_data.php";
		} else {
			include "not_found.php";
		}		
	} elseif ($_GET['p'] == "data_profile") {
		include "module/profile/pro_data.php";
	} elseif ($_GET['p'] == "data_archive") {
		include "module/archive/acv_data.php";
	} elseif ($_GET['p'] == "detail_archive") {
		include "module/archive/acv_detail.php";
	} elseif ($_GET['p'] == "data_mailbox") {
		include "module/mailbox/mlb_data.php";
	} elseif ($_GET['p'] == "detail_mailbox") {
		include "module/mailbox/mlb_detail.php";
	} elseif ($_GET['p'] == "data_penjadwalan") {
		include "module/penjadwalan/jwd_data.php";
	} elseif ($_GET['p'] == "monitoring_location") {
		include "module/location/loc_data.php";
	} elseif ($_GET['p'] == "asset_request") {
		include "module/request/req_form.php";
	} elseif ($_GET['p'] == "pengajuan_request") {
		include "module/request/req_pengajuan.php";
	} elseif ($_GET['p'] == "data_request") {
		include "module/request/req_data.php";
	} elseif ($_GET['p'] == "list_asset") {
		include "module/asset/ast_list.php";
	} elseif ($_GET['p'] == "management_asset") {
		include "module/asset/ast_management.php";
	} elseif ($_GET['p'] == "detail_asset") {
		include "module/asset/ast_detail.php";
	} elseif ($_GET['p'] == "pengajuan_detail") {
		include "module/request/req_pengajuan_detail.php";
	} elseif ($_GET['p'] == "bio_karyawan") {
		include "module/karyawan/kar_bio.php";
	} elseif ($_GET['p'] == "biodata") {
		include "module/biodata/bio_data.php";
	} elseif ($_GET['p'] == "bio") {
		include "module/biodata/bio_bio.php";
	} elseif ($_GET['p'] == "kendaraan") {
		include "module/biodata/bio_kendaraan.php";
	} elseif ($_GET['p'] == "dokumen_pribadi") {
		include "module/biodata/bio_dokumen_pribadi.php";
	} elseif ($_GET['p'] == "kartu_kredit") {
		include "module/biodata/bio_kartu_kredit.php";
	} elseif ($_GET['p'] == "riwayat_penyakit") {
		include "module/biodata/bio_penyakit.php";
	} elseif ($_GET['p'] == "hobi") {
		include "module/biodata/bio_hobi.php";
	} elseif ($_GET['p'] == "pendidikan_formal") {
		include "module/biodata/bio_pendidikan.php";
	} elseif ($_GET['p'] == "tempat_tinggal") {
		include "module/biodata/bio_tempat_tinggal.php";
	} elseif ($_GET['p'] == "kemampuan_diri") {
		include "module/biodata/bio_kemampuan_diri.php";
	} elseif ($_GET['p'] == "pengembangan_diri") {
		include "module/biodata/bio_pengembangan_diri.php";
	} elseif ($_GET['p'] == "cita_-_cita") {
		include "module/biodata/bio_cita_cita.php";
	} elseif ($_GET['p'] == "harapan") {
		include "module/biodata/bio_harapan.php";
	} elseif ($_GET['p'] == "kredit") {
		include "module/biodata/bio_kredit.php";
	} elseif ($_GET['p'] == "khursus") {
		include "module/biodata/bio_khursus.php";
	} elseif ($_GET['p'] == "kerabat") {
		include "module/biodata/bio_kerabat.php";
	} elseif ($_GET['p'] == "pekerjaan") {
		include "module/biodata/bio_pekerjaan.php";
	} elseif ($_GET['p'] == "riwayat_pekerjaan") {
		include "module/biodata/bio_riwayat_pekerjaan.php";
	} elseif ($_GET['p'] == "riwayat_gg") {
		include "module/biodata/bio_riwayat_gg.php";
	} elseif ($_GET['p'] == "orang_tua") {
		include "module/biodata/bio_orang_tua.php";
	} elseif ($_GET['p'] == "keluarga") {
		include "module/biodata/bio_keluarga.php";
	} elseif ($_GET['p'] == "saudara") {
		include "module/biodata/bio_saudara.php";
	} elseif ($_GET['p'] == "pasangan_hidup") {
		include "module/biodata/bio_pasangan_hidup.php";
	} elseif ($_GET['p'] == "anak") {
		include "module/biodata/bio_anak.php";
	} elseif ($_GET['p'] == "detail_anak") {
		include "module/biodata/bio_detail_anak.php";
	} elseif ($_GET['p'] == "biodata_pasangan_hidup") {
		include "module/biodata/bio_bio_pasangan_hidup.php";
	} elseif ($_GET['p'] == "orang_tua_pasangan_hidup") {
		include "module/biodata/bio_orang_tua_pasangan_hidup.php";
	} elseif ($_GET['p'] == "pendidikan_formal_pasangan_hidup") {
		include "module/biodata/bio_pendidikan_pasangan_hidup.php";
	} elseif ($_GET['p'] == "riwayat_penyakit_pasangan_hidup") {
		include "module/biodata/bio_riwayat_penyakit_pasangan_hidup.php";
	} elseif ($_GET['p'] == "riwayat_pekerjaan_pasangan_hidup") {
		include "module/biodata/bio_riwayat_pekerjaan_pasangan_hidup.php";
	} elseif ($_GET['p'] == "data_penggajian") {
		include "module/penggajian/gji_data.php";
	} elseif ($_GET['p'] == "data_penilaian") {
		if (($kar_data['kar_id'] == "248") ||
			($kar_data['kar_id'] == "13") ||
			($kar_data['kar_id'] == "430") ||
			($kar_data['kar_id'] == "453") ||
			($kar_data['kar_id'] == "447") ||
			($kar_data['kar_id'] == "499") ||
			($kar_data['kar_id'] == "551") ||
			($kar_data['kar_id'] == "542") ||
			($kar_data['kar_id'] == "535") ||
			($kar_data['kar_id'] == "383") ||
			($kar_data['kar_id'] == "63") ||
			($kar_data['kar_id'] == "37")
		) {
			include "module/penilaian/nla_data.php";
		} else {
			include "not_found.php";
		}
	} elseif ($_GET['p'] == "detail_penilaian") {
		include "module/penilaian/nla_detail.php";
	} elseif ($_GET['p'] == "lihat_penilaian") {
		include "module/penilaian/nla_lihat3.php";
	} elseif ($_GET['p'] == "hasil_penilaian") {
		if (($kar_data['kar_id'] == "248") ||
			($kar_data['kar_id'] == "13") ||
			($kar_data['kar_id'] == "430") ||
			($kar_data['kar_id'] == "453") ||
			($kar_data['kar_id'] == "447") ||
			($kar_data['kar_id'] == "499") ||
			($kar_data['kar_id'] == "551") ||
			($kar_data['kar_id'] == "542") ||
			($kar_data['kar_id'] == "535") ||
			($kar_data['kar_id'] == "383") ||
			($kar_data['kar_id'] == "63") ||
			($kar_data['kar_id'] == "37")
		) {
			include "module/penilaian/nla_hasil.php";
		} else {
			include "not_found.php";
		}
	} elseif ($_GET['p'] == "hasil_penilaian2") {
		if (($kar_data['kar_id'] == "248") ||
			($kar_data['kar_id'] == "13") ||
			($kar_data['kar_id'] == "430") ||
			($kar_data['kar_id'] == "453") ||
			($kar_data['kar_id'] == "447") ||
			($kar_data['kar_id'] == "499") ||
			($kar_data['kar_id'] == "551") ||
			($kar_data['kar_id'] == "542") ||
			($kar_data['kar_id'] == "535") ||
			($kar_data['kar_id'] == "383") ||
			($kar_data['kar_id'] == "63") ||
			($kar_data['kar_id'] == "37")
		) {
			include "module/penilaian/nla_hasil2.php";
		} else {
			include "not_found.php";
		}
	} elseif ($_GET['p'] == "data_notifikasi") {
		include "module/notify/ntf_data.php";
	} elseif ($_GET['p'] == "form_penilaian") {
		if (($kar_data['kar_id'] == "248") ||
			($kar_data['kar_id'] == "13") ||
			($kar_data['kar_id'] == "430") ||
			($kar_data['kar_id'] == "453") ||
			($kar_data['kar_id'] == "447") ||
			($kar_data['kar_id'] == "499") ||
			($kar_data['kar_id'] == "551") ||
			($kar_data['kar_id'] == "542") ||
			($kar_data['kar_id'] == "535") ||
			($kar_data['kar_id'] == "383") ||
			($kar_data['kar_id'] == "63") ||
			($kar_data['kar_id'] == "37")
		) {
			include "module/penilaian/nla_form.php";
		} else {
			include "not_found.php";
		}
	} elseif ($_GET['p'] == "lihat_notifikasi") {
		include "module/notify/ntf_lihat.php";
	} elseif ($_GET['p'] == "report_penilaian") {
		include "module/penilaian/nla_report.php";
	} elseif ($_GET['p'] == "konfirm_penilaian") {
		include "module/penilaian/nla_konfirm.php";
	} elseif ($_GET['p'] == "data_kwitansi") {

		if (($kar_data['kar_id'] == "17") ||
			($kar_data['kar_id'] == "24") ||
			($kar_data['kar_id'] == "69") ||
			($kar_data['kar_id'] == "248") ||
			($kar_data['kar_id'] == "255") ||
			($kar_data['kar_id'] == "534") ||
			($kar_data['kar_id'] == "410") ||
			($kar_data['kar_id'] == "421")
		) {
			include "module/kwitansi/kwi_data.php";
		} else {
			include "not_found.php";
		}
	} elseif ($_GET['p'] == "data_nota") {

		if (($kar_data['kar_id'] == "24") ||
			($kar_data['kar_id'] == "69") ||
			($kar_data['kar_id'] == "273") ||
			($kar_data['kar_id'] == "248") ||
			($kar_data['kar_id'] == "255") ||
			($kar_data['kar_id'] == "410") ||
			($kar_data['kar_id'] == "534") ||
			($kar_data['kar_id'] == "421")
		) {
			include "module/nota/nta_data.php";
		} else {
			include "not_found.php";
		}
	} elseif ($_GET['p'] == "unlist_domain") {
		include "module/unlistdomain/udo_data.php";
	} elseif ($_GET['p'] == "jadwal_online") {
		include "module/jadwal_online/jwo_data.php";
	} elseif ($_GET['p'] == "jadwal") {
		include "module/jadwal/jdw_data.php";
	} elseif ($_GET['p'] == "jadwal_mei2022") {
		include "module/jadwal_mei2022/jdw_data.php";
	} elseif ($_GET['p'] == "review_performance") {
		if (($kar_data['kar_id'] == "248") ||
			($kar_data['kar_id'] == "13") ||
			($kar_data['kar_id'] == "430") ||
			($kar_data['kar_id'] == "453") ||
			($kar_data['kar_id'] == "447") ||
			($kar_data['kar_id'] == "551") ||
			($kar_data['kar_id'] == "542") ||
			($kar_data['kar_id'] == "476") ||
			($kar_data['kar_id'] == "499") ||
			($kar_data['kar_id'] == "535") ||
			($kar_data['kar_id'] == "383") ||
			($kar_data['kar_id'] == "37")
		) {
			include "module/review_performance/index.php";
		} else {
			include "not_found.php";
		}		
	} elseif ($_GET['p'] == "data_kpi") {
		if (($kar_data['kar_id'] == "248") ||
			($kar_data['kar_id'] == "13") ||
			($kar_data['kar_id'] == "430") ||
			($kar_data['kar_id'] == "453") ||
			($kar_data['kar_id'] == "447") ||
			($kar_data['kar_id'] == "551") ||
			($kar_data['kar_id'] == "542") ||
			($kar_data['kar_id'] == "476") ||
			($kar_data['kar_id'] == "535") ||
			($kar_data['kar_id'] == "383") ||
			($kar_data['kar_id'] == "37")
		) {
			include "module/kpi/kpi_data.php";
			//echo "Sedang Dalam Perbaikan Module";
		} else {
			include "not_found.php";
		}
	} elseif ($_GET['p'] == "penilai1_kpi") {
		include "module/kpi/kpi_penilai1.php";
	} elseif ($_GET['p'] == "penilai2_kpi") {
		include "module/kpi/kpi_penilai2.php";
	} elseif ($_GET['p'] == "penilai3_kpi") {
		include "module/kpi/kpi_penilai3.php";
	} elseif ($_GET['p'] == "penilai4_kpi") {
		include "module/kpi/kpi_penilai4.php";
	} elseif ($_GET['p'] == "berkas_kpi") {
		include "module/kpi/kpi_berkas.php";
	} elseif ($_GET['p'] == "data_reward") {
		include "module/reward/rwd_data.php";
	} elseif ($_GET['p'] == "data_reward_cs") {
		include "module/reward_cs/rwd_data.php";
	} elseif ($_GET['p'] == "data_karyawan_fl") {
		include "module/freelance/fl_data.php";
	} elseif ($_GET['p'] == "detail_karyawan_fl") {
		include "module/freelance/fl_detail.php";
	} elseif ($_GET['p'] == "data_account_fl") {
		include "module/account_fl/acc_data_fl.php";
	} elseif ($_GET['p'] == "data_bank") {
		include "module/data_bank/bnk_data.php";
	}

	/* KASBON */ elseif ($_GET['p'] == "pengajuan_kasbon") {
		include "module/kasbon_request/ksbn_data.php";
	} elseif ($_GET['p'] == "approval_kasbon") {
		include "module/kasbon_approve/ksbn_data.php";
	} elseif ($_GET['p'] == "pembayaran_kasbon") {
		include "module/kasbon_payment/ksbn_data.php";
	}
	/* END KASBON */ elseif ($_GET['p'] == "shift_absen") {
		include "module/absen/abs_shift.php";
	} elseif ($_GET['p'] == "daily_activity") {
		include "module/work_from_home/wfh_data.php";
	} elseif ($_GET['p'] == "daily_activity_report") {
		include "module/work_from_home/wfh_report.php";
	} elseif ($_GET['p'] == "daily_activity_summary") {
		include "module/wfh_activity/wfh_data.php";
	} elseif ($_GET['p'] == "menanam_activity") {
		include "module/menanam_activity/menanam_data.php";
	} elseif ($_GET['p'] == "klaim_pencapaian") {
		include "module/klaim_pencapaian/klaim_data.php";
	} elseif ($_GET['p'] == "klaim_closing") {
		include "module/klaim_closing/klaim_data.php";
	} elseif ($_GET['p'] == "klaim_marketing_support") {
		include "module/klaim_closing_ms/ms_klaim_data.php";
	} elseif ($_GET['p'] == "data_reward_alih_fungsi") {
		include "module/reward_karyawan/rwd_data.php";
	} elseif ($_GET['p'] == "data_reward_marketing_support") {
		include "module/reward_ms/rwd_data.php";
	} elseif ($_GET['p'] == "absen_menanam") {
		include "module/absen_menanam/abm_data.php";
	}

	/* MUTASI-DEMOSI KARYAWAN */ elseif ($_GET['p'] == "data_mutasi") {
		if (($kar_data['kar_id'] == "248") ||
			($kar_data['kar_id'] == "13") ||
			($kar_data['kar_id'] == "430") ||
			($kar_data['kar_id'] == "453") ||
			($kar_data['kar_id'] == "447") ||
			($kar_data['kar_id'] == "499") ||
			($kar_data['kar_id'] == "551") ||
			($kar_data['kar_id'] == "542") ||
			($kar_data['kar_id'] == "535") ||
			($kar_data['kar_id'] == "383") ||
			($kar_data['kar_id'] == "37")
		) {
			include "module/mutasi/mts_data.php";
		} else {
			include "not_found.php";
		}
	} elseif ($_GET['p'] == "form_mutasi") {
		if (($kar_data['kar_id'] == "248") ||
			($kar_data['kar_id'] == "13") ||
			($kar_data['kar_id'] == "430") ||
			($kar_data['kar_id'] == "453") ||
			($kar_data['kar_id'] == "447") ||
			($kar_data['kar_id'] == "499") ||
			($kar_data['kar_id'] == "542") ||
			($kar_data['kar_id'] == "535") ||
			($kar_data['kar_id'] == "551") ||
			($kar_data['kar_id'] == "383") ||
			($kar_data['kar_id'] == "37")
		) {
			include "module/mutasi/mts_form.php";
		} else {
			include "not_found.php";
		}
	} elseif ($_GET['p'] == "konfirm_mutasi") {
		include "module/mutasi/mts_konfirm.php";
	} elseif ($_GET['p'] == "detail_mutasi") {
		include "module/mutasi/mts_detail.php";
	} elseif ($_GET['p'] == "hasil_mutasi") {
		if (($kar_data['kar_id'] == "248") ||
			($kar_data['kar_id'] == "13") ||
			($kar_data['kar_id'] == "430") ||
			($kar_data['kar_id'] == "453") ||
			($kar_data['kar_id'] == "447") ||
			($kar_data['kar_id'] == "499") ||
			($kar_data['kar_id'] == "551") ||
			($kar_data['kar_id'] == "542") ||
			($kar_data['kar_id'] == "535") ||
			($kar_data['kar_id'] == "383") ||
			($kar_data['kar_id'] == "37")
		) {
			include "module/mutasi/mts_hasil.php";
		} else {
			include "not_found.php";
		}
	} elseif ($_GET['p'] == "hasil_mutasi2") {
		if (($kar_data['kar_id'] == "248") ||
			($kar_data['kar_id'] == "13") ||
			($kar_data['kar_id'] == "430") ||
			($kar_data['kar_id'] == "453") ||
			($kar_data['kar_id'] == "447") ||
			($kar_data['kar_id'] == "499") ||
			($kar_data['kar_id'] == "551") ||
			($kar_data['kar_id'] == "542") ||
			($kar_data['kar_id'] == "535") ||
			($kar_data['kar_id'] == "383") ||
			($kar_data['kar_id'] == "37")
		) {
			include "module/mutasi/mts_hasil2.php";
		} else {
			include "not_found.php";
		}
	}
	/* END MUTASI */ elseif ($_GET['p'] == "data_coaching") {
		if (($kar_data['kar_id'] == "248") ||
			($kar_data['kar_id'] == "13") ||
			($kar_data['kar_id'] == "430") ||
			($kar_data['kar_id'] == "453") ||
			($kar_data['kar_id'] == "447") ||
			($kar_data['kar_id'] == "499") ||
			($kar_data['kar_id'] == "551") ||
			($kar_data['kar_id'] == "542") ||
			($kar_data['kar_id'] == "535") ||
			($kar_data['kar_id'] == "383") ||
			($kar_data['kar_id'] == "37")
		) {
			include "module/coaching/coa_data.php";
		} else {
			include "not_found.php";
		}
	}elseif ($_GET['p'] == "data_ip") {
	   if ($kar_data['kar_id'] == "447"){
		 include "module/ip/ip_data.php";
	   }else{
		 include "not_found.php";
	   }
	}elseif ($_GET['p'] == "detail_ip") {
	   if ($kar_data['kar_id'] == "447"){
		 include "module/ip/ip_detail.php";
	   }else{
		 include "not_found.php";
	   }
	}elseif ($_GET['p'] == "data_marketing_support") {
		include "module/marketing_support/ms_data.php";
	} elseif ($_GET['p'] == "detail_marketing_support") {
		include "module/marketing_support/ms_detail.php";
	} elseif ($_GET['p'] == "salary") {
		include "module/salary/salary_data.php";
	} elseif ($_GET['p'] == "cuti") {
		include "module/data-cuti/cuti.php";
	} elseif ($_GET['p'] == "form-cuti") {
		include "module/data-cuti/form-cuti.php";
	} elseif ($_GET['p'] == "form-cuti-acc") {
		include "module/data-cuti/form-cuti-acc.php";
	} elseif ($_GET['p'] == "form-cuti-print") {
		include "module/data-cuti/form-cuti-print.php";
	} elseif ($_GET['p'] == "cuti_notifikasi") {
		include "module/data-cuti/ntf_data.php";
	} elseif ($_GET['p'] == "cuti_notifikasi_all") {
		include "module/data-cuti/ntf_data_all.php";
	} elseif ($_GET['p'] == "kasbon_data_barang") {
		include "module/kasbon_databarang/databarang.php"; 
	} elseif ($_GET['p'] == "pengajuan_kasbon_unit") {
		include "module/kasbon_pengajuan_coba/data.php";
	} elseif ($_GET['p'] == "approval_kasbon_unit") {
		include "module/kasbon_approve_coba/ksbn_data.php";
	} elseif ($_GET['p'] == "data_po_marketing_support") {
		include "module/po_marketing_support/marketing_data.php";
	} elseif ($_GET['p'] == "account_marketing_support") {
		include "module/account_ms/acc_data.php";
	} elseif ($_GET['p'] == "grade_pencapaian") {
		include "module/grade_pencapaian/grd_data.php";
	} elseif ($_GET['p'] == "pemotongan_gaji") {
		include "module/pemotongan_gaji/ptg_data.php";
	}
	/*elseif($_GET['p']=="link_group_wa"){
		include"module/link_group_wa/wa_data.php";
	}*/ elseif ($_GET['p'] == "new_reward") {
		include "module/new_reward/nrw_data.php";
	} elseif ($_GET['p'] == "new_reward_cs") {
		include "module/new_reward_cs/nrw_data.php";
	} elseif ($_GET['p'] == "performa_staff") {
		include "module/performa_staff/pfm_data.php";
	} elseif ($_GET['p'] == "kondisi_sekretariat") {
		include "module/kondisi_sekretariat/ksk_data.php";
	} elseif ($_GET['p'] == "rekam_jejak") {
		include "module/rekam_jejak/rkm_data.php";
	} elseif ($_GET['p'] == "history_check_position") {
		include "module/absen/abs_checkpoint.php";
	} elseif ($_GET['p'] == "detail_maps") {
		include "module/absen/map_detail.php";
	} elseif ($_GET['p'] == "data_izin") {
		include "module/izin/izn_data.php";
	} elseif ($_GET['p'] == "berkas_izin") {
		include "module/izin/izn_berkas.php";
	} elseif ($_GET['p'] == "berkas_izin_lihat") {
		include "module/izin/izn_lht_berkas.php";
	} elseif ($_GET['p'] == "history_izin") {
		include "module/izin/izn_lht_all.php";
	} else {
		include "not_found.php";
	}
}

////////////////////////////////////////////////////
if (($kar_data['kar_pvl'] == "S")) {
	if ($_GET['p'] == "data_karyawan") {
		include "module/karyawan/kar_data.php";
	} elseif ($_GET['p'] == "detail_karyawan") {
		include "module/karyawan/kar_detail.php";
	} elseif ($_GET['p'] == "history_absen") {
		include "module/absen/abs_history.php";
	} elseif ($_GET['p'] == "history_absen_magang") {
		include "module/absen/abs_history_magang.php";
	} elseif ($_GET['p'] == "detail_absen") {
		include "module/absen/abs_detail.php";
	} elseif ($_GET['p'] == "report_absen") {
		include "module/absen/abs_rpt.php";
	} elseif ($_GET['p'] == "settime_absen") {
		include "module/absen/abs_settime.php";
	} elseif ($_GET['p'] == "data_headline") {
		include "module/headline/hed_data.php";
	} elseif ($_GET['p'] == "detail_headline") {
		include "module/headline/hed_detail.php";
	} elseif ($_GET['p'] == "data_ip") {
		include "module/ip/ip_data.php";
	} elseif ($_GET['p'] == "detail_ip") {
		include "module/ip/ip_detail.php";
	} elseif ($_GET['p'] == "data_privilege") {
		include "module/privilege/pvl_data.php";
	} elseif ($_GET['p'] == "data_account") {		
		if (($kar_data['kar_id'] == "37") ||
			($kar_data['kar_id'] == "21") ||
			($kar_data['kar_id'] == "383") ||
			($kar_data['kar_id'] == "453") ||
			($kar_data['kar_id'] == "248") ||
			($kar_data['kar_id'] == "551") ||
			($kar_data['kar_id'] == "255") 
		) {
			include "module/account/acc_data.php";
		} else {
			include "not_found.php";
		}
	} elseif ($_GET['p'] == "data_profile") {
		include "module/profile/pro_data.php";
	} elseif ($_GET['p'] == "data_archive") {
		include "module/archive/acv_data.php";
	} elseif ($_GET['p'] == "detail_archive") {
		include "module/archive/acv_detail.php";
	} elseif ($_GET['p'] == "data_posting") {
		include "module/post/pos_data.php";
	} elseif ($_GET['p'] == "detail_posting") {
		include "module/post/pos_detail.php";
	} elseif ($_GET['p'] == "data_mailbox") {
		include "module/mailbox/mlb_data.php";
	} elseif ($_GET['p'] == "detail_mailbox") {
		include "module/mailbox/mlb_detail.php";
	} elseif ($_GET['p'] == "data_penjadwalan") {
		include "module/penjadwalan/jwd_data.php";
	} elseif ($_GET['p'] == "monitoring_location") {
		include "module/location/loc_data.php";
	} elseif ($_GET['p'] == "monitoring_karyawan") {
		include "module/notify/ntf_master.php";
	} elseif ($_GET['p'] == "asset_request") {
		include "module/request/req_form.php";
	} elseif ($_GET['p'] == "pengajuan_request") {
		include "module/request/req_pengajuan.php";
	} elseif ($_GET['p'] == "data_request") {
		include "module/request/req_data.php";
	} elseif ($_GET['p'] == "list_asset") {
		include "module/asset/ast_list.php";
	} elseif ($_GET['p'] == "management_asset") {
		include "module/asset/ast_management.php";
	} elseif ($_GET['p'] == "detail_asset") {
		include "module/asset/ast_detail.php";
	} elseif ($_GET['p'] == "pengajuan_detail") {
		include "module/request/req_pengajuan_detail.php";
	} elseif ($_GET['p'] == "bio_karyawan") {
		include "module/karyawan/kar_bio.php";
	} elseif ($_GET['p'] == "biodata") {
		include "module/biodata/bio_data.php";
	} elseif ($_GET['p'] == "bio") {
		include "module/biodata/bio_bio.php";
	} elseif ($_GET['p'] == "kendaraan") {
		include "module/biodata/bio_kendaraan.php";
	} elseif ($_GET['p'] == "dokumen_pribadi") {
		include "module/biodata/bio_dokumen_pribadi.php";
	} elseif ($_GET['p'] == "kartu_kredit") {
		include "module/biodata/bio_kartu_kredit.php";
	} elseif ($_GET['p'] == "riwayat_penyakit") {
		include "module/biodata/bio_penyakit.php";
	} elseif ($_GET['p'] == "hobi") {
		include "module/biodata/bio_hobi.php";
	} elseif ($_GET['p'] == "pendidikan_formal") {
		include "module/biodata/bio_pendidikan.php";
	} elseif ($_GET['p'] == "tempat_tinggal") {
		include "module/biodata/bio_tempat_tinggal.php";
	} elseif ($_GET['p'] == "kemampuan_diri") {
		include "module/biodata/bio_kemampuan_diri.php";
	} elseif ($_GET['p'] == "pengembangan_diri") {
		include "module/biodata/bio_pengembangan_diri.php";
	} elseif ($_GET['p'] == "cita_-_cita") {
		include "module/biodata/bio_cita_cita.php";
	} elseif ($_GET['p'] == "harapan") {
		include "module/biodata/bio_harapan.php";
	} elseif ($_GET['p'] == "kredit") {
		include "module/biodata/bio_kredit.php";
	} elseif ($_GET['p'] == "khursus") {
		include "module/biodata/bio_khursus.php";
	} elseif ($_GET['p'] == "kerabat") {
		include "module/biodata/bio_kerabat.php";
	} elseif ($_GET['p'] == "pekerjaan") {
		include "module/biodata/bio_pekerjaan.php";
	} elseif ($_GET['p'] == "riwayat_pekerjaan") {
		include "module/biodata/bio_riwayat_pekerjaan.php";
	} elseif ($_GET['p'] == "riwayat_gg") {
		include "module/biodata/bio_riwayat_gg.php";
	} elseif ($_GET['p'] == "orang_tua") {
		include "module/biodata/bio_orang_tua.php";
	} elseif ($_GET['p'] == "keluarga") {
		include "module/biodata/bio_keluarga.php";
	} elseif ($_GET['p'] == "saudara") {
		include "module/biodata/bio_saudara.php";
	} elseif ($_GET['p'] == "pasangan_hidup") {
		include "module/biodata/bio_pasangan_hidup.php";
	} elseif ($_GET['p'] == "anak") {
		include "module/biodata/bio_anak.php";
	} elseif ($_GET['p'] == "detail_anak") {
		include "module/biodata/bio_detail_anak.php";
	} elseif ($_GET['p'] == "biodata_pasangan_hidup") {
		include "module/biodata/bio_bio_pasangan_hidup.php";
	} elseif ($_GET['p'] == "orang_tua_pasangan_hidup") {
		include "module/biodata/bio_orang_tua_pasangan_hidup.php";
	} elseif ($_GET['p'] == "pendidikan_formal_pasangan_hidup") {
		include "module/biodata/bio_pendidikan_pasangan_hidup.php";
	} elseif ($_GET['p'] == "riwayat_penyakit_pasangan_hidup") {
		include "module/biodata/bio_riwayat_penyakit_pasangan_hidup.php";
	} elseif ($_GET['p'] == "riwayat_pekerjaan_pasangan_hidup") {
		include "module/biodata/bio_riwayat_pekerjaan_pasangan_hidup.php";
	} elseif ($_GET['p'] == "data_penggajian") {
		include "module/penggajian/gji_data.php";
	} elseif ($_GET['p'] == "data_penilaian") {
		include "module/penilaian/nla_data.php";
	} elseif ($_GET['p'] == "detail_penilaian") {
		include "module/penilaian/nla_detail.php";
	} elseif ($_GET['p'] == "lihat_penilaian") {
		include "module/penilaian/nla_lihat3.php";
	} elseif ($_GET['p'] == "hasil_penilaian") {
		include "module/penilaian/nla_hasil.php";
	} elseif ($_GET['p'] == "hasil_penilaian2") {
		include "module/penilaian/nla_hasil2.php";
	} elseif ($_GET['p'] == "data_notifikasi") {
		include "module/notify/ntf_data.php";
	} elseif ($_GET['p'] == "form_penilaian") {
		include "module/penilaian/nla_form.php";
	} elseif ($_GET['p'] == "lihat_notifikasi") {
		include "module/notify/ntf_lihat.php";
	} elseif ($_GET['p'] == "report_penilaian") {
		include "module/penilaian/nla_report.php";
	} elseif ($_GET['p'] == "konfirm_penilaian") {
		include "module/penilaian/nla_konfirm.php";
	} elseif ($_GET['p'] == "data_kwitansi") {

		if (($kar_data['kar_id'] == "17") ||
			($kar_data['kar_id'] == "24") ||
			($kar_data['kar_id'] == "69") ||
			($kar_data['kar_id'] == "248") ||
			($kar_data['kar_id'] == "255")
		) {
			include "module/kwitansi/kwi_data.php";
		} else {
			include "not_found.php";
		}
	} elseif ($_GET['p'] == "data_nota") {

		if (($kar_data['kar_id'] == "24") ||
			($kar_data['kar_id'] == "69") ||
			($kar_data['kar_id'] == "273") ||
			($kar_data['kar_id'] == "248") ||
			($kar_data['kar_id'] == "255")
		) {
			include "module/nota/nta_data.php";
		} else {
			include "not_found.php";
		}
	} elseif ($_GET['p'] == "unlist_domain") {
		include "module/unlistdomain/udo_data.php";
	} elseif ($_GET['p'] == "jadwal_online") {
		include "module/jadwal_online/jwo_data.php";
	} elseif ($_GET['p'] == "jadwal") {
		include "module/jadwal/jdw_data.php";
	} elseif ($_GET['p'] == "jadwal_mei2022") {
		include "module/jadwal_mei2022/jdw_data.php";
	} elseif ($_GET['p'] == "review_performance") {
		include "module/review_performance/index.php";		
	} elseif ($_GET['p'] == "data_kpi") {
		include "module/kpi/kpi_data.php";
		//echo "Sedang Dalam Perbaikan Module";
	} elseif ($_GET['p'] == "penilai1_kpi") {
		include "module/kpi/kpi_penilai1.php";
	} elseif ($_GET['p'] == "penilai2_kpi") {
		include "module/kpi/kpi_penilai2.php";
	} elseif ($_GET['p'] == "penilai3_kpi") {
		include "module/kpi/kpi_penilai3.php";
	} elseif ($_GET['p'] == "penilai4_kpi") {
		include "module/kpi/kpi_penilai4.php";
	} elseif ($_GET['p'] == "berkas_kpi") {
		include "module/kpi/kpi_berkas.php";
	} elseif ($_GET['p'] == "data_reward") {
		include "module/reward/rwd_data.php";
	} elseif ($_GET['p'] == "data_reward_cs") {
		include "module/reward_cs/rwd_data.php";
	}



	/* KASBON */ elseif ($_GET['p'] == "pengajuan_kasbon") {
		include "module/kasbon_request/ksbn_data.php";
	} elseif ($_GET['p'] == "approval_kasbon") {
		include "module/kasbon_approve/ksbn_data.php";
	} elseif ($_GET['p'] == "pembayaran_kasbon") {
		include "module/kasbon_payment/ksbn_data.php";
	}
	/* END KASBON */ elseif ($_GET['p'] == "data_karyawan_fl") {
		include "module/freelance/fl_data.php";
	} elseif ($_GET['p'] == "detail_karyawan_fl") {
		include "module/freelance/fl_detail.php";
	} elseif ($_GET['p'] == "data_account_fl") {
		include "module/account_fl/acc_data_fl.php";
	} elseif ($_GET['p'] == "data_bank") {
		include "module/data_bank/bnk_data.php";
	} elseif ($_GET['p'] == "shift_absen") {
		include "module/absen/abs_shift.php";
	} elseif ($_GET['p'] == "daily_activity") {
		include "module/work_from_home/wfh_data.php";
	} elseif ($_GET['p'] == "daily_activity_report") {
		include "module/work_from_home/wfh_report.php";
	} elseif ($_GET['p'] == "daily_activity_summary") {
		include "module/wfh_activity/wfh_data.php";
	} elseif ($_GET['p'] == "menanam_activity") {
		include "module/menanam_activity/menanam_data.php";
	} elseif ($_GET['p'] == "klaim_pencapaian") {
		include "module/klaim_pencapaian/klaim_data.php";
	} elseif ($_GET['p'] == "klaim_closing") {
		include "module/klaim_closing/klaim_data.php";
	} elseif ($_GET['p'] == "klaim_marketing_support") {
		include "module/klaim_closing_ms/ms_klaim_data.php";
	} elseif ($_GET['p'] == "data_reward_alih_fungsi") {
		include "module/reward_karyawan/rwd_data.php";
	} elseif ($_GET['p'] == "data_reward_marketing_support") {
		include "module/reward_ms/rwd_data.php";
	} elseif ($_GET['p'] == "absen_menanam") {
		include "module/absen_menanam/abm_data.php";
	}
	/* MUTASI-DEMOSI KARYAWAN */ elseif ($_GET['p'] == "data_mutasi") {
		include "module/mutasi/mts_data.php";
	} elseif ($_GET['p'] == "detail_mutasi") {
		include "module/mutasi/mts_detail.php";
	} elseif ($_GET['p'] == "hasil_mutasi") {
		include "module/mutasi/mts_hasil.php";
	} elseif ($_GET['p'] == "hasil_mutasi2") {
		include "module/mutasi/mts_hasil2.php";
	} elseif ($_GET['p'] == "form_mutasi") {
		include "module/mutasi/mts_form.php";
	} elseif ($_GET['p'] == "konfirm_mutasi") {
		include "module/mutasi/mts_konfirm.php";
	}
	/* END MUTASI */ elseif ($_GET['p'] == "data_coaching") {
		if (($kar_data['kar_id'] == "248") ||
			($kar_data['kar_id'] == "13") ||
			($kar_data['kar_id'] == "430") ||
			($kar_data['kar_id'] == "453") ||
			($kar_data['kar_id'] == "447") ||
			($kar_data['kar_id'] == "499") ||
			($kar_data['kar_id'] == "551") ||
			($kar_data['kar_id'] == "542") ||
			($kar_data['kar_id'] == "535") ||
			($kar_data['kar_id'] == "37")
		) {
			include "module/coaching/coa_data.php";
		} else {
			include "not_found.php";
		}
	} elseif ($_GET['p'] == "data_marketing_support") {
		include "module/marketing_support/ms_data.php";
	} elseif ($_GET['p'] == "detail_marketing_support") {
		include "module/marketing_support/ms_detail.php";
	} elseif ($_GET['p'] == "salary") {
		include "module/salary/salary_data.php";
	} elseif ($_GET['p'] == "cuti") {
		include "module/data-cuti/cuti.php";
	} elseif ($_GET['p'] == "form-cuti") {
		include "module/data-cuti/form-cuti.php";
	} elseif ($_GET['p'] == "form-cuti-acc") {
		include "module/data-cuti/form-cuti-acc.php";
	} elseif ($_GET['p'] == "form-cuti-print") {
		include "module/data-cuti/form-cuti-print.php";
	} elseif ($_GET['p'] == "cuti_notifikasi") {
		include "module/data-cuti/ntf_data.php";
	} elseif ($_GET['p'] == "cuti_notifikasi_all") {
		include "module/data-cuti/ntf_data_all.php";
	} elseif ($_GET['p'] == "kasbon_data_barang") {
		include "module/kasbon_databarang/databarang.php";
	} elseif ($_GET['p'] == "pengajuan_kasbon_unit") {
		include "module/kasbon_pengajuan_coba/data.php";
	} elseif ($_GET['p'] == "approval_kasbon_unit") {
		include "module/kasbon_approve_coba/ksbn_data.php";
	} elseif ($_GET['p'] == "data_po_marketing_support") {
		include "module/po_marketing_support/marketing_data.php";
	} elseif ($_GET['p'] == "account_marketing_support") {
		include "module/account_ms/acc_data.php";
	} elseif ($_GET['p'] == "grade_pencapaian") {
		include "module/grade_pencapaian/grd_data.php";
	} elseif ($_GET['p'] == "pemotongan_gaji") {
		include "module/pemotongan_gaji/ptg_data.php";
	} elseif ($_GET['p'] == "pemotongan_gaji_x") {
		include "module/pemotongan_gaji/ptg_data_x.php";
	}
	/*elseif($_GET['p']=="link_group_wa"){
		include"module/link_group_wa/wa_data.php";
	}*/ elseif ($_GET['p'] == "new_reward") {
		include "module/new_reward/nrw_data.php";
	} elseif ($_GET['p'] == "new_reward_cs") {
		include "module/new_reward_cs/nrw_data.php";
	} elseif ($_GET['p'] == "performa_staff") {
		include "module/performa_staff/pfm_data.php";
	} elseif ($_GET['p'] == "kondisi_sekretariat") {
		include "module/kondisi_sekretariat/ksk_data.php";
	} elseif ($_GET['p'] == "rekam_jejak") {
		include "module/rekam_jejak/rkm_data.php";
	} elseif ($_GET['p'] == "history_check_position") {
		include "module/absen/abs_checkpoint.php";
	} elseif ($_GET['p'] == "detail_maps") {
		include "module/absen/map_detail.php";
	} elseif ($_GET['p'] == "data_izin") {
		include "module/izin/izn_data.php";
	} elseif ($_GET['p'] == "berkas_izin") {
		include "module/izin/izn_berkas.php";
	} elseif ($_GET['p'] == "berkas_izin_lihat") {
		include "module/izin/izn_lht_berkas.php";
	} elseif ($_GET['p'] == "history_izin") {
		include "module/izin/izn_lht_all.php";
	} else {
		include "not_found.php";
	}
}

////////////////////////////////////////////////////
if (($kar_data['kar_pvl'] == "U")) {
	if ($_GET['p'] == "data_profile") {
		include "module/profile/pro_data.php";
	} elseif ($_GET['p'] == "data_mailbox") {
		include "module/mailbox/mlb_data.php";
	} elseif ($_GET['p'] == "detail_mailbox") {
		include "module/mailbox/mlb_detail.php";
	} elseif ($_GET['p'] == "monitoring_location") {
		include "module/location/loc_data.php";
	} elseif ($_GET['p'] == "asset_request") {
		include "module/request/req_form.php";
	} elseif ($_GET['p'] == "pengajuan_request") {
		include "module/request/req_pengajuan.php";
	} elseif ($_GET['p'] == "pengajuan_detail") {
		include "module/request/req_pengajuan_detail.php";
	} elseif ($_GET['p'] == "bio_karyawan") {
		include "module/karyawan/kar_bio.php";
	} elseif ($_GET['p'] == "biodata") {
		include "module/biodata/bio_data.php";
	} elseif ($_GET['p'] == "bio") {
		include "module/biodata/bio_bio.php";
	} elseif ($_GET['p'] == "kendaraan") {
		include "module/biodata/bio_kendaraan.php";
	} elseif ($_GET['p'] == "dokumen_pribadi") {
		include "module/biodata/bio_dokumen_pribadi.php";
	} elseif ($_GET['p'] == "kartu_kredit") {
		include "module/biodata/bio_kartu_kredit.php";
	} elseif ($_GET['p'] == "riwayat_penyakit") {
		include "module/biodata/bio_penyakit.php";
	} elseif ($_GET['p'] == "hobi") {
		include "module/biodata/bio_hobi.php";
	} elseif ($_GET['p'] == "pendidikan_formal") {
		include "module/biodata/bio_pendidikan.php";
	} elseif ($_GET['p'] == "tempat_tinggal") {
		include "module/biodata/bio_tempat_tinggal.php";
	} elseif ($_GET['p'] == "kemampuan_diri") {
		include "module/biodata/bio_kemampuan_diri.php";
	} elseif ($_GET['p'] == "pengembangan_diri") {
		include "module/biodata/bio_pengembangan_diri.php";
	} elseif ($_GET['p'] == "cita_-_cita") {
		include "module/biodata/bio_cita_cita.php";
	} elseif ($_GET['p'] == "harapan") {
		include "module/biodata/bio_harapan.php";
	} elseif ($_GET['p'] == "kredit") {
		include "module/biodata/bio_kredit.php";
	} elseif ($_GET['p'] == "khursus") {
		include "module/biodata/bio_khursus.php";
	} elseif ($_GET['p'] == "kerabat") {
		include "module/biodata/bio_kerabat.php";
	} elseif ($_GET['p'] == "pekerjaan") {
		include "module/biodata/bio_pekerjaan.php";
	} elseif ($_GET['p'] == "riwayat_pekerjaan") {
		include "module/biodata/bio_riwayat_pekerjaan.php";
	} elseif ($_GET['p'] == "riwayat_gg") {
		include "module/biodata/bio_riwayat_gg.php";
	} elseif ($_GET['p'] == "orang_tua") {
		include "module/biodata/bio_orang_tua.php";
	} elseif ($_GET['p'] == "keluarga") {
		include "module/biodata/bio_keluarga.php";
	} elseif ($_GET['p'] == "saudara") {
		include "module/biodata/bio_saudara.php";
	} elseif ($_GET['p'] == "pasangan_hidup") {
		include "module/biodata/bio_pasangan_hidup.php";
	} elseif ($_GET['p'] == "anak") {
		include "module/biodata/bio_anak.php";
	} elseif ($_GET['p'] == "detail_anak") {
		include "module/biodata/bio_detail_anak.php";
	} elseif ($_GET['p'] == "biodata_pasangan_hidup") {
		include "module/biodata/bio_bio_pasangan_hidup.php";
	} elseif ($_GET['p'] == "orang_tua_pasangan_hidup") {
		include "module/biodata/bio_orang_tua_pasangan_hidup.php";
	} elseif ($_GET['p'] == "pendidikan_formal_pasangan_hidup") {
		include "module/biodata/bio_pendidikan_pasangan_hidup.php";
	} elseif ($_GET['p'] == "riwayat_penyakit_pasangan_hidup") {
		include "module/biodata/bio_riwayat_penyakit_pasangan_hidup.php";
	} elseif ($_GET['p'] == "riwayat_pekerjaan_pasangan_hidup") {
		include "module/biodata/bio_riwayat_pekerjaan_pasangan_hidup.php";
	} elseif ($_GET['p'] == "data_penggajian") {
		include "module/penggajian/gji_data.php";
	} elseif ($_GET['p'] == "data_penilaian") {
		include "module/penilaian/nla_data.php";
	} elseif ($_GET['p'] == "detail_penilaian") {
		include "module/penilaian/nla_detail.php";
	} elseif ($_GET['p'] == "lihat_penilaian") {
		include "module/penilaian/nla_lihat3.php";
	} elseif ($_GET['p'] == "hasil_penilaian") {
		include "module/penilaian/nla_hasil.php";
	} elseif ($_GET['p'] == "hasil_penilaian2") {
		include "module/penilaian/nla_hasil2.php";
	} elseif ($_GET['p'] == "hasil_penilaian3") {
		include "module/penilaian/nla_hasil3.php";
	} elseif ($_GET['p'] == "data_notifikasi") {
		include "module/notify/ntf_data.php";
	} elseif ($_GET['p'] == "form_penilaian") {
		include "module/penilaian/nla_form.php";
	} elseif ($_GET['p'] == "lihat_notifikasi") {
		include "module/notify/ntf_lihat.php";
	} elseif ($_GET['p'] == "report_penilaian") {
		include "module/penilaian/nla_report.php";
	} elseif ($_GET['p'] == "konfirm_penilaian") {
		include "module/penilaian/nla_konfirm.php";
	} elseif ($_GET['p'] == "data_kwitansi") {

		if (($kar_data['kar_id'] == "17") ||
			($kar_data['kar_id'] == "24") ||
			($kar_data['kar_id'] == "69") ||
			($kar_data['kar_id'] == "248") ||
			($kar_data['kar_id'] == "255") ||
			($kar_data['kar_id'] == "410") ||
			($kar_data['kar_id'] == "421") ||
			($kar_data['kar_id'] == "88")
		) {
			include "module/kwitansi/kwi_data.php";
		} else {
			include "not_found.php";
		}
	} elseif ($_GET['p'] == "data_nota") {

		if (($kar_data['kar_id'] == "24") ||
			($kar_data['kar_id'] == "69") ||
			($kar_data['kar_id'] == "273") ||
			($kar_data['kar_id'] == "248") ||
			($kar_data['kar_id'] == "255") ||
			($kar_data['kar_id'] == "410") ||
			($kar_data['kar_id'] == "421") ||
			($kar_data['kar_id'] == "88")
		) {
			include "module/nota/nta_data.php";
		} else {
			include "not_found.php";
		}
	} elseif ($_GET['p'] == "unlist_domain") {
		include "module/unlistdomain/udo_data.php";
	} elseif ($_GET['p'] == "jadwal_online") {
		include "module/jadwal_online/jwo_data.php";
	} elseif ($_GET['p'] == "jadwal") {
		include "module/jadwal/jdw_data.php";
	} elseif ($_GET['p'] == "jadwal_mei2022") {
		include "module/jadwal_mei2022/jdw_data.php";
	} elseif ($_GET['p'] == "penilai1_kpi") {
		include "module/kpi/kpi_penilai1.php";
	} elseif ($_GET['p'] == "penilai2_kpi") {
		include "module/kpi/kpi_penilai2.php";
	} elseif ($_GET['p'] == "penilai3_kpi") {
		include "module/kpi/kpi_penilai3.php";
	} elseif ($_GET['p'] == "penilai4_kpi") {
		include "module/kpi/kpi_penilai4.php";
	} elseif ($_GET['p'] == "berkas_kpi") {
		include "module/kpi/kpi_berkas.php";
	} elseif ($_GET['p'] == "data_reward") {
		include "module/reward/rwd_data.php";
	} elseif ($_GET['p'] == "data_reward_cs") {
		include "module/reward_cs/rwd_data.php";
	}


	
	
	/* KASBON */ elseif ($_GET['p'] == "pengajuan_kasbon") {
		include "module/kasbon_request/ksbn_data.php";
	} elseif ($_GET['p'] == "approval_kasbon") {
		include "module/kasbon_approve/ksbn_data.php";
	} elseif ($_GET['p'] == "pembayaran_kasbon") {
		include "module/kasbon_payment/ksbn_data.php";
	}
	/* END KASBON */ elseif ($_GET['p'] == "data_headline") {

		if (($kar_data['kar_id'] == "21") ||
			($kar_data['kar_id'] == "37")
		) {
			include "module/headline/hed_data.php";
		} else {
			include "not_found.php";
		}
	} elseif ($_GET['p'] == "data_archive") {

		if (($kar_data['kar_id'] == "21") ||
			($kar_data['kar_id'] == "37")
		) {
			include "module/archive/acv_data.php";
		} else {
			include "not_found.php";
		}
	} elseif ($_GET['p'] == "daily_activity") {
		if($kar_ada == 1){
			include "module/work_from_home/wfh_data.php";
		}else{
			include "module/work_from_home/wfh_no_absen.php";
		}
		//echo $ada;				
	} elseif ($_GET['p'] == "daily_activity_report") {
		include "module/work_from_home/wfh_report.php";
	} elseif ($_GET['p'] == "daily_activity_summary") {
		include "module/wfh_activity/wfh_data.php";
	} elseif ($_GET['p'] == "menanam_activity") {
		include "module/menanam_activity/menanam_data.php";
	} elseif ($_GET['p'] == "klaim_pencapaian") {
		include "module/klaim_pencapaian/klaim_data.php";
	} elseif ($_GET['p'] == "klaim_closing") {
		include "module/klaim_closing/klaim_data.php";
	} elseif ($_GET['p'] == "klaim_marketing_support") {
		include "module/klaim_closing_ms/ms_klaim_data.php";
	} elseif ($_GET['p'] == "data_reward_alih_fungsi") {
		include "module/reward_karyawan/rwd_data.php";
	} elseif ($_GET['p'] == "data_reward_marketing_support") {
		include "module/reward_ms/rwd_data.php";
	} elseif ($_GET['p'] == "absen_menanam") {
		include "module/absen_menanam/abm_data.php";
	}
	/* MUTASI-DEMOSI KARYAWAN */ elseif ($_GET['p'] == "detail_mutasi") {
		include "module/mutasi/mts_detail.php";
	} elseif ($_GET['p'] == "hasil_mutasi") {
		include "module/mutasi/mts_hasil.php";
	} elseif ($_GET['p'] == "hasil_mutasi2") {
		include "module/mutasi/mts_hasil2.php";
	} elseif ($_GET['p'] == "form_mutasi") {
		include "module/mutasi/mts_form.php";
	} elseif ($_GET['p'] == "konfirm_mutasi") {
		include "module/mutasi/mts_konfirm.php";
	}
	/* END MUTASI-DEMOSI */ elseif ($_GET['p'] == "salary") {
		include "module/salary/salary_data.php";
	} elseif ($_GET['p'] == "cuti") {
		include "module/data-cuti/cuti.php";
	} elseif ($_GET['p'] == "form-cuti") {
		include "module/data-cuti/form-cuti.php";
	} elseif ($_GET['p'] == "form-cuti-acc") {
		include "module/data-cuti/form-cuti-acc.php";
	} elseif ($_GET['p'] == "form-cuti-print") {
		include "module/data-cuti/form-cuti-print.php";
	} elseif ($_GET['p'] == "cuti_notifikasi") {
		include "module/data-cuti/ntf_data.php";
	} elseif ($_GET['p'] == "cuti_notifikasi_all") {
		include "module/data-cuti/ntf_data_all.php";
	} elseif ($_GET['p'] == "kasbon_data_barang") {
		include "module/kasbon_databarang/databarang.php";
	} elseif ($_GET['p'] == "pengajuan_kasbon_unit") {
		include "module/kasbon_pengajuan_coba/data.php";
	} elseif ($_GET['p'] == "approval_kasbon_unit") {
		include "module/kasbon_approve_coba/ksbn_data.php";
	} elseif ($_GET['p'] == "data_po_marketing_support") {
		include "module/po_marketing_support/marketing_data.php";
	}
	/*elseif($_GET['p']=="link_group_wa"){
		include"module/link_group_wa/wa_data.php";
	}*/ elseif ($_GET['p'] == "new_reward") {
		include "module/new_reward/nrw_data.php";
		//echo"SEDANG DALAM PROSES";
	} elseif ($_GET['p'] == "new_reward_cs") {
		include "module/new_reward_cs/nrw_data.php";
		//echo"SEDANG DALAM PROSES";
	} elseif ($_GET['p'] == "performa_staff") {
		include "module/performa_staff/pfm_data.php";
	} elseif ($_GET['p'] == "kondisi_sekretariat") {
		include "module/kondisi_sekretariat/ksk_data.php";
	} elseif ($_GET['p'] == "rekam_jejak") {
		include "module/rekam_jejak/rkm_data.php";
	} elseif ($_GET['p'] == "data_izin") {
		include "module/izin/izn_data.php";
	} elseif ($_GET['p'] == "berkas_izin") {
		include "module/izin/izn_berkas.php";
	} elseif ($_GET['p'] == "berkas_izin_lihat") {
		include "module/izin/izn_lht_berkas.php";
	}elseif($_GET['p'] == "rekap_publikasi"){
		include "module/rekap_publikasi/rekap_publikasi_sosmed.php";
	}else {
		include "not_found.php";
	}
}    
 
////////////////////////////////////////////////////
