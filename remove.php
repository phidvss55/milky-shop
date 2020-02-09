<?php 

    require_once __DIR__. "/autoload/autoload.php";

    $key = intval(getInput('id')); //lay cai id tu remove button

    unset($_SESSION['cart'][$key]);

    $_SESSION['success'] = " Xoá sản phẩm trong giỏ hàng thành công. ";

    header("location: gio-hang.php");

?>