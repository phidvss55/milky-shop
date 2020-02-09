<?php

require_once __DIR__ . "/autoload/autoload.php";
include __DIR__ . ("/layouts/header.php");

if(!isset($_SESSION['name_id'])) {
    echo "<script>alert('Bạn phải đăng nhập mới chọn được tính năng này'); location.href='index.php'</script>";
}

$user_id = $_SESSION['name_id'];
$sqll = "select * from transaction where user_id = '$user_id'";
$result = $db->fetchsql($sqll);

?>

<div class="col-md-9 bor">

    <section class="box-main1">
        <h3 class="title-main"><a> Lịch sử đơn hàng </a> </h3>
        <?php if(isset($_SESSION['success'])): ?>
            <div class="alert alert-success">
                <strong style="color: #3c763d; ">Success! </strong><?php echo $_SESSION['success']; unset($_SESSION['success']); ?>
            </div>
        <?php endif ?>
        <?php if(isset($_SESSION['error'])): ?>
            <div class="alert alert-danger">
                <strong style="color: #a94442;">Error!</strong><?php echo $_SESSION['error']; unset($_SESSION['error']) ?>
            </div>
        <?php endif ?>
        <div class="table-format">
            <table class="table table-hover login-name">
                <thead>
                    <tr>
                        <th scope="col">STT</th>
                        <th scope="col">Mã đơn hàng</th>
                        <th scope="col">Tổng Số giá tiền</th>
                        <th scope="col">Tổng Số Sản Phẩm</th>
                        <th scope="col">Ngày Order</th>
                        <th scope="col">Trạng Thái</th>
                        <th scope="col">Thao tác</th>
                    </tr>
                </thead>
                <tbody class="">
                    <?php $stt = 1;
                    foreach ($result as $key => $value) : ?>
                        <tr>
                            <td><?php echo $stt; ?></td>
                            <td><?php echo $value['id']; ?></td>
                            <td><?php echo $value['amount']; ?></td>
                            <?php
                            $query = "select * from orders where transaction_id='" . $value['id'] . "'";
                            $items = $db->fetchsql($query);
                            $number = 0;
                            foreach ($items as $a) {
                                $number += $a['qty'];
                            }
                            echo '<td>' . $number . '</td>';
                            ?>
                            <td>
                                <?php echo $value['created_at']; ?>
                            </td>
                            <td>
                                <?php
                                if ($value['status'] == '') {
                                    echo 'Đang xử lý';
                                } else {
                                    echo 'Đã hoàn thành';
                                }
                                ?>
                            </td>
                            <td>
                                <?php if($value['status'] != ''): ?>
                                    <a href="remove-orders.php?id=<?php echo $value['id'] ?>" class="btn btn-xs disabled btn-danger update-orders"><i class="fa fa-remove"></i> Remove</a>
                                <?php endif ?>
                                <?php if($value['status'] == ''): ?>
                                    <a href="remove-orders.php?id=<?php echo $value['id'] ?>" class="btn btn-xs btn-danger update-orders"><i class="fa fa-remove"></i> Remove</a>
                                <?php endif ?>
                            </td>
                        </tr>
                    <?php $stt++;
                    endforeach ?>
                </tbody>
            </table>
        </div>
    </section>
</div>

<?php require_once __DIR__ . "/layouts/footer.php" ?>