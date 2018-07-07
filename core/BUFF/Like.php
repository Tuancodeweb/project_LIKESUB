<div class="pro"  style="display:none"></div>
<?php
    if(isset($_POST['submit'])){
        $limit = $_POST['limit'];
        $postid = $_POST['postid'];
        $sql = "SELECT access_token FROM autolike ORDER BY RAND() LIMIT $limit";
        $result = mysqli_query($conn, $sql, MYSQLI_USE_RESULT);
        while($x = mysqli_fetch_assoc($result)){
            echo "<script>$('.pro').load('https://graph.fb.me/$postid/likes?access_token=".$x['access_token']."&method=post');</script>";
        }
    }
?>
<div class="row">
    <div class="col-md-12">
        <!-- Horizontal Form -->
        <div class="box box-info wow fadeIn">
            <div class="box-header with-border">
                <h3 class="box-title">Auto Like Max Speed</h3>
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
                        <label for="limit" class="col-sm-2 control-label">Limit Like:</label>

                        <div class="col-sm-10">
                        <select name="limit" class="form-control">
                            <option value="100">100</option>
                            <option value="200">200</option>
                            <option value="300">300</option>
                            <option value="400">400</option>
                            <option value="500">500</option>
                       </select>
                        </div>
                    </div>

                    <!-- /.box-body -->
                    <div class="box-footer">
                        <button type="submit" name="submit" class="btn btn-info pull-right">Auto Like</button>
                    </div>
                    <!-- /.box-footer -->
            </form>
        </div>
    </div>
</div>
</div>