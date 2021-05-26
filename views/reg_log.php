<?php
session_start();
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>soc_site</title>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <!-- jQuery library -->
</head>
<body>
	<header>
		<nav class="navbar navbar-expand-lg navbar-light bg-light">
            <a class="navbar-brand" href="#">LOGO</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <form  action="../process/log_reg.php" method="post" class="form-inline my-2 my-lg-0 ml-auto">
                
                     <button class="btn btn-outline-success" type="button" name="log">
		      				<a href='views/login.php' style="text-decoration: none;">LOGIN</a>
				      </button>

				      <button class="btn  btn-outline-secondary" style="margin-left: 10px;" type="button" name="reg">
				     		<a href="index.php" style="text-decoration: none;"> REGISTRATION </a>
				  	  </button>
                </form>

         	</div>

      	</nav>

	</header>

