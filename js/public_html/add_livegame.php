<?php session_start();
    if(isset($_SESSION['uid']))
    {
        header('location: index.php');
    }
 ?>
<!DOCTYPE html>
<html>
<head>
    <title>livegame</title>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="css/add_livegame.css">
    <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css">
    <script type="text/javascript" src="js/add_livegame.js"></script>

<!-- Optional theme -->
<link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap-theme.min.css">

<!-- Latest compiled and minified JavaScript -->
<script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
<script type="text/javascript" src="js/jquery1.js"></script>
    <script type="text/javascript" src="js/jquery.js"></script>
    <script type="text/javascript" src="js/wowslider.js"></script>
    <script type="text/javascript" src="js/script.js"></script>
    <script type="text/javascript" src="js/bootstrap.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" media="all">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css" rel="stylesheet" media="all">
</head>
    <body>
          <div class="container">
    <div class="row">
        <div class="col-md-12">
            <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
                <ol class="carousel-indicators">
                    <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
                    <li data-target="#carousel-example-generic" data-slide-to="1"></li>
                    <li data-target="#carousel-example-generic" data-slide-to="2"></li>
                </ol>
                <div class="carousel-inner">
                    <div class="item active">
                        <iframe width="1200" height="500" src="https://www.youtube.com/embed/DWPA2N6VbTA?rel=0&autoplay=1" frameborder="0" allowfullscreen></iframe>
                        <div class="carousel-caption">
                            <h3>
                                Live game</h3>
                            <p>
                               Call of Duty: Advanced Warfare Game Movie (All Cutscenes) 1080p HD</p>
                        </div>
                    </div>
                    <div class="item">
                       <iframe width="1200" height="500" src="https://www.youtube.com/embed/fjRWcXpZKr8" frameborder="0" allowfullscreen></iframe>
                        <div class="carousel-caption">
                            <h3>
                                Live game</h3>
                            <p>
                                [30.04.2017] GAM vs ISG [MSI 2017][Play-in]</p>
                        </div>
                    </div>
                    <div class="item">
                        <iframe width="1200" height="500" src="https://www.youtube.com/embed/jpPRPSwpHDk" frameborder="0" allowfullscreen></iframe>
                        <div class="carousel-caption">
                            <h3>
                                Live game</h3>
                            <p>
                                [01.04.2017] VietNam vs Korea [The Intercontinentals 2017]</p>
                        </div>
                    </div>
                </div>
                <a class="left carousel-control" href="#carousel-example-generic" data-slide="prev">
                    <span class="glyphicon glyphicon-chevron-left"></span></a><a class="right carousel-control"
                        href="#carousel-example-generic" data-slide="next"><span class="glyphicon glyphicon-chevron-right">
                        </span></a>
            </div>
            <div class="main-text hidden-xs">
                <div class="col-md-12 text-center">
                    <h1>
                        Trực tiếp livestream</h1>
                    <h3>
                        Bạn hãy đăng nhập tài khoản để dùng tính năng này
                    </h3>
                    <div class="">
                        <a class="btn btn-clear btn-sm btn-min-block" href="http://www.jquery2dotnet.com/">Login</a><a class="btn btn-clear btn-sm btn-min-block"
                            href="http://www.jquery2dotnet.com/">Liên Hệ admin</a></div>
                </div>
            </div>
        </div>
    </div>
</div>
<div id="push">
</div>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="pr-wrap">
                <div class="pass-reset">
                    <label>
                        Enter the email you signed up with</label>
                    <input type="email" placeholder="Email" />
                    <input type="submit" value="Submit" class="pass-reset-submit btn btn-success btn-sm" />
                </div>
            </div>
            <?php
            include('inc/myconmet.php');
            if($_SERVER['REQUEST_METHOD']=='POST')
            {
                $erorrs=array();
                if(empty($_POST['taikhoan']))
                {
                    $erorrs[]='taikhoan';
                }
                else
                {
                    $taikhoan=$_POST['taikhoan'];
                }
                if(empty($_POST['matkhau']))
                {
                    $erorrs[]='matkhau';
                }
                else
                {
                    $matkhau=md5($_POST['matkhau']);
                }
                if(empty($erorrs))
                {
                    $query="SELECT id,taikhoan,matkhau,startus FROM tbluser WHERE taikhoan='{$taikhoan}' AND matkhau='{$matkhau}' AND startus='1'";
                    $results=mysqli_query($abs,$query) or die("Query={$query} \n<br/> mysqli_error:".mysqli_error($abs));
                    if(mysqli_num_rows($results)==1)
                    {
                        list($id,$taikhoan,$matkhau,$startus)=mysqli_fetch_array($results,MYSQLI_NUM);
                        $_SESSION['uid']=$id;
                        $_SESSION['taikhoan']=$taikhoan;
                        header('location: listvideo.php');
                    }
                    else
                    {
                        $mesage="<p>Tài khoản mật khẩu nhập không đúng</p>";
                    }
                }
            }
        ?>
            <div class="wrap">
                <p class="form-title">
                    Sign In</p>
        <?php
            if(isset($mesage))
            {
                echo $mesage;
            }
        ?>

                <form class="login" method="POST" name="frmlive">
               <input type="text" placeholder="Nhập tài khoản cá nhân" class="form-control"  name="taikhoan" value="<?php if(isset($_POST['taikhoan'])){echo $_POST['taikhoan'];} ?>"><br>
                <?php
                    if(isset($erorrs) && in_array('taikhoan',$erorrs))
                    {
                        echo "<p>Bạn chưa nhập tài khoản</p>";
                    }
                ?>
            </td>
        </tr>
        <tr>
            <td>
                <input type="password" placeholder="Mật khẩu" class="form-control" name="matkhau" value="<?php if(isset($_POST['matkhau'])){echo $_POST['matkhau'];} ?>"><br>
                <?php 
                    if(isset($erorrs) && in_array('matkhau',$erorrs))
                    {
                        echo "<p>Bạn chưa nhập mật khẩu</p>";
                    }
                ?>
            </td>
        </tr>
                <input type="submit" name="submit" value="Sign In" class="btn btn-success btn-sm" />
                <div class="remember-forgot">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" />
                                    Nhớ mật khẩu
                                </label>
                            </div>
                        </div>
                        <div class="col-md-6 forgot-pass-content">
                            <a href="javascription:void(0)" class="forgot-pass">Quên mật khẩu</a>
                        </div>
                    </div>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>

    </body>
</html>