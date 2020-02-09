<?php
    define("Title", "Admin | Nhà cung cấp ");
    $open = 'providers';
    
    require_once __DIR__. "/../../autoload/autoload.php";

    // Danh sách danh mục sản phẩm 
    $category = $db->fetchAll("category");

    if($_SERVER["REQUEST_METHOD"] == "POST") {
        
        $data = [
            "name"        => postInput("name"),
            "category_id" => postInput("category_id"),
        ];

        $error = []; //Dùng để bắt lỗi
        //neu name dang trong va chua nhap 
        if(postInput('name') == '') {
            $error['name'] = "Mời bạn nhập đầy đủ tên nhà cung cấp ";
        }
        if(postInput('category_id') == '') {
            $error['category_id'] = "Mời bạn chọn tên loại sữa";
        }

        if(empty($error)) { //nếu biến error trống -> nghĩa là không có lỗi, dữ liệu đã nhập thnahf công

             // kiểm tra có tồn tại cái name trong csdl hay k?
            $isset = $db->fetchOne("providers", " name = '". $data['name']. "' and category_id = '".$data['category_id']."' ");

            if(count($isset) > 0) {
                 $_SESSION['error'] = "Tên nhà cung cấp đã tồn tại";
            } else {
                $id_insert = $db->insert("providers", $data);
                if($id_insert > 0) {
                    $_SESSION['success'] = "Thêm mới thành công.";
                    redirectAdmin("providers");
                } else {
                    $_SESSION['error'] = "Thêm mới không thành công. "; 

                }
            }
        }
    }
?>

<?php require_once __DIR__. "/../../layouts/header.php"; ?>

 <!-- Page Heading -->
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">
                Thêm mới nhà cung cấp 
            </h1>
            <ol class="breadcrumb">
                <li>
                    <i class="fa fa-dashboard"></i><a href="<?php echo base_url() ?>admin/modules/providers/"> Dashboard </a>
                </li>
                <li>
                    <i></i><a href="index.php"> Nhà cung cấp </a>
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
                <!-- danh mục -->
                <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label"> Loại sữa </label>
                    <div class="col-sm-8">
                        <select name="category_id" id="" class="form-control col-md-8">
                            <option value="<?php echo $item['category_id'] ?>"> - Mời bạn chọn loại sữa - </option>
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
                <!-- Tên sản phẩm -->
                
                <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label">Tên nhà cung cấp </label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="inputEmail3" placeholder="Tên nhà cung cấp " name="name">
                        <?php if(isset($error['name'])): ?> 
                        <!-- kiem tra neu ten danh muc chua nhap thi moi nhap -->
                        <p style="margin-top: 12px;" class="alert alert-danger"><?php echo "<strong>Oh snap! </strong>" . $error['name']; ?></p>
                        <?php endif ?>
                    </div>
                </div>
                <!--  -->
                <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                        <button type="submit" class="btn btn-success"><span class="glyphicon glyphicon-floppy-disk"></span> Save</button>
                        <a class="btn btn-danger" href="index.php"><span class="glyphicon glyphicon-remove"></span> Cancel</a>
                    </div>
                </div>
            </form>
        </div>
    </div>


<?php require_once __DIR__. "/../../layouts/footer.php"; ?>