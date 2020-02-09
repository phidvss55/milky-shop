<?php
    define("Title", "Admin | Nhà cung cấp ");
    $open = 'providers';
    require_once __DIR__. "/../../autoload/autoload.php";

    //check co ton tai cai id k 
    $id = intval(getInput('id'));
    
    $EditProviders = $db->fetchID("providers", $id); //tìm id trong bảng providers mysql
    if(empty($EditProviders)) { //check if not exist this providers
        $_SESSION['error'] = "Dữ liệu không tồn tại";
        redirectAdmin("providers");
    }

    //kiểm tra xem danh mục đã có sản phẩm chưa, nếu chưa có thì không cho xoá

    $num = $db->delete("providers", $id);
    if($num > 0) {
        $_SESSION['success'] = "Xoá thành công";
        redirectAdmin("providers");
    } else {
        $_SESSION['error'] = "Xoá thất bại";
        redirectAdmin("providers");
    }
?>
