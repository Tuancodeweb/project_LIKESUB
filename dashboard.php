<?php
    $like = "SELECT COUNT(*) FROM autolike";
    $result = mysqli_query($conn, $like);
    $likes = mysqli_fetch_assoc($result)['COUNT(*)'];

    $cmt = "SELECT COUNT(*) FROM autocmt";
    $result5 = mysqli_query($conn, $cmt);
    $cmts = mysqli_fetch_assoc($result5)['COUNT(*)'];

    $memb = "SELECT COUNT(*) FROM member";
    $result1 = mysqli_query($conn, $memb);
    $membs = mysqli_fetch_assoc($result1)['COUNT(*)'];

    $viplike = "SELECT COUNT(*) FROM vip";
    $result2 = mysqli_query($conn, $viplike);
    $viplikes = mysqli_fetch_assoc($result2)['COUNT(*)'];

    $vipcmt = "SELECT COUNT(*) FROM vipcmt";
    $result3 = mysqli_query($conn, $vipcmt);
    $vipcmts = mysqli_fetch_assoc($result3)['COUNT(*)'];

    $vipreaction = "SELECT COUNT(*) FROM vipreaction";
    $result4 = mysqli_query($conn, $vipreaction);
    $vipreactions = mysqli_fetch_assoc($result4)['COUNT(*)'];

    $vipid = $viplikes + $vipcmts + $vipreactions;


?>

<div class="container">
    <div class="row">
    
        <div class="col-md-12">
          <div class="update-nag">
            <div class="update-split"><i class="glyphicon glyphicon-refresh"></i></div>
            <div class="update-text">Admin đang được xây dựng<a href="#">Update Now</a> </div>
          </div>
        </div>
    
        <div class="col-md-12">
          <div class="update-nag">
            <div class="update-split update-info"><i class="glyphicon glyphicon-folder-open"></i></div>
            <div class="update-text">mọi thắc mắc liên hệ vs admin <a href="https://www.facebook.com/tuanphani.c.t">tuanphan</a></div>
          </div>
        </div>

        <div class="col-md-12">
          <div class="update-nag">
            <div class="update-split update-success"><i class="glyphicon glyphicon-leaf"></i></div>
            <div class="update-text">HÃY ĐĂNG NHẬP LẦN 2 ĐỂ XÁC THỰC TÀI KHOẢN<a href="index.php?DS=Login">ĐĂNG NHẬP MỞ TOOL</a></div>
          </div>
        </div>

        <div class="col-md-12">
          <div class="update-nag">
            <div class="update-split update-success"><i class="glyphicon glyphicon-leaf"></i></div>
            <div class="update-text">Hệ thống hỗ trợ trực tuyến hoạt động</div>
          </div>
        </div>
        
        <div class="col-md-12">
          <div class="update-nag">
            <div class="update-split update-danger"><i class="glyphicon glyphicon-warning-sign"></i></div>
            <div class="update-text">WEBSITE đang được update rất mong các bạn thông cảm</div>
          </div>
        </div>
         <div class="col-md-12">
          <div class="update-nag">
            <div class="update-split update-danger"><i class="glyphicon glyphicon-warning-sign"></i></div>
            <div class="update-text">7:00 SA 20/6/2018 bảo trì admin lần 1</div>
          </div>
        </div>
         <div class="col-md-12">
          <div class="update-nag">
            <div class="update-split update-danger"><i class="glyphicon glyphicon-warning-sign"></i></div>
            <div class="update-text">14:00 21/6/2018 bảo trì admin lần 2</div>
          </div>
        </div>
         <div class="col-md-12">
          <div class="update-nag">
            <div class="update-split update-danger"><i class="glyphicon glyphicon-warning-sign"></i></div>
            <div class="update-text">7:00 SA 22/6/2018 bảo trì admin lần 3</div>
          </div>
        </div>
        <div class="col-md-12">
          <div class="update-nag">
            <div class="update-split update-danger"><i class="glyphicon glyphicon-warning-sign"></i></div>
            <div class="update-text">15:02 22/6/2018 bảo trì admin lần 4</div>
          </div>
        </div>
    </div>
</div>
</div>

<script type="text/javascript">window._sbzq||function(t){t._sbzq=[];var e=t._sbzq;e.push(["_setAccount", "achilkhnjuhxjcaq"]);var a=document.createElement("script");a.type="text/javascript",a.async=!0,a.src="https://widgetv4.subiz.com/static/js/app.js";var s=document.getElementsByTagName("script")[0];s.parentNode.insertBefore(a,s)}(window);</script>