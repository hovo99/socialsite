<?php
include_once ('../layouts/header.php');
include_once ('../vendor/Database.php');
$fullName = $_POST['fullNameInp'];
$first_name = explode(' ',$fullName)[0];
$last_name = explode(' ',$fullName)[1];
$users = $db->select('users',['first_name'=>$first_name,'last_name'=>$last_name]);

?>
    <div class="container">
        <?php
        while ($user = mysqli_fetch_assoc($users)){ ?>
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
                    <p><?=$user['masnagitutyun'];?></p>
                    <p><?=$user['date'];?></p>
                    <div>
                        <a href="../process/addFriends.php?stacoxi_id=<?=$user['id']?>" class="btn btn-outline-primary">Add friend</a>
                        <button class="btn btn-outline-info">send massage</button>
                    </div>
                </div>

            </div>
        <?php } ?>
    </div>
<?php
include_once ('../layouts/footer.php');
?>