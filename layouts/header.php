<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Why??">

    <title>
        <?php 
        $path_parts = pathinfo("$url");    
        echo ucfirst($path_parts['filename']); ?>

        | MyRecords
    </title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <!-- Font CSS-->
    <link href="<?=base_url('layouts/vendor/font-awesome-5/css/fontawesome-all.min.css')?>" rel="stylesheet"
        media="all">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css"
        integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />

    <link href="<?=base_url('layouts/vendor/mdi-font/css/material-design-iconic-font.min.css')?>" rel="stylesheet"
        media="all">



    <!-- Main CSS-->
    <link rel="stylesheet" type="text/css" href="<?=base_url('layouts/css/bootstrap.min.css')?>">


    <!-- custom styles -->
    <link href="<?=base_url('layouts/css/theme.css')?>" rel="stylesheet" media="all">
    <link rel="stylesheet" type="text/css" href="<?=base_url('layouts/css/style.css')?>">
</head>

<body class="">
    <?php if(isset($_SESSION['user-status'])=='loggedin') { ?>
    <div class="header-mobile d-block d-lg-none">
        <div class="header-mobile__bar">
            <div class="container-fluid">
                <div class="header-mobile-inner">
                    <a class="logo-img" href="<?=base_url();?> ">
                        <img src="<?=base_url('images/logomain.jpg');?>">

                        <a href="<?=exit_url() ;?>" class="">
                            <!-- <h2 class="mobile-logo-text">Home Records</h2> -->
                        </a>
                    </a>
                    <button class="hamburger hamburger--slider" type="button">
                        <i class="fas fa-bars"></i>
                    </button>
                </div>
            </div>
        </div>
        <nav class="navbar-mobile">
            <div class="container-fluid">
                <ul class="navbar-mobile__list list-unstyled">
                    <li class="has-sub">
                        <a href="<?=base_url('index.php');?>">
                            <i class="fas fa-tachometer-alt"></i>Dashboard</a>

                    </li>



                    <li class="has-sub">
                        <a href="<?=base_url('expenditures.php');?>">
                            <i class="fas fa-arrow-to-right"></i>Expenditures</a>

                    </li>

                    <li class="has-sub">
                        <a href="<?=base_url('incomes.php');?>">
                            <i class="fas fa-arrow-to-bottom"></i>Incomes</a>

                    </li>

                    <li class="has-sub">
                        <a href="<?=base_url('internetusers.php');?>">
                            <i class="fas fa-globe"></i> Users</a>

                    </li>
                    <li>
                        <a href="<?=base_url('userpayments.php');?>">
                            <i class="fas fa-money-check-edit-alt"></i> User's Payments</a>
                    </li>

                    <li>
                        <div class="card-footer" style="background: red;">
                            <a href="<?=base_url('');?>" class="text-white">
                                <i class="fas fa-sign-out-alt"></i>Logout</a>
                        </div>
                    </li>
                </ul>
            </div>
        </nav>
    </div>

    <?php } ?>
    <script>
        setTimeout(function () {
            let alert = document.querySelector(".alert");
            alert.remove();
        }, 3000);
    </script>