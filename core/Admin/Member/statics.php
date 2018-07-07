<?php
if(isset($_POST['reset'])){
    $sql = "UPDATE member SET payment = 0 WHERE rule = 'admin'";
    if(mysqli_query($conn, $sql)){
        header('Location: index.php?DS=Statics');
    }
}
?><div class="box wow fadeIn">
    <div class="box-header">
        <h3 class="box-title">Thống kê doanh thu tháng <?php echo date('m/Y'); ?> <?php if($rule == 'admin' && $idctv == 1) { ?> <form style="display:inline" method="post"><button type="submit" name="reset" class="btn btn-danger">Reset</button></form> <?php } ?></h3>
    </div>
    <!-- /.box-header -->
    <div class="box-body">
            <table id="example1" class="table table-bordered">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Tên Admin</th>
                        <th>User Name</th>
                        <th>ID Facebook</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Tổng ID</th>
                        <th>Tổng Doanh Thu Tháng <?php echo date('m/Y'); ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $getvip = "SELECT id_ctv, name, user_name, profile, num_id, payment, email, phone FROM member WHERE rule = 'admin' AND id_ctv != 1";
                    $result = mysqli_query($conn, $getvip);
                    while ($x = mysqli_fetch_assoc($result)) {
                            $id = $x['id_ctv'];
                            $name = $x['name'];
                            $u_name = $x['user_name'];
                            $idfb = $x['profile'];
                            $num = $x['num_id'];
                            $pay = $x['payment'];
                            $email = $x['email'];
                            $phone = $x['phone'];
                        ?>
                        <tr style="font-weight: bold">
                            <td><?php echo $id; ?></td>
                            <td><?php echo $name; ?></td>
                            <td><?php echo $u_name; ?></td>
                            <td><?php echo $idfb; ?> </td>
                            <td><?php echo $email; ?> </td>
                            <td><?php echo $phone; ?> </td>
                            <td style="color:red"><?php echo $num ?> VIP ID</td>
                            <td style="color:red"><?php echo number_format($pay). ' VNĐ'; ?></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
            <p class="alert alert-info">Doanh thu tự động được cộng khi thêm ID VIP mới, khi chuyển tiền cho thành viên khác, khi tạo gift code và có người sử dụng gift code đó (khi muốn tạo gift code cho event gì đó thì liên hệ mình để tạo, hoặc tự tạo thì sẽ tính vào doanh thu). Mọi giao dịch đều được lưu vào lịch sử. Không gian lận tạo clone, tạo gift.. đều được ghi vào lịch sử và doanh thu nhé :)</p>
        </div>
</div>