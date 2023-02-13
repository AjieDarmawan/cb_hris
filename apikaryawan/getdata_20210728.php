<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
include('koneksi.php');
// echo json_encode($_POST);
// die();
if(isset($_POST['type'])){
    if($_POST['type'] == "login"){

        $username = $_POST['username'];
        $password = md5($_POST['password']);
        
        // $result = mysqli_query($mysqli, "SELECT * FROM acc_master am JOIN kar_master km ON am.kar_id = km.kar_id JOIN kar_detail kd ON km.kar_id=kd.kar_id WHERE am.acc_username = '$username' AND am.acc_md5 = '$password' LIMIT 1");
        $result = mysqli_query($mysqli, "SELECT lm.*,km.jbt_id as jbt_id, km.kar_nm, am.acc_md5, am.acc_username,km.kar_nik,km.kar_id, am.acc_img, kar_dtl_eml FROM acc_master am JOIN kar_master km ON am.kar_id = km.kar_id JOIN div_master dm ON dm.div_id = km.div_id JOIN lvl_master lm ON km.lvl_id = lm.lvl_id JOIN kar_detail kd ON km.kar_id=kd.kar_id WHERE am.acc_username = '$username' AND am.acc_md5 = '$password' LIMIT 1");
        // $arrdata = array();
        // $arrdata['message'] = 'havedata'; 
        // while($data = mysqli_fetch_row($result)){
        // $result->$mysqli->query($sql);

        $row = mysqli_fetch_assoc($result);
            // echo $data; 
            // $arrdata[] = $data;
        // }
        // var_dump($row);die();
        if(count($row) < 1){
            echo json_encode(array('message' => 'fail'));die();

        }
        echo json_encode($row);
        // if(count($row) < 2);
    }   
    elseif($_POST['type'] == "direksi"){
        $result = mysqli_query($mysqli, "SELECT * FROM kar_master km JOIN lvl_master lm ON km.lvl_id = lm.lvl_id JOIN kar_detail kd ON km.kar_id = kd.kar_id WHERE lm.lvl_id IN (1,2,3) AND kd.kar_dtl_typ_krj != 'Resign'");
        $data = array();
        while($row = mysqli_fetch_assoc($result)){
            $data[] = $row;
        }
        // echo count($data);
        echo json_encode($data);
    } elseif($_POST['type'] == "semua-karyawan"){
        $result = mysqli_query($mysqli, "SELECT lm.lvl_id, am.acc_img,km.kar_nik, km.kar_nm FROM kar_master km JOIN lvl_master lm ON km.lvl_id = lm.lvl_id JOIN kar_detail kd ON km.kar_id = kd.kar_id JOIN acc_master am ON km.kar_id = am.kar_id JOIN div_master dm ON dm.div_id = km.div_id WHERE kd.kar_dtl_typ_krj != 'Resign' AND (lm.lvl_id IN (3,4,5,6,7,8,9,10,11,12,13,14) AND km.div_id IN (4,11)) OR km.kar_id IN (11,30)");
        $data = array(); 
        while($row = mysqli_fetch_assoc($result)){
            $data[] = $row;
        }
        // echo count($data);
        echo json_encode($data);
    }  elseif($_POST['type'] == "terizin"){
        // var_dump($_POST);die();
        $nik = $_POST['nik'];
        $result = mysqli_query($mysqli, "SELECT lm.*, am.acc_md5, kd.kar_dtl_eml, am.acc_img,km.kar_nik, km.kar_nm FROM kar_master km JOIN lvl_master lm ON km.lvl_id = lm.lvl_id JOIN kar_detail kd ON km.kar_id = kd.kar_id JOIN acc_master am ON km.kar_id = am.kar_id WHERE kd.kar_dtl_typ_krj != 'Resign' AND km.kar_nik = '$nik' ");
        $data = array();
        
        $row = mysqli_fetch_assoc($result);
            // $data[] = $row;
        // }
        // var_dump(count($row));die();
        if(count($row) < 2){
            echo json_encode(array('message' => 'data kosong'));die();
        }
        echo json_encode($row);
    } elseif($_POST['type'] == "semua-data"){
        $result = mysqli_query($mysqli, "SELECT am.acc_img,km.kar_nik, km.kar_nm FROM kar_master km JOIN lvl_master lm ON km.lvl_id = lm.lvl_id JOIN kar_detail kd ON km.kar_id = kd.kar_id JOIN acc_master am ON km.kar_id = am.kar_id WHERE kd.kar_dtl_typ_krj != 'Resign'");
        $data = array();
        while($row = mysqli_fetch_assoc($result)){
            $data[] = $row;
        }
        // echo count($data);
        echo json_encode($data);
    } elseif($_POST['type'] == "tolocaldireksi"){
        $result = mysqli_query($mysqli, "SELECT * FROM kar_master km JOIN lvl_master lm ON km.lvl_id = lm.lvl_id JOIN acc_master am ON km.kar_id = am.kar_id JOIN kar_detail kd ON km.kar_id = kd.kar_id WHERE lm.lvl_id IN (1,2,3) AND kd.kar_dtl_typ_krj != 'Resign'");
        $data = array();
        while($row = mysqli_fetch_assoc($result)){
            $data[] = $row;
        }
        // echo count($data);
        echo json_encode($data);
    }elseif($_POST['type'] == "semuanya"){
        
        $result = mysqli_query($mysqli, "SELECT * FROM kar_master km JOIN lvl_master lm ON km.lvl_id = lm.lvl_id JOIN kar_detail kd ON km.kar_id = kd.kar_id JOIN acc_master am ON km.kar_id = am.kar_id JOIN div_master dm ON dm.div_id = km.div_id WHERE kd.kar_dtl_typ_krj != 'Resign'");
        $data = array();
        while($row = mysqli_fetch_assoc($result)){
            $data[] = $row;
        }
        // echo count($data);
        echo json_encode($data);
    } elseif($_POST['type'] == "datagaada"){
        $username = $_POST['username'];
        $result = mysqli_query($mysqli, "SELECT * FROM kar_master km JOIN lvl_master lm ON km.lvl_id = lm.lvl_id JOIN kar_detail kd ON km.kar_id = kd.kar_id JOIN acc_master am ON km.kar_id = am.kar_id JOIN div_master dm ON dm.div_id = km.div_id WHERE kd.kar_dtl_typ_krj != 'Resign' AND am.acc_username = '$username'");
        $data = array();
        while($row = mysqli_fetch_assoc($result)){
            $data[] = $row;
        }
        // echo count($data);
        echo json_encode($data);
    }elseif($_POST['type'] == "karyawanresign"){
        // $username = $_POST['username'];
        $result = mysqli_query($mysqli,"SELECT km.kar_nik FROM kar_master km JOIN acc_master am ON km.kar_id = am.kar_id JOIN kar_detail kd ON km.kar_id = kd.kar_id WHERE kd.kar_dtl_typ_krj = 'Resign'");
        $data = array();
        while($row = mysqli_fetch_assoc($result)){
            $data[] = $row;
        }
        // echo count($data);
        echo json_encode($data);
    }
}else{
    // $array = [1,2,3,4,5];
    for($i = 3; $i > 2; $i++){
        $query = mysqli_query($mysqli,"SELECT kar_nm FROM kar_master ORDER BY rand() LIMIT 10");
        while($kar_nm = mysqli_fetch_array($query)){
            echo $kar_nm['kar_nm'].' ';
        }
        echo '<br>';
        echo '<br>';
    }
    // echo '<br>';
    // echo '<br>';
}
?>