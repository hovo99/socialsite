<?php
session_start();
include_once ("../config/connect.php");
if (isset($_SESSION['user_id'])){
    $id = $_SESSION['user_id'];
}
if (isset($_FILES['avatar']) && !empty($_FILES['avatar']['name'])){
    $r = [];
    $isImg = getimagesize($_FILES["avatar"]["tmp_name"]);
    if($isImg){
        $dir = "../img/photos/";
        $img_name = time().$_FILES["avatar"]["name"];
        $full_dir = $dir.$img_name;
        $move = move_uploaded_file($_FILES["avatar"]["tmp_name"], $full_dir);
        if($move){
            $img = $img_name;
        }
        else{
            $r['img_e'] = 'Program error';
            echo json_encode($r);die;

        }
    }
    else{
        $r['img_e'] = 'Choose a pic!';
        echo json_encode($r);die;
    }
    $sql = "UPDATE `users` SET `avatar`='$img_name' WHERE `id`='$id'";
    $query = mysqli_query($connect,$sql);
    if ($query){
        if (isset($_POST['old_avatar']) and file_exists('../img/photos/'.$_POST['old_avatar'])){
            unlink('../img/photos/'.$_POST['old_avatar']);
        }
        $r['img'] = $img_name;
        echo json_encode($r);die;
    }
}
