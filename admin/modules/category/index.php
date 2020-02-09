<!-- Hien thi danh sach san pham -->
<?php
    $open = 'category';
    define("Title", "Admin | Danh mục sản phẩm ");
    // import file database
    require_once __DIR__. "/../../autoload/autoload.php";

    $category = $db->fetchAll("category"); //lay tat ca

?>
<!-- import file header.php -->
<?php require_once __DIR__. "/../../layouts/header.php"; ?>

<!-- Page Heading -->
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Danh sách danh mục
            <a href="add.php" class="btn btn-success">Thêm mới</a>
        </h1>
        <ol class="breadcrumb">
            <li>
                <i class="fa fa-dashboard"></i>  <a href="<?php echo base_url() ?>admin/modules/category/"> Home </a>
            </li>
            <li class="active">
                <i class="fa fa-file"></i> Danh Mục
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
                        <th>Slug</th>
                        <th>Home</th>
                        <th>Created</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $stt = 1; foreach($category as $item): ?>
                        <tr>
                            <td><?php echo $stt; ?></td>
                            <td><?php echo $item['name'] ?></td>
                            <td><?php echo $item['slug'] ?></td>
                            <td>
                                <a href="home.php?id=<?php echo $item['id'] ?>" class="btn btn-xs <?php echo $item['home'] == 1 ? 'btn-info' : 'btn-default' ?>">
                                    <?php echo $item['home'] == 1 ? ' Hiện thị ' : ' Không ' ?>
                                </a>
                            </td>
                            <td><?php echo $item['created_at'] ?></td>
                            <td>
                                <a class="btn btn-xs btn-info" href="edit.php?id=<?php echo $item['id'] ?>"><i class="fa fa-edit"></i> Sửa</a>
                                <a class="btn btn-xs btn-danger" href="delete.php?id=<?php echo $item['id'] ?>"><i class="fa fa-times"></i>Xoá</a>
                            </td>
                        </tr>
                    <?php $stt++; endforeach?>
                </tbody>
            </table>
            <!-- number of page content here -->
            <div class="pull-right">
                <nav aria-label="Page navigation example pull-right">
                    <ul class="pagination">
                        <li class="page-item"><a class="page-link" href="#">Previous</a></li>
                        <li class="page-item"><a class="page-link" href="#">1</a></li>
                        <li class="page-item"><a class="page-link" href="#">2</a></li>
                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                        <li class="page-item"><a class="page-link" href="#">Next</a></li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>

</div>

<?php require_once __DIR__. "/../../layouts/footer.php"; ?>