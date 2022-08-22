<?php

if (!isset($_SESSION['user-status']) || $_SESSION['user-status'] != 'loggedin') {
    echo "<script> window.location.href='" . base_url() . "'</script>";
}
if (isset($_POST['submit'])) {
    if ($_POST['submit'] == 'add') {
        array_pop($_POST);

        $obj->Update("income", $_POST, "id", array($_GET['id']));
        echo "<script> window.location.href='" . base_url('incomes.php') . "'</script>";
    }
}

if (isset($_GET['action']) && $_GET['action'] == 'e') {
    $edit = $obj->Select("income", "*", "id", array($_GET['id']));

    if (!$edit) {
        echo "<script> window.location.href='" . base_url('editincomes.php') . "'</script>";
    }
}

?>

<div class="container">
    <br class="d-lg-none">
    <div class="row">
        <div class="col-md-8 mt-3 p-3" style="background-color: #f1f1ff;">
            <div class="">
                <h3><i class="fas fa-edit"></i> Edit Incomes</h3>
                <hr>
            </div>
            <form action="" method="post" class="form-group">
                <div class="row">
                    <div class="col-md-5">
                        <div class="form-group">
                            <label>Amount(Rs.)</label>
                            <input type="number" name="amount" class="form-control" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" type="number" maxlength="7" required value="<?= $edit[0]['amount']; ?>">

                        </div>
                    </div>

                    <div class="col-md-7">
                        <div class="form-group">
                            <label for="Bought By:">Source of Income</label>
                            <select class="form-control" name="source">
                                <option selected="" disabled="">Choose income source</option>

                                <option <?php if ($edit[0]['source'] == 'Parents') { ?> selected <?php } ?> value="Parents">
                                    Parents</option>
                                <option <?php if ($edit[0]['source'] == 'Relatives') { ?> selected <?php } ?> value="Relatives">Relatives</option>
                                <option <?php if ($edit[0]['source'] == 'Friends') { ?> selected <?php } ?> value="Friends">
                                    Friends</option>
                                <option <?php if ($edit[0]['source'] == 'Found Somewhere') { ?> selected <?php } ?> value="Found Somewhere">Found Somewhere</option>
                                <option <?php if ($edit[0]['source'] == 'Loan') { ?> selected <?php } ?> value="Loan">Loan
                                </option>
                            </select>
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
                            <label>Received on</label>
                            <input type="date" name="received_on" class="form-control" required value="<?= $edit[0]['received_on']; ?>">
                        </div>

                    </div>
                </div><br>

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
                                        <button class="btn btn-block btn-success" name="submit" value="add"><i class="fas fa-check"></i> &nbsp;Update</button>
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