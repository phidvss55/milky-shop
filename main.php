<?php 

    require_once __DIR__. "/autoload/autoload.php"

?>
<?php
    // require_once __DIR__. "/layouts/header.php" 
    include __DIR__. ("/layouts/header.php");
?>

<div class="col-md-9 bor">

    <section class="box-main1">
        <h3 class="title-main" style="text-align: center;"><a href="javascript:void(0)"> Máy Canong </a> </h3>
        <?php
            echo __DIR__;
            echo _debug($_SESSION['email']);
        ?>
       <!-- Nội dung -->
    </section>
</div>

<?php require_once __DIR__. "/layouts/footer.php" ?>