<?php
if (!isset($_SESSION['user-status']) || $_SESSION['user-status'] != 'loggedin') {
  echo "<script> window.location.href='" . base_url() . "'</script>";
}

if (isset($_GET['action']) && $_GET['action'] == 'e') {
  $edit = $obj->Select("diary", "*", "id", array($_GET['id']));
  // print_r($edit);

  if (!$edit) {
    echo "<script> window.location.href='" . base_url('diary.php') . "'</script>";
  }
}

if (isset($_POST['submit'])) {
  if ($_POST['submit'] == 'update') {
    array_pop($_POST);
    $old_date =  $edit[0]['created_date'];
    $_POST['created_date'] = $old_date;

    date_default_timezone_set('Asia/Kathmandu');
    $date = date('Y/m/d h:i', time());

    $_POST['isUpdated'] =  $date;
    print_r($_POST);

    $obj->Update("diary", $_POST, "id", array($_GET['id']));
    $_SESSION['update'] = "Records updated!";
    echo "<script> window.location.href='" . base_url('diary.php') . "'</script>";
  }
}

$diar = $obj->select('diary');

?>

<style>
  .cke_chrome {
    border: none;
  }
</style>

<div class="container">
  <br class="d-lg-none">
  <div class="row">
    <div class="col-md-12 p-3">
      <div class="error">
        <!--For showing alert message -------------------------->
        <?php if (isset($_SESSION['message'])) { ?>
          <div class="alert alert-success">
            <?php echo $_SESSION['message'];
            unset($_SESSION['message']);  ?>
          </div>
        <?php }  ?>
        <!------------------------End----------------------------->
      </div>

      <div class="card-header">
        <h4 class="font-weight-bold text-secondary"><i class="fas fa-edit"></i> Edit Diary</h4>
        <div class="error">
          <!--For showing alert message -------------------------->
          <?php if (isset($_SESSION['update'])) { ?>
            <div class="alert alert-success">
              <?php echo $_SESSION['update'];
              unset($_SESSION['update']);  ?>
            </div>
          <?php }  ?>
          <!------------------------End----------------------------->
        </div>
      </div><br>

      <style>
        button {
          font-weight: bold !important;
        }

        thead {
          font-family: Roboto, sans-serif !important;
        }

        .hidden {
          display: none;
        }
      </style>
      <div class="shadow p-4" id="msg">
        <form action="" method="post" class="form-group">
          <div class="form-group">
            <label>Title</label>
            <input type="text" name="diary" class="form-control" required value="<?= $edit[0]['diary']; ?>">
            </textarea>
          </div>

          <div class="form-group">
            <label>Description</label>
            <textarea name="detail" maxlength="1000" class="form-control" placeholder="Type your memory here.." required><?= $edit[0]['detail']; ?>
               </textarea>
          </div>

          <div class="form-group d-none">
            <label for="status">Created Date</label>
            <select name="created_date" class="form-control">
              <option selected disabled>Pick a date</option>

              <?php
              $years_now = 2078;
              foreach (range($years_now, 2057) as $years) {
                echo '<option value="' . $years . '">' . $years . '</option>';
              }
              ?>

            </select>
          </div>

          <button class="btn btn-block btn-success" name="submit" value="update">Update</button>

        </form>
      </div>
    </div>
  </div>
</div>


<script src="../../../ganeshnp17/assets/ckeditor/ckeditor.js"></script>

<script>
  CKEDITOR.replace('detail');
</script>