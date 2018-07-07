<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title></title>
  <link rel="stylesheet" href="css/style_dangki.css">
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
     <link href='http://fonts.googleapis.com/css?family=Raleway:500' rel='stylesheet' type='text/css'>
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <!------ Include the above in your HEAD tag ---------->
    <script type="text/javascript" src="js/app.js"></script>
</head>
  <body>    
  <?php include'../_config.php' ?>  
  <?php include '../function/active.php'; ?>
<?php
if (isset($_POST['submit'])) {
    $loi = array();
    if($_POST['type'] != 'freelancer'){
        $get = "SELECT user_name, email FROM member";
    }else{
        $get = "SELECT user_name, email FROM ctv";
    }
    $result = mysqli_query($conn, $get);
    while ($x = mysqli_fetch_assoc($result)) {
        if ($x['user_name'] == $_POST['user_name']) {
            $loi['user_name'] = "<font color='red'>Đã có người sử dụng username này!</font>";
        }
        if ($x['email'] == $_POST['email']) {
            $loi['email'] = "<font color='red'>Đã có người sử dụng email này!</font>";
        }
    }
    if (strcmp($_POST['password'], $_POST['password2']) != 0) {
        $loi['pass'] = "<font color='red'>2 mật khẩu không trùng nhau!</font>";
    }
    if (empty($loi)) {
        $type = $_POST['type'];
        $pass = $_POST['password'];
        $user_name = htmlspecialchars(addslashes($_POST['user_name']));
        $password = htmlspecialchars(addslashes(md5($_POST['password'])));
        $hoten = htmlspecialchars(addslashes($_POST['name']));
        $sdt = htmlspecialchars(addslashes($_POST['sdt']));
        $email = htmlspecialchars(addslashes($_POST['email']));
        $profile = htmlspecialchars(addslashes($_POST['profile']));
        $bill = '1000';
        $status = '0';
        $code = substr(md5(time() + rand(0, 9)), 0, 8);
        if($type == 'memeber'){
            $sql = "INSERT INTO member(user_name, password, name, phone, email, profile, bill, status, code,rule,num_id)  VALUES('$user_name','$password','$hoten','$sdt','$email','$profile','$bill','$status','$code','member',0)";
        }else if($type == 'freelancer'){
            $sql = "INSERT INTO ctv(user_name, password, name, phone, email, profile, bill, status, code,rule,id_agency) VALUES('$user_name','$password','$hoten','$sdt','$email','$profile','$bill','$status','$code','freelancer',0)";
        }else{
            $sql = "INSERT INTO member(user_name, password, name, phone, email, profile, bill, status, code,rule,num_id)  VALUES('$user_name','$password','$hoten','$sdt','$email','$profile','$bill','$status','$code','agency',0)";
        }

        if (mysqli_query($conn, $sql)) 
        {
            if($type == 'member'){
                $query = "SELECT code FROM member WHERE user_name='$user_name'";
                $result = mysqli_query($conn, $query);
                $c = mysqli_fetch_assoc($result);
                $code = $c['code'];
                $subject = 'Vui lòng xác minh địa chỉ email của bạn';
                $bcc = 'VIP.BestAuto.Pro - VIP Like Account Active';
                $noi_dung = "Xin chào <b>$hoten</b>!<br /><br /> Cảm ơn bạn đã đăng kí tài khoản thành viên tại hệ thống VIP Facebook Auto <b>http://Vip.BestAuto.Pro</b><br /><br />Vui lòng click vào liên kết : <a href='http://vip.bestauto.pro/index.php?DS=Confirm&email=$email&code=$code' target='_blank'><span style='background:yellow; color:red'>http://Vip.BestAuto.Pro/index.php?DS=Confirm&email=$email&code=$code</span></a> để kích hoạt tài khoản của bạn. <br /><br />Thông tin đăng nhập của bạn sau khi kích hoạt thành công:<br /><br />Tài khoản: <b>$user_name</b><br />Mật khẩu: <b>$pass</b><br /><br />Vui lòng bảo mật thông tin này, nếu quên mật khẩu bạn có thể sử dụng địa chỉ email này để lấy lại.<br /><br />Xin cảm ơn và hậu tạ!<br/><br/>Đội ngũ <b>BestAuto.Pro</b>";

                if (sendDS ($email, $hoten, $subject, $noi_dung, $bcc) )
                {
                    echo "<p class='alert alert-success'> Đăng kí thành công. Chúng tôi đã gửi 1 liên kết kích hoạt tài khoản đến email <b>$email</b> của bạn. Vui lòng đăng nhập kiểm tra Hộp thư đến ( hoặc Spam ) và click vào liên kết trong email để kích hoạt tài khoản. Chú ý: <b> Trong vòng 72h kể từ ngày đăng kí , nếu không kích hoạt Email, tài khoản của bạn trên hệ thống sẽ bị xóa!!</b>Nếu có vấn đề gì xảy xa trong quá trình tạo tài khoản và đăng nhập, vui lòng liên hệ Admin. Xin cảm ơn!</p><script>setTimeout(function(){ window.location  = 'index.php'; }, 20000);</script>";
                }
            }
            else
            {
                echo "<script>alert('Đăng kí thành công, vui lòng liên hệ Admin và nạp tiền để kích hoạt tài khoản');window.location='index.php';</script>";
            }
        }
    }
}
?>
<div class="row">
    <div class="col-md-12">
        <!-- Horizontal Form -->
        <div class="box box-info wow fadeIn">
            <div class="box-header with-border">
                
            </div>
            <!-- /.box-header -->
            <!-- form start -->
                 <section class="testimonial py-5" id="testimonial">
                    <div class="container">
                        <div class="row ">
                            <div class="col-md-4 py-5 bg-primary text-white text-center ">
                                <div class=" ">
                                    <div class="card-body">
                                        <img src="http://www.ansonika.com/mavia/img/registration_bg.svg" style="width:30%">
                                        <h2 class="py-3">Mục Đăng ký</h2>
                                        <p>
                                            LIKESUB cảm ơn các bạn đã lựa chọn chúng tôi , mọi điều tốt nhất của sản phẩm chúng tôi đều phục vụ các bạn tận tình ở website  này !
                                         </p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-8 py-5 border">
                                <h4 class="pb-4">Đăng kí tài khoản</h4>
                            <form class="form-horizontal" action="#" method="post">
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="username" class="col-sm-2 control-label" style="display: none;">Tài khoản:</label>
                                        <input type="text" minlength="4" class="form-control" id="user_name" value="<?php echo isset($_POST['user_name']) ? $_POST['user_name'] : ''; ?>" name="user_name" placeholder="Tài khoản" required>
                                         <?php echo isset($loi['user_name']) ? $loi['user_name'] : ''; ?>
                                     </div>



                                    <div class="form-group col-md-6">
                                        <label for="password" class="col-sm-2 control-label" style="display: none;">Mật khẩu:</label>
                                         <input type="password" minlength="6" class="form-control" id="password" name="password" placeholder="Password" required>
                                    </div>


                                </div>


                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                            <label for="password2" class="col-sm-2 control-label" style="display: none;">Nhập lại Mật khẩu:</label>
                                             <input type="password" minlength="6" class="form-control" id="password2" name="password2" placeholder="Nhập lại password" required>
                                            <?php echo isset($loi['pass']) ? $loi['pass'] : ''; ?>
                                    </div>
                                    <div class="form-group col-md-6">
                                                  
                                             <label for="name" class="col-sm-2 control-label" style="display:none;">Họ tên:</label>
                                             <input type="text" minlength="2" class="form-control" value="<?php echo isset($_POST['name']) ? $_POST['name'] : ''; ?>" id="name" name="name" placeholder="Họ và tên" required>
                                    </div>
                                        <div class="form-group col-md-12">
                                             <label for="phone" class="col-sm-2 control-label" style="display:none;">Số điện thoại:</label>                            
                                            <input type="number" class="form-control" id="sdt" value="<?php echo isset($_POST['sdt']) ? $_POST['sdt'] : ''; ?>" name="sdt" placeholder="Số điện thoại" required>
                                        </div>
                                         <div class="form-group col-md-12">
                                             <label for="email" class="col-sm-2 control-label" style="display: none;">Email (nhập chính xác để kích hoạt tài khoản):</label>

                                             <input type="email" class="form-control" id="email" value="<?php echo isset($_POST['email']) ? $_POST['email'] : ''; ?>" name="email" placeholder="Địa chỉ Email" required>
                                             <?php echo isset($loi['email']) ? $loi['email'] : ''; ?>
                                        </div>
                                        <div class="form-group col-md-12">
                                             <label for="profile" class="col-sm-2 control-label" style="display: none;">ID Facebook:</label>
                                            <input type="number" class="form-control" id="profile" value="<?php echo isset($_POST['profile']) ? $_POST['profile'] : ''; ?>" name="profile" placeholder="Nhập user id facebook" required>
                                        </div>
                                         <div class="form-group col-md-12">
                                                <label for="profile" class="col-sm-2 control-label" style="display: none;">Loại tài khoản?:</label>
                                                <select name="type" class="form-control">
                                                <option value="member" <?php echo (isset($_POST['type']) && $_POST['type'] == 'member') ? 'selected' : ''; ?>>Member thường</option>
                                                <option value="freelancer" <?php echo (isset($_POST['type']) && $_POST['type'] == 'freelancer') ? 'selected' : ''; ?>>Cộng tác viên</option>
                                                <option value="agency" <?php echo (isset($_POST['type']) && $_POST['type'] == 'agency') ? 'selected' : ''; ?>>Đại lí</option>
                                                </select>
                                        </div>

                                </div>
                                    
                                    <div class="form-row">
                                          <font color="red"><b>Cộng tác viên và Đại lí ko phải kích hoạt Email, tài khoản sẽ được kích hoạt khi nạp tiền!</b></font>
                                            <button type="submit" name="submit" class="btn btn-info pull-right">Đăng kí tài khoản</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </section>

            </div>
        </div>
    </div>

  </body>
</html>