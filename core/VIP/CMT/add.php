<script>
    function tinh(){
        $(function(){
            if($('#han').val() == 'one' || $('#han').val() == 'three'){
                $('#goi').attr("disabled","disabled").val('40000');
            }else{
                $('#goi').removeAttr('disabled');
            }
             $.post('core/VIP/price.php', { han: $('#han').val(), goi: $('#goi').val(), rule: $('#rule').val()}, function(result){$('#result').html(result);});
        });
    }
    function checkid(){
        $(function(){
            $.post('core/VIP/checkid.php', { user_id: $('#user_id').val()}, function(r){$('#duysex').html(r);});
        });
    }
</script>
<?php
    $get = "SELECT COUNT(*) FROM package WHERE type='CMT'";
    $result = mysqli_query($conn, $get);
    $x = mysqli_fetch_assoc($result);
    if($x['COUNT(*)'] == 0){
        echo "<script>alert('Bạn chưa thêm Package nào cho VIP CMT, thêm ngay để cài đặt ?');window.location='index.php?DS=Add_Package_CMT';</script>";
    }
?>
<?php
if (isset($_POST['submit'])) {
    if (($_POST['han'] != 'one' && $_POST['han'] != 'three') && (($_POST['han'] <= 0 || $_POST['han'] > 12) || $_POST['goi'] < 40000)) {
            echo "<script>alert('Địt con mẹ mày luôn, bug tiếp hộ bố mày cái ?'); window.location='index.php';</script>";
    } else {
        $loi = array();
        $uid = $_POST['user_id'];
        $get = "SELECT COUNT(user_id) FROM vipcmt WHERE user_id = $uid";
        $result = mysqli_query($conn, $get);
        $x = mysqli_fetch_assoc($result);
        if ($x['COUNT(user_id)'] > 0) {
            $loi['err'] = '<font color="red">User ID này đã tồn tại trên hệ thống</font>';
        }
        $checkne = mysqli_query($conn,"SELECT COUNT(*) FROM free WHERE uid = '$uid' AND type='CMT'");
        $numm = mysqli_fetch_assoc($checkne)['COUNT(*)'];
        if($_POST['han'] == 'one' && $numm == 1){
            $loi['exists'] = '<font color="red">ID này đã được Test!</font>';
        }
        if (empty($loi)) {
            $name = $_POST['name'];
            $han = $_POST['han'];
            $cmt = $_POST['cmt'];
            $goi = $_POST['goi'];
            $hashtag = "#".$_POST['hashtag'];
            $gender = $_POST['gender'];
            $noidung = trim(htmlspecialchars($_POST['noi_dung']));
            $start = time();
            if ($han == 'one') {
                $price = 0;
                $end = $start + 86400 - 28800;
                $max_cmt = 10;
                $han = 1;
                mysqli_query($conn, "INSERT INTO free(uid, type, id_ctv) VALUES('$uid','CMT',$idctv)");
            } else if ($han == 'three') {
                $price = 0;
                $end = $start + 86400 * 3 - 28800;
                $max_cmt = 10;
                $han = 3;
            } else {
                $end = $start + $han * 30 * 86400 - 28800;
                $price = $han * $goi;
                if($rule == 'agency'){
                    $price -= $price * 20 / 100;
                }else if($rule == 'freelancer'){
                    $price -= $price * 10 / 100;
                }
                $get_max = "SELECT max FROM package WHERE type='CMT' AND price='$goi'";
                $r_max = mysqli_query($conn, $get_max);
                $max_cmt = mysqli_fetch_assoc($r_max)['max'];
            }
            if($rule != 'freelancer'){
                $get = "SELECT bill FROM member WHERE id_ctv = $idctv";
            }else{
                $get = "SELECT bill FROM ctv WHERE id_ctvs = $idctv";
            }
            $result = mysqli_query($conn, $get);
            $x = mysqli_fetch_assoc($result);
            if ($x['bill'] - $price >= 0) {
                $sql = "INSERT INTO vipcmt(user_id, name, han, start, end, cmts, max_cmt, id_ctv, pay, noi_dung,hash_tag,gender) VALUES('$uid','$name','$han','$start','$end','$cmt','$max_cmt','$idctv','$price','$noidung','$hashtag','$gender')";
                if (mysqli_query($conn, $sql)) {
                    if($rule !='freelancer'){
                        $up = "UPDATE member SET num_id = num_id + 1, payment = payment + $price WHERE id_ctv=$idctv";
                    }else{
                        $up = "UPDATE ctv SET num_id = num_id + 1, payment = payment + $price WHERE id_ctvs=$idctv";
                    }
                    if(mysqli_query($conn, $up)){
                        if($rule !='freelancer'){
                            $minus = "UPDATE member SET bill = bill - $price WHERE id_ctv = $idctv";
                        }else{
                            $minus = "UPDATE ctv SET bill = bill - $price WHERE id_ctvs = $idctv";
                        }
                        if (mysqli_query($conn, $minus)) {
                            $content = "<b>$uname</b> vừa thêm VIP CMT cho ID <b>$uid</b>. Thời hạn <b>$han</b> tháng, gói <b>$max_cmt</b> CMT, tổng thanh toán <b>" . number_format($price) . " VNĐ </b>";
                            $time = time();
                            $his = "INSERT INTO history(content,id_ctv,time,type) VALUES('$content','$idctv', '$time',0)";
                            if (mysqli_query($conn, $his)) {
                                echo '<script>alert("Thêm thành công"); window.location="index.php?DS=Manager_VIP_CMT";</script>';
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
                <h3 class="box-title">Thêm ID VIP CMT</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form class="form-horizontal" action="#" method="post">
                <div class="box-body">
                    <div class="form-group">
                    <input type="hidden" id="rule" value="<?php echo $rule; ?>" />
                        <label for="user_id" class="col-sm-2 control-label">User ID</label>

                        <div class="col-sm-10">
                            <input type="number" onkeyup="checkid()" onchange="checkid();" class="form-control" id="user_id" value="<?php echo isset($_POST['user_id']) ? $_POST['user_id'] : ''; ?>" name="user_id" placeholder="User ID" required>
                            <p id="duysex"></p>
                            <?php echo isset($loi['err']) ? $loi['err'] : ''; ?>
                            <?php echo isset($loi['exists']) ? $loi['exists'] : ''; ?>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="name" class="col-sm-2 control-label">Họ tên:</label>

                        <div class="col-sm-10">
                            <input type="text" class="form-control" maxlength="50" value="<?php echo isset($_POST['name']) ? $_POST['name'] : ''; ?>" id="name" name="name" placeholder="Họ và tên" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="han" class="col-sm-2 control-label">Thời Hạn:</label>

                        <div class="col-sm-10">
                            <select id="han" name="han" class="form-control" required="" onchange="tinh()">
                                <?php if ($rule == 'agency' || $rule == 'admin') { ?>
                                    <option value="one">1 ngày - Free Test</option>
                                <?php } if ($rule == 'admin') { ?>
                                    <option value="three">3 ngày - Free Event</option>
                                <?php } ?>
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
                            <textarea class="form-control" rows="10" name="noi_dung" placeholder="Nội dung CMT, nội dung khác nhau cách nhau bởi dâu xuống dòng (Enter)" maxlength="10000" required><?php echo isset($_POST['noi_dung']) ? $_POST['noi_dung'] : ''; ?></textarea>
                        </div>
                    </div>
                     <div class="form-group">
                        <label for="cmt" class="col-sm-2 control-label">Số CMT / Cron:</label>

                        <div class="col-sm-10">
                            <select id="cmt" name="cmt" class="form-control" required="">
                                <?php
                                for ($i = 3; $i <= 20; $i++) {
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
                                    echo "<option value='" . $ok['price'] . "'>{$ok['max']} CMTs - ".number_format($ok['price'])." VNĐ / tháng</option>";
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="gender" class="col-sm-2 control-label">Giới tính CMT:</label>

                        <div class="col-sm-10">
                           <select name="gender" class="form-control">
                                <option value="both">Cả Nam và Nữ</option>
                                <option value="male">Chỉ Nam</option>
                                <option value="female">Chỉ Nữ</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="hashtag" class="col-sm-2 control-label">HashTag vô hiệu CMT: </label>

                        <div class="col-sm-10">
                           <input type="text" name="hashtag" value="" placeholder="Nhập hashtag ( không chứa dấu # )" class="form-control" required="" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="goi" class="col-sm-2 control-label">Thành tiền:</label>

                        <div class="col-sm-10">
                            <span style="background:red; color:yellow" class="h4" id="result"><script>tinh();</script>.</span>
                        </div>
                    </div>
                </div>
                <!-- /.box-body -->
                <div class="box-footer">
                <?php if($rule == 'agency'){ ?> <font color="red">Bạn là <b>Đại lí</b> nên được giảm 20% giá gói VIP này</font><?php }else if($rule == 'freelancer'){ ?> <font color="red">Bạn là <b>Cộng tác viên</b> được giảm 10% giá gói VIP này</font>  <?php  } ?><br />
                <hr />
                <span class="h4" style="background:red; color:yellow" id="help">Hashtag vô hiệu hóa CMT là gì?</span>
                    <br /><span class="h4" id="hash" style="display:none">Khi bạn không muốn VIP CMT hoạt động ở Status nào đó, thì nội dung Status bạn cần viết thêm hashtag này - hashtag bắt đầu là chữ, viết liền không dấu, không có kí tự đặc biệt ( viết ở bất kì đâu trong nội dung của status và phải riêng biệt - không dính liền với từ nào để VIP nhận dạng tốt nhất). Ví dụ, bạn để hashtag vô hiệu hóa CMT là <b style="color:red">no</b> ( không có dấu <b style="color:red">#</b> ở đằng trước khi thêm VIP ID) , thì khi đăng status, bạn không muốn VIP CMT hoạt động ở status này, bạn chỉ cần thêm <b style="color:red">#no</b> ( có dấu <b style="color:red">#</b> ở đằng trước khi đăng status ) vào nội dung của status đó ( ví dụ: hôm nay là 1 ngày đẹp trời <b  style="color:red">#no</b> ). <span  style="background:red; color:yellow" id="ok">Đã hiểu?</span></span>
                    <button type="submit" name="submit" class="btn btn-info pull-right">Thêm</button>
                </div>
                <!-- /.box-footer -->
            </form>
            <p class="alert alert-danger" style="font-size:17px">Chú ý: Nếu mua gói nhiều CMT, các bạn nên nhập nội dung CMT nhiều 1 chút nên nhiều hơn số Max CMT của gói, mỗi CMT 1 dòng. Nội dung CMT không nên có  các kí tự đặc biệt như <b>'</b>, <b>"</b>, <b>\</b>, <b>/</b>,...<br /> Về <b>Hashtag</b> không nên chứa các kí tự đặc biệt như <b>@,#,$,!,%,^,&,*,(,),',",/,\,....</b>(chú ý không thêm dấu <b>#</b> khi cài VIP mà chỉ khi đăng tus mới thêm!) <br />Sau khi cài đặt xong, các bạn vào phần quản lí VIP CMT của mình ấn <b>Cập nhật</b> xem mọi thông tin đã đúng hết chưa để VIP hoạt động nhé!<br />Cần hỗ trợ liên hệ Admin hoặc  Fanpage tại trang chủ!</p>
        </div>
    </div>
</div>
<script>
    $(document).ready(function () {
        $('[data-toggle="tooltip"]').tooltip();
    });
    $('#help').click(function(){
        $('#hash').slideToggle();
    });
    $('#ok').click(function(){
        $('#hash').slideUp();
    });
</script>
