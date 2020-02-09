<!-- Hien thi danh sach san pham -->
<?php 
    $open = "providers";
    define("Title", "Admin | Nhà cung cấp ");
    require_once __DIR__. "/../../autoload/autoload.php";

    // import file database

    if(isset($_GET['page'])) {
        $p = $_GET['page'];
    } else {
        $p = 1;
    }

    //lay all row of product, doi ten roi left join qua truong chung la category.id, 
    $sql = "SELECT providers.*, category.name as namecate FROM providers 
    LEFT JOIN category on category.id = providers.category_id";
    
    //tham so: bang, cau lenh query, so trang, so 2 la so bang ghi muon hien thi, 
    $providers  = $db->fetchJone('providers', $sql, $p, 10, true);

    if(isset($providers['page'])) {
        $sotrang = $providers['page'];
        unset($providers['page']);
    }
?>

<!-- import file header.php -->
<?php require_once __DIR__. "/../../layouts/header.php"; ?>

<!-- Page Heading -->
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Danh sách nhà cung cấp
            <a href="add.php" class="btn btn-success">Thêm mới </a>
        </h1>
        <ol class="breadcrumb">
            <li>
                <i class="fa fa-dashboard"></i>  <a href="<?php echo base_url() ?>admin/modules/providers/"> Home </a>
            </li>
            <li class="active">
                <i class="fa fa-file"></i> Nhà cung cấp
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
                        <th>Name</th>
                        <th>Category</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $stt = 1; foreach($providers as $item): ?>
                        <tr>
                            <td><?php echo $stt ?></td>
                            <td><?php echo $item['name'] ?></td>
                            <td><?php echo $item['namecate'] ?></td>
                            <td>
                                <a class="btn btn-xs btn-info" href="edit.php?id=<?php echo $item['id'] ?>">
                                <i class="fa fa-edit"></i> Sửa</a>
                                <!-- gửi id để xem cái nào cần sửa -->
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