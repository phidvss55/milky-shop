<?php

    require_once __DIR__ . "/autoload/autoload.php";
    //khuc nay co ket noi nhung ma da co san la Contructor ben file database
    // $con = mysqli_connect("localhost", "root", "", "webprograming") or die(" Lỗi kết nối cơ sở dữ liệu. ");
    // mysqli_set_charset($con, "utf8");

    //xử lý action
    if(isset($_SESSION['name_id'])) {
        echo "<script>alert('Bạn đã có tài khoản, không thể chọn mục này. '); location.href='index.php'</script>";
    }

    $data = [
        // neu ton tai name -> tra ve cai gia tri name else ''
        'name'      => postInput('name'),
        'email'     => postInput('email'),
        'password'  => (postInput('password')),
        'phone'     => postInput('phone'),
        'address'   => postInput('address')
    ];

    $error = [];

    if($_SERVER['REQUEST_METHOD'] == "POST") {
        //contruct validate and sign up 
        if($data['name'] == '') {
            $error['name'] = " Tên không được để trống. ";
        }

        if($data['email'] == '') {
            $error['email'] = " Email không được để trống. ";
        } else {
            $isCheck = $db->fetchOne("users", "email='".$data['email']."' ");
            if($isCheck != null) {
                $error['email'] = " Địa chỉ email đã tồn tại, Hãy chọn địa chỉ khác. ";
            }
        }

        if($data['phone'] == '') {
            $error['phone'] = " Số điện thoại không được để trống. ";
        }
      
        if($data['password'] == '') {
            $error['password'] = " Mật khẩu không được để trống. ";
        } else {
            $data['password'] = MD5(postInput('password'));
        }

        if($data['address'] == '') {
            $error['address'] = " Địa chỉ không được để trống. ";
        }

        //check error array, if empty error -> all correct
        if(empty($error)) {
            //insert
            // $sql = "INSERT INTO users(name, email, password, phone, address) VALUES ('".$name."','".$email."', '".md5($password)."','".$phone."','".$address."')";
            // $insert = mysqli_query($con, $sql) or die (" Thêm mới thất bại. ");
            $idinsert = $db->insert("users",$data);
            if($idinsert > 0) {
                $_SESSION['success'] = " Đăng ký thành công mời bạn đăng nhập. ";
                header("location: signin.php");
            } else {
                echo " Thất bại ";
            }
        }
    }

?>
<?php require_once __DIR__ . "/layouts/header.php" ?>

<div class="col-md-9 bor">

    <section class="box-main1">
        <h3 class="title-main"><a href=""> Đăng ký thành viên </a> </h3>
        <form action="" method="POST" class="form-horizontal" role="form">
            <!-- họ tên người dùng -->
            <div class="form-group">
                <div class="login-name">
                    <label class="col-md-3 control-label"> Tên thành viên </label>
                    <div class="col-md-9">
                        <input type="text" name="name" placeholder=" Trần Thị Nở" class="form-control"
                            value="<?php echo $data['name'] ?>">
                        <?php if(isset($error['name'])): ?>
                            <p class="text-danger"><?php echo $error['name'] ?></p>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            <!-- email người dùng -->
            <div class="form-group">
                <label class="col-md-3 control-label"> Email </label>
                <div class="col-md-9">
                    <input type="text" name="email" placeholder=" notungtang.123@gmail.com" 
                        class="form-control" value="<?php echo $data['email'] ?>">
                    <?php if(isset($error['email'])): ?>
                        <p class="text-danger"><?php echo $error['email'] ?></p>
                    <?php endif; ?>
                </div>
            </div>
            <!-- mật khảu người dùng -->
            <div class="form-group">
                <label class="col-md-3 control-label"> Mật khẩu </label>
                <div class="col-md-9">
                    <input type="password" name="password" placeholder=" *********" class="form-control"
                        value="<?php echo $data['password'] ?>">
                    <?php if(isset($error['password'])): ?>
                        <p class="text-danger"><?php echo $error['password'] ?></p>
                    <?php endif; ?>
                </div>
            </div>
            <!-- So dien thoai -->
            <div class="form-group">
                <label class="col-md-3 control-label"> Số điện thoại </label>
                <div class="col-md-9">
                    <input type="number" name="phone" placeholder=" 0335058765" class="form-control"
                        value="<?php echo $data['phone'] ?>">
                    <?php if(isset($error['phone'])): ?>
                        <p class="text-danger"><?php echo $error['phone'] ?></p>
                    <?php endif; ?>
                </div>
            </div>
            <!-- Địa chỉ người dùng -->
            <div class="form-group">
                <label class="col-md-3 control-label"> Địa chỉ người dùng </label>
                <div class="col-md-9">
                    <input style="font-family: Arial" type="text" name="address" placeholder=" 494/65/9A, xã Đại Sơn, huyện Đô Lương, tỉnh Nghệ An" 
                        class="form-control"  value="<?php echo $data['address'] ?>">
                    <?php if(isset($error['address'])): ?>
                        <p class="text-danger"><?php echo $error['address'] ?></p>
                    <?php endif; ?>
                </div>
            </div>
            <button type="submit" class="btn btn-success col-md-2 col-md-offset-5" style="margin-bottom: 15px;"> Đăng Ký </button>
        </form>
    </section>
</div>

<?php require_once __DIR__ . "/layouts/footer.php" ?>