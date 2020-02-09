<?php 

    require_once __DIR__. "/autoload/autoload.php";

    $key = intval(getInput("key")); //id của sản phẩm
    $qty = intval(getInput("qty")); 

    //kiểm tra số lượng số lượng người mua và số lượng trong kho có lớn hơn không
    //nếu lớn hơn thì không cho phép

    $_SESSION['cart'][$key]['qty'] = $qty;

    echo 1;  

?>