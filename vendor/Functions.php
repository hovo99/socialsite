<?php


class Functions
{
    public function __construct()
    {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
    }

    public function dd($var){
        echo '<pre>';
        print_r($var);
        echo '</pre>';die;
    }
    public function d($var){
        echo '<pre>';
        print_r($var);
        echo '</pre>';
    }
    public function old($key){
        if (isset($_SESSION[$key])){
            echo $_SESSION[$key];
            unset($_SESSION[$key]);
        }
    }
    public function hasError($key){
        if (isset($_SESSION['errors'][$key])){
            return true;
        }
        else{
            return false;
        }
    }
    public function printError($key){
        if (isset($_SESSION['errors'][$key])){
            echo $_SESSION['errors'][$key];
            unset($_SESSION['errors'][$key]);
        }
    }
    public function redirectBack(){
        header('Location: ' . $_SERVER['HTTP_REFERER']);
        return 1;
    }
    public function views($place){
        header('Location: ../views/' . $place.'.php');
        return 1;
    }
    public function getVar($name){
        return $_SESSION['views'][$name];
    }
    public function isSignedIn(){
        if (isset($_SESSION['user_id'])){
            return $_SESSION['user_id'];
        }

        return $this->views('login');
    }

}
$f = new Functions();