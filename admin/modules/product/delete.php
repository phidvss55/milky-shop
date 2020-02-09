<?php
    define("Title", "Admin | Sản phẩm ");
    $open = 'product';
    require_once __DIR__. "/../../autoload/autoload.php";

    //check co ton tai cai id k 
    $id = intval(getInput('id'));
    
    $EditProduct = $db->fetchID("product", $id);
    if(empty($EditProduct)) { //check if not exist this product
        $_SESSION['error'] = "Dữ liệu không tồn tại";
        redirectAdmin("product");
    }

    //kiểm tra xem danh mục đã có sản phẩm chưa, nếu chưa có thì không cho xoá

    $num = $db->delete("product", $id);
    if($num > 0) {
        $_SESSION['success'] = "Xoá thành công";
        redirectAdmin("product");
    } else {
        $_SESSION['error'] = "Xoá thất bại";
        redirectAdmin("product");
    }
?>
