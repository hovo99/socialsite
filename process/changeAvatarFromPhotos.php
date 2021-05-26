<?php
include_once '../vendor/Database.php';
include_once '../vendor/Functions.php';
if (isset($_GET) && !empty($_GET)){
    $id = $_GET['user_id'];
    $name = $_GET['name'];
    $db->update('users',['avatar'=>$name],['id'=>$id]);
    $f->views('home');
}
