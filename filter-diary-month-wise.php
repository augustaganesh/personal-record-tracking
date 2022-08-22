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
<!-- id="diaryAayoMonthWise" -->
    <table class="table table-hover table-responsive-lite" id="diaryAayoMonthWise">
            <!-- <table class="table table-hover table-responsive-lite" id="fileAayo"> -->

        <?php if ($diary_specific_time) { ?>
            <thead>
                <tr>
                    <th colspan="6" class="border-0 alert-info p-2">
                        <h4 class="text-nowrap">Your diaries in 
                            <?php
                            $year =  substr($hell, 0,4);
                            $month = substr($hell, -2);
                            ?>
                        <?php if ($month == 1) {
                                echo "Jan ".$year;
                            } elseif ($month == 2) {
                                echo "Feb ".$year;
                            } elseif ($month == 3) {
                                echo "Mar ".$year;
                            } elseif ($month ==4) {
                                echo "Apr ".$year;
                            } elseif ($month ==5) {
                                echo "May ".$year;
                            } elseif ($month ==6) {
                                echo "June ".$year;
                            } elseif ($month ==7) {
                                echo "July ".$year;
                            } elseif ($month ==8) {
                                echo "Aug ".$year;
                            } elseif ($month ==9) {
                                echo "Sept ".$year;
                            } elseif ($month ==10) {
                                echo "Nov ".$year;
                            } elseif ($month ==11) {
                                echo "Dec ".$year;
                            }
                            ?>
                          </h4>
                    </th>
                </tr>
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
                <p class="text-primary p-2 d-flex justify-content-center">Opps! No diary in  
                <?php 
                  $year =  substr($hell, 0,4);
                  $month = substr($hell, -2);
                  
                  if ($month == 1) {
                                echo "Jan ".$year;
                            } elseif ($month == 2) {
                                echo "Feb ".$year;
                            } elseif ($month == 3) {
                                echo "Mar ".$year;
                            } elseif ($month ==4) {
                                echo "Apr ".$year;
                            } elseif ($month ==5) {
                                echo "May ".$year;
                            } elseif ($month ==6) {
                                echo "June ".$year;
                            } elseif ($month ==7) {
                                echo "July ".$year;
                            } elseif ($month ==8) {
                                echo "Aug ".$year;
                            } elseif ($month ==9) {
                                echo "Sept ".$year;
                            } elseif ($month ==10) {
                                echo "Nov ".$year;
                            } elseif ($month ==11) {
                                echo "Dec ".$year;
                            }
                            ?>!</p>
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
        }
        ,
        success: function(e) {
          $('#diaryAayoMonthWise').html(e);
        }
      }

    )
  }
  
</script>