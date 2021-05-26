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
    header('location:../views/posts.php');die;
}
$sql = "DELETE FROM `posts` WHERE `id`='$post_id' AND `user_id`='$id'";
$query = mysqli_query($connect,$sql);
if($query and isset($_GET['img']) and file_exists('../img/posts/'.$_GET['img'])){
    unlink('../img/posts/'.$_GET['img']);
}
header('location:../views/posts.php');

