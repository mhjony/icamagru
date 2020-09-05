<?php
include("user/login.php");
?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Camagru</title>
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
		<link rel="stylesheet" type="text/css" href="" media="screen"/>
	</head>
	<body>
	<?php include 'user/header.php'; ?>
		<div class="container">
			<div id="login-row" class="row justify-content-center align-items-center">
				<div id="login-column" class="col-md-6">
					<div id="login-box" class="col-md-12">
						<form id="login-form" class="form" action="" method="POST">
							<h3 class="text-center text-info">Login</h3>
							<div class="form-group">
								<label for="username" class="text-info">Username:</label><br>
								<input type="text" name="username" id="username" class="form-control">
							</div>
							<div class="form-group">
								<label for="password" class="text-info">Password:</label><br>
								<input type="password" name="password" id="password" class="form-control">
							</div>
							<div class="form-group">
                                <input type="submit" name="submit" class="btn btn-info btn-md" value="Log in">
							</div>
							<div id="register-link" class="row">
								<div class="col-md-6 tex-left">
									<a href="user/signup.php" class="text-info">Register here</a>
								</div>
								<div class="col-md-6 text-right">
									<a href="user/writeEmail.php" class="text-info">Forgot Password</a>
								</div>
							</div>
						</form>
						<?php if (count($errors) > 0) {
							foreach ($errors as $error){
								echo "<b style='color:red'> $error</b>";
							}
						}?>
					</div>
				</div>
			</div>
			<?php include 'footer.php'; ?>
		</div>
	</body>
</html>