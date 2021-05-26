<?php
define('HOST', 'localhost');
define('USER', 'root');
define('PASSWORD', '');
define('DBNAME', 'soc-site');

$connect = mysqli_connect(HOST, USER, PASSWORD, DBNAME);

function dd($arr){
	echo "<pre>";
	print_r($arr);
	echo "</pre>"; die;
}

function d($arr){
	echo "<pre>";
	print_r($arr);
	echo "</pre>";
}

function clean($var){
	$var = trim($var);
	$var = stripcslashes($var);
	$var = htmlentities($var);
	return $var;
}

?>