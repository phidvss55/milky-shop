<?php 

    require_once __DIR__. "/autoload/autoload.php";

    if(!isset($_SESSION['name_id'])) {
        //nếu user click vô icon mua -> nghĩa là người dùng muốn mua
        //nếu user chưa login -> sẽ không cho chọn tính năng này
        echo "<script>alert('Bạn phải đăng nhập mới chọn được tính năng này'); location.href='index.php'</script>";
    }
    //lay id cua san pham minh vua click
    $id = intval(getInput('id'));

    //chi tiet san pham
    $product = $db->fetchID("product", $id);
    
    //neu  ton tai gio hang -> update gio hang else create cart
    if( ! isset($_SESSION['cart'][$id])) {
        $_SESSION['cart'][$id]['name'] = $product['name'];
        $_SESSION['cart'][$id]['thunbar'] = $product['thunbar'];
        $_SESSION['cart'][$id]['price'] = ((100 - $product['sale']) * $product['price']) / 100;
        $_SESSION['cart'][$id]['qty'] = 1;
        echo "<script>alert(' Thêm sản phẩm vào giỏ hàng thành công. '); location.href='gio-hang.php'</script>";
    } else {
        $_SESSION['cart'][$id]['qty'] += 1;
        echo "<script>alert(' Thêm sản phẩm vào giỏ hàng thành công. '); location.href='gio-hang.php'</script>";
    }
