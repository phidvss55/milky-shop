<?php
define("Title", "Trang Admin");
// import file database
require_once __DIR__ . "/autoload/autoload.php";
$open = "dashboard";

$product = $db->fetchAll("product");
$count = 0;
$totalSellIn = 0;
foreach($product as $item) {
    $count++;
    $totalSellIn += $item['price'] * $item['number'];
}

$tran = $db->fetchAll("transaction");
$countTran = 0;
$totalSellOut = 0;
foreach($tran as $item) {
    $countTran++;
    $totalSellOut += $item['amount'];
}
$countUser = 0;
$users = $db->fetchAll("users");
foreach($users as $item) {
    $countUser++;
}

?>
<!-- import file header.php -->
<?php require_once __DIR__ . "/layouts/header.php"; ?>

<!-- Page Heading -->
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">
            - Chào mừng bạn đến với trang quản trị -
        </h1>
        <ol class="breadcrumb">
            <li>
                <i class="fa fa-dashboard"></i> <a href="index.php"> Home </a>
            </li>
            <li class="active">
                <i class="fa fa-file"></i> Trang chủ
            </li>

        </ol>
    </div>
</div>
<!-- /.row -->
<div class="row">
    <!-- Số sản phẩm -->
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-list fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                        <div class="huge"><?php echo $count; ?></div>
                        <div>Tổng số sản phẩm!</div>
                    </div>
                </div>
            </div>
            <a href="#">
                <div class="panel-footer">
                    <span class="pull-left">View Details</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
    <!-- Tổng só tiền đầu tư -->
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-green">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-caret-square-o-down fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                        <div class="huge"><?php echo formatPrice($totalSellIn); ?></div>
                        <div>Tổng tiền đã đầu tư!</div>
                    </div>
                </div>
            </div>
            <a href="#">
                <div class="panel-footer">
                    <span class="pull-left">View Details</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
    <!-- Tổng số đơn hàng -->
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-yellow">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-th-list fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                        <div class="huge"><?php echo $countTran; ?></div>
                        <div>Tổng đơn hàng!</div>
                    </div>
                </div>
            </div>
            <a href="#">
                <div class="panel-footer">
                    <span class="pull-left">View Details</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
    <!-- Tổng số tiền bán ra -->
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-red">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-caret-square-o-up fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                        <div class="huge"><?php echo formatPrice($totalSellOut); ?></div>
                        <div>Tổng lợi nhuận thu về!</div>
                    </div>
                </div>
            </div>
            <a href="#">
                <div class="panel-footer">
                    <span class="pull-left">View Details</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
    <!-- Tổng số thành viên -->
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-green">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-user fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                        <div class="huge"><?php echo $countUser; ?></div>
                        <div>Tổng số thành viên đăng ký!</div>
                    </div>
                </div>
            </div>
            <a href="#">
                <div class="panel-footer">
                    <span class="pull-left">View Details</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
    
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-red">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-comments fa-3x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                        <div class="huge"><?php echo formatPrice($totalSellOut); ?></div>
                        <div>Tổng lợi nhuận thu về!</div>
                    </div>
                </div>
            </div>
            <a href="#">
                <div class="panel-footer">
                    <span class="pull-left">View Details</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
</div>
<?php require_once __DIR__ . "/layouts/footer.php"; ?>