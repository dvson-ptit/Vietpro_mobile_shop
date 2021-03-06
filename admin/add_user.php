<?php
$fail = $pass_fail = "none";
$sql_user="SELECT * FROM user ORDER BY user_id DESC";
$query = mysqli_query($conn,$sql_user);
if(isset($_POST['sbm'])){
	$pass_failed = 0;
	$user_full = $_POST['user_full'];
	$user_mail = $_POST['user_mail'];
	$user_pass = $_POST['user_pass'];
	$user_re_pass = $_POST['user_re_pass'];
	$user_level = $_POST['user_level'];
	while($row=mysqli_fetch_array($query)){
		if($user_mail == $row['user_mail']){
			$fail = 'block';
		}
	}
	if($user_pass != $user_re_pass){
		$pass_fail = 'block';
	}
	else{
		$sql = "INSERT INTO user(user_full, user_mail, user_pass, user_level) VALUES ('$user_full','$user_mail','$user_pass',$user_level) ";

		mysqli_query($conn,$sql);

		header("location: index.php?page_layout=user");

	}
	
}


?>

<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
	<div class="row">
		<ol class="breadcrumb">
			<li><a href="#"><svg class="glyph stroked home">
						<use xlink:href="#stroked-home"></use>
					</svg></a></li>
			<li><a href="">Quản lý thành viên</a></li>
			<li class="active">Thêm thành viên</li>
		</ol>
	</div>
	<!--/.row-->

	<div class="row">
		<div class="col-lg-12">
			<h1 class="page-header">Thêm thành viên</h1>
		</div>
	</div>
	<!--/.row-->
	<div class="row">
		<div class="col-lg-12">
			<div class="panel panel-default">
				<div class="panel-body">
					<div class="col-md-8">
						<div class="alert alert-danger" style="display: <?= $fail; ?>">Email đã tồn tại !</div>
						<form role="form" method="post">
							<div class="form-group">
								<label>Họ & Tên</label>
								<input name="user_full" required class="form-control" placeholder="">
							</div>
							<div class="form-group">
								<label>Email</label>
								<input name="user_mail" required type="text" class="form-control">
							</div>
							<div class="form-group">
								<label>Mật khẩu</label>
								<input name="user_pass" required type="password" class="form-control">
							</div>
							<div class="form-group">
								<label>Nhập lại mật khẩu</label>
								<input name="user_re_pass" required type="password" class="form-control">
							</div>
								<div class="alert alert-danger"  style="display: <?= $pass_fail; ?>">Mật khẩu không trùng khớp !</div>';

							<div class="form-group">
								<label>Quyền</label>
								<select name="user_level" class="form-control">
									<option value=1>Admin</option>
									<option value=2>Member</option>
								</select>
							</div>
							<button name="sbm" type="submit" class="btn btn-success">Thêm mới</button>
							<button type="reset" class="btn btn-default">Làm mới</button>
					</div>
					</form>
				</div>
			</div>
		</div><!-- /.col-->
	</div><!-- /.row -->
</div>
<!--/.main-->