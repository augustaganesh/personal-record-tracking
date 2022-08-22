<?php
if (isset($_POST['tag'])) {
    session_start();

    require_once('config/config.php');
    require_once('config/db.php');


    $hell = $_POST['tag'];
    $uid = $_SESSION['uid'];

    if ($hell != "AllMuktak") {
        $str = "SELECT * FROM diary where created_date like '$hell%' and uid = '$uid' order by created_date desc";
    } else {
        $str = "SELECT * FROM documents order by created_date";
    }
    $diary_specific_time = $obj->Query($str);
}
?>
<div class="table-respondsive">
    <!-- <table class="table table-hover table-responsive-lite" id="fileAayo"> -->
    <div class="p-2">
        <h4 class="text-nowrap mb-2 d-flex justify-content-end"> <i class="fas fa-book"></i>&nbsp; My Diaries | <?= $hell ?></h4>
        <ul class="d-flex list-unstyled">
            <?php $loopCounter = 12;
            $idx = 1; ?>
                <?php
                if ($diary_specific_time) {
                    for ($idx = 1; $idx <= 11; $idx++) { ?>
                        <li><button onClick="filterDiaryMonthWise('<?= $hell ?>/0<?= $idx ?>');" class="btn mr-2 mb-2" style="background-color: #e9e9ff;">
                            <?php if ($idx == '1') {
                                echo "Jan";
                            } elseif ($idx == '2') {
                                echo "Feb";
                            } elseif ($idx == '3') {
                                echo "Mar";
                            } elseif ($idx == '4') {
                                echo "Apr";
                            } elseif ($idx == '5') {
                                echo "May";
                            } elseif ($idx == '6') {
                                echo "June";
                            } elseif ($idx == '7') {
                                echo "July";
                            } elseif ($idx == '8') {
                                echo "Aug";
                            } elseif ($idx == '9') {
                                echo "Sept";
                            } elseif ($idx == '10') {
                                echo "Nov";
                            } elseif ($idx == '11') {
                                echo "Dec";
                            }
                        }
                            ?></button></li>
                    <?php } ?>

        </ul>
    </div>

    <table class="table table-hover table-responsive-lite" id="diaryAayoMonthWise">
        <?php if ($diary_specific_time) { ?>
            <thead>
                <tr>

                </tr>
                <tr style="background: #f9f9f9;">
                    <th>SN</th>
                    <th>Title</th>
                    <th>Details</th>
                    <th>Created Date</th>
                    <th colspan="2" class="text-center">Action</th>
                </tr>
            </thead>
            <tbody>

                <?php foreach ($diary_specific_time as $key => $value) : ?>
                    <tr>
                        <td><?= ++$key ?></td>
                        <td><?= $value->diary; ?></td>
                        <td><?= $value->detail; ?></td>
                        <td class="text-nowrap">
                            <?php if (!empty($value->isUpdated)) { ?>
                                <small><i>Updated : <?= $value->isUpdated; ?></i></small> &nbsp;&nbsp;&nbsp;
                                <small><i class="far fa-clock" title="<?= $value->created_date; ?>"></i></small>

                            <?php } else { ?>
                                <small><?= $value->created_date; ?></small> <?php } ?>
                        </td>


                        <td class="text-center"><a href="<?= base_url('editdiary.php?action=e&id=' . $value->id) ?>" class="btn btn-outline-info btn-sm" onclick="return confirm('Are you sure you want to edit?')"><i class="far fa-edit"></i></a>
                        </td>

                        <td class="text-center"><a href="<?= base_url('diary.php?action=d&id=' . $value->id) ?>" class="btn btn-outline-danger btn-sm" onclick="return confirm('Are you sure you want to delete?')"><i class="far fa-trash-alt"></i></a></td>
                    </tr>
                <?php endforeach; ?>

            </tbody>
        <?php } else { ?>
            <tbody>
                <p class="p-2 text-primary">Opps! No diary from <?= $hell ?>!</p>
            </tbody>

        <?php } ?>
    </table>
</div>

<script>
    function filterDiaryMonthWise(data, i) {
        let counter = "<?= $loopCounter; ?>";


        $.ajax({
                type: "POST",
                url: 'filter-diary-month-wise.php',
                data: {
                    tag: data
                },
                success: function(e) {
                    url: 'filter-diary-month-wise.php',
                    $('#diaryAayoMonthWise').html(e);
                }
            }

        )
    }
</script>