<?php
include_once ('../layouts/header.php');
include_once '../vendor/Functions.php';
include_once '../vendor/Database.php';
$f->isSignedIn();
?>

<form action="../process/posts.php" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label for="usr">Title:</label>
        <input type="text" class="form-control" id="usr" name="title" value="<?php if (isset($_SESSION['ti'])){ echo $_SESSION['ti']; unset($_SESSION['ti']);} ?>">
        <?php
        if (isset($_SESSION['ti_e'])){?>
            <div class="alert alert-danger alert-dismissible fade show">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                <strong>Error!</strong> <?php echo $_SESSION['ti_e'];unset($_SESSION['ti_e']); ?>
            </div>
        <?php }?>
    </div>
    <input type="file" class="btn-secondary" name="img" multiple>
    <?php
    if (isset($_SESSION['img_e'])){
        echo $_SESSION['img_e'];
        unset($_SESSION['img_e']);
    }
    ?>
    <div class="form-group">
        <label for="content">Comment:</label>
        <textarea class="form-control" rows="5" id="content" name="content"><?php if (isset($_SESSION['con'])){ echo $_SESSION['con']; unset($_SESSION['con']); } ?></textarea>
        <?php
        if (isset($_SESSION['con_e'])){?>
            <div class="alert alert-danger alert-dismissible fade show">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                <strong>Error!</strong> <?php echo $_SESSION['con_e'];unset($_SESSION['con_e']); ?>
            </div>
        <?php }?>
    </div>

    <button type="submit" class="btn btn-primary" name="sub">Post</button>

</form>
<hr>
<?php
if (isset($_GET['page'])){
    $page = $_GET['page'];
}
else{
    $page = 0;
}
$query = $db->select('posts',['user_id'=>$id]);
if ($query){
//    $num = mysqli_num_rows($query);
//    $one_page_num = ceil($num/6);
//    $sql = "SELECT * FROM `posts` WHERE `user_id`='$id' ORDER BY `id` DESC LIMIT ".$page.",6 ";
//    $query = mysqli_query($connect,$sql);
?>
    <div class="row">
        <?php
        while ($row = mysqli_fetch_assoc($query)){
            ?>
            <div class="col-md-4">
                <h3><?=$row['title']?></h3>
                <?php
                if ($row['img'] != null){
                    ?>
                    <!-- Button to Open the Modal -->

                    <img class="img-fluid" src="../img/posts/<?=$row['img']?>" alt="nakar" data-toggle="modal" data-target="#big_img<?=$row['id']?>">


                    <!-- The Modal -->
                    <div class="modal bd-example-modal-lg fade" id="big_img<?=$row['id']?>">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">

                                <!-- Modal Header -->
                                <div class="modal-header">
                                    <h4 class="modal-title">Modal Heading</h4>
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                </div>

                                <!-- Modal body -->
                                <div class="modal-body">
                                    <img class="img-fluid" src="../img/posts/<?=$row['img']?>" alt="nakar">
                                </div>

                                <!-- Modal footer -->
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                </div>

                            </div>
                        </div>
                    </div>
                <?php }
                else {?>
                    <!-- Button to Open the Modal -->

                    <img class="img-fluid" src="../img/posts/no-image.png" alt="nakar" data-toggle="modal" data-target="#big_img<?=$row['id']?>">


                    <!-- The Modal -->
                    <div class="modal fade" id="big_img<?=$row['id']?>">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">

                                <!-- Modal Header -->
                                <div class="modal-header">
                                    <h4 class="modal-title">Modal Heading</h4>
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                </div>

                                <!-- Modal body -->
                                <div class="modal-body">
                                    <img class="img-fluid" src="../img/posts/no-image.png" alt="nakar">
                                </div>

                                <!-- Modal footer -->
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                </div>

                            </div>
                        </div>
                    </div>

                <?php } ?>
                <h5 class="content"><?=$row['content']?></h5>


                <!-- Button to Open the Modal -->
                <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#delete<?=$row['id']?>">
                    Delete
                </button>

                <!-- The Modal -->
                <div class="modal fade" id="delete<?=$row['id']?>">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">

                            <!-- Modal Header -->
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                            </div>

                            <!-- Modal body -->
                            <div class="modal-body">
                                Are you sure you want to delete the photo?
                            </div>

                            <!-- Modal footer -->
                            <div class="modal-footer">
                                <a href="../process/delete.php?post_id=<?=$row['id']?><?php if (!empty($row['img'])){ echo '&img='.$row['img']; } ?>" class="btn btn-success text-white">Ok</a>
                                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                            </div>

                        </div>
                    </div>
                </div>
                <button type="button" class=" btn btn-primary" data-toggle="modal" data-target="#edit<?=$row['id']?>">
                    Edit
                </button>
                <?php
                $query_like = $db->select('post_like',['user_id'=>$id,'post_id'=>$row['id']]);
                $num_like = mysqli_num_rows($query_like);
                ?>
                <div style="display: flex">
                    <i class="fas fa-heart like" data-postLike="<?=$row['id']?>" style="font-size: 20px; color: red; cursor: pointer;">Like <?=$num_like?></i>
                </div>
                <h1 class=" text-success "><?php if(isset($_SESSION['editEnd'])){
                        echo $_SESSION['editEnd'];
                        unset($_SESSION['editEnd']);
                    } ?></h1>
                <h1 class=" text-denger "><?php if(isset($_SESSION['editEndError'])){
                        echo $_SESSION['editEndError'];
                        unset($_SESSION['editEndError']);
                    } ?></h1>
            </div>
            <!-- Modal body -->
            <div class="modal fade" id="edit<?=$row['id']?>">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <!-- Modal body -->
                        <div class="modal-body ">
                            <form action="../process/edit.php" method="post" >
                                <input type="text" value="<?=$row['title']?>" class="ed_input mb-2" name="changetitle">
                                <?php if (isset($row['img']) !== null && !empty($row['img'])){ ?>
                                    <img src="../img/posts/<?=$row['img']?>" alt="Sorry Technical Problem. Image could not be uploaded." class="img-fluid">
                                <?php }  ?>
                                <textarea class="ed_input" name="changecontent"><?=$row['content']?></textarea>
                        </div>

                        <!-- Modal footer -->
                        <div class="modal-footer">
                            <input name="idpost" value="<?=$row['id']?>" class="d-none">
                            <input type="submit" name="editpost" class="btn btn-secondary btn-success " value="Edit">
                            </form>
                            <button type="button" class="btn  btn-primary" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
        <?php }?>
    </div>
<?php }
else{
    echo 'ayjm poster chkan';
}


?>
<?php
include_once ('../layouts/footer.php');
?>