<?php
    define("Title", "Admin | Sản phẩm ");
    $open = 'product';
    require_once __DIR__ . "/../../autoload/autoload.php";

    //check co ton tai cai id k 
    $id = intval(getInput('id')); //lay id tren thanh url

    $EditProduct = $db->fetchID("product", $id); //lay bang ghi trong bang product theo cai id
    
    if (empty($EditProduct)) { //check if not exist this product //trong -> k co du lieu
        $_SESSION['error'] = "Dữ liệu không tồn tại";
        redirectAdmin("product"); //->quay ve product
    }
    //con neu k trong thi dua vao id chung ta dua gia tri vao cac fields san
    // Danh sách danh mục sản phẩm 
    $category = $db->fetchAll("category");

    $idProvider = intval(getInput("providers_id"));
    
    $EditProviders = $db->fetchID("providers", $idProvider); //lay bang ghi trong bang product theo cai id

    if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $data = [
        "name" => postInput("name"),
        "slug" => to_slug(postInput("name")), //chuyen ten trong attribute, tu name -> slug
        "providers_id" => postInput("providers_id"),
        "category_id" => postInput("category_id"),
        "price" => postInput("price"),
        "number" => postInput("number"),
        "content" => postInput("content"),
        "sale" => postInput("sale")
    ];

    $error = []; //Dùng để bắt lỗi
        if(postInput('name') == '') {
            $error['name'] = "Mời bạn nhập đầy đủ theo tên danh mục";
        }
        if(postInput('category_id') == '') {
            $error['category_id'] = "Mời bạn chọn tên danh mục";
        }
        if(postInput('providers_id') == '') {
            $error['providers_id'] = "Mời bạn chọn tên nhà cung cấp";
        }
        if(postInput('price') == '') {
            $error['price'] = "Mời bạn nhập giá của sản phẩm.";
        }
        if(postInput('content') == '') { 
            $error['content'] = "Mời bạn nhập nội dung sản phẩm.";
        }
        if(postInput('number') == '') { 
            $error['number'] = "Mời bạn nhập số lượng sản phẩm.";
        }
        //not catch error images

    if (empty($error)) { //nếu biến error trống -> nghĩa là không có lỗi
        echo "<script>alert('xin chao');</script>";
        if(isset($_FILES['thunbar'])) { //kt neu ton tai file anh thunbar
            $file_name = $_FILES['thunbar']['name'];
            $file_tmp = $_FILES['thunbar']['tmp_name'];
            $file_type = $_FILES['thunbar']['type'];
            $file_erro = $_FILES['thunbar']['error'];

            if($file_erro == 0) {
                //ROOT đã khai báo ở file autoload.php
                $part = ROOT . "product/"; //đường dẫn của nó sẽ trỏ tới mục product 
                $data['thunbar'] = $file_name;
            }
        }

        $update = $db->update("product", $data, array("id"=>$id));
        
        if($update > 0) {
            move_uploaded_file($file_tmp, $part.$file_name);
            $_SESSION['success']="Cập nhật thành công";
            redirectAdmin("product");
        } else {        
            $_SESSION['error'] = "Cập nhật thất bại";
            redirectAdmin("product");
        }
    }
}
?>

<?php require_once __DIR__ . "/../../layouts/header.php"; ?>

