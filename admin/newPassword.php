<?php
include('validatePass.php');

session_start();
$errors = [];
$messages = [];

$username = $_SESSION['user']['username'];
if ($_POST['submit'] == "Reset Password")
{
	if (isset($_GET['token']))
	{
		$token = $_GET['token'];
		require_once 'dbConnectionNew.php';
		if ($con){
			
			$nPass = $_POST['npasswd'];
			$cPass = $_POST['cpasswd'];

			if ($nPass != "" && $cPass != ""){
				if ($nPass != $cPass){
					array_push($errors, "Password did not match");
				}
				else{
					if (validate_pass($nPass, $cPass)){
						$query = "SELECT email FROM reset_password WHERE token=? LIMIT 1;";
						$stmt = $con->prepare($query);
						$stmt->execute([$token]);
						$row = $stmt->fetch();
						$email = $row['email'];
						if ($email)
						{
							$new_passwd = hash('sha256', $nPass);
							$sql = "UPDATE `users` SET password=? WHERE email=?;";
							$stmt = $con->prepare($sql);
							$results = $stmt->execute([$new_passwd, $email]);
							if ($results){
								array_push($messages, "Your password has been reset successfully");
								$_SESSION['message'] = "Your password has been changed";
								header("Refresh: 5; url=../index.php");
							}
						}
					}
				}
			}
		}
	}
}

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
		<div class="container">
			<div id="login-row" class="row justify-content-center align-items-center">
				<div id="login-column" class="col-md-6">
					<div id="login-box" class="col-md-12">
						<form id="login-form" class="form" action="" method="POST">
							<h3 class="text-center text-info">Reset your password</h3>
							<div class="form-group">
								<input type="password" name="npasswd" id="npasswd" class="form-control" placeholder="New password">
							</div>
							<div class="form-group">
								<input type="password" name="cpasswd" id="cpasswd" class="form-control" placeholder="Confirm password">
							</div>
							<div class="row">
								<div class="col-md-6 text-left">
                                	<input type="submit" name="submit" class="btn btn-info btn-md" value="Reset Password">
								</div>
								<div class="col-md-6 text-right">
									<a href="../index.php" class="text-info"><h5>Login</h5></a>
								</div>
							</div>
							<?php if (count($errors) > 0)
							{
								?>
									<div class="form-group" style="color: red">
										<?php foreach($errors as $error)
										{ ?>
											<ul>
												<li><?php echo $error; ?></li>
											</ul>
											<?php 
										} ?>
									</div>
								<?php
							}
							?>
							<?php if (count($messages) > 0)
							{
								?>
									<div class="form-group" style="color: green">
										<?php foreach($messages as $message)
										{ ?>
											<ul>
												<li><?php echo $message; ?></li>
											</ul>
											<?php 
										} ?>
									</div>
								<?php
							}
							?>
						</form>
					</div>
				</div>
			</div>
		</div>
	</body>
</html>