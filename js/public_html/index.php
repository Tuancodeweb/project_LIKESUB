<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Game Bản Quyền</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="css/projecthotel.css">
	<link rel='stylesheet' href='https://cdn.rawgit.com/daneden/animate.css/v3.1.0/animate.min.css'>
<script src='https://cdn.rawgit.com/matthieua/WOW/1.0.1/dist/wow.min.js'></script>

</head>
<script>
new WOW().init();
</script>
<body>

	<!-- Page Header -->
	<header>
		<div class="page-header">

			<div class="page-title">
				<h1 class="title">ACCOUNT GAME BẢN QUYỀN.</h1>
				<p class="slogan">Đây là địa chỉ cung cấp Account game bản quyền với giá cả hợp lý!</p>
			</div>
			<div class="search-form" id="search-form">
				
				<p class="form-title">ĐĂNG KÍ</p>
				<p class="form-subtitle">Hãy đăng kí để nhận bản tin!</p>
				<?php 
				include('inc/myconmet.php');
			if(isset($_POST['submit']))
			{
				$error=array();// đây là biến trống để array() nếu người dùng ko nhập vào cả 3 dòng title video ordernum thì lập túc nó sẽ nỗi
				if(empty($_POST['hoten']))
				{
					$error[]='hoten';
				}
				else
				{
					$hoten=$_POST['hoten'];
				}
				if(empty($_POST['phone']))
				{
					$error[]='phone';
				}
				else
				{
					$phone=$_POST['phone'];
				}
				if(filter_var(($_POST['Gmail']),FILTER_VALIDATE_EMAIL)==TRUE)
				{
					$Gmail=mysqli_real_escape_string($abs,$_POST['Gmail']);
				}
				else
				{
					$error[]='Gmail';
				}
				if(empty($_POST['link']))
				{
					$error[]='link';
				}
				else
				{
					$link=$_POST['link'];
				}
				////////////////////////////////////////////////////////////////////////////////////////////////////////
				if(empty($error))
					{// khi kiểm tra nếu người dùng nhập cả kết kí tự rồi ko lỗi các gì thì nó sẽ thực hiện đoạn code này
				$query="INSERT INTO tblnhanbantin(hoten,phone,Gmail,link) VALUES ('{$hoten}',$phone,'{$Gmail}','{$link}')";
				$results=mysqli_query($abs,$query) or die("Query={$query} \n <br/> mysql_error:".mysqli_error($abs));
				if(mysqli_affected_rows($abs)==1)// câu truy vấn bằng 1 là tồn tại
				{ 
					echo "<p class='center' style='color: green;'>Thêm Mới Thành Công</p>";
				}
				else
				{
					echo "<p class='center'>Thêm Mới không Thành Công</p>";
				}
					}/////// đây là dấy }  ngăn cách chương trình
					else
					{
						$message="<p class='required'>Bạn hãy Nhập đầy đủ thông tin</p>";
					}
					$_POST['hoten']='';
					$_POST['phone']='';
					$_POST['Gmail']='';
					$_POST['phone']='';
					$_POST['link']='';
			}

		?>
			<form name="frmadd_user" method="POST">
			<?php 
				if(isset($message))// kiểm tra xem cái biến đấy nó tồn tại hay ko
				{
					echo $message;
				}
			?>
				<div class="form">
					<form action="#" method="post" name="search-form">
						<div class="form-control">
							<input class="search-textbox" name="hoten" type="text"  value="<?php if(isset($_POST['hoten'])){echo $_POST['hoten'];} ?>" placeholder="Họ tên của người đăng kí">
							<i class="fa fa-user textbox-icon" aria-hidden="true"></i>
						<?php
								if(isset($error) && in_array('hoten',$error))
						        {
							   			echo "<p class='required'>Họ Tên Không Để Trống</p>";
						        }
						?>
						</div>
						<div class="form-control">
							<input class="search-textbox" name="phone" type="text"  value="<?php if(isset($_POST['phone'])){echo $_POST['phone'];} ?>" placeholder="Số điện thoại cá nhân">
							<i class="fa fa-phone textbox-icon" aria-hidden="true"></i>
						<?php
								if(isset($error) && in_array('phone',$error))
						        {
							   			echo "<p class='required'> Số Điện Thoại Không Để Trống</p>";
						        }
						?>
						</div>
						<div class="form-control">
							<input class="search-textbox" name="Gmail" type="text"  value="<?php if(isset($_POST['Gmail'])){echo $_POST['Gmail'];} ?>" placeholder="Địa chỉ Gmail để nhận bản tin">
							<i class="fa fa-envelope textbox-icon" aria-hidden="true"></i>
						<?php
								if(isset($error) && in_array('Gmail',$error))
						        {
							   			echo "<p class='required'>Gmail Bạn nhập sai hãy đảm bảo có đuôi @gmail.com</p>";
						        }
						?>
						</div>
						<div class="form-control">
							<input class="search-textbox" name="link" type="text" value="<?php if(isset($_POST['link'])){echo $_POST['link'];} ?>"  placeholder="Link liên kết với facebook">
							<i class="fa fa-thumbs-up textbox-icon" aria-hidden="true"></i>
						<?php
							if(isset($error) && in_array('link',$error))
							{
										echo "<p class='required'>Bạn Chưa Nhập link facebook</p>";
							}
						?>
						</div>
						<div class="form-control">
							<input type="submit" name="submit" class="search-button" value="Đăng Kí">
						</div>
						
					</form>
				</div>
			</div>
			<div class="row">
 
 
<div data-wow-duration="2s" class="wow bounceInRight">
			<div class="header-text">
				<p>Mục tiêu của trang web chúng tôi tạo ra, nhằm cung cấp cho đại bộ phận cộng đồng Game Thủ Việt Nam những accout game bản quyền tốt nhất và uy tín nhất 😁</p>
			</div>
			</div>
		</div>
	</header>		<!-- End of Page Header -->

	<main>
		<!-- Tour Type Area -->
		<div class="row">
		<div data-wow-duration="2s" class="wow bounceInRight">
		<section>
			<div class="tour-type">
				<h2 class="hidden">Tour Destination</h2>
				<div class="tour-description">
					<p><em class="aaa">TẠI SAO CÁC BẠN NÊN CHỌN CHÚNG TÔI ?</em> vì chúng tôi luôn đề cao tính uy tín và phục vụ tận tình .Với các thanh toán nhanh gọn hỗ trợ nhiệt tình từ đội ngũ . </p>
				</div>

				<div class="tour-destination-container">
					<div class="tour-destination">
						<img src="http://sv1.upsieutoc.com/2017/05/05/Icon-portrait-hexagon.3CV6U.png" alt="North America Tour" class="na"> 
						<a href="#search-form">
							<span>Trang Chủ</span>
						</a>
					</div>
					<div class="tour-destination">
						<img src="http://sv1.upsieutoc.com/2017/05/05/Icon-portrait-hexagon.3MXIZ.png" alt="South America Tour" class="sa">
						<a href="add_shop.php">
							<span>Cửa Hàng</span>
						</a>
						
					</div>
					<div class="tour-destination">
						<img src="http://sv1.upsieutoc.com/2017/05/05/Icon-portrait-hexagon.4TciV.png" alt="San Francisco Tour" class="sf">
						<a href="add_livegame.php">
							<span>Live Game</span>
						</a>
						
					</div>
					<div class="tour-destination">
						<img src="http://sv1.upsieutoc.com/2017/05/05/Icon-portrait-hexagon.0AUxZ.png" class="ac">
						<a href="add_adminweb.php">
							<span>Admin Web</span>
						</a>
						
					</div>

				</div>
				
			</div>
		</section>		<!-- End of Tour Type Area -->
		</div>


		<!-- News and Events Area -->
		<div class="row">
		<div data-wow-duration="2s" class="wow bounceInLeft">
		<section>
			<div class="news-container">
				<h2 class="news-title">Game Mới &amp; Sự Kiện </h2>
				<p>Đây là kênh thông tin về game mới ra mắt, đang được đông đảo cộng đồng quan tâm  . </p>
				<div class="post-group">
					<div class="post">
						<img src="http://sv1.upsieutoc.com/2017/05/05/C7uWOPTX0AAwaMh-681x409.jpg" alt="Living the Travel Lifestyle">
						<p class="post-title"><a href="#">Call Of Duty 2017</a></p>
						<p class="author-pubdate">
							<a href="#">
								<span><i class="fa fa-user" aria-hidden="true"></i>&nbsp; Admin </span> 
							</a>
							<span><i class="fa fa-calendar" aria-hidden="true"></i> &nbsp;May 5, 2017</span>
						</p>
						<p class="post-summary">Call of Duty: WWII. Chưa rõ đây có phải tên chính thức của trò chơi hay không, chỉ biết rằng tấm poster đã khẳng định tin đồn trong thời gian qua về bối cảnh Thế chiến thứ 2 - cũng chính là cái nôi đã khai sinh ra dòng game Call of Duty vào năm 2003.</p>
					</div>

					<div class="post">
						<img src="http://sv1.upsieutoc.com/2017/05/05/Battlegrounds.jpg" alt="Living the Travel Lifestyle">
						<p class="post-title"><a href="#">PlayerUnknown's Battlegrounds</a></p>
						<p class="author-pubdate">
							<a href="#">
								<span><i class="fa fa-user" aria-hidden="true"></i>&nbsp; Admin </span> 
							</a> 
							<span><i class="fa fa-calendar" aria-hidden="true"></i> &nbsp;May 2, 2017</span>
						</p>
						<p class="post-summary">Ở thời điểm hiện tại, có thể khẳng định rằng Playerunknown's Battlegrounds là một trong số những game online hot bậc nhất tại Việt Nam cũng như trên thế giới với hàng triệu người cùng tham gia game, và hàng triệu người khác thì theo dõi từng trận đấu trên Twitch hay YouTube Gaming</p>
					</div>

					<div class="post">
						<img src="http://sv1.upsieutoc.com/2017/05/05/YnXZtkc.png" alt="Living the Travel Lifestyle">
						<p class="post-title"><a href="#">Outlast 2</a></p>
						<p class="author-pubdate">
							<a href="#">
								<span><i class="fa fa-user" aria-hidden="true"></i>&nbsp; Admin </span> 
							</a> 
							<span><i class="fa fa-calendar" aria-hidden="true"></i> &nbsp;May 3, 2015</span>
						</p>
						<p class="post-summary">Gore, hay còn gọi là thể loại kinh dị máu me, dùng những hình ảnh có sức ấn tượng mạnh để đánh vào tâm trí người xem đã chẳng còn xa lạ gì với cộng đồng game thủ và fan của loại hình nghệ thuật thứ 7. Hồi những năm 2000, các đạo diễn phim bom tấn Hollywood đã đua nhau tạo ra những bộ phim kinh dị theo kiểu này, và thế là Saw, Final Destination, I Spit On Your Grave và hằng hà sa số những bộ phim cùng xuất hiện. </p>
					</div>
				</div>
			</div>
		</section>		<!-- End of News and Events Area -->
		</div>

		<!-- Bottom Banner -->
		<div class="row">
		<div data-wow-duration="2s" class="wow bounceInRight">
		<section>
			<div class="bottom-banner">
				
				<h2 class="bottom-banner-title">THANK YOU</h2>
				<p>Cảm ơn các bạn đã lựa chọn chúng tôi!</p>
				<a href="#search-form" class="find-button"><span>TRANG CHỦ</span></a>
			</div>
		</section>	
		</div>	<!-- End of Bottom Banner -->
	</main>


	<!-- Page Footer Area -->
	<div class="row">
		<div data-wow-duration="2s" class="wow bounceInLeft">
	<footer>
		<div class="footer-info">
			<div class="footer">
				<h2>ĐỊA CHỈ LIÊN HỆ</h2>
				<p>Đường Z115, Xã Quyết Thắng, Phường Tân Thịnh, TP.Thái Nguyên</p>
				<p>Chúng tôi hỗ trợ 24.7: 01654.665.693</p>
				<p>G: Sinhvienit1998@gmail.com</p>
			</div>

			<div class="footer">
				<h2>HỖ TRỢ</h2>
				<p>Facebook</p>
				<p>Gmail</p>
				<p>Zalo</p>
			</div>

			<div class="footer">
				<h2>LIÊN KẾT</h2>
				<p class="follow-icon">
					<a href="https://www.facebook.com/thomas.t.phan1"><span><i class="fa fa-facebook" aria-hidden="true"></i></span></a>
					<a href="https://twitter.com/?lang=vi"><span><i class="fa fa-twitter" aria-hidden="true"></i></span></a>
					<a href="https://www.instagram.com/"><span><i class="fa fa-instagram" aria-hidden="true"></i></span></a>
					<a href="https://www.youtube.com"><span><i class="fa fa-youtube" aria-hidden="true"></i></span></a>
				</p>
			</div>

			<div class="footer">
				<h2>GMAIL ĐĂNG KÍ</h2>
				<div class="newsletter-form">
					<form action="#" method="post" name="newsletter-form">
						<input class="mail-box" type="text" placeholder="Gmail đăng kí"  value="<?php if(isset($_POST['Gmail'])){echo $_POST['Gmail'];} ?>" placeholder="Địa chỉ Gmail để nhận bản tin">
						<?php
								if(isset($error) && in_array('Gmail',$error))
						        {
							   			echo "<p class='required'>Gmail Không Để Trống</p>";
						        }
						?>
						<input class="submit-button" type="submit" value="SUBMIT">
						
					</form>
				</div>

			</div>
		</div>
		
		<hr class="footer-line">

		<p class="footer-text">
			&copy; Designer by [tuanphan😉] | Sincer: 2017
		</p>
	</footer>	
	</div>	<!-- End of Page Footer Area -->
</body>
</html>