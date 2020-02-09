<?php
    define("Title", "Admin | Quản lý giao dịch ");
    $open = 'transaction';
    require_once __DIR__. "/../../autoload/autoload.php";

    //check co ton tai cai id k 
    $id = intval(getInput('id'));
    
    $EditCategory = $db->fetchID("category", $id);
    if(empty($EditCategory)) { //check if not exist this product
        $_SESSION['error'] = "Dữ liệu không tồn tại";
        redirectAdmin("category");
    }

    //kiểm tra xem danh mục đã có sản phẩm chưa, nếu chưa có thì không cho xoá

    $is_Product = $db->fetchOne("product", " category_id = $id ");
    //if product not have products -> agree to delete
    if($is_Product == NULL) {
        $num = $db->delete("category", $id);

        if($num > 0) {
            $_SESSION['success'] = "Xoá thành công";
            redirectAdmin("category");
        } else {
            $_SESSION['error'] = "Xoá thất bại";
            redirectAdmin("category");
        }
    } else {
        $_SESSION['error']="Danh mục có sản phẩm, bạn không thể xoá!";
        redirectAdmin("category");
    }
?>
