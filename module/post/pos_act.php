<?php


foreach($_REQUEST as $name=>$value)
{
        $$name=$value;
     //   echo " $name = $value;<br />\n";
}

$page=$_GET['p'];
$act=$_GET['act'];
$pos_id=$_GET['id'];

if(isset($page)&&($act=="hapus")){
    $pos_delete=$pos->pos_delete($pos_id);
    echo"<script>document.location='?p=$page';</script>";
}
elseif(isset($page)&&($act=="block")){
    $pos_sts="N";
    $pos_update_sts=$pos->pos_update_sts($pos_id,$pos_sts);
    echo"<script>document.location='?p=$page';</script>";
}
elseif(isset($page)&&($act=="unblock")){
    $pos_sts="A";
    $pos_update_sts=$pos->pos_update_sts($pos_id,$pos_sts);
    echo"<script>document.location='?p=$page';</script>";
}
elseif(isset($_POST['bEditPost'])){
    $sql_post="UPDATE pos_master SET pos_msg='$pos_msg'
               WHERE pos_id='$id' ";
    $update=mysql_query($sql_post) ;           
//    echo"<script>document.location='?p=$page';</script>";      

   

}

?>