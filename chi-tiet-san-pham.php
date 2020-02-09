<?php

require_once __DIR__ . "/autoload/autoload.php";

$id = intval(getInput('id'));

$sqlProduct = "SELECT view FROM product WHERE id = '$id'";
$result = $db->fetchsql($sqlProduct);
$view = 0;
    foreach($result as $item) {
        $view = $item['view'];
}
    
$view += 1;
// echo $view;
$sqlUpdate = "view='$view' WHERE id='$id'";
$resultUpdate = $db->updatesql("product", $sqlUpdate);

//chi tiet san pham
$product = $db->fetchID("product", $id);

//lay danh sach san pham
$cateid  = intval($product['category_id']);

$sql = "SELECT * FROM product WHERE category_id = $cateid ORDER BY ID DESC LIMIT 4";

$sanphamkemtheo = $db->fetchsql($sql);

?>
<?php require_once __DIR__ . "/layouts/header.php" ?>

<div class="col-md-9 bor">
    <section class="box-main1">
        <div class="col-md-6 text-center">
            <img style="border: none; " src="<?php echo uploads() ?>product/<?php echo $product['thunbar'] ?>" class="img-responsive bor" id="imgmain" width="150px" height="270px" data-zoom-image="images/16-270x270.png">
        </div>
        <div class="col-md-6 bor" style="margin-top: 20px;padding: 30px;">
            <ul id="right">
                <li>
                    <h3> <?php echo $product['name'] ?> </h3>
                </li>
                <li>
                    <h5>Thông tin về sản phẩm</h5>
                </li>
                <?php if ($product['sale'] > 0) : ?>
                    <li>
                    <p>Sản phẩm đang khuyến mãi 10%</p>
                        <p><strike class="sale"> <?php echo formatPrice($product['price']) ?> </strike>
                            <b class="price"><?php echo formatPriceSale($product['price'], $product['sale']) ?></b>
                        </p>
                    </li>
                <?php else : ?>
                    <li>
                        <p><b class=""><?php echo formatPriceSale($product['price'], $product['sale']) ?></b></p>
                    </li>
                <?php endif; ?>
                <li>
                    <a href="add-cart.php?id=<?php echo $product['id'] ?>" class="btn btn-default">
                        <i class="fa fa-shopping-basket"></i> Add To Cart
                    </a>
                </li>
            </ul>
        </div>
    </section>

    <div class="col-md-12" id="tabdetail">
        <div class="row">
            <ul class="nav nav-tabs">
                <li class="active"><a data-toggle="tab" href="#home">Mô tả sản phẩm </a></li>
                <li><a data-toggle="tab" href="#menu1">Thông tin khác </a></li>
                <li><a data-toggle="tab" href="#menu2"> Đánh Giá </a></li>
                <li><a data-toggle="tab" href="#menu3"> Bình Luận </a></li>  
            </ul>
            <div class="tab-content">
                <div id="home" class="tab-pane fade in active">
                    <h3>Nội dung</h3>
                    <p class="format-spacing"><?php echo $product['content'] ?></p>
                </div>
                <div id="menu1" class="tab-pane fade">
                    <h3> Thông tin khác </h3>
                    <p class="format-spacing">Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
                </div>
                <div id="menu2" class="tab-pane fade">
                    <h3> Đánh Giá </h3>
                    <p class="format-spacing"> - Chưa có đánh giá nào </p>
                </div>
                <div id="menu3" class="tab-pane fade">
                    <h3> Bình Luận </h3>
                    <p class="format-spacing"> - Chưa có bình luận nào </p>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-12">
        
        <div class="showitem">
            <?php foreach ($sanphamkemtheo as $item) : ?>
                <div class="col-md-3 item-product bor" style="text-align: center">
                    <a href="chi-tiet-san-pham.php?id=<?php echo $item['id'] ?>" >
                        <img style="margin-top:10px" src="<?php echo uploads() ?>/product/<?php echo $item['thunbar'] ?>" width="120px">
                    </a>
                    <div class="info-item">
                        <a href="chi-tiet-san-pham.php?id=<?php echo $item['id'] ?>"><?php echo $item['name'] ?></a>
                        <p><strike class="sale"><?php echo formatPrice($item['price']) ?></strike><b class="price">
                                <?php echo formatPriceSale($item['price'], $item['sale']); ?></b></p>
                    </div>
                    <div class="hidenitem">
                        <p><a href="chi-tiet-san-pham.php?id=<?php echo $item['id'] ?>"><i class="fa fa-search"></i></a></p>
                        <p><a href="love-product.php?id=<?php echo $item['id'] ?>"><i class="fa fa-heart"></i></a></p>
                        <p><a href="add-cart.php?id=<?php echo $item['id'] ?>"><i class="fa fa-shopping-basket"></i></a></p>
                    </div>
                </div>
            <?php endforeach ?>
        </div>
    </div>
</div>


<?php require_once __DIR__ . "/layouts/footer.php" ?>