<?php
require_once("config/config.php");
require_once("config/db.php");
$title = "Login";
$url=isset($_GET['url']) ? $_GET['url'] :'login';
$url=str_replace('.php', '', $url);

require_once root('layouts/header.php');

if (!empty($_POST) && $_POST['submit'] == 'submit') {

    $username = $_POST['username'];
    // $password=md5($_POST['password']);
    $password = $_POST['password'];

    $user_select = $obj->Query("SELECT * FROM users WHERE username='$username' and password='$password'");
    print_r($user_select);

    if ($user_select) {
        $user_select = $user_select[0];
        session_start();
        $_SESSION['user-status'] = "loggedin";
        $_SESSION['uid'] = $user_select->id;
        $_SESSION['mainuser'] = $user_select->username;
        $_SESSION['user-login'] = 'true';
        echo "<script>window.location.href='" . base_url() . "'</script>";
    } else {
        $_SESSION['error'] = "Invalid username or password!";
    }
}
?>

<h4 class="mt-3 ml-4"><a href="../">&leftarrow; Back to home </a></h4>
<div style="height:10vh"></div>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6   shadow pb-4 pl-4 pr-4 pt-4">
            <h3 class="text-center"> Enter your login details</h3><br>
            <form method="post">
                <div class="form-group">
                    <label>Username</label>
                    <input type="text" name="username" class="form-control" required>
                </div>
                <div class="form-group">
                    <label>Password</label>
                    <input type="password" name="password" class="form-control" required>
                </div>


                <?php if (isset($_SESSION['error'])) { ?>
                    <div class="alert alert-danger">
                        <?php echo $_SESSION['error'];
                        unset($_SESSION['error']);  ?>
                    </div>
                <?php }  ?>




                <input type="checkbox" name="remember" <?php if (isset($_COOKIE['admin_remember']) && $_COOKIE['admin_remember'] == 'true') { ?>checked <?php } ?>> Remember Me
                <br>

                <button name="submit" value="submit" class="btn btn-block btn-info mt-3">LOGIN
                </button><br>

                <span>
                    <span class="float-left">
                        <p>Forgot Password?</p>
                    </span>
                    <span class="float-right">
                        <a href="changepw.php">Change Password

                    </span>
                </span>

            </form>
            <!--  <span>Not have an account?</span>
                     <span class="ml-4" id="myBtn" style="cursor:pointer;"><a href="#">Sign Up</a></span>
 -->
        </div>
    </div>
</div>


<!---------------Popup signup form-------------------->

<?php
if (isset($_POST['submit']) && $_POST['submit'] == "Submit") {
    unset($_POST['submit']);
    $_POST['password'] = md5($_POST['password']);
    $obj->insert("tbl_admin", $_POST);
}
?>

<style>
    .modal {
        display: none;
        /* Hidden by default */
        position: fixed;
        /* Stay in place */
    }

    /* Modal Content */
    .modal-content {
        background: #fcfcfc;
        border: none !important;
        margin: auto;
        /*padding: 20px;*/
    }
</style>
<div class="container modal" id="myModal">
    <div style="height:13vh"></div>
    <div class="modal-content">
        <div class="row justify-content-center">
            <div class="col-md-3"></div>
            <div class="col-md-6 shadow pb-4 pl-4 pr-4 pt-4">
                <h3 class="pb-4">Create a new account <span class="close"><i class="fas fa-close ml-4"></i></span></h3>
                <form action="" method="post">
                    <div class="form-group">
                        <label>Username</label>
                        <input type="text" name="username" class="form-control" required>

                    </div>

                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" name="email" class="form-control " value="" required="required">
                    </div>

                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" name="password" class="form-control " value="" required="required">
                    </div>

                    <div class="form-group">
                        <input type="submit" class="btn btn-success" name="submit" value="Submit">

                    </div>
                </form>
                <span>Already have an account?</span>
                <span class="ml-4" id="myBtn" style="cursor:pointer;"><a href="<?= base_url('admin-pannel'); ?>">Login</a></span>
            </div>
        </div>
    </div>
</div>