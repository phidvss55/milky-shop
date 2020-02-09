<?php 

    require_once __DIR__. "/autoload/autoload.php";

    //khi click vô thông tin tài khoản nghĩa là đã tồn tại 1 id của user nào đó
    $idUser = intval($_SESSION['name_id']); //chuyển id về kiểu integer

    $EditUser = $db->fetchID("users", $idUser);

    if($_SERVER["REQUEST_METHOD"] == "POST") {
        
        $data = [
            "name" => postInput("name"),
            "email" => postInput("email"), //chuyen ten trong attribute, tu name -> slug
            "phone" => postInput("phone"),
            "address" => postInput("address")
        ];

        $error = [];

        if(postInput('name') == '') {
            $error['name'] = "Mời nhập nhập đầy đủ họ tên. ";
        }
        if(postInput('email') == '') {
            $error['email'] = "Mời nhập nhập đầy email. ";
        } else {
            if(postInput('email') != $EditUser['email']) {
                $isCheck = $db->fetchOne("users", " email = '".$data['email']."' ");
                if($isCheck != null) {
                    $error['email'] = " Email đã tồn tại. Mời bạn nhập lại Email. ";
                }
            }
        }
        if(postInput('phone') == '') {
            $error['phone'] = "Mời nhập nhập đầy đủ số điện thoại. ";
        }
        if(postInput('address') == '') {
            $error['address'] = "Mời nhập nhập đầy đủ địa chỉ. ";
        }
        if(postInput('password') != null && postInput('re_password') != null) {
            if(postInput('password') != postInput('re_password')) {
                $error['password'] = " Mật khẩu không khớp. Nhập lại mật khẩu. ";
            } else {
                $data['password'] = md5(postInput('password'));
            }
        }

        if(empty($error)) {
            $id_update = $db->update("users", $data, array("id" => $idUser));
            if($id_update > 0) {
                echo "<script>alert(' Cập nhật thông tin thành công. '); location.href='thong-tin-tai-khoan.php';</script>";
                $_SESSION['success'] = " Cập nhật thành công. ";
            } else {
                $_SESSION['error'] = " Cập nhật thất bại. ";
            }
        }
    } 
    

?>
<?php require_once __DIR__. "/layouts/header.php" ?>

<div class="col-md-9 bor">

    <section class="box-main1">
        <h3 class="title-main"><a href="#"> Thông tin tài khoản </a> </h3>
        <?php if(isset($_SESSION['success'])): ?>
            <div class="alert alert-success">
                <strong>Success!</strong><?php echo $_SESSION['success']; unset($_SESSION['success']) ?>
            </div>
        <?php endif ?>
        <?php if(isset($_SESSION['error'])): ?>
            <div class="alert alert-danger">
                <strong style="color: #a94442;">Error!</strong><?php echo $_SESSION['error']; unset($_SESSION['error']) ?>
            </div>
        <?php endif ?>
       <!-- Nội dung -->
       <form action="" method="POST" role="form" class="form-horizontal">
           <!-- Id khách hàng -->
           <div class="form-group">
                <div class="login-name">
                    <label class="col-md-3 control-label"> ID thành viên </label>
                    <div class="col-md-8">
                        <input type="text" readonly="" name="id" class="form-control" id="" value="<?php echo $EditUser['id'] ?>">
                    </div>
                </div>
            </div>
           <!-- Tên khách hàng -->
            <div class="form-group">
                    <label class="col-md-3 control-label"> Tên thành viên </label>
                    <div class="col-md-8">
                        <input type="text" name="name" class="form-control" id="" value="<?php echo $EditUser['name'] ?>">
                        <?php if(isset($error['name'])): ?>
                        <!-- kiem tra neu ten danh muc chua nhap thi moi nhap -->
                        <p style="margin-top: 12px;" class="alert alert-danger"><?php echo "<strong style='color: #a94442'>Oh snap! </strong>" . $error['name']; ?></p>
                        <?php endif ?>
                    </div>
            </div>
            <!-- Mail -->
            <div class="form-group">
                <label class="col-md-3 control-label"> Email </label>
                <div class="col-md-8">
                    <input type="email" name="email" class="form-control" id="" value="<?php echo $EditUser['email'] ?>">
                    <?php if(isset($error['email'])): ?>
                        <!-- kiem tra neu ten danh muc chua nhap thi moi nhap -->
                        <p style="margin-top: 12px;" class="alert alert-danger"><?php echo "<strong style='color: #a94442'>Oh snap! </strong>" . $error['email']; ?></p>
                    <?php endif ?>
                </div>
            </div>
            <!-- Phone -->
            <div class="form-group">
                <label class="col-md-3 control-label"> Số điện thoại </label>
                <div class="col-md-8">
                    <input type="number" name="phone" class="form-control" id="" value="<?php echo $EditUser['phone'] ?>">
                    <?php if(isset($error['phone'])): ?>
                        <!-- kiem tra neu ten danh muc chua nhap thi moi nhap -->
                        <p style="margin-top: 12px;" class="alert alert-danger"><?php echo "<strong style='color: #a94442'>Oh snap! </strong>" . $error['phone']; ?></p>
                    <?php endif ?>
                </div>
            </div>
            <!-- Password -->
            <div class="form-group">
                <label class="col-md-3 control-label"> Mật khẩu </label>
                <div class="col-md-8">
                    <input type="password" name="password" class="form-control" id="" value="" placeholder="************">
                    <?php if(isset($error['password'])): ?>
                        <!-- kiem tra neu ten danh muc chua nhap thi moi nhap -->
                        <p style="margin-top: 12px;" class="alert alert-danger"><?php echo "<strong style='color: #a94442'>Oh snap! </strong>" . $error['password']; ?></p>
                    <?php endif ?>
                </div>
            </div>
            <!-- Re-password -->
            <div class="form-group">
                <label class="col-md-3 control-label"> Nhập lại mật khẩu </label>
                <div class="col-md-8">
                    <input type="password" name="re_password" class="form-control" id="" value="" placeholder="************">
                </div>
            </div>
            <!-- Address -->
            <div class="form-group">
                <label class="col-md-3 control-label"> Địa chỉ </label>
                <div class="col-md-8">
                    <input type="text" name="address" class="form-control" id="" value="<?php echo $EditUser['address'] ?>">
                    <?php if(isset($error['address'])): ?>
                        <!-- kiem tra neu ten danh muc chua nhap thi moi nhap -->
                        <p style="margin-top: 12px;" class="alert alert-danger"><?php echo "<strong style='color: #a94442'>Oh snap! </strong>" . $error['address']; ?></p>
                    <?php endif ?>
                </div>
            </div>
            <div class="col-sm-offset-5 fixed-btn">
                <a class="btn btn-danger" href="index.php"><span class="glyphicon glyphicon-remove color-icon"></span> Quay lại </a>
                <button type="submit" class="btn btn-success"><span class="glyphicon glyphicon-floppy-disk color-icon"></span> Lưu thông tin </button>
            </div>
       </form>
    </section>
</div>

<?php require_once __DIR__. "/layouts/footer.php" ?>