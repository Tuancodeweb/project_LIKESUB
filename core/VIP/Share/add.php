<script>
    function tinh(){
        $(function(){
             $.post('core/VIP/price.php', { han: $('#han').val(), goi: $('#goi').val(), rule: $('#rule').val() }, function(result){$('#result').html(result);});
        });
    }
    function checkid(){
        $(function(){
            $.post('core/VIP/checkid.php', { user_id: $('#user_id').val()}, function(r){$('#duysex').html(r);});
        });
    }
</script>
<?php
    $get = "SELECT COUNT(*) FROM package WHERE type='SHARE'";
    $result = mysqli_query($conn, $get);
    $x = mysqli_fetch_assoc($result);
    if($x['COUNT(*)'] == 0){
        echo "<script>alert('Chưa có package nào?');window.location='index.php?DS=Add_Package_Share';</script>";
    }
?>
<?php
if (isset($_POST['submit'])) {
    if(($_POST['han'] <= 0 || $_POST['han'] > 12) || $_POST['goi'] < 25000){
        echo "<script>alert('Địt con mẹ mày luôn, bug tiếp hộ bố mày cái ?'); window.location='logout.php';</script>";
    }else{
        $loi = array();
        $uid = $_POST['user_id'];
        $get = "SELECT COUNT(user_id) FROM vipshare WHERE user_id = $uid";
        $result = mysqli_query($conn, $get);
        $x = mysqli_fetch_assoc($result);
        if ($x['COUNT(user_id)'] > 0) {
            $loi['err'] = '<font color="red">User ID này đã tồn tại trên hệ thống</font>';
        }
        if (empty($loi)) {
            $name = $_POST['name'];
            $han = $_POST['han'];
            $shares = $_POST['shares'];
            $goi = $_POST['goi'];
            $start = time();
            $end = $start + $han * 30 * 86400 - 28800;
            $price = $han * $goi;
            if($rule == 'agency'){
                $price -= $price * 20 / 100;
            }else if($rule == 'freelancer'){
                $price -= $price * 10 / 100;
            }
            $get_max = "SELECT max FROM package WHERE type='SHARE' AND price='$goi'";
            $r_max = mysqli_query($conn, $get_max);
            $max_share = mysqli_fetch_assoc($r_max)['max'];
            if($rule != 'freelancer'){
             $get = "SELECT bill FROM member WHERE id_ctv = $idctv";
            }else{
                $get = "SELECT bill FROM ctv WHERE id_ctvs = $idctv";
            }
            $result = mysqli_query($conn, $get);
            $x = mysqli_fetch_assoc($result);
            if ($x['bill'] - $price >= 0) {
                $sql = "INSERT INTO vipshare(user_id, name, han, start, end, shares, max_share, id_ctv, pay) VALUES('$uid','$name','$han','$start','$end','$shares','$max_share','$idctv','$price')";
                if (mysqli_query($conn, $sql)) {
                    if($rule != 'freelancer'){
                        $up = "UPDATE member SET num_id = num_id + 1, payment = payment + $price WHERE id_ctv=$idctv";
                    }else{
                        $up = "UPDATE ctv SET num_id = num_id + 1, payment = payment + $price WHERE id_ctvs=$idctv";
                    }
                    if(mysqli_query($conn, $up)){
                    if($rule != 'freelancer'){
                        $minus = "UPDATE member SET bill = bill - $price WHERE id_ctv = $idctv";
                    }else{
                        $minus = "UPDATE ctv SET bill = bill - $price WHERE id_ctvs = $idctv";
                    }
                        if (mysqli_query($conn, $minus)) {
                            $content = "<b>$uname</b> vừa thêm VIP Share cho ID <b>$uid</b>. Thời hạn <b>$han</b> tháng, gói <b>$max_share</b> Share, tổng thanh toán <b>" . number_format($price) . " VNĐ </b>";
                            $time = time();
                            $his = "INSERT INTO history(content,id_ctv,time, type) VALUES('$content','$idctv', '$time',0)";
                            if (mysqli_query($conn, $his)) {
                                echo '<script>alert("Thêm thành công"); window.location="index.php?DS=Manager_VIP_Share";</script>';
                            }
                        }
                    }
                }
            } else {
                echo '<script>alert("Số dư tài khoản của bạn không đủ !!! Vui lòng nạp thêm tiền đi nha!1");</script>';
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
                <h3 class="box-title">Thêm ID VIP Share</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form class="form-horizontal" action="#" method="post">
                <input type="hidden" id="rule" value="<?php echo $rule; ?>" />
                <div class="box-body">
                    <div class="form-group">
                        <label for="user_id" class="col-sm-2 control-label">User ID</label>

                        <div class="col-sm-10">
                            <input type="number" class="form-control" onkeyup="checkid()" onchange="checkid();" id="user_id" value="<?php echo isset($_POST['user_id']) ? $_POST['user_id'] : ''; ?>" name="user_id" placeholder="User ID" required>
                            <p id="duysex"></p>
                            <?php echo isset($loi['err']) ? $loi['err'] : ''; ?>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="name" class="col-sm-2 control-label">Họ tên:</label>

                        <div class="col-sm-10">
                            <input type="text" class="form-control" maxlength="50" value="<?php echo isset($_POST['name']) ? $_POST['name'] : ''; ?>" id="name" name="name" placeholder="Họ và tên" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="phone" class="col-sm-2 control-label">Thời Hạn:</label>

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
                        <label for="shares" class="col-sm-2 control-label">Số Shares / Cron:</label>

                        <div class="col-sm-10">
                            <select name="shares" class="form-control">
                                <?php
                                for ($i = 10; $i <= 50; $i += 10) {
                                    echo "<option value='$i'>$i Share/Cron</option>";
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="goi" class="col-sm-2 control-label">Gói Share (Package):</label>

                        <div class="col-sm-10">
                            <select id="goi" name="goi" class="form-control" onchange="tinh()">
                                <?php
                                $ds = "SELECT max, price FROM package WHERE type='SHARE' AND max <= 1000 ORDER BY price ASC";
                                $ds_x = mysqli_query($conn, $ds);
                                while ($ok = mysqli_fetch_assoc($ds_x)) {
                                    echo "<option value='" . $ok['price'] . "'>{$ok['max']} Share - ".number_format($ok['price'])." VNĐ / tháng</option>";
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
                    <button type="submit" name="submit" class="btn btn-info pull-right">Thêm</button>
                </div>
                <!-- /.box-footer -->
            </form>
        </div>
    </div>
</div>

