<?php
    define("Title", "Admin | Sản phẩm ");
    $open = 'product';
    require_once __DIR__. "/../../autoload/autoload.php";

    // Danh sách danh mục sản phẩm 
    $category = $db->fetchAll("category");
    
    // //danh sách nhà cung cấp
    // $sql = "SELECT providers.name FROM providers INNER JOIN category ON 
    // providers.category_id = category.id AND providers.category_id = 3";

    // $providers = $db->fetchAll("providers");

    if($_SERVER["REQUEST_METHOD"] == "POST") {
        
        $data = [
            "name" => postInput("name"),
            "slug" => to_slug(postInput("name")), //chuyen ten trong attribute, tu name -> slug
            "providers_id" => postInput("providers_id"),
            "category_id" => postInput("category_id"),
            "price" => postInput("price"),
            "number" => postInput("number"),
            "content" => postInput("content")
        ];

        $error = []; //Dùng để bắt lỗi
        //neu name dang trong va chua nhap 
        if(postInput('name') == '') {
            $error['name'] = "Mời bạn nhập đầy đủ theo tên sản phẩm";
        }
        if(postInput('providers_id') == '') {
            $error['providers_id'] = "Mời bạn chọn tên nhà cung cấp";
        }
        if(postInput('category_id') == '') {
            $error['category_id'] = "Mời bạn chọn tên danh mục. ";
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
        // if(!isset($_FILES['thunbar']) == false) { //what the fuck it not working?????/
        //     $error['thunbar'] = "Mời bạn chọn hình ảnh";
        // }
        if($_FILES['thunbar']['error'] == 4) {
                $error['thunbar'] = "Mời bạn chọn hình ảnh";
        }

        if(empty($error)) { //nếu biến error trống -> nghĩa là không có lỗi, dữ liệu đã nhập thnahf công
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

            $id_insert = $db->insert("product", $data);
            if($id_insert) {
                move_uploaded_file($file_tmp, $part.$file_name);
                $_SESSION['success'] = "Thêm mới thành công.";
                redirectAdmin("product");
            } else {
                $_SESSION['error'] = "Thêm mới thất bại.";

            }
        }
    }
?>

<?php require_once __DIR__. "/../../layouts/header.php"; ?>
 <!-- Page Heading -->
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">
                Thêm mới sản phẩm
            </h1>
            <ol class="breadcrumb">
                <li>
                    <i class="fa fa-dashboard"></i>  <a href="index.php">Dashboard</a>
                </li>
                <li>
                    <i></i><a href="index.php"> Sản phẩm</a>
                </li>
                <li class="active">
                    <i class="fa fa-file"></i> Thêm mới
                </li>
            </ol>
            <div class="clearfix"></div>
            <!-- Thông báo lỗi -->
            <?php require_once __DIR__. "/../../../partials/notification.php"; ?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <form class="form-horizontal" action="" method="post" enctype="multipart/form-data">
                <!-- Tên danh mục -->
                <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label"> Danh mục sản sản phẩm</label>
                    <div class="col-sm-8">
                        <select name="category_id" class="form-control col-md-8" onchange="getState(this.value);">
                            <option value=""> - Mời bạn chọn danh mục sản phẩm - </option>
                            <?php foreach($category as $item): ?>
                                <option value="<?php echo $item['id'] ?>"><?php echo $item['name'] ?></option>
                            <?php endforeach ?>
                        </select>
                        <?php if(isset($error['category_id'])): ?> 
                        <!-- kiem tra neu ten danh muc chua nhap thi moi nhap -->
                        <p style="margin-top: 45px;" class="alert alert-danger"><?php echo "<strong>Oh snap! </strong>"
                             . $error['category_id']; ?></p>
                        <?php endif ?>
                    </div>
                </div>
                <!-- nhà cung cấp -->
                <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label"> Nhà cung cấp sản phẩm</label>
                    <div class="col-sm-8">
                        <select name="providers_id" id="providers-list" class="form-control col-md-8">
                             <option value=""> - Chọn nhà cung cấp - </option>
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
                        <input type="text" class="form-control" id="inputEmail3" placeholder="Tên sản phẩm " name="name">
                        <?php if(isset($error['name'])): ?> 
                        <!-- kiem tra neu ten danh muc chua nhap thi moi nhap -->
                        <p style="margin-top: 12px;" class="alert alert-danger"><?php echo "<strong>Oh snap! </strong>" . $error['name']; ?></p>
                        <?php endif ?>
                    </div>
                </div>
                <!-- Giá sản phẩm -->
                <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label">Giá sản phẩm</label>
                    <div class="col-sm-8">
                        <input type="number" class="form-control" id="inputEmail3" placeholder="100.000" name="price">
                        <?php if(isset($error['price'])): ?> 
                        <!-- kiem tra neu ten danh muc chua nhap thi moi nhap -->
                        <p style="margin-top: 12px;" class="alert alert-danger"><?php echo "<strong>Oh snap! </strong>"
                        . $error['price']; ?></p>
                        <?php endif ?>
                    </div>
                </div>
                <!-- Số lượng sản phẩm -->
                <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label">Số lượng</label>
                    <div class="col-sm-8">
                        <input type="number" class="form-control" id="inputEmail3" placeholder="1" name="number">
                        <?php if(isset($error['number'])): ?> 
                        <!-- kiem tra neu ten danh muc chua nhap thi moi nhap -->
                        <p style="margin-top: 12px;" class="alert alert-danger"><?php echo "<strong>Oh snap! </strong>"
                        . $error['number']; ?></p>
                        <?php endif ?>
                    </div>
                </div>
                <!-- Mã giảm giá -->
                <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label">Giảm giá sản phẩm</label>
                    <div class="col-sm-3">
                        <input type="number" class="form-control" id="inputEmail3" value="0" placeholder="10 %" name="sale">
                    </div>
                    <!-- nhập ảnh thu nhỏ của nó -->    
                    <label for="inputEmail3 " class="col-sm-1 control-label">Hình ảnh </label>
                    <div class="col-sm-3">
                        <input type="file" class="form-control" id="inputEmail3" name="thunbar">
                        <?php if(isset($error['thunbar'])): ?>
                            <!-- kiem tra coi sản phẩm còn trống hay không -->
                            <p style="margin-top: 12px;" class="alert alert-danger">
                            <?php echo "<strong>Oh snap! </strong>" . $error['thunbar']; ?></p>
                        <?php endif ?>
                    </div>
                </div>
                <!-- Miêu tả sản phẩm -->
                <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label"> Nội dung </label>
                    <div class="col-sm-8">
                        <textarea class="form-control" name="content" rows="4"></textarea>
                        <?php if(isset($error['content'])): ?> 
                        <!-- kiem tra neu ten danh muc chua nhap thi moi nhap -->
                        <p style="margin-top: 12px;" class="alert alert-danger"><?php echo "<strong>Oh snap! </strong>" 
                            . $error['content']; ?></p>
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


<?php require_once __DIR__. "/../../layouts/footer.php"; ?>