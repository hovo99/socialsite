<?php
include_once ('../views/log_reg.php');
include_once '../vendor/Functions.php';
?>
<style>
    body{
        margin: 0;
        padding: 0;

        background-image: url('../style/img/login.jpg');
        background-size: cover;
        background-repeat: no-repeat;
    }
</style>
<div class="container">
    <div class="row">
        <div class="col-md-4"></div>
        <div class="col-md-4" style="margin-top: 5%;">
            <form action="../process/login.php" method="post">
                <?php if (isset($_SESSION['error'])): ?>
                    <h2 style="color: red;font-weight: bold;"><?=$_SESSION['error']?></h2>
                <?php
                unset($_SESSION['error']);
                endif; ?>
                <h2>LOGIN</h2>
                <div class="form-group">
                    <label for="email">Email address:</label>
                    <input type="email" class="form-control" id="email" name="email" value="<?php if(isset($_SESSION['email'])){ print ($_SESSION['email']); unset($_SESSION['email']);} else{
                        print(null);}
                     ?>" autocomplete="off">
                    <?php if(isset($_SESSION['email_e'])) { ?>
                        <p> <?php $_SESSION['email_e'] ?> </p>
                    <?php unset($_SESSION['email_e']);} ?>
                </div>
                <div class="form-group">
                    <label for="pwd">Password:</label>
                    <input type="password" class="form-control" id="pwd" name="password">
                </div>
                <div class="form-group form-check">
                    <label class="form-check-label">
                        <input class="form-check-input" type="checkbox"> Remember me
                    </label>
                </div>
                <button type="submit" name="login" class="btn btn-primary">Login</button>
            </form>
        </div>
        <div class="col-md-4"></div>
    </div>
</div>
<?php
include_once ('../layouts/footer.php');
?>