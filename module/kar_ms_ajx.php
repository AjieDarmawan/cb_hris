<?php
error_reporting(E_ALL ^ E_NOTICE);
date_default_timezone_set('Asia/Jakarta');
session_start();

require('../class.php');

$db=new Database();
$db->koneksi();

$ms=new Marketing_support();

$kar_id=$_POST['kar_id'];
$kar_tampil_id=$ms->ms_tampil_id($kar_id);
$data=mysql_fetch_array($kar_tampil_id);
$kar_jml=mysql_num_rows($kar_tampil_id);
if($kar_jml > 0){
		echo"
                <div class='form-group'>
                    <label for='' class='col-sm-2 control-label'></label>
                    <div class='col-sm-10'>
                        <div class='alert alert-success alert-dismissable'>
                        <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                        <p><strong>Nama</strong>: $data[kar_nm], &nbsp;<strong>Divisi</strong>: $data[div_nm], &nbsp;<strong>Karyawan</strong>: $data[lvl_nm]</p>
                        </div>
                    </div>
                </div>
                ";     

}
?>