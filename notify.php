<?php 

    require_once __DIR__. "/autoload/autoload.php";
    
    // sau khi insert thành công thì huỷ đơn hàng   
    unset($_SESSION['cart']);
    unset($_SESSION['total']);

?>
<?php require_once __DIR__. "/layouts/header.php" ?>

<div class="col-md-9 bor">

    <section class="box-main1">
        <h3 class="title-main"><a href=""> Thông báo thanh toán </a> </h3>
        
        <?php if(isset($_SESSION['success'])): ?>
            <div class="alert alert-success">
                <strong style="color: #3c763d;">Success! </strong><?php echo $_SESSION['success']; unset($_SESSION['success']); ?>
            </div>
        <?php endif ?>
        <div class="fixed-btn col-md-offset-5">
            <a href="index.php" class="btn btn-success "> Trở về trang chủ </a>
        </div>
    </section>
</div>

<?php require_once __DIR__. "/layouts/footer.php" ?>