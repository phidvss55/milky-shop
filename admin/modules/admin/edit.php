<?php
    define("Title", "Trang Admin");
    $open = 'admin';
    require_once __DIR__. "/../../autoload/autoload.php";

    // Danh sách danh mục sản phẩm 
    // $category = $db->fetchAll("category");

    //check co ton tai cai id k 
    $id = intval(getInput('id')); //intval chuyener sang kieu interger

    $EditAdmin = $db->fetchID("admin", $id);
    if(empty($EditAdmin)) { 
        $_SESSION['error'] = "Dữ liệu không tồn tại";
        redirectAdmin("admin");
    }

    if($_SERVER["REQUEST_METHOD"] == "POST") {
        
        $data = [
            "name" => postInput("name"),
            "email" => postInput("email"), //chuyen ten trong attribute, tu name -> slug
            "phone" => postInput("phone"),
            "address" => postInput("address"),
            "level" => postInput("level")
        ];

        $error = []; //Dùng để bắt lỗi
        //neu name dang trong va chua nhap 
        if(postInput('name') == '') {
            $error['name'] = "Mời bạn nhập đầy đủ họ và tên";
        }
        if(postInput('email') == '') {
            $error['email'] = "Mời bạn nhập email người dùng.";
        } 
        else {
            if(postInput('email') != $EditAdmin['email']) {
                $isCheck  = $db->fetchOne("admin", " email = '" .$data['email']."' ");
                if($isCheck != null) {
                    $error['email'] = " Email đẫ tồn tại. Nhập lại Email";
                }
            }
        }
        if(postInput('phone') == '') { 
            $error['phone'] = "Mời bạn nhập số điện thoại.";
        }
        if(postInput('address') == '') { 
            $error['address'] = "Mời bạn nhập địa chỉ.";
        }
        if(postInput('password') != null && postInput("re_password") != null) {
            if(postInput('password') != postInput('re_password')) {
                $error['password'] = " Mật khẩu thay đổi không khớp ";
            } else {
                $data['password'] = MD5(postInput("password"));
            }
        }

        if(empty($error)) { //nếu biến error trống -> nghĩa là không có lỗi, dữ liệu đã nhập thnahf công  
            
            $id_update = $db->update("admin", $data, array("id" => $id));
            if($id_update > 0) 
            {
                $_SESSION['success'] = "Cập nhật thành công.";
                redirectAdmin("admin");
            } else {
                $_SESSION['error'] = "Cập nhật thất bại.";
                redirectAdmin("admin");
            }
        }
    }
?>

<?php require_once __DIR__. "/../../layouts/header.php"; ?>

 <!-- Page Heading -->
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">
                Thêm mới Admin
            </h1>
            <ol class="breadcrumb">
                <li>
                    <i class="fa fa-dashboard"></i>  <a href="index.html">Dashboard</a>
                </li>
                <li>
                    <i></i><a href="index.php"> Admin </a>
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
            <form class="form-horizontal" action="" method="POST" enctype="multipart/form-data">
                <!-- Họ và tên -->
                <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label"> Họ và tên </label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="inputEmail3" placeholder="Nhập họ và tên ... " name="name" 
                        value="<?php echo $EditAdmin['name'] ?>">
                        <?php if(isset($error['name'])): ?> 
                        <!-- kiem tra neu ten danh muc chua nhap thi moi nhap -->
                        <p style="margin-top: 12px;" class="alert alert-danger"><?php echo "<strong>Oh snap! </strong>" . $error['name']; ?></p>
                        <?php endif ?>
                    </div>
                </div>
                <!-- Email -->
                <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label"> Email </label>
                    <div class="col-sm-8">
                        <input type="email" class="form-control" id="inputEmail3" placeholder="sieunhan.12@gmail.com" name="email" 
                        value="<?php echo $EditAdmin['email'] ?>">
                        <?php if(isset($error['email'])): ?> 
                        <!-- kiem tra neu ten danh muc chua nhap thi moi nhap -->
                        <p style="margin-top: 12px;" class="alert alert-danger"><?php echo "<strong>Oh snap! </strong>"
                        . $error['email']; ?></p>
                        <?php endif ?>
                    </div>
                </div>
                <!-- Phone -->
                <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label"> Phone </label>
                    <div class="col-sm-8">
                        <input type="number" class="form-control" id="inputEmail3" placeholder="0123456798" name="phone" 
                        value="<?php echo $EditAdmin['phone'] ?>">
                        <?php if(isset($error['phone'])): ?> 
                        <!-- kiem tra neu ten danh muc chua nhap thi moi nhap -->
                        <p style="margin-top: 12px;" class="alert alert-danger"><?php echo "<strong>Oh snap! </strong>"
                        . $error['phone']; ?></p>
                        <?php endif ?>
                    </div>
                </div>
                <!-- Password -->
                <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label"> Password </label>
                    <div class="col-sm-8">
                        <input type="password" class="form-control" id="inputEmail3" placeholder="********" name="password">
                        <?php if(isset($error['password'])): ?> 
                        <!-- kiem tra neu ten danh muc chua nhap thi moi nhap -->
                        <p style="margin-top: 12px;" class="alert alert-danger"><?php echo "<strong>Oh snap! </strong>"
                        . $error['password']; ?></p>
                        <?php endif ?>
                    </div>
                </div>
                <!-- Re Password -->
                <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label"> ConfigPassword </label>
                    <div class="col-sm-8">
                        <input type="password" class="form-control" id="inputEmail3" placeholder="********" name="re_password">
                        <?php if(isset($error['re_password'])): ?> 
                        <!-- kiem tra neu ten danh muc chua nhap thi moi nhap -->
                        <p style="margin-top: 12px;" class="alert alert-danger"><?php echo "<strong>Oh snap! </strong>"
                        . $error['re_password']; ?></p>
                        <?php endif ?>
                    </div>
                </div>
                 <!-- Địa chỉ -->
                 <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label"> Địa chỉ </label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="inputEmail3" placeholder="Xóm 10, xã Đại Sơn, huyện Đô Lương, tỉnh Nghệ An"
                            name="address" value="<?php echo $EditAdmin['address'] ?>">
                        <?php if(isset($error['address'])): ?> 
                        <!-- kiem tra neu ten danh muc chua nhap thi moi nhap -->
                        <p style="margin-top: 12px;" class="alert alert-danger">
                            <?php echo "<strong>Oh snap! </strong>" . $error['address']; ?></p>
                        <?php endif ?>
                    </div>
                </div>
                 <!-- Level -->
                 <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label"> Level </label>
                    <div class="col-sm-8">
                        <select class="form-control" name="level">
                            <option value=""><?php  echo (isset($EditAdmin['level']) && 
                                $EditAdmin['level'] == 1) ? 'CTV' : 'Admin' ?></option>
                        </select>
                        <?php if(isset($error['level'])): ?> 
                        <!-- kiem tra neu ten danh muc chua nhap thi moi nhap -->
                        <p style="margin-top: 12px;" class="alert alert-danger">
                            <?php echo "<strong>Oh snap! </strong>" . $error['address']; ?></p>
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