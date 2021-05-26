<?php
session_start();
include_once('../config/connect.php');
if(isset($_SESSION['user_id'])){
    $user_id = $_SESSION['user_id'];
}
else{
    header('location:../views/login.php');
}
if (isset($_POST['editpost'])){
    $id = $_POST['idpost'];
    $tit = clean($_POST['changetitle']);
    $cont = clean($_POST['changecontent']);
    if ( (isset($tit)&& !empty($tit))  && (isset($cont) && !empty($cont)) ){
        $title = $tit;
        $content = $cont;
        $sql = "UPDATE `posts` SET `title`='$title', `content` = '$content' WHERE `id` ='$id' AND `user_id`='$user_id'";
        $query = mysqli_query($connect,$sql);
        if ($query){
            $_SESSION['editEnd'] = "Success. Еditing Already Completed. Without Errors";
            header('location: ../views/posts.php');die;
        }else{
            $_SESSION['editEndError'] = "Connect Error";
            header('location: ../views/posts.php');die;
        }

    }else{
        $_SESSION['tit_error'] = "Popoxutyun@ chi katarvel. Title Chi karox datark linel";
        $_SESSION['cont_error'] = "Popoxutyun@ chi katarvel. Content Chi karox datark linel";
        header('location: ../views/posts.php');die;
    }
}
else{
    header('location:../views/login.php');die;
}

?>