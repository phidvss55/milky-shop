<?php
    require_once __DIR__ . "/autoload/autoload.php";

    //get user id
    $user = $db->fetchID("users", intval($_SESSION['name_id']));    

    if($_SERVER["REQUEST_METHOD"] == "POST") {
        $data = [
            'amount'  => $_SESSION['total'],
            'user_id' => $_SESSION['name_id'],
            'note'    => postInput('note'),
            'payment_method' => postInput('payment_method')
        ];

        $idtran = $db->insert("transaction", $data);
        
        // $method = postInput('payment_method');
        if(postInput('payment_method') === "Thanh toán qua thẻ ngân hàng") {
            $data1 = [
                'transaction_id' => $idtran,
                'bank_name' => postInput('bank')
            ];
             $idBank = $db->insert("bank", $data1);
        }
        
        // neu id > 0 thi insert success
        if($idtran > 0) {
            foreach($_SESSION['cart'] as $key => $value) {
                $data2 = [ //mang data 2  trong bang orders o mysql
                    'transaction_id'    => $idtran,
                    'product_id'        => $key,
                    'qty'               => $value['qty'], 
                    'price'             => $value['price']
                ];

                $idInsert = $db->insert("orders", $data2);
            }
            
            // sau khi insert thanh cong -> notifacation
            $_SESSION['success'] = " Lưu thông tin đơn hàng thành công! Chúng tôi sẽ cố gắng liên hệ với bạn sớm nhất. ";
            header("location: notify.php");
        }
    }

?>
<?php require_once __DIR__ . "/layouts/header.php" ?>

<div class="col-md-9 bor">

    <section class="box-main1">
        <h3 class="title-main"><a href=""> Thanh toán đơn hàng </a></h3>

        <form action="" method="POST" role="form" class="form-horizontal">
            <!-- Tên -->
            <div class="form-group">
                <div class="login-name">
                    <label class="col-md-3 control-label"> Tên thành viên </label>
                    <div class="col-md-8">
                        <input type="text" readonly="" name="name" class="form-control" id="" value="<?php echo $user['name'] ?>">
                    </div>
                </div>
            </div>
            <!-- Mail -->
            <div class="form-group">
                <label class="col-md-3 control-label"> Email </label>
                <div class="col-md-8">
                    <input type="email" readonly="" name="email" class="form-control" id="" value="<?php echo $user['email'] ?>">
                </div>
            </div>
            <!-- Phone -->
            <div class="form-group">
                <label class="col-md-3 control-label"> Số điện thoại </label>
                <div class="col-md-8">
                    <input type="number" readonly="" name="phone" class="form-control" id="" value="<?php echo $user['phone'] ?>">
                </div>
            </div>
            <!-- Address -->
            <div class="form-group">
                <label class="col-md-3 control-label"> Địa chỉ </label>
                <div class="col-md-8">
                    <input type="text" readonly="" name="address" class="form-control" id="" value="<?php echo $user['address'] ?>">
                </div>
            </div>
              <!-- Total money -->
              <div class="form-group">
                <label class="col-md-3 control-label"> Tổng tiền </label>
                <div class="col-md-8">
                    <input type="text" readonly="" name="tongtien" class="form-control" value="<?php echo formatPrice($_SESSION['tongtien']) ?>">
                </div>
            </div>
            <!-- Hinh thuc thanh toan -->
            <div class="form-group">
                <label for="thanhtoan" class="col-md-3 control-label">Hình thức thanh toán</label>
                <div class="col-md-8">
                    <select name="payment_method" class="form-control" id="thanhtoan" onchange="showForm()">
                        <option value="">Chọn hình thức thanh toán</option>
                        <option value="Thanh toán khi nhận hàng" id="">Thanh toán khi nhận hàng</option>
                        <option value="Ví momo" id="">Ví điện tử momo</option>
                        <option value="Thanh toán qua thẻ ngân hàng" id="">Thanh toán qua thẻ ngân hàng</option>
                    </select>
                </div>
            </div>
            <!-- Ngan hang -->
            <div class="form-group ngan-hang" id="ngan-hang">
                <label class="col-md-3 control-label">Chọn Ngân hàng</label>
                <div class="col-md-8">
                    <select name="bank" class="form-control">
                        <option value="">Chọn ngân hàng thanh toán</option>
                        <option value="Vietcombank">Vietcombank</option>
                        <option value="Argibank">Argibank</option>
                        <option value="Timo">Timo</option>
                    </select>
                </div></div>
            <!-- HÌnh thức giao hàng -->
            <div class="form-group">
                <label class="col-md-3 control-label"> Hình thức giao hàng </label>
                <div class="col-md-8">
                    <input type="text" name="note" class="form-control" placeholder=" Giao hàng tận nơi ">
                </div>
            </div>
            <div class="col-md-offset-5 fixed-btn">
                <button type="submit" class="btn btn-success"> Thanh toán </button>
            </div>
        </form>

    </section>
</div>

<?php require_once __DIR__ . "/layouts/footer.php" ?>