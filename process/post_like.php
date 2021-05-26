<?php
include_once '../vendor/Database.php';
$post_id = $_POST['post_id'];
$user_id = $_SESSION['user_id'];
$num = mysqli_num_rows($db->select('post_like',['user_id'=>$user_id,'post_id'=>$post_id],'id'));
if ($num === 0){
    $db->insert('post_like',['user_id'=>$user_id,'post_id'=>$post_id]);
    $num = mysqli_num_rows($db->select('post_like',['post_id'=>$post_id],'id'));
    echo json_encode(['success'=>'ok','num'=>$num]);
}
else{
    $db->delete('post_like',['user_id'=>$user_id,'post_id'=>$post_id]);
    $num = mysqli_num_rows($db->select('post_like',['post_id'=>$post_id],'id'));
    echo json_encode(['success'=>'ok','num'=>$num]);
}
