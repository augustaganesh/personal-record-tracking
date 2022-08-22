<?php
if (!isset($_SESSION['user-status']) || $_SESSION['user-status'] != 'loggedin') {
  echo "<script> window.location.href='" . base_url() . "'</script>";
}


if (isset($_GET['action'])) {
  if ($_GET['action'] == 'd') {
    $obj->Delete("expenditure", "id", array($_GET['id']));
    $_SESSION['delete'] = "Records deleted successfully!";
  }
}
if (isset($_POST['submit'])) {
  unset($_POST['submit']);
  $uid =  $_SESSION['uid'];
  $_POST['uid'] = $uid;
  $check_name =  $_POST['name'];
  $check_date = $_POST['bought_date'];

  $check = $obj->Query("SELECT * FROM expenditure WHERE name='$check_name' and bought_date='$check_date' and uid='$uid'");

  if ($check) {
    echo "<script>alert('Notice Error! : Record already added');</script>";
  } else {
    $a = $obj->Insert("expenditure", $_POST);
    if ($a) {
      $_SESSION['message'] = "Records added successfully!";
    } else {
      echo "<script>alert('Error! Data is not added');</script>";
    }
  }
}

$goods = $obj->select('expenditure', '*', 'uid', array($_SESSION['uid']));

?>
<style>
  table th {
    text-align: center;
  }

  table td {
    text-align: left !important;
  }
</style>
<div class="container">
  <br class="d-lg-none">
  <div class="row">
    <div class="col-md-8 p-3">
      <div class="error">
        <!--For showing alert message -------------------------->
        <?php if (isset($_SESSION['message'])) { ?>
          <div class="alert alert-danger">
            <?php echo $_SESSION['message'];
            unset($_SESSION['message']);  ?>
          </div>
        <?php }  ?>
        <!------------------------End----------------------------->
      </div>

      <button class="btn btn-dark" onclick="showFunction()"><i class="fas fa-plus"></i> Add new record</button>


      <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
        View Expenditure(Category Wise)
      </button>

      <div class="collapse show" id="collapseExample">
        <div class="card card-body shadow my-2 horizantal-scroll">
          <ul class="d-flex list-unstyled">
            <?php
            $indiv_cata_cost = $obj->Query("SELECT * from expenditure group by catagory")
            ?>
            <?php foreach ($indiv_cata_cost as $key => $value) : ?>
              <li class="mr-2 text-nowrap"><?= $value->catagory ?></li>
            <?php endforeach ?>
          </ul>
        </div>
      </div>

      <style>
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
            <label for="Bought By:">Catagory</label>
            <select class="form-control" name="catagory" required>
              <option selected="" disabled="">Select the catagory</option>
              <option value="foods">Foods</option>
              <option value="vegetables">Vegetables</option>
              <option value="snacks">Snacks</option>
              <option value="personal expenses">Personal Expenses</option>
              <option value="travel expenses">Travel Expenses</option>
              <option value="housings">Housings</option>
              <option value="internet/telephone">Internet/Telephone</option>
              <option value="entertainment">Entertainment</option>
              <option value="electronics">Electronics</option>
              <option value="stationary">Stationary</option>
              <option value="college fees">College Fees</option>
              <option value="room rent">Room Rent</option>
            </select>
          </div>


          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label>Goods/Service Name</label>
                <input type="text" name="name" class="form-control" required>
              </div>
            </div>



            <div class="col-md-6">
              <div class="form-group">
                <label>Price(Rs.)</label>
                <input type="text" name="price" class="form-control" required>
              </div>

            </div>
          </div>

          <div class="form-group">
            <label style="font-family: nunito, sans-serif;">Details</label><br>
            <textarea rows="3" name="description" class="form-control" required>

                </textarea>
          </div>

          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label>Done on</label>
                <input type="date" name="bought_date" class="form-control" maxlength="10" required>
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
          <h4 class=" font-weight-bold pb-3 text-center text-white" style="font-size:1.3rem;"> Expenditure Lists

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
        <?php if ($goods) { ?>
          <thead>
            <tr style="background: #f9f9f9;">
              <th>SN</th>
              <th>Name</th>
              <th>Catagory</th>
              <th>Description</th>
              <th style="width: 80px;">Price</th>
              <th>Done on</th>
              <th colspan="2">Action</th>
            </tr>
          </thead>


          <tbody>
            <?php foreach ($goods as $key => $value) : ?>
              <tr>
                <td><?= ++$key ?></td>
                <td><?= $value['name']; ?></td>
                <td><?= $value['catagory']; ?></td>
                <td><?= $value['description']; ?></td>
                <td>Rs. <?= $value['price']; ?></td>
                <td><?= $value['bought_date']; ?></td>
                <td><a href="<?= base_url('editexpenditures.php?action=e&id=' . $value['id']) ?>" class="btn btn-outline-info btn-sm" onclick="return confirm('Are you sure you want to edit?')"><i class="far fa-edit"></i></a>
                </td>

                <td><a href="<?= base_url('expenditures.php?action=d&id=' . $value['id']) ?>" class="btn btn-outline-danger btn-sm" onclick="return confirm('Are you sure you want to delete?')"><i class="far fa-trash-alt"></i></a></td>

              </tr>
            <?php endforeach; ?>
          </tbody>
      </table>
    </div>

  <?php } else { ?>
    <p style="color:red;margin: 1rem 0;">No data available!</p>

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