<script>
    function check(id) {
        if (confirm('Bạn có chắc chắn muốn xóa VIP ID này ?') == true) {
            window.location = 'index.php?DS=Delete_CMT&id_cmt=' + id;
        } else {
            return false;
        }
    }
</script>
<div class="box wow fadeIn">
    <div class="box-header">
        <h3 class="box-title">Danh sách ID VIP CMT <?php if($rule == 'admin' || $rule == 'agency'){ ?> | <a class="btn btn-danger" href="index.php?DS=CTV_CMT" target="_blank">VIP CMT CTV</a><?php } ?></h3>
    </div>
    <!-- /.box-header -->
    <div class="box-body table-responsive">
        <table id="example1" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>User ID</th>
                    <th>Tên</th>
                    <th>Thời hạn</th>
                    <th>CMTs / Cron</th>
                    <th>Max CMT</th>
                    <th>Thanh toán</th>
                    <th>Giới tính</th>
                    <th>Còn lại</th>
                    <?php
                    if ($rule == 'admin') {
                        echo '<th>Người thêm</th>';
                    }
                    ?>
                    <th>Công cụ</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($rule != 'admin') {
                    $get = "SELECT id,user_id, name, han, cmts, max_cmt, start, end, pay,gender FROM vipcmt WHERE id_ctv=$idctv";
                } else{
                    $get = "SELECT id, user_id, vipcmt.name, han, cmts, max_cmt, start, end, pay, member.name AS ctv_name, member.user_name,rule,gender FROM vipcmt INNER JOIN member ON vipcmt.id_ctv = member.id_ctv";
                }
                $result = mysqli_query($conn, $get);
                while ($x = mysqli_fetch_assoc($result)) {
                    $rl = '';
                    $gt = '';
                    if($x['gender'] == 'both'){
                        $gt = 'Cả 2';
                    }else if($x['gender'] =='female'){
                        $gt = 'Chỉ Nữ';
                    }else if($x['gender'] == 'male'){
                        $gt = 'Chỉ Nam';
                    }
                    if(isset($x['rule']) && $x['rule'] == 'member'){
                        $rl = '<font color="blue">Member</font>';
                    }else if(isset($x['rule']) && $x['rule'] == 'agency'){
                        $rl = '<font color="violet">Đại lí</font>';
                    }else{
                        $rl = '<font color="red">Admin</font>';
                    }
                    $z = $x['end'] - time();
                    $id = $x['id'];
                    $conlai = date('z \N\g\à\y H \g\i\ờ i \p\h\ú\t', $z);
                    $handle = '';
                    if (isset($x['ctv_name'])) {
                        $ctv_name = $x['ctv_name'];
                    }
                    if ($rule == 'admin') {
                        if ($x['end'] >= time()) {
                            $handle = "<a href='index.php?DS=Update_CMT&id=$id' class='btn btn-info'>Cập nhật</a> <a onClick='check($id);' class='btn btn-danger'>Xóa</a>";
                        }else{
                            $handle = " <a onClick='check($id);' class='btn btn-danger'>Xóa</a>";
                        }
                    } else {
                        if ($x['end'] >= time()) {
                            $handle = "<a href='index.php?DS=Update_CMT&id=$id' class='btn btn-info'>Cập nhật</a>";
                        } else {
                            $handle = "<a onClick='check($id);' class='btn btn-danger'>Xóa</a>";
                        }
                    }
                    ?>
                    <tr style="font-weight: bold">
                        <td><?php echo $x['id']; ?></td>
                        <td><a href="//fb.com/<?php echo $x['user_id']; ?>" target="_blank"><?php echo $x['user_id']; ?></a></td>
                        <td><?php echo $x['name']; ?></td>
                        <td><?php echo $x['han']; ?> tháng</td>
                        <td><?php echo $x['cmts']; ?> CMTs</td>
                        <td><?php echo $x['max_cmt']; ?> CMT</td>
                        <td><?php echo number_format($x['pay']); ?> VNĐ</td>
                        <td><?php echo $gt; ?>
                        <td><?php echo $conlai; ?> </td>
                    <?php if (isset($ctv_name)) echo "<td>$ctv_name ( {$x['user_name']} - $rl)</td>"; ?>
                        <td style="text-align:center"><?php echo $handle; ?></td>
                    </tr>
<?php } ?>
            </tbody>
        </table>
    </div>
</div>