<!-- Page Heading -->
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">
            Thêm mới sản phẩm
        </h1>
        <ol class="breadcrumb">
            <li>
                <i class="fa fa-dashboard"></i> <a href="index.php">Dashboard</a>
            </li>
            <li>
                <i></i><a href="index.php"> Sản phẩm</a>
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
            <!-- danh mục -->
            <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label"> Danh mục sản phẩm</label>
                <div class="col-sm-8">
                    <select name="category_id" id="" class="form-control col-md-8" onchange="getState(this.value);">
                        <option value=""> - Mời bạn chọn danh mục sản phẩm - </option>
                        <?php foreach ($category as $item) : ?>
                            <option value="<?php echo $item['id'] ?>"<?php echo $EditProduct['category_id'] == $item['id']
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
            <!-- Tên nhà cung cấp -->
            <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label"> Nhà cung cấp sản phẩm</label>
                    <div class="col-sm-8">
                        <select name="providers_id" id="providers-list" class="form-control col-md-8">
                             <!-- <option value=""> - Mời bạn chọn nhà cung cấp - </option> -->
                             <option value="<?php echo $EditProviders['id'] ?>"> <?php echo $EditProviders['name']  ?> </option>
                        </select>
                        <?php if(isset($error['providers_id'])): ?> 
                        <!-- kiem tra neu ten danh muc chua nhap thi moi nhap -->
                        <p style="margin-top: 45px;" class="alert alert-danger"><?php echo "<strong>Oh snap! </strong>"
                             . $error['providers_id']; ?></p>
                        <?php endif ?>
                    </div>
                </div>
            <!-- Tên sản phẩm -->
            <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label">Tên sản phẩm</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" id="inputEmail3" placeholder="Tên danh mục" name="name" 
                    value="<?php echo $EditProduct['name'] ?>">
                    <?php if (isset($error['name'])) : ?>
                        <!-- kiem tra neu ten danh muc chua nhap thi moi nhap -->
                        <p style="margin-top: 12px;" class="alert alert-danger"><?php echo "<strong>Oh snap! </strong>" . $error['name']; ?></p>
                    <?php endif ?>
                </div>
            </div>
            <!-- Giá sản phẩm -->
            <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label">Giá sản phẩm</label>
                <div class="col-sm-8">
                    <input type="number" class="form-control" id="inputEmail3" placeholder="9.000.000" name="price" 
                    value="<?php echo $EditProduct['price'] ?>">
                    <?php if (isset($error['price'])) : ?>
                        <!-- kiem tra neu ten danh muc chua nhap thi moi nhap -->
                        <p style="margin-top: 12px;" class="alert alert-danger"><?php echo "<strong>Oh snap! </strong>" . $error['price']; ?></p>
                    <?php endif ?>
                </div>
            </div>
            <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label">Số lượng</label>
                    <div class="col-sm-8">
                        <input type="number" class="form-control" id="inputEmail3" placeholder="1" name="number"
                        value="<?php echo $EditProduct['number']; ?>">
                        <?php if(isset($error['number'])): ?> 
                        <!-- kiem tra neu ten danh muc chua nhap thi moi nhap -->
                        <p style="margin-top: 12px;" class="alert alert-danger"><?php echo "<strong>Oh snap! </strong>"
                        . $error['number']; ?></p>
                        <?php endif ?>
                    </div>
                </div>
            <!-- Mã giảm giá và hình ảnh demo của sản phẩm -->
            <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label">Giảm giá sản phẩm</label>
                <div class="col-sm-2">
                    <input type="number" class="form-control" id="inputEmail3" value="<?php echo $EditProduct['sale']; ?>" placeholder="10 %" name="sale">
                </div>
                <!-- nhập ảnh thu nhỏ của nó -->
                <label for="inputEmail3" class="col-sm-1 control-label">Giảm giá </label>
                <div class="col-sm-3">
                    <input type="file" class="form-control" id="inputEmail3" name="thunbar">
                    <?php if (isset($error['thunbar'])) : ?>
                        <!-- kiem tra neu ten danh muc chua nhap thi moi nhap -->
                        <p style="margin-top: 12px;" class="alert alert-danger">
                            <?php echo "<strong>Oh snap! </strong>" . $error['thunbar']; ?>
                        </p>
                    <?php endif ?>
                    <img src="<?php echo uploads() ?>product/<?php echo $EditProduct['thunbar'] ?>" 
                        width="50px" height="80px">
                </div>
            </div>
            <!-- Miêu tả sản phẩm -->
            <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label"> Nội dung </label>
                <div class="col-sm-8">
                    <textarea class="form-control" name="content" rows="4"><?php echo $EditProduct['content'] ?></textarea>
                    <?php if (isset($error['content'])) : ?>
                        <!-- kiem tra neu ten danh muc chua nhap thi moi nhap -->
                        <p style="margin-top: 12px;" class="alert alert-danger">
                            <?php echo "<strong>Oh snap! </strong>" . $error['content']; ?></p>
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