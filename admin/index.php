<?php
ob_start();
session_start();
date_default_timezone_set('Asia/Ho_Chi_Minh');
define('COPYRIGHT', 'DuySexy');
include '_config.php';
include '../Mailer/PHPMailerAutoload.php';
include '../Login/function/active.php';
$duysexy = false;
if ((isset($_SESSION['login']) && $_SESSION['login'] == 'ok') || (isset($_COOKIE['login']) && $_COOKIE['login'] == 'ok')) {
    $duysexy = true;
    if (isset($_SESSION['login']) && $_SESSION['login'] == 'ok') {
        $idctv = $_SESSION['id_ctv'];
        $rule = $_SESSION['rule'];
        $uname = $_SESSION['user_name'];
        $upass = $_SESSION['pass'];
        $ustatus = $_SESSION['status'];
    } else if (isset($_COOKIE['login']) && $_COOKIE['login'] == 'ok') {
        $idctv = $_COOKIE['id_ctv'];
        $rule = $_COOKIE['rule'];
        $uname = $_COOKIE['user_name'];
        $upass = $_COOKIE['pass'];
        $ustatus = $_COOKIE['status'];
    }
    if($rule != 'freelancer'){
        $sql = "SELECT name, email, bill, user_name,profile FROM member WHERE id_ctv = $idctv";
    }else{
        $sql = "SELECT name, email, bill, user_name,profile FROM ctv WHERE id_ctvs = $idctv";
    }
    $result = mysqli_query($conn, $sql);
    $n = mysqli_fetch_assoc($result);
    $uname = $n['user_name'];
    $name = $n['name'];
    $email = $n['email'];
    $bill = $n['bill'];
    $profile = $n['profile'];
    $count_noti = '';
    if ($rule != 'admin') {
        $get_noti = "SELECT COUNT(noti.id) FROM noti WHERE id_ctv = $idctv AND status = 0";
    } else {
        $get_noti = 'SELECT COUNT(noti.id) FROM noti';
    }
    $result1 = mysqli_query($conn, $get_noti);
    $noti = mysqli_fetch_assoc($result1);
    if (empty($noti['COUNT(noti.id)'])) {
        $count_noti = 0;
    } else {
        $count_noti = $noti['COUNT(noti.id)'];
    }
    if ($rule != 'admin') {
        $get_his = "SELECT COUNT(history.id) FROM history WHERE id_ctv=$idctv";
    } else if($rule =='admin' && $idctv != 1){
        $get_his = "SELECT COUNT(history.id) FROM history WHERE id_ctv != 1";
    }else{
        $get_his = "SELECT COUNT(history.id) FROM history";
    }
    $result2 = mysqli_query($conn, $get_his);
    $his = mysqli_fetch_assoc($result2);
    $count_his = '';
    if (empty($his['COUNT(history.id)'])) {
        $count_his = 0;
    } else {
        $count_his = $his['COUNT(history.id)'];
    }
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="theme-color" content="pink" />
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport" />
        <meta name="description" content="LIKESUB là 1 hệ thống quản lí VIP Facebook Auto chuyên nghiệp nhất hiện nay với những tính năng mạnh mẽ và tối ưu hiệu quả cao." />
        <meta property="fb:app_id" content="110639052915401" />
        <meta name="author" content="LIKESUB" />
        <meta name="copyright" content="LIKESUB" />
        <meta name="robots" content="index, follow" />
        <meta property="og:url" content="LIKESUB" />
        <meta property="og:type" content="website" />
        <meta property="og:description" content="LIKESUB là 1 hệ thống quản lí VIP Facebook Auto chuyên nghiệp nhất hiện nay với những tính năng mạnh mẽ và tối ưu hiệu quả cao." />
        <meta property="og:image" content="../src/banner.jpg" />
        <meta property="og:locale" content="vi_VN" />
        <meta property="og:author" content="100010575067118" />
        <title>LIKESUB - Hệ Thống VIP Facebook Auto Pro</title>
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
        <script src="../plugins/jQuery/jquery-3.1.1.min.js"></script>
        <script src="../bootstrap/js/bootstrap.min.js"></script>
        <script src="../src/wow.js"></script>
        <script>new WOW().init();</script>
        <script>function logout(){ if(confirm('Bạn có chắc chắn muốn đăng xuất?') == true){window.location = 'logout.php';}else{alert('Ahiihii');}}</script>

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>
    <body class="hold-transition skin-green-light sidebar-collapse sidebar-mini">
        <div class="wrapper">
            <header class="main-header">
                <a href="index.php" class="logo">
                    <span class="logo-mini wow bounceInDown"><b>LS</b>O</span>
                    <span class="logo-lg wow bounceInDown"><b>LIKESUB</b></span>
                </a>
                <nav class="navbar navbar-static-top" role="navigation">
                    <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
                        <span class="sr-only">Toggle navigation</span>
                    </a>
                    <div class="navbar-custom-menu">
                        <?php if ($duysexy == true) {
                            ?>
                            <ul class="nav navbar-nav">
                                <!-- User Account Menu -->
                                <li class="dropdown user user-menu">
                                    <!-- Menu Toggle Button -->
                                    <a href="#" class="dropdown-toggle wow bounceInDown" data-toggle="dropdown">
                                        <!-- The user image in the navbar-->
                                        <img src="https://graph.fb.me/<?php echo isset($profile) ? $profile : '100010575067118'; ?>/picture" class="user-image" alt="Avatar">
                                        <!-- hidden-xs hides the username on small devices so only the image appears. -->
                                        <span class="hidden-xs"><?php echo isset($name) ? $name : 'DS'; ?></span>
                                    </a>
                                    <ul class="dropdown-menu">
                                        <!-- The user image in the menu -->
                                        <li class="user-header" style="text-align:justify">
                                            <p>
                                                Username: <b><?php echo isset($uname) ? $uname : ''; ?></b><br />
                                                Email: <b><?php echo isset($email) ? $email : ''; ?></b><br />
                                                Số dư: <b><?php echo isset($bill) ? number_format($bill) : ''; ?> VNĐ</b>
                                            </p>
                                            <div class="pull-left">
                                                <a href="index.php?DS=Change_Pass" class="btn btn-default btn-flat">Đổi mật khẩu</a>
                                            </div>
                                            <div class="pull-right">
                                                <a href="index.php?DS=Charge_Money" class="btn btn-default btn-flat">Nạp tiền $</a>
                                            </div>
                                        </li>
                                        <!-- Menu Body -->
                                        <!-- Menu Footer-->
                                        <li class="user-footer">
                                            <div class="pull-left">
                                                <a href="https://www.facebook.com/<?php echo isset($profile) ? $profile : '100010575067118'; ?>" class="btn btn-default btn-flat">Trang cá nhân</a>
                                            </div>
                                            <div class="pull-right">
                                                <a href="#"" onclick="logout()" class="btn btn-default btn-flat">Đăng xuất</a>
                                            </div>
                                        </li>
                                    </ul>
                                </li>
                                <!-- <li class="wow rotateIn" data-wow-duration="4s">
                                    <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
                                </li> -->
                            </ul>
                        <?php } else { ?>
                            <ul class="nav navbar-nav">
                                <!-- User Account Menu -->
                                <li class="dropdown user user-menu wow bounceInDown">
                                    <!-- Menu Toggle Button -->
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                        <!-- The user image in the navbar-->
                                        <img src="https://graph.fb.me/<?php echo isset($profile) ? $profile : '100010575067118'; ?>/picture" class="user-image" alt="Avatar">
                                        <!-- hidden-xs hides the username on small devices so only the image appears. -->
                                        <span class="hidden-xs">Chào, Khách!</span>
                                    </a>
                                </li>
                                <!-- <li class="wow rotateIn" data-wow-duration="4s">
                                    <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
                                </li> -->
                            </ul>
                        <?php } ?>
                    </div>
                </nav>
            </header>


            <aside class="main-sidebar">

                <!-- sidebar: style can be found in sidebar.less -->
                <section class="sidebar">

                    <!-- Sidebar user panel (optional) -->
                    <div class="user-panel wow flash" data-wow-duration="3s">
                        <div class="pull-left image">
                            <img src="https://graph.fb.me/<?php echo isset($profile) ? $profile : '100010575067118'; ?>/picture" class="img-circle" alt="User Image">
                        </div>
                        <div class="pull-left info">
                            <p><?php echo isset($uname) ? $uname : 'LIKESUB'; ?></p>
                            <!-- Status -->
                            <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
                        </div>
                    </div>

                    

                    <!-- Sidebar Menu -->
                    <?php if ($duysexy == false) { ?>
                        <ul class="sidebar-menu" data-widget="tree">
                            <li class="header wow fadeInLeft">MENU NAVIGATION</li>
                            <!-- Optionally, you can add icons to the links -->
                            <li class="active wow fadeInUp" data-wow-duration="1s"><a href="#" target="_blank"><i class="fa fa-star"></i> <span>LIKESUB</span></a></li>
                            <li class="wow fadeInUp" data-wow-duration="2s"><a href="index.php?DS=Login"><i class="fa fa-sign-in"></i> <span>Đăng nhập</span></a></li>
                            <li class="wow fadeInUp" data-wow-duration="4s"><a data-toggle="modal" href="#myModal"><i class="glyphicon glyphicon-usd"></i> <span>Bảng giá</span></a></li>
                            <li class="wow fadeInUp" data-wow-duration="5s"><a href="index.php?DS=Get_Token"><i class="glyphicon glyphicon-transfer"></i> <span>Get Access Token</span></a></li>
                        </ul>
                    <?php } else{
                        if ($rule == 'freelancer' || $rule == 'member') { ?>
                        <ul class="sidebar-menu" data-widget="tree">
                            <li class="header">MENU NAVIGATION</li>
                            <!-- Optionally, you can add icons to the links -->
                            <li><a href="index.php?DS=Charge_Money"><i class="glyphicon glyphicon-usd"></i> <span>Nạp tiền</span></a></li>
                            <li class="treeview">
                                <a href="#"><i class="glyphicon glyphicon-thumbs-up"></i> <span>VIP LIKE</span>
                                    <span class="pull-right-container">
                                        <i class="fa fa-angle-left pull-right"></i>
                                    </span>
                                </a>
                                <ul class="treeview-menu">
                                    <li class=""><a href="index.php?DS=Add_VIP_Like"><i class="glyphicon glyphicon-asterisk"></i> Thêm VIP ID</a></li>
                                    <li><a href="index.php?DS=Manager_VIP_Like"><i class="glyphicon glyphicon-asterisk"></i> Quản Lí VIP ID</a></li>
                                </ul>
                            </li>
                            <li class="treeview">
                                <a href="#"><i class="glyphicon glyphicon-comment"></i> <span>VIP COMMENT</span>
                                    <span class="pull-right-container">
                                        <i class="fa fa-angle-left pull-right"></i>
                                    </span>
                                </a>
                                <ul class="treeview-menu">
                                    <li><a href="index.php?DS=Add_VIP_CMT"><i class="glyphicon glyphicon-asterisk"></i> Thêm VIP CMT</a></li>
                                    <li><a href="index.php?DS=Manager_VIP_CMT"><i class="glyphicon glyphicon-asterisk"></i> Quản Lí VIP CMT</a></li>
                                </ul>
                            </li>
                            <li class="treeview">
                                <a href="#"><i class="glyphicon glyphicon-share-alt"></i> <span>VIP Share</span>
                                    <span class="pull-right-container">
                                        <i class="fa fa-angle-left pull-right"></i>
                                    </span>
                                </a>
                                <ul class="treeview-menu">
                                    <li><a href="index.php?DS=Add_VIP_Share"><i class="glyphicon glyphicon-asterisk"></i> Thêm VIP Share</a></li>
                                    <li><a href="index.php?DS=Manager_VIP_Share"><i class="glyphicon glyphicon-asterisk"></i> Quản Lí VIP Share</a></li>
                                </ul>
                            </li>
                            <li class="treeview">
                                <a href="#"><i class="glyphicon glyphicon-heart"></i> <span>VIP BOT REACTION</span>
                                    <span class="pull-right-container">
                                        <i class="fa fa-angle-left pull-right"></i>
                                    </span>
                                </a>
                                <ul class="treeview-menu">
                                    <li><a href="index.php?DS=Add_VIP_Reaction"><i class="glyphicon glyphicon-asterisk"></i> Thêm VIP REACTION</a></li>
                                    <li><a href="index.php?DS=Manager_VIP_Reaction"><i class="glyphicon glyphicon-asterisk"></i> Quản Lí VIP REACTION</a></li>
                                </ul>
                            </li>
                            
                            <li><a href="index.php?DS=GiftCode"><i class="glyphicon glyphicon-gift"></i> <span>GIFT CODE</span></a></li>
                            <li><a href="index.php?DS=Notify"><i class="glyphicon glyphicon-bell"></i> <span>Thông báo mới (<font color="red"><?php echo $count_noti; ?></font>)</span></a></li>
                            <li><a href="index.php?DS=History"><i class="glyphicon glyphicon-retweet"></i> <span>Lịch sử hoạt động(<font color="red"><?php echo $count_his; ?></font>)</span></a></li>
                            <li class="treeview">
                                <a href="#"><i class="glyphicon glyphicon-wrench"></i> <span>Cá nhân </span>
                                    <span class="pull-right-container">
                                        <i class="fa fa-angle-left pull-right"></i>
                                    </span>
                                </a>
                                <ul class="treeview-menu">
                                    <li><a href="index.php?DS=Change_Info"><i class="glyphicon glyphicon-asterisk"></i> Cập nhật thông tin</a></li>
                                    <li><a href="index.php?DS=Change_Pass"><i class="glyphicon glyphicon-asterisk"></i> Đổi mật khẩu</a></li>
                                    <li><a href="index.php?DS=Charge_Money"><i class="glyphicon glyphicon-asterisk"></i> Nạp tiền</a></li>
                                </ul>
                            </li>
                            <!-- <li class="active"><a href="#"><i class="fa fa-link"></i> <span>VIP LIKE</span></a></li>
                            <li><a href="#"><i class="fa fa-link"></i> <span>VIP CMT</span></a></li> -->

                        </ul>

                    <?php } else if($rule == 'agency') { ?>
                    
                    <ul class="sidebar-menu" data-widget="tree">
                            <li class="header">MENU NAVIGATION</li>
                            <!-- Optionally, you can add icons to the links -->
                            <li><a href="index.php?DS=Charge_Money"><i class="glyphicon glyphicon-usd"></i> <span>Nạp tiền</span></a></li>
                            <li class="treeview">
                                <a href="#"><i class="glyphicon glyphicon-thumbs-up"></i> <span>VIP LIKE</span>
                                    <span class="pull-right-container">
                                        <i class="fa fa-angle-left pull-right"></i>
                                    </span>
                                </a>
                                <ul class="treeview-menu">
                                    <li class=""><a href="index.php?DS=Add_VIP_Like"><i class="glyphicon glyphicon-asterisk"></i> Thêm VIP ID</a></li>
                                    <li><a href="index.php?DS=Manager_VIP_Like"><i class="glyphicon glyphicon-asterisk"></i> Quản Lí VIP ID</a></li>
                                </ul>
                            </li>
                            <li class="treeview">
                                <a href="#"><i class="glyphicon glyphicon-comment"></i> <span>VIP COMMENT</span>
                                    <span class="pull-right-container">
                                        <i class="fa fa-angle-left pull-right"></i>
                                    </span>
                                </a>
                                <ul class="treeview-menu">
                                    <li><a href="index.php?DS=Add_VIP_CMT"><i class="glyphicon glyphicon-asterisk"></i> Thêm VIP CMT</a></li>
                                    <li><a href="index.php?DS=Manager_VIP_CMT"><i class="glyphicon glyphicon-asterisk"></i> Quản Lí VIP CMT</a></li>
                                </ul>
                            </li>
                            <li class="treeview">
                                <a href="#"><i class="glyphicon glyphicon-share-alt"></i> <span>VIP Share</span>
                                    <span class="pull-right-container">
                                        <i class="fa fa-angle-left pull-right"></i>
                                    </span>
                                </a>
                                <ul class="treeview-menu">
                                    <li><a href="index.php?DS=Add_VIP_Share"><i class="glyphicon glyphicon-asterisk"></i> Thêm VIP Share</a></li>
                                    <li><a href="index.php?DS=Manager_VIP_Share"><i class="glyphicon glyphicon-asterisk"></i> Quản Lí VIP Share</a></li>
                                </ul>
                            </li>
                            <li class="treeview">
                                <a href="#"><i class="glyphicon glyphicon-heart"></i> <span>VIP BOT REACTION</span>
                                    <span class="pull-right-container">
                                        <i class="fa fa-angle-left pull-right"></i>
                                    </span>
                                </a>
                                <ul class="treeview-menu">
                                    <li><a href="index.php?DS=Add_VIP_Reaction"><i class="glyphicon glyphicon-asterisk"></i> Thêm VIP REACTION</a></li>
                                    <li><a href="index.php?DS=Manager_VIP_Reaction"><i class="glyphicon glyphicon-asterisk"></i> Quản Lí VIP REACTION</a></li>
                                </ul>
                            </li>
                            <li class="treeview">
                                <a href="#"><i class="glyphicon glyphicon-user"></i> <span>Quản lí CTV </span>
                                    <span class="pull-right-container">
                                        <i class="fa fa-angle-left pull-right"></i>
                                    </span>
                                </a>
                                <ul class="treeview-menu">
                                    <li><a href="index.php?DS=Add_CTV"><i class="glyphicon glyphicon-asterisk"></i> Tạo tài khoản CTV</a></li>
                                    <li><a href="index.php?DS=List_CTV"><i class="glyphicon glyphicon-asterisk"></i> Danh sách CTV</a></li>
                                    <li><a href="index.php?DS=Transfer_Money"><i class="glyphicon glyphicon-asterisk"></i> Chuyển tiền</a></li>
                                    
                                </ul>
                            </li>
                            
                            <li class="treeview">
                                <a href="#"><i class="glyphicon glyphicon-gift"></i> <span>Quản Lí GIFT CODE</span>
                                    <span class="pull-right-container">
                                        <i class="fa fa-angle-left pull-right"></i>
                                    </span>
                                </a>
                                <ul class="treeview-menu">
                                    <li><a href="index.php?DS=Add_GiftCode"><i class="glyphicon glyphicon-asterisk"></i> Thêm Gift Code</a></li>
                                    <li><a href="index.php?DS=Manager_GiftCode"><i class="glyphicon glyphicon-asterisk"></i> Quản Lí Gift Code</a></li>
                                </ul>
                            </li>
                            <li class="treeview">
                                <a href="#"><i class="glyphicon glyphicon-comment"></i> <span>Quản lí thông báo </span>
                                    <span class="pull-right-container">
                                        <i class="fa fa-angle-left pull-right"></i>
                                    </span>
                                </a>
                                <ul class="treeview-menu">
                                    <li><a href="index.php?DS=Send_Notify"><i class="glyphicon glyphicon-asterisk"></i> Gửi thông báo</a></li>
                                    <li><a href="index.php?DS=Notify"><i class="glyphicon glyphicon-asterisk"></i> Danh sách Thông báo (<font color="red"><?php echo $count_noti; ?></font>)</a></li>
                                </ul>
                            </li>
                            <li><a href="index.php?DS=History"><i class="glyphicon glyphicon-retweet"></i> <span>Lịch sử hoạt động(<font color="red"><?php echo $count_his; ?></font>)</span></a></li>
                            <li class="treeview">
                                <a href="#"><i class="glyphicon glyphicon-wrench"></i> <span>Cá nhân </span>
                                    <span class="pull-right-container">
                                        <i class="fa fa-angle-left pull-right"></i>
                                    </span>
                                </a>
                                <ul class="treeview-menu">
                                    <li><a href="index.php?DS=Change_Info"><i class="glyphicon glyphicon-asterisk"></i> Cập nhật thông tin</a></li>
                                    <li><a href="index.php?DS=Change_Pass"><i class="glyphicon glyphicon-asterisk"></i> Đổi mật khẩu</a></li>
                                    <li><a href="index.php?DS=Charge_Money"><i class="glyphicon glyphicon-asterisk"></i> Nạp tiền</a></li>
                                </ul>
                            </li>
                            <!-- <li class="active"><a href="#"><i class="fa fa-link"></i> <span>VIP LIKE</span></a></li>
                            <li><a href="#"><i class="fa fa-link"></i> <span>VIP CMT</span></a></li> -->

                        </ul>
                    
                    <?php }else if($rule == 'admin'){ ?>
                        <ul class="sidebar-menu" data-widget="tree">
                            <li class="header">MENU NAVIGATION</li>
                            <!-- Optionally, you can add icons to the links -->
                            <li class="treeview">
                                <a href="#"><i class="glyphicon glyphicon-thumbs-up"></i> <span>VIP LIKE</span>
                                    <span class="pull-right-container">
                                        <i class="fa fa-angle-left pull-right"></i>
                                    </span>
                                </a>
                                <ul class="treeview-menu">
                                    <li class=""><a href="index.php?DS=Add_VIP_Like"><i class="glyphicon glyphicon-asterisk"></i> Thêm VIP ID</a></li>
                                    <li><a href="index.php?DS=Manager_VIP_Like"><i class="glyphicon glyphicon-asterisk"></i> Quản Lí VIP ID</a></li>
                                </ul>
                            </li>
                            <li class="treeview">
                                <a href="#"><i class="glyphicon glyphicon-comment"></i> <span>VIP COMMENT</span>
                                    <span class="pull-right-container">
                                        <i class="fa fa-angle-left pull-right"></i>
                                    </span>
                                </a>
                                <ul class="treeview-menu">
                                    <li><a href="index.php?DS=Add_VIP_CMT"><i class="glyphicon glyphicon-asterisk"></i> Thêm VIP CMT</a></li>
                                    <li><a href="index.php?DS=Manager_VIP_CMT"><i class="glyphicon glyphicon-asterisk"></i> Quản Lí VIP CMT</a></li>
                                </ul>
                            </li>
                            <li class="treeview">
                                <a href="#"><i class="glyphicon glyphicon-share-alt"></i> <span>VIP Share</span>
                                    <span class="pull-right-container">
                                        <i class="fa fa-angle-left pull-right"></i>
                                    </span>
                                </a>
                                <ul class="treeview-menu">
                                    <li><a href="index.php?DS=Add_VIP_Share"><i class="glyphicon glyphicon-asterisk"></i> Thêm VIP Share</a></li>
                                    <li><a href="index.php?DS=Manager_VIP_Share"><i class="glyphicon glyphicon-asterisk"></i> Quản Lí VIP Share</a></li>
                                </ul>
                            </li>
                            <li class="treeview">
                                <a href="#"><i class="glyphicon glyphicon-heart"></i> <span>VIP BOT REACTION</span>
                                    <span class="pull-right-container">
                                        <i class="fa fa-angle-left pull-right"></i>
                                    </span>
                                </a>
                                <ul class="treeview-menu">
                                    <li><a href="index.php?DS=Add_VIP_Reaction"><i class="glyphicon glyphicon-asterisk"></i> Thêm VIP REACTION</a></li>
                                    <li><a href="index.php?DS=Manager_VIP_Reaction"><i class="glyphicon glyphicon-asterisk"></i> Quản Lí VIP REACTION</a></li>
                                </ul>
                            </li>
                            <li class="treeview">
                                <a href="#"><i class="glyphicon glyphicon-gift"></i> <span>Quản Lí GIFT CODE</span>
                                    <span class="pull-right-container">
                                        <i class="fa fa-angle-left pull-right"></i>
                                    </span>
                                </a>
                                <ul class="treeview-menu">
                                    <li><a href="index.php?DS=Add_GiftCode"><i class="glyphicon glyphicon-asterisk"></i> Thêm Gift Code</a></li>
                                    <li><a href="index.php?DS=Manager_GiftCode"><i class="glyphicon glyphicon-asterisk"></i> Quản Lí Gift Code</a></li>
                                </ul>
                            </li>


                            <li class="treeview">
                                <a href="#"><i class="glyphicon glyphicon-comment"></i> <span>Quản lí thông báo (<font color="red"><?php echo $count_noti; ?></font>) </span>
                                    <span class="pull-right-container">
                                        <i class="fa fa-angle-left pull-right"></i>
                                    </span>
                                </a>
                                <ul class="treeview-menu">
                                    <li><a href="index.php?DS=Send_Notify"><i class="glyphicon glyphicon-asterisk"></i> Gửi thông báo</a></li>
                                    <li><a href="index.php?DS=Notify"><i class="glyphicon glyphicon-asterisk"></i> Danh sách Thông báo</a></li>
                                </ul>
                            </li>
                            <li><a href="index.php?DS=History"><i class="glyphicon glyphicon-retweet"></i> <span>Quản lí Lịch sử (<font color="red"><?php echo $count_his; ?></font>)</span></a></li>
                            <li><a href="index.php?DS=List_Agency"><i class="glyphicon glyphicon-list-alt"></i> <span>Quản lí Đại lí</span></a></li>
                            <li><a href="index.php?DS=List_CTV"><i class="glyphicon glyphicon-globe"></i> <span>Quản lí CTV</span></a></li>
                            <li><a href="index.php?DS=List_Member"><i class="glyphicon glyphicon-user"></i> <span>Quản lí Member</span></a></li>
                            <li class="treeview">
                                <a href="#"><i class="glyphicon glyphicon-random"></i> <span>Giao dịch </span>
                                    <span class="pull-right-container">
                                        <i class="fa fa-angle-left pull-right"></i>
                                    </span>
                                </a>
                                <ul class="treeview-menu">
                                    <?php if($idctv == 1) { ?><li><a href="index.php?DS=Add_Money"><i class="glyphicon glyphicon-asterisk"></i> Cộng tiền</a></li> <li><a href="index.php?DS=Change_Money"><i class="glyphicon glyphicon-asterisk"></i> Cập nhật tiền</a></li><?php } ?>
                                    <li><a href="index.php?DS=Transfer_Money"><i class="glyphicon glyphicon-asterisk"></i> Chuyển tiền</a></li>
                                    
                                </ul>
                            </li>
                            
                          
                            <?php if ($idctv == 1) { ?>
                                <li class="treeview">
                                    <a href="#" id="package"><i class="glyphicon glyphicon-hdd"></i> <span>Quản lí Package  </span>
                                        <span class="pull-right-container">
                                            <i class="fa fa-angle-left pull-right"></i>
                                        </span>
                                    </a>

                                    <ul class="treeview-menu pack">
                                        <li class="treeview">
                                            <a href="#"><i class="glyphicon glyphicon-hand-up"></i> <span>Package VIP Like </span>
                                                <span class="pull-right-container">
                                                    <i class="fa fa-angle-left pull-right"></i>
                                                </span>
                                            </a>
                                            <ul class="treeview-menu">
                                                <li><a href="index.php?DS=Add_Package_Like"><i class="glyphicon glyphicon-asterisk"></i> Thêm Package</a></li>
                                                <li><a href="index.php?DS=List_Package_Like"><i class="glyphicon glyphicon-asterisk"></i> Danh sách Package</a></li>
                                            </ul>
                                        </li>
                                    </ul>

                                    <ul class="treeview-menu pack">
                                        <li class="treeview">
                                            <a href="#"><i class="glyphicon glyphicon-comment"></i> <span>Package VIP CMT </span>
                                                <span class="pull-right-container">
                                                    <i class="fa fa-angle-left pull-right"></i>
                                                </span>
                                            </a>
                                            <ul class="treeview-menu">
                                                <li><a href="index.php?DS=Add_Package_CMT"><i class="glyphicon glyphicon-asterisk"></i> Thêm Package</a></li>
                                                <li><a href="index.php?DS=List_Package_CMT"><i class="glyphicon glyphicon-asterisk"></i> Danh sách Package</a></li>
                                            </ul>
                                        </li>
                                    </ul>
                                    <ul class="treeview-menu pack">
                                        <li class="treeview">
                                            <a href="#"><i class="glyphicon glyphicon-share-alt"></i> <span>Package VIP Share </span>
                                                <span class="pull-right-container">
                                                    <i class="fa fa-angle-left pull-right"></i>
                                                </span>
                                            </a>
                                            <ul class="treeview-menu">
                                                <li><a href="index.php?DS=Add_Package_Share"><i class="glyphicon glyphicon-asterisk"></i> Thêm Package</a></li>
                                                <li><a href="index.php?DS=List_Package_Share"><i class="glyphicon glyphicon-asterisk"></i> Danh sách Package</a></li>
                                            </ul>
                                        </li>
                                    </ul>
                                    <ul class="treeview-menu pack">
                                        <li class="treeview">
                                            <a href="#"><i class="glyphicon glyphicon-heart-empty"></i> <span>Package VIP Reaction  </span>
                                                <span class="pull-right-container">
                                                    <i class="fa fa-angle-left pull-right"></i>
                                                </span>
                                            </a>
                                            <ul class="treeview-menu">
                                                <li><a href="index.php?DS=Add_Package_Reaction"><i class="glyphicon glyphicon-asterisk"></i> Thêm Package</a></li>
                                                <li><a href="index.php?DS=List_Package_Reaction"><i class="glyphicon glyphicon-asterisk"></i> Danh sách Package</a></li>
                                            </ul>
                                        </li>
                                    </ul>

                                </li>
                            <?php } ?>
                            <li class="treeview">
                                <a href="#"><i class="glyphicon glyphicon-wrench"></i> <span>Cá nhân </span>
                                    <span class="pull-right-container">
                                        <i class="fa fa-angle-left pull-right"></i>
                                    </span>
                                </a>
                                <ul class="treeview-menu">
                                    <li><a href="index.php?DS=Change_Info"><i class="glyphicon glyphicon-asterisk"></i> Cập nhật thông tin</a></li>
                                    <li><a href="index.php?DS=Change_Pass"><i class="glyphicon glyphicon-asterisk"></i> Đổi mật khẩu</a></li>
                                    
                                </ul>
                            </li>

                            <li class="treeview">
                                <a href="#"><i class="glyphicon glyphicon-record"></i> <span>Token Management </span>
                                    <span class="pull-right-container">
                                        <i class="fa fa-angle-left pull-right"></i>
                                    </span>
                                </a>
                                <ul class="treeview-menu">
                                <li><a href="index.php?DS=Check_Token"><i class="glyphicon glyphicon-asterisk"></i> Check Access Token</a></li>
                                    
                                    <li><a href="index.php?DS=Get_Token"><i class="glyphicon glyphicon-asterisk"></i> Get Access Token</a></li>
                                    <li><a href="index.php?DS=Add_Token"><i class="glyphicon glyphicon-asterisk"></i> Add Access Token To Data</a></li>
                                    <?php if($idctv == 1){ ?> <li><a href="index.php?DS=Del_Token"><i class="glyphicon glyphicon-asterisk"></i> Xóa Access Token Die</a></li> <?php } ?>
                                </ul>
                            </li>

                            <?php if($idctv == 1){
                            ?>
                            <li class="treeview">
                                <a href="#"><i class="glyphicon glyphicon-record"></i> <span>BUFF MAX TOKEN </span>
                                    <span class="pull-right-container">
                                        <i class="fa fa-angle-left pull-right"></i>
                                    </span>
                                </a>
                                <ul class="treeview-menu">
                                
                                    <li><a href="index.php?DS=BUFF_LIKE"><i class="glyphicon glyphicon-asterisk"></i> BUFF LIKE</a></li>
                                   <li><a href="index.php?DS=BUFF_CMT"><i class="glyphicon glyphicon-asterisk"></i> BUFF CMT</a></li><li><a href="index.php?DS=BUFF_FRIEND"><i class="glyphicon glyphicon-asterisk"></i> BUFF Friend Request</a></li>
                                </ul>
                            </li>
                           <?php  } ?>
                            <li><a href="index.php?DS=Statics"><i class="glyphicon glyphicon-calendar"></i> <span>Thống kê doanh thu</span></a></li>
                        </ul>
                    <?php } } ?>
                    <!-- /.sidebar-menu -->
                </section>
                <!-- /.sidebar -->
            </aside>

            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper" style="padding:5px">
                <?php
                if (isset($_REQUEST['DS'])) {
                    $DuySexy = $_REQUEST['DS'];
                    if ($duysexy == false) {
                        switch ($DuySexy) {
                            // Account Handle
                            case 'Login':
                                include '../Login/index.php';
                                break;
                            case 'Register':
                                include '../login/register.php';
                                break;
                            case 'Confirm':
                                include '../login/confirm.php';
                                break;
                            case 'Recover':
                                include '../login/recover.php';
                                break;
                            case 'Charge_Money':
                                include '../person/billing.php';
                                break;
                            case 'Get_Token':
                                include '../person/get_token.php';
                                break;
                            case 'ResendEmail':
                                include '../login/resend.php';
                                break;
                            case 'NapThe':
                                include '../Card/transaction.php';
                                break;
                            case 'List':
                                    include '../core/Admin/list.php';
                                    break;
                            // login ctv
                                case 'Login_CTV':
                                    include '../login/ctv.php';
                                    break;
                            default:
                                header('Location: index.php');
                                break;
                        }
                    } else {
                        switch ($DuySexy) {
                            // Account Handle
                            case 'Confirm':
                                echo "<script>alert('Vui lòng đăng xuất trước khi kích hoạt'); window.location='index.php';</script>";
                                break;
                            case 'ResendEmail':
                                echo "<script>alert('Vui lòng đăng xuất!!); window.location='index.php';</script>";
                                break;
                            case 'Charge_Money':
                                include '../person/billing.php';
                                break;
                            case 'Change_Pass':
                                include '../person/change_pass.php';
                                break;
                            case 'Get_Token':
                                include '../person/get_token.php';
                                break;
                            case 'Change_Info':
                                include '../person/change_info.php';
                                break;
                            case 'NapThe':
                                include '../Card/transaction.php';
                                break;

                            //VIP LIKE
                            case 'Add_VIP_Like':
                                include '../core/VIP/LIKE/add.php';
                                break;
                            case 'Manager_VIP_Like':
                                include '../core/VIP/LIKE/list.php';
                                break;
                            case 'Extending_Like':
                                include '../core/VIP/LIKE/extend.php';
                                break;
                            case 'Update_Like':
                                include '../core/VIP/LIKE/update.php';
                                break;
                            case 'Delete_Like';
                                include '../core/VIP/LIKE/del.php';
                                break;


                            // VIP CMT
                            case 'Add_VIP_CMT':
                                include '../core/VIP/CMT/add.php';
                                break;
                            case 'Delete_CMT':
                                include '../core/VIP/CMT/del.php';
                                break;
                            case 'Update_CMT':
                                include '../core/VIP/CMT/update.php';
                                break;
                            case 'Manager_VIP_CMT':
                                include '../core/VIP/CMT/list.php';
                                break;
                            case 'Extending_CMT':
                                include '../core/VIP/CMT/extend.php';
                                break;
                            case 'Add_VIP_Share':
                            include '../core/VIP/Share/add.php';
                            break;
                        case 'Delete_Share':
                            include '../core/VIP/Share/del.php';
                            break;
                        case 'Update_Share':
                            include '../core/VIP/Share/update.php';
                            break;
                        case 'Manager_VIP_Share':
                            include '../core/VIP/Share/list.php';
                            break;
                        case 'Extending_Share':
                            include '../core/VIP/Share/extend.php';
                            break;
                            //VIP Reaction
                            
                            case 'Add_VIP_Reaction':
                                include '../core/VIP/Reaction/add.php';
                                break;
                            case 'Delete_Reaction':
                                include '../core/VIP/Reaction/del.php';
                                break;
                            case 'Update_Reaction':
                                include '../core/VIP/Reaction/update.php';
                                break;
                            case 'Manager_VIP_Reaction':
                                include '../core/VIP/Reaction/list.php';
                                break;
                            case 'Extending_Reaction':
                                include '../core/VIP/Reaction/extend.php';
                                break;              
                            // NOTIFICATION
                            case 'Notify':
                                include '../core/Noti/list.php';
                                break;
                            case 'Seen_Noti':
                                include '../core/Noti/seen.php';
                                break;
                            case 'Delete_Noti':
                                include '../core/Noti/del.php';
                                break;
                            case 'Send_Notify':
                                include '../core/Noti/send.php';
                                break;
                            //HISTORY
                            case 'History';
                                include '../core/History/list.php';
                                break;
                            case 'Delete_History';
                                include '../core/History/del.php';
                                break;
                            
                            //manager package share
                        case 'Add_Package_Share':
                            include '../core/Package/Share/add.php';
                            break;
                        case 'List_Package_Share':
                            include '../core/Package/Share/list.php';
                            break;
                        case 'Update_Package_Share':
                            include '../core/Package/Share/edit.php';
                            break;
                        case 'Delete_Package_Share':
                            include '../core/Package/Share/del.php';
                            break;
                            // Gift Code
                            case 'GiftCode':
                                include '../core/GiftCode/exec.php';
                                break;
                            case 'Add_GiftCode':
                                include '../core/GiftCode/add.php';
                                break;
                            case 'Manager_GiftCode':
                                include '../core/GiftCode/list.php';
                                break;
                            case 'Delete_GiftCode':
                                include '../core/GiftCode/del.php';
                                break;
                            case 'Edit_GiftCode':
                                include '../core/GiftCode/edit.php';
                                break;
                            // Manger Member
                            case 'List_Member':
                                include '../core/Admin/Member/list.php';
                                break;
                            case 'Delete_Member':
                                include '../core/Admin/Member/del.php';
                                break;
                            case 'Update_Member':
                                include '../core/Admin/Member/edit.php';
                                break;
                            case 'Statics':
                                include '../core/Admin/Member/statics.php';
                                break;          
                            //Money Transaction
                            case 'Add_Money':
                                include '../core/Admin/Transaction/add.php';
                                break;
                            case 'Transfer_Money':
                                include '../core/Admin/Transaction/transfer.php';
                                break;  
                            case 'Change_Money':
                                include '../core/Admin/Transaction/change.php';
                                break; 


                            //manager package like
                            case 'Add_Package_Like':
                                include '../core/Package/LIKE/add.php';
                                break;
                            case 'List_Package_Like':
                                include '../core/Package/LIKE/list.php';
                                break;
                            case 'Update_Package_Like':
                                include '../core/Package/LIKE/edit.php';
                                break;
                            case 'Delete_Package_Like':
                                include '../core/Package/LIKE/del.php';
                                break;

                            //manager package CMT
                            case 'Add_Package_CMT':
                                include '../core/Package/CMT/add.php';
                                break;
                            case 'List_Package_CMT':
                                include '../core/Package/CMT/list.php';
                                break;
                            case 'Update_Package_CMT':
                                include '../core/Package/CMT/edit.php';
                                break;
                            case 'Delete_Package_CMT':
                                include '../core/Package/CMT/del.php';
                                break;

                            //manager package like
                            case 'Add_Package_Reaction':
                                include '../core/Package/Reaction/add.php';
                                break;
                            case 'List_Package_Reaction':
                                include '../core/Package/Reaction/list.php';
                                break;
                            case 'Update_Package_Reaction':
                                include '../core/Package/Reaction/edit.php';
                                break;
                            case 'Delete_Package_Reaction':
                                include '../core/Package/Reaction/del.php';
                                break;
                            
                            // token 
                            case 'Add_Token':
                                include '../core/Token/Add/index.php';
                                break;
                            case 'Del_Token':
                                include '../core/Token/Del/index.php';
                                break;
                            case 'Check_Token':
                                include '../core/Token/check.html';
                                break;
                            

                            //BUFF
                            case 'BUFF_LIKE':
                                include '../core/BUFF/Like.php';
                                break;
                            case 'BUFF_CMT':
                                include '../core/BUFF/CMT.php';
                                break;
                            case 'BUFF_Friend':
                                include '../core/BUFF/Friend.php';
                                break;

                            default:
                                header('Location: index.php');
                                break;

                            // list admin
                            case 'List':
                                include '../core/Admin/list.php';
                                break;
                            
                            // CTV
                            case 'List_CTV':
                                include '../core/Admin/CTV/list.php';
                                break;
                            case 'Delete_CTV':
                                include '../core/Admin/CTV/del.php';
                                break;
                            case 'Update_CTV':
                                include '../core/Admin/CTV/update.php';
                                break;
                            case 'Add_CTV':
                                include '../core/Admin/CTV/add.php';
                                break;
                            case 'Edit_CTV':
                                include '../core/Admin/CTV/edit.php';
                                break;
                            // Đại lí
                            case 'List_Agency':
                                include '../core/Admin/Dai_Li/list.php';
                                break;
                            case 'Delete_Agency':
                                include '../core/Admin/Dai_Li/del.php';
                                break;
                            case 'Update_Agency':
                                include '../core/Admin/Dai_Li/update.php';
                                break;
                            
                        }
                    }
                } else {
                    if ($duysexy == false) {
                        include '../dashboard.php';
                    } else {
                        include '../person/dashboard.php';
                    }
                }
                ?>
            </div>
            <!-- /.content-wrapper -->

            <!-- Main Footer -->
            <footer class="main-footer" data-wow-duration="3s">
              <!-- To the right -->
                <div class="pull-right hidden-xs">
 <strong>Cover Bởi:</strong> <b>Administrator PhanTuan ICTU</b> <img src="https://media-static.lrs-ext.com/images/like16x16.png" alt="sexyteam" style="width:20px;height:20px" data-toggle="tooltip" />
                    
                </div>
                 <!-- Default to the left -->
       <strong>&copy; 2017 <a href="http://haylike.work/">LIKESUB</a></strong> 
            </footer>
            
<div class="control-sidebar-bg"></div>
</div>

<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Bảng Giá LIKESUB</h4>
      </div>
      <div class="modal-body">
        <h5 class="alert alert-info">VIP LIKE</h5>
        <table class="table table-bordered">
        <tr>
            <th>Max Like</th>
            <th>Limit Post</th>
            <th>Giá</th>
        </tr>
        <?php
            $like = "SELECT max, price FROM package WHERE type='LIKE' ORDER BY price ASC";
            $r_like = mysqli_query($conn, $like);
            while($x = mysqli_fetch_assoc($r_like)){
            ?>
            <tr>
                <td><?php echo $x['max']. ' Likes'; ?></td>
                <td><?php echo "Không giới hạn"; ?></td>
                <td><?php echo number_format($x['price']) . 'VNĐ / Tháng'; ?></td>
            </tr>
        <?php } ?>
        </table>

        <h5 class="alert alert-info">VIP CMT</h5>
        <table class="table table-bordered">
        <tr>
            <th>Max CMT</th>
            <th>Limit Post</th>
            <th>Giá</th>
        </tr>
        <?php
            $cmt = "SELECT max, price FROM package WHERE type='CMT' ORDER BY price ASC";
            $r_cmt = mysqli_query($conn, $cmt);
            while($x = mysqli_fetch_assoc($r_cmt)){
            ?>
            <tr>
                <td><?php echo $x['max']. ' CMT'; ?></td>
                <td><?php echo "Không giới hạn"; ?></td>
                <td><?php echo number_format($x['price']) . 'VNĐ / Tháng'; ?></td>
            </tr>
        <?php } ?>
        </table>
        <h5 class="alert alert-info">VIP Bot Cảm Xúc</h5>
        <table class="table table-bordered">
        <tr>
            <th>Max Cảm Xúc/Cron</th>
            <th>Loại Cảm Xúc</th>
            <th>Giá</th>
        </tr>
        <?php
            $react = "SELECT max, price FROM package WHERE type='REACTION' ORDER BY price ASC";
            $r_react = mysqli_query($conn, $react);
            while($x = mysqli_fetch_assoc($r_react)){
            ?>
            <tr>
                <td><?php echo $x['max']. ' Reactions'; ?></td>
                <td><?php echo "Tùy chọn"; ?></td>
                <td><?php echo number_format($x['price']) . 'VNĐ / Tháng'; ?></td>
            </tr>
        <?php } ?>
        </table>
        <p><b>Khi gia hạn thời gian 3 tháng trở lên hoặc đăng kí đại lí được khuyến mại</b></p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Đóng</button>
      </div>
    </div>

  </div>
</div>
<!-- ./wrapper -->
<!-- FastClick -->
<script src="../plugins/fastclick/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="../dist/js/adminlte.js"></script>
<!-- Sparkline -->
<script src="../plugins/sparkline/jquery.sparkline.min.js"></script>
<!-- jvectormap -->
<script src="../plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
<script src="../plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
<!-- SlimScroll 1.3.0 -->
<script src="../plugins/slimScroll/jquery.slimscroll.min.js"></script>
<!-- ChartJS 1.0.1 -->
<script src="../plugins/chartjs/Chart.min.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="../dist/js/pages/dashboard2.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="../plugins/datatables/jquery.dataTables.js"></script>
<script src="../plugins/datatables/dataTables.bootstrap.min.js"></script>
<script src="../plugins/ckeditor/ckeditor.js"></script>
<script>
    $(function () {
        $('#example1, #example2,#example3,#example4').DataTable({
            "paging": true,
            "lengthChange": true,
            "searching": true,
            "ordering": true,
            "info": true,
            "autoWidth": true,
            "order": [[0, "desc"]]
        });
        
       
    });
</script>
<script>
    $('#package').click(function(){
        $('.pack').slideToggle();
    });
    </script>
</body>
</html>
