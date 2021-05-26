<?php
include_once ('../vendor/Database.php');
include_once ('../vendor/Functions.php');

if (isset($_SESSION['user_id'])){
    $id = $_SESSION['user_id'];
}
else{
    header('location:login.php');die;
}
if(isset($_POST['sub'])) {
    $db->postValidate([
        'title'=>'required|string',
        'content'=>'required|string',
    ]);
    if (isset($_FILES['img']) && !empty($_FILES['img']['name'])){
        $isImg = getimagesize($_FILES["img"]["tmp_name"]);
        if($isImg){
            $dir = "../img/posts/";
            $img_name = time().basename($_FILES["img"]["name"]);
            $full_dir = $dir.$img_name;
            $move = move_uploaded_file($_FILES["img"]["tmp_name"], $full_dir);
            if($move){
                $img = $img_name;
            }
            else{
                $_SESSION['img_e'] = 'Program error';
                header('location:../views/posts.php');die;
            }
        }
        else{
            $_SESSION['img_e'] = 'Choose a pic!';
            header('location:../views/posts.php');die;
        }

    }
    else{
        $img = null;
    }
    $query = $db->insert('posts',[
        'user_id' => $id,
        'title' => $_POST['title'],
        'content' => $_POST['content'],
        'img' => $img,
    ]);
    if($query){
        $f->redirectBack();
    }
}
else{
    header('location:../views/login.php');die;
}
?>