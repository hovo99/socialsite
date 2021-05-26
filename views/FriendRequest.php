<?php
include_once ('../layouts/header.php');
include_once ('../vendor/Database.php');
$query = $db->select('friend_request',['stacoxi_id'=>$id]);
$num=mysqli_num_rows($query);
?>
<div class="container">
    <?php if( $num > 0 ){ ?>
        <?php while ($row = mysqli_fetch_assoc($query)) { ?>
            <?php
            $users = $db->select('users',['id'=>$row['uxarkoxi_id']]);
            $user = mysqli_fetch_assoc($users);
            ?>
            <div class="row">
                <div class="col-md-4">
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
                </div>
                <div  class="col-md-8 pl-5 mt-5" style="font-family: cursive; font-size: 20px; font-weight: bolder;">
                    <p ><?=$user['first_name'].' '.$user['last_name'];?></p>
                    <p><?=$user['email'];?></p>
                    <p><?=$user["masnagitutyun"];?></p>
                    <p><?=$user['date'];?></p>
                    <div class="row">
                        <div class="col-md-1">
                            <a href="../process/answer.php?request=yes&uxarkoxi_id=<?=$row['uxarkoxi_id']?>" class="btn btn-outline-success">yes</a>
                        </div>
                        <div class="col-md-1">
                            <a href="../process/answer.php?request=no&uxarkoxi_id=<?=$row['uxarkoxi_id']?>" class="btn btn-outline-danger">no</a>
                        </div>
                    </div>
                </div>

            </div>
        <?php } ?>
    <?php }
    else { ?>
        <h1 class="text-center">no result</h1>
    <?php } ?>
</div>
<?php
include_once ('../layouts/footer.php');
