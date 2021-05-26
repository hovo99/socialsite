<?php
session_start();
include_once ('../config/connect.php');
$id = $_SESSION['user_id'];
$result = [];

$f_n = clean($_POST['first_name']);
if (isset($f_n) && !empty($f_n)){
    $first_name =$f_n;
    $result['first_name'] =  $first_name;
}
else{
    $result['f_n_e'] = 'anun@ chikara datark lini!!';
    echo json_encode($result);die;
}
$l_n = clean($_POST['last_name']);
if (isset($l_n) && !empty($l_n)){
    $last_name = $l_n;
    $result['last_name'] =  $last_name;
}
else{
    $result['l_n_e'] = 'azganun@ chikara datark lini!!';
    echo json_encode($result);die;
}

$cot = clean($_POST['country']);
if(isset($cot) && !empty($cot)){
    $country = $cot;
    $result['country'] = $country;
}
else{
    $result['cot_e'] = '@ntreq dzer erkir@!';
    echo json_encode($result);die;

}

$dat = clean($_POST['date']);
if(isset($dat) && !empty($dat)){
    $date = $dat;
    $result['date'] = $date;
} 
else{
    $result['dat_e'] = 'Choose your date!';
    echo json_encode($result);die;
}

$e = clean($_POST['email']);
if(isset($e) && !empty($e)){
    $email = $e;
    $result['email'] = $email;
}
else{
    $result['e_e'] = 'The field for your email is empty!';
    echo json_encode($result);die;
}

$p = clean($_POST['password']);
    $c_pass = clean($_POST['c_pass']);
    if(isset($p) && !empty($p)){
        if(isset($c_pass) && !empty($c_pass)){
            if($c_pass === $p){
                $password = crypt($p,'');
                $result['password'] = $p;
            }
            else{
                $result['p_e'] = "The fields 'password' and 'confirm password' don't correspond with each other!!!";
                echo json_encode($result);die;
            }
        }
        else{
            $_SESSION['p_e'] = 'The field confirm password is empty!!!';
              echo json_encode($result);die;
        }
    }
    else{
       $sql = "SELECT `password` FROM `users` WHERE `id`='$id'";
       $query = mysqli_query($connect,$sql);
       $row = mysqli_fetch_assoc($query);
       $password = $row['password'];
       $result['password'] = $password;


    }

$sql = "UPDATE `users` SET `first_name`='$first_name',`last_name`='$last_name',`date`='$date',`email`='$email', `country`='$country',`password`='$password' WHERE `id`='$id'";
$query = mysqli_query($connect,$sql);
if ($query){
    $result['success'] = 'ok';
    $result['first_name'] =  $first_name;
    $last_name = $l_n;
    $date = $dat;
    $email = $e;
    $country = $cot;
    $password = $p;



    $userBday =  $date;
    $bday = new DateTime($userBday);
    $now = new DateTime();
    $difference = $now->diff($bday);
    $age = $difference->y;


    $result['age'] =  $age;
    echo json_encode($result);die;
}

