
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

                </div>
                <div class="avatar">
                    <img alt="Avatar" src="https://graph.fb.me/<?php echo $x['profile']; ?>/picture">
                </div>
                <div class="info">
                    <div class="title">
                        <?php echo $x['name']; ?>
                    </div>
                    <div class="desc">Quản trị viên</div>
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

                </div>
                <div class="avatar">
                    <img alt="Avatar" src="https://graph.fb.me/<?php echo $x['profile']; ?>/picture">
                </div>
                <div class="info">
                    <div class="title">
                        <?php echo $x['name']; ?>
                    </div>
                    <div class="desc">Đại lí VIP</div>
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