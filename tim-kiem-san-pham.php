<?php 
    require_once __DIR__. "/autoload/autoload.php";

    if(isset($_POST['keywork'])) {
        $keywork = $_POST['keywork'];
    }
    if(isset($_POST['category'])) {
        $cateid = $_POST['category'];
    }

    if($keywork == "" && $cateid== "") {
        $result = [];
        $_SESSION['empty'] = " Không tìm thấy keyword. ";
    } else {
        if($keywork == "") {
            $catesql = "SELECT id FROM category WHERE name='$cateid'";
            $categoryId = $db->fetchsql($catesql);
            foreach($categoryId as $item) {
                $id = $item['id'];
            }
            
            $sql = "SELECT * FROM product WHERE category_id='$id'";
            $result = $db->fetchsql($sql);
        } else {
            $sql = "SELECT * FROM product WHERE name LIKE '%" . $keywork . "%'";
            $result = $db->fetchsql($sql);
        }
    }

?>
<?php require_once __DIR__. "/layouts/header.php" ?>

<div class="col-md-9 bor">

    <section class="box-main1">
        <h3 class="title-main"><a href=""> Tìm kiếm: <?php echo $keywork ?> </a> </h3>
        <?php if(isset($_SESSION['empty'])): ?>
            <div class="alert alert-info">
                <strong style="color: #31708f;">Oops!</strong><?php echo $_SESSION['empty']; unset($_SESSION['empty']) ?>
            </div>
        <?php endif ?>
        <div class="showitem clearfix row">
            <?php foreach($result as $item): ?>
                <div class="col-md-3 item-product bor" style="text-align: center">
                    <a href="chi-tiet-san-pham.php?id=<?php echo $item['id'] ?>">
                        <img src="<?php echo uploads() ?>/product/<?php echo $item['thunbar'] ?>" width="80px" height="130px">
                    </a>
                    <div class="info-item">
                        <a href="chi-tiet-san-pham.php?id=<?php echo $item['id'] ?>"><?php echo $item['name'] ?></a>
                        <p><strike class="sale"><?php echo formatPrice($item['price']) ?></strike>
                            <b class="price"><?php echo formatPriceSale($item['price'], $item['sale']) ?></b></p>
                    </div>
                    <div class="hidenitem">
                        <p><a href="chi-tiet-san-pham.php?id=<?php echo $item['id'] ?>"><i class="fa fa-search"></i></a></p>
                        <p><a href=""><i class="fa fa-heart"></i></a></p>
                        <p><a href="add-cart.php"><i class="fa fa-shopping-basket"></i></a></p>
                    </div>  
                </div>
            <?php endforeach ?>
        </div>
    </section>
</div>

<?php require_once __DIR__. "/layouts/footer.php" ?>