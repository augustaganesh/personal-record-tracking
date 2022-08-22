<?php
ob_start();
session_start();

if ($_SESSION['user-status']!="loggedin") {
	header("Location:login.php");
	exit();
}
require_once ("config/config.php");
require_once ("config/db.php");

$url=isset($_GET['url']) ? $_GET['url'] :'home';

$url=str_replace('.php', '', $url);

$url.='.php';

$pagePath=root('pages/'.$url);

require_once root('layouts/header.php');
 
require_once root('layouts/sidebar.php');
if(file_exists($pagePath) && is_file($pagePath)){ ?>

	 <div class="page-container">
           
            <!-- MAIN CONTENT-->
            <div class="main-content">
                <div class="section__content section__content--p30">
                    <div class="container-fluid">
	<?php
	require_once $pagePath;

	?>
					</div>
      			 </div>
            </div>
            <!-- END MAIN CONTENT-->
            <!-- END PAGE CONTAINER-->
        </div>
	<?php

}else {
	
	echo "<h2 style='position:fixed;top:20%;left:25%;color:darkred;'>Error 404!<br>Page not found</h2>";

}
require_once root('layouts/footer.php');
