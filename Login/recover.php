<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title></title>
  <link rel="stylesheet" href="css/style_recover.css">
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
     <link href='http://fonts.googleapis.com/css?family=Raleway:500' rel='stylesheet' type='text/css'>
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <!------ Include the above in your HEAD tag ---------->
    <script type="text/javascript" src="js/app.js"></script>
</head>
  <body> 
    <?php include '../_config.php'; ?>
     <?php include '../function/active.php'; ?>
<?php
if (isset($_POST['recoverpass'])) {
    $loi = array();
    $email = $_POST['email'];
    $get = "SELECT COUNT(*) FROM member WHERE email='$email' OR user_name='$email'";
    $result = mysqli_query($conn, $get);
    $check = mysqli_fetch_assoc($result);
    if ($check['COUNT(*)'] == 0) {
        $loi['404'] = '<font color="red">Email bạn vừa nhập không tồn tại trên hệ thống!</font>';
    }if (empty($loi)) {
        $get = "SELECT code, name, email FROM member WHERE email = '$email' OR user_name='$email'";
        $result = mysqli_query($conn, $get);
        $x = mysqli_fetch_assoc($result);
        $code = $x['code'];
        $name = $x['name'];
        $e = $x['email'];
        $subject = "Liên kết đặt lại mật khẩu cho tài khoản của bạn";
        $bcc = 'Vip.BestAuto.Pro - Recover Password';
        $noi_dung = "Xin chào <b>$name</b><br /><br />Chúng tôi gửi liên kết để đặt lại mật khẩu cho tài khoản của bạn.<br /><br /> <a href='http://Vip.BestAuto.Pro/index.php?DS=Recover&email=$e&code=$code' target='_blank'><span style='background:yellow; color:red'>http://Vip.BestAuto.Pro/index.php?DS=Recover&email=$e&code=$code</span></a><br /><br />Nếu đây không phải yêu cầu do bạn thực hiện, vui lòng xóa Email này. Xin cảm ơn!<br /><br />Đội ngũ <b>http://BestAuto.Pro</b>";
        if (sendDS($name, $e, $subject, $bcc, $noi_dung)) {
            echo "<script>alert('Chúng tôi đã gửi 1 email với liên kết đặt lại mật khẩu cho tài khoản của bạn. Vui lòng kiểm tra Email!!!');window.location='index.php';</script>";
        }
    }
}
if (isset($_POST['changepass'])) {
    $email = $_GET['email'];
    $new_pass = md5($_POST['password']);
    $new_code = substr(md5(time() + rand(0, 9)), 0, 8);
    $sql = "UPDATE member SET password = '$new_pass', code = '$new_code' WHERE email='$email'";
    if (mysqli_query($conn, $sql)) {
        echo "<script>alert('Đổi mật khẩu thành công. Vui lòng đăng nhập!');window.location='index.php?DS=Login';</script>";
    }
}
else if (isset($_GET['code'], $_GET['email'])) {
    $email = $_GET['email'];
    $code = $_GET['code'];
    $sql = "SELECT COUNT(*) FROM member WHERE email='$email' AND code='$code'";
    $result = mysqli_query($conn, $sql);
    $x = mysqli_fetch_assoc($result);
    if ($x['COUNT(*)'] == 1) {
        ?>

<div class="row">
    <div class="col-md-12">
        <!-- Horizontal Form -->
        <div class="box box-info wow fadeIn">
            <!-- /.box-header -->
            <!-- form start -->
            <section class="testimonial py-5" id="testimonial">
                <div class="container">
                    <div class="row ">
                            <div class="col-md-4 py-5 bg-primary text-white text-center ">
                                <div class=" ">
                                    <div class="card-body">
                                        <img src="http://www.ansonika.com/mavia/img/registration_bg.svg" style="width:30%">
                                        <h2 class="py-3">Mục Đặt lại mật khẩu</h2>
                                        <p>
                                            LIKESUB cảm ơn các bạn đã lựa chọn chúng tôi , mọi điều tốt nhất của sản phẩm chúng tôi đều phục vụ các bạn tận tình ở website  này !
                                         </p>
                                    </div>
                                </div>
                            </div>
                        <div class="col-md-8 py-5 border">
                                <h4 class="pb-4">Đặt lại mật khẩu</h4>
                            <form class="form-horizontal" action="#" method="post">
                                <div class="form-row">
                                    <div class="form-group col-md-12">
                                          <label for="password" class="col-sm-2 control-label" style="display: none;">Mật khẩu:</label>                                         
                                          <input type="password" class="form-control" name="password" id="password" placeholder="Mật khẩu mới" required>
                                     </div>
                                </div> 
                                <button type="submit" name="changepass" class="btn btn-info pull-right">Đổi mật khẩu</button>
                            </form>
                        </div>
                    </div>
            </section>

            </div>
        </div>
    </div>

<?php } else {
        echo "<script>alert('Liên kết không hợp lệ hoặc đã hết hạn'); window.location='index.php';</script>";
    }
} else { ?>


<div class="row">
    <div class="col-md-12">
        <!-- Horizontal Form -->
        <div class="box box-info wow fadeIn">
            <!-- /.box-header -->
            <!-- form start -->
            <section class="testimonial py-5" id="testimonial">
                <div class="container">
                    <div class="row ">
                            <div class="col-md-4 py-5 bg-primary text-white text-center ">
                                <div class=" ">
                                    <div class="card-body">
                                        <img src="http://www.ansonika.com/mavia/img/registration_bg.svg" style="width:30%">
                                        <h2 class="py-3">Mục Đặt lại mật khẩu</h2>
                                        <p>
                                            LIKESUB cảm ơn các bạn đã lựa chọn chúng tôi , mọi điều tốt nhất của sản phẩm chúng tôi đều phục vụ các bạn tận tình ở website  này !
                                         </p>
                                    </div>
                                </div>
                            </div>
                        <div class="col-md-8 py-5 border">
                                <h4 class="pb-4">Đặt lại mật khẩu</h4>
                            <form class="form-horizontal" action="#" method="post">
                                <div class="form-row">
                                    <div class="form-group col-md-12">
                                         <label for="email" class="col-sm-2 control-label" style="display: none;">Nhập địa chỉ Email hoặc UserName:</label>                                       
                                          <input type="text" class="form-control" value="<?php echo isset($_POST['email']) ? $_POST['email'] : ''; ?>" name="email" id="email" placeholder="Nhập địa chỉ Email hoặc Username" required>
                                        <?php echo isset($loi['404']) ? $loi['404'] : ''; ?>
                                     </div>
                                </div> 

                                 <div class="box-footer">

                                    <button type="submit" name="recoverpass" class="btn btn-info pull-right">Đặt lại mật khẩu</button>
                                </div>
                    </div>
                            </form>
                        </div>
                    </div>
            </section>

            </div>
        </div>
    </div>
<?php } ?>

  </body>
</html>