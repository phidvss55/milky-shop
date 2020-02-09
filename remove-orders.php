<?php 

    require_once __DIR__. "/autoload/autoload.php";
    $key = intval(getInput('id')); //lay cai id tu remove button

    $sql = "id='$key'";

    $result = $db->deletequery("transaction", $sql);
    if($result) {
        $sqlOrder = "transaction_id='$key'";
        $resultOrder = $db->deletequery("orders", $sqlOrder);

        $sqlBank = "transaction_id='$key'";
        $resultBank = $db->deletequery("bank", $sqlBank);
        if($resultOrder && $resultBank) {
            $_SESSION['success'] = " Xoá đơn hàng thành công ";
        } else {
            $_SESSION['error'] = "Xoá đơn hàng không thành công ";
        }
    }

    header("location: lich-su-don-hang.php");

?>