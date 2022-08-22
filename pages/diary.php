<?php
if (!isset($_SESSION['user-status']) || $_SESSION['user-status'] != 'loggedin') {
  echo "<script> window.location.href='" . base_url() . "'</script>";
}

$uid = $_SESSION['uid'];

if (isset($_GET['action'])) {
  if ($_GET['action'] == 'd') {
    $obj->Delete("diary", "id", array($_GET['id']));
    $_SESSION['delete'] = "Records deleted!";
    echo "<script> window.location.href='" . base_url('diary.php') . "'</script>";
  }
}

if (isset($_POST['submit'])) {
  unset($_POST['submit']);
  $_POST['uid'] = $uid;
  $check_diary =  $_POST['diary'];
  $check_detail = $_POST['detail'];

  $check = $obj->Query("SELECT * FROM diary WHERE diary='$check_diary'and detail='$check_detail' and uid='$uid'");

  if ($check) {
    echo "<script>alert('Notice Error! : Record already added');</script>";
    echo "<script> window.location.href=''</script>";
  } else {
    $a = $obj->Insert("diary", $_POST);
    if ($a) {
      $_SESSION['message'] = "Your diary is added!";
    } else {
      echo "<script>alert('Error! Data is not added');</script>";
    }
  }
}

$diar = $obj->select('diary', '*', 'uid', array($uid));

?>

<div class="container">
  <br>
  <div class="row">
    <div class="col-md-6 p-3">
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

      <button class="btn btn-dark" onclick="showFunction()"><i class="fas fa-plus"></i> Add new event</button>

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
      <div class="hidden shadow p-4" id="msg">
        <form action="" method="post" class="form-group">
          <div class="form-group">
            <label>Title</label>
            <input type="text" name="diary" class="form-control" required>
            </textarea>
          </div>

          <div class="form-group">
            <label>Description</label>
            <textarea name="detail" rows="4" maxlength="1000" class="form-control" placeholder="Type your memory here.." required></textarea>
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

          <div class="form-group mb-2 hidden">
            <label>Issued Date</label>
            <input type="hidden" name="created_date" value="<?php date_default_timezone_set('Asia/Kathmandu');
                                                            $date = date('Y/m/d h:i a', time());
                                                            echo $date; ?>">
          </div>



          <button class="btn btn-block btn-success w-25" name="submit" value="add">Add</button>

        </form>
      </div>
    </div>

    <div class="col-md-12">
      <div class="table-responsive">
        <table class="table table-hover table-bordered table-responsive-lite" id="diaryAayo">
          <div class="card-header bg-info">
            <h4 class="font-weight-bold pb-2 text-center text-white" style="font-size:1.3rem;">My Diaries
              <span class="float-right">
                <input type="text" class="form-control" name="search" id="mysearch" placeholder="&#128270; search your diary...">
              </span>
            </h4>
            <div class="error">
              <!--For showing alert message ----------->
              <?php if (isset($_SESSION['delete'])) { ?>
                <div class="alert alert-success mt-2">
                  <?php echo $_SESSION['delete'];
                  unset($_SESSION['delete']);  ?>
                </div>
              <?php }  ?>
            </div>

          </div>

          <div class="p-2 mx-1 horizantal-scroll">
            <?php
            //display only year from date
            $z = $obj->Query("SELECT * from diary where uid = '$uid' order by created_date asc");
            if ($z) {
              $zz = $z[0]->created_date;
              $yearOnly = date('Y', strtotime($zz));
            }

            ?>

            <ul class="d-flex list-unstyled">
              <?php if ($diar) { ?>

                <?php
                $years_now =  date('Y');
                $loopCounter = sizeof(range($years_now, $yearOnly));
                $idx = 0;

                foreach (range($years_now, $yearOnly) as $years) { ?>
                  <li><button onClick="filterDiary('<?= $years ?>','<?= $idx++ ?>');" class="btn border border-dark mr-2" style="background-color: #e9e9ff;"><?= $years ?></button></li>
                <?php } ?>


              <?php } ?>


            </ul>

          </div>


          <?php if ($diar) { ?>
            <thead>
              <tr style="background: #f9f9f9;">
                <th>SN</th>
                <th>Title</th>
                <th>Created Date</th>
                <th colspan="3" class="text-center">Action</th>
              </tr>
            </thead>

            <tbody>
              <?php foreach ($diar as $key => $value) : ?>
                <tr>
                  <td><?= ++$key ?></td>
                  <td><?= $value['diary']; ?></td>
                  <td class="text-nowrap">
                  <?php if (!empty($value['isUpdated'])) { ?>
                      <small><i>Updated : <?= $value['isUpdated']; ?></i></small> &nbsp;&nbsp;&nbsp;
                      <small><i class="fal fa-clock text-body" title="<?= $value['created_date']; ?>"></i></small>

                    <?php } else { ?>
                      <small><?= $value['created_date']; ?></small><?php } ?>
                  </td>
                 
                  <td><a href="<?= base_url('diarydetail.php?id=' . $value['id']) ?>" class="text-decoration-none text-dark"><i class="fas fa-eye"></i> Detail</Details></a></td>
                  <td class="text-center"><a href="<?= base_url('editdiary.php.php?action=e&id=' . $value['id']) ?>" class="btn btn-outline-info btn-sm" onclick="return confirm('Are you sure you want to edit?')"><i class="far fa-edit"></i></a>
                  </td>

                  <td class="text-center"><a href="<?= base_url('diary.php?action=d&id=' . $value['id']) ?>" class="btn btn-outline-danger btn-sm" onclick="return confirm('Are you sure you want to delete?')"><i class="far fa-trash-alt"></i></a></td>
                </tr>
              <?php endforeach; ?>

            </tbody>
          <?php } else { ?>
            <p style="color:red">Opps! Sorry, your diary's empty!</p>

          <?php } ?>
        </table>
      </div>
    </div>
  </div>
</div>
</div>
<script>
  function showFunction() {
    var div = document.getElementById("msg");
    div.classList.toggle('hidden');
  }
</script>


<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" referrerpolicy="no-referrer"></script>
<script>
  $("#mysearch").keyup(function() {
    var value = this.value.toLowerCase().trim();

    $("table tr").each(function(index) {
      if (!index) return;
      $(this).find("td").each(function() {
        var id = $(this).text().toLowerCase().trim();
        var not_found = (id.indexOf(value) == -1);
        $(this).closest('tr').toggle(!not_found);
        return not_found;
      });
    });
  });
</script>


<script>
  function filterDiary(data, i) {
    let counter = "<?= $loopCounter; ?>";


    $.ajax({
        type: "POST",
        url: 'filter-diary.php',
        data: {
          tag: data
        }

        ,
        success: function(e) {
          $('#diaryAayo').html(e);
        }
      }

    )
  }
</script>