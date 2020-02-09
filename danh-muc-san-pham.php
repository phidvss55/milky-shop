<?php

    require_once __DIR__ . "/autoload/autoload.php";
    //first get id of that's category
    $id = intval(getInput('id'));

    // lay ten cai danh muc de lam cai title
    $EditCategory = $db->fetchID("category", $id);

    isset($_GET['p']) ? $p = $_GET['p'] : $p = 1;

    $sql = "SELECT * FROM product WHERE category_id = $id";

    $total = count($db->fetchsql($sql));

    // $product = $db->fetchsql($sql);
    //bang, chuoi sql, tong so ban ghi, page, hien thi bao nhieu ban ghi 1 trang, muon phan trang hay k 
    // $product = $db->fetchJones($table, $sql, $total = 1, $page, $row, $pagi = true)
    $product = $db->fetchJones("product", $sql, $total, $p, 5, true); //display 4 product

    $sotrang = $product['page'];

    unset($product['page']);

    //lay ra duong link cua server name
    $path = $_SERVER['SCRIPT_NAME'];

?>

<?php require_once __DIR__ . "/layouts/header.php" ?>

<div class="col-md-9 bor">
    <section class="box-main1">
        <h3 class="title-main"><a href=""> <?php echo $EditCategory['name'] ?> </a> </h3>
        <div class="showitem clearfix">
            <!-- hien thi tung san pham theo id cua danh muc -->
            <?php foreach ($product as $item) : ?>
                <div class="col-md-3 item-product bor" style="text-align: center">
                    <a href="chi-tiet-san-pham.php?id=<?php echo $item['id'] ?>">
                        <img src="<?php echo uploads() ?>/product/<?php echo $item['thunbar'] ?>">
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
        <div class="toolbar">
            <div class="paper">
                <div class="amount">
                    Có <strong><?php echo $total ?></strong> sản phẩm trong <strong><?php echo $sotrang ?></strong> trang </div>
                </div>
                <nav class="pages">
                    <ul class="pagination">
                        <?php for ($i = 1; $i <= $sotrang; $i++) : ?>
                            <li class="<?php echo isset($_GET['p']) && $_GET['p'] == $i ? 'active' : '' ?>">
                                <a href="<?php echo $path ?>?id=<?php echo $id ?>&&p=<?php echo $i ?>"><?php echo $i; ?>
                                </a>
                            </li>
                        <?php endfor; ?>
                    </ul>
                </nav>
            </div>
        </div>
    </section>
</div>

<?php require_once __DIR__ . "/layouts/footer.php" ?>