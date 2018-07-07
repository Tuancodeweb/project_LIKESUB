<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Login</title>
    <link rel="stylesheet" href="css/style.css">
    <link href="//netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//netdna.bootstrapcdn.com/bootstrap/3.1.0/js/bootstrap.min.js"></script>
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>




    <link href="https://fonts.googleapis.com/css?family=Amatic+SC" rel="stylesheet">
    <!------ Include the above in your HEAD tag ---------->
</head>
    <body>
            

<?php include'../_config.php' ?> 
<?php include '../function/active.php'; ?>
<?php
if (isset($_POST['submit'])) {
    $user_name = htmlspecialchars(addslashes($_POST['user_name']));
    $password = htmlspecialchars(addslashes(md5($_POST['password'])));
    $sql = "SELECT COUNT(*), status, id_ctvs, rule, password FROM ctv WHERE (user_name = " . "'$user_name'" . " OR email = " . "'$user_name'" . ") AND password = " . "'$password' GROUP BY status, id_ctvs, rule, password";
    $c = mysqli_query($conn, $sql);
    $check = mysqli_fetch_assoc($c);
    if ($check['COUNT(*)'] == 1) {
        if ($check['status'] == -1) {
            echo "<script>alert('Tài khoản của bạn đã bị khóa'); window.location = '../admin/index.php';</script>";
        } else {
            if ($check['status'] == 1) {
                $id_ctv = $check['id_ctvs'];
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
                    echo "<script>alert('Đăng nhập thành công'); window.location='../home.php';</script>";
                }
            } else if ($check['status'] == 0) {
                echo "<p class='alert alert-danger'> Tài khoản của bạn chưa được kích hoạt. Vui lòng liên hệ Admin để nạp tiền CTV và kích hoạt tài khoản!!</p>";
            }
        }
    } else {
        echo "<script>alert('Tài khoản hoặc mật khẩu không chính xác!!!');</script>";
    }
}
?>
<?php include'../_config.php' ?> 

<div class="container">

<div class="row" style="margin-top:20px">
    <div class="col-xs-12 col-sm-8 col-md-6 col-sm-offset-2 col-md-offset-3">
        <form class="form-horizontal" method="post" action="#">




            <fieldset>
                <h2 class="text-fonts">Đăng nhập -  Cộng Tác Viên </h2>
                <hr class="colorgraph">



                <div class="form-group">
                    <label for="user_name" class="text-fonts">Tài khoản hoặc địa chỉ Email:</label>
                     <input type="text" class="form-control" id="user_name" name="user_name" value="<?php echo isset($_POST['user_name']) ? $_POST['user_name'] : ''; ?>" placeholder="Tài khoản hoặc địa chỉ Email" required>
                </div>




                <div class="form-group">
                    <label for="password" class="text-fonts">Mật khẩu:</label>
                   <input type="password" class="form-control" name="password" id="password" placeholder="Password" required>
                </div>



                <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">
                            <div class="checkbox text-fonts">
                                <label>
                                    <input name="duydeptrai" type="checkbox"> Ghi nhớ mật khẩu
                                </label>
                            </div>
                        </div>
                </div>



                <hr class="colorgraph">
                <div class="box-footer text-fonts">
                    <a class="btn btn-danger" href="../index.php" class="text-fonts">ĐĂNG NHẬP CHO ĐẠI LÍ, THÀNH VIÊN</a>
                    <button type="submit" name="submit" class="btn btn-info pull-right" class="text-fonts">Đăng nhập</button>
                </div>
            </fieldset>






        </form>
    </div>
</div>

</div>
    </body>
</html>