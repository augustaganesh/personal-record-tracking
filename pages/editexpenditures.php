<?php

if (!isset($_SESSION['user-status']) || $_SESSION['user-status'] != 'loggedin') {
    echo "<script> window.location.href='" . base_url('login.php') . "'</script>";
}
if (isset($_POST['submit'])) {
    if ($_POST['submit'] == 'add') {
        array_pop($_POST);

        $obj->Update("expenditure", $_POST, "id", array($_GET['id']));
        echo '<script>alert("Records updated successfully")</script>';
        echo "<script> window.location.href='" . base_url('expenditures.php') . "'</script>";
    }
}

if (isset($_GET['action']) && $_GET['action'] == 'e') {
    $edit = $obj->Select("expenditure", "*", "id", array($_GET['id']));

    if (!$edit) {
        echo "<script> window.location.href='" . base_url('editxpenditures.php') . "'</script>";
    }
}

?>
<div class="container">
    <br class="d-lg-none">
    <div class="row">
        <div class="col-md-8 mt-3 p-3" style="background-color: #f1f2ff;">
            <div class="">
                <h3><i class="fas fa-edit"></i> Edit Expenditures</h3>
                <hr>
            </div>

            <style>
                thead {
                    font-family: roboto, sans-serif !important;
                }

                .hidden {
                    display: none;
                }
            </style>

            <form action="" method="post" class="form-group"><br>
                <div class="form-group">
                    <label>Catagory</label>
                    <select class="form-control" name="catagory">
                        <option selected="" disabled="">Select the catagory</option>
                        <option <?php if ($edit[0]['catagory'] == 'foods') { ?> selected <?php } ?> value="foods">Foods
                        </option>

                        <option <?php if ($edit[0]['catagory'] == 'vegetables') { ?> selected <?php } ?> value="vegetables">
                            Vegetables</option>

                        <option <?php if ($edit[0]['catagory'] == 'snacks') { ?> selected <?php } ?> value="snacks">Snacks
                        </option>

                        <option <?php if ($edit[0]['catagory'] == 'personal expenses') { ?> selected <?php } ?> value="personal expenses">Personal Expenses</option>

                        <option <?php if ($edit[0]['catagory'] == 'travel expenses') { ?> selected <?php } ?> value="travel expenses">Travel Expenses</option>

                        <option <?php if ($edit[0]['catagory'] == 'housings') { ?> selected <?php } ?> value="housings">
                            Housings</option>

                        <option <?php if ($edit[0]['catagory'] == 'internet/telephone') { ?> selected <?php } ?> value="internet/telephone">Internet/Telephone</option>

                        <option <?php if ($edit[0]['catagory'] == 'entertainment') { ?> selected <?php } ?> value="entertainment">Entertainment</option>

                        <option <?php if ($edit[0]['catagory'] == 'electronics') { ?> selected <?php } ?> value="electronics">Electronics</option>

                        <option <?php if ($edit[0]['catagory'] == 'stationary') { ?> selected <?php } ?> value="stationary">
                            Stationary</option>

                        <option <?php if ($edit[0]['catagory'] == 'college fees') { ?> selected <?php } ?> value="college fees">College Fees</option>

                        <option <?php if ($edit[0]['catagory'] == 'room rent') { ?> selected <?php } ?> value="room rent">
                            Room Rent</option>
                    </select>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Goods/Services Name</label>
                            <input type="text" name="name" class="form-control" required value="<?= $edit[0]['name']; ?>">
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Price(Rs.)</label>
                            <input type="text" name="price" class="form-control" required value="<?= $edit[0]['price']; ?>">
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label style="font-family: nunito, sans-serif;">Details</label><br>
                    <textarea rows="3" name="description" class="form-control" required><?= $edit[0]['description']; ?>
                    
                </textarea>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Done date?</label>
                            <input type="hidden" name="bought_date" class="form-control"  value="<?php echo date('Y-m-d')?>">
                        </div>
                    </div>
                </div>
                <br>


                <!-- Button trigger modal -->
                <button type="button" class="btn btn-block btn-info" data-toggle="modal" data-target="#exampleModal">
                    Update
                </button>

                <style>
                    .modal-backdrop {
                        position: relative;
                    }
                </style>

                <!-- Modal -->
                <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title" id="exampleModalLabel">Are you sure you want to update?</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-4">
                                        <button type="button" class="btn btn-primary" data-dismiss="modal">Cancel</button>
                                    </div>
                                    <div class="col-8">
                                        <button class="btn btn-block btn-success" name="submit" value="add"><i class="fas fa-check"></i> Update</button>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
    function showFunction() {
        var div = document.getElementById("msg");
        div.classList.toggle('hidden');
    }
</script>