<?php
if (isset($_POST['tag'])) {
    session_start();

require_once('config/config.php');
require_once('config/db.php');

$hell = $_POST['tag'];
$uid= $_SESSION['uid'];

if ($hell != "AllMuktak") {
  $str = "SELECT * FROM documents where `documents`.`type`='$hell' and uid = '$uid' order by created_date desc";
} else {
  $str = "SELECT * FROM documents order by created_date";
}
$documents = $obj->Query($str);
}
?>

<div class="table-respondsive">
                <table class="table table-hover table-responsive-lite" id="fileAayo">
                   
                    <?php if ($documents) { ?>
                        <thead>
                            <tr><th colspan="6"><h4 class="p-2 text-nowrap"> <i class="fas fa-file"></i> <?=$hell?></h4></th> </tr>
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
                                    <td><?= $value->title; ?></td>
                                    <td>

                                        <a href="uploads/<?= $value->file; ?>" class="text-info">
                                            <?= $value->title.".".pathinfo($value->file, PATHINFO_EXTENSION)?>
                                        </a>

                                    </td>
                                    <td><?= $value->description; ?></td>

                                    <td class="text-center"><a href="<?= base_url('editdocuments.php?action=e&id=' . $value->id) ?>" class="btn btn-outline-info btn-sm" onclick="return confirm('Are you sure you want to edit?')"><i class="far fa-edit"></i></a>
                                    </td>

                                    <td class="text-center"><a href="<?= base_url('documents.php?action=d&id=' . $value->id) ?>" class="btn btn-outline-danger btn-sm" onclick="return confirm('Are you sure you want to delete?')"><i class="far fa-trash-alt"></i></a></td>
                                </tr>
                            <?php endforeach; ?>

                        </tbody>
                    <?php } else { ?>
                        <tbody>
                            <p style="color:red">Opps! No document added yet!</p>
                        </tbody>

                    <?php } ?>
                </table>
            </div>