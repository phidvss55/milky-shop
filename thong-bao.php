<?php 

    require_once __DIR__. "/autoload/autoload.php"

?>
<?php
    // require_once __DIR__. "/layouts/header.php" 
    include __DIR__. ("/layouts/header.php");
?>

<div class="col-md-9 bor">

    <section class="box-main1">
        <h3 class="title-main"><a> Thông báo </a> </h3>
        <img class="img-smile" src="./public/frontend/images/smile-face.png" alt="Smile Face" width="150px">
        <div class="alert alert-info" role="alert">
            <strong style="color: #2a5be4">Oops! </strong> Không có thông báo nào.
        </div>
    </section>
</div>

<?php require_once __DIR__. "/layouts/footer.php" ?>