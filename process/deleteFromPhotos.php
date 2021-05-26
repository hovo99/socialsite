<?php
session_start();

include_once ('../config/connect.php');
if (isset($_SESSION['user_id'])){
    $id = $_SESSION['user_id'];
}
else{
    header('location:../views/login.php');die;
}


if (isset($_GET['post_id'])){
    $post_id = $_GET['post_id'];
}
else{
    header('location:../views/fotos.php');die;
}
$sql = "DELETE FROM `photos` WHERE `id`='$post_id' AND `user_id`='$id'";
$query = mysqli_query($connect,$sql);
if($query and isset($_GET['name']) and file_exists('../img/photos/'.$_GET['name'])){
    unlink('../img/photos/'.$_GET['name']);
}
header('location:../views/fotos.php');

