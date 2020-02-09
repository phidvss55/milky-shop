<?php
    define("Title", "Admin | Danh mục sản phẩm ");
    $open = 'category';
    require_once __DIR__. "/../../autoload/autoload.php";

    if($_SERVER["REQUEST_METHOD"] == "POST") {
        
        $data = [
            "name" => postInput("name"),
            "slug" => to_slug(postInput("name")) //chuyen ten trong attribute, tu name -> slug
        ];

        $error = [];
        //neu name dang trong va chua nhap
        if(postInput('name') == '') {
            $error['name'] = "Mời bạn nhập đầy đủ theo tên danh mục";
        }

        if(empty($error)) { //nếu biến error trống -> nghĩa là không có lỗi

            // kiểm tra có tồn tại cái name trong csdl hay k?
            $isset = $db->fetchOne("category", " name = '".$data['name']. "' ");

            if(count($isset) > 0) {
                $_SESSION['error'] = "Tên danh mục đã tồn tại";
            } else {
                $id_insert = $db->insert("category", $data); //them moi thanh cong thi tra ve id_insert
                // print_r($id_insert);
    
                if($id_insert > 0) {
                    $_SESSION['success'] = "Thêm mới thành công"; //dong thong bao - phai dat truoc moi gui toi 
                    redirectAdmin("category"); //thêm thành công thi redirect ve trang admin
                } else {
                    //thêm thất bại
                    $_SESSION['error'] = "Thêm mới thất bại"; 
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
                Thêm mới danh mục
            </h1>
            <ol class="breadcrumb">
                <li>
                    <i class="fa fa-dashboard"></i>  <a href="<?php echo base_url() ?>admin/modules/category/">Dashboard</a>
                </li>
                <li>
                    <i></i><a href="index.php">Danh mục</a>
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
            <form class="form-horizontal" action="" method="POST">
                <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label">Tên danh mục</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="inputEmail3" placeholder="Tên danh mục" name="name">
                        <?php if(isset($error['name'])): ?> 
                        <!-- kiem tra neu ten danh muc chua nhap thi moi nhap -->
                        <p style="margin-top: 12px;" class="alert alert-danger"><?php echo "<strong>Oh snap! </strong>" . $error['name']; ?></p>
                        <?php endif ?>
                    </div>
                </div>
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