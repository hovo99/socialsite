<?php
include_once ("../layouts/header.php");
require_once ("../vendor/Functions.php");
require_once ("../vendor/Database.php");
if (isset($_SESSION['user_id'])){
    $id = $_SESSION['user_id'];
}
else{
    header('location:login.php');die;
}
$data = $db->select('users',['id'=>$id]);
$d = $db->query("select * from friends where uxarkoxi_id=".$id." or stacoxi_id=".$id);

$ids = [];

$wh = " ";
while ($idu = mysqli_fetch_assoc($d))
{
    $r = $idu["uxarkoxi_id"] == $id ? $idu["stacoxi_id"] : $idu["uxarkoxi_id"];
    array_push($ids, $r);

    $wh = $wh . "|| user_id=". $r;
}

$str2 = substr($wh, 3);

//var_dump($str2);
$user = mysqli_fetch_assoc($data);
$posts = $db->query("select * from posts where ". $str2);
$d = $db->select('posts',$ids);
if($posts && mysqli_num_rows($posts) > 0)
{
    $num = mysqli_num_rows($posts);

} else {
    $num= 0;
}
?>

<div class="container">
    <div class="row">
        <div class="col-md-4" id='avatar' >
            <label for="avatarInput">
            <?php 
               if($user['avatar'] == null) {
                 if ($user['gender'] === 'male') { ?>
                     <div id="img">
                         <img class="img-fluid"
                              src="https://t4.ftcdn.net/jpg/02/14/34/09/500_F_214340987_iYuLVLrP61oepILx6yiUTOO7xsdvmX9K.jpg"
                              alt="">
                     </div>

                    <?php } else {
                        ?>
                     <div id="img">
                         <img src="https://as2.ftcdn.net/jpg/02/45/35/17/500_F_245351750_F7K6hcH5ERl9WIlAFdz1OhvGyCmPGuZL.jpg" alt="">
                     </div>

                    <?php };
              }
               else { ?>
                   <div id="img">
                       <img src="../img/photos/<?=$user['avatar'] ?>" alt="" class="img-fluid">
                   </div>
               <?php } ?>
            </label>
            <div class="row">
                <input class="d-none" type="file" id="avatarInput">
                <input type="hidden" id="old_avatar" name="old_avatar" value="<?=$user['avatar']?>">
            </div>
        </div>
        <div class="col-md-6 text-center">
            <h1 id="FullName"><?=$user['first_name'].' '.$user['last_name']?></h1>
            <h2 id="country"><?='Country: ' .  $user['country']?></h2>
            <h2 id="masnagitutyun"><?='Profession: '. $user['masnagitutyun']?></h2>
            <h2 id="gender"><?='Gender: '.  $user['gender']?></h2>
            <h2 id="date"><?=$user['date']?></h2>
            <p id="age">
                <?php
                $userBday = $user['date'];
                $bday = new DateTime($userBday);
                $now = new DateTime();
                $difference = $now->diff($bday);
                $age = $difference->y;
                echo '( '.$age.' years old)';
                ?>
            </p>



        <!-- Button to Open the Modal -->
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#EditProfile">
                    Edit Profile
                </button>

                <!-- The Modal -->
                <div class="modal fade" id="EditProfile">
                    <div class="modal-dialog">
                        <div class="modal-content">

                            <!-- Modal Header -->
                            <div class="modal-header">
                                <h4 class="modal-title">Modal Heading</h4>
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                            </div>

                            <!-- Modal body -->
                            <div class="modal-body">
                                <form id="editProfileForm">
                                      <div class="form-group">
                                        <label for="first_name">First Name:</label>
                                        <input name="first_name" type="text" class="form-control" id="first_name" value="<?=$user['first_name']?>">
                                        <p id="f_n_e" class="text-danger"></p>
                                    </div>
                                    <div class="form-group">
                                        <label for="last_name">Last Name:</label>
                                        <input name="last_name" type="text" class="form-control" id="last_name" value="<?=$user['last_name']?>">
                                        <p id="l_n_e" class="text-danger"></p>
                                    </div>
                                    <div class="form-group">
                                        <label for="country">Country</label>
                                        <input type="text" name="country" class="form-control" id="country" value="<?=$user['country']?>">
                                        <p id="cot_e" class="text-danger"></p>
                                    </div>
                                    <div class="form-group">
                                        <label for="date">Date:</label>
                                        <input type="text" name="date" class="form-control" id="date" value="<?=$user['date']?>">
                                        <p id="dat_e" class="text-danger"></p>
                                    </div>       
                                    <div class="form-group">
                                        <label for="email">Email:</label>
                                        <input type="email" name="email" class="form-control" id="email" value="<?=$user['email']?>">
                                        <p id="e_e" class="text-danger"></p>
                                    </div> 
                                     <div class="form-group">
                                        <label for="password">Password:</label>
                                        <input type="password" name="password" class="form-control" id="password">
                                        <p id="p_e" class="text-danger"></p>
                                    </div>
                                     <div class="form-group">
                                        <label for="c_pass">Confirm Password:</label>
                                        <input type="password" name="c_pass" class="form-control" id="c_pass">
                                        <p id="p_e" class="text-danger"></p>
                                    </div>

                                    <input type="submit" class="btn btn-outline-success" value="Edit">
                                </form>
                            </div>

                            <!-- Modal footer -->
                            <div class="modal-footer">
                                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                            </div>

                        </div>
                    </div>
                </div>
        </div>
    </div>


    <hr>
    <div class="row">
            <?php
//            $p_u = $db->select('posts', ['id' => $_POST["userId"]]);

            if( $num > 0 )
            while ($post = mysqli_fetch_assoc($posts)) {
                ?>
                <?php
                $users = $db->select('users',['id'=>$post['user_id']]);
                $user = mysqli_fetch_assoc($users);
                ?>
            <div class="col-md-4">
                <h1><?= $post['title'] ?></h1>
                <h3><?= $post['content'] ?></h3>
                <?php if ($post['img'] != null) { ?>
                    <img src="../img/posts/<?=$post['img']?>" alt="" class="img-fluid">
                <?php } else { ?>
                    <img src="../img/posts/no-image.png" alt="" class="img-fluid">
                <?php };
                $query_like = $db->select('post_like',['post_id'=>$post['id']]);
                $num_like = mysqli_num_rows($query_like);
                ?>
                <h5><?= $user["first_name"] . ' '. $user["last_name"] ?></h5>
                <div style="display: flex">
                    <i class="fas fa-heart like" data-postLike="<?=$post['id']?>" style="font-size: 20px; color: red; cursor: pointer;">Like <?=$num_like?></i>
                </div>
            </div>
            <?php }; ?>
    </div>
</div>

<?php
include_once("../layouts/footer.php")
?>

