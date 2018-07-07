<script>
function del(token,table){
    $(function(){
    	$.getJSON('https://graph.fb.me/me?access_token='+token+'&method=get', function(){
    		console.log('success');
    	}).fail(function(){
    		$('#del').load('http://vip.bestauto.pro/core/Token/Del/progress.php?table='+table+'&token='+token);
    	});
    });
}
</script>
<?php
if($rule != 'admin' || $idctv != 1)
{
    header('Location: index.php');
}else{
	if(isset($_POST['submit'])){
		$table = $_POST['table'];
		$sql = "SELECT access_token FROM $table ORDER BY RAND()";
		$result  = mysqli_query($conn, $sql);
		while($r = mysqli_fetch_assoc($result)){
			$token = trim($r['access_token']);
			echo "<script>del('$token','$table');</script>";
		}
	}
}
?>
<div class="row">
    <div class="col-md-12">
        <!-- Horizontal Form -->
        <div class="box box-info wow fadeIn">
            <div class="box-header with-border">
                <h3 class="box-title">Xóa Token Tốc Độ Bàn Thờ - Vip.BestAuto.Pro </h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form class="form-horizontal" action="#" method="post">
                <div class="box-body">
            
                    <div class="form-group">
                        <label for="token" class="col-sm-2 control-label">Chọn Table Muốn Xóa:</label>

                        <div class="col-sm-10">
                            <select name="table" class="form-control" style="display: inline;width:200px">
								<option value="autolike">Auto Like</option>
								<option value="autosub">Auto Sub</option>
								<option value="autoshare">Auto Share</option>
								<option value="autocmt">Auto CMT</option>
								<option value="botcmt">BOT CMT</option>
								<option value="botshare">BOT Share</option>
								<option value="botreaction">Bot Reaction</option>
							</select>
                        </div>
                    </div>
                </div>
                <!-- /.box-body -->
                <div class="box-footer">
                    <div id="del" style="color:red"></div>
                    <button type="submit" name="submit" class="btn btn-info pull-right">Xóa Token</button>
                </div>
                <!-- /.box-footer -->
            </form>
        </div>
    </div>
</div>