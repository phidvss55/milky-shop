<?php
require_once __DIR__ . "/autoload/autoload.php";

$sqlHomeCate = "SELECT name, id FROM category WHERE home = 1 ORDER BY updated_at";
$categoryHome = $db->fetchsql($sqlHomeCate);

$saleProducts = [];
$hotProducts = [];

//lap mang category 
foreach ($categoryHome as $item) {
    $cateId = intval($item['id']); //lay id cua san pham len trang chu

    $sql = "SELECT * FROM product WHERE category_id = $cateId AND sale > 0";
    $productHome = $db->fetchsql($sql); //loc lay thong tin tu id do

    $saleProducts[$item['name']] = $productHome; //tao mang 2 chieu lay thong tin san pham
}

foreach($categoryHome as $item) {
    $cateId = intval($item['id']);
    $sql = "SELECT * FROM product WHERE category_id = $cateId AND pay > 0";
    $productHome = $db->fetchsql($sql);
    $hotProducts[$item['name']] = $productHome;
}

// echo _debug($hotProducts);


?>

<?php require_once __DIR__ . "/layouts/header.php" ?>

<div class="col-md-9 bor">
    <section id="slide">
        <div id="carousel-simple" class="carousel slide" data-ride="carousel">
            <!-- Indicators -->
            <ol class="carousel-indicators">
                <li data-target="#carousel-simple" data-slide-to="0" class="active"></li>
                <li data-target="#carousel-simple" data-slide-to="1"></li>
                <li data-target="#carousel-simple" data-slide-to="2"></li>
                <li data-target="#carousel-simple" data-slide-to="3"></li>
                <li data-target="#carousel-simple" data-slide-to="4"></li>
            </ol>

            <!-- Wrapper for slides -->
            <div class="carousel-inner" role="listbox">
                <div class="item active">
                    <img src="<?php echo base_url() ?>public/frontend/images/banner/banner-0.jpg" alt="">
                </div>
                <div class="item">
                    <img src="<?php echo base_url() ?>public/frontend/images/banner/banner-1.jpg" alt="">
                </div>
                <div class="item">
                    <img src="<?php echo base_url() ?>public/frontend/images/banner/banner-2.jpg" alt="">
                </div>
                <div class="item">
                    <img src="<?php echo base_url() ?>public/frontend/images/banner/banner-3.jpg" alt="">
                </div>
                <div class="item">
                    <img src="<?php echo base_url() ?>public/frontend/images/banner/banner-4.jpg" alt="">
                </div>
            </div>

            <a class="left carousel-control" href="#carousel-simple" role="button" data-slide="prev">
                <i class="fa fa-chevron-left btn-center" aria-hidden="true"></i>
            </a>
            <a class="right carousel-control" href="#carousel-simple" role="button" data-slide="next">
                <i class="fa fa-chevron-right btn-center" aria-hidden="true"></i>
            </a>
        </div>
    </section>
    <section class="box-main1">
        <div class="box-contain fcontain">
            <h3> SẢN PHẨM ĐANG KHUYẾN MÃI </h3>
        </div>
        <div class="box-contain">
            <div class="text-center">
                <div class="owl-carousel owl-theme">
                    <!-- <div class="row"> -->
                    <?php foreach ($saleProducts as $key => $value) : ?>
                        <?php foreach ($value as $item) : ?>
                            <div class="item" style="text-align: center">
                                <!-- mo toi id cua san pham -->
                                <a href="chi-tiet-san-pham.php?id=<?php echo $item['id'] ?>">
                                    <img style="margin-top:10px" src="<?php echo uploads() ?>/product/<?php echo $item['thunbar'] ?>">
                                </a>
                                <div class="giam-percent">
                                    <span class="text-giam-percent">Giảm <?php echo $item['sale'] ?>%</span>
                                </div>
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
                    <?php endforeach ?>
                    <!-- </div> -->
                </div>
            </div>
        </div>
    </section>
    <!-- San pham noi bat -->
    <section class="box-main1">
        <?php foreach ($hotProducts as $key => $value) : ?>
            <div class="border">
                <h3 class="title-main"><a href=""><?php echo $key . " nổi bật " ?></a></h3>
                <div class="showitem row">
                    <?php foreach ($value as $item) : ?>
                        <div class="col-md-3 item-product bor" style="text-align: center">
                            <!-- mo toi id cua san pham -->
                            <a href="chi-tiet-san-pham.php?id=<?php echo $item['id'] ?>">
                                <img style="margin-top:10px" src="<?php echo uploads() ?>/product/<?php echo $item['thunbar'] ?>" height="120px">
                            </a>
                            <?php if($item['sale'] > 0) : ?>
                                <div class="giam-percent">
                                    <span class="text-giam-percent">Giảm <?php echo $item['sale'] ?>%</span>
                                </div>
                            <?php endif ?>
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
        <?php endforeach ?>
    </section>

</div>

<?php require_once __DIR__ . "/layouts/footer.php" ?>