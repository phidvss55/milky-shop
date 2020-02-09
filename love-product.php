<?php 

    require_once __DIR__. "/autoload/autoload.php";

    $id = intval(getInput('id'));

    $sqlProduct = "SELECT love FROM product WHERE id = '$id'";
    $result = $db->fetchsql($sqlProduct);
    $love = 0;
    foreach($result as $item) {
        $love = $item['love'];
    }
    
    $love += 1;
    $sqlUpdate = "love='$love' WHERE id='$id'";
    $resultUpdate = $db->updatesql("product", $sqlUpdate);
    //chi tiet san pham

    if($resultUpdate) {
        header('location:javascript://history.go(-1)');
        echo "<script>alert(' Cảm ơn bạn đã đánh giá sản phẩm thành công. ');</script>";
    }
    
    //neu  ton tai gio hang -> update gio hang else create cart
    // if( ! isset($_SESSION['cart'][$id])) {
    //     $_SESSION['cart'][$id]['name'] = $product['name'];
    //     $_SESSION['cart'][$id]['thunbar'] = $product['thunbar'];
    //     $_SESSION['cart'][$id]['price'] = ((100 - $product['sale']) * $product['price']) / 100;
    //     $_SESSION['cart'][$id]['qty'] = 1;
    //     echo "<script>alert(' Thêm sản phẩm vào giỏ hàng thành công. '); location.href='gio-hang.php'</script>";
    // } else {
    //     $_SESSION['cart'][$id]['qty'] += 1;
    //     echo "<script>alert(' Thêm sản phẩm vào giỏ hàng thành công. '); location.href='gio-hang.php'</script>";
    // }


?>