<script>
	$(document).ready(function(){
    $(".form-control").tooltip({ placement: 'down'});
});
</script>
	<form class="form-horizontal form-bk" role="form" method="post" action="Card/transaction.php">
	<span class="h3" style="text-align:justify !important;">Nạp thẻ cào Online - Số dư của bạn sẽ tự động được cộng = giá trị mệnh giá thẻ sau khi nạp thành công!</span>
<div class="form-group">
    <label for="txtpin" class="col-lg-2 control-label">Loại thẻ</label>
    <div class="col-lg-10">
      <select style="width: 400px" class="form-control" name="chonmang">
		  <option value="VIETEL">Viettel</option>
		  <option value="MOBI">Mobifone</option>
		  <option value="VINA">Vinaphone</option>
		  <option value="GATE">Gate</option>
		  <option value="VNM">VietNam Mobile</option>
		</select>
    </div>
  </div>
    <div class="form-group">
    <label for="txtseri" class="col-lg-2 control-label">Bạn là ? (Chọn đúng)</label>
    <div class="col-lg-10">
        <input type="radio" class="rule" name="rule" value="other" data-toggle="tooltip" data-title="Bạn là cộng tác viên, đại lí hay thành viên?" onchange="check()" required> Đại lí, Thành viên<br />
      <input type="radio" class="rule" name="rule" value="ctv" data-toggle="tooltip" data-title="Bạn là cộng tác viên, đại lí hay thành viên?" onchange="check()" required> Cộng tác viên
    </div>
  </div>
  <div class="form-group">
    <label for="txtpin" class="col-lg-2 control-label"><font color="red">Tài khoản: </font></label>
    <div class="col-lg-10">
      <input type="text" onkeyup="check();" onchange="check();" id="user" style="width: 400px" class="form-control" id="txtuser" name="txtuser" value="<?php echo isset($uname) ? $uname : ''; ?>" placeholder="Nhập chính xác tên tài khoản" data-toggle="tooltip" data-title="Nhập chính xác tên tài khoản" required/>
      <span  id="check"></span>
    </div>
  </div>
  <div class="form-group">
    <label for="txtpin" class="col-lg-2 control-label">Mã thẻ</label>
    <div class="col-lg-10">
      <input type="text" style="width: 400px"class="form-control" id="txtpin" name="txtpin" placeholder="Mã thẻ" data-toggle="tooltip" data-title="Mã số sau lớp bạc mỏng" required/>
    </div>
  </div>
  <div class="form-group">
    <label for="txtseri" class="col-lg-2 control-label">Số seri</label>
    <div class="col-lg-10">
      <input type="text" style="width: 400px"class="form-control" id="txtseri" name="txtseri" placeholder="Số seri" data-toggle="tooltip" data-title="Mã seri nằm sau thẻ" required>
    </div>
  </div>

  <div class="form-group">
    <div class="col-lg-offset-2 col-lg-10">
      <button type="submit" class="btn btn-primary" name="napthe">Nạp thẻ</button>
    </div>
  </div> 
</form>
<script>
 function check(){
  $.get('Card/check.php', { user: $('#user').val(), rule: $('input[name=rule]:checked').val() }, function(result){ $('#check').html(result); });
 }
</script>