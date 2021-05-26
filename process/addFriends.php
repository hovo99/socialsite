<?php
include_once ('../vendor/Database.php');
include_once ('../vendor/Functions.php');
if (isset($_SESSION['user_id'])){
    $id = $_SESSION['user_id'];
}
else{
    header('location:../views/login.php');
}
if (isset($_GET['stacoxi_id'])){
    $stacoxi_id = $_GET['stacoxi_id'];
    $db->insert('friend_request',['uxarkoxi_id'=>$id,'stacoxi_id'=>$stacoxi_id]);
    $f->views('home');

}
