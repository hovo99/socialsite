<?php
include_once ('../vendor/Database.php');
include_once ('../vendor/Functions.php');
if (isset($_SESSION['user_id'])){
    $id = $_SESSION['user_id'];
}
else{
    header('location:../views/login.php');
}
if (!empty($_GET)){
    $uxarkoxi_id=$_GET['uxarkoxi_id'];
    if ($_GET['request'] === 'yes'){
        $db->insert('friends',['uxarkoxi_id'=>$uxarkoxi_id,'stacoxi_id'=>$id]);
        $db->delete('friend_request',['uxarkoxi_id'=>$uxarkoxi_id,'stacoxi_id'=>$id]);
        $f->redirectBack();
    }
    elseif ($_GET['request'] === 'no'){
        $db->delete('friend_request',['uxarkoxi_id'=>$uxarkoxi_id,'stacoxi_id'=>$id]);
        $f->redirectBack();
    }
}