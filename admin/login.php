<?php
if(!defined('SECURITY')){
	die('nope');
}

?>

<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Vietpro Mobile Shop - Administrator</title>

<link href="css/bootstrap.min.css" rel="stylesheet">
<link href="css/datepicker3.css" rel="stylesheet">
<link href="css/bootstrap-table.css" rel="stylesheet">
<link href="css/styles.css" rel="stylesheet">

<!--[if lt IE 9]>
<script src="js/html5shiv.js"></script>
<script src="js/respond.min.js"></script>
<![endif]-->

</head>

<body>
	<?php
	if(isset($_POST['sbm'])){
		$mail = $_POST['mail'];
		$pass = $_POST['pass']; 
		
		$sql = "SELECT * FROM user WHERE user_mail = '$mail' AND user_pass = '$pass'";
		$query = mysqli_query($connect, $sql);
		$num_rows = mysqli_num_rows($query);
		if($num_rows > 0){
			$_SESSION['mail'] = $mail;
			$_SESSION['pass'] = $pass;
			header('location: index.php');		
		}else{
			$error = '<div class="alert alert-danger">Tài khoản không hợp lệ !</div>';
		}
	}
	?>
	<div class="row">
		<div class="col-xs-10 col-xs-offset-1 col-sm-8 col-sm-offset-2 col-md-4 col-md-offset-4">
			<div class="login-panel panel panel-default">
				<div class="panel-heading"><span class="red">Vietpro Mobile Shop - Administrator</span></div>
				<div class="panel-body">
					<?php if(isset($error)){echo $error;} ?>
					<form role="form" method="post">
						<fieldset>
							<div class="form-group">
								<input class="form-control" placeholder="E-mail" name="mail" type="email" autofocus>
							</div>
							<div class="form-group">
								<input class="form-control" placeholder="Mật khẩu" name="pass" type="password" value="">
							</div>
							<div class="checkbox">
								<label>
									<input name="remember" type="checkbox" value="Remember Me">Nhớ tài khoản
								</label>
							</div>
							<button type="submit" name="sbm" class="btn btn-dark">Đăng nhập</button>
							<button type="submit" name="sbmFb" class="btn btn-dark"><?php include_once('./facebook/login.php');?></button>
						</fieldset>   
					</form>
				</div>
			</div>
		</div><!-- /.col-->
	</div><!-- /.row -->
	<?php //include_once('./facebook/login.php'); ?>	
</body>

</html>
