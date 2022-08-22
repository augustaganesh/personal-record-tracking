<?php  
 require_once ("config/config.php");
require_once ("config/db.php");
require_once root('layouts/header.php');

if (isset($_POST['submit'])) {
        if ($_POST['submit']=='submit') {
               array_pop($_POST);
       
               $obj->Update("users",$_POST,"id",array($_GET['id']));
               $_SESSION['message']="Password Changed!";

            //    echo "<script> window.location.href='".base_url('changepw.php')."'</script>";
           }
       }
?>

<h4 class="mt-3 ml-4"><a href="<?=base_url('');?>">&leftarrow; Back to home </a></h4>
<div style="height:10vh"></div>

<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-6   shadow pb-4 pl-4 pr-4 pt-4">
      <h3 class="text-center"> Change Password</h3>
      <div class="error">
        <!--For showing alert message -------------------------->
        <?php if (isset($_SESSION['message'])) { ?>
        <div class="alert alert-success my-2">
          <?php echo $_SESSION['message'];unset($_SESSION['message']);  ?>
        </div>
        <?php }  ?>
        <!------------------------End----------------------------->
      </div>
      <hr>
      <form method="post">

        <div class="form-group">
          <label>Enter a new password</label>
          <input type="password" name="password" class="form-control" required id="Visible">
        </div>

        <div class="form-group">
          <label>Confirm Password</label>
          <input type="password"  class="form-control" id="cpassword" onkeyup='check();'>
        </div>



        <?php if (isset($_SESSION['error'])) { ?>
        <div class="alert alert-danger">
          <?php echo $_SESSION['error'];unset($_SESSION['error']);  ?>
        </div>
        <?php }  ?>

        <span>
          <span class="text-secondary float-left">
            <input type="checkbox" onclick="showMe();" style="padding:40px 60px;"> Show Password
          </span>
          <span class="float-right">
            <input type="checkbox" name="remember"
              <?php if(isset($_COOKIE['admin_remember']) && $_COOKIE['admin_remember'] == 'true'){ ?>checked <?php }?>>
            Remember Me
          </span>
        </span>


        <br>

        <button name="submit" value="submit" class="btn btn-block btn-info mt-3" return onclick="function()">Change
        </button>
      </form>
    </div>
  </div>
</div>


<!---------------Popup signup form-------------------->

<?php
        // if(isset($_POST['submit']) && $_POST['submit'] == "Submit"){
        //         unset($_POST['submit']);
        //         $_POST['password'] = md5($_POST['password']);
        //         $obj->insert("tbl_admin",$_POST);
        //     }
            ?>



<script>
function showMe() {
  var x = document.getElementsByName('Visible');
  console.log(x);
  console.log(x.type);
  if (x.type == "password") {
    x.type = "text";


  } else {
    x.type = "password";
  }

}
</script>
