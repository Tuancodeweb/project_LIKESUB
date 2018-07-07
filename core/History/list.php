<script>
    function check(id) {
        if (confirm('Bạn có chắc chắn muốn xóa lịch sử  này ?') == true) {
            window.location = 'index.php?DS=Delete_History&id_his=' + id;
        } else {
            return false;
        }
    }
    function check1() {
        if (confirm('Bạn có chắc chắn muốn xóa tất cả lịch sử ?') == true) {
            window.location = 'index.php?DS=Delete_History';
        } else {
            return false;
        }
    }
</script>
<div class="box wow fadeIn">
    <div class="box-header">
        <h3 class="box-title">Lịch sử <?php if ($rule == 'admin' && $idctv == 1) { ?>| <a href="#" onClick="check1()" class="btn btn-danger">Xóa tất cả</a><?php } ?></h3>
    </div>
    <ul class="nav nav-tabs">
        <li class="active">
            <a  href="#ok0" data-toggle="tab">VIP ID</a>
        </li>
        <li><a href="#ok1" data-toggle="tab">Tài Khoản</a>
        </li>
        <li><a href="#ok2" data-toggle="tab">Số dư</a>
        </li>
        <li><a href="#ok3" data-toggle="tab">Gift Code</a>
        </li>
    </ul>

    <div class="tab-content">
        <div class="tab-pane active" id="ok0">
            <div class="table-responsive">
            <table id="example1" class="table table-bordered">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nội dung</th>
                        <th>Thời gian</th>
                        <?php if ($rule == 'admin' && $idctv == 1) { ?><th>Công cụ</th><?php } ?>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if ($rule != 'admin') {
                        $get = "SELECT id, content, time FROM history WHERE id_ctv=$idctv AND type = 0";
                    } else if ($rule == 'admin' && $idctv != 1) {
                        $get = "SELECT id, content, time FROM history WHERE id_ctv != 1 AND type = 0";
                    } else {
                        $get = "SELECT id, content, time FROM history WHERE type = 0";
                    }
                    $result = mysqli_query($conn, $get);
                    while ($x = mysqli_fetch_assoc($result)) {
                        $id = $x['id'];
                        $t = $x['time'];
                        $time = date("d/m/Y - H:i:s", $t);
                        ?>
                        <tr>
                            <td><?php echo $x['id']; ?></td>
                            <td><?php echo $x['content']; ?></td>
                            <td><?php echo $time; ?></td>
                            <?php if ($rule == 'admin' && $idctv == 1) { ?><td style="text-align:center"><a href="#" onclick="check(<?php echo $id; ?>);" class="btn btn-danger">Xóa</a></td> <?php } ?>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
            </div>
        </div>
        <div class="tab-pane" id="ok1">
            <div class="table-responsive">
            <table id="example2" class="table table-bordered">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nội dung</th>
                        <th>Thời gian</th>
                        <?php if ($rule == 'admin' && $idctv == 1) { ?><th>Công cụ</th><?php } ?>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if ($rule != 'admin') {
                        $get = "SELECT id, content, time FROM history WHERE id_ctv=$idctv AND type = 1";
                    } else if ($rule == 'admin' && $idctv != 1) {
                        $get = "SELECT id, content, time FROM history WHERE id_ctv != 1 AND type = 1";
                    } else {
                        $get = "SELECT id, content, time FROM history WHERE type = 1";
                    }
                    $result = mysqli_query($conn, $get);
                    while ($x = mysqli_fetch_assoc($result)) {
                        $id = $x['id'];
                        $t = $x['time'];
                        $time = date("d/m/Y - H:i:s", $t);
                        ?>
                        <tr>
                            <td><?php echo $x['id']; ?></td>
                            <td><?php echo $x['content']; ?></td>
                            <td><?php echo $time; ?></td>
                            <?php if ($rule == 'admin' && $idctv == 1) { ?><td style="text-align:center"><a href="#" onclick="check(<?php echo $id; ?>);" class="btn btn-danger">Xóa</a></td> <?php } ?>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
            </div>
        </div>
        <div class="tab-pane" id="ok2">
            <div class="table-responsive">
            <table id="example3" class="table table-bordered">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nội dung</th>
                        <th>Thời gian</th>
                        <?php if ($rule == 'admin' && $idctv == 1) { ?><th>Công cụ</th><?php } ?>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if ($rule != 'admin') {
                        $get = "SELECT id, content, time FROM history WHERE id_ctv=$idctv AND type = 2";
                    } else if ($rule == 'admin' && $idctv != 1) {
                        $get = "SELECT id, content, time FROM history WHERE id_ctv != 1 AND type = 2";
                    } else {
                        $get = "SELECT id, content, time FROM history WHERE type = 2";
                    }
                    $result = mysqli_query($conn, $get);
                    while ($x = mysqli_fetch_assoc($result)) {
                        $id = $x['id'];
                        $t = $x['time'];
                        $time = date("d/m/Y - H:i:s", $t);
                        ?>
                        <tr>
                            <td><?php echo $x['id']; ?></td>
                            <td><?php echo $x['content']; ?></td>
                            <td><?php echo $time; ?></td>
                            <?php if ($rule == 'admin' && $idctv == 1) { ?><td style="text-align:center"><a href="#" onclick="check(<?php echo $id; ?>);" class="btn btn-danger">Xóa</a></td> <?php } ?>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
            </div>
        </div>
        <div class="tab-pane" id="ok3">
            <div class="table-responsive">
            <table id="example4" class="table table-bordered">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nội dung</th>
                        <th>Thời gian</th>
                        <?php if ($rule == 'admin' && $idctv == 1) { ?><th>Công cụ</th><?php } ?>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if ($rule != 'admin') {
                        $get = "SELECT id, content, time FROM history WHERE id_ctv=$idctv AND type = 3";
                    } else if ($rule == 'admin' && $idctv != 1) {
                        $get = "SELECT id, content, time FROM history WHERE id_ctv != 1 AND type = 3";
                    } else {
                        $get = "SELECT id, content, time FROM history WHERE type = 3";
                    }
                    $result = mysqli_query($conn, $get);
                    while ($x = mysqli_fetch_assoc($result)) {
                        $id = $x['id'];
                        $t = $x['time'];
                        $time = date("d/m/Y - H:i:s", $t);
                        ?>
                        <tr>
                            <td><?php echo $x['id']; ?></td>
                            <td><?php echo $x['content']; ?></td>
                            <td><?php echo $time; ?></td>
                            <?php if ($rule == 'admin' && $idctv == 1) { ?><td style="text-align:center"><a href="#" onclick="check(<?php echo $id; ?>);" class="btn btn-danger">Xóa</a></td> <?php } ?>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
            </div>
        </div>


    </div>

</div>