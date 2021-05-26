<?php

class Database
{
    public function __construct()
    {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
    }
    private $connected = null;
    public function query($sql){
        if ($this->connected === null){
            define('HOST', 'localhost');
            define('USER', 'root');
            define('PASSWORD', '');
            define('DBNAME', 'soc-site');
            $this->connected = mysqli_connect(HOST, USER, PASSWORD, DBNAME);
            return mysqli_query($this->connected,$sql);
        }
        else{
            return mysqli_query($this->connected,$sql);
        }
    }

    ////////////////////////  QUERIES  ////////////////////////
    public function insert($table,$data){

        $last_key = array_key_last($data);
        $first_key = array_key_first($data);
        $keys = '';
        $values = '';
        foreach ($data as $key => $val){
            if ($key === $first_key){
                $keys .= "(`$key`,";
                $values .= "('$val',";
            }
            elseif ($key === $last_key){
                $keys .= "`$key`)";
                $values .= "'$val')";
            }
            else{
                $keys .= "`$key`,";
                $values .= "'$val',";
            }
        }
        $sql = "INSERT INTO `$table` $keys VALUES $values";

        return $this->query($sql);
    }
    public function update($table,$data,$where){
        $last_key_data = array_key_last($data);
        $last_key_where = array_key_last($where);
        $str_data = '';
        $str_where = '';
        foreach ($data as $key => $val){
            if ($key === $last_key_data){
                $str_data .= "`$key` = '$val'";
            }
            else{
                $str_data .= "`$key` = '$val',";
            }
        }
        foreach ($where as $key => $val){
            if ($key === $last_key_where){
                $str_where .= "`$key` = '$val'";
            }
            else{
                $str_where .= "`$key` = '$val' AND ";
            }
        }
        $sql = " UPDATE `$table` SET $str_data WHERE $str_where";
        $this->query($sql);
    }
    public function delete($table,$where){
        $last_key_where = array_key_last($where);
        $str_where = '';
        foreach ($where as $key => $val){
            if ($key === $last_key_where){
                $str_where .= "`$key` = '$val'";
            }
            else{
                $str_where .= "`$key` = '$val' AND ";
            }
        }
        $sql = " DELETE FROM `$table` WHERE $str_where";
        $this->query($sql);
    }
    public function select($table,$where,$incher = '*'){
        if (is_array($where)){
            $str_where = '';
            $last_key_where = array_key_last($where);
            foreach ($where as $key => $val){
                if ($key === $last_key_where){
                    $str_where .= "`$key` = '$val'";
                }
                else{
                    $str_where .= "`$key` = '$val' AND ";
                }
            }
            $where = $str_where;
        }
        if (is_array($incher)){
            $incher = implode($incher ,',');
        }

        $sql = "SELECT $incher FROM `$table` WHERE $where";
        return $this->query($sql);
    }

    ////////////////////////  Validate  ////////////////////////


    public function clean($var){
        $var = trim($var);
        $var = stripslashes($var);
        $var = htmlentities($var);
        $var = strip_tags($var);
        return $var;
    }



    public function postValidate($data = [],$table=''){

        $isValid = true;
        foreach ($data as $key => $value){
            $conditions = explode('|',$value);
            foreach ($conditions as $val){
                if ($val === 'required'){
                    $required = $this->clean($_POST[$key]);
                    if (isset($required) && empty($required)){
                        $isValid = false;
                        $_SESSION['errors'][$key] = "$key -@ chikara datark lini";
                        header('Location: ' . $_SERVER['HTTP_REFERER']);break;
                    }
                    else{
                        $_SESSION[$key] = $required;
                    }
                }
                elseif ($val === 'string'){
                    $string = $this->clean($_POST[$key]);
                    if (isset($string) && !is_string($string)){
                        $isValid = false;
                        $_SESSION['errors'][$key] = "$key -@ chikara string chlini";
                        header('Location: ' . $_SERVER['HTTP_REFERER']);break;
                    }
                    else{
                        $_SESSION[$key] = $string;
                    }
                }
                elseif ($val === 'unique'){
                    $unique = $this->clean($_POST[$key]);
                    $query = $this->select($table,[$key=>$_POST[$key]]);
                    $count = mysqli_num_rows($query);
                    if ($count>0){
                        $isValid = false;
                        $_SESSION['errors'][$key] = "$key -@ chikara krknvi";
                        header('Location: ' . $_SERVER['HTTP_REFERER']);break;
                    }
                    else{
                        $_SESSION[$key] = $unique;
                    }
                }
                elseif ($val === 'email'){
                    $email = $this->clean($_POST[$key]);
                    if (isset($email) && !filter_var($email, FILTER_VALIDATE_EMAIL)){
                        $isValid = false;
                        $_SESSION['errors'][$key] = "$key -@ standartnerin chi hameapatasxanum";
                        header('Location: ' . $_SERVER['HTTP_REFERER']);break;
                    }
                    else{
                        $_SESSION[$key] = $email;
                    }
                }
                elseif ($val === 'password'){
                    $password = $this->clean($_POST[$key]);
                    if (isset($password) && strlen($password)<4){
                        $isValid = false;
                        $_SESSION['errors'][$key] = "$key  -@ 4 hatic avel petka lini";
                        header('Location: ' . $_SERVER['HTTP_REFERER']);break;
                    }
                    else{
                        $_SESSION[$key] = $password;
                    }
                }
                elseif ($val === 'confirmed'){
                    $keyFirst = substr($key, 8);
                    $cleanKey1 = $this->clean($_POST[$key]);
                    $cleanKey2 = $this->clean($_POST[$keyFirst]);
                    if($cleanKey1 !== $cleanKey2){
                        $isValid = false;
                        $_SESSION['errors'][$keyFirst] = "$keyFirst er@ nuyn@ chen";
                        header('location: ' . $_SERVER['HTTP_REFERER']);
                    }
                    else{
                        $_SESSION[$key] = $_POST[$key];
                    }
                }


            }
        }
        return $isValid;
    }
    public function post(){
        $data = [];
        foreach ($_POST as $key=>$value){
            if ($key === 'password'){
                $data[$key] = crypt($this->clean($_POST[$key]),'');
            }
            elseif ($key === 'confirm_password' || $key === 'submit'){
                continue;
            }
            else{
                $data[$key] = $this->clean($_POST[$key]);
            }

        }
        return $data;
    }


}

$db = new Database();