<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>recharge</title>
  <link rel="stylesheet" href="css/style.css">

  <link rel="stylesheet" type="text/css" href="Fonts/Pacifico-Regular.ttf">
  <link href="https://fonts.googleapis.com/css?family=Pacifico" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Oleo+Script:400,700" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Teko:400,700" rel="stylesheet">
  <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">

  <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
  <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
  <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<!------ Include the above in your HEAD tag ---------->
 <script src="https://use.fontawesome.com/07b0ce5d10.js"></script>
</head>
  <body>
    <section id="contact">
      <div class="section-content">
        <h1 class="section-header"><span class="content-header wow fadeIn " data-wow-delay="0.2s" data-wow-duration="2s">Info QTV/CTV/MENBER</span></h1>
          <h3>Thông tin về admin , cộng tác viên , thành viên</h3>
      </div>


      <div class="contact-section">
        <div class="container">
          <form  class="form-horizontal form-bk">









<div class="row" style="padding-left:15px; padding-right: 15px">
<div class="alert alert-info wow flash" style="margin-bottom: 0px"><span class="h4">Danh sách Quản trị viên</span></div>
<?php include '../_config.php'; ?>
<?php
$get = "SELECT name, profile FROM member WHERE rule='admin' ORDER BY id_ctv ASC";
$result = mysqli_query($conn, $get);
$i = 1;
while($x = mysqli_fetch_assoc($result)){
  $i += 0.5;
?>
    <div class="col-lg-3 col-sm-6 wow fadeInRight" data-wow-duration="<?php echo $i.'s'; ?>">

            <div class="card hovercard">
                <div class="cardheader">
                  <img src="6.jpg" width="400px;" height="400px;">
                </div>
                <div class="avatar">
                    <img alt="Avatar" src="https://graph.fb.me/<?php echo $x['profile']; ?>/picture">
                </div>
                <div class="info">
                    <div class="title" style="color: black">
                        <?php echo $x['name']; ?>
                    </div>
                    <div class="desc"  style="color: black;">Quản trị viên</div>
                </div>
                <div class="bottom">
                   
                    <a data-toggle="tooltip" title="Click để vào Trang cá nhân của <?php echo $x['name'] ?>" target="_blank" class="btn btn-primary btn-sm" rel="publisher"
                       href="https://fb.com/<?php echo $x['profile']; ?>">
                        <i class="fa fa-facebook"></i>
                    </a>
                    
                </div>
            </div>

        </div>
        <?php } ?>
        </div>
        <div class="row" style="padding-left:15px;padding-right: 15px">
        <div class="alert alert-danger  wow flash"><span class="h4">Danh sách Đại lí</span></div>
        <?php
$get = "SELECT name, profile FROM member WHERE rule='agency' ORDER BY id_ctv ASC";
$result = mysqli_query($conn, $get);
$i = 1;
while($x = mysqli_fetch_assoc($result)){
    $i += 0.5;
?>
        <div class="col-lg-4 col-sm-6 wow fadeInRight" data-wow-duration="<?php echo $i.'s'; ?>">

            <div class="card hovercard">
                <div class="cardheader">
                    <img src="6.jpg" width="400px;" height="400px;">
                </div>
                <div class="avatar">
                    <img alt="Avatar" src="https://graph.fb.me/<?php echo $x['profile']; ?>/picture">
                </div>
                <div class="info">
                    <div class="title" style="color: black">
                        <?php echo $x['name']; ?>
                    </div>
                    <div class="desc"  style="color: black;">Đại lí VIP</div>
                </div>
                <div class="bottom">
                    
                    <a target="_blank" class="btn btn-primary btn-sm" data-toggle="tooltip" title="Click để vào Trang cá nhân của <?php echo $x['name'] ?>" rel="publisher"
                       href="https://fb.com/<?php echo $x['profile']; ?>">
                        <i class="fa fa-facebook"></i>
                    </a>
                   
                </div>
            </div>

        </div>
        <?php } ?>
        </div>

        <script>
             $(document).ready(function () {
                $('[data-toggle="tooltip"]').tooltip();
             });

        </script>





           
          </form>
        </div>
      </div>



                             


    </section>
  </body>
</html>