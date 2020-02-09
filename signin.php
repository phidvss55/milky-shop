<?php 

    require_once __DIR__. "/autoload/autoload.php";

    $data = [
        'email'     => postInput('email'),
        'password'  => postInput('password')
    ];

    $error = [];

    if($_SERVER["REQUEST_METHOD"] == "POST") {
        if($data['email'] == '') {
            $error['email'] = " Email không được để trống. ";
        }

        if($data['password'] == '') {
            $error['password'] = " Password không được để trống. ";
        }

        if(empty($error)) {

            $isCheck = $db->fetchOne("users", "email = '" .$data['email']."' and password = '".md5($data['password'])."' ");
            
            if($isCheck != null) {
                $_SESSION['name_user'] = $isCheck['name']; //gan gia tri -> hien thi thong bao khi 
                $_SESSION['name_id'] = $isCheck['id']; //dang nhap thanh cong
                echo "<script>alert(' Đăng nhập thành công '); location.href='index.php'</script>";
    
            } else {
                //failed to login
                $_SESSION['error'] = " Đăng nhập thất bại. Sai tên tài khoản hoặc mật khẩu. ";
            }
        }
    }

?>
<?php require_once __DIR__. "/layouts/header.php" ?>

<div class="col-md-9 bor">

    <section class="box-main1">
        <h3 class="title-main" ><a href=""> Đăng nhập </a> </h3>
        <?php if(isset($_SESSION['success'])): ?>
            <div class="alert alert-success">
                <strong style="color: #3c763d;">Success!</strong><?php echo $_SESSION['success']; unset($_SESSION['success']) ?>
            </div>
        <?php endif ?>
        <?php if(isset($_SESSION['error'])): ?>
            <div class="alert alert-danger">
                <strong style="color: #a94442;">Error!</strong><?php echo $_SESSION['error']; unset($_SESSION['error']) ?>
            </div>
        <?php endif ?>
        <form action="" method="POST" class="form-horizontal" role="form">
            <!-- email người dùng -->
            <div class="form-group formcustome">
                <div class="login-name ">
                    <label class="col-md-2 col-md-offset-1"> Email </label>
                    <div class="col-md-8">
                        <input type="text" name="email" placeholder=" notungtang.123@gmail.com" class="form-control">
                        <?php if(isset($error['email'])): ?>
                            <p class="text text-danger"><?php echo $error['email'] ?></p>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            <!-- mật khảu người dùng -->
            <div class="form-group formcustome">
                <label class="col-md-2 col-md-offset-1"> Mật khẩu </label>
                <div class="col-md-8">
                    <input type="password" name="password" placeholder=" *********" class="form-control">
                    <?php if(isset($error['password'])): ?>
                        <p class="text text-danger"><?php echo $error['password'] ?></p>
                    <?php endif; ?>
                </div>
            </div>
            <button type="submit" class="btn btn-success col-md-2 col-md-offset-5" style="margin-bottom: 15px;"> Đăng nhập </button>
        </form>
        <div class="form-group formcustome">
                <label class="col-md-12 col-md-offset-5" style="font-family: Arial"> Chưa là thành viên? </label>
                <a href="signup.php">
                    <button class="btn btn-success col-md-4 col-md-offset-4" style="margin-top: 15px;margin-bottom: 15px;"> 
                        Đăng ký thành viên
                    </button>
                </a>
            </div>
    </section>
    <div>

    </div>
</div>
<?php require_once __DIR__. "/layouts/footer.php" ?>