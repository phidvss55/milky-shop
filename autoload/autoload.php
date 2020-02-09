<?php
    session_start();
    require_once __DIR__. "/../libraries/database.php";
    require_once __DIR__. "/../libraries/function.php";

    $db = new Database;

    define("ROOT", $_SERVER['DOCUMENT_ROOT']."/milkyshop/public/uploads/");    


    $category = $db->fetchAll("category");

    // lấy danh sách ssanr phẩm mới
    $sqlNew = "SELECT * FROM product WHERE 1 ORDER BY ID DESC LIMIT 3";
    $productNew = $db->fetchsql($sqlNew);

    $sqlpay = "SELECT * FROM product WHERE 1 ORDER BY pay DESC LIMIT 3";     //lay thoe  san pham theo pay value > dan
    $productPay = $db->fetchsql($sqlpay);
?>