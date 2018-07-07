<?php
if ($rule == 'admin' || $rule == 'agency') {
    echo "<script>alert('Admin không được sử dụng gift code'); window.location='index.php';</script>";
} else {
    if (isset($_POST['submit'])) {
        $giftcode = $_POST['gift_code'];
        $get = "SELECT billing, status,id_ctv, COUNT(*) FROM gift WHERE code = '$giftcode' GROUP BY billing, status, id_ctv";
        $result = mysqli_query($conn, $get);
        $x = mysqli_fetch_assoc($result);
        $id = $x['id_ctv'];
        $get1 = "SELECT rule FROM member WHERE id_ctv = $id";
        $result1 = mysqli_query($conn, $get1);
        $z = mysqli_fetch_assoc($result1);
        if ($x['status'] == 0 && $x['COUNT(*)'] == 1) {
            $billing = $x['billing'];
            if ($rule != 'freelancer') {
                $exec = "UPDATE member SET bill = bill + $billing WHERE id_ctv = $idctv";
            } else {
                $exec = "UPDATE ctv SET bill = bill + $billing WHERE id_ctvs = $idctv";
            }
            if (mysqli_query($conn, $exec)) {
                $update = "UPDATE gift SET status = 1 WHERE code = '$giftcode'";
                if (mysqli_query($conn, $update)) {

                    if ($z['rule'] == 'admin') {
                        $add = "UPDATE member SET payment = payment + $billing WHERE id_ctv=$id";
                        if (mysqli_query($conn, $add)) {
                            $content = "<b>$uname</b> đã sử dụng Gift Code <b> $giftcode</b> và được cộng <b>" . number_format($billing) . "</b> VNĐ vào tài khoản";
                            $time = time();
                            $his = "INSERT INTO history(content, time, id_ctv, type) VALUES('$content','$time','$idctv',3)";
                            if (mysqli_query($conn, $his)) {
                                echo "<script>alert('Thành công!!'); window.location='index.php';</script>";
                            }
                        }
                    } else {
                        $content = "<b>$uname</b> đã sử dụng Gift Code <b> $giftcode</b> và được cộng <b>" . number_format($billing) . "</b> VNĐ vào tài khoản";
                        $time = time();
                        $his = "INSERT INTO history(content, time, id_ctv, type) VALUES('$content','$time','$idctv',3)";
                        if (mysqli_query($conn, $his)) {
                            echo "<script>alert('Thành công!!'); window.location='index.php';</script>";
                        }
                    }
                }
            }
        } else {
            echo "<script>alert('Gift code không tồn tại hoặc đã được sử dụng');</script>";
        }
    }
}
?><div class="row">
    <div class="col-md-12">
        <!-- Horizontal Form -->
        <div class="box box-info wow fadeIn">
            <div class="box-header with-border">
                <h3 class="box-title">GIFT CODE</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form class="form-horizontal" action="#" method="post">
                <div class="box-body">
                    <div class="form-group">
                        <label for="giftcode" class="col-sm-2 control-label">Nhập mã Gift Code:</label>

                        <div class="col-sm-10">
                            <input type="text" name="gift_code" class="form-control" />
                        </div>
                    </div>



                </div>
                <!-- /.box-body -->
                <div class="box-footer">
                    <button type="submit" name="submit" class="btn btn-info pull-right">Thực hiện</button>
                </div>
                <!-- /.box-footer -->
            </form>
        </div>
    </div>
</div>
