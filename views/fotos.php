<?php
include_once ('../layouts/header.php');
include_once '../vendor/Functions.php';
include_once '../vendor/Database.php';
?>
<style>
    .formInputt {
      border: 2px solid gray;
      background-image: linear-gradient(70deg, blue 35%, #000 65%);
      color: white;
      border-radius: 8px;
    }
   .formInputt:hover{
        background-image: linear-gradient(70deg, #000 35%, blue 65%);
    }
</style>
<section>
    <div class="contenier">
        <form  class="ml-3 " action="../process/fotos.php" method="post" enctype="multipart/form-data">

            <label for="Chpotos"  class="btn btn-outline-primary "> Choose Photo </label>
            <input type="file"  multiple class=" mt-3 d-none " name="img[]" id="Chpotos">

            <input type="submit" name="submit" class="mt-2 mb-3 formInputt btn btn-success " value="add">

        </form>
<div class="row ">
    <?php
        $query = $db->select('photos',[
        'user_id' => $id
        ]);
        if($query){
           while ($row = mysqli_fetch_assoc($query)){ ?>
             <div class="col-md-3 mt-3">
                 <img class="img-fluid" src="../img/photos/<?=$row['name']?>">
                 <button class="btn btn-outline-danger mt-2" data-toggle="modal" data-target="#delete<?=$row['id']?>">Delete</button>

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
                                <a href="../process/deleteFromPhotos.php?post_id=<?=$row['id']?><?php if (!empty($row['img'])){ echo '&img='.$row['img']; } ?>" class="btn btn-success text-white">Yes!</a>
                                <button type="button" class="btn btn-danger" data-dismiss="modal">No!</button>
                            </div>

                        </div>
                    </div>
                </div>
                 <a href="../process/changeAvatarFromPhotos.php?user_id=<?=$id?>&name=<?=$row['name']?>">
                     <button class="btn btn-outline-success mt-2">Change Avatar</button>
                 </a>


            </div>
    <?php }
        }  
       ?>         
     </div>
    </div>
</section>
<?php
include_once ('../layouts/footer.php');
?>

