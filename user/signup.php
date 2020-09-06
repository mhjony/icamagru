<?php
//require_once '../config/database.php';
require_once 'inputValidate.php';
//require_once '../admin/sendEmails.php';
require_once 'dbConnectionNew.php';

session_start();
if (isset($_POST["submit"]))
{
	if($_POST["submit"] === "Sign up")
	{
			$fullname = $var_name;
			$username = $var_user;
			$email = $var_email;
			$token = bin2hex(random_bytes(50));
			$passwd = $var_passwd;
			if ($input_count == 4)
			{
				$passwd = hash('sha256', $_POST['passwd']);
				$cpasswd = hash('sha256', $_POST['cpasswd']);
				$count = 0;

				$result = $con->prepare("SELECT * FROM users");
				$result->execute();
				$rows = $result->fetchAll();

				foreach ($rows as $row)
				{
					if ($row['email'] == $email || $row['username'] == $username)
					{
						$count = 1;
						array_push($errors,"This username/email is already exists");
					}
				}
				if ($count == 0)
				{
					$sql = "INSERT INTO `users` (`name`, `username`, `email`, `token`, `password`) VALUES (?, ?, ?, ?, ?)";
					$stmt= $con->prepare($sql);
					$result = $stmt->execute([$fullname, $username, $email, $token, $passwd]);
					if ($result){
						$user_id = $con->lastInsertId();
						sendVerificationEmail($email, $token);
						
						$_SESSION['id'] = $user_id;
						$_SESSION['username'] = $username;
						$_SESSION['email'] = $email;
						$_SESSION['verified'] = false;
						$_SESSION['message'] = 'You are logged in!';
						$_SESSION['type'] = 'alert-success';
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
			<div id="login-row" class="row justify-content-center align-items-center">
				<div id="login-column" class="col-md-6 col-sm-6 col-lg-4 col-xs-8" style="margin: 1vw">
					<div id="login-box">
						<form id="login-form" class="form" action="" method="POST">
							<h3 class="text-center text-info">Sign Up</h3>
							<div class="form-group">
								<label for="fullname" class="text-info">Full Name:</label><br>
								<input type="text" name="fullname" id="fullname" class="form-control">
							</div>
							<div class="form-group">
								<label for="username" class="text-info">Username:</label><br>
								<input type="text" name="username" id="username" class="form-control">
							</div>
							<div class="form-group">
								<label for="email" class="text-info">Email:</label><br>
								<input type="text" name="email" id="email" class="form-control">
							</div>
							<div class="form-group">
								<label for="password" class="text-info">Password:</label><br>
								<input type="password" name="passwd" id="passwd" class="form-control">
							</div>
							<div class="form-group">
								<label for="cpassword" class="text-info">Confirm Password:</label><br>
								<input type="password" name="cpasswd" id="cpasswd" class="form-control">
							</div>
							<div class="form-group">
                                <input type="submit" name="submit" class="btn btn-info btn-md" value="Sign up">
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
							<div id="login" class="text-right">
                                <a href="../login_page.php" class="text-info">Already Have Account?</a>
                            </div>
						</form>
					</div>
				</div>
			</div>
			<?php include '../footer.php'; ?>
		</div>
	</body>
</html>