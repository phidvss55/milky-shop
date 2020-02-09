<!-- Hien thi danh sach san pham -->
<?php 
    $open = "user";
    define("Title", "Danh muc");
    require_once __DIR__. "/../../autoload/autoload.php";

    // import file database 


    if(isset($_GET['page'])) {
        $p = $_GET['page'];
    } else {
        $p = 1;
    }

    //get all row of admin table with condition higher by id
    $sql = "SELECT users.* FROM users ORDER BY id DESC";

    //tham so: bang, cau lenh query, so trang, so 2 la so bang ghi muon hien thi, 
    $admin  = $db->fetchJone('users', $sql, $p, 5, true);

    if(isset($admin['page'])) {
        $sotrang = $admin['page'];
        unset($admin['page']);
    }
?>

<!-- import file header.php -->
<?php require_once __DIR__. "/../../layouts/header.php"; ?>

<!-- Page Heading -->
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header"> Danh sách thành viên </h1>
        <ol class="breadcrumb">
            <li>
                <i class="fa fa-dashboard"></i>  <a href="index.php"> Home </a>
            </li>
            <li class="active">
                <i class="fa fa-file"></i> Thành viên
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
                        <th>Email</th>
                        <th>Số điện thoại</th>
                        <th>Địa chỉ</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $stt = 1; foreach($admin as $item): ?>
                        <tr>
                            <td><?php echo $stt ?></td>
                            <td><?php echo $item['name'] ?></td>
                            <td><?php echo $item['email'] ?></td>
                            <td><?php echo $item['phone'] ?></td>
                            <td><?php echo $item['address'] ?></td>
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