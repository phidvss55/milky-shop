<?php
    require_once __DIR__ . "/autoload/autoload.php";
    define("Title", "Milky Shop");

    $toEmail = 'phuonglam686@gmail.com';
    $subject = 'Need a help.';
    $data = [
        'name' => postInput('name'),
        'fromMail' => postInput('email'),
        'message' => postInput('message')
    ];  

    $errors = [];

    if($_SERVER["REQUEST_METHOD"] == 'POST') {
        if($data['name'] == '') {
            $errors['name'] = "Tên không được để trống.";
        }
        if($data['fromMail'] == '') {
            $errors['fromMail'] = "Email không được để trống.";
        }
        if($data['message'] == '') {
            $errors['message'] = "Nội dung không được để trống.";
        }

        if(empty($errors)) {
            $content = '
                        <html>
                            <h3>Hi, My name is '. $data['name'] .'</h3>
                            <p>I contact you from www.milkyshop.vn</p>
                            <b>My message is: ' . $data['message'] . '</b>
                            <br>
                            <h3>Thank you for using website</h3>
                        </html>
            ';
    
            // $result = mail($toEmail, $subject, $content, $data['fromMail']);
            $result = "";
    
            if($result)  {
                $_SESSION['success'] = " Gửi mail thành công. Chúng tôi sẽ liên lạc bạn sớm nhất. ";
            } else {
                $_SESSION['error'] = " Gửi mail thất bại. Vui lòng thử lại. ";
            }
        } 
    }
?>
<!DOCTYPE html>
<html>

<head>
    <title><?php echo Title; ?></title>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>public/frontend/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>public/frontend/css/bootstrap.min.css">

    <script src="<?php echo base_url() ?>public/frontend/js/jquery-3.2.1.min.js"></script>
    <script src="<?php echo base_url() ?>public/frontend/js/bootstrap.min.js"></script>
    <!---->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>public/frontend/css/slick.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>public/frontend/css/slick-theme.css" />
    <!--slide-->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>public/frontend/css/style.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>public/frontend/css/font-awesome.css">
    <!-- owl carousel -->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>public/frontend/css/owl.carousel.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>public/frontend/css/owl.theme.default.min.css">

    <link rel="shortcut icon" href="<?php echo base_url() ?>public/frontend/images/icon.png">
</head>

<body>
    <div id="wrapper">
        <!---->
        <!--HEADER-->
        <div id="header">
            <div id="header-top">
                <div class="container">
                    <div class="row clearfix">
                        <div class="col-md-6" id="header-text">
                                <a href="" class="team-name"> Xin chào </a><b> Đề tài website bán sữa - Thực tập chuyên môn </b>
                            </div>
                        <div class="col-md-6">
                            <nav id="header-nav-top">
                                <ul class="list-inline pull-right" id="headermenu">
                                    <!-- nếu tồn tại name_user -> user đã đăng nhập thì không hiện thị tên đăng nhập nữa -->
                                    <?php if (isset($_SESSION['name_user'])) : ?>
                                        <li>Xin chào: <strong><?php echo $_SESSION['name_user'] ?></strong></li>
                                        <li>
                                            <a href=""><i class="fa fa-user"></i> My Account <i class="fa fa-caret-down"></i></a>
                                            <ul id="header-submenu">
                                                <li><a href="thong-tin-tai-khoan.php"> Thông tin </a></li>
                                                <li><a href="gio-hang.php"> Giỏ hàng</a></li>
                                                <li><a href="lich-su-don-hang.php"> Đơn hàng</a></li>
                                                <li><a href="thoat.php"><i class="fa fa-share-square-o"></i> Thoát </a></li>
                                            </ul>
                                        </li>
                                    <?php else : ?>
                                        <!-- còn không thì hiện thị đăng nhập  -->
                                        <li>
                                            <a href="thong-bao.php"><i class="fa fa-bell"></i> Thông Báo </a>
                                        </li>
                                        <li>
                                            <a href="<?php echo base_url() ?>admin"><i class="fa fa-user"></i> Admin </a>
                                        </li>
                                        <li>
                                            <a href="signin.php"><i class="fa fa-unlock"></i> Sign In </a>
                                        </li>
                                        <li>
                                            <a href="signup.php"><i class="fa fa-lock"></i> Sign Up </a>
                                        </li>
                                    <?php endif; ?>
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="row" id="header-main">
                    <div class="col-md-5">
                        <form action="tim-kiem-san-pham.php" method="POST" class="form-inline" role="form">
                            <div class="form-group">
                                <label>
                                    <select name="category" id="category" class="form-control" onchange="this.form.submit()">
                                        <option selected="selected"> All Category </option>
                                        <option value="Sữa Bột"> Sữa Bột </option>
                                        <option value="Sữa Nước"> Sữa Nước </option>
                                        <option value="Sữa Chua"> Sữa Chua </option>
                                        <option value="Sữa Đặc"> Sữa Đặc </option>
                                    </select>
                                </label>
                                <input type="text" name="keywork" placeholder=" Nhập tên sản phẩm cần tìm " class="form-control">
                                <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                            </div>
                        </form>
                    </div>
                    <div class="col-md-4">
                        <a href="index.php">
                            <img src="<?php echo base_url() ?>public/frontend/images/logo-default0.png" width="300px">
                        </a>
                    </div>
                    <div class="col-md-3" id="header-right">
                        <div class="pull-right">
                            <div class="pull-left">
                                <i class="glyphicon glyphicon-phone-alt"></i>
                            </div>
                            <div class="pull-right">
                                <p id="hotline">HOTLINE</p>
                                <p>0333816363</p>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--END HEADER-->

        <!--MENUNAV-->
        <div id="menunav">
            <div class="container" style="margin-top: -14px;">
                <nav>
                    <div class="home pull-left">
                        <a href="index.php">Trang chủ</a>
                    </div>
                    <!--menu main-->
                    <ul id="menu-main">
                        <li>
                            <a href="toan-bo-san-pham.php">Toàn bộ sản phẩm</a>
                        </li>
                        <li>
                            <a href="huong-dan-mua-hang.php">Hướng dẫn mua hàng</a>
                        </li>
                        <li>
                            <a href="thuong-hieu.php">Thương hiệu liên kết</a>
                        </li>
                        <li>
                            <a href="lien-he.php">Liện hệ</a>
                        </li>
                    </ul>
                    <!-- end menu main-->

                    <!--Shopping-->
                    <ul class="pull-right" id="main-shopping">
                        <li>
                            <a href="gio-hang.php"><i class="fa fa-shopping-basket"></i> My Cart </a>
                        </li>
                    </ul>
                    <!--end Shopping-->
                </nav>
            </div>
        </div>
    </div>
    <div class="wrapper">
        <div class="container">
            <section class="box-main1 cont-contactBtn">
                <!-- Nội dung -->
                <div class="col-md-12 box-contact cont-flip">
                    <div class="noti-contact front">
                        <div class="text-center">
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
                        </div>
                        <div class="contain text-center">
                            <h1 class="title-contact">Liên hệ với chúng tôi</h1>
                        </div>
                        <div class="content contain text-center">
                            <p>
                                Bạn có câu hỏi hoặc có thắc măc? bạn cần lời giải đáp? Hãy liên lạc với chúng tôi qua số điện thoại phía dưới,
                                Hoặc bạn cũng có thể tới chi nhánh cửa hàng để giải đáp, Hay gửi mail cho chúng tôi phía dưới.
                            </p>
                        </div>
                        <div class="contain text-center">
                            <a href="#" class="flip">Send Email</a>
                        </div>
                    </div>
                    <div class="back">
                        <!-- <a href="#" class="flip close">X</a> -->
                        <a href="#" class="flip close"><span class="glyphicon glyphicon-remove"></span></a>
                        <form class="contact-form" method="POST" action="lien-he.php">
                            <input class="gutter" type="text" name="name" placeholder="Name">
                            <?php if(isset($errors['name'])): ?>
                                <p class="text text-danger"  style="height: 45px;"><?php echo $errors['name'] ?></p>
                            <?php endif; ?> 
                            <input class="gutter" type="text" name="email" placeholder="Email">
                            <?php if(isset($errors['fromMail'])): ?>
                                <p class="text text-danger"  style="height: 45px;"><?php echo $errors['fromMail'] ?></p>
                            <?php endif; ?> 
                            <textarea name="message" id="" placeholder="Leave a message"></textarea>
                            <?php if(isset($errors['message'])): ?>
                                <p class="text text-danger"  style="height: 45px;"><?php echo $errors['message'] ?></p>
                            <?php endif; ?> 
                            <input type="submit" class="btn btn-primary center-block" value="Send">
                        </form>
                    </div>
                </div>
            </section>
        </div>
    </div>

    <div class="container">
        <div class="col-md-6 bottom-content contact-infor details-infor">
            <div class="follow">
                <i class="fa fa-map-marker"></i> 56/3A phường Thắng Lợi, thị xã Mai Châu, tỉnh Lạng Sơn.
            </div>
            <div class="follow">
                <i class="fa fa-map-marker"></i> 56/3A phường Châu Linh, thị xã Sơn Tây, tỉnh Cao Bằng.
            </div>
            <div class="follow">
                <i class="fa fa-phone"></i> 0123 456 789
            </div>
            <div class="follow">
                <i class="fa fa-envelope-o"></i> Support.milkyshop@gmail.com
            </div>
        </div>
        <div class="col-md-6 bottom-content contact-infor">
            <div class="col-md-4 bank text-center">
                <a href="#"><img src="./public/frontend/images/bank/vcb.png" alt="Vietcombank"></a>
            </div>
            <div class="col-md-4 bank text-center">
                <a href="#"><img src="./public/frontend/images/bank/argi.png" alt=""></a>
            </div>
            <div class="col-md-4 bank text-center timo">
                <a href="#"><img src="./public/frontend/images/bank/timo.png" alt=""></a>
            </div>
        </div>
    </div>

<?php require_once __DIR__ . "/layouts/footer.php" ?>