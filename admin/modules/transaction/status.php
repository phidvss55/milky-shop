<?php

    //NẾU ĐƠN HÀNG XỬ LÝ XONG THÌ PHẢI TRỪ ĐI SỐ LƯỢNG
    require_once __DIR__. "/../../autoload/autoload.php";

    $id  = intval(getInput('id'));

    //lấy cái id của sản phẩm sửa
    $EditTransaction = $db->fetchID("transaction", $id);

    if( empty($EditTransaction) ) {
        $_SESSION['error']  = 'Dữ liệu không tồn tại. ';
        redirectAdmin("transaction");
    }

    //lấy trạng thái status của thằng cần sữa -> kiểm tra if 0 -> 1 else
    if($EditTransaction['status'] == 1) {
        $_SESSION['error']  = ' Đơn hàng đã được xử lý rồi.  ';
        redirectAdmin("transaction");
    }

    $status = 1; //khi đơn hàng đã xử lý -> gán tình trạng là 1

    //update lại
    $update = $db->update("transaction", array("status" => $status), array("id" => $id));

    if($update > 0) {
        $_SESSION['success'] = " Cập nhật thành công.";

        //PHẢI update lại bảng product (trừ số sản phẩm đã mua)
        $sql = "SELECT * FROM orders WHERE transaction_id = $id"; //lấy đơn hàng để xem sản phẩm trong đó
        $order = $db->fetchsql($sql);
        foreach ($order as $item) {
            $idProduct = intval($item['product_id']); //lay id san pham trong don hang
            $product = $db->fetchID("product", $idProduct); //lay san pham do trong bang product tu idProdcut tren

            $number = $product['number'] - $item['qty'];
            //cong sluong sp len 1
            $up_pro = $db->update("product", array("number" => $number, "pay" => $product['pay']+1), array("id" => $idProduct)); //update lai so luong

        }

        redirectAdmin("transaction");
    } else {
        $_SESSION['error'] = " Dữ liệu không thành công ";
        redirectAdmin("transaction");
    }



?>