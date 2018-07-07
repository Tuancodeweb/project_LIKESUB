<?php
if($rule == 'admin' || $rule == 'member'){
    $sql = "SELECT member.name , bill, user_name, profile, num_id FROM member WHERE id_ctv = $idctv";
}else if($rule == 'agency'){
    $sql = "SELECT member.name, member.bill, member.user_name, member.profile, member.num_id AS numid, COUNT(ctv.user_name) AS numctv FROM member INNER JOIN ctv ON member.id_ctv = ctv.id_agency WHERE member.id_ctv = $idctv";
}else{
    $sql = "SELECT ctv.name as name, ctv.bill, ctv.user_name, ctv.profile,ctv.num_id as numid, member.user_name as udaili, member.name as ndaili FROM ctv LEFT JOIN member ON member.id_ctv = ctv.id_agency WHERE ctv.id_ctvs = $idctv";
}
$result = mysqli_query($conn, $sql);
$x = mysqli_fetch_assoc($result);
?>
<div class="row">
    <div class="col-md-6 col-lg-6">
        <div class="panel panel-default">
            <div class="panel-heading">
                <b>LIKESUB - Thông báo</b>
            </div>
            <div class="panel-body">
                <?php
                $getnoti = "SELECT content FROM notification";
                $noti = mysqli_query($conn, $getnoti);
                while ($z = mysqli_fetch_assoc($noti)) {
                    ?>
                    <div class="alert alert-warning alert-dismissable" style="border-color: red !important;background: #ddd !important; color:black !important">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        <span class="h5"><?php echo $z['content']; ?></span>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>


    <div class="col-md-6 wow fadeInDown" data-wow-duration="2s">
        <div class="box box-widget widget-user">
            <!-- Add the bg color to the header using any of the bg-* classes -->
            <div class="widget-user-header bg-black" style="background: url('https://adminlte.io/themes/AdminLTE/dist/img/photo1.png') center center;">
                <h3 class="widget-user-username"><?php echo $x['name']; ?></h3>
                <h5 class="widget-user-desc"><?php echo '@'.$x['user_name']; ?></h5>
                
            </div>
            <div class="widget-user-image">
                <img class="img-circle" src="https://graph.facebook.com/<?php echo $x['profile']; ?>/picture?type=large"  width="100%" height="100%" alt="User Avatar">
            </div>
            <div class="box-footer">
                <div class="row">
                    <?php if($rule == 'admin' || $rule == 'member'){ ?>
                    <div class="col-sm-6 border-righ" title="Đây là số tiền còn lại của bạn trên hệ thống. Hết tiền nạp ngay ở mục nạp tiền góc phải bên trên màn hình nhé" data-toggle="tooltip">
                        <div class="description-block">
                            <h5 class="description-header"><?php echo number_format($x['bill']); ?></h5>
                            <span class="description-text">VNĐ</span>
                        </div>
                        <!-- /.description-block -->
                    </div>
                    <!-- /.col -->
                    <div class="col-sm-6 border-right" title="Đây là tổng số id vip của bạn có tại hệ thống. Gồm cả vip like và vip cmt vip cảm xúc" data-toggle="tooltip">
                        <div class="description-block">
                            <h5 class="description-header"><?php echo $x['num_id']; ?></h5>
                            <span class="description-text">ID VIP</span>
                        </div>
                        <!-- /.description-block -->
                    </div>
                    <?php } else if($rule =='agency'){?>
                    <div class="col-sm-4 border-righ" title="Đây là số tiền còn lại của bạn trên hệ thống. Hết tiền nạp ngay ở mục nạp tiền góc phải bên trên màn hình nhé" data-toggle="tooltip">
                        <div class="description-block">
                            <h5 class="description-header"><?php echo number_format($x['bill']); ?></h5>
                            <span class="description-text">VNĐ</span>
                        </div>
                        <!-- /.description-block -->
                    </div>
                    <!-- /.col -->
                    <div class="col-sm-4 border-right" title="Đây là tổng số CTV của bạn có tại hệ thống." data-toggle="tooltip">
                        <div class="description-block">
                            <h5 class="description-header"><?php echo $x['numctv']; ?></h5>
                            <span class="description-text">CTV</span>
                        </div>
                        <!-- /.description-block -->
                    </div>
                     <div class="col-sm-4 border-right" title="Đây là tổng số id vip của bạn có tại hệ thống. Gồm cả vip like và vip cmt vip cảm xúc" data-toggle="tooltip">
                        <div class="description-block">
                            <h5 class="description-header"><?php echo $x['numid']; ?></h5>
                            <span class="description-text">ID VIP</span>
                        </div>
                        <!-- /.description-block -->
                    </div>
                    <?php }else{ ?>
                        <div class="col-sm-4 border-righ" title="Đây là số tiền còn lại của bạn trên hệ thống. Hết tiền nạp ngay ở mục nạp tiền góc phải bên trên màn hình nhé" data-toggle="tooltip">
                        <div class="description-block">
                            <h5 class="description-header"><?php echo number_format($x['bill']); ?></h5>
                            <span class="description-text">VNĐ</span>
                        </div>
                        <!-- /.description-block -->
                    </div>
                    <!-- /.col -->
                    <div class="col-sm-4 border-right" title="Đây là Chủ Đại lí của bạn" data-toggle="tooltip">
                        <div class="description-block">
                            
                            <span class="description-text">Thuộc Đại Lí</span>
                            <h5 class="description-header"><?php echo !empty($x['udaili']) ? $x['udaili']. '( '. $x['ndaili'].' )' : 'Forever Alone :V'; ?></h5>
                        </div>
                        <!-- /.description-block -->
                    </div>
                     <div class="col-sm-4 border-right" title="Đây là tổng số id vip của bạn có tại hệ thống. Gồm cả vip like và vip cmt vip cảm xúc" data-toggle="tooltip">
                        <div class="description-block">
                            <h5 class="description-header"><?php echo $x['numid']; ?></h5>
                            <span class="description-text">ID VIP</span>
                        </div>
                        <!-- /.description-block -->
                    </div>
                    <?php } ?>
                </div>
                <!-- /.row -->
            </div>
        </div>
    </div>


    <!-- Menu Chức Năng -->

    <div class="col-lg-6 col-xs-12  wow fadeInLeft" data-wow-duration="3s">
        <!-- small box -->
        <div class="small-box bg-red">
            <div class="inner">
                <h3>LIKESUB</h3>

                <p>Auto Bot Like Facebook Pro - No Spam!</p>
            </div>
            <div class="icon">
                <i class="fa fa-thumbs-o-up"></i>
            </div>
            <a href="//bestauto.pro" target="_blank" class="small-box-footer">
                Sử dụng <i class="fa fa-arrow-circle-right"></i>
            </a>
        </div>
    </div>
    <div class="col-lg-6 col-xs-12  wow fadeInRight" data-wow-duration="3s">
        <!-- small box -->
        <div class="small-box bg-yellow">
            <div class="inner">
                <h3>VIP Share ( VIA Page )</h3>

                <p>VIP Share System</p>
            </div>
            <div class="icon">
                <i class="glyphicon glyphicon-share-alt"></i>
            </div>
            <a href="index.php?DS=Add_VIP_Share" class="small-box-footer">
                Show <i class="fa fa-arrow-circle-right"></i>
            </a>
        </div>
    </div>

    <div class="col-lg-6 col-xs-6  wow fadeInUp" data-wow-duration="3s">
        <!-- small box -->
        <div class="small-box bg-aqua">
            <div class="inner">
                <h3>VIP LIKE</h3>

                <p>VIP LIKE System</p>
            </div>
            <div class="icon">
                <i class="fa fa-thumbs-o-up"></i>
            </div>
            <a href="index.php?DS=Add_VIP_Like" class="small-box-footer">
                 Order Now <i class="fa fa-arrow-circle-right"></i>
            </a>
        </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-6 col-xs-6 wow fadeInUp" data-wow-duration="3s">
        <!-- small box -->
        <div class="small-box bg-green">
            <div class="inner">
                <h3>VIP CMT</h3>

                <p>VIP CMT System</p>
            </div>
            <div class="icon">
                <i class="fa fa-comments" aria-hidden="true"></i>

            </div>
            <a href="index.php?DS=Add_VIP_CMT" class="small-box-footer">
                 Order Now <i class="fa fa-arrow-circle-right"></i>
            </a>
        </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-6 col-xs-6 wow fadeInUp" data-wow-duration="3s">
        <!-- small box -->
        <div class="small-box bg-yellow">
            <div class="inner">
                <h3>VIP REACTION</h3>

                <p>Vip Bot Reaction System</p>
            </div>
            <div class="icon">
                <i class="fa fa-heart" aria-hidden="true"></i>
            </div>
            <a href="index.php?DS=Add_VIP_Reaction" class="small-box-footer">
                Order Now <i class="fa fa-arrow-circle-right"></i>
            </a>
        </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-6 col-xs-6 wow fadeInUp" data-wow-duration="3s">
        <!-- small box -->
        <div class="small-box bg-red">
            <div class="inner">
                <h3>Bảng giá</h3>

                <p>Price List In VIP System</p>
            </div>
            <div class="icon">
                <i class="glyphicon glyphicon-shopping-cart" aria-hidden="true"></i>
            </div>
            <a data-toggle="modal" href="#myModal" class="small-box-footer"><i class="fa fa-arrow-circle-right"></i> Xem bảng giá</a>
        </div>
    </div>
    <!-- ./col -->

</div>
<script>
    $(document).ready(function () {
        $('[data-toggle="tooltip"]').tooltip();
    });
</script>
