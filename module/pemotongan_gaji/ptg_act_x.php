<?php
$page=$_GET['p'];

if(isset($_POST['bmonth'])){

    if(!empty($_POST['filter_month'])){
        $_SESSION['fmonth'] = $_POST['filter_month'];
        $f_month = $_SESSION['fmonth'];
    }else{
        $_SESSION['fmonth'] = "";
    }

    echo"<script>document.location='?p=$page';</script>";
}

if(isset($_POST['bclearmonth'])){
    $_SESSION['fmonth'] = "";
    echo"<script>document.location='?p=$page';</script>";
}

if(!empty($_SESSION['fmonth'])){
    $f_month = $_SESSION['fmonth'];
}else{
    $f_month = date('m/Y');
}

/////////////////////////////////////////////////////////////////////////////////////////////
$exp_date = explode('/',$f_month);
$sesi_date1 = $exp_date[1] . '-' . $exp_date[0] . '-26';
$sesi_date2 = $exp_date[1] . '-' . $exp_date[0] . '-25';
$tgl_awal = date('Y-m-d', strtotime('-1 month', strtotime($sesi_date1)));
$tgl_akhir = $sesi_date2;

$karyawanArr = array();

$ptg_priode = str_replace('/','',$f_month);

$sql = "SELECT * FROM `pemotongan_gaji`
WHERE ptg_priode = '$ptg_priode' ORDER BY ptg_nama ASC";

$query=mysql_query($sql) or die (mysql_error());
while($data = mysql_fetch_assoc($query)){
    
    $nik = $data['ptg_nik'];
    $nama = $data['ptg_nama'];
    $kampus = $data['ptg_kampus'];
    $grade = $data['ptg_grade'];
    $target = $data['ptg_target'];
    $pencapaian = $data['ptg_pencapaian'];
    $potongan = $data['ptg_potongan'];
    $insentif = $data['ptg_insentif'];
    
    $karyawanArr[$nik] = array('nik' => $nik,
                           'nama' => $nama,
                           'kampus' => $kampus,
                           'grade' => $grade,
                           'target' => $target,
                           'pencapaian' => $pencapaian,
                           'potongan' => $potongan,
                           'insentif' => $insentif);
}
?>