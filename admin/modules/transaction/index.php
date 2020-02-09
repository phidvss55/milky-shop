<!-- Hien thi danh sach san pham -->
<?php 
    $open = "transaction";
    define("Title", "Quản lý giao dịch");
    require_once __DIR__. "/../../autoload/autoload.php";

    // import file database 


    if(isset($_GET['page'])) {
        $p = $_GET['page'];
    } else {
        $p = 1;
    }

    //get all row of admin table with condition higher by id
    $sql = "SELECT transaction.*, users.name as nameuser, users.phone as phoneuser FROM transaction LEFT JOIN users ON users.id = transaction.user_id ORDER BY id DESC";

    //tham so: bang, cau lenh query, so trang, so 2 la so bang ghi muon hien thi, 
    $transaction  = $db->fetchJone('transaction', $sql, $p, 3, true);

    if(isset($transaction['page'])) {
        $sotrang = $transaction['page'];
        unset($transaction['page']);
    }
?>

<!-- import file header.php -->
<?php require_once __DIR__. "/../../layouts/header.php"; ?>

<!-- Page Heading -->
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header"> Danh sách đơn hàng </h1>
        <ol class="breadcrumb">
            <li>
                <i class="fa fa-dashboard"></i>  <a href="index.php"> Home </a>
            </li>
            <li class="active">
                <i class="fa fa-file"></i> Đơn hàng
            </li>
        </ol>
        <div class="clearfix"></div>
        <!-- thông báo lỗi -->
        <?php require_once __DIR__. "/../../../partials/notification.php"; ?>
    </div>
</div>

<!-- /.row -->
<div class="row">
    <div class="col-md-12">
        <div class="table-responsive">
            <table class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>STT</th>
                        <th>Họ và tên</th>
                        <th>Phone</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $stt = 1; foreach($transaction as $item): ?>
                        <tr>
                            <td><?php echo $stt ?></td>
                            <td><?php echo $item['nameuser'] ?></td>
                            <td><?php echo $item['phoneuser'] ?></td>
                            <td>
                                <a href="status.php?id=<?php echo $item['id'] ?>" class="btn btn-xs <?php echo $item['status'] == 0 ? 'btn-danger' : 'btn-info' ?>">
                                    <?php echo $item['status'] == 0 ? 'Chưa xử lý' : 'Đã xử lý'?>
                                </a>
                            </td>
                            <td>
                                <a class="btn btn-xs btn-danger" href="delete.php?id=<?php echo $item['id'] ?>">
                                <i class="fa fa-times"></i>Xoá</a>
                            </td>
                        </tr>
                    <?php $stt++; endforeach?>
                </tbody>
            </table>
            <!-- number of page content here -->
            <div class="pull-right">
                <nav aria-label="Page navigation example pull-right" class="clearfix">
                    <ul class="pagination">
                        <li>
                            <a href="" aria-label="Previous">
                                <span aria-hidden="true">&laquo;</span>
                            </a>
                        </li>
                        <?php for($i = 1; $i <= $sotrang; $i++): ?>
                            <?php 
                            if(isset($_GET['page'])) {
                                $p = $_GET['page'];
                            } else {
                                $p = 1;
                            }
                            ?>
                        <li class="<?php echo ($i == $p) ? 'active' : '' ?>">
                            <a href="?page=<?php echo $i ;?>"><?php echo $i; ?></a>
                        </li>
                        <?php endfor; ?>
                        <li>
                            <a href="" aria-label="Previous">
                                <span aria-hidden="true">&raquo;</span>
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>

</div>

<?php require_once __DIR__. "/../../layouts/footer.php"; ?>