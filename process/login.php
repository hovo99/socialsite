<?php
include_once '../vendor/Functions.php';
include_once '../vendor/Database.php';

$isValid = $db->postValidate([
    'email'=>'required|string|email',
    'password'=>'required|string|password'
]);

if ($isValid){
    $email = $db->clean($_POST['email']);
    $password = $db->clean($_POST['password']);
    $query = $db->select('users',['email'=>$email]);
    $num_rows = mysqli_num_rows($query);
    if($num_rows > 0){
        $user = mysqli_fetch_assoc($query);
        if(hash_equals($user['password'], crypt($password, $user['password']))){
            $_SESSION['user_id'] = $user['id'];
            $sql_posts = "SELECT * FROM `posts` ORDER BY `id` DESC ";
            $query_posts = mysqli_query($connect,$sql_posts);
            $posts = mysqli_fetch_assoc($query_posts);
            $data = ['user'=>$user,'posts'=>$posts];
            $f->views('home',$data);
        }

        else{

            $_SESSION['error'] = 'Something went WRONG!';
            header('location:../views/login.php');die;
        }

    }
    else{
        $_SESSION['error'] = 'inchvor ban ayn che';
        header('location:../views/login.php');die;
    }
}
