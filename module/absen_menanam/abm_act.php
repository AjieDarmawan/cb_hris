<?php
session_start(); 
$page=$_GET['p'];
$act=$_GET['act'];

if(isset($_POST['bday'])){

    if(!empty($_POST['filter_day'])){
        $_SESSION['fday'] = $_POST['filter_day'];
        $filter_day = $_SESSION['fday'];
    }else{
        $_SESSION['fday'] = "";
    }

    echo"<script>document.location='?p=$page';</script>";
}


if(isset($_POST['bclearday'])){
    $_SESSION['fday'] = "";
    echo"<script>document.location='?p=$page';</script>";
}

if(!empty($_SESSION['fday'])){
    $wfd_date=date('d/m/Y',strtotime($_SESSION['fday']));
    $wfd_date_ori = $_SESSION['fday'];
}else{
    $wfd_date=date('d/m/Y');
    $wfd_date_ori=date('Y-m-d');
}


?>