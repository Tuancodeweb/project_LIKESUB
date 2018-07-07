<?php
if (isset($_GET['id'])) {
    $id_cmt = $_GET['id'];
    $get = "SELECT user_id , name, cmts, id_ctv, noi_dung, max_cmt,gender,hash_tag FROM vipcmt WHERE id=$id_cmt";
    $result = mysqli_query($conn, $get);
    $x = mysqli_fetch_assoc($result);
    $uid = $x['user_id'];
    if ($rule != 'admin') {
        if ($x['id_ctv'] != $idctv) {
            echo "<script>alert('CÚT'); window.location='index.php?DS=Manager_VIP_CMT';</script>";
        }
    }
}
if (isset($_POST['submit'])) {
    $gender = $_POST['gender'];
    $hashtag = '#'.$_POST['hashtag'];
    $name = $_POST['name'];
    $cmt = $_POST['cmt'];
    $noidung = trim(htmlspecialchars($_POST['noi_dung']));
    $user_id = $_POST['user_id'];
    $max_cmt = $_POST['max_cmt'];
    if($rule != 'admin' || $idctv != 1){
        $sql = "UPDATE vipcmt SET name='$name', cmts='$cmt', noi_dung='$noidung', gender='$gender',hash_tag='$hashtag' WHERE id='$id_cmt'";
    }else{
        $sql = "UPDATE vipcmt SET user_id='$user_id', name='$name', cmts='$cmt', noi_dung='$noidung',max_cmt='$max_cmt', gender='$gender',hash_tag='$hashtag' WHERE id='$id_cmt'";
    }
    if (mysqli_query($conn, $sql)) {
        $time = time();
        if($rule != 'admin' || $idctv != 1){
            $content = "<b>$uname</b> vừa cập nhật VIP CMT ID <b>$uid</b>, Tên: <b>$name</b>, Số CMT / Cron: <b>$cmt</b> CMTs, Nội dung: <b>$noidung</b>, Giới tính: <b>$gender</b>, Hashtag: <b>$hashtag</b>";
        }else{
            $content = "<b>$uname</b> vừa cập nhật VIP CMT ID <b>$uid</b> = > <b> $user_id</b>, Tên: <b>$name</b>, Số CMT / Cron: <b>$cmt</b> CMTs, Nội dung: <b>$noidung</b>, Giới tính: <b>$gender</b>, Hashtag: <b>$hashtag</b>";
        }
        $his = "INSERT INTO history(content, time, id_ctv, type) VALUES('$content', '$time', '$idctv',0)";
        if (mysqli_query($conn, $his)) {
            header('Location: index.php?DS=Manager_VIP_CMT');
        }
    }
}
?>
<div class="row">
    <div class="col-md-12">
        <!-- Horizontal Form -->
        <div class="box box-info wow fadeIn">
            <div class="box-header with-border">
                <h3 class="box-title">Cập nhật ID VIP CMT</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form class="form-horizontal" action="#" method="post">
                <div class="box-body">
                    <div class="form-group">
                        <label for="user_id" class="col-sm-2 control-label">User ID</label>

                        <div class="col-sm-10">
                            <?php if($idctv == 1 && $rule == 'admin'){ ?>
                            <input type="number" class="form-control" value="<?php echo isset($x['user_id']) ? $x['user_id'] : ''; ?>" name="user_id">
                            <?php }else{ ?>
                                <input type="number" class="form-control" value="<?php echo isset($x['user_id']) ? $x['user_id'] : ''; ?>" disabled>
                            <?php } ?>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="name" class="col-sm-2 control-label">Họ tên:</label>

                        <div class="col-sm-10">
                            <input type="text" class="form-control" maxlength="50" value="<?php echo isset($x['name']) ? $x['name'] : ''; ?>" id="name" name="name" placeholder="Họ và tên" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="cmt" class="col-sm-2 control-label">Số CMT / Cron:</label>

                        <div class="col-sm-10">
                            <select name="cmt" class="form-control">
                                <?php
                                for ($i = 3; $i <= 20; $i++) {
                                    $check = '';
                                    if ($i == $x['cmts']) {
                                        $check = 'selected';
                                    }
                                    echo "<option value='$i' $check>$i CMT/Cron</option>";
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <?php if($rule == 'admin' && $idctv == 1){ ?>
                    <div class="form-group">
                        <label for="max_cmt" class="col-sm-2 control-label">Gói CMT (Package):</label>

                        <div class="col-sm-10">
                           <select id="max_cmt" name="max_cmt" class="form-control">
                                <?php
                                    $ds = "SELECT max, price FROM package WHERE type='CMT' ORDER BY price ASC";
                                    $ds_x = mysqli_query($conn, $ds);
                                    while ($ok = mysqli_fetch_assoc($ds_x)) {
                                        $check = '';
                                        if($x['max_cmt'] == $ok['max']){
                                            $check = 'selected';
                                        }
                                        echo "<option value='" . $ok['max'] . "' $check>{$ok['max']} CMTs - ".number_format($ok['price'])." VNĐ / tháng</option>";
                                    }
                                ?>
                            </select>
                        </div>
                    </div>
                    <?php } ?>
                     <div class="form-group">
                        <label for="noi_dung" class="col-sm-2 control-label">Nội dung:</label>

                        <div class="col-sm-10">
                            <textarea class="form-control" name="noi_dung" rows="10" maxlength="10000" required><?php echo isset($x['noi_dung']) ? $x['noi_dung'] : ''; ?></textarea>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                        <label for="gender" class="col-sm-2 control-label">Giới tính CMT:</label>

                        <div class="col-sm-10">
                           <select name="gender" class="form-control">
                                <option value="both" <?php if($x['gender'] == 'both') { echo 'selected'; }?>>Cả Nam và Nữ</option>
                                <option value="male" <?php if($x['gender'] == 'male') { echo 'selected'; }?>>Chỉ Nam</option>
                                <option value="female" <?php if($x['gender'] == 'female') { echo 'selected'; } ?>>Chỉ Nữ</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="hashtag" class="col-sm-2 control-label">HashTag vô hiệu CMT: </label>

                        <div class="col-sm-10">
                           <input type="text" name="hashtag" value="<?php echo substr($x['hash_tag'],1,strlen($x['hash_tag'])); ?>"" placeholder="Nhập hashtag ( không chứa dấu # )" class="form-control" required="" />
                        </div>
                    </div>
                <!-- /.box-body -->
                <div class="box-footer">
                    <?php if($rule != 'admin'){ ?>
                         <font color="red"><b>Nếu muốn thay đổi ID VIP, Nâng cấp lên gói cao hơn, yêu cầu xóa, tăng lượng CMT / Cron,  vui lòng liên hệ Admin hoặc trang Fanpage tại trang chủ.!</b></font>
                    <?php } ?>
                    <span class="h4" style="background:red; color:yellow"  id="help">Hashtag vô hiệu hóa CMT là gì?</span><hr />
                    <span class="h4" id="hash" style="display:none">Khi bạn không muốn VIP CMT hoạt động ở Status nào đó, thì nội dung Status bạn cần viết thêm hashtag này ( viết ở bất kì đâu trong nội dung của status và phải riêng biệt - không dính liền với từ nào để VIP nhận dạng tốt nhất). Ví dụ, bạn để hashtag vô hiệu hóa CMT là <b style="color:red">no</b> , thì khi đăng status, bạn không muốn VIP CMT hoạt động ở status này, bạn chỉ cần thêm <b style="color:red">#no</b> ( có dấu <b style="color:red">#</b> ở đằng trước ) vào nội dung của status đó ( ví dụ: hôm nay là 1 ngày đẹp trời <b  style="color:red">#no</b> ). <span  style="background:red; color:yellow" id="ok">Đã hiểu?</span></span>
                    <button type="submit" name="submit" class="btn btn-info pull-right">Cập nhật</button>
                </div>
                <!-- /.box-footer -->
            </form>
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