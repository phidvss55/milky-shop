<?php
define("Title", "Admin | Nhà cung cấp ");
$open = 'providers';
require_once __DIR__ . "/../../autoload/autoload.php";

//check co ton tai cai id k 
$id = intval(getInput('id')); //lay id tren thanh url

$EditProviders = $db->fetchID("providers", $id); //lay bang ghi trong bang providers theo cai id
if (empty($EditProviders)) { //check if not exist this providers //trong -> k co du lieu
    $_SESSION['error'] = "Dữ liệu không tồn tại";
    redirectAdmin("providers"); //->quay ve providers
}
//con neu k trong thi dua vao id chung ta dua gia tri vao cac fields san
// Danh sách danh mục sản phẩm 
$category = $db->fetchAll("category");


if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $data = [
        "name" => postInput("name"),
        "category_id" => postInput("category_id"),
    ];

    $error = []; //Dùng để bắt lỗi
        if(postInput('name') == '') {
            $error['name'] = "Mời bạn nhập đầy đủ theo tên danh mục";
        }
        if(postInput('category_id') == '') {
            $error['category_id'] = "Mời bạn chọn tên danh mục";
        }

    if (empty($error)) { //nếu biến error trống -> nghĩa là không có lỗi
        $update = $db->update("providers", $data, array("id"=>$id));
        if($update > 0) {
            $_SESSION['success']="Thêm mới thành công";
            redirectAdmin("providers");
        } else {        
            $_SESSION['error'] = "Cập nhật thất bại";
            redirectAdmin("providers");
        }
    }
}
?>

<?php require_once __DIR__ . "/../../layouts/header.php"; ?>

<!-- Page Heading -->
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">
            Chỉnh sửa thông tin nhà cung cấp
        </h1>
        <ol class="breadcrumb">
            <li>
                <i class="fa fa-dashboard"></i> <a href="index.php">Dashboard</a>
            </li>
            <li>
                <i></i><a href="index.php"> Nhà cung cấp </a>
            </li>
            <li class="active">
                <i class="fa fa-file"></i> Chỉnh sửa
            </li>
        </ol>
        <div class="clearfix"></div>
        <!-- Thông báo lỗi -->
        <?php require_once __DIR__ . "/../../../partials/notification.php"; ?>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <form class="form-horizontal" action="" method="POST" enctype="multipart/form-data">
            <!-- Nhà cung cấp -->
            <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label"> Nhà cung cấp </label>
                <div class="col-sm-8">
                    <select name="category_id" id="" class="form-control col-md-8">
                        <option value=""> - Mời bạn chọn nhà cung cấp - </option>
                        <?php foreach ($category as $item) : ?>
                            <option value="<?php echo $item['id'] ?>"<?php echo $EditProviders['category_id'] == $item['id']
                            ? "selected = 'selected'" : '' ?>><?php echo $item['name']; ?></option>
                        <?php endforeach ?>
                    </select>
                    <?php if (isset($error['category'])) : ?>
                        <!-- kiem tra neu ten danh muc chua nhap thi moi nhap -->
                        <p style="margin-top: 12px;" class="alert alert-danger">
                            <?php echo "<strong>Oh snap! </strong>". $error['category']; ?>
                        </p>
                    <?php endif ?>
                </div>
            </div>
            <!-- Tên nhà cung cấp  -->
            <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label">Tên nhà cung cấp </label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" id="inputEmail3" placeholder="Tên danh mục" name="name" 
                    value="<?php echo $EditProviders['name'] ?>">
                    <?php if (isset($error['name'])) : ?>
                        <!-- kiem tra neu ten danh muc chua nhap thi moi nhap -->
                        <p style="margin-top: 12px;" class="alert alert-danger"><?php echo "<strong>Oh snap! </strong>" . $error['name']; ?></p>
                    <?php endif ?>
                </div>
            </div>
            <!--  -->
            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                    <button type="submit" class="btn btn-success">Save</button>
                </div>
            </div>
        </form>
    </div>
</div>


<?php require_once __DIR__ . "/../../layouts/footer.php"; ?>