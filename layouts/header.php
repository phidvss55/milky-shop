<?php
    define("Title", "Milky Shop");
?>
<!DOCTYPE html>
<html>
    <head>  
        <title><?php echo Title; ?></title>
        <meta charset="utf-8">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>public/frontend/css/font-awesome.min.css">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>public/frontend/css/bootstrap.min.css">
        
        <script  src="<?php echo base_url() ?>public/frontend/js/jquery-3.2.1.min.js"></script>
        <script  src="<?php echo base_url() ?>public/frontend/js/bootstrap.min.js"></script>
        <!---->
        <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>public/frontend/css/slick.css"/>
        <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>public/frontend/css/slick-theme.css"/>
        <!--slide-->
        <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>public/frontend/css/style.css">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>public/frontend/css/font-awesome.css">
        <!-- owl carousel -->
        <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>public/frontend/css/owl.carousel.min.css">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>public/frontend/css/owl.theme.default.min.css">

        <link rel="stylesheet" href="<?php echo base_url() ?>public/frontend/css/responsive.css">
        
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
                                        <?php if(isset($_SESSION['name_user'])): ?> 
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
                                        <?php else: ?>
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
            <!--ENDMENUNAV-->
            
            <div id="maincontent">
                <div class="container">
                    <div class="col-md-3 fixside" >
                        <div class="box-left box-menu" >
                            <h3 class="box-title"><i class="fa fa-list"></i>  Danh mục</h3>
                            <ul>
                                <?php foreach($category as $item): ?>
                                    <li><a href="danh-muc-san-pham.php?id=<?php echo $item['id'] ?>"><?php echo $item['name'] ?></a></li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                        
                        <div class="box-left box-menu">
                            <h3 class="box-title"><i class="fa fa-bars"></i>  Sản phẩm mới </h3>
                            <ul>
                                <?php foreach($productNew as $item): ?>
                                    <li class="clearfix">
                                        <a href="chi-tiet-san-pham.php?id=<?php echo $item['id'] ?>">
                                            <img src="<?php echo uploads() ?>/product/<?php echo $item['thunbar'] ?>" class="img-responsive pull-left" width="80" height="80">
                                            <div class="info pull-right">
                                                <p class="name"><?php echo $item['name'] ?></p >
                                                <b class="price"><?php echo formatPriceSale($item['price'], $item['sale']) ?></b><br>
                                                <b class="sale">Giá gốc: <?php echo formatPrice($item['price']) ?></b><br>
                                                <span class="view"><i class="fa fa-eye"></i> <?php echo formatPrice($item['view']) ?> : <i class="fa fa-heart-o"></i> <?php echo $item['love']; ?></span>
                                            </div>
                                        </a>
                                    </li>
                                <?php endforeach ?>
                              </ul>
                            <!-- </marquee> -->
                        </div>

                        <div class="box-left box-menu">
                            <h3 class="box-title"><i class="fa fa-warning"></i>  Sản phẩm bán chạy </h3>
                           <!--  <marquee direction="down" onmouseover="this.stop()" onmouseout="this.start()"  > -->
                            <ul>
                                <?php foreach($productPay as $item): ?>
                                    <li class="clearfix">
                                        <a href="chi-tiet-san-pham.php?id=<?php echo $item['id'] ?>">
                                            <img src="<?php echo uploads() ?>/product/<?php echo $item['thunbar'] ?>" class="img-responsive pull-left" width="80" height="80">
                                            <div class="info pull-right">
                                                <p class="name"><?php echo $item['name'] ?></p >
                                                <b class="price"><?php echo formatPriceSale($item['price'], $item['sale']) ?></b><br>
                                                <b class="sale">Giá gốc: <?php echo formatPrice($item['price']) ?></b><br>
                                                <span class="view"><i class="fa fa-eye"></i> <?php echo formatPrice($item['view']) ?> : <i class="fa fa-heart-o"></i> <?php echo $item['love']; ?></span>
                                            </div>
                                        </a>
                                    </li>
                                <?php endforeach ?>
                            </ul>
                            <!-- </marquee> -->
                        </div>
                    </div>