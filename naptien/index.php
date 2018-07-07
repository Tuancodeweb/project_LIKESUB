<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>recharge</title>
  <link rel="stylesheet" href="css/style.css">

  <link rel="stylesheet" type="text/css" href="Fonts/Pacifico-Regular.ttf">
  <link href="https://fonts.googleapis.com/css?family=Pacifico" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Oleo+Script:400,700" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Teko:400,700" rel="stylesheet">
  <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">

  <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
  <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
  <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<!------ Include the above in your HEAD tag ---------->
 <script src="https://use.fontawesome.com/07b0ce5d10.js"></script>
 <script>
  $(document).ready(function(){
    $(".form-control").tooltip({ placement: 'down'});
});
</script>
</head>
  <body>

    <section id="contact">
      <div class="section-content">
        <h1 class="section-header"><span class="content-header wow fadeIn " data-wow-delay="0.2s" data-wow-duration="2s"> Panel recharge</span></h1>
          <h3>Nạp thẻ cào Online - Số dư của bạn sẽ tự động được cộng = giá trị mệnh giá thẻ sau khi nạp thành công!</h3>
      </div>


      <div class="contact-section">
        <div class="container">
          <form  class="form-horizontal form-bk" role="form" method="post" action="../naptien/transaction.php">
            <div class="col-md-6 form-line">
            
              <div class="form-group">
                    <label for="telephone"> Loại thẻ :</label>
                    <select type="tel" class="form-control" id="telephone" placeholder=" 0 LIKE" style="width: 500px;">
                             <option value="VIETEL">Viettel</option>
                              <option value="MOBI">Mobifone</option>
                              <option value="VINA">Vinaphone</option>
                              <option value="GATE">Gate</option>
                              <option value="VNM">VietNam Mobile</option>
                      </select>
              </div>
              <div class="form-group">
                                  <label for="telephone">Bạn là (Chọn đúng) :</label>
                                 <input type="radio" class="rule" name="rule" value="other" data-toggle="tooltip" data-title="Bạn là cộng tác viên, đại lí hay thành viên?" onchange="check()" required> Đại lí, Thành viên
                                  <input type="radio"  class="rule" name="rule" value="ctv" data-toggle="tooltip" data-title="Bạn là cộng tác viên, đại lí hay thành viên?" onchange="check()" required> Cộng tác viên
              </div>
              


              <div class="form-group">
                                  <label for="telephone"> Tài khoản:</label>
                                        <input type="text" onkeyup="check();" onchange="check();" id="user" style="width: 500px" class="form-control" id="txtuser" name="txtuser" value="<?php echo isset($uname) ? $uname : ''; ?>" placeholder="Nhập chính xác tên tài khoản" data-toggle="tooltip" data-title="Nhập chính xác tên tài khoản" required/>
                                        <span  id="check"></span>
                                                          
              </div>




              <div class="form-group">
                  <label for="exampleInputUsername">Mã thẻ :</label>
                  <input type="text" style="width: 500px"class="form-control" id="txtpin" name="txtpin" placeholder="Mã thẻ" data-toggle="tooltip" data-title="Mã số sau lớp bạc mỏng" required/>
              </div>


              <div class="form-group">
                  <label for="exampleInputUsername">Số seri :</label>
                  <input type="text" style="width: 500px"class="form-control" id="txtseri" name="txtseri" placeholder="Số seri" data-toggle="tooltip" data-title="Mã seri nằm sau thẻ" required>
              </div>





                                <div>
                                       <button type="submit" class="btn btn-primary" name="napthe">Nạp thẻ</button>
                                </div>
            </div>




<?php include '../person/billing.php'; ?>