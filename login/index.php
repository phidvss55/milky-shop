<?php 
    session_start();
    require_once __DIR__. "/../libraries/Database.php";
    require_once __DIR__. "/../libraries/Function.php";

    $db = new Database;

    
    $data = [
        'email'     => postInput("email"),
        'password'  => postInput("password")
    ];

    
    //mảng kiểm tra lỗi
    $error = [];

    if( $_SERVER['REQUEST_METHOD'] == "POST") {
        if($data['email'] == '') {
            $error['email'] = " Email không được để trống. ";
        }

        if($data['password'] == '') {
            $error['password'] = " Mật khẩu không được để trống. ";
        }

        if(empty($error)) {

            $isCheck = $db->fetchOne("admin", "email = '".$data['email']."' AND password = '". MD5($data['password'])."' ");
            if($isCheck != NULL) {
                $_SESSION['admin_name'] = $isCheck['name'];
                $_SESSION['admin_id'] = $isCheck['id'];

                echo "<script>alert(' Đăng nhập thành công. '); location.href='/milkyshop/admin/'</script>";
            } else {
                $_SESSION['error'] = " Đăng nhập thất bại. "; //fail
            }
        }
    }
?>
<head>
    <link rel="stylesheet" href="bootstrap.min.css">
</head>

<style type="text/css">
    :root {
        --input-padding-x: 1.5rem;
        --input-padding-y: .75rem;
    }

    body {
        background: rgb(0,31,255);
        background: linear-gradient(180deg, rgba(0,31,255,1) 0%, rgba(2,212,255,1) 100%);
    }

    .card-signin {
        border: 0;
        border-radius: 1rem;
        box-shadow: 0 0.5rem 1rem 0 rgba(0, 0, 0, 0.1);
    }

    .card-signin .card-title {
        margin-bottom: 2rem;
        font-weight: 300;
        font-size: 1.5rem;
    }

    .card-signin .card-body {
        padding: 2rem;
    }

    .form-signin {
        width: 100%;
    }

    .form-signin .btn {
        font-size: 80%;
        border-radius: 5rem;
        letter-spacing: .1rem;
        font-weight: bold;
        padding: 1rem;
        transition: all 0.2s;
    }

    .form-label-group {
        position: relative;
        margin-bottom: 1rem;
    }

    .form-label-group input {
        height: auto;
        border-radius: 2rem;
    }

    .form-label-group>input,
    .form-label-group>label {
        padding: var(--input-padding-y) var(--input-padding-x);
    }

    .form-label-group>label {
        position: absolute;
        top: 0;
        left: 0;
        display: block;
        width: 100%;
        margin-bottom: 0;
        /* Override default `<label>` margin */
        line-height: 1.5;
        color: #495057;
        border: 1px solid transparent;
        border-radius: .25rem;
        transition: all .1s ease-in-out;
    }

    .form-label-group input::-webkit-input-placeholder {
        color: transparent;
    }

    .form-label-group input:-ms-input-placeholder {
        color: transparent;
    }

    .form-label-group input::-ms-input-placeholder {
        color: transparent;
    }

    .form-label-group input::-moz-placeholder {
        color: transparent;
    }

    .form-label-group input::placeholder {
        color: transparent;
    }

    .form-label-group input:not(:placeholder-shown) {
        padding-top: calc(var(--input-padding-y) + var(--input-padding-y) * (2 / 3));
        padding-bottom: calc(var(--input-padding-y) / 3);
    }

    .form-label-group input:not(:placeholder-shown)~label {
        padding-top: calc(var(--input-padding-y) / 3);
        padding-bottom: calc(var(--input-padding-y) / 3);
        font-size: 12px;
        color: #777;
    }

    .btn-google {
        color: white;
        background-color: #ea4335;
    }

    .btn-facebook {
        color: white;
        background-color: #3b5998;
    }

    .btn-spacing {
        margin-top: 20px;
    }
</style>

<div class="container">
    <div class="row">
        <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
            <div class="card card-signin my-5">
                <div class="card-body">
                    <h5 class="card-title text-center">Sign In</h5>
                    <form class="form-signin" action="" method="POST">
                        <div class="form-label-group">
                            <input type="email" id="inputEmail" name="email" class="form-control" placeholder=" Email address ">
                            <label for="inputEmail">Email address</label>
                            <?php if(isset($error['email'])): ?>
                                <p class="text text-danger"><?php echo $error['email'] ?></p>
                            <?php endif ?>
                        </div>

                        <div class="form-label-group">
                            <input type="password" id="inputPassword" name="password" class="form-control" placeholder=" Password ">
                            <label for="inputPassword">Password</label>
                            <?php if(isset($error['password'])): ?>
                                <p class="text text-danger"><?php echo $error['password'] ?></p>
                            <?php endif ?>
                        </div>

                        <div class="custom-control custom-checkbox mb-3">
                            <input type="checkbox" class="custom-control-input" id="customCheck1">
                            <label class="custom-control-label" for="customCheck1">Remember password</label>
                        </div>
                        <button class="btn btn-lg btn-primary btn-block text-uppercase" type="submit">Sign in</button>
                        <a class="btn btn-danger col-md-12 btn-spacing" href="<?php echo base_url() ?>" style="font-size: 11.5pt"> Cancel </a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>