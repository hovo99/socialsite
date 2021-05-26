<?php
include_once '../vendor/Functions.php';
include_once '../vendor/Database.php';
if (isset($_SESSION['user_id'])){
    $id = $_SESSION['user_id'];
}
else{
    header('location:login.php');die;
}
if (isset($_POST['submit'])){
    $img = null;
    $dir = "../img/photos";

    for($i = 0;$i<count($_FILES['img']['name']);$i++){
        if($_FILES["img"]["name"][$i] && !empty($_FILES["img"]["name"][$i])){
            $img_name = time().$_FILES['img']['name'][$i];
            if(getimagesize($_FILES["img"]["tmp_name"][$i])){
                if(move_uploaded_file($_FILES["img"]["tmp_name"][$i],$dir.DIRECTORY_SEPARATOR.$img_name)){
                    $img = $img_name;
                }
            } else {
                header("location: ../views/fotos.php");
            }
        } else {
            header("location: ../views/fotos.php");
        }
        $db->insert('photos',['user_id'=>$id,'name'=>$img]);

    }
    header("location: ../views/fotos.php");

}
else{
    header('location:../views/login.php');die;
}
?>