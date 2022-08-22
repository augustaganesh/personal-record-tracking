<?php
if (!isset($_SESSION['user-status']) || $_SESSION['user-status'] != 'loggedin') {
    echo "<script> window.location.href='" . base_url() . "'</script>";
}

$uid = $_SESSION['uid'];

if (isset($_GET['action'])) {
    if ($_GET['action'] == 'd') {
        $obj->Delete("documents", "id", array($_GET['id']));
        $_SESSION['delete'] = "Records deleted!";
        echo "<script> window.location.href='" . base_url('documents.php') . "'</script>";
    }
}

if (isset($_POST['submit'])) {

    //   if ($_FILES['thumbnail']['name'] != '') {
    $imgName = $_FILES['file']['name'];
    $tmp_name = $_FILES['file']['tmp_name'];
    $location = 'uploads' . '/' . $imgName;
    move_uploaded_file($tmp_name, $location);
    $_POST['file'] = $imgName;
    //  }

    unset($_POST['submit']);
    $_POST['uid'] = $uid;
    $_POST['type'] = pathinfo($_POST['file'], PATHINFO_EXTENSION);

    $check_title =  $_POST['title'];
    $check_description = $_POST['description'];

    $check = $obj->Query("SELECT * FROM documents WHERE title='$check_title'and description='$check_description' and uid='$uid'");

    if ($check) {
        echo "<script>alert('Notice Error! : Record already added');</script>";
        echo "<script> window.location.href=''</script>";
    } else {
        $a = $obj->Insert("documents", $_POST);
        if ($a) {
            $_SESSION['message'] = "New documents added successfully!";
        } else {
            echo "<script>alert('Error! while adding documennts!');</script>";
        }
    }
}

$documents = $obj->select('documents', '*', 'uid', array($uid));

$file_type = $obj->Query("SELECT * from documents where uid = '$uid' group by type");

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
            <!-- Button trigger modal -->
            <button type="button" class="btn btn-dark" data-toggle="modal" data-target="#exampleModal">
                Add new file
            </button>

            <!-- Modal -->
            <div class="modal fade mt-5 pt-lg-0 pt-md-0 pt-5" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content shadow">
                        <form action="" method="post" class="form-group" enctype="multipart/form-data">
                            <div class="modal-header bg-info">
                                <h4 class="modal-title" id="exampleModalLabel">Add your Files/Documents</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="form-group">
                                    <label>Title</label>
                                    <input type="text" name="title" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label>Document/File</label>
                                    <input type="file" name="file" class="form-control" required>
                                </div>

                                <div class="form-group">
                                    <label>Description</label>
                                    <textarea name="description" rows="4" maxlength="1000" class="form-control" placeholder="Type your memory here.." required></textarea>
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


                                <input type="hidden" name="created_date" value="<?php date_default_timezone_set('Asia/Kathmandu');
                                                                                $date = date('Y/m/d h:i', time());
                                                                                echo $date; ?>">



                            </div>
                            <div class="modal-footer bg-secondary">
                                <input type="button" class="btn btn-secondary" data-dismiss="modal" value="Close">
                                <button name="submit" value="add" class="btn btn-primary">Add File</button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
            <style>
                button {
                    font-weight: bold !important;
                }

                thead {
                    font-family: Roboto, sans-serif !important;
                }
            </style>
        </div>

        <div class="col-md-12">
            <?php if (!empty($file_type)) { ?>
                <div class="d-flex justify-content-lg-end">
                    <div class="p-3 my-2 alert-info">
                        <h5> <i class="fas fa-sort"></i> Filter
                        </h5>
                        <div class="file-types">
                            <ul class="d-flex list-unstyled">
                                <?php if ($file_type) {
                                    $loopCounter = sizeof($file_type);
                                    $idx = 0;

                                    $count_all_quer = $obj->Query("SELECT count(id) as all_count from documents where uid = '$uid'");
                                    $all_count = $count_all_quer[0]->all_count;



                                ?>

                                    <li>
                                        <a href="<?= base_url('documents.php') ?>" class="btn btn-light btnCatag mr-2" id="filter-button">All<sup class="h6 font-weight-bold p-1">(<?= $all_count ?>)</sup></a>
                                    </li>

                                    <?php foreach ($file_type as $key => $value) : ?>


                                        <?php
                                        $a = $value->type;
                                        $a_quer = $obj->Query("SELECT count(id) as $a from documents where type='$a' and uid = '$uid'");
                                        $count_indiv = $a_quer[0]->$a;
                                        // echo date("m",strtotime($value->created_date));
                                        ?>



                                        <li>
                                            <button onClick="filterFile('<?= $value->type ?>','<?= $idx++ ?>');" class="btn px-3 btn-light mr-2 btnCatag" id="activeB<?= $key++; ?>"><?= $value->type ?><sup class="h6 font-weight-bold p-1">(<?= $count_indiv ?>)</sup></button>
                                        </li>
                                    <?php endforeach ?>
                                <?php } ?>
                            </ul>
                        </div>
                    </div>
                </div>
            <?php } ?>

            <div class="table-responsive">

                <table class="table table-hover  table-responsive-lite" id="fileAayo">
                    <div class="card-header bg-info">
                        <h4 class="font-weight-bold pb-2 text-center text-white" style="font-size:1.3rem;">My Documents
                            <span class="float-right">
                                <input type="text" class="form-control" name="search" id="mysearch" placeholder="&#128270; search your documents...">
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
                    <?php if ($documents) { ?>
                        <thead>
                            <tr style="background: #f9f9f9;">
                                <th>SN</th>
                                <th>Title</th>
                                <th>File</th>
                                <th>Description</th>
                                <th colspan="2" class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($documents as $key => $value) : ?>
                                <tr>
                                    <td><?= ++$key ?></td>
                                    <td><?= $value['title']; ?></td>
                                    <td>

                                        <a href="uploads/<?= $value['file']; ?>" class="text-info">
                                            <?= $value['title'] . "." . pathinfo($value['file'], PATHINFO_EXTENSION) ?>
                                        </a>

                                    </td>
                                    <td><?= $value['description']; ?></td>

                                    <td class="text-center"><a href="<?= base_url('editdocuments.php?action=e&id=' . $value['id']) ?>" class="btn btn-outline-info btn-sm" onclick="return confirm('Are you sure you want to edit?')"><i class="far fa-edit"></i></a>
                                    </td>

                                    <td class="text-center"><a href="<?= base_url('documents.php?action=d&id=' . $value['id']) ?>" class="btn btn-outline-danger btn-sm" onclick="return confirm('Are you sure you want to delete?')"><i class="far fa-trash-alt"></i></a></td>
                                </tr>
                            <?php endforeach; ?>

                        </tbody>
                    <?php } else { ?>
                        <p style="color:red">Opps! No document added yet!</p>

                    <?php } ?>
                </table>
            </div>

        </div>
    </div>
</div>
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
    function filterFile(data, i) {
        let counter = "<?= $loopCounter; ?>";


        $.ajax({
                type: "POST",
                url: 'filter-file.php',
                data: {
                    tag: data
                }

                ,
                success: function(e) {
                    $('#fileAayo').html(e);
                }
            }

        )
    }
</script>