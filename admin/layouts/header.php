<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">
        <title><?php echo Title ?></title>
        <!-- Bootstrap Core CSS -->
        <link href="<?php echo base_url(); ?>/public/admin/css/bootstrap.min.css" rel="stylesheet">
        <!-- Custom CSS -->
        <link href="<?php echo base_url(); ?>/public/admin/css/sb-admin.css" rel="stylesheet">
        <!-- Custom Fonts -->
        <link href="<?php echo base_url(); ?>/public/admin/css/font-awesome.min.css" rel="stylesheet" type="text/css">
        
       
    </head>
    <body>
        <div id="wrapper">
            <!-- Navigation -->
            <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="index.php"> <i class="fa fa-home"></i> Xin chào <?php echo $_SESSION['admin_name'] ?></a>
                </div>
                <div class="time-display">
                    <h3 id="time"></h3>
                </div>
                <!-- Top Menu Items -->
                <ul class="nav navbar-right top-nav">
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-envelope"></i> <b class="caret"></b></a>
                        <ul class="dropdown-menu message-dropdown">
                            <li class="message-preview">
                                <a href="#">
                                    <div class="media">
                                        <span class="pull-left">
                                        <img class="media-object" src="http://placehold.it/50x50" alt="">
                                        </span>
                                        <div class="media-body">
                                            <h5 class="media-heading">
                                                <strong><?php echo $_SESSION['admin_name'] ?></strong>
                                            </h5>
                                            <p class="small text-muted"><i class="fa fa-clock-o"></i> Yesterday at 4:32 PM</p>
                                            <p>Lorem ipsum dolor sit amet, consectetur...</p>
                                        </div>
                                    </div>
                                </a>
                            </li>
                            <li class="message-footer">
                                <a href="#">Read All New Messages</a>
                            </li>
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-bell"></i> <b class="caret"></b></a>
                        <ul class="dropdown-menu alert-dropdown">
                            <li class="divider"></li>
                            <li>
                                <a href="#">View All</a>
                            </li>
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> <?php echo $_SESSION['admin_name'] ?> <b class="caret"></b></a>
                        <ul class="dropdown-menu">
                            <li>
                                <a href="#"><i class="fa fa-fw fa-user"></i> Profile</a>
                            </li>
                            <li>
                                <a href="#"><i class="fa fa-fw fa-envelope"></i> Inbox</a>
                            </li>
                            <li>
                                <a href="#"><i class="fa fa-fw fa-gear"></i> Settings</a>
                            </li>
                            <li class="divider"></li>
                            <li>
                                <a href="/milkyshop/dang-xuat.php"><i class="fa fa-fw fa-power-off"></i> Log Out</a>
                            </li>
                        </ul>
                    </li>
                </ul>
                <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
                <div class="collapse navbar-collapse nav-default navbar-ex1-collapse" style="background-color: RGB(43, 54, 68)">
                    <ul class="nav navbar-nav side-nav" style="background-color: RGB(53, 64, 81);">
                        <li class="<?php echo isset($open) && $open == 'dashboard' ? 'active' : '' ?>">
                            <a href="<?php echo base_url() ?>/admin"><i class="fa fa-fw fa-dashboard"></i> Bảng điều khiển</a>
                        </li>
                        <!-- neu isset open dung thi class bang active -->
                        <li class="<?php echo isset($open) && $open == 'category' ? 'active' : '' ?>">
                            <a href="<?php echo modules('category') ?>"><i class="fa fa-fw fa-edit"></i> Danh mục sản phẩm</a>
                        </li>
                        <li class="<?php echo isset($open) && $open == 'providers' ? 'active' : '' ?>">
                            <a href="<?php echo modules('providers') ?>"><i class="fa fa-fw fa-truck"></i> Nhà cung cấp</a>
                        </li>
                        <li class="<?php echo isset($open) && $open == 'product' ? 'active' : '' ?>">
                            <a href="<?php echo modules('product') ?>"><i class="glyphicon glyphicon-book" style="padding: 0 3px;"></i> Sản phẩm  </a>
                        </li>
                        <li class="<?php echo isset($open) && $open == 'transaction' ? 'active' : '' ?>">
                            <a href="<?php echo modules('transaction') ?>"><i class="glyphicon glyphicon-list-alt" style="padding: 0 3px;"></i> Quản lý đơn hàng  </a>
                        </li>
                        <li class="<?php echo isset($open) && $open == 'admin' ? 'active' : '' ?>">
                            <a href="<?php echo modules('admin') ?>"><i class="fa fa-user" style="padding: 0 3px;"></i> Quản trị Admin  </a>
                        </li>
                        <li class="<?php echo isset($open) && $open == 'user' ? 'active' : '' ?>">
                            <a href="<?php echo modules('user') ?>"><i class="fa fa-male" style="padding: 0 3px;"></i> Thành viên  </a>
                        </li>
                        <li class="<?php echo isset($open) && $open == '' ? 'active' : '' ?>">
                            <a href="<?php echo base_url() ?>"><i class="glyphicon glyphicon-backward" style="padding: 0 3px;"></i> Quay lại trang chủ  </a>
                        </li>
                    </ul>
                </div>
                
                <!-- /.navbar-collapse -->
            </nav>
            <div id="page-wrapper">
                <div class="container-fluid">