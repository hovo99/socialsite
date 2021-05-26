<?php
include_once '../vendor/Database.php';
include_once '../vendor/Functions.php';
if (isset($_POST['submit'])) {

    $isValid = $db->postValidate([
        'first_name'=>'required|string',
        'last_name'=>'required|string',
        'email'=>'required|string|email|unique',
        'password'=>'required|string|password',
        'confirm_password'=>'required|string|password|confirmed',
        'date'=>'required',
        'country'=>'required',
        'gender'=>'required',
    ],'users');
    if ($isValid){
        $db->insert('users',$db->post());
        $f->views('login');
    }
}