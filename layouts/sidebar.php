<?php
if (isset($_POST['submit'])) {
    if ($_POST['submit']=='submit') {
           array_pop($_POST);
   
           $obj->Update("users",$_POST,"id",array($_GET['id']));
           $_SESSION['message']="Password Changed!";

        //    echo "<script> window.location.href='".base_url('changepw.php')."'</script>";
       }
   }
?>

<aside class="menu-sidebar shadow d-none d-lg-block">
  <div class="logo">
    <a href="<?=base_url('index.php');?>" class="text-dark font-weight-bold" style="font-size: 1.2rem;">
      <img src="<?=base_url('images/logomain.jpg');?>" class="img-fluid rounded-circle col-sm-4"><span style="color:#000080 !important">My</span> <span class="text-info">Records</span></a>
  </div>
  <div class="menu-sidebar mt-5 content js-scrollbar1">
    <nav class="navbar-sidebar">
      <ul class="list-unstyled navbar__list">
        <li class="active has-sub">
          <a class="mt-20" href="<?=base_url('index.php');?>">
            <i class="fas fa-home"></i>Home</a>
        </li>


        <li>
          <a href="<?=base_url('expenditures.php');?>">
            <i class="fas fa-arrow-to-right"></i>Expenditures</a>
        </li>

        <li>
          <a href="<?=base_url('incomes.php');?>">
            <i class="fas fa-arrow-to-bottom"></i>Incomes</a>
        </li>


        <li>
          <a href="<?=base_url('documents.php');?>">
            <i class="fas fa-file"></i>Documents</a>
        </li>

        <li>
          <a href="<?=base_url('diary.php');?>">
            <i class="fas fa-book-alt"></i>Diaries</a>
        </li>
      </ul>
    </nav>
  </div>
</aside>
<!-- END MENU SIDEBAR-->
<div class="page-container">
  <!-- HEADER DESKTOP-->
  <div class="header-desktop">
    <div class="bg-white position-absolute" style="left:25%">
      <h3 class="text-center text-dark font-weight-bold">
        <marquee scrollamount="4">Always be updated !</marquee>

      </h3>
    </div>
    <div class="dropdown p-2 float-right pr-4">
      <button class="btn dropdown-toggle text-dark" type="button" id="dropdownMenuButton" data-toggle="dropdown"
        aria-haspopup="true" aria-expanded="false">
        <?php 
        $admin = $obj->Select("users","*","username",array($_SESSION['mainuser'])); ?>

        <?php foreach ($admin as $key => $value): ?>
        <?=$value['username']?>
        <?php endforeach; ?>



      </button>
      <style>
      .hahh a:hover {
        color: #a00;
        background: #fff !important;


      }

      .modal-backdrop {
        position: relative;
      }
      </style>

      <!-- Button trigger modal -->
     

      <form method="post">

      <!-- Modal -->
      <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content shadow">
            <div class="modal-body">
              <div class="card-header bg-info">
                <h4 class="text-white text-center">Change Password</h4>
              </div><br>
                <div class="form-group">
                  <label>Enter a new password</label>
                  <input type="password" name="password" class="form-control" required id="Visible">
                </div>

                <div class="form-group">
                  <label>Confirm Password</label>
                  <input type="password" class="form-control" id="cpassword" onkeyup='check();'>
                </div>

                <span>
                  <span class="text-secondary float-left">
                    <input type="checkbox" onclick="showMe();" style="padding:40px 60px;"> Show Password
                  </span>
                  <span class="float-right">
                    <input type="checkbox" name="remember"
                      <?php if(isset($_COOKIE['admin_remember']) && $_COOKIE['admin_remember'] == 'true'){ ?>checked
                      <?php }?>>
                    Remember Me
                  </span>
                </span>

            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
              <button class="btn btn-primary" name="submit" value="submit">Change</button>
            </div>
          </div>
          </form>
        </div>
      </div>
      <div class="dropdown-menu hahh" aria-labelledby="dropdownMenuButton">
      <a class="dropdown-item" data-toggle="modal" data-target="#exampleModalCenter" style="cursor:pointer;">
        Change Password
      </button>
        <a class="dropdown-item" href="<?=base_url('changepw.php?action=d&id='.$value['id'])?>">Change
          password</a>
        <a class="dropdown-item" href="<?=base_url('logout.php');?>">Logout</a>
      </div>
    </div>

  </div>
</div>
<div>

  <script>
  setTimeout(function() {
    let alert = document.querySelector(".alert");
    alert.remove();
  }, 3000);
  </script>