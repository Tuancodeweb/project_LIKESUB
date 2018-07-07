<script>
    function tinh(){
        $(function(){
             $.post('core/VIP/price.php', { han: $('#han').val(), goi: $('#goi').val(), rule: $('#rule').val()}, function(result){$('#result').html(result);});
        });
    }
</script>
<?php
if (isset($_GET['id'])) {
    $id_cmt = $_GET['id'];
    $get = "SELECT user_id , name, cmts, end, id_ctv, noi_dung FROM vipcmt WHERE id=$id_cmt";
    $result = mysqli_query($conn, $get);
    $x = mysqli_fetch_assoc($result);
    $uid = $x['user_id'];
    if ($rule != 'admin') {
        if ($x['id_ctv'] != $idctv) {
            echo "<script>alert('CÚT');window.location='index.php';</script>";
        } else if ($x['end'] > time()) {
            echo "<script>alert('Không thể gia hạn khi chưa hết hạn');window.location='index.php';</script>";
        }
    }else{
        if ($x['end'] > time()) {
            echo "<script>alert('Không thể gia hạn khi chưa hết hạn');window.location='index.php';</script>";
        }
    }
}
if (isset($_POST['submit'])) {
    $han = $_POST['han'];
    $cmt = $_POST['cmt'];
    $goi = $_POST['goi'];
    $noidung = $_POST['noi_dung'];
    $start = time();
    $end = $start + $han * 30 * 86400;
    $price = $han * $goi;
    if($rule == 'agency'){
    $price -= $price * 20 / 100;
    }else if($rule == 'freelancer'){
        $price -= $price * 10 / 100;
    }
    if($rule != 'freelancer'){
        $get = "SELECT bill FROM member WHERE id_ctv = $idctv";
    }else{
        $get = "SELECT bill FROM ctv WHERE id_ctvs = $idctv";
    }
    $result = mysqli_query($conn, $get);
    $x = mysqli_fetch_assoc($result);
    $get_max = "SELECT max FROM package WHERE type='CMT' AND price='$goi'";
    $r_max = mysqli_query($conn, $get_max);
    $max_cmt = mysqli_fetch_assoc($r_max)['max'];
    if ($x['bill'] - $price >= 0) {
        $sql = "UPDATE vipcmt SET cmts='$cmt', han='$han', max_cmt='$max_cmt', start='$start', end='$end',noi_dung='$noidung', pay='$price' WHERE id=$id_cmt";
        if (mysqli_query($conn, $sql)) {
            if($rule != 'freelancer'){
                $minus = "UPDATE member SET bill = bill - $price, payment = payment + $price WHERE id_ctv = $idctv";
            }else{
                $minus = "UPDATE ctv SET bill = bill - $price, payment = payment + $price WHERE id_ctvs = $idctv";
            }
            if (mysqli_query($conn, $minus)) {
                $content = "<b>$uname</b> vừa gia hạn VIP CMT cho ID <b>$uid</b> thêm <b>$han</b> tháng, gói <b>$max_cmt</b> CMT, tổng thanh toán <b>" . number_format($price) . " VNĐ </b>";
                $time = time();
                $his = "INSERT INTO history(content,id_ctv,time, type) VALUES('$content','$idctv', '$time',0)";
                if (mysqli_query($conn, $his)) {
                    echo '<script>alert("Gia hạn thành công"); window.location="index.php?DS=Manager_VIP_CMT";</script>';
                }
            }
        }
    } else {
        echo '<script>alert("Số dư tài khoản của bạn không đủ !!! Vui lòng nạp thêm tiền đi nha!"); window.location="index.php?DS=Manager_VIP_CMT";</script>';
    }
}
?>
<div class="row">
    <div class="col-md-12">
        <!-- Horizontal Form -->
        <div class="box box-info wow fadeIn">
            <div class="box-header with-border">
                <h3 class="box-title">Gia hạn VIP CMT</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form class="form-horizontal" action="#" method="post">
            <input type="hidden" id="rule" value="<?php echo $rule; ?>" /
                <div class="box-body">
                    <div class="form-group">
                        <label for="user_id" class="col-sm-2 control-label">User ID</label>

                        <div class="col-sm-10">
                            <input type="number" class="form-control" id="user_id" value="<?php echo isset($x['user_id']) ? $x['user_id'] : ''; ?>" disabled>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="name" class="col-sm-2 control-label">Họ tên:</label>

                        <div class="col-sm-10">
                            <input type="text" class="form-control" maxlength="50" value="<?php echo isset($x['name']) ? $x['name'] : ''; ?>" disabled>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="han" class="col-sm-2 control-label">Thời Hạn:</label>

                        <div class="col-sm-10">
                            <select id="han" name="han" class="form-control" required="" onchange="tinh()">
                                <?php
                                for ($i = 1; $i <= 12; $i++) {
                                    echo "<option value='$i'>$i Tháng</option>";
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="noidung" class="col-sm-2 control-label">Nội dung CMT:</label>

                        <div class="col-sm-10">
                            <textarea class="form-control" rows="10" name="noi_dung" placeholder="Nội dung CMT, nội dung khác nhau cách nhau bởi dâu xuống dòng (Enter)" required><?php echo isset($_POST['noi_dung']) ? $_POST['noi_dung'] : ''; ?></textarea>
                        </div>
                    </div>
                     <div class="form-group">
                        <label for="cmt" class="col-sm-2 control-label">Số CMT / Cron:</label>

                        <div class="col-sm-10">
                            <select id="cmt" name="cmt" class="form-control" required="">
                                <?php
                                for ($i = 1; $i <= 10; $i++) {
                                    echo "<option value='$i'>$i CMT/Cron</option>";
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="goi" class="col-sm-2 control-label">Gói CMT (Package):</label>

                        <div class="col-sm-10">
                           <select id="goi" name="goi" class="form-control" onchange="tinh()">
                                <?php
                                $ds = "SELECT max, price FROM package WHERE type='CMT' ORDER BY price ASC";
                                $ds_x = mysqli_query($conn, $ds);
                                while ($ok = mysqli_fetch_assoc($ds_x)) {
                                    echo "<option value='" . $ok['price'] . "'>{$ok['max']} CMTs - ".number_format($ok['price'])." VNĐ</option>";
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="goi" class="col-sm-2 control-label">Thành tiền:</label>

                        <div class="col-sm-10">
                            <span style="background:red; color:yellow" class="h4" id="result"><script>tinh();</script></span>
                        </div>
                    </div>
                </div>
                <!-- /.box-body -->
                <div class="box-footer">

                <?php if($rule == 'agency'){ ?> <font color="red">Bạn là <b>Đại lí</b> nên được giảm 20% giá gói VIP này</font><?php }else if($rule == 'freelancer'){ ?> <font color="red">Bạn là <b>Cộng tác viên</b> được giảm 10% giá gói VIP này</font>  <?php  } ?>
                    <button type="submit" name="submit" class="btn btn-info pull-right">Gia hạn</button>
                </div>
                <!-- /.box-footer -->
            </form>
        </div>
    </div>
</div>