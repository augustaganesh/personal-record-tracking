<?php
if (!isset($_SESSION['user-status']) || $_SESSION['user-status'] != 'loggedin') {
  echo "<script> window.location.href='" . base_url() . "'</script>";
}

$uid = $_SESSION['uid'];

if (isset($_GET['action'])) {
  if ($_GET['action'] == 'd') {
    $obj->Delete("income", "id", array($_GET['id']));

    $_SESSION['delete'] = "Records deleted successfully!";
  }
}

if (isset($_POST['submit'])) {
  unset($_POST['submit']);
  $_POST['uid'] = $uid;
  $check_source =  $_POST['source'];
  $check_amount = $_POST['amount'];
  $check_date = $_POST['received_on'];

  $check = $obj->Query("SELECT * FROM income WHERE source='$check_source'and amount='$check_amount' and received_on = '$check_date' and uid='$uid'");


  if ($check) {
    echo "<script>alert('Notice Error! : Record already added');</script>";
    echo "<script> window.location.href=''</script>";

  } else {
    $a = $obj->Insert("income", $_POST);
    if ($a) {
      $_SESSION['message'] = "Records added successfully!";
    } else {
      echo "<script>alert('Error! Data is not added');</script>";
    }
  }
}

$income = $obj->select('income','*','uid',array($_SESSION['uid']));

?>

<div class="container">
  <br class="d-lg-none">
  <div class="row">
    <div class="col-md-8 p-3">
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

      <button class="btn btn-dark" onclick="showFunction()"><i class="fas fa-plus"></i> Add new Income</button>
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
          <div class="row">
            <div class="col-md-5">
              <div class="form-group">
                <label>Amount(Rs.)</label>
                <input type="number" name="amount" class="form-control" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" type="number" maxlength="7" required>

              </div>
            </div>

            <div class="col-md-7">
              <div class="form-group">
                <label for="Bought By:">Source of Income</label>
                <select class="form-control" name="source">
                  <option selected="" disabled="">Choose income source</option>
                  <option value="Parents">Parents</option>
                  <option value="Relatives">Relatives</option>
                  <option value="Friends">Friends</option>
                  <option value="Found Somewhere">Found Somewhere</option>
                  <option value="Loan">Loan</option>
                </select>
              </div>
            </div>
          </div>

          <div class="form-group">
            <label style="font-family: nunito, sans-serif;">Details</label><br>
            <textarea rows="3" name="description" class="form-control">

                </textarea>
          </div>


          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label>Received on</label>
                <input type="date" name="received_on" class="form-control">
              </div>

            </div>
          </div><br>

          <button class="btn btn-block btn-success" name="submit" value="add">Add</button>

        </form>
      </div>
    </div>
  </div>
</div>

<div class="container">
  <div class="row">

    <div class="col-md-12">
      <table class="table table-hover table-bordered table-responsive-lite">
        <div class="card-header bg-info">
          <h4 class=" font-weight-bold pb-3 text-center text-white" style="font-size:1.3rem;"> My Income Lists
            <span class="float-right">
              <input type="text" class="form-control" name="search" id="mysearch" placeholder="&#128270; search the list...">
            </span>
          </h4>
          <div class="error">
            <!--For showing alert message ----------->
            <?php if (isset($_SESSION['delete'])) : ?>
              <div class="alert alert-danger">
                <?php echo $_SESSION['delete']; ?>

              </div>
            <?php endif; ?>
            <?php unset($_SESSION['delete']); ?>
          </div>
        </div>
        <?php if ($income) { ?>

          <thead>
            <tr style="background: #f9f9f9;">
              <th>SN</th>
              <th>Amount</th>
              <th>Source</th>
              <th>Description</th>
              <th>Received On</th>

              <th colspan="2">Action</th>


            </tr>
          </thead>
          <tbody>
            <?php foreach ($income as $key => $value) : ?>
              <tr>
                <td><?= ++$key ?></td>
                <td>Rs.<?= $value['amount']; ?></td>
                <td><?= $value['source']; ?></td>
                <td><?= $value['description']; ?></td>
                <td><?= $value['received_on']; ?></td>

                <td><a href="<?= base_url('editincomes.php?action=e&id=' . $value['id']) ?>" class="btn btn-outline-info btn-sm" onclick="return confirm('Are you sure you want to edit?')"><i class="far fa-edit"></i></a>
                </td>

                <td><a href="<?= base_url('incomes.php?action=d&id=' . $value['id']) ?>" class="btn btn-outline-danger btn-sm" onclick="return confirm('Are you sure you want to delete?')"><i class="far fa-trash-alt"></i></a></td>

              </tr>
            <?php endforeach; ?>
          </tbody>
      </table>
    </div>

  <?php } else { ?>
    <p style="min-height: 70vh;margin: 1rem;color: red;">No data available!</p>

  <?php } ?>
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