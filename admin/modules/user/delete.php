<?php
    define("Title", "Trang Admin");
    $open = 'product';
    require_once __DIR__. "/../../autoload/autoload.php";

    //check co ton tai cai id k 
    $id = intval(getInput('id'));
    
    $DeleteAdmin = $db->fetchID("users", $id);
    if(empty($DeleteAdmin)) { //check if not exist this product
        $_SESSION['error'] = "Dữ liệu không tồn tại";
        redirectAdmin("user");
    }

    //kiểm tra xem danh mục đã có sản phẩm chưa, nếu chưa có thì không cho xoá

    $num = $db->delete("users", $id);
    if($num > 0) {
        $_SESSION['success'] = "Xoá thành công";
        redirectAdmin("user");
    } else {
        $_SESSION['error'] = "Xoá thất bại";
        redirectAdmin("user");
    }
?>
