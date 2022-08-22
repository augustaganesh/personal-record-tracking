<?php
if (!isset($_SESSION['user-status']) || $_SESSION['user-status'] != 'loggedin') {
    echo "<script> window.location.href='" . base_url() . "'</script>";
}

$uid = $_SESSION['uid'];
$total_expenditure = $obj->query("SELECT sum(price) as expenditures FROM expenditure where uid = '$uid'");

$total_incomes = $obj->query("SELECT sum(amount) as incomes FROM income where uid = '$uid'");

$total_diary = $obj->query("SELECT count(id) as tot_diary FROM diary where uid = '$uid' ");
?>
<style>
    .hovertest:hover {
        background: #fff !important;

    }

    @media(max-width: 600px) {
        .hovertest {
            margin-bottom: 1rem;
        }
    }
</style>
<div style="height: 5vh;"></div>
<h3 class="" style="border-bottom: 2px solid #e7e7e7;padding-bottom: 0.4rem;"> &nbsp;&nbsp;Welcome To Dashboard&nbsp;&nbsp;</h3><br>


<div class="container" style="min-height: 100vh;">
    <div class="row">
        <div class="col-md-4 shadow hovertest p-3">
            <a href="<?= base_url('expenditures.php'); ?>" class="text-dark" style="text-decoration: none;">
                <h4 class="text-dark text-center"><i class="fas fa-chart-line text-warning fa-3x"></i><br><br>Total Expenditures</h4>
                <h3 class="text-center pt-2">Rs.<?= $total_expenditure[0]->expenditures; ?></h3>
            </a>
        </div>

        <div class="col-md-4 shadow hovertest  p-3">
            <a href="<?= base_url('incomes.php'); ?>" class="text-dark" style="text-decoration: none;">
                <h4 class="text-dark text-center"><i class="far fa-hands-usd fa-3x text-success"></i><br><br>Total Earnings</h4>

                <h3 class="text-center pt-2">
                    <?php if (!empty($total_incomes[0]->incomes)) { ?>

                        Rs.<?= $total_incomes[0]->incomes; ?>
                    <?php  } else {
                        echo "Rs. 0";
                    }
                    ?>
                </h3>
            </a>
        </div>

        <div class="col-md-4 shadow hovertest p-3">
            <a href="<?= base_url('diary.php'); ?>" class="text-dark" style="text-decoration: none;">
                <h4 class="text-dark text-center"><i class="fas fa-coin fa-3x text-info"></i><br><br> My Total Diaries </h4>
                <h3 class="text-center pt-2"><a href="<?= base_url('diary.php'); ?>" class="text-dark" style="text-decoration: none;"><?= $total_diary[0]->tot_diary; ?></h3>
            </a>
        </div>
    </div>
</div>