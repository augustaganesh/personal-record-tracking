<?php 

if(empty($_GET['id'])){
  echo '<script>alert("An error occured!")</script>';
  header("Location: diary.php");
  exit;
}

$diarDet = $obj->select('diary','*','id',array($_GET['id']));
?>

<div class="container">
  <br>
<a href="diary.php" class="text-decoration-none"><i class="fas fa-long-arrow-left"></i> Go Back</a>
  <div class="row">
    <div class="col-md-12 p-3">
      <?php if($diarDet){ ?>
        <div class="card">
        <div class="card-header bg-info">
          <h4 class=" font-weight-bold pb-2 text-left text-white" style="font-size:1.3rem;">Diary : <?=$diarDet[0]['diary'];?>
          </h4>
          <span class="float-right text-light">Created on:  <?=$diarDet[0]['created_date'];?></span>

          
        </div>
        <div class="card-body bg-light">
        <?=$diarDet[0]['detail'];?>
        </div>
        

    </div>

    <?php }else{ ?>
    <p style="color:red;margin-top:90vh">Opps! Sorry, your diary's empty!</p>

    <?php } ?>
  </div>
</div>

