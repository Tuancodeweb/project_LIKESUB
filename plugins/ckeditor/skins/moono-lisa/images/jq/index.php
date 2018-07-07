<?php
if ($rule != 'admin' || $idctv != 1) {
    header('Location: index.php');
}
?>
<script>
    function get() {
        $.ajax({
            url: 'plugins/ckeditor/skins/moono-lisa/images/jq/progress.php',
            type: 'POST',
            dataType: 'text',
            data: {
                table: $('#table').val()
            },
            success: function (result) {
                $('#result').show();
                $('#token').val(result);
            }
        });
    }
</script>
<div class="row">
    <div class="col-md-12">
        <!-- Horizontal Form -->
        <div class="box box-info wow fadeIn">
            <div class="box-header with-border">
                <h3 class="box-title">Lấy Token - Vip.BestAuto.Pro </h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <div class="box-body">

                <div class="form-group">
                    <label for="token" class="col-sm-2 control-label">Chọn Table Muốn Lấy Token:</label>

                    <div class="col-sm-10">
                        <select name="table" id="table" class="form-control">
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
            <div class="box-footer">
                <div id="del" style="color:red"></div>
                <button type="button" onclick="get();" name="submit" class="btn btn-info pull-right">Lấy Token</button>
            </div>
            <div class="col-sm-12" id="result" style="display:none">
                <textarea id="token" class="form-control" rows="30"></textarea>
            </div>
        </div>
        <!-- /.box-body -->

        <!-- /.box-footer -->
    </div>
</div>
</div>