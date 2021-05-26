<?php
include_once '../vendor/Database.php';
if (isset($_SESSION['user_id'])){
    $id = $_SESSION['user_id'];
}
else{
    header('location:../views/login.php');
}
$query = $db->select('users',['id'=>$id]);
$user = mysqli_fetch_assoc($query);
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>soc_site</title>
    <!-- <link rel="stylesheet" type="text/css" href="/style/style.css"> -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
 

    <!-- jQuery library -->
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="/resources/demos/style.css">
</head>
<body>
	<header>
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <a class="navbar-brand" href="../views/home.php?>">Soc-Site</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <form class="form-inline my-2 my-lg-0 ml-auto" action="../views/search.php" method="post">
                    <input name="fullNameInp" id="searchInp" class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
                    <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
                </form>
                <ul class="navbar-nav ml-auto" style="font-family: cursive;">
                    <li class="nav-item">
                        <a class="nav-link" href="../views/home.php">
                            <div>
                                <?php
                                if($user['avatar'] == null) {
                                    if ($user['gender'] === 'male') { ?>
                                        <img src="https://t4.ftcdn.net/jpg/02/14/34/09/500_F_214340987_iYuLVLrP61oepILx6yiUTOO7xsdvmX9K.jpg"
                                             alt=""  width='40' height="40" class="rounded-circle img-fluid">
                                    <?php } else {
                                        ?>
                                        <img src="https://as2.ftcdn.net/jpg/02/45/35/17/500_F_245351750_F7K6hcH5ERl9WIlAFdz1OhvGyCmPGuZL.jpg" alt=""  width='40' height="50" class="rounded-circle img-fluid">
                                    <?php };
                                }
                                else { ?>
                                        <img src="../img/photos/<?=$user['avatar'] ?>" alt="" width='40' height="40" class="rounded-circle img-fluid">
                                    <?php
                                }
                                ?>
                            </div>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../views/posts.php"> My Posts</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../views/hamalsaran.php">Hamalsaran</a>
                    </li>
                    <li class="nav-item">
                       <a class="nav-link" href="../views/fotos.php">Photos</a>
                    </li> 
                    <li class="nav-item">
                       <a class="nav-link" href="../views/addFriends.php">Friends</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../views/FriendRequest.php">Friend Requests</a>
                    </li>
                    <li class="nav-item">
                       <a class="nav-link" href="../views/message-list.php">Message</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <?=$user['first_name']?> <?=$user['last_name']?>
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="#"><?=$user['email']?></a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="../process/logout.php">LOGOUT</a>
                        </div>

                    </li>
                </ul>

            </div>
        </nav>
	</header>
