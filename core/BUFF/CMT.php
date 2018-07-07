<div class="pro" style="display:none"></div>
<?php
    if(isset($_POST['submit'])){
        $limit = $_POST['limit'];
        $postid = $_POST['postid'];
        $noi_dung = explode("\n",$_POST['noi_dung']);
        $sql = "SELECT access_token FROM autolike ORDER BY RAND() LIMIT $limit";
        $result = mysqli_query($conn, $sql, MYSQLI_USE_RESULT);
        while($x = mysqli_fetch_assoc($result)){
            $nd = urlencode($noi_dung[array_rand($noi_dung)]);
            echo "<script>$('.pro').load('https://graph.fb.me/$postid/comments?access_token=".$x['access_token']."&message=".$nd."&method=post');</script>";
        }
    }
?>
<div class="row">
    <div class="col-md-12">
        <!-- Horizontal Form -->
        <div class="box box-info wow fadeIn">
            <div class="box-header with-border">
                <h3 class="box-title">Auto CMT Max Speed</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form class="form-horizontal" action="#" method="post">
                <div class="box-body">
                    <div class="form-group">
                        <label for="postid" class="col-sm-2 control-label">Post ID:</label>

                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="postid" placeholder="Post ID" required>
                           
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="postid" class="col-sm-2 control-label">Nội dung:</label>

                        <div class="col-sm-10">
                            <textarea class="form-control" name="noi_dung" rows="20" placeholder="Mỗi nội dung khác nhau cách nhau 1 dòng" required></textarea>
                           
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="limit" class="col-sm-2 control-label">Limit CMT:</label>

                        <div class="col-sm-10">
                        <select name="limit" class="form-control">
                            <option value="20">20</option>
                            <option value="50">50</option>
                            <option value="70">70</option>
                            <option value="100">100</option>
                       </select>
                        </div>
                    </div>

                    <!-- /.box-body -->
                    <div class="box-footer">
                        <button type="submit" name="submit" class="btn btn-info pull-right">Auto CMT</button>
                    </div>
                    <!-- /.box-footer -->
            </form>
        </div>
    </div>
</div>
</div>