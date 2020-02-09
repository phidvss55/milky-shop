<?php

require_once __DIR__ . "/autoload/autoload.php"

?>
<?php
// require_once __DIR__. "/layouts/header.php" 
include __DIR__ . ("/layouts/header.php");
?>

<div class="col-md-9 bor">
    <section class="box-main1">
        <h3 class="title-main"><a href=""> Hướng dẫn mua hàng </a></h3>
        <div class="process-wrapper">
            <div id="progress-bar-container">
                <ul>
                    <li class="step step01 active">
                        <div class="step-inner">nhập thông tin khách hàng</div>
                    </li>
                    <li class="step step02">
                        <div class="step-inner">Xác nhận thông tin</div>
                    </li>
                    <li class="step step03">
                        <div class="step-inner">Thanh toán</div>
                    </li>
                    <li class="step step04">
                        <div class="step-inner">Hoàn tất</div>
                    </li>
                </ul>
                <div id="line">
                    <div id="line-progress"></div>
                </div>
            </div>
            <div id="progress-content-section">
                <div class="section-content discovery active">
                    <h2>Nhập thông tin khách hàng</h2><br>
                    <div class="content">
                    <p>Quý khách với đăng nhập để có thể mua hàng của chúng tôi. Với khách hàng chưa có tài khoản, quý khách có thể đăng ký trực tiếp tại website</p>
                    <p>Chọn sản phẩm quý khách cần mua và thêm vào giỏ hàng.</p>
                    <p>Quý khách có thể thay đổi số lượng sản phẩm khi vào giỏ hàng.</p>
                    <p>Click thanh toán và tiến hành điền thông tin.</p>
                    <p>Ấn thanh toán và chúng tôi sẽ chuyển cho bạn sớm nhất.</p>
                    <span style="text-decoration: underline; font-size: 16px; font-weight: bold; color: red;">Lưu ý: </span>
                    <p>Mọi thông tin có biểu tượng <span style="color: red;font-size:18px;"> * </span> là bắt buộc. Khách hàng vui lòng điền đầy đủ thông tin.</p>
                    </div>
                </div>

                <div class="section-content strategy clearfix">
                    <h2>Xác nhận thông tin</h2><br>
                    <h4>Thông tin cá nhân</h4>
                    <div class="row">
                        <div class="col-md-6">
                            <ul>
                                <li>Tên thành viên: </li>
                                <li>Email: </li>
                                <li>Số điện thoại: </li>
                                <li>Địa chỉ</li>
                            </ul>
                        </div>
                        <div class="col-md-6">
                            <ul>
                                <li>Tổng tiền: </li>
                                <li>Hình thức thanh toán: </li>
                                <li>Hình thức giao hàng: </li>
                            </ul>
                        </div>
                    </div><hr>
                    <h4>Thông tin mua hàng</h4>
                    <div class="row img-fluid col-md-10">
                        <img src="./public/frontend/images/demo.PNG" alt="abc" width="680px">
                    </div>
                </div>

                <div class="section-content creative">
                    <h2>Thanh toán</h2><br>
                    <div class="content">
                        <p>Sau khi kiểm tra kỹ thông tin, hãy điền thông tin thanh toán.</p>
                    </div>
                    <div class="row payment">
                        <img src="./public/frontend/images/thanh-toan.PNG" alt="abc" width="100%">
                    </div>
                    
                </div>

                <div class="section-content production">
                    <h2>Hoàn tất</h2><br>
                    <div class="content">
                        <p>Sau khi chọn hình thức thanh toán. Sẽ có thông báo đặt hàng thành công hay không?</p>
                    </div>
                    <div class="row payment">
                        <img src="./public/frontend/images/success.PNG" alt="abc" width="100%">
                    </div>
                    <div class="content">
                    <span style="text-decoration: underline; font-size: 16px; font-weight: bold; color: red;">Lưu ý: </span>
                    <p>Đơn hàng thường sẽ được giao sau 2 - 3 ngày. Quý khách vui lòng <span style="color: red;font-size:18px;"> để ý </span>
                    điện thoại, mail để phòng Shipper gọi.</p>
                    <p>Chúc quý khách mua sắp vui vẻ.</p>
                    </div>
                </div>
            </div>
        </div>
        <!-- Nội dung -->
    </section>
</div>

<?php require_once __DIR__ . "/layouts/footer.php" ?>