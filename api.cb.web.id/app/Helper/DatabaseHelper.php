<?php

$list_table = array(
	'app' => '',
	'menu' => 'app_menu',
	'akses' => 'app_akses',
	'group' => 'app_group',
	
	'dsn' => 'userdata_dsn',
	'mhs' => 'userdata_mhs',
	'staff' => 'userdata_staff',
	
	'fak' => '',
	'jrs' => '',
	'kls' => '',
	'matkul' => 'conf_datajdatamk',
	
	'smt' => '',
	'krs' => 'conf_datakrs',
	'jadwal' => 'conf_datajadwal',
	
	'dokumen' => 'lms_dokumen',
	'notifikasi' => 'lms_notif',
	'notifikasid' => 'lms_notifd',
	'peserta' => 'lms_peserta',
	'pertemuan' => 'lms_pertemuan'	
);


if(!function_exists('rmgettbl'))
{
	function rmgettbl($alias=null, $prefix='vvvvvvvv_') {
		
		@reset($list_table);
		if($alias <> null && isset($list_table[$alias])) {
			return $prefix . $list_table[$alias];
		}
		return '';
	}
}