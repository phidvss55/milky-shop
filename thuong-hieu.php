<?php
    require_once __DIR__ . "/autoload/autoload.php";

    $sql = "SELECT DISTINCT name FROM providers ORDER BY id";

    $result = $db->fetchsql($sql);

    // echo _debug($result);
?>

<?php
// require_once __DIR__. "/layouts/header.php" 
include __DIR__ . ("/layouts/header.php");
?>

<div class="col-md-9 bor">

    <section class="box-main1">
        <h3 class="title-main"><a> Thương hiệu liên kết </a> </h3>
        <div class="brand">
            <div class="content-box-md">
                <div class="service-tab">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-4 text-center">
                                <img src="./public/frontend/images/logo/friso.jpg" class="img-thumbnail" width="350px" height="200"  alt="Girl Picture">
                            </div>
                            <div class="col-md-5">
                                <div class="tab-bg">
                                    <h2>01</h2>
                                    <h3>Friso</h3>
                                    <p>
                                        Dòng sản phẩm sữa Friso là thương hiệu sản xuất sữa uy tín với 130 năm hình thành và phát triển trên thị trường được sử dụng rất 
                                        nhiều cho trẻ nhỏ được các bà mẹ tin dùng rất nhiều. Với các thành phần dưỡng chất có trong sữa mang lại giúp bé phát triển toàn 
                                        diện. Do vậy, khi mua sữa bột Friso, mẹ cần chọn mua những nơi bán sữa chính hãng và uy tín để có thể hoàn toàn yên tâm về chất 
                                        lượng của sản phẩm.
                                    </p>
                                    <div id="services-02-btn-01">
                                        <a class="btn btn-info" href="https://www.friso.com.vn/">Read More</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Tab 2 -->
                <div class="service-tab">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-4 text-center">
                            <img src="./public/frontend/images/logo/abbott.jpg" class="img-thumbnail" width="350px" height="200px"  alt="Girl Picture">
                            </div>
                            <div class="col-md-5">
                                <div class="tab-bg">
                                    <h2>02</h2>
                                    <h3>Abbott</h3>
                                    <p>
                                    ABBOTT được thành lập vào năm 1888 là công ty chăm sóc sức khỏe hàng đầu thế giới. Hãng đã nghiên cứu, 
                                    phát triển và cho ra hoàng loạt các sản phẩm và cả dịch vụ chăm sóc sức khỏe có chất lượng cao trong 
                                    lĩnh vực dược phẩm, dinh dưỡng, thiết bị chuẩn đoán và điệu trị bệnh.
                                    </p>
                                    <div id="services-02-btn-01">
                                        <a class="btn btn-info" href="https://nutrition.abbott/vn">Read More</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Tab 3 -->
                <div class="service-tab">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-4 text-center">
                            <img src="./public/frontend/images/logo/vinamilk.png" class="img-thumbnail" width="350px" height="200px"  alt="Girl Picture">
                            </div>
                            <div class="col-md-5">
                                <div class="tab-bg">
                                    <h2>03</h2>
                                    <h3>Vinamilk</h3>
                                    <p>
                                        Với sứ mệnh cam kết mang đến cho cộng đồng nguồn dinh dưỡng và chất lượng cao cấp hàng đầu bằng chính sự trân trọng, tình yêu và 
                                        trách nhiệm cao của mình với cuộc sống con người và xã hội, Vinamilk luôn đặt an toàn thực phẩm làm nguyên tắc hàng đầu, Vinamilk 
                                        cam kết mỗi sản phẩm của Vinamilk đều là kết quả của một chu kỳ khép kín đáp ứng đầy đủ các yêu cầu nghiêm ngặt.
                                    </p>
                                    <div id="services-02-btn-01">
                                        <a class="btn btn-info" href="https://www.vinamilk.com.vn/en/">Read More</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Tab 4 -->
                <div class="service-tab">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-4 text-center">
                            <img src="./public/frontend/images/logo/dutch lady.png" class="img-thumbnail" width="350px" height="200px" alt="Girl Picture">
                            </div>
                            <div class="col-md-5">
                                <div class="tab-bg">
                                    <h2>04</h2>
                                    <h3>Dutch Lady</h3>
                                    <p>
                                    FrieslandCampina được thành lập vào năm 1871 bởi các gia đình nông dân Hà Lan. Truyền thống này đồng nghĩa 
                                    với việc chúng tôi luôn sản xuất sữa bằng phương pháp kỹ thuật và kinh nghiệm được lưu truyền qua nhiều thế hệ.
                                     Từ việc chọn những con bò sữa tốt nhất đến áp dụng công nghệ sản xuất mới nhất, chúng tôi luôn cam kết sản xuất
                                      sữa với chất lượng tốt nhất.
                                    </p>
                                    <div id="services-02-btn-01">
                                        <a class="btn btn-info" href="https://dutchlady.com.vn/index.html">Read More</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<?php require_once __DIR__ . "/layouts/footer.php" ?